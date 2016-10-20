SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Aluno`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Aluno` (
  `cpfAluno` VARCHAR(11) NOT NULL ,
  `nomeAluno` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`cpfAluno`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Professor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Professor` (
  `cpfProfessor` VARCHAR(11) NOT NULL ,
  `nomeProfessor` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`cpfProfessor`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ModeloProva`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ModeloProva` (
  `idModeloProva` INT NOT NULL ,
  `dataInicioModeloProva` DATE NOT NULL ,
  `dataTerminoModeloProva` DATE NOT NULL ,
  `tituloModeloProva` VARCHAR(45) NOT NULL ,
  `Professor_cpfProfessor` VARCHAR(11) NOT NULL ,
  PRIMARY KEY (`idModeloProva`, `Professor_cpfProfessor`) ,
  INDEX `fk_ModeloProva_Professor` (`Professor_cpfProfessor` ASC) ,
  CONSTRAINT `fk_ModeloProva_Professor`
    FOREIGN KEY (`Professor_cpfProfessor` )
    REFERENCES `mydb`.`Professor` (`cpfProfessor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ProvaAluno`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ProvaAluno` (
  `idProvaAluno` INT NOT NULL AUTO_INCREMENT ,
  `notaProvaAluno` FLOAT NOT NULL ,
  `respotasProvaAluno` TINYTEXT NOT NULL ,
  `Aluno_cpfAluno` VARCHAR(11) NOT NULL ,
  `ModeloProva_idModeloProva` INT NOT NULL ,
  `ModeloProva_Professor_cpfProfessor` VARCHAR(11) NOT NULL ,
  PRIMARY KEY (`idProvaAluno`, `Aluno_cpfAluno`, `ModeloProva_idModeloProva`, `ModeloProva_Professor_cpfProfessor`) ,
  INDEX `fk_ProvaAluno_Aluno1` (`Aluno_cpfAluno` ASC) ,
  INDEX `fk_ProvaAluno_ModeloProva1` (`ModeloProva_idModeloProva` ASC, `ModeloProva_Professor_cpfProfessor` ASC) ,
  CONSTRAINT `fk_ProvaAluno_Aluno1`
    FOREIGN KEY (`Aluno_cpfAluno` )
    REFERENCES `mydb`.`Aluno` (`cpfAluno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProvaAluno_ModeloProva1`
    FOREIGN KEY (`ModeloProva_idModeloProva` , `ModeloProva_Professor_cpfProfessor` )
    REFERENCES `mydb`.`ModeloProva` (`idModeloProva` , `Professor_cpfProfessor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Pergunta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Pergunta` (
  `idPergunta` INT NOT NULL ,
  `questaoPergunta` MEDIUMTEXT NOT NULL ,
  `ModeloProva_idModeloProva` INT NOT NULL ,
  `ModeloProva_Professor_cpfProfessor` VARCHAR(11) NOT NULL ,
  PRIMARY KEY (`idPergunta`, `ModeloProva_idModeloProva`, `ModeloProva_Professor_cpfProfessor`) ,
  INDEX `fk_Pergunta_ModeloProva1` (`ModeloProva_idModeloProva` ASC, `ModeloProva_Professor_cpfProfessor` ASC) ,
  CONSTRAINT `fk_Pergunta_ModeloProva1`
    FOREIGN KEY (`ModeloProva_idModeloProva` , `ModeloProva_Professor_cpfProfessor` )
    REFERENCES `mydb`.`ModeloProva` (`idModeloProva` , `Professor_cpfProfessor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Alternativa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Alternativa` (
  `idAlternativa` INT NOT NULL ,
  `alternativa` TINYTEXT NOT NULL ,
  `respostaAlternativa` TINYINT(1)  NOT NULL ,
  `Pergunta_idPergunta` INT NOT NULL ,
  `Pergunta_ModeloProva_idModeloProva` INT NOT NULL ,
  `Pergunta_ModeloProva_Professor_cpfProfessor` VARCHAR(11) NOT NULL ,
  PRIMARY KEY (`idAlternativa`, `Pergunta_idPergunta`, `Pergunta_ModeloProva_idModeloProva`, `Pergunta_ModeloProva_Professor_cpfProfessor`) ,
  INDEX `fk_Alternativa_Pergunta1` (`Pergunta_idPergunta` ASC, `Pergunta_ModeloProva_idModeloProva` ASC, `Pergunta_ModeloProva_Professor_cpfProfessor` ASC) ,
  CONSTRAINT `fk_Alternativa_Pergunta1`
    FOREIGN KEY (`Pergunta_idPergunta` , `Pergunta_ModeloProva_idModeloProva` , `Pergunta_ModeloProva_Professor_cpfProfessor` )
    REFERENCES `mydb`.`Pergunta` (`idPergunta` , `ModeloProva_idModeloProva` , `ModeloProva_Professor_cpfProfessor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
