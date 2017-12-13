<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();
$fireapp->seguridad_permiso(2);

/* CONFIG PAGE */
$list = $fireapp->get_usuarios_cia();

$titulo = "Fechas de Ingresos y Retiros";
$titulo_list = "Listado Historico";
$sub_titulo2 = "Modificar Usuario";
$accion = "ingresoantiguedadvoluntario";

$eliminaraccion = "eliminarusuariocia";
$id_list = "id_user";
$eliminarobjeto = "Usuario";
$page_mod = "pages/cia/antiguedad.php";
/* CONFIG PAGE */

$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $list = $fireapp->get_antiguedad_usuario_cia($_GET["id"]);
    $id = $_GET["id"];
    
    echo "f_ini: ".strtotime($list[0]['fecha_ini'])."<br>";
    echo "f_fin: ".strtotime($list[0]['fecha_fin'])."<br>";
    echo "time: ".time()."<br>";
    
    if(strtotime($list[0]['fecha_ini']) < time() && strtotime($list[0]['fecha_fin']) > time()){
        
        $that['id_time'] = $list[0]['id_time'];
        $that['id_user'] = $list[0]['id_user'];
        $that['nombre'] = $list[0]['nombre'];
        $that['fecha_ini'] = $list[0]['fecha_ini'];
        
    }
    
    
    
    

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
                    <input id="id" type="hidden" value="<?php echo $id; ?>" />
                    <input id="accion" type="hidden" value="<?php echo $accion; ?>" />
                    <label>
                        <span>Nombre:</span>
                        <input id="nombre" type="text" value="<?php echo $that['nombre']; ?>" />
                        <div class="mensaje"></div>
                    </label>
                    <label>
                        <span>Fecha Ingreso:</span>
                        <input id="ingreso" type="text" class="datepicker_s" value="<?php echo $that['fecha_ini']; ?>" />
                        <div class="mensaje"></div>
                    </label>
                    <label>
                        <span>Fecha Retiro:</span>
                        <input id="ingreso" type="text" class="datepicker_s" value="<?php echo $that['fecha_fin']; ?>" />
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
        <div class="options"></div>
        <div class="name">Listado de Usuarios</div>
        <div class="message"></div>
        <div class="sucont">
            
            <ul class='listUser'>
                
                <?php 
                
                for($i=0; $i<count($list); $i++){
                    
                    $id = $list[$i][$id_list];
                    $nombre = $list[$i]['nombre'];
                    
                    $f_ini = date("Y-m-d", strtotime($list[$i]['fecha_ini']));
                    if($list[$i]['fecha_fin'] == "3000-01-01 00:00:00"){
                        $f_fin = "Actualidad";
                    }else{
                        $f_fin = date("Y-m-d", strtotime($list[$i]['fecha_fin']));
                    }

                ?>
                
                <li class="user">
                    <ul class="clearfix">
                        <li class="nombre"><?php echo $f_ini; ?> / <?php echo $f_fin; ?></li>
                        <a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>

<br />
<br />