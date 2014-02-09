;function ListeAdhesionVue(pParam) {
	this.mTypes = [];
	this.mIdTypeAdhesion = 0;
	this.mPerimetres = [];
	this.mPerimetresAffiche = {};
	this.mBloquerValid = false;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeAdhesionVue(pParam);}} );
		var that = this;
		var lVo = {fonction:"listeAdhesion"};
		$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mTypes = [];
							that.mIdTypeAdhesion = 0;
							that.mPerimetres = [];
							that.mPerimetresAffiche = {};
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
		if(lResponse.listeAdhesion.length > 0 && lResponse.listeAdhesion[0].id != null) {
			$(lResponse.listeAdhesion).each(function() {
				this.dateDebut = this.dateDebut.extractDbDate().dateDbToFr();
				this.dateFin = this.dateFin.extractDbDate().dateDbToFr();
			});
			
			if(lResponse.listeAdhesion.length == 1) {
				lResponse.titreAdhesion = lAdhesionTemplate.titreAdhesionSingulier;
			} else {
				lResponse.titreAdhesion = lAdhesionTemplate.titreAdhesionPluriel;
			}
			$('#contenu').replaceWith(that.affect($(lAdhesionTemplate.listeAdhesion.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lAdhesionTemplate.listeAdhesionVide)));
		}
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectAjoutAdhesion(pData);
		pData = this.affectModifierAdhesion(pData);
		pData = this.affectSupprimerAdhesion(pData);
		pData = this.affectDetailAdhesion(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[1,1]],headers: { 3: {sorter: false}, 4: {sorter: false}, 5: {sorter: false} }});
		return pData;
	};
	
	this.affectModifierAdhesion = function(pData) {
		var that = this;
		pData.find(".btn-modifier-adhesion").click(function() {
			var lId = $(this).data('id');
			$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON({fonction:'detailAdhesion', id:lId}),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								that.chargerPerimetre(that.dialogModifierAdhestion,lResponse);
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
		});
		return pData;
	};
	
	this.dialogModifierAdhestion = function(pResponse) {
		var that = this;
		
		pResponse.adhesion.dateDebut = pResponse.adhesion.dateDebut.extractDbDate().dateDbToFr();
		pResponse.adhesion.dateFin = pResponse.adhesion.dateFin.extractDbDate().dateDbToFr();
		
		$.each(pResponse.adhesion.types, function(){
			this.montant = this.montant.nombreFormate(2,',',' ');
			that.mTypes[this.id] = this;
		});
		
		
		var lData = pResponse.adhesion;
		lData.listePerimetre = this.mPerimetresAffiche;
		lData.sigleMonetaire = gSigleMonetaire;
		var lId = pResponse.adhesion.id;
		var lAdhesionTemplate = new AdhesionTemplate();		
		$(this.affectDialogModifAdhesion($(lAdhesionTemplate.dialogAjoutAdhesion.template(lData)))).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:805,
			buttons: {
				'Valider': function() {
					if(that.mBloquerValid) { // Si une édition est en cours pas de validation
						var lVR = {};
						var erreur = new VRerreur();
						erreur.code = ERR_112_CODE;
						erreur.message = ERR_112_MSG;
						lVR.valid = false;
						lVR.log = new VRelement();
						lVR.log.valid = false;
						lVR.log.erreurs.push(erreur);
						Infobulle.generer(lVR,'');
					} else {					
						var lVo = new AdhesionDetailVO();
						lVo.id = lId;
						lVo.label = $('#label').val();
						lVo.dateDebut = $('#dateDebut').val().dateFrToDb();
						lVo.dateFin = $('#dateFin').val().dateFrToDb();
						
						for(i in that.mTypes) {
							if(that.mTypes[i] != 'undefined') {
								lVo.types.push(that.mTypes[i]);							
							}
						}
	
						var lValid = new AdhesionValid();
						var lVr = lValid.validAjout(lVo);
						
						Infobulle.init(); // Supprime les erreurs
						if(lVr.valid) {	
							var lDialog = $(this);
							lVo.fonction = 'updateAdhesion';
							$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lVo),
									function(lResponse) {
										Infobulle.init(); // Supprime les erreurs
										if(lResponse) {
											if(lResponse.valid) {
												if(pParam && pParam.vr) {
													Infobulle.generer(pParam.vr,'');
												}
												var lVR = new Object();
												var erreur = new VRerreur();
												erreur.code = ERR_365_CODE;
												erreur.message = ERR_365_MSG;
												lVR.valid = false;
												lVR.log = new VRelement();
												lVR.log.valid = false;
												lVR.log.erreurs.push(erreur);
												
												that.construct({vr:lVR});
												lDialog.dialog('close');
											} else {
												Infobulle.generer(lResponse,'');
											}
										}
									},"json"
								);
						} else {
							Infobulle.generer(lVr,'');
						}
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});	
	};
	
	this.affectDialogModifAdhesion = function(pData) {
		pData = this.affectControleDatepicker(pData);
		pData = this.affectAjoutTypeAdhesion(pData);
		pData = this.affectModifierTypeAdhesion(pData);
		pData = this.affectAnnulerModifierTypeAdhesion(pData);
		pData = this.affectValiderModifierTypeAdhesion(pData);
		pData = this.affectSupprimerLigneTypeAdhesionExistante(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;		
	};
	
	this.affectModifierTypeAdhesion = function(pData) {
		var that = this;
		pData.find('.btn-modifier-type-adhesion').click(function() {
			var lId = $(this).data('id');
			$('.edition-type-adhesion-' + lId).toggle();
			$('#type-' + lId + '-label').val($('#span-' + lId + '-label').text());
			that.mBloquerValid = true;
		});
		return pData;
	};
	
	this.affectAnnulerModifierTypeAdhesion = function(pData) {
		var that = this;
		pData.find('.btn-annuler-modifier-type').click(function() {
			var lId = $(this).data('id');
			$('.edition-type-adhesion-' + lId).toggle();
			that.mBloquerValid = false;
		});
		return pData;
	};
	
	this.affectValiderModifierTypeAdhesion = function(pData) {
		var that = this;
		pData.find('.btn-valider-modifier-type').click(function() {
			var lId = $(this).data('id');
			
			var lVo = $.extend(true,{},that.mTypes[lId]);
			lVo.label = $('#type-' + lId + '-label').val();
			
			var lValid = new TypeAdhesionValid();
			var lVr = lValid.validAjout(lVo);
			
			Infobulle.init(); // Supprime les erreurs
			if(lVr.valid) {	
				that.mTypes[lId] = lVo;
				$('#span-' + lId + '-label').text(lVo.label);
				$('.edition-type-adhesion-' + lId).toggle();
				that.mBloquerValid = false;
			} else {
				Infobulle.generer(lVr,'type-' + lId + '-');
			}			
		});
		return pData;
	};
	
	this.affectSupprimerLigneTypeAdhesionExistante = function(pData) {
		var that = this;
		pData.find('.btn-sup-type-adhesion').click(function() {
			var lId = $(this).data('id');
			// Vérification si il y a des adhérent sur le type d'ahésion
			$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON({fonction:'autorisationSupprimerTypeAdhesion',id:lId}),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								var lAdhesionTemplate = new AdhesionTemplate();		
								if(!lResponse.autorise) { // Des adhérents sont sur le type d'adhésion, il faut extraire la liste
									$(that.affectDialogListeAdherentSurTypeAdhesion($(lAdhesionTemplate.dialogListeAdherent.template({id:lId})))).dialog({			
										autoOpen: true,
										modal: true,
										draggable: true,
										resizable: false,
										width:600,
										close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
									});	
								} else { // Aucun adhérent on supprime
									// Suppression du tableau
									delete that.mTypes[lId];
									// Suppression de l'affichage
									$('#ligne-type-adhesion-' + lId).remove();
								}
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
		});
		return pData;
	};
	
	this.affectDialogListeAdherentSurTypeAdhesion = function(pData) {
		var that = this;
		pData = gCommunVue.comHoverBtn(pData);
		pData.find('#btn-extract-adh-sur-ads').click(function() {
			var lId = $(this).data('id');
			// Récupération de la liste des adhérents
			$.download("./index.php?m=Adhesion&v=GestionAdhesion", {fonction:'listeAdherentSurTypeAdhesion',id:lId});
			var lAdhesionTemplate = new AdhesionTemplate();		
			// Ajout du bouton de suppression
			$(this).replaceWith(that.affectBoutonSupprimerTypeAdhesion($(lAdhesionTemplate.buttonSupprimerAdhesion.template({id:lId}))));
		});
		return pData;
	};
	
	this.affectBoutonSupprimerTypeAdhesion = function(pData) {
		var that = this;
		pData.click(function() {
			var lId = $(this).data('id');
			// Suppression du tableau
			delete that.mTypes[lId];
			// Suppression de l'affichage
			$('#ligne-type-adhesion-' + lId).remove();
			
			$('#dialog-sup-adhesion').dialog('close');
		});
		return pData;
	};

	this.affectAjoutAdhesion = function(pData) {
		var that = this;
		pData.find('#btn-nv-adhesion').click(function() {
			// Réinit si déjà ouvert précédemment
			that.mTypes = [];
			// Chargement du périmètre si aucun déjà chargé
			that.chargerPerimetre(that.dialogAjoutAdhestion);			
		});
		return pData;
	};
	
	this.chargerPerimetre = function(pCallBack, pCallBackParam) {
		var that = this;
		if(this.mPerimetres.length == 0) {
			$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON({fonction:'listePerimetre'}),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								that.mPerimetresAffiche = lResponse.listePerimetre;
								$.each(lResponse.listePerimetre,function() {
									that.mPerimetres[this.id] = this;
								});									
								pCallBack(pCallBackParam);
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
		} else {
			pCallBack(pCallBackParam);
		}
	};
	
	this.dialogAjoutAdhestion = function() {
		var that = this;
		var lData = {listePerimetre:this.mPerimetresAffiche, sigleMonetaire:gSigleMonetaire};
		var lAdhesionTemplate = new AdhesionTemplate();		
		$(this.affectDialogAjoutAdhesion($(lAdhesionTemplate.dialogAjoutAdhesion.template(lData)))).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:805,
			buttons: {
				'Valider': function() {
					var lVo = new AdhesionDetailVO();
					lVo.label = $('#label').val();
					lVo.dateDebut = $('#dateDebut').val().dateFrToDb();
					lVo.dateFin = $('#dateFin').val().dateFrToDb();
					
					for(i in that.mTypes) {
						if(that.mTypes[i] != 'undefined') {
							lVo.types.push(that.mTypes[i]);							
						}
					}

					var lValid = new AdhesionValid();
					var lVr = lValid.validAjout(lVo);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {	
						var lDialog = $(this);
						lVo.fonction = 'ajoutAdhesion';
						$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lVo),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											if(pParam && pParam.vr) {
												Infobulle.generer(pParam.vr,'');
											}
											var lVR = new Object();
											var erreur = new VRerreur();
											erreur.code = ERR_364_CODE;
											erreur.message = ERR_364_MSG;
											lVR.valid = false;
											lVR.log = new VRelement();
											lVR.log.valid = false;
											lVR.log.erreurs.push(erreur);
											
											that.construct({vr:lVR});
											lDialog.dialog('close');
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
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});	
	};
	
	this.affectDialogAjoutAdhesion = function(pData) {
		pData = this.affectControleDatepicker(pData);
		pData = this.affectAjoutTypeAdhesion(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateDebut','dateFin',pData);
		return pData;
	};
	
	this.affectAjoutTypeAdhesion = function(pData) {
		var that = this;
		pData.find('#btn-ajout-type-adhesion').click(function() {			
			var lVo = new TypeAdhesionDetailVO();
			lVo.label = $('#type-label').val();
			lVo.montant = $('#type-montant').val().numberFrToDb();
			lVo.idPerimetre = $('#type-idPerimetre').val();
			
			var lValid = new TypeAdhesionValid();
			var lVr = lValid.validAjout(lVo);
			
			Infobulle.init(); // Supprime les erreurs
			if(lVr.valid) {	
				that.mIdTypeAdhesion--;
				that.mTypes[that.mIdTypeAdhesion] = lVo;
				
				var lAdhesionTemplate = new AdhesionTemplate();
				var lData = {id:that.mIdTypeAdhesion,
						label:lVo.label,
						montant:lVo.montant.nombreFormate(2,',',' '),
						perLabel:that.mPerimetres[lVo.idPerimetre].label,
						sigleMonetaire:gSigleMonetaire
				};
				$("#liste-type-adhesion").prepend(that.affectLigneTypeAdhesion($(lAdhesionTemplate.ligneTypeAdhesion.template(lData))));
				$('#type-label, #type-montant').val('');
				
			} else {
				Infobulle.generer(lVr,'type-');
			}
		});
		return pData;
	};
	
	this.affectLigneTypeAdhesion = function(pData) {
		pData = this.affectSupprimerLigneTypeAdhesion(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectSupprimerLigneTypeAdhesion = function(pData) {
		var that = this;
		pData.find('.btn-sup-type-adhesion').click(function() {
			var lId = $(this).data('id');
			// Suppression du tableau
			delete that.mTypes[lId];
			// Suppression de l'affichage
			$('#ligne-type-adhesion-' + lId).remove();
		});
		return pData;
	};
	
	this.affectSupprimerAdhesion = function(pData){
		var that = this;
		pData.find('.btn-supprimer-adhesion').click(function() {
			var lId = $(this).data('id');
			// Vérification si il y a des adhérent sur le type d'ahésion
			$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON({fonction:'autorisationSupprimerAdhesion',id:lId}),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								var lAdhesionTemplate = new AdhesionTemplate();		
								if(!lResponse.autorise) { // Des adhérents sont sur l'adhésion, il faut extraire la liste
									$(that.affectDialogListeAdherentSurAdhesion($(lAdhesionTemplate.dialogListeAdherent.template({id:lId})))).dialog({			
										autoOpen: true,
										modal: true,
										draggable: true,
										resizable: false,
										width:600,
										close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
									});	
								} else { // Aucun adhérent on supprime
									// Dialog confirmation de la suppression
									that.dialogSuppressionAdhesion(lId);
								}
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
		});
		return pData;
	};
	
	this.affectDialogListeAdherentSurAdhesion = function(pData) {
		var that = this;
		pData = gCommunVue.comHoverBtn(pData);
		pData.find('#btn-extract-adh-sur-ads').click(function() {
			var lId = $(this).data('id');
			// Récupération de la liste des adhérents
			$.download("./index.php?m=Adhesion&v=GestionAdhesion", {fonction:'listeAdherentSurAdhesion',id:lId});
			// Dialog confirmation de la suppression
			that.dialogSuppressionAdhesion(lId);
			$('#dialog-sup-adhesion').dialog('close');
		});
		return pData;
	};
	
	this.dialogSuppressionAdhesion = function(pId) {
		var that = this;
		var lAdhesionTemplate = new AdhesionTemplate();		
		$(lAdhesionTemplate.dialogSuppressionAdhesion).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:400,
			buttons: {
				'Supprimer': function() {
					var lDialog = $(this);
					$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON({fonction:'supprimerAdhesion',id:pId}),
							function(lResponse) {
								Infobulle.init(); // Supprime les erreurs
								if(lResponse) {
									if(lResponse.valid) {
										if(pParam && pParam.vr) {
											Infobulle.generer(pParam.vr,'');
										}
										var lVR = new Object();
										var erreur = new VRerreur();
										erreur.code = ERR_366_CODE;
										erreur.message = ERR_366_MSG;
										lVR.valid = false;
										lVR.log = new VRelement();
										lVR.log.valid = false;
										lVR.log.erreurs.push(erreur);
										
										that.construct({vr:lVR});
										lDialog.dialog('close');
									} else {
										Infobulle.generer(lResponse,'');
									}
								}
							},"json"
						);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});	
	};
	
	this.affectDetailAdhesion = function(pData) {
		pData.find('.btn-detail-adhesion').click(function() {
			DetailAdhesionVue({"id":$(this).data('id')});
		});
		return pData;
	};
	
	this.construct(pParam);
}