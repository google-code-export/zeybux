ALTER TABLE `adad_adhesion_adherent` ADD `adad_date_creation` DATETIME NOT NULL AFTER `adad_id_operation` ,
ADD `adad_date_modification` DATETIME NOT NULL AFTER `adad_date_creation`;

ALTER TABLE `ads_adhesion` ADD `ads_date_creation` DATETIME NOT NULL AFTER `ads_date_fin` ,
ADD `ads_date_modification` DATETIME NOT NULL AFTER `ads_date_creation`;

ALTER TABLE `tpa_type_adhesion` ADD `tpa_date_creation` DATETIME NOT NULL AFTER `tpa_montant` ,
ADD `tpa_date_modification` DATETIME NOT NULL AFTER `tpa_date_creation`;

ALTER TABLE `tpa_type_adhesion` CHANGE `tpa_perimetre` `tpa_id_perimetre` INT NOT NULL;

CREATE TABLE IF NOT EXISTS `pad_perimetre_adhesion` (
  `pad_id` int(11) NOT NULL AUTO_INCREMENT,
  `pad_label` varchar(20) NOT NULL,
  `pad_date_creation` datetime NOT NULL,
  `pad_date_modification` datetime NOT NULL,
  `pad_etat` tinyint(4) NOT NULL,
  PRIMARY KEY (`pad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `pad_perimetre_adhesion` (`pad_id`, `pad_label`, `pad_date_creation`, `pad_date_modification`, `pad_etat`) VALUES
(1, 'Adhérent', '2013-10-30 22:18:29', '0000-00-00 00:00:00', 0),
(2, 'Compte', '2013-10-30 22:19:07', '0000-00-00 00:00:00', 0);

INSERT INTO `cpt_compte` (`cpt_id`, `cpt_label`, `cpt_solde`, `cpt_id_adherent_principal`) VALUES ('-4', 'Zeybu Association', '', '');

INSERT INTO `mod_module` (`mod_id`, `mod_nom`, `mod_label`, `mod_defaut`, `mod_ordre`, `mod_admin`, `mod_visible`) VALUES (NULL, 'Adhesion', 'Adhésion', '0', '14', '1', '1');
INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '14', 'GestionAdhesion', 'Gestion des Adhésions', '1', '1');