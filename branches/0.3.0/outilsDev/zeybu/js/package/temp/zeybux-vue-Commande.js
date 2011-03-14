function ListeCommandeVue() {
	this.construct = function() {
		var that = this;
		$.post(	"./index.php?m=Commande&v=ListeCommande", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficher(lResponse);
						// Maj du Menu
						var lCommunVue = new CommunVue();
						lCommunVue.majMenu('Commande','ListeCommande');
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		Infobulle.init(); // Supprime les erreurs
		// Test si la liste est vide
		if(lResponse.listeCommande[0] && lResponse.listeCommande[0].comDateFinReservation != null) {
			var that = this;
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = new Object();
					lCommande.id = this.comId;
					lCommande.numero = this.comNumero;
					lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
					
					//lCommande.lienEdit = '"' + this.comId + '"';
					//lCommande.lienMarche = '"' + this.comId + '"';
	
					lListeCommande.commande.push(lCommande);
				});
			
			var lCommandeTemplate = new CommandeTemplate();
			var lTemplate = lCommandeTemplate.listeCommandePage;
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeCommande))));	
		} else {
			var lCommandeTemplate = new CommandeTemplate();
			$('#contenu').replaceWith(lCommandeTemplate.listeCommandeVide);
		}
	}
	this.affect = function(pData) {
		pData = this.affectBtnCommander(pData);
		return pData;
	}
	this.affectBtnCommander = function(pData) {
		pData.find('.btn-commander').click(function() {
			ReservationCommandeVue($(this).attr('id'));
		});
		return pData;
	}
	
	/*this.affectLienMarche = function(pData) {
		pData.find('.liste-commande-lien-marche').click(function() {
			var lPage = new MarcheCommandeVue();
			lPage.construct($(this).attr('id'));
		});
		return pData;
	}*/
	
	this.construct();
}function ReservationCommandeVue(pParam) {
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = new Array();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=Commande&v=ReservationCommande","id_commande=" + pParam, 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
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
												
						that.afficher();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function() {		
		this.afficherReservation();		
	}
	
	this.afficherDetailCommande = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.detailReservation;
		
		var lData = new Object();
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
	
	this.afficherReservation = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.reservation;
		var lData = {};
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
				
		$('#contenu').replaceWith(that.affectModifier($(lTemplate.template(lData))));
	}
	
	this.affect = function(pData) {
		pData = this.affectDroitEdition(pData);
		pData = this.affectModifierReservation(pData);
		pData = this.affectValiderReservation(pData);
		return pData;
	}
	
	this.affectDroitEdition = function(pData) {
		// Si la date de fin des réservations est passée on bloque la possibilitée de modifier
		if(!dateTimeEstPLusGrandeEgale(this.infoCommande.dateTimeFinReservation,getDateTimeAujourdhuiDb(),'db')) {
			pData.find('.boutons-edition').hide();
		}
		return pData;
	}
	
	this.affectModifier = function(pData) {
		pData = this.affectBtnQte(pData);
		pData = this.affectChangementLot(pData);
		pData = this.affectChangementProduit(pData);
		pData = this.preparerAffichageModifier(pData);
		pData = this.affectDetailReservation(pData);
		//pData = this.affectValiderReservation(pData);
		//pData = this.affectAnnulerReservation(pData);
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
		
	/*this.affectAnnulerReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {			
			that.afficherDetailReservation();		
		});
		return pData;
	}*/
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.afficherReservation();		
		});
		return pData;
	}
	
	this.affectDetailReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.validerReservation();		
		});
		return pData;
	}

	this.affectValiderReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.enregistrerReservation();				
		});
		return pData;	
	}
		
	this.nouvelleQuantite = function(pIdPdt,pIdLot,pIncrement) {
		var lMax = this.pdtCommande[pIdPdt].proMaxProduitCommande;
		var lTaille = this.pdtCommande[pIdPdt].lot[pIdLot].dcomTaille;
		var lPrix = this.pdtCommande[pIdPdt].lot[pIdLot].dcomPrix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservation[pIdPdt] && (this.reservation[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = this.reservation[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;
		
		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNvQteReservation > 0 && lNvQteReservation <= lMax) {
			var lNvPrix = 0;
			lNvPrix = lQteReservation * lPrix;
			
			// Mise à jour de la quantite reservée
			this.reservation[pIdPdt].stoQuantite = lNvQteReservation;			
			
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
		this.reservation[pIdPdt].stoQuantite = $('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text().numberFrToDb();
		this.reservation[pIdPdt].dcomId = pIdLot;
		
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
					var lIdLot = $(this).parent().parent().find(".lot-id").text();
					var lQte = $('#qte-pdt-' + pIdPdt + '-lot-' + lIdLot).text().numberFrToDb();
					if(that.reservation[pIdPdt]) {
						that.reservation[pIdPdt].stoQuantite = lQte;
					} else {
						var lResa = {};
						lResa.comId = that.infoCommande.comId;
						lResa.proId = pIdPdt;
						lResa.dcomId = lIdLot;
						lResa.stoQuantite = lQte;						
						that.reservation[pIdPdt] = lResa;
					}
				}
			});
		} else {			
			$('.lot-pdt-' + pIdPdt).hide();
			
			// Mise à jour de la quantite reservée
			if(this.reservation[pIdPdt]) {
				this.reservation[pIdPdt] = null;
			}
		}
		
		this.majTotal();
	}
	
	this.majTotal = function() {		
		$('#total').text(this.calculTotal().nombreFormate(2,',',' '));
	}
	
	this.calculTotal = function() {
		var that = this;
		var lTotal = 0;
		$(this.reservation).each(function() {
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
		Infobulle.init(); // Supprime les erreurs
		var lVo = this.genererListeReservation();	
		var lVr = this.verifierReservation(lVo);
		if(lVr.valid) {
			this.afficherDetailCommande();
		} else {
			Infobulle.generer(lVr,'');			
		}
	}
	
	this.enregistrerReservation = function() {
		Infobulle.init(); // Supprime les erreurs
		var that = this;
		var lVo = this.genererListeReservation();	
		var lVr = this.verifierReservation(lVo);
		if(lVr.valid) {
			// Réalisation de l'enregistrement
			$.post(	"./index.php?m=Commande&v=ReservationCommande", "reservation=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {					
						that.afficherRetour();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');			
		}		
	}	
	
	this.genererListeReservation = function() {
		var lVo = new ListeReservationCommandeVO();
		$(this.reservation).each(function() {
			if(this.stoQuantite) {
				var lVoResa = new ReservationCommandeVO();
				lVoResa.id = '';
				lVoResa.stoQuantite = this.stoQuantite * -1;
				lVoResa.stoIdDetailCommande = this.dcomId;
				lVo.commandes.push(lVoResa);
			}
		});	
		return lVo;
	}
		
	this.verifierReservation = function(pVo) {
		if($(pVo.commandes).length > 0) {
			var lValid = new ListeReservationCommandeValid();
			var lVR = lValid.validAjout(pVo);
		} else {
			var lVR = new TemplateVR();
			lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_207_CODE;erreur.message = ERR_207_MSG;lVR.log.erreurs.push(erreur);
		}
		return lVR;
	}
	
	this.afficherRetour = function() {		
		var lCommandeTemplate = new CommandeTemplate();
		$('#contenu').replaceWith(lCommandeTemplate.reservationOk);	
	}	
	
	this.construct(pParam);
	/*this.totalCommande = function() {
		var total = 0;
		$(":radio:checked").each(
				function() {
					var idproduit = "checkbox_" + $(this).attr("name").substr(6);			
					
					if($("input[name=" + idproduit + "]").attr("checked")) {
						var prixProduit = parseFloat($(this).attr("value")) * parseInt($(this).parent().next().next().next().children().first().html());
						$(this).parent().next().next().next().next().next().children().first().html(prixProduit.nombreFormate(2,',',' '));
						total += prixProduit;
					}
				});
		
		if(total == 0)
			$("#button-submit-reservation-commande").attr("disabled","disabled");
		else
			$("#button-submit-reservation-commande").removeAttr("disabled");
		
		$("#total_commande").html(total.nombreFormate(2,',',' '));		
	}
	
	this.radioCommandeClick = function(obj, idproduit) {
		$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
		$(obj).parent().next().next().next().children(":input").each(
			function () { $(this).removeAttr("disabled") });
	}
	
	this.changerQte = function(obj,qte) {
		var qteActuelle = parseInt($(obj).html());
		var qteMax = parseFloat($("#qte_max_" + $(obj).attr("class").substr(27)).html());
		var lot = parseFloat($(obj).parent().prev().prev().children().first().html())
		
		qteMax = qteMax / lot;
		qteActuelle += qte;
		
		if(qteActuelle < 1)
			qteActuelle = 1;
		
		if(qteActuelle > qteMax)
			qteActuelle = Math.floor(qteMax);
		
		$(obj).html(qteActuelle);
		$(obj).parent().next().children().first().html(qteActuelle * lot);
		this.totalCommande();
	}
	
	this.construct = function() {
		var that = this;
		$(".input-total-commande").click(
			function () {
				that.totalCommande();
			});
	
		$(".checkbox-commande").click(
			function () {
				var idproduit = $(this).attr("name").substr(9);
				if($(this).attr("checked")) {					
					that.radioCommandeClick($("input[name=radio_" + idproduit + "]:checked"),idproduit);					
					that.changerQte($("input[name=radio_" + idproduit + "]:checked").parent().next().next().next().children().first(),0);					
					$("input[name=radio_" + idproduit + "]").removeAttr("disabled");					
				} else {
					$("input[name=radio_" + idproduit + "]").attr("disabled","disabled");
					$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
					$(".qte_tot_" + idproduit).html('-');
					$(".prix_tot_" + idproduit).html('-');					
				}
			});
	
		$(".radio-commande").click(
			function () {
				var idproduit =  $(this).attr("name").substr(6);
				that.radioCommandeClick($(this),idproduit);				
				
				$(".qte_tot_" + idproduit).html('-');
				$(".prix_tot_" + idproduit).html('-');
				that.changerQte($(this).parent().next().next().next().children().first(),0);
				
				that.totalCommande();				
			});
		

	
		$(".plus-qte-commande").click( function () { that.changerQte($(this).prev().prev(),1); });
		$(".moins-qte-commande").click( function () { that.changerQte($(this).prev(),-1); });
	
		$("#button-submit-reservation-commande").click(
				function () {
					/* Récupération des données */
	/*				var lData = new Array();
					lData['produit'] = new Array();
					lData['info_produit'] = new Array();
					
					var lSigle = "";
					
					$(":radio:checked").each(
							function() {
								var idproduit = $(this).attr("name").substr(6);
								var idcheckbox = "checkbox_" + idproduit;			
								var checkbox = $("input[name=" + idcheckbox + "]");
								if(checkbox.attr("checked")) {

									lSigle = $(this).parent().next().next().next().next().next().children().last().html();
									
									 var lDataTemp = new Array();
									 lDataTemp['NOM'] = checkbox.next().html();
									 lDataTemp['QUANTITE'] = $(this).parent().next().next().next().next().children().first().html() + $(this).parent().next().next().next().next().children().last().html();
									 lDataTemp['PRIX'] = $(this).parent().next().next().next().next().next().children().first().html() + lSigle;
									 lData['produit'].push(lDataTemp);
									 
									 var lDataTemp2 = new Array();
									 lDataTemp2['IDLOT'] = $(this).next().html();
									 lDataTemp2['IDPDT'] = idproduit;
									 lDataTemp2['QTE'] = $(this).parent().next().next().next().children().first().html();
									 lData['info_produit'].push(lDataTemp2);
									 

								}
							});
					
					lData['TOTAL_COMMANDE'] = $("#total_commande").html() + lSigle;
					lData['ID_COMMANDE'] = $("#id-commande-formulaire-reservation-commande").html();
					
					/* Récupération du template */	 
	/*				var lCommandeTemplate = new CommandeTemplate();
					var lTemplate = lCommandeTemplate.confirmationReservationCommande;
					
					/* Ecriture des donnés */
	/*				$("#confirmation-reservation-commande-text").html(lTemplate.template(lData));
					
					/* Affichage */
	/*				$("#window-formulaire-reservation-commande").fadeOut(gTempsTransition,							
						function() { $("#confirmation-reservation-commande").fadeIn(gTempsTransition); }					
					);
				});
		
		$("#annuler-confirmation-reservation-commande").click(
				function () {
					$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
							function () {
					$("#window-formulaire-reservation-commande").fadeIn(gTempsTransition);
					});
					
				}
		
		);
	
		$("#commander-confirmation-reservation-commande").click(
			function () {				
				/* Passage de la commande */
				
				// TODO lancer la requete en json
				
	/*			$.post(	"./index.php?m=Commande&v=ReservationCommande",
						$("#form-confirmation-reservation-commande").serialize(),
						function (retour) {
					//alert(retour);
							var lCommandeTemplate = new CommandeTemplate();
							/* Traitement du retour */
	/*						var html;
							if(retour.succes == true) {
								html = lCommandeTemplate.reservationOk.template(retour);
							} else {
								html = lCommandeTemplate.reservationKo.template(retour);
							}
							$('#description_commande_int').hide();
							$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
									function () { $("#confirmation-reservation-commande").after(html);});
						},"json"
					);
			});
	}
	*/
}