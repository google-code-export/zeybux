;function ListeProduitVue(pParam) {
	this.mEditionLot = false;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeProduitVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"afficher"};
		lParam = $.extend(lParam,pParam);
		$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
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
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		
		if(lResponse.produits && lResponse.produits.fermes && lResponse.produits.fermes.length > 0 && lResponse.produits.fermes[0].nom != null) {
			var lTemplate = lGestionAbonnementTemplate.listeProduit;			
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse.produits))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionAbonnementTemplate.listeProduitVide)));
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectRecherche(pData);
		pData = this.affectLienProduit(pData);
		pData = this.affectAjoutProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};

	this.affectAjoutProduit = function(pData) {
		var that = this;
		pData.find('#btn-nv-produit').click(function() {
			that.dialogAjoutProduit();
		});
		return pData;
	};
		
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	};
			
	this.affectLienProduit = function(pData) {
		pData.find(".ligne-produit").click(function() {
			DetailProduitAbonnementVue({id: $(this).attr("idProduit")});
		});
		return pData;
	};
	
	this.dialogAjoutProduit = function(pData) {
		var that = this;
		var lParam = {fonction:"listeFerme"};
		$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
							var lTemplate = lGestionAbonnementTemplate.dialogAjoutProduit;
							
							$(that.affectAjoutProduitSelectFerme($(lTemplate.template(lResponse)))).dialog({			
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
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);	
		return pData;
	};
	
	this.affectAjoutProduitSelectFerme = function(pData) {
		var that = this;
		pData.find("#pro-idFerme select").change(function() {
			var lId = $(this).val();
			$("#pro-idCategorie select, #pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#detail-produit").replaceWith("<div id=\"detail-produit\"></div>");
			if(lId > 0) {
				var lParam = {fonction:"listeProduit",id:lId};
				$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
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
									
	
									var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
									var lTemplate = lGestionAbonnementTemplate.ajoutProduitSelectCategorie;
									
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
			$("#detail-produit").replaceWith("<div id=\"detail-produit\"></div>");
			if(lId > 0) {
				
				var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
				var lTemplate = lGestionAbonnementTemplate.ajoutProduitSelectProduit;
				
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
				var lParam = {fonction:"listeUnite",id:lId};
				$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								
								var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
								var lTemplate = lGestionAbonnementTemplate.detailProduitAjoutProduit;
								
								var lData = {};
								if(lResponse.unite.length > 0) {
									/*if(lResponse.unite.length == 1) {
										if(lResponse.unite[0].mLotId == null) { // Pas d'unité
											lData.formUnite = lGestionAbonnementTemplate.formUniteSansUnite;
										} else { // Une seule unité
											lData.formUnite = lGestionAbonnementTemplate.formUnite.template({unite:lResponse.unite[0].mLotUnite});
											lData.unite = lResponse.unite[0].mLotUnite;
										}
									} else { // Plusieures unités
										lData.formUnite = lGestionAbonnementTemplate.formUniteSelect.template(lResponse);
									}*/
									
									lData.modelesLot = [];
									$(lResponse.unite).each(function() {
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
									lResponse.modelesLot = lResponse.unite;
								}
								
								$("#detail-produit").replaceWith(that.affectDetailProduit($(lTemplate.template(lData))));
									
								
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
			} else {
				$("#detail-produit").replaceWith($("<div id=\"detail-produit\">"));
			}			
		});
		return pData;
	};
	
	this.affectDetailProduit = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectLimiteStock(pData);
		pData = this.affectAjoutLot(pData);
		pData = this.affectAjoutLotGestion(pData);
		//pData = this.affectFormUnite(pData);
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
			var lGestionAbonnementTemplate = new GestionAbonnementTemplate();		
			var lTemplate = lGestionAbonnementTemplate.modeleLot;				
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
		pData = this.affectAjoutLotGestion(pData);
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
	
	this.affectLimiteStock = function(pData) {
		pData.find(':input[name=pro-qte-max-choix]').change(function() {
			if($(':input[name=pro-qte-max-choix]:checked').val() == 1) {				
				$(":input[name=pro-qte-max]").attr("disabled","").val("");
			} else {
				$(":input[name=pro-qte-max]").attr("disabled","disabled").val("");
			}
		});
		return pData;
	};

	this.ajoutLotModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text().numberFrToDb().nombreFormate(2,',',''));
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text().numberFrToDb().nombreFormate(2,',',''));
		
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
	
	/*this.affectFormUnite = function(pData) {
		var that = this;
		pData.find("#pro-unite").keyup(function(event) {
			$(".unite-stock").text($('#pro-unite').val());
		}).change(function() {
			$(".unite-stock").text($('#pro-unite').val());
		});		
		return pData;
	};*/
	
	this.ajouterProduit = function(pDialog) {
		var that = this;		
		var lIdNomProduit = pDialog.find(':input[name=produit]').val();

		if(lIdNomProduit != 0) {
			var lProduitAbonnement = new ProduitAbonnementVO();
			lProduitAbonnement.idNomProduit = lIdNomProduit;
			lProduitAbonnement.unite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
			lProduitAbonnement.stockInitial = pDialog.find(':input[name=pro-stockInitial]').val().numberFrToDb();
			if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1) {
				lProduitAbonnement.max = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
			} else {
				lProduitAbonnement.max = -1;
			}
			lProduitAbonnement.frequence = pDialog.find(':input[name=pro-frequence]').val();
			
			// Récupération des lots
			pDialog.find('.ligne-lot :checkbox:checked').each( function () {
				// Récupération des lots
				var lVoLot = new DetailCommandeVO();
				lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
				lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
				
				lProduitAbonnement.lots.push(lVoLot);										
			});	
			
			var lValid = new ProduitAbonnementValid();
			var lVr = lValid.validAjout(lProduitAbonnement);
			
			if(lVr.valid) {	
				Infobulle.init();
				lProduitAbonnement.fonction = "ajouter";
				$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lProduitAbonnement),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
								
	
								var lVR = new Object();
								var erreur = new VRerreur();
								erreur.code = ERR_342_CODE;
								erreur.message = ERR_342_MSG;
								lVR.valid = false;
								lVR.log = new VRelement();
								lVR.log.valid = false;
								lVR.log.erreurs.push(erreur);
								
								that.construct({vr:lVR});
								pDialog.dialog('close');
							} else {
								Infobulle.generer(lResponse,'pro-');
							}
						}
					},"json"
				);
			} else {
				Infobulle.generer(lVr,'pro-');
			}
		}
	};
	
	this.construct(pParam);
}