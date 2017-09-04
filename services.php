<?php

session_start();
header('Content-type: text/json');
header('Content-type: application/json');

echo "1";
require_once 'class/services_class.php';
echo "2";
$services = new Services();
echo "3";
$res = $services->process();
echo "4";
    
echo json_encode($res);
    
?>