;function BonDeLivraisonVue(pParam) {
	this.mIdCommande = null;
	this.mComNumero = null;
	this.mEtatEdition = false;
	this.mListeProduit = [];
	this.mSuiteEdition = 0;
	this.mIdCompteProducteur = 0;
	this.mTypePaiement = [];
	this.mResponse;
	this.mArchive = -1;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {BonDeLivraisonVue(pParam);}} );
		var that = this;
		//pParam.export_type = 0;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mEtatEdition = false;
							that.mArchive = lResponse.archive;
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
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.bonDeLivraison;
		
		this.mIdCommande = pResponse.producteurs[0].proIdCommande;
		this.mComNumero = pResponse.comNumero;
		
		$(pResponse.typePaiement).each(function() {
			that.mTypePaiement[this.tppId] = this;
		});
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));	
	};
	
	this.affectDroitArchive = function(pData) {
		pData.find("#btn-annuler").remove();
		pData.find("#btn-enregistrer").remove();
		pData.find("#btn-modifier").remove();
		return pData;
	};

	this.affect = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectBtnRetourMarche(pData);
		pData = this.affectChangementProducteur(pData);
		pData = this.affectExportBonDeLivraison(pData);
		return pData;
	};
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_marche":that.mIdCommande});
		});
		return pData;
	};
	
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
	};
	
	this.changementProducteur = function() {
		var that = this;
		var lIdCompteProducteur = $('#select-prdt').val();
		if(lIdCompteProducteur > 0) {
			var lParam = {	"id_commande":that.mIdCommande,
						 	"id_compte_ferme":lIdCompteProducteur,
						 	fonction:"afficherProducteur"};
			$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								that.mIdCompteProducteur = lIdCompteProducteur;
								that.mEtatEdition = false;
								that.mResponse = lResponse;
								if(lResponse.operationProducteur && lResponse.operationProducteur.idCompte != null ) {
									that.afficherDetail(lResponse);
								} else {
									that.afficherFormulaire(lResponse,1);									
								}
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		} else {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.listeProduitVide;
			$('#liste-pdt').replaceWith(lTemplate);
		}
	};
	
	this.afficherDetail = function(pResponse) {
		var that = this;
		var lTotal = 0;
		$(pResponse.produits).each(function() {
			that.mListeProduit[this.proId] = parseFloat(this.stoQuantite);
			
			this.stoQuantiteCommande = '';
			this.opeMontant = '';
			var lQuantite = 0;
			
			var lProId = this.proId;
			var these = this;

			these.stoQuantiteCommande = '0'.nombreFormate(2,',',' ');
			these.opeMontantCommande = '0'.nombreFormate(2,',',' ');
			these.stoQuantiteLivraison = '';
			these.opeMontantLivraison = '';
			these.stoQuantiteSolidaire = '';
			
			$(pResponse.produitsCommande).each(function() {
				if(this.proId == lProId) {
					var lMontant = 0;										
					if(this.stoQuantite != null) {
						these.stoQuantiteCommande = this.stoQuantite.nombreFormate(2,',',' ');
					}
					if(this.dopeMontant != null) {
						these.opeMontantCommande = this.dopeMontant.nombreFormate(2,',',' ');
						lMontant = parseFloat(this.dopeMontant);
					}
					lTotal += lMontant;
				}
			});
			
			$(pResponse.produitsLivraison).each(function() {
				if(this.proId == lProId) {
					if(this.stoQuantite != null) {
						these.stoQuantiteLivraison = this.stoQuantite.nombreFormate(2,',',' ');
						lQuantite += parseFloat(this.stoQuantite);
					}
					if(this.dopeMontant != null) {
						these.opeMontantLivraison = this.dopeMontant.nombreFormate(2,',',' ');
					}
				}
			});
			
			$(pResponse.produitsSolidaire).each(function() {
				if(this.proId == lProId) {										
					if(this.stoQuantite != null) {
						these.stoQuantiteSolidaire = this.stoQuantite.nombreFormate(2,',',' ');
						lQuantite += parseFloat(this.stoQuantite);
					}
				}
			});
			
			if(lQuantite - parseFloat(this.stoQuantite) < 0) {
				this.classEtat = 'qte-reservation-ko';
			} else {
				this.classEtat = 'qte-reservation-ok';
			}
				
			this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
			this.masquerNormal = '';
			if(this.proType == 1) {
				this.masquerNormal = "ui-helper-hidden";
			}
		});	
		
		pResponse.total = '';
		if(pResponse.operationProducteur) {
			if(pResponse.operationProducteur.montant != null) {
				pResponse.total = (pResponse.operationProducteur.montant).nombreFormate(2,',',' ');
			}
			if(pResponse.operationProducteur.typePaiementChampComplementaire != null) {
				pResponse.champComplementaire = pResponse.operationProducteur.typePaiementChampComplementaire;
			}
		}
		
		pResponse.sigleMonetaire = gSigleMonetaire;
		pResponse.totalCommande = lTotal.nombreFormate(2,',',' ');
		pResponse.typePaiement = that.mTypePaiement;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeProduitLivraison;
		
		if(pResponse.operationProducteur && pResponse.operationProducteur.typePaiement != null) {
			pResponse.tppType = that.mTypePaiement[pResponse.operationProducteur.typePaiement].tppType;
		}
		
		var lHtml = that.affectListeProduit($(lTemplate.template(pResponse)));
		
		if(pResponse.operationProducteur && pResponse.operationProducteur.typePaiement != null) {
			var lId = pResponse.operationProducteur.typePaiement;
			
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
	};
	
	this.afficherFormulaire = function(pResponse,pType) {
		var that = this;
		var lTotal = 0;
		$(pResponse.produits).each(function() {
			that.mListeProduit[this.proId] = parseFloat(this.stoQuantite);
			
			this.stoQuantiteCommande = '';
			this.opeMontant = '';
			var lQuantite = 0;
			
			var lProId = this.proId;
			var these = this;

			these.stoQuantiteCommande = '0'.nombreFormate(2,',',' ');
			these.opeMontantCommande = '0'.nombreFormate(2,',',' ');
			these.stoQuantiteLivraison = '';
			these.opeMontantLivraison = '';
			these.stoQuantiteSolidaire = '';
			
			$(pResponse.produitsCommande).each(function() {
				if(this.proId == lProId) {
					var lMontant = 0;										
					if(this.stoQuantite != null) {
						these.stoQuantiteCommande = this.stoQuantite.nombreFormate(2,',',' ');
					}
					if(this.dopeMontant != null) {
						these.opeMontantCommande = this.dopeMontant.nombreFormate(2,',',' ');
						lMontant = parseFloat(this.dopeMontant);
					}
					lTotal += lMontant;
				}
			});
			
			$(pResponse.produitsLivraison).each(function() {
				if(this.proId == lProId) {
					if(this.stoQuantite != null) {
						these.stoQuantiteLivraison = this.stoQuantite.nombreFormate(2,',',' ');
						lQuantite += parseFloat(this.stoQuantite);
					}
					if(this.dopeMontant != null) {
						these.opeMontantLivraison = this.dopeMontant.nombreFormate(2,',',' ');
					}
				}
			});
			
			$(pResponse.produitsSolidaire).each(function() {
				if(this.proId == lProId) {										
					if(this.stoQuantite != null) {
						these.stoQuantiteSolidaire = this.stoQuantite.nombreFormate(2,',',' ');
						lQuantite += parseFloat(this.stoQuantite);
					}
				}
			});
			
			if(lQuantite - parseFloat(this.stoQuantite) < 0) {
				this.classEtat = 'qte-reservation-ko';
			} else {
				this.classEtat = 'qte-reservation-ok';
			}
				
			this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
			
			this.masquerNormal = '';
			if(this.proType == 1) {
				this.masquerNormal = "ui-helper-hidden";
			}
			
		});	
		
		pResponse.total = '';
		if(pResponse.operationProducteur) {
			if(pResponse.operationProducteur.montant != null) {
				pResponse.total = (pResponse.operationProducteur.montant).nombreFormate(2,',',' ');
			}
			if(pResponse.operationProducteur.typePaiementChampComplementaire != null) {
				pResponse.champComplementaire = pResponse.operationProducteur.typePaiementChampComplementaire;
			}
		}
		
		pResponse.sigleMonetaire = gSigleMonetaire;
		pResponse.totalCommande = lTotal.nombreFormate(2,',',' ');
		pResponse.typePaiement = that.mTypePaiement;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeProduitLivraison;
		
		
		
		var lHtml = that.affectListeProduitFormulaire($(lTemplate.template(pResponse)));
		
		if(pResponse.operationProducteur && pResponse.operationProducteur.typePaiement != null) {
			var lId = pResponse.operationProducteur.typePaiement;
			
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

		if(pType == 2) {
			lHtml.find("#btn-annuler").show();
		}
		
		$('#liste-pdt').replaceWith(lHtml);
	};
	
	this.affectListeProduit = function(pData) {
		pData = this.affectEtatCommande(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectModifier(pData);
		pData = this.affectTypePaiement(pData);
		pData = this.affectChangementEtatEdition(pData);
		pData = this.affectMasquerFormulaire(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		if(this.mArchive == 2) { // Si le marché est archivé on ne peut plus faide de modification
			pData = this.affectDroitArchive(pData);
		}
		return pData;
	};
	
	this.affectListeProduitFormulaire = function(pData) {
		pData = this.affectEtatCommande(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectModifier(pData);
		pData = this.affectTypePaiement(pData);
		pData = this.affectChangementEtatEdition(pData);
		pData = this.affectMasquerDetail(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		if(this.mArchive == 2) { // Si le marché est archivé on ne peut plus faide de modification
			pData = this.affectDroitArchive(pData);
		}
		return pData;
	};
	
	this.affectMasquerDetail = function(pData) {
		pData.find(".detail").hide();
		return pData;
	};
	this.affectMasquerFormulaire = function(pData) {
		pData.find(".formulaire").hide();
		return pData;
	};
	
	this.affectTypePaiement = function(pData) {
		var that = this;
		pData.find(':input[name=typepaiement]').change(function() {
			that.changerTypePaiement($(this));
		});
		return pData;
	};
	
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
	};
	
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.mTypePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].tppChampComplementaire == 1) {
				return lTpp[pId].tppLabelChampComplementaire;
			}
		}	
		return null;
	};
	
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
	};
	
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
	};
	this.affectModifier = function(pData) {
		var that = this;
		pData.find("#btn-modifier").click(function() {
			that.afficherFormulaire(that.mResponse,2);
		});
		pData.find("#btn-annuler").click(function() {
			that.changementProducteur();
		});		
		return pData;
	};
	
	this.enregistrer = function() {
		var that = this;
		
		var lParam = new ProduitsBonDeLivraisonVO();
		
		lParam.id_commande = this.mIdCommande;
		lParam.id_compte_ferme = this.mIdCompteProducteur;
		//lParam.export_type = 0;

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
			lParam.fonction = "enregistrer";
			$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
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
									
									//Infobulle.generer(lVr,'');
									that.changementProducteur({vr:lVr});
								}
							} else {
								Infobulle.generer(lResponse,'');
								$('#select-prdt').selectOptions(that.mIdCompteProducteur);
							}
						}
					},"json"
			);
			
		} else {
			Infobulle.generer(lVr,'');
			$('#select-prdt').selectOptions(that.mIdCompteProducteur);
		}
	};
	
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
	};
	
	this.affectChangementEtatEdition = function(pData) {
		var that = this;
		pData.find('.com-input-text').keyup(function() {that.mEtatEdition = true;});
		pData.find(':input[name=typepaiement]').change(function() {that.mEtatEdition = true;});
		return pData;
	};
	
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
					//lParam.pParam = 1;
					//lParam.export_type = 1;
					lParam.id_commande = that.mIdCommande;
					lParam.format = lFormat;
					lParam.fonction = "export";
					
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
	};
		
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
						$('#select-prdt').selectOptions(that.mIdCompteProducteur);
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
	};
	
	this.construct(pParam);
}