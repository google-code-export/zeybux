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
 