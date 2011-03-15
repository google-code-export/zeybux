;function BonDeLivraisonVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdCommande = null;
	this.mComNumero = null;
	this.mEtatEdition = false;
	this.mListeProduit = [];
	this.mSuiteEdition = 0;
	this.mIdProducteur = 0;
	this.mTypePaiement = [];
	
	this.construct = function(pParam) {
		var that = this;
		pParam.export_type = 0;
		$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mEtatEdition = false;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.bonDeLivraison;
		
		this.mIdCommande = pResponse.producteurs[0].comId;
		this.mComNumero = pResponse.comNumero;
		
		$(pResponse.typePaiement).each(function() {
			that.mTypePaiement[this.tppId] = this;
		});
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));	
	}
	
	this.affect = function(pData) {
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectBtnRetourMarche(pData);
		pData = this.affectChangementProducteur(pData);
		pData = this.affectExportBonDeLivraison(pData);
		return pData;
	}
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectChangementProducteur = function(pData) {
		var that = this;
		pData.find('#select-prdt').change(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 1;
				that.dialogEnregistrer();
			} else {
				that.changementProducteur();
			}
		});
		return pData;
	}
	
	this.changementProducteur = function() {
		var that = this;
		var lIdProducteur = $('#select-prdt').val();
		if(lIdProducteur > 0) {
			var lParam = {	"id_commande":that.mIdCommande,
						 	"id_producteur":lIdProducteur,
						 	export_type:0}
			$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mIdProducteur = lIdProducteur;
							that.mEtatEdition = false;
							var lTotal = 0;
							$(lResponse.produits).each(function() {
								that.mListeProduit[this.proId] = parseFloat(this.stoQuantite);
								
								this.stoQuantiteCommande = '';
								this.opeMontant = '';
								var lQuantite = 0;
								
								var lProId = this.proId;
								var these = this;
								$(lResponse.produitsCommande).each(function() {
									if(this.proId == lProId) {
										var lMontant = 0;
										these.stoQuantiteCommande = '';
										these.opeMontantCommande = '';
										these.stoQuantiteLivraison = '';
										these.opeMontantLivraison = '';
										these.stoQuantiteSolidaire = '';
										
										if(this.stoQuantite != null) {
											these.stoQuantiteCommande = this.stoQuantite.nombreFormate(2,',',' ');
										}
										if(this.opeMontant != null) {
											these.opeMontantCommande = this.opeMontant.nombreFormate(2,',',' ');
											lMontant = parseFloat(this.opeMontant);
										}
										if(this.stoQuantiteLivraison != null) {
											these.stoQuantiteLivraison = this.stoQuantiteLivraison.nombreFormate(2,',',' ');
											lQuantite += parseFloat(this.stoQuantiteLivraison);
										}
										if(this.opeMontantLivraison != null) {
											these.opeMontantLivraison = this.opeMontantLivraison.nombreFormate(2,',',' ');
										}
										if(this.stoQuantiteSolidaire != null) {
											these.stoQuantiteSolidaire = this.stoQuantiteSolidaire.nombreFormate(2,',',' ');
											lQuantite += parseFloat(this.stoQuantiteSolidaire);
										}
										
										lTotal += lMontant;
									} else if(this.proId == null) {
										these.stoQuantiteCommande = '0'.nombreFormate(2,',',' ');
										these.opeMontantCommande = '0'.nombreFormate(2,',',' ');
										these.stoQuantiteLivraison = '';
										these.opeMontantLivraison = '';
										these.stoQuantiteSolidaire = '';
									}
								});
								
								if(lQuantite - parseFloat(this.stoQuantite) < 0) {
									this.classEtat = 'qte-reservation-ko';
								} else {
									this.classEtat = 'qte-reservation-ok';
								}
									
								this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
							});	
							
							lResponse.total = '';
							if(lResponse.operationProducteur[0]) {
								if(lResponse.operationProducteur[0].montant != null) {
									lResponse.total = (lResponse.operationProducteur[0].montant * -1).nombreFormate(2,',',' ');
								}
								if(lResponse.operationProducteur[0].typePaiementChampComplementaire != null) {
									lResponse.champComplementaire = lResponse.operationProducteur[0].typePaiementChampComplementaire;
								}
							}
							
							lResponse.sigleMonetaire = gSigleMonetaire;
							lResponse.totalCommande = lTotal.nombreFormate(2,',',' ');
							lResponse.typePaiement = that.mTypePaiement;
							
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.listeProduitLivraison;
							
							var lHtml = that.affectListeProduit($(lTemplate.template(lResponse)));
							
							if(lResponse.operationProducteur[0] && lResponse.operationProducteur[0].typePaiement != null) {
								var lId = lResponse.operationProducteur[0].typePaiement;
								
								lHtml.find(':input[name=typepaiement]').selectOptions(lId);
								
								var lLabel = that.getLabelChamComplementaire(lId);
								if(lLabel != null) {
									lHtml.find("#label-champ-complementaire").text(lLabel);
									lHtml.find("#tr-champ-complementaire").show();
								} else {
									lHtml.find("#label-champ-complementaire").text('');
									lHtml.find("#tr-champ-complementaire").hide();
								}
							} else {
								lHtml.find("#label-champ-complementaire").text('');
								lHtml.find("#tr-champ-complementaire").hide();
							}
							
							$('#liste-pdt').replaceWith(lHtml);
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.listeProduitVide;
			$('#liste-pdt').replaceWith(lTemplate);
		}
	}
	
	this.affectListeProduit = function(pData) {
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectEtatCommande(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectTypePaiement(pData);
		pData = this.affectChangementEtatEdition (pData);
		return pData;
	}
	
	this.affectTypePaiement = function(pData) {
		var that = this;
		pData.find(':input[name=typepaiement]').change(function() {
			that.changerTypePaiement($(this));
		});
		return pData;
	}
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel);
			$("#tr-champ-complementaire").show();
		} else {
			$("#label-champ-complementaire").text('');
			$(":input[name=champ-complementaire]").val('');
			$("#tr-champ-complementaire").hide();
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
	
	this.affectEtatCommande = function(pData) {
		var that = this;
		pData.find(".qte-commande ,.qte-solidaire-commande ").keyup(function() {
			that.mEtatEdition = true;
			var lIdProduit = $(this).prev(".pro-id-etat").text();
			if(that.mListeProduit[lIdProduit]) {
				var lQuantite = 0;
				var lQuantiteLivraison = $(':input[name=qte-commande-' + lIdProduit + ']').val().numberFrToDb();
				var lQuantiteSolidaire = $(':input[name=qte-solidaire-commande-' + lIdProduit + ']').val().numberFrToDb();
				
				if(!isNaN(lQuantiteLivraison) && !lQuantiteLivraison.isEmpty()){
					lQuantite += parseFloat(lQuantiteLivraison);
				}
				if(!isNaN(lQuantiteSolidaire) && !lQuantiteSolidaire.isEmpty()){
					lQuantite += parseFloat(lQuantiteSolidaire);
				}
				
				if(lQuantite - that.mListeProduit[lIdProduit] < 0) {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ok')
						.addClass('qte-reservation-ko');
				} else {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ko')
						.addClass('qte-reservation-ok');
				}
			}
		});
		return pData;
	}
	
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find("#btn-enregistrer").click(function() {
			that.mSuiteEdition = 0;
			that.enregistrer();
		});
		pData.find(".qte-commande ,.prix-commande ").keyup(function(event) {
			if (event.keyCode == '13') {
				that.mSuiteEdition = 0;
				that.enregistrer();
			}			
		});
		return pData;
	}
	
	this.enregistrer = function() {
		var that = this;
		
		var lParam = new ProduitsBonDeLivraisonVO();
		
		lParam.id_commande = this.mIdCommande;
		lParam.id_producteur = this.mIdProducteur;
		lParam.export_type = 0;

		$('.pro-id').each(function() {
			var lId = $(this).text();				
			var lProduit = new ProduitBonDeLivraisonVO();
			lProduit.id  = lId;
			lProduit.quantite = $(':input[name=qte-commande-' + lId + ']').val().numberFrToDb();
			lProduit.quantiteSolidaire = $(':input[name=qte-solidaire-commande-' + lId + ']').val().numberFrToDb();
			lProduit.prix = $(':input[name=prix-commande-' + lId + ']').val().numberFrToDb();
			lParam.produits.push(lProduit);
		});		
		
		lParam.typePaiement = $(':input[name=typepaiement]').val();
		lParam.total = $(':input[name=total]').val().numberFrToDb();
		
		if(this.getLabelChamComplementaire(lParam.typePaiement) != null) {
			lParam.typePaiementChampComplementaireObligatoire = 1;
			lParam.typePaiementChampComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lParam.typePaiementChampComplementaireObligatoire = 0;
		}
		
		var lValid = new ProduitsBonDeLivraisonValid();
		var lVr = lValid.validAjout(lParam);
				
		if(lVr.valid) {
			$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mEtatEdition = false;
							if(that.mSuiteEdition == 1) {
								that.changementProducteur();
							} else if (that.mSuiteEdition == 2) {
								that.dialogExportBonDeLivraison();
							} else {
								var lVr = new TemplateVR();
								lVr.valid = false;
								lVr.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_301_CODE;
								erreur.message = ERR_301_MSG;
								lVr.log.erreurs.push(erreur);							
								
								Infobulle.generer(lVr,'');
							}
						} else {
							Infobulle.generer(lResponse,'');
							$('#select-prdt').selectOptions(that.mIdProducteur);
						}
					},"json"
			);
			
		} else {
			Infobulle.generer(lVr,'');
			$('#select-prdt').selectOptions(that.mIdProducteur);
		}
	}
	
	this.affectExportBonDeLivraison = function(pData) {		
		var that = this;		
		pData.find('#btn-export-bcom')
		.click(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 2;
				that.dialogEnregistrer();
			} else {
				that.dialogExportBonDeLivraison();
			}			
		});
		return pData;
	}
	
	this.affectChangementEtatEdition = function(pData) {
		var that = this;
		pData.find('.com-input-text').keyup(function() {that.mEtatEdition = true;});
		pData.find(':input[name=typepaiement]').change(function() {that.mEtatEdition = true;});
		return pData;
	}
	
	this.dialogExportBonDeLivraison = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogExportBonDeLivraison;
		$(lTemplate.template({comNumero:that.mComNumero})).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter': function() {
					// Récupération du formulaire
					var lFormat = $(this).find(':input[name=format]:checked').val();
					
					var lParam = new ExportBonLivraisonVO();
					lParam.pParam = 1;
					lParam.export_type = 1;
					lParam.id_commande = that.mIdCommande;
					lParam.format = lFormat;
					
					// Test des erreurs
					var lValid = new ExportBonLivraisonValid();
					var lVr = lValid.validAjout(lParam);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Affichage
						$.download("./index.php?m=GestionCommande&v=BonDeLivraison", lParam);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }
		});
	}
		
	this.dialogEnregistrer = function() {	
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogEnregistrement;
		
		$(lTemplate).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Enregistrer': function() {
					that.enregistrer();
					$(this).dialog('close');
				},
				'Annuler': function() {
					if(that.mSuiteEdition == 1) {
						$('#select-prdt').selectOptions(that.mIdProducteur);
					}
					$(this).dialog('close');
				},
				'Ne pas Enregistrer': function() {
					that.mEtatEdition = false;
					if(that.mSuiteEdition == 1) {
						that.changementProducteur();
					} else if (that.mSuiteEdition == 2) {
						that.changementProducteur();
						that.dialogExportBonDeLivraison();
					}
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	}
	
	this.construct(pParam);
}