-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 26 oct. 2018 à 07:28
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
  `idMembre` int(11) NOT NULL,
  `idEvenement` int(11) NOT NULL,
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
  `idEvenement` int(11) NOT NULL,
  PRIMARY KEY (`idDetail`),
  UNIQUE KEY `idDetail` (`idDetail`)
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
  `idMembre` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  PRIMARY KEY (`idEvenement`),
  UNIQUE KEY `idEvenement` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `idGroupe` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomGroupe` varchar(128) NOT NULL,
  `idDroits` int(11) NOT NULL,
  PRIMARY KEY (`idGroupe`),
  UNIQUE KEY `idGroupe` (`idGroupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `idImage` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lienImage` varchar(256) NOT NULL,
  `idEvenement` int(11) NOT NULL,
  PRIMARY KEY (`idImage`),
  UNIQUE KEY `idImage` (`idImage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`id_membre`),
  UNIQUE KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
