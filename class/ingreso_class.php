<?php
session_start();

require_once($path_class."mysql_class.php");

class Ingreso {
    
    public $con = null;
    
    public function __construct(){
        
        $this->con = new Conexion();

    }
    public function login(){

        $accion = $_POST["accion"];
        if($accion == "admin"){
            $tipo = $_POST["tipo"];
            if($tipo == 1){
                return $this->ingresar_user();
            }
            if($tipo == 2){
                return $this->recuperar();
            }
        }
        if($accion == "app"){
            return $this->ingresar_user_app();
        }
        if($accion == "recuperar_password"){
            return $this->recuperar_password();
        }
        
    }
    public function recuperar(){
        
        if(filter_var($_POST['user'], FILTER_VALIDATE_EMAIL)){
            
            $user = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$_POST["user"]."' AND eliminado='0'");
            if($user['count'] == 1){
                
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $code = substr(str_shuffle($chars), 0, 30);
                $this->con->sql("UPDATE usuarios SET code='".$code."' WHERE id_user='".$user["resultado"][0]["id_user"]."'");
                $url = "http://www.jardinvalleencantado.cl/send_fireapp.php?id=".$user['resultado'][0]['id_user']."&correo=".$user['resultado'][0]['correo']."&code=".$code;
                $a = file_get_contents($url);
                $info["op"] = 1;
                $info["message"] = $a;
                
            }else{
                
                $info["op"] = 2;
                $info["message"] = "Error:";
                
            }
            
        }else{
            
            $info["op"] = 2;
            $info["message"] = "Error:";
            
        }
        return $info;
        
    }
    
    public function ingresar_user_app(){
        /*
        $postdata = file_get_contents("php://input");
        $tipo = $postdata->tipo;
        $tipo = "noapp";
        */
    }
    
    public function ingresar_user(){
        
        if(filter_var($_POST['user'], FILTER_VALIDATE_EMAIL)){
            
            echo "ENTER";
            $user = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$_POST['user']."' AND eliminado='0'");
            echo "FFF";
            if($user['count'] == 0){
                // CORREO NO SE ENCUENTERA EN LA BASE DE DATOS
                $info['op'] = 2;
                $info['message'] = "Error: Usuario no existe";
                
            }
            if($user['count'] == 1){
                
                $block = $user['resultado'][0]['block'];
                
                if($block == 1){
                    $fecha_block = $user['resultado'][0]['fecha_block'];
                    if(strtotime($fecha_block)+86400 < time()){
                        $block = 0;
                        $this->con->sql("UPDATE usuarios SET block='0', intentos='0', fecha_block='' WHERE id_user='".$user['resultado'][0]['id_user']."'");
                        $user['resultado'][0]['intentos'] = 0;
                    }else{
                        $time = strtotime($fecha_block) - time() + 86400;
                        $hrs = @date("H:i:s", $time);
                        $info['op'] = 2;
                        $info['message'] = "Su cuenta esta Bloqueada, se desbloqueara autom&aacute;ticamente en ".$hrs;
                    }
                }
                
                if($block == 0){

                    $pass = $user['resultado'][0]['pass'];
                    if($pass == md5($_POST['pass'])){
                        
                        $_SESSION['user'] = $this->session($user['resultado'][0]);
                        // ATENCION ACA SE CREAN LOS PERMISOS //
                        $info['op'] = 1;
                        $info['message'] = "Ingreso Exitoso";
                        
                    }else{
                        $intentos = $user['resultado'][0]['intentos'] + 1;
                        $this->con->sql("UPDATE usuarios SET intentos='".$intentos."' WHERE id_user='".$user['resultado'][0]['id_user']."'");
                        if($intentos > 5){
                            $this->con->sql("UPDATE usuarios SET block='1', fecha_block='".@date('Y-m-d H:i:s')."' WHERE id_user='".$user['resultado'][0]['id_user']."'");
                        }
                        $int = 6 - $intentos;
                        $info['op'] = 2;
                        $info['message'] = "Contrase&ntilde;a Invalida, le quedan ".$int." intentos";
                    }
                }
                
            }
        
        }
        
        return $info;    
            
    }
    
    private function session($user){
        
        $aux['info']['id_user'] = $user['id_user'];
        $aux['info']['nombre'] = $user['nombre'];
        $aux['info']['id_cia'] = $user['id_cia'];
        $aux['info']['id_cue'] = $user['id_cue'];
        $aux['permisos'] = $this->permisos_usuario($user['id_user']);
        return $aux;
        
    }
    
    public function permisos_usuario($id){
        
        $id_user = $id;
        
        $aux = Array();
        $permisos_per = $this->con->sql("SELECT DISTINCT(t4.id_tar) FROM perfiles_usuarios t1, perfiles t2, perfiles_tareas t3, tareas t4 WHERE t1.id_user='".$id_user."' AND t1.id_per=t2.id_per AND t2.id_per=t3.id_per AND t3.id_tar=t4.id_tar");
        for($i=0; $i<$permisos_per['count']; $i++){
            $aux[] = $permisos_per['resultado'][$i]['id_tar'];
        }
        $cargo = $this->con->sql("SELECT * FROM usuarios_cargos WHERE id_user='".$id_user."' AND fecha_ini <= '".@date("Y-m-d")."' AND (fecha_fin >= '".@date("Y-m-d")."' OR fecha_fin='0000-00-00 00:00:00')");
        if($cargo['count'] == 1){
            $id_carg = $cargo['resultado'][0]['id_carg'];
            $permisos_car = $this->con->sql("SELECT DISTINCT(t4.id_tar) FROM perfiles_cargos t1, perfiles t2, perfiles_tareas t3, tareas t4 WHERE t1.id_carg='".$id_carg."' AND t1.id_per=t2.id_per AND t2.id_per=t3.id_per AND t3.id_tar=t4.id_tar");
            for($i=0; $i<$permisos_car['count']; $i++){
                if(!in_array($permisos_car['resultado'][$i]['id_tar'], $aux)){
                    $aux[] = $permisos_car['resultado'][$i]['id_tar'];
                }
            } 
        }
        return $aux;
        
    }
    
    public function recuperar_password(){
        
        $id = $_POST['id'];
        $code = $_POST['code'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        
        $user = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id."'");
        if($user['resultado'][0]['code'] == $code && $pass1 == $pass2 && strlen($pass1) >= 8){
            $this->con->sql("UPDATE usuarios SET pass='".md5($pass1)."', code='' WHERE id_user='".$id."'");
            $info['op'] = 1;
            $info['user'] = $user['resultado'][0]['correo'];
        }
        return $info;
        
    }

    
}

?>