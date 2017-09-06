<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-type: text/json');
header('Content-type: application/json');

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/";
    $path_class = $path."/fa_backend/class/";
    $path_n = $path."/fa_backend/";
    
}else{
    $path_class = $path."admin/class/";
    $path_n = $path."admin/";
}

echo "0";
require_once($path_class."ingreso_class.php");
echo "1";
$ingreso = new Ingreso();
echo "2";
$info = $ingreso->login();
echo "3";
echo json_encode($info);
echo "4";

?>