<?php
    require 'Viajes.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        
        $respuesta = Viajes::ActualizarFamiliares($datos["nombre"],$datos["apellido_p"],$datos["apellido_m"],$datos["edad"],$datos["telefono"],$datos["tipo_familiar"],$datos["id"]);
        if($respuesta){
            echo json_encode(array('resultado' => 'Actualizado Correctamente'));
        }else{
            echo json_encode(array('resultado' => 'Hubo un Error'));
        }
        
    }

?>