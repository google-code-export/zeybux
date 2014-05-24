ALTER TABLE `tppcp_type_paiement_champ_complementaire` ADD `tppcp_maj_autorise` TINYINT( 1 ) NOT NULL AFTER `tppcp_chcp_id`;

update `tppcp_type_paiement_champ_complementaire`
set tppcp_maj_autorise = 1
 WHERE `tppcp_chcp_id` not in ( 1, 11);