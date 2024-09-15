-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bd_biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd_biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd_biblioteca` DEFAULT CHARACTER SET utf8mb4 ;
USE `bd_biblioteca` ;

-- -----------------------------------------------------
-- Table `bd_biblioteca`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`usuarios` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(80) NULL DEFAULT NULL,
  `login_usuario` VARCHAR(80) NOT NULL,
  `senha_usuario` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `bd_biblioteca`.`usuarios`
ADD UNIQUE KEY `login_usuarios` (`login_usuario`);

-- -----------------------------------------------------
-- Table `bd_biblioteca`.`estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`estados` (
  `id_estado` INT NOT NULL,
  `nome_estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_estado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`cidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`cidades` (
  `id_cidade` INT NOT NULL,
  `nome_cidade` VARCHAR(45) NULL,
  `estados_id_estado` INT NOT NULL,
  PRIMARY KEY (`id_cidade`),
  CONSTRAINT `fk_cidades_estados1`
    FOREIGN KEY (`estados_id_estado`)
    REFERENCES `bd_biblioteca`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

ALTER TABLE `bd_biblioteca`.`usuarios`
ADD UNIQUE KEY `login_usuario` (`login_usuario`);

ALTER TABLE `bd_biblioteca`.`cidades`
ADD KEY `fk_cidades_estados1_idx` (`estados_id_estado`);



-- -----------------------------------------------------
-- Table `bd_biblioteca`.`bairros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`bairros` (
  `id_bairro` INT NOT NULL,
  `nome_bairro` VARCHAR(45) NULL,
  `cidades_id_cidade` INT NOT NULL,
  PRIMARY KEY (`id_bairro`),
  CONSTRAINT `fk_bairros_cidades1`
    FOREIGN KEY (`cidades_id_cidade`)
    REFERENCES `bd_biblioteca`.`cidades` (`id_cidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

ALTER TABLE `bd_biblioteca`.`bairros`
ADD KEY `fk_bairros_cidades1_idx` (`cidades_id_cidade`);


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`tipos_mov`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`tipos_mov` (
  `id_tipo_mov` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_tipo_mov` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_mov`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`movimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`movimentos` (
  `id_movimento` INT(11) NOT NULL AUTO_INCREMENT,
  `data_movimento` DATE NULL DEFAULT NULL,
  `quant_movimento` DOUBLE NULL DEFAULT NULL,
  `fk_usuario_movimento` INT(11) NULL DEFAULT NULL,
  `fk_tipo_movimento` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_movimento`),
  CONSTRAINT `movimentos_ibfk_1`
    FOREIGN KEY (`fk_usuario_movimento`)
    REFERENCES `bd_biblioteca`.`usuarios` (`id_usuario`),
  CONSTRAINT `movimentos_ibfk_2`
    FOREIGN KEY (`fk_tipo_movimento`)
    REFERENCES `bd_biblioteca`.`tipos_mov` (`id_tipo_mov`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `bd_biblioteca`.`movimentos`
ADD KEY `fk_usuario_movimento` (`fk_usuario_movimento`);

ALTER TABLE `bd_biblioteca`.`movimentos`
ADD KEY `fk_tipo_movimento` (`fk_tipo_movimento`);



-- -----------------------------------------------------
-- Table `bd_biblioteca`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`endereco` (
  `id_endereco` INT(11) NOT NULL AUTO_INCREMENT,
  `rua_endereco` VARCHAR(30) NULL DEFAULT NULL,
  `cep` VARCHAR(30) NULL,
  `fk_usuario_endereco` INT(11) NULL DEFAULT NULL,
  `fk_bairro` INT(11) NOT NULL,
  `fk_movimento` INT(11) NOT NULL,
  PRIMARY KEY (`id_endereco`),
  CONSTRAINT `endereco_ibfk_1`
    FOREIGN KEY (`fk_usuario_endereco`)
    REFERENCES `bd_biblioteca`.`usuarios` (`id_usuario`),
  CONSTRAINT `fk_endereco_bairros1`
    FOREIGN KEY (`fk_bairro`)
    REFERENCES `bd_biblioteca`.`bairros` (`id_bairro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_endereco_movimentos1`
    FOREIGN KEY (`fk_movimento`)
    REFERENCES `bd_biblioteca`.`movimentos` (`id_movimento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `bd_biblioteca`.`endereco`
ADD KEY `fk_usuario_endereco` (`fk_usuario_endereco`);

ALTER TABLE `bd_biblioteca`.`endereco`
ADD KEY `fk_endereco_bairros1_idx` (`fk_bairro`);

ALTER TABLE `bd_biblioteca`.`endereco`
ADD KEY `fk_endereco_movimentos1_idx` (`fk_movimento`);

-- -----------------------------------------------------
-- Table `bd_biblioteca`.`generos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`generos` (
  `id_genero` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_genero` VARCHAR(80) NULL DEFAULT NULL,
  PRIMARY KEY (`id_genero`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`locais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`locais` (
  `id_local` INT(11) NOT NULL AUTO_INCREMENT,
  `sessao_local` VARCHAR(10) NULL DEFAULT NULL,
  `fileira_local` INT(11) NULL DEFAULT NULL,
  `num_fileira_local` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_local`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`livros` (
  `id_livro` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo_livro` VARCHAR(80) NOT NULL,
  `valor_venda_livro` DOUBLE NULL DEFAULT NULL,
  `valor_aluguel_livro` DOUBLE NULL DEFAULT NULL,
  `isbn_livro` VARCHAR(80) NULL DEFAULT NULL,
  `quantidade_livro` INT(11) NULL DEFAULT NULL,
  `fk_local_livro` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_livro`),
  CONSTRAINT `livros_ibfk_1`
    FOREIGN KEY (`fk_local_livro`)
    REFERENCES `bd_biblioteca`.`locais` (`id_local`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `bd_biblioteca`.`livros`
ADD KEY `fk_local_livro` (`fk_local_livro`);

-- -----------------------------------------------------
-- Table `bd_biblioteca`.`livros_autores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`livros_autores` (
  `fk_livro` INT(11) NULL DEFAULT NULL,
  `fk_autor` INT(11) NULL DEFAULT NULL,
  CONSTRAINT `livros_autores_ibfk_1`
    FOREIGN KEY (`fk_autor`)
    REFERENCES `bd_biblioteca`.`usuarios` (`id_usuario`),
  CONSTRAINT `livros_autores_ibfk_2`
    FOREIGN KEY (`fk_livro`)
    REFERENCES `bd_biblioteca`.`livros` (`id_livro`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `bd_biblioteca`.`livros_autores`
ADD KEY `fk_autor` (`fk_autor`);

ALTER TABLE `bd_biblioteca`.`livros_autores`
ADD KEY `fk_livro` (`fk_livro`);

-- -----------------------------------------------------
-- Table `bd_biblioteca`.`livros_generos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`livros_generos` (
  `fk_livro` INT(11) NULL DEFAULT NULL,
  `fk_genero` INT(11) NULL DEFAULT NULL,
  CONSTRAINT `livros_generos_ibfk_1`
    FOREIGN KEY (`fk_livro`)
    REFERENCES `bd_biblioteca`.`livros` (`id_livro`),
  CONSTRAINT `livros_generos_ibfk_2`
    FOREIGN KEY (`fk_genero`)
    REFERENCES `bd_biblioteca`.`generos` (`id_genero`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `bd_biblioteca`.`livros_generos`
ADD KEY `fk_livros` (`fk_livro`);

ALTER TABLE `bd_biblioteca`.`livros_generos`
ADD KEY `fk_generos` (`fk_genero`);


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`livros_movimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`livros_movimentos` (
  `fk_livro` INT(11) NULL DEFAULT NULL,
  `fk_movimento` INT(11) NULL DEFAULT NULL,
  CONSTRAINT `livros_movimentos_ibfk_1`
    FOREIGN KEY (`fk_livro`)
    REFERENCES `bd_biblioteca`.`livros` (`id_livro`),
  CONSTRAINT `livros_movimentos_ibfk_2`
    FOREIGN KEY (`fk_movimento`)
    REFERENCES `bd_biblioteca`.`movimentos` (`id_movimento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `bd_biblioteca`.`livros_movimentos`
ADD KEY `fk_livros2` (`fk_livro`);

ALTER TABLE `bd_biblioteca`.`livros_movimentos`
ADD KEY `fk_movimento2` (`fk_movimento`);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
