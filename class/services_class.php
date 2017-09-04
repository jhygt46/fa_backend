<?php
session_start();

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/";
    $path_class = $path."/fa_backend/class/";
    $path_n = $path."/fa_backend/";
    
}else{
    $path_class = $path."admin/class/";
    $path_n = $path."admin/";
}

require_once $path_class.'mysql_class.php';
require_once $path_class.'core.php';

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
            return $coords;
            
        }
        
    }
    
}

?>