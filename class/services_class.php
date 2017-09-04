<?php
session_start();

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
            
            $lat = $_GET['lat'];
            $lng = $_GET['lng'];
            $coords = $this->getBoundaries($lat, $lng, 1);
            $grifos = $this->con->sql("SELECT * FROM grifos WHERE (lat BETWEEN ".$coords["min_lat"]." AND ".$coords["max_lat"].") AND (lng BETWEEN ".$coords['min_lng']." AND ".$coords['max_lng'].")");
            return $grifos;
            
        }
        
    }
    
}

?>