;function AjoutCommandeVue(pParam) {
	
	this.mListeFerme = {};
	this.mProduits = [];
	this.mMarche = new MarcheVO();
	this.mAffichageMarche = [];
	this.mNbProduit = 0;
	this.mEditionLot = false;
	this.mIdLot = 0;
	this.mEtapeCreationMarche = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {AjoutCommandeVue(pParam);}} );
		var lParam = $.extend(lParam, pParam);
		lParam.fonction = "afficher";
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {	
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}						
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
	
	this.affectDialogAjoutProduit = function(pData) {
		var that = this;
		pData.find("#btn-ajout-produit").click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogAjoutProduitAjoutMarche;
			
			$(that.affectAjoutProduitSelectFerme($(lTemplate.template({listeFerme:that.mListeFerme})))).dialog({			
				autoOpen: true,
				modal: true,
				draggable: true,
				resizable: false,
				width:900,
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
				if(!that.mMarche.produits[lId]) {
					var lParam = {fonction:"listeModeleLot",idNomProduit:lId};
					$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
						function (lResponse) {		
							if(lResponse) {
								if(lResponse.valid) {
									Infobulle.init(); // Supprime les erreurs
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
									
									var lGestionCommandeTemplate = new GestionCommandeTemplate();
									var lTemplate = lGestionCommandeTemplate.prixEtStockAjoutProduit;
									
									$("#prix-stock-produit").replaceWith(that.affectPrixEtStock($(lTemplate.template(lData))));
										
									
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
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectAjoutLotGestion(pData);
		pData = this.affectAjoutLot(pData);
		pData = this.affectLimiteStock(pData);
		return pData;		
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
		pData.find('#btn-ajout-lot').click(function() {that.ajoutLot();});
		pData.find('#table-pro-prix input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLot();
			}
		});		
		return pData;		
	};
	
	this.ajoutLot = function() {
		var lVo = new ModeleLotVO();
		lVo.quantite = $(":input[name=lot-quantite]").val().numberFrToDb();
		lVo.unite = $(":input[name=lot-unite]").val();
		lVo.prix = $(":input[name=lot-prix]").val().numberFrToDb();

		var lValid = new ModeleLotValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.modeleLot;
			
			this.mIdLot--;
			lVo.id = this.mIdLot;
			lVo.sigleMonetaire = gSigleMonetaire;
			lVo.quantite = lVo.quantite.nombreFormate(2,',',' ');
			lVo.prix = lVo.prix.nombreFormate(2,',',' ');		
			$("#lot-liste").append(this.affectLot($(lTemplate.template(lVo))));
			
			$(":input[name=lot-quantite], :input[name=lot-unite], :input[name=lot-prix]").val("");
		} else {
			Infobulle.generer(lVr,'pro-lot-');
		}
	};
	
	this.affectLot = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectAjoutLotGestion(pData);
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
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		this.mEditionLot = false;
	};
	
	this.ajoutLotSupprimer = function(pId) {
		$("#ligne-lot-" + pId).remove();
	};
	
	this.ajouterProduit = function(pDialog) {
		var that = this;
		if(!this.mEditionLot) {
			// Préparation du AffichageMarche
			var lIdFerme = pDialog.find(':input[name=ferme]').val();
			var lIdCategorie = pDialog.find(':input[name=categorie]').val();
			var lIdNomProduit = pDialog.find(':input[name=produit]').val();

			if(lIdNomProduit != 0) {
				var lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();

				if(pDialog.find(':input[name=pro-stock-choix]:checked').val() == 1 && lStock == "") { // Si une limite de stock est sélectionné il faut la saisir
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
					var lQteMax = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
					if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1 && lQteMax == "") { // Si une Qmax est sélectionné il faut la saisir
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
						var lUnite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
						
						var lProduit = {nproId:lIdNomProduit,
										nproNom:pDialog.find(':input[name=produit] option:selected').text(),
										nproStock:lStock,
										nproQteMax:lQteMax,
										nproUnite:lUnite,
										modelesLot:[]};
						
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
						
						if(!this.mAffichageMarche[lIdFerme]) {
							this.mAffichageMarche[lIdFerme] = {	ferId:lIdFerme,
																ferNom:pDialog.find(':input[name=ferme] option:selected').text(),
																categories:[]};
						}
						
						if(!this.mAffichageMarche[lIdFerme].categories[lIdCategorie]){
							this.mAffichageMarche[lIdFerme].categories[lIdCategorie] = {
									cproId:lIdCategorie,
									cproNom:pDialog.find(':input[name=categorie] option:selected').text(),
									produits:[]};
						}
						
			
						// Préparation du MarcheVO		
						var lVoProduit = new ProduitMarcheVO();
						lVoProduit.idNom = lIdNomProduit;
						lVoProduit.unite = lUnite;
						lVoProduit.qteMaxCommande = lQteMax;
						lVoProduit.qteRestante = lStock;
								
						pDialog.find('.ligne-lot :checkbox:checked').each( function () {
							// Récupération des lots
							var lVoLot = new DetailCommandeVO();
							lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
							lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
							
							lVoProduit.lots.push(lVoLot);										
						});						
						
						lVoProduit.idFerme = lIdFerme;
						lVoProduit.idCategorie = lIdCategorie;
			
						var lValid = new ProduitMarcheValid();
						var lVr = lValid.validAjout(lVoProduit);
						
						if(lVr.valid) {	
							Infobulle.init();
							this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit] = lProduit;
							this.mMarche.produits[lIdNomProduit] = lVoProduit;
			
							this.mNbProduit++;
							that.majListeFerme();
							
							pDialog.dialog('close');
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
	
	this.majListeFerme = function() {
		var that = this;		
		var lFermes = [];		
		$(that.mAffichageMarche).each(function() {
			if(this.ferId) {
				var lCategories = [];
				$(this.categories).each(function() {
					if(this.cproId) {
						var lProduits = [];
						$(this.produits).each(function() {
							if(this.nproId) {
								lProduits.push([this.nproNom,this.nproId]);
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
							if(that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit]) {
								lCategorie.produits.push({
									nproId:that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproId,
									nproNom:that.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproNom});
								lAjoutFerme = true;
								lAjoutCategorie = true;
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

		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.ajoutMarcheListeProduit;
				
		$("#liste-ferme").replaceWith(this.affectListeProduit( $(lTemplate.template(lData)) ));
		
		if(this.mNbProduit > 0) {
			if($("#btn-gestion-marche").length < 1) {
				$("#liste-ferme").after( this.affectCeerMarche($(lGestionCommandeTemplate.btnValiderAjoutMarche)) );	
			}
		} else {
			$("#btn-gestion-marche").remove();
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
			that.dialogModifierProduit( $(this).attr("id-produit") );
		});
		return pData;
	};
	
	
	this.dialogModifierProduit = function(pId) {
		var that = this;
		var lIdFerme = this.mMarche.produits[pId].idFerme;
		var lIdCategorie = this.mMarche.produits[pId].idCategorie;
		
		
		var lData = {	ferId:lIdFerme,
						ferNom:this.mAffichageMarche[lIdFerme].ferNom,
						cproId:lIdCategorie,
						cproNom:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].cproNom,
						nproId:pId,
						nproNom:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[pId].nproNom,
						nproStock:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[pId].nproStock,
						nproQteMax:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[pId].nproQteMax,
						modelesLot:[]};
		
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
		
		if(this.mMarche.produits[pId].qteRestante == "") {
			lData.nproStockCheckedNoLimit = "checked=\"checked\"";
			lData.nproStockDisabled = "disabled=\"disabled\"";
		} else {
			lData.nproStockCheckedLimit = "checked=\"checked\"";
		}
		
		if(this.mMarche.produits[pId].qteMaxCommande == "") {
			lData.nproQteMaxCheckedNoLimit = "checked=\"checked\"";
			lData.nproQteMaxDisabled = "disabled=\"disabled\"";
		} else {
			lData.nproQteMaxCheckedLimit = "checked=\"checked\"";
		}
				
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogModifProduitAjoutMarche;
		
		$(that.affectPrixEtStock($(lTemplate.template(lData)))).dialog({			
			autoOpen: true,
			modal: true,
			draggable: true,
			resizable: false,
			width:900,
			buttons: {
				'Modifier': function() {
					that.modifierProduit($(this));
				},
				'Annuler': function() {
					that.mEditionLot = false;
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});		
	};
	
	this.modifierProduit = function(pDialog) {
		var that = this;
		if(!this.mEditionLot) {
			// Préparation du AffichageMarche
			var lIdFerme = pDialog.find('#pro-idFerme').attr("id-ferme");
			var lIdCategorie = pDialog.find('#pro-idCategorie').attr("id-categorie");
			var lIdNomProduit = pDialog.find('#pro-idProduit').attr("id-produit");
			
			
			var lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();

			if(pDialog.find(':input[name=pro-stock-choix]:checked').val() == 1 && lStock == "") { // Si une limite de stock est sélectionné il faut la saisir
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
				var lQteMax = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
				if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1 && lQteMax == "") { // Si une Qmax est sélectionné il faut la saisir
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
			
			
					//var lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();
					//var lQteMax = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
					var lUnite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
					
					var lStockAffichage = "";
					if(lStock != "") {
						lStockAffichage = lStock.nombreFormate(2,',',' ');
					}
					var lQteMaxAffichage = "";
					if(lQteMax != "") {
						lQteMaxAffichage = lQteMax.nombreFormate(2,',',' ');
					}
					
					var lProduit = {nproId:lIdNomProduit,
									nproNom:this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit].nproNom,
									nproStock:lStockAffichage,
									nproQteMax:lQteMaxAffichage,
									nproUnite:lUnite,
									modelesLot:[]};
					
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
											unite:lUnite,
											selected:lSelected,
											modele:lModele};
							
							lProduit.modelesLot[lIdLot] = lVoLot;
						}
					});	
					
					/*if(!this.mAffichageMarche[lIdFerme]) {
						this.mAffichageMarche[lIdFerme] = {	ferId:lIdFerme,
															ferNom:pDialog.find(':input[name=ferme] option:selected').text(),
															categories:[]};
					}
					
					if(!this.mAffichageMarche[lIdFerme].categories[lIdCategorie]){
						this.mAffichageMarche[lIdFerme].categories[lIdCategorie] = {
								cproId:lIdCategorie,
								cproNom:pDialog.find(':input[name=categorie] option:selected').text(),
								produits:[]};
					}
					*/
		
					// Préparation du MarcheVO		
					var lVoProduit = new ProduitMarcheVO();
					lVoProduit.idNom = lIdNomProduit;
					lVoProduit.unite = lUnite;
					lVoProduit.qteMaxCommande = lQteMax;
					lVoProduit.qteRestante = lStock;
							
					pDialog.find('.ligne-lot :checkbox:checked').each( function () {
						// Récupération des lots
						var lVoLot = new DetailCommandeVO();
						lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
						lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
						
						lVoProduit.lots.push(lVoLot);										
					});						
					
					lVoProduit.idFerme = lIdFerme;
					lVoProduit.idCategorie = lIdCategorie;
		
					var lValid = new ProduitMarcheValid();
					var lVr = lValid.validAjout(lVoProduit);
					
					if(lVr.valid) {	
						Infobulle.init();
						this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit] = lProduit;
						this.mMarche.produits[lIdNomProduit] = lVoProduit;
						that.majListeFerme();
						
						pDialog.dialog('close');
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
			that.supprimerProduit( $(this).attr("id-produit") );
		});
		return pData;		
	};
	
	this.supprimerProduit = function(pId) {
		var lIdFerme = this.mMarche.produits[pId].idFerme;
		var lIdCategorie = this.mMarche.produits[pId].idCategorie;
		
		this.mMarche.produits.splice(pId,1,null);
		this.mAffichageMarche[lIdFerme].categories[lIdCategorie].produits.splice(pId,1,null);
		
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
		
			this.mMarche;
			
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
				//var lVo = {};
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
				this.mMarche.produits = lProduits;
				var lVo = this.mMarche;
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
									
									
									EditerCommandeVue({id_commande:lResponse.id,vr:lVR});									
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