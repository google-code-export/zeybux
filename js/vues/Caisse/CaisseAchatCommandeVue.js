;function CaisseAchatCommandeVue(pParam) {
	this.idCommande = null;
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
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
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
			lData.categories = [];
		//	lData.produitsSolidaire = new Array();
			lData.categoriesSolidaire = [];
			
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
									lProduit.stoQuantiteReservation = (this.quantite * -1).nombreFormate(2,',','');
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
						if(!lData.categories[this.idCategorie]) {
							lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
						}
						lData.categories[this.idCategorie].produits.push(lProduit);
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
						if(lProduit.proUniteMesure == this.unite && this.idNomProduit == lIdNomProduit){
							if(!lData.categoriesSolidaire[lProduitCommande.idCategorie]) {
								lData.categoriesSolidaire[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
							}
							lData.categoriesSolidaire[lProduitCommande.idCategorie].produits.push(lProduitSolidaire);
						}
					});
				}
			});
						
			lData.typePaiement = that.mTypePaiement;
			
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
		} else {
			Infobulle.generer(pResponse,'');
		}
	};
	
	this.afficherDetailAchat = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
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
			lData.categories = [];
		//	lData.produitsSolidaire = new Array();
			lData.categoriesSolidaire = [];
			lData.categoriesAchat = [];
			lData.categoriesSolidaireAchat = [];
			
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
								$(this.detailAchat).each(function() {
									if(this.idDetailCommande == lLot.dcomId) {
										lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',','');
										
										lPrix = this.montant * -1;									
										lProduit.proPrix = lPrix.nombreFormate(2,',','');
										lLot.prixReservation = lPrix;
										
										that.mListeLot.push({idPdt:lProduit.proId,idLot:lLot.dcomId});
										
										if(!lData.categoriesAchat[lProduitCommande.idCategorie]) {
											lData.categoriesAchat[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
										}
										lData.categoriesAchat[lProduitCommande.idCategorie].produits.push(lProduit);

										lData.total += lPrix;
									}
								});										
							});
							$(that.mReservation).each(function() {
								if(this.idDetailCommande == lLot.dcomId) {
									lProduit.stoQuantiteReservation = (this.quantite * -1).nombreFormate(2,',','');
									lProduit.proUniteMesureReservation = lProduit.proUniteMesure;
								}											
							});
							
							lProduit.prixUnitaire = (lPrix / lStoQuantite).toFixed(2).nombreFormate(2,',',' '); 						
																	
							lProduit.lot.push(lLot);
						}
					});
					
					lProduit.flagType = "";
					if(this.type == 2) {
						lProduit.flagType = lCaisseTemplate.flagAbonnement;
					}
					
					if(this.type == 0 || this.type == 2) {
						if(!lData.categories[this.idCategorie]) {
							lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
						}
						lData.categories[this.idCategorie].produits.push(lProduit);
					}

					
					var lProduit = {};
					lProduit.proId = this.id;
					lProduit.nproNom = this.nom;
					lProduit.proUniteMesure = this.unite;
					lProduit.stoQuantite = "";
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
							$.each(lProduitCommande.lots, function() {
								if(this.id) {
									var lLot = {};
									lLot.dcomId = this.id;
									lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
									lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
									lPrix = parseFloat(this.prix);
									lStoQuantite = parseFloat(this.taille);

									$(that.mAchatOuReservation).each(function() {
										$(this.detailAchatSolidaire).each(function() {
											if(this.idDetailCommande == lLot.dcomId) {
												lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',','');
												
												lPrix = this.montant * -1;									
												lProduit.proPrix = lPrix.nombreFormate(2,',','');
												lLot.prixReservation = lPrix;
												
												that.mListeLotSolidaire.push({idPdt:lProduit.proId,idLot:lLot.dcomId});
												
												if(!lData.categoriesSolidaireAchat[lProduitCommande.idCategorie]) {
													lData.categoriesSolidaireAchat[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
												}
												lData.categoriesSolidaireAchat[lProduitCommande.idCategorie].produits.push(lProduit);

												lData.totalSolidaire += lPrix;
											}
										});										
									});
									
									lProduit.prixUnitaire = (lPrix / lStoQuantite).toFixed(2).nombreFormate(2,',',' '); 						
																			
									lProduit.lot.push(lLot);
								}
							});
							
							if(!lData.categoriesSolidaire[lProduitCommande.idCategorie]) {
								lData.categoriesSolidaire[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
							}
							lData.categoriesSolidaire[lProduitCommande.idCategorie].produits.push(lProduit);
						}
					});
				}
			});
						
			lData.typePaiement = that.mTypePaiement;
			
			
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
		} else {
			Infobulle.generer(pResponse,'');
		}
	};
	
	this.affect = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectListeBanque(pData);
		pData = this.affectNouveauSolde(pData);
		pData = gCommunVue.comNumeric(pData);
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
		var lTotal = this.totalSolidaire + this.total;
		$("#total-global").text(lTotal.nombreFormate(2,',',' '));
	};
	
	this.calculerTotal = function() {
		var lTotal = 0;
		$(".produit-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	};
	
	this.calculerTotalSolidaire = function() {
		var lTotal = 0;
		$(".produit-solidaire-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
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
		return this.solde - lAchats - lAchatsSolidaire + lRechargement;
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
			/*$(":input[name=champ-complementaire]").val('');
			$("#td-champ-complementaire").hide();*/
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
				/*$(".lot-vente-produit, #btn-annuler, #btn-modifier, .recap").toggle();	
				
				$(".lot-vente-produit-select").each(function() {
					var lval = $(this).find('option:selected').text();
					$(this).next().text(lval);
				});
				$(".produit-quantite,.produit-solidaire-quantite").each(function() {
					var lVal = parseFloat($(this).val().numberFrToDb());
					if(isNaN(lVal) || lVal == '' || lVal == 0) {
						lVal = '-';
					} else {
						lVal = lVal.nombreFormate(2,',',' ');
					}
					$(this).next(".recap-produit-quantite").text(lVal);
				});
				$(".produit-prix,.produit-solidaire-prix").each(function() {
					var lVal = parseFloat($(this).val().numberFrToDb());
					if(isNaN(lVal) || lVal == '' || lVal == 0) {
						lVal = '-';
					} else {
						lVal = lVal.nombreFormate(2,',',' ');
					}
					$(this).next(".recap-produit-prix").text(lVal);
				});
				
				var lVal = parseFloat($("#rechargementmontant").val().numberFrToDb());
				if(isNaN(lVal) || lVal == '' || lVal == 0) {
					lVal = '-';
				} else {
					lVal = lVal.nombreFormate(2,',',' ');
				}
				$("#recharger-montant-label").text(lVal);
				
				var lval = $("#rechargementtypePaiement").find('option:selected').val();
				if(lval == 0) {
					$("#rechargementtypePaiement-label").text("-");
				} else {
					$("#rechargementtypePaiement-label").text($("#rechargementtypePaiement").find('option:selected').text());
				}
				
				$("#rechargementchampComplementaire-label").text($("#rechargementchampComplementaire").val());*/
				

				var lVo = this.getAchatCommandeVO();
				
				
				var lCaisseTemplate = new CaisseTemplate();
				var lTemplate = lCaisseTemplate.achatMarcheDetail;
				
				var lData = new Object();
				/*lData.comNumero = pResponse.marche.numero;*/
				
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
						lProduit.stoQuantite = "";
						lProduit.proPrix = "";
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
								lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',',' ');
								lProduit.proPrix = (this.prix * -1).nombreFormate(2,',',' ');
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
						lProduitSolidaire.stoQuantite = "";
						lProduitSolidaire.proPrix = "";
						lProduitSolidaire.dcomTaille = "";
						
						lProduitSolidaire.flagType = "";
						if(this.type == 2) {
							lProduitSolidaire.flagType = lCaisseTemplate.flagAbonnement;
						}
						var lPrix = 0;
						$(lVo.produitsSolidaire).each(function() {
							if(this.id == lProduitSolidaire.proId) {
								lProduitSolidaire.stoQuantite = (this.quantite * -1).nombreFormate(2,',',' ');
								lProduitSolidaire.proPrix = (this.prix * -1).nombreFormate(2,',',' ');
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
							that.boutonModifier();
							Infobulle.generer(lVoRetour,"");
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
	};
	
	this.construct(pParam);
}