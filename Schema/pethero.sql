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
drop database if EXISTS pethero;
create database pethero;
use pethero;

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

DROP PROCEDURE IF EXISTS `keepers_list`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `keepers_list` ()  begin
   select k.userId, k.keeperId, u.name, u.lastname, u.phone, u.email, k.addressStreet, k.addressNumber, k.petSize, k.initialDate, k.endDate, k.days, k.price
   from keepers k inner join users u on u.id=k.userId;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_add` (`idUserOwner_` INT, `idKeeper_` INT, `idPets_` VARCHAR(15), `initialDate_` DATE, `endDate_` DATE, `totalPrice_` INT(6), `reserveStatus_` INT(1), `paymentStatus_` INT(1))  begin
    insert into reserves (idUserOwner, idKeeper, idPets, initialDate ,endDate ,totalPrice, reserveStatus, paymentStatus)
    VALUES (idUserOwner_, idKeeper_ , idPets_ , initialDate_ ,endDate_ ,totalPrice_ , reserveStatus_ , paymentStatus_);
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

DROP PROCEDURE IF EXISTS `reserves_modifyPayment`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_modifyPayment` (`reserveId` INT, `status` INT)  begin
    update reserves set paymentStatus=status where id=reserveId;
end$$

DROP PROCEDURE IF EXISTS `reserves_getAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_getAll` ()  begin
    select * from reserves;
end$$

DROP PROCEDURE IF EXISTS `reserves_for_keeper`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_for_keeper` (`idKeeper_` INT)  begin
    select r.id, u.name, r.idPets, r.initialDate, r.endDate, r.totalPrice, r.reserveStatus, r.paymentStatus from reserves r inner join users u on u.id=idKeeper_;
end$$ 

DROP PROCEDURE IF EXISTS `reserves_for_owner`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_for_owner` (`idUserOwner_` INT)  begin
    select r.id, u.name, r.idPets, r.initialDate, r.endDate, r.totalPrice, r.reserveStatus, r.paymentStatus from reserves r inner join users u on u.id=idUserOwner_;
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

DROP PROCEDURE IF EXISTS `coupons_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `coupons_add` (`idReserve_` INT, `code_` VARCHAR(20))  begin
    insert into coupons (idReserve, code)
    VALUES (idReserve_, code_);
select LAST_INSERT_ID() from coupons;
end$$

DROP PROCEDURE IF EXISTS `coupons_getAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `coupons_getAll` ()  begin
    select * from coupons;
end$$

DROP PROCEDURE IF EXISTS `chats_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_add` (`idUserOwner_` INT, `idUserKeeper_` INT, `status_` INT)  begin
    insert into chats (idUserOwner, idUserKeeper, status)
    VALUES (idUserOwner_, idUserKeeper_, status_);
select LAST_INSERT_ID() from chats;
end$$

DROP PROCEDURE IF EXISTS `chats_getAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_getAll` ()  begin
    select * from chats;
end$$

DROP PROCEDURE IF EXISTS `chats_getByIds`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_getByIds` (`idUserOwner_` INT, `idUserKeeper_` INT)  begin
    select * from chats where idUserOwner=idUserOwner_ and idUserKeeper=idUserKeeper_;
end$$

DROP PROCEDURE IF EXISTS `messages_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `messages_add` (`chatId_` INT, `idSender_` INT, `message_` VARCHAR(200), `date_` DATETIME)  begin
    insert into messages (chatId, idSender, message, date)
    VALUES (chatId_, idSender_, message_, date_);
select LAST_INSERT_ID() from messages;
end$$

DROP PROCEDURE IF EXISTS `messages_byChatId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `messages_byChatId` (`chatId_` INT)  begin
    select * from messages where chatId = chatId_;
end$$

DROP PROCEDURE IF EXISTS `chats_getForOwner`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_getForOwner` (`idUserOwner_` INT)  begin
    select c.*, u.name as keeperName from chats c inner join users u on
    u.id=c.idUserKeeper having idUserOwner=idUserOwner_;
end$$

DROP PROCEDURE IF EXISTS `chats_getForKeeper`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_getForKeeper` (`idUserKeeper_` INT)  begin
    select c.*, u.name as ownerName from chats c inner join users u on
    u.id=c.idUserOwner having idUserKeeper=idUserkeeper_;
end$$

DROP PROCEDURE IF EXISTS `chats_modify_status`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_modify_status` (`idChat` INT, `status_` INT) begin
    update chats set status=status_
    where id=idChat;
end$$

DELIMITER ;

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

INSERT INTO `keepers` 
(`keeperId`, `userId`, `addressStreet`, `addressNumber`, `petSize`, `initialDate`, `endDate`, `days`, `price`) 
VALUES (1, 2, 'Independencia', '3530', 'Medium', '2022-11-25', '2022-12-22', 'Monday,Tuesday,Wednesday,Thursday,Friday', 3000),
(2, 4, 'Av. Tejedor', '5000', 'Big', '2022-11-25', '2022-12-30', 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', 2500);

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
(1, 5, 1, 'Lali', 'Caniche', 'Small', 'es muy inteligente y pasea a diario en el auto', NULL, NULL, NULL, 1),
(2, 3, 1, 'Mora', 'Galgo', 'Medium', 'es muy veloz', NULL, NULL, NULL, 1),
(3, 5, 1, 'Amigo', 'Mestizo', 'Big', 'rescatado de la calle u.u pero muy fiel :)', NULL, NULL, NULL, 1),
(4, 3, 2, 'Melon', 'Naranja', 'Small', 'se parece a Garfield', NULL, NULL, NULL, 1),
(5, 1, 2, 'Shiro', 'Ragdoll', 'Medium', 'muy bonito y sabe hablar', NULL, NULL, NULL, 1),
(6, 1, 2, 'Neko', 'Gris', 'Big', 'el unico gato baboso de mdq', NULL, NULL, NULL, 1),
(7, 5, 2, 'Cleo', 'Gris', 'Medium', 'le gusta mirar palomas por la ventana', NULL, NULL, NULL, 1);

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
  `paymentStatus` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(1, 'crisO', '123', 'Cristian', 'Halm', '12345677', '2235663251', 'cris@gmail.com', 1),
(2, 'nicoK', '123', 'Nicolas', 'Bertolucci', '12345678', '2235663251', 'nico@gmail.com', 2),
(3, 'martinO', '123', 'Martin', 'Cabrera', '42946488', '2236663251', 'cabreramartin403@gmail.com', 1),
(4, 'agustinK', '123', 'Agustin', 'Lapenna', '38283270', '2236613251', 'agustinjlapenna@gmail.com', 2),
(5, 'sofiaO', '123', 'Sofia', 'Belber', '44283270', '2236613221', 'sofiabelber@gmail.com', 1);

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
-- Estructura de tabla para la tabla `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idReserve` INT NOT NULL,
    `code` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idUserOwner` INT NOT NULL,
    `idUserKeeper` INT NOT NULL,
    `status` BOOL NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `chatId` int(11) NOT NULL,
    `idSender` INT NOT NULL,
    `message` VARCHAR(200) NOT NULL,
    `date` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
