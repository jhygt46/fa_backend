<?php
session_start();

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

require_once($path_class."charts.php");
$chart = new Charts();
echo json_encode($chart->render());


?>
