;function GestionProducteurTemplate() {
	this.dialogAjoutProducteur =
		"<div id=\"dialog-form-prdt\" title=\"Producteur\">" +
			"<form>" +
				"<div id=\"information-detail-producteur\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Information du producteur</div>" +
					"<div class=\"com-widget-content\">" +
						"<table class=\"com-table-form\">" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Nom *</th>" +
								"<td class=\"com-table-form-td\">" +
									"<input type=\"hidden\" name=\"id\" id=\"prdt-id\" value=\"{prdtId}\"/>" +
									"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" maxlength=\"50\" id=\"prdt-nom\" value=\"{prdtNom}\"/>" +
								"</td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Prénom *</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prenom\" maxlength=\"50\" id=\"prdt-prenom\" value=\"{prdtPrenom}\"/></td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Date de Naissance (jj/mm/aaaa)</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_naissance\" maxlength=\"10\" id=\"prdt-dateNaissance\" value=\"{prdtDateNaissance}\"/></td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Commentaire</th>" +
								"<td class=\"com-table-form-td\"><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"commentaire\" id=\"prdt-commentaire\">{prdtCommentaire}</textarea></td>" +
							"</tr>" +
						"</table>" +
					"</div>" +
				"</div>" +
				
				"<div>" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées du producteur</div>" +
					"<div class=\"com-widget-content\">" +
						"<table class=\"com-table-form\">" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Courriel Principal</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"courriel_principal\" maxlength=\"100\" id=\"prdt-courrielPrincipal\" value=\"{prdtCourrielPrincipal}\"/></td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Courriel Secondaire</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" ype=\"text\" name=\"courriel_secondaire\" maxlength=\"100\" id=\"prdt-courrielSecondaire\" value=\"{prdtCourrielSecondaire}\"/></td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Téléphone Principal</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_principal\" maxlength=\"20\" id=\"prdt-telephonePrincipal\" value=\"{prdtTelephonePrincipal}\"/></td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Téléphone Secondaire</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_secondaire\" maxlength=\"20\" id=\"prdt-telephoneSecondaire\" value=\"{prdtTelephoneSecondaire}\"/></td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Adresse</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"adresse\" maxlength=\"300\" id=\"prdt-adresse\" value=\"{prdtAdresse}\"/></td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Code Postal</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"code_postal\" maxlength=\"10\" id=\"prdt-codePostal\" value=\"{prdtCodePostal}\"/></td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Ville</th>" +
								"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"ville\" maxlength=\"100\" id=\"prdt-ville\" value=\"{prdtVille}\"/></td>" +
							"</tr>" +
						"</table>" +
					"</div>" +
				"</div>" +
			"</form>" +
		"</div>";

	this.listeProducteur = 
		"<div id=\"contenu-ferme\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Producteurs" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-prdt\" title=\"Ajouter un producteur\">" +
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
							"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
							"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
							"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
							"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Courriel</th>" +
							"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Téléphone</th>" +
							"<th class=\"com-table-th com-underline-hover\"></th>" +
							"<th class=\"com-table-th com-underline-hover\"></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN listeProducteur -->" +
						"<tr class=\"com-cursor-pointer\" >" +
							"<td class=\"com-table-td com-underline-hover compte-ligne\">" +
								"<span class=\"ui-helper-hidden id-producteur\">{listeProducteur.prdtId}</span>" +
								"<span class=\"numero-producteur\">{listeProducteur.prdtNumero}</span>" +
							"</td>" +
							"<td class=\"com-table-td com-underline-hover compte-ligne\">{listeProducteur.prdtNom}</td>" +
							"<td class=\"com-table-td com-underline-hover compte-ligne\">{listeProducteur.prdtPrenom}</td>" +
							"<td class=\"com-table-td com-underline-hover compte-ligne\">{listeProducteur.prdtCourrielPrincipal}</td>" +
							"<td class=\"com-table-td com-underline-hover compte-ligne\">{listeProducteur.prdtTelephonePrincipal}</td>" +
							"<td class=\"com-table-td com-underline-hover td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" title=\"Modifier\">" +
									"<span class=\"ui-icon ui-icon-pencil\"></span>" +
								"</span>" +
							"</td>" +
							"<td class=\"com-table-td com-underline-hover td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supp\" title=\"Supprimer\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
				"<!-- END listeProducteur -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeProducteurVide =
		"<div id=\"contenu-ferme\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Producteurs" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-prdt\" title=\"Ajouter un producteur\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +	
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucun producteur dans cette ferme.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogSuppressionProducteur = 
		"<div id=\"dialog-supp-prdt\" title=\"Supprimer le producteur {prdtNumero}\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer le producteur : {prdtNumero}</p>" +
		"</div>";
	
	this.dialogInfoCompteProducteur = 
		"<div id=\"dialog-info-prdt\" title=\"Détail du producteur : {prdtNumero}\">" +
			"<div id=\"information-detail-producteur\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations</div>" +
				"<div class=\"com-widget-content\">" +
					"<div>{prdtNumero} : {prdtPrenom} {prdtNom}</div>" +
					"<div>Date de naissance : {prdtDateNaissance}</div>" +
					"<div>Commentaire : {prdtCommentaire}</div>" +
				"</div>" +
			"</div>" +
			"<div>" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
				"<div class=\"com-widget-content\">" +
					"<div>Courriel 1 : {prdtCourrielPrincipal}</div>" +
					"<div>Courriel 2 : {prdtCourrielSecondaire}</div>" +
					"<div>Téléphone 1 : {prdtTelephonePrincipal}</div>" +
					"<div>Téléphone 2 : {prdtTelephoneSecondaire}</div>" +
					"<div>Adresse : {prdtAdresse}</div>" +				
					"<div>{prdtCodePostal} {prdtVille}</div>" +
				"</div>" +
			"</div>" +
		"</div>";
			
	this.listeFerme = 
		"<div id=\"contenu\">" +	
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Fermes" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-fer\" title=\"Ajouter une ferme\">" +
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
								"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeFerme -->" +
							"<tr class=\"com-cursor-pointer compte-ligne\" >" +
								"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-ferme\">{listeFerme.ferId}</span>{listeFerme.ferNumero}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeFerme.cptLabel}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeFerme.ferNom}</td>" +
							"</tr>" +
					"<!-- END listeFerme -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
			
	this.listeFermeVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les Fermes" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-fer\" title=\"Ajouter une ferme\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +	
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune ferme dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutFerme =
		"<div id=\"dialog-form-fer\" title=\"Ajouter une ferme\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom *</td>" +
						"<td>" +
							"<textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"nom\" id=\"fer-nom\"></textarea>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>SIREN</td>" +
						"<td>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"siren\" maxlength=\"9\" id=\"fer-siren\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Adresse</td>" +
						"<td>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"adresse\" maxlength=\"300\" id=\"fer-adresse\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Code Postal</td>" +
						"<td>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"code_postal\" maxlength=\"10\" id=\"fer-codePostal\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Ville</td>" +
						"<td>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"ville\" maxlength=\"100\" id=\"fer-ville\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Date d'adhésion (jj/mm/aaaa) *</td>" +
						"<td>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_adhesion\" value=\"{dateAdhesion}\" maxlength=\"10\" id=\"fer-dateAdhesion\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"fer-description\"></textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";
	
	this.informationFerme = 
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-liste-ferme\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Liste des Fermes" +
				"</button>" +
			"</div>" +
			"<div id=\"menu-nav-ferme\">" +
				"<span class=\"com-cursor-pointer ui-widget-header ui-corner-tl ui-state-active\" id=\"btn-information\">Informations</span>" +
				"<span class=\"com-cursor-pointer ui-widget-header com-btn-hover\" id=\"btn-liste-producteur\" >Producteurs</span>" +
				"<span class=\"com-cursor-pointer ui-widget-header ui-corner-tr com-btn-hover\" id=\"btn-catalogue\" >Catalogue</span>" +
			"</div>" +
			"<div id=\"contenu-ferme\">" +
				"<!-- BEGIN ferme -->" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all \">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">{ferme.ferNumero} : <span id=\"nom\">{ferme.ferNom}</span>" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer edt-info-ferme\" id=\"btn-supp\" title=\"Supprimer\">" +
							"<span class=\"ui-icon ui-icon-trash\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer edt-info-ferme\" id=\"btn-edt\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden edt-info-ferme\" id=\"btn-edt-annuler\" title=\"Annuler\">" +
							"<span class=\"ui-icon ui-icon-closethick\"></span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden edt-info-ferme\" id=\"btn-edt-valider\" title=\"Valider\">" +
							"<span class=\"ui-icon ui-icon-check\"></span>" +
						"</span>" +
					"</div>" +
					
					"<div class=\"edt-info-ferme\">" +
						"<div>Compte : {ferme.cptLabel}</div>" +
						"<div>SIREN : <span id=\"siren\">{ferme.ferSiren}</span></div>" +
						"<div>Adhésion : <span id=\"dateAdhesion\">{ferme.ferDateAdhesion}</span></div>" +
						"<div>Adresse : <span id=\"adresse\">{ferme.ferAdresse}</span></div>" +				
						"<div><span id=\"codePostal\">{ferme.ferCodePostal}</span> <span id=\"ville\">{ferme.ferVille}</span></div>" +
						"<div>Description : <span id=\"description\">{ferme.ferDescription}</span></div>" +
					"</div>" +
					
					
					
					"<div class=\"edt-info-ferme ui-helper-hidden\">" +
						"<form>" +
							"<table>" +
								"<tr>" +
									"<td>Nom *</td>" +
									"<td>" +
										"<textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"nom\" id=\"fer-nom\"></textarea>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<td>SIREN</td>" +
									"<td>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"siren\" maxlength=\"9\" id=\"fer-siren\" />" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Adresse</td>" +
									"<td>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"adresse\" maxlength=\"300\" id=\"fer-adresse\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Code Postal</td>" +
									"<td>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"code_postal\" maxlength=\"10\" id=\"fer-codePostal\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Ville</td>" +
									"<td>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"ville\" maxlength=\"100\" id=\"fer-ville\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Date d'adhésion (jj/mm/aaaa) *</td>" +
									"<td>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_adhesion\" maxlength=\"10\" id=\"fer-dateAdhesion\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Description</td>" +
									"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"fer-description\"></textarea></td>" +
								"</tr>" +
							"</table>" +	
						"</form>" +
					"</div>" +
				
				"</div>" +
				"<!-- END ferme -->" +
				"<div>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Liste des Opérations</span></div>	" +	
						"<div>" +				
							"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
								"<form>" +	
								"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
								"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
								"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
								"	<input type=\"hidden\" class=\"pagesize\" value=\"10\">" +
								"</form>" +	
							"</div>" +	
				
							"<table id=\"table-operation\" class=\"com-table\">" +
								"<thead>" +
								"<tr class=\"ui-widget ui-widget-header\" >" +
									"<th class=\"com-table-th\">Date</th>" +
									"<th class=\"com-table-th\">Libellé</th>" +
									"<th class=\"com-table-th\">Type de paiement</th>" +
									"<th class=\"com-table-th\">Débit</th>" +
									"<th class=\"com-table-th\">Crédit</th>" +
								"</tr>" +
								"</thead>" +
								"<tbody>" +
							"<!-- BEGIN operationPassee -->" +
								"<tr>" +
									"<td class=\"com-table-td td-date \">{operationPassee.opeDate}</td>" +
									"<td class=\"com-table-td td-libelle\">{operationPassee.opeLibelle}</td>" +
									"<td class=\"com-table-td td-type-paiement\">{operationPassee.tppType}</td>" +
									"<td class=\"com-table-td td-montant\">{operationPassee.debit}</td>" +
									"<td class=\"com-table-td td-montant\">{operationPassee.credit}</td>" +
								"</tr>" +
							"<!-- END operationPassee -->" +
								"</tbody>" +
							"</table>" +
						"</div>" +
					"</div>";
				"</div>" +
			"</div>" +
		"</div>";
			
	this.dialogSuppressionFerme = 
		"<div id=\"dialog-supp-ferme\" title=\"Supprimer la ferme {ferNumero}\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer la ferme : {ferNumero}</p>" +
		"</div>";

	this.catalogue =
		"<div id=\"contenu-ferme\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-float-left\" id=\"categorie-produit\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les catégories de produit" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-cat\" title=\"Ajouter une catégorie\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +	
				"</div>" +
				"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"<form id=\"filter-form-cat\">" +
						"<div>" +
							"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
								"<span class=\"ui-icon ui-icon-search\">" +
								"</span>" +
							"</span>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-cat\" id=\"filter-cat\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
						"</div>" +
					"</form>" +
				"</div>" +
				"<table class=\"com-table\">" +
					"<thead>" +
						"<tr class=\"ui-widget ui-state-hover\" id-cat=\"0\">" +
							"<th class=\"ligne-cat com-table-td-debut com-underline-hover com-cursor-pointer\">Toutes les catégories</th>" +
							"<th class=\"com-table-td-med com-underline-hover\"></th>" +
							"<th class=\"com-table-td-fin com-underline-hover\"></th>" +
						"</tr>" +
					"</thead>" +
				"</table>" +
				"<div id=\"div-table-cat\">" +
					"<table class=\"com-table\" id=\"table-cat\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover td-edt\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover td-edt\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeCategorie -->" +
							"<tr class=\"com-cursor-pointer \" id-cat=\"{listeCategorie.cproId}\">" +
								"<td class=\"ligne-cat com-table-td-debut com-underline-hover\">{listeCategorie.cproNom}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-cat\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-cat\" title=\"Supprimer\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeCategorie -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-float-left\" id=\"catalogue-produit\">" +
			
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Le catalogue de produit" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-pro\" title=\"Ajouter un produit\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +	
				"</div>" +
		
				"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"<form id=\"filter-form-pro\">" +
						"<div>" +
							"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
									"<span class=\"ui-icon ui-icon-search\">" +
								"</span>" +
							"</span>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-pro\" id=\"filter-pro\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
						"</div>" +
					"</form>" +
				"</div>" +
				
				"<table class=\"com-table\" id=\"table-pro\">" +
					"<tbody>" +
						"<!-- BEGIN listeProduit -->" +
							"<tr class=\"ui-widget-header\">" +
								"<th class=\"com-table-th-debut\">{listeProduit.nom}</th>" +
								"<th class=\"com-table-th-med\"></th>" +
								"<th class=\"com-table-th-fin\"></th>" +
							"</tr>" +

							"<!-- BEGIN listeProduit.produits -->" +
							"<tr class=\"com-cursor-pointer\" id-pro=\"{listeProduit.produits.nproId}\">" +
								"<td class=\"com-table-td-debut com-underline-hover liste-produit-nom\">{listeProduit.produits.nproNom}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-produit\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-produit\" title=\"Supprimer\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END listeProduit.produits -->" +
						"<!-- END listeProduit -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeToutProduitCatalogue =
		"<table class=\"com-table\" id=\"table-pro\">" +
			"<tbody>" +
				"<!-- BEGIN listeProduit -->" +
					"<tr class=\"ui-widget-header\">" +
						"<th class=\"com-table-th-debut\">{listeProduit.nom}</th>" +
						"<th class=\"com-table-th-med\"></th>" +
						"<th class=\"com-table-th-fin\"></th>" +
					"</tr>" +
	
					"<!-- BEGIN listeProduit.produits -->" +
					"<tr class=\"com-cursor-pointer\" id-pro=\"{listeProduit.produits.nproId}\">" +
						"<td class=\"com-table-td-debut com-underline-hover liste-produit-nom\">{listeProduit.produits.nproNom}</td>" +
						"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-produit\" title=\"Modifier\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-produit\" title=\"Supprimer\">" +
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"<!-- END listeProduit.produits -->" +
				"<!-- END listeProduit -->" +
			"</tbody>" +
		"</table>" ;
	
	this.listeProduitCatalogue =
		"<!-- BEGIN listeProduit -->" +
		"<table class=\"com-table\" id=\"table-pro\">" +
			"<thead>" +
				"<tr class=\"ui-widget-header\">" +
					"<th class=\"com-table-th-debut\">{listeProduit.nom}</th>" +
					"<th class=\"com-table-th-med\"></th>" +
					"<th class=\"com-table-th-fin\"></th>" +
				"</tr>" +
			"</thead>" +
			"<tbody>" +
				"<!-- BEGIN listeProduit.produits -->" +
				"<tr class=\"com-cursor-pointer\" id-pro=\"{listeProduit.produits.nproId}\">" +
					"<td class=\"com-table-td-debut com-underline-hover liste-produit-nom\">{listeProduit.produits.nproNom}</td>" +
					"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-produit\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-produit\" title=\"Supprimer\">" +
							"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
				"<!-- END listeProduit.produits -->" +
			"</tbody>" +
		"</table>" +
		"<!-- END listeProduit -->" ;
	
	this.listeProduitCategorieCatalogueVide =
		"<div id=\"table-pro\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<p id=\"texte-liste-vide\">Aucun produit dans la catégorie : {cproNom}.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeProduitCatalogueVide =
		"<div id=\"table-pro\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<p id=\"texte-liste-vide\">Aucun produit pour cette Ferme.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeCategorieVide =
		"<div id=\"table-cat\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<p id=\"texte-liste-vide\">Aucune catégorie.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeCategorie = 
		"<div id=\"div-table-cat\">" +
			"<table class=\"com-table\" id=\"table-cat\">" +
				"<thead>" +
				"<tr class=\"ui-widget ui-widget-header\">" +
					"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
					"<th class=\"com-table-th-med com-underline-hover td-edt\"></th>" +
					"<th class=\"com-table-th-fin com-underline-hover td-edt\"></th>" +
				"</tr>" +
			"</thead>" +
			"<tbody>" +
			"<!-- BEGIN listeCategorie -->" +
				"<tr class=\"com-cursor-pointer \" id-cat=\"{listeCategorie.cproId}\">" +
					"<td class=\"ligne-cat com-table-td-debut com-underline-hover\">{listeCategorie.cproNom}</td>" +
					"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-cat\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-cat\" title=\"Supprimer\">" +
							"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
			"<!-- END listeCategorie -->" +
			"</tbody>" +
			"</table>" +
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
				"Il existe {nbProduit} produits liés à cette catégorie. Vous devez les supprimer ou les changer de catégorie pour pouvoir supprimer la catégorie : {cproNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogAjoutProduit =
		"<div id=\"dialog-form-pro\" title=\"Produit\">" +
			"<form>" +
				"<div id=\"information-detail-producteur\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations</div>" +
					"<div class=\"com-widget-content\">" +
						"<table class=\"com-table-form\">" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Nom *</th>" +
								"<td class=\"com-table-form-td\">" +
									"<input type=\"hidden\" name=\"id\" id=\"pro-id\" value=\"{idNomProduit}\"/>" +
									"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" maxlength=\"50\" id=\"pro-nom\" value=\"{nom}\"/>" +
								"</td>" +
							"</tr>" +
							"{form_reference}" +
							"<tr>" +
							"<th class=\"com-table-form-th\">Catégorie *</th>" +
								"<td class=\"com-table-form-td\">" +
									"<select name=\"categorie\" id=\"pro-idCategorie\">" +
										"<option value=\"0\" >== Choisir une catégorie ==</option>" +
										"<!-- BEGIN listeCategorie -->" +
										"<option value=\"{listeCategorie.cproId}\" >{listeCategorie.cproNom}</option>" +
										"<!-- END listeCategorie -->" +
									"</select>" +
								"</td>" +
							"</tr>" +
							"<tr>" +
								"<th class=\"com-table-form-th\">Description</th>" +
								"<td class=\"com-table-form-td\"><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"pro-description\">{description}</textarea></td>" +
							"</tr>" +
						"</table>" +
					"</div>" +
				"</div>" +
				
				"<div>" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Producteurs</div>" +
					"<div class=\"com-widget-content\" id=\"pro-producteur\">" +
						"<table class=\"com-table-form\">" +
							"<!-- BEGIN listeProducteur -->" +
							"<tr>" +
								"<td class=\"com-table-form-td\">" +
									"<input type=\"checkbox\" value=\"{listeProducteur.prdtId}\" name=\"producteur\" id=\"pro-prdt-{listeProducteur.prdtId}\"/>" +
								"</td>" +
								"<td class=\"com-table-form-td\">" +
									"{listeProducteur.prdtPrenom} {listeProducteur.prdtNom}" +
								"</td>" +
							"</tr>" +
							"<!-- END listeProducteur -->" +
						"</table>" +
					"</div>" +
				"</div>" +
				
				"<div>" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Caractéristiques</div>" +
					"<div class=\"com-widget-content\" id=\"pro-caracteristique\">" +
						"<table class=\"com-table-form\">" +
							"<!-- BEGIN listeCaracteristique -->" +
							"<tr>" +
								"<td class=\"com-table-form-td\">" +
									"<input type=\"checkbox\" value=\"{listeCaracteristique.carId}\" name=\"caracteristique\" id=\"pro-car-{listeCaracteristique.carId}\"/>" +
								"</td>" +
								"<td class=\"com-table-form-td\">" +
									"{listeCaracteristique.carNom}" +
								"</td>" +
							"</tr>" +
							"<!-- END listeCaracteristique -->" +
						"</table>" +
					"</div>" +
				"</div>" +
				
				"<div>" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Prix</div>" +
					"<div class=\"com-widget-content\" id=\"pro-prix\">" +
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
									"<input class=\"catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-quantite\" maxlength=\"13\" id=\"pro-lot-quantite\"/>" +
								"</td>" +
								"<td>" +
									"<input class=\"catalogue-input-lot com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"lot-unite\" maxlength=\"20\" id=\"pro-lot-unite\"/>" +
								"</td>" +
								"<td>" +
									"<input class=\"catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-prix\" maxlength=\"13\" id=\"pro-lot-prix\"/> {sigleMonetaire}" +
								"</td>" +
								"<td colspan=\"2\">" +
									"<button type=\"button\" id=\"btn-ajout-lot\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter</button>" +
								"</td>" +
							"</tr>" +
						"</table>" +
						"<table class=\"com-table\" id=\"lot-liste\">" +
						"</table>" +
					"</div>" +
				"</div>" +
				
			"</form>" +
		"</div>";
	
	this.ajoutProduitReference = 
		"<tr>" +
			"<th class=\"com-table-form-th\">Référence</th>" +
			"<td class=\"com-table-form-td\">" +
				"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"reference-choix\" value=\"0\" checked=\"checked\"/>Automatique" +
			"</td>" +
		"</tr>" +
		"<tr>" +
			"<th class=\"com-table-form-th\"></th>" +
			"<td class=\"com-table-form-td\">" +
				"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"reference-choix\" value=\"1\"/>" +
				"<input disabled=\"disabled\" class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"reference\" maxlength=\"50\" id=\"pro-numero\" value=\"{numero}\"/>" +
			"</td>" +
		"</tr>";

	this.modifProduitReference = 
		"<tr>" +
			"<th class=\"com-table-form-th\">Référence</th>" +
			"<td class=\"com-table-form-td\">" +
				"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"reference\" maxlength=\"50\" id=\"pro-numero\" value=\"{numero}\"/>" +
			"</td>" +
		"</tr>";
	
	this.produitListeProducteurVide =
		"<div class=\"com-widget-content\" id=\"pro-producteur\">" +
			"<p class=\"com-center\">Aucun producteur.</p>" +	
		"</div>";
	
	this.listeCaracteristiqueVide =
		"<div class=\"com-widget-content\" id=\"pro-caracteristique\">" +
			"<p class=\"com-center\">Aucune caractéristique.</p>" +	
		"</div>";
	
	this.dialogRefusAjoutProduit =
		"<div id=\"dialog-pro\" title=\"Produit\">" +
			"<p>" +
				"Il n'existe aucune catégorie de produit. Pour créer un produit il faut au préalable créer une catégorie." +		
			"</p>" +
		"</div>";
	
	this.modeleLot =
		"<tr class=\"ligne-lot\" id=\"ligne-lot-{id}\">" +
			"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{id}</span></td>" +
			"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite\">" +
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
				"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot\" title=\"Supprimer\">" +				
					"<span class=\"ui-icon ui-icon-trash\"></span>" +
				"</span>" +
			"</td>" +
		"</tr>" ;
	
	this.dialogSupprimerProduit =
		"<div id=\"dialog-pro\" title=\"Produit\">" +
			"<p>" +
				"Voulez-vous supprimer le produit : {nom}" +		
			"</p>" +
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
							"<th class=\"com-table-form-th\">Référence : </th>" +
							"<td class=\"com-table-form-td\">{numero}</td>" +
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
			
			"<div id=\"pro-prix\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Prix</div>" +
				"<table class=\"com-table\">" +
					"<!-- BEGIN modelesLot -->" +
					"<tr class=\"btn-lot\">" +
						"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite\">{modelesLot.mLotQuantite}</td>" +
						"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">{modelesLot.mLotUnite}</td>" +
						"<td class=\"com-table-td-fin\">à {modelesLot.mLotPrix} {sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END modelesLot -->" +
				"</table>" +
			"</div>" +
		"</div>";
};function ListeProducteurVue(pParam) {
	this.mIdFerme = null;
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeProducteurVue(pParam);}} );
		var that = this;
		pParam.fonction = "afficher";
		this.mIdFerme = pParam.id;
		$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(pParam),
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
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		
		if(lResponse.listeProducteur.length > 0 && lResponse.listeProducteur[0].prdtId != null) {
			var lTemplate = lGestionProducteurTemplate.listeProducteur;
						
			$('#contenu-ferme').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu-ferme').replaceWith(that.affect($(lGestionProducteurTemplate.listeProducteurVide)));
		}
		this.affectMenu();
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		pData = this.affectDialogCreerProducteur(pData);
		pData = this.affectDialogModifierProducteur(pData);
		pData = this.affectDialogSuppProducteur(pData);
		pData = this.affectLienRetour(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectMenu = function() {
		$('#btn-information,#btn-catalogue').removeClass("ui-state-active");
		$('#btn-liste-producteur').addClass("ui-state-active");		
	}
	
	this.affectLienRetour = function(pData) {
		pData.find("#btn-liste-ferme").click(function() { ListeFermeVue(); });
		return pData;
	}
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]]});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}
			
	this.affectLienCompte = function(pData) {
		var that = this;
		pData.find('.compte-ligne')
		.click(function() {		
			
			var lId = $(this).closest('tr').find(".id-producteur").text();
			var lParam = {id:lId,fonction:"detailProducteur"};
			$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionProducteurTemplate = new GestionProducteurTemplate();
								var lTemplate = lGestionProducteurTemplate.dialogInfoCompteProducteur;
								

								lResponse.producteur.prdtDateNaissance = lResponse.producteur.prdtDateNaissance.extractDbDate().dateDbToFr();
								
								$(lTemplate.template(lResponse.producteur)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:600,
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
	}
	
	this.affectDialogCreerProducteur = function(pData) {
		var that = this;
		pData.find('#btn-nv-prdt')
		.click(function() {			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogAjoutProducteur;
			$(lTemplate.template({})).dialog({			
				autoOpen: true,
				modal: true,
				draggable: true,
				resizable: false,
				width:600,
				buttons: {
					'Créer le producteur': function() {
						that.CreerProducteur($(this));
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProducteur($(this));
				return false;
			}).find('#prdt-dateNaissance').datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: "c+1",
				yearRange: "1900:c"});		
		});
		return pData;
	}
		
	this.CreerProducteur = function(pForm) {
		var that = this;
		var lVo = new ProducteurVO();
		
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		lVo.idFerme = this.mIdFerme;
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "ajouter";
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-prdt").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_323_CODE;
							erreur.message = ERR_323_MSG;
							lVr.log.erreurs.push(erreur);				
							that.construct({vr:lVr,id:that.mIdFerme});
						} else {
							Infobulle.generer(lResponse,'prdt-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'prdt-');
		}
	}
	
	this.affectDialogModifierProducteur = function(pData) {
		var that = this;
		pData.find('.btn-modifier')
		.click(function() {

			var lId = $(this).closest('tr').find(".id-producteur").text();
			var lParam = {id:lId,fonction:"detailProducteur"};
			$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionProducteurTemplate = new GestionProducteurTemplate();
								var lTemplate = lGestionProducteurTemplate.dialogAjoutProducteur;

								lResponse.producteur.prdtDateNaissance = lResponse.producteur.prdtDateNaissance.extractDbDate().dateDbToFr();
								
								$(lTemplate.template(lResponse.producteur)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:600,
									buttons: {
										'Modifier le producteur': function() {
											that.modifierProducteur($(this));
										},
										'Annuler': function() {
											$(this).dialog('close');
										}
									},
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								}).submit(function () {
									that.modifierProducteur($(this));
									return false;
								}).find('#prdt-dateNaissance').datepicker({
									changeMonth: true,
									changeYear: true,
									maxDate: "c+1",
									yearRange: "1900:c"});	
															
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		});
		return pData;
	}
		
	this.modifierProducteur = function(pForm) {
		var that = this;
		var lVo = new ProducteurVO();
		
		lVo.id = $(':input[name=id]').val();
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		lVo.idFerme = this.mIdFerme;
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "modifier";
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-prdt").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_324_CODE;
							erreur.message = ERR_324_MSG;
							lVr.log.erreurs.push(erreur);				
							that.construct({vr:lVr,id:that.mIdFerme});
						} else {
							Infobulle.generer(lResponse,'prdt-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'prdt-');
		}
	}
	
	this.affectDialogSuppProducteur = function(pData) {		
		var that = this;
		pData.find('.btn-supp')
		.click(function() {
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			
			var lId = $(this).closest('tr').find(".id-producteur").text();
			var lNumero = $(this).closest('tr').find(".numero-producteur").text();

			$(lGestionProducteurTemplate.dialogSuppressionProducteur.template({prdtNumero:lNumero})).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {id:lId,fonction:"supprimer"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											
											var lVr = new TemplateVR();
											lVr.valid = false;
											lVr.log.valid = false;
											var erreur = new VRerreur();
											erreur.code = ERR_325_CODE;
											erreur.message = ERR_325_MSG;
											lVr.log.erreurs.push(erreur);

											that.construct({vr:lVr,id:that.mIdFerme});
											
											$(lDialog).dialog('close');
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
	}
	
	this.construct(pParam);
};function ListeFermeVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeFermeVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"afficher"};
		$.post(	"./index.php?m=GestionProducteur&v=ListeFerme", "pParam=" + $.toJSON(lParam),
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
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		
		if(lResponse.listeFerme.length > 0 && lResponse.listeFerme[0].ferId != null) {
			var lTemplate = lGestionProducteurTemplate.listeFerme;
						
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionProducteurTemplate.listeFermeVide)));
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectDialogCreerFerme(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectDetailFerme(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]]});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}
			
	this.affectDetailFerme = function(pData) {
		var that = this;
		pData.find(".compte-ligne").click(function() {
			InformationFermeVue({id: $(this).find(".id-ferme").text()});
		});
		return pData;
	}
	
	this.affectDialogCreerFerme = function(pData) {
		var that = this;
		pData.find('#btn-nv-fer')
		.click(function() {			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogAjoutFerme;
			var lData = {dateAdhesion:getDateAujourdhuiDb().dateDbToFr()};
			
			lData = gCommunVue.comNumeric($(lTemplate.template(lData)));
			
			
			lData.dialog({			
				autoOpen: true,
				modal: true,
				draggable: true,
				resizable: false,
				width:600,
				buttons: {
					'Créer la ferme': function() {
						//var lForm = $(this).children('form').first();
						that.CreerFerme($(this));
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerFerme($(this));
				return false;
			}).find('#fer-dateAdhesion').datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: "c+1",
				yearRange: "2009:c"});			
			});		
		
		return pData;
	}
	
	this.CreerFerme = function(pForm) {
		var that = this;
		var lVo = new FermeVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.siren = pForm.find(':input[name=siren]').val();
		lVo.adresse = pForm.find(':input[name=adresse]').val();
		lVo.ville = pForm.find(':input[name=ville]').val();
		lVo.codePostal = pForm.find(':input[name=code_postal]').val();
		lVo.dateAdhesion = pForm.find(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new FermeValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "ajouter";
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=ListeFerme", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-fer").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_320_CODE;
							erreur.message = ERR_320_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							//var lParam = {vr:lVr};					
							//that.construct({vr:lVr});
							InformationFermeVue({vr:lVr,id:lResponse.id});
						} else {
							Infobulle.generer(lResponse,'fer-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'fer-');
		}
	}
	
	this.construct(pParam);
};function InformationFermeVue(pParam) {
	/*this.mIdFerm = null;
	this.mFerNumero = null;*/
	this.mFerme = {};
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {InformationFermeVue(pParam);}} );
		var that = this;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionProducteur&v=InformationFerme", "pParam=" + $.toJSON(pParam),
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
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		/*this.mIdFerme = lResponse.ferme.ferId;
		this.mferNumero = lResponse.ferme.ferNumero;*/
		
		
		
		if(lResponse.ferme[0].ferSiren == 0 ) {lResponse.ferme[0].ferSiren = "";}
		lResponse.ferme[0].ferDateAdhesion = lResponse.ferme[0].ferDateAdhesion.extractDbDate().dateDbToFr();
		
		this.mFerme = lResponse.ferme[0];
		
		$(lResponse.operationPassee).each(function() {
			this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
			if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
			if(this.opeMontant < 0) {
				this.credit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				this.debit = '';
			} else {
				this.credit = '';
				this.debit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
			}
		});
						
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lCommunTemplate = new CommunTemplate();
		
		lHtml = $(lGestionProducteurTemplate.informationFerme.template(lResponse));
				
		// Ne pas afficher la pagination si il y a moins de 10 éléments
		if(lResponse.operationPassee.length < 11) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}

		// Si on arrive de information/producteur/catalogue on ne réaffiche pas tout
		if($('#contenu-ferme').length > 0) {
			$('#contenu-ferme').replaceWith(that.affectFerme(lHtml.find('#contenu-ferme')));
			this.affectMenuFerme();
		} else {
			$('#contenu').replaceWith(that.affect(lHtml));
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectHover(pData);
		pData = this.affectDialogSuppFerme(pData);
		pData = this.affectLienRetour(pData);
		pData = this.affectEditionFerme(pData);
		pData = this.affectDate(pData);
		pData = this.affectMenu(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectFerme = function(pData) {
		pData = this.affectHover(pData);
		pData = this.affectDialogSuppFerme(pData);
		pData = this.affectEditionFerme(pData);
		pData = this.affectDate(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false}); 
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	}
		
	this.affectLienRetour = function(pData) {
		pData.find("#btn-liste-ferme").click(function() { ListeFermeVue(); });
		return pData;
	}
	
	this.affectDate = function(pData) {
		pData.find('#fer-dateAdhesion').datepicker({
			changeMonth: true,
			changeYear: true,
			maxDate: "c+1"
			});
		return pData;
	}
	
	this.affectMenu = function(pData) {
		var that = this;
		pData.find('#btn-information').click(function() { InformationFermeVue({id:that.mFerme.ferId}); });
		pData.find('#btn-liste-producteur').click(function() { ListeProducteurVue({id:that.mFerme.ferId}); });
		pData.find('#btn-catalogue').click(function() { CatalogueFermeVue({id:that.mFerme.ferId}); });

		pData.find('#btn-liste-producteur,#btn-catalogue').removeClass("ui-state-active");
		pData.find('#btn-information').addClass("ui-state-active");		
		return pData;		
	}
	
	this.affectMenuFerme = function() {
		$('#btn-liste-producteur,#btn-catalogue').removeClass("ui-state-active");
		$('#btn-information').addClass("ui-state-active");
	}
		
	this.affectEditionFerme = function(pData) {		
		var that = this;
		pData.find('#btn-edt').click(function() {
			

			$(':input[name=nom]').html(that.mFerme.ferNom);
			$(':input[name=siren]').val(htmlDecode(that.mFerme.ferSiren));
			$(':input[name=adresse]').val(htmlDecode(that.mFerme.ferAdresse));
			$(':input[name=ville]').val(htmlDecode(that.mFerme.ferVille));
			$(':input[name=code_postal]').val(htmlDecode(that.mFerme.ferCodePostal));
			$(':input[name=date_adhesion]').val(htmlDecode(that.mFerme.ferDateAdhesion));
			$(':input[name=description]').html(that.mFerme.ferDescription);
			
			$('.edt-info-ferme').toggle();
		});
		
		pData.find('#btn-edt-annuler').click(function() {
			$('.edt-info-ferme').toggle();
		});
				
		pData.find('#btn-edt-valider').click(function() {
			that.modifInformation();
		});
		
		return pData;
	}
	
	this.modifInformation = function() {
		var that = this;
		var lVo = new FermeVO();
		
		lVo.id = this.mFerme.ferId;
		lVo.nom = $(':input[name=nom]').val();
		lVo.siren = $(':input[name=siren]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.description = $(':input[name=description]').val();

		var lValid = new FermeValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {

			lVo.fonction = "modifier";
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionProducteur&v=InformationFerme", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
														
							that.mFerme.ferNom = lVo.nom;
							that.mFerme.ferSiren = lVo.siren;
							that.mFerme.ferAdresse = lVo.adresse;
							that.mFerme.ferVille = lVo.ville;
							that.mFerme.ferCodePostal = lVo.codePostal;
							that.mFerme.ferDateAdhesion = lVo.dateAdhesion.dateDbToFr();
							that.mFerme.ferDescription = lVo.description;

							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_321_CODE;
							erreur.message = ERR_321_MSG;
							lVr.log.erreurs.push(erreur);							
							
							Infobulle.generer(lVr,'');
	
							$('#nom').html(that.mFerme.ferNom);
							$('#siren').html(that.mFerme.ferSiren);
							$('#adresse').html(that.mFerme.ferAdresse);
							$('#ville').html(that.mFerme.ferVille);
							$('#codePostal').html(that.mFerme.ferCodePostal);
							$('#dateAdhesion').html(that.mFerme.ferDateAdhesion);
							$('#description').html(that.mFerme.ferDescription);
							
							$('.edt-info-ferme').toggle();
						} else {
							Infobulle.generer(lResponse,'fer-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'fer-');
		}
	}
	
	this.affectDialogSuppFerme = function(pData) {		
		var that = this;
		pData.find('#btn-supp')
		.click(function() {
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			
			$(lGestionProducteurTemplate.dialogSuppressionFerme.template({ferNumero:that.mFerme.ferNumero})).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {id:that.mFerme.ferId,fonction:"supprimer"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionProducteur&v=InformationFerme", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											
											var lVr = new TemplateVR();
											lVr.valid = false;
											lVr.log.valid = false;
											var erreur = new VRerreur();
											erreur.code = ERR_322_CODE;
											erreur.message = ERR_322_MSG;
											lVr.log.erreurs.push(erreur);
											
											ListeFermeVue({vr:lVr});
											
											$(lDialog).dialog('close');
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
	}
		
	this.construct(pParam);
};function CatalogueFermeVue(pParam) {
	this.mParam = {};
	this.mCategories = [];
	this.mProduits = [];
	this.mFiltreIdCategorie = 0;
	this.nbProduit = 0;
	this.nbCategorie = 0;
	this.mListeCategorie = {};
	this.mListeProduit = [];
	this.mInfoFormulaireProduit = null;
	this.mIdLot = 0;
	this.mIdFerme = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CatalogueFermeVue(pParam);}} );
		var that = this;
		//pParam.fonction = "afficher";
		this.mParam = $.extend(this.mParam, pParam);
		this.mParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(this.mParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mCategories = [];
						that.mProduits = [];
						that.mFiltreIdCategorie = 0;
						that.nbProduit = 0;
						that.nbCategorie = 0;
						that.mListeCategorie = {};
						that.mListeProduit = [];
						that.mInfoFormulaireProduit = null;
						that.mIdLot = 0;
						that.mIdFerme = pParam.id;
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
		this.mListeCategorie = lResponse.listeCategorie;
		
		$.each(lResponse.listeProduit,function() {
			if(that.mProduits[this.cproId]) {
				that.mProduits[this.cproId].produits.push(this);
			} else {
				that.mProduits[this.cproId] = {nom:this.cproNom,produits:[this]};
			}
			if(that.mListeProduit[this.cproNom]) {
				that.mListeProduit[this.cproNom].produits.push(this);
			} else {
				that.mListeProduit[this.cproNom] = {nom:this.cproNom,produits:[this]};
			}
		});
		var lListeProduitVide = true;
		if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].nproId != null) {
			lResponse.listeProduit = that.mListeProduit;
			lListeProduitVide = false;
		}
		
		$.each(lResponse.listeCategorie,function() {
			that.mCategories[this.cproId]=this;
		});
		
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lhtml = $(lGestionProducteurTemplate.catalogue.template(lResponse) );
		
		if(lListeProduitVide) {
			lhtml.find("#table-pro").replaceWith(lGestionProducteurTemplate.listeProduitCatalogueVide);
			this.nbProduit = 0;
		} else {
			this.nbProduit = 1;
		}
		
		if(lResponse.listeCategorie.length > 0 && lResponse.listeCategorie[0].cproId == null) {
			lhtml.find("#table-cat").replaceWith(lGestionProducteurTemplate.listeCategorieVide);
			this.nbCategorie = 0;
		} else {
			this.nbCategorie = 1;
		}
		lhtml = this.affectCategorie(lhtml);
		
		$('#contenu-ferme').replaceWith(that.affect(lhtml));
		this.affectMenu();
	};
	
	this.affect = function(pData) {
		pData = this.affectRecherche(pData);
		pData = affectProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectProduit = function(pData) {
		pData = this.affectDialogCreerProduit(pData);
		pData = this.affectModifierProduit(pData);
		pData = this.affectDialogSupprimerProduit(pData);
		pData = this.affectDetailProduit(pData);
		return pData;	
	};
	
	this.affectCategorie = function(pData) {
		if(this.nbProduit > 0) { pData = this.affectFlitreCategorie(pData);	}
		pData = this.affectTri(pData);
		pData = this.affectRechercheCategorie(pData);
		pData = this.affectDialogCreerCategorie(pData);
		pData = this.affectDialogModifierCategorie(pData);
		pData = this.affectDialogSupprimerCategorie(pData);	
		return pData;
	};
		
	this.affectMenu = function() {
		$('#btn-information,#btn-liste-producteur').removeClass("ui-state-active");
		$('#btn-catalogue').addClass("ui-state-active");		
	};
	
	this.affectTri = function(pData) {
		//pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		pData.find('#table-cat').tablesorter({sortList: [[0,0]]});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter-pro").keyup(function() {
		    $.uiTableFilter( $('#table-pro'), this.value );
		  });
		
		pData.find("#filter-form-pro").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectRechercheCategorie = function(pData) {		
		pData.find("#filter-cat").keyup(function() {
		    $.uiTableFilter( $('#table-cat'), this.value );
		  });
		
		pData.find("#filter-form-cat").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectFlitreCategorie = function(pData) {
		var that = this;
		pData.find(".ligne-cat").click(function() {
			var lIdCategorie = $(this).closest('tr').attr("id-cat");
			that.FiltreCategorie(lIdCategorie);
		});
		return pData;
	};
	
	this.FiltreCategorie = function(pIdCategorie) {
		if(this.nbProduit > 0) {
			if(this.mProduits[pIdCategorie]) {
				var lData = {listeProduit:[]};
				lData.listeProduit.push(this.mProduits[pIdCategorie]);	
				var lGestionProducteurTemplate = new GestionProducteurTemplate();	
				$('#table-pro').replaceWith(this.affect($(lGestionProducteurTemplate.listeProduitCatalogue.template(lData))));	
			} else if(pIdCategorie == 0) { // Toutes les catégories.
				var lData = {listeProduit:this.mListeProduit};
				var lGestionProducteurTemplate = new GestionProducteurTemplate();	
				$('#table-pro').replaceWith(this.affect($(lGestionProducteurTemplate.listeToutProduitCatalogue.template(lData))));	
			} else { // Pas de produit dans la catégorie
				var lGestionProducteurTemplate = new GestionProducteurTemplate();	
				var lData = this.mCategories[pIdCategorie];
				$('#table-pro').replaceWith(lGestionProducteurTemplate.listeProduitCategorieCatalogueVide.template(lData));	
			}
			$(".ligne-cat").closest('tr').removeClass("ui-state-hover");
			$("[id-cat=" + pIdCategorie + "]").closest('tr').addClass("ui-state-hover");
			
			this.mFiltreIdCategorie = pIdCategorie;
		}
	};

	this.refreshCategorie = function(pParam) {
		var that = this;
		pParam.fonction = "listeCategorie";
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mListeCategorie = lResponse.listeCategorie;
							
							that.mCategories = [];
							var lCategorieExiste = false;
							$.each(lResponse.listeCategorie,function() {
								that.mCategories[this.cproId]=this;
								if(this.cproId == that.mFiltreIdCategorie) {lCategorieExiste = true;}
							});

							var lGestionProducteurTemplate = new GestionProducteurTemplate();
							if(lResponse.listeCategorie.length > 0 && lResponse.listeCategorie[0].cproId == null) {
								$("#table-cat").replaceWith(lGestionProducteurTemplate.listeCategorieVide);
								that.nbCategorie = 0;
							} else {
								$("#div-table-cat").replaceWith(that.affectCategorie($(lGestionProducteurTemplate.listeCategorie.template(lResponse))));
								that.nbCategorie = 1;
							}
							
							if(that.nbProduit > 0) {
								if(lCategorieExiste) {
									that.FiltreCategorie(that.mFiltreIdCategorie);
								} else {
									that.FiltreCategorie(0);
								}
							}
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.refreshProduit = function(pParam) {
		var that = this;
		pParam.fonction = "listeProduit";
		pParam.id = this.mParam.id;
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							
							that.mProduits = [];
							that.mListeProduit = [];
							$.each(lResponse.listeProduit,function() {
								if(that.mProduits[this.cproId]) {
									that.mProduits[this.cproId].produits.push(this);
								} else {
									that.mProduits[this.cproId] = {nom:this.cproNom,produits:[this]};
								}
								if(that.mListeProduit[this.cproNom]) {
									that.mListeProduit[this.cproNom].produits.push(this);
								} else {
									that.mListeProduit[this.cproNom] = {nom:this.cproNom,produits:[this]};
								}
							});


							var lGestionProducteurTemplate = new GestionProducteurTemplate();
							if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].nproId != null) {
								lResponse.listeProduit = that.mProduits;
								that.nbProduit = 1;
								that.FiltreCategorie(that.mFiltreIdCategorie);
							} else {
								$("#table-pro").replaceWith(lGestionProducteurTemplate.listeProduitCatalogueVide);
								that.nbProduit = 0;
							}
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.affectDialogCreerCategorie = function(pData) {
		var that = this;
		pData.find('#btn-nv-cat')
		.click(function() {			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogAjoutCategorie;
			
			$(lTemplate.template()).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer la categorie': function() {
						var lForm = $(this).children('form').first();
						that.CreerCategorie(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerCategorie($(this));
				return false;
			});			
		});		
		return pData;
	};
	
	this.CreerCategorie = function(pForm) {
		var that = this;
		var lVo = new CategorieProduitVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new CategorieProduitValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {fonction:"ajouterCategorie",categorieProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-cat").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_317_CODE;
							erreur.message = ERR_317_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							var lParam = {vr:lVr};					
							that.refreshCategorie(lParam);
						} else {
							Infobulle.generer(lResponse,'cat-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'cat-');
		}
	};
	
	this.affectDialogModifierCategorie = function(pData) {
		var that = this;
		pData.find('.btn-modifier-cat')
		.click(function() {			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();	
			var lTemplate = lGestionProducteurTemplate.dialogAjoutCategorie;
			//var lData = that.mCategories[$(this).closest('tr').attr('id-cat')];
			
			var lId = $(this).closest('tr').attr('id-cat');
			var lParam = {id:lId,fonction:"detailCategorie"};
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {								
								$(lTemplate.template(lResponse.categorie)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: false,
									resizable: false,
									width:400,
									buttons: {
										'Modifier la categorie': function() {
											var lForm = $(this).children('form').first();
											that.ModifierCategorie(lForm);
										},
										'Annuler': function() {
											$(this).dialog('close');
										}
									},
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								}).submit(function () {
									that.ModifierCategorie($(this));
									return false;
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
	
	this.ModifierCategorie = function(pForm) {
		var that = this;
		var lVo = new CategorieProduitVO();
		
		lVo.id = pForm.find(':input[name=id]').val();
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new CategorieProduitValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {fonction:"modifierCategorie",categorieProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-cat").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_318_CODE;
							erreur.message = ERR_318_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							//var lParam = {vr:lVr};					
							//that.refreshCategorie(lParam);
							that.construct({id:that.mIdFerme,vr:lVr});						
							
						} else {
							Infobulle.generer(lResponse,'cat-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'cat-');
		}
	};
	
	this.affectDialogSupprimerCategorie = function(pData) {
		var that = this;
		pData.find('.btn-supprimer-cat')
		.click(function() {
			var lId = $(this).closest('tr').attr('id-cat');
			var lParam = {fonction:"autorisationSupprimerCategorie",id:lId};
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							if(lResponse.autorisation) {
								that.dialogSupprimerCategorie(lId);
							} else {
								lResponse.id = lId;
								that.refusSupprimerCategorie(lResponse);
							}							
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		});
		return pData;
	};
	
	this.dialogSupprimerCategorie = function(pId) {
		var that = this;
		var lGestionProducteurTemplate = new GestionProducteurTemplate();	
		var lTemplate = lGestionProducteurTemplate.dialogSupprimerCategorie;
		var lData = this.mCategories[pId];
		$(lTemplate.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Supprimer la categorie': function() {
					that.supprimerCategorie(pId);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.supprimerCategorie = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimerCategorie",id:pId};
		// Ajout
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
			function (lResponse) {		
				if(lResponse) {
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						
						$("#dialog-cat").dialog('close');
						
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_319_CODE;
						erreur.message = ERR_319_MSG;
						lVr.log.erreurs.push(erreur);
						//Infobulle.generer(lVr,'');
						var lParam = {vr:lVr};					
						that.refreshCategorie(lParam);
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.refusSupprimerCategorie = function(pResponse) {
		var that = this;
		var lGestionProducteurTemplate = new GestionProducteurTemplate();	
		var lTemplate = lGestionProducteurTemplate.dialogRefusSupprimerCategorie;
		var lData = this.mCategories[pResponse.id];
		lData.nbProduit = pResponse.nbProduit;
		$(lTemplate.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter la liste des produits': function() {
					var lParam = {fonction:"exportProduitCategorie",id:pResponse.id};
					$.download("./index.php?m=GestionProducteur&v=CatalogueFerme", lParam);
				},
				'Fermer': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.affectDialogCreerProduit = function(pData) {
		var that = this;
		pData.find('#btn-nv-pro')
		.click(function() {			
			if(that.nbCategorie == 0) {
				that.dialogProduitRefusCreation();
			} else {
				if(that.mInfoFormulaireProduit == null) {
					lParam = {fonction:'infoFomulaireProduit',id:that.mParam.id};
					$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
						function (lResponse) {		
							if(lResponse) {
								if(lResponse.valid) {
									that.mInfoFormulaireProduit = {
										listeProducteur:lResponse.listeProducteur,
										listeCaracteristique:lResponse.listeCaracteristique,
										sigleMonetaire:gSigleMonetaire
									};
									that.dialogProduit();
								} else {
									Infobulle.generer(lResponse,'pro-');
								}
							}
						},"json"
					);
				} else {
					that.dialogProduit();
				}
			}
		});		
		return pData;
	};
	
	this.dialogProduit = function() {
		var that = this;
		if(this.mInfoFormulaireProduit != null) {
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogAjoutProduit;
			
			this.mInfoFormulaireProduit.listeCategorie = this.mListeCategorie;
			this.mInfoFormulaireProduit.form_reference = lGestionProducteurTemplate.ajoutProduitReference;
			var lhtml = $(lTemplate.template(this.mInfoFormulaireProduit));
			
			if(this.mInfoFormulaireProduit.listeProducteur.length > 0 && this.mInfoFormulaireProduit.listeProducteur[0].prdtId == null) {
				lhtml.find("#pro-producteur").replaceWith(lGestionProducteurTemplate.produitListeProducteurVide);
			}
			if(this.mInfoFormulaireProduit.listeCaracteristique.length > 0 && this.mInfoFormulaireProduit.listeCaracteristique[0].carId == null) {
				lhtml.find("#pro-caracteristique").replaceWith(lGestionProducteurTemplate.listeCaracteristiqueVide);
			}
			
			lhtml = this.affectFormProduit(lhtml);
			
			$(lhtml).dialog({			
				autoOpen: true,
				modal: true,
				draggable: true,
				resizable: false,
				width:600,
				buttons: {
					'Créer': function() {
						var lForm = $(this).children('form').first();
						that.CreerProduit(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProduit($(this));
				return false;
			});
		}
	};
	
	this.affectFormProduit = function(pData) {
		pData = this.affectAjoutLot(pData);
		pData = this.affectReference(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectReference = function(pData) {
		pData.find(':input[name=reference-choix]').change(function() {
			if($(':input[name=reference-choix]:checked').val() == 1) {				
				$(":input[name=reference]").attr("disabled","").val("");
			} else {
				$(":input[name=reference]").attr("disabled","disabled").val("");
			}
		});
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
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.modeleLot;
			
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
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectAjoutLotGestion(pData);
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
		return pData;		
	};
	
	this.ajoutLotSupprimer = function(pId) {
		$("#ligne-lot-" + pId).remove();
	};
	
	this.ajoutLotModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();

		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text());
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text());
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
		} else {
			Infobulle.generer(lVr,'pro-lot-' + pId + '-');
		}
	};
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
	};
	
	this.dialogProduitRefusCreation = function() {
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lTemplate = lGestionProducteurTemplate.dialogRefusAjoutProduit;
		
		$(lTemplate).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.CreerProduit = function(pForm) {
		var that = this;
		var lVo = new NomProduitCatalogueVO();
		lVo.numero = pForm.find(':input[name=reference]').val();
		lVo.idCategorie = pForm.find(':input[name=categorie]').val();
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		pForm.find(':input[name=producteur]:checked').each(function() {
			lVo.producteurs.push($(this).val());
		});
		pForm.find(':input[name=caracteristique]:checked').each(function() {
			lVo.caracteristiques.push($(this).val());
		});		
		pForm.find('.ligne-lot').each(function() {
			var lModeleLotVO = new ModeleLotVO();			
			lModeleLotVO.quantite = $(this).find('.lot-quantite').text().numberFrToDb();
			lModeleLotVO.unite = $(this).find('.lot-unite').text();
			lModeleLotVO.prix = $(this).find('.lot-prix').text().numberFrToDb();
			
			lVo.modelesLot.push(lModeleLotVO);
		});
		
		
		var lValid = new NomProduitCatalogueValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "ajouterProduit";
			lVo.id = this.mParam.id;
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-pro").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_329_CODE;
							erreur.message = ERR_329_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							var lParam = {vr:lVr};					
							that.refreshProduit(lParam);
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
	
	this.affectDialogSupprimerProduit = function(pData) {
		var that = this;
		pData.find('.btn-supprimer-produit')
		.click(function() {
			var lId = $(this).closest('tr').attr('id-pro');
			var lData = {nom:$(this).closest('tr').find('.liste-produit-nom').text()};
			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();	
			var lTemplate = lGestionProducteurTemplate.dialogSupprimerProduit;
			
			$(lTemplate.template(lData)).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						that.supprimerProduit(lId);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			});
		});
		return pData;
	};
	
	this.supprimerProduit = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimerProduit",idNomProduit:pId};
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
			function (lResponse) {		
				if(lResponse) {
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						$("#dialog-pro").dialog('close');
						
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_331_CODE;
						erreur.message = ERR_331_MSG;
						lVr.log.erreurs.push(erreur);				
						that.refreshProduit({vr:lVr});
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.affectDetailProduit = function(pData) {
		var that = this;
		pData.find('.liste-produit-nom')
		.click(function() {		
			var lId = $(this).closest('tr').attr('id-pro');
			var lParam = {idNomProduit:lId,fonction:"detailProduit"};
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionProducteurTemplate = new GestionProducteurTemplate();	
								var lTemplate = lGestionProducteurTemplate.dialogInfoProduit;
								
								$(lResponse.produit.modelesLot).each(function() {
									if(this.mLotId != null) {
										this.mLotQuantite = this.mLotQuantite.nombreFormate(2,',',' ');
										this.mLotPrix = this.mLotPrix.nombreFormate(2,',',' ');
									}
								});

								lResponse.produit.sigleMonetaire = gSigleMonetaire;
								
								var lHtml = $(lTemplate.template(lResponse.produit));
								
								if(lResponse.produit.producteurs.length > 0 && lResponse.produit.producteurs[0].nPrdtIdNomProduit == null) {
									lHtml.find('#pro-prdt').remove();
								}
								if(lResponse.produit.caracteristiques.length > 0 && lResponse.produit.caracteristiques[0].carProIdNomProduit == null) {
									lHtml.find('#pro-car').remove();
								}
								if(lResponse.produit.modelesLot.length > 0 && lResponse.produit.modelesLot[0].mLotId == null) {
									lHtml.find('#pro-prix').remove();
								}
								
								$(lHtml).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:600,
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
	
	this.affectModifierProduit = function(pData) {
		var that = this;
		pData.find('.btn-modifier-produit')
		.click(function() {		
			var lId = $(this).closest('tr').attr('id-pro');
			that.dialogModifierProduit(lId);			
		});
		return pData;
	};
	
	this.dialogModifierProduit = function(pId) {
		var that = this;
		var lParam = {idNomProduit:pId,fonction:"infoFomulaireModifierProduit"};
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {

							var lInfoFormulaireProduit = {
									listeProducteur:lResponse.listeProducteur,
									listeCaracteristique:lResponse.listeCaracteristique,
									sigleMonetaire:gSigleMonetaire,
									idNomProduit:lResponse.produit.idNomProduit,
									nom:lResponse.produit.nom,
									numero:lResponse.produit.numero,
									description:lResponse.produit.description
								};
							
							var lGestionProducteurTemplate = new GestionProducteurTemplate();
							var lTemplate = lGestionProducteurTemplate.dialogAjoutProduit;
							
							lInfoFormulaireProduit.listeCategorie = that.mListeCategorie;
							lInfoFormulaireProduit.form_reference = lGestionProducteurTemplate.modifProduitReference.template(lInfoFormulaireProduit);
							var lhtml = $(lTemplate.template(lInfoFormulaireProduit));
							
							if(lInfoFormulaireProduit.listeProducteur.length > 0 && lInfoFormulaireProduit.listeProducteur[0].prdtId == null) {
								lhtml.find("#pro-producteur").replaceWith(lGestionProducteurTemplate.produitListeProducteurVide);
							}
							if(lInfoFormulaireProduit.listeCaracteristique.length > 0 && lInfoFormulaireProduit.listeCaracteristique[0].carId == null) {
								lhtml.find("#pro-caracteristique").replaceWith(lGestionProducteurTemplate.listeCaracteristiqueVide);
							}
							
							lhtml.find('#pro-idCategorie').selectOptions(lResponse.produit.idCategorie);
							
							$(lResponse.produit.producteurs).each(function() {
								lhtml.find('#pro-prdt-' + this.prdtId).attr("checked","checked");
							});
							
							$(lResponse.produit.caracteristiques).each(function() {
								lhtml.find('#pro-car-' + this.carId).attr("checked","checked");
							});
							
							$(lResponse.produit.modelesLot).each(function() {
								if(this.mLotId != null) {
									this.id = this.mLotId;
									this.quantite = this.mLotQuantite.nombreFormate(2,',',' ');
									this.unite = this.mLotUnite;
									this.prix = this.mLotPrix.nombreFormate(2,',',' ');
									this.sigleMonetaire = gSigleMonetaire;
									lhtml.find("#lot-liste").append(that.affectLot($(lGestionProducteurTemplate.modeleLot.template(this))));
								}
							});
														
							lhtml = that.affectFormProduit(lhtml);
							
							$(lhtml).dialog({			
								autoOpen: true,
								modal: true,
								draggable: true,
								resizable: false,
								width:600,
								buttons: {
									'Modifier': function() {
										var lForm = $(this).children('form').first();
										that.modifierProduit(lForm);
									},
									'Annuler': function() {
										$(this).dialog('close');
									}
								},
								close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
							}).submit(function () {
								that.modifierProduit($(this));
								return false;
							});				
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.modifierProduit = function(pForm) {
		var that = this;
		var lVo = new NomProduitCatalogueVO();
		lVo.numero = pForm.find(':input[name=reference]').val();
		lVo.idNomProduit = pForm.find(':input[name=id]').val();
		lVo.idCategorie = pForm.find(':input[name=categorie]').val();
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		pForm.find(':input[name=producteur]:checked').each(function() {
			lVo.producteurs.push($(this).val());
		});
		pForm.find(':input[name=caracteristique]:checked').each(function() {
			lVo.caracteristiques.push($(this).val());
		});		
		pForm.find('.ligne-lot').each(function() {
			var lModeleLotVO = new ModeleLotVO();	
			var lId = $(this).find('.lot-id').text();
			if(lId > 0) { // Uniquement si ce n'est pas un nouveau lot
				lModeleLotVO.id = lId;
			}
			lModeleLotVO.quantite = $(this).find('.lot-quantite').text().numberFrToDb();
			lModeleLotVO.unite = $(this).find('.lot-unite').text();
			lModeleLotVO.prix = $(this).find('.lot-prix').text().numberFrToDb();
			
			lVo.modelesLot.push(lModeleLotVO);
		});
		
		
		var lValid = new NomProduitCatalogueValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "modifierProduit";
			lVo.id = this.mParam.id;
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-pro").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_330_CODE;
							erreur.message = ERR_330_MSG;
							lVr.log.erreurs.push(erreur);
							var lParam = {vr:lVr};					
							that.refreshProduit(lParam);
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
	
	this.construct(pParam);
}