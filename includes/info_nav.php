<?php
    
    // MI CUENTA 
    if(in_arr(1)){
        $arrays["nombre"] = "Inicio";
        $arrays["link"] = "pages/muro.php";
        $array[] = $arrays;
    }
    if(in_arr(1)){
        $arrays["nombre"] = "Perfil";
        $arrays["link"] = "pages/muro.php";
        $array[] = $arrays;
    }
    if(in_arr(1)){
        $arrays["nombre"] = "Cuartel";
        $arrays["link"] = "pages/muro.php";
        $array[] = $arrays;
    }
    if(in_arr(1)){
        $arrays["nombre"] = "Informacion Medica";
        $arrays["link"] = "pages/info_medica.php";
        $array[] = $arrays;
    }
    if(in_arr(1)){
        $arrays["nombre"] = "Ver Llamados";
        $arrays["link"] = "pages/ver_llamados.php";
        $array[] = $arrays;
    }
    if(isset($array)){
        $aux["ico"] = 3;
        $aux["show"] = true;
        $aux["categoria"] = "Mi Cuenta";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    
    
    
    
    // ADMIN CIA //
    if(in_arr(1)){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/cia/usuarios.php";
        $array[] = $arrays;
    }
    if(in_arr(3)){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cia/cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(5)){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/cia/perfiles.php";
        $array[] = $arrays;
    }
    if(in_arr(7)){
        $arrays["nombre"] = "Grupos de Usuarios";
        $arrays["link"] = "pages/cia/grupo_vols.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Grupos de Cargos";
        $arrays["link"] = "pages/cia/grupo_cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(9)){
        $arrays["nombre"] = "Tipos de Claves";
        $arrays["link"] = "pages/cia/tipos_de_claves.php";
        $array[] = $arrays;
    }
    if(in_arr(10)){
        $arrays["nombre"] = "Actos";
        $arrays["link"] = "pages/cia/actos.php";
        $array[] = $arrays;
    }
    if(in_arr(11)){
        $arrays["nombre"] = "Configuracion";
        $arrays["link"] = "pages/cia/config.php";
        $array[] = $arrays;
    }
    if(isset($array)){
        $aux["ico"] = 4;
        $aux["categoria"] = "Admin Compa&ntilde;ia";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    
    // ADMIN CUERPO //
    if(in_arr(12)){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/cue/usuarios.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cue/cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/cue/perfiles.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Grupos de Usuarios";
        $arrays["link"] = "pages/cue/grupo_vols.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Grupos de Cargos";
        $arrays["link"] = "pages/cue/grupo_cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Actos";
        $arrays["link"] = "pages/cue/actos.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Configuracion";
        $arrays["link"] = "pages/cue/config.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Tipos de Claves";
        $arrays["link"] = "pages/cue/tipos_de_claves.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Tipos de Maquinas";
        $arrays["link"] = "pages/cue/tipos_de_maquina.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Carros";
        $arrays["link"] = "pages/cue/carros.php?id=0&nombre=Comandancia";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Compa&ntilde;ias";
        $arrays["link"] = "pages/cue/crear_cias.php";
        $array[] = $arrays;
    }
    if(isset($array)){
        $aux["ico"] = 4;
        $aux["categoria"] = "Admin Cuerpo";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    
    if(in_arr(12)){
        $arrays["nombre"] = "Despacho";
        $arrays["link"] = "pages/cue/despacho.php";
        $array[] = $arrays;
    }
    if(isset($array)){
        $aux["ico"] = 2;
        $aux["categoria"] = "Despacho";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    
    // SUPER ADMIN //
    if(in2_arr()){
        
        $arrays["nombre"] = "Cuerpos";
        $arrays["link"] = "pages/crear_cuerpo.php";
        $array[] = $arrays;
        
    }
    
    if(isset($array)){
        $aux["ico"] = 1;
        $aux["categoria"] = "SuperAdministrador";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    

    
    
    
    
    
    
    
    function in_arr($id_tar){
        return in_array($id_tar, $_SESSION['user']['permisos']);
    }
    function in2_arr(){
        if($_SESSION['user']['info']['id_user'] == 1){
            return true;
        }
        return false;
    }
    
    
    
?>