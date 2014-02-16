;function DetailAdhesionVue(pParam) {
	this.mIdAdhesion = 0;
	this.mTypePaiement = [];
	this.mBanques = [];
	this.mTypes = [];
	this.mTypePaiementSelect = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {DetailAdhesionVue(pParam);}} );
		var that = this;
		this.mIdAdhesion = pParam.id;
		pParam.fonction = "listeAdherentAdhesion";
		$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
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
		var that = this;
		var lAdhesionTemplate = new AdhesionTemplate();		
		
		lResponse.label = lResponse.adhesion.label;
		lResponse.dateDebut = lResponse.adhesion.dateDebut.extractDbDate().dateDbToFr();
		lResponse.dateFin = lResponse.adhesion.dateFin.extractDbDate().dateDbToFr();

		if(lResponse.listeAdherent.length > 0 && lResponse.listeAdherent[0].adhId != null) {			
			lResponse.listeAdherentAdhesion = lAdhesionTemplate.listeAdherentAdhesion.template(lResponse);
		} else {			
			lResponse.listeAdherentAdhesion = lAdhesionTemplate.listeAdherentAdhesionVide;
		}
		
		$('#contenu').replaceWith(that.affect($(lAdhesionTemplate.detailAdhesion.template(lResponse))));
	};
	
	this.affect = function(pData) {
		pData = this.affectLienRetour(pData);
		pData = this.affectExport(pData);
		// Avant DataTables sinon prise en compte uniquement de la première page car hidden
		pData = this.affectGestionAdhesionAdherent(pData);
		pData = gCommunVue.comHoverBtn(pData); 
		pData = this.affectDataTable(pData);
		return pData;
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#lien-retour").click(function() { ListeAdhesionVue(); });
		return pData;
	};
	
	this.affectDataTable = function(pData) {
		pData.find('#liste-adherent-adhesion').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 25,
	        "aaSorting": [[2,'asc'], [3,'asc']],
	        "aoColumnDefs": [
                  { "bSortable": false, 
                	"bSearchable":false,
                	"aTargets": [ 6 ] 
                  },
                  {	 "sType": "numeric",
                	 "mRender": function ( data, type, full ) {
                		  	if (type === 'sort') {
                	          return data.replace("Z","");
                	        }
                	        return data;
                	      },
                	"aTargets": [ 0 ]
                  },
                  {	 "sType": "numeric",
                    	 "mRender": function ( data, type, full ) {
                    		  	if (type === 'sort') {
                    	          return data.replace("C","");
                    	        }
                    	        return data;
                    	      },
                    "aTargets": [ 1 ]
                  },
                  { "mRender": function ( data, type, full ) {
                 		  	if (type !== 'display') {
	                 	        if(data == 'null' || data == 0) {
	                 	        	return 'formulaireKO';
	               				} else {
	               					return'formulaireOK';
	               				}
                 	        } else {
                 	        	if(data == 'null' || data == 0) {
	                 	        	return '<div class="com-center-div qte-reservation-ko ui-corner-all"></div>';
	               				} else {
	               					return '<div class="com-center-div qte-reservation-ok ui-corner-all"></div>';
	               				}
                 	        }
                 	      },
                 	 "aTargets": [ 4 ]
                  },
                  { "mRender": function ( data, type, full ) {
	           		  	if (type !== 'display') {
	               	        if(data == 'null') {
	               	        	return 'adhesionKO';
	             				} else {
	             					return'adhesionOK';
	             				}
	           	        } else {
	           	        	if(data == 'null') {
	               	        	return '<div class="com-center-div qte-reservation-ko ui-corner-all"></div>';
	             				} else {
	             					return '<div class="com-center-div qte-reservation-ok ui-corner-all"></div>';
	             				}
	           	        }
	           	      },
	           	      "aTargets": [ 5 ]
	            }]
	    });
		return pData;		
	};
	
	this.affectExport = function(pData) {
		var that = this;
		pData.find('#btn-export-ads').click(function() {
			$.download("./index.php?m=Adhesion&v=GestionAdhesion", {fonction:'exportListeAdherentSurAdhesion',id:that.mIdAdhesion});
		});
		return pData;
	};
	
	this.affectGestionAdhesionAdherent = function(pData) {
		var that = this;
		pData.find('.gestion-adhesion-adherent').click(function() {
			var lIdAdhesionAdherent = $(this).data('id-adhesion-adherent');
			if(lIdAdhesionAdherent == null) {// Pas d'adhésion adhérent Formulaire d'ajout
				var lIAdherent = $(this).data('id-adherent');
				that.ajoutAdhesionAdherentForm(lIAdherent);
			} else { // Formulaire de modification et suppression
				that.modifAdhesionAdherentForm(lIdAdhesionAdherent);
			}
		});		
		return pData;
	};
	
	this.ajoutAdhesionAdherentForm = function(pIdAdherent) {
		var that = this;
		var lParam = {'id':this.mIdAdhesion, 'idAdherent':pIdAdherent,
						fonction:"infoAjoutAdhesionAdherent"};
		
		$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {	
						that.mTypePaiementSelect = 0;
						
						var lAdhesionTemplate = new AdhesionTemplate();
						
						lResponse.sigleMonetaire = gSigleMonetaire;
						that.mTypePaiement = lResponse.typePaiement;
						that.mBanques = lResponse.banques;	
						that.mTypes = [];
						$.each(lResponse.adhesion.types, function() {
							that.mTypes[this.id] = this;
						});
						
						if(lResponse.adhesion.types.length > 1) { // Plusieurs types possible => Le select
							lResponse.type = lAdhesionTemplate.selectTypeAdhesion.template(lResponse.adhesion);
							lResponse.perimetre = '';
							lResponse.montant = lAdhesionTemplate.typeAdhesionMontant.template({montant:'',sigleMonetaire:''});
						} else { // Un seul type => pas de select
							lResponse.type = lAdhesionTemplate.typeAdhesionUnique.template(lResponse.adhesion.types[0]);
							lResponse.perimetre = lResponse.adhesion.types[0].perLabel;
							lResponse.montant = lAdhesionTemplate.typeAdhesionMontant.template({montant:lResponse.adhesion.types[0].montant.nombreFormate(2,',',' '),sigleMonetaire:gSigleMonetaire});
						}
						
						lResponse.label = lResponse.adhesion.label;
						lResponse.dateDebut = lResponse.adhesion.dateDebut.extractDbDate().dateDbToFr();
						lResponse.dateFin = lResponse.adhesion.dateFin.extractDbDate().dateDbToFr();
						
						
						that.affectDialog($(lAdhesionTemplate.dialogAdhesionAdherent.template(lResponse))).dialog({
							autoOpen: true,
							modal: true,
							draggable: false,
							resizable: false,
							width:370,
							buttons: {
								//'Annuler': function() { $(this).dialog("close"); },								
								'Valider': function() {
							
									var lVo = new AdhesionAdherentDetailVO();									
									lVo.adhesionAdherent.idAdherent = pIdAdherent;
									lVo.adhesionAdherent.idTypeAdhesion = $(':input[name=typeAdhesion]').val();
									lVo.adhesionAdherent.statutFormulaire = $('#adhesionAdherentstatutFormulaire').is(':checked') ? 1 : 0;
									lVo.operation = that.getOperationVO();
									
									
									var lValid = new AdhesionAdherentDetailValid();
									var lVr = lValid.validAjout(lVo);
									
									Infobulle.init(); // Supprime les erreurs
									if(lVr.valid) {
										lVo.fonction = "ajoutAdhesionAdherent";
										var lDialog = this;
										$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lVo),
											function(lResponse) {
												Infobulle.init(); // Supprime les erreurs
												if(lResponse.valid) {
													
													// Message d'information
													var lVr = new TemplateVR();
													lVr.valid = false;
													lVr.log.valid = false;
													var erreur = new VRerreur();
													erreur.code = ERR_364_CODE;
													erreur.message = ERR_364_MSG;
													lVr.log.erreurs.push(erreur);
													var lParam = {id:that.mIdAdhesion,vr:lVr};
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
								}
							},
							close: function(ev, ui) { $(this).remove(); }
						});
						that.changerTypePaiement($(":input[name=typepaiement]"));
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);		
	};
	
	this.affectDialog = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectChangementType(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
		});

		pData.find(":input[name=typepaiement] option[value='" + that.mTypePaiementSelect + "']").prop("selected", true);
		return pData;
	};
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		if(!this.mTypePaiement[lId] || (this.mTypePaiement[lId] && this.mTypePaiement[lId].champComplementaire.length == 0)) {
			$('.champ-complementaire').remove();
		} else {
			var lAdhesionTemplate = new AdhesionTemplate();
			var lTypePaiementService = new TypePaiementService();
			$('#ligne-operation').after(lTypePaiementService.affect($(lAdhesionTemplate.champComplementaire.template(this.mTypePaiement[lId])),this.mBanques, 'operation'));
		}
	};
	
	this.affectChangementType = function(pData) {
		var that = this;
		pData.find(":input[name=typeAdhesion]").change(function() {
			var lType = that.mTypes[$(this).val()];
			if(lType != undefined) {
				var lAdhesionTemplate = new AdhesionTemplate();
				$('#td-montant-adhesion-adherent').html(lAdhesionTemplate.typeAdhesionMontant.template({montant:lType.montant.nombreFormate(2,',',' '),sigleMonetaire:gSigleMonetaire}));
				//$('#montant-adhesion-adherent').text(lType.montant.nombreFormate(2,',',' '));
				$('#perimetre-adhesion-adherent').text(lType.perLabel);
			} else {
				$('#td-montant-adhesion-adherent, #perimetre-adhesion-adherent').text('');
			}
		});
		return pData;
	};
	
	this.getOperationVO = function() {
		var lVo = new OperationDetailVO();
		var lMontant = $("#montant-adhesion-adherent").text().numberFrToDb();
		if(!isNaN(lMontant) && !lMontant.isEmpty()){
			lMontant = parseFloat(lMontant);
		} else {
			lMontant = 0;
		}
		lVo.montant = lMontant;
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		lVo.idCompte = -4;
		
		if(this.mTypePaiement[lVo.typePaiement]) {
			var lTypePaiementService = new TypePaiementService();
			lVo.champComplementaire = lTypePaiementService.getChampComplementaire(this.mTypePaiement[lVo.typePaiement].champComplementaire, 'operation');
		}
		return lVo;
	};
	
	this.modifAdhesionAdherentForm = function(pIdAdhesionAdherent) {
		var that = this;
		var lParam = {'id':pIdAdhesionAdherent,
						fonction:"infoModificationAdhesionAdherent"};
		
		$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {	
						var lAdhesionTemplate = new AdhesionTemplate();
						
						lResponse.sigleMonetaire = gSigleMonetaire;
						that.mTypePaiement = lResponse.typePaiement;
						that.mBanques = lResponse.banques;	
						
						var lType = {};
						$.each(lResponse.adhesion.types, function() {
							if(this.id == lResponse.adhesionAdherent.adhesionAdherent.idTypeAdhesion) {
								lType = this;
							}
						});
						// Pas de modification du type d'adhésion possible
						lResponse.type = lAdhesionTemplate.typeAdhesionUnique.template(lType);
						lResponse.perimetre = lType.perLabel;
						lResponse.montant = lAdhesionTemplate.typeAdhesionMontant.template({montant:lType.montant.nombreFormate(2,',',' '),sigleMonetaire:gSigleMonetaire});
						
						lResponse.statutFormulaireChecked = '';
						if(lResponse.adhesionAdherent.adhesionAdherent.statutFormulaire == 1) {
							lResponse.statutFormulaireChecked = 'checked="checked"';
						}
						
						that.mTypePaiementSelect = lResponse.adhesionAdherent.operation.typePaiement;
						
						var lTypePaiementService = new TypePaiementService();
						var lChampComplementaire = [];
						if(that.mTypePaiement[lResponse.adhesionAdherent.operation.typePaiement]) {
							$(that.mTypePaiement[lResponse.adhesionAdherent.operation.typePaiement].champComplementaire).each(function() {				
								var lChamp = lResponse.adhesionAdherent.operation.champComplementaire[this.id];
								lChamp.id = this.id;
								lChamp.tppCpVisible = 1;
								lChamp.chCpLabel = this.label;
								lChampComplementaire.push(lChamp);
							});
						}
						lResponse.champComplementaire = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, that.mBanques, false, 'operation');
						
						lResponse.label = lResponse.adhesion.label;
						lResponse.dateDebut = lResponse.adhesion.dateDebut.extractDbDate().dateDbToFr();
						lResponse.dateFin = lResponse.adhesion.dateFin.extractDbDate().dateDbToFr();

						
						that.affectDialogModifier($(lAdhesionTemplate.dialogAdhesionAdherent.template(lResponse))).dialog({
							autoOpen: true,
							modal: true,
							draggable: false,
							resizable: false,
							width:370,
							buttons: {							
								'Modifier': function() {							
									var lVo = new AdhesionAdherentDetailVO();									
									lVo.adhesionAdherent = lResponse.adhesionAdherent.adhesionAdherent;
									lVo.adhesionAdherent.statutFormulaire = $('#adhesionAdherentstatutFormulaire').is(':checked') ? 1 : 0;
									
									lVo.operation = that.getOperationVO();
									lVo.operation.id = lResponse.adhesionAdherent.operation.id;									
									
									var lValid = new AdhesionAdherentDetailValid();
									var lVr = lValid.validUpdate(lVo);
									
									Infobulle.init(); // Supprime les erreurs
									if(lVr.valid) {
										lVo.fonction = "updateAdhesionAdherent";
										var lDialog = this;
										$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lVo),
											function(lResponse) {
												Infobulle.init(); // Supprime les erreurs
												if(lResponse.valid) {
													
													// Message d'information
													var lVr = new TemplateVR();
													lVr.valid = false;
													lVr.log.valid = false;
													var erreur = new VRerreur();
													erreur.code = ERR_365_CODE;
													erreur.message = ERR_365_MSG;
													lVr.log.erreurs.push(erreur);
													var lParam = {id:that.mIdAdhesion,vr:lVr};
													
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
								'Supprimer': function() { 
									$(lAdhesionTemplate.dialogConfirmSuppressionAdhesion).dialog({
										autoOpen: true,
										modal: true,
										draggable: false,
										resizable: false,
										width:450,
										buttons: {						
											'Supprimer': function() {
										
												var lVo = new AdhesionAdherentDetailVO();									
												lVo.adhesionAdherent = lResponse.adhesionAdherent.adhesionAdherent;
												var lValid = new AdhesionAdherentDetailValid();
												var lVr = lValid.validDelete(lVo);
												
												Infobulle.init(); // Supprime les erreurs
												if(lVr.valid) {
													lVo.fonction = "deleteAdhesionAdherent";
													var lDialog = this;
													$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lVo),
														function(lResponse) {
															Infobulle.init(); // Supprime les erreurs
															if(lResponse.valid) {
																
																// Message d'information
																var lVr = new TemplateVR();
																lVr.valid = false;
																lVr.log.valid = false;
																var erreur = new VRerreur();
																erreur.code = ERR_366_CODE;
																erreur.message = ERR_366_MSG;
																lVr.log.erreurs.push(erreur);
																var lParam = {id:that.mIdAdhesion,vr:lVr};
																
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
											}
										},
										close: function(ev, ui) { $(this).remove(); }
									});
									$(this).dialog("close"); 
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
	};
	
	this.affectDialogModifier = function(pData) {
		pData = this.affectSelectTypePaiementModifier(pData);
		
		var lTypePaiementService = new TypePaiementService();
		pData = lTypePaiementService.affect(pData, this.mBanques, 'operation');
		
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectSelectTypePaiementModifier = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
		});

		pData.find(":input[name=typepaiement] option[value='" + that.mTypePaiementSelect + "']").prop("selected", true);
		return pData;
	};
	
	this.construct(pParam);
}