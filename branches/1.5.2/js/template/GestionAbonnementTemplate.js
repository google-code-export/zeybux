;function GestionAbonnementTemplate() {
	this.listeProduit = 
		"<div id=\"contenu\">" +			
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Produits" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-nv-produit\" title=\"Ajouter un produit\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +
				"</div>" +
				"<div id=\"liste-produit-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"<form id=\"filter-form\">" +
						"<div>" +
							"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
									"<span class=\"ui-icon ui-icon-search\">" +
								"</span>" +
							"</span>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
						"</div>" +
					"</form>" +
				"</div>" +
				"<table class=\"com-table\">" +
					"<!-- BEGIN fermes -->" +
						"<tr class=\"ui-widget-header\">" +
							"<th class=\"com-table-th\">{fermes.nom}</th>" +
						"</tr>" +
						"<!-- BEGIN fermes.categories -->" +
						"<tr class=\"ui-widget-header\">" +
							"<th class=\"com-table-th\">{fermes.categories.nom}</th>" +
						"</tr>" +
						"<!-- BEGIN fermes.categories.produits -->" +
						"<tbody>" +
						"<tr class=\"com-cursor-pointer ligne-produit\" idProduit=\"{fermes.categories.produits.id}\" >" +
							"<td class=\"com-table-td com-underline-hover\">{fermes.categories.produits.nom}</td>" +
						"</tr>" +
						"</tbody>" +
						"<!-- END fermes.categories.produits -->" +
						"<!-- END fermes.categories -->" +
						"<!-- END fermes -->" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeProduitVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Produits" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-nv-produit\" title=\"Ajouter un produit\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucun produit dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutProduit =
		"<div id=\"dialog-ajout-pro\" title=\"Produit\">" +
			"<div id=\"information-detail-producteur\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Le Produit</div>" +

				"<div id=\"pro-idFerme\" class=\"com-float-left\">" +
					"<select name=\"ferme\">" +
						"<option value=\"0\" >== Choisir une ferme ==</option>" +
						"<!-- BEGIN listeFerme -->" +
						"<option value=\"{listeFerme.ferId}\" >{listeFerme.ferNom}</option>" +
						"<!-- END listeFerme -->" +
					"</select>" +
				"</div>" +
				"<div id=\"pro-idCategorie\" class=\"com-float-left\">" +
					"<select name=\"categorie\" disabled=\"disabled\">" +
						"<option value=\"0\" >== Choisir une catégorie ==</option>" +
					"</select>" +
				"</div>" +
				"<div id=\"pro-idProduit\" class=\"com-float-left\">" +
					"<select name=\"produit\" disabled=\"disabled\">" +
						"<option value=\"0\" >== Choisir un produit ==</option>" +
					"</select>" +
				"</div>" +
			"</div>" +
			"<div id=\"detail-produit\">" +
			"</div>" +
		"</div>";
	
	this.ajoutProduitSelectCategorie =
		"<div id=\"pro-idCategorie\" class=\"com-float-left\">" +
			"<select name=\"categorie\">" +
				"<option value=\"0\" >== Choisir une catégorie ==</option>" +
				"<!-- BEGIN listeCategorie -->" +
				"<option value=\"{listeCategorie.cproId}\" >{listeCategorie.cproNom}</option>" +
				"<!-- END listeCategorie -->" +
			"</select>" +
		"</div>";
	
	this.ajoutProduitSelectProduit =
		"<div id=\"pro-idProduit\" class=\"com-float-left\">" +
			"<select name=\"produit\">" +
				"<option value=\"0\" >== Choisir un produit ==</option>" +
				"<!-- BEGIN listeProduit -->" +
				"<option value=\"{listeProduit.nproId}\" >{listeProduit.nproNom}</option>" +
				"<!-- END listeProduit -->" +
			"</select>" +
		"</div>";
	
	this.detailProduitAjoutProduit =
		"<div id=\"detail-produit\">" +
			"<div>" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Détail</div>" +
				"<table class=\"com-table-form\">" +
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
							"Fréquence : " +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"pro-frequence\" maxlength=\"200\" id=\"pro-frequence\"/>" +
						"</td>" +
					"</tr>" +
				"</table>" +
				
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Prix de vente</div>" +
				"<table class=\"com-table-form\" id=\"table-pro-prix\">" +
					"<tr>" +
						"<td class=\"catalogue-entete-lot\">Quantité</td>" +
						"<td class=\"catalogue-entete-lot\">Unité</td>" +
						"<td>Prix</td>" +
						"<td></td>" +
						"<td></td>" +
					"</tr>" +
					"<tr class=\"btn-lot\">" +
						"<td>" +
							"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-quantite\" maxlength=\"13\" id=\"pro-lot-quantite\"/>" +
						"</td>" +
						"<td>" +
							"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"lot-unite\" maxlength=\"20\" id=\"pro-lot-unite\"/>" +
						"</td>" +
						"<td>" +
							"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-prix\" maxlength=\"13\" id=\"pro-lot-prix\"/> {sigleMonetaire}" +
						"</td>" +
						"<td colspan=\"2\">" +
							"<button type=\"button\" id=\"btn-ajout-lot\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter</button>" +
						"</td>" +
					"</tr>" +
				"</table>" +
				"<table class=\"com-table\" id=\"lot-liste\">" +
		
					"<!-- BEGIN modelesLot -->" +
					"<tr class=\"ligne-lot\" id=\"ligne-lot-{modelesLot.id}\">" +
						"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLot.id}</span></td>" +
						"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
							"<input type=\"checkbox\" value=\"{modelesLot.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLot.id}-id\" class=\"modele-lot\"/>" +
						"</td>" +
						"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
							"<span class=\"champ-lot-{modelesLot.id} lot-quantite\" id=\"lot-{modelesLot.id}-quantite\">{modelesLot.quantite}</span>"+
							"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-quantite\" maxlength=\"13\" id=\"pro-lot-{modelesLot.id}-quantite\"/>" +
						"</td>" +
						"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
							"<span class=\"champ-lot-{modelesLot.id} lot-unite\" id=\"lot-{modelesLot.id}-unite\">{modelesLot.unite}</span>" +
							"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-unite\" maxlength=\"20\" id=\"pro-lot-{modelesLot.id}-unite\"/>" +
						"</td>" +
						"<td class=\"com-table-td-med\">" +
							"à " +
							"<span class=\"champ-lot-{modelesLot.id} lot-prix\" id=\"lot-{modelesLot.id}-prix\">{modelesLot.prix}</span>" +
							"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-prix\" maxlength=\"13\" id=\"pro-lot-{modelesLot.id}-prix\"/>" +
							" {modelesLot.sigleMonetaire}" +
						"</td>" +
						"<td class=\"com-table-td-med td-edt\">" +
							"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot\" title=\"Modifier\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot\" id=\"btn-valider-lot-{modelesLot.id}\" title=\"Valider\">" +
								"<span class=\"ui-icon ui-icon-check\"></span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot\" id=\"btn-annuler-lot-{modelesLot.id}\" title=\"Annuler\">" +
								"<span class=\"ui-icon ui-icon-closethick\"></span>" +
							"</span>" +
							"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot\" title=\"Supprimer\">" +				
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"<!-- END modelesLot -->" +
				
				"</table>" +
				
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Stock</div>" +
				"<table class=\"com-table-form\">" +
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
							"Limite de stock : " +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"pro-stockInitial\" maxlength=\"13\" id=\"pro-stockInitial\"/> <span class=\"unite-stock\">{unite}</span>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
							"Quantité max par adhérent : " +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"0\" checked=\"checked\"/>Pas de limite" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"1\" />" +
							"<input disabled=\"disabled\" class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"pro-qte-max\" maxlength=\"13\" id=\"pro-max\"/> <span class=\"unite-stock\">{unite}</span>" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
		"</div>" ;
	
	this.dialogModifierProduit =
		"<div id=\"dialog-modif-pro\" title=\"Modifier : {nproNom}\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Détail</div>" +
			"<table class=\"com-table-form\">" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Fréquence : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input type=\"hidden\" name=\"idProduit\" value=\"{proAboId}\"/>" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"pro-frequence\" maxlength=\"200\" id=\"pro-frequence\" value=\"{proAboFrequence}\"/>" +
					"</td>" +
				"</tr>" +
			"</table>" +
			
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Prix de vente</div>" +
			"<table class=\"com-table-form\" id=\"table-pro-prix\">" +
				"<tr>" +
					"<td class=\"catalogue-entete-lot\">Quantité</td>" +
					"<td class=\"catalogue-entete-lot\">Unité</td>" +
					"<td>Prix</td>" +
					"<td></td>" +
					"<td></td>" +
				"</tr>" +
				"<tr class=\"btn-lot\">" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-quantite\" maxlength=\"13\" id=\"pro-lot-quantite\"/>" +
					"</td>" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"lot-unite\" maxlength=\"20\" id=\"pro-lot-unite\"/>" +
					"</td>" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-prix\" maxlength=\"13\" id=\"pro-lot-prix\"/> {sigleMonetaire}" +
					"</td>" +
					"<td colspan=\"2\">" +
						"<button type=\"button\" id=\"btn-ajout-lot\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter</button>" +
					"</td>" +
				"</tr>" +
			"</table>" +
			"<table class=\"com-table\" id=\"lot-liste\">" +
				"<!-- BEGIN modelesLotReservation -->" +
				"<tr class=\"ligne-lot\" id=\"ligne-lot-{modelesLotReservation.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLotReservation.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" checked=\"checked\" disabled=\"disabled\" value=\"{modelesLotReservation.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLotReservation.id}-id\" {modelesLotReservation.checked} class=\"{modelesLotReservation.modele}\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{modelesLotReservation.id} lot-quantite\" id=\"lot-{modelesLotReservation.id}-quantite\">{modelesLotReservation.quantite}</span>"+
						"<input class=\"champ-lot-{modelesLotReservation.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotReservation.id}-quantite\" maxlength=\"13\" id=\"pro-lot-{modelesLotReservation.id}-quantite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{modelesLotReservation.id} lot-unite\" id=\"lot-{modelesLotReservation.id}-unite\">{modelesLotReservation.unite}</span>" +
						"<input class=\"champ-lot-{modelesLotReservation.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotReservation.id}-unite\" maxlength=\"20\" id=\"pro-lot-{modelesLotReservation.id}-unite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{modelesLotReservation.id} lot-prix\" id=\"lot-{modelesLotReservation.id}-prix\">{modelesLotReservation.prix}</span>" +
						"<input class=\"champ-lot-{modelesLotReservation.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotReservation.id}-prix\" maxlength=\"13\" id=\"pro-lot-{modelesLotReservation.id}-prix\"/>" +
						" {modelesLotReservation.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
						"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot\" id=\"btn-valider-lot-{modelesLotReservation.id}\" title=\"Valider\">" +
							"<span class=\"ui-icon ui-icon-check\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot\" id=\"btn-annuler-lot-{modelesLotReservation.id}\" title=\"Annuler\">" +
							"<span class=\"ui-icon ui-icon-closethick\"></span>" +
						"</span>" +
						"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot\"  id=\"btn-supprimer-lot-{modelesLotReservation.id}\" title=\"Supprimer\">" +				
							"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
				"<!-- END modelesLotReservation -->" +
			
				"<!-- BEGIN modelesLot -->" +
				"<tr class=\"ligne-lot\" id=\"ligne-lot-{modelesLot.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLot.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" value=\"{modelesLot.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLot.id}-id\" {modelesLot.checked} class=\"{modelesLot.modele}\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{modelesLot.id} lot-quantite\" id=\"lot-{modelesLot.id}-quantite\">{modelesLot.quantite}</span>"+
						"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-quantite\" maxlength=\"13\" id=\"pro-lot-{modelesLot.id}-quantite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{modelesLot.id} lot-unite\" id=\"lot-{modelesLot.id}-unite\">{modelesLot.unite}</span>" +
						"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-unite\" maxlength=\"20\" id=\"pro-lot-{modelesLot.id}-unite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{modelesLot.id} lot-prix\" id=\"lot-{modelesLot.id}-prix\">{modelesLot.prix}</span>" +
						"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-prix\" maxlength=\"13\" id=\"pro-lot-{modelesLot.id}-prix\"/>" +
						" {modelesLot.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
						"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot\" id=\"btn-valider-lot-{modelesLot.id}\" title=\"Valider\">" +
							"<span class=\"ui-icon ui-icon-check\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot\" id=\"btn-annuler-lot-{modelesLot.id}\" title=\"Annuler\">" +
							"<span class=\"ui-icon ui-icon-closethick\"></span>" +
						"</span>" +
						"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot\"  id=\"btn-supprimer-lot-{modelesLot.id}\" title=\"Supprimer\">" +				
							"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
				"<!-- END modelesLot -->" +
	
				"<!-- BEGIN listeModelesLot -->" +
				"<tr class=\"ligne-lot\" id=\"ligne-lot-modele-{listeModelesLot.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{listeModelesLot.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" value=\"{listeModelesLot.id}\" name=\"pro-lot\" id=\"pro-lot-{listeModelesLot.id}-id\" {listeModelesLot.checked} class=\"{listeModelesLot.modele}\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{listeModelesLot.id} lot-quantite\" id=\"lot-{listeModelesLot.id}-quantite\">{listeModelesLot.quantite}</span>"+
						"<input class=\"champ-lot-{listeModelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{listeModelesLot.id}-quantite\" maxlength=\"13\" id=\"pro-lot-{listeModelesLot.id}-quantite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{listeModelesLot.id} lot-unite\" id=\"lot-{listeModelesLot.id}-unite\">{listeModelesLot.unite}</span>" +
						"<input class=\"champ-lot-{listeModelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{listeModelesLot.id}-unite\" maxlength=\"20\" id=\"pro-lot-{listeModelesLot.id}-unite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{listeModelesLot.id} lot-prix\" id=\"lot-{listeModelesLot.id}-prix\">{listeModelesLot.prix}</span>" +
						"<input class=\"champ-lot-{listeModelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{listeModelesLot.id}-prix\" maxlength=\"13\" id=\"pro-lot-{listeModelesLot.id}-prix\"/>" +
						" {listeModelesLot.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
					"</td>" +
				"</tr>" +
				"<!-- END listeModelesLot -->" +
			
			"</table>" +
			
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Stock</div>" +
			"<table class=\"com-table-form\">" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Limite de stock : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"pro-stockInitial\" maxlength=\"13\" id=\"pro-stockInitial\" value=\"{proAboStockInitial}\"/> <span class=\"unite-stock\">{proAboUnite}</span>" +
					"</td>" +
				"</tr>" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Quantité max par adhérent : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"0\" {checkedNoLimit}/>Pas de limite" +
					"</td>" +
				"</tr>" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input {checkedLimit} class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"1\" />" +
						"<input {disableLimit} class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"pro-qte-max\" maxlength=\"13\" id=\"pro-max\" value=\"{max}\"/> <span class=\"unite-stock\">{proAboUnite}</span>" +
					"</td>" +
				"</tr>" +
			"</table>" +
		"</div>";
	
	this.modeleLot =
		"<tr class=\"ligne-lot\" id=\"ligne-lot-{id}\">" +
			"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{id}</span></td>" +
			"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
				"<input type=\"checkbox\" value=\"{id}\" name=\"pro-lot\" id=\"pro-lot-{id}-id\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
				"<span class=\"champ-lot-{id} lot-quantite\" id=\"lot-{id}-quantite\">{quantite}</span>"+
				"<input class=\"champ-lot-{id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{id}-quantite\" maxlength=\"13\" id=\"pro-lot-{id}-quantite\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
				"<span class=\"champ-lot-{id} lot-unite\" id=\"lot-{id}-unite\">{unite}</span>" +
				"<input class=\"champ-lot-{id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{id}-unite\" maxlength=\"20\" id=\"pro-lot-{id}-unite\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med\">" +
				"à " +
				"<span class=\"champ-lot-{id} lot-prix\" id=\"lot-{id}-prix\">{prix}</span>" +
				"<input class=\"champ-lot-{id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{id}-prix\" maxlength=\"13\" id=\"pro-lot-{id}-prix\"/>" +
				" {sigleMonetaire}" +
			"</td>" +
			"<td class=\"com-table-td-med td-edt\">" +
				"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot\" title=\"Modifier\">" +
					"<span class=\"ui-icon ui-icon-pencil\"></span>" +
				"</span>" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot\" id=\"btn-valider-lot-{id}\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check\"></span>" +
				"</span>" +
			"</td>" +
			"<td class=\"com-table-td-fin td-edt\">" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot\" id=\"btn-annuler-lot-{id}\" title=\"Annuler\">" +
					"<span class=\"ui-icon ui-icon-closethick\"></span>" +
				"</span>" +
				"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot\" id=\"btn-supprimer-lot-abonnement-{id}\" title=\"Supprimer\">" +				
					"<span class=\"ui-icon ui-icon-trash\"></span>" +
				"</span>" +
			"</td>" +
		"</tr>";
	
	this.dialogSupprimerLotModifierMarche =
		"<div id=\"dialog-supp-lot\" title=\"Supprimer le prix de vente\">" +
			"<div id=\"information-detail-producteur\">" +
				"Des abonnements sont positionnés sur ce prix de vente.<br/>" +
				"Veuillez préciser le nouveau prix de vente sur lequel se baseront ces abonnements." +				
			"</div>" +
			"<div>" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Prix de vente</div>" +
				"<table class=\"com-table-100\" id=\"lot-liste\">" +				
					"<!-- BEGIN modelesLot -->" +
					"<tr class=\"ligne-lot\" id=\"ligne-lot-{modelesLot.id}\">" +
						"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
							"<input type=\"radio\" value=\"{modelesLot.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLot.id}-id\"/>" +
						"</td>" +
						"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
							"<span class=\"champ-lot-{modelesLot.id} lot-quantite\" id=\"lot-{modelesLot.id}-quantite\">{modelesLot.quantite}</span>"+
						"</td>" +
						"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
							"<span class=\"champ-lot-{modelesLot.id} lot-unite\" id=\"lot-{modelesLot.id}-unite\">{modelesLot.unite}</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin\">" +
							"à " +
							"<span class=\"champ-lot-{modelesLot.id} lot-prix\" id=\"lot-{modelesLot.id}-prix\">{modelesLot.prix}</span>" +
							" {modelesLot.sigleMonetaire}" +
						"</td>" +
					"</tr>" +
					"<!-- END modelesLot -->" +				
				"</table>" +
			"</div>" +
		"</div>";
	
	this.detailProduit = 
		"<div id=\"contenu\">" +	
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-retour\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour" +
				"</button>" +
			"</div>" +		
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Abonnement : {nproNom}" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-supp\" title=\"Supprimer\" idProduit=\"{proAboId}\">" +
						"<span class=\"ui-icon ui-icon-trash\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples  ui-widget-content ui-corner-all\" id=\"btn-modifier\" title=\"Modifier\" idProduit=\"{proAboId}\">" +
						"<span class=\"ui-icon ui-icon-pencil\"></span>" +
					"</span>" +
				"</div>" +
				"Fréquence : {proAboFrequence}<br/>" +
				"Stock : {proAboStockInitial} {proAboUnite}<br/>" +
				"Quantité max par adhérent : {proAboMax}<br/>" +
				"Total quantité d'abonnement : {proAboReservation} {proAboUnite}<br/>" +
			"</div>" +
			"{listeAbonnes}" +
		"</div>";
	
	this.detailProduitListeAbonnes =
		"<div class=\"com-widget-window ui-widget ui-widget-content-transparent ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Adhérents Abonnés" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export\" title=\"Exporter\">" +
					"<span class=\"ui-icon ui-icon-print\"></span>" +
				"</span>" +
			"</div>" +
			"<table id=\"liste-adherent\" class=\"com-table\">" +
				"<thead>" +
					"<tr>" +
						"<th>N°</th>" +
						"<th>Compte</th>" +
						"<th>Nom</th>" +
						"<th>Prénom</th>" +
						"<th>Quantité</th>" +
						"<th></th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
					"<!-- BEGIN abonnes -->" +
					"<tr>" +
						"<td>{abonnes.adhNumero}</td>" +
						"<td>{abonnes.cptLabel}</td>" +
						"<td>{abonnes.adhNom}</td>" +
						"<td>{abonnes.adhPrenom}</td>" +
						"<td>{abonnes.cptAboQuantite}</td>" +
						"<td>{abonnes.proAboUnite}</td>" +
					"</tr>" +
					"<!-- END abonnes -->" +
				"</tbody>" +
			"</table>" +
		"</div>";
	
	/*this.detailProduitListeAbonnesVide =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Adhérents Abonnés" +
			"</div>" +
			"<p id=\"texte-liste-vide\">Aucun abonné sur ce produit.</p>" +	
		"</div>";*/
	
	this.dialogSuppressionProduit =
		"<div id=\"dialog-supp-produit\" title=\"Supprimer abonnement de produit\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer l'abonnement à ce produit?</p>" +
		"</div>";
	
	/*this.listeAdherentVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Adhérents" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucun adhérent.</p>" +	
			"</div>" +
		"</div>";*/
	
	this.listeAdherent = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Adhérents" +
				"</div>" +
				"<table id=\"liste-adherent\" class=\"com-table\">" +
					"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th>N°</th>" +
							"<th>Compte</th>" +
							"<th>Nom</th>" +
							"<th>Prénom</th>" +
							"<th></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN listeAdherent -->" +
						"<tr class=\"compte-ligne\" id-adherent=\"{listeAdherent.adhId}\">" +
							"<td>" +
								"{listeAdherent.adhNumero}" +
							"</td>" +
							"<td>{listeAdherent.cptLabel}</td>" +
							"<td>{listeAdherent.adhNom}</td>" +
							"<td>{listeAdherent.adhPrenom}</td>" +
							"<td>" +
								"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
				"<!-- END listeAdherent -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.detailAbonne = 
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-retour\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour" +
				"</button>" +
			"</div>" +	
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Adhérent" +
				"</div>" +
				"<div class=\"com-float-left\">{adhNumero} : {adhPrenom} {adhNom}</div>" +
				"<div class=\"com-center\">{suspension}</div>" +
			"</div>" +
			"{listeProduit}" +
		"</div>";
	
	this.buttonSuspendre =
		"<button type=\"button\" id=\"btn-ajout-suspension\" class=\"ui-state-default ui-corner-all com-button com-center\">Suspendre</button>";
	
	this.buttonModifierSuspendre =
		"Abonnements suspendus du {dateDebutsuspension} au {dateFinsuspension}<br/><br/>" +
		"<button type=\"button\" id=\"btn-modif-suspension\" class=\"com-btn-edt-multiples  ui-state-default ui-corner-all com-button com-center\">Modifier la suspension</button>" +
		"<button type=\"button\" id=\"btn-supp-suspension\" class=\"ui-state-default ui-corner-all com-button com-center\">Supprimer la suspension</button>";
	
	this.dialogAjoutSuspension =
		"<div id=\"dialog-ajout-suspension\" title=\"Suspendre les abonnements\">" +
			"<table class=\"com-table-form\">" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Du : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"dateDebutSuspension\" maxlength=\"10\" id=\"dateDebutSuspension\" value=\"{dateDebutSuspension}\"/> inclus" +
					"</td>" +
				"</tr>" +
				"<tr>" +
				"<th class=\"com-table-form-th\">" +
						"Au : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"dateFinSuspension\" maxlength=\"10\" id=\"dateFinSuspension\" value=\"{dateFinSuspension}\"/> inclus" +
					"</td>" +
				"</tr>" +
			"</table>" +
		"</div>";
	
	this.dialogSupprimerSuspension =
		"<div id=\"dialog-supp-abonnement\" title=\"Arrêter suspension\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>Voulez-vous arrêter la suspension d'abonnement?</p>" +
		"</div>";
	
	this.detailAbonneListeProduit =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Les Abonnements" +
				"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-nv-abonnement\" title=\"Ajouter un abonnement\">" +
					"<span class=\"ui-icon ui-icon-plusthick\">" +
					"</span>" +
				"</span>" +
			"</div>" +
			"<table class=\"com-table\">" +
				"<!-- BEGIN fermes -->" +
					"<tr class=\"ui-widget-header\">" +
						"<th class=\"com-table-th\" colspan=\"4\" >{fermes.nom}</th>" +
					"</tr>" +
					"<!-- BEGIN fermes.categories -->" +
					"<tr class=\"ui-widget-header\">" +
						"<th class=\"com-table-th\" colspan=\"4\" >{fermes.categories.nom}</th>" +
					"</tr>" +
					"<!-- BEGIN fermes.categories.produits -->" +
					"<tbody>" +
					"<tr class=\"com-cursor-pointer ligne-produit\" idProduit=\"{fermes.categories.produits.id}\" >" +
						"<td class=\"com-table-td-debut com-underline-hover\">{fermes.categories.produits.nom}</td>" +
						"<td class=\"com-table-td-med com-underline-hover edt-marche-pro-unite\">{fermes.categories.produits.quantite} {fermes.categories.produits.unite}</td>" +
						"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header-multiples  ui-widget-content ui-corner-all btn-modifier\" title=\"Modifier\" idProduit=\"{fermes.categories.produits.id}\" idCompteAbonnement=\"{fermes.categories.produits.idAbonnement}\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all btn-supp\" title=\"Supprimer\" idCompteAbonnement=\"{fermes.categories.produits.idAbonnement}\">" +
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"</tbody>" +
					"<!-- END fermes.categories.produits -->" +
					"<!-- END fermes.categories -->" +
					"<!-- END fermes -->" +
			"</table>" +
		"</div>";
	
	this.detailAbonneListeProduitVide =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +	
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Les Abonnements" +
				"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-nv-abonnement\" title=\"Ajouter un abonnement\">" +
					"<span class=\"ui-icon ui-icon-plusthick\">" +
					"</span>" +
				"</span>" +
			"</div>" +
			"<p id=\"texte-liste-vide\">Cet adhérent n'est abonné à aucun produit.</p>" +	
		"</div>";
	
	this.dialogAjoutAbonnement =
		"<div id=\"dialog-ajout-abonnement\" title=\"Abonnement de Produit\">" +
			"<div id=\"information-detail-producteur\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Le Produit</div>" +

				"<div id=\"pro-idFerme\" class=\"com-float-left\">" +
					"<select name=\"ferme\">" +
						"<option value=\"0\" >== Choisir une ferme ==</option>" +
						"<!-- BEGIN listeFerme -->" +
						"<option value=\"{listeFerme.ferId}\" >{listeFerme.ferNom}</option>" +
						"<!-- END listeFerme -->" +
					"</select>" +
				"</div>" +
				"<div id=\"pro-idCategorie\" class=\"com-float-left\">" +
					"<select name=\"categorie\" disabled=\"disabled\">" +
						"<option value=\"0\" >== Choisir une catégorie ==</option>" +
					"</select>" +
				"</div>" +
				"<div id=\"pro-idProduit\" class=\"com-float-left\">" +
					"<select name=\"produit\" disabled=\"disabled\">" +
						"<option value=\"0\" >== Choisir un produit ==</option>" +
					"</select>" +
				"</div>" +
			"</div>" +
			"<div id=\"detail-produit\">" +
			"</div>" +
		"</div>";
	
	this.ajoutAbonnementSelectCategorie =
		"<div id=\"pro-idCategorie\" class=\"com-float-left\">" +
			"<select name=\"categorie\">" +
				"<option value=\"0\" >== Choisir une catégorie ==</option>" +
				"<!-- BEGIN listeCategorie -->" +
				"<option value=\"{listeCategorie.cproId}\" >{listeCategorie.cproNom}</option>" +
				"<!-- END listeCategorie -->" +
			"</select>" +
		"</div>";
	
	this.ajoutAbonnementSelectProduit =
		"<div id=\"pro-idProduit\" class=\"com-float-left\">" +
			"<select name=\"produit\">" +
				"<option value=\"0\" >== Choisir un produit ==</option>" +
				"<!-- BEGIN listeProduit -->" +
				"<option value=\"{listeProduit.proAboId}\" >{listeProduit.nproNom}</option>" +
				"<!-- END listeProduit -->" +
			"</select>" +
		"</div>";
	
	this.detailProduitAjoutAbonnement =
		"<div id=\"detail-produit\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Détail</div>" +
			"<table class=\"com-table-form\">" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Fréquence : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"{proAboFrequence}" +
					"</td>" +
				"</tr>" +
				"<tr>" +
				"<th class=\"com-table-form-th\">" +
						"Quantité disponible : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"{qteRestant} {proAboUnite}" +
					"</td>" +
				"</tr>" +
				"<th class=\"com-table-form-th\">" +
						"Limite par adhérent : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"{proAboMaxLabel}" +
					"</td>" +
				"</tr>" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Quantité abonnement : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<select id=\"lot\">" +
							"<!-- BEGIN lot -->" +
							"<option value=\"{lot.dcomId}\">par {lot.dcomTaille} {proAboUnite}</option>" +
							"<!-- END lot -->" +
						"</select>" +
						"à <span id=\"prix-unitaire\">{prixUnitaire}</span> {sigleMonetaire}/{proAboUnite}" +
						"<button class=\"btn-moins\">-</button>" +
						"<span id=\"qte-pdt\">{qteInit}</span> {proAboUnite}" +
						"<button class=\"btn-plus\">+</button>" +
						"<span id=\"prix-pdt\">{prixInit}</span> {sigleMonetaire}" +
					//	"<input class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"quantite\" maxlength=\"12\" id=\"quantite\"/> {proAboUnite}" +
					"</td>" +
				"</tr>" +
			"</table>" +
		"</div>" ;
	
	this.dialogModifierAbonnement =
		"<div id=\"dialog-modif-abonnement\" title=\"Abonnement de Produit : {nproNom}\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Détail</div>" +
			"<table class=\"com-table-form\">" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Fréquence : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"{proAboFrequence}" +
					"</td>" +
				"</tr>" +
				"<tr>" +
				"<th class=\"com-table-form-th\">" +
						"Quantité disponible : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"{qteRestant} {proAboUnite}" +
					"</td>" +
				"</tr>" +
				"<th class=\"com-table-form-th\">" +
						"Limite par adhérent : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"{proAboMaxLabel}" +
					"</td>" +
				"</tr>" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Quantité abonnement : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input type=\"hidden\" name=\"idProduitAbonnement\" id=\"idProduitAbonnement\" value=\"{proAboId}\"/>" +
						"<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{idCompteAbonnement}\"/>" +

						"<select id=\"lot\">" +
							"<!-- BEGIN lot -->" +
							"<option {lot.selected} value=\"{lot.dcomId}\">par {lot.dcomTaille} {proAboUnite}</option>" +
							"<!-- END lot -->" +
						"</select>" +
						"à <span id=\"prix-unitaire\">{prixUnitaire}</span> {sigleMonetaire}/{proAboUnite}" +
						"<button class=\"btn-moins\">-</button>" +
						"<span id=\"qte-pdt\">{qteInit}</span> {proAboUnite}" +
						"<button class=\"btn-plus\">+</button>" +
						"<span id=\"prix-pdt\">{prixInit}</span> {sigleMonetaire}" +
						
						//"<input class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"quantite\" maxlength=\"12\" id=\"quantite\" value=\"{cptAboQuantite}\"/> {proAboUnite}" +
					"</td>" +
				"</tr>" +
			"</table>" +
		"</div>";
	
	this.dialogSuppressionAbonnement =
		"<div id=\"dialog-supp-abonnement\" title=\"Supprimer l'abonnement\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer l'abonnement à ce produit?</p>" +
		"</div>";
}