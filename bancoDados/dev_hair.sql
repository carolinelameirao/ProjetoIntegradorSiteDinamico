create database dv_hstyle;

use dv_hstyle;

CREATE TABLE login (
	email VARCHAR(150) PRIMARY KEY auto_increment,
    senha VARCHAR(8) NOT NULL
);

CREATE TABLE cliente (
	cpf VARCHAR(11) PRIMARY KEY auto_increment,
    nome VARCHAR(150) NOT NULL,
	telefone VARCHAR(15) DEFAULT NULL,
	celular VARCHAR(15) NOT NULL,
    emailLogin VARCHAR(150) NOT NULL,
    dataCadastro DATE DEFAULT NULL CURRENT_DATE,
    FOREIGN KEY (emailLogin) REFERENCES login(email)
);

CREATE TABLE funcaoFuncionario (
	id INT(11) PRIMARY KEY auto_increment,
	funcao VARCHAR(150) NOT NULL
);

CREATE TABLE funcionario (
	id INT(11) PRIMARY KEY auto_increment,
	nome VARCHAR(150) NOT NULL,
	idFuncaoFuncinario INT(11) NOT NULL,
	FOREIGN KEY (idFuncaoFunconario) REFERENCES funcaoFuncionario(id)
);

CREATE TABLE servico (
	id INT(11) PRIMARY KEY auto_increment,
	nome VARCHAR(30) NOT NULL,
	descricao VARCHAR(30) NOT NULL,
	valorServico DECIMAL NOT NULL
);

CREATE TABLE vendaServico (
    id INT(11) PRIMARY KEY auto_increment,
    idCliente INT(11) NOT NULL,
    idFuncionario INT(11) NOT NULL,
    idServico INT(11) NOT NULL,
    Foreign key (idCliente) references cliente(id),
    Foreign key (idFuncionario) references funcionario(id),
	Foreign key (idServico) references servico(id)
);





