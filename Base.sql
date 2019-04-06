DROP DATABASE IF EXISTS mydb;
CREATE DATABASE mydb;

------------------------------
-- user table
------------------------------
create table if not exists users(
	user_id SERIAL PRIMARY KEY,
    email varchar(30) not null,
    pswd varchar(20) not null,
    userName varchar(30) not null
);

------------------------------
-- custome_ercipe table
------------------------------
create table if not exists custom_recipe(
	custom_id SERIAL PRIMARY KEY,
    recipe_name varchar(100) not null
);

------------------------------
-- custom_recipe_ing table
------------------------------
create table if not exists custom_recipe_ing(
	custom_recipe_ing SERIAL,
	custom_id int not null,
    quanity varchar(30) not null,
    partial_ing_name varchar(30) not null,
    primary key(custom_recipe_ing),
    foreign key (custom_id) references custom_recipe(custom_id)
);

------------------------------
-- inventory_database table
------------------------------
create table if not exists inventory_database(

	ingriendient_id SERIAL,
    ingriendient_name varchar(100) not null,
	quanity varchar(30) not null,
    primary key(ingriendient_id)
);

------------------------------
-- shipping_list table
------------------------------
CREATE TABLE IF NOT EXISTS shopping_list(
    shopping_list_id SERIAL,
    ingriendient_id INT NOT NULL,
    quanity varchar(30) NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY(shopping_list_id),
    FOREIGN KEY(ingriendient_id) REFERENCES inventory_database(ingriendient_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);

-- sampel for login
insert into USERS(username, email,pswd) values 
('test1', 'test1@g.com','password1'),  
('test2', 'test2@g.com','password1'),  
('test3', 'test3@g.com','password1'),  
('test4', 'test4@g.com','password1');

select userName from user where username = 'test1' AND pswd = 'password1';

-- sample for custom_recipe
insert into custom_recipe(recipe_name) values
('American Sub'),
('BLT');
insert into custom_recipe_ing(partial_ing_name,quanity,custom_id) values
('Turkey breast','2oz',1),
(' ham','2oz',1),
(' American or cheddar cheese','2 pcs',1),
(' chopped or shredded lettuce','customer determine',1),
(' tomatoes', 'customer determine',1),
(' green peppers','customer determine',1),
('Bacon', '2oz', 2),
('lettuce' ,'customer determine',2),
('tomato', 'customer determine', 2);
-- sample for get recipe ingredient by recipe name, id ?
select t1.custom_id, t1.recipe_name, t2.partial_ing_name from custom_recipe t1 left join custom_recipe_ing t2 on t1.custom_id = t2.custom_id;

-- 

insert into inventory_database(ingriendient_id,ingriendient_name,quanity values
(1,'American Sub','1 pcs'), (2,'BLT','1 pcs');

insert into shopping_list(ingriendient_id,quanity,user_id) values
(1,2,1),
(1,2,1),
(1,2,1),
(1,2,1);




