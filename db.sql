-- CREATE SCHEMA/DATABASE
CREATE SCHEMA IF NOT EXISTS php_crud;

-- SET AS DEFAULT SCHEMA
USE php_crud;

-- CREATE TABLE
CREATE TABLE IF NOT EXISTS produto (
    id_produto INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NULL,
    valor DECIMAL(10,2) NULL,
    valor_desconto DECIMAL(10,2) NULL,
    PRIMARY KEY (id_produto)
);

-- CREATE TRIGGER ON INSERT
CREATE TRIGGER tr_i_produto_10_porcento 
BEFORE INSERT ON produto
FOR EACH ROW
SET NEW.valor_desconto = NEW.valor * 0.9;

-- CREATE TRIGGER ON UPDATE
CREATE TRIGGER tr_u_produto_10_porcento 
BEFORE UPDATE ON produto
FOR EACH ROW
SET NEW.valor_desconto = NEW.valor * 0.9;


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