<?php
	
    require 'Database.php';

	class Favoritos{
		function _construct(){
		}

		public static function ObtenerTodosLosUsuarios(){
			$consultar = "SELECT * FROM usuarios";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute();

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return ($tabla);

		}
        
        public static function ObtenerStatus0($usuario,$id_viaje){
            $consultar = "SELECT * FROM viajes_destacados WHERE status = 0 AND id_viajero = ? AND id_viaje = ?";
            
            try{
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($usuario,$id_viaje));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
                return false;
            }
            return false;
            
        }
        
        public static function ObtenerStatus1($usuario,$id_viaje){
            $consultar = "SELECT * FROM viajes_destacados WHERE status = 1 AND id_viajero = ? AND id_viaje = ?";
            
            try{
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($usuario,$id_viaje));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
                return false;
            }
            return false;
            
        }
        
            public static function ActualizarFavorito($usuario,$id_viaje){
            $consultar = "UPDATE viajes_destacados SET status = 0 WHERE viajes_destacados.id_viajero = ? AND id_viaje = ?";
            
            try{
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($usuario,$id_viaje));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
                return false;
            }
            return false;
            
        }
        
        public static function ActualizarFavoritoPositivo($usuario,$id_viaje){
            $consultar = "UPDATE viajes_destacados SET status = 1 WHERE viajes_destacados.id_viajero = ? AND id_viaje = ?";
            
            try{
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($usuario,$id_viaje));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
                return false;
            }
            return false;
            
        }
        
        public static function InsertarNuevoFavorito($id_viaje, $id_viajero,$fecha){
            $consultar = "INSERT INTO viajes_destacados(id, id_viaje, id_viajero, f_registro, status) VALUES (NULL,?,?,?,1)";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($id_viaje, $id_viajero,$fecha));
            }catch(PDOException $e){
                return false;
            }
            return false;
        }
        
        public static function ObtenerIDPorUsuario($usuario){
            $consultar = "SELECT id FROM usuarios WHERE usuario = ?";
            
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
            $consultar = "SELECT usuarios.id as id, viajeros.nombre as nombre, viajeros.a_paterno as ap, viajeros.a_materno as am, viajeros.telefono as telefono, viajeros.correo as correo, usuarios.usuario as usuario, usuarios.contraseña as contraseña, usuarios.id_perfil as tipoUsuario FROM viajeros INNER JOIN usuarios ON viajeros.id_usuario = usuarios.id WHERE usuarios.usuario = ? ";
            
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
        
        public static function InsertarNuevoDato($usuario,$password,$id_perfil,$f_registro,$status){
            $consultar = "INSERT INTO usuarios(usuario,contraseña,id_perfil,f_registro,status) VALUES(?,?,?,?,?)";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($usuario,$password,$id_perfil,$f_registro,$status));
            }catch(PDOException $e){
                return false;
            }
        }
         public static function InsertarNuevoDatoViajero($nombre,$a_paterno,$a_materno,$sexo,$edad,$estado,$url_foto,$telefono,$correo,$informacion,$id_usuario,$f_registro,$status){
            $consultar = "INSERT INTO viajeros(nombre,a_paterno,a_materno,sexo,edad,estado,url_foto,telefono,correo,informacion,id_usuario,f_registro,status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($nombre,$a_paterno,$a_materno,$sexo,$edad,$estado,$url_foto,$telefono,$correo,$informacion,$id_usuario,$f_registro,$status));
            }catch(PDOException $e){
                return false;
            }
        }
        
        
        public static function ActualizarDatos($usuario,$password){
            if(self::ObtenerDatosPorUsuario($usuario)){
                $consultar = "UPDATE usuarios SET contraseña=? WHERE usuario=?";
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($password,$usuario));
            }else{
                return false;
            }
        

        }
	}


?>