ALTER TABLE `tpp_type_paiement` DROP `tpp_label_champ_complementaire`;

 ALTER TABLE `ope_operation`
  DROP `ope_type_paiement_champ_complementaire`,
  DROP `ope_id_commande`,
  DROP `ope_id_banque`;