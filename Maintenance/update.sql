INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_label_champ_complementaire` ,
`tpp_visible`
)
VALUES (
NULL , 'Virement Solidaire (émission)', '1', 'Id compte reception', '0'
);

INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_label_champ_complementaire` ,
`tpp_visible`
)
VALUES (
NULL , 'Virement Solidaire (réception)', '1', 'Id compte émission', '0'
);

ALTER TABLE `cpt_compte` ADD `cpt_solde` INT NOT NULL ;
ALTER TABLE `cpt_compte` CHANGE `cpt_solde` `cpt_solde` DECIMAL( 10, 2 ) NOT NULL ;

INSERT INTO `ide_identification` (`ide_id`, `ide_id_login`, `ide_login`, `ide_pass`, `ide_type`, `ide_autorise`) VALUES (NULL, '0', 'EAU', '01f01083386dc09d99826461b2b6c6f1', '4', '1');

create or replace view view_compte_solidaire_operation

as select `ope1`.`ope_id` AS `ope_id`,`ope1`.`ope_date` AS `ope_date`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope1`.`ope_montant` AS `ope_montant`,`ope1`.`ope_type_paiement` AS `ope_type_paiement` from ((`ope_operation` `ope1` left join `ope_operation` `ope2` on((`ope1`.`ope_type_paiement_champ_complementaire` = `ope2`.`ope_id`))) left join `cpt_compte` on((`ope2`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) where ((`ope1`.`ope_id_compte` = '-2') and (`ope1`.`ope_type` = 1) and (`ope1`.`ope_type_paiement` in (3,4,9,10)))

order by `ope_date` DESC;

create view view_compte_solidaire_liste_adherent
as
select 
adh_id,
adh_numero,
cpt_label,
adh_nom,
adh_prenom
from adh_adherent
join cpt_compte on adh_id_compte = cpt_id
where `adh_adherent`.`adh_etat` = 1;

INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (NULL, 'Annulation Virement (émission)', '1', 'Id operation reception', '0');
INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (NULL, 'Annulation Virement (réception)', '1', 'Id operation émission', '0');
INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (NULL, 'Annulation Virement Solidaire (émission)', '1', 'Id operation reception', '0');
INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (NULL, 'Annulation Virement Solidaire (réception)', '1', 'Id operation émission', '0');

create or replace view view_adherent as

select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,`adh_adherent`.`adh_courriel_secondaire` AS `adh_courriel_secondaire`,`adh_adherent`.`adh_telephone_principal` AS `adh_telephone_principal`,`adh_adherent`.`adh_telephone_secondaire` AS `adh_telephone_secondaire`,`adh_adherent`.`adh_adresse` AS `adh_adresse`,`adh_adherent`.`adh_code_postal` AS `adh_code_postal`,`adh_adherent`.`adh_ville` AS `adh_ville`,`adh_adherent`.`adh_date_naissance` AS `adh_date_naissance`,`adh_adherent`.`adh_date_adhesion` AS `adh_date_adhesion`,`adh_adherent`.`adh_date_maj` AS `adh_date_maj`,`adh_adherent`.`adh_commentaire` AS `adh_commentaire`,cpt_solde AS cpt_solde 

from `adh_adherent` 
left join `cpt_compte` on `cpt_compte`.`cpt_id` = `adh_adherent`.`adh_id_compte`;


create or replace view view_operation_passee as

select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` 


from ((`ope_operation` join `cpt_compte` on((`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) 

where (`ope_operation`.`ope_type_paiement` in (-1,1,2,3,4,7,8,9,10)) 


order by `ope_operation`.`ope_date` desc;

create or replace view view_operation_avenir as
select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`

from `ope_operation` left join `com_commande` on `com_commande`.`com_id` = `ope_operation`.`ope_id_commande`

where `ope_operation`.`ope_type_paiement` = 0
and (`com_commande`.`com_archive` = 0) 
order by `com_commande`.`com_date_marche_debut`;


CREATE TABLE `hsto_historique_stock` (
`hsto_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`hsto_sto_id` INT NOT NULL ,
`hsto_date` DATETIME NOT NULL ,
`hsto_quantite` DECIMAL( 10,2 ) NOT NULL ,
`hsto_type` INT NOT NULL ,
`hsto_id_compte` INT NOT NULL ,
`hsto_id_detail_commande` INT NOT NULL ,
`hsto_id_commande` INT NOT NULL ,
`hsto_id_connexion` INT NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `dope_detail_operation` (
`dope_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`dope_id_operation` INT NOT NULL ,
`dope_id_compte` INT NOT NULL ,
`dope_montant` DECIMAL( 10, 2 ) NOT NULL ,
`dope_libelle` VARCHAR( 100 ) NOT NULL ,
`dope_date` DATETIME NOT NULL ,
`dope_type_paiement` INT NOT NULL ,
`dope_type_paiement_champ_complementaire` VARCHAR( 50 ) NOT NULL ,
`dope_id_detail_commande` INT NOT NULL ,
`dope_id_connexion` INT NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `hdope_historique_detail_operation` (
`hdope_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`hdope_id_detail_operation` INT NOT NULL ,
`hdope_id_compte` INT NOT NULL ,
`hdope_montant` DECIMAL( 10, 2 ) NOT NULL ,
`hdope_libelle` VARCHAR( 100 ) NOT NULL ,
`hdope_date` DATETIME NOT NULL ,
`hdope_type_paiement` INT NOT NULL ,
`hdope_type_paiement_champ_complementaire` VARCHAR( 50 ) NOT NULL ,
`hdope_id_detail_commande` INT NOT NULL ,
`hdope_id_connexion` INT NOT NULL
) ENGINE = MYISAM ;
ALTER TABLE `hdope_historique_detail_operation` ADD `hdope_id_operation` INT NOT NULL AFTER `hdope_id_detail_operation` ;
ALTER TABLE `pro_produit` ADD `pro_stock_reservation` DECIMAL( 10, 2 ) NOT NULL ;

ALTER TABLE `sto_stock` DROP `sto_id_commande` ;
ALTER TABLE `hsto_historique_stock` DROP `hsto_id_commande` ;

create or replace view view_marche_liste_reservation as
select 
ope_id_compte,
`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,com_nom,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` 
from `com_commande`
LEFT JOIN ope_operation on ope_id_commande = com_id
where (`com_commande`.`com_date_fin_reservation` >= now()) 
and (`com_commande`.`com_archive` = 0)
and ope_type_paiement = 0;

DROP TABLE `gpc_groupe_commande` ;


create or replace view view_detail_marche as

select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_producteur` AS `pro_id_producteur`,
pro_stock_reservation,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`)));


INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES ('0', 'Réservation', '0', '', '0');
UPDATE `tpp_type_paiement` SET `tpp_id` = '0' WHERE `tpp_type_paiement`.`tpp_id` =16;