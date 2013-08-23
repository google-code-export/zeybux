SET @pos=0;
insert into opecp_operation_champ_complementaire
SELECT ope_id, 11,  @pos:=@pos+1
			FROM ope_operation
			WHERE ope_type_paiement = 6;
			
update cop_compteur
set cop_valeur = (
select  max(cast(opecp_valeur AS UNSIGNED)) +1
from opecp_operation_champ_complementaire
where  opecp_chcp_id = 11 AND
opecp_ope_id in (
SELECT ope_id
			FROM ope_operation
			WHERE ope_type_paiement = 6))
where cop_id = 1;

DROP VIEW view_liste_ferme;

CREATE OR replace VIEW `view_liste_nom_produit` AS select `npro_nom_produit`.`npro_id_ferme` AS `npro_id_ferme`,`npro_nom_produit`.`npro_id` AS `npro_id`,`npro_nom_produit`.`npro_nom` AS `npro_nom`,`cpro_categorie_produit`.`cpro_nom` AS `cpro_nom`,`cpro_categorie_produit`.`cpro_id` AS `cpro_id` , npro_numero
from (`npro_nom_produit` join `cpro_categorie_produit` on((`cpro_categorie_produit`.`cpro_id` = `npro_nom_produit`.`npro_id_categorie`))) where (`npro_nom_produit`.`npro_etat` = 0) order by `cpro_categorie_produit`.`cpro_nom`,`npro_nom_produit`.`npro_nom`;

CREATE TABLE IF NOT EXISTS `dfac_detail_facture` (
  `dfac_id_operation` int(11) NOT NULL,
  `dfac_id_stock` int(11) NOT NULL,
  `dfac_id_detail_operation` int(11) NOT NULL,
  `dfac_id_stock_solidaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_visible`
)
VALUES (
'21', 'Vide', '0', '0'
);