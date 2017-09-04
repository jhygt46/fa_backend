-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generaciÃ³n: 04-09-2017 a las 19:53:40
-- VersiÃ³n del servidor: 5.7.15-log
-- VersiÃ³n de PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fireapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actos`
--

CREATE TABLE `actos` (
  `id_act` int(4) NOT NULL,
  `id_cla` int(4) NOT NULL,
  `code` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `comuna` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `id_cia` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `actos`
--

INSERT INTO `actos` (`id_act`, `id_cla`, `code`, `direccion`, `comuna`, `lat`, `lng`, `fecha_creado`, `id_cia`, `id_cue`) VALUES
(1, 6, 'jstWsh78mdUa', 'Jose Tomas Rider 1185', 'Providencia', -33.45215139, -70.547158, '2017-12-06 06:00:00', 0, 1),
(2, 7, '', '', '', 0, 0, '2017-08-24 00:00:00', 1, 1),
(3, 7, '', '', '', 0, 0, '2017-08-25 00:00:00', 1, 1),
(4, 9, '', '', '', 0, 0, '2017-08-24 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actos_chat`
--

CREATE TABLE `actos_chat` (
  `id_chat` int(4) NOT NULL,
  `id_user` int(4) NOT NULL,
  `texto` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `id_act` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `actos_chat`
--

INSERT INTO `actos_chat` (`id_chat`, `id_user`, `texto`, `id_act`) VALUES
(1, 2, 'Wena Longi', 1),
(2, 1, 'Wena Recu', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actos_imagenes`
--

CREATE TABLE `actos_imagenes` (
  `id_img` int(4) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `id_act` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `actos_imagenes`
--

INSERT INTO `actos_imagenes` (`id_img`, `nombre`, `id_act`) VALUES
(1, 'KshafdjSjwdbs', 1),
(2, 'Ksjhpkdbs', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actos_user`
--

CREATE TABLE `actos_user` (
  `id_act` int(4) NOT NULL,
  `id_user` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(4) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `html` text COLLATE utf8_spanish2_ci NOT NULL,
  `iscia` tinyint(1) NOT NULL,
  `id_cia` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`id_blog`, `nombre`, `fecha`, `html`, `iscia`, `id_cia`, `id_cue`) VALUES
(1, 'Llamado de Comandancia', '2017-05-03 00:00:00', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_carg` int(4) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `iscia` tinyint(1) NOT NULL,
  `ismando` tinyint(1) NOT NULL,
  `ordermando` int(4) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `fecha_eliminado` date NOT NULL,
  `fecha_creado` date NOT NULL,
  `cantidad` int(4) NOT NULL,
  `id_cia` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_carg`, `nombre`, `iscia`, `ismando`, `ordermando`, `eliminado`, `fecha_eliminado`, `fecha_creado`, `cantidad`, `id_cia`, `id_cue`) VALUES
(1, 'Comandante', 0, 1, 1, 0, '0000-00-00', '0000-00-00', 1, 0, 1),
(2, 'Capitan', 1, 1, 2, 0, '0000-00-00', '0000-00-00', 0, 0, 1),
(5, 'Maquinista', 1, 0, 0, 0, '0000-00-00', '0000-00-00', 0, 0, 1),
(6, 'Ayudante del Ayudante de Maquinista', 1, 0, 0, 0, '0000-00-00', '2017-04-15', 0, 1, 1),
(7, 'Instructor de Brigadas', 1, 0, 0, 0, '0000-00-00', '2017-04-19', 1, 1, 1),
(8, 'SuperIntendente', 0, 0, 0, 0, '0000-00-00', '2017-04-19', 0, 0, 1),
(9, 'Teniente', 1, 1, 3, 0, '0000-00-00', '2017-04-19', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carros`
--

CREATE TABLE `carros` (
  `id_car` int(4) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `fecha_creado` date NOT NULL,
  `fecha_eliminado` date NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `enservicio` tinyint(1) NOT NULL,
  `encuartel` tinyint(1) NOT NULL,
  `id_cia` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `carros`
--

INSERT INTO `carros` (`id_car`, `nombre`, `eliminado`, `fecha_creado`, `fecha_eliminado`, `lat`, `lng`, `enservicio`, `encuartel`, `id_cia`, `id_cue`) VALUES
(1, 'B13', 0, '0000-00-00', '0000-00-00', -33.4339164, -70.62089850000001, 0, 1, 1, 1),
(2, 'BX13', 0, '0000-00-00', '0000-00-00', -33.4359164, -70.62189850000001, 0, 1, 1, 1),
(3, 'M13', 0, '0000-00-00', '2017-04-20', -33.4439164, -70.68089850000001, 0, 0, 1, 1),
(4, 'S13', 0, '2017-04-20', '2017-04-20', -33.4339164, -70.62089850000001, 0, 0, 0, 1),
(5, 'B16', 0, '2017-04-20', '0000-00-00', -33.4637892, -70.7022513, 0, 0, 9, 1),
(6, 'Q15', 0, '2017-04-26', '0000-00-00', -33.4080636, -70.54779710000003, 0, 0, 8, 1),
(7, 'S12', 0, '2017-08-20', '0000-00-00', 0, 0, 0, 0, 0, 1),
(8, 's11', 1, '2017-08-20', '2017-08-20', 0, 0, 0, 0, 0, 1),
(9, 'B14', 0, '2017-08-20', '0000-00-00', 0, 0, 0, 0, 2, 1),
(10, 'R14', 0, '2017-08-20', '0000-00-00', 0, 0, 0, 0, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carros_tipo`
--

CREATE TABLE `carros_tipo` (
  `id_car` int(4) NOT NULL,
  `id_tdc` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `carros_tipo`
--

INSERT INTO `carros_tipo` (`id_car`, `id_tdc`) VALUES
(1, 1),
(2, 1),
(5, 1),
(9, 1),
(3, 2),
(6, 2),
(2, 3),
(3, 3),
(7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claves`
--

CREATE TABLE `claves` (
  `id_cla` int(4) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `grupo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `grupo_nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `asist` tinyint(1) NOT NULL,
  `falta` tinyint(1) NOT NULL,
  `todos` tinyint(1) NOT NULL,
  `id_gru` int(4) NOT NULL,
  `iscia` tinyint(1) NOT NULL,
  `fecha_eliminado` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `id_cia` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `claves`
--

INSERT INTO `claves` (`id_cla`, `nombre`, `clave`, `grupo`, `grupo_nombre`, `tipo`, `asist`, `falta`, `todos`, `id_gru`, `iscia`, `fecha_eliminado`, `eliminado`, `id_cia`, `id_cue`) VALUES
(6, 'Dudo', 'Dudo', '', '', 3, 1, 1, 0, 5, 1, '2017-08-21 22:28:43', 0, 1, 1),
(7, 'Ejercicio', 'E', '', '', 3, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', 0, 0, 1),
(8, 'Llamado Estructural', '1', '', '', 1, 1, 0, 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 1),
(9, 'Ejercio General', 'E', '', '', 3, 1, 0, 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claves_carros`
--

CREATE TABLE `claves_carros` (
  `id_cla` int(4) NOT NULL,
  `id_car` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `claves_carros`
--

INSERT INTO `claves_carros` (`id_cla`, `id_car`) VALUES
(4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claves_tipo`
--

CREATE TABLE `claves_tipo` (
  `id_cla` int(4) NOT NULL,
  `id_tdc` int(4) NOT NULL,
  `cantidad` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clave_grupos`
--

CREATE TABLE `clave_grupos` (
  `id_cla` int(4) NOT NULL,
  `id_gru` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clave_grupos`
--

INSERT INTO `clave_grupos` (`id_cla`, `id_gru`) VALUES
(1, 1),
(2, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companias`
--

CREATE TABLE `companias` (
  `id_cia` int(4) NOT NULL,
  `numero` int(4) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_creado` date NOT NULL,
  `fecha_eliminado` date NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `orden` smallint(2) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `companias`
--

INSERT INTO `companias` (`id_cia`, `numero`, `lat`, `lng`, `nombre`, `fecha_creado`, `fecha_eliminado`, `eliminado`, `orden`, `id_cue`) VALUES
(1, 13, -33.4339164, -70.62089850000001, 'DecimoTercera', '0000-00-00', '0000-00-00', 0, 1, 1),
(2, 14, 0, 0, 'DecimoCuarta', '2017-04-20', '0000-00-00', 0, 0, 1),
(8, 15, 0, 0, 'DecimoQuinta', '2017-04-20', '2017-04-20', 0, 3, 1),
(9, 16, 0, 0, 'DecimoSexta', '2017-04-20', '0000-00-00', 0, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuerpos`
--

CREATE TABLE `cuerpos` (
  `id_cue` int(4) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `sigla` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_creado` date NOT NULL,
  `fecha_eliminado` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cuerpos`
--

INSERT INTO `cuerpos` (`id_cue`, `nombre`, `sigla`, `fecha_creado`, `fecha_eliminado`, `eliminado`) VALUES
(1, 'Cuerpo de Bomberos de Santiago', 'CBS', '0000-00-00', '0000-00-00 00:00:00', 0),
(2, 'Cuerpo de Bomberos de Concepcion', 'CBC', '0000-00-00', '2017-08-19 17:18:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuerpo_cias_despacho`
--

CREATE TABLE `cuerpo_cias_despacho` (
  `id_cue` int(4) NOT NULL,
  `id_cia` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cuerpo_cias_despacho`
--

INSERT INTO `cuerpo_cias_despacho` (`id_cue`, `id_cia`) VALUES
(1, 1),
(1, 8),
(1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grifos`
--

CREATE TABLE `grifos` (
  `id_gri` int(4) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_gru` int(4) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `iscargo` tinyint(4) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `fecha_eliminado` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `id_cia` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_gru`, `nombre`, `iscargo`, `fecha_creado`, `fecha_eliminado`, `eliminado`, `id_cia`, `id_cue`) VALUES
(1, 'Oficiales Generales', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 1),
(2, 'Oficiales', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 1),
(3, 'Buenas', 0, '2017-05-02 13:04:33', '2017-05-02 14:07:40', 0, 1, 1),
(4, 'Oficiales de Comandancia', 1, '2017-05-02 13:05:00', '2017-05-02 14:07:48', 1, 0, 1),
(5, 'Dudo', 0, '2017-08-21 15:32:34', '0000-00-00 00:00:00', 0, 1, 1),
(6, 'Cualquier Wea', 0, '2017-08-21 15:33:28', '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_cargos`
--

CREATE TABLE `grupos_cargos` (
  `id_gru` int(4) NOT NULL,
  `id_carg` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `grupos_cargos`
--

INSERT INTO `grupos_cargos` (`id_gru`, `id_carg`) VALUES
(1, 1),
(1, 8),
(2, 2),
(2, 9),
(3, 2),
(3, 5),
(3, 7),
(4, 2),
(4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_usuarios`
--

CREATE TABLE `grupos_usuarios` (
  `id_gru` int(4) NOT NULL,
  `id_user` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `grupos_usuarios`
--

INSERT INTO `grupos_usuarios` (`id_gru`, `id_user`) VALUES
(3, 1),
(5, 1),
(5, 2),
(6, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_per` int(4) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `fecha_eliminado` date NOT NULL,
  `fecha_creado` date NOT NULL,
  `id_cia` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_per`, `nombre`, `eliminado`, `fecha_eliminado`, `fecha_creado`, `id_cia`, `id_cue`) VALUES
(1, 'Voluntario', 0, '0000-00-00', '0000-00-00', 1, 1),
(2, 'Ayudante', 0, '0000-00-00', '0000-00-00', 1, 1),
(3, 'Telefonista', 0, '0000-00-00', '0000-00-00', 0, 1),
(4, 'Comandante', 0, '0000-00-00', '0000-00-00', 0, 1),
(5, 'Administrador', 0, '0000-00-00', '0000-00-00', 1, 1),
(10, 'Administrador', 0, '0000-00-00', '2017-04-19', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles_cargos`
--

CREATE TABLE `perfiles_cargos` (
  `id_per` int(4) NOT NULL,
  `id_carg` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `perfiles_cargos`
--

INSERT INTO `perfiles_cargos` (`id_per`, `id_carg`) VALUES
(3, 1),
(5, 2),
(10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles_tareas`
--

CREATE TABLE `perfiles_tareas` (
  `id_tar` int(4) NOT NULL,
  `id_per` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `perfiles_tareas`
--

INSERT INTO `perfiles_tareas` (`id_tar`, `id_per`) VALUES
(1, 5),
(2, 5),
(3, 5),
(4, 10),
(5, 10),
(6, 10),
(7, 10),
(8, 10),
(9, 10),
(10, 5),
(11, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles_usuarios`
--

CREATE TABLE `perfiles_usuarios` (
  `id_user` int(4) NOT NULL,
  `id_per` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `perfiles_usuarios`
--

INSERT INTO `perfiles_usuarios` (`id_user`, `id_per`) VALUES
(1, 5),
(1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tar` int(4) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `iscia` tinyint(1) NOT NULL,
  `grupo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `grupoorder` int(4) NOT NULL,
  `id_gtar` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tar`, `nombre`, `iscia`, `grupo`, `grupoorder`, `id_gtar`) VALUES
(1, 'Ingresar Usuarios', 1, 'Admin', 1, 1),
(2, 'Ingresar Cargos', 1, 'Admin', 1, 1),
(3, 'Ingresar Perfiles', 1, 'Admin', 1, 1),
(4, 'Ingresar Usuarios', 0, 'Admin', 2, 2),
(5, 'Ingresar Cargos', 0, 'Admin', 2, 2),
(6, 'Ingresar Perfiles', 0, 'Admin', 2, 2),
(7, 'Ingresar Compa&ntilde;ia', 0, 'Admin', 2, 2),
(8, 'Tipos de Maquinas', 0, 'Admin', 2, 2),
(9, 'Ingresar Carros', 0, 'Admin', 2, 2),
(10, 'ConfiguraciÃ³n Compania', 1, 'Admin', 1, 1),
(11, 'ConfiguraciÃ³n Cuerpo', 0, 'Admin', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_grupos`
--

CREATE TABLE `tareas_grupos` (
  `id_gtar` int(4) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `orden` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tareas_grupos`
--

INSERT INTO `tareas_grupos` (`id_gtar`, `nombre`, `orden`) VALUES
(1, 'Administracion Cia', 1),
(2, 'Ayudantes', 2),
(3, 'Comandante', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_grupo_cuerpo`
--

CREATE TABLE `tarea_grupo_cuerpo` (
  `id_gtar` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tarea_grupo_cuerpo`
--

INSERT INTO `tarea_grupo_cuerpo` (`id_gtar`, `id_cue`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_de_carros`
--

CREATE TABLE `tipos_de_carros` (
  `id_tdc` int(4) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `eliminado` int(4) NOT NULL,
  `fecha_creado` date NOT NULL,
  `fecha_eliminado` date NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipos_de_carros`
--

INSERT INTO `tipos_de_carros` (`id_tdc`, `nombre`, `descripcion`, `eliminado`, `fecha_creado`, `fecha_eliminado`, `id_cue`) VALUES
(1, 'Bomba B', '', 0, '0000-00-00', '0000-00-00', 1),
(2, 'Portalescala Q', '', 0, '0000-00-00', '0000-00-00', 1),
(3, 'Mecanica M', '', 0, '2017-04-20', '2017-04-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(4) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish2_ci NOT NULL,
  `code` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `intentos` smallint(2) NOT NULL,
  `fecha_creado` date NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `fecha_eliminado` date NOT NULL,
  `encuartel` tinyint(1) NOT NULL,
  `id_cia` int(4) NOT NULL,
  `id_cue` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nombre`, `correo`, `pass`, `code`, `intentos`, `fecha_creado`, `eliminado`, `fecha_eliminado`, `encuartel`, `id_cia`, `id_cue`) VALUES
(1, 'Diego Gomez Bs', 'diegomez13@hotmail.com', '', '', 0, '2017-01-10', 0, '0000-00-00', 0, 1, 1),
(2, 'Juan Perez', 'a@b.c', '', '', 0, '2017-04-14', 0, '2017-04-01', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_cargos`
--

CREATE TABLE `usuarios_cargos` (
  `id_ucar` int(4) NOT NULL,
  `id_carg` int(4) NOT NULL,
  `id_user` int(4) NOT NULL,
  `fecha_ini` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios_cargos`
--

INSERT INTO `usuarios_cargos` (`id_ucar`, `id_carg`, `id_user`, `fecha_ini`, `fecha_fin`, `fecha_creado`) VALUES
(1, 1, 1, '2015-10-19 02:00:00', '2017-11-17 02:00:00', '2017-04-25'),
(2, 1, 2, '2017-03-17 00:00:00', '2017-04-24 00:00:00', '2017-04-23'),
(5, 1, 1, '2017-04-24 00:00:00', '2017-04-25 00:00:00', '2017-04-21'),
(6, 2, 1, '2015-10-01 12:00:00', '2017-04-25 00:00:00', '2017-04-21'),
(8, 1, 2, '2017-04-25 00:00:00', '0000-00-00 00:00:00', '2017-04-25'),
(9, 2, 0, '1970-01-01 00:00:00', '1970-01-01 00:00:00', '2017-04-26'),
(10, 2, 2, '2017-04-25 00:00:00', '0000-00-00 00:00:00', '2017-04-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_cias`
--

CREATE TABLE `usuario_cias` (
  `id_user` int(4) NOT NULL,
  `id_cia` int(4) NOT NULL,
  `fecha_ini` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_cias`
--

INSERT INTO `usuario_cias` (`id_user`, `id_cia`, `fecha_ini`, `fecha_fin`) VALUES
(1, 1, '2017-01-01 00:00:00', '3017-06-22 00:00:00');

--
-- Ã�ndices para tablas volcadas
--

--
-- Indices de la tabla `actos`
--
ALTER TABLE `actos`
  ADD PRIMARY KEY (`id_act`);

--
-- Indices de la tabla `actos_chat`
--
ALTER TABLE `actos_chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indices de la tabla `actos_imagenes`
--
ALTER TABLE `actos_imagenes`
  ADD PRIMARY KEY (`id_img`);

--
-- Indices de la tabla `actos_user`
--
ALTER TABLE `actos_user`
  ADD PRIMARY KEY (`id_act`,`id_user`);

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_carg`);

--
-- Indices de la tabla `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id_car`),
  ADD KEY `id_cue` (`id_cue`);

--
-- Indices de la tabla `carros_tipo`
--
ALTER TABLE `carros_tipo`
  ADD PRIMARY KEY (`id_car`,`id_tdc`),
  ADD KEY `id_tdc` (`id_tdc`);

--
-- Indices de la tabla `claves`
--
ALTER TABLE `claves`
  ADD PRIMARY KEY (`id_cla`),
  ADD KEY `id_cue` (`id_cue`);

--
-- Indices de la tabla `claves_carros`
--
ALTER TABLE `claves_carros`
  ADD PRIMARY KEY (`id_cla`,`id_car`);

--
-- Indices de la tabla `claves_tipo`
--
ALTER TABLE `claves_tipo`
  ADD PRIMARY KEY (`id_cla`,`id_tdc`),
  ADD KEY `id_tdc` (`id_tdc`);

--
-- Indices de la tabla `clave_grupos`
--
ALTER TABLE `clave_grupos`
  ADD PRIMARY KEY (`id_cla`,`id_gru`);

--
-- Indices de la tabla `companias`
--
ALTER TABLE `companias`
  ADD PRIMARY KEY (`id_cia`),
  ADD KEY `id_cue` (`id_cue`);

--
-- Indices de la tabla `cuerpos`
--
ALTER TABLE `cuerpos`
  ADD PRIMARY KEY (`id_cue`);

--
-- Indices de la tabla `cuerpo_cias_despacho`
--
ALTER TABLE `cuerpo_cias_despacho`
  ADD PRIMARY KEY (`id_cue`,`id_cia`);

--
-- Indices de la tabla `grifos`
--
ALTER TABLE `grifos`
  ADD PRIMARY KEY (`id_gri`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_gru`);

--
-- Indices de la tabla `grupos_cargos`
--
ALTER TABLE `grupos_cargos`
  ADD PRIMARY KEY (`id_gru`,`id_carg`);

--
-- Indices de la tabla `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
  ADD PRIMARY KEY (`id_gru`,`id_user`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_per`);

--
-- Indices de la tabla `perfiles_cargos`
--
ALTER TABLE `perfiles_cargos`
  ADD PRIMARY KEY (`id_per`,`id_carg`);

--
-- Indices de la tabla `perfiles_tareas`
--
ALTER TABLE `perfiles_tareas`
  ADD PRIMARY KEY (`id_tar`,`id_per`);

--
-- Indices de la tabla `perfiles_usuarios`
--
ALTER TABLE `perfiles_usuarios`
  ADD PRIMARY KEY (`id_user`,`id_per`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tar`);

--
-- Indices de la tabla `tareas_grupos`
--
ALTER TABLE `tareas_grupos`
  ADD PRIMARY KEY (`id_gtar`);

--
-- Indices de la tabla `tarea_grupo_cuerpo`
--
ALTER TABLE `tarea_grupo_cuerpo`
  ADD PRIMARY KEY (`id_gtar`,`id_cue`);

--
-- Indices de la tabla `tipos_de_carros`
--
ALTER TABLE `tipos_de_carros`
  ADD PRIMARY KEY (`id_tdc`),
  ADD KEY `id_cue` (`id_cue`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `usuarios_cargos`
--
ALTER TABLE `usuarios_cargos`
  ADD PRIMARY KEY (`id_ucar`);

--
-- Indices de la tabla `usuario_cias`
--
ALTER TABLE `usuario_cias`
  ADD PRIMARY KEY (`id_user`,`id_cia`,`fecha_ini`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actos`
--
ALTER TABLE `actos`
  MODIFY `id_act` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `actos_chat`
--
ALTER TABLE `actos_chat`
  MODIFY `id_chat` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `actos_imagenes`
--
ALTER TABLE `actos_imagenes`
  MODIFY `id_img` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_carg` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `carros`
--
ALTER TABLE `carros`
  MODIFY `id_car` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `claves`
--
ALTER TABLE `claves`
  MODIFY `id_cla` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `companias`
--
ALTER TABLE `companias`
  MODIFY `id_cia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `cuerpos`
--
ALTER TABLE `cuerpos`
  MODIFY `id_cue` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `grifos`
--
ALTER TABLE `grifos`
  MODIFY `id_gri` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_gru` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_per` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tareas_grupos`
--
ALTER TABLE `tareas_grupos`
  MODIFY `id_gtar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipos_de_carros`
--
ALTER TABLE `tipos_de_carros`
  MODIFY `id_tdc` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios_cargos`
--
ALTER TABLE `usuarios_cargos`
  MODIFY `id_ucar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carros`
--
ALTER TABLE `carros`
  ADD CONSTRAINT `carros_ibfk_1` FOREIGN KEY (`id_cue`) REFERENCES `cuerpos` (`id_cue`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carros_tipo`
--
ALTER TABLE `carros_tipo`
  ADD CONSTRAINT `carros_tipo_ibfk_1` FOREIGN KEY (`id_car`) REFERENCES `carros` (`id_car`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carros_tipo_ibfk_2` FOREIGN KEY (`id_tdc`) REFERENCES `tipos_de_carros` (`id_tdc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `claves`
--
ALTER TABLE `claves`
  ADD CONSTRAINT `claves_ibfk_1` FOREIGN KEY (`id_cue`) REFERENCES `cuerpos` (`id_cue`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `claves_tipo`
--
ALTER TABLE `claves_tipo`
  ADD CONSTRAINT `claves_tipo_ibfk_1` FOREIGN KEY (`id_tdc`) REFERENCES `tipos_de_carros` (`id_tdc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `claves_tipo_ibfk_2` FOREIGN KEY (`id_cla`) REFERENCES `claves` (`id_cla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `companias`
--
ALTER TABLE `companias`
  ADD CONSTRAINT `companias_ibfk_1` FOREIGN KEY (`id_cue`) REFERENCES `cuerpos` (`id_cue`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipos_de_carros`
--
ALTER TABLE `tipos_de_carros`
  ADD CONSTRAINT `tipos_de_carros_ibfk_1` FOREIGN KEY (`id_cue`) REFERENCES `cuerpos` (`id_cue`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
