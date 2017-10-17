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
        
        // NODEJS START INFO//
        if($_POST['accion'] == "get_nodejs_llamados"){
            return $this->get_nodejs_llamados();
        }
        if($_POST['accion'] == "get_nodejs_cuarteles"){
            return $this->get_nodejs_cuarteles();
        }
        if($_POST['accion'] == "get_nodejs_usuarios"){
            return $this->get_nodejs_usuarios();
        }
        // NODEJS START INFO//
        
        
        
        
        
        if($_POST['accion'] == "getasistencia"){
            return $this->getasistencia();
        }
        if($_POST['accion'] == "setasistencia"){
            return $this->setasistencia();
        }
        if($_GET['accion'] == "getGrifos"){
            return $this->getgrifos($_GET['lat'], $_GET['lng']);
        }
        
        if($_POST['accion'] == "getcitaciones"){
            return $this->getcitaciones();
        }
        if($_POST['accion'] == "getperfil"){
            return $this->getperfil();
        }
        if($_GET['accion'] == "getLlamado"){
            return $this->getllamado($_GET['id']);
        }
        if($_POST['accion'] == "find_user"){
            return $this->find_user();
        }
        if($_POST['accion'] == "setlibro"){
            return $this->setlibro();
        }
    }
    
    private function get_nodejs_llamados(){
        
        if($_POST['code'] != $this->secret){
            return;
        }
        
        $fecha = date("Y-m-d h:i:s", strtotime("-15 day"));
        $actos = $this->con->sql("SELECT t1.id_act, t2.nombre, t2.clave, t1.direccion, t1.lat, t1.lng, t1.fecha_creado, t1.id_cue FROM actos t1, claves t2 WHERE t1.fecha_creado >= '".$fecha."' AND t1.id_cla=t2.id_cla AND t2.tipo=1");
        
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
                $aux['info']['fin'] = $lis_actos[$i]['fin'];;
                $aux['info']['id_cue'] = $lis_actos[$i]['id_cue'];
                
                $cias = $this->con->sql("SELECT t2.id_cia, t2.nombre, t2.id_cue FROM actos_cias t1, companias t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_cia=t2.id_cia");
                if($cias['count'] > 0){
                    for($j=0; $j<$cias['count']; $j++){
                        $aux_cias['id_cia'] = $cias['resultado'][$j]['id_cia'];
                        $aux_cias['nombre'] = $cias['resultado'][$j]['nombre'];
                        $aux_cias['id_cue'] = $cias['resultado'][$j]['id_cue'];
                        $aux['info']['cias'][] = $aux_cias;
                        unset($aux_cias);
                    }
                }
                
                $carros = $this->con->sql("SELECT t1.id_car, t2.nombre, t2.id_cia, t2.id_cue, t2.cantidad, t2.id_user, t2.cantidad FROM actos_carros t1, carros t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_car=t2.id_car");
                if($carros['count'] > 0){
                    for($j=0; $j<$carros['count']; $j++){
                        $aux['info']['infomaq'][] = $carros['resultado'][$j]['nombre'];
                        $aux_carros['id_car'] = $carros['resultado'][$j]['id_car'];
                        $aux_carros['nombre'] = $carros['resultado'][$j]['nombre'];
                        $aux_carros['id_cia'] = $carros['resultado'][$j]['id_cia'];
                        $aux_carros['id_cue'] = $carros['resultado'][$j]['id_cue'];
                        if($carros['resultado'][$j]['id_user'] != 0){
                            $sql_user = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$carros['resultado'][$j]['id_user']."'");
                            $aux_carros['id_user'] = $carros['resultado'][$j]['id_user'];
                            $aux_carros['nombre'] = $sql_user['resultado'][0]['nombre'];
                        }
                        $aux_carros['cantidad'] = $carros['resultado'][$j]['cantidad'];
                        $aux['info']['carros'][] = $aux_carros;
                        unset($aux_carros);
                    }
                }
                 
                $voluntarios = $this->con->sql("SELECT * FROM actos_user t1, usuarios t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_user=t2.id_user");
                if($voluntarios['count'] > 0){
                    for($j=0; $j<$voluntarios['count']; $j++){

                        $aux_voluntarios['id_user'] = $voluntarios['resultado'][$j]['id_user'];
                        $aux_voluntarios['nombre'] = $voluntarios['resultado'][$j]['nombre'];
                        $aux_voluntarios['id_cia'] = $voluntarios['resultado'][$j]['id_cia'];
                        $aux_voluntarios['id_cue'] = $voluntarios['resultado'][$j]['id_cue'];
                        $aux_voluntarios['pos_cia'] = $voluntarios['resultado'][$j]['pos_cia'];
                        $aux_voluntarios['pos_cue'] = $voluntarios['resultado'][$j]['pos_cue'];
                        
                        $aux['info']['voluntarios'][] = $aux_carros;
                        unset($aux_carros);
                    }
                }
                
                $aux['info']['maquinas'] = implode(" ", $aux['info']['infomaq']);
                $aux['info']['grifos'] = $this->getgrifos($lis_actos[$i]['lat'], $lis_actos[$i]['lng']);
                $aux['posiciones'] = array();
                
                $llamados[] = $aux;
                unset($aux);
            }
        }
        return $llamados;
        
    }
    private function get_nodejs_cuarteles(){
        
        if($_POST['code'] != $this->secret){
            return;
        }
        
        $cias = $this->con->sql("SELECT * FROM companias WHERE eliminado='0'");
        
        if($cias['count'] > 0){
            $lis_cias = $cias['resultado'];
            for($i=0; $i<$cias['count']; $i++){
                
                $aux['id_cia'] = $lis_cias[$i]['id_cia'];
                $aux['nombre'] = $lis_cias[$i]['nombre'];
                $aux['lat'] = $lis_cias[$i]['lat'];
                $aux['lng'] = $lis_cias[$i]['lng'];
                $aux['id_cue'] = $lis_cias[$i]['id_cue'];
                $aux['voluntarios'] = array();
                
                $rcias[] = $aux;
                unset($aux);
            }
        }
        return $rcias;
        
    }
    private function get_nodejs_usuarios(){
        
        if($_POST['code'] != $this->secret){
            return;
        }
        
        $users = $this->con->sql("SELECT * FROM usuarios WHERE eliminado='0'");
        
        if($users['count'] > 0){
            $lis_user = $users['resultado'];
            for($i=0; $i<$users['count']; $i++){
                
                $aux['id_user'] = $lis_user[$i]['id_user'];
                $aux['hash'] = $lis_user[$i]['hash'];
                $aux['nombre'] = $lis_user[$i]['nombre'];
                $aux['id_cia'] = $lis_user[$i]['id_cia'];
                $aux['id_cue'] = $lis_user[$i]['id_cue'];
                $aux['pos_cia'] = $lis_user[$i]['pos_cia'];
                $aux['pos_cue'] = $lis_user[$i]['pos_cue'];
                $aux['date'] = 0;
                $aux['id_act'] = 0;
                $aux['id_cua'] = 0;
                $aux['id_car'] = 0;
                $aux['act_pendiente'] = 0;
                $aux['cua_pendiente'] = 0;                
                
                $ruser[] = $aux;
                unset($aux);
            }
        }
        return $ruser;
        
    }
    
    
    
    private function find_user(){
        
        $id = $_POST["id"];
        $hash = $_POST["hash"];
        $sql = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id."'");
        if($sql['resultado'][0]['hash'] == $hash){
            $aux['op'] = 1;
            $aux['nombre'] = $sql['resultado'][0]['nombre'];
            $aux['id_cia'] = $sql['resultado'][0]['id_cia'];
            $aux['id_cue'] = $sql['resultado'][0]['id_cue'];
            $aux['pos_cia'] = 1;
            $aux['pos_cue'] = 1;
        }
        return $aux;
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
    private function getcitaciones(){
        
        $fecha = date("Y-m-d h:i:s", strtotime("-1 day"));
        $id_cia = $_POST["id_cia"];
        $id_cue = $_POST["id_cue"];
        
        $actos = $this->con->sql("SELECT t1.id_act, t2.nombre, t1.direccion, t1.fecha_creado, t2.todos, t2.id_gru, t1.lat, t1.lng FROM actos t1, claves t2 WHERE t1.fecha_creado >= '".$fecha."' AND t1.id_cla=t2.id_cla AND t2.tipo=3 AND t1.id_cue='".$id_cue."' AND (t1.id_cia='".$id_cia."' OR (t1.id_cia='0' AND t2.iscia='0'))");
        for($i=0; $i<$actos['count']; $i++){
            $aux['id'] = $actos['resultado'][$i]['id_act'];
            $aux['titulo'] = $actos['resultado'][$i]['nombre'];
            $aux['direccion'] = $actos['resultado'][$i]['direccion'];
            $aux['fecha'] = $actos['resultado'][$i]['fecha_creado'];
            $aux['vestuario'] = "Sport Formal";
            $aux['user'][] = array();
            $aux2[] = $aux;
            unset($aux);
        }
        
        return $aux2;
        
    }
    
    private function getperfil(){
        
        $id_user = $_POST["id_user"];
        $code = $_POST["id_user"];
        
        $perfil = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id_user."'");
        $aux['db'] = $perfil;
        $aux['nombre'] = $perfil['resultado'][0]['nombre'];
        $aux['edad'] = 33;
        $aux['telefono'] = "+56966166923";
        $aux['correo'] = $perfil['resultado'][0]['correo'];
        $aux['antiguedad'] = 2067;
        $aux['cargo'] = "Capitan";
        
        if($code == $perfil['resultado'][0]['code_app']){
            
            // MI PERFIL
            
        }else{
            
            // OTRO PERFIL
            
        }
        return $aux;
        
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
        
        $id_cia = $_POST["id_cia"];
        $id_cue = $_POST["id_cue"];
        $id_act = $_POST["id_act"];

        $users = $this->con->sql("SELECT t1.id_user, t1.nombre, t2.id_act FROM usuarios t1 LEFT JOIN actos_user t2 ON t1.id_user=t2.id_user AND t2.id_act='".$id_act."' WHERE t1.id_cia='".$id_cia."' AND t1.id_cue='".$id_cue."'");
        
        for($i=0; $i<$users['count']; $i++){
            
            $aux['id'] = $users['resultado'][$i]['id_user'];
            $aux['nombre'] = $users['resultado'][$i]['nombre'];
            if($users['resultado'][$i]['id_act'] == $id_act){
                $aux['checked'] = true;
            }else{
                $aux['checked'] = false;
            }
            $aux['disabled'] = false;
            $aux2[] = $aux;
            unset($aux);
            
        }
        return $aux2;
        
    }
    private function setasistencia(){
        
        $id_user = $_POST["id_user"];
        $id_act = $_POST["id_act"];
        $asist = $_POST["asist"];
        $aux = $this->con->sql("SELECT * FROM  actos_user WHERE id_act='".$id_act."' AND id_user='".$id_user."'");
        
        if($aux['count'] == 0 && $asist == "true"){
            $this->con->sql("INSERT INTO actos_user (id_act, id_user) VALUES ('".$id_act."', '".$id_user."')");
        }
        if($aux['count'] == 1 && $asist == "false"){
            $this->con->sql("DELETE FROM actos_user WHERE id_act='".$id_act."' AND id_user='".$id_user."'");
        }
        
        return $info;
        
    }
    private function setlibro(){
        
        $id_user = $_POST["id_user"];
        $id_act = $_POST["id_act"];
        $text = $_POST["text"];

        $this->con->sql("INSERT INTO actos_libros (id_act, id_user, text) VALUES ('".$id_act."', '".$id_user."', '".$text."')");
        
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