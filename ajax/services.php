<?php
session_start();

header('Content-type: text/json');
header('Content-type: application/json');
/*
$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/";
}

$path_ = $path."fa_backend/class";
require_once($path_."/core.php");
$core = new Core();
*/
if($_POST["accion"] == "getllamados"){
    
    //$data = $core->get_llamados();
    $e[0]['id'] = 1;
    $e[0]['clave'] = "10-0-1";
    
    $e[1]['id'] = 1;
    $e[1]['clave'] = "10-0-1";
    
    $e[2]['id'] = 1;
    $e[2]['clave'] = "10-0-1";
    $data = $e;
    
}
if($_POST["accion"] == "getCarros"){
    
    $data = $core->get_carros();
    
}
if($_GET["accion"] == "getGrifos"){
    
    $lat = $_GET["lat"];
    $lng = $_GET["lng"];
    
    $e['grifos'][0]['lat'] = 3;
    $e['grifos'][0]['lng'] = 4;
    $e['grifos'][1]['lat'] = 3;
    $e['grifos'][1]['lng'] = 4;
    $e['grifos'][2]['lat'] = 3;
    $e['grifos'][2]['lng'] = 4;
    $data = $e;
    
}
echo json_encode($data);

?>



























// INFORMACION BASICA //

$e['clave'] = "10-0-1";
$e['direccion'] = "Avda Francisco de Bilbao 1185, Proviencia";
$e['date'] = "2017-07-27 14:15:23";

$e['lat'] = "-33.4397973";
$e['lng'] = "-70.6169393";

$e['acargo_cue_id'] = 1085;
$e['acargo_cue_nombre'] = "Diego Gomez B";
$e['acargo_cue_cargo'] = "Voluntario";

// OBJETO VOLUNTARIOS //

$voluntarios['id'] = 1564;
$voluntarios['nombre'] = "Diego Gomez B";
$voluntarios['cargo'] = "Ayudante de Capitania";
$voluntarios['antiguedad'] = 6464;
$voluntarios['lat'] = "-33.4397973";
$voluntarios['lng'] = "-70.6169393";
$voluntarios['id_cia'] = 1264;

$e['voluntarios'][] = $voluntarios;

$voluntarios['id'] = 1565;
$voluntarios['nombre'] = "Juan Gomez B";
$voluntarios['cargo'] = "Voluntario";
$voluntarios['antiguedad'] = 6465;
$voluntarios['lat'] = "-33.4377973";
$voluntarios['lng'] = "-70.6269393";
$voluntarios['id_cia'] = 1254;

$e['voluntarios'][] = $voluntarios;

$voluntarios['id'] = 1566;
$voluntarios['nombre'] = "Fernando Gomez M";
$voluntarios['cargo'] = "Voluntario";
$voluntarios['antiguedad'] = -634;
$voluntarios['posicion']['lat'] = "-33.4377973";
$voluntarios['posicion']['lng'] = "-70.6269393";
$voluntarios['id_cia'] = 1254;

$e['voluntarios'][] = $voluntarios;


// OBJETO CARROS //

$carros['id'] = 5;
$carros['nombre'] = "B13";
$carros['cargo_vol_id'] = 1264;
$carros['conductor'] = "Vladimir Montecinos";
$carros['lat'] = "-33.4377973";
$carros['lng'] = "-70.6269393";
$carros['in'][0] = 1564;
$carros['in'][1] = 1565;
$carros['in'][2] = 1566;

$e['carros'][] = $carros;

$carros['id'] = 6;
$carros['nombre'] = "B14";
$carros['cargo_vol_id'] = 1267;
$carros['conductor'] = "Roberto Ceballos";
$carros['lat'] = "-33.4377973";
$carros['lng'] = "-70.6269393";
$carros['in'][0] = 1567;
$carros['in'][1] = 1568;
$carros['in'][2] = 1569;

$e['carros'][] = $carros;


// GRIFOS // 

$e['grifos'][0]['lat'] = "-33.4397973";
$e['grifos'][0]['lng'] = "-70.6169393";
$e['grifos'][0]['obs'] = "";

$e['grifos'][1]['lat'] = "-33.4397973";
$e['grifos'][1]['lng'] = "-70.6169393";
$e['grifos'][1]['obs'] = "Malo";

$e['grifos'][2]['lat'] = "-33.4397973";
$e['grifos'][2]['lng'] = "-70.6169393";
$e['grifos'][2]['obs'] = "";

// CHATS // 

$e['chat'][0]['user_id'] = 1085;
$e['chat'][0]['user_nombre'] = "Diego Gomez B";
$e['chat'][0]['data'] = "Hola a Todos";

$e['chat'][1]['user_id'] = 2896;
$e['chat'][1]['user_nombre'] = "Juan Perez";
$e['chat'][1]['data'] = "Como va";

// FOTOS //

$e['fotos'][0]['img'] = "hw34g3hf34_imb.jpg";
$e['fotos'][0]['user_id'] = 1085;
$e['fotos'][0]['user_nombre'] = "Diego Gomez B";
$e['fotos'][0]['lat'] = "-33.4397973";
$e['fotos'][0]['lng'] = "-70.6169393";

$e['fotos'][1]['img'] = "hw75g343fd4_imb.jpg";
$e['fotos'][1]['user_id'] = 1085;
$e['fotos'][1]['user_nombre'] = "Diego Gomez B";
$e['fotos'][1]['lat'] = "-33.4397973";
$e['fotos'][1]['lng'] = "-70.6169393";

echo json_encode($e);

?>