-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 12 Août 2011 à 22:59
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.2-1ubuntu4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `zeybu`
--

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
  `cpt_solde` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cpt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Contenu de la table `cpt_compte`
--

INSERT INTO `cpt_compte` (`cpt_id`, `cpt_label`, `cpt_solde`) VALUES
(-1, 'ZEYBU', '0'),
(-2, 'EAU', '0');

-- --------------------------------------------------------

--
-- Structure de la table `ide_identification`
--

CREATE TABLE IF NOT EXISTS `ide_identification` (
  `ide_id` int(11) NOT NULL AUTO_INCREMENT,
  `ide_id_login` int(11) NOT NULL,
  `ide_login` varchar(20) NOT NULL,
  `ide_pass` varchar(100) NOT NULL,
  `ide_type` int(11) NOT NULL,
  `ide_autorise` tinyint(1) NOT NULL,
  PRIMARY KEY (`ide_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ide_identification`
--

INSERT INTO `ide_identification` (`ide_id`, `ide_id_login`, `ide_login`, `ide_pass`, `ide_type`, `ide_autorise`) VALUES
(1, 0, 'julien', '01f01083386dc09d99826461b2b6c6f1', 2, 1),
(2, 0, 'vente','01f01083386dc09d99826461b2b6c6f1', 3, 1),
(3, 0, 'EAU','01f01083386dc09d99826461b2b6c6f1', 4, 1);

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
  `mod_visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`mod_id`),
  KEY `fk_mod_module_vue_vues1` (`mod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `mod_module`
--

INSERT INTO `mod_module` (`mod_id`, `mod_nom`, `mod_label`, `mod_defaut`, `mod_ordre`, `mod_admin`, `mod_visible`) VALUES
(1, 'MonCompte', 'Compte', 1, 1, 0, 1),
(2, 'GestionAdherents', 'Gestion des Adherents', 0, 4, 1, 1),
(3, 'Commande', 'Marché', 1, 2, 0, 1),
(4, 'GestionCommande', 'Gestion des Marchés', 0, 3, 1, 1),
(5, 'GestionProducteur', 'Gestion des Producteurs', 0, 5, 1, 1),
(6, 'CompteZeybu', 'Le Compte du Zeybu', 0, 6, 1, 1),
(7, 'RechargementCompte', 'Recharger un compte', 0, 7, 1, 1),
(8, 'GestionCaisse', 'Gérer la caisse', 0, 8, 1, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `tpp_type_paiement`
--

INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES
(0, 'Réservation', 0, '', 0),
(1, 'Espèces', 0, '', 1),
(2, 'Chèque', 1, 'Numéro', 1),
(3, 'Virement', 1, 'Id operation reception', 0),
(4, 'Virement', 1, 'Id operation émission', 0),
(5, 'Bon de Commande', 1, 'Id produit', 0),
(6, 'Bon de Livraison', 1, 'Id info operation livraison', 0),
(7, 'Achat', 1, 'Id operation soeur', 0),
(8, 'Achat Solidaire', 1, 'Id operation soeur', 0),
(9, 'Virement Solidaire', 1, 'Id operation reception', 0),
(10, 'Virement Solidaire', 1, 'Id operation émission', 0),
(11, 'Annulation Virement (émission)', 1, 'Id operation reception', 0),
(12, 'Annulation Virement (réception)', 1, 'Id operation émission', 0),
(14, 'Annulation Virement Solidaire (réception)', 1, 'Id operation émission', 0),
(13, 'Annulation Virement Solidaire (émission)', 1, 'Id operation reception', 0),
(15, 'Réservation non récupérée', 0, '', 0),
(16, 'Annulation réservation', 0, '', 0);

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
  `vue_visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`vue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `vue_vues`
--

INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES
(1, 1, 'MonCompte', 'Mon Compte', 1, 1),
(2, 2, 'ListeAdherent', 'Liste des Adhérents', 2, 1),
(3, 2, 'AjoutAdherent', 'Ajouter un Adhérent', 1, 1),
(4, 3, 'ListeCommande', 'Marché', 2, 1),
(5, 4, 'AjoutCommande', 'Créer un Marché', 1, 1),
(6, 4, 'ListeCommande', 'Liste des Marchés', 2, 1),
(8, 3, 'MesCommandes', 'Mes Commandes', 1, 1),
(9, 5, 'AjoutProducteur', 'Ajouter un Producteur', 1, 1),
(10, 5, 'ListeProducteur', 'Liste des Producteurs', 2, 1),
(11, 6, 'CompteZeybu', 'Le Compte du Zeybu', 1, 1),
(12, 7, 'RechargerCompte', 'Recharger un compte', 1, 1),
(13, 8, 'GestionCaisse', 'Gérer les accès à la caisse', 1, 1),
(14, 6, 'Virements', 'Émettre un virement', 2, 1),
(15, 6, 'ListeVirement', 'Liste des Virements', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `acc_acces`
--

CREATE TABLE IF NOT EXISTS `acc_acces` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id_login` int(11) NOT NULL,
  `acc_type_login` int(11) NOT NULL,
  `acc_ip` varchar(40) NOT NULL,
  `acc_date_creation` datetime NOT NULL,
  `acc_date_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acc_autorise` int(11) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `adh_adherent`
--

CREATE TABLE IF NOT EXISTS `adh_adherent` (
  `adh_id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`adh_id`),
  KEY `fk_adh_adherent_aut_autorisation1` (`adh_id`),
  KEY `fk_adh_adherent_ope_operation1` (`adh_id`),
  KEY `fk_adh_adherent_cpt_compte1` (`adh_id_compte`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `dcom_detail_commande`
--

CREATE TABLE IF NOT EXISTS `dcom_detail_commande` (
  `dcom_id` int(11) NOT NULL AUTO_INCREMENT,
  `dcom_id_produit` int(11) NOT NULL,
  `dcom_taille` decimal(10,2) NOT NULL,
  `dcom_prix` decimal(10,2) NOT NULL,
  `dcom_etat` int(11) NOT NULL,
  PRIMARY KEY (`dcom_id`),
  KEY `fk_lot_lot_produit_pro_produit1` (`dcom_id_produit`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `dope_detail_operation`
--

CREATE TABLE IF NOT EXISTS `dope_detail_operation` (
  `dope_id` int(11) NOT NULL AUTO_INCREMENT,
  `dope_id_operation` int(11) NOT NULL,
  `dope_id_compte` int(11) NOT NULL,
  `dope_montant` decimal(10,2) NOT NULL,
  `dope_libelle` varchar(100) NOT NULL,
  `dope_date` datetime NOT NULL,
  `dope_type_paiement` int(11) NOT NULL,
  `dope_type_paiement_champ_complementaire` varchar(50) NOT NULL,
  `dope_id_detail_commande` int(11) NOT NULL,
  `dope_id_connexion` int(11) NOT NULL,
  PRIMARY KEY (`dope_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `hdope_historique_detail_operation`
--

CREATE TABLE IF NOT EXISTS `hdope_historique_detail_operation` (
  `hdope_id` int(11) NOT NULL AUTO_INCREMENT,
  `hdope_id_detail_operation` int(11) NOT NULL,
  `hdope_id_operation` int(11) NOT NULL,
  `hdope_id_compte` int(11) NOT NULL,
  `hdope_montant` decimal(10,2) NOT NULL,
  `hdope_libelle` varchar(100) NOT NULL,
  `hdope_date` datetime NOT NULL,
  `hdope_type_paiement` int(11) NOT NULL,
  `hdope_type_paiement_champ_complementaire` varchar(50) NOT NULL,
  `hdope_id_detail_commande` int(11) NOT NULL,
  `hdope_id_connexion` int(11) NOT NULL,
  PRIMARY KEY (`hdope_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `hope_historique_operation`
--

CREATE TABLE IF NOT EXISTS `hope_historique_operation` (
  `hope_id` int(11) NOT NULL AUTO_INCREMENT,
  `hope_id_operation` int(11) NOT NULL,
  `hope_id_compte` int(11) NOT NULL,
  `hope_montant` decimal(10,2) NOT NULL,
  `hope_libelle` varchar(100) NOT NULL,
  `hope_date` datetime NOT NULL,
  `hope_type_paiement` int(11) NOT NULL,
  `hope_type_paiement_champ_complementaire` varchar(50) NOT NULL,
  `hope_type` int(11) NOT NULL,
  `hope_id_commande` int(11) NOT NULL,
  `hope_id_connexion` int(11) NOT NULL,
  PRIMARY KEY (`hope_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `hsto_historique_stock`
--

CREATE TABLE IF NOT EXISTS `hsto_historique_stock` (
  `hsto_id` int(11) NOT NULL AUTO_INCREMENT,
  `hsto_sto_id` int(11) NOT NULL,
  `hsto_date` datetime NOT NULL,
  `hsto_quantite` decimal(10,2) NOT NULL,
  `hsto_type` int(11) NOT NULL,
  `hsto_id_compte` int(11) NOT NULL,
  `hsto_id_detail_commande` int(11) NOT NULL,
  `hsto_id_operation` int(11) NOT NULL,
  `hsto_id_connexion` int(11) NOT NULL,
  PRIMARY KEY (`hsto_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `iol_info_operation_livraison`
--

CREATE TABLE IF NOT EXISTS `iol_info_operation_livraison` (
  `iol_id` int(11) NOT NULL AUTO_INCREMENT,
  `iol_id_ope_zeybu` int(11) NOT NULL,
  `iol_id_ope_producteur` int(11) NOT NULL,
  PRIMARY KEY (`iol_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

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
  `pro_id_compte_producteur` int(11) NOT NULL,
  `pro_stock_reservation` decimal(10,2) NOT NULL,
  `pro_stock_initial` decimal(10,2) NOT NULL,
  `pro_etat` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `fk_pro_produit_npro_nom_produit1` (`pro_id_nom_produit`),
  KEY `fk_pro_produit_com_id_commande1` (`pro_id_commande`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

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
  `sto_id_operation` int(11) NOT NULL,
  PRIMARY KEY (`sto_id`),
  KEY `fk_sto_stock_pro_produit1` (`sto_id_detail_commande`),
  KEY `fk_sto_stock_cpt_compte1` (`sto_id_compte`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_achat_detail`
--
CREATE TABLE IF NOT EXISTS `view_achat_detail` (
`sto_id_operation` int(11)
,`sto_id` int(11)
,`dope_id` int(11)
,`sto_id_detail_commande` int(11)
,`dope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`dcom_id_produit` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_achat_detail_solidaire`
--
CREATE TABLE IF NOT EXISTS `view_achat_detail_solidaire` (
`sto_id_operation` int(11)
,`sto_id` int(11)
,`dope_id` int(11)
,`sto_id_detail_commande` int(11)
,`dope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`dcom_id_produit` int(11)
);
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
,`cpt_solde` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_compte_solidaire_liste_adherent`
--
CREATE TABLE IF NOT EXISTS `view_compte_solidaire_liste_adherent` (
`adh_id` int(11)
,`adh_numero` varchar(20)
,`cpt_label` varchar(30)
,`adh_nom` varchar(50)
,`adh_prenom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_compte_solidaire_operation`
--
CREATE TABLE IF NOT EXISTS `view_compte_solidaire_operation` (
`ope_id` int(11)
,`ope_date` datetime
,`cpt_label` varchar(30)
,`ope_montant` decimal(10,2)
,`ope_type_paiement` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_compte_zeybu_liste_virement`
--
CREATE TABLE IF NOT EXISTS `view_compte_zeybu_liste_virement` (
`ope_id` int(11)
,`ope_date` datetime
,`cpt_label` varchar(30)
,`ope_montant` decimal(10,2)
,`ope_type_paiement` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_detail_marche`
--
CREATE TABLE IF NOT EXISTS `view_detail_marche` (
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
,`pro_id_compte_producteur` int(11)
,`pro_stock_reservation` decimal(10,2)
,`pro_stock_initial` decimal(10,2)
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
-- Doublure de structure pour la vue `view_gestion_commande_liste_reservation`
--
CREATE TABLE IF NOT EXISTS `view_gestion_commande_liste_reservation` (
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
-- Doublure de structure pour la vue `view_gestion_commande_reservation_producteur`
--
CREATE TABLE IF NOT EXISTS `view_gestion_commande_reservation_producteur` (
`pro_id_commande` int(11)
,`pro_id_compte_producteur` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
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
,`mod_nom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_info_achat`
--
CREATE TABLE IF NOT EXISTS `view_info_achat` (
`pro_id_commande` int(11)
,`pro_id_compte_producteur` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`dcom_id` int(11)
,`sto_quantite` decimal(32,2)
,`dope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_info_achat_solidaire`
--
CREATE TABLE IF NOT EXISTS `view_info_achat_solidaire` (
`pro_id_commande` int(11)
,`pro_id_compte_producteur` int(11)
,`pro_id` int(11)
,`sto_id` int(11)
,`dcom_id` int(11)
,`sto_quantite` decimal(32,2)
,`dope_montant` decimal(32,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_info_bon_commande`
--
CREATE TABLE IF NOT EXISTS `view_info_bon_commande` (
`pro_id_commande` int(11)
,`pro_id_compte_producteur` int(11)
,`pro_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`dope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`prdt_nom` varchar(50)
,`prdt_prenom` varchar(50)
,`dope_id` int(11)
,`sto_id` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_info_bon_livraison`
--
CREATE TABLE IF NOT EXISTS `view_info_bon_livraison` (
`pro_id_commande` int(11)
,`pro_id_compte_producteur` int(11)
,`pro_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`dope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`prdt_nom` varchar(50)
,`prdt_prenom` varchar(50)
,`dope_id` int(11)
,`sto_id` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_info_commande`
--
CREATE TABLE IF NOT EXISTS `view_info_commande` (
`com_id` int(11)
,`pro_id_compte_producteur` int(11)
,`pro_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`dope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`dope_montant_livraison` decimal(10,2)
,`sto_quantite_livraison` decimal(10,2)
,`sto_quantite_solidaire` decimal(10,2)
,`sto_quantite_vente` decimal(33,2)
,`sto_quantite_vente_solidaire` decimal(33,2)
,`dope_montant_vente` decimal(33,2)
,`dope_montant_vente_solidaire` decimal(33,2)
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
,`cpt_solde` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_producteur_marche`
--
CREATE TABLE IF NOT EXISTS `view_liste_producteur_marche` (
`pro_id_commande` int(11)
,`prdt_id_compte` int(11)
,`prdt_nom` varchar(50)
,`prdt_prenom` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_marche_liste_reservation`
--
CREATE TABLE IF NOT EXISTS `view_marche_liste_reservation` (
`ope_id_compte` int(11)
,`com_id` int(11)
,`com_numero` int(11)
,`com_nom` varchar(100)
,`com_date_fin_reservation` datetime
,`com_date_marche_debut` datetime
,`com_date_marche_fin` datetime
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_menu`
--
CREATE TABLE IF NOT EXISTS `view_menu` (
`adh_id` int(11)
,`mod_id` int(11)
,`mod_nom` varchar(50)
,`mod_label` varchar(80)
,`mod_admin` tinyint(1)
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
-- Doublure de structure pour la vue `view_reservation_detail`
--
CREATE TABLE IF NOT EXISTS `view_reservation_detail` (
`sto_id_operation` int(11)
,`sto_id` int(11)
,`dope_id` int(11)
,`sto_id_detail_commande` int(11)
,`dope_montant` decimal(10,2)
,`sto_quantite` decimal(10,2)
,`dcom_id_produit` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_produit_reservation`
--
CREATE TABLE IF NOT EXISTS `view_stock_produit_reservation` (
`pro_id_commande` int(11)
,`pro_id_compte_producteur` int(11)
,`pro_id` int(11)
,`pro_unite_mesure` varchar(20)
,`npro_nom` varchar(50)
,`sto_quantite` decimal(11,2)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_stock_solidaire`
--
CREATE TABLE IF NOT EXISTS `view_stock_solidaire` (
`pro_id_commande` int(11)
,`pro_id_compte_producteur` int(11)
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
-- Structure de la vue `view_achat_detail`
--
DROP TABLE IF EXISTS `view_achat_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_achat_detail` AS select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where ((`sto_stock`.`sto_type` = 1) and (`dope_detail_operation`.`dope_type_paiement` = 7)) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_achat_detail_solidaire`
--
DROP TABLE IF EXISTS `view_achat_detail_solidaire`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_achat_detail_solidaire` AS select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where ((`sto_stock`.`sto_type` = 2) and (`dope_detail_operation`.`dope_type_paiement` = 8)) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_adherent`
--
DROP TABLE IF EXISTS `view_adherent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_adherent` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,`adh_adherent`.`adh_courriel_secondaire` AS `adh_courriel_secondaire`,`adh_adherent`.`adh_telephone_principal` AS `adh_telephone_principal`,`adh_adherent`.`adh_telephone_secondaire` AS `adh_telephone_secondaire`,`adh_adherent`.`adh_adresse` AS `adh_adresse`,`adh_adherent`.`adh_code_postal` AS `adh_code_postal`,`adh_adherent`.`adh_ville` AS `adh_ville`,`adh_adherent`.`adh_date_naissance` AS `adh_date_naissance`,`adh_adherent`.`adh_date_adhesion` AS `adh_date_adhesion`,`adh_adherent`.`adh_date_maj` AS `adh_date_maj`,`adh_adherent`.`adh_commentaire` AS `adh_commentaire`,`cpt_compte`.`cpt_solde` AS `cpt_solde`,`adh_adherent`.`adh_etat` AS `adh_etat` from (`adh_adherent` left join `cpt_compte` on((`cpt_compte`.`cpt_id` = `adh_adherent`.`adh_id_compte`)));

-- --------------------------------------------------------

--
-- Structure de la vue `view_compte_solidaire_liste_adherent`
--
DROP TABLE IF EXISTS `view_compte_solidaire_liste_adherent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_compte_solidaire_liste_adherent` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom` from (`adh_adherent` join `cpt_compte` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) where (`adh_adherent`.`adh_etat` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_compte_solidaire_operation`
--
DROP TABLE IF EXISTS `view_compte_solidaire_operation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_compte_solidaire_operation` AS select `ope1`.`ope_id` AS `ope_id`,`ope1`.`ope_date` AS `ope_date`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope1`.`ope_montant` AS `ope_montant`,`ope1`.`ope_type_paiement` AS `ope_type_paiement` from ((`ope_operation` `ope1` left join `ope_operation` `ope2` on((`ope1`.`ope_type_paiement_champ_complementaire` = `ope2`.`ope_id`))) left join `cpt_compte` on((`ope2`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) where ((`ope1`.`ope_id_compte` = '-2') and (`ope1`.`ope_type` = 1) and (`ope1`.`ope_type_paiement` in (3,4,9,10))) order by `ope1`.`ope_date` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `view_compte_zeybu_liste_virement`
--
DROP TABLE IF EXISTS `view_compte_zeybu_liste_virement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_compte_zeybu_liste_virement` AS select `ope1`.`ope_id` AS `ope_id`,`ope1`.`ope_date` AS `ope_date`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope1`.`ope_montant` AS `ope_montant`,`ope1`.`ope_type_paiement` AS `ope_type_paiement` from ((`ope_operation` `ope1` left join `ope_operation` `ope2` on((`ope1`.`ope_type_paiement_champ_complementaire` = `ope2`.`ope_id`))) left join `cpt_compte` on((`ope2`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) where ((`ope1`.`ope_id_compte` = '-1') and (`ope1`.`ope_type_paiement` in (3,4,9,10))) order by `ope1`.`ope_date` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `view_detail_marche`
--
DROP TABLE IF EXISTS `view_detail_marche`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_marche` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_stock_reservation` AS `pro_stock_reservation`,`pro_produit`.`pro_stock_initial` AS `pro_stock_initial`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where ((`pro_produit`.`pro_etat` = 0) and (`dcom_detail_commande`.`dcom_etat` = 0));

-- --------------------------------------------------------

--
-- Structure de la vue `view_gestion_commande_liste_reservation`
--
DROP TABLE IF EXISTS `view_gestion_commande_liste_reservation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_gestion_commande_liste_reservation` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom` from (((`ope_operation` join `cpt_compte` on((`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`com_commande`.`com_archive` in (0,1)) and (`ope_operation`.`ope_type_paiement` = 0));

-- --------------------------------------------------------

--
-- Structure de la vue `view_gestion_commande_reservation_producteur`
--
DROP TABLE IF EXISTS `view_gestion_commande_reservation_producteur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_gestion_commande_reservation_producteur` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id` from ((`pro_produit` join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on(((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`) and (`sto_stock`.`sto_id_compte` = `pro_produit`.`pro_id_compte_producteur`)))) where (`sto_stock`.`sto_type` = 0);

-- --------------------------------------------------------

--
-- Structure de la vue `view_gestion_liste_commande_archive`
--
DROP TABLE IF EXISTS `view_gestion_liste_commande_archive`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_gestion_liste_commande_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` = 2);

-- --------------------------------------------------------

--
-- Structure de la vue `view_gestion_liste_commande_en_cours`
--
DROP TABLE IF EXISTS `view_gestion_liste_commande_en_cours`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_gestion_liste_commande_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` in (0,1)) order by `com_commande`.`com_date_marche_debut`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_identification`
--
DROP TABLE IF EXISTS `view_identification`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_identification` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`mod_module`.`mod_nom` AS `mod_nom` from (((`adh_adherent` join `ide_identification` on((`adh_adherent`.`adh_id` = `ide_identification`.`ide_id_login`))) left join `aut_autorisation` on((`adh_adherent`.`adh_id` = `aut_autorisation`.`aut_id_adherent`))) left join `mod_module` on((`aut_autorisation`.`aut_id_module` = `mod_module`.`mod_id`))) where (`adh_adherent`.`adh_etat` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_info_achat`
--
DROP TABLE IF EXISTS `view_info_achat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_info_achat` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite`,sum(`dope_detail_operation`.`dope_montant`) AS `dope_montant` from (((`pro_produit` join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`sto_stock`.`sto_type` = 1) and (`sto_stock`.`sto_quantite` < 0) and (`dope_detail_operation`.`dope_type_paiement` = 7) and (`dope_detail_operation`.`dope_montant` < 0)) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_info_achat_solidaire`
--
DROP TABLE IF EXISTS `view_info_achat_solidaire`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_info_achat_solidaire` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite`,sum(`dope_detail_operation`.`dope_montant`) AS `dope_montant` from (((`pro_produit` join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`sto_stock`.`sto_type` = 2) and (`sto_stock`.`sto_quantite` < 0) and (`dope_detail_operation`.`dope_type_paiement` = 8) and (`dope_detail_operation`.`dope_montant` < 0)) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_info_bon_commande`
--
DROP TABLE IF EXISTS `view_info_bon_commande`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_info_bon_commande` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id` AS `sto_id` from (((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `prdt_producteur` on((`prdt_producteur`.`prdt_id_compte` = `pro_produit`.`pro_id_compte_producteur`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`dope_detail_operation`.`dope_type_paiement` = 5) and (`sto_stock`.`sto_type` = 3)) group by `pro_produit`.`pro_id_commande`,`pro_produit`.`pro_id`,`pro_produit`.`pro_id_compte_producteur`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_info_bon_livraison`
--
DROP TABLE IF EXISTS `view_info_bon_livraison`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_info_bon_livraison` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id` AS `sto_id` from (((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `prdt_producteur` on((`prdt_producteur`.`prdt_id_compte` = `pro_produit`.`pro_id_compte_producteur`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`dope_detail_operation`.`dope_type_paiement` = 6) and (`sto_stock`.`sto_type` = 4)) group by `pro_produit`.`pro_id_commande`,`pro_produit`.`pro_id`,`pro_produit`.`pro_id_compte_producteur`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_info_commande`
--
DROP TABLE IF EXISTS `view_info_commande`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_info_commande` AS select `pro_produit`.`pro_id_commande` AS `com_id`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`view_info_bon_commande`.`dope_montant` AS `dope_montant`,`view_info_bon_commande`.`sto_quantite` AS `sto_quantite`,`view_info_bon_livraison`.`dope_montant` AS `dope_montant_livraison`,`view_info_bon_livraison`.`sto_quantite` AS `sto_quantite_livraison`,`view_stock_solidaire`.`sto_quantite` AS `sto_quantite_solidaire`,(`view_info_achat`.`sto_quantite` * -(1)) AS `sto_quantite_vente`,(`view_info_achat_solidaire`.`sto_quantite` * -(1)) AS `sto_quantite_vente_solidaire`,(`view_info_achat`.`dope_montant` * -(1)) AS `dope_montant_vente`,(`view_info_achat_solidaire`.`dope_montant` * -(1)) AS `dope_montant_vente_solidaire` from ((((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) left join `view_info_bon_commande` on((`view_info_bon_commande`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_info_bon_livraison` on((`view_info_bon_livraison`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_solidaire` on((`view_stock_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_info_achat` on((`view_info_achat`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_info_achat_solidaire` on((`view_info_achat_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) where (`pro_produit`.`pro_etat` = 0) group by `pro_produit`.`pro_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_adherent`
--
DROP TABLE IF EXISTS `view_liste_adherent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_adherent` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,`cpt_compte`.`cpt_solde` AS `cpt_solde`,`cpt_compte`.`cpt_label` AS `cpt_label` from (`adh_adherent` left join `cpt_compte` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) where (`adh_adherent`.`adh_etat` = 1);

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_producteur_marche`
--
DROP TABLE IF EXISTS `view_liste_producteur_marche`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_producteur_marche` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`prdt_producteur`.`prdt_id_compte` AS `prdt_id_compte`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom` from (`pro_produit` join `prdt_producteur` on((`prdt_producteur`.`prdt_id_compte` = `pro_produit`.`pro_id_compte_producteur`))) where (`pro_produit`.`pro_etat` = 0) group by `pro_produit`.`pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` order by `prdt_producteur`.`prdt_nom`,`prdt_producteur`.`prdt_prenom`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_marche_liste_reservation`
--
DROP TABLE IF EXISTS `view_marche_liste_reservation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_marche_liste_reservation` AS select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from (`com_commande` left join `ope_operation` on((`ope_operation`.`ope_id_commande` = `com_commande`.`com_id`))) where ((`com_commande`.`com_date_fin_reservation` >= now()) and (`com_commande`.`com_archive` = 0) and (`ope_operation`.`ope_type_paiement` = 0));

-- --------------------------------------------------------

--
-- Structure de la vue `view_menu`
--
DROP TABLE IF EXISTS `view_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_menu` AS select `adh_adherent`.`adh_id` AS `adh_id`,`mod_module`.`mod_id` AS `mod_id`,`mod_module`.`mod_nom` AS `mod_nom`,`mod_module`.`mod_label` AS `mod_label`,`mod_module`.`mod_admin` AS `mod_admin` from ((`adh_adherent` left join `aut_autorisation` on((`adh_adherent`.`adh_id` = `aut_autorisation`.`aut_id_adherent`))) left join `mod_module` on((`aut_autorisation`.`aut_id_module` = `mod_module`.`mod_id`))) where (`adh_adherent`.`adh_etat` = 1) order by `mod_module`.`mod_ordre`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_avenir`
--
DROP TABLE IF EXISTS `view_operation_avenir`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_operation_avenir` AS select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut` from (`ope_operation` left join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`ope_operation`.`ope_type_paiement` = 0) and (`com_commande`.`com_archive` = 0)) order by `com_commande`.`com_date_marche_debut`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_operation_passee`
--
DROP TABLE IF EXISTS `view_operation_passee`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_operation_passee` AS select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` from ((`ope_operation` join `cpt_compte` on((`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) where (`ope_operation`.`ope_type_paiement` in (-(1),1,2,3,4,7,8,9,10)) order by `ope_operation`.`ope_date` desc;

-- --------------------------------------------------------

--
-- Structure de la vue `view_producteur`
--
DROP TABLE IF EXISTS `view_producteur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_producteur` AS select `prdt_producteur`.`prdt_id` AS `prdt_id`,`prdt_producteur`.`prdt_numero` AS `prdt_numero`,`prdt_producteur`.`prdt_id_compte` AS `prdt_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,`prdt_producteur`.`prdt_courriel_principal` AS `prdt_courriel_principal`,`prdt_producteur`.`prdt_courriel_secondaire` AS `prdt_courriel_secondaire`,`prdt_producteur`.`prdt_telephone_principal` AS `prdt_telephone_principal`,`prdt_producteur`.`prdt_telephone_secondaire` AS `prdt_telephone_secondaire`,`prdt_producteur`.`prdt_adresse` AS `prdt_adresse`,`prdt_producteur`.`prdt_code_postal` AS `prdt_code_postal`,`prdt_producteur`.`prdt_ville` AS `prdt_ville`,`prdt_producteur`.`prdt_date_naissance` AS `prdt_date_naissance`,`prdt_producteur`.`prdt_date_creation` AS `prdt_date_creation`,`prdt_producteur`.`prdt_date_maj` AS `prdt_date_maj`,`prdt_producteur`.`prdt_commentaire` AS `prdt_commentaire`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`prdt_producteur` left join `ope_operation` on((`prdt_producteur`.`prdt_id_compte` = `ope_operation`.`ope_id_compte`))) left join `cpt_compte` on((`cpt_compte`.`cpt_id` = `prdt_producteur`.`prdt_id_compte`))) where ((`ope_operation`.`ope_type` = 1) and (`prdt_producteur`.`prdt_etat` = 1)) group by `prdt_producteur`.`prdt_id`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_reservation`
--
DROP TABLE IF EXISTS `view_reservation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_reservation` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`sto_stock`.`sto_type` AS `sto_type`,`sto_stock`.`sto_id_compte` AS `sto_id_compte`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cpt_compte`.`cpt_label` AS `cpt_label` from ((((((`com_commande` join `pro_produit` on((`com_commande`.`com_id` = `pro_produit`.`pro_id_commande`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`dcom_detail_commande`.`dcom_id` = `sto_stock`.`sto_id_detail_commande`))) join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `sto_stock`.`sto_id_compte`))) join `ope_operation` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) join `cpt_compte` on(((`cpt_compte`.`cpt_id` = `sto_stock`.`sto_id_compte`) and (`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`)))) where ((`sto_stock`.`sto_type` = 0) and (`sto_stock`.`sto_id_compte` <> 0) and (`com_commande`.`com_archive` in (0,1)) and (`ope_operation`.`ope_type_paiement` = 0));


-- --------------------------------------------------------

--
-- Structure de la vue `view_reservation_detail`
--
DROP TABLE IF EXISTS `view_reservation_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_reservation_detail` AS select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where (`sto_stock`.`sto_type` in (0,5,6)) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_produit_reservation`
--
DROP TABLE IF EXISTS `view_stock_produit_reservation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_produit_reservation` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,(`pro_produit`.`pro_stock_initial` - `pro_produit`.`pro_stock_reservation`) AS `sto_quantite` from (`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) where (`pro_produit`.`pro_etat` = 0);

-- --------------------------------------------------------

--
-- Structure de la vue `view_stock_solidaire`
--
DROP TABLE IF EXISTS `view_stock_solidaire`;

CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_solidaire` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`sto_stock`.`sto_quantite` AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`sto_stock`.`sto_type` = 2);

-- --------------------------------------------------------

--
-- Structure de la vue `view_type_paiement_visible`
--
DROP TABLE IF EXISTS `view_type_paiement_visible`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_type_paiement_visible` AS select `tpp_type_paiement`.`tpp_id` AS `tpp_id`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`tpp_type_paiement`.`tpp_visible` AS `tpp_visible` from `tpp_type_paiement` where (`tpp_type_paiement`.`tpp_visible` = 1);
