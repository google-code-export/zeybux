;function ListeProducteurVue(pParam) {
	this.mIdFerme = null;
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeProducteurVue(pParam);}} );
		var that = this;
		pParam.fonction = "afficher";
		this.mIdFerme = pParam.id;
		$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(pParam),
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
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		
		if(lResponse.listeProducteur.length > 0 && lResponse.listeProducteur[0].prdtId != null) {
			var lTemplate = lGestionProducteurTemplate.listeProducteur;
			$.each(lResponse.listeProducteur,function() {
				this.prdtIdTri = this.prdtNumero.replace("P","");
			});
			$('#contenu-ferme').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu-ferme').replaceWith(that.affect($(lGestionProducteurTemplate.listeProducteurVide)));
		}
		this.affectMenu();
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		pData = this.affectDialogCreerProducteur(pData);
		pData = this.affectDialogModifierProducteur(pData);
		pData = this.affectDialogSuppProducteur(pData);
		pData = this.affectLienRetour(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
		
	this.affectMenu = function() {
		$('#btn-information,#btn-catalogue').removeClass("ui-state-active");
		$('#btn-liste-producteur').addClass("ui-state-active");		
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#btn-liste-ferme").click(function() { ListeFermeVue(); });
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]]});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	};
			
	this.affectLienCompte = function(pData) {
		//var that = this;
		pData.find('.compte-ligne')
		.click(function() {		
			
			var lId = $(this).attr("id-producteur");
			var lParam = {id:lId,fonction:"detailProducteur"};
			$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionProducteurTemplate = new GestionProducteurTemplate();
								var lTemplate = lGestionProducteurTemplate.dialogInfoCompteProducteur;
								

								lResponse.producteur.prdtDateNaissance = lResponse.producteur.prdtDateNaissance.extractDbDate().dateDbToFr();
								
								$(lTemplate.template(lResponse.producteur)).dialog({			
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
	
	this.affectDialogCreerProducteur = function(pData) {
		var that = this;
		pData.find('#btn-nv-prdt')
		.click(function() {			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogAjoutProducteur;
			$(lTemplate.template({})).dialog({			
				autoOpen: true,
				modal: true,
				draggable: true,
				resizable: false,
				width:600,
				buttons: {
					'Créer le producteur': function() {
						that.CreerProducteur($(this));
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProducteur($(this));
				return false;
			}).find('#prdt-dateNaissance').datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: "c+1",
				yearRange: "1900:c"});		
		});
		return pData;
	};
		
	this.CreerProducteur = function(pForm) {
		var that = this;
		var lVo = new ProducteurVO();
		
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		lVo.idFerme = this.mIdFerme;
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "ajouter";
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-prdt").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_323_CODE;
							erreur.message = ERR_323_MSG;
							lVr.log.erreurs.push(erreur);				
							that.construct({vr:lVr,id:that.mIdFerme});
						} else {
							Infobulle.generer(lResponse,'prdt-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'prdt-');
		}
	};
	
	this.affectDialogModifierProducteur = function(pData) {
		var that = this;
		pData.find('.btn-modifier')
		.click(function() {

			var lId = $(this).attr("id-producteur");
			var lParam = {id:lId,fonction:"detailProducteur"};
			$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionProducteurTemplate = new GestionProducteurTemplate();
								var lTemplate = lGestionProducteurTemplate.dialogAjoutProducteur;

								lResponse.producteur.prdtDateNaissance = lResponse.producteur.prdtDateNaissance.extractDbDate().dateDbToFr();
								
								$(lTemplate.template(lResponse.producteur)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:600,
									buttons: {
										'Modifier le producteur': function() {
											that.modifierProducteur($(this));
										},
										'Annuler': function() {
											$(this).dialog('close');
										}
									},
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								}).submit(function () {
									that.modifierProducteur($(this));
									return false;
								}).find('#prdt-dateNaissance').datepicker({
									changeMonth: true,
									changeYear: true,
									maxDate: "c+1",
									yearRange: "1900:c"});	
															
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		});
		return pData;
	};
		
	this.modifierProducteur = function(pForm) {
		var that = this;
		var lVo = new ProducteurVO();
		
		lVo.id = $(':input[name=id]').val();
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		lVo.idFerme = this.mIdFerme;
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "modifier";
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-prdt").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_324_CODE;
							erreur.message = ERR_324_MSG;
							lVr.log.erreurs.push(erreur);				
							that.construct({vr:lVr,id:that.mIdFerme});
						} else {
							Infobulle.generer(lResponse,'prdt-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'prdt-');
		}
	};
	
	this.affectDialogSuppProducteur = function(pData) {		
		var that = this;
		pData.find('.btn-supp')
		.click(function() {
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			
			var lId = $(this).attr("id-producteur");
			var lNumero = $(this).closest('tr').find(".numero-producteur").text();

			$(lGestionProducteurTemplate.dialogSuppressionProducteur.template({prdtNumero:lNumero})).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {id:lId,fonction:"supprimer"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											
											var lVr = new TemplateVR();
											lVr.valid = false;
											lVr.log.valid = false;
											var erreur = new VRerreur();
											erreur.code = ERR_325_CODE;
											erreur.message = ERR_325_MSG;
											lVr.log.erreurs.push(erreur);

											that.construct({vr:lVr,id:that.mIdFerme});
											
											$(lDialog).dialog('close');
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
				close: function(ev, ui) { $(this).remove(); }
			});
		});
		return pData;
	};
	
	this.construct(pParam);
}