<?php
    require 'Token.php';
        
    if($_SERVER['REQUEST_METHOD']=='GET'){
        
        if(isset($_GET['usuario'])){
            $identificador = $_GET['usuario'];
            $Respuesta = Token::ObtenerDatosPorUsuario($identificador);
            
            #$contenedor = array();
            
            if($Respuesta){
                #$contenedor["resultado"] = "CC";
                #$contenedor["datos"] = $Respuesta;
                echo $Respuesta["token"];  
            }else{
                echo json_encode(array('resultado' => 'El Usuario No Existe'));
            }
        }else{
                echo json_encode(array('resultado' => 'El Usuario No se Coloco'));

        }
       
    }
?>