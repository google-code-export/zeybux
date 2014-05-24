INSERT INTO `vue_vues` (`vue_id`, `vue_id_module`, `vue_nom`, `vue_label`, `vue_ordre`, `vue_visible`) VALUES ('21', '12', 'CaissePermanente', 'La Caisse Permanente', '2', '1');

create or replace view view_stock_produit_disponible as
select
npro_id, npro_numero, npro_nom,
cpro_id, cpro_nom,
fer_id, fer_numero, fer_nom, fer_id_compte,
stoqte_id, stoqte_quantite, stoqte_quantite_solidaire, stoqte_unite,
mlot_id, mlot_quantite, mlot_unite, mlot_prix
from npro_nom_produit
join cpro_categorie_produit on cpro_id = npro_id_categorie
join fer_ferme on fer_id = npro_id_ferme
join stoqte_stock_quantite on stoqte_id_nom_produit = npro_id
join mlot_modele_lot on mlot_id_nom_produit = npro_id and mlot_unite = stoqte_unite
where npro_etat = 0
and cpro_etat = 0
and fer_etat = 0
and stoqte_etat = 0
and (stoqte_quantite + stoqte_quantite_solidaire) > 0
and mlot_etat = 0
order by cpro_nom, npro_nom, stoqte_unite, mlot_quantite;