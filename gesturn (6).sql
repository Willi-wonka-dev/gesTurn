-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 14:07:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gesturn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones_turnos`
--

CREATE TABLE `asignaciones_turnos` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `clave` varchar(50) NOT NULL,
  `valor` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`clave`, `valor`) VALUES
('antelacion_cambio_turno', '2'),
('horario_laboral', '40'),
('max_horas_turno', '8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `festivos`
--

CREATE TABLE `festivos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `festivos`
--

INSERT INTO `festivos` (`id`, `fecha`, `descripcion`) VALUES
(3, '2024-10-01', 'sdfg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `fContrato` date NOT NULL,
  `fFinContrato` date NOT NULL,
  `dni` varchar(9) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `fNacimiento` date NOT NULL,
  `horas_semanales` int(11) NOT NULL DEFAULT 40,
  `acepta_horas_extra` tinyint(1) NOT NULL DEFAULT 0,
  `trabaja_festivos` tinyint(1) NOT NULL DEFAULT 0,
  `jornada_tipo` enum('completa','parcial') NOT NULL DEFAULT 'completa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido1`, `apellido2`, `email`, `telefono`, `foto`, `fContrato`, `fFinContrato`, `dni`, `direccion`, `fNacimiento`, `horas_semanales`, `acepta_horas_extra`, `trabaja_festivos`, `jornada_tipo`) VALUES
(1, 'Davida', 'Amadora', 'Moralesa', 'davidamador@davidamador.esa', 62511223, '', '2023-10-17', '2024-10-22', '52627178z', 'El pais de nunca jamas\r\ntercera estrella a la derec\r\n', '1999-06-23', 40, 0, 0, 'completa'),
(2, 'María', 'González', 'López', 'maria.gonzalez@email.com', 611223344, '', '2022-05-15', '2025-05-14', '12345678A', 'Calle Mayor 1, Madrid', '1990-03-20', 40, 0, 0, 'completa'),
(3, 'Juan', 'Martínez', 'García', 'juan.martinez@email.com', 622334455, '', '2023-01-10', '2026-01-09', '23456789B', 'Avenida Libertad 23, Barcelona', '1985-07-12', 40, 0, 0, 'completa'),
(4, 'Ana', 'Fernández', 'Ruiz', 'ana.fernandez@email.com', 633445566, '', '2021-11-01', '2024-10-31', '34567890C', 'Plaza España 5, Sevilla', '1992-12-05', 40, 0, 0, 'completa'),
(5, 'Carlos', 'López', 'Sánchez', 'carlos.lopez@email.com', 644556677, '', '2023-09-01', '2026-08-31', '45678901D', 'Calle Sol 8, Valencia', '1988-09-18', 40, 0, 0, 'completa'),
(6, 'Laura', 'Pérez', 'Gómez', 'laura.perez@email.com', 655667788, '', '2022-07-20', '2025-07-19', '56789012E', 'Paseo de la Castellana 100, Madrid', '1995-01-30', 40, 0, 0, 'completa'),
(7, 'daamaa2222', 'adfñlasdfñl', 'asñldfañsfl', 'asdfasf@alsdkfasld.com', 656565654, NULL, '2024-10-28', '2024-10-27', '52000000z', 'aalifjasldfk', '2024-10-15', 40, 0, 0, 'completa'),
(11, 'Jose', 'perez', 'koko', 'yicip74022@angewy.com', 111, '', '2024-10-24', '0000-00-00', '52000000', 'Esta es mi direccion', '2024-10-29', 40, 0, 0, 'completa'),
(22, 'Maria', 'Del monte', 'No se que', 'yicip74022@angewy.com', 923112233, '', '0000-00-00', '0000-00-00', '12345678A', 'En su casa', '0000-00-00', 40, 0, 0, 'completa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias_horarias`
--

CREATE TABLE `preferencias_horarias` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `dia_semana` enum('lunes','martes','miercoles','jueves','viernes','sabado','domingo') NOT NULL,
  `preferencia` enum('mañana','tarde','noche','no_disponible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `inicio` time NOT NULL,
  `fin` time NOT NULL,
  `personas_requeridas` int(11) NOT NULL DEFAULT 0,
  `horas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `nombre`, `inicio`, `fin`, `personas_requeridas`, `horas`) VALUES
(1, 'Turno de mañana', '08:00:00', '14:00:00', 2, 8),
(3, 'Turno de Tarde', '14:00:00', '22:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `idp` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `idp`, `admin`) VALUES
(1, 'admin', '1234', 1, 1),
(2, 'maria.g', 'pass1234', 2, 0),
(3, 'juan.m', 'pass5678', 3, 0),
(5, 'carlos.l', 'pass3456', 5, 0),
(6, 'laura.p', 'pass7890', 6, 1),
(7, 'pepe', 'pepe', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` enum('solicitado','aprobado','rechazado') NOT NULL DEFAULT 'solicitado',
  `dias` int(11) NOT NULL,
  `aprobado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`id`, `persona_id`, `fecha_inicio`, `fecha_fin`, `estado`, `dias`, `aprobado_por`) VALUES
(2, 3, '2024-10-21', '2024-11-03', 'rechazado', 0, NULL),
(3, 2, '2024-07-01', '2024-07-15', 'aprobado', 0, NULL),
(5, 4, '2024-12-20', '2025-01-05', 'aprobado', 0, NULL),
(6, 5, '2024-06-15', '2024-06-30', 'rechazado', 0, NULL),
(7, 6, '2024-09-01', '2024-09-14', 'rechazado', 0, NULL),
(8, 2, '2024-12-01', '2024-12-10', 'solicitado', 0, NULL),
(9, 3, '2025-01-15', '2025-01-30', 'aprobado', 0, NULL),
(10, 4, '2024-11-01', '2024-11-15', 'solicitado', 0, NULL),
(11, 1, '2024-10-21', '2024-10-27', '', 0, NULL),
(12, 11, '2024-10-28', '2024-10-31', 'rechazado', 0, NULL),
(13, 1, '2024-10-21', '2024-11-04', 'solicitado', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones_turnos`
--
ALTER TABLE `asignaciones_turnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persona_id` (`persona_id`,`fecha`),
  ADD KEY `turno_id` (`turno_id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `festivos`
--
ALTER TABLE `festivos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preferencias_horarias`
--
ALTER TABLE `preferencias_horarias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persona_id` (`persona_id`,`dia_semana`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `aprobado_por` (`aprobado_por`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones_turnos`
--
ALTER TABLE `asignaciones_turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `festivos`
--
ALTER TABLE `festivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `preferencias_horarias`
--
ALTER TABLE `preferencias_horarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones_turnos`
--
ALTER TABLE `asignaciones_turnos`
  ADD CONSTRAINT `asignaciones_turnos_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `asignaciones_turnos_ibfk_2` FOREIGN KEY (`turno_id`) REFERENCES `turnos` (`id`);

--
-- Filtros para la tabla `preferencias_horarias`
--
ALTER TABLE `preferencias_horarias`
  ADD CONSTRAINT `preferencias_horarias_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`aprobado_por`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
