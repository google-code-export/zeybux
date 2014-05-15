;function CompteZeybuTemplate() {
	this.rechercheListeOperation = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Compte Marché" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-liste-operation\" title=\"Exporter\">" +
					"<span class=\"ui-icon ui-icon-print\">" +
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
			"<div id=\"listePaiement\">" +
				"<ul>" +
					"<li><a href=\"#cheque-adherent\" id=\"li-cheque-adherent\">Chèques Adhérent</a></li>" +
					"<li><a href=\"#espece-adherent\" id=\"li-espece-adherent\">Espèces Adhérent</a></li>" +
					"<li><a href=\"#cheque-ferme\" id=\"li-cheque-ferme\">Chèques Ferme</a></li>" +
					"<li><a href=\"#espece-ferme\" id=\"li-espece-ferme\">Espèces Ferme</a></li>" +
				"</ul>" +
				"<div id=\"cheque-adherent\">" +
					"<div>Total : {totalChequeAdherent} {sigleMonetaire}</div>" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-cheque-adherent\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-cheque-adherent\" id=\"filter-cheque-adherent\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"{chequeInvite}" +
					"Adhérents" +
					"<table class=\"com-table table-cheque-adherent\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-underline-hover td-date com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Date</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer tab-cell-compte\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-montant\"><span class=\"ui-icon span-icon\"></span>Montant</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover com-cursor-pointer td-edt\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeChequeAdherent -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-adherent\">" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeChequeAdherent.opeDateTri}</span>{listeChequeAdherent.opeDate}</td>" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeChequeAdherent.adhIdTri}</span>" +
									"{listeChequeAdherent.adhNumero}</td>" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeChequeAdherent.cptIdTri}</span>" +
									"{listeChequeAdherent.cptLabel}" +
								"</td>" +
								"<td class=\"com-table-td\">{listeChequeAdherent.adhNom}</td>" +
								"<td class=\"com-table-td\">{listeChequeAdherent.adhPrenom}</td>" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeChequeAdherent.opeMontant}</span>{listeChequeAdherent.opeMontantAffichage} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{listeChequeAdherent.numeroCheque}</td>" +
								"<td class=\"com-table-td-med com-center\">" +
									"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeChequeAdherent.opeId}\">Ok</button>" +
								"</td>" +
								
								"<td class=\"com-table-td-med td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"2\" id-operation=\"{listeChequeAdherent.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeChequeAdherent.opeId}\" title=\"Supprimer\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
								
								
							"</tr>" +
					"<!-- END listeChequeAdherent -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
				"<div id=\"espece-adherent\">" +
					"<div>Total : {totalEspeceAdherent} {sigleMonetaire}</div>" +
					"<div id=\"liste-prdt-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-espece-adherent\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-espece-adherent\" id=\"filter-espece-adherent\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"{especeInvite}" +
					"Adhérents" +
					"<table class=\"com-table table-espece-adherent\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-underline-hover td-date com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Date</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer tab-cell-compte\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-montant\"><span class=\"ui-icon span-icon\"></span>Montant</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover com-cursor-pointer td-edt\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeEspeceAdherent -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-producteur\">" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeEspeceAdherent.opeDateTri}</span>{listeEspeceAdherent.opeDate}</td>" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeEspeceAdherent.adhIdTri}</span>" +
									"{listeEspeceAdherent.adhNumero}</td>" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeEspeceAdherent.cptIdTri}</span>" +
									"{listeEspeceAdherent.cptLabel}" +
								"</td>" +
								"<td class=\"com-table-td\">{listeEspeceAdherent.adhNom}</td>" +
								"<td class=\"com-table-td\">{listeEspeceAdherent.adhPrenom}</td>" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeEspeceAdherent.opeMontant}</span>{listeEspeceAdherent.opeMontantAffichage} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td-med com-center\">" +
									"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeEspeceAdherent.opeId}\">Ok</button>" +
								"</td>" +
								
								"<td class=\"com-table-td-med td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"1\" id-operation=\"{listeEspeceAdherent.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeEspeceAdherent.opeId}\" title=\"Supprimer\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
								
							"</tr>" +
					"<!-- END listeEspeceAdherent -->" +
						"</tbody>" +
					"</table>" +					
				"</div>" +
				"<div id=\"cheque-ferme\">" +
					"<div>Total : {totalChequeFerme} {sigleMonetaire}</div>" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-cheque-ferme\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-cheque-ferme\" id=\"filter-cheque-ferme\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-cheque-ferme\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-underline-hover td-date com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Date</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer tab-cell-compte\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-montant\"><span class=\"ui-icon span-icon\"></span>Montant</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover com-cursor-pointer td-edt\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeChequeFerme -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-adherent\">" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeChequeFerme.opeDateTri}</span>{listeChequeFerme.opeDate}</td>" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeChequeFerme.ferIdTri}</span>" +
									"{listeChequeFerme.ferNumero}</td>" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeChequeFerme.cptIdTri}</span>" +
									"{listeChequeFerme.cptLabel}" +
								"</td>" +
								"<td class=\"com-table-td\">{listeChequeFerme.ferNom}</td>" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeChequeFerme.opeMontant}</span>{listeChequeFerme.opeMontantAffichage} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{listeChequeFerme.numeroCheque}</td>" +
								"<td class=\"com-table-td-med com-center\">" +
									"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeChequeFerme.opeId}\">Ok</button>" +
								"</td>" +
								

								"<td class=\"com-table-td-fin td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"2\" id-operation=\"{listeChequeFerme.opeId}\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								
							"</tr>" +
					"<!-- END listeChequeFerme -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
				"<div id=\"espece-ferme\">" +
					"<div>Total : {totalEspeceFerme} {sigleMonetaire}</div>" +
					"<div id=\"liste-prdt-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-espece-ferme\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-espece-ferme\" id=\"filter-espece-ferme\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-espece-ferme\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-underline-hover td-date com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Date</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer tab-cell-compte\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-montant\"><span class=\"ui-icon span-icon\"></span>Montant</th>" +
								"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover com-cursor-pointer td-edt\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeEspeceFerme -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-producteur\">" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeEspeceFerme.opeDateTri}</span>{listeEspeceFerme.opeDate}</td>" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeEspeceFerme.ferIdTri}</span>" +
									"{listeEspeceFerme.ferNumero}</td>" +
								"<td class=\"com-table-td\">" +
									"<span class=\"ui-helper-hidden\">{listeEspeceFerme.cptIdTri}</span>" +
									"{listeEspeceFerme.cptLabel}" +
								"</td>" +
								"<td class=\"com-table-td\">{listeEspeceFerme.ferNom}</td>" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeEspeceFerme.opeMontant}</span>{listeEspeceFerme.opeMontantAffichage} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td-med com-center\">" +
									"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeEspeceFerme.opeId}\">Ok</button>" +
								"</td>" +

								"<td class=\"com-table-td-fin td-edt\">" +
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
	
	this.listePaiementVide = "<div id=\"{id}\" class=\"com-center\">Aucun paiement en attente.</div>";
	
	this.listeChequeInvite =
		"Invité" +
		"<table class=\"com-table table-cheque-invite\">" +
			"<thead>" +
				"<tr class=\"ui-widget ui-widget-header\">" +
					"<th class=\"com-table-th-debut com-underline-hover td-date com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Date</th>" +
					"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-montant\"><span class=\"ui-icon span-icon\"></span>Montant</th>" +
					"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
					"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
					"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
					"<th class=\"com-table-th-fin com-underline-hover com-cursor-pointer td-edt\"></th>" +
				"</tr>" +
			"</thead>" +
			"<tbody>" +
			"<!-- BEGIN listeChequeInvite -->" +
				"<tr class=\"com-cursor-pointer compte-ligne-adherent\">" +
					"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeChequeInvite.opeDateTri}</span>{listeChequeInvite.opeDate}</td>" +
					"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeChequeInvite.opeMontant}</span>{listeChequeInvite.opeMontantAffichage} {sigleMonetaire}</td>" +
					"<td class=\"com-table-td\">{listeChequeInvite.numeroCheque}</td>" +
					"<td class=\"com-table-td-med com-center\">" +
						"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeChequeInvite.opeId}\">Ok</button>" +
					"</td>" +
					
					"<td class=\"com-table-td-med td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"2\" id-operation=\"{listeChequeInvite.opeId}\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeChequeInvite.opeId}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
				"</tr>" +
			"<!-- END listeChequeInvite -->" +
			"</tbody>" +
		"</table>";
	
	this.listeEspeceInvite =
		"Invité" +
		"<table class=\"com-table table-espece-invite\">" +
			"<thead>" +
				"<tr class=\"ui-widget ui-widget-header\">" +
					"<th class=\"com-table-th-debut com-underline-hover td-date com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Date</th>" +
					"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer \"><span class=\"ui-icon span-icon\"></span>Montant</th>" +
					"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
					"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer td-edt\"></th>" +
					"<th class=\"com-table-th-fin com-underline-hover com-cursor-pointer td-edt\"></th>" +
				"</tr>" +
			"</thead>" +
			"<tbody>" +
				"<!-- BEGIN listeEspeceInvite -->" +
				"<tr class=\"com-cursor-pointer compte-ligne-producteur\">" +
					"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeEspeceInvite.opeDateTri}</span>{listeEspeceInvite.opeDate}</td>" +
					"<td class=\"com-table-td\"><span class=\"ui-helper-hidden\">{listeEspeceInvite.opeMontant}</span>{listeEspeceInvite.opeMontantAffichage} {sigleMonetaire}</td>" +
					"<td class=\"com-table-td-med com-center\">" +
						"<button class=\"btn-valid ui-state-default ui-corner-all com-button com-center\" id-operation=\"{listeEspeceInvite.opeId}\">Ok</button>" +
					"</td>" +
					"<td class=\"com-table-td-med td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier\" type=\"1\" id-operation=\"{listeEspeceInvite.opeId}\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\"></span>" +
						"</span>" +
					"</td>" +
					"<td class=\"com-table-td-fin td-edt\">" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer\"  id-operation=\"{listeEspeceInvite.opeId}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-trash\"></span>" +
						"</span>" +
					"</td>" +
					
				"</tr>" +
				"<!-- END listeEspeceInvite -->" +
			"</tbody>" +
		"</table>";	
	
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
	
	/*this.dialogModifierPaiementEspece = 
		"<div id=\"dialog-modifier-paiement\" title=\"Modifier le paiement\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"<td>N° de compte : {cptLabel}</td>" +
					"</tr>" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant <input type=\"text\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" value=\"{opeMontant}\" name=\"montant\" id=\"montant\" maxlength=\"12\" size=\"3\"/> {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";*/
}