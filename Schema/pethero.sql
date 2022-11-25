-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 11:59 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pethero`
--


--
-- Procedures
--
drop database if exists pethero;
create database pethero;
use pethero;

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_add` (`idUserOwner_` INT, `idUserKeeper_` INT, `status_` INT)   begin
    insert into chats (idUserOwner, idUserKeeper, status)
    VALUES (idUserOwner_, idUserKeeper_, status_);
select LAST_INSERT_ID() from chats;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_getAll` ()   begin
    select * from chats;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_getByIds` (`idUserOwner_` INT, `idUserKeeper_` INT)   begin
    select * from chats where idUserOwner=idUserOwner_ and idUserKeeper=idUserKeeper_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_getForKeeper` (`idUserKeeper_` INT)   begin
    select c.*, u.name as ownerName from chats c inner join users u on
    u.id=c.idUserOwner having idUserKeeper=idUserkeeper_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_getForOwner` (`idUserOwner_` INT)   begin
    select c.*, u.name as keeperName from chats c inner join users u on
    u.id=c.idUserKeeper having idUserOwner=idUserOwner_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chats_modify_status` (`idChat` INT, `status_` INT)   begin
    update chats set status=status_
    where id=idChat;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `coupons_add` (`idReserve_` INT, `code_` VARCHAR(20))   begin
    insert into coupons (idReserve, code)
    VALUES (idReserve_, code_);
select LAST_INSERT_ID() from coupons;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `coupons_getAll` ()   begin
    select * from coupons;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `keepers_add` (`userId_` INT, `addressStreet_` VARCHAR(45), `addressNumber_` VARCHAR(5), `petSize_` VARCHAR(10), `initialDate_` DATE, `endDate_` DATE, `days_` VARCHAR(60), `price_` INT(5))   begin
    insert into keepers (userId,addressStreet,addressNumber,petSize,initialDate,endDate,days,price)
    VALUES (userId_,addressStreet_,addressNumber_,petSize_,initialDate_,endDate_,days_,price_);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `keepers_list` ()   begin
   select k.userId, k.keeperId, u.name, u.lastname, u.phone, u.email, k.addressStreet, k.addressNumber, k.petSize, k.initialDate, k.endDate, k.days, k.price
   from keepers k inner join users u on u.id=k.userId;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `keepers_modify` (`keeperId_` INT, `userId_` INT, `addressStreet_` VARCHAR(45), `addressNumber_` VARCHAR(5), `petSize_` VARCHAR(10), `initialDate_` DATE, `endDate_` DATE, `days_` VARCHAR(60), `price_` INT(5))   begin
    update keepers set
    userId=userId_, addressStreet=addressStreet_ , addressNumber=addressNumber_ , petSize=petSize_, initialDate=initialDate_, endDate=endDate_ , days=days_ , price=price_
    where keeperId=keeperId_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `messages_add` (`chatId_` INT, `idSender_` INT, `message_` VARCHAR(200), `date_` DATETIME)   begin
    insert into messages (chatId, idSender, message, date)
    VALUES (chatId_, idSender_, message_, date_);
select LAST_INSERT_ID() from messages;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `messages_byChatId` (`chatId_` INT)   begin
    select * from messages where chatId = chatId_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_add` (`idUser_` INT, `idPetType_` INT, `name_` VARCHAR(20), `breed_` VARCHAR(20), `size_` VARCHAR(10), `description_` VARCHAR(80), `photo_` VARCHAR(30), `vaccines_` VARCHAR(30), `video_` VARCHAR(30), `isActive_` BOOLEAN)   begin
    insert into Pets (idUser, idPetType, name, breed, size, description, photo, vaccines, video, isActive) values (idUser_, idPetType_, name_, breed_, size_, description_, photo_, vaccines_, video_, isActive_);
    select LAST_INSERT_ID() from Pets;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_delete` (`idPet` INT)   begin
    update pets set
    isActive=false where id=idPet;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getAll` ()   begin
    select * from Pets where isActive=true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getById` (`pet_id` INT)   begin
    select * from Pets where id=pet_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getListByUserId` (`user_id` INT)   begin
    select * from Pets where idUser=user_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_modify` (`id_` INT, `idUser_` INT, `idPetType_` INT, `name_` VARCHAR(20), `breed_` VARCHAR(20), `size_` VARCHAR(10), `description_` VARCHAR(80), `photo_` VARCHAR(30), `vaccines_` VARCHAR(30), `video_` VARCHAR(30), `isActive_` BOOLEAN)   begin
    update pets set
    idUser=idUser_, idPetType=idPetType_, name=name_, breed=breed_, size=size_, description=description_, photo=photo_ , vaccines=vaccines_, video=video_, isActive=isActive_
    where id=id_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_add` (`name_` VARCHAR(10))   begin
    insert into PetTypes(name) values (name_);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getAll` ()   begin
    select * from PetTypes;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getById` (`idPetType` INT)   begin
    select * from PetTypes where id=idPetType;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_add` (`idUserOwner_` INT, `idKeeper_` INT, `idPets_` VARCHAR(15), `initialDate_` DATE, `endDate_` DATE, `totalPrice_` INT(6), `reserveStatus_` INT(1), `paymentStatus_` INT(1))   begin
    insert into reserves (idUserOwner, idKeeper, idPets, initialDate ,endDate ,totalPrice, reserveStatus, paymentStatus)
    VALUES (idUserOwner_, idKeeper_ , idPets_ , initialDate_ ,endDate_ ,totalPrice_ , reserveStatus_ , paymentStatus_);
    select LAST_INSERT_ID() from reserves;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_delete` (`idReserve` INT)   begin
    delete from reserves where id=idReserve;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_for_keeper` (`idKeeper_` INT)   begin
    select * from reserves where idKeeper=idKeeper_;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_for_owner` (`idUserOwner_` INT)   begin
    select * from reserves where idUserOwner=idUserOwner_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_getAll` ()   begin
    select * from reserves;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_modifyPayment` (`reserveId` INT, `status` INT)   begin
    update reserves set paymentStatus=status where id=reserveId;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reserves_modifyStatus` (`reserveId` INT, `status` INT)   begin
    update reserves set reserveStatus=status where id=reserveId;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Users_add` (`username_` VARCHAR(30), `password_` VARCHAR(30), `name_` VARCHAR(20), `lastname_` VARCHAR(20), `dni_` VARCHAR(10), `phone_` VARCHAR(15), `email_` VARCHAR(50), `userTypeId_` INT)   begin
    INSERT INTO Users (username, password, name, lastname, dni, phone, email, userTypeId)
    VALUES (username_, password_, name_, lastname_, dni_, phone_ , email_ , userTypeId_);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Users_modify` (`id_` INT, `username_` VARCHAR(30), `password_` VARCHAR(30), `name_` VARCHAR(20), `lastname_` VARCHAR(20), `dni_` VARCHAR(10), `phone_` VARCHAR(15), `email_` VARCHAR(50), `userTypeId_` INT)   begin
    update Users set
    username=username_ , password=password_ , name=name_ , lastname=lastname_, dni=dni_, phone=phone_ , email=email_ , userTypeId=userTypeId_
    where id=id_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UserTypes_getById` (`idUserType` INT)   begin
    select * from UserTypes where id=idUserType;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `idUserOwner` int(11) NOT NULL,
  `idUserKeeper` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `idUserOwner`, `idUserKeeper`, `status`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `idReserve` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `idReserve`, `code`) VALUES
(1, 6, '63813ebe9a9cf');

-- --------------------------------------------------------

--
-- Table structure for table `keepers`
--

CREATE TABLE `keepers` (
  `keeperId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `addressStreet` varchar(45) NOT NULL,
  `addressNumber` varchar(5) NOT NULL,
  `petSize` varchar(10) NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `days` varchar(60) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keepers`
--

INSERT INTO `keepers` (`keeperId`, `userId`, `addressStreet`, `addressNumber`, `petSize`, `initialDate`, `endDate`, `days`, `price`) VALUES
(1, 2, 'Independencia', '3530', 'Medium', '2022-11-25', '2022-12-22', 'Monday,Tuesday,Wednesday,Thursday,Friday', 3000),
(2, 4, 'Av. Tejedor', '5000', 'Big', '2022-11-25', '2022-12-30', 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `chatId` int(11) NOT NULL,
  `idSender` int(11) NOT NULL,
  `message` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `chatId`, `idSender`, `message`, `date`) VALUES
(1, 1, 1, 'Hola Nico como estas_', '2022-11-25 19:04:22'),
(2, 1, 2, 'Hola Cris un gusto', '2022-11-25 19:04:47'),
(3, 1, 1, 'queria saber si tienes un amplio espacio para mis mascotas ya que les gusta saltar por todos lados', '2022-11-25 19:05:42'),
(4, 1, 1, 'otra cosa', '2022-11-25 19:06:28'),
(5, 1, 1, 'sos crack', '2022-11-25 19:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPetType` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `breed` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `size` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `photo` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `vaccines` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `video` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `idUser`, `idPetType`, `name`, `breed`, `size`, `description`, `photo`, `vaccines`, `video`, `isActive`) VALUES
(1, 5, 1, 'Lali', 'Caniche', 'Small', 'es muy inteligente y pasea a diario en el auto', 'sofiaO-1.jpg', 'sofiaO-v1.jpg', 'sofiaO-video1.mp4', 1),
(2, 3, 1, 'Mora', 'Galgo', 'Medium', 'es muy veloz', 'martinO-2.jpg', 'martinO-v2.jpg', 'martinO-video2.mp4', 1),
(3, 5, 1, 'Amigo', 'Mestizo', 'Big', 'rescatado de la calle u.u pero muy fiel :)', 'sofiaO-3.jpg', 'sofiaO-v3.jpg', 'sofiaO-video3.mp4', 1),
(4, 3, 2, 'Melon', 'Naranja', 'Small', 'se parece a Garfield', 'martinO-4.jpg', 'martinO-v4.jpg', 'martinO-video4.mp4', 1),
(5, 1, 2, 'Shiro', 'Ragdoll', 'Medium', 'muy bonito y sabe hablar', 'owner-5.jpg', 'owner-v5.jpg', 'owner-video5.mp4', 1),
(6, 1, 2, 'Neko', 'Gris', 'Big', 'el unico gato baboso de mdq', 'owner-6.jpg', 'owner-v6.jpg', 'owner-video6.mp4', 1),
(7, 5, 2, 'Cleo', 'Gris', 'Medium', 'le gusta mirar palomas por la ventana', 'sofiaO-7.jpg', 'sofiaO-v7.jpg', 'sofiaO-video7.mp4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pettypes`
--

CREATE TABLE `pettypes` (
  `id` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `pettypes`
--

INSERT INTO `pettypes` (`id`, `name`) VALUES
(1, 'Dog'),
(2, 'Cat');

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE `reserves` (
  `id` int(11) NOT NULL,
  `idUserOwner` int(11) NOT NULL,
  `idKeeper` int(11) NOT NULL,
  `idPets` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `totalPrice` int(6) NOT NULL,
  `reserveStatus` int(1) NOT NULL,
  `paymentStatus` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `reserves`
--

INSERT INTO `reserves` (`id`, `idUserOwner`, `idKeeper`, `idPets`, `initialDate`, `endDate`, `totalPrice`, `reserveStatus`, `paymentStatus`) VALUES
(6, 1, 1, '5', '2022-11-29', '2022-11-30', 6000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `userTypeId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `lastname`, `dni`, `phone`, `email`, `userTypeId`) VALUES
(1, 'crisO', '123', 'Cristian ', 'Halm ', '12345677', '2235663251', 'cristianhalm.utn@gmail.com', 1),
(2, 'nicoK', '123', 'Nicolas', 'Bertolucci', '12345678', '2235663251', 'nico@gmail.com', 2),
(3, 'martinO', '123', 'Martin', 'Cabrera', '42946488', '2236663251', 'cabreramartin403@gmail.com', 1),
(4, 'agustinK', '123', 'Agustin', 'Lapenna', '38283270', '2236613251', 'agustinjlapenna@gmail.com', 2),
(5, 'sofiaO', '123', 'Sofia', 'Belber', '44283270', '2236613221', 'sofiabelber@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(11) NOT NULL,
  `nameType` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `nameType`) VALUES
(1, 'Owner'),
(2, 'Keeper');

--
-- Indexes for dumped tables
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
