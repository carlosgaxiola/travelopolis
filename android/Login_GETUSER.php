<?php
    require 'Login.php';
        
    if($_SERVER['REQUEST_METHOD']=='GET'){
        
        if(isset($_GET['usuario'])){
            $identificador = $_GET['usuario'];
            $Respuesta = Registro::ObtenerDatosPorUsuario($identificador);
            
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