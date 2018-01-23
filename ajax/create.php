<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-type: text/json');
header('Content-type: application/json');

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/fa_backend";
}else{
    $path .= "admin";
}
echo "A";
require_once($path."/class/guardar.php");
echo "B";
$guardar = new Guardar();
echo "C";
if($_GET['accion'] == "crear_cuerpo_pagina"){
    $data = $guardar->crear_cuerpo_pagina();
    echo json_encode($data);
    exit;
}

?>