<?php
    require 'Viajes.php';
        
    if($_SERVER['REQUEST_METHOD']=='GET'){
        
        if(isset($_GET['id'])){
            $identificador = $_GET['id'];
            $Respuesta = Viajes::ObtenerViajeId($identificador);
            $contenedor = array();
            if($Respuesta){
                $contenedor["resultado"] = "CC";
                $contenedor["datos"] = $Respuesta;
                echo json_encode($contenedor);  
            }else{
                echo json_encode(array('resultado' => 'El Usuario No Existe'));
            }
        }else{
                echo json_encode(array('resultado' => 'El Usuario No se Coloco'));

        }
       
    }
?>