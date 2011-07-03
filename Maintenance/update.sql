INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_label_champ_complementaire` ,
`tpp_visible`
)
VALUES (
NULL , 'Virement Solidaire (émission)', '1', 'Id compte reception', '0'
);

INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_label_champ_complementaire` ,
`tpp_visible`
)
VALUES (
NULL , 'Virement Solidaire (réception)', '1', 'Id compte émission', '0'
);

ALTER TABLE `cpt_compte` ADD `cpt_solde` INT NOT NULL ;
ALTER TABLE `cpt_compte` CHANGE `cpt_solde` `cpt_solde` DECIMAL( 10, 2 ) NOT NULL ;

INSERT INTO `ide_identification` (`ide_id`, `ide_id_login`, `ide_login`, `ide_pass`, `ide_type`, `ide_autorise`) VALUES (NULL, '0', 'EAU', '01f01083386dc09d99826461b2b6c6f1', '4', '1');

create or replace view view_compte_solidaire_operation

as select `ope1`.`ope_id` AS `ope_id`,`ope1`.`ope_date` AS `ope_date`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope1`.`ope_montant` AS `ope_montant`,`ope1`.`ope_type_paiement` AS `ope_type_paiement` from ((`ope_operation` `ope1` left join `ope_operation` `ope2` on((`ope1`.`ope_type_paiement_champ_complementaire` = `ope2`.`ope_id`))) left join `cpt_compte` on((`ope2`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) where ((`ope1`.`ope_id_compte` = '-2') and (`ope1`.`ope_type` = 1) and (`ope1`.`ope_type_paiement` in (3,4,9,10)))

order by `ope_date` DESC;

create view view_compte_solidaire_liste_adherent
as
select 
adh_id,
adh_numero,
cpt_label,
adh_nom,
adh_prenom
from adh_adherent
join cpt_compte on adh_id_compte = cpt_id
where `adh_adherent`.`adh_etat` = 1;

INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (NULL, 'Annulation Virement (émission)', '1', 'Id operation reception', '0');
INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (NULL, 'Annulation Virement (réception)', '1', 'Id operation émission', '0');
INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (NULL, 'Annulation Virement Solidaire (émission)', '1', 'Id operation reception', '0');
INSERT INTO `tpp_type_paiement` (`tpp_id`, `tpp_type`, `tpp_champ_complementaire`, `tpp_label_champ_complementaire`, `tpp_visible`) VALUES (NULL, 'Annulation Virement Solidaire (réception)', '1', 'Id operation émission', '0');


