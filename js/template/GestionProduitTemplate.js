;function GestionProduitTemplate() {
	this.listeCategorie = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +
			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les catégories de produit" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-cat\" title=\"Ajouter une catégorie\">" +
							"<span class=\"ui-icon ui-icon-plusthick\">" +
							"</span>" +
						"</span>" +	
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
								"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeCategorie -->" +
							"<tr class=\"com-cursor-pointer\" id=\"{listeCategorie.cproId}\">" +
								"<td class=\"compte-ligne com-table-td-debut com-underline-hover\">{listeCategorie.cproNom}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeCategorie -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeCategorieVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les catégories de produit" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-cat\" title=\"Ajouter une catégorie\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +	
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune catégorie dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutCategorie =
		"<div id=\"dialog-form-cat\" title=\"Catégorie\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td>" +
							"<input type=\"hidden\" name=\"id\" id=\"cat-id\" value=\"{cproId}\"/>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" id=\"cat-nom\" value=\"{cproNom}\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"cat-description\">{cproDescription}</textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";
	
	this.dialogSupprimerCategorie =
		"<div id=\"dialog-cat\" title=\"Catégorie\">" +
			"<p>" +
				"Voulez-vous supprimer la catégorie : {cproNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogRefusSupprimerCategorie =
		"<div id=\"dialog-cat\" title=\"Catégorie\">" +
			"<p>" +
				"Il existe {nbProduit} produits liés à cette catégorie. Vous devez les supprimer ou les chager de catégorie pour pouvoir supprimer la catégorie : {cproNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogInfoCategorie = 
		"<div id=\"dialog-info-cat\" title=\"Détail de la catégorie\">" +
			"<div>Nom : {cproNom}</div>" +
			"<div>Description : {cproDescription}</div>" +
		"</div>";
	
	this.listeCaracteristique = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +
			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les caractéristiques de produit" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-car\" title=\"Ajouter une caractéristique\">" +
							"<span class=\"ui-icon ui-icon-plusthick\">" +
							"</span>" +
						"</span>" +	
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
								"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeCaracteristique -->" +
							"<tr class=\"com-cursor-pointer\" id=\"{listeCaracteristique.carId}\">" +
								"<td class=\"compte-ligne com-table-td-debut com-underline-hover\">{listeCaracteristique.carNom}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeCaracteristique -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeCaracteristiqueVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les caractéristiques de produit" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-car\" title=\"Ajouter une caractéristique\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +	
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune caractéristique dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutCaracteristique =
		"<div id=\"dialog-form-car\" title=\"Caractéristique\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td>" +
							"<input type=\"hidden\" name=\"id\" id=\"car-id\" value=\"{carId}\"/>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" id=\"car-nom\" value=\"{carNom}\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"car-description\">{carDescription}</textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";
	
	this.dialogSupprimerCaracteristique =
		"<div id=\"dialog-car\" title=\"Caractéristique\">" +
			"<p>" +
				"Voulez-vous supprimer la caractéristique : {carNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogRefusSupprimerCaracteristique =
		"<div id=\"dialog-car\" title=\"Caractéristique\">" +
			"<p>" +
				"Il existe {nbProduit} produits liés à cette caractéristique. Vous devez les supprimer ou les changer de caractéristique pour pouvoir supprimer la caractéristique : {carNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogInfoCaracteristique = 
		"<div id=\"dialog-info-car\" title=\"Détail de la caracréristique\">" +
			"<div>Nom : {carNom}</div>" +
			"<div>Description : {carDescription}</div>" +
		"</div>";
}