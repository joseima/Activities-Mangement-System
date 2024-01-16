-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 18-05-2021 a las 12:08:39
-- Versión del servidor: 5.7.25
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `noubarris`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `nombre` varchar(50) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `dia` varchar(20) NOT NULL,
  `hora` time NOT NULL,
  `detalle` varchar(500) NOT NULL,
  `voluntario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`nombre`, `categoria`, `dia`, `hora`, `detalle`, `voluntario`) VALUES
('Apoyo en la cocina durante la comida', 'comida', 'Martes', '13:00:00', 'Hay carne halal en la nevera', ''),
('Apoyo en la comida', 'Comida', 'Miércoles', '13:00:00', 'Necesitamos un voluntario para colaborar en la comida', 'Meritxell Clavel'),
('Ayuda en la cena', 'Cena', 'Viernes', '20:00:00', 'Colaborar en la cocina con la cena. ', 'Ariadna Madrid'),
('Ayudamos en la cocina durante  la cena', 'cena', 'Lunes', '22:30:00', 'Tenemos ensalada de la comida', 'Ismael Ferreira'),
('Buscar almuerzo a proveduria', 'Comida', 'Viernes', '11:00:00', 'Necesitamos ayuda para traer la comida de proveduria', ''),
('Clases de Ingles', 'Taller', 'Jueves', '18:00:00', 'En la sala de informática', 'Ismael Ferreira'),
('Colaborar en la cena', 'Cena', 'Miércoles', '00:00:00', 'Colaborar con Sole en el comedor', ''),
('Encuentro de fraternidad', 'Taller', 'Domingo', '11:00:00', 'Encuentro de intercambio y trabajo grupal', 'Ariadna Madrid'),
('Equipo de jardineria', 'Taller', 'Jueves', '16:00:00', 'Mantenimiento de huerta de perejil y tomates', ''),
('Partido de Fútbol', 'Deportes', 'Sábado', '10:45:00', 'Jugamos en el patio contra el equipo de Aduana', ''),
('Taller de artes plasticas', 'taller', 'Miércoles', '10:00:00', 'Se realizarán pancartas para la fiesta de San Joan', ''),
('Tarde de Actividades Ludicas', 'Jornada', 'Lunes', '18:00:00', 'Nos encontramos en la biblioteca para una jornada de integración', 'Meritxell Clavel'),
('Visita al museo de Artes visuales', 'Paseo', 'Sábado', '17:20:00', 'Saldremos desde los deks del patio interno', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `titulo` varchar(66) NOT NULL,
  `texto` varchar(300) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`titulo`, `texto`, `fecha`) VALUES
('Cumpleaños de Patricia el sabado', 'Nos reunimos en la terminal del metro de Diagonal', '2021-05-29 21:00:00'),
('Necesitamos un voluntario para el paseo al museo', 'La tarjeta de la tarea esta creada en el panel. Quien pueda participar que se asigne el cupo', '2021-05-30 10:00:00'),
('Necesitamos un voluntario para el Taller de Jardineria', 'Pues Jordi no podrá venir. <br>\r\nCualquier interesado que se asigne la actividad', '2021-05-27 16:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `administrador` int(1) NOT NULL,
  `activo` int(1) NOT NULL,
  `telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `mail`, `administrador`, `activo`, `telefono`) VALUES
(1, 'Ismael Ferreira', 'password01', 'mail@web.es', 0, 1, 666666666),
(2, 'Montserrat Puig', 'admin123', 'adminmail@web.es', 1, 1, 555666777),
(3, 'Ariadna Madrid', 'password02', 'ariadnamail@web.es', 0, 1, 555676543),
(4, 'Meritxell Clavel', 'password03', 'mail@web.es', 0, 1, 443213456);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`titulo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
