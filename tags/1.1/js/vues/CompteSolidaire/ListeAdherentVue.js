;function CompteSolidaireListeAdherentVue(pParam) {
	this.listeAdherent = [];
	this.solde = 0;
	
	this.construct = function(pParam) {
	var that = this;
	var lParam = {fonction:"adherent"};
	$.history( {'vue':function() {CompteSolidaireListeAdherentVue(pParam);}} );
	$.post(	"./index.php?m=CompteSolidaire&v=ListeAdherent", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						$(lResponse.listeAdherent).each(function() {
							that.listeAdherent[this.adhId] = this;
						});
						
						that.solde = lResponse.solde;
						

						gCommunVue.majMenu('CompteSolidaire','ListeAdherent');
						
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
	);
	};	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
		
		if(pResponse.listeAdherent.length > 0 && pResponse.listeAdherent[0].adhId != null) {
			var lTemplate = lCompteSolidaireTemplate.listeAdherent;	
			$.each(pResponse.listeAdherent,function() {
				this.adhIdTri = this.adhNumero.replace("Z","");
			});
			$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
		} else {
			$('#contenu').replaceWith(lCompteSolidaireTemplate.listeAdherentVide);
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectVirement(pData);
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
			
	this.affectVirement = function(pData) {
		var that = this;
		pData.find(".compte-ligne").click(function() {			
			var lId = $(this).attr("id-adherent");

			var lCompteSolidaireTemplate = new CompteSolidaireTemplate();
			var lTemplate = lCompteSolidaireTemplate.dialogAjoutVirement;
			var lData = that.listeAdherent[lId];
			lData.sigleMonetaire = gSigleMonetaire;
									
			var lDialog = $(that.affectDialog($(lTemplate.template(lData)))).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:450,
				buttons: {
					'Valider': function() {
						that.envoyerVirement(this,lId);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
			});
			lDialog.find('form').submit(function() {
				that.envoyerVirement(lDialog,lId);
				return false;
			});		
		});
		return pData;
	};
	
	this.affectDialog = function(pData) {
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};

	this.envoyerVirement = function(pDialog,pId) {
		var lVo = new CompteSolidaireAjoutVirementVO();								
		lVo.id = pId;
		lVo.montant = $(pDialog).find(":input[name=montant]").val().numberFrToDb();
		lVo.solde = this.solde;
		
		var lValid = new CompteSolidaireVirementValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "ajoutVirement";
			var lDialog = this;
			$.post(	"./index.php?m=CompteSolidaire&v=ListeAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_307_CODE;
							erreur.message = ERR_307_MSG;
							lVr.log.erreurs.push(erreur);
							Infobulle.generer(lVr,'');
							
							$(pDialog).dialog("close");										
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		}else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.construct(pParam);
}