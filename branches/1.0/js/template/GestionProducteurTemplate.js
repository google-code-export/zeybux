;function GestionProducteurTemplate() {
	this.formulaireAjoutProducteur =
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_ajout_producteur\">" +
				"<form>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Information du producteur</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nom *</th>" +
									"<td class=\"com-table-form-td\">" +
										"<input type=\"hidden\" name=\"{NAME_ID}\" value=\"{VALUE_ID}\" />" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" value=\"{nom}\" maxlength=\"50\" id=\"nom\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Prénom *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prenom\" value=\"{prenom}\" maxlength=\"50\" id=\"prenom\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Date de Naissance (jj/mm/aaaa)</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_naissance\" value=\"{dateNaissance}\" maxlength=\"10\" id=\"dateNaissance\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Lier un compte<input type=\"checkbox\" name=\"lien_numero_compte\" /></th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"numero_compte\" value=\"{compte}\" maxlength=\"5\" disabled=\"disabled\" id=\"compte\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Commentaire</th>" +
									"<td class=\"com-table-form-td\"><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"commentaire\" id=\"commentaire\">{commentaire}</textarea></td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
					
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées du producteur</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Courriel Principal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"courriel_principal\" value=\"{courrielPrincipal}\" maxlength=\"100\" id=\"courrielPrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Courriel Secondaire</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" ype=\"text\" name=\"courriel_secondaire\" value=\"{courrielSecondaire}\" maxlength=\"100\" id=\"courrielSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Téléphone Principal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_principal\" value=\"{telephonePrincipal}\" maxlength=\"20\" id=\"telephonePrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Téléphone Secondaire</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_secondaire\" value=\"{telephoneSecondaire}\" maxlength=\"20\" id=\"telephoneSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Adresse</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"adresse\" value=\"{adresse}\" maxlength=\"300\" id=\"adresse\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Code Postal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"code_postal\" value=\"{codePostal}\" maxlength=\"10\" id=\"codePostal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Ville</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"ville\" value=\"{ville}\" maxlength=\"100\" id=\"ville\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<td colspan=\"2\" class=\"com-center com-ligne-submit\">" +
										"<input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Valider\" />" +
									"</td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.ajoutProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Nouveau Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.modifierProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification d'un Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été mis à jour avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.supprimerProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Suppression d'un Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été supprimé avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeProducteur = 
		"<div id=\"contenu\">" +
			"<div>" +			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Producteurs</div>" +
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
								"</tr>" +
							"</thead>" +
							"<tbody>" +
						"<!-- BEGIN listeProducteur -->" +
								"<tr class=\"com-cursor-pointer compte-ligne\" >" +
									"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-producteur\">{listeProducteur.prdtId}</span>{listeProducteur.prdtNumero}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtNom}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtPrenom}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtCourrielPrincipal}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtTelephonePrincipal}</td>" +
								"</tr>" +
						"<!-- END listeProducteur -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeProducteurVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Producteurs</div>" +
				"<p id=\"texte-liste-vide\">Aucun producteur dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogSuppressionProducteur = 
		"<div id=\"dialog-supp-prdt\" title=\"Supprimer le producteur {prdtNumero}\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer le producteur : {prdtNumero}</p>" +
		"</div>";
	
	this.infoCompteProducteur = 
		"<div id=\"info_compte_solde_adherent_ext\">" +
			"<div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer\" id=\"btn-supp\" title=\"Supprimer\">" +
							"<span class=\"ui-icon ui-icon-trash\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer\" id=\"btn-edt\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Numéro du producteur : {prdtNumero}</div>" +
						"<div>Numéro de Compte : {cptLabel}</div>" +
						"<div>Nom : {prdtNom}</div>" +
						"<div>Prénom : {prdtPrenom}</div>" +
						"<div>Date de naissance : {prdtDateNaissance}</div>" +
						"<div>Commentaire : {prdtCommentaire}</div>" +
					"</div>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Courriel Principal : {prdtCourrielPrincipal}</div>" +
						"<div>Courriel Secondaire : {prdtCourrielSecondaire}</div>" +
						"<div>Téléphone Principal : {prdtTelephonePrincipal}</div>" +
						"<div>Téléphone Secondaire : {prdtTelephoneSecondaire}</div>" +
						"<div>Adresse : {prdtAdresse}</div>" +				
						"<div>Ville : {prdtVille}</div>" +
						"<div>Code Postal : {prdtCodePostal}</div>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeOperationProducteur = 
		"<div id=\"liste_operation_adherent_ext\">" +
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
				"<span class=\"com-cursor-pointer ui-widget-header ui-corner-tl ui-state-active\">Informations</span>" +
				"<span class=\"com-cursor-pointer ui-widget-header com-btn-hover\" id=\"btn-liste-producteur\" >Producteurs</span>" +
				"<span class=\"com-cursor-pointer ui-widget-header ui-corner-tr com-btn-hover\" id=\"btn-catalogue\" >Catalogue</span>" +
			"</div>" +
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
			//"<div id=\"liste_operation_adherent_ext\">" +
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
				//"</div>" +
			"</div>" +
		"</div>";
			
	this.dialogSuppressionFerme = 
		"<div id=\"dialog-supp-ferme\" title=\"Supprimer la ferme {ferNumero}\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer la ferme : {ferNumero}</p>" +
		"</div>";
}