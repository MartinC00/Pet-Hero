-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-11-2022 a las 18:41:47
-- Versión del servidor: 5.7.36
-- Versión de PHP: 8.1.0

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
DROP PROCEDURE IF EXISTS `Pets_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_add` (`idUser_` INT, `idPetType_` INT, `name_` VARCHAR(20), `breed_` VARCHAR(20), `size_` VARCHAR(20), `description_` VARCHAR(80), `isActive_` BOOL)  begin
	insert into Pets (idUser, idPetType, name, breed, size, description, isActive) values (idUser_, idPetType_, name_, breed_, size_, description_, isActive_);
end$$

DROP PROCEDURE IF EXISTS `Pets_getAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getAll` ()  begin
	select * from Pets;
end$$

DROP PROCEDURE IF EXISTS `Pets_getById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getById` (`pet_id` INT)  begin
	select * from Pets where id=pet_id;
end$$

DROP PROCEDURE IF EXISTS `Pets_getListByUserId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getListByUserId` (`user_id` INT)  begin
	select * from Pets where idUser=user_id;
end$$

DROP PROCEDURE IF EXISTS `PetTypes_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_add` (`name` VARCHAR(10))  begin
	insert into PetTypes(name) values (name);
end$$

DROP PROCEDURE IF EXISTS `PetTypes_getAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getAll` ()  begin
	select * from PetTypes;
end$$

DROP PROCEDURE IF EXISTS `PetTypes_getById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getById` (`idPetType` INT)  begin
	select * from PetTypes where id=idPetType;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pets`
--

DROP TABLE IF EXISTS `pets`;
CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idPetType` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `breed` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `size` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pets`
--

INSERT INTO `pets` (`id`, `idUser`, `idPetType`, `name`, `breed`, `size`, `description`, `isActive`) VALUES
(7, 1, 1, 'pitufo', 'boxer', 'Big', 'ta juerte', 1),
(8, 1, 2, 'ceniza', 'gris', 'Medium', 'beio gato', 1),
(9, 2, 1, 'perrinio', 'bulldog', 'Medium', 'de malo la cara', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pettypes`
--

DROP TABLE IF EXISTS `pettypes`;
CREATE TABLE IF NOT EXISTS `pettypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pettypes`
--

INSERT INTO `pettypes` (`id`, `name`) VALUES
(1, 'Dog'),
(2, 'Cat');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
