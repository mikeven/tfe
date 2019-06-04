-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2019 a las 08:57:12
-- Versión del servidor: 5.6.15-log
-- Versión de PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mgideasn_tfe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `tarea` varchar(45) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `motivo` varchar(45) DEFAULT NULL,
  `contacto` varchar(45) DEFAULT NULL,
  `proposito_id` int(11) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proposito_id` (`proposito_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `nombre`, `creado`, `modificado`, `usuario_id`) VALUES
(1, 'Familia', '2019-05-27 16:55:01', NULL, 1),
(2, 'Trabajo', '2019-05-27 16:55:05', NULL, 1),
(3, 'Hogar', '2019-05-27 16:55:09', NULL, 1),
(4, 'Salud', '2019-05-27 16:55:22', NULL, 1),
(5, 'Mascotas', '2019-05-27 16:55:46', NULL, 1),
(6, 'Automóvil', '2019-05-27 16:55:51', NULL, 1),
(7, 'Hobbies', '2019-05-27 16:55:59', NULL, 1),
(8, 'Entretenimiento', '2019-05-27 16:56:05', NULL, 1),
(9, 'Imagen Personal', '2019-05-27 16:56:16', NULL, 1),
(10, 'Hábitos', '2019-05-27 16:56:20', NULL, 1),
(11, 'Mejoramiento Profesional', '2019-05-27 16:56:44', NULL, 1),
(12, 'Mejoramiento Personal', '2019-05-27 16:57:26', NULL, 1),
(14, 'Proyectos', '2019-05-27 16:57:39', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_sujeto`
--

CREATE TABLE IF NOT EXISTS `area_sujeto` (
  `area_id` int(11) NOT NULL,
  `sujeto_id` int(11) NOT NULL,
  PRIMARY KEY (`area_id`,`sujeto_id`),
  KEY `fk_area_has_sujeto_sujeto1` (`sujeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeto`
--

CREATE TABLE IF NOT EXISTS `objeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(140) NOT NULL,
  `sujeto_id` int(11) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sujeto_id` (`sujeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposito`
--

CREATE TABLE IF NOT EXISTS `proposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `objeto_id` int(11) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `objeto_id` (`objeto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sujeto`
--

CREATE TABLE IF NOT EXISTS `sujeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `sujeto`
--

INSERT INTO `sujeto` (`id`, `nombre`, `creado`, `modificado`) VALUES
(1, 'Dainca', '2019-05-31 01:43:26', NULL),
(2, 'Fiesta', '2019-05-31 01:59:43', NULL),
(3, 'S3', '2019-06-04 00:54:37', NULL),
(4, 'S4', '2019-06-04 00:58:01', NULL),
(5, 'S5', '2019-06-04 01:00:24', NULL),
(6, 'S6', '2019-06-04 01:10:09', NULL),
(7, 'S7', '2019-06-04 01:11:43', NULL),
(8, 'S8', '2019-06-04 01:12:49', NULL),
(9, 'S9', '2019-06-04 01:21:05', NULL),
(10, 'S10', '2019-06-04 01:27:14', NULL),
(11, 'S11', '2019-06-04 01:28:10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `creado` date DEFAULT NULL,
  `ultimo_ingreso` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`, `creado`, `ultimo_ingreso`) VALUES
(1, 'Miguel', 'mikeven@gmail.com', '121212', '2019-05-30', '2019-06-03 20:41:19');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `proposito_id` FOREIGN KEY (`proposito_id`) REFERENCES `proposito` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `area_sujeto`
--
ALTER TABLE `area_sujeto`
  ADD CONSTRAINT `fk_area_has_sujeto_area1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_area_has_sujeto_sujeto1` FOREIGN KEY (`sujeto_id`) REFERENCES `sujeto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `sujeto_id` FOREIGN KEY (`sujeto_id`) REFERENCES `sujeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proposito`
--
ALTER TABLE `proposito`
  ADD CONSTRAINT `objeto_id` FOREIGN KEY (`objeto_id`) REFERENCES `objeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
