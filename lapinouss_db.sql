-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lapinouss_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id_account` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(25) NOT NULL,
  `uid` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id_account`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `account`
--

INSERT INTO `account` (`id_account`, `permission`, `uid`, `email`, `password`, `first_name`, `last_name`, `birth_date`, `created_date`) VALUES
(1, 'Parent', '1', 'A.rescurio@yahoo.fr', 'azearzedazhd17', 'Antoine', 'Rescurio', '1988-10-13', '2015-07-12'),
(2, 'Parent', '2', 'W.smith@yahoo.fr', 'princedebelleair222', 'Will', 'Smith', '1983-06-20', '2015-04-10'),
(3, 'Parent', '3', 'mangelo1@yahoo.fr', 'azeDDedazhd17', 'Marco', 'Polo', '1989-04-13', '2015-12-21'),
(4, 'Professeur', '4', 'jpGau@yahoo.fr', 'iamworthit1', 'Jean Paul', 'Gauthier', '1983-06-20', '2015-07-17');

-- --------------------------------------------------------

--
-- Structure de la table `child_account`
--

DROP TABLE IF EXISTS `child_account`;
CREATE TABLE IF NOT EXISTS `child_account` (
  `id_child_account` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(25) DEFAULT NULL,
  `uid` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id_child_account`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `child_account`
--

INSERT INTO `child_account` (`id_child_account`, `permission`, `uid`, `email`, `password`, `first_name`, `last_name`, `birth_date`, `created_date`) VALUES
(1, 'Enfant', '1', 'lepetitfred@gmail.com', 'fredy', 'Fred', 'Carmel', '2008-08-17', '2015-01-15'),
(2, 'Enfant', '2', 'macaron@yahoo.fr', 'azjdfaijih6', 'Oscar', 'Marc', '2015-04-18', '2015-07-06');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(200) DEFAULT NULL,
  `date_comment` date DEFAULT NULL,
  `id_account` int(11) NOT NULL,
  `id_game` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_comment`,`id_account`),
  KEY `FK_comment_id_account` (`id_account`),
  KEY `FK_comment_id_game` (`id_game`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `comment`, `date_comment`, `id_account`, `id_game`) VALUES
(1, 'Pas mal', '2015-12-16', 2, 1),
(2, 'j''aime beaucoup', '2016-03-15', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `criteria`
--

DROP TABLE IF EXISTS `criteria`;
CREATE TABLE IF NOT EXISTS `criteria` (
  `id_criteria` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) DEFAULT NULL,
  `objectif` int(11) DEFAULT NULL,
  `uid` varchar(25) NOT NULL,
  `id_trophy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_criteria`),
  KEY `FK_criteria_id_trophy` (`id_trophy`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `criteria`
--

INSERT INTO `criteria` (`id_criteria`, `type`, `objectif`, `uid`, `id_trophy`) VALUES
(1, '1', 15, '1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `downloaded_game_type`
--

DROP TABLE IF EXISTS `downloaded_game_type`;
CREATE TABLE IF NOT EXISTS `downloaded_game_type` (
  `id_account` int(11) NOT NULL,
  `id_game_type` int(11) NOT NULL,
  PRIMARY KEY (`id_account`,`id_game_type`),
  KEY `FK_downloaded_game_type_id_game_type` (`id_game_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `downloaded_game_type`
--

INSERT INTO `downloaded_game_type` (`id_account`, `id_game_type`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id_game` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(25) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `picture` varchar(150) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `Available` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `file` text,
  `id_game_type` int(11) DEFAULT NULL,
  `purchased_date` date DEFAULT NULL,
  `activated` int(11) DEFAULT NULL,
  `id_account` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_game`),
  KEY `FK_game_id_game_type` (`id_game_type`),
  KEY `FK_game_id_account` (`id_account`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id_game`, `uid`, `title`, `picture`, `description`, `price`, `Available`, `created_date`, `file`, `id_game_type`, `purchased_date`, `activated`, `id_account`) VALUES
(1, '1', 'Geometry Shapes', 'Pic', 'description', 0, 1, '2015-07-03', 'View/GeometryGame.html', 1, '2015-12-10', 1, 2),
(2, '2', 'Guess color', 'pic', 'description', 0, 1, '2015-10-19', 'index.html', 2, '2015-12-18', 1, 2),
(3, '3', 'Magic formula', 'Pic', 'description', 0, 1, '2015-07-03', 'template.html', 1, '2015-12-10', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `game_has_trophy`
--

DROP TABLE IF EXISTS `game_has_trophy`;
CREATE TABLE IF NOT EXISTS `game_has_trophy` (
  `id_game` int(11) NOT NULL,
  `id_trophy` int(11) NOT NULL,
  PRIMARY KEY (`id_game`,`id_trophy`),
  KEY `FK_game_has_trophy_id_trophy` (`id_trophy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `game_has_trophy`
--

INSERT INTO `game_has_trophy` (`id_game`, `id_trophy`) VALUES
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12);

-- --------------------------------------------------------

--
-- Structure de la table `game_type`
--

DROP TABLE IF EXISTS `game_type`;
CREATE TABLE IF NOT EXISTS `game_type` (
  `id_game_type` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(25) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `file` text,
  PRIMARY KEY (`id_game_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `game_type`
--

INSERT INTO `game_type` (`id_game_type`, `uid`, `name`, `description`, `file`) VALUES
(1, '1', 'Mathématique', 'description', 'txt'),
(2, '2', 'Dessin', 'description', 'txt');

-- --------------------------------------------------------

--
-- Structure de la table `parent_has_child`
--

DROP TABLE IF EXISTS `parent_has_child`;
CREATE TABLE IF NOT EXISTS `parent_has_child` (
  `id_account` int(11) NOT NULL,
  `id_child_account` int(11) NOT NULL,
  PRIMARY KEY (`id_account`,`id_child_account`),
  KEY `FK_parent_has_child_id_child_account` (`id_child_account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `parent_has_child`
--

INSERT INTO `parent_has_child` (`id_account`, `id_child_account`) VALUES
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `played`
--

DROP TABLE IF EXISTS `played`;
CREATE TABLE IF NOT EXISTS `played` (
  `id_played` int(11) NOT NULL AUTO_INCREMENT,
  `played_time` datetime DEFAULT NULL,
  `date_game` date DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `id_game` int(11) NOT NULL,
  `id_child_account` int(11) NOT NULL,
  PRIMARY KEY (`id_played`,`id_game`,`id_child_account`),
  KEY `FK_played_id_game` (`id_game`),
  KEY `FK_played_id_child_account` (`id_child_account`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `played`
--

INSERT INTO `played` (`id_played`, `played_time`, `date_game`, `score`, `id_game`, `id_child_account`) VALUES
(1, '2016-01-12 16:32:18', '2016-01-12', 32, 1, 1),
(2, '2016-01-18 17:14:20', '2016-01-18', 15, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `success`
--

DROP TABLE IF EXISTS `success`;
CREATE TABLE IF NOT EXISTS `success` (
  `id_success` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(25) NOT NULL,
  `obtention_date` date DEFAULT NULL,
  `id_trophy` int(11) DEFAULT NULL,
  `id_child_account` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_success`),
  KEY `FK_success_id_trophy` (`id_trophy`),
  KEY `FK_success_id_child_account` (`id_child_account`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `success`
--

INSERT INTO `success` (`id_success`, `uid`, `obtention_date`, `id_trophy`, `id_child_account`) VALUES
(1, '1', '2016-01-12', 2, 1),
(2, '2', '2015-09-12', 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `trophy`
--

DROP TABLE IF EXISTS `trophy`;
CREATE TABLE IF NOT EXISTS `trophy` (
  `id_trophy` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(25) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_trophy`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `trophy`
--

INSERT INTO `trophy` (`id_trophy`, `uid`, `name`, `description`) VALUES
(1, '1', 'Champignon en Or', '15 à 20 points.'),
(2, '2', 'Champignon en Argent', '10 à 15 points.'),
(3, '3', 'Champignon en Bronze', '5 à 10 points.'),
(4, '4', 'Champignon en Chocolat', '0 à 10 points.'),
(5, '5', 'Arc-en-ciel', 'une série sans fautes'),
(6, '6', 'Licorne', 'a joué 5 parties'),
(7, '7', 'Cheval', 'finit la partie en 3 minutes'),
(8, '8', 'Flash', 'finit la partie en moins d’une minute'),
(9, '9', 'Escargot', 'finit la partie au bout de 5 minutes ou +'),
(10, '10', 'Génie', 'gagne le max de points.'),
(11, '11', 'Assidus', 'a joué 5 parties'),
(12, '12', 'Bonnet d’âne', 'abandonne la partie');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_comment_id_account` FOREIGN KEY (`id_account`) REFERENCES `account` (`id_account`),
  ADD CONSTRAINT `FK_comment_id_game` FOREIGN KEY (`id_game`) REFERENCES `game` (`id_game`);

--
-- Contraintes pour la table `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `FK_criteria_id_trophy` FOREIGN KEY (`id_trophy`) REFERENCES `trophy` (`id_trophy`);

--
-- Contraintes pour la table `downloaded_game_type`
--
ALTER TABLE `downloaded_game_type`
  ADD CONSTRAINT `FK_downloaded_game_type_id_account` FOREIGN KEY (`id_account`) REFERENCES `account` (`id_account`),
  ADD CONSTRAINT `FK_downloaded_game_type_id_game_type` FOREIGN KEY (`id_game_type`) REFERENCES `game_type` (`id_game_type`);

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `FK_game_id_account` FOREIGN KEY (`id_account`) REFERENCES `account` (`id_account`),
  ADD CONSTRAINT `FK_game_id_game_type` FOREIGN KEY (`id_game_type`) REFERENCES `game_type` (`id_game_type`);

--
-- Contraintes pour la table `game_has_trophy`
--
ALTER TABLE `game_has_trophy`
  ADD CONSTRAINT `FK_game_has_trophy_id_game` FOREIGN KEY (`id_game`) REFERENCES `game` (`id_game`),
  ADD CONSTRAINT `FK_game_has_trophy_id_trophy` FOREIGN KEY (`id_trophy`) REFERENCES `trophy` (`id_trophy`);

--
-- Contraintes pour la table `parent_has_child`
--
ALTER TABLE `parent_has_child`
  ADD CONSTRAINT `FK_parent_has_child_id_account` FOREIGN KEY (`id_account`) REFERENCES `account` (`id_account`),
  ADD CONSTRAINT `FK_parent_has_child_id_child_account` FOREIGN KEY (`id_child_account`) REFERENCES `child_account` (`id_child_account`);

--
-- Contraintes pour la table `played`
--
ALTER TABLE `played`
  ADD CONSTRAINT `FK_played_id_child_account` FOREIGN KEY (`id_child_account`) REFERENCES `child_account` (`id_child_account`),
  ADD CONSTRAINT `FK_played_id_game` FOREIGN KEY (`id_game`) REFERENCES `game` (`id_game`);

--
-- Contraintes pour la table `success`
--
ALTER TABLE `success`
  ADD CONSTRAINT `FK_success_id_child_account` FOREIGN KEY (`id_child_account`) REFERENCES `child_account` (`id_child_account`),
  ADD CONSTRAINT `FK_success_id_trophy` FOREIGN KEY (`id_trophy`) REFERENCES `trophy` (`id_trophy`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
