<?php
session_start();

require_once("../class/fireapp.php");
$fireapp = new Fireapp();
$fireapp->seguridad_permiso(3);

/* CONFIG PAGE */
$list = $fireapp->get_actos_cia();
$claves_cia = $fireapp->get_claves_cia();


$titulo = "Actos de Compañia";
$titulo_list = "Proximos de Actos";
$sub_titulo1 = "Ingresar Acto";
$sub_titulo2 = "Modificar Acto";
$accion = "crearactocia";

$eliminaraccion = "eliminaractocia";
$id_list = "id_act";
$eliminarobjeto = "Acto";
$page_mod = "pages/actos_cia.php";
/* CONFIG PAGE */


$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_acto_cia($_GET["id"]);
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
                        <span>Clave:</span>
                        <select id="clave">
                            <option value="0">Seleccionar</option>
                            <?php for($i=0; $i<count($claves_cia); $i++){ ?>
                            <option value="<?php echo $claves_cia[$i]['id_cla']; ?>" <?php if($that['id_cla'] == $claves_cia[$i]['id_cla']){ echo "selected"; } ?>><?php echo $claves_cia[$i]['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label>
                        <span>Fecha:</span>
                        <input id="fecha" type="text" value="<?php echo $that['fecha_creado']; ?>" require="" placeholder="10-0-1" />
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
                        <a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                        <a title="Tareas" class="icn listareas" onclick="navlink('pages/tareas_cia.php?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>')"></a>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />