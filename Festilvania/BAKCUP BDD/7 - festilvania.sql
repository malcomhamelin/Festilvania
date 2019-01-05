-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 05 jan. 2019 à 19:55
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

--
-- Déchargement des données de la table `aller`
--

INSERT INTO `aller` (`idMembre`, `idEvenement`) VALUES
(1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `titreCategorie`) VALUES
(2, 'Concert'),
(3, 'Festival'),
(4, 'Spectacle'),
(5, 'Autres'),
(10, 'Essai'),
(12, 'Test');

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
  `droit_visualiser` tinyint(1) NOT NULL DEFAULT '0',
  `droit_poster` tinyint(1) NOT NULL DEFAULT '0',
  `droit_voter` tinyint(1) NOT NULL DEFAULT '0',
  `droit_commenter` tinyint(1) NOT NULL DEFAULT '0',
  `droit_editer` tinyint(1) NOT NULL DEFAULT '0',
  `droit_supprimer` tinyint(1) NOT NULL DEFAULT '0',
  `droit_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idDroits`),
  UNIQUE KEY `idDroits` (`idDroits`),
  UNIQUE KEY `UQ_intituleDroits` (`intituleDroits`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`idDroits`, `intituleDroits`, `droit_visualiser`, `droit_poster`, `droit_voter`, `droit_commenter`, `droit_editer`, `droit_supprimer`, `droit_admin`) VALUES
(1, 'root', 1, 1, 1, 1, 1, 1, 1),
(4, 'Essai', 1, 1, 1, 1, 1, 1, 0);

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
  `lieu` varchar(128) NOT NULL,
  `estPublie` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEvenement`),
  UNIQUE KEY `idEvenement` (`idEvenement`),
  KEY `idMembreEvenement_fk` (`idMembre`),
  KEY `idCategorieEvenement_fk` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `titreEvenement`, `description`, `date_creation`, `date_debut`, `date_fin`, `idMembre`, `idCategorie`, `lieu`, `estPublie`) VALUES
(7, 'test', 'gregre', '2019-01-05 20:26:03', '2019-01-01', '2019-01-04', 1, 3, 'MONTREUIL', 0),
(8, 'test', 'eazez', '2019-01-05 20:49:13', '2019-01-05', '2019-01-13', 1, 3, 'MONTREUIL', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`idGroupe`, `nomGroupe`, `idDroits`) VALUES
(1, 'admin', 1),
(3, 'Essai', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`idImage`, `lienImage`, `idEvenement`) VALUES
(2, 'img/eventPictures/test.jpg', 7),
(3, 'img/eventPictures/test.png', 8);

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
  `avatar` varchar(256) NOT NULL DEFAULT 'img/avatars/user.png',
  `idGroupe` bigint(20) UNSIGNED NOT NULL,
  `sexe` varchar(16) NOT NULL,
  `date_anniv` date NOT NULL,
  PRIMARY KEY (`idMembre`),
  UNIQUE KEY `idMembre` (`idMembre`),
  KEY `idGroupeMembre_fk` (`idGroupe`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`idMembre`, `pseudo`, `password`, `mail`, `date_inscription`, `avatar`, `idGroupe`, `sexe`, `date_anniv`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '2018-10-26 00:00:00', 'img/avatars/user.png', 1, '', '0000-00-00'),
(2, 'SGBD', 'root', 'sgbd@sgbd.root.fr', '2018-12-18 13:41:41', 'unknown.png', 3, 'autre', '1995-01-14');

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
