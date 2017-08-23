<?php
session_start();
date_default_timezone_set('America/Santiago');
/*
$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/";
}
$path_ = $path."fa_backend/class";
include($path_."/fireapp.php");
$fireapp = new Fireapp();
$_SESSION['user']['permisos'] = $fireapp->permisos_usuario($_SESSION['user']['info']['id_user']);
*/
if(isset($_SESSION['user']['info']['id_user'])){
        
    $page = "layout";
    include("includes/header.php");
    ?>
    <body>
        <?php include("includes/head.php"); ?>
        <div class="contenido">
            <?php include("includes/nav.php"); ?>
            <div class="cont">
                <div class="contenedor">
                    <div class='load error'>
                        <div class='msgloading'>

                            <div class='textload'>Error porfavor vuelva a intentarlo mas tarde</div>
                        </div>
                    </div>
                    <div class='load loading'>
                        <div class='msgloading'>
                            <div class="cssload-jumping">
                                <span></span><span></span><span></span><span></span><span></span>
                            </div>
                            <div class='textload'>Cargando...</div>
                        </div>
                    </div>
                    <ul class="sock_cont"></ul>
                    <div class='conthtml'>
                        
                        <?php
                            
                            echo "<pre>";
                            print_r($_SESSION);
                            echo "</pre>";
                        
                            include("pages/muro.php");
                        
                        ?>
                            
                    </div>
                </div>
            </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq6hw0biMsUBdMBu5l-bai9d3sUI-f--g&libraries=places" async defer></script>
        </body>
    </html>
    
<?php } ?>