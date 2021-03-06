/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - travelopolis
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
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifica el registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identifica el registro del viaje padre de este regisstro',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del dia, este campo es unico por cada id_viaje',
  `descripcion` text COMMENT 'Describe el dia del viaje',
  `f_dia` date DEFAULT NULL COMMENT 'Fecha de ocurrencia de dia',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del dia',
  `indice` varchar(10) DEFAULT NULL COMMENT 'Indice del dia en el itinerario del viaje',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `dias_viajes` */

insert  into `dias_viajes`(`id`,`id_viaje`,`nombre`,`descripcion`,`f_dia`,`f_registro`,`indice`) values (10,13,'hola','adios','2019-04-02','2019-03-29','0'),(11,13,'hola','adios','2019-04-03','2019-03-29','0'),(12,14,'hola','adios','2019-04-02','2019-03-29','0'),(13,14,'hola','adios','2019-04-03','2019-03-29','0'),(14,3,'instalarse','Llegar al hotel e instalar a los viajeros','2019-03-01',NULL,'d1v3'),(15,3,'Desayuno','comer porque traemos un chingo de hambre','2019-03-30',NULL,'d2v3'),(16,13,'hola','adios','2019-04-02',NULL,'0'),(17,13,'hola','adios','2019-04-03',NULL,'0'),(18,2,'hola','adios','2019-03-30','2019-03-30','0'),(19,14,'dia 1','instalarse','2019-03-31',NULL,'dia1viaje1'),(20,14,'hola','adios','2019-04-02',NULL,'dia1viaje1'),(21,14,'hola','adios','2019-04-03',NULL,'dia2viaje1'),(22,14,'dia 1','instalarse','2019-03-31',NULL,'dia3viaje1');

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
  `url_foto` varchar(255) DEFAULT NULL COMMENT 'Ruta de la imagen de perfil del empleado',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de la creacion del registro',
  `id_usuario` int(11) NOT NULL COMMENT 'Identificador de usuario',
  `informacion` text,
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `empleados` */

insert  into `empleados`(`id`,`nombre`,`a_paterno`,`a_materno`,`telefono`,`correo`,`rfc`,`nss`,`url_foto`,`f_registro`,`id_usuario`,`informacion`,`status`) values (1,'Valeria','Altamirano','Palacios','6699129707','2016030063@upsin.edu.mx','ANV980321PAAL','70169728311',NULL,'2019-03-11',1,NULL,1),(2,'Juan','Valverde','Martinez','6693250611','2016030063@upsin.edu.mx','JURA972305vVAMA','7016928311',NULL,'2019-03-11',2,NULL,1),(3,'Carlos','Hernandez','Gaxiola','6694252565','2016030063@upsin.edu.mx','CAAL981507HEGA','7016928331','65184963b4f0c19f14cca0016b5b92ecc62d9df4','2019-03-11',3,'me gusta programar',1),(4,'José','Lora','Peinado','6631842943','2016030063@upsin.edu.mx','JOMA982308LOPA','70169255262',NULL,'2019-03-11',4,NULL,1),(5,'Cesar','Ramirez','Luna','6392299693','2016030063@upsin.edu.mx','CEED990215RALU','7016521196',NULL,'2019-03-11',5,NULL,1);

/*Table structure for table `estados` */

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `abreviatura` varchar(45) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Data for the table `estados` */

insert  into `estados`(`id`,`nombre`,`abreviatura`,`status`) values (1,'AGUASCALIENTES','AGS.',1),(2,'BAJA CALIFORNIA','B. C.',1),(3,'BAJA CALIFORNIA SUR','B. C. S.',1),(4,'CAMPECHE','CAMP.',1),(5,'CHIAPAS','CHIS.',1),(6,'CHIHUAHUA','CHIH.',1),(7,'CIUDAD DE MÉXICO','CDMX.',1),(8,'COAHUILA DE ZARAGOZA','COAH.',1),(9,'COLIMA','COL.',1),(10,'DURANGO','DGO.',1),(11,'GUANAJUATO','GTO.',1),(12,'GUERRERO','GRO.',1),(13,'HIDALGO','HGO.',1),(14,'JALISCO','JAL.',1),(15,'MÉXICO','MÉX.',1),(16,'MICHOACÁN DE OCAMPO','MICH.',1),(17,'MORELOS','MOR.',1),(18,'NAYARIT','NAY.',1),(19,'NUEVO LEÓN','N. L.',1),(20,'OAXACA','OAX.',1),(21,'PUEBLA','PUE.',1),(22,'QUERÉTARO DE ARTEAGA','QRO.',1),(23,'QUINTANA ROO','Q. R.',1),(24,'SAN LUIS POTOSÍ','S. L. P.',1),(25,'SINALOA','SIN.',1),(26,'SONORA','SON.',1),(27,'TABASCO','TAB.',1),(28,'TAMAULIPAS','TAMPS.',1),(29,'TLAXCALA','TLAX.',1),(30,'VERACRUZ DE IGNACIO DE LA LLAVE','VER.',1),(31,'YUCATÁN','YUC.',1),(32,'ZACATECAS','ZAC.',1),(33,'EXTRANJERO','EXT.',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

/*Data for the table `mensajes_privados` */

insert  into `mensajes_privados`(`id`,`id_remitente`,`id_destinatario`,`cuerpo`,`f_registro`,`h_registro`) values (1,7,6,'QueOndaRaza','2019-03-18','03:00:00'),(2,7,6,'raza','2019-03-19','01:46:07'),(3,6,7,'raza','2019-03-19','02:06:05'),(4,6,7,'raza','2019-03-19','02:12:04'),(5,6,7,'raza','2019-03-19','02:12:37'),(6,6,7,'raza','2019-03-19','02:16:48'),(7,7,6,'raza','2019-03-19','02:17:47'),(8,7,6,'raza','2019-03-19','02:18:23'),(9,7,6,'raza','2019-03-19','02:19:20'),(10,7,6,'raza','2019-03-19','02:22:01'),(11,7,6,'raza','2019-03-19','02:22:16'),(12,7,6,'raza','2019-03-19','02:22:42'),(13,7,6,'raza','2019-03-19','02:22:49'),(14,7,6,'Que PEdo Raza','2019-03-19','02:23:31'),(15,7,6,'Que PEdo Raza','2019-03-19','02:24:16'),(16,6,7,'Lora','2019-03-19','03:12:50'),(17,6,7,'Lora','2019-03-19','03:13:02'),(18,6,7,'Lora','2019-03-19','03:17:59'),(19,6,7,'Lora','2019-03-19','03:18:18'),(20,6,7,'Lora','2019-03-19','03:20:29'),(21,7,6,'Que PEdo Raza','2019-03-19','03:29:08'),(22,6,7,'Lora','2019-03-19','03:29:19'),(23,6,7,'Lora','2019-03-19','03:33:04'),(24,6,7,'que pedo razita pisteadora','2019-03-19','03:34:06'),(25,6,7,'Lora','2019-03-19','03:34:59'),(26,6,7,'Valió madre raza','2019-03-19','03:36:04'),(27,7,6,'ue','2019-03-19','03:37:47'),(28,7,6,'que pedo alv','2019-03-19','03:38:02'),(29,6,7,'Lora','2019-03-19','03:38:18'),(30,6,7,'Lora','2019-03-19','03:39:34'),(31,7,6,'Lora','2019-03-19','03:39:51'),(32,6,7,'Lora','2019-03-19','03:39:55'),(33,7,6,'Lora','2019-03-19','03:40:09'),(34,6,7,'Lora','2019-03-19','03:40:16'),(35,7,6,'lora','2019-03-19','03:42:03'),(36,7,6,'lora','2019-03-19','03:42:06'),(37,7,6,'lora','2019-03-19','03:42:07'),(38,7,6,'lora','2019-03-19','03:42:08'),(39,7,6,'lora','2019-03-19','03:42:12'),(40,7,6,'af','2019-03-19','03:42:14'),(41,7,6,'sjeud','2019-03-19','03:42:17'),(42,7,6,'lota','2019-03-19','03:42:30'),(43,6,7,'Lora','2019-03-19','03:51:31'),(44,6,7,'Lora','2019-03-19','03:53:41'),(45,6,7,'Peinado','2019-03-19','03:53:48'),(46,6,7,'Lora','2019-03-19','03:53:58'),(47,7,6,'Lora','2019-03-19','03:54:17'),(48,7,61,'Que pwdo','2019-03-19','03:55:37'),(49,7,61,'que onda raza','2019-03-19','03:56:05'),(50,6,71,'Que onda','2019-03-19','03:56:26'),(51,6,71,'Lora','2019-03-19','03:57:01'),(52,7,61,'Lora','2019-03-19','03:57:12'),(53,7,71,'ksks','2019-03-19','03:57:26'),(54,7,71,'LoraPeinafo','2019-03-19','03:57:59'),(55,6,61,'peinado','2019-03-19','03:58:24'),(56,6,61,'que mamada con esto alv','2019-03-19','03:58:38'),(57,6,61,'Lora','2019-03-19','04:12:48'),(58,6,61,'Linda','2019-03-19','04:15:36'),(59,6,61,'que tranza perro','2019-03-19','04:15:49'),(60,6,61,'Linda','2019-03-19','13:40:15'),(61,6,61,'Login','2019-03-19','13:41:01'),(62,6,61,'login','2019-03-19','13:41:11'),(63,6,61,'Login','2019-03-19','13:42:18'),(64,6,61,'Login','2019-03-19','13:42:25'),(65,6,61,'que onda','2019-03-19','14:01:34'),(66,6,61,'por favor Diosito','2019-03-19','14:07:14'),(67,6,61,'Lora','2019-03-19','15:47:11'),(68,6,61,'Peinado','2019-03-19','15:47:50'),(69,6,61,'lora','2019-03-19','15:48:08'),(70,6,71,'cr','2019-03-19','15:48:15'),(71,6,61,'Lora','2019-03-19','15:49:00'),(72,6,61,'ojalá no me salga ','2019-03-19','16:17:11'),(73,6,61,'asd','2019-03-20','17:46:59'),(74,6,61,'etc','2019-03-20','17:47:08'),(75,6,61,'shsjsjdhdhdhdhhdhd','2019-03-20','17:47:15'),(76,6,61,'soy joto gg','2019-03-20','17:47:25'),(77,6,61,'delate','2019-03-20','17:47:32'),(78,6,61,'delete * from usuario','2019-03-20','17:47:59'),(79,6,61,'hola','2019-03-21','17:12:23'),(80,6,61,'que haces?','2019-03-21','17:12:36'),(81,6,61,'suicidarme ','2019-03-21','17:12:45'),(82,6,61,'que bueno ','2019-03-21','17:12:51'),(83,6,61,'ojalá te mueras ','2019-03-21','17:12:56'),(84,6,61,'adiós ','2019-03-21','17:12:59'),(85,6,61,'lora','2019-03-21','17:30:08'),(86,6,61,'lors','2019-03-21','17:31:33'),(87,7,61,'Que PEdo Raza','2019-03-22','19:14:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `modulos` */

insert  into `modulos`(`id`,`nombre`,`descripcion`,`ruta`,`fa_icon`,`status`) values (1,'Inicio','Explora los viajes y tambien crea tu usuario','inicio','fas fa-home',1),(2,'Modulos','Modulo para ver los modulos','admin/Modulos','fas fa-puzzle-piece',1),(3,'Viajeros','Ver listado de viajeros','admin/Viajeros','far fa-user',1),(4,'Viajes','Agregar, editar, eliminar y ver registro de viajes','admin/Viajes','fas fa-plane',1),(5,'Perfiles','Ver, editar y cambiar permisos de perfiles','admin/Perfiles','fas fa-tag',1),(6,'Guias','Agregar, editar, eliminar y listar guias','admin/Guias','fas fa-file-user',1),(7,'Administradores','Agregar, editar, eliminar y listar administradores','admin/Administradores','fas fa-user-cog',1),(8,'Mi Perfil','Ver datos de mi perfil de usuario','perfil','fas fa-user',1),(9,'Inicio Administrador','Inicio de administrador','administrar','fas fa-cogs',1),(10,'Asignar Guias','Asignar Guias','admin/Asignar','fas fa-users',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `perfiles_modulos` */

insert  into `perfiles_modulos`(`id`,`id_perfil`,`id_modulo`,`f_registro`,`status`) values (25,1,2,NULL,NULL),(26,1,3,NULL,NULL),(27,1,4,NULL,NULL),(28,1,5,NULL,NULL),(29,1,6,NULL,NULL),(30,1,7,NULL,NULL),(31,1,9,NULL,NULL),(32,1,10,NULL,NULL);

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
  `tipo_archivo` int(11) DEFAULT NULL COMMENT 'Tipo de archivo multimedia del registro (0 foto, 1 video)',
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

/*Table structure for table `tipos_viaje` */

DROP TABLE IF EXISTS `tipos_viaje`;

CREATE TABLE `tipos_viaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `f_registro` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tipos_viaje` */

insert  into `tipos_viaje`(`id`,`nombre`,`f_registro`,`status`) values (1,'Playero','2019-03-26',1),(2,'Natural','2019-03-26',1),(5,'Arqueologíco','2019-03-26',1),(6,'Pueblo','2019-03-31',1),(7,'Cabaña','2019-03-31',1);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del usuario',
  `usuario` varchar(100) DEFAULT NULL COMMENT 'Nombre del usuario, este campo es unico',
  `contraseña` varchar(100) DEFAULT NULL COMMENT 'Contraseña del usuario, encriptacion sha1',
  `id_perfil` int(11) DEFAULT NULL COMMENT 'Identificador del rol que ejerce el usuario en el sistema (0 Sistemas, 1 Admistrador, 2 Guia, 3 Viajero)',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del usuario',
  `token` varchar(500) DEFAULT NULL COMMENT 'Id Único Otorgado a cada Celular del Usuario',
  `status` int(11) DEFAULT NULL COMMENT 'Estado actual del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`usuario`,`contraseña`,`id_perfil`,`f_registro`,`token`,`status`) values (1,'Valeria','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11','',1),(2,'Juan','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11','',1),(3,'Carlos','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11','',1),(4,'Lora','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',2,'2019-03-11','',1),(5,'Cesar','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',2,'2019-03-11','',1),(6,'Linda','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,'2019-03-11','ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo',1),(7,'Kimiko','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,'2019-03-11','ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo',1),(8,'inda','c2325b478dfeef64a3088ea3f8f0c0f284173a91',4,'2019-03-11','',1),(9,'joma1998','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',4,'2019-03-12','ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo',1),(10,'valeverga','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',NULL,NULL,'raza',NULL),(16,'lora','Lora',4,'0000-00-00',NULL,1),(17,'Verga1','Verga2',4,'2019-03-24',NULL,1),(18,'lachingada','Verga2',4,'2019-03-24',NULL,1),(19,'Jose Manuel Lora Peinado','Vale Madre',4,'2019-03-24',NULL,1),(20,'joma1998','Vale Madre',4,'2019-03-24','ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo',1),(22,'bernalputo','Vale Madre',4,'2019-03-24',NULL,1),(23,'nommes','Vale Madre',1,'2019-03-25',NULL,1),(24,'nommesss','Vale Madre',1,'2019-03-25',NULL,1),(25,'manuel','manuel',4,'2019-03-25',NULL,1),(26,'joma1999','bsndjd',4,'2019-03-25',NULL,1),(27,'prueba','123',4,'2019-03-25',NULL,1),(28,'corola','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',4,'2019-03-25','ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo',1),(29,'lorapeinado123','25b99bacd5f00970e7f5003b4463b2456c22f73c',4,'2019-03-27','ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo',1),(41,'juanpa','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,'2019-03-30',NULL,2),(42,'ada','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',NULL,'2019-04-01',NULL,1),(43,'ada','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',NULL,'2019-04-01',NULL,1),(54,'2016','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',NULL,'2019-04-01',NULL,1),(62,'carlosgaxiola','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',NULL,'2019-04-01',NULL,0),(65,'angela','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',NULL,'2019-04-01',NULL,0);

/*Table structure for table `viajeros` */

DROP TABLE IF EXISTS `viajeros`;

CREATE TABLE `viajeros` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del viajero',
  `a_paterno` varchar(100) DEFAULT NULL COMMENT 'Apellido materno del viajero',
  `a_materno` varchar(100) DEFAULT NULL COMMENT 'Apellido paterno del viajero',
  `sexo` varchar(10) DEFAULT NULL COMMENT 'Sexo del Viajero',
  `edad` int(11) DEFAULT NULL COMMENT 'Edad del viajero',
  `estado` varchar(100) DEFAULT NULL COMMENT 'Estado donde reside el viajero',
  `telefono` varchar(15) DEFAULT NULL COMMENT 'Número de telefono del viajero',
  `correo` varchar(30) DEFAULT NULL COMMENT 'Correo del viajero registrado',
  `informacion` varchar(500) DEFAULT NULL COMMENT 'Informacion sobre el usuario',
  `id_usuario` int(11) DEFAULT NULL COMMENT 'Idenficador del usuario de este registro de viajero',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro',
  `status` int(11) DEFAULT NULL COMMENT '0) inactivo 1) activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `viajeros` */

insert  into `viajeros`(`id`,`nombre`,`a_paterno`,`a_materno`,`sexo`,`edad`,`estado`,`telefono`,`correo`,`informacion`,`id_usuario`,`f_registro`,`status`) values (1,'Linda','German','Torres','femenino',0,'sinaloa','6699276707','2016030063@upsin.edu.mx','',6,'2019-03-11',1),(2,'Alejandro','Castro','Aviles','Hombre',12,'SINALOA','6691002599','2016030063@upsin.edu.mx','es kimiko',7,'2019-03-11',1),(3,'Armando','Inda','Mellado','Hombre',23,'AGUASCALIENTES','6692276707','2016030063@upsin.edu.mx','asdasdasdasdasd',8,'2019-03-11',1),(5,'$nombre','$apellido_p','$apellido_m',NULL,NULL,NULL,'$telefono','$correo',NULL,0,'0000-00-00',2),(6,'LORA','LORA','LORA',NULL,NULL,NULL,'LORA','LORA',NULL,1,'0000-00-00',1),(7,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,4,'2019-03-24',2),(8,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,NULL,'2019-03-24',1),(9,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,NULL,'2019-03-24',1),(10,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,NULL,'2019-03-24',1),(11,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,18,'2019-03-24',2),(12,'Yeah','1','1',NULL,NULL,NULL,'1','1',NULL,19,'2019-03-24',2),(13,'Yeah','adad','asdad','Hombre',12,'NUEVO LEÓN','1234567890','adios@gmail.com','sdfghjklñpoiuytrexdcfgbh',9,'2019-03-24',2),(14,'Yeah','perdonen','kemehameha','Hombre',20,'MORELOS','1234567','hola@gmail.com','quien no haya seguido esta serie es porque no tuvo infancia',9,'2019-03-24',2),(15,'Yeah','1','1',NULL,NULL,NULL,'1','1',NULL,22,'2019-03-24',2),(16,'Yeah','1','1','HOMBRE',NULL,'Sinaloa','1','1','LORA',23,'2019-03-25',2),(17,'Yeah','1','1','HOMBRE',0,'Sinaloa','1','1','LORA',24,'2019-03-25',2),(18,'manuel','manuel','manuel','HOMBRE',0,'México','919764','manuel','manuel',25,'2019-03-25',2),(19,'jdnfjd','jsjdjd','jdjddj','MUJER',0,'Colima','676734','hshdhs','hsjdnd',26,'2019-03-25',2),(20,'soy','una','prueba','MUJER',20000000,'Guanajuato','239','hola','prueba soy?',27,'2019-03-25',2),(21,'Ira pues','andale','noteme','HOMBRE',0,'Baja California Sur','9863548','joma1998@hotmail.com','lora',28,'2019-03-25',2),(22,'Jose Manuel','Lora','Peinado','HOMBRE',0,'Sinaloa','9863548','joma1998@hotmail.com','Espero poder pasar',29,'2019-03-27',2),(34,'juan pablo','sanchez','gaxiola',NULL,NULL,NULL,'1234567890','2016030022@upsin.edu.mx',NULL,41,'2019-03-30',2),(35,'ada','san','gax','femenino',18,'sinaloa','1234567890','2016030022@upsin.edu.mx','',NULL,'2019-04-01',1),(36,'ada','san','gax','femenino',18,'sinaloa','1234567890','2016030022@upsin.edu.mx','hola',NULL,'2019-04-01',1),(48,'carlos','m','om','Hombre',20,'BAJA CALIFORNIA','0982','2016030023@upsin.edu.mx','',54,'2019-04-01',1),(59,'carlos','hernandez','gaxiola','Hombre',20,'BAJA CALIFORNIA SUR','123456789','angelasandovalg21@gmail.com','',65,'2019-04-01',1);

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
  `id_tipo_viaje` int(11) DEFAULT NULL COMMENT 'id del tipo de viaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del viaje',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del viaje (0 Inactivo, 1 reclutando, 2 lleno, 3 realizado, 4 en curso)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `viajes` */

insert  into `viajes`(`id`,`nombre`,`descripcion`,`minimo`,`maximo`,`precio`,`dias_duracion`,`noches_duracion`,`dias_espera_devolucion`,`f_inicio`,`f_fin`,`id_tipo_viaje`,`f_registro`,`status`) values (1,'Primavera Invernal','Viaje por Mazamitla en la primavera, y paseo al parque de diversiones',30,42,2400,3,2,30,'2019-04-26','2019-04-28',1,'2019-03-11',3),(2,'Playopolis','Viaje por Cancún visitando sus hermosas playas y hospedaje en un hotel de 3 estrellas.',30,42,6500,4,3,30,'2019-07-19','2019-07-22',2,'2019-03-11',2),(3,'Viaje Magico','Viaje por Guanajuato visitando sus hermosas ruinas y saludando sus momias.hola.',30,42,1000,9,8,1,'2019-03-01','2019-03-09',5,NULL,1),(13,'viaje de prueba 5','Hola',10,20,10,2,1,2,'2019-04-02','2019-04-02',5,'2019-03-29',3),(14,'viaje prueba 6','hola',10,20,1000,5,4,1,'2019-04-02','2019-04-06',2,'2019-03-29',0);

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

/*Table structure for table `listar_viajeros` */

DROP TABLE IF EXISTS `listar_viajeros`;

/*!50001 DROP VIEW IF EXISTS `listar_viajeros` */;
/*!50001 DROP TABLE IF EXISTS `listar_viajeros` */;

/*!50001 CREATE TABLE  `listar_viajeros`(
 `id` int(11) ,
 `nombre` varchar(100) ,
 `paterno` varchar(100) ,
 `materno` varchar(100) ,
 `sexo` varchar(10) ,
 `estado` varchar(100) ,
 `edad` int(11) ,
 `telefono` varchar(15) ,
 `correo` varchar(30) ,
 `informacion` varchar(500) ,
 `idUsuario` int(11) ,
 `registro` date ,
 `status` int(11) ,
 `usuario` varchar(100) 
)*/;

/*Table structure for table `listar_viajes` */

DROP TABLE IF EXISTS `listar_viajes`;

/*!50001 DROP VIEW IF EXISTS `listar_viajes` */;
/*!50001 DROP TABLE IF EXISTS `listar_viajes` */;

/*!50001 CREATE TABLE  `listar_viajes`(
 `id` int(11) ,
 `nombre` varchar(100) ,
 `descripcion` text ,
 `minimo` int(11) ,
 `maximo` int(11) ,
 `precio` float ,
 `dias_duracion` int(11) ,
 `noches_duracion` int(11) ,
 `dias_espera_devolucion` int(11) ,
 `f_inicio` date ,
 `f_fin` date ,
 `id_tipo_viaje` int(11) ,
 `f_registro` date ,
 `status` int(1) ,
 `tipo_viaje` varchar(45) 
)*/;

/*View structure for view listar_viajeros */

/*!50001 DROP TABLE IF EXISTS `listar_viajeros` */;
/*!50001 DROP VIEW IF EXISTS `listar_viajeros` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_viajeros` AS (select `via`.`id` AS `id`,`via`.`nombre` AS `nombre`,`via`.`a_paterno` AS `paterno`,`via`.`a_materno` AS `materno`,`via`.`sexo` AS `sexo`,`via`.`estado` AS `estado`,`via`.`edad` AS `edad`,`via`.`telefono` AS `telefono`,`via`.`correo` AS `correo`,`via`.`informacion` AS `informacion`,`via`.`id_usuario` AS `idUsuario`,`via`.`f_registro` AS `registro`,`via`.`status` AS `status`,`usus`.`usuario` AS `usuario` from (`viajeros` `via` join `usuarios` `usus` on((`usus`.`id` = `via`.`id_usuario`)))) */;

/*View structure for view listar_viajes */

/*!50001 DROP TABLE IF EXISTS `listar_viajes` */;
/*!50001 DROP VIEW IF EXISTS `listar_viajes` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_viajes` AS (select `via`.`id` AS `id`,`via`.`nombre` AS `nombre`,`via`.`descripcion` AS `descripcion`,`via`.`minimo` AS `minimo`,`via`.`maximo` AS `maximo`,`via`.`precio` AS `precio`,`via`.`dias_duracion` AS `dias_duracion`,`via`.`noches_duracion` AS `noches_duracion`,`via`.`dias_espera_devolucion` AS `dias_espera_devolucion`,`via`.`f_inicio` AS `f_inicio`,`via`.`f_fin` AS `f_fin`,`via`.`id_tipo_viaje` AS `id_tipo_viaje`,`via`.`f_registro` AS `f_registro`,`via`.`status` AS `status`,`tip_via`.`nombre` AS `tipo_viaje` from (`viajes` `via` join `tipos_viaje` `tip_via` on((`tip_via`.`id` = `via`.`id_tipo_viaje`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
