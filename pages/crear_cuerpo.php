<?php
session_start();

require_once("../../class/fireapp.php");

$fireapp = new Fireapp();

/* CONFIG PAGE */
$list = $fireapp->get_cuerpos();
$gtareas = $fireapp->get_grupos_tareas();
$titulo = "Cuerpos de Bomberos";
$titulo_list = "Lista de Cuerpos de Bomberos";
$sub_titulo1 = "Ingresar Cuerpo";
$sub_titulo2 = "Modificar Cuerpo";
$accion = "crearcuerpo";

$eliminaraccion = "eliminarcuerpo";
$id_list = "id_cue";
$elimarobjeto = "Cuerpo";
$page_mod = "pages/crear_cuerpo.php";
/* CONFIG PAGE */

$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $thats = $fireapp->get_cuerpo_complete($_GET["id"]);
    $that = $thats['cuerpo'];
    $gtareas_cue = $thats['gtareas'];
    $id = $_GET["id"];
    
}



?>

<div class="title">
    <h1><?php echo $titulo; ?></h1>
    <ul class="clearfix">
        <li class="back" onclick="backurl()"></li>
    </ul>
</div>
<hr>
<div class="info">
    <div class="fc" id="info-0">
        <div class="minimizar m1"></div>
        <div class="close"></div>
        <div class="name"><?php echo $sub_titulo; ?></div>
        <div class="message"></div>
        <div class="sucont">

            <form action="" method="post" class="basic-grey">
                <fieldset>
                    <input id="id" type="hidden" value="<?php echo $id; ?>" />
                    <input id="accion" type="hidden" value="<?php echo $accion; ?>" />
                    <label>
                        <span>Nombre:</span>
                        <input id="nombre" type="text" value="<?php echo $that['nombre']; ?>" require="" placeholder="Ej: Cuerpo de Bomberos de Santiago" />
                        <div class="mensaje"></div>
                    </label>
                    <label>
                        <span>Sigla:</span>
                        <input id="sigla" type="text" value="<?php echo $that['sigla']; ?>" require="" placeholder="Ej: CBS" />
                        <div class="mensaje"></div>
                    </label>
                    <?php for($i=0; $i<count($gtareas); $i++){ $checked=""; for($j=0; $j<count($gtareas_cue); $j++){ if($gtareas[$i]['id_gtar'] == $gtareas_cue[$j]['id_gtar']){ $checked="checked"; } } ?>
                    <label>
                        <span><?php echo $gtareas[$i]['nombre']; ?>:</span>
                        <input id="gtarea-<?php echo $gtareas[$i]['id_gtar']; ?>" type="checkbox" value="1" <?php echo $checked; ?> />
                    </label>
                    <?php } ?>
                    <label style='margin-top:20px'>
                        <span>&nbsp;</span>
                        <a id='button' onclick="form()">Enviar</a>
                    </label>
                </fieldset>
            </form>
            
        </div>
    </div>
</div>

<div class="info">
    <div class="fc" id="info-0">
        <div class="minimizar m1"></div>
        <div class="close"></div>
        <div class="name"><?php echo $titulo_list; ?></div>
        <div class="message"></div>
        <div class="sucont">
            
            <ul class='listUser'>
                
                <?php 
                for($i=0; $i<count($list); $i++){
                    $id = $list[$i][$id_list];
                    $nombre = $list[$i]['nombre'];
                ?>
                
                <li class="user">
                    <ul class="clearfix">
                        <li class="nombre"><?php echo $nombre; ?></li>
                        <a title="Eliminar" class="borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />