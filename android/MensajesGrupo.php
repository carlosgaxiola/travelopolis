<?php
    require 'Database.php';

    class MensajesGrupo{
        function _construct(){
            
        }
        public static function EnviarMensaje($id_remitente,$nombre_remitente,$id_grupo_destinatario,$id_nivel,$cuerpo,$f_registro,$h_registro){
           $consultar = "INSERT INTO mensajes_grupos (id_remitente, nombre_remitente, id_grupo_destinatario, id_nivel, cuerpo, f_registro, h_registro) VALUES (?,?,?,?,?,?,?)";
            try{
               $resultado = Database::getInstance()->getDb()->prepare($consultar);
                $resultado->execute(array($id_remitente,$nombre_remitente,$id_grupo_destinatario,$id_nivel,$cuerpo,$f_registro,$h_registro));
                return true;
           }catch(PDOException $e){
               return false;
           }
        }
        
        
        public static function getTokenViajeros($id_viaje){
            $consultar = "SELECT usuarios.token FROM usuarios INNER JOIN viajeros ON usuarios.id = viajeros.id_usuario INNER JOIN detalle_viajes WHERE viajeros.id = detalle_viajes.id_viajero AND detalle_viajes.id_viaje = ?";
            $resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($id_viaje));
			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);
			return ($tabla);
        }
        
        public static function EnviarNotificacion($Mensaje,$hora,$token,$emisor_del_mensaje){
            ignore_user_abort();
			ob_start();

			$url = 'https://fcm.googleapis.com/fcm/send';

			$fields = array('to' => $token,
			'data' => array('mensaje' => $Mensaje,'hora' => $hora,'cabezera' => $emisor_del_mensaje.' Envio un nuevo mensaje','cuerpo' => $Mensaje));

			define('GOOGLE_API_KEY', 'AIzaSyAZju9O7kX9b-LvsHVqepChdWQlr54HKMc');

			$headers = array(
			        'Authorization:key='.GOOGLE_API_KEY,
			        'Content-Type: application/json'
			);      

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

			$result = curl_exec($ch);
			if($result === false)
			  die('Curl failed ' . curl_error());
			curl_close($ch);
			return $result;
            }
        
        
        public static function ObtenerTodosLosMensajesDeGrupo($id_grupo){
			$consultar =  "SELECT * FROM mensajes_grupos WHERE id_grupo_destinatario = ?";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id_grupo));

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return ($tabla);

		}
        
        public static function ObtenerUltimoMensajeDeGrupo($id_grupo){
            
			$consultar =  "SELECT MAX(mensajes_grupos.id) as id, mensajes_grupos.id_remitente as id_remitente, mensajes_grupos.nombre_remitente as nombre_remitente,mensajes_grupos.id_grupo_destinatario as id_grupo_destinatario, mensajes_grupos.id_nivel as id_nivel, mensajes_grupos.cuerpo as cuerpo, mensajes_grupos.f_registro as f_registro, mensajes_grupos.h_registro as h_registro FROM mensajes_grupos WHERE mensajes_grupos.id_grupo_destinatario = ?";
            try{
			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id_grupo));

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
               return false;
           }

		}
        public static function ObtenerMensajesItinerario($id_grupo){
            $consultar = "SELECT * FROM dias_viajes WHERE id_viaje = ?";
            $resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($id_grupo));
			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);
			return ($tabla);
            
        }
        
        public static function ObtenerTodosLosUsuariosDeUnViaje($id_viaje){
            $consultar = "SELECT usuarios.id as id, viajeros.id as viajeroID, viajeros.nombre as nombre, viajeros.a_paterno as ap, viajeros.a_materno as am, viajeros.telefono as telefono, viajeros.correo as correo, usuarios.usuario as usuario, usuarios.contraseña as contraseña, usuarios.id_perfil as tipoUsuario, viajeros.edad as edad, viajeros.informacion as informacion, viajeros.sexo as sexo, viajeros.estado as estado, detalle_viajes.cantidad as cantidad FROM viajeros INNER JOIN usuarios ON viajeros.id_usuario = usuarios.id INNER JOIN detalle_viajes WHERE detalle_viajes.id_viajero = viajeros.id AND detalle_viajes.id_viaje = ?";
            
            $resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($id_viaje));
			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);
			return ($tabla);
            
        }
        
        public static function ObtenerNumeroDeViajeros($id_viaje){
            
			$consultar =  "SELECT COUNT(*) total FROM detalle_viajes WHERE id_viaje = ?";
            try{
               $resultado = Database::getInstance()->getDb()->prepare($consultar);
                $resultado->execute(array($id_viaje));
                $tabla = $resultado->fetch(PDO::FETCH_ASSOC);
                return $tabla;
           }catch(PDOException $e){
               return false;
           }
        }
        
            public static function ObtenerFavoritos($id_viajero){
            $consultar = "SELECT * FROM viajes INNER JOIN viajes_destacados ON viajes.id = viajes_destacados.id_viaje WHERE viajes_destacados.status = 1 AND viajes_destacados.id_viajero = ?";
            $resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($id_viajero));
			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);
			return ($tabla);
            
        }

    
    }


?>