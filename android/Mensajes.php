<?php
    require 'Database.php';

    class Mensajes{
        function _construct(){
            
        }
        public static function EnviarMensaje($id,$id_remitente,$id_destinatario,$cuerpo,$f_registro,$h_registro){
           try{
               $consultar = "INSERT INTO mensajes_privados(id,id_remitente,id_destinatario,cuerpo,f_registro,h_registro) VALUES (?,?,?,?,?,?)";
               $resultado = Database::getInstance()->getDb()->prepare($consultar);
                $resultado->execute(array($id,$id_remitente,$id_destinatario,$cuerpo,$f_registro,$h_registro));
               return 200;


           }catch(PDOException $e){
               return -1;
           }
        }
        
        
        public static function getTokenUser($id){
            $consultar = "SELECT usuario,token FROM usuarios WHERE id = ?";
            $resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($id));
			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);
			return ($tabla);
        }
        
        public static function EnviarNotificacion($Mensaje,$hora,$token,$emisor_del_mensaje){
            ignore_user_abort();
			ob_start();

			$url = 'https://fcm.googleapis.com/fcm/send';

			$fields = array('to' => $token,
			'data' => array('mensaje' => $Mensaje,'hora' => $hora,'cabezera' => $emisor_del_mensaje.' te envio un nuevo mensaje','cuerpo' => $Mensaje));

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
        
        public static function ObtenerMensajesPorGrupo($id_grupo){
            $consultar = "SELECT * FROM mensajes_grupos WHERE id_grupo_destinatario = ?";
            
            try{
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id_grupo));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
            echo "Ocurrio un Error, Intentelo Mas tarde";
            }
            return false;
            
        }
        
        
    }


?>