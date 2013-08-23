;function EditionFactureVue(pParam) {
	this.mListeProduit = [];
	this.mDetailFacture = [];
	this.mFactureInitiale = {};
	this.mCompteurStock = 0;
	this.mNbProduit = 0;
	this.mTypePaiementSelect = 0;
	this.mTypePaiement = [];
	this.mBanques = [];
	this.mFermes = [];
	this.mTypeEdition = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {EditionFactureVue(pParam);}} );
		var that = this;
		
		var lVo = {};
		if(pParam && pParam.id) { // Affiche une facture
			lVo.id = pParam.id;
			lVo.fonction = 'afficherFacture';
			this.mTypeEdition = 1;
		} else { // Le formulaire de création de facture
			lVo.fonction = 'listeFerme';
			this.mTypeEdition = 0;
		}
		
		$.post(	"./index.php?m=GestionCommande&v=Facture", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mTypePaiement = lResponse.typePaiement;
							that.mBanques = lResponse.banques;
							
							if(that.mTypeEdition == 0) { // Pour la création
								$(lResponse.listeFerme).each(function() {
									that.mFermes[this.ferId] = this;
								});
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
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		if(this.mTypeEdition == 0) { // Pour le formulaire de création
			if(lResponse.listeFerme.length > 0 && lResponse.listeFerme[0].ferId != null) {		
				lResponse.listeFermeAffiche = lGestionCommandeTemplate.factureSelectFerme.template(lResponse);
			} else {
				// Pas de ferme on n'affiche pas le formulaire
				var lVR = new Object();
				var erreur = new VRerreur();
				erreur.code = ERR_265_CODE;
				erreur.message = ERR_265_MSG;
				lVR.valid = false;
				lVR.log = new VRelement();
				lVR.log.valid = false;
				lVR.log.erreurs.push(erreur);
				Infobulle.generer(lVR,'');
			}
		} else { // Affiche et modification de facture
			this.mResponseAfficheFacture = lResponse;
			
			lResponse.numeroFacture = lResponse.facture.id.champComplementaire[11].valeur;
			lResponse.listeFermeAffiche = lResponse.ferme.nom;
		}
		
		$('#contenu').replaceWith(that.affect($(lGestionCommandeTemplate.facture.template(lResponse))));	
		
		if(this.mTypeEdition == 1) {
			this.afficheListeProduit(lResponse);
		}
	};
	
	this.affect = function(pData) {
		pData = this.retour(pData);
		pData = this.affectSelectFerme(pData);
		pData = this.affectExport(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectExport = function(pData) {
		if(this.mTypeEdition == 1) {
			pData.find('#btn-export-facture').show();
		}
		return pData;
	};
	
	this.retour = function(pData){
		pData.find('#btn-retour').click(function() {
			FactureVue();
		});
		return pData;
	};
	
	this.affectSelectFerme = function(pData) {
		var that = this;
		pData.find('#select-ferme').change(function() {
			var lIdFerme = $(this).val();
			that.mCompteurStock = 0;
			that.mDetailFacture = [];
			that.mNbProduit = 0;
			if(lIdFerme == 0) {
				$('#btn-export-facture, #liste-pdt').hide();
			} else {
				var lVo = {fonction:"listeProduitFerme",id:lIdFerme};
				$.post(	"./index.php?m=GestionCommande&v=Facture", "pParam=" + $.toJSON(lVo),
						function(lResponse) {
							Infobulle.init(); // Supprime les erreurs
							if(lResponse) {
								if(lResponse.valid) {
									if(pParam && pParam.vr) {
										Infobulle.generer(pParam.vr,'');
									}
									that.afficheListeProduit(lResponse);
								} else {
									Infobulle.generer(lResponse,'');
								}
							}
						},"json"
				);
			}
		});
		return pData;
	};

	this.afficheListeProduit = function(pResponse) {
		var that = this;
		this.mFactureInitiale = clone(pResponse);
		this.mListeProduit = [];

		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		if(pResponse.listeProduit.length > 0 && pResponse.listeProduit[0].nproId != null) {
			
			// Catalogue de produit
			$.each(pResponse.listeProduit,function() {
				if(that.mListeProduit[this.cproNom]) {
					that.mListeProduit[this.cproNom].produits.push(this);
				} else {
					that.mListeProduit[this.cproNom] = {id:this.cproId,nom:this.cproNom,produits:[this]};
				}
			});
			pResponse.listeProduit = this.mListeProduit;

			// Le paiement
			pResponse.banques = this.mBanques;
			pResponse.sigleMonetaire = gSigleMonetaire;
			pResponse.typePaiement = this.mTypePaiement;
			
			if(this.mTypeEdition == 1) {
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
				pResponse.champComplementaireAffiche = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, this.mBanques, true);
			}

			pResponse.detailFacture = lGestionCommandeTemplate.detailFactureVide.template(pResponse);
			var lData = $(lGestionCommandeTemplate.listeProduitFerme.template(pResponse));
			
			if(this.mTypeEdition == 1) {
				lData.find('#affiche-paiement-facture').toggle();
			}
			
			$('#liste-pdt').replaceWith(this.affectListeProduit(lData));	
			
			// Le détail de la facture
			if(this.mTypeEdition == 1) {
				this.afficheDetailProduit(pResponse.facture);
			}		
		} else {
			$('#liste-pdt').replaceWith(lGestionCommandeTemplate.listeProduitFermeVide);
		}
	};
	
	this.affectListeProduit = function(pData) {
		pData = this.affectRecherche(pData);
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectAjoutProduitDetail(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectModifier(pData);
		pData = this.affectSupprimer(pData);
		pData = this.affectAnnulerModifier(pData);
		
		var lTypePaiementService = new TypePaiementService();
		pData = lTypePaiementService.affect(pData, this.mBanques);
		
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
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
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTypePaiementService = new TypePaiementService();
			$('#ligne-operation').after(lTypePaiementService.affect($(lGestionCommandeTemplate.champComplementaire.template(this.mTypePaiement[lId])), this.mBanques));
		}
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter-produit").keyup(function() {
		    $.uiTableFilter( $('#table-produit'), this.value );
		  });
		
		pData.find("#filter-form-produit").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectAjoutProduitDetail = function(pData) {
		var that = this;
		pData.find('.btn-ajout-produit').click(function() {
			var lIdNomProduit = $(this).data('id-nom-produit');
			$.post(	"./index.php?m=GestionCommande&v=Facture", "pParam=" + $.toJSON({fonction: 'uniteProduit',id: lIdNomProduit}),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								that.ajoutProduitDetail(lResponse);
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		});
		return pData;
	};
	
	this.ajoutProduitDetail = function(lResponse) {
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		// Ajout de la categorie	
		if(!this.mDetailFacture[lResponse.uniteNomProduit.cproId] || (this.mDetailFacture[lResponse.uniteNomProduit.cproId] && this.mDetailFacture[lResponse.uniteNomProduit.cproId].nbProduit < 1)) {		
			if(this.mDetailFacture.length == 0) { // Première catégorie du détail
				$('#table-detail-facture tbody').prepend(lGestionCommandeTemplate.categorieDetailFacture.template(lResponse.uniteNomProduit));
			} else {
				var lPosition = 0;
				var lIdCategorie = 0;
				for(i in this.mListeProduit) {
					if(lResponse.uniteNomProduit.cproId == this.mListeProduit[i].id) {
						lPosition = lIdCategorie;
					}
					if($('.cat-' + this.mListeProduit[i].id).length > 0) {
						lIdCategorie = this.mListeProduit[i].id;
					}
				}
				// Si elle doit être placée en premier
				if(lPosition == 0) {
					$('#table-detail-facture tbody').prepend(lGestionCommandeTemplate.categorieDetailFacture.template(lResponse.uniteNomProduit));
				} else {
					$('.cat-' + lPosition).last().after(lGestionCommandeTemplate.categorieDetailFacture.template(lResponse.uniteNomProduit));
				}
			}
			this.mDetailFacture[lResponse.uniteNomProduit.cproId] = {produits:[], nbProduit: 0};
		}
		this.mDetailFacture[lResponse.uniteNomProduit.cproId].nbProduit++;
		
		lResponse.uniteNomProduit.sigleMonetaire = gSigleMonetaire;
		
		// L'unite
		if(lResponse.uniteNomProduit.mLotUnite.length == 1) {
			lResponse.uniteNomProduit.unite = lResponse.uniteNomProduit.mLotUnite[0];
			lResponse.uniteNomProduit.uniteSolidaire = lResponse.uniteNomProduit.mLotUnite[0];
		} else {
			var lTabUnite = [];
			$.each(lResponse.uniteNomProduit.mLotUnite, function() {
				lTabUnite.push({unite:this});
			});
			lResponse.uniteNomProduit.unite = lGestionCommandeTemplate.uniteDetailFactureSelect.template({mLotUnite:lTabUnite,type:''});
			lResponse.uniteNomProduit.uniteSolidaire = lGestionCommandeTemplate.uniteDetailFactureSelect.template({mLotUnite:lTabUnite,type:'Solidaire'});
		}
		
		lResponse.uniteNomProduit.compteurStock = this.mCompteurStock;
		this.mCompteurStock++;
		
		// Ajout du produit
		if(this.mDetailFacture[lResponse.uniteNomProduit.cproId].produits.length == 0) { // Premier produit de la catégorie
			$('#cat-' + lResponse.uniteNomProduit.cproId).after(this.affectProduitDetailFacture($(lGestionCommandeTemplate.produitDetailFacture.template(lResponse.uniteNomProduit))));
		} else { // Recherche de la position
			var lPosition = 0;
			var lIdProduit = 0;

			for(i in this.mListeProduit[lResponse.uniteNomProduit.cproNom].produits) {
				if(lResponse.uniteNomProduit.nproId == this.mListeProduit[lResponse.uniteNomProduit.cproNom].produits[i].nproId) {
					lPosition = lIdProduit;
				}
				if($('.pro-' + this.mListeProduit[lResponse.uniteNomProduit.cproNom].produits[i].nproId).length > 0) {
					lIdProduit = this.mListeProduit[lResponse.uniteNomProduit.cproNom].produits[i].nproId;
				}
			}

			// Si elle doit être placée en premier
			if(lPosition == 0) {
				$('#cat-' + lResponse.uniteNomProduit.cproId).after(this.affectProduitDetailFacture($(lGestionCommandeTemplate.produitDetailFacture.template(lResponse.uniteNomProduit))));
			} else {
				$('.pro-' + lPosition).last().after(this.affectProduitDetailFacture($(lGestionCommandeTemplate.produitDetailFacture.template(lResponse.uniteNomProduit))));
			}
		}
		
		if(this.mDetailFacture[lResponse.uniteNomProduit.cproId].produits[lResponse.uniteNomProduit.nproId]) {
			this.mDetailFacture[lResponse.uniteNomProduit.cproId].produits[lResponse.uniteNomProduit.nproId].produit.push(lResponse.uniteNomProduit);
		} else {
			this.mDetailFacture[lResponse.uniteNomProduit.cproId].produits[lResponse.uniteNomProduit.nproId] = {produit:[lResponse.uniteNomProduit]};
		}
		
		if(this.mNbProduit == 0) { // Affiche le détail dès le premier produit
			if(this.mTypeEdition == 0) { 
				$('.detail-facture, #form-affiche-paiement-facture').toggle();
			} else if(this.mTypeEdition == 1) { // Pour la modification on affiche de nouveau le bouton enregistrer
				$('#btn-enregistrer-modifier-facture').show();
			}
		}
		this.mNbProduit++;
	};
	
	this.affectProduitDetailFacture = function(pData) {
		pData = this.affectSupprimerProduit(pData);
		pData = this.affectCalculTotal(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectSupprimerProduit = function(pData) {
		var that = this;
		pData.find('.btn-supprimer-produit').click(function() {
			
			var lCompteurStock = $(this).data('compteur-stock');
			//var lNproId = $(this).data('id-nom-produit');
			var lCproId = $(this).data('id-categorie');
			
			// Suppression du produit
			$('#stock-'+ lCompteurStock).remove();
			//that.mDetailFacture[lCproId].produits[lNproId]--;
			
			// Suppression de la categorie
			that.mDetailFacture[lCproId].nbProduit--;
			if(that.mDetailFacture[lCproId].nbProduit == 0) {
				$('#cat-' + lCproId).remove();
			}
			
			// Masque le détail de produit
			that.mNbProduit--;
			
			if(that.mNbProduit == 0) { 
				// Pour la création il faut au moins un produit
				if(that.mTypeEdition == 0) {
					$('.detail-facture, #form-affiche-paiement-facture').toggle();
					$('.champ-complementaire').remove();
					$('#typePaiement').selectOptions("0");
					$('#montant').val('');
				} else if(that.mTypeEdition == 1) { // Pour la modification on garde le bouton annuler
					$('#btn-enregistrer-modifier-facture').hide();
				}
			}
			
			// Mise à jour du total
			that.majTotal();
		});
		return pData;
	};
	
	this.affectCalculTotal = function(pData) {
		var that = this;
		pData.find('.montant-produit').keyup(function() {
			that.majTotal();
		});
		return pData;
	};
	
	this.majTotal = function() {
		var lTotal = 0;
		$('.montant-produit').each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(!isNaN(lMontant)) {
				lTotal = (parseFloat(lTotal) + lMontant).toFixed(2);
			}
		});
		$('#montant').val(lTotal.nombreFormate(2,',',''));
	};
	
	this.afficheDetailProduit = function(pFacture) {
		var that = this;
		this.mDetailFacture = [];
		this.mNbProduit = 0;
		
		var lDetailProduitFacture = [];
		$(pFacture.produits).each(function() {	
			// Ajoute la categorie
			if(!that.mDetailFacture[this.cproId]) { 
				that.mDetailFacture[this.cproId] = {cproId: this.cproId, cproNom: this.cproNom, produits:[], nbProduit: 0};
				lDetailProduitFacture[this.cproNom] = {cproId: this.cproId, cproNom: this.cproNom, produits:[] };
			}
			that.mDetailFacture[this.cproId].nbProduit++;
			
			this.compteurStock = that.mCompteurStock;
			that.mCompteurStock++;
			
			this.nproId = this.idNomProduit;
			
			if(this.quantite == null) {
				this.quantiteAffiche = '';
				this.quantite = '';
				this.uniteAffiche  = '';
				this.unite = this.uniteSolidaire;
				this.montantAffiche = '';
				this.montant = '';
				this.sigleMonetaireAffiche = '';				
			} else {
				var lQuantite = this.quantite;
				this.quantiteAffiche = lQuantite.nombreFormate(2,',',' ');
				this.quantite = lQuantite.nombreFormate(2,',','');
				this.uniteAffiche  = this.unite;
				
				var lMontant = this.montant;
				this.montantAffiche = lMontant.nombreFormate(2,',',' ');
				this.montant = lMontant.nombreFormate(2,',','');
				
				this.sigleMonetaireAffiche = gSigleMonetaire;
			}
			this.sigleMonetaire = gSigleMonetaire;
			
			if(this.quantiteSolidaire == null) {
				this.quantiteSolidaireAffiche = '';
				this.quantiteSolidaire = '';
				
				this.uniteSolidaireAffiche = '';
				this.uniteSolidaire = this.unite;
			} else {
				var lQuantiteSolidaire = this.quantiteSolidaire;
				this.quantiteSolidaireAffiche = lQuantiteSolidaire.nombreFormate(2,',',' ');
				this.quantiteSolidaire = lQuantiteSolidaire.nombreFormate(2,',','');
				
				this.uniteSolidaireAffiche = this.uniteSolidaire;
			}		
			
			// Ajoute le produit
			if(that.mDetailFacture[this.cproId].produits[this.nproId]) {
				that.mDetailFacture[this.cproId].produits[this.nproId].produit.push(this);
				lDetailProduitFacture[this.cproNom].produits[this.nproNom].produit.push(this);
			} else {
				that.mDetailFacture[this.cproId].produits[this.nproId] = {produit:[this]};
				lDetailProduitFacture[this.cproNom].produits[this.nproNom] = {produit:[this]};
			}
			
			that.mNbProduit++;
		});
		
		if(this.mNbProduit > 0) { // Affiche le détail dès le premier produit
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			$('#table-detail-facture tbody').prepend(that.affectProduitDetailFacture($(lGestionCommandeTemplate.listeProduitAffiche.template({categorie:lDetailProduitFacture}))));
			$('.detail-facture, #widget-catalogue-produit, #btn-enregistrer-facture, #btn-modifier-facture, #btn-supprimer-facture').toggle();
		}
	};
		
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find('#btn-enregistrer-facture, #btn-enregistrer-modifier-facture').click(function() {
			that.enregistrer();
		});
		return pData;
	};	
		
	this.enregistrer = function() {	
		var that = this;
		var lVo = new FactureVO();
		
		$('.produit-detail-facture').each(function() {
			var lProduitDetailFacture = new ProduitDetailFactureVO();
			lProduitDetailFacture.idNomProduit = $(this).data('id-nom-produit');
			
			lProduitDetailFacture.idStock = $(this).find('.produit-detail-facture-stock').data('id-stock');
			if(lProduitDetailFacture.idStock == undefined) {
				lProduitDetailFacture.idStock = '';
			}
			lProduitDetailFacture.idDetailOperation = $(this).find('.produit-detail-facture-montant').data('id-detail-operation');
			if(lProduitDetailFacture.idDetailOperation == undefined) {
				lProduitDetailFacture.idDetailOperation = '';
			}
			lProduitDetailFacture.idStockSolidaire = $(this).find('.produit-detail-facture-stock-solidaire').data('id-stock-solidaire');
			if(lProduitDetailFacture.idStockSolidaire == undefined) {
				lProduitDetailFacture.idStockSolidaire = '';
			}
						
			var lQuantite = $(this).find('.produit-detail-facture-stock :input').val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty()){ lQuantite = parseFloat(lQuantite); } else { lQuantite = ''; }
			lProduitDetailFacture.quantite = lQuantite;
			
			lProduitDetailFacture.unite = ($(this).find('.produit-detail-facture-stock select').length == 1) ? $(this).find('.produit-detail-facture-stock select').val() : $(this).find('.produit-detail-facture-stock .facture-detail-unite-span').text();
			
			var lQuantiteSolidaire = $(this).find('.produit-detail-facture-stock-solidaire :input').val().numberFrToDb();
			if(!isNaN(lQuantiteSolidaire) && !lQuantiteSolidaire.isEmpty()){ lQuantiteSolidaire = parseFloat(lQuantiteSolidaire); } else { lQuantiteSolidaire = ''; }
			lProduitDetailFacture.quantiteSolidaire = lQuantiteSolidaire;
			
			lProduitDetailFacture.uniteSolidaire = ($(this).find('.produit-detail-facture-stock-solidaire select').length == 1) ? $(this).find('.produit-detail-facture-stock-solidaire select').val() : $(this).find('.produit-detail-facture-stock-solidaire .facture-detail-unite-span').text();
			
			var lMontant = $(this).find('.produit-detail-facture-montant :input').val().numberFrToDb();
			if(!isNaN(lMontant) && !lMontant.isEmpty()){ lMontant = parseFloat(lMontant); } else { lMontant = ''; }
			lProduitDetailFacture.montant = lMontant;
			
			lVo.produits[$(this).data('compteur-stock')] = lProduitDetailFacture;
		});
		
		lOperationProducteur = new OperationDetailVO();
		
		// Récupération du compte en fonction d'ajout ou de modification
		if(this.mTypeEdition == 0) {
			lOperationProducteur.idCompte = this.mFermes[$('#select-ferme').val()].ferIdCompte;
		} else if(this.mTypeEdition == 1) {
			lOperationProducteur.idCompte = this.mFactureInitiale.facture.operationProducteur.idCompte;
		}
		
		var lMontant = $(":input[name=montant-total]").val().numberFrToDb();
		if(!isNaN(lMontant) && !lMontant.isEmpty()){
			lMontant = parseFloat(lMontant);
		} else {
			lMontant = '';
		}
		lOperationProducteur.montant = lMontant;
		lOperationProducteur.typePaiement = $(":input[name=typepaiement]").val();
		
		if(this.mTypePaiement[lOperationProducteur.typePaiement]) {
			var lTypePaiementService = new TypePaiementService();
			lOperationProducteur.champComplementaire = lTypePaiementService.getChampComplementaire(this.mTypePaiement[lOperationProducteur.typePaiement].champComplementaire);
		}
		
		lVo.operationProducteur = lOperationProducteur;
		
		var lId = new OperationDetailVO();
		// Pour modification ajout de l'id de la facture
		if(this.mTypeEdition == 1) {
			lId.id = this.mFactureInitiale.facture.id.id;	
		}
		lVo.id = lId;

		var lValid = new FactureValid();
		var lVr = lValid.validEnregistrer(lVo);

		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "enregistrer";
			$.post(	"./index.php?m=GestionCommande&v=Facture", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_362_CODE;
						erreur.message = ERR_362_MSG;
						lVr.log.erreurs.push(erreur);
						that.construct({vr:lVr,id:lResponse.id});
						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.affectModifier = function(pData) {
		pData.find('#btn-modifier-facture').click(function() {
			$('.affiche-detail-facture, #affiche-paiement-facture, #form-affiche-paiement-facture, #btn-export-facture, #widget-catalogue-produit, #btn-modifier-facture, #btn-supprimer-facture, #btn-annuler-modifier-facture, #btn-enregistrer-modifier-facture').toggle();
		});
		return pData;
	};
	
	this.affectAnnulerModifier = function(pData) {
		var that = this;
		pData.find('#btn-annuler-modifier-facture').click(function() {
			that.afficheListeProduit(that.mFactureInitiale);
			$('#btn-export-facture').show();
		});
		return pData;
	};
	
	this.affectSupprimer = function(pData) {
		var that = this;
		pData.find('#btn-supprimer-facture').click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			$(lGestionCommandeTemplate.dialogSupprimerFacture).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lDialog = this;
						var lVo = {fonction:'supprimer', id:that.mFactureInitiale.facture.id.id};						
						$.post(	"./index.php?m=GestionCommande&v=Facture", "pParam=" + $.toJSON(lVo),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											// Message d'information
											var lVr = new TemplateVR();
											lVr.valid = false;
											lVr.log.valid = false;
											var erreur = new VRerreur();
											erreur.code = ERR_363_CODE;
											erreur.message = ERR_363_MSG;
											lVr.log.erreurs.push(erreur);
											FactureVue({vr:lVr});
											
											$(lDialog).dialog('close');
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
};