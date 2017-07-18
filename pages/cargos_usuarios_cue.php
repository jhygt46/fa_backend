<?php
session_start();

require_once("../../class/fireapp.php");
$fireapp = new Fireapp();
$fireapp->seguridad(1);

/* CONFIG PAGE */
$titulo = "Cargo de Usuarios";
$accion = "asignarcargousuarioscue";
$page_mod = "pages/cargos_usuarios_cue.php";
$id_list = "id_ucar";
/* CONFIG PAGE */


$id = 0;
$cant = 0;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $id_carg = $_GET["id"];
    $cargo = $fireapp->get_cargo_cue($id_carg);
    $list_user = $fireapp->get_usuarios_cue();
    $list_user_cargo = $fireapp->get_users_cargo_cue($id_carg);
    
    $cant = $cargo['cantidad'];
    
    $sub_titulo = "Cambios en ".$cargo['nombre'];
    $titulo_list = "Listado Historico de ".$cargo['nombre'];
    
    
    $actuales = $fireapp->actuales($list_user_cargo);
    
    $mod_hist = false;
    if(isset($_GET["id_ucar"]) && is_numeric($_GET["id_ucar"]) && $_GET["id_ucar"] != 0){
        
        $id_ucar = $_GET["id_ucar"];
        $mod_hist = true;
        $ucar = $fireapp->get_user_cargo_cue($id_ucar);
        $id_user = $ucar['id_user'];
        $m_f_ini = @strtotime($ucar['fecha_ini']);
        $m_f_fin = @strtotime($ucar['fecha_fin']);
        
    }
    
    $c_act = count($actuales);
    
    /*
    echo "<pre>";
    print_r($list_user_cargo);
    echo "</pre>";
    */
}



?>
<script type="text/javascript">
$(function(){
    var now = new Date();
    $(".datepicker").datetimepicker();
    $(".datepicker_s").datetimepicker({
        timeInput: true,
        timeFormat: "hh:mm",
	maxDate: new Date(now.getTime() - 86400000)
    });
    $(".rem_f_ini").on('change', function(){
        var val = this.value;
        $(this).parents('.parent_cargo').find('.actualidad').html(val);
    })
    $(".rem").click(function(){
        $(this).parent().find('div').eq(1).slideToggle(1000);
    });
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
                    <input id="id_cargo" type="hidden" value="<?php echo $id_carg; ?>" />
                    <input id="id_ucar" type="hidden" value="<?php echo $id_ucar; ?>" />
                    <input id="accion" type="hidden" value="<?php echo $accion; ?>" />
                    
                    <?php
                        if($mod_hist == false){
                        for($i=0; $i<count($actuales); $i++){
                    ?>
                    <div class="parent_cargo" style="background: #d2d2d2; padding: 10px 0px 20px 0px; margin: 0px 20% 0px 5%;">
                        
                        <div style="padding: 5px 0px 10px 40px; font-size: 20px; color: #666"><?php echo $actuales[$i]['nombre']; ?></div>
                        
                        <ul style="padding-bottom: 10px; font-size: 14px;" class="clearfix">
                            <li style="float: left; width: 15%; padding-right: 2%; text-align: right;">Fecha Inicio:</li>
                            <li style="float: left; width: 78%;"><?php echo $fireapp->datestring($actuales[$i]['f_ini'], false); ?></li>
                        </ul>
                        
                        <ul style="padding-bottom: 10px; font-size: 14px;" class="clearfix">
                            <li style="float: left; width: 15%; padding-right: 2%; text-align: right;">Fecha Fin:</li>
                            <li class="actualidad" style="float: left; width: 78%;"><?php echo $actuales[$i]['f_fin']; ?></li>
                        </ul>
                        
                        <div>
                            <div class="rem" style="display: block; padding-left: 40px; color: #700; font-weight: bold;">+ Reemplazar</div>
                            <div style="display: none">
                                <label>
                                    <span>Usuario:</span>
                                    <select id="actual-<?php echo $actuales[$i]['id_ucar']; ?>">
                                        <option value="0">Seleccionar</option>
                                        <?php for($m=0; $m<count($list_user); $m++){ ?>
                                        <option value="<?php echo $list_user[$m]['id_user']; ?>"><?php echo $list_user[$m]['nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </label>
                                <label>
                                    <span>Fecha inicio:</span>
                                    <input type="text" id="fini-<?php echo $actuales[$i]['id_ucar']; ?>" class="datepicker rem_f_ini" value="" />
                                </label>
                            </div>
                        </div>
                    </div>
                        <?php }} ?>
                    <div style="padding: 0px 0px 0px 0px; margin: 10px 20% 0px 5%;">
                        <div class="rem" style="padding: 5px; font-size: 13px; color: #666"><?php if($mod_hist){ echo 'Modificar '.$cargo['nombre']; }else{ if($c_act == 0){ echo '+ Agregar '.$cargo['nombre']; }else{ echo '+ Agregar '.$cargo['nombre'].' Historico'; } } ?></div>
                        <div style="display: <?php if($mod_hist){ echo 'block'; }else{ if($c_act == 0){ echo 'block'; }else{ echo 'none'; } } ?>">
                            <label>
                                <span>Usuario:</span>
                                <select id="h_id_user">
                                    <?php if(!$mod_hist){ ?><option value="0">Seleccionar</option><?php } ?>
                                    <?php for($i=0; $i<count($list_user); $i++){ if($id_user == $list_user[$i]['id_user'] || !$mod_hist){ ?>
                                    <option value="<?php echo $list_user[$i]['id_user']; ?>"><?php echo $list_user[$i]['nombre']; ?></option>
                                    <?php }} ?>
                                </select>
                            </label>
                            <label>
                                <span>Fecha inicio:</span>
                                <input type="text" id="h_f_ini" class="datepicker_s" value="<?php if(isset($m_f_ini)){ echo @date("m/d/Y H:i", $m_f_ini); } ?>" />
                            </label>
                            <label>
                                <span>Fecha fin:</span>
                                <input type="text" id="h_f_fin" class="datepicker_s" value="<?php if(isset($m_f_fin)){ echo @date("m/d/Y H:i", $m_f_fin); } ?>" />
                            </label>
                        </div>
                    </div>
                    <label style='margin-top:20px; margin-left: 5%;'>
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
                for($i=0; $i<count($list_user_cargo); $i++){
                    
                    $id = $list_user_cargo[$i][$id_list];
                    $nombre = $list_user_cargo[$i]['nombre'];
                    $add_mod = true;
                    $cant = 60 * 60 * 24 * 3;
                    if(@strtotime($list_user_cargo[$i]['fecha_creado']) + $cant < time()){
                        $add_mod = false;
                    }
                    
                    if(@strtotime($list_user_cargo[$i]['fecha_fin']) == ""){
                        $list_user_cargo[$i]['fecha_fin'] = @date("Y-m-d H:i:s");
                        $add_mod = false;
                    }
                    $date = $fireapp->diffdates($list_user_cargo[$i]['fecha_fin'], $list_user_cargo[$i]['fecha_ini']);

                ?>
                
                <li class="user">
                    <ul class="clearfix">
                        <li class="nombre"><?php echo $nombre; ?> (<?php echo $date; ?>)</li>
                        <?php if($add_mod){ ?>
                        <a title="Eliminar" class="borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id_carg; ?>&id_ucar=<?php echo $id; ?>')"></a>
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