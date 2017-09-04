<?php
session_start();
header('Content-type: text/json');
header('Content-type: application/json');


require_once 'class/services_class.php';
$services = new Services();
echo "1";
exit;
$res = $services->process();

    
echo json_encode($res);
    
?>