--
-- Structure de la table `ban_banque`
--

CREATE TABLE IF NOT EXISTS `ban_banque` (
  `ban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ban_nom_court` varchar(50) NOT NULL,
  `ban_nom` varchar(200) NOT NULL,
  `ban_description` text NOT NULL,
  `ban_etat` tinyint(4) NOT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `mod_module` (`mod_id`, `mod_nom`, `mod_label`, `mod_defaut`, `mod_ordre`, `mod_admin`, `mod_visible`) VALUES (NULL, 'Parametrage', 'Gestion du Paramétrage', '0', '13', '1', '1');
INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '13', 'Banque', 'Gestion des Banques', '1', '1');