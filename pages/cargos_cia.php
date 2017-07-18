<?php
session_start();

require_once("../../class/fireapp.php");
$fireapp = new Fireapp();
$fireapp->seguridad(1);

/* CONFIG PAGE */
$list = $fireapp->get_cargos_cia();
$titulo = "Cargos";
$titulo_list = "Lista de Cargos de Compañia";
$sub_titulo1 = "Ingresar Cargos";
$sub_titulo2 = "Modificar Cargos";
$accion = "crearcargoscia";

$eliminaraccion = "eliminarcargoscia";
$id_list = "id_carg";
$eliminarobjeto = "Cargo";
$page_mod = "pages/cargos_cia.php";
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
                        <?php if($list[$i]['id_cia'] != 0){ ?>
                        <a title="Eliminar" class="borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                        <?php }else{ ?>
                        <a class="sinicono"></a>
                        <a class="sinicono"></a>
                        <?php } ?>
                        <a title="Perfiles" class="agregaradmin" onclick="navlink('pages/cargos_perfiles_cia.php?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>')"></a>
                        <a title="Usuario" class="carusuario" onclick="navlink('pages/cargos_usuarios_cia.php?id=<?php echo $id; ?>')"></a>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />