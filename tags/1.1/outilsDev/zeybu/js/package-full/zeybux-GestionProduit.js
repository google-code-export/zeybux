;function GestionProduitTemplate() {
	this.listeCategorie = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +
			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les catégories de produit" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-cat\" title=\"Ajouter une catégorie\">" +
							"<span class=\"ui-icon ui-icon-plusthick\">" +
							"</span>" +
						"</span>" +	
					"</div>" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeCategorie -->" +
							"<tr class=\"com-cursor-pointer\" id=\"{listeCategorie.cproId}\">" +
								"<td class=\"compte-ligne com-table-td-debut com-underline-hover\">{listeCategorie.cproNom}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeCategorie -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeCategorieVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les catégories de produit" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-cat\" title=\"Ajouter une catégorie\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +	
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune catégorie dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutCategorie =
		"<div id=\"dialog-form-cat\" title=\"Catégorie\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td>" +
							"<input type=\"hidden\" name=\"id\" id=\"cat-id\" value=\"{cproId}\"/>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" id=\"cat-nom\" value=\"{cproNom}\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"cat-description\">{cproDescription}</textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";
	
	this.dialogSupprimerCategorie =
		"<div id=\"dialog-cat\" title=\"Catégorie\">" +
			"<p>" +
				"Voulez-vous supprimer la catégorie : {cproNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogRefusSupprimerCategorie =
		"<div id=\"dialog-cat\" title=\"Catégorie\">" +
			"<p>" +
				"Il existe {nbProduit} produits liés à cette catégorie. Vous devez les supprimer ou les changer de catégorie pour pouvoir supprimer la catégorie : {cproNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogInfoCategorie = 
		"<div id=\"dialog-info-cat\" title=\"Détail de la catégorie\">" +
			"<div>Nom : {cproNom}</div>" +
			"<div>Description : {cproDescription}</div>" +
		"</div>";
	
	this.listeCaracteristique = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +
			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les caractéristiques de produit" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-car\" title=\"Ajouter une caractéristique\">" +
							"<span class=\"ui-icon ui-icon-plusthick\">" +
							"</span>" +
						"</span>" +	
					"</div>" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
								"<th class=\"com-table-th-med com-underline-hover\"></th>" +
								"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN listeCaracteristique -->" +
							"<tr class=\"com-cursor-pointer\" id=\"{listeCaracteristique.carId}\">" +
								"<td class=\"compte-ligne com-table-td-debut com-underline-hover\">{listeCaracteristique.carNom}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
					"<!-- END listeCaracteristique -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeCaracteristiqueVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les caractéristiques de produit" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-car\" title=\"Ajouter une caractéristique\">" +
						"<span class=\"ui-icon ui-icon-plusthick\">" +
						"</span>" +
					"</span>" +	
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune caractéristique dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutCaracteristique =
		"<div id=\"dialog-form-car\" title=\"Caractéristique\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td>" +
							"<input type=\"hidden\" name=\"id\" id=\"car-id\" value=\"{carId}\"/>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" id=\"car-nom\" value=\"{carNom}\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"car-description\">{carDescription}</textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";
	
	this.dialogSupprimerCaracteristique =
		"<div id=\"dialog-car\" title=\"Caractéristique\">" +
			"<p>" +
				"Voulez-vous supprimer la caractéristique : {carNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogRefusSupprimerCaracteristique =
		"<div id=\"dialog-car\" title=\"Caractéristique\">" +
			"<p>" +
				"Il existe {nbProduit} produits liés à cette caractéristique. Vous devez les supprimer ou les changer de caractéristique pour pouvoir supprimer la caractéristique : {carNom}" +		
			"</p>" +
		"</div>";
	
	this.dialogInfoCaracteristique = 
		"<div id=\"dialog-info-car\" title=\"Détail de la caracréristique\">" +
			"<div>Nom : {carNom}</div>" +
			"<div>Description : {carDescription}</div>" +
		"</div>";
};function GestionCategorieVue(pParam) {
	this.mParam = {};
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
		pData = this.affectLienCompte(pData);
		pData = this.affectDialogCreerCategorie(pData);
		pData = this.affectDialogModifierCategorie(pData);
		pData = this.affectDialogSupprimerCategorie(pData);
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
			var lParam = {id:lId,fonction:"detailCategorie"};
			$.post(	"./index.php?m=GestionProduit&v=GestionCategorie", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionProduitTemplate = new GestionProduitTemplate();
								var lTemplate = lGestionProduitTemplate.dialogInfoCategorie;
								
								
								$(lTemplate.template(lResponse.categorie)).dialog({			
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
			//var lData = that.mCategories[$(this).closest('tr').attr('id')];
			
			var lId = $(this).closest('tr').attr('id');
			var lParam = {id:lId,fonction:"detailCategorie"};
			$.post(	"./index.php?m=GestionProduit&v=GestionCategorie", "pParam=" + $.toJSON(lParam),
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
};function GestionCaracteristiqueVue(pParam) {
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