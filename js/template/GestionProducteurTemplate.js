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
}