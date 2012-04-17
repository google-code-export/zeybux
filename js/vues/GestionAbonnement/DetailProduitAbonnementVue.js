;function DetailProduitAbonnementVue(pParam) {
	this.mLotAbonnes = [];
	this.mIdLot = 0;
	this.mEditionLot = false;
	this.mLotRemplacement = [];

	this.construct = function(pParam) {
		$.history( {'vue':function() {DetailProduitAbonnementVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"detailProduit"};
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
		
		$.each(lResponse.abonnes,function() {
			if(!that.mLotAbonnes[this.cptAboIdLotAbonnement]) {
				that.mLotAbonnes[this.cptAboIdLotAbonnement] = {id:this.cptAboIdLotAbonnement,quantite:this.cptAboQuantite};
			}
		});
		
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lData= {};
		lData.proAboId = lResponse.produit[0].proAboId;
		lData.unite = lResponse.produit[0].proAboUnite;
		lData.proAboUnite = lData.unite;
		lData.proAboFrequence = lResponse.produit[0].proAboFrequence;
		lData.proAboStockInitial = lResponse.produit[0].proAboStockInitial.nombreFormate(2,',',' ');
		if(lResponse.produit[0].proAboMax == -1) {
			lData.proAboMax = "Pas de limite";
		} else {
			lData.proAboMax = lResponse.produit[0].proAboMax.nombreFormate(2,',',' ') + " " + lData.unite;
		}
		
		if(lResponse.abonnes && lResponse.abonnes.length > 0 && lResponse.abonnes[0].cptAboIdProduitAbonnement != null) {
			$.each(lResponse.abonnes,function() {
				this.cptAboQuantite = this.cptAboQuantite.nombreFormate(2,',',' ');
				this.proAboUnite = lData.proAboUnite;
			});
			
			lData.listeAbonnes = lGestionAbonnementTemplate.detailProduitListeAbonnes.template(lResponse);
		} else {
			lData.listeAbonnes = lGestionAbonnementTemplate.detailProduitListeAbonnesVide;
		}
		
		$('#contenu').replaceWith(that.affect($(lGestionAbonnementTemplate.detailProduit.template(lData))));
		
	};
	
	this.affect = function(pData) {
		pData = this.affectLienRetour(pData);
		pData = this.affectModifier(pData);
		pData = affectDialogSuppProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#lien-retour").click(function() { ListeProduitVue(); });
		return pData;
	};
	
	this.affectModifier = function(pData) {		
		var that = this;
		pData.find("#btn-modifier").click(function() {
			var lParam = {fonction:"detailProduitModifier", id:$(this).attr("idProduit")};
			$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
								var lTemplate = lGestionAbonnementTemplate.dialogModifierProduit;
								
								var lData = lResponse.produit[0];
								
								if(lResponse.unite.length > 0) {
									/*if(lResponse.unite.length == 1) {
										if(lResponse.unite[0].mLotId == null) { // Pas d'unité
											lData.formUnite = lGestionAbonnementTemplate.formUniteSansUnite.template({unite:lData.proAboUnite});
										} else { // Une seule unité
											lData.formUnite = lGestionAbonnementTemplate.formUnite.template({unite:lResponse.unite[0].mLotUnite});
											lData.unite = lResponse.unite[0].mLotUnite;
										}
									} else { // Plusieures unités
										$.each(lResponse.unite,function() {
											if(lData.proAboUnite == this.mLotUnite) {
												this.selected = "selected=\"selected\"";
											}
										});
										lData.formUnite = lGestionAbonnementTemplate.formUniteSelect.template(lResponse);
									}*/

									lData.modelesLot = [];
								/*	$(lResponse.unite).each(function() {
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
									lResponse.modelesLot = lResponse.unite;*/
									
									
									
									lData.listeModelesLot = [];
									$(lResponse.unite).each(function() {
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
									$(lData.lots).each(function() {
										var lVoLot = {	
												id:this.id,
												quantite:this.taille.nombreFormate(2,',',' '),
												prix:this.prix.nombreFormate(2,',',' '),
												unite:lData.proAboUnite,
												sigleMonetaire:gSigleMonetaire,
												modele: "",
												checked:"checked=\"checked\""};
										lData.modelesLot.push(lVoLot);
									});
									lResponse.modelesLot = lResponse.unite;
									
									/*if(lResponse.produit.qteRestante == "" || lResponse.produit.stockInitial == -1) {
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
									lData.divLot = lGestionCommandeTemplate.prixModifProduit.template(lData);*/
									
									
									
									
									
								}
								lData.proAboStockInitial = lData.proAboStockInitial.nombreFormate(2,',',' ');
								if(lData.proAboMax == -1) {
									lData.checkedNoLimit = "checked=\"checked\"";
									lData.disableLimit = "disabled=\"disabled\"";
								} else {
									lData.checkedLimit = "checked=\"checked\"";
									lData.max = lData.proAboMax.nombreFormate(2,',',' ');
								}
								lData.sigleMonetaire = gSigleMonetaire;

								$(that.affectModifierDetailProduit($(lTemplate.template(lData)))).dialog({			
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
	
	this.affectModifierDetailProduit = function(pData) {
		pData = this.affectLimiteStock(pData);
		//pData = this.affectFormUnite(pData);
		pData = this.affectAjoutLot(pData);
		pData = this.affectAjoutLotGestionModifier(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
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
		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text());
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text());
		
		this.mEditionLot = true;
	};
	

	/*this.ajoutLotValiderModification = function(pId) {
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
	};*/
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		this.mEditionLot = false;
	};
	
	this.ajoutLotSupprimer = function(pId) {
		$("#ligne-lot-" + pId).remove();
	};
	
	this.affectAjoutLotGestionModifier = function(pData) {
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
			that.modifierLotSupprimer($(this).closest('tr').find('#id-lot').text());
		});
		pData.find(":checkbox").change(function() {	
			var lMajUnite = that.majUnite();
			if($(this).attr("checked")) {
				if(!lMajUnite) {
					$(this).removeAttr("checked");
				}
			} else {
				if(!that.autorisationSupprimerLot($(this).closest('tr').find('#id-lot').text())) {
					$(this).attr("checked","checked");
				}
			}
		});
		return pData;		
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
		lVo.id = pId;
		lVo.quantite = $("#pro-lot-" + pId + "-quantite").val().numberFrToDb();
		lVo.unite = $("#pro-lot-" + pId + "-unite").val();
		lVo.prix = $("#pro-lot-" + pId + "-prix").val().numberFrToDb();
	
		var lValid = new ModeleLotValid();
		if(this.autorisationSupprimerLot(pId)) {
			var lVr = lValid.validAjout(lVo);
		} else {
			var lVr = lValid.validUpdateAvecReservation(lVo,this.mLotAbonnes[pId].quantite);
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
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		this.mEditionLot = false;
	};
	
	this.modifierLotSupprimer = function(pId) {	
		if(this.autorisationSupprimerLot(pId)) {
			$("#ligne-lot-" + pId).remove();								
		} else {
			this.dialogSupprimerLot(pId);
		}
	};
	
	this.autorisationSupprimerLot = function(pIdLot) {
		if(this.mLotAbonnes[pIdLot]) {
			return false;
		}
		return true;
	};
	
	this.dialogSupprimerLot = function(pId) {		
		var that = this;
		
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
		var lData = {modelesLot:[]};

		var lUnite = $('#lot-' + pId + '-unite').text();
		var lQuantite = parseFloat($('#lot-' + pId + '-quantite').text().numberFrToDb());
		
			//$("#dialog-modif-pro").find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();	
		$("#dialog-modif-pro").find('.ligne-lot').each( function () {								
			var lId = $(this).find(".lot-id").text();
			var lQuantiteLot = parseFloat($(this).find(".lot-quantite").text().numberFrToDb());
			var lPrix = parseFloat($(this).find(".lot-prix").text().numberFrToDb());
			var lUniteLot = $(this).find(".lot-unite").text();
			
			//alert(lQuantite % lQuantiteLot);
			
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
		
		$(lGestionAbonnementTemplate.dialogSupprimerLotModifierMarche.template(lData)).dialog({			
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
			$("#ligne-lot-" + pIdLot + ", #btn-supprimer-lot-" + lIdLotRemplacement).remove(); // Supression du formulaire de l'ancien lot + delete du bouton de suppression du lot de remplacement
			$("#pro-lot-" + lIdLotRemplacement + "-id").attr("checked","checked").attr("disabled","disabled"); // Coche le lot dans le formulaire et le rend non sélectionnable
			pDialog.dialog('close'); // Fermeture de la fenêtre
		}
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
	
	this.modifierProduit = function(pDialog) {
		var that = this;
		
		var lProduitAbonnement = new ProduitAbonnementVO();
		lProduitAbonnement.id = pDialog.find(':input[name=idProduit]').val();
		//lProduitAbonnement.unite = pDialog.find(':input[name=pro-formUnite]').val();
		lProduitAbonnement.unite = pDialog.find(".ligne-lot :checkbox:checked").first().closest(".ligne-lot").find(".lot-unite").text();
		lProduitAbonnement.stockInitial = pDialog.find(':input[name=pro-stockInitial]').val().numberFrToDb();
		if(pDialog.find(':input[name=pro-qte-max-choix]:checked').val() == 1) {
			lProduitAbonnement.max = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();
		} else {
			lProduitAbonnement.max = -1;			
		}		
		lProduitAbonnement.frequence = pDialog.find(':input[name=pro-frequence]').val();

		lProduitAbonnement.lotRemplacement = this.mLotRemplacement;
		pDialog.find('.ligne-lot :checkbox:checked').each( function () {
			// Récupération des lots
			var lVoLot = new DetailCommandeVO();
			lVoLot.id = $(this).closest(".ligne-lot").find(".lot-id").text();
			lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
			lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
			
			lProduitAbonnement.lots.push(lVoLot);										
		});
		
		var lValid = new ProduitAbonnementValid();
		var lVr = lValid.validUpdate(lProduitAbonnement);		
		if(lVr.valid) {	
			Infobulle.init();
			lProduitAbonnement.fonction = "modifier";
			$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lProduitAbonnement),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs

							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_343_CODE;
							erreur.message = ERR_343_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);
							
							that.construct({id:lProduitAbonnement.id,vr:lVR});
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
	};
	
	this.affectDialogSuppProduit = function(pData) {
		var that = this;
		pData.find("#btn-supp").click(function() {
			var lGestionAbonnementTemplate = new GestionAbonnementTemplate();
			var lTemplate = lGestionAbonnementTemplate.dialogSuppressionProduit;
			var lButton = this;
			$(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {fonction:"supprimer", id:$(lButton).attr("idProduit")};
						var lDialog = this;
						$.post(	"./index.php?m=GestionAbonnement&v=ListeProduit", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											$(lDialog).dialog('close');

											var lVR = new Object();
											var erreur = new VRerreur();
											erreur.code = ERR_344_CODE;
											erreur.message = ERR_344_MSG;
											lVR.valid = false;
											lVR.log = new VRelement();
											lVR.log.valid = false;
											lVR.log.erreurs.push(erreur);
											
											ListeProduitVue({vr:lVR});
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
}