<?php
if(!isset($include)){
    require_once("../class/core.php");
}
$fireapp = new Core();
$fireapp->seguridad_permiso(3);

$blogs = $fireapp->get_blog_data();
$conf_cia = $fireapp->get_config_cia();
$conf_cue = $fireapp->get_config_cue();

/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/

$this['id_ins'] = 0;
if(isset($_SESSION['install_cue']) || isset($_SESSION['install_cia'])){
    include("../includes/install.php");
}

?>

<div class="muro">
    <ul class="mu clearfix">
        <li class="muro_detalle">
            <div class="cont_detalle">
                <div class="blogs">
                    <div class="blog">
                        <div class="btnblog btnb1"></div>
                        <div class="btnblog btnb2"></div>
                        <div class="btnblog btnb3"></div>
                    </div>
                    <div class="blog">
                        <div class="btnblog btnb1"></div>
                        <div class="btnblog btnb2"></div>
                        <div class="btnblog btnb3"></div>
                    </div>
                    <div class="blog">
                        <div class="btnblog btnb1"></div>
                        <div class="btnblog btnb2"></div>
                        <div class="btnblog btnb3"></div>
                    </div>
                    <div class="blog">
                        <div class="btnblog btnb1"></div>
                        <div class="btnblog btnb2"></div>
                        <div class="btnblog btnb3"></div>
                    </div>
                    <div class="blog">
                        <div class="btnblog btnb1"></div>
                        <div class="btnblog btnb2"></div>
                        <div class="btnblog btnb3"></div>
                    </div>
                </div>
            </div>
        </li>
        <li class="muro_lateral">
            <div class="cont_lateral">
                <!--
                <ul class="laterals">
                    <li class="lateral"><h1>Proximos Cumpleaños</h1></li>
                    <li class="lateral"><h1>Voluntarios en Cuartel</h1></li>
                    <li class="lateral"><h1>Maquinas en Servicio</h1></li>
                </ul>
                -->
            </div>
            <div class="cont_lateral">
                
            </div>
        </li>
    </ul>
</div>