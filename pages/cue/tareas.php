<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();

$fireapp->seguridad_exit(array(17));

/* CONFIG PAGE */
$list = $fireapp->get_tareas_cue('order');
$titulo = "Tareas del perfil ".$_GET['nombre'];

$sub_titulo2 = "Lista de Tareas";
$accion = "asignartareascue";

/* CONFIG PAGE */

$id = 0;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->tareas_perfil_cia($_GET["id"]);
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
        <div class="sucont" style="margin-top: 30px">

            <form action="" method="post" class="basic-grey">
                <fieldset>
                    <input id="id" type="hidden" value="<?php echo $id; ?>" />
                    <input id="accion" type="hidden" value="<?php echo $accion; ?>" />
                    <div class="newform">
                    <?php foreach($list as $value){ ?>
                    
                        <div class='grupo'><?php echo $value['grupo']; ?></div>
                        <div class="groupdetail">
                            <?php foreach($value['res'] as $value2){ $select = false; for($j=0; $j<count($that); $j++){ if($value2['id_tar'] == $that[$j]['id_tar']){ $select = true; } }?>
                            <label>
                                <input id="tareas-<?php echo $value2['id_tar']; ?>" type="checkbox" value="1" <?php if($select){ echo"checked='checked'"; } ?> />
                                <span class='detail'><?php echo $value2['id_tar']; ?> - <?php echo $value2['nombre']; ?></span>
                            </label>
                            <?php } ?>
                        </div>
                    
                    <?php } ?>
                    </div>
                    <label style='margin-top:20px; margin-left: 10%;'>
                        <a id='button' onclick="form()">Enviar</a>
                    </label>
                </fieldset>
            </form>
            
        </div>
    </div>
</div>