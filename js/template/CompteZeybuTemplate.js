;function CompteZeybuTemplate() {
	this.rechercheListeOperation = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Compte Marché" +
				"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-export-liste-operation\" title=\"Exporter\">" +
					"<span class=\"ui-icon ui-icon-print\"></span>" +
				"</span>" +
				"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-edit-compte\" title=\"Editer le compte\">" +
					"<span class=\"ui-icon ui-icon-pencil\"></span>" +
				"</span>" +
			"</div>" +
			"<table id=\"table-info-solde-zeybu\">" +
				"<thead>" +
					"<tr class=\"ui-widget ui-widget-header\">" +
						"<th id=\"td-solde-zeybu-total\" class=\"com-table-th\">Solde Marché : {soldeTotal} {sigleMonetaire}</th>" +
						"<th id=\"td-solde-zeybu-banque\" class=\"com-table-th\">Montant en Banque : {soldeBanque} {sigleMonetaire}</th>" +
					"</tr>" +
					"<tr class=\"ui-widget ui-widget-header\">" +
						"<th id=\"td-solde-zeybu-banque\" class=\"com-table-th\">Solde Solidaire : {soldeSolidaire} {sigleMonetaire}</th>" +
						"<th id=\"td-solde-zeybu-caisse\" class=\"com-table-th\">Montant en Caisse : {soldeCaisse} {sigleMonetaire}</th>" +
					"</tr>" +
				"</thead>" +
			"</table>" +	
			"<div id=\"form-recherche-liste-operation\" class=\"com-center com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"Entre le <input type=\"text\" value=\"{dateDebut}\" id=\"dateDebut\" class=\"com-input-text ui-widget-content ui-corner-all\">" +
				" et le <input type=\"text\" value=\"{dateFin}\" id=\"dateFin\" class=\"com-input-text ui-widget-content ui-corner-all\"> " +
				"Marché " +
				"<select id=\"idMarche\" >" +
					"<option value=\"0\" >Tout</option>" +
					"<option value=\"-1\" >Hors Marché</option>" +
					"<!-- BEGIN listeMarche -->" +
					"<option value=\"{listeMarche.id}\">N° {listeMarche.numero}</option>" +
					"<!-- END listeMarche -->" +
				"</select>" +
				"<button type=\"button\" id=\"btn-rechercher-liste-operation\" class=\"ui-state-default ui-corner-all com-button com-center\">Rechercher</button>" +
				
			"</span>" +
			"</div>" +
			"<div id=\"liste-operation\" class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
			"</div>" +
		"</div>";
	
	this.listeOperationVide = "<p id=\"texte-liste-vide\">Aucune Opération effectuée.</p>";
	
	this.InfoCompte =
		"<div>" +				
			"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
				"<form>" +	
				"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
				"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
				"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
				"	<input type=\"hidden\" class=\"pagesize\" value=\"30\">" +
				"</form>" +	
			"</div>" +	
	
			"<table id=\"table-operation\" class=\"com-table\">" +
				"<thead>" +
				"<tr class=\"ui-widget ui-widget-header\" >" +
					"<th class=\"com-table-th\">Date</th>" +
					"<th class=\"com-table-th\">Compte</th>" +
					"<th class=\"com-table-th\">Libellé</th>" +
					"<th class=\"com-table-th\">Type de paiement</th>" +
					"<th class=\"com-table-th\">Débit</th>" +
					"<th class=\"com-table-th\">Crédit</th>" +
				"</tr>" +
				"</thead>" +
				"<tbody>" +
			"<!-- BEGIN operation -->" +
				"<tr>" +
					"<td class=\"com-table-td td-date \">{operation.opeDate}</td>" +
					"<td class=\"com-table-td td-date \">{operation.cptLabel}</td>" +
					"<td class=\"com-table-td td-libelle\">{operation.opeLibelle}</td>" +
					"<td class=\"com-table-td td-type-paiement\">{operation.tppType}</td>" +
					"<td class=\"com-table-td td-montant\">{operation.debit} {operation.sigleMonetaireDebit}</td>" +
					"<td class=\"com-table-td td-montant\">{operation.credit} {operation.sigleMonetaireCredit}</td>" +
				"</tr>" +
			"<!-- END operation -->" +
				"</tbody>" +
			"</table>" +
		"</div>";
		
	this.listeAdherent = 
		"<div id=\"contenu\" class=\"ui-helper-reset\">" +
			"<div id=\"virements\">" +
				"<ul>" +
					"<li><a href=\"#virement-solidaire\">Virement Solidaire</a></li>" +
					"<li><a href=\"#virement-adherent\">Virement Adherent</a></li>" +
					"<li><a href=\"#virement-producteur\">Virement Producteur</a></li>" +
					"<li><a href=\"#virement-association\">Virement Association</a></li>" +
				"</ul>" +
				"<div id=\"virement-solidaire\">" +
						"<div class=\"com-center\"><button id=\"btn-virement-solidaire\" class=\"ui-state-default ui-corner-all com-button com-center\"> Compte Marché vers Compte Solidaire</button></div>" +
						"<div class=\"com-center\"><button id=\"btn-virement-solidaire-inverse\" class=\"ui-state-default ui-corner-all com-button com-center\"> Compte Solidaire vers Compte Marché</button></div>" +
				"</div>" +	
				"<div id=\"virement-adherent\">" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-adherent\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-adherent\" id=\"filter-adherent\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-adherent\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"></th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeAdherent -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-adherent\" id-adherent=\"{listeAdherent.adhId}\">" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeAdherent.adhIdTri}</span>" +
									"{listeAdherent.adhNumero}</td>" +
								"<td class=\"com-table-td\">{listeAdherent.cptLabel}</td>" +
								"<td class=\"com-table-td\">{listeAdherent.adhNom}</td>" +
								"<td class=\"com-table-td\">{listeAdherent.adhPrenom}</td>" +
								"<td class=\"com-table-td com-center\">" +
									"<button class=\"btn-virement ui-state-default ui-corner-all com-button com-center\">Marché vers {listeAdherent.cptLabel}</button>" +
								"</td>" +
								"<td class=\"com-table-td com-center\">" +
									"<button class=\"btn-virement-inverse ui-state-default ui-corner-all com-button com-center\">{listeAdherent.cptLabel} vers Marché</button>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeAdherent -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
				"<div id=\"virement-producteur\">" +
					"<div id=\"liste-prdt-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-producteur\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-producteur\" id=\"filter-producteur\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-producteur\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"></th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeProducteur -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-producteur\" id-producteur=\"{listeProducteur.ferId}\">" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeProducteur.ferIdTri}</span>" +
									"{listeProducteur.ferNumero}" +
								"</td>" +
								"<td class=\"com-table-td\">{listeProducteur.cptLabel}</td>" +
								"<td class=\"com-table-td\">{listeProducteur.ferNom}</td>" +
								"<td class=\"com-table-td com-center\">" +
									"<button class=\"btn-virement ui-state-default ui-corner-all com-button com-center\">Marché vers {listeProducteur.cptLabel}</button>" +
								"</td>" +
								"<td class=\"com-table-td com-center\">" +
									"<button class=\"btn-virement-inverse ui-state-default ui-corner-all com-button com-center\">{listeProducteur.cptLabel} vers Marché</button>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeProducteur -->" +
						"</tbody>" +
					"</table>" +					
				"</div>" +
				"<div id=\"virement-association\">" +
					"<div class=\"com-center\"><button id=\"btn-virement-association\" class=\"ui-state-default ui-corner-all com-button com-center\">Compte Marché vers Compte Association</button></div>" +
				"</div>" +	
			"</div>" +
		"</div>";
	
	this.listeAdherentVide =
		"<div id=\"virement-adherent\">" +
			"<p id=\"texte-liste-vide\">Aucun adhérent dans la base.</p>" +	
		"</div>";
	
	this.listeProducteurVide =
		"<div id=\"virement-producteur\">" +
			"<p id=\"texte-liste-vide\">Aucun producteur dans la base.</p>" +	
		"</div>";

	this.dialogVirementSolidaire = 
		"<div id=\"dialog-ajout-virement\" title=\"Virement Solidaire\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"Du compte : {cptDebit} vers le compte : {cptCredit}" +
					"</tr>" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant <input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"montant\" maxlength=\"12\" id=\"montant\"/> {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogAjoutVirement = 
		"<div id=\"dialog-ajout-virement\" title=\"Virement\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"Du compte : {cptDebit} vers le compte : {cptCredit}" +
					"</tr>" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant <input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"montant\" maxlength=\"12\" id=\"montant\"/> {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.listeVirement =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +		
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Liste des virements</div>" +						
				"<div>" +				
					"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
						"<form>" +	
						"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
						"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
						"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
						"	<input type=\"hidden\" class=\"pagesize\" value=\"20\">" +
						"</form>" +	
					"</div>" +	
		
					"<table id=\"table-operation\" class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\" >" +
							"<th class=\"com-table-th\">Date</th>" +
							"<th class=\"com-table-th\">Compte</th>" +
							"<th class=\"com-table-th\">Débit</th>" +
							"<th class=\"com-table-th\">Crédit</th>" +
							"<th class=\"com-table-th\"></th>" +
							"<th class=\"com-table-th\"></th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN operation -->" +
						"<tr>" +
							"<td class=\"com-table-td td-date \"><span class=\"ui-helper-hidden id-operation\">{operation.opeId}</span>{operation.opeDate}</td>" +
							"<td class=\"com-table-td cpt-label\">{operation.cptLabel}</td>" +
							"<td class=\"com-table-td td-montant\">{operation.debit}</td>" +
							"<td class=\"com-table-td td-montant\">{operation.credit}</td>" +
							"<td class=\"com-table-td td-edt\" id=\"td-edt-{operation.opeId}\">" +
							"</td>" +
							"<td class=\"com-table-td td-edt\" id=\"td-sup-{operation.opeId}\">" +
							"</td>" +
						"</tr>" +
					"<!-- END operation -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +				
			"</div>" +
		"</div>";
	
	this.listeVirementVide = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Liste des virements</div>" +
				"<p id=\"texte-liste-vide\">Aucun Virement effectué.</p>" +	
			"</div>" +
		"</div>";
	
	this.montantDebit = "<span class=\"montant\">{debit}</span> {sigleMonetaire}";
	this.montantCredit = "<span class=\"montant\">{credit}</span> {sigleMonetaire}";
	
	this.btnEdt = 
		"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\">" +
			"<span class=\"ui-icon ui-icon-pencil\">" +
		"</span>";
	
	this.btnSup = 
		"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\">" +
			"<span class=\"ui-icon ui-icon-closethick\">" +
		"</span>";
	
	this.dialogModifVirement = 
		"<div id=\"dialog-ajout-virement\" title=\"Virement Solidaire\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"<td>N° de compte : {label}</td>" +
					"</tr>" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant <input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"montant\" maxlength=\"12\" id=\"montant\" value=\"{montant}\" /> {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogSupVirement = 
		"<div id=\"dialog-ajout-virement\" title=\"Supprimer un Virement\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"<td>N° de compte : {label}</td>" +
					"</tr>" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant {montant} {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.listePaiement = 
		"<div id=\"contenu\" class=\"ui-helper-reset\">" +
			"<div id=\"listePaiement\" class=\"ui-widget-content-transparent\">" +
				"<ul>" +
					"<li><a href=\"#cheque-adherent\" id=\"li-cheque-adherent\">Chèques Adhérent</a></li>" +
					"<li><a href=\"#espece-adherent\" id=\"li-espece-adherent\">Espèces Adhérent</a></li>" +
					"<li><a href=\"#cheque-ferme\" id=\"li-cheque-ferme\">Chèques Ferme</a></li>" +
					"<li><a href=\"#espece-ferme\" id=\"li-espece-ferme\">Espèces Ferme</a></li>" +
				"</ul>" +
				"<div id=\"cheque-adherent\" class=\"ui-widget-content-transparent\">" +
					"<div>Total : {totalChequeAdherent} {sigleMonetaire}</div>" +
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
					"{chequeInvite}" +
					"<br/>Adhérents" +
					"<table id=\"table-cheque-adherent\">" +
						"<thead>" +
							"<tr>" +
								"<th></th>" +
								"<th>Remise de<br/>Chèque</th>" +
								"<th>Date</th>" +
								"<th>N°</th>" +
								"<th>Compte</th>" +
								"<th>Nom</th>" +
								"<th>Prénom</th>" +
								"<th>Montant</th>" +
								"<th>N°</th>" +
								"<th></th>" +
								"<th></th>" +
								"<th></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeChequeAdherent -->" +
							"<tr>" +
								"<td>{listeChequeAdherent.opeId}</td>" +
								"<td>{listeChequeAdherent.idRemiseCheque}</td>" +
								"<td>{listeChequeAdherent.opeDate}</td>" +
								"<td>{listeChequeAdherent.adhNumero}</td>" +
								"<td>{listeChequeAdherent.cptLabel}</td>" +
								"<td>{listeChequeAdherent.adhNom}</td>" +
								"<td>{listeChequeAdherent.adhPrenom}</td>" +
								"<td>{listeChequeAdherent.opeMontant}</td>" +
								"<td>{listeChequeAdherent.numeroCheque}</td>" +							
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"2\" id-operation=\"{listeChequeAdherent.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeChequeAdherent.opeId}\" title=\"Supprimer\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
								"<td>{listeChequeAdherent.opeMontant}</td>" +
							"</tr>" +
					"<!-- END listeChequeAdherent -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
				"<div id=\"espece-adherent\" class=\"ui-widget-content-transparent\">" +
					"<div>Total : {totalEspeceAdherent} {sigleMonetaire}</div>" +
					"{especeInvite}" +
					"<br/>Adhérents" +
					"<table id=\"table-espece-adherent\">" +
						"<thead>" +
							"<tr >" +
								"<th></span>Date</th>" +
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
					"<!-- BEGIN listeEspeceAdherent -->" +
							"<tr>" +
								"<td>{listeEspeceAdherent.opeDate}</td>" +
								"<td>{listeEspeceAdherent.adhNumero}</td>" +
								"<td>{listeEspeceAdherent.cptLabel}</td>" +
								"<td>{listeEspeceAdherent.adhNom}</td>" +
								"<td>{listeEspeceAdherent.adhPrenom}</td>" +
								"<td>{listeEspeceAdherent.opeMontant}</td>" +
								"<td class=\"com-center\">" +
									"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeEspeceAdherent.opeId}\">Ok</button>" +
								"</td>" +
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"1\" id-operation=\"{listeEspeceAdherent.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeEspeceAdherent.opeId}\" title=\"Supprimer\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +								
							"</tr>" +
					"<!-- END listeEspeceAdherent -->" +
						"</tbody>" +
					"</table>" +					
				"</div>" +
				"<div id=\"cheque-ferme\" class=\"ui-widget-content-transparent\">" +
					"<div>Total : {totalChequeFerme} {sigleMonetaire}</div>" +
					"<br/><table id=\"table-cheque-ferme\">" +
						"<thead>" +
							"<tr>" +
								"<th>Date</th>" +
								"<th>N°</th>" +
								"<th>Compte</th>" +
								"<th>Nom</th>" +
								"<th>Montant</th>" +
								"<th>N°</th>" +
								"<th></th>" +
								"<th></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeChequeFerme -->" +
							"<tr>" +
								"<td>{listeChequeFerme.opeDate}</td>" +
								"<td>{listeChequeFerme.ferNumero}</td>" +
								"<td>{listeChequeFerme.cptLabel}</td>" +
								"<td>{listeChequeFerme.ferNom}</td>" +
								"<td>{listeChequeFerme.opeMontant}</td>" +
								"<td>{listeChequeFerme.numeroCheque}</td>" +
								"<td class=\"com-center\">" +
									"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeChequeFerme.opeId}\">Ok</button>" +
								"</td>" +
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"2\" id-operation=\"{listeChequeFerme.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeChequeFerme -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
				"<div id=\"espece-ferme\" class=\"ui-widget-content-transparent\">" +
					"<div>Total : {totalEspeceFerme} {sigleMonetaire}</div>" +
					"<br/><table id=\"table-espece-ferme\">" +
						"<thead>" +
							"<tr>" +
								"<th>Date</th>" +
								"<th>N°</th>" +
								"<th>Compte</th>" +
								"<th>Nom</th>" +
								"<th>Montant</th>" +
								"<th></th>" +
								"<th></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeEspeceFerme -->" +
							"<tr>" +
								"<td>{listeEspeceFerme.opeDate}</td>" +
								"<td>{listeEspeceFerme.ferNumero}</td>" +
								"<td>{listeEspeceFerme.cptLabel}</td>" +
								"<td>{listeEspeceFerme.ferNom}</td>" +
								"<td>{listeEspeceFerme.opeMontant}</td>" +
								"<td class=\"com-center\">" +
									"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeEspeceFerme.opeId}\">Ok</button>" +
								"</td>" +
								"<td>" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"1\" id-operation=\"{listeEspeceFerme.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeEspeceFerme -->" +
						"</tbody>" +
					"</table>" +					
				"</div>" +
			"</div>" +
		"</div>";
	
	this.checkboxRemiseCheque = "<input class=\"ui-helper-hidden checkbox-remise-cheque\" type=\"checkbox\" value=\"{id}\" data-montant=\"{montant}\"/>";
	
	/*this.listePaiementVide = "<div id=\"{id}\" class=\"com-center\">Aucun paiement en attente.</div>";*/
	
	this.listeChequeInvite =
		"<br/>Invité" +
		"<table id=\"table-cheque-invite\">" +
			"<thead>" +
				"<tr>" +
					"<th></th>" +
					"<th>Remise de<br/>Chèque</th>" +
					"<th>Date</th>" +
					"<th>Montant</th>" +
					"<th>N°</th>" +
					"<th></th>" +
					"<th></th>" +
					"<th></th>" +
				"</tr>" +
			"</thead>" +
			"<tbody>" +
			"<!-- BEGIN listeChequeInvite -->" +
				"<tr>" +
					"<td>{listeChequeInvite.opeId}</td>" +
					"<td>{listeChequeInvite.idRemiseCheque}</td>" +
					"<td>{listeChequeInvite.opeDate}</td>" +
					"<td>{listeChequeInvite.opeMontant}</td>" +
					"<td>{listeChequeInvite.numeroCheque}</td>" +				
					"<td>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"2\" id-operation=\"{listeChequeInvite.opeId}\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
					"</td>" +
					"<td>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeChequeInvite.opeId}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
					"<td>{listeChequeInvite.opeMontant}</td>" +
				"</tr>" +
			"<!-- END listeChequeInvite -->" +
			"</tbody>" +
		"</table>";
	
	this.listeEspeceInvite =
		"<br/>Invité" +
		"<table id=\"table-espece-invite\">" +
			"<thead>" +
				"<tr\">" +
					"<th>Date</th>" +
					"<th>Montant</th>" +
					"<th></th>" +
					"<th></th>" +
					"<th></th>" +
				"</tr>" +
			"</thead>" +
			"<tbody>" +
				"<!-- BEGIN listeEspeceInvite -->" +
				"<tr>" +
					"<td>{listeEspeceInvite.opeDate}</td>" +
					"<td>{listeEspeceInvite.opeMontant}</td>" +
					"<td class=\"com-center\">" +
						"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeEspeceInvite.opeId}\">Ok</button>" +
					"</td>" +
					"<td>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"1\" id-operation=\"{listeEspeceInvite.opeId}\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
					"</td>" +
					"<td>" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeEspeceInvite.opeId}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +					
				"</tr>" +
				"<!-- END listeEspeceInvite -->" +
			"</tbody>" +
		"</table>";	
	
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
							"Montant : {opeMontantAffichage} {sigleMonetaire}" +
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
							"Montant : {opeMontantAffichage} {sigleMonetaire}" +
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
}