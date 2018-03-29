<?php

    date_default_timezone_set('America/Santiago');

    $titulo = "Llamados";
    $sub_titulo1 = "Estadisticas Personales";

?>
<style>
    .lista_llamados{
        display: block;
    }
    .lista_llamados .cont_lista_llamados{
        display: block;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle{
        width: calc(100% - 300px);
        float: left;
        min-width: 600px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle{
        background: #c0c0c0;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados{
        display: block;
        padding: 1px 10px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado{
        display: block;
        background: #ddd;
        margin-top: 10px;
        margin-bottom: 14px;
        box-shadow: 0 6px 2px -2px gray;
        position: relative;
        height: 150px;
        cursor: pointer;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info{
        position: absolute;
        width: 32%;
        height: 150px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info .lla_clave{
        position: absolute;
        top: 0px;
        left: 5px;
        font-size: 34px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info .lla_direccion{
        position: absolute;
        top: 34px;
        left: 10px;
        font-size: 1.6em;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info .lla_comuna{
        position: absolute;
        top: 50px;
        left: 10px;
        font-size: 1.5em;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info .lla_tiempo{
        position: absolute;
        top: 68px;
        left: 10px;
        font-size: 1.4em;
        font-weight: bold;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info .lla_carros{
        position: absolute;
        top: 90px;
        left: 10px;
        width: 97%;
        margin-right: 3%;
        overflow: hidden;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info_detalle{
        position: absolute;
        width: 33.33%;
        height: 150px;
        z-index: 9;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info_detalle .lla_t1{
        font-size: 14px;
        line-height: 12px;
        padding-top: 10px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info_detalle .lla_t2{
        font-size: 22px;
        line-height: 20px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info_detalle .lla_t3{
        font-size: 14px;
        line-height: 12px;
        padding-top: 10px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info_detalle .lla_t4{
        font-size: 18px;
        line-height: 16px;
        height: 30px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info_detalle .lla_t5{
        font-size: 14px;
        line-height: 12px;
        padding-top: 10px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_info_detalle .lla_t6{
        font-size: 26px;
        line-height: 24px;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_fotos{
        position: absolute;
        top: 5px;
        right: 5px;
        width: 32%;
        height: 136px;
        background: #e8e8e8;
        padding: 2px;
        z-index: 8;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_fotos .lla_foto{
        float: left;
        width: 33.33%;
        height: 136px;
        background: #eee;
    }
    .lista_llamados .cont_lista_llamados .llamado_detalle .cont_llamado_detalle .llamados .llamado .lla_carros li{
        float: left;
        width: 44px;
        height: 48px;
        background: #ccc;
        margin-right: 3px;
        font-size: 20px;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        padding: 2px 4px;
        border-radius: 5px;
    }
    .lista_llamados .cont_lista_llamados .llamado_lateral{
        width: 300px;
        float: left;
    }
</style>
<script>
    
    
    
</script>
<div class="title">
    <h1><?php echo $titulo; ?></h1>
    <ul class="clearfix">
        <li class="back" onclick="backurl()"></li>
    </ul>
</div>
<hr>
<div class="lista_llamados">
    <div class="cont_lista_llamados clearfix">
        <div class="llamado_detalle">
            <div class="cont_llamado_detalle">
                <div class="llamados">
                    <div class="llamado" onclick="navlink('pages/info/llamado.php?id_act=1')">
                        <div class="lla_info">
                            <div class="lla_clave">10-0-1</div>
                            <div class="lla_direccion">Jose Tomas Rider 1185 Depto A</div>
                            <div class="lla_comuna">Providencia</div>
                            <div class="lla_tiempo">Hace 3 horas 45 minutos</div>
                            <ul class="lla_carros clearfix"><li>B13</li><li>B14</li><li>Q15</li></ul>
                        </div>
                        <div class="lla_info_detalle halign">
                            <div class="lla_t1">A Cargo:</div>
                            <div class="lla_t2">Diego Gomez B. (13)</div>
                            <div class="lla_t3">Se Trataba de:</div>
                            <div class="lla_t4">Fuego violento en casa habitacion</div>
                            <div class="lla_t5">Cantidad de Voluntarios:</div>
                            <div class="lla_t6">18</div>
                        </div>
                        <div class="lla_fotos clearfix">
                            <div class="lla_foto"></div>
                            <div class="lla_foto"></div>
                            <div class="lla_foto"></div>
                        </div>
                    </div>
                    <div class="llamado" onclick="navlink('pages/info/llamado.php?id_act=2')">
                        <div class="lla_info">
                            <div class="lla_clave">10-0-1</div>
                            <div class="lla_direccion">Jose Tomas Rider 1185 Depto A</div>
                            <div class="lla_comuna">Providencia</div>
                            <ul class="lla_carros clearfix"><li>B13</li><li>B14</li><li>Q15</li></ul>
                        </div>
                        <div class="lla_info_detalle halign">
                            <div class="lla_t1">A Cargo:</div>
                            <div class="lla_t2">Diego Gomez B. (13)</div>
                            <div class="lla_t3">Se Trataba de:</div>
                            <div class="lla_t4">Fuego violento en casa habitacion</div>
                            <div class="lla_t5">Cantidad de Voluntarios:</div>
                            <div class="lla_t6">18</div>
                        </div>
                        <div class="lla_fotos clearfix">
                            <div class="lla_foto"></div>
                            <div class="lla_foto"></div>
                            <div class="lla_foto"></div>
                        </div>
                    </div>
                    <div class="llamado" onclick="navlink('pages/info/llamado.php?id_act=3')">
                        <div class="lla_info">
                            <div class="lla_clave">10-0-1</div>
                            <div class="lla_direccion">Jose Tomas Rider 1185 Depto A</div>
                            <div class="lla_comuna">Providencia</div>
                            <ul class="lla_carros clearfix"><li>B13</li><li>B14</li><li>Q15</li></ul>
                        </div>
                        <div class="lla_info_detalle halign">
                            <div class="lla_t1">A Cargo:</div>
                            <div class="lla_t2">Diego Gomez B. (13)</div>
                            <div class="lla_t3">Se Trataba de:</div>
                            <div class="lla_t4">Fuego violento en casa habitacion</div>
                            <div class="lla_t5">Cantidad de Voluntarios:</div>
                            <div class="lla_t6">18</div>
                        </div>
                        <div class="lla_fotos clearfix">
                            <div class="lla_foto"></div>
                            <div class="lla_foto"></div>
                            <div class="lla_foto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="llamado_lateral">B</div>
    </div>
</div>
</br>
</br>
</br>
</br>
</br>