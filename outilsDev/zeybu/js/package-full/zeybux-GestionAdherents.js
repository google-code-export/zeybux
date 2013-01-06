;function GestionAdherentsTemplate() {
	this.formulaireAjoutAdherent =
		"<div id=\"contenu\">" +	
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-retour\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour" +
				"</button>" +
			"</div>" +	
			"<div id=\"formulaire_modifier_adherent_int\">" +
				"<form>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\" id=\"div-info-adherent\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Information</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Nom *</th>" +
									"<td class=\"com-table-form-td\">" +
										"<input type=\"hidden\" name=\"{NAME_ID}\" value=\"{VALUE_ID}\" />" +
										"<input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"nom\" value=\"{adhNom}\" maxlength=\"50\" id=\"nom\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Prénom *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"prenom\" value=\"{adhPrenom}\" maxlength=\"50\" id=\"prenom\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Date de Naissance</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"date_naissance\" value=\"{adhDateNaissance}\" maxlength=\"10\" id=\"dateNaissance\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Date d'adhésion *</th>" +
									"<td class=\"com-table-form-td\"> <input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"date_adhesion\" value=\"{adhDateAdhesion}\" maxlength=\"10\" id=\"dateAdhesion\" /></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\" id=\"compte\">Compte</th>" +
									"<td class=\"com-table-form-td\">" +
										"{formCompte}" +
										/*"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"numero_compte\" value=\"{compte}\" maxlength=\"5\" disabled=\"disabled\" id=\"compte\"/></td>" +*/
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Commentaire</th>" +
									"<td class=\"com-table-form-td\"><textarea class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" name=\"commentaire\" id=\"commentaire\">{adhCommentaire}</textarea></td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
					
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\" id=\"div-coord-adherent\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Courriel 1</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"courriel_principal\" value=\"{adhCourrielPrincipal}\" maxlength=\"100\" id=\"courrielPrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Courriel 2</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" ype=\"text\" name=\"courriel_secondaire\" value=\"{adhCourrielSecondaire}\" maxlength=\"100\" id=\"courrielSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Téléphone 1</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"telephone_principal\" value=\"{adhTelephonePrincipal}\" maxlength=\"20\" id=\"telephonePrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Téléphone 2</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"telephone_secondaire\" value=\"{adhTelephoneSecondaire}\" maxlength=\"20\" id=\"telephoneSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Adresse</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"adresse\" value=\"{adhAdresse}\" maxlength=\"300\" id=\"adresse\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Code Postal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"code_postal\" value=\"{adhCodePostal}\" maxlength=\"10\" id=\"codePostal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Ville</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"ville\" value=\"{adhVille}\" maxlength=\"100\" id=\"ville\"/></td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
					"{autorisation}" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all com-center\" id=\"div-submit-ajout-adherent\">" +
						"<input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Valider\" />" +
					"</div>" +
					/*"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all com-center com-ligne-submit\">" +
							"<input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Valider\" />" +
						"</div>" +
						"<div class=\"com-widget-content\">" +
							"<table id=\"formulaire-modifier-adherent-table-autorisation\" class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Modules autorisés</th>" +
							"<!-- BEGIN modules_default -->" +								
									"<input type=\"hidden\" name=\"modules_default[]\" value=\"{modules_default.id}\"/>" +
							"<!-- END modules_default -->" +
								"</tr>" +
								
							"<!-- BEGIN modules -->" +
								"<tr class=\"ui-widget-content\" >" +
									"<td class=\"com-table-form-td\" ><input type=\"checkbox\" name=\"modules[]\" value=\"{modules.id}\" {modules.checked}/>{modules.label}</td>" +
								"</tr>" +
							"<!-- END modules -->" +
								"<tr>" +
									"<td class=\"com-center com-ligne-submit\">" +
										"<input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Valider\" />" +
									"</td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +*/
				"</form>" +
			"</div>" +
		"</div>";
	
	this.formulaireCompteAjoutAdherent =
		"<input type=\"radio\" name=\"choix_compte\" value=\"auto\" checked=\"checked\"/> Automatique <br/>" +
		"<input type=\"radio\" name=\"choix_compte\" value=\"lier\" /> Lier <span class=\"ui-helper-hidden\" id=\"label_compte_lier\"></span> " +
		"<span class=\"ui-helper-hidden ui-state-default ui-corner-all com-button com-center\" id=\"choix_compte_liaison\">Choisir</span>";
	
	this.formulaireCompteModificationAdherent =
		"<input type=\"radio\" name=\"choix_compte\" value=\"actuel\" checked=\"checked\"/> Actuel {cptLabel} <br/>" +
		"<input type=\"radio\" name=\"choix_compte\" value=\"auto\"/> Nouveau" +
		"<input type=\"radio\" name=\"choix_compte\" value=\"lier\" /> Lier <span class=\"ui-helper-hidden\" id=\"label_compte_lier\"></span> " +
		"<span class=\"ui-helper-hidden ui-state-default ui-corner-all com-button com-center\" id=\"choix_compte_liaison\">Choisir</span>";
	
	this.formulaireAutorisationAdherent =
		"<div class=\"com-clear-float-left com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Autorisations" +
				"<span class=\"com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all com-cursor-pointer\" id=\"btn-toggle-autorisation\">" +
					"<span class=\"ui-icon ui-icon-triangle-1-s\">" +
				"</span>" +
			"</span>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +
				"<table id=\"formulaire-modifier-adherent-table-autorisation\" class=\"com-table-form\">" +					
				"<!-- BEGIN modules -->" +
					"<tr class=\"ui-widget-content ui-widget-content-transparent\" >" +
						"<td class=\"com-table-form-td\" ><input type=\"checkbox\" name=\"modules[]\" value=\"{modules.id}\" {modules.checked}/>{modules.label}</td>" +
					"</tr>" +
				"<!-- END modules -->" +
				"</table>" +
			"</div>" +
		"</div>";
	
	/*this.ajoutAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Nouvel Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";*/
	
	/*this.modifierAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification d'Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été mis à jour avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";*/
	
	/*this.supprimerAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Suppression d'Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été supprimé avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";*/
	
	this.dialogListeAdherent = 
		"<div id=\"dialog-liste-adherent\" title=\"Adhérents\">" +
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
						"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
						"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
						"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer marche-com-th-nom\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
						"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
						"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN listeAdherent -->" +
						"<tr class=\"com-cursor-pointer compte-ligne\" data-id-compte=\"{listeAdherent.adhIdCompte}\" data-label-compte=\"{listeAdherent.cptLabel}\">" +
							"<td class=\"com-table-td-debut com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeAdherent.adhIdTri}</span>" +
								"{listeAdherent.adhNumero}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeAdherent.cptIdTri}</span>" +
								"{listeAdherent.cptLabel}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhNom}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhPrenom}</td>" +
							"<td class=\"com-table-td-fin\">" +
								"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
				"<!-- END listeAdherent -->" +
					"</tbody>" +
				"</table>" +
		"</div>";	
	
	this.listeAdherent = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"{totalAdherent}" +
						"<span class=\"com-btn-header-text ui-widget-content ui-corner-all\" id=\"btn-nv-adherent\" title=\"Ajouter un adhérent\">" +
							"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
							"</span>Ajouter" +
						"</span>" +
					"</div>" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-widget-content-transparent ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-cpt com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
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
									"{listeAdherent.adhNumero}</td>" +
								"<td class=\"com-table-td-med com-underline-hover\">" +
									"<span class=\"ui-helper-hidden\">{listeAdherent.cptIdTri}</span>" +
									"{listeAdherent.cptLabel}</td>" +
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
		"</div>";
	
	this.listeAdherentVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Les adhérents" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all\" id=\"btn-nv-adherent\" title=\"Ajouter un adhérent\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucun adhérent dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogSuppressionAdherent =
	"<div id=\"dialog-supp-adh\" title=\"Supprimer l'adhérent {adhNumero}\">" +
		"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer l'adherent : {adhNumero}</p>" +
	"</div>";
	
	this.infoCompteAdherentDebut =		
		"<div class=\"com-barre-menu-2\">" +
			"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-retour\">" +
				"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour" +
			"</button>" +
		"</div>" +		
		"<div id=\"info_compte_solde_adherent_ext\">" +
			"<div id=\"info_compte_solde_adherent_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all com-cursor-pointer\" id=\"btn-supp\" title=\"Supprimer\">" +
							"<span class=\"ui-icon ui-icon-trash\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all com-cursor-pointer\" id=\"btn-edt\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Numéro d'adhérent : {adhNumero}</div>" +
						"<div>Numéro de Compte : {cptLabel}</div>" +
						"<div>Nom : {adhNom}</div>" +
						"<div>Prénom : {adhPrenom}</div>" +
						"<div>Date de naissance : {adhDateNaissance}</div>" +
						"<div>Date d'adhésion : {adhDateAdhesion}</div>" +
						"<div>Commentaire : {adhCommentaire}</div>" +
					"</div>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Courriel Principal : {adhCourrielPrincipal}</div>" +
						"<div>Courriel Secondaire : {adhCourrielSecondaire}</div>" +
						"<div>Téléphone Principal : {adhTelephonePrincipal}</div>" +
						"<div>Téléphone Secondaire : {adhTelephoneSecondaire}</div>" +
						"<div>Adresse : {adhAdresse}</div>" +				
						"<div>Ville : {adhVille}</div>" +
						"<div>Code Postal : {adhCodePostal}</div>" +
					"</div>" +
				"</div>";
				
	this.infoCompteAdherentAutorisation = 
				"<div id=\"info_compte_autorisations_int\">" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Autorisations</div>" +
						"<div class=\"com-widget-content\">" +
							"<!-- BEGIN modules -->" +
								"<div><span class=\"com-float-left ui-icon {modules.classAutorisation}\"></span>{modules.label}</div>" +
							"<!-- END modules -->" +
						"</div>" +
					"</div>" +
				"</div>";
	
	
	this.infoCompteAdherentFin = 		
			"</div>" +
		"</div>";
		
	this.listeOperationPassee = 
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Solde : <span id=\"solde\">{opeMontant} {sigleMonetaire}</span></div>	" +	
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
		
	this.listeOperationAdherentDebut = 
		"<div id=\"liste_operation_adherent_ext\">" +
			"<div id=\"liste_operation_adherent_int\">";
				
	this.listeOperationAdherentFin = 		
			"</div>" +
		"</div>";	
		
	this.listeOperationAvenir = 
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat(s) Futur(s)</div>" +
				"<div>" +
					"<table class=\"com-table\">" +
						"<tr class=\"ui-widget ui-widget-header\" >" +
							"<th class=\"com-table-th\">Réservation</th>" +
							"<th class=\"com-table-th\">Libellé</th>" +
							"<th class=\"com-table-th\">Marché</th>" +
							"<th class=\"com-table-th\">Prix</th>" +
							"<th class=\"com-table-th\">Solde</th>" +
							"<th class=\"com-table-th\">Recharger</th>" +
						"</tr>" +
					"<!-- BEGIN operationAvenir -->" +
						"<tr>" +
							"<td class=\"com-table-td td-date\">{operationAvenir.opeDate}</td>" +
							"<td class=\"com-table-td td-libelle \">{operationAvenir.opeLibelle}</td>" +
							"<td class=\"com-table-td td-date\">{operationAvenir.comDateMarche}</td>" +
							"<td class=\"com-table-td td-montant\">{operationAvenir.opeMontant}  {sigleMonetaire}</td>" +
							"<td class=\"com-table-td td-montant\"><span class=\"nouveau-solde\"><span class=\"nouveau-solde-val\">{operationAvenir.nouveauSolde}</span>  {sigleMonetaire}</span></td>" +
							"<td class=\"com-table-td td-montant\">{operationAvenir.rechargement}  {sigleMonetaire}</td>" +
						"</tr>" +
					"<!-- END operationAvenir -->" +
					"</table>" +
				"</div>" +
			"</div>";
};function AjoutAdherentVue(pParam) {
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {AjoutAdherentVue(pParam);}} );
		this.afficher();
	};
	
	this.afficher = function() {
		var that = this;		
		var lData = {adhDateAdhesion: getDateAujourdhuiDb().dateDbToFr()};
		
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		lData.formCompte = lGestionAdherentsTemplate.formulaireCompteAjoutAdherent;
		var lTemplate = lGestionAdherentsTemplate.formulaireAjoutAdherent;
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));
	};
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.affectChoixGenerationCompte(pData);
		pData = this.affectLienRetour(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#lien-retour").click(function() { ListeAdherentVue(); });
		return pData;
	};
	
	this.affectChoixGenerationCompte = function(pData) {
		pData.find('[name="choix_compte"]').change(function() {
			var lVal = $(this).val();
			if(lVal == "auto") {
				$('#choix_compte_liaison').hide();
				$('#label_compte_lier').hide().text('').attr('data-id-compte','');
			} else {
				$('#choix_compte_liaison, #label_compte_lier').show();
			}
		});
		return pData;
	};
	
	this.boutonLienCompte = function(pData) {		
		var that = this;
		pData.find("#choix_compte_liaison").click(function() {that.dialogListeAdherent();});
		return pData;
	};
		
	this.dialogListeAdherent = function() {
		var that = this;
		
		// Sélection du compte adhérent à sélectionner
		var lVo = {fonction:"listeAdherent"};
		$.post(	"./index.php?m=GestionAdherents&v=AjoutAdherent", "pParam=" + $.toJSON(lVo),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {	
						var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
						var lTemplate = lGestionAdherentsTemplate.dialogListeAdherent;
						
						$.each(lResponse.listeAdherent,function() {
							this.adhIdTri = this.adhNumero.replace("Z","");
							this.cptIdTri = this.cptLabel.replace("C","");
						});
						
						$(that.affectDialoglisteAdherent($(lTemplate.template(lResponse)))).dialog({			
							autoOpen: true,
							modal: true,
							draggable: true,
							resizable: false,
							width:900,
							buttons: {
								'Fermer': function() {
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
	
	this.affectDialoglisteAdherent = function(pData) {
		pData = this.affectSelectCompte(pData);
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		return pData;
	};
	
	this.affectSelectCompte = function(pData) {
		pData.find('.compte-ligne').click(function() {
			$('#label_compte_lier')
				.text($(this).attr('data-label-compte'))
				.attr("data-id-compte",$(this).attr('data-id-compte'));
				$('#dialog-liste-adherent').dialog('close');
		});
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
	
	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateNaissance','dateAdhesion',pData);
		pData.find('#dateNaissance').datepicker( "option", "yearRange", '1900:c' );
		pData.find('#dateAdhesion').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	};
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.ajoutAdherent();
			return false;
		});
		return pData;
	};
	
	this.ajoutAdherent = function() {
		var lVo = new AdherentVO();
		//lVo.compte = $(':input[name=numero_compte]').val();
		if( $(':input[name=choix_compte]:checked').val() == 'auto') {
			lVo.idCompte = 0;
		} else {
			lVo.idCompte = $('#label_compte_lier').attr("data-id-compte");
		}		
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		//$(':input[name=modules[]]:checked').each(function() { lVo.modules.push($(this).val()); });
		//$(':input[name=modules_default[]]').each(function() { lVo.modules.push($(this).val()); });
		
		lVo.fonction = "ajouter";
		
		var lValid = new AdherentValid();
		var lVr = lValid.validAjout(lVo);

		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionAdherents&v=AjoutAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							/*var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
							var lTemplate = lGestionAdherentsTemplate.ajoutAdherentSucces;
							$('#contenu').replaceWith(lTemplate.template(lResponse));	*/	
							
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_355_CODE;
							erreur.message = ERR_355_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);
							
							CompteAdherentVue({id: lResponse.id,vr:lVR});
							
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
	
	this.construct(pParam);
};function CompteAdherentVue(pParam) {
	this.mIdAdherent = null;
	this.mAdhNumero = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CompteAdherentVue(pParam);}} );
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionAdherents&v=CompteAdherent", "pParam=" + $.toJSON(pParam),
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
		
		this.mIdAdherent = lResponse.adherent.adhId;
		this.mAdhNumero = lResponse.adherent.adhNumero;
		
		lResponse.opeMontant = lResponse.adherent.cptSolde.nombreFormate(2,',',' ');
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		lResponse.adherent.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lResponse.adherent.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		
		$(lResponse.operationPassee).each(function() {
			this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
			if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
			if(this.opeMontant < 0) {
				this.debit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				this.credit = '';
			} else {
				this.debit = '';
				this.credit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
			}
		});
		
		var lNvSolde = parseFloat(lResponse.adherent.cptSolde);
		var lRechargementPrecedent = 0;
		$(lResponse.operationAvenir).each(function() {
			if(this.opeDate != null) {
				lNvSolde += parseFloat(this.opeMontant);
				this.nouveauSolde = lNvSolde.nombreFormate(2,',',' ');
				this.rechargement = (0).nombreFormate(2,',',' ');				
				var lSoldeCible = 5;
				if(lNvSolde < lSoldeCible) {
					this.rechargement = (Math.ceil((lSoldeCible-lNvSolde)/lSoldeCible) * lSoldeCible) - lRechargementPrecedent;
				}
				lRechargementPrecedent += this.rechargement;
				this.rechargement = this.rechargement.nombreFormate(2,',',' ');
				
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.comDateMarche = this.comDateMarche.extractDbDate().dateDbToFr();
				this.opeMontant = (this.opeMontant * -1).nombreFormate(2,',',' ');
			}
		});	
		
		$(lResponse.modules).each(function() {
			//alert(this.nom);
			var that = this;
			this.classAutorisation = "ui-icon-closethick";
			$(lResponse.autorisations).each(function() {
				if(this.idModule == that.id) {
					that.classAutorisation = "ui-icon-check";
				}
			});
		});		
				
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		var lCommunTemplate = new CommunTemplate();
		//var lTemplate = lMonCompteTemplate.monCompte;
		
		var lHtml = lCommunTemplate.debutContenu;		
		lHtml += lGestionAdherentsTemplate.infoCompteAdherentDebut.template(lResponse.adherent);
		lHtml += lGestionAdherentsTemplate.infoCompteAdherentAutorisation.template(lResponse);
		lHtml += lGestionAdherentsTemplate.infoCompteAdherentFin.template(lResponse);
		lHtml += lGestionAdherentsTemplate.listeOperationAdherentDebut.template(lResponse);
		lHtml += lGestionAdherentsTemplate.listeOperationPassee.template(lResponse);
		// Affiche des opérations avenir uniquement si elles existent
		if(isArray(lResponse.operationAvenir) && lResponse.operationAvenir[0].opeLibelle != null) {
			lHtml += lGestionAdherentsTemplate.listeOperationAvenir.template(lResponse);
		}
		lHtml += lGestionAdherentsTemplate.listeOperationAdherentFin.template(lResponse);
		lHtml += lCommunTemplate.finContenu;
		
		lHtml = $(lHtml);
		if(lResponse.adherent.cptSolde < 0) {
			lHtml = this.soldeNegatif(lHtml);
		}
		
		// Ne pas afficher la pagination si il y a moins de 10 éléments
		if(lResponse.operationPassee.length < 11) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}		

		$('#contenu').replaceWith(that.affect(lHtml));	
	};
	
	this.affect = function(pData) {
		pData = this.nouveauSoldeNegatif(pData);
		pData = this.affectHover(pData);
		pData = this.affectLienModifier(pData);
		pData = this.affectDialogSuppAdherent(pData);
		pData = this.affectRetour(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
		
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
	};
	
	this.nouveauSoldeNegatif = function(pData) {
		pData.find('.nouveau-solde-val').each(function() {
			if(parseFloat($(this).text().numberFrToDb()) < 0 ) {
				$(this).closest('.nouveau-solde').addClass("com-nombre-negatif");
			}
		});
		return pData;
	};
	
	this.soldeNegatif = function(pData) {
		pData.find('#solde').addClass("com-nombre-negatif");
		return pData;
	};
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	};
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	};
	
	this.affectLienModifier = function(pData) {
		var that = this;
		pData.find('#btn-edt').click(function() {			
			ModificationAdherentVue({id:that.mIdAdherent});
		});
		return pData;
	};
	
	this.affectDialogSuppAdherent = function(pData) {
		var that = this;
		pData.find("#btn-supp").click(function() {
			var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
			var lTemplate = lGestionAdherentsTemplate.dialogSuppressionAdherent;
			
			$(lTemplate.template({adhNumero:that.mAdhNumero})).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
					/*	var lParam = {id:that.mIdAdherent};*/
						var lVo = new AdherentVO();
						lVo.id = that.mIdAdherent;
						lVo.fonction = 'supprimer';
						
						var lValid = new AdherentValid();
						var lVr = lValid.validDelete(lVo);
						
						var lDialog = this;
						if(lVr.valid) {
							Infobulle.init(); // Supprime les erreurs

							$.post(	"./index.php?m=GestionAdherents&v=SuppressionAdherent", "pParam=" + $.toJSON(lVo),
									function(lResponse) {
										Infobulle.init(); // Supprime les erreurs
										if(lResponse) {
											if(lResponse.valid) {
												/*var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
												var lTemplate = lGestionAdherentsTemplate.supprimerAdherentSucces;
												$('#contenu').replaceWith(lTemplate.template(lResponse));
												$(lDialog).dialog('close');*/
												
												var lVR = new Object();
												var erreur = new VRerreur();
												erreur.code = ERR_357_CODE;
												erreur.message = ERR_357_MSG;
												lVR.valid = false;
												lVR.log = new VRelement();
												lVR.log.valid = false;
												lVR.log.erreurs.push(erreur);
												
												ListeAdherentVue({vr:lVR});
												
												$(lDialog).dialog('close');
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
				close: function(ev, ui) { $(this).remove(); }
				
			});
		});
		return pData;
	};
	
	this.affectRetour = function(pData) {
		pData.find("#lien-retour").click(function() { ListeAdherentVue();});
		return pData;
	};
		
	this.construct(pParam);
};function ListeAdherentVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeAdherentVue(pParam);}} );
		var that = this;
		var lVo = {fonction:"afficher"};
		$.post(	"./index.php?m=GestionAdherents&v=ListeAdherent", "pParam=" + $.toJSON(lVo),
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
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		
		if(lResponse.listeAdherent.length > 0 && lResponse.listeAdherent[0].adhId != null) {
			var lTemplate = lGestionAdherentsTemplate.listeAdherent;
			
			lResponse.sigleMonetaire = gSigleMonetaire;
			$(lResponse.listeAdherent).each(function() {
				this.classSolde = '';
				if(this.cptSolde < 0){this.classSolde = "com-nombre-negatif";}
				this.cptSolde = this.cptSolde.nombreFormate(2,',',' ');
				this.adhIdTri = this.adhNumero.replace("Z","");
				this.cptIdTri = this.cptLabel.replace("C","");
			});
			
			if(lResponse.listeAdherent.length == 1) {
				lResponse.totalAdherent = "L'adhérent";
			} else {
				lResponse.totalAdherent = "Les " + lResponse.listeAdherent.length + " adhérents";
			}
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionAdherentsTemplate.listeAdherentVide)));
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		pData = this.affectAjoutAdherent(pData);
		return pData;
	};

	this.affectAjoutAdherent = function(pData) {
		pData.find('#btn-nv-adherent').click(function() {
			AjoutAdherentVue();
		});
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 5: {sorter: false} }});
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
			CompteAdherentVue({id: $(this).attr("id-adherent")});
		});
		return pData;
	};
	
	this.construct(pParam);
};function ModificationAdherentVue(pParam) {
	this.mIdAdherent = null;
	this.mIdCompte = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ModificationAdherentVue(pParam);}} );
		var that = this;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mIdAdherent = pParam.id;
							that.mIdCompte = lResponse.adherent.adhIdCompte;
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
		//var lData = lResponse;
		//var lModules = [];
		/*$(lResponse.modules).each(function() {
			if(this.defaut == 1) {
				lModules_default.push(this);
			} else {
				lModules.push(this);
			}
		});*/
		//lData.modules_default = lModules_default;
		var lData = lResponse.adherent;		
		lData.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		lData.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lData.modules = lResponse.modules;
		
		$(lResponse.autorisations).each(function() {
			var lIdModule = this.idModule;
			$(lData.modules).each(function() {
				if(this.id == lIdModule) {
					this.checked = "checked=\"checked\"";
				}
			});
		});		
		

		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		
		lData.formCompte = lGestionAdherentsTemplate.formulaireCompteModificationAdherent.template(lData);
		lData.autorisation = lGestionAdherentsTemplate.formulaireAutorisationAdherent.template(lData);		
		var lTemplate = lGestionAdherentsTemplate.formulaireAjoutAdherent;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));
	};
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.affectRetour(pData);
		pData = this.toggleAutorisation(pData);
		pData = this.affectChoixGenerationCompte(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectChoixGenerationCompte = function(pData) {
		pData.find('[name="choix_compte"]').change(function() {
			var lVal = $(this).val();
			if(lVal == "lier") {
				$('#choix_compte_liaison, #label_compte_lier').show();
			} else {
				$('#choix_compte_liaison').hide();
				$('#label_compte_lier').hide().text('').attr('data-id-compte','');
			}
		});
		return pData;
	};
	
	this.boutonLienCompte = function(pData) {		
		var that = this;
		pData.find("#choix_compte_liaison").click(function() {that.dialogListeAdherent();});
		return pData;
	};
		
	this.dialogListeAdherent = function() {
		var that = this;
		
		// Sélection du compte adhérent à sélectionner
		var lVo = {fonction:"listeAdherent"};
		$.post(	"./index.php?m=GestionAdherents&v=AjoutAdherent", "pParam=" + $.toJSON(lVo),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {	
						var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
						var lTemplate = lGestionAdherentsTemplate.dialogListeAdherent;
						
						$.each(lResponse.listeAdherent,function() {
							this.adhIdTri = this.adhNumero.replace("Z","");
							this.cptIdTri = this.cptLabel.replace("C","");
						});
						
						$(that.affectDialoglisteAdherent($(lTemplate.template(lResponse)))).dialog({			
							autoOpen: true,
							modal: true,
							draggable: true,
							resizable: false,
							width:900,
							buttons: {
								'Fermer': function() {
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
	
	this.affectDialoglisteAdherent = function(pData) {
		pData = this.affectSelectCompte(pData);
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		return pData;
	};
	
	this.affectSelectCompte = function(pData) {
		pData.find('.compte-ligne').click(function() {
			$('#label_compte_lier')
				.text($(this).attr('data-label-compte'))
				.attr("data-id-compte",$(this).attr('data-id-compte'));
				$('#dialog-liste-adherent').dialog('close');
		});
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
	
	this.toggleAutorisation = function(pData) {
		pData.find('#formulaire-modifier-adherent-table-autorisation').hide();
		pData.find('#btn-toggle-autorisation').click(function() {
			$(this).find('span').toggleClass('ui-icon-triangle-1-s').toggleClass('ui-icon-triangle-1-n');
			$('#formulaire-modifier-adherent-table-autorisation').toggle();
		});
		return pData;
	};
		
	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateNaissance','dateAdhesion',pData);
		pData.find('#dateNaissance').datepicker( "option", "yearRange", '1900:c' );
		pData.find('#dateAdhesion').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	};
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.modifAdherent();
			return false;
		});
		return pData;
	};
	
	this.modifAdherent = function() {
		var lVo = new AdherentVO();
		lVo.id = this.mIdAdherent;
		/*lVo.compte = $(':input[name=numero_compte]').val();*/
		var lChoixCompte = $(':input[name=choix_compte]:checked').val();
		if(lChoixCompte == 'actuel' ) {
			lVo.idCompte = this.mIdCompte;
		} else if ( lChoixCompte == 'auto') {
			lVo.idCompte = 0;
		} else {
			lVo.idCompte = $('#label_compte_lier').attr("data-id-compte");
		}
				
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		$(':input[name=modules[]]:checked').each(function() {lVo.modules.push($(this).val());});
		//$(':input[name=modules_default[]]').each(function() {lVo.modules.push($(this).val());});

		var lValid = new AdherentValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			lVo.fonction = 'modifier';
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							/*var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
							var lTemplate = lGestionAdherentsTemplate.modifierAdherentSucces;
							$('#contenu').replaceWith(lTemplate.template(lResponse));		*/		
							
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_356_CODE;
							erreur.message = ERR_356_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);
							
							CompteAdherentVue({id: lResponse.id,vr:lVR});
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
	
	this.affectRetour = function(pData) {
		var that = this;
		pData.find("#lien-retour").click(function() { CompteAdherentVue({id: that.mIdAdherent});});
		return pData;
	};
	
	this.construct(pParam);
}