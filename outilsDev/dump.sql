-- ----------------------
-- dump de la base zeybu au 13-Jun-2011
-- ----------------------


-- -----------------------------
-- creation de la table adh_adherent
-- -----------------------------
CREATE TABLE `adh_adherent` (
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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table aut_autorisation
-- -----------------------------
CREATE TABLE `aut_autorisation` (
  `aut_id` int(11) NOT NULL AUTO_INCREMENT,
  `aut_id_adherent` int(11) NOT NULL,
  `aut_id_module` int(11) NOT NULL,
  PRIMARY KEY (`aut_id`),
  KEY `fk_aut_autorisation_mod_module` (`aut_id_module`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table com_commande
-- -----------------------------
CREATE TABLE `com_commande` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_numero` int(11) NOT NULL,
  `com_nom` varchar(100) NOT NULL,
  `com_description` text NOT NULL,
  `com_date_marche_debut` datetime NOT NULL,
  `com_date_marche_fin` datetime NOT NULL,
  `com_date_fin_reservation` datetime NOT NULL,
  `com_archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table cpro_categorie_produit
-- -----------------------------
CREATE TABLE `cpro_categorie_produit` (
  `cpro_id` int(11) NOT NULL AUTO_INCREMENT,
  `cpro_nom` varchar(50) NOT NULL,
  `cpro_description` text NOT NULL,
  PRIMARY KEY (`cpro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table cpt_compte
-- -----------------------------
CREATE TABLE `cpt_compte` (
  `cpt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cpt_label` varchar(30) NOT NULL,
  PRIMARY KEY (`cpt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table dcom_detail_commande
-- -----------------------------
CREATE TABLE `dcom_detail_commande` (
  `dcom_id` int(11) NOT NULL AUTO_INCREMENT,
  `dcom_id_produit` int(11) NOT NULL,
  `dcom_taille` decimal(10,2) NOT NULL,
  `dcom_prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`dcom_id`),
  KEY `fk_lot_lot_produit_pro_produit1` (`dcom_id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table gpc_groupe_commande
-- -----------------------------
CREATE TABLE `gpc_groupe_commande` (
  `gpc_id` int(11) NOT NULL AUTO_INCREMENT,
  `gpc_id_compte` int(11) NOT NULL,
  `gpc_id_commande` int(11) NOT NULL,
  `gpc_etat` tinyint(4) NOT NULL,
  PRIMARY KEY (`gpc_id`),
  KEY `fk_gpc_groupe_commande_adh_adherent1` (`gpc_id_compte`),
  KEY `fk_gpc_groupe_commande_com_commande1` (`gpc_id_commande`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table mod_module
-- -----------------------------
CREATE TABLE `mod_module` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nom` varchar(50) NOT NULL,
  `mod_label` varchar(80) NOT NULL,
  `mod_defaut` tinyint(1) NOT NULL,
  `mod_ordre` int(11) NOT NULL,
  `mod_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`mod_id`),
  KEY `fk_mod_module_vue_vues1` (`mod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table npro_nom_produit
-- -----------------------------
CREATE TABLE `npro_nom_produit` (
  `npro_id` int(11) NOT NULL AUTO_INCREMENT,
  `npro_nom` varchar(50) NOT NULL,
  `npro_description` text NOT NULL,
  `npro_id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`npro_id`),
  KEY `fk_npro_nom_produit_cpro_categorie_produit1` (`npro_id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table ope_operation
-- -----------------------------
CREATE TABLE `ope_operation` (
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
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table prdt_producteur
-- -----------------------------
CREATE TABLE `prdt_producteur` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table pro_produit
-- -----------------------------
CREATE TABLE `pro_produit` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id_commande` int(11) NOT NULL,
  `pro_id_nom_produit` int(11) NOT NULL,
  `pro_unite_mesure` varchar(20) NOT NULL,
  `pro_max_produit_commande` decimal(10,2) NOT NULL,
  `pro_id_producteur` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `fk_pro_produit_npro_nom_produit1` (`pro_id_nom_produit`),
  KEY `fk_pro_produit_com_id_commande1` (`pro_id_commande`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table sto_stock
-- -----------------------------
CREATE TABLE `sto_stock` (
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
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table tpp_type_paiement
-- -----------------------------
CREATE TABLE `tpp_type_paiement` (
  `tpp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tpp_type` varchar(100) NOT NULL,
  `tpp_champ_complementaire` tinyint(4) NOT NULL,
  `tpp_label_champ_complementaire` varchar(30) NOT NULL,
  `tpp_visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`tpp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- -----------------------------
-- creation de la table view_adherent
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_adherent` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,`adh_adherent`.`adh_courriel_secondaire` AS `adh_courriel_secondaire`,`adh_adherent`.`adh_telephone_principal` AS `adh_telephone_principal`,`adh_adherent`.`adh_telephone_secondaire` AS `adh_telephone_secondaire`,`adh_adherent`.`adh_adresse` AS `adh_adresse`,`adh_adherent`.`adh_code_postal` AS `adh_code_postal`,`adh_adherent`.`adh_ville` AS `adh_ville`,`adh_adherent`.`adh_date_naissance` AS `adh_date_naissance`,`adh_adherent`.`adh_date_adhesion` AS `adh_date_adhesion`,`adh_adherent`.`adh_date_maj` AS `adh_date_maj`,`adh_adherent`.`adh_commentaire` AS `adh_commentaire`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`adh_adherent` left join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) left join `cpt_compte` on((`cpt_compte`.`cpt_id` = `adh_adherent`.`adh_id_compte`))) where ((`ope_operation`.`ope_type` = 1) and (`adh_adherent`.`adh_super_zeybu` = 0)) group by `adh_adherent`.`adh_id`;

-- -----------------------------
-- creation de la table view_commande_complete_archive
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_commande_complete_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`com_commande`.`com_archive` = 1);

-- -----------------------------
-- creation de la table view_commande_complete_en_cours
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_commande_complete_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`com_commande`.`com_archive` = 0);

-- -----------------------------
-- creation de la table view_compte_zeybu
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_compte_zeybu` AS select sum(`ope_operation`.`ope_montant`) AS `ope_montant` from `ope_operation` where (`ope_operation`.`ope_type` = 1);

-- -----------------------------
-- creation de la table view_compte_zeybu_caisse
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_compte_zeybu_caisse` AS select sum(`ope_operation`.`ope_montant`) AS `ope_montant` from `ope_operation` where ((`ope_operation`.`ope_type` = 1) and (`ope_operation`.`ope_type_paiement` = 1));

-- -----------------------------
-- creation de la table view_gestion_liste_commande_archive
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_gestion_liste_commande_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` = 1);

-- -----------------------------
-- creation de la table view_gestion_liste_commande_en_cours
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_gestion_liste_commande_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` = 0) order by `com_commande`.`com_date_marche_debut`;

-- -----------------------------
-- creation de la table view_identification
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_identification` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_mot_passe` AS `adh_mot_passe`,`mod_module`.`mod_nom` AS `mod_nom`,`adh_adherent`.`adh_super_zeybu` AS `adh_super_zeybu` from ((`adh_adherent` left join `aut_autorisation` on((`adh_adherent`.`adh_id` = `aut_autorisation`.`aut_id_adherent`))) left join `mod_module` on((`aut_autorisation`.`aut_id_module` = `mod_module`.`mod_id`))) where (`adh_adherent`.`adh_etat` = 1);

-- -----------------------------
-- creation de la table view_info_bon_commande
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_info_bon_commande` AS select `view_operation_produit_bon_commande`.`com_id` AS `com_id`,`view_operation_produit_bon_commande`.`pro_id_producteur` AS `pro_id_producteur`,`view_operation_produit_bon_commande`.`pro_id` AS `pro_id`,`view_operation_produit_bon_commande`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_operation_produit_bon_commande`.`npro_nom` AS `npro_nom`,`view_operation_produit_bon_commande`.`ope_montant` AS `ope_montant`,`view_stock_commande`.`sto_quantite` AS `sto_quantite`,`view_producteur`.`prdt_nom` AS `prdt_nom`,`view_producteur`.`prdt_prenom` AS `prdt_prenom` from ((`view_operation_produit_bon_commande` join `view_stock_commande` on(((`view_stock_commande`.`pro_id_commande` = `view_operation_produit_bon_commande`.`com_id`) and (`view_stock_commande`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_stock_commande`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) join `view_producteur` on((`view_producteur`.`prdt_id` = `view_stock_commande`.`pro_id_producteur`))) group by `view_operation_produit_bon_commande`.`pro_id`;

-- -----------------------------
-- creation de la table view_info_bon_livraison
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_info_bon_livraison` AS select `view_operation_produit_bon_commande`.`com_id` AS `com_id`,`view_operation_produit_bon_commande`.`pro_id_producteur` AS `pro_id_producteur`,`view_operation_produit_bon_commande`.`pro_id` AS `pro_id`,`view_operation_produit_bon_commande`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_operation_produit_bon_commande`.`npro_nom` AS `npro_nom`,`view_operation_produit_bon_commande`.`ope_montant` AS `ope_montant`,`view_stock_commande`.`sto_quantite` AS `sto_quantite`,`view_producteur`.`prdt_nom` AS `prdt_nom`,`view_producteur`.`prdt_prenom` AS `prdt_prenom`,`view_operation_bon_livraison`.`ope_montant` AS `ope_montant_livraison`,`view_stock_livraison`.`sto_quantite` AS `sto_quantite_livraison`,`view_stock_solidaire`.`sto_quantite` AS `sto_quantite_solidaire` from (((((`view_operation_produit_bon_commande` left join `view_stock_commande` on(((`view_stock_commande`.`pro_id_commande` = `view_operation_produit_bon_commande`.`com_id`) and (`view_stock_commande`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_stock_commande`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) join `view_producteur` on((`view_producteur`.`prdt_id` = `view_stock_commande`.`pro_id_producteur`))) left join `view_operation_bon_livraison` on(((`view_operation_bon_livraison`.`com_id` = `view_operation_produit_bon_commande`.`com_id`) and (`view_operation_bon_livraison`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_operation_bon_livraison`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) left join `view_stock_livraison` on(((`view_stock_livraison`.`pro_id_commande` = `view_operation_produit_bon_commande`.`com_id`) and (`view_stock_livraison`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_stock_livraison`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) left join `view_stock_solidaire` on(((`view_stock_solidaire`.`pro_id_commande` = `view_operation_produit_bon_commande`.`com_id`) and (`view_stock_solidaire`.`pro_id_producteur` = `view_operation_produit_bon_commande`.`pro_id_producteur`) and (`view_stock_solidaire`.`pro_id` = `view_operation_produit_bon_commande`.`pro_id`)))) group by `view_operation_produit_bon_commande`.`pro_id`;

-- -----------------------------
-- creation de la table view_info_commande
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_info_commande` AS select `pro_produit`.`pro_id_commande` AS `com_id`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`view_operation_produit_bon_commande`.`ope_montant` AS `ope_montant`,`view_stock_commande`.`sto_quantite` AS `sto_quantite`,`view_operation_bon_livraison`.`ope_montant` AS `ope_montant_livraison`,`view_stock_livraison`.`sto_quantite` AS `sto_quantite_livraison`,`view_stock_solidaire`.`sto_quantite` AS `sto_quantite_solidaire`,(`view_stock_achat`.`sto_quantite` * -(1)) AS `sto_quantite_vente`,(`view_stock_achat_solidaire`.`sto_quantite` * -(1)) AS `sto_quantite_vente_solidaire`,(`view_operation_achat`.`ope_montant` * -(1)) AS `ope_montant_vente`,(`view_operation_achat_solidaire`.`ope_montant` * -(1)) AS `ope_montant_vente_solidaire` from ((((((((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) left join `view_operation_produit_bon_commande` on((`view_operation_produit_bon_commande`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_commande` on((`view_stock_commande`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_operation_bon_livraison` on((`view_operation_bon_livraison`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_livraison` on((`view_stock_livraison`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_solidaire` on((`view_stock_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_achat` on((`view_stock_achat`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_achat_solidaire` on((`view_stock_achat_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_operation_achat` on((`view_operation_achat`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_operation_achat_solidaire` on((`view_operation_achat_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) group by `pro_produit`.`pro_id`;

-- -----------------------------
-- creation de la table view_liste_adherent
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_adherent` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from (`adh_adherent` left join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) where ((`ope_operation`.`ope_type` = 1) and (`adh_adherent`.`adh_super_zeybu` = 0) and (`adh_adherent`.`adh_etat` = 1)) group by `adh_adherent`.`adh_id`;

-- -----------------------------
-- creation de la table view_liste_adherent_commande
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_adherent_commande` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom` from (((`adh_adherent` join `gpc_groupe_commande` on((`gpc_groupe_commande`.`gpc_id_compte` = `adh_adherent`.`adh_id_compte`))) join `com_commande` on((`gpc_groupe_commande`.`gpc_id_commande` = `com_commande`.`com_id`))) left join `cpt_compte` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) where (`adh_adherent`.`adh_etat` = 1);

-- -----------------------------
-- creation de la table view_liste_adherent_commande_reservation
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_adherent_commande_reservation` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom` from (((`adh_adherent` join `gpc_groupe_commande` on((`gpc_groupe_commande`.`gpc_id_compte` = `adh_adherent`.`adh_id_compte`))) join `com_commande` on((`gpc_groupe_commande`.`gpc_id_commande` = `com_commande`.`com_id`))) left join `cpt_compte` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) where ((`adh_adherent`.`adh_etat` = 1) and (`gpc_groupe_commande`.`gpc_etat` = 0));

-- -----------------------------
-- creation de la table view_liste_commande_archive
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_commande_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where ((`com_commande`.`com_date_fin_reservation` < now()) or (`com_commande`.`com_archive` <> 0));

-- -----------------------------
-- creation de la table view_liste_commande_en_cours
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_commande_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where ((`com_commande`.`com_date_fin_reservation` >= now()) and (`com_commande`.`com_archive` = 0));

-- -----------------------------
-- creation de la table view_liste_producteur_commande
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_producteur_commande` AS select `view_commande_complete_en_cours`.`com_id` AS `com_id`,`view_producteur`.`prdt_id` AS `prdt_id`,`view_producteur`.`prdt_nom` AS `prdt_nom`,`view_producteur`.`prdt_prenom` AS `prdt_prenom` from (`view_commande_complete_en_cours` join `view_producteur` on((`view_commande_complete_en_cours`.`pro_id_producteur` = `view_producteur`.`prdt_id`))) group by `view_commande_complete_en_cours`.`com_id`,`view_producteur`.`prdt_nom`,`view_producteur`.`prdt_prenom` order by `view_producteur`.`prdt_nom`,`view_producteur`.`prdt_prenom`;

-- -----------------------------
-- creation de la table view_liste_reservation_archive
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_reservation_archive` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`adh_adherent`.`adh_super_zeybu` AS `adh_super_zeybu`,`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive` from ((`adh_adherent` join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`com_commande`.`com_date_marche_fin` < curdate()) or ((`com_commande`.`com_archive` = 1) and (`ope_operation`.`ope_type` = 1)));

-- -----------------------------
-- creation de la table view_liste_reservation_en_cours
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_reservation_en_cours` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`adh_adherent`.`adh_super_zeybu` AS `adh_super_zeybu`,`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive` from ((`adh_adherent` join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`com_commande`.`com_date_marche_fin` >= curdate()) and (`com_commande`.`com_archive` = 0) and (`ope_operation`.`ope_type` = 0)) order by `com_commande`.`com_date_marche_debut`;

-- -----------------------------
-- creation de la table view_menu
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_super_zeybu` AS `adh_super_zeybu`,`mod_module`.`mod_id` AS `mod_id`,`mod_module`.`mod_nom` AS `mod_nom`,`mod_module`.`mod_label` AS `mod_label`,`mod_module`.`mod_admin` AS `mod_admin` from ((`adh_adherent` left join `aut_autorisation` on((`adh_adherent`.`adh_id` = `aut_autorisation`.`aut_id_adherent`))) left join `mod_module` on((`aut_autorisation`.`aut_id_module` = `mod_module`.`mod_id`))) where (`adh_adherent`.`adh_etat` = 1) order by `mod_module`.`mod_ordre`;

-- -----------------------------
-- creation de la table view_operation_achat
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_operation_achat` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`ope_operation`.`ope_id` AS `ope_id`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`ope_operation` join `com_commande` on((`ope_operation`.`ope_id_commande` = `com_commande`.`com_id`))) join `pro_produit` on((`ope_operation`.`ope_type_paiement_champ_complementaire` = `pro_produit`.`pro_id`))) where ((`ope_operation`.`ope_type` = 1) and (`ope_operation`.`ope_type_paiement` = 7) and (`ope_operation`.`ope_montant` < 0)) group by `pro_produit`.`pro_id`;

-- -----------------------------
-- creation de la table view_operation_achat_solidaire
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_operation_achat_solidaire` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`ope_operation`.`ope_id` AS `ope_id`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`ope_operation` join `com_commande` on((`ope_operation`.`ope_id_commande` = `com_commande`.`com_id`))) join `pro_produit` on((`ope_operation`.`ope_type_paiement_champ_complementaire` = `pro_produit`.`pro_id`))) where ((`ope_operation`.`ope_type` = 1) and (`ope_operation`.`ope_type_paiement` = 8) and (`ope_operation`.`ope_montant` < 0)) group by `pro_produit`.`pro_id`;

-- -----------------------------
-- creation de la table view_operation_avenir
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_operation_avenir` AS select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` from ((`ope_operation` left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) left join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`ope_operation`.`ope_type` = 0) and (`com_commande`.`com_archive` = 0)) order by `com_commande`.`com_date_marche_debut`;

-- -----------------------------
-- creation de la table view_operation_bon_livraison
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_operation_bon_livraison` AS select `view_commande_complete_en_cours`.`com_id` AS `com_id`,`view_commande_complete_en_cours`.`pro_id_producteur` AS `pro_id_producteur`,`view_commande_complete_en_cours`.`pro_id` AS `pro_id`,`ope_operation`.`ope_id` AS `ope_id`,`view_commande_complete_en_cours`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_commande_complete_en_cours`.`npro_nom` AS `npro_nom`,`ope_operation`.`ope_montant` AS `ope_montant` from (`view_commande_complete_en_cours` join `ope_operation` on(((`ope_operation`.`ope_id_commande` = `view_commande_complete_en_cours`.`com_id`) and (`ope_operation`.`ope_type_paiement_champ_complementaire` = `view_commande_complete_en_cours`.`pro_id`)))) where (`ope_operation`.`ope_type` = 4) group by `view_commande_complete_en_cours`.`pro_id`;

-- -----------------------------
-- creation de la table view_operation_passee
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_operation_passee` AS select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` from ((`ope_operation` join `cpt_compte` on((`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) where (`ope_operation`.`ope_type` = 1) order by `ope_operation`.`ope_date` desc;

-- -----------------------------
-- creation de la table view_operation_produit_bon_commande
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_operation_produit_bon_commande` AS select `view_commande_complete_en_cours`.`com_id` AS `com_id`,`view_commande_complete_en_cours`.`pro_id_producteur` AS `pro_id_producteur`,`view_commande_complete_en_cours`.`pro_id` AS `pro_id`,`ope_operation`.`ope_id` AS `ope_id`,`view_commande_complete_en_cours`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_commande_complete_en_cours`.`npro_nom` AS `npro_nom`,`ope_operation`.`ope_montant` AS `ope_montant` from (`view_commande_complete_en_cours` join `ope_operation` on(((`ope_operation`.`ope_id_commande` = `view_commande_complete_en_cours`.`com_id`) and (`ope_operation`.`ope_type_paiement_champ_complementaire` = `view_commande_complete_en_cours`.`pro_id`)))) where (`ope_operation`.`ope_type` = 3) group by `view_commande_complete_en_cours`.`pro_id`;

-- -----------------------------
-- creation de la table view_producteur
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_producteur` AS select `prdt_producteur`.`prdt_id` AS `prdt_id`,`prdt_producteur`.`prdt_numero` AS `prdt_numero`,`prdt_producteur`.`prdt_id_compte` AS `prdt_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,`prdt_producteur`.`prdt_courriel_principal` AS `prdt_courriel_principal`,`prdt_producteur`.`prdt_courriel_secondaire` AS `prdt_courriel_secondaire`,`prdt_producteur`.`prdt_telephone_principal` AS `prdt_telephone_principal`,`prdt_producteur`.`prdt_telephone_secondaire` AS `prdt_telephone_secondaire`,`prdt_producteur`.`prdt_adresse` AS `prdt_adresse`,`prdt_producteur`.`prdt_code_postal` AS `prdt_code_postal`,`prdt_producteur`.`prdt_ville` AS `prdt_ville`,`prdt_producteur`.`prdt_date_naissance` AS `prdt_date_naissance`,`prdt_producteur`.`prdt_date_creation` AS `prdt_date_creation`,`prdt_producteur`.`prdt_date_maj` AS `prdt_date_maj`,`prdt_producteur`.`prdt_commentaire` AS `prdt_commentaire`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`prdt_producteur` left join `ope_operation` on((`prdt_producteur`.`prdt_id_compte` = `ope_operation`.`ope_id_compte`))) left join `cpt_compte` on((`cpt_compte`.`cpt_id` = `prdt_producteur`.`prdt_id_compte`))) where ((`ope_operation`.`ope_type` = 1) and (`prdt_producteur`.`prdt_etat` = 1)) group by `prdt_producteur`.`prdt_id`;

-- -----------------------------
-- creation de la table view_reservation
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_reservation` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`sto_stock`.`sto_type` AS `sto_type`,`sto_stock`.`sto_id_compte` AS `sto_id_compte`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cpt_compte`.`cpt_label` AS `cpt_label` from (((((`com_commande` join `pro_produit` on((`com_commande`.`com_id` = `pro_produit`.`pro_id_commande`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`dcom_detail_commande`.`dcom_id` = `sto_stock`.`sto_id_detail_commande`))) join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `sto_stock`.`sto_id_compte`))) join `cpt_compte` on((`cpt_compte`.`cpt_id` = `sto_stock`.`sto_id_compte`))) where ((`sto_stock`.`sto_type` = 0) and (`sto_stock`.`sto_id_compte` <> 0));

-- -----------------------------
-- creation de la table view_stock_achat
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_achat` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where ((`sto_stock`.`sto_type` = 1) and (`sto_stock`.`sto_quantite` < 0)) group by `pro_produit`.`pro_id`;

-- -----------------------------
-- creation de la table view_stock_achat_solidaire
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_achat_solidaire` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where ((`sto_stock`.`sto_type` = 5) and (`sto_stock`.`sto_quantite` < 0)) group by `pro_produit`.`pro_id`;

-- -----------------------------
-- creation de la table view_stock_commande
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_commande` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`sto_stock`.`sto_quantite` AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`sto_stock`.`sto_type` = 3);

-- -----------------------------
-- creation de la table view_stock_livraison
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_livraison` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`sto_stock`.`sto_quantite` AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`sto_stock`.`sto_type` = 4);

-- -----------------------------
-- creation de la table view_stock_produit
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_produit` AS select `pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` from ((`pro_produit` join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on(((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`) and (`sto_stock`.`sto_type` in (0,1))))) group by `pro_produit`.`pro_id`;

-- -----------------------------
-- creation de la table view_stock_produit_initiaux
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_produit_initiaux` AS select `sto_stock`.`sto_id` AS `sto_id`,`sto_stock`.`sto_date` AS `sto_date`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`sto_stock`.`sto_type` AS `sto_type`,`sto_stock`.`sto_id_commande` AS `sto_id_commande`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit` from (`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`sto_stock`.`sto_id_compte` = 0) and (`sto_stock`.`sto_type` in (0,1)));

-- -----------------------------
-- creation de la table view_stock_produit_reservation
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_produit_reservation` AS select `view_commande_complete_en_cours`.`com_id` AS `com_id`,`view_commande_complete_en_cours`.`pro_id_producteur` AS `pro_id_producteur`,`view_commande_complete_en_cours`.`pro_id` AS `pro_id`,`view_commande_complete_en_cours`.`pro_unite_mesure` AS `pro_unite_mesure`,`view_commande_complete_en_cours`.`npro_nom` AS `npro_nom`,(`view_stock_produit_initiaux`.`sto_quantite` - `view_stock_produit`.`sto_quantite`) AS `sto_quantite` from ((`view_commande_complete_en_cours` join `view_stock_produit_initiaux` on((`view_stock_produit_initiaux`.`dcom_id_produit` = `view_commande_complete_en_cours`.`pro_id`))) join `view_stock_produit` on((`view_stock_produit`.`pro_id` = `view_commande_complete_en_cours`.`pro_id`))) group by `view_commande_complete_en_cours`.`pro_id`;

-- -----------------------------
-- creation de la table view_stock_solidaire
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_solidaire` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`sto_stock`.`sto_type` = 5) group by `pro_produit`.`pro_id`;

-- -----------------------------
-- creation de la table view_type_paiement_visible
-- -----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_type_paiement_visible` AS select `tpp_type_paiement`.`tpp_id` AS `tpp_id`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`tpp_type_paiement`.`tpp_visible` AS `tpp_visible` from `tpp_type_paiement` where (`tpp_type_paiement`.`tpp_visible` = 1);

-- -----------------------------
-- creation de la table vue_vues
-- -----------------------------
CREATE TABLE `vue_vues` (
  `vue_id` int(11) NOT NULL AUTO_INCREMENT,
  `vue_id_module` int(11) NOT NULL,
  `vue_nom` varchar(50) NOT NULL,
  `vue_label` varchar(80) NOT NULL,
  `vue_ordre` int(11) NOT NULL,
  PRIMARY KEY (`vue_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;



-- -----------------------------
-- insertions dans la table adh_adherent
-- -----------------------------
INSERT INTO adh_adherent VALUES(0, '01f01083386dc09d99826461b2b6c6f1', 'julien', 0, '', '', '', '', '', '', '', '', '', 0000-00-00, 0000-00-00, 0000-00-00 00:00:00, '', 1, 1);
INSERT INTO adh_adherent VALUES(1, '01f01083386dc09d99826461b2b6c6f1', 'Z1', 31, 'JALABERT', 'Bernard', 'bernard.jalabert@free.fr', '', '04.76.24.10.36', '', '8 rue de Belledonne', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 23:12:26, '', 1, 0);
INSERT INTO adh_adherent VALUES(2, '01f01083386dc09d99826461b2b6c6f1', 'Z2', 2, 'ARDITO', 'Denise', 'pascal.ardito@free.fr', '', '09.53.86.42.51', '', '22 rue du Vercors', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2011-01-03 00:04:06, '', 1, 0);
INSERT INTO adh_adherent VALUES(3, '01f01083386dc09d99826461b2b6c6f1', 'Z3', 3, 'BAR', 'Georges', 'georges.bar@laposte.net', '', '04.76.25.18.46', '', '4 place des Coulmes', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(4, '01f01083386dc09d99826461b2b6c6f1', 'Z4', 4, 'BENHAMOU', 'Robert', 'robert.benhamou@laposte.net', '', '04.76.24.66.50', '', '13 rue Louis Farçat', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(5, '01f01083386dc09d99826461b2b6c6f1', 'Z5', 5, 'BERENGER', 'Gérard', 'ge.berenger@laposte.net', '', '04.76.25.51.09', '', '7 allée du Rachais', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(6, '01f01083386dc09d99826461b2b6c6f1', 'Z6', 6, 'BERENGER', 'Jocelyne', 'jocelyne.berenger@laposte.net', '', '04.76.25.51.09', '', '7 allée du Rachais', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(7, '01f01083386dc09d99826461b2b6c6f1', 'Z7', 7, 'BUISSON', 'Marie-hélène', 'marie-helene38@hotmail.fr', '', '04.76.25.47.23', '', '15 allée du Gerbier', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(8, '01f01083386dc09d99826461b2b6c6f1', 'Z8', 8, 'COQUET', 'Jean-paul', '', 'jp_coquet@yahoo.fr', '04.76.25.31.65', '', '55  rue des Javaux', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-12-27 18:03:19, '', 1, 0);
INSERT INTO adh_adherent VALUES(9, '01f01083386dc09d99826461b2b6c6f1', 'Z9', 9, 'COQUET', 'Michelle', 'jp_coquet@yahoo.fr', '', '04.76.25.31.65', '', '55  rue des Javaux', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(10, '01f01083386dc09d99826461b2b6c6f1', 'Z10', 10, 'CROZET', 'Béatrice', 'bc.crozet@orange.fr', '', '', '', '58 avenue Jean Jaurès', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-12-22 15:09:12, '', 1, 0);
INSERT INTO adh_adherent VALUES(11, '01f01083386dc09d99826461b2b6c6f1', 'Z11', 11, 'DATHE', 'Suzanne', 'suzannedathe@hotmail.com', '', '04.76.14.07.42', '', '8 allée du Rachais', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(12, '01f01083386dc09d99826461b2b6c6f1', 'Z12', 12, 'DERRAS', 'Danièle', 'zeybulonsanszemail@gmail.com', '', '04.76.25.48.58', '', '12 rue Denis Diderot', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Pas d&#039;Email', 1, 0);
INSERT INTO adh_adherent VALUES(13, '01f01083386dc09d99826461b2b6c6f1', 'Z13', 13, 'DERRAS', 'Maurice', 'zeybulonsanszemail@gmail.com', '', '04.76.25.48.58', '', '12 rue Denis Diderot', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Pas d&#039;Email', 1, 0);
INSERT INTO adh_adherent VALUES(14, '01f01083386dc09d99826461b2b6c6f1', 'Z14', 14, 'DESFORGES', 'Alain', 'desforges11@laposte.net', '', '04.76.18.28.41', '06.87.72.62.18', '10 allée du Gerbier', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(15, '01f01083386dc09d99826461b2b6c6f1', 'Z15', 15, 'DESFORGES', 'Cécile', 'cec.desforges@free.fr', '', '04.76.18.28.41', '', '10 allée du Gerbier', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(16, '01f01083386dc09d99826461b2b6c6f1', 'Z16', 16, 'DI NATALE', 'Emmanuelle', '', 'emmanuelle3438@gmail.com', '06.58.07.62.27', '', '2 place des Coulmes', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'N&#039;habite plus le quartier', 1, 0);
INSERT INTO adh_adherent VALUES(17, '01f01083386dc09d99826461b2b6c6f1', 'Z17', 17, 'ESSOU', 'Yvonne', 'zeybulonsanszemail@gmail.com', '', '04.76.14.06.56', '', '', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Pas d&#039;Email', 1, 0);
INSERT INTO adh_adherent VALUES(18, '01f01083386dc09d99826461b2b6c6f1', 'Z18', 18, 'FLORES', 'Madeleine', '', 'zeybulonsanszemail@gmail.com', '04.76.24.21.25', '', '58 avenue Jean Jaurès', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Ne souhaite pas réadhérer', 1, 0);
INSERT INTO adh_adherent VALUES(19, '01f01083386dc09d99826461b2b6c6f1', 'Z19', 19, 'FONTE', 'Catherine', 'cat.fonte@orange.fr', '', '04.76.14.04.62', '', '7 rue Edmond Rostand', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(20, '01f01083386dc09d99826461b2b6c6f1', 'Z20', 20, 'GARNIER', 'Béatrice', 'bagarnier@free.fr', '', '04.76.25.38.58', '', '20 rue Jean-Paul Sartre', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(21, '01f01083386dc09d99826461b2b6c6f1', 'Z21', 21, 'GERVAIS', 'Guy', 'guymogerv@orange.fr', '', '04.76.25.77.88', '', '1 place des Tilleuls', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(22, '01f01083386dc09d99826461b2b6c6f1', 'Z22', 22, 'GERVAIS', 'Monique', '', 'guymogerv@orange.fr', '', '', '1 place des Tilleuls', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(23, '01f01083386dc09d99826461b2b6c6f1', 'Z23', 23, 'GUIGNIER', 'Anne', '', 'brunogaudin@wanadoo.fr', '04.76.01.86.30', '', '10 allée du Gerbier', '38320', 'EYBENS', 0000-00-00, 2009-10-16, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(24, '01f01083386dc09d99826461b2b6c6f1', 'Z24', 24, 'HOLLANDE', 'Christiane', 'chollande@yahoo.fr', '', '04.76.25.29.40', '', '7 allée du Rachais', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(25, '01f01083386dc09d99826461b2b6c6f1', 'Z25', 25, 'LOPPINET', 'Gisèle', 'gisou3834@yahoo.fr', '', '04.76.24.35.76', '06.71.31.84.23', '24 rue du Vercors', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(26, '01f01083386dc09d99826461b2b6c6f1', 'Z26', 26, 'MARCEL', 'Idalète', 'idaletem@hotmail.com', '', '04.76.62.34.99', '', '12 rue Anselme Bonneton', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(27, '01f01083386dc09d99826461b2b6c6f1', 'Z27', 27, 'MARIOTTINI', 'Laetitia', 'sachalaetitia@neuf.fr', '', '04.76.54.34.08', '06.16.93.26.74', '10 rue de Belledonne', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(28, '01f01083386dc09d99826461b2b6c6f1', 'Z28', 28, 'MARIOTTINI', 'Sacha', '', 'sachalaetitia@neuf.fr', '04.76.54.34.08', '06.16.93.26.74', '10 rue de Belledonne', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(29, '01f01083386dc09d99826461b2b6c6f1', 'Z29', 29, 'MASSON-DELAITRE', 'Georgette', 'zeybulonsanszemail@gmail.com', '', '04.56.45.66.29', '06.13.74.39.75', '8 place des Coulmes', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Pas d&#039;Email', 1, 0);
INSERT INTO adh_adherent VALUES(30, '01f01083386dc09d99826461b2b6c6f1', 'Z30', 30, 'MERLE', 'Agnès', '', '', '04.76.22.48.89', '', '27 rue Anatole France', '38100', 'GRENOBLE', 0000-00-00, 2009-07-02, 2010-11-28 20:23:48, '', 1, 0);
INSERT INTO adh_adherent VALUES(31, '01f01083386dc09d99826461b2b6c6f1', 'Z31', 32, 'PIERRE', 'Jean-victor', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-12-22 20:38:56, '', 1, 0);
INSERT INTO adh_adherent VALUES(32, '01f01083386dc09d99826461b2b6c6f1', 'Z32', 32, 'PIERRE', 'Marie-charlotte', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-12-22 20:39:26, '', 1, 0);
INSERT INTO adh_adherent VALUES(33, '01f01083386dc09d99826461b2b6c6f1', 'Z33', 33, 'DESFORGES', 'Cécile', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:50:57, '', 1, 0);
INSERT INTO adh_adherent VALUES(34, '01f01083386dc09d99826461b2b6c6f1', 'Z34', 33, 'DESFORGES', 'Alain', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:51:55, '', 1, 0);
INSERT INTO adh_adherent VALUES(35, '01f01083386dc09d99826461b2b6c6f1', 'Z35', 34, 'DESFORGES', 'Ambre', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:52:48, '', 1, 0);
INSERT INTO adh_adherent VALUES(36, '01f01083386dc09d99826461b2b6c6f1', 'Z36', 34, 'DESFORGES', 'Clovis', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:53:31, '', 1, 0);
INSERT INTO adh_adherent VALUES(37, '01f01083386dc09d99826461b2b6c6f1', 'Z37', 35, 'GRANJON', 'Nicolas', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:54:36, '', 1, 0);
INSERT INTO adh_adherent VALUES(38, '01f01083386dc09d99826461b2b6c6f1', 'Z38', 35, 'PETIT', 'Fabrice', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:55:10, '', 1, 0);
INSERT INTO adh_adherent VALUES(39, '01f01083386dc09d99826461b2b6c6f1', 'Z39', 36, 'LINOSSIER', 'Jean-benoit', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:56:13, '', 1, 0);
INSERT INTO adh_adherent VALUES(40, '01f01083386dc09d99826461b2b6c6f1', 'Z40', 36, 'LINOSSIER', 'Jocelyne', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:56:47, '', 1, 0);
INSERT INTO adh_adherent VALUES(41, '01f01083386dc09d99826461b2b6c6f1', 'Z41', 45, 'PIERRE', 'Julien', '', '', '', '', '', '', '', 1986-01-31, 2010-12-25, 2010-12-25 17:09:37, '', 1, 0);
INSERT INTO adh_adherent VALUES(42, '01f01083386dc09d99826461b2b6c6f1', 'Z42', 46, 'TOTO', 'Suppression', '', '', '', '', '', '', '', 0000-00-00, 2011-02-06, 2011-02-06 17:27:53, '', 2, 0);

-- -----------------------------
-- insertions dans la table aut_autorisation
-- -----------------------------
INSERT INTO aut_autorisation VALUES(1, 1, 1);
INSERT INTO aut_autorisation VALUES(2, 1, 3);
INSERT INTO aut_autorisation VALUES(3, 2, 1);
INSERT INTO aut_autorisation VALUES(4, 2, 3);
INSERT INTO aut_autorisation VALUES(5, 3, 1);
INSERT INTO aut_autorisation VALUES(6, 3, 3);
INSERT INTO aut_autorisation VALUES(7, 4, 1);
INSERT INTO aut_autorisation VALUES(8, 4, 3);
INSERT INTO aut_autorisation VALUES(9, 5, 1);
INSERT INTO aut_autorisation VALUES(10, 5, 3);
INSERT INTO aut_autorisation VALUES(11, 6, 1);
INSERT INTO aut_autorisation VALUES(12, 6, 3);
INSERT INTO aut_autorisation VALUES(13, 7, 1);
INSERT INTO aut_autorisation VALUES(14, 7, 3);
INSERT INTO aut_autorisation VALUES(15, 8, 1);
INSERT INTO aut_autorisation VALUES(16, 8, 3);
INSERT INTO aut_autorisation VALUES(17, 9, 1);
INSERT INTO aut_autorisation VALUES(18, 9, 3);
INSERT INTO aut_autorisation VALUES(19, 10, 1);
INSERT INTO aut_autorisation VALUES(20, 10, 3);
INSERT INTO aut_autorisation VALUES(21, 11, 1);
INSERT INTO aut_autorisation VALUES(22, 11, 3);
INSERT INTO aut_autorisation VALUES(23, 12, 1);
INSERT INTO aut_autorisation VALUES(24, 12, 3);
INSERT INTO aut_autorisation VALUES(25, 13, 1);
INSERT INTO aut_autorisation VALUES(26, 13, 3);
INSERT INTO aut_autorisation VALUES(27, 14, 1);
INSERT INTO aut_autorisation VALUES(28, 14, 3);
INSERT INTO aut_autorisation VALUES(29, 15, 1);
INSERT INTO aut_autorisation VALUES(30, 15, 3);
INSERT INTO aut_autorisation VALUES(31, 16, 1);
INSERT INTO aut_autorisation VALUES(32, 16, 3);
INSERT INTO aut_autorisation VALUES(33, 17, 1);
INSERT INTO aut_autorisation VALUES(34, 17, 3);
INSERT INTO aut_autorisation VALUES(35, 18, 1);
INSERT INTO aut_autorisation VALUES(36, 18, 3);
INSERT INTO aut_autorisation VALUES(37, 19, 1);
INSERT INTO aut_autorisation VALUES(38, 19, 3);
INSERT INTO aut_autorisation VALUES(39, 20, 1);
INSERT INTO aut_autorisation VALUES(40, 20, 3);
INSERT INTO aut_autorisation VALUES(41, 21, 1);
INSERT INTO aut_autorisation VALUES(42, 21, 3);
INSERT INTO aut_autorisation VALUES(43, 22, 1);
INSERT INTO aut_autorisation VALUES(44, 22, 3);
INSERT INTO aut_autorisation VALUES(45, 23, 1);
INSERT INTO aut_autorisation VALUES(46, 23, 3);
INSERT INTO aut_autorisation VALUES(47, 24, 1);
INSERT INTO aut_autorisation VALUES(48, 24, 3);
INSERT INTO aut_autorisation VALUES(49, 25, 1);
INSERT INTO aut_autorisation VALUES(50, 25, 3);
INSERT INTO aut_autorisation VALUES(51, 26, 1);
INSERT INTO aut_autorisation VALUES(52, 26, 3);
INSERT INTO aut_autorisation VALUES(53, 27, 1);
INSERT INTO aut_autorisation VALUES(54, 27, 3);
INSERT INTO aut_autorisation VALUES(55, 28, 1);
INSERT INTO aut_autorisation VALUES(56, 28, 3);
INSERT INTO aut_autorisation VALUES(57, 29, 1);
INSERT INTO aut_autorisation VALUES(58, 29, 3);
INSERT INTO aut_autorisation VALUES(59, 30, 1);
INSERT INTO aut_autorisation VALUES(60, 30, 3);
INSERT INTO aut_autorisation VALUES(61, 31, 1);
INSERT INTO aut_autorisation VALUES(62, 31, 3);
INSERT INTO aut_autorisation VALUES(63, 32, 1);
INSERT INTO aut_autorisation VALUES(64, 32, 3);
INSERT INTO aut_autorisation VALUES(65, 33, 1);
INSERT INTO aut_autorisation VALUES(66, 33, 3);
INSERT INTO aut_autorisation VALUES(67, 34, 1);
INSERT INTO aut_autorisation VALUES(68, 34, 3);
INSERT INTO aut_autorisation VALUES(69, 35, 1);
INSERT INTO aut_autorisation VALUES(70, 35, 3);
INSERT INTO aut_autorisation VALUES(71, 36, 1);
INSERT INTO aut_autorisation VALUES(72, 36, 3);
INSERT INTO aut_autorisation VALUES(73, 37, 1);
INSERT INTO aut_autorisation VALUES(74, 37, 3);
INSERT INTO aut_autorisation VALUES(75, 38, 1);
INSERT INTO aut_autorisation VALUES(76, 38, 3);
INSERT INTO aut_autorisation VALUES(77, 39, 1);
INSERT INTO aut_autorisation VALUES(78, 39, 3);
INSERT INTO aut_autorisation VALUES(79, 40, 1);
INSERT INTO aut_autorisation VALUES(80, 40, 3);
INSERT INTO aut_autorisation VALUES(81, 31, 4);
INSERT INTO aut_autorisation VALUES(82, 32, 5);
INSERT INTO aut_autorisation VALUES(83, 41, 1);
INSERT INTO aut_autorisation VALUES(84, 41, 3);
INSERT INTO aut_autorisation VALUES(85, 41, 4);
INSERT INTO aut_autorisation VALUES(86, 41, 2);
INSERT INTO aut_autorisation VALUES(87, 41, 5);
INSERT INTO aut_autorisation VALUES(88, 41, 6);
INSERT INTO aut_autorisation VALUES(89, 42, 1);
INSERT INTO aut_autorisation VALUES(90, 42, 3);

-- -----------------------------
-- insertions dans la table com_commande
-- -----------------------------
INSERT INTO com_commande VALUES(1, 1, '', '', 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);
INSERT INTO com_commande VALUES(2, 2, '', '', 2010-12-14 16:30:00, 2010-12-14 23:20:00, 2010-12-10 01:00:00, 0);
INSERT INTO com_commande VALUES(3, 3, '', '', 2013-11-30 01:00:00, 2013-11-30 01:45:00, 2013-11-29 01:00:00, 0);
INSERT INTO com_commande VALUES(4, 4, '', '', 2010-11-30 01:00:00, 2010-11-30 03:00:00, 2010-11-29 23:00:00, 1);
INSERT INTO com_commande VALUES(5, 5, '', '', 2010-12-28 00:00:00, 2010-12-28 02:00:00, 2010-12-27 00:00:00, 1);
INSERT INTO com_commande VALUES(6, 6, '', '', 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1);
INSERT INTO com_commande VALUES(7, 7, '', '', 2011-06-16 00:00:00, 2011-06-16 01:00:00, 2011-06-02 00:00:00, 0);

-- -----------------------------
-- insertions dans la table cpro_categorie_produit
-- -----------------------------
INSERT INTO cpro_categorie_produit VALUES(1, 'Produit', '');

-- -----------------------------
-- insertions dans la table cpt_compte
-- -----------------------------
INSERT INTO cpt_compte VALUES(1, 'C1');
INSERT INTO cpt_compte VALUES(2, 'C2');
INSERT INTO cpt_compte VALUES(3, 'C3');
INSERT INTO cpt_compte VALUES(4, 'C4');
INSERT INTO cpt_compte VALUES(5, 'C5');
INSERT INTO cpt_compte VALUES(6, 'C6');
INSERT INTO cpt_compte VALUES(7, 'C7');
INSERT INTO cpt_compte VALUES(8, 'C8');
INSERT INTO cpt_compte VALUES(9, 'C9');
INSERT INTO cpt_compte VALUES(10, 'C10');
INSERT INTO cpt_compte VALUES(11, 'C11');
INSERT INTO cpt_compte VALUES(12, 'C12');
INSERT INTO cpt_compte VALUES(13, 'C13');
INSERT INTO cpt_compte VALUES(14, 'C14');
INSERT INTO cpt_compte VALUES(15, 'C15');
INSERT INTO cpt_compte VALUES(16, 'C16');
INSERT INTO cpt_compte VALUES(17, 'C17');
INSERT INTO cpt_compte VALUES(18, 'C18');
INSERT INTO cpt_compte VALUES(19, 'C19');
INSERT INTO cpt_compte VALUES(20, 'C20');
INSERT INTO cpt_compte VALUES(21, 'C21');
INSERT INTO cpt_compte VALUES(22, 'C22');
INSERT INTO cpt_compte VALUES(23, 'C23');
INSERT INTO cpt_compte VALUES(24, 'C24');
INSERT INTO cpt_compte VALUES(25, 'C25');
INSERT INTO cpt_compte VALUES(26, 'C26');
INSERT INTO cpt_compte VALUES(27, 'C27');
INSERT INTO cpt_compte VALUES(28, 'C28');
INSERT INTO cpt_compte VALUES(29, 'C29');
INSERT INTO cpt_compte VALUES(30, 'C30');
INSERT INTO cpt_compte VALUES(31, 'C31');
INSERT INTO cpt_compte VALUES(32, 'C32');
INSERT INTO cpt_compte VALUES(33, 'C33');
INSERT INTO cpt_compte VALUES(34, 'C34');
INSERT INTO cpt_compte VALUES(35, 'C35');
INSERT INTO cpt_compte VALUES(36, 'C36');
INSERT INTO cpt_compte VALUES(37, 'C37');
INSERT INTO cpt_compte VALUES(38, 'C38');
INSERT INTO cpt_compte VALUES(39, 'C39');
INSERT INTO cpt_compte VALUES(40, 'C40');
INSERT INTO cpt_compte VALUES(41, 'C41');
INSERT INTO cpt_compte VALUES(42, 'C42');
INSERT INTO cpt_compte VALUES(43, 'C43');
INSERT INTO cpt_compte VALUES(44, 'C44');
INSERT INTO cpt_compte VALUES(45, 'C45');
INSERT INTO cpt_compte VALUES(46, 'C46');
INSERT INTO cpt_compte VALUES(47, 'C47');

-- -----------------------------
-- insertions dans la table dcom_detail_commande
-- -----------------------------
INSERT INTO dcom_detail_commande VALUES(1, 1, 1.00, 6.45);
INSERT INTO dcom_detail_commande VALUES(2, 2, 1.00, 1.23);
INSERT INTO dcom_detail_commande VALUES(3, 2, 2.00, 1.85);
INSERT INTO dcom_detail_commande VALUES(4, 3, 101.00, 2.25);
INSERT INTO dcom_detail_commande VALUES(5, 4, 10.00, 3.46);
INSERT INTO dcom_detail_commande VALUES(6, 4, 15.00, 33.00);
INSERT INTO dcom_detail_commande VALUES(7, 5, 12.00, 32.00);
INSERT INTO dcom_detail_commande VALUES(8, 3, 50.00, 1.12);
INSERT INTO dcom_detail_commande VALUES(9, 6, 10.00, 3.26);
INSERT INTO dcom_detail_commande VALUES(10, 7, 45.00, 12.00);
INSERT INTO dcom_detail_commande VALUES(11, 8, 45.00, 12.00);
INSERT INTO dcom_detail_commande VALUES(12, 9, 12.00, 45.32);
INSERT INTO dcom_detail_commande VALUES(13, 9, 10.00, 55.00);
INSERT INTO dcom_detail_commande VALUES(14, 10, 45.00, 12.00);
INSERT INTO dcom_detail_commande VALUES(15, 10, 33.00, 55.00);
INSERT INTO dcom_detail_commande VALUES(16, 11, 33.00, 2.23);
INSERT INTO dcom_detail_commande VALUES(17, 11, 20.00, 3.26);
INSERT INTO dcom_detail_commande VALUES(18, 12, 1.00, 12.00);

-- -----------------------------
-- insertions dans la table gpc_groupe_commande
-- -----------------------------
INSERT INTO gpc_groupe_commande VALUES(1, 32, 1, 0);
INSERT INTO gpc_groupe_commande VALUES(2, 33, 1, 0);
INSERT INTO gpc_groupe_commande VALUES(3, 33, 2, 0);
INSERT INTO gpc_groupe_commande VALUES(4, 34, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(5, 35, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(6, 31, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(7, 2, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(8, 3, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(21, 4, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(10, 5, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(11, 6, 1, 0);
INSERT INTO gpc_groupe_commande VALUES(12, 32, 4, 1);
INSERT INTO gpc_groupe_commande VALUES(13, 34, 4, 2);
INSERT INTO gpc_groupe_commande VALUES(14, 12, 1, 0);
INSERT INTO gpc_groupe_commande VALUES(15, 45, 5, 2);
INSERT INTO gpc_groupe_commande VALUES(16, 45, 6, 0);
INSERT INTO gpc_groupe_commande VALUES(18, 31, 6, 0);
INSERT INTO gpc_groupe_commande VALUES(22, 12, 6, 1);
INSERT INTO gpc_groupe_commande VALUES(23, 8, 1, 0);
INSERT INTO gpc_groupe_commande VALUES(26, 7, 1, 0);
INSERT INTO gpc_groupe_commande VALUES(27, 31, 3, 0);
INSERT INTO gpc_groupe_commande VALUES(28, 36, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(29, 45, 1, 1);
INSERT INTO gpc_groupe_commande VALUES(30, 25, 1, 1);

-- -----------------------------
-- insertions dans la table mod_module
-- -----------------------------
INSERT INTO mod_module VALUES(1, 'MonCompte', 'Compte', 1, 1, 0);
INSERT INTO mod_module VALUES(2, 'GestionAdherents', 'Gestion des Adherents', 0, 4, 1);
INSERT INTO mod_module VALUES(3, 'Commande', 'Marché', 1, 2, 0);
INSERT INTO mod_module VALUES(4, 'GestionCommande', 'Gestion des Marchés', 0, 3, 1);
INSERT INTO mod_module VALUES(5, 'GestionProducteur', 'Gestion des Producteurs', 0, 5, 1);
INSERT INTO mod_module VALUES(6, 'CompteZeybu', 'Le Compte du Zeybu', 0, 6, 1);
INSERT INTO mod_module VALUES(7, 'RechargementCompte', 'Recharger un compte', 0, 7, 1);

-- -----------------------------
-- insertions dans la table npro_nom_produit
-- -----------------------------
INSERT INTO npro_nom_produit VALUES(4, 'Pomme de Terre', '', 1);
INSERT INTO npro_nom_produit VALUES(3, 'Jambon', '', 1);
INSERT INTO npro_nom_produit VALUES(2, 'Salade', '', 1);
INSERT INTO npro_nom_produit VALUES(1, 'Oeuf', '', 1);
INSERT INTO npro_nom_produit VALUES(23, 'Viande', 'De Porc', 1);
INSERT INTO npro_nom_produit VALUES(22, 'Cerise', 'De Groupama', 1);
INSERT INTO npro_nom_produit VALUES(21, 'Tomate', '', 1);

-- -----------------------------
-- insertions dans la table ope_operation
-- -----------------------------
INSERT INTO ope_operation VALUES(1, 1, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(2, 2, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(3, 3, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(4, 4, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(5, 5, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(6, 6, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(7, 7, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(8, 8, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(9, 9, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(10, 10, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(11, 11, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(12, 12, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(13, 13, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(14, 14, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(15, 15, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(16, 16, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(17, 17, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(18, 18, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(19, 19, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(20, 20, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(21, 21, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(22, 22, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(23, 23, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(24, 24, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(25, 25, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(26, 26, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(27, 27, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(28, 28, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(29, 29, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(30, 30, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(31, 31, 0.00, 'Création du compte', 2010-11-28 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(32, 32, 0.00, 'Création du compte', 2010-11-29 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(33, 33, 0.00, 'Création du compte', 2010-11-29 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(34, 34, 0.00, 'Création du compte', 2010-11-29 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(35, 35, 0.00, 'Création du compte', 2010-11-29 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(36, 36, 0.00, 'Création du compte', 2010-11-29 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(37, 32, -16.60, 'Commande N°1', 2010-11-29 19:10:38, 0, '', 0, 1);
INSERT INTO ope_operation VALUES(38, 33, -16.60, 'Commande N°1', 2010-11-29 18:54:01, 0, '', 0, 1);
INSERT INTO ope_operation VALUES(39, 33, -4.46, 'Commande N°2', 2010-12-22 15:03:39, 0, '', 0, 2);
INSERT INTO ope_operation VALUES(139, 5, -3.70, 'Marché N°1', 2011-06-12 20:13:14, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(118, 35, -33.00, 'Marché N°1', 2011-06-12 18:13:54, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(42, 32, 25.00, 'Rechargement', 2010-11-29 19:10:38, 1, '', 1, 0);
INSERT INTO ope_operation VALUES(52, 32, 200.00, 'Rechargement', 2010-11-29 19:48:33, 1, '', 1, 0);
INSERT INTO ope_operation VALUES(43, 34, 50.00, 'Rechargement', 2010-11-29 19:15:33, 2, 'AZA15641', 1, 0);
INSERT INTO ope_operation VALUES(44, 31, -16.60, 'Marché N°1', 2010-11-29 19:41:09, 1, '', 1, 1);
INSERT INTO ope_operation VALUES(45, 2, -3.70, 'Marché N°1', 2011-02-06 16:22:20, 0, '', 1, 1);
INSERT INTO ope_operation VALUES(46, 3, -3.70, 'Marché N°1', 2011-01-26 15:13:45, 0, '', 1, 1);
INSERT INTO ope_operation VALUES(143, 4, -5.00, 'Marché N°1', 2011-06-12 20:17:26, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(141, 4, -2.46, 'Marché N°1', 2011-06-12 20:17:26, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(49, 6, -20.30, 'Marché N°1', 2011-06-05 14:12:36, 0, '', 0, 1);
INSERT INTO ope_operation VALUES(50, 31, 30.00, 'Rechargement', 2010-11-29 19:22:07, 1, '', 1, 0);
INSERT INTO ope_operation VALUES(53, 34, -96.00, 'Marché N°4', 2010-11-29 20:39:12, 0, '', 2, 4);
INSERT INTO ope_operation VALUES(51, 32, -128.00, 'Marché N°4', 2010-11-29 19:48:33, 1, '', 1, 4);
INSERT INTO ope_operation VALUES(54, 12, -6.45, 'Marché N°1', 2010-11-29 20:52:05, 0, '', 0, 1);
INSERT INTO ope_operation VALUES(55, 37, 0.00, 'Création du compte', 2010-12-22 19:23:11, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(56, 39, 0.00, 'Création du compte', 2010-12-23 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(57, 40, 0.00, 'Création du compte', 2010-12-23 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(58, 40, -50.00, 'Commande N°1', 2010-12-23 19:48:33, 1, '', 1, 1);
INSERT INTO ope_operation VALUES(59, 40, -66.00, 'Commande N°2', 2010-12-23 19:55:48, 2, 'CHQ12354534', 1, 2);
INSERT INTO ope_operation VALUES(60, 41, 0.00, 'Création du compte', 2010-12-24 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(61, 42, 0.00, 'Création du compte', 2010-12-24 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(62, 43, 0.00, 'Création du compte', 2010-12-24 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(63, 44, 0.00, 'Création du compte', 2010-12-24 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(64, 45, 0.00, 'Création du compte', 2010-12-25 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(65, 45, -24.00, 'Marché N°5', 2010-12-25 21:50:48, 0, '', 2, 5);
INSERT INTO ope_operation VALUES(66, 45, 50.00, 'test rechargement', 2010-12-25 21:53:39, 1, '', 1, 0);
INSERT INTO ope_operation VALUES(67, 45, -55.00, 'Marché N°6', 2011-01-26 11:19:37, 0, '', 0, 6);
INSERT INTO ope_operation VALUES(68, 40, 33.00, 'Bon de Commande', 2011-02-07 21:43:06, 5, '11', 3, 6);
INSERT INTO ope_operation VALUES(69, 39, 17.77, 'Bon de Commande', 2011-02-07 18:29:32, 5, '10', 3, 6);
INSERT INTO ope_operation VALUES(70, 40, 27.00, 'Bon de Commande', 2011-01-16 14:10:49, 5, '3', 3, 2);
INSERT INTO ope_operation VALUES(71, 40, 67.00, 'Bon de Commande', 2011-01-18 22:51:50, 5, '4', 3, 3);
INSERT INTO ope_operation VALUES(76, 40, 25.00, 'Bon de Livraison', 2011-02-07 21:42:44, 6, '11', 4, 6);
INSERT INTO ope_operation VALUES(77, 39, -24.24, 'Marché n°6', 2011-02-07 22:20:02, 2, 'CHQ1111', 1, 6);
INSERT INTO ope_operation VALUES(75, 39, 55.55, 'Bon de Livraison', 2011-02-07 22:20:02, 6, '10', 4, 6);
INSERT INTO ope_operation VALUES(78, 40, -42.43, 'Marché n°6', 2011-02-07 21:42:44, 2, 'CHQ412432', 1, 6);
INSERT INTO ope_operation VALUES(79, 40, -43.00, 'Marché n°3', 2011-01-25 21:21:45, 2, 'CHQ2342', 1, 3);
INSERT INTO ope_operation VALUES(102, 12, -22.00, 'Marché N°6', 2011-02-13 18:50:19, 7, '11', 1, 6);
INSERT INTO ope_operation VALUES(91, 40, 43.00, 'Bon de Livraison', 2011-01-25 21:21:45, 6, '4', 4, 3);
INSERT INTO ope_operation VALUES(93, 31, -15.26, 'Marché N°6', 2011-02-07 22:21:12, 0, '', 0, 6);
INSERT INTO ope_operation VALUES(94, 2, 20.00, 'Rechargement', 2011-02-06 16:22:20, 2, 'CHQ12324', 1, 0);
INSERT INTO ope_operation VALUES(98, 46, 0.00, 'Création du compte', 2011-02-06 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(99, 47, 0.00, 'Création du compte', 2011-02-06 00:00:00, -1, '', 1, 0);
INSERT INTO ope_operation VALUES(103, 12, -12.00, 'Marché Solidaire n°6', 2011-02-13 19:49:27, 8, '10', 1, 6);
INSERT INTO ope_operation VALUES(101, 12, -15.00, 'Marché N°6', 2011-02-13 18:50:19, 7, '10', 1, 6);
INSERT INTO ope_operation VALUES(104, 13, -13.00, 'Marché Solidaire n°6', 2011-02-13 19:49:27, 8, '10', 1, 6);
INSERT INTO ope_operation VALUES(105, 8, -6.45, 'Marché N°1', 2011-06-03 09:55:41, 0, '', 0, 1);
INSERT INTO ope_operation VALUES(108, 7, -16.59, 'Marché N°1', 2011-06-04 18:30:23, 0, '', 0, 1);
INSERT INTO ope_operation VALUES(109, 31, -10.38, 'Marché N°3', 2011-06-05 15:15:20, 0, '', 0, 3);
INSERT INTO ope_operation VALUES(110, 37, -33.00, 'Marché n°1', 2011-06-12 20:20:18, 1, '', 1, 1);
INSERT INTO ope_operation VALUES(111, 37, 33.00, 'Bon de Livraison', 2011-06-12 20:20:18, 6, '1', 4, 1);
INSERT INTO ope_operation VALUES(112, 39, -60.00, 'Marché n°1', 2011-06-05 21:45:42, 1, '', 1, 1);
INSERT INTO ope_operation VALUES(113, 39, 60.00, 'Bon de Livraison', 2011-06-05 21:45:42, 6, '2', 4, 1);
INSERT INTO ope_operation VALUES(114, 35, -12.90, 'Marché N°1', 2011-06-12 18:13:54, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(115, 35, -12.90, 'Marché N°1', 2011-06-12 18:13:54, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(116, 35, -4.92, 'Marché N°1', 2011-06-12 18:13:54, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(117, 35, -4.92, 'Marché N°1', 2011-06-12 18:13:54, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(119, 35, -22.00, 'Marché N°1', 2011-06-12 18:13:54, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(120, 35, 50.00, 'Rechargement', 2011-06-12 18:13:54, 1, '', 1, 0);
INSERT INTO ope_operation VALUES(126, 36, -10.00, 'Marché N°1', 2011-06-12 18:50:41, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(122, 36, -6.45, 'Marché N°1', 2011-06-12 18:50:41, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(123, 36, -6.45, 'Marché N°1', 2011-06-12 18:50:41, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(124, 36, -3.69, 'Marché N°1', 2011-06-12 18:50:41, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(125, 36, -3.69, 'Marché N°1', 2011-06-12 18:50:41, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(127, 36, 0.00, 'Marché N°1', 2011-06-12 18:50:41, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(128, 36, 30.00, 'Rechargement', 2011-06-12 18:50:41, 1, '', 1, 0);
INSERT INTO ope_operation VALUES(131, 45, -1.00, 'Marché N°1', 2011-06-12 19:00:48, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(130, 45, -6.45, 'Marché N°1', 2011-06-12 19:00:48, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(132, 34, -12.90, 'Marché N°1', 2011-06-12 19:03:13, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(133, 34, -12.90, 'Marché N°1', 2011-06-12 19:03:13, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(134, 34, -5.55, 'Marché N°1', 2011-06-12 19:03:13, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(135, 34, -5.55, 'Marché N°1', 2011-06-12 19:03:13, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(137, 25, -6.45, 'Marché N°1', 2011-06-12 19:05:32, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(138, 25, -12.00, 'Marché N°1', 2011-06-12 19:05:32, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(140, 5, -6.45, 'Marché N°1', 2011-06-12 20:13:14, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(142, 4, -12.90, 'Marché N°1', 2011-06-12 20:17:26, 7, '1', 1, 1);
INSERT INTO ope_operation VALUES(144, 4, -10.00, 'Marché N°1', 2011-06-12 20:17:26, 7, '2', 1, 1);
INSERT INTO ope_operation VALUES(145, 4, 7.00, 'Rechargement', 2011-06-12 20:17:26, 1, '', 1, 0);
INSERT INTO ope_operation VALUES(146, 12, 50.00, 'Rechargement', 2011-06-12 23:55:57, 1, '', 1, 0);
INSERT INTO ope_operation VALUES(147, 4, 33.00, 'Rechargement', 2011-06-12 23:56:53, 2, 'CHQ987654321', 1, 0);

-- -----------------------------
-- insertions dans la table prdt_producteur
-- -----------------------------
INSERT INTO prdt_producteur VALUES(4, '', 'P4', 39, 'SAEZ', 'Damien', '', '', '', '', '', '', '', 0000-00-00, 2010-12-23, 2010-12-23 17:42:08, '', 1);
INSERT INTO prdt_producteur VALUES(5, '', 'P5', 40, 'AMSTRONG', 'Claude', 'raton@gmail.fr', 'guenillon@gmail.fr', '0406060610', '0187561235', '55 avenue des rigolos', '84563', 'LE VIEUX', 2010-12-23, 0000-00-00, 2011-01-03 00:04:35, 'Ben c&#039;est un gentil producteur. Et oui.', 1);
INSERT INTO prdt_producteur VALUES(3, '', 'P3', 0, 'VIRGILE', 'Roro', '', '', '', '', '', '', '', 0000-00-00, 2010-12-23, 2010-12-23 14:44:06, '', 1);
INSERT INTO prdt_producteur VALUES(1, '01f01083386dc09d99826461b2b6c6f1', 'P1', 37, 'PIGNAULT', 'Guillaume', '', '', '', '', '', '', '', 0000-00-00, 0000-00-00, 0000-00-00 00:00:00, '', 1);
INSERT INTO prdt_producteur VALUES(2, '', 'P2', 0, 'PRODUCTEUR', 'Lacombe', 'marcel@vincent.fr', 'marcel@vincent.fr', '0687561235', '0687561235', '15 allée du vercors', '98235', 'PARIS PLAGE', 2010-12-22, 2010-12-23, 2010-12-23 14:21:43, 'Voici un commentaire', 1);
INSERT INTO prdt_producteur VALUES(6, '', 'P6', 47, 'A', 'Suppression', '', '', '', '', '', '', '', 0000-00-00, 2011-02-06, 2011-02-06 17:56:12, '', 2);

-- -----------------------------
-- insertions dans la table pro_produit
-- -----------------------------
INSERT INTO pro_produit VALUES(1, 1, 1, 'Douzaine', 2.00, 1);
INSERT INTO pro_produit VALUES(2, 1, 2, 'Unitée', 12.00, 4);
INSERT INTO pro_produit VALUES(3, 2, 3, 'g', 200.00, 5);
INSERT INTO pro_produit VALUES(4, 3, 4, 'Kg', 50.00, 5);
INSERT INTO pro_produit VALUES(5, 4, 3, 'Kg', 303.00, 4);
INSERT INTO pro_produit VALUES(6, 2, 4, 'Kg', 750.00, 4);
INSERT INTO pro_produit VALUES(7, 2, 1, 'Kg', 78.00, 1);
INSERT INTO pro_produit VALUES(8, 5, 3, 'Kg', 178.00, 4);
INSERT INTO pro_produit VALUES(9, 5, 4, 'Kg', 456.00, 4);
INSERT INTO pro_produit VALUES(10, 6, 4, 'Kg', 666.00, 4);
INSERT INTO pro_produit VALUES(11, 6, 2, 'g', 456.00, 5);
INSERT INTO pro_produit VALUES(12, 7, 3, 'Kg', 12.00, 4);

-- -----------------------------
-- insertions dans la table sto_stock
-- -----------------------------
INSERT INTO sto_stock VALUES(1, 2011-06-12 20:20:18, 200.00, 1, 0, 1, 1);
INSERT INTO sto_stock VALUES(2, 2011-06-05 21:45:42, 60.00, 1, 0, 2, 1);
INSERT INTO sto_stock VALUES(3, 2010-11-29 19:10:38, -2.00, 0, 32, 1, 0);
INSERT INTO sto_stock VALUES(5, 2010-11-29 19:10:38, -4.00, 0, 32, 3, 0);
INSERT INTO sto_stock VALUES(6, 2010-12-23 18:22:32, 1000.00, 0, 0, 8, 2);
INSERT INTO sto_stock VALUES(7, 2011-01-25 21:21:45, 32.00, 1, 0, 5, 3);
INSERT INTO sto_stock VALUES(8, 2010-11-29 18:54:01, -2.00, 0, 33, 1, 1);
INSERT INTO sto_stock VALUES(9, 2010-11-29 18:54:01, -4.00, 0, 33, 3, 1);
INSERT INTO sto_stock VALUES(10, 2010-12-22 15:03:39, -200.00, 0, 33, 4, 0);
INSERT INTO sto_stock VALUES(37, 2011-02-07 21:43:06, 76.00, 3, 0, 16, 0);
INSERT INTO sto_stock VALUES(106, 2011-06-12 19:03:13, -2.00, 1, 34, 1, 0);
INSERT INTO sto_stock VALUES(13, 2011-06-12 18:13:54, -2.00, 1, 35, 1, 0);
INSERT INTO sto_stock VALUES(14, 2011-06-12 18:13:54, -4.00, 1, 35, 2, 0);
INSERT INTO sto_stock VALUES(15, 2010-11-29 19:41:09, -2.00, 1, 31, 1, 0);
INSERT INTO sto_stock VALUES(16, 2010-11-29 19:41:09, -4.00, 1, 31, 2, 0);
INSERT INTO sto_stock VALUES(17, 2011-02-06 16:22:20, -4.00, 1, 2, 3, 0);
INSERT INTO sto_stock VALUES(18, 2011-01-26 15:13:45, -4.00, 1, 3, 3, 0);
INSERT INTO sto_stock VALUES(71, 2011-06-12 20:17:26, -2.00, 1, 4, 2, 0);
INSERT INTO sto_stock VALUES(20, 2011-06-12 20:13:14, -4.00, 1, 5, 3, 0);
INSERT INTO sto_stock VALUES(91, 2011-06-05 14:12:36, -8.00, 0, 6, 3, 0);
INSERT INTO sto_stock VALUES(22, 2010-11-29 19:45:19, 5050.00, 0, 0, 7, 4);
INSERT INTO sto_stock VALUES(23, 2010-11-29 19:48:33, -48.00, 1, 32, 7, 0);
INSERT INTO sto_stock VALUES(24, 2010-11-29 20:39:12, -36.00, 2, 34, 7, 4);
INSERT INTO sto_stock VALUES(25, 2010-11-29 20:52:05, -1.00, 0, 12, 1, 1);
INSERT INTO sto_stock VALUES(26, 2010-12-23 18:22:32, 750.00, 0, 0, 9, 2);
INSERT INTO sto_stock VALUES(27, 2010-12-23 18:22:32, 789.00, 0, 0, 10, 2);
INSERT INTO sto_stock VALUES(28, 2010-12-26 14:34:22, 789.00, 0, 0, 11, 5);
INSERT INTO sto_stock VALUES(29, 2010-12-25 21:50:48, -90.00, 2, 45, 11, 0);
INSERT INTO sto_stock VALUES(30, 2010-12-26 14:34:22, 789.00, 0, 0, 13, 5);
INSERT INTO sto_stock VALUES(31, 2011-02-07 22:20:53, 66666.00, 0, 0, 15, 6);
INSERT INTO sto_stock VALUES(32, 2011-02-07 22:20:53, 500.00, 0, 0, 17, 6);
INSERT INTO sto_stock VALUES(33, 2011-01-26 11:19:37, -33.00, 0, 45, 15, 0);
INSERT INTO sto_stock VALUES(72, 2011-02-07 22:21:12, -20.00, 0, 31, 17, 0);
INSERT INTO sto_stock VALUES(38, 2011-02-07 18:29:32, 14.44, 3, 0, 14, 0);
INSERT INTO sto_stock VALUES(39, 2011-01-16 14:10:49, 250.00, 3, 0, 4, 0);
INSERT INTO sto_stock VALUES(40, 2011-01-18 22:51:50, 45.00, 3, 0, 5, 0);
INSERT INTO sto_stock VALUES(45, 2011-02-07 21:42:44, 44.40, 4, 0, 16, 0);
INSERT INTO sto_stock VALUES(46, 2011-02-07 22:20:02, 11.11, 5, 0, 14, 0);
INSERT INTO sto_stock VALUES(61, 2011-01-25 21:21:45, 32.00, 4, 0, 5, 0);
INSERT INTO sto_stock VALUES(44, 2011-02-07 22:20:02, 66666.00, 4, 0, 14, 0);
INSERT INTO sto_stock VALUES(55, 2011-01-25 21:09:26, 13.00, 5, 0, 5, 0);
INSERT INTO sto_stock VALUES(64, 2011-02-07 22:21:12, -45.00, 0, 31, 14, 0);
INSERT INTO sto_stock VALUES(70, 2011-06-12 20:17:26, -2.00, 1, 4, 1, 0);
INSERT INTO sto_stock VALUES(73, 2011-02-13 18:50:19, -45.00, 1, 12, 14, 0);
INSERT INTO sto_stock VALUES(74, 2011-02-13 18:50:19, -15.00, 1, 12, 16, 0);
INSERT INTO sto_stock VALUES(75, 2011-02-13 19:25:00, -15.00, 5, 12, 14, 0);
INSERT INTO sto_stock VALUES(76, 2011-02-13 19:27:50, -10.00, 5, 11, 14, 0);
INSERT INTO sto_stock VALUES(77, 2011-06-01 21:54:00, 45.00, 0, 0, 18, 7);
INSERT INTO sto_stock VALUES(78, 2011-06-03 09:55:41, -1.00, 0, 8, 1, 1);
INSERT INTO sto_stock VALUES(90, 2011-06-04 18:30:23, -3.00, 0, 7, 2, 0);
INSERT INTO sto_stock VALUES(88, 2011-06-04 18:30:23, -2.00, 0, 7, 1, 0);
INSERT INTO sto_stock VALUES(92, 2011-06-05 14:12:36, -2.00, 0, 6, 1, 0);
INSERT INTO sto_stock VALUES(93, 2011-06-05 15:15:20, -30.00, 0, 31, 5, 3);
INSERT INTO sto_stock VALUES(94, 2011-06-12 20:20:18, 50.00, 5, 0, 1, 0);
INSERT INTO sto_stock VALUES(95, 2011-06-12 20:20:18, 200.00, 4, 0, 1, 0);
INSERT INTO sto_stock VALUES(96, 2011-06-05 21:45:42, 60.00, 5, 0, 2, 0);
INSERT INTO sto_stock VALUES(97, 2011-06-05 21:45:42, 60.00, 4, 0, 2, 0);
INSERT INTO sto_stock VALUES(98, 2011-06-12 18:13:54, -1.00, 5, 35, 1, 0);
INSERT INTO sto_stock VALUES(99, 2011-06-12 18:13:54, -2.00, 5, 35, 2, 0);
INSERT INTO sto_stock VALUES(100, 2011-06-12 18:50:41, -1.00, 1, 36, 1, 0);
INSERT INTO sto_stock VALUES(101, 2011-06-12 18:50:41, -3.00, 1, 36, 2, 0);
INSERT INTO sto_stock VALUES(102, 2011-06-12 18:50:41, -3.00, 5, 36, 1, 0);
INSERT INTO sto_stock VALUES(103, 2011-06-12 18:50:41, 0.00, 5, 36, 2, 0);
INSERT INTO sto_stock VALUES(104, 2011-06-12 19:00:48, -1.00, 1, 45, 1, 0);
INSERT INTO sto_stock VALUES(105, 2011-06-12 19:00:48, -1.00, 5, 45, 1, 0);
INSERT INTO sto_stock VALUES(107, 2011-06-12 19:03:13, -6.00, 1, 34, 3, 0);
INSERT INTO sto_stock VALUES(108, 2011-06-12 19:05:32, -1.00, 1, 25, 1, 0);
INSERT INTO sto_stock VALUES(109, 2011-06-12 19:05:32, -1.00, 1, 25, 2, 0);
INSERT INTO sto_stock VALUES(110, 2011-06-12 20:13:14, -1.00, 1, 5, 1, 0);
INSERT INTO sto_stock VALUES(111, 2011-06-12 20:17:26, -4.00, 5, 4, 1, 0);
INSERT INTO sto_stock VALUES(112, 2011-06-12 20:17:26, -3.00, 5, 4, 2, 0);

-- -----------------------------
-- insertions dans la table tpp_type_paiement
-- -----------------------------
INSERT INTO tpp_type_paiement VALUES(1, 'Espèces', 0, '', 1);
INSERT INTO tpp_type_paiement VALUES(2, 'Chèque', 1, 'Numéro', 1);
INSERT INTO tpp_type_paiement VALUES(3, 'Virement (émission)', 1, 'Id compte reception', 0);
INSERT INTO tpp_type_paiement VALUES(4, 'Virement (réception)', 1, 'Id compte émission', 0);
INSERT INTO tpp_type_paiement VALUES(5, 'Bon de Commande', 1, 'Id produit', 0);
INSERT INTO tpp_type_paiement VALUES(6, 'Bon de Livraison', 1, 'Id produit', 0);
INSERT INTO tpp_type_paiement VALUES(7, 'Achat', 1, 'Id produit', 0);
INSERT INTO tpp_type_paiement VALUES(8, 'Achat Solidaire', 1, 'Id produit', 0);

-- -----------------------------
-- insertions dans la table view_adherent
-- -----------------------------
INSERT INTO view_adherent VALUES(1, 'Z1', 31, 'C31', 'JALABERT', 'Bernard', 'bernard.jalabert@free.fr', '', '04.76.24.10.36', '', '8 rue de Belledonne', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 23:12:26, '', 13.40);
INSERT INTO view_adherent VALUES(2, 'Z2', 2, 'C2', 'ARDITO', 'Denise', 'pascal.ardito@free.fr', '', '09.53.86.42.51', '', '22 rue du Vercors', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2011-01-03 00:04:06, '', 16.30);
INSERT INTO view_adherent VALUES(3, 'Z3', 3, 'C3', 'BAR', 'Georges', 'georges.bar@laposte.net', '', '04.76.25.18.46', '', '4 place des Coulmes', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', -3.70);
INSERT INTO view_adherent VALUES(4, 'Z4', 4, 'C4', 'BENHAMOU', 'Robert', 'robert.benhamou@laposte.net', '', '04.76.24.66.50', '', '13 rue Louis Farçat', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 9.64);
INSERT INTO view_adherent VALUES(5, 'Z5', 5, 'C5', 'BERENGER', 'Gérard', 'ge.berenger@laposte.net', '', '04.76.25.51.09', '', '7 allée du Rachais', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', -10.15);
INSERT INTO view_adherent VALUES(6, 'Z6', 6, 'C6', 'BERENGER', 'Jocelyne', 'jocelyne.berenger@laposte.net', '', '04.76.25.51.09', '', '7 allée du Rachais', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(7, 'Z7', 7, 'C7', 'BUISSON', 'Marie-hélène', 'marie-helene38@hotmail.fr', '', '04.76.25.47.23', '', '15 allée du Gerbier', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(8, 'Z8', 8, 'C8', 'COQUET', 'Jean-paul', '', 'jp_coquet@yahoo.fr', '04.76.25.31.65', '', '55  rue des Javaux', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-12-27 18:03:19, '', 0.00);
INSERT INTO view_adherent VALUES(9, 'Z9', 9, 'C9', 'COQUET', 'Michelle', 'jp_coquet@yahoo.fr', '', '04.76.25.31.65', '', '55  rue des Javaux', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(10, 'Z10', 10, 'C10', 'CROZET', 'Béatrice', 'bc.crozet@orange.fr', '', '', '', '58 avenue Jean Jaurès', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-12-22 15:09:12, '', 0.00);
INSERT INTO view_adherent VALUES(11, 'Z11', 11, 'C11', 'DATHE', 'Suzanne', 'suzannedathe@hotmail.com', '', '04.76.14.07.42', '', '8 allée du Rachais', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(12, 'Z12', 12, 'C12', 'DERRAS', 'Danièle', 'zeybulonsanszemail@gmail.com', '', '04.76.25.48.58', '', '12 rue Denis Diderot', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Pas d&#039;Email', 1.00);
INSERT INTO view_adherent VALUES(13, 'Z13', 13, 'C13', 'DERRAS', 'Maurice', 'zeybulonsanszemail@gmail.com', '', '04.76.25.48.58', '', '12 rue Denis Diderot', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Pas d&#039;Email', -13.00);
INSERT INTO view_adherent VALUES(14, 'Z14', 14, 'C14', 'DESFORGES', 'Alain', 'desforges11@laposte.net', '', '04.76.18.28.41', '06.87.72.62.18', '10 allée du Gerbier', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(15, 'Z15', 15, 'C15', 'DESFORGES', 'Cécile', 'cec.desforges@free.fr', '', '04.76.18.28.41', '', '10 allée du Gerbier', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(16, 'Z16', 16, 'C16', 'DI NATALE', 'Emmanuelle', '', 'emmanuelle3438@gmail.com', '06.58.07.62.27', '', '2 place des Coulmes', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'N&#039;habite plus le quartier', 0.00);
INSERT INTO view_adherent VALUES(17, 'Z17', 17, 'C17', 'ESSOU', 'Yvonne', 'zeybulonsanszemail@gmail.com', '', '04.76.14.06.56', '', '', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Pas d&#039;Email', 0.00);
INSERT INTO view_adherent VALUES(18, 'Z18', 18, 'C18', 'FLORES', 'Madeleine', '', 'zeybulonsanszemail@gmail.com', '04.76.24.21.25', '', '58 avenue Jean Jaurès', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Ne souhaite pas réadhérer', 0.00);
INSERT INTO view_adherent VALUES(19, 'Z19', 19, 'C19', 'FONTE', 'Catherine', 'cat.fonte@orange.fr', '', '04.76.14.04.62', '', '7 rue Edmond Rostand', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(20, 'Z20', 20, 'C20', 'GARNIER', 'Béatrice', 'bagarnier@free.fr', '', '04.76.25.38.58', '', '20 rue Jean-Paul Sartre', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(21, 'Z21', 21, 'C21', 'GERVAIS', 'Guy', 'guymogerv@orange.fr', '', '04.76.25.77.88', '', '1 place des Tilleuls', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(22, 'Z22', 22, 'C22', 'GERVAIS', 'Monique', '', 'guymogerv@orange.fr', '', '', '1 place des Tilleuls', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(23, 'Z23', 23, 'C23', 'GUIGNIER', 'Anne', '', 'brunogaudin@wanadoo.fr', '04.76.01.86.30', '', '10 allée du Gerbier', '38320', 'EYBENS', 0000-00-00, 2009-10-16, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(24, 'Z24', 24, 'C24', 'HOLLANDE', 'Christiane', 'chollande@yahoo.fr', '', '04.76.25.29.40', '', '7 allée du Rachais', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(25, 'Z25', 25, 'C25', 'LOPPINET', 'Gisèle', 'gisou3834@yahoo.fr', '', '04.76.24.35.76', '06.71.31.84.23', '24 rue du Vercors', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', -18.45);
INSERT INTO view_adherent VALUES(26, 'Z26', 26, 'C26', 'MARCEL', 'Idalète', 'idaletem@hotmail.com', '', '04.76.62.34.99', '', '12 rue Anselme Bonneton', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(27, 'Z27', 27, 'C27', 'MARIOTTINI', 'Laetitia', 'sachalaetitia@neuf.fr', '', '04.76.54.34.08', '06.16.93.26.74', '10 rue de Belledonne', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(28, 'Z28', 28, 'C28', 'MARIOTTINI', 'Sacha', '', 'sachalaetitia@neuf.fr', '04.76.54.34.08', '06.16.93.26.74', '10 rue de Belledonne', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, '', 0.00);
INSERT INTO view_adherent VALUES(29, 'Z29', 29, 'C29', 'MASSON-DELAITRE', 'Georgette', 'zeybulonsanszemail@gmail.com', '', '04.56.45.66.29', '06.13.74.39.75', '8 place des Coulmes', '38320', 'EYBENS', 0000-00-00, 2009-07-02, 2010-11-28 20:23:47, 'Pas d&#039;Email', 0.00);
INSERT INTO view_adherent VALUES(30, 'Z30', 30, 'C30', 'MERLE', 'Agnès', '', '', '04.76.22.48.89', '', '27 rue Anatole France', '38100', 'GRENOBLE', 0000-00-00, 2009-07-02, 2010-11-28 20:23:48, '', 0.00);
INSERT INTO view_adherent VALUES(31, 'Z31', 32, 'C32', 'PIERRE', 'Jean-victor', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-12-22 20:38:56, '', 97.00);
INSERT INTO view_adherent VALUES(32, 'Z32', 32, 'C32', 'PIERRE', 'Marie-charlotte', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-12-22 20:39:26, '', 97.00);
INSERT INTO view_adherent VALUES(33, 'Z33', 33, 'C33', 'DESFORGES', 'Cécile', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:50:57, '', 0.00);
INSERT INTO view_adherent VALUES(34, 'Z34', 33, 'C33', 'DESFORGES', 'Alain', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:51:55, '', 0.00);
INSERT INTO view_adherent VALUES(35, 'Z35', 34, 'C34', 'DESFORGES', 'Ambre', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:52:48, '', 13.10);
INSERT INTO view_adherent VALUES(36, 'Z36', 34, 'C34', 'DESFORGES', 'Clovis', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:53:31, '', 13.10);
INSERT INTO view_adherent VALUES(37, 'Z37', 35, 'C35', 'GRANJON', 'Nicolas', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:54:36, '', -40.64);
INSERT INTO view_adherent VALUES(38, 'Z38', 35, 'C35', 'PETIT', 'Fabrice', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:55:10, '', -40.64);
INSERT INTO view_adherent VALUES(39, 'Z39', 36, 'C36', 'LINOSSIER', 'Jean-benoit', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:56:13, '', -0.28);
INSERT INTO view_adherent VALUES(40, 'Z40', 36, 'C36', 'LINOSSIER', 'Jocelyne', '', '', '', '', '', '', '', 0000-00-00, 2010-11-29, 2010-11-29 17:56:47, '', -0.28);
INSERT INTO view_adherent VALUES(41, 'Z41', 45, 'C45', 'PIERRE', 'Julien', '', '', '', '', '', '', '', 1986-01-31, 2010-12-25, 2010-12-25 17:09:37, '', 42.55);
INSERT INTO view_adherent VALUES(42, 'Z42', 46, 'C46', 'TOTO', 'Suppression', '', '', '', '', '', '', '', 0000-00-00, 2011-02-06, 2011-02-06 17:27:53, '', 0.00);

-- -----------------------------
-- insertions dans la table view_commande_complete_archive
-- -----------------------------
INSERT INTO view_commande_complete_archive VALUES(4, 4, '', '', 2010-11-30 01:00:00, 2010-11-30 03:00:00, 2010-11-29 23:00:00, 1, 5, 4, 3, 'Kg', 303.00, 4, 3, 'Jambon', '', 1, 7, 5, 12.00, 32.00);
INSERT INTO view_commande_complete_archive VALUES(5, 5, '', '', 2010-12-28 00:00:00, 2010-12-28 02:00:00, 2010-12-27 00:00:00, 1, 8, 5, 3, 'Kg', 178.00, 4, 3, 'Jambon', '', 1, 11, 8, 45.00, 12.00);
INSERT INTO view_commande_complete_archive VALUES(5, 5, '', '', 2010-12-28 00:00:00, 2010-12-28 02:00:00, 2010-12-27 00:00:00, 1, 9, 5, 4, 'Kg', 456.00, 4, 4, 'Pomme de Terre', '', 1, 12, 9, 12.00, 45.32);
INSERT INTO view_commande_complete_archive VALUES(5, 5, '', '', 2010-12-28 00:00:00, 2010-12-28 02:00:00, 2010-12-27 00:00:00, 1, 9, 5, 4, 'Kg', 456.00, 4, 4, 'Pomme de Terre', '', 1, 13, 9, 10.00, 55.00);
INSERT INTO view_commande_complete_archive VALUES(6, 6, '', '', 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1, 10, 6, 4, 'Kg', 666.00, 4, 4, 'Pomme de Terre', '', 1, 14, 10, 45.00, 12.00);
INSERT INTO view_commande_complete_archive VALUES(6, 6, '', '', 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1, 10, 6, 4, 'Kg', 666.00, 4, 4, 'Pomme de Terre', '', 1, 15, 10, 33.00, 55.00);
INSERT INTO view_commande_complete_archive VALUES(6, 6, '', '', 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1, 11, 6, 2, 'g', 456.00, 5, 2, 'Salade', '', 1, 16, 11, 33.00, 2.23);
INSERT INTO view_commande_complete_archive VALUES(6, 6, '', '', 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1, 11, 6, 2, 'g', 456.00, 5, 2, 'Salade', '', 1, 17, 11, 20.00, 3.26);

-- -----------------------------
-- insertions dans la table view_commande_complete_en_cours
-- -----------------------------
INSERT INTO view_commande_complete_en_cours VALUES(1, 1, '', '', 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0, 1, 1, 1, 'Douzaine', 2.00, 1, 1, 'Oeuf', '', 1, 1, 1, 1.00, 6.45);
INSERT INTO view_commande_complete_en_cours VALUES(1, 1, '', '', 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0, 2, 1, 2, 'Unitée', 12.00, 4, 2, 'Salade', '', 1, 2, 2, 1.00, 1.23);
INSERT INTO view_commande_complete_en_cours VALUES(1, 1, '', '', 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0, 2, 1, 2, 'Unitée', 12.00, 4, 2, 'Salade', '', 1, 3, 2, 2.00, 1.85);
INSERT INTO view_commande_complete_en_cours VALUES(2, 2, '', '', 2010-12-14 16:30:00, 2010-12-14 23:20:00, 2010-12-10 01:00:00, 0, 3, 2, 3, 'g', 200.00, 5, 3, 'Jambon', '', 1, 4, 3, 101.00, 2.25);
INSERT INTO view_commande_complete_en_cours VALUES(2, 2, '', '', 2010-12-14 16:30:00, 2010-12-14 23:20:00, 2010-12-10 01:00:00, 0, 3, 2, 3, 'g', 200.00, 5, 3, 'Jambon', '', 1, 8, 3, 50.00, 1.12);
INSERT INTO view_commande_complete_en_cours VALUES(3, 3, '', '', 2013-11-30 01:00:00, 2013-11-30 01:45:00, 2013-11-29 01:00:00, 0, 4, 3, 4, 'Kg', 50.00, 5, 4, 'Pomme de Terre', '', 1, 5, 4, 10.00, 3.46);
INSERT INTO view_commande_complete_en_cours VALUES(3, 3, '', '', 2013-11-30 01:00:00, 2013-11-30 01:45:00, 2013-11-29 01:00:00, 0, 4, 3, 4, 'Kg', 50.00, 5, 4, 'Pomme de Terre', '', 1, 6, 4, 15.00, 33.00);
INSERT INTO view_commande_complete_en_cours VALUES(2, 2, '', '', 2010-12-14 16:30:00, 2010-12-14 23:20:00, 2010-12-10 01:00:00, 0, 6, 2, 4, 'Kg', 750.00, 4, 4, 'Pomme de Terre', '', 1, 9, 6, 10.00, 3.26);
INSERT INTO view_commande_complete_en_cours VALUES(2, 2, '', '', 2010-12-14 16:30:00, 2010-12-14 23:20:00, 2010-12-10 01:00:00, 0, 7, 2, 1, 'Kg', 78.00, 1, 1, 'Oeuf', '', 1, 10, 7, 45.00, 12.00);
INSERT INTO view_commande_complete_en_cours VALUES(7, 7, '', '', 2011-06-16 00:00:00, 2011-06-16 01:00:00, 2011-06-02 00:00:00, 0, 12, 7, 3, 'Kg', 12.00, 4, 3, 'Jambon', '', 1, 18, 12, 1.00, 12.00);

-- -----------------------------
-- insertions dans la table view_compte_zeybu
-- -----------------------------
INSERT INTO view_compte_zeybu VALUES(-211.90);

-- -----------------------------
-- insertions dans la table view_compte_zeybu_caisse
-- -----------------------------
INSERT INTO view_compte_zeybu_caisse VALUES(154.40);

-- -----------------------------
-- insertions dans la table view_gestion_liste_commande_archive
-- -----------------------------
INSERT INTO view_gestion_liste_commande_archive VALUES(4, 4, 2010-11-29 23:00:00, 2010-11-30 01:00:00, 2010-11-30 03:00:00);
INSERT INTO view_gestion_liste_commande_archive VALUES(5, 5, 2010-12-27 00:00:00, 2010-12-28 00:00:00, 2010-12-28 02:00:00);
INSERT INTO view_gestion_liste_commande_archive VALUES(6, 6, 2011-12-30 00:00:00, 2011-12-31 00:00:00, 2011-12-31 06:00:00);

-- -----------------------------
-- insertions dans la table view_gestion_liste_commande_en_cours
-- -----------------------------
INSERT INTO view_gestion_liste_commande_en_cours VALUES(2, 2, 2010-12-10 01:00:00, 2010-12-14 16:30:00, 2010-12-14 23:20:00);
INSERT INTO view_gestion_liste_commande_en_cours VALUES(7, 7, 2011-06-02 00:00:00, 2011-06-16 00:00:00, 2011-06-16 01:00:00);
INSERT INTO view_gestion_liste_commande_en_cours VALUES(3, 3, 2013-11-29 01:00:00, 2013-11-30 01:00:00, 2013-11-30 01:45:00);
INSERT INTO view_gestion_liste_commande_en_cours VALUES(1, 1, 2012-02-06 17:00:00, 2015-12-10 18:30:00, 2015-12-10 19:45:00);

-- -----------------------------
-- insertions dans la table view_identification
-- -----------------------------
INSERT INTO view_identification VALUES(0, 0, 'julien', '01f01083386dc09d99826461b2b6c6f1', '', 1);
INSERT INTO view_identification VALUES(1, 31, 'Z1', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(1, 31, 'Z1', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(2, 2, 'Z2', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(2, 2, 'Z2', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(3, 3, 'Z3', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(3, 3, 'Z3', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(4, 4, 'Z4', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(4, 4, 'Z4', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(5, 5, 'Z5', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(5, 5, 'Z5', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(6, 6, 'Z6', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(6, 6, 'Z6', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(7, 7, 'Z7', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(7, 7, 'Z7', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(8, 8, 'Z8', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(8, 8, 'Z8', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(9, 9, 'Z9', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(9, 9, 'Z9', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(10, 10, 'Z10', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(10, 10, 'Z10', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(11, 11, 'Z11', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(11, 11, 'Z11', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(12, 12, 'Z12', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(12, 12, 'Z12', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(13, 13, 'Z13', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(13, 13, 'Z13', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(14, 14, 'Z14', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(14, 14, 'Z14', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(15, 15, 'Z15', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(15, 15, 'Z15', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(16, 16, 'Z16', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(16, 16, 'Z16', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(17, 17, 'Z17', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(17, 17, 'Z17', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(18, 18, 'Z18', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(18, 18, 'Z18', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(19, 19, 'Z19', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(19, 19, 'Z19', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(20, 20, 'Z20', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(20, 20, 'Z20', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(21, 21, 'Z21', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(21, 21, 'Z21', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(22, 22, 'Z22', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(22, 22, 'Z22', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(23, 23, 'Z23', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(23, 23, 'Z23', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(24, 24, 'Z24', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(24, 24, 'Z24', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(25, 25, 'Z25', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(25, 25, 'Z25', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(26, 26, 'Z26', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(26, 26, 'Z26', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(27, 27, 'Z27', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(27, 27, 'Z27', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(28, 28, 'Z28', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(28, 28, 'Z28', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(29, 29, 'Z29', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(29, 29, 'Z29', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(30, 30, 'Z30', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(30, 30, 'Z30', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(31, 32, 'Z31', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(31, 32, 'Z31', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(31, 32, 'Z31', '01f01083386dc09d99826461b2b6c6f1', 'GestionCommande', 0);
INSERT INTO view_identification VALUES(32, 32, 'Z32', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(32, 32, 'Z32', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(32, 32, 'Z32', '01f01083386dc09d99826461b2b6c6f1', 'GestionProducteur', 0);
INSERT INTO view_identification VALUES(33, 33, 'Z33', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(33, 33, 'Z33', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(34, 33, 'Z34', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(34, 33, 'Z34', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(35, 34, 'Z35', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(35, 34, 'Z35', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(36, 34, 'Z36', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(36, 34, 'Z36', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(37, 35, 'Z37', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(37, 35, 'Z37', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(38, 35, 'Z38', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(38, 35, 'Z38', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(39, 36, 'Z39', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(39, 36, 'Z39', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(40, 36, 'Z40', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(40, 36, 'Z40', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(41, 45, 'Z41', '01f01083386dc09d99826461b2b6c6f1', 'MonCompte', 0);
INSERT INTO view_identification VALUES(41, 45, 'Z41', '01f01083386dc09d99826461b2b6c6f1', 'Commande', 0);
INSERT INTO view_identification VALUES(41, 45, 'Z41', '01f01083386dc09d99826461b2b6c6f1', 'GestionCommande', 0);
INSERT INTO view_identification VALUES(41, 45, 'Z41', '01f01083386dc09d99826461b2b6c6f1', 'GestionAdherents', 0);
INSERT INTO view_identification VALUES(41, 45, 'Z41', '01f01083386dc09d99826461b2b6c6f1', 'GestionProducteur', 0);
INSERT INTO view_identification VALUES(41, 45, 'Z41', '01f01083386dc09d99826461b2b6c6f1', 'CompteZeybu', 0);

-- -----------------------------
-- insertions dans la table view_info_bon_commande
-- -----------------------------
INSERT INTO view_info_bon_commande VALUES(2, 5, 3, 'g', 'Jambon', 27.00, 250.00, 'AMSTRONG', 'Claude');
INSERT INTO view_info_bon_commande VALUES(3, 5, 4, 'Kg', 'Pomme de Terre', 67.00, 45.00, 'AMSTRONG', 'Claude');

-- -----------------------------
-- insertions dans la table view_info_bon_livraison
-- -----------------------------
INSERT INTO view_info_bon_livraison VALUES(2, 5, 3, 'g', 'Jambon', 27.00, 250.00, 'AMSTRONG', 'Claude', , , );
INSERT INTO view_info_bon_livraison VALUES(3, 5, 4, 'Kg', 'Pomme de Terre', 67.00, 45.00, 'AMSTRONG', 'Claude', 43.00, 32.00, 13.00);

-- -----------------------------
-- insertions dans la table view_info_commande
-- -----------------------------
INSERT INTO view_info_commande VALUES(1, 1, 1, 'Douzaine', 'Oeuf', , , 33.00, 200.00, 41.00, 12.00, 9.00, 145.75, );
INSERT INTO view_info_commande VALUES(1, 4, 2, 'Unitée', 'Salade', , , 60.00, 60.00, 55.00, 32.00, 5.00, 78.48, );
INSERT INTO view_info_commande VALUES(2, 5, 3, 'g', 'Jambon', 27.00, 250.00, , , , , , , );
INSERT INTO view_info_commande VALUES(3, 5, 4, 'Kg', 'Pomme de Terre', 67.00, 45.00, 43.00, 32.00, 13.00, , , , );
INSERT INTO view_info_commande VALUES(4, 4, 5, 'Kg', 'Jambon', , , , , , 48.00, , , );
INSERT INTO view_info_commande VALUES(2, 4, 6, 'Kg', 'Pomme de Terre', , , , , , , , , );
INSERT INTO view_info_commande VALUES(2, 1, 7, 'Kg', 'Oeuf', , , , , , , , , );
INSERT INTO view_info_commande VALUES(5, 4, 8, 'Kg', 'Jambon', , , , , , , , , );
INSERT INTO view_info_commande VALUES(5, 4, 9, 'Kg', 'Pomme de Terre', , , , , , , , , );
INSERT INTO view_info_commande VALUES(6, 4, 10, 'Kg', 'Pomme de Terre', , 14.44, , 66666.00, -13.89, 45.00, 25.00, 15.00, 25.00);
INSERT INTO view_info_commande VALUES(6, 5, 11, 'g', 'Salade', , 76.00, , 44.40, , 15.00, , 22.00, );
INSERT INTO view_info_commande VALUES(7, 4, 12, 'Kg', 'Jambon', , , , , , , , , );

-- -----------------------------
-- insertions dans la table view_liste_adherent
-- -----------------------------
INSERT INTO view_liste_adherent VALUES(1, 'Z1', 'JALABERT', 'Bernard', 'bernard.jalabert@free.fr', 13.40);
INSERT INTO view_liste_adherent VALUES(2, 'Z2', 'ARDITO', 'Denise', 'pascal.ardito@free.fr', 16.30);
INSERT INTO view_liste_adherent VALUES(3, 'Z3', 'BAR', 'Georges', 'georges.bar@laposte.net', -3.70);
INSERT INTO view_liste_adherent VALUES(4, 'Z4', 'BENHAMOU', 'Robert', 'robert.benhamou@laposte.net', 9.64);
INSERT INTO view_liste_adherent VALUES(5, 'Z5', 'BERENGER', 'Gérard', 'ge.berenger@laposte.net', -10.15);
INSERT INTO view_liste_adherent VALUES(6, 'Z6', 'BERENGER', 'Jocelyne', 'jocelyne.berenger@laposte.net', 0.00);
INSERT INTO view_liste_adherent VALUES(7, 'Z7', 'BUISSON', 'Marie-hélène', 'marie-helene38@hotmail.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(8, 'Z8', 'COQUET', 'Jean-paul', '', 0.00);
INSERT INTO view_liste_adherent VALUES(9, 'Z9', 'COQUET', 'Michelle', 'jp_coquet@yahoo.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(10, 'Z10', 'CROZET', 'Béatrice', 'bc.crozet@orange.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(11, 'Z11', 'DATHE', 'Suzanne', 'suzannedathe@hotmail.com', 0.00);
INSERT INTO view_liste_adherent VALUES(12, 'Z12', 'DERRAS', 'Danièle', 'zeybulonsanszemail@gmail.com', 1.00);
INSERT INTO view_liste_adherent VALUES(13, 'Z13', 'DERRAS', 'Maurice', 'zeybulonsanszemail@gmail.com', -13.00);
INSERT INTO view_liste_adherent VALUES(14, 'Z14', 'DESFORGES', 'Alain', 'desforges11@laposte.net', 0.00);
INSERT INTO view_liste_adherent VALUES(15, 'Z15', 'DESFORGES', 'Cécile', 'cec.desforges@free.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(16, 'Z16', 'DI NATALE', 'Emmanuelle', '', 0.00);
INSERT INTO view_liste_adherent VALUES(17, 'Z17', 'ESSOU', 'Yvonne', 'zeybulonsanszemail@gmail.com', 0.00);
INSERT INTO view_liste_adherent VALUES(18, 'Z18', 'FLORES', 'Madeleine', '', 0.00);
INSERT INTO view_liste_adherent VALUES(19, 'Z19', 'FONTE', 'Catherine', 'cat.fonte@orange.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(20, 'Z20', 'GARNIER', 'Béatrice', 'bagarnier@free.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(21, 'Z21', 'GERVAIS', 'Guy', 'guymogerv@orange.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(22, 'Z22', 'GERVAIS', 'Monique', '', 0.00);
INSERT INTO view_liste_adherent VALUES(23, 'Z23', 'GUIGNIER', 'Anne', '', 0.00);
INSERT INTO view_liste_adherent VALUES(24, 'Z24', 'HOLLANDE', 'Christiane', 'chollande@yahoo.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(25, 'Z25', 'LOPPINET', 'Gisèle', 'gisou3834@yahoo.fr', -18.45);
INSERT INTO view_liste_adherent VALUES(26, 'Z26', 'MARCEL', 'Idalète', 'idaletem@hotmail.com', 0.00);
INSERT INTO view_liste_adherent VALUES(27, 'Z27', 'MARIOTTINI', 'Laetitia', 'sachalaetitia@neuf.fr', 0.00);
INSERT INTO view_liste_adherent VALUES(28, 'Z28', 'MARIOTTINI', 'Sacha', '', 0.00);
INSERT INTO view_liste_adherent VALUES(29, 'Z29', 'MASSON-DELAITRE', 'Georgette', 'zeybulonsanszemail@gmail.com', 0.00);
INSERT INTO view_liste_adherent VALUES(30, 'Z30', 'MERLE', 'Agnès', '', 0.00);
INSERT INTO view_liste_adherent VALUES(31, 'Z31', 'PIERRE', 'Jean-victor', '', 97.00);
INSERT INTO view_liste_adherent VALUES(32, 'Z32', 'PIERRE', 'Marie-charlotte', '', 97.00);
INSERT INTO view_liste_adherent VALUES(33, 'Z33', 'DESFORGES', 'Cécile', '', 0.00);
INSERT INTO view_liste_adherent VALUES(34, 'Z34', 'DESFORGES', 'Alain', '', 0.00);
INSERT INTO view_liste_adherent VALUES(35, 'Z35', 'DESFORGES', 'Ambre', '', 13.10);
INSERT INTO view_liste_adherent VALUES(36, 'Z36', 'DESFORGES', 'Clovis', '', 13.10);
INSERT INTO view_liste_adherent VALUES(37, 'Z37', 'GRANJON', 'Nicolas', '', -40.64);
INSERT INTO view_liste_adherent VALUES(38, 'Z38', 'PETIT', 'Fabrice', '', -40.64);
INSERT INTO view_liste_adherent VALUES(39, 'Z39', 'LINOSSIER', 'Jean-benoit', '', -0.28);
INSERT INTO view_liste_adherent VALUES(40, 'Z40', 'LINOSSIER', 'Jocelyne', '', -0.28);
INSERT INTO view_liste_adherent VALUES(41, 'Z41', 'PIERRE', 'Julien', '', 42.55);

-- -----------------------------
-- insertions dans la table view_liste_adherent_commande
-- -----------------------------
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 31, 'Z31', 'C32', 'PIERRE', 'Jean-victor');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 32, 'Z32', 'C32', 'PIERRE', 'Marie-charlotte');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 33, 'Z33', 'C33', 'DESFORGES', 'Cécile');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 34, 'Z34', 'C33', 'DESFORGES', 'Alain');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 35, 'Z35', 'C34', 'DESFORGES', 'Ambre');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 36, 'Z36', 'C34', 'DESFORGES', 'Clovis');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 37, 'Z37', 'C35', 'GRANJON', 'Nicolas');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 38, 'Z38', 'C35', 'PETIT', 'Fabrice');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 1, 'Z1', 'C31', 'JALABERT', 'Bernard');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 2, 'Z2', 'C2', 'ARDITO', 'Denise');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 3, 'Z3', 'C3', 'BAR', 'Georges');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 4, 'Z4', 'C4', 'BENHAMOU', 'Robert');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 5, 'Z5', 'C5', 'BERENGER', 'Gérard');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 6, 'Z6', 'C6', 'BERENGER', 'Jocelyne');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 12, 'Z12', 'C12', 'DERRAS', 'Danièle');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 8, 'Z8', 'C8', 'COQUET', 'Jean-paul');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 7, 'Z7', 'C7', 'BUISSON', 'Marie-hélène');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 39, 'Z39', 'C36', 'LINOSSIER', 'Jean-benoit');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 40, 'Z40', 'C36', 'LINOSSIER', 'Jocelyne');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 41, 'Z41', 'C45', 'PIERRE', 'Julien');
INSERT INTO view_liste_adherent_commande VALUES(1, 1, 25, 'Z25', 'C25', 'LOPPINET', 'Gisèle');
INSERT INTO view_liste_adherent_commande VALUES(2, 2, 33, 'Z33', 'C33', 'DESFORGES', 'Cécile');
INSERT INTO view_liste_adherent_commande VALUES(2, 2, 34, 'Z34', 'C33', 'DESFORGES', 'Alain');
INSERT INTO view_liste_adherent_commande VALUES(3, 3, 1, 'Z1', 'C31', 'JALABERT', 'Bernard');
INSERT INTO view_liste_adherent_commande VALUES(4, 4, 31, 'Z31', 'C32', 'PIERRE', 'Jean-victor');
INSERT INTO view_liste_adherent_commande VALUES(4, 4, 32, 'Z32', 'C32', 'PIERRE', 'Marie-charlotte');
INSERT INTO view_liste_adherent_commande VALUES(4, 4, 35, 'Z35', 'C34', 'DESFORGES', 'Ambre');
INSERT INTO view_liste_adherent_commande VALUES(4, 4, 36, 'Z36', 'C34', 'DESFORGES', 'Clovis');
INSERT INTO view_liste_adherent_commande VALUES(5, 5, 41, 'Z41', 'C45', 'PIERRE', 'Julien');
INSERT INTO view_liste_adherent_commande VALUES(6, 6, 41, 'Z41', 'C45', 'PIERRE', 'Julien');
INSERT INTO view_liste_adherent_commande VALUES(6, 6, 1, 'Z1', 'C31', 'JALABERT', 'Bernard');
INSERT INTO view_liste_adherent_commande VALUES(6, 6, 12, 'Z12', 'C12', 'DERRAS', 'Danièle');

-- -----------------------------
-- insertions dans la table view_liste_adherent_commande_reservation
-- -----------------------------
INSERT INTO view_liste_adherent_commande_reservation VALUES(1, 1, 31, 'Z31', 'C32', 'PIERRE', 'Jean-victor');
INSERT INTO view_liste_adherent_commande_reservation VALUES(1, 1, 32, 'Z32', 'C32', 'PIERRE', 'Marie-charlotte');
INSERT INTO view_liste_adherent_commande_reservation VALUES(1, 1, 33, 'Z33', 'C33', 'DESFORGES', 'Cécile');
INSERT INTO view_liste_adherent_commande_reservation VALUES(1, 1, 34, 'Z34', 'C33', 'DESFORGES', 'Alain');
INSERT INTO view_liste_adherent_commande_reservation VALUES(1, 1, 6, 'Z6', 'C6', 'BERENGER', 'Jocelyne');
INSERT INTO view_liste_adherent_commande_reservation VALUES(1, 1, 12, 'Z12', 'C12', 'DERRAS', 'Danièle');
INSERT INTO view_liste_adherent_commande_reservation VALUES(1, 1, 8, 'Z8', 'C8', 'COQUET', 'Jean-paul');
INSERT INTO view_liste_adherent_commande_reservation VALUES(1, 1, 7, 'Z7', 'C7', 'BUISSON', 'Marie-hélène');
INSERT INTO view_liste_adherent_commande_reservation VALUES(2, 2, 33, 'Z33', 'C33', 'DESFORGES', 'Cécile');
INSERT INTO view_liste_adherent_commande_reservation VALUES(2, 2, 34, 'Z34', 'C33', 'DESFORGES', 'Alain');
INSERT INTO view_liste_adherent_commande_reservation VALUES(3, 3, 1, 'Z1', 'C31', 'JALABERT', 'Bernard');
INSERT INTO view_liste_adherent_commande_reservation VALUES(6, 6, 41, 'Z41', 'C45', 'PIERRE', 'Julien');
INSERT INTO view_liste_adherent_commande_reservation VALUES(6, 6, 1, 'Z1', 'C31', 'JALABERT', 'Bernard');

-- -----------------------------
-- insertions dans la table view_liste_commande_archive
-- -----------------------------
INSERT INTO view_liste_commande_archive VALUES(2, 2, 2010-12-10 01:00:00, 2010-12-14 16:30:00, 2010-12-14 23:20:00);
INSERT INTO view_liste_commande_archive VALUES(4, 4, 2010-11-29 23:00:00, 2010-11-30 01:00:00, 2010-11-30 03:00:00);
INSERT INTO view_liste_commande_archive VALUES(5, 5, 2010-12-27 00:00:00, 2010-12-28 00:00:00, 2010-12-28 02:00:00);
INSERT INTO view_liste_commande_archive VALUES(6, 6, 2011-12-30 00:00:00, 2011-12-31 00:00:00, 2011-12-31 06:00:00);
INSERT INTO view_liste_commande_archive VALUES(7, 7, 2011-06-02 00:00:00, 2011-06-16 00:00:00, 2011-06-16 01:00:00);

-- -----------------------------
-- insertions dans la table view_liste_commande_en_cours
-- -----------------------------
INSERT INTO view_liste_commande_en_cours VALUES(1, 1, 2012-02-06 17:00:00, 2015-12-10 18:30:00, 2015-12-10 19:45:00);
INSERT INTO view_liste_commande_en_cours VALUES(3, 3, 2013-11-29 01:00:00, 2013-11-30 01:00:00, 2013-11-30 01:45:00);

-- -----------------------------
-- insertions dans la table view_liste_producteur_commande
-- -----------------------------
INSERT INTO view_liste_producteur_commande VALUES(2, 5, 'AMSTRONG', 'Claude');
INSERT INTO view_liste_producteur_commande VALUES(3, 5, 'AMSTRONG', 'Claude');
INSERT INTO view_liste_producteur_commande VALUES(1, 1, 'PIGNAULT', 'Guillaume');
INSERT INTO view_liste_producteur_commande VALUES(2, 1, 'PIGNAULT', 'Guillaume');
INSERT INTO view_liste_producteur_commande VALUES(7, 4, 'SAEZ', 'Damien');
INSERT INTO view_liste_producteur_commande VALUES(1, 4, 'SAEZ', 'Damien');
INSERT INTO view_liste_producteur_commande VALUES(2, 4, 'SAEZ', 'Damien');

-- -----------------------------
-- insertions dans la table view_liste_reservation_archive
-- -----------------------------
INSERT INTO view_liste_reservation_archive VALUES(33, 'Z33', 33, 0, 2, 2, 2010-12-14 16:30:00, 2010-12-14 23:20:00, 2010-12-10 01:00:00, 0);
INSERT INTO view_liste_reservation_archive VALUES(34, 'Z34', 33, 0, 2, 2, 2010-12-14 16:30:00, 2010-12-14 23:20:00, 2010-12-10 01:00:00, 0);
INSERT INTO view_liste_reservation_archive VALUES(35, 'Z35', 34, 0, 4, 4, 2010-11-30 01:00:00, 2010-11-30 03:00:00, 2010-11-29 23:00:00, 1);
INSERT INTO view_liste_reservation_archive VALUES(36, 'Z36', 34, 0, 4, 4, 2010-11-30 01:00:00, 2010-11-30 03:00:00, 2010-11-29 23:00:00, 1);
INSERT INTO view_liste_reservation_archive VALUES(31, 'Z31', 32, 0, 4, 4, 2010-11-30 01:00:00, 2010-11-30 03:00:00, 2010-11-29 23:00:00, 1);
INSERT INTO view_liste_reservation_archive VALUES(32, 'Z32', 32, 0, 4, 4, 2010-11-30 01:00:00, 2010-11-30 03:00:00, 2010-11-29 23:00:00, 1);
INSERT INTO view_liste_reservation_archive VALUES(41, 'Z41', 45, 0, 5, 5, 2010-12-28 00:00:00, 2010-12-28 02:00:00, 2010-12-27 00:00:00, 1);
INSERT INTO view_liste_reservation_archive VALUES(12, 'Z12', 12, 0, 6, 6, 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1);
INSERT INTO view_liste_reservation_archive VALUES(12, 'Z12', 12, 0, 6, 6, 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1);
INSERT INTO view_liste_reservation_archive VALUES(12, 'Z12', 12, 0, 6, 6, 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1);
INSERT INTO view_liste_reservation_archive VALUES(13, 'Z13', 13, 0, 6, 6, 2011-12-31 00:00:00, 2011-12-31 06:00:00, 2011-12-30 00:00:00, 1);

-- -----------------------------
-- insertions dans la table view_liste_reservation_en_cours
-- -----------------------------
INSERT INTO view_liste_reservation_en_cours VALUES(1, 'Z1', 31, 0, 3, 3, 2013-11-30 01:00:00, 2013-11-30 01:45:00, 2013-11-29 01:00:00, 0);
INSERT INTO view_liste_reservation_en_cours VALUES(31, 'Z31', 32, 0, 1, 1, 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);
INSERT INTO view_liste_reservation_en_cours VALUES(32, 'Z32', 32, 0, 1, 1, 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);
INSERT INTO view_liste_reservation_en_cours VALUES(33, 'Z33', 33, 0, 1, 1, 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);
INSERT INTO view_liste_reservation_en_cours VALUES(34, 'Z34', 33, 0, 1, 1, 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);
INSERT INTO view_liste_reservation_en_cours VALUES(6, 'Z6', 6, 0, 1, 1, 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);
INSERT INTO view_liste_reservation_en_cours VALUES(12, 'Z12', 12, 0, 1, 1, 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);
INSERT INTO view_liste_reservation_en_cours VALUES(8, 'Z8', 8, 0, 1, 1, 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);
INSERT INTO view_liste_reservation_en_cours VALUES(7, 'Z7', 7, 0, 1, 1, 2015-12-10 18:30:00, 2015-12-10 19:45:00, 2012-02-06 17:00:00, 0);

-- -----------------------------
-- insertions dans la table view_menu
-- -----------------------------
INSERT INTO view_menu VALUES(0, 1, , '', '', );
INSERT INTO view_menu VALUES(13, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(35, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(4, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(27, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(18, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(9, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(40, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(23, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(14, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(36, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(5, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(28, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(19, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(10, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(41, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(1, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(24, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(15, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(37, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(6, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(29, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(20, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(11, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(33, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(2, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(25, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(16, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(7, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(38, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(30, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(21, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(32, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(12, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(34, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(3, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(26, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(17, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(8, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(39, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(31, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(22, 0, 1, 'MonCompte', 'Compte', 0);
INSERT INTO view_menu VALUES(1, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(24, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(15, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(6, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(37, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(29, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(20, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(11, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(33, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(2, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(25, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(16, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(7, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(38, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(30, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(21, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(32, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(12, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(34, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(3, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(26, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(17, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(8, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(39, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(31, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(22, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(13, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(35, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(4, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(27, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(18, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(9, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(40, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(23, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(14, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(36, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(5, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(28, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(19, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(10, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(41, 0, 3, 'Commande', 'Marché', 0);
INSERT INTO view_menu VALUES(31, 0, 4, 'GestionCommande', 'Gestion des Marchés', 1);
INSERT INTO view_menu VALUES(41, 0, 4, 'GestionCommande', 'Gestion des Marchés', 1);
INSERT INTO view_menu VALUES(41, 0, 2, 'GestionAdherents', 'Gestion des Adherents', 1);
INSERT INTO view_menu VALUES(32, 0, 5, 'GestionProducteur', 'Gestion des Producteurs', 1);
INSERT INTO view_menu VALUES(41, 0, 5, 'GestionProducteur', 'Gestion des Producteurs', 1);
INSERT INTO view_menu VALUES(41, 0, 6, 'CompteZeybu', 'Le Compte du Zeybu', 1);

-- -----------------------------
-- insertions dans la table view_operation_achat
-- -----------------------------
INSERT INTO view_operation_achat VALUES(1, 1, 1, 118, -145.75);
INSERT INTO view_operation_achat VALUES(1, 4, 2, 139, -78.48);
INSERT INTO view_operation_achat VALUES(6, 4, 10, 101, -15.00);
INSERT INTO view_operation_achat VALUES(6, 5, 11, 102, -22.00);

-- -----------------------------
-- insertions dans la table view_operation_achat_solidaire
-- -----------------------------
INSERT INTO view_operation_achat_solidaire VALUES(6, 4, 10, 103, -25.00);

-- -----------------------------
-- insertions dans la table view_operation_avenir
-- -----------------------------
INSERT INTO view_operation_avenir VALUES(33, -4.46, 'Commande N°2', 2010-12-22 15:03:39, 2010-12-14 16:30:00, '', , '', '');
INSERT INTO view_operation_avenir VALUES(31, -10.38, 'Marché N°3', 2011-06-05 15:15:20, 2013-11-30 01:00:00, '', , '', '');
INSERT INTO view_operation_avenir VALUES(32, -16.60, 'Commande N°1', 2010-11-29 19:10:38, 2015-12-10 18:30:00, '', , '', '');
INSERT INTO view_operation_avenir VALUES(33, -16.60, 'Commande N°1', 2010-11-29 18:54:01, 2015-12-10 18:30:00, '', , '', '');
INSERT INTO view_operation_avenir VALUES(6, -20.30, 'Marché N°1', 2011-06-05 14:12:36, 2015-12-10 18:30:00, '', , '', '');
INSERT INTO view_operation_avenir VALUES(12, -6.45, 'Marché N°1', 2010-11-29 20:52:05, 2015-12-10 18:30:00, '', , '', '');
INSERT INTO view_operation_avenir VALUES(8, -6.45, 'Marché N°1', 2011-06-03 09:55:41, 2015-12-10 18:30:00, '', , '', '');
INSERT INTO view_operation_avenir VALUES(7, -16.59, 'Marché N°1', 2011-06-04 18:30:23, 2015-12-10 18:30:00, '', , '', '');

-- -----------------------------
-- insertions dans la table view_operation_bon_livraison
-- -----------------------------
INSERT INTO view_operation_bon_livraison VALUES(1, 1, 1, 111, 'Douzaine', 'Oeuf', 33.00);
INSERT INTO view_operation_bon_livraison VALUES(1, 4, 2, 113, 'Unitée', 'Salade', 60.00);
INSERT INTO view_operation_bon_livraison VALUES(3, 5, 4, 91, 'Kg', 'Pomme de Terre', 43.00);

-- -----------------------------
-- insertions dans la table view_operation_passee
-- -----------------------------
INSERT INTO view_operation_passee VALUES(4, 'C4', 33.00, 'Rechargement', 2011-06-12 23:56:53, 'Chèque', 1, 'Numéro', 'CHQ987654321');
INSERT INTO view_operation_passee VALUES(12, 'C12', 50.00, 'Rechargement', 2011-06-12 23:55:57, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(37, 'C37', -33.00, 'Marché n°1', 2011-06-12 20:20:18, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(4, 'C4', -10.00, 'Marché N°1', 2011-06-12 20:17:26, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(4, 'C4', -12.90, 'Marché N°1', 2011-06-12 20:17:26, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(4, 'C4', 7.00, 'Rechargement', 2011-06-12 20:17:26, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(4, 'C4', -5.00, 'Marché N°1', 2011-06-12 20:17:26, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(4, 'C4', -2.46, 'Marché N°1', 2011-06-12 20:17:26, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(5, 'C5', -3.70, 'Marché N°1', 2011-06-12 20:13:14, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(5, 'C5', -6.45, 'Marché N°1', 2011-06-12 20:13:14, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(25, 'C25', -12.00, 'Marché N°1', 2011-06-12 19:05:32, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(25, 'C25', -6.45, 'Marché N°1', 2011-06-12 19:05:32, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(34, 'C34', -5.55, 'Marché N°1', 2011-06-12 19:03:13, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(34, 'C34', -12.90, 'Marché N°1', 2011-06-12 19:03:13, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(34, 'C34', -12.90, 'Marché N°1', 2011-06-12 19:03:13, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(34, 'C34', -5.55, 'Marché N°1', 2011-06-12 19:03:13, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(45, 'C45', -1.00, 'Marché N°1', 2011-06-12 19:00:48, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(45, 'C45', -6.45, 'Marché N°1', 2011-06-12 19:00:48, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(36, 'C36', -3.69, 'Marché N°1', 2011-06-12 18:50:41, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(36, 'C36', -3.69, 'Marché N°1', 2011-06-12 18:50:41, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(36, 'C36', -6.45, 'Marché N°1', 2011-06-12 18:50:41, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(36, 'C36', -10.00, 'Marché N°1', 2011-06-12 18:50:41, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(36, 'C36', 0.00, 'Marché N°1', 2011-06-12 18:50:41, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(36, 'C36', 30.00, 'Rechargement', 2011-06-12 18:50:41, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(36, 'C36', -6.45, 'Marché N°1', 2011-06-12 18:50:41, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(35, 'C35', -33.00, 'Marché N°1', 2011-06-12 18:13:54, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(35, 'C35', -12.90, 'Marché N°1', 2011-06-12 18:13:54, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(35, 'C35', -22.00, 'Marché N°1', 2011-06-12 18:13:54, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(35, 'C35', -12.90, 'Marché N°1', 2011-06-12 18:13:54, 'Achat', 1, 'Id produit', '1');
INSERT INTO view_operation_passee VALUES(35, 'C35', -4.92, 'Marché N°1', 2011-06-12 18:13:54, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(35, 'C35', 50.00, 'Rechargement', 2011-06-12 18:13:54, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(35, 'C35', -4.92, 'Marché N°1', 2011-06-12 18:13:54, 'Achat', 1, 'Id produit', '2');
INSERT INTO view_operation_passee VALUES(39, 'C39', -60.00, 'Marché n°1', 2011-06-05 21:45:42, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(12, 'C12', -12.00, 'Marché Solidaire n°6', 2011-02-13 19:49:27, 'Achat Solidaire', 1, 'Id produit', '10');
INSERT INTO view_operation_passee VALUES(13, 'C13', -13.00, 'Marché Solidaire n°6', 2011-02-13 19:49:27, 'Achat Solidaire', 1, 'Id produit', '10');
INSERT INTO view_operation_passee VALUES(12, 'C12', -22.00, 'Marché N°6', 2011-02-13 18:50:19, 'Achat', 1, 'Id produit', '11');
INSERT INTO view_operation_passee VALUES(12, 'C12', -15.00, 'Marché N°6', 2011-02-13 18:50:19, 'Achat', 1, 'Id produit', '10');
INSERT INTO view_operation_passee VALUES(39, 'C39', -24.24, 'Marché n°6', 2011-02-07 22:20:02, 'Chèque', 1, 'Numéro', 'CHQ1111');
INSERT INTO view_operation_passee VALUES(40, 'C40', -42.43, 'Marché n°6', 2011-02-07 21:42:44, 'Chèque', 1, 'Numéro', 'CHQ412432');
INSERT INTO view_operation_passee VALUES(2, 'C2', -3.70, 'Marché N°1', 2011-02-06 16:22:20, '', , '', '');
INSERT INTO view_operation_passee VALUES(2, 'C2', 20.00, 'Rechargement', 2011-02-06 16:22:20, 'Chèque', 1, 'Numéro', 'CHQ12324');
INSERT INTO view_operation_passee VALUES(47, 'C47', 0.00, 'Création du compte', 2011-02-06 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(46, 'C46', 0.00, 'Création du compte', 2011-02-06 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(3, 'C3', -3.70, 'Marché N°1', 2011-01-26 15:13:45, '', , '', '');
INSERT INTO view_operation_passee VALUES(40, 'C40', -43.00, 'Marché n°3', 2011-01-25 21:21:45, 'Chèque', 1, 'Numéro', 'CHQ2342');
INSERT INTO view_operation_passee VALUES(45, 'C45', 50.00, 'test rechargement', 2010-12-25 21:53:39, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(45, 'C45', 0.00, 'Création du compte', 2010-12-25 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(44, 'C44', 0.00, 'Création du compte', 2010-12-24 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(43, 'C43', 0.00, 'Création du compte', 2010-12-24 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(42, 'C42', 0.00, 'Création du compte', 2010-12-24 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(41, 'C41', 0.00, 'Création du compte', 2010-12-24 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(40, 'C40', -66.00, 'Commande N°2', 2010-12-23 19:55:48, 'Chèque', 1, 'Numéro', 'CHQ12354534');
INSERT INTO view_operation_passee VALUES(40, 'C40', -50.00, 'Commande N°1', 2010-12-23 19:48:33, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(40, 'C40', 0.00, 'Création du compte', 2010-12-23 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(39, 'C39', 0.00, 'Création du compte', 2010-12-23 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(37, 'C37', 0.00, 'Création du compte', 2010-12-22 19:23:11, '', , '', '');
INSERT INTO view_operation_passee VALUES(32, 'C32', -128.00, 'Marché N°4', 2010-11-29 19:48:33, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(32, 'C32', 200.00, 'Rechargement', 2010-11-29 19:48:33, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(31, 'C31', -16.60, 'Marché N°1', 2010-11-29 19:41:09, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(31, 'C31', 30.00, 'Rechargement', 2010-11-29 19:22:07, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(34, 'C34', 50.00, 'Rechargement', 2010-11-29 19:15:33, 'Chèque', 1, 'Numéro', 'AZA15641');
INSERT INTO view_operation_passee VALUES(32, 'C32', 25.00, 'Rechargement', 2010-11-29 19:10:38, 'Espèces', 0, '', '');
INSERT INTO view_operation_passee VALUES(32, 'C32', 0.00, 'Création du compte', 2010-11-29 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(33, 'C33', 0.00, 'Création du compte', 2010-11-29 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(34, 'C34', 0.00, 'Création du compte', 2010-11-29 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(35, 'C35', 0.00, 'Création du compte', 2010-11-29 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(36, 'C36', 0.00, 'Création du compte', 2010-11-29 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(14, 'C14', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(13, 'C13', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(12, 'C12', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(11, 'C11', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(10, 'C10', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(9, 'C9', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(8, 'C8', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(7, 'C7', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(6, 'C6', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(5, 'C5', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(4, 'C4', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(3, 'C3', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(2, 'C2', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(1, 'C1', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(15, 'C15', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(16, 'C16', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(17, 'C17', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(30, 'C30', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(29, 'C29', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(28, 'C28', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(27, 'C27', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(26, 'C26', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(25, 'C25', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(24, 'C24', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(23, 'C23', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(22, 'C22', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(21, 'C21', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(20, 'C20', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(19, 'C19', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(18, 'C18', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');
INSERT INTO view_operation_passee VALUES(31, 'C31', 0.00, 'Création du compte', 2010-11-28 00:00:00, '', , '', '');

-- -----------------------------
-- insertions dans la table view_operation_produit_bon_commande
-- -----------------------------
INSERT INTO view_operation_produit_bon_commande VALUES(2, 5, 3, 70, 'g', 'Jambon', 27.00);
INSERT INTO view_operation_produit_bon_commande VALUES(3, 5, 4, 71, 'Kg', 'Pomme de Terre', 67.00);

-- -----------------------------
-- insertions dans la table view_producteur
-- -----------------------------
INSERT INTO view_producteur VALUES(1, 'P1', 37, 'C37', 'PIGNAULT', 'Guillaume', '', '', '', '', '', '', '', 0000-00-00, 0000-00-00, 0000-00-00 00:00:00, '', -33.00);
INSERT INTO view_producteur VALUES(4, 'P4', 39, 'C39', 'SAEZ', 'Damien', '', '', '', '', '', '', '', 0000-00-00, 2010-12-23, 2010-12-23 17:42:08, '', -84.24);
INSERT INTO view_producteur VALUES(5, 'P5', 40, 'C40', 'AMSTRONG', 'Claude', 'raton@gmail.fr', 'guenillon@gmail.fr', '0406060610', '0187561235', '55 avenue des rigolos', '84563', 'LE VIEUX', 2010-12-23, 0000-00-00, 2011-01-03 00:04:35, 'Ben c&#039;est un gentil producteur. Et oui.', -201.43);

-- -----------------------------
-- insertions dans la table view_reservation
-- -----------------------------
INSERT INTO view_reservation VALUES(1, 1, 3, -2.00, 'Douzaine', 0, 32, 1, 31, 'PIERRE', 'Jean-victor', 'C32');
INSERT INTO view_reservation VALUES(1, 1, 3, -2.00, 'Douzaine', 0, 32, 1, 32, 'PIERRE', 'Marie-charlotte', 'C32');
INSERT INTO view_reservation VALUES(1, 2, 5, -4.00, 'Unitée', 0, 32, 3, 31, 'PIERRE', 'Jean-victor', 'C32');
INSERT INTO view_reservation VALUES(1, 2, 5, -4.00, 'Unitée', 0, 32, 3, 32, 'PIERRE', 'Marie-charlotte', 'C32');
INSERT INTO view_reservation VALUES(1, 1, 8, -2.00, 'Douzaine', 0, 33, 1, 33, 'DESFORGES', 'Cécile', 'C33');
INSERT INTO view_reservation VALUES(1, 1, 8, -2.00, 'Douzaine', 0, 33, 1, 34, 'DESFORGES', 'Alain', 'C33');
INSERT INTO view_reservation VALUES(1, 2, 9, -4.00, 'Unitée', 0, 33, 3, 33, 'DESFORGES', 'Cécile', 'C33');
INSERT INTO view_reservation VALUES(1, 2, 9, -4.00, 'Unitée', 0, 33, 3, 34, 'DESFORGES', 'Alain', 'C33');
INSERT INTO view_reservation VALUES(2, 3, 10, -200.00, 'g', 0, 33, 4, 33, 'DESFORGES', 'Cécile', 'C33');
INSERT INTO view_reservation VALUES(2, 3, 10, -200.00, 'g', 0, 33, 4, 34, 'DESFORGES', 'Alain', 'C33');
INSERT INTO view_reservation VALUES(1, 2, 91, -8.00, 'Unitée', 0, 6, 3, 6, 'BERENGER', 'Jocelyne', 'C6');
INSERT INTO view_reservation VALUES(1, 1, 25, -1.00, 'Douzaine', 0, 12, 1, 12, 'DERRAS', 'Danièle', 'C12');
INSERT INTO view_reservation VALUES(6, 10, 33, -33.00, 'Kg', 0, 45, 15, 41, 'PIERRE', 'Julien', 'C45');
INSERT INTO view_reservation VALUES(6, 11, 72, -20.00, 'g', 0, 31, 17, 1, 'JALABERT', 'Bernard', 'C31');
INSERT INTO view_reservation VALUES(6, 10, 64, -45.00, 'Kg', 0, 31, 14, 1, 'JALABERT', 'Bernard', 'C31');
INSERT INTO view_reservation VALUES(1, 1, 78, -1.00, 'Douzaine', 0, 8, 1, 8, 'COQUET', 'Jean-paul', 'C8');
INSERT INTO view_reservation VALUES(1, 2, 90, -3.00, 'Unitée', 0, 7, 2, 7, 'BUISSON', 'Marie-hélène', 'C7');
INSERT INTO view_reservation VALUES(1, 1, 88, -2.00, 'Douzaine', 0, 7, 1, 7, 'BUISSON', 'Marie-hélène', 'C7');
INSERT INTO view_reservation VALUES(1, 1, 92, -2.00, 'Douzaine', 0, 6, 1, 6, 'BERENGER', 'Jocelyne', 'C6');
INSERT INTO view_reservation VALUES(3, 4, 93, -30.00, 'Kg', 0, 31, 5, 1, 'JALABERT', 'Bernard', 'C31');

-- -----------------------------
-- insertions dans la table view_stock_achat
-- -----------------------------
INSERT INTO view_stock_achat VALUES(1, 1, 1, 106, 1, -12.00);
INSERT INTO view_stock_achat VALUES(1, 4, 2, 14, 2, -32.00);
INSERT INTO view_stock_achat VALUES(4, 4, 5, 23, 7, -48.00);
INSERT INTO view_stock_achat VALUES(6, 4, 10, 73, 14, -45.00);
INSERT INTO view_stock_achat VALUES(6, 5, 11, 74, 16, -15.00);

-- -----------------------------
-- insertions dans la table view_stock_achat_solidaire
-- -----------------------------
INSERT INTO view_stock_achat_solidaire VALUES(1, 1, 1, 98, 1, -9.00);
INSERT INTO view_stock_achat_solidaire VALUES(1, 4, 2, 99, 2, -5.00);
INSERT INTO view_stock_achat_solidaire VALUES(6, 4, 10, 75, 14, -25.00);

-- -----------------------------
-- insertions dans la table view_stock_commande
-- -----------------------------
INSERT INTO view_stock_commande VALUES(6, 5, 11, 37, 16, 76.00);
INSERT INTO view_stock_commande VALUES(6, 4, 10, 38, 14, 14.44);
INSERT INTO view_stock_commande VALUES(2, 5, 3, 39, 4, 250.00);
INSERT INTO view_stock_commande VALUES(3, 5, 4, 40, 5, 45.00);

-- -----------------------------
-- insertions dans la table view_stock_livraison
-- -----------------------------
INSERT INTO view_stock_livraison VALUES(6, 5, 11, 45, 16, 44.40);
INSERT INTO view_stock_livraison VALUES(3, 5, 4, 61, 5, 32.00);
INSERT INTO view_stock_livraison VALUES(6, 4, 10, 44, 14, 66666.00);
INSERT INTO view_stock_livraison VALUES(1, 1, 1, 95, 1, 200.00);
INSERT INTO view_stock_livraison VALUES(1, 4, 2, 97, 2, 60.00);

-- -----------------------------
-- insertions dans la table view_stock_produit
-- -----------------------------
INSERT INTO view_stock_produit VALUES(1, 1, 1, 178.00);
INSERT INTO view_stock_produit VALUES(2, 1, 2, 9.00);
INSERT INTO view_stock_produit VALUES(3, 2, 3, 800.00);
INSERT INTO view_stock_produit VALUES(4, 3, 4, 2.00);
INSERT INTO view_stock_produit VALUES(5, 4, 3, 5002.00);
INSERT INTO view_stock_produit VALUES(6, 2, 4, 750.00);
INSERT INTO view_stock_produit VALUES(7, 2, 1, 789.00);
INSERT INTO view_stock_produit VALUES(8, 5, 3, 789.00);
INSERT INTO view_stock_produit VALUES(9, 5, 4, 789.00);
INSERT INTO view_stock_produit VALUES(10, 6, 4, 66543.00);
INSERT INTO view_stock_produit VALUES(11, 6, 2, 465.00);
INSERT INTO view_stock_produit VALUES(12, 7, 3, 45.00);

-- -----------------------------
-- insertions dans la table view_stock_produit_initiaux
-- -----------------------------
INSERT INTO view_stock_produit_initiaux VALUES(1, 2011-06-12 20:20:18, 200.00, 1, 1, 1);
INSERT INTO view_stock_produit_initiaux VALUES(2, 2011-06-05 21:45:42, 60.00, 1, 1, 2);
INSERT INTO view_stock_produit_initiaux VALUES(6, 2010-12-23 18:22:32, 1000.00, 0, 2, 3);
INSERT INTO view_stock_produit_initiaux VALUES(7, 2011-01-25 21:21:45, 32.00, 1, 3, 4);
INSERT INTO view_stock_produit_initiaux VALUES(22, 2010-11-29 19:45:19, 5050.00, 0, 4, 5);
INSERT INTO view_stock_produit_initiaux VALUES(26, 2010-12-23 18:22:32, 750.00, 0, 2, 6);
INSERT INTO view_stock_produit_initiaux VALUES(27, 2010-12-23 18:22:32, 789.00, 0, 2, 7);
INSERT INTO view_stock_produit_initiaux VALUES(28, 2010-12-26 14:34:22, 789.00, 0, 5, 8);
INSERT INTO view_stock_produit_initiaux VALUES(30, 2010-12-26 14:34:22, 789.00, 0, 5, 9);
INSERT INTO view_stock_produit_initiaux VALUES(31, 2011-02-07 22:20:53, 66666.00, 0, 6, 10);
INSERT INTO view_stock_produit_initiaux VALUES(32, 2011-02-07 22:20:53, 500.00, 0, 6, 11);
INSERT INTO view_stock_produit_initiaux VALUES(77, 2011-06-01 21:54:00, 45.00, 0, 7, 12);

-- -----------------------------
-- insertions dans la table view_stock_produit_reservation
-- -----------------------------
INSERT INTO view_stock_produit_reservation VALUES(1, 1, 1, 'Douzaine', 'Oeuf', 22.00);
INSERT INTO view_stock_produit_reservation VALUES(1, 4, 2, 'Unitée', 'Salade', 51.00);
INSERT INTO view_stock_produit_reservation VALUES(2, 5, 3, 'g', 'Jambon', 200.00);
INSERT INTO view_stock_produit_reservation VALUES(3, 5, 4, 'Kg', 'Pomme de Terre', 30.00);
INSERT INTO view_stock_produit_reservation VALUES(2, 4, 6, 'Kg', 'Pomme de Terre', 0.00);
INSERT INTO view_stock_produit_reservation VALUES(2, 1, 7, 'Kg', 'Oeuf', 0.00);
INSERT INTO view_stock_produit_reservation VALUES(7, 4, 12, 'Kg', 'Jambon', 0.00);

-- -----------------------------
-- insertions dans la table view_stock_solidaire
-- -----------------------------
INSERT INTO view_stock_solidaire VALUES(1, 1, 1, 94, 1, 41.00);
INSERT INTO view_stock_solidaire VALUES(1, 4, 2, 96, 2, 55.00);
INSERT INTO view_stock_solidaire VALUES(3, 5, 4, 55, 5, 13.00);
INSERT INTO view_stock_solidaire VALUES(6, 4, 10, 46, 14, -13.89);

-- -----------------------------
-- insertions dans la table view_type_paiement_visible
-- -----------------------------
INSERT INTO view_type_paiement_visible VALUES(1, 'Espèces', 0, '', 1);
INSERT INTO view_type_paiement_visible VALUES(2, 'Chèque', 1, 'Numéro', 1);

-- -----------------------------
-- insertions dans la table vue_vues
-- -----------------------------
INSERT INTO vue_vues VALUES(1, 1, 'MonCompte', 'Mon Compte', 1);
INSERT INTO vue_vues VALUES(2, 2, 'ListeAdherent', 'Liste des Adhérents', 2);
INSERT INTO vue_vues VALUES(3, 2, 'AjoutAdherent', 'Ajouter un Adhérent', 1);
INSERT INTO vue_vues VALUES(4, 3, 'ListeCommande', 'Marché', 2);
INSERT INTO vue_vues VALUES(5, 4, 'AjoutCommande', 'Créer un Marché', 1);
INSERT INTO vue_vues VALUES(6, 4, 'ListeCommande', 'Liste des Marchés', 2);
INSERT INTO vue_vues VALUES(8, 3, 'MesCommandes', 'Mes Commandes', 1);
INSERT INTO vue_vues VALUES(9, 5, 'AjoutProducteur', 'Ajouter un Producteur', 1);
INSERT INTO vue_vues VALUES(10, 5, 'ListeProducteur', 'Liste des Producteurs', 2);
INSERT INTO vue_vues VALUES(11, 6, 'CompteZeybu', 'Le Compte du Zeybu', 1);
INSERT INTO vue_vues VALUES(12, 7, 'RechargerCompte', 'Recharger un compte', 1);

