;function SuiviPaiementAssociationVue(pParam) {
	this.mListeOperation = [];
	this.mSelectedTabs = 0;
	this.mBanques = [];
	this.mBanquesTriId = [];
	this.mTypePaiement = [];
	this.mTable = {};
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {SuiviPaiementAssociationVue(pParam);}} );
		var that = this;	
		var lParam = {fonction:"afficher"};
		if(pParam && pParam.selectedTabs) {
			this.mSelectedTabs = pParam.selectedTabs;
		}
		$.post(	"./index.php?m=CompteAssociation&v=SuiviPaiement", "pParam=" + $.toJSON(lParam),
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
		var lCompteAssociationTemplate = new CompteAssociationTemplate();	
		
		var lTotalEspece = 0;
		$.each(lResponse.listeEspece,function() {
			if(this.opeId) {
				lTotalEspece = (parseFloat(lTotalEspece) + parseFloat(this.opeMontant)).toFixed(2);
				that.mListeOperation[this.opeId] = this;
			}
		});
		
		var lTotalCheque = 0;
		$.each(lResponse.listeCheque,function() {
			if(this.opeId) {
				lTotalCheque = (parseFloat(lTotalCheque) + parseFloat(this.opeMontant)).toFixed(2);
				this.numeroCheque ='';
				if(this.opeTypePaiementChampComplementaire[3]) {
					this.numeroCheque = this.opeTypePaiementChampComplementaire[3].valeur; 
				}
				this.btnValider = '';
				if(parseFloat(this.opeMontant) < 0) {
					this.btnValider = lCompteAssociationTemplate.btnValider.template({opeId:this.opeId});
				}
				that.mListeOperation[this.opeId] = this;
			}
		});
		
		if(lResponse.listeEspece.length == 0 || (lResponse.listeEspece[0] && lResponse.listeEspece[0].adhId == null)) {
			lResponse.listeEspece = [];
		}
		if(lResponse.listeCheque.length == 0 || (lResponse.listeCheque[0] && lResponse.listeCheque[0].adhId == null)) {
			lResponse.listeCheque = [];
		}

		lResponse.sigleMonetaire = gSigleMonetaire;
		lResponse.totalEspece = lTotalEspece.nombreFormate(2,',',' ');
		lResponse.totalCheque = lTotalCheque.nombreFormate(2,',',' ');
					
		$('#contenu').replaceWith(that.affect($(lCompteAssociationTemplate.listePaiement.template(lResponse))));
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTabs(pData);
		pData = this.affectValiderPaiement(pData);
		pData = this.affectModifierPaiement(pData);
		pData = this.affectSupprimerPaiement(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectDataTable(pData);
		pData = this.affectRemiseCheque(pData);
		return pData;
	};
	
	this.affectTabs = function(pData) {
		var that = this;
		pData.find( "#listePaiement" ).tabs({active:that.mSelectedTabs});
		pData.find("#li-cheque,#li-espece").click(
				function() {that.mSelectedTabs = $("#listePaiement").tabs("option","active");});
		return pData;
	};
	
	this.affectRemiseCheque = function(pData) {
		var that = this;
		
		// Création Remise de chèque
		pData.find("#btn-nv-remise-cheque").click(function() {
			// Affiche les boutons
			$(".div-btn-remise-cheque").toggle();
			// Affiche le form et RAZ
			$(".checkbox-remise-cheque",that.mTable.fnGetNodes()).show().prop( "checked",false );
		});
				
		// Annuler la création
		pData.find("#btn-annul-remise-cheque").click(function() {
			// Masque les boutons
			$(".div-btn-remise-cheque").toggle();
			// Remise à 0 du total
			$("#total-remise-cheque").text(0);
			// Masque le form et RAZ
			$(".checkbox-remise-cheque",that.mTable.fnGetNodes()).hide().prop( "checked",false );
		});
		
		// MAj Total
		$(".checkbox-remise-cheque",this.mTable.fnGetNodes()).click(function() {that.majTotalRemise();});
		
		// Bouton de création de remise de cheque
		pData.find("#btn-ajout-remise-cheque").click(function() {
			that.dialogCreerRemise();
		});
		
		// Bouton de création de remise de cheque, Ajout Operation
		pData.find("#btn-ajout-operation-remise-cheque").click(function() {
			that.dialogAjoutOperation();
		});
			
		return pData;
	};
	
	this.dialogAjoutOperation = function() {
		var that = this;
		// Récupération de la liste des remises actives
		$.post(	"./index.php?m=CompteAssociation&v=RemiseCheque", "pParam=" + $.toJSON({fonction:"listeActive"}),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(lResponse.liste[0].id == null) { // Pas de remise en cours
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_368_CODE;
							erreur.message = ERR_368_MSG;
							lVr.log.erreurs.push(erreur);	
							Infobulle.generer(lVr,'');		
						} else {
							lResponse.sigleMonetaire = gSigleMonetaire;
							lResponse.montant = $("#total-remise-cheque").text();
							$(lResponse.liste).each(function() {
								this.date = this.dateCreation.extractDbDate().dateDbToFr();
							});
													
							var lCompteAssociationTemplate = new CompteAssociationTemplate();
							$(lCompteAssociationTemplate.dialogAjoutOperationRemiseCheque.template(lResponse)).dialog({
								autoOpen: true,
								modal: true,
								draggable: false,
								resizable: false,
								width:800,
								buttons: {
									'Valider': function() {
										that.ajoutOperation($("#select-remise-cheque").val());
									},
									'Annuler': function() {
										Infobulle.init(); // Supprime les erreurs
										$(this).dialog('close');
									}
								},
								close: function(ev, ui) { $(this).remove(); }
							});
						}
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.ajoutOperation = function(pIdRemiseCheque) {
		var that = this;
		var lVo = new RemiseChequeDetailVO();

		lVo.id = pIdRemiseCheque;
		
		// Récupération des opérations dans les deux tableaux
		$(".checkbox-remise-cheque:checked",this.mTable.fnGetNodes()).each(function() {
			var lOperation = new OperationDetailVO();
			lOperation.id = $(this).val();
			lVo.operations.push(lOperation);
		});
		
		// Contrôle des données
		var lValid = new RemiseChequeValid();
		var lVr = lValid.validAjoutOperation(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			// Enregistrement de la remise de cheque
			lVo.fonction = 'ajoutOperation';
			$.post(	"./index.php?m=CompteAssociation&v=RemiseCheque", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_301_CODE;
							erreur.message = ERR_301_MSG;
							lVr.log.erreurs.push(erreur);						
							$("#dialog-creer-remise-cheque").dialog("close");	
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
	
	this.dialogCreerRemise = function() {
		var that = this;
		var lData = {sigleMonetaire:gSigleMonetaire, montant:$("#total-remise-cheque").text()};
		
		var lCompteAssociationTemplate = new CompteAssociationTemplate();
		$(lCompteAssociationTemplate.dialogCreerRemiseCheque.template(lData)).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Valider': function() {
					that.creerRemise();
				},
				'Annuler': function() {
					Infobulle.init(); // Supprime les erreurs
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.creerRemise = function() {
		var that = this;
		var lVo = new RemiseChequeDetailVO();

		// Récupération des opérations
		$(".checkbox-remise-cheque:checked",this.mTable.fnGetNodes()).each(function() {
			var lOperation = new OperationDetailVO();
			lOperation.id = $(this).val();
			lVo.operations.push(lOperation);
		});
		
		// Contrôle des données
		var lValid = new RemiseChequeValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			// Enregistrement de la remise de cheque
			lVo.fonction = 'ajout';
			$.post(	"./index.php?m=CompteAssociation&v=RemiseCheque", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_301_CODE;
							erreur.message = ERR_301_MSG;
							lVr.log.erreurs.push(erreur);						
							$("#dialog-creer-remise-cheque").dialog("close");	
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
	
	this.majTotalRemise = function() {
		var lTotal = 0;
		// Ajoute le montant des checkbox sélectionnées au total
		$(".checkbox-remise-cheque:checked",this.mTable.fnGetNodes()).each(function() {
			lTotal = ( parseFloat(lTotal) + parseFloat($(this).data('montant')) ).toFixed(2);
		});
		// Maj du total
		$("#total-remise-cheque").text(lTotal.nombreFormate(2,',',' '));
	};
	
	this.affectDataTable = function(pData) {
		var lCompteAssociationTemplate = new CompteAssociationTemplate();
		this.mTable = pData.find('#table-cheque').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 25,
	        "aaSorting": [[2,'asc']],
	        "aoColumnDefs": [
	              { "bVisible" : false,
	            	"bSortable": false, 
	                "bSearchable":false,
	                "aTargets": [ 0,12 ] 
	              },
	              { "mRender": function ( data, type, full ) {
	       	        	if(data == 'null') {
	       	        		if(parseFloat(full[12]) > 0) {
		         	        	return lCompteAssociationTemplate.checkboxRemiseCheque.template({id:full[0],montant:full[12]});
	       	        		} else {
	       	        			return '';
	       	        		}
	       				} else {
	       					return data;
	       				}
	     	      	},
	     	      	"aTargets": [ 1 ]
	              },
	             {"sType": "date",
                  "mRender": function ( data, type, full ) {
                	  return data.extractDbDate().dateDbToFr();
                  	},
                  "aTargets": [ 2 ]
                 },
                 {"sType": "numeric",
   	              "mRender": function ( data, type, full ) {
   	            	  if(data != 'null') {
   	            		  if (type === 'sort') {
   	            			  return data.replace("Z","");
   	            		  }
   	            		  return data;
   	            	  } else {
   	            		  return '';
   	            	  }
   	               },
   	               "aTargets": [ 3 ]
   		         },
                 {"sType": "numeric",
	              "mRender": function ( data, type, full ) {
	            	  if(data != 'null') {
	            		  if (type === 'sort') {
	            			  return data.replace("C","");
	            		  }
	            		  return data;
	            	  } else {
	            		  return '';
	            	  }
	               },
	               "aTargets": [ 4 ]
		          },
		          {	 "sType": "string",
	                  	 "mRender": function ( data, type, full ) {
	                  		if(data != 'null') {
		             	        return data;
	                  		} else {
	                  			return '';
	                  		}
	             	      },
	             	      "aTargets": [ 5, 6 ]
		          },
                  {"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
                	"aTargets": [ 7 ] 
                  },
                   {"bSortable": false,
                  	"bSearchable":false,
                  	"aTargets": [ 9,10,11 ] 
                    }]
	    });
		
		pData.find('#table-espece').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 25,
	        "aaSorting": [[0,'asc']],
	        "aoColumnDefs": [
	             {"sType": "date",
                  "mRender": function ( data, type, full ) {
                	  return data.extractDbDate().dateDbToFr();
                  	},
                  "aTargets": [ 0 ]
                 },
                 {"sType": "numeric",
   	              "mRender": function ( data, type, full ) {
   	            	  if(data != 'null') {
   	            		  if (type === 'sort') {
   	            			  return data.replace("Z","");
   	            		  }
   	            		  return data;
   	            	  } else {
   	            		  return '';
   	            	  }
   	               },
   	               "aTargets": [ 1 ]
   		         },
                 {"sType": "numeric",
	              "mRender": function ( data, type, full ) {
	            	  if(data != 'null') {
	            		  if (type === 'sort') {
	            			  return data.replace("C","");
	            		  }
	            		  return data;
	            	  } else {
	            		  return '';
	            	  }
	               },
	               "aTargets": [ 2 ]
		          },
		          {	 "sType": "string",
	                  	 "mRender": function ( data, type, full ) {
	                  		if(data != 'null') {
		             	        return data;
	                  		} else {
	                  			return '';
	                  		}
	             	      },
	             	      "aTargets": [ 3, 4 ]
		          },
                  {"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
                	"aTargets": [ 5 ] 
                  },
                  { "bSortable": false,
                  	"aTargets": [ 6,7,8 ] 
                    }]
	    });
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
		lOperation.opeMontant = lOperation.opeMontant.nombreFormate(2,',',' ');
		
		if(lOperation.cptLabel == null) {
			lOperation.cptLabel = 'Inconnu';
		}
		
		var lCompteAssociationTemplate = new CompteAssociationTemplate();
		$(lCompteAssociationTemplate.dialogValiderPaiement.template(lOperation)).dialog({
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
		$.post(	"./index.php?m=CompteAssociation&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
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
		lOperation.opeMontant = lOperation.opeMontant.nombreFormate(2,',','');
		if(lOperation.cptLabel == null) {
			lOperation.cptLabel = 'Inconnu';
		}
		
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

		var lCompteAssociationTemplate = new CompteAssociationTemplate();
		var lDialog = $(that.affectDialog($(lCompteAssociationTemplate.dialogModifierPaiement.template(lOperation)))).dialog({
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

		var lVo = new OperationDetailVO();
		
		lVo.id = pIdOperation;
		lVo.fonction="modifier";
		lVo.montant=$(pDialog).find("#montant").val().numberFrToDb();
		lVo.typePaiement = pType;
		
		if(this.mTypePaiement[lVo.typePaiement]) {
			var lTypePaiementService = new TypePaiementService();
			lVo.champComplementaire = lTypePaiementService.getChampComplementaire(this.mTypePaiement[lVo.typePaiement].champComplementaire);
		}
		
		var lValid = new OperationDetailValid();
		var lVr = lValid.validUpdateMontant(lVo,{reel:true});
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			$.post(	"./index.php?m=CompteAssociation&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
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
		pData = gCommunVue.comNumeric(pData,{allowNegatives:true});
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
		lOperation.opeMontant = lOperation.opeMontant.nombreFormate(2,',',' ');
		
		if(lOperation.cptLabel == null) {
			lOperation.cptLabel = 'Inconnu';
		}

		var lCompteAssociationTemplate = new CompteAssociationTemplate();
		$(lCompteAssociationTemplate.dialogSupprimerPaiement.template(lOperation)).dialog({
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
		$.post(	"./index.php?m=CompteAssociation&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
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