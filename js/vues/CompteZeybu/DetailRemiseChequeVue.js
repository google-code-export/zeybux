;function DetailRemiseChequeVue(pParam) {
	this.mEtat = null;
	this.mIdRemise = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {DetailRemiseChequeVue(pParam);}} );
		var that = this;		
		pParam.fonction = 'detailRemise';
		$.post(	"./index.php?m=CompteZeybu&v=RemiseCheque", "pParam=" + $.toJSON(pParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mIdRemise = pParam.id;
						that.afficher(lResponse);						
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.afficher = function(pResponse) {
		var that = this;
		this.mEtat = pResponse.remiseCheque.etat;
		pResponse.remiseCheque.sigleMonetaire = gSigleMonetaire;
		pResponse.remiseCheque.date = pResponse.remiseCheque.dateCreation.extractDbDate().dateDbToFr();
		pResponse.remiseCheque.montant = pResponse.remiseCheque.montant.nombreFormate(2,',',' ');
		if(pResponse.remiseCheque.operations[0].idOperation == null) { pResponse.remiseCheque.operations = [];}
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$('#contenu').replaceWith(that.affect($(lCompteZeybuTemplate.detailRemiseCheque.template(pResponse.remiseCheque))));
	};
	
	this.affect = function(pData) {
		pData = this.affectRetour(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectBtnModification (pData);
		pData = this.affectExport(pData);
		pData = this.affectSupprimerOperation(pData);
		pData = this.affectValider(pData);
		pData = this.affectSupprimer(pData);
		pData = this.affectDataTable(pData);
		return pData;
	};
	
	this.affectExport = function(pData) {
		pData.find('#btn-export').click(function() {
			$.download("./index.php?m=CompteZeybu&v=RemiseCheque", {fonction:'export',id:$(this).data('id')});
		});
		return pData;
	};
	
	this.affectRetour = function(pData) {
		var that = this;
		pData.find("#lien-retour").click(function() {
			ListeRemiseChequeVue({etat:that.mEtat});
		});
		return pData;
	};
	
	this.affectBtnModification = function(pData) {
		// Suppression des boutons de modification
		if(this.mEtat != 0) {
			pData.find("#btn-export, #btn-edt-supprimer, #btn-valider-remise-cheque, .btn-sup-operation").remove();
		}
		return pData;
	};
	
	this.affectDataTable = function(pData) {		
		var lOptionTable = [
		                    {"sType": "date",
		    	                "mRender": function ( data, type, full ) {
		                        	if (type === 'sort') {
		                        		return data.replace(' ','T');
		                        	}
		    	                	return data.extractDbDate().dateDbToFr();
		    	                },
		    	                "aTargets": [ 0 ]
		    	              },
		                      {	 "sType": "numeric",
		                    	 "mRender": function ( data, type, full ) {
		                    		 if(data == 'null') {
		                    			 return '';
		                    		 } else {
		                    		  	if (type === 'sort') {
		                    	          return data.replace("Z","");
		                    	        }
		                    	        return data;
		                    	 	}
		                    	  },
		                    	"aTargets": [ 1 ]
		                      },
		                      {	 "sType": "numeric",
		                        	 "mRender": function ( data, type, full ) {
	                        		  	if (type === 'sort') {
	                        	          return data.replace("C","");
	                        	        }
	                        	        return data;
	                        	      },
		                        "aTargets": [ 2 ]
		                      },
		                      {	"mRender": function ( data, type, full ) {
			                    		 if(data == 'null') {
			                    			 return '';
			                    		 } else {
			                    	        return data;
			                    	 	}
			                    	  },
			                    	"aTargets": [ 3,4 ]
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
		                      }];

		if(this.mEtat == 0) {
			lOptionTable.push({ "bSortable": false, 
				              	"bSearchable":false,
				              	"aTargets": [ 7 ] 
				               });
		} else {
			lOptionTable.push({ "bVisible" : false, 
								"bSortable": false, 
				              	"bSearchable":false,
				              	"aTargets": [ 7 ] 
				               });
		}
		
		pData.find('#table-liste-operation').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 10,
	        "aaSorting": [[0,'asc']],
	        "aoColumnDefs": lOptionTable
	    });	
		return pData;
	};
	
	this.affectSupprimerOperation = function(pData) {
		var that = this;
		pData.find('.btn-sup-operation').click(function() {
			that.dialogSupprimerOperationRemiseCheque($(this).data('id'));
		});		
		return pData;
	};
	
	this.dialogSupprimerOperationRemiseCheque = function(pId) {
		var that = this;
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$(lCompteZeybuTemplate.dialogSupprimerOperationRemiseCheque).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Valider': function() {
					var lDialog = $(this);
					var lVo = new OperationRemiseChequeVO();
					lVo.idOperation = pId;
					lVo.idRemiseCheque = that.mIdRemise;
					
					// Contrôle des données
					var lValid = new OperationRemiseChequeValid();
					var lVr = lValid.validDelete(lVo);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Enregistrement
						lVo.fonction = 'supprimerOperation';
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
										lDialog.dialog("close");	
										that.construct({vr:lVr,id:that.mIdRemise});									
									} else {
										Infobulle.generer(lResponse,'');
									}
								}
							},"json"
						);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.affectValider = function(pData) {
		var that = this;
		pData.find('#btn-valider-remise-cheque').click(function() {
			that.dialogValiderRemiseCheque($(this).data('id'));
		});		
		return pData;
	};
	
	this.dialogValiderRemiseCheque = function(pId) {
		var that = this;
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$(lCompteZeybuTemplate.dialogValiderRemiseCheque).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Valider': function() {
					var lDialog = $(this);
					var lVo = new RemiseChequeDetailVO();
					lVo.id = pId;
					
					// Contrôle des données
					var lValid = new RemiseChequeValid();
					var lVr = lValid.validDelete(lVo);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Enregistrement
						lVo.fonction = 'encaisser';
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
										lDialog.dialog("close");	
										that.construct({vr:lVr,id:that.mIdRemise});									
									} else {
										Infobulle.generer(lResponse,'');
									}
								}
							},"json"
						);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.affectSupprimer = function(pData) {
		var that = this;
		pData.find('#btn-edt-supprimer').click(function() {
			that.dialogSupprimerRemiseCheque($(this).data('id'));
		});		
		return pData;
	};
	
	this.dialogSupprimerRemiseCheque = function(pId) {
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$(lCompteZeybuTemplate.dialogSupprimerRemiseCheque).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Valider': function() {
					var lDialog = $(this);
					var lVo = new RemiseChequeDetailVO();
					lVo.id = pId;
					
					// Contrôle des données
					var lValid = new RemiseChequeValid();
					var lVr = lValid.validDelete(lVo);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Enregistrement
						lVo.fonction = 'supprimer';
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
										lDialog.dialog("close");	
										ListeRemiseChequeVue({vr:lVr});									
									} else {
										Infobulle.generer(lResponse,'');
									}
								}
							},"json"
						);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.construct(pParam);
};