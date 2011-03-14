;function GestionAdherentsTemplate() {
	this.formulaireAjoutAdherent =
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_modifier_adherent_int\">" +
				"<form>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Information de l'adhérent</div>" +
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
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Mot de Passe *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Resaisir le mot de Passe *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Date de Naissance (jj/mm/aaaa)</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_naissance\" value=\"{dateNaissance}\" maxlength=\"10\" id=\"dateNaissance\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Date d'adhésion (jj/mm/aaaa) *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_adhesion\" value=\"{dateAdhesion}\" maxlength=\"10\" id=\"dateAdhesion\" /></td>" +
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
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées de l'adhérent</div>" +
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
							"</table>" +
						"</div>" +
					"</div>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\"> Autorisations</div>" +
						"<div class=\"com-widget-content\">" +
							"<table id=\"formulaire-modifier-adherent-table-autorisation\" class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Modules autorisés</th>" +
								"</tr>" +
							"<!-- BEGIN modules -->" +
								"<tr class=\"ui-widget-content\" >" +
									"<td class=\"com-table-form-td\" ><input type=\"checkbox\" name=\"modules[]\" value=\"{modules.id}\" {modules.checked} />{modules.label}</td>" +
								"</tr>" +
							"<!-- END modules -->" +
								"<tr>" +
									"<td class=\"com-center com-ligne-submit\">" +
										"<input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Valider\" />" +
									"</td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.ajoutAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Nouvel Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.modifierAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification d'Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été mis à jour avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.supprimerAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Suppression d'Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été supprimé avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
		
	this.listeAdherent = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +
			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Adhérents</div>" +
						"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
							"<form id=\"filter-form\">" +
								"<div>" +
									"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
											"<span class=\"ui-icon ui-icon-search\">" +
										"</span>" +
									"</span>" +
									"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
								
									/*"<input class=\"com-input-text ui-widget-content ui-corner-left\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
									"<span class=\"ui-widget-content ui-corner-right liste-adh-span-rech-right\">" +
										"<span class=\"ui-icon ui-icon-search\"></span>" +
									"</span>" +*/
								"</div>" +
							"</form>" +
						"</div>" +
						//"<div id=\"widget-liste-adherent\" class=\"com-widget-content ui-widget ui-corner-all\">" +
							"<table class=\"com-table\">" +
								"<thead>" +
									"<tr class=\"ui-widget ui-widget-header\">" +
										"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
										"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
										"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
										"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Courriel</th>" +
										"<th class=\"com-table-th liste-adh-th-solde\">Solde</th>" +
									"</tr>" +
								"</thead>" +
								"<tbody>" +
							"<!-- BEGIN listeAdherent -->" +
									"<tr class=\"com-cursor-pointer compte-ligne\" >" +
										"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherent.adhId}</span>{listeAdherent.adhNumero}</td>" +
										"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhNom}</td>" +
										"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhPrenom}</td>" +
										"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhCourrielPrincipal}</td>" +
										"<td class=\"com-table-td com-underline-hover liste-adh-td-solde\"><span class=\"{listeAdherent.classSolde}\">{listeAdherent.opeMontant} {sigleMonetaire}</span></td>" +
									"</tr>" +
							"<!-- END listeAdherent -->" +
								"</tbody>" +
							"</table>" +
						//"</div>" +
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
	
	this.dialogSuppressionAdherent =
	"<div id=\"dialog-supp-adh\" title=\"Supprimer l'adhérent {adhNumero}\">" +
		"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer l'adherent : {adhNumero}</p>" +
	"</div>";
	
	this.infoCompteAdherentDebut =		
		"<div id=\"info_compte_solde_adherent_ext\">" +
			"<div id=\"info_compte_solde_adherent_int\">" +
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
						"<div>Numéro d'adhérent : {adhNumero}</div>" +
						"<div>Numéro de Compte : {cptLabel}</div>" +
						"<div>Nom : {adhNom}</div>" +
						"<div>Prénom : {adhPrenom}</div>" +
						"<div>Date de naissance : {adhDateNaissance}</div>" +
						"<div>Date d'adhésion : {adhDateAdhesion}</div>" +
						"<div>Commentaire : {adhCommentaire}</div>" +
					"</div>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
}