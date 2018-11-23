-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 26 oct. 2018 à 08:20
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `festilvania`
--

-- --------------------------------------------------------

--
-- Structure de la table `aller`
--

DROP TABLE IF EXISTS `aller`;
CREATE TABLE IF NOT EXISTS `aller` (
  `idMembre` bigint(20) UNSIGNED NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  UNIQUE KEY `idMembre` (`idMembre`,`idEvenement`),
  KEY `idEvenementAller_fk` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `appartenircategorie`
--

DROP TABLE IF EXISTS `appartenircategorie`;
CREATE TABLE IF NOT EXISTS `appartenircategorie` (
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  `idCategorie` bigint(20) UNSIGNED NOT NULL,
  UNIQUE KEY `idEvenement` (`idEvenement`,`idCategorie`),
  KEY `idCategorieAppartenirCat_fk` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `appartenirgroupe`
--

DROP TABLE IF EXISTS `appartenirgroupe`;
CREATE TABLE IF NOT EXISTS `appartenirgroupe` (
  `idMembre` bigint(20) UNSIGNED NOT NULL,
  `idGroupe` bigint(20) UNSIGNED NOT NULL,
  UNIQUE KEY `idMembre` (`idMembre`,`idGroupe`),
  KEY `idGroupeAppartenirGroupe_fk` (`idGroupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `autoriser`
--

DROP TABLE IF EXISTS `autoriser`;
CREATE TABLE IF NOT EXISTS `autoriser` (
  `idGroupe` bigint(20) UNSIGNED NOT NULL,
  `idDroits` bigint(20) UNSIGNED NOT NULL,
  UNIQUE KEY `idGroupe` (`idGroupe`,`idDroits`),
  KEY `idDroitsAutoriser_fk` (`idDroits`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titreCategorie` varchar(64) NOT NULL,
  PRIMARY KEY (`idCategorie`),
  UNIQUE KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `idCommentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `contenu` varchar(1024) NOT NULL,
  `date_creation` datetime NOT NULL,
  `idMembre` bigint(20) UNSIGNED NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idCommentaire`),
  UNIQUE KEY `idCommentaire` (`idCommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

DROP TABLE IF EXISTS `commenter`;
CREATE TABLE IF NOT EXISTS `commenter` (
  `idMembre` bigint(20) UNSIGNED NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  `idCommentaire` bigint(20) UNSIGNED NOT NULL,
  UNIQUE KEY `idMembre` (`idMembre`,`idEvenement`,`idCommentaire`),
  KEY `idEvenementCommeter_fk` (`idEvenement`),
  KEY `idCommentaireCommenter_fk` (`idCommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `decrire`
--

DROP TABLE IF EXISTS `decrire`;
CREATE TABLE IF NOT EXISTS `decrire` (
  `idDetail` bigint(20) UNSIGNED NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  UNIQUE KEY `idDetail` (`idDetail`,`idEvenement`),
  KEY `idEvenementDecrire_fk` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `detail`
--

DROP TABLE IF EXISTS `detail`;
CREATE TABLE IF NOT EXISTS `detail` (
  `idDetail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titreDetail` varchar(32) NOT NULL,
  `contenu` varchar(32) NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idDetail`),
  UNIQUE KEY `idDetail` (`idDetail`),
  KEY `idEvenementDetail_fk` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `idDroits` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `intituleDroits` varchar(128) NOT NULL,
  `droit_visualiser` tinyint(1) NOT NULL,
  `droit_poster` tinyint(1) NOT NULL,
  `droit_voter` tinyint(1) NOT NULL,
  `droit_commenter` tinyint(1) NOT NULL,
  `droit_editer` tinyint(1) NOT NULL,
  `droit_supprimer` tinyint(1) NOT NULL,
  PRIMARY KEY (`idDroits`),
  UNIQUE KEY `idDroits` (`idDroits`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvenement` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titreEvenement` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `idMembre` bigint(20) UNSIGNED NOT NULL,
  `idCategorie` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idEvenement`),
  UNIQUE KEY `idEvenement` (`idEvenement`),
  KEY `idMembreEvenement_fk` (`idMembre`),
  KEY `idCategorieEvenement_fk` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `idGroupe` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomGroupe` varchar(128) NOT NULL,
  `idDroits` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idGroupe`),
  UNIQUE KEY `idGroupe` (`idGroupe`),
  KEY `idDroitsGroupe_fk` (`idDroits`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `illustrer`
--

DROP TABLE IF EXISTS `illustrer`;
CREATE TABLE IF NOT EXISTS `illustrer` (
  `idImage` bigint(20) UNSIGNED NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  UNIQUE KEY `idImage` (`idImage`,`idEvenement`),
  KEY `idEvenementIllustrer_fk` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `idImage` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lienImage` varchar(256) NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idImage`),
  UNIQUE KEY `idImage` (`idImage`),
  KEY `idEvenementImage_fk` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `idMembre` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `idGroupe` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idMembre`),
  UNIQUE KEY `idMembre` (`idMembre`),
  KEY `idGroupeMembre_fk` (`idGroupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `poster`
--

DROP TABLE IF EXISTS `poster`;
CREATE TABLE IF NOT EXISTS `poster` (
  `idMembre` bigint(20) UNSIGNED NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  UNIQUE KEY `idMembre` (`idMembre`,`idEvenement`),
  KEY `idEvenementPoster_fk` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `votecommentaire`
--

DROP TABLE IF EXISTS `votecommentaire`;
CREATE TABLE IF NOT EXISTS `votecommentaire` (
  `idMembre` bigint(20) UNSIGNED NOT NULL,
  `idCommentaire` bigint(20) UNSIGNED NOT NULL,
  `vote` smallint(6) NOT NULL,
  `date_creation` datetime NOT NULL,
  UNIQUE KEY `idMembre` (`idMembre`,`idCommentaire`),
  KEY `idCommentaireVoteComm_fk` (`idCommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `voteevenement`
--

DROP TABLE IF EXISTS `voteevenement`;
CREATE TABLE IF NOT EXISTS `voteevenement` (
  `idMembre` bigint(20) UNSIGNED NOT NULL,
  `idEvenement` bigint(20) UNSIGNED NOT NULL,
  `vote` smallint(6) NOT NULL,
  `date_creation` datetime NOT NULL,
  UNIQUE KEY `idMembre` (`idMembre`,`idEvenement`),
  KEY `idEvenementVoteEven_fk` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aller`
--
ALTER TABLE `aller`
  ADD CONSTRAINT `idEvenementAller_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`),
  ADD CONSTRAINT `idMembreAller_fk` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`);

--
-- Contraintes pour la table `appartenircategorie`
--
ALTER TABLE `appartenircategorie`
  ADD CONSTRAINT `idCategorieAppartenirCat_fk` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`),
  ADD CONSTRAINT `idEvenementAppartenirCat_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`);

--
-- Contraintes pour la table `appartenirgroupe`
--
ALTER TABLE `appartenirgroupe`
  ADD CONSTRAINT `idGroupeAppartenirGroupe_fk` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`),
  ADD CONSTRAINT `idMembreAppartenirGroupe_fk` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`);

--
-- Contraintes pour la table `autoriser`
--
ALTER TABLE `autoriser`
  ADD CONSTRAINT `idDroitsAutoriser_fk` FOREIGN KEY (`idDroits`) REFERENCES `droits` (`idDroits`),
  ADD CONSTRAINT `idGroupeAutoriser_fk` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`);

--
-- Contraintes pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD CONSTRAINT `idCommentaireCommenter_fk` FOREIGN KEY (`idCommentaire`) REFERENCES `commentaire` (`idCommentaire`),
  ADD CONSTRAINT `idEvenementCommeter_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`),
  ADD CONSTRAINT `idMembreCommenter_fk` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`);

--
-- Contraintes pour la table `decrire`
--
ALTER TABLE `decrire`
  ADD CONSTRAINT `idDetailDecrire_fk` FOREIGN KEY (`idDetail`) REFERENCES `detail` (`idDetail`),
  ADD CONSTRAINT `idEvenementDecrire_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`);

--
-- Contraintes pour la table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `idEvenementDetail_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `idCategorieEvenement_fk` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`),
  ADD CONSTRAINT `idMembreEvenement_fk` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `idDroitsGroupe_fk` FOREIGN KEY (`idDroits`) REFERENCES `droits` (`idDroits`);

--
-- Contraintes pour la table `illustrer`
--
ALTER TABLE `illustrer`
  ADD CONSTRAINT `idEvenementIllustrer_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`),
  ADD CONSTRAINT `idImageIllustrer_fk` FOREIGN KEY (`idImage`) REFERENCES `image` (`idImage`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `idEvenementImage_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `idGroupeMembre_fk` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`);

--
-- Contraintes pour la table `poster`
--
ALTER TABLE `poster`
  ADD CONSTRAINT `idEvenementPoster_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`),
  ADD CONSTRAINT `idMembrePoster_fk` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`);

--
-- Contraintes pour la table `votecommentaire`
--
ALTER TABLE `votecommentaire`
  ADD CONSTRAINT `idCommentaireVoteComm_fk` FOREIGN KEY (`idCommentaire`) REFERENCES `commentaire` (`idCommentaire`),
  ADD CONSTRAINT `idMembreVoteComm_fk` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`);

--
-- Contraintes pour la table `voteevenement`
--
ALTER TABLE `voteevenement`
  ADD CONSTRAINT `idEvenementVoteEven_fk` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`),
  ADD CONSTRAINT `idMembreVoteEven_fk` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
