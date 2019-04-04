<?php
    require 'Favoritos.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/Mazatlan');
    $fecha_de_registro = date("Y-m-d");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $respuesta0 = Favoritos::ActualizarFavorito($datos["usuario"],$datos["id_viaje"]);
        if($respuesta0){
            echo json_encode(array('resultado' => 'Actualizado Con Exito'));
        }else{
            echo json_encode(array('resultado' => 'Actualizado Con Exito'));
        }
        
    }

?>