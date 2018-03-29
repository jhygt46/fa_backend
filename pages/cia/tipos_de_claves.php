<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();

$fireapp->seguridad_exit(array(16, 45));

/* CONFIG PAGE */
$list = $fireapp->get_claves_cia();
$carros = $fireapp->get_carros_mi_cia();
$grupos = $fireapp->get_grupos_cia(2);
$titulo = "Tipos de Claves";
$titulo_list = "Lista de Claves";
$sub_titulo1 = "Ingresar Clave";
$sub_titulo2 = "Modificar Clave";
$accion = "crearclavecia";


$eliminaraccion = "eliminarclavecia";
$id_list = "id_cla";
$eliminarobjeto = "Clave";
$page_mod = "pages/cia/tipos_de_claves.php";
/* CONFIG PAGE */


$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_clave_cia($_GET["id"]);
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
        if($(this).is(":checked")){
            grupos.slideUp();
        }else{
            grupos.slideDown();
        }
    });
    $('#sincarros').click(function (){
        var grupos = $(this).parents('.tdcclass1').find('.grupos');
        if($(this).is(":checked")){
            grupos.slideUp();
            setTimeout(function(){ grupos.find('input').each(function(){ $(this).prop('checked', false); }); }, 1000);
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
<?php if($fireapp->seguridad_if(array(16))){ ?>
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
                        <input id="nombre" type="text" value="<?php echo $that['clave']['nombre']; ?>" require="" placeholder="Llamado estructural en altura" />
                    </label>
                    <label>
                        <span>Clave:</span>
                        <input id="clave" type="text" value="<?php echo $that['clave']['clave']; ?>" require="" placeholder="10-0-1" />
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
                            <input id="todos" type="checkbox" value="1" <?php echo ($that['todos'] == 1) ? 'checked="checked"' : ''; ?>/>
                        </label>
                        <div class="grupos" style="display: <?php echo ($that['todos'] == 0)? 'block': 'none';?>">
                        <?php for($i=0; $i<count($grupos); $i++){ if($that['id_gru'] == $grupos[$i]['id_gru']){ $check = "checked='checked'"; }else{ $check = ""; } ?>
                        <label>
                            <span><?php echo $grupos[$i]['nombre']; ?>:</span>
                            <input id="id_gru" name="grupo" type="radio" value="<?php echo $grupos[$i]['id_gru']; ?>" <?php echo $check; ?> />
                        </label>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="tdcclass1" style="padding: 10px 0px 15px 0px; display: block">
                        <div style="padding: 15px 0px 10px 10%; font-size: 16px; color: #666">Maquinas</div>
                        <label>
                            <span>Sin Maquinas</span>
                            <input id="sincarros" type="checkbox" value="1" <?php echo (!isset($that['carros'])) ? 'checked="checked"' : ''; ?> />
                        </label>
                        <div class="grupos" style="display: <?php echo (isset($that['carros']))? 'block': 'none';?>">
                        <?php for($i=0; $i<count($carros); $i++){ $checked = ""; if(isset($that['carros'])){ for($j=0; $j<count($that['carros']); $j++){ if($carros[$i]['id_car'] == $that['carros'][$j]['id_car']){ $checked = "checked='checked'"; } }} ?>
                        <label>
                            <span><?php echo $carros[$i]['nombre']; ?>:</span>
                            <input id="car-<?php echo $carros[$i]['id_car']; ?>" type="checkbox" value="1" <?php echo $checked; ?> />
                        </label>
                        <?php } ?>
                        </div>
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
<?php } ?>

<?php if($fireapp->seguridad_if(array(16, 45))){ ?>
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
                    $id_cia = $list[$i]['id_cia'];
                ?>
                
                <li class="user">
                    <ul class="clearfix">
                        <li class="nombre"><?php echo $nombre; ?></li>
                        <?php if($id_cia != 0){ ?>
                        <?php if($fireapp->seguridad_if(array(45))){ ?><a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a><?php } ?>
                        <?php if($fireapp->seguridad_if(array(16))){ ?><a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a><?php } ?>
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
<?php } ?>