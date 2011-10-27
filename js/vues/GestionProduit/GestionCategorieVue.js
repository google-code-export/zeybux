;function GestionCategorieVue(pParam) {
	this.mParam = {};
	this.mCommunVue = new CommunVue();
	this.mCategories = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {GestionCategorieVue(pParam);}} );
		var that = this;
		//pParam.fonction = "afficher";
		this.mParam = $.extend(this.mParam, pParam);
		this.mParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionProduit&v=GestionCategorie", "pParam=" + $.toJSON(this.mParam),
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
		
		$.each(lResponse.listeCategorie,function() {
			that.mCategories[this.cproId]=this;
		});

		var lGestionProduitTemplate = new GestionProduitTemplate();		
		if(lResponse.listeCategorie.length > 0 && lResponse.listeCategorie[0].cproId != null) {
			$('#contenu').replaceWith(that.affect($(lGestionProduitTemplate.listeCategorie.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionProduitTemplate.listeCategorieVide)));
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
	//	pData = this.affectLienCompte(pData);
		pData = this.affectDialogCreerCategorie(pData);
		pData = this.affectDialogModifierCategorie(pData);
		pData = this.affectDialogSupprimerCategorie(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		//pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
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
	
	this.affectDialogCreerCategorie = function(pData) {
		var that = this;
		pData.find('#btn-nv-cat')
		.click(function() {			
			var lGestionProduitTemplate = new GestionProduitTemplate();
			var lTemplate = lGestionProduitTemplate.dialogAjoutCategorie;
			
			$(lTemplate.template()).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer la categorie': function() {
						var lForm = $(this).children('form').first();
						that.CreerCategorie(lForm);
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
	
	this.CreerCategorie = function(pForm) {
		var that = this;
		var lVo = new CategorieProduitVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new CategorieProduitValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {fonction:"ajouter",categorieProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionProduit&v=GestionCategorie", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-cat").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_317_CODE;
							erreur.message = ERR_317_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							var lParam = {vr:lVr};					
							that.construct(lParam);
						} else {
							Infobulle.generer(lResponse,'cat-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'cat-');
		}
	}
	
	this.affectDialogModifierCategorie = function(pData) {
		var that = this;
		pData.find('.btn-edt-modifier')
		.click(function() {			
			var lGestionProduitTemplate = new GestionProduitTemplate();
			var lTemplate = lGestionProduitTemplate.dialogAjoutCategorie;
			//alert(that.mCategories[$(this).closest('tr').attr('id')]);
			var lData = that.mCategories[$(this).closest('tr').attr('id')];
			
			$(lTemplate.template(lData)).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Modifier la categorie': function() {
						var lForm = $(this).children('form').first();
						that.ModifierCategorie(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.ModifierCategorie($(this));
				return false;
			});			
		});		
		return pData;
	}
	
	this.ModifierCategorie = function(pForm) {
		var that = this;
		var lVo = new CategorieProduitVO();
		
		lVo.id = pForm.find(':input[name=id]').val();
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new CategorieProduitValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {fonction:"modifier",categorieProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionProduit&v=GestionCategorie", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-cat").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_318_CODE;
							erreur.message = ERR_318_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							var lParam = {vr:lVr};					
							that.construct(lParam);
						} else {
							Infobulle.generer(lResponse,'cat-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'cat-');
		}
	}
	
	this.affectDialogSupprimerCategorie = function(pData) {
		var that = this;
		pData.find('.btn-edt-supprimer')
		.click(function() {
			var lId = $(this).closest('tr').attr('id');
			var lParam = {fonction:"autorisationSupprimer",id:lId};
			$.post(	"./index.php?m=GestionProduit&v=GestionCategorie", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							if(lResponse.autorisation) {
								that.dialogSupprimerCategorie(lId);
							} else {
								lResponse.id = lId;
								that.refusSupprimerCategorie(lResponse);
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
	
	this.dialogSupprimerCategorie = function(pId) {
		var that = this;
		var lGestionProduitTemplate = new GestionProduitTemplate();
		var lTemplate = lGestionProduitTemplate.dialogSupprimerCategorie;
		var lData = this.mCategories[pId];
		$(lTemplate.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Supprimer la categorie': function() {
					that.supprimerCategorie(pId);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	}
	
	this.supprimerCategorie = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimer",id:pId};
		// Ajout
		$.post(	"./index.php?m=GestionProduit&v=GestionCategorie", "pParam=" + $.toJSON(lParam),
			function (lResponse) {		
				if(lResponse) {
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						
						$("#dialog-cat").dialog('close');
						
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_319_CODE;
						erreur.message = ERR_319_MSG;
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
	
	this.refusSupprimerCategorie = function(pResponse) {
		var that = this;
		var lGestionProduitTemplate = new GestionProduitTemplate();
		var lTemplate = lGestionProduitTemplate.dialogRefusSupprimerCategorie;
		var lData = this.mCategories[pResponse.id];
		lData.nbProduit = pResponse.nbProduit;
		$(lTemplate.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter la liste des produits': function() {
					var lParam = {fonction:"exportProduitCategorie",id:pResponse.id};
					$.download("./index.php?m=GestionProduit&v=GestionCategorie", lParam);
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