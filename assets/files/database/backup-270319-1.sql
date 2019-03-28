-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2019 a las 23:47:55
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
-- Estructura de tabla para la tabla `detalle_viajes`
--

CREATE TABLE `detalle_viajes` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje unido a este registo',
  `id_viajero` int(11) DEFAULT NULL COMMENT 'Identificador del viajero unido a este registro',
  `cantidad` int(11) DEFAULT NULL COMMENT 'Cantidad de pasajes solicitados por el viajero',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de agregacion del regisro',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `url_foto` varchar(255) DEFAULT NULL COMMENT 'Ruta de la imagen de perfil del empleado',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de la creacion del registro',
  `id_usuario` int(11) NOT NULL COMMENT 'Identificador de usuario',
  `status` int(11) DEFAULT NULL COMMENT 'Estado del registro (0 Inactivo, 1 Activo)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `a_paterno`, `a_materno`, `telefono`, `correo`, `rfc`, `nss`, `url_foto`, `f_registro`, `id_usuario`, `status`) VALUES
(1, 'Valeria', 'Altamirano', 'Palacios', '6699129707', '2016030063@upsin.edu.mx', 'ANV980321PAAL', '70169728311', NULL, '2019-03-11', 1, 1),
(2, 'Juan', 'Valverde', 'Martinez', '6693250611', '2016030063@upsin.edu.mx', 'JURA972305vVAMA', '7016928311', NULL, '2019-03-11', 2, 1),
(3, 'Carlos', 'Hernandez', 'Gaxiola', '6694252565', '2016030063@upsin.edu.mx', 'CAAL981507HEGA', '7016928331', '65184963b4f0c19f14cca0016b5b92ecc62d9df4', '2019-03-11', 3, 1),
(4, 'José', 'Lora', 'Peinado', '6631842943', '2016030063@upsin.edu.mx', 'JOMA982308LOPA', '70169255262', NULL, '2019-03-11', 4, 1),
(5, 'Cesar', 'Ramirez', 'Luna', '6392299693', '2016030063@upsin.edu.mx', 'CEED990215RALU', '7016521196', NULL, '2019-03-11', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_grupos`
--

CREATE TABLE `mensajes_grupos` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_remitente` int(11) DEFAULT NULL COMMENT 'Identifiacador del usuario remitente del mensaje',
  `id_grupo_destinatario` int(11) DEFAULT NULL COMMENT 'Identificador del grupo destinatario del mensaje',
  `cuerpo` longtext COMMENT 'Cuerpo del mensaje',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha del registro del mensaje',
  `h_registro` time DEFAULT NULL COMMENT 'Hora del registro del mensaje'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `descripcion`, `ruta`, `fa_icon`, `status`) VALUES
(1, 'Inicio', 'Explora los viajes y tambien crea tu usuario', 'inicio', 'fas fa-home', 1),
(2, 'Modulos', 'Modulo para ver los modulos', 'admin/Modulos', 'fas fa-puzzle-piece', 1),
(3, 'Viajeros', 'Ver listado de viajeros', 'admin/Viajeros', 'far fa-user', 1),
(4, 'Viajes', 'Agregar, editar, eliminar y ver registro de viajes', 'admin/Viajes', 'fas fa-plane', 1),
(5, 'Perfiles', 'Ver, editar y cambiar permisos de perfiles', 'admin/Perfiles', 'fas fa-side-head', 1),
(6, 'Guias', 'Agregar, editar, eliminar y listar guias', 'admin/Guias', 'fas fa-file-user', 1),
(7, 'Administradores', 'Agregar, editar, eliminar y listar administradores', 'admin/Administradores', 'fas fa-user-cog', 1),
(8, 'Mi Perfil', 'Ver datos de mi perfil de usuario', 'perfil', 'fas fa-user', 1),
(9, 'Inicio Administrador', 'Inicio de administrador', 'administrar', 'fas fa-cogs', 1);

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
(1, 1, 1, '2019-03-20', 1),
(2, 1, 2, '2019-03-20', 1),
(3, 1, 3, '2019-03-20', 1),
(4, 1, 4, '2019-03-20', 1),
(5, 1, 5, '2019-03-20', 1),
(6, 1, 6, '2019-03-20', 1),
(7, 1, 7, '2019-03-20', 1),
(8, 1, 8, '2019-03-20', 1),
(9, 1, 9, '2019-03-20', 1);

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
-- Estructura de tabla para la tabla `tipo_viaje`
--

CREATE TABLE `tipo_viaje` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `f_registro` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_viaje`
--

INSERT INTO `tipo_viaje` (`id`, `nombre`, `f_registro`, `status`) VALUES
(1, 'Playero', '2019-03-26', 1),
(2, 'Natural', '2019-03-26', 1),
(5, 'Arqueologico', '2019-03-26', 1);

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
(1, 'Valeria', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4, '2019-03-11', '', 1),
(2, 'Juan', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4, '2019-03-11', '', 1),
(3, 'Carlos', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4, '2019-03-11', '', 1),
(4, 'Lora', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, '2019-03-11', '', 1),
(5, 'Cesar', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, '2019-03-11', '', 1),
(6, 'Linda', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, '2019-03-11', 'ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo', 1),
(7, 'Kimiko', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 3, '2019-03-11', 'ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo', 1),
(8, 'inda', 'c2325b478dfeef64a3088ea3f8f0c0f284173a91', 4, '2019-03-11', '', 1),
(9, 'joma1998', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4, '2019-03-12', 'ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo', 1),
(10, 'valeverga', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, 'raza', NULL),
(16, 'lora', 'Lora', 4, '0000-00-00', NULL, 1),
(17, 'Verga1', 'Verga2', 4, '2019-03-24', NULL, 1),
(18, 'lachingada', 'Verga2', 4, '2019-03-24', NULL, 1),
(19, 'Jose Manuel Lora Peinado', 'Vale Madre', 4, '2019-03-24', NULL, 1),
(20, 'joma1998', 'Vale Madre', 4, '2019-03-24', 'ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo', 1),
(22, 'bernalputo', 'Vale Madre', 4, '2019-03-24', NULL, 1),
(23, 'nommes', 'Vale Madre', 1, '2019-03-25', NULL, 1),
(24, 'nommesss', 'Vale Madre', 1, '2019-03-25', NULL, 1),
(25, 'manuel', 'manuel', 4, '2019-03-25', NULL, 1),
(26, 'joma1999', 'bsndjd', 4, '2019-03-25', NULL, 1),
(27, 'prueba', '123', 4, '2019-03-25', NULL, 1),
(28, 'corola', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4, '2019-03-25', 'ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo', 1),
(29, 'lorapeinado123', '25b99bacd5f00970e7f5003b4463b2456c22f73c', 4, '2019-03-27', 'ekwG46GR3NQ:APA91bEJPcbl_5UU_i-H6UaDEXZ7esth_KJ147CmnIaaHmsWCn91zYL2AX2LFO4qx_Gqt1qasU5XLFaM_0Tz_9nTlsnl8qS0gqSyI1-0zl2SUl2CQNBKfkoQuMtCl2KZrdlpjGQRRuFo', 1);

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
  `url_foto` varchar(255) DEFAULT NULL COMMENT 'Ruta de la imagen de perfil del vaijero',
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

INSERT INTO `viajeros` (`id`, `nombre`, `a_paterno`, `a_materno`, `sexo`, `edad`, `estado`, `url_foto`, `telefono`, `correo`, `informacion`, `id_usuario`, `f_registro`, `status`) VALUES
(1, 'Linda', 'German', 'Torres', NULL, NULL, NULL, NULL, '6699276707', '2016030063@upsin.edu.mx', NULL, 6, '2019-03-11', 1),
(2, 'Alejandro', 'Castro', 'Aviles', NULL, NULL, NULL, NULL, '6691002599', '2016030063@upsin.edu.mx', NULL, 7, '2019-03-11', 1),
(3, 'Armando', 'Inda', 'Mellado', NULL, NULL, NULL, NULL, '6692276707', '2016030063@upsin.edu.mx', NULL, 8, '2019-03-11', 1),
(4, 'LORa', 'PEINADO', 'JOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL),
(5, '$nombre', '$apellido_p', '$apellido_m', NULL, NULL, NULL, '$nueva_foto', '$telefono', '$correo', NULL, 0, '0000-00-00', 0),
(6, 'LORA', 'LORA', 'LORA', NULL, NULL, NULL, 'LORA', 'LORA', 'LORA', NULL, 1, '0000-00-00', 1),
(7, 'Yeah', 'Perdonen', 'kamehameha', NULL, NULL, NULL, 'despuesdeltemadeltetris.jpg', '101010101', 'Vieneeldragonballrap', NULL, 4, '2019-03-24', 1),
(8, 'Yeah', 'Perdonen', 'kamehameha', NULL, NULL, NULL, 'despuesdeltemadeltetris.jpg', '101010101', 'Vieneeldragonballrap', NULL, NULL, '2019-03-24', 1),
(9, 'Yeah', 'Perdonen', 'kamehameha', NULL, NULL, NULL, 'despuesdeltemadeltetris.jpg', '101010101', 'Vieneeldragonballrap', NULL, NULL, '2019-03-24', 1),
(10, 'Yeah', 'Perdonen', 'kamehameha', NULL, NULL, NULL, 'despuesdeltemadeltetris.jpg', '101010101', 'Vieneeldragonballrap', NULL, NULL, '2019-03-24', 1),
(11, 'Yeah', 'Perdonen', 'kamehameha', NULL, NULL, NULL, 'despuesdeltemadeltetris.jpg', '101010101', 'Vieneeldragonballrap', NULL, 18, '2019-03-24', 1),
(12, 'Yeah', '1', '1', NULL, NULL, NULL, '1.jpg', '1', '1', NULL, 19, '2019-03-24', 1),
(13, 'Yeah', '1', '1', NULL, NULL, NULL, '1.jpg', '1', '1', NULL, 9, '2019-03-24', 1),
(14, 'Yeah', '1', '1', NULL, NULL, NULL, '1.jpg', '1', '1', NULL, 9, '2019-03-24', 1),
(15, 'Yeah', '1', '1', NULL, NULL, NULL, '1.jpg', '1', '1', NULL, 22, '2019-03-24', 1),
(16, 'Yeah', '1', '1', 'HOMBRE', NULL, 'Sinaloa', '1.jpg', '1', '1', 'LORA', 23, '2019-03-25', 1),
(17, 'Yeah', '1', '1', 'HOMBRE', 10, 'Sinaloa', '1.jpg', '1', '1', 'LORA', 24, '2019-03-25', 1),
(18, 'manuel', 'manuel', 'manuel', 'HOMBRE', 10, 'México', 'Null', '919764', 'manuel', 'manuel', 25, '2019-03-25', 1),
(19, 'jdnfjd', 'jsjdjd', 'jdjddj', 'MUJER', 18, 'Colima', 'Null', '676734', 'hshdhs', 'hsjdnd', 26, '2019-03-25', 1),
(20, 'soy', 'una', 'prueba', 'MUJER', 20000000, 'Guanajuato', 'Null', '239', 'hola', 'prueba soy?', 27, '2019-03-25', 1),
(21, 'Ira pues', 'andale', 'noteme', 'HOMBRE', 10, 'Baja California Sur', 'Null', '9863548', 'joma1998@hotmail.com', 'lora', 28, '2019-03-25', 1),
(22, 'Jose Manuel', 'Lora', 'Peinado', 'HOMBRE', 20, 'Sinaloa', 'Null', '9863548', 'joma1998@hotmail.com', 'Espero poder pasar', 29, '2019-03-27', 1);

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
(1, 'Primavera Invernal', 'Viaje por Mazamitla en la primavera, y paseo al parque de diversiones', 30, 42, 2400, 3, 2, 30, '2019-04-26', '2019-04-28', NULL, '2019-03-11', 1),
(2, 'Playopolis', 'Viaje por Cancún visitando sus hermosas playas y hospedaje en un hotel de 3 estrellas.', 30, 42, 6500, 4, 3, 30, '2019-07-19', '2019-07-22', NULL, '2019-03-11', 1),
(3, 'Viaje Magico', 'Viaje por Guanajuato visitando sus hermosas ruinas y saludando sus momias.hola.', 30, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes_destacados`
--

CREATE TABLE `viajes_destacados` (
  `id` int(11) NOT NULL COMMENT 'Identificador del registro',
  `id_viaje` int(11) DEFAULT NULL COMMENT 'Identificador del viaje marcado como favorito',
  `id_viajero` int(11) DEFAULT NULL COMMENT 'Identificador del viajero que marco el viaje',
  `tipo` int(11) DEFAULT NULL COMMENT 'Tipo de destamiento del viaje (0 Me encanta, 1 Me hubiera gustado)',
  `f_registro` date DEFAULT NULL COMMENT 'Fecha de registro',
  `status` int(1) DEFAULT NULL COMMENT 'Estado del registro (1 Marcado, 0 No Marcado)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `tipo_viaje`
--
ALTER TABLE `tipo_viaje`
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
-- AUTO_INCREMENT de la tabla `detalle_viajes`
--
ALTER TABLE `detalle_viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro';

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mensajes_grupos`
--
ALTER TABLE `mensajes_grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro';

--
-- AUTO_INCREMENT de la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del regsitro', AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT de la tabla `tipo_viaje`
--
ALTER TABLE `tipo_viaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del usuario', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `viajeros`
--
ALTER TABLE `viajeros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viajes_destacados`
--
ALTER TABLE `viajes_destacados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
