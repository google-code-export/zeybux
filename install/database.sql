-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 01 Mars 2011 à 21:10
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.2-1ubuntu4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `zeybu`
--

-- --------------------------------------------------------

--
-- Structure de la table `adh_adherent`
--

CREATE TABLE IF NOT EXISTS `adh_adherent` (
  `adh_id` int(11) NOT NULL AUTO_INCREMENT,
  `adh_mot_passe` varchar(100) NOT NULL,
  `adh_numero` varchar(20) NOT NULL,
  `adh_id_compte` int(11) NOT NULL,
  `adh_nom` varchar(50) NOT NULL,
  `adh_prenom` varchar(50) NOT NULL,
  `adh_courriel_principal` varchar(100) NOT NULL,
  `adh_courriel_secondaire` varchar(100) NOT NULL,
  `adh_telephone_principal` varchar(20) NOT NULL,
  `adh_telephone_secondaire` varchar(20) NOT NULL,
  `adh_adresse` varchar(300) NOT NULL,
  `adh_code_postal` varchar(10) NOT NULL,
  `adh_ville` varchar(100) NOT NULL,
  `adh_date_naissance` date NOT NULL,
  `adh_date_adhesion` date NOT NULL,
  `adh_date_maj` datetime NOT NULL,
  `adh_commentaire` text NOT NULL,
  `adh_etat` tinyint(1) NOT NULL,
  `adh_super_zeybu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adh_id`),
  KEY `fk_adh_adherent_aut_autorisation1` (`adh_id`),
  KEY `fk_adh_adherent_ope_operation1` (`adh_id`),
  KEY `fk_adh_adherent_cpt_compte1` (`adh_id_compte`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `adh_adherent`
--

INSERT INTO `adh_adherent` (`adh_id`, `adh_mot_passe`, `adh_numero`, `adh_id_compte`, `adh_nom`, `adh_prenom`, `adh_courriel_principal`, `adh_courriel_secondaire`, `adh_telephone_principal`, `adh_telephone_secondaire`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_date_naissance`, `adh_date_adhesion`, `adh_date_maj`, `adh_commentaire`, `adh_etat`, `adh_super_zeybu`) VALUES
(0, '01f01083386dc09d99826461b2b6c6f1', 'julien', 0, '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', 1, 1),
(1, '01f01083386dc09d99826461b2b6c6f1', 'Z1', 31, 'JALABERT', 'Bernard', 'bernard.jalabert@free.fr', '', '04.76.24.10.36', '', '8 rue de Belledonne', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 23:12:26', '', 1, 0),
(2, '01f01083386dc09d99826461b2b6c6f1', 'Z2', 2, 'ARDITO', 'Denise', 'pascal.ardito@free.fr', '', '09.53.86.42.51', '', '22 rue du Vercors', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2011-01-03 00:04:06', '', 1, 0),
(3, '01f01083386dc09d99826461b2b6c6f1', 'Z3', 3, 'BAR', 'Georges', 'georges.bar@laposte.net', '', '04.76.25.18.46', '', '4 place des Coulmes', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(4, '01f01083386dc09d99826461b2b6c6f1', 'Z4', 4, 'BENHAMOU', 'Robert', 'robert.benhamou@laposte.net', '', '04.76.24.66.50', '', '13 rue Louis Farçat', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(5, '01f01083386dc09d99826461b2b6c6f1', 'Z5', 5, 'BERENGER', 'Gérard', 'ge.berenger@laposte.net', '', '04.76.25.51.09', '', '7 allée du Rachais', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(6, '01f01083386dc09d99826461b2b6c6f1', 'Z6', 6, 'BERENGER', 'Jocelyne', 'jocelyne.berenger@laposte.net', '', '04.76.25.51.09', '', '7 allée du Rachais', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(7, '01f01083386dc09d99826461b2b6c6f1', 'Z7', 7, 'BUISSON', 'Marie-hélène', 'marie-helene38@hotmail.fr', '', '04.76.25.47.23', '', '15 allée du Gerbier', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(8, '01f01083386dc09d99826461b2b6c6f1', 'Z8', 8, 'COQUET', 'Jean-paul', '', 'jp_coquet@yahoo.fr', '04.76.25.31.65', '', '55  rue des Javaux', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-12-27 18:03:19', '', 1, 0),
(9, '01f01083386dc09d99826461b2b6c6f1', 'Z9', 9, 'COQUET', 'Michelle', 'jp_coquet@yahoo.fr', '', '04.76.25.31.65', '', '55  rue des Javaux', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(10, '01f01083386dc09d99826461b2b6c6f1', 'Z10', 10, 'CROZET', 'Béatrice', 'bc.crozet@orange.fr', '', '', '', '58 avenue Jean Jaurès', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-12-22 15:09:12', '', 1, 0),
(11, '01f01083386dc09d99826461b2b6c6f1', 'Z11', 11, 'DATHE', 'Suzanne', 'suzannedathe@hotmail.com', '', '04.76.14.07.42', '', '8 allée du Rachais', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(12, '01f01083386dc09d99826461b2b6c6f1', 'Z12', 12, 'DERRAS', 'Danièle', 'zeybulonsanszemail@gmail.com', '', '04.76.25.48.58', '', '12 rue Denis Diderot', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', 'Pas d&#039;Email', 1, 0),
(13, '01f01083386dc09d99826461b2b6c6f1', 'Z13', 13, 'DERRAS', 'Maurice', 'zeybulonsanszemail@gmail.com', '', '04.76.25.48.58', '', '12 rue Denis Diderot', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', 'Pas d&#039;Email', 1, 0),
(14, '01f01083386dc09d99826461b2b6c6f1', 'Z14', 14, 'DESFORGES', 'Alain', 'desforges11@laposte.net', '', '04.76.18.28.41', '06.87.72.62.18', '10 allée du Gerbier', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(15, '01f01083386dc09d99826461b2b6c6f1', 'Z15', 15, 'DESFORGES', 'Cécile', 'cec.desforges@free.fr', '', '04.76.18.28.41', '', '10 allée du Gerbier', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(16, '01f01083386dc09d99826461b2b6c6f1', 'Z16', 16, 'DI NATALE', 'Emmanuelle', '', 'emmanuelle3438@gmail.com', '06.58.07.62.27', '', '2 place des Coulmes', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', 'N&#039;habite plus le quartier', 1, 0),
(17, '01f01083386dc09d99826461b2b6c6f1', 'Z17', 17, 'ESSOU', 'Yvonne', 'zeybulonsanszemail@gmail.com', '', '04.76.14.06.56', '', '', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', 'Pas d&#039;Email', 1, 0),
(18, '01f01083386dc09d99826461b2b6c6f1', 'Z18', 18, 'FLORES', 'Madeleine', '', 'zeybulonsanszemail@gmail.com', '04.76.24.21.25', '', '58 avenue Jean Jaurès', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', 'Ne souhaite pas réadhérer', 1, 0),
(19, '01f01083386dc09d99826461b2b6c6f1', 'Z19', 19, 'FONTE', 'Catherine', 'cat.fonte@orange.fr', '', '04.76.14.04.62', '', '7 rue Edmond Rostand', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(20, '01f01083386dc09d99826461b2b6c6f1', 'Z20', 20, 'GARNIER', 'Béatrice', 'bagarnier@free.fr', '', '04.76.25.38.58', '', '20 rue Jean-Paul Sartre', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(21, '01f01083386dc09d99826461b2b6c6f1', 'Z21', 21, 'GERVAIS', 'Guy', 'guymogerv@orange.fr', '', '04.76.25.77.88', '', '1 place des Tilleuls', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(22, '01f01083386dc09d99826461b2b6c6f1', 'Z22', 22, 'GERVAIS', 'Monique', '', 'guymogerv@orange.fr', '', '', '1 place des Tilleuls', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(23, '01f01083386dc09d99826461b2b6c6f1', 'Z23', 23, 'GUIGNIER', 'Anne', '', 'brunogaudin@wanadoo.fr', '04.76.01.86.30', '', '10 allée du Gerbier', '38320', 'EYBENS', '0000-00-00', '2009-10-16', '2010-11-28 20:23:47', '', 1, 0),
(24, '01f01083386dc09d99826461b2b6c6f1', 'Z24', 24, 'HOLLANDE', 'Christiane', 'chollande@yahoo.fr', '', '04.76.25.29.40', '', '7 allée du Rachais', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(25, '01f01083386dc09d99826461b2b6c6f1', 'Z25', 25, 'LOPPINET', 'Gisèle', 'gisou3834@yahoo.fr', '', '04.76.24.35.76', '06.71.31.84.23', '24 rue du Vercors', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(26, '01f01083386dc09d99826461b2b6c6f1', 'Z26', 26, 'MARCEL', 'Idalète', 'idaletem@hotmail.com', '', '04.76.62.34.99', '', '12 rue Anselme Bonneton', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(27, '01f01083386dc09d99826461b2b6c6f1', 'Z27', 27, 'MARIOTTINI', 'Laetitia', 'sachalaetitia@neuf.fr', '', '04.76.54.34.08', '06.16.93.26.74', '10 rue de Belledonne', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(28, '01f01083386dc09d99826461b2b6c6f1', 'Z28', 28, 'MARIOTTINI', 'Sacha', '', 'sachalaetitia@neuf.fr', '04.76.54.34.08', '06.16.93.26.74', '10 rue de Belledonne', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', '', 1, 0),
(29, '01f01083386dc09d99826461b2b6c6f1', 'Z29', 29, 'MASSON-DELAITRE', 'Georgette', 'zeybulonsanszemail@gmail.com', '', '04.56.45.66.29', '06.13.74.39.75', '8 place des Coulmes', '38320', 'EYBENS', '0000-00-00', '2009-07-02', '2010-11-28 20:23:47', 'Pas d&#039;Email', 1, 0),
(30, '01f01083386dc09d99826461b2b6c6f1', 'Z30', 30, 'MERLE', 'Agnès', '', '', '04.76.22.48.89', '', '27 rue Anatole France', '38100', 'GRENOBLE', '0000-00-00', '2009-07-02', '2010-11-28 20:23:48', '', 1, 0),
(31, '01f01083386dc09d99826461b2b6c6f1', 'Z31', 32, 'PIERRE', 'Jean-victor', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-12-22 20:38:56', '', 1, 0),
(32, '01f01083386dc09d99826461b2b6c6f1', 'Z32', 32, 'PIERRE', 'Marie-charlotte', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-12-22 20:39:26', '', 1, 0),
(33, '01f01083386dc09d99826461b2b6c6f1', 'Z33', 33, 'DESFORGES', 'Cécile', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-11-29 17:50:57', '', 1, 0),
(34, '01f01083386dc09d99826461b2b6c6f1', 'Z34', 33, 'DESFORGES', 'Alain', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-11-29 17:51:55', '', 1, 0),
(35, '01f01083386dc09d99826461b2b6c6f1', 'Z35', 34, 'DESFORGES', 'Ambre', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-11-29 17:52:48', '', 1, 0),
(36, '01f01083386dc09d99826461b2b6c6f1', 'Z36', 34, 'DESFORGES', 'Clovis', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-11-29 17:53:31', '', 1, 0),
(37, '01f01083386dc09d99826461b2b6c6f1', 'Z37', 35, 'GRANJON', 'Nicolas', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-11-29 17:54:36', '', 1, 0),
(38, '01f01083386dc09d99826461b2b6c6f1', 'Z38', 35, 'PETIT', 'Fabrice', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-11-29 17:55:10', '', 1, 0),
(39, '01f01083386dc09d99826461b2b6c6f1', 'Z39', 36, 'LINOSSIER', 'Jean-benoit', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-11-29 17:56:13', '', 1, 0),
(40, '01f01083386dc09d99826461b2b6c6f1', 'Z40', 36, 'LINOSSIER', 'Jocelyne', '', '', '', '', '', '', '', '0000-00-00', '2010-11-29', '2010-11-29 17:56:47', '', 1, 0),
(41, '01f01083386dc09d99826461b2b6c6f1', 'Z41', 45, 'PIERRE', 'Julien', '', '', '', '', '', '', '', '1986-01-31', '2010-12-25', '2010-12-25 17:09:37', '', 1, 0),
(42, '01f01083386dc09d99826461b2b6c6f1', 'Z42', 46, 'TOTO', 'Suppression', '', '', '', '', '', '', '', '0000-00-00', '2011-02-06', '2011-02-06 17:27:53', '', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `aut_autorisation`
--

CREATE TABLE IF NOT EXISTS `aut_autorisation` (
  `aut_id` int(11) NOT NULL AUTO_INCREMENT,
  `aut_id_adherent` int(11) NOT NULL,
  `aut_id_module` int(11) NOT NULL,
  PRIMARY KEY (`aut_id`),
  KEY `fk_aut_autorisation_mod_module` (`aut_id_module`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Contenu de la table `aut_autorisation`
--

INSERT INTO `aut_autorisation` (`aut_id`, `aut_id_adherent`, `aut_id_module`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 2, 3),
(5, 3, 1),
(6, 3, 3),
(7, 4, 1),
(8, 4, 3),
(9, 5, 1),
(10, 5, 3),
(11, 6, 1),
(12, 6, 3),
(13, 7, 1),
(14, 7, 3),
(15, 8, 1),
(16, 8, 3),
(17, 9, 1),
(18, 9, 3),
(19, 10, 1),
(20, 10, 3),
(21, 11, 1),
(22, 11, 3),
(23, 12, 1),
(24, 12, 3),
(25, 13, 1),
(26, 13, 3),
(27, 14, 1),
(28, 14, 3),
(29, 15, 1),
(30, 15, 3),
(31, 16, 1),
(32, 16, 3),
(33, 17, 1),
(34, 17, 3),
(35, 18, 1),
(36, 18, 3),
(37, 19, 1),
(38, 19, 3),
(39, 20, 1),
(40, 20, 3),
(41, 21, 1),
(42, 21, 3),
(43, 22, 1),
(44, 22, 3),
(45, 23, 1),
(46, 23, 3),
(47, 24, 1),
(48, 24, 3),
(49, 25, 1),
(50, 25, 3),
(51, 26, 1),
(52, 26, 3),
(53, 27, 1),
(54, 27, 3),
(55, 28, 1),
(56, 28, 3),
(57, 29, 1),
(58, 29, 3),
(59, 30, 1),
(60, 30, 3),
(61, 31, 1),
(62, 31, 3),
(63, 32, 1),
(64, 32, 3),
(65, 33, 1),
(66, 33, 3),
(67, 34, 1),
(68, 34, 3),
(69, 35, 1),
(70, 35, 3),
(71, 36, 1),
(72, 36, 3),
(73, 37, 1),
(74, 37, 3),
(75, 38, 1),
(76, 38, 3),
(77, 39, 1),
(78, 39, 3),
(79, 40, 1),
(80, 40, 3),
(81, 31, 4),
(82, 32, 5),
(83, 41, 1),
(84, 41, 3),
(85, 41, 4),
(86, 41, 2),
(87, 41, 5),
(88, 41, 6),
(89, 42, 1),
(90, 42, 3);

-- --------------------------------------------------------

--
-- Structure de la table `com_commande`
--

CREATE TABLE IF NOT EXISTS `com_commande` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_numero` int(11) NOT NULL,
  `com_nom` varchar(100) NOT NULL,
  `com_description` text NOT NULL,
  `com_date_marche_debut` datetime NOT NULL,
  `com_date_marche_fin` datetime NOT NULL,
  `com_date_fin_reservation` datetime NOT NULL,
  `com_archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `com_commande`
--

INSERT INTO `com_commande` (`com_id`, `com_numero`, `com_nom`, `com_description`, `com_date_marche_debut`, `com_date_marche_fin`, `com_date_fin_reservation`, `com_archive`) VALUES
(1, 1, '', '', '2011-12-07 18:30:00', '2011-12-07 19:45:00', '2012-02-06 17:17:00', 0),
(2, 2, '', '', '2010-12-14 16:30:00', '2010-12-14 23:20:00', '2010-12-10 01:00:00', 0),
(3, 3, '', '', '2010-11-30 01:00:00', '2010-11-30 01:45:00', '2010-11-29 01:00:00', 0),
(4, 4, '', '', '2010-11-30 01:00:00', '2010-11-30 03:00:00', '2010-11-29 23:00:00', 1),
(5, 5, '', '', '2010-12-28 00:00:00', '2010-12-28 02:00:00', '2010-12-27 00:00:00', 1),
(6, 6, '', '', '2011-12-31 00:00:00', '2011-12-31 06:00:00', '2011-12-30 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cpro_categorie_produit`
--

CREATE TABLE IF NOT EXISTS `cpro_categorie_produit` (
  `cpro_id` int(11) NOT NULL AUTO_INCREMENT,
  `cpro_nom` varchar(50) NOT NULL,
  `cpro_description` text NOT NULL,
  PRIMARY KEY (`cpro_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `cpro_categorie_produit`
--

INSERT INTO `cpro_categorie_produit` (`cpro_id`, `cpro_nom`, `cpro_description`) VALUES
(1, 'Produit', '');

-- --------------------------------------------------------

--
-- Structure de la table `cpt_compte`
--

CREATE TABLE IF NOT EXISTS `cpt_compte` (
  `cpt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cpt_label` varchar(30) NOT NULL,
  PRIMARY KEY (`cpt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Contenu de la table `cpt_compte`
--

INSERT INTO `cpt_compte` (`cpt_id`, `cpt_label`) VALUES
(1, 'C1'),
(2, 'C2'),
(3, 'C3'),
(4, 'C4'),
(5, 'C5'),
(6, 'C6'),
(7, 'C7'),
(8, 'C8'),
(9, 'C9'),
(10, 'C10'),
(11, 'C11'),
(12, 'C12'),
(13, 'C13'),
(14, 'C14'),
(15, 'C15'),
(16, 'C16'),
(17, 'C17'),
(18, 'C18'),
(19, 'C19'),
(20, 'C20'),
(21, 'C21'),
(22, 'C22'),
(23, 'C23'),
(24, 'C24'),
(25, 'C25'),
(26, 'C26'),
(27, 'C27'),
(28, 'C28'),
(29, 'C29'),
(30, 'C30'),
(31, 'C31'),
(32, 'C32'),
(33, 'C33'),
(34, 'C34'),
(35, 'C35'),
(36, 'C36'),
(37, 'C37'),
(38, 'C38'),
(39, 'C39'),
(40, 'C40'),
(41, 'C41'),
(42, 'C42'),
(43, 'C43'),
(44, 'C44'),
(45, 'C45'),
(46, 'C46'),
(47, 'C47');

-- --------------------------------------------------------

--
-- Structure de la table `dcom_detail_commande`
--

CREATE TABLE IF NOT EXISTS `dcom_detail_commande` (
  `dcom_id` int(11) NOT NULL AUTO_INCREMENT,
  `dcom_id_produit` int(11) NOT NULL,
  `dcom_taille` decimal(10,2) NOT NULL,
  `dcom_prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`dcom_id`),
  KEY `fk_lot_lot_produit_pro_produit1` (`dcom_id_produit`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `dcom_detail_commande`
--

INSERT INTO `dcom_detail_commande` (`dcom_id`, `dcom_id_produit`, `dcom_taille`, `dcom_prix`) VALUES
(1, 1, '1.00', '6.45'),
(2, 2, '1.00', '1.23'),
(3, 2, '2.00', '1.85'),
(4, 3, '101.00', '2.25'),
(5, 4, '10.00', '3.46'),
(6, 4, '15.00', '33.00'),
(7, 5, '12.00', '32.00'),
(8, 3, '50.00', '1.12'),
(9, 6, '10.00', '3.26'),
(10, 7, '45.00', '12.00'),
(11, 8, '45.00', '12.00'),
(12, 9, '12.00', '45.32'),
(13, 9, '10.00', '55.00'),
(14, 10, '45.00', '12.00'),
(15, 10, '33.00', '55.00'),
(16, 11, '33.00', '2.23'),
(17, 11, '20.00', '3.26');

-- --------------------------------------------------------

--
-- Structure de la table `gpc_groupe_commande`
--

CREATE TABLE IF NOT EXISTS `gpc_groupe_commande` (
  `gpc_id` int(11) NOT NULL AUTO_INCREMENT,
  `gpc_id_compte` int(11) NOT NULL,
  `gpc_id_commande` int(11) NOT NULL,
  `gpc_etat` tinyint(4) NOT NULL,
  PRIMARY KEY (`gpc_id`),
  KEY `fk_gpc_groupe_commande_adh_adherent1` (`gpc_id_compte`),
  KEY `fk_gpc_groupe_commande_com_commande1` (`gpc_id_commande`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `gpc_groupe_commande`
--

INSERT INTO `gpc_groupe_commande` (`gpc_id`, `gpc_id_compte`, `gpc_id_commande`, `gpc_etat`) VALUES
(1, 32, 1, 0),
(2, 33, 1, 0),
(3, 33, 2, 0),
(4, 34, 1, 0),
(5, 35, 1, 0),
(6, 31, 1, 1),
(7, 2, 1, 1),
(8, 3, 1, 1),
(21, 4, 1, 0),
(10, 5, 1, 0),
(11, 6, 1, 0),
(12, 32, 4, 1),
(13, 34, 4, 2),
(14, 12, 1, 0),
(15, 45, 5, 2),
(16, 45, 6, 0),
(18, 31, 6, 0),
(22, 12, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mod_module`
--

CREATE TABLE IF NOT EXISTS `mod_module` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nom` varchar(50) NOT NULL,
  `mod_label` varchar(80) NOT NULL,
  `mod_defaut` tinyint(1) NOT NULL,
  `mod_ordre` int(11) NOT NULL,
  `mod_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`mod_id`),
  KEY `fk_mod_module_vue_vues1` (`mod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `mod_module`
--

INSERT INTO `mod_module` (`mod_id`, `mod_nom`, `mod_label`, `mod_defaut`, `mod_ordre`, `mod_admin`) VALUES
(1, 'MonCompte', 'Compte', 1, 1, 0),
(2, 'GestionAdherents', 'Gestion des Adherents', 0, 4, 1),
(3, 'Commande', 'Marché', 1, 2, 0),
(4, 'GestionCommande', 'Gestion des Marchés', 0, 3, 1),
(5, 'GestionProducteur', 'Gestion des Producteurs', 0, 5, 1),
(6, 'CompteZeybu', 'Le Compte du Zeybu', 0, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `npro_nom_produit`
--

CREATE TABLE IF NOT EXISTS `npro_nom_produit` (
  `npro_id` int(11) NOT NULL AUTO_INCREMENT,
  `npro_nom` varchar(50) NOT NULL,
  `npro_description` text NOT NULL,
  `npro_id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`npro_id`),
  KEY `fk_npro_nom_produit_cpro_categorie_produit1` (`npro_id_categorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `npro_nom_produit`
--

INSERT INTO `npro_nom_produit` (`npro_id`, `npro_nom`, `npro_description`, `npro_id_categorie`) VALUES
(4, 'Pomme de Terre', '', 1),
(3, 'Jambon', '', 1),
(2, 'Salade', '', 1),
(1, 'Oeuf', '', 1),
(23, 'Viande', 'De Porc', 1),
(22, 'Cerise', 'De Groupama', 1),
(21, 'Tomate', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ope_operation`
--

CREATE TABLE IF NOT EXISTS `ope_operation` (
  `ope_id` int(11) NOT NULL AUTO_INCREMENT,
  `ope_id_compte` int(11) NOT NULL,
  `ope_montant` decimal(10,2) NOT NULL,
  `ope_libelle` varchar(100) NOT NULL,
  `ope_date` datetime NOT NULL,
  `ope_type_paiement` int(11) NOT NULL,
  `ope_type_paiement_champ_complementaire` varchar(50) NOT NULL,
  `ope_type` int(11) NOT NULL,
  `ope_id_commande` int(11) NOT NULL,
  PRIMARY KEY (`ope_id`),
  KEY `fk_ope_operation_tpp_typepaiement1` (`ope_type_paiement`),
  KEY `fk_ope_operation_com_commande1` (`ope_id_commande`),
  KEY `fk_ope_operation_cpt_compte1` (`ope_id_compte`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Contenu de la table `ope_operation`
--

INSERT INTO `ope_operation` (`ope_id`, `ope_id_compte`, `ope_montant`, `ope_libelle`, `ope_date`, `ope_type_paiement`, `ope_type_paiement_champ_complementaire`, `ope_type`, `ope_id_commande`) VALUES
(1, 1, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(2, 2, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(3, 3, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(4, 4, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(5, 5, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(6, 6, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(7, 7, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(8, 8, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(9, 9, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(10, 10, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(11, 11, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(12, 12, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(13, 13, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(14, 14, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(15, 15, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(16, 16, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(17, 17, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(18, 18, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(19, 19, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(20, 20, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(21, 21, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(22, 22, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(23, 23, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(24, 24, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(25, 25, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(26, 26, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(27, 27, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(28, 28, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(29, 29, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(30, 30, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(31, 31, '0.00', 'Création du compte', '2010-11-28 00:00:00', -1, '', 1, 0),
(32, 32, '0.00', 'Création du compte', '2010-11-29 00:00:00', -1, '', 1, 0),
(33, 33, '0.00', 'Création du compte', '2010-11-29 00:00:00', -1, '', 1, 0),
(34, 34, '0.00', 'Création du compte', '2010-11-29 00:00:00', -1, '', 1, 0),
(35, 35, '0.00', 'Création du compte', '2010-11-29 00:00:00', -1, '', 1, 0),
(36, 36, '0.00', 'Création du compte', '2010-11-29 00:00:00', -1, '', 1, 0),
(37, 32, '-16.60', 'Commande N°1', '2010-11-29 19:10:38', 0, '', 0, 1),
(38, 33, '-16.60', 'Commande N°1', '2010-11-29 18:54:01', 0, '', 0, 1),
(39, 33, '-4.46', 'Commande N°2', '2010-12-22 15:03:39', 0, '', 0, 2),
(40, 34, '-8.30', 'Marché N°1', '2010-11-29 19:15:33', 0, '', 0, 1),
(41, 35, '-17.82', 'Marché N°1', '2010-11-29 19:03:57', 0, '', 0, 1),
(42, 32, '25.00', 'Rechargement', '2010-11-29 19:10:38', 1, '', 1, 0),
(52, 32, '200.00', 'Rechargement', '2010-11-29 19:48:33', 1, '', 1, 0),
(43, 34, '50.00', 'Rechargement', '2010-11-29 19:15:33', 2, 'AZA15641', 1, 0),
(44, 31, '-16.60', 'Marché N°1', '2010-11-29 19:41:09', 1, '', 1, 1),
(45, 2, '-3.70', 'Marché N°1', '2011-02-06 16:22:20', 0, '', 1, 1),
(46, 3, '-3.70', 'Marché N°1', '2011-01-26 15:13:45', 0, '', 1, 1),
(97, 4, '-7.68', 'Marché N°1', '2011-02-06 17:16:54', 0, '', 0, 1),
(48, 5, '-3.70', 'Marché N°1', '2010-11-29 19:19:27', 0, '', 0, 1),
(49, 6, '-1.23', 'Marché N°1', '2010-11-29 19:20:54', 0, '', 0, 1),
(50, 31, '30.00', 'Rechargement', '2010-11-29 19:22:07', 1, '', 1, 0),
(53, 34, '-96.00', 'Marché N°4', '2010-11-29 20:39:12', 0, '', 2, 4),
(51, 32, '-128.00', 'Marché N°4', '2010-11-29 19:48:33', 1, '', 1, 4),
(54, 12, '-6.45', 'Marché N°1', '2010-11-29 20:52:05', 0, '', 0, 1),
(55, 37, '0.00', 'Création du compte', '2010-12-22 19:23:11', -1, '', 1, 0),
(56, 39, '0.00', 'Création du compte', '2010-12-23 00:00:00', -1, '', 1, 0),
(57, 40, '0.00', 'Création du compte', '2010-12-23 00:00:00', -1, '', 1, 0),
(58, 40, '-50.00', 'Commande N°1', '2010-12-23 19:48:33', 1, '', 1, 1),
(59, 40, '-66.00', 'Commande N°2', '2010-12-23 19:55:48', 2, 'CHQ12354534', 1, 2),
(60, 41, '0.00', 'Création du compte', '2010-12-24 00:00:00', -1, '', 1, 0),
(61, 42, '0.00', 'Création du compte', '2010-12-24 00:00:00', -1, '', 1, 0),
(62, 43, '0.00', 'Création du compte', '2010-12-24 00:00:00', -1, '', 1, 0),
(63, 44, '0.00', 'Création du compte', '2010-12-24 00:00:00', -1, '', 1, 0),
(64, 45, '0.00', 'Création du compte', '2010-12-25 00:00:00', -1, '', 1, 0),
(65, 45, '-24.00', 'Marché N°5', '2010-12-25 21:50:48', 0, '', 2, 5),
(66, 45, '50.00', 'test rechargement', '2010-12-25 21:53:39', 1, '', 1, 0),
(67, 45, '-55.00', 'Marché N°6', '2011-01-26 11:19:37', 0, '', 0, 6),
(68, 40, '33.00', 'Bon de Commande', '2011-02-07 21:43:06', 5, '11', 3, 6),
(69, 39, '17.77', 'Bon de Commande', '2011-02-07 18:29:32', 5, '10', 3, 6),
(70, 40, '27.00', 'Bon de Commande', '2011-01-16 14:10:49', 5, '3', 3, 2),
(71, 40, '67.00', 'Bon de Commande', '2011-01-18 22:51:50', 5, '4', 3, 3),
(76, 40, '25.00', 'Bon de Livraison', '2011-02-07 21:42:44', 6, '11', 4, 6),
(77, 39, '-24.24', 'Marché n°6', '2011-02-07 22:20:02', 2, 'CHQ1111', 1, 6),
(75, 39, '55.55', 'Bon de Livraison', '2011-02-07 22:20:02', 6, '10', 4, 6),
(78, 40, '-42.43', 'Marché n°6', '2011-02-07 21:42:44', 2, 'CHQ412432', 1, 6),
(79, 40, '-43.00', 'Marché n°3', '2011-01-25 21:21:45', 2, 'CHQ2342', 1, 3),
(102, 12, '-22.00', 'Marché N°6', '2011-02-13 18:50:19', 7, '11', 1, 6),
(91, 40, '43.00', 'Bon de Livraison', '2011-01-25 21:21:45', 6, '4', 4, 3),
(93, 31, '-15.26', 'Marché N°6', '2011-02-07 22:21:12', 0, '', 0, 6),
(94, 2, '20.00', 'Rechargement', '2011-02-06 16:22:20', 2, 'CHQ12324', 1, 0),
(98, 46, '0.00', 'Création du compte', '2011-02-06 00:00:00', -1, '', 1, 0),
(99, 47, '0.00', 'Création du compte', '2011-02-06 00:00:00', -1, '', 1, 0),
(103, 12, '-12.00', 'Marché Solidaire n°6', '2011-02-13 19:49:27', 8, '10', 1, 6),
(101, 12, '-15.00', 'Marché N°6', '2011-02-13 18:50:19', 7, '10', 1, 6),
(104, 13, '-13.00', 'Marché Solidaire n°6', '2011-02-13 19:49:27', 8, '10', 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `prdt_producteur`
--

CREATE TABLE IF NOT EXISTS `prdt_producteur` (
  `prdt_id` int(11) NOT NULL AUTO_INCREMENT,
  `prdt_mot_passe` varchar(100) NOT NULL,
  `prdt_numero` varchar(20) NOT NULL,
  `prdt_id_compte` int(11) NOT NULL,
  `prdt_nom` varchar(50) NOT NULL,
  `prdt_prenom` varchar(50) NOT NULL,
  `prdt_courriel_principal` varchar(100) NOT NULL,
  `prdt_courriel_secondaire` varchar(100) NOT NULL,
  `prdt_telephone_principal` varchar(20) NOT NULL,
  `prdt_telephone_secondaire` varchar(20) NOT NULL,
  `prdt_adresse` varchar(300) NOT NULL,
  `prdt_code_postal` varchar(10) NOT NULL,
  `prdt_ville` varchar(100) NOT NULL,
  `prdt_date_naissance` date NOT NULL,
  `prdt_date_creation` date NOT NULL,
  `prdt_date_maj` datetime NOT NULL,
  `prdt_commentaire` text NOT NULL,
  `prdt_etat` tinyint(4) NOT NULL,
  PRIMARY KEY (`prdt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `prdt_producteur`
--

INSERT INTO `prdt_producteur` (`prdt_id`, `prdt_mot_passe`, `prdt_numero`, `prdt_id_compte`, `prdt_nom`, `prdt_prenom`, `prdt_courriel_principal`, `prdt_courriel_secondaire`, `prdt_telephone_principal`, `prdt_telephone_secondaire`, `prdt_adresse`, `prdt_code_postal`, `prdt_ville`, `prdt_date_naissance`, `prdt_date_creation`, `prdt_date_maj`, `prdt_commentaire`, `prdt_etat`) VALUES
(4, '', 'P4', 39, 'SAEZ', 'Damien', '', '', '', '', '', '', '', '0000-00-00', '2010-12-23', '2010-12-23 17:42:08', '', 1),
(5, '', 'P5', 40, 'AMSTRONG', 'Claude', 'raton@gmail.fr', 'guenillon@gmail.fr', '0406060610', '0187561235', '55 avenue des rigolos', '84563', 'LE VIEUX', '2010-12-23', '0000-00-00', '2011-01-03 00:04:35', 'Ben c&#039;est un gentil producteur. Et oui.', 1),
(3, '', 'P3', 0, 'VIRGILE', 'Roro', '', '', '', '', '', '', '', '0000-00-00', '2010-12-23', '2010-12-23 14:44:06', '', 1),
(1, '01f01083386dc09d99826461b2b6c6f1', 'P1', 37, 'PIGNAULT', 'Guillaume', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', 1),
(2, '', 'P2', 0, 'PRODUCTEUR', 'Lacombe', 'marcel@vincent.fr', 'marcel@vincent.fr', '0687561235', '0687561235', '15 allée du vercors', '98235', 'PARIS PLAGE', '2010-12-22', '2010-12-23', '2010-12-23 14:21:43', 'Voici un commentaire', 1),
(6, '', 'P6', 47, 'A', 'Suppression', '', '', '', '', '', '', '', '0000-00-00', '2011-02-06', '2011-02-06 17:56:12', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `pro_produit`
--

CREATE TABLE IF NOT EXISTS `pro_produit` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id_commande` int(11) NOT NULL,
  `pro_id_nom_produit` int(11) NOT NULL,
  `pro_unite_mesure` varchar(20) NOT NULL,
  `pro_max_produit_commande` decimal(10,2) NOT NULL,
  `pro_id_producteur` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `fk_pro_produit_npro_nom_produit1` (`pro_id_nom_produit`),
  KEY `fk_pro_produit_com_id_commande1` (`pro_id_commande`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `pro_produit`
--

INSERT INTO `pro_produit` (`pro_id`, `pro_id_commande`, `pro_id_nom_produit`, `pro_unite_mesure`, `pro_max_produit_commande`, `pro_id_producteur`) VALUES
(1, 1, 1, 'Douzaine', '2.00', 1),
(2, 1, 2, 'Unitée', '4.00', 4),
(3, 2, 3, 'g', '200.00', 5),
(4, 3, 4, 'Kg', '50.00', 5),
(5, 4, 3, 'Kg', '303.00', 4),
(6, 2, 4, 'Kg', '750.00', 4),
(7, 2, 1, 'Kg', '78.00', 1),
(8, 5, 3, 'Kg', '178.00', 4),
(9, 5, 4, 'Kg', '456.00', 4),
(10, 6, 4, 'Kg', '666.00', 4),
(11, 6, 2, 'g', '456.00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `sto_stock`
--

CREATE TABLE IF NOT EXISTS `sto_stock` (
  `sto_id` int(11) NOT NULL AUTO_INCREMENT,
  `sto_date` datetime NOT NULL,
  `sto_quantite` decimal(10,2) NOT NULL,
  `sto_type` tinyint(1) NOT NULL,
  `sto_id_compte` int(11) NOT NULL,
  `sto_id_detail_commande` int(11) NOT NULL,
  `sto_id_commande` int(11) NOT NULL,
  PRIMARY KEY (`sto_id`),
  KEY `fk_sto_stock_pro_produit1` (`sto_id_detail_commande`),
  KEY `fk_sto_stock_cpt_compte1` (`sto_id_compte`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Contenu de la table `sto_stock`
--

INSERT INTO `sto_stock` (`sto_id`, `sto_date`, `sto_quantite`, `sto_type`, `sto_id_compte`, `sto_id_detail_commande`, `sto_id_commande`) VALUES
(1, '2010-11-29 18:36:43', '60.00', 0, 0, 1, 1),
(2, '2010-11-29 18:36:43', '35.00', 0, 0, 3, 1),
(3, '2010-11-29 19:10:38', '-2.00', 0, 32, 1, 0),
(5, '2010-11-29 19:10:38', '-4.00', 0, 32, 3, 0),
(6, '2010-12-23 18:22:32', '1000.00', 0, 0, 8, 2),
(7, '2011-01-25 21:21:45', '32.00', 1, 0, 5, 3),
(8, '2010-11-29 18:54:01', '-2.00', 0, 33, 1, 1),
(9, '2010-11-29 18:54:01', '-4.00', 0, 33, 3, 1),
(10, '2010-12-22 15:03:39', '-200.00', 0, 33, 4, 0),
(37, '2011-02-07 21:43:06', '76.00', 3, 0, 16, 0),
(12, '2010-11-29 19:15:33', '-2.00', 0, 34, 2, 0),
(13, '2010-11-29 19:03:57', '-2.00', 0, 35, 1, 1),
(14, '2010-11-29 19:03:57', '-4.00', 0, 35, 2, 1),
(15, '2010-11-29 19:41:09', '-2.00', 1, 31, 1, 0),
(16, '2010-11-29 19:41:09', '-4.00', 1, 31, 2, 0),
(17, '2011-02-06 16:22:20', '-4.00', 1, 2, 3, 0),
(18, '2011-01-26 15:13:45', '-4.00', 1, 3, 3, 0),
(71, '2011-02-06 17:16:54', '-1.00', 0, 4, 2, 1),
(20, '2010-11-29 19:19:27', '-4.00', 0, 5, 3, 1),
(21, '2010-11-29 19:20:54', '-1.00', 0, 6, 2, 1),
(22, '2010-11-29 19:45:19', '5050.00', 0, 0, 7, 4),
(23, '2010-11-29 19:48:33', '-48.00', 1, 32, 7, 0),
(24, '2010-11-29 20:39:12', '-36.00', 2, 34, 7, 4),
(25, '2010-11-29 20:52:05', '-1.00', 0, 12, 1, 1),
(26, '2010-12-23 18:22:32', '750.00', 0, 0, 9, 2),
(27, '2010-12-23 18:22:32', '789.00', 0, 0, 10, 2),
(28, '2010-12-26 14:34:22', '789.00', 0, 0, 11, 5),
(29, '2010-12-25 21:50:48', '-90.00', 2, 45, 11, 0),
(30, '2010-12-26 14:34:22', '789.00', 0, 0, 13, 5),
(31, '2011-02-07 22:20:53', '66666.00', 0, 0, 15, 6),
(32, '2011-02-07 22:20:53', '500.00', 0, 0, 17, 6),
(33, '2011-01-26 11:19:37', '-33.00', 0, 45, 15, 0),
(72, '2011-02-07 22:21:12', '-20.00', 0, 31, 17, 0),
(38, '2011-02-07 18:29:32', '14.44', 3, 0, 14, 0),
(39, '2011-01-16 14:10:49', '250.00', 3, 0, 4, 0),
(40, '2011-01-18 22:51:50', '45.00', 3, 0, 5, 0),
(45, '2011-02-07 21:42:44', '44.40', 4, 0, 16, 0),
(46, '2011-02-07 22:20:02', '11.11', 5, 0, 14, 0),
(61, '2011-01-25 21:21:45', '32.00', 4, 0, 5, 0),
(44, '2011-02-07 22:20:02', '66666.00', 4, 0, 14, 0),
(55, '2011-01-25 21:09:26', '13.00', 5, 0, 5, 0),
(64, '2011-02-07 22:21:12', '-45.00', 0, 31, 14, 0),
(70, '2011-02-06 17:16:54', '-1.00', 0, 4, 1, 1),
(73, '2011-02-13 18:50:19', '-45.00', 1, 12, 14, 0),
(74, '2011-02-13 18:50:19', '-15.00', 1, 12, 16, 0),
(75, '2011-02-13 19:25:00', '-15.00', 5, 12, 14, 0),
(76, '2011-02-13 19:27:50', '-10.00', 5, 11, 14, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tpp_type_paiement`
--

CREATE TABLE IF NOT EXISTS `tpp_type_paiement` (
  `tpp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tpp_type` varchar(100) NOT NULL,
  `tpp_champ_complementaire` tinyint(4) NOT NULL,
  `tpp_label_champ_complementaire` varchar(30) NOT NULL,
  `tpp_visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`tpp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `tpp_type_paiement`
--

INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES
(1, 'Espèces', 0, '', 1),
(2, 'Chèque', 1, 'Numéro', 1),
(3, 'Virement (émission)', 1, 'Id compte reception', 0),
(4, 'Virement (réception)', 1, 'Id compte émission', 0),
(5, 'Bon de Commande', 1, 'Id produit', 0),
(6, 'Bon de Livraison', 1, 'Id produit', 0),
(7, 'Achat', 1, 'Id produit', 0),
(8, 'Achat Solidaire', 1, 'Id produit', 0);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_adherent`
--
CREATE TABLE IF NOT EXISTS `view_adherent` (
`adh_id` int(11)
,`adh_numero` varchar(20)
,`adh_id_compte` int(11)
,`cpt_label` varchar(30)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
,`adh_courriel_principal` varchar(100)
,`adh_courriel_secondaire` varchar(100)
,`adh_telephone_principal` varchar(20)
,`adh_telephone_secondaire` varchar(20)
,`adh_adresse` varchar(300)
,`adh_code_postal` varchar(10)
,`adh_ville` varchar(100)
,`adh_date_naissance` date
,`adh_date_adhesion` date
,`adh_date_maj` datetime
,`adh_commentaire` text
,`ope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_commande_complete_archive`
--
CREATE TABLE IF NOT EXISTS `view_commande_complete_archive` (
`com_id` int(11)
,`com_numero` int(11)
,`com_nom` varchar(100)
,`com_description` text
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
,`com_date_fin_reservation` datetime
,`com_archive` tinyint(1)
,`pro_id` int(11)
,`pro_id_commande` int(11)
,`pro_id_nom_produit` int(11)
,`pro_unite_mesure` varchar(20)
,`pro_max_produit_commande` decimal(10,2)
,`pro_id_producteur` int(11)
,`npro_id` int(11)
,`npro_nom` varchar(50)
,`npro_description` text
,`npro_id_categorie` int(11)
,`dcom_id` int(11)
,`dcom_id_produit` int(11)
,`dcom_taille` decimal(10,2)
,`dcom_prix` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_commande_complete_en_cours`
--
CREATE TABLE IF NOT EXISTS `view_commande_complete_en_cours` (
`com_id` int(11)
,`com_numero` int(11)
,`com_nom` varchar(100)
,`com_description` text
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
,`com_date_fin_reservation` datetime
,`com_archive` tinyint(1)
,`pro_id` int(11)
,`pro_id_commande` int(11)
,`pro_id_nom_produit` int(11)
,`pro_unite_mesure` varchar(20)
,`pro_max_produit_commande` decimal(10,2)
,`pro_id_producteur` int(11)
,`npro_id` int(11)
,`npro_nom` varchar(50)
,`npro_description` text
,`npro_id_categorie` int(11)
,`dcom_id` int(11)
,`dcom_id_produit` int(11)
,`dcom_taille` decimal(10,2)
,`dcom_prix` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_compte_zeybu`
--
CREATE TABLE IF NOT EXISTS `view_compte_zeybu` (
`ope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_compte_zeybu_caisse`
--
CREATE TABLE IF NOT EXISTS `view_compte_zeybu_caisse` (
`ope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_gestion_liste_commande_archive`
--
CREATE TABLE IF NOT EXISTS `view_gestion_liste_commande_archive` (
`com_id` int(11)
,`com_numero` int(11)
,`com_date_fin_reservation` datetime
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_gestion_liste_commande_en_cours`
--
CREATE TABLE IF NOT EXISTS `view_gestion_liste_commande_en_cours` (
`com_id` int(11)
,`com_numero` int(11)
,`com_date_fin_reservation` datetime
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_identification`
--
CREATE TABLE IF NOT EXISTS `view_identification` (
`adh_id` int(11)
,`adh_id_compte` int(11)
,`adh_numero` varchar(20)
,`adh_mot_passe` varchar(100)
,`mod_nom` varchar(50)
,`adh_super_zeybu` tinyint(1)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_info_bon_commande`
--
CREATE TABLE IF NOT EXISTS `view_info_bon_commande` (
`com_id` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`ope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`prdt_nom` varchar(50)
,`prdt_prenom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_info_bon_livraison`
--
CREATE TABLE IF NOT EXISTS `view_info_bon_livraison` (
`com_id` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`ope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`prdt_nom` varchar(50)
,`prdt_prenom` varchar(50)
,`ope_montant_livraison` decimal(10,2)
,`sto_quantite_livraison` decimal(10,2)
,`sto_quantite_solidaire` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_info_commande`
--
CREATE TABLE IF NOT EXISTS `view_info_commande` (
`com_id` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`ope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`ope_montant_livraison` decimal(10,2)
,`sto_quantite_livraison` decimal(10,2)
,`sto_quantite_solidaire` decimal(10,2)
,`sto_quantite_vente` decimal(33,2)
,`sto_quantite_vente_solidaire` decimal(33,2)
,`ope_montant_vente` decimal(33,2)
,`ope_montant_vente_solidaire` decimal(33,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_adherent`
--
CREATE TABLE IF NOT EXISTS `view_liste_adherent` (
`adh_id` int(11)
,`adh_numero` varchar(20)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
,`adh_courriel_principal` varchar(100)
,`ope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_adherent_commande`
--
CREATE TABLE IF NOT EXISTS `view_liste_adherent_commande` (
`com_id` int(11)
,`com_numero` int(11)
,`adh_id` int(11)
,`adh_numero` varchar(20)
,`cpt_label` varchar(30)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_adherent_commande_reservation`
--
CREATE TABLE IF NOT EXISTS `view_liste_adherent_commande_reservation` (
`com_id` int(11)
,`com_numero` int(11)
,`adh_id` int(11)
,`adh_numero` varchar(20)
,`cpt_label` varchar(30)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_commande_archive`
--
CREATE TABLE IF NOT EXISTS `view_liste_commande_archive` (
`com_id` int(11)
,`com_numero` int(11)
,`com_date_fin_reservation` datetime
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_commande_en_cours`
--
CREATE TABLE IF NOT EXISTS `view_liste_commande_en_cours` (
`com_id` int(11)
,`com_numero` int(11)
,`com_date_fin_reservation` datetime
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_producteur_commande`
--
CREATE TABLE IF NOT EXISTS `view_liste_producteur_commande` (
`com_id` int(11)
,`prdt_id` int(11)
,`prdt_nom` varchar(50)
,`prdt_prenom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_reservation_archive`
--
CREATE TABLE IF NOT EXISTS `view_liste_reservation_archive` (
`adh_id` int(11)
,`adh_numero` varchar(20)
,`adh_id_compte` int(11)
,`adh_super_zeybu` tinyint(1)
,`com_id` int(11)
,`com_numero` int(11)
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
,`com_date_fin_reservation` datetime
,`com_archive` tinyint(1)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_reservation_en_cours`
--
CREATE TABLE IF NOT EXISTS `view_liste_reservation_en_cours` (
`adh_id` int(11)
,`adh_numero` varchar(20)
,`adh_id_compte` int(11)
,`adh_super_zeybu` tinyint(1)
,`com_id` int(11)
,`com_numero` int(11)
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
,`com_date_fin_reservation` datetime
,`com_archive` tinyint(1)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_menu`
--
CREATE TABLE IF NOT EXISTS `view_menu` (
`adh_id` int(11)
,`adh_super_zeybu` tinyint(1)
,`mod_id` int(11)
,`mod_nom` varchar(50)
,`mod_label` varchar(80)
,`mod_admin` tinyint(1)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_operation_achat`
--
CREATE TABLE IF NOT EXISTS `view_operation_achat` (
`com_id` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`ope_id` int(11)
,`ope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_operation_achat_solidaire`
--
CREATE TABLE IF NOT EXISTS `view_operation_achat_solidaire` (
`com_id` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`ope_id` int(11)
,`ope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_operation_avenir`
--
CREATE TABLE IF NOT EXISTS `view_operation_avenir` (
`ope_id_compte` int(11)
,`ope_montant` decimal(10,2)
,`ope_libelle` varchar(100)
,`ope_date` datetime
,`com_date_marche_debut` datetime
,`tpp_type` varchar(100)
,`tpp_champ_complementaire` tinyint(4)
,`tpp_label_champ_complementaire` varchar(30)
,`ope_type_paiement_champ_complementaire` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_operation_bon_livraison`
--
CREATE TABLE IF NOT EXISTS `view_operation_bon_livraison` (
`com_id` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`ope_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`ope_montant` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_operation_passee`
--
CREATE TABLE IF NOT EXISTS `view_operation_passee` (
`ope_id_compte` int(11)
,`cpt_label` varchar(30)
,`ope_montant` decimal(10,2)
,`ope_libelle` varchar(100)
,`ope_date` datetime
,`tpp_type` varchar(100)
,`tpp_champ_complementaire` tinyint(4)
,`tpp_label_champ_complementaire` varchar(30)
,`ope_type_paiement_champ_complementaire` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_operation_produit_bon_commande`
--
CREATE TABLE IF NOT EXISTS `view_operation_produit_bon_commande` (
`com_id` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`ope_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`ope_montant` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_producteur`
--
CREATE TABLE IF NOT EXISTS `view_producteur` (
`prdt_id` int(11)
,`prdt_numero` varchar(20)
,`prdt_id_compte` int(11)
,`cpt_label` varchar(30)
,`prdt_nom` varchar(50)
,`prdt_prenom` varchar(50)
,`prdt_courriel_principal` varchar(100)
,`prdt_courriel_secondaire` varchar(100)
,`prdt_telephone_principal` varchar(20)
,`prdt_telephone_secondaire` varchar(20)
,`prdt_adresse` varchar(300)
,`prdt_code_postal` varchar(10)
,`prdt_ville` varchar(100)
,`prdt_date_naissance` date
,`prdt_date_creation` date
,`prdt_date_maj` datetime
,`prdt_commentaire` text
,`ope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_reservation`
--
CREATE TABLE IF NOT EXISTS `view_reservation` (
`com_id` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`sto_quantite` decimal(10,2)
,`pro_unite_mesure` varchar(20)
,`sto_type` tinyint(1)
,`sto_id_compte` int(11)
,`dcom_id` int(11)
,`adh_id` int(11)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
,`cpt_label` varchar(30)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_achat`
--
CREATE TABLE IF NOT EXISTS `view_stock_achat` (
`pro_id_commande` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`dcom_id` int(11)
,`sto_quantite` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_achat_solidaire`
--
CREATE TABLE IF NOT EXISTS `view_stock_achat_solidaire` (
`pro_id_commande` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`dcom_id` int(11)
,`sto_quantite` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_commande`
--
CREATE TABLE IF NOT EXISTS `view_stock_commande` (
`pro_id_commande` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`dcom_id` int(11)
,`sto_quantite` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_livraison`
--
CREATE TABLE IF NOT EXISTS `view_stock_livraison` (
`pro_id_commande` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`dcom_id` int(11)
,`sto_quantite` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_produit`
--
CREATE TABLE IF NOT EXISTS `view_stock_produit` (
`pro_id` int(11)
,`pro_id_commande` int(11)
,`pro_id_nom_produit` int(11)
,`sto_quantite` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_produit_initiaux`
--
CREATE TABLE IF NOT EXISTS `view_stock_produit_initiaux` (
`sto_id` int(11)
,`sto_date` datetime
,`sto_quantite` decimal(10,2)
,`sto_type` tinyint(1)
,`sto_id_commande` int(11)
,`dcom_id_produit` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_produit_reservation`
--
CREATE TABLE IF NOT EXISTS `view_stock_produit_reservation` (
`com_id` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`sto_quantite` decimal(33,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_solidaire`
--
CREATE TABLE IF NOT EXISTS `view_stock_solidaire` (
`pro_id_commande` int(11)
,`pro_id_producteur` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`dcom_id` int(11)
,`sto_quantite` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_type_paiement_visible`
--
CREATE TABLE IF NOT EXISTS `view_type_paiement_visible` (
`tpp_id` int(11)
,`tpp_type` varchar(100)
,`tpp_champ_complementaire` tinyint(4)
,`tpp_label_champ_complementaire` varchar(30)
,`tpp_visible` tinyint(1)
);
-- --------------------------------------------------------

--
-- Structure de la table `vue_vues`
--

CREATE TABLE IF NOT EXISTS `vue_vues` (
  `vue_id` int(11) NOT NULL AUTO_INCREMENT,
  `vue_id_module` int(11) NOT NULL,
  `vue_nom` varchar(50) NOT NULL,
  `vue_label` varchar(80) NOT NULL,
  `vue_ordre` int(11) NOT NULL,
  PRIMARY KEY (`vue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `vue_vues`
--

INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`) VALUES
(1, 1, 'MonCompte', 'Mon Compte', 1),
(2, 2, 'ListeAdherent', 'Liste des Adhérents', 2),
(3, 2, 'AjoutAdherent', 'Ajouter un Adhérent', 1),
(4, 3, 'ListeCommande', 'Marché', 2),
(5, 4, 'AjoutCommande', 'Créer un Marché', 1),
(6, 4, 'ListeCommande', 'Liste des Marchés', 2),
(8, 3, 'MesCommandes', 'Mes Commandes', 1),
(9, 5, 'AjoutProducteur', 'Ajouter un Producteur', 1),
(10, 5, 'ListeProducteur', 'Liste des Producteurs', 2),
(11, 6, 'CompteZeybu', 'Le Compte du Zeybu', 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_adherent`
--
DROP TABLE IF EXISTS `view_adherent`;

CREATE VIEW `view_adherent` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,`adh_adherent`.`adh_courriel_secondaire` AS `adh_courriel_secondaire`,`adh_adherent`.`adh_telephone_principal` AS `adh_telephone_principal`,`adh_adherent`.`adh_telephone_secondaire` AS `adh_telephone_secondaire`,`adh_adherent`.`adh_adresse` AS `adh_adresse`,`adh_adherent`.`adh_code_postal` AS `adh_code_postal`,`adh_adherent`.`adh_ville` AS `adh_ville`,`adh_adherent`.`adh_date_naissance` AS `adh_date_naissance`,`adh_adherent`.`adh_date_adhesion` AS `adh_date_adhesion`,`adh_adherent`.`adh_date_maj` AS `adh_date_maj`,`adh_adherent`.`adh_commentaire` AS `adh_commentaire`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`adh_adherent` left join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) left join `cpt_compte` on((`cpt_compte`.`cpt_id` = `adh_adherent`.`adh_id_compte`))) where ((`ope_operation`.`ope_type` = 1) and (`adh_adherent`.`adh_super_zeybu` = 0)) group by `adh_adherent`.`adh_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_commande_complete_archive`
--
DROP TABLE IF EXISTS `view_commande_complete_archive`;

CREATE VIEW `view_commande_complete_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`com_commande`.`com_archive` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_commande_complete_en_cours`
--
DROP TABLE IF EXISTS `view_commande_complete_en_cours`;

CREATE VIEW `view_commande_complete_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`com_commande`.`com_archive` = 0);

-- --------------------------------------------------------

--
-- Structure de la vue `view_compte_zeybu`
--
DROP TABLE IF EXISTS `view_compte_zeybu`;

CREATE VIEW `view_compte_zeybu` AS select sum(`ope_operation`.`ope_montant`) AS `ope_montant` from `ope_operation` where (`ope_operation`.`ope_type` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_compte_zeybu_caisse`
--
DROP TABLE IF EXISTS `view_compte_zeybu_caisse`;

CREATE VIEW `view_compte_zeybu_caisse` AS select sum(`ope_operation`.`ope_montant`) AS `ope_montant` from `ope_operation` where ((`ope_operation`.`ope_type` = 1) and (`ope_operation`.`ope_type_paiement` = 1));

-- --------------------------------------------------------

--
-- Structure de la vue `view_gestion_liste_commande_archive`
--
DROP TABLE IF EXISTS `view_gestion_liste_commande_archive`;

CREATE VIEW `view_gestion_liste_commande_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_gestion_liste_commande_en_cours`
--
DROP TABLE IF EXISTS `view_gestion_liste_commande_en_cours`;

CREATE VIEW `view_gestion_liste_commande_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` = 0) order by `com_commande`.`com_date_marche_debut`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_identification`
--
DROP TABLE IF EXISTS `view_identification`;

CREATE VIEW `view_identification` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_mot_passe` AS `adh_mot_passe`,`mod_module`.`mod_nom` AS `mod_nom`,`adh_adherent`.`adh_super_zeybu` AS `adh_super_zeybu` from ((`adh_adherent` left join `aut_autorisation` on((`adh_adherent`.`adh_id` = `aut_autorisation`.`aut_id_adherent`))) left join `mod_module` on((`aut_autorisation`.`aut_id_module` = `mod_module`.`mod_id`))) where (`adh_adherent`.`adh_etat` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_info_bon_commande`
--
DROP TABLE IF EXISTS `view_info_bon_commande`;

CREATE VIEW `view_info_bon_commande` AS select `view_operation_produit_bon_commande`.`com_id` AS `com_id`,`view_operation_produit_bon_commande`.`pro_id_producteur` AS `pro_id_producteur`,`view_operation_produit_bon_commande`.`pro_id` AS `pro_id`,`view_operation_produit_bon_commande`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_operation_produit_bon_commande`.`npro_nom` AS `npro_nom`,`view_operation_produit_bon_commande`.`ope_montant` AS `ope_montant`,`view_stock_commande`.`sto_quantite` AS `sto_quantite`,`view_producteur`.`prdt_nom` AS `prdt_nom`,`view_producteur`.`prdt_prenom` AS `prdt_prenom` from ((`view_operation_produit_bon_commande` join `view_stock_commande` on(((`view_stock_commande`.`pro_id_commande` = `view_operation_produit_bon_commande`.`com_id`) and (`view_stock_commande`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_stock_commande`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) join `view_producteur` on((`view_producteur`.`prdt_id` = `view_stock_commande`.`pro_id_producteur`))) group by `view_operation_produit_bon_commande`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_info_bon_livraison`
--
DROP TABLE IF EXISTS `view_info_bon_livraison`;

CREATE VIEW `view_info_bon_livraison` AS select `view_operation_produit_bon_commande`.`com_id` AS `com_id`,`view_operation_produit_bon_commande`.`pro_id_producteur` AS `pro_id_producteur`,`view_operation_produit_bon_commande`.`pro_id` AS `pro_id`,`view_operation_produit_bon_commande`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_operation_produit_bon_commande`.`npro_nom` AS `npro_nom`,`view_operation_produit_bon_commande`.`ope_montant` AS `ope_montant`,`view_stock_commande`.`sto_quantite` AS `sto_quantite`,`view_producteur`.`prdt_nom` AS `prdt_nom`,`view_producteur`.`prdt_prenom` AS `prdt_prenom`,`view_operation_bon_livraison`.`ope_montant` AS `ope_montant_livraison`,`view_stock_livraison`.`sto_quantite` AS `sto_quantite_livraison`,`view_stock_solidaire`.`sto_quantite` AS `sto_quantite_solidaire` from (((((`view_operation_produit_bon_commande` left join `view_stock_commande` on(((`view_stock_commande`.`pro_id_commande` = `view_operation_produit_bon_commande`.`com_id`) and (`view_stock_commande`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_stock_commande`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) join `view_producteur` on((`view_producteur`.`prdt_id` = `view_stock_commande`.`pro_id_producteur`))) left join `view_operation_bon_livraison` on(((`view_operation_bon_livraison`.`com_id` = `view_operation_produit_bon_commande`.`com_id`) and (`view_operation_bon_livraison`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_operation_bon_livraison`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) left join `view_stock_livraison` on(((`view_stock_livraison`.`pro_id_commande` = `view_operation_produit_bon_commande`.`com_id`) and (`view_stock_livraison`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_stock_livraison`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) left join `view_stock_solidaire` on(((`view_stock_solidaire`.`pro_id_commande` = `view_operation_produit_bon_commande`.`com_id`) and (`view_stock_solidaire`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_stock_solidaire`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) group by `view_operation_produit_bon_commande`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_info_commande`
--
DROP TABLE IF EXISTS `view_info_commande`;

CREATE VIEW `view_info_commande` AS select `pro_produit`.`pro_id_commande` AS `com_id`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`view_operation_produit_bon_commande`.`ope_montant` AS `ope_montant`,`view_stock_commande`.`sto_quantite` AS `sto_quantite`,`view_operation_bon_livraison`.`ope_montant` AS `ope_montant_livraison`,`view_stock_livraison`.`sto_quantite` AS `sto_quantite_livraison`,`view_stock_solidaire`.`sto_quantite` AS `sto_quantite_solidaire`,(`view_stock_achat`.`sto_quantite` * -(1)) AS `sto_quantite_vente`,(`view_stock_achat_solidaire`.`sto_quantite` * -(1)) AS `sto_quantite_vente_solidaire`,(`view_operation_achat`.`ope_montant` * -(1)) AS `ope_montant_vente`,(`view_operation_achat_solidaire`.`ope_montant` * -(1)) AS `ope_montant_vente_solidaire` from ((((((((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) left join `view_operation_produit_bon_commande` on((`view_operation_produit_bon_commande`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_commande` on((`view_stock_commande`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_operation_bon_livraison` on((`view_operation_bon_livraison`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_livraison` on((`view_stock_livraison`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_solidaire` on((`view_stock_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_achat` on((`view_stock_achat`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_achat_solidaire` on((`view_stock_achat_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_operation_achat` on((`view_operation_achat`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_operation_achat_solidaire` on((`view_operation_achat_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_adherent`
--
DROP TABLE IF EXISTS `view_liste_adherent`;

CREATE VIEW `view_liste_adherent` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from (`adh_adherent` left join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) where ((`ope_operation`.`ope_type` = 1) and (`adh_adherent`.`adh_super_zeybu` = 0) and (`adh_adherent`.`adh_etat` = 1)) group by `adh_adherent`.`adh_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_adherent_commande`
--
DROP TABLE IF EXISTS `view_liste_adherent_commande`;

CREATE VIEW `view_liste_adherent_commande` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom` from (((`adh_adherent` join `gpc_groupe_commande` on((`gpc_groupe_commande`.`gpc_id_compte` = `adh_adherent`.`adh_id_compte`))) join `com_commande` on((`gpc_groupe_commande`.`gpc_id_commande` = `com_commande`.`com_id`))) left join `cpt_compte` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) where (`adh_adherent`.`adh_etat` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_adherent_commande_reservation`
--
DROP TABLE IF EXISTS `view_liste_adherent_commande_reservation`;

CREATE VIEW `view_liste_adherent_commande_reservation` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom` from (((`adh_adherent` join `gpc_groupe_commande` on((`gpc_groupe_commande`.`gpc_id_compte` = `adh_adherent`.`adh_id_compte`))) join `com_commande` on((`gpc_groupe_commande`.`gpc_id_commande` = `com_commande`.`com_id`))) left join `cpt_compte` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) where ((`adh_adherent`.`adh_etat` = 1) and (`gpc_groupe_commande`.`gpc_etat` = 0));

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_commande_archive`
--
DROP TABLE IF EXISTS `view_liste_commande_archive`;

CREATE VIEW `view_liste_commande_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where ((`com_commande`.`com_date_fin_reservation` < now()) or (`com_commande`.`com_archive` <> 0));

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_commande_en_cours`
--
DROP TABLE IF EXISTS `view_liste_commande_en_cours`;

CREATE VIEW `view_liste_commande_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where ((`com_commande`.`com_date_fin_reservation` >= now()) and (`com_commande`.`com_archive` = 0));

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_producteur_commande`
--
DROP TABLE IF EXISTS `view_liste_producteur_commande`;

CREATE VIEW `view_liste_producteur_commande` AS select `view_commande_complete_en_cours`.`com_id` AS `com_id`,`view_producteur`.`prdt_id` AS `prdt_id`,`view_producteur`.`prdt_nom` AS `prdt_nom`,`view_producteur`.`prdt_prenom` AS `prdt_prenom` from (`view_commande_complete_en_cours` join `view_producteur` on((`view_commande_complete_en_cours`.`pro_id_producteur` = `view_producteur`.`prdt_id`))) group by `view_commande_complete_en_cours`.`com_id`,`view_producteur`.`prdt_nom`,`view_producteur`.`prdt_prenom` order by `view_producteur`.`prdt_nom`,`view_producteur`.`prdt_prenom`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_reservation_archive`
--
DROP TABLE IF EXISTS `view_liste_reservation_archive`;

CREATE VIEW `view_liste_reservation_archive` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`adh_adherent`.`adh_super_zeybu` AS `adh_super_zeybu`,`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive` from ((`adh_adherent` join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`com_commande`.`com_date_marche_fin` < curdate()) or ((`com_commande`.`com_archive` = 1) and (`ope_operation`.`ope_type` = 1)));

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_reservation_en_cours`
--
DROP TABLE IF EXISTS `view_liste_reservation_en_cours`;

CREATE VIEW `view_liste_reservation_en_cours` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`adh_adherent`.`adh_super_zeybu` AS `adh_super_zeybu`,`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive` from ((`adh_adherent` join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`com_commande`.`com_date_marche_fin` >= curdate()) and (`com_commande`.`com_archive` = 0) and (`ope_operation`.`ope_type` = 0)) order by `com_commande`.`com_date_marche_debut`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_menu`
--
DROP TABLE IF EXISTS `view_menu`;

CREATE VIEW `view_menu` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_super_zeybu` AS `adh_super_zeybu`,`mod_module`.`mod_id` AS `mod_id`,`mod_module`.`mod_nom` AS `mod_nom`,`mod_module`.`mod_label` AS `mod_label`,`mod_module`.`mod_admin` AS `mod_admin` from ((`adh_adherent` left join `aut_autorisation` on((`adh_adherent`.`adh_id` = `aut_autorisation`.`aut_id_adherent`))) left join `mod_module` on((`aut_autorisation`.`aut_id_module` = `mod_module`.`mod_id`))) where (`adh_adherent`.`adh_etat` = 1) order by `mod_module`.`mod_ordre`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_achat`
--
DROP TABLE IF EXISTS `view_operation_achat`;

CREATE VIEW `view_operation_achat` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`ope_operation`.`ope_id` AS `ope_id`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`ope_operation` join `com_commande` on((`ope_operation`.`ope_id_commande` = `com_commande`.`com_id`))) join `pro_produit` on((`ope_operation`.`ope_type_paiement_champ_complementaire` = `pro_produit`.`pro_id`))) where ((`ope_operation`.`ope_type` = 1) and (`ope_operation`.`ope_type_paiement` = 7) and (`ope_operation`.`ope_montant` < 0)) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_achat_solidaire`
--
DROP TABLE IF EXISTS `view_operation_achat_solidaire`;

CREATE VIEW `view_operation_achat_solidaire` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`ope_operation`.`ope_id` AS `ope_id`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`ope_operation` join `com_commande` on((`ope_operation`.`ope_id_commande` = `com_commande`.`com_id`))) join `pro_produit` on((`ope_operation`.`ope_type_paiement_champ_complementaire` = `pro_produit`.`pro_id`))) where ((`ope_operation`.`ope_type` = 1) and (`ope_operation`.`ope_type_paiement` = 8) and (`ope_operation`.`ope_montant` < 0)) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_avenir`
--
DROP TABLE IF EXISTS `view_operation_avenir`;

CREATE VIEW `view_operation_avenir` AS select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` from ((`ope_operation` left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) left join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`ope_operation`.`ope_type` = 0) and (`com_commande`.`com_archive` = 0)) order by `com_commande`.`com_date_marche_debut`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_bon_livraison`
--
DROP TABLE IF EXISTS `view_operation_bon_livraison`;

CREATE VIEW `view_operation_bon_livraison` AS select `view_commande_complete_en_cours`.`com_id` AS `com_id`,`view_commande_complete_en_cours`.`pro_id_producteur` AS `pro_id_producteur`,`view_commande_complete_en_cours`.`pro_id` AS `pro_id`,`ope_operation`.`ope_id` AS `ope_id`,`view_commande_complete_en_cours`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_commande_complete_en_cours`.`npro_nom` AS `npro_nom`,`ope_operation`.`ope_montant` AS `ope_montant` from (`view_commande_complete_en_cours` join `ope_operation` on(((`ope_operation`.`ope_id_commande` = `view_commande_complete_en_cours`.`com_id`) and (`ope_operation`.`ope_type_paiement_champ_complementaire` = `view_commande_complete_en_cours`.`pro_id`)))) where (`ope_operation`.`ope_type` = 4) group by `view_commande_complete_en_cours`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_passee`
--
DROP TABLE IF EXISTS `view_operation_passee`;

CREATE VIEW `view_operation_passee` AS select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` from ((`ope_operation` join `cpt_compte` on((`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) where (`ope_operation`.`ope_type` = 1) order by `ope_operation`.`ope_date` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_produit_bon_commande`
--
DROP TABLE IF EXISTS `view_operation_produit_bon_commande`;

CREATE VIEW `view_operation_produit_bon_commande` AS select `view_commande_complete_en_cours`.`com_id` AS `com_id`,`view_commande_complete_en_cours`.`pro_id_producteur` AS `pro_id_producteur`,`view_commande_complete_en_cours`.`pro_id` AS `pro_id`,`ope_operation`.`ope_id` AS `ope_id`,`view_commande_complete_en_cours`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_commande_complete_en_cours`.`npro_nom` AS `npro_nom`,`ope_operation`.`ope_montant` AS `ope_montant` from (`view_commande_complete_en_cours` join `ope_operation` on(((`ope_operation`.`ope_id_commande` = `view_commande_complete_en_cours`.`com_id`) and (`ope_operation`.`ope_type_paiement_champ_complementaire` = `view_commande_complete_en_cours`.`pro_id`)))) where (`ope_operation`.`ope_type` = 3) group by `view_commande_complete_en_cours`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_producteur`
--
DROP TABLE IF EXISTS `view_producteur`;

CREATE VIEW `view_producteur` AS select `prdt_producteur`.`prdt_id` AS `prdt_id`,`prdt_producteur`.`prdt_numero` AS `prdt_numero`,`prdt_producteur`.`prdt_id_compte` AS `prdt_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,`prdt_producteur`.`prdt_courriel_principal` AS `prdt_courriel_principal`,`prdt_producteur`.`prdt_courriel_secondaire` AS `prdt_courriel_secondaire`,`prdt_producteur`.`prdt_telephone_principal` AS `prdt_telephone_principal`,`prdt_producteur`.`prdt_telephone_secondaire` AS `prdt_telephone_secondaire`,`prdt_producteur`.`prdt_adresse` AS `prdt_adresse`,`prdt_producteur`.`prdt_code_postal` AS `prdt_code_postal`,`prdt_producteur`.`prdt_ville` AS `prdt_ville`,`prdt_producteur`.`prdt_date_naissance` AS `prdt_date_naissance`,`prdt_producteur`.`prdt_date_creation` AS `prdt_date_creation`,`prdt_producteur`.`prdt_date_maj` AS `prdt_date_maj`,`prdt_producteur`.`prdt_commentaire` AS `prdt_commentaire`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`prdt_producteur` left join `ope_operation` on((`prdt_producteur`.`prdt_id_compte` = `ope_operation`.`ope_id_compte`))) left join `cpt_compte` on((`cpt_compte`.`cpt_id` = `prdt_producteur`.`prdt_id_compte`))) where ((`ope_operation`.`ope_type` = 1) and (`prdt_producteur`.`prdt_etat` = 1)) group by `prdt_producteur`.`prdt_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_reservation`
--
DROP TABLE IF EXISTS `view_reservation`;

CREATE VIEW `view_reservation` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`sto_stock`.`sto_type` AS `sto_type`,`sto_stock`.`sto_id_compte` AS `sto_id_compte`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cpt_compte`.`cpt_label` AS `cpt_label` from (((((`com_commande` join `pro_produit` on((`com_commande`.`com_id` = `pro_produit`.`pro_id_commande`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`dcom_detail_commande`.`dcom_id` = `sto_stock`.`sto_id_detail_commande`))) join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `sto_stock`.`sto_id_compte`))) join `cpt_compte` on((`cpt_compte`.`cpt_id` = `sto_stock`.`sto_id_compte`))) where ((`sto_stock`.`sto_type` = 0) and (`sto_stock`.`sto_id_compte` <> 0));

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_achat`
--
DROP TABLE IF EXISTS `view_stock_achat`;

CREATE VIEW `view_stock_achat` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where ((`sto_stock`.`sto_type` = 1) and (`sto_stock`.`sto_quantite` < 0)) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_achat_solidaire`
--
DROP TABLE IF EXISTS `view_stock_achat_solidaire`;

CREATE VIEW `view_stock_achat_solidaire` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where ((`sto_stock`.`sto_type` = 5) and (`sto_stock`.`sto_quantite` < 0)) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_commande`
--
DROP TABLE IF EXISTS `view_stock_commande`;

CREATE VIEW `view_stock_commande` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`sto_stock`.`sto_quantite` AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`sto_stock`.`sto_type` = 3);

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_livraison`
--
DROP TABLE IF EXISTS `view_stock_livraison`;

CREATE VIEW `view_stock_livraison` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`sto_stock`.`sto_quantite` AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`sto_stock`.`sto_type` = 4);

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_produit`
--
DROP TABLE IF EXISTS `view_stock_produit`;

CREATE VIEW `view_stock_produit` AS select `pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` from ((`pro_produit` join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on(((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`) and (`sto_stock`.`sto_type` in (0,1))))) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_produit_initiaux`
--
DROP TABLE IF EXISTS `view_stock_produit_initiaux`;

CREATE VIEW `view_stock_produit_initiaux` AS select `sto_stock`.`sto_id` AS `sto_id`,`sto_stock`.`sto_date` AS `sto_date`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`sto_stock`.`sto_type` AS `sto_type`,`sto_stock`.`sto_id_commande` AS `sto_id_commande`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit` from (`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`sto_stock`.`sto_id_compte` = 0) and (`sto_stock`.`sto_type` in (0,1)));

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_produit_reservation`
--
DROP TABLE IF EXISTS `view_stock_produit_reservation`;

CREATE VIEW `view_stock_produit_reservation` AS select `view_commande_complete_en_cours`.`com_id` AS `com_id`,`view_commande_complete_en_cours`.`pro_id_producteur` AS `pro_id_producteur`,`view_commande_complete_en_cours`.`pro_id` AS `pro_id`,`view_commande_complete_en_cours`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_commande_complete_en_cours`.`npro_nom` AS `npro_nom`,(`view_stock_produit_initiaux`.`sto_quantite` - `view_stock_produit`.`sto_quantite`) AS `sto_quantite` from ((`view_commande_complete_en_cours` join `view_stock_produit_initiaux` on((`view_stock_produit_initiaux`.`dcom_id_produit` = `view_commande_complete_en_cours`.`pro_id`))) join `view_stock_produit` on((`view_stock_produit`.`pro_id` = `view_commande_complete_en_cours`.`pro_id`))) group by `view_commande_complete_en_cours`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_solidaire`
--
DROP TABLE IF EXISTS `view_stock_solidaire`;

CREATE VIEW `view_stock_solidaire` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`sto_stock`.`sto_quantite` AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`sto_stock`.`sto_type` = 5);

-- --------------------------------------------------------

--
-- Structure de la vue `view_type_paiement_visible`
--
DROP TABLE IF EXISTS `view_type_paiement_visible`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_type_paiement_visible` AS select `tpp_type_paiement`.`tpp_id` AS `tpp_id`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`tpp_type_paiement`.`tpp_visible` AS `tpp_visible` from `tpp_type_paiement` where (`tpp_type_paiement`.`tpp_visible` = 1);
