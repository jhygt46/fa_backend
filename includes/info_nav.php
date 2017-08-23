<?php
    
    /*
    if(in2_arr()){
        $arrays["nombre"] = "Cuerpos";
        $arrays["link"] = "pages/crear_cuerpo.php";
        $array[] = $arrays;
    }
    if(in2_arr()){
        $arrays["nombre"] = "Despacho";
        $arrays["link"] = "pages/despacho.php";
        $array[] = $arrays;
    }
    if(in2_arr()){
        $arrays["nombre"] = "Actos Cia";
        $arrays["link"] = "pages/actos_cia.php";
        $array[] = $arrays;
    }
    if(in2_arr()){
        $arrays["nombre"] = "Actos Cue";
        $arrays["link"] = "pages/actos_cue.php";
        $array[] = $arrays;
    }
    if(isset($array)){
        $aux["ico"] = 4;
        $aux["categoria"] = "SuperAdministrador";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    */
    if(in_arr(3)){
        $arrays["nombre"] = "Inicio";
        $arrays["link"] = "pages/muro.php";
        $array[] = $arrays;
    }
    if(in_arr(3)){
        $arrays["nombre"] = "Mi Perfil";
        $arrays["link"] = "pages/mi_perfil.php";
        $array[] = $arrays;
    }
    if(in_arr(3)){
        $arrays["nombre"] = "Mi Informacion";
        $arrays["link"] = "pages/mi_informacion.php";
        $array[] = $arrays;
    }
    
    if(isset($array)){
        $aux["ico"] = 4;
        $aux["categoria"] = "Voluntarios";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }

    if(in_arr(1)){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/usuarios_cia.php";
        $array[] = $arrays;
    }
    
    if(in_arr(10)){
        $arrays["nombre"] = "Configuracion";
        $arrays["link"] = "pages/config_cia.php";
        $array[] = $arrays;
    }
    if(in_arr(10)){
        $arrays["nombre"] = "Grupos Cargos";
        $arrays["link"] = "pages/grupos_cia.php";
        $array[] = $arrays;
    }
    if(in_arr(10)){
        $arrays["nombre"] = "Grupos Usuarios";
        $arrays["link"] = "pages/grupos_cia_vol.php";
        $array[] = $arrays;
    }
    
    if(isset($array)){
        $aux["ico"] = 1;
        $aux["categoria"] = "Administrador Cia";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    
    if(in_arr(3)){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/perfiles_cia.php";
        $array[] = $arrays;
    }
    if(isset($array)){
        $aux["ico"] = 2;
        $aux["categoria"] = "Permisos";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }

    if(in_arr(10)){
        $arrays["nombre"] = "Claves Cia";
        $arrays["link"] = "pages/tipos_de_claves_cia.php";
        $array[] = $arrays;
    }
    if(in_arr(2)){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cargos_cia.php";
        $array[] = $arrays;
    }
    if(isset($array)){
        $aux["ico"] = 3;
        $aux["categoria"] = "Configuracion Base";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
    
    if(in_arr(4)){
        $arrays["nombre"] = "Usuarios";
        $arrays["link"] = "pages/usuarios_cue.php";
        $array[] = $arrays;
    }
    if(in_arr(6)){
        $arrays["nombre"] = "Perfiles";
        $arrays["link"] = "pages/perfiles_cue.php";
        $array[] = $arrays;
    }
    if(in_arr(5)){
        $arrays["nombre"] = "Cargos";
        $arrays["link"] = "pages/cargos_cue.php";
        $array[] = $arrays;
    }
    if(in_arr(7)){
        $arrays["nombre"] = "Compa&ntilde;ia";
        $arrays["link"] = "pages/crear_cias.php";
        $array[] = $arrays;
    }
    if(in_arr(8)){
        $arrays["nombre"] = "Tipos de Maquinas";
        $arrays["link"] = "pages/tipos_de_maquina.php";
        $array[] = $arrays;
    }
    if(in_arr(9)){
        $arrays["nombre"] = "Carros";
        $arrays["link"] = "pages/carros.php?id=0&nombre=Comandancia";
        $array[] = $arrays;
    }
    if(in_arr(11)){
        $arrays["nombre"] = "Configuracion";
        $arrays["link"] = "pages/config_cue.php";
        $array[] = $arrays;
    }
    if(in_arr(10)){
        $arrays["nombre"] = "Grupos Cargos";
        $arrays["link"] = "pages/grupos_cue.php";
        $array[] = $arrays;
    }
    if(in_arr(10)){
        $arrays["nombre"] = "Grupos Usuarios";
        $arrays["link"] = "pages/grupos_cue_vol.php";
        $array[] = $arrays;
    }
    if(in_arr(10)){
        $arrays["nombre"] = "Claves Cue";
        $arrays["link"] = "pages/tipos_de_claves_cue.php";
        $array[] = $arrays;
    }
    if(isset($array)){
        $aux["ico"] = 2;
        $aux["categoria"] = "Administrador Cuerpo";
        $aux["subcategoria"] = $array;
        $menu[] = $aux;
        unset($aux);
        unset($array);
    }
    
    */
    
    
    
    
    
    
    
    function in_arr($id_tar){
        if(in_array($id_tar, $_SESSION['user']['permisos'])){
            return true;
        }
        return false;
    }
    function in2_arr(){
        if($_SESSION['user']['info']['id_user'] == 1){
            return true;
        }
        return false;
    }
    
    
    
?>