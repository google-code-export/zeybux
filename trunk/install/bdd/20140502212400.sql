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