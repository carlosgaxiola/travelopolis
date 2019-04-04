<?php
    require 'Registro.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/Mazatlan');
    $fecha_de_registro = date("Y-m-d");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $respuesta0 = RegistroUser::ObtenerUserPorUsuario($datos["usuario"]);
        if($respuesta0){
            echo json_encode(array('resultado' => 'Ya Existe ese Usuario, Escribe Otro'));
        }else{
            $respuesta = RegistroUser::InsertarNuevoDato($datos["usuario"],$datos["password"],"3",$fecha_de_registro,"1");
        
            $respuesta2 = RegistroUser::ObtenerIDPorUsuario($datos["usuario"]);

            $id_usuario = $respuesta2["id"];

            $respuesta3 = RegistroUser::InsertarNuevoDatoViajero($datos["nombre"],$datos["a_paterno"],$datos["a_materno"],$datos["sexo"],$datos["edad"],$datos["estado"],$datos["telefono"],$datos["correo"],$datos["informacion"],$id_usuario,$fecha_de_registro,"1");

            if($respuesta && $respuesta2 && $respuesta3 == true){
                echo json_encode(array('resultado' => 'Registro Correcto'));
            }else{
                echo json_encode(array('resultado' => 'Registro Incorrecto'));
            }
        }
        
    }

?>