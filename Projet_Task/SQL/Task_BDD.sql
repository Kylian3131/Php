CREATE DATABASE task;

USE task;

CREATE TABLE if not exists users(
	id_user int primary key auto_increment,
    name_user varchar(50),
    first_name_user varchar(50),
    login_user varchar(50) not null unique,
    mdp_user varchar(150) not null
)engine=innoDB;

CREATE TABLE IF NOT EXISTS categories(
	id_cat int primary key auto_increment,
    name_cat varchar(50) unique not null
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS tasks(
	id_task int primary key auto_increment,
    name_task varchar(50) not null,
    content_task text,
    date_task DATE,
    id_user int,
    id_cat int,
    CONSTRAINT fk_id_user FOREIGN KEY (id_user) REFERENCES users(id_user),
    CONSTRAINT categorie_wesh FOREIGN KEY (id_cat) REFERENCES categories(id_cat)
)ENGINE=innoDB;