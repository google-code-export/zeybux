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
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
							"Unité : " +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"{formUnite}" +
						"</td>" +
					"</tr>" +
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
	
	this.formUniteSansUnite = 
		"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"pro-formUnite\" maxlength=\"20\" id=\"pro-unite\" value=\"{unite}\"/>";
	
	this.formUnite = "<span id=\"pro-unite\">{unite}</span><input type=\"hidden\" name=\"pro-formUnite\" value=\"{unite}\" />";
	this.formUniteSelect = 
		"<select id=\"pro-unite\" name=\"pro-formUnite\" >" +
			"<option value=\"\" >== Choisir ==</option>" +
			"<!-- BEGIN unite -->" +
			"<option value=\"{unite.mLotUnite}\" {unite.selected}>{unite.mLotUnite}</option>" +
			"<!-- END unite -->" +
		"</select>";
	
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
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Unité : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"{formUnite}" +
					"</td>" +
				"</tr>" +
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
							"<td class=\"com-table-td-debut com-underline-hover\"><span class=\"ui-helper-hidden\">{listeAdherent.adhId}</span>{listeAdherent.adhNumero}</td>" +
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
						"{proAboMax}" +
					"</td>" +
				"</tr>" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Quantité abonnement : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"quantite\" maxlength=\"12\" id=\"quantite\"/> {proAboUnite}" +
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
						"{proAboMax}" +
					"</td>" +
				"</tr>" +
				"<tr>" +
					"<th class=\"com-table-form-th\">" +
						"Quantité abonnement : " +
					"</th>" +
					"<td class=\"com-table-form-td\">" +
						"<input type=\"hidden\" name=\"idProduitAbonnement\" id=\"idProduitAbonnement\" value=\"{proAboId}\"/>" +
						"<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{idCompteAbonnement}\"/>" +
						"<input class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"quantite\" maxlength=\"12\" id=\"quantite\" value=\"{cptAboQuantite}\"/> {proAboUnite}" +
					"</td>" +
				"</tr>" +
			"</table>" +
		"</div>";
	
	this.dialogSuppressionAbonnement =
		"<div id=\"dialog-supp-abonnement\" title=\"Supprimer l'abonnement\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer l'abonnement à ce produit?</p>" +
		"</div>";
}