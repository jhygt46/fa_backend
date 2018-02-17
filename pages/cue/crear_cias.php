<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();
$fireapp->seguridad_permiso(3);

/* CONFIG PAGE */
$list = $fireapp->get_cias();
$titulo = "Compañias";
$titulo_list = "Lista de Compañias";
$sub_titulo1 = "Ingresar Compañia";
$sub_titulo2 = "Modificar Compañia";
$accion = "crearcia";

$eliminaraccion = "eliminarcia";
$id_list = "id_cia";
$elimarobjeto = "Compañia";
$page_mod = "pages/crear_cias.php";
/* CONFIG PAGE */

$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_cia($_GET["id"]);
    $id = $_GET["id"];
    
}



?>
<script>

    $('.listUser').sortable({
        stop: function(e, ui){
            var order = [];
            $(this).find('.user').each(function(){
                order.push($(this).attr('rel'));
            });
            
            var send = {accion: 'ordercia', values: order};

            $.ajax({
                url: "ajax/index.php",
                type: "POST",
                data: send,
                success: function(data){
                    
                }, error: function(e){
                    
                }
            });
            
        }
    });
    $('.listUser').disableSelection();

</script>
<div class="install">
    <h1>Guia de Instalacion</h1>
    <ul class="pasos clearfix">
        <li class="paso" rel="Paso 1: Ingresar Cargos" onclick="navlink('pages/cia/usuarios.php')" onmouseover="over_paso(this)" onmouseout="out_paso(this)"><img src="images/paso1.png" alt="" /><div class="number">1</div></li>
        <li class="paso pmark" rel="Paso 2: Ingresar Compa&ntilde;ias" onclick="navlink('pages/cue/crear_cias.php')" onmouseover="over_paso(this)" onmouseout="out_paso(this)"><img src="images/paso2.png" alt="" /><div class="number mark">2</div></li>
        <li class="paso" rel="Paso 3: Ingresar Usuarios" onclick="navlink('pages/cia/usuarios.php')" onmouseover="over_paso(this)" onmouseout="out_paso(this)"><img src="images/paso3.png" alt="" /><div class="number">3</div></li>
        <li class="paso" rel="Paso 4: Ingresar Perfiles" onclick="navlink('pages/cia/usuarios.php')" onmouseover="over_paso(this)" onmouseout="out_paso(this)"><img src="images/paso4.png" alt="" /><div class="number">4</div></li>
        <li class="paso" rel="Paso 5: Ingresar Carros" onclick="navlink('pages/cia/usuarios.php')" onmouseover="over_paso(this)" onmouseout="out_paso(this)"><img src="images/paso5.png" alt="" /><div class="number">5</div></li>
        <li class="paso" rel="Paso 6: Configuracion" onclick="navlink('pages/cia/usuarios.php')" onmouseover="over_paso(this)" onmouseout="out_paso(this)"><img src="images/paso6.png" alt="" /><div class="number">6</div></li>
    </ul>
    <div class="show_paso" rel="Paso 1: Ingresar Cargos">Paso 1: Ingresar Cargos</div>
</div>
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
                        <span>Numero:</span>
                        <input id="numero" type="text" value="<?php echo $that['numero']; ?>" require="" placeholder="Ej: CBS" />
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
                
                <li class="user" rel="<?php echo $id; ?>">
                    <ul class="clearfix">
                        <li class="nombre"><?php echo $nombre; ?></li>
                        <a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a>
                        <a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a>
                        <a title="Carros" class="icn carros" onclick="navlink('pages/carros.php?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>')"></a>
                    </ul>
                </li>
                
                <?php } ?>
                
            </ul>
            
        </div>
    </div>
</div>
<br />
<br />