;function ModificationAdherentVue(pParam) {
	this.mIdAdherent = null;
	this.mIdCompte = null;
	this.mAdherent = {};
	this.mAdherentCompte = [];
	this.mIdAdherentPrincipal = 0;
	this.mIdAncienAdherentPrincipal = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ModificationAdherentVue(pParam);}} );
		var that = this;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mAdherent = lResponse.adherent;
							that.mIdAdherent = pParam.id;
							that.mIdCompte = lResponse.adherent.adhIdCompte;
							that.mAdherentCompte[lResponse.adherent.adhIdCompte] = lResponse.adherentCompte;
							//that.mIdAncienAdherentPrincipal = lResponse.adherent.cptIdAdherentPrincipal;
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
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		var lData = lResponse.adherent;		
		lData.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		lData.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lData.modules = lResponse.modules;
		
		if(this.mAdherentCompte[this.mIdCompte].length == 1) {
			lData.formAdherentPrincipal = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalUnique.template(this.mAdherent)});
		} else {
			$.each(this.mAdherentCompte[this.mIdCompte], function() {
				if(this.id == lResponse.adherent.cptIdAdherentPrincipal) {
					this.selected = 'selected="selected"';
				} else {
					this.selected = '';
				}
			});
			lData.formAdherentPrincipal = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:this.mAdherentCompte[this.mIdCompte]})});
		}
				
		$(lResponse.autorisations).each(function() {
			var lIdModule = this.idModule;
			$(lData.modules).each(function() {
				if(this.id == lIdModule) {
					this.checked = "checked=\"checked\"";
				}
			});
		});		
		

		
		
		lData.formCompte = lGestionAdherentsTemplate.formulaireCompteModificationAdherent.template(lData);
		lData.autorisation = lGestionAdherentsTemplate.formulaireAutorisationAdherent.template(lData);		
		var lTemplate = lGestionAdherentsTemplate.formulaireAjoutAdherent;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));
	};
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.affectRetour(pData);
		pData = this.toggleAutorisation(pData);
		pData = this.affectChoixGenerationCompte(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectChoixGenerationCompte = function(pData) {
		var that = this;
		pData.find('[name="choix_compte"]').change(function() {
			var lVal = $(this).val();
			if(lVal == "lier") {
				$('#choix_compte_liaison, #label_compte_lier').show();
			} else {
				$('#choix_compte_liaison').hide();
				$('#label_compte_lier').hide().text('').attr('data-id-compte','');
			}
			
			var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
			switch(lVal) {
				case "actuel":
					var lHtml = '';
					if(that.mAdherentCompte[that.mIdCompte].length == 1) {
						lHtml = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalUnique.template(that.mAdherent)});
					} else {
						$.each(that.mAdherentCompte[that.mIdCompte], function() {
							if(this.id == that.mAdherent.cptIdAdherentPrincipal) {
								this.selected = 'selected="selected"';
							} else {
								this.selected = '';
							}
						});
						lHtml = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:that.mAdherentCompte[that.mIdCompte]})});
					}
					$('#ligne-adherent-principal').html(lHtml);
					break;
				
				default:
					if(that.mAdherent.adhId == that.mAdherent.cptIdAdherentPrincipal) { // Si c'est un adherent Principal il faut en définir un nouveau
						// Si il y a d'autres adhérents
						if(that.mAdherentCompte[that.mIdCompte].length > 1) {
							if(that.mAdherentCompte[that.mIdCompte].length == 2) { // Si il ne reste qu'un autre adhérent on le positionne en principal
								if(that.mAdherentCompte[that.mIdCompte][0].id == that.mAdherent.adhId) {
									that.mIdAncienAdherentPrincipal = that.mAdherentCompte[that.mIdCompte][1].id;
								} else {
									that.mIdAncienAdherentPrincipal = that.mAdherentCompte[that.mIdCompte][0].id;
								}
							} else {
								var lListeAdherent = [];
								$.each(that.mAdherentCompte[that.mIdCompte], function() {
									if(this.id != that.mAdherent.adhId) {
										lListeAdherent.push(this);
									}
								});
								var lData = {adherentPrincipal:lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:lListeAdherent})})
										,cptLabel:that.mAdherent.cptLabel};
							
								$(lGestionAdherentsTemplate.dialogNvAncienAdhPrincipal.template(lData)).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:900,
									buttons: {
										'Valider': function() {
											that.mIdAncienAdherentPrincipal = $(this).find('#idAdherentPrincipal').val();
											$(this).dialog('close');
										}
									},
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								});	
							}						
						} else { // Dernier adhérent du compte
							that.mIdAncienAdherentPrincipal = -1;
						}
					} else {
						that.mIdAncienAdherentPrincipal = that.mAdherent.cptIdAdherentPrincipal;
					}
					
					// Affichage de l'adhérent principal du nouveau compte
					var lHtml = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalUnique.template(that.mAdherent)});
					$('#ligne-adherent-principal').html(lHtml);
					break;
			}			
		});
		return pData;
	};
	
	this.boutonLienCompte = function(pData) {		
		var that = this;
		pData.find("#choix_compte_liaison").click(function() {that.dialogListeAdherent();});
		return pData;
	};
		
	this.dialogListeAdherent = function() {
		var that = this;
		
		// Sélection du compte adhérent à sélectionner
		var lVo = {fonction:"listeAdherent"};
		$.post(	"./index.php?m=GestionAdherents&v=AjoutAdherent", "pParam=" + $.toJSON(lVo),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {	
						var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
						var lTemplate = lGestionAdherentsTemplate.dialogListeAdherent;
						
						var lListeAdherent = [];
						$.each(lResponse.listeAdherent,function() {
							if(this.adhIdCompte != that.mIdCompte) {
								this.adhIdTri = this.adhNumero.replace("Z","");
								this.cptIdTri = this.cptLabel.replace("C","");
								lListeAdherent.push(this);
							}
						});
						
						$(that.affectDialoglisteAdherent($(lTemplate.template({listeAdherent:lListeAdherent})))).dialog({			
							autoOpen: true,
							modal: true,
							draggable: true,
							resizable: false,
							width:900,
							buttons: {
								'Fermer': function() {
									$(this).dialog('close');
								}
							},
							close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
						});					
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	this.affectDialoglisteAdherent = function(pData) {
		pData = this.affectSelectCompte(pData);
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		return pData;
	};
	
	this.affectSelectCompte = function(pData) {
		var that = this;
		pData.find('.compte-ligne').click(function() {
			var lVo = {fonction:"adherentCompte", id:$(this).attr('data-id-compte')};
			$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
							
							$.each(lResponse.adherentCompte, function() {
								if(this.id == lResponse.compte.idAdherentPrincipal) {
									this.selected = 'selected="selected"';
								} else {
									this.selected = '';
								}
							});
							
							// Ajout de l'adhérent à la liste
							lResponse.adherentCompte.push({id:that.mAdherent.adhId,numero:that.mAdherent.adhNumero,nom:that.mAdherent.adhNom,prenom:that.mAdherent.adhPrenom});
							
							var lData = {adherentPrincipal:lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:lResponse.adherentCompte})})
									, cptLabel:lResponse.compte.label};

							$(that.affectDialoglisteAdherent($(lGestionAdherentsTemplate.dialogNvAncienAdhPrincipal.template(lData)))).dialog({			
								autoOpen: true,
								modal: true,
								draggable: true,
								resizable: false,
								width:900,
								buttons: {
									'Valider': function() {
										that.mIdAdherentPrincipal = $(this).find('#idAdherentPrincipal').val();
										
										$.each(lResponse.adherentCompte, function() {
											if(this.id == that.mIdAdherentPrincipal) {
												this.selected = 'selected="selected"';
											} else {
												this.selected = '';
											}
										});
										
										// Affichage de l'adhérent principal du nouveau compte
										var lHtml = lGestionAdherentsTemplate.ligneAdherentPrincipal.template({adherentPrincipal:lGestionAdherentsTemplate.adherentPrincipalSelect.template({adherent:lResponse.adherentCompte})});
										$('#ligne-adherent-principal').html(lHtml);
										
										$(this).dialog('close');
									}
								},
								close: function(ev, ui) { $(this).remove(); Infobulle.init(); }			
							});					
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
			
			$('#label_compte_lier')
				.text($(this).attr('data-label-compte'))
				.attr("data-id-compte",$(this).attr('data-id-compte'));
				$('#dialog-liste-adherent').dialog('close');
		});
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	};
	
	this.toggleAutorisation = function(pData) {
		pData.find('#formulaire-modifier-adherent-table-autorisation').hide();
		pData.find('#btn-toggle-autorisation').click(function() {
			$(this).find('span').toggleClass('ui-icon-triangle-1-s').toggleClass('ui-icon-triangle-1-n');
			$('#formulaire-modifier-adherent-table-autorisation').toggle();
		});
		return pData;
	};
		
	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateNaissance','dateAdhesion',pData);
		pData.find('#dateNaissance').datepicker( "option", "yearRange", '1900:c' );
		pData.find('#dateAdhesion').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	};
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.modifAdherent();
			return false;
		});
		return pData;
	};
	
	this.modifAdherent = function() {
		var lVo = new AdherentVO();
		lVo.id = this.mIdAdherent;
		lVo.idCompte = "";
		lVo.idAdherentPrincipal = 0;
		lVo.idAncienAdherentPrincipal = 0;
		
		var lChoixCompte = $(':input[name=choix_compte]:checked').val();
		if(lChoixCompte == 'actuel' ) {			
			if($('#idAdherentPrincipal').length == 1) { // Si plusieurs adhérents
				lVo.idAdherentPrincipal = $('#idAdherentPrincipal').val();
			}
			lVo.idAncienAdherentPrincipal = lVo.idAdherentPrincipal;
			lVo.idCompte = this.mIdCompte;
		} else if ( lChoixCompte == 'auto') {
			lVo.idCompte = 0;
			lVo.idAdherentPrincipal = lVo.id;
			lVo.idAncienAdherentPrincipal = this.mIdAncienAdherentPrincipal;
		} else {
			var lIdCompte = $('#label_compte_lier').attr("data-id-compte");
			if(lIdCompte != undefined ) {
				lVo.idCompte = $('#label_compte_lier').attr("data-id-compte");
			}
			lVo.idAdherentPrincipal = $('#idAdherentPrincipal').val();
			lVo.idAncienAdherentPrincipal = this.mIdAncienAdherentPrincipal;
		}
				
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		$(':input[name="modules[]"]:checked').each(function() {lVo.modules.push($(this).val());});

		var lValid = new AdherentValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			lVo.fonction = 'modifier';
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							/*var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
							var lTemplate = lGestionAdherentsTemplate.modifierAdherentSucces;
							$('#contenu').replaceWith(lTemplate.template(lResponse));		*/		
							
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_356_CODE;
							erreur.message = ERR_356_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);
							
							CompteAdherentVue({id: lResponse.id,vr:lVR});
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
	
	this.affectRetour = function(pData) {
		var that = this;
		pData.find("#lien-retour").click(function() { CompteAdherentVue({id: that.mIdAdherent});});
		return pData;
	};
	
	this.construct(pParam);
}