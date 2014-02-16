INSERT INTO `chcp_champ_complementaire` (`chcp_id`, `chcp_label`, `chcp_obligatoire`, `chcp_etat`) VALUES
(12, 'Id Ope Achat', 0, 0),
(13, 'Id Ope Achat Solidaire', 0, 0),
(14, 'Id Ope Rechargement', 0, 0),
(15, 'Id Requete', 1, 0);

INSERT INTO `tppcp_type_paiement_champ_complementaire` (`tppcp_tpp_id`, `tppcp_chcp_id`, `tppcp_maj_autorise`, `tppcp_ordre`, `tppcp_visible`, `tppcp_etat`) VALUES
(7, 13, 1, 3, 0, 0),
(7, 14, 1, 4, 0, 0),
(7, 15, 1, 5, 0, 0),
(8, 12, 1, 3, 0, 0),
(8, 14, 1, 4, 0, 0),
(8, 15, 1, 5, 0, 0),
(2, 12, 1, 4, 0, 0),
(2, 13, 1, 5, 0, 0),
(2, 15, 1, 6, 0, 0),
(1, 12, 1, 2, 0, 0),
(1, 13, 1, 3, 0, 0),
(1, 15, 1, 4, 0, 0);

CREATE TABLE IF NOT EXISTS `dach_detail_achat` (
  `dach_id_operation` int(11) NOT NULL,
  `dach_id_operation_solidaire` int(11) NOT NULL,
  `dach_id_nom_produit` int(11) NOT NULL,
  `dach_id_stock` int(11) NOT NULL,
  `dach_id_detail_operation` int(11) NOT NULL,
  `dach_id_stock_solidaire` int(11) NOT NULL,
  `dach_id_detail_operation_solidaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '4', 'Achat', 'Achat', '4', '1');

CREATE OR REPLACE VIEW `view_reservation_detail` AS select `sto_stock`.`sto_id_operation` AS `sto_id_operation`,`sto_stock`.`sto_id` AS `sto_id`,`dope_detail_operation`.`dope_id` AS `dope_id`,`sto_stock`.`sto_id_detail_commande` AS `sto_id_detail_commande`,`dope_detail_operation`.`dope_id_compte` AS `dope_id_compte`,`dope_detail_operation`.`dope_montant` AS `dope_montant`,`sto_stock`.`sto_quantite` AS `sto_quantite`,`dcom_detail_commande`.`dcom_id_produit` AS `dcom_id_produit`,`dope_detail_operation`.`dope_type_paiement` AS `dope_type_paiement`,`sto_stock`.`sto_type` AS `sto_type`,`dope_detail_operation`.`dope_id_nom_produit` AS `dope_id_nom_produit`, sto_unite
 from ((`sto_stock` join `dcom_detail_commande` on((`sto_stock`.`sto_id_detail_commande` = `dcom_detail_commande`.`dcom_id`))) left join `dope_detail_operation` on(((`sto_stock`.`sto_id_operation` = `dope_detail_operation`.`dope_id_operation`) and (`sto_stock`.`sto_id_detail_commande` = `dope_detail_operation`.`dope_id_detail_commande`)))) where ((`sto_stock`.`sto_type` in (0,5,6)) and (`dope_detail_operation`.`dope_type_paiement` in (0,15,16))) order by `sto_stock`.`sto_date` desc,`sto_stock`.`sto_type`;
 
INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_visible`) VALUES
(22, 'Réservation Achetée', 0, 0);

drop view view_mes_achats;