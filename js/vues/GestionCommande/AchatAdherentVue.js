;function AchatAdherentVue(pParam) {
	this.pParam = {};
	this.mAdherent = null;
	//this.reservation = [];
	this.infoReservation = {};
	this.mAchat = {detailAchat:[], detailAchatSolidaire:[]};
	this.produit = [];

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
	
						/*	that.infoCommande.comId = lResponse.marche.id;
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
							that.pdtCommande = lResponse.marche.produits;*/
							
							that.infoReservation = lResponse.reservation;
						/*	that.stockSolidaire = lResponse.stockSolidaire;
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
							});*/
							
							that.produit = lResponse.detailProduit;
							$(lResponse.achats).each(function() {
								if(this.detailAchat.length > 0) {
									that.mAchat.idAchat = this.id.idAchat;
									that.mAchat.detailAchat = this.detailAchat;
								}
								if(this.detailAchatSolidaire.length > 0) {
									that.mAchat.idAchatSolidaire = this.id.idAchat;
									that.mAchat.detailAchatSolidaire = this.detailAchatSolidaire;
								}
								if(this.dateAchat) {
									that.mAchat.dateAchat = this.dateAchat;
								}
							});
					
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
		var lTemplate = lGestionCommandeTemplate.detailAchatEtReservationEnteteInvite;
		
		var lDataEntete = {};
		lDataEntete.detailAchat = lGestionCommandeTemplate.detailAchatVide;
		if(this.mAdherent.adhId && this.mAdherent.adhId != null) {
			lDataEntete.adhId = this.mAdherent.adhId;
			lDataEntete.adhNumero = this.mAdherent.adhNumero;
			lDataEntete.adhCompte = this.mAdherent.cptLabel;
			lDataEntete.adhNom = this.mAdherent.adhNom;
			lDataEntete.adhPrenom = this.mAdherent.adhPrenom;
			lDataEntete.adhSolde = this.mAdherent.cptSolde.nombreFormate(2,',',' ');
			
			lTemplate = lGestionCommandeTemplate.detailAchatEtReservationEntete;
		}
		lDataEntete.sigleMonetaire = gSigleMonetaire;
		
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;		
		
		// Si il y a au moins un produit à afficher
		if(that.produit[0] && that.produit[0].proId != null) {
			if(this.infoReservation) {
				lData.totalReservation = (this.infoReservation.total * -1).nombreFormate(2,',',' ');
			}
			lData.reservation = [];
			
			lData.categories = [];
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			lData.totalSolidaire = 0;
		
			$.each(that.produit, function() {
				var lProduit = this ;
				$(that.mAchat).each(function() {
					var lAchat = {
					unite: lProduit.proUniteMesure,
					proId: lProduit.proId,
					nproNom : lProduit.nproNom ,
					stoQuantiteReservation : "", proUniteMesureReservation : "",
					stoQuantite : "", prix : "", proUniteMesure : "", sigleMonetaire : "",
					stoQuantiteSolidaire : "", prixSolidaire : "", proUniteMesureSolidaire : "", sigleMonetaireSolidaire : ""};
					
					if(that.infoReservation) {
						$(that.infoReservation.detailReservation).each(function() {
							if(this.idProduit == lProduit.proId) {
								lAchat.stoQuantiteReservation = (this.quantite * -1).nombreFormate(2,',',' ');
								lAchat.proUniteMesureReservation = lProduit.proUniteMesure;
							}					
						});
					}
					
					$(this.detailAchat).each(function() {	
						if(this.idProduit == lProduit.proId) {
							lAchat.stoQuantite = (this.quantite * -1).nombreFormate(2,',',' ');
							lAchat.prix = (this.montant * -1).nombreFormate(2,',',' ');
							lAchat.proUniteMesure = lProduit.proUniteMesure;
							lAchat.sigleMonetaire = gSigleMonetaire;
							
							lData.total += this.montant * -1;					
						}					
					});		
					
					$(this.detailAchatSolidaire).each(function() {	
						if(this.idProduit == lProduit.proId) {
							lAchat.stoQuantiteSolidaire = (this.quantite * -1).nombreFormate(2,',',' ');
							lAchat.prixSolidaire = (this.montant * -1).nombreFormate(2,',',' ');
							lAchat.proUniteMesureSolidaire = lProduit.proUniteMesure;
							lAchat.sigleMonetaireSolidaire = gSigleMonetaire;
							
							lData.totalSolidaire += this.montant * -1;
						}					
					});	
					
					if(!lData.categories[lProduit.cproNom]) {
						lData.categories[lProduit.cproNom] = {nom:lProduit.cproNom,achat:[]};
					}
					lData.categories[lProduit.cproNom].achat.push(lAchat);
					
					if(this.idAchat) {
						lData.boutonSupprimerAchat = lGestionCommandeTemplate.boutonSupprimerAchat.template({idAchat:this.idAchat});		
						lData.idAchat = this.idAchat;					
					} else {
						lData.idAchat = -1;
					}
					
					if(this.idAchatSolidaire) {
						lData.boutonSupprimerAchatSolidaire = lGestionCommandeTemplate.boutonSupprimerAchatSolidaire.template({idAchat:this.idAchatSolidaire});
						lData.idAchatSolidaire = this.idAchatSolidaire;						
					} else {
						lData.idAchatSolidaire = -2;
					}
				});
			});
		
			// N'affiche la date d'achat qu si il y a eu un achat
			if(that.mAchat.dateAchat) {
				lData.dateAchat = lGestionCommandeTemplate.dateAchat.template({dateAchat:that.mAchat.dateAchat.extractDbDate().dateDbToFr()});
			}
			
			lData.totalMarche = lData.total + lData.totalSolidaire;
			
			lData.total = lData.total.nombreFormate(2,',',' ');
			lData.totalSolidaire = lData.totalSolidaire.nombreFormate(2,',',' ');
			lData.totalMarche = lData.totalMarche.nombreFormate(2,',',' ');
			
			lDataEntete.detailAchat = lGestionCommandeTemplate.detailAchatEtReservation.template(lData);
		}
		
		var lHtml = $(lTemplate.template(lDataEntete));
		if(that.pParam.id_adherent == -3) {
			lHtml.find('.col-reservation').remove();
			if(lData.idAchat > 0) {
				lHtml.find('.col-achat-solidaire').remove();
			} else {
				lHtml.find('.col-achat').remove();
			}
		}

		$('#contenu').replaceWith(that.affect($(lHtml)));	
	};
	
	/*this.affectDroitArchive = function(pData) {
		pData.find(".com-btn-header-multiples").remove();
		return pData;
	};*/
	
	this.affect = function(pData) {
		pData = this.affectRetour(pData);
		pData = this.affectAjoutProduit(pData);
		pData = this.affectModifierAchat(pData);
		pData = this.affectSupprimerAchat(pData);
		pData = gCommunVue.comHoverBtn(pData);		
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectRetour = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {
			ListeAchatMarcheVue({"id_marche":that.pParam.id_marche});		
		});
		return pData;
	};
	
	this.affectAjoutProduit = function(pData) {
		var that = this;
		pData.find('#btn-nv-produit').click(function() {
			that.dialogAjoutProduit();
		});
		return pData;
	};
	
	this.dialogAjoutProduit = function(pData) {
		var that = this;
		var lParam = {fonction:"listeFerme"};
		$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.dialogAjoutAchatProduit;
							
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
			Infobulle.init(); // Supprime les erreurs
			var lId = $(this).val();
			$("#pro-idCategorie select, #pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#detail-produit").replaceWith("<div id=\"detail-produit\"></div>");
			if(lId > 0) {
				var lParam = {fonction:"listeProduit",id:lId};
				$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(lParam),
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
									$("#detail-achat").replaceWith($("<div id=\"detail-achat\">"));
								}
							} else {
								Infobulle.generer(lResponse,'');
								$("#detail-achat").replaceWith($("<div id=\"detail-achat\">"));
							}
						}
					},"json"
				);
			} else {
				$("#detail-achat").replaceWith($("<div id=\"detail-achat\">"));
			}	 
						
		});
		return pData;
	};
	
	this.affectAjoutProduitSelectCategorie = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			Infobulle.init(); // Supprime les erreurs
			var lId = $(this).val();
			$("#pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#detail-produit").replaceWith("<div id=\"detail-produit\"></div>");
			if(lId > 0) {
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.ajoutProduitSelectProduit;
				
				$("#pro-idProduit").replaceWith(that.affectAjoutProduitSelectProduit($(lTemplate.template(that.mProduits[lId]))));
			} else {
				$("#detail-achat").replaceWith($("<div id=\"detail-achat\">"));
			}			
		});
		return pData;
	};
	
	this.affectAjoutProduitSelectProduit = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			var lId = $(this).val();
			Infobulle.init(); // Supprime les erreurs
			if(lId > 0) {
				// Filtre si le produit n'est pas déjà dans l'achat
				var lAfficheProduit = true;
				$(that.produit).each(function() {
					if(this.nproId == lId) {
						lAfficheProduit = false;
					}
				});
				if(lAfficheProduit) {
					var lParam = {fonction:"listeUnite",id:lId};
					$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(lParam),
						function (lResponse) {		
							if(lResponse) {
								if(lResponse.valid) {
									Infobulle.init(); // Supprime les erreurs
									
									var lGestionCommandeTemplate = new GestionCommandeTemplate();
									var lTemplate = lGestionCommandeTemplate.detailProduitAjoutAchatProduit;
									var lData = {unite: lResponse.unite[0].mLotUnite, sigleMonetaire: gSigleMonetaire, idProduit: lId};
																	
									$("#detail-achat").replaceWith(that.affectDetailProduit($(lTemplate.template(lData))));
									
								} else {
									Infobulle.generer(lResponse,'');
								}
							}
						},"json"
					);
				} else {
					// Message d'information
					var lVr = new TemplateVR();
					lVr.valid = false;
					lVr.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_262_CODE;
					erreur.message = ERR_262_MSG;
					lVr.log.erreurs.push(erreur);
					Infobulle.generer(lVr,'');
					$("#detail-achat").replaceWith($("<div id=\"detail-achat\">"));
				}
			} else {
				$("#detail-achat").replaceWith($("<div id=\"detail-achat\">"));
			}			
		});
		return pData;
	};
	
	this.affectDetailProduit = function(pData) {		
		if(this.pParam.id_adherent == -3) {
			pData = this.affectAjoutProduitCompteInvite(pData);
		}
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;		
	};
	
	this.affectAjoutProduitCompteInvite = function(pData) {
		pData.find('#choixTypeAchat').remove();
		return pData;
	};
	
	this.ajouterProduit = function(pDialog) {
		if(pDialog.find('#pro-id').length == 1) {
			var that = this;
			
			var lVo = new ProduitAjoutAchatVO();
			
			lVo.idMarche = this.pParam.id_marche;
			lVo.idNomProduit = pDialog.find('#pro-id').val();
			lVo.prix = pDialog.find('#pro-prix').val().numberFrToDb() * -1;
			lVo.quantite = pDialog.find('#pro-quantite').val().numberFrToDb() * -1;
			
			// Pour le compte invité sélection du type d'achat
			if(this.pParam.id_adherent == -3) {
				lVo.idCompte = -3;
				lVo.idOperation = this.pParam.idOperation;
				if(that.mAchat.idAchat) {
					lVo.solidaire = 0;
				} else {
					lVo.solidaire = 1;
				}
			} else {
				lVo.idCompte = this.mAdherent.adhIdCompte;
				lVo.solidaire = pDialog.find(':input[name=typeProduit]:checked').val();
			}
			
			var lValid = new ProduitAjoutAchatValid();
			var lVr = lValid.validAjout(lVo);
			
			Infobulle.init(); // Supprime les erreurs
			if(lVr.valid) {
				lVo.fonction = "ajoutProduitAchat";
				$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(lVo),
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
								
								pDialog.dialog('close');
								that.rechargerPage();
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
				},"json");
			} else {
				Infobulle.generer(lVr,'pro-');
			}
		}
	};
	
	this.rechargerPage = function() {
		this.mAdherent = null;
		this.infoReservation = {};
		this.mAchat = {detailAchat:[], detailAchatSolidaire:[]};
		this.produit = [];
		this.construct(this.pParam);
	};
	
	this.affectModifierAchat = function(pData) {
		var that = this;
		
		pData.find('#btn-modif-achat, #btn-annuler-achat').click(function() {
			$('.btn-achat, .detail-achat-qte, .detail-achat-prix, #btn-modif-achat-solidaire, #btn-supp-achat-solidaire').toggle();			
		});
		pData.find('#btn-modif-achat-solidaire, #btn-annuler-achat-solidaire').click(function() {
			$('.btn-achat-solidaire, .detail-achat-qte-solidaire, .detail-achat-prix-solidaire, #btn-modif-achat, #btn-supp-achat').toggle();			
		});
		pData.find("#btn-check-achat, #btn-check-achat-solidaire").click(function() {
			that.validerModifierAchat($(this).data("id-achat"), $(this).data("type"));
		});
		return pData;
	};
	
	this.affectSupprimerAchat = function(pData) {
		var that = this;
		pData.find('#btn-supp-achat, #btn-supp-achat-solidaire').click(function() {
			that.supprimerAchat($(this).data("id-achat"));
		});
		return pData;
	};
	
	this.validerModifierAchat = function(pIdAchat, pType) {
		var that = this;
		
		if(pType != '') {pType = '-' + pType;}
		
		var lAchat = {};
		lAchat.idAchat = pIdAchat;
		//lAchat.total = $("#achat-total" + pType).val().numberFrToDb() * -1;
		lAchat.produits = [];
		var lProduit = [];
		$('.ligne-produit-achat').each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).data("id-produit");			
			var lQuantite = $(this).find(".produit-quantite" + pType).val().numberFrToDb();
			
			// Si il y a une quantité vérificaiton du prix
			if(!isNaN(lQuantite) && !lQuantite.isEmpty() && lQuantite != 0){
				lQuantite = parseFloat(lQuantite);
				lVoProduit.quantite = lQuantite * -1;			
			
				var lprix = $(this).find(".produit-prix" + pType).val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0){
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
				}
				lAchat.produits.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-prix" + pType).val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0) {
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lAchat.produits.push(lVoProduit);
				}
			}
			lProduit.push(lVoProduit);
		});
		
		if(parseInt(pIdAchat) < 0) { // Si c'est ajout un achat
			lAchat.idCompte = that.mAdherent.adhIdCompte;
			lAchat.idMarche = that.pParam.id_marche;
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

							that.pParam.vr = lMsg;
							that.rechargerPage(that.pParam);
							
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
			},"json");
		} else {
			Infobulle.generer(lVr,'achat-' + pIdAchat + '-');
		}
	};	
	
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
									//Si compte invité retour à la liste des achats
									if(that.pParam.id_adherent == -3) {
										ListeAchatMarcheVue({"id_marche":that.pParam.id_marche});
									} else {
										that.rechargerPage(that.pParam);
									}
									
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
		
	};
/*	this.affectValiderModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-check-resa').click(function() {
			that.validerModifierReservation();
		});
		return pData;
	};
	
	this.affectSupprimerAchat = function(pData) {
		var that = this;
		pData.find('.achat, .achatSolidaire').each(function() {
			var lIdAchat = $(this).find(".achat-id").text();
			pData.find("#btn-supp-achat-" + lIdAchat).click(function() {
				that.supprimerAchat(lIdAchat);
			});
		});
		return pData;
	};
	
	this.affectModifierAchat = function(pData) {
		var that = this;
		pData.find('.achat, .achatSolidaire').each(function() {
			var lIdAchat = $(this).find(".achat-id").text();
			pData.find("#btn-annuler-achat-" + lIdAchat + ", #btn-modif-achat-" + lIdAchat).click(function() {
				that.modifierAchat(lIdAchat);
			});
			pData.find("#btn-check-achat-" + lIdAchat).click(function() {
				that.validerModifierAchat(lIdAchat);
			});
		});
		return pData;
	};
		
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
	};

	this.modifierAchat = function(pIdAchat) {
		$('.modif-achat-' + pIdAchat + ', .detail-achat-' + pIdAchat + '-prix, .detail-achat-' + pIdAchat + '-qte, .achat-' + pIdAchat + '-total').toggle();	
	};
	
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
			lAchat.idMarche = that.pParam.id_marche;
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
	};
	
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
		
	};*/
	
	this.construct(pParam);
}