<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();

$fireapp->seguridad_exit(array(11, 42, 43, 44));

/* CONFIG PAGE */
$list = $fireapp->get_usuarios_cia();

$titulo = "Usuarios";
$titulo_list = "Lista de Usuarios";
$sub_titulo1 = "Ingresar Usuario";
$sub_titulo2 = "Modificar Usuario";
$accion = "crearusuariocia";

$eliminaraccion = "eliminarusuariocia";
$id_list = "id_user";
$eliminarobjeto = "Usuario";
$page_mod = "pages/cia/usuarios.php";
$page_perfil = "pages/cia/usuario_perfiles.php";
$page_antiguedad = "pages/cia/antiguedad.php";
/* CONFIG PAGE */

$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_usuario_cia($_GET["id"]);
    $id = $_GET["id"];

}

$this['id_ins'] = 2;
if(isset($_SESSION['install_cue']) || isset($_SESSION['install_cia'])){
    include("../../includes/install.php");
}
?>
<div class="title">
    <h1><?php echo $titulo; ?></h1>
    <ul class="clearfix">
        <li class="back" onclick="backurl()"></li>
    </ul>
</div>
<hr>
<?php if($fireapp->seguridad_if(array(11, 42, 43))){ ?>
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
                        <input id="nombre" type="text" value="<?php echo $that['nombre']; ?>" require="distnada" />
                        <div class="mensaje"></div>
                    </label>
                    <label>
                        <span>Correo Electr&oacute;nico:</span>
                        <input id="correo" type="text" value="<?php echo $that['correo']; ?>" require="email" />
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
<?php } ?>

<?php if($fireapp->seguridad_if(array(11, 42, 43, 44))){ ?>
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
                ?>
                
                <li class="user">
                    <ul class="clearfix">
                        <li class="nombre" name="<?php echo $nombre; ?>"><?php echo $nombre; ?></li>
                        <?php if($fireapp->seguridad_if(array(43))){ ?><a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a><?php } ?>
                        <?php if($fireapp->seguridad_if(array(11))){ ?><a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a><?php } ?>
                        <?php if($fireapp->seguridad_if(array(42))){ ?><a title="Perfiles" class="icn agregaradmin" onclick="navlink('<?php echo $page_perfil; ?>?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>')"></a><?php } ?>
                        <?php if($fireapp->seguridad_if(array(44))){ ?><a title="Antiguedad" class="icn antiguedad" onclick="navlink('<?php echo $page_antiguedad; ?>?id=<?php echo $id; ?>')"></a><?php } ?>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />
<?php } ?>