<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-type: text/json');
header('Content-type: application/json');

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path_class .= "/fa_backend/class";
    $path_n .= "/fa_backend";
    $path .= "/";
}else{
    $path_class .= "admin/class";
    $path_n .= "admin";
}

echo $path_class."<br>";
echo $path_n."<br>";
echo $path."<br>";
exit;

require_once($path_class."/ingreso_class.php");
$ingreso = new Ingreso();
$info = $ingreso->login();
echo json_encode($info);

?>