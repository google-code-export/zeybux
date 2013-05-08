;function CompteSolidaireVue(pParam) {
	this.solde = 0;
	this.modifVirement = [];
	
	this.construct = function(pParam) {
		var that = this;
		var lParam = {fonction:"compte"};
		$.history( {'vue':function() {CompteSolidaireVue(pParam);}} );
		$.post(	"./index.php?m=CompteSolidaire&v=CompteSolidaire", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}

							gCommunVue.majMenu('CompteSolidaire','CompteSolidaire');
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

		if(lResponse.operation.length > 0 && lResponse.operation[0].opeId != null) {
			var lTemplate = lCompteSolidaireTemplate.compte;
			var lHtml = $(lTemplate.template(lResponse));
	
			// Ne pas afficher la pagination si il y a moins de 30 éléments
			if(lResponse.operation.length < 21) {
				lHtml = this.masquerPagination(lHtml);
			} else {
				lHtml = this.paginnation(lHtml);
			}
			$('#contenu').replaceWith(that.affect(lHtml));
		} else {
			var lTemplate = lCompteSolidaireTemplate.listeVirementVide;
			$('#contenu').replaceWith(lTemplate.template(lResponse));
		}
	};
	
	this.affect = function(pData) {
		pData = this.ajoutModification(pData);
		pData = this.affectModification(pData);
		pData = this.affectSuppression(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
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
	};
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	};
	
	this.ajoutModification = function(pData) {
		var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
		$(this.modifVirement).each(function() {
			pData.find("#td-edt-" + this).html(lCompteSolidaireTemplate.btnEdt);
			pData.find("#td-sup-" + this).html(lCompteSolidaireTemplate.btnSup);
		});		
		return pData;
	};
	
	this.affectModification = function(pData) {
		var that = this;
		pData.find(".btn-edt-modifier").click(function() {
			var lId = $(this).parents("tr").find(".id-operation").text();
			
			var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
			var lTemplate = lCompteSolidaireTemplate.dialogModifVirement;
			
			var lData = {};
			lData.label = $(this).parents("tr").find(".cpt-label").text();
			lData.montant = $(this).parents("tr").find(".montant").text().numberFrToDb().nombreFormate(2,',','');
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
	};
	
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
			//var lDialog = this;
			$.post(	"./index.php?m=CompteSolidaire&v=CompteSolidaire", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
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
					}
				},"json"
			);
		}else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.affectDialog = function(pData) {
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
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
	};
	
	this.supprimerVirement = function(pDialog,pId) {
		var that = this;
		var lVo = new CompteSolidaireSupprimerVirementVO();								
		lVo.id = pId;
		
		var lValid = new CompteSolidaireVirementValid();
		var lVr = lValid.validDelete(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "supprimerVirement";
			//var lDialog = this;
			$.post(	"./index.php?m=CompteSolidaire&v=CompteSolidaire", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
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
					}
				},"json"
			);
		}else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.construct(pParam);
}