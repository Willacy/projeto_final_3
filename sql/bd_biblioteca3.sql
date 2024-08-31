DROP DATABASE bd_biblioteca;

CREATE DATABASE IF NOT EXISTS bd_biblioteca;

USE bd_biblioteca;

CREATE TABLE
  IF NOT EXISTS usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_usuario VARCHAR(80),
    login_usuario VARCHAR(80) NOT NULL UNIQUE,
    senha_usuario VARCHAR(128) NOT NULL
  );

CREATE TABLE
  IF NOT EXISTS estados (
    id_estado INT PRIMARY KEY AUTO_INCREMENT,
    nome_estado VARCHAR(45)
  );

CREATE TABLE
  IF NOT EXISTS cidades (
    id_cidade INT PRIMARY KEY AUTO_INCREMENT,
    nome_cidade VARCHAR(45),
    fk_estado INT,
    FOREIGN KEY (fk_estado) REFERENCES estados (id_estado)
  );

CREATE TABLE
  IF NOT EXISTS bairros (
    id_bairro INT PRIMARY KEY AUTO_INCREMENT,
    nome_bairro VARCHAR(45),
    fk_cidade INT,
    FOREIGN KEY (fk_cidade) REFERENCES cidades (id_cidade)
  );

CREATE TABLE
  IF NOT EXISTS tipos_mov (
    id_tipo_mov INT PRIMARY KEY AUTO_INCREMENT,
    nome_tipo_mov VARCHAR(15)
  );

CREATE TABLE
  IF NOT EXISTS movimentos (
    id_movimento INT PRIMARY KEY AUTO_INCREMENT,
    data_movimento DATE,
    quant_movimento DOUBLE NULL DEFAULT NULL,
    fk_usuario INT,
    fk_tipo INT,
    FOREIGN KEY (fk_usuario) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (fk_tipo) REFERENCES tipos_mov (id_tipo_mov)
  );

CREATE TABLE
  IF NOT EXISTS endereco (
    id_endereco INT PRIMARY KEY AUTO_INCREMENT,
    rua_endereco VARCHAR(30),
    cep VARCHAR(30),
    fk_usuario INT,
    fk_bairro INT NOT NULL,
    fk_movimento INT NOT NULL,
    FOREIGN KEY (fk_usuario) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (fk_bairro) REFERENCES bairros (id_bairro),
    FOREIGN KEY (fk_movimento) REFERENCES movimentos (id_movimento)
  );

CREATE TABLE
  IF NOT EXISTS generos (
    id_genero INT PRIMARY KEY AUTO_INCREMENT,
    nome_genero VARCHAR(80)
  );

CREATE TABLE
  IF NOT EXISTS locais (
    id_local INT PRIMARY KEY AUTO_INCREMENT,
    sessao_local VARCHAR(10),
    fileira_local INT,
    num_fileira_local INT
  );

CREATE TABLE
  IF NOT EXISTS livros (
    id_livro INT PRIMARY KEY AUTO_INCREMENT,
    titulo_livro VARCHAR(80) NOT NULL,
    valor_venda_livro DOUBLE,
    valor_aluguel_livro DOUBLE,
    isbn_livro VARCHAR(80),
    quantidade_livro INT,
    fk_local INT,
    FOREIGN KEY (fk_local) REFERENCES locais (id_local)
  );

CREATE TABLE
  IF NOT EXISTS livros_autores (
    id_livro_autor INT PRIMARY KEY AUTO_INCREMENT,
    fk_livro INT,
    fk_autor INT,
    FOREIGN KEY (fk_livro) REFERENCES livros (id_livro),
    FOREIGN KEY (fk_autor) REFERENCES usuarios (id_usuario)
  );

CREATE TABLE
  IF NOT EXISTS livros_generos (
    id_livro_genero INT PRIMARY KEY AUTO_INCREMENT,
    fk_livro INT,
    fk_genero INT,
    FOREIGN KEY (fk_livro) REFERENCES livros (id_livro),
    FOREIGN KEY (fk_genero) REFERENCES generos (id_genero)
  );

CREATE TABLE
  IF NOT EXISTS livros_movimentos (
    id_livro_movimento INT PRIMARY KEY AUTO_INCREMENT,
    fk_livro INT,
    fk_movimento INT,
    FOREIGN KEY (fk_livro) REFERENCES livros (id_livro),
    FOREIGN KEY (fk_movimento) REFERENCES movimentos (id_movimento)
  );