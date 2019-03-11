<?php
	
    require 'Database.php';

	class Registro{
		function _construct(){
		}

		public static function ObtenerTodosLosUsuarios(){
			$consultar = "SELECT * FROM usuarios";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute();

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return ($tabla);

		}
            
        public static function ObtenerDatosPorUsuario($usuario){
            $consultar = "SELECT usuario,contraseña FROM usuarios WHERE usuario = ?";
            
            try{
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($usuario));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
            echo "Ocurrio un Error, Intentelo Mas tarde";
            }
            return false;
            
        }
	}


?>