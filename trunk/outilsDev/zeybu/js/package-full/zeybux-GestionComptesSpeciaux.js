;function GestionComptesSpeciauxTemplate() {
	this.listeComptes = 
		"<div id=\"contenu\" class=\"ui-helper-reset\">" +
			"<div id=\"liste-compte\">" +
				"<ul>" +
					"<li><a href=\"#liste-administrateur\">Comptes Administrateur</a></li>" +
					"<li><a href=\"#liste-caisse\">Comptes Caisse</a></li>" +
					"<li><a href=\"#liste-solidaire\">Comptes Solidaire</a></li>" +
				"</ul>" +
				"<div id=\"liste-administrateur\">" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-administrateur\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-administrateur\" id=\"filter-administrateur\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-administrateur\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th colspan=\"3\" class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Login</th>" +
								"<th class=\"com-table-th-fin\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-administrateur\" title=\"Ajouter un compte administrateur\">" +
										"<span class=\"ui-icon ui-icon-plusthick\">" +
									"</span>" +
								"</th>" +
							"</span>" +	
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN administrateur -->" +
							"<tr class=\"compte-ligne-administrateur\" >" +
								"<td class=\"com-table-td-debut\">{administrateur.login}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\" id-compte=\"{administrateur.id}\" login=\"{administrateur.login}\" type-compte=\"0\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass\" title=\"Modifier le mot de passe\" id-compte=\"{administrateur.id}\" type-compte=\"0\">" +
										"<span class=\"ui-icon ui-icon-key\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\" id-compte=\"{administrateur.id}\" login=\"{administrateur.login}\" type-compte=\"0\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END administrateur -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +	
				"<div id=\"liste-caisse\">" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-caisse\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-caisse\" id=\"filter-caisse\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-caisse\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th colspan=\"3\" class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Login</th>" +
								"<th class=\"com-table-th-fin\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-caisse\" title=\"Ajouter un compte caisse\">" +
										"<span class=\"ui-icon ui-icon-plusthick\">" +
									"</span>" +
								"</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN caisse -->" +
							"<tr class=\"compte-ligne-caisse\" >" +
								"<td class=\"com-table-td-debut\">{caisse.login}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\" id-compte=\"{caisse.id}\" login=\"{caisse.login}\" type-compte=\"1\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass\" title=\"Modifier le mot de passe\" id-compte=\"{caisse.id}\" type-compte=\"1\">" +
										"<span class=\"ui-icon ui-icon-key\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\" id-compte=\"{caisse.id}\" login=\"{caisse.login}\" type-compte=\"1\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END caisse -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
				"<div id=\"liste-solidaire\">" +
					"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form-solidaire\">" +
							"<div>" +
								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right filter\" name=\"filter-solidaire\" id=\"filter-solidaire\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
							"</div>" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table table-solidaire\">" +
						"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th colspan=\"3\" class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Login</th>" +
								"<th class=\"com-table-th-fin\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-nv-solidaire\" title=\"Ajouter un compte solidaire\">" +
										"<span class=\"ui-icon ui-icon-plusthick\">" +
									"</span>" +
								"</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN solidaire -->" +
							"<tr class=\"compte-ligne-solidaire\" >" +
								"<td class=\"com-table-td-debut\">{solidaire.login}</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\" id-compte=\"{solidaire.id}\" login=\"{solidaire.login}\" type-compte=\"2\">" +
										"<span class=\"ui-icon ui-icon-pencil\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass\" title=\"Modifier le mot de passe\" id-compte=\"{solidaire.id}\" type-compte=\"2\">" +
										"<span class=\"ui-icon ui-icon-key\"></span>" +
									"</span>" +
								"</td>" +
								"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
									"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\" id-compte=\"{solidaire.id}\" login=\"{solidaire.login}\" type-compte=\"2\">" +
										"<span class=\"ui-icon ui-icon-trash\"></span>" +
									"</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END solidaire -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdministrateurVide =
		"<div id=\"liste-administrateur\">" +
			"<p id=\"texte-liste-vide\">" +
				"<button class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\" id=\"btn-nv-administrateur\">Ajouter un compte administrateur</button>" +
			"</p>" +
		"</div>";
	
	this.listeCaisseVide =
		"<div id=\"liste-caisse\">" +
			"<p id=\"texte-liste-vide\">" +
				"<button class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\" id=\"btn-nv-caisse\">Ajouter un compte caisse</button>" +
			"</p>" +
		"</div>";
	
	this.listeSolidaireVide =
		"<div id=\"liste-solidaire\">" +
			"<p id=\"texte-liste-vide\">" +
				"<button class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\" id=\"btn-nv-solidaire\">Ajouter un compte solidaire</button>" +
			"</p>" +
		"</div>";
	
	this.dialogAjoutCompte =
		"<div id=\"dialog-ajout-compte\" title=\"Ajouter un compte {typeCompte}\" class=\"formulaire_identification\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Login *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"input_formulaire_identification com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"login\" maxlength=\"20\" id=\"login\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Confirmer *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogUpdate =
		"<div id=\"dialog-modif-compte\" title=\"Modifier un compte\" class=\"formulaire_identification\">" +
			//"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Login *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"input_formulaire_identification com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"login\" maxlength=\"20\" id=\"login\" value=\"{login}\" /></td>" +
					"</tr>" +
				"</table>" +
			//"</form>" +
		"</div>";
	
	this.dialogUpdatePass =
		"<div id=\"dialog-modif-compte\" title=\"Modifier le mot de passe\" class=\"formulaire_identification\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nouveau mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Confirmer *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\" /></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.dialogDelete =
		"<div id=\"dialog-sup-compte\" title=\"Supprimer un compte\" class=\"formulaire_identification\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer le compte : {login}</p>" +
		"</div>";
};function ListeComptesSpeciauxVue(pParam) {	
	this.tabSelected = 0;	
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeComptesSpeciauxVue(pParam);}} );
		var that = this;
		if(pParam && pParam.tabSelected) {
			this.tabSelected = pParam.tabSelected;
		} else {
			this.tabSelected = 0;	
		}
		$.post(	"./index.php?m=GestionComptesSpeciaux&v=ListeCompte",
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
		var lGestionComptesSpeciauxTemplate = new GestionComptesSpeciauxTemplate();
		var lTemplate = lGestionComptesSpeciauxTemplate.listeComptes;	
		var lHtml = $(lTemplate.template(lResponse));
		
		if(lResponse.administrateur.length <= 0 || lResponse.administrateur[0].id == null) {
			lHtml.find("#liste-administrateur").replaceWith(lGestionComptesSpeciauxTemplate.listeAdministrateurVide);
		}
		if(lResponse.caisse.length <= 0 || lResponse.caisse[0].id == null) {
			lHtml.find("#liste-caisse").replaceWith(lGestionComptesSpeciauxTemplate.listeCaisseVide);
		}
		if(lResponse.solidaire.length <= 0 || lResponse.solidaire[0].id == null) {
			lHtml.find("#liste-solidaire").replaceWith(lGestionComptesSpeciauxTemplate.listeSolidaireVide);
		}
		
		$('#contenu').replaceWith(that.affect(lHtml));
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectTabs(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectAjoutCompte(pData);
		pData = this.affectUpdateCompte(pData);
		pData = this.affectUpdatePassCompte(pData);
		pData = this.affectDeleteCompte(pData);
		return pData;
	}
	
	this.affectTabs = function(pData) {
		var that = this;
		pData.find( "#liste-compte" ).tabs({ selected: that.tabSelected });
		return pData;
	}

	this.affectTri = function(pData) {
		pData.find('.table-administrateur').tablesorter({sortList: [[0,0]],headers: {1: {sorter: false} }});
		pData.find('.table-caisse').tablesorter({sortList: [[0,0]],headers: { 1: {sorter: false} }});
		pData.find('.table-solidaire').tablesorter({sortList: [[0,0]],headers: { 1: {sorter: false} }});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter-administrateur").keyup(function() {
			$.uiTableFilter( $('.table-administrateur'), this.value );
		});
		
		pData.find("#filter-caisse").keyup(function() {
			$.uiTableFilter( $('.table-caisse'), this.value );
		});
		
		pData.find("#filter-solidaire").keyup(function() {
			$.uiTableFilter( $('.table-solidaire'), this.value );
		});
		
		pData.find("#filter-form-administrateur, #filter-form-caisse, #filter-form-solidaire").submit(function () {return false;});
		
		return pData;
	}
	
	this.affectAjoutCompte = function(pData) {
		var that = this;
		pData.find('#btn-nv-administrateur').click(function() {that.dialogAjoutCompte(2)});
		pData.find('#btn-nv-caisse').click(function() {that.dialogAjoutCompte(3)});
		pData.find('#btn-nv-solidaire').click(function() {that.dialogAjoutCompte(4)});
		return pData;		
	}
	
	this.dialogAjoutCompte = function(pType) {
		var that = this;
		var lData = {typeCompte:""};
		switch(pType) {
			case 2:
				lData.typeCompte = "administrateur";
				break;
			case 3:
				lData.typeCompte = "caisse";
				break;
			case 3:
				lData.typeCompte = "solidaire";
				break;
		
		}
		var lGestionComptesSpeciauxTemplate = new GestionComptesSpeciauxTemplate();
		var lTemplate = lGestionComptesSpeciauxTemplate.dialogAjoutCompte;
		lDialog = $(lTemplate.template(lData)).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:540,
			buttons: {
				'Valider': function() {
					that.ajoutCompte($(this),pType);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
		
		lDialog.find(':input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutCompte($(lDialog),pType);
			}
		});
	}
	
	this.ajoutCompte = function(pDialog,pType) {
		var that = this;
		
		var lVo = new CompteSpecialVO();
		lVo.login = pDialog.find("#login").val();
		lVo.motPasse = pDialog.find("#motPasse").val();
		lVo.motPasseConfirm = pDialog.find("#motPasseConfirm").val();
		lVo.type = pType;
		
		var lValid = new CompteSpecialValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "ajouter";
			$.post(	"./index.php?m=GestionComptesSpeciaux&v=Gestion", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_339_CODE;
							erreur.message = ERR_339_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							
							$(pDialog).dialog("close");	
							var lType = pType - 2;
							that.construct({vr:lVr, tabSelected : lType});
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
	
	this.affectUpdateCompte = function(pData) {
		var that = this;
		pData.find('.btn-edt-modifier').click(function() {that.dialogUpdateCompte($(this));});
		return pData;		
	}
	
	this.dialogUpdateCompte = function(pButton) {
		var that = this;
		var lType = pButton.attr('type-compte');	
		var lIdCompte = pButton.attr('id-compte');		
		var lData = {login:pButton.attr('login')};
		
		var lGestionComptesSpeciauxTemplate = new GestionComptesSpeciauxTemplate();
		var lTemplate = lGestionComptesSpeciauxTemplate.dialogUpdate;
		lDialog = $(lTemplate.template(lData)).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:540,
			buttons: {
				'Valider': function() {
					that.updateCompte($(this),lIdCompte,lType);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
		
		lDialog.find(':input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.updateCompte($(lDialog),lIdCompte,lType);
				return false;
			}
		});
	}
	
	this.updateCompte = function(pDialog, pIdCompte, pType) {
		var that = this;		
		var lVo = new CompteSpecialVO();
		lVo.id = pIdCompte;
		lVo.login = pDialog.find("#login").val();
		
		var lValid = new CompteSpecialValid();
		var lVr = lValid.validUpdate(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "modifier";
			$.post(	"./index.php?m=GestionComptesSpeciaux&v=Gestion", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_340_CODE;
							erreur.message = ERR_340_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							
							$(pDialog).dialog("close");	
							
							that.construct({vr:lVr, tabSelected : pType});
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
	
	this.affectUpdatePassCompte = function(pData) {
		var that = this;
		pData.find('.btn-edt-modifier-pass').click(function() {that.dialogUpdatePassCompte($(this));});
		return pData;		
	}
	
	this.dialogUpdatePassCompte = function(pButton) {
		var that = this;
		var lType = pButton.attr('type-compte');	
		var lIdCompte = pButton.attr('id-compte');
		
		var lGestionComptesSpeciauxTemplate = new GestionComptesSpeciauxTemplate();
		var lTemplate = lGestionComptesSpeciauxTemplate.dialogUpdatePass;
		lDialog = $(lTemplate).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:540,
			buttons: {
				'Valider': function() {
					that.updatePassCompte($(this),lIdCompte,lType);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
		
		lDialog.find(':input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.updatePassCompte($(lDialog),lIdCompte,lType);
			}
		}).find('form').submit(function() {return false;});
	}
	
	this.updatePassCompte = function(pDialog, pIdCompte, pType) {
		var that = this;		
		var lVo = new CompteSpecialVO();
		lVo.id = pIdCompte;
		lVo.motPasse = pDialog.find("#motPasse").val();
		lVo.motPasseConfirm = pDialog.find("#motPasseConfirm").val();
		
		var lValid = new CompteSpecialValid();
		var lVr = lValid.validUpdatePass(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "modifierPass";
			$.post(	"./index.php?m=GestionComptesSpeciaux&v=Gestion", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_340_CODE;
							erreur.message = ERR_340_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							
							$(pDialog).dialog("close");	
							
							that.construct({vr:lVr, tabSelected : pType});
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

	this.affectDeleteCompte = function(pData) {
		var that = this;
		pData.find('.btn-edt-supprimer').click(function() {that.dialogDeleteCompte($(this));});
		return pData;		
	}
	
	this.dialogDeleteCompte = function(pButton) {
		var that = this;
		var lType = pButton.attr('type-compte');
		var lIdCompte = pButton.attr('id-compte');
		var lData = {login:pButton.attr('login')};
		
		var lGestionComptesSpeciauxTemplate = new GestionComptesSpeciauxTemplate();
		var lTemplate = lGestionComptesSpeciauxTemplate.dialogDelete;
		$(lTemplate.template(lData)).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:640,
			buttons: {
				'Valider': function() {
					that.deleteCompte($(this),lIdCompte,lType);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	}
	
	this.deleteCompte = function(pDialog, pIdCompte, pType) {
		var that = this;		
		var lVo = new CompteSpecialVO();
		lVo.id = pIdCompte;
		
		var lValid = new CompteSpecialValid();
		var lVr = lValid.validDelete(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "supprimer";
			$.post(	"./index.php?m=GestionComptesSpeciaux&v=Gestion", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_341_CODE;
							erreur.message = ERR_341_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							
							$(pDialog).dialog("close");	
							
							that.construct({vr:lVr, tabSelected : pType});
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
	
	this.construct(pParam);
}	