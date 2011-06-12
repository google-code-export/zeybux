;function AchatCommandeVue(pParam) {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
//	this.listeLot = new Array();
	this.mTypePaiement = [];
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	this.total = 0;
	this.totalSolidaire = 0;
	
	this.pdtCommande = new Array();
	
	this.construct = function(pParam) {
		var that = this;		 // TODO gestion avec param pour le server aussi
		this.idCommande = pParam.id_commande;
		this.idAdherent = pParam.id_adherent;
		
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pParam.id_commande + "&id_adherent=" + pParam.id_adherent,
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {						
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.idCompte = lResponse.adherent.adhIdCompte;
												
						$(lResponse.commande).each(function() {
							var lLot = new Object();
							
							lLot.dcomId = this.dcomId;
							lLot.dcomIdProduit = this.dcomIdProduit;
							lLot.dcomTaille = this.dcomTaille;
							lLot.dcomPrix = this.dcomPrix;
							
							if(that.pdtCommande[this.proId]) {
								that.pdtCommande[this.proId].lot[lLot.dcomId] = lLot;
								that.pdtCommande[this.proId].prixUnitaire = null;
							} else {			
								var lproduit = new Object();
								lproduit.proId = this.proId;
								lproduit.proUniteMesure = this.proUniteMesure;
								lproduit.proMaxProduitCommande = this.proMaxProduitCommande;
								
								$(lResponse.stock).each(function() { 
									if(this.proId == lproduit.proId) {
										if(parseFloat(this.stoQuantite) < parseFloat(lproduit.proMaxProduitCommande)) {
											 lproduit.proMaxProduitCommande = this.stoQuantite;
										}
									}
								});

								lproduit.nproNom = this.nproNom;
								lproduit.nproDescription = this.nproDescription;
								lproduit.nproIdCategorie = this.nproIdCategorie;
								lproduit.prixUnitaire = lLot.dcomPrix/lLot.dcomTaille;								
								
								lproduit.lot = new Array();
								lproduit.lot[lLot.dcomId] = lLot;								
								that.pdtCommande[lproduit.proId] = lproduit;
							}
						});
						
						/*$(that.pdtCommande).each(function() {
							if(this.proId) {
								$(this.lot).each(function() {alert('t');});
								if($(this.lot).size() == 1) {
									this.prixUnitaire = $(this.lot).first().dcomPrix/$(this.lot).first().dcomTaille;
								} else {
									this.prixUnitaire = null;
								}
							}
						});*/
						/*for(lLigne in lResponse.commande) {
							var lLot = new Object();
							lLot.quantite = lResponse.commande[lLigne].dcomTaille;
							lLot.prix = lResponse.commande[lLigne].dcomPrix						
							if(!that.listeLot[lResponse.commande[lLigne].proId]) {
								if(!isArray(that.listeLot[lResponse.commande[lLigne].proId])) {
									that.listeLot[lResponse.commande[lLigne].proId] = new Array();
								}
							}
							that.listeLot[lResponse.commande[lLigne].proId].push(lLot);
						}	*/					
						
						$(lResponse.typePaiement).each(function() {
							that.mTypePaiement[this.tppId] = this;
						});
						
						
						that.solde = parseFloat(lResponse.adherent.opeMontant);
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}					
				},"json"
		);
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			var that = this;
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.achatCommandePage;
			
			var lData = new Object();
			lData.comNumero = pResponse.commande[0].comNumero;
			
			lData.adhNumero = pResponse.adherent.adhNumero;
			lData.adhCompte = pResponse.adherent.cptLabel;
			lData.adhNom = pResponse.adherent.adhNom;
			lData.adhPrenom = pResponse.adherent.adhPrenom;
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			
			lData.produits = new Array();
			lData.produitsSolidaire = new Array();
			
			$(this.pdtCommande).each(function() {
				if(this.proId) {
					var lProduitCommande = this;
					var lProduit = new Object();
					lProduit.proId = this.proId;
					lProduit.nproNom = this.nproNom;
					lProduit.proUniteMesure = this.proUniteMesure;
					lProduit.stoQuantite = 0;
					lProduit.proPrix = 0;
					var lPrix = 0;
					$(pResponse.reservation).each(function() {
						if(this.proId == lProduit.proId) {
							lProduit.stoQuantite = this.stoQuantite * -1;
							lPrix = (lProduitCommande.lot[this.dcomId].dcomPrix/lProduitCommande.lot[this.dcomId].dcomTaille)*lProduit.stoQuantite;
							lProduit.proPrix = lPrix.nombreFormate(2,',',' ');
						}
					});
					lData.total += lPrix;
					lData.produits.push(lProduit);

					$(pResponse.stockSolidaire).each(function() {
						if(lProduit.proId == this.proId){
							lData.produitsSolidaire.push(lProduit);
						}
					});
				}
			});
			
			/*lListeIdProduit = new Array();
			for(lLigne in pResponse.commande) {
				lPush = true;
				for(lId in lListeIdProduit) {
					if(lListeIdProduit[lId] == pResponse.commande[lLigne].proId) {
						lPush = false;
					}
				}
				if(lPush) {
					lListeIdProduit.push(pResponse.commande[lLigne].proId);
					var lProduit = new Object();
					lProduit.proId = pResponse.commande[lLigne].proId;
					lProduit.nproNom = pResponse.commande[lLigne].nproNom;
					lProduit.proUniteMesure = pResponse.commande[lLigne].proUniteMesure;
					lProduit.stoQuantite = 0;
					lProduit.proPrix = 0;
					var lPrix = 0;
					for(lReservation in pResponse.reservation) {
						if(pResponse.reservation[lReservation].proId == lProduit.proId) {
							lProduit.stoQuantite = pResponse.reservation[lReservation].stoQuantite * -1;
							lPrix = this.calculPrixProduit(lProduit.proId,lProduit.stoQuantite);
							lProduit.proPrix = lPrix.nombreFormate(2,',',' ');
						}						
					}
					lData.total += lPrix;
					lData.produits.push(lProduit);
				
				
					$(pResponse.stockSolidaire).each(function() {
						if(pResponse.commande[lLigne].proId == this.proId){
							var lProduitSolidaire = {};
							lProduitSolidaire.proId = this.proId;
							lProduitSolidaire.nproNom = pResponse.commande[lLigne].nproNom;
							lProduitSolidaire.proUniteMesure = pResponse.commande[lLigne].proUniteMesure;
							lData.produitsSolidaire.push(lProduitSolidaire);
						}
					});
				}
			}*/
			
			lData.adhSolde = parseFloat(pResponse.adherent.opeMontant);
			//lData.adhNouveauSolde =  lData.adhSolde-lData.total;
			/*alert('Solde :'+ lData.adhSolde);
			alert('total :'+ lData.total);
			alert('NvSolde :'+ lData.adhNouveauSolde);
			alert('NvSolde2 :'+ lData.adhSolde-lData.total);*/
			
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');
			//lData.adhNouveauSolde = lData.adhNouveauSolde.nombreFormate(2,',',' ');
			lData.total = lData.total.nombreFormate(2,',',' ');
			that.total = lData.total;
			
			lData.typePaiement = that.mTypePaiement;
			
			$('#contenu').replaceWith( that.affect($(lTemplate.template(lData))) );
			that.changerTypePaiement($(":input[name=typepaiement]"));
			that.majNouveauSolde();
		} else {
			Infobulle.generer(pResponse,'');
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectNouveauPrixProduit(pData);
		pData = this.affectChampComplementaire(pData);
		pData = this.affectValider(pData);
		pData = this.affectAnnuler(pData);
		pData = this.affectModifier(pData);
		pData = this.affectSupprimerPdt(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
			that.controlerAchat();
		});
		return pData;
	}
	
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
	}
		
	this.affectNouveauPrixProduit = function(pData) {
		var that = this;
		pData.find(".produit-quantite").keyup(function() {
				that.majPrixProduit($(this));
				that.controlerAchat();
		});
		pData.find(".produit-solidaire-quantite").keyup(function() {
			that.controlerAchat();
		});
		return pData;
	}
	
	this.affectChampComplementaire = function(pData) {
		var that = this;
		pData.find(":input[name=champ-complementaire]").keyup(function() {that.controlerAchat();});		
		return pData;
	}
	
	this.affectValider = function(pData) {
		var that = this;
		pData.find("#btn-valider").click(function() {that.creerRecapitulatif();});		
		return pData;
	}
	
	this.affectAnnuler = function(pData) {
		var that = this;
		pData.find("#btn-annuler").click(function() {that.retourListe();});		
		return pData;
	}
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find("#btn-modifier").click(function() {that.boutonModifier();});		
		return pData;
	}
	
	this.affectSupprimerPdt = function(pData) {
		if(pData.find(".ligne-produit").size() == 0) {
			pData.find("#achat-pdt-widget").remove();
		}
		if(pData.find(".ligne-produit-solidaire").size() == 0) {
			pData.find("#achat-pdt-solidaire-widget").remove();
		}
		return pData;
	}
	
	this.majPrixProduit = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		var lIdProduit = ligne.find(".produit-id").text();
		var lNvPrix = 0;
		
		if(this.pdtCommande[lIdProduit].prixUnitaire != null) {
			lNvPrix = this.pdtCommande[lIdProduit].prixUnitaire * lQuantite;
		}			
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		if(lNvPrix != 0) {
			ligne.find(".produit-prix").val(lNvPrix.nombreFormate(2,',',' '));
		} else {
			ligne.find(".produit-prix").val('');
		}
		
		this.majNouveauSolde();		
	}
	
	this.controlerAchat = function() {
		Infobulle.init(); // Supprime les erreurs
		var lValid = new AchatCommandeValid();
		var lVr = lValid.validAjout(this.getAchatCommandeVO());
		Infobulle.generer(lVr,'');
		return lVr;
	}
	
	/*this.calculPrixProduit = function(pIdProduit,pQuantite) {
		if(this.pdtCommande[pIdProduit]) {
			var lLots = this.listeLot[pIdProduit];
			var lPrix = 0;			
			for(lLot in lLots) {
				if(pQuantite % lLots[lLot].quantite == 0) {
					lPrix = (pQuantite / lLots[lLot].quantite) * lLots[lLot].prix;
				}
			}			
			return lPrix;
		}
		return 0;
	}*/
	
	this.majTotal = function() {
		var lTotal = this.calculerTotal();
		$("#total-achat").text(lTotal.nombreFormate(2,',',' '));
		this.total = lTotal;
	}
	
	this.majTotalSolidaire = function() {
		var lTotalSolidaire = this.calculerTotalSolidaire();
		$("#total-achat-solidaire").text(lTotalSolidaire.nombreFormate(2,',',' '));
		this.totalSolidaire = lTotalSolidaire;
	}
	
	this.calculerTotal = function() {
		var lTotal = 0;
		$(".produit-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	}
	
	this.calculerTotalSolidaire = function() {
		var lTotal = 0;
		$(".produit-solidaire-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	}
	
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
	}
	
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
	}
	
	this.calculNouveauSolde = function() {
		var lAchats = this.total;// parseFloat($("#total-achat").val().numberFrToDb());
		if(isNaN(lAchats)) {lAchats = 0;}
		var lAchatsSolidaire = this.totalSolidaire; //parseFloat($("#total-achat-solidaire").val().numberFrToDb());
		if(isNaN(lAchatsSolidaire)) {lAchatsSolidaire = 0;}
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}		
		return this.solde - lAchats - lAchatsSolidaire + lRechargement;
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
	
	this.getAchatCommandeVO = function() {
		var lVo = new AchatCommandeVO();
		lVo.id = this.idCommande;
		lVo.idCompte = this.idCompte;
		lVo.produits = this.getProduitsVO();
		lVo.produitsSolidaire = this.getProduitsSolidaireVO();
		lVo.rechargement = this.getRechargementVO();		
		lVo.NbProduits = $('.ligne-produit').size();
		lVo.NbProduitsSolidaire = $('.ligne-produit-solidaire').size();		
		return lVo;
	}	
	
	this.getProduitsVO = function() {
		var lVo = new Array();		
		$(".ligne-produit").each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).find(".produit-id").text();			
			var lQuantite = $(this).find(".produit-quantite").val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty()){
				lQuantite = parseFloat(lQuantite);
			}
			lVoProduit.quantite = lQuantite;
			
			var lprix = $(this).find(".produit-prix").val().numberFrToDb();
			if(!isNaN(lprix) && !lprix.isEmpty()){
				lprix = parseFloat(lprix);
			}
			lVoProduit.prix = lprix;
						
			lVo.push(lVoProduit);			
		});		
		return lVo;
	}
	
	this.getProduitsSolidaireVO = function() {
		var lVo = new Array();		
		$(".ligne-produit-solidaire").each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).find(".produit-id").text();			
			var lQuantite = $(this).find(".produit-solidaire-quantite").val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty()){
				lQuantite = parseFloat(lQuantite);
			}
			lVoProduit.quantite = lQuantite;
			
			var lprix = $(this).find(".produit-solidaire-prix").val().numberFrToDb();
			if(!isNaN(lprix) && !lprix.isEmpty()){
				lprix = parseFloat(lprix);
			}
			lVoProduit.prix = lprix;
			
			lVo.push(lVoProduit);			
		});		
		return lVo;
	}
	
	this.getRechargementVO = function() {
		var lVo = new RechargementCompteVO();
		lVo.id = this.idCompte;
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
	
	this.creerRecapitulatif = function() {
		var lVr = this.controlerAchat();
		if(lVr.valid) {
			if(this.etapeValider == 0) {
				$(".produit-quantite,.produit-solidaire-quantite,#rechargementchampComplementaire,#rechargementtypePaiement").each(function() {$(this).inputToText();});
				$(".produit-prix,.produit-solidaire-prix,#rechargementmontant").each(function() {$(this).inputToText("montant");});
				$("#btn-modifier").show();
				$("#btn-annuler").hide();
				this.etapeValider = 1;
			} else if(this.etapeValider == 1) {
				this.enregistrerAchat();
			}
		}
	}
	
	this.enregistrerAchat = function() {
		var that = this;
		var lVo = this.getAchatCommandeVO();
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","achat=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour.valid) {
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.achatCommandeSucces;
						$('#contenu').replaceWith(that.affectAnnuler($(lTemplate)));
					} else {
						that.boutonModifier();
						Infobulle.generer(lVoRetour,"");
					}
					that.etapeValider = 0;
				},"json"
			);
	}
	
	this.boutonModifier = function() {
		if(this.etapeValider == 1) {
			$(".produit-prix,.produit-solidaire-prix,#rechargementmontant,.produit-quantite,.produit-solidaire-quantite,#rechargementchampComplementaire,#rechargementtypePaiement").each(function() {$(this).textToInput();});
			$("#btn-modifier").hide();
			$("#btn-annuler").show();
			this.etapeValider = 0;
		}
	}
	
	this.retourListe = function() {
		MarcheCommandeVue({id_commande:this.idCommande});
	}
	
	this.construct(pParam);
}