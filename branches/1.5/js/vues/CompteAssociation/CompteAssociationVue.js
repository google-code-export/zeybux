;function CompteAssociationVue(pParam) {
	this.mBanques = [];
	this.mTypePaiement = [];	
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CompteAssociationVue(pParam);}} );
		var that = this;
		pParam = $.extend(true,{},pParam);
		
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=CompteAssociation&v=Compte", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							
							var lVo = new RechercheListeOperationVO();
							if(pParam && pParam.vr) {
								lVo.vr = pParam.vr;
							}
							
							lVo.dateDebut = getPremierJourDuMois();
							lResponse.dateDebut = lVo.dateDebut.dateDbToFr();
							lVo.dateFin = getDernierJourDuMois();
							lResponse.dateFin = lVo.dateFin.dateDbToFr();
							

							if(lResponse.soldeTotal != null) {
								lResponse.soldeTotal = lResponse.soldeTotal.nombreFormate(2,',',' ');
							} else {
								lResponse.soldeTotal = '0'.nombreFormate(2,',',' ');
							}
							lResponse.sigleMonetaire = gSigleMonetaire;
							
							var lCompteAssociationTemplate = new CompteAssociationTemplate();
							$('#contenu').replaceWith(that.affectEntete($(lCompteAssociationTemplate.rechercheListeOperation.template(lResponse))));
							that.recherche(lVo);
							
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.affectEntete = function(pData) {
		pData = this.affectControleDatepicker(pData);
		pData = this.affectRechercheListeOperation(pData);
		pData = this.exportListeOperation(pData);
		pData = this.affectAjoutOperation(pData);
		pData = this.affectVirement(pData);
		pData = this.affectEditCompte(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectEditCompte = function(pData) {
		var lCompteAssociationTemplate = new CompteAssociationTemplate();
		
		pData.find("#btn-edit-compte").click(function() {
			// Charge les informations du compte
			$.post(	"./index.php?m=CompteAssociation&v=InformationBancaire", "pParam=" + $.toJSON({fonction:"afficher"}),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(lResponse.informationBancaire.id == null) {
								lResponse.informationBancaire = {};
							}
							// Affiche les informations
							$(lCompteAssociationTemplate.dialogEditerCompte.template(lResponse.informationBancaire)).dialog({
								autoOpen: true,
								modal: true,
								draggable: false,
								resizable: false,
								width:400,
								buttons: {
									'Valider': function() {
										var lDialog = $(this);
										
										// Récupération du formulaire
										var lVo = new InformationBancaireVO();
										lVo.numeroCompte = $(this).find("#numeroCompte").val();
										lVo.raisonSociale = $(this).find("#raisonSociale").val();
										
										// Contrôle des données
										var lValid = new InformationBancaireValid();
										var lVr = lValid.validDelete(lVo);
										
										Infobulle.init(); // Supprime les erreurs
										if(lVr.valid) {
											// Enregistrement
											lVo.fonction = 'enregistrer';
											$.post(	"./index.php?m=CompteAssociation&v=InformationBancaire", "pParam=" + $.toJSON(lVo),
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
															Infobulle.generer(lVr,'');
															lDialog.dialog("close");							
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
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		});
		return pData;
	};
	
	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateDebut','dateFin',pData);
		pData.find('#dateDebut, #dateFin').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	};
	
	this.affectRechercheListeOperation = function(pData) {
		var that = this;
		pData.find('#btn-rechercher-liste-operation').click(function() {
			var lVo = new RechercheListeOperationVO();
			lVo.dateDebut = $('#dateDebut').val().dateFrToDb();
			lVo.dateFin = $('#dateFin').val().dateFrToDb();

			var lValid = new CompteAssociationValid();
			var lVr = lValid.validRechercheListeOperation(lVo);

			Infobulle.init(); // Supprime les erreurs
			if(lVr.valid) {
				that.recherche(lVo);
			} else {
				Infobulle.generer(lVr,'');
			}
		});
		return pData;
	};
	
	this.exportListeOperation = function(pData) {
		pData.find('#btn-export-liste-operation').click(function() {
			var lVo = new RechercheListeOperationVO();
			lVo.dateDebut = $('#dateDebut').val().dateFrToDb();
			lVo.dateFin = $('#dateFin').val().dateFrToDb();

			var lValid = new CompteAssociationValid();
			var lVr = lValid.validRechercheListeOperation(lVo);

			Infobulle.init(); // Supprime les erreurs
			if(lVr.valid) {
				lVo.fonction = "export";
				// Affichage
				$.download("./index.php?m=CompteAssociation&v=Compte", lVo);
			} else {
				Infobulle.generer(lVr,'');
			}
		});
		return pData;
	};
	
	this.recherche = function(pVo) {
		var that = this;
		pVo.fonction = "rechercher";
		$.post(	"./index.php?m=CompteAssociation&v=Compte", "pParam=" + $.toJSON(pVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pVo && pVo.vr) {
								Infobulle.generer(pVo.vr,'');
							}
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		//var that = this;
		var lCompteAssociationTemplate = new CompteAssociationTemplate();
		if(lResponse.operation.length > 0 && lResponse.operation[0].opeId != null) {
			$(lResponse.operation).each(function() {
				if(this.opeId != null) {
					if(this.numeroCheque != null) {
						this.tppType += ' N°' + this.numeroCheque;
					}
					if(this.opeMontant < 0) {
						this.debit = (this.opeMontant * -1);
						this.credit = '';
					} else {
						this.debit = '';
						this.credit = this.opeMontant;
					}
				}
			});
		} else {
			lResponse.operation = [];
		}
		$('#liste-operation').html(this.affect($(lCompteAssociationTemplate.InfoCompte.template(lResponse))));
	};
	
	this.affect = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectDataTable(pData);
		return pData;
	};
	
	this.affectDataTable = function(pData) {
		pData.find('#table-operation').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 25,
	        "aaSorting": [[0,'desc']],
	        "aoColumnDefs": [
                  { "bSortable": false,
                	"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
                	"aTargets": [ 4,5 ] 
                  },
                  {	 "sType": "date",
                 	 "mRender": function ( data, type, full ) {
                 		return data.extractDbDate().dateDbToFr();
                 	  },
                 	"aTargets": [ 0 ]
                   }, 
                   {	 "sType": "numeric",
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
	             	      "aTargets": [ 1 ]
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
		           }]
	    });
		return pData;		
	};
	

	this.affectAjoutOperation = function(pData) {
		var that = this;
		pData.find('#btn-operation').click(function() {
			var lParam = {fonction:"infoOperation"};
			
			if(that.mBanques.length == 0) {
				$.post(	"./index.php?m=CompteAssociation&v=Compte", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								that.mBanques = lResponse.banques;
								that.mTypePaiement = lResponse.typePaiement;
								that.dialogOperation();
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
			} else {
				that.dialogOperation();
			}
		});
		return pData;
	};
	
	this.dialogOperation = function(pData) {
		var that = this;
		
		var lData = {sigleMonetaire:gSigleMonetaire,
				typePaiement:this.mTypePaiement};
		
		var lCompteAssociationTemplate = new CompteAssociationTemplate();
		this.affectDialog($(lCompteAssociationTemplate.dialogOperation.template(lData))).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Valider': function() {
			
					var lVo = that.getRechargementVO();									
					lVo.idCompte = -4;
					
					var lValid = new OperationDetailValid();
					var lVr = lValid.validAjout(lVo,{reel:true});
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						lVo.fonction = "ajoutOperation";
						var lDialog = this;
						$.post(	"./index.php?m=CompteAssociation&v=Compte", "pParam=" + $.toJSON(lVo),
							function(lResponse) {
								Infobulle.init(); // Supprime les erreurs
								if(lResponse.valid) {
									
									// Message d'information
									var lVr = new TemplateVR();
									lVr.valid = false;
									lVr.log.valid = false;
									var erreur = new VRerreur();
									erreur.code = ERR_301_CODE;
									erreur.message = ERR_301_MSG;
									lVr.log.erreurs.push(erreur);
									var lParam = {vr:lVr};
									that.construct(lParam);
									
									$(lDialog).dialog("close");										
								} else {
									Infobulle.generer(lResponse,'');
								}
							},"json"
						);
					}else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() { $(this).dialog("close"); }
				},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.affectDialog = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
		});
		return pData;
	};
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		if(!this.mTypePaiement[lId] || (this.mTypePaiement[lId] && this.mTypePaiement[lId].champComplementaire.length == 0)) {
			$('.champ-complementaire').remove();
		} else {
			var lRechargementCompteTemplate = new RechargementCompteTemplate();
			var lTypePaiementService = new TypePaiementService();
			$('#ligne-operation').after(lTypePaiementService.affect($(lRechargementCompteTemplate.champComplementaire.template(this.mTypePaiement[lId])),this.mBanques));
		}
	};
	
	this.getRechargementVO = function() {
		var lVo = new OperationDetailVO();
		var lMontant = $(":input[name=montant]").val().numberFrToDb();
		if(!isNaN(lMontant) && !lMontant.isEmpty()){			
			var lSigne = parseFloat($(":input[name=signe]:checked").val());
			lMontant = lSigne * parseFloat(lMontant);
		}

		lVo.montant = lMontant;
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		lVo.libelle = $(":input[name=libelle]").val();
		
		if(this.mTypePaiement[lVo.typePaiement]) {
			var lTypePaiementService = new TypePaiementService();
			lVo.champComplementaire = lTypePaiementService.getChampComplementaire(this.mTypePaiement[lVo.typePaiement].champComplementaire);
		}
		return lVo;
	};
	
	this.affectVirement = function(pData) {
		var that = this;
		pData.find('#btn-virement').click(function() {
			var lCompteAssociationTemplate = new CompteAssociationTemplate();
									
			var lDialog = $(that.affectDialogVirement($(lCompteAssociationTemplate.dialogVirement.template({sigleMonetaire:gSigleMonetaire})))).dialog({
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
		});
		return pData;
	};
	
	this.affectDialogVirement = function(pData) {
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.envoyerVirement = function(pDialog,pData) {
		var that = this;
		
		var lVo = new CompteAssociationAjoutVirementVO();
		lVo.montant = $(pDialog).find(":input[name=montant]").val().numberFrToDb();
		
		var lValid = new CompteAssociationAjoutVirementValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "ajoutVirement";
			//var lDialog = this;
			$.post(	"./index.php?m=CompteAssociation&v=Compte", "pParam=" + $.toJSON(lVo),
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