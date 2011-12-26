CREATE or replace VIEW `view_stock_produit_reservation` AS 
(select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,(`pro_produit`.`pro_stock_initial` - `pro_produit`.`pro_stock_reservation`) AS `sto_quantite` 

from (`pro_produit` join `npro_nom_produit` 
on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) 
where (`pro_produit`.`pro_etat` = 0)
and pro_stock_initial <> -1)

union (

select `pro_produit`.`pro_id_commande` AS `pro_id_commande`,`pro_produit`.`pro_id_compte_ferme` AS `pro_id_compte_ferme`,`pro_produit`.`pro_id` AS `pro_id`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,(`pro_produit`.`pro_stock_initial` - `pro_produit`.`pro_stock_reservation` + 1) AS `sto_quantite` 

from (`pro_produit` join `npro_nom_produit` 
on((`npro_nom_produit`.`npro_id` = `pro_produit`.`pro_id_nom_produit`))) 
where (`pro_produit`.`pro_etat` = 0)
and pro_stock_initial = -1 );


INSERT INTO `cpt_compte` (`cpt_id`, `cpt_label`, `cpt_solde`) VALUES ('-3', 'invité', '0');