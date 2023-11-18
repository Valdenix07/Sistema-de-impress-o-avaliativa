
CREATE DATABASE si_uninassau;

create table usuarios (
	id int not null auto_increment primary key,
	email varchar(200) not null,
	senha varchar(200) not null
);

create table provas (
	id int not null auto_increment primary key,
	curso varchar(100),
	turma varchar(30),
    turno varchar(30),
    professor varchar(50),
    tipo varchar(50),
    dataprova date,
    qtdfolhas int(10),
    situacao varchar(50),
    datasituacao date
);