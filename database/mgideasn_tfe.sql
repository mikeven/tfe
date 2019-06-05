-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2019 a las 00:57:18
-- Versión del servidor: 5.7.11
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mgideasn_tfe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `tarea` varchar(45) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `motivo` varchar(45) DEFAULT NULL,
  `contacto` varchar(45) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `proposito_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

CREATE TABLE `objeto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(140) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `objeto`
--

INSERT INTO `objeto` (`id`, `nombre`, `creado`, `modificado`, `usuario_id`) VALUES
(1, 'O1', '2019-06-05 17:28:42', NULL, 1),
(2, 'O2', '2019-06-05 18:39:15', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposito`
--

CREATE TABLE `proposito` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `sujeto_objeto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` int(11) NOT NULL,
  `creado` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`id`, `creado`, `usuario_id`) VALUES
(1, '2019-06-05 18:51:10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sujeto`
--

CREATE TABLE `sujeto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(140) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sujeto`
--

INSERT INTO `sujeto` (`id`, `nombre`, `creado`, `modificado`, `usuario_id`) VALUES
(1, 'S1', '2019-06-05 17:28:28', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sujeto_objeto`
--

CREATE TABLE `sujeto_objeto` (
  `id` int(11) NOT NULL,
  `sujeto_id` int(11) NOT NULL,
  `objeto_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `sesion_id` int(11) NOT NULL,
  `creado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sujeto_objeto`
--

INSERT INTO `sujeto_objeto` (`id`, `sujeto_id`, `objeto_id`, `area_id`, `sesion_id`, `creado`) VALUES
(1, 1, 1, 7, 1, '2019-06-05 18:51:10'),
(2, 1, 1, 7, 1, '2019-06-05 18:55:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `creado` date DEFAULT NULL,
  `ultimo_ingreso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`, `creado`, `ultimo_ingreso`) VALUES
(1, 'Miguel Rangel', 'mikeven@gmail.com', '121212', '2019-06-05', '2019-06-05 17:07:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_actividad_proposito1_idx` (`proposito_id`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_area_usuario_idx` (`usuario_id`);

--
-- Indices de la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_objeto_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `proposito`
--
ALTER TABLE `proposito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proposito_sujeto_objeto1_idx` (`sujeto_objeto_id`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sesion_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `sujeto`
--
ALTER TABLE `sujeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sujeto_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `sujeto_objeto`
--
ALTER TABLE `sujeto_objeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sujeto_has_objeto_objeto1_idx` (`objeto_id`),
  ADD KEY `fk_sujeto_has_objeto_sujeto1_idx` (`sujeto_id`),
  ADD KEY `fk_sujeto_has_objeto_area1_idx` (`area_id`),
  ADD KEY `fk_sujeto_objeto_sesion1_idx` (`sesion_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proposito`
--
ALTER TABLE `proposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sujeto`
--
ALTER TABLE `sujeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sujeto_objeto`
--
ALTER TABLE `sujeto_objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
