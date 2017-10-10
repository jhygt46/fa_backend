<?php
session_start();
date_default_timezone_set('America/Santiago');

require_once $path_class."core.php";

class Services extends Core{
    
    public $con = null;
    public $id_cia = null;
    public $id_cue = null;
    public $secret = "m^.&2rQb48EU-K9GV_4et<L@CF^JCa[9wxwBD8+f";
    
    public function __construct(){
        
        $this->id_cia = $this->getciaid();
        $this->id_cue = $this->getcueid();
        $this->con = new Conexion();
        
    }
    public function process(){
        
        if($_GET['accion'] == "asistencia"){
            return $this->getasistencia();
        }
        if($_GET['accion'] == "getGrifos"){
            return $this->getgrifos($_GET['lat'], $_GET['lng']);
        }
        if($_POST['accion'] == "get_llamados"){
            return $this->getllamados();
        }
        if($_GET['accion'] == "getLlamado"){
            return $this->getllamado($_GET['id']);
        }
        if($_POST['accion'] == "find_user"){
            return $this->find_user();
        }
        
    }
    public function login_app(){
        
        $correo = $_POST["email"];
        $pass = $_POST["pass"];
        
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $sql = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$correo."'");
            if($sql['count'] == 0){
                // CORREO NO SE ENCUENTERA EN LA BASE DE DATOS
                $info['op'] = 2;
                $info['message'] = "Error: Usuario no existe";
            }
            if($sql['count'] == 1){
                $id_user = $sql['resultado'][0]['id_user'];
                $bloqueado = $sql['resultado'][0]['bloqueado'];
                if($bloqueado == 1){
                    $fecha_block = $sql['resultado'][0]['fecha_bloqueado'];
                    if(strtotime($fecha_block) + 86400 < time()){
                        $info['op'] = 2;
                        $info['message'] = "Error:";
                    }else{
                        $bloqueado = 0;
                        $this->con->sql("UPDATE usuarios SET bloqueado='0', intentos='0' WHERE id_user='".$id_user."'");
                    }
                }
                if($bloqueado == 0){
                    if(md5($pass) == $sql['resultado'][0]['pass'] && strlen($pass) >= 8){
                        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                        $code = substr(str_shuffle($chars), 0, 32);
                        $info['op'] = 1;
                        $info['id_user'] = $sql['resultado'][0]['id_user'];
                        $info['id_cia'] = $sql['resultado'][0]['id_cia'];
                        $info['id_cue'] = $sql['resultado'][0]['id_cue'];
                        $info['nombre'] = $sql['resultado'][0]['nombre'];
                        $info['message'] = "";
                        $info['code'] = $code;
                        $this->con->sql("UPDATE usuarios SET code_app='".$code."' WHERE id_user='".$id_user."'");
                    }else{
                        $intentos = $sql['resultado'][0]['intentos'] + 1;
                        $this->con->sql("UPDATE usuarios SET intentos='".$intentos."' WHERE id_user='".$id_user."'");
                        if($intentos >= 10){
                            $this->con->sql("UPDATE usuarios SET bloqueado='1', fecha_bloqueado='".date('Y-m-d H:i:s')."' WHERE id_user='".$id_user."'");
                            $info['op'] = 2;
                            $info['message'] = "Usuario Bloqueado! desbloqueara automaticamente en 24hrs";
                        }else{
                            $info['op'] = 2;
                            $info['message'] = "Error: Password invalido";
                        }
                    }
                }
            }
        }else{
            $info['op'] = false;
            $info['message'] = "Error:";
        }
        return $info;
        
    }
    private function getgrifos($lat, $lng){
        
        $aux = array();
        $coords = $this->getBoundaries($lat, $lng, 1);
        $grifos = $this->con->sql("SELECT * FROM grifos WHERE lat>='".$coords["min_lat"]."' AND lat<='".$coords["max_lat"]."' AND lng>='".$coords["max_lng"]."' AND lng<='".$coords["min_lng"]."'");
        if($grifos['count'] > 0){
            $aux = $grifos['resultado'];
        }
        return $aux;
    }
    private function getllamados(){
        
        if($_POST['code'] != $this->secret){
            return;
        }
        
        $fecha = date("Y-m-d h:i:s", strtotime("-1 day"));
        $actos = $this->con->sql("SELECT t1.id_act, t2.nombre, t2.clave, t1.direccion, t1.comuna, t1.lat, t1.lng, t1.fecha_creado, t1.id_cue FROM actos t1, claves t2 WHERE t1.fecha_creado >= '".$fecha."' AND t1.id_cla=t2.id_cla AND t2.tipo=1");
        
        if($actos['count'] > 0){
            $lis_actos = $actos['resultado'];
            for($i=0; $i<$actos['count']; $i++){
                
                $aux['info']['id_act'] = $lis_actos[$i]['id_act'];
                $aux['info']['nombre'] = $lis_actos[$i]['nombre'];
                $aux['info']['clave'] = $lis_actos[$i]['clave'];
                $aux['info']['direccion'] = $lis_actos[$i]['direccion'];
                $aux['info']['lat'] = $lis_actos[$i]['lat'];
                $aux['info']['lng'] = $lis_actos[$i]['lng'];
                $aux['info']['fecha'] = strtotime($lis_actos[$i]['fecha_creado']);
                
                $aux['info']['fecha_fin'] = 0;
                $aux['info']['id_cue'] = $lis_actos[$i]['id_cue'];
                
                $cias = $this->con->sql("SELECT t1.id_cia, t2.nombre FROM actos_cias t1, companias t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_cia=t2.id_cia");
                if($cias['count'] > 0){
                    for($j=0; $j<$cias['count']; $j++){
                        $aux_cias['id_cia'] = $cias['resultado'][$j]['id_cia'];
                        $aux_cias['nombre'] = $cias['resultado'][$j]['nombre'];
                        $aux_cias['acargo'] = "JUANITO PEREZ";
                        $aux_cias['cantidad'] = 12;
                        $aux['info']['cias'][] = $aux_cias;
                        unset($aux_cias);
                    }
                }
                
                $carros = $this->con->sql("SELECT t1.id_car, t2.nombre, t2.id_cia, t2.id_cue, t2.lat, t2.lng, t2.id_user FROM actos_carros t1, carros t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_car=t2.id_car");
                if($carros['count'] > 0){
                    
                    for($j=0; $j<$carros['count']; $j++){
                        
                        $aux_carros['id_car'] = $carros['resultado'][$j]['id_car'];
                        $aux_carros['nombre'] = $carros['resultado'][$j]['nombre'];
                        $aux_carros['id_cia'] = $carros['resultado'][$j]['id_cia'];
                        $aux_carros['id_cue'] = $carros['resultado'][$j]['id_cue'];
                        $aux_carros['conductor'] = "Roberto Ceballos";
                        $aux_carros['60'] = date("Y-m-d h:i:s");
                        $aux_carros['63'] = date("Y-m-d h:i:s");
                        $aux_carros['69'] = date("Y-m-d h:i:s");
                        $aux_carros['610'] = date("Y-m-d h:i:s");
                        
                        $aux_pos_carros['id'] = $carros['resultado'][$j]['id_user'];
                        $aux_pos_carros['lat'] = $carros['resultado'][$j]['lat'];
                        $aux_pos_carros['lng'] = $carros['resultado'][$j]['lng'];
                        $aux_pos_carros['icon'] = 1;
                        
                        $aux['info']['maquinas'] .= $carros['resultado'][$j]['nombre']." ";
                        
                        $aux['pos'][] =  $aux_pos_carros;
                        $aux['info']['carros'][] = $aux_carros;
                        unset($aux_carros);
                        unset($aux_pos_carros);
                        
                    }
                    
                }

                $voluntarios = $this->con->sql("SELECT t2.id_user, t2.nombre, t2.id_cia, t2.id_cue FROM actos_user t1, usuarios t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_user=t2.id_user");
                if($voluntarios['count'] > 0){
                    for($j=0; $j<$voluntarios['count']; $j++){
                        $aux_vol['id_user'] = $voluntarios['resultado'][$j]['id_user'];
                        $aux_vol['nombre'] = $voluntarios['resultado'][$j]['nombre'];
                        $aux_vol['cargo'] = "CAPITAN";
                        $aux_vol['antiguedad'] = 2134;
                        $aux_vol['id_cia'] = $voluntarios['resultado'][$j]['id_cia'];
                        $aux_vol['id_cue'] = $voluntarios['resultado'][$j]['id_cue'];
                        $aux['info']['voluntarios'][] = $aux_vol;
                        unset($aux_vol);
                    }
                }
                
                $aux['info']['grifos'] = $this->getgrifos($lis_actos[$i]['lat'], $lis_actos[$i]['lng']);
                $llamados[] = $aux;
                unset($aux);
            }
        }
        return $llamados;
        
    }
    private function getllamado($id){
        
        $fecha = date("Y-m-d h:i:s", strtotime("-1 day"));
        $actos = $this->con->sql("SELECT t1.id_act, t2.nombre, t2.clave, t1.direccion, t1.comuna, t1.lat, t1.lng, t1.id_cia, t1.fecha_creado FROM actos t1, claves t2 WHERE t1.id_act = '".$id."' AND t1.id_cla=t2.id_cla AND t2.tipo=1");

        if($actos['count'] > 0){
            
            $lis_actos = $actos['resultado'];
            $id_act = $lis_actos[0]['id_act'];
            
            $aux = array();
            $aux['info']['id_act'] = $lis_actos[0]['id_act'];
            $aux['info']['nombre'] = $lis_actos[0]['nombre'];
            $aux['info']['clave'] = $lis_actos[0]['clave'];
            $aux['info']['direccion'] = $lis_actos[0]['direccion'];
            $aux['info']['lat'] = $lis_actos[0]['lat'];
            $aux['info']['lng'] = $lis_actos[0]['lng'];
            $aux['info']['fecha'] = $lis_actos[0]['fecha_creado'];
            $aux['info']['fecha_fin'] = 0;
                
            $cias = $this->con->sql("SELECT t1.id_cia, t2.nombre FROM actos_cias t1, companias t2 WHERE t1.id_act='".$id_act."' AND t1.id_cia=t2.id_cia");
            if($cias['count'] > 0){
                    
                $lis_cias = $cias['resultado'];
                for($j=0; $j<$cias['count']; $j++){

                    $aux_cias['id_cia'] = $lis_cias[$j]['id_cia'];
                    $aux_cias['nombre'] = $lis_cias[$j]['nombre'];
                    $aux_cias['acargo'] = "JUANITO PEREZ";
                    $aux_cias['cantidad'] = 12;
                    $aux['cias'][] = $aux_cias;
                    unset($aux_cias);
                }

            }
                
            $carros = $this->con->sql("SELECT t1.id_car, t2.nombre FROM actos_carros t1, carros t2 WHERE t1.id_act='".$id_act."' AND t1.id_car=t2.id_car");
            if($carros['count'] > 0){

                $lis_carros = $carros['resultado'];
                for($j=0; $j<$carros['count']; $j++){

                    $aux_carros['id_car'] = $lis_carros[$j]['id_car'];
                    $aux_carros['nombre'] = $lis_carros[$j]['nombre'];
                    $aux_carros['id_cia'] = $lis_carros[$j]['id_cia'];
                    $aux_carros['id_cue'] = $lis_carros[$j]['id_cue'];
                    $aux_carros['conductor'] = "Roberto Ceballos";
                    $aux_carros['60'] = date("Y-m-d h:i:s");
                    $aux_carros['63'] = date("Y-m-d h:i:s");
                    $aux_carros['69'] = date("Y-m-d h:i:s");
                    $aux_carros['610'] = date("Y-m-d h:i:s");
                    $aux['carros'][] = $aux_carros;
                    unset($aux_carros);

                }

            }
                
            $voluntarios = $this->con->sql("SELECT t2.id_user, t2.nombre, t2.id_cia, t2.id_cue FROM actos_user t1, usuarios t2 WHERE t1.id_act='".$id_act."' AND t1.id_user=t2.id_user");
            if($voluntarios['count'] > 0){

                $lis_user = $voluntarios['resultado'];
                for($j=0; $j<$voluntarios['count']; $j++){

                    $aux_vol['id_user'] = $lis_user[$j]['id_user'];
                    $aux_vol['nombre'] = $lis_user[$j]['nombre'];
                    $aux_vol['cargo'] = "CAPITAN";
                    $aux_vol['antiguedad'] = 2134;
                    $aux_vol['id_cia'] = $lis_user[$j]['id_cia'];
                    $aux_vol['id_cue'] = $lis_user[$j]['id_cue'];
                    $aux['voluntarios'][] = $aux_vol;
                    unset($aux_vol);

                }

            }else{
                $aux['voluntarios'] = array();
            }
                
            $aux['grifos'] = $this->getgrifos($lis_actos[$i]['lat'], $lis_actos[$i]['lng']);

            $return[] = $aux;
            unset($aux);

            
        }
        
        return $return;
        
    }
    private function getasistencia(){
        
        $id_cia = $_GET["id_cia"];
        $id_cue = $_GET["id_cue"];
        $id_act = $_GET["id_act"];

        
        $users = $this->con->sql("SELECT t1.id_user, t1.nombre, t2.id_act FROM usuarios t1 LEFT JOIN actos_user t2 ON t1.id_user=t2.id_user AND t1.id_cia='1' AND t1.id_cue='1' AND t2.id_act='1'");
        
        echo "<pre>";
        print_r($users);
        echo "</pre>";
        
        for($i=0; $i<$users['count']; $i++){
            
            $aux['id'] = $users['resultado'][$i]['id_user'];
            $aux['nombre'] = $users['resultado'][$i]['nombre'];
            $aux['checked'] = true;
            $aux['disabled'] = false;
            $aux2[] = $aux;
            unset($aux);
            
        }
        
        return $aux2;
        
    }
    // LO DEJO POR ACA//
    public function diffs($time1, $time2){
        
        $res = "Hace: ";
        $diff = $time1 - $time2;
        
        if($diff < 60){
            $res .= "menos de 1 minuto";
        }
        if($diff > 60 && $diff < 120){
            $res .= "1 minuto";
        }
        if($diff > 120 && $diff < 3600){
            $minutos = floor($diff/60);
            $res .= $minutos." minutos";
        }
        if($diff > 3600){
            $horas = floor($diff/3600);
            $res .= $horas;
            if($horas == 1){
                $res .= " hora";
            }else{
                $res .= " horas";
            }
            $mins = $diff - ($horas * 3600);
            if($mins > 60){
                $m = floor($mins/60);
                $res .= " ".$m." minutos";
            }
        }
        return $res;
        
    }
    
}

?>