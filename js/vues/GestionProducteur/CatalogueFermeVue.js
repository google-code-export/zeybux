;function CatalogueFermeVue(pParam) {
	this.mParam = {};
	this.mCategories = [];
	this.mProduits = [];
	this.mFiltreIdCategorie = 0;
	this.nbProduit = 0;
	this.nbCategorie = 0;
	this.mListeCategorie = {};
	this.mListeProduit = [];
	this.mInfoFormulaireProduit = null;
	this.mIdLot = 0;
	this.mIdFerme = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CatalogueFermeVue(pParam);}} );
		var that = this;
		//pParam.fonction = "afficher";
		this.mParam = $.extend(this.mParam, pParam);
		this.mParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(this.mParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mCategories = [];
						that.mProduits = [];
						that.mFiltreIdCategorie = 0;
						that.nbProduit = 0;
						that.nbCategorie = 0;
						that.mListeCategorie = {};
						that.mListeProduit = [];
						that.mInfoFormulaireProduit = null;
						that.mIdLot = 0;
						that.mIdFerme = pParam.id;
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
		this.mListeCategorie = lResponse.listeCategorie;
		
		$.each(lResponse.listeProduit,function() {
			if(that.mProduits[this.cproId]) {
				that.mProduits[this.cproId].produits.push(this);
			} else {
				that.mProduits[this.cproId] = {nom:this.cproNom,produits:[this]};
			}
			if(that.mListeProduit[this.cproNom]) {
				that.mListeProduit[this.cproNom].produits.push(this);
			} else {
				that.mListeProduit[this.cproNom] = {nom:this.cproNom,produits:[this]};
			}
		});
		var lListeProduitVide = true;
		if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].nproId != null) {
			lResponse.listeProduit = that.mListeProduit;
			lListeProduitVide = false;
		}
		
		$.each(lResponse.listeCategorie,function() {
			that.mCategories[this.cproId]=this;
		});
		
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lhtml = $(lGestionProducteurTemplate.catalogue.template(lResponse) );
		
		if(lListeProduitVide) {
			lhtml.find("#table-pro").replaceWith(lGestionProducteurTemplate.listeProduitCatalogueVide);
			this.nbProduit = 0;
		} else {
			this.nbProduit = 1;
		}
		
		if(lResponse.listeCategorie.length > 0 && lResponse.listeCategorie[0].cproId == null) {
			lhtml.find("#table-cat").replaceWith(lGestionProducteurTemplate.listeCategorieVide);
			this.nbCategorie = 0;
		} else {
			this.nbCategorie = 1;
		}
		lhtml = this.affectCategorie(lhtml);
		
		$('#contenu-ferme').replaceWith(that.affect(lhtml));
		this.affectMenu();
	};
	
	this.affect = function(pData) {
		pData = this.affectRecherche(pData);
		pData = affectProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectProduit = function(pData) {
		pData = this.affectDialogCreerProduit(pData);
		pData = this.affectModifierProduit(pData);
		pData = this.affectDialogSupprimerProduit(pData);
		pData = this.affectDetailProduit(pData);
		return pData;	
	};
	
	this.affectCategorie = function(pData) {
		if(this.nbProduit > 0) { pData = this.affectFlitreCategorie(pData);	}
		pData = this.affectTri(pData);
		pData = this.affectRechercheCategorie(pData);
		pData = this.affectDialogCreerCategorie(pData);
		pData = this.affectDialogModifierCategorie(pData);
		pData = this.affectDialogSupprimerCategorie(pData);	
		return pData;
	};
		
	this.affectMenu = function() {
		$('#btn-information,#btn-liste-producteur').removeClass("ui-state-active");
		$('#btn-catalogue').addClass("ui-state-active");		
	};
	
	this.affectTri = function(pData) {
		//pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		pData.find('#table-cat').tablesorter({sortList: [[0,0]]});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter-pro").keyup(function() {
		    $.uiTableFilter( $('#table-pro'), this.value );
		  });
		
		pData.find("#filter-form-pro").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectRechercheCategorie = function(pData) {		
		pData.find("#filter-cat").keyup(function() {
		    $.uiTableFilter( $('#table-cat'), this.value );
		  });
		
		pData.find("#filter-form-cat").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectFlitreCategorie = function(pData) {
		var that = this;
		pData.find(".ligne-cat").click(function() {
			var lIdCategorie = $(this).closest('tr').attr("id-cat");
			that.FiltreCategorie(lIdCategorie);
		});
		return pData;
	};
	
	this.FiltreCategorie = function(pIdCategorie) {
		if(this.nbProduit > 0) {
			if(this.mProduits[pIdCategorie]) {
				var lData = {listeProduit:[]};
				lData.listeProduit.push(this.mProduits[pIdCategorie]);	
				var lGestionProducteurTemplate = new GestionProducteurTemplate();	
				$('#table-pro').replaceWith(this.affect($(lGestionProducteurTemplate.listeProduitCatalogue.template(lData))));	
			} else if(pIdCategorie == 0) { // Toutes les catégories.
				var lData = {listeProduit:this.mListeProduit};
				var lGestionProducteurTemplate = new GestionProducteurTemplate();	
				$('#table-pro').replaceWith(this.affect($(lGestionProducteurTemplate.listeToutProduitCatalogue.template(lData))));	
			} else { // Pas de produit dans la catégorie
				var lGestionProducteurTemplate = new GestionProducteurTemplate();	
				var lData = this.mCategories[pIdCategorie];
				$('#table-pro').replaceWith(lGestionProducteurTemplate.listeProduitCategorieCatalogueVide.template(lData));	
			}
			$(".ligne-cat").closest('tr').removeClass("ui-state-hover");
			$("[id-cat=" + pIdCategorie + "]").closest('tr').addClass("ui-state-hover");
			
			this.mFiltreIdCategorie = pIdCategorie;
		}
	};

	this.refreshCategorie = function(pParam) {
		var that = this;
		pParam.fonction = "listeCategorie";
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mListeCategorie = lResponse.listeCategorie;
							
							that.mCategories = [];
							var lCategorieExiste = false;
							$.each(lResponse.listeCategorie,function() {
								that.mCategories[this.cproId]=this;
								if(this.cproId == that.mFiltreIdCategorie) {lCategorieExiste = true;}
							});

							var lGestionProducteurTemplate = new GestionProducteurTemplate();
							if(lResponse.listeCategorie.length > 0 && lResponse.listeCategorie[0].cproId == null) {
								$("#table-cat").replaceWith(lGestionProducteurTemplate.listeCategorieVide);
								that.nbCategorie = 0;
							} else {
								$("#div-table-cat").replaceWith(that.affectCategorie($(lGestionProducteurTemplate.listeCategorie.template(lResponse))));
								that.nbCategorie = 1;
							}
							
							if(that.nbProduit > 0) {
								if(lCategorieExiste) {
									that.FiltreCategorie(that.mFiltreIdCategorie);
								} else {
									that.FiltreCategorie(0);
								}
							}
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.refreshProduit = function(pParam) {
		var that = this;
		pParam.fonction = "listeProduit";
		pParam.id = this.mParam.id;
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							
							that.mProduits = [];
							that.mListeProduit = [];
							$.each(lResponse.listeProduit,function() {
								if(that.mProduits[this.cproId]) {
									that.mProduits[this.cproId].produits.push(this);
								} else {
									that.mProduits[this.cproId] = {nom:this.cproNom,produits:[this]};
								}
								if(that.mListeProduit[this.cproNom]) {
									that.mListeProduit[this.cproNom].produits.push(this);
								} else {
									that.mListeProduit[this.cproNom] = {nom:this.cproNom,produits:[this]};
								}
							});


							var lGestionProducteurTemplate = new GestionProducteurTemplate();
							if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].nproId != null) {
								lResponse.listeProduit = that.mProduits;
								that.nbProduit = 1;
								that.FiltreCategorie(that.mFiltreIdCategorie);
							} else {
								$("#table-pro").replaceWith(lGestionProducteurTemplate.listeProduitCatalogueVide);
								that.nbProduit = 0;
							}
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.affectDialogCreerCategorie = function(pData) {
		var that = this;
		pData.find('#btn-nv-cat')
		.click(function() {			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogAjoutCategorie;
			
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
	};
	
	this.CreerCategorie = function(pForm) {
		var that = this;
		var lVo = new CategorieProduitVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new CategorieProduitValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {fonction:"ajouterCategorie",categorieProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
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
							that.refreshCategorie(lParam);
						} else {
							Infobulle.generer(lResponse,'cat-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'cat-');
		}
	};
	
	this.affectDialogModifierCategorie = function(pData) {
		var that = this;
		pData.find('.btn-modifier-cat')
		.click(function() {			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();	
			var lTemplate = lGestionProducteurTemplate.dialogAjoutCategorie;
			//var lData = that.mCategories[$(this).closest('tr').attr('id-cat')];
			
			var lId = $(this).closest('tr').attr('id-cat');
			var lParam = {id:lId,fonction:"detailCategorie"};
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {								
								$(lTemplate.template(lResponse.categorie)).dialog({			
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
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);	
		});		
		return pData;
	};
	
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
			var lParam = {fonction:"modifierCategorie",categorieProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
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
							//var lParam = {vr:lVr};					
							//that.refreshCategorie(lParam);
							that.construct({id:that.mIdFerme,vr:lVr});						
							
						} else {
							Infobulle.generer(lResponse,'cat-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'cat-');
		}
	};
	
	this.affectDialogSupprimerCategorie = function(pData) {
		var that = this;
		pData.find('.btn-supprimer-cat')
		.click(function() {
			var lId = $(this).closest('tr').attr('id-cat');
			var lParam = {fonction:"autorisationSupprimerCategorie",id:lId};
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
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
	};
	
	this.dialogSupprimerCategorie = function(pId) {
		var that = this;
		var lGestionProducteurTemplate = new GestionProducteurTemplate();	
		var lTemplate = lGestionProducteurTemplate.dialogSupprimerCategorie;
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
	};
	
	this.supprimerCategorie = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimerCategorie",id:pId};
		// Ajout
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
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
						that.refreshCategorie(lParam);
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.refusSupprimerCategorie = function(pResponse) {
		//var that = this;
		var lGestionProducteurTemplate = new GestionProducteurTemplate();	
		var lTemplate = lGestionProducteurTemplate.dialogRefusSupprimerCategorie;
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
					$.download("./index.php?m=GestionProducteur&v=CatalogueFerme", lParam);
				},
				'Fermer': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.affectDialogCreerProduit = function(pData) {
		var that = this;
		pData.find('#btn-nv-pro')
		.click(function() {			
			if(that.nbCategorie == 0) {
				that.dialogProduitRefusCreation();
			} else {
				if(that.mInfoFormulaireProduit == null) {
					lParam = {fonction:'infoFomulaireProduit',id:that.mParam.id};
					$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
						function (lResponse) {		
							if(lResponse) {
								if(lResponse.valid) {
									that.mInfoFormulaireProduit = {
										listeProducteur:lResponse.listeProducteur,
										listeCaracteristique:lResponse.listeCaracteristique,
										sigleMonetaire:gSigleMonetaire
									};
									that.dialogProduit();
								} else {
									Infobulle.generer(lResponse,'pro-');
								}
							}
						},"json"
					);
				} else {
					that.dialogProduit();
				}
			}
		});		
		return pData;
	};
	
	this.dialogProduit = function() {
		var that = this;
		if(this.mInfoFormulaireProduit != null) {
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogAjoutProduit;
			
			this.mInfoFormulaireProduit.listeCategorie = this.mListeCategorie;
			this.mInfoFormulaireProduit.form_reference = lGestionProducteurTemplate.ajoutProduitReference;
			var lhtml = $(lTemplate.template(this.mInfoFormulaireProduit));
			
			if(this.mInfoFormulaireProduit.listeProducteur.length > 0 && this.mInfoFormulaireProduit.listeProducteur[0].prdtId == null) {
				lhtml.find("#pro-producteur").replaceWith(lGestionProducteurTemplate.produitListeProducteurVide);
			}
			if(this.mInfoFormulaireProduit.listeCaracteristique.length > 0 && this.mInfoFormulaireProduit.listeCaracteristique[0].carId == null) {
				lhtml.find("#pro-caracteristique").replaceWith(lGestionProducteurTemplate.listeCaracteristiqueVide);
			}
			
			lhtml = this.affectFormProduit(lhtml);
			
			$(lhtml).dialog({			
				autoOpen: true,
				modal: true,
				draggable: true,
				resizable: false,
				width:600,
				buttons: {
					'Créer': function() {
						var lForm = $(this).children('form').first();
						that.CreerProduit(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProduit($(this));
				return false;
			});
		}
	};
	
	this.affectFormProduit = function(pData) {
		pData = this.affectAjoutLot(pData);
		pData = this.affectReference(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectReference = function(pData) {
		pData.find(':input[name=reference-choix]').change(function() {
			if($(':input[name=reference-choix]:checked').val() == 1) {				
				$(":input[name=reference]").attr("disabled","").val("");
			} else {
				$(":input[name=reference]").attr("disabled","disabled").val("");
			}
		});
		return pData;
	};
	
	this.affectAjoutLot = function(pData) {
		var that = this;
		pData.find('#btn-ajout-lot').click(function() {that.ajoutLot();});
		pData.find('#table-pro-prix input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLot();
			}
		});		
		return pData;		
	};
	
	this.ajoutLot = function() {
		var lVo = new ModeleLotVO();
		lVo.quantite = $(":input[name=lot-quantite]").val().numberFrToDb();
		lVo.unite = $(":input[name=lot-unite]").val();
		lVo.prix = $(":input[name=lot-prix]").val().numberFrToDb();

		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.modeleLot;
			
			this.mIdLot--;
			lVo.id = this.mIdLot;
			lVo.sigleMonetaire = gSigleMonetaire;
			lVo.quantite = lVo.quantite.nombreFormate(2,',',' ');
			lVo.prix = lVo.prix.nombreFormate(2,',',' ');		
			$("#lot-liste").append(this.affectLot($(lTemplate.template(lVo))));
			
			$(":input[name=lot-quantite], :input[name=lot-unite], :input[name=lot-prix]").val("");
		} else {
			Infobulle.generer(lVr,'pro-lot-');
		}
	};
	
	this.affectLot = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectAjoutLotGestion(pData);
		return pData;
	};
	
	
	this.affectAjoutLotGestion = function(pData) {
		var that = this;
		pData.find(".btn-modifier-lot").click(function() {
			that.ajoutLotModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(".btn-valider-lot").click(function() {
			that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find('.catalogue-input-lot').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
			}
		});	
		pData.find(".btn-annuler-lot").click(function() {
			that.ajoutLotAnnulerModification($(this).closest('tr').find('#id-lot').text());
		});	
		pData.find(".btn-supprimer-lot").click(function() {
			that.ajoutLotSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		return pData;		
	};
	
	this.ajoutLotSupprimer = function(pId) {
		$("#ligne-lot-" + pId).remove();
	};
	
	this.ajoutLotModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();

		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text());
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text());
	};
	
	this.ajoutLotValiderModification = function(pId) {
		var lVo = new ModeleLotVO();
		lVo.quantite = $("#pro-lot-" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-" + pId + "-prix").val().numberFrToDb();
	
		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
		
			$("#lot-" + pId + "-quantite").text(lVo.quantite.nombreFormate(2,',',' '));
			$("#lot-" + pId + "-unite").text(lVo.unite);
			$("#lot-" + pId + "-prix").text(lVo.prix.nombreFormate(2,',',' '));
			$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		} else {
			Infobulle.generer(lVr,'pro-lot-' + pId + '-');
		}
	};
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
	};
	
	this.dialogProduitRefusCreation = function() {
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lTemplate = lGestionProducteurTemplate.dialogRefusAjoutProduit;
		
		$(lTemplate).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.CreerProduit = function(pForm) {
		var that = this;
		var lVo = new NomProduitCatalogueVO();
		lVo.numero = pForm.find(':input[name=reference]').val();
		lVo.idCategorie = pForm.find(':input[name=categorie]').val();
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		pForm.find(':input[name=producteur]:checked').each(function() {
			lVo.producteurs.push($(this).val());
		});
		pForm.find(':input[name=caracteristique]:checked').each(function() {
			lVo.caracteristiques.push($(this).val());
		});		
		pForm.find('.ligne-lot').each(function() {
			var lModeleLotVO = new ModeleLotVO();			
			lModeleLotVO.quantite = $(this).find('.lot-quantite').text().numberFrToDb();
			lModeleLotVO.unite = $(this).find('.lot-unite').text();
			lModeleLotVO.prix = $(this).find('.lot-prix').text().numberFrToDb();
			
			lVo.modelesLot.push(lModeleLotVO);
		});
		
		
		var lValid = new NomProduitCatalogueValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "ajouterProduit";
			lVo.id = this.mParam.id;
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-pro").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_329_CODE;
							erreur.message = ERR_329_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							var lParam = {vr:lVr};					
							that.refreshProduit(lParam);
						} else {
							Infobulle.generer(lResponse,'pro-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'pro-');
		}
	};
	
	this.affectDialogSupprimerProduit = function(pData) {
		var that = this;
		pData.find('.btn-supprimer-produit')
		.click(function() {
			var lId = $(this).closest('tr').attr('id-pro');
			var lData = {nom:$(this).closest('tr').find('.liste-produit-nom').text()};
			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();	
			var lTemplate = lGestionProducteurTemplate.dialogSupprimerProduit;
			
			$(lTemplate.template(lData)).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						that.supprimerProduit(lId);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			});
		});
		return pData;
	};
	
	this.supprimerProduit = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimerProduit",idNomProduit:pId};
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
			function (lResponse) {		
				if(lResponse) {
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						$("#dialog-pro").dialog('close');
						
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_331_CODE;
						erreur.message = ERR_331_MSG;
						lVr.log.erreurs.push(erreur);				
						that.refreshProduit({vr:lVr});
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.affectDetailProduit = function(pData) {
		//var that = this;
		pData.find('.liste-produit-nom')
		.click(function() {		
			var lId = $(this).closest('tr').attr('id-pro');
			var lParam = {idNomProduit:lId,fonction:"detailProduit"};
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionProducteurTemplate = new GestionProducteurTemplate();	
								var lTemplate = lGestionProducteurTemplate.dialogInfoProduit;
								
								$(lResponse.produit.modelesLot).each(function() {
									if(this.mLotId != null) {
										this.mLotQuantite = this.mLotQuantite.nombreFormate(2,',',' ');
										this.mLotPrix = this.mLotPrix.nombreFormate(2,',',' ');
									}
								});

								lResponse.produit.sigleMonetaire = gSigleMonetaire;
								
								var lHtml = $(lTemplate.template(lResponse.produit));
								
								if(lResponse.produit.producteurs.length > 0 && lResponse.produit.producteurs[0].nPrdtIdNomProduit == null) {
									lHtml.find('#pro-prdt').remove();
								}
								if(lResponse.produit.caracteristiques.length > 0 && lResponse.produit.caracteristiques[0].carProIdNomProduit == null) {
									lHtml.find('#pro-car').remove();
								}
								if(lResponse.produit.modelesLot.length > 0 && lResponse.produit.modelesLot[0].mLotId == null) {
									lHtml.find('#pro-prix').remove();
								}
								
								$(lHtml).dialog({			
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
	};
	
	this.affectModifierProduit = function(pData) {
		var that = this;
		pData.find('.btn-modifier-produit')
		.click(function() {		
			var lId = $(this).closest('tr').attr('id-pro');
			that.dialogModifierProduit(lId);			
		});
		return pData;
	};
	
	this.dialogModifierProduit = function(pId) {
		var that = this;
		var lParam = {idNomProduit:pId,fonction:"infoFomulaireModifierProduit"};
		$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {

							var lInfoFormulaireProduit = {
									listeProducteur:lResponse.listeProducteur,
									listeCaracteristique:lResponse.listeCaracteristique,
									sigleMonetaire:gSigleMonetaire,
									idNomProduit:lResponse.produit.idNomProduit,
									nom:lResponse.produit.nom,
									numero:lResponse.produit.numero,
									description:lResponse.produit.description
								};
							
							var lGestionProducteurTemplate = new GestionProducteurTemplate();
							var lTemplate = lGestionProducteurTemplate.dialogAjoutProduit;
							
							lInfoFormulaireProduit.listeCategorie = that.mListeCategorie;
							lInfoFormulaireProduit.form_reference = lGestionProducteurTemplate.modifProduitReference.template(lInfoFormulaireProduit);
							var lhtml = $(lTemplate.template(lInfoFormulaireProduit));
							
							if(lInfoFormulaireProduit.listeProducteur.length > 0 && lInfoFormulaireProduit.listeProducteur[0].prdtId == null) {
								lhtml.find("#pro-producteur").replaceWith(lGestionProducteurTemplate.produitListeProducteurVide);
							}
							if(lInfoFormulaireProduit.listeCaracteristique.length > 0 && lInfoFormulaireProduit.listeCaracteristique[0].carId == null) {
								lhtml.find("#pro-caracteristique").replaceWith(lGestionProducteurTemplate.listeCaracteristiqueVide);
							}
							
							lhtml.find('#pro-idCategorie').selectOptions(lResponse.produit.idCategorie);
							
							$(lResponse.produit.producteurs).each(function() {
								lhtml.find('#pro-prdt-' + this.prdtId).attr("checked","checked");
							});
							
							$(lResponse.produit.caracteristiques).each(function() {
								lhtml.find('#pro-car-' + this.carId).attr("checked","checked");
							});
							
							$(lResponse.produit.modelesLot).each(function() {
								if(this.mLotId != null) {
									this.id = this.mLotId;
									this.quantite = this.mLotQuantite.nombreFormate(2,',',' ');
									this.unite = this.mLotUnite;
									this.prix = this.mLotPrix.nombreFormate(2,',',' ');
									this.sigleMonetaire = gSigleMonetaire;
									lhtml.find("#lot-liste").append(that.affectLot($(lGestionProducteurTemplate.modeleLot.template(this))));
								}
							});
														
							lhtml = that.affectFormProduit(lhtml);
							
							$(lhtml).dialog({			
								autoOpen: true,
								modal: true,
								draggable: true,
								resizable: false,
								width:600,
								buttons: {
									'Modifier': function() {
										var lForm = $(this).children('form').first();
										that.modifierProduit(lForm);
									},
									'Annuler': function() {
										$(this).dialog('close');
									}
								},
								close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
							}).submit(function () {
								that.modifierProduit($(this));
								return false;
							});				
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.modifierProduit = function(pForm) {
		var that = this;
		var lVo = new NomProduitCatalogueVO();
		lVo.numero = pForm.find(':input[name=reference]').val();
		lVo.idNomProduit = pForm.find(':input[name=id]').val();
		lVo.idCategorie = pForm.find(':input[name=categorie]').val();
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		pForm.find(':input[name=producteur]:checked').each(function() {
			lVo.producteurs.push($(this).val());
		});
		pForm.find(':input[name=caracteristique]:checked').each(function() {
			lVo.caracteristiques.push($(this).val());
		});		
		pForm.find('.ligne-lot').each(function() {
			var lModeleLotVO = new ModeleLotVO();	
			var lId = $(this).find('.lot-id').text();
			if(lId > 0) { // Uniquement si ce n'est pas un nouveau lot
				lModeleLotVO.id = lId;
			}
			lModeleLotVO.quantite = $(this).find('.lot-quantite').text().numberFrToDb();
			lModeleLotVO.unite = $(this).find('.lot-unite').text();
			lModeleLotVO.prix = $(this).find('.lot-prix').text().numberFrToDb();
			
			lVo.modelesLot.push(lModeleLotVO);
		});
		
		
		var lValid = new NomProduitCatalogueValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "modifierProduit";
			lVo.id = this.mParam.id;
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=CatalogueFerme", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-pro").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_330_CODE;
							erreur.message = ERR_330_MSG;
							lVr.log.erreurs.push(erreur);
							var lParam = {vr:lVr};					
							that.refreshProduit(lParam);
						} else {
							Infobulle.generer(lResponse,'pro-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'pro-');
		}
	};
	
	this.construct(pParam);
}