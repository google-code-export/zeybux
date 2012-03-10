;function DetailProduitAbonnementVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {DetailProduitAbonnementVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"detailProduit"};
		lParam = $.extend(lParam,pParam);
		$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
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
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lData= {};
		lData.proAboId = lResponse.produit[0].proAboId;
		lData.unite = lResponse.produit[0].proAboUnite;
		lData.proAboUnite = lData.unite;
		lData.proAboFrequence = lResponse.produit[0].proAboFrequence;
		lData.proAboStockInitial = lResponse.produit[0].proAboStockInitial.nombreFormate(2,',',' ');
		if(lResponse.produit[0].proAboMax == -1) {
			lData.proAboMax = "Pas de limite";
		} else {
			lData.proAboMax = lResponse.produit[0].proAboMax.nombreFormate(2,',',' ') + " " + lData.unite;
		}
		
		if(lResponse.abonnes && lResponse.abonnes.length > 0 && lResponse.abonnes[0].cptAboIdProduitAbonnement != null) {
			$.each(lResponse.abonnes,function() {
				this.cptAboQuantite = this.cptAboQuantite.nombreFormate(2,',',' ');
				this.proAboUnite = lData.proAboUnite;
			});
			
			lData.listeAbonnes = lGestionAbonnementTemplate.detailProduitListeAbonnes.template(lResponse);
		} else {
			lData.listeAbonnes = lGestionAbonnementTemplate.detailProduitListeAbonnesVide;
		}
		
		$('#contenu').replaceWith(that.affect($(lGestionAbonnementTemplate.detailProduit.template(lData))));
		
	};
	
	this.affect = function(pData) {
		pData = this.affectLienRetour(pData);
		pData = this.affectModifier(pData);
		pData = affectDialogSuppProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#lien-retour").click(function() { ListeProduitVue(); });
		return pData;
	};
	
	this.affectModifier = function(pData) {		
		var that = this;
		pData.find("#btn-modifier").click(function() {
			var lParam = {fonction:"detailProduitModifier", id:$(this).attr("idProduit")};
			$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
								var lTemplate = lGestionAbonnementTemplate.dialogModifierProduit;
								
								var lData = lResponse.produit[0];
								
								if(lResponse.unite.length > 0) {
									if(lResponse.unite.length == 1) {
										if(lResponse.unite[0].mLotId == null) { // Pas d'unité
											lData.formUnite = lGestionAbonnementTemplate.formUniteSansUnite.template({unite:lData.proAboUnite});
										} else { // Une seule unité
											lData.formUnite = lGestionAbonnementTemplate.formUnite.template({unite:lResponse.unite[0].mLotUnite});
											lData.unite = lResponse.unite[0].mLotUnite;
										}
									} else { // Plusieures unités
										$.each(lResponse.unite,function() {
											if(lData.proAboUnite == this.mLotUnite) {
												this.selected = "selected=\"selected\"";
											}
										});
										lData.formUnite = lGestionAbonnementTemplate.formUniteSelect.template(lResponse);
									}
								}
								lData.proAboStockInitial = lData.proAboStockInitial.nombreFormate(2,',',' ');
								if(lData.proAboMax == -1) {
									lData.checkedNoLimit = "checked=\"checked\"";
									lData.disableLimit = "disabled=\"disabled\"";
								} else {
									lData.checkedLimit = "checked=\"checked\"";
									lData.max = lData.proAboMax.nombreFormate(2,',',' ');
								}

								$(that.affectModifierDetailProduit($(lTemplate.template(lData)))).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:900,
									buttons: {
										'Modifier': function() {
											that.modifierProduit($(this));
										},
										'Annuler': function() {
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
		});
		return pData;
	};
	
	this.affectModifierDetailProduit = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectLimiteStock(pData);
		pData = this.affectFormUnite(pData);
		return pData;		
	};
	
	this.affectLimiteStock = function(pData) {
		pData.find(':input[name=pro-qte-max-choix]').change(function() {
			if($(':input[name=pro-qte-max-choix]:checked').val() == 1) {				
				$(":input[name=pro-qte-max]").attr("disabled","").val("");
			} else {
				$(":input[name=pro-qte-max]").attr("disabled","disabled").val("");
			}
		});
		return pData;
	};
	
	this.affectFormUnite = function(pData) {
		var that = this;
		pData.find("#pro-unite").keyup(function(event) {
			$(".unite-stock").text($('#pro-unite').val());
		}).change(function() {
			$(".unite-stock").text($('#pro-unite').val());
		});		
		return pData;
	};
	
	this.modifierProduit = function(pDialog) {
		var that = this;
		
		var lProduitAbonnement = new ProduitAbonnementVO();
		lProduitAbonnement.id = pDialog.find(':input[name=idProduit]').val();
		lProduitAbonnement.unite = pDialog.find(':input[name=pro-formUnite]').val();
		lProduitAbonnement.stockInitial = pDialog.find(':input[name=pro-stockInitial]').val().numberFrToDb();
		if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1) {
			lProduitAbonnement.max = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
		} else {
			lProduitAbonnement.max = -1;			
		}		
		lProduitAbonnement.frequence = pDialog.find(':input[name=pro-frequence]').val();
				
		var lValid = new ProduitAbonnementValid();
		var lVr = lValid.validUpdate(lProduitAbonnement);		
		if(lVr.valid) {	
			Infobulle.init();
			lProduitAbonnement.fonction = "modifier";
			$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lProduitAbonnement),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs

							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_343_CODE;
							erreur.message = ERR_343_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);
							
							that.construct({id:lProduitAbonnement.id,vr:lVR});
							pDialog.dialog('close');
						} else {
							Infobulle.generer(lResponse,'pro-');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'pro-');
		}
	};
	
	this.affectDialogSuppProduit = function(pData) {
		var that = this;
		pData.find("#btn-supp").click(function() {
			var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
			var lTemplate = lGestionAbonnementTemplate.dialogSuppressionProduit;
			var lButton = this;
			$(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {fonction:"supprimer", id:$(lButton).attr("idProduit")};
						var lDialog = this;
						$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											$(lDialog).dialog('close');

											var lVR = new Object();
											var erreur = new VRerreur();
											erreur.code = ERR_344_CODE;
											erreur.message = ERR_344_MSG;
											lVR.valid = false;
											lVR.log = new VRelement();
											lVR.log.valid = false;
											lVR.log.erreurs.push(erreur);
											
											ListeProduitVue({vr:lVR});
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
	};
	
	this.construct(pParam);
}