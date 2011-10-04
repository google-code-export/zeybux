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
	
	this.listeOperationVide = 
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
				"<p id=\"texte-liste-vide\">Aucune Opération effectuée.</p>" +	
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
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom  com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"></th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeAdherent -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-adherent\" >" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherent.adhId}</span>{listeAdherent.adhNumero}</td>" +
								"<td class=\"com-table-td\">{listeAdherent.cptLabel}</td>" +
								"<td class=\"com-table-td\">{listeAdherent.adhNom}</td>" +
								"<td class=\"com-table-td\">{listeAdherent.adhPrenom}</td>" +
								"<td class=\"com-table-td com-center\">" +
									"<button class=\"btn-virement ui-state-default ui-corner-all com-button com-center\">Zeybu vers {listeAdherent.cptLabel}</button>" +
								"</td>" +
								"<td class=\"com-table-td com-center\">" +
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
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"></th>" +
								"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeProducteur -->" +
							"<tr class=\"com-cursor-pointer compte-ligne-producteur\" >" +
								"<td class=\"com-table-td\"><span class=\"ui-helper-hidden id-producteur\">{listeProducteur.prdtId}</span>{listeProducteur.prdtNumero}</td>" +
								"<td class=\"com-table-td\">{listeProducteur.cptLabel}</td>" +
								"<td class=\"com-table-td\">{listeProducteur.prdtNom}</td>" +
								"<td class=\"com-table-td\">{listeProducteur.prdtPrenom}</td>" +
								"<td class=\"com-table-td com-center\">" +
									"<button class=\"btn-virement ui-state-default ui-corner-all com-button com-center\">Zeybu vers {listeProducteur.cptLabel}</button>" +
								"</td>" +
								"<td class=\"com-table-td com-center\">" +
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
};function CompteZeybuVue(pParam) {	
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CompteZeybuVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=CompteZeybu&v=CompteZeybu", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		if(lResponse.soldeTotal != null) {
			lResponse.soldeTotal = lResponse.soldeTotal.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeTotal = '0'.nombreFormate(2,',',' ');
		}
		if(lResponse.soldeCaisse != null) {
			lResponse.soldeCaisse = lResponse.soldeCaisse.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeCaisse = '0'.nombreFormate(2,',',' ');
		}
		if(lResponse.soldeBanque != null) {
			lResponse.soldeBanque = lResponse.soldeBanque.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeBanque = '0'.nombreFormate(2,',',' ');
		}
		
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		$(lResponse.operation).each(function() {
			if(this.opeDate != null) {
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
				if(this.opeMontant < 0) {
					this.debit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
					this.credit = '';
				} else {
					this.debit = '';
					this.credit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				}
			}
		});

		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		if(lResponse.operation.length > 0 && lResponse.operation[0].opeId != null) {
			var lTemplate = lCompteZeybuTemplate.InfoCompte;
			
			var lHtml = $(lTemplate.template(lResponse));

			// Ne pas afficher la pagination si il y a moins de 30 éléments
			if(lResponse.operation.length < 31) {
				lHtml = this.masquerPagination(lHtml);
			} else {
				lHtml = this.paginnation(lHtml);
			}
			
			$('#contenu').replaceWith(that.affect(lHtml));
		} else {
			var lTemplate = lCompteZeybuTemplate.listeOperationVide;
			$('#contenu').replaceWith(lTemplate.template(lResponse));
		}
	}
	
	this.affect = function(pData) {
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false,size:30}); 
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.construct(pParam);
};function ListeVirementZeybuVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.modifVirement = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeVirementZeybuVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"listeVirement"};
		$.post(	"./index.php?m=CompteZeybu&v=Virements", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function(lResponse) {
		var that = this;
		var lCompteZeybuTemplate = new CompteZeybuTemplate();

		lResponse.sigleMonetaire = gSigleMonetaire;
		
		$(lResponse.operation).each(function() {
			if(this.opeDate != null) {
				that.modifVirement.push(this.opeId);

				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				var lData = {};
				lData.sigleMonetaire = gSigleMonetaire;
				if(this.opeMontant < 0) {
					lData.debit = (this.opeMontant * -1).nombreFormate(2,',',' ');
					this.debit = lCompteZeybuTemplate.montantDebit.template(lData);
					this.credit = '';
				} else {
					this.debit = '';
					lData.credit = this.opeMontant.nombreFormate(2,',',' ');
					this.credit = lCompteZeybuTemplate.montantCredit.template(lData);
				}
			}
		});

		if(lResponse.operation.length > 0 && lResponse.operation[0].opeId != null) {
			var lTemplate = lCompteZeybuTemplate.listeVirement;
			
			var lHtml = $(lTemplate.template(lResponse));

			// Ne pas afficher la pagination si il y a moins de 30 éléments
			if(lResponse.operation.length < 21) {
				lHtml = this.masquerPagination(lHtml);
			} else {
				lHtml = this.paginnation(lHtml);
			}
			
			$('#contenu').replaceWith(that.affect(lHtml));
		} else {
			$('#contenu').replaceWith(lCompteZeybuTemplate.listeVirementVide);
		}
	}
	
	this.affect = function(pData) {
		pData = this.ajoutModification(pData);
		pData = this.affectModification(pData);
		pData = this.affectSuppression(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} ,
	            5: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false,size:20}); 
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.ajoutModification = function(pData) {
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$(this.modifVirement).each(function() {
			pData.find("#td-edt-" + this).html(lCompteZeybuTemplate.btnEdt);
			pData.find("#td-sup-" + this).html(lCompteZeybuTemplate.btnSup);
		});		
		return pData;
	}
	
	this.affectModification = function(pData) {
		var that = this;
		pData.find(".btn-edt-modifier").click(function() {
			var lId = $(this).parents("tr").find(".id-operation").text();
			
			var lCompteZeybuTemplate = new CompteZeybuTemplate();
			var lTemplate = lCompteZeybuTemplate.dialogModifVirement;
			
			var lData = {};
			lData.label = $(this).parents("tr").find(".cpt-label").text();
			lData.montant = $(this).parents("tr").find(".montant").text();
			lData.sigleMonetaire = gSigleMonetaire;
									
			var lDialog = $(that.affectDialog($(lTemplate.template(lData)))).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:450,
				buttons: {
					'Valider': function() {
						that.modifierVirement(this,lId);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
			});
			lDialog.find('form').submit(function() {
				that.modifierVirement(lDialog,lId);
				return false;
			});
		});
		return pData;
	}
	
	this.modifierVirement = function(pDialog,pId) {
		var that = this;
		var lVo = new CompteZeybuModifierVirementVO();								
		lVo.id = pId;
		lVo.montant = $(pDialog).find(":input[name=montant]").val().numberFrToDb();
				
		var lValid = new CompteZeybuVirementValid();
		var lVr = lValid.validUpdate(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "modifier";
			var lDialog = this;
			$.post(	"./index.php?m=CompteZeybu&v=Virements", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_308_CODE;
						erreur.message = ERR_308_MSG;
						lVr.log.erreurs.push(erreur);
						//Infobulle.generer(lVr,'');
						var lParam = {vr:lVr};
						that.construct(lParam);
						$(pDialog).dialog("close");										
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		}else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.affectDialog = function(pData) {
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectSuppression = function(pData) {
		var that = this;
		pData.find(".btn-edt-supprimer").click(function() {
			var lId = $(this).parents("tr").find(".id-operation").text();
			
			var lCompteZeybuTemplate = new CompteZeybuTemplate();
			var lTemplate = lCompteZeybuTemplate.dialogSupVirement;
			
			var lData = {};
			lData.label = $(this).parents("tr").find(".cpt-label").text();
			lData.montant = $(this).parents("tr").find(".montant").text();
			lData.sigleMonetaire = gSigleMonetaire;
									
			var lDialog = $(lTemplate.template(lData)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:450,
				buttons: {
					'Valider': function() {
						that.supprimerVirement(this,lId);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
			});
			lDialog.find('form').submit(function() {
				that.supprimerVirement(lDialog,lId);
				return false;
			});
		});
		return pData;
	}
	
	this.supprimerVirement = function(pDialog,pId) {
		var that = this;
		var lVo = new CompteZeybuSupprimerVirementVO();								
		lVo.id = pId;
		
		var lValid = new CompteZeybuVirementValid();
		var lVr = lValid.validDelete(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "supprimer";
			var lDialog = this;
			$.post(	"./index.php?m=CompteZeybu&v=Virements", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_309_CODE;
						erreur.message = ERR_309_MSG;
						lVr.log.erreurs.push(erreur);
						//Infobulle.generer(lVr,'');
						var lParam = {vr:lVr};
						that.construct(lParam);
						$(pDialog).dialog("close");										
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		}else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
}	;function VirementZeybuVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.listeAdherent = [];
	this.listeProducteur = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {VirementZeybuVue(pParam);}} );
		var that = this;	
		var lParam = {fonction:"afficher"};
		$.post(	"./index.php?m=CompteZeybu&v=Virements", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse.valid) {
					if(pParam && pParam.vr) {
						Infobulle.generer(pParam.vr,'');
					}
					$(lResponse.listeAdherent).each(function() {
						that.listeAdherent[this.adhId] = this;
					});
					$(lResponse.listeProducteur).each(function() {
						that.listeProducteur[this.prdtId] = this;
					});
					
					that.solde = lResponse.solde;
					
					that.afficher(lResponse);
				} else {
					Infobulle.generer(lResponse,'');
				}
			},"json"
		);
	}
	
	this.afficher = function(lResponse) {
		var that = this;
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.listeAdherent;	
		var lHtml = $(lTemplate.template(lResponse));
		
		if(lResponse.listeAdherent.length <= 0 || lResponse.listeAdherent[0].adhId == null) {
			lHtml.find("#virement-adherent").replaceWith(lCompteZeybuTemplate.listeAdherentVide);
		}
		if(lResponse.listeProducteur.length <= 0 || lResponse.listeProducteur[0].prdtId == null) {
			lHtml.find("#virement-producteur").replaceWith(lCompteZeybuTemplate.listeProducteurVide);
		}
		
		$('#contenu').replaceWith(that.affect(lHtml));
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectTabs(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectVirementSolidaire(pData);
		pData = this.affectVirement(pData);
		return pData;
	}
	
	this.affectTabs = function(pData) {
		pData.find( "#virements" ).tabs();
		return pData;
	}

	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter-producteur").keyup(function() {
			$.uiTableFilter( $('.table-producteur'), this.value );
		});
		
		pData.find("#filter-adherent").keyup(function() {
			$.uiTableFilter( $('.table-adherent'), this.value );
		});
		
		pData.find("#filter-form-producteur, #filter-form-adherent").submit(function () {return false;});
		
		return pData;
	}

	this.affectVirementSolidaire = function(pData) {
		var that = this;
		pData.find("#btn-virement-solidaire").click(function() {that.virementSolidaire(1);});
		pData.find("#btn-virement-solidaire-inverse").click(function() {that.virementSolidaire(2);});
		return pData;
	}
	
	this.virementSolidaire = function(pType) {
		var that = this;			
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.dialogVirementSolidaire;
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;
		lData.type = 2;
		if(pType == 1) {
			lData.cptDebit = "Zeybu";
			lData.cptCredit = "Solidaire";
			lData.idCptDebit = -1;
			lData.idCptCredit = -2;
		} else {
			lData.cptDebit = "Solidaire";
			lData.cptCredit ="Zeybu";
			lData.idCptDebit = -2;
			lData.idCptCredit = -1;
		}
									
		var lDialog = $(this.affectDialog($(lTemplate.template(lData)))).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:450,
			buttons: {
				'Valider': function() {
					that.envoyerVirement(this,lData);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
		lDialog.find('form').submit(function() {
			that.envoyerVirement(lDialog,lData);
			return false;
		});
	}
	
	this.affectVirement = function(pData) {
		var that = this;
		pData.find(".compte-ligne-adherent").each(function() {
			var lId = $(this).find(".id-adherent").text();
			$(this).find(".btn-virement").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit ="Zeybu";
				lData.cptCredit = that.listeAdherent[lId].cptLabel;
				lData.idCptDebit = -1;
				lData.idCptCredit = that.listeAdherent[lId].adhIdCompte;
				that.virement(lData);
			});
			$(this).find(".btn-virement-inverse").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit = that.listeAdherent[lId].cptLabel;
				lData.cptCredit ="Zeybu";
				lData.idCptDebit = that.listeAdherent[lId].adhIdCompte;
				lData.idCptCredit = -1;
				that.virement(lData);
			});
		});
		pData.find(".compte-ligne-producteur").each(function() {
			var lId = $(this).find(".id-producteur").text();	
			$(this).find(".btn-virement").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit ="Zeybu";
				lData.cptCredit = that.listeProducteur[lId].cptLabel;
				lData.idCptDebit = -1;
				lData.idCptCredit = that.listeProducteur[lId].prdtIdCompte;
				that.virement(lData);
			});
			$(this).find(".btn-virement-inverse").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit = that.listeProducteur[lId].cptLabel;
				lData.cptCredit ="Zeybu";
				lData.idCptDebit = that.listeProducteur[lId].prdtIdCompte;
				lData.idCptCredit = -1;
				that.virement(lData);
			});
		});
		return pData;
	}
	
	this.virement = function(pData) {
		var that = this;
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.dialogAjoutVirement;
		pData.sigleMonetaire = gSigleMonetaire;
								
		var lDialog = $(this.affectDialog($(lTemplate.template(pData)))).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:450,
			buttons: {
				'Valider': function() {
					that.envoyerVirement(this,pData);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
		lDialog.find('form').submit(function() {
			that.envoyerVirement(lDialog,pData);
			return false;
		});
	}
	
	this.affectDialog = function(pData) {
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.envoyerVirement = function(pDialog,pData) {
		var lVo = new CompteZeybuAjoutVirementVO();								
		lVo.idCptDebit = pData.idCptDebit;								
		lVo.idCptCredit = pData.idCptCredit;								
		lVo.type = pData.type;
		lVo.montant = $(pDialog).find(":input[name=montant]").val().numberFrToDb();
		
		var lValid = new CompteZeybuVirementValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "ajout";
			var lDialog = this;
			$.post(	"./index.php?m=CompteZeybu&v=Virements", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_307_CODE;
						erreur.message = ERR_307_MSG;
						lVr.log.erreurs.push(erreur);
						Infobulle.generer(lVr,'');
						
						$(pDialog).dialog("close");										
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		}else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
}	