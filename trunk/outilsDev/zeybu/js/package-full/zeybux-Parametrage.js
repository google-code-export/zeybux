function ParametrageTemplate() {
	this.listeBanque = 
		"<div id=\"contenu\">" +			
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Banques" +
					"<span class=\"com-btn-header-text ui-widget-content ui-corner-all\" id=\"btn-nv-banque\" title=\"Ajouter une banque\">" +
						"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
						"</span>Ajouter" +
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
							"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom Court</th>" +
							"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
							"<th class=\"com-table-th-med com-underline-hover\"></th>" +
							"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN liste -->" +
						"<tr class=\"com-cursor-pointer\" id=\"{liste.id}\">" +
							"<td class=\"compte-ligne com-table-td-debut com-underline-hover\">{liste.nomCourt}</td>" +
							"<td class=\"compte-ligne com-table-td-med com-underline-hover\">{liste.nom}</td>" +
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
				"<!-- END liste -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeBanqueVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Banques" +
					"<span class=\"com-btn-header-text ui-widget-content ui-corner-all\" id=\"btn-nv-banque\" title=\"Ajouter une banque\">" +
						"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
						"</span>Ajouter" +
					"</span>" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune Banque dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutBanque =
		"<div id=\"dialog-form-banque\" title=\"Banque\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td>" +
							"<input type=\"hidden\" name=\"id\" id=\"banque-id\" value=\"{id}\"/>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" id=\"banque-nom\" value=\"{nom}\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
					"<td>Nom Court</td>" +
						"<td>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nomCourt\" id=\"banque-nomCourt\" value=\"{nomCourt}\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"banque-description\">{description}</textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";
	
	this.dialogSupprimerBanque =
		"<div id=\"dialog-banque\" title=\"Banque\">" +
			"<p>" +
				"Voulez-vous supprimer la banque : {nom}" +		
			"</p>" +
		"</div>";
	
	this.dialogDetailBanque = 
		"<div id=\"dialog-detail-banque\" title=\"Détail de la banque\">" +
			"<div>Nom : {nom}</div>" +
			"<div>Nom Court : {nomCourt}</div>" +
			"<div>Description : {description}</div>" +
		"</div>";
};function ListeBanqueVue(pParam) {
	this.mParam = {};
	this.mBanques = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeBanqueVue(pParam);}} );
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