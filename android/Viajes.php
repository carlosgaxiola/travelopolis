<?php
	
    require 'Database.php';

	class Viajes{
		function _construct(){
		}

		public static function ObtenerTodosLosViajes(){
			$consultar = "SELECT * FROM viajes WHERE status = 1";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute();

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return ($tabla);
		}
        
        public static function ObtenerTodosLosFamiliares($id_viaje,$id_viajero){
			$consultar = "SELECT * FROM viajeros_familiares WHERE id_viaje = ? AND id_viajero = ?";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id_viaje,$id_viajero));

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return ($tabla);
		}
        
        
        
        
        public static function ObtenerViajeId($id){
            $consultar = "SELECT * FROM viajes WHERE status = 1 AND id = ?";
            
            try{
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
            echo "Ocurrio un Error, Intentelo Mas tarde";
            }
            return false;
            
        }
            
        public static function ObtenerDatosPorUsuario($usuario){
            $consultar = "SELECT * FROM usuarios WHERE usuario = ?";
            
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
        public static function ObtenerInformacionPorUsuario($id){
            $consultar = "SELECT viajes.id as id, viajes.nombre as nombre, viajes.descripcion as descripcion, viajes.minimo as minimo, viajes.maximo as maximo, viajes.precio as precio, viajes.dias_duracion as dias_duracion, viajes.noches_duracion as noches_duracion, viajes.dias_espera_devolucion as dias_espera_devolucion, viajes.f_inicio as f_inicio, viajes.f_fin as f_fin, viajes.id_tipo_viaje as id_tipo_viaje, viajes.f_registro as f_registro, viajes.status as status FROM viajes INNER JOIN detalle_viajes WHERE detalle_viajes.id_viaje = viajes.id AND detalle_viajes.status IN(1,2,3) AND viajes.status > 0 AND detalle_viajes.id_viajero = ?";
            
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id));

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return ($tabla);
            
        }
        
        public static function ObtenerInformacionPorGuia($id){
            $consultar = "SELECT viajes.id as id, viajes.nombre as nombre, viajes.descripcion as descripcion, viajes.minimo as minimo, viajes.maximo as maximo, viajes.precio as precio, viajes.dias_duracion as dias_duracion, viajes.noches_duracion as noches_duracion, viajes.dias_espera_devolucion as dias_espera_devolucion, viajes.f_inicio as f_inicio, viajes.f_fin as f_fin, viajes.id_tipo_viaje as id_tipo_viaje, viajes.f_registro as f_registro, viajes.status as status FROM viajes INNER JOIN guias_viajes WHERE guias_viajes.id_viaje = viajes.id AND viajes.status > 0 AND guias_viajes.id_guia = ?";
            
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id));

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return ($tabla);
            
        }
        
        public static function InsertarNuevoDato($usuario,$password){
            $consultar = "INSERT INTO usuarios(usuario,contraseña) VALUES(?,?)";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($usuario,$password));
            }catch(PDOException $e){
                return false;
            }
            
        }
        
        public static function InsertarNuevoDetalleViaje($id_viaje,$id_viajero,$cantidad,$resto,$f_registro){
            $consultar = "INSERT INTO detalle_viajes(id, id_viaje, id_viajero, cantidad, resto,f_registro, status) VALUES (NULL,?,?,?,?,?,4)";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($id_viaje,$id_viajero,$cantidad,$resto,$f_registro));
            }catch(PDOException $e){
                return false;
            }
            
        }
        
        public static function InsertarNuevoViajeroFamiliar($id_viaje,$id_viajero){
            $consultar = "INSERT INTO viajeros_familiares(id, id_viaje, id_viajero, nombre, apellido_p, apellido_m, edad, telefono, tipo_familiar, status) VALUES (NULL,?,?,'SIN NOMBRE','SIN APELLIDO P','SIN APELLIDO M',0,'SIN TELEFONO','SIN TIPO FAMILIAR',1)";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($id_viaje,$id_viajero));
            }catch(PDOException $e){
                return false;
            }
        }
        
        public static function SeleccionarResto($id_viaje,$id_viajero){
            $consultar = "SELECT cantidad, resto, precio FROM detalle_viajes WHERE id_viaje = ? AND id_viajero = ?";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                
                $resultado->execute(array($id_viaje,$id_viajero));
                
                $tabla = $resultado->fetch(PDO::FETCH_ASSOC);
                
                return ($tabla);
            }catch(PDOException $e){
                return false;
            }
        }
        
        public static function ObtenerViaje($id_viaje,$usuario){
            $consultar = "SELECT * FROM detalle_viajes WHERE id_viaje = ? AND id_viajero = ?";
            
            try{
            $resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id_viaje,$usuario));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return ($tabla);
            }catch(PDOException $e){
                return false;
            }
            return false;
            
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

        public static function ActualizarFamiliares($nombre,$apellido_p,$apellido_m,$edad,$telefono,$tipo_familiar,$id){
                $consultar = "UPDATE viajeros_familiares SET nombre = ?, apellido_p = ?, apellido_m = ?, edad = ?, telefono = ?, tipo_familiar=? WHERE id= ? ";
            try{
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($nombre,$apellido_p,$apellido_m,$edad,$telefono,$tipo_familiar,$id));
            }catch(PDOException $e){
                return false;
            }
        }
	}


?>