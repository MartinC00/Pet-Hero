create database PetHero;
use PetHero;

create table if not exists Pets(
id int auto_increment,
idUser int not null,
idPetType int not null,
name varchar(20) not null,
breed varchar(20) not null,
size varchar(20) not null,
description varchar(80),
photo varchar(80),
vaccines varchar (80),
video varchar(80),
isActive bool not null,
constraint primary key (id))Engine=InnoDB;

create table if not exists PetTypes(
id int auto_increment,
name varchar(10) not null,
constraint primary key (id))Engine=InnoDB;;

insert into PetTypes(id,name) values ('1','Dog'),('2','Cat');

drop procedure if exists Pets_add;
delimiter $$
create procedure Pets_add(idUser int, idPetType int, name varchar(20), breed varchar(20), size varchar(20), description varchar(80), photo varchar(80), vaccines varchar (80), video varchar(80), isActive bool)
begin
	insert into Pets (idUser, idPetType, name, breed, size, description, photo, vaccines, video, isActive) values (idUser, idPetType, name, breed, size, description, photo, vaccines, video, isActive);
end $$
delimiter ;

drop procedure if exists Pets_getAll;
delimiter $$
create procedure Pets_getAll()
begin
	select * from Pets;
end $$
delimiter ;

drop procedure if exists Pets_getListByUserId;
delimiter $$
create procedure Pets_getListByUserId(user_id int)
begin
	select * from Pets where idUser=user_id;
end $$
delimiter ;

drop procedure if exists Pets_getById;
delimiter $$
create procedure Pets_getById(pet_id int)
begin
	select * from Pets where id=pet_id;
end $$
delimiter ;



drop procedure if exists PetTypes_add;
delimiter $$
create procedure PetTypes_add(name varchar(10))
begin
	insert into PetTypes(name) values (name);
end $$
delimiter ;

drop procedure if exists PetTypes_getAll;
delimiter $$
create procedure PetTypes_getAll()
begin
	select * from PetTypes;
end $$
delimiter ;

drop procedure if exists PetTypes_getById;
delimiter $$
create procedure PetTypes_getById(idPetType int)
begin
	select * from PetTypes where id=idPetType;
end $$
delimiter ;