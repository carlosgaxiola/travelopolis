/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.38-MariaDB : Database - travelopolis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`travelopolis` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `travelopolis`;

/*Table structure for table `detalle_viajes` */

DROP TABLE IF EXISTS `detalle_viajes`;

CREATE TABLE `detalle_viajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje unido a este registo',
  `id_viajero` int(11) DEFAULT NULL COMMENT 'Identificador del viajero unido a este registro',
  `cantidad` int(11) DEFAULT NULL COMMENT 'Cantidad de pasajes solicitados por el viajero',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de agregacion del regisro',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detalle_viajes` */

/*Table structure for table `dias_viajes` */

DROP TABLE IF EXISTS `dias_viajes`;

CREATE TABLE `dias_viajes` (
  `id` int(11) NOT NULL COMMENT 'Identifica el registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identifica el registro del viaje padre de este regisstro',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del dia, este campo es unico por cada id_viaje',
  `descripcion` text COMMENT 'Describe el dia del viaje',
  `f_dia` date DEFAULT NULL COMMENT 'Fecha de ocurrencia de dia',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del dia',
  `indice` int(11) DEFAULT NULL COMMENT 'Indice del dia en el itinerario del viaje',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dias_viajes` */

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre del Empleado',
  `a_paterno` varchar(45) DEFAULT NULL COMMENT 'Apellido Paterno del Empleado',
  `a_materno` varchar(45) DEFAULT NULL COMMENT 'Apellido Materno del Empelado',
  `telefono` varchar(15) DEFAULT NULL COMMENT 'Telefono de contacto del empleado',
  `correo` varchar(30) DEFAULT NULL COMMENT 'Correo del empleado registrado',
  `rfc` varchar(100) NOT NULL COMMENT 'RFC del Empleado, este campo es unico y obligatorio',
  `nss` varchar(100) NOT NULL COMMENT 'NSS del Empleado, esta campo es unico y obligatorio',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de la creacion del registro',
  `id_usuario` int(11) NOT NULL COMMENT 'Identificador de usuario',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `empleados` */

insert  into `empleados`(`id`,`nombre`,`a_paterno`,`a_materno`,`telefono`,`correo`,`rfc`,`nss`,`f_registro`,`id_usuario`,`status`) values (1,'Valeria','Altamirano','Palacios','6699129707','2016030063@upsin.edu.mx','ANV980321PAAL','70169728311','2019-03-11',1,1),(2,'Juan','Valverde','Martinez','6693250611','2016030063@upsin.edu.mx','JURA972305vVAMA','7016928311','2019-03-11',2,1),(3,'Carlos','Hernandez','Gaxiola','6694252565','2016030063@upsin.edu.mx','CAAL981507HEGA','7016928331','2019-03-11',3,1),(4,'José','Lora','Peinado','6631842943','2016030063@upsin.edu.mx','JOMA982308LOPA','70169255262','2019-03-11',4,1),(5,'Cesar','Ramirez','Luna','6392299693','2016030063@upsin.edu.mx','CEED990215RALU','7016521196','2019-03-11',5,1);

/*Table structure for table `mensajes_grupos` */

DROP TABLE IF EXISTS `mensajes_grupos`;

CREATE TABLE `mensajes_grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_remitente` int(11) DEFAULT NULL COMMENT 'Identifiacador del usuario remitente del mensaje',
  `id_grupo_destinatario` int(11) DEFAULT NULL COMMENT 'Identificador del grupo destinatario del mensaje',
  `cuerpo` longtext COMMENT 'Cuerpo del mensaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha del registro del mensaje',
  `h_registro` time DEFAULT NULL COMMENT 'Hora del registro del mensaje',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mensajes_grupos` */

/*Table structure for table `mensajes_privados` */

DROP TABLE IF EXISTS `mensajes_privados`;

CREATE TABLE `mensajes_privados` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_remitente` int(11) DEFAULT NULL COMMENT 'Identificador del usuario que mando el mensaje',
  `id_destinatario` int(11) DEFAULT NULL COMMENT 'Identificador del destinatario que mando el mensaje',
  `cuerpo` longtext COMMENT 'Cuerpo del mensaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha del registro del mensaje',
  `h_registro` time DEFAULT NULL COMMENT 'Hora del registro del mensaje',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mensajes_privados` */

/*Table structure for table `modulos` */

DROP TABLE IF EXISTS `modulos`;

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  `fa_icon` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `modulos` */

insert  into `modulos`(`id`,`nombre`,`descripcion`,`ruta`,`fa_icon`,`status`) values (1,'Inicio','Explora los viajes y tambien crea tu usuario','inicio','fas fa-home',1),(2,'Modulos','Modulo para ver los modulos','administrar/modulos','fas fa-puzzle-piece',1),(3,'Viajeros','Ver listado de viajeros','administrar/viajeros','far fa-user',1),(4,'Viajes','Agregar, editar, eliminar y ver registro de viajes','administrar/viajes','fas fa-plane',1),(5,'Perfiles','Ver, editar y cambiar permisos de perfiles','administrar/perfiles','fas fa-side-head',1),(6,'Guias','Agregar, editar, eliminar y listar guias','administrar/guias','fas fa-file-user',1),(7,'Administradores','Agregar, editar, eliminar y listar administradores','administrar/administradores','fas fa-user-cog',1),(8,'Mi Perfil','Ver datos de mi perfil de usuario','perfil','fas fa-user',1);

/*Table structure for table `movimientos` */

DROP TABLE IF EXISTS `movimientos`;

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `fecha` date DEFAULT NULL COMMENT 'Fecha de registro del movimiento',
  `tipo` int(11) DEFAULT NULL COMMENT 'Tipo de movimiento (0 registro, 1 baja, 2 modificacion)',
  `tabla` varchar(50) DEFAULT NULL COMMENT 'Nombre de la tabla afectada por el movimiento',
  `id_usuario_responsable` int(11) DEFAULT NULL COMMENT 'Identificador del usuario responsable del movimiento',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `movimientos` */

/*Table structure for table `perfiles` */

DROP TABLE IF EXISTS `perfiles`;

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `perfiles` */

insert  into `perfiles`(`id`,`nombre`,`descripcion`) values (1,'Administrador','Acceso a todo'),(2,'Guía','Acceso a itinerario y pasajeros'),(3,'Viajero','Cliente');

/*Table structure for table `perfiles_modulos` */

DROP TABLE IF EXISTS `perfiles_modulos`;

CREATE TABLE `perfiles_modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del regsitro',
  `id_perfil` int(11) DEFAULT NULL COMMENT 'Identifica el tipo de usuario que puede acceder al modulo',
  `id_modulo` int(11) DEFAULT NULL COMMENT 'Identifica el modulo que esta relaciona con el tipo de usuario',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha en que se agrego el reistro',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perfiles_modulos` */

/*Table structure for table `publicaciones` */

DROP TABLE IF EXISTS `publicaciones`;

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_propietario` int(11) DEFAULT NULL COMMENT 'Identificador del usuario propietario de la noticia',
  `cuerpo` text COMMENT 'Mensaje principal de la publicacion',
  `titulo` text COMMENT 'Titulo de la publicacion',
  `tipo` int(11) DEFAULT NULL COMMENT 'Tipo de noticia (0 viaje realizado, 1 viaje por realizar, 2 nuevo vieaje, 3 viaje renovado, 4 experiencia de viaje)',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro de la publicacion',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `publicaciones` */

/*Table structure for table `rutas_multimedia` */

DROP TABLE IF EXISTS `rutas_multimedia`;

CREATE TABLE `rutas_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje con el que se liga la archivo',
  `ruta` text COMMENT 'Ruta de la foto/imagen',
  `tipo` int(11) DEFAULT NULL COMMENT 'Tipo de archivo multimedia del registro (0 foto, 1 video)',
  `id_usuario` int(11) DEFAULT NULL COMMENT 'Identificador del usuario que agrego la foto',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha en que se agrego la foto',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rutas_multimedia` */

/*Table structure for table `tipos_proveedores` */

DROP TABLE IF EXISTS `tipos_proveedores`;

CREATE TABLE `tipos_proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de tipos de provedor',
  `nombre` varchar(40) DEFAULT NULL COMMENT 'nombre del tipo Hospedaje/Transporte/LUGAR',
  `estatus` int(11) DEFAULT NULL COMMENT '0=Inactivo/1=ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tipos_proveedores` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del usuario',
  `usuario` varchar(100) DEFAULT NULL COMMENT 'Nombre del usuario, este campo es unico',
  `contraseña` varchar(100) DEFAULT NULL COMMENT 'Contraseña del usuario, encriptacion sha1',
  `id_perfil` int(11) DEFAULT NULL COMMENT 'Identificador del rol que ejerce el usuario en el sistema (0 Sistemas, 1 Admistrador, 2 Guia, 3 Viajero)',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del usuario',
  `status` int(11) DEFAULT NULL COMMENT 'Estado actual del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`usuario`,`contraseña`,`id_perfil`,`f_registro`,`status`) values (1,'Valeria','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11',1),(2,'Juan','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11',1),(3,'Carlos','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11',1),(4,'Lora','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',2,'2019-03-11',1),(5,'Cesar','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',2,'2019-03-11',1),(6,'Linda','1234',3,'2019-03-11',1),(7,'Kimiko','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,'2019-03-11',1),(8,'inda','c2325b478dfeef64a3088ea3f8f0c0f284173a91',4,'2019-03-11',1),(9,'joma1998','1234',4,'2019-03-12',1);

/*Table structure for table `viajeros` */

DROP TABLE IF EXISTS `viajeros`;

CREATE TABLE `viajeros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `a_paterno` varchar(100) DEFAULT NULL,
  `a_materno` varchar(100) DEFAULT NULL,
  `ruta_foto` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL COMMENT 'Correo del viajero registrado',
  `id_usuario` int(11) DEFAULT NULL,
  `f_registro` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0) inactivo 1) activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `viajeros` */

insert  into `viajeros`(`id`,`nombre`,`a_paterno`,`a_materno`,`ruta_foto`,`telefono`,`correo`,`id_usuario`,`f_registro`,`status`) values (1,'Linda','German','Torres',NULL,'6699276707','2016030063@upsin.edu.mx',6,'2019-03-11',1),(2,'Alejandro','Castro','Aviles',NULL,'6691002599','2016030063@upsin.edu.mx',7,'2019-03-11',1),(3,'Armando','Inda','Mellado',NULL,'6692276707','2016030063@upsin.edu.mx',8,'2019-03-11',1),(4,'LORa','PEINADO','JOSE',NULL,NULL,NULL,9,NULL,NULL),(5,'$nombre','$apellido_p','$apellido_m','$nueva_foto','$telefono','$correo',0,'0000-00-00',0),(6,'LORA','LORA','LORA','LORA','LORA','LORA',1,'0000-00-00',1);

/*Table structure for table `viajes` */

DROP TABLE IF EXISTS `viajes`;

CREATE TABLE `viajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del viaje, este campo debe ser unico',
  `descripcion` text COMMENT 'Agrega una breve descripcion del viaje',
  `minimo` int(11) DEFAULT NULL COMMENT 'Cantidad minima de viajeros para poder realizar este viaje',
  `maximo` int(11) DEFAULT NULL COMMENT 'Cantidad maxima de viajeros para realizar este viaje',
  `precio` float DEFAULT NULL COMMENT 'Precio base del viaje',
  `dias_duracion` int(11) DEFAULT NULL COMMENT 'Duración del viaje',
  `noches_duracion` int(11) DEFAULT NULL COMMENT 'Cantidad de noches',
  `dias_espera_devolucion` int(11) DEFAULT NULL COMMENT 'Numero de dias antes de la fecha del viaje para pedir una devolucion',
  `f_inicio` date DEFAULT NULL COMMENT 'Fecha de inicio del viaje',
  `f_fin` date DEFAULT NULL COMMENT 'Fecha de fin del  viaje',
  `url_imagen` text COMMENT 'Url relativa al sitio donde se almacena una imagen de muestra para el viaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del viaje',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del viaje (0 Inactivo, 1 reclutando, 2 lleno, 3 realizado)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `viajes` */

insert  into `viajes`(`id`,`nombre`,`descripcion`,`minimo`,`maximo`,`precio`,`dias_duracion`,`noches_duracion`,`dias_espera_devolucion`,`f_inicio`,`f_fin`,`url_imagen`,`f_registro`,`status`) values (1,'Primavera Invernal','Viaje por Mazamitla en la primavera, y paseo al parque de diversiones',30,42,2400,3,2,30,'2019-04-26','2019-04-28',NULL,'2019-03-11',1),(2,'Playopolis','Viaje por Cancún visitando sus hermosas playas y hospedaje en un hotel de 3 estrellas.',30,42,6500,4,3,30,'2019-07-19','2019-07-22',NULL,'2019-03-11',1),(3,'Viaje Magico','Viaje por Guanajuato visitando sus hermosas ruinas y saludando sus momias.hola.',30,42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0);

/*Table structure for table `viajes_destacados` */

DROP TABLE IF EXISTS `viajes_destacados`;

CREATE TABLE `viajes_destacados` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje marcado como favorito',
  `id_viajero` int(11) DEFAULT NULL COMMENT 'Identificador del viajero que marco el viaje',
  `tipo` int(11) DEFAULT NULL COMMENT 'Tipo de destamiento del viaje (0 Me encanta, 1 Me hubiera gustado)',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del registro (1 Marcado, 0 No Marcado)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `viajes_destacados` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
