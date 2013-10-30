;function ListeComptesSpeciauxVue(pParam) {	
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
	};
	
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
	};
	
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
	};
	
	this.affectTabs = function(pData) {
		var that = this;
		pData.find( "#liste-compte" ).tabs({ selected: that.tabSelected });
		return pData;
	};

	this.affectTri = function(pData) {
		pData.find('.table-administrateur').tablesorter({sortList: [[0,0]],headers: {1: {sorter: false} }});
		pData.find('.table-caisse').tablesorter({sortList: [[0,0]],headers: { 1: {sorter: false} }});
		pData.find('.table-solidaire').tablesorter({sortList: [[0,0]],headers: { 1: {sorter: false} }});
		return pData;
	};
	
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
	};
	
	this.affectAjoutCompte = function(pData) {
		var that = this;
		pData.find('#btn-nv-administrateur').click(function() {that.dialogAjoutCompte(2);});
		pData.find('#btn-nv-caisse').click(function() {that.dialogAjoutCompte(3);});
		pData.find('#btn-nv-solidaire').click(function() {that.dialogAjoutCompte(4);});
		return pData;		
	};
	
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
			case 4:
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
	};
	
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
	};
	
	this.affectUpdateCompte = function(pData) {
		var that = this;
		pData.find('.btn-edt-modifier').click(function() {that.dialogUpdateCompte($(this));});
		return pData;		
	};
	
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
		lDialog.find('form').submit(function() {return false;});
	};
	
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
	};
	
	this.affectUpdatePassCompte = function(pData) {
		var that = this;
		pData.find('.btn-edt-modifier-pass').click(function() {that.dialogUpdatePassCompte($(this));});
		return pData;		
	};
	
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
	};
	
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
	};

	this.affectDeleteCompte = function(pData) {
		var that = this;
		pData.find('.btn-edt-supprimer').click(function() {that.dialogDeleteCompte($(this));});
		return pData;		
	};
	
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
	};
	
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
	};
	
	this.construct(pParam);
}	