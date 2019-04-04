<?php
    require 'Login.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $respuesta = Registro::ActualizarDatos($datos["usuario"],$datos["password"]);
        if($respuesta){
            echo "Se Actualizaron los Datos";
        }else{
            echo "No existe el Usuario";
        }
        
    }

?>