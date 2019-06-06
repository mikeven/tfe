-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2019 a las 07:53:59
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
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `proposito_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_actividad_proposito1_idx` (`proposito_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `tipo`, `tarea`, `lugar`, `direccion`, `motivo`, `contacto`, `creado`, `modificado`, `proposito_id`) VALUES
(1, 'g', 'Tarea 1', 'Lugar 1', 'Dir 1', '', '', '2019-06-06 01:36:09', NULL, 3),
(2, 'e', 'Realizar entrada', '', '', '', '', '2019-06-06 01:44:07', NULL, 5),
(3, 'l', '', '', '', 'Falla en puerta', 'Dr Carlos', '2019-06-06 01:44:36', NULL, 5),
(4, 'g', 'Acto de presencia', 'Sede principal', 'Av Los Chaguaramos', '', '', '2019-06-06 01:46:47', NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_area_usuario_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

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
-- Estructura de tabla para la tabla `objeto`
--

CREATE TABLE IF NOT EXISTS `objeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_objeto_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `objeto`
--

INSERT INTO `objeto` (`id`, `nombre`, `creado`, `modificado`, `usuario_id`) VALUES
(1, 'O1', '2019-06-05 17:28:42', NULL, 1),
(2, 'O2', '2019-06-05 18:39:15', NULL, 1),
(3, 'Objeto 3', '2019-06-05 22:30:42', NULL, 1),
(4, 'Hotel', '2019-06-06 01:42:52', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposito`
--

CREATE TABLE IF NOT EXISTS `proposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `sujeto_objeto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proposito_sujeto_objeto1_idx` (`sujeto_objeto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `proposito`
--

INSERT INTO `proposito` (`id`, `descripcion`, `creado`, `modificado`, `sujeto_objeto_id`) VALUES
(1, 'Prop 1', '2019-06-05 23:36:43', NULL, 4),
(2, 'Prop 2', '2019-06-05 23:44:41', NULL, 4),
(3, 'Prop 3', '2019-06-05 23:44:51', NULL, 3),
(4, 'Prop 9', '2019-06-06 00:03:52', NULL, 5),
(5, 'Ir a habitación', '2019-06-06 01:43:34', NULL, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE IF NOT EXISTS `sesion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creado` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sesion_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`id`, `creado`, `usuario_id`) VALUES
(1, '2019-06-05 18:51:10', 1),
(2, '2019-06-05 21:47:26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sujeto`
--

CREATE TABLE IF NOT EXISTS `sujeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sujeto_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `sujeto`
--

INSERT INTO `sujeto` (`id`, `nombre`, `creado`, `modificado`, `usuario_id`) VALUES
(1, 'S1', '2019-06-05 17:28:28', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sujeto_objeto`
--

CREATE TABLE IF NOT EXISTS `sujeto_objeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujeto_id` int(11) NOT NULL,
  `objeto_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `sesion_id` int(11) NOT NULL,
  `creado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sujeto_has_objeto_objeto1_idx` (`objeto_id`),
  KEY `fk_sujeto_has_objeto_sujeto1_idx` (`sujeto_id`),
  KEY `fk_sujeto_has_objeto_area1_idx` (`area_id`),
  KEY `fk_sujeto_objeto_sesion1_idx` (`sesion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `sujeto_objeto`
--

INSERT INTO `sujeto_objeto` (`id`, `sujeto_id`, `objeto_id`, `area_id`, `sesion_id`, `creado`) VALUES
(1, 1, 1, 7, 1, '2019-06-05 18:51:10'),
(2, 1, 1, 7, 1, '2019-06-05 18:55:09'),
(3, 1, 2, 12, 2, '2019-06-05 21:47:26'),
(4, 1, 3, 12, 2, '2019-06-05 22:30:47'),
(5, 1, 1, 12, 2, '2019-06-06 00:03:35'),
(6, 1, 4, 12, 2, '2019-06-06 01:42:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `creado` date DEFAULT NULL,
  `ultimo_ingreso` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`, `creado`, `ultimo_ingreso`) VALUES
(1, 'Miguel Rangel', 'mikeven@gmail.com', '121212', '2019-06-05', '2019-06-05 21:47:03');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `fk_actividad_proposito1` FOREIGN KEY (`proposito_id`) REFERENCES `proposito` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `fk_area_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `fk_objeto_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proposito`
--
ALTER TABLE `proposito`
  ADD CONSTRAINT `fk_proposito_sujeto_objeto1` FOREIGN KEY (`sujeto_objeto_id`) REFERENCES `sujeto_objeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `fk_sesion_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sujeto`
--
ALTER TABLE `sujeto`
  ADD CONSTRAINT `fk_sujeto_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sujeto_objeto`
--
ALTER TABLE `sujeto_objeto`
  ADD CONSTRAINT `fk_sujeto_objeto_area1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sujeto_objeto_objeto1` FOREIGN KEY (`objeto_id`) REFERENCES `objeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sujeto_objeto_sesion1` FOREIGN KEY (`sesion_id`) REFERENCES `sesion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sujeto_objeto_sujeto1` FOREIGN KEY (`sujeto_id`) REFERENCES `sujeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
