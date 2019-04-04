<?php
    require 'Viajes.php';
        
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        try{
            $Respuesta = Viajes::ObtenerTodosLosFamiliares($datos["id_viaje"],$datos["id_viajero"]);
            echo json_encode(array('resultado'=>$Respuesta));  
        }catch(PDOException $e){
                echo json_encode(array('resultado' => 'Ocurrio un Error'));
            
        }
        
        
    }
?>