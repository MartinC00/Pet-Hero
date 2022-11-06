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

# PETS

drop procedure if exists Pets_add$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_add` (`idUser_` INT, `idPetType_` INT, `name_` VARCHAR(20), `breed_` VARCHAR(20), `size_` VARCHAR(10), `description_` VARCHAR(80), `photoId` int, `vaccinesPhotoId` int, `videoId` int, `isActive_` boolean)   
begin
  insert into Pets (idUser, idPetType, name, breed, size, description, isActive) values (idUser_, idPetType_, name_, breed_, size_, description_, isActive_);
end$$

drop procedure if exists Pets_modify$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_modify` (`id_` INT, `idUser_` INT, `idPetType_` INT, `name_` VARCHAR(20), `breed_` VARCHAR(20), `size_` VARCHAR(10), `description_` VARCHAR(80), `photoId_` int, `vaccinesPhotoId_` int, `videoId_` int, `isActive_` boolean)   
begin
  update pets set 
    idUser=idUser_, idPetType=idPetType_, name=name_, breed=breed_, size=size_, description=description_, photoId=photoId_ , vaccinesPhotoId=vaccinesPhotoId_, videoId=videoId_, isActive=isActive_
    where id=id_;
end$$

drop procedure if exists Pets_getAll$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getAll` ()   begin
  select * from Pets;
end$$

drop procedure if exists Pets_getById$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getById` (`pet_id` INT)   begin
  select * from Pets where id=pet_id;
end$$

drop procedure if exists Pets_getListByUserId$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pets_getListByUserId` (`user_id` INT)   begin
  select * from Pets where idUser=user_id;
end$$

# PET TYPES

drop procedure if exists PetTypes_add$$
create procedure PetTypes_add (name_ VARCHAR(10))   begin
  insert into PetTypes(name) values (name_);
end$$

drop procedure if exists PetTypes_getAll$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getAll` ()   begin
  select * from PetTypes;
end$$

drop procedure if exists PetTypes_getById$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PetTypes_getById` (`idPetType` INT)   begin
  select * from PetTypes where id=idPetType;
end$$

# USERS 

drop procedure if exists Users_add$$
create procedure Users_add(username_ varchar(30),password_ varchar(30), name_ varchar(20), lastname_ varchar(20),dni_ varchar(10), phone_ varchar(15),email_ varchar(50), userTypeId_ int) 
begin
  INSERT INTO Users (username, password, name, lastname, dni, phone, email, userTypeId) 
    VALUES (username_, password_, name_, lastname_, dni_, phone_ , email_ , userTypeId_);
end $$

drop procedure if exists Users_modify$$
create procedure Users_modify(id_ int, username_ varchar(30),password_ varchar(30), name_ varchar(20), lastname_ varchar(20),dni_ varchar(10), phone_ varchar(15),email_ varchar(50), userTypeId_ int)
begin
  update Users set 
    username=username_ , password=password_ , name_=name_ , lastname=lastname_, dni=dni_, phone=phone_ , email=email_ , userTypeId=userTypeId_
    where id=id_;
end $$

# KEEPERS

drop procedure if exists keepers_add$$
create procedure keepers_add (userId_ int,addressStreet_ varchar(45),addressNumber_ varchar(5),petSize_ varchar(10),initialDate_ date,endDate_ date,days_ int(10),price_ int(5))   begin
  insert into keepers (userId,addressStreet,addressNumber,petSize,initialDate,endDate,days,price) 
    VALUES (userId_,address_street_,address_number_,petSize_,initialDate_,endDate_,days_,price_);
end$$


drop procedure if exists keepers_modify$$
create procedure keepers_modify(keeperId_ int, userId_ int, addressStreet_ varchar(45), addressNumber_ varchar(5), petSize_ varchar(10),initialDate_ date, endDate_ date, days_ varchar(10),price_ int(5))
begin
  update keepers set 
      userId=userId_, addressStreet=addressStreet_ , addressNumber=addressNumber_ , petSize=petSize_, initialDate=initialDate_, endDate=endDate_ , days=days_ , price=price_
  where keeperId=keeperId_;
end $$


drop procedure if exists UserTypes_getById$$
create procedure UserTypes_getById (idUserType int)
begin
  select * from UserTypes where id=idUserType;
end$$


delimiter ;

-- --------------------------------------------------------

drop table if exists Users;
create table Users(
id int auto_increment,
username varchar(30) not null unique,
password varchar(30) not null,
name varchar(20) not null,
lastname varchar(20) not null,
dni varchar(10) unique not null,
phone varchar(15) not null,
email varchar(50) not null unique,
userTypeId int not null,
constraint primary key (id));


drop table if exists keepers;
CREATE TABLE `keepers` (
  `keeperId` int primary key AUTO_INCREMENT,
  `userId` int NOT NULL,
  `addressStreet` varchar(45) NOT NULL,
  `addressNumber` varchar(5) NOT NULL,
  `petSize` varchar(10) NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date NOT NULL,
  `days` varchar(10) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


drop table if exists UserTypes;
create table UserTypes(
id int auto_increment primary key,
nameType varchar(10)
);

drop table if exists images;
CREATE TABLE `images` (
  `id` int primary key AUTO_INCREMENT,
  `type` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


drop table if exists pettypes;
CREATE TABLE `pettypes` (
  `id` int AUTO_INCREMENT primary key,
  `name` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


drop table if exists pets;
CREATE TABLE `pets` (
  `id` int primary key AUTO_INCREMENT,
  `idUser` int NOT NULL,
  `idPetType` int NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `breed` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `size` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `photoId` int NOT NULL,
  `vaccinesPhotoId` int NOT NULL,
  `videoId` int NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


drop table if exists videos;
CREATE TABLE `videos` (
  `id` int primary key AUTO_INCREMENT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


insert into UserTypes (id, nameType) values (1,'Owner'),(2,'Keeper');

INSERT INTO `pettypes` (`id`, `name`) VALUES
(1, 'Dog'),
(2, 'Cat');

-- --------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
