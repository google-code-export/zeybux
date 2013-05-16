;function AjoutAdherentVue(pParam) {
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {AjoutAdherentVue(pParam);}} );
		this.afficher();
	};
	
	this.afficher = function() {
		var that = this;		
		var lData = {adhDateAdhesion: getDateAujourdhuiDb().dateDbToFr()};
		
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		lData.formCompte = lGestionAdherentsTemplate.formulaireCompteAjoutAdherent;
		var lTemplate = lGestionAdherentsTemplate.formulaireAjoutAdherent;
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));
	};
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.affectChoixGenerationCompte(pData);
		pData = this.affectLienRetour(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#lien-retour").click(function() { ListeAdherentVue(); });
		return pData;
	};
	
	this.affectChoixGenerationCompte = function(pData) {
		pData.find('[name="choix_compte"]').change(function() {
			var lVal = $(this).val();
			if(lVal == "auto") {
				$('#choix_compte_liaison').hide();
				$('#label_compte_lier').hide().text('').attr('data-id-compte','');
			} else {
				$('#choix_compte_liaison, #label_compte_lier').show();
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
	
	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateNaissance','dateAdhesion',pData);
		pData.find('#dateNaissance').datepicker( "option", "yearRange", '1900:c' );
		pData.find('#dateAdhesion').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	};
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.ajoutAdherent();
			return false;
		});
		return pData;
	};
	
	this.ajoutAdherent = function() {
		var lVo = new AdherentVO();
		//lVo.compte = $(':input[name=numero_compte]').val();
		if( $(':input[name=choix_compte]:checked').val() == 'auto') {
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
		//$(':input[name=modules[]]:checked').each(function() { lVo.modules.push($(this).val()); });
		//$(':input[name=modules_default[]]').each(function() { lVo.modules.push($(this).val()); });
		
		lVo.fonction = "ajouter";
		
		var lValid = new AdherentValid();
		var lVr = lValid.validAjout(lVo);

		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionAdherents&v=AjoutAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							/*var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
							var lTemplate = lGestionAdherentsTemplate.ajoutAdherentSucces;
							$('#contenu').replaceWith(lTemplate.template(lResponse));	*/	
							
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_355_CODE;
							erreur.message = ERR_355_MSG;
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
	
	this.construct(pParam);
}