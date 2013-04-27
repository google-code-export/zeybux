CREATE OR REPLACE VIEW `view_info_bon_commande` AS
 select 
`pro_produit`.`pro_id_commande` AS `pro_id_commande`,
`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,
`pro_produit`.`pro_id` AS `pro_id`,
`pro_produit`.`pro_type` AS `pro_type`,
`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,
`npro_nom_produit`.`npro_numero` AS `npro_numero`,
`npro_nom_produit`.`npro_nom` AS `npro_nom`,
`dope_detail_operation`.`dope_montant` AS `dope_montant`,
`sto_stock`.`sto_quantite` AS `sto_quantite`,
`fer_ferme`.`fer_nom` AS `fer_nom`,
`dope_detail_operation`.`dope_id` AS `dope_id`,
`sto_stock`.`sto_id` AS `sto_id` ,
dcom_id,dcom_taille,dcom_prix

from (((((`pro_produit` join `npro_nom_produit` on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) 
join `fer_ferme` on((`fer_ferme`.`fer_id_compte` = `pro_produit`.`pro_id_compte_ferme`))) 
join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) 
join `sto_stock` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) 
join `dope_detail_operation` on((`dope_detail_operation`.`dope_id_detail_commande` = `dcom_detail_commande`.`dcom_id`)))
where ((`dope_detail_operation`.`dope_type_paiement` = 5) and (`sto_stock`.`sto_type` = 3)) 

group by `pro_produit`.`pro_id_commande`,`pro_produit`.`pro_id`,`pro_produit`.`pro_id_compte_ferme`, dcom_id
order by `pro_produit`.`pro_id_compte_ferme`,`npro_nom_produit`.`npro_nom`,dcom_taille;