ALTER TABLE `adad_adhesion_adherent` ADD `adad_statut_formulaire` BOOLEAN NOT NULL AFTER `adad_id_operation` ;

UPDATE `vue_vues` SET `vue_label` = 'Bon de Livraison' WHERE `vue_vues`.`vue_id` =22;

INSERT INTO `chcp_champ_complementaire` (
`chcp_id` ,
`chcp_label` ,
`chcp_obligatoire` ,
`chcp_etat`
)
VALUES (
NULL , 'Montant HT', '1', '0'
);

INSERT INTO `tppcp_type_paiement_champ_complementaire` (`tppcp_tpp_id`, `tppcp_chcp_id`, `tppcp_maj_autorise`, `tppcp_ordre`, `tppcp_visible`, `tppcp_etat`) VALUES ('6', '16', '1', '5', '1', '0');

CREATE TABLE IF NOT EXISTS `par_parametre` (
  `par_id` int(11) NOT NULL AUTO_INCREMENT,
  `par_label` varchar(50) NOT NULL,
  `par_int_label` varchar(50) NOT NULL,
  `par_int_valeur` int(11) NOT NULL,
  `par_decimal_label` varchar(50) NOT NULL,
  `par_decimal_valeur` decimal(10,2) NOT NULL,
  `par_varchar_label` varchar(50) NOT NULL,
  `par_varchar_valeur` varchar(50) NOT NULL,
  `par_date_label` varchar(50) NOT NULL,
  `par_date_valeur` datetime NOT NULL,
  `par_text_label` varchar(50) NOT NULL,
  `par_text_valeur` text NOT NULL,
  `par_date_creation` datetime NOT NULL,
  `par_date_modification` datetime NOT NULL,
  `par_etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`par_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `par_parametre` (`par_id`, `par_label`, `par_int_label`, `par_int_valeur`, `par_decimal_label`, `par_decimal_valeur`, `par_varchar_label`, `par_varchar_valeur`, `par_date_label`, `par_date_valeur`, `par_text_label`, `par_text_valeur`, `par_date_creation`, `par_date_modification`, `par_etat`) VALUES (NULL, 'Taux TVA', '', '', 'Taux TVA %', '5.5', '', '', '', '', '', '', NOW(), '', '0');

INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '14', 'ListeAdherent', 'Liste des Adhérents', '2', '1');