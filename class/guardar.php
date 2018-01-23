<?php
session_start();

require_once $path_class."core.php";

class Guardar extends Core{
    
    public $con = null;
    public $id_cia = null;
    public $id_cue = null;
    
    public function __construct(){
        $this->con = new Conexion();
        $this->id_cia = $this->getciaid();
        $this->id_cue = $this->getcueid();
    }
    public function process(){
        
        if($_POST['accion'] == "crearcuerpo"){
            return $this->crearcuerpo();
        }
        if($_POST['accion'] == "eliminarcuerpo"){
            return $this->eliminarcuerpo();
        }
        if($_POST['accion'] == "crearcia"){
            return $this->crearcia();
        }
        if($_POST['accion'] == "eliminarcia"){
            return $this->eliminarcia();
        }
        if($_POST['accion'] == "crearusuariocia"){
            return $this->crearusuariocia();
        }
        if($_POST['accion'] == "eliminarusuariocia"){
            return $this->eliminarusuariocia();
        }
        if($_POST['accion'] == "crearusuariocue"){
            return $this->crearusuariocue();
        }
        if($_POST['accion'] == "eliminarusuariocue"){
            return $this->eliminarusuariocue();
        }
        if($_POST['accion'] == "crearperfilcia"){
            return $this->crearperfilcia();
        }
        if($_POST['accion'] == "eliminarperfilcia"){
            return $this->eliminarperfilcia();
        }
        if($_POST['accion'] == "crearperfilcue"){
            return $this->crearperfilcue();
        }
        if($_POST['accion'] == "eliminarperfilcue"){
            return $this->eliminarperfilcue();
        }
        if($_POST['accion'] == "crearcargoscia"){
            return $this->crearcargoscia();
        }
        if($_POST['accion'] == "eliminarcargoscia"){
            return $this->eliminarcargoscia();
        }
        if($_POST['accion'] == "crearcargoscue"){
            return $this->crearcargoscue();
        }
        if($_POST['accion'] == "eliminarcargoscue"){
            return $this->eliminarcargoscue();
        }
        if($_POST['accion'] == "asignartareascia"){
            return $this->asignartareascia();
        }
        if($_POST['accion'] == "asignartareascue"){
            return $this->asignartareascue();
        }
        if($_POST['accion'] == "creartipomaquina"){
            return $this->creartipomaquina();
        }
        if($_POST['accion'] == "eliminartipomaquina"){
            return $this->eliminartipomaquina();
        }
        if($_POST['accion'] == "crearcarrocia"){
            return $this->crearcarrocia();
        }
        if($_POST['accion'] == "eliminarcarrocia"){
            return $this->eliminarcarrocia();
        }
        if($_POST['accion'] == "asignarperfilusuariocia"){
            return $this->asignarperfilusuariocia();
        }
        if($_POST['accion'] == "asignarperfilusuariocue"){
            return $this->asignarperfilusuariocue();
        }
        if($_POST['accion'] == "asignartareascargocia"){
            return $this->asignartareascargocia();
        }
        if($_POST['accion'] == "asignartareascargocue"){
            return $this->asignartareascargocue();
        }
        if($_POST['accion'] == "creargrupocia"){
            return $this->creargrupocia();
        }
        if($_POST['accion'] == "eliminargrupocia"){
            return $this->eliminargrupocia();
        }
        if($_POST['accion'] == "creargrupocue"){
            return $this->creargrupocue();
        }
        if($_POST['accion'] == "eliminargrupocue"){
            return $this->eliminargrupocue();
        }
        
        if($_POST['accion'] == "creargrupovolcia"){
            return $this->creargrupovolcia();
        }
        if($_POST['accion'] == "eliminargrupovolcia"){
            return $this->eliminargrupovolcia();
        }
        if($_POST['accion'] == "creargrupovolcue"){
            return $this->creargrupovolcue();
        }
        if($_POST['accion'] == "eliminargrupovolcue"){
            return $this->eliminargrupovolcue();
        }
        if($_POST['accion'] == "crearclavecia"){
            return $this->crearclavecia();
        }
        if($_POST['accion'] == "crearclavecue"){
            return $this->crearclavecue();
        }
        if($_POST['accion'] == "eliminarclavecia"){
            return $this->eliminarclavecia();
        }
        if($_POST['accion'] == "eliminarclavecue"){
            return $this->eliminarclavecue();
        }
        if($_POST['accion'] == "crearactocia"){
            return $this->crearactocia();
        }
        if($_POST['accion'] == "eliminaractocia"){
            return $this->eliminaractocia();
        }
        if($_POST['accion'] == "crearactocue"){
            return $this->crearactocue();
        }
        if($_POST['accion'] == "eliminaractocue"){
            return $this->eliminaractocue();
        }
        if($_POST['accion'] == "crearllamado"){
            return $this->crearllamado();
        }
        if($_POST['accion'] == "asignarcargousuarioscia"){
            return $this->asignarcargousuarioscia();
        }
        if($_POST['accion'] == "configcia"){
            return $this->configcia();
        }
        if($_POST['accion'] == "configcue"){
            return $this->configcue();
        }

    }
    
    private function crearllamado(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $id_clave = $_POST['id_clave'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        
        $maquinas[0] = 14;
        $maquinas[1] = 17;
        
        for($i=0; $i<count($maquinas); $i++){
            
        }
        
        $ids = 1;
        $clave = "10-0-1";
        $direccion = "Jose Tomas Rider 1185";
        $secure = "Dkerbgerjf";
        
        $resp = file_get_contents("http://www.bridgeinformation.cl/crear_llamado?id=".$ids."&clave=".$clave."&direccion=".$direccion."&lat=".$lat."&lng=".$lng."&secure=".$secure);
        
        
    }
    private function crearactocia(){
        
        if(!$this->seguridad_permiso(10)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $clave = $_POST['clave'];
        $fecha = $_POST['fecha']; 

        if($id == 0){
            $aux = $this->con->sql("INSERT INTO actos (id_cla, fecha_creado, id_cia, id_cue) VALUES ('".$clave."', '".$fecha."', '".$this->id_cia."', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Acto creado exitosamente";
        }
        if($id > 0){
            $this->con->sql("UPDATE actos SET id_cla='".$clave."', fecha_creado='".$fecha."' WHERE id_act='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Acto modificado exitosamente";
        }
        
        $info['reload'] = 1;
        $info['page'] = "cia/actos.php";
        return $info;
        
    }
    private function crearactocue(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $clave = $_POST['clave'];
        $fecha = $_POST['fecha']; 

        if($id == 0){
            $aux = $this->con->sql("INSERT INTO actos (id_cla, fecha_creado, id_cia, id_cue) VALUES ('".$clave."', '".$fecha."', '0', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Acto creado exitosamente";
        }
        if($id > 0){
            $this->con->sql("UPDATE actos SET id_cla='".$clave."', fecha_creado='".$fecha."' WHERE id_act='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Acto modificado exitosamente";
        }
        
        $info['reload'] = 1;
        $info['page'] = "actos_cue.php";
        return $info;
        
    }
    private function eliminaractocia(){
        
        if(!$this->seguridad_permiso(10)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE actos SET fecha_eliminado=now(), eliminado='1' WHERE id_act='".$id."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Acto ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cia/actos.php";

        return $info;
        
    }
    private function eliminaractocue(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE actos SET fecha_eliminado=now(), eliminado='1' WHERE id_act='".$id."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Acto ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "actos_cia.php";

        return $info;
        
    }
    private function eliminarclavecia(){
        
        if(!$this->seguridad_permiso(9)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE claves SET fecha_eliminado=now(), eliminado='1' WHERE id_cla='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Clave ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cia/tipos_de_claves.php";

        return $info;
        
    }
    private function eliminarclavecue(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE claves SET fecha_eliminado=now(), eliminado='1' WHERE id_cla='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Clave ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "tipos_de_claves_cue.php";

        return $info;
        
    }
    private function crearclavecia(){
        
        if(!$this->seguridad_permiso(9)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $todos = $_POST['todos'];
        $falta = $_POST['falta'];
        $id_gru = $_POST['id_gru'];
        $asist = $_POST['asist'];
        $clave = $_POST['clave'];
        
        
        //$sincarros = $_POST['sincarros'];

        if($id == 0){
            $aux = $this->con->sql("INSERT INTO claves (nombre, clave, todos, iscia, tipo, id_gru, asist, falta, id_cia, id_cue) VALUES ('".$nombre."', '".$clave."', '".$todos."', '1', '3', '".$id_gru."', '".$asist."', '".$falta."', '".$this->id_cia."', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Clave creado exitosamente";
            $ids = $aux['insert_id'];
        }
        if($id > 0){
            $this->con->sql("UPDATE claves SET nombre='".$nombre."', clave='".$clave."', todos='".$todos."', id_gru='".$id_gru."', asist='".$asist."', falta='".$falta."' WHERE id_cla='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Clave modificado exitosamente";
            $ids = $id;
        }
        
        $info['reload'] = 1;
        $info['page'] = "cia/tipos_de_claves.php";
        return $info;
        
    }
    private function crearclavecue(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $todos = $_POST['todos'];
        $falta = $_POST['falta'];
        $id_gru = $_POST['id_gru'];
        $asist = $_POST['asist'];
        $clave = $_POST['clave'];
        
        $iscia = $_POST['origen'];
        $tipo = $_POST['tipo'];
        
        $grupo = $_POST['grupo'];
        
        //$sincarros = $_POST['sincarros'];

        if($id == 0){
            $aux = $this->con->sql("INSERT INTO claves (nombre, clave, todos, iscia, tipo, id_gru, asist, falta, id_cia, id_cue) VALUES ('".$nombre."', '".$clave."', '".$todos."', '".$iscia."', '".$tipo."', '".$id_gru."', '".$asist."', '".$falta."', '0', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Clave creado exitosamente";
            $ids = $aux['insert_id'];
        }
        if($id > 0){
            $this->con->sql("UPDATE claves SET nombre='".$nombre."', clave='".$clave."', todos='".$todos."', id_gru='".$id_gru."', asist='".$asist."', falta='".$falta."' WHERE id_cla='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Clave modificado exitosamente";
            $ids = $id;
        }
        
        $info['reload'] = 1;
        $info['page'] = "tipos_de_claves_cue.php";
        return $info;
        
    }
    private function creargrupovolcue(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        
        if($id == 0){
            $aux = $this->con->sql("INSERT INTO grupos (nombre, fecha_creado, iscargo, id_cia, id_cue) VALUES ('".$nombre."', now(), '0', '0', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Carro creado exitosamente";
            $ids = $aux['insert_id'];
        }
        if($id > 0){
            $this->con->sql("UPDATE grupos SET nombre='".$nombre."' WHERE id_gru='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Carro modificado exitosamente";
            $ids = $id;
        }
        
        $users = $this->get_usuarios_cue();
        for($i=0; $i<count($users); $i++){
            
            $tar = $_POST['users-'.$users[$i]['id_user']];
            if($tar == 0){
                $this->con->sql("DELETE FROM grupos_usuarios WHERE id_gru='".$ids."' AND id_user='".$users[$i]['id_user']."'");
            }
            if($tar == 1){
                $this->con->sql("INSERT INTO grupos_usuarios (id_gru, id_user) VALUES ('".$ids."', '".$users[$i]['id_user']."')");
            }
            
        }

        $info['reload'] = 1;
        $info['page'] = "grupos_cue_vol.php";
        return $info;
        
    }
    private function eliminargrupovolcue(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id = $_POST['id'];
        $this->con->sql("UPDATE grupos SET fecha_eliminado=now(), eliminado='1' WHERE iscargo='0' AND id_gru='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Grupo ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "grupos_cue_vol.php";

        return $info;
        
    }
    private function creargrupovolcia(){
        
        if(!$this->seguridad_permiso(7)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        
        if($id == 0){
            $aux = $this->con->sql("INSERT INTO grupos (nombre, fecha_creado, iscargo, id_cia, id_cue) VALUES ('".$nombre."', now(), '0', '".$this->id_cia."', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Carro creado exitosamente";
            $ids = $aux['insert_id'];
        }
        if($id > 0){
            $this->con->sql("UPDATE grupos SET nombre='".$nombre."' WHERE id_gru='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Carro modificado exitosamente";
            $ids = $id;
        }
        
        $users = $this->get_usuarios_cia();
        for($i=0; $i<count($users); $i++){
            
            $tar = $_POST['users-'.$users[$i]['id_user']];
            if($tar == 0){
                $this->con->sql("DELETE FROM grupos_usuarios WHERE id_gru='".$ids."' AND id_user='".$users[$i]['id_user']."'");
            }
            if($tar == 1){
                $this->con->sql("INSERT INTO grupos_usuarios (id_gru, id_user) VALUES ('".$ids."', '".$users[$i]['id_user']."')");
            }
            
        }

        $info['reload'] = 1;
        $info['page'] = "cia/grupo_vols.php";
        return $info;
        
    }
    private function eliminargrupovolcia(){
        
        if(!$this->seguridad_permiso(7)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id = $_POST['id'];
        $this->con->sql("UPDATE grupos SET fecha_eliminado=now(), eliminado='1' WHERE iscargo='0' AND id_gru='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Grupo ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cia/grupo_vols.php";

        return $info;
        
    }
    private function creargrupocue(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        
        if($id == 0){
            $aux = $this->con->sql("INSERT INTO grupos (nombre, fecha_creado, iscargo, id_cia, id_cue) VALUES ('".$nombre."', now(), '1', '0', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Carro creado exitosamente";
            $ids = $aux['insert_id'];
        }
        if($id > 0){
            $this->con->sql("UPDATE grupos SET nombre='".$nombre."' WHERE id_gru='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Carro modificado exitosamente";
            $ids = $id;
        }
        
        $cargos = $this->get_cargos_cue();
        for($i=0; $i<count($cargos); $i++){
            
            $tar = $_POST['carg-'.$cargos[$i]['id_carg']];
            if($tar == 0){
                $this->con->sql("DELETE FROM grupos_cargos WHERE id_gru='".$ids."' AND id_carg='".$cargos[$i]['id_carg']."'");
            }
            if($tar == 1){
                $this->con->sql("INSERT INTO grupos_cargos (id_gru, id_carg) VALUES ('".$ids."', '".$cargos[$i]['id_carg']."')");
            }
            
        }
        
        $info['reload'] = 1;
        $info['page'] = "grupos_cue.php";
        return $info;
        
        
    }
    private function eliminargrupocue(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id = $_POST['id'];
        $this->con->sql("UPDATE grupos SET fecha_eliminado=now(), eliminado='1' WHERE id_gru='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Grupo ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "grupos_cia.php";

        return $info;
        
    }
    private function creargrupocia(){
        
        if(!$this->seguridad_permiso(8)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        
        if($id == 0){
            $aux = $this->con->sql("INSERT INTO grupos (nombre, fecha_creado, iscargo, id_cia, id_cue) VALUES ('".$nombre."', now(), '1', '".$this->id_cia."', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Carro creado exitosamente";
            $ids = $aux['insert_id'];
        }
        if($id > 0){
            $this->con->sql("UPDATE grupos SET nombre='".$nombre."' WHERE id_gru='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Carro modificado exitosamente";
            $ids = $id;
        }
        
        $cargos = $this->get_cargos_cia();
        for($i=0; $i<count($cargos); $i++){
            
            $tar = $_POST['carg-'.$cargos[$i]['id_carg']];
            if($tar == 0){
                $this->con->sql("DELETE FROM grupos_cargos WHERE id_gru='".$ids."' AND id_carg='".$cargos[$i]['id_carg']."'");
            }
            if($tar == 1){
                $this->con->sql("INSERT INTO grupos_cargos (id_gru, id_carg) VALUES ('".$ids."', '".$cargos[$i]['id_carg']."')");
            }
            
        }

        $info['reload'] = 1;
        $info['page'] = "cia/grupo_cargos.php";
        return $info;
        
    }
    private function eliminargrupocia(){
        
        if(!$this->seguridad_permiso(8)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id = $_POST['id'];
        $this->con->sql("UPDATE grupos SET fecha_eliminado=now(), eliminado='1' WHERE id_gru='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Grupo ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cia/grupo_cargos.php";

        return $info;
        
    }
    private function asignarcargousuarioscia(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id_ucar = $_POST['id_ucar'];
        
        if($id_ucar == 0){
            // AGREGAR HISTORICO
            // REEMPLAZAR
        }
        if($id_ucar > 0){
            
            $id_user = $_POST['h_id_user'];
            $id_carg = $_POST['id_cargo'];
            $f_ini = $_POST['h_f_ini'];
            $f_fin = $_POST['h_f_fin'];
            
            if($this->is_usuario_cia($id_user)){
                if($this->is_cargo_cia($id_carg)){
                    $info['sql'] = $this->con->sql("UPDATE usuarios_cargos SET fecha_ini='".$f_ini."', fecha_fin='".$f_fin."' WHERE id_ucar='".$id_ucar."' AND id_user='".$id_user."'");
                }
            }                
            
        }
        return $info;
    }
    private function asignartareascargocia(){
        
        if(!$this->seguridad_permiso(6)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id_carg = $_POST['id'];
        $perfiles = $this->get_perfiles_cia();
        for($i=0; $i<count($perfiles); $i++){
            
            $per = $_POST['perfiles-'.$perfiles[$i]['id_per']];
            if($per == 0){
                $this->con->sql("DELETE FROM perfiles_cargos WHERE id_carg='".$id_carg."' AND id_per='".$perfiles[$i]['id_per']."'");
            }
            if($per == 1){
                $this->con->sql("INSERT INTO perfiles_cargos (id_carg, id_per) VALUES ('".$id_carg."', '".$perfiles[$i]['id_per']."')");
            }
            
        }
        $info['op'] = 1;
        $info['mensaje'] = "Perfiles asociados exitosamente";
        $info['reload'] = 1;
        $info['page'] = "cia/cargos.php";
        return $info;
        
    }
    private function asignartareascargocue(){
        
        if(!$this->seguridad_permiso(6)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id_carg= $_POST['id'];
        $perfiles = $this->get_perfiles_cue();
        for($i=0; $i<count($perfiles); $i++){
            
            $per = $_POST['perfiles-'.$perfiles[$i]['id_per']];
            if($per == 0){
                $this->con->sql("DELETE FROM perfiles_cargos WHERE id_carg='".$id_carg."' AND id_per='".$perfiles[$i]['id_per']."'");
            }
            if($per == 1){
                $this->con->sql("INSERT INTO perfiles_cargos (id_carg, id_per) VALUES ('".$id_carg."', '".$perfiles[$i]['id_per']."')");
            }
            
        }
        $info['op'] = 1;
        $info['mensaje'] = "Perfiles asociados exitosamente";
        $info['reload'] = 1;
        $info['page'] = "cargos_cue.php";
        return $info;
        
    }
    private function asignarperfilusuariocia(){
        
        if(!$this->seguridad_permiso(6)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id_user = $_POST['id'];
        $perfiles = $this->get_perfiles_cia();
        for($i=0; $i<count($perfiles); $i++){
            
            $per = $_POST['perfiles-'.$perfiles[$i]['id_per']];
            if($per == 0){
                $this->con->sql("DELETE FROM perfiles_usuarios WHERE id_user='".$id_user."' AND id_per='".$perfiles[$i]['id_per']."'");
            }
            if($per == 1){
                $this->con->sql("INSERT INTO perfiles_usuarios (id_user, id_per) VALUES ('".$id_user."', '".$perfiles[$i]['id_per']."')");
            }
            
        }
        $info['op'] = 1;
        $info['mensaje'] = "Perfiles asociados exitosamente";
        $info['reload'] = 1;
        $info['page'] = "cia/usuarios.php";
        return $info;
        
    }
    private function asignarperfilusuariocue(){
        
        if(!$this->seguridad_permiso(16)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        $id_user = $_POST['id'];
        $perfiles = $this->get_perfiles_cue();
        for($i=0; $i<count($perfiles); $i++){
            
            $per = $_POST['perfiles-'.$perfiles[$i]['id_per']];
            if($per == 0){
                $this->con->sql("DELETE FROM perfiles_usuarios WHERE id_user='".$id_user."' AND id_per='".$perfiles[$i]['id_per']."'");
            }
            if($per == 1){
                $this->con->sql("INSERT INTO perfiles_usuarios (id_user, id_per) VALUES ('".$id_user."', '".$perfiles[$i]['id_per']."')");
            }
            
        }
        $info['op'] = 1;
        $info['mensaje'] = "Perfiles asociados exitosamente";
        $info['reload'] = 1;
        $info['page'] = "cue/usuarios.php";
        return $info;
        
    }
    private function crearcarrocia(){
        
        if(!$this->seguridad_permiso(9)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $id_cia = $_POST['id_cia'];
        
        if($id == 0){
            $aux = $this->con->sql("INSERT INTO carros (nombre, fecha_creado, id_cia, id_cue) VALUES ('".$nombre."', now(), '".$id_cia."', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Carro creado exitosamente";
            $ids = $aux['insert_id'];
        }
        if($id > 0){
            $this->con->sql("UPDATE carros SET nombre='".$nombre."' WHERE id_car='".$id."' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Carro modificado exitosamente";
            $ids = $id;
        }
        
        $tdc = $this->get_tipos_maquinas();
        for($i=0; $i<count($tdc); $i++){
            
            $tar = $_POST['tdc-'.$tdc[$i]['id_tdc']];
            if($tar == 0){
                $this->con->sql("DELETE FROM carros_tipo WHERE id_car='".$ids."' AND id_tdc='".$tdc[$i]['id_tdc']."'");
            }
            if($tar == 1){
                $this->con->sql("INSERT INTO carros_tipo (id_car, id_tdc) VALUES ('".$ids."', '".$tdc[$i]['id_tdc']."')");
            }
            
        }
        
        $info['reload'] = 1;
        $info['page'] = "carros.php?id=".$id_cia;
        return $info;
        
    }
    private function eliminarcarrocia(){
        
        if(!$this->seguridad_permiso(9)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $id_cia = $this->con->sql("SELECT id_cia FROM carros WHERE id_car='".$id."' AND id_cue='".$this->id_cue."'");
        $this->con->sql("UPDATE carros SET fecha_eliminado=now(), eliminado='1' WHERE id_car='".$id."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Carro ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "carros.php?id=".$id_cia['resultado'][0]['id_cia'];

        return $info;
        
    }
    private function creartipomaquina(){
        
        if(!$this->seguridad_permiso(8)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];

        if($id == 0){
            $this->con->sql("INSERT INTO tipos_de_carros (nombre, fecha_creado, id_cue) VALUES ('".$nombre."', now(), '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Tipo de Maquina creada exitosamente";
        }
        if($id > 0){
            $this->con->sql("UPDATE tipos_de_carros SET nombre='".$nombre."' WHERE id_tdc='".$id."' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Tipo de Maquina modificada exitosamente";
        }
        
        $info['reload'] = 1;
        $info['page'] = "tipos_de_maquina.php";
        return $info;
        
    }
    private function eliminartipomaquina(){
        
        if(!$this->seguridad_permiso(8)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE tipos_de_carros SET fecha_eliminado=now(), eliminado='1' WHERE id_tdc='".$id."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Tipo de Maquinas ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "tipos_de_maquina.php";

        return $info;
        
    }
    private function asignartareascia(){
        
        if(!$this->seguridad_permiso(5)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        // PROBLEMAS DE SEGURIDAD ID PERFIL //
        $id_per = $_POST["id"];
        $tcia = $this->get_tareas_cia('normal');
        
        for($i=0; $i<count($tcia); $i++){
            
            $tar = $_POST['tareas-'.$tcia[$i]['id_tar']];
            if($tar == 0){
                $this->con->sql("DELETE FROM perfiles_tareas WHERE id_tar='".$tcia[$i]['id_tar']."' AND id_per='".$id_per."'");
            }
            if($tar == 1){
                $this->con->sql("INSERT INTO perfiles_tareas (id_tar, id_per) VALUES ('".$tcia[$i]['id_tar']."', '".$id_per."')");
            }
            
        }
        $info['op'] = 1;
        $info['mensaje'] = "Cuerpo creada exitosamente";
        $info['reload'] = 1;
        $info['page'] = "cia/perfiles.php";
        return $info;
        
    }
    private function asignartareascue(){
        
        if(!$this->seguridad_permiso(6)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        // PROBLEMAS DE SEGURIDAD ID PERFIL //
        $id_per = $_POST["id"];
        $tcue = $this->get_tareas_cue('normal');
        
        for($i=0; $i<count($tcue); $i++){
            $tar = $_POST['tareas-'.$tcue[$i]['id_tar']];
            if($tar == 0){
                $this->con->sql("DELETE FROM perfiles_tareas WHERE id_tar='".$tcue[$i]['id_tar']."' AND id_per='".$id_per."'");
            }
            if($tar == 1){
                $this->con->sql("INSERT INTO perfiles_tareas (id_tar, id_per) VALUES ('".$tcue[$i]['id_tar']."', '".$id_per."')");
            }
        }
        $info['op'] = 1;
        $info['mensaje'] = "Cuerpo creada exitosamente";
        $info['reload'] = 1;
        $info['page'] = "perfiles_cue.php";
        return $info;
        
    }
    
    public function crear_cuerpo_pagina(){
          
        $cue_nom = $_POST['cue_nom'];
        $cue_reg = $_POST['cue_reg'];
        $adm_nom = $_POST['adm_nom'];
        $adm_cor = $_POST['adm_cor'];
        $adm_tel = $_POST['adm_tel'];
        
        $ip = $this->get_client_ip_env();
        
        $info['msg1'] = "";
        $info['msg2'] = "";
        $info['ip'] = $ip;
        
        return $info;
        
    }
    function get_client_ip_env() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
    // CUERPOS //
    private function crearcuerpo(){
        
        if(!$this->seguridad_usuario()){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $sigla = $_POST['sigla'];
        
        if($id > 0){
            $this->con->sql("UPDATE cuerpos SET nombre='".$nombre."', sigla='".$sigla."' WHERE id_cue='".$id."'");
            $info['op'] = 1;
            $info['mensaje'] = "Categoria modificada exitosamente";
        }
        if($id == 0){
            
            $cue = $this->con->sql("INSERT INTO cuerpos (nombre, fecha_creado, sigla) VALUES ('".$nombre."', now(), '".$sigla."')");
            $info['op'] = 1;
            $info['mensaje'] = "Cuerpo creada exitosamente";
            $id = $cue['insert_id'];
            
            $nadmin = $_POST['nombreadmin'];
            $cadmin = $_POST['correoadmin'];
            
            $user = $this->con->sql("INSERT INTO usuarios (nombre, correo, pass, fecha_creado, id_cue) VALUES ('".$nadmin."', '".$cadmin."', '25d55ad283aa400af464c76d713c07ad', now(), '".$id."')");
            $id_user = $user['insert_id'];
            $this->con->sql("INSERT INTO perfiles_usuarios (id_user, id_per) VALUES ('".$id_user."', '10')");
            
        }
        
        
        $gtar = $this->get_grupos_tareas();
        for($i=0; $i<count($gtar); $i++){
            if($_POST["gtarea-".$gtar[$i]['id_gtar']] == 0){
                $this->con->sql("DELETE FROM tarea_grupo_cuerpo WHERE id_cue='".$id."' AND id_gtar='".$gtar[$i]['id_gtar']."'");
            }else{
                $this->con->sql("INSERT INTO tarea_grupo_cuerpo (id_cue, id_gtar) VALUES ('".$id."', '".$gtar[$i]['id_gtar']."')");
            }
        }
        
        $info['reload'] = 1;
        $info['page'] = "crear_cuerpo.php";
        return $info;
        
    }
    public function eliminarcuerpo(){
        
        if(!$this->seguridad_usuario()){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE cuerpos SET fecha_eliminado=now(), eliminado='1' WHERE id_cue='".$id."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Cuerpo ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "crear_cuerpo.php";

        return $info;
        
    }
    
    // COMPANIAS //
    private function crearcia(){
        
        if(!$this->seguridad_permiso(7)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $numero = $_POST['numero'];

        if($id == 0){
            $this->con->sql("INSERT INTO companias (nombre, fecha_creado, numero, id_cue) VALUES ('".$nombre."', now(), '".$numero."', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Cuerpo creada exitosamente";
        }
        if($id > 0){
            $this->con->sql("UPDATE companias SET nombre='".$nombre."', numero='".$numero."' WHERE id_cia='".$id."' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Categoria modificada exitosamente";
        }
        
        $info['reload'] = 1;
        $info['page'] = "crear_cias.php";
        return $info;
        
    }
    public function eliminarcia(){
        
        if(!$this->seguridad_permiso(7)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE companias SET fecha_eliminado=now(), eliminado='1' WHERE id_cia='".$id."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Compania ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "crear_cias.php";

        return $info;
        
    }
    
    // USUARIOS //
    private function crearusuariocia(){
        
        if(!$this->seguridad_permiso(1)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            
            $exist = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$correo."'");
            if($exist['count'] == 0){
                // NO EXISTE
                if($id == 0){
                    $this->con->sql("INSERT INTO usuarios (nombre, correo, fecha_creado, id_cia, id_cue) VALUES ('".$nombre."', '".$correo."', now(), '".$this->id_cia."', '".$this->id_cue."')");
                    $info['op'] = 1;
                    $info['mensaje'] = "Usuario creado exitosamente";
                }
                if($id > 0){
                    $this->con->sql("UPDATE usuarios SET nombre='".$nombre."', correo='".$correo."' WHERE id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."' AND id_user='".$id."' AND eliminado='0'");
                    $info['op'] = 1;
                    $info['mensaje'] = "Usuario modificado exitosamente";
                }
                $info['reload'] = 1;
                $info['page'] = "cia/usuarios.php";
                
            }
            if($exist['count'] == 1){
                // SI EXISTE
                if($id == 0){
                    
                    $info['op'] = 2;
                    $info['mensaje'] = "Error: Correo ya existe";
                    
                }
                if($id > 0){
                    
                    // MODIFICAR NORMAL
                    if($exist['resultado'][0]['eliminado'] == 0 && $id == $exist['resultado'][0]['id_user']){
                        $this->con->sql("UPDATE usuarios SET nombre='".$nombre."' WHERE id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."' AND eliminado='0' AND id_user='".$id."'");
                        $info['op'] = 1;
                        $info['mensaje'] = "Usuario modificado exitosamente";
                        $info['reload'] = 1;
                        $info['page'] = "cia/usuarios.php";
                    }
                    // REINGRESAR USUARIO EXISTENTE
                    if($exist['resultado'][0]['eliminado'] == 1){
                        $this->con->sql("UPDATE usuarios SET nombre='".$nombre."', id_cia='".$this->id_cia."', id_cue='".$this->id_cue."', eliminado='0' WHERE id_user='".$exist['resultado'][0]['id_user']."'");
                        $info['op'] = 1;
                        $info['mensaje'] = "Usuario ingresado exitosamente";
                        $info['reload'] = 1;
                        $info['page'] = "cia/usuarios.php";
                    }
                    
                }
            }
            
        }else{
            $info['op'] = 2;
            $info['mensaje'] = "Error: Correo Invalido";
        }
        
        
        return $info;
        
    }
    public function eliminarusuariocia(){
        
        if(!$this->seguridad_permiso(1)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE usuarios SET fecha_eliminado=now(), eliminado='1' WHERE id_user='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Usuario ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cia/usuarios.php";

        return $info;
        
    }
    
    private function crearusuariocue(){
        
        if(!$this->seguridad_permiso(12)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $id_cia = $_POST['id_cia'];
        
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            
            $exist = $this->con->sql("SELECT * FROM usuarios WHERE correo='".$correo."'");
            if($exist['count'] == 0){
                // NO EXISTE
                if($id == 0){
                    $this->con->sql("INSERT INTO usuarios (nombre, correo, fecha_creado, id_cia, id_cue) VALUES ('".$nombre."', '".$correo."', now(), '".$id_cia."', '".$this->id_cue."')");
                    $info['op'] = 1;
                    $info['mensaje'] = "Usuario creado exitosamente";
                }
                if($id > 0){
                    $this->con->sql("UPDATE usuarios SET nombre='".$nombre."', correo='".$correo."', id_cia='".$id_cia."' WHERE id_cue='".$this->id_cue."' AND id_user='".$id."' AND eliminado='0'");
                    $info['op'] = 1;
                    $info['mensaje'] = "Usuario modificado exitosamente";
                }
                $info['reload'] = 1;
                $info['page'] = "cue/usuarios.php";
                
            }
            if($exist['count'] == 1){
                // SI EXISTE
                if($id == 0){
                    
                    $info['op'] = 2;
                    $info['mensaje'] = "Error: Correo ya existe";
                    
                }
                if($id > 0){
                    
                    // MODIFICAR NORMAL
                    if($exist['resultado'][0]['eliminado'] == 0 && $id == $exist['resultado'][0]['id_user']){
                        $this->con->sql("UPDATE usuarios SET nombre='".$nombre."', id_cia='".$id_cia."' WHERE id_cue='".$this->id_cue."' AND eliminado='0' AND id_user='".$id."'");
                        $info['op'] = 1;
                        $info['mensaje'] = "Usuario modificado exitosamente";
                        $info['reload'] = 1;
                        $info['page'] = "cue/usuarios.php";
                    }
                    // REINGRESAR USUARIO EXISTENTE
                    if($exist['resultado'][0]['eliminado'] == 1){
                        $this->con->sql("UPDATE usuarios SET nombre='".$nombre."', id_cia='".$id_cia."', id_cue='".$this->id_cue."', eliminado='0' WHERE id_user='".$exist['resultado'][0]['id_user']."'");
                        $info['op'] = 1;
                        $info['mensaje'] = "Usuario ingresado exitosamente";
                        $info['reload'] = 1;
                        $info['page'] = "cue/usuarios.php";
                    }
                    
                }
            }
            
        }else{
            $info['op'] = 2;
            $info['mensaje'] = "Error: Correo Invalido";
        }
        
        
        return $info;
        
    }
    public function eliminarusuariocue(){
        
        if(!$this->seguridad_permiso(12)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE usuarios SET fecha_eliminado=now(), eliminado='1' WHERE id_user='".$id."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Usuario ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cue/usuarios.php";

        return $info;
        
    }
    
    // PERFIL //
    private function crearperfilcia(){
        
        if(!$this->seguridad_permiso(5)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        
        if($id == 0){
            $this->con->sql("INSERT INTO perfiles (nombre, fecha_creado, id_cia, id_cue) VALUES ('".$nombre."', now(), '".$this->id_cia."', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Perfil creado exitosamente";
        }
        if($id > 0){
            $this->con->sql("UPDATE perfiles SET nombre='".$nombre."' WHERE id_per='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Perfil modificado exitosamente";
        }
        
        $info['reload'] = 1;
        $info['page'] = "cia/perfiles.php";
        return $info;
        
    }
    public function eliminarperfilcia(){
        
        if(!$this->seguridad_permiso(5)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE perfiles SET fecha_eliminado=now(), eliminado='1' WHERE id_per='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cia."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Perfil ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cia/perfiles.php";

        return $info;
        
    }
    private function crearperfilcue(){
        
        if(!$this->seguridad_permiso(6)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        
        if($id == 0){
            $this->con->sql("INSERT INTO perfiles (nombre, fecha_creado, id_cia, id_cue) VALUES ('".$nombre."', now(), '0', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Perfil creado exitosamente";
        }
        if($id > 0){
            $this->con->sql("UPDATE perfiles SET nombre='".$nombre."' WHERE id_per='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Perfil modificado exitosamente";
        }
        
        $info['reload'] = 1;
        $info['page'] = "perfiles_cue.php";
        return $info;
        
    }
    public function eliminarperfilcue(){
        
        if(!$this->seguridad_permiso(6)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE perfiles SET fecha_eliminado=now(), eliminado='1' WHERE id_per='".$id."' AND id_cia='0' AND id_cue='".$this->id_cia."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Perfil ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "perfiles_cue.php";

        return $info;
        
    }
    
    // CARGOS //
    private function crearcargoscia(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        
        if($id == 0){
            $this->con->sql("INSERT INTO cargos (nombre, cantidad, iscia, fecha_creado, id_cia, id_cue) VALUES ('".$nombre."', '".$cantidad."', 1, now(), '".$this->id_cia."', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Cargo creado exitosamente";
        }
        if($id > 0){
            $this->con->sql("UPDATE cargos SET nombre='".$nombre."', cantidad='".$cantidad."' WHERE id_carg='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cue."' AND eliminado='0'");
            $info['op'] = 1;
            $info['mensaje'] = "Cargo modificado exitosamente";
        }
        
        $info['reload'] = 1;
        $info['page'] = "cia/cargos.php";
        return $info;
        
    }
    public function eliminarcargoscia(){
        
        if(!$this->seguridad_permiso(3)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE cargos SET fecha_eliminado=now(), eliminado='1' WHERE id_carg='".$id."' AND id_cia='".$this->id_cia."' AND id_cue='".$this->id_cia."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Cargo ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cia/cargos.php";

        return $info;
        
    }
    private function crearcargoscue(){
        
        if(!$this->seguridad_permiso(13)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $iscia= $_POST['iscia'];
        $ismando= $_POST['ismando'];
        
        if($id == 0){
            $this->con->sql("INSERT INTO cargos (nombre, cantidad, iscia, ismando, fecha_creado, id_cia, id_cue) VALUES ('".$nombre."', '".$cantidad."', '".$iscia."', '".$ismando."', now(), '0', '".$this->id_cue."')");
            $info['op'] = 1;
            $info['mensaje'] = "Cargo creado exitosamente";
        }
        if($id > 0){
            $this->con->sql("UPDATE cargos SET nombre='".$nombre."', cantidad='".$cantidad."', iscia='".$iscia."', ismando='".$ismando."' WHERE id_carg='".$id."' AND id_cia='0' AND id_cue='".$this->id_cue."'");
            $info['op'] = 1;
            $info['mensaje'] = "Cargo modificado exitosamente";
        }
        
        $info['reload'] = 1;
        $info['page'] = "cue/cargos.php";
        return $info;
        
    }
    public function eliminarcargoscue(){
        
        if(!$this->seguridad_permiso(13)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $id = $_POST['id'];
        $this->con->sql("UPDATE cargos SET fecha_eliminado=now(), eliminado='1' WHERE id_carg='".$id."' AND id_cue='".$this->id_cue."'");
        
        $info['tipo'] = "success";
        $info['titulo'] = "Eliminado";
        $info['texto'] = "Cargo ".$_POST["nombre"]." Eliminado";
        $info['reload'] = 1;
        $info['page'] = "cue/cargos.php";

        return $info;
        
    }
    
    private function configcia(){
        
        if(!$this->seguridad_permiso(11)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $nombre = $_POST["nombre"];
        $this->con->sql("UPDATE companias SET nombre='".$nombre."' WHERE id_cia='".$this->id_cia."'");
        
        $info['op'] = 1;
        $info['mensaje'] = "Datos modificados Exitosamente";
        $info['reload'] = 1;
        $info['page'] = "cia/config.php";
        return $info;
        
    }
    private function configcue(){
        
        if(!$this->seguridad_permiso(21)){
            $info['op'] = 2;
            $info['mensaje'] = "No tiene los permisos para ejecutar esta Tarea";
            return $info;
        }
        
        $nombre = $_POST["nombre"];
        $this->con->sql("UPDATE cuerpos SET nombre='".$nombre."' WHERE id_cue='".$this->id_cue."'");
        
        $info['op'] = 1;
        $info['mensaje'] = "Datos modificados Exitosamente";
        $info['reload'] = 1;
        $info['page'] = "cue/config.php";
        return $info;
        
    }
    
}
