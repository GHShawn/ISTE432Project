SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

drop schema if exists mysqldb;
create schema if not exists mysqldb default character set utf8;
use mysqldb;

------------------------------
-- user table
------------------------------
create table if not exists user(
	user_id integer primary key auto_increment,
    email varchar(30) not null,
    pswd varchar(20) not null,
    userName varchar(30) not null
)ENGINE = InnoDB;

------------------------------
-- custome_ercipe table
------------------------------
create table if not exists custom_recipe(
	custom_id int primary key auto_increment,
    recipe_name varchar(3) not null
)ENGINE = InnoDB;

------------------------------
-- custom_recipe_ing table
------------------------------
create table if not exists custom_recipe_ing(
	custom_recipe_ing int not null auto_increment,
	custom_id int(10) not null,
    quanity int(10) not null,
    primary key(custom_recipe_ing),
    foreign key (custom_id) references custom_recipe(custom_id)
)ENGINE = InnoDB;

------------------------------
-- inventory_database table
------------------------------
create table if not exists inventory_database(
	
	ingriendient_id int(30) not null auto_increment,
    ingriendient_name varchar(30) not null,
    primary key(ingriendient_id)
    
)ENGINE = InnoDB;

------------------------------
-- shipping_list table
------------------------------
create table if not exists shipping_list(
	shopping_list_id int auto_increment,
    ingriendient_id int(10) not null,
    quanity int(10) not null,
    user_id int(10) not null,
    primary key (shopping_list_id),
    foreign key (ingriendient_id) references inventory_database(ingriendient_id),
    foreign key (user_id) references user(user_id)
)ENGINE = InnoDB;





