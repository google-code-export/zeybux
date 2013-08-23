;function MonCompteTemplate() {
	this.infoCompteAdherent = 
	"<div id=\"info_compte_solde_adherent_ext\">" +
		"<div id=\"info_compte_solde_adherent_int\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Informations" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all edt-info-compte\" id=\"btn-edt-compte\" title=\"Modifier les informations\">" +
						"<span class=\"ui-icon ui-icon-pencil\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all edt-info-compte\" id=\"btn-edt-pass\" title=\"Changer le mot de passe\">" +
						"<span class=\"ui-icon ui-icon-key\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all ui-helper-hidden edt-info-compte\" id=\"btn-edt-annuler\" title=\"Annuler\">" +
						"<span class=\"ui-icon ui-icon-closethick\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-widget-content-transparent ui-corner-all ui-helper-hidden edt-info-compte\" id=\"btn-edt-valider\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check\"></span>" +
					"</span>" +
				"</div>" +
				"<div class=\"com-widget-content edt-info-compte\">" +
					"<div>{adhNumero} : <span id=\"adh-prenom\">{adhPrenom}</span> <span id=\"adh-nom\">{adhNom}</span></div>" +
					"<div>Compte : {cptLabel}</div>" +
					"<div>Date de naissance : <span id=\"adh-date-naissance\">{adhDateNaissance}</span></div>" +
					"<div>Date d'adhésion : {adhDateAdhesion}</div>" +
					"<div>Commentaire : <span id=\"adh-commentaire\">{adhCommentaire}</span></div>" +
				"</div>" +
				"<div class=\"ui-helper-hidden edt-info-compte\">" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Nom *</th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"nom\" value=\"\" maxlength=\"50\" id=\"nom\"/>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Prénom *</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"prenom\" value=\"\" maxlength=\"50\" id=\"prenom\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Date de Naissance<br/>(jj/mm/aaaa)</th>" +
							"<td class=\"com-table-form-td\"><input type=\"hidden\" name=\"date_adhesion\" value=\"{adhDateAdhesion}\" /><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"date_naissance\" value=\"\" maxlength=\"10\" id=\"dateNaissance\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Commentaire</th>" +
							"<td class=\"com-table-form-td\"><textarea class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" name=\"commentaire\" id=\"commentaire\"></textarea></td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
				"<div class=\"com-widget-content edt-info-compte\">" +
					"<div>Courriel 1 : <span id=\"adh-courriel-principal\">{adhCourrielPrincipal}</span></div>" +
					"<div>Courriel 2 : <span id=\"adh-courriel-secondaire\">{adhCourrielSecondaire}</span></div>" +
					"<div>Téléphone 1 : <span id=\"adh-telephone-principal\">{adhTelephonePrincipal}</span></div>" +
					"<div>Téléphone 2 : <span id=\"adh-telephone-secondaire\">{adhTelephoneSecondaire}</span></div>" +
					"<div>Adresse : " +
						"<div><span id=\"adh-adresse\">{adhAdresse}</span> <br/>" +
						"<span id=\"adh-code-postal\">{adhCodePostal}</span> <span id=\"adh-ville\">{adhVille}</span></div>" +
					"</div>" +
				"</div>" +
				
				"<div class=\"ui-helper-hidden com-widget-content edt-info-compte\">" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Courriel 1</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"courriel_principal\" value=\"\" maxlength=\"100\" id=\"courrielPrincipal\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Courriel 2</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" ype=\"text\" name=\"courriel_secondaire\" value=\"\" maxlength=\"100\" id=\"courrielSecondaire\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Téléphone 1</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"telephone_principal\" value=\"\" maxlength=\"20\" id=\"telephonePrincipal\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Téléphone 2</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"telephone_secondaire\" value=\"\" maxlength=\"20\" id=\"telephoneSecondaire\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Adresse</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"adresse\" value=\"\" maxlength=\"300\" id=\"adresse\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Code Postal</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"code_postal\" value=\"\" maxlength=\"10\" id=\"codePostal\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Ville</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"ville\" value=\"\" maxlength=\"100\" id=\"ville\"/></td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
				
			"</div>" +
		"</div>" +
	"</div>";
	
	this.dialogEditionPass =
		"<div id=\"dialog-edt-info-cpt\" title=\"Modifier mon mot de passe\" class=\"formulairer_dialog\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-widget-content-transparent ui-corner-all\">Ancien mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-widget-content-transparent ui-corner-all\">Nouveau mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"password\" name=\"pass_nouveau\" maxlength=\"100\" id=\"motPasseNouveau\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-widget-content-transparent ui-corner-all\">Resaisir le mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	this.listeOperationPassee = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Solde : <span id=\"solde\">{cptSolde} {sigleMonetaire}</span></div>	" +	
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
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">{achatFuturLabel}</div>" +
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