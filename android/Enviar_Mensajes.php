<?php
    require 'Mensajes.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/Mazatlan');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $id_emisor = $datos["id_emisor"];
        $id_receptor = $datos["id_receptor"];
        $nombe_emisor=$datos["nombre_emisor"];
        $cuerpo = $datos["cuerpo"];
        
        
        $token_tabla = Mensajes::getTokenUser($id_receptor);
        
        if($token_tabla){
            $token = $token_tabla["token"];
            
            $fechaActual = getdate();
            $segundos  = $fechaActual['seconds'];
            $minutos  = $fechaActual['minutes'];
            $hora = $fechaActual['hours'];
            $dia  = $fechaActual['mday'];
            $mes  = $fechaActual['mon'];
            $year  = $fechaActual['year'];
            
            $miliseconds = DateTime::createFromFormat('U.u',microtime(true));
            $emisor = "lora";
            $id_user_emisor = $emisor . "_" . $hora . $minutos. $segundos . $miliseconds->format("u");
            $fecha_del_mensaje = date("Y-m-d");
            $hora_del_mensaje = date("H:i:s");
            $envioFH = $fecha_del_mensaje. "," . $hora_del_mensaje;

            $MEE = false;
            #echo $id_user_emisor;

            $respuestaEnviarMensaje = Mensajes::EnviarMensaje(0,$id_emisor,$id_receptor."1",$cuerpo,$fecha_del_mensaje,$hora_del_mensaje);
            if($respuestaEnviarMensaje == 200){
                $MEE = true;
                
            }else echo json_encode(array('resultado' => 'No se Pudo Enviar'));
            if($MEE==true){
                echo json_encode(array('resultado' => 'El Mensaje Fue Enviado Correctamente'));
                Mensajes::EnviarNotificacion($cuerpo,$envioFH,$token,$nombe_emisor);
            }

            
        }else{
            echo json_encode(array('resultado' => 'No Existe ese Usuario'));
        }
    }
?>