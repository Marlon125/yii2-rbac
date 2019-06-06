-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2019 a las 23:26:09
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rbac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules_list`
--

CREATE TABLE `modules_list` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(100) DEFAULT NULL,
  `controller` varchar(50) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modules_list`
--

INSERT INTO `modules_list` (`module_id`, `module_name`, `controller`, `icon`, `is_active`) VALUES
(1, 'Roles', 'role', 'fa-user-secret', 1),
(2, 'Admins', 'admin', 'fa-user', 1),
(3, 'Languages', 'languages', 'fa-language', 1),
(4, 'Country Lists', 'country-list', 'fa-globe', 1),
(5, 'Genre Masters', 'genre-master', 'fa-magic', 1),
(6, 'Channel List', 'channel-list', 'fa-tv', 1),
(7, 'Series List', 'series-list', 'fa-camera-retro', 1),
(8, 'Video List', 'video-list', 'fa-video-camera', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_module_permission`
--

CREATE TABLE `role_module_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `new` tinyint(4) NOT NULL COMMENT 'CREATE',
  `view` tinyint(4) NOT NULL COMMENT 'READ',
  `save` tinyint(4) NOT NULL COMMENT 'UPDATE',
  `remove` tinyint(4) NOT NULL COMMENT 'DELETE',
  `added_at` datetime DEFAULT NULL,
  `added_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `role_module_permission`
--

INSERT INTO `role_module_permission` (`id`, `role_id`, `module_id`, `new`, `view`, `save`, `remove`, `added_at`, `added_by`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2019-05-29 22:31:55', '1'),
(4, 1, 4, 1, 1, 1, 1, '2019-05-29 22:31:55', '1'),
(5, 1, 5, 1, 1, 1, 1, '2019-05-29 22:31:55', '1'),
(6, 1, 6, 1, 1, 1, 1, '2019-05-29 22:31:55', '1'),
(7, 1, 7, 0, 1, 0, 0, '2019-05-29 22:31:55', '1'),
(9, 2, 4, 1, 1, 0, 0, '2017-06-21 08:40:51', '1'),
(10, 2, 5, 1, 1, 0, 0, '2017-06-21 08:40:51', '1'),
(11, 2, 6, 0, 1, 0, 0, '2017-06-21 08:40:51', '1'),
(12, 2, 7, 0, 1, 0, 0, '2017-06-21 08:40:51', '1'),
(13, 2, 8, 0, 1, 0, 0, '2017-06-21 08:40:51', '1'),
(14, 1, 3, 0, 1, 0, 0, '2019-05-29 22:31:55', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_types`
--

CREATE TABLE `role_types` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `role_types`
--

INSERT INTO `role_types` (`role_id`, `role_name`, `is_active`) VALUES
(1, 'Admin', 1),
(2, 'Moderate', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(250) NOT NULL,
  `authKey` varchar(250) NOT NULL,
  `password_reset_token` varchar(250) NOT NULL,
  `user_image` varchar(500) NOT NULL,
  `user_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `phone_number`, `username`, `email`, `password`, `authKey`, `password_reset_token`, `user_image`, `user_level`) VALUES
(1, 'admin', 'admin', '', 'admin', 'prakash@keyslab.com', '21232f297a57a5a743894a0e4a801fc3', '54321', '', '', 1),
(2, 'Prakash', 'Prakash', 'Prakash', 'moderate', 'prakashsmartt@gmail.com', '7f0217cdcdd58ba86aae84d9d3d79f81', '', '', '', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modules_list`
--
ALTER TABLE `modules_list`
  ADD PRIMARY KEY (`module_id`);

--
-- Indices de la tabla `role_module_permission`
--
ALTER TABLE `role_module_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_module_id_idx` (`module_id`),
  ADD KEY `fk_role_id_idx` (`role_id`);

--
-- Indices de la tabla `role_types`
--
ALTER TABLE `role_types`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modules_list`
--
ALTER TABLE `modules_list`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `role_module_permission`
--
ALTER TABLE `role_module_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `role_types`
--
ALTER TABLE `role_types`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `role_module_permission`
--
ALTER TABLE `role_module_permission`
  ADD CONSTRAINT `fk_module_id` FOREIGN KEY (`module_id`) REFERENCES `modules_list` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role_types` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_level`) REFERENCES `role_types` (`role_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
