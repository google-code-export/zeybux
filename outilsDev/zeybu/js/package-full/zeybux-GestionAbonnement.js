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
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Adhérents Abonnés" +
			"</div>" +
			"<table class=\"com-table\">" +
				"<thead>" +
					"<tr class=\"ui-widget-header\" >" +
						"<th class=\"com-table-th-debut liste-adh-th-num\">N°</th>" +
						"<th class=\"com-table-th-med liste-adh-th-nom\">Adhérent</th>" +
						"<th class=\"com-table-th-fin edt-marche-pro-unite\">Quantité</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
					"<!-- BEGIN abonnes -->" +
					"<tr>" +
						"<td class=\"com-table-td-debut com-underline-hover\">{abonnes.adhNumero}</td>" +
						"<td class=\"com-table-td-med com-underline-hover\">{abonnes.adhPrenom} {abonnes.adhNom}</td>" +
						"<td class=\"com-table-td-fin com-underline-hover edt-marche-pro-unite\">{abonnes.cptAboQuantite} {abonnes.proAboUnite}</td>" +
					"</tr>" +
					"<!-- END abonnes -->" +
				"</tbody>" +
			"</table>" +
		"</div>";
	
	this.detailProduitListeAbonnesVide =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Adhérents Abonnés" +
			"</div>" +
			"<p id=\"texte-liste-vide\">Aucun abonné sur ce produit.</p>" +	
		"</div>";
	
	this.dialogSuppressionProduit =
		"<div id=\"dialog-supp-produit\" title=\"Supprimer abonnement de produit\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer l'abonnement à ce produit?</p>" +
		"</div>";
	
	this.listeAdherentVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Adhérents" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucun adhérent.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeAdherent = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Adhérents" +
				"</div>" +
				"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
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
					"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th class=\"com-table-th-debut com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
							"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
							"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
							"<th class=\"com-table-th-fin liste-adh-th-solde\"></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN listeAdherent -->" +
						"<tr class=\"com-cursor-pointer compte-ligne\" id-adherent=\"{listeAdherent.adhId}\">" +
							"<td class=\"com-table-td-debut com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeAdherent.adhIdTri}</span>" +
								"{listeAdherent.adhNumero}" +
							"</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhNom}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhPrenom}</td>" +
							"<td class=\"com-table-td-fin com-underline-hover liste-adh-td-solde\">" +
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
};function ListeAbonneVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeAbonneVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"afficher"};
		lParam = $.extend(lParam,pParam);
		$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();		
		if(lResponse.listeAdherent.length > 0 && lResponse.listeAdherent[0].adhId != null) {
			var lTemplate = lGestionAbonnementTemplate.listeAdherent;		
			$.each(lResponse.listeAdherent,function() {
				this.adhIdTri = this.adhNumero.replace("Z","");
			});
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionAbonnementTemplate.listeAdherentVide)));
		}
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	};
			
	this.affectLienCompte = function(pData) {
		pData.find(".compte-ligne").click(function() {
			DetailAbonneAbonnementVue({id: $(this).attr("id-adherent")});
		});
		return pData;
	};
	
	this.construct(pParam);
};function DetailAbonneAbonnementVue(pParam) {
	this.idCompte = 0;
	this.produit = {};
	this.abonnement = {};
	this.idAdherent = 0;
	this.mDateDebutSuspension = '';
	this.mDateFinSuspension = '';
	this.reservationModif = {};
	this.reservation = {};
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {DetailAbonneAbonnementVue(pParam);}} );
		var that = this;		
		var lParam = {fonction:"detailAbonne"};
		lParam = $.extend(lParam,pParam);
		$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.idAdherent = pParam.id;
							that.idCompte= lResponse.adherent.cptId;
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lData = lResponse.adherent;
		var lDateDebutSuspension = gDateTimeNulle;
		var lDateFinSuspension = gDateTimeNulle;
		var lAujourdhui = getDateTimeAujourdhuiDb();
		
		if(lResponse.produits && lResponse.produits.fermes && lResponse.produits.fermes.length > 0 && lResponse.produits.fermes[0].nom != null) {
			lDateDebutSuspension = lResponse.produits.fermes[0].categories[0].produits[0].dateDebutSuspension;
			lDateFinSuspension = lResponse.produits.fermes[0].categories[0].produits[0].dateFinSuspension;
			
			$.each(lResponse.produits.fermes,function() {
				$.each(this.categories,function() {
					$.each(this.produits,function() {
						this.quantite = this.quantite.nombreFormate(2,',',' ');
					});
				});
			});
			
			lData.listeProduit = lGestionAbonnementTemplate.detailAbonneListeProduit.template(lResponse.produits);
		} else {
			lData.listeProduit = lGestionAbonnementTemplate.detailAbonneListeProduitVide;
		}
		
		if(dateTimeEstPLusGrandeEgale(lDateFinSuspension,lAujourdhui,'db')) { // Abonnement suspendu
			lData.dateDebutsuspension = lDateDebutSuspension.extractDbDate().dateDbToFr();
			lData.dateFinsuspension = lDateFinSuspension.extractDbDate().dateDbToFr();
			lData.suspension = lGestionAbonnementTemplate.buttonModifierSuspendre.template(lData);
			
			this.mDateDebutSuspension = lData.dateDebutsuspension;
			this.mDateFinSuspension = lData.dateFinsuspension;
		} else { // Abonnement en cours
			lData.suspension = lGestionAbonnementTemplate.buttonSuspendre;
		}
		
		$('#contenu').replaceWith(that.affect($(lGestionAbonnementTemplate.detailAbonne.template(lData))));
		
	};
	
	this.affect = function(pData) {
		pData = this.affectAjoutAbonnement(pData);
		pData = this.affectModifierAbonnement(pData);
		pData = this.affecSupprimerAbonnement(pData);
		pData = this.affectRetour(pData);
		pData = this.affectAjoutSuspension(pData);
		pData = this.affectModifierSuspension(pData);
		pData = this.affectSupprimerSuspension(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectAjoutSuspension = function(pData) {		
		var that = this;
		pData.find('#btn-ajout-suspension').click(function() {
			that.dialogAjoutSuspension();
		});
		return pData;
	};
	
	this.dialogAjoutSuspension = function() {
		var that = this;
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lTemplate = lGestionAbonnementTemplate.dialogAjoutSuspension;
		
		$(that.affectDialogAjoutSuspension($(lTemplate))).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:900,
			buttons: {
				'Suspendre': function() {
					that.suspendreAbonnement($(this));
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.affectDialogAjoutSuspension = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateDebutSuspension','dateFinSuspension',pData);
		pData.find('#dateDebutSuspension').datepicker( "option", "yearRange", 'c:c+10' );
		pData.find('#dateFinSuspension').datepicker( "option", "yearRange", 'c:c+10' );
		return pData;
	};
	
	this.suspendreAbonnement = function(pDialog) {
		var that = this;
		
		var lCompteAbonnementVO = new CompteAbonnementVO();
		lCompteAbonnementVO.idCompte = this.idCompte;
		lCompteAbonnementVO.dateDebutSuspension = pDialog.find("#dateDebutSuspension").val().dateFrToDb();
		lCompteAbonnementVO.dateFinSuspension = pDialog.find("#dateFinSuspension").val().dateFrToDb();
		
		var lValid = new CompteAbonnementValid();
		var lVr = lValid.validAjoutSuspension(lCompteAbonnementVO);
		
		if(lVr.valid) {	
			Infobulle.init();
			lCompteAbonnementVO.fonction = "suspendre";
			$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lCompteAbonnementVO),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_348_CODE;
							erreur.message = ERR_348_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);
							
							that.construct({id:that.idAdherent,vr:lVR});
							pDialog.dialog('close');
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	};

	this.affectModifierSuspension = function(pData) {		
		var that = this;
		pData.find('#btn-modif-suspension').click(function() {
			that.dialogModifierSuspension();
		});
		return pData;		
	};	
	
	this.dialogModifierSuspension = function() {
		var that = this;
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lTemplate = lGestionAbonnementTemplate.dialogAjoutSuspension;
		
		var lData = {dateDebutSuspension:this.mDateDebutSuspension,dateFinSuspension:this.mDateFinSuspension};
		
		$(that.affectDialogAjoutSuspension($(lTemplate.template(lData)))).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:900,
			buttons: {
				'Suspendre': function() {
					that.suspendreAbonnement($(this));
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.affectSupprimerSuspension = function(pData) {
		var that = this;
		pData.find('#btn-supp-suspension').click(function() {
			that.dialogSupprimerSuspension();
		});
		return pData;		
	};
	
	this.dialogSupprimerSuspension = function() {
		var that = this;
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lTemplate = lGestionAbonnementTemplate.dialogSupprimerSuspension;
		
		$(that.affectDialogAjoutSuspension($(lTemplate))).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:900,
			buttons: {
				'Supprimer': function() {					
					var lCompteAbonnementVO = new CompteAbonnementVO();
					lCompteAbonnementVO.idCompte = that.idCompte;
					
					var lValid = new CompteAbonnementValid();
					var lVr = lValid.validDeleteSuspension(lCompteAbonnementVO);
					
					if(lVr.valid) {	
						Infobulle.init();
						lCompteAbonnementVO.fonction = "arretSuspension";
						var lDialog = $(this);
						$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lCompteAbonnementVO),
							function (lResponse) {		
								if(lResponse) {
									if(lResponse.valid) {
										Infobulle.init(); // Supprime les erreurs
										var lVR = new Object();
										var erreur = new VRerreur();
										erreur.code = ERR_349_CODE;
										erreur.message = ERR_349_MSG;
										lVR.valid = false;
										lVR.log = new VRelement();
										lVR.log.valid = false;
										lVR.log.erreurs.push(erreur);
										
										that.construct({id:that.idAdherent,vr:lVR});
										lDialog.dialog('close');
									} else {
										Infobulle.generer(lResponse,'');
									}
								}
							},"json"
						);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.affectAjoutAbonnement = function(pData) {
		var that = this;
		pData.find('#btn-nv-abonnement').click(function() {
			that.dialogAjoutAbonnement();
		});
		return pData;
	};
	
	this.dialogAjoutAbonnement = function(pData) {
		var that = this;
		var lParam = {fonction:"listeFerme"};
		$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
							var lTemplate = lGestionAbonnementTemplate.dialogAjoutAbonnement;
							
							$(that.affectAjoutAbonnementSelectFerme($(lTemplate.template(lResponse)))).dialog({			
								autoOpen: true,
								modal: true,
								draggable: true,
								resizable: false,
								width:900,
								buttons: {
									'Abonner': function() {
										that.ajouterAbonnement($(this));
									},
									'Annuler': function() {
										$(this).dialog('close');
									}
								},
								close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
							});
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);	
		return pData;
	};
	
	this.affectAjoutAbonnementSelectFerme = function(pData) {
		var that = this;
		pData.find("#pro-idFerme select").change(function() {
			var lId = $(this).val();
			$("#pro-idCategorie select, #pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#detail-produit").replaceWith("<div id=\"detail-produit\"></div>");
			if(lId > 0) {
				var lParam = {fonction:"listeProduit",id:that.idCompte,idFerme:lId};
				$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lParam),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								
								if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].nproId != null) {
								
									that.mProduits = [];
									//that.mListeProduit = [];
								
									var lIdCategorie = 0;
									var lListeCategorie = [];
									$.each(lResponse.listeProduit,function() {
										if(this.ferId == lId) {
											if(that.mProduits[this.cproId]) {
												that.mProduits[this.cproId].listeProduit.push(this);
											} else {
												that.mProduits[this.cproId] = {nom:this.cproNom,listeProduit:[this]};
											}
											if(lIdCategorie != this.cproId) {
												lListeCategorie.push({cproId:this.cproId,cproNom:this.cproNom});
												lIdCategorie = this.cproId;
											}
										}
									});
									
	
									var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
									var lTemplate = lGestionAbonnementTemplate.ajoutAbonnementSelectCategorie;
									
									$("#pro-idCategorie").replaceWith(that.affectAjoutAbonnementSelectCategorie($(lTemplate.template({listeCategorie:lListeCategorie}))));
									
								} else {
									// Message d'information
									var lVr = new TemplateVR();
									lVr.valid = false;
									lVr.log.valid = false;
									var erreur = new VRerreur();
									erreur.code = ERR_332_CODE;
									erreur.message = ERR_332_MSG;
									lVr.log.erreurs.push(erreur);
									Infobulle.generer(lVr,'');
								}
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
			} 
						
		});
		return pData;
	};
	
	this.affectAjoutAbonnementSelectCategorie = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			var lId = $(this).val();
			$("#pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#detail-produit").replaceWith("<div id=\"detail-produit\"></div>");
			if(lId > 0) {
				
				var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
				var lTemplate = lGestionAbonnementTemplate.ajoutAbonnementSelectProduit;
				
				$("#pro-idProduit").replaceWith(that.affectAjoutAbonnementSelectProduit($(lTemplate.template(that.mProduits[lId]))));
				
			}		
		});
		return pData;
	};
	
	this.affectAjoutAbonnementSelectProduit = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			var lId = $(this).val();
			if(lId > 0) {
				var lParam = {fonction:"detailProduit",id:lId};
				$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lParam),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								that.produit = lResponse.produit[0];
								
								var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
								var lTemplate = lGestionAbonnementTemplate.detailProduitAjoutAbonnement;
								
								var lData = lResponse.produit[0];
								if(lData.proAboMax == -1) {
									lData.proAboMaxLabel = "Pas de limite";
								} else {
									lData.proAboMaxLabel = lData.proAboMax.nombreFormate(2,',',' ') + " " + lData.proAboUnite;
								}
								lData.qteRestant = (parseFloat(lData.proAboStockInitial) - parseFloat(lData.proAboReservation)).nombreFormate(2,',',' ');
								
								lData.lot = [];
								var lLots = [];
								$.each(lResponse.produit[0].lots, function() {
									if(this.id) {
										var lLot = {};
										lLot.dcomId = this.id;
										lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
										lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
										if(!lData.prixUnitaire) {
											lData.prixUnitaire = (parseFloat(this.prix) / parseFloat(this.taille)).nombreFormate(2,',',' ');
											lData.qteInit = lLot.dcomTaille;
											lData.prixInit = lLot.dcomPrix;
											that.reservationModif.dcomId = this.id;
											that.reservationModif.stoQuantite = this.taille;
										}
										lData.lot.push(lLot);
										lLots[this.id] = this;
									}
								});
								that.produit.lots = lLots;
								
								lData.sigleMonetaire = gSigleMonetaire;
								
								$("#detail-produit").replaceWith(that.affectDetailProduit($(lTemplate.template(lData))));
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
			} else {
				$("#detail-produit").replaceWith($("<div id=\"detail-produit\">"));
			}			
		});
		return pData;
	};
	
	this.affectDetailProduit = function(pData) {
		pData = this.affectChangementLot(pData);
		pData = this.affectBtnQte(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;		
	};
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('#lot').change(function() {
			Infobulle.init(); // Supprime les erreurs
			that.changerLot($(this).val());
		});
		return pData;
	};
	
	this.changerLot = function(pIdLot) {
		var lPrix = this.produit.lots[pIdLot].prix;
		var lQte = this.produit.lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 
		
		$('#prix-unitaire').text(lprixUnitaire);
		this.reservationModif.dcomId = pIdLot;
		this.reservationModif.stoQuantite = lQte;
		$('#qte-pdt').text(lQte.nombreFormate(2,',',' '));
		$('#prix-pdt').text(lPrix.nombreFormate(2,',',' '));
	};
	
	this.affectBtnQte = function(pData) {
		var that = this;
		pData.find('.btn-plus').click(function() {
			Infobulle.init(); // Supprime les erreurs
			that.nouvelleQuantite($('#lot').val(), 1);
		});	
		pData.find('.btn-moins').click(function() {
			Infobulle.init(); // Supprime les erreurs
			that.nouvelleQuantite($('#lot').val(),-1);
		});
		return pData;		
	};
	
	this.nouvelleQuantite = function(pIdLot,pIncrement) {
		// La quantité max soit qte max soit stock
		var lMax = parseFloat(this.produit.proAboMax);
		
		// Recherche de la quantité reservée pour la déduire de la quantité max
		var lStock = 0;
		if(this.reservation && this.reservation.stoQuantite) {
			lStock = parseFloat(this.produit.proAboStockInitial) - parseFloat(this.produit.proAboReservation) + parseFloat(this.reservation.stoQuantite);						
		} else {
			lStock = parseFloat(this.produit.proAboStockInitial) - parseFloat(this.produit.proAboReservation);
		}

		
		var lNoStock = false;
		if(parseFloat(this.produit.proAboMax) == -1 && parseFloat(this.produit.proAboStockInitial) == -1) { // Si ni stock ni qmax
			lNoStock = true;
		} else if(parseFloat(this.produit.proAboStockInitial) == -1) { // Si qmax mais pas stock
			lMax = this.produit.proAboMax;
		} else if(parseFloat(this.produit.proAboMax) == -1) { // Si stock mais pas qmax
			lMax = lStock;
		} else { // Si stock et qmax
			if(parseFloat(lStock) < parseFloat(lMax)) { lMax = lStock; }				
		}
		
		var lTaille = this.produit.lots[pIdLot].taille;
		var lPrix = this.produit.lots[pIdLot].prix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservationModif && (this.reservationModif.dcomId == pIdLot)) {
			lQteReservation = parseFloat(this.reservationModif.stoQuantite)/parseFloat(lTaille);
		}
		lQteReservation += pIncrement;
		
		var lNvQteReservation = lQteReservation * lTaille;

		// Test si la quantité est dans les limites
		if((lNoStock && lNvQteReservation > 0) || (!lNoStock && lNvQteReservation > 0 && lNvQteReservation <= lMax)) {
			var lNvPrix = (lQteReservation * lPrix).toFixed(2);

			// Mise à jour de la quantite reservée
			this.reservationModif.stoQuantite = lNvQteReservation;			
			
			$('#qte-pdt').text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt').text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

		} else if(lNvQteReservation > lMax && lMax != -1) {
			var lVr = new TemplateVR();
			lVr.valid = false;
			              
			var lProduit = new ReservationCommandeVR();              
			lProduit.valid = false;
			lProduit.stoQuantite.valid = false;
			var erreur = new VRerreur();
			erreur.code = ERR_304_CODE;
			erreur.message = ERR_304_MSG;
			lProduit.stoQuantite.erreurs.push(erreur);		
			lVr.produit = lProduit;
			
			Infobulle.generer(lVr,'');
		}		
	};
	
	this.ajouterAbonnement = function(pDialog) {
		var that = this;		
		var lIdNomProduit = pDialog.find(':input[name=produit]').val();

		if(lIdNomProduit != 0) {
			var lCompteAbonnementVO = new CompteAbonnementVO();
			lCompteAbonnementVO.idCompte = this.idCompte;
			lCompteAbonnementVO.idProduitAbonnement = lIdNomProduit;
			lCompteAbonnementVO.quantite = this.reservationModif.stoQuantite;
			lCompteAbonnementVO.idLotAbonnement = pDialog.find("#lot").val();
			
			var lValid = new CompteAbonnementValid();
			var lVr = lValid.validAjout(lCompteAbonnementVO,that.produit);
			
			if(lVr.valid) {	
				Infobulle.init();
				lCompteAbonnementVO.fonction = "ajouter";
				$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lCompteAbonnementVO),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								var lVR = new Object();
								var erreur = new VRerreur();
								erreur.code = ERR_345_CODE;
								erreur.message = ERR_345_MSG;
								lVR.valid = false;
								lVR.log = new VRelement();
								lVR.log.valid = false;
								lVR.log.erreurs.push(erreur);
								
								that.construct({id:that.idAdherent,vr:lVR});
								pDialog.dialog('close');
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
			} else {
				Infobulle.generer(lVr,'');
			}
		}
		return true;
	};
	
	this.affectModifierAbonnement = function(pData) {
		var that = this;
		pData.find(".btn-modifier").click(function() {
			that.dialogModifierAbonnement($(this).attr("idProduit"),$(this).attr("idCompteAbonnement"));
		});
		return pData;
	};
	
	this.dialogModifierAbonnement = function(pIdProduit,pIdCompteAbonnement) {
		var that = this;
		var lParam = {fonction:"detailAbonnement",idProduit:pIdProduit,idCompteAbonnement:pIdCompteAbonnement};
		$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lParam),
			function (lResponse) {		
				if(lResponse) {
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						that.produit = lResponse.produit[0];
						that.abonnement = lResponse.abonnement;
						
						var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
						var lTemplate = lGestionAbonnementTemplate.dialogModifierAbonnement;
						
						var lData = lResponse.produit[0];
						if(lData.proAboMax == -1) {
							lData.proAboMaxLabel = "Pas de limite";
						} else {
							lData.proAboMaxLabel = lData.proAboMax.nombreFormate(2,',',' ') + " " + lData.proAboUnite;
						}
						lData.qteRestant = (parseFloat(lData.proAboStockInitial) - parseFloat(lData.proAboReservation) + parseFloat(lResponse.abonnement.cptAboQuantite) ).nombreFormate(2,',',' ');
						lData.cptAboQuantite = lResponse.abonnement.cptAboQuantite.nombreFormate(2,',',' ');
						lData.proAboId = pIdProduit;
						lData.idCompteAbonnement = pIdCompteAbonnement;
						
						lData.lot = [];
						var lLots = [];
						$.each(lResponse.produit[0].lots, function() {
							if(this.id) {
								var lLot = {};
								lLot.dcomId = this.id;
								lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
								lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
								lLot.selected = '';
								if(this.id == lResponse.abonnement.cptAboIdLotAbonnement) {
									lData.prixUnitaire = (parseFloat(this.prix) / parseFloat(this.taille)).nombreFormate(2,',',' ');
									lData.qteInit = lResponse.abonnement.cptAboQuantite.nombreFormate(2,',',' ');
									lData.prixInit = (lResponse.abonnement.cptAboQuantite * this.prix / this.taille).nombreFormate(2,',',' ');
									that.reservationModif.dcomId = this.id;
									that.reservationModif.stoQuantite = lResponse.abonnement.cptAboQuantite;
									that.reservation.stoQuantite = lResponse.abonnement.cptAboQuantite;
									lLot.selected = "selected=\"selected\"";
								}
								lData.lot.push(lLot);
								lLots[this.id] = this;
							}
						});
						that.produit.lots = lLots;
						
						lData.sigleMonetaire = gSigleMonetaire;
						
						$(that.affectModifierProduit($(lTemplate.template(lData)))).dialog({		
							autoOpen: true,
							modal: true,
							draggable: true,
							resizable: false,
							width:900,
							buttons: {
								'Modifier': function() {
									that.modifierAbonnement($(this));
								},
								'Annuler': function() {
									$(this).dialog('close');
								}
							},
							close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
						});
						
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.affectModifierProduit = function(pData) {
		pData = this.affectChangementLot(pData);
		pData = this.affectBtnQte(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;		
	};
	
	this.modifierAbonnement = function(pDialog){
		var that = this;
		var lCompteAbonnementVO = new CompteAbonnementVO();
		lCompteAbonnementVO.id = pDialog.find("#id").val();
		lCompteAbonnementVO.idCompte = this.idCompte;
		lCompteAbonnementVO.idProduitAbonnement = pDialog.find("#idProduitAbonnement").val();
		//lCompteAbonnementVO.quantite = pDialog.find("#quantite").val().numberFrToDb();
		lCompteAbonnementVO.quantite = this.reservationModif.stoQuantite;
		lCompteAbonnementVO.idLotAbonnement = pDialog.find("#lot").val();
		
		var lValid = new CompteAbonnementValid();
		var lVr = lValid.validUpdate(lCompteAbonnementVO,that.produit,that.abonnement);
		
		if(lVr.valid) {	
			Infobulle.init();
			lCompteAbonnementVO.fonction = "modifier";
			$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lCompteAbonnementVO),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_346_CODE;
							erreur.message = ERR_346_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);
							
							that.construct({id:that.idAdherent,vr:lVR});
							pDialog.dialog('close');
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.affecSupprimerAbonnement = function(pData) {
		var that = this;
		pData.find(".btn-supp").click(function() {
			that.dialogSupprimerAbonnement($(this).attr("idCompteAbonnement"));
		});
		return pData;
	};
	
	this.dialogSupprimerAbonnement = function(pIdCompteAbonnement) {
		var that = this;
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lTemplate = lGestionAbonnementTemplate.dialogSuppressionAbonnement;
		//var lButton = this;
		$(lTemplate).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Supprimer': function() {
					var lParam = {fonction:"supprimer", id:pIdCompteAbonnement};
					var lDialog = this;
					$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lParam),
							function(lResponse) {
								Infobulle.init(); // Supprime les erreurs
								if(lResponse) {
									if(lResponse.valid) {
										$(lDialog).dialog('close');

										var lVR = new Object();
										var erreur = new VRerreur();
										erreur.code = ERR_347_CODE;
										erreur.message = ERR_347_MSG;
										lVR.valid = false;
										lVR.log = new VRelement();
										lVR.log.valid = false;
										lVR.log.erreurs.push(erreur);
										
										that.construct({id:that.idAdherent,vr:lVR});
									} else {
										Infobulle.generer(lResponse,'');
									}
								}
							},"json"
					);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
			
		});
	};

	this.affectRetour = function(pData) {
	//	var that = this;
		pData.find("#lien-retour").click(function() { ListeAbonneVue();});
		return pData;
	};
	
	this.construct(pParam);
};function DetailProduitAbonnementVue(pParam) {
	this.mLotAbonnes = [];
	this.mIdLot = 0;
	this.mEditionLot = false;
	this.mLotRemplacement = [];
	this.mQuantiteReservation = null;
	//this.mLotReservation = [];
	this.mTailleLotResaMax = -1;

	this.construct = function(pParam) {
		$.history( {'vue':function() {DetailProduitAbonnementVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"detailProduit"};
		lParam = $.extend(lParam,pParam);
		$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;
		
		$.each(lResponse.abonnes,function() {
			if(!that.mLotAbonnes[this.cptAboIdLotAbonnement]) {
				that.mLotAbonnes[this.cptAboIdLotAbonnement] = {id:this.cptAboIdLotAbonnement,quantite:this.cptAboQuantite};
			}
		});
		
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lData= {};
		lData.proAboId = lResponse.produit[0].proAboId;
		lData.unite = lResponse.produit[0].proAboUnite;
		lData.nproNom = lResponse.produit[0].nproNom;
		lData.proAboUnite = lData.unite;
		lData.proAboFrequence = lResponse.produit[0].proAboFrequence;
		lData.proAboStockInitial = lResponse.produit[0].proAboStockInitial.nombreFormate(2,',',' ');
		lData.proAboReservation = lResponse.produit[0].proAboReservation.nombreFormate(2,',',' ');
		
		if(lResponse.produit[0].proAboMax == -1) {
			lData.proAboMax = "Pas de limite";
		} else {
			lData.proAboMax = lResponse.produit[0].proAboMax.nombreFormate(2,',',' ') + " " + lData.unite;
		}
		
		if(lResponse.abonnes && lResponse.abonnes.length > 0 && lResponse.abonnes[0].cptAboIdProduitAbonnement != null) {
			$.each(lResponse.abonnes,function() {
				this.cptAboQuantite = this.cptAboQuantite.nombreFormate(2,',',' ');
				this.proAboUnite = lData.proAboUnite;
			});
			
			lData.listeAbonnes = lGestionAbonnementTemplate.detailProduitListeAbonnes.template(lResponse);
		} else {
			lData.listeAbonnes = lGestionAbonnementTemplate.detailProduitListeAbonnesVide;
		}

		this.mQuantiteReservation = parseFloat(lResponse.produit[0].proAboReservation);
		if(this.mQuantiteReservation <= 0) {
			this.mQuantiteReservation = -1;
		}

		$('#contenu').replaceWith(that.affect($(lGestionAbonnementTemplate.detailProduit.template(lData))));
		
	};
	
	this.affect = function(pData) {
		pData = this.affectLienRetour(pData);
		pData = this.affectModifier(pData);
		pData = affectDialogSuppProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#lien-retour").click(function() { ListeProduitVue(); });
		return pData;
	};
	
	this.affectModifier = function(pData) {		
		var that = this;
		pData.find("#btn-modifier").click(function() {
			var lParam = {fonction:"detailProduitModifier", id:$(this).attr("idProduit")};
			$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
								var lTemplate = lGestionAbonnementTemplate.dialogModifierProduit;
								
								var lData = lResponse.produit[0];
								
							//	if(lResponse.unite.length > 0) {
									/*if(lResponse.unite.length == 1) {
										if(lResponse.unite[0].mLotId == null) { // Pas d'unité
											lData.formUnite = lGestionAbonnementTemplate.formUniteSansUnite.template({unite:lData.proAboUnite});
										} else { // Une seule unité
											lData.formUnite = lGestionAbonnementTemplate.formUnite.template({unite:lResponse.unite[0].mLotUnite});
											lData.unite = lResponse.unite[0].mLotUnite;
										}
									} else { // Plusieures unités
										$.each(lResponse.unite,function() {
											if(lData.proAboUnite == this.mLotUnite) {
												this.selected = "selected=\"selected\"";
											}
										});
										lData.formUnite = lGestionAbonnementTemplate.formUniteSelect.template(lResponse);
									}*/

									lData.modelesLot = [];
								/*	$(lResponse.unite).each(function() {
										if(this.mLotId != null) {
											this.id = this.mLotId;
											this.quantite = this.mLotQuantite.nombreFormate(2,',',' ');
											this.unite = this.mLotUnite;
											this.prix = this.mLotPrix.nombreFormate(2,',',' ');
											this.sigleMonetaire = gSigleMonetaire;
											lData.modelesLot.push(this);
											lData.unite = this.mLotUnite;
										}
									});	
									lResponse.modelesLot = lResponse.unite;*/
									

									that.mTailleLotResaMax = -1;
									//that.mLotReservation = [];
									lData.modelesLotReservation  = [];
									lData.listeModelesLot = [];
									$(lResponse.unite).each(function() {
										if(this.mLotId != null) {
											that.mIdLot--;												
											var lVoLot = {	
													id:that.mIdLot,
													quantite:this.mLotQuantite.nombreFormate(2,',',' '),
													prix:this.mLotPrix.nombreFormate(2,',',' '),
													unite:this.mLotUnite,
													sigleMonetaire:gSigleMonetaire,
													modele: "modele-lot",
													checked:""};
											lData.listeModelesLot.push(lVoLot);
										}
									});
									$(lData.lots).each(function() {
										var lVoLot = {	
												id:this.id,
												quantite:this.taille.nombreFormate(2,',',' '),
												prix:this.prix.nombreFormate(2,',',' '),
												unite:lData.proAboUnite,
												sigleMonetaire:gSigleMonetaire,
												modele: "",
												checked:"checked=\"checked\""};
										//lData.modelesLot.push(lVoLot);
										if(this.reservation) {
											lData.modelesLotReservation.push(lVoLot);
											//that.mLotReservation[this.id] = {id:this.id,quantite:this.taille};
											
											if(this.taille > that.mTailleLotResaMax) {
												that.mTailleLotResaMax = this.taille;
											}
											
										} else {
											lData.modelesLot.push(lVoLot);
										}
									});
									lResponse.modelesLot = lResponse.unite;
																		
									/*if(lResponse.produit.qteRestante == "" || lResponse.produit.stockInitial == -1) {
										lData.nproStockCheckedNoLimit = "checked=\"checked\"";
										lData.nproStockDisabled = "disabled=\"disabled\"";
									} else {
										lData.nproStockCheckedLimit = "checked=\"checked\"";
									}
									
									if(lResponse.produit.qteMaxCommande == "" || lResponse.produit.qteMaxCommande == -1) {
										lData.nproQteMaxCheckedNoLimit = "checked=\"checked\"";
										lData.nproQteMaxDisabled = "disabled=\"disabled\"";
									} else {
										lData.nproQteMaxCheckedLimit = "checked=\"checked\"";
									}
									lData.divStock = lGestionCommandeTemplate.stockModifProduit.template(lData);
									lData.divLot = lGestionCommandeTemplate.prixModifProduit.template(lData);*/
									
									
									
									
									
							//	}
								lData.proAboStockInitial = lData.proAboStockInitial.nombreFormate(2,',','');
								if(lData.proAboMax == -1) {
									lData.checkedNoLimit = "checked=\"checked\"";
									lData.disableLimit = "disabled=\"disabled\"";
								} else {
									lData.checkedLimit = "checked=\"checked\"";
									lData.max = lData.proAboMax.nombreFormate(2,',','');
								}
								lData.sigleMonetaire = gSigleMonetaire;

								$(that.affectModifierDetailProduit($(lTemplate.template(lData)))).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:900,
									buttons: {
										'Modifier': function() {
											that.modifierProduit($(this));
										},
										'Annuler': function() {
											$(this).dialog('close');
										}
									},
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								});
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);	
		});
		return pData;
	};
	
	this.affectModifierDetailProduit = function(pData) {
		pData = this.affectLimiteStock(pData);
		//pData = this.affectFormUnite(pData);
		pData = this.affectAjoutLot(pData);
		pData = this.affectAjoutLotGestionModifier(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;		
	};
	
	this.affectAjoutLot = function(pData) {
		var that = this;
		pData.find('#btn-ajout-lot').click(function() {that.ajoutLot();});
		pData.find('#table-pro-prix input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLot();
			}
		});
		return pData;		
	};
	
	this.ajoutLot = function() {
		var lVo = new ModeleLotVO();
		lVo.quantite = $(":input[name=lot-quantite]").val().numberFrToDb();
		lVo.unite = $(":input[name=lot-unite]").val();
		lVo.prix = $(":input[name=lot-prix]").val().numberFrToDb();
				
		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lGestionAbonnementTemplate = new GestionAbonnementTemplate();		
			var lTemplate = lGestionAbonnementTemplate.modeleLot;				
			this.mIdLot--;
			lVo.id = this.mIdLot;
			lVo.sigleMonetaire = gSigleMonetaire;
			lVo.quantite = lVo.quantite.nombreFormate(2,',',' ');
			lVo.prix = lVo.prix.nombreFormate(2,',',' ');		
			$("#lot-liste").append(this.affectLot($(lTemplate.template(lVo))));
			
			$(":input[name=lot-quantite], :input[name=lot-unite], :input[name=lot-prix]").val("");
		} else {
			Infobulle.generer(lVr,'pro-lot-');
		}
	};
	
	this.affectLot = function(pData) {
		pData = this.affectAjoutLotGestion(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectAjoutLotGestion = function(pData) {
		var that = this;
		pData.find(".btn-modifier-lot").click(function() {
			that.ajoutLotModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(".btn-valider-lot").click(function() {
			that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find('.catalogue-input-lot').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
			}
		});	
		pData.find(".btn-annuler-lot").click(function() {
			that.ajoutLotAnnulerModification($(this).closest('tr').find('#id-lot').text());
		});	
		pData.find(".btn-supprimer-lot").click(function() {
			that.ajoutLotSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(":checkbox").change(function() {
			if(!that.majUnite()) {
				if($(this).attr("checked")) {
					$(this).removeAttr("checked");
				} else {
					$(this).attr("checked","checked");
				}				
			}
		});
		return pData;		
	};
	
	this.majUnite = function() {
		var lOk = true;
		var lNbChecked = 0;
		var lUnitePrec = "";
		$(".ligne-lot :checkbox:checked").each(function() {
			var lUnite = $(this).closest(".ligne-lot").find(".lot-unite").text();
			if(lUnitePrec != "" && lUnitePrec != lUnite) {
				lOk = false;
			} else {
				lUnitePrec = lUnite;
			}
			lNbChecked++;
		});
		if(lOk) { 
			if(lNbChecked > 0) {
				$(".unite-stock").text(lUnitePrec);	
			}
		} else {
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_333_CODE;
			erreur.message = ERR_333_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
		}
		return lOk;
	};
	
	this.affectLimiteStock = function(pData) {
		pData.find(':input[name=pro-qte-max-choix]').change(function() {
			if($(':input[name=pro-qte-max-choix]:checked').val() == 1) {				
				//$(":input[name=pro-qte-max]").attr("disabled","").val("");		
				$(":input[name=pro-qte-max]").prop("disabled", false).val("");
			} else {
			//	$(":input[name=pro-qte-max]").attr("disabled","disabled").val("");
				$(":input[name=pro-qte-max]").prop("disabled", true).val("");
			}
		});
		return pData;
	};
	
	this.ajoutLotModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text().numberFrToDb().nombreFormate(2,',',''));
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text().numberFrToDb().nombreFormate(2,',',''));
		
		this.mEditionLot = true;
	};
	

	/*this.ajoutLotValiderModification = function(pId) {
		var lVo = new ModeleLotVO();
		lVo.quantite = $("#pro-lot-" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-" + pId + "-prix").val().numberFrToDb();
	
		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
		
			$("#lot-" + pId + "-quantite").text(lVo.quantite.nombreFormate(2,',',' '));
			$("#lot-" + pId + "-unite").text(lVo.unite);
			$("#lot-" + pId + "-prix").text(lVo.prix.nombreFormate(2,',',' '));
			$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
			

			this.mEditionLot = false;
			this.majUnite();
		} else {
			Infobulle.generer(lVr,'pro-lot-' + pId + '-');
		}
	};*/
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		this.mEditionLot = false;
	};
	
	this.ajoutLotSupprimer = function(pId) {
		$("#ligne-lot-" + pId).remove();
	};
	
	this.affectAjoutLotGestionModifier = function(pData) {
		var that = this;
		pData.find(".btn-modifier-lot").click(function() {
			that.ajoutLotModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(".btn-valider-lot").click(function() {
			that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find('.catalogue-input-lot').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
			}
		});	
		pData.find(".btn-annuler-lot").click(function() {
			that.ajoutLotAnnulerModification($(this).closest('tr').find('#id-lot').text());
		});	
		pData.find(".btn-supprimer-lot").click(function() {
			that.modifierLotSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(":checkbox").change(function() {	
			var lMajUnite = that.majUnite();
			if($(this).attr("checked")) {
				if(!lMajUnite) {
					$(this).removeAttr("checked");
				}
			} else {
				if(!that.autorisationSupprimerLot($(this).closest('tr').find('#id-lot').text())) {
					$(this).attr("checked","checked");
				}
			}
		});
		return pData;		
	};
	

	/*this.ajoutLotModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();

		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text());
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text());

		this.mEditionLot = true;
	};*/
	
	this.ajoutLotValiderModification = function(pId) {
		var lVo = new ModeleLotVO();
		lVo.id = pId;
		lVo.quantite = $("#pro-lot-" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-" + pId + "-prix").val().numberFrToDb();
	
		var lValid = new ModeleLotValid();
		var lVr = new TemplateVR();
		if(this.autorisationSupprimerLot(pId)) {
			lVr = lValid.validAjout(lVo);
		} else {
			lVr = lValid.validUpdateAvecReservation(lVo,this.mLotAbonnes[pId].quantite);
		}

		if(lVr.valid) {
			Infobulle.init();		
			var lVR = new TemplateVR();
			var lQteRestante = $("#pro-qteRestante").val();			
			if(lQteRestante != undefined &&lQteRestante != "") {
				lQteRestante = lQteRestante.numberFrToDb();
				if(lQteRestante != -1 && lVo.quantite > parseFloat(lQteRestante)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
				
			}

			var lMax = $("#pro-qteMaxCommande").val();
			if(lMax != undefined &&lMax != "") {
				lMax = lMax.numberFrToDb();
				if(lMax != -1 && lVo.quantite > parseFloat(lMax)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
			}

			if(lVR.valid) {
				$("#lot-" + pId + "-quantite").text(lVo.quantite.nombreFormate(2,',',' '));
				$("#lot-" + pId + "-unite").text(lVo.unite);
				$("#lot-" + pId + "-prix").text(lVo.prix.nombreFormate(2,',',' '));
				$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();

				this.mEditionLot = false;
				this.majUnite();
			} else {
				Infobulle.generer(lVR,'pro-lot-' + pId + '-');
			}
		} else {
			Infobulle.generer(lVr,'pro-lot-' + pId + '-');
		}
	};
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		this.mEditionLot = false;
	};
	
	this.modifierLotSupprimer = function(pId) {	
		if(this.autorisationSupprimerLot(pId)) {
			$("#ligne-lot-" + pId).remove();								
		} else {
			this.dialogSupprimerLot(pId);
		}
	};
	
	this.autorisationSupprimerLot = function(pIdLot) {
		if(this.mLotAbonnes[pIdLot]) {
			return false;
		}
		return true;
	};
	
	this.dialogSupprimerLot = function(pId) {		
		var that = this;
		
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lData = {modelesLot:[]};

		var lUnite = $('#lot-' + pId + '-unite').text();
		var lQuantite = parseFloat($('#lot-' + pId + '-quantite').text().numberFrToDb());
		
			//$("#dialog-modif-pro").find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();	
		$("#dialog-modif-pro").find('.ligne-lot').each( function () {								
			var lId = $(this).find(".lot-id").text();
			var lQuantiteLot = parseFloat($(this).find(".lot-quantite").text().numberFrToDb());
			var lPrix = parseFloat($(this).find(".lot-prix").text().numberFrToDb());
			var lUniteLot = $(this).find(".lot-unite").text();
			
			//alert(lQuantite % lQuantiteLot);
			
			if(lId != null && lId != pId && lUniteLot == lUnite && lQuantiteLot <= lQuantite && (lQuantite % lQuantiteLot) == 0) {
				var lVoLot = {	
						id:lId,
						quantite:lQuantiteLot.nombreFormate(2,',',' '),
						prix:lPrix.nombreFormate(2,',',' '),
						unite:lUnite,
						sigleMonetaire:gSigleMonetaire};
				lData.modelesLot.push(lVoLot);		
			}
		});
		
		$(lGestionAbonnementTemplate.dialogSupprimerLotModifierMarche.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:900,
			buttons: {
				'Valider': function() {
					that.supprimerLotModifierReservation($(this),pId);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.supprimerLotModifierReservation = function(pDialog,pIdLot) {
		var lIdLotRemplacement = pDialog.find(":input[name=pro-lot]:checked").val();

		Infobulle.init();
		if(lIdLotRemplacement == undefined) { // Pas de lot sélectionné
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_254_CODE;
			erreur.message = ERR_254_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
		} else {		
			this.mLotRemplacement[pIdLot] = lIdLotRemplacement; // Ajout à la table de remplacement
			$("#ligne-lot-" + pIdLot + ", #btn-supprimer-lot-" + lIdLotRemplacement).remove(); // Supression du formulaire de l'ancien lot + delete du bouton de suppression du lot de remplacement
			$("#pro-lot-" + lIdLotRemplacement + "-id").attr("checked","checked").attr("disabled","disabled"); // Coche le lot dans le formulaire et le rend non sélectionnable
			pDialog.dialog('close'); // Fermeture de la fenêtre
		}
	};
	
	/*this.affectFormUnite = function(pData) {
		var that = this;
		pData.find("#pro-unite").keyup(function(event) {
			$(".unite-stock").text($('#pro-unite').val());
		}).change(function() {
			$(".unite-stock").text($('#pro-unite').val());
		});		
		return pData;
	};*/
	
	this.modifierProduit = function(pDialog) {
		var that = this;
		
		var lProduitAbonnement = new ProduitAbonnementVO();
		lProduitAbonnement.id = pDialog.find(':input[name=idProduit]').val();
		//lProduitAbonnement.unite = pDialog.find(':input[name=pro-formUnite]').val();
		lProduitAbonnement.unite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
		lProduitAbonnement.stockInitial = pDialog.find(':input[name=pro-stockInitial]').val().numberFrToDb();
		if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1) {
			lProduitAbonnement.max = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
		} else {
			lProduitAbonnement.max = -1;			
		}		
		lProduitAbonnement.frequence = pDialog.find(':input[name=pro-frequence]').val();

		lProduitAbonnement.quantiteReservation = this.mQuantiteReservation;
		lProduitAbonnement.tailleLotResaMax = this.mTailleLotResaMax;

		lProduitAbonnement.lotRemplacement = this.mLotRemplacement;
		pDialog.find('.ligne-lot :checkbox:checked').each( function () {
			// Récupération des lots
			var lVoLot = new DetailCommandeVO();
			lVoLot.id = $(this).closest(".ligne-lot").find(".lot-id").text();
			lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
			lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
			
			lProduitAbonnement.lots.push(lVoLot);										
		});
		
		var lValid = new ProduitAbonnementValid();
		var lVr = lValid.validUpdate(lProduitAbonnement);		
		if(lVr.valid) {	
			Infobulle.init();
			lProduitAbonnement.fonction = "modifier";
			$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lProduitAbonnement),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs

							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_343_CODE;
							erreur.message = ERR_343_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);
							
							that.construct({id:lProduitAbonnement.id,vr:lVR});
							pDialog.dialog('close');
						} else {
							Infobulle.generer(lResponse,'pro-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'pro-');
		}
	};
	
	this.affectDialogSuppProduit = function(pData) {
		pData.find("#btn-supp").click(function() {
			var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
			var lTemplate = lGestionAbonnementTemplate.dialogSuppressionProduit;
			var lButton = this;
			$(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {fonction:"supprimer", id:$(lButton).attr("idProduit")};
						var lDialog = this;
						$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											$(lDialog).dialog('close');

											var lVR = new Object();
											var erreur = new VRerreur();
											erreur.code = ERR_344_CODE;
											erreur.message = ERR_344_MSG;
											lVR.valid = false;
											lVR.log = new VRelement();
											lVR.log.valid = false;
											lVR.log.erreurs.push(erreur);
											
											ListeProduitVue({vr:lVR});
										} else {
											Infobulle.generer(lResponse,'');
										}
									}
								},"json"
						);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
				
			});
		});
		return pData;
	};
	
	this.construct(pParam);
};function ListeProduitVue(pParam) {
	this.mEditionLot = false;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeProduitVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"afficher"};
		lParam = $.extend(lParam,pParam);
		$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		
		if(lResponse.produits && lResponse.produits.fermes && lResponse.produits.fermes.length > 0 && lResponse.produits.fermes[0].nom != null) {
			var lTemplate = lGestionAbonnementTemplate.listeProduit;			
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse.produits))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionAbonnementTemplate.listeProduitVide)));
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectRecherche(pData);
		pData = this.affectLienProduit(pData);
		pData = this.affectAjoutProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};

	this.affectAjoutProduit = function(pData) {
		var that = this;
		pData.find('#btn-nv-produit').click(function() {
			that.dialogAjoutProduit();
		});
		return pData;
	};
		
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	};
			
	this.affectLienProduit = function(pData) {
		pData.find(".ligne-produit").click(function() {
			DetailProduitAbonnementVue({id: $(this).attr("idProduit")});
		});
		return pData;
	};
	
	this.dialogAjoutProduit = function(pData) {
		var that = this;
		var lParam = {fonction:"listeFerme"};
		$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
							var lTemplate = lGestionAbonnementTemplate.dialogAjoutProduit;
							
							$(that.affectAjoutProduitSelectFerme($(lTemplate.template(lResponse)))).dialog({			
								autoOpen: true,
								modal: true,
								draggable: true,
								resizable: false,
								width:900,
								buttons: {
									'Ajouter': function() {
										that.ajouterProduit($(this));
									},
									'Annuler': function() {
										that.mEditionLot = false;
										$(this).dialog('close');
									}
								},
								close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
							});
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);	
		return pData;
	};
	
	this.affectAjoutProduitSelectFerme = function(pData) {
		var that = this;
		pData.find("#pro-idFerme select").change(function() {
			var lId = $(this).val();
			$("#pro-idCategorie select, #pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#detail-produit").replaceWith("<div id=\"detail-produit\"></div>");
			if(lId > 0) {
				var lParam = {fonction:"listeProduit",id:lId};
				$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								
								if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].nproId != null) {
								
									that.mProduits = [];
									//that.mListeProduit = [];
								
									var lIdCategorie = 0;
									var lListeCategorie = [];
									$.each(lResponse.listeProduit,function() {
										if(that.mProduits[this.cproId]) {
											that.mProduits[this.cproId].listeProduit.push(this);
										} else {
											that.mProduits[this.cproId] = {nom:this.cproNom,listeProduit:[this]};
										}
										if(lIdCategorie != this.cproId) {
											lListeCategorie.push({cproId:this.cproId,cproNom:this.cproNom});
											lIdCategorie = this.cproId;
										}
									});
									
	
									var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
									var lTemplate = lGestionAbonnementTemplate.ajoutProduitSelectCategorie;
									
									$("#pro-idCategorie").replaceWith(that.affectAjoutProduitSelectCategorie($(lTemplate.template({listeCategorie:lListeCategorie}))));
									
								} else {
									// Message d'information
									var lVr = new TemplateVR();
									lVr.valid = false;
									lVr.log.valid = false;
									var erreur = new VRerreur();
									erreur.code = ERR_332_CODE;
									erreur.message = ERR_332_MSG;
									lVr.log.erreurs.push(erreur);
									Infobulle.generer(lVr,'');
								}
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
			} 
						
		});
		return pData;
	};
	
	this.affectAjoutProduitSelectCategorie = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			var lId = $(this).val();
			$("#pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#detail-produit").replaceWith("<div id=\"detail-produit\"></div>");
			if(lId > 0) {
				
				var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
				var lTemplate = lGestionAbonnementTemplate.ajoutProduitSelectProduit;
				
				$("#pro-idProduit").replaceWith(that.affectAjoutProduitSelectProduit($(lTemplate.template(that.mProduits[lId]))));
				
			}		
		});
		return pData;
	};
	
	this.affectAjoutProduitSelectProduit = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			var lId = $(this).val();
			if(lId > 0) {
				var lParam = {fonction:"listeUnite",id:lId};
				$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								
								var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
								var lTemplate = lGestionAbonnementTemplate.detailProduitAjoutProduit;
								
								var lData = {};
								if(lResponse.unite.length > 0) {
									/*if(lResponse.unite.length == 1) {
										if(lResponse.unite[0].mLotId == null) { // Pas d'unité
											lData.formUnite = lGestionAbonnementTemplate.formUniteSansUnite;
										} else { // Une seule unité
											lData.formUnite = lGestionAbonnementTemplate.formUnite.template({unite:lResponse.unite[0].mLotUnite});
											lData.unite = lResponse.unite[0].mLotUnite;
										}
									} else { // Plusieures unités
										lData.formUnite = lGestionAbonnementTemplate.formUniteSelect.template(lResponse);
									}*/
									
									lData.modelesLot = [];
									$(lResponse.unite).each(function() {
										if(this.mLotId != null) {
											this.id = this.mLotId;
											this.quantite = this.mLotQuantite.nombreFormate(2,',',' ');
											this.unite = this.mLotUnite;
											this.prix = this.mLotPrix.nombreFormate(2,',',' ');
											this.sigleMonetaire = gSigleMonetaire;
											lData.modelesLot.push(this);
											lData.unite = this.mLotUnite;
										}
									});	
									lResponse.modelesLot = lResponse.unite;
								}
								
								$("#detail-produit").replaceWith(that.affectDetailProduit($(lTemplate.template(lData))));
									
								
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
			} else {
				$("#detail-produit").replaceWith($("<div id=\"detail-produit\">"));
			}			
		});
		return pData;
	};
	
	this.affectDetailProduit = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectLimiteStock(pData);
		pData = this.affectAjoutLot(pData);
		pData = this.affectAjoutLotGestion(pData);
		//pData = this.affectFormUnite(pData);
		return pData;		
	};
	
	this.affectAjoutLot = function(pData) {
		var that = this;
		pData.find('#btn-ajout-lot').click(function() {that.ajoutLot();});
		pData.find('#table-pro-prix input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLot();
			}
		});
		return pData;		
	};
	
	this.ajoutLot = function() {
		var lVo = new ModeleLotVO();
		lVo.quantite = $(":input[name=lot-quantite]").val().numberFrToDb();
		lVo.unite = $(":input[name=lot-unite]").val();
		lVo.prix = $(":input[name=lot-prix]").val().numberFrToDb();
				
		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lGestionAbonnementTemplate = new GestionAbonnementTemplate();		
			var lTemplate = lGestionAbonnementTemplate.modeleLot;				
			this.mIdLot--;
			lVo.id = this.mIdLot;
			lVo.sigleMonetaire = gSigleMonetaire;
			lVo.quantite = lVo.quantite.nombreFormate(2,',',' ');
			lVo.prix = lVo.prix.nombreFormate(2,',',' ');		
			$("#lot-liste").append(this.affectLot($(lTemplate.template(lVo))));
			
			$(":input[name=lot-quantite], :input[name=lot-unite], :input[name=lot-prix]").val("");
		} else {
			Infobulle.generer(lVr,'pro-lot-');
		}
	};
	
	this.affectLot = function(pData) {
		pData = this.affectAjoutLotGestion(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectAjoutLotGestion = function(pData) {
		var that = this;
		pData.find(".btn-modifier-lot").click(function() {
			that.ajoutLotModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(".btn-valider-lot").click(function() {
			that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find('.catalogue-input-lot').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
			}
		});	
		pData.find(".btn-annuler-lot").click(function() {
			that.ajoutLotAnnulerModification($(this).closest('tr').find('#id-lot').text());
		});	
		pData.find(".btn-supprimer-lot").click(function() {
			that.ajoutLotSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(":checkbox").change(function() {
			if(!that.majUnite()) {
				if($(this).attr("checked")) {
					$(this).removeAttr("checked");
				} else {
					$(this).attr("checked","checked");
				}				
			}
		});
		return pData;		
	};
	
	this.majUnite = function() {
		var lOk = true;
		var lNbChecked = 0;
		var lUnitePrec = "";
		$(".ligne-lot :checkbox:checked").each(function() {
			var lUnite = $(this).closest(".ligne-lot").find(".lot-unite").text();
			if(lUnitePrec != "" && lUnitePrec != lUnite) {
				lOk = false;
			} else {
				lUnitePrec = lUnite;
			}
			lNbChecked++;
		});
		if(lOk) { 
			if(lNbChecked > 0) {
				$(".unite-stock").text(lUnitePrec);	
			}
		} else {
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_333_CODE;
			erreur.message = ERR_333_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
		}
		return lOk;
	};
	
	this.affectLimiteStock = function(pData) {
		pData.find(':input[name=pro-qte-max-choix]').change(function() {
			if($(':input[name=pro-qte-max-choix]:checked').val() == 1) {				
				$(":input[name=pro-qte-max]").attr("disabled","").val("");
			} else {
				$(":input[name=pro-qte-max]").attr("disabled","disabled").val("");
			}
		});
		return pData;
	};

	this.ajoutLotModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text().numberFrToDb().nombreFormate(2,',',''));
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text().numberFrToDb().nombreFormate(2,',',''));
		
		this.mEditionLot = true;
	};
	

	this.ajoutLotValiderModification = function(pId) {
		var lVo = new ModeleLotVO();
		lVo.quantite = $("#pro-lot-" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-" + pId + "-prix").val().numberFrToDb();
	
		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
		
			$("#lot-" + pId + "-quantite").text(lVo.quantite.nombreFormate(2,',',' '));
			$("#lot-" + pId + "-unite").text(lVo.unite);
			$("#lot-" + pId + "-prix").text(lVo.prix.nombreFormate(2,',',' '));
			$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
			

			this.mEditionLot = false;
			this.majUnite();
		} else {
			Infobulle.generer(lVr,'pro-lot-' + pId + '-');
		}
	};
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		this.mEditionLot = false;
	};
	
	this.ajoutLotSupprimer = function(pId) {
		$("#ligne-lot-" + pId).remove();
	};
	
	/*this.affectFormUnite = function(pData) {
		var that = this;
		pData.find("#pro-unite").keyup(function(event) {
			$(".unite-stock").text($('#pro-unite').val());
		}).change(function() {
			$(".unite-stock").text($('#pro-unite').val());
		});		
		return pData;
	};*/
	
	this.ajouterProduit = function(pDialog) {
		var that = this;		
		var lIdNomProduit = pDialog.find(':input[name=produit]').val();

		if(lIdNomProduit != 0) {
			var lProduitAbonnement = new ProduitAbonnementVO();
			lProduitAbonnement.idNomProduit = lIdNomProduit;
			lProduitAbonnement.unite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
			lProduitAbonnement.stockInitial = pDialog.find(':input[name=pro-stockInitial]').val().numberFrToDb();
			if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1) {
				lProduitAbonnement.max = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
			} else {
				lProduitAbonnement.max = -1;
			}
			lProduitAbonnement.frequence = pDialog.find(':input[name=pro-frequence]').val();
			
			// Récupération des lots
			pDialog.find('.ligne-lot :checkbox:checked').each( function () {
				// Récupération des lots
				var lVoLot = new DetailCommandeVO();
				lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
				lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
				
				lProduitAbonnement.lots.push(lVoLot);										
			});	
			
			var lValid = new ProduitAbonnementValid();
			var lVr = lValid.validAjout(lProduitAbonnement);
			
			if(lVr.valid) {	
				Infobulle.init();
				lProduitAbonnement.fonction = "ajouter";
				$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lProduitAbonnement),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								
	
								var lVR = new Object();
								var erreur = new VRerreur();
								erreur.code = ERR_342_CODE;
								erreur.message = ERR_342_MSG;
								lVR.valid = false;
								lVR.log = new VRelement();
								lVR.log.valid = false;
								lVR.log.erreurs.push(erreur);
								
								that.construct({vr:lVR});
								pDialog.dialog('close');
							} else {
								Infobulle.generer(lResponse,'pro-');
							}
						}
					},"json"
				);
			} else {
				Infobulle.generer(lVr,'pro-');
			}
		}
	};
	
	this.construct(pParam);
}