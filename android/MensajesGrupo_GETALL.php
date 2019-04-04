<?php
    require 'MensajesGrupo.php';
        
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id_grupo'])){
            $identificador = $_GET['id_grupo'];
            $Respuesta = MensajesGrupo::ObtenerMensajesPorGrupo($identificador);
            echo json_encode($Respuesta);  
                
            
        }else{
                echo json_encode(array('resultado' => 'El Usuario No se Coloco'));

        }
    }
?>