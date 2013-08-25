;function EditerCommandeVue(pParam) {
	this.mArchive = -1;
	this.mIdMarche = null;
	this.mMarche = new MarcheVO();
	//this.mAffichageMarche = [];
	this.mListeFerme = null;
	this.mEditionLot = false;
	this.mIdLot = 0;
	this.mIdLotAbonnement = 0;
	this.mNbProduit = 0;
	this.mProduits = [];
	this.mParam = null;
	this.mLotRemplacement = [];
	this.mLotReservation = [];
	this.mTailleLotResaMax = -1;
	this.mQuantiteReservation = -1;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {EditerCommandeVue(pParam);}} );
		this.mParam = pParam;
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							
							delete that.mProduits;
							that.mProduits = [];
							
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
		
		var lData = {};
		
		lData.comId = pResponse.marche.id;
		this.mIdMarche = lData.comId;
		lData.comNumero = pResponse.marche.numero;
		lData.nom = pResponse.marche.nom;
		lData.comDescription = pResponse.marche.description;
		lData.dateTimeDebutReservation = pResponse.marche.dateDebutReservation;
		lData.dateDebutReservation = pResponse.marche.dateDebutReservation.extractDbDate().dateDbToFr();
		lData.heureDebutReservation = pResponse.marche.dateDebutReservation.extractDbHeure();
		lData.minuteDebutReservation = pResponse.marche.dateDebutReservation.extractDbMinute();		
		lData.dateTimeFinReservation = pResponse.marche.dateFinReservation;
		lData.dateFinReservation = pResponse.marche.dateFinReservation.extractDbDate().dateDbToFr();
		lData.heureFinReservation = pResponse.marche.dateFinReservation.extractDbHeure();
		lData.minuteFinReservation = pResponse.marche.dateFinReservation.extractDbMinute();
		lData.dateMarcheDebut = pResponse.marche.dateMarcheDebut.extractDbDate().dateDbToFr();
		lData.heureMarcheDebut = pResponse.marche.dateMarcheDebut.extractDbHeure();
		lData.minuteMarcheDebut = pResponse.marche.dateMarcheDebut.extractDbMinute();
		lData.heureMarcheFin = pResponse.marche.dateMarcheFin.extractDbHeure();
		lData.minuteMarcheFin = pResponse.marche.dateMarcheFin.extractDbMinute();
		lData.archive = pResponse.marche.archive;
				
		var lAffichageMarche = [];
		$.each(pResponse.marche.produits,function() {
			var lIdFerme = this.ferId;
			var lIdCategorie = this.idCategorie;
			var lIdNomProduit = this.idNom;
			var lTypeProduit = this.type;
			
			if(lTypeProduit == 0 || lTypeProduit == 2) { // Si normal ou abonnement
				var lQteReservation = parseFloat(this.stockInitial) - parseFloat(this.stockReservation);
				if(this.stockInitial == -1) { // Si pas de limite de stock il faut rajouter 1 car stock init = -1
					lQteReservation++;
				}
			} else { // Si solidaire pas de réservation
				lQteReservation = 0;
			}
			
			var lProduit = {id:this.id,
							nproId:lIdNomProduit,
							nproNom:this.nom,
							nproStock:this.stockInitial,
							nproQteMax:this.qteMaxCommande,
							nproUnite:this.unite,
							type:lTypeProduit,
							qteReservation:lQteReservation.nombreFormate(2,',',' ')};	
			
			if(!lAffichageMarche[lIdFerme]) {
				lAffichageMarche[lIdFerme] = {	ferId:lIdFerme,
													ferNom:this.ferNom,
													categories:[]};
			}
			
			if(!lAffichageMarche[lIdFerme].categories[lIdCategorie]){
				lAffichageMarche[lIdFerme].categories[lIdCategorie] = {
						cproId:lIdCategorie,
						cproNom:this.cproNom,
						produits:[],
						produitsAbonnement:[]};
			}
			if(lTypeProduit == 2) { // Abonnement
				lAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdNomProduit] = lProduit;		
			} else { // Normal ou solidaire
				lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit] = lProduit;		
			}
			that.mNbProduit++;
		});
		
		
		var lFermes = [];		
		$(lAffichageMarche).each(function() {
			if(this.ferId) {
				var lCategories = [];
				$(this.categories).each(function() {
					if(this.cproId) {
						var lProduits = [];
						$(this.produits).each(function() {
							if(this.nproId) {
								lProduits.push([this.nproNom,this.nproId,this.type]);
							}						
						});		
						$(this.produitsAbonnement).each(function() {
							if(this.nproId) {
								lProduits.push([this.nproNom,this.nproId,this.type]);
							}						
						});	
						lProduits.sort(sortABC);
						lCategories.push([this.cproNom,this.cproId,lProduits]);
					}
				});		
				lCategories.sort(sortABC);
				lFermes.push([this.ferNom,this.ferId,lCategories]);		
			}
		});
		lFermes.sort(sortABC);
		
		this.mListeFerme = {fermes:[]};
		$(lFermes).each(function(i,val) {
			var lIdFerme = val[1];
			var lCategories = val[2];
			if(lAffichageMarche[lIdFerme]) {
				var lAjoutFerme = false;
				var lFerme = {	ferId:lAffichageMarche[lIdFerme].ferId,
								ferNom:lAffichageMarche[lIdFerme].ferNom,
								categories:[]};
				$(lCategories).each(function(i,val) {
					var lIdCategorie = val[1];
					var lProduits = val[2];
					if(lAffichageMarche[lIdFerme].categories[lIdCategorie]) {
						var lAjoutCategorie = false;
						var lCategorie = {
								cproId:lAffichageMarche[lIdFerme].categories[lIdCategorie].cproId,
								cproNom:lAffichageMarche[lIdFerme].categories[lIdCategorie].cproNom,
								produits:[]};
						$(lProduits).each(function(i,val) {
							var lIdProduit = val[1];
							var lType = val[2];
							var lAbonnement = "";
							
							if(lType == 2) {
								lAbonnement = lGestionCommandeTemplate.flagAbonnement;
								if(lAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit]) {									
									lCategorie.produits.push({
										id:lAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit].id,
										nproId:lAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit].nproId,
										nproNom:lAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit].nproNom,
										nproUnite:lAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit].nproUnite,
										qteReservation:lAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit].qteReservation,
										type:lType,
										abonnement:lAbonnement});
									lAjoutFerme = true;
									lAjoutCategorie = true;
								}
							} else {
								if(lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].type == 1) {
									lAbonnement = lGestionCommandeTemplate.flagSolidaire;
								}
								if(lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit]) {
																	
									lCategorie.produits.push({
										id:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].id,
										nproId:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproId,
										nproNom:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproNom,
										nproUnite:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproUnite,
										qteReservation:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].qteReservation,
										type:lType,
										abonnement:lAbonnement});
									lAjoutFerme = true;
									lAjoutCategorie = true;
								}	
							}
						});
						if(lAjoutCategorie) {
							lFerme.categories.push(lCategorie);
						}
					}
				});
				if(lAjoutFerme) {
					that.mListeFerme.fermes.push(lFerme);
				}
			}
		});
		
		lData.sigleMonetaire = gSigleMonetaire;
		
		this.mMarche = $.extend(that.mMarche,lData);
		this.mMarche.produits = [];
		this.mMarche.produitsAbonnement = [];
		$.each(pResponse.marche.produits,function() {	
			if(this.type== 2) {
				that.mMarche.produitsAbonnement[this.idNom] = 1;
			} else {
				that.mMarche.produits[this.idNom] = 1;
			}
		});
			
		var lTemplate = lGestionCommandeTemplate.editerCommandePage;
		
		lData.infoMarcheSelected = 'ui-state-active';
		lData.listeReservationSelected = '';
		lData.listeAchatSelected = '';
		pResponse.resumeMarcheSelected = '';
		
		lData.editerMenu = lGestionCommandeTemplate.editerMarcheMenu.template(lData);
		this.mArchive = pResponse.marche.archive;
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));	
	};
	
	this.affectDroitArchive = function(pData) {
		pData.find("#btn-ajout-produit-div").remove();
		pData.find("#btn-modif-com").remove();
		pData.find(".btn-modifier-produit").remove();		
		pData.find(".btn-supprimer-produit").remove();
		pData.find("#btn-pause-com").remove();
		pData.find("#btn-play-com").remove();
		pData.find("#btn-cloture-com").remove();
		return pData;
	};
	
	this.affect = function(pData) {
		pData = this.affectModifier(pData);
		pData = this.affectDupliquerMarche(pData);
		pData = this.affectBonDeCommande(pData);
		pData = this.affectFacture(pData);
		pData = this.affectArchive(pData);
		pData = this.affectMajListeFerme(pData);
		pData = this.affectDialogAjoutProduit(pData);
		pData = this.affectMenu(pData);
		pData = gCommunVue.comHoverBtn(pData);
		if(this.mArchive == 2) { // Si le marché est archivé on ne peut plus faide de modification
			pData = this.affectDroitArchive(pData);
		}
		return pData;
	};
	
	this.affectMenu = function(pData) {
		var that = this;
		pData.find('#btn-information-marche').click(function() {
			EditerCommandeVue(that.mParam);
		});		
		pData.find("#btn-liste-achat-resa").click(function() {
			ListeAchatMarcheVue({id_marche:that.mIdMarche});
		});
		pData.find("#btn-liste-resa").click(function() {
			ListeReservationMarcheVue({id_marche:that.mIdMarche});
		});
		pData.find("#btn-resume-marche").click(function() {
			ResumeMarcheVue({id_marche:that.mIdMarche});
		});
		return pData;
	};
			
	this.affectModifier = function(pData) {	
		var that = this;
		pData.find('#btn-modif-com').click(function() {
			that.dialogModifierInformationMarche();
		});
		return pData;
	};
	
	this.affectBonDeCommande = function(pData) {
		var that = this;
		pData.find('#btn-bon-com').click(function() {
			BonDeCommandeVue({"id_commande":that.mIdMarche});
		});
		return pData;
	};
	
	this.affectFacture = function(pData) {
		var that = this;
		pData.find('#btn-facture-com').click(function() {
			FactureVue({'idMarche':that.mIdMarche});
		});
		return pData;
	};
	
	this.affectDupliquerMarche = function(pData) {
		var that = this;
		pData.find('#btn-dupliquer-com').click(function() {
			//DupliquerMarcheVue({"id_marche":that.mIdMarche, fonction:"dupliquer"});
			AjoutCommandeVue({"id_marche":that.mIdMarche, fonction:"dupliquer"});
		});
		return pData;
	};
	
	this.affectArchive = function(pData) {
		if(this.mMarche.archive == 0) {
			pData.find('.marche-archive-0').show();
		} else if(this.mMarche.archive == 1) {
			pData.find('.marche-archive-1').show();
		}
		pData = this.affectPause(pData);
		pData = this.affectPlay(pData);
		pData = this.affectCloturer(pData);
		return pData;
	};
	
	this.modifierArchive = function() {
		if(this.mMarche.archive == 0) {
			$('.marche-archive-0').show();
			$('.marche-archive-1').hide();
		} else if(this.mMarche.archive == 1) {
			$('.marche-archive-0').hide();
			$('.marche-archive-1').show();
		}
	};
	
	this.affectCloturer = function(pData) {
		var that = this;
		pData.find('#btn-cloture-com')
		.click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogClotureCommande;
			
			$(lTemplate.template(that.mMarche)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Cloturer': function() {
						var lParam = {id_marche:that.mIdMarche,fonction:"cloturer"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											
											// Message de confirmation
											var lVr = new TemplateVR();
											lVr.valid = false;
											lVr.log.valid = false;
											var erreur = new VRerreur();
											erreur.code = ERR_313_CODE;
											erreur.message = ERR_313_MSG;
											lVr.log.erreurs.push(erreur);										
	
											var lparam = {"id_marche":that.mIdMarche,
													vr:lVr};
											InfoCommandeArchiveVue(lparam);
											
											
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
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
		});
		return pData;
	};
	
	this.affectPause = function(pData) {
		var that = this;
		pData.find('#btn-pause-com')
		.click(function() {
			var lParam = {id_marche:that.mIdMarche,fonction:"pause"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {							
								that.mMarche.archive = 1;
								that.modifierArchive();
								
								var lVr = new TemplateVR();
								lVr.valid = false;
								lVr.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_311_CODE;
								erreur.message = ERR_311_MSG;
								lVr.log.erreurs.push(erreur);							
	
								// Message de confirmation
								Infobulle.generer(lVr,'');
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		});
		return pData;
	};
	
	this.affectPlay = function(pData) {
		var that = this;
		pData.find('#btn-play-com')
		.click(function() {
			var lParam = {id_marche:that.mIdMarche,fonction:"play"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {							
								that.mMarche.archive = 0;
								that.modifierArchive();
	
								var lVr = new TemplateVR();
								lVr.valid = false;
								lVr.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_312_CODE;
								erreur.message = ERR_312_MSG;
								lVr.log.erreurs.push(erreur);							
	
								// Message de confirmation
								Infobulle.generer(lVr,'');
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		});
		return pData;
	};
		
	this.affectMajListeFerme = function(pData) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.editerMarcheListeProduit;
		pData.find("#liste-ferme").replaceWith(that.affectGestionProduit($(lTemplate.template(that.mListeFerme))));
		return pData;
	};
	
	this.affectGestionProduit = function(pData) {
		pData = this.affectModifierProduit(pData);
		pData = this.affectSupprimerProduit(pData);
		return pData;		
	};
	
	this.affectModifierProduit = function(pData) {
		var that = this;
		pData.find(".btn-modifier-produit").click(function() {
			that.dialogModifierProduit($(this).attr("id-produit"), $(this).attr("typeProduit"));
		});
		return pData;	
	};
	
	this.dialogModifierProduit = function(pId) {
		var that = this;
		var lParam = {fonction:"detailProduitMarche",id:pId};
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							
							var lIdFerme = lResponse.produit.ferId;
							var lIdCategorie = lResponse.produit.idCategorie;
							var lTypeProduit = parseInt(lResponse.produit.type);

							that.mQuantiteReservation = -1;
							
							var lStockAffichage = "";
							if(parseFloat(lResponse.produit.stockInitial) != -1) {
								that.mQuantiteReservation = parseFloat(lResponse.produit.stockInitial) - parseFloat(lResponse.produit.stockReservation);
								
								if(lTypeProduit == 0) { // Normal
									lStockAffichage = lResponse.produit.stockInitial.nombreFormate(2,',','');
								} else if(lTypeProduit == 2) {// Abonnement
									lStockAffichage = lResponse.produit.stockInitial.nombreFormate(2,',',' ');
								}
							} else {
								that.mQuantiteReservation = parseFloat(lResponse.produit.stockReservation) * -1;
							}
							
							var lQteMaxAffichage = "";
							if(parseFloat(lResponse.produit.qteMaxCommande) != -1) {
								if(lTypeProduit == 0) { // Normal
									lQteMaxAffichage = lResponse.produit.qteMaxCommande.nombreFormate(2,',','');
								} else if(lTypeProduit == 2) {// Abonnement
									lQteMaxAffichage = lResponse.produit.qteMaxCommande.nombreFormate(2,',',' ');
								}
							}
							
							var lData = {	ferId:lIdFerme,
											ferNom:lResponse.produit.ferNom,
											cproId:lIdCategorie,
											cproNom:lResponse.produit.cproNom,
											nproId:pId,
											nproNom:lResponse.produit.nom,
											unite:lResponse.produit.unite,
											nproStock:lStockAffichage,
											nproQteMax:lQteMaxAffichage,
											modelesLot:[],
											modelesLotReservation:[],
											modelesLotAbonnement:[],
											modelesLotAbonnementReservationModif:[],
											listeModelesLot:[],
											listeModelesLotAbonnement:[]};							
							
							that.mLotReservation = [];
							
							that.mTailleLotResaMax = -1;
							
							switch(lTypeProduit) {
								case 0:
										//lData.typeProduitLabel = "Normal";
										lData.typeProduitLabel = lGestionCommandeTemplate.typeProduitLabelNormal;
										$.each(lResponse.modelesLot, function() {
											if(this.mLotId != null) {
												that.mIdLot--;												
												var lVoLot = {	
														id:that.mIdLot,
														quantite:this.mLotQuantite.nombreFormate(2,',',' '),
														prix:this.mLotPrix.nombreFormate(2,',',' '),
														unite:this.mLotUnite,
														sigleMonetaire:gSigleMonetaire,
														modele: "modele-lot",
														checked:""};
												lData.listeModelesLot.push(lVoLot);
											}
										});
										$.each(lResponse.produit.lots, function() {
											var lVoLot = {	
													id:this.id,
													quantite:this.taille.nombreFormate(2,',',' '),
													prix:this.prix.nombreFormate(2,',',' '),
													unite:lResponse.produit.unite,
													sigleMonetaire:gSigleMonetaire,
													modele: "",
													checked:"checked=\"checked\""};
											if(this.reservation) {
												lData.modelesLotReservation.push(lVoLot);
												that.mLotReservation[this.id] = {id:this.id,quantite:this.taille};
												
												if(this.taille > that.mTailleLotResaMax) {
													that.mTailleLotResaMax = this.taille;
												}
												
											} else {
												lData.modelesLot.push(lVoLot);
											}
										});
										
										if(lResponse.produit.qteRestante == "" || lResponse.produit.stockInitial == -1) {
											lData.nproStockCheckedNoLimit = "checked=\"checked\"";
											lData.nproStockDisabled = "disabled=\"disabled\"";
										} else {
											lData.nproStockCheckedLimit = "checked=\"checked\"";
										}
										
										if(lResponse.produit.qteMaxCommande == "" || lResponse.produit.qteMaxCommande == -1) {
											lData.nproQteMaxCheckedNoLimit = "checked=\"checked\"";
											lData.nproQteMaxDisabled = "disabled=\"disabled\"";
										} else {
											lData.nproQteMaxCheckedLimit = "checked=\"checked\"";
										}
										lData.divStock = lGestionCommandeTemplate.stockModifProduit.template(lData);
										lData.divLot = lGestionCommandeTemplate.prixModifProduit.template(lData);
									break;
									
								case 1:
										//lData.typeProduitLabel = "Solidaire";
										lData.typeProduitLabel = lGestionCommandeTemplate.typeProduitLabelSolidaire;
										$.each(lResponse.modelesLot, function() {
											if(this.mLotId != null) {
												that.mIdLot--;			
												var lVoLot = {	
														id:that.mIdLot,
														quantite:this.mLotQuantite.nombreFormate(2,',',' '),
														prix:this.mLotPrix.nombreFormate(2,',',' '),
														unite:this.mLotUnite,
														sigleMonetaire:gSigleMonetaire,
														modele: "modele-lot",
														checked:""};
												lData.listeModelesLot.push(lVoLot);
											}
										});
										$.each(lResponse.produit.lots, function() {
											var lVoLot = {	
													id:this.id,
													quantite:this.taille.nombreFormate(2,',',' '),
													prix:this.prix.nombreFormate(2,',',' '),
													unite:lResponse.produit.unite,
													sigleMonetaire:gSigleMonetaire,
													modele: "",
													checked:"checked=\"checked\""};
											lData.modelesLot.push(lVoLot);
										});
										
										lData.divLot = lGestionCommandeTemplate.prixModifProduit.template(lData);
									break;
									
								case 2:
										$.each(lResponse.modelesLot, function() {
											if(this.mLotId != null && this.mLotUnite == lResponse.produit.unite) {
												that.mIdLotAbonnement--;		
												var lVoLot = {	
														id:that.mIdLotAbonnement,
														quantite:this.mLotQuantite.nombreFormate(2,',',' '),
														prix:this.mLotPrix.nombreFormate(2,',',' '),
														unite:this.mLotUnite,
														sigleMonetaire:gSigleMonetaire,
														modele: "modele-lot",
														checked:""};
												lData.listeModelesLotAbonnement.push(lVoLot);
											}
										});
										$.each(lResponse.produit.lots, function() {
											var lVoLot = {	
													id:this.id,
													quantite:this.taille.nombreFormate(2,',',' '),
													prix:this.prix.nombreFormate(2,',',' '),
													unite:lResponse.produit.unite,
													sigleMonetaire:gSigleMonetaire,
													modele: "",
													checked:"checked=\"checked\""};
											if(this.reservation) {
												lData.modelesLotAbonnementReservationModif.push(lVoLot);
												that.mLotReservation[this.id] = {id:this.id,quantite:this.taille};
											} else {
												lData.modelesLotAbonnement.push(lVoLot);
											}
										});
										
										//lData.typeProduitLabel = "Abonnement";
										lData.typeProduitLabel = lGestionCommandeTemplate.typeProduitLabelAbonnement;
										lData.stockInitialAbonnement = lStockAffichage;
										lData.uniteAbonnement = lResponse.produit.unite;

										var lQMax = lResponse.produit.qteMaxCommande;
										if(parseFloat(lQMax) == -1) {
											lData.qMaxAbonnement = "Pas de limite";
										} else {
											lData.qMaxAbonnement = lQMax.nombreFormate(2,',',' ') + " " + lData.uniteAbonnement;
										}
										lData.qMaxAbonnementValue = lQMax;
										
										lData.divStock = lGestionCommandeTemplate.stockAbonnementAjoutProduit.template(lData);
										lData.divLot = lGestionCommandeTemplate.prixAbonnementModifProduit.template(lData);
									break;
							}
							
							var lTemplate = lGestionCommandeTemplate.dialogModifProduitAjoutMarche;
							
							that.mLotRemplacement = [];
							
							//$(lTemplate.template(lData)).dialog({	
							$(that.affectModifierPrixEtStock( $(lTemplate.template(lData))) ).dialog({			
								autoOpen: true,
								modal: true,
								draggable: true,
								resizable: false,
								width:900,
								buttons: {
									'Modifier': function() {
										that.modifierProduit($(this),lTypeProduit);
									},
									'Annuler': function() {
										that.mEditionLot = false;
										$(this).dialog('close');
									}
								},
								close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
							});	
						} else {
							Infobulle.generer(lResponse,"marche-");
						}
					}
				},"json"
		);		
	};
	
	this.affectPrixEtStock = function(pData) {
		pData = this.affectAjoutLotGestion(pData);
		pData = this.affectAjoutLotAbonnementGestion(pData);
		pData = this.affectAjoutLot(pData);
		pData = this.affectLimiteStock(pData);
		pData = this.affectChangeTypeProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;		
	};
	
	this.affectModifierPrixEtStock = function(pData) {
		pData = this.affectAjoutLotGestionModifier(pData);
		pData = this.affectAjoutLotAbonnementGestionModifier(pData);
		pData = this.affectAjoutLot(pData);
		pData = this.affectLimiteStock(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;		
	};
	
	this.affectChangeTypeProduit = function(pData) {
		var that = this;
		pData.find(':input[name=typeProduit]').click(function() {
			return that.testChangeTypeProduit($(':input[name=typeProduit]:checked').val());
		}).change(function() {
			that.changeTypeProduit($(':input[name=typeProduit]:checked').val());
		});
		return pData;
	};
	
	this.testChangeTypeProduit = function(pTypeProduit) {
		if(this.mEditionLot) {
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_112_CODE;
			erreur.message = ERR_112_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
			return false;
		}
		return true;
	};
	
	this.changeTypeProduit = function(pTypeProduit) {
		if(!this.mEditionLot) {			
			$(".pro-detail").hide();
			if(pTypeProduit == 0 ) {
				$("#pro-normal,#id-stock").show();
			} else if (pTypeProduit == 1 ) {
				$("#pro-normal").show();
			} else {
				$("#pro-abonnement").show();
			}
		} else {
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_112_CODE;
			erreur.message = ERR_112_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
			return false;
		}
	};
	
	this.affectLimiteStock = function(pData) {
		pData.find(':input[name=pro-stock-choix]').change(function() {
			if($(':input[name=pro-stock-choix]:checked').val() == 1) {	
				$(":input[name=pro-stock]").prop("disabled", false).val("");
			} else {
				$(":input[name=pro-stock]").prop("disabled", true).val("");
			}
		});
		pData.find(':input[name=pro-qte-max-choix]').change(function() {
			if($(':input[name=pro-qte-max-choix]:checked').val() == 1) {				
				$(":input[name=pro-qte-max]").prop("disabled", false).val("");
			} else {
				$(":input[name=pro-qte-max]").prop("disabled", true).val("");
			}
		});
		return pData;
	};
	
	this.affectAjoutLot = function(pData) {
		var that = this;
		pData.find('#btn-ajout-lot').click(function() {that.ajoutLot(1);});
		pData.find('#table-pro-prix input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLot(1);
			}
		});		
		pData.find('#btn-ajout-lot-abonnement').click(function() {that.ajoutLot(2);});
		pData.find('#table-pro-abonnement-prix input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLot(2);
			}
		});
		return pData;		
	};
	
	this.ajoutLot = function(pType) {

		var lVo = new ModeleLotVO();
		if(pType == 1) {	
			lVo.quantite = $(":input[name=lot-quantite]").val().numberFrToDb();
			lVo.unite = $(":input[name=lot-unite]").val();
			lVo.prix = $(":input[name=lot-prix]").val().numberFrToDb();
		} else {
			lVo.quantite = $(":input[name=lot-abo-quantite]").val().numberFrToDb();
			lVo.unite = $("#pro-abo-lot-unite").text();
			lVo.prix = $(":input[name=lot-abo-prix]").val().numberFrToDb();
		}
		
		
		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lVR = new TemplateVR();
			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			if(pType == 1) {
				var lQteRestante = $("#pro-qteRestante").val();			
				if(lQteRestante != undefined && lQteRestante != "") {
					lQteRestante = lQteRestante.numberFrToDb();
					if(lQteRestante != -1 && lVo.quantite > parseFloat(lQteRestante)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
				}

				var lMax = $("#pro-qteMaxCommande").val();
				if(lMax != undefined && lMax != "") {
					lMax = lMax.numberFrToDb();
					if(lMax != -1 && lVo.quantite > parseFloat(lMax)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
				}
								
				if(lVR.valid) {		
					var lTemplate = lGestionCommandeTemplate.modeleLot;				
					this.mIdLot--;
					lVo.id = this.mIdLot;
					lVo.sigleMonetaire = gSigleMonetaire;
					lVo.quantite = lVo.quantite.nombreFormate(2,',',' ');
					lVo.prix = lVo.prix.nombreFormate(2,',',' ');	
					
					$("#lot-liste").append(this.affectLot($(lTemplate.template(lVo))));
					$(":input[name=lot-quantite], :input[name=lot-unite], :input[name=lot-prix]").val("");
				} else {		
					Infobulle.generer(lVR,'pro-lot-');
				}
			
			} else {
				var lQteRestante = $("#stock-abonnement").text().numberFrToDb();
				var lMax = $("#max-abonnement").text().numberFrToDb();
				
				if(lMax != -1 && parseFloat(lVo.quantite) > parseFloat(lMax)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
				if(lQteRestante != -1 && parseFloat(lVo.quantite) > parseFloat(lQteRestante)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
				
				if(lVR.valid) {
					var lTemplate = lGestionCommandeTemplate.modeleLotAbonnement;				
					this.mIdLotAbonnement--;
					lVo.id = this.mIdLotAbonnement;
					lVo.sigleMonetaire = gSigleMonetaire;
					lVo.quantite = lVo.quantite.nombreFormate(2,',',' ');
					lVo.prix = lVo.prix.nombreFormate(2,',',' ');		
					
					$("#lot-liste-abonnement").append(this.affectLotAbonnement($(lTemplate.template(lVo))));
					$(":input[name=lot-abo-quantite], :input[name=lot-abo-unite], :input[name=lot-abo-prix]").val("");		
				} else {
					Infobulle.generer(lVR,'pro-abo-lot-');
				}
			}
		} else {
			if(pType == 1) {		
				Infobulle.generer(lVr,'pro-lot-');
			} else {
				Infobulle.generer(lVr,'pro-abo-lot-');
			}
		}
	};

	this.affectLot = function(pData) {
		pData = this.affectAjoutLotGestion(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectLotAbonnement = function(pData) {
		pData = this.affectAjoutLotAbonnementGestion(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectAjoutLotGestion = function(pData) {
		var that = this;
		pData.find(".btn-modifier-lot").click(function() {
			that.ajoutLotModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(".btn-valider-lot").click(function() {
			that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find('.catalogue-input-lot').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLotValiderModification($(this).closest('tr').find('#id-lot').text());
			}
		});	
		pData.find(".btn-annuler-lot").click(function() {
			that.ajoutLotAnnulerModification($(this).closest('tr').find('#id-lot').text());
		});	
		pData.find(".btn-supprimer-lot").click(function() {
			that.ajoutLotSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(":checkbox").change(function() {
			var lMajUnite = that.majUnite();
			//if(!that.majUnite()) {
			if(!lMajUnite) {
				if($(this).prop("checked")) {
					$(this).prop("checked",false);
				} else {
					$(this).prop("checked",true);
				}				
			}
		});
		return pData;		
	};
	
	this.affectAjoutLotGestionModifier = function(pData) {
		var that = this;
		pData.find(".btn-modifier-lot").click(function() {
			that.ajoutLotModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(".btn-valider-lot").click(function() {
			that.ajoutLotModifierValiderModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find('.catalogue-input-lot').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLotModifierValiderModification($(this).closest('tr').find('#id-lot').text());
			}
		});	
		pData.find(".btn-annuler-lot").click(function() {
			that.ajoutLotAnnulerModification($(this).closest('tr').find('#id-lot').text());
		});	
		pData.find(".btn-supprimer-lot").click(function() {
			that.modifierLotSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(":checkbox").change(function() {
			if(!that.majUnite()) {
				if($(this).prop("checked")) {
					$(this).prop("checked",false);
				} else {
					$(this).prop("checked",true);
				}				
			}
		});
		return pData;		
	};
	
	this.affectAjoutLotAbonnementGestion = function(pData) {
		var that = this;
		pData.find(".btn-modifier-lot-abonnement").click(function() {
			that.ajoutLotAbonnementModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(".btn-valider-lot-abonnement").click(function() {
			that.ajoutLotAbonnementValiderModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find('.catalogue-input-lot-abonnement').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLotAbonnementValiderModification($(this).closest('tr').find('#id-lot').text());
			}
		});	
		pData.find(".btn-annuler-lot-abonnement").click(function() {
			that.ajoutLotAbonnementAnnulerModification($(this).closest('tr').find('#id-lot').text());
		});	
		pData.find(".btn-supprimer-lot-abonnement").click(function() {
			that.ajoutLotAbonnementSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		return pData;		
	};
	
	this.affectAjoutLotAbonnementGestionModifier = function(pData) {
		var that = this;
		pData.find(".btn-modifier-lot-abonnement").click(function() {
			that.ajoutLotAbonnementModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(".btn-valider-lot-abonnement").click(function() {
			that.ajoutLotModifierAbonnementValiderModification($(this).closest('tr').find('#id-lot').text());
		});
		pData.find('.catalogue-input-lot-abonnement').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLotModifierAbonnementValiderModification($(this).closest('tr').find('#id-lot').text());
			}
		});	
		pData.find(".btn-annuler-lot-abonnement").click(function() {
			that.ajoutLotAbonnementAnnulerModification($(this).closest('tr').find('#id-lot').text());
		});	
		pData.find(".btn-supprimer-lot-abonnement").click(function() {
			that.modifierLotAbonnementSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		return pData;		
	};
	
	this.majUnite = function() {
		var lOk = true;
		var lNbChecked = 0;
		var lUnitePrec = "";
		$(".ligne-lot :checkbox:checked").each(function() {
			var lUnite = $(this).closest(".ligne-lot").find(".lot-unite").text();
			if(lUnitePrec != "" && lUnitePrec != lUnite) {
				lOk = false;
			} else {
				lUnitePrec = lUnite;
			}
			lNbChecked++;
		});
		if(lOk) { 
			if(lNbChecked > 0) {
				$(".unite-stock").text(lUnitePrec);	
			}
		} else {
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_333_CODE;
			erreur.message = ERR_333_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
		}
		return lOk;
	};
	
	this.ajoutLotModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();

		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text().numberFrToDb().nombreFormate(2,',',''));
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text().numberFrToDb().nombreFormate(2,',',''));

		this.mEditionLot = true;
	};
	
	this.ajoutLotAbonnementModification = function(pId) {
		$(".btn-lot-abonnement, #btn-annuler-lot-" + pId + "-abonnement, #btn-valider-lot-" + pId + "-abonnement, .champ-lot-" + pId + "-abonnement").toggle();
		$("#pro-lot-abonnement" + pId + "-quantite").val($("#lot-" + pId + "-quantite-abonnement").text().numberFrToDb().nombreFormate(2,',',''));
		$("#pro-lot-abonnement" + pId + "-unite").val($("#lot-" + pId + "-unite-abonnement").text());
		$("#pro-lot-abonnement" + pId + "-prix").val($("#lot-" + pId + "-prix-abonnement").text().numberFrToDb().nombreFormate(2,',',''));

		this.mEditionLot = true;
	};
	
	this.ajoutLotValiderModification = function(pId) {
		var lVo = new ModeleLotVO();
		lVo.quantite = $("#pro-lot-" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-" + pId + "-prix").val().numberFrToDb();
	
		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();		
			var lVR = new TemplateVR();
			var lQteRestante = $("#pro-qteRestante").val();			
			if(lQteRestante != undefined &&lQteRestante != "") {
				lQteRestante = lQteRestante.numberFrToDb();
				if(lQteRestante != -1 && lVo.quantite > parseFloat(lQteRestante)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
				
			}

			var lMax = $("#pro-qteMaxCommande").val();
			if(lMax != undefined &&lMax != "") {
				lMax = lMax.numberFrToDb();
				if(lMax != -1 && lVo.quantite > parseFloat(lMax)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
			}

			if(lVR.valid) {
				$("#lot-" + pId + "-quantite").text(lVo.quantite.nombreFormate(2,',',' '));
				$("#lot-" + pId + "-unite").text(lVo.unite);
				$("#lot-" + pId + "-prix").text(lVo.prix.nombreFormate(2,',',' '));
				$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();

				this.mEditionLot = false;
				this.majUnite();
			} else {
				Infobulle.generer(lVR,'pro-lot-' + pId + '-');
			}
		} else {
			Infobulle.generer(lVr,'pro-lot-' + pId + '-');
		}
	};
	
	this.ajoutLotModifierValiderModification = function(pId) {
		var lVo = new ModeleLotVO();
		lVo.id = pId;
		lVo.quantite = $("#pro-lot-" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-" + pId + "-prix").val().numberFrToDb();
	
		var lValid = new ModeleLotValid();
		var lVr = {};
		if(this.autorisationSupprimerLot(pId)) {
			lVr = lValid.validAjout(lVo);
		} else {
			lVr = lValid.validUpdateAvecReservation(lVo,this.mLotReservation[pId].quantite);
		}
		
		if(lVr.valid) {	
			Infobulle.init();		
			var lVR = new TemplateVR();
			var lQteRestante = $("#pro-qteRestante").val();			
			if(lQteRestante != undefined &&lQteRestante != "") {
				lQteRestante = lQteRestante.numberFrToDb();
				if(lQteRestante != -1 && lVo.quantite > parseFloat(lQteRestante)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
				
			}

			var lMax = $("#pro-qteMaxCommande").val();
			if(lMax != undefined &&lMax != "") {
				lMax = lMax.numberFrToDb();
				if(lMax != -1 && lVo.quantite > parseFloat(lMax)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
			}

			if(lVR.valid) {
				$("#lot-" + pId + "-quantite").text(lVo.quantite.nombreFormate(2,',',' '));
				$("#lot-" + pId + "-unite").text(lVo.unite);
				$("#lot-" + pId + "-prix").text(lVo.prix.nombreFormate(2,',',' '));
				$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();

				this.mEditionLot = false;
				this.majUnite();
			} else {
				Infobulle.generer(lVR,'pro-lot-' + pId + '-');
			}
		} else {
			Infobulle.generer(lVr,'pro-lot-' + pId + '-');
		}
	};
	
	this.ajoutLotAbonnementValiderModification = function(pId) {
		var lVo = new ModeleLotVO();
		lVo.quantite = $("#pro-lot-abonnement" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-abonnement" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-abonnement" + pId + "-prix").val().numberFrToDb();
	
		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lVR = new TemplateVR();

			var lQteRestante = $("#stock-abonnement").text().numberFrToDb();
			var lMax = $("#max-abonnement").text().numberFrToDb();

			if(lMax != -1 && lVo.quantite > parseFloat(lMax)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
			if(lQteRestante != -1 && lVo.quantite > parseFloat(lQteRestante)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
			
			if(lVR.valid) {	
				Infobulle.init();
				$("#lot-" + pId + "-quantite-abonnement").text(lVo.quantite.nombreFormate(2,',',' '));
				$("#lot-" + pId + "-unite-abonnement").text(lVo.unite);
				$("#lot-" + pId + "-prix-abonnement").text(lVo.prix.nombreFormate(2,',',' '));
				$(".btn-lot-abonnement, #btn-annuler-lot-" + pId + "-abonnement, #btn-valider-lot-" + pId + "-abonnement, .champ-lot-" + pId + "-abonnement").toggle();
				
	
				this.mEditionLot = false;
			} else {
				Infobulle.generer(lVR,'pro-lot-abonnement' + pId + '-');
			}
		} else {
			Infobulle.generer(lVr,'pro-lot-abonnement' + pId + '-');
		}
	};
	
	this.ajoutLotModifierAbonnementValiderModification = function(pId) {
		var lVo = new ModeleLotVO();
		lVo.quantite = $("#pro-lot-abonnement" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-abonnement" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-abonnement" + pId + "-prix").val().numberFrToDb();
	
		/*var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);*/
		var lValid = new ModeleLotValid();
		var lVr = {};
		if(this.autorisationSupprimerLot(pId)) {
			lVr = lValid.validAjout(lVo);
		} else {
			lVr = lValid.validUpdateAvecReservation(lVo,this.mLotReservation[pId].quantite);
		}
		
		if(lVr.valid) {	
			Infobulle.init();
			var lVR = new TemplateVR();

			var lQteRestante = $("#stock-abonnement").text().numberFrToDb();
			var lMax = $("#max-abonnement").text().numberFrToDb();

			if(lMax != -1 && lVo.quantite > parseFloat(lMax)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
			if(lQteRestante != -1 && lVo.quantite > parseFloat(lQteRestante)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.log.erreurs.push(erreur);}
			
			if(lVR.valid) {	
				Infobulle.init();
				$("#lot-" + pId + "-quantite-abonnement").text(lVo.quantite.nombreFormate(2,',',' '));
				$("#lot-" + pId + "-unite-abonnement").text(lVo.unite);
				$("#lot-" + pId + "-prix-abonnement").text(lVo.prix.nombreFormate(2,',',' '));
				$(".btn-lot-abonnement, #btn-annuler-lot-" + pId + "-abonnement, #btn-valider-lot-" + pId + "-abonnement, .champ-lot-" + pId + "-abonnement").toggle();
				
	
				this.mEditionLot = false;
			} else {
				Infobulle.generer(lVR,'pro-lot-abonnement' + pId + '-');
			}
		} else {
			Infobulle.generer(lVr,'pro-lot-abonnement' + pId + '-');
		}
	};
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		this.mEditionLot = false;
	};
	
	this.ajoutLotAbonnementAnnulerModification = function(pId) {
		$(".btn-lot-abonnement, #btn-annuler-lot-" + pId + "-abonnement, #btn-valider-lot-" + pId + "-abonnement, .champ-lot-" + pId + "-abonnement").toggle();
		this.mEditionLot = false;
	};
	
	this.ajoutLotSupprimer = function(pId) {
		$("#ligne-lot-" + pId).remove();
	};
	
	this.autorisationSupprimerLot = function(pIdLot) {
		if(this.mLotReservation[pIdLot]) {
			return false;
		}
		return true;
	};
	
	this.modifierLotSupprimer = function(pId) {
		if(this.autorisationSupprimerLot(pId)) {
			$("#ligne-lot-" + pId).remove();	
		} else {
			this.dialogSupprimerLot(pId);
		}
	};

	this.ajoutLotAbonnementSupprimer = function(pId) {
		$("#ligne-lot-abonnement-" + pId).remove();
	};
	
	this.modifierLotAbonnementSupprimer = function(pId) {
		if(this.autorisationSupprimerLot(pId)) {
			$("#ligne-lot-abonnement-" + pId).remove();
		} else {
			this.dialogSupprimerLotAbonnement(pId);
		}
	};
	
	this.dialogSupprimerLot = function(pId) {		
		var that = this;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lData = {modelesLot:[]};

		var lUnite = $("#dialog-modif-pro").find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();		
		var lQuantite = this.mLotReservation[pId].quantite;
		
		$("#dialog-modif-pro").find('.ligne-lot').each( function () {
			var lId = $(this).find(".lot-id").text();
			var lQuantiteLot = parseFloat($(this).find(".lot-quantite").text().numberFrToDb());
			var lPrix = parseFloat($(this).find(".lot-prix").text().numberFrToDb());
			var lUniteLot = $(this).find(".lot-unite").text();
			if(lId != null && lId != pId && lUniteLot == lUnite && lQuantiteLot <= lQuantite && (lQuantite % lQuantiteLot) == 0) {
				var lVoLot = {	
						id:lId,
						quantite:lQuantiteLot.nombreFormate(2,',',' '),
						prix:lPrix.nombreFormate(2,',',' '),
						unite:lUnite,
						sigleMonetaire:gSigleMonetaire};
				lData.modelesLot.push(lVoLot);		
			}
		});
		
		$(lGestionCommandeTemplate.dialogSupprimerLotModifierMarche.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:900,
			buttons: {
				'Valider': function() {
					that.supprimerLotModifierReservation($(this),pId);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.dialogSupprimerLotAbonnement = function(pId) {
		var that = this;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lData = {modelesLot:[]};

		var lUnite = $("#dialog-modif-pro").find(".ligne-lot-abonnement :checkbox:checked").first().closest(".ligne-lot-abonnement").find(".lot-unite").text();
		var lQuantite = this.mLotReservation[pId].quantite;
		$("#dialog-modif-pro").find('.ligne-lot-abonnement').each( function () {			
			
			var lId = $(this).find(".lot-id").text();
			var lQuantiteLot = parseFloat($(this).find(".lot-quantite").text().numberFrToDb());
			var lPrix = parseFloat($(this).find(".lot-prix").text().numberFrToDb());
			var lUniteLot = $(this).find(".lot-unite").text();
			
			if(lId != null && lId != pId && lUniteLot == lUnite && lQuantiteLot <= lQuantite && (lQuantite % lQuantiteLot) == 0) {
				var lVoLot = {	
						id:lId,
						quantite:lQuantiteLot.nombreFormate(2,',',' '),
						prix:lPrix.nombreFormate(2,',',' '),
						unite:lUnite,
						sigleMonetaire:gSigleMonetaire};
				lData.modelesLot.push(lVoLot);		
			}
		});
		
		$(lGestionCommandeTemplate.dialogSupprimerLotModifierMarche.template(lData)).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:900,
			buttons: {
				'Valider': function() {
					that.supprimerLotModifierReservation($(this),pId);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.supprimerLotModifierReservation = function(pDialog,pIdLot) {
		var lIdLotRemplacement = pDialog.find(":input[name=pro-lot]:checked").val();

		Infobulle.init();
		if(lIdLotRemplacement == undefined) { // Pas de lot sélectionné
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_254_CODE;
			erreur.message = ERR_254_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
		} else {		
			this.mLotRemplacement[pIdLot] = lIdLotRemplacement; // Ajout à la table de remplacement
			$("#ligne-lot-abonnement-" + pIdLot + ", #ligne-lot-" + pIdLot + ", #btn-supprimer-lot-abonnement-" + lIdLotRemplacement + ", #btn-supprimer-lot-" + lIdLotRemplacement).remove(); // Supression du formulaire de l'ancien lot + delete du bouton de suppression du lot de remplacement
			$("#pro-lot-" + lIdLotRemplacement + "-id").prop("checked",true).prop("disabled",true); // Coche le lot dans le formulaire et le rend non sélectionnable
			pDialog.dialog('close'); // Fermeture de la fenêtre
		}
	};

	this.modifierProduit = function(pDialog,pType) {
		var that = this;
		if(!this.mEditionLot) {
			var lStock = -1;
			if(pType == 2) {
				lStock = pDialog.find('#stock-abonnement').text().numberFrToDb();
			} else if(pType == 0){
				lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();
			}
			
			if(pDialog.find(':input[name=pro-stock-choix]:checked').val() == 1 && lStock == "" && pType == 0) { // Si une limite de stock est sélectionné il faut la saisir
				var lVR = new Object();
				var erreur = new VRerreur();
				erreur.code = ERR_201_CODE;
				erreur.message = ERR_201_MSG;
				lVR.valid = false;
				lVR.qteRestante = new VRelement();
				lVR.qteRestante.valid = false;
				lVR.qteRestante.erreurs.push(erreur);
				Infobulle.generer(lVR,"pro-");
			} else {				
				var lQteMax = -1;
				if(pType == 0) {
					lQteMax = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
				} else if(pType == 2) {
					lQteMax = pDialog.find('#max-abonnement').text().numberFrToDb();
				}
				if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1 && lQteMax == "" && pType == 0) { // Si une Qmax est sélectionné il faut la saisir
					var lVR = new Object();
					var erreur = new VRerreur();
					erreur.code = ERR_201_CODE;
					erreur.message = ERR_201_MSG;
					lVR.valid = false;
					lVR.qteMaxCommande = new VRelement();
					lVR.qteMaxCommande.valid = false;
					lVR.qteMaxCommande.erreurs.push(erreur);
					Infobulle.generer(lVR,"pro-");
				} else {
					var lUnite = '';
					if(pType == 2) {
						lUnite = pDialog.find(".ligne-lot-abonnement :checkbox:checked").first().closest(".ligne-lot-abonnement").find(".lot-unite").text();
					} else {
						lUnite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
					}
					
					if(lStock == "") {
						lStock = -1;
					}
					if(lQteMax == "") {
						lQteMax = -1;
					}
					
					var lVoProduit = new ProduitMarcheVO();
					lVoProduit.id = pDialog.find("#pro-idProduit").attr("id-produit");
					lVoProduit.unite = lUnite;
					lVoProduit.qteMaxCommande = lQteMax;
					lVoProduit.qteRestante = lStock;
					lVoProduit.type = pType;
					lVoProduit.lotRemplacement = this.mLotRemplacement;			
					
					if(pType == 2) {
						pDialog.find('.ligne-lot-abonnement :checkbox:checked').each( function () {
							// Récupération des lots
							var lVoLot = new DetailCommandeVO();
							lVoLot.id = $(this).closest(".ligne-lot-abonnement").find(".lot-id").text();
							lVoLot.taille = $(this).closest(".ligne-lot-abonnement").find(".lot-quantite").text().numberFrToDb();
							lVoLot.prix = $(this).closest(".ligne-lot-abonnement").find(".lot-prix").text().numberFrToDb();
							
							lVoProduit.lots.push(lVoLot);										
						});						
					} else {
						pDialog.find('.ligne-lot :checkbox:checked').each( function () {
							// Récupération des lots
							var lVoLot = new DetailCommandeVO();
							lVoLot.id = $(this).closest(".ligne-lot").find(".lot-id").text();
							lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
							lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
							
							lVoProduit.lots.push(lVoLot);										
						});
					}

					if(pType == 1) { // Si produit Solidaire par de limite de stock
						lVoProduit.qteMaxCommande = -1;
						lVoProduit.qteRestante = -1;
					}
					
					lVoProduit.tailleLotResaMax = this.mTailleLotResaMax;
					lVoProduit.quantiteReservation = this.mQuantiteReservation;
					
					var lValid = new ProduitMarcheValid();
					var lVr = lValid.validUpdate(lVoProduit);
					
					if(lVr.valid) {	
						Infobulle.init();
						lVoProduit.fonction = "modifierProduitMarche";
						$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lVoProduit),
								function (lResponse) {		
									if(lResponse) {
										if(lResponse.valid) {
											
											// Message de confirmation
											var lVR = new Object();
											var erreur = new VRerreur();
											erreur.code = ERR_330_CODE;
											erreur.message = ERR_330_MSG;
											lVR.valid = false;
											lVR.log = new VRelement();
											lVR.log.valid = false;
											lVR.log.erreurs.push(erreur);								
											Infobulle.generer(lVR,"");

											pDialog.dialog('close');
											
		
											that.construct({id_marche:that.mIdMarche,vr:lVR});
											
										} else {
											Infobulle.generer(lResponse,"pro-");
										}
									}
								},"json"
						);
					} else {
						Infobulle.generer(lVr,'pro-');
					}
				}	
			}
		} else {
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_112_CODE;
			erreur.message = ERR_112_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
		}
	};
	
	this.affectSupprimerProduit = function(pData) {
		var that = this;
		pData.find(".btn-supprimer-produit").click(function() {
			var lId = $(this).attr("id-produit");
			if($(this).attr("qte-reservation") > 0) {
				that.dialogConfirmationSupprimerProduit(lId);
			} else {
				that.supprimerProduit(lId);
			}			
		});
		return pData;	
	};
	
	this.dialogConfirmationSupprimerProduit = function(pId) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		$(lGestionCommandeTemplate.dialogSupprimerProduit).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Supprimer': function() {
					that.supprimerProduit(pId);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
		});	
	};
	
	this.supprimerProduit = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimerProduitMarche",id:pId};
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							that.mNbProduit--;
							
							// Message de confirmation
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_331_CODE;
							erreur.message = ERR_331_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);								
							Infobulle.generer(lVR,"");
							
							
							$("#dialog-supprimer-produit").dialog('close');
							

							that.construct({id_marche:that.mIdMarche,vr:lVR});	
							
						} else {
							Infobulle.generer(lResponse,"marche-");
						}
					}
				},"json"
		);
	};
	
	this.dialogModifierInformationMarche = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();		
		var lHtml = $(lGestionCommandeTemplate.dialogModifierInfoMarche.template(that.mMarche));		

		lHtml.find(":input[name=heure-debut]").selectOptions(that.mMarche.heureMarcheDebut);
		lHtml.find(":input[name=minute-debut]").selectOptions(that.mMarche.minuteMarcheDebut);
		lHtml.find(":input[name=heure-fin]").selectOptions(that.mMarche.heureMarcheFin);
		lHtml.find(":input[name=minute-fin]").selectOptions(that.mMarche.minuteMarcheFin);
		lHtml.find(":input[name=heure-debut-reservation]").selectOptions(that.mMarche.heureDebutReservation);
		lHtml.find(":input[name=minute-debut-reservation]").selectOptions(that.mMarche.minuteDebutReservation);
		lHtml.find(":input[name=heure-fin-reservation]").selectOptions(that.mMarche.heureFinReservation);
		lHtml.find(":input[name=minute-fin-reservation]").selectOptions(that.mMarche.minuteFinReservation);
		
		lHtml = gCommunVue.lienDatepickerMarche('marche-dateDebutReservation','marche-dateFinReservation','marche-dateMarcheDebut',lHtml);
		lHtml.find('#marche-dateDebutReservation').datepicker("option", "maxDate", that.mMarche.dateFinReservation);
		lHtml.find('#marche-dateFinReservation').datepicker("option", "minDate", that.mMarche.dateDebutReservation).datepicker("option", "maxDate", that.mMarche.dateMarcheDebut);
		lHtml.find('#marche-dateMarcheDebut').datepicker("option", "minDate", that.mMarche.dateFinReservation);
		
		$(lHtml).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:800,
			buttons: {
				'Modifier': function() {
					that.modifierInformationMarche($(this));
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
		});	
	};
	
	this.modifierInformationMarche = function(pDialog) {
		var that = this;
		var lVo = new MarcheVO();

		lVo.id = this.mMarche.comId;
		lVo.nom = pDialog.find(':input[name=nom]').val();
		lVo.description = pDialog.find(':input[name=description]').val();
		lVo.dateMarcheDebut = pDialog.find(':input[name=date-debut]').val().dateFrToDb();
		lVo.timeMarcheDebut = pDialog.find(':input[name=heure-debut]').val() + ':' + pDialog.find(':input[name=minute-debut]').val() + ':00';
		lVo.dateMarcheFin = pDialog.find(':input[name=date-debut]').val().dateFrToDb();
		lVo.timeMarcheFin = pDialog.find(':input[name=heure-fin]').val() + ':' + pDialog.find(':input[name=minute-fin]').val() + ':00';
		lVo.dateDebutReservation = pDialog.find(':input[name=date-debut-reservation]').val().dateFrToDb();
		lVo.timeDebutReservation = pDialog.find(':input[name=heure-debut-reservation]').val() + ':' + pDialog.find(':input[name=minute-debut-reservation]').val() + ':00';
		lVo.dateFinReservation = pDialog.find(':input[name=date-fin-reservation]').val().dateFrToDb();
		lVo.timeFinReservation = pDialog.find(':input[name=heure-fin-reservation]').val() + ':' + pDialog.find(':input[name=minute-fin-reservation]').val() + ':00';
				
		var lValid = new MarcheValid();
		var lVR = lValid.validUpdateInformation(lVo);
		
		if(lVR.valid) {
			lVo.fonction = "modifierInformationMarche";
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lVo),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								// Maj des infos								
								that.mMarche.nom = lVo.nom;
								that.mMarche.comDescription = lVo.description;
								var lDateTime = lVo.dateDebutReservation + " " + lVo.timeDebutReservation;
								that.mMarche.dateDebutReservation = lDateTime.extractDbDate().dateDbToFr();
								that.mMarche.heureDebutReservation = lDateTime.extractDbHeure();
								that.mMarche.minuteDebutReservation = lDateTime.extractDbMinute();
								lDateTime = lVo.dateFinReservation + " " + lVo.timeFinReservation;
								that.mMarche.dateFinReservation = lDateTime.extractDbDate().dateDbToFr();
								that.mMarche.heureFinReservation = lDateTime.extractDbHeure();
								that.mMarche.minuteFinReservation = lDateTime.extractDbMinute();
								lDateTime = lVo.dateMarcheDebut + " " + lVo.timeMarcheDebut;
								that.mMarche.dateMarcheDebut = lDateTime.extractDbDate().dateDbToFr();
								that.mMarche.heureMarcheDebut = lDateTime.extractDbHeure();
								that.mMarche.minuteMarcheDebut = lDateTime.extractDbMinute();
								lDateTime = lVo.dateMarcheDebut + " " + lVo.timeMarcheFin;								
								that.mMarche.heureMarcheFin = lDateTime.extractDbHeure();
								that.mMarche.minuteMarcheFin = lDateTime.extractDbMinute();
								
								// Maj de l'affichage
								$("#edt-marche-dateDebutReservation").text(that.mMarche.dateDebutReservation);
								$("#edt-marche-heureDebutReservation").text(that.mMarche.heureDebutReservation);
								$("#edt-marche-minuteDebutReservation").text(that.mMarche.minuteDebutReservation);
								
								$("#edt-marche-dateFinReservation").text(that.mMarche.dateFinReservation);
								$("#edt-marche-heureFinReservation").text(that.mMarche.heureFinReservation);
								$("#edt-marche-minuteFinReservation").text(that.mMarche.minuteFinReservation);

								$("#edt-marche-dateMarcheDebut").text(that.mMarche.dateMarcheDebut);
								$("#edt-marche-heureMarcheDebut").text(that.mMarche.heureMarcheDebut);
								$("#edt-marche-minuteMarcheDebut").text(that.mMarche.minuteMarcheDebut);
								$("#edt-marche-heureMarcheFin").text(that.mMarche.heureMarcheFin);
								$("#edt-marche-minuteMarcheFin").text(that.mMarche.minuteMarcheFin);


								pDialog.dialog('close');
								
								// Message de confirmation
								var lVR = new Object();
								var erreur = new VRerreur();
								erreur.code = ERR_335_CODE;
								erreur.message = ERR_335_MSG;
								lVR.valid = false;
								lVR.log = new VRelement();
								lVR.log.valid = false;
								lVR.log.erreurs.push(erreur);								
								Infobulle.generer(lVR,"");
								
								
								
							} else {
								Infobulle.generer(lResponse,"marche-");
							}
						}
					},"json"
			);
		} else {
			// Affiche les erreurs
			Infobulle.generer(lVR,"marche-");						
		}
	};
	
	this.affectDialogAjoutProduit = function(pData) {
		var that = this;
		pData.find("#btn-ajout-produit").click(function() {
			var lParam = {fonction:"listeFerme"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
		
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.dialogAjoutProduitAjoutMarche;
							
							$(that.affectAjoutProduitSelectFerme($(lTemplate.template(lResponse)))).dialog({			
								autoOpen: true,
								modal: true,
								draggable: true,
								resizable: false,
								width:900,
								position: "top",
								buttons: {
									'Ajouter': function() {
										that.ajouterProduit($(this));
									},
									'Annuler': function() {
										that.mEditionLot = false;
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
	
	this.affectAjoutProduitSelectFerme = function(pData) {
		var that = this;
		pData.find("#pro-idFerme select").change(function() {
			var lId = $(this).val();
			$("#pro-idCategorie select, #pro-idProduit select").prop("disabled",true).selectOptions("0");
			$("#prix-stock-produit").replaceWith("<div id=\"prix-stock-produit\"></div>");	
			if(lId > 0) {
				var lParam = {fonction:"listeProduit",id:lId};
				$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								
								if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].nproId != null) {
								
									that.mProduits = [];
									var lIdCategorie = 0;
									var lListeCategorie = [];
									$.each(lResponse.listeProduit,function() {
										if(that.mProduits[this.cproId]) {
											that.mProduits[this.cproId].listeProduit.push(this);
										} else {
											that.mProduits[this.cproId] = {nom:this.cproNom,listeProduit:[this]};
										}
										if(lIdCategorie != this.cproId) {
											lListeCategorie.push({cproId:this.cproId,cproNom:this.cproNom});
											lIdCategorie = this.cproId;
										}
									});
									
	
									var lGestionCommandeTemplate = new GestionCommandeTemplate();
									var lTemplate = lGestionCommandeTemplate.ajoutProduitSelectCategorie;
									
									$("#pro-idCategorie").replaceWith(that.affectAjoutProduitSelectCategorie($(lTemplate.template({listeCategorie:lListeCategorie}))));
									
								} else {
									// Message d'information
									var lVr = new TemplateVR();
									lVr.valid = false;
									lVr.log.valid = false;
									var erreur = new VRerreur();
									erreur.code = ERR_332_CODE;
									erreur.message = ERR_332_MSG;
									lVr.log.erreurs.push(erreur);
									Infobulle.generer(lVr,'');
								}
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
	
	this.affectAjoutProduitSelectCategorie = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			$("#pro-idProduit select").prop("disabled",true).selectOptions("0");
			$("#prix-stock-produit").replaceWith("<div id=\"prix-stock-produit\"></div>");
			
			var lId = $(this).val();
			if(lId > 0) {
				
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.ajoutProduitSelectProduit;
				
				$("#pro-idProduit").replaceWith(that.affectAjoutProduitSelectProduit($(lTemplate.template(that.mProduits[lId]))));
				
			} 
				
		});
		return pData;
	};
	
	this.affectAjoutProduitSelectProduit = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			var lId = $(this).val();
			if(lId > 0) {
				if(!that.mMarche.produits[lId] || !that.mMarche.produitsAbonnement[lId]) {
					var lParam = {fonction:"listeModeleLot",idNomProduit:lId};
					$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
						function (lResponse) {		
							if(lResponse) {
								if(lResponse.valid) {
									Infobulle.init(); // Supprime les erreurs

									if((!that.mMarche.produitsAbonnement[lId] && lResponse.detailAbonnement.idNomProduit == lId) || !that.mMarche.produits[lId]) {

										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lData = {sigleMonetaire:gSigleMonetaire};
										if($(lResponse.modelesLot).length > 0) {
											lData.modelesLot = [];
											$.each(lResponse.modelesLot,function() {
												if(this.mLotId != null) {
													this.id = this.mLotId;
													this.quantite = this.mLotQuantite.nombreFormate(2,',',' ');
													this.unite = this.mLotUnite;
													this.prix = this.mLotPrix.nombreFormate(2,',',' ');
													this.sigleMonetaire = gSigleMonetaire;
													lData.modelesLot.push(this);
													lData.unite = this.mLotUnite;
												}
											});	
										}
										
										if(lResponse.detailAbonnement.idNomProduit == lId) { // Si le produit existe en abonnement
											lData.modelesLotAbonnement = [];
											lData.modelesLotAbonnementReservation = [];
											lData.uniteAbonnement = lResponse.detailAbonnement.unite;
											$.each(lResponse.detailAbonnement.lots, function() {
												
												//this.id = this.id;
												this.quantite = this.taille.nombreFormate(2,',',' ');
												this.unite = lData.uniteAbonnement;
												this.prix = this.prix.nombreFormate(2,',',' ');
												this.sigleMonetaire = gSigleMonetaire;
												
												if(this.reservation) {		
													lData.modelesLotAbonnementReservation.push(this);
												} else {											
													lData.modelesLotAbonnement.push(this);
												}
												
											});
										}
										
	
										if(that.mMarche.produits[lId]) { // Le produit existe en normal ou solidaire
											lData.typeNormalSelected = "disabled=\"disabled\"";
											lData.typeSolidaireSelected = "disabled=\"disabled\"";
											lData.typeAbonnementSelected = "checked=\"checked\"";
											
											lData.visibleSolidaire = "ui-helper-hidden";
											lData.visibleNormal = "ui-helper-hidden";
											lData.visibleAbonnement = "";
											
										} else if(that.mMarche.produitsAbonnement[lId]) { // Le produit existe déjà en abonnement
											lData.typeNormalSelected = "checked=\"checked\"";
											lData.typeAbonnementSelected = "disabled=\"disabled\"";		
											
											lData.visibleSolidaire = "";
											lData.visibleNormal = "";
											lData.visibleAbonnement = "ui-helper-hidden";									
										} else { // Le produit n'est pas encore dans le marche
											lData.typeNormalSelected = "checked=\"checked\"";
											
											lData.visibleSolidaire = "";
											lData.visibleNormal = "";
											lData.visibleAbonnement = "ui-helper-hidden";		
										}
										
										if(lResponse.detailAbonnement.idNomProduit == lId) { // Si le produit existe en abonnement
											lData.stockInitialAbonnement = lResponse.detailAbonnement.stockInitial.nombreFormate(2,',',' ');
											
											if(parseFloat(lResponse.detailAbonnement.max) == -1) {
												lData.qMaxAbonnement = "Pas de limite";
											} else {
												lData.qMaxAbonnement = lResponse.detailAbonnement.max.nombreFormate(2,',',' ') + " " + lData.uniteAbonnement;
											}
											lData.qMaxAbonnementValue = lResponse.detailAbonnement.max;
											
											lData.typeProduitAbonnement = lGestionCommandeTemplate.typeProduitAbonnementAjoutProduit.template(lData);
											lData.divLotAbonnement = lGestionCommandeTemplate.prixAbonnementAjoutProduit.template(lData);
											lData.divStockAbonnement = lGestionCommandeTemplate.stockAbonnementAjoutProduit.template(lData);
										}
										
										
										lData.divTypeProduit = lGestionCommandeTemplate.typeProduitAjoutProduit.template(lData);
										lData.divLot = lGestionCommandeTemplate.prixAjoutProduit.template(lData);
										lData.divStock = lGestionCommandeTemplate.stockAjoutProduit.template(lData);
										
										var lTemplate = lGestionCommandeTemplate.prixEtStockAjoutProduit;
										
										$("#prix-stock-produit").replaceWith(that.affectPrixEtStock($(lTemplate.template(lData))));
									} else {
										var lVR = new Object();
										var erreur = new VRerreur();
										erreur.code = ERR_211_CODE;
										erreur.message = ERR_211_MSG;
										lVR.valid = false;
										lVR.log = new VRelement();
										lVR.log.valid = false;
										lVR.log.erreurs.push(erreur);
										Infobulle.generer(lVR,"");
									}
									
								} else {
									Infobulle.generer(lResponse,'');
								}
							}
						},"json"
					);
				} else {
					var lVR = new Object();
					var erreur = new VRerreur();
					erreur.code = ERR_211_CODE;
					erreur.message = ERR_211_MSG;
					lVR.valid = false;
					lVR.log = new VRelement();
					lVR.log.valid = false;
					lVR.log.erreurs.push(erreur);
					Infobulle.generer(lVR,"");
				}
			} else {
				$("#prix-stock-produit").replaceWith($("<div id=\"prix-stock-produit\">"));
			}			
		});
		return pData;
	};
	
	this.ajouterProduit = function(pDialog) {
		var that = this;
		if(!this.mEditionLot) {
			// Préparation du AffichageMarche
			var lIdNomProduit = pDialog.find(':input[name=produit]').val();
			var lTypeProduit = pDialog.find(':input[name=typeProduit]:checked').val();
			
			if(lIdNomProduit != 0) {
				var lStock = -1;
				if(lTypeProduit == 2) {
					lStock = pDialog.find('#stock-abonnement').text().numberFrToDb();
				} else if(lTypeProduit == 0){
					lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();
				}

				if(pDialog.find(':input[name=pro-stock-choix]:checked').val() == 1 && lStock == "" && lTypeProduit == 0) { // Si une limite de stock est sélectionné il faut la saisir
					var lVR = new Object();
					var erreur = new VRerreur();
					erreur.code = ERR_201_CODE;
					erreur.message = ERR_201_MSG;
					lVR.valid = false;
					lVR.qteRestante = new VRelement();
					lVR.qteRestante.valid = false;
					lVR.qteRestante.erreurs.push(erreur);
					Infobulle.generer(lVR,"pro-");
				} else {			
					var lQteMax = -1;
					if(lTypeProduit == 2) {
						lQteMax = pDialog.find('#max-abonnement').text().numberFrToDb();
					} else if(lTypeProduit == 0){
						lQteMax = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
					}
					if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1 && lQteMax == "" && lTypeProduit == 0) { // Si une Qmax est sélectionné il faut la saisir
						var lVR = new Object();
						var erreur = new VRerreur();
						erreur.code = ERR_201_CODE;
						erreur.message = ERR_201_MSG;
						lVR.valid = false;
						lVR.qteMaxCommande = new VRelement();
						lVR.qteMaxCommande.valid = false;
						lVR.qteMaxCommande.erreurs.push(erreur);
						Infobulle.generer(lVR,"pro-");
					} else {	
						var lUnite = '';
						if(lTypeProduit == 2) {
							lUnite = pDialog.find(".ligne-lot-abonnement :checkbox:checked").first().closest(".ligne-lot-abonnement").find(".lot-unite").text();
						} else {
							lUnite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
						}
						if(lTypeProduit == 2 && this.mMarche.produitsAbonnement[lIdNomProduit]) { // Produit déjà présent en abonnement
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_253_CODE;
							erreur.message = ERR_253_MSG;
							lVR.valid = false;
							lVR.qteMaxCommande = new VRelement();
							lVR.qteMaxCommande.valid = false;
							lVR.qteMaxCommande.erreurs.push(erreur);
							Infobulle.generer(lVR,"pro-");
						} else if ( lTypeProduit < 2 && this.mMarche.produits[lIdNomProduit]) { // Produit déjà présent en normal ou solidaire
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_211_CODE;
							erreur.message = ERR_211_MSG;
							lVR.valid = false;
							lVR.qteMaxCommande = new VRelement();
							lVR.qteMaxCommande.valid = false;
							lVR.qteMaxCommande.erreurs.push(erreur);
							Infobulle.generer(lVR,"pro-");
						} else {
							if(lStock == "") {
								lStock = -1;
							}
							if(lQteMax == "") {
								lQteMax = -1;
							}

							// Préparation du MarcheVO		
							var lVoProduit = new ProduitMarcheVO();
							lVoProduit.id = that.mIdMarche;
							lVoProduit.idNom = lIdNomProduit;
							lVoProduit.unite = lUnite;
							lVoProduit.qteMaxCommande = lQteMax;
							lVoProduit.qteRestante = lStock;
							lVoProduit.type = lTypeProduit;
							
							if(lTypeProduit == 2) {
								pDialog.find('.ligne-lot-abonnement :checkbox').each( function () {
									// Récupération des lots
									var lVoLot = new DetailCommandeVO();
									var lId = $(this).closest(".ligne-lot-abonnement").find(".lot-id").text();
									if(lId > 0) {
										lVoLot.id = lId;
									}
									lVoLot.taille = $(this).closest(".ligne-lot-abonnement").find(".lot-quantite").text().numberFrToDb();
									lVoLot.prix = $(this).closest(".ligne-lot-abonnement").find(".lot-prix").text().numberFrToDb();
									
									lVoProduit.lots.push(lVoLot);
								});	
							} else {
								pDialog.find('.ligne-lot :checkbox').each( function () {
									// Récupération des lots
									var lVoLot = new DetailCommandeVO();
									lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
									lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
									
									lVoProduit.lots.push(lVoLot);	
								});	
							}
								
							var lValid = new CommandeCompleteValid();
							var lVr = lValid.validAjoutProduit(lVoProduit);
							
							if(lVr.valid) {	
								Infobulle.init();
								lVoProduit.fonction = "ajouterProduitMarche";
								$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lVoProduit),
										function (lResponse) {		
											if(lResponse) {
												if(lResponse.valid) {
													
													// Message de confirmation
													var lVR = new Object();
													var erreur = new VRerreur();
													erreur.code = ERR_329_CODE;
													erreur.message = ERR_329_MSG;
													lVR.valid = false;
													lVR.log = new VRelement();
													lVR.log.valid = false;
													lVR.log.erreurs.push(erreur);								
													Infobulle.generer(lVR,"");
													
			
													
													pDialog.dialog('close');
													
			
													that.construct({id_marche:that.mIdMarche,vr:lVR});
													
												} else {
													Infobulle.generer(lResponse,"pro-");
												}
											}
										},"json"
								);
							} else {
								Infobulle.generer(lVr,'pro-');
							}		
						}
					}
				}
			}
		} else {
			var lVR = new Object();
			var erreur = new VRerreur();
			erreur.code = ERR_112_CODE;
			erreur.message = ERR_112_MSG;
			lVR.valid = false;
			lVR.log = new VRelement();
			lVR.log.valid = false;
			lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,"");
		}
	};

	this.construct(pParam);
}