;function ModificationAdherentVue(pParam) {
	this.mIdAdherent = null;
	this.mIdCompte = null;
	
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
							that.mIdAdherent = pParam.id;
							that.mIdCompte = lResponse.adherent.adhIdCompte;
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
		var lData = lResponse.adherent;		
		lData.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		lData.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lData.modules = lResponse.modules;
		
		$(lResponse.autorisations).each(function() {
			var lIdModule = this.idModule;
			$(lData.modules).each(function() {
				if(this.id == lIdModule) {
					this.checked = "checked=\"checked\"";
				}
			});
		});		
		

		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		
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
		pData.find('[name="choix_compte"]').change(function() {
			var lVal = $(this).val();
			if(lVal == "lier") {
				$('#choix_compte_liaison, #label_compte_lier').show();
			} else {
				$('#choix_compte_liaison').hide();
				$('#label_compte_lier').hide().text('').attr('data-id-compte','');
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
						
						$.each(lResponse.listeAdherent,function() {
							this.adhIdTri = this.adhNumero.replace("Z","");
							this.cptIdTri = this.cptLabel.replace("C","");
						});
						
						$(that.affectDialoglisteAdherent($(lTemplate.template(lResponse)))).dialog({			
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
		pData.find('.compte-ligne').click(function() {
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
		var lChoixCompte = $(':input[name=choix_compte]:checked').val();
		if(lChoixCompte == 'actuel' ) {
			lVo.idCompte = this.mIdCompte;
		} else if ( lChoixCompte == 'auto') {
			lVo.idCompte = 0;
		} else {
			lVo.idCompte = $('#label_compte_lier').attr("data-id-compte");
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