;function CompteZeybuTemplate() {
	this.InfoCompte =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Le Compte du Zeybu</div>" +
				"<table id=\"table-info-solde-zeybu\">" +
					"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th id=\"td-solde-zeybu-total\" class=\"com-table-th\">Solde Total : {soldeTotal} {sigleMonetaire}</th>" +
							"<th id=\"td-solde-zeybu-caisse\" class=\"com-table-th\">Montant en Caisse : {soldeCaisse} {sigleMonetaire}</th>" +
							"<th id=\"td-solde-zeybu-banque\" class=\"com-table-th\">Montant en Banque : {soldeBanque} {sigleMonetaire}</th>" +
						"</tr>" +
					"</thead>" +
				"</table>" +				
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
							"<td class=\"com-table-td td-montant\">{operation.debit}</td>" +
							"<td class=\"com-table-td td-montant\">{operation.credit}</td>" +
						"</tr>" +
					"<!-- END operation -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +				
			"</div>" +
		"</div>";
	
	this.listeAdherent = 
		"<div id=\"contenu\" class=\"ui-helper-reset\">" +
			"<div id=\"virements\">" +
				"<ul>" +
					"<li><a href=\"#virement-solidaire\">Virement Solidaire</a></li>" +
					"<li><a href=\"#virement-adherent\">Virement Adherent</a></li>" +
					"<li><a href=\"#virement-producteur\">Virement Producteur</a></li>" +
				"</ul>" +
				"<div id=\"virement-solidaire\">" +
						"<div class=\"com-center\"><button id=\"btn-virement-solidaire\" class=\"ui-state-default ui-corner-all com-button com-center\"> Compte Zeybu vers Compte Solidaire</button></div>" +
						"<div class=\"com-center\"><button id=\"btn-virement-solidaire-inverse\" class=\"ui-state-default ui-corner-all com-button com-center\"> Compte Solidaire vers Compte Zeybu</button></div>" +
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
								"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"></th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeAdherent -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-adherent\" >" +
								"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherent.adhId}</span>{listeAdherent.adhNumero}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeAdherent.cptLabel}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhNom}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhPrenom}</td>" +
								"<td class=\"com-table-td com-underline-hover com-center\">" +
									"<button class=\"btn-virement ui-state-default ui-corner-all com-button com-center\">Zeybu vers {listeAdherent.cptLabel}</button>" +
								"</td>" +
								"<td class=\"com-table-td com-underline-hover com-center\">" +
									"<button class=\"btn-virement-inverse ui-state-default ui-corner-all com-button com-center\">{listeAdherent.cptLabel} vers Zeybu</button>" +
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
								"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"></th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeProducteur -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-producteur\" >" +
								"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-producteur\">{listeProducteur.prdtId}</span>{listeProducteur.prdtNumero}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeProducteur.cptLabel}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtNom}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtPrenom}</td>" +
								"<td class=\"com-table-td com-underline-hover com-center\">" +
									"<button class=\"btn-virement ui-state-default ui-corner-all com-button com-center\">Zeybu vers {listeProducteur.cptLabel}</button>" +
								"</td>" +
								"<td class=\"com-table-td com-underline-hover com-center\">" +
									"<button class=\"btn-virement-inverse ui-state-default ui-corner-all com-button com-center\">{listeProducteur.cptLabel} vers Zeybu</button>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeProducteur -->" +
						"</tbody>" +
					"</table>" +					
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
}