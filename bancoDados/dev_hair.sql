drop database dv_hstyle;
create database dv_hstyle;

use dv_hstyle;

CREATE TABLE login (
	id INT(11) PRIMARY KEY auto_increment,
	email VARCHAR(150) NOT NULL,
    senha VARCHAR(8) NOT NULL
);

CREATE TABLE cliente (
	cpf VARCHAR(11) PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
	telefone VARCHAR(15) DEFAULT NULL,
    idLogin INT(11) NOT NULL,
    dataCadastro DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (idLogin) REFERENCES login(id)
);

CREATE TABLE funcao (
	id INT(11) PRIMARY KEY auto_increment,
	atividade VARCHAR(150) NOT NULL
);

CREATE TABLE funcionario (
	id INT(11) PRIMARY KEY auto_increment,
	nome VARCHAR(150) NOT NULL,
	idFuncao INT(11) NOT NULL,
	FOREIGN KEY (idFuncao) REFERENCES funcao(id)
);

CREATE TABLE servicos (
	id INT(11) PRIMARY KEY auto_increment,
	nome VARCHAR(30) NOT NULL,
	descricao VARCHAR(30) NOT NULL
);