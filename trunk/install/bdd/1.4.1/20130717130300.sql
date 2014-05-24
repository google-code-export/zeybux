DROP VIEW view_operation_avenir;
DROP VIEW view_operation_passee;
ALTER TABLE `hope_historique_operation`
  DROP `hope_type_paiement_champ_complementaire`,
  DROP `hope_id_commande`;
  
CREATE OR REPLACE VIEW `view_gestion_liste_commande_archive` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` = 2)
ORDER BY `com_date_marche_debut` DESC;

create OR REPLACE VIEW `view_gestion_liste_commande_en_cours` AS select `com_commande`.`com_id` AS `com_id`,`com_commande`.`com_nom` AS `com_nom`,`com_commande`.`com_numero` AS `com_numero`,`com_commande`.`com_date_fin_reservation` AS `com_date_fin_reservation`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`,`com_commande`.`com_date_marche_fin` AS `com_date_marche_fin` from `com_commande` where (`com_commande`.`com_archive` in (0,1)) order by `com_commande`.`com_date_marche_debut` DESC;

ALTER TABLE `hdope_historique_detail_operation` DROP `hdope_type_paiement_champ_complementaire`;
ALTER TABLE `dope_detail_operation` DROP `dope_type_paiement_champ_complementaire`;

create or replace view view_mes_achats AS select `ope_id_compte` ,`com_id`, `com_nom`, `com_numero`, `com_date_marche_debut` 
from  `ope_operation` 
join opecp_operation_champ_complementaire on ope_id = opecp_ope_id AND opecp_chcp_id = 1
 join com_commande on opecp_valeur = `com_id`
where (`ope_operation`.`ope_type_paiement` in (7,8)) 
group by `ope_operation`.`ope_id_compte`,`com_commande`.`com_id`;

DROP VIEW view_compte_zeybu_liste_virement;
DROP VIEW view_compte_solidaire_operation;
DROP VIEW view_compte_solidaire_liste_adherent;
DROP VIEW view_operation_attente_adherent;
DROP VIEW view_reservation;
DROP VIEW view_operation_attente_ferme;
DROP VIEW view_marche_liste_reservation;
DROP VIEW view_export_achats;
DROP VIEW view_gestion_commande_liste_reservation;

ALTER TABLE `acc_acces` ADD `acc_nav` VARCHAR( 100 ) NOT NULL AFTER `acc_ip` ;