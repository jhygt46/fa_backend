<?php
session_start();
date_default_timezone_set('America/Santiago');
set_time_limit(0);

require_once $path_class."core.php";

class Services extends Core{
    
    public $secure = true;
    public $con = null;
    public $id_cia = null;
    public $id_cue = null;
    public $secret = "m^.&2rQb48EU-K9GV_4et<L@CF^JCa[9wxwBD8+f";
    
    public function __construct(){
        
        $this->id_cia = $this->getciaid();
        $this->id_cue = $this->getcueid();
        $this->con = new Conexion();
        
    }

    public function app(){
        
        $json = json_decode(file_get_contents('php://input'), true);
        $accion = $json["accion"];
        
        if($accion == "init"){
            return $this->init($json['id_user'], $json['code'], $json['data']);
        }
        if($accion == "getasistencia"){
            return $this->getasistencia($json['id_user'], $json['code']);
        }
        if($accion == "setasistencia"){
            return $this->setasistencia($json['id_user'], $json['code'], $json['id_act'], $json['id_vol'], $json['asist']);
        }
        if($accion == "perfil_ext1"){
            return $this->perfil_ext($json['id_user'], $json['code'], $json['id'], 1);
        }
        if($accion == "perfil_ext2"){
            return $this->perfil_ext($json['id_user'], $json['code'], $json['id'], 2);
        }
        if($accion == "getlibro"){
            return $this->getlibro($json['id_user'], $json['code'], $json['id_act']);
        }
        if($accion == "setlibro"){
            return $this->setlibro($json['id_user'], $json['code'], $json['id_act'], $json['libro']);
        }
        if($accion == "getinforme"){
            return $this->getinforme($json['id_user'], $json['code'], $json['id_act']);
        }
        if($_POST['accion'] == "getinforme"){
            return $this->getinforme(18, '86fb015faae20b5ea7cab3835ea50ec0', 1);
        }
        if($accion == "setinforme"){
            return $this->setinforme($json);
        }
        if($_POST['accion'] == "setinforme"){
            return $this->setinforme($_POST);
        }
        if($accion == "getcitaciones"){
            return $this->getcitaciones($json['id_user'], $json['code']);
        }
        if($accion == "getcitacion"){
            return $this->getcitacion($json['id_user'], $json['code'], $json['id_act'], $json['tipo']);
        }
        if($accion == "getultimosactos"){
            return $this->getultimosactos($json['id_user'], $json['code']);
        }
        if($accion == "setpublicgroups"){
            return $this->setpublicgroups($json['id_user'], $json['code'], $json['id_gru'], $json['valor']);
        }
        if($accion == "getgrupos"){
            return $this->getgrupos($json['id_user'], $json['code']);
        }
        if($accion == "setconfig"){
            return $this->setconfig($json['id_user'], $json['code'], $json['tipo'], $json['value']);
        }
        if($accion == "getconfig"){
            return $this->getconfig($json['id_user'], $json['code']);
        }
        if($accion == "getguardia"){
            return $this->getguardia($json['id_user'], $json['code']);
        }
        if($accion == "buscarreemplazogn"){
            return $this->buscarreemplazogn($json['id_user'], $json['code'], $json['id_gua']);
        }
        if($accion == "setpermisogn"){
            return $this->setpermisogn($json['id_user'], $json['code'], $json['id_gua']);
        }
        if($accion == "rmpermisogn"){
            return $this->rmpermisogn($json['id_user'], $json['code'], $json['id_gua']);
        }
        if($accion == "rmbuscarreemplazogn"){
            return $this->rmbuscarreemplazogn($json['id_user'], $json['code'], $json['id_gua']);
        }
        
        
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
        
        // NODEJS ACTUALIZAR INFO //
        if($_POST['accion'] == "find_llamado"){
            return $this->find_llamado();
        }
        // NODEJS ACTUALIZAR INFO //
        
        if($_GET['accion'] == "getGrifos"){
            return $this->getgrifos($_GET['lat'], $_GET['lng']);
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
    // START NODEJS FUNCTION //
    private function get_nodejs_llamados(){
        
        if($_POST['code'] != $this->secret){
            //return;
        }
        
        $fecha = date("Y-m-d h:i:s", strtotime("-15 day"));
        $actos = $this->con->sql("SELECT t1.id_act, t2.nombre, t2.clave, t1.direccion, t1.lat, t1.lng, t1.fecha_creado, t1.id_cue FROM actos t1, claves t2 WHERE t1.fecha_creado >= '".$fecha."' AND t1.id_cla=t2.id_cla AND (t2.tipo=1 OR t2.tipo=2)");
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
                $aux['info']['fin'] = $lis_actos[$i]['fin'];
                $aux['info']['id_cue'] = $lis_actos[$i]['id_cue'];
                
                $aux['posiciones'] = array();
                
                $cias = $this->con->sql("SELECT t2.id_cia, t2.nombre, t2.id_cue FROM actos_cias t1, companias t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_cia=t2.id_cia ORDER BY t2.numero");
                if($cias['count'] > 0){
                    for($j=0; $j<$cias['count']; $j++){
                        $aux_cias['id_cia'] = $cias['resultado'][$j]['id_cia'];
                        $aux_cias['nombre'] = $cias['resultado'][$j]['nombre'];
                        $aux_cias['id_cue'] = $cias['resultado'][$j]['id_cue'];
                        $aux_cias['checked'] = 0;
                        $aux['info']['cias'][] = $aux_cias;
                        unset($aux_cias);
                    }
                }
                
                $carros = $this->con->sql("SELECT t2.id_car, t2.nombre, t2.id_user, t2.id_cia, t2.id_cue, t2.lat, t2.lng FROM actos_carros t1, carros t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_car=t2.id_car");
                if($carros['count'] > 0){
                    for($j=0; $j<$carros['count']; $j++){
                        $infomaquinas[] = $carros['resultado'][$j]['nombre'];
                        $aux_carros['id_car'] = $carros['resultado'][$j]['id_car'];
                        $aux_carros['nombre'] = $carros['resultado'][$j]['nombre'];
                        $aux_carros['id_cia'] = $carros['resultado'][$j]['id_cia'];
                        $aux_carros['id_cue'] = $carros['resultado'][$j]['id_cue'];
                        
                        if($carros['resultado'][$j]['id_user'] != 0){
                            $aux_pos['id_user'] = $carros['resultado'][$j]['id_user'];
                            $aux_pos['nombre'] = $carros['resultado'][$j]['nombre'];
                            $aux_pos['lat'] = $carros['resultado'][$j]['lat'];
                            $aux_pos['lng'] = $carros['resultado'][$j]['lng'];
                            $aux_pos['icon'] = 1;
                            $aux_pos['id_cia'] = $carros['resultado'][$j]['id_cia'];
                            $aux_pos['id_cue'] = $carros['resultado'][$j]['id_cue'];
                            $aux['posiciones'][] = $aux_pos;
                            unset($aux_pos);
                        }
                        
                        $aux['info']['carros'][] = $aux_carros;
                        unset($aux_carros);
                    }
                    $aux['info']['maquinas'] = implode(" ", $infomaquinas);
                }
                
                $voluntarios = $this->con->sql("SELECT t2.id_user, t2.nombre, t2.id_cia, t2.id_cue, t2.pos_cia, t2.pos_cue FROM actos_user t1, usuarios t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_user=t2.id_user");
                if($voluntarios['count'] > 0){
                    for($j=0; $j<$voluntarios['count']; $j++){

                        $aux_voluntarios['id_user'] = $voluntarios['resultado'][$j]['id_user'];
                        $aux_voluntarios['nombre'] = $voluntarios['resultado'][$j]['nombre'];
                        $aux_voluntarios['id_cia'] = $voluntarios['resultado'][$j]['id_cia'];
                        $aux_voluntarios['id_cue'] = $voluntarios['resultado'][$j]['id_cue'];
                        $aux_voluntarios['pos_cia'] = $voluntarios['resultado'][$j]['pos_cia'];
                        $aux_voluntarios['pos_cue'] = $voluntarios['resultado'][$j]['pos_cue'];
                        
                        $aux['voluntarios'][] = $aux_voluntarios;
                        unset($aux_voluntarios);
                    }
                }else{
                    $aux['voluntarios'] = array();
                }
                
                
                $aux['info']['grifos'] = $this->getgrifos($lis_actos[$i]['lat'], $lis_actos[$i]['lng']);
                $llamados[] = $aux;
                unset($aux);
            }
        }
        return $llamados;
        
    }
    private function get_nodejs_cuarteles(){
        
        if($_POST['code'] != $this->secret){
            //return;
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
                
                $vols = $this->con->sql("SELECT * FROM usuarios WHERE id_cua='".$lis_cias[$i]['id_cia']."' AND id_cue='".$lis_cias[$i]['id_cue']."'");
                if($vols['count'] > 0){
                    for($j=0; $j<$vols['count']; $j++){
                        
                        $aux_vols['id_user'] = $vols['resultado'][$j]['id_user'];
                        $aux_vols['nombre'] = $vols['resultado'][$j]['nombre'];
                        $aux_vols['id_cia'] = $vols['resultado'][$j]['id_cia'];
                        $aux_vols['id_cue'] = $vols['resultado'][$j]['id_cue'];
                        $aux_vols['estado'] = "En Cuartel";
                        $aux_vols['distancia'] = 0;
                        if($vols['resultado'][$j]['id_cia'] == $lis_cias[$i]['id_cia']){
                            $aux_vols['pos_cia'] = $vols['resultado'][$j]['pos_cia'];
                        }else{
                            $aux_vols['pos_cia'] = 0;
                        }
                        $aux['voluntarios'][] = $aux_vols;
                        unset($aux_vols);
                        
                    }
                }else{
                    $aux['voluntarios'] = array();
                }
                $rcias[] = $aux;
                unset($aux);
            }
        }
        return $rcias;
        
    }
    private function get_nodejs_usuarios(){
        
        if($_POST['code'] != $this->secret){
            //return;
        }
        
        $users = $this->con->sql("SELECT * FROM usuarios WHERE eliminado='0'");
        
        if($users['count'] > 0){
            $lis_user = $users['resultado'];
            for($i=0; $i<$users['count']; $i++){
                
                $sql2 = $this->con->sql("SELECT id_car FROM carros WHERE id_user='".$lis_user[$i]['id_user']."'");
                if($sql2['count'] == 1){
                    $aux['id_car'] = $sql2['resultado'][0]['id_car'];
                }else{
                    $aux['id_car'] = 0;
                }
                
                $aux['clave63'] = false;
                $aux['clave69'] = false;
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
                $aux['act_pendiente'] = 0;
                $aux['cua_pendiente'] = 0;
                $aux['autocuartel'] = 0;
                
                $ruser[] = $aux;
                unset($aux);
            }
        }
        return $ruser;
        
    }
    
    // CREAR ACTUALIZAR NODEJS //
    private function find_llamado(){
        
        if($_POST['code'] != $this->secret){
            return;
        }
        
        $id_act = $_POST['id_act'];
        $acto = $this->con->sql("SELECT t1.id_act, t2.nombre, t2.clave, t1.direccion, t1.lat, t1.lng, t1.fecha_creado, t1.id_cue FROM actos t1, claves t2 WHERE t1.id_act='".$id_act."' AND t1.id_cla=t2.id_cla AND (t2.tipo=1 OR t2.tipo=2)");
        
        if($acto['count'] == 1){
            
            $aux['info']['id_act'] = $acto['resultado'][0]['id_act'];
            $aux['info']['nombre'] = $acto['resultado'][0]['nombre'];
            $aux['info']['clave'] = $acto['resultado'][0]['clave'];
            $aux['info']['direccion'] = $acto['resultado'][0]['direccion'];
            $aux['info']['lat'] = $acto['resultado'][0]['lat'];
            $aux['info']['lng'] = $acto['resultado'][0]['lng'];
            $aux['info']['fecha'] = strtotime($acto['resultado'][0]['fecha_creado']);
            $aux['info']['fin'] = $acto['resultado'][0]['fin'];;
            $aux['info']['id_cue'] = $acto['resultado'][0]['id_cue'];
            
            $aux['posiciones'] = array();
            
            $cias = $this->con->sql("SELECT t2.id_cia, t2.nombre, t2.id_cue FROM actos_cias t1, companias t2 WHERE t1.id_act='".$acto['resultado'][0]['id_act']."' AND t1.id_cia=t2.id_cia");
            if($cias['count'] > 0){
                for($j=0; $j<$cias['count']; $j++){
                    $aux_cias['id_cia'] = $cias['resultado'][$j]['id_cia'];
                    $aux_cias['nombre'] = $cias['resultado'][$j]['nombre'];
                    $aux_cias['id_cue'] = $cias['resultado'][$j]['id_cue'];
                    $aux_cias['checked'] = 0;
                    $aux['info']['cias'][] = $aux_cias;
                    unset($aux_cias);
                }
            }
            
            $carros = $this->con->sql("SELECT t2.id_car, t2.id_user, t2.nombre, t2.id_cia, t2.id_cue, t2.lat, t2.lng FROM actos_carros t1, carros t2 WHERE t1.id_act='".$acto['resultado'][0]['id_act']."' AND t1.id_car=t2.id_car");
            if($carros['count'] > 0){
                for($j=0; $j<$carros['count']; $j++){
                    
                    $infomaquinas[] = $carros['resultado'][$j]['nombre'];
                    $aux_carros['id_car'] = $carros['resultado'][$j]['id_car'];
                    $aux_carros['nombre'] = $carros['resultado'][$j]['nombre'];
                    $aux_carros['id_cia'] = $carros['resultado'][$j]['id_cia'];
                    $aux_carros['id_cue'] = $carros['resultado'][$j]['id_cue'];
                    
                    if($carros['resultado'][$j]['id_user'] != 0){    
                        $aux_pos['id_user'] = $carros['resultado'][$j]['id_user'];
                        $aux_pos['nombre'] = $carros['resultado'][$j]['nombre'];
                        $aux_pos['lat'] = $carros['resultado'][$j]['lat'];
                        $aux_pos['lng'] = $carros['resultado'][$j]['lng'];
                        $aux_pos['icon'] = 1;
                        $aux_pos['id_cia'] = $carros['resultado'][$j]['id_cia'];
                        $aux_pos['id_cue'] = $carros['resultado'][$j]['id_cue'];
                        $aux['posiciones'][] = $aux_pos;
                        unset($aux_pos);
                    }
                    
                    $aux['info']['carros'][] = $aux_carros;
                    unset($aux_carros);
                }
                $aux['info']['maquinas'] = implode(" ", $infomaquinas);
            }
            $aux['info']['grifos'] = $this->getgrifos($acto['resultado'][0]['lat'], $acto['resultado'][0]['lng']);
            return $aux;
            
        }
        
    }
    private function find_user(){
        
        if($_POST['code'] != $this->secret){
            return;
        }
        
        $id_user = $_POST['id_user'];

        $sql = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id_user."'");

        if($sql['count'] == 1){
            
            $sql2 = $this->con->sql("SELECT id_car FROM carros WHERE id_user='".$id_user."'");
            if($sql2['count'] == 1){
                $aux['id_car'] = $sql2['resultado'][0]['id_car'];
                
            }else{
                $aux['id_car'] = 0;
            }
            
            $aux['id_user'] = $sql['resultado'][0]['id_user'];
            $aux['clave63'] = false;
            $aux['clave69'] = false;
            $aux['op'] = 1;
            $aux['nombre'] = $sql['resultado'][0]['nombre'];
            $aux['id_cia'] = $sql['resultado'][0]['id_cia'];
            $aux['id_cue'] = $sql['resultado'][0]['id_cue'];
            $aux['hash'] = $sql['resultado'][0]['hash'];
            $aux['pos_cia'] = 1;
            $aux['pos_cue'] = 1;
            
            return $aux;
            
        }
        
    }
    
    
    public function login_app(){

        $json = json_decode(file_get_contents('php://input'), true);
        $correo = $json["email"];
        $pass = $json["pass"];
        
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $sql = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$correo."'");
            if($sql['count'] == 0){
                // CORREO NO SE ENCUENTERA EN LA BASE DE DATOS
                $info['op'] = 2;
                $info['message'] = "Usuario no existe";
            }
            if($sql['count'] == 1){
                $id_user = $sql['resultado'][0]['id_user'];
                $bloqueado = $sql['resultado'][0]['bloqueado'];
                if($bloqueado == 1){
                    $fecha_block = $sql['resultado'][0]['fecha_bloqueado'];
                    if(strtotime($fecha_block) + 86400 < time()){
                        $info['op'] = 2;
                        $info['message'] = "Usuario bloqueado";
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
                        $info['code'] = $code;
                        $info['cant'] = $sql['resultado'][0]['cant'];
                        $this->con->sql("UPDATE usuarios SET code_app='".$code."' WHERE id_user='".$id_user."'");
                    }else{
                        $intentos = $sql['resultado'][0]['intentos'] + 1;
                        $this->con->sql("UPDATE usuarios SET intentos='".$intentos."' WHERE id_user='".$id_user."'");
                        if($intentos >= 10){
                            $this->con->sql("UPDATE usuarios SET bloqueado='1', fecha_bloqueado='".date('Y-m-d H:i:s')."' WHERE id_user='".$id_user."'");
                            $info['op'] = 2;
                            $info['message'] = "Usuario bloqueado";
                        }else{
                            $info['op'] = 2;
                            $info['message'] = "Password inválida";
                        }
                    }
                }
            }
        }else{
            $info['op'] = 2;
            $info['message'] = "Correo inválido";
        }
        return $info;
        
    }
    private function getgrifos($lat, $lng){
        
        $coords = $this->getBoundaries($lat, $lng, 10);
        $grifos = $this->con->sql("SELECT lat, lng FROM grifos WHERE lat>='".$coords["min_lat"]."' AND lat<='".$coords["max_lat"]."' AND lng>='".$coords["max_lng"]."' AND lng<='".$coords["min_lng"]."'");
        if($grifos['count'] > 0){
            
            for($i=0; $i<$grifos['count']; $i++){
                $points[] = $grifos['resultado'][$i]['lat'].",".$grifos['resultado'][$i]['lng'];
                $aux2['lat'] = $grifos['resultado'][$i]['lat'];
                $aux2['lng'] = $grifos['resultado'][$i]['lng'];
                $aux2['distancia'] = "";
                $aux[] = $aux2;
                unset($aux2);
            }
            $dist = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?mode=walking&origins=".implode("|", $points)."&destinations=".$lat.",".$lng."&key=AIzaSyAq6hw0biMsUBdMBu5l-bai9d3sUI-f--g"));
            for($i=0; $i<count($dist->rows); $i++){
                $aux[$i]['distancia'] = $dist->rows[$i]->elements[0]->distance->value." mts";
                $aux[$i]['distanciaval'] = $dist->rows[$i]->elements[0]->distance->value;
            }
            usort($aux, function ($a, $b) {
                if ($a['distanciaval'] == $b['distanciaval']) {
                    return 0;
                }
                return ($a['distanciaval'] > $b['distanciaval']) ? -1 : 1;
            });
            
        }
        return $aux;
    }
    
    private function array_citacion($res){
        
        $aux['id'] = $res['id_act'];
        $aux['nombre'] = $res['nombre'];
        $aux['direccion'] = $res['direccion'];
        $aux['fecha'] = $res['fecha_creado'];
        $aux['vestuario'] = "Sport Formal";
        return $aux;
        
    }
    
    private function getconfig($id_user, $code){
        
        $in = $this->verificar_code($id_user, $code, false);
        if($in['op'] == 1){
            $user = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id_user."'");
            $info = $this->getgrupos($id_user, $code);
            $info['op'] = 1;
            $info['lla'] = $user['resultado'][0]['config_lla'];
            $info['med'] = $user['resultado'][0]['config_med'];
            
        }
        return $info;
    }
    
    private function getcitacion($id_user, $code, $id_act, $tipo){
        
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            
            $info['op'] = 1;
            $acto = $this->con->sql("SELECT t2.nombre, t1.lat, t1.lng, t1.direccion, t1.fecha_creado FROM actos t1, claves t2 WHERE t1.id_act='".$id_act."' AND t1.id_cla=t2.id_cla");
            $info['acto'] = $acto;
            if($tipo == 1){
                $info['clave'] = $acto['resultado'][0]['nombre'];
                $info['lat'] = $acto['resultado'][0]['lat'];
                $info['lng'] = $acto['resultado'][0]['lng'];
                $info['direccion'] = $acto['resultado'][0]['direccion'];
                $info['fecha'] = $acto['resultado'][0]['fecha_creado'];
            }
            if($tipo == 2){
                $usuarios = $this->con->sql("SELECT t2.id_user, t2.nombre FROM actos_user t1, usuarios t2 WHERE t1.id_act='".$id_act."' AND t1.id_user=t2.id_user");
                for($i=0; $i<$usuarios['count']; $i++){
                    $aux['id_user'] = $usuarios['resultados'][$i]['id_user'];
                    $aux['nombre'] = $usuarios['resultados'][$i]['nombre'];
                    $info['usuarios'][] = $aux;
                    unset($aux);
                }
            }
            
        }else{
            $info['op'] = 2;
        }
        
        return $info;
        
    }
    
    private function setconfig($id_user, $code, $tipo, $value){

        $in = $this->verificar_code($id_user, $code, false);
        
        if($in['op'] == 1){
            
            if($value){ $val=1; }else{ $val=0; }
            
            if($tipo == "gps"){
                // LLAMADO HORARIO GUARDIA
                $info['op'] = 1;
                $this->con->sql("UPDATE usuarios SET config_gps='".$val."' WHERE id_user='".$id_user."'");
            }
            if($tipo == "lla"){
                // LLAMADO HORARIO GUARDIA
                $info['op'] = 1;
                $this->con->sql("UPDATE usuarios SET config_lla='".$val."' WHERE id_user='".$id_user."'");
            }
            
            if($tipo == "med"){
                // LLAMADO HORARIO GUARDIA
                $info['op'] = 1;
                $this->con->sql("UPDATE usuarios SET config_med='".$val."' WHERE id_user='".$id_user."'");
            }
            
        }else{
            $info['op'] = 2;
        }
        
        return $info;
        
    }
    
    
    private function in_guardia($fecha, $id_user){
        
        $gn = $this->con->sql("SELECT * FROM guardia_users WHERE (id_user='".$id_user."' OR id_ree='".$id_user."') AND fecha='".$fecha."'");
        if($gn['count'] == 0){
            return false;
        }else{
            return true;
        }
        
    }
    
    
    private function buscarreemplazogn($id_user, $code, $id_gua){
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            $gn = $this->con->sql("SELECT * FROM guardia_users WHERE id_gua='".$id_gua."'");
            if($gn['count'] == 1){
                if($gn['resultado'][0]['id_cia'] == $in['user']['id_cia'] && $gn['resultado'][0]['id_cue'] == $in['user']['id_cue']){
                    if($gn['resultado'][0]['reemplazo'] == 0 && $id_user == $gn['resultado'][0]['id_user']){
                        $info['op'] = 1;
                        $this->con->sql("UPDATE guardia_users SET reemplazo='1' WHERE id_gua='".$id_gua."'");
                    }
                    if($gn['resultado'][0]['reemplazo'] == 1 && $id_user == $gn['resultado'][0]['id_ree']){
                        $info['op'] = 1;
                        $this->con->sql("UPDATE guardia_users SET ree_ree='1' WHERE id_gua='".$id_gua."'");
                    }
                }
            }
        }
        return $info;
    }
    private function setreemplazogn($id_user, $code, $id_gua){
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            $gn = $this->con->sql("SELECT * FROM guardia_users WHERE id_gua='".$id_gua."'");
            if($gn['count'] == 1){
                if($gn['resultado']['id_cia'] == $in['user']['id_cia'] && $gn['resultado']['id_cue'] == $in['user']['id_cue']){
                    if(!$this->in_guardia($gn['resultado']['fecha'], $id_user)){
                        if($gn['resultado']['reemplazo'] == 1){
                            if($gn['resultado']['id_ree'] == 0){
                                $this->con->sql("UPDATE guardia_users SET id_ree='".$id_user."', nombre_ree='".$gn['resultado']['nombre']."' WHERE id_gua='".$id_gua."'");
                            }
                            if($gn['resultado']['id_ree'] != 0 && $gn['resultado']['ree_ree'] == 1){
                                $this->con->sql("UPDATE guardia_users SET id_ree='".$id_user."', nombre_ree='".$gn['resultado']['nombre']."', ree_ree='0' WHERE id_gua='".$id_gua."'");
                            }
                        }
                    }
                }
            }
        }
        return $info;
    }
    private function rmbuscarreemplazogn($id_user, $code, $id_gua){
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            $gn = $this->con->sql("SELECT * FROM guardia_users WHERE id_gua='".$id_gua."'");
            if($gn['count'] == 1){
                if($gn['resultado']['id_cia'] == $in['user']['id_cia'] && $gn['resultado']['id_cue'] == $in['user']['id_cue']){
                    if($gn['resultado']['reemplazo'] == 1){
                        if($gn['resultado']['id_user'] == $id_user){
                            $this->con->sql("UPDATE guardia_users SET id_ree='0', nombre_ree='' WHERE id_gua='".$id_gua."'");
                        }
                        if($gn['resultado']['id_ree'] == $id_user){
                            $this->con->sql("UPDATE guardia_users SET ree_ree='0' WHERE id_gua='".$id_gua."'");
                        }
                    }
                }
            }
        }
        return $info;
    }
    private function rmpermisogn($id_user, $code, $id_gua){
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            $gn = $this->con->sql("SELECT * FROM guardia_users WHERE id_gua='".$id_gua."'");
            if($gn['count'] == 1){
                if($gn['resultado']['id_cia'] == $in['user']['id_cia'] && $gn['resultado']['id_cue'] == $in['user']['id_cue']){
                    if($gn['resultado']['permiso'] == 1){
                        if($gn['resultado']['id_user'] == $id_user || $gn['resultado']['id_ree'] == $id_user){
                            $this->con->sql("UPDATE guardia_users SET permiso='0', fecha_permiso='0000-00-00 00:00:00' WHERE id_gua='".$id_gua."'");
                            $info['op'] = 1;
                        }
                    }
                }
            }
        }
        return $info;
    }
    private function setpermisogn($id_user, $code, $id_gua){
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            $gn = $this->con->sql("SELECT * FROM guardia_users WHERE id_gua='".$id_gua."' AND (id_user='".$id_user."' OR id_ree='".$id_user."') AND id_cia='".$in['user']['id_cia']."' AND id_cue='".$in['user']['id_cue']."'");
            if($gn['count'] == 1){
                if($gn['resultado']['id_cia'] == $in['user']['id_cia'] && $gn['resultado']['id_cue'] == $in['user']['id_cue']){
                    if($gn['resultado']['permiso'] == 0){
                        if($gn['resultado']['id_user'] == $id_user || $gn['resultado']['id_ree'] == $id_user){
                            $info['date'] = date("Y-m-d H:i:s");
                            $this->con->sql("UPDATE guardia_users SET permiso='1', fecha_permiso='".$info['date']."' WHERE id_gua='".$id_gua."'");
                            $info['op'] = 1;
                        }
                    }
                }
            }
        }
        return $info;
    }
    private function solicitarrefuerzogn($id_user, $code, $fecha){
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            if(!$this->in_guardia($gn['resultado']['fecha'], $id_user)){
                $insert = $this->con->sql("INSERT INTO guardia_users (id_user, fecha, id_cia, id_cue) VALUES ('".$id_user."', '".$fecha."', '".$in['user']['id_cia']."', '".$in['user']['id_cue']."')");
                $info['op'] = 1;
                $info['id'] = $insert['insert_id'];
                $info['id_user'] = $id_user;
                $info['nombre'] = $in['user']['nombre'];
                $info['id_cia'] = $in['user']['id_cia'];
                $info['id_cue'] = $in['user']['id_cue'];
            }
        }
        return $info;
    }
    
    private function getguardia($id_user, $code){
        
        $diff2 = 999999999;
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            
                $info['num'] = 0;
                $info['jefe'] = true;
                
                $fecha = date("Y-m-d", strtotime("-3 day"));
                $guardia = $this->con->sql("SELECT t1.reemplazo, t1.fecha, t1.id_gua, t1.id_user, t2.nombre, t1.permiso, t1.fecha_permiso, t1.id_ree, t1.nombre_ree FROM guardia_users t1, usuarios t2 WHERE t1.id_user=t2.id_user AND t1.fecha >= '".$fecha."' AND t1.id_cia='".$in['user']['id_cia']."' AND t1.id_cue='".$in['user']['id_cue']."' ORDER BY t1.fecha");
                
                for($i=0; $i<$guardia['count']; $i++){
                    
                    $gn = $guardia['resultado'][$i];
                    $aux[$gn['fecha']]['fecha'] = $gn['fecha'];
                    $aux_vol['id'] = $gn['id_gua'];
                    $aux_vol['nombre'] = $gn['nombre'];
                    $aux_vol['id_user'] = $gn['id_user'];
                    $aux_vol['permiso'] = $gn['permiso'];
                    $aux_vol['fecha_permiso'] = $gn['fecha_permiso'];
                    $aux_vol['reemplazo'] = $gn['reemplazo'];
                    $aux_vol['id_ree'] = $gn['id_ree'];
                    $aux_vol['nombre_ree'] = $gn['nombre_ree'];
                    $aux_vol['ree_ree'] = $gn['ree_ree'];
                    $aux[$gn['fecha']]['voluntarios'][] = $aux_vol;
                    unset($aux_vol);
                    
                }
                $n=0; 
                foreach($aux as $key => $value){
                    
                    $diff = strtotime(date("d-m-Y H:i:s", time())) - strtotime($key);
                    
                    $aux2['fecha'] = $key;
                    $aux2['voluntarios'] = $value['voluntarios'];
                    
                    if($diff < $diff2){
                        
                        $diff2 = $diff;
                        $info['guardia'] = $aux2;
                        $info['num'] = $n;
                        
                    }
                    
                    $info['guardias'][] = $aux2;
                    $n++;
                    unset($aux2);
                    
                }

        }
        return $info;
    }
    
    private function setpublicgroups($id_user, $code, $id_gru, $valor){
        
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            $grupos = $this->con->sql("SELECT * FROM grupos WHERE id_gru='".$id_gru."' AND id_cia='".$in['user']['id_cia']."' AND id_cue='".$in['user']['id_cue']."' AND public='1' AND iscargo='0'");
            if($grupos['count'] == 1){
                $info['op'] = 1;
                if(!$valor){
                    $info['sql1'] = $this->con->sql("DELETE FROM grupos_usuarios WHERE id_gru='".$id_gru."' AND id_user='".$id_user."'");
                }else{
                    $info['sql1'] = $this->con->sql("INSERT INTO grupos_usuarios (id_gru, id_user) VALUES ('".$id_gru."', '".$id_user."')");
                } 
            }
            $info['grupos'] = $grupos;
        }
        return $info;
        
    }

    private function getgrupos($id_user, $code){
        
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            $grupos = $this->con->sql("SELECT t1.id_gru, t1.nombre, t2.id_user FROM grupos t1 LEFT JOIN grupos_usuarios t2 ON t1.id_gru=t2.id_gru AND t2.id_user='".$id_user."' WHERE t1.id_cia='".$in['user']['id_cia']."' AND t1.id_cue='".$in['user']['id_cue']."' AND t1.public='1' AND t1.iscargo='0'");
            for($i=0; $i<$grupos['count']; $i++){
                $aux['id'] = $grupos['resultado'][$i]['id_gru'];
                $aux['nombre'] = $grupos['resultado'][$i]['nombre'];
                if($grupos['resultado'][$i]['id_user'] == NULL){
                    $aux['in'] = false;
                }else{
                    $aux['in'] = true;
                }
                $info['grupos'][] = $aux;
                unset($aux);
            }
        }
        return $info;
        
    }
    
    private function getultimosactos($id_user, $code){
        
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            
            $actos = $this->con->sql("SELECT t1.fecha_creado, t2.tipo, t1.id_act, t2.clave, t2.nombre, t1.direccion, t3.id_user FROM (actos t1, claves t2) LEFT JOIN actos_user t3 ON t1.id_act=t3.id_act AND t3.id_user='".$id_user."' WHERE t1.id_cla=t2.id_cla AND t2.asist='1' AND t1.id_cue='".$in['user']['id_cue']."' AND (t1.id_cia='".$in['user']['id_cia']."' OR (t1.id_cia='0' AND t2.iscia='0'))");
            for($i=0; $i<$actos['count']; $i++){
            
                $aux['id'] = $actos['resultado'][$i]['id_act'];
                if($actos['resultado'][$i]['tipo'] == 1 || $actos['resultado'][$i]['tipo'] == 2){
                    $aux['clave'] = $actos['resultado'][$i]['clave'];
                }
                if($actos['resultado'][$i]['tipo'] == 3){
                    $aux['clave'] = $actos['resultado'][$i]['nombre'];
                }
                $aux['direccion'] = $actos['resultado'][$i]['direccion'];
                $aux['fecha'] = strtotime($actos['resultado'][$i]['fecha_creado'])*1000;
                $aux['asist'] = true;
                if($actos['resultado'][$i]['id_user'] == NULL){
                    $aux['asist'] = false;
                }
                $info['llamados'][] = $aux;
                unset($aux);
                
            }
        
        }
        return $info;
        
    }
    
    private function getcitaciones($id_user, $code){
        
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            
            $info['op'] = 1;
            $fecha = date("Y-m-d h:i:s", strtotime("-1 day"));
            $actos = $this->con->sql("SELECT t1.id_act, t1.fecha_creado, t2.id_cla, t2.clave, t2.nombre, t1.direccion, t1.lat, t1.lng, t2.todos FROM actos t1, claves t2 WHERE t1.id_cla=t2.id_cla AND t2.tipo=3 AND t1.fecha_creado >= '".$fecha."' AND t1.id_cue='".$in['user']['id_cue']."' AND (t1.id_cia='".$in['user']['id_cia']."' OR (t1.id_cia='0' AND t2.iscia='0'))");

            for($i=0; $i<$actos['count']; $i++){
                if($actos['resultado'][$i]['todos'] == 1){
                    $info['citaciones'][] = $this->array_citacion($actos['resultado'][$i]);
                }else{
                    $grupos = $this->con->sql("SELECT * FROM clave_grupo t1, grupos t2 WHERE t1.id_cla='".$actos['resultado'][$i]['id_cla']."' AND t1.id_gru=t2.id_gru");
                    for($i=0; $i<$grupos['count']; $i++){
                        if($grupos['resultado'][$i]['iscargo'] == 0){
                            $users = $this->con->sql("SELECT * FROM grupos_usuarios WHERE id_gru='".$grupos['resultado'][$i]['id_gru']."' AND id_user='".$id_user."'");
                            if($users['count'] == 1){
                                $info['citaciones'][] = $this->array_citacion($actos['resultado'][$i]);
                            }
                        }
                        if($grupos['resultado'][$i]['iscargo'] == 1){
                            $cargos = $this->con->sql("SELECT * FROM grupos_cargos t1, usuarios_cargos t2 WHERE t1.id_gru='".$grupos['resultado'][$i]['id_gru']."' AND t1.id_carg=t2.id_carg AND t2.id_user='".$id_user."' AND AND t2.fecha_ini <= '".@date("Y-m-d")."' AND (t2.fecha_fin >= '".@date("Y-m-d")."' OR t2.fecha_fin='0000-00-00 00:00:00')");
                            if($cargos['count'] == 1){
                                $info['citaciones'][] = $this->array_citacion($actos['resultado'][$i]);
                            }
                        }
                    }
                }
            }

        }else{
            $info['op'] = 2;
        }
        
        return $info;
        
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
    private function  verificar_code($id, $code, $ret){
        
        $user = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id."'");
        if($code == $user['resultado'][0]['code_app']){
                $return['op'] = 1;
                if($ret){ 
                    $return['user'] = $user['resultado'][0];
                }
        }else{
            $return['op'] = 2;
        }
        return $return;
        
    }
    
    private function perfil_ext($id_user, $code, $id, $tipo){
        
        $in = $this->verificar_code($id_user, $code, false);
        if($in['op'] == 1){
            if($tipo == 1){
                $user = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id."'");
                $info['telefono'] = "+56966166923";
                $info['email'] = "diegomez13@hotmail.com";
                $info['cargo'] = "Capitan";
                $info['cia'] = "DecimoTercer";
                $info['antiguedad'] = "3 años, 2 meses, 5 dias";
                $info['edad'] = 33;
                $info['cuerpo'] = "Cuerpo de Bomberos de Santiago";
                $info['op'] = 1;
            }
            if($tipo == 2){
                $user = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id."'");
                $info['tipo_de_sangre'] = "RH Positivo";
                $info['alergias'][0]['nombre'] = "Polen";
                $info['alergias'][1]['nombre'] = "Lactosa";
                $info['alergias'][2]['nombre'] = "anestecia";
                $info['enfermedades'][0]['nombre'] = "SIDA";
                $info['enfermedades'][1]['nombre'] = "Amigdalitis";
                $info['enfermedades'][2]['nombre'] = "Gota";
                $info['op'] = 1;
            }
        }
        return $info;
        
    }
    
    
    private function init($id_user, $code, $data){
                
        $user = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id_user."'");
        if($code == $user['resultado'][0]['code_app']){
                $rand = rand(100, 999);
                $info['op'] = 1;
                $info['time'] = rand(100, 999).$rand.rand(100, 999);
                $this->con->sql("UPDATE usuarios SET cant='".$rand."' WHERE id_user='".$id_user."'");
        }else{
            $info['op'] = 2;
        }
        return $info;
        
    }
    
    private function getasistencia($id_user, $code){

        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            
            $users = $this->con->sql("SELECT t1.id_user, t1.nombre, t3.id_act FROM (usuarios t1, usuarios_cias t2) LEFT JOIN actos_user t3 ON t1.id_user=t3.id_user WHERE t1.id_user=t2.id_user AND t2.id_cia='".$in["user"]["id_cia"]."' AND t2.fecha_ini < now() AND (t2.fecha_fin > now() OR t2.fecha_fin='0000-00-00 00:00:00')");
            for($i=0; $i<$users['count']; $i++){

                $aux['id'] = $users['resultado'][$i]['id_user'];
                $aux['nombre'] = $users['resultado'][$i]['nombre'];
                if($users['resultado'][$i]['id_act'] == 1){
                    $aux['checked'] = true;
                }else{
                    $aux['checked'] = false;
                }
                $aux['disabled'] = false;
                $aux2['voluntarios'][] = $aux;
                unset($aux);

            }
            return $aux2;
            
        }
        
    }
    private function setasistencia($id_user, $code, $id_act, $id_vol, $asist){
        
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            $vol = $this->con->sql("SELECT t2.id_cia FROM usuarios t1, usuarios_cias t2 WHERE t1.id_user='".$id_vol."' AND t1.id_user=t2.id_user AND t2.fecha_ini < now() AND (t2.fecha_fin > now() OR t2.fecha_fin='0000-00-00 00:00:00')");
            if($vol['count'] == 1){
                if($vol['resultado'][0]['id_cia'] == $in['user']['id_cia']){
                    $info['op'] = 1;
                    if($asist == 1){
                        $this->con->sql("INSERT INTO actos_user (id_act, id_user) VALUES ('".$id_act."', '".$id_vol."')");
                    }
                    if($asist == 2){
                        $this->con->sql("DELETE FROM actos_user WHERE id_act='".$id_act."' AND id_user='".$id_vol."'");
                    }
                }else{
                    $info['op'] = 2;
                }
            }else{
                $info['op'] = 2;
            }
        }else{
            $info['op'] = 2;
        }
        return $info;
    }
    
    private function setinforme($data){
        
        $id_user = $data['id_user'];
        $code = $data['code'];
        
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            
            $id_cia = $in['user']['id_cia'];
            $id_act = $data['id_act'];
            
            $informe = $this->con->sql("SELECT * FROM informe WHERE id_act='".$id_act."' AND id_cia='".$id_cia."'");
            if($informe['count'] == 0){
                $this->con->sql("INSERT INTO informe (id_act, id_cia) VALUES ('".$id_act."', '".$id_cia."')");
                
                // INICIALIZAR INFORME
                $lista_componentes = $this->con->sql("SELECT t3.id_com FROM actos t1, informe_componentes_claves t2, informe_componentes t3 WHERE t1.id_act='".$id_act."' AND t1.id_cla=t2.id_cla AND t2.id_com=t3.id_com");
                for($i=0; $i<$lista_componentes['count']; $i++){
                    if($lista_componentes['resultado'][$i]['id_com'] == 3){
                        $this->con->sql("UPDATE informe SET autos='".$this->setauto()."' WHERE id_act='".$id_act."' AND id_cia='".$id_cia."'");
                    }
                }
                
            }
            
            $id_com = $data['id_com'];
            $componente = $this->con->sql("SELECT campo, tipo FROM informe_componentes WHERE id_com='".$id_com."'");
            if($componente['count'] == 1){
                
                $campo = $componente['resultado'][0]['campo'];
                
                if($componente['resultado'][0]['tipo'] == 1){
                    $text = $data['text'];
                    return $this->con->sql("UPDATE informe SET ".$campo."='".$text."' WHERE id_act='".$id_act."' AND id_cia='".$id_cia."'");
                }
                
                if($componente['resultado'][0]['tipo'] == 2){
                    
                    $tipo = $data['tipo'];
                    $inform = $this->con->sql("SELECT * FROM informe WHERE id_act='".$id_act."' AND id_cia='".$id_cia."'");
                    $autos = json_decode($inform['resultado'][0]['autos']);
                    
                    if($tipo == "autos"){

                        $m = $data['i'];
                        $autos[$m]->{'patente'} = $data['patente'];
                        $autos[$m]->{'marca'} = $data['marca'];
                        $autos[$m]->{'modelo'} = $data['modelo'];
                        $this->con->sql("UPDATE informe SET autos='".json_encode($autos)."' WHERE id_act='".$id_act."' AND id_cia='".$id_cia."'");
                        
                    }
                    if($tipo == "lesionados"){
                        
                        $i = $data['i'];
                        $j = $data['j'];
                        $autos[$i]->{'lesionados'}[$j]->{'rut'} = $data['rut'];
                        $autos[$i]->{'lesionados'}[$j]->{'nombre'} = $data['nombre'];
                        $this->con->sql("UPDATE informe SET autos='".json_encode($autos)."' WHERE id_act='".$id_act."' AND id_cia='".$id_cia."'");
                        
                    }
                    
                }
                
            }

        }else{
            $info['op'] = 2;
        }
        
        return $info;
        
    }
    
    private function setauto(){
        
        for($i=0; $i<8; $i++){
            $aux['patente'] = '';
            $aux['marca'] = '';
            $aux['modelo'] = '';
            for($j=0; $j<8; $j++){
                $aux2['rut'] = '';
                $aux2['nombre'] = '';
                $aux['lesionados'][] = $aux2;
                unset($aux2);
            }
            $autos[] = $aux;
            unset($aux);
        }
        return json_encode($autos);
        
    }
    private function getauto($informes, $id_user_cia){
        
        for($i=0; $i<$informes['count']; $i++){
            $autos = json_decode($informes['resultado'][$i]['autos']);
            
                // MISMA CIA
                $mostrar = 1;
                for($j=0; $j<count($autos); $j++){
                    
                    if($id_user_cia == $informes['resultado'][$i]['id_cia']){
                        
                        $aux_value['patente'] = $autos[$j]->{'patente'};
                        $aux_value['marca'] = $autos[$j]->{'marca'};
                        $aux_value['modelo'] = $autos[$j]->{'modelo'};
                        if(($aux_value['patente'] != "" || $aux_value['marca'] != "" || $aux_value['modelo'] != "") || $mostrar > 0){
                            $aux_value['visible'] = 1;
                        }else{
                            $aux_value['visible'] = 0;
                        }
                        
                        for($k=0; $k<count($autos[$j]->{'lesionados'}); $k++){
                            
                            $aux_value2['rut'] = $autos[$j]->{'lesionados'}[$k]->{'rut'};
                            $aux_value2['nombre'] = $autos[$j]->{'lesionados'}[$k]->{'nombre'};
                            if($aux_value2['rut'] != "" && $aux_value2['rut'] != ""){
                                $aux_value2['visible'] = 1;
                            }else{
                                $aux_value2['visible'] = 0;
                            }
                            $aux_value['lesionados'][] = $aux_value2;
                            unset($aux_value2);
                            
                        }
                        
                        $autos_value[] = $aux_value;
                        unset($aux_value);
                        
                    }else{
                        
                        $aux_valueph['patente'] = $autos[$j]->{'patente'};
                        $aux_valueph['marca'] = $autos[$j]->{'marca'};
                        $aux_valueph['modelo'] = $autos[$j]->{'modelo'};
                        for($k=0; $k<count($autos[$j]->{'lesionados'}); $k++){
                            $aux_value2ph['rut'] = $autos[$j]->{'lesionados'}[$k]->{'rut'};
                            $aux_value2ph['nombre'] = $autos[$j]->{'lesionados'}[$k]->{'nombre'};
                            $aux_valueph['lesionados'][] = $aux_value2ph;
                            unset($aux_value2ph);
                        }
                        $autos_ph[] = $aux_valueph;
                        unset($aux_valueph);
                        
                    }
                    
                }

        }
        
        for($i=0; $i<8; $i++){
            for($j=0; $j<8; $j++){
            
            }
        }
        
        
        
        
        
        
        
        return $aux_autos;
        
    }
    
    private function get_tipo_1($informes, $nombre, $id_user_cia, $placeholder){
        
        $aux['placeholder'] = $placeholder;
        $aux['value'] = '';
        for($i=0; $i<$informes['count']; $i++){
            if($informes['resultado'][$i]['id_cia'] == $id_user_cia){
                $aux['value'] = $informes['resultado'][$i][$nombre];
            }else{
                if($informes['resultado'][$i][$nombre] != ""){
                    $aux['placeholder'] = $informes['resultado'][$i][$nombre];
                }
            }
        }
        return $aux;
    }
    
    private function informe($id_act, $id_user_cia){
        
        $informes = $this->con->sql("SELECT * FROM informe WHERE id_act='".$id_act."'");
        $comp = $this->con->sql("SELECT t3.id_com, t3.nombre, t3.tipo, t2.placeholder FROM actos t1, informe_componentes_claves t2, informe_componentes t3 WHERE t1.id_act='".$id_act."' AND t1.id_cla=t2.id_cla AND t2.id_com=t3.id_com");
        
        for($i=0; $i<$comp['count']; $i++){
            
            $aux['tipo'] = $comp['resultado'][$i]['tipo'];
            $aux['id'] = $comp['resultado'][$i]['id_com'];
            $aux['nombre'] = $comp['resultado'][$i]['nombre'];
            
            if($aux['tipo'] == 1){
                $aux['input'] = $this->get_tipo_1($informes, $aux['nombre'], $id_user_cia, $comp['resultado'][$i]['placerholder']);
            }
            if($aux['tipo'] == 2){
                $aux['autos'] = $this->getauto($informes, $id_user_cia);
            }
            
        }
        
    }
    
    private function getinforme($id_user, $code, $id_act){
        
        $in = $this->verificar_code($id_user, $code, true);
        if($in['op'] == 1){
            
            $info['op'] = 1;
            $info['informe'] = $this->informe($id_act, $in['user']['id_cia']);
            
        }else{
            $info['op'] = 2;
        }
        return $info;
        
    }
    
    private function getlibro($id_user, $code, $id_act){
        
        $in = $this->verificar_code($id_user, $code, false);
        if($in['op'] == 1){
            $aux = $this->con->sql("SELECT * FROM actos_libros WHERE id_act='".$id_act."' AND id_user='".$id_user."'");
            if($aux['count'] == 1){
                $info['op'] = 1;
                $info['text'] = $aux['resultado'][0]['text'];
            }else{
                $info['op'] = 2;
            }
        }else{
            $info['op'] = 2;
        }
        return $info;
        
    }
    private function setlibro($id_user, $code, $id_act, $libro){
        
        $in = $this->verificar_code($id_user, $code, false);
        if($in['op'] == 1){
            
            $info['op'] = 1;
            $aux = $this->con->sql("SELECT * FROM actos_libros WHERE id_act='".$id_act."' AND id_user='".$id_user."'");
            if($aux['count'] == 0){
                $this->con->sql("INSERT INTO actos_libros (id_act, id_user, fecha_creado, text) VALUES ('".$id_act."', '".$id_user."', now(), '".$libro."')");
            }
            if($aux['count'] == 1){
                $this->con->sql("UPDATE actos_libros SET text='".$libro."' WHERE id_act='".$id_act."' AND id_user='".$id_user."'");
            }
            
        }else{
            $info['op'] = 2;
        }
        return $info;
        
    }
    
}

?>