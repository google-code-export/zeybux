;function ParametreZeybuxVue(pParam) {
	this.mParam = {};
	this.mBanques = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ParametreZeybuxVue(pParam);}} );
		var that = this;
		this.mParam = $.extend(this.mParam, pParam);
		this.mParam.fonction = "liste";
		$.post(	"./index.php?m=Parametrage&v=Banque", "pParam=" + $.toJSON(this.mParam),
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
		
		$.each(lResponse.liste,function() {
			that.mBanques[this.id]=this;
		});

		var lParametrageTemplate = new ParametrageTemplate();		
		if(lResponse.liste.length > 0 && lResponse.liste[0].id != null) {
			$('#contenu').replaceWith(that.affect($(lParametrageTemplate.listeBanque.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lParametrageTemplate.listeBanqueVide)));
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectDetail(pData);
		pData = this.affectDialogAjout(pData);
		pData = this.affectDialogModifier(pData);
		pData = this.affectDialogSupprimer(pData);
		pData = gCommunVue.comHoverBtn(pData);
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
	
	this.affectDetail = function(pData) {
		pData.find('.compte-ligne')
		.click(function() {		
			var lId = $(this).closest('tr').attr('id');
			var lParam = {id:lId,fonction:"detail"};
			$.post(	"./index.php?m=Parametrage&v=Banque", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lParametrageTemplate = new ParametrageTemplate();
								var lTemplate = lParametrageTemplate.dialogDetailBanque;
								
								
								$(lTemplate.template(lResponse.detail)).dialog({			
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
	
	this.affectDialogAjout = function(pData) {
		var that = this;
		pData.find('#btn-nv-banque')
		.click(function() {			
			var lParametrageTemplate = new ParametrageTemplate();
			var lTemplate = lParametrageTemplate.dialogAjoutBanque;
			
			$(lTemplate.template()).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer la banque': function() {
						var lForm = $(this).children('form').first();
						that.ajoutBanque(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.ajoutBanque($(this));
				return false;
			});			
		});		
		return pData;
	};
	
	this.ajoutBanque = function(pForm) {
		var that = this;
		var lVo = new BanqueVO();
		
		lVo.nom = pForm.find(':input[name="nom"]').val();
		lVo.nomCourt = pForm.find(':input[name="nomCourt"]').val();
		lVo.description = pForm.find(':input[name="description"]').val();
		
		var lValid = new BanqueValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "ajouter";
			// Ajout
			$.post(	"./index.php?m=Parametrage&v=Banque", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-banque").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_358_CODE;
							erreur.message = ERR_358_MSG;
							lVr.log.erreurs.push(erreur);
							var lParam = {vr:lVr};					
							that.construct(lParam);
						} else {
							Infobulle.generer(lResponse,'banque-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'banque-');
		}
	};
	
	this.affectDialogModifier = function(pData) {
		var that = this;
		pData.find('.btn-edt-modifier')
		.click(function() {		
			var lParametrageTemplate = new ParametrageTemplate();
			var lTemplate = lParametrageTemplate.dialogAjoutBanque;
			
			var lId = $(this).closest('tr').attr('id');
			var lParam = {id:lId,fonction:"detail"};
			$.post(	"./index.php?m=Parametrage&v=Banque", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {								
								$(lTemplate.template(lResponse.detail)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: false,
									resizable: false,
									width:400,
									buttons: {
										'Modifier la banque': function() {
											var lForm = $(this).children('form').first();
											that.modifierBanque(lForm);
										},
										'Annuler': function() {
											$(this).dialog('close');
										}
									},
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								}).submit(function () {
									that.modifierBanque($(this));
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
	
	this.modifierBanque = function(pForm) {
		var that = this;
		var lVo = new BanqueVO();
		
		lVo.id = pForm.find(':input[name="id"]').val();
		lVo.nom = pForm.find(':input[name="nom"]').val();
		lVo.nomCourt = pForm.find(':input[name="nomCourt"]').val();
		lVo.description = pForm.find(':input[name="description"]').val();
		
		var lValid = new BanqueValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "modifier";
			// Modification
			$.post(	"./index.php?m=Parametrage&v=Banque", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-banque").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_359_CODE;
							erreur.message = ERR_359_MSG;
							lVr.log.erreurs.push(erreur);
							var lParam = {vr:lVr};					
							that.construct(lParam);
						} else {
							Infobulle.generer(lResponse,'banque-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'banque-');
		}
	};
	
	this.affectDialogSupprimer = function(pData) {
		var that = this;
		pData.find('.btn-edt-supprimer')
		.click(function() {
			var lId = $(this).closest('tr').attr('id');
			var lParametrageTemplate = new ParametrageTemplate();
			var lTemplate = lParametrageTemplate.dialogSupprimerBanque;
			var lData = that.mBanques[lId];
			
			$(lTemplate.template(lData)).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer la banque': function() {
						that.supprimerBanque(lId);
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
		
	this.supprimerBanque = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimer", id:pId};
		// Suppression
		$.post(	"./index.php?m=Parametrage&v=Banque", "pParam=" + $.toJSON(lParam),
			function (lResponse) {		
				if(lResponse) {
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						
						$("#dialog-banque").dialog('close');
						
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_360_CODE;
						erreur.message = ERR_360_MSG;
						lVr.log.erreurs.push(erreur);
						var lParam = {vr:lVr};					
						that.construct(lParam);
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
		
	this.construct(pParam);
}