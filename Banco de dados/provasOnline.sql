-- MySQL Script generated by MySQL Workbench
-- Dom 23 Out 2016 21:24:16 BRST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema SistemaProvasOnline
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `SistemaProvasOnline` ;

-- -----------------------------------------------------
-- Schema SistemaProvasOnline
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SistemaProvasOnline` DEFAULT CHARACTER SET latin1 ;
SHOW WARNINGS;
USE `SistemaProvasOnline` ;

-- -----------------------------------------------------
-- Table `Aluno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Aluno` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Aluno` (
  `cpfAluno` VARCHAR(11) NOT NULL,
  `nomeAluno` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`cpfAluno`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Professor` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Professor` (
  `cpfProfessor` VARCHAR(11) NOT NULL,
  `nomeProfessor` VARCHAR(50) NOT NULL,
  `loginProfessor` VARCHAR(45) NOT NULL,
  `senhaProfessor` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cpfProfessor`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ModeloProva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ModeloProva` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ModeloProva` (
  `idModeloProva` INT NOT NULL,
  `dataInicioModeloProva` DATE NOT NULL,
  `dataTerminoModeloProva` DATE NOT NULL,
  `tituloModeloProva` VARCHAR(45) NOT NULL,
  `cpfProfessor` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`idModeloProva`, `cpfProfessor`),
  CONSTRAINT `fk_ModeloProva_Professor`
    FOREIGN KEY (`cpfProfessor`)
    REFERENCES `Professor` (`cpfProfessor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_ModeloProva_Professor_idx` ON `ModeloProva` (`cpfProfessor` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ProvaAluno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProvaAluno` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ProvaAluno` (
  `idProvaAluno` INT NOT NULL AUTO_INCREMENT,
  `notaProvaAluno` FLOAT NOT NULL,
  `cpfAluno` VARCHAR(11) NOT NULL,
  `idModeloProva` INT NOT NULL,
  `cpfProfessor` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`idProvaAluno`, `cpfAluno`, `idModeloProva`, `cpfProfessor`),
  CONSTRAINT `fk_ProvaAluno_Aluno1`
    FOREIGN KEY (`cpfAluno`)
    REFERENCES `Aluno` (`cpfAluno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProvaAluno_ModeloProva1`
    FOREIGN KEY (`idModeloProva` , `cpfProfessor`)
    REFERENCES `ModeloProva` (`idModeloProva` , `cpfProfessor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_ProvaAluno_Aluno1_idx` ON `ProvaAluno` (`cpfAluno` ASC);

SHOW WARNINGS;
CREATE INDEX `fk_ProvaAluno_ModeloProva1_idx` ON `ProvaAluno` (`idModeloProva` ASC, `cpfProfessor` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Pergunta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Pergunta` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Pergunta` (
  `idPergunta` INT NOT NULL,
  `questaoPergunta` MEDIUMTEXT NOT NULL,
  `idModeloProva` INT NOT NULL,
  PRIMARY KEY (`idPergunta`, `idModeloProva`),
  CONSTRAINT `fk_Pergunta_ModeloProva1`
    FOREIGN KEY (`idModeloProva`)
    REFERENCES `ModeloProva` (`idModeloProva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_Pergunta_ModeloProva1_idx` ON `Pergunta` (`idModeloProva` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Alternativa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Alternativa` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Alternativa` (
  `idAlternativa` INT NOT NULL,
  `alternativa` TINYTEXT NOT NULL,
  `respostaAlternativa` TINYINT(1) NOT NULL,
  `idPergunta` INT NOT NULL,
  PRIMARY KEY (`idAlternativa`, `idPergunta`),
  CONSTRAINT `fk_Alternativa_Pergunta1`
    FOREIGN KEY (`idPergunta`)
    REFERENCES `Pergunta` (`idPergunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_Alternativa_Pergunta1_idx` ON `Alternativa` (`idPergunta` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Aluno_PodeFazer_Prova`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Aluno_PodeFazer_Prova` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Aluno_PodeFazer_Prova` (
  `cpfAluno` VARCHAR(11) NOT NULL,
  `idModeloProva` INT NOT NULL,
  PRIMARY KEY (`cpfAluno`, `idModeloProva`),
  CONSTRAINT `fk_Aluno_has_ModeloProva_Aluno1`
    FOREIGN KEY (`cpfAluno`)
    REFERENCES `Aluno` (`cpfAluno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aluno_has_ModeloProva_ModeloProva1`
    FOREIGN KEY (`idModeloProva`)
    REFERENCES `ModeloProva` (`idModeloProva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_Aluno_has_ModeloProva_ModeloProva1_idx` ON `Aluno_PodeFazer_Prova` (`idModeloProva` ASC);

SHOW WARNINGS;
CREATE INDEX `fk_Aluno_has_ModeloProva_Aluno1_idx` ON `Aluno_PodeFazer_Prova` (`cpfAluno` ASC);

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ProvaAlunoRespondeu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProvaAlunoRespondeu` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ProvaAlunoRespondeu` (
  `idProvaAluno` INT NOT NULL,
  `Alternativa_idAlternativa` INT NOT NULL,
  PRIMARY KEY (`idProvaAluno`, `Alternativa_idAlternativa`),
  CONSTRAINT `fk_ProvaAluno_has_Alternativa_ProvaAluno1`
    FOREIGN KEY (`idProvaAluno`)
    REFERENCES `ProvaAluno` (`idProvaAluno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProvaAluno_has_Alternativa_Alternativa1`
    FOREIGN KEY (`Alternativa_idAlternativa`)
    REFERENCES `Alternativa` (`idAlternativa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_ProvaAluno_has_Alternativa_Alternativa1_idx` ON `ProvaAlunoRespondeu` (`Alternativa_idAlternativa` ASC);

SHOW WARNINGS;
CREATE INDEX `fk_ProvaAluno_has_Alternativa_ProvaAluno1_idx` ON `ProvaAlunoRespondeu` (`idProvaAluno` ASC);

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
