-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema aniversariantes
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema aniversariantes
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `aniversariantes` ;
USE `aniversariantes` ;

-- -----------------------------------------------------
-- Table `aniversariantes`.`Pessoa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `aniversariantes`.`Pessoa` ;

CREATE TABLE IF NOT EXISTS `aniversariantes`.`Pessoa` (
  `idPessoa` INT NOT NULL AUTO_INCREMENT,
  `NOME_GUERRA` VARCHAR(70) NULL,
  `PGRAD` VARCHAR(25) NULL,
  `DT_NASCIMENTO` DATE NULL,
  PRIMARY KEY (`idPessoa`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
