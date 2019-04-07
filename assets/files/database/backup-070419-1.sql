-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2019 a las 23:26:00
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `travelopolis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletos`
--

CREATE TABLE `boletos` (
  `id` int(11) NOT NULL COMMENT 'Id del Boleto',
  `id_viaje` int(11) NOT NULL COMMENT 'id del viaje para boleto',
  `id_usuario` int(11) NOT NULL COMMENT 'responsable de los boletos comprado',
  `nombre` varchar(20) DEFAULT NULL COMMENT 'Nombre de la persona del boletoq',
  `a_paterno` varchar(30) DEFAULT NULL COMMENT 'Apellido Paternode la persona del boleto',
  `a_materno` varchar(30) DEFAULT NULL COMMENT 'Apellido Materno de la Persona del Boleto',
  `edad` int(11) DEFAULT NULL COMMENT 'Edad de las personas del boleto',
  `sexo` int(11) DEFAULT NULL COMMENT 'Sexo de las persona del boleto',
  `parentesco` int(11) DEFAULT NULL COMMENT '0= Usuarrio / 1=Pareja / 2=Hijo / 3=Otro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_viajes`
--

CREATE TABLE `detalle_viajes` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje unido a este registo',
  `id_viajero` int(11) DEFAULT NULL COMMENT 'Identificador del viajero unido a este registro',
  `cantidad` int(11) DEFAULT NULL COMMENT 'Cantidad de pasajes solicitados por el viajero',
  `resto` int(11) NOT NULL COMMENT 'El campo almacena la cantidad por pagar del detalle',
  `precio` int(11) DEFAULT NULL COMMENT 'Precio del viaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de agregacion del regisro',
  `status` int(1) DEFAULT NULL COMMENT '0= Cancelado/ 1= Datos Enviados / 2=Dio Anticipo / 3 = Liquidó / 4 = Solicitado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_viajes`
--

INSERT INTO `detalle_viajes` (`id`, `id_viaje`, `id_viajero`, `cantidad`, `resto`, `precio`, `f_registro`, `status`) VALUES
(23, 1, 26, 3, 7200, NULL, '2019-04-06', 4),
(24, 2, 22, 1, 6500, NULL, '2019-04-06', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_viajes`
--

CREATE TABLE `dias_viajes` (
  `id` int(11) NOT NULL COMMENT 'Identifica el registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identifica el registro del viaje padre de este regisstro',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del dia, este campo es unico por cada id_viaje',
  `descripcion` text COMMENT 'Describe el dia del viaje',
  `f_dia` date DEFAULT NULL COMMENT 'Fecha de ocurrencia de dia',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del dia',
  `indice` int(11) DEFAULT NULL COMMENT 'Indice del dia en el itinerario del viaje'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dias_viajes`
--

INSERT INTO `dias_viajes` (`id`, `id_viaje`, `nombre`, `descripcion`, `f_dia`, `f_registro`, `indice`) VALUES
(2, 1, 'Salida', 'Salida de mazatlan', '2019-04-25', NULL, 21),
(3, 1, 'Recorrido', 'Recorrido por las hermosas calles del pueblo de mazamitla', '2019-04-26', NULL, 31),
(4, 1, 'Visita', 'Visita a pueblos vecinos', '2019-04-27', NULL, 41),
(5, 1, 'Viñedo y regreso', 'Visita a los famosos viñedos de Mazamitla y regreso a Mazatlan', '2019-04-28', NULL, 51),
(6, 2, 'Salida a cancun', 'Salida de Mazatlan por la mañana y llegada por la noche a Cancun', '2019-07-19', NULL, 12),
(7, 2, 'Playa del carmen', 'Por la mañana salida a playa del carmen', '2019-07-20', NULL, 22),
(8, 2, 'Xcaret', 'Todo el dia visita a Xcaret', '2019-07-21', NULL, 32),
(9, 2, 'Isla mujeres', 'Visita a isla mujeres y por la noche regreso a Mazatlan', '2019-07-22', NULL, 42),
(10, 3, 'Salida', 'Salida por la noche de Mazatlan', '2019-04-05', NULL, 13),
(11, 3, 'Recorrido', 'Recorrido por el pueblo', '2019-04-06', NULL, 23),
(12, 3, 'Callejoniada', 'Tarde libre y por la noche callejoniada', '2019-04-07', NULL, 33),
(13, 3, 'Regreso', 'Por la mañana salida a Mazatlan', '2019-04-08', NULL, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
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
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `a_paterno`, `a_materno`, `telefono`, `correo`, `rfc`, `nss`, `informacion`, `f_registro`, `id_usuario`, `status`) VALUES
(1, 'Valeria', 'Altamirano', 'Palacios', '6699129707', '2016030063@upsin.edu.mx', 'ANV980321PAAL', '70169728311', '', '2019-03-11', 1, 1),
(2, 'Juan', 'Valverde', 'Martinez', '6693250611', '2016030063@upsin.edu.mx', 'JURA972305vVAMA', '7016928311', '', '2019-03-11', 2, 1),
(3, 'Carlos', 'Hernandez', 'Gaxiola', '6694252565', '2016030063@upsin.edu.mx', 'CAAL981507HEGA', '7016928331', '', '2019-03-11', 3, 1),
(4, 'José', 'Lora', 'Peinado', '6631842943', '2016030063@upsin.edu.mx', 'JOMA982308LOPA', '70169255262', '', '2019-03-11', 4, 1),
(5, 'Cesar', 'Ramirez', 'Luna', '6392299693', '2016030063@upsin.edu.mx', 'CEED990215RALU', '7016521196', '', '2019-03-11', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `abreviatura` varchar(25) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `abreviatura`, `status`) VALUES
(1, 'AGUASCALIENTES', 'AGS.', 1),
(2, 'BAJA CALIFORNIA', 'B. C.', 1),
(3, 'BAJA CALIFORNIA SUR', 'B. C. S.', 1),
(4, 'CAMPECHE', 'CAMP.', 1),
(5, 'CHIAPAS', 'CHIS.', 1),
(6, 'CHIHUAHUA', 'CHIH.', 1),
(7, 'CIUDAD DE MÉXICO', 'CDMX.', 1),
(8, 'COAHUILA DE ZARAGOZA', 'COAH.', 1),
(9, 'COLIMA', 'COL.', 1),
(10, 'DURANGO', 'DGO.', 1),
(11, 'GUANAJUATO', 'GTO.', 1),
(12, 'GUERRERO', 'GRO.', 1),
(13, 'HIDALGO', 'HGO.', 1),
(14, 'JALISCO', 'JAL.', 1),
(15, 'MÉXICO', 'MÉX.', 1),
(16, 'MICHOACÁN DE OCAMPO', 'MICH.', 1),
(17, 'MORELOS', 'MOR.', 1),
(18, 'NAYARIT', 'NAY.', 1),
(19, 'NUEVO LEÓN', 'N. L.', 1),
(20, 'OAXACA', 'OAX.', 1),
(21, 'PUEBLA', 'PUE.', 1),
(22, 'QUERÉTARO DE ARTEAGA', 'QRO.', 1),
(23, 'QUINTANA ROO', 'Q. R.', 1),
(24, 'SAN LUIS POTOSÍ', 'S. L. P.', 1),
(25, 'SINALOA', 'SIN.', 1),
(26, 'SONORA', 'SON.', 1),
(27, 'TABASCO', 'TAB.', 1),
(28, 'TAMAULIPAS', 'TAMPS.', 1),
(29, 'TLAXCALA', 'TLAX.', 1),
(30, 'VERACRUZ DE IGNACIO DE LA LLAVE', 'VER.', 1),
(31, 'YUCATÁN', 'YUC.', 1),
(32, 'ZACATECAS', 'ZAC.', 1),
(33, 'EXTRANJERO', 'EXT.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias_viajes`
--

CREATE TABLE `guias_viajes` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_guia` int(11) DEFAULT NULL COMMENT 'Identificador del guia',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `guias_viajes`
--

INSERT INTO `guias_viajes` (`id`, `id_guia`, `id_viaje`) VALUES
(8, 4, 2),
(9, 4, 3),
(13, 4, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listar_detalle_viaje`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `listar_detalle_viaje` (
`id` int(11)
,`nombre` varchar(100)
,`a_paterno` varchar(100)
,`a_materno` varchar(100)
,`sexo` varchar(10)
,`edad` int(11)
,`estado` varchar(100)
,`telefono` varchar(15)
,`correo` varchar(30)
,`informacion` varchar(500)
,`id_usuario` int(11)
,`f_registro` date
,`status` int(1)
,`cantidad` int(11)
,`resto` int(11)
,`viaje` varchar(100)
,`id_viaje` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listar_guias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `listar_guias` (
`id` int(11)
,`nombre` varchar(45)
,`a_paterno` varchar(45)
,`a_materno` varchar(45)
,`telefono` varchar(15)
,`correo` varchar(30)
,`rfc` varchar(100)
,`nss` varchar(100)
,`informacion` text
,`f_registro` date
,`id_usuario` int(11)
,`status` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listar_viajeros`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `listar_viajeros` (
`id` int(11)
,`nombre` varchar(100)
,`paterno` varchar(100)
,`materno` varchar(100)
,`sexo` varchar(10)
,`estado` varchar(100)
,`edad` int(11)
,`telefono` varchar(15)
,`correo` varchar(30)
,`informacion` varchar(500)
,`idUsuario` int(11)
,`registro` date
,`status` int(11)
,`usuario` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listar_viajes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `listar_viajes` (
`id` int(11)
,`nombre` varchar(100)
,`descripcion` text
,`minimo` int(11)
,`maximo` int(11)
,`precio` float
,`dias_duracion` int(11)
,`noches_duracion` int(11)
,`dias_espera_devolucion` int(11)
,`f_inicio` date
,`f_fin` date
,`id_tipo_viaje` int(11)
,`f_registro` date
,`status` int(1)
,`tipo_viaje` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listar_viajes_guias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `listar_viajes_guias` (
`id` int(11)
,`nombre` varchar(100)
,`descripcion` text
,`minimo` int(11)
,`maximo` int(11)
,`precio` float
,`dias_duracion` int(11)
,`noches_duracion` int(11)
,`dias_espera_devolucion` int(11)
,`f_inicio` date
,`f_fin` date
,`id_tipo_viaje` int(11)
,`f_registro` date
,`status` int(1)
,`id_guia` int(11)
,`guia` varchar(137)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_grupos`
--

CREATE TABLE `mensajes_grupos` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_remitente` int(11) DEFAULT NULL COMMENT 'Identifiacador del usuario remitente del mensaje',
  `nombre_remitente` varchar(100) DEFAULT NULL COMMENT 'Nombre de quien envió el mensaje',
  `id_grupo_destinatario` int(11) DEFAULT NULL COMMENT 'Identificador del grupo destinatario del mensaje',
  `id_nivel` int(11) DEFAULT NULL COMMENT 'Nivel de Representación de Usuarios 1-Viajeros, 2-Guia',
  `cuerpo` longtext COMMENT 'Cuerpo del mensaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha del registro del mensaje',
  `h_registro` time DEFAULT NULL COMMENT 'Hora del registro del mensaje'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensajes_grupos`
--

INSERT INTO `mensajes_grupos` (`id`, `id_remitente`, `nombre_remitente`, `id_grupo_destinatario`, `id_nivel`, `cuerpo`, `f_registro`, `h_registro`) VALUES
(181, 26, 'José', 1, 3, 'hola', '2019-04-05', '11:13:34'),
(182, 4, 'LORa', 1, 2, 'bienvenidos', '2019-04-05', '11:14:30'),
(183, 4, 'LORa', 1, 2, 'esperamos que disfruten su viaje', '2019-04-05', '11:15:19'),
(184, 26, 'José', 1, 3, 'Buenos dias', '2019-04-05', '11:37:33'),
(185, 26, 'José', 1, 3, 'hola maestra', '2019-04-05', '12:03:27'),
(186, 26, 'José', 1, 3, 'hola amigos', '2019-04-05', '12:08:59'),
(187, 26, 'José', 1, 3, 'hola buenas tardes', '2019-04-05', '12:24:36'),
(188, 4, 'LORa', 1, 2, 'hola', '2019-04-05', '12:26:11'),
(189, 4, 'LORa', 1, 2, 'tomen lo que gusten', '2019-04-05', '12:31:18'),
(190, 26, 'José', 1, 3, 'hola', '2019-04-05', '12:43:43'),
(191, 4, 'LORa', 1, 2, 'hola', '2019-04-05', '12:43:48'),
(192, 4, 'LORa', 1, 2, 'bienvenidos', '2019-04-05', '12:55:28'),
(193, 4, 'LORa', 1, 2, 'ghig', '2019-04-05', '13:02:40'),
(194, 26, 'José', 1, 3, 'rhrj', '2019-04-05', '13:03:06'),
(195, 4, 'LORa', 1, 2, 'hola', '2019-04-05', '13:23:56'),
(196, 4, 'LORa', 1, 2, 'bienvenidos', '2019-04-05', '13:24:22'),
(197, 26, 'José', 1, 3, 'hola', '2019-04-05', '13:24:37'),
(198, 4, 'LORa', 1, 2, 'travelopolis', '2019-04-05', '13:24:47'),
(199, 4, 'LORa', 1, 2, 'hola', '2019-04-05', '13:29:27'),
(200, 26, 'José', 1, 3, 'que rollo', '2019-04-05', '19:41:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_privados`
--

CREATE TABLE `mensajes_privados` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_remitente` int(11) DEFAULT NULL COMMENT 'Identificador del usuario que mando el mensaje',
  `id_destinatario` int(11) DEFAULT NULL COMMENT 'Identificador del destinatario que mando el mensaje',
  `cuerpo` longtext COMMENT 'Cuerpo del mensaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha del registro del mensaje',
  `h_registro` time DEFAULT NULL COMMENT 'Hora del registro del mensaje'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensajes_privados`
--

INSERT INTO `mensajes_privados` (`id`, `id_remitente`, `id_destinatario`, `cuerpo`, `f_registro`, `h_registro`) VALUES
(1, 7, 6, 'QueOndaRaza', '2019-03-18', '03:00:00'),
(2, 7, 6, 'raza', '2019-03-19', '01:46:07'),
(3, 6, 7, 'raza', '2019-03-19', '02:06:05'),
(4, 6, 7, 'raza', '2019-03-19', '02:12:04'),
(5, 6, 7, 'raza', '2019-03-19', '02:12:37'),
(6, 6, 7, 'raza', '2019-03-19', '02:16:48'),
(7, 7, 6, 'raza', '2019-03-19', '02:17:47'),
(8, 7, 6, 'raza', '2019-03-19', '02:18:23'),
(9, 7, 6, 'raza', '2019-03-19', '02:19:20'),
(10, 7, 6, 'raza', '2019-03-19', '02:22:01'),
(11, 7, 6, 'raza', '2019-03-19', '02:22:16'),
(12, 7, 6, 'raza', '2019-03-19', '02:22:42'),
(13, 7, 6, 'raza', '2019-03-19', '02:22:49'),
(14, 7, 6, 'Que PEdo Raza', '2019-03-19', '02:23:31'),
(15, 7, 6, 'Que PEdo Raza', '2019-03-19', '02:24:16'),
(16, 6, 7, 'Lora', '2019-03-19', '03:12:50'),
(17, 6, 7, 'Lora', '2019-03-19', '03:13:02'),
(18, 6, 7, 'Lora', '2019-03-19', '03:17:59'),
(19, 6, 7, 'Lora', '2019-03-19', '03:18:18'),
(20, 6, 7, 'Lora', '2019-03-19', '03:20:29'),
(21, 7, 6, 'Que PEdo Raza', '2019-03-19', '03:29:08'),
(22, 6, 7, 'Lora', '2019-03-19', '03:29:19'),
(23, 6, 7, 'Lora', '2019-03-19', '03:33:04'),
(24, 6, 7, 'que pedo razita pisteadora', '2019-03-19', '03:34:06'),
(25, 6, 7, 'Lora', '2019-03-19', '03:34:59'),
(26, 6, 7, 'Valió madre raza', '2019-03-19', '03:36:04'),
(27, 7, 6, 'ue', '2019-03-19', '03:37:47'),
(28, 7, 6, 'que pedo alv', '2019-03-19', '03:38:02'),
(29, 6, 7, 'Lora', '2019-03-19', '03:38:18'),
(30, 6, 7, 'Lora', '2019-03-19', '03:39:34'),
(31, 7, 6, 'Lora', '2019-03-19', '03:39:51'),
(32, 6, 7, 'Lora', '2019-03-19', '03:39:55'),
(33, 7, 6, 'Lora', '2019-03-19', '03:40:09'),
(34, 6, 7, 'Lora', '2019-03-19', '03:40:16'),
(35, 7, 6, 'lora', '2019-03-19', '03:42:03'),
(36, 7, 6, 'lora', '2019-03-19', '03:42:06'),
(37, 7, 6, 'lora', '2019-03-19', '03:42:07'),
(38, 7, 6, 'lora', '2019-03-19', '03:42:08'),
(39, 7, 6, 'lora', '2019-03-19', '03:42:12'),
(40, 7, 6, 'af', '2019-03-19', '03:42:14'),
(41, 7, 6, 'sjeud', '2019-03-19', '03:42:17'),
(42, 7, 6, 'lota', '2019-03-19', '03:42:30'),
(43, 6, 7, 'Lora', '2019-03-19', '03:51:31'),
(44, 6, 7, 'Lora', '2019-03-19', '03:53:41'),
(45, 6, 7, 'Peinado', '2019-03-19', '03:53:48'),
(46, 6, 7, 'Lora', '2019-03-19', '03:53:58'),
(47, 7, 6, 'Lora', '2019-03-19', '03:54:17'),
(48, 7, 61, 'Que pwdo', '2019-03-19', '03:55:37'),
(49, 7, 61, 'que onda raza', '2019-03-19', '03:56:05'),
(50, 6, 71, 'Que onda', '2019-03-19', '03:56:26'),
(51, 6, 71, 'Lora', '2019-03-19', '03:57:01'),
(52, 7, 61, 'Lora', '2019-03-19', '03:57:12'),
(53, 7, 71, 'ksks', '2019-03-19', '03:57:26'),
(54, 7, 71, 'LoraPeinafo', '2019-03-19', '03:57:59'),
(55, 6, 61, 'peinado', '2019-03-19', '03:58:24'),
(56, 6, 61, 'que mamada con esto alv', '2019-03-19', '03:58:38'),
(57, 6, 61, 'Lora', '2019-03-19', '04:12:48'),
(58, 6, 61, 'Linda', '2019-03-19', '04:15:36'),
(59, 6, 61, 'que tranza perro', '2019-03-19', '04:15:49'),
(60, 6, 61, 'Linda', '2019-03-19', '13:40:15'),
(61, 6, 61, 'Login', '2019-03-19', '13:41:01'),
(62, 6, 61, 'login', '2019-03-19', '13:41:11'),
(63, 6, 61, 'Login', '2019-03-19', '13:42:18'),
(64, 6, 61, 'Login', '2019-03-19', '13:42:25'),
(65, 6, 61, 'que onda', '2019-03-19', '14:01:34'),
(66, 6, 61, 'por favor Diosito', '2019-03-19', '14:07:14'),
(67, 6, 61, 'Lora', '2019-03-19', '15:47:11'),
(68, 6, 61, 'Peinado', '2019-03-19', '15:47:50'),
(69, 6, 61, 'lora', '2019-03-19', '15:48:08'),
(70, 6, 71, 'cr', '2019-03-19', '15:48:15'),
(71, 6, 61, 'Lora', '2019-03-19', '15:49:00'),
(72, 6, 61, 'ojalá no me salga ', '2019-03-19', '16:17:11'),
(73, 6, 61, 'asd', '2019-03-20', '17:46:59'),
(74, 6, 61, 'etc', '2019-03-20', '17:47:08'),
(75, 6, 61, 'shsjsjdhdhdhdhhdhd', '2019-03-20', '17:47:15'),
(76, 6, 61, 'soy joto gg', '2019-03-20', '17:47:25'),
(77, 6, 61, 'delate', '2019-03-20', '17:47:32'),
(78, 6, 61, 'delete * from usuario', '2019-03-20', '17:47:59'),
(79, 6, 61, 'hola', '2019-03-21', '17:12:23'),
(80, 6, 61, 'que haces?', '2019-03-21', '17:12:36'),
(81, 6, 61, 'suicidarme ', '2019-03-21', '17:12:45'),
(82, 6, 61, 'que bueno ', '2019-03-21', '17:12:51'),
(83, 6, 61, 'ojalá te mueras ', '2019-03-21', '17:12:56'),
(84, 6, 61, 'adiós ', '2019-03-21', '17:12:59'),
(85, 6, 61, 'lora', '2019-03-21', '17:30:08'),
(86, 6, 61, 'lors', '2019-03-21', '17:31:33'),
(87, 7, 61, 'Que PEdo Raza', '2019-03-22', '19:14:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  `fa_icon` varchar(45) DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `descripcion`, `ruta`, `fa_icon`, `index`, `status`) VALUES
(1, 'Inicio', 'Explora los viajes y tambien crea tu usuario', 'inicio', 'fas fa-home', 9, 1),
(2, 'Modulos', 'Modulo para ver los modulos', 'admin/Modulos', 'fas fa-puzzle-piece', 8, 1),
(3, 'Viajeros', 'Ver listado de viajeros', 'admin/Viajeros', 'far fa-user', 3, 1),
(4, 'Viajes', 'Agregar, editar, eliminar y ver registro de viajes', 'admin/Viajes', 'fas fa-plane', 4, 1),
(5, 'Perfiles', 'Ver, editar y cambiar permisos de perfiles', 'admin/Perfiles', 'fas fa-side-head', 8, 1),
(6, 'Guias', 'Agregar, editar, eliminar y listar guias', 'admin/Guias', 'fas fa-file-user', 6, 1),
(7, 'Administradores', 'Agregar, editar, eliminar y listar administradores', 'admin/Administradores', 'fas fa-user-cog', 2, 1),
(8, 'Mi Perfil', 'Ver datos de mi perfil de usuario', 'perfil', 'fas fa-user', 20, 1),
(9, 'Inicio Administrador', 'Inicio de administrador', 'administrar', 'fas fa-cogs', 1, 1),
(10, 'Asignar Guias', 'Asigna guias a un nuevo viaje', 'admin/asignar', 'fas fa-map', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `fecha` date DEFAULT NULL COMMENT 'Fecha de registro del movimiento',
  `tipo` int(11) DEFAULT NULL COMMENT 'Tipo de movimiento (0 registro, 1 baja, 2 modificacion)',
  `tabla` varchar(50) DEFAULT NULL COMMENT 'Nombre de la tabla afectada por el movimiento',
  `id_usuario_responsable` int(11) DEFAULT NULL COMMENT 'Identificador del usuario responsable del movimiento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Acceso a todo'),
(2, 'Guía', 'Acceso a itinerario y pasajeros'),
(3, 'Viajero', 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles_modulos`
--

CREATE TABLE `perfiles_modulos` (
  `id` int(11) NOT NULL COMMENT 'Identificador del regsitro',
  `id_perfil` int(11) DEFAULT NULL COMMENT 'Identifica el tipo de usuario que puede acceder al modulo',
  `id_modulo` int(11) DEFAULT NULL COMMENT 'Identifica el modulo que esta relaciona con el tipo de usuario',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha en que se agrego el reistro',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles_modulos`
--

INSERT INTO `perfiles_modulos` (`id`, `id_perfil`, `id_modulo`, `f_registro`, `status`) VALUES
(16, 1, 2, NULL, NULL),
(17, 1, 3, NULL, NULL),
(18, 1, 4, NULL, NULL),
(19, 1, 5, NULL, NULL),
(20, 1, 6, NULL, NULL),
(21, 1, 9, NULL, NULL),
(22, 1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_propietario` int(11) DEFAULT NULL COMMENT 'Identificador del usuario propietario de la noticia',
  `cuerpo` text COMMENT 'Mensaje principal de la publicacion',
  `titulo` text COMMENT 'Titulo de la publicacion',
  `tipo` int(11) DEFAULT NULL COMMENT 'Tipo de noticia (0 viaje realizado, 1 viaje por realizar, 2 nuevo vieaje, 3 viaje renovado, 4 experiencia de viaje)',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro de la publicacion',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas_multimedia`
--

CREATE TABLE `rutas_multimedia` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje con el que se liga la archivo',
  `ruta` text COMMENT 'Ruta de la foto/imagen',
  `tipo_archivo` int(11) DEFAULT NULL COMMENT 'Tipo de archivo multimedia del registro (0 foto, 1 video)',
  `id_usuario` int(11) DEFAULT NULL COMMENT 'Identificador del usuario que agrego la foto',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha en que se agrego la foto',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_proveedores`
--

CREATE TABLE `tipos_proveedores` (
  `id` int(11) NOT NULL COMMENT 'Identificador de tipos de provedor',
  `nombre` varchar(40) DEFAULT NULL COMMENT 'nombre del tipo Hospedaje/Transporte/LUGAR',
  `estatus` int(11) DEFAULT NULL COMMENT '0=Inactivo/1=ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_viaje`
--

CREATE TABLE `tipos_viaje` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `f_registro` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_viaje`
--

INSERT INTO `tipos_viaje` (`id`, `nombre`, `f_registro`, `status`) VALUES
(1, 'Playero', '2019-03-26', 1),
(2, 'Natural', '2019-03-26', 1),
(5, 'Arqueologico', '2019-03-26', 1),
(6, 'Pueblo', '2019-04-01', 1),
(7, 'Cabaña', '2019-04-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL COMMENT 'Identificador del usuario',
  `usuario` varchar(100) DEFAULT NULL COMMENT 'Nombre del usuario, este campo es unico',
  `contraseña` varchar(100) DEFAULT NULL COMMENT 'Contraseña del usuario, encriptacion sha1',
  `id_perfil` int(11) DEFAULT NULL COMMENT 'Identificador del rol que ejerce el usuario en el sistema (0 Sistemas, 1 Admistrador, 2 Guia, 3 Viajero)',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro del usuario',
  `token` varchar(500) DEFAULT NULL COMMENT 'Id Único Otorgado a cada Celular del Usuario',
  `status` int(11) DEFAULT NULL COMMENT 'Estado actual del registro (0 Inactivo, 1 Activo)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contraseña`, `id_perfil`, `f_registro`, `token`, `status`) VALUES
(1, 'Valeria', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '2019-03-11', NULL, 1),
(2, 'Juan', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '2019-03-11', '', 1),
(3, 'Carlos', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '2019-03-11', '', 1),
(4, 'Lora', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, '2019-03-11', NULL, 1),
(5, 'Cesar', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, '2019-03-11', '', 1),
(6, 'Linda', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, '2019-03-11', NULL, 1),
(7, 'Kimiko', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, '2019-03-11', NULL, 1),
(8, 'inda', 'c2325b478dfeef64a3088ea3f8f0c0f284173a91', 3, '2019-03-11', '', 1),
(9, 'joma1998', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, '2019-03-12', NULL, 1),
(10, 'valeverga', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, NULL, 'raza', NULL),
(16, 'lora', 'Lora', 3, '0000-00-00', NULL, 1),
(17, 'Verga1', 'Verga2', 3, '2019-03-24', NULL, 1),
(18, 'lachingada', 'Verga2', 3, '2019-03-24', NULL, 1),
(19, 'Jose Manuel Lora Peinado', 'Vale Madre', 3, '2019-03-24', NULL, 1),
(20, 'joma1998', 'Vale Madre', 3, '2019-03-24', NULL, 1),
(22, 'bernalputo', 'Vale Madre', 3, '2019-03-24', NULL, 1),
(23, 'nommes', 'Vale Madre', 3, '2019-03-25', NULL, 1),
(24, 'nommesss', 'Vale Madre', 1, '2019-03-25', NULL, 1),
(25, 'manuel', 'manuel', 3, '2019-03-25', NULL, 1),
(26, 'joma1999', 'bsndjd', 3, '2019-03-25', NULL, 1),
(27, 'prueba', '123', 4, '2019-03-25', NULL, 1),
(28, 'corola', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, '2019-03-25', NULL, 1),
(29, 'lorapeinado123', '25b99bacd5f00970e7f5003b4463b2456c22f73c', 3, '2019-03-27', 'd00cd6iPsfo:APA91bHSCSGgf-BLqgzCOWe4MmOhxPxEx2vhsUTpMLHtF65eP-0L469oquUy4LtztC_PQRGad_S6RGiTcVGALPBlY5rHGuvirrpyHtD2ad5sFCdp3U4PrnbqBH65F1AJ41ooUo7aM6Cz', 1),
(30, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3, '2019-03-30', NULL, 1),
(31, 'esclavo', '7867bbfc530cdcfe5fdef94bad937f27431ed986', 3, '2019-04-01', NULL, 1),
(32, 'lorita', '7867bbfc530cdcfe5fdef94bad937f27431ed986', 3, '2019-04-01', NULL, 1),
(33, 'juanitolocosns', 'e3566fedd1832efe11ea8be26094b84ee16556f8', 3, '2019-04-01', NULL, 1),
(34, 'juanitolocosnsas', 'e3566fedd1832efe11ea8be26094b84ee16556f8', 3, '2019-04-01', NULL, 1),
(35, 'vale', '7867bbfc530cdcfe5fdef94bad937f27431ed986', 3, '2019-04-01', NULL, 1),
(36, 'familiares', '8cb2237d0679ca88db6464eac60da96345513964', 3, '2019-04-02', NULL, 1),
(37, NULL, NULL, 3, '2019-04-02', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajeros`
--

CREATE TABLE `viajeros` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
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
  `status` int(11) DEFAULT NULL COMMENT '0) inactivo 1) activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viajeros`
--

INSERT INTO `viajeros` (`id`, `nombre`, `a_paterno`, `a_materno`, `sexo`, `edad`, `estado`, `telefono`, `correo`, `informacion`, `id_usuario`, `f_registro`, `status`) VALUES
(1, 'Linda', 'German', 'Torres', NULL, NULL, NULL, '6699276707', '2016030023@upsin.edu.mx', NULL, 6, '2019-03-11', 0),
(2, 'Alejandro', 'Castro', 'Aviles', NULL, NULL, NULL, '6691002599', '2016030063@upsin.edu.mx', NULL, 7, '2019-03-11', 1),
(3, 'Armando', 'Inda', 'Mellado', NULL, NULL, NULL, '6692276707', '2016030023@upsin.edu.mx', NULL, 8, '2019-03-11', 1),
(4, 'LORa', 'PEINADO', 'JOSE', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL),
(6, 'Valeria', 'Altamirano', 'Palacios', 'MUJER', 21, 'Sinaloa', '6699129707', '2016030063@upsin.edu.mx', '', 1, '0000-00-00', 1),
(7, 'Juan', 'Valverde', 'Martinez', 'HOMBRE', 21, 'Sinaloa', '6693250611', '2016030063@upsin.edu.mx', NULL, 2, '2019-03-24', 1),
(11, 'Yeah', 'Perdonen', 'kamehameha', NULL, NULL, NULL, '101010101', 'Vieneeldragonballrap', NULL, 18, '2019-03-24', 0),
(12, 'Yeah', '1', '1', NULL, NULL, NULL, '1', '1', NULL, 19, '2019-03-24', 0),
(13, 'Yeah', '1', '1', NULL, NULL, NULL, '1', '1', NULL, 9, '2019-03-24', 0),
(14, 'Yeah', '1', '1', NULL, NULL, NULL, '1', '1', NULL, 9, '2019-03-24', 0),
(15, 'Yeah', '1', '1', NULL, NULL, NULL, '1', '1', NULL, 22, '2019-03-24', 1),
(16, 'Yeah', '1', '1', 'HOMBRE', NULL, 'Sinaloa', '1', '1', 'LORA', 23, '2019-03-25', 1),
(17, 'Yeah', '1', '1', 'HOMBRE', 10, 'Sinaloa', '1', '1', 'LORA', 24, '2019-03-25', 1),
(18, 'manuel', 'manuel', 'manuel', 'HOMBRE', 10, 'México', '919764', 'manuel', 'manuel', 25, '2019-03-25', 1),
(19, 'jdnfjd', 'jsjdjd', 'jdjddj', 'MUJER', 18, 'Colima', '676734', 'hshdhs', 'hsjdnd', 26, '2019-03-25', 1),
(20, 'soy', 'una', 'prueba', 'MUJER', 20000000, 'Guanajuato', '239', 'hola', 'prueba soy?', 27, '2019-03-25', 1),
(21, 'Ira pues', 'andale', 'noteme', 'HOMBRE', 10, 'Baja California Sur', '9863548', 'joma1998@hotmail.com', 'lora', 28, '2019-03-25', 1),
(22, 'Jose Manuel', 'Lora', 'Peinado', 'HOMBRE', 20, 'Sinaloa', '9863548', 'joma1998@hotmail.com', 'Espero poder pasar', 29, '2019-03-27', 1),
(23, 'Prueba', 'Prueba', 'Prueba', 'HOMBRE', 10, 'Sinaloa', '6631348554', 'joma1998@hotmail.com', 'valgo madre', 30, '2019-03-30', 1),
(24, 'Miguel Mancera', 'Lopez', 'Perez', 'HOMBRE', 10, 'Hidalgo', '9863648', 'lora@jmail.com', 'me gustaroa pasar', 31, '2019-04-01', 1),
(25, 'lora', 'lora', 'lora', 'HOMBRE', 45, 'Morelos', '9863589', 'joma1999@hotmail.com', 'lora', 35, '2019-04-01', 0),
(26, 'José', 'Perez', 'López', 'Hombre', 57, 'SINALOA', '9863548', '2016030955@upsin.edu.mx', 'Persona muy sociable.', 36, '2019-04-02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajeros_familiares`
--

CREATE TABLE `viajeros_familiares` (
  `id` int(11) NOT NULL,
  `id_viaje` int(11) DEFAULT NULL,
  `id_viajero` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_p` varchar(100) DEFAULT NULL,
  `apellido_m` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `tipo_familiar` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viajeros_familiares`
--

INSERT INTO `viajeros_familiares` (`id`, `id_viaje`, `id_viajero`, `nombre`, `apellido_p`, `apellido_m`, `edad`, `telefono`, `tipo_familiar`, `status`) VALUES
(6, 1, 26, 'SIN NOMBRE', 'SIN APELLIDO P', 'SIN APELLIDO M', 0, 'SIN TELEFONO', 'SIN TIPO FAMILIAR', 1),
(7, 1, 26, 'SIN NOMBRE', 'SIN APELLIDO P', 'SIN APELLIDO M', 0, 'SIN TELEFONO', 'SIN TIPO FAMILIAR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
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
  `status` int(1) DEFAULT NULL COMMENT 'Estado del viaje (0 Inactivo, 1 reclutando, 2 lleno, 3 realizado, 4 en curso)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id`, `nombre`, `descripcion`, `minimo`, `maximo`, `precio`, `dias_duracion`, `noches_duracion`, `dias_espera_devolucion`, `f_inicio`, `f_fin`, `id_tipo_viaje`, `f_registro`, `status`) VALUES
(1, 'Primavera Invernal', 'Viaje por Mazamitla en la primavera, y paseo al parque de diversiones', 30, 42, 2400, 4, 3, 30, '2019-04-25', '2019-04-25', 7, '2019-03-11', 1),
(2, 'Playopolis', 'Viaje por Cancún visitando sus hermosas playas y hospedaje en un hotel de 3 estrellas.', 30, 42, 6500, 4, 3, 30, '2019-07-19', '2019-07-22', 1, '2019-03-11', 1),
(3, 'Viaje Magico', 'Viaje por Guanajuato visitando sus hermosas ruinas y saludando sus momias.hola.', 30, 42, 3400, 4, 3, 30, '2019-08-01', '2019-08-04', 6, '2019-04-05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes_destacados`
--

CREATE TABLE `viajes_destacados` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje marcado como favorito',
  `id_viajero` int(11) DEFAULT NULL COMMENT 'Identificador del viajero que marco el viaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del registro (1 Marcado, 0 No Marcado)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viajes_destacados`
--

INSERT INTO `viajes_destacados` (`id`, `id_viaje`, `id_viajero`, `f_registro`, `status`) VALUES
(1, 1, 22, '2019-03-30', 1),
(2, 2, 22, '2019-03-30', 1),
(3, 1, 21, '2019-04-01', 1),
(4, 2, 26, '2019-04-02', 1),
(5, 1, 26, '2019-04-05', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_detalle_viaje`
--
DROP TABLE IF EXISTS `listar_detalle_viaje`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_detalle_viaje`  AS  (select `cli`.`id` AS `id`,`cli`.`nombre` AS `nombre`,`cli`.`a_paterno` AS `a_paterno`,`cli`.`a_materno` AS `a_materno`,`cli`.`sexo` AS `sexo`,`cli`.`edad` AS `edad`,`cli`.`estado` AS `estado`,`cli`.`telefono` AS `telefono`,`cli`.`correo` AS `correo`,`cli`.`informacion` AS `informacion`,`cli`.`id_usuario` AS `id_usuario`,`cli`.`f_registro` AS `f_registro`,`det`.`status` AS `status`,`det`.`cantidad` AS `cantidad`,`det`.`resto` AS `resto`,`via`.`nombre` AS `viaje`,`via`.`id` AS `id_viaje` from ((`viajeros` `cli` join `detalle_viajes` `det` on((`cli`.`id` = `det`.`id_viajero`))) join `viajes` `via` on((`via`.`id` = `det`.`id_viaje`)))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_guias`
--
DROP TABLE IF EXISTS `listar_guias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_guias`  AS  (select `emp`.`id` AS `id`,`emp`.`nombre` AS `nombre`,`emp`.`a_paterno` AS `a_paterno`,`emp`.`a_materno` AS `a_materno`,`emp`.`telefono` AS `telefono`,`emp`.`correo` AS `correo`,`emp`.`rfc` AS `rfc`,`emp`.`nss` AS `nss`,`emp`.`informacion` AS `informacion`,`emp`.`f_registro` AS `f_registro`,`emp`.`id_usuario` AS `id_usuario`,`emp`.`status` AS `status` from ((`empleados` `emp` join `usuarios` `usu` on((`usu`.`id` = `emp`.`id_usuario`))) join `perfiles` `per` on((`per`.`id` = `usu`.`id_perfil`))) where (`per`.`nombre` = 'guia')) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_viajeros`
--
DROP TABLE IF EXISTS `listar_viajeros`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_viajeros`  AS  (select `via`.`id` AS `id`,`via`.`nombre` AS `nombre`,`via`.`a_paterno` AS `paterno`,`via`.`a_materno` AS `materno`,`via`.`sexo` AS `sexo`,`via`.`estado` AS `estado`,`via`.`edad` AS `edad`,`via`.`telefono` AS `telefono`,`via`.`correo` AS `correo`,`via`.`informacion` AS `informacion`,`via`.`id_usuario` AS `idUsuario`,`via`.`f_registro` AS `registro`,`via`.`status` AS `status`,`usus`.`usuario` AS `usuario` from (`viajeros` `via` join `usuarios` `usus` on((`usus`.`id` = `via`.`id_usuario`)))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_viajes`
--
DROP TABLE IF EXISTS `listar_viajes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_viajes`  AS  (select `via`.`id` AS `id`,`via`.`nombre` AS `nombre`,`via`.`descripcion` AS `descripcion`,`via`.`minimo` AS `minimo`,`via`.`maximo` AS `maximo`,`via`.`precio` AS `precio`,`via`.`dias_duracion` AS `dias_duracion`,`via`.`noches_duracion` AS `noches_duracion`,`via`.`dias_espera_devolucion` AS `dias_espera_devolucion`,`via`.`f_inicio` AS `f_inicio`,`via`.`f_fin` AS `f_fin`,`via`.`id_tipo_viaje` AS `id_tipo_viaje`,`via`.`f_registro` AS `f_registro`,`via`.`status` AS `status`,`tipo`.`nombre` AS `tipo_viaje` from (`viajes` `via` join `tipos_viaje` `tipo` on((`tipo`.`id` = `via`.`id_tipo_viaje`)))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listar_viajes_guias`
--
DROP TABLE IF EXISTS `listar_viajes_guias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_viajes_guias`  AS  (select `via`.`id` AS `id`,`via`.`nombre` AS `nombre`,`via`.`descripcion` AS `descripcion`,`via`.`minimo` AS `minimo`,`via`.`maximo` AS `maximo`,`via`.`precio` AS `precio`,`via`.`dias_duracion` AS `dias_duracion`,`via`.`noches_duracion` AS `noches_duracion`,`via`.`dias_espera_devolucion` AS `dias_espera_devolucion`,`via`.`f_inicio` AS `f_inicio`,`via`.`f_fin` AS `f_fin`,`via`.`id_tipo_viaje` AS `id_tipo_viaje`,`via`.`f_registro` AS `f_registro`,`via`.`status` AS `status`,`gv`.`id_guia` AS `id_guia`,(select concat(`emp`.`nombre`,' ',`emp`.`a_paterno`,' ',`emp`.`a_materno`) from `empleados` `emp` where (`emp`.`id` = `gv`.`id_guia`)) AS `guia` from (`viajes` `via` left join `guias_viajes` `gv` on((`gv`.`id_viaje` = `via`.`id`))) where (`via`.`status` > 0)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_viajes`
--
ALTER TABLE `detalle_viajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dias_viajes`
--
ALTER TABLE `dias_viajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guias_viajes`
--
ALTER TABLE `guias_viajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes_grupos`
--
ALTER TABLE `mensajes_grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles_modulos`
--
ALTER TABLE `perfiles_modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutas_multimedia`
--
ALTER TABLE `rutas_multimedia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_proveedores`
--
ALTER TABLE `tipos_proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_viaje`
--
ALTER TABLE `tipos_viaje`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajeros`
--
ALTER TABLE `viajeros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajeros_familiares`
--
ALTER TABLE `viajeros_familiares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes_destacados`
--
ALTER TABLE `viajes_destacados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boletos`
--
ALTER TABLE `boletos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del Boleto';

--
-- AUTO_INCREMENT de la tabla `detalle_viajes`
--
ALTER TABLE `detalle_viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `dias_viajes`
--
ALTER TABLE `dias_viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifica el registro', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `guias_viajes`
--
ALTER TABLE `guias_viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `mensajes_grupos`
--
ALTER TABLE `mensajes_grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT de la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro';

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `perfiles_modulos`
--
ALTER TABLE `perfiles_modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del regsitro', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro';

--
-- AUTO_INCREMENT de la tabla `rutas_multimedia`
--
ALTER TABLE `rutas_multimedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro';

--
-- AUTO_INCREMENT de la tabla `tipos_proveedores`
--
ALTER TABLE `tipos_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de tipos de provedor';

--
-- AUTO_INCREMENT de la tabla `tipos_viaje`
--
ALTER TABLE `tipos_viaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del usuario', AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `viajeros`
--
ALTER TABLE `viajeros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `viajeros_familiares`
--
ALTER TABLE `viajeros_familiares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viajes_destacados`
--
ALTER TABLE `viajes_destacados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
