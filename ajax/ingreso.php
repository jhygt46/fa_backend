<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-type: text/json');
header('Content-type: application/json');

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/fa_backend/class";
}else{
    $path .= "admin/class";
}

/*
$postdata = file_get_contents("php://input");
$tipo = $postdata->tipo;
$tipo = "noapp";
*/

require_once($path_."/ingreso_class.php");
$ingreso = new Ingreso();
$info = $ingreso->login();
echo json_encode($info);

?>