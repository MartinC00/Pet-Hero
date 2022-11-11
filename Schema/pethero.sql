-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-11-2022 a las 20:08:07
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
DROP PROCEDURE IF EXISTS `keepers_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `keepers_add` (`userId_` INT, `addressStreet_` VARCHAR(45), `addressNumber_` VARCHAR(5), `petSize_` VARCHAR(10), `initialDate_` DATE, `endDate_` DATE, `days_` VARCHAR(60), `price_` INT(5))  begin
  insert into keepers (userId,addressStreet,addressNumber,petSize,initialDate,endDate,days,price) 
    VALUES (userId_,addressStreet_,addressNumber_,petSize_,initialDate_,endDate_,days_,price_);
end$$

DROP PROCEDURE IF EXISTS `keepers_modify`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `keepers_modify` (`keeperId_` INT, `userId_` INT, `addressStreet_` VARCHAR(45), `addressNumber_` VARCHAR(5), `petSize_` VARCHAR(10), `initialDate_` DATE, `endDate_` DATE, `days_` VARCHAR(60), `price_` INT(5))  begin
  update keepers set 
      userId=userId_, addressStreet=addressStreet_ , addressNumber=addressNumber_ , petSize=petSize_, initialDate=initialDate_, endDate=endDate_ , days=days_ , price=price_
  where keeperId=keeperId_;
end$$

DROP PROCEDURE IF EXISTS `Pets_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_add` (`idUser_` INT, `idPetType_` INT, `name_` VARCHAR(20), `breed_` VARCHAR(20), `size_` VARCHAR(10), `description_` VARCHAR(80), `photo_` VARCHAR(30), `vaccines_` VARCHAR(30), `video_` VARCHAR(30), `isActive_` BOOLEAN)  begin
  insert into Pets (idUser, idPetType, name, breed, size, description, photo, vaccines, video, isActive) values (idUser_, idPetType_, name_, breed_, size_, description_, photo_, vaccines_, video_, isActive_);
    select LAST_INSERT_ID() from Pets;
end$$

DROP PROCEDURE IF EXISTS `Pets_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_delete` (`idPet` INT)  begin
  update pets set 
    isActive=false where id=idPet;
end$$

DROP PROCEDURE IF EXISTS `Pets_getAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getAll` ()  begin
  select * from Pets where isActive=true;
end$$

DROP PROCEDURE IF EXISTS `Pets_getById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getById` (`pet_id` INT)  begin
  select * from Pets where id=pet_id;
end$$

DROP PROCEDURE IF EXISTS `Pets_getListByUserId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getListByUserId` (`user_id` INT)  begin
  select * from Pets where idUser=user_id;
end$$

DROP PROCEDURE IF EXISTS `Pets_modify`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_modify` (`id_` INT, `idUser_` INT, `idPetType_` INT, `name_` VARCHAR(20), `breed_` VARCHAR(20), `size_` VARCHAR(10), `description_` VARCHAR(80), `photo_` VARCHAR(30), `vaccines_` VARCHAR(30), `video_` VARCHAR(30), `isActive_` BOOLEAN)  begin
  update pets set 
    idUser=idUser_, idPetType=idPetType_, name=name_, breed=breed_, size=size_, description=description_, photo=photo_ , vaccines=vaccines_, video=video_, isActive=isActive_
    where id=id_;
end$$

DROP PROCEDURE IF EXISTS `PetTypes_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_add` (`name_` VARCHAR(10))  begin
  insert into PetTypes(name) values (name_);
end$$

DROP PROCEDURE IF EXISTS `PetTypes_getAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getAll` ()  begin
  select * from PetTypes;
end$$

DROP PROCEDURE IF EXISTS `PetTypes_getById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getById` (`idPetType` INT)  begin
  select * from PetTypes where id=idPetType;
end$$

DROP PROCEDURE IF EXISTS `reserves_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_add` (`idUserOwner_` INT, `idKeeper_` INT, `idPets_` VARCHAR(15), `initialDate_` DATE, `endDate_` DATE, `totalPrice_` INT(6), `reserveStatus_` INT(1))  begin
  insert into reserves (idUserOwner, idKeeper, idPets, initialDate ,endDate ,totalPrice, reserveStatus) 
    VALUES (idUserOwner_, idKeeper_ , idPets_ , initialDate_ ,endDate_ ,totalPrice_ , reserveStatus_ );
    select LAST_INSERT_ID() from reserves;
end$$

DROP PROCEDURE IF EXISTS `reserves_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_delete` (`idReserve` INT)  begin
      delete from reserves where id=idReserve;
end$$

DROP PROCEDURE IF EXISTS `reserves_modifyStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_modifyStatus` (`reserveId` INT, `status` INT)  begin
    update reserves set reserveStatus=status where id=reserveId;
end$$

DROP PROCEDURE IF EXISTS `reserves_getAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_getAll` ()  begin
      select * from reserves;
end$$

DROP PROCEDURE IF EXISTS `reserves_for_keeper`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_for_keeper` (`idKeeper_` INT)  begin
    select r.id, u.name, p.name as petName, r.initialDate, r.endDate, r.totalPrice, r.reserveStatus from reserves r inner join users u on u.id=r.idUserOwner and r.idKeeper=idKeeper_ inner join pets p on p.id in (r.idPets);
end$$

DROP PROCEDURE IF EXISTS `reserves_for_owner`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_for_owner` (`idUserOwner_` INT)  begin
    select r.id, u.name, p.name as petName, r.initialDate, r.endDate, r.totalPrice, r.reserveStatus from reserves r inner join users u on u.id=r.idKeeper and r.idUserOwner=idUserOwner_ inner join pets p on p.id in (r.idPets);
end$$

DROP PROCEDURE IF EXISTS `Users_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Users_add` (`username_` VARCHAR(30), `password_` VARCHAR(30), `name_` VARCHAR(20), `lastname_` VARCHAR(20), `dni_` VARCHAR(10), `phone_` VARCHAR(15), `email_` VARCHAR(50), `userTypeId_` INT)  begin
  INSERT INTO Users (username, password, name, lastname, dni, phone, email, userTypeId) 
    VALUES (username_, password_, name_, lastname_, dni_, phone_ , email_ , userTypeId_);
end$$

DROP PROCEDURE IF EXISTS `Users_modify`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Users_modify` (`id_` INT, `username_` VARCHAR(30), `password_` VARCHAR(30), `name_` VARCHAR(20), `lastname_` VARCHAR(20), `dni_` VARCHAR(10), `phone_` VARCHAR(15), `email_` VARCHAR(50), `userTypeId_` INT)  begin
  update Users set 
    username=username_ , password=password_ , name=name_ , lastname=lastname_, dni=dni_, phone=phone_ , email=email_ , userTypeId=userTypeId_
    where id=id_;
end$$

DROP PROCEDURE IF EXISTS `UserTypes_getById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UserTypes_getById` (`idUserType` INT)  begin
  select * from UserTypes where id=idUserType;
end$$





DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keepers`
--

DROP TABLE IF EXISTS `keepers`;
CREATE TABLE IF NOT EXISTS `keepers` (
  `keeperId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `addressStreet` varchar(45) NOT NULL,
  `addressNumber` varchar(5) NOT NULL,
  `petSize` varchar(10) NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `days` varchar(60) NOT NULL,
  `price` int(5) NOT NULL,
  PRIMARY KEY (`keeperId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `keepers`
--

INSERT INTO `keepers` (`keeperId`, `userId`, `addressStreet`, `addressNumber`, `petSize`, `initialDate`, `endDate`, `days`, `price`) VALUES
(1, 2, 'calleNroUno', '5000', 'Medium', '2022-11-09', '2022-11-30', 'Monday,Tuesday,Wednesday,Thursday,Friday', 500);

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
  `size` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `photo` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `vaccines` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `video` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pets`
--

INSERT INTO `pets` (`id`, `idUser`, `idPetType`, `name`, `breed`, `size`, `description`, `photo`, `vaccines`, `video`, `isActive`) VALUES
(1, 1, 1, 'perroS', 'raza1', 'Small', 'asd', NULL, NULL, NULL, 1),
(2, 1, 1, 'perroM', 'asd', 'Medium', 'asd', NULL, NULL, NULL, 1),
(3, 1, 1, 'perroB', 'asd', 'Big', 'asd', NULL, NULL, NULL, 1),
(4, 1, 2, 'gatoS', 'asd', 'Small', 'asd', NULL, NULL, NULL, 1),
(5, 1, 2, 'gatoM', 'asd', 'Medium', 'asd', NULL, NULL, NULL, 1),
(6, 1, 2, 'gatoB', 'asd', 'Big', 'asd', NULL, NULL, NULL, 1),
(7, 1, 2, 'gatoM2', 'asd', 'Medium', 'asd', NULL, NULL, NULL, 1);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserves`
--

DROP TABLE IF EXISTS `reserves`;
CREATE TABLE IF NOT EXISTS `reserves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUserOwner` int(11) NOT NULL,
  `idKeeper` int(11) NOT NULL,
  `idPets` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `totalPrice` int(6) NOT NULL,
  `reserveStatus` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reserves`
--

INSERT INTO `reserves` (`id`, `idUserOwner`, `idKeeper`, `idPets`, `initialDate`, `endDate`, `totalPrice`, `reserveStatus`) VALUES
(2, 1, 1, '5', '2022-11-08', '2022-11-15', 4000, 2),
(5, 1, 1, '7', '2022-11-09', '2022-11-15', 3500, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `userTypeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `lastname`, `dni`, `phone`, `email`, `userTypeId`) VALUES
(1, 'owner', '123', 'asd', 'asd', '12345677', '2235663251', 'alguito@gmail.com', 1),
(2, 'keeper', '123', 'john', 'asd', '12345678', '2235663251', 'algo@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertypes`
--

DROP TABLE IF EXISTS `usertypes`;
CREATE TABLE IF NOT EXISTS `usertypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameType` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usertypes`
--

INSERT INTO `usertypes` (`id`, `nameType`) VALUES
(1, 'Owner'),
(2, 'Keeper');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
