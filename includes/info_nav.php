<?php
    
    /*
    $tareas = $fireapp->get_all_tareas();
    echo "<pre>";
    print_r($tareas);
    echo "</pre>";
    */

    $permisos[0]['id'] = 1;
    $permisos[0]['nombre'] = "Ingresar Compa&ntilde;ias";
    $permisos[0]['iscia'] = 1;
    $permisos[0]['grupo'] = "Admin";
    $permisos[0]['orden'] = 1;
    $permisos[0]['id_gtar'] = 1;
    
    $permisos[1]['id'] = 2;
    $permisos[1]['nombre'] = "Ingresar Cargos";
    $permisos[1]['iscia'] = 1;
    $permisos[1]['grupo'] = "Admin";
    $permisos[1]['orden'] = 1;
    $permisos[1]['id_gtar'] = 1;
    
    $permisos[2]['id'] = 3;
    $permisos[2]['nombre'] = "Ingresar Carros";
    $permisos[2]['iscia'] = 1;
    $permisos[2]['grupo'] = "Admin";
    $permisos[2]['orden'] = 1;
    $permisos[2]['id_gtar'] = 1;






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
    if(in_arr(8)){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/cue/usuarios.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cue/cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/cue/perfiles.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Grupos de Usuarios";
        $arrays["link"] = "pages/cue/grupo_vols.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Grupos de Cargos";
        $arrays["link"] = "pages/cue/grupo_cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Actos";
        $arrays["link"] = "pages/cue/actos.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Configuracion";
        $arrays["link"] = "pages/cue/config.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Tipos de Claves";
        $arrays["link"] = "pages/cue/tipos_de_claves.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Tipos de Maquinas";
        $arrays["link"] = "pages/cue/tipos_de_maquina.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Carros";
        $arrays["link"] = "pages/cue/carros.php?id=0&nombre=Comandancia";
        $array[] = $arrays;
    }
    if(in_arr(8)){
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