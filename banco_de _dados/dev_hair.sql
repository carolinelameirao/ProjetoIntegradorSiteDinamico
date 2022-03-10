create database dv_hstyle;

use dv_hstyle;

create table cliente(
id int primary key auto_increment,
cpf varchar(15)  not null,
nome varchar(50) not null,
dataNasc date default null,
endereco varchar(50) not null,
celular varchar(15) default null
);

create table servico (
cod int(11) primary key not null auto_increment,
nome varchar(50) not null,
descricao varchar (255) not null
);

create table funcionario (
id int(11) primary key not null auto_increment,
nome varchar(50) not null,
endereco varchar(50) not null,
datanasc date not null,
dataadm date not null
 












