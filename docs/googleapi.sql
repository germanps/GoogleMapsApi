-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2017 a las 13:04:27
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `googleapi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(4, 'Bares'),
(5, 'Tiendas'),
(6, 'Musica'),
(7, 'Restaurantes'),
(8, 'Teatros'),
(9, 'Sitios de interes'),
(10, 'Viajes'),
(11, 'Museos'),
(12, 'Universidades');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcador`
--

CREATE TABLE `marcador` (
  `id_marcador` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `coox` float DEFAULT NULL,
  `cooy` float DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcador`
--

INSERT INTO `marcador` (`id_marcador`, `nombre`, `descripcion`, `coox`, `cooy`, `categoria`) VALUES
(4, 'El raval', 'Barrio del raval lorem ipsum dolor emet sit ', 41.3798, 2.16808, 6),
(5, 'Barrio gÃ³tico', 'Barrio gÃ³tico de barcelona', 41.3817, 2.17847, 9),
(6, 'El liceo', 'El gran teatro del Liceo de barcelona', 41.3808, 2.17624, 8),
(7, 'EstaciÃ³n de Sants', 'EstaciÃ³n de sants barcelona', 41.3803, 2.1419, 10),
(9, 'La illa diagonal', 'centro comercial barcelona', 41.388, 2.13967, 5),
(10, 'Museo Picaso', 'Museo Picaso de barcelona en el barrio gÃ³tico', 41.3849, 2.18199, 11),
(11, 'Museo de histÃ³ria de cataluÃ±a', 'Museo de histÃ³ria de cataluÃ±a en el palau del mar de barcelona', 41.3807, 2.18594, 11),
(12, 'Universidad Politecnica', 'Universidad Politecnica de CataluÃ±a Campus Nord', 41.388, 2.11324, 12),
(13, 'Sala Apolo', 'La Sala Apolo Ã©s un dels locals mÃ©s emblemÃ tics de la ciutat de Barcelona.', 41.3744, 2.16963, 4),
(14, 'La Flauta', 'Restaurante La Flatua carrer aribau 23', 41.3869, 2.16105, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `marcador`
--
ALTER TABLE `marcador`
  ADD PRIMARY KEY (`id_marcador`),
  ADD KEY `categoria` (`categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `marcador`
--
ALTER TABLE `marcador`
  MODIFY `id_marcador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `marcador`
--
ALTER TABLE `marcador`
  ADD CONSTRAINT `marcador_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id_categoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
