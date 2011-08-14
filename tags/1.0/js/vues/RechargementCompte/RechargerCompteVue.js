;function RechargerCompteVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mTypePaiement = [];
	this.solde = 0;
	
	this.construct = function(pParam) {
		var that = this;
		var lParam = {fonction:"listeAdherent"};
		$.post(	"./index.php?m=RechargementCompte&v=RechargerCompte", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						$(lResponse.typePaiement).each(function() {
							that.mTypePaiement[this.tppId] = this;
						});
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lRechargementCompteTemplate = new RechargementCompteTemplate();
		
		if(lResponse.listeAdherent.length > 0 && lResponse.listeAdherent[0].adhId != null) {
			var lTemplate = lRechargementCompteTemplate.listeAdherent;
			
			lResponse.sigleMonetaire = gSigleMonetaire;
			$(lResponse.listeAdherent).each(function() {
				this.classSolde = '';
				if(this.cptSolde < 0){this.classSolde = "com-nombre-negatif";}
				this.cptSolde = this.cptSolde.nombreFormate(2,',',' ');
			});
			
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(lRechargementCompteTemplate.listeAdherentVide);
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}	
	
	this.affectLienCompte = function(pData) {
		var that = this;
		pData.find('.compte-ligne').click(function() {
			
			
			var lParam = {'id-adherent':$(this).find(".id-adherent").text(),
							fonction:"infoRechargement"};
			
			$.post(	"./index.php?m=RechargementCompte&v=RechargerCompte", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.solde = parseFloat(lResponse.solde);
						
						lResponse.sigleMonetaire = gSigleMonetaire;
						lResponse.solde = lResponse.solde.nombreFormate(2,',',' ');
						lResponse.typePaiement = that.mTypePaiement;
						
						var lCompte = lResponse.idCompte;
						
						var lRechargementCompteTemplate = new RechargementCompteTemplate();
						var lTemplate = lRechargementCompteTemplate.dialogRecharger;						
						var lHtml = $(lTemplate.template(lResponse));
						
						lHtml = that.affectDialog(lHtml);
						
						lHtml.dialog({
							autoOpen: true,
							modal: true,
							draggable: false,
							resizable: false,
							width:800,
							buttons: {
								'Valider': function() {
							
									var lVo = that.getRechargementVO();									
									lVo.id = lCompte;
									
									var lValid = new RechargementCompteValid();
									var lVr = lValid.validAjout(lVo);
									
									Infobulle.init(); // Supprime les erreurs
									if(lVr.valid) {
										lVo.fonction = "rechargerCompte";
										var lDialog = this;
										$.post(	"./index.php?m=RechargementCompte&v=RechargerCompte", "pParam=" + $.toJSON(lVo),
											function(lResponse) {
												Infobulle.init(); // Supprime les erreurs
												if(lResponse.valid) {
													
													// Message d'information
													var lVr = new TemplateVR();
													lVr.valid = false;
													lVr.log.valid = false;
													var erreur = new VRerreur();
													erreur.code = ERR_306_CODE;
													erreur.message = ERR_306_MSG;
													lVr.log.erreurs.push(erreur);
													var lParam = {vr:lVr};
													that.construct(lParam);
													
													$(lDialog).dialog("close");										
												} else {
													Infobulle.generer(lResponse,'');
												}
											},"json"
										);
									}else {
										Infobulle.generer(lVr,'');
									}
								},
								'Annuler': function() { $(this).dialog("close"); }
								},
							close: function(ev, ui) { $(this).remove(); }
						});
						that.changerTypePaiement($(":input[name=typepaiement]"));
						that.majNouveauSolde();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);		
		});
		return pData;
	}
	
	this.affectDialog = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
		});
		return pData;
	}
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel).show();
			$("#td-champ-complementaire").show();
		} else {
			$("#label-champ-complementaire").text('').hide();
			$(":input[name=champ-complementaire]").val('');
			$("#td-champ-complementaire").hide();
		}
	}
	
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.mTypePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].tppChampComplementaire == 1) {
				return lTpp[pId].tppLabelChampComplementaire;
			}
		}	
		return null;
	}
	
	this.affectNouveauSolde = function(pData) {
		var that = this;
		pData.find(":input[name=montant-rechargement]").keyup(function() {
			that.majNouveauSolde();
		});
		return pData;
	}
	
	this.majNouveauSolde = function() {
		var lTotal = this.calculNouveauSolde();
		if(lTotal <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lTotal.nombreFormate(2,',',' '));
	}
	
	this.calculNouveauSolde = function() {
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}		
		return this.solde + lRechargement;
	}
	
	this.getRechargementVO = function() {
		var lVo = new RechargementCompteVO();
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		if(!isNaN(lMontant) && !lMontant.isEmpty()){
			lMontant = parseFloat(lMontant);
		}
		lVo.montant = lMontant;
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		if(this.getLabelChamComplementaire(lVo.typePaiement) != null) {
			lVo.champComplementaireObligatoire = 1;
			lVo.champComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lVo.champComplementaireObligatoire = 0;
		}
		return lVo;
	}
	
	this.construct(pParam);
}