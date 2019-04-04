<?php
    require 'Favoritos.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/Mazatlan');
    $fecha_de_registro = date("Y-m-d");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $respuesta1 = Favoritos::ObtenerStatus1($datos["usuario"],$datos["id_viaje"]);
        if($respuesta1)
        {
            echo json_encode(array('resultado' => 'Actualmente en Favoritos'));
        }else{
            $respuesta2 = Favoritos::ObtenerStatus0($datos["usuario"],$datos["id_viaje"]);
            if($respuesta2){
                $respuesta3 = Favoritos::ActualizarFavoritoPositivo($datos["usuario"],$datos["id_viaje"]);
                echo json_encode(array('resultado' => 'Añadido a Favoritos'));
            }else{
                $respuesta4 = Favoritos::InsertarNuevoFavorito($datos["id_viaje"],$datos["usuario"],$fecha_de_registro);
                echo json_encode(array('resultado' => 'Añadido a Favoritos'));
            }
        }
        
    }

?>