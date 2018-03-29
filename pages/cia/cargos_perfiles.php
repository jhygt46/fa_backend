<?php
session_start();

require_once("../../class/core.php");
$fireapp = new Core();
$fireapp->seguridad_exit(array(41));

/* CONFIG PAGE */
$list = $fireapp->get_perfiles_cia();
$titulo = "Perfiles del ".$_GET["nombre"];
$sub_titulo1 = "Modificar Perfiles";
$sub_titulo2 = "Modificar Perfiles";
$accion = "asignartareascargocia";

/* CONFIG PAGE */


$id = 0;
$sub_titulo = $sub_titulo1;
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $sub_titulo = $sub_titulo2;
    $that = $fireapp->get_perfiles_cargo_cia($_GET["id"]);
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
                    <div class="newform">
                        <div class="grupo">Grupo</div>
                        <?php for($i=0; $i<count($list); $i++){ $select = false; for($j=0; $j<count($that); $j++){ if($list[$i]['id_per'] == $that[$j]['id_per']){ $select = true; } } ?>
                        
                        <div class="groupdetail">
                            <label>
                                <input id="perfiles-<?php echo $list[$i]['id_per']; ?>" type="checkbox" value="1" <?php if($select){ echo"checked='checked'"; } ?> />
                                <span class="detail"> <?php echo $list[$i]['nombre']; ?></span>
                            </label>
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