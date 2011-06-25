INSERT INTO `ide_identification` (`ide_id`, `ide_id_login`, `ide_login`, `ide_pass`, `ide_type`, `ide_autorise`) VALUES (NULL, '0', 'vente', '01f01083386dc09d99826461b2b6c6f1', '3', '1');
INSERT INTO ide_identification (ide_id_login,ide_login,ide_pass,ide_type,ide_autorise)
SELECT `adh_id`,`adh_numero`,`adh_mot_passe`,1,1 FROM `adh_adherent` ;

DELETE FROM `adh_adherent` WHERE `adh_adherent`.`adh_id` = 0;

ALTER TABLE `adh_adherent` DROP `adh_mot_passe`;
ALTER TABLE `adh_adherent` DROP `adh_super_zeybu`;
 
create or replace view view_adherent as select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,`adh_adherent`.`adh_courriel_secondaire` AS `adh_courriel_secondaire`,`adh_adherent`.`adh_telephone_principal` AS `adh_telephone_principal`,`adh_adherent`.`adh_telephone_secondaire` AS `adh_telephone_secondaire`,`adh_adherent`.`adh_adresse` AS `adh_adresse`,`adh_adherent`.`adh_code_postal` AS `adh_code_postal`,`adh_adherent`.`adh_ville` AS `adh_ville`,`adh_adherent`.`adh_date_naissance` AS `adh_date_naissance`,`adh_adherent`.`adh_date_adhesion` AS `adh_date_adhesion`,`adh_adherent`.`adh_date_maj` AS `adh_date_maj`,`adh_adherent`.`adh_commentaire` AS `adh_commentaire`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from ((`adh_adherent` left join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) left join `cpt_compte` on((`cpt_compte`.`cpt_id` = `adh_adherent`.`adh_id_compte`))) where ((`ope_operation`.`ope_type` = 1)) group by `adh_adherent`.`adh_id`;

create or replace view  view_identification as select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`mod_module`.`mod_nom` AS `mod_nom` from ((`adh_adherent` join ide_identification on adh_id = ide_id_login left join `aut_autorisation` on((`adh_adherent`.`adh_id` = `aut_autorisation`.`aut_id_adherent`))) left join `mod_module` on((`aut_autorisation`.`aut_id_module` = `mod_module`.`mod_id`))) where `adh_adherent`.`adh_etat` = 1;

create or replace view view_liste_adherent as select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,sum(`ope_operation`.`ope_montant`) AS `ope_montant` from (`adh_adherent` left join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) where ((`ope_operation`.`ope_type` = 1) and (`adh_adherent`.`adh_etat` = 1)) group by `adh_adherent`.`adh_id`;
create or replace view view_liste_reservation_archive as select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive` from ((`adh_adherent` join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`com_commande`.`com_date_marche_fin` < curdate()) or ((`com_commande`.`com_archive` = 1) and (`ope_operation`.`ope_type` = 1)));
create or replace view view_liste_reservation_en_cours as select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive` from ((`adh_adherent` join `ope_operation` on((`adh_adherent`.`adh_id_compte` = `ope_operation`.`ope_id_compte`))) join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`com_commande`.`com_date_marche_fin` >= curdate()) and (`com_commande`.`com_archive` = 0) and (`ope_operation`.`ope_type` = 0)) order by `com_commande`.`com_date_marche_debut`;
create or replace view view_menu as select `adh_adherent`.`adh_id` AS `adh_id`,`mod_module`.`mod_id` AS `mod_id`,`mod_module`.`mod_nom` AS `mod_nom`,`mod_module`.`mod_label` AS `mod_label`,`mod_module`.`mod_admin` AS `mod_admin` from ((`adh_adherent` left join `aut_autorisation` on((`adh_adherent`.`adh_id` = `aut_autorisation`.`aut_id_adherent`))) left join `mod_module` on((`aut_autorisation`.`aut_id_module` = `mod_module`.`mod_id`))) where (`adh_adherent`.`adh_etat` = 1) order by `mod_module`.`mod_ordre`;


INSERT INTO `cpt_compte` (`cpt_id`, `cpt_label`) VALUES ('-1', 'ZEYBU');
INSERT INTO `cpt_compte` (`cpt_id`, `cpt_label`) VALUES ('-2', 'EAU');

INSERT INTO `mod_module` (`mod_id`, `mod_nom`, `mod_label`, `mod_defaut`, `mod_ordre`, `mod_admin`) VALUES (NULL, 'GestionCaisse', 'Gérer la caisse', '0', '8', '1');
INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`) VALUES (NULL, '8', 'GestionCaisse', 'Gérer les accès à la caisse', '1');

ALTER TABLE `mod_module` ADD `mod_visible` TINYINT( 1 ) NOT NULL;
update`mod_module` set `mod_visible`=1;

ALTER TABLE `vue_vues` ADD `vue_visible` TINYINT( 1 ) NOT NULL;
UPDATE `vue_vues` SET `vue_visible` =1;


CREATE TABLE `hope_historique_operation` (
`hope_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`hope_id_operation` INT NOT NULL ,
`hope_id_compte` INT NOT NULL ,
`hope_montant` DECIMAL( 10, 2 ) NOT NULL ,
`hope_libelle` VARCHAR( 100 ) NOT NULL ,
`hope_date` DATETIME NOT NULL ,
`hope_type_paiement` INT NOT NULL ,
`hope_type_paiement_champ_complementaire` VARCHAR( 50 ) NOT NULL ,
`hope_type` INT NOT NULL ,
`hope_id_commande` INT NOT NULL `hope_id_connexion` INT NOT NULL
) ENGINE = MYISAM ;


CREATE TABLE `acc_acces` (
`acc_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`acc_id_login` INT NOT NULL ,
`acc_type_login` INT NOT NULL ,
`acc_ip` VARCHAR( 40 ) NOT NULL ,
`acc_date_creation` DATETIME NOT NULL ,
`acc_date_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`acc_autorise` INT NOT NULL
) ENGINE = MYISAM ;
