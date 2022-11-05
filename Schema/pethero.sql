-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2022 a las 23:53:36
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pethero`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_add` (`idUser_` INT, `idPetType_` INT, `name_` VARCHAR(20), `breed_` VARCHAR(20), `size_` VARCHAR(20), `description_` VARCHAR(80), `isActive_` BOOL)   begin
	insert into Pets (idUser, idPetType, name, breed, size, description, isActive) values (idUser_, idPetType_, name_, breed_, size_, description_, isActive_);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getAll` ()   begin
	select * from Pets;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getById` (`pet_id` INT)   begin
	select * from Pets where id=pet_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getListByUserId` (`user_id` INT)   begin
	select * from Pets where idUser=user_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_add` (`name` VARCHAR(10))   begin
	insert into PetTypes(name) values (name);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getAll` ()   begin
	select * from PetTypes;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getById` (`idPetType` INT)   begin
	select * from PetTypes where id=idPetType;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keepers`
--

CREATE TABLE `keepers` (
  `keeperId` int(4) NOT NULL,
  `userId` int(4) NOT NULL,
  `addressStreet` varchar(45) NOT NULL,
  `addressNumber` varchar(5) NOT NULL,
  `petSize` varchar(45) NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `days` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPetType` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `breed` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `size` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `photoId` int(5) NOT NULL,
  `vaccinesPhotoId` int(5) NOT NULL,
  `videoId` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pets`
--

INSERT INTO `pets` (`id`, `idUser`, `idPetType`, `name`, `breed`, `size`, `description`, `photoId`, `vaccinesPhotoId`, `videoId`, `isActive`) VALUES
(7, 1, 1, 'pitufo', 'boxer', 'Big', 'ta juerte', 0, 0, 0, 1),
(8, 1, 2, 'ceniza', 'gris', 'Medium', 'beio gato', 0, 0, 0, 1),
(9, 2, 1, 'perrinio', 'bulldog', 'Medium', 'de malo la cara', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pettypes`
--

CREATE TABLE `pettypes` (
  `id` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pettypes`
--

INSERT INTO `pettypes` (`id`, `name`) VALUES
(1, 'Dog'),
(2, 'Cat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `keepers`
--
ALTER TABLE `keepers`
  ADD PRIMARY KEY (`keeperId`),
  ADD KEY `userIDIndex` (`userId`);

--
-- Indices de la tabla `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPetType` (`idPetType`),
  ADD KEY `photoId` (`photoId`),
  ADD KEY `vaccinesPhotoId` (`vaccinesPhotoId`),
  ADD KEY `videoId` (`videoId`);

--
-- Indices de la tabla `pettypes`
--
ALTER TABLE `pettypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `keepers`
--
ALTER TABLE `keepers`
  MODIFY `keeperId` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pettypes`
--
ALTER TABLE `pettypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`idPetType`) REFERENCES `pettypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
