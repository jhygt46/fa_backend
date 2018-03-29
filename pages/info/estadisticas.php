<?php

    date_default_timezone_set('America/Santiago');

    $titulo = "Estad&iacute;sticas";
    $sub_titulo1 = "Estadisticas Personales";

?>
<script>
    
    play_youtube('tbEvyBAywck', 'Buena Nelson!');
    
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
        <div class="options">
            <ul class="ops clearfix">
                <li class="op">
                    <ul class="ss clearfix">
                        <li class="fechas clearfix"><div class="f1"><input id="f_ini" class="inptxt" type="text" value="<?php echo date("d-m-Y H:i:s"); ?>"></div><div class="f2"><input id="f_fin" class="inptxt" type="text" value="<?php echo date("d-m-Y H:i:s", strtotime('-1 month')); ?>"></div></li>
                        <li class="ic4" onclick="opc_fecha(this)" title="Fecha"></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="name"><?php echo $sub_titulo1; ?></div>
        <div class="sucont">
            <div class="cont_charts clearfix">
                <div class="list_chart">
                    <ul class="l_chart">
                        <li class="chitem">
                            <div class="c1">
                                <div class="show_chart" onclick="show_charts_ops(this, 'llamados')">Llamados</div>
                                <div class="opt_chart mas" onclick="toogle_chopt(this)"></div>
                            </div>
                            <div class="c2">
                                <div class="c2_title">Tipo de Grafico</div>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo1" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="1" checked="checked" /></div>
                                    <div class="chart_name">Torta</div>
                                </label>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo1" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="2" /></div>
                                    <div class="chart_name">Lineal</div>
                                </label>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo1" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="3"/></div>
                                    <div class="chart_name">Barras</div>
                                </label>
                                <div class="c2_title">Opciones</div>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="checkbox" name="tipo1a" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipoa"/></div>
                                    <div class="chart_name">Acumulado</div>
                                </label>
                            </div>
                        </li>
                        <li class="chitem">
                            <div class="c1">
                                <div class="show_chart" onclick="show_charts_ops(this, 'sample2')">Llamados</div>
                                <div class="opt_chart mas" onclick="toogle_chopt(this)"></div>
                            </div>
                            <div class="c2">
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo2" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="1" checked="checked" /></div>
                                    <div class="chart_name">Torta</div>
                                </label>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo2" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="2" /></div>
                                    <div class="chart_name">Lineal</div>
                                </label>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo2" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="3"/></div>
                                    <div class="chart_name">Barras</div>
                                </label>
                            </div>
                        </li>
                        <li class="chitem">
                            <div class="c1">
                                <div class="show_chart" onclick="show_charts_ops(this, 'sample3')">Llamados</div>
                                <div class="opt_chart mas" onclick="toogle_chopt(this)"></div>
                            </div>
                            <div class="c2">
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo3" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="1" checked="checked" /></div>
                                    <div class="chart_name">Torta</div>
                                </label>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo3" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="2" /></div>
                                    <div class="chart_name">Lineal</div>
                                </label>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo3" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="3"/></div>
                                    <div class="chart_name">Barras</div>
                                </label>
                            </div>
                        </li>
                        <li class="chitem">
                            <div class="c1">
                                <div class="show_chart" onclick="show_charts_ops(this, 'sample4')">Llamados</div>
                                <div class="opt_chart mas" onclick="toogle_chopt(this)"></div>
                            </div>
                            <div class="c2">
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo4" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="1" checked="checked" /></div>
                                    <div class="chart_name">Torta</div>
                                </label>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo4" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="2" /></div>
                                    <div class="chart_name">Lineal</div>
                                </label>
                                <label class="chart_opt clearfix">
                                    <div class="chart_op"><input type="radio" name="tipo4" onclick="show_charts_ops(this, 'llamados')" class="sample_op1" id="tipo" value="3"/></div>
                                    <div class="chart_name">Barras</div>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="chart" id="chart"></div>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>
<br/>
