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
									"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
									"<th class=\"com-table-th com-underline-hover\"></th>" +
									"<th class=\"com-table-th com-underline-hover\"></th>" +
								"</tr>" +
							"</thead>" +
							"<tbody>" +
						"<!-- BEGIN listeCategorie -->" +
								"<tr class=\"com-cursor-pointer\" id=\"{listeCategorie.cproId}\">" +
									"<td class=\"com-table-td com-underline-hover\">{listeCategorie.cproNom}</td>" +
									"<td class=\"com-table-td com-underline-hover td-edt\">" +
										"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\">" +
											"<span class=\"ui-icon ui-icon-pencil\">" +
										"</span>" +
									"</td>" +
									"<td class=\"com-table-td com-underline-hover td-edt\">" +
										"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\">" +
											"<span class=\"ui-icon ui-icon-closethick\">" +
										"</span>" +
									"</td>" +
								"</tr>" +
						"<!-- END listeCategorie -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeCategorieVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les catégories de produit</div>" +
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
}