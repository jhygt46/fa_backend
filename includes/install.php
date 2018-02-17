<?php
session_start();

if(isset($_SESSION['install_cia'])){
    $pasos = $fireapp->install_cia();
    $txts = "DE LA COMPA&Ntilde;IA";
    if($this['id_ins'] == 0){ $video_intro = "cia/usuarios"; }
}
if(isset($_SESSION['install_cue'])){
    $pasos = $fireapp->install_cue();
    $txts = "DEL CUERPO";
    if($this['id_ins'] == 0){ $video_intro = "cia/usuarios"; }
}

if(is_array($pasos)){
    

    $video = "";
    $txt = "";

    for($i=0; $i<count($pasos); $i++){
        if($pasos[$i]['id_ins'] == $this['id_ins']){
            $video = $pasos[$i]['video'];
            $txt = $pasos[$i]['txt'];
        }
    }

    if(isset($video_intro)){
        $video = $video_intro;
    }
    
    ?>
    <script>

        play_video('<?php echo $video; ?>');

    </script>
    <div class="install">
        <h1>GUIA DE INSTALACION <?php echo $txts; ?></h1>
        <ul class="pasos clearfix">
            <?php for($i=0; $i<count($pasos); $i++){ $n = $i + 1; ?>
            <li class="paso <?php if($pasos[$i]['id_ins'] == $this['id_ins']){ ?>pmark<?php } ?>" rel="<?php echo $pasos[$i]['txt']; ?>" onclick="navlink('pages/<?php echo $pasos[$i]['page']; ?>')" onmouseover="over_paso(this)" onmouseout="out_paso(this)"><img src="images/<?php echo $pasos[$i]['image']; ?>" alt="" /> <?php if($pasos[$i]['estado'] == 0){ ?><div class="number mark"><?php echo $n; ?></div><?php }else{ ?><div class="check"></div><?php } ?></li>
            <?php } ?>
        </ul>
        <div class="show_paso" rel="<?php echo $txt; ?>"><?php echo $txt; ?></div>
    </div>

<?php } ?>

