<?php
session_start();
date_default_timezone_set('America/Santiago');

$path = $_SERVER['DOCUMENT_ROOT'];
if($_SERVER['HTTP_HOST'] == "localhost"){
    $path .= "/fa_backend";
}else{
    $path .= "admin";
}


include($path."/class/core.php");
$fireapp = new Core();
$_SESSION['user']['permisos'] = $fireapp->permisos_usuario($_SESSION['user']['info']['id_user']);

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
                    <div class="notificaciones">
                        <div class="notihide" onclick="hidenotificaciones()"></div>
                        <div class="notiinfo">
                            
                            <div class="contnotificacionllamado" rel="0">
                                <div class="titulo_noti"><span class="t1">10-0-1</span><span class="t2">Jose Tomas Rider 1185</span></div>
                                <div class="mapa_noti">
                                    <div id="mapa_noti"></div>
                                </div>
                                <div class="detalle_noti"><span class="t3">B13 - B14 - Q15</span></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class='conthtml'>
                        
                        <?php
                            
                            echo "<pre>";
                            print_r($_SESSION);
                            echo "</pre>";
                            
                            $include = true;
                            include("pages/muro.php");
                        
                        ?>
                            
                    </div>
                </div>
            </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq6hw0biMsUBdMBu5l-bai9d3sUI-f--g&libraries=places" async defer></script>
        </body>
    </html>
    
<?php } ?>