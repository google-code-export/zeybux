CREATE TABLE IF NOT EXISTS `chcp_champ_complementaire` (
  `chcp_id` int(11) NOT NULL AUTO_INCREMENT,
  `chcp_label` varchar(30) NOT NULL,
  `chcp_obligatoire` tinyint(1) NOT NULL,
  `chcp_etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`chcp_id`),
  UNIQUE KEY `chcp_id` (`chcp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `chcp_champ_complementaire` (`chcp_id`, `chcp_label`, `chcp_obligatoire`, `chcp_etat`) VALUES
(1, 'id Marche', 0, 0),
(2, 'id banque', 1, 0),
(3, 'Numéro', 1, 0),
(4, 'Id operation reception', 1, 0),
(5, 'Id operation émission', 1, 0),
(6, 'Id produit', 1, 0),
(7, 'Id info operation livraison', 1, 0),
(8, 'Id operation soeur', 1, 0);

CREATE TABLE IF NOT EXISTS `opecp_operation_champ_complementaire` (
  `opecp_ope_id` int(11) NOT NULL,
  `opecp_chcp_id` int(11) NOT NULL,
  `opecp_valeur` varchar(50) NOT NULL,
  PRIMARY KEY (`opecp_ope_id`,`opecp_chcp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tppcp_type_paiement_champ_complementaire` (
  `tppcp_tpp_id` int(11) NOT NULL,
  `tppcp_chcp_id` int(11) NOT NULL,
  `tppcp_ordre` int(11) NOT NULL,
  `tppcp_visible` tinyint(1) NOT NULL,
  `tppcp_etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`tppcp_tpp_id`,`tppcp_chcp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tppcp_type_paiement_champ_complementaire` (`tppcp_tpp_id`, `tppcp_chcp_id`, `tppcp_ordre`, `tppcp_visible`, `tppcp_etat`) VALUES
(2, 3, 1, 1, 0),
(2, 2, 2, 1, 0),
(2, 1, 3, 0, 0),
(3, 4, 1, 0, 0),
(4, 5, 1, 0, 0),
(5, 6, 1, 0, 0),
(7, 8, 1, 0, 0),
(8, 8, 1, 0, 0),
(5, 1, 2, 0, 0),
(6, 1, 1, 0, 0),
(7, 1, 2, 0, 0),
(8, 1, 2, 0, 0),
(9, 4, 1, 0, 0),
(11, 4, 1, 0, 0),
(13, 4, 1, 0, 0),
(10, 5, 1, 0, 0),
(12, 5, 1, 0, 0),
(14, 5, 1, 0, 0),
(1, 1, 1, 0, 0),
(15, 1, 1, 0, 0),
(16, 1, 1, 0, 0),
(0, 1, 1, 0, 0),
(6, 9, 2, 0, 0),
(6, 10, 3, 0, 0),
(6, 11, 4, 0, 0);