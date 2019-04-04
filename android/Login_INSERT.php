<?php
    require 'Login.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $respuesta = Registro::InsertarNuevoDato($datos["usuario"],$datos["password"]);
        if($respuesta){
            echo "Se introdujeron los datos";
        }else{
            echo "No se pudo insertar los datos";
        }
        
    }

?>