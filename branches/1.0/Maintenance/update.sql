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

create or replace view view_adherent as

select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,`adh_adherent`.`adh_courriel_secondaire` AS `adh_courriel_secondaire`,`adh_adherent`.`adh_telephone_principal` AS `adh_telephone_principal`,`adh_adherent`.`adh_telephone_secondaire` AS `adh_telephone_secondaire`,`adh_adherent`.`adh_adresse` AS `adh_adresse`,`adh_adherent`.`adh_code_postal` AS `adh_code_postal`,`adh_adherent`.`adh_ville` AS `adh_ville`,`adh_adherent`.`adh_date_naissance` AS `adh_date_naissance`,`adh_adherent`.`adh_date_adhesion` AS `adh_date_adhesion`,`adh_adherent`.`adh_date_maj` AS `adh_date_maj`,`adh_adherent`.`adh_commentaire` AS `adh_commentaire`,cpt_solde AS cpt_solde 

from `adh_adherent` 
left join `cpt_compte` on `cpt_compte`.`cpt_id` = `adh_adherent`.`adh_id_compte`;


create or replace view view_operation_passee as

select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`tpp_type_paiement`.`tpp_type` AS `tpp_type`,`tpp_type_paiement`.`tpp_champ_complementaire` AS `tpp_champ_complementaire`,`tpp_type_paiement`.`tpp_label_champ_complementaire` AS `tpp_label_champ_complementaire`,`ope_operation`.`ope_type_paiement_champ_complementaire` AS `ope_type_paiement_champ_complementaire` 


from ((`ope_operation` join `cpt_compte` on((`ope_operation`.`ope_id_compte` = `cpt_compte`.`cpt_id`))) left join `tpp_type_paiement` on((`ope_operation`.`ope_type_paiement` = `tpp_type_paiement`.`tpp_id`))) 

where (`ope_operation`.`ope_type_paiement` in (-1,1,2,3,4,7,8,9,10)) 


order by `ope_operation`.`ope_date` desc;

create or replace view view_operation_avenir as
select `ope_operation`.`ope_id_compte` AS `ope_id_compte`,`ope_operation`.`ope_montant` AS `ope_montant`,`ope_operation`.`ope_libelle` AS `ope_libelle`,`ope_operation`.`ope_date` AS `ope_date`,`com_commande`.`com_date_marche_debut` AS `com_date_marche_debut`

from `ope_operation` left join `com_commande` on `com_commande`.`com_id` = `ope_operation`.`ope_id_commande`

where `ope_operation`.`ope_type_paiement` = 0
and (`com_commande`.`com_archive` = 0) 
order by `com_commande`.`com_date_marche_debut`;