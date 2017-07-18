<?php
    
    
    
    $array[0]["nombre"] = "Perfiles";
    $array[0]["link"] = "pages/perfiles_cia.php";
    
    
    $array[1]["nombre"] = "Cargos";
    $array[1]["link"] = "pages/cargos_cia.php";
        
    $aux["ico"] = 5;
    $aux["categoria"] = "Compa&ntilde;ia";
    $aux["subcategoria"] = $array;
    $menu[] = $aux;
    unset($aux);
    unset($array);
    
    $array[0]["nombre"] = "Perfiles";
    $array[0]["link"] = "pages/perfiles_cue.php";
    
    
    $array[1]["nombre"] = "Cargos";
    $array[1]["link"] = "pages/cargos_cue.php";
        
    $aux["ico"] = 4;
    $aux["categoria"] = "Comandancia";
    $aux["subcategoria"] = $array;
    $menu[] = $aux;
    unset($aux);
    unset($array);

?>