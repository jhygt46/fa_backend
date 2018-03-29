<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();

$fireapp->seguridad_exit(array(12, 37, 38, 41));

/* CONFIG PAGE */
$list = $fireapp->get_cargos_cia();
$titulo = "Cargos";
$titulo_list = "Lista de Cargos";
$sub_titulo1 = "Ingresar Cargos";
$sub_titulo2 = "Modificar Cargos";
$accion = "crearcargoscia";

$eliminaraccion = "eliminarcargoscia";
$id_list = "id_carg";
$eliminarobjeto = "Cargo";
$page_mod = "pages/cia/cargos.php";

$page_perfil = "pages/cia/cargos_perfiles.php";
$page_usuarios = "pages/cia/cargos_usuarios.php";

/* CONFIG PAGE */

$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_cargo_cia($_GET["id"]);
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
<?php if($fireapp->seguridad_if(array(12))){ ?>
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
                        <span>Cantidad:</span>
                        <input id="cantidad" type="text" value="<?php echo $that['cantidad']; ?>" require="" placeholder="Ej: Cuerpo de Bomberos de Santiago" />
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

<?php if($fireapp->seguridad_if(array(12, 37, 38, 41))){ ?>
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
                        
                        <?php if($fireapp->seguridad_if(array(37))){ ?>
                            <?php if($list[$i]['id_cia'] != 0){ ?>
                            <a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                            <?php }else{ ?>
                            <a class="icn sinicono"></a>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php if($fireapp->seguridad_if(array(12))){ ?>    
                            <?php if($list[$i]['id_cia'] != 0){ ?>
                            <a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                            <?php }else{ ?>
                            <a class="icn sinicono"></a>
                            <?php } ?>
                        <?php } ?>
                        <?php if($fireapp->seguridad_if(array(41))){ ?><a title="Perfiles" class="icn agregaradmin" onclick="navlink('<?php echo $page_perfil; ?>?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>')"></a><?php } ?>
                        <?php if($fireapp->seguridad_if(array(38))){ ?><a title="Usuario" class="icn carusuario" onclick="navlink('<?php echo $page_usuarios; ?>?id=<?php echo $id; ?>')"></a><?php } ?>
                        
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