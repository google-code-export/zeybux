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

select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,
pro_stock_reservation,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`)));


INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES ('0', 'Réservation', '0', '', '0');
UPDATE `tpp_type_paiement` SET `tpp_id` = '0' WHERE `tpp_type_paiement`.`tpp_id` =16;

ALTER TABLE `sto_stock` ADD `sto_id_operation` INT NOT NULL;
ALTER TABLE `hsto_historique_stock` ADD `hsto_id_operation` INT NOT NULL AFTER `hsto_id_detail_commande` ;

create view view_gestion_commande_liste_reservation as

select 
`com_commande`.`com_id` AS `com_id`,
`com_commande`.`com_numero` AS `com_numero`,
`adh_adherent`.`adh_id` AS `adh_id`,
`adh_adherent`.`adh_numero` AS `adh_numero`,
`cpt_compte`.`cpt_label` AS `cpt_label`,
`adh_adherent`.`adh_nom` AS `adh_nom`,
`adh_adherent`.`adh_prenom` AS `adh_prenom` 

from ope_operation 
join `cpt_compte` on ope_id_compte = cpt_id
join `adh_adherent` on `adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`
join `com_commande` on com_id = ope_id_commande
where com_archive = 0
and ope_type_paiement = 0;

DROP TABLE `view_liste_adherent_commande_reservation`;

create view view_achat_detail_solidaire as
SELECT 
sto_id_operation,
sto_id,
dope_id,
sto_id_detail_commande,
dope_montant,
sto_quantite
FROM `sto_stock` 
left join dope_detail_operation on sto_id_operation = dope_id_operation 
AND sto_id_detail_commande = dope_id_detail_commande
WHERE sto_type = 2

order by `sto_date` DESC, `sto_type` ASC;

create view view_achat_detail as
SELECT 
sto_id_operation,
sto_id,
dope_id,
sto_id_detail_commande,
dope_montant,
sto_quantite
FROM `sto_stock` 
left join dope_detail_operation on sto_id_operation = dope_id_operation 
AND sto_id_detail_commande = dope_id_detail_commande
WHERE sto_type = 1

order by `sto_date` DESC, `sto_type` ASC;

INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_label_champ_complementaire` ,
`tpp_visible`
)
VALUES (
'15', 'Réservation non récupérée', '0', '', '0'
);

INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_label_champ_complementaire` ,
`tpp_visible`
)
VALUES (
'16', 'Annulation réservation', '0', '', '0'
);

create view view_reservation_detail as
SELECT 
sto_id_operation,
sto_id,
dope_id,
sto_id_detail_commande,
dope_montant,
sto_quantite
FROM `sto_stock` 
left join dope_detail_operation on sto_id_operation = dope_id_operation 
AND sto_id_detail_commande = dope_id_detail_commande
WHERE sto_type = 0

order by `sto_date` DESC, `sto_type` ASC;

create or replace view
view_liste_adherent
as
select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,cpt_solde

from `adh_adherent` 
left join cpt_compte on `adh_adherent`.`adh_id_compte` = cpt_id

where `adh_adherent`.`adh_etat` = 1;

ALTER TABLE `pro_produit` CHANGE `pro_id_producteur` `pro_id_compte_producteur` INT( 11 ) NOT NULL;

create or replace view

view_stock_produit_initiaux
as
select 
`sto_stock`.`sto_id` AS `sto_id`,
`sto_stock`.`sto_date` AS `sto_date`,
`sto_stock`.`sto_quantite` AS `sto_quantite`,
`sto_stock`.`sto_type` AS `sto_type`,
pro_id_commande,
`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit` 


from `sto_stock` 
join `dcom_detail_commande` on `sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`
join pro_produit on pro_id = dcom_id_produit AND sto_id_compte = pro_id_compte_producteur
where `sto_stock`.`sto_type` in (0,4);

ALTER TABLE `pro_produit` ADD `pro_stock_initial` INT NOT NULL ;

create or replace view view_detail_marche

as

select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_stock_reservation` AS `pro_stock_reservation`,pro_stock_initial,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`)));

ALTER TABLE `pro_produit` CHANGE `pro_stock_initial` `pro_stock_initial` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `pro_produit` ADD `pro_etat` INT NOT NULL ;
ALTER TABLE `dcom_detail_commande` ADD `dcom_etat` INT NOT NULL ;

create or replace view view_detail_marche as

select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_stock_reservation` AS `pro_stock_reservation`,`pro_produit`.`pro_stock_initial` AS `pro_stock_initial`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix` 
from (((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`)))
where pro_etat = 0 AND dcom_etat = 0;

create or replace view view_liste_producteur_marche as 

select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`prdt_id_compte`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom` from (`pro_produit` join `prdt_producteur` on((`prdt_producteur`.`prdt_id_compte` = `pro_produit`.`pro_id_compte_producteur`))) 
group by pro_id_commande,`pro_produit`.`pro_id_compte_producteur`
 order by `prdt_producteur`.`prdt_nom`,`prdt_producteur`.`prdt_prenom`;


create or replace view view_liste_producteur_commande as

select`pro_id_commande`,

 `prdt_id`,
 `prdt_nom`,
 `prdt_prenom` 

from pro_produit 
join prdt_producteur on prdt_id_compte = pro_id_compte_producteur
group by pro_id_compte_producteur
order by `prdt_nom`,`prdt_prenom`;


DROP VIEW `view_liste_producteur_commande`;

create or replace view view_stock_produit_reservation as
select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,
`pro_id_compte_producteur`,
pro_id,
pro_unite_mesure,
npro_nom,
(pro_stock_initial - pro_stock_reservation) as sto_quantite

from `pro_produit` 
join npro_nom_produit on npro_id = pro_id_nom_produit;

create or replace view view_info_bon_commande as
select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id` AS `sto_id` from (((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `prdt_producteur` on((`prdt_producteur`.`prdt_id_compte` = `pro_produit`.`pro_id_compte_producteur`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`dope_detail_operation`.`dope_type_paiement` = 5) and (`sto_stock`.`sto_type` = 3)) 
group by `pro_produit`.`pro_id_commande`,pro_id,`pro_produit`.`pro_id_compte_producteur`;


create or replace view view_info_bon_livraison as

select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,
`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,
`pro_produit`.`pro_id` AS `pro_id`,
`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,
`npro_nom_produit`.`npro_nom` AS `npro_nom`,
`dope_detail_operation`.`dope_montant` AS `dope_montant`,
`sto_stock`.`sto_quantite` AS `sto_quantite`,
`prdt_producteur`.`prdt_nom` AS `prdt_nom`,
`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,

`dope_detail_operation`.`dope_id` AS `dope_id`,
`sto_stock`.`sto_id` AS `sto_id`

from (((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `prdt_producteur` on((`prdt_producteur`.`prdt_id_compte` = `pro_produit`.`pro_id_compte_producteur`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`dope_detail_operation`.`dope_type_paiement` = 6) and (`sto_stock`.`sto_type` = 4)) group by `pro_produit`.`pro_id_commande`,`pro_produit`.`pro_id`,`pro_produit`.`pro_id_compte_producteur`;

create or replace view view_stock_solidaire as


select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`sto_stock`.`sto_quantite` AS `sto_quantite` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `pro_produit` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) where (`sto_stock`.`sto_type` = 2);

create or replace view view_gestion_commande_reservation_producteur as
select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,
`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,
`pro_produit`.`pro_id` AS `pro_id`,
`sto_stock`.`sto_id` AS `sto_id` 

from `pro_produit` 
join `dcom_detail_commande` on `dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`
join `sto_stock` on `sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`

where `sto_stock`.`sto_type` = 0;

create or replace VIEW `view_gestion_liste_commande_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` in (0,1)) order by `com_commande`.`com_date_marche_debut`;


create or replace VIEW `view_gestion_liste_commande_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` = 2);



create or replace VIEW `view_gestion_commande_liste_reservation` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom` from (((`ope_operation` join `cpt_compte` on((`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) where ((`com_commande`.`com_archive` in (0,1)) and (`ope_operation`.`ope_type_paiement` = 0));

create or replace view view_info_achat_solidaire as
select 
`pro_produit`.`pro_id_commande` AS `pro_id_commande`,
`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,
`pro_produit`.`pro_id` AS `pro_id`,

`sto_stock`.`sto_id` AS `sto_id`,
`dcom_detail_commande`.`dcom_id` AS `dcom_id`,

sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` ,
sum(dope_montant) AS dope_montant

from pro_produit
join dcom_detail_commande on dcom_id_produit = pro_id
join sto_stock on sto_id_detail_commande = dcom_id
join dope_detail_operation on dope_id_detail_commande = dcom_id

where `sto_stock`.`sto_type` = 2 
and `sto_stock`.`sto_quantite` < 0
and dope_type_paiement = 8
and dope_montant < 0
group by `pro_produit`.`pro_id`;

create or replace view view_info_achat as
select 
`pro_produit`.`pro_id_commande` AS `pro_id_commande`,
`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,
`pro_produit`.`pro_id` AS `pro_id`,

`sto_stock`.`sto_id` AS `sto_id`,
`dcom_detail_commande`.`dcom_id` AS `dcom_id`,

sum(`sto_stock`.`sto_quantite`) AS `sto_quantite` ,
sum(dope_montant) AS dope_montant

from pro_produit
join dcom_detail_commande on dcom_id_produit = pro_id
join sto_stock on sto_id_detail_commande = dcom_id
join dope_detail_operation on dope_id_detail_commande = dcom_id

where `sto_stock`.`sto_type` = 1 
and `sto_stock`.`sto_quantite` < 0
and dope_type_paiement = 7 
and dope_montant < 0
group by `pro_produit`.`pro_id`;

create or replace view view_info_commande as

select `pro_produit`.`pro_id_commande` AS `com_id`,
`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,
`pro_produit`.`pro_id` AS `pro_id`,
`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,
`npro_nom_produit`.`npro_nom` AS `npro_nom`,

view_info_bon_commande.dope_montant,
view_info_bon_commande.sto_quantite,

view_info_bon_livraison.dope_montant AS dope_montant_livraison,
view_info_bon_livraison.sto_quantite AS sto_quantite_livraison,
view_stock_solidaire.sto_quantite AS sto_quantite_solidaire ,

(`view_info_achat`.`sto_quantite` * -(1)) AS `sto_quantite_vente`,
(`view_info_achat_solidaire`.`sto_quantite` * -(1)) AS `sto_quantite_vente_solidaire`,

(`view_info_achat`.`dope_montant` * -(1)) AS `dope_montant_vente`,
(`view_info_achat_solidaire`.`dope_montant` * -(1)) AS `dope_montant_vente_solidaire` 

from `pro_produit`
join `npro_nom_produit` on `npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`

left join view_info_bon_commande on view_info_bon_commande.pro_id = `pro_produit`.`pro_id`
left join view_info_bon_livraison on view_info_bon_livraison.pro_id = `pro_produit`.`pro_id`
left join view_stock_solidaire on view_stock_solidaire.pro_id = `pro_produit`.`pro_id`
left join view_info_achat on view_info_achat.pro_id = `pro_produit`.`pro_id`
left join view_info_achat_solidaire on view_info_achat_solidaire.pro_id = `pro_produit`.`pro_id`

where pro_etat = 0


group by `pro_produit`.`pro_id`;

create or replace view view_liste_producteur_marche as
select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`prdt_producteur`.`prdt_id_compte` AS `prdt_id_compte`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom` from (`pro_produit` join `prdt_producteur` on((`prdt_producteur`.`prdt_id_compte` = `pro_produit`.`pro_id_compte_producteur`))) 
where pro_etat = 0
group by `pro_produit`.`pro_id_commande`,`pro_produit`.`pro_id_compte_producteur` order by `prdt_producteur`.`prdt_nom`,`prdt_producteur`.`prdt_prenom`;

create or replace view view_reservation_detail as 
select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite` from (`sto_stock` left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where (`sto_stock`.`sto_type` in (0,5,6)) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;

create or replace view view_achat_detail as

select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite` ,dcom_id_produit

from (`sto_stock` 
join dcom_detail_commande on sto_id_detail_commande = dcom_id
left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where (`sto_stock`.`sto_type` = 1) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;

create or replace view view_achat_detail_solidaire as

select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite` ,dcom_id_produit
from (`sto_stock` 
join dcom_detail_commande on sto_id_detail_commande = dcom_id

left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where (`sto_stock`.`sto_type` = 2) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;

create or replace view view_reservation_detail as

select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite` ,dcom_id_produit

from (`sto_stock`
join dcom_detail_commande on sto_id_detail_commande = dcom_id
 left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where (`sto_stock`.`sto_type` in (0,5,6)) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;

create or replace view view_compte_zeybu_liste_virement as

select 
`ope1`.`ope_id` AS `ope_id`,
`ope1`.`ope_date` AS `ope_date`,
`cpt_compte`.`cpt_label` AS `cpt_label`,
`ope1`.`ope_montant` AS `ope_montant`,
`ope1`.`ope_type_paiement` AS `ope_type_paiement` 
from ((`ope_operation` `ope1` left join `ope_operation` `ope2` on((`ope1`.`ope_type_paiement_champ_complementaire` = `ope2`.`ope_id`))) 
left join `cpt_compte` on((`ope2`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) where ((`ope1`.`ope_id_compte` = '-1') and (`ope1`.`ope_type_paiement` in (3,4,9,10))) order by `ope1`.`ope_date` desc;

create or replace view view_compte_zeybu_operation as
select `ope1`.`ope_id` AS `ope_id`,
`ope1`.`ope_date` AS `ope_date`,
`cpt_compte`.`cpt_label` AS `cpt_label`,
ope1.ope_libelle,
`ope1`.`ope_montant` AS `ope_montant`,
tpp_type
from ((`ope_operation` `ope1` 
left join `ope_operation` `ope2` on((`ope1`.`ope_type_paiement_champ_complementaire` = `ope2`.`ope_id`))) 
left join `cpt_compte` on((`ope2`.`ope_id_compte` = `cpt_compte`.`cpt_id`))
join tpp_type_paiement on ope1.ope_type_paiement = tpp_id
) 

where ((`ope1`.`ope_id_compte` = '-1') and (`ope1`.`ope_type_paiement` in (1,2,3,4,7,8,9,10))) order by `ope1`.`ope_date` desc;

CREATE TABLE `iol_info_operation_livraison` (
`iol_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`iol_id_ope_livraison` INT NOT NULL ,
`iol_id_ope_zeybu` INT NOT NULL ,
`iol_id_ope_producteur` INT NOT NULL
) ENGINE = MYISAM ;

ALTER TABLE `iol_info_operation_livraison` DROP `iol_id_ope_livraison` ;

create or replace view view_commande_complete_archive as select * from cpt_compte;
DROP VIEW `view_commande_complete_archive` ;
create or replace view view_commande_complete_en_cours as select * from cpt_compte;
DROP VIEW `view_commande_complete_en_cours` ;
DROP VIEW `view_compte_zeybu` ;
DROP VIEW `view_compte_zeybu_caisse` ;
DROP VIEW `view_compte_zeybu_operation` ;

create or replace view view_liste_adherent_commande as select * from cpt_compte;
DROP VIEW `view_liste_adherent_commande` ;
DROP VIEW `view_liste_commande_archive` ;
DROP VIEW `view_liste_commande_en_cours`;
DROP VIEW `view_liste_reservation_archive` ;
DROP VIEW `view_liste_reservation_en_cours`;
create or replace view view_operation_produit_bon_commande as select * from cpt_compte;
DROP VIEW `view_operation_produit_bon_commande`;
DROP VIEW `view_stock_produit`;
DROP VIEW `view_stock_produit_initiaux`;
create or replace view view_stock_achat as select * from cpt_compte;
create or replace view view_stock_achat_solidaire as select * from cpt_compte;
create or replace view view_stock_commande as select * from cpt_compte;
create or replace view view_stock_livraison as select * from cpt_compte;
DROP VIEW `view_stock_achat`;
DROP VIEW `view_stock_achat_solidaire`;
DROP VIEW `view_stock_commande`;
DROP VIEW `view_stock_livraison`;
DROP VIEW `view_operation_achat`;
create or replace view view_operation_achat_solidaire as select * from cpt_compte;
DROP VIEW `view_operation_achat_solidaire`;
create or replace view view_operation_bon_livraison as select * from cpt_compte;
DROP VIEW `view_operation_bon_livraison`;

DROP TABLE IF EXISTS `tpp_type_paiement`;
CREATE TABLE IF NOT EXISTS `tpp_type_paiement` (
  `tpp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tpp_type` varchar(100) NOT NULL,
  `tpp_champ_complementaire` tinyint(4) NOT NULL,
  `tpp_label_champ_complementaire` varchar(30) NOT NULL,
  `tpp_visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`tpp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES
(0, 'Réservation', 0, '', 0),
(1, 'Espèces', 0, '', 1),
(2, 'Chèque', 1, 'Numéro', 1),
(3, 'Virement', 1, 'Id operation reception', 0),
(4, 'Virement', 1, 'Id operation émission', 0),
(5, 'Bon de Commande', 1, 'Id produit', 0),
(6, 'Bon de Livraison', 1, 'Id info operation livraison', 0),
(7, 'Achat', 1, 'Id operation soeur', 0),
(8, 'Achat Solidaire', 1, 'Id operation soeur', 0),
(9, 'Virement Solidaire', 1, 'Id operation reception', 0),
(10, 'Virement Solidaire', 1, 'Id operation émission', 0),
(11, 'Annulation Virement (émission)', 1, 'Id operation reception', 0),
(12, 'Annulation Virement (réception)', 1, 'Id operation émission', 0),
(14, 'Annulation Virement Solidaire (réception)', 1, 'Id operation émission', 0),
(13, 'Annulation Virement Solidaire (émission)', 1, 'Id operation reception', 0),
(15, 'Réservation non récupérée', 0, '', 0),
(16, 'Annulation réservation', 0, '', 0);















