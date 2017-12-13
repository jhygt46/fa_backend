<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();
$fireapp->seguridad_permiso(8);

/* CONFIG PAGE */
$list = $fireapp->get_grupos_cia(1);
$cargos = $fireapp->get_cargos_cia();
$titulo = "Grupos de Asistentes de Compañia";
$titulo_list = "Lista de Grupos";
$sub_titulo1 = "Ingresar Grupo";
$sub_titulo2 = "Modificar Grupo";
$accion = "creargrupocia";

$eliminaraccion = "eliminargrupocia";
$id_list = "id_gru";
$eliminarobjeto = "Grupo";
$page_mod = "pages/cia/grupo_cargos.php";
/* CONFIG PAGE */


$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_grupo_cia($_GET["id"]);
    $id = $_GET["id"];
    /*
    echo "<pre>";
    print_r($that);
    echo "</pre>";
    */
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
                        <input id="nombre" type="text" value="<?php echo $that['gru']['nombre']; ?>" require="" placeholder="Ej: Cuerpo de Bomberos de Santiago" />
                        <div class="mensaje"></div>
                    </label>
                    <div class="newform" style="margin-left: 167px; background: #ddd;">
                    <?php foreach($cargos as $value){ if(isset($that['carg'])){ $check = ""; for($j=0; $j<count($that['carg']); $j++){ if($value['id_carg'] == $that['carg'][$j]['id_carg']){ $check = "checked='checked'"; } }} ?>
                        <div class="groupdetail">
                            <label>
                                <input id="carg-<?php echo $value['id_carg']; ?>" type="checkbox" value="1" <?php echo $check; ?> />
                                <span class='detail'><?php echo $value['nombre']; ?></span>
                            </label>
                        </div>
                    <?php } ?>
                    </div>
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
                        <a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />