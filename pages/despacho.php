<?php
session_start();

require_once("../../class/fireapp.php");

$fireapp = new Fireapp();
$llamados = $fireapp->llamados();

?>

<script>
    $(document).ready(function(){
        
        var id_cue = 1;
        var send = {accion: "getllamados", id_cue: id_cue};
        $.ajax({
            url: "../admin/ajax/info.php",
            type: "POST",
            data: send,
            success: function(res){
                
                renderllamado(res, 1);

            }
        });
        
        /*
        $('.claves .clave ul li').click(function(){

            var clave = $(this).attr('rel');
            var parent = $('.cla');
            parent.find('.optionclose').slideDown();
            parent.find('.optionopen').slideUp();
            parent.find('.close').hide();
            parent.find('.restore').show();
            parent.find('.infomostrar').html(clave);
            $('#claveid').val(clave);
            var num = parent.parent().attr('rel');
            $('.newllamado').find('li').eq(num).html(clave);
            
            //webSocket.emit('crearClave', {clave: clave});
            
        });
        */
        /*
        $('.close').click(function(){

            var parent = $(this).parent();
            parent.find('.optionclose').slideDown();
            parent.find('.optionopen').slideUp();
            parent.find('.close').hide();
            parent.find('.restore').show();

        });
        $('.restore').click(function(){

            var parent = $(this).parent();
            parent.find('.optionclose').slideUp();
            parent.find('.optionopen').slideDown();
            parent.find('.close').show();
            parent.find('.restore').hide();

        });
        */
        
    });
</script>
<div class='llamados'>
    <br/>
    <ul class='newllamado clearfix'>
        
    </ul>
    <div class='contllamados'>
        <div class='contllamado' rel='x'>
            <input type='hidden' class='claveid' value='' />
            <input type='hidden' class='clave' value='' />
            <div class='cla'>
                <div class='close'></div>
                <div class='restore'></div>
                <div class='optionclose infomostrar'>10-0-1</div>
                <ul class='optionopen claves clearfix'>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-0</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-0-1'>1</li>
                            <li onclick='addclave(this)' rel='10-0-2'>2</li>
                            <li onclick='addclave(this)' rel='10-0-3'>3</li>
                            <li onclick='addclave(this)' rel='10-0-4'>4</li>
                            <li onclick='addclave(this)' rel='10-0-5'>4</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-1</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-1-1'>1</li>
                            <li onclick='addclave(this)' rel='10-1-2'>2</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-2</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-2-1'>1</li>
                            <li onclick='addclave(this)' rel='10-2-2'>2</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-3</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-3-1'>1</li>
                            <li onclick='addclave(this)' rel='10-3-2'>2</li>
                            <li onclick='addclave(this)' rel='10-3-3'>3</li>
                            <li onclick='addclave(this)' rel='10-3-4'>4</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-4</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-4-1'>1</li>
                            <li onclick='addclave(this)' rel='10-4-2'>2</li>
                            <li onclick='addclave(this)' rel='10-4-3'>3</li>
                            <li onclick='addclave(this)' rel='10-4-4'>4</li>
                            <li onclick='addclave(this)' rel='10-4-5'>5</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-5</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-5-1'>1</li>
                            <li onclick='addclave(this)' rel='10-5-2'>2</li>
                            <li onclick='addclave(this)' rel='10-5-3'>3</li>
                            <li onclick='addclave(this)' rel='10-5-4'>4</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-6</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-6-1'>1</li>
                            <li onclick='addclave(this)' rel='10-6-2'>2</li>
                            <li onclick='addclave(this)' rel='10-6-3'>3</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-7</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-7-1'>1</li>
                            <li onclick='addclave(this)' rel='10-7-2'>2</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-8</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-8-1'>1</li>
                            <li onclick='addclave(this)' rel='10-8-2'>2</li>
                            <li onclick='addclave(this)' rel='10-8-3'>3</li>
                            <li onclick='addclave(this)' rel='10-8-4'>4</li>
                            <li onclick='addclave(this)' rel='10-8-5'>5</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-9</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-9-1'>1</li>
                            <li onclick='addclave(this)' rel='10-9-2'>2</li>
                            <li onclick='addclave(this)' rel='10-9-3'>3</li>
                            <li onclick='addclave(this)' rel='10-9-4'>4</li>
                            <li onclick='addclave(this)' rel='10-9-5'>5</li>
                            <li onclick='addclave(this)' rel='10-9-6'>6</li>
                            <li onclick='addclave(this)' rel='10-9-7'>7</li>
                        </ul>
                    </li>
                    <li class='clave'>
                        <h1>Llamados Estructurales</h1>
                        <h2>10-10</h2>
                        <ul class='clearfix'>
                            <li onclick='addclave(this)' rel='10-10-1'>1</li>
                            <li onclick='addclave(this)' rel='10-10-2'>2</li>
                            <li onclick='addclave(this)' rel='10-10-3'>3</li>
                            <li onclick='addclave(this)' rel='10-10-4'>4</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class='dir'>
                <div class='close'></div>
                <div class='restore'></div>
                <div class='optionclose infomostrar'>Jose Tomas Rider 1185, Providencia, Santiago</div>
                <div class='optionopen direccion'>
                    <ul class='busqueda clearfix'>
                        <li><span>Direccion:</span><input type='text' class='dirllamado' value='' /></li>
                        <li><span>Latitud:</span><input type='text' class='lat' value='' /></li>
                        <li><span>Longitud:</span><input type='text' class='lng' value='' /></li>
                    </ul>
                    <div class='mapallamado'></div>
                </div>
            </div>
            <div class='car'>
                <div class='close'></div>
                <div class='restore'></div>
                <div class='optionclose infomostrar'>B13 B14 Q15</div>
                <div class='optionopen carros'>
                    <ul class='list recomendaciones clearfix'>
                        <li class='carro'>
                            <h1>B13</h1>
                            <div class='carroclose'></div>
                            <h2>Diego Gomez B. <p>1328</p></h2>
                            <ul class='clearfix'>
                                <li>12:45</li>
                                <li>12:48</li>
                                <li>13:24</li>
                                <li>13:30</li>
                            </ul>
                            <div class='mas'><h4>+</h4><div class='masinfo'>Cantidad de Personas, kilometros de distancia, chofer, solicitar 66</div></div>
                        </li>
                        <li class='carro'>
                            <h1>B14</h1>
                            <div class='carroclose'></div>
                            <h2>Capitan <p>54</p></h2>
                            <ul class='clearfix'>
                                <li>12:45</li>
                                <li>12:48</li>
                                <li>13:24</li>
                                <li>13:30</li>
                            </ul>
                            <div class='mas'><h4>+</h4><div class='masinfo'></div></div>
                        </li>
                        <li class='carro'>
                            <h1>Q15</h1>
                            <div class='carroclose'></div>
                            <h2>Diego Gomez B. <p>1589a</p></h2>
                            <ul class='clearfix'>
                                <li>12:45</li>
                                <li>12:48</li>
                                <li>13:24</li>
                                <li>13:30</li>
                            </ul>
                            <div class='mas'><h4>+</h4><div class='masinfo'></div></div>
                        </li>
                    </ul>
                    <ul class='tipolist clearfix'>
                        <li><h1>B</h1><h2>Bomba</h2></li>
                        <li><h1>Q</h1><h2>PortaEscala</h2></li>
                        <li><h1>R</h1><h2>Rescate</h2></li>
                        <li><h1>M</h1><h2>Mecanica</h2></li>
                    </ul>
                    <ul class='list recomendaciones clearfix'>
                        <li class='carro'>
                            <h1>B3</h1>
                            <div class='carroclose'></div>
                            <h3><strong>5.9</strong> Kilometros</h3>
                            <h3><strong>6</strong> vols</h3>
                            <h3 class='s'>Diego Gomez B. (4años)</h3>
                        </li>
                        <li class='carro'>
                            <h1>B18</h1>
                            <div class='carroclose'></div>
                            <h3><strong>5.9</strong> Kilometros</h3>
                            <h3><strong>3</strong> vols</h3>
                            <h3 class='s'>Capitan</h3>
                        </li>
                    </ul>
                </div>
            </div>
            <div class='res'>
                <div class='close'></div>
                <div class='restore'></div>
                <div class='optionclose infomostrar'>Resumen</div>
                <div class='optionopen resumen'>
                    <ul class='data clearfix'>
                        <li class='infores'>
                            <h1>10-0-1</h1>
                        </li>
                        <li class='mapa'></li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
    
</div>