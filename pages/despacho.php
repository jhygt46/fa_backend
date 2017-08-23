<?php
session_start();

require_once("../class/fireapp.php");
$fireapp = new Fireapp();
//$fireapp->seguridad(1);
$claves = $fireapp->get_claves_llamados_cue();



$lat = -33.5412656;
$lng = -70.6165092;

if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] != 0){
    
    $that = $fireapp->get_llamado($_GET["id"]);
    $id = $_GET["id"];
    
    $lat = $that['lat'];
    $lng = $that['lng'];
    
    $id_clave = $that['id_cla'];
    foreach($claves as $k => $d){
        for($j=0; $j < count($d['claves']); $j++){
            if($id == $d['claves'][$j]['id_cla']){
                $clave_nombre = $k."-".$d['claves'][$j]['clave'];
            }
        }
    }
    
}
?>

<script>
    
    var map = "";
    var markers = Array();
    $(document).ready(function(){

        var id_cue = 1;
        var send = {accion: "getllamados", id_cue: id_cue};
        $.ajax({
            url: "ajax/services.php",
            type: "POST",
            data: send,
            success: function(res){
                render(res);
                
            },error: function(e){
                console.log(e);
            }
        });
        map = initMap('mapa', <?php echo $lat; ?>, <?php echo $lng; ?>);
        crear_llamado(map);
        
        $('.list_claves .clave .detalle_clave').click(function(){
        
            var clave_id = $(this).attr('id');
            var nombre = $(this).parents('.clave').find('h3').html()+"-"+$(this).html();
            $("#clave_id").val(clave_id);
            $('.claves').find('.in').hide();
            $('.claves').append('<div class="out"><h1>'+nombre+'</h1></div>');
            buscar_carros();

        });
        
    });
    
    function render(llamados){
        
        var select_llamado = '<li onclick="navlink(\'pages/despacho.php?id=0\')">Nuevo +</li>';
        for(var i=0; i<llamados.length; i++){
            
            select_llamado = select_llamado + '<li onclick="navlink(\'pages/despacho.php?id='+llamados[i].id+'\')">'+llamados[i].clave+'</li>';

        }
        //select_llamado = select_llamado + '<li onclick="navlink(\'pages/despacho.php?id=0\')">Nuevo +</li>';
        $('.select_llamado').html(select_llamado);
        
    }
    
    function crear_llamado(map){
        
        
        var searchBox = new google.maps.places.SearchBox(document.getElementById("input_gmap"));
        searchBox.addListener('places_changed', function(){
            
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            
            $("#address").val(places[0].formatted_address);
            $("#lat").val(places[0].geometry.location.lat());
            $("#lng").val(places[0].geometry.location.lng());
                        
            markers.forEach(function(marker){
                marker.setMap(null);
            });
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place){
                
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                }else{
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
            buscar_carros();
            
        });
        map.addListener('bounds_changed', function(){
            
            searchBox.setBounds(map.getBounds());
            
        });
        
    }
    
    function buscar_carros(){
        
        var clave_id = $('#clave_id').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        
        if(clave_id != "" && lat != "" && lng != ""){
            
            var id_cue = 1;
            var send = {accion: "getCarros", id_cue: id_cue, clave_id: clave_id, lat: lat, lng: lng};
            $.ajax({
                url: "ajax/services.php",
                type: "POST",
                data: send,
                success: function(res){

                   carros(res);

                },error: function(e){
                    
                    console.log(e);
                    
                }
            });
            
        }
        
    }
    
    function carros(param){
        
        console.log(param);
        
        for(var i=0; i<param.puntos.length; i++){
            
            var myLatLng = {lat:  parseFloat(param.puntos[i].lat), lng:  parseFloat(param.puntos[i].lng)};
            markers.push(new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: param.puntos[i].titulo
            }));
            
        }
        
        map.setZoom(4);
        
        for(var j=0; j<param.carros.length; j++){
            
            var punto = param.carros[j].punto;
            var nombre = param.carros[j].nombre;
            
            $('.ls1').append("<li class='carro_param'><div class='titulo'>"+nombre+"</div><div class='infos'> mts</div><div class='btns btn1' onclick='close_bomba(this)'></div></li>");
            
            
        }
        
    }
    function close_bomba(that){
        
        var carro_param = $(that).parents('.carro_param');
        var clon = carro_param.clone();
        carro_param.remove();
        clon.appendTo('.ls2');
        
    }
    function initMap(variable, lat, lng, zoom = 8) {
        return new google.maps.Map(document.getElementById(variable), { center: { lat: lat, lng: lng }, zoom: zoom } );
    }

</script>

<div class="llamados">
    <ul class="select_llamado clearfix">
        
    </ul>
    <div class="parent_contenido_llamado">
        <ul class="contenido_llamado" id="contenido_llamado">
            <li rel="0" class="clearfix">
                <input type="hidden" id="acto_id" value="<?php echo $that['id_act']; ?>">
                <div class="list l1">
                    <h1>Seleccionar Clave</h1>
                    <div class="content claves">
                        <input type="hidden" id="clave_id" value="<?php echo $that['id_clave']; ?>">
                        <?php if(!isset($that['id_act'])){ ?>               
                        <div class="in">
                            <div class="list_claves clearfix">
                                <?php foreach($claves as $key => $data){ ?>
                                <div class="clave">
                                    <h3><?php echo $key; ?></h3>
                                    <h2><?php echo $data['nombre']; ?></h2>
                                    <div class="detalle_claves clearfix">
                                    <?php
                                        for($i=0; $i<count($data['claves']); $i++){
                                            echo '<div class="detalle_clave" id="'.$data['claves'][$i]['id_cla'].'">'.$data['claves'][$i]['clave'].'</div>';
                                        }
                                    ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>    
                        </div>
                        <?php }else{ ?>
                        <div class="out"><h1><?php echo $clave_nombre; ?></h1></div>
                        <?php } ?>
                    </div>
                    <div class="mod mod1"></div>
                </div>
                <div class="list l2">
                    <h1>Ingresar Direccion</h1>
                    <div class="content direccion">
                        <input type="hidden" id="address" value="<?php echo $that['direccion']; ?>">
                        <input type="hidden" id="lat" value="<?php echo $that['lat']; ?>">
                        <input type="hidden" id="lng" value="<?php echo $that['lng']; ?>">
                        <div class="input_direccion"><input type="text" id="input_gmap" class="direccion_class" placeholder="Providencia 1185, Providencia" /></div>
                        <div class="mapa" id="mapa"></div>
                    </div>
                    <div class="mod mod1"></div>
                </div>
                <div class="list l3">
                    <h1>Carros</h1>
                    <div class="content carros">
                        <ul class="carros_in ls1 clearfix"></ul>
                        <ul class="carros_in ls2 clearfix"></ul>
                    </div>
                    <div class="mod mod1"></div>
                </div>
                <div class="list l4">
                    <h1>Otros Carros</h1>
                    <div class="content otroscarros">
                        <ul class="list_tdcs clearfix">
                            <li>B</li>
                            <li>Q</li>
                            <li>M</li>
                            <li>R</ul>
                        <ul class="list_otros clearfix">
                            
                        </ul>
                    </div>
                    <div class="mod mod1"></div>
                </div>
                <div class="list"><a class="guardar" href="" >GUARDAR</a></div>
            </li>
        </ul>
    <div>
</div>