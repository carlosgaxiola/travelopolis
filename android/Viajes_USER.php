<?php
    require 'Viajes.php';
        
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id'])){
            $identificador = $_GET['id'];
            $Respuesta = Viajes::ObtenerInformacionPorUsuario($identificador);
            if($Respuesta){
                echo json_encode(array('resultado'=>$Respuesta));  
            }
            else{
                echo json_encode(array('resultado' => 'No Viajes'));
            } 
        }else{
                echo json_encode(array('resultado' => 'El Usuario No se Coloco'));

        }
    }
?>