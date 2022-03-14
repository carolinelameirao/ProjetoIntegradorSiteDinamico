create database dv_hstyle;

use dv_hstyle;

CREATE TABLE cliente(
	id INT PRIMARY KEY auto_increment,
    nome VARCHAR(255) NOT NULL,
	telefone VARCHAR(15) DEFAULT NULL,
	celular VARCHAR(15) DEFAULT NULL,
    endereco VARCHAR(255) NOT NULL,
    dataCadastro DATE DEFAULT NULL
);

CREATE TABLE funcaofuncionario (
id INT(11) PRIMARY KEY auto_increment,
funcao VARCHAR(150) DEFAULT NULL
);

CREATE TABLE funcionario (
	id INT(11) PRIMARY KEY auto_increment,
	nome VARCHAR(255) DEFAULT NULL,
	tipofun INT(11) NOT NULL,
	FOREIGN KEY (tipofun) REFERENCES tipofuncionario(id)

);

CREATE TABLE servico (
	id INT(11) PRIMARY KEY auto_increment,
	nome VARCHAR(30) NOT NULL,
	descricao VARCHAR(30) NOT NULL,
	valordoser DECIMAL DEFAULT NULL
);

CREATE TABLE vendaservico(
    id INT(11) PRIMARY KEY auto_increment,
    idcliente INT(11) NOT NULL,
    idfuncionario INT(11) NOT NULL,
    idservico INT(11) NOT NULL,
    Foreign key (idcliente) references  cliente(id),
    Foreign key (idfuncionario) references funcionario(id),
	Foreign key (idservico) references servico(id)
);





