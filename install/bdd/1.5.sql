CREATE OR REPLACE VIEW `view_liste_abonnes_produit` AS select `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_lot_abonnement` AS `cptabo_id_lot_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id` AS `cptabo_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_id_nom_produit` AS `proabo_id_nom_produit`, proabo_unite, `cptabo_compte_abonnement`.`cptabo_date_debut_suspension` AS `cptabo_date_debut_suspension`,`cptabo_compte_abonnement`.`cptabo_date_fin_suspension` AS `cptabo_date_fin_suspension` from ((((`cptabo_compte_abonnement` join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `cpt_compte` on((`cpt_compte`.`cpt_id` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) join `labo_lot_abonnement` on((`cptabo_compte_abonnement`.`cptabo_id_lot_abonnement` = `labo_lot_abonnement`.`labo_id`))) where ((`adh_adherent`.`adh_etat` = 1) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0) and (`labo_lot_abonnement`.`labo_etat` = 0));

ALTER TABLE `dach_detail_achat` ADD PRIMARY KEY ( `dach_id_operation` , `dach_id_operation_solidaire` , `dach_id_nom_produit` ) ;
ALTER TABLE `dach_detail_achat` ADD INDEX ( `dach_id_stock` ) ;
ALTER TABLE `dach_detail_achat` ADD INDEX ( `dach_id_detail_operation` ) ;
ALTER TABLE `dach_detail_achat` ADD INDEX ( `dach_id_stock_solidaire` ) ;
ALTER TABLE `dach_detail_achat` ADD INDEX ( `dach_id_detail_operation_solidaire` ) ;

ALTER TABLE `dope_detail_operation` ADD INDEX `id_operation` ( `dope_id_operation` ) COMMENT '';
ALTER TABLE `dope_detail_operation` ADD INDEX `id_detail_commande` ( `dope_id_detail_commande` ) COMMENT '';
ALTER TABLE `sto_stock` ADD INDEX `sto_id_operation` ( `sto_id_operation` ) COMMENT '';

CREATE TABLE IF NOT EXISTS `orc_operation_remise_cheque` (
  `orc_id_remise_cheque` int(11) NOT NULL,
  `orc_id_operation` int(11) NOT NULL,
  `orc_date_creation` datetime NOT NULL,
  `orc_date_modification` datetime NOT NULL,
  `orc_etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`orc_id_remise_cheque`,`orc_id_operation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `rec_remise_cheque` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_numero` int(11) NOT NULL,
  `rec_id_compte` int(11) NOT NULL,
  `rec_montant` decimal(10,0) NOT NULL,
  `rec_date_creation` datetime NOT NULL,
  `rec_date_modification` datetime NOT NULL,
  `rec_etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`rec_id`),
  KEY `id_compte` (`rec_id_compte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

UPDATE `mod_module` SET `mod_label` = 'Compte Marché' WHERE `mod_module`.`mod_id` =6;
UPDATE `vue_vues` SET `vue_label` = 'Compte Marché' WHERE `vue_vues`.`vue_id` =6;