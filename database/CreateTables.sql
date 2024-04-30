-- MySQL Script generated by MySQL Workbench
-- Wed Mar 13 10:28:34 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbchevalersk9
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbchevalersk9
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbchevalersk9` DEFAULT CHARACTER SET utf8 ;
USE `dbchevalersk9` ;

-- -----------------------------------------------------
-- Table `dbchevalersk9`.`joueurs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`joueurs` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`joueurs` (
  `idJoueur` INT NOT NULL AUTO_INCREMENT,
  `alias` VARCHAR(40) NOT NULL,
  `prenom` VARCHAR(40) NULL,
  `nom` VARCHAR(40) NULL,
  `avatar` TEXT NOT NULL,
  `solde` INT NOT NULL DEFAULT 1000,
  `soldeParAdmin` INT NOT NULL DEFAULT 0,
  `niveauAlchimie` INT NOT NULL DEFAULT 0 COMMENT 'de 0 a 3\n',
  `estAdmin` TINYINT NOT NULL DEFAULT 0,
  `nbQueteAlchimie` INT NOT NULL DEFAULT 0,
  `nbQueteReussie` INT NOT NULL DEFAULT 0,
  `nbQueteEchoue` INT NOT NULL DEFAULT 0,
  `nbPotionCree` INT NOT NULL DEFAULT 0,
  `nbEcuGagne` INT NOT NULL DEFAULT 0,
  `nbEcuDepense` INT NOT NULL DEFAULT 0,
  `motDePasse` TEXT NOT NULL,
  PRIMARY KEY (`idJoueur`),
  UNIQUE INDEX `alias_UNIQUE` (`alias` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`items` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`items` (
  `idItem` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `prix` INT NOT NULL,
  `quantiteStock` INT NOT NULL DEFAULT 0,
  `type` ENUM("arme", "armure", "potion", "ingredient") NOT NULL,
  `vendable` TINYINT NOT NULL,
  `image` TEXT NOT NULL,
  PRIMARY KEY (`idItem`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`armes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`armes` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`armes` (
  `idItem` INT NOT NULL,
  `efficacite` INT NOT NULL DEFAULT 0,
  `type` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`idItem`),
  CONSTRAINT `fk_armes_items1`
    FOREIGN KEY (`idItem`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`armures`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`armures` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`armures` (
  `idItem` INT NOT NULL,
  `materiel` VARCHAR(40) NOT NULL,
  `taille` ENUM("petit", "moyen", "grand") NOT NULL COMMENT 'petit\nmoyen\ngrand',
  PRIMARY KEY (`idItem`),
  CONSTRAINT `fk_armes_items10`
    FOREIGN KEY (`idItem`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`potions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`potions` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`potions` (
  `idItem` INT NOT NULL,
  `type` ENUM("offense", "defense") NOT NULL,
  `effet` VARCHAR(40) NOT NULL,
  `duree` INT NOT NULL,
  PRIMARY KEY (`idItem`),
  CONSTRAINT `fk_armes_items100`
    FOREIGN KEY (`idItem`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`ingredients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`ingredients` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`ingredients` (
  `idItem` INT NOT NULL,
  `type` VARCHAR(40) NOT NULL,
  `rarete` INT NOT NULL,
  `danger` INT NOT NULL,
  PRIMARY KEY (`idItem`),
  CONSTRAINT `fk_armes_items1000`
    FOREIGN KEY (`idItem`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`inventaire`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`inventaire` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`inventaire` (
  `idJoueur` INT NOT NULL,
  `idItem` INT NOT NULL,
  `quantite` INT NOT NULL,
  PRIMARY KEY (`idJoueur`, `idItem`),
  INDEX `fk_inventaire_joueurs1_idx` (`idJoueur` ASC),
  INDEX `fk_inventaire_items1_idx` (`idItem` ASC),
  CONSTRAINT `fk_inventaire_joueurs1`
    FOREIGN KEY (`idJoueur`)
    REFERENCES `dbchevalersk9`.`joueurs` (`idJoueur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventaire_items1`
    FOREIGN KEY (`idItem`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`panier`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`panier` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`panier` (
  `idJoueur` INT NOT NULL,
  `idItem` INT NOT NULL,
  `quantite` INT NOT NULL,
  PRIMARY KEY (`idJoueur`, `idItem`),
  INDEX `fk_inventaire_joueurs1_idx` (`idJoueur` ASC),
  INDEX `fk_inventaire_items1_idx` (`idItem` ASC),
  CONSTRAINT `fk_inventaire_joueurs10`
    FOREIGN KEY (`idJoueur`)
    REFERENCES `dbchevalersk9`.`joueurs` (`idJoueur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventaire_items10`
    FOREIGN KEY (`idItem`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`recettes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`recettes` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`recettes` (
  `idRecette` INT NOT NULL AUTO_INCREMENT,
  `idProduit` INT NOT NULL,
  `niveauAlchimie` INT NOT NULL,
  PRIMARY KEY (`idRecette`),
  INDEX `fk_recettes_items1_idx` (`idProduit` ASC),
  CONSTRAINT `fk_recettes_items1`
    FOREIGN KEY (`idProduit`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`ingredientRecette`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`ingredientRecette` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`ingredientRecette` (
  `idRecette` INT NOT NULL,
  `idIngredient` INT NOT NULL,
  `quantite` INT NOT NULL,
  PRIMARY KEY (`idRecette`, `idIngredient`),
  INDEX `fk_ingredientRecette_items1_idx` (`idIngredient` ASC),
  CONSTRAINT `fk_ingredientRecette_recettes1`
    FOREIGN KEY (`idRecette`)
    REFERENCES `dbchevalersk9`.`recettes` (`idRecette`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingredientRecette_items1`
    FOREIGN KEY (`idIngredient`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`enigmes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`enigmes` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`enigmes` (
  `idEnigme` INT NOT NULL AUTO_INCREMENT,
  `titre` TEXT NOT NULL,
  `question` TEXT NOT NULL,
  `difficulte` INT NOT NULL,
  `alchimie` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`idEnigme`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`reponses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`reponses` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`reponses` (
  `idReponse` INT NOT NULL AUTO_INCREMENT,
  `texte` TEXT NOT NULL,
  `correct` TINYINT NOT NULL DEFAULT 0,
  `idEnigme` INT NOT NULL,
  PRIMARY KEY (`idReponse`),
  INDEX `fk_reponses_enigmes1_idx` (`idEnigme` ASC),
  CONSTRAINT `fk_reponses_enigmes1`
    FOREIGN KEY (`idEnigme`)
    REFERENCES `dbchevalersk9`.`enigmes` (`idEnigme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbchevalersk9`.`commentaires`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbchevalersk9`.`commentaires` ;

CREATE TABLE IF NOT EXISTS `dbchevalersk9`.`commentaires` (
  `idJoueur` INT NOT NULL,
  `idItem` INT NOT NULL,
  `commentaire` TEXT,
  `nbEtoiles` INT NOT NULL COMMENT 'de 1 a 5',
  PRIMARY KEY (`idJoueur`, `idItem`),
  INDEX `fk_commentaires_items1_idx` (`idItem` ASC),
  CONSTRAINT `fk_commentaires_joueurs1`
    FOREIGN KEY (`idJoueur`)
    REFERENCES `dbchevalersk9`.`joueurs` (`idJoueur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentaires_items1`
    FOREIGN KEY (`idItem`)
    REFERENCES `dbchevalersk9`.`items` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
