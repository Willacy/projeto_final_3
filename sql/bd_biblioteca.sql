-- CRIANDO A BASE
CREATE DATABASE IF NOT EXISTS bd_biblioteca;
-- USANDO A BASE
USE bd_biblioteca;
-- CRIANDO A TABELA AUTOR
-- CREATE TABLE IF NOT EXISTS autores(
--     id_autor INT PRIMARY KEY AUTO_INCREMENT,
--     nome_autor VARCHAR(80),
--     nacionalidade_autor VARCHAR(80),
--     data_nasc_autor DATE,
--     biografia_autor TEXT
-- );
-- CRIANDO A TABELA CLIENTE
CREATE TABLE IF NOT EXISTS clientes(
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nome_cliente VARCHAR(80),
    endereco_cliente VARCHAR(120),
    telefone_cliente VARCHAR(30) UNIQUE,
    email_cliente VARCHAR(80) UNIQUE
);
-- CRIANDO A TABELA CLIENTE
CREATE TABLE IF NOT EXISTS livros(
    id_livro INT PRIMARY KEY AUTO_INCREMENT,
    titulo_livro VARCHAR(80),
    autor_livro VARCHAR(80),
    editora_livro VARCHAR(80),
    ano_public_livro DATE,
    isbn_livro VARCHAR(80)
);
-- CRIANDO TABELA RELAÇÃO AUTOR LIVRO
-- CREATE TABLE IF NOT EXISTS autor_livro(
--     id_livro_rel INT,
--     id_autor_rel INT,
--     FOREIGN KEY (id_livro_rel) REFERENCES livros(id_livro),
--     FOREIGN KEY (id_autor_rel) REFERENCES autores(id_autor)
-- );
-- CRIANDO A TABELA RELAÇÃO CLIENTE LIVRO
CREATE TABLE IF NOT EXISTS emprestimo(
    id_emp INT PRIMARY KEY AUTO_INCREMENT,
    data_emp DATE,
    data_devol_prev_emp DATE,
    data_devol_real_emp DATE,
    id_livro_emp INT,
    id_cliente_emp INT,
    FOREIGN KEY (id_livro_emp) REFERENCES livros(id_livro),
    FOREIGN KEY (id_cliente_emp) REFERENCES clientes(id_cliente)
);