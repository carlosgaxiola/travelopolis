<?php
    require 'Viajes.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/Mazatlan');
    $fecha_de_registro = date("Y-m-d");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $respuesta1 = Viajes::ObtenerViaje($datos["id_viaje"],$datos["usuario"]);
        if($respuesta1)
        {
            echo json_encode(array('resultado' => 'Ya tienes Una Compra en Proceso'));
        }else{
            $respuesta2 = Viajes::InsertarNuevoDetalleViaje($datos["id_viaje"],$datos["usuario"],$datos["cantidad"],$datos["resto"],$datos["resto"],$fecha_de_registro);
            echo json_encode(array('resultado' => 'Solicitado'));
            
            }
        }
    
?>