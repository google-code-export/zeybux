;function VirementZeybuVue(pParam) {
	this.listeAdherent = [];
	this.listeProducteur = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {VirementZeybuVue(pParam);}} );
		var that = this;	
		var lParam = {fonction:"afficher"};
		$.post(	"./index.php?m=CompteZeybu&v=Virements", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						$(lResponse.listeAdherent).each(function() {
							that.listeAdherent[this.adhId] = this;
						});
						$(lResponse.listeProducteur).each(function() {
							that.listeProducteur[this.ferId] = this;
						});
						
						that.solde = lResponse.solde;
						
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;
		
		$.each(lResponse.listeAdherent,function() {
			this.adhIdTri = this.adhNumero.replace("Z","");
		});
		$.each(lResponse.listeProducteur,function() {
			this.ferIdTri = this.ferNumero.replace("F","");
		});
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.listeAdherent;	
		var lHtml = $(lTemplate.template(lResponse));
		
		if(lResponse.listeAdherent.length <= 0 || lResponse.listeAdherent[0].adhId == null) {
			lHtml.find("#virement-adherent").replaceWith(lCompteZeybuTemplate.listeAdherentVide);
		}
		if(lResponse.listeProducteur.length <= 0 || lResponse.listeProducteur[0].ferId == null) {
			lHtml.find("#virement-producteur").replaceWith(lCompteZeybuTemplate.listeProducteurVide);
		}
		
		$('#contenu').replaceWith(that.affect(lHtml));
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectTabs(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectVirementSolidaire(pData);
		pData = this.affectVirement(pData);
		pData = this.affectVirementAssociation(pData);
		return pData;
	};
	
	this.affectTabs = function(pData) {
		pData.find( "#virements" ).tabs();
		return pData;
	};

	this.affectTri = function(pData) {
		pData.find('.table-adherent').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false},5: {sorter: false} }});
		pData.find('.table-producteur').tablesorter({sortList: [[0,0]],headers: { 3: {sorter: false},4: {sorter: false} }});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter-producteur").keyup(function() {
			$.uiTableFilter( $('.table-producteur'), this.value );
		});
		
		pData.find("#filter-adherent").keyup(function() {
			$.uiTableFilter( $('.table-adherent'), this.value );
		});
		
		pData.find("#filter-form-producteur, #filter-form-adherent").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectVirementAssociation = function(pData) {
		var that = this;
		pData.find("#btn-virement-association").click(function() {that.virementAssociation();});
		return pData;
	};
	
	this.virementAssociation = function() {
		var that = this;			
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.dialogVirementSolidaire;
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;
		lData.type = 1;
		lData.cptDebit = "Marché";
		lData.cptCredit = "Association";
		lData.idCptDebit = -1;
		lData.idCptCredit = -4;
									
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
	};

	this.affectVirementSolidaire = function(pData) {
		var that = this;
		pData.find("#btn-virement-solidaire").click(function() {that.virementSolidaire(1);});
		pData.find("#btn-virement-solidaire-inverse").click(function() {that.virementSolidaire(2);});
		return pData;
	};
	
	this.virementSolidaire = function(pType) {
		var that = this;			
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.dialogVirementSolidaire;
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;
		lData.type = 2;
		if(pType == 1) {
			lData.cptDebit = "Marché";
			lData.cptCredit = "Solidaire";
			lData.idCptDebit = -1;
			lData.idCptCredit = -2;
		} else {
			lData.cptDebit = "Solidaire";
			lData.cptCredit ="Marché";
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
	};
	
	this.affectVirement = function(pData) {
		var that = this;
		pData.find(".compte-ligne-adherent").each(function() {
			var lId = $(this).attr("id-adherent");
			$(this).find(".btn-virement").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit ="Marché";
				lData.cptCredit = that.listeAdherent[lId].cptLabel;
				lData.idCptDebit = -1;
				lData.idCptCredit = that.listeAdherent[lId].adhIdCompte;
				that.virement(lData);
			});
			$(this).find(".btn-virement-inverse").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit = that.listeAdherent[lId].cptLabel;
				lData.cptCredit ="Marché";
				lData.idCptDebit = that.listeAdherent[lId].adhIdCompte;
				lData.idCptCredit = -1;
				that.virement(lData);
			});
		});
		pData.find(".compte-ligne-producteur").each(function() {
			var lId = $(this).attr("id-producteur");	
			$(this).find(".btn-virement").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit ="Marché";
				lData.cptCredit = that.listeProducteur[lId].cptLabel;
				lData.idCptDebit = -1;
				lData.idCptCredit = that.listeProducteur[lId].ferIdCompte;
				that.virement(lData);
			});
			$(this).find(".btn-virement-inverse").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit = that.listeProducteur[lId].cptLabel;
				lData.cptCredit ="Marché";
				lData.idCptDebit = that.listeProducteur[lId].ferIdCompte;
				lData.idCptCredit = -1;
				that.virement(lData);
			});
		});
		return pData;
	};
	
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
	};
	
	this.affectDialog = function(pData) {
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
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
			//var lDialog = this;
			$.post(	"./index.php?m=CompteZeybu&v=Virements", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
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
					}
				},"json"
			);
		}else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.construct(pParam);
}	