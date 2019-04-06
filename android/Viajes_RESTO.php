<?php
    require 'Viajes.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        
        //$respuesta = Viajes::SeleccionarResto($datos["id_viaje"],$datos["id_viajero"]);
        //echo json_encode(array('resultado' => $respuesta));
        
        try{
            $respuesta = Viajes::SeleccionarResto($datos["id_viaje"],$datos["id_viajero"]);            
            echo json_encode(array('resultado'=>$respuesta));  
        }catch(PDOException $e){
                echo json_encode(array('resultado' => 'Ocurrio un Error'));
            
        }
        
        
    }

?>