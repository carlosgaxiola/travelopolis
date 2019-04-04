<?php
    require 'MensajesGrupo.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/Mazatlan');
    error_reporting(5);

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);

        $fecha_del_mensaje = date("Y-m-d");
        $hora_del_mensaje = date("H:i:s");
        $respuesta = MensajesGrupo::EnviarMensaje($datos["remitente"],$datos["nombreRemitente"],$datos["destinatario"],$datos["nivel"],$datos["mensaje"],$fecha_del_mensaje,$hora_del_mensaje);
        if($respuesta){
            $link = mysqli_connect("travelopolis.ddns.net", "max", "joselora123");
            mysqli_select_db($link, "travelopolis");
            $tildes = $link->query("SET NAMES 'utf8'");
            $result = mysqli_query($link, "SELECT usuarios.token AS token FROM usuarios INNER JOIN viajeros ON usuarios.id = viajeros.id_usuario INNER JOIN detalle_viajes WHERE viajeros.id = detalle_viajes.id_viajero AND detalle_viajes.id_viajero != ".$datos["remitente"]." AND detalle_viajes.id_viaje = ".$datos["destinatario"]);
            while ($fila = mysqli_fetch_array($result)){
                //mostrarDatos($fila);
                MensajesGrupo::EnviarNotificacion($datos["mensaje"],$hora_del_mensaje,$fila["token"],$datos["nombreRemitente"]);
            }
            mysqli_free_result($result);
            mysqli_close($link);
            echo json_encode(array('resultado' => 'Exito'));
            
        }else{
            echo json_encode(array('resultado' => 'No se Pudo Enviar'));
        } 

    }
?>

