$(document).ready(function(){
    $('.conthtml').css('min-height', $(document).height());
    size(0);
    $('.ti').click(function(){
        var id = $(this).attr('id');
        if($('.nav').width() == 180){
            $(this).parents('.lt').find('.tooltip').hide();
            if($(this).parents('.lt').find('ul').is(':visible')){
                $(this).parents('.lt').find('ul').slideUp(500);
                var that = $(this);
                setTimeout(function(){ that.css('background', 'none'); }, 500);
            }else{
                $(this).parents('.lt').find('ul').slideDown(500);
                $(this).css('background', '#272727');
            }
        }
    });
    $('.lt').hover(function(){
        if(!$(this).find('ul').is(':visible')){
            var top = $(this).position().top;
            var left = $('.nav').width() - 20;
            var tooltip = $(this).find('.tooltip');
            tooltip.show();
            tooltip.css("top", top+"px");
            tooltip.css("left", left+"px");
        }
    }, function(){
        var tooltip = $(this).find('.tooltip');
        tooltip.hide();
    });
    $('.user-guide').hover(function(){
        $(this).find('.user-info').slideDown();
    }, function(){
        $(this).find('.user-info').slideUp();
    });
    
    $('.mas').click(function(){

        if($(this).find('h4').html() == "+"){
            $(this).find('h4').html("-");
            $(this).find(".masinfo").slideDown();
        }else{
            $(this).find('h4').html("+");
            $(this).find(".masinfo").slideUp();
        }
        
    });
    localStorage.setItem("history", null);
    
    $('.contnotificacionllamado').click(function(){
        var rel = $(this).attr('rel');
        console.log(rel);
    });
   
});
var video_name = "";
function mascoord(){
    
    var cant = parseInt($('#cantpts').val())+1;
    $('.listinput').append('<label><span>Latitud '+cant+':</span><input id="lat'+cant+'" type="text" value="" /></label><label><span>Longitud '+cant+':</span><input id="lng'+cant+'" type="text" value="" /></label>');
    $('#cantpts').val(cant);
    
}

$(window).resize(function() {
    size(1);
});

function size(m){
    var num = 920;
    var width = $( window ).width();
    if(m == 0){
        if(width < num){
            $('#navw').val(0);
            $('.nav').css("width", "40px");
            $('.cont').css("margin-left", "40px");
        }else{
            $('#navw').val(1);
            $('.nav').css("width", "180px");
            $('.cont').css("margin-left", "180px");
        }
    }
    if(width < num && $('#navw').val() == 1){
        $('#navw').val(0);
        $('.nav').css("width", "40px");
        $('.cont').css("margin-left", "40px");
        $('.navlist').find('.lt').each(function(){
            var ul = $(this).find('ul');
            if(ul.is(':visible')){
                ul.hide();
                ul.addClass('mm');
            }
        });
    }
    if(width > num && $('#navw').val() == 0){
        $('#navw').val(1);
        $('.nav').css("width", "180px");
        $('.cont').css("margin-left", "180px");
        $('.navlist').find('.mm').show();
        $('.navlist').find('.mm').removeClass('mm');
    }
}


function topscroll(){
    $('html, body').animate({ scrollTop: 0 }, 500);
}
function backurl(){
    
    var history = JSON.parse(window.localStorage.getItem("history"));
    var len = history.length;
    var i = 1;
    if(len > 1){
        history.pop();
        i++;
    }
    navlinks(history[len - i]);
    localStorage.setItem("history", JSON.stringify(history));
    
}
function addhistorylink(url){
    
    var history = JSON.parse(window.localStorage.getItem("history"));
    if(history == null){
        history = new Array();
    }
    history.push(url);
    localStorage.setItem("history", JSON.stringify(history));
    
}
function navlink(href){
    
    addhistorylink(href);
    topscroll();
    $.ajax({
        url: href,
        type: "POST",
        data: "",
        beforeSend: function(){
            $(".loading").show();
            $(".error").hide();
        },
        success: function(data, status){
            $(".conthtml").html(data);
            $(".loading").hide();
        },
        error: function(){
            $(".error").show();
            $(".loading").hide();
        },
        complete: function(){
            
            
        }
    });
    return false;
}
function navlinks(href){

    topscroll();
    $.ajax({
        url: href,
        type: "POST",
        data: "",
        beforeSend: function(){
            $(".loading").show();
            $(".error").hide();
        },
        success: function(data, status){
            $(".conthtml").html(data);
            $(".loading").hide();
        },
        error: function(){
            $(".error").show();
            $(".loading").hide();
        },
        complete: function(){
            
            
        }
    });
    return false;
}
function eliminar(accion, id, tipo, name){

    var msg = {
        title: "Eliminar "+tipo, 
        text: "Esta seguro que desea eliminar a "+name, 
        confirm: "Si, deseo eliminarlo",
        name: name,
        accion: accion,
        id: id,
    };

    confirm(msg);
        
}

function confirm(message){
    
    swal({   
        title: message['title'],   
        text: message['text'],   
        type: "error",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: message['confirm'],   
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function(isConfirm){

        if(isConfirm){
            
            var send = {accion: message['accion'], id: message['id'], nombre: message['name']};
            console.log(send);
            $.ajax({
                url: "ajax/index.php",
                type: "POST",
                data: send,
                success: function(data){
                    
                    console.log(data);
                    setTimeout(function(){  
                        swal({
                            title: data.titulo,
                            text: data.texto,
                            type: data.tipo,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        if(data.reload)
                            navlinks('pages/'+data.page);
                    }, 10);

                }, error: function(e){
                    console.log(e);
                }
            });
 
        }
        
    });
    
}
function openwn(url, w, h){
    var myWindow = window.open(url, "", "width="+w+",height="+h);
}
function opcs(that, name){
    var ss = $(that).parents('.ss');
    var op = $(that).parents('.op');
    if(op.hasClass('isview')){
        op.css({width: '30px'});
        op.removeClass('isview');
        ss.find('li').eq(0).hide();
    }else{
        var fc = $(that).parents('.fc');
        op.css({width: '150px'});
        op.addClass('isview');
        ss.find('li').eq(0).fadeIn();
        if(ss.find('.inptxt').length){
            ss.find('.inptxt').bind('keyup', function(e){
                search(ss.find('input').val().toLowerCase(), fc, name);
            });
        }
        if(ss.find('.inpsel').length){
            ss.find('.inpsel').bind("change", function(){
                search(ss.find('.inpsel option:checked').val(), fc, name);
            });
        }

    }
}
function search(inputval, fc, name){   
    fc.find('.listUser').find('.user').each(function(){
        var nombre = $(this).find('.nombre').attr(name).toLowerCase();
        if (nombre.indexOf(inputval) != -1 || inputval == -1){
            $(this).show();
        }else{
            $(this).hide();
        }
    });
}
function setadmin(id_sis){
    
    var send = {accion: "setadmin", id_sis: id_sis};
    $.ajax({
        url: "ajax/index.php",
        type: "POST",
        data: send,
        success: function(data){
            
            location.reload();
            
        }
    });
    return false;
    
}
function salir(){
    
    var send = {accion: "salir"};
    $.ajax({
        url: "ajax/index.php",
        type: "POST",
        data: send,
        success: function(data){
            
            location.reload();
            
        }
    });
    return false;
}
function close_video(that){
    var video_yt = $(that).parents('.video_install').find('.video_yt');
    
    if(video_yt.attr('visible') == 1){
        video_yt.slideUp();
        video_yt.attr('visible', 0);
        stop_video();
    }else{
        video_yt.slideDown();
        video_yt.attr('visible', 1);
        play_video(0);
    }
}
function stop_video(){
    $('#video_yt_if').attr("src", "");
}
function play_video(video){
    
    if(video == 0){
        video = video_name;
    }
    var src = "";
    var ttl = "";
    if(video == "cia/usuarios"){
        src = "//www.youtube.com/embed/mcixldqDIEQ?rel=0&controls=1&hd=1&showinfo=0&enablejsapi=1&autoplay=1";
        ttl = "Ingreasar Usuarios";
        video_name = video;
    }
    $('#video_yt_if').attr("src", src);
    $('.video_nombre').html(ttl);
    
}

function shownotificaciones(){
    $('.notificaciones').animate({ bottom: "10px" }, 500);
}
function hidenotificaciones(){
    $('.notificaciones').animate({ bottom: "-380px" }, 500);
}
function notificacion(id){
    $('.contnotificacionllamado').attr('rel', id);
    var map = initMap('mapa_noti', -33.439797, -70.616939, 16);
    shownotificaciones();
}
function initMap(variable, lat, lng, zoom = 8) {
    return new google.maps.Map(document.getElementById(variable), { center: { lat: lat, lng: lng }, zoom: zoom, disableDefaultUI: true } );
}
function over_paso(that){
    var rel = $(that).attr('rel');
    $(that).css({ background: '#888' });
    $(that).parents('.install').find('.show_paso').html(rel);
}
function out_paso(that){
    if(!$(that).hasClass('pmark')){
        $(that).css({ background: '#bbb' });
    }else{
        $(that).css({ background: '#666' });
    }
    $(that).parents('.install').find('.show_paso').html($(that).parents('.install').find('.show_paso').attr('rel'));
}
