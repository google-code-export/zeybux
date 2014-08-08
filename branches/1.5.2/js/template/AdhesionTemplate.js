;function AdhesionTemplate() {
	this.listeAdhesion = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"{titreAdhesion}" +
					"<span class=\"com-btn-header-text ui-widget-content ui-corner-all\" id=\"btn-nv-adhesion\" title=\"Ajouter une adhésion\">" +
						"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
						"</span>Ajouter" +
					"</span>" +
				"</div>" +
				"<table class=\"com-table\">" +
					"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th class=\"com-table-th-debut com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
							"<th class=\"com-table-th-med com-underline-hover liste-adh-th-cpt com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Début</th>" +
							"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Fin</th>" +
							"<th class=\"com-table-th-med td-edt\"></th>" +
							"<th class=\"com-table-th-med td-edt\"></th>" +
							"<th class=\"com-table-th-fin td-edt\"></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN listeAdhesion -->" +
						"<tr class=\"com-cursor-pointer\">" +
							"<td class=\"com-table-td-debut com-underline-hover\">{listeAdhesion.label}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdhesion.dateDebut}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdhesion.dateFin}</td>" +
							"<td class=\"com-table-td-med\">" +
								"<span class=\"btn-modifier-adhesion com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" data-id=\"{listeAdhesion.id}\">" +
									"<span class=\"ui-icon ui-icon-pencil\"></span>" +
								"</span>" +
							"</td>" +
							"<td class=\"com-table-td-med\">" +
								"<span class=\"btn-supprimer-adhesion com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" data-id=\"{listeAdhesion.id}\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
								"</span>" +
							"</td>" +
							"<td class=\"com-table-td-fin \">" +
								"<span class=\"btn-detail-adhesion com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" data-id=\"{listeAdhesion.id}\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
				"<!-- END listeAdhesion -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.titreAdhesionSingulier = "L'adhésion";
	this.titreAdhesionPluriel = "Les Adhésions";
	
	this.listeAdhesionVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Adhésion" +
					"<span class=\"com-btn-header-text ui-widget-content ui-corner-all\" id=\"btn-nv-adhesion\" title=\"Ajouter une adhésion\">" +
						"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
						"</span>Ajouter" +
					"</span>" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune Adhésion dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutAdhesion = 
		"<div title=\"Adhésion\">" +
			"<div class=\"com-float-left\">" +
				"<table>" +
					"<tr>" +
						"<th colspan=\"2\" class=\"ui-widget-header com-center ui-corner-all\">L'Adhésion</th>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-th\">Nom</th>" +
						"<td class=\"com-table-form-td form-ajout-adhesion-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-td\" type=\"text\" name=\"label\" value=\"{label}\" maxlength=\"45\" id=\"label\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-th\">Date de début</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-td-date\" type=\"text\" name=\"dateDebut\" value=\"{dateDebut}\" maxlength=\"10\" id=\"dateDebut\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-th\">Date de fin</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-td-date\" type=\"text\" name=\"dateFin\" value=\"{dateFin}\" maxlength=\"10\" id=\"dateFin\"/></td>" +
					"</tr>" +
				"</table>" +				
			"</div>" +
			"<div class=\"com-float-left\" id=\"div-form-ajout-type-adhesion\">" +
				"<table class=\"ui-widget-content ui-corner-all\">" +
					"<tr>" +
						"<th colspan=\"2\" class=\"ui-widget-header com-center ui-corner-all\">Type d'adhésion</th>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-th\">Nom</th>" +
						"<td class=\"com-table-form-td form-ajout-adhesion-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-td\" type=\"text\" name=\"type-label\" maxlength=\"45\" id=\"type-label\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-th\">Montant</th>" +
						"<td class=\"com-table-form-td form-ajout-adhesion-td\"><input class=\"com-input-text com-numeric ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-input-montant\" type=\"text\" name=\"type-montant\" maxlength=\"13\" id=\"type-montant\"/> {sigleMonetaire}</td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-th\">Périmètre</th>" +
						"<td class=\"com-table-form-td form-ajout-adhesion-td\">" +
							"<select name=\"type-idPerimetre\" id=\"type-idPerimetre\" class=\"form-ajout-adhesion-td\">" +
								"<!-- BEGIN listePerimetre -->" +
									"<option value=\"{listePerimetre.id}\">{listePerimetre.label}</option>" +
								"<!-- END listePerimetre -->" +
							"</select>" +
					"</tr>" +
				"</table>" +	
				"<div class=\"com-center\">" +
					"<input id=\"btn-ajout-type-adhesion\" class=\"ui-state-default ui-corner-bottom com-button com-center\" type=\"submit\" value=\"Ajouter\" />" +
				"</div>" +
			"</div>" +
			"<table id=\"liste-type-adhesion\" class=\"com-table\">" +
				"<!-- BEGIN types -->" +
					"<tr id=\"ligne-type-adhesion-{types.id}\">" +
						"<td class=\"com-table-td-debut\">" +
							"<span id=\"span-{types.id}-label\" class=\"edition-type-adhesion-{types.id}\">{types.label}</span>" +
							"<input class=\"ui-helper-hidden edition-type-adhesion-{types.id} com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all form-ajout-adhesion-td\" value=\"{types.label}\"type=\"text\" name=\"type-label\" maxlength=\"45\" id=\"type-{types.id}-label\" /></td>" +
						"<td class=\"com-table-td-med ligne-type-adhesion-montant\">{types.montant} {sigleMonetaire}</td>" +
						"<td class=\"com-table-td-med ligne-type-adhesion-label-perimetre\">{types.perLabel}</td>" +
						"<td class=\"com-table-td-med ligne-type-adhesion-btn-sup\">" +
							"<span data-id=\"{types.id}\" class=\"btn-modifier-type-adhesion com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all edition-type-adhesion-{types.id}\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +

							"<span data-id=\"{types.id}\" class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden edition-type-adhesion-{types.id} btn-valider-modifier-type\" title=\"Valider\">" +
								"<span class=\"ui-icon ui-icon-check\"></span>" +
							"</span>" +
							
						"</td>" +
						"<td class=\"com-table-td-fin ligne-type-adhesion-btn-sup\">" +
							"<span data-id=\"{types.id}\" class=\"btn-sup-type-adhesion com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all edition-type-adhesion-{types.id}\">" +
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +

							"<span data-id=\"{types.id}\" class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden edition-type-adhesion-{types.id} btn-annuler-modifier-type\" title=\"Annuler\">" +
								"<span class=\"ui-icon ui-icon-closethick\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
				"<!-- END types -->" +
			"</table>" +
		"</div>";
	
	this.ligneTypeAdhesion =
		"<tr id=\"ligne-type-adhesion-{id}\">" +
			"<td class=\"com-table-td-debut\">{label}</td>" +
			"<td class=\"com-table-td-med ligne-type-adhesion-montant\">{montant} {sigleMonetaire}</td>" +
			"<td class=\"com-table-td-med ligne-type-adhesion-label-perimetre\">{perLabel}</td>" +
			"<td class=\"com-table-td-med ligne-type-adhesion-btn-sup\"></td>" +
			"<td class=\"com-table-td-fin ligne-type-adhesion-btn-sup\">" +
				"<span data-id=\"{id}\" class=\"btn-sup-type-adhesion com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
					"<span class=\"ui-icon ui-icon-trash\"></span>" +
				"</span>" +
			"</td>" +
		"</tr>";
	
	this.dialogListeAdherent =
		"<div id=\"dialog-sup-adhesion\" title=\"Suppression adhésion\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\">" +
				"</span>ATTENTION : Des adhérents sont positionnés sur cette adhésion.<br/>Les opérations associées ne seront pas supprimées.<br/>Merci d'extraire la liste des adhérents impactés avant la suppression." +
			"</p>" +
			"<div class=\"com-center\">" +
				"<button id=\"btn-extract-adh-sur-ads\" class=\"ui-state-default ui-corner-all com-button com-center\" data-id=\"{id}\">Extraire</button>" +
			"</div>" +
		"</div>";
	
	this.buttonSupprimerAdhesion = "<button class=\"ui-state-default ui-corner-all com-button com-center\" data-id=\"{id}\">Supprimer</button>";
	
	this.dialogSuppressionAdhesion = 
		"<div title=\"Suppression adhésion\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\">" +
				"</span>ATTENTION : Supprimer cette adhésion ?</p>" +
		"</div>";
	
	this.detailAdhesion = 
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-retour\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour" +
				"</button>" +
			"</div>" +		
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"{label} : du {dateDebut} au {dateFin}" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-ads\" title=\"Exporter les adhésions\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
						"</span>" +
					"</span>" +
				"</div>" +
				"<table id=\"table-info-solde-zeybu\">" +
					"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th class=\"com-table-th\">Adhérent : {nbAdherentSurAdhesion}</th>" +
							"<th class=\"com-table-th\">Non Adhérent : {nbAdherentHorsAdhesion}</th>" +
						"</tr>" +
					"</thead>" +
				"</table>" +	
				"{listeAdherentAdhesion}" +
			"</div>" +
		"</div>";
	
	this.listeAdherentAdhesion =
		"<table id=\"liste-adherent-adhesion\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"com-table\">" +
			"<thead>" +
				"<tr class=\"ui-widget ui-widget-header\">" +
					"<th>N°</th>" +
					"<th>Compte</th>" +
					"<th>Nom</th>" +
					"<th>Prénom</th>" +
					"<th>Formulaire</th>" +
					"<th>Adhésion</th>" +
					"<th></th>" +
				"</tr>" +
			"</thead>" +
			"<tbody>" +
		"<!-- BEGIN listeAdherent -->" +
				"<tr>" +
					"<td>{listeAdherent.adhNumero}</td>" +
					"<td>{listeAdherent.cptLabel}</td>" +
					"<td>{listeAdherent.adhNom}</td>" +
					"<td>{listeAdherent.adhPrenom}</td>" +
					"<td>{listeAdherent.adadStatutFormulaire}</td>" +
					"<td>{listeAdherent.idAdhesionAdherent}</td>" +
					"<td>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all gestion-adhesion-adherent\" data-id-adherent=\"{listeAdherent.adhId}\" data-id-adhesion-adherent=\"{listeAdherent.idAdhesionAdherent}\">" +
							"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
		"<!-- END listeAdherent -->" +
			"</tbody>" +
		"</table>";
	
	this.listeAdherentAdhesionVide = "<p id=\"texte-liste-vide\">Aucun Adhérent dans la base.</p>";
	
	this.dialogAdhesionAdherent = 
		"<div title=\"{label} : du {dateDebut} au {dateFin}\">" +
			"<div>" +
				"<table>" +
					"<thead>" +
						"<tr>" +
							"<td>Formulaire</td>" +
							"<td><input type=\"checkbox\" id=\"adhesionAdherentstatutFormulaire\" {statutFormulaireChecked}/></td>" +
						"</tr>" +
						"<tr>" +
							"<td>Type</td>" +
							"<td>{type}</td>" +
						"</tr>" +
						"<tr>" +
							"<td>Périmètre</td>" +
							"<td>" +
								"<span id=\"perimetre-adhesion-adherent\">{perimetre}</span>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<td>Montant</td>" +
							"<td id=\"td-montant-adhesion-adherent\">{montant}</td>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
						"<tr id=\"ligne-operation\">" +
							"<td>Type de Paiement</td>" +
							"<td>" +
								"<select name=\"typepaiement\" id=\"operationtypePaiement\">" +
									"<option value=\"0\">== Choisir ==</option>" +
									"<!-- BEGIN typePaiement -->" +
									"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
									"<!-- END typePaiement -->" +
								"</select>" +
							"</td>" +
						"</tr>" +
						"{champComplementaire}" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.selectTypeAdhesion = 
		"<select name=\"typeAdhesion\" id=\"adhesionAdherentidTypeAdhesion\">" +
			"<option value=\"0\">== Choisir ==</option>" +
			"<!-- BEGIN types -->" +
			"<option value=\"{types.id}\">{types.label}</option>" +
			"<!-- END types -->" +
		"</select>";
	
	this.typeAdhesionUnique =
		"<input type=\"hidden\" name=\"typeAdhesion\" id=\"adhesionAdherentidTypeAdhesion\" value=\"{id}\">{label}";
	
	this.typeAdhesionMontant =
		"<span id=\"montant-adhesion-adherent\">{montant}</span> {sigleMonetaire}";
	
	this.champComplementaire =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.label}</td>" +
				"<td>" +
					"<input type=\"text\" value=\"\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"operationchampComplementaire{champComplementaire.id}valeur\" data-id-champ-complementaire=\"{champComplementaire.id}\" maxlength=\"50\" size=\"15\"/>" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
	
	this.dialogConfirmSuppressionAdhesion =
		"<div title=\"Suppression de l'adhésion\">" +
			"<p class=\"ui-state-error ui-corner-all\">" +
				"<span class=\"ui-icon ui-icon-alert com-float-left\"></span>" +
				"ATTENTION : Voulez-vous supprimer cette adhésion ?<br/>" +
				"Le paiement associé sera aussi supprimé." +
			"</p>" +
		"</div>";
	
	this.listeAdherent = 
		"<div id=\"contenu\">" +	
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"{titreAdherent}" +
				"</div>" +
				"<table id=\"liste-adherent\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"com-table\">" +
					"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th>N°</th>" +
							"<th>Compte</th>" +
							"<th>Nom</th>" +
							"<th>Prénom</th>" +
							"<th></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN listeAdherent -->" +
						"<tr>" +
							"<td>{listeAdherent.adhNumero}</td>" +
							"<td>{listeAdherent.cptLabel}</td>" +
							"<td>{listeAdherent.adhNom}</td>" +
							"<td>{listeAdherent.adhPrenom}</td>" +
							"<td>" +
								"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all detail-adhesion-adherent\" data-id-adherent=\"{listeAdherent.adhId}\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
				"<!-- END listeAdherent -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";	
	
	this.titreAdherentSingulier = "L'adhérent";
	this.titreAdherentPluriel = "Les adhérents";
	this.titreAdherentVide = "Aucun adhérent";
	
	this.listeAdhesionAdherent = 
	"<div id=\"contenu\">" +	
		"<div class=\"com-barre-menu-2\">" +
			"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-retour\">" +
				"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour" +
			"</button>" +
		"</div>" +
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"{numero} : {prenom} {nom}" +
			"</div>" +
			"<table id=\"liste-adhesion\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"com-table\">" +
				"<thead>" +
					"<tr class=\"ui-widget ui-widget-header\">" +
						"<th>Nom</th>" +
						"<th>Début</th>" +
						"<th>Fin</th>" +
						"<th></th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
			"<!-- BEGIN listeAdhesion -->" +
					"<tr>" +
						"<td>{listeAdhesion.adsLabel}</td>" +
						"<td>{listeAdhesion.adsDateDebut}</td>" +
						"<td>{listeAdhesion.adsDateFin}</td>" +
						"<td>" +
							"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all detail-adhesion-adherent\" data-id-adhesion-adherent=\"{listeAdhesion.adadId}\">" +
								"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
			"<!-- END listeAdhesion -->" +
				"</tbody>" +
			"</table>" +
		"</div>" +
	"</div>";	
	
	this.dialogAficheAdhesionAdherent = 
		"<div title=\"{label} : du {dateDebut} au {dateFin}\">" +
			"<div>" +
				"<table>" +
					"<thead>" +
						"<tr>" +
							"<td>Formulaire</td>" +
							"<td><span class=\"com-float-left ui-icon {statutFormulaireChecked}\"></span></td>" +
						"</tr>" +
						"<tr>" +
							"<td>Type</td>" +
							"<td>{type}</td>" +
						"</tr>" +
						"<tr>" +
							"<td>Périmètre</td>" +
							"<td>" +
								"<span id=\"perimetre-adhesion-adherent\">{perimetre}</span>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<td>Montant</td>" +
							"<td id=\"td-montant-adhesion-adherent\">{montant}</td>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
						"<tr id=\"ligne-operation\">" +
							"<td>Type de Paiement</td>" +
							"<td>{typePaiement}</td>" +
						"</tr>" +
						"{champComplementaire}" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
};