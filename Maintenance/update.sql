CREATE TABLE `proabo_produit_abonnement` (
`proabo_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`proabo_id_nom_produit` INT NOT NULL ,
`proabo_stock_initial` DECIMAL( 10, 2 ) NOT NULL ,
`proabo_max` DECIMAL( 10, 2 ) NOT NULL ,
`proabo_frequence` VARCHAR( 200 ) NOT NULL ,
`proabo_etat` TINYINT NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `cptabo_compte_abonnement` (
`cptabo_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`cptabo_id_compte` INT NOT NULL ,
`cptabo_id_produit_abonnement` INT NOT NULL ,
`cptabo_quantite` DECIMAL( 10, 2 ) NOT NULL ,
`cptabo_date_debut_suspension` DATETIME NOT NULL ,
`cptabo_date_fin_suspension` DATETIME NOT NULL ,
`cptabo_etat` TINYINT NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `hsusabo_historique_suspension_abonnement` (
`hsusabo_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`hsusabo_date_debut_suspension` INT NOT NULL ,
`hsusabo_date_fin_suspension` INT NOT NULL ,
`hsusabo_id_produit_abonnement` INT NOT NULL ,
`hsusabo_id_compte` INT NOT NULL ,
`hsusabo_date` DATETIME NOT NULL ,
`hsusabo_id_connexion` INT NOT NULL
) ENGINE = MYISAM ;

create or replace view view_liste_produit_abonnement as select
proabo_id,
fer_nom,
cpro_nom,
npro_nom

from npro_nom_produit
join fer_ferme on fer_id = npro_id_ferme
join cpro_categorie_produit on cpro_id = npro_id_categorie
join proabo_produit_abonnement on proabo_id_nom_produit = npro_id

where fer_etat = 0
and cpro_etat = 0
and npro_etat = 0
and proabo_etat =0;

create or replace view view_detail_produit_abonnement as select
proabo_id,
npro_nom,
proabo_stock_initial,
proabo_max,
proabo_frequence

from npro_nom_produit
join proabo_produit_abonnement on proabo_id_nom_produit = npro_id

where npro_etat = 0
and proabo_etat =0;

create or replace view view_detail_compte_abonnement as
select
cptabo_id,
cpt_label,
npro_nom,
cptabo_quantite,
cptabo_date_debut_suspension,
cptabo_date_fin_suspension

from cptabo_compte_abonnement
join cpt_compte on cpt_id = cptabo_id_compte
join proabo_produit_abonnement on cptabo_id_produit_abonnement = proabo_id
join npro_nom_produit on npro_id = proabo_id_nom_produit
join cpro_categorie_produit on cpro_id = npro_id_categorie

where cptabo_etat = 0
and cpro_etat = 0
and npro_etat = 0
and proabo_etat =0;

create or replace view view_liste_abonnes_produit as 
SELECT
cptabo_id_produit_abonnement,
cptabo_id_compte,
adh_numero,
cpt_label,
adh_nom,
adh_prenom


FROM `cptabo_compte_abonnement`
join adh_adherent on adh_id_compte = cptabo_id_compte
join cpt_compte on cpt_id = cptabo_id_compte

where adh_etat = 1
and cptabo_etat = 0;

create or replace view view_liste_produits_abonne as 
SELECT
cptabo_id_compte,
cptabo_id_produit_abonnement,
npro_nom,
cpro_nom


FROM `cptabo_compte_abonnement`
join proabo_produit_abonnement on proabo_id = cptabo_id_produit_abonnement
join npro_nom_produit on npro_id = proabo_id_nom_produit
join cpro_categorie_produit on cpro_id = npro_id_categorie

where cptabo_etat = 0
and proabo_etat = 0
and npro_etat = 0
and cpro_etat = 0;

create or replace view view_liste_produits_non_abonne as select `cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom` 
from (((`cptabo_compte_abonnement`
 join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id`<> `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `proabo_produit_abonnement`.`proabo_id_nom_produit`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) 

where ((`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0) and (`npro_nom_produit`.`npro_etat` = 0) and (`cpro_categorie_produit`.`cpro_etat` = 0));

create or replace view view_abonnement_liste_adherent as select `adh_adherent`.`adh_id` AS `adh_id`,
`adh_adherent`.`adh_numero` AS `adh_numero`,
`adh_adherent`.`adh_nom` AS `adh_nom`,
`adh_adherent`.`adh_prenom` AS `adh_prenom`,
`cpt_compte`.`cpt_label` AS `cpt_label` ,
cpt_id
from (`adh_adherent` left join `cpt_compte` on((`adh_adherent`.`adh_id_compte` = `cpt_compte`.`cpt_id`))) where (`adh_adherent`.`adh_etat` = 1);

ALTER TABLE `proabo_produit_abonnement` ADD `proabo_unite` VARCHAR( 20 ) NOT NULL AFTER `proabo_id_nom_produit`;

create or replace view view_detail_produit_abonnement as select `proabo_produit_abonnement`.`proabo_id` AS `proabo_id`,
`npro_nom_produit`.`npro_nom` AS `npro_nom`,
proabo_unite,
`proabo_produit_abonnement`.`proabo_stock_initial` AS `proabo_stock_initial`,
`proabo_produit_abonnement`.`proabo_max` AS `proabo_max`,
`proabo_produit_abonnement`.`proabo_frequence` AS `proabo_frequence` ,
sum( cptabo_quantite ) as proabo_reservation

from `npro_nom_produit` 

join `proabo_produit_abonnement` on `proabo_produit_abonnement`.`proabo_id_nom_produit` = `npro_nom_produit`.`npro_id`
join cptabo_compte_abonnement on cptabo_id_produit_abonnement = proabo_id

where `npro_nom_produit`.`npro_etat` = 0 and `proabo_produit_abonnement`.`proabo_etat` = 0
group by proabo_id;

INSERT INTO `mod_module` (`mod_id`, `mod_nom`, `mod_label`, `mod_defaut`, `mod_ordre`, `mod_admin`, `mod_visible`) VALUES (NULL, 'GestionAbonnement', 'Gestion des Abonnements', '0', '11', '1', '1');
INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '11', 'ListeProduit', 'Liste des Produits', '1', '1');
INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '11', 'ListeAbonne', 'Liste des Abonnés', '2', '1');

create or replace view view_liste_produit_abonnement as select `proabo_produit_abonnement`.`proabo_id` AS `proabo_id`,`fer_ferme`.`fer_nom` AS `fer_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,`npro_nom_produit`.`npro_nom` AS `npro_nom` from (((`npro_nom_produit` join `fer_ferme` on((`fer_ferme`.`fer_id` = `npro_nom_produit`.`npro_id_ferme`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id_nom_produit` = `npro_nom_produit`.`npro_id`))) where ((`fer_ferme`.`fer_etat` = 0) and (`cpro_categorie_produit`.`cpro_etat` = 0) and (`npro_nom_produit`.`npro_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0))
order by fer_nom, cpro_nom, npro_nom;

create or replace view view_abonnement_nom_produit as select `npro_nom_produit`.`npro_id_ferme` AS `npro_id_ferme`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,`cpro_categorie_produit`.`cpro_id` AS `cpro_id`

 from (`npro_nom_produit` join `cpro_categorie_produit` 
on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) 

where (`npro_nom_produit`.`npro_etat` = 0) 
and npro_id not in ( select proabo_id_nom_produit from proabo_produit_abonnement where proabo_etat = 0)

order by `cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;

create or replace view view_detail_produit_abonnement as select `proabo_produit_abonnement`.`proabo_id` AS `proabo_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`proabo_produit_abonnement`.`proabo_unite` AS `proabo_unite`,`proabo_produit_abonnement`.`proabo_stock_initial` AS `proabo_stock_initial`,`proabo_produit_abonnement`.`proabo_max` AS `proabo_max`,`proabo_produit_abonnement`.`proabo_frequence` AS `proabo_frequence`,sum(`cptabo_compte_abonnement`.`cptabo_quantite`) AS `proabo_reservation` 

from ((`npro_nom_produit`
join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id_nom_produit` = `npro_nom_produit`.`npro_id`)))
left join `cptabo_compte_abonnement` on((`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` = `proabo_produit_abonnement`.`proabo_id`))) 

where ((`npro_nom_produit`.`npro_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0)) group by `proabo_produit_abonnement`.`proabo_id`;

create or replace view view_liste_abonnes_produit as select `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,
cptabo_quantite
 from ((`cptabo_compte_abonnement` 

join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) 

join `cpt_compte` on((`cpt_compte`.`cpt_id` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) where ((`adh_adherent`.`adh_etat` = 1) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0));

create or replace view `view_liste_produits_abonne` as
select `cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,
`fer_ferme`.`fer_nom` AS `fer_nom`,
`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom` 

from `cptabo_compte_abonnement` 

join `proabo_produit_abonnement` on `proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`
join `npro_nom_produit` on `npro_nom_produit`.`npro_id` = `proabo_produit_abonnement`.`proabo_id_nom_produit` 
join `cpro_categorie_produit` on `cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`
join `fer_ferme` on `fer_ferme`.`fer_id` = `npro_nom_produit`.`npro_id_ferme`

where `fer_ferme`.`fer_etat` = 0
and `cptabo_compte_abonnement`.`cptabo_etat` = 0 
and `proabo_produit_abonnement`.`proabo_etat` = 0 
and `npro_nom_produit`.`npro_etat` = 0 
and `cpro_categorie_produit`.`cpro_etat` = 0
order by `fer_ferme`.`fer_nom`,`cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;

create or replace view view_liste_produits_abonne as 
select `cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`fer_ferme`.`fer_nom` AS `fer_nom`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom` ,cptabo_quantite,proabo_unite
from ((((`cptabo_compte_abonnement` 
join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) 
join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `proabo_produit_abonnement`.`proabo_id_nom_produit`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) join `fer_ferme` on((`fer_ferme`.`fer_id` = `npro_nom_produit`.`npro_id_ferme`))) where ((`fer_ferme`.`fer_etat` = 0) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0) and (`npro_nom_produit`.`npro_etat` = 0) and (`cpro_categorie_produit`.`cpro_etat` = 0)) order by `fer_ferme`.`fer_nom`,`cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;


 create or replace view view_liste_produits_abonne as 
select `cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,
cptabo_id,
`fer_ferme`.`fer_nom` AS `fer_nom`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_unite` AS `proabo_unite` from ((((`cptabo_compte_abonnement` join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `proabo_produit_abonnement`.`proabo_id_nom_produit`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) join `fer_ferme` on((`fer_ferme`.`fer_id` = `npro_nom_produit`.`npro_id_ferme`))) where ((`fer_ferme`.`fer_etat` = 0) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0) and (`npro_nom_produit`.`npro_etat` = 0) and (`cpro_categorie_produit`.`cpro_etat` = 0)) order by `fer_ferme`.`fer_nom`,`cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;


create or replace view view_detail_produit_abonnement as 
select `proabo_produit_abonnement`.`proabo_id` AS `proabo_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`proabo_produit_abonnement`.`proabo_unite` AS `proabo_unite`,`proabo_produit_abonnement`.`proabo_stock_initial` AS `proabo_stock_initial`,`proabo_produit_abonnement`.`proabo_max` AS `proabo_max`,`proabo_produit_abonnement`.`proabo_frequence` AS `proabo_frequence`,sum(`cptabo_compte_abonnement`.`cptabo_quantite`) AS `proabo_reservation` from ((`npro_nom_produit` join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id_nom_produit` = `npro_nom_produit`.`npro_id`))) left join `cptabo_compte_abonnement` on((`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` = `proabo_produit_abonnement`.`proabo_id`) and cptabo_etat = 0)) where ((`npro_nom_produit`.`npro_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0)  ) group by `proabo_produit_abonnement`.`proabo_id` ;

DROP VIEW `view_liste_produits_non_abonne`;

create or replace view `view_liste_produits_abonne` AS
select `cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id` AS `cptabo_id`,`fer_ferme`.`fer_nom` AS `fer_nom`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_unite` AS `proabo_unite`,
cptabo_date_debut_suspension,cptabo_date_fin_suspension
 from ((((`cptabo_compte_abonnement` join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `proabo_produit_abonnement`.`proabo_id_nom_produit`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) join `fer_ferme` on((`fer_ferme`.`fer_id` = `npro_nom_produit`.`npro_id_ferme`))) where ((`fer_ferme`.`fer_etat` = 0) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0) and (`npro_nom_produit`.`npro_etat` = 0) and (`cpro_categorie_produit`.`cpro_etat` = 0)) order by `fer_ferme`.`fer_nom`,`cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;

 ALTER TABLE `hsusabo_historique_suspension_abonnement` CHANGE `hsusabo_date_debut_suspension` `hsusabo_date_debut_suspension` DATETIME NOT NULL ,
CHANGE `hsusabo_date_fin_suspension` `hsusabo_date_fin_suspension` DATETIME NOT NULL ;

create or replace view `view_detail_marche` AS 

select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_description` AS `com_description`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin`,`com_commande`.`com_date_debut_reservation` AS `com_date_debut_reservation`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_archive` AS `com_archive`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_nom_produit` AS `pro_id_nom_produit`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`pro_produit`.`pro_max_produit_commande` AS `pro_max_produit_commande`,`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,`pro_produit`.`pro_stock_reservation` AS `pro_stock_reservation`,`pro_produit`.`pro_stock_initial` AS `pro_stock_initial`, pro_type, `npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`npro_nom_produit`.`npro_description` AS `npro_description`,`npro_nom_produit`.`npro_id_categorie` AS `npro_id_categorie`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dcom_detail_commande`.`dcom_taille` AS `dcom_taille`,`dcom_detail_commande`.`dcom_prix` AS `dcom_prix`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,`fer_ferme`.`fer_id` AS `fer_id`,`fer_ferme`.`fer_nom` AS `fer_nom` from (((((`com_commande` join `pro_produit` on((`pro_produit`.`pro_id_commande` = `com_commande`.`com_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) join `fer_ferme` on((`npro_nom_produit`.`npro_id_ferme` = `fer_ferme`.`fer_id`))) where ((`pro_produit`.`pro_etat` = 0) and (`dcom_detail_commande`.`dcom_etat` = 0)) order by `cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`,`dcom_detail_commande`.`dcom_taille`;

 create or replace view `view_liste_abonnes_produit` AS 

select `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite` ,
proabo_id_nom_produit,
cptabo_date_debut_suspension,
cptabo_date_fin_suspension
from ((`cptabo_compte_abonnement` join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) 
join `cpt_compte` on((`cpt_compte`.`cpt_id` = `cptabo_compte_abonnement`.`cptabo_id_compte`))
join proabo_produit_abonnement on proabo_id = cptabo_id_produit_abonnement
) 
where ((`adh_adherent`.`adh_etat` = 1) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0)
and proabo_etat = 0
);


create or replace view `view_reservation_detail` AS

 select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,dope_id_compte,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dope_detail_operation`.`dope_type_paiement` AS `dope_type_paiement`,`sto_stock`.`sto_type` AS `sto_type` from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where ((`sto_stock`.`sto_type` in (0,5,6)) and (`dope_detail_operation`.`dope_type_paiement` in (0,15,16))) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;


create or replace VIEW `view_liste_produits_abonne` AS 
select `cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id` AS `cptabo_id`,`fer_ferme`.`fer_nom` AS `fer_nom`, npro_id,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_unite` AS `proabo_unite`,`cptabo_compte_abonnement`.`cptabo_date_debut_suspension` AS `cptabo_date_debut_suspension`,`cptabo_compte_abonnement`.`cptabo_date_fin_suspension` AS `cptabo_date_fin_suspension` from ((((`cptabo_compte_abonnement` join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `proabo_produit_abonnement`.`proabo_id_nom_produit`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) join `fer_ferme` on((`fer_ferme`.`fer_id` = `npro_nom_produit`.`npro_id_ferme`))) where ((`fer_ferme`.`fer_etat` = 0) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0) and (`npro_nom_produit`.`npro_etat` = 0) and (`cpro_categorie_produit`.`cpro_etat` = 0)) order by `fer_ferme`.`fer_nom`,`cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;

create or replace view view_stock_produit_reservation as
(select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,
`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,
`pro_produit`.`pro_id` AS `pro_id`,
`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,
pro_type,
`npro_nom_produit`.`npro_numero` AS `npro_numero`,
`npro_nom_produit`.`npro_nom` AS `npro_nom`,
(`pro_produit`.`pro_stock_initial` - `pro_produit`.`pro_stock_reservation`) AS `sto_quantite` ,
sum(dope_montant) as dope_montant

from `pro_produit` 
join `npro_nom_produit` on `npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`
left join `dcom_detail_commande` on dcom_id_produit = pro_id
left join dope_detail_operation on dcom_id = dope_id_detail_commande and dope_type_paiement = 0

where `pro_produit`.`pro_etat` = 0 and `pro_produit`.`pro_stock_initial` <> -1
and dcom_etat = 0
and (dope_type_paiement = 0 OR dope_type_paiement IS NULL)
group by dcom_id_produit

) 

union (
select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,
pro_type,
`npro_nom_produit`.`npro_numero` AS `npro_numero`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,((`pro_produit`.`pro_stock_initial` - `pro_produit`.`pro_stock_reservation`) + 1) AS `sto_quantite` ,
sum(dope_montant) as dope_montant

from `pro_produit` 
join `npro_nom_produit` on `npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`
left join `dcom_detail_commande` on dcom_id_produit = pro_id
left join dope_detail_operation on dcom_id = dope_id_detail_commande and dope_type_paiement = 0
where `pro_produit`.`pro_etat` = 0 and `pro_produit`.`pro_stock_initial` = -1
and dcom_etat = 0
and (dope_type_paiement = 0 OR dope_type_paiement IS NULL)
group by dcom_id_produit
);

create or replace view `view_info_bon_commande` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,`pro_produit`.`pro_id` AS `pro_id`,pro_type,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_numero` AS `npro_numero`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`fer_ferme`.`fer_nom` AS `fer_nom`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id` AS `sto_id` from (((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `fer_ferme` on((`fer_ferme`.`fer_id_compte` = `pro_produit`.`pro_id_compte_ferme`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`dope_detail_operation`.`dope_type_paiement` = 5) and (`sto_stock`.`sto_type` = 3)) 
group by `pro_produit`.`pro_id_commande`,`pro_produit`.`pro_id`,`pro_produit`.`pro_id_compte_ferme`
order by `pro_id_compte_ferme`,`npro_nom`;

create or replace VIEW `view_info_bon_livraison` AS select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_numero` AS `npro_numero`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`fer_ferme`.`fer_nom` AS `fer_nom`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id` AS `sto_id` from (((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) join `fer_ferme` on((`fer_ferme`.`fer_id_compte` = `pro_produit`.`pro_id_compte_ferme`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) where ((`dope_detail_operation`.`dope_type_paiement` = 6) and (`sto_stock`.`sto_type` = 4)) 
group by `pro_produit`.`pro_id_commande`,`pro_produit`.`pro_id`,`pro_produit`.`pro_id_compte_ferme`
order by `pro_produit`.`pro_id_compte_ferme`,`npro_nom_produit`.`npro_nom`;

create or replace VIEW `view_info_commande` AS select `pro_produit`.`pro_id_commande` AS `com_id`,`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,`pro_produit`.`pro_id` AS `pro_id`,pro_produit.pro_type,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`view_info_bon_commande`.`dope_montant` AS `dope_montant`,`view_info_bon_commande`.`sto_quantite` AS `sto_quantite`,`view_info_bon_livraison`.`dope_montant` AS `dope_montant_livraison`,`view_info_bon_livraison`.`sto_quantite` AS `sto_quantite_livraison`,`view_stock_solidaire`.`sto_quantite` AS `sto_quantite_solidaire`,(`view_info_achat`.`sto_quantite` * -(1)) AS `sto_quantite_vente`,(`view_info_achat_solidaire`.`sto_quantite` * -(1)) AS `sto_quantite_vente_solidaire`,(`view_info_achat`.`dope_montant` * -(1)) AS `dope_montant_vente`,(`view_info_achat_solidaire`.`dope_montant` * -(1)) AS `dope_montant_vente_solidaire` from ((((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) left join `view_info_bon_commande` on((`view_info_bon_commande`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_info_bon_livraison` on((`view_info_bon_livraison`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_stock_solidaire` on((`view_stock_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_info_achat` on((`view_info_achat`.`pro_id` = `pro_produit`.`pro_id`))) left join `view_info_achat_solidaire` on((`view_info_achat_solidaire`.`pro_id` = `pro_produit`.`pro_id`))) where (`pro_produit`.`pro_etat` = 0) group by `pro_produit`.`pro_id` order by npro_nom;

CREATE TABLE `labo_lot_abonnement` (
`labo_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`labo_id_produit_abonnement` INT NOT NULL ,
`labo_taille` DECIMAL( 10, 2 ) NOT NULL ,
`labo_prix` DECIMAL( 10, 2 ) NOT NULL ,
`labo_etat` TINYINT( 1 ) NOT NULL
) ENGINE = MYISAM ;

create or replace view view_liste_lot_abonnement as 
SELECT `labo_id`,`labo_id_produit_abonnement`,`labo_taille`,`labo_prix` 
FROM `labo_lot_abonnement` 
WHERE `labo_etat` = 0
order by labo_taille ASC;

ALTER TABLE `cptabo_compte_abonnement` ADD `cptabo_id_lot_abonnement` INT NOT NULL AFTER `cptabo_id_produit_abonnement`;

create or replace VIEW `view_detail_compte_abonnement` AS select `cptabo_compte_abonnement`.`cptabo_id` AS `cptabo_id`,cptabo_id_produit_abonnement,	cptabo_id_lot_abonnement,`cpt_compte`.`cpt_label` AS `cpt_label`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`cptabo_compte_abonnement`.`cptabo_date_debut_suspension` AS `cptabo_date_debut_suspension`,`cptabo_compte_abonnement`.`cptabo_date_fin_suspension` AS `cptabo_date_fin_suspension` from ((((`cptabo_compte_abonnement` join `cpt_compte` on((`cpt_compte`.`cpt_id` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `proabo_produit_abonnement` on((`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` = `proabo_produit_abonnement`.`proabo_id`))) join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `proabo_produit_abonnement`.`proabo_id_nom_produit`))) join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) where ((`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`cpro_categorie_produit`.`cpro_etat` = 0) and (`npro_nom_produit`.`npro_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0));

create or replace VIEW `view_liste_abonnes_produit` AS select `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,cptabo_id,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_id_nom_produit` AS `proabo_id_nom_produit`,`cptabo_compte_abonnement`.`cptabo_date_debut_suspension` AS `cptabo_date_debut_suspension`,`cptabo_compte_abonnement`.`cptabo_date_fin_suspension` AS `cptabo_date_fin_suspension` from (((`cptabo_compte_abonnement` join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `cpt_compte` on((`cpt_compte`.`cpt_id` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) where ((`adh_adherent`.`adh_etat` = 1) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0));

create or replace VIEW `view_liste_abonnes_produit` AS select `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,
cptabo_id_lot_abonnement,`cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id` AS `cptabo_id`,
`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_id_nom_produit` AS `proabo_id_nom_produit`,`cptabo_compte_abonnement`.`cptabo_date_debut_suspension` AS `cptabo_date_debut_suspension`,`cptabo_compte_abonnement`.`cptabo_date_fin_suspension` AS `cptabo_date_fin_suspension` from (((`cptabo_compte_abonnement` join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `cpt_compte` on((`cpt_compte`.`cpt_id` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) where ((`adh_adherent`.`adh_etat` = 1) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0));

create or replace VIEW `view_detail_produit_abonnement` AS select `proabo_produit_abonnement`.`proabo_id` AS `proabo_id`,proabo_id_nom_produit,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`proabo_produit_abonnement`.`proabo_unite` AS `proabo_unite`,`proabo_produit_abonnement`.`proabo_stock_initial` AS `proabo_stock_initial`,`proabo_produit_abonnement`.`proabo_max` AS `proabo_max`,`proabo_produit_abonnement`.`proabo_frequence` AS `proabo_frequence`,sum(`cptabo_compte_abonnement`.`cptabo_quantite`) AS `proabo_reservation` from ((`npro_nom_produit` join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id_nom_produit` = `npro_nom_produit`.`npro_id`))) left join `cptabo_compte_abonnement` on(((`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` = `proabo_produit_abonnement`.`proabo_id`) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0)))) where ((`npro_nom_produit`.`npro_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0)) group by `proabo_produit_abonnement`.`proabo_id`;
