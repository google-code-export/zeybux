;function SuiviPaiementVue(pParam) {
	this.mListeOperation = [];
	this.mSelectedTabs = 0;
	this.mBanques = [];
	this.mBanquesTriId = [];
	this.mTypePaiement = [];
	
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {SuiviPaiementVue(pParam);}} );
		var that = this;	
		var lParam = {fonction:"afficher"};
		if(pParam && pParam.selectedTabs) {
			this.mSelectedTabs = pParam.selectedTabs;
		}
		$.post(	"./index.php?m=CompteZeybu&v=SuiviPaiement", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						$(lResponse.banques).each(function() {
							that.mBanquesTriId[this.id] = this;
						});
						that.mBanques = lResponse.banques;
						that.mTypePaiement = lResponse.typePaiement;
						
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
		var lTotalEspeceAdherent = 0;
		$.each(lResponse.listeEspeceAdherent,function() {
			if(this.opeId) {
				this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.opeMontant = this.opeMontant.nombreFormate(2,',','');
				this.adhIdTri = this.adhNumero.replace("Z","");
				this.cptIdTri = this.cptLabel.replace("C","");
				lTotalEspeceAdherent += parseFloat(this.opeMontant);			
				that.mListeOperation[this.opeId] = this;
			}
		});
		var lTotalChequeAdherent = 0;
		$.each(lResponse.listeChequeAdherent,function() {
			if(this.opeId) {
				this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.opeMontant = this.opeMontant.nombreFormate(2,',','');
				this.adhIdTri = this.adhNumero.replace("Z","");
				this.cptIdTri = this.cptLabel.replace("C","");
				this.numeroCheque ='';
				if(this.opeTypePaiementChampComplementaire[3]) {
					this.numeroCheque = this.opeTypePaiementChampComplementaire[3].valeur; 
				}
				lTotalChequeAdherent += parseFloat(this.opeMontant);		
				that.mListeOperation[this.opeId] = this;
			}
		});
		var lTotalEspeceFerme = 0;
		$.each(lResponse.listeEspeceFerme,function() {
			if(this.opeId) {
				this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.opeMontant = this.opeMontant.nombreFormate(2,',','');
				this.ferIdTri = this.ferNumero.replace("F","");
				this.cptIdTri = this.cptLabel.replace("C","");
				lTotalEspeceFerme += parseFloat(this.opeMontant);		
				that.mListeOperation[this.opeId] = this;
			}
		});
		var lTotalChequeFerme = 0;
		$.each(lResponse.listeChequeFerme,function() {
			if(this.opeId) {
				this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.opeMontant = this.opeMontant.nombreFormate(2,',','');
				this.ferIdTri = this.ferNumero.replace("F","");
				this.cptIdTri = this.cptLabel.replace("C","");
				this.numeroCheque ='';
				if(this.opeTypePaiementChampComplementaire[3]) {
					this.numeroCheque = this.opeTypePaiementChampComplementaire[3].valeur; 
				}
				lTotalChequeFerme += parseFloat(this.opeMontant);		
				that.mListeOperation[this.opeId] = this;
			}
		});

		lResponse.sigleMonetaire = gSigleMonetaire;
		lResponse.totalEspeceAdherent = lTotalEspeceAdherent.nombreFormate(2,',',' ');
		lResponse.totalChequeAdherent = lTotalChequeAdherent.nombreFormate(2,',',' ');
		lResponse.totalEspeceFerme = lTotalEspeceFerme.nombreFormate(2,',',' ');
		lResponse.totalChequeFerme = lTotalChequeFerme.nombreFormate(2,',',' ');
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.listePaiement;	
		var lHtml = $(lTemplate.template(lResponse));
				
		if(lResponse.listeChequeAdherent.length <= 0 || (lResponse.listeChequeAdherent[0] && lResponse.listeChequeAdherent[0].adhId == null)) {
			lHtml.find("#cheque-adherent").replaceWith(lCompteZeybuTemplate.listePaiementVide.template({id:"cheque-adherent"}));
		}
		if(lResponse.listeEspeceAdherent.length <= 0 || (lResponse.listeEspeceAdherent[0] && lResponse.listeEspeceAdherent[0].adhId == null)) {
			lHtml.find("#espece-adherent").replaceWith(lCompteZeybuTemplate.listePaiementVide.template({id:"espece-adherent"}));
		}
		if(lResponse.listeChequeFerme.length <= 0 || (lResponse.listeChequeFerme[0] && lResponse.listeChequeFerme[0].ferId == null)) {
			lHtml.find("#cheque-ferme").replaceWith(lCompteZeybuTemplate.listePaiementVide.template({id:"cheque-ferme"}));
		}
		if(lResponse.listeEspeceFerme.length <= 0 || (lResponse.listeEspeceFerme[0] && lResponse.listeEspeceFerme[0].ferId == null)) {
			lHtml.find("#espece-ferme").replaceWith(lCompteZeybuTemplate.listePaiementVide.template({id:"espece-ferme"}));
		}
		
		$('#contenu').replaceWith(that.affect(lHtml));
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectTabs(pData);
		pData = this.affectValiderPaiement(pData);
		pData = this.affectModifierPaiement(pData);
		pData = this.affectSupprimerPaiement(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectTabs = function(pData) {
		var that = this;
		pData.find( "#listePaiement" ).tabs({selected:that.mSelectedTabs});
		pData.find("#li-cheque-adherent,#li-espece-adherent,#li-cheque-ferme,#li-espece-ferme").click(
				function() {that.mSelectedTabs = $("#listePaiement").tabs("option","selected");});
		return pData;
	};

	this.affectTri = function(pData) {
		pData.find('.table-cheque-adherent').tablesorter({sortList: [[0,0]],headers: { 7: {sorter: false} }});
		pData.find('.table-espece-adherent').tablesorter({sortList: [[0,0]],headers: { 6: {sorter: false} }});
		pData.find('.table-cheque-ferme').tablesorter({sortList: [[0,0]],headers: { 7: {sorter: false} }});
		pData.find('.table-espece-ferme').tablesorter({sortList: [[0,0]],headers: { 6: {sorter: false} }});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter-cheque-adherent").keyup(function() {
			$.uiTableFilter( $('.table-cheque-adherent'), this.value );
		});
		pData.find("#filter-espece-adherent").keyup(function() {
			$.uiTableFilter( $('.table-espece-adherent'), this.value );
		});
		pData.find("#filter-cheque-ferme").keyup(function() {
			$.uiTableFilter( $('.table-cheque-ferme'), this.value );
		});
		pData.find("#filter-espece-ferme").keyup(function() {
			$.uiTableFilter( $('.table-espece-ferme'), this.value );
		});
		
		pData.find("#filter-form-cheque-adherent, #filter-form-espece-adherent, #filter-form-cheque-ferme, #filter-form-espece-ferme").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectValiderPaiement= function(pData) {
		var that = this;
		pData.find(".btn-valid").click(function() {that.dialogValiderPaiement($(this).attr("id-operation"));});		
		return pData;
	};

	this.dialogValiderPaiement = function(pIdOperation) {
		var that = this;
		var lOperation = this.mListeOperation[pIdOperation];
		lOperation.sigleMonetaire = gSigleMonetaire;
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$(lCompteZeybuTemplate.dialogValiderPaiement.template(lOperation)).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:450,
			buttons: {
				'Valider': function() {
					that.validerPaiement(pIdOperation,this);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.validerPaiement = function(pIdOperation,pDialog) {
		var that = this;
		var lVo = { id:pIdOperation,
					fonction:"valider"};
		$.post(	"./index.php?m=CompteZeybu&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_351_CODE;
						erreur.message = ERR_351_MSG;
						lVr.log.erreurs.push(erreur);						
						$(pDialog).dialog("close");	
						that.construct({vr:lVr,selectedTabs:that.mSelectedTabs});									
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};

	this.affectModifierPaiement= function(pData) {
		var that = this;
		pData.find(".btn-modifier").click(function() {that.dialogModifierPaiement($(this).attr("id-operation"),$(this).attr("type"));});		
		return pData;
	};
	
	this.dialogModifierPaiement = function(pIdOperation, pType) {
		var that = this;
		
		var lOperation = this.mListeOperation[pIdOperation];
		lOperation.sigleMonetaire = gSigleMonetaire;
		lOperation.champComplementaire = '';
		if(this.mTypePaiement[pType] && this.mTypePaiement[pType].champComplementaire.length > 0) {
			
			var lTypePaiementService = new TypePaiementService();
			var lChampComplementaire = [];
			$(this.mTypePaiement[pType].champComplementaire).each(function() {				
				var lChamp = lOperation.opeTypePaiementChampComplementaire[this.id];
				lChamp.id = this.id;
				lChamp.tppCpVisible = 1;
				lChamp.chCpLabel = this.label;
				lChampComplementaire.push(lChamp);
			});
			
			lOperation.champComplementaire = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, this.mBanquesTriId);
		}

		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lDialog = $(that.affectDialog($(lCompteZeybuTemplate.dialogModifierPaiement.template(lOperation)))).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Valider': function() {
					that.modifierPaiement(pIdOperation,pType,this);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});		
		lDialog.find('form').submit(function() {
			that.modifierPaiement(pIdOperation,pType,lDialog);
			return false;
		});
	};
		
	this.modifierPaiement = function(pIdOperation,pType,pDialog) {
		var that = this;

		var lVo = new RechargementCompteVO();
		lVo.id = pIdOperation;
		lVo.fonction="modifier";
		lVo.montant=$(pDialog).find("#montant").val().numberFrToDb();
		if(pType == 1) { // Cheque
			lVo.champComplementaireObligatoire = 1;
			lVo.champComplementaire = $(pDialog).find("#champComplementaire").val();
			// Si id-banque est alimenté mais qu'on efface le nom de la banque par la suite
			// il ne faut pas prendre en compte le id-banque
			if($('#idBanque').val() != "") {
				lVo.idBanque = $('#idBanque').attr('id-banque');
			}
			lVo.typePaiement = 2;
		} else { // Espece
			lVo.typePaiement = 1;
			lVo.champComplementaireObligatoire = 0;
		}
		
		var lValid = new RechargementCompteValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			$.post(	"./index.php?m=CompteZeybu&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_352_CODE;
							erreur.message = ERR_352_MSG;
							lVr.log.erreurs.push(erreur);						
							$(pDialog).dialog("close");	
							that.construct({vr:lVr,selectedTabs:that.mSelectedTabs});									
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	

	this.affectDialog = function(pData) {
		var lTypePaiementService = new TypePaiementService();
		pData = lTypePaiementService.affect(pData, this.mBanques);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
		
	this.affectSupprimerPaiement= function(pData) {
		var that = this;
		pData.find(".btn-supprimer").click(function() {that.dialogSupprimerPaiement($(this).attr("id-operation"));});		
		return pData;
	};

	this.dialogSupprimerPaiement = function(pIdOperation) {
		var that = this;
		var lOperation = this.mListeOperation[pIdOperation];
		lOperation.sigleMonetaire = gSigleMonetaire;
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$(lCompteZeybuTemplate.dialogSupprimerPaiement.template(lOperation)).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:450,
			buttons: {
				'Supprimer': function() {
					that.supprimerPaiement(pIdOperation,this);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.supprimerPaiement = function(pIdOperation,pDialog) {
		var that = this;
		var lVo = { id:pIdOperation,
					fonction:"supprimer"};
		$.post(	"./index.php?m=CompteZeybu&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_353_CODE;
						erreur.message = ERR_353_MSG;
						lVr.log.erreurs.push(erreur);						
						$(pDialog).dialog("close");	
						that.construct({vr:lVr,selectedTabs:that.mSelectedTabs});									
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};	
	this.construct(pParam);
}	