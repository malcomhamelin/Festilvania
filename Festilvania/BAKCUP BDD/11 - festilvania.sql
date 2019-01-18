-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 18 jan. 2019 à 17:56
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.16

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
(1, 1),
(1, 9),
(1, 12);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `titreCategorie`) VALUES
(2, 'Concert'),
(3, 'Festival'),
(4, 'Spectacle'),
(5, 'Autres'),
(10, 'Essai'),
(18, 'Test');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idCommentaire`, `contenu`, `date_creation`, `idMembre`, `idEvenement`) VALUES
(1, 'Test', '2019-01-11 13:47:21', 1, 8),
(2, 'Le Lorem Ipsum est simplement du faux texte employÃ© dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les annÃ©es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour rÃ©aliser un livre spÃ©cimen de polices de texte. Il n\'a pas fait que survivre cinq siÃ¨cles, mais s\'est aussi adaptÃ© Ã  la bureautique informatique, sans que son contenu n\'en soit modifiÃ©. Il a Ã©tÃ© popularisÃ© dans les annÃ©es 1960 grÃ¢ce Ã  la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus rÃ©cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker', '2019-01-11 13:50:07', 1, 8),
(3, 'Super, j\'y serais', '2019-01-14 11:18:39', 1, 12);

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
(1, 'membre', 1, 1, 1, 1, 0, 0, 0),
(2, 'root', 1, 1, 1, 1, 1, 1, 1),
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `titreEvenement`, `description`, `date_creation`, `date_debut`, `date_fin`, `idMembre`, `idCategorie`, `lieu`, `estPublie`) VALUES
(9, 'Lollapalooz', 'Lollapalooza Paris sâ€™approprie la capitale pour une troisiÃ¨me Ã©dition.\r\n\r\nLe festival lÃ©gendaire recevra une vague de superstars en tous genres. Restez attentifs, la programmation 2019 sera annoncÃ©e prochainement.\r\n\r\nDepeche Mode, Gorillaz, The Killers and Travis Scott faisaient partie des tÃªtes dâ€™affiche lâ€™an dernier et cette Ã©dition promet dâ€™Ãªtre tout aussi incroyable.', '2019-01-14 12:00:50', '2019-06-14', '2019-06-16', 1, 2, 'Paris', 1),
(10, 'Main Square', 'Et c\'est reparti pour un tour ! L\'an passÃ©, des pointures tels que Liam Gallagher, Depeche Mode ou encore OrelSan se sont succÃ©dÃ©es sur les diffÃ©rentes scÃ¨ne du Main Square Festival, Ã  Arras. AprÃ¨s quelques mois de rÃ©pit, le festival reprend du service avec, en cadeau, les premiers noms de son affiche. Sachez donc que pour marquer sa quinziÃ¨me Ã©dition, le festival Ã  frappÃ© fort : les 5, 6 et juillet, Macklemore, Chistine &amp; The Queens ou encore Cypress Hill mettront le feu Ã  la Citadelle d\'Arras ! On attend aussi : DJ Snake, Damso et AngÃ¨le (le 5 juillet), Martin Garrix, Lomepal et Skip The Use (6 juillet) mais aussi Ben Harper &amp; The Innocent Criminals,  Bigflo &amp; Oli, Jain, Editos et Bring Me The Horizon (le 7 juillet). ', '2019-01-14 12:02:48', '2019-07-05', '2019-07-07', 1, 2, 'Arras', 1),
(12, 'Vieilles Charrues', 'Les Vie\'illes C&quot;harrues est le plus grand festiv&quot;al de France ! Avec son programme aux allures de kalÃ©idoscope musical, chacun trouvera de quoi s\'enthousiasmer dans le festival breton, qui accueille chaque annÃ©e des centaines de milliers de fans Ã  Carhaix.\r\n\r\nLes quatre jours du festival seront illuminÃ©s des sons de lÃ©gendes du rock, de gÃ©ants de la dance et de stars montantes. Un Ã©vÃ©nement enivrant pour tous les musicophiles !', '2019-01-14 12:06:59', '2019-06-21', '2019-06-23', 1, 2, 'Carhaix', 0);

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
(1, 'membre', 1),
(2, 'admin', 2),
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`idImage`, `lienImage`, `idEvenement`) VALUES
(15, 'img/eventPictures/12.jpg', 12),
(16, 'img/eventPictures/10.jpg', 10),
(20, 'img/eventPictures/9.jpg', 9);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`idMembre`, `pseudo`, `password`, `mail`, `date_inscription`, `avatar`, `idGroupe`, `sexe`, `date_anniv`) VALUES
(1, 'admin', '$2y$10$HzN/zlyPhJ8u4IWqNZTJPesbiJamiWAsiF2Ll0QILJoX24srZEkw.', 'admin@admin.com', '2018-10-26 00:00:00', 'img/avatars/admin.gif', 2, 'homme', '1995-07-07'),
(2, 'SGBD', 'root', 'sgbd@sgbd.root.fr', '2018-12-18 13:41:41', 'unknown.png', 3, 'autre', '1995-01-14'),
(3, 'dorian', '123', 'caca.pipi@gmail.fr', '2019-01-16 11:21:45', 'img/avatars/dorian.png', 1, 'autre', '1998-12-25'),
(4, 'Malcom', '$2y$10$mCMBGGsUAiS2fX34OF8fDeXDzztvN5vnsRAxOmH4GE.M9rM4jTNnC', 'malcom@malcom.fr', '2019-01-18 14:27:42', 'img/avatars/user.png', 1, 'autre', '2006-11-05');

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
-- Déchargement des données de la table `voteevenement`
--

INSERT INTO `voteevenement` (`idMembre`, `idEvenement`, `vote`, `date_creation`) VALUES
(1, 9, 1, '2019-01-16 11:20:39'),
(1, 10, -1, '2019-01-14 12:17:55'),
(1, 12, 1, '2019-01-16 10:36:26');

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
