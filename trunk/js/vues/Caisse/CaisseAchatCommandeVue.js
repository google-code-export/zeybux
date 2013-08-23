;function CaisseAchatCommandeVue(pParam) {
	this.mParam = {};
	this.mSolde = 0;
	this.mIdCompte = 0;
	
	this.mTypePaiement = [];
	this.mBanques = [];
	this.mAdherent = {};
		
	this.mLots = [];
	this.mPrixProduit = [];
	this.mLotAchat = [];
	this.mFocusRechargement = 0;
	this.mCategorie = [];
	this.mNomCategorie = [];
	
	this.mAchat = {};
	this.mIdAchat = [];
	
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CaisseAchatCommandeVue(pParam);}} );
		this.mParam = pParam;
		
		var that = this;
		
		pParam.fonction = "infoAchat"; // Par défaut Adhérent sur Marché
		
		if(pParam.id_adherent == 0) { // compte invité
			this.mIdCompte = -3;
		}
		
		$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {						
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							
							// Les informations pour le paiement
							$(lResponse.typePaiement).each(function() {
								that.mTypePaiement[this.tppId] = this;
								this.selected = '';
							});	
							
							var lTppSelected = 0;
							if(pParam.id_adherent != 0) { // Si pas invité les informations de l'adhérent
								that.mIdCompte = lResponse.adherent.adhIdCompte;
								that.mAdherent = lResponse.adherent;
								that.mSolde = parseFloat(lResponse.adherent.cptSolde);
								
								lResponse.adherent.rechargementMontant = '';
								lResponse.adherent.rechargementChampComplementaire = '';
								lResponse.adherent.rechargementNomBanque = '';
								lResponse.adherent.rechargementIdBanque = '';
								lResponse.adherent.rechargementAfficheChampComplementaire ='ui-helper-hidden';
								if(lResponse.rechargement != null && lResponse.rechargement.id && lResponse.rechargement.id != null) {
									that.mSolde = (parseFloat(that.mSolde) - parseFloat(lResponse.rechargement.montant)).toFixed(2);
									lResponse.adherent.rechargementMontant = lResponse.rechargement.montant.nombreFormate(2,',','');
									lTppSelected = lResponse.rechargement.typePaiement;
									
									if(that.getLabelChamComplementaire(lResponse.rechargement.typePaiement) != null) {
										lResponse.adherent.rechargementAfficheChampComplementaire ='';
										lResponse.adherent.rechargementChampComplementaire = lResponse.rechargement.typePaiementChampComplementaire;
										lResponse.adherent.rechargementIdBanque = lResponse.rechargement.idBanque;
										$(lResponse.banques).each(function() {
											if(this.id == lResponse.rechargement.idBanque) {
												lResponse.adherent.rechargementNomBanque = this.nom;
											}
										});
									}
								}
								
							} else {
								lResponse.adherent = {rechargementMontant:'',rechargementChampComplementaire:'',rechargementNomBanque:'',rechargementIdBanque:'',rechargementAfficheChampComplementaire:'ui-helper-hidden'};
							}
							
							// Sélection du type de paiement
							$(lResponse.typePaiement).each(function() {
								if(this.tppId == lTppSelected) {
									this.selected ="selected=\"selected\"";
								}
							});							
							that.mBanques = lResponse.banques;
							
							lResponse.adherent.total = 0;
							lResponse.adherent.totalAchat = 0;
							lResponse.adherent.totalAchatSolidaire = 0;
							
							if(pParam.id_commande != -1) { // Traitement des produits du marché
								$.each(lResponse.marche.produits, function() {
									if(this.id) {	
										var lIdProduit = this.id;
										var lUnite = this.unite;
										var lProduit = {
												id:this.id,
												nproId:this.idNom,
												nom:this.nom,
												unite:this.unite,
												quantiteReservation:'',
												quantiteAchat:'', prixAchat:'', quantiteAchatAffiche:'', prixAchatAffiche:'',
												quantiteAchatSolidaire:'', prixAchatSolidaire:'', quantiteAchatAfficheSolidaire:'', prixAchatAfficheSolidaire:''};
										
										var lLots = [];
										$.each(this.lots, function() {
											this.mLotPrixUnitaire = (parseFloat(this.prix) / parseFloat(this.taille)).toFixed(2).nombreFormate(2,',',' ');											
											this.tailleAffiche = this.taille.nombreFormate(2,',',' ');
											this.selected = '';	
											
											that.mLots[this.id] = this;
											lLots.sort(function(a,b) {return a.taille.localeCompare(b.taille);});
											lLots.push(this);
										});
										
										var lAfficherCategorie = false;
										if(pParam.id_adherent != 0) { // Si adhérent vérifie la réservation et l'achat
											
										/*	var lAchatReservation = 0;
											var lAchat = 0;*/
																						
											$.each(lResponse.reservation, function() {
												if(this.idProduit == lIdProduit) {
													lProduit.quantiteReservation = (this.quantite * -1).nombreFormate(2,',',' ') + ' ' + lUnite;
													if(lResponse.achats.length == 0) { // Si pas d'achat
														lProduit.quantiteAchat = (this.quantite * -1).nombreFormate(2,',','') ;
														lProduit.prixAchat = (this.montant * -1).nombreFormate(2,',','') ;
														//lAchatReservation = (parseFloat(lAchatReservation) + parseFloat(this.montant) * -1).toFixed(2);
														lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) - parseFloat(this.montant)).toFixed(2);
														that.mLotAchat[lProduit.nproId] = {normal:this.idDetailCommande,solidaire:0};
													}
													lAfficherCategorie = true;
												}
											});
											
											$.each(lResponse.achats, function() {
												if(this.id && this.id.idAchat) {
													that.mIdAchat.push(this.id.idAchat); // Récupération des IdAchat
												}
												$(this.detailAchat).each(function() {
													if(this.idProduit == lIdProduit) {
														lProduit.quantiteAchat = (this.quantite * -1).nombreFormate(2,',','') ;
														lProduit.prixAchat = (this.montant * -1).nombreFormate(2,',','') ;
														lProduit.quantiteAchatAffiche = (this.quantite * -1).nombreFormate(2,',',' ') ;
														lProduit.prixAchatAffiche = (this.montant * -1).nombreFormate(2,',',' ') ;
														//lAchat = (parseFloat(lAchat) + parseFloat(this.montant) * -1).toFixed(2);
														lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) - parseFloat(this.montant)).toFixed(2);
														lAfficherCategorie = true;
														that.mSolde = (parseFloat(that.mSolde) - parseFloat(this.montant)).toFixed(2);
														
														if(that.mLotAchat[lProduit.nproId]) {
															that.mLotAchat[lProduit.nproId].normal = this.idDetailCommande;
														} else {
															that.mLotAchat[lProduit.nproId] = {normal:this.idDetailCommande,solidaire:''};
														}
													}
												});
												
												$(this.detailAchatSolidaire).each(function() {
													if(this.idProduit == lIdProduit) {
														lProduit.quantiteAchatSolidaire = (this.quantite * -1).nombreFormate(2,',','') ;
														lProduit.prixAchatSolidaire = (this.montant * -1).nombreFormate(2,',','') ;
														lProduit.quantiteAchatAfficheSolidaire = (this.quantite * -1).nombreFormate(2,',',' ') ;
														lProduit.prixAchatAfficheSolidaire = (this.montant * -1).nombreFormate(2,',',' ') ;
														lResponse.adherent.totalAchatSolidaire = (parseFloat(lResponse.adherent.totalAchatSolidaire) - parseFloat(this.montant)).toFixed(2);
														lAfficherCategorie = true;
														that.mSolde = (parseFloat(that.mSolde) - parseFloat(this.montant)).toFixed(2);
														
														if(that.mLotAchat[lProduit.nproId]) {
															that.mLotAchat[lProduit.nproId].solidaire = this.idDetailCommande;
														} else {
															that.mLotAchat[lProduit.nproId] = {normal:'',solidaire:this.idDetailCommande};
														}
													}
												});
											});
											
											
											
											/*if(lAchat == 0) {// Si pas d'achat affiche le total réservation
												lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(lAchatReservation)).toFixed(2);
											} else {
												lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(lAchat)).toFixed(2);
											}*/
											
											lResponse.adherent.total = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(lResponse.adherent.totalAchatSolidaire)).toFixed(2);
										}
										
										if(!that.mCategorie[this.idCategorie]) {											
											var lInfoCategorie = {
													cproId:this.idCategorie,
													cproNom:this.cproNom,
													visible:'ui-helper-hidden',
													produits:[]};
											
											that.mCategorie[this.idCategorie] = lInfoCategorie;
											that.mNomCategorie[this.idCategorie] = lInfoCategorie;
										}
										
										// Affiche la catégorie si il y a un achat ou reservation
										if(lAfficherCategorie) {
											that.mCategorie[this.idCategorie].visible = '';
										}
										
										that.mCategorie[this.idCategorie].produits[this.idNom] = lProduit;
										lProduit.lots = lLots;
										that.mPrixProduit[this.idNom] = lProduit;	
									}
								});
							}
							
							// Ajout des produits en stock
							
							var lIdProduitEnStock = -1;
							$.each(lResponse.stock, function() {
								if(this.idNom) {
									var lNproId = this.idNom;
									var lProduitMarche = false;
																		
									if(pParam.id_commande != -1) { // Si c'est un marché priorité aux produits du marché
										$.each(lResponse.marche.produits, function() {
											if(this.id && this.idNom == lNproId) {
												lProduitMarche = true;
											}
										});
									}
									
									if(!lProduitMarche) {
										var lLots = [];
										$.each(this.lots, function() {
											this.mLotPrixUnitaire = (parseFloat(this.prix) / parseFloat(this.taille)).toFixed(2).nombreFormate(2,',',' ');											
											this.tailleAffiche = this.taille.nombreFormate(2,',',' ');
											this.selected = '';	
											
											that.mLots[this.id] = this;
											lLots.push(this);
										});
									
										if(!that.mCategorie[this.idCategorie]) {
											var lInfoCategorie = {
													cproId:this.idCategorie,
													cproNom:this.cproNom,
													visible:'ui-helper-hidden',
													produits:[]};
											
											that.mCategorie[this.idCategorie] = lInfoCategorie;
											that.mNomCategorie[this.idCategorie] = lInfoCategorie;
										}
										
										var lProduit = {
												id:lIdProduitEnStock,
												nproId:this.idNom,
												nom:this.nom,
												unite:this.unite,
												quantiteReservation:'',
												quantiteAchat:'', prixAchat:'', quantiteAchatAffiche:'', prixAchatAffiche:'',
												quantiteAchatSolidaire:'', prixAchatSolidaire:'', quantiteAchatAfficheSolidaire:'', prixAchatAfficheSolidaire:''};	
										
										that.mCategorie[this.idCategorie].produits[this.idNom] = lProduit;	
										
										lLots.sort(function(a,b) {return a.taille.localeCompare(b.taille);});
										lProduit.lots = lLots;
										that.mPrixProduit[this.idNom] = lProduit;	
										lIdProduitEnStock--;
									}
								}
							});
							
							// Tri des catégories
							that.mCategorie.sort(function(a,b) {return a.cproNom.localeCompare(b.cproNom);});
							// Tri des produits
							$.each(that.mCategorie,function() {
								if(this.cproNom) {
									this.produits.sort(function(a,b) {return a.nom.localeCompare(b.nom);});
								}
							});
							
							if(pParam.id_commande != -1) { // Si marché test si achat
								if(lResponse.achats.length > 0 || (lResponse.rechargement !=null && lResponse.rechargement.id != null)) { // Si il y a eu un achat ou un rechargement affiche le résumé
									that.afficher(lResponse, that.recapitulatifAchat);
								} else { // Sinon affiche le formulaire
									that.afficher(lResponse);
								}
							} else { // Hors marché affiche le formulaire
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

		var lData = {categories:this.mCategorie, sigleMonetaire: gSigleMonetaire};
		pResponse.adherent.sigleMonetaire = gSigleMonetaire;
		pResponse.adherent.typePaiement = pResponse.typePaiement;

		pResponse.adherent.total = pResponse.adherent.total.nombreFormate(2,',',' ');
		pResponse.adherent.totalAchat = pResponse.adherent.totalAchat.nombreFormate(2,',',' ');
		pResponse.adherent.totalAchatSolidaire = pResponse.adherent.totalAchatSolidaire.nombreFormate(2,',',' ');
		if(this.mParam.id_adherent != 0) { // Les informations de l'adhérent si ce n'est pas un compte invité		
			
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
		}
		lData.infoAdherent = lCaisseTemplate.achatInfoAdherent.template(pResponse.adherent);
		
		var lHtml = '';
		if(pParam.id_commande != -1) { // Formulaire Marché
			lHtml = lCaisseTemplate.achatMarcheFormulaire.template(lData);
		} else { // Formulaire Caisse permanente
			lHtml = lCaisseTemplate.achatHorsMarcheFormulaire.template(lData);
		}
		
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
		pData = this.affectListeBanque(pData);
		pData = this.affectValider(pData);
		pData = this.affectModifier(pData);
		pData = this.affectToggleTableauCategorie(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectRetour(pData);
		pData = this.affectEnregistrer(pData);
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
			var lNproId = $(this).data('id-nom-produit');
			var lIdCategorie = $(this).data('id-categorie');
			
			var lVoProduit = new ProduitAchatVO();
			var lVoProduitSolidaire = new ProduitAchatVO();
			
			lVoProduit = that.qteEtPrixAchat(lNproId, '', lVoProduit);
			lVoProduitSolidaire = that.qteEtPrixAchat(lNproId, 'Solidaire', lVoProduitSolidaire);
			
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
			var lNproId = $(this).data('id-nom-produit');
			var lType = $(this).data('type');
			
			if($('#select-' + lNproId + lType).length == 0) {// Si le select est déjà affiché il ne faut pas le réinitialiser			
				var lProduit = that.mPrixProduit[lNproId];
				
				lProduit.prixUnitaire = lProduit.lots[0].mLotPrixUnitaire;

				if(lProduit.lots.length == 1) {
					lProduit.lotAffiche = lCaisseTemplate.achatMarcheAfficheLot.template({	id:lProduit.lots[0].id,
																						tailleAffiche:lProduit.lots[0].tailleAffiche,
																						unite:lProduit.unite,
																						});
				} else {
					if(that.mLotAchat[lNproId]) {
						var lIdLot = 0;
						if(lType == '') {
							lIdLot = that.mLotAchat[lNproId].normal;
						} else {
							lIdLot = that.mLotAchat[lNproId].solidaire;
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
		}).blur(function() { // Masque automaiquement en sortie si il n'y a qu'un lot
			var lNproId = $(this).data('id-nom-produit');
			if(that.mPrixProduit[lNproId].lots.length == 1) {
				$('.ligne-lot-produit').hide();
			}
		}).keyup(function() {
			var lNproId = $(this).data('id-nom-produit');
			var lType = $(this).data('type');
			var lIdLot = 0;
			if(that.mPrixProduit[lNproId].lots.length == 1) {
				lIdLot = that.mPrixProduit[lNproId].lots[0].id;
			} else {
				lIdLot = that.mLots[$('#select-' + lNproId + lType).val()].id;
			}
			
			if(that.mLotAchat[lNproId]) {
				if(lType == '') {
					that.mLotAchat[lNproId].normal = lIdLot;	
				} else {
					that.mLotAchat[lNproId].solidaire = lIdLot;	
				}				
			} else {
				if(lType == '') {
					that.mLotAchat[lNproId] = {normal:lIdLot,solidaire:0};
				} else {
					that.mLotAchat[lNproId] = {normal:0,solidaire:lIdLot};
				}
			}
		});
				
		return pData;
	};
		
	this.affectCalculPrix = function(pData) {
		var that = this;
		pData.find('.produit-quantite, .produit-quantite-solidaire').keyup(function() {
			that.calculPrix($(this).data('id-nom-produit'), $(this).data('type') ,  $(this).val());
		});
		return pData;
	};
	
	this.calculPrix = function(pIdNomProduit, pType, pQuantite) {
		var lLot = {};
		if(this.mPrixProduit[pIdNomProduit].lots.length == 1) {
			lLot = this.mPrixProduit[pIdNomProduit].lots[0];
		} else {
			lLot = this.mLots[$('#select-' + pIdNomProduit + pType).val()];
		}
		
		pQuantite = parseFloat(pQuantite.numberFrToDb());
		var lPrix = '';
		if(!isNaN(pQuantite)) {
			lPrix =  (parseFloat(pQuantite) * parseFloat( lLot.prix) /  parseFloat(lLot.taille)  ).toFixed(2).nombreFormate(2,',','');
		}
		$('#produits' + pType + pIdNomProduit + 'prix' ).val(lPrix);
	};
		
	this.affectChangeLot = function(pData) {
		var that = this;
		pData.find('.select-lot').change(function() {
			var lIdNomProduit = $(this).data('id-nom-produit');
			var lType= $(this).data('type'); 
			var lIdLot = $(this).val();
			
			// Raz quantité et prix 
			$('#produits' + lType + lIdNomProduit + 'quantite' + ', #produits' + lType + lIdNomProduit + 'prix' ).val('');
			// Maj Prix unitaire
			$('#prix-unitaire-' + lIdNomProduit).text(that.mLots[lIdLot].mLotPrixUnitaire);
			
		});
		return pData;
	};
		
	this.affectPositionInfoAdherent = function(pData) {
		var timeout = null;
		var entryShare = pData.find('#info-adherent-widget').first();
		var entryContent = pData.find('.tableau-liste-produit').first();
				
		$(window).scroll(function () {
		  var scrollTop = $(this).scrollTop();
		  if(!timeout) {
			timeout = setTimeout(function() {
			  timeout = null;
			  if (entryShare.css('position') !== 'fixed' && entryShare.offset().top < $(document).scrollTop()) {
				entryContent.css('margin-top', entryShare.outerHeight() + 10 );
				entryShare.css({'z-index': 999, 'position': 'fixed', 'top': 0, 'width': entryContent.width(), 'box-shadow': '0 0 20px #555'})
							.removeClass('ui-corner-all').addClass('ui-corner-bottom');
			  } else if ($(document).scrollTop() <= entryContent.offset().top) {
				  
				entryContent.css('margin-top', '');
				entryShare.css({ 'position': '', 'z-index': '', 'width': '', 'box-shadow':''})
							.removeClass('ui-corner-bottom').addClass('ui-corner-all');
				
			  }
			}, 250);
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
			
			var lSolde = (parseFloat(that.mSolde) - lTotal + lRechargement).toFixed(2);
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
		
		pData.find('#rechargementmontant, #rechargementtypePaiement, #rechargementchampComplementaire, #rechargementidBanque').focus(function() {
			that.mFocusRechargement++;
			$('#select-typePaiement').show();
			lCelluleRecharger.removeClass('ui-corner-all').addClass('ui-corner-top');
		}).blur(function() {
			that.mFocusRechargement--;
			if(that.mFocusRechargement == 0) {
				$('#select-typePaiement').hide();
				lCelluleRecharger.removeClass('ui-corner-top').addClass('ui-corner-all');
			}
		});
		
		pData.find('#ligne-rechargement').hover(function() {
			that.mFocusRechargement++;
			$('#select-typePaiement').show();
			lCelluleRecharger.removeClass('ui-corner-all').addClass('ui-corner-top');
		},function() {
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
		return pData;
	};
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel).show();
			$("#form-champ-complementaire").show();
		} else {
			$("#label-champ-complementaire").text('').hide();
			
			$(':input[name="champ-complementaire"], :input[name="champ-complementaire-banque"]').val('');
			$("#form-champ-complementaire").hide();
			$('#rechargementidBanque').attr('id-banque','');
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
	
	this.affectListeBanque = function(pData) {
		var that = this;
		
		function removeIfInvalid(element) {
			// Vide le champ si la banque n'existe pas
			var value = $( element ).val(),
			matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
			valid = false;
			$( that.mBanques ).each(function() {
				if ( $( this ).text().match( matcher ) ) {
					this.selected = valid = true;
					return false;
				}
			});
			if ( !valid ) {
				$( element ).attr( 'id-banque','' ); 
				
				// Message d'information
				var lVr = new RechargementCompteVR();
				lVr.valid = false;
				lVr.idBanque.valid = false;
				var erreur = new VRerreur();
				erreur.code = ERR_261_CODE;
				erreur.message = ERR_261_MSG;
				lVr.idBanque.erreurs.push(erreur);
				
				Infobulle.generer(lVr,'');
				return false;
			}
		};
		
		pData.find('#rechargementidBanque').autocomplete({
			minLength: 0,			 
			source: function( request, response ) {
				var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
					response( $.grep( that.mBanques, 
						function( item ){
							return matcher.test( item.nom ) || matcher.test( item.nomCourt );
						}
					));
			},	 
			focus: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				$( "#rechargementidBanque" ).val( htmlDecode(ui.item.nom) );
				return false;
			},
			select: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				$( "#rechargementidBanque" ).val( htmlDecode(ui.item.nom) );
				$( "#rechargementidBanque" ).attr('id-banque', ui.item.id );
				return false;
			},
			change: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				if ( !ui.item )
					return removeIfInvalid( this );
			}
		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li>" )
			.data( "item.autocomplete", item )
			.append( "<a>" + item.nomCourt + " : " + item.nom + "<br>" + item.description + "</a>" )
			.appendTo( ul );
		};
		
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
		var lVo = new AchatCommandeVO();
		lVo.id = this.mParam.id_commande;
		lVo.idCompte = this.mIdCompte;
				
		var lProduitDetail = [];
		var lProduitAchete = false;
		// Les Produits
		$('.ligne-produit').each(function() {
			var lIdProduit = $(this).data('id-produit');
			var lNproId = $(this).data('id-nom-produit');
			var lIdCategorie = $(this).data('id-categorie');
			
			var lVoProduit = new ProduitAchatVO();
			var lVoProduitSolidaire = new ProduitAchatVO();
			lVoProduit.id = lIdProduit;		
			lVoProduitSolidaire.id = lIdProduit;
			lVoProduit.nproId = lNproId;		
			lVoProduitSolidaire.nproId = lNproId;
			
			if(that.mLotAchat[lNproId]) {
				if(lIdProduit > 0) { // Produit du marche
					lVoProduit.dcomId = that.mLotAchat[lNproId].normal;		
					lVoProduitSolidaire.dcomId = that.mLotAchat[lNproId].solidaire;
				} else { // Produit en stock
					lVoProduit.lotId = that.mLotAchat[lNproId].normal;		
					lVoProduitSolidaire.lotId = that.mLotAchat[lNproId].solidaire;				
				}
			}
			lVoProduit = that.qteEtPrixAchat(lNproId, '', lVoProduit);
			lVoProduitSolidaire = that.qteEtPrixAchat(lNproId, 'Solidaire', lVoProduitSolidaire);
			
			var lInfoProduit = that.mPrixProduit[lNproId];
			
			var lAchatProduit = false;
			if(lVoProduit.quantite != '' || lVoProduit.prix != '') {
				lVo.produits.push(lVoProduit);
				lAchatProduit = true;
				lProduitAchete = true;
			}
			
			var lAchatProduitSolidaire = false;
			if(lVoProduitSolidaire.quantite != '' || lVoProduitSolidaire.prix != '') {
				lVo.produitsSolidaire.push(lVoProduitSolidaire);
				lAchatProduitSolidaire = true;
				lProduitAchete = true;
			}
			
			if(lAchatProduit || lAchatProduitSolidaire) {
				if(!lProduitDetail[lIdCategorie]) {
					lProduitDetail[lIdCategorie] = {cproNom:that.mNomCategorie[lIdCategorie].cproNom,produits:[]};
				}
				
				lProduitDetail[lIdCategorie].produits[lNproId] = {
						nom:lInfoProduit.nom,
						quantite:'',prix:'',quantiteSolidaire:'',prixSolidaire:'',
						unite:'',uniteSolidaire:'',sigleMonetaire:'',sigleMonetaireSolidaire:''};
				
				if(lAchatProduit) {
					lProduitDetail[lIdCategorie].produits[lNproId].quantite = (lVoProduit.quantite * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].unite = lInfoProduit.unite;
					lProduitDetail[lIdCategorie].produits[lNproId].prix = (lVoProduit.prix * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].sigleMonetaire = gSigleMonetaire;
				} 
				if(lAchatProduitSolidaire) {
					lProduitDetail[lIdCategorie].produits[lNproId].quantiteSolidaire = (lVoProduitSolidaire.quantite * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].uniteSolidaire = lInfoProduit.unite;
					lProduitDetail[lIdCategorie].produits[lNproId].prixSolidaire = (lVoProduitSolidaire.prix * -1).nombreFormate(2,',',' ');	
					lProduitDetail[lIdCategorie].produits[lNproId].sigleMonetaireSolidaire = gSigleMonetaire;
				}
			}
			
		});
		// Tri des catégories
		lProduitDetail.sort(function(a,b) {return a.cproNom.localeCompare(b.cproNom);});
		// Tri des produits
		$.each(lProduitDetail,function() {
			if(this.cproNom) {
				this.produits.sort(function(a,b) {return a.nom.localeCompare(b.nom);});
			}
		});
				
		var lRechargementVo = new RechargementCompteVO();		
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		var lMontantAffiche = 0; 
		var lTypePaiementAffiche = '';
		var lChampComplementaireAffiche = '';
		var lBanqueAffiche = '';
		
		lRechargementVo.id = this.mIdCompte;

		if(!isNaN(lMontant) && !lMontant.isEmpty() && lMontant != 0){
			lMontant = parseFloat(lMontant);
			lRechargementVo.montant = lMontant;
			lMontantAffiche = lMontant;
		}
		lMontantAffiche = lMontantAffiche.nombreFormate(2,',',' ');
		
		lRechargementVo.typePaiement = $(":input[name=typepaiement]").val();
		if(lRechargementVo.typePaiement != 0) {
			lTypePaiementAffiche = $(":input[name=typepaiement]").selectedTexts();
		}
		
		if(this.getLabelChamComplementaire(lRechargementVo.typePaiement) != null) {
			lRechargementVo.champComplementaireObligatoire = 1;
			lRechargementVo.champComplementaire = $(":input[name=champ-complementaire]").val();
			lChampComplementaireAffiche = lRechargementVo.champComplementaire;
		} else {
			lRechargementVo.champComplementaireObligatoire = 0;
		}
		// Si id-banque est alimenté mais qu'on efface le nom de la banque par la suite
		// il ne faut pas prendre en compte le id-banque
		if($('#idBanque').val() != "") {
			lRechargementVo.idBanque = $('#rechargementidBanque').attr('id-banque');
			lBanqueAffiche = $('#rechargementidBanque').val();
		}
		lVo.rechargement = lRechargementVo;	
				
		var lValid = new AchatCommandeValid();
		var lVr = new AchatCommandeVR();
		if(pParam.id_adherent != 0) {
			lVr = lValid.validAjout(lVo);
		} else {// Invite
			lVr = lValid.validAjoutInvite(lVo);
		}
		
		// Arrêt de la recherche
		$('#input-rechercher').val('');
		that.recherche('');
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			// Génération de l'affichage
			// Les Produits
			var lCaisseTemplate = new CaisseTemplate();
			if(lProduitAchete) { // Affiche le detail uniquement si il y a des produits
				$('#formulaire-produit').hide().before(lCaisseTemplate.achatHorsMarcheDetailAchat.template({categories:lProduitDetail}));
			} else {
				$('#formulaire-produit').hide();
			}
			$('.ligne-lot-produit').hide();
			
			// Le rechargement
			$('#rechargement-affiche').text(lMontantAffiche);
			$('#rechargement-select-affiche').text(lTypePaiementAffiche);
			$('#rechargement-champ-complementaire-affiche').text(lChampComplementaireAffiche);
			$('#rechargement-banque-affiche').text(lBanqueAffiche);
			if(lRechargementVo.typePaiement == 0) {
				$('#label-type-paiement').hide();
			}
			// Masque les input pour passer en affichage et change les boutons
			$('.form-produit, #btn-valider, #btn-modifier, #btn-enregistrer, #recherche-produit').toggle(); 
			
			this.mAchat = lVo;
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.qteEtPrixAchat = function(pIdNomProduit, pType, pVoProduit) {		
		var lQuantite = parseFloat($('#produits' + pType + pIdNomProduit + 'quantite' ).val().numberFrToDb());
		if(!isNaN(lQuantite)) {
			pVoProduit.quantite = lQuantite * -1;
		}
				
		var lPrix = parseFloat($('#produits' + pType + pIdNomProduit + 'prix' ).val().numberFrToDb());
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
		$('.form-produit, #btn-valider, #btn-modifier, #btn-enregistrer, #recherche-produit').toggle(); 
		$('#formulaire-produit, #label-type-paiement').show();
		$('#formulaire-produit-detail').remove();
	};
	
	this.affectRetour = function(pData) {
		var that = this;
		pData.find('#lien-retour').click(function() {
			CaisseMarcheCommandeVue({"id_commande":that.mParam.id_commande});
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
		lVo.idAchat = this.mIdAchat;
		
		$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour) {
						if(lVoRetour.valid) {
							var lCaisseTemplate = new CaisseTemplate();
							$('#contenu').replaceWith(that.affectRetour($(lCaisseTemplate.achatCommandeSucces)));
						} else {
							var lAchatExiste = false;
							$(lVoRetour.log.erreurs).each(function() {
								if(this.code == 263) { lAchatExiste = true; }
							});
							// Erreur 263 : il y a déjà un achat sur le marché : on affiche le détail de cet achat en modification pour éviter un doublon d'achat.
							if(lAchatExiste) {
								CaisseAchatCommandeVue({id_commande:that.idCommande, id_adherent:that.idAdherent, vr:lVoRetour});
							} else {
								that.modifier();
								Infobulle.generer(lVoRetour,"");
							}
						}
						that.etapeValider = 0;
					}
				},"json"
			);
	};
	
	
	
	/*this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.mListeLot = [];
	this.mListeLotSolidaire = [];
	this.mTypePaiement = [];
	this.solde = null;
	this.etapeValider = 0;
	this.total = 0;
	this.totalSolidaire = 0;
	this.mAdherent = null;
	
	this.mAchatOuReservation = [];
	this.mReservation = [];
	
	this.pdtCommande = [];
	this.mBanques = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CaisseAchatCommandeVue(pParam);}} );
		var that = this;
		this.idCommande = pParam.id_commande;
		this.idAdherent = pParam.id_adherent;

		if(this.idAdherent == 0) { // compte invité
			that.idCompte = -3;			
			pParam.fonction = "infoMarche";
			$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(pParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {						
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								
								that.pdtCommande = lResponse.marche.produits;			
								
								$(lResponse.typePaiement).each(function() {
									that.mTypePaiement[this.tppId] = this;
								});
								that.mBanques = lResponse.banques;
								that.solde = 0;
								that.afficher(lResponse);
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		} else {	
			pParam.fonction = "infoAchat";
			$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(pParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {						
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								that.idCompte = lResponse.adherent.adhIdCompte;
								that.pdtCommande = lResponse.marche.produits;	
								
								
									
								$(lResponse.typePaiement).each(function() {
									that.mTypePaiement[this.tppId] = this;
								});
								that.mBanques = lResponse.banques;
								that.mAdherent = lResponse.adherent;
								that.solde = parseFloat(lResponse.adherent.cptSolde);

								that.mReservation = lResponse.reservation;
								if(lResponse.achats.length > 0) {
									that.mAchatOuReservation = lResponse.achats;
									that.afficherDetailAchat(lResponse);
								} else {
									if(lResponse.reservation.length > 0) {
										that.mAchatOuReservation = lResponse.reservation;		
									}
									that.afficher(lResponse);
								}
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		}
	};
	
	this.afficher = function(pResponse) {
	
			var that = this;
			var lCaisseTemplate = new CaisseTemplate();
			
			var lData = new Object();
			lData.comNumero = pResponse.marche.numero;
			
			if(this.idAdherent != 0) {
				lData.adhNumero = pResponse.adherent.adhNumero;
				lData.adhCompte = pResponse.adherent.cptLabel;
				lData.adhNom = pResponse.adherent.adhNom;
				lData.adhPrenom = pResponse.adherent.adhPrenom;
			} else {
				lData.adhNumero = "ZZ";
				lData.adhCompte = "CC";
				lData.adhNom = "Invité";
			}
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			
		//	lData.produits = [];
		//	lData.categories = [];
		//	lData.produitsSolidaire = new Array();
		//	lData.categoriesSolidaire = [];
			
			
			var lIdCategorie = 0;
			var lNomCategorie = '';
			var lCategoriesTrie = [];
			var lProduits = [];
			var lIdCategorieSol = 0;
			var lNomCategorieSol = '';
			var lCategoriesTrieSol = [];
			var lProduitsSol = [];
			
			
			$.each(that.pdtCommande,function() {
				if(this.id) {
					
					
					
					var lProduitCommande = this;
					var lProduit = {};
					lProduit.proId = this.id;
					lProduit.nproNom = this.nom;
					lProduit.proUniteMesure = this.unite;
					lProduit.stoQuantite = "";
					lProduit.proPrix = "";
					lProduit.lot = [];
	

					lProduit.stoQuantiteReservation = '';
					lProduit.proUniteMesureReservation = '';
					
					var lPrix = 0;
					$.each(this.lots, function() {
						if(this.id) {
							
							
							var lLot = {};
							lLot.dcomId = this.id;
							lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
							lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
							lPrix = parseFloat(this.prix);
							lStoQuantite = parseFloat(this.taille);

							$(that.mAchatOuReservation).each(function() {
								if(this.idDetailCommande == lLot.dcomId) {
									lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',','');
									
									lPrix = this.montant * -1;									
									lProduit.proPrix = lPrix.nombreFormate(2,',','');
									lLot.prixReservation = lPrix;
									
									that.mListeLot.push({idPdt:lProduit.proId,idLot:lLot.dcomId});
								}											
							});
							$(that.mReservation).each(function() {
								if(this.idDetailCommande == lLot.dcomId) {									
									lProduit.stoQuantiteReservation = (this.quantite * -1).nombreFormate(2,',',' ');
									lProduit.proUniteMesureReservation = lProduit.proUniteMesure;
								}											
							});
							
							lProduit.prixUnitaire = (lPrix / lStoQuantite).toFixed(2).nombreFormate(2,',',' '); 						
																	
							lProduit.lot.push(lLot);
						}
					});
					lData.total += lPrix;
					
					lProduit.flagType = "";
					if(this.type == 2) {
						lProduit.flagType = lCaisseTemplate.flagAbonnement;
					}
					
					if(this.type == 0 || this.type == 2) {
						
						if(lIdCategorie == 0) {
							lIdCategorie = this.idCategorie;
							lNomCategorie = this.cproNom;
						}
						
						if(lIdCategorie != this.idCategorie) {
							lCategoriesTrie.push({
									nom:lNomCategorie,
									produits:lProduits
								});			
							lIdCategorie = this.idCategorie;
							lNomCategorie = this.cproNom;
							lProduits = [];
						} 
						lProduits.push(lProduit);
						
					}

					var lProduitSolidaire = {};
					lProduitSolidaire.proId = this.id;
					lProduitSolidaire.nproNom = this.nom;
					lProduitSolidaire.proUniteMesure = this.unite;
					lProduitSolidaire.stoQuantite = "";
					lProduitSolidaire.proPrix = "";
					lProduitSolidaire.lot = lProduit.lot;
					lProduitSolidaire.flagType = lProduit.flagType;
					lProduitSolidaire.prixUnitaire = lProduit.prixUnitaire;
					
					var lIdNomProduit = this.idNom;
					
					
					$(pResponse.stockSolidaire).each(function() {
						if(lProduit.proUniteMesure == this.unite && this.idNomProduit == lIdNomProduit && this.quantiteSolidaire > 0){
						
							if(lIdCategorieSol == 0) {
								lIdCategorieSol = lProduitCommande.idCategorie;
								lNomCategorieSol = lProduitCommande.cproNom;
							}
							
							if(lIdCategorieSol != lProduitCommande.idCategorie) {
								lCategoriesTrieSol.push({
										nom:lNomCategorieSol,
										produits:lProduitsSol
									});			
								lIdCategorieSol = lProduitCommande.idCategorie;
								lNomCategorieSol = lProduitCommande.cproNom;
								lProduitsSol = [];
							} 
							
							lProduitsSol.push(lProduitSolidaire);
						}
					});
				}
			});
						
			lData.typePaiement = that.mTypePaiement;
			
			
			// Ajout de la dernière catégorie
			lCategoriesTrie.push({
				nom:lNomCategorie,
				produits:lProduits
			});	
			lCategoriesTrieSol.push({
				nom:lNomCategorieSol,
				produits:lProduitsSol
			});
			
			lData.categories = lCategoriesTrie;
			lData.categoriesSolidaire = lCategoriesTrieSol;
			
			
			lData.adhSolde = this.solde;
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');

			if(this.idAdherent != 0) {
				lData.total = lData.total.nombreFormate(2,',',' ');
				that.total = lData.total;
			} else {
				lData.total = "0".nombreFormate(2,',',' ');	
			}
			
			lData.detailMarcheVisible = "ui-helper-hidden";

			lData.totalSolidaire = "0".nombreFormate(2,',',' ');
			var lHtml = { formulaire : lCaisseTemplate.achatMarcheFormulaire.template(lData),
							detail : lCaisseTemplate.achatMarcheDetail.template(lData) };

			
			
			$('#contenu').replaceWith( that.affect($(lCaisseTemplate.achatMarchePage.template(lHtml))) );
			
			that.changerTypePaiement($(":input[name=typepaiement]"));
			that.majNouveauSolde();

	};
	
	this.afficherDetailAchat = function(pResponse) {
	
			this.etapeValider = 1;
			
			var that = this;
			var lCaisseTemplate = new CaisseTemplate();
			
			var lData = new Object();
			lData.comNumero = pResponse.marche.numero;
			
			if(this.idAdherent != 0) {
				lData.adhNumero = pResponse.adherent.adhNumero;
				lData.adhCompte = pResponse.adherent.cptLabel;
				lData.adhNom = pResponse.adherent.adhNom;
				lData.adhPrenom = pResponse.adherent.adhPrenom;
			} else {
				lData.adhNumero = "ZZ";
				lData.adhCompte = "CC";
				lData.adhNom = "Invité";
			}
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			lData.totalSolidaire = 0;
			
		//	lData.produits = [];
		//	lData.categories = [];
		//	lData.produitsSolidaire = new Array();
		//	lData.categoriesSolidaire = [];
		//	lData.categoriesAchat = [];
		//	lData.categoriesSolidaireAchat = [];
			
			var lIdCategorie = 0;
			var lNomCategorie = '';
			var lCategoriesTrie = [];
			var lProduits = [];
			
			var lIdCategorieSol = 0;
			var lNomCategorieSol = '';
			var lCategoriesTrieSol = [];
			var lProduitsSol = [];
			
			var lIdCategorieAchat = 0;
			var lNomCategorieAchat = '';
			var lCategoriesTrieAchat = [];
			var lProduitsAchat = [];
			
			var lIdCategorieAchatSol = 0;
			var lNomCategorieAchatSol = '';
			var lCategoriesTrieAchatSol = [];
			var lProduitsAchatSol = [];
			
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lProduitCommande = this;
					var lProduit = {};
					lProduit.proId = this.id;
					lProduit.nproNom = this.nom;
					lProduit.proUniteMesure = this.unite;
					lProduit.stoQuantite = "";
					lProduit.stoQuantiteAffiche = "";
					lProduit.proPrix = "";
					lProduit.proPrixAffiche = "";
					lProduit.lot = [];

					lProduit.stoQuantiteReservation = '';
					lProduit.proUniteMesureReservation = '';
					
					var lPrix = 0;
					var lPrixProduit = 0;
					$.each(this.lots, function() {
						if(this.id) {
							var lLot = {};
							lLot.dcomId = this.id;
							lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
							lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
							lPrix = parseFloat(this.prix);
							lPrixProduit = parseFloat(this.prix);
							lStoQuantite = parseFloat(this.taille);

							$(that.mAchatOuReservation).each(function() {
								$(this.detailAchat).each(function() {
									if(this.idDetailCommande == lLot.dcomId) {
										lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',','');
										lProduit.stoQuantiteAffiche = (this.quantite * -1).nombreFormate(2,',',' ');
										
										lPrix = this.montant * -1;									
										lProduit.proPrix = lPrix.nombreFormate(2,',','');		
										lProduit.proPrixAffiche = lPrix.nombreFormate(2,',',' ');
										lLot.prixReservation = lPrix;
										
										that.mListeLot.push({idPdt:lProduit.proId,idLot:lLot.dcomId});
										
										
										
										if(lIdCategorieAchat == 0) {
											lIdCategorieAchat = lProduitCommande.idCategorie;
											lNomCategorieAchat = lProduitCommande.cproNom;
										}
										
										if(lIdCategorieAchat != lProduitCommande.idCategorie) {
											lCategoriesTrieAchat.push({
													nom:lNomCategorieAchat,
													produits:lProduitsAchat
												});			
											lIdCategorieAchat = lProduitCommande.idCategorie;
											lNomCategorieAchat = lProduitCommande.cproNom;
											lProduitsAchat = [];
										} 
										lProduitsAchat.push(lProduit);

										lData.total += lPrix;
									}
								});
							});
							$(that.mReservation).each(function() {
								if(this.idDetailCommande == lLot.dcomId) {
									lProduit.stoQuantiteReservation = (this.quantite * -1).nombreFormate(2,',',' ');
									lProduit.proUniteMesureReservation = lProduit.proUniteMesure;
								}											
							});
							
							lProduit.prixUnitaire = (lPrixProduit / lStoQuantite).toFixed(2).nombreFormate(2,',',' '); 						
																	
							lProduit.lot.push(lLot);						
						}
					});
					
					lProduit.flagType = "";
					if(this.type == 2) {
						lProduit.flagType = lCaisseTemplate.flagAbonnement;
					}
					
					if(this.type == 0 || this.type == 2) {
						
						if(lIdCategorie == 0) {
							lIdCategorie = this.idCategorie;
							lNomCategorie = this.cproNom;
						}
						
						if(lIdCategorie != this.idCategorie) {
							lCategoriesTrie.push({
									nom:lNomCategorie,
									produits:lProduits
								});			
							lIdCategorie = this.idCategorie;
							lNomCategorie = this.cproNom;
							lProduits = [];
						} 
						lProduits.push(lProduit);
					}

					
					var lProduit = {};
					lProduit.proId = this.id;
					lProduit.nproNom = this.nom;
					lProduit.proUniteMesure = this.unite;
					lProduit.stoQuantiteAffiche = "";
					lProduit.stoQuantite = "";					
					lProduit.proPrixAffiche = "";
					lProduit.proPrix = "";
					lProduit.lot = [];

					
					lProduit.flagType = "";
					if(this.type == 2) {
						lProduit.flagType = lCaisseTemplate.flagAbonnement;
					}
					
					

					var lIdNomProduit = this.idNom;
					$(pResponse.stockSolidaire).each(function() {
						if(lProduit.proUniteMesure == this.unite && this.idNomProduit == lIdNomProduit){
							var lPrix = 0;
							var lPrixProduit = 0;
							$.each(lProduitCommande.lots, function() {
								if(this.id) {
									var lLot = {};
									lLot.dcomId = this.id;
									lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
									lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
									lPrix = parseFloat(this.prix);
									lPrixProduit = parseFloat(this.prix);
									lStoQuantite = parseFloat(this.taille);

									$(that.mAchatOuReservation).each(function() {
										$(this.detailAchatSolidaire).each(function() {
											if(this.idDetailCommande == lLot.dcomId) {
												lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',','');
												lProduit.stoQuantiteAffiche = (this.quantite * -1).nombreFormate(2,',',' ');
												
												lPrix = this.montant * -1;									
												lProduit.proPrix = lPrix.nombreFormate(2,',','');		
												lProduit.proPrixAffiche = lPrix.nombreFormate(2,',',' ');
												lLot.prixReservation = lPrix;
												
												that.mListeLotSolidaire.push({idPdt:lProduit.proId,idLot:lLot.dcomId});
												
												if(lIdCategorieAchatSol == 0) {
													lIdCategorieAchatSol = lProduitCommande.idCategorie;
													lNomCategorieAchatSol = lProduitCommande.cproNom;
												}
												
												if(lIdCategorieAchatSol != lProduitCommande.idCategorie) {
													lCategoriesTrieAchatSol.push({
															nom:lNomCategorieAchatSol,
															produits:lProduitsAchatSol
														});			
													lIdCategorieAchatSol = lProduitCommande.idCategorie;
													lNomCategorieAchatSol = lProduitCommande.cproNom;
													lProduitsAchatSol = [];
												} 
												
												lProduitsAchatSol.push(lProduit);

												lData.totalSolidaire += lPrix;
											}
										});										
									});
									
									lProduit.prixUnitaire = (lPrixProduit / lStoQuantite).toFixed(2).nombreFormate(2,',',' '); 						
																			
									lProduit.lot.push(lLot);
								}
							});
							
							if(lIdCategorieSol == 0) {
								lIdCategorieSol = lProduitCommande.idCategorie;
								lNomCategorieSol = lProduitCommande.cproNom;
							}
							
							if(lIdCategorieSol != lProduitCommande.idCategorie) {
								lCategoriesTrieSol.push({
										nom:lNomCategorieSol,
										produits:lProduitsSol
									});			
								lIdCategorieSol = lProduitCommande.idCategorie;
								lNomCategorieSol = lProduitCommande.cproNom;
								lProduitsSol = [];
							} 
							
							lProduitsSol.push(lProduit);
						}
					});
				}
			});
						
			lData.typePaiement = that.mTypePaiement;
			
			// Ajout de la dernière catégorie
			lCategoriesTrie.push({
				nom:lNomCategorie,
				produits:lProduits
			});	
			lCategoriesTrieSol.push({
				nom:lNomCategorieSol,
				produits:lProduitsSol
			});
			lCategoriesTrieAchat.push({
				nom:lNomCategorieAchat,
				produits:lProduitsAchat
			});	
			lCategoriesTrieAchatSol.push({
				nom:lNomCategorieAchatSol,
				produits:lProduitsAchatSol
			});
			
			lData.categories = lCategoriesTrie;
			lData.categoriesSolidaire = lCategoriesTrieSol;
			lData.categoriesAchat = lCategoriesTrieAchat;
			lData.categoriesSolidaireAchat = lCategoriesTrieAchatSol;
			
			
			lData.adhNouveauSolde = this.solde.nombreFormate(2,',',' ');
			
			this.solde = (this.solde + lData.total + lData.totalSolidaire).toFixed(2);

			lData.adhSolde = this.solde;
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');

			lData.totalMarche = (lData.total + lData.totalSolidaire).nombreFormate(2,',',' ');
						
			if(lData.total > 0) {
				lData.total = lData.total.nombreFormate(2,',',' ');
				lData.produit = lCaisseTemplate.achatMarcheDetailProduit.template(lData);
			} else {
				lData.produit = lCaisseTemplate.achatMarcheDetailProduitVide;					
			}
			if(lData.totalSolidaire > 0 ) {
				lData.totalSolidaire = lData.totalSolidaire.nombreFormate(2,',',' ');
				lData.produitSolidaire = lCaisseTemplate.achatMarcheDetailProduitSolidaire.template(lData);
			} else {
				lData.produitSolidaire = lCaisseTemplate.achatMarcheDetailProduitSolidaireVide;
			}
						
			lData.formMarcheVisible = "ui-helper-hidden";
			lData.rechargementVisible = "ui-helper-hidden";
			
			var lHtml = { 	formulaire : lCaisseTemplate.achatMarcheFormulaire.template(lData),
							detail : lCaisseTemplate.achatMarcheDetail.template(lData)	};
			
			
			$('#contenu').replaceWith( that.affectDetailAchat($(lCaisseTemplate.achatMarchePage.template(lHtml))) );
			
			that.changerTypePaiement($(":input[name=typepaiement]"));
			that.majNouveauSolde();
			$("#btn-modifier,#btn-confirmer").toggle();

	};
	
	this.affect = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectListeBanque(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.affectNouveauPrixProduit(pData);
		pData = this.affectChampComplementaire(pData);
		pData = this.affectValider(pData);
		pData = this.affectAnnuler(pData);
		pData = this.affectModifier(pData);
		pData = this.affectSupprimerPdt(pData);
		pData = this.supprimerSelect(pData);
		pData = this.affectChangementLot(pData);
		pData = this.selectLot(pData);
		pData = this.affectInitLot(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectDetailAchat = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectListeBanque(pData);
		pData = this.affectNouveauSolde(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectNouveauPrixProduit(pData);
		pData = this.affectChampComplementaire(pData);
		pData = this.affectValiderModifAchat(pData);
		pData = this.affectAnnuler(pData);
		pData = this.affectModifier(pData);
		pData = this.affectSupprimerPdt(pData);
		pData = this.supprimerSelect(pData);
		pData = this.affectChangementLot(pData);
		pData = this.selectLot(pData);
		pData = this.affectInitLot(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.selectLot = function(pData) {
		$(this.mListeLot).each(function() {
			pData.find('#lot-' + this.idPdt).selectOptions( this.idLot);
		});
		$(this.mListeLotSolidaire).each(function() {
			pData.find('#lot-solidaire-' + this.idPdt).selectOptions( this.idLot);
		});
		return pData;
	};
	
	this.supprimerSelect = function(pData) {
		pData.find('.ligne-produit select').each(function() {
			if($(this).find('option').size() == 1) {				
				var lCaisseTemplate = new CaisseTemplate();
				var lTemplate = lCaisseTemplate.lotUnique;
				var lData = {};
				lData.IdPdt = $(this).parent().parent().find(".produit-id").text();
				lData.valeur = $(this).val();
				lData.text = $(this).text();
				
				$(this).replaceWith(lTemplate.template(lData));
			}
		});
		
		pData.find('.ligne-produit-solidaire select').each(function() {
			if($(this).find('option').size() == 1) {				
				var lCaisseTemplate = new CaisseTemplate();
				var lTemplate = lCaisseTemplate.lotUniqueSolidaire;
				var lData = {};
				lData.IdPdt = $(this).parent().parent().find(".produit-id").text();
				lData.valeur = $(this).val();
				lData.text = $(this).text();
				
				$(this).replaceWith(lTemplate.template(lData));
			}
		});
		return pData;
	};
	
	this.affectInitLot = function(pData) {
		var that = this;
		pData.find('.ligne-produit select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".produit-id").text();
			var lIdLot = $(this).val();

			if(that.pdtCommande[lIdPdt] && that.pdtCommande[lIdPdt].lots[lIdLot]) {
				var lPrix = that.pdtCommande[lIdPdt].lots[lIdLot].prix;
				var lQte = that.pdtCommande[lIdPdt].lots[lIdLot].taille;
				var lprixUnitaire = (lPrix / lQte).toFixed(2).nombreFormate(2,',',' '); 						
				
				$(pData).find('#prix-unitaire-' + lIdPdt).text(lprixUnitaire);
			}
		});
		pData.find('.ligne-produit-solidaire select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".produit-id").text();
			var lIdLot = $(this).val();

			if(that.pdtCommande[lIdPdt] && that.pdtCommande[lIdPdt].lots[lIdLot]) {
				var lPrix = that.pdtCommande[lIdPdt].lots[lIdLot].prix;
				var lQte = that.pdtCommande[lIdPdt].lots[lIdLot].taille;
				var lprixUnitaire = (lPrix / lQte).toFixed(2).nombreFormate(2,',',' '); 						
				
				$(pData).find('#prix-unitaire-solidaire-' + lIdPdt).text(lprixUnitaire);
			}
		});
		return pData;
	};
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.ligne-produit select').change(function() {
			that.changerLot($(this).parent().parent().find(".produit-id").text(),$(this).val());
		});
		pData.find('.ligne-produit-solidaire select').change(function() {
			that.changerLotSolidaire($(this).parent().parent().find(".produit-id").text(),$(this).val());
		});
		return pData;
	};
	
	this.changerLot = function(pIdPdt,pIdLot) {
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		var lQte = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).toFixed(2).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-' + pIdPdt).text(lprixUnitaire);
		$('#produits' + pIdPdt +'quantite,#produits' + pIdPdt + 'prix').val("");		
		
		this.majNouveauSolde();
	};
	
	this.changerLotSolidaire = function(pIdPdt,pIdLot) {
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		var lQte = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).toFixed(2).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-solidaire-' + pIdPdt).text(lprixUnitaire);
		$('#produitsSolidaire' + pIdPdt +'quantite,#produitsSolidaire' + pIdPdt + 'prix').val("");	
		
		this.majNouveauSoldeSolidaire();
	};
		
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
			that.controlerAchat();
		});
		return pData;
	};
	
	this.affectListeBanque = function(pData) {
		var that = this;
		
		function removeIfInvalid(element) {
			// Vide le champ si la banque n'existe pas
			var value = $( element ).val(),
			matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
			valid = false;
			$( that.mBanques ).each(function() {
				if ( $( this ).text().match( matcher ) ) {
					this.selected = valid = true;
					return false;
				}
			});
			if ( !valid ) {
				$( element ).attr( 'id-banque','' ); 
				
				// Message d'information
				var lVr = new RechargementCompteVR();
				lVr.valid = false;
				lVr.idBanque.valid = false;
				var erreur = new VRerreur();
				erreur.code = ERR_261_CODE;
				erreur.message = ERR_261_MSG;
				lVr.idBanque.erreurs.push(erreur);
				
				Infobulle.generer(lVr,'');
				return false;
			}
		};
		
		pData.find('#rechargementidBanque').autocomplete({
			minLength: 0,			 
			source: function( request, response ) {
				var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
					response( $.grep( that.mBanques, 
						function( item ){
							return matcher.test( item.nom ) || matcher.test( item.nomCourt );
						}
					));
			},	 
			focus: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				$( "#rechargementidBanque" ).val( htmlDecode(ui.item.nom) );
				return false;
			},
			select: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				$( "#rechargementidBanque" ).val( htmlDecode(ui.item.nom) );
				$( "#rechargementidBanque" ).attr('id-banque', ui.item.id );
				return false;
			},
			change: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				if ( !ui.item )
					return removeIfInvalid( this );
			}
		}).data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li>" )
			.data( "item.autocomplete", item )
			.append( "<a>" + item.nomCourt + " : " + item.nom + "<br>" + item.description + "</a>" )
			.appendTo( ul );
		};
		
		return pData;
	};
	
	this.affectNouveauSolde = function(pData) {
		var that = this;
		pData.find(":input[name=montant-rechargement], .produit-prix").keyup(function() {
			that.majNouveauSolde();	
			that.controlerAchat();
		});
		pData.find(".produit-solidaire-prix").keyup(function() {
			that.majNouveauSoldeSolidaire();	
			that.controlerAchat();
		});
		return pData;
	};
		
	this.affectNouveauPrixProduit = function(pData) {
		var that = this;
		pData.find(".produit-quantite").keyup(function() {
				that.majPrixProduit($(this));
				that.controlerAchat();
		});
		pData.find(".produit-solidaire-quantite").keyup(function() {
			that.majPrixProduitSolidaire($(this));
			that.controlerAchat();
		});
		return pData;
	};
	
	this.affectChampComplementaire = function(pData) {
		var that = this;
		pData.find(":input[name=champ-complementaire]").keyup(function() {that.controlerAchat();});		
		return pData;
	};
	
	this.affectValider = function(pData) {
		var that = this;
		pData.find(".btn-valider").click(function() {that.creerRecapitulatif(1);});		
		return pData;
	};
	
	this.affectValiderModifAchat = function(pData) {
		var that = this;
		pData.find(".btn-valider").click(function() {that.creerRecapitulatif(2);});		
		return pData;
	};
	
	this.affectAnnuler = function(pData) {
		var that = this;
		pData.find("#btn-annuler").click(function() {that.retourListe();});		
		return pData;
	};
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find("#btn-modifier").click(function() {that.boutonModifier();});		
		return pData;
	};
	
	this.affectSupprimerPdt = function(pData) {
		if(pData.find(".ligne-produit").size() == 0) {
			pData.find("#achat-pdt-widget").remove();
		}
		if(pData.find(".ligne-produit-solidaire").size() == 0) {
			pData.find("#achat-pdt-solidaire-widget").remove();
		}
		return pData;
	};
	
	this.majPrixProduit = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		var lIdProduit = ligne.find(".produit-id").text();
		var lIdLot = ligne.find('#lot-'+lIdProduit).val();

		var lPrix = this.pdtCommande[lIdProduit].lots[lIdLot].prix;
		var lQte = this.pdtCommande[lIdProduit].lots[lIdLot].taille;
		//var lprixUnitaire = lPrix / lQte; 
		
		var lNvPrix = (lPrix / lQte * lQuantite).toFixed(2);
		
		//var lNvPrix = (lPrix / lQte * lQuantite);
		
		//alert(lNvPrix);
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		if(lNvPrix != 0) {
			ligne.find(".produit-prix").val(lNvPrix.nombreFormate(2,',',''));
		} else {
			ligne.find(".produit-prix").val("");
		}
		
		this.majNouveauSolde();		
	};
	
	this.majPrixProduitSolidaire = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		
		var lIdProduit = ligne.find(".produit-id").text();
		var lIdLot = ligne.find('#lot-solidaire-'+lIdProduit).val();

		var lPrix = this.pdtCommande[lIdProduit].lots[lIdLot].prix;
		var lQte = this.pdtCommande[lIdProduit].lots[lIdLot].taille;
		//var lprixUnitaire = lPrix / lQte; 
		
		var lNvPrix = (lPrix / lQte * lQuantite).toFixed(2);
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		if(lNvPrix != 0) {
			ligne.find(".produit-solidaire-prix").val(lNvPrix.nombreFormate(2,',',''));
		} else {
			ligne.find(".produit-solidaire-prix").val("");
		}
		
		this.majNouveauSoldeSolidaire();		
	};
		
	this.controlerAchat = function() {
		Infobulle.init(); // Supprime les erreurs
		var lValid = new AchatCommandeValid();
		var lVr = new AchatCommandeVR();
		if(this.idCompte == -3) {
			lVr = lValid.validAjoutInvite(this.getAchatCommandeVO());
		} else {
			lVr = lValid.validAjout(this.getAchatCommandeVO());
		}
		Infobulle.generer(lVr,'');
		return lVr;
	};
			
	this.majTotal = function() {
		var lTotal = this.calculerTotal();
		$("#total-achat").text(lTotal.nombreFormate(2,',',' '));
		this.total = lTotal;
		this.majTotalGlobal();		
	};
	
	this.majTotalSolidaire = function() {
		var lTotalSolidaire = this.calculerTotalSolidaire();
		$("#total-achat-solidaire").text(lTotalSolidaire.nombreFormate(2,',',' '));
		this.totalSolidaire = lTotalSolidaire;
		this.majTotalGlobal();		
	};
	
	this.majTotalGlobal = function() {
		var lTotal = (parseFloat(this.totalSolidaire) + parseFloat(this.total)).toFixed(2);
		$("#total-global").text(lTotal.nombreFormate(2,',',' '));
	};
	
	this.calculerTotal = function() {
		var lTotal = 0;
		$(".produit-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal.toFixed(2);		
	};
	
	this.calculerTotalSolidaire = function() {
		var lTotal = 0;
		$(".produit-solidaire-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal.toFixed(2);		
	};
	
	this.majNouveauSolde = function() {
		this.majTotal();
		var lTotal = this.calculNouveauSolde();
		if(lTotal <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lTotal.nombreFormate(2,',',' '));
	};
	
	this.majNouveauSoldeSolidaire = function() {
		this.majTotalSolidaire();
		var lTotal = this.calculNouveauSolde();
		if(lTotal <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lTotal.nombreFormate(2,',',' '));
	};
	
	this.calculNouveauSolde = function() {
		var lAchats = this.total;// parseFloat($("#total-achat").val().numberFrToDb());
		if(isNaN(lAchats)) {lAchats = 0;}
		var lAchatsSolidaire = this.totalSolidaire; //parseFloat($("#total-achat-solidaire").val().numberFrToDb());
		if(isNaN(lAchatsSolidaire)) {lAchatsSolidaire = 0;}
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}		
		return (parseFloat(this.solde) - parseFloat(lAchats) - parseFloat(lAchatsSolidaire) + parseFloat(lRechargement)).toFixed(2);
	};
		
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel).show();
			//$("#td-champ-complementaire").show();
			$("#td-champ-complementaire, #td-champ-complementaire-banque, #label-champ-complementaire-banque").show();
		} else {
			$("#label-champ-complementaire").text('').hide();
			
			$(':input[name="champ-complementaire"], :input[name="champ-complementaire-banque"]').val('');
			$("#td-champ-complementaire, #td-champ-complementaire-banque, #label-champ-complementaire-banque").hide();
			$('#rechargementidBanque').attr('id-banque','');
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
	
	this.getAchatCommandeVO = function() {
		var lVo = new AchatCommandeVO();
		lVo.id = this.idCommande;
		lVo.idCompte = this.idCompte;
		lVo.produits = this.getProduitsVO();
		lVo.produitsSolidaire = this.getProduitsSolidaireVO();
		lVo.rechargement = this.getRechargementVO();	
		if(this.idCompte == -3) {
			lVo.solde =	this.calculNouveauSolde(); 
		}	
		//lVo.NbProduits = $('.ligne-produit').size();
		//lVo.NbProduitsSolidaire = $('.ligne-produit-solidaire').size();		
		return lVo;
	};
	
	this.getProduitsVO = function() {
		var lVo = new Array();		
		$(".ligne-produit").each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).find(".produit-id").text();			
			var lQuantite = $(this).find(".produit-quantite").val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty() && lQuantite != 0){
				lQuantite = parseFloat(lQuantite);
				lVoProduit.quantite = lQuantite * -1;			
			
				var lprix = $(this).find(".produit-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0){
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
				}
				lVo.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0) {
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lVo.push(lVoProduit);
				}
			}		
		});		
		return lVo;
	};
	
	this.getProduitsSolidaireVO = function() {
		var lVo = new Array();		
		$(".ligne-produit-solidaire").each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).find(".produit-id").text();			
			var lQuantite = $(this).find(".produit-solidaire-quantite").val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty() && lQuantite != 0){
				lQuantite = parseFloat(lQuantite);
				lVoProduit.quantite = lQuantite * -1;
			
				var lprix = $(this).find(".produit-solidaire-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0){
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
				}
				lVo.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-solidaire-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0){
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lVo.push(lVoProduit);
				}
			}	
		});		
		return lVo;
	};
	
	this.getRechargementVO = function() {
		var lVo = new RechargementCompteVO();		
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		lVo.id = this.idCompte;

		if(!isNaN(lMontant) && !lMontant.isEmpty() && lMontant != 0){
			lMontant = parseFloat(lMontant);
			lVo.montant = lMontant;
		}
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		if(this.getLabelChamComplementaire(lVo.typePaiement) != null) {
			lVo.champComplementaireObligatoire = 1;
			lVo.champComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lVo.champComplementaireObligatoire = 0;
		}
		// Si id-banque est alimenté mais qu'on efface le nom de la banque par la suite
		// il ne faut pas prendre en compte le id-banque
		if($('#idBanque').val() != "") {
			lVo.idBanque = $('#rechargementidBanque').attr('id-banque');
		}
		return lVo;
	};
	
	this.creerRecapitulatif = function(pType) {

		//var that = this;
		var lVr = this.controlerAchat();
		if(lVr.valid) {
			if(this.etapeValider == 0) {				
								

				var lVo = this.getAchatCommandeVO();
				
				
				var lCaisseTemplate = new CaisseTemplate();
				var lTemplate = lCaisseTemplate.achatMarcheDetail;
				
				var lData = new Object();
				
				
				if(this.idAdherent != 0) {
					lData.adhNumero = this.mAdherent.adhNumero;
					lData.adhCompte = this.mAdherent.cptLabel;
					lData.adhNom = this.mAdherent.adhNom;
					lData.adhPrenom = this.mAdherent.adhPrenom;
				} else {
					lData.adhNumero = "ZZ";
					lData.adhCompte = "CC";
					lData.adhNom = "Invité";
				}
				lData.sigleMonetaire = gSigleMonetaire;
				lData.total = 0;
				lData.totalSolidaire = 0;
				
				lData.categories = [];
				lData.categoriesSolidaire = [];
				lData.categoriesAchat = [];
				lData.categoriesSolidaireAchat = [];
				
				$.each(this.pdtCommande,function() {
					if(this.id) {
						//var lProduitCommande = this;
												
						var lProduit = {};
						lProduit.proId = this.id;
						lProduit.nproNom = this.nom;
						lProduit.proUniteMesure = this.unite;
						lProduit.stoQuantiteAffiche = "";
						lProduit.proPrixAffiche = "";
						lProduit.dcomTaille = "";
						
						lProduit.flagType = "";
						if(this.type == 2) {
							lProduit.flagType = lCaisseTemplate.flagAbonnement;
						}
						
						var lIdCategorie = this.idCategorie;
						var lCategorie = this.cproNom;
						
						var lPrix = 0;
						$(lVo.produits).each(function() {
							if(this.id == lProduit.proId) {
								lProduit.stoQuantiteAffiche = (this.quantite * -1).nombreFormate(2,',',' ');
								lProduit.proPrixAffiche = (this.prix * -1).nombreFormate(2,',',' ');
								lPrix = this.prix * -1;
								if(!lData.categoriesAchat[lIdCategorie]) {
									lData.categoriesAchat[lIdCategorie] = {nom:lCategorie,produits:[]};
								}
								lData.categoriesAchat[lIdCategorie].produits.push(lProduit);
							}
						});
						lData.total += lPrix;
						
						var lProduitSolidaire = {};
						lProduitSolidaire.proId = this.id;
						lProduitSolidaire.nproNom = this.nom;
						lProduitSolidaire.proUniteMesure = this.unite;
						lProduitSolidaire.stoQuantiteAffiche = "";
						lProduitSolidaire.proPrixAffiche = "";
						lProduitSolidaire.dcomTaille = "";
						
						lProduitSolidaire.flagType = "";
						if(this.type == 2) {
							lProduitSolidaire.flagType = lCaisseTemplate.flagAbonnement;
						}
						var lPrix = 0;
						$(lVo.produitsSolidaire).each(function() {
							if(this.id == lProduitSolidaire.proId) {
								lProduitSolidaire.stoQuantiteAffiche = (this.quantite * -1).nombreFormate(2,',',' ');
								lProduitSolidaire.proPrixAffiche = (this.prix * -1).nombreFormate(2,',',' ');
								lPrix = this.prix * -1;
								if(!lData.categoriesSolidaireAchat[lIdCategorie]) {
									lData.categoriesSolidaireAchat[lIdCategorie] = {nom:lCategorie,produits:[]};
								}
								lData.categoriesSolidaireAchat[lIdCategorie].produits.push(lProduitSolidaire);
							}
						});
						lData.totalSolidaire += lPrix;
					}
				});

				var lTotal = lData.total;
				var lTotalSolidaire = lData.totalSolidaire;
				var lTotalMarche = lData.total + lData.totalSolidaire;
				lData.totalMarche = lTotalMarche.nombreFormate(2,',',' ');
				lData.total = lData.total.nombreFormate(2,',',' ');
				lData.totalSolidaire = lData.totalSolidaire.nombreFormate(2,',',' ');
				

				lData.adhSolde = this.solde.nombreFormate(2,',',' ');
				var lNvSolde = this.solde - lTotalMarche + lVo.rechargement.montant;
				lData.adhNouveauSolde = lNvSolde.nombreFormate(2,',',' ');
				lData.classSolde = "";
				if(lNvSolde < 0) {
					lData.classSolde = "com-nombre-negatif";
				}
				
				var lVal = parseFloat($("#rechargementmontant").val().numberFrToDb());
				if(isNaN(lVal) || lVal == '' || lVal == 0) {
					lVal = '-';
				} else {
					lVal = lVal.nombreFormate(2,',',' ');
				}
				lData.rechargementMontant = lVal;
				
				var lval = $("#rechargementtypePaiement").find('option:selected').val();
				if(lval == 0) {
					lData.rechargementTypePaiement = "-";
				} else {
					lData.rechargementTypePaiement = $("#rechargementtypePaiement").find('option:selected').text();
				}
				
				lData.rechargementChampComplementaire = $("#rechargementchampComplementaire").val();
				lData.rechargementNomBanque = $("#rechargementidBanque").val(); 
				
				if(lData.rechargementNomBanque.isEmpty() ) {
					lData.classHideBanque = "ui-helper-hidden";
				}
				
				if(lTotal > 0) {
					lData.produit = lCaisseTemplate.achatMarcheDetailProduit.template(lData);
				} else {
					lData.produit = lCaisseTemplate.achatMarcheDetailProduitVide;					
				}
				if(lTotalSolidaire > 0 ) {
					lData.produitSolidaire = lCaisseTemplate.achatMarcheDetailProduitSolidaire.template(lData);
				} else {
					lData.produitSolidaire = lCaisseTemplate.achatMarcheDetailProduitSolidaireVide;
				}
				
				//$("#btn-annuler, #btn-modifier, #achat-marche-formulaire, .btn-valider").toggle();
				
				$("#btn-annuler,#achat-marche-formulaire,#btn-confirmer").hide();
				$("#btn-modifier,#btn-enregistrer").show();
				
				$('#achat-marche-detail').replaceWith( $(lTemplate.template(lData)) ).show();

				this.etapeValider = 1;
			} else if(this.etapeValider == 1) {
				if(pType == 1) {
					this.enregistrerAchat();
				} else if(pType == 2) {
					this.modifierAchat();
				}
			}
		}
	};
	
	this.enregistrerAchat = function() {
		var that = this;
		var lVo = this.getAchatCommandeVO();
		lVo.fonction = "acheter";
		
		$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour) {
						if(lVoRetour.valid) {
							var lCaisseTemplate = new CaisseTemplate();
							var lTemplate = lCaisseTemplate.achatCommandeSucces;
							$('#contenu').replaceWith(that.affectAnnuler($(lTemplate)));
						} else {
							var lAchatExiste = false;
							$(lVoRetour.log.erreurs).each(function() {
								if(this.code == 263) { lAchatExiste = true; }
							});
							// Erreur 263 : il y a déjà un achat sur le marché : on affiche le détail de cet achat en modification pour éviter un doublon d'achat.
							if(lAchatExiste) {
								CaisseAchatCommandeVue({id_commande:that.idCommande, id_adherent:that.idAdherent, vr:lVoRetour});
							} else {
								that.boutonModifier();
								Infobulle.generer(lVoRetour,"");
							}
						}
						that.etapeValider = 0;
					}
				},"json"
			);
	};
	
	this.modifierAchat = function() {
		var that = this;
		var lVo = this.getAchatCommandeVO();
		
		lVo.idAchat = [];
		$.each(this.mAchatOuReservation,function() {
			lVo.idAchat.push(this.id.idAchat);
		});
		
		lVo.fonction = "modifier";
		$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour) {
						if(lVoRetour.valid) {
							var lCaisseTemplate = new CaisseTemplate();
							var lTemplate = lCaisseTemplate.achatCommandeSucces;
							$('#contenu').replaceWith(that.affectAnnuler($(lTemplate)));
						} else {
							that.boutonModifier();
							Infobulle.generer(lVoRetour,"");
						}
						that.etapeValider = 0;
					}
				},"json"
			);
	};
	
	
	this.boutonModifier = function() {
		if(this.etapeValider == 1) {			
			$("#btn-annuler, #achat-marche-formulaire, #btn-confirmer").show();
			$("#btn-modifier, #achat-marche-detail, #btn-enregistrer").hide();	
			
			this.etapeValider = 0;
		}
	};
	
	this.retourListe = function() {
		CaisseMarcheCommandeVue({id_commande:this.idCommande});
	};*/
	
	this.construct(pParam);
}