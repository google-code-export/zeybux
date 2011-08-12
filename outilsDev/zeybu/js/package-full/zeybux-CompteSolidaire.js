;function CompteSolidaireTemplate() {
	this.compte =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Solde : {solde} {sigleMonetaire}</div>" +
								
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
	this.montantCredit = "{credit} {sigleMonetaire}";
	
	this.btnEdt = 
		"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\">" +
			"<span class=\"ui-icon ui-icon-pencil\">" +
		"</span>";
	
	this.btnSup = 
		"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\">" +
			"<span class=\"ui-icon ui-icon-closethick\">" +
		"</span>";
	
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
								"</div>" +
							"</form>" +
						"</div>" +
						"<table class=\"com-table\">" +
							"<thead>" +
								"<tr class=\"ui-widget ui-widget-header\">" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"</tr>" +
							"</thead>" +
							"<tbody>" +
						"<!-- BEGIN listeAdherent -->" +
								"<tr class=\"com-cursor-pointer compte-ligne\" >" +
									"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherent.adhId}</span>{listeAdherent.adhNumero}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeAdherent.cptLabel}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhNom}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhPrenom}</td>" +
								"</tr>" +
						"<!-- END listeAdherent -->" +
							"</tbody>" +
						"</table>" +
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
	
	this.dialogAjoutVirement = 
		"<div id=\"dialog-ajout-virement\" title=\"Virement Solidaire\">" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"Destinataire : {adhNumero} {adhPrenom} {adhNom}" +
					"</tr>" +
					"<tr>" +
						"N° de compte : {cptLabel}" +
					"</tr>" +
					"<tr class=\"com-center\" >" +
						"<td class=\"com-table-form-td montant-virement\">" +
							"Montant <input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"montant\" maxlength=\"12\" id=\"montant\"/> {sigleMonetaire}" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
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
};function CompteSolidaireVue(pParam) {	
	this.mCommunVue = new CommunVue();
	this.solde = 0;
	this.modifVirement = [];
	
	this.construct = function(pParam) {
		var that = this;
		var lParam = {fonction:"compte"};
		$.post(	"./index.php?m=CompteSolidaire&v=CompteSolidaire", "pParam=" + $.toJSON(lParam),
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
		var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
		
		this.solde = lResponse.solde;
		lResponse.solde = lResponse.solde.nombreFormate(2,',',' ');		
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		$(lResponse.operation).each(function() {
			if(this.opeDate != null) {
				
				// Si c'est un virement émission solidaire et qu'il date de moins de 15 jours 
				if(this.opeTypePaiement == 9 && differenceDateTime(this.opeDate,getDateTimeAujourdhuiDb()) > -15000000) {
					that.modifVirement.push(this.opeId);
				}				
				
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				//if(this.typePaiement == null) {this.typePaiement ='';} // Si ce n'est pas un paiement il n'y a pas de type
				var lData = {};
				lData.sigleMonetaire = gSigleMonetaire;
				if(this.opeMontant < 0) {
					lData.debit = (this.opeMontant * -1).nombreFormate(2,',',' ');
					this.debit = lCompteSolidaireTemplate.montantDebit.template(lData);
					this.credit = '';
				} else {
					this.debit = '';
					lData.credit = this.opeMontant.nombreFormate(2,',',' ');
					this.credit = lCompteSolidaireTemplate.montantCredit.template(lData);
				}
			}
		});
				
		
		var lTemplate = lCompteSolidaireTemplate.compte;
		
		var lHtml = $(lTemplate.template(lResponse));

		// Ne pas afficher la pagination si il y a moins de 30 éléments
		if(lResponse.operation.length < 21) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}
		
		$('#contenu').replaceWith(that.affect(lHtml));
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
		var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
		$(this.modifVirement).each(function() {
			pData.find("#td-edt-" + this).html(lCompteSolidaireTemplate.btnEdt);
			pData.find("#td-sup-" + this).html(lCompteSolidaireTemplate.btnSup);
		});		
		return pData;
	}
	
	this.affectModification = function(pData) {
		var that = this;
		pData.find(".btn-edt-modifier").click(function() {
			var lId = $(this).parents("tr").find(".id-operation").text();
			
			var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
			var lTemplate = lCompteSolidaireTemplate.dialogModifVirement;
			
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
						that.modifierVirement(this,lId,lData.montant);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
			});
			lDialog.find('form').submit(function() {
				that.modifierVirement(lDialog,lId,lData.montant);
				return false;
			});
		});
		return pData;
	}
	
	this.modifierVirement = function(pDialog,pId,pMontant) {
		var that = this;
		var lVo = new CompteSolidaireModifierVirementVO();								
		lVo.id = pId;
		lVo.montantActuel = pMontant.numberFrToDb();
		lVo.montant = $(pDialog).find(":input[name=montant]").val().numberFrToDb();
		lVo.solde = this.solde;
				
		var lValid = new CompteSolidaireVirementValid();
		var lVr = lValid.validUpdate(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "modifierVirement";
			var lDialog = this;
			$.post(	"./index.php?m=CompteSolidaire&v=CompteSolidaire", "pParam=" + $.toJSON(lVo),
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
			
			var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
			var lTemplate = lCompteSolidaireTemplate.dialogSupVirement;
			
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
		var lVo = new CompteSolidaireSupprimerVirementVO();								
		lVo.id = pId;
		
		var lValid = new CompteSolidaireVirementValid();
		var lVr = lValid.validDelete(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "supprimerVirement";
			var lDialog = this;
			$.post(	"./index.php?m=CompteSolidaire&v=CompteSolidaire", "pParam=" + $.toJSON(lVo),
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
};function CompteSolidaireListeAdherentVue(pParam) {	
	this.mCommunVue = new CommunVue();
	this.listeAdherent = [];
	this.solde = 0;
	
	this.construct = function(pParam) {
	var that = this;
	var lParam = {fonction:"adherent"};
	$.post(	"./index.php?m=CompteSolidaire&v=ListeAdherent", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse.valid) {
					if(pParam && pParam.vr) {
						Infobulle.generer(pParam.vr,'');
					}
					$(lResponse.listeAdherent).each(function() {
						that.listeAdherent[this.adhId] = this;
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
		var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
		
		if(lResponse.listeAdherent.length > 0 && lResponse.listeAdherent[0].adhId != null) {
			var lTemplate = lCompteSolidaireTemplate.listeAdherent;		
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(lCompteSolidaireTemplate.listeAdherentVide);
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectVirement(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
			$.uiTableFilter( $('.com-table'), this.value );
		});
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}
			
	this.affectVirement = function(pData) {
		var that = this;
		pData.find(".compte-ligne").click(function() {			
			var lId = $(this).find(".id-adherent").text();

			var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
			var lTemplate = lCompteSolidaireTemplate.dialogAjoutVirement;
			var lData = that.listeAdherent[lId];
			lData.sigleMonetaire = gSigleMonetaire;
									
			var lDialog = $(that.affectDialog($(lTemplate.template(lData)))).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:450,
				buttons: {
					'Valider': function() {
						that.envoyerVirement(this,lId);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
			});
			lDialog.find('form').submit(function() {
				that.envoyerVirement(lDialog,lId);
				return false;
			});		
		});
		return pData;
	}
	
	this.affectDialog = function(pData) {
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}

	this.envoyerVirement = function(pDialog,pId) {
		var lVo = new CompteSolidaireAjoutVirementVO();								
		lVo.id = pId;
		lVo.montant = $(pDialog).find(":input[name=montant]").val().numberFrToDb();
		lVo.solde = this.solde;
		
		var lValid = new CompteSolidaireVirementValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "ajoutVirement";
			var lDialog = this;
			$.post(	"./index.php?m=CompteSolidaire&v=ListeAdherent", "pParam=" + $.toJSON(lVo),
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