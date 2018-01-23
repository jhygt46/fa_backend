<?php

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $pathb = $path;
    $path .= "/fa_backend";
}else{
    $pathb = $path;
    $path .= "admin";
}


echo "C1";
echo $path."/db_config.php";
require_once ($path."/db_config.php");
echo "C2";
require_once ($pathb."/config/config.php");
echo "C3";

class Conexion {
    
    public $conn = null;
    public $host = null;
    public $usuario = null;
    public $password = null;
    public $base_datos = null;

    public function __construct(){

        global $db_host;
        global $db_user;
        global $db_password;
        global $db_database;

        $rand = rand(0, count($db_host) - 1);
        
        $this->host = $db_host[$rand];
        $this->usuario = $db_user[$rand];
        $this->password = $db_password[$rand];
        $this->base_datos = $db_database[0];
        //$this->conn = mysqli_connect($this->host, $this->usuario, $this->password, $this->base_datos);
        $this->conn = new mysqli($this->host, $this->usuario, $this->password, $this->base_datos);
        
    }

    public function sql($sql){
        
        $resultado['query'] = $sql;
        
        if ($this->conn->connect_error){
            
            $resultado['estado'] = false;
            $resultado['error'] = "Failed1: ".$this->conn->connect_error;
            
        } 
        
        $res = $this->conn->query($sql);

        if ($res == TRUE){
            
            $resultado['estado'] = true;
            if (preg_match("/select/i", $sql)){
                while($row = $res->fetch_assoc()){
                    $resultado['resultado'][] = $row;
                }
                $resultado['count'] = $res->num_rows;
                $res->free();
            }
            if (preg_match("/insert/i", $sql)){
                $resultado['insert_id'] = $this->conn->insert_id;
            }
            $resultado['affected_rows'] = $this->conn->affected_rows;
            
        }else{
            
            $resultado['estado'] = false;
            $resultado['error'] = "Failed2: ".$this->conn->error;
            
        }

        return $resultado;
        
    }

    public function __destruct(){
        $this->conn->close();
    }


}

?>