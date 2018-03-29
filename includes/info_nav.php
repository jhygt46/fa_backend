<?php

    if($fireapp->seguridad_if(array(50))){
        $arrays["nombre"] = "Inicio";
        $arrays["link"] = "pages/info/muro.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(51))){
        $arrays["nombre"] = "Perfil";
        $arrays["link"] = "pages/info/perfil.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(52))){
        $arrays["nombre"] = "Cuartel";
        $arrays["link"] = "pages/info/cuartel.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(53))){
        $arrays["nombre"] = "Informacion Medica";
        $arrays["link"] = "pages/info/info_medica.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(54))){
        $arrays["nombre"] = "Ver Llamados";
        $arrays["link"] = "pages/info/ver_llamados.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(55, 56, 57))){
        $arrays["nombre"] = "Estadisticas";
        $arrays["link"] = "pages/info/estadisticas.php";
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
    if($fireapp->seguridad_if(array(12, 37, 38, 41))){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cia/cargos.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(11, 42, 43, 44))){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/cia/usuarios.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(13, 39, 40))){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/cia/perfiles.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(14, 46))){
        $arrays["nombre"] = "Grupos de Usuarios";
        $arrays["link"] = "pages/cia/grupo_vols.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(15, 47))){
        $arrays["nombre"] = "Grupos de Cargos";
        $arrays["link"] = "pages/cia/grupo_cargos.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(16, 45))){
        $arrays["nombre"] = "Tipos de Claves";
        $arrays["link"] = "pages/cia/tipos_de_claves.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(48))){
        $arrays["nombre"] = "Actos";
        $arrays["link"] = "pages/cia/actos.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(49))){
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
    if($fireapp->seguridad_if(array(1, 28, 30, 4))){
        $arrays["nombre"] = "Compa&ntilde;ias";
        $arrays["link"] = "pages/cue/crear_cias.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(2, 21, 22, 26))){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cue/cargos.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(3, 23, 20))){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/cue/usuarios.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(4, 29))){
        $arrays["nombre"] = "Carros";
        $arrays["link"] = "pages/cue/carros.php?id=0&nombre=Comandancia";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(5, 17, 18))){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/cue/perfiles.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(6, 33))){
        $arrays["nombre"] = "Grupos de Usuarios";
        $arrays["link"] = "pages/cue/grupo_vols.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(7, 34))){
        $arrays["nombre"] = "Grupos de Cargos";
        $arrays["link"] = "pages/cue/grupo_cargos.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(9, 25))){
        $arrays["nombre"] = "Tipos de Maquinas";
        $arrays["link"] = "pages/cue/tipos_de_maquina.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(10, 27))){
        $arrays["nombre"] = "Tipos de Claves";
        $arrays["link"] = "pages/cue/tipos_de_claves.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(35))){
        $arrays["nombre"] = "Actos";
        $arrays["link"] = "pages/cue/actos.php";
        $array[] = $arrays;
    }
    if($fireapp->seguridad_if(array(8))){
        $arrays["nombre"] = "Configuracion";
        $arrays["link"] = "pages/cue/config.php";
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
    
    
    
    if($fireapp->seguridad_if(array(36))){
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
    if($fireapp->seguridad_admin()){
        $arrays["nombre"] = "Cuerpos";
        $arrays["link"] = "pages/admin/crear_cuerpo.php";
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
      
?>