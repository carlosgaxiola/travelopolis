<?php
    require 'MensajesGrupo.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/Mazatlan');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $destinatario = $datos["destinatario"];
        $numero = "22";
        //echo $destinatario;
            $link = mysqli_connect("travelopolis.ddns.net", "max", "joselora123");
            mysqli_select_db($link, "travelopolis");
            $tildes = $link->query("SET NAMES 'utf8'");
            $result = mysqli_query($link, "SELECT usuarios.token AS token FROM usuarios INNER JOIN viajeros ON usuarios.id = viajeros.id_usuario INNER JOIN detalle_viajes WHERE viajeros.id = detalle_viajes.id_viajero AND detalle_viajes.id_viajero != ".$numero." AND detalle_viajes.id_viaje = ".$destinatario);
            while ($fila = mysqli_fetch_array($result)){
                //mostrarDatos($fila);
                echo $fila["token"];
            }
            mysqli_free_result($result);
            mysqli_close($link);
            
    }
?>

