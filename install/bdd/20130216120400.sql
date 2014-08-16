CREATE or replace VIEW `view_liste_abonnes_produit` AS

select `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_lot_abonnement` AS `cptabo_id_lot_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id` AS `cptabo_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_id_nom_produit` AS `proabo_id_nom_produit`,`cptabo_compte_abonnement`.`cptabo_date_debut_suspension` AS `cptabo_date_debut_suspension`,`cptabo_compte_abonnement`.`cptabo_date_fin_suspension` AS `cptabo_date_fin_suspension` 
from (((`cptabo_compte_abonnement`
 join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cptabo_compte_abonnement`.`cptabo_id_compte`)))
 join `cpt_compte` on((`cpt_compte`.`cpt_id` = `cptabo_compte_abonnement`.`cptabo_id_compte`)))
 join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) 
join labo_lot_abonnement on `cptabo_id_lot_abonnement` = labo_id


where ((`adh_adherent`.`adh_etat` = 1) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0))
and labo_etat = 0;


CREATE or replace  VIEW `view_liste_produits_abonne` AS 
select `cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id` AS `cptabo_id`,`fer_ferme`.`fer_nom` AS `fer_nom`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_unite` AS `proabo_unite`,`cptabo_compte_abonnement`.`cptabo_date_debut_suspension` AS `cptabo_date_debut_suspension`,`cptabo_compte_abonnement`.`cptabo_date_fin_suspension` AS `cptabo_date_fin_suspension` 
from ((((`cptabo_compte_abonnement`
 join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) 
join labo_lot_abonnement on labo_id = cptabo_id_lot_abonnement
join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `proabo_produit_abonnement`.`proabo_id_nom_produit`)))
 join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`)))
 join `fer_ferme` on((`fer_ferme`.`fer_id` = `npro_nom_produit`.`npro_id_ferme`))) 
where ((`fer_ferme`.`fer_etat` = 0) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0) and (`npro_nom_produit`.`npro_etat` = 0) and (`cpro_categorie_produit`.`cpro_etat` = 0)) 
and labo_etat = 0
order by `fer_ferme`.`fer_nom`,`cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;