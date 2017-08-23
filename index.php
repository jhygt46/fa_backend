<?php
    session_start();
    
    if($_GET["accion"] == "logout"){
        session_destroy();
        echo '<meta http-equiv="refresh" content="0; url=index.php">';
        exit;
    }
    
    $to = "infolifeoperacional@gmail.com";
    $subject = "Recuperar Password Fireapp";
    $message = "<html><head><title>FireApp</title></head><body><a href='http://www.fireapp.cl/admin/password.php?id=".$id."&code=".$code."'>PRESIONAR ACA</a></body></html>";
    // To send HTML mail, the Content-type header must be set
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";

    if(mail($to, $subject, $message, implode("\r\n", $headers))){
        echo "SI: ".$to." <br/>";
    }else{
        echo "NO<br>";
    }
    
    phpinfo();
    exit;
    
    if(!isset($_SESSION['user']['info']['id_user'])){
        include("login.php");
    }else{
        include("inicio.php");
    }

?>
