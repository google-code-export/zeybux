-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 26 Novembre 2010 à 13:35
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;

--
-- Base de données: `zeybu`
--

-- --------------------------------------------------------

--
-- Structure de la table `adh_adherent`
--

DROP TABLE IF EXISTS `adh_adherent`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aut_autorisation`
--

DROP TABLE IF EXISTS `aut_autorisation`;
CREATE TABLE IF NOT EXISTS `aut_autorisation` (
  `aut_id` int(11) NOT NULL AUTO_INCREMENT,
  `aut_id_adherent` int(11) NOT NULL,
  `aut_id_module` int(11) NOT NULL,
  PRIMARY KEY (`aut_id`),
  KEY `fk_aut_autorisation_mod_module` (`aut_id_module`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `com_commande`
--

DROP TABLE IF EXISTS `com_commande`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cpro_categorie_produit`
--

DROP TABLE IF EXISTS `cpro_categorie_produit`;
CREATE TABLE IF NOT EXISTS `cpro_categorie_produit` (
  `cpro_id` int(11) NOT NULL AUTO_INCREMENT,
  `cpro_nom` varchar(50) NOT NULL,
  `cpro_description` text NOT NULL,
  PRIMARY KEY (`cpro_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cpt_compte`
--

DROP TABLE IF EXISTS `cpt_compte`;
CREATE TABLE IF NOT EXISTS `cpt_compte` (
  `cpt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cpt_label` varchar(30) NOT NULL,
  PRIMARY KEY (`cpt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dcom_detail_commande`
--

DROP TABLE IF EXISTS `dcom_detail_commande`;
CREATE TABLE IF NOT EXISTS `dcom_detail_commande` (
  `dcom_id` int(11) NOT NULL AUTO_INCREMENT,
  `dcom_id_produit` int(11) NOT NULL,
  `dcom_taille` decimal(10,2) NOT NULL,
  `dcom_prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`dcom_id`),
  KEY `fk_lot_lot_produit_pro_produit1` (`dcom_id_produit`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gpc_groupe_commande`
--

DROP TABLE IF EXISTS `gpc_groupe_commande`;
CREATE TABLE IF NOT EXISTS `gpc_groupe_commande` (
  `gpc_id` int(11) NOT NULL AUTO_INCREMENT,
  `gpc_id_compte` int(11) NOT NULL,
  `gpc_id_commande` int(11) NOT NULL,
  `gpc_etat` tinyint(4) NOT NULL,
  PRIMARY KEY (`gpc_id`),
  KEY `fk_gpc_groupe_commande_adh_adherent1` (`gpc_id_compte`),
  KEY `fk_gpc_groupe_commande_com_commande1` (`gpc_id_commande`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mod_module`
--

DROP TABLE IF EXISTS `mod_module`;
CREATE TABLE IF NOT EXISTS `mod_module` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nom` varchar(50) NOT NULL,
  `mod_label` varchar(80) NOT NULL,
  `mod_defaut` tinyint(1) NOT NULL,
  `mod_ordre` int(11) NOT NULL,
  `mod_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`mod_id`),
  KEY `fk_mod_module_vue_vues1` (`mod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `npro_nom_produit`
--

DROP TABLE IF EXISTS `npro_nom_produit`;
CREATE TABLE IF NOT EXISTS `npro_nom_produit` (
  `npro_id` int(11) NOT NULL AUTO_INCREMENT,
  `npro_nom` varchar(50) NOT NULL,
  `npro_description` text NOT NULL,
  `npro_id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`npro_id`),
  KEY `fk_npro_nom_produit_cpro_categorie_produit1` (`npro_id_categorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ope_operation`
--

DROP TABLE IF EXISTS `ope_operation`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pro_produit`
--

DROP TABLE IF EXISTS `pro_produit`;
CREATE TABLE IF NOT EXISTS `pro_produit` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id_commande` int(11) NOT NULL,
  `pro_id_nom_produit` int(11) NOT NULL,
  `pro_unite_mesure` varchar(20) NOT NULL,
  `pro_max_produit_commande` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `fk_pro_produit_npro_nom_produit1` (`pro_id_nom_produit`),
  KEY `fk_pro_produit_com_id_commande1` (`pro_id_commande`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sto_stock`
--

DROP TABLE IF EXISTS `sto_stock`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tpp_type_paiement`
--

DROP TABLE IF EXISTS `tpp_type_paiement`;
CREATE TABLE IF NOT EXISTS `tpp_type_paiement` (
  `tpp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tpp_type` varchar(100) NOT NULL,
  `tpp_champ_complementaire` tinyint(4) NOT NULL,
  `tpp_label_champ_complementaire` varchar(30) NOT NULL,
  PRIMARY KEY (`tpp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_adherent`
--
DROP VIEW IF EXISTS `view_adherent`;
CREATE TABLE IF NOT EXISTS `view_adherent` (
`adh_id` int(11)
,`adh_numero` varchar(5)
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
DROP VIEW IF EXISTS `view_commande_complete_archive`;
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
DROP VIEW IF EXISTS `view_commande_complete_en_cours`;
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
-- Doublure de structure pour la vue `view_gestion_liste_commande_archive`
--
DROP VIEW IF EXISTS `view_gestion_liste_commande_archive`;
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
DROP VIEW IF EXISTS `view_gestion_liste_commande_en_cours`;
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
DROP VIEW IF EXISTS `view_identification`;
CREATE TABLE IF NOT EXISTS `view_identification` (
`adh_id` int(11)
,`adh_id_compte` int(11)
,`adh_numero` varchar(5)
,`adh_mot_passe` varchar(100)
,`mod_nom` varchar(50)
,`adh_super_zeybu` tinyint(1)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_adherent`
--
DROP VIEW IF EXISTS `view_liste_adherent`;
CREATE TABLE IF NOT EXISTS `view_liste_adherent` (
`adh_id` int(11)
,`adh_numero` varchar(5)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
,`adh_courriel_principal` varchar(100)
,`ope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_adherent_commande`
--
DROP VIEW IF EXISTS `view_liste_adherent_commande`;
CREATE TABLE IF NOT EXISTS `view_liste_adherent_commande` (
`com_id` int(11)
,`com_numero` int(11)
,`adh_id` int(11)
,`adh_numero` varchar(5)
,`cpt_label` varchar(30)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_adherent_commande_reservation`
--
DROP VIEW IF EXISTS `view_liste_adherent_commande_reservation`;
CREATE TABLE IF NOT EXISTS `view_liste_adherent_commande_reservation` (
`com_id` int(11)
,`com_numero` int(11)
,`adh_id` int(11)
,`adh_numero` varchar(5)
,`cpt_label` varchar(30)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_commande_archive`
--
DROP VIEW IF EXISTS `view_liste_commande_archive`;
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
DROP VIEW IF EXISTS `view_liste_commande_en_cours`;
CREATE TABLE IF NOT EXISTS `view_liste_commande_en_cours` (
`com_id` int(11)
,`com_numero` int(11)
,`com_date_fin_reservation` datetime
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_reservation_archive`
--
DROP VIEW IF EXISTS `view_liste_reservation_archive`;
CREATE TABLE IF NOT EXISTS `view_liste_reservation_archive` (
`adh_id` int(11)
,`adh_numero` varchar(5)
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
DROP VIEW IF EXISTS `view_liste_reservation_en_cours`;
CREATE TABLE IF NOT EXISTS `view_liste_reservation_en_cours` (
`adh_id` int(11)
,`adh_numero` varchar(5)
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
DROP VIEW IF EXISTS `view_menu`;
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
-- Doublure de structure pour la vue `view_operation_avenir`
--
DROP VIEW IF EXISTS `view_operation_avenir`;
CREATE TABLE IF NOT EXISTS `view_operation_avenir` (
`adh_id` int(11)
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
-- Doublure de structure pour la vue `view_operation_passee`
--
DROP VIEW IF EXISTS `view_operation_passee`;
CREATE TABLE IF NOT EXISTS `view_operation_passee` (
`adh_id` int(11)
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
-- Doublure de structure pour la vue `view_reservation`
--
DROP VIEW IF EXISTS `view_reservation`;
CREATE TABLE IF NOT EXISTS `view_reservation` (
`com_id` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`sto_quantite` decimal(10,2)
,`sto_type` tinyint(1)
,`sto_id_compte` int(11)
,`dcom_id` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_produit`
--
DROP VIEW IF EXISTS `view_stock_produit`;
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
DROP VIEW IF EXISTS `view_stock_produit_initiaux`;
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
-- Structure de la table `vue_vues`
--

DROP TABLE IF EXISTS `vue_vues`;
CREATE TABLE IF NOT EXISTS `vue_vues` (
  `vue_id` int(11) NOT NULL AUTO_INCREMENT,
  `vue_id_module` int(11) NOT NULL,
  `vue_nom` varchar(50) NOT NULL,
  `vue_label` varchar(80) NOT NULL,
  `vue_ordre` int(11) NOT NULL,
  PRIMARY KEY (`vue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

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

CREATE VIEW `view_commande_complete_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`com_commande`.`com_archive` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_commande_complete_en_cours`
--
DROP TABLE IF EXISTS `view_commande_complete_en_cours`;

CREATE VIEW `view_commande_complete_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`com_commande`.`com_archive` = 0);

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
-- Structure de la vue `view_operation_avenir`
--
DROP TABLE IF EXISTS `view_operation_avenir`;

CREATE VIEW `view_operation_avenir` AS select `adh_adherent`.`adh_id` AS `adh_id`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` from (((`adh_adherent` left join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) left join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`ope_operation`.`ope_type` = 0) and (`adh_adherent`.`adh_super_zeybu` = 0) and (`com_commande`.`com_archive` = 0)) order by `com_commande`.`com_date_marche_debut`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_passee`
--
DROP TABLE IF EXISTS `view_operation_passee`;

CREATE VIEW `view_operation_passee` AS select `adh_adherent`.`adh_id` AS `adh_id`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` from ((`adh_adherent` left join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) where ((`ope_operation`.`ope_type` = 1) and (`adh_adherent`.`adh_super_zeybu` = 0)) order by `ope_operation`.`ope_date` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `view_reservation`
--
DROP TABLE IF EXISTS `view_reservation`;

CREATE VIEW `view_reservation` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`sto_stock`.`sto_type` AS `sto_type`,`sto_stock`.`sto_id_compte` AS `sto_id_compte`,`dcom_detail_commande`.`dcom_id` AS `dcom_id` from (((`com_commande` join `pro_produit` on((`com_commande`.`com_id` = `pro_produit`.`pro_id_commande`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`dcom_detail_commande`.`dcom_id` = `sto_stock`.`sto_id_detail_commande`))) where ((`sto_stock`.`sto_type` = 0) and (`sto_stock`.`sto_id_compte` <> 0));

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_produit`
--
DROP TABLE IF EXISTS `view_stock_produit`;

CREATE VIEW `view_stock_produit` AS select `pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` from ((`pro_produit` join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_produit_initiaux`
--
DROP TABLE IF EXISTS `view_stock_produit_initiaux`;

CREATE VIEW `view_stock_produit_initiaux` AS select `sto_stock`.`sto_id` AS `sto_id`,`sto_stock`.`sto_date` AS `sto_date`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`sto_stock`.`sto_type` AS `sto_type`,`sto_stock`.`sto_id_commande` AS `sto_id_commande`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit` from (`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where (`sto_stock`.`sto_id_compte` = 0);

-- Donnees ------------------------------------------------


--
-- Contenu de la table `tpp_type_paiement`
--

INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`) VALUES
(1, 'Espèces', 0, ''),
(2, 'Chèque', 1, 'Numéro');

--
-- Contenu de la table `vue_vues`
--

INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`) VALUES
(1, 1, 'MonCompte', 'Mon Compte', 1),
(2, 2, 'ListeAdherent', 'Liste des Adhérents', 2),
(3, 2, 'AjoutAdherent', 'Ajouter un Adhérent', 1),
(4, 3, 'ListeCommande', 'Marché', 1),
(5, 4, 'AjoutCommande', 'Créer un Marché', 1),
(6, 4, 'ListeCommande', 'Liste des Marchés', 2),
(8, 1, 'MesCommandes', 'Mes Commandes', 2);

--
-- Contenu de la table `mod_module`
--

INSERT INTO `mod_module` (`mod_id`, `mod_nom`, `mod_label`, `mod_defaut`, `mod_ordre`, `mod_admin`) VALUES
(1, 'MonCompte', 'Compte', 1, 1, 0),
(2, 'GestionAdherents', 'Gestion des Adherents', 0, 3, 1),
(3, 'Commande', 'Marché', 1, 2, 0),
(4, 'GestionCommande', 'Gestion des Marchés', 0, 4, 1);

--
-- Contenu de la table `adh_adherent`
--

INSERT INTO `adh_adherent` (`adh_id`, `adh_mot_passe`, `adh_numero`, `adh_id_compte`, `adh_nom`, `adh_prenom`, `adh_courriel_principal`, `adh_courriel_secondaire`, `adh_telephone_principal`, `adh_telephone_secondaire`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_date_naissance`, `adh_date_adhesion`, `adh_date_maj`, `adh_commentaire`, `adh_etat`, `adh_super_zeybu`) VALUES
(0, '01f01083386dc09d99826461b2b6c6f1', 'julien', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1);
COMMIT;

