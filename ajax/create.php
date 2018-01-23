<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
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

require_once($path_class."guardar.php");
$guardar = new Guardar();
$data = $guardar->crear_cuerpo_pagina();
echo json_encode($data);


?>