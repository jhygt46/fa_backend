<?php
session_start();
date_default_timezone_set('America/Santiago');

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/fa_backend";
}else{
    $path .= "admin";
}
require_once ($path."/class/mysql_class.php");

class Core{
    
    public $con = null;
    public function __construct(){
        $this->id_cia = $this->getciaid();
        $this->id_cue = $this->getcueid();
        $this->con = new Conexion();
    }
    public function seguridad_permiso($id_tar){
        return in_array($id_tar, $_SESSION['user']['permisos']);
    }
    public function seguridad_usuario(){
        if($_SESSION['user']['info']['id_user'] == 1){
            return true;
        }
        return false;
    }
    public function permiso($id_tar){
        return in_array($id_tar, $_SESSION['user']['permisos']);
    }
    public function getuserid(){
        return $_SESSION['user']['info']['id_user'];
    }
    public function getciaid(){
        return $_SESSION['user']['info']['id_cia'];
    }
    public function getcueid(){
        return $_SESSION['user']['info']['id_cue'];
    }
    
    // CUERPO //
    public function get_cuerpos(){
        $cuerpos = $this->con->sql("SELECT * FROM cuerpos WHERE eliminado='0'");
        return $cuerpos['resultado'];
    }
    public function get_cuerpo($id){
        $cuerpo = $this->con->sql("SELECT * FROM cuerpos WHERE id_cue='".$id."'");
        return $cuerpo['resultado'][0];
    }
    public function get_cuerpo_complete($id){
        $cuerpo = $this->con->sql("SELECT * FROM cuerpos WHERE id_cue='".$id."'");
        $gtareas = $this->con->sql("SELECT * FROM tarea_grupo_cuerpo WHERE id_cue='".$id."'");
        $aux['cuerpo'] = $cuerpo['resultado'][0];
        $aux['gtareas'] = $gtareas['resultado'];
        return $aux;
    }
    
    
    // COMPAÑIAS //
    public function get_cias(){
        $cuerpos = $this->con->sql("SELECT * FROM companias WHERE id_cue='".$this->id_cue."' AND eliminado='0' ORDER BY numero");
        return $cuerpos['resultado'];
    }
    public function get_cia($id){
        $cuerpos = $this->con->sql("SELECT * FROM companias WHERE id_cia='".$id."' AND id_cue='".$this->id_cia."'");
        return $cuerpos['resultado'][0];
    }
    
    
    // PERFILES //
    public function get_perfiles_cia(){
        $perfiles = $this->con->sql("SELECT * FROM perfiles WHERE id_cia='".$this->id_cia."' AND id_cia!='0' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $perfiles['resultado'];
    }
    public function get_perfil_cia($id){
        $perfiles = $this->con->sql("SELECT * FROM perfiles WHERE id_per='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $perfiles['resultado'][0];
    }
    public function get_perfiles_cue(){
        $perfiles = $this->con->sql("SELECT * FROM perfiles WHERE id_cia='0' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $perfiles['resultado'];
    }
    public function get_perfil_cue($id){
        $perfiles = $this->con->sql("SELECT * FROM perfiles WHERE id_per='".$id."' AND id_cue='".$this->id_cue."' AND id_cia='0' AND eliminado='0'");
        return $perfiles['resultado'][0];
    }
    
    
    // PERFIL - CARGOS //
    public function get_perfiles_cargo_cia($id){
        $perfiles = $this->con->sql("SELECT * FROM perfiles p, perfiles_cargos pc WHERE pc.id_carg='".$id."' AND pc.id_per=p.id_per AND p.id_cia='".$this->id_cia."' AND p.id_cue='".$this->id_cue."'");
        return $perfiles['resultado'];
    }
    public function get_perfiles_cargo_cue($id){
        $perfiles = $this->con->sql("SELECT * FROM perfiles p, perfiles_cargos pc WHERE pc.id_carg='".$id."' AND pc.id_per=p.id_per AND p.id_cia='0' AND p.id_cue='".$this->id_cue."'");
        return $perfiles['resultado'];
    }
    
    
    // PERFIL - USUARIOS //
    public function get_perfiles_user($id){
        $perfiles = $this->con->sql("SELECT * FROM perfiles p, perfiles_usuarios pu WHERE pu.id_user='".$id."' AND pu.id_per=p.id_per");
        return $perfiles['resultado'];
    }
    
    
    // GET USUARIOS //
    public function is_usuario_cia($id_user){
        $aux = $this->con->sql("SELECT id_user, nombre FROM usuarios WHERE id_user='".$id_user."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return ($aux['count'] == 1) ? true : false ;
    }
    public function is_usuario_cue($id_user){
        $aux = $this->con->sql("SELECT id_user, nombre FROM usuarios WHERE id_user='".$id_user."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return ($aux['count'] == 1) ? true : false ;
    }
    public function get_usuarios_cia(){
        $usuarios = $this->con->sql("SELECT id_user, nombre FROM usuarios WHERE id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $usuarios['resultado'];
    }
    public function get_usuario_cia($id){
        $usuarios = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cia."'");
        return $usuarios['resultado'][0];
    }
    public function get_usuarios_cue(){
        $usuarios = $this->con->sql("SELECT * FROM usuarios WHERE id_cue='".$this->id_cue."' AND eliminado='0'");
        return $usuarios['resultado'];
    }
    public function get_antiguedad_usuario_cia($id){
        $usuarios = $this->con->sql("SELECT t2.id_time, t1.id_user, t1.nombre, t2.fecha_ini, t2.fecha_fin  FROM usuarios t1, usuarios_cias t2 WHERE t2.id_user='".$id."' AND t2.id_user=t1.id_user AND t2.id_cia='".$this->id_cia."' AND t2.id_cue='".$this->id_cue."' ORDER BY fecha_ini DESC");
        return $usuarios['resultado'];
    }
    public function get_usuario_cue($id){
        $usuarios = $this->con->sql("SELECT * FROM usuarios WHERE id_user='".$id."' AND id_cue='".$this->id_cia."'");
        return $usuarios['resultado'][0];
    }
    public function get_usuarios_cuartel(){
        $usuarios = $this->con->sql("SELECT * FROM usuarios WHERE encuartel='1' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $usuarios['resultado'];
    }
    
    
    // GET CARGOS //
    public function get_cargo_cia($id){
        $cuerpo = $this->con->sql("SELECT id_carg, nombre, cantidad FROM cargos WHERE id_carg='".$id."' AND iscia='1' AND id_cue='".$this->id_cue."' AND (id_cia='".$this->id_cia."' OR id_cia='0') AND eliminado='0'");
        return $cuerpo['resultado'][0];
    }
    public function get_cargo_cue($id){
        $cuerpo = $this->con->sql("SELECT * FROM cargos WHERE id_carg='".$id."' AND id_cia='0' AND iscia='0' AND id_cue='".$this->id_cue."'");
        return $cuerpo['resultado'][0];
    }
    public function is_cargo_cia($id_carg){
        $aux = $this->con->sql("SELECT * FROM cargos WHERE id_carg='".$id_carg."' AND iscia='1' AND id_cue='".$this->id_cue."' AND (id_cia='".$this->id_cia."' OR id_cia='0')");
        return ($aux['count'] == 1) ? true : false ;
    }
    public function is_cargo_cue($id_carg){
        $aux = $this->con->sql("SELECT id_user, nombre FROM usuarios WHERE id_user='".$id_user."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return ($aux['count'] == 1) ? true : false ;
    }
    
    
    // CLAVES //
    public function get_claves_cue(){
        $claves = $this->con->sql("SELECT * FROM claves WHERE iscia='0' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $claves['resultado'];
    }
    public function get_claves_llamados_cue(){
        $claves = $this->con->sql("SELECT * FROM claves WHERE id_cia='0' AND id_cue='".$this->id_cue."' AND eliminado='0' AND tipo='1' ORDER BY grupo");
        $cla = $claves['resultado'];
        for($i=0; $i<count($cla); $i++){
            $aux[$cla[$i]['grupo']]['nombre'] = $cla[$i]['grupo_nombre'];
            $aux[$cla[$i]['grupo']]['claves'][] = $cla[$i];
        }
        return $aux;
    }
    public function get_claves_cia(){
        $claves = $this->con->sql("SELECT * FROM claves WHERE id_cue='".$this->id_cue."' AND (id_cia='".$this->id_cia."' || id_cia='0') AND iscia='1' AND eliminado='0'");
        return $claves['resultado'];
    }
    public function get_clave_cue($id){
        
        $claves = $this->con->sql("SELECT * FROM claves WHERE id_cla='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
        $aux['clave'] = $claves['resultado'][0];
        
        if($aux['clave']['todos'] == 0){
            $grupos = $this->con->sql("SELECT * FROM clave_grupos WHERE id_cla='".$aux['clave']['id_cla']."'");
            if($grupos['count'] > 0){
                $aux['grupos'] = $grupos['resultado'];
            }
        }
        
        $tdcs = $this->con->sql("SELECT * FROM claves_tipo WHERE id_cla='".$aux['clave']['id_cla']."'");
        if($tdcs['count'] > 0){
            $aux['tdcs'] = $tdcs['resultado'];
        }
        
        return $aux;
        
    }
    public function get_actos_cue(){
        $aux = $this->con->sql("SELECT * FROM actos t1, claves t2 WHERE DATE(t1.fecha_creado) >= DATE(NOW()) AND t1.id_cla=t2.id_cla AND t2.tipo='3' AND t2.id_cue='".$this->id_cue."' AND t2.iscia='0'");
        return $aux['resultado'];
    }
    public function get_actos_cia(){
        $aux = $this->con->sql("SELECT * FROM actos t1, claves t2 WHERE DATE(t1.fecha_creado) >= DATE(NOW()) AND t1.id_cla=t2.id_cla AND t2.tipo='3' AND t2.id_cue='".$this->id_cue."' AND t2.iscia='1' AND (t2.id_cia='0' || t2.id_cia='".$this->id_cia."')");
        return $aux['resultado'];
    }
    public function get_acto_cue($id){
        $aux = $this->con->sql("SELECT * FROM actos WHERE id_act='".$id."' AND id_cue='".$this->id_cue."'");
        return $aux['resultado'][0];
    }
    public function get_acto_cia($id){
        $aux = $this->con->sql("SELECT * FROM actos WHERE id_act='".$id."' AND id_cue='".$this->id_cue."'");
        return $aux['resultado'][0];
    }
    public function _get_actos_cia(){
        
        $actos_sel = $this->con->sql("SELECT t1.id_act, t2.nombre, t2.clave, t1.direccion, t1.lat, t1.lng, t1.comuna, t1.fecha_creado, t1.code FROM actos t1, claves t2 WHERE t1.id_cue='".$this->id_cue."' AND t1.id_clave=t2.id_cla");
        
        
        for($i=0; $i<$actos_sel['count']; $i++){
            
            $actos[$i]['info']['id'] = $actos_sel['resultado'][$i]['id_act'];
            $actos[$i]['info']['nombre'] = $actos_sel['resultado'][$i]['nombre'];
            $actos[$i]['info']['clave'] = $actos_sel['resultado'][$i]['clave'];
            $actos[$i]['info']['direccion'] = $actos_sel['resultado'][$i]['direccion'];
            $actos[$i]['info']['lat'] = $actos_sel['resultado'][$i]['lat'];
            $actos[$i]['info']['lng'] = $actos_sel['resultado'][$i]['lng'];
            $actos[$i]['info']['comuna'] = $actos_sel['resultado'][$i]['comuna'];
            $actos[$i]['info']['hora'] = $actos_sel['resultado'][$i]['fecha_creado'];
            $actos[$i]['info']['code'] = $actos_sel['resultado'][$i]['code'];

            $images = $this->con->sql("SELECT nombre FROM actos_imagenes WHERE id_act='".$actos[0]['info']['id']."'");
            for($j=0; $j<$images['count']; $j++){
                $actos[$i]['fotos'][] = $images['resultado'][$j]['nombre'];
            }

            $chats = $this->con->sql("SELECT id_user, texto FROM actos_chat WHERE id_act='".$actos[0]['info']['id']."'");
            $actos[$i]['chat'] = $chats['resultado'];

        }

        return $actos;
        
    }
    public function get_carros_acto($id){
        
        $acto = $this->con->sql("SELECT * FROM actos WHERE id_act='".$id."'");
        $act = $acto['resultado'][0];
        
        $lat = $act['lat'];
        $lng = $act['lng'];
        
        $carros = $this->con->sql("SELECT * FROM carros WHERE lat='".$lat."' AND lng='".$lng."'");
        return $carros['resultado'];
        
    }
    public function get_clave_cia($id){
        
        $claves = $this->con->sql("SELECT * FROM claves WHERE id_cla='".$id."' AND id_cia='".$this->id_cue."' AND id_cue='".$this->id_cue."'");
        $aux['clave'] = $claves['resultado'][0];
        
        if($aux['clave']['todos'] == 0){
            $grupos = $this->con->sql("SELECT * FROM clave_grupos WHERE id_cla='".$aux['clave']['id_cla']."'");
            if($grupos['count'] > 0){
                $aux['grupos'] = $grupos['resultado'];
            }
        }
        
        $carros = $this->con->sql("SELECT * FROM claves_carros WHERE id_cla='".$aux['clave']['id_cla']."'");
        if($carros['count'] > 0){
            $aux['carros'] = $carros['resultado'];
        }
        
        return $aux;
        
    }
    public function get_claves_tipo(){
        
        $clave_id = $_POST["clave_id"];
        $clave_id = 1;
        $tdc = $this->con->sql("SELECT t1.id_tdc, t1.cantidad FROM claves_tipo t1, claves t2 WHERE t1.id_cla='".$clave_id."' AND t1.id_cla=t2.id_cla AND t2.id_cue='".$this->id_cue."'");
        return $tdc['resultado'];
        
    }
    public function distancia($lat1, $lat2, $lng1, $lng2){
        
        $degrees = rad2deg(acos((sin(deg2rad($lat1))*sin(deg2rad($lat2))) + (cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($lng1-$lng2)))));
        $distance = $degrees * 111.13384 * 1000;
        return round($distance, 2);
        
    }
    public function get_grupos_cue($iscargo){
        
        $aux_sql = "";
        if($iscargo == 0){
            $aux_sql = "iscargo='0' AND ";
        }
        if($iscargo == 1){
            $aux_sql = "iscargo='1' AND ";
        }
        
        $grupos = $this->con->sql("SELECT * FROM grupos WHERE ".$aux_sql." id_cue='".$this->id_cue."' AND id_cia='0' AND eliminado='0' ORDER BY iscargo DESC");
        return $grupos['resultado'];
        
    }
    public function get_grupos_cia($iscargo){
        
        $aux_sql = "";
        if($iscargo == 0){
            $aux_sql = "iscargo='0' AND ";
        }
        if($iscargo == 1){
            $aux_sql = "iscargo='1' AND ";
        }
        
        $grupos = $this->con->sql("SELECT * FROM grupos WHERE ".$aux_sql." id_cue='".$this->id_cue."' AND id_cia='".$this->id_cia."' AND eliminado='0' ORDER BY iscargo DESC");
        return $grupos['resultado'];
        
    }
    public function get_grupo_cue($id){
        
        $grupos = $this->con->sql("SELECT * FROM grupos WHERE id_gru='".$id."' AND id_cue='".$this->id_cue."' AND id_cia='0'");
        $aux['gru'] = $grupos['resultado'][0];
        if($grupos['count'] == 1){
            $cargos = $this->con->sql("SELECT id_carg FROM grupos_cargos WHERE id_gru='".$id."'");
            $aux['carg'] = $cargos['resultado'];
        }
        return $aux;
        
    }
    public function get_grupo_cia($id){
        
        $grupos = $this->con->sql("SELECT * FROM grupos WHERE id_gru='".$id."' AND id_cue='".$this->id_cue."' AND id_cia='".$this->id_cia."'");
        $aux['gru'] = $grupos['resultado'][0];
        if($grupos['count'] == 1){
            $cargos = $this->con->sql("SELECT id_carg FROM grupos_cargos WHERE id_gru='".$id."'");
            $aux['carg'] = $cargos['resultado'];
        }
        return $aux;
        
    }
    public function get_grupo_cue_vol($id){
        
        $grupos = $this->con->sql("SELECT * FROM grupos WHERE id_gru='".$id."' AND iscargo='0' AND id_cue='".$this->id_cue."' AND id_cia='0'");
        $aux['gru'] = $grupos['resultado'][0];
        if($grupos['count'] == 1){
            $users = $this->con->sql("SELECT id_user FROM grupos_usuarios WHERE id_gru='".$id."'");
            $aux['user'] = $users['resultado'];
        }
        return $aux;
        
    }
    public function get_grupo_cia_vol($id){
        
        $grupos = $this->con->sql("SELECT * FROM grupos WHERE id_gru='".$id."' AND iscargo='0' AND id_cue='".$this->id_cue."' AND id_cia='".$this->id_cia."'");
        $aux['gru'] = $grupos['resultado'][0];
        if($grupos['count'] == 1){
            $users = $this->con->sql("SELECT id_user FROM grupos_usuarios WHERE id_gru='".$id."'");
            $aux['user'] = $users['resultado'];
        }
        return $aux;
        
    }
    public function get_users_cargo_cue($id){
        // IMPORTANTE REVISAR QUERY
        $users = $this->con->sql("SELECT t2.fecha_creado, t2.id_ucar, t3.id_user, t3.nombre, t2.fecha_ini, t2.fecha_fin FROM cargos t1, usuarios_cargos t2, usuarios t3 WHERE t1.id_carg='".$id."' AND t1.id_carg=t2.id_carg AND t2.id_user=t3.id_user AND t3.id_cue='".$this->id_cue."' AND t1.id_cue='".$this->id_cue."' AND t1.iscia='0' ORDER BY t2.fecha_ini DESC");
        return $users['resultado'];
        
    }
    public function get_users_cargo_cia($id){
        // IMPORTANTE REVISAR QUERY
        $users = $this->con->sql("SELECT t3.id_user, t3.nombre, t2.fecha_ini, t2.fecha_fin FROM cargos t1, usuarios_cargos t2, usuarios t3 WHERE t1.id_carg='".$id."' AND t1.id_carg=t2.id_carg AND t2.id_user=t3.id_user AND t3.id_cia='".$this->id_cia."' AND t3.id_cue='".$this->id_cue."' ORDER BY t2.fecha_ini DESC");
        return $users['resultado'];
        
    }
    public function get_user_cargo_cue($id){
        
        $users = $this->con->sql("SELECT * FROM usuarios_cargos WHERE id_ucar='".$id."'");
        return $users['resultado'][0];
        
    }
    public function get_cargos_cia(){
        
        $cuerpos = $this->con->sql("SELECT * FROM cargos WHERE id_cue='".$this->id_cue."' AND eliminado='0' AND iscia='1' AND (id_cia='".$this->id_cia."' || id_cia='0') ORDER BY iscia");
        return $cuerpos['resultado'];
        
    }
    public function get_cargos_cue(){
        
        $cargos = $this->con->sql("SELECT * FROM cargos WHERE id_cue='".$this->id_cue."' AND id_cia='0'");
        return $cargos['resultado'];
        
    }
    
    public function enviar_email($correo, $code, $id, $nombre){
        
        $url[0] = "http://www.usinox.cl/jbmks/tsm.php";
        $url[1] = "http://www.jardinvalleencantado.cl/jbmks/tsm.php";

        $rand = rand(0, count($url)-1);
        $urls = $url[$rand];

        $post['accion'] = "hJmdX6yI9sDmA";

        // BODY //
        $post['id'] = $id;
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
        }else{
            return false;
        }
        
        
    }
    
    public function ing_mod_user($id, $correo, $id_cia, $id_cue){
        
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $user = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$correo."'");
            if($user['count'] == 0){
                if($id == 0){
                    $sql = $this->con->sql("INSERT INTO usuarios (correo, fecha_creado, id_cia, id_cue) VALUES ('".$correo."', now(), '".$id_cia."', '".$id_cue."')");
                    $info['op'] = 1;
                    $info['id'] = $sql['insert_id'];
                    $info['mensaje'] = "Usuario Ingresado Exitosamente";
                }
                if($id > 0){
                    $this->con->sql("UPDATE usuarios SET correo='".$correo."' WHERE id_cia='".$id_cia."' AND id_cue='".$id_cue."' AND id_user='".$id."' AND eliminado='0'");
                    $info['op'] = 1;
                    $info['id'] = $id;
                    $info['mensaje'] = "Usuario Modificado Exitosamente";
                }
            }
            if($user['count'] == 1){
                if($id == 0){
                    if($user['resultado'][0]['eliminado'] == 1){
                        $this->con->sql("UPDATE usuarios SET eliminado='0', id_cia='".$id_cia."', id_cue='".$id_cue."' WHERE id_user='".$user['resultado'][0]['id_user']."'");
                        $info['op'] = 1;
                        $info['id'] = $user['resultado'][0]['id_user'];
                        $info['mensaje'] = "Usuario Ingresado Exitosamente";
                    }else{
                        $info['op'] = 2;
                        $info['mensaje'] = "Usuario ya Existe";
                    }
                }
                if($id > 0){
                    if($id != $user['resultado'][0]['id_user']){
                        $info['op'] = 2;
                        $info['mensaje'] = "Usuario no Corresponde";
                    }else{
                        $info['op'] = 1;
                        $info['id'] = $id;
                        $info['mensaje'] = "Usuario Modificado Exitosamente";
                    }
                }
                
            }
        }else{
            $info['op'] = 2;
            $info['mensaje'] = "Correo inv&aacute;lido";
        }
        
        return $info;
        
    }
    
    
    
    // GET TAREAS //
    
    public function get_tareas_cia($type){
        $tareas = $this->con->sql("SELECT * FROM tareas t1, tarea_grupo_cuerpo t2 WHERE t2.id_cue='".$this->id_cue."' AND t2.id_gtar=t1.id_gtar AND t1.iscia='1' ORDER BY t1.orden, t1.id_tar");
        return ($type == "order") ? $this->order_group($tareas, 'id_tar') : $tareas['resultado'];
    }
    public function get_tareas_cue($type){
        $tareas = $this->con->sql("SELECT * FROM tareas t1, tarea_grupo_cuerpo t2 WHERE t2.id_cue='".$this->id_cue."' AND t2.id_gtar=t1.id_gtar AND t1.iscia='0' ORDER BY t1.orden, t1.id_tar");
        return ($type == "order") ? $this->order_group($tareas, 'id_tar') : $tareas['resultado'];
    }
    public function tareas_perfil_cia($id_per){
        $tareas = $this->con->sql("SELECT * FROM tareas t, perfiles_tareas pt WHERE pt.id_per='".$id_per."' AND pt.id_tar=t.id_tar");
        return $tareas['resultado'];
    }
    public function get_grupos_tareas(){
        $tareas = $this->con->sql("SELECT * FROM tareas_grupos");
        return $tareas['resultado'];
    }
    
    
    // CARROS //
    public function get_carros(){
        
        $lat = $_POST["lat"];
        $lng = $_POST["lng"];
        
        $tdc = $this->get_claves_tipo();
        
        $clave_id = $_POST["clave_id"];
        $clave_id = 1;
        
        $carros = $this->con->sql("SELECT * FROM claves_tipo t1, carros_tipo t2, carros t3, cuerpo_cias_despacho t4 WHERE t1.id_cla='".$clave_id."' AND t1.id_tdc=t2.id_tdc AND t2.id_car=t3.id_car AND (t3.id_cia=t4.id_cia OR t3.id_cia='0') AND t3.eliminado='0' AND t4.id_cue='".$this->id_cue."'");
        for($i=0; $i<$carros['count']; $i++){
            
            $id_car = $carros['resultado'][$i]['id_car'];  
            $aux[$id_car]['id_car'] = $carros['resultado'][$i]['id_car'];
            $aux[$id_car]['nombre'] = $carros['resultado'][$i]['nombre'];
            $aux[$id_car]['encuartel'] = $carros['resultado'][$i]['encuartel'];
            $aux[$id_car]['lat'] = $carros['resultado'][$i]['lat'];
            $aux[$id_car]['lng'] = $carros['resultado'][$i]['lng'];
            $aux[$id_car]['id_cia'] = $carros['resultado'][$i]['id_cia'];
            $aux[$id_car]['tdc'][] = $carros['resultado'][$i]['id_tdc'];
            
        }
        
        foreach($aux as $key => $value){
            $carro2[] = $value;
        }
        $carros = $carro2;
        unset($carro2);
        
        $arr = [];
        for($i = 0; $i < count($carros); $i++){

            $id_cia = $carros[$i]['id_cia'];
            $cuartel = $carros[$i]['encuartel'];
            $nombre = $carros[$i]['nombre'];
            
            if($cuartel == 1){

                if(!isset($arr[$id_cia])){

                    $cia = $this->con->sql("SELECT * FROM companias WHERE id_cia='".$id_cia."'");
                    $carros[$i]['lat'] = $cia['resultado'][0]['lat'];
                    $carros[$i]['lng'] = $cia['resultado'][0]['lng'];
                    
                    $aux2['id'] = count($aux);
                    $aux2['titulo'] = "Cuartel ".$cia['resultado'][0]['numero'];
                    $aux2['lat'] = $carros[$i]['lat'];
                    $aux2['lng'] = $carros[$i]['lng'];
                    
                    $carros[$i]['pos_id'] = $aux2['id'];
                    $carros[$i]['distancia'] = $this->distancia($lat, $aux2['lat'], $lng, $aux2['lng']);
                    
                    $arr[$id_cia]['id'] = $aux2['id'];
                    $arr[$id_cia]['distancia'] = $carros[$i]['distancia'];
                    $aux[] = $aux2;
                    

                }else{
                    
                    $carros[$i]['pos_id'] = $arr[$id_cia]['id'];
                    $carros[$i]['distancia'] = $arr[$id_cia]['distancia'];
                    
                }

            }else{
                
                $aux2['id'] = count($aux);
                $aux2['titulo'] = "Posicion de ".$nombre;
                $aux2['lat'] = $carros[$i]['lat'];
                $aux2['lng'] = $carros[$i]['lng'];
                
                $carros[$i]['pos_id'] = $aux2['id'];
                $carros[$i]['distancia'] = $this->distancia($lat, $aux2['lat'], $lng, $aux2['lng']);
                $aux[] = $aux2;

            }

        }
        
        usort($carros, function ($a, $b) {
            if ($a['distancia'] == $b['distancia']) {
                return 0;
            }
            return ($a['distancia'] < $b['distancia']) ? -1 : 1;
        });
        
        $mc = [];
        $ms = [];
        //$mz = [];
        $margen = 10;
        for($k=0; $k<count($tdc); $k++){
            
            $id_tdc = $tdc[$k]['id_tdc'];
            $cantidad = $tdc[$k]['cantidad'] + $margen;
            
            for($i=0; $i<count($carros); $i++){
                for($j=0; $j<count($carros[$i]['tdc']); $j++){

                    if($id_tdc == $carros[$i]['tdc'][$j]){
                        
                        $mc[$id_tdc]++;
                        if($mc[$id_tdc] < $cantidad){
                            $ms[] = $carros[$i];
                            //$mz[$id_tdc][] = $carros[$i];
                        }
                    }

                }
            }

        }
        
        $carros = $ms;
        
        unset($mc);
        unset($ms);
        
        $r = [];
        $pos = [];
        
        for($i=0; $i<count($aux); $i++){
            $r[] = $aux[$i]['lat'].",".$aux[$i]['lng'];
        }
        
        $dist = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?mode=driving&origins=".implode("|", $r)."&destinations=".$lat.",".$lng."&key=AIzaSyDZhxGK-npKigPS6vjlIapBNJQah8xNurw"));
        for($i=0; $i<count($dist->rows); $i++){
            
            $aux3['id'] = $aux[$i]['id'];
            $aux3['titulo'] = $aux[$i]['titulo'];
            $aux3['lat'] = $aux[$i]['lat'];
            $aux3['lng'] = $aux[$i]['lng'];
            $aux3['distancia'] = $dist->rows[$i]->elements[0]->distance->value;
            $aux3['duracion'] = $dist->rows[$i]->elements[0]->duration->value;
            $pos[] = $aux3;

        }
        usort($pos, function ($a, $b) {
            if ($a['distancia'] == $b['distancia']) {
                return 0;
            }
            return ($a['distancia'] < $b['distancia']) ? -1 : 1;
        });
        
        $e['tdc'] = $tdc;
        $e['carros'] = $carros;
        $e['puntos'] = $pos;

        return $e;
        
    }
    public function get_carros_cue(){        
        $carros = $this->con->sql("SELECT t2.id_car, t2.nombre, t2.lat, t2.lng, t2.encuartel, t2.id_cia FROM cuerpo_cias_despacho t1, carros t2 WHERE t1.id_cue='".$this->id_cue."' AND (t1.id_cia=t2.id_cia OR t2.id_cia='0') AND t2.eliminado='0'");
        return $carros['resultado'];
    }
    public function get_carros_cia($id){
        $carros = $this->con->sql("SELECT * FROM carros WHERE id_cia='".$id."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $carros['resultado'];
    }
    public function get_carros_mi_cia(){
        $carros = $this->con->sql("SELECT * FROM carros WHERE id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $carros['resultado'];
    }
    public function get_carro_cia($id_cia, $id){
        $carros = $this->con->sql("SELECT * FROM carros WHERE id_car='".$id."' AND id_cia='".$id_cia."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $carros['resultado'][0];
    }
    public function get_tipos_maquinas(){
        $carros = $this->con->sql("SELECT * FROM tipos_de_carros WHERE id_cue='".$this->id_cue."' AND eliminado='0'");
        return $carros['resultado'];
    }
    public function get_tipos_carro($id){
        $carros = $this->con->sql("SELECT * FROM carros_tipo t1, tipos_de_carros t2 WHERE t1.id_car='".$id."' AND t1.id_tdc=t2.id_tdc AND t2.id_cue='".$this->id_cue."' AND t2.eliminado='0'");
        return $carros['resultado'];
    }
    public function get_tipo_maquina($id){
        $carros = $this->con->sql("SELECT * FROM tipos_de_carros WHERE id_tdc='".$id."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
        return $carros['resultado'][0];
    }
    
    
    // LLAMADOS //
    public function get_llamado($id){
        
        $llamado = $this->con->sql("SELECT * FROM actos WHERE id_act='".$id."' AND  id_cue='".$this->id_cue."'");
        return $llamado['resultado'][0];
    }
    
    // INSTALL CUE CIA //
    
    public function install_cue(){
        
        $cue = $this->con->sql("SELECT * FROM cuerpos WHERE id_cue='".$this->id_cue."'");
        if($cue['resultado'][0]['install'] == 0){
                
            $install_sql = $this->con->sql("SELECT *  FROM install_cuerpo t1, install_pasos t2 WHERE t1.id_cue='".$this->id_cue."' AND t1.id_ins=t2.id_ins AND t2.iscia='0'");
            $install = false;
            for($i=0; $i<$install_sql['count']; $i++){

                if($install_sql['resultado'][$i]['estado'] == 0){
                    $install = true;
                }
                $aux['id_ins'] = $install_sql['resultado'][$i]['id_ins'];
                $aux['estado'] = $install_sql['resultado'][$i]['estado'];
                $aux['txt'] = $install_sql['resultado'][$i]['txt'];
                $aux['image'] = $install_sql['resultado'][$i]['image'];
                $aux['video'] = $install_sql['resultado'][$i]['video'];
                $aux['page'] = $install_sql['resultado'][$i]['page'];

                $ins_session[] = $aux;
                unset($aux);
            }
            if($install){
                return $ins_session;
            }else{
                $this->con->sql("UPDATE cuerpos SET install='1' WHERE id_cue='".$this->id_cue."'");
            }

        }
        
    }
    public function install_cia(){
        
        $cia = $this->con->sql("SELECT * FROM companias WHERE id_cia='".$this->id_cia."'");
        if($cia['resultado'][0]['install'] == 0){
                
            $install_sql = $this->con->sql("SELECT *  FROM install_cia t1, install_pasos t2 WHERE t1.id_cia='".$this->id_cia."' AND t1.id_ins=t2.id_ins AND t2.iscia='1'");
            $install = false;
            for($i=0; $i<$install_sql['count']; $i++){

                if($install_sql['resultado'][$i]['estado'] == 0){
                    $install = true;
                }
                $aux['id_ins'] = $install_sql['resultado'][$i]['id_ins'];
                $aux['estado'] = $install_sql['resultado'][$i]['estado'];
                $aux['txt'] = $install_sql['resultado'][$i]['txt'];
                $aux['image'] = $install_sql['resultado'][$i]['image'];
                $aux['video'] = $install_sql['resultado'][$i]['video'];
                $aux['page'] = $install_sql['resultado'][$i]['page'];

                $ins_session[] = $aux;
                unset($aux);
                
            }
            if($install){
                return $ins_session;
            }else{
                $this->con->sql("UPDATE compania SET install='1' WHERE id_cia='".$this->id_cia."'");
                return null;
            }

        }
        
    }
    
    
    // CONFIGURACION //
    public function get_config_cue(){
        
        $aux = $this->con->sql("SELECT * FROM cuerpos WHERE id_cue='".$this->id_cue."'");
        return $aux['resultado'][0];
        
    }
    public function get_config_cia(){
        
        $aux = $this->con->sql("SELECT * FROM companias WHERE id_cia='".$this->id_cia."'");
        return $aux['resultado'][0];
        
    }
    
    
    // GET BLOGS //
    public function get_blog_data(){
        $blogs = $this->con->sql("SELECT * FROM blog WHERE iscia='1' AND id_cue='".$this->id_cue."' AND (id_cia='".$this->id_cia."' OR id_cia='0')");
        return $blogs['resultado'];
    }
    function getBoundaries($lat, $lng, $distance = 1){
        
        $earthRadius = 6371;
        $return = array();
        $cardinalCoords = [0, 180, 90, 270];
        $cardinalNames = ['north', 'south', 'west', 'east'];
        $rLat = deg2rad($lat);
        $rLng = deg2rad($lng);
        $rAngDist = $distance/$earthRadius;
        for($i=0; $i<count($cardinalCoords); $i++){
            
            $rAngle = deg2rad($cardinalCoords[$i]);
            $rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
            $rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));
            $return[$cardinalNames[$i]] = array('lat' => (float) rad2deg($rLatB), 'lng' => (float) rad2deg($rLonB));
        }
        
        $aux['min_lat'] = $return['south']['lat'];
        $aux['max_lat'] = $return['north']['lat'];
        $aux['min_lng'] = $return['west']['lng'];
        $aux['max_lng'] = $return['east']['lng'];
        return $aux;
        
    }
    
    
    // PERMISOS //
    public function permisos_usuario(){
        
        $id_user = $this->getuserid();
        
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
    
    
    // ORDER //
    public function order_group($result, $id){
        
        for($i=0; $i<$result['count']; $i++){
            $aux_ini = $result['resultado'][$i];
            $aux[$aux_ini['grupoorder']]['grupo'] = $aux_ini['grupo'];
            $aux2[$id] = $aux_ini[$id];
            $aux2['nombre'] = $aux_ini['nombre'];
            $aux[$aux_ini['grupoorder']]['res'][] = $aux2;
        }
        return $aux;
        
    }
    public function actuales($list_user_cargo){
        
        $now = @time();
        for($i=0; $i<count($list_user_cargo); $i++){
            $f_ini = @strtotime($list_user_cargo[$i]['fecha_ini']);
            $f_fin = @strtotime($list_user_cargo[$i]['fecha_fin']);
            if($f_fin == 0 || $f_fin > $now){
                if($f_ini < $now){
                    if($f_fin == ""){
                        $act['f_fin'] = "Actualidad";
                    }else{
                        $act['f_fin'] = $list_user_cargo[$i]['fecha_fin'];
                    }
                    $act['id_ucar'] = $list_user_cargo[$i]['id_ucar'];
                    $act['id_user'] = $list_user_cargo[$i]['id_user'];
                    $act['nombre'] = $list_user_cargo[$i]['nombre'];
                    $act['f_ini'] = $list_user_cargo[$i]['fecha_ini'];
                    $actual[] = $act;
                }
            }
        }
        return $actual;
        
    }
    public function tabla_intermedia($ids, $tabla, $key){
        
        for($i=0; $i<count($ids['nid']); $i++){
            
            $black[0] = $key;
            $add[$key] = $ids['nid'][$i];
            $this->copy_table("SELECT * FROM ".$tabla." WHERE ".$key."='".$ids['oid'][$i]."'", $black, $add, $tabla, $key);
            
        }
        
    }
    
    public function tabla_index($arr1, $arr2, $info){
        
        $aux = array();
        for($i=0; $i<count($arr1['nid']); $i++){
           for($j=0; $j<count($arr2['nid']); $j++){
                $res = $this->con->sql("SELECT * FROM ".$info['db']." WHERE ".$info['key1']."='".$arr1['oid'][$i]."' AND ".$info['key2']."='".$arr2['oid'][$j]."'");
                if($res['count'] == 1){
                   if(isset($info['add'])){
                       
                       $aux = array($info['key1'], $info['key2']);
                       $in1 = array_merge($aux, $info['add']);
                       
                       $in2 = array("'".$arr1['nid'][$i]."'", "'".$arr2['nid'][$j]."'");
                       for($m=0; $m<count($info['add']); $m++){
                           $in2[] = "'".$res['resultado'][0][$info['add'][$m]]."'";
                       }
                       $aux[] = $this->con->sql("INSERT INTO ".$info['db']." (".implode(",", $in1).") VALUES (".implode(",", $in2).")");
                       
                    }else{
                        $aux[] = $this->con->sql("INSERT INTO ".$info['db']." (".$info['key1'].", ".$info['key2'].") VALUES ('".$arr1['nid'][$i]."', '".$arr2['nid'][$j]."')");
                    }
                }
            } 
        }
        return $aux;
    }
    
    public function copy_cuerpo($id_cue1, $id_cue2){
        
        // ## LISTO TIPOS DE CARROS
        $black = array("id_cue", "id_tdc", "fecha_creado");
        $add['id_cue'] = $id_cue2;
        $add['fecha_creado'] = date("Y-m-d H:i:s");
        $tdc = $this->copy_table("SELECT * FROM tipos_de_carros WHERE id_cue='".$id_cue1."'", $black, $add, "tipos_de_carros", null);        
        
        // ## LISTO CARGOS
        $black = array("id_cue", "id_carg", "fecha_creado");
        $add['id_cue'] = $id_cue2;
        $add['fecha_creado'] = date("Y-m-d H:i:s");
        $cargos = $this->copy_table("SELECT * FROM cargos WHERE id_cue='".$id_cue1."' AND id_cia='0'", $black, $add, "cargos", "id_carg");        

        // ## LISTO PERFILES Y PERFILES_TAREAS
        $black = array("id_cue", "id_per", "fecha_creado");
        $add['id_cue'] = $id_cue2;
        $add['fecha_creado'] = date("Y-m-d H:i:s");
        $ids = $this->copy_table("SELECT * FROM perfiles WHERE id_cue='".$id_cue1."' AND id_cia='0'", $black, $add, "perfiles", "id_per");
        $this->tabla_intermedia($ids, "perfiles_tareas", "id_per");
        
        // ## LISTO CLAVES
        $black = array("id_cue", "id_cla", "fecha_creado");
        $add['id_cue'] = $id_cue2;
        $add['fecha_creado'] = date("Y-m-d H:i:s");
        $claves = $this->copy_table("SELECT * FROM claves WHERE id_cue='".$id_cue1."' AND id_cia='0'", $black, $add, "claves", null);
        
        // ## LISTO GRUPOS
        $black = array("id_cue", "id_gru", "fecha_creado");
        $add['id_cue'] = $id_cue2;
        $add['fecha_creado'] = date("Y-m-d H:i:s");
        $grupos = $this->copy_table("SELECT * FROM grupos WHERE iscargo='1' AND id_cue='".$id_cue1."' AND id_cia='0'", $black, $add, "grupos", "id_gru");     
        
        // ## LISTO GRUPOS/CARGOS
        unset($info);
        $info['db'] = "grupos_cargos";
        $info['key1'] = "id_carg";
        $info['key2'] = "id_gru";
        $this->tabla_index($cargos, $grupos, $info);
        
        // ## LISTO CLAVES/TIPO DE MAQUINA
        unset($info);
        $info['db'] = "claves_tipo";
        $info['key1'] = "id_cla";
        $info['key2'] = "id_tdc";
        $info['add'][0] = "cantidad";
        $this->tabla_index($claves, $tdc, $info);
        
        // ## LISTO INSTALL CUERPO //
        $black = array("id_cue", "estado");
        $add['id_cue'] = $id_cue2;
        $add['estado'] = 0;
        $grupos = $this->copy_table("SELECT * FROM install_cuerpo WHERE id_cue='".$id_cue1."'", $black, $add, "install_cuerpo", "id_ins");     
        
        
    }
    
    public function copy_compania($id_cia1, $id_cia2){
        /*
        $black1[0] = "id_cia";
        $black1[1] = "id_per";
        $add1['id_cia'] = $id_cia2;
        $ids = $this->copy_table("SELECT * FROM perfiles WHERE id_cia='".$id_cia1."'", $black1, $add1, "perfiles", "id_per");
        
        $this->tabla_intermedia($ids, "perfiles_tareas", "id_per");
        */
    }
    
    public function copy_table($sql_txt, $black, $add, $db_copy, $llave){
        
        $keys = array();
        $id = array();
        $values = array();
        $sql = $this->con->sql($sql_txt);
        
        if($sql['count'] > 0){
        
            $aux_keys = array_keys($sql['resultado'][0]);

            for($i=0; $i<count($aux_keys); $i++){
                if(!in_array($aux_keys[$i], $black)){
                    $keys[] = $aux_keys[$i];
                }
            }

            $add_keys = array_keys($add);
            $final_keys = array_merge($keys, $add_keys);

            for($i=0; $i<count($sql['resultado']); $i++){
                for($j=0; $j<count($keys); $j++){
                    $values[] = "'".$sql['resultado'][$i][$keys[$j]]."'";
                }
                for($j=0; $j<count($add_keys); $j++){
                    $values[] = "'".$add[$add_keys[$j]]."'";
                }
                $sqls = "INSERT INTO ".$db_copy." (".implode(",", $final_keys).") VALUES (".implode(",", $values).")";
                $res = $this->con->sql($sqls);
                //echo "<div style='font-size:1.8em'>".$sqls."</div>";
                if($llave !== null){
                    $id['nid'][] = $res['insert_id'];
                    $id['oid'][] = $sql['resultado'][$i][$llave];
                }
                unset($values);
            }
            return $id;
        
        }
        
    }
    
    public function delete_cuerpo($id_cue){
        
        $this->con->sql("DELETE FROM cuerpos WHERE id_cue='".$id_cue."'");
        
    }
    
    public function diffdates($fecha1, $fecha2, $type = 1){
        
        $date1 = new DateTime($fecha1);
        $date2 = new DateTime($fecha2);
        $diff = $date1->diff($date2);
        
        if($diff->y > 0){
            $aux = $diff->y;
            if($diff->y == 1){
                $aux .= " a&ntilde;o";
            }else{
                $aux .= " a&ntilde;os";
            }
            $difftxt[] = $aux;
        }
        if($diff->m > 0){
            $aux = $diff->m;
            if($diff->m == 1){
                $aux .= " mes";
            }else{
                $aux .= " meses";
            }
            $difftxt[] = $aux;
        }
        if($diff->d > 0){
            $aux = $diff->d;
            if($diff->d == 1){
                $aux .= " dia";
            }else{
                $aux .= " dias";
            }
            $difftxt[] = $aux;
        }
        if($diff->h > 0){
            $aux = $diff->h;
            if($diff->h == 1){
                $aux .= " hora";
            }else{
                $aux .= " horas";
            }
            $difftxt[] = $aux;
        }
        if($diff->i > 0){
            $aux = $diff->i;
            if($diff->i == 1){
                $aux .= " minuto";
            }else{
                $aux .= " minutos";
            }
            $difftxt[] = $aux;
        }
        if($diff->s > 0){
            $aux = $diff->s;
            if($diff->s == 1){
                $aux .= " segundo";
            }else{
                $aux .= " segundos";
            }
            $difftxt[] = $aux;
        }
        
        return implode(", ", $difftxt);
        
    }
    public function permiso_cia($result){
        
        if($result['count'] == 1 && $this->id_cia == $result['resultado'][0]['id_cia'] && $this->id_cue == $result['resultado'][0]['id_cue'] && $id_cia > 0){
            return true;
        }
        return false;
        
    }
    public function randstring($n){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $code = substr(str_shuffle($chars), 0, $n);
        return $code;
    }
    
    
}