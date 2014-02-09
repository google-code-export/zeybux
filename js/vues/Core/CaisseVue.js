;function CaisseVue(pParam) {
	this.mParam = {};
	this.mSolde = 0;
	this.mIdCompte = 0;
	
	this.mTypePaiement = [];
	this.mBanques = [];
	this.mAdherent = {};
		
	this.mLots = [];
	this.mLotAchat = [];
	this.mFocusRechargement = 0;
	this.mCategorie = [];
	this.mNomCategorie = [];
	
	this.mAchat = {};
	this.mTotalAchatInit = 0;
	this.mAchatInitial = null;
	
	this.mTypePaiementSelect = 0;
	this.afficheChCpAutorise = true;
	
	this.mModule = 'Caisse';
	this.mIdRequete = '';
	this.mCompteurIdProduit = 0;
	this.mModeEdition = 0;
	this.mRechargementSansAchatAvecReservation = false;
	
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CaisseVue(pParam);}} );
		this.mParam = pParam;
		
		var that = this;
		
		pParam.fonction = "infoAchat"; // Par défaut Adhérent sur Marché
		
		if(pParam.id_adherent && pParam.id_adherent == 0) { // compte invité
			this.mIdCompte = -3;
		}
		
		this.mModule = pParam.module;
				
		$.post(	"./index.php?m=" + this.mModule + "&v=CaisseMarcheCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
														
							that.mIdRequete = lResponse.idRequete;
								
							// Les informations pour le paiement
							that.mTypePaiement = lResponse.typePaiement;	
							that.mBanques = lResponse.banques;

							if(pParam.id_adherent != 0) { // Si pas invité les informations de l'adhérent
								that.mIdCompte = lResponse.adherent.adhIdCompte;
								that.mAdherent = lResponse.adherent;
								that.mSolde = parseFloat(lResponse.adherent.cptSolde);
							} else {
								lResponse.adherent = {};
							}
							lResponse.adherent.rechargementMontant = '';
							lResponse.adherent.rechargementChampComplementaire = '';
							if(lResponse.achats.rechargement != null && lResponse.achats.rechargement.id && lResponse.achats.rechargement.id != null) {
								that.mSolde = (parseFloat(that.mSolde) - parseFloat(lResponse.achats.rechargement.montant)).toFixed(2);
								lResponse.adherent.rechargementMontant = lResponse.achats.rechargement.montant.nombreFormate(2,',','');
								that.mTypePaiementSelect = lResponse.achats.rechargement.typePaiement;
																	
								var lTypePaiementService = new TypePaiementService();
								var lChampComplementaire = [];

								if(that.mTypePaiement[lResponse.achats.rechargement.typePaiement]) {
									$(that.mTypePaiement[lResponse.achats.rechargement.typePaiement].champComplementaire).each(function() {				
										var lChamp = lResponse.achats.rechargement.champComplementaire[this.id];
										lChamp.id = this.id;
										lChamp.tppCpVisible = 1;
										lChamp.chCpLabel = this.label;
										lChampComplementaire.push(lChamp);
									});
								}
								
								lResponse.adherent.champComplementaire = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, that.mBanques, undefined, 'rechargement');
							}

							lResponse.adherent.total = 0;
							lResponse.adherent.totalAchat = 0;
							lResponse.adherent.totalAchatSolidaire = 0;

							$.each(lResponse.lots,function() {
								$.each(this.lots,function() {
									this.tailleAffiche = this.taille.nombreFormate(2,',',' ');
									this.selected = '';	
									this.mLotPrixUnitaire = (parseFloat(this.prix) / parseFloat(this.taille)).toFixed(2).nombreFormate(2,',',' ');
								});
							});
							that.mLots = lResponse.lots;
							
							$.each(lResponse.stock, function() {
								var lAfficherCategorie = false;
								that.mNomCategorie[this.cproId] = {cproNom:this.cproNom};
								
								this.visible = 'ui-helper-hidden';
																
								$.each(this.produits, function() {
									
									that.mCompteurIdProduit--;
									this.id = that.mCompteurIdProduit;
																		
									if(this.montant != null) {
										that.mTotalAchatInit = (parseFloat(that.mTotalAchatInit) + parseFloat(this.montant * -1)).toFixed(2);
										this.quantiteAchat = (this.quantite * -1).nombreFormate(2,',','') ;
										this.montantAchat = (this.montant * -1).nombreFormate(2,',','') ;
										lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(this.montant * -1)).toFixed(2);
										lAfficherCategorie = true;
										var lIdLot = ( this.idDetailCommande != 0 ) ? this.idDetailCommande : this.idModeleLot;
										if(that.mLotAchat[this.id]) {
											that.mLotAchat[this.id].normal = lIdLot;	
										} else {
											that.mLotAchat[this.id] = {normal:lIdLot,solidaire:0};
										}
										if(this.idStock == null) { // dans le cas d'un réservation
											this.idStock = 0;
											this.idDetailOperation = 0;
										}
										
									} else {
										this.quantiteAchat = '';
										this.montantAchat = '';
										this.idStock = 0;
										this.idDetailOperation = 0;
									}
									
									if(this.montantSolidaire != null) {
										that.mTotalAchatInit = (parseFloat(that.mTotalAchatInit) + parseFloat(this.montantSolidaire * -1)).toFixed(2);
										this.quantiteAchatSolidaire = (this.quantiteSolidaire * -1).nombreFormate(2,',','') ;
										this.montantAchatSolidaire = (this.montantSolidaire * -1).nombreFormate(2,',','') ;
										lResponse.adherent.totalAchatSolidaire = (parseFloat(lResponse.adherent.totalAchatSolidaire) + parseFloat(this.montantSolidaire * -1)).toFixed(2);
										lAfficherCategorie = true;
										
										var lIdLot = ( this.idDetailCommandeSolidaire != 0 ) ? this.idDetailCommandeSolidaire : this.idModeleLotSolidaire;
										if(that.mLotAchat[this.id]) {
											that.mLotAchat[this.id].solidaire = lIdLot;	
										} else {
											that.mLotAchat[this.id] = {normal:0,solidaire:lIdLot};
										}
										
										if(this.idStockSolidaire == null) { // dans le cas d'un réservation
											this.idStockSolidaire = 0;
											this.idDetailOperationSolidaire = 0;
										}
									} else {
										this.quantiteAchatSolidaire = '' ;
										this.montantAchatSolidaire = '' ;
										this.idStockSolidaire = 0;
										this.idDetailOperationSolidaire = 0;
									}									
									
								});
								
								// Affiche la catégorie si il y a un achat ou reservation
								if(lAfficherCategorie) {
									this.visible = '';
								}								
							});				
							
							lResponse.adherent.total = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(lResponse.adherent.totalAchatSolidaire)).toFixed(2);
							
							// Si pas d'achat et une réservation il faut calculer le nouveau solde
							if(lResponse.achats.produits &&  typeof lResponse.achats.produits !== 'undefined' && (lResponse.achats.produits.length == 0 || (lResponse.achats.produits[0] && lResponse.achats.produits[0].cproId == null)) && typeof lResponse.reservation !== 'undefined' && lResponse.reservation.length > 0) {
								that.mSolde = (parseFloat(that.mSolde) - parseFloat(lResponse.adherent.total)).toFixed(2);
								
								if(pParam.id_adherent != 0) { // Si pas invité les informations de l'adhérent
									lResponse.adherent.cptSolde = parseFloat(that.mSolde);
								}
								
								if(lResponse.achats.rechargement != null && lResponse.achats.rechargement.id && lResponse.achats.rechargement.id != null) {
									that.mRechargementSansAchatAvecReservation = true;
								}
							}

							// Si il y a eu un achat ou un rechargement affiche le résumé
							if((lResponse.achats.produits && lResponse.achats.produits[0] && lResponse.achats.produits[0].cproId != null) || (lResponse.achats.rechargement !=null && lResponse.achats.rechargement.id != null)) { 
								

								if(lResponse.achats != null) {
									if(lResponse.achats.operationAchat != null) {										
										var lTempChampComplementaire = [];
										for( i in lResponse.achats.operationAchat.champComplementaire) {
											if(lResponse.achats.operationAchat.champComplementaire[i].opeId != null) {
												lResponse.achats.operationAchat.champComplementaire[i].obligatoire = 0;
												lResponse.achats.operationAchat.champComplementaire[i].id = i;
												lTempChampComplementaire[i] = lResponse.achats.operationAchat.champComplementaire[i];
											}
										}
										lResponse.achats.operationAchat.champComplementaire = lTempChampComplementaire;
									}
									if(lResponse.achats.operationAchatSolidaire != null) {										
										var lTempChampComplementaire = [];
										for( i in lResponse.achats.operationAchatSolidaire.champComplementaire) {
											if(lResponse.achats.operationAchatSolidaire.champComplementaire[i].opeId != null) {
												lResponse.achats.operationAchatSolidaire.champComplementaire[i].obligatoire = 0;
												lResponse.achats.operationAchatSolidaire.champComplementaire[i].id = i;
												lTempChampComplementaire[i] = lResponse.achats.operationAchatSolidaire.champComplementaire[i];
											}
										}
										lResponse.achats.operationAchatSolidaire.champComplementaire = lTempChampComplementaire;
									}
									if(lResponse.achats.rechargement != null && lResponse.achats.rechargement.id != null) {										
										var lTempChampComplementaire = [];
										for( i in lResponse.achats.rechargement.champComplementaire) {
											if(lResponse.achats.rechargement.champComplementaire[i].opeId != null) {
												lResponse.achats.rechargement.champComplementaire[i].obligatoire = 0;
												lResponse.achats.rechargement.champComplementaire[i].id = i;
												lTempChampComplementaire[i] = lResponse.achats.rechargement.champComplementaire[i];
											}
										}
										lResponse.achats.rechargement.champComplementaire = lTempChampComplementaire;
									} else {
										lResponse.achats.rechargement = null;
									}
								}
								
								that.mAchatInitial = lResponse.achats;
								that.mModeEdition = 1;		
								that.afficher(lResponse, that.recapitulatifAchat);
							} else {
								that.afficher(lResponse);
							}
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(pResponse, pCallBack) {
		var lCaisseTemplate = new CaisseTemplate();
		
		var lData = {categories:pResponse.stock, sigleMonetaire: gSigleMonetaire};
		pResponse.adherent.sigleMonetaire = gSigleMonetaire;
		pResponse.adherent.typePaiement = pResponse.typePaiement;

		

		if(pResponse.marche.numero !== undefined) {// Si il y a un marché on affiche son numéro
			pResponse.adherent.labelTotal = lCaisseTemplate.achatMarcheLabelMarche.template({numero:pResponse.marche.numero});			
		} else {
			pResponse.adherent.labelTotal = lCaisseTemplate.achatMarcheLabelTotal;
		}
		
		pResponse.adherent.total = pResponse.adherent.total.nombreFormate(2,',',' ');
		pResponse.adherent.totalAchat = pResponse.adherent.totalAchat.nombreFormate(2,',',' ');
		pResponse.adherent.totalAchatSolidaire = pResponse.adherent.totalAchatSolidaire.nombreFormate(2,',',' ');
		if(this.mParam.id_adherent != 0) { // Les informations de l'adhérent si ce n'est pas un compte invité		
			pResponse.adherent.colspan= '';
			if(pResponse.nbAdhesionEnCours > 0) {
				pResponse.adherent.adhesion = lCaisseTemplate.adhesionOK;
			} else {
				pResponse.adherent.adhesion = lCaisseTemplate.adhesionKO;			
			}
			
			pResponse.adherent.adhSoldeEtatClass = '';
			if(parseFloat(pResponse.adherent.cptSolde) <= 0) {
				pResponse.adherent.adhSoldeEtatClass = 'com-nombre-negatif';		
			} 
			pResponse.adherent.adhSolde = pResponse.adherent.cptSolde.nombreFormate(2,',',' ');
			
			pResponse.adherent.identite = lCaisseTemplate.achatMarcheIdentiteAdherent.template(pResponse.adherent);
			pResponse.adherent.etatCompte = lCaisseTemplate.achatMarcheEtatCompte.template(pResponse.adherent);
			pResponse.adherent.labelRecharger = lCaisseTemplate.achatMarcheLabelRechargement;			
		} else {			
			pResponse.adherent.identite = lCaisseTemplate.achatMarcheIdentiteInvite;
			pResponse.adherent.etatCompte = lCaisseTemplate.achatMarcheEtatCompteInvite;
			pResponse.adherent.labelRecharger = lCaisseTemplate.achatMarcheLabelPaiement;
			
			pResponse.adherent.colspan= 'colspan="2"';
			pResponse.adherent.adhesion = '';
		}
		lData.infoAdherent = lCaisseTemplate.achatInfoAdherent.template(pResponse.adherent);
		
		var lHtml = '';
		/*if(pParam.id_commande != -1) { // Formulaire Marché
			lHtml = lCaisseTemplate.achatMarcheFormulaire.template(lData);
		} else { // Formulaire Caisse permanente*/
			lHtml = lCaisseTemplate.achatHorsMarcheFormulaire.template(lData);
		//}
		
		$('#contenu').replaceWith( this.affect($(lHtml)) );
		if(pCallBack) {
			pCallBack();
		}
	};
	
	this.affect = function(pData) {
		pData = this.affectAfficheLot(pData);
		pData = this.affectCalculPrix(pData);
		pData = this.affectPositionInfoAdherent(pData);
		pData = this.affectMajSolde(pData);
		pData = this.affectAfficheFormulaireRechargement(pData);
		pData = this.affectSelectTypePaiement(pData);
		//pData = this.affectListeBanque(pData);
		var lTypePaiementService = new TypePaiementService();
		pData = lTypePaiementService.affect(pData, this.mBanques);
		
		pData = this.affectValider(pData);
		pData = this.affectModifier(pData);
		pData = this.affectToggleTableauCategorie(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectRetour(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectSupprimer(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		var that = this;
		pData.find("#input-rechercher").keyup(function() {
			that.recherche(this.value);
		  });	
		
		pData.find('#icon-annuler-recherche').click(function() {
			$('#input-rechercher').val('');
			that.recherche('');
		});
		return pData;
	};
	
	this.recherche = function(pVal) {
		var that = this;
		if(pVal == '') {
			that.afficheCategorieNonVide();
		} else {
			$('.tableau-produit').show();
		}
		$.uiTableFilter( $('.tableau-produit'), pVal );
	};
	
	this.afficheCategorieNonVide = function() {
		var that = this;
		$('.ligne-categorie-btn-toggle span').addClass('ui-icon-triangle-1-s').removeClass('ui-icon-triangle-1-n');
		$('.tableau-produit').hide();
				
		$('.ligne-produit').each(function() {
			//var lNproId = $(this).data('id-nom-produit');

			var lIdProduit = $(this).data('id-produit');
			var lIdCategorie = $(this).data('id-categorie');
			
			var lVoProduit = new ProduitAchatVO();
			var lVoProduitSolidaire = new ProduitAchatVO();
			
			lVoProduit = that.qteEtPrixAchat(lIdProduit, '', lVoProduit);
			lVoProduitSolidaire = that.qteEtPrixAchat(lIdProduit, 'Solidaire', lVoProduitSolidaire);
			
			if(lVoProduit.quantite != '' || lVoProduit.prix != '' || lVoProduitSolidaire.quantite != '' || lVoProduitSolidaire.prix != '') {
				$('#btn-toggle-categorie-' + lIdCategorie + ' span').removeClass('ui-icon-triangle-1-s').addClass('ui-icon-triangle-1-n');
				$('#tableau-produit-' + lIdCategorie).show();
			}
		});
	};
	
	this.affectToggleTableauCategorie = function(pData) {
		pData.find('.ligne-categorie').click(function() {
			var lIdCategorie = $(this).data('id-categorie');
			$('#btn-toggle-categorie-' + lIdCategorie + ' span').toggleClass('ui-icon-triangle-1-s').toggleClass('ui-icon-triangle-1-n');
			$('#tableau-produit-' + lIdCategorie).toggle();
		});
		return pData;
	};
	
	this.affectAfficheLot = function(pData) {
		var that = this;
		var lCaisseTemplate = new CaisseTemplate();
		
		// Affiche le lot dès que le curseur est dans un champ
		pData.find(".produit-quantite, .produit-quantite-solidaire, .produit-prix, .produit-prix-solidaire").focus(function() {
			var lIdProduit = $(this).data('id-produit');
			var lNproId = $(this).data('id-nom-produit');
			var lUnite = String($(this).data('unite'));
			var lType = $(this).data('type');
			
			if($('#select-' + lNproId + lType).length == 0) {// Si le select est déjà affiché il ne faut pas le réinitialiser			
				//var lProduit = that.mPrixProduit[lNproId];
				
				var lLotsProduit = that.mLots[lNproId + lUnite].lots;
				var lIdPremierLot = 0;
				var lNbLots = 0;
				var lPremierLot = {};
				var lLotsAffiche = [];
				for(i in lLotsProduit) {
					if(lLotsProduit[i].id) {
						if(lIdPremierLot == 0) {
							lIdPremierLot = i;
							lPremierLot = lLotsProduit[i];
						}
						lLotsAffiche.push(lLotsProduit[i]);
						lNbLots++;
					}
				}
				
				lLotsAffiche.sort(function(a,b) {return a.taille.localeCompare(b.taille);});
				
				
				var lProduit = {nproId:lNproId,lots:lLotsAffiche,unite:lUnite};
				lProduit.prixUnitaire = lPremierLot.mLotPrixUnitaire;	
				
				if(lNbLots == 1) {
					lProduit.lotAffiche = lCaisseTemplate.achatMarcheAfficheLot.template({	id:lPremierLot.id,
																						tailleAffiche:lPremierLot.tailleAffiche,
																						unite:lUnite,
																						});
				} else {
					if(that.mLotAchat[lIdProduit]) {
						var lIdLot = 0;
						if(lType == '') {
							lIdLot = that.mLotAchat[lIdProduit].normal;
						} else {
							lIdLot = that.mLotAchat[lIdProduit].solidaire;
						}
						
						$(lProduit.lots).each(function() {
							if(this.id == lIdLot) {
								lProduit.prixUnitaire = this.mLotPrixUnitaire;
								this.selected = "selected=\"selected\"";
							} else {
								this.selected = '';
							}
						});
					}
					
					lProduit.lotAffiche = lCaisseTemplate.achatMarcheSelectLot.template($.extend({type:lType}, lProduit));
				}
				
				
				
				$('#cellule-lot-produit').html(that.affectChangeLot($(lProduit.lotAffiche)));
				
				lProduit.sigleMonetaire = gSigleMonetaire;
				$('#cellule-lot-produit-prix-unitaire').html(lCaisseTemplate.achatMarchePrixUnitaire.template(lProduit));
				$('.ligne-lot-produit').show();
			}
		}).blur(function() { // Masque automatiquement en sortie si il n'y a qu'un lot
			var lNproId = $(this).data('id-nom-produit');
			var lUnite = String($(this).data('unite'));
			
			var lNbLots = 0;
			for(i in that.mLots[lNproId + lUnite].lots) {
				lNbLots++;
			}
			if(lNbLots == 1) {
				$('.ligne-lot-produit').hide();
			}
		}).keyup(function() {
			var lIdProduit = $(this).data('id-produit');
			var lNproId = $(this).data('id-nom-produit');
			var lUnite = String($(this).data('unite'));
			var lType = $(this).data('type');
			var lIdLot = 0;
			
			var lNbLots = 0;
			var lIdPremierLot = 0;
			for(i in that.mLots[lNproId + lUnite].lots) {
				if(lIdPremierLot == 0) {
					lIdPremierLot = i;
				}
				lNbLots++;
			}
			
			if(lNbLots == 1) {
				lIdLot = lIdPremierLot;
			} else {
				lIdLot = $('#select-' + lNproId + lType).val();
			}
			
			if(that.mLotAchat[lIdProduit]) {
				if(lType == '') {
					that.mLotAchat[lIdProduit].normal = lIdLot;	
				} else {
					that.mLotAchat[lIdProduit].solidaire = lIdLot;	
				}				
			} else {
				if(lType == '') {
					that.mLotAchat[lIdProduit] = {normal:lIdLot,solidaire:0};
				} else {
					that.mLotAchat[lIdProduit] = {normal:0,solidaire:lIdLot};
				}
			}
		});
				
		return pData;
	};
		
	this.affectCalculPrix = function(pData) {
		var that = this;
		pData.find('.produit-quantite, .produit-quantite-solidaire').keyup(function() {
			that.calculPrix($(this).data('id-produit'), $(this).data('id-nom-produit'), $(this).data('type') ,  $(this).val(), String($(this).data('unite')));
		});
		return pData;
	};
	
	this.calculPrix = function(pIdProduit, pIdNomProduit, pType, pQuantite, pUnite) {
		var lLot = {};
		var lPremierLot = {};
		var lIdPremierLot = 0;
		var lNbLots = 0;
		for(i in this.mLots[pIdNomProduit + pUnite].lots) {
			if(lIdPremierLot == 0) {
				lPremierLot = this.mLots[pIdNomProduit + pUnite].lots[i];
			}
			lNbLots++;
		}
		if(lNbLots == 1) {			
			lLot = lPremierLot;
		} else {
			lLot = this.mLots[pIdNomProduit + pUnite].lots[$('#select-' + pIdNomProduit + pType).val()];
		}
		
		pQuantite = parseFloat(pQuantite.numberFrToDb());
		var lPrix = '';
		if(!isNaN(pQuantite)) {
			lPrix =  (parseFloat(pQuantite) * parseFloat( lLot.prix) /  parseFloat(lLot.taille)  ).toFixed(2).nombreFormate(2,',','');
		}
		$('#produits' + pIdProduit + 'montant' + pType  ).val(lPrix);
	};
		
	this.affectChangeLot = function(pData) {
		var that = this;
		pData.find('.select-lot').change(function() {
			var lIdNomProduit = $(this).data('id-nom-produit');
			var lUnite = String($(this).data('unite')); 
			var lType = $(this).data('type'); 
			var lIdLot = $(this).val();
			
			// Raz quantité et prix 
			$('#produits' + lType + lIdNomProduit + 'quantite' + ', #produits' + lIdNomProduit + 'montant' + lType ).val('');
			// Maj Prix unitaire
			$('#prix-unitaire-' + lIdNomProduit).text(that.mLots[lIdNomProduit+lUnite].lots[lIdLot].mLotPrixUnitaire);
			
		});
		return pData;
	};
		
	this.affectPositionInfoAdherent = function(pData) {
		var timeout = null;
		var entryShare = pData.find('#info-adherent-widget').first();
		var entryContent = pData.find('.tableau-liste-produit');
				
		$(window).scroll(function () {			
		  var scrollTop = $(this).scrollTop();
		  if(!timeout) {
			timeout = setTimeout(function() {
			  timeout = null;
			  if (entryShare.css('position') !== 'fixed' && entryShare.offset().top < $(document).scrollTop()) {
				entryContent.css({'margin-top': entryShare.outerHeight() +10} );
				//entryContent.css('margin-top', '200' );
				entryShare.css({'z-index': 999, 'position': 'fixed', 'top': 0, 'width': entryContent.width(), 'box-shadow': '0 0 20px #555'})
							.removeClass('ui-corner-all').addClass('ui-corner-bottom');
			  } else if ($(document).scrollTop() <= entryContent.offset().top) {
				  
				entryContent.css({'margin-top': ''});
				entryShare.css({ 'position': '', 'z-index': '', 'width': '', 'box-shadow':''})
							.removeClass('ui-corner-bottom').addClass('ui-corner-all');
				
			  }
			}, 100);
		  }
		});
		
		return pData;
	};
	
	this.affectMajSolde = function(pData) {
		var that = this;
		pData.find('.produit-quantite, .produit-quantite-solidaire, .produit-prix, .produit-prix-solidaire, #rechargementmontant').keyup(function() {
			// Maj totaux achats
			var lTotal = (parseFloat(that.majTotal('')) + parseFloat(that.majTotal('-solidaire')) ).toFixed(2);
			$('#total').text(lTotal.nombreFormate(2,',',' '));
			
			var lRechargement = parseFloat($('#rechargementmontant').val().numberFrToDb());
			if(isNaN(lRechargement)) {
				lRechargement = 0;
			}
			
			var lSolde = (parseFloat(that.mSolde) - lTotal + parseFloat(that.mTotalAchatInit) + lRechargement).toFixed(2);
			$('#solde').text(lSolde.nombreFormate(2,',',' '));
			
			if(lSolde <= 0) {
				$("#solde, #solde-sigle").addClass("com-nombre-negatif");		
			} else {
				$("#solde, #solde-sigle").removeClass("com-nombre-negatif");
			}
		});
		return pData;
	};
	
	this.majTotal = function(pType) {
		var lTotal = 0;
		$('.produit-prix' + pType).each(function() {
			var lPrix = parseFloat($(this).val().numberFrToDb());
			if(!isNaN(lPrix)) {
				lTotal = (parseFloat(lTotal) +  lPrix).toFixed(2);
			}
		});
		$('#total-achat' + pType).text(lTotal.nombreFormate(2,',',' '));
		
		return parseFloat(lTotal);
	};
	
	this.affectAfficheFormulaireRechargement = function(pData) {
		var that = this;
		var lCelluleRecharger = pData.find("#cellule-recharger");
		
		pData.find('#rechargementmontant, #rechargementtypePaiement').focus(function() {
			that.mFocusRechargement++;
			if(that.afficheChCpAutorise) {
				$('#select-typePaiement').show();
				lCelluleRecharger.removeClass('ui-corner-all').addClass('ui-corner-top');
			}
		}).blur(function() {
			that.mFocusRechargement--;
			if(that.mFocusRechargement == 0) {
				$('#select-typePaiement').hide();
				lCelluleRecharger.removeClass('ui-corner-top').addClass('ui-corner-all');
			}
		});
		
		pData.find('#ligne-rechargement').hover(function() {
			that.mFocusRechargement++;
			if(that.afficheChCpAutorise) {
				$('#select-typePaiement').show();
				lCelluleRecharger.removeClass('ui-corner-all').addClass('ui-corner-top');
			}
		},function() {
			that.mFocusRechargement--;
			if(that.mFocusRechargement == 0) {
				$('#select-typePaiement').hide();
				lCelluleRecharger.removeClass('ui-corner-top').addClass('ui-corner-all');
			}
		});
		return pData;
	};
	
	this.affectAfficheFormulaireRechargementChampComplementaire = function(pData) {
		var that = this;
		var lCelluleRecharger = $("#cellule-recharger");
		
		pData.find(':input').focus(function() {
			that.mFocusRechargement++;
			if(that.afficheChCpAutorise) {
				$('#select-typePaiement').show();
				lCelluleRecharger.removeClass('ui-corner-all').addClass('ui-corner-top');
			}
		}).blur(function() {
			that.mFocusRechargement--;
			if(that.mFocusRechargement == 0) {
				$('#select-typePaiement').hide();
				lCelluleRecharger.removeClass('ui-corner-top').addClass('ui-corner-all');
			}
		});
		return pData;
	};
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
		});
		
		pData.find(":input[name=typepaiement] option[value='" + that.mTypePaiementSelect + "']").prop("selected", true);
		return pData;
	};
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		if(!this.mTypePaiement[lId] || (this.mTypePaiement[lId] && this.mTypePaiement[lId].champComplementaire.length == 0)) {
			$('.champ-complementaire').remove();
		} else {
			var lCaisseTemplate = new CaisseTemplate();
			var lTypePaiementService = new TypePaiementService();
			$('#ligne-operation').after(this.affectChampComplementaire(lTypePaiementService.affect($(lCaisseTemplate.champComplementaire.template(this.mTypePaiement[lId])), this.mBanques, 'rechargement')));
		}
	};
	
	this.affectChampComplementaire = function(pData) {
		pData = this.affectAfficheFormulaireRechargementChampComplementaire(pData);
		return pData;
	};
		
	this.affectValider = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.recapitulatifAchat();
		});
		return pData;
	};
	
	this.recapitulatifAchat = function() {
		var that = this;		
		var lVo = new AchatVO();
		
		var lProduitDetail = [];
		var lProduitAchete = false;
		var lTotal = 0;
		var lTotalSolidaire = 0;

		// Les Produits
		$('.ligne-produit').each(function() {
			var lIdProduit = $(this).data('id-produit');
			var lNproId = $(this).data('id-nom-produit');
			var lUnite = String($(this).data('unite'));
			var lIdCategorie = $(this).data('id-categorie');

			var lVoProduit = new ProduitDetailAchatVO();
			lVoProduit.id = lIdProduit;
			lVoProduit.idNomProduit = lNproId;

			lVoProduit.idStock = $(this).data('id-stock');
			lVoProduit.idStockSolidaire = $(this).data('id-stock-solidaire');
			lVoProduit.idDetailOperation = $(this).data('id-detail-operation');
			lVoProduit.idDetailOperationSolidaire = $(this).data('id-detail-operation-solidaire');
		
			if(that.mLotAchat[lIdProduit]) {
				if(that.mLots[lNproId + lUnite].type == 'modele') { // Produit en Stock
					lVoProduit.idModeleLot = that.mLotAchat[lIdProduit].normal;		
					lVoProduit.idModeleLotSolidaire = that.mLotAchat[lIdProduit].solidaire;						
				} else { // Produit du marche
					lVoProduit.idDetailCommande = that.mLotAchat[lIdProduit].normal;
					lVoProduit.idDetailCommandeSolidaire = that.mLotAchat[lIdProduit].solidaire;					
				}
			}

			var lQuantite = parseFloat($('#produits' + lIdProduit + 'quantite' ).val().numberFrToDb()).toFixed(2);
			if(!isNaN(lQuantite)) {
				lVoProduit.quantite = (lQuantite * -1).toFixed(2);
			}
					
			var lMontant = parseFloat($('#produits' + lIdProduit + 'montant' ).val().numberFrToDb()).toFixed(2);
			if(!isNaN(lMontant)) {
				lVoProduit.montant = (lMontant * -1).toFixed(2);
				lTotal = (parseFloat(lTotal) + parseFloat(lMontant * -1)).toFixed(2);
			}	
			
			lQuantite = parseFloat($('#produits' + lIdProduit + 'quantiteSolidaire' ).val().numberFrToDb()).toFixed(2);
			if(!isNaN(lQuantite)) {
				lVoProduit.quantiteSolidaire = (lQuantite * -1).toFixed(2);
			}
					
			lMontant = parseFloat($('#produits' + lIdProduit + 'montantSolidaire' ).val().numberFrToDb()).toFixed(2);
			if(!isNaN(lMontant)) {
				lVoProduit.montantSolidaire = (lMontant * -1).toFixed(2);
				lTotalSolidaire = (parseFloat(lTotalSolidaire) + parseFloat(lMontant * -1)).toFixed(2);
			}
			
			if(lVoProduit.quantite != '' || lVoProduit.montant != '' || lVoProduit.quantiteSolidaire != '' || lVoProduit.montantSolidaire != '') {				
				lVo.produits.push(lVoProduit);
				lProduitAchete = true;
				
				if(!lProduitDetail[lIdCategorie]) {
					lProduitDetail[lIdCategorie] = {cproNom:that.mNomCategorie[lIdCategorie].cproNom,produits:[]};
				}
				
				lProduitDetail[lIdCategorie].produits[lNproId] = {
						nom:that.mLots[lNproId + lUnite].nom,
						quantite:'',montant:'',quantiteSolidaire:'',montantSolidaire:'',
						unite:'',uniteSolidaire:'',sigleMonetaire:'',sigleMonetaireSolidaire:''};
				if(lVoProduit.quantite != '') {
					lProduitDetail[lIdCategorie].produits[lNproId].quantite = (lVoProduit.quantite * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].unite = lUnite;
					lProduitDetail[lIdCategorie].produits[lNproId].montant = (lVoProduit.montant * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].sigleMonetaire = gSigleMonetaire;
				}
				if(lVoProduit.quantiteSolidaire != '') {
					lProduitDetail[lIdCategorie].produits[lNproId].quantiteSolidaire = (lVoProduit.quantiteSolidaire * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].uniteSolidaire = lUnite;
					lProduitDetail[lIdCategorie].produits[lNproId].montantSolidaire = (lVoProduit.montantSolidaire * -1).nombreFormate(2,',',' ');	
					lProduitDetail[lIdCategorie].produits[lNproId].sigleMonetaireSolidaire = gSigleMonetaire;
				}
			}
			
		});
		
		if(this.mAchatInitial != null) {
			if(this.mAchatInitial.operationAchat != null) {
				lVo.operationAchat = this.mAchatInitial.operationAchat;
			}
			if(this.mAchatInitial.operationAchatSolidaire != null) {
				lVo.operationAchatSolidaire = this.mAchatInitial.operationAchatSolidaire;
			}
			if(this.mAchatInitial.rechargement != null) {
				lVo.rechargement  = this.mAchatInitial.rechargement;
			}
		}
		
		
		if(lTotal < 0) {
			if(lVo.operationAchat == '') {
				var lOperationAchat = new OperationDetailVO();
				//lOperationAchat.montant = lTotal;
				lOperationAchat.typePaiement = 7;
				lOperationAchat.idCompte = this.mIdCompte;
				
				// Mode Marché
				if(this.mParam.id_commande > 0) {
					var lChampComplementaire = new ChampComplementaireVO();
					lChampComplementaire.id = 1;
					lChampComplementaire.obligatoire = 0;
					lChampComplementaire.valeur = this.mParam.id_commande;
					lOperationAchat.champComplementaire[1] = lChampComplementaire;
				}
				
				var lChampComplementaire = new ChampComplementaireVO();
				lChampComplementaire.id = 15;
				lChampComplementaire.obligatoire = 1;
				lChampComplementaire.valeur = this.mIdRequete;
				lOperationAchat.champComplementaire[15] = lChampComplementaire;
				
				lVo.operationAchat = lOperationAchat;
			}			
		
			lVo.operationAchat.montant = lTotal;
		} else if(lVo.operationAchat != '') {
			lVo.operationAchat.montant = 0;
		}
		
		if(lTotalSolidaire < 0) {
			if(lVo.operationAchatSolidaire == '') {
				var lOperationAchat = new OperationDetailVO();
				lOperationAchat.typePaiement = 8;
				lOperationAchat.idCompte = this.mIdCompte;
				
				// Mode Marché
				if(this.mParam.id_commande > 0) {
					var lChampComplementaire = new ChampComplementaireVO();
					lChampComplementaire.id = 1;
					lChampComplementaire.obligatoire = 0;
					lChampComplementaire.valeur = this.mParam.id_commande;
					lOperationAchat.champComplementaire[1] = lChampComplementaire;
				}
				
				var lChampComplementaire = new ChampComplementaireVO();
				lChampComplementaire.id = 15;
				lChampComplementaire.obligatoire = 1;
				lChampComplementaire.valeur = this.mIdRequete;
				lOperationAchat.champComplementaire[15] = lChampComplementaire;
				
				lVo.operationAchatSolidaire = lOperationAchat;
			}
		
			lVo.operationAchatSolidaire.montant = lTotalSolidaire;
		} else if(lVo.operationAchatSolidaire != ''){
			lVo.operationAchatSolidaire.montant = 0;
		}
		
			
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		var lMontantAffiche = 0; 
		var lTypePaiementAffiche = '';

		if(lMontant == '') {
			lMontant = 0;
		}		
		if(!isNaN(lMontant) ){
			lMontant = parseFloat(lMontant);
			lMontantAffiche = lMontant;
		}
		lMontantAffiche = lMontantAffiche.nombreFormate(2,',',' ');
		
		if(lMontant > 0) {
			var lTypePaiement = $(":input[name=typepaiement]").val();
			if(lTypePaiement != 0) {
				lTypePaiementAffiche = $(":input[name=typepaiement]").selectedTexts();
			}
	
			var lTabChampComplementaire = [];
			if(this.mTypePaiement[lTypePaiement]) {
				var lTypePaiementService = new TypePaiementService();
				lTabChampComplementaire = lTypePaiementService.getChampComplementaire(this.mTypePaiement[lTypePaiement].champComplementaire, 'rechargement');
	
				// Mode Marché
				if(this.mParam.id_commande > 0) {
					var lChampComplementaire = new ChampComplementaireVO();
					lChampComplementaire.id = 1;
					lChampComplementaire.obligatoire = 0;
					lChampComplementaire.valeur = this.mParam.id_commande;
					lTabChampComplementaire[1] = lChampComplementaire;
				}
				
				var lChampComplementaire = new ChampComplementaireVO();
				lChampComplementaire.id = 15;
				lChampComplementaire.obligatoire = 1;
				lChampComplementaire.valeur = this.mIdRequete;
				lTabChampComplementaire[15] = lChampComplementaire;
			}
			
			if(lVo.rechargement == '') {
				lVo.rechargement = new OperationDetailVO();	
				lVo.rechargement.idCompte = this.mIdCompte;
			}
			lVo.rechargement.typePaiement = lTypePaiement;
			lVo.rechargement.champComplementaire = lTabChampComplementaire;
			lVo.rechargement.montant = lMontant;
		} else if(lMontant == 0 && lVo.rechargement != '') { // Suppression du rechargement
			lVo.rechargement.montant = 0;
		}
				
		var lValid = new AchatValid();
		var lVr = lValid.validAjout(lVo);
		
		// Arrêt de la recherche
		$('#input-rechercher').val('');
		that.recherche('');
		
		if(this.mParam.vr && this.mParam.vr != null) {
			this.mParam.vr = null;
		} else {
			Infobulle.init(); // Supprime les erreurs
		}
		if(lVr.valid) {
			// Génération de l'affichage
			// Tri des catégories
			lProduitDetail.sort(function(a,b) {return a.cproNom.localeCompare(b.cproNom);});
			// Tri des produits
			$.each(lProduitDetail,function() {
				if(this.cproNom) {
					this.produits.sort(function(a,b) {return a.nom.localeCompare(b.nom);});
				}
			});
			
			// Les Produits
			var lCaisseTemplate = new CaisseTemplate();
			if(lProduitAchete) { // Affiche le detail uniquement si il y a des produits
				// Si il y a eu un rechargement sans achat mais avec un réservation : Ne pas afficher le détail de la réservation (sinon confusion avec un achat)
				if(this.mModeEdition == 1 && this.mRechargementSansAchatAvecReservation) {
					$('#formulaire-produit').hide();
				} else {
					$('#formulaire-produit').hide().before(lCaisseTemplate.achatHorsMarcheDetailAchat.template({categories:lProduitDetail}));
				}
			} else {
				$('#formulaire-produit').hide();
			}
			$('.ligne-lot-produit').hide();
			
			// Le rechargement
			//$('#select-typePaiement').hide(); // Masque le formulaire
			
			$('#rechargement-affiche').text(lMontantAffiche); // Le Montant
			
			//$('#rechargement-select-affiche').text(lTypePaiementAffiche);
			if(lVo.rechargement == '' || (lVo.rechargement != '' && lVo.rechargement.montant <= 0)) {
				this.afficheChCpAutorise = false;
			}
			
			var lData = {typePaiementAffiche:lTypePaiementAffiche};
			
			var lTypePaiementService = new TypePaiementService();
			var lChampComplementaire = [];
			if(this.mTypePaiement[lVo.rechargement.typePaiement]) {
				$(this.mTypePaiement[lVo.rechargement.typePaiement].champComplementaire).each(function() {				
					var lChamp = $.extend(true,{},lVo.rechargement.champComplementaire[this.id]);
					lChamp.id = this.id;
					lChamp.tppCpVisible = 1;
					lChamp.chCpLabel = this.label;
					lChampComplementaire.push(lChamp);
				});
			}

			lData.champComplementaireAffiche = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, this.mBanques, true);

			$('#form-select-typePaiement').hide().after(lCaisseTemplate.champComplementaireAffiche.template(lData));
			
			// Masque les input pour passer en affichage et change les boutons
			$('.form-produit, #btn-valider, #btn-modifier, #recherche-produit').toggle(); 

			if(this.mModeEdition == 1) {
				this.mModeEdition = 0;
				if(this.mModule == 'GestionCommande') {
					$('#btn-supprimer').show();
				}
			} else {
				$('#btn-enregistrer').show();
			}
			
			this.mAchat = lVo;
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.qteEtPrixAchat = function(pIdNomProduit, pType, pVoProduit) {		
		var lQuantite = parseFloat($('#produits' + pIdNomProduit + 'quantite' + pType ).val().numberFrToDb());
		if(!isNaN(lQuantite)) {
			pVoProduit.quantite = lQuantite * -1;
		}
				
		var lPrix = parseFloat($('#produits' + pIdNomProduit + 'montant'  + pType ).val().numberFrToDb());
		if(!isNaN(lPrix)) {
			pVoProduit.prix = lPrix * -1;
		}		
		return pVoProduit;
	};
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.modifier();
		});
		return pData;
	};
	
	this.modifier = function() {
		$('#btn-enregistrer, #btn-supprimer').hide();
		$('.form-produit, #btn-valider, #btn-modifier, #recherche-produit').toggle(); 
		$('#formulaire-produit, #form-select-typePaiement').show();
		$('#formulaire-produit-detail, #affiche-select-typePaiement').remove();
		
		this.afficheChCpAutorise = true;
	};
	
	this.affectRetour = function(pData) {
		var that = this;
		pData.find('#lien-retour').click(function() {
			if(that.mModule == 'Caisse') {
				CaisseMarcheCommandeVue({"id_commande":that.mParam.id_commande});
			} else if(that.mParam.retour) {
				if(that.mParam.retour == 'Achat') {
					AchatVue({idMarche:that.mParam.id_commande});
				} else if(that.mParam.retour == 'AchatMarche') {
					ListeAchatMarcheVue({id_marche:that.mParam.id_commande});
				}
			}
		});
		return pData;
	};
	
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find('#btn-enregistrer').click(function() {
			that.enregistrerAchat();
		});
		return pData;
	};
	
	this.enregistrerAchat = function() {
		var that = this;
		var lVo = this.mAchat;
		lVo.fonction = "acheter";
		//lVo.idAchat = this.mIdAchat;
		
		$.post(	"./index.php?m=" + this.mModule + "&v=CaisseMarcheCommande","pParam=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour) {
						if(lVoRetour.valid) {
							var lCaisseTemplate = new CaisseTemplate();
							if(that.mModule == 'Caisse') {
								$('#contenu').replaceWith(that.affectRetour($(lCaisseTemplate.achatCommandeSucces)));
							} else if(that.mParam.retour) {
								that.mParam.id = lVoRetour.idAchat;
								that.mParam.vr = new TemplateVR(false, new VRelement(false, [new VRerreur(ERR_314_CODE, ERR_314_MSG)]));
								CaisseVue(that.mParam);
							}
						} else {
							that.modifier();
							Infobulle.generer(lVoRetour,"");
						}
					}
				},"json"
			);
	};	
	
	this.affectSupprimer = function(pData) {
		var that = this;
		pData.find('#btn-supprimer').click(function() {
			var lCaisseTemplate = new CaisseTemplate();
			$(lCaisseTemplate.dialogSuppressionAchat).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lDialog = $(this);
						var lVo = {id:that.mParam.id , fonction:"supprimer"};	
						$.post(	"./index.php?m=GestionCommande&v=CaisseMarcheCommande","pParam=" + $.toJSON(lVo),
							function(lVoRetour) {
								if(lVoRetour) {
									if(lVoRetour.valid) {
										var lVr = new TemplateVR(false, new VRelement(false, [new VRerreur(ERR_315_CODE, ERR_315_MSG)]));
										if(that.mParam.retour == 'Achat') {
											AchatVue({idMarche:that.mParam.id_commande, vr:lVr});
										} else if(that.mParam.retour == 'AchatMarche') {
											ListeAchatMarcheVue({id_marche:that.mParam.id_commande, vr:lVr});
										}
										lDialog.dialog('close');
									} else {
										Infobulle.generer(lVoRetour,"");
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