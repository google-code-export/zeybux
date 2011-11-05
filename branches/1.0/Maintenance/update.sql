UPDATE `vue_vues` SET `vue_nom` = 'MonMarche' WHERE `vue_vues`.`vue_id` =4;
UPDATE `vue_vues` SET `vue_ordre` = '1' WHERE `vue_vues`.`vue_id` =4;
UPDATE `vue_vues` SET `vue_nom` = 'MesAchats',`vue_label` = 'Mes Achats',`vue_ordre` = '2' WHERE `vue_vues`.`vue_id` =8;
create view view_mes_achats as
SELECT ope_id_compte,com_id,com_numero,com_date_marche_debut
FROM com_commande JOIN `ope_operation` on ope_id_commande = com_id  WHERE `ope_type_paiement` in (7,8);

create or replace view view_detail_marche as
select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_compte_producteur` AS `pro_id_compte_producteur`,`pro_produit`.`pro_stock_reservation` AS `pro_stock_reservation`,`pro_produit`.`pro_stock_initial` AS `pro_stock_initial`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom` from ((((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) where ((`pro_produit`.`pro_etat` = 0) and (`dcom_detail_commande`.`dcom_etat` = 0)) 
order by 
cpro_nom,
`npro_nom_produit`.`npro_nom`,
dcom_taille;

create or replace view view_mes_achats as

select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut` from (`com_commande` join `ope_operation` on((`ope_operation`.`ope_id_commande` = `com_commande`.`com_id`))) where (`ope_operation`.`ope_type_paiement` in (7,8))
group by ope_id_compte,com_id
;

INSERT INTO `vue_vues` (
`vue_id` ,
`vue_id_module` ,
`vue_nom` ,
`vue_label` ,
`vue_ordre` ,
`vue_visible`
)
VALUES (
NULL , '9', 'GestionCategorie', 'Gestion des catégories', '1', '1');

INSERT INTO `mod_module` (`mod_id`, `mod_nom`, `mod_label`, `mod_defaut`, `mod_ordre`, `mod_admin`, `mod_visible`) VALUES
(9, 'GestionProduit', 'Gestion des produits', 0, 6, 1, 1);

UPDATE `mod_module` SET `mod_ordre` = '7' WHERE `mod_module`.`mod_id` =6;
UPDATE `mod_module` SET `mod_ordre` = '8' WHERE `mod_module`.`mod_id` =7;
UPDATE `mod_module` SET `mod_ordre` = '9' WHERE `mod_module`.`mod_id` =8;
UPDATE `mod_module` SET `mod_ordre` = '6' WHERE `mod_module`.`mod_id` =9;

ALTER TABLE `cpro_categorie_produit` ADD `cpro_etat` TINYINT NOT NULL;

create or replace view view_categorie_produit_active as
SELECT `cpro_id`,`cpro_nom`,`cpro_description`
 FROM `cpro_categorie_produit` WHERE cpro_etat = 0 ORDER BY `cpro_nom`;
 
CREATE TABLE `fer_ferme` (
`fer_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`fer_nom` TEXT NOT NULL ,
`fer_id_compte` INT NOT NULL ,
`fer_siren` INT( 9 ) NOT NULL ,
`fer_adresse` VARCHAR( 300 ) NOT NULL ,
`fer_code_postal` VARCHAR( 10 ) NOT NULL ,
`fer_ville` VARCHAR( 100 ) NOT NULL ,
`fer_date_adhesion` DATE NOT NULL ,
`fer_description` TEXT NOT NULL ,
`fer_etat` TINYINT( 1 ) NOT NULL ,
INDEX ( `fer_id_compte` )
) ENGINE = MYISAM ;

CREATE TABLE `cat_catalogue` (
`cat_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`cat_id_nom_produit` INT NOT NULL ,
`cat_id_ferme` INT NOT NULL ,
`cat_etat` TINYINT( 1 ) NOT NULL ,
INDEX ( `cat_id_nom_produit` , `cat_id_ferme` )
) ENGINE = MYISAM ;

CREATE TABLE `fepr_ferme_producteur` (
`fepr_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`fepr_id_ferme` INT NOT NULL ,
`fepr_id_producteur` INT NOT NULL ,
`fepr_etat` TINYINT( 1 ) NOT NULL ,
INDEX ( `fepr_id_ferme` , `fepr_id_producteur` )
) ENGINE = MYISAM ;

INSERT INTO `vue_vues` (
`vue_id` ,
`vue_id_module` ,
`vue_nom` ,
`vue_label` ,
`vue_ordre` ,
`vue_visible`
)
VALUES (
NULL , '5', 'ListeFerme', 'Liste des Fermes', '3', '1';

create or replace view view_liste_ferme as SELECT 
`fer_id`,
fer_numero,
cpt_label,
`fer_nom`
FROM `fer_ferme` 
join cpt_compte on cpt_id = fer_id_compte
WHERE `fer_etat` = 0;

ALTER TABLE `fer_ferme` ADD `fer_numero` INT NOT NULL AFTER `fer_id`;

ALTER TABLE `fer_ferme` CHANGE `fer_numero` `fer_numero` VARCHAR( 20 ) NOT NULL ;

create or replace view view_ferme as SELECT 
`fer_id`,
fer_numero,
cpt_label,
fer_id_compte,
`fer_nom`,fer_siren,fer_adresse,fer_code_postal,fer_ville,fer_date_adhesion,fer_description
FROM `fer_ferme` 
join cpt_compte on cpt_id = fer_id_compte;

create or replace view view_reservation_detail as 
select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,
`sto_stock`.`sto_id` AS `sto_id`,
`dope_detail_operation`.`dope_id` AS `dope_id`,
`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,
`dope_detail_operation`.`dope_montant` AS `dope_montant`,
`sto_stock`.`sto_quantite` AS `sto_quantite`,
`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit` ,
dope_type_paiement

from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) 
left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) 

where ((`sto_stock`.`sto_type` in (0,5,6)) and (`dope_detail_operation`.`dope_type_paiement` in (0,15,16))) 
order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;

ALTER TABLE `prdt_producteur` DROP `prdt_mot_passe` ,
DROP `prdt_id_compte` ;

ALTER TABLE `prdt_producteur` ADD `prdt_id_ferme` INT NOT NULL AFTER `prdt_id` ;

create or replace view view_liste_producteur as SELECT 
prdt_id_ferme,`prdt_id`,`prdt_numero`,`prdt_nom`,`prdt_prenom`,`prdt_courriel_principal`,`prdt_telephone_principal`
FROM `prdt_producteur`
WHERE `prdt_etat` = 0;

DROP TABLE `fepr_ferme_producteur`;

create or replace view view_producteur as
select `prdt_producteur`.`prdt_id` AS `prdt_id`,
prdt_id_ferme,
`prdt_producteur`.`prdt_numero` AS `prdt_numero`,
`prdt_producteur`.`prdt_nom` AS `prdt_nom`,
`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,
`prdt_producteur`.`prdt_courriel_principal` AS `prdt_courriel_principal`,
`prdt_producteur`.`prdt_courriel_secondaire` AS `prdt_courriel_secondaire`,
`prdt_producteur`.`prdt_telephone_principal` AS `prdt_telephone_principal`,
`prdt_producteur`.`prdt_telephone_secondaire` AS `prdt_telephone_secondaire`,
`prdt_producteur`.`prdt_adresse` AS `prdt_adresse`,
`prdt_producteur`.`prdt_code_postal` AS `prdt_code_postal`,
`prdt_producteur`.`prdt_ville` AS `prdt_ville`,
`prdt_producteur`.`prdt_date_naissance` AS `prdt_date_naissance`,
`prdt_producteur`.`prdt_commentaire` AS `prdt_commentaire`
from `prdt_producteur`  where `prdt_etat` = 0 ;

DELETE FROM `vue_vues` WHERE `vue_vues`.`vue_id` = 9;
DELETE FROM `vue_vues` WHERE `vue_vues`.`vue_id` = 10;
UPDATE `vue_vues` SET `vue_ordre` = '1' WHERE `vue_vues`.`vue_id` =17;

ALTER TABLE `npro_nom_produit` ADD `npro_id_ferme` INT NOT NULL ,
ADD `npro_etat` INT NOT NULL;

create or replace view view_liste_nom_produit as
SELECT  
npro_id_ferme,
npro_id,
npro_nom,
cpro_nom,
cpro_id
FROM `npro_nom_produit`
join cpro_categorie_produit on cpro_id = npro_id_categorie WHERE npro_etat = 0
order by cpro_nom, npro_nom;

DROP TABLE `cat_catalogue`;

CREATE TABLE `car_caracteristique` (
`car_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`car_nom` VARCHAR( 50 ) NOT NULL ,
`car_description` TEXT NOT NULL ,
`car_etat` TINYINT( 1 ) NOT NULL
) ENGINE = MYISAM ;

create or replace view view_liste_caracteristique as
SELECT 
`car_id`,`car_nom`
FROM `car_caracteristique` WHERE `car_etat` = 0;

CREATE TABLE `carpro_caracteristique_produit` (
`carpro_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`carpro_id_nom_produit` INT NOT NULL ,
`carpro_id_caracteristique` INT NOT NULL ,
`carpro_etat` TINYINT( 1 ) NOT NULL
) ENGINE = MYISAM ;

INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '9', 'GestionCaracteristique', 'Gestion des caractéristiques de produit', '2', '1');

create or replace view view_caracteristique as
SELECT 
`car_id`,`car_nom`,`car_description`
FROM `car_caracteristique`;

create or replace view view_liste_produit_caracteristique as
SELECT 
carpro_id_caracteristique,carpro_id,npro_id,npro_nom
FROM carpro_caracteristique_produit
JOIN npro_nom_produit on npro_id = carpro_id_nom_produit;

create view view_categorie_produit as
SELECT 
`cpro_id`,`cpro_nom`,`cpro_description`

FROM `cpro_categorie_produit`;

create view view_liste_categorie_produit as
SELECT 
`cpro_id`,`cpro_nom`
FROM `cpro_categorie_produit` WHERE `cpro_etat` =0;

create or replace view view_liste_categorie_produit AS 
select `cpro_categorie_produit`.`cpro_id` AS `cpro_id`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom` 
from `cpro_categorie_produit` 
where (`cpro_categorie_produit`.`cpro_etat` = 0) 
order by `cpro_nom`;

CREATE TABLE `mlot_modele_lot` (
`mlot_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`mlot_id_nom_produit` INT NOT NULL ,
`mlot_quantite` DECIMAL( 10, 2 ) NOT NULL ,
`mlot_unite` VARCHAR( 20 ) NOT NULL ,
`mlot_prix` DECIMAL( 10, 2 ) NOT NULL ,
`mlot_etat` TINYINT( 1 ) NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `nprdt_nom_produit_producteur` (
`nprdt_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`nprdt_id_nom_produit` INT NOT NULL ,
`nprdt_id_producteur` INT NOT NULL ,
`nprdt_etat` TINYINT( 0 ) NOT NULL
) ENGINE = MYISAM ;

create or replace view view_caracteristique_produit as
SELECT 
carpro_id_nom_produit,
car_id,
car_nom,
car_description
FROM `car_caracteristique` 
join carpro_caracteristique_produit on car_id = carpro_id_caracteristique
where car_etat = 0 and carpro_etat = 0
order by car_nom;

create or replace view view_modele_lot as
SELECT 
mlot_id,
mlot_id_nom_produit,mlot_quantite,mlot_unite,mlot_prix
FROM mlot_modele_lot
where mlot_etat = 0
order by mlot_quantite;

create view view_nom_produit_producteur as
SELECT 

nprdt_id_nom_produit,
prdt_id,
prdt_nom,
prdt_prenom,
prdt_commentaire


FROM `prdt_producteur` 
join nprdt_nom_produit_producteur on prdt_id = nprdt_id_producteur
WHERE `prdt_etat` = 0 and nprdt_etat = 0;

create or replace view view_nom_produit as
select 
`npro_nom_produit`.`npro_id` AS `npro_id`,
`npro_nom_produit`.`npro_id_ferme` AS `npro_id_ferme`,
`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,
`npro_nom_produit`.`npro_nom` AS `npro_nom`,
npro_description,
`cpro_categorie_produit`.`cpro_id` AS `cpro_id`

from (`npro_nom_produit` join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) 

where (`npro_nom_produit`.`npro_etat` = 0) order by `cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;

create or replace view `view_nom_produit_producteur` AS select `nprdt_nom_produit_producteur`.`nprdt_id_nom_produit` AS `nprdt_id_nom_produit`,`prdt_producteur`.`prdt_id` AS `prdt_id`,`prdt_producteur`.`prdt_nom` AS `prdt_nom`,`prdt_producteur`.`prdt_prenom` AS `prdt_prenom`,`prdt_producteur`.`prdt_commentaire` AS `prdt_commentaire`,nprdt_id
from (`prdt_producteur` join `nprdt_nom_produit_producteur` on((`prdt_producteur`.`prdt_id` = `nprdt_nom_produit_producteur`.`nprdt_id_producteur`))) where ((`prdt_producteur`.`prdt_etat` = 0) and (`nprdt_nom_produit_producteur`.`nprdt_etat` = 0));

create or replace view `view_caracteristique_produit` AS select `carpro_caracteristique_produit`.`carpro_id_nom_produit` AS `carpro_id_nom_produit`,`car_caracteristique`.`car_id` AS `car_id`,`car_caracteristique`.`car_nom` AS `car_nom`,`car_caracteristique`.`car_description` AS `car_description`, carpro_id
 from (`car_caracteristique` join `carpro_caracteristique_produit` on((`car_caracteristique`.`car_id` = `carpro_caracteristique_produit`.`carpro_id_caracteristique`))) where ((`car_caracteristique`.`car_etat` = 0) and (`carpro_caracteristique_produit`.`carpro_etat` = 0)) order by `car_caracteristique`.`car_nom`; 