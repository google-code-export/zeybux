CREATE or replace VIEW `view_operation_avenir` AS 
select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut` 

from (`ope_operation` left join `com_commande` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) 

where ((`ope_operation`.`ope_type_paiement` = 0) and (`com_commande`.`com_archive` = 0)) 
AND com_date_debut_reservation <= now()
order by `com_commande`.`com_date_marche_debut`;







CREATE OR REPLACE VIEW `view_mes_achats` AS select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`com_commande`.`com_id` AS `com_id`,com_nom,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut` from (`com_commande` join `ope_operation` on((`ope_operation`.`ope_id_commande` = `com_commande`.`com_id`))) where (`ope_operation`.`ope_type_paiement` in (7,8)) group by `ope_operation`.`ope_id_compte`,`com_commande`.`com_id`;




CREATE or replace VIEW `view_gestion_liste_commande_archive` AS 
select `com_commande`.`com_id` AS `com_id`,com_nom,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` = 2);



CREATE or replace VIEW `view_gestion_liste_commande_en_cours` AS 
select `com_commande`.`com_id` AS `com_id`,com_nom,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` in (0,1)) order by `com_commande`.`com_date_marche_debut`;



create or replace VIEW `view_reservation` AS select `com_commande`.`com_id` AS `com_id`,`pro_produit`.`pro_id` AS `pro_id`,`sto_stock`.`sto_id` AS `sto_id`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`pro_produit`.`pro_unite_mesure` AS `pro_unite_mesure`,`sto_stock`.`sto_type` AS `sto_type`,`sto_stock`.`sto_id_compte` AS `sto_id_compte`,`dcom_detail_commande`.`dcom_id` AS `dcom_id`,`adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,adh_telephone_principal,`cpt_compte`.`cpt_label` AS `cpt_label` from ((((((`com_commande` join `pro_produit` on((`com_commande`.`com_id` = `pro_produit`.`pro_id_commande`))) join `dcom_detail_commande` on((`dcom_detail_commande`.`dcom_id_produit` = `pro_produit`.`pro_id`))) join `sto_stock` on((`dcom_detail_commande`.`dcom_id` = `sto_stock`.`sto_id_detail_commande`))) join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `sto_stock`.`sto_id_compte`))) join `ope_operation` on((`com_commande`.`com_id` = `ope_operation`.`ope_id_commande`))) join `cpt_compte` on(((`cpt_compte`.`cpt_id` = `sto_stock`.`sto_id_compte`) and (`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`)))) where ((`sto_stock`.`sto_type` = 0) and (`sto_stock`.`sto_id_compte` <> 0) and (`com_commande`.`com_archive` in (0,1)) and (`ope_operation`.`ope_type_paiement` = 0));




CREATE TABLE `stosol_stock_solidaire` (
`stosol_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`stosol_id_nom_produit` INT NOT NULL ,
`stosol_quantite` DECIMAL( 10, 2 ) NOT NULL ,
`stosol_unite` VARCHAR( 20 ) NOT NULL ,
`stosol_date_creation` DATETIME NOT NULL ,
`stosol_date_modification` DATETIME NOT NULL ,
`stosol_etat` TINYINT( 1 ) NOT NULL ,
INDEX ( `stosol_id_nom_produit` )
) ENGINE = MYISAM ;



INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '6', 'SuiviPaiement', 'Suivi des Paiements', '4', '1');




create or replace view view_operation_attente_adherent as

SELECT 
adh_id,
adh_numero,
adh_nom,
adh_prenom,
cpt_label,
cpt_solde,
ope_montant,
ope_type_paiement,
ope_type_paiement_champ_complementaire,
ope_date,
ope_libelle,
ope_id

FROM ope_operation
join cpt_compte on cpt_id = ope_id_compte
join adh_adherent on adh_id_compte = ope_id_compte
WHERE ope_type = 0 and ope_type_paiement in (1,2)
group by ope_id
order by ope_date ASC;



create or replace VIEW `view_operation_attente_ferme` AS select fer_id,fer_numero,fer_nom,`cpt_compte`.`cpt_label` AS `cpt_label`,`cpt_compte`.`cpt_solde` AS `cpt_solde`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_type_paiement` AS `ope_type_paiement`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire`,`ope_operation`.`ope_date` AS `ope_date`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_id` AS `ope_id` from ((`ope_operation` join `cpt_compte` on((`cpt_compte`.`cpt_id` = `ope_operation`.`ope_id_compte`))) join fer_ferme on((fer_id_compte = `ope_operation`.`ope_id_compte`))) where ((`ope_operation`.`ope_type` = 0) and (`ope_operation`.`ope_type_paiement` in (1,2))) group by ope_id order by `ope_operation`.`ope_date`;