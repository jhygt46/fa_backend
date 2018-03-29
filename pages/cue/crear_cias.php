<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();

$fireapp->seguridad_exit(array(28, 30, 1, 4));


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

$page_carros = "pages/cue/carros.php";
/* CONFIG PAGE */

$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_cia($_GET["id"]);
    $id = $_GET["id"];
    
}

if($fireapp->seguridad_if(array(30))){ ?>
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
<?php } ?>
<div class="title">
    <h1><?php echo $titulo; ?></h1>
    <ul class="clearfix">
        <li class="back" onclick="backurl()"></li>
    </ul>
</div>
<hr>
<?php if($fireapp->seguridad_if(array(1))){ ?>
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
<?php } ?>

<?php if($fireapp->seguridad_if(array(1, 28, 30, 4))){ ?>
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
                        <?php if($fireapp->seguridad_if(array(28))){ ?><a title="Eliminar" class="icn borrar" onclick="eliminar('<?php echo $eliminaraccion; ?>', <?php echo $id; ?>, '<?php echo $eliminarobjeto; ?>', '<?php echo $nombre; ?>')"></a><?php } ?>
                        <?php if($fireapp->seguridad_if(array(1))){ ?><a title="Modificar" class="icn modificar" onclick="navlink('<?php echo $page_mod; ?>?id=<?php echo $id; ?>')"></a><?php } ?>
                        <?php if($fireapp->seguridad_if(array(4))){ ?><a title="Carros" class="icn carros" onclick="navlink('<?php echo $page_carros; ?>?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>')"></a><?php } ?>
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