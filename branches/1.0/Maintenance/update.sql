ALTER TABLE `ope_operation` ADD `ope_id_banque` INT NOT NULL, ADD `ope_date_maj` DATETIME NOT NULL, ADD `ope_id_login` INT NOT NULL;

INSERT INTO `zeybu_maintenance`.`tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (-1, '', '0', '', '0');

-- -----------------------------------------------------
-- Table `ads_adhesion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ads_adhesion` (
  `ads_id` INT NOT NULL AUTO_INCREMENT ,
  `ads_label` VARCHAR(45) NULL ,
  `ads_date_debut` DATETIME NULL ,
  `ads_date_fin` DATETIME NULL ,
  `ads_etat` TINYINT(1) NULL ,
  PRIMARY KEY (`ads_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


--
-- Structure de la table `adad_adhesion_adherent`
--

CREATE TABLE IF NOT EXISTS `adad_adhesion_adherent` (
  `adad_id` int(11) NOT NULL AUTO_INCREMENT,
  `adad_id_adherent` int(11) DEFAULT NULL,
  `adad_id_type_adhesion` int(11) DEFAULT NULL,
  `adad_id_operation` int(11) DEFAULT NULL,
  `adad_etat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`adad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Structure de la table `tpa_type_adhesion`
--

CREATE TABLE IF NOT EXISTS `tpa_type_adhesion` (
  `tpa_id` int(11) NOT NULL AUTO_INCREMENT,
  `tpa_id_adhesion` int(11) DEFAULT NULL,
  `tpa_label` varchar(45) DEFAULT NULL,
  `tpa_perimetre` tinyint(1) DEFAULT NULL,
  `tpa_montant` decimal(10,2) DEFAULT NULL,
  `tpa_etat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`tpa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;