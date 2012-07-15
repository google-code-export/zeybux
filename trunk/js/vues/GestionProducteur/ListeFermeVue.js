;function ListeFermeVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeFermeVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"afficher"};
		$.post(	"./index.php?m=GestionProducteur&v=ListeFerme", "pParam=" + $.toJSON(lParam),
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
		
		if(lResponse.listeFerme.length > 0 && lResponse.listeFerme[0].ferId != null) {
			var lTemplate = lGestionProducteurTemplate.listeFerme;
			$.each(lResponse.listeFerme,function() {
				this.ferIdTri = this.ferNumero.replace("F","");
			})
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionProducteurTemplate.listeFermeVide)));
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectDialogCreerFerme(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectDetailFerme(pData);
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
			
	this.affectDetailFerme = function(pData) {
		var that = this;
		pData.find(".compte-ligne").click(function() {
			InformationFermeVue({id: $(this).attr("id-ferme")});
		});
		return pData;
	};
	
	this.affectDialogCreerFerme = function(pData) {
		var that = this;
		pData.find('#btn-nv-fer')
		.click(function() {			
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogAjoutFerme;
			var lData = {dateAdhesion:getDateAujourdhuiDb().dateDbToFr()};
			
			lData = gCommunVue.comNumeric($(lTemplate.template(lData)));
			
			
			lData.dialog({			
				autoOpen: true,
				modal: true,
				draggable: true,
				resizable: false,
				width:600,
				buttons: {
					'Créer la ferme': function() {
						//var lForm = $(this).children('form').first();
						that.CreerFerme($(this));
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerFerme($(this));
				return false;
			}).find('#fer-dateAdhesion').datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: "c+1",
				yearRange: "2009:c"});			
			});		
		
		return pData;
	};
	
	this.CreerFerme = function(pForm) {
		var that = this;
		var lVo = new FermeVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.siren = pForm.find(':input[name=siren]').val();
		lVo.adresse = pForm.find(':input[name=adresse]').val();
		lVo.ville = pForm.find(':input[name=ville]').val();
		lVo.codePostal = pForm.find(':input[name=code_postal]').val();
		lVo.dateAdhesion = pForm.find(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.description = pForm.find(':input[name=description]').val();
		
		var lValid = new FermeValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			lVo.fonction = "ajouter";
			// Ajout
			$.post(	"./index.php?m=GestionProducteur&v=ListeFerme", "pParam=" + $.toJSON(lVo),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
							
							$("#dialog-form-fer").dialog('close');
							
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_320_CODE;
							erreur.message = ERR_320_MSG;
							lVr.log.erreurs.push(erreur);
							//Infobulle.generer(lVr,'');
							//var lParam = {vr:lVr};					
							//that.construct({vr:lVr});
							InformationFermeVue({vr:lVr,id:lResponse.id});
						} else {
							Infobulle.generer(lResponse,'fer-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'fer-');
		}
	};
	
	this.construct(pParam);
}