<?php
session_start();

require_once("../../class/fireapp.php");

$fireapp = new Fireapp();

/* CONFIG PAGE */
$list = $fireapp->get_cargos_cue();
$titulo = "Cargos";
$titulo_list = "Lista de Cargos de Cuerpo";
$sub_titulo1 = "Ingresar Cargos";
$sub_titulo2 = "Modificar Cargos";
$accion = "crearcargoscue";

$eliminaraccion = "eliminarcargoscue";
$id_list = "id_carg";
$elimarobjeto = "Cargo";
$page_mod = "pages/cargos_cue.php";
/* CONFIG PAGE */


$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_cargo_cue($_GET["id"]);
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
                        <input id="nombre" type="text" value="<?php echo $that["nombre"]; ?>" require="" placeholder="Ej: Cuerpo de Bomberos de Santiago" />
                        <div class="mensaje"></div>
                    </label>
                    <label>
                        <span>Tipo:</span>
                        <select id="iscia">
                            <option value="0" <?php if($that["iscia"] == 0){ echo"selected"; } ?>>Comandancia</option>
                            <option value="1" <?php if($that["iscia"] == 1){ echo"selected"; } ?>>Compañia</option>
                        </select>
                        <div class="mensaje"></div>
                    </label>
                    <label>
                        <span>Tipo:</span>
                        <select id="ismando">
                            <option value="0" <?php if($that["ismando"] == 0){ echo"selected"; } ?>>Administrativo</option>
                            <option value="1" <?php if($that["ismando"] == 1){ echo"selected"; } ?>>Mando</option>
                        </select>
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
        <div class="options">
            <ul class="ops clearfix">
                <li class="op">
                    <ul class="ss clearfix">
                        <li><select class="inpsel"><option value='-1'>Todos</option><option value='0'>Comandancia</option><option value='1'>Compañia</option></select></li>
                        <li class="ic2" onclick="opcs(this, 'iscia')" title="Compañia"></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="name"><?php echo $titulo_list; ?></div>
        <div class="message"></div>
        <div class="sucont">
            
            <ul class='listUser'>
                
                <?php 
                for($i=0; $i<count($list); $i++){
                    $id = $list[$i][$id_list];
                    $nombre = $list[$i]['nombre'];
                    $iscia = $list[$i]['iscia'];
                ?>
                
                <li class="user">
                    <ul class="clearfix">
                        <li class="nombre" iscia="<?php echo $iscia; ?>"><?php echo $nombre; ?></li>
                        <a title="Eliminar" class="borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                        <?php if($iscia == 0){ ?>
                        <a title="Perfiles" class="agregaradmin" onclick="navlink('pages/cargos_perfiles_cue.php?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>')"></a>
                        <a title="Usuario" class="carusuario" onclick="navlink('pages/cargos_usuarios_cue.php?id=<?php echo $id; ?>')"></a>
                        <?php }else{ ?>
                        <a class="sinicono"></a>
                        <a class="sinicono"></a>
                        <?php } ?>
                        
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />