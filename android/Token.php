<?php
	
    require 'Database.php';

	class Token{
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
            $consultar = "SELECT usuario,token FROM usuarios WHERE usuario = ?";
            
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
        public static function ObtenerInformacionPorUsuario($usuario){
            $consultar = "SELECT viajeros.nombre as nombre, viajeros.a_paterno as ap, viajeros.a_materno as am, viajeros.telefono as telefono, viajeros.correo as correo, usuarios.usuario as usuario, usuarios.contraseña as contraseña, usuarios.id_perfil as tipoUsuario FROM viajeros INNER JOIN usuarios ON viajeros.id_usuario = usuarios.id WHERE usuarios.usuario = ? ";
            
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
        
        public static function InsertarNuevoDato($usuario,$password){
            $consultar = "INSERT INTO usuarios(usuario,token) VALUES(?,?)";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($usuario,$password));
            }catch(PDOException $e){
                return false;
            }
            
        }
        
        public static function ActualizarDatosToken($usuario,$password){
            if(self::ObtenerDatosPorUsuario($usuario)){
                $consultar = "UPDATE usuarios SET token=? WHERE usuario=?";
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($password,$usuario));
            }else{
                return false;
            }
    
        }
        
        public static function ActualizarDatosTokenDiferentes($token,$usuario){
            if(self::ObtenerDatosPorUsuario($usuario)){
                $consultar = "UPDATE usuarios SET token = NULL WHERE token = ? AND usuario <> ?";
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($token,$usuario));
            }else{
                return false;
            }
    
        }
        
        
	}


?>