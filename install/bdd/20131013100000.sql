ALTER TABLE `cpt_compte` ADD `cpt_id_adherent_principal` INT NOT NULL;

CREATE OR REPLACE VIEW `view_adherent` AS select `adh_adherent`.`adh_id` AS `adh_id`,`adh_adherent`.`adh_numero` AS `adh_numero`,`adh_adherent`.`adh_id_compte` AS `adh_id_compte`,`cpt_compte`.`cpt_label` AS `cpt_label`,`adh_adherent`.`adh_nom` AS `adh_nom`,`adh_adherent`.`adh_prenom` AS `adh_prenom`,`adh_adherent`.`adh_courriel_principal` AS `adh_courriel_principal`,`adh_adherent`.`adh_courriel_secondaire` AS `adh_courriel_secondaire`,`adh_adherent`.`adh_telephone_principal` AS `adh_telephone_principal`,`adh_adherent`.`adh_telephone_secondaire` AS `adh_telephone_secondaire`,`adh_adherent`.`adh_adresse` AS `adh_adresse`,`adh_adherent`.`adh_code_postal` AS `adh_code_postal`,`adh_adherent`.`adh_ville` AS `adh_ville`,`adh_adherent`.`adh_date_naissance` AS `adh_date_naissance`,`adh_adherent`.`adh_date_adhesion` AS `adh_date_adhesion`,`adh_adherent`.`adh_date_maj` AS `adh_date_maj`,`adh_adherent`.`adh_commentaire` AS `adh_commentaire`,`cpt_compte`.`cpt_solde` AS `cpt_solde`,`adh_adherent`.`adh_etat` AS `adh_etat`,
cpt_id_adherent_principal
 from (`adh_adherent` left join `cpt_compte` on((`cpt_compte`.`cpt_id` = `adh_adherent`.`adh_id_compte`)));
 
 update adh_adherent
join cpt_compte on adh_id_compte = cpt_id
SET cpt_id_adherent_principal = adh_id
where adh_etat = 1;