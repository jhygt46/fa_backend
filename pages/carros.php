<?php
session_start();

require_once("../class/fireapp.php");
$fireapp = new Fireapp();
$fireapp->seguridad_permiso(9);

/* CONFIG PAGE */

$titulo = "Carros de ".$_GET["nombre"];
$titulo_list = "Lista de Carros";
$sub_titulo1 = "Ingresar Carro";
$accion = "crearcarrocia";

$eliminaraccion = "eliminarcarrocia";
$id_list = "id_car";
$eliminarobjeto = "Carro";
$page_mod = "pages/carros.php";
/* CONFIG PAGE */

if(isset($_GET["id"]) && is_numeric($_GET["id"])){
    
    $sub_titulo = $sub_titulo1;
    $list = $fireapp->get_carros_cia($_GET["id"]);
    $tdms = $fireapp->get_tipos_maquinas();
    $id_cia = $_GET["id"];
    if(isset($_GET["id_car"]) && is_numeric($_GET["id_car"]) && $_GET["id_car"] != 0){
        
        $id_car = $_GET["id_car"];
        $that = $fireapp->get_carro_cia($id_cia, $id_car);
        $tdm = $fireapp->get_tipos_carro($id_car);
        $sub_titulo = "Modificar Carro ".$that['nombre'];
        
    }
    
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
                    <input id="id" type="hidden" value="<?php echo $id_car; ?>" />
                    <input id="id_cia" type="hidden" value="<?php echo $id_cia; ?>" />
                    <input id="accion" type="hidden" value="<?php echo $accion; ?>" />
                    <label>
                        <span>Nombre:</span>
                        <input id="nombre" type="text" value="<?php echo $that['nombre']; ?>" require="" placeholder="Ej: Cuerpo de Bomberos de Santiago" />
                        <div class="mensaje"></div>
                    </label>
                    <?php for($i=0; $i < count($tdms); $i++){ $checked=""; for($j=0; $j<count($tdm); $j++){ if($tdms[$i]['id_tdc'] == $tdm[$j]['id_tdc']){ $checked="checked='checked'"; } } ?>
                    <label>
                        <span><?php echo $tdms[$i]['nombre']; ?>:</span>
                        <input id="tdc-<?php echo $tdms[$i]['id_tdc']; ?>" type="checkbox" <?php echo $checked; ?> value="1" require="" />
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
                        <a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id_car=<?php echo $id; ?>&id=<?php echo $id_cia; ?>&nombre=<?php echo $_GET["nombre"]; ?>')"></a>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />