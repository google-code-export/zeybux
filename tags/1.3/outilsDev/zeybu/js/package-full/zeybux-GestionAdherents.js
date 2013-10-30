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
									"<td id=\"btn-radio-compte\" class=\"com-table-form-td\">" +
										"{formCompte}" +
										"<span class=\"ui-helper-hidden ui-state-default ui-corner-all com-button com-center\" id=\"choix_compte_liaison\">Choisir</span>" +
									"</td>" +
								"</tr>" +
								"<tr id=\"ligne-adherent-principal\">" +
									"{formAdherentPrincipal}" +
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
				"</form>" +
			"</div>" +
		"</div>";
	
	this.ligneAdherentPrincipal = 
		"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all\">Adherent Principal</th>" +
		"<td class=\"com-table-form-td\">" +
			"{adherentPrincipal}" +
		"</td>";
	
	this.dialogNvAncienAdhPrincipal = 
		"<div id=\"dialog-liste-adherent\" title=\"Nouvel adhérent Principal du compte {cptLabel}\">" +
				"{adherentPrincipal}" +
		"</div>";	
	
	this.formulaireCompteAjoutAdherent =
		"<input type=\"radio\" name=\"choix_compte\" value=\"auto\" id=\"btn-auto\" checked=\"checked\"/><label for=\"btn-auto\">Automatique</label> <br/>" +
		"<input type=\"radio\" name=\"choix_compte\" value=\"lier\" id=\"btn-lier\"/><label for=\"btn-lier\">Lier</label>  <span class=\"ui-helper-hidden\" id=\"label_compte_lier\"></span> ";
	
	this.formulaireCompteModificationAdherent =
		"<input type=\"radio\" name=\"choix_compte\" value=\"actuel\" checked=\"checked\"/> Actuel {cptLabel} <br/>" +
		"<input type=\"radio\" name=\"choix_compte\" value=\"auto\"/> Nouveau" +
		"<input type=\"radio\" name=\"choix_compte\" value=\"lier\" /> Lier <span class=\"ui-helper-hidden\" id=\"label_compte_lier\"></span>";
	
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
						"<tr class=\"com-cursor-pointer compte-ligne\" data-id-compte=\"{listeAdherent.adhIdCompte}\" data-label-compte=\"{listeAdherent.cptLabel}\" data-id=\"{listeAdherent.adhId}\">" +
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
					"<span class=\"com-btn-header-text ui-widget-content ui-corner-all\" id=\"btn-nv-adherent\" title=\"Ajouter un adhérent\">" +
						"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
						"</span>Ajouter" +
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
						"<div>{adherentPrincipal} : {cptLabel}</div>" +
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
	
	this.adherentPrincipal = "Adherent Principal";
	this.adherentSecondaire = "Adherent Secondaire";
	
	this.adherentPrincipalSelect = 
		"<select name=\"idAdherentPrincipal\" id=\"idAdherentPrincipal\">" +
			"<!-- BEGIN adherent -->" +
				"<option {adherent.selected} value=\"{adherent.id}\">{adherent.numero} : {adherent.nom} {adherent.prenom}</option>" +
			"<!-- END adherent -->" +
		"</select>";
	
	this.adherentPrincipalUnique = "<span>{adhNumero} : {adhNom} {adhPrenom}</span>";
				
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
							"<td class=\"com-table-td td-date \">{operationPassee.date}</td>" +
							"<td class=\"com-table-td td-libelle\">{operationPassee.libelle}</td>" +
							"<td class=\"com-table-td td-type-paiement\">{operationPassee.tppType} {operationPassee.opeTypePaiementChampComplementaire}</td>" +
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
	this.mCptLabel = null;
	this.mAdherentCompte = [];
	
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
							that.mAdherentCompte = lResponse.adherentCompte;
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
		this.mCptLabel = lResponse.adherent.cptLabel;
		
		lResponse.opeMontant = lResponse.adherent.cptSolde.nombreFormate(2,',',' ');
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		lResponse.adherent.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lResponse.adherent.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		
		$(lResponse.operationPassee).each(function() {
			if(this.date != null) {
				this.date = this.date.extractDbDate().dateDbToFr();
				if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
				if(this.tppId == 2) { // Affiche le N° de chèque
					this.opeTypePaiementChampComplementaire =' N° ' + this.champComplementaire[3].valeur;
				} else {
					this.opeTypePaiementChampComplementaire = '';
				}
				if(this.montant < 0) {
					this.debit = (this.montant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
					this.credit = '';
				} else {
					this.debit = '';
					this.credit = this.montant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				}
			}
		});
		
		var lNvSolde = parseFloat(lResponse.adherent.cptSolde);
		var lRechargementPrecedent = 0;
		$(lResponse.operationAvenir).each(function() {
			if(this.opeDate != null) {
				lNvSolde += parseFloat(this.opeMontant);
				this.nouveauSolde = lNvSolde.nombreFormate(2,',',' ');
				this.rechargement = 0;				
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
		var lCoreTemplate = new CoreTemplate();
		//var lTemplate = lMonCompteTemplate.monCompte;
		
		if(lResponse.adherent.adhId == lResponse.adherent.cptIdAdherentPrincipal) { // Adhérent Principal
			lResponse.adherent.adherentPrincipal = lGestionAdherentsTemplate.adherentPrincipal;
		} else { // Adhérent Secondaire
			lResponse.adherent.adherentPrincipal = lGestionAdherentsTemplate.adherentSecondaire;
		}
		
		var lHtml = lCoreTemplate.debutContenu;		
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
		lHtml += lCoreTemplate.finContenu;
		
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
			if(that.mAdherentCompte.length == 1) {
				that.mIdAdherentPrincipal = -1;
				that.dialogSupprimer();
			} else if(that.mAdherentCompte.length == 2) {
				if(that.mAdherentCompte[0].id == that.mIdAdherent) {
					that.mIdAdherentPrincipal = that.mAdherentCompte[1].id;
				} else {
					that.mIdAdherentPrincipal = that.mAdherentCompte[0].id;
				}
				that.dialogSupprimer();
			} else {
				var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
				
				var lListeAdherent = [];
				$.each(that.mAdherentCompte, function() {
					if(this.id != that.mIdAdherent) {
						lListeAdherent.push(this);
					}
				});
				var lData = {adherentPrincipal:lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:lListeAdherent})})
						,cptLabel:that.mCptLabel};
				
				$(lGestionAdherentsTemplate.dialogNvAncienAdhPrincipal.template(lData)).dialog({			
					autoOpen: true,
					modal: true,
					draggable: true,
					resizable: false,
					width:900,
					buttons: {
						'Valider': function() {
							that.mIdAdherentPrincipal = $(this).find('#idAdherentPrincipal').val();
							$(this).dialog('close');
							that.dialogSupprimer();
						}
					},
					close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
				});	
			}
			
			
		});
		return pData;
	};
	
	this.dialogSupprimer = function() {
		var that = this;
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		$(lGestionAdherentsTemplate.dialogSuppressionAdherent.template({adhNumero:that.mAdhNumero})).dialog({
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
					lVo.idAdherentPrincipal = that.mIdAdherentPrincipal;
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
	this.mAdherent = {};
	this.mAdherentCompte = [];
	this.mIdAdherentPrincipal = 0;
	this.mIdAncienAdherentPrincipal = 0;
	
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
							that.mAdherent = lResponse.adherent;
							that.mIdAdherent = pParam.id;
							that.mIdCompte = lResponse.adherent.adhIdCompte;
							that.mAdherentCompte[lResponse.adherent.adhIdCompte] = lResponse.adherentCompte;
							//that.mIdAncienAdherentPrincipal = lResponse.adherent.cptIdAdherentPrincipal;
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
		var lData = lResponse.adherent;		
		lData.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		lData.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lData.modules = lResponse.modules;
		
		if(this.mAdherentCompte[this.mIdCompte].length == 1) {
			lData.formAdherentPrincipal = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalUnique.template(this.mAdherent)});
		} else {
			$.each(this.mAdherentCompte[this.mIdCompte], function() {
				if(this.id == lResponse.adherent.cptIdAdherentPrincipal) {
					this.selected = 'selected="selected"';
				} else {
					this.selected = '';
				}
			});
			lData.formAdherentPrincipal = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:this.mAdherentCompte[this.mIdCompte]})});
		}
				
		$(lResponse.autorisations).each(function() {
			var lIdModule = this.idModule;
			$(lData.modules).each(function() {
				if(this.id == lIdModule) {
					this.checked = "checked=\"checked\"";
				}
			});
		});		
		

		
		
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
		var that = this;
		pData.find('[name="choix_compte"]').change(function() {
			var lVal = $(this).val();
			if(lVal == "lier") {
				$('#choix_compte_liaison, #label_compte_lier').show();
			} else {
				$('#choix_compte_liaison').hide();
				$('#label_compte_lier').hide().text('').attr('data-id-compte','');
			}
			
			var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
			switch(lVal) {
				case "actuel":
					var lHtml = '';
					if(that.mAdherentCompte[that.mIdCompte].length == 1) {
						lHtml = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalUnique.template(that.mAdherent)});
					} else {
						$.each(that.mAdherentCompte[that.mIdCompte], function() {
							if(this.id == that.mAdherent.cptIdAdherentPrincipal) {
								this.selected = 'selected="selected"';
							} else {
								this.selected = '';
							}
						});
						lHtml = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:that.mAdherentCompte[that.mIdCompte]})});
					}
					$('#ligne-adherent-principal').html(lHtml);
					break;
				
				default:
					if(that.mAdherent.adhId == that.mAdherent.cptIdAdherentPrincipal) { // Si c'est un adherent Principal il faut en définir un nouveau
						// Si il y a d'autres adhérents
						if(that.mAdherentCompte[that.mIdCompte].length > 1) {
							if(that.mAdherentCompte[that.mIdCompte].length == 2) { // Si il ne reste qu'un autre adhérent on le positionne en principal
								if(that.mAdherentCompte[that.mIdCompte][0].id == that.mAdherent.adhId) {
									that.mIdAncienAdherentPrincipal = that.mAdherentCompte[that.mIdCompte][1].id;
								} else {
									that.mIdAncienAdherentPrincipal = that.mAdherentCompte[that.mIdCompte][0].id;
								}
							} else {
								var lListeAdherent = [];
								$.each(that.mAdherentCompte[that.mIdCompte], function() {
									if(this.id != that.mAdherent.adhId) {
										lListeAdherent.push(this);
									}
								});
								var lData = {adherentPrincipal:lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:lListeAdherent})})
										,cptLabel:that.mAdherent.cptLabel};
							
								$(lGestionAdherentsTemplate.dialogNvAncienAdhPrincipal.template(lData)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:900,
									buttons: {
										'Valider': function() {
											that.mIdAncienAdherentPrincipal = $(this).find('#idAdherentPrincipal').val();
											$(this).dialog('close');
										}
									},
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								});	
							}						
						} else { // Dernier adhérent du compte
							that.mIdAncienAdherentPrincipal = -1;
						}
					} else {
						that.mIdAncienAdherentPrincipal = that.mAdherent.cptIdAdherentPrincipal;
					}
					
					// Affichage de l'adhérent principal du nouveau compte
					var lHtml = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalUnique.template(that.mAdherent)});
					$('#ligne-adherent-principal').html(lHtml);
					break;
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
						
						var lListeAdherent = [];
						$.each(lResponse.listeAdherent,function() {
							if(this.adhIdCompte != that.mIdCompte) {
								this.adhIdTri = this.adhNumero.replace("Z","");
								this.cptIdTri = this.cptLabel.replace("C","");
								lListeAdherent.push(this);
							}
						});
						
						$(that.affectDialoglisteAdherent($(lTemplate.template({listeAdherent:lListeAdherent})))).dialog({			
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
		var that = this;
		pData.find('.compte-ligne').click(function() {
			var lVo = {fonction:"adherentCompte", id:$(this).attr('data-id-compte')};
			$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
							
							$.each(lResponse.adherentCompte, function() {
								if(this.id == lResponse.compte.idAdherentPrincipal) {
									this.selected = 'selected="selected"';
								} else {
									this.selected = '';
								}
							});
							
							// Ajout de l'adhérent à la liste
							lResponse.adherentCompte.push({id:that.mAdherent.adhId,numero:that.mAdherent.adhNumero,nom:that.mAdherent.adhNom,prenom:that.mAdherent.adhPrenom});
							
							var lData = {adherentPrincipal:lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:lResponse.adherentCompte})})
									, cptLabel:lResponse.compte.label};

							$(that.affectDialoglisteAdherent($(lGestionAdherentsTemplate.dialogNvAncienAdhPrincipal.template(lData)))).dialog({			
								autoOpen: true,
								modal: true,
								draggable: true,
								resizable: false,
								width:900,
								buttons: {
									'Valider': function() {
										that.mIdAdherentPrincipal = $(this).find('#idAdherentPrincipal').val();
										
										$.each(lResponse.adherentCompte, function() {
											if(this.id == that.mIdAdherentPrincipal) {
												this.selected = 'selected="selected"';
											} else {
												this.selected = '';
											}
										});
										
										// Affichage de l'adhérent principal du nouveau compte
										var lHtml = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:lResponse.adherentCompte})});
										$('#ligne-adherent-principal').html(lHtml);
										
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
		lVo.idCompte = "";
		lVo.idAdherentPrincipal = 0;
		lVo.idAncienAdherentPrincipal = 0;
		
		var lChoixCompte = $(':input[name=choix_compte]:checked').val();
		if(lChoixCompte == 'actuel' ) {			
			if($('#idAdherentPrincipal').length == 1) { // Si plusieurs adhérents
				lVo.idAdherentPrincipal = $('#idAdherentPrincipal').val();
			}
			lVo.idAncienAdherentPrincipal = lVo.idAdherentPrincipal;
			lVo.idCompte = this.mIdCompte;
		} else if ( lChoixCompte == 'auto') {
			lVo.idCompte = 0;
			lVo.idAdherentPrincipal = lVo.id;
			lVo.idAncienAdherentPrincipal = this.mIdAncienAdherentPrincipal;
		} else {
			var lIdCompte = $('#label_compte_lier').attr("data-id-compte");
			if(lIdCompte != undefined ) {
				lVo.idCompte = $('#label_compte_lier').attr("data-id-compte");
			}
			lVo.idAdherentPrincipal = $('#idAdherentPrincipal').val();
			lVo.idAncienAdherentPrincipal = this.mIdAncienAdherentPrincipal;
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
		$(':input[name="modules[]"]:checked').each(function() {lVo.modules.push($(this).val());});

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