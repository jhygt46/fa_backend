<?php
error_reporting(0);

require_once '../class/fireapp.php';
$fireapp = new Fireapp();

$blogs = $fireapp->get_blog_data();

/*
echo "<pre>";
print_r($blogs);
echo "</pre>";
*/

/* CONFIG PAGE */
$conf_cia = $fireapp->get_config_cia();
$conf_cue = $fireapp->get_config_cue();
/*
echo "<pre>";
print_r($conf_cia);
echo "</pre>";
echo "<pre>";
print_r($conf_cue);
echo "</pre>";
*/
?>

<div class="muro">
    <ul class="mu clearfix">
        <li class="muro_detalle">
            <div class="cont_detalle">
                <ul class="blogs">
                    <?php for($i=0; $i<count($blogs); $i++){ ?>
                    <li class="blog">
                        <h1><?php echo $blogs[$i]['nombre']; ?></h1>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </li>
        <li class="muro_lateral">
            <div class="cont_lateral">
                <ul class="laterals">
                    <li class="lateral"><h1>Proximos Cumpleaños</h1></li>
                    <li class="lateral"><h1>Voluntarios en Cuartel</h1></li>
                    <li class="lateral"><h1>Maquinas en Servicio</h1></li>
                </ul>
            </div>
        </li>
    </ul>
</div>