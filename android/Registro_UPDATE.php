<?php
    require 'Registro.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/Mazatlan');
    $fecha_de_registro = date("Y-m-d");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $respuesta0 = RegistroUser::ActualizarViajero($datos["nombre"],$datos["apellido_p"],$datos["apellido_m"],$datos["sexo"],$datos["edad"],$datos["estado"],$datos["telefono"],$datos["correo"],$datos["informacion"],$datos["id"]);
        if($respuesta0){
            echo json_encode(array('resultado' => 'Actualizacion Exitosa'));
        }else{

            echo json_encode(array('resultado' => 'Registro Incorrecto'));
            
        }
        
    }

?>