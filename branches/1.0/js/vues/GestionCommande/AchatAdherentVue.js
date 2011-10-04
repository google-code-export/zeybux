;function AchatAdherentVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mAdherent = null;
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = [];
	this.achats = [];
	this.achatsSolidaire = [];
	this.infoReservation = {};
	this.stockSolidaire = [];
	this.pParam = {};

	this.construct = function(pParam) {
		$.history( {'vue':function() {AchatAdherentVue(pParam);}} );
		var that = this;
		this.pParam = pParam;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mAdherent = lResponse.adherent;						
	
							that.infoCommande.comId = lResponse.marche.id;
							that.infoCommande.comNumero = lResponse.marche.numero;
							that.infoCommande.comNom = lResponse.marche.nom;
							that.infoCommande.comDescription = lResponse.marche.description;
							that.infoCommande.dateTimeFinReservation = lResponse.marche.dateFinReservation;
							that.infoCommande.dateFinReservation = lResponse.marche.dateFinReservation.extractDbDate().dateDbToFr();
							that.infoCommande.heureFinReservation = lResponse.marche.dateFinReservation.extractDbHeure();
							that.infoCommande.minuteFinReservation = lResponse.marche.dateFinReservation.extractDbMinute();
							that.infoCommande.dateMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbDate().dateDbToFr();
							that.infoCommande.heureMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbHeure();
							that.infoCommande.minuteMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbMinute();
							that.infoCommande.heureMarcheFin = lResponse.marche.dateMarcheFin.extractDbHeure();
							that.infoCommande.minuteMarcheFin = lResponse.marche.dateMarcheFin.extractDbMinute();
							that.infoCommande.comArchive = lResponse.marche.archive;
							that.pdtCommande = lResponse.marche.produits;
							
							that.infoReservation = lResponse.reservation;
							that.stockSolidaire = lResponse.stockSolidaire;
							$.each(that.pdtCommande,function() {
								if(this.id) {
									var lIdProduit = this.id;
									$.each(this.lots, function() {
										if(this.id) {
											var lIdLot = this.id;
											$(lResponse.reservation.detailReservation).each(function() {
												if(this.idDetailCommande == lIdLot) {
													this.stoQuantite = this.quantite * -1;
													this.dcomId = this.idDetailCommande;
													this.proId = lIdProduit;
													this.montant = this.montant * -1;
													that.reservation[lIdProduit] = this;
												}											
											});
										}
									});
								}
							});
					
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.detailAchatEtReservation;
		
		var lData = {};		
		lData.adhId = this.mAdherent.adhId;
		lData.adhNumero = this.mAdherent.adhNumero;
		lData.adhCompte = this.mAdherent.cptLabel;
		lData.adhNom = this.mAdherent.adhNom;
		lData.adhPrenom = this.mAdherent.adhPrenom;
		lData.adhSolde = this.mAdherent.cptSolde.nombreFormate(2,',',' ');
		
		lData.sigleMonetaire = gSigleMonetaire;
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		
		lData.totalReservation = (this.infoReservation.total * -1).nombreFormate(2,',',' ');
		lData.reservation = [];

		var lPdtAchat = false; // Pour n'afficher le formulaire achat uniquement si il y a des produits
		$.each(this.pdtCommande,function() {
			lPdtAchat = true;
			
			var lIdProduit = this.id;
			var lPdt = {};
			lPdt.id = this.id;
			lPdt.nproNom = this.nom;
			lPdt.proUniteMesure = this.unite;
			
			lPdt.prix = 0;
			lPdt.stoQuantite = 0;
						
			if(that.reservation[lIdProduit]) {
				lPdt.stoQuantite = parseFloat(that.reservation[lIdProduit].stoQuantite);
				lPdt.prix = parseFloat(that.reservation[lIdProduit].montant);
			}

			lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
			lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
			
			lData.reservation.push(lPdt);
		});	


		lData.achats = [];
		lData.achatsSolidaire = [];

		var lNbAchat = 0;
		$(pResponse.achats).each(function() {
			var lAchat = this;
			var lDataPdtAchat = [];
			var lAchatClassique = false;
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lIdProduit = this.id;
					
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					
					lPdt.prix = 0;
					lPdt.stoQuantite = 0;
					
					$.each(this.lots, function() {
						if(this.id) {
							var lIdLot = this.id;
							$(lAchat.detailAchat).each(function() {
								if(this.idDetailCommande == lIdLot) {
									lPdt.stoQuantite = this.quantite * -1;
									lPdt.prix = this.montant * -1;
									lNbAchat++;
									lAchatClassique = true;
								}
							});
						}
					});

					lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
					lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
					lDataPdtAchat.push(lPdt);
				}
			});
			
			if(lAchatClassique) {
				var lDataAchat = {	achat:lDataPdtAchat,
									idAchat:this.id.idAchat,
									total:(this.total * -1).nombreFormate(2,',',' ')};
				lData.achats.push(lDataAchat);
			}
		});

		if(lNbAchat == 0 && lPdtAchat ) {
			var lDataPdtAchat = [];
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lIdProduit = this.id;
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					lPdt.stoQuantite = "0".nombreFormate(2,',',' ');		
					lPdt.prix = "0".nombreFormate(2,',',' ');
					lDataPdtAchat.push(lPdt);
				}
			});
			var lDataAchat = {	achat:lDataPdtAchat,idAchat:"-1",total:"0".nombreFormate(2,',',' ')};
			lData.achats.push(lDataAchat);
		}

		var lNbAchatSolidaire = 0;
		$(pResponse.achats).each(function() {
			var lAchat = this;
			var lDataPdtAchat = [];
			var lAchatSolidaire = false;
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lAchatPdtSolidaire = false;
					var lProduit = this;
					var lIdProduit = this.id;
					
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					
					lPdt.prix = 0;
					lPdt.stoQuantite = 0;

					$(pResponse.stockSolidaire).each(function() {
						if(lPdt.id == this.proId){
							$.each(lProduit.lots, function() {
								if(this.id) {
									var lIdLot = this.id;
									$(lAchat.detailAchatSolidaire).each(function() {
										if(this.idDetailCommande == lIdLot) {
											lPdt.stoQuantite = this.quantite * -1;
											lPdt.prix = this.montant * -1;
											lNbAchatSolidaire++;
											lAchatSolidaire = true;
											lAchatPdtSolidaire = true;
										}
									});
								}
							});
						}
					});

					if(lAchatPdtSolidaire) {
						lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
						lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');							
						lDataPdtAchat.push(lPdt);
					}
				}
			});
			if(lAchatSolidaire) {
				var lDataAchat = {	achat:lDataPdtAchat,
									idAchat:this.id.idAchat,
									totalSolidaire:(this.totalSolidaire * -1).nombreFormate(2,',',' ')};
				lData.achatsSolidaire.push(lDataAchat);
			}
		});
		
		if(lNbAchatSolidaire == 0 && pResponse.stockSolidaire.length > 0 && pResponse.stockSolidaire[0].proId != null) {
			var lDataPdtAchat = [];
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lIdProduit = this.id;
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					lPdt.stoQuantite = "0".nombreFormate(2,',',' ');		
					lPdt.prix = "0".nombreFormate(2,',',' ');
					
					$(pResponse.stockSolidaire).each(function() {
						if(lPdt.id == this.proId){							
							lDataPdtAchat.push(lPdt);
						}
					});
				}
			});
			var lDataAchat = {	achat:lDataPdtAchat,idAchat:"-2",totalSolidaire:"0".nombreFormate(2,',',' ')};
			lData.achatsSolidaire.push(lDataAchat);
		}

		lData.typeEtatReservation = [];

		var lEtatReservation = {};
		lEtatReservation.value = "-1";
		lEtatReservation.label = "Aucune Réservation";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[-1] = lEtatReservation;
		
		var lEtatReservation = {};
		lEtatReservation.value = "0";
		lEtatReservation.label = "En réservation";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[0] = lEtatReservation;
		
		var lEtatReservation = {};
		lEtatReservation.value = "7";
		lEtatReservation.label = "Achetée";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[7] = lEtatReservation;
		
		var lEtatReservation = {};
		lEtatReservation.value = "15";
		lEtatReservation.label = "Non Récupérée";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[15] = lEtatReservation;
		
		var lEtatReservation = {};
		lEtatReservation.value = "16";
		lEtatReservation.label = "Supprimée";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[16] = lEtatReservation;
		
		switch(this.infoReservation.etat) {
			case "0":
				lData.etatReservation = "En réservation";
				lData.typeEtatReservation[0].selected = "selected=\"selected\"";
				break;
			case "7":
				lData.etatReservation = "Achetée";
				lData.typeEtatReservation[7].selected = "selected=\"selected\"";
				break;
			case "15":
				lData.etatReservation = "Non Récupérée";
				lData.typeEtatReservation[15].selected = "selected=\"selected\"";
				break;
			case "16":
				lData.etatReservation = "Supprimée";
				lData.typeEtatReservation[16].selected = "selected=\"selected\"";
				break;
			default:
				lData.etatReservation = "Aucune Réservation";
				lData.typeEtatReservation[-1].selected = "selected=\"selected\"";
				break;
		}

		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	}
	
	this.affect = function(pData) {
		pData = this.affectAnnulerDetailReservation(pData);
		pData = this.affectModifierReservation(pData);
		pData = this.affectValiderModifierReservation(pData);
		pData = this.affectModifierAchat(pData);
		pData = this.affectSupprimerAchat(pData);
		pData = this.mCommunVue.comHoverBtn(pData);		
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectAnnulerDetailReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {
			EditerCommandeVue({"id_commande":that.infoCommande.comId});		
		});
		return pData;
	}
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modif-resa').click(function() {
			that.modifierReservation();
		});
		return pData;
	}
	
	this.affectValiderModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-check-resa').click(function() {
			that.validerModifierReservation();
		});
		return pData;
	}
	
	this.affectSupprimerAchat = function(pData) {
		var that = this;
		pData.find('.achat, .achatSolidaire').each(function() {
			var lIdAchat = $(this).find(".achat-id").text();
			pData.find("#btn-supp-achat-" + lIdAchat).click(function() {
				that.supprimerAchat(lIdAchat);
			});
		});
		return pData;
	}
	
	this.affectModifierAchat = function(pData) {
		var that = this;
		pData.find('.achat, .achatSolidaire').each(function() {
			var lIdAchat = $(this).find(".achat-id").text();
			pData.find("#btn-modif-achat-" + lIdAchat).click(function() {
				that.modifierAchat(lIdAchat);
			});
			pData.find("#btn-check-achat-" + lIdAchat).click(function() {
				that.validerModifierAchat(lIdAchat);
			});
		});
		return pData;
	}
	
	this.modifierReservation = function() {
		$('.modif-resa, .resa-etat, .detail-resa-prix, .detail-resa-qte, .resa-total').toggle();	
	}
	
	this.validerModifierReservation = function() {
		var lReservation = {};
		lReservation.total = $("#reservation-total").val().numberFrToDb();
		lReservation.etat = $("#reservation-etat").val();
		lReservation.produits = [];
		var lProduit = [];
		$('.ligne-produit-reservation').each(function() {
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
				lReservation.produits.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0) {
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lReservation.produits.push(lVoProduit);
				}
			}
			lProduit.push(lVoProduit);
		});
		
		lReservation.id = this.infoReservation.id;
		
		var lValid = new ReservationAdherentValid();
		var lVr = lValid.validUpdate(lReservation);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			// TODO envoi vers le server
			
			
			$(lProduit).each(function() {
				if(isNaN(this.quantite) || this.quantite.isEmpty()) {this.quantite = 0;}
				$("#reservation-" + this.id + "-quantite").text((this.quantite * -1).nombreFormate(2,',',' '));
				if(isNaN(this.prix) || this.quantite.isEmpty()) {this.prix = 0;}
				$("#reservation-" + this.id + "-prix").text((this.prix * -1).nombreFormate(2,',',' '));
			});
			
			switch(lReservation.etat) {
				case "0":
					$("#reservation-etat-label").text("En réservation");
					break;
				case "7":
					$("#reservation-etat-label").text("Achetée");
					break;
				case "15":
					$("#reservation-etat-label").text("Non Récupérée");
					break;
				case "16":
					$("#reservation-etat-label").text("Supprimée");
					break;
				default:
					$("#reservation-etat-label").text("Aucune Réservation");
					break;
			}
	
			if(isNaN(lReservation.total) || lReservation.total.isEmpty()) {lReservation.total = 0;}
			$("#reservation-total-label").text(lReservation.total.nombreFormate(2,',',' '));
			
			
			$('.modif-resa, .resa-etat, .detail-resa-prix, .detail-resa-qte, .resa-total').toggle();
		} else {
			Infobulle.generer(lVr,'reservation-');
		}
	}
	
	this.modifierAchat = function(pIdAchat) {
		$('.modif-achat-' + pIdAchat + ', .detail-achat-' + pIdAchat + '-prix, .detail-achat-' + pIdAchat + '-qte, .achat-' + pIdAchat + '-total').toggle();	
	}
	
	this.validerModifierAchat = function(pIdAchat) {
		var that = this;
		var lAchat = {};
		lAchat.idAchat = pIdAchat;
		lAchat.total = $("#achat-" + pIdAchat + "-total").val().numberFrToDb() * -1;
		lAchat.produits = [];
		var lProduit = [];
		$('.ligne-produit-achat-' + pIdAchat).each(function() {
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
				lAchat.produits.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0) {
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lAchat.produits.push(lVoProduit);
				}
			}
			lProduit.push(lVoProduit);
		});
		
		if(parseInt(pIdAchat) < 0) { // Si c'est un achat
			lAchat.idCompte = that.mAdherent.adhIdCompte;
			lAchat.idMarche = that.pParam.id_commande;
		}
		
		var lValid = new AchatAdherentValid();
		var lVr = lValid.validUpdate(lAchat);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			var lParam ={fonction:"modifierAchat",achat:lAchat};
			$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse && lResponse.valid) {
							var lMsg = new TemplateVR();
							lMsg.valid = false;
							lMsg.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_314_CODE;
							erreur.message = ERR_314_MSG;
							lMsg.log.erreurs.push(erreur);
							
							if(lAchat.idAchat < 0) {
								that.pParam.vr = lMsg;
								that.construct(that.pParam);
							} else {
								$(lProduit).each(function() {
									if(isNaN(this.quantite) || this.quantite.isEmpty()) {this.quantite = 0;}
									$("#achat-" + pIdAchat + "-" + this.id + "-quantite").text((this.quantite * -1).nombreFormate(2,',',' '));
									if(isNaN(this.prix) || this.prix.isEmpty()) {this.prix = 0;}
									$("#achat-" + pIdAchat + "-" + this.id + "-prix").text((this.prix * -1).nombreFormate(2,',',' '));
								});
								if(isNaN(lAchat.total) || lAchat.total.isEmpty()) {lAchat.total = 0;}
								$("#achat-" + pIdAchat + "-total-label").text((lAchat.total * -1).nombreFormate(2,',',' '));
								
								$('.modif-achat-' + pIdAchat + ', .detail-achat-' + pIdAchat + '-prix, .detail-achat-' + pIdAchat + '-qte, .achat-' + pIdAchat + '-total').toggle();						
								
								Infobulle.generer(lMsg,'');
							}
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
			},"json");
		} else {
			Infobulle.generer(lVr,'achat-' + pIdAchat + '-');
		}
	}
	
	this.supprimerAchat = function(pIdAchat) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogSupprimerAchat;
		
		$(lTemplate).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Supprimer': function() {
					var lDialog = this;
					var lParam ={fonction:"supprimerAchat",idAchat:pIdAchat};
					$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(lParam),
						function(lResponse) {
							Infobulle.init(); // Supprime les erreurs
							if(lResponse) {
								if(lResponse && lResponse.valid) {								
									var lMsg = new TemplateVR();
									lMsg.valid = false;
									lMsg.log.valid = false;
									var erreur = new VRerreur();
									erreur.code = ERR_315_CODE;
									erreur.message = ERR_315_MSG;
									lMsg.log.erreurs.push(erreur);
									
									that.pParam.vr = lMsg;
									
									that.construct(that.pParam);
									$(lDialog).dialog('close');
								} else {
									Infobulle.generer(lResponse,'');
								}
							}
					},"json");
			
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
		});
		
	}
	
	this.construct(pParam);
}