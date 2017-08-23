<?php
session_start();

require_once("../class/fireapp.php");
$fireapp = new Fireapp();
//$fireapp->seguridad_permiso(5);

/* CONFIG PAGE */
$list = $fireapp->get_grupos_cue(0);
$users = $fireapp->get_usuarios_cue();
$titulo = "Grupos de Asistentes de Cuerpo";
$titulo_list = "Lista de Grupos";
$sub_titulo1 = "Ingresar Grupo";
$sub_titulo2 = "Modificar Grupo";
$accion = "creargrupovolcue";

$eliminaraccion = "eliminargrupovolcue";
$id_list = "id_gru";
$eliminarobjeto = "Grupo";
$page_mod = "pages/grupos_cue_vol.php";
/* CONFIG PAGE */


$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_grupo_cue_vol($_GET["id"]);
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
                        <input id="nombre" type="text" value="<?php echo $that['gru']['nombre']; ?>" require="" placeholder="Ej: Cuerpo de Bomberos de Santiago" />
                        <div class="mensaje"></div>
                    </label>
                    <div class="newform" style="margin-left: 167px; background: #ddd;">
                    <?php foreach($users as $value){ if(isset($that['user'])){ $check = ""; for($j=0; $j<count($that['user']); $j++){ if($value['id_user'] == $that['user'][$j]['id_user']){ $check = "checked='checked'"; } }} ?>
                        <div class="groupdetail">
                            <label>
                                <input id="users-<?php echo $value['id_user']; ?>" type="checkbox" value="1" <?php echo $check; ?> />
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