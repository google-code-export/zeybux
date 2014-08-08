;function RechargementCompteTemplate() {
	this.listeAdherent = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Adhérents</div>" +
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
										"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Courriel</th>" +
										"<th class=\"com-table-th-fin liste-adh-th-solde\">Solde</th>" +
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
										"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhCourrielPrincipal}</td>" +
										"<td class=\"com-table-td-fin com-underline-hover liste-adh-td-solde\"><span class=\"{listeAdherent.classSolde}\">{listeAdherent.cptSolde} {sigleMonetaire}</span></td>" +
									"</tr>" +
							"<!-- END listeAdherent -->" +
								"</tbody>" +
							"</table>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Adhérents</div>" +
				"<p id=\"texte-liste-vide\">Aucun adhérent dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogRecharger = 
		"<div title=\"Rechargement du compte {compte}\">" +
			"<div>" +
				"{numero} : {prenom} {nom}" +
			"</div>" +
			"<div>" +
				"<span>Solde : </span><span class=\"{classSolde}\" id=\"nouveau-solde\">{solde}</span> <span class=\"{classSolde}\" id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
			"</div><br/>" +
			"<div class=\"com-widget-content\">" +
				"<table>" +
					"<thead>" +
						"<tr>" +
							"<td>Montant</td>" +
							"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"montant\" maxlength=\"12\" size=\"5\"/> <span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
						"<tr id=\"ligne-operation\">" +
							"<td>Type de Paiement</td>" +
							"<td>" +
								"<select name=\"typepaiement\" id=\"typePaiement\">" +
									"<option value=\"0\">== Choisir ==</option>" +
									"<!-- BEGIN typePaiement -->" +
									"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
									"<!-- END typePaiement -->" +
								"</select>" +
							"</td>" +
						"</tr>" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.champComplementaire =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.label}</td>" +
				"<td>" +
					"<input type=\"text\" value=\"\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"champComplementaire{champComplementaire.id}valeur\" data-id-champ-complementaire=\"{champComplementaire.id}\" maxlength=\"50\" size=\"15\"/>" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
}