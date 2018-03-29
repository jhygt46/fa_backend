<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $path = $_SERVER['DOCUMENT_ROOT'];
    if($_SERVER['HTTP_HOST'] == "localhost"){
        $path .= "/";
        $path_class = $path."/fa_backend/class/";
        $path_n = $path."/fa_backend/";
    }else{
        $path_class = $path."admin/class/";
        $path_n = $path."admin/";
    }

    require_once($path_class."mysql_class.php");
    $con = new Conexion();
    
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $id_user = $request->id_user;
    $code = $request->code;

    $sql_user = $con->query("SELECT * FROM usuarios WHERE id_user='".$id_user."' AND code='".$code."'");
    if($sql_user['count'] == 1){
        
        $id_act = $request->id_act;
    
        $nombre = calcula_alias(30).'.jpg';
        $image = $request->image;
        $path2 = '../images/uploads/actos/'.$nombre;
        
        if(file_put_contents($path2, base64_decode($image))){
                
                $images = Array();
            
                $image['nombre'] = $nombre;
                $image['id_user'] = $id_user;
                $image['lat'] = $lat;
                $image['lng'] = $lng;
                $image['fecha'] = date("Y-m-d H:i:s");

                $sql_img = $con->query("SELECT * FROM actos WHERE id_act='".$id_act."'");
                if($sql_img['resultado'][0]['images'] != ""){
                    $images = json_decode($sql_img['resultado'][0]['images']);
                }
                $images[] = $image;
                $con->query("UPDATE actos SET images='".json_encode($images)."' WHERE id_act='".$id_act."'");

        }
        
    }
    function base64_to_jpeg($output_file, $base64_string ) {
            $ifp = fopen( $output_file, "wb" );
            fwrite( $ifp, base64_decode( $base64_string) );
            fclose( $ifp );
            return( $output_file );
    }

    function calcula_alias($cantidad = 5){
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for($cuenta = 0; $cuenta <= $cantidad; $cuenta++){
                $hash .= $caracteres[rand(0,strlen($caracteres) - 1)];
        }
        return $hash;
    }

