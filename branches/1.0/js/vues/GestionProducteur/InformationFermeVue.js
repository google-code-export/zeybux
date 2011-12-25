;function InformationFermeVue(pParam) {
	/*this.mIdFerm = null;
	this.mFerNumero = null;*/
	this.mFerme = {};
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {InformationFermeVue(pParam);}} );
		var that = this;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionProducteur&v=InformationFerme", "pParam=" + $.toJSON(pParam),
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
		
		/*this.mIdFerme = lResponse.ferme.ferId;
		this.mferNumero = lResponse.ferme.ferNumero;*/
		
		
		
		if(lResponse.ferme[0].ferSiren == 0 ) {lResponse.ferme[0].ferSiren = "";}
		lResponse.ferme[0].ferDateAdhesion = lResponse.ferme[0].ferDateAdhesion.extractDbDate().dateDbToFr();
		
		this.mFerme = lResponse.ferme[0];
		
		$(lResponse.operationPassee).each(function() {
			this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
			if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
			if(this.opeMontant < 0) {
				this.credit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				this.debit = '';
			} else {
				this.credit = '';
				this.debit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
			}
		});
						
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lCommunTemplate = new CommunTemplate();
		
		lHtml = $(lGestionProducteurTemplate.informationFerme.template(lResponse));
				
		// Ne pas afficher la pagination si il y a moins de 10 éléments
		if(lResponse.operationPassee.length < 11) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}

		// Si on arrive de information/producteur/catalogue on ne réaffiche pas tout
		if($('#contenu-ferme').length > 0) {
			$('#contenu-ferme').replaceWith(that.affectFerme(lHtml.find('#contenu-ferme')));
			this.affectMenuFerme();
		} else {
			$('#contenu').replaceWith(that.affect(lHtml));
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectHover(pData);
		pData = this.affectDialogSuppFerme(pData);
		pData = this.affectLienRetour(pData);
		pData = this.affectEditionFerme(pData);
		pData = this.affectDate(pData);
		pData = this.affectMenu(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectFerme = function(pData) {
		pData = this.affectHover(pData);
		pData = this.affectDialogSuppFerme(pData);
		pData = this.affectEditionFerme(pData);
		pData = this.affectDate(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false}); 
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	}
		
	this.affectLienRetour = function(pData) {
		pData.find("#btn-liste-ferme").click(function() { ListeFermeVue(); });
		return pData;
	}
	
	this.affectDate = function(pData) {
		pData.find('#fer-dateAdhesion').datepicker({
			changeMonth: true,
			changeYear: true,
			maxDate: "c+1"
			});
		return pData;
	}
	
	this.affectMenu = function(pData) {
		var that = this;
		pData.find('#btn-information').click(function() { InformationFermeVue({id:that.mFerme.ferId}); });
		pData.find('#btn-liste-producteur').click(function() { ListeProducteurVue({id:that.mFerme.ferId}); });
		pData.find('#btn-catalogue').click(function() { CatalogueFermeVue({id:that.mFerme.ferId}); });

		pData.find('#btn-liste-producteur,#btn-catalogue').removeClass("ui-state-active");
		pData.find('#btn-information').addClass("ui-state-active");		
		return pData;		
	}
	
	this.affectMenuFerme = function() {
		$('#btn-liste-producteur,#btn-catalogue').removeClass("ui-state-active");
		$('#btn-information').addClass("ui-state-active");
	}
		
	this.affectEditionFerme = function(pData) {		
		var that = this;
		pData.find('#btn-edt').click(function() {
			

			$(':input[name=nom]').html(that.mFerme.ferNom);
			$(':input[name=siren]').val(htmlDecode(that.mFerme.ferSiren));
			$(':input[name=adresse]').val(htmlDecode(that.mFerme.ferAdresse));
			$(':input[name=ville]').val(htmlDecode(that.mFerme.ferVille));
			$(':input[name=code_postal]').val(htmlDecode(that.mFerme.ferCodePostal));
			$(':input[name=date_adhesion]').val(htmlDecode(that.mFerme.ferDateAdhesion));
			$(':input[name=description]').html(that.mFerme.ferDescription);
			
			$('.edt-info-ferme').toggle();
		});
		
		pData.find('#btn-edt-annuler').click(function() {
			$('.edt-info-ferme').toggle();
		});
				
		pData.find('#btn-edt-valider').click(function() {
			that.modifInformation();
		});
		
		return pData;
	}
	
	this.modifInformation = function() {
		var that = this;
		var lVo = new FermeVO();
		
		lVo.id = this.mFerme.ferId;
		lVo.nom = $(':input[name=nom]').val();
		lVo.siren = $(':input[name=siren]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.description = $(':input[name=description]').val();

		var lValid = new FermeValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {

			lVo.fonction = "modifier";
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionProducteur&v=InformationFerme", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
														
							that.mFerme.ferNom = lVo.nom;
							that.mFerme.ferSiren = lVo.siren;
							that.mFerme.ferAdresse = lVo.adresse;
							that.mFerme.ferVille = lVo.ville;
							that.mFerme.ferCodePostal = lVo.codePostal;
							that.mFerme.ferDateAdhesion = lVo.dateAdhesion.dateDbToFr();
							that.mFerme.ferDescription = lVo.description;

							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_321_CODE;
							erreur.message = ERR_321_MSG;
							lVr.log.erreurs.push(erreur);							
							
							Infobulle.generer(lVr,'');
	
							$('#nom').html(that.mFerme.ferNom);
							$('#siren').html(that.mFerme.ferSiren);
							$('#adresse').html(that.mFerme.ferAdresse);
							$('#ville').html(that.mFerme.ferVille);
							$('#codePostal').html(that.mFerme.ferCodePostal);
							$('#dateAdhesion').html(that.mFerme.ferDateAdhesion);
							$('#description').html(that.mFerme.ferDescription);
							
							$('.edt-info-ferme').toggle();
						} else {
							Infobulle.generer(lResponse,'fer-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'fer-');
		}
	}
	
	this.affectDialogSuppFerme = function(pData) {		
		var that = this;
		pData.find('#btn-supp')
		.click(function() {
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			
			$(lGestionProducteurTemplate.dialogSuppressionFerme.template({ferNumero:that.mFerme.ferNumero})).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {id:that.mFerme.ferId,fonction:"supprimer"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionProducteur&v=InformationFerme", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											
											var lVr = new TemplateVR();
											lVr.valid = false;
											lVr.log.valid = false;
											var erreur = new VRerreur();
											erreur.code = ERR_322_CODE;
											erreur.message = ERR_322_MSG;
											lVr.log.erreurs.push(erreur);
											
											ListeFermeVue({vr:lVr});
											
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
	}
		
	this.construct(pParam);
}