;function AchatCommandeVue(pParam) {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.listeLot = new Array();
	this.mTypePaiement = [];
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	
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
						for(lLigne in lResponse.commande) {
							var lLot = new Object();
							lLot.quantite = lResponse.commande[lLigne].dcomTaille;
							lLot.prix = lResponse.commande[lLigne].dcomPrix						
							if(!that.listeLot[lResponse.commande[lLigne].proId]) {
								if(!isArray(that.listeLot[lResponse.commande[lLigne].proId])) {
									that.listeLot[lResponse.commande[lLigne].proId] = new Array();
								}
							}
							that.listeLot[lResponse.commande[lLigne].proId].push(lLot);
						}						
						
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
			lListeIdProduit = new Array();
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
				}
			}
			lData.adhSolde = parseFloat(pResponse.adherent.opeMontant);
			lData.adhNouveauSolde =  lData.adhSolde-lData.total;
			
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');
			lData.adhNouveauSolde = lData.adhNouveauSolde.nombreFormate(2,',',' ');
			lData.total = lData.total.nombreFormate(2,',',' ');
			
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
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {that.changerTypePaiement($(this))});
		return pData;
	}
	
	this.affectNouveauSolde = function(pData) {
		var that = this;
		pData.find(":input[name=montant-rechargement], .produit-prix").keyup(function() {
			that.majNouveauSolde();	
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
	
	this.majPrixProduit = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		var lIdProduit = ligne.find(".produit-id").text();
		var lNvPrix = this.calculPrixProduit(lIdProduit,lQuantite);		
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		ligne.find(".produit-prix").val(lNvPrix.nombreFormate(2,',',' '));	
		this.majNouveauSolde();	
	}
	
	this.controlerAchat = function() {
		Infobulle.init(); // Supprime les erreurs
		var lValid = new AchatCommandeValid();
		var lVr = lValid.validAjout(this.getAchatCommandeVO());
		Infobulle.generer(lVr,'');
		return lVr;
	}
	
	this.calculPrixProduit = function(pIdProduit,pQuantite) {
		if(this.listeLot[pIdProduit]) {
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
	}
	
	this.majTotal = function() {
		var that = this;
		$("#total-achat").text(that.calculerTotal().nombreFormate(2,',',' '));
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
	
	this.calculNouveauSolde = function() {
		var lAchats = parseFloat($("#total-achat").text().numberFrToDb());
		if(isNaN(lAchats)) {lAchats = 0;}
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}
		return this.solde - lAchats + lRechargement;
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
		lVo.rechargement = this.getRechargementVO();
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
				$(".produit-quantite,#rechargementchampComplementaire,#typepaiement").each(function() {$(this).inputToText();});
				$(".produit-prix,#rechargementmontant").each(function() {$(this).inputToText("montant");});
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
			$(".produit-prix,#rechargementmontant,.produit-quantite,#rechargementchampComplementaire,#typepaiement").each(function() {$(this).textToInput();});
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