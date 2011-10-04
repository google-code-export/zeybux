UPDATE `vue_vues` SET `vue_nom` = 'MonMarche' WHERE `vue_vues`.`vue_id` =4;
UPDATE `vue_vues` SET `vue_ordre` = '1' WHERE `vue_vues`.`vue_id` =4;
UPDATE `vue_vues` SET `vue_nom` = 'MesAchats',`vue_label` = 'Mes Achats',`vue_ordre` = '2' WHERE `vue_vues`.`vue_id` =8;
create view view_mes_achats as
SELECT ope_id_compte,com_id,com_numero,com_date_marche_debut
FROM com_commande JOIN `ope_operation` on ope_id_commande = com_id  WHERE `ope_type_paiement` in (7,8);