-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2019 a las 01:21:13
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
  `proposito_id` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fecha_calendario` datetime NOT NULL,
  `fecha_prioridad` datetime NOT NULL,
  `fecha_agenda` datetime NOT NULL,
  `fecha_terminacion` datetime NOT NULL,
  `fecha_cancela` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `tipo`, `tarea`, `lugar`, `direccion`, `motivo`, `contacto`, `creado`, `modificado`, `proposito_id`, `estado`, `fecha_calendario`, `fecha_prioridad`, `fecha_agenda`, `fecha_terminacion`, `fecha_cancela`) VALUES
(1, 'g', 'Tarea 1', 'Lugar 1', 'Dir 1', '', '', '2019-06-06 01:36:09', NULL, 3, 'creada', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'e', 'Realizar entrada', '', '', '', '', '2019-06-06 01:44:07', NULL, 5, 'creada', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'l', '', '', '', 'Falla en puerta', 'Dr Carlos', '2019-06-06 01:44:36', NULL, 5, 'creada', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'g', 'Acto de presencia', 'Sede principal', 'Av Los Chaguaramos', '', '', '2019-06-06 01:46:47', NULL, 5, 'creada', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'l', '', '', '', 'Hacer madera', 'Carpintero', '2019-06-06 09:36:18', NULL, 6, 'prioridad', '0000-00-00 00:00:00', '2019-07-01 19:20:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'g', 'Arreglar la puerta', 'Caracas', 'Venezuela, La Castellana', '', '', '2019-06-06 09:37:15', NULL, 6, 'creada', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'g', 'Contactar servicio', 'Fumigaciones RTL', 'Av la Salle, 1era trasnv', '', '', '2019-07-01 18:06:20', NULL, 9, 'creada', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(1, 'O\'donell', '2019-06-05 17:28:42', '2019-06-12 17:48:07', 1),
(2, 'O\'donell 2', '2019-06-05 18:39:15', NULL, 1),
(3, 'Objeto 3', '2019-06-05 22:30:42', NULL, 1),
(4, 'Hotel', '2019-06-06 01:42:52', NULL, 1),
(5, 'Puerta', '2019-06-06 09:31:05', NULL, 1),
(6, 'Ventana', '2019-06-06 09:31:30', NULL, 1),
(7, 'Silla', '2019-06-12 16:59:43', NULL, 1),
(8, 'Focos', '2019-06-12 17:00:59', NULL, 1),
(9, 'Carburador', '2019-06-20 16:56:28', NULL, 1),
(10, 'Hielera', '2019-06-20 17:03:34', NULL, 1),
(11, 'Monedero', '2019-06-20 18:46:26', NULL, 1),
(12, 'Aproa', '2019-06-20 19:02:06', NULL, 1),
(13, 'Fundaciones', '2019-06-20 19:04:26', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `nombre` varchar(44) DEFAULT NULL,
  ` iso2` varchar(2) DEFAULT NULL,
  ` iso3` varchar(3) DEFAULT NULL,
  ` phone_code` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`nombre`, ` iso2`, ` iso3`, ` phone_code`) VALUES
('Afganistán', 'AF', 'AFG', '93'),
('Albania', 'AL', 'ALB', '355'),
('Alemania', 'DE', 'DEU', '49'),
('Algeria', 'DZ', 'DZA', '213'),
('Andorra', 'AD', 'AND', '376'),
('Angola', 'AO', 'AGO', '244'),
('Anguila', 'AI', 'AIA', '1 264'),
('Antártida', 'AQ', 'ATA', '672'),
('Antigua y Barbuda', 'AG', 'ATG', '1 268'),
('Antillas Neerlandesas', 'AN', 'ANT', '599'),
('Arabia Saudita', 'SA', 'SAU', '966'),
('Argentina', 'AR', 'ARG', '54'),
('Armenia', 'AM', 'ARM', '374'),
('Aruba', 'AW', 'ABW', '297'),
('Australia', 'AU', 'AUS', '61'),
('Austria', 'AT', 'AUT', '43'),
('Azerbayán', 'AZ', 'AZE', '994'),
('Bélgica', 'BE', 'BEL', '32'),
('Bahamas', 'BS', 'BHS', '1 242'),
('Bahrein', 'BH', 'BHR', '973'),
('Bangladesh', 'BD', 'BGD', '880'),
('Barbados', 'BB', 'BRB', '1 246'),
('Belice', 'BZ', 'BLZ', '501'),
('Benín', 'BJ', 'BEN', '229'),
('Bhután', 'BT', 'BTN', '975'),
('Bielorrusia', 'BY', 'BLR', '375'),
('Birmania', 'MM', 'MMR', '95'),
('Bolivia', 'BO', 'BOL', '591'),
('Bosnia y Herzegovina', 'BA', 'BIH', '387'),
('Botsuana', 'BW', 'BWA', '267'),
('Brasil', 'BR', 'BRA', '55'),
('Brunéi', 'BN', 'BRN', '673'),
('Bulgaria', 'BG', 'BGR', '359'),
('Burkina Faso', 'BF', 'BFA', '226'),
('Burundi', 'BI', 'BDI', '257'),
('Cabo Verde', 'CV', 'CPV', '238'),
('Camboya', 'KH', 'KHM', '855'),
('Camerún', 'CM', 'CMR', '237'),
('Canadá', 'CA', 'CAN', '1'),
('Chad', 'TD', 'TCD', '235'),
('Chile', 'CL', 'CHL', '56'),
('China', 'CN', 'CHN', '86'),
('Chipre', 'CY', 'CYP', '357'),
('Ciudad del Vaticano', 'VA', 'VAT', '39'),
('Colombia', 'CO', 'COL', '57'),
('Comoras', 'KM', 'COM', '269'),
('Congo', 'CG', 'COG', '242'),
('Congo', 'CD', 'COD', '243'),
('Corea del Norte', 'KP', 'PRK', '850'),
('Corea del Sur', 'KR', 'KOR', '82'),
('Costa de Marfil', 'CI', 'CIV', '225'),
('Costa Rica', 'CR', 'CRI', '506'),
('Croacia', 'HR', 'HRV', '385'),
('Cuba', 'CU', 'CUB', '53'),
('Dinamarca', 'DK', 'DNK', '45'),
('Dominica', 'DM', 'DMA', '1 767'),
('Ecuador', 'EC', 'ECU', '593'),
('Egipto', 'EG', 'EGY', '20'),
('El Salvador', 'SV', 'SLV', '503'),
('Emiratos Árabes Unidos', 'AE', 'ARE', '971'),
('Eritrea', 'ER', 'ERI', '291'),
('Eslovaquia', 'SK', 'SVK', '421'),
('Eslovenia', 'SI', 'SVN', '386'),
('España', 'ES', 'ESP', '34'),
('Estados Unidos de América', 'US', 'USA', '1'),
('Estonia', 'EE', 'EST', '372'),
('Etiopía', 'ET', 'ETH', '251'),
('Filipinas', 'PH', 'PHL', '63'),
('Finlandia', 'FI', 'FIN', '358'),
('Fiyi', 'FJ', 'FJI', '679'),
('Francia', 'FR', 'FRA', '33'),
('Gabón', 'GA', 'GAB', '241'),
('Gambia', 'GM', 'GMB', '220'),
('Georgia', 'GE', 'GEO', '995'),
('Ghana', 'GH', 'GHA', '233'),
('Gibraltar', 'GI', 'GIB', '350'),
('Granada', 'GD', 'GRD', '1 473'),
('Grecia', 'GR', 'GRC', '30'),
('Groenlandia', 'GL', 'GRL', '299'),
('Guadalupe', 'GP', 'GLP', ''),
('Guam', 'GU', 'GUM', '1 671'),
('Guatemala', 'GT', 'GTM', '502'),
('Guayana Francesa', 'GF', 'GUF', ''),
('Guernsey', 'GG', 'GGY', ''),
('Guinea', 'GN', 'GIN', '224'),
('Guinea Ecuatorial', 'GQ', 'GNQ', '240'),
('Guinea-Bissau', 'GW', 'GNB', '245'),
('Guyana', 'GY', 'GUY', '592'),
('Haití', 'HT', 'HTI', '509'),
('Honduras', 'HN', 'HND', '504'),
('Hong kong', 'HK', 'HKG', '852'),
('Hungría', 'HU', 'HUN', '36'),
('India', 'IN', 'IND', '91'),
('Indonesia', 'ID', 'IDN', '62'),
('Irán', 'IR', 'IRN', '98'),
('Irak', 'IQ', 'IRQ', '964'),
('Irlanda', 'IE', 'IRL', '353'),
('Isla Bouvet', 'BV', 'BVT', ''),
('Isla de Man', 'IM', 'IMN', '44'),
('Isla de Navidad', 'CX', 'CXR', '61'),
('Isla Norfolk', 'NF', 'NFK', ''),
('Islandia', 'IS', 'ISL', '354'),
('Islas Bermudas', 'BM', 'BMU', '1 441'),
('Islas Caimán', 'KY', 'CYM', '1 345'),
('Islas Cocos (Keeling)', 'CC', 'CCK', '61'),
('Islas Cook', 'CK', 'COK', '682'),
('Islas de Åland', 'AX', 'ALA', ''),
('Islas Feroe', 'FO', 'FRO', '298'),
('Islas Georgias del Sur y Sandwich del Sur', 'GS', 'SGS', ''),
('Islas Heard y McDonald', 'HM', 'HMD', ''),
('Islas Maldivas', 'MV', 'MDV', '960'),
('Islas Malvinas', 'FK', 'FLK', '500'),
('Islas Marianas del Norte', 'MP', 'MNP', '1 670'),
('Islas Marshall', 'MH', 'MHL', '692'),
('Islas Pitcairn', 'PN', 'PCN', '870'),
('Islas Salomón', 'SB', 'SLB', '677'),
('Islas Turcas y Caicos', 'TC', 'TCA', '1 649'),
('Islas Ultramarinas Menores de Estados Unidos', 'UM', 'UMI', ''),
('Islas Vírgenes Británicas', 'VG', 'VG', '1 284'),
('Islas Vírgenes de los Estados Unidos', 'VI', 'VIR', '1 340'),
('Israel', 'IL', 'ISR', '972'),
('Italia', 'IT', 'ITA', '39'),
('Jamaica', 'JM', 'JAM', '1 876'),
('Japón', 'JP', 'JPN', '81'),
('Jersey', 'JE', 'JEY', ''),
('Jordania', 'JO', 'JOR', '962'),
('Kazajistán', 'KZ', 'KAZ', '7'),
('Kenia', 'KE', 'KEN', '254'),
('Kirgizstán', 'KG', 'KGZ', '996'),
('Kiribati', 'KI', 'KIR', '686'),
('Kuwait', 'KW', 'KWT', '965'),
('Líbano', 'LB', 'LBN', '961'),
('Laos', 'LA', 'LAO', '856'),
('Lesoto', 'LS', 'LSO', '266'),
('Letonia', 'LV', 'LVA', '371'),
('Liberia', 'LR', 'LBR', '231'),
('Libia', 'LY', 'LBY', '218'),
('Liechtenstein', 'LI', 'LIE', '423'),
('Lituania', 'LT', 'LTU', '370'),
('Luxemburgo', 'LU', 'LUX', '352'),
('México', 'MX', 'MEX', '52'),
('Mónaco', 'MC', 'MCO', '377'),
('Macao', 'MO', 'MAC', '853'),
('Macedônia', 'MK', 'MKD', '389'),
('Madagascar', 'MG', 'MDG', '261'),
('Malasia', 'MY', 'MYS', '60'),
('Malawi', 'MW', 'MWI', '265'),
('Mali', 'ML', 'MLI', '223'),
('Malta', 'MT', 'MLT', '356'),
('Marruecos', 'MA', 'MAR', '212'),
('Martinica', 'MQ', 'MTQ', ''),
('Mauricio', 'MU', 'MUS', '230'),
('Mauritania', 'MR', 'MRT', '222'),
('Mayotte', 'YT', 'MYT', '262'),
('Micronesia', 'FM', 'FSM', '691'),
('Moldavia', 'MD', 'MDA', '373'),
('Mongolia', 'MN', 'MNG', '976'),
('Montenegro', 'ME', 'MNE', '382'),
('Montserrat', 'MS', 'MSR', '1 664'),
('Mozambique', 'MZ', 'MOZ', '258'),
('Namibia', 'NA', 'NAM', '264'),
('Nauru', 'NR', 'NRU', '674'),
('Nepal', 'NP', 'NPL', '977'),
('Nicaragua', 'NI', 'NIC', '505'),
('Niger', 'NE', 'NER', '227'),
('Nigeria', 'NG', 'NGA', '234'),
('Niue', 'NU', 'NIU', '683'),
('Noruega', 'NO', 'NOR', '47'),
('Nueva Caledonia', 'NC', 'NCL', '687'),
('Nueva Zelanda', 'NZ', 'NZL', '64'),
('Omán', 'OM', 'OMN', '968'),
('Países Bajos', 'NL', 'NLD', '31'),
('Pakistán', 'PK', 'PAK', '92'),
('Palau', 'PW', 'PLW', '680'),
('Palestina', 'PS', 'PSE', ''),
('Panamá', 'PA', 'PAN', '507'),
('Papúa Nueva Guinea', 'PG', 'PNG', '675'),
('Paraguay', 'PY', 'PRY', '595'),
('Perú', 'PE', 'PER', '51'),
('Polinesia Francesa', 'PF', 'PYF', '689'),
('Polonia', 'PL', 'POL', '48'),
('Portugal', 'PT', 'PRT', '351'),
('Puerto Rico', 'PR', 'PRI', '1'),
('Qatar', 'QA', 'QAT', '974'),
('Reino Unido', 'GB', 'GBR', '44'),
('República Centroafricana', 'CF', 'CAF', '236'),
('República Checa', 'CZ', 'CZE', '420'),
('República Dominicana', 'DO', 'DOM', '1 809'),
('Reunión', 'RE', 'REU', ''),
('Ruanda', 'RW', 'RWA', '250'),
('Rumanía', 'RO', 'ROU', '40'),
('Rusia', 'RU', 'RUS', '7'),
('Sahara Occidental', 'EH', 'ESH', ''),
('Samoa', 'WS', 'WSM', '685'),
('Samoa Americana', 'AS', 'ASM', '1 684'),
('San Bartolomé', 'BL', 'BLM', '590'),
('San Cristóbal y Nieves', 'KN', 'KNA', '1 869'),
('San Marino', 'SM', 'SMR', '378'),
('San Martín (Francia)', 'MF', 'MAF', '1 599'),
('San Pedro y Miquelón', 'PM', 'SPM', '508'),
('San Vicente y las Granadinas', 'VC', 'VCT', '1 784'),
('Santa Elena', 'SH', 'SHN', '290'),
('Santa Lucía', 'LC', 'LCA', '1 758'),
('Santo Tomé y Príncipe', 'ST', 'STP', '239'),
('Senegal', 'SN', 'SEN', '221'),
('Serbia', 'RS', 'SRB', '381'),
('Seychelles', 'SC', 'SYC', '248'),
('Sierra Leona', 'SL', 'SLE', '232'),
('Singapur', 'SG', 'SGP', '65'),
('Siria', 'SY', 'SYR', '963'),
('Somalia', 'SO', 'SOM', '252'),
('Sri lanka', 'LK', 'LKA', '94'),
('Sudáfrica', 'ZA', 'ZAF', '27'),
('Sudán', 'SD', 'SDN', '249'),
('Suecia', 'SE', 'SWE', '46'),
('Suiza', 'CH', 'CHE', '41'),
('Surinám', 'SR', 'SUR', '597'),
('Svalbard y Jan Mayen', 'SJ', 'SJM', ''),
('Swazilandia', 'SZ', 'SWZ', '268'),
('Tadjikistán', 'TJ', 'TJK', '992'),
('Tailandia', 'TH', 'THA', '66'),
('Taiwán', 'TW', 'TWN', '886'),
('Tanzania', 'TZ', 'TZA', '255'),
('Territorio Británico del Océano Índico', 'IO', 'IOT', ''),
('Territorios Australes y Antárticas Franceses', 'TF', 'ATF', ''),
('Timor Oriental', 'TL', 'TLS', '670'),
('Togo', 'TG', 'TGO', '228'),
('Tokelau', 'TK', 'TKL', '690'),
('Tonga', 'TO', 'TON', '676'),
('Trinidad y Tobago', 'TT', 'TTO', '1 868'),
('Tunez', 'TN', 'TUN', '216'),
('Turkmenistán', 'TM', 'TKM', '993'),
('Turquía', 'TR', 'TUR', '90'),
('Tuvalu', 'TV', 'TUV', '688'),
('Ucrania', 'UA', 'UKR', '380'),
('Uganda', 'UG', 'UGA', '256'),
('Uruguay', 'UY', 'URY', '598'),
('Uzbekistán', 'UZ', 'UZB', '998'),
('Vanuatu', 'VU', 'VUT', '678'),
('Venezuela', 'VE', 'VEN', '58'),
('Vietnam', 'VN', 'VNM', '84'),
('Wallis y Futuna', 'WF', 'WLF', '681'),
('Yemen', 'YE', 'YEM', '967'),
('Yibuti', 'DJ', 'DJI', '253'),
('Zambia', 'ZM', 'ZMB', '260'),
('Zimbabue', 'ZW', 'ZWE', '263');

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

--
-- Volcado de datos para la tabla `proposito`
--

INSERT INTO `proposito` (`id`, `descripcion`, `creado`, `modificado`, `sujeto_objeto_id`) VALUES
(1, 'Prop 1', '2019-06-05 23:36:43', NULL, 4),
(2, 'Prop 2', '2019-06-05 23:44:41', NULL, 4),
(3, 'Prop 3', '2019-06-05 23:44:51', NULL, 3),
(4, 'Prop 9', '2019-06-06 00:03:52', NULL, 5),
(5, 'Ir a habitación', '2019-06-06 01:43:34', NULL, 6),
(6, 'Arreglar bisagra', '2019-06-06 09:32:29', NULL, 7),
(7, 'Arreglar manilla', '2019-06-06 09:34:17', NULL, 7),
(8, 'Arreglar cerradura', '2019-06-06 09:35:16', NULL, 7),
(9, 'Remover polillas', '2019-07-01 18:05:41', NULL, 11);

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
(1, '2019-06-05 18:51:10', 1),
(2, '2019-06-05 21:47:26', 1),
(3, '2019-06-06 09:31:13', 1),
(4, '2019-06-12 16:25:21', 1),
(5, '2019-06-20 16:56:32', 1),
(6, '2019-06-20 17:00:26', 1),
(7, '2019-06-20 17:29:43', 1),
(8, '2019-06-20 18:45:17', 1),
(9, '2019-06-20 18:46:32', 1),
(10, '2019-06-20 18:54:34', 1),
(11, '2019-06-20 19:02:12', 1),
(12, '2019-06-20 19:03:03', 1),
(13, '2019-06-20 19:04:28', 1);

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
(1, 'Solenoide', '2019-06-05 17:28:28', '2019-06-12 17:47:15', 1),
(2, 'Habitación', '2019-06-06 09:30:50', NULL, 1),
(3, 'Suite', '2019-06-12 16:42:08', '2019-06-12 17:29:22', 1),
(4, 'Sótano', '2019-06-12 16:43:45', NULL, 1),
(5, 'Fiat UNO', '2019-06-20 16:56:10', NULL, 1),
(6, 'Veterinario', '2019-06-20 19:01:46', NULL, 1),
(7, 'Adiestrador', '2019-06-20 19:02:42', NULL, 1);

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
(2, 1, 1, 7, 1, '2019-06-05 18:55:09'),
(3, 1, 2, 12, 2, '2019-06-05 21:47:26'),
(4, 1, 3, 12, 2, '2019-06-05 22:30:47'),
(5, 1, 1, 12, 2, '2019-06-06 00:03:35'),
(6, 1, 4, 12, 2, '2019-06-06 01:42:59'),
(7, 2, 5, 3, 3, '2019-06-06 09:31:13'),
(8, 2, 6, 3, 3, '2019-06-06 09:31:33'),
(9, 2, 6, 6, 4, '2019-06-12 16:25:21'),
(10, 5, 9, 6, 5, '2019-06-20 16:56:32'),
(11, 2, 5, 8, 6, '2019-06-20 17:00:26'),
(12, 2, 10, 8, 6, '2019-06-20 17:03:38'),
(13, 1, 1, 6, 7, '2019-06-20 17:29:43'),
(14, 2, 3, 8, 6, '2019-06-20 17:51:34'),
(15, 2, 10, 6, 8, '2019-06-20 18:45:17'),
(16, 2, 11, 6, 9, '2019-06-20 18:46:32'),
(17, 2, 10, 3, 10, '2019-06-20 18:54:34'),
(18, 6, 12, 5, 11, '2019-06-20 19:02:12'),
(19, 7, 12, 5, 12, '2019-06-20 19:03:03'),
(20, 6, 13, 5, 13, '2019-06-20 19:04:28');

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
(1, 'Miguel Rangel', 'mikeven@gmail.com', '121212', '2019-06-05', '2019-07-01 17:33:42');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `proposito`
--
ALTER TABLE `proposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `sujeto`
--
ALTER TABLE `sujeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sujeto_objeto`
--
ALTER TABLE `sujeto_objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
