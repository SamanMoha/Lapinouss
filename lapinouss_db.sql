SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `game_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `game_type` (
  `id_game_type` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `description` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id_game_type`))
ENGINE = InnoDB;

--
-- Contenu de la table `game_type`
--

INSERT INTO `game_type` (`id_game_type`, `name`, `description`) VALUES
(1, 'Mathématique', 'Envie de défier Albert Einstein ? C''est par ici !'),
(2, 'Dessin', 'Formes, couleurs, animations sont par ici.');

-- -----------------------------------------------------
-- Table `game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `game` (
  `id_game` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NULL DEFAULT NULL,
  `picture` VARCHAR(150) NULL DEFAULT NULL,
  `description` VARCHAR(300) NULL DEFAULT NULL,
  `price` FLOAT NULL DEFAULT NULL,
  `created_date` DATE NULL DEFAULT NULL,
  `file` TEXT NULL DEFAULT NULL,
  `id_game_type` INT NULL DEFAULT NULL,
  `available` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id_game`),
  INDEX `FK_game_id_game_type` (`id_game_type` ASC),
  CONSTRAINT `FK_game_id_game_type`
    FOREIGN KEY (`id_game_type`)
    REFERENCES `game_type` (`id_game_type`))
ENGINE = InnoDB;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id_game`, `title`, `picture`, `description`, `price`, `created_date`, `file`, `id_game_type`, `available`) VALUES
(1, 'Geometry Shapes', 'photo.jpg', 'Rendons à sa forme ce qui appartient à son contour.', 0, '2015-07-03', 'View/GeometryGame.html', 2, 1),
(2, 'Guess color', 'logo.jpg', 'Sauras tu retrouver les couleurs que tu entends ?', 0, '2015-10-19', 'index.html', 2, 1),
(3, 'Magic formula', 'logo_jeu.jpg', 'Viens trouver la solution magique à ce problème !', 0, '2015-07-03', 'template.html', 1, 1);

-- -----------------------------------------------------
-- Table `trophy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trophy` (
  `id_trophy` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL DEFAULT NULL,
  `description` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id_trophy`))
ENGINE = InnoDB;

--
-- Contenu de la table `trophy`
--

INSERT INTO `trophy` (`id_trophy`, `name`, `description`) VALUES
(1, 'Champignon en Or', '15 à 20 points.'),
(2, 'Champignon en Argent', '10 à 15 points.'),
(3, 'Champignon en Bronze', '5 à 10 points.'),
(4, 'Champignon en Chocolat', '0 à 10 points.'),

(5, 'Arc-en-ciel', 'une série sans fautes'),
(6, 'Licorne', 'a joué 5 parties'),

(7, 'Cheval', 'finit la partie en 3 minutes'),
(8, 'Flash', 'finit la partie en moins d’une minute'),
(9, 'Escargot', 'finit la partie au bout de 5 minutes ou +'),
(10, 'Génie', 'gagne le max de points.'),
(11, 'Assidus', 'a joué 5 parties'),
(12, 'Bonnet d’âne', 'abandonne la partie');

-- -----------------------------------------------------
-- Table `child_account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `child_account` (
  `id_child_account` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NULL DEFAULT NULL,
  `last_name` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id_child_account`))
ENGINE = InnoDB;

--
-- Contenu de la table `child_account`
--

INSERT INTO `child_account` (`id_child_account`, `first_name`, `last_name`, `password`) VALUES
(1, 'Kent ', 'Beck', '103174cab4844d86236ca1c9a9cc928338fc93a8'),
(2, 'Simon', 'Brown', '103174cab4844d86236ca1c9a9cc928338fc93a8');


-- -----------------------------------------------------
-- Table `account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `account` (
  `id_account` INT(11) NOT NULL AUTO_INCREMENT,
  `permission` VARCHAR(25) NOT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(50) NULL DEFAULT NULL,
  `first_name` VARCHAR(50) NULL DEFAULT NULL,
  `last_name` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id_account`))
ENGINE = InnoDB;

--
-- Contenu de la table `account`
--

INSERT INTO `account` (`id_account`, `permission`, `email`, `password`, `first_name`, `last_name`) VALUES
(1, 'Professeur', 'martin@fowler.com', '103174cab4844d86236ca1c9a9cc928338fc93a8', 'Martin', 'Fowler');


-- -----------------------------------------------------
-- Table `comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` INT(11) NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(200) NULL DEFAULT NULL,
  `date_comment` DATE NULL DEFAULT NULL,
  `id_account` INT NOT NULL,
  `id_game` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id_comment`, `id_account`),
  INDEX `FK_comment_id_account` (`id_account` ASC),
  INDEX `FK_comment_id_game` (`id_game` ASC),
  CONSTRAINT `FK_comment_id_account`
    FOREIGN KEY (`id_account`)
    REFERENCES `account` (`id_account`),
  CONSTRAINT `FK_comment_id_game`
    FOREIGN KEY (`id_game`)
    REFERENCES `game` (`id_game`))
ENGINE = InnoDB;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `comment`, `date_comment`, `id_account`, `id_game`) VALUES
(1, 'Pas mal :)', '2015-12-16', 1, 1),
(2, 'Mes enfants adorent !', '2016-03-15', 1, 2);

-- -----------------------------------------------------
-- Table `success`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `success` (
  `id_success` INT(11) NOT NULL AUTO_INCREMENT,
  `obtention_date` DATE NULL DEFAULT NULL,
  `id_trophy` INT NULL DEFAULT NULL,
  `id_child_account` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id_success`),
  INDEX `FK_success_id_trophy` (`id_trophy` ASC),
  INDEX `FK_success_id_child_account` (`id_child_account` ASC),
  CONSTRAINT `FK_success_id_trophy`
    FOREIGN KEY (`id_trophy`)
    REFERENCES `trophy` (`id_trophy`),
  CONSTRAINT `FK_success_id_child_account`
    FOREIGN KEY (`id_child_account`)
    REFERENCES `child_account` (`id_child_account`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `played`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `played` (
  `id_played` INT(11) NOT NULL AUTO_INCREMENT,
  `played_time` INT NULL DEFAULT NULL,
  `date_game` DATE NULL DEFAULT NULL,
  `id_game` INT NOT NULL,
  `id_child_account` INT NOT NULL,
  PRIMARY KEY (`id_played`, `id_game`, `id_child_account`),
  INDEX `FK_played_id_game` (`id_game` ASC),
  INDEX `FK_played_id_child_account` (`id_child_account` ASC),
  CONSTRAINT `FK_played_id_game`
    FOREIGN KEY (`id_game`)
    REFERENCES `game` (`id_game`),
  CONSTRAINT `FK_played_id_child_account`
    FOREIGN KEY (`id_child_account`)
    REFERENCES `child_account` (`id_child_account`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `game_has_trophy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `game_has_trophy` (
  `id_game` INT NOT NULL,
  `id_trophy` INT NOT NULL,
  PRIMARY KEY (`id_game`, `id_trophy`),
  INDEX `FK_game_has_trophy_id_trophy` (`id_trophy` ASC),
  CONSTRAINT `FK_game_has_trophy_id_game`
    FOREIGN KEY (`id_game`)
    REFERENCES `game` (`id_game`),
  CONSTRAINT `FK_game_has_trophy_id_trophy`
    FOREIGN KEY (`id_trophy`)
    REFERENCES `trophy` (`id_trophy`))
ENGINE = InnoDB;

--
-- Contenu de la table `game_has_trophy`
--

INSERT INTO `game_has_trophy` (`id_game`, `id_trophy`) VALUES
-- Magic formula
(3, 1),
(3, 2),
(3, 3),
(3, 4),

-- Guess the color
(2, 5),
(2, 6),

-- Geometric Shapes
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12);


-- -----------------------------------------------------
-- Table `downloaded_game_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `downloaded_game_type` (
  `id_account` INT NOT NULL,
  `id_game_type` INT NOT NULL,
  PRIMARY KEY (`id_account`, `id_game_type`),
  INDEX `FK_downloaded_game_type_id_game_type` (`id_game_type` ASC),
  CONSTRAINT `FK_downloaded_game_type_id_account`
    FOREIGN KEY (`id_account`)
    REFERENCES `account` (`id_account`),
  CONSTRAINT `FK_downloaded_game_type_id_game_type`
    FOREIGN KEY (`id_game_type`)
    REFERENCES `game_type` (`id_game_type`))
ENGINE = InnoDB;

--
-- Contenu de la table `downloaded_game_type`
--

INSERT INTO `downloaded_game_type` (`id_account`, `id_game_type`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1);

-- -----------------------------------------------------
-- Table `parent_has_child`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parent_has_child` (
  `id_account` INT NOT NULL,
  `id_child_account` INT NOT NULL,
  PRIMARY KEY (`id_account`, `id_child_account`),
  INDEX `FK_parent_has_child_id_child_account` (`id_child_account` ASC),
  CONSTRAINT `FK_parent_has_child_id_account`
    FOREIGN KEY (`id_account`)
    REFERENCES `account` (`id_account`),
  CONSTRAINT `FK_parent_has_child_id_child_account`
    FOREIGN KEY (`id_child_account`)
    REFERENCES `child_account` (`id_child_account`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `downloaded_game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `downloaded_game` (
  `id_account` INT(11) NOT NULL,
  `id_game` INT(11) NOT NULL,
  PRIMARY KEY (`id_account`, `id_game`),
  INDEX `fk_account_has_game_game1_idx` (`id_game` ASC),
  INDEX `fk_account_has_game_account1_idx` (`id_account` ASC),
  CONSTRAINT `fk_account_has_game_account1`
    FOREIGN KEY (`id_account`)
    REFERENCES `account` (`id_account`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_account_has_game_game1`
    FOREIGN KEY (`id_game`)
    REFERENCES `game` (`id_game`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `child_account_has_downloaded_game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `child_account_has_downloaded_game` (
  `id_child_account` INT(11) NOT NULL,
  `downloaded_game_id_account` INT(11) NOT NULL,
  `downloaded_game_id_game` INT(11) NOT NULL,
  PRIMARY KEY (`id_child_account`, `downloaded_game_id_account`, `downloaded_game_id_game`),
  INDEX `fk_child_account_has_downloaded_game_downloaded_game1_idx` (`downloaded_game_id_account` ASC, `downloaded_game_id_game` ASC),
  INDEX `fk_child_account_has_downloaded_game_child_account1_idx` (`id_child_account` ASC),
  CONSTRAINT `fk_child_account_has_downloaded_game_child_account1`
  FOREIGN KEY (`id_child_account`)
  REFERENCES `child_account` (`id_child_account`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_child_account_has_downloaded_game_downloaded_game1`
  FOREIGN KEY (`downloaded_game_id_account` , `downloaded_game_id_game`)
  REFERENCES `downloaded_game` (`id_account` , `id_game`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
