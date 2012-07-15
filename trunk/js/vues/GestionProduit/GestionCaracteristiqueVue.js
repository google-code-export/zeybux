;function GestionCaracteristiqueVue(pParam) {
	this.mParam = {};
	this.mCaracteristiques = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {GestionCaracteristiqueVue(pParam);}} );
		var that = this;
		//pParam.fonction = "afficher";
		this.mParam = $.extend(this.mParam, pParam);
		this.mParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionProduit&v=GestionCaracteristique", "pParam=" + $.toJSON(this.mParam),
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
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		$.each(lResponse.listeCaracteristique,function() {
			that.mCaracteristiques[this.carId]=this;
		});

		var lGestionProduitTemplate = new GestionProduitTemplate();		
		if(lResponse.listeCaracteristique.length > 0 && lResponse.listeCaracteristique[0].carId != null) {
			$('#contenu').replaceWith(that.affect($(lGestionProduitTemplate.listeCaracteristique.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionProduitTemplate.listeCaracteristiqueVide)));
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		pData = this.affectDialogCreerCaracteristique(pData);
		pData = this.affectDialogModifierCaracteristique(pData);
		pData = this.affectDialogSupprimerCaracteristique(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]]});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}
	
	this.affectLienCompte = function(pData) {
		var that = this;
		pData.find('.compte-ligne')
		.click(function() {		
			
			var lId = $(this).closest('tr').attr('id');
			var lParam = {id:lId,fonction:"detailCaracteristique"};
			$.post(	"./index.php?m=GestionProduit&v=GestionCaracteristique", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionProduitTemplate = new GestionProduitTemplate();
								var lTemplate = lGestionProduitTemplate.dialogInfoCaracteristique;
								
								
								$(lTemplate.template(lResponse.caracteristique)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:600,
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								});								
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
			
		});
		return pData;
	}
	
	this.affectDialogCreerCaracteristique = function(pData) {
		var that = this;
		pData.find('#btn-nv-car')
		.click(function() {			
			var lGestionProduitTemplate = new GestionProduitTemplate();
			var lTemplate = lGestionProduitTemplate.dialogAjoutCaracteristique;
			
			$(lTemplate.template()).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer': function() {
						var lForm = $(this).children('form').first();
						that.CreerCaracteristique(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerCategorie($(this));
				return false;
			});			
		});		
		return pData;
	}
	
	this.CreerCaracteristique = function(pForm) {
		var that = this;
		var lVo = new CaracteristiqueVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new CaracteristiqueValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "ajouter";
			// Ajout
			$.post(	"./index.php?m=GestionProduit&v=GestionCaracteristique", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-car").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_326_CODE;
							erreur.message = ERR_326_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							var lParam = {vr:lVr};					
							that.construct(lParam);
						} else {
							Infobulle.generer(lResponse,'car-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'car-');
		}
	}
	
	this.affectDialogModifierCaracteristique = function(pData) {
		var that = this;
		pData.find('.btn-edt-modifier')
		.click(function() {			
			var lGestionProduitTemplate = new GestionProduitTemplate();
			var lTemplate = lGestionProduitTemplate.dialogAjoutCaracteristique;
			
			var lId = $(this).closest('tr').attr('id');
			var lParam = {id:lId,fonction:"detailCaracteristique"};
			$.post(	"./index.php?m=GestionProduit&v=GestionCaracteristique", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {								
								$(lTemplate.template(lResponse.caracteristique)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: false,
									resizable: false,
									width:400,
									buttons: {
										'Modifier': function() {
											var lForm = $(this).children('form').first();
											that.ModifierCaracteristique(lForm);
										},
										'Annuler': function() {
											$(this).dialog('close');
										}
									},
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								}).submit(function () {
									that.ModifierCaracteristique($(this));
									return false;
								});								
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);		
		});		
		return pData;
	}
	
	this.ModifierCaracteristique = function(pForm) {
		var that = this;
		var lVo = new CaracteristiqueVO();
		
		lVo.id = pForm.find(':input[name=id]').val();
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new CaracteristiqueValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "modifier";
			// Ajout
				$.post(	"./index.php?m=GestionProduit&v=GestionCaracteristique", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-car").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_327_CODE;
							erreur.message = ERR_327_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							var lParam = {vr:lVr};					
							that.construct(lParam);
						} else {
							Infobulle.generer(lResponse,'car-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'car-');
		}
	}
	
	this.affectDialogSupprimerCaracteristique = function(pData) {
		var that = this;
		pData.find('.btn-edt-supprimer')
		.click(function() {
			var lId = $(this).closest('tr').attr('id');
			var lParam = {fonction:"autorisationSupprimer",id:lId};
			$.post(	"./index.php?m=GestionProduit&v=GestionCaracteristique", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							if(lResponse.autorisation) {
								that.dialogSupprimerCaracteristique(lId);
							} else {
								lResponse.id = lId;
								that.refusSupprimerCaracteristique(lResponse);
							}							
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		});
		return pData;
	}
	
	this.dialogSupprimerCaracteristique = function(pId) {
		var that = this;
		var lGestionProduitTemplate = new GestionProduitTemplate();
		var lTemplate = lGestionProduitTemplate.dialogSupprimerCaracteristique;
		var lData = this.mCaracteristiques[pId];
		$(lTemplate.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Supprimer': function() {
					that.supprimerCaracteristique(pId);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	}
	
	this.supprimerCaracteristique = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimer",id:pId};
		// Ajout
		$.post(	"./index.php?m=GestionProduit&v=GestionCaracteristique", "pParam=" + $.toJSON(lParam),
			function (lResponse) {		
				if(lResponse) {
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						
						$("#dialog-car").dialog('close');
						
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_328_CODE;
						erreur.message = ERR_328_MSG;
						lVr.log.erreurs.push(erreur);
						//Infobulle.generer(lVr,'');
						var lParam = {vr:lVr};					
						that.construct(lParam);
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	}
	
	this.refusSupprimerCaracteristique = function(pResponse) {
		var that = this;
		var lGestionProduitTemplate = new GestionProduitTemplate();
		var lTemplate = lGestionProduitTemplate.dialogRefusSupprimerCaracteristique;
		var lData = this.mCaracteristiques[pResponse.id];
		lData.nbProduit = pResponse.nbProduit;
		$(lTemplate.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter la liste des produits': function() {
					var lParam = {fonction:"exportProduitCaracteristique",id:pResponse.id};
					$.download("./index.php?m=GestionProduit&v=GestionCaracteristique", lParam);
				},
				'Fermer': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	}
	
	this.construct(pParam);
}