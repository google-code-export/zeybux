;function GestionComptesSpeciauxTemplate() {
	this.listeComptes = 
		"<div id=\"contenu\" class=\"ui-helper-reset\">" +
			"<div id=\"liste-compte\">" +
				"<ul>" +
					"<li><a href=\"#liste-administrateur\">Comptes Administrateur</a></li>" +
					"<li><a href=\"#liste-caisse\">Comptes Caisse</a></li>" +
					"<li><a href=\"#liste-solidaire\">Comptes Solidaire</a></li>" +
				"</ul>" +
				"<div id=\"liste-administrateur\">" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-administrateur\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-administrateur\" id=\"filter-administrateur\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-administrateur\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th colspan=\"3\" class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Login</th>" +
								"<th class=\"com-table-th-fin\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-administrateur\" title=\"Ajouter un compte administrateur\">" +
										"<span class=\"ui-icon ui-icon-plusthick\">" +
									"</span>" +
								"</th>" +
							"</span>" +	
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN administrateur -->" +
							"<tr class=\"compte-ligne-administrateur\" >" +
								"<td class=\"com-table-td-debut\">{administrateur.login}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\" id-compte=\"{administrateur.id}\" login=\"{administrateur.login}\" type-compte=\"0\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass\" title=\"Modifier le mot de passe\" id-compte=\"{administrateur.id}\" type-compte=\"0\">" +
										"<span class=\"ui-icon ui-icon-key\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\" id-compte=\"{administrateur.id}\" login=\"{administrateur.login}\" type-compte=\"0\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END administrateur -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +	
				"<div id=\"liste-caisse\">" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-caisse\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-caisse\" id=\"filter-caisse\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-caisse\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th colspan=\"3\" class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Login</th>" +
								"<th class=\"com-table-th-fin\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-caisse\" title=\"Ajouter un compte caisse\">" +
										"<span class=\"ui-icon ui-icon-plusthick\">" +
									"</span>" +
								"</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN caisse -->" +
							"<tr class=\"compte-ligne-caisse\" >" +
								"<td class=\"com-table-td-debut\">{caisse.login}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\" id-compte=\"{caisse.id}\" login=\"{caisse.login}\" type-compte=\"1\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass\" title=\"Modifier le mot de passe\" id-compte=\"{caisse.id}\" type-compte=\"1\">" +
										"<span class=\"ui-icon ui-icon-key\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\" id-compte=\"{caisse.id}\" login=\"{caisse.login}\" type-compte=\"1\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END caisse -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
				"<div id=\"liste-solidaire\">" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-solidaire\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-solidaire\" id=\"filter-solidaire\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-solidaire\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th colspan=\"3\" class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Login</th>" +
								"<th class=\"com-table-th-fin\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-solidaire\" title=\"Ajouter un compte solidaire\">" +
										"<span class=\"ui-icon ui-icon-plusthick\">" +
									"</span>" +
								"</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN solidaire -->" +
							"<tr class=\"compte-ligne-solidaire\" >" +
								"<td class=\"com-table-td-debut\">{solidaire.login}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\" id-compte=\"{solidaire.id}\" login=\"{solidaire.login}\" type-compte=\"2\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass\" title=\"Modifier le mot de passe\" id-compte=\"{solidaire.id}\" type-compte=\"2\">" +
										"<span class=\"ui-icon ui-icon-key\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\" id-compte=\"{solidaire.id}\" login=\"{solidaire.login}\" type-compte=\"2\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END solidaire -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdministrateurVide =
		"<div id=\"liste-administrateur\">" +
			"<p id=\"texte-liste-vide\">" +
				"<button class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\" id=\"btn-nv-administrateur\">Ajouter un compte administrateur</button>" +
			"</p>" +
		"</div>";
	
	this.listeCaisseVide =
		"<div id=\"liste-caisse\">" +
			"<p id=\"texte-liste-vide\">" +
				"<button class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\" id=\"btn-nv-caisse\">Ajouter un compte caisse</button>" +
			"</p>" +
		"</div>";
	
	this.listeSolidaireVide =
		"<div id=\"liste-solidaire\">" +
			"<p id=\"texte-liste-vide\">" +
				"<button class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\" id=\"btn-nv-solidaire\">Ajouter un compte solidaire</button>" +
			"</p>" +
		"</div>";
	
	this.dialogAjoutCompte =
		"<div id=\"dialog-ajout-compte\" title=\"Ajouter un compte {typeCompte}\" class=\"formulairer_dialog\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Login *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"input_formulaire_identification com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"login\" maxlength=\"20\" id=\"login\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Confirmer *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogUpdate =
		"<div id=\"dialog-modif-compte\" title=\"Modifier un compte\" class=\"formulairer_dialog\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Login *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"input_formulaire_identification com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"login\" maxlength=\"20\" id=\"login\" value=\"{login}\" /></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogUpdatePass =
		"<div id=\"dialog-modif-compte\" title=\"Modifier le mot de passe\" class=\"formulairer_dialog\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nouveau mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Confirmer *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\" /></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogDelete =
		"<div id=\"dialog-sup-compte\" title=\"Supprimer un compte\" class=\"formulairer_dialog\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer le compte : {login}</p>" +
		"</div>";
}