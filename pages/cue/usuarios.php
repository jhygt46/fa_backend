<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();
$fireapp->seguridad_permiso(3);

/* CONFIG PAGE */
$list = $fireapp->get_usuarios_cue();
$cias = $fireapp->get_cias();

$titulo = "Usuarios de Cuerpo";
$titulo_list = "Lista de Usuarios";
$sub_titulo1 = "Ingresar Usuario";
$sub_titulo2 = "Modificar Usuario";
$accion = "crearusuariocue";

$eliminaraccion = "eliminarusuariocue";
$id_list = "id_user";
$eliminarobjeto = "Usuario";
$page_mod = "pages/cue/usuarios_cue.php";
$page_perfil = "pages/cue/usuario_perfiles.php";
/* CONFIG PAGE */

$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_usuario_cue($_GET["id"]);
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
                        <input id="nombre" type="text" value="<?php echo $that['nombre']; ?>" />
                        <div class="mensaje"></div>
                    </label>
                    <label>
                        <span>Correo Electr&oacute;nico:</span>
                        <input id="correo" type="text" value="<?php echo $that['correo']; ?>" />
                        <div class="mensaje"></div>
                    </label>
                    <label>
                        <span>Compa&ntilde;ia:</span>
                        <select id="id_cia">
                            <option value="0" <?php if($that["id_cia"] == 0){ echo"selected"; } ?>>Comandancia</option>
                            <?php for($i=0; $i<count($cias); $i++){ ?>
                            <option value="<?php echo $cias[$i]['id_cia']; ?>" <?php if($that["id_cia"] == $cias[$i]['id_cia']){ echo"selected"; } ?>><?php echo $cias[$i]['numero']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="mensaje"></div>
                    </label>
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
        <div class="options">
            <ul class="ops clearfix">
                <li class="op">
                    <ul class="ss clearfix">
                        <li><input class="inptxt" type="text"></li>
                        <li class="ic1" onclick="opcs(this, 'name')" title="Nombre"></li>
                    </ul>
                </li>
                <li class="op">
                    <ul class="ss clearfix">
                        <li><select class="inpsel"><option value='-1'>Todos</option><option value='0'>Comandancia</option><option value='1'>Trece</option></select></li>
                        <li class="ic2" onclick="opcs(this, 'id_cia')" title="Compañia"></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="name">Listado de Usuarios</div>
        <div class="message"></div>
        <div class="sucont">
            
            <ul class='listUser'>
                
                <?php 
                
                for($i=0; $i<count($list); $i++){
                    
                    $id = $list[$i][$id_list];
                    $nombre = $list[$i]['nombre'];
                    $id_cia = $list[$i]['id_cia'];
                ?>
                
                <li class="user">
                    <ul class="clearfix">
                        <li class="nombre" id_cia="<?php echo $id_cia; ?>" name="<?php echo $nombre; ?>"><?php echo $nombre; ?></li>
                        <a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                        <a title="Perfiles" class="icn agregaradmin" onclick="navlink('<?php echo $page_perfil; ?>?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>')"></a>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />