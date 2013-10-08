;function xxxCaisseAchatCommandeVue(pParam) {
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
	
	this.mTypePaiementSelect = 0;
	this.afficheChCpAutorise = true;
	
	
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
							that.mTypePaiement = lResponse.typePaiement;							
							/*$(lResponse.typePaiement).each(function() {
								that.mTypePaiement[this.tppId] = this;
								this.selected = '';
							});	*/
							
							//var lTppSelected = 0;
							if(pParam.id_adherent != 0) { // Si pas invité les informations de l'adhérent
								that.mIdCompte = lResponse.adherent.adhIdCompte;
								that.mAdherent = lResponse.adherent;
								that.mSolde = parseFloat(lResponse.adherent.cptSolde);
								
								lResponse.adherent.rechargementMontant = '';
								lResponse.adherent.rechargementChampComplementaire = '';
								/*lResponse.adherent.rechargementNomBanque = '';
								lResponse.adherent.rechargementIdBanque = '';*/
								//lResponse.adherent.rechargementAfficheChampComplementaire ='ui-helper-hidden';
								if(lResponse.rechargement != null && lResponse.rechargement.id && lResponse.rechargement.id != null) {
									that.mSolde = (parseFloat(that.mSolde) - parseFloat(lResponse.rechargement.montant)).toFixed(2);
									lResponse.adherent.rechargementMontant = lResponse.rechargement.montant.nombreFormate(2,',','');
									//lTppSelected = lResponse.rechargement.typePaiement;
									
									/*if(that.getLabelChamComplementaire(lResponse.rechargement.typePaiement) != null) {
										lResponse.adherent.rechargementAfficheChampComplementaire ='';
										lResponse.adherent.rechargementChampComplementaire = lResponse.rechargement.typePaiementChampComplementaire;
										lResponse.adherent.rechargementIdBanque = lResponse.rechargement.idBanque;
										$(lResponse.banques).each(function() {
											if(this.id == lResponse.rechargement.idBanque) {
												lResponse.adherent.rechargementNomBanque = this.nom;
											}
										});
									}*/
									this.mTypePaiementSelect = lResponse.rechargement.typePaiement;
									
									var lTypePaiementService = new TypePaiementService();
									var lChampComplementaire = [];
									if(this.mTypePaiement[pResponse.rechargement.typePaiement]) {
										$(this.mTypePaiement[pResponse.rechargement.typePaiement].champComplementaire).each(function() {				
											var lChamp = pResponse.rechargement.champComplementaire[this.id];
											lChamp.id = this.id;
											lChamp.tppCpVisible = 1;
											lChamp.chCpLabel = this.label;
											lChampComplementaire.push(lChamp);
										});
									}
									
									pResponse.adherent.champComplementaire = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, this.mBanques);
									
									/*
									pResponse.montant = pResponse.facture.id.montant.nombreFormate(2,',','');
									pResponse.montantAffiche = pResponse.facture.id.montant.nombreFormate(2,',',' ');
									
									this.mTypePaiementSelect = pResponse.facture.operationZeybu.typePaiement;
									pResponse.tppType = pResponse.facture.operationZeybu.tppType;
									
									var lTypePaiementService = new TypePaiementService();
									var lChampComplementaire = [];
									if(this.mTypePaiement[pResponse.facture.operationZeybu.typePaiement]) {
										$(this.mTypePaiement[pResponse.facture.operationZeybu.typePaiement].champComplementaire).each(function() {				
											var lChamp = pResponse.facture.operationZeybu.champComplementaire[this.id];
											lChamp.id = this.id;
											lChamp.tppCpVisible = 1;
											lChamp.chCpLabel = this.label;
											lChampComplementaire.push(lChamp);
										});
									}
									pResponse.champComplementaire = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, this.mBanques);
									pResponse.champComplementaireAffiche = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, this.mBanques, true);*/
									
									
									
									
								}
								
							} else {
								lResponse.adherent = {};
							}
							
							// Sélection du type de paiement
					/*		$(lResponse.typePaiement).each(function() {
								if(this.tppId == lTppSelected) {
									this.selected ="selected=\"selected\"";
								}
							});							*/
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
														that.mLotAchat[lIdProduit] = {normal:this.idDetailCommande,solidaire:0};
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
														
														if(that.mLotAchat[lIdProduit]) {
															that.mLotAchat[lIdProduit].normal = this.idDetailCommande;
														} else {
															that.mLotAchat[lIdProduit] = {normal:this.idDetailCommande,solidaire:''};
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
														
														if(that.mLotAchat[lIdProduit]) {
															that.mLotAchat[lIdProduit].solidaire = this.idDetailCommande;
														} else {
															that.mLotAchat[lIdProduit] = {normal:'',solidaire:this.idDetailCommande};
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
		//pData = this.affectListeBanque(pData);
		var lTypePaiementService = new TypePaiementService();
		pData = lTypePaiementService.affect(pData, this.mBanques);
		
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
		}).blur(function() { // Masque automaiquement en sortie si il n'y a qu'un lot
			var lNproId = $(this).data('id-nom-produit');
			if(that.mPrixProduit[lNproId].lots.length == 1) {
				$('.ligne-lot-produit').hide();
			}
		}).keyup(function() {
			var lIdProduit = $(this).data('id-produit');
			var lNproId = $(this).data('id-nom-produit');
			var lType = $(this).data('type');
			var lIdLot = 0;
			if(that.mPrixProduit[lNproId].lots.length == 1) {
				lIdLot = that.mPrixProduit[lNproId].lots[0].id;
			} else {
				lIdLot = that.mLots[$('#select-' + lNproId + lType).val()].id;
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
			that.calculPrix($(this).data('id-produit'), $(this).data('id-nom-produit'), $(this).data('type') ,  $(this).val());
		});
		return pData;
	};
	
	this.calculPrix = function(pIdProduit, pIdNomProduit, pType, pQuantite) {
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
		$('#produits' + pIdProduit + 'montant' + pType  ).val(lPrix);
	};
		
	this.affectChangeLot = function(pData) {
		var that = this;
		pData.find('.select-lot').change(function() {
			var lIdNomProduit = $(this).data('id-nom-produit');
			var lType= $(this).data('type'); 
			var lIdLot = $(this).val();
			
			// Raz quantité et prix 
			$('#produits' + lType + lIdNomProduit + 'quantite' + ', #produits' + lIdNomProduit + 'montant' + lType ).val('');
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
	
		
	/*this.getLabelChamComplementaire = function(pId) {
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
	};*/
	
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
			var lIdCategorie = $(this).data('id-categorie');

			var lVoProduit = new ProduitDetailAchatVO();
			lVoProduit.id = lIdProduit;
			lVoProduit.idNomProduit = lNproId;
						
			if(that.mLotAchat[lIdProduit]) {
				if(lIdProduit > 0) { // Produit du marche
					lVoProduit.idDetailCommande = that.mLotAchat[lIdProduit].normal;
					lVoProduit.idDetailCommandeSolidaire = that.mLotAchat[lIdProduit].solidaire;
				} else { // Produit en stock
					lVoProduit.idModeleLot = that.mLotAchat[lIdProduit].normal;		
					lVoProduit.idModeleLotSolidaire = that.mLotAchat[lIdProduit].solidaire;	
				}
			}

			var lQuantite = parseFloat($('#produits' + lIdProduit + 'quantite' ).val().numberFrToDb());
			if(!isNaN(lQuantite)) {
				lVoProduit.quantite = lQuantite * -1;
			}
					
			var lMontant = parseFloat($('#produits' + lIdProduit + 'montant' ).val().numberFrToDb());
			if(!isNaN(lMontant)) {
				lVoProduit.montant = lMontant * -1;
				lTotal += lMontant;
			}	
			
			lQuantite = parseFloat($('#produits' + lIdProduit + 'quantiteSolidaire' ).val().numberFrToDb());
			if(!isNaN(lQuantite)) {
				lVoProduit.quantiteSolidaire = lQuantite * -1;
			}
					
			lMontant = parseFloat($('#produits' + lIdProduit + 'montantSolidaire' ).val().numberFrToDb());
			if(!isNaN(lMontant)) {
				lVoProduit.montantSolidaire = lMontant * -1;
				lTotalSolidaire += lMontant;
			}
			
			var lInfoProduit = that.mPrixProduit[lNproId];
			if(lVoProduit.quantite != '' || lVoProduit.montant != '' || lVoProduit.quantiteSolidaire != '' || lVoProduit.montantSolidaire != '') {
				lVo.produits.push(lVoProduit);
				lProduitAchete = true;
				
				if(!lProduitDetail[lIdCategorie]) {
					lProduitDetail[lIdCategorie] = {cproNom:that.mNomCategorie[lIdCategorie].cproNom,produits:[]};
				}
				
				lProduitDetail[lIdCategorie].produits[lNproId] = {
						nom:lInfoProduit.nom,
						quantite:'',montant:'',quantiteSolidaire:'',montantSolidaire:'',
						unite:'',uniteSolidaire:'',sigleMonetaire:'',sigleMonetaireSolidaire:''};
				if(lVoProduit.quantite != '') {
					lProduitDetail[lIdCategorie].produits[lNproId].quantite = (lVoProduit.quantite * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].unite = lInfoProduit.unite;
					lProduitDetail[lIdCategorie].produits[lNproId].montant = (lVoProduit.montant * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].sigleMonetaire = gSigleMonetaire;
				}
				if(lVoProduit.quantiteSolidaire != '') {
					lProduitDetail[lIdCategorie].produits[lNproId].quantiteSolidaire = (lVoProduit.quantiteSolidaire * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].uniteSolidaire = lInfoProduit.unite;
					lProduitDetail[lIdCategorie].produits[lNproId].montantSolidaire = (lVoProduit.montantSolidaire * -1).nombreFormate(2,',',' ');	
					lProduitDetail[lIdCategorie].produits[lNproId].sigleMonetaireSolidaire = gSigleMonetaire;
				}
			}
			
		});
		if(lTotal > 0) {
			var lOperationAchat = new OperationDetailVO();
			lOperationAchat.montant = lTotal;
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
			lVo.operationAchat = lOperationAchat;
		}
		
		if(lTotalSolidaire > 0) {
			var lOperationAchat = new OperationDetailVO();
			lOperationAchat.montant = lTotalSolidaire;
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
			lVo.operationAchatSolidaire = lOperationAchat;
		}
		
		var lRechargementVo = new OperationDetailVO();		
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		var lMontantAffiche = 0; 
		var lTypePaiementAffiche = '';
		
		lRechargementVo.idCompte = this.mIdCompte;

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

		if(this.mTypePaiement[lRechargementVo.typePaiement]) {
			var lTypePaiementService = new TypePaiementService();
			lRechargementVo.champComplementaire = lTypePaiementService.getChampComplementaire(this.mTypePaiement[lRechargementVo.typePaiement].champComplementaire, 'rechargement');
		}
		
		lVo.rechargement = lRechargementVo;	
		
		var lValid = new AchatValid();
		var lVr = lValid.validAjout(lVo);
	/*	if(pParam.id_adherent != 0) {
			lVr = lValid.validAjout(lVo);
		} else {// Invite
			lVr = lValid.validAjoutInvite(lVo);
		}*/
		
		// Arrêt de la recherche
		$('#input-rechercher').val('');
		that.recherche('');

		Infobulle.init(); // Supprime les erreurs
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
				$('#formulaire-produit').hide().before(lCaisseTemplate.achatHorsMarcheDetailAchat.template({categories:lProduitDetail}));
			} else {
				$('#formulaire-produit').hide();
			}
			$('.ligne-lot-produit').hide();
			
			// Le rechargement
			//$('#select-typePaiement').hide(); // Masque le formulaire
			
			$('#rechargement-affiche').text(lMontantAffiche); // Le Montant
			
			//$('#rechargement-select-affiche').text(lTypePaiementAffiche);
			if(lRechargementVo.typePaiement == 0) {
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

			
			/*$('#rechargement-champ-complementaire-affiche').text(lChampComplementaireAffiche);
			$('#rechargement-banque-affiche').text(lBanqueAffiche);
			*/
			
			// Masque les input pour passer en affichage et change les boutons
			$('.form-produit, #btn-valider, #btn-modifier, #btn-enregistrer, #recherche-produit').toggle(); 
			
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
		$('.form-produit, #btn-valider, #btn-modifier, #btn-enregistrer, #recherche-produit').toggle(); 
		$('#formulaire-produit, #form-select-typePaiement').show();
		$('#formulaire-produit-detail, #affiche-select-typePaiement').remove();
		
		this.afficheChCpAutorise = true;
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
	this.construct(pParam);
}