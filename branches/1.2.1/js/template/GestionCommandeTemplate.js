;function GestionCommandeTemplate() {	
	this.dialogAjoutProduitAjoutMarche =
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
				"<div id=\"pro-idProduit\">" +
					"<select name=\"produit\" disabled=\"disabled\">" +
						"<option value=\"0\" >== Choisir un produit ==</option>" +
					"</select>" +
				"</div>" +
			"</div>" +
			"<div id=\"prix-stock-produit\">" +
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
		"<div id=\"pro-idProduit\">" +
			"<select name=\"produit\">" +
				"<option value=\"0\" >== Choisir un produit ==</option>" +
				"<!-- BEGIN listeProduit -->" +
				"<option value=\"{listeProduit.nproId}\" >{listeProduit.nproNom}</option>" +
				"<!-- END listeProduit -->" +
			"</select>" +
		"</div>";
	
	this.dialogAjoutAchatProduit =
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
				"<div id=\"pro-idProduit\">" +
					"<select name=\"produit\" disabled=\"disabled\">" +
						"<option value=\"0\" >== Choisir un produit ==</option>" +
					"</select>" +
				"</div>" +
			"</div>" +
			"<div id=\"detail-achat\">" +
			"</div>" +
		"</div>";
	
	this.detailProduitAjoutAchatProduit = 
		"<div id=\"detail-achat\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
			"<input type=\"hidden\" id=\"pro-id\" value=\"{idProduit}\"/>" +
			"<div id=\"choixTypeAchat\">" +
				"<input class=\"ui-widget-content ui-corner-all\" type=\"radio\" name=\"typeProduit\" id=\"pro-typeProduitNormal\" value=\"0\" checked=\"checked\"/> Achat" +
				"<input class=\"ui-widget-content ui-corner-all\" type=\"radio\" name=\"typeProduit\" id=\"pro-typeProduitSolidaire\" value=\"1\" /> Achat Solidaire" +
			"</div>" +
			"<table class=\"com-table-form\">" +
				"<tr>" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-quantite\" maxlength=\"13\" id=\"pro-quantite\"/> {unite}" +
					"</td>" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-prix\" maxlength=\"13\" id=\"pro-prix\"/> {sigleMonetaire}" +
					"</td>" +
				"</tr>" +
			"</table>" +
		"</div>";
	
	this.prixAjoutProduit =
		"<div id=\"div-lot\">" +
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
						"<button type=\"button\" id=\"btn-ajout-lot\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un prix de vente</button>" +
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
		"</div>";
	
	this.prixAbonnementAjoutProduit =
		"<div id=\"div-lot-abonnement\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Prix de vente</div>" +
			"<table class=\"com-table-form\" id=\"table-pro-abonnement-prix\">" +
				"<tr>" +
					"<td class=\"catalogue-entete-lot\">Quantité</td>" +
					"<td class=\"catalogue-entete-lot\">Unité</td>" +
					"<td>Prix</td>" +
					"<td></td>" +
					"<td></td>" +
				"</tr>" +
				"<tr class=\"btn-lot-abonnement\">" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-abo-quantite\" maxlength=\"13\" id=\"pro-abo-lot-quantite\"/>" +
					"</td>" +
					"<td>" +
						"<span id=\"pro-abo-lot-unite\">{uniteAbonnement}</span>" +
					"</td>" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-abo-prix\" maxlength=\"13\" id=\"pro-abo-lot-prix\"/> {sigleMonetaire}" +
					"</td>" +
					"<td colspan=\"2\">" +
						"<button type=\"button\" id=\"btn-ajout-lot-abonnement\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un prix de vente</button>" +
					"</td>" +
				"</tr>" +
			"</table>" +
			"<table class=\"com-table\" id=\"lot-liste-abonnement\">" +
	
				"<!-- BEGIN modelesLotAbonnementReservation -->" +
				"<tr class=\"ligne-lot-abonnement\" id=\"ligne-lot-abonnement-{modelesLotAbonnementReservation.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLotAbonnementReservation.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" checked=\"checked\" disabled=\"disabled\" value=\"{modelesLotAbonnementReservation.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLotAbonnementReservation.id}-id\" class=\"modele-lot-reservation\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnementReservation.id}-abonnement lot-quantite\" id=\"lot-{modelesLotAbonnementReservation.id}-quantite-abonnement\">{modelesLotAbonnementReservation.quantite}</span>"+
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnementReservation.id}-abonnement lot-unite\" id=\"lot-{modelesLotAbonnementReservation.id}-unite-abonnement\">{modelesLotAbonnementReservation.unite}</span>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{modelesLotAbonnementReservation.id}-abonnement lot-prix\" id=\"lot-{modelesLotAbonnementReservation.id}-prix-abonnement\">{modelesLotAbonnementReservation.prix}</span>" +
						" {modelesLotAbonnementReservation.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
					"</td>" +
				"</tr>" +
				"<!-- END modelesLotAbonnementReservation -->" +
			
				"<!-- BEGIN modelesLotAbonnement -->" +
				"<tr class=\"ligne-lot-abonnement\" id=\"ligne-lot-abonnement-{modelesLotAbonnement.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLotAbonnement.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" value=\"{modelesLotAbonnement.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLotAbonnement.id}-id\" class=\"modele-lot\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnement.id}-abonnement lot-quantite\" id=\"lot-{modelesLotAbonnement.id}-quantite-abonnement\">{modelesLotAbonnement.quantite}</span>"+
						"<input class=\"champ-lot-{modelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnement.id}-quantite\" maxlength=\"13\" id=\"pro-lot-abonnement{modelesLotAbonnement.id}-quantite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnement.id}-abonnement lot-unite\" id=\"lot-{modelesLotAbonnement.id}-unite-abonnement\">{modelesLotAbonnement.unite}</span>" +
						"<input disabled=\"disabled\" class=\"champ-lot-{modelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnement.id}-unite\" maxlength=\"20\" id=\"pro-lot-abonnement{modelesLotAbonnement.id}-unite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{modelesLotAbonnement.id}-abonnement lot-prix\" id=\"lot-{modelesLotAbonnement.id}-prix-abonnement\">{modelesLotAbonnement.prix}</span>" +
						"<input class=\"champ-lot-{modelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnement.id}-prix\" maxlength=\"13\" id=\"pro-lot-abonnement{modelesLotAbonnement.id}-prix\"/>" +
						" {modelesLotAbonnement.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
						"<span class=\"btn-lot-abonnement com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot-abonnement\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot-abonnement\" id=\"btn-valider-lot-{modelesLotAbonnement.id}-abonnement\" title=\"Valider\">" +
							"<span class=\"ui-icon ui-icon-check\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot-abonnement\" id=\"btn-annuler-lot-{modelesLotAbonnement.id}-abonnement\" title=\"Annuler\">" +
							"<span class=\"ui-icon ui-icon-closethick\"></span>" +
						"</span>" +
						"<span class=\"btn-lot-abonnement com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot-abonnement\" title=\"Supprimer\">" +				
							"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
				"<!-- END modelesLotAbonnement -->" +
			
			"</table>" +
		"</div>";
	
	this.stockAjoutProduit = 
		"<div id=\"id-stock\" class=\"{visibleSolidaire} pro-detail\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Stock</div>" +
			"<table class=\"com-table-form\">" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Limite de stock : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-stock-choix\" value=\"0\" checked=\"checked\"/>Pas de limite" +
					"</td>" +
				"</tr>" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-stock-choix\" value=\"1\"/>" +
						"<input disabled=\"disabled\" class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"pro-stock\" maxlength=\"13\" id=\"pro-qteRestante\"/> <span class=\"unite-stock\">{unite}</span>" +
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
						"<input disabled=\"disabled\" class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"pro-qte-max\" maxlength=\"13\" id=\"pro-qteMaxCommande\"/> <span class=\"unite-stock\">{unite}</span>" +
					"</td>" +
				"</tr>" +
			"</table>" +
		"</div>";
	
	this.stockAbonnementAjoutProduit = 
		"<div id=\"id-stock-abonnement\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Stock</div>" +
			"<table class=\"com-table-form\">" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Limite de stock : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<span id=\"stock-abonnement\">{stockInitialAbonnement}</span> {uniteAbonnement}" +
					"</td>" +
				"</tr>" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Quantité max par adhérent : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<span>{qMaxAbonnement}</span><span id=\"max-abonnement\" class=\"ui-helper-hidden\">{qMaxAbonnementValue}</span>" +
					"</td>" +
				"</tr>" +
			"</table>" +
		"</div>";
	
	this.typeProduitAjoutProduit =
		"<div id=\"pro-typeProduit\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Type de produit</div>" +
			"<input class=\"ui-widget-content ui-corner-all\" type=\"radio\" name=\"typeProduit\" id=\"pro-typeProduitNormal\" value=\"0\" {typeNormalSelected} /> Normal" +
			"<input class=\"ui-widget-content ui-corner-all\" type=\"radio\" name=\"typeProduit\" id=\"pro-typeProduitSolidaire\" value=\"1\" {typeSolidaireSelected}/> Solidaire" +
			"{typeProduitAbonnement}" +
		"</div>";
	
	this.typeProduitAbonnementAjoutProduit =
		"<input class=\"ui-widget-content ui-corner-all\" type=\"radio\" name=\"typeProduit\" id=\"pro-typeProduitAbonnement\" value=\"2\" {typeAbonnementSelected} /> Abonnement";
	
	this.prixEtStockAjoutProduit =
		"<div id=\"prix-stock-produit\">" +
			"{divTypeProduit}" +
			"<div id=\"pro-normal\" class=\"{visibleNormal} pro-detail\">" +
				"{divLot}" +
				"{divStock}" +
			"</div>" +
			"<div id=\"pro-abonnement\" class=\"{visibleAbonnement} pro-detail\">" +
				"{divLotAbonnement}" +
				"{divStockAbonnement}" +
			"</div>" +
		"</div>" ;
	
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
		"</tr>" ;
	
	this.modeleLotAbonnement =
		"<tr class=\"ligne-lot-abonnement\" id=\"ligne-lot-abonnement-{id}\">" +
			"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{id}</span></td>" +
			"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
				"<input type=\"checkbox\" value=\"{id}\" name=\"pro-lot\" id=\"pro-lot-{id}-id\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
				"<span class=\"champ-lot-{id}-abonnement lot-quantite\" id=\"lot-{id}-quantite-abonnement\">{quantite}</span>"+
				"<input class=\"champ-lot-{id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{id}-quantite\" maxlength=\"13\" id=\"pro-lot-abonnement{id}-quantite\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
				"<span class=\"champ-lot-{id}-abonnement lot-unite\" id=\"lot-{id}-unite-abonnement\">{unite}</span>" +
				"<input disabled=\"disabled\" class=\"champ-lot-{id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{id}-unite\" maxlength=\"20\" id=\"pro-lot-abonnement{id}-unite\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med\">" +
				"à " +
				"<span class=\"champ-lot-{id}-abonnement lot-prix\" id=\"lot-{id}-prix-abonnement\">{prix}</span>" +
				"<input class=\"champ-lot-{id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{id}-prix\" maxlength=\"13\" id=\"pro-lot-abonnement{id}-prix\"/>" +
				" {sigleMonetaire}" +
			"</td>" +
			"<td class=\"com-table-td-med td-edt\">" +
				"<span class=\"btn-lot-abonnement com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot-abonnement\" title=\"Modifier\">" +
					"<span class=\"ui-icon ui-icon-pencil\"></span>" +
				"</span>" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot-abonnement\" id=\"btn-valider-lot-{id}-abonnement\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check\"></span>" +
				"</span>" +
			"</td>" +
			"<td class=\"com-table-td-fin td-edt\">" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot-abonnement\" id=\"btn-annuler-lot-{id}-abonnement\" title=\"Annuler\">" +
					"<span class=\"ui-icon ui-icon-closethick\"></span>" +
				"</span>" +
				"<span class=\"btn-lot-abonnement com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot-abonnement\" id=\"btn-supprimer-lot-abonnement-{id}\" title=\"Supprimer\">" +				
					"<span class=\"ui-icon ui-icon-trash\"></span>" +
				"</span>" +
			"</td>" +
		"</tr>" ;
	
	this.btnValiderAjoutMarche = 
		"<div id=\"btn-gestion-marche\" class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
			"<button type=\"button\" id=\"btn-modifier-creation-commande\" class=\"com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center\">Modifier</button>" +
			"<button type=\"button\" id=\"btn-creer-marche\" class=\"ui-state-default ui-corner-all com-button com-center\">Valider</button>" +
		"</div>";
	
	this.ajoutMarcheListeProduit = 
		"<div id=\"liste-ferme\">" +
			"<!-- BEGIN fermes -->" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ferme-{fermes.ferId}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">{fermes.ferNom}</div>" +
				"<!-- BEGIN fermes.categories -->" +
				"<table class=\"com-table\">" +
					"<tr class=\"ui-widget-header\" >" +
						"<td class=\"com-table-td-debut\">{fermes.categories.cproNom}</td>" +
						"<td class=\"com-table-td-med\"></td>" +
						"<td class=\"com-table-td-med\"></td>" +
						"<td class=\"com-table-td-fin\"></td>" +
					"</tr>" +
					"<!-- BEGIN fermes.categories.produits -->" +
					"<tr>" +
						"<td class=\"com-table-td-debut\">{fermes.categories.produits.nproNom}</td>" +
						"<td class=\"com-table-td-med edt-marche-pro-unite\">{fermes.categories.produits.abonnement}</td>" +
						"<td class=\"com-table-td-med td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-produit\" title=\"Modifier\" id-produit=\"{fermes.categories.produits.nproId}\" typeProduit=\"{fermes.categories.produits.type}\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-produit\" title=\"Supprimer\" id-produit=\"{fermes.categories.produits.nproId}\" typeProduit=\"{fermes.categories.produits.type}\">" +				
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"<!-- END fermes.categories.produits -->" +
				"</table>" +
				"<!-- END fermes.categories -->" +
			"</div>"+
			"<!-- END fermes -->" +
		"</div>";
	
	this.flagAbonnement = 
		"<span class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Abonnement</span>";
	
	this.flagSolidaire = 
		"<span class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Solidaire</span>";
	
	this.dialogModifProduitAjoutMarche =
		"<div id=\"dialog-modif-pro\" title=\"Produit\">" +
			"<div id=\"information-detail-producteur\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Le Produit</div>" +

				"<div id=\"pro-idFerme\" class=\"com-float-left\" id-ferme=\"{ferId}\">" +
					"{ferNom}" +
				"</div>" +
				"<div id=\"pro-idCategorie\" class=\"com-float-left\" id-categorie=\"{cproId}\">" +
					"{cproNom}" +
				"</div>" +
				"<div id=\"pro-idProduit\" class=\"com-float-left\" id-produit=\"{nproId}\">" +
					"{nproNom}" +
				"</div>" +
			"</div>" +
			"<div id=\"prix-stock-produit\">" +
				"<div id=\"pro-typeProduit\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Type de produit</div>" +
					"{typeProduitLabel}" +
				"</div>" +
				"{divLot}" +
				"{divStock}" + 
			"</div>" +
		"</div>";
	
	this.prixModifProduit =
		"<div id=\"div-lot\">" +
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
						"<button type=\"button\" id=\"btn-ajout-lot\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un prix de vente</button>" +
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
		"</div>";
	
	this.prixAbonnementModifProduit =
		"<div id=\"div-lot-abonnement\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Prix de vente</div>" +
			"<table class=\"com-table-form\" id=\"table-pro-abonnement-prix\">" +
				"<tr>" +
					"<td class=\"catalogue-entete-lot\">Quantité</td>" +
					"<td class=\"catalogue-entete-lot\">Unité</td>" +
					"<td>Prix</td>" +
					"<td></td>" +
					"<td></td>" +
				"</tr>" +
				"<tr class=\"btn-lot-abonnement\">" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-abo-quantite\" maxlength=\"13\" id=\"pro-abo-lot-quantite\"/>" +
					"</td>" +
					"<td>" +
						"<span id=\"pro-abo-lot-unite\">{uniteAbonnement}</span>" +
					"</td>" +
					"<td>" +
						"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-abo-prix\" maxlength=\"13\" id=\"pro-abo-lot-prix\"/> {sigleMonetaire}" +
					"</td>" +
					"<td colspan=\"2\">" +
						"<button type=\"button\" id=\"btn-ajout-lot-abonnement\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un prix de vente</button>" +
					"</td>" +
				"</tr>" +
			"</table>" +
			"<table class=\"com-table\" id=\"lot-liste-abonnement\">" +
				"<!-- BEGIN modelesLotAbonnementReservation -->" +
				"<tr class=\"ligne-lot-abonnement\" id=\"ligne-lot-abonnement-{modelesLotAbonnementReservation.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLotAbonnementReservation.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" checked=\"checked\" disabled=\"disabled\" value=\"{modelesLotAbonnementReservation.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLotAbonnementReservation.id}-id\" class=\"modele-lot-reservation\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnementReservation.id}-abonnement lot-quantite\" id=\"lot-{modelesLotAbonnementReservation.id}-quantite-abonnement\">{modelesLotAbonnementReservation.quantite}</span>"+
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnementReservation.id}-abonnement lot-unite\" id=\"lot-{modelesLotAbonnementReservation.id}-unite-abonnement\">{modelesLotAbonnementReservation.unite}</span>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{modelesLotAbonnementReservation.id}-abonnement lot-prix\" id=\"lot-{modelesLotAbonnementReservation.id}-prix-abonnement\">{modelesLotAbonnementReservation.prix}</span>" +
						" {modelesLotAbonnementReservation.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
					"</td>" +
				"</tr>" +
				"<!-- END modelesLotAbonnementReservation -->" +
				
				"<!-- BEGIN modelesLotAbonnementReservationModif -->" +
				"<tr class=\"ligne-lot-abonnement\" id=\"ligne-lot-abonnement-{modelesLotAbonnementReservationModif.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLotAbonnementReservationModif.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" checked=\"checked\" disabled=\"disabled\" value=\"{modelesLotAbonnementReservationModif.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLotAbonnementReservationModif.id}-id\" {modelesLotAbonnementReservationModif.checked} class=\"{modelesLotAbonnementReservationModif.modele}\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnementReservationModif.id}-abonnement lot-quantite\" id=\"lot-{modelesLotAbonnementReservationModif.id}-quantite-abonnement\">{modelesLotAbonnementReservationModif.quantite}</span>"+
						"<input class=\"champ-lot-{modelesLotAbonnementReservationModif.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnementReservationModif.id}-quantite\" maxlength=\"13\" id=\"pro-lot-abonnement{modelesLotAbonnementReservationModif.id}-quantite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnementReservationModif.id}-abonnement lot-unite\" id=\"lot-{modelesLotAbonnementReservationModif.id}-unite-abonnement\">{modelesLotAbonnementReservationModif.unite}</span>" +
						"<input disabled=\"disabled\" class=\"champ-lot-{modelesLotAbonnementReservationModif.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnementReservationModif.id}-unite\" maxlength=\"20\" id=\"pro-lot-abonnement{modelesLotAbonnementReservationModif.id}-unite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{modelesLotAbonnementReservationModif.id}-abonnement lot-prix\" id=\"lot-{modelesLotAbonnementReservationModif.id}-prix-abonnement\">{modelesLotAbonnementReservationModif.prix}</span>" +
						"<input class=\"champ-lot-{modelesLotAbonnementReservationModif.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnementReservationModif.id}-prix\" maxlength=\"13\" id=\"pro-lot-abonnement{modelesLotAbonnementReservationModif.id}-prix\"/>" +
						" {modelesLotAbonnementReservationModif.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
						"<span class=\"btn-lot-abonnement com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot-abonnement\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot-abonnement\" id=\"btn-valider-lot-{modelesLotAbonnementReservationModif.id}-abonnement\" title=\"Valider\">" +
							"<span class=\"ui-icon ui-icon-check\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot-abonnement\" id=\"btn-annuler-lot-{modelesLotAbonnementReservationModif.id}-abonnement\" title=\"Annuler\">" +
							"<span class=\"ui-icon ui-icon-closethick\"></span>" +
						"</span>" +
						"<span class=\"btn-lot-abonnement com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot-abonnement\" id=\"btn-supprimer-lot-abonnement-{modelesLotAbonnementReservationModif.id}\" title=\"Supprimer\">" +				
							"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
				"<!-- END modelesLotAbonnementReservationModif -->" +
	
				"<!-- BEGIN modelesLotAbonnement -->" +
				"<tr class=\"ligne-lot-abonnement\" id=\"ligne-lot-abonnement-{modelesLotAbonnement.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLotAbonnement.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" value=\"{modelesLotAbonnement.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLotAbonnement.id}-id\" {modelesLotAbonnement.checked} class=\"{modelesLotAbonnement.modele}\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnement.id}-abonnement lot-quantite\" id=\"lot-{modelesLotAbonnement.id}-quantite-abonnement\">{modelesLotAbonnement.quantite}</span>"+
						"<input class=\"champ-lot-{modelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnement.id}-quantite\" maxlength=\"13\" id=\"pro-lot-abonnement{modelesLotAbonnement.id}-quantite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{modelesLotAbonnement.id}-abonnement lot-unite\" id=\"lot-{modelesLotAbonnement.id}-unite-abonnement\">{modelesLotAbonnement.unite}</span>" +
						"<input disabled=\"disabled\" class=\"champ-lot-{modelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnement.id}-unite\" maxlength=\"20\" id=\"pro-lot-abonnement{modelesLotAbonnement.id}-unite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{modelesLotAbonnement.id}-abonnement lot-prix\" id=\"lot-{modelesLotAbonnement.id}-prix-abonnement\">{modelesLotAbonnement.prix}</span>" +
						"<input class=\"champ-lot-{modelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLotAbonnement.id}-prix\" maxlength=\"13\" id=\"pro-lot-abonnement{modelesLotAbonnement.id}-prix\"/>" +
						" {modelesLotAbonnement.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
						"<span class=\"btn-lot-abonnement com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot-abonnement\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot-abonnement\" id=\"btn-valider-lot-{modelesLotAbonnement.id}-abonnement\" title=\"Valider\">" +
							"<span class=\"ui-icon ui-icon-check\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot-abonnement\" id=\"btn-annuler-lot-{modelesLotAbonnement.id}-abonnement\" title=\"Annuler\">" +
							"<span class=\"ui-icon ui-icon-closethick\"></span>" +
						"</span>" +
						"<span class=\"btn-lot-abonnement com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot-abonnement\" id=\"btn-supprimer-lot-abonnement-{modelesLotAbonnement.id}\" title=\"Supprimer\">" +				
							"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
				"<!-- END modelesLotAbonnement -->" +
				
				"<!-- BEGIN listeModelesLotAbonnement -->" +
				"<tr class=\"ligne-lot-abonnement\" id=\"ligne-lot-abonnement-modele-{listeModelesLotAbonnement.id}\">" +
					"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{listeModelesLotAbonnement.id}</span></td>" +
					"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
						"<input type=\"checkbox\" value=\"{listeModelesLotAbonnement.id}\" name=\"pro-lot\" id=\"pro-lot-{listeModelesLotAbonnement.id}-id\" {listeModelesLotAbonnement.checked} class=\"{listeModelesLotAbonnement.modele}\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
						"<span class=\"champ-lot-{listeModelesLotAbonnement.id}-abonnement lot-quantite\" id=\"lot-{listeModelesLotAbonnement.id}-quantite-abonnement\">{listeModelesLotAbonnement.quantite}</span>"+
						"<input class=\"champ-lot-{listeModelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{listeModelesLotAbonnement.id}-quantite\" maxlength=\"13\" id=\"pro-lot-abonnement{listeModelesLotAbonnement.id}-quantite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
						"<span class=\"champ-lot-{listeModelesLotAbonnement.id}-abonnement lot-unite\" id=\"lot-{listeModelesLotAbonnement.id}-unite-abonnement\">{listeModelesLotAbonnement.unite}</span>" +
						"<input disabled=\"disabled\" class=\"champ-lot-{listeModelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{listeModelesLotAbonnement.id}-unite\" maxlength=\"20\" id=\"pro-lot-abonnement{listeModelesLotAbonnement.id}-unite\"/>" +
					"</td>" +
					"<td class=\"com-table-td-med\">" +
						"à " +
						"<span class=\"champ-lot-{listeModelesLotAbonnement.id}-abonnement lot-prix\" id=\"lot-{listeModelesLotAbonnement.id}-prix-abonnement\">{listeModelesLotAbonnement.prix}</span>" +
						"<input class=\"champ-lot-{listeModelesLotAbonnement.id}-abonnement catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{listeModelesLotAbonnement.id}-prix\" maxlength=\"13\" id=\"pro-lot-abonnement{listeModelesLotAbonnement.id}-prix\"/>" +
						" {listeModelesLotAbonnement.sigleMonetaire}" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
					"</td>" +
				"</tr>" +
				"<!-- END listeModelesLotAbonnement -->" +
			
			"</table>" +
		"</div>";
	
	this.stockModifProduit = 
		"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Stock</div>" +
		"<table class=\"com-table-form\">" +
			"<tr>" +
				"<th class=\"com-table-form-th\">" +
					"Limite de stock : " +
				"</th>" +
				"<td class=\"com-table-form-td\">" +
					"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-stock-choix\" value=\"0\" {nproStockCheckedNoLimit} />Pas de limite" +
				"</td>" +
			"</tr>" +
			"<tr>" +
				"<th class=\"com-table-form-th\">" +
				"</th>" +
				"<td class=\"com-table-form-td\">" +
					"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-stock-choix\" value=\"1\" {nproStockCheckedLimit} />" +
					"<input {nproStockDisabled} class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" value=\"{nproStock}\" name=\"pro-stock\" maxlength=\"13\" id=\"pro-qteRestante\"/> <span class=\"unite-stock\">{unite}</span>" +
				"</td>" +
			"</tr>" +
			"<tr>" +
				"<th class=\"com-table-form-th\">" +
					"Quantité max par adhérent : " +
				"</th>" +
				"<td class=\"com-table-form-td\">" +
					"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"0\" {nproQteMaxCheckedNoLimit} />Pas de limite" +
				"</td>" +
			"</tr>" +
			"<tr>" +
				"<th class=\"com-table-form-th\">" +
				"</th>" +
				"<td class=\"com-table-form-td\">" +
					"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"1\" {nproQteMaxCheckedLimit} />" +
					"<input {nproQteMaxDisabled} class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" value=\"{nproQteMax}\" name=\"pro-qte-max\" maxlength=\"13\" id=\"pro-qteMaxCommande\"/> <span class=\"unite-stock\">{unite}</span>" +
				"</td>" +
			"</tr>" +
		"</table>";
	
	this.dialogSupprimerLotModifierMarche =
		"<div id=\"dialog-supp-lot\" title=\"Supprimer le prix de vente\">" +
			"<div id=\"information-detail-producteur\">" +
				"Des réservations sont positionnées sur ce prix de vente.<br/>" +
				"Veuillez préciser le nouveau prix de vente sur lequel se baseront ces réservations." +				
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
		
	this.formulaireAjoutMarche = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_ajout_commande_ext\">" +		
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Nouveau Marché</div>" +
					"<div class=\"com-widget-content\">" +		
						"<form id=\"formulaire-information-creation-commande\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th\">Nom du Marché : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"nom-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"nom\" id=\"marche-nom\" maxlength=\"100\" />" +
									"</td>" +
								"</tr>" +								
								"<tr>" +
									"<th class=\"com-table-form-th\">Début des Réservations * : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"date-debut-reservation-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-debut-reservation\" id=\"marche-dateDebutReservation\" />" +
									"</td>" +
									"<td class=\"com-table-form-td\">" +
										"à " +
										"<span id=\"time-debut-reservation-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<select name=\"heure-debut-reservation\" id=\"marche-timeDebutReservation\" class=\"informations-marche\" >" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"01\">01</option>" +
										    "<option value=\"02\">02</option>" +
										    "<option value=\"03\">03</option>" +
										    "<option value=\"04\">04</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"06\">06</option>" +
										    "<option value=\"07\">07</option>" +
										    "<option value=\"08\">08</option>" +
										    "<option value=\"09\">09</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"11\">11</option>" +
										    "<option value=\"12\">12</option>" +
										    "<option value=\"13\">13</option>" +
										    "<option value=\"14\">14</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"16\">16</option>" +
										    "<option value=\"17\">17</option>" +
										    "<option value=\"18\">18</option>" +
										    "<option value=\"19\">19</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"21\">21</option>" +
										    "<option value=\"22\">22</option>" +
										    "<option value=\"23\">23</option>" +
										  "</select>" +
					   					"<span class=\"informations-marche\">H</span> <select name=\"minute-debut-reservation\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"25\">25</option>" +
										    "<option value=\"30\">30</option>" +
										    "<option value=\"35\">35</option>" +
										    "<option value=\"40\">40</option>" +
										    "<option value=\"45\">45</option>" +
										    "<option value=\"50\">50</option>" +
										    "<option value=\"55\">55</option>" +
										  "</select>" +
									"</td>" +
								"</tr>" +								
								"<tr>" +
									"<th class=\"com-table-form-th\">Fin des Réservations * : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"date-fin-reservation-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-fin-reservation\" id=\"marche-dateFinReservation\" />" +
									"</td>" +
									"<td class=\"com-table-form-td\">" +
										"à " +
										"<span id=\"time-fin-reservation-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<select name=\"heure-fin-reservation\" id=\"marche-timeFinReservation\" class=\"informations-marche\" >" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"01\">01</option>" +
										    "<option value=\"02\">02</option>" +
										    "<option value=\"03\">03</option>" +
										    "<option value=\"04\">04</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"06\">06</option>" +
										    "<option value=\"07\">07</option>" +
										    "<option value=\"08\">08</option>" +
										    "<option value=\"09\">09</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"11\">11</option>" +
										    "<option value=\"12\">12</option>" +
										    "<option value=\"13\">13</option>" +
										    "<option value=\"14\">14</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"16\">16</option>" +
										    "<option value=\"17\">17</option>" +
										    "<option value=\"18\">18</option>" +
										    "<option value=\"19\">19</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"21\">21</option>" +
										    "<option value=\"22\">22</option>" +
										    "<option value=\"23\">23</option>" +
										  "</select>" +
					   					"<span class=\"informations-marche\">H</span> <select name=\"minute-fin-reservation\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"25\">25</option>" +
										    "<option value=\"30\">30</option>" +
										    "<option value=\"35\">35</option>" +
										    "<option value=\"40\">40</option>" +
										    "<option value=\"45\">45</option>" +
										    "<option value=\"50\">50</option>" +
										    "<option value=\"55\">55</option>" +
										  "</select>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th\">Jour du marché * : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"date-debut-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-debut\" id=\"marche-dateMarcheDebut\"/>" +
									"</td>" +
									"<td class=\"com-table-form-td\">" +
										"de " +
										"<span id=\"time-debut-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<select name=\"heure-debut\" id=\"marche-timeMarcheDebut\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"01\">01</option>" +
										    "<option value=\"02\">02</option>" +
										    "<option value=\"03\">03</option>" +
										    "<option value=\"04\">04</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"06\">06</option>" +
										    "<option value=\"07\">07</option>" +
										    "<option value=\"08\">08</option>" +
										    "<option value=\"09\">09</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"11\">11</option>" +
										    "<option value=\"12\">12</option>" +
										    "<option value=\"13\">13</option>" +
										    "<option value=\"14\">14</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"16\">16</option>" +
										    "<option value=\"17\">17</option>" +
										    "<option selected=\"selected\" value=\"18\">18</option>" +
										    "<option value=\"19\">19</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"21\">21</option>" +
										    "<option value=\"22\">22</option>" +
										    "<option value=\"23\">23</option>" +
										  "</select>" +
					   					"<span class=\"informations-marche\">H</span> <select name=\"minute-debut\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"25\">25</option>" +
										    "<option selected=\"selected\" value=\"30\">30</option>" +
										    "<option value=\"35\">35</option>" +
										    "<option value=\"40\">40</option>" +
										    "<option value=\"45\">45</option>" +
										    "<option value=\"50\">50</option>" +
										    "<option value=\"55\">55</option>" +
										  "</select>" +
										"</td>" +
										"<td class=\"com-table-form-td\">" +
											"à " +
											"<span id=\"time-fin-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
											"<select name=\"heure-fin\" id=\"marche-timeMarcheFin\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"01\">01</option>" +
										    "<option value=\"02\">02</option>" +
										    "<option value=\"03\">03</option>" +
										    "<option value=\"04\">04</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"06\">06</option>" +
										    "<option value=\"07\">07</option>" +
										    "<option value=\"08\">08</option>" +
										    "<option value=\"09\">09</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"11\">11</option>" +
										    "<option value=\"12\">12</option>" +
										    "<option value=\"13\">13</option>" +
										    "<option value=\"14\">14</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"16\">16</option>" +
										    "<option value=\"17\">17</option>" +
										    "<option value=\"18\">18</option>" +
										    "<option selected=\"selected\" value=\"19\">19</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"21\">21</option>" +
										    "<option value=\"22\">22</option>" +
										    "<option value=\"23\">23</option>" +
										  "</select>" +
					   					"<span class=\"informations-marche\">H</span> <select name=\"minute-fin\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"25\">25</option>" +
										    "<option value=\"30\">30</option>" +
										    "<option value=\"35\">35</option>" +
										    "<option value=\"40\">40</option>" +
										    "<option selected=\"selected\" value=\"45\">45</option>" +
										    "<option value=\"50\">50</option>" +
										    "<option value=\"55\">55</option>" +
										  "</select>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th\">Description : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"description-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<textarea class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" name=\"description\" id=\"marche-description\" ></textarea>" +
									"</td>" +
								"</tr>" +
							"</table>" +
						"</form>" +
					"</div>" +
				"</div>" +
				"<div id=\"btn-ajout-produit-div\" class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
					"<button type=\"button\" id=\"btn-ajout-produit\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un produit</button>" +
				"</div>" +
				"<div id=\"liste-ferme\">" +
				"</div>" +
			"</div>" +	
		"</div>";
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-barre-menu-2\">" +
					"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-archive\">" +
						"<span class=\"com-float-left\">Les Marchés cloturés</span>" +
						"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-e\"></span>" +
					"</button>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Les Marchés en cours" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-nv-marche\" title=\"Ajouter un marché\">" +
							"<span class=\"ui-icon ui-icon-plusthick\">" +
							"</span>" +
						"</span>" +
					"</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-center\" colspan=\"2\">N°</th>" +
								"<th class=\"com-table-th-med\">Marché</th>	" +
								"<th class=\"com-table-th-med\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th-fin\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr class=\"com-cursor-pointer btn-marche\" id=\"{commande.id}\">" +
								"<td class=\"com-table-td-debut lst-resa-th-num com-text-align-right\">{commande.numero} :</td>" +
								"<td class=\"com-table-td-med lst-resa-td-nom \">{commande.nom}</td>" +
								"<td class=\"com-table-td-med\">Le {commande.jourMarcheDebut} {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td-med\">Le {commande.jourFinReservation} {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td-fin\">" +
									"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
										"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
									"</span>" +
								"</td>" +								
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +	
				"</div>" +				
			"</div>" +
		"</div>";
	
	this.listeCommandeArchivePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-barre-menu-2\">" +
					"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-encours\">" +
						"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Les Marchés en cours" +
					"</button>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés cloturés</div>" +
					
						"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
							"<form>" +	
							"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
							"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
							"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
							"	<input type=\"hidden\" class=\"pagesize\" value=\"15\">" +
							"</form>" +	
						"</div>" +
						
						"<table class=\"com-table\" id=\"table-marche-archive\">" +
							"<thead>" +
								"<tr class=\"ui-widget ui-widget-header\">" +
									"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer com-center\" colspan=\"2\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
									"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\" ><span class=\"ui-icon span-icon\"></span>Date de cloture des Réservations</th>" +
									"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\" ><span class=\"ui-icon span-icon\"></span>Marché</th>	" +
									"<th class=\"com-table-th-fin\"></th>	" +
								"</tr>" +
							"</thead>" +
							"<tbody>" +
								"<!-- BEGIN commande -->" +
								"<tr class=\"com-cursor-pointer detail-commande-ligne\" id-marche=\"{commande.id}\">" +
									"<td class=\"com-table-td-debut lst-resa-th-num com-text-align-right\">{commande.numero} : </td>" +
									"<td class=\"com-table-td-med lst-resa-td-nom\">{commande.nom}</td>" +
									"<td class=\"com-table-td-med\"><span class=\"ui-helper-hidden\">{commande.dateTimeFinResa}</span>Le {commande.jourFinReservation} {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
									"<td class=\"com-table-td-med\"><span class=\"ui-helper-hidden\">{commande.dateTimeMarche}</span>Le {commande.jourMarcheDebut} {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
									"<td class=\"com-table-td-fin\">" +
										"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
											"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
										"</span>" +
									"</td>" +		
								"</tr>" +
								"<!-- END commande -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";

	this.lotUnique = 
		"<input type=\"hidden\" id=\"lot-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.dialogClotureCommande = 				
			"<div id=\"dialog-cloturer-com\" title=\"Cloture du Marché n°{comNumero}\">" +
				"<p>Vous allez cloturer le Marché n°{comNumero}</p>" +
			"</div>";
	
	this.dialogExportListeAchatEtReservation =
		"<div id=\"dialog-cloturer-com\" title=\"Export des Achats et Réservations du marché n°{comNumero}\">" +
			"<p>Vous allez exporter les Achats et Réservations du Marché n°{comNumero}.<br/>" +
			"Cette action peut être longue.</p>" +
		"</div>";
	
	this.dialogExportListeReservation = 
			"<div id=\"dialog-export-liste-reservation\" title=\"Export des réservations en cours.\">" +
				"<form>" +
					"<table>" +
						"<tr>" +
							"<td>Format de sortie : </td>" +
							"<td><input type=\"radio\" name=\"format\" value=\"1\" checked=\"checked\" />CSV</td>" +
							"<td><input type=\"radio\" name=\"format\" value=\"0\" />Pdf</td>" +
						"</tr>" +
					"</table>" +
					"<div>Sélectionner les produits : </div>" +
					"<table class=\"com-table-100\">" +
						"<!-- BEGIN fermes -->" +
						"<tr class=\"ui-widget-header\" >" +
							"<td colspan=\"3\" class=\"com-table-td\">{fermes.ferNom}</td>" +
						"</tr>" +
						"<!-- BEGIN fermes.categories -->" +
						"<tr>" +
							"<td colspan=\"3\" class=\"com-table-td\">{fermes.categories.cproNom}</td>" +
						"</tr>" +
						"<!-- BEGIN fermes.categories.produits -->" +
						"<tr>" +
							"<td class=\"com-table-td-debut td-edt\"><input type=\"checkbox\" value=\"{fermes.categories.produits.id}\" name=\"id_produits\"/></td>" +
							"<td class=\"com-table-td-med\">{fermes.categories.produits.nproNom}</td>" +		
							"<td class=\"com-table-td-fin\">{fermes.categories.produits.abonnement}</td>" +		
						"</tr>" +
						"<!-- END fermes.categories.produits -->" +
						"<!-- END fermes.categories -->" +
						"<!-- END fermes -->" +
					"</table>" +
				"</form>" +
			"</div>";
	
	
	this.editerMarcheMenu = 
		"<div id=\"edt-com-nav-resa-achat\">" +
			"<span class=\"{infoMarcheSelected} com-cursor-pointer ui-widget-header ui-corner-tl com-btn-hover\" id=\"btn-information-marche\">Information</span>" +
			"<span class=\"{listeReservationSelected} com-cursor-pointer ui-widget-header com-btn-hover\" id=\"btn-liste-resa\">Reservations</span>" +
			"<span class=\"{listeAchatSelected} com-cursor-pointer ui-widget-header com-btn-hover\" id=\"btn-liste-achat-resa\">Achats</span>" +
			"<span class=\"{resumeMarcheSelected} com-cursor-pointer ui-widget-header ui-corner-tr com-btn-hover\" id=\"btn-resume-marche\">Resumé</span>" +
		"</div>";
		
	this.editerCommandePage = 
		"<div id=\"contenu\">" +
			"{editerMenu}" +
			"<div id=\"edt-com-liste\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Marché n°{comNumero} : {nom}" +
						"<span class=\"ui-helper-hidden marche-archive-1 com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-cloture-com\" title=\"Cloturer\">" +
							"<span class=\"ui-icon ui-icon-locked\">" +
							"</span>" +
						"</span>" +
						"<span class=\"ui-helper-hidden marche-archive-1 com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-play-com\" title=\"Ouvrir les ventes et réservations\">" +
							"<span class=\"ui-icon ui-icon-play\">" +
							"</span>" +
						"</span>" +
						"<span class=\"ui-helper-hidden marche-archive-0  com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-pause-com\" title=\"Arrêter les ventes et réservations\">" +
							"<span class=\"ui-icon ui-icon-pause\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-modif-com\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-dupliquer-com\" title=\"Dupliquer le marché\">" +
							"<span class=\"ui-icon ui-icon-copy\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-livraison-com\" title=\"Bon de livraison\">" +
							"<span class=\"ui-icon ui-icon-cart\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-bon-com\" title=\"Bon de commande\">" +
							"<span class=\"ui-icon ui-icon-document\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div>" +
						"Réservations : Du <span id=\"edt-marche-dateDebutReservation\">{dateDebutReservation}</span> à <span id=\"edt-marche-heureDebutReservation\">{heureDebutReservation}</span>H<span id=\"edt-marche-minuteDebutReservation\">{minuteDebutReservation}</span> au <span id=\"edt-marche-dateFinReservation\">{dateFinReservation}</span> à <span id=\"edt-marche-heureFinReservation\">{heureFinReservation}</span>H<span id=\"edt-marche-minuteFinReservation\">{minuteFinReservation}</span> <br/>" +
						"Marché : Le <span id=\"edt-marche-dateMarcheDebut\">{dateMarcheDebut}</span> de <span id=\"edt-marche-heureMarcheDebut\">{heureMarcheDebut}</span>H<span id=\"edt-marche-minuteMarcheDebut\">{minuteMarcheDebut}</span> à <span id=\"edt-marche-heureMarcheFin\">{heureMarcheFin}</span>H<span id=\"edt-marche-minuteMarcheFin\">{minuteMarcheFin}</span>" +
					"</div>" +
				"</div>" +
				"<div id=\"btn-ajout-produit-div\" class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
					"<button type=\"button\" id=\"btn-ajout-produit\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un produit</button>" +
				"</div>" +
				"<div id=\"liste-ferme\">" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeReservation = 
		"<div id=\"contenu\">" +
			"{editerMenu}" +
			"<div id=\"edt-com-liste\" >" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Gestion des réservations" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-resa\" title=\"Exporter les réservations\">" +
							"<span class=\"ui-icon ui-icon-print\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div id=\"edt-com-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">" +
		
							"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
									"<span class=\"ui-icon ui-icon-search\">" +
								"</span>" +
							"</span>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							
						"</form>" +
					"</div>" +
					"<table class=\"com-table\" id=\"edt-com-liste-resa\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th-debut com-underline-hover\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
							"<th class=\"com-table-th-med com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
							"<th class=\"com-table-th-med com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
							"<th class=\"com-table-th-med com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
							"<th class=\"com-table-th-fin\"></th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
						"<!-- BEGIN listeAdherent -->" +
						"<tr class=\"com-cursor-pointer edt-com-reservation-ligne\" id-adherent=\"{listeAdherent.adhId}\">" +							
							"<td class=\"com-table-td-debut com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeAdherent.adhIdTri}</span>" +
								"{listeAdherent.adhNumero}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.cptLabel}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhNom}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhPrenom}</td>" +
							"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								 "</span>" +
							"</td>" +
						"</tr>" +
						"<!-- END listeAdherent -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAchatEtReservation = 
		"<div id=\"contenu\">" +
			"{editerMenu}" +
			"<div id=\"edt-com-liste\" >" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Liste des Achats et Réservations" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-achat\" title=\"Exporter les Achats et les réservations\">" +
							"<span class=\"ui-icon ui-icon-print\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div id=\"edt-com-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">" +
		
							"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
									"<span class=\"ui-icon ui-icon-search\">" +
								"</span>" +
							"</span>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							
						"</form>" +
					"</div>" +
					"{achatInvite}" +
					"<table class=\"com-table\" id=\"edt-com-liste-resa\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th-debut com-underline-hover\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
							"<th class=\"com-table-th-med com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
							"<th class=\"com-table-th-med com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
							"<th class=\"com-table-th-med com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
							"<th colspan=\"2\" class=\"com-table-th-fin\"></span>Achat</th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
						"<!-- BEGIN listeAchatEtReservation -->" +
						"<tr class=\"com-cursor-pointer edt-com-achat-ligne\" id-adherent=\"{listeAchatEtReservation.adhId}\">" +							
							"<td class=\"com-table-td-debut com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeAchatEtReservation.adhIdTri}</span>" +
								"{listeAchatEtReservation.adhNumero}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAchatEtReservation.cptLabel}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAchatEtReservation.adhNom}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAchatEtReservation.adhPrenom}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">" +
								"<span class=\"{listeAchatEtReservation.achat} ui-state-hover com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
									"<span class=\"ui-icon ui-icon-circle-check\"></span>" +
								"</span>" +							
							"</td>" +
							"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
						"<!-- END listeAchatEtReservation -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAchatInvite =
		"<table class=\"com-table\">" +
			"<thead>" +
				"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\" id=\"entete-achat-invite\" >" +
					"<th colspan=\"4\" class=\"com-table-th com-underline-hover com-center\">" +
						"Compte invité" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all com-cursor-pointer\">" +
							"<span id=\"icon-achat-invite\" class=\"ui-icon ui-icon-triangle-1-s\">" +
						"</span>" +
					"</th>" +
				"</tr>" +
				"<tr class=\"ui-widget ui-widget-header com-cursor-pointer ui-helper-hidden detail-achat-invite\">" +
					"<th class=\"com-table-th-debut\"></span>Achat</th>" +
					"<th class=\"com-table-th-med\"></span>Achat Solidaire</th>" +
					"<th colspan=\"2\" class=\"com-table-th-fin\"></span>Montant</th>" +
				"</tr>" +
				"<tbody class=\"ui-helper-hidden detail-achat-invite\">" +
					"<!-- BEGIN listeAchatInvite -->" +
					"<tr class=\"com-cursor-pointer edt-com-achat-ligne-invite\" data-id-operation=\"{listeAchatInvite.id}\">" +							
						"<td class=\"com-table-td-debut\">" +
							"<span class=\"{listeAchatInvite.achat} com-flag ui-state-hover com-cursor-pointer ui-widget-content ui-corner-all\">" +
								"<span class=\"ui-icon ui-icon-circle-check\"></span>" +
							"</span>" +							
						"</td>" +
						"<td class=\"com-table-td-med\">" +
							"<span class=\"{listeAchatInvite.achatSolidaire} com-flag ui-state-hover com-cursor-pointer ui-widget-content ui-corner-all\">" +
								"<span class=\"ui-icon ui-icon-circle-check\"></span>" +
							"</span>" +							
						"</td>" +
						"<td class=\"com-table-td-med\">{listeAchatInvite.montant} {sigleMonetaire}</td>" +
						"<td class=\"com-table-td-fin td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
								"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"<!-- END listeAchatInvite -->" +
				"</tbody>" +
			"</thead>" +
		"</table>";
	
	this.listeAchatEtReservationVide = 
		"<div id=\"contenu\">" +
			"{editerMenu}" +
			"<div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Liste des Achats et Réservations" +
					"</div>" +
					"<p id=\"texte-liste-vide\">Aucun adhérent sur ce marché.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.dateAchat = "Achat du {dateAchat} :";
	
	this.boutonSupprimerAchat = 
		"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all btn-achat\" id=\"btn-supp-achat\" title=\"Supprimer\" data-id-achat=\"{idAchat}\">" +
			"<span class=\"ui-icon ui-icon-trash\"></span>" +
		"</span>";
	
	this.boutonSupprimerAchatSolidaire = 
		"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all btn-achat-solidaire\" id=\"btn-supp-achat-solidaire\" title=\"Supprimer\" data-id-achat=\"{idAchat}\">" +
			"<span class=\"ui-icon ui-icon-trash\"></span>" +
		"</span>";
	
	this.detailAchatEtReservationEnteteInvite =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-annuler\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour à la liste des achats" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Compte Invité" +
				"</div>" +
			"</div>" +
			"{detailAchat}" +
		"</div>";
		
	this.detailAchatEtReservationEntete = 
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-annuler\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour à la liste des achats" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Adhérent" +
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<div id=\"resa-info-commande\">" +
						"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
						"N° de Compte : {adhCompte}" +
					"</div>" +
					"<div>" +
						"<span>Solde : </span><span>{adhSolde} {sigleMonetaire}</span>" +
					"</div>" +
					"<div class=\"com-clear-float-left\"></div>" +
				"</div>" +
			"</div>" +
			"{detailAchat}" +
		"</div>";
	
	this.detailAchatVide =
		"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +			
			"<button type=\"button\" id=\"btn-nv-produit\" class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\">Ajouter un produit</button>" +
		"</div>";
	
	this.detailAchatEtReservation =		
		"<div class=\"achat com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"{dateAchat} {totalMarche} {sigleMonetaire}" +
					"<span id=\"btn-nv-produit\" class=\"com-cursor-pointer com-btn-header-text ui-widget-content ui-corner-all\" title=\"Ajouter un produit\">" +
						"<span class=\"com-float-left ui-icon ui-icon-plusthick\"></span>Ajouter un produit" +
					"</span>" +
			"</div>" +
			"<table class=\"com-table-100\">" +
				"<tr>" +
					"<td></td>" +
					"<td colspan=\"2\" class=\"col-reservation\"><div class=\"ui-widget-header ui-corner-all com-center\">Réservation</div></td>" +
					"<td colspan=\"3\" class=\"col-achat\">" +
						"<div class=\"ui-widget-header ui-corner-all com-center\">" +
							"Achat" +
							"{boutonSupprimerAchat}" +								
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all btn-achat\" id=\"btn-modif-achat\" title=\"Modifier\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +	
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden btn-achat\" id=\"btn-annuler-achat\" title=\"Annuler\">" +
								"<span class=\"ui-icon ui-icon-closethick\"></span>" +
							"</span>" +
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden btn-achat\" id=\"btn-check-achat\" title=\"Valider\" data-id-achat=\"{idAchat}\" data-type=\"\">" +
								"<span class=\"ui-icon ui-icon-check\"></span>" +
							"</span>" +
						"</div>" +
					"</td>" +
					"<td colspan=\"3\" class=\"col-achat-solidaire\">" +
						"<div class=\"ui-widget-header ui-corner-all com-center\">" +
							"Achat Solidaire" +
							"{boutonSupprimerAchatSolidaire}" +								
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all btn-achat-solidaire\" id=\"btn-modif-achat-solidaire\" title=\"Modifier\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +	
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden btn-achat-solidaire\" id=\"btn-annuler-achat-solidaire\" title=\"Annuler\">" +
								"<span class=\"ui-icon ui-icon-closethick\"></span>" +
							"</span>" +
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden btn-achat-solidaire\" id=\"btn-check-achat-solidaire\" title=\"Valider\" data-id-achat=\"{idAchatSolidaire}\" data-type=\"solidaire\">" +
								"<span class=\"ui-icon ui-icon-check\"></span>" +
							"</span>" +
						"</div>" +
					"</td>" +
				"</tr>" +
			"<!-- BEGIN categories -->" +
				"<tr>" +
					"<td><div class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</div></td>" +
					"<td colspan=\"2\" class=\"col-reservation\"></td>" +
					"<td colspan=\"3\" class=\"col-achat\"></td>" +
					"<td colspan=\"3\" class=\"col-achat-solidaire\"></td>" +
				"</tr>" +
				"<!-- BEGIN categories.achat -->" +
				"<tr class=\"com-ligne-hover ligne-produit-achat\" data-id-produit=\"{categories.achat.proId}\">" +
					"<td>{categories.achat.nproNom}</td>" +						

					"<td class=\"col-reservation com-text-align-right detail-achat-unite\">{categories.achat.stoQuantiteReservation}</td>" +						
					"<td class=\"col-reservation detail-achat-unite\">{categories.achat.proUniteMesureReservation}</td>" +
					
					"<td class=\"com-text-align-right detail-achat-unite col-achat\">" +
						"<span class=\"detail-achat-qte\">{categories.achat.stoQuantiteAffiche}</span>" +
						"<span class=\"detail-achat-qte ui-helper-hidden \">" +
							"<input type=\"text\" value=\"{categories.achat.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"achat-{idAchat}-produits{categories.achat.proId}quantite\" maxlength=\"12\" size=\"3\"/>" +
						"</span>" +
					"</td>" +
					
					"<td class=\"detail-achat-unite detail-achat-unite col-achat\">" +
						"<span class=\"detail-achat-qte\">{categories.achat.proUniteMesure}</span>" +
						"<span class=\"detail-achat-qte ui-helper-hidden\">{categories.achat.unite}</span>" +
					"</td>" +
					"<td class=\"com-text-align-right detail-achat-unite col-achat\">" +
						"<span class=\"detail-achat-prix\">" +
							"{categories.achat.prixAffiche} {categories.achat.sigleMonetaire}" +
						"</span>" +
						"<span class=\"detail-achat-prix ui-helper-hidden\">" +
							"<input type=\"text\" value=\"{categories.achat.prix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"achat-{idAchat}-produits{categories.achat.proId}prix\" maxlength=\"12\" size=\"3\"/>" +
							" {sigleMonetaire}" +
						"</span>" +
					"</td>" +
					"<td class=\"com-text-align-right detail-achat-unite col-achat-solidaire\">" +
						"<span class=\"detail-achat-qte-solidaire\">{categories.achat.stoQuantiteSolidaireAffiche}</span>" +
						"<span class=\"detail-achat-qte-solidaire ui-helper-hidden \">" +
							"<input type=\"text\" value=\"{categories.achat.stoQuantiteSolidaire}\" class=\"com-numeric produit-quantite-solidaire com-input-text ui-widget-content ui-corner-all\" id=\"achat-{idAchatSolidaire}-produits{categories.achat.proId}quantite\" maxlength=\"12\" size=\"3\"/>" +
						"</span>" +
					"</td>" +			
					"<td class=\"detail-achat-unite col-achat-solidaire\">" +
						"<span class=\"detail-achat-qte-solidaire\">{categories.achat.proUniteMesureSolidaire}</span>" +
						"<span class=\"detail-achat-qte-solidaire ui-helper-hidden\">{categories.achat.unite}</span>" +
					"</td>" +
					"<td class=\"com-text-align-right detail-achat-unite col-achat-solidaire\">" +
						"<span class=\"detail-achat-prix-solidaire\">" +
							"{categories.achat.prixSolidaireAffiche} {categories.achat.sigleMonetaireSolidaire}" +
						"</span>" +
						"<span class=\"detail-achat-prix-solidaire ui-helper-hidden\">" +
							"<input type=\"text\" value=\"{categories.achat.prixSolidaire}\" class=\"com-numeric produit-prix-solidaire com-input-text ui-widget-content ui-corner-all\" id=\"achat-{idAchatSolidaire}-produits{categories.achat.proId}prix\" maxlength=\"12\" size=\"3\"/>" +
							" {sigleMonetaire}" +
						"</span>" +
					"</td>" +		
				"</tr>" +
				"<!-- END categories.achat -->" +
			"<!-- END categories -->" +
				"<tr>" +
					"<td></td>" +
					"<td colspan=\"2\" class=\"col-reservation\"></td>" +
					"<td class=\"com-text-align-right col-achat\" colspan=\"2\">Total : </td>" +
					"<td class=\"com-text-align-right col-achat\">{total} {sigleMonetaire}</td>" +						
					"<td class=\"com-text-align-right col-achat-solidaire\" colspan=\"2\">Total Solidaire : </td>" +
					"<td class=\"com-text-align-right col-achat-solidaire\">{totalSolidaire} {sigleMonetaire}</td>" +
				"</tr>" +
			"</table>" +
		"</div>" ;

	this.supprimerReservationDialog =
		"<div id=\"dialog-supprimer-reservation\" title=\"Supprimer la réservation\">" +
			"<p>Voulez-vous supprimer la réservation ?</p>" +
		"</div>";	
	
	this.dialogSupprimerAchat =
		"<div title=\"Supprimer la réservation\">" +
			"<p>Voulez-vous supprimer cet achat ?</p>" +
		"</div>";
	
	this.detailReservation = 
		"<div id=\"contenu\">" +	
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-annuler\">" +
				"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
				"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
				"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Adhérent</div>" +
				"<div class=\"com-widget-content\">" +
					"<div id=\"resa-info-commande\">" +
						"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
						"N° de Compte : {adhCompte}" +
					"</div>" +
					"<div>" +
						"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span>" +
					"</div>" +
					"<div class=\"com-clear-float-left\"></div>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"La réservation" +
				"</div>" +
				"<table>" +
				
					"<!-- BEGIN categories -->" +
					"<td class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
					"<td colspan=\"6\"></td>" +
					
					"<!-- BEGIN categories.produits -->" +
					"<tr >" +
						/*"<td class=\"detail-resa-npro\">{categories.produits.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{categories.produits.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{categories.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{categories.produits.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +*/
						
						"<td class=\"detail-resa-npro\">{categories.produits.nproNom}</td>" +
						"<td class=\"td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-info-produit\" title=\"Information sur le produit\" id-produit=\"{categories.produits.proId}\">" +
								"<span class=\"ui-icon ui-icon-info\">" +
								"</span>" +
							"</span>" +
						"</td>" +
						"<td>{categories.produits.flagType}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{categories.produits.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{categories.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{categories.produits.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
						
					"</tr>" +
					"<!-- END categories.produits -->" +
					"<!-- END categories -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"5\">Total : </td>" +
						"<td class=\"com-text-align-right\">{total}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<div class=\"boutons-edition com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-modifier\">Modifier</button>" +	
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-supprimer\">Supprimer</button>" +
			"</div>" +
		"</div>";
	
	this.modifierReservation =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Adhérent</div>" +
				"<div class=\"com-widget-content\">" +
					"<div id=\"resa-info-commande\">" +
						"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
						"N° de Compte : {adhCompte}" +
					"</div>" +
					"<div>" +
						"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span><br/>" +
						"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
					"</div>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"La réservation" +
				"</div>" +
				"<div>" +
					"<table>" +
						"<!-- BEGIN categories -->" +
						"<tr>" +
							"<td colspan=\"4\" class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
							"<td colspan=\"7\"></td>" +
						"</tr>" +						
						"<!-- BEGIN categories.produits -->" +
						"{categories.produits.detailProduit}" +
						"<!-- END categories.produits -->" +
						"<!-- END categories -->" +
						"<tr>" +
							"<td colspan=\"10\" class=\"com-text-align-right\">Total : </td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"total\">{total}</span> {sigleMonetaire}</td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"boutons-edition-modification com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-annuler\">Annuler</button>" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-valider\">Valider</button>" +		
			"</div>" +
		"</div>";
	
	this.formReservationProduit =
		"<tr class=\"pdt\">" +
			"<td><input type=\"checkbox\" {checked}/></td>" +
			"<td><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{proId}</span></span></td>" +
			"<td id=\"commandes{proId}stoQuantite\" >{nproNom}</td>" +
			"<td class=\"td-edt\">" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-info-produit\" title=\"Information sur le produit\" id-produit=\"{proId}\">" +
					"<span class=\"ui-icon ui-icon-info\">" +
					"</span>" +
				"</span>" +
			"</td>" +
			"<td>" +
				"<select id=\"lot-{proId}\">" +
					"<!-- BEGIN lot -->" +
					"<option value=\"{lot.dcomId}\">par {lot.dcomTaille} {proUniteMesure}</option>" +
					"<!-- END lot -->" +
				"</select>" +
			"</td>" +
			"<td>à <span id=\"prix-unitaire-{proId}\">{prixUnitaire}</span> {sigleMonetaire}/{proUniteMesure}</td>" +
			"<td>{flagType}</td>" +
			"<td class=\"ui-helper-hidden resa-pdt-{proId}\"><button class=\"btn-moins\">-</button></td>" +
			"<td class=\"ui-helper-hidden resa-pdt-{proId}\"><span id=\"qte-pdt-{proId}\"></span> {proUniteMesure}</td>" +
			"<td class=\"ui-helper-hidden resa-pdt-{proId}\"><button class=\"btn-plus\">+</button></td>" +
			"<td class=\"ui-helper-hidden resa-pdt-{proId} com-text-align-right\"><span id=\"prix-pdt-{proId}\"></span> {sigleMonetaire}</td>" +
		"</tr>";

	this.formReservationProduitInfo =
		"<tr class=\"pdt\">" +
			"<td></td>" +
			"<td><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{proId}</span></span></td>" +
			"<td id=\"commandes{proId}stoQuantite\" >{nproNom}</td>" +
			"<td class=\"td-edt\">" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-info-produit\" title=\"Information sur le produit\" id-produit=\"{proId}\">" +
					"<span class=\"ui-icon ui-icon-info\">" +
					"</span>" +
				"</span>" +
			"</td>" +
			"<td>" +
				"<select id=\"lot-{proId}\">" +
					"<!-- BEGIN lot -->" +
					"<option value=\"{lot.dcomId}\">par {lot.dcomTaille} {proUniteMesure}</option>" +
					"<!-- END lot -->" +
				"</select>" +
			"</td>" +
			"<td>à <span id=\"prix-unitaire-{proId}\">{prixUnitaire}</span> {sigleMonetaire}/{proUniteMesure}</td>" +
			"<td>{flagType}</td>" +
			"<td></td>" +
			"<td></td>" +
			"<td></td>" +
			"<td></td>" +
		"</tr>";
	
	this.formReservationProduitAbonnementInfo =
		"<tr class=\"pdt\">" +
			"<td></td>" +
			"<td><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{proId}</span></span></td>" +
			"<td id=\"commandes{proId}stoQuantite\" >{nproNom}</td>" +
			"<td class=\"td-edt\">" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-info-produit\" title=\"Information sur le produit\" id-produit=\"{proId}\">" +
					"<span class=\"ui-icon ui-icon-info\">" +
					"</span>" +
				"</span>" +
			"</td>" +
			"<td>" +
				"<select id=\"lot-{proId}\">" +
					"<!-- BEGIN lot -->" +
					"<option value=\"{lot.dcomId}\">par {lot.dcomTaille} {proUniteMesure}</option>" +
					"<!-- END lot -->" +
				"</select>" +
			"</td>" +
			"<td>à <span id=\"prix-unitaire-{proId}\">{prixUnitaire}</span> {sigleMonetaire}/{proUniteMesure}</td>" +
			"<td>{flagType}</td>" +
			"<td></td>" +
			"<td>{stoQuantiteReservation} {proUniteMesure}</td>" +
			"<td></td>" +
			"<td class=\"com-text-align-right\">{prixReservation} {sigleMonetaire}</td>" +
		"</tr>";
	
	this.listeCommandeVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-archive\">" +
					"<span class=\"com-float-left\">Les Marchés cloturés</span>" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-e\"></span>" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours" +
				"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-nv-marche\" title=\"Ajouter un marché\">" +
					"<span class=\"ui-icon ui-icon-plusthick\">" +
					"</span>" +
				"</span>" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeCommandeArchiveVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-encours\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Les Marchés en cours" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cloturés</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché cloturé.</p>" +	
			"</div>" +
		"</div>";
	
	/*this.listeMarcheVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente</div>" +
				"<p id=\"texte-liste-vide\">Aucune adhérent.</p>" +	
			"</div>" +
		"</div>";*/
	
	this.listeReservationVide =
		"<div id=\"contenu\">" +
			"{editerMenu}" +
			"<div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Gestion des réservations" +
					"</div>" +
					"<p id=\"texte-liste-vide\">Aucune réservation.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.dialogEnregistrement =
		"<div title=\"Enregistrer les modifications\">" +
			"<p>Vous n'avez pas enregistré vos modifications.</p>" +
		"</div>";
	
	this.dialogExportBonDeCommande = 
		"<div id=\"dialog-export-bon-commande\" title=\"Export du Bon de Commande du Marché n°{comNumero}\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Format de sortie : </td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.bonDeCommande =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-editer-com\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Bon de commande du Marché n°{comNumero}" +
					"<span class=\"ui-helper-hidden com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-bcom\" title=\"Exporter le bon de commande\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
					"</span>" +
				"</span>" +
				"</div>" +
				"<div>" +
					"<form>" +
						"<span>Producteur : " +
							"<select id=\"select-prdt\">" +
								"<option value=\"0\" >== Choisir une ferme ==</option>" +
								"<!-- BEGIN producteurs -->" +
								"<option value=\"{producteurs.proIdCompteFerme}\">{producteurs.ferNom}</option>" +
								"<!-- END producteurs -->" +
							"</select>" +
						"</span>" +
					"</form>" +
				"</div>" +
				"<div id=\"liste-pdt\"></div>" +	
			"</div>" +
		"</div>";
	
	this.listeProduitVide =
		"<div id=\"liste-pdt\"></div>";
	
	this.listeProduitBonDeCommande = 
		"<div id=\"liste-pdt\">" +
			"<table class=\"com-table-100\">" +
				"<thead>" +
					"<tr>" +
						"<th>Ref</th>" +
						"<th>Produit</th>" +
						"<th colspan=\"2\" class=\"com-center\">Réservation</th>" +
						"<th colspan=\"2\" class=\"com-center\">Commande</th>" +
						"<th colspan=\"2\" class=\"com-center\">Prix</th>" +
						"<th>État</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
					"<!-- BEGIN produits -->" +
					"<tr>" +
						"<td>{produits.nproNumero}</td>" +
						"<td>{produits.nproNom}</td>" +
						"<td class=\"com-text-align-right\">{produits.stoQuantite}</td>" +
						"<td>" +
							" {produits.proUniteMesure}" +
						"</td>" +
						"<td class=\"com-text-align-right\">" +
							//"<span class=\"pro-id ui-helper-hidden\"  data-id-produit=\"{produits.proId}\" data-id-detail-commande=\"{produits.dcomId}\"></span>" +
							"<input class=\"formulaire qte-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" size=\"3\" name=\"qte-commande-{produits.proId}-{produits.dcomId}\" maxlength=\"11\" value=\"{produits.stoQuantiteCommande}\" id=\"produits{produits.dcomId}quantite\" data-taille=\"{produits.dcomTaille}\" data-prix=\"{produits.dcomPrix}\" data-id-produit=\"{produits.proId}\" data-id-detail-commande=\"{produits.dcomId}\" />" +
							"<span class=\"detail\">{produits.stoQuantiteCommandeAffichage}</span>" +
						"</td>" +
						"<td>" +
							" {produits.proUniteMesure}" +
						"</td>" +
						"<td class=\"com-text-align-right\">" +
							"<input class=\"formulaire prix-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" size=\"3\" name=\"prix-commande-{produits.proId}-{produits.dcomId}\" maxlength=\"11\" value=\"{produits.dopeMontant}\" id=\"produits{produits.dcomId}prix\" />" +
							"<span class=\"detail\">{produits.dopeMontantAffichage}</span>" +
						"</td>" +
						"<td>" +
							" {sigleMonetaire}" +
						"</td>" +
						"<td>" +
							"<div id=\"etat-commande-{produits.dcomId}\" class=\"{produits.classEtat} ui-corner-all\"></div>" +
						"</td>" +
					"</tr>" +
					"<!-- END produits -->" +
				"</tbody>" +
			"</table>" +
			"<div class=\"com-center\">" +
				"<button class=\"ui-helper-hidden com-btn-edt-multiples ui-state-default ui-corner-all com-button\" id=\"btn-annuler\">Annuler</button>" +
				"<button class=\"formulaire ui-state-default ui-corner-all com-button\" id=\"btn-enregistrer\">Enregistrer</button>" +
				"<button class=\"detail ui-state-default ui-corner-all com-button\" id=\"btn-modifier\">Modifier</button>" +
			"</div>" +
		"</div>";
	
	this.dialogExportBonDeLivraison =
		"<div id=\"dialog-export-livraison\" title=\"Export du bon de livraison du Marché n°{comNumero}\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Format de sortie : </td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.bonDeLivraison =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-editer-com\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Bon de Livraison du Marché n°{comNumero}" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-bcom\" title=\"Exporter le bon de livraison\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
					"</span>" +
				"</span>" +
				"</div>" +
				"<div>" +
					"<form>" +
						"<span>Producteur : " +
							"<select id=\"select-prdt\">" +
								"<option value=\"0\" >== Choisir une ferme ==</option>" +
								"<!-- BEGIN producteurs -->" +
								"<option value=\"{producteurs.proIdCompteFerme}\">{producteurs.ferNom}</option>" +
								"<!-- END producteurs -->" +
							"</select>" +
						"</span>" +
					"</form>" +
				"</div>" +
				"<div id=\"liste-pdt\"></div>" +	
			"</div>" +
		"</div>";
	
	this.listeProduitLivraison = 
		"<div id=\"liste-pdt\">" +
			"<table class=\"com-table-100\">" +
				"<thead>" +
					"<tr>" +
						"<th>Ref</th>" +
						"<th>Produit</th>" +
						"<th colspan=\"2\" class=\"com-center\">Réservation</th>" +
						"<th colspan=\"2\" class=\"com-center\">Commande</th>" +
						"<th colspan=\"2\" class=\"com-center\">Prix</th>" +
						"<th colspan=\"2\" class=\"com-center\">Livraison</th>" +
						"<th colspan=\"2\" class=\"com-center\">Prix</th>" +
						"<th colspan=\"2\" class=\"com-center\">Solidaire</th>" +
						"<th>État</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
					"<!-- BEGIN produits -->" +
					"<tr>" +
						"<td>{produits.nproNumero}</td>" +
						"<td>{produits.nproNom}</td>" +
						"<td class=\"com-text-align-right\">{produits.stoQuantite}</td>" +
						"<td> {produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right\">{produits.stoQuantiteCommande}</td>" +
						"<td> {produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right\">{produits.opeMontantCommande}</td>" +
						"<td> {sigleMonetaire}</td>" +
						"<td class=\"com-text-align-right\">" +
							"<span class=\"pro-id pro-id-etat ui-helper-hidden\">{produits.proId}</span>" +
							"<input class=\"{produits.masquerNormal} formulaire input-bon-livraison qte-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qte-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.stoQuantiteLivraison}\" id=\"produits{produits.proId}quantite\"/>" +
							"<span class=\"detail {produits.masquerNormal}\">{produits.stoQuantiteLivraison}</span>" +
						"</td>" +
						"<td> <span class=\"{produits.masquerNormal}\">{produits.proUniteMesure}</span></td>" +
						"<td class=\"com-text-align-right\">" +
							"<input class=\"{produits.masquerNormal} formulaire input-bon-livraison prix-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.opeMontantLivraison}\" id=\"produits{produits.proId}prix\" />" +
							"<span class=\"detail {produits.masquerNormal}\">{produits.opeMontantLivraison}</span>" +
						"</td>" +
						"<td> <span class=\"{produits.masquerNormal}\">{sigleMonetaire}</span></td>" +
						"<td><span class=\"pro-id-etat ui-helper-hidden\">{produits.proId}</span><input " +
							"class=\"formulaire qte-solidaire-commande input-bon-livraison com-numeric com-input-text ui-widget-content ui-corner-all\" " +
							"type=\"text\" " +
							"name=\"qte-solidaire-commande-{produits.proId}\" " +
							"maxlength=\"11\" " +
							"value=\"{produits.stoQuantiteSolidaire}\" " +
							"id=\"produits{produits.proId}quantiteSolidaire\" />" +
							"<span class=\"detail\">{produits.stoQuantiteSolidaire}</span>" +
						"</td>" +
						"<td> {produits.proUniteMesure}</td>" +
						"<td><div id=\"etat-commande-{produits.proId}\" class=\"{produits.classEtat} ui-corner-all\"></div></td>" +
					"</tr>" +
					"<!-- END produits -->" +
				"</tbody>" +
				"<tfoot>" +
					"<tr>" +
						"<td colspan=\"4\"></td>" +
						"<td colspan=\"2\">Total :</td>" +
						"<td>{totalCommande}</td>" +
						"<td> {sigleMonetaire}</td>" +
						"<td></td>" +
						"<td></td>" +
						"<td>" +
							"<input class=\"formulaire input-bon-livraison com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"total\" maxlength=\"11\" value=\"{total}\" id=\"total\" />" +
							"<span class=\"detail\">{total}</span>" +
						"</td>" +
						"<td> {sigleMonetaire}</td>" +
						"<td colspan=\"3\">" +
							"<select class=\"formulaire\" name=\"typepaiement\" id=\"typePaiement\">" +
								"<option value=\"0\">== Choisir le paiement ==</option>" +
								"<!-- BEGIN typePaiement -->" +
								"<option value=\"{typePaiement.tppId}\">{typePaiement.tppType}</option>" +
								"<!-- END typePaiement -->" +
							"</select>" +
							"<span class=\"detail\">{tppType}</span>" +
						"</td>" +
					"</tr>" +
					"<tr id=\"tr-champ-complementaire\">" +
						"<td colspan=\"10\"></td>" +
						"<td colspan=\"2\"><span id=\"label-champ-complementaire\" ></span></td>" +
						"<td colspan=\"3\">" +
							"<input type=\"text\" name=\"champ-complementaire\" value=\"{champComplementaire}\" class=\"formulaire com-input-text ui-widget-content ui-corner-all\" id=\"typePaiementChampComplementaire\" maxlength=\"50\" size=\"15\"/>" +
							"<span class=\"detail\">{champComplementaire}</span>" +
						"</td>" +
					"</tr>" +
				"</tfoot>" +
			"</table>" +
			"<div class=\"com-center\">" +
				"<button class=\"ui-helper-hidden com-btn-edt-multiples ui-state-default ui-corner-all com-button\" id=\"btn-annuler\">Annuler</button>" +
				"<button class=\"formulaire ui-state-default ui-corner-all com-button\" id=\"btn-enregistrer\">Enregistrer</button>" +
				"<button class=\"detail ui-state-default ui-corner-all com-button\" id=\"btn-modifier\">Modifier</button>" +
			"</div>" +
		"</div>";
	
	this.infoCommandeArchive =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Détail du Marché n°{numero}" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-dupliquer-com\" title=\"Dupliquer le marché\">" +
						"<span class=\"ui-icon ui-icon-copy\">" +
						"</span>" +
					"</span>" +
				"</div>" +
				"<div>" +
					"<div class=\"com-center\" id=\"resultat-marche-archive\">" +
						"<span class=\"ui-widget ui-widget-header com-table-th\">Résultat Zeybu Marché : {total} {sigleMonetaire}</span>    " +
						"<span class=\"ui-widget ui-widget-header com-table-th\">Résultat Zeybu Solidaire : {totalSolidaire} {sigleMonetaire}</span>" +
					"</div>" +
					"<table class=\"com-table\" id=\"info-marche-archive\">" +
						"<thead>" +
							"<tr>" +
								"<th></th>" +
								"<th class=\"com-table-th ui-widget ui-widget-header\" colspan=\"5\">Achat</th>" +
								"<th class=\"com-table-th ui-widget ui-widget-header\" colspan=\"4\">Vente</th>" +
							"</tr>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Produit</th>" +
								"<th class=\"com-table-th\">Qté Commande</th>" +
								"<th class=\"com-table-th\">Prix Commande</th>" +
								"<th class=\"com-table-th\">Qté Livraison</th>" +
								"<th class=\"com-table-th\">Prix Livraison</th>" +
								"<th class=\"com-table-th\">Qté Solidaire</th>" +
								"<th class=\"com-table-th\">Qté Vente</th>" +
								"<th class=\"com-table-th\">Prix Vente</th>" +
								"<th class=\"com-table-th\">Qté Solidaire</th>" +
								"<th class=\"com-table-th\">Prix Solidaire</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN infoCommande -->" +
							"<tr>" +
								"<td class=\"com-table-td\">{infoCommande.nproNom}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantite} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontant} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteLivraison} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantLivraison} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteSolidaire} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteVente} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantVente} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteVenteSolidaire} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantVenteSolidaire} {sigleMonetaire}</td>" +
							"</tr>" +
							"<!-- END infoCommande -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	
	this.resumeMarche =
		"<div id=\"contenu\">" +
			"{editerMenu}" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Détail du Marché n°{numero}" +
				"</div>" +
				"<div>" +
					"<div class=\"com-center\" id=\"resultat-marche-archive\">" +
						"<span class=\"ui-widget ui-widget-header com-table-th\">Résultat Zeybu Marché : {total} {sigleMonetaire}</span>    " +
						"<span class=\"ui-widget ui-widget-header com-table-th\">Résultat Zeybu Solidaire : {totalSolidaire} {sigleMonetaire}</span>" +
					"</div>" +
					"<table class=\"com-table\" id=\"info-marche-archive\">" +
						"<thead>" +
							"<tr>" +
								"<th></th>" +
								"<th class=\"com-table-th ui-widget ui-widget-header\" colspan=\"5\">Achat</th>" +
								"<th class=\"com-table-th ui-widget ui-widget-header\" colspan=\"4\">Vente</th>" +
							"</tr>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Produit</th>" +
								"<th class=\"com-table-th\">Qté Commande</th>" +
								"<th class=\"com-table-th\">Prix Commande</th>" +
								"<th class=\"com-table-th\">Qté Livraison</th>" +
								"<th class=\"com-table-th\">Prix Livraison</th>" +
								"<th class=\"com-table-th\">Qté Solidaire</th>" +
								"<th class=\"com-table-th\">Qté Vente</th>" +
								"<th class=\"com-table-th\">Prix Vente</th>" +
								"<th class=\"com-table-th\">Qté Solidaire</th>" +
								"<th class=\"com-table-th\">Prix Solidaire</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN infoCommande -->" +
							"<tr>" +
								"<td class=\"com-table-td\">{infoCommande.nproNom}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantite} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontant} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteLivraison} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantLivraison} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteSolidaire} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteVente} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantVente} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteVenteSolidaire} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantVenteSolidaire} {sigleMonetaire}</td>" +
							"</tr>" +
							"<!-- END infoCommande -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	
	this.produitIndisponible = 
		"<tr><td colspan=\"11\">Le produit {nom} n'est plus disponible.</td></tr>";

	this.lotUnique = 
		"<input type=\"hidden\" id=\"lot-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.editerMarcheListeProduit = 
		"<div id=\"liste-ferme\">" +
			"<!-- BEGIN fermes -->" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ferme-{fermes.ferId}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">{fermes.ferNom}</div>" +
				"<!-- BEGIN fermes.categories -->" +
				"<table class=\"com-table-100\">" +
					"<tr class=\"ui-widget-header\" >" +
						"<td class=\"com-table-td-debut\">{fermes.categories.cproNom}</td>" +
						"<td class=\"com-table-td-med\"></td>" +
						"<td class=\"com-table-td-med\"></td>" +
						"<td class=\"com-table-td-med\"></td>" +
						"<td class=\"com-table-td-fin\"></td>" +
					"</tr>" +
					"<!-- BEGIN fermes.categories.produits -->" +
					"<tr>" +
						"<td class=\"com-table-td-debut\">{fermes.categories.produits.nproNom}</td>" +
						"<td class=\"com-table-td-med edt-marche-pro-unite\">{fermes.categories.produits.abonnement}</td>" +
						"<td class=\"com-table-td-med edt-marche-pro-unite\">{fermes.categories.produits.qteReservation} {fermes.categories.produits.nproUnite}</td>" +
						"<td class=\"com-table-td-med td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-produit\" title=\"Modifier\" id-produit=\"{fermes.categories.produits.id}\" typeProduit=\"{fermes.categories.produits.type}\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-produit\" title=\"Supprimer\" id-produit=\"{fermes.categories.produits.id}\" qte-reservation=\"{fermes.categories.produits.qteReservation}\" typeProduit=\"{fermes.categories.produits.type}\" >" +
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"<!-- END fermes.categories.produits -->" +
				"</table>" +
				"<!-- END fermes.categories -->" +
			"</div>"+
			"<!-- END fermes -->" +
		"</div>";
	"<!-- END fermes -->" +
"</div>";
	
	this.dialogModifierInfoMarche = 
		"<div id=\"dialog-modif-pro\" title=\"Produit\">" +
			"<div class=\"com-widget-content\">" +		
				"<form id=\"formulaire-information-creation-commande\">" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Nom du Marché : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"nom\" id=\"marche-nom\" maxlength=\"100\" value=\"{nom}\"/>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Début des Réservations * : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-debut-reservation\" id=\"marche-dateDebutReservation\" value=\"{dateDebutReservation}\"/>" +
							"</td>" +
							"<td class=\"com-table-form-td\">" +
								"à " +
								"<select name=\"heure-debut-reservation\" id=\"marche-timeDebutReservation\" class=\"informations-marche\" >" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"01\">01</option>" +
								    "<option value=\"02\">02</option>" +
								    "<option value=\"03\">03</option>" +
								    "<option value=\"04\">04</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"06\">06</option>" +
								    "<option value=\"07\">07</option>" +
								    "<option value=\"08\">08</option>" +
								    "<option value=\"09\">09</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"11\">11</option>" +
								    "<option value=\"12\">12</option>" +
								    "<option value=\"13\">13</option>" +
								    "<option value=\"14\">14</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"16\">16</option>" +
								    "<option value=\"17\">17</option>" +
								    "<option value=\"18\">18</option>" +
								    "<option value=\"19\">19</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"21\">21</option>" +
								    "<option value=\"22\">22</option>" +
								    "<option value=\"23\">23</option>" +
								"</select>" +
			   					"<select name=\"minute-debut-reservation\" class=\"informations-marche\">" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"25\">25</option>" +
								    "<option value=\"30\">30</option>" +
								    "<option value=\"35\">35</option>" +
								    "<option value=\"40\">40</option>" +
								    "<option value=\"45\">45</option>" +
								    "<option value=\"50\">50</option>" +
								    "<option value=\"55\">55</option>" +
								"</select>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Fin des Réservations * : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-fin-reservation\" id=\"marche-dateFinReservation\" value=\"{dateFinReservation}\"/>" +
							"</td>" +
							"<td class=\"com-table-form-td\">" +
								"à " +
								"<select name=\"heure-fin-reservation\" id=\"marche-timeFinReservation\" class=\"informations-marche\" >" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"01\">01</option>" +
								    "<option value=\"02\">02</option>" +
								    "<option value=\"03\">03</option>" +
								    "<option value=\"04\">04</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"06\">06</option>" +
								    "<option value=\"07\">07</option>" +
								    "<option value=\"08\">08</option>" +
								    "<option value=\"09\">09</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"11\">11</option>" +
								    "<option value=\"12\">12</option>" +
								    "<option value=\"13\">13</option>" +
								    "<option value=\"14\">14</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"16\">16</option>" +
								    "<option value=\"17\">17</option>" +
								    "<option value=\"18\">18</option>" +
								    "<option value=\"19\">19</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"21\">21</option>" +
								    "<option value=\"22\">22</option>" +
								    "<option value=\"23\">23</option>" +
								"</select>" +
			   					"<select name=\"minute-fin-reservation\" class=\"informations-marche\">" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"25\">25</option>" +
								    "<option value=\"30\">30</option>" +
								    "<option value=\"35\">35</option>" +
								    "<option value=\"40\">40</option>" +
								    "<option value=\"45\">45</option>" +
								    "<option value=\"50\">50</option>" +
								    "<option value=\"55\">55</option>" +
								"</select>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Jour du marché * : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-debut\" id=\"marche-dateMarcheDebut\" value=\"{dateMarcheDebut}\"/>" +
							"</td>" +
							"<td class=\"com-table-form-td\">" +
								"de " +
								"<select name=\"heure-debut\" id=\"marche-timeMarcheDebut\" class=\"informations-marche\">" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"01\">01</option>" +
								    "<option value=\"02\">02</option>" +
								    "<option value=\"03\">03</option>" +
								    "<option value=\"04\">04</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"06\">06</option>" +
								    "<option value=\"07\">07</option>" +
								    "<option value=\"08\">08</option>" +
								    "<option value=\"09\">09</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"11\">11</option>" +
								    "<option value=\"12\">12</option>" +
								    "<option value=\"13\">13</option>" +
								    "<option value=\"14\">14</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"16\">16</option>" +
								    "<option value=\"17\">17</option>" +
								    "<option value=\"18\">18</option>" +
								    "<option value=\"19\">19</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"21\">21</option>" +
								    "<option value=\"22\">22</option>" +
								    "<option value=\"23\">23</option>" +
								"</select>" +
			   					"<select name=\"minute-debut\" class=\"informations-marche\">" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"25\">25</option>" +
								    "<option value=\"30\">30</option>" +
								    "<option value=\"35\">35</option>" +
								    "<option value=\"40\">40</option>" +
								    "<option value=\"45\">45</option>" +
								    "<option value=\"50\">50</option>" +
								    "<option value=\"55\">55</option>" +
								  "</select>" +
								"</td>" +
								"<td class=\"com-table-form-td\">" +
									"à " +
									"<select name=\"heure-fin\" id=\"marche-timeMarcheFin\" class=\"informations-marche\">" +
										"<option value=\"00\">00</option>" +
									    "<option value=\"01\">01</option>" +
									    "<option value=\"02\">02</option>" +
									    "<option value=\"03\">03</option>" +
									    "<option value=\"04\">04</option>" +
									    "<option value=\"05\">05</option>" +
									    "<option value=\"06\">06</option>" +
									    "<option value=\"07\">07</option>" +
									    "<option value=\"08\">08</option>" +
									    "<option value=\"09\">09</option>" +
									    "<option value=\"10\">10</option>" +
									    "<option value=\"11\">11</option>" +
									    "<option value=\"12\">12</option>" +
									    "<option value=\"13\">13</option>" +
									    "<option value=\"14\">14</option>" +
									    "<option value=\"15\">15</option>" +
									    "<option value=\"16\">16</option>" +
									    "<option value=\"17\">17</option>" +
									    "<option value=\"18\">18</option>" +
									    "<option value=\"19\">19</option>" +
									    "<option value=\"20\">20</option>" +
									    "<option value=\"21\">21</option>" +
									    "<option value=\"22\">22</option>" +
									    "<option value=\"23\">23</option>" +
								    "</select>" +
			   						"<select name=\"minute-fin\" class=\"informations-marche\">" +
										"<option value=\"00\">00</option>" +
									    "<option value=\"05\">05</option>" +
									    "<option value=\"10\">10</option>" +
									    "<option value=\"15\">15</option>" +
									    "<option value=\"20\">20</option>" +
									    "<option value=\"25\">25</option>" +
									    "<option value=\"30\">30</option>" +
									    "<option value=\"35\">35</option>" +
									    "<option value=\"40\">40</option>" +
									    "<option value=\"45\">45</option>" +
									    "<option value=\"50\">50</option>" +
									    "<option value=\"55\">55</option>" +
								  "</select>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Description : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<textarea class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" name=\"description\" id=\"marche-description\" >{comDescription}</textarea>" +
							"</td>" +
						"</tr>" +
					"</table>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.dialogSupprimerProduit =
		"<div id=\"dialog-supprimer-produit\" title=\"Supprimer le produit du marché\">" +
			"<p>Des réservations sont présentes sur ce produit.<br/>Voulez-vous toujours le supprimer ?</p>" +
		"</div>";	
	
	this.dialogInfoProduit = 
		"<div id=\"dialog-info-pro\" title=\"Produit\">" +
			"<div id=\"information-detail-producteur\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations</div>" +
				"<div class=\"com-widget-content\">" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Nom : </th>" +
							"<td class=\"com-table-form-td\">{nom}</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Catégorie : </th>" +
							"<td class=\"com-table-form-td\">{cproNom}</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Description : </th>" +
							"<td class=\"com-table-form-td\">{description}</td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			
			"<div id=\"pro-prdt\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Producteurs</div>" +
				"<table class=\"com-table-form\">" +
					"<!-- BEGIN producteurs -->" +
					"<tr>" +
						"<td class=\"com-table-form-td\">" +
							"{producteurs.prdtPrenom} {producteurs.prdtNom}" +
						"</td>" +
					"</tr>" +
					"<!-- END producteurs -->" +
				"</table>" +
			"</div>" +
			
			"<div id=\"pro-car\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Caractéristiques</div>" +
				"<table class=\"com-table-form\">" +
					"<!-- BEGIN caracteristiques -->" +
					"<tr>" +
						"<td class=\"com-table-form-td\">" +
							"{caracteristiques.carNom}" +
						"</td>" +
					"</tr>" +
					"<!-- END caracteristiques -->" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeFerme = 
		"<div id=\"contenu\">" +	
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Fermes" +
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
							"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
							"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
							"<th class=\"com-table-th-fin liste-adh-th-solde\"></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN listeFerme -->" +
						"<tr class=\"com-cursor-pointer compte-ligne\" data-id-compte-ferme=\"{listeFerme.ferIdCompte}\">" +
							"<td class=\"com-table-td-debut com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeFerme.ferIdTri}</span>" +
								"{listeFerme.ferNumero}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeFerme.cptLabel}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeFerme.ferNom}</td>" +
							"<td class=\"com-table-td-fin com-underline-hover liste-adh-td-solde\">" +
								"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
				"<!-- END listeFerme -->" +
					"</tbody>" +
				"</table>" +
				//"</div>" +
			"</div>" +
		"</div>";
			
	this.listeFermeVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Fermes" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune ferme dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeStockProduitFermeEntete =		
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-retour\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour à la liste des fermes" +
				"</button>" +
			"</div>" +
			"{detail}" +
		"</div>" ;
	
	this.listeStockProduitFermeDetail =	
			"<div class=\"achat com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Produits : {ferNom}" +
				"</div>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"<td>" +
						"</td>" +
						"<td colspan=\"2\">" +
							"<div class=\"ui-widget-header ui-corner-all com-center\">" +
								"Stock" +
							"</div>" +
						"</td>" +
						"<td colspan=\"2\">" +
							"<div class=\"ui-widget-header ui-corner-all com-center\">" +
								"Stock Solidaire" +
							"</div>" +
						"</td>" +
						"<td colspan=\"2\">" +
						"<div class=\"ui-widget-header ui-corner-all com-center\">" +
							"Stock Total" +
						"</div>" +
					"</td>" +
						"<td></td>" +
					"</tr>" +
				"<!-- BEGIN listeProduit -->" +
					"<tr>" +
						"<td><div class=\"ui-widget-header ui-corner-all com-center\">{listeProduit.cproNom}</div></td>" +
						"<td colspan=\"7\"></td>" +
					"</tr>" +
					"<!-- BEGIN listeProduit.produits -->" +
					"<tr class=\"com-ligne-hover\">" +
						"<td>{listeProduit.produits.nproNom}</td>" +						
				
						"<td class=\"com-text-align-right\">" +
							"<span class=\"produit-{listeProduit.produits.stoQteId}\" id=\"label-quantite-{listeProduit.produits.stoQteId}\">{listeProduit.produits.stoQteQuantiteAffiche}</span>" +
							"<span class=\"ui-helper-hidden produit-{listeProduit.produits.stoQteId}\">" +
								"<input type=\"text\" value=\"{listeProduit.produits.stoQteQuantite}\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"{listeProduit.produits.stoQteId}-quantite\" maxlength=\"12\" size=\"3\" data-id=\"{listeProduit.produits.stoQteId}\" />" +
							"</span>" +
						"</td>" +					
						"<td>" +
							"{listeProduit.produits.stoQteUnite}" +
						"</td>" +
						
						"<td class=\"com-text-align-right\">" +
							"<span class=\"produit-{listeProduit.produits.stoQteId}\" id=\"label-quantite-solidaire-{listeProduit.produits.stoQteId}\">{listeProduit.produits.stoQteQuantiteSolidaireAffiche}</span>" +
							"<span class=\"ui-helper-hidden produit-{listeProduit.produits.stoQteId}\">" +
								"<input type=\"text\" value=\"{listeProduit.produits.stoQteQuantiteSolidaire}\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"{listeProduit.produits.stoQteId}-quantiteSolidaire\" maxlength=\"12\" size=\"3\" data-id=\"{listeProduit.produits.stoQteId}\" />" +
							"</span>" +
						"</td>" +					
						"<td>" +
							"{listeProduit.produits.stoQteUnite}" +
						"</td>" +
						
						"<td class=\"com-text-align-right\">" +
							"<span class=\"produit-{listeProduit.produits.stoQteId}\"id=\"label-quantite-total-{listeProduit.produits.stoQteId}\">{listeProduit.produits.stoQteQuantiteTotal}</span>" +
							"<span class=\"ui-helper-hidden produit-{listeProduit.produits.stoQteId}\" id=\"label-quantite-total-edit-{listeProduit.produits.stoQteId}\">" +
								"{listeProduit.produits.stoQteQuantiteTotal}" +
							"</span>" +
						"</td>" +					
						"<td>" +
							"{listeProduit.produits.stoQteUnite}" +
						"</td>" +
						"<td>" +
							"{listeProduit.produits.btnEdition}" +
						"</td>" +	
					"</tr>" +
					"<!-- END listeProduit.produits -->" +
				"<!-- END listeProduit -->" +
				"</table>" +
			"</div>";
	
	this.listeStockProduitFermeDetailBtnEdition =
		"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all btn-modif\" id=\"btn-modif-{stoQteId}\" title=\"Modifier\" data-id=\"{stoQteId}\">" +
			"<span class=\"ui-icon ui-icon-pencil\"></span>" +
		"</span>" +	
		"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden btn-annuler\" id=\"btn-annuler-{stoQteId}\" title=\"Annuler\" data-id=\"{stoQteId}\">" +
			"<span class=\"ui-icon ui-icon-closethick\"></span>" +
		"</span>" +
		"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden btn-check\" id=\"btn-check-{stoQteId}\" title=\"Valider\" data-id=\"{stoQteId}\">" +
			"<span class=\"ui-icon ui-icon-check\"></span>" +
		"</span>";
	
	this.listeStockProduitFermeDetailVide =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Les Produits" +
			"</div>" +
			"<p id=\"texte-liste-vide\">Aucun produit pour cette ferme dans la base.</p>" +	
		"</div>";
}
