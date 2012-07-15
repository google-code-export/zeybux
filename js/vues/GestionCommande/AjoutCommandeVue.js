;function AjoutCommandeVue(pParam) {
	
	this.mListeFerme = {};
	this.mProduits = [];
	this.mMarche = new MarcheVO();
	this.mAffichageMarche = [];
	this.mNbProduit = 0;
	this.mEditionLot = false;
	this.mIdLot = 0;
	this.mIdLotAbonnement = 0;
	this.mEtapeCreationMarche = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {AjoutCommandeVue(pParam);}} );
		var lParam = $.extend(lParam, pParam);		
		if(pParam && pParam.fonction && pParam.fonction == "dupliquer") {
			lParam.fonction = "dupliquer";
		} else {
			lParam.fonction = "afficher";
		}
		
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {	
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								delete that.mProduits;
								that.mProduits = [];
								if(lParam.fonction == "dupliquer") {
									that.afficherDupliquer(lResponse);
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
	
	this.afficher = function(pResponse) {
		var that = this;
		
		this.mListeFerme = pResponse.listeFerme;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.formulaireAjoutMarche;
		$('#contenu').replaceWith( that.affect($(lTemplate.template(pResponse))));
	};
	
	this.affect = function(pData) {
		pData = this.affectDialogAjoutProduit(pData);
		pData = this.affectControleDatepicker(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.afficherDupliquer = function(pResponse) {
		var that = this;
		$.each(pResponse.marche.produits, function() {
			if(this.id) {
				var lIdFerme = this.ferId;
				var lIdCategorie = this.idCategorie;
				var lIdNomProduit = this.idNom;
				var lTypeProduit = this.type;
				
				var lStock = -1;
				var lStockAffichage = "";
				if(parseFloat(this.stockInitial) != -1) {
					lStock = this.stockInitial;
					lStockAffichage = this.stockInitial.nombreFormate(2,',',' ');
				}
				var lQteMax = -1;
				var lQteMaxAffichage = "";
				if(parseFloat(this.qteMaxCommande) != -1) {
					lQteMax = this.qteMaxCommande;
					lQteMaxAffichage = this.qteMaxCommande.nombreFormate(2,',',' ');
				}
				var lUnite = this.unite;
								
				var lProduit = {nproId:lIdNomProduit,
						nproNom:this.nom,
						nproStock:lStockAffichage,
						nproQteMax:lQteMax,
						nproUnite:lUnite,
						type:lTypeProduit,
						modelesLot:[],
						modelesLotReservation:[]};
				
				// Préparation du MarcheVO		
				var lVoProduit = new ProduitMarcheVO();
				lVoProduit.idNom = lIdNomProduit;
				lVoProduit.unite = lUnite;
				lVoProduit.qteMaxCommande = lQteMax;
				lVoProduit.qteRestante = lStock;
				lVoProduit.type = lTypeProduit;
				
				$.each(this.lots,function() {
					// Récupération des lots
					var lIdLot = this.id;
					var lVoLot = {	id:lIdLot,
									taille:this.taille.nombreFormate(2,',',' '),
									prix:this.prix.nombreFormate(2,',',' '),
									unite:lUnite,
									selected:true,
									modele:true};
					
					//lProduit.modelesLot[lIdLot] = lVoLot;
					
					if(this.reservation) {
						lProduit.modelesLotReservation[lIdLot] = lVoLot;
					} else {
						lProduit.modelesLot[lIdLot] = lVoLot;
					}
					
					
					// Récupération des lots
					var lVoLot = new DetailCommandeVO();
					lVoLot.id = lIdLot;
					lVoLot.taille = this.taille;
					lVoLot.prix = this.prix;
					
					lVoProduit.lots.push(lVoLot);	
				});
				
				if(!that.mAffichageMarche[lIdFerme]) {
					that.mAffichageMarche[lIdFerme] = {	ferId:lIdFerme,
														ferNom:this.ferNom,
														categories:[]};
				}
				
				if(!that.mAffichageMarche[lIdFerme].categories[lIdCategorie]){
					that.mAffichageMarche[lIdFerme].categories[lIdCategorie] = {
							cproId:lIdCategorie,
							cproNom:this.cproNom,
							produits:[],
							produitsAbonnement:[]};
				}
	
				lVoProduit.idFerme = lIdFerme;
				lVoProduit.idCategorie = lIdCategorie;
				
				if(lTypeProduit == 2) {					
					that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdNomProduit] = lProduit;
					that.mMarche.produitsAbonnement[lIdNomProduit] = lVoProduit;
				} else {
					that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit] = lProduit;
					that.mMarche.produits[lIdNomProduit] = lVoProduit;					
				}
			
				that.mNbProduit++;
			}
		});
	
		this.mListeFerme = pResponse.listeFerme;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.formulaireAjoutMarche;
		$('#contenu').replaceWith( that.affectDupliquer($(lTemplate.template(pResponse))));
	};
	
	this.affectDupliquer = function(pData) {
		pData = this.affectDialogAjoutProduit(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.majListeFerme(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectDialogAjoutProduit = function(pData) {
		var that = this;
		pData.find("#btn-ajout-produit").click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogAjoutProduitAjoutMarche;
			
			var lData = {
				listeFerme:that.mListeFerme
			};

			$(that.affectAjoutProduitSelectFerme($(lTemplate.template(lData)))).dialog({			
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
			
		});
		return pData;
	};
	
	this.affectAjoutProduitSelectFerme = function(pData) {
		var that = this;
		pData.find("#pro-idFerme select").change(function() {
			var lId = $(this).val();
			$("#pro-idCategorie select, #pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#prix-stock-produit").replaceWith("<div id=\"prix-stock-produit\"></div>");
			if(lId > 0) {
				var lParam = {fonction:"listeProduit",id:lId};
				$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								
								if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].nproId != null) {
								
									that.mProduits = [];
									//that.mListeProduit = [];
								
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
			var lId = $(this).val();
			$("#pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#prix-stock-produit").replaceWith("<div id=\"prix-stock-produit\"></div>");
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
					$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
						function (lResponse) {		
							if(lResponse) {
								if(lResponse.valid) {
									Infobulle.init(); // Supprime les erreurs
									if((!that.mMarche.produitsAbonnement[lId] && lResponse.detailAbonnement.idNomProduit == lId) || !that.mMarche.produits[lId]) {
										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lData = {sigleMonetaire:gSigleMonetaire};
										
										if(lResponse.modelesLot.length > 0 && lResponse.modelesLot[0].mLotId != null) {
											lData.modelesLot = [];
											$(lResponse.modelesLot).each(function() {
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
											$(lResponse.detailAbonnement.lots).each(function() {
												
												this.id = this.id;
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
	
	this.affectChangeTypeProduit = function(pData) {
		var that = this;
		pData.find(':input[name=typeProduit]').click(function() {
			return that.testChangeTypeProduit();
		}).change(function() {
			that.changeTypeProduit($(':input[name=typeProduit]:checked').val());
		});
		return pData;
	};
	
	this.testChangeTypeProduit = function() {
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
				$(":input[name=pro-stock]").attr("disabled","").val("");
			} else {
				$(":input[name=pro-stock]").attr("disabled","disabled").val("");
			}
		});
		pData.find(':input[name=pro-qte-max-choix]').change(function() {
			if($(':input[name=pro-qte-max-choix]:checked').val() == 1) {				
				$(":input[name=pro-qte-max]").attr("disabled","").val("");
			} else {
				$(":input[name=pro-qte-max]").attr("disabled","disabled").val("");
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
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			if(pType == 1) {			
				var lTemplate = lGestionCommandeTemplate.modeleLot;				
				this.mIdLot--;
				lVo.id = this.mIdLot;
				lVo.sigleMonetaire = gSigleMonetaire;
				lVo.quantite = lVo.quantite.nombreFormate(2,',',' ');
				lVo.prix = lVo.prix.nombreFormate(2,',',' ');		
				$("#lot-liste").append(this.affectLot($(lTemplate.template(lVo))));
				
				$(":input[name=lot-quantite], :input[name=lot-unite], :input[name=lot-prix]").val("");
			
			} else {
				var lTemplate = lGestionCommandeTemplate.modeleLotAbonnement;				
				this.mIdLotAbonnement--;
				lVo.id = this.mIdLotAbonnement;
				lVo.sigleMonetaire = gSigleMonetaire;
				lVo.quantite = lVo.quantite.nombreFormate(2,',',' ');
				lVo.prix = lVo.prix.nombreFormate(2,',',' ');		
				$("#lot-liste-abonnement").append(this.affectLotAbonnement($(lTemplate.template(lVo))));
				
				$(":input[name=lot-abo-quantite], :input[name=lot-abo-unite], :input[name=lot-abo-prix]").val("");				
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
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectAjoutLotAbonnementGestion(pData);
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
			if(!that.majUnite()) {
				if($(this).attr("checked")) {
					$(this).removeAttr("checked");
				} else {
					$(this).attr("checked","checked");
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
		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text());
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text());
		
		this.mEditionLot = true;
	};
	
	this.ajoutLotAbonnementModification = function(pId) {
		$(".btn-lot-abonnement, #btn-annuler-lot-" + pId + "-abonnement, #btn-valider-lot-" + pId + "-abonnement, .champ-lot-" + pId + "-abonnement").toggle();
		$("#pro-lot-abonnement" + pId + "-quantite").val($("#lot-" + pId + "-quantite-abonnement").text());
		$("#pro-lot-abonnement" + pId + "-unite").val($("#lot-" + pId + "-unite-abonnement").text());
		$("#pro-lot-abonnement" + pId + "-prix").val($("#lot-" + pId + "-prix-abonnement").text());

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
		
			$("#lot-" + pId + "-quantite").text(lVo.quantite.nombreFormate(2,',',' '));
			$("#lot-" + pId + "-unite").text(lVo.unite);
			$("#lot-" + pId + "-prix").text(lVo.prix.nombreFormate(2,',',' '));
			$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
			

			this.mEditionLot = false;
			this.majUnite();
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
		
			$("#lot-" + pId + "-quantite-abonnement").text(lVo.quantite.nombreFormate(2,',',' '));
			$("#lot-" + pId + "-unite-abonnement").text(lVo.unite);
			$("#lot-" + pId + "-prix-abonnement").text(lVo.prix.nombreFormate(2,',',' '));
			$(".btn-lot-abonnement, #btn-annuler-lot-" + pId + "-abonnement, #btn-valider-lot-" + pId + "-abonnement, .champ-lot-" + pId + "-abonnement").toggle();
			

			this.mEditionLot = false;
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
	
	this.ajoutLotAbonnementSupprimer = function(pId) {
		$("#ligne-lot-abonnement-" + pId).remove();
	};
	
	this.ajouterProduit = function(pDialog) {
		var that = this;
		if(!this.mEditionLot) {
			// Préparation du AffichageMarche
			var lIdFerme = pDialog.find(':input[name=ferme]').val();
			var lIdCategorie = pDialog.find(':input[name=categorie]').val();
			var lIdNomProduit = pDialog.find(':input[name=produit]').val();
			var lTypeProduit = pDialog.find(':input[name=typeProduit]:checked').val();

			if(lIdNomProduit != 0) {
				if(lTypeProduit == 2) {
					var lStock = pDialog.find('#stock-abonnement').text().numberFrToDb();
				} else {
					var lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();
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
					var lQteMax = 0;
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
						
						if(lTypeProduit == 2) {
							var lUnite = pDialog.find(".ligne-lot-abonnement :checkbox:checked").first().closest(".ligne-lot-abonnement").find(".lot-unite").text();
						} else {
							var lUnite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
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
							
							//var lIdProduit = (this.mNbProduit + 1) *-1;

							var lStockAffichage = "";
							if(lStock != "") {
								lStockAffichage = lStock;
							} else {
								lStock = -1;
							}
							var lQteMaxAffichage = "";
							if(lQteMax != "") {
								lQteMaxAffichage = lQteMax;
							} else {
								lQteMax = -1;
							}
							
							
							var lProduit = {nproId:lIdNomProduit,
											nproNom:pDialog.find(':input[name=produit] option:selected').text(),
											nproStock:lStockAffichage,
											nproQteMax:lQteMaxAffichage,
											nproUnite:lUnite,
											type:lTypeProduit,
											modelesLot:[],
											modelesLotReservation:[]};
							
							if(lTypeProduit == 2) {
								pDialog.find('.ligne-lot-abonnement :checkbox').each( function () {
									var lModele = false;
									if($(this).hasClass("modele-lot")) {
										lModele = true;
									}
									
									var lModeleReservation = false;
									if($(this).hasClass("modele-lot-reservation")) {
										lModeleReservation = true;
									}
									
									var lSelected = false;
									if($(this).attr("checked")) {
										lSelected = true;
									}
									
									if(lModele || lSelected) {
										// Récupération des lots
										var lIdLot = $(this).closest(".ligne-lot-abonnement").find(".lot-id").text();
										
										var lVoLot = {	id:lIdLot,
														taille:$(this).closest(".ligne-lot-abonnement").find(".lot-quantite").text(),
														prix:$(this).closest(".ligne-lot-abonnement").find(".lot-prix").text(),
														unite:$(this).closest(".ligne-lot-abonnement").find(".lot-unite").text(),
														selected:lSelected,
														modele:lModele};
										
										if(lModeleReservation) {
											lProduit.modelesLotReservation[lIdLot] = lVoLot;
										} else {
											lProduit.modelesLot[lIdLot] = lVoLot;
										}
									}
								});	
							} else {
								pDialog.find('.ligne-lot :checkbox').each( function () {
									var lModele = false;
									if($(this).hasClass("modele-lot")) {
										lModele = true;
									}
									
									var lSelected = false;
									if($(this).attr("checked")) {
										lSelected = true;
									}
									if(lModele || lSelected) {
										// Récupération des lots
										var lIdLot = $(this).closest(".ligne-lot").find(".lot-id").text();
										var lVoLot = {	id:lIdLot,
														taille:$(this).closest(".ligne-lot").find(".lot-quantite").text(),
														prix:$(this).closest(".ligne-lot").find(".lot-prix").text(),
														unite:$(this).closest(".ligne-lot").find(".lot-unite").text(),
														selected:lSelected,
														modele:lModele};
										
										lProduit.modelesLot[lIdLot] = lVoLot;
									}
								});	
							}
							
							if(!this.mAffichageMarche[lIdFerme]) {
								this.mAffichageMarche[lIdFerme] = {	ferId:lIdFerme,
																	ferNom:pDialog.find(':input[name=ferme] option:selected').text(),
																	categories:[]};
							}

							if(!this.mAffichageMarche[lIdFerme].categories[lIdCategorie]){
								this.mAffichageMarche[lIdFerme].categories[lIdCategorie] = {
										cproId:lIdCategorie,
										cproNom:pDialog.find(':input[name=categorie] option:selected').text(),
										produits:[],
										produitsAbonnement:[]};
							}
				
							// Préparation du MarcheVO		
							var lVoProduit = new ProduitMarcheVO();
							lVoProduit.idNom = lIdNomProduit;
							lVoProduit.unite = lUnite;
							lVoProduit.qteMaxCommande = lQteMax;
							lVoProduit.qteRestante = lStock;
							lVoProduit.type = lTypeProduit;
							
							if(lTypeProduit == 2) {
								pDialog.find('.ligne-lot-abonnement :checkbox:checked').each( function () {
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
								pDialog.find('.ligne-lot :checkbox:checked').each( function () {
									// Récupération des lots
									var lVoLot = new DetailCommandeVO();
									lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
									lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
									
									lVoProduit.lots.push(lVoLot);										
								});		
							}
							
							lVoProduit.idFerme = lIdFerme;
							lVoProduit.idCategorie = lIdCategorie;
							
							if(lTypeProduit == 1) { // Si produit Solidaire pas de limite de stock
								lVoProduit.qteMaxCommande = -1;
								lVoProduit.qteRestante = -1;
							}
				
							var lValid = new ProduitMarcheValid();
							var lVr = lValid.validAjout(lVoProduit);
							
							if(lVr.valid) {	
								Infobulle.init();
								
								if(lTypeProduit == 2) {
									this.mMarche.produitsAbonnement[lIdNomProduit] = lVoProduit;										
									this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdNomProduit] = lProduit;
								} else {
									this.mMarche.produits[lIdNomProduit] = lVoProduit;
									this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit] = lProduit;
								}
								
								this.mNbProduit++;
								that.majListeFerme();
								
								pDialog.dialog('close');
							} else {
								if(lTypeProduit == 2) {
									Infobulle.generer(lVr,'pro-abo-');
								} else {
									Infobulle.generer(lVr,'pro-');
								}
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
	
	this.majListeFerme = function(pData) {
		var that = this;		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		
		var lFermes = [];		
		$(that.mAffichageMarche).each(function() {
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
		
		var lData = {fermes:[]};
		$(lFermes).each(function(i,val) {
			var lIdFerme = val[1];
			var lCategories = val[2];
			if(that.mAffichageMarche[lIdFerme]) {
				var lAjoutFerme = false;
				var lFerme = {	ferId:that.mAffichageMarche[lIdFerme].ferId,
								ferNom:that.mAffichageMarche[lIdFerme].ferNom,
								categories:[]};
				$(lCategories).each(function(i,val) {
					var lIdCategorie = val[1];
					var lProduits = val[2];
					if(that.mAffichageMarche[lIdFerme].categories[lIdCategorie]) {
						var lAjoutCategorie = false;
						var lCategorie = {
								cproId:that.mAffichageMarche[lIdFerme].categories[lIdCategorie].cproId,
								cproNom:that.mAffichageMarche[lIdFerme].categories[lIdCategorie].cproNom,
								produits:[]};
						$(lProduits).each(function(i,val) {
							var lIdProduit = val[1];
							var lType = val[2];
							var lAbonnement = "";
							if(lType == 2) {
								lAbonnement = lGestionCommandeTemplate.flagAbonnement;
								if(that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit]) {									
									lCategorie.produits.push({
										nproId:that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit].nproId,
										nproNom:that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdProduit].nproNom,
										type:lType,
										abonnement:lAbonnement});
									lAjoutFerme = true;
									lAjoutCategorie = true;
								}
							} else {
								if(that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].type == 1) {
									lAbonnement = lGestionCommandeTemplate.flagSolidaire;
								}
								if(that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit]) {
																	
									lCategorie.produits.push({
										nproId:that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproId,
										nproNom:that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproNom,
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
					lData.fermes.push(lFerme);
				}
			}
		});
		var lTemplate = lGestionCommandeTemplate.ajoutMarcheListeProduit;
				
		/*$("#liste-ferme").replaceWith(this.affectListeProduit( $(lTemplate.template(lData)) ));
		
		if(this.mNbProduit > 0) {
			if($("#btn-gestion-marche").length < 1) {
				$("#liste-ferme").after( this.affectCeerMarche($(lGestionCommandeTemplate.btnValiderAjoutMarche)) );	
			}
		} else {
			$("#btn-gestion-marche").remove();
		}*/
		
		
		
		if(pData) {
			pData.find("#liste-ferme").replaceWith(this.affectListeProduit( $(lTemplate.template(lData)) ));		
		} else {
			$("#liste-ferme").replaceWith(this.affectListeProduit( $(lTemplate.template(lData)) ));			
		}
		
		if(this.mNbProduit > 0) {
			if($("#btn-gestion-marche").length < 1) {
				if(pData) {
					pData.find("#liste-ferme").after( this.affectCeerMarche($(lGestionCommandeTemplate.btnValiderAjoutMarche)) );	
				} else {
					$("#liste-ferme").after( this.affectCeerMarche($(lGestionCommandeTemplate.btnValiderAjoutMarche)) );	
				}
			}
		} else {
			if(pData) {
				pData.find("#btn-gestion-marche").remove();
			} else {
				$("#btn-gestion-marche").remove();
			}
		}

		if(pData) {
			return pData;
		}
	};
	
	this.affectListeProduit = function(pData) {
		pData = this.affectModifierProduit(pData);
		pData = this.affectSupprimerProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};

	this.affectModifierProduit = function(pData) {
		var that = this;
		pData.find(".btn-modifier-produit").click(function() {
			that.dialogModifierProduit( $(this).attr("id-produit"), $(this).attr("typeProduit") );
		});
		return pData;
	};
	
	
	this.dialogModifierProduit = function(pId, pType) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		
		if(pType == 0 || pType == 1) {
			var lIdFerme = this.mMarche.produits[pId].idFerme;
			var lIdCategorie = this.mMarche.produits[pId].idCategorie;
			
			var lData = {	ferId:lIdFerme,
			ferNom:this.mAffichageMarche[lIdFerme].ferNom,
			cproId:lIdCategorie,
			cproNom:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].cproNom,
			nproId:pId,
			nproNom:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[pId].nproNom,
			nproStock:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[pId].nproStock.nombreFormate(2,',',' '),
			nproQteMax:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[pId].nproQteMax.nombreFormate(2,',',' '),
			modelesLot:[]};
						
			lData.typeProduitLabel = "Solidaire";
			
			for(i in this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[pId].modelesLot) {
				var lLot = this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[pId].modelesLot[i];
				if(lLot.id) {
					var lVoLot = {	id:lLot.id,
							quantite:lLot.taille,
							prix:lLot.prix,
							unite:lLot.unite,
							sigleMonetaire:gSigleMonetaire};
					
					if(lLot.selected) {
						lVoLot.checked = "checked=\"checked\"";					
						lData.unite = lLot.unite;
					} else { lVoLot.checked = "";}
					if(lLot.modele) {
						lVoLot.modele = "modele-lot";
					} else { lVoLot.modele = "";}
					lData.modelesLot.push(lVoLot);
				}
			};

			if(pType == 0 ) { // Si produit Normal gestion des limites de stock
				lData.typeProduitLabel = "Normal";

				if(this.mMarche.produits[pId].qteRestante == -1) {
					lData.nproStockCheckedNoLimit = "checked=\"checked\"";
					lData.nproStockDisabled = "disabled=\"disabled\"";
					lData.nproStock = "";
				} else {
					lData.nproStockCheckedLimit = "checked=\"checked\"";
				}
				
				if(this.mMarche.produits[pId].qteMaxCommande == -1) {
					lData.nproQteMaxCheckedNoLimit = "checked=\"checked\"";
					lData.nproQteMaxDisabled = "disabled=\"disabled\"";
					lData.nproQteMax = "";
				} else {
					lData.nproQteMaxCheckedLimit = "checked=\"checked\"";
				}
				lData.divStock = lGestionCommandeTemplate.stockModifProduit.template(lData);
			}
			lData.divLot = lGestionCommandeTemplate.prixModifProduit.template(lData);
		} else { // Produit Abonnement
			var lIdFerme = this.mMarche.produitsAbonnement[pId].idFerme;
			var lIdCategorie = this.mMarche.produitsAbonnement[pId].idCategorie;
			
			var lData = {	ferId:lIdFerme,
			ferNom:this.mAffichageMarche[lIdFerme].ferNom,
			cproId:lIdCategorie,
			cproNom:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].cproNom,
			nproId:pId,
			nproNom:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[pId].nproNom,
			stockInitialAbonnement:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[pId].nproStock.nombreFormate(2,',',' '),
			modelesLotAbonnement:[],
			modelesLotAbonnementReservation:[]};
			
			for(i in this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[pId].modelesLot) {
				var lLot = this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[pId].modelesLot[i];
				if(lLot.id) {
					var lVoLot = {	id:lLot.id,
							quantite:lLot.taille,
							prix:lLot.prix,
							unite:lLot.unite,
							sigleMonetaire:gSigleMonetaire};
					
					if(lLot.selected) {
						lVoLot.checked = "checked=\"checked\"";					
						lData.uniteAbonnement = lLot.unite;
					} else { lVoLot.checked = "";}
					if(lLot.modele) {
						lVoLot.modele = "modele-lot";
					} else { lVoLot.modele = "";}
					lData.modelesLotAbonnement.push(lVoLot);
				}
			};
			
			for(i in this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[pId].modelesLotReservation) {
				var lLot = this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[pId].modelesLotReservation[i];
				if(lLot.id) {
					var lVoLot = {	id:lLot.id,
							quantite:lLot.taille,
							prix:lLot.prix,
							unite:lLot.unite,
							sigleMonetaire:gSigleMonetaire};
					
					if(lLot.selected) {
						lVoLot.checked = "checked=\"checked\"";					
						lData.uniteAbonnement = lLot.unite;
					} else { lVoLot.checked = "";}
					if(lLot.modele) {
						lVoLot.modele = "modele-lot";
					} else { lVoLot.modele = "";}
					lData.modelesLotAbonnementReservation.push(lVoLot);
				}
			};
			
			var lQMax = this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[pId].nproQteMax;
			if(parseFloat(lQMax) == -1) {
				lData.qMaxAbonnement = "Pas de limite";
			} else {
				lData.qMaxAbonnement = lQMax.nombreFormate(2,',',' ') + " " + lData.uniteAbonnement;
			}
			lData.qMaxAbonnementValue = lQMax;
			
			lData.divStock = lGestionCommandeTemplate.stockAbonnementAjoutProduit.template(lData);
			lData.typeProduitLabel = "Abonnement";
			lData.divLot = lGestionCommandeTemplate.prixAbonnementModifProduit.template(lData);
		}

		var lTemplate = lGestionCommandeTemplate.dialogModifProduitAjoutMarche;
		
		$(that.affectPrixEtStock($(lTemplate.template(lData)))).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:900,
			buttons: {
				'Modifier': function() {
					that.modifierProduit($(this),pType);
				},
				'Annuler': function() {
					that.mEditionLot = false;
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});		
	};
	
	this.modifierProduit = function(pDialog,pType) {
		var that = this;
		if(!this.mEditionLot) {
			// Préparation du AffichageMarche
			var lIdFerme = pDialog.find('#pro-idFerme').attr("id-ferme");
			var lIdCategorie = pDialog.find('#pro-idCategorie').attr("id-categorie");
			var lIdNomProduit = pDialog.find('#pro-idProduit').attr("id-produit");

			//var lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();
			var lStock = 0;
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
				var lQteMax = 0;
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
					
					
					//var lUnite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
					if(pType == 2) {
						var lUnite = pDialog.find(".ligne-lot-abonnement :checkbox:checked").first().closest(".ligne-lot-abonnement").find(".lot-unite").text();
					} else {
						var lUnite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
					}
			
					//var lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();
					//var lQteMax = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
					
					var lStockAffichage = "";
					if(lStock != "") {
						lStockAffichage = lStock.nombreFormate(2,',',' ');
					} else {
						lStock = -1;
					}
					var lQteMaxAffichage = "";
					if(lQteMax != "") {
						lQteMaxAffichage = lQteMax.nombreFormate(2,',',' ');
					} else {
						lQteMax = -1;
					}
					
					var lNomProduit = "";
					if(pType == 2) {
						lNomProduit = this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdNomProduit].nproNom;
					} else {
						lNomProduit = this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit].nproNom;
					}
					
					var lProduit = {nproId:lIdNomProduit,
							nproNom:lNomProduit,
							nproStock:lStockAffichage,
							nproQteMax:lQteMaxAffichage,
							nproUnite:lUnite,
							type:pType,
							modelesLot:[],
							modelesLotReservation:[]};
								
					if(pType == 2) {
						pDialog.find('.ligne-lot-abonnement :checkbox').each( function () {
							var lModele = false;
							if($(this).hasClass("modele-lot")) {
								lModele = true;
							}
							
							var lModeleReservation = false;
							if($(this).hasClass("modele-lot-reservation")) {
								lModeleReservation = true;
							}
							
							var lSelected = false;
							if($(this).attr("checked")) {
								lSelected = true;
							}
							
							if(lModele || lSelected) {
								// Récupération des lots
								var lIdLot = $(this).closest(".ligne-lot-abonnement").find(".lot-id").text();
								
								var lVoLot = {	id:lIdLot,
												taille:$(this).closest(".ligne-lot-abonnement").find(".lot-quantite").text(),
												prix:$(this).closest(".ligne-lot-abonnement").find(".lot-prix").text(),
												unite:$(this).closest(".ligne-lot-abonnement").find(".lot-unite").text(),
												selected:lSelected,
												modele:lModele};
								
								if(lModeleReservation) {
									lProduit.modelesLotReservation[lIdLot] = lVoLot;
								} else {
									lProduit.modelesLot[lIdLot] = lVoLot;
								}
							}
						});	
					} else {
						pDialog.find('.ligne-lot :checkbox').each( function () {
							var lModele = false;
							if($(this).hasClass("modele-lot")) {
								lModele = true;
							}
							
							var lSelected = false;
							if($(this).attr("checked")) {
								lSelected = true;
							}
							if(lModele || lSelected) {
								// Récupération des lots
								var lIdLot = $(this).closest(".ligne-lot").find(".lot-id").text();
								var lVoLot = {	id:lIdLot,
												taille:$(this).closest(".ligne-lot").find(".lot-quantite").text(),
												prix:$(this).closest(".ligne-lot").find(".lot-prix").text(),
												unite:$(this).closest(".ligne-lot").find(".lot-unite").text(),
												selected:lSelected,
												modele:lModele};
								
								lProduit.modelesLot[lIdLot] = lVoLot;
							}
						});	
					}

					// Préparation du MarcheVO		
					var lVoProduit = new ProduitMarcheVO();
					lVoProduit.idNom = lIdNomProduit;
					lVoProduit.unite = lUnite;
					lVoProduit.qteMaxCommande = lQteMax;
					lVoProduit.qteRestante = lStock;
					lVoProduit.type = pType;
					
					if(pType == 2) {
						pDialog.find('.ligne-lot-abonnement :checkbox:checked').each( function () {
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
						pDialog.find('.ligne-lot :checkbox:checked').each( function () {
							// Récupération des lots
							var lVoLot = new DetailCommandeVO();
							lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
							lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
							
							lVoProduit.lots.push(lVoLot);										
						});
					}

					if(pType == 1) { // Si produit Solidaire par de limite de stock
						lVoProduit.qteMaxCommande = -1;
						lVoProduit.qteRestante = -1;
					}

					lVoProduit.idFerme = lIdFerme;
					lVoProduit.idCategorie = lIdCategorie;
		
					var lValid = new ProduitMarcheValid();
					var lVr = lValid.validAjout(lVoProduit);
					
					if(lVr.valid) {	
						Infobulle.init();
						if(pType == 2) {
							this.mMarche.produitsAbonnement[lIdNomProduit] = lVoProduit;	
							this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement[lIdNomProduit] = lProduit;
						} else {
							this.mMarche.produits[lIdNomProduit] = lVoProduit;
							this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit] = lProduit;
						}

						that.majListeFerme();
						
						pDialog.dialog('close');
					} else {
						if(pType == 2) {
							Infobulle.generer(lVr,'pro-abo-');
						} else {
							Infobulle.generer(lVr,'pro-');
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

	this.affectSupprimerProduit = function(pData) {
		var that = this;
		pData.find(".btn-supprimer-produit").click(function() {
			that.supprimerProduit( $(this).attr("id-produit"), $(this).attr("typeProduit") );
		});
		return pData;		
	};
	
	this.supprimerProduit = function(pId, pType) {
		if(pType == 0 || pType == 1) {
			var lIdFerme = this.mMarche.produits[pId].idFerme;
			var lIdCategorie = this.mMarche.produits[pId].idCategorie;
			
			this.mMarche.produits.splice(pId,1,null);
			this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits.splice(pId,1,null);
		} else {
			var lIdFerme = this.mMarche.produitsAbonnement[pId].idFerme;
			var lIdCategorie = this.mMarche.produitsAbonnement[pId].idCategorie;
			
			this.mMarche.produitsAbonnement.splice(pId,1,null);
			this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produitsAbonnement.splice(pId,1,null);
		}
		this.mNbProduit--;
		this.majListeFerme();
	};
	
	this.affectCeerMarche = function(pData) {
		var that = this;
		pData.find("#btn-creer-marche").click(function() {
			that.creerMarche();
		});
		pData.find("#btn-modifier-creation-commande").click(function() {
			that.editerMarche();
		});
		return pData;
	};
	
	this.creerMarche = function() {
		var that = this;
		if(!this.mEditionLot) {
		
			//this.mMarche;
			
			this.mMarche.nom = $(':input[name=nom]').val();
			this.mMarche.description = $(':input[name=description]').val();
			this.mMarche.dateMarcheDebut = $(':input[name=date-debut]').val().dateFrToDb();
			this.mMarche.timeMarcheDebut = $(':input[name=heure-debut]').val() + ':' + $(':input[name=minute-debut]').val() + ':00';
			this.mMarche.dateMarcheFin = $(':input[name=date-debut]').val().dateFrToDb();
			this.mMarche.timeMarcheFin = $(':input[name=heure-fin]').val() + ':' + $(':input[name=minute-fin]').val() + ':00';
			this.mMarche.dateDebutReservation = $(':input[name=date-debut-reservation]').val().dateFrToDb();
			this.mMarche.timeDebutReservation = $(':input[name=heure-debut-reservation]').val() + ':' + $(':input[name=minute-debut-reservation]').val() + ':00';
			this.mMarche.dateFinReservation = $(':input[name=date-fin-reservation]').val().dateFrToDb();
			this.mMarche.timeFinReservation = $(':input[name=heure-fin-reservation]').val() + ':' + $(':input[name=minute-fin-reservation]').val() + ':00';
			this.mMarche.archive = "0";
			
			if(this.mEtapeCreationMarche == 0) {
				
				var lValid = new MarcheValid();
				var lVR = lValid.validAjout(this.mMarche);
									
				if(lVR.valid) {
					this.mEtapeCreationMarche = 1;
					Infobulle.init(); // Supprime les erreurs
					$("#nom-marche-span").text(this.mMarche.nom);
					$("#date-debut-reservation-marche-span").text($(':input[name=date-debut-reservation]').val());
					$("#time-debut-reservation-marche-span").text($(':input[name=heure-debut-reservation]').val() + 'H' + $(':input[name=minute-debut-reservation]').val());
					$("#date-fin-reservation-marche-span").text($(':input[name=date-fin-reservation]').val());
					$("#time-fin-reservation-marche-span").text($(':input[name=heure-fin-reservation]').val() + 'H' + $(':input[name=minute-fin-reservation]').val());
					$("#date-debut-marche-span").text($(':input[name=date-debut]').val());
					$("#time-debut-marche-span").text($(':input[name=heure-debut]').val() + 'H' + $(':input[name=minute-debut]').val());
					$("#time-fin-marche-span").text($(':input[name=heure-fin]').val() + 'H' + $(':input[name=minute-fin]').val());
					$("#description-marche-span").text(this.mMarche.description);
			
					$("#btn-ajout-produit-div, .informations-marche, #btn-modifier-creation-commande, .btn-modifier-produit, .btn-supprimer-produit").toggle();
				} else {
					// Affiche les erreurs
					Infobulle.generer(lVR,"marche-");						
				}
			} else if(this.mEtapeCreationMarche == 1){
				// requête de création du marche
				//var lVo = this.mMarche;
				var lVo = new MarcheVO();
				lVo.nom = this.mMarche.nom;
				lVo.description = this.mMarche.description;
				lVo.dateMarcheDebut = this.mMarche.dateMarcheDebut;
				lVo.timeMarcheDebut = this.mMarche.timeMarcheDebut;
				lVo.dateMarcheFin = this.mMarche.dateMarcheFin;
				lVo.timeMarcheFin = this.mMarche.timeMarcheFin;
				lVo.dateDebutReservation = this.mMarche.dateDebutReservation;
				lVo.timeDebutReservation = this.mMarche.timeDebutReservation;
				lVo.dateFinReservation = this.mMarche.dateFinReservation;
				lVo.timeFinReservation = this.mMarche.timeFinReservation;
				lVo.archive = this.mMarche.archive;
				
				// Suppression des lignes vides
				var lProduits = [];
				$(this.mMarche.produits).each(function() {
					if(this.idNom) {
						var lLots = [];
						$(this.lots).each(function() {
							if(this.taille) {
								lLots.push(this);
							}						
						});
						this.lots = lLots;
						lProduits.push(this);
					}
				});
				lVo.produits = lProduits;
				
				// Suppression des lignes vides
				var lProduitsAbonnement = [];
				$(this.mMarche.produitsAbonnement).each(function() {
					if(this.idNom) {
						var lLots = [];
						$(this.lots).each(function() {
							if(this.taille) {
								lLots.push(this);
							}						
						});
						this.lots = lLots;
						lProduitsAbonnement.push(this);
					}
				});
				lVo.produitsAbonnement = lProduitsAbonnement;
				
				//var lVo = this.mMarche;
				lVo.fonction = "ajouter";
				$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lVo),
						function (lResponse) {		
							if(lResponse) {
								if(lResponse.valid) {
									var lVR = new Object();
									var erreur = new VRerreur();
									erreur.code = ERR_334_CODE;
									erreur.message = ERR_334_MSG;
									lVR.valid = false;
									lVR.log = new VRelement();
									lVR.log.valid = false;
									lVR.log.erreurs.push(erreur);
									
									
									EditerCommandeVue({id_marche:lResponse.id,vr:lVR});									
								} else {
									that.editerMarche();
									Infobulle.generer(lResponse,"marche-");
								}
							}
						},"json"
				);
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
	
	
	this.editerMarche = function() {
		this.mEtapeCreationMarche = 0;
		$("#btn-ajout-produit-div, .informations-marche, #btn-modifier-creation-commande, .btn-modifier-produit, .btn-supprimer-produit").toggle();
	};


	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.lienDatepickerMarche('marche-dateDebutReservation', 'marche-dateFinReservation', 'marche-dateMarcheDebut', pData);
		pData.find('#marche-dateDebutReservation').datepicker( "setDate", getDateAujourdhuiDb().dateDbToFr() );
		pData.find('#marche-dateFinReservation').datepicker("option", "minDate", new Date());
		pData.find('#marche-dateMarcheDebut').datepicker("option", "minDate", new Date());
		return pData;
	};

	this.construct(pParam);
	
}