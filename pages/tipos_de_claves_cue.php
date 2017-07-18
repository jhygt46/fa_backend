<?php
session_start();

require_once("../../class/fireapp.php");
$fireapp = new Fireapp();
$fireapp->seguridad(1);
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/
/* CONFIG PAGE */
$list = $fireapp->get_claves_cue();
$tdcs = $fireapp->get_tipos_maquinas();
$grupos = $fireapp->get_grupos_cue();
$titulo = "Tipos de Claves";
$titulo_list = "Lista de Claves";
$sub_titulo1 = "Ingresar Clave";
$sub_titulo2 = "Modificar Clave";
$accion = "crearclavecue";

$eliminaraccion = "eliminarclavecue";
$id_list = "id_cla";
$eliminarobjeto = "Clave";
$page_mod = "pages/tipos_de_claves_cue.php";
/* CONFIG PAGE */


$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_clave_cue($_GET["id"]);
    $id = $_GET["id"];
    
}

?>
<script>
    
    $('#tipo').change(function (){
        var id = $('#tipo option:selected').val();
        if(id == 1 || id == 2){
            $('.tdcclass1').slideDown();
        }else{
            $('.tdcclass1').slideUp();
        }
    });
    $('#todos').click(function (){
        var grupos = $(this).parents('.tdcclass2').find('.grupos');
        console.log(grupos);
        if($(this).is(":checked")){
            grupos.slideUp();
        }else{
            grupos.slideDown();
        }
    });
    
</script>
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
                        <span>Tipo Clave:</span>
                        <select id="tipo">
                            <option value="1" <?php if($that['clave']['tipo'] == 1){ echo "selected"; } ?>>Llamado</option>
                            <option value="2" <?php if($that['clave']['tipo'] == 2){ echo "selected"; } ?>>Incendio</option>
                            <option value="3" <?php if($that['clave']['tipo'] == 3){ echo "selected"; } ?>>Citacion Previa</option>
                        </select>
                    </label>
                    <label>
                        <span>Origen:</span>
                        <select id="origen">
                            <option value="0" <?php if($that['clave']['iscia'] == 0){ echo "selected"; } ?>>Comandancia</option>
                            <option value="1" <?php if($that['clave']['iscia'] == 1){ echo "selected"; } ?>>Compañia</option>
                        </select>
                    </label>
                    <label>
                        <span>Nombre:</span>
                        <input id="nombre" type="text" value="<?php echo $that['clave']['nombre']; ?>" require="" placeholder="Llamado estructural en altura" />
                    </label>
                    <label>
                        <span>Clave:</span>
                        <input id="clave" type="text" value="<?php echo $that['clave']['clave']; ?>" require="" placeholder="10-0-1" />
                    </label>
                    <label>
                        <span>Grupo:</span>
                        <input id="grupo" type="text" value="<?php echo $that['clave']['grupo']; ?>" require="" placeholder="10-0" />
                    </label>
                    <label>
                        <span>Asistencia:</span>
                        <select id="asist">
                            <option value="1" <?php if($that['clave']['asist'] == 1){ echo "selected"; } ?>>Asistencia</option>
                            <option value="2" <?php if($that['clave']['asist'] == 2){ echo "selected"; } ?>>Abono</option>
                            <option value="0" <?php if($that['clave']['asist'] == 0){ echo "selected"; } ?>>Nada</option>
                        </select>
                    </label>
                    <label>
                        <span>Falta:</span>
                        <input id="falta" type="checkbox" value="1" <?php if($that['clave']['falta'] == 1){ echo "checked='checked'"; } ?> />
                    </label>
                    <div class="tdcclass2" style="padding: 10px 0px 15px 0px; display: block">
                        <div style="padding: 15px 0px 10px 10%; font-size: 16px; color: #666">Asistentes</div>
                        <label>
                            <span>Todos</span>
                            <input id="todos" type="checkbox" value="1" <?php echo ($that['clave']['todos'] == 1 || !isset($that['clave']['todos'])) ? 'checked="checked"' : ''; ?>/>
                        </label>
                        <div class="grupos" style="display: <?php echo (isset($that['grupos']))? 'block': 'none';?>">
                        <?php for($i=0; $i<count($grupos); $i++){ if(isset($that['grupos'])){ for($j=0; $j<count($that['grupos']); $j++){ $check = ""; if($grupos[$i]['id_gru'] == $that['grupos'][$j]['id_gru']){ $check = "checked='checked'"; } }}?>
                        <label>
                            <span><?php echo $grupos[$i]['nombre']; ?>:</span>
                            <input id="gru-<?php echo $grupos[$i]['id_gru']; ?>" type="checkbox" value="1" <?php echo $check; ?> />
                        </label>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="tdcclass1" style="padding: 10px 0px 15px 0px; display: block">
                        <div style="padding: 15px 0px 10px 10%; font-size: 16px; color: #666">Tipos de Maquinas</div>
                        <?php for($i=0; $i<count($tdcs); $i++){ $cant = 0; if(isset($that['tdcs'])){ for($j=0; $j<count($that['tdcs']); $j++){ if($tdcs[$i]['id_tdc'] == $that['tdcs'][$j]['id_tdc']){ $cant = $that['tdcs'][$j]['cantidad']; } }} ?>
                        <label>
                            <span><?php echo $tdcs[$i]['nombre']; ?>:</span>
                            <input id="tdc-<?php echo $tdcs[$i]['id_tdc']; ?>" type="text" value="<?php echo $cant; ?>" style="width: 150px" placeholder="2" />
                        </label>
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