<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-type: text/json');
header('Content-type: application/json');

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/";
}

$postdata = file_get_contents("php://input");
$tipo = $postdata->tipo;
print_r($postdata);
print_r($postdata->tipo);

if($tipo == "app"){

    $info['id'] = 5;
    $info['id_cue'] = 1;
    $info['token'] = "abo9aP115dFmX6iu29";
    
}else{
    
    $path_ = $path."admin/class";
    require_once($path_."/ingreso_class.php");
    $ingreso = new Ingreso();
    $info = $ingreso->ingresar_user();
    
}
echo json_encode($info);

?>