<?php
session_start();
date_default_timezone_set('America/Santiago');

require_once $path_class."core.php";

class Services extends Core{
    
    public $con = null;
    public $id_cia = null;
    public $id_cue = null;
    
    public function __construct(){
        
        $this->id_cia = $this->getciaid();
        $this->id_cue = $this->getcueid();
        $this->con = new Conexion();
        
    }
    public function process(){
        
        if($_GET['accion'] == "getGrifos"){
            return $this->getgrifos($_GET['lat'], $_GET['lng']);
        }
        if($_GET['accion'] == "getLlamados"){
            return $this->getllamados();
        }
        if($_GET['accion'] == "getLlamado"){
            return $this->getllamado($_GET['id']);
        }
        
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
        
        $fecha = date("Y-m-d h:i:s", strtotime("-1 day"));
        $actos = $this->con->sql("SELECT t1.id_act, t2.nombre, t2.clave, t1.direccion, t1.comuna, t1.lat, t1.lng, t1.id_cia, t1.fecha_creado FROM actos t1, claves t2 WHERE t1.fecha_creado >= '".$fecha."' AND t1.id_cla=t2.id_cla AND t2.tipo=1");
        
        if($actos['count'] > 0){
            $lis_actos = $actos['resultado'];
            for($i=0; $i<$actos['count']; $i++){
                
                $aux = array();
                $aux['informacion']['id_act'] = $lis_actos[$i]['id_act'];
                $aux['informacion']['nombre'] = $lis_actos[$i]['nombre'];
                $aux['informacion']['clave'] = $lis_actos[$i]['clave'];
                $aux['informacion']['direccion'] = $lis_actos[$i]['direccion'];
                $aux['informacion']['lat'] = $lis_actos[$i]['lat'];
                $aux['informacion']['lng'] = $lis_actos[$i]['lng'];
                $aux['informacion']['fecha'] = $lis_actos[$i]['fecha_creado'];
                $aux['informacion']['fecha_fin'] = 0;
                
                $cias = $this->con->sql("SELECT t1.id_cia, t2.nombre FROM actos_cias t1, companias t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_cia=t2.id_cia");
                if($cias['count'] > 0){
                    for($j=0; $j<$cias['count']; $j++){
                        $aux_cias['id_cia'] = $cias['resultado'][$j]['id_cia'];
                        $aux_cias['nombre'] = $cias['resultado'][$j]['nombre'];
                        $aux_cias['acargo'] = "JUANITO PEREZ";
                        $aux_cias['cantidad'] = 12;
                        $aux['informacion']['cias'][] = $aux_cias;
                        unset($aux_cias);
                    }
                }
                
                $carros = $this->con->sql("SELECT t1.id_car, t2.nombre FROM actos_carros t1, carros t2 WHERE t1.id_act='".$lis_actos[$i]['id_act']."' AND t1.id_car=t2.id_car");
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
                        $aux['informacion']['carros'][] = $aux_carros;
                        unset($aux_carros);
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
                        $aux['informacion']['voluntarios'][] = $aux_vol;
                        unset($aux_vol);
                    }
                }
                
                $aux['informacion']['grifos'] = $this->getgrifos($lis_actos[$i]['lat'], $lis_actos[$i]['lng']);
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
    
}

?>