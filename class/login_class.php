<?php
date_default_timezone_set('America/Santiago');
require_once($path_class."mysql_class.php");

class Login {
    
    public $con = null;
    
    public function __construct(){
        $this->con = new Conexion();
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
                        $code = $this->randstring(32);
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
    public function login_back(){
        
        if(filter_var($_POST['user'], FILTER_VALIDATE_EMAIL)){
            
            $user = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$_POST['user']."' AND eliminado='0'");
            if($user['count'] == 0){
                // CORREO NO SE ENCUENTERA EN LA BASE DE DATOS
                $info['op'] = 2;
                $info['message'] = "Error: Usuario no existe";
            }
            if($user['count'] == 1){
                
                $id_cue = $user['resultado'][0]['id_cue'];
                $id_cia = $user['resultado'][0]['id_cia'];
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
                        
                        $cue = $this->con->sql("SELECT * FROM cuerpos WHERE id_cue='".$id_cue."'");
                        if($cue['count'] == 1 && $cue['resultado'][0]['install'] == 0){
                            $_SESSION['install_cue'] = true;
                        }
                        $cia = $this->con->sql("SELECT * FROM companias WHERE id_cia='".$id_cia."'");
                        if($cia['count'] == 1 && $cia['resultado'][0]['install'] == 0){
                            $_SESSION['install_cia'] = true;
                        }
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
        
        }else{
            $info['op'] = 2;
            $info['message'] = "Error: Correo invalido";
        }
        
        return $info;  
        
    }
    public function enviar_clave(){
        
        $correo = $_POST['user'];
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            
            $user = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$correo."' AND eliminado='0'");
            
            if($user['count'] == 1){
                if($user["resultado"][0]["enviado"] == 0 || ($user["resultado"][0]["enviado"] < 3 && strtotime($user["resultado"][0]["date_enviado"])+86400 < time())){
                
                    $id_user = $user["resultado"][0]["id_user"];
                    $correo = $user["resultado"][0]["correo"];
                    $nombre = $user["resultado"][0]["nombre"];
                    $code = $this->randstring(32);
                    $this->con->sql("UPDATE usuarios SET code='".$code."', date_code='".date("Y-m-d H:i:s")."' WHERE id_user='".$id_user."'");

                    if($this->send_correo($id_user, $code, $correo, $nombre, 0)){
                        $info["op"] = 1;
                        $info["message"] = "Su correo ha sido enviado";
                        $enviado = $user["resultado"][0]["enviado"] + 1;
                        $this->con->sql("UPDATE usuarios SET enviado='".$enviado."', date_enviado='".date("Y-m-d H:i:s")."' WHERE id_user='".$id_user."'");
                    }else{
                        $info["op"] = 2;
                        $info["message"] = "No se pudo enviar el correo, intentelo mas tarde";
                    }
                
                }else{
                    $info["op"] = 2;
                    $info["message"] = "Error: Ya hemos enviado, revise en los no deseados";
                }
            
            }else{
                $info["op"] = 2;
                $info["message"] = "Error: Usuario no Existe";
            }
            
        }else{
            $info["op"] = 2;
            $info["message"] = "Error: Correo invalido";
        }
        
        return $info;
        
    }
    public function session($user){
        
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
    public function crear_password(){
        
        $id = $_POST['id'];
        $code = $_POST['code'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        
        if(isset($id) && is_numeric($id) && $id != 0){
            
            $user = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id."'");
            $code_user = $user['resultado'][0]['code'];
            $date_code = time() - strtotime($user['resultado'][0]['date_code']);
            
            if($user['count'] == 1){
                if($user['resultado'][0]['crear_pass'] < 10){
                    if($date_code <= 86400){
                        if(strlen($code) == 32 && $code == $code_user){
                            if($pass1 == $pass2){
                                if(strlen($pass1) >= 8){
                                    $this->con->sql("UPDATE usuarios SET pass='".md5($pass1)."', code='' WHERE id_user='".$id."'");
                                    $info['op'] = 1;
                                    $info['user'] = $user['resultado'][0]['correo'];
                                }else{
                                    $info['op'] = 2;
                                    $info['msg'] = "La contrase&ntilde;a debe tener al menos 8 caracteres";
                                }
                            }else{
                                $info['op'] = 2;
                                $info['msg'] = "La contrase&ntilde;a son diferentes";
                            }
                        }else{
                            $info['op'] = 2;
                            $info['msg'] = "Error: ";
                            $crear_pass = $user['resultado'][0]['crear_pass'] + 1;
                            $this->con->sql("UPDATE usuarios SET crear_pass='".$crear_pass."', date_crear_pass='".date("Y-m-d H:i:s")."' WHERE id_user='".$id."'");
                        }
                    }else{
                        $info['op'] = 2;
                        $info['msg'] = "El correo tiene una duracion de 24 horas";
                    }
                }else{
                    $info['op'] = 2;
                    $info['msg'] = "Demaciados intentos, su cuenta ha sido bloqueada";
                }
            }
        }

        return $info;
        
    }
    public function randstring($n){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $code = substr(str_shuffle($chars), 0, $n);
        return $code;
    }
    public function send_correo($id_user, $code, $correo, $nombre, $i){
        
        $url[0] = "http://www.usinox.cl/phpmailer/tsm.php";
        $url[1] = "http://www.jardinvalleencantado.cl/jbmks/tsm.php";
        $url[2] = "http://www.pulsachile.com/phpmailer/tsm.php";
        $url[3] = "http://www.mikasushi.cl/jbmks/tsm.php";
        $url[4] = "http://www.carinspect.cl/carinspect.cl/tsm.php";
        //$url[5] = "http://www.rnx.cl/phpmailer/tsm.php";
        //$url[6] = "http://www.rescuefire.cl/class/phpmailer/tsm.php";
        
        if($i < count($url)){
            
            $rand = rand(0, count($url)-1);
            $urls = $url[$rand];

            if(file_get_contents($urls."?accion=test") == 1){

                $post['accion'] = "hJmdX6yI9sDmA";
                // BODY //
                $post['id'] = $id_user;
                $post['code'] = $code;
                $post['nombre'] = $nombre;
                $post['url'] = "http://www.fireapp.cl";
                $post['title'] = "Fireapp";
                $post['title2'] = "Bomberos";
                // FIN BODY //
                $post['topic'] = "FireApp";
                $post['from_name'] = "FireApp";
                $post['from_mail'] = "fireappcl@gmail.com";
                $post['correo'] = $correo;

                $ch = curl_init($urls);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $response = curl_exec($ch);
                curl_close($ch);

                if($response == "OK"){
                    return true;
                }
                if($response == "NO"){
                    $x = $i + 1;
                    return $this->send_correo($id_user, $code, $correo, $nombre, $x);
                }

            }else{
                $x = $i + 1;
                return $this->send_correo($id_user, $code, $correo, $nombre, $x);
            }
            
        }else{
            return false;
        }
    }
    
}

?>

