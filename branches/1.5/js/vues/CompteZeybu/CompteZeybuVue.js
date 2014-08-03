;function CompteZeybuVue(pParam) {
	//this.mIdMarche = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CompteZeybuVue(pParam);}} );
		var that = this;
		pParam = $.extend(true,{},pParam);
		
		/*if(pParam.idMarche) {
			this.mIdMarche = pParam.idMarche;
		}*/
		
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=CompteZeybu&v=CompteZeybu", "pParam=" + $.toJSON(pParam),
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
							if(lResponse.soldeSolidaire != null) {
								lResponse.soldeSolidaire = lResponse.soldeSolidaire.nombreFormate(2,',',' ');
							} else {
								lResponse.soldeSolidaire = '0'.nombreFormate(2,',',' ');
							}
							lResponse.sigleMonetaire = gSigleMonetaire;
							
							var lCompteZeybuTemplate = new CompteZeybuTemplate();
							$('#contenu').replaceWith(that.affectEntete($(lCompteZeybuTemplate.rechercheListeOperation.template(lResponse))));
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
		pData = this.affectEditCompte(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectEditCompte = function(pData) {
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		
		pData.find("#btn-edit-compte").click(function() {
			// Charge les informations du compte
			$.post(	"./index.php?m=CompteZeybu&v=InformationBancaire", "pParam=" + $.toJSON({fonction:"afficher"}),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(lResponse.informationBancaire.id == null) {
								lResponse.informationBancaire = {};
							}
							// Affiche les informations
							$(lCompteZeybuTemplate.dialogEditerCompte.template(lResponse.informationBancaire)).dialog({
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
											$.post(	"./index.php?m=CompteZeybu&v=InformationBancaire", "pParam=" + $.toJSON(lVo),
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
			lVo.idMarche = $('#idMarche').val();

			var lValid = new CompteZeybuValid();
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
			lVo.idMarche = $('#idMarche').val();

			var lValid = new CompteZeybuValid();
			var lVr = lValid.validRechercheListeOperation(lVo);

			Infobulle.init(); // Supprime les erreurs
			if(lVr.valid) {
				lVo.fonction = "export";
				// Affichage
				$.download("./index.php?m=CompteZeybu&v=CompteZeybu", lVo);
			} else {
				Infobulle.generer(lVr,'');
			}
		});
		return pData;
	};
	
	this.recherche = function(pVo) {
		var that = this;
		pVo.fonction = "rechercher";
		$.post(	"./index.php?m=CompteZeybu&v=CompteZeybu", "pParam=" + $.toJSON(pVo),
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
		var that = this;
				
		$(lResponse.operation).each(function() {
			if(this.opeId != null) {
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
				if(this.numeroCheque != null) {
					this.tppType += ' N°' + this.numeroCheque;
				}
				if(this.opeMontant < 0) {
					this.debit = (this.opeMontant * -1).nombreFormate(2,',',' ');
					this.credit = '';
					this.sigleMonetaireDebit = gSigleMonetaire;
					this.sigleMonetaireCredit = '';
				} else {
					this.debit = '';
					this.credit = this.opeMontant.nombreFormate(2,',',' ');
					this.sigleMonetaireDebit = '';
					this.sigleMonetaireCredit = gSigleMonetaire;
				}
			}
		});

		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		if(lResponse.operation.length > 0 && lResponse.operation[0].opeId != null) {
			var lHtml = $(lCompteZeybuTemplate.InfoCompte.template(lResponse));

			// Ne pas afficher la pagination si il y a moins de 30 éléments
			if(lResponse.operation.length < 31) {
				lHtml = this.masquerPagination(lHtml);
			} else {
				lHtml = this.paginnation(lHtml);
			}
			
			$('#liste-operation').html(that.affect(lHtml));
		} else {
			$('#liste-operation').html(lCompteZeybuTemplate.listeOperationVide.template(lResponse));
		}
	};
	
	this.affect = function(pData) {
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
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false,size:30}); 
		return pData;
	};
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	};
	
	this.construct(pParam);
}