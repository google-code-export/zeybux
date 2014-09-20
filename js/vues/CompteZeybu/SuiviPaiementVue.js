;function SuiviPaiementVue(pParam) {
	this.mListeOperation = [];
	this.mSelectedTabs = 0;
	this.mBanques = [];
	this.mBanquesTriId = [];
	this.mTypePaiement = [];
	this.mTableInvite = {};
	this.mTableAdherent = {};
	
	
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
		
		var lTestNbLigne = false;
		$.each(lResponse.listeEspeceAdherent,function() {
			if(this.opeId) {
				if(this.opeId!= null) {
					lTestNbLigne = true;
				}				
				lTotalEspeceAdherent += parseFloat(this.opeMontant);
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				/*this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.opeMontant = this.opeMontant.nombreFormate(2,',','');
				this.adhIdTri = this.adhNumero.replace("Z","");
				this.cptIdTri = this.cptLabel.replace("C","");*/
				that.mListeOperation[this.opeId] = this;
			}
		});
		if(!lTestNbLigne) {
			lResponse.listeEspeceAdherent = [];
		}
		
		var lTestNbLigne = false;
		$.each(lResponse.listeEspeceInvite,function() {
			if(this.opeId) {
				if(this.opeId!= null) {
					lTestNbLigne = true;
				}
				lTotalEspeceAdherent += parseFloat(this.opeMontant);	
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				//this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				//this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				//this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				//this.opeMontant = this.opeMontant.nombreFormate(2,',','');		
				that.mListeOperation[this.opeId] = this;
			}
		});
		if(!lTestNbLigne) {
			lResponse.listeEspeceInvite = [];
		}
		
		var lTotalChequeAdherent = 0;

		var lTestNbLigne = false;
		$.each(lResponse.listeChequeAdherent,function() {
			if(this.opeId) {
				if(this.opeId!= null) {
					lTestNbLigne = true;
				}
				lTotalChequeAdherent += parseFloat(this.opeMontant);
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				/*this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.adhIdTri = this.adhNumero.replace("Z","");
				this.cptIdTri = this.cptLabel.replace("C","");*/
				this.numeroCheque ='';
				if(this.opeTypePaiementChampComplementaire[3]) {
					this.numeroCheque = this.opeTypePaiementChampComplementaire[3].valeur; 
				}		
				that.mListeOperation[this.opeId] = this;
			}
		});
		if(!lTestNbLigne) {
			lResponse.listeChequeAdherent = [];
		}

		var lTestNbLigne = false;
		$.each(lResponse.listeChequeInvite,function() {
			if(this.opeId) {
				if(this.opeId!= null) {
					lTestNbLigne = true;
				}
				lTotalChequeAdherent += parseFloat(this.opeMontant);
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				/*this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();*/
				this.numeroCheque ='';
				if(this.opeTypePaiementChampComplementaire[3]) {
					this.numeroCheque = this.opeTypePaiementChampComplementaire[3].valeur; 
				}		
				that.mListeOperation[this.opeId] = this;
			}
		});
		if(!lTestNbLigne) {
			lResponse.listeChequeInvite = [];
		}
		
		var lTotalEspeceFerme = 0;
		var lTestNbLigne = false;
		$.each(lResponse.listeEspeceFerme,function() {
			if(this.opeId) {
				if(this.opeId!= null) {
					lTestNbLigne = true;
				}
				lTotalEspeceFerme += parseFloat(this.opeMontant);	
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				/*this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontant = this.opeMontant.nombreFormate(2,',','');
				this.ferIdTri = this.ferNumero.replace("F","");
				this.cptIdTri = this.cptLabel.replace("C","");	*/
				that.mListeOperation[this.opeId] = this;
			}
		});
		if(!lTestNbLigne) {
			lResponse.listeEspeceFerme = [];
		}
		var lTotalChequeFerme = 0;
		
		var lTestNbLigne = false;
		$.each(lResponse.listeChequeFerme,function() {
			if(this.opeId) {
				if(this.opeId!= null) {
					lTestNbLigne = true;
				}
				lTotalChequeFerme += parseFloat(this.opeMontant);	
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				/*this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontant = this.opeMontant.nombreFormate(2,',','');
				this.ferIdTri = this.ferNumero.replace("F","");
				this.cptIdTri = this.cptLabel.replace("C","");*/
				this.numeroCheque ='';
				if(this.opeTypePaiementChampComplementaire[3]) {
					this.numeroCheque = this.opeTypePaiementChampComplementaire[3].valeur; 
				}	
				that.mListeOperation[this.opeId] = this;
			}
		});
		if(!lTestNbLigne) {
			lResponse.listeChequeFerme = [];
		}

		lResponse.sigleMonetaire = gSigleMonetaire;
		lResponse.totalEspeceAdherent = lTotalEspeceAdherent.nombreFormate(2,',',' ');
		lResponse.totalChequeAdherent = lTotalChequeAdherent.nombreFormate(2,',',' ');
		lResponse.totalEspeceFerme = lTotalEspeceFerme.nombreFormate(2,',',' ');
		lResponse.totalChequeFerme = lTotalChequeFerme.nombreFormate(2,',',' ');
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		lResponse.chequeInvite = lCompteZeybuTemplate.listeChequeInvite.template(lResponse);
		lResponse.especeInvite = lCompteZeybuTemplate.listeEspeceInvite.template(lResponse);
		
		var lHtml = $(lCompteZeybuTemplate.listePaiement.template(lResponse));
				
		$('#contenu').replaceWith(that.affect(lHtml));
		
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
	
	this.affectRemiseCheque = function(pData) {
		var that = this;
		
		// Création Remise de chèque
		pData.find("#btn-nv-remise-cheque").click(function() {
			// Affiche les boutons
			$(".div-btn-remise-cheque").toggle();
			// Affiche le form et RAZ
			$(".checkbox-remise-cheque",that.mTableInvite.fnGetNodes()).show().prop( "checked",false );
			$(".checkbox-remise-cheque",that.mTableAdherent.fnGetNodes()).show().prop( "checked",false );
		});
				
		// Annuler la création
		pData.find("#btn-annul-remise-cheque").click(function() {
			// Masque les boutons
			$(".div-btn-remise-cheque").toggle();
			// Remise à 0 du total
			$("#total-remise-cheque").text(0);
			// Masque le form et RAZ
			$(".checkbox-remise-cheque",that.mTableInvite.fnGetNodes()).hide().prop( "checked",false );
			$(".checkbox-remise-cheque",that.mTableAdherent.fnGetNodes()).hide().prop( "checked",false );
		});
		
		// MAj Total
		$(".checkbox-remise-cheque",this.mTableInvite.fnGetNodes()).click(function() {that.majTotalRemise();});
		$(".checkbox-remise-cheque",this.mTableAdherent.fnGetNodes()).click(function() {that.majTotalRemise();});
		
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
		$.post(	"./index.php?m=CompteZeybu&v=RemiseCheque", "pParam=" + $.toJSON({fonction:"listeActive"}),
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
													
							var lCompteZeybuTemplate = new CompteZeybuTemplate();
							$(lCompteZeybuTemplate.dialogAjoutOperationRemiseCheque.template(lResponse)).dialog({
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
		$(".checkbox-remise-cheque:checked",this.mTableInvite.fnGetNodes()).each(function() {
			var lOperation = new OperationDetailVO();
			lOperation.id = $(this).val();
			lVo.operations.push(lOperation);
		});
		$(".checkbox-remise-cheque:checked",this.mTableAdherent.fnGetNodes()).each(function() {
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
			$.post(	"./index.php?m=CompteZeybu&v=RemiseCheque", "pParam=" + $.toJSON(lVo),
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
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$(lCompteZeybuTemplate.dialogCreerRemiseCheque.template(lData)).dialog({
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

		// Récupération des opérations dans les deux tableaux
		$(".checkbox-remise-cheque:checked",this.mTableInvite.fnGetNodes()).each(function() {
			var lOperation = new OperationDetailVO();
			lOperation.id = $(this).val();
			lVo.operations.push(lOperation);
		});
		$(".checkbox-remise-cheque:checked",this.mTableAdherent.fnGetNodes()).each(function() {
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
			$.post(	"./index.php?m=CompteZeybu&v=RemiseCheque", "pParam=" + $.toJSON(lVo),
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
		$(".checkbox-remise-cheque:checked",this.mTableInvite.fnGetNodes()).each(function() {
			lTotal = ( parseFloat(lTotal) + parseFloat($(this).data('montant')) ).toFixed(2);
		});
		$(".checkbox-remise-cheque:checked",this.mTableAdherent.fnGetNodes()).each(function() {
			lTotal = ( parseFloat(lTotal) + parseFloat($(this).data('montant')) ).toFixed(2);
		});
		// Maj du total
		$("#total-remise-cheque").text(lTotal.nombreFormate(2,',',' '));
	};
	
	this.affectDataTable = function(pData) {
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		
		this.mTableInvite = pData.find('#table-cheque-invite').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 10,
	        "aaSorting": [[2,'asc']],
	        "aoColumnDefs": [
   	              { "bVisible" : false,
  	            	"bSortable": false, 
  	                "bSearchable":false,
  	                "aTargets": [ 0,7 ] 
  	              },
                  { "bSortable": false, 
                	"bSearchable":false,
                	"aTargets": [ 5,6 ] 
                  },
                  { "mRender": function ( data, type, full ) {
       	        	if(data == 'null') {
           	        	return lCompteZeybuTemplate.checkboxRemiseCheque.template({id:full[0],montant:full[7]});
	       				} else {
	       					return data;
	       				}
       	      		},
       	      		"aTargets": [ 1 ]
                  },
                  {"sType": "date",
                      "mRender": function ( data, type, full ) {
	                    	if (type === 'sort') {
	                    		return data.replace(' ','T');
	                    	}
	                    	return data.extractDbDate().dateDbToFr();
                      	},
                      "aTargets": [ 2 ]
                  },
                  {"sType": "numeric",
  	                "mRender": function ( data, type, full ) {
           	        	if(type !== 'sort' && data.length > 0) {
           	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
           	        	}
           	        	return data;
  	             	},
	                "sClass":"com-text-align-right",
                  	"aTargets": [ 3 ] 
                    },
                    {"sType": "numeric",
                     "aTargets": [ 4 ] 
                     }]
	    });
		
		this.mTableAdherent = pData.find('#table-cheque-adherent').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 10,
	        "aaSorting": [[2,'asc']],
	        "aoColumnDefs": [
	              { "bVisible" : false,
	            	"bSortable": false, 
	                "bSearchable":false,
	                "aTargets": [ 0,11 ] 
	              },
                  { "mRender": function ( data, type, full ) {
         	        	if(data == 'null') {
             	        	return lCompteZeybuTemplate.checkboxRemiseCheque.template({id:full[0],montant:full[11]});
	       				} else {
	       					return data;
	       				}
         	      	},
         	      	"aTargets": [ 1 ]
                  },
                  {"sType": "date",
                     "mRender": function ( data, type, full ) {
                    	if (type === 'sort') {
                    		return data.replace(' ','T');
                    	}
                    	return data.extractDbDate().dateDbToFr();
                      },
                      "aTargets": [ 2 ]
                  },
                  {	 "sType": "numeric",
                	 "mRender": function ( data, type, full ) {
                		  	if (type === 'sort') {
                	          return data.replace("Z","");
                	        }
                	        return data;
                	      },
                	"aTargets": [ 3 ]
                  },
                  {	 "sType": "numeric",
                    	 "mRender": function ( data, type, full ) {
                    		  	if (type === 'sort') {
                    	          return data.replace("C","");
                    	        }
                    	        return data;
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
	                "sClass":"com-text-align-right",
                	"aTargets": [ 7 ] 
                  },
                  {"sType": "numeric",
	               "aTargets": [ 8 ] 
	              },
	              { "bSortable": false, 
                	"bSearchable":false,
                	"aTargets": [ 9,10 ] 
                  }]
	    });
		
		pData.find('#table-espece-invite').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 10,
	        "aaSorting": [[0,'asc']],
	        "aoColumnDefs": [
                  { "bSortable": false, 
                	"bSearchable":false,
                	"aTargets": [ 2,3,4 ] 
                  },
                  {   "sType": "date",
                	  "mRender": function ( data, type, full ) {
	                    	if (type === 'sort') {
	                    		return data.replace(' ','T');
	                    	}
                    	  return data.extractDbDate().dateDbToFr();
                      },
                	  "aTargets": [ 0 ] 
                  },
                  {"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
	                "sClass":"com-text-align-right",
                	"aTargets": [ 1 ] 
                  }]
	    });
		
		pData.find('#table-espece-adherent').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 10,
	        "aaSorting": [[0,'asc']],
	        "aoColumnDefs": [
                   {"sType": "date",
                  "mRender": function ( data, type, full ) {
                  	if (type === 'sort') {
                		return data.replace(' ','T');
                	}
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
	                "sClass":"com-text-align-right",
                	"aTargets": [ 5 ] 
                  },
                  { "bSortable": false,
                  	"aTargets": [ 6,7,8 ] 
                    }]
	    });
		
		pData.find('#table-cheque-ferme').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 10,
	        "aaSorting": [[0,'asc']],
	        "aoColumnDefs": [
                  { "bSortable": false, 
                	"bSearchable":false,
                	"aTargets": [ 6,7 ] 
                  },
                  {"sType": "date",
                      "mRender": function ( data, type, full ) {
                    	if (type === 'sort') {
                    		return data.replace(' ','T');
                    	}
                    	  return data.extractDbDate().dateDbToFr();
                      	},
                      "aTargets": [ 0 ]
                  },
                  {"sType": "numeric",
	              "mRender": function ( data, type, full ) {
	            	  if(data != 'null') {
	            		  if (type === 'sort') {
	            			  return data.replace("F","");
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
	            			  data = data.replace("CF",""); // Incohérence de données datant de la création du zeybux
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
             	      "aTargets": [ 3 ]
		          },
                  {"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
	                "sClass":"com-text-align-right",
                	"aTargets": [ 4 ] 
                  },
                  {"sType": "numeric",
   	               "aTargets": [ 5 ] 
   	              },]
	    });
		
		pData.find('#table-espece-ferme').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 10,
	        "aaSorting": [[0,'asc']],
	        "aoColumnDefs": [
                  { "bSortable": false, 
                	"bSearchable":false,
                	"aTargets": [ 5,6 ] 
                  },
                  {"sType": "date",
                      "mRender": function ( data, type, full ) {
                    	if (type === 'sort') {
                    		return data.replace(' ','T');
                    	}
                    	  return data.extractDbDate().dateDbToFr();
                      	},
                      "aTargets": [ 0 ]
                  },
                  {"sType": "numeric",
	              "mRender": function ( data, type, full ) {
	            	  if(data != 'null') {
	            		  if (type === 'sort') {
	            			  return data.replace("F","");
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
	            			  data = data.replace("CF",""); // Incohérence de données datant de la création du zeybux
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
             	      "aTargets": [ 3 ]
		          },
                  {"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
	                "sClass":"com-text-align-right",
                	"aTargets": [ 4 ] 
                  }]
	    });
		return pData;		
	};
	
	this.affectTabs = function(pData) {
		var that = this;
		pData.find( "#listePaiement" ).tabs({active:that.mSelectedTabs});
		pData.find("#li-cheque-adherent,#li-espece-adherent,#li-cheque-ferme,#li-espece-ferme").click(
				function() {that.mSelectedTabs = $("#listePaiement").tabs("option","active");});
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
		lOperation.opeMontant = lOperation.opeMontant.nombreFormate(2,',','');
				
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
		var lVr = lValid.validUpdateMontant(lVo);
		
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