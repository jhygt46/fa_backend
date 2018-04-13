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

require_once($path_class."login_class.php");
$login = new Login();

$data = "Hola Mundo: ";
if($_POST['accion'] == "login"){
    $data = $ingreso->login_app();
    $data = "Hola Login: ";
}
if($_POST['accion'] == "recuperar"){
    $data = $login->enviar_clave();
    $data = "Hola Recuperar: ";
}

echo json_encode($data);

