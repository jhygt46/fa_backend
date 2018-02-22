<?php

    // MI CUENTA 
    if(in_arr(1000)){
        $arrays["nombre"] = "Inicio";
        $arrays["link"] = "pages/muro.php";
        $array[] = $arrays;
    }
    if(in_arr(1000)){
        $arrays["nombre"] = "Perfil";
        $arrays["link"] = "pages/muro.php";
        $array[] = $arrays;
    }
    if(in_arr(1000)){
        $arrays["nombre"] = "Cuartel";
        $arrays["link"] = "pages/muro.php";
        $array[] = $arrays;
    }
    if(in_arr(1000)){
        $arrays["nombre"] = "Informacion Medica";
        $arrays["link"] = "pages/info_medica.php";
        $array[] = $arrays;
    }
    if(in_arr(1000)){
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
    if(in_arr(11)){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/cia/usuarios.php";
        $array[] = $arrays;
    }
    if(in_arr(12)){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cia/cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(13)){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/cia/perfiles.php";
        $array[] = $arrays;
    }
    if(in_arr(14)){
        $arrays["nombre"] = "Grupos de Usuarios";
        $arrays["link"] = "pages/cia/grupo_vols.php";
        $array[] = $arrays;
    }
    if(in_arr(15)){
        $arrays["nombre"] = "Grupos de Cargos";
        $arrays["link"] = "pages/cia/grupo_cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(16)){
        $arrays["nombre"] = "Tipos de Claves";
        $arrays["link"] = "pages/cia/tipos_de_claves.php";
        $array[] = $arrays;
    }
    if(in_arr(1000)){
        $arrays["nombre"] = "Actos";
        $arrays["link"] = "pages/cia/actos.php";
        $array[] = $arrays;
    }
    if(in_arr(1000)){
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
    
    if(in_arr(1)){
        $arrays["nombre"] = "Compa&ntilde;ias";
        $arrays["link"] = "pages/cue/crear_cias.php";
        $array[] = $arrays;
    }
    if(in_arr(2)){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cue/cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(3)){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/cue/usuarios.php";
        $array[] = $arrays;
    }
    if(in_arr(4)){
        $arrays["nombre"] = "Carros";
        $arrays["link"] = "pages/cue/carros.php?id=0&nombre=Comandancia";
        $array[] = $arrays;
    }
    if(in_arr(5)){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/cue/perfiles.php";
        $array[] = $arrays;
    }
    if(in_arr(6)){
        $arrays["nombre"] = "Grupos de Usuarios";
        $arrays["link"] = "pages/cue/grupo_vols.php";
        $array[] = $arrays;
    }
    if(in_arr(7)){
        $arrays["nombre"] = "Grupos de Cargos";
        $arrays["link"] = "pages/cue/grupo_cargos.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Configuracion";
        $arrays["link"] = "pages/cue/config.php";
        $array[] = $arrays;
    }
    if(in_arr(9)){
        $arrays["nombre"] = "Tipos de Maquinas";
        $arrays["link"] = "pages/cue/tipos_de_maquina.php";
        $array[] = $arrays;
    }
    if(in_arr(10)){
        $arrays["nombre"] = "Tipos de Claves";
        $arrays["link"] = "pages/cue/tipos_de_claves.php";
        $array[] = $arrays;
    }
    if(in_arr(1000)){
        $arrays["nombre"] = "Actos";
        $arrays["link"] = "pages/cue/actos.php";
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
    
    if(in_arr(1000)){
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
    
        // TAREAS CUERPO //
    
    $per['id'] = 1;
    $per['nombre'] = "Ingresar Compa&ntilde;ias";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 2;
    $per['nombre'] = "Ingresar Cargos";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 3;
    $per['nombre'] = "Ingresar Usuarios";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 4;
    $per['nombre'] = "Ingresar Carros";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 5;
    $per['nombre'] = "Ingresar Perfiles";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 6;
    $per['nombre'] = "Ingresar Grupos Usuarios";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 7;
    $per['nombre'] = "Ingresar Grupos Cargos";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 8;
    $per['nombre'] = "Ingresar Grupos Usuarios";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 9;
    $per['nombre'] = "Ingresar Tipos de Maquinas";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;

    $per['id'] = 10;
    $per['nombre'] = "Ingresar Tipos de Claves";
    $per['iscia'] = 0;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    

    // TAREAS COMPAÑIA //

    $per['id'] = 11;
    $per['nombre'] = "Ingresar Usuarios";
    $per['iscia'] = 1;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 12;
    $per['nombre'] = "Ingresar Cargos";
    $per['iscia'] = 1;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;

    $per['id'] = 13;
    $per['nombre'] = "Ingresar Perfiles";
    $per['iscia'] = 1;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 14;
    $per['nombre'] = "Ingresar Grupos Usuarios";
    $per['iscia'] = 1;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 15;
    $per['nombre'] = "Ingresar Grupos Cargos";
    $per['iscia'] = 1;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    $per['id'] = 16;
    $per['nombre'] = "Ingresar Tipos de Claves";
    $per['iscia'] = 1;
    $per['grupo'] = "Admin";
    $per['orden'] = 1;
    $per['id_gtar'] = 1;
    $permisos[] = $per;
    
    for($i=0; $i<count($permisos); $i++){
        $fireapp->con->sql("INSERT INTO tareas (id_tar, nombre, iscia, grupo, orden, id_gtar) VALUES ('".$permisos[$i]['id']."', '".$permisos[$i]['nombre']."', '".$permisos[$i]['iscia']."', '".$permisos[$i]['grupo']."', '".$permisos[$i]['orden']."', '".$permisos[$i]['id_gtar']."')");
    }
    
?>