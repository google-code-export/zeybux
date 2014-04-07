CREATE OR REPLACE VIEW `view_liste_abonnes_produit` AS select `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement` AS `cptabo_id_produit_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_lot_abonnement` AS `cptabo_id_lot_abonnement`,`cptabo_compte_abonnement`.`cptabo_id_compte` AS `cptabo_id_compte`,`cptabo_compte_abonnement`.`cptabo_id` AS `cptabo_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`cptabo_compte_abonnement`.`cptabo_quantite` AS `cptabo_quantite`,`proabo_produit_abonnement`.`proabo_id_nom_produit` AS `proabo_id_nom_produit`, proabo_unite, `cptabo_compte_abonnement`.`cptabo_date_debut_suspension` AS `cptabo_date_debut_suspension`,`cptabo_compte_abonnement`.`cptabo_date_fin_suspension` AS `cptabo_date_fin_suspension` from ((((`cptabo_compte_abonnement` join `adh_adherent` on((`adh_adherent`.`adh_id_compte` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `cpt_compte` on((`cpt_compte`.`cpt_id` = `cptabo_compte_abonnement`.`cptabo_id_compte`))) join `proabo_produit_abonnement` on((`proabo_produit_abonnement`.`proabo_id` = `cptabo_compte_abonnement`.`cptabo_id_produit_abonnement`))) join `labo_lot_abonnement` on((`cptabo_compte_abonnement`.`cptabo_id_lot_abonnement` = `labo_lot_abonnement`.`labo_id`))) where ((`adh_adherent`.`adh_etat` = 1) and (`cptabo_compte_abonnement`.`cptabo_etat` = 0) and (`proabo_produit_abonnement`.`proabo_etat` = 0) and (`labo_lot_abonnement`.`labo_etat` = 0));