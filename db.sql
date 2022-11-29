-- CREATE SCHEMA/DATABASE
CREATE SCHEMA IF NOT EXISTS php_crud;

-- SET AS DEFAULT SCHEMA
USE php_crud;

-- CREATE TABLE
CREATE TABLE IF NOT EXISTS produto (
    id_produto INT NOT NULL AUTO_INCREMENT,
    Curso VARCHAR(50) NULL,    
    Ano DECIMAL(10,2) NULL,
    Semestre DECIMAL(10,2) NULL,
    Atividade Complementar VARCHAR(50) NULL,
    Matricula DECIMAL(10,2) NULL,
    Aluno VARCHAR(50) NULL,
    Carga horaria DECIMAL(10,2) NULL,
    PRIMARY KEY (id_produto)
);

##############################
########   OPTIONAL   ########
##############################

-- Exibe usuários do BD
SELECT User, HOST FROM mysql.user;

-- Exibe permissões do uruário
SHOW GRANTS FOR crud@localhost;

-- Cria usuário
CREATE USER 'crud'@'localhost' IDENTIFIED BY '123456';

-- Concede permissões CRUD
GRANT INSERT, UPDATE, DELETE, SELECT, EXECUTE 
ON *.* 
TO crud@localhost;

-- Cria usuário e concede permissões em comando único
GRANT INSERT, UPDATE, DELETE, SELECT, EXECUTE 
ON *.* 
TO crud@localhost IDENTIFIED BY '123456';
