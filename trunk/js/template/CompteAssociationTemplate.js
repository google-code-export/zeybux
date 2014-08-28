;function CompteAssociationTemplate() {
	this.rechercheListeOperation = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Le Compte Association : {soldeTotal} {sigleMonetaire}" +
				"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-export-liste-operation\" title=\"Exporter\">" +
					"<span class=\"ui-icon ui-icon-print\"></span>" +
				"</span>" +
				"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-edit-compte\" title=\"Editer le compte\">" +
					"<span class=\"ui-icon ui-icon-pencil\"></span>" +
				"</span>" +
				"<span class=\"com-btn-header-text com-btn-header ui-widget-content ui-corner-all\" id=\"btn-virement\" title=\"Ajouter un virement\">" +
					"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
					"</span>Virement " +
				"</span>" +
				"<span class=\"com-btn-header-text com-btn-header ui-widget-content ui-corner-all\" id=\"btn-operation\" title=\"Ajouter une opération\">" +
					"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
					"</span>Opération " +
				"</span>" +
			"</div>" +	
			"<div id=\"form-recherche-liste-operation\" class=\"com-center com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"Entre le <input type=\"text\" value=\"{dateDebut}\" id=\"dateDebut\" class=\"com-input-text ui-widget-content ui-corner-all\">" +
				" et le <input type=\"text\" value=\"{dateFin}\" id=\"dateFin\" class=\"com-input-text ui-widget-content ui-corner-all\"> " +
				"<button type=\"button\" id=\"btn-rechercher-liste-operation\" class=\"ui-state-default ui-corner-all com-button com-center\">Rechercher</button>" +
			"</span>" +
			"</div>" +
			"<div id=\"liste-operation\" class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
			"</div>" +
		"</div>";
		
	this.InfoCompte =
		"<div>" +	
			"<table id=\"table-operation\" class=\"com-table\">" +
				"<thead>" +
				"<tr class=\"ui-widget ui-widget-header\" >" +
					"<th>Date</th>" +
					"<th>Compte</th>" +
					"<th>Libellé</th>" +
					"<th>Type de paiement</th>" +
					"<th>Débit</th>" +
					"<th>Crédit</th>" +
				"</tr>" +
				"</thead>" +
				"<tbody>" +
			"<!-- BEGIN operation -->" +
				"<tr>" +
					"<td>{operation.opeDate}</td>" +
					"<td>{operation.cptLabel}</td>" +
					"<td>{operation.opeLibelle}</td>" +
					"<td>{operation.tppType}</td>" +
					"<td>{operation.debit}</td>" +
					"<td>{operation.credit}</td>" +
				"</tr>" +
			"<!-- END operation -->" +
				"</tbody>" +
			"</table>" +
		"</div>";
	
	this.dialogOperation = 
		"<div title=\"Ajouter une opération\">" +
			"<div class=\"com-widget-content\">" +
				"<table>" +
					"<thead>" +
						"<tr>" +
							"<td>Libelle</td>" +
							"<td><input type=\"text\" name=\"libelle\" id=\"libelle\" class=\"com-input-text ui-widget-content ui-corner-all\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<td><input type=\"radio\" name=\"signe\" value=\"-1\" class=\"signe\" checked=\"checked\"/>Débit</td>" +
							"<td><input type=\"radio\" name=\"signe\" value=\"1\" class=\"signe\"/>Crédit</td>" +
						"</tr>" +
						"<tr>" +
							"<td>Montant</td>" +
							"<td><input type=\"text\" name=\"montant\" value=\"\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"montant\" maxlength=\"12\" size=\"5\"/> <span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
						"<tr id=\"ligne-operation\">" +
							"<td>Type de Paiement</td>" +
							"<td>" +
								"<select name=\"typepaiement\" id=\"typePaiement\">" +
									"<option value=\"0\">== Choisir ==</option>" +
									"<!-- BEGIN typePaiement -->" +
									"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
									"<!-- END typePaiement -->" +
								"</select>" +
							"</td>" +
						"</tr>" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.champComplementaire =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.label}</td>" +
				"<td>" +
					"<input type=\"text\" value=\"\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"champComplementaire{champComplementaire.id}valeur\" data-id-champ-complementaire=\"{champComplementaire.id}\" maxlength=\"50\" size=\"15\"/>" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
	
	this.dialogVirement = 
		"<div title=\"Ajouter un virement vers le compte marché\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant <input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"montant\" maxlength=\"12\" id=\"montant\"/> {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.listePaiement = 
		"<div id=\"contenu\" class=\"ui-helper-reset\">" +
			"<div id=\"listePaiement\" class=\"ui-widget-content-transparent\">" +
				"<ul>" +
					"<li><a href=\"#cheque\" id=\"li-cheque\">Chèques</a></li>" +
					"<li><a href=\"#espece\" id=\"li-espece\">Espèces</a></li>" +
				"</ul>" +
				"<div id=\"cheque\" class=\"ui-widget-content-transparent\">" +
					"<div>Total : {totalCheque} {sigleMonetaire}</div>" +
					"<div class=\"com-center\">" +
						"<div class=\"div-btn-remise-cheque\">" +
							"<button type=\"button\" id=\"btn-nv-remise-cheque\" class=\"ui-state-default ui-corner-all com-button com-center\">Nouvelle Remise de Chèque</button>" +
						"</div>" +
						"<div class=\"div-btn-remise-cheque ui-helper-hidden\">" +
							"<button type=\"button\" id=\"btn-ajout-remise-cheque\" class=\"ui-state-default ui-corner-all com-button com-center\">Créer la remise de Chèque</button> ou " +
							"<button type=\"button\" id=\"btn-ajout-operation-remise-cheque\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter à une remise de Chèque</button> : " +
							"<span id=\"total-remise-cheque\">0</span> {sigleMonetaire}" +
							"<button type=\"button\" id=\"btn-annul-remise-cheque\" class=\"ui-state-default ui-corner-all com-button com-center\">Annuler</button>" +
						"</div>" +
					"</div>" +
					"<br/><table id=\"table-cheque\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th></th>" +
								"<th>Remise de<br/>Chèque</th>" +
								"<th>Date</th>" +
								"<th></span>N°</th>" +
								"<th>Compte</th>" +
								"<th>Nom</th>" +
								"<th>Prénom</th>" +
								"<th>Montant</th>" +
								"<th>N°</th>" +
								"<th></th>" +
								"<th></th>" +
								"<th></th>" +
								"<th></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeCheque -->" +
							"<tr>" +
								"<td>{listeCheque.opeId}</td>" +
								"<td>{listeCheque.idRemiseCheque}</td>" +
								"<td>{listeCheque.opeDate}</td>" +
								"<td>{listeCheque.adhNumero}</td>" +
								"<td>{listeCheque.cptLabel}</td>" +
								"<td>{listeCheque.adhNom}</td>" +
								"<td>{listeCheque.adhPrenom}</td>" +
								"<td>{listeCheque.opeMontant}</td>" +
								"<td>{listeCheque.numeroCheque}</td>" +		
								"<td>{listeCheque.btnValider}</td>" +				
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"2\" id-operation=\"{listeCheque.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeCheque.opeId}\" title=\"Supprimer\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
								"<td>{listeCheque.opeMontant}</td>" +
							"</tr>" +
					"<!-- END listeCheque -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
				"<div id=\"espece\">" +
					"<div>Total : {totalEspece} {sigleMonetaire}</div>" +
					"<table id=\"table-espece\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th>Date</th>" +
								"<th>N°</th>" +
								"<th>Compte</th>" +
								"<th>Nom</th>" +
								"<th>Prénom</th>" +
								"<th>Montant</th>" +
								"<th></th>" +
								"<th></th>" +
								"<th></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeEspece -->" +
							"<tr>" +
								"<td>{listeEspece.opeDate}</td>" +
								"<td>{listeEspece.adhNumero}</td>" +
								"<td>{listeEspece.cptLabel}</td>" +
								"<td>{listeEspece.adhNom}</td>" +
								"<td>{listeEspece.adhPrenom}</td>" +
								"<td>{listeEspece.opeMontant}</td>" +
								"<td>" +
									"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeEspece.opeId}\">Ok</button>" +
								"</td>" +								
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"1\" id-operation=\"{listeEspece.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeEspece.opeId}\" title=\"Supprimer\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +								
							"</tr>" +
					"<!-- END listeEspece -->" +
						"</tbody>" +
					"</table>" +					
				"</div>" +
			"</div>" +
		"</div>";

	this.checkboxRemiseCheque = "<input class=\"ui-helper-hidden checkbox-remise-cheque\" type=\"checkbox\" value=\"{id}\" data-montant=\"{montant}\"/>";
	this.btnValider = "<span><button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{opeId}\">Ok</button></span>";
	
	this.dialogCreerRemiseCheque = 
		"<div id=\"dialog-creer-remise-cheque\" title=\"Remise de Chèque\">" +
			"Voulez-vous créer une Remise de Chèque pour un montant de : {montant} {sigleMonetaire} ?" +
		"</div>";
	
	this.dialogAjoutOperationRemiseCheque = 
		"<div id=\"dialog-creer-remise-cheque\" title=\"Remise de Chèque\">" +
			"A quelle remise voulez-vous ajouter ces opérations d’un total de : {montant} {sigleMonetaire} ?" +
			"<select id=\"select-remise-cheque\">" +
				"<option value=\"0\">--- Sélectionner ---</option>" +
				"<!-- BEGIN liste -->" +
				"<option value=\"{liste.id}\">{liste.numero} {liste.date}</option>" +
				"<!-- END liste -->" +
			"</select>" +
		"</div>";
	
	this.dialogValiderPaiement = 
		"<div id=\"dialog-valider-paiement\" title=\"Valider le paiement\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"<td>N° de compte : {cptLabel}</td>" +
					"</tr>" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant : {opeMontant} {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogSupprimerPaiement = 
		"<div id=\"dialog-supprimer-paiement\" title=\"Supprimer le paiement\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"<td>Voulez-vous supprimer le paiement ?</td>" +
					"</tr>" +
					"<tr>" +
						"<td>N° de compte : {cptLabel}</td>" +
					"</tr>" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant : {opeMontant}  {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogModifierPaiement = 
		"<div id=\"dialog-modifier-paiement\" title=\"Modifier le paiement\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"<td>N° de compte </td>" +
						"<td>{cptLabel}</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Montant</td>" +
						"<td><input type=\"text\" name=\"montant-rechargement\" value=\"{opeMontant}\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"montant\" maxlength=\"12\" size=\"5\"/> <span>{sigleMonetaire}</span></td>" +
					"</tr>" +
					"{champComplementaire}" +
				"</table>" +
			"</form>" +
		"</div>";
	

	this.listeRemiseCheque =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-remise-archive\">" +
					"<span class=\"com-float-left\">Les remises encaissées</span>" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-e\"></span>" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content-transparent ui-corner-all\">" +		
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Liste des remises de chèques</div>" +						
				"<div>" +		
					"<table id=\"table-liste-remise-cheque\">" +
						"<thead>" +
						"<tr>" +
							"<th>Remise de chèque</th>" +
							"<th>Date</th>" +
							"<th>Montant</th>" +
							"<th></th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN liste -->" +
						"<tr>" +
							"<td>{liste.numero}</td>" +
							"<td>{liste.dateCreation}</td>" +
							"<td>{liste.montant}</td>" +
							"<td>" +
								"<span class=\"btn-detail-remise com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" data-id=\"{liste.id}\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
					"<!-- END liste -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +				
			"</div>" +
		"</div>";
	
	this.listeRemiseChequeArchive =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-remise-encours\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Les remises en cours" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content-transparent ui-corner-all\">" +		
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Liste des remises de chèques encaissées</div>" +						
				"<div>" +		
					"<table id=\"table-liste-remise-cheque\">" +
						"<thead>" +
						"<tr>" +
							"<th>Remise de chèque</th>" +
							"<th>Date</th>" +
							"<th>Montant</th>" +
							"<th></th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN liste -->" +
						"<tr>" +
							"<td>{liste.numero}</td>" +
							"<td>{liste.dateCreation}</td>" +
							"<td>{liste.montant}</td>" +
							"<td>" +
								"<span class=\"btn-detail-remise com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" data-id=\"{liste.id}\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
					"<!-- END liste -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +				
			"</div>" +
		"</div>";
	
	this.detailRemiseCheque =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-retour\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content-transparent ui-corner-all\">" +		
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Remise de chèque N°{numero} : {date}" +

					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-edt-supprimer\" data-id=\"{id}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-closethick\">" +
						"</span>" +
					"</span>" +
				"</div>" +	
				"<div>" +
					"Total : {montant} {sigleMonetaire}" +
					"<div class=\"com-center\">" +
						"<button type=\"button\" id=\"btn-valider-remise-cheque\" class=\"ui-state-default ui-corner-all com-button com-center\" data-id=\"{id}\" >" +
							"<span class=\"com-float-left ui-icon ui-icon-check\"></span>Valider" +
						"</button>" +
						"<button class=\"btn-menu-med ui-state-default ui-corner-all com-button\" id=\"btn-export\" data-id=\"{id}\">" +
							"<span class=\"com-float-left ui-icon ui-icon-print\"></span>Imprimer" +
						"</button>" +
					"</div>" +
				"</div><br/>" +
				"<div>" +		
					"<table id=\"table-liste-operation\">" +
						"<thead>" +
						"<tr>" +
							"<th>Date</th>" +
							"<th>N°</th>" +
							"<th>Compte</th>" +
							"<th>Nom</th>" +
							"<th>Prénom</th>" +
							"<th>Montant</th>" +
							"<th>N° chèque</th>" +
							"<th></th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN operations -->" +
						"<tr>" +
							"<td>{operations.date}</td>" +
							"<td>{operations.numeroAdherent}</td>" +
							"<td>{operations.compte}</td>" +
							"<td>{operations.nom}</td>" +
							"<td>{operations.prenom}</td>" +
							"<td>{operations.montant}</td>" +
							"<td>{operations.numeroCheque}</td>" +
							"<td>" +
								"<span class=\"btn-sup-operation com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" data-id=\"{operations.idOperation}\">" +
									"<span class=\"ui-icon ui-icon-closethick\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
					"<!-- END operations -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +				
			"</div>" +
		"</div>";
	
	this.dialogValiderRemiseCheque = 
		"<div id=\"dialog-remise-cheque\" title=\"Valider la remise de Chèque\">" +
			"Voulez-vous valider cette Remise de Chèque ?" +
		"</div>";

	this.dialogSupprimerOperationRemiseCheque = 
		"<div id=\"dialog-remise-cheque\" title=\"Supprimer l'opération de la remise de Chèque\">" +
			"Voulez-vous enlever cette opération de la remise de chèque ?" +
		"</div>";

	this.dialogSupprimerRemiseCheque = 
		"<div id=\"dialog-remise-cheque\" title=\"Supprimer la remise de Chèque\">" +
			"Voulez-vous supprimer cette remise de chèque ?<br/>" +
			"L’ensemble des opérations seront sans Remise de Chèque." +
		"</div>";

	this.dialogEditerCompte = 
		"<div id=\"dialog-edit-compte\" title=\"Editer le compte\">" +
			"<table>" +
				"<tr>" +
					"<td>N° de compte</td>" +
					"<td><input type=\"text\" value=\"{numeroCompte}\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"numeroCompte\"/></td>" +
				"</tr>" +
				"<tr>" +
					"<td>Raison Sociale</td>" +
					"<td><input type=\"text\" value=\"{raisonSociale}\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"raisonSociale\"/></td>" +
				"</tr>" +
			"</table>" +
		"</div>";
};