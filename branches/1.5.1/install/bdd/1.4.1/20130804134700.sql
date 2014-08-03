INSERT INTO `chcp_champ_complementaire` (`chcp_id`, `chcp_label`, `chcp_obligatoire`, `chcp_etat`) VALUES
(9, 'Facture Id Ope Producteur', 1, 0),
(10, 'Facture Id Ope Zeybu', 1, 0),
(11, 'Numéro Facture', 1, 0);

UPDATE `chcp_champ_complementaire` SET `chcp_etat` = '1' WHERE `chcp_champ_complementaire`.`chcp_id` =7;

insert into opecp_operation_champ_complementaire ( opecp_ope_id, opecp_chcp_id, opecp_valeur)
SELECT 
ope_id,
9,
iol_id_ope_producteur

FROM ope_operation 
join opecp_operation_champ_complementaire on opecp_ope_id = ope_id
AND opecp_chcp_id = 7
join iol_info_operation_livraison on opecp_valeur = iol_id
where ope_type_paiement = 6;

insert into opecp_operation_champ_complementaire ( opecp_ope_id, opecp_chcp_id, opecp_valeur)
SELECT 
ope_id,
10,
iol_id_ope_zeybu
FROM ope_operation 
join opecp_operation_champ_complementaire on opecp_ope_id = ope_id
AND opecp_chcp_id = 7
join iol_info_operation_livraison on opecp_valeur = iol_id
where ope_type_paiement = 6;

ALTER TABLE `sto_stock` ADD `sto_id_nom_produit` INT NOT NULL ,
ADD `sto_unite` VARCHAR( 20 ) NOT NULL ,
ADD INDEX ( `sto_id_nom_produit` );

CREATE TABLE IF NOT EXISTS `cop_compteur` (
  `cop_id` int(11) NOT NULL AUTO_INCREMENT,
  `cop_label` varchar(20) NOT NULL,
  `cop_valeur` int(11) NOT NULL,
  `cop_date_creation` datetime NOT NULL,
  `cop_date_modification` datetime NOT NULL,
  `cop_etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`cop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `cop_compteur` (`cop_id`, `cop_label`, `cop_valeur`, `cop_date_creation`, `cop_date_modification`, `cop_etat`) VALUES (NULL, 'Numero Facture', '1', NOW(), '0', '0');

update sto_stock a
set a.sto_id_nom_produit = (
  select pro_id_nom_produit
  from dcom_detail_commande 
   join pro_produit on pro_id = dcom_id_produit
  where  a.sto_id_detail_commande = dcom_id
 )
where sto_type in (0, 1, 2, 4);

update sto_stock a
set a.sto_unite = (
  select pro_unite_mesure
  from dcom_detail_commande 
   join pro_produit on pro_id = dcom_id_produit
  where  a.sto_id_detail_commande = dcom_id
 )
where sto_type in (0, 1, 2, 4);

update dope_detail_operation a
set a.dope_id_nom_produit = (
  select pro_id_nom_produit
  from dcom_detail_commande 
   join pro_produit on pro_id = dcom_id_produit
  where  a.dope_id_detail_commande = dcom_id
 )
WHERE dope_type_paiement in (0, 6);

INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES (NULL, '4', 'Facture', 'Facture', '3', '1');
