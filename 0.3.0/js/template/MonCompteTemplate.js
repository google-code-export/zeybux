;function MonCompteTemplate() {
	this.infoCompteAdherent = 
	"<div id=\"info_compte_solde_adherent_ext\">" +
		"<div id=\"info_compte_solde_adherent_int\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Informations" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-edt-info\" title=\"Changer le mot de passe\">" +
						"<span class=\"ui-icon ui-icon-pencil\">" +
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
			"</div>" +
		"</div>" +
	"</div>";
	
	this.dialogEditionCompte =
		"<div id=\"dialog-edt-info-cpt\" title=\"Modifier mon mot de passe\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Ancien mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nouveau mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_nouveau\" maxlength=\"100\" id=\"motPasseNouveau\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Resaisir le mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
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