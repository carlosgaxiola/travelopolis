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

/*Table structure for table `boletos` */

DROP TABLE IF EXISTS `boletos`;

CREATE TABLE `boletos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del Boleto',
  `id_viaje` int(11) NOT NULL COMMENT 'id del viaje para boleto',
  `id_usuario` int(11) NOT NULL COMMENT 'responsable de los boletos comprado',
  `nombre` varchar(20) DEFAULT NULL COMMENT 'Nombre de la persona del boletoq',
  `a_paterno` varchar(30) DEFAULT NULL COMMENT 'Apellido Paternode la persona del boleto',
  `a_materno` varchar(30) DEFAULT NULL COMMENT 'Apellido Materno de la Persona del Boleto',
  `edad` int(11) DEFAULT NULL COMMENT 'Edad de las personas del boleto',
  `sexo` int(11) DEFAULT NULL COMMENT 'Sexo de las persona del boleto',
  `parentesco` int(11) DEFAULT NULL COMMENT '0= Usuarrio / 1=Pareja / 2=Hijo / 3=Otro',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `boletos` */

/*Table structure for table `detalle_viajes` */

DROP TABLE IF EXISTS `detalle_viajes`;

CREATE TABLE `detalle_viajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje unido a este registo',
  `id_viajero` int(11) DEFAULT NULL COMMENT 'Identificador del viajero unido a este registro',
  `cantidad` int(11) DEFAULT NULL COMMENT 'Cantidad de pasajes solicitados por el viajero',
  `resto` int(11) NOT NULL COMMENT 'El campo almacena la cantidad por pagar del detalle',
  `precio` int(11) DEFAULT NULL COMMENT 'Precio del viaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de agregacion del regisro',
  `status` int(1) DEFAULT NULL COMMENT '0= Cancelado/ 1= Datos Enviados / 2=Dio Anticipo / 3 = Liquidó / 4 = Solicitado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `detalle_viajes` */

insert  into `detalle_viajes`(`id`,`id_viaje`,`id_viajero`,`cantidad`,`resto`,`precio`,`f_registro`,`status`) values (1,1,22,1,0,2400,'2019-03-27',3),(2,1,21,1,2400,2400,'2019-03-27',1),(3,3,22,1,0,NULL,'2019-03-28',1),(4,1,1,1,0,NULL,'2019-03-30',0),(5,2,22,1,6500,6500,'2019-04-01',1),(6,2,21,1,6500,6500,'2019-04-01',0),(7,1,26,3,7200,2400,'2019-04-02',1),(9,2,26,1,6500,6500,'2019-04-02',1),(10,1,3,1,2400,2400,'2019-04-04',1);

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

insert  into `dias_viajes`(`id`,`id_viaje`,`nombre`,`descripcion`,`f_dia`,`f_registro`,`indice`) values (0,1,'1_1','Salida Al Centro de La Ciudad','2019-04-14','2019-03-30',1);

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
  `informacion` text NOT NULL,
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de la creacion del registro',
  `id_usuario` int(11) NOT NULL COMMENT 'Identificador de usuario',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `empleados` */

insert  into `empleados`(`id`,`nombre`,`a_paterno`,`a_materno`,`telefono`,`correo`,`rfc`,`nss`,`informacion`,`f_registro`,`id_usuario`,`status`) values (1,'Valeria','Altamirano','Palacios','6699129707','2016030063@upsin.edu.mx','ANV980321PAAL','70169728311','','2019-03-11',1,1),(2,'Juan','Valverde','Martinez','6693250611','2016030063@upsin.edu.mx','JURA972305vVAMA','7016928311','','2019-03-11',2,1),(3,'Carlos','Hernandez','Gaxiola','6694252565','2016030063@upsin.edu.mx','CAAL981507HEGA','7016928331','','2019-03-11',3,1),(4,'José','Lora','Peinado','6631842943','2016030063@upsin.edu.mx','JOMA982308LOPA','70169255262','','2019-03-11',4,1),(5,'Cesar','Ramirez','Luna','6392299693','2016030063@upsin.edu.mx','CEED990215RALU','7016521196','','2019-03-11',5,1);

/*Table structure for table `estados` */

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `abreviatura` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `estados` */

insert  into `estados`(`id`,`nombre`,`abreviatura`,`status`) values (1,'AGUASCALIENTES','AGS.',1),(2,'BAJA CALIFORNIA','B. C.',1),(3,'BAJA CALIFORNIA SUR','B. C. S.',1),(4,'CAMPECHE','CAMP.',1),(5,'CHIAPAS','CHIS.',1),(6,'CHIHUAHUA','CHIH.',1),(7,'CIUDAD DE MÉXICO','CDMX.',1),(8,'COAHUILA DE ZARAGOZA','COAH.',1),(9,'COLIMA','COL.',1),(10,'DURANGO','DGO.',1),(11,'GUANAJUATO','GTO.',1),(12,'GUERRERO','GRO.',1),(13,'HIDALGO','HGO.',1),(14,'JALISCO','JAL.',1),(15,'MÉXICO','MÉX.',1),(16,'MICHOACÁN DE OCAMPO','MICH.',1),(17,'MORELOS','MOR.',1),(18,'NAYARIT','NAY.',1),(19,'NUEVO LEÓN','N. L.',1),(20,'OAXACA','OAX.',1),(21,'PUEBLA','PUE.',1),(22,'QUERÉTARO DE ARTEAGA','QRO.',1),(23,'QUINTANA ROO','Q. R.',1),(24,'SAN LUIS POTOSÍ','S. L. P.',1),(25,'SINALOA','SIN.',1),(26,'SONORA','SON.',1),(27,'TABASCO','TAB.',1),(28,'TAMAULIPAS','TAMPS.',1),(29,'TLAXCALA','TLAX.',1),(30,'VERACRUZ DE IGNACIO DE LA LLAVE','VER.',1),(31,'YUCATÁN','YUC.',1),(32,'ZACATECAS','ZAC.',1),(33,'EXTRANJERO','EXT.',1);

/*Table structure for table `guias_viajes` */

DROP TABLE IF EXISTS `guias_viajes`;

CREATE TABLE `guias_viajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_guia` int(11) DEFAULT NULL COMMENT 'Identificador del guia',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `guias_viajes` */

insert  into `guias_viajes`(`id`,`id_guia`,`id_viaje`) values (8,4,2),(9,4,3),(13,4,1);

/*Table structure for table `mensajes_grupos` */

DROP TABLE IF EXISTS `mensajes_grupos`;

CREATE TABLE `mensajes_grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_remitente` int(11) DEFAULT NULL COMMENT 'Identifiacador del usuario remitente del mensaje',
  `nombre_remitente` varchar(100) DEFAULT NULL COMMENT 'Nombre de quien envió el mensaje',
  `id_grupo_destinatario` int(11) DEFAULT NULL COMMENT 'Identificador del grupo destinatario del mensaje',
  `id_nivel` int(11) DEFAULT NULL COMMENT 'Nivel de Representación de Usuarios 1-Viajeros, 2-Guia',
  `cuerpo` longtext COMMENT 'Cuerpo del mensaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha del registro del mensaje',
  `h_registro` time DEFAULT NULL COMMENT 'Hora del registro del mensaje',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

/*Data for the table `mensajes_grupos` */

insert  into `mensajes_grupos`(`id`,`id_remitente`,`nombre_remitente`,`id_grupo_destinatario`,`id_nivel`,`cuerpo`,`f_registro`,`h_registro`) values (1,1,'Jose Manuel Lora',1,2,'Lora Peindo Jose Manuel','2019-03-27',NULL),(2,22,'Jose Manuel Lora',1,3,'sdfsdf','2019-03-28','02:29:46'),(3,22,'Jose Manuel Lora',1,3,'sdfsdfsdfsdf','2019-03-28','05:00:00'),(4,22,'Carlitos Gaxiola',1,3,'asasdasdasdasd','2019-03-28','12:00:00'),(26,22,'d',1,3,'d','2019-03-28','05:52:40'),(27,22,'d',2,3,'d','2019-03-28','05:56:05'),(35,22,'Jose Manuel',1,3,'megalora98','2019-03-28','06:04:26'),(36,22,'Jose Manuel',1,3,'lora','2019-03-28','06:05:44'),(37,22,'Jose Manuel',1,3,'Lora','2019-03-28','06:10:42'),(38,22,'Jose Manuel',1,3,'lora','2019-03-28','13:13:30'),(39,22,'Jose Manuel',1,3,'megalora98','2019-03-28','13:13:55'),(40,22,'Jose Manuel',1,3,'peinado','2019-03-28','13:14:52'),(41,22,'Jose Manuel',1,3,'Lora Peinado','2019-03-28','15:44:36'),(42,22,'Jose Manuel',1,3,'lora','2019-03-28','15:44:45'),(43,22,'Ira pues',1,3,'Que onda raza','2019-03-28','15:56:14'),(45,22,'Ira pues',1,3,'hola','2019-03-28','15:58:08'),(46,22,'Jose Manuel',1,3,'Lora','2019-03-29','01:19:26'),(47,22,'Jose Manuel',1,3,'lora','2019-03-29','01:37:35'),(48,22,'Jose Manuel',1,3,'perinafo','2019-03-29','01:37:42'),(49,22,'Jose Manuel',1,3,'lora','2019-03-29','02:22:12'),(50,22,'Jose Manuel',1,3,'lololo','2019-03-29','02:22:28'),(51,22,'Jose Manuel',2,3,'manuel','2019-03-29','02:32:35'),(52,22,'Jose Manuel',1,3,'que onda','2019-03-29','02:40:00'),(53,22,'Jose Manuel',1,3,'hola','2019-03-29','13:13:54'),(54,22,'Jose Manuel',1,3,'hola','2019-03-29','13:15:47'),(55,22,'Jose Manuel',1,3,'lora','2019-03-29','22:21:25'),(56,22,'Jose Manuel',1,3,'lora','2019-03-29','22:54:08'),(57,22,'Jose Manuel',1,3,'madres','2019-03-29','23:18:10'),(58,22,'2',2,3,'Ultimo Mensaje','2019-03-29','23:22:00'),(59,22,'Jose Manuel',1,3,'lora','2019-03-29','23:33:21'),(60,22,'Jose Manuel',1,3,'manuel','2019-03-29','23:41:47'),(61,22,'Jose Manuel',1,3,'lora','2019-03-29','23:42:04'),(62,22,'Jose Manuel',1,3,'kose','2019-03-29','23:42:16'),(63,22,'Jose Manuel',1,3,'manuel','2019-03-29','23:42:40'),(64,22,'Jose Manuel',1,3,'manuel','2019-03-29','23:46:43'),(65,22,'Jose Manuel',1,3,'lora','2019-03-29','23:51:55'),(66,22,'Jose Manuel',1,3,'manuel','2019-03-29','23:55:38'),(67,22,'Jose Manuel',1,3,'lora','2019-03-30','00:07:40'),(68,22,'Jose Manuel',1,3,'lora','2019-03-30','00:12:05'),(69,22,'Jose Manuel',1,3,'manuel','2019-03-30','00:20:33'),(70,22,'Jose Manuel',1,3,'lora','2019-03-30','00:44:38'),(71,22,'Jose Manuel',1,3,'manuel','2019-03-30','00:56:32'),(72,22,'Jose Manuel',1,3,'lora','2019-03-30','01:24:24'),(73,22,'Jose Manuel',1,3,'manuel','2019-03-30','01:26:13'),(74,22,'Jose Manuel',1,3,'Ahora sí jala :\'v','2019-03-30','02:22:08'),(75,22,'Jose Manuel',1,3,'haber','2019-03-30','03:20:06'),(76,22,'Jose Manuel',1,3,'hola','2019-03-30','09:50:36'),(77,22,'Jose Manuel',1,3,'vas a venir morra?','2019-03-30','09:50:46'),(78,22,'Jose Manuel',1,3,'lora','2019-03-30','11:20:27'),(79,21,'Ira pues',1,3,'lora','2019-03-30','11:20:44'),(80,22,'Jose Manuel',1,3,'.','2019-03-30','11:21:11'),(81,22,'Jose Manuel',1,3,'lo','2019-03-30','11:21:51'),(82,21,'Ira pues',1,3,'lora','2019-03-30','11:22:27'),(83,21,'Ira pues',1,3,'fg','2019-03-30','11:22:35'),(84,22,'Jose Manuel',1,3,'que royo','2019-03-30','12:12:33'),(85,1,'Linda',1,2,'Lora','2019-03-30','14:25:38'),(86,22,'Jose Manuel',1,3,'lora','2019-03-30','21:46:20'),(87,22,'Jose Manuel',1,3,'manuel','2019-03-31','02:55:12'),(88,22,'Jose Manuel',1,3,'lora','2019-03-31','02:55:23'),(89,22,'Jose Manuel',1,3,'lora','2019-03-31','02:56:01'),(90,22,'Jose Manuel',1,3,'lora','2019-03-31','02:56:41'),(91,22,'Jose Manuel',1,3,'manuel','2019-03-31','02:56:48'),(92,22,'Jose Manuel',1,3,'msl','2019-03-31','02:56:57'),(93,22,'Jose Manuel',1,3,'lora','2019-03-31','02:57:42'),(94,22,'Jose Manuel',1,3,'manuel','2019-03-31','02:57:57'),(95,22,'Jose Manuel',1,3,'lora','2019-03-31','02:58:03'),(96,22,'Jose Manuel',1,3,'lora','2019-03-31','02:58:10'),(97,22,'Jose Manuel',1,3,'manuel','2019-03-31','02:58:56'),(98,22,'Jose Manuel',1,3,'m','2019-03-31','02:59:07'),(99,22,'Jose Manuel',1,3,'kd','2019-03-31','02:59:38'),(100,22,'Jose Manuel',1,3,'l','2019-03-31','03:00:18'),(101,22,'Jose Manuel',1,3,'a','2019-03-31','03:00:40'),(102,22,'Jose Manuel',1,3,'lora','2019-03-31','03:07:46'),(103,22,'Jose Manuel',1,3,'lora','2019-03-31','03:10:08'),(104,22,'Jose Manuel',1,3,'ñora','2019-03-31','03:11:07'),(105,22,'Jose Manuel',1,3,'lora','2019-03-31','03:11:40'),(106,22,'Jose Manuel',1,3,'lora','2019-03-31','03:12:48'),(107,22,'Jose Manuel',1,3,'lora','2019-03-31','03:26:54'),(108,22,'Jose Manuel',1,3,'manuel','2019-03-31','03:27:09'),(109,22,'Jose Manuel',1,3,'que onda raza','2019-03-31','03:27:31'),(110,1,'Linda',1,2,'que onda raza','2019-03-31','13:37:40'),(111,1,'Linda',1,2,'hola','2019-03-31','13:58:40'),(112,1,'Linda',1,2,'que royo','2019-03-31','14:13:07'),(113,1,'Linda',1,2,'q','2019-03-31','14:13:29'),(114,1,'Linda',1,2,'f','2019-03-31','14:13:41'),(115,1,'Linda',1,2,'j','2019-03-31','14:13:52'),(116,1,'Linda',1,2,'u','2019-03-31','14:14:00'),(117,1,'Linda',1,2,'i','2019-03-31','14:14:31'),(118,1,'Linda',1,2,'j','2019-03-31','14:14:35'),(119,1,'Linda',1,2,'g','2019-03-31','14:14:39'),(120,22,'Jose Manuel',1,3,'lora','2019-03-31','14:15:11'),(121,1,'Linda',1,2,'l','2019-03-31','14:16:10'),(122,1,'Linda',1,2,'l','2019-03-31','14:16:27'),(123,22,'Jose Manuel',1,3,'lora','2019-03-31','17:33:01'),(124,22,'Jose Manuel',1,3,'lora','2019-03-31','17:33:51'),(125,22,'Jose Manuel',1,3,'lora','2019-03-31','17:35:57'),(126,22,'Jose Manuel',1,3,'lora','2019-03-31','17:37:39'),(127,22,'Jose Manuel',1,3,'manuel','2019-03-31','17:37:48'),(128,22,'Jose Manuel',1,3,'lora','2019-03-31','17:42:05'),(129,22,'Jose Manuel',1,3,'irá pues ','2019-03-31','17:42:18'),(130,22,'Jose Manuel',1,3,'hola','2019-04-01','15:06:28'),(131,22,'Jose Manuel',1,3,'sf','2019-04-01','15:06:49'),(132,22,'Jose Manuel',1,3,'hola','2019-04-01','15:07:03'),(133,22,'Jose Manuel',1,3,'ey','2019-04-01','15:07:27'),(134,22,'Jose Manuel',1,3,'hola','2019-04-01','15:07:39'),(135,22,'Jose Manuel',1,3,'hola','2019-04-01','15:07:55'),(136,22,'Jose Manuel',1,3,'vañzita','2019-04-01','15:08:13'),(137,1,'Linda',1,2,'hola chicos','2019-04-01','15:11:28'),(138,1,'Linda',1,2,'lora','2019-04-01','15:15:59'),(139,1,'Linda',1,2,'l','2019-04-01','15:16:35'),(140,22,'Jose Manuel',1,3,'kiubo','2019-04-01','15:18:09'),(141,22,'Jose Manuel',1,3,'hoña raza','2019-04-01','15:19:26'),(142,22,'Jose Manuel',1,3,'hola','2019-04-01','15:21:38'),(143,22,'Jose Manuel',1,3,'hola','2019-04-01','15:21:49'),(144,22,'Jose Manuel',1,3,'mande','2019-04-01','15:21:57'),(145,22,'Jose Manuel',1,3,'hola','2019-04-01','15:22:22'),(146,22,'Jose Manuel',1,3,'amigos','2019-04-01','15:22:25'),(147,22,'Jose Manuel',1,3,'respondan','2019-04-01','15:22:26'),(148,22,'Jose Manuel',1,3,'lora','2019-04-01','16:56:35'),(149,1,'Linda',1,2,' lora','2019-04-01','16:56:51'),(150,1,'Linda',1,2,' hola chiculillos','2019-04-02','15:36:04'),(151,1,'Linda',1,2,'quebpedro?','2019-04-02','15:36:18'),(152,26,'lora',1,3,'lora','2019-04-02','15:36:32'),(153,1,'Linda',1,2,'alo?','2019-04-02','15:36:45'),(154,NULL,NULL,NULL,NULL,NULL,'2019-04-02','15:46:04'),(155,26,'lora',1,3,'lora','2019-04-02','15:47:19'),(156,1,'Linda',1,2,',l','2019-04-02','15:47:33'),(157,1,'Linda',1,2,'gg','2019-04-02','15:47:46'),(158,26,'lora',1,3,'l','2019-04-02','15:47:54'),(159,NULL,NULL,NULL,NULL,NULL,'2019-04-02','15:53:05'),(160,26,'lora',1,3,'lora','2019-04-02','15:53:14'),(161,26,'lora',1,3,'lora','2019-04-02','15:53:22'),(162,NULL,NULL,NULL,NULL,NULL,'2019-04-02','15:53:33'),(163,26,'Lora',1,1,'lora','2019-04-02','15:55:19'),(164,26,'lora',1,3,'lora','2019-04-02','15:59:09'),(165,26,'lora',1,3,'lora','2019-04-02','16:05:52'),(166,26,'lora',1,3,'que royo','2019-04-02','16:06:09'),(167,1,'Linda',1,2,'lora','2019-04-02','16:06:20'),(168,22,'Jose Manuel',1,3,'lora','2019-04-02','16:07:10'),(169,1,'Linda',1,2,'lora','2019-04-02','16:08:18'),(170,22,'Jose Manuel',1,3,'manuel','2019-04-02','16:09:18'),(171,22,'Jose Manuel',1,3,'anuel','2019-04-02','16:09:48'),(172,22,'Jose Manuel',1,3,'lors','2019-04-02','16:10:09'),(173,1,'Linda',1,2,' h','2019-04-02','16:10:26'),(174,22,'Jose Manuel',1,3,'que onda','2019-04-02','16:12:36'),(175,1,'Linda',1,2,'que onda','2019-04-02','16:12:48'),(176,22,'Jose Manuel',1,3,'lora','2019-04-02','16:19:23'),(177,1,'Linda',1,2,'vale','2019-04-02','16:19:47'),(178,22,'Jose Manuel',1,3,'eyy','2019-04-02','16:20:08'),(179,22,'Jose Manuel',1,3,'lora','2019-04-02','16:21:33'),(180,26,'lora',1,3,'lora','2019-04-02','16:31:46');

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
  `index` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `modulos` */

insert  into `modulos`(`id`,`nombre`,`descripcion`,`ruta`,`fa_icon`,`index`,`status`) values (1,'Inicio','Explora los viajes y tambien crea tu usuario','inicio','fas fa-home',9,1),(2,'Modulos','Modulo para ver los modulos','admin/Modulos','fas fa-puzzle-piece',8,1),(3,'Viajeros','Ver listado de viajeros','admin/Viajeros','far fa-user',3,1),(4,'Viajes','Agregar, editar, eliminar y ver registro de viajes','admin/Viajes','fas fa-plane',4,1),(5,'Perfiles','Ver, editar y cambiar permisos de perfiles','admin/Perfiles','fas fa-side-head',8,1),(6,'Guias','Agregar, editar, eliminar y listar guias','admin/Guias','fas fa-file-user',6,1),(7,'Administradores','Agregar, editar, eliminar y listar administradores','admin/Administradores','fas fa-user-cog',2,1),(8,'Mi Perfil','Ver datos de mi perfil de usuario','perfil','fas fa-user',20,1),(9,'Inicio Administrador','Inicio de administrador','administrar','fas fa-cogs',1,1),(10,'Asignar Guias','Asigna guias a un nuevo viaje','admin/asignar','fas fa-map',2,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `perfiles_modulos` */

insert  into `perfiles_modulos`(`id`,`id_perfil`,`id_modulo`,`f_registro`,`status`) values (16,1,2,NULL,NULL),(17,1,3,NULL,NULL),(18,1,4,NULL,NULL),(19,1,5,NULL,NULL),(20,1,6,NULL,NULL),(21,1,9,NULL,NULL),(22,1,10,NULL,NULL);

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

insert  into `tipos_viaje`(`id`,`nombre`,`f_registro`,`status`) values (1,'Playero','2019-03-26',1),(2,'Natural','2019-03-26',1),(5,'Arqueologico','2019-03-26',1),(6,'Pueblo','2019-04-01',1),(7,'Cabaña','2019-04-01',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`usuario`,`contraseña`,`id_perfil`,`f_registro`,`token`,`status`) values (1,'Valeria','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11',NULL,1),(2,'Juan','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11','',1),(3,'Carlos','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1,'2019-03-11','',1),(4,'Lora','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',2,'2019-03-11','',1),(5,'Cesar','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',2,'2019-03-11','',1),(6,'Linda','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',2,'2019-03-11','dlSuq3ykAPE:APA91bEWsRfDkJXpFy5--NE78TpLIQpDOYV7Sg0-L2sjfgEuGOxfMrBGAB8REX5efS0d2hkKrwfQJUGKb3aFMZIiiiRcbn5R0ntK9nHdfQDRV0n6PTlFEyVkgXJy7rUR453SD_-aKWIA',1),(7,'Kimiko','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,'2019-03-11',NULL,1),(8,'inda','c2325b478dfeef64a3088ea3f8f0c0f284173a91',3,'2019-03-11','',1),(9,'joma1998','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,'2019-03-12',NULL,1),(10,'valeverga','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,NULL,'raza',NULL),(16,'lora','Lora',3,'0000-00-00',NULL,1),(17,'Verga1','Verga2',3,'2019-03-24',NULL,1),(18,'lachingada','Verga2',3,'2019-03-24',NULL,1),(19,'Jose Manuel Lora Peinado','Vale Madre',3,'2019-03-24',NULL,1),(20,'joma1998','Vale Madre',3,'2019-03-24',NULL,1),(22,'bernalputo','Vale Madre',3,'2019-03-24',NULL,1),(23,'nommes','Vale Madre',3,'2019-03-25',NULL,1),(24,'nommesss','Vale Madre',1,'2019-03-25',NULL,1),(25,'manuel','manuel',3,'2019-03-25',NULL,1),(26,'joma1999','bsndjd',3,'2019-03-25',NULL,1),(27,'prueba','123',4,'2019-03-25',NULL,1),(28,'corola','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,'2019-03-25',NULL,1),(29,'lorapeinado123','25b99bacd5f00970e7f5003b4463b2456c22f73c',3,'2019-03-27','d00cd6iPsfo:APA91bHSCSGgf-BLqgzCOWe4MmOhxPxEx2vhsUTpMLHtF65eP-0L469oquUy4LtztC_PQRGad_S6RGiTcVGALPBlY5rHGuvirrpyHtD2ad5sFCdp3U4PrnbqBH65F1AJ41ooUo7aM6Cz',1),(30,'123','40bd001563085fc35165329ea1ff5c5ecbdbbeef',3,'2019-03-30',NULL,1),(31,'esclavo','7867bbfc530cdcfe5fdef94bad937f27431ed986',3,'2019-04-01',NULL,1),(32,'lorita','7867bbfc530cdcfe5fdef94bad937f27431ed986',3,'2019-04-01',NULL,1),(33,'juanitolocosns','e3566fedd1832efe11ea8be26094b84ee16556f8',3,'2019-04-01',NULL,1),(34,'juanitolocosnsas','e3566fedd1832efe11ea8be26094b84ee16556f8',3,'2019-04-01',NULL,1),(35,'vale','7867bbfc530cdcfe5fdef94bad937f27431ed986',3,'2019-04-01',NULL,1),(36,'familiares','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',3,'2019-04-02','dfz2fnPlwDw:APA91bH_cTgQcbhHmp7YzPI3v2RzMAjSL_Z81AkXXxY7XgB1g0Rq5BTCzgmjwpl1OONj5Ev5ooccZZTUQ_CpqK9IySpKVJlrVZB3q-h3Xm_49L8KtfFZOaYqmDIIQo4pquzb6kil-rMI',1),(37,NULL,NULL,3,'2019-04-02',NULL,1);

/*Table structure for table `viajeros` */

DROP TABLE IF EXISTS `viajeros`;

CREATE TABLE `viajeros` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del viajero',
  `a_paterno` varchar(100) DEFAULT NULL COMMENT 'Apellido materno del viajero',
  `a_materno` varchar(100) DEFAULT NULL COMMENT 'Apellido paterno del viajero',
  `sexo` varchar(10) DEFAULT NULL COMMENT 'Sexo del Viajero',
  `edad` int(11) DEFAULT NULL COMMENT 'Edad del Viajero',
  `estado` varchar(100) DEFAULT NULL COMMENT 'Estado donde reside el viajero',
  `telefono` varchar(15) DEFAULT NULL COMMENT 'Número de telefono del viajero',
  `correo` varchar(30) DEFAULT NULL COMMENT 'Correo del viajero registrado',
  `informacion` varchar(500) DEFAULT NULL COMMENT 'Informacion sobre el usuario',
  `id_usuario` int(11) DEFAULT NULL COMMENT 'Idenficador del usuario de este registro de viajero',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro',
  `status` int(11) DEFAULT NULL COMMENT '0) inactivo 1) activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `viajeros` */

insert  into `viajeros`(`id`,`nombre`,`a_paterno`,`a_materno`,`sexo`,`edad`,`estado`,`telefono`,`correo`,`informacion`,`id_usuario`,`f_registro`,`status`) values (1,'Linda','German','Torres',NULL,NULL,NULL,'6699276707','2016030023@upsin.edu.mx',NULL,6,'2019-03-11',1),(2,'Alejandro','Castro','Aviles',NULL,NULL,NULL,'6691002599','2016030063@upsin.edu.mx',NULL,7,'2019-03-11',1),(3,'Armando','Inda','Mellado',NULL,NULL,NULL,'6692276707','2016030023@upsin.edu.mx',NULL,8,'2019-03-11',1),(4,'LORa','PEINADO','JOSE',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL),(5,'$nombre','$apellido_p','$apellido_m',NULL,NULL,NULL,'$telefono','$correo',NULL,0,'0000-00-00',0),(6,'LORA','LORA','LORA',NULL,NULL,NULL,'LORA','LORA',NULL,1,'0000-00-00',1),(7,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,4,'2019-03-24',1),(8,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,NULL,'2019-03-24',1),(9,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,NULL,'2019-03-24',1),(10,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,NULL,'2019-03-24',1),(11,'Yeah','Perdonen','kamehameha',NULL,NULL,NULL,'101010101','Vieneeldragonballrap',NULL,18,'2019-03-24',1),(12,'Yeah','1','1',NULL,NULL,NULL,'1','1',NULL,19,'2019-03-24',1),(13,'Yeah','1','1',NULL,NULL,NULL,'1','1',NULL,9,'2019-03-24',1),(14,'Yeah','1','1',NULL,NULL,NULL,'1','1',NULL,9,'2019-03-24',1),(15,'Yeah','1','1',NULL,NULL,NULL,'1','1',NULL,22,'2019-03-24',1),(16,'Yeah','1','1','HOMBRE',NULL,'Sinaloa','1','1','LORA',23,'2019-03-25',1),(17,'Yeah','1','1','HOMBRE',10,'Sinaloa','1','1','LORA',24,'2019-03-25',1),(18,'manuel','manuel','manuel','HOMBRE',10,'México','919764','manuel','manuel',25,'2019-03-25',1),(19,'jdnfjd','jsjdjd','jdjddj','MUJER',18,'Colima','676734','hshdhs','hsjdnd',26,'2019-03-25',1),(20,'soy','una','prueba','MUJER',20000000,'Guanajuato','239','hola','prueba soy?',27,'2019-03-25',1),(21,'Ira pues','andale','noteme','HOMBRE',10,'Baja California Sur','9863548','joma1998@hotmail.com','lora',28,'2019-03-25',1),(22,'Jose Manuel','Lora','Peinado','HOMBRE',20,'Sinaloa','9863548','joma1998@hotmail.com','Espero poder pasar',29,'2019-03-27',1),(23,'Prueba','Prueba','Prueba','HOMBRE',10,'Sinaloa','6631348554','joma1998@hotmail.com','valgo madre',30,'2019-03-30',1),(24,'Miguel Mancera','Lopez','Perez','HOMBRE',10,'Hidalgo','9863648','lora@jmail.com','me gustaroa pasar',31,'2019-04-01',1),(25,'lora','lora','lora','HOMBRE',45,'Morelos','9863589','joma1999@hotmail.com','lora',35,'2019-04-01',1),(26,'lora','lora','lora','HOMBRE',57,'Colima','9863548','manuel1999@hotmail.com','manuellll',36,'2019-04-02',1),(27,'Ana',NULL,NULL,NULL,23,NULL,'9863548',NULL,NULL,NULL,'2019-04-02',1);

/*Table structure for table `viajeros_familiares` */

DROP TABLE IF EXISTS `viajeros_familiares`;

CREATE TABLE `viajeros_familiares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_viaje` int(11) DEFAULT NULL,
  `id_viajero` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_p` varchar(100) DEFAULT NULL,
  `apellido_m` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `tipo_familiar` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `viajeros_familiares` */

insert  into `viajeros_familiares`(`id`,`id_viaje`,`id_viajero`,`nombre`,`apellido_p`,`apellido_m`,`edad`,`telefono`,`tipo_familiar`,`status`) values (1,1,26,'Ana','Beltran','Leyva',29,'6699201877','Esposa',1),(2,1,26,'SIN NOMBRE','SIN APELLIDO P','SIN APELLIDO M',0,'SIN TELEFONO','SIN TIPO FAMILIAR',1);

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
  `id_tipo_viaje` int(11) DEFAULT NULL COMMENT 'Url relativa al sitio donde se almacena una imagen de muestra para el viaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del viaje',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del viaje (0 Inactivo, 1 reclutando, 2 lleno, 3 realizado, 4 en curso)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `viajes` */

insert  into `viajes`(`id`,`nombre`,`descripcion`,`minimo`,`maximo`,`precio`,`dias_duracion`,`noches_duracion`,`dias_espera_devolucion`,`f_inicio`,`f_fin`,`id_tipo_viaje`,`f_registro`,`status`) values (1,'Primavera Invernal','Viaje por Mazamitla en la primavera, y paseo al parque de diversiones',30,42,2400,3,2,30,'2019-04-26','2019-04-28',1,'2019-03-11',4),(2,'Playopolis','Viaje por Cancún visitando sus hermosas playas y hospedaje en un hotel de 3 estrellas.',30,42,6500,4,3,30,'2019-07-19','2019-07-22',2,'2019-03-11',1),(3,'Viaje Magico','Viaje por Guanajuato visitando sus hermosas ruinas y saludando sus momias.hola.',30,42,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,0);

/*Table structure for table `viajes_destacados` */

DROP TABLE IF EXISTS `viajes_destacados`;

CREATE TABLE `viajes_destacados` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje marcado como favorito',
  `id_viajero` int(11) DEFAULT NULL COMMENT 'Identificador del viajero que marco el viaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del registro (1 Marcado, 0 No Marcado)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `viajes_destacados` */

insert  into `viajes_destacados`(`id`,`id_viaje`,`id_viajero`,`f_registro`,`status`) values (1,1,22,'2019-03-30',1),(2,2,22,'2019-03-30',1),(3,1,21,'2019-04-01',1),(4,2,26,'2019-04-02',1);

/*Table structure for table `listar_detalle_viaje` */

DROP TABLE IF EXISTS `listar_detalle_viaje`;

/*!50001 DROP VIEW IF EXISTS `listar_detalle_viaje` */;
/*!50001 DROP TABLE IF EXISTS `listar_detalle_viaje` */;

/*!50001 CREATE TABLE  `listar_detalle_viaje`(
 `id` int(11) ,
 `nombre` varchar(100) ,
 `a_paterno` varchar(100) ,
 `a_materno` varchar(100) ,
 `sexo` varchar(10) ,
 `edad` int(11) ,
 `estado` varchar(100) ,
 `telefono` varchar(15) ,
 `correo` varchar(30) ,
 `informacion` varchar(500) ,
 `id_usuario` int(11) ,
 `f_registro` date ,
 `status` int(1) ,
 `cantidad` int(11) ,
 `resto` int(11) ,
 `viaje` varchar(100) ,
 `id_viaje` int(11) 
)*/;

/*Table structure for table `listar_guias` */

DROP TABLE IF EXISTS `listar_guias`;

/*!50001 DROP VIEW IF EXISTS `listar_guias` */;
/*!50001 DROP TABLE IF EXISTS `listar_guias` */;

/*!50001 CREATE TABLE  `listar_guias`(
 `id` int(11) ,
 `nombre` varchar(45) ,
 `a_paterno` varchar(45) ,
 `a_materno` varchar(45) ,
 `telefono` varchar(15) ,
 `correo` varchar(30) ,
 `rfc` varchar(100) ,
 `nss` varchar(100) ,
 `informacion` text ,
 `f_registro` date ,
 `id_usuario` int(11) ,
 `status` int(11) 
)*/;

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

/*Table structure for table `listar_viajes_guias` */

DROP TABLE IF EXISTS `listar_viajes_guias`;

/*!50001 DROP VIEW IF EXISTS `listar_viajes_guias` */;
/*!50001 DROP TABLE IF EXISTS `listar_viajes_guias` */;

/*!50001 CREATE TABLE  `listar_viajes_guias`(
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
 `id_guia` int(11) ,
 `guia` varchar(137) 
)*/;

/*View structure for view listar_detalle_viaje */

/*!50001 DROP TABLE IF EXISTS `listar_detalle_viaje` */;
/*!50001 DROP VIEW IF EXISTS `listar_detalle_viaje` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_detalle_viaje` AS (select `cli`.`id` AS `id`,`cli`.`nombre` AS `nombre`,`cli`.`a_paterno` AS `a_paterno`,`cli`.`a_materno` AS `a_materno`,`cli`.`sexo` AS `sexo`,`cli`.`edad` AS `edad`,`cli`.`estado` AS `estado`,`cli`.`telefono` AS `telefono`,`cli`.`correo` AS `correo`,`cli`.`informacion` AS `informacion`,`cli`.`id_usuario` AS `id_usuario`,`cli`.`f_registro` AS `f_registro`,`det`.`status` AS `status`,`det`.`cantidad` AS `cantidad`,`det`.`resto` AS `resto`,`via`.`nombre` AS `viaje`,`via`.`id` AS `id_viaje` from ((`viajeros` `cli` join `detalle_viajes` `det` on((`cli`.`id` = `det`.`id_viajero`))) join `viajes` `via` on((`via`.`id` = `det`.`id_viaje`)))) */;

/*View structure for view listar_guias */

/*!50001 DROP TABLE IF EXISTS `listar_guias` */;
/*!50001 DROP VIEW IF EXISTS `listar_guias` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_guias` AS (select `emp`.`id` AS `id`,`emp`.`nombre` AS `nombre`,`emp`.`a_paterno` AS `a_paterno`,`emp`.`a_materno` AS `a_materno`,`emp`.`telefono` AS `telefono`,`emp`.`correo` AS `correo`,`emp`.`rfc` AS `rfc`,`emp`.`nss` AS `nss`,`emp`.`informacion` AS `informacion`,`emp`.`f_registro` AS `f_registro`,`emp`.`id_usuario` AS `id_usuario`,`emp`.`status` AS `status` from ((`empleados` `emp` join `usuarios` `usu` on((`usu`.`id` = `emp`.`id_usuario`))) join `perfiles` `per` on((`per`.`id` = `usu`.`id_perfil`))) where (`per`.`nombre` = 'guia')) */;

/*View structure for view listar_viajeros */

/*!50001 DROP TABLE IF EXISTS `listar_viajeros` */;
/*!50001 DROP VIEW IF EXISTS `listar_viajeros` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_viajeros` AS (select `via`.`id` AS `id`,`via`.`nombre` AS `nombre`,`via`.`a_paterno` AS `paterno`,`via`.`a_materno` AS `materno`,`via`.`sexo` AS `sexo`,`via`.`estado` AS `estado`,`via`.`edad` AS `edad`,`via`.`telefono` AS `telefono`,`via`.`correo` AS `correo`,`via`.`informacion` AS `informacion`,`via`.`id_usuario` AS `idUsuario`,`via`.`f_registro` AS `registro`,`via`.`status` AS `status`,`usus`.`usuario` AS `usuario` from (`viajeros` `via` join `usuarios` `usus` on((`usus`.`id` = `via`.`id_usuario`)))) */;

/*View structure for view listar_viajes */

/*!50001 DROP TABLE IF EXISTS `listar_viajes` */;
/*!50001 DROP VIEW IF EXISTS `listar_viajes` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_viajes` AS (select `via`.`id` AS `id`,`via`.`nombre` AS `nombre`,`via`.`descripcion` AS `descripcion`,`via`.`minimo` AS `minimo`,`via`.`maximo` AS `maximo`,`via`.`precio` AS `precio`,`via`.`dias_duracion` AS `dias_duracion`,`via`.`noches_duracion` AS `noches_duracion`,`via`.`dias_espera_devolucion` AS `dias_espera_devolucion`,`via`.`f_inicio` AS `f_inicio`,`via`.`f_fin` AS `f_fin`,`via`.`id_tipo_viaje` AS `id_tipo_viaje`,`via`.`f_registro` AS `f_registro`,`via`.`status` AS `status`,`tipo`.`nombre` AS `tipo_viaje` from (`viajes` `via` join `tipos_viaje` `tipo` on((`tipo`.`id` = `via`.`id_tipo_viaje`)))) */;

/*View structure for view listar_viajes_guias */

/*!50001 DROP TABLE IF EXISTS `listar_viajes_guias` */;
/*!50001 DROP VIEW IF EXISTS `listar_viajes_guias` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_viajes_guias` AS (select `via`.`id` AS `id`,`via`.`nombre` AS `nombre`,`via`.`descripcion` AS `descripcion`,`via`.`minimo` AS `minimo`,`via`.`maximo` AS `maximo`,`via`.`precio` AS `precio`,`via`.`dias_duracion` AS `dias_duracion`,`via`.`noches_duracion` AS `noches_duracion`,`via`.`dias_espera_devolucion` AS `dias_espera_devolucion`,`via`.`f_inicio` AS `f_inicio`,`via`.`f_fin` AS `f_fin`,`via`.`id_tipo_viaje` AS `id_tipo_viaje`,`via`.`f_registro` AS `f_registro`,`via`.`status` AS `status`,`gv`.`id_guia` AS `id_guia`,(select concat(`emp`.`nombre`,' ',`emp`.`a_paterno`,' ',`emp`.`a_materno`) from `empleados` `emp` where (`emp`.`id` = `gv`.`id_guia`)) AS `guia` from (`viajes` `via` left join `guias_viajes` `gv` on((`gv`.`id_viaje` = `via`.`id`))) where (`via`.`status` > 0)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
