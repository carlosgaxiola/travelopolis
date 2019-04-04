<?php
    require 'Viajes.php';
        
    if($_SERVER['REQUEST_METHOD']=='GET'){
        
        try{
            $Respuesta = Viajes::ObtenerTodosLosViajes();
            echo json_encode(array('resultado'=>$Respuesta));  
        }catch(PDOException $e){
                echo json_encode(array('resultado' => 'Ocurrio un Error'));
            
        }
        
        
    }
?>