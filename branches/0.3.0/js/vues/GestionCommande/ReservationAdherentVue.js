;function ReservationAdherentVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mAdherent = null;
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = new Array();
	this.reservationModif = new Array();
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = "afficherReservation";
		$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mAdherent = lResponse.adherent;						

						that.infoCommande.comId = lResponse.commande[0].comId;
						that.infoCommande.comNumero = lResponse.commande[0].comNumero;
						that.infoCommande.comNom = lResponse.commande[0].comNom;
						that.infoCommande.comDescription = lResponse.commande[0].comDescription;
						that.infoCommande.dateTimeFinReservation = lResponse.commande[0].comDateFinReservation;
						that.infoCommande.dateFinReservation = lResponse.commande[0].comDateFinReservation.extractDbDate().dateDbToFr();
						that.infoCommande.heureFinReservation = lResponse.commande[0].comDateFinReservation.extractDbHeure();
						that.infoCommande.minuteFinReservation = lResponse.commande[0].comDateFinReservation.extractDbMinute();
						that.infoCommande.dateMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbDate().dateDbToFr();
						that.infoCommande.heureMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbHeure();
						that.infoCommande.minuteMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbMinute();
						that.infoCommande.heureMarcheFin = lResponse.commande[0].comDateMarcheFin.extractDbHeure();
						that.infoCommande.minuteMarcheFin = lResponse.commande[0].comDateMarcheFin.extractDbMinute();
						that.infoCommande.comArchive = lResponse.commande[0].comArchive;
							
						$(lResponse.commande).each(function() {
							var lLot = new Object();
							
							lLot.dcomId = this.dcomId;
							lLot.dcomIdProduit = this.dcomIdProduit;
							lLot.dcomTaille = this.dcomTaille;
							lLot.dcomPrix = this.dcomPrix;
							
							if(that.pdtCommande[this.proId]) {
								that.pdtCommande[this.proId].lot[lLot.dcomId] = lLot;
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
								
								lproduit.lot = new Array();
								lproduit.lot[lLot.dcomId] = lLot;								
								that.pdtCommande[lproduit.proId] = lproduit;
							}
						});
						
						$(lResponse.reservation).each(function() {
							this.stoQuantite = this.stoQuantite * -1;
							that.reservation[this.proId] = this;
						});						
						that.afficher();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function() {		
		this.afficherDetailReservation();		
	}
	
	this.afficherDetailReservation = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.detailReservation;
		
		var lData = {};		
		lData.adhId = this.mAdherent.adhId;
		lData.adhNumero = this.mAdherent.adhNumero;
		lData.adhCompte = this.mAdherent.cptLabel;
		lData.adhNom = this.mAdherent.adhNom;
		lData.adhPrenom = this.mAdherent.adhPrenom;
		lData.adhSolde = this.mAdherent.opeMontant.nombreFormate(2,',',' ');
		
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
		lData.reservation = new Array();
		var lTotal = 0;
		$(this.pdtCommande).each(function() {
			if(that.reservation[this.proId]) {
				var lPdt = new Object;
				lPdt.nproNom = this.nproNom;
				lPdt.stoQuantite = parseFloat(that.reservation[this.proId].stoQuantite);
				lPdt.proUniteMesure = this.proUniteMesure;
				lPdt.prix = 0;
				var lDcomId = that.reservation[this.proId].dcomId;
				
				$(this.lot).each(function() {
					if(this.dcomId == lDcomId) {
						lPdt.prix = (lPdt.stoQuantite / this.dcomTaille) * this.dcomPrix;
					}
				});
				lTotal += lPdt.prix;
				
				lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
				lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
				
				lData.reservation.push(lPdt);
			}			
		});
		lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	}
	
	this.afficherModifier = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.modifierReservation;
		var lData = {};
		lData.adhId = this.mAdherent.adhId;
		lData.adhNumero = this.mAdherent.adhNumero;
		lData.adhCompte = this.mAdherent.cptLabel;
		lData.adhNom = this.mAdherent.adhNom;
		lData.adhPrenom = this.mAdherent.adhPrenom;
		lData.adhSolde = this.mAdherent.opeMontant.nombreFormate(2,',',' ');
		lData.adhNouveauSolde = 0;
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
		lData.produit = new Array();
				
		var lTotal = 0;		
		$(this.pdtCommande).each(function() {
			// Test si la ligne n'est pas vide
			if(this.proId) {
				var lPdt = {};
				lPdt.proId = this.proId;
				lPdt.nproNom = this.nproNom;
				lPdt.proMaxProduitCommande = parseFloat(this.proMaxProduitCommande).nombreFormate(2,',',' ');
				lPdt.proUniteMesure = this.proUniteMesure;
				
				lPdt.lot = new Array();
				
				var i = 0;
				var lLotReservation = -1;
				var lLotInit = -1;
				
				
				$(this.lot).each(function() {
					if(this.dcomId) {
						var lLot = {};
						lLot.dcomId = this.dcomId;
						lLot.dcomTaille = parseFloat(this.dcomTaille).nombreFormate(2,',',' ');
						lLot.dcomPrix = parseFloat(this.dcomPrix).nombreFormate(2,',',' ');
						lLot.prixReservation = parseFloat(this.dcomPrix);
						lLot.stoQuantiteReservation = parseFloat(this.dcomTaille);
						
						if(that.reservation[lPdt.proId] && (that.reservation[lPdt.proId].dcomId == this.dcomId)) {
								lLot.stoQuantiteReservation = parseFloat(that.reservation[lPdt.proId].stoQuantite);
								lLot.prixReservation = (lLot.stoQuantiteReservation / this.dcomTaille) * this.dcomPrix;
								lTotal += lLot.prixReservation;
								
								// Permet de cocher le lot correspondant à la résa
								lLotReservation = this.dcomId;
								lLot.checked = 'checked="checked"';
						}
												
						lLot.stoQuantiteReservation = lLot.stoQuantiteReservation.nombreFormate(2,',',' ');
						lLot.prixReservation = lLot.prixReservation.nombreFormate(2,',',' ');
						
						lPdt.lot.push(lLot);			
					}
				});
				
				lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
				
				// Si il y a une réservation pour ce produit on le coche
				if(lLotReservation != -1) {
					lPdt.checked = 'checked="checked"';
				} else {
					// Sinon on coche par défaut le premier lot
					if(lPdt.lot[0]) {
						lPdt.lot[0].checked = 'checked="checked"';
					}
				}
				
				lData.produit.push(lPdt);			
			}
		});
		
		// Maj des reservations temp pour modif
		this.reservationModif = new Array();
		$(this.reservation).each(function() {
			if(this.proId) {
				//var lR = {comId:this.comId,proId:this.proId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};				
				that.reservationModif[this.proId] = {comId:this.comId,proId:this.proId,dcomId:this.dcomId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};
			}
		});
		
		$('#contenu').replaceWith(that.affectModifier($(lTemplate.template(lData))));
	}
	
	this.affect = function(pData) {
		pData = this.affectModifierReservation(pData);
		pData = this.affectAnnulerDetailReservation(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectSupprimerReservation(pData);		
		return pData;
	}
		
	this.affectModifier = function(pData) {
		pData = this.affectBtnQte(pData);
		pData = this.affectChangementLot(pData);
		pData = this.affectChangementProduit(pData);
		pData = this.preparerAffichageModifier(pData);
		pData = this.affectValiderReservation(pData);
		pData = this.affectAnnulerReservation(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectBtnQte = function(pData) {
		var that = this;
		pData.find('.btn-plus').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),1);
		});	
		pData.find('.btn-moins').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),-1);
		});
		return pData;		
	}
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.lot').click(function() {
			$(this).find(':radio').attr("checked","checked");
			that.changerLot($(this).find(".pdt-id").text(),$(this).find(".lot-id").text());
		});
		return pData;
	}
	
	this.affectChangementProduit = function(pData) {
		var that = this;
		pData.find('.pdt :checkbox').click(function() {
			that.changerProduit($(this).parent().parent().find(".pdt-id").text());			
		});
		return pData;
	}
	
	this.affectValiderReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.validerReservation();			
		});
		return pData;	
	}
	
	this.affectAnnulerReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {			
			that.afficherDetailReservation();		
		});
		return pData;
	}
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.afficherModifier();		
		});
		return pData;
	}
	
	this.affectAnnulerDetailReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {
			EditerCommandeVue({"id_commande":that.infoCommande.comId});		
		});
		return pData;
	}
		
	this.nouvelleQuantite = function(pIdPdt,pIdLot,pIncrement) {
		var lMax = this.pdtCommande[pIdPdt].proMaxProduitCommande;
		var lTaille = this.pdtCommande[pIdPdt].lot[pIdLot].dcomTaille;
		var lPrix = this.pdtCommande[pIdPdt].lot[pIdLot].dcomPrix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservationModif[pIdPdt] && (this.reservationModif[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = this.reservationModif[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;
		
		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNvQteReservation > 0 && lNvQteReservation <= lMax) {
			var lNvPrix = 0;
			lNvPrix = lQteReservation * lPrix;
			
			// Mise à jour de la quantite reservée
			this.reservationModif[pIdPdt].stoQuantite = lNvQteReservation;			
			
			$('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

			this.majTotal();
		}		
	}	
	
	this.changerLot = function(pIdPdt,pIdLot) {		
		// Masque tout les lots
		$('.btn-pdt-' + pIdPdt).attr("disabled","disabled").addClass("ui-helper-hidden");
		$('.colonne-pdt-' + pIdPdt).addClass("ui-helper-hidden");
				
		// Affiche uniquement le lot sélectionné
		$('#btn-moins-lot-' + pIdLot + ',#btn-plus-lot-' + pIdLot).removeAttr("disabled").removeClass("ui-helper-hidden");
		$('#colonne-qte-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-prix-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-sigle-pdt-' + pIdPdt + '-lot-' + pIdLot).removeClass("ui-helper-hidden");
	
		// Mise à jour de la quantite reservée
		this.reservationModif[pIdPdt].stoQuantite = $('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text().numberFrToDb();
		this.reservationModif[pIdPdt].dcomId = pIdLot;
		
		this.majTotal();
	}
	
	this.changerProduit = function(pIdPdt) {
		var that = this;
		if($('#pdt-' + pIdPdt).find(':checkbox').attr("checked")) {
			$('.lot-pdt-' + pIdPdt).show();
			
			// Mise à jour de la quantite reservée
			$('[name=lot-produit-' + pIdPdt + ']').each(function() {
				//alert(this.attr('checked'));
				if($(this).attr('checked')) {
					var lQte = $('#qte-pdt-' + pIdPdt + '-lot-' + $(this).parent().parent().find(".lot-id").text()).text().numberFrToDb();
					if(that.reservationModif[pIdPdt]) {
						that.reservationModif[pIdPdt].stoQuantite = lQte;
					} else {
						var lResa = {};
						lResa.comId = that.infoCommande.comId;
						//lResa.proId = pIdPdt;
						lResa.dcomId = lIdLot;
						lResa.stoQuantite = lQte;						
						that.reservationModif[pIdPdt] = lResa;
					}
				}
			});
		} else {			
			$('.lot-pdt-' + pIdPdt).hide();
			
			// Mise à jour de la quantite reservée
			if(this.reservationModif[pIdPdt]) {
				this.reservationModif[pIdPdt] = null;
			}
		}
		
		this.majTotal();
	}
	
	this.majTotal = function() {
		$('#total').text(this.calculTotal().nombreFormate(2,',',' '));
		this.majNouveauSolde();
	}
	
	this.majNouveauSolde = function() {
		var lNvSolde = this.mAdherent.opeMontant - this.calculTotal();
		if(lNvSolde <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lNvSolde.nombreFormate(2,',',' '));
	}
	
	this.affectNouveauSolde = function(pData) {
		var lNvSolde = this.mAdherent.opeMontant - this.calculTotal();
		if(lNvSolde <= 0) {
			pData.find("#nouveau-solde").addClass("com-nombre-negatif");
			pData.find("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			pData.find("#nouveau-solde").removeClass("com-nombre-negatif");
			pData.find("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		pData.find("#nouveau-solde").text(lNvSolde.nombreFormate(2,',',' '));
		return pData;		
	}
	
	this.calculTotal = function() {
		var that = this;
		var lTotal = 0;
		$(this.reservationModif).each(function() {
			var lResa = this;
			if(lResa.stoQuantite) {
				if(that.pdtCommande[lResa.proId]) {
					$(that.pdtCommande[lResa.proId].lot).each(function() {
						if(lResa.dcomId == this.dcomId) {
							lTotal += (lResa.stoQuantite / this.dcomTaille) * this.dcomPrix;
						}
					});					
				}				
			}
		});
		return lTotal;
	}
	
	this.preparerAffichageModifier = function(pData) {
		var that = this;
		// Cache les lots
		pData.find(':checkbox:not(:checked)').each(function() {			
			pData.find('.lot-pdt-' + $(this).parent().parent().find('.pdt-id').text()).hide();
		});
		//Cache les autres lots
		pData.find(':radio:not(:checked)').each(function() {
			var lIdLot = $(this).parent().parent().find('.lot-id').text();
			var lIdPdt = $(this).parent().parent().find('.pdt-id').text();
			
			pData.find('#btn-moins-lot-' + lIdLot + ',#btn-plus-lot-' + lIdLot).attr("disabled","disabled").addClass("ui-helper-hidden");
			pData.find('#colonne-qte-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-prix-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-sigle-pdt-' + lIdPdt + '-lot-' + lIdLot).addClass("ui-helper-hidden");
		});
		return pData;
	}
	
	this.validerReservation = function() {
		var that = this;
		Infobulle.init(); // Supprime les erreurs
		
		var lVo = new ListeReservationCommandeVO();
		var lNbPdt = 0;
		$(this.reservationModif).each(function() {
			if(this.stoQuantite) {
				var lVoResa = new ReservationCommandeVO();
				lVoResa.id = '';
				lVoResa.stoQuantite = this.stoQuantite * -1;
				lVoResa.stoIdDetailCommande = this.dcomId;
				lVo.commandes.push(lVoResa);
				lNbPdt++;
			}
		});
		
		if(lNbPdt > 0){
			var lValid = new ListeReservationCommandeValid();
			var lVR = lValid.validAjout(lVo);
			if(!lVR.valid){
				Infobulle.generer(lVR,'');
			} else {
				// Maj de la reservation
				lParam = {"reservation":lVo,"id_compte":this.mAdherent.adhIdCompte,fonction:"modifierReservation"};
				$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {							
							// Maj des reservations pour le recap
							that.reservation = new Array();
							$(that.reservationModif).each(function() {
								if(this.proId) {									
									that.reservation[this.proId] = {comId:this.comId,proId:this.proId,dcomId:this.dcomId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};
								}
							});
							that.afficher();
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
				);	
			}			
		} else {
			var lVR = new TemplateVR();
			lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_207_CODE;erreur.message = ERR_207_MSG;lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,'');
		}		
	}
	
	this.affectSupprimerReservation = function(pData) {
		var that = this;
		pData.find('#btn-supprimer').click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.supprimerReservationDialog;
			$(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {	id_commande:that.infoCommande.comId,
										id_adherent:that.mAdherent.adhId,
										fonction:"supprimerReservation"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										
										var lVr = new TemplateVR();
										lVr.valid = false;
										lVr.log.valid = false;
										var erreur = new VRerreur();
										erreur.code = ERR_303_CODE;
										erreur.message = ERR_303_MSG;
										lVr.log.erreurs.push(erreur);							

										// Redirection vers la vue edition
										EditerCommandeVue({id_commande:that.infoCommande.comId,
															vr:lVr});
										
										$(lDialog).dialog("close");
										
									} else {
										Infobulle.generer(lResponse,'');
									}
								},"json"
						);
					},
					'Annuler': function() { $(this).dialog("close"); }
					},
				close: function(ev, ui) { $(this).remove(); }
			})
		});
		return pData;
	}
	
	this.construct(pParam);
}