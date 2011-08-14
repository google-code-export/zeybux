;function EditerCommandeVue(pParam) {
	this.mNiveau = [];
	this.mIdCommande = null;
	this.mCommande = null;
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficher(lResponse);
						if(pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
				
		var lData = {};
		
		lData.comId = pResponse.marche.id;
		this.mIdCommande = lData.comId;
		lData.comNumero = pResponse.marche.numero;
		lData.comDescription = pResponse.marche.description;
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
		
		lData.pdtCommande = [];
		
		$.each(pResponse.marche.produits,function() {
			
			var lProduit = {};
			lProduit.proId = this.id;
			lProduit.nproNom = this.nom;
			lProduit.quantiteCommande = parseFloat(this.stockInitial) - parseFloat(this.stockReservation);
			lProduit.quantiteInit = parseFloat(this.stockInitial);
			lProduit.unite = this.unite;
			
			that.mNiveau.push({'id':this.id,
								'quantite':parseInt(lProduit.quantiteCommande*100/lProduit.quantiteInit)});
			
			lData.pdtCommande.push(lProduit);
		});

		lData.listeAdherentCommande = pResponse.listeAdherentCommande;
		lData.sigleMonetaire = gSigleMonetaire;
		
		this.mCommande = lData;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();		
		var lTemplate = lGestionCommandeTemplate.editerCommandePage;
		
		var lHtml = that.affect($(lTemplate.template(lData)));
		
		// Si il n'y a pas de résa on affiche pas le tableau
		if(!(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null)) {			
			lHtml.find('#edt-com-recherche').hide();
			lHtml.find('#edt-com-liste-resa').replaceWith(lGestionCommandeTemplate.listeReservationVide);
		}
		
		$('#contenu').replaceWith(lHtml);	
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectNiveau(pData);
		pData = this.affectReservation(pData);
		pData = this.affectModifier(pData);
		//pData = this.affectCloturer(pData);
		pData = this.affectExportReservation(pData);
		pData = this.affectBonDeCommande(pData);
		pData = this.affectBonDeLivraison(pData);
		pData = this.affectArchive(pData);
		pData = this.affectListeAchatEtReservation(pData);
		pData = this.affectListeReservation(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[2,0]] });
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	}
	
	this.affectNiveau = function(pData) {		
		$(this.mNiveau).each(function() {
			var lId = this.id;
			var lQuantite = this.quantite;
			if(lQuantite < 1) { lQuantite = 1; }
			pData.find('#pdt-' + lId).progressbar({
				value:lQuantite
			});
		});
		return pData;
	}
	
	this.affectReservation = function(pData) {
		var that = this;
		pData.find('.edt-com-reservation-ligne').click(function() {
			ReservationAdherentVue({"id_commande":that.mIdCommande,"id_adherent":$(this).find('.id-adherent').text()});
		});
		return pData;
	}
	
	this.affectModifier = function(pData) {	
		var that = this;
		pData.find('#btn-modif-com').click(function() {
			ModifierCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectBonDeCommande = function(pData) {
		var that = this;
		pData.find('#btn-bon-com').click(function() {
			BonDeCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectBonDeLivraison = function(pData) {
		var that = this;
		pData.find('#btn-livraison-com').click(function() {
			BonDeLivraisonVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectArchive = function(pData) {
		if(this.mCommande.archive == 0) {
			pData.find('.marche-archive-0').show();
		} else if(this.mCommande.archive == 1) {
			pData.find('.marche-archive-1').show();
		}
		pData = this.affectPause(pData);
		pData = this.affectPlay(pData);
		pData = this.affectCloturer(pData);
		return pData;
	}
	
	this.modifierArchive = function() {
		if(this.mCommande.archive == 0) {
			$('.marche-archive-0').show();
			$('.marche-archive-1').hide();
		} else if(this.mCommande.archive == 1) {
			$('.marche-archive-0').hide();
			$('.marche-archive-1').show();
		}
	}
	
	this.affectCloturer = function(pData) {
		var that = this;
		pData.find('#btn-cloture-com')
		.click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogClotureCommande;
			
			$(lTemplate.template(that.mCommande)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Cloturer': function() {
						var lParam = {id_commande:that.mIdCommande,fonction:"cloturer"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										/*var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.cloturerCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lResponse));*/
										
										// Message de confirmation
										var lVr = new TemplateVR();
										lVr.valid = false;
										lVr.log.valid = false;
										var erreur = new VRerreur();
										erreur.code = ERR_313_CODE;
										erreur.message = ERR_313_MSG;
										lVr.log.erreurs.push(erreur);										

										var lparam = {"id_commande":that.mIdCommande,
												vr:lVr};
										InfoCommandeArchiveVue(lparam);
										
										
										$(lDialog).dialog('close');
									} else {
										Infobulle.generer(lResponse,'');
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
	}
	
	this.affectPause = function(pData) {
		var that = this;
		pData.find('#btn-pause-com')
		.click(function() {
			var lParam = {id_commande:that.mIdCommande,fonction:"pause"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {							
							that.mCommande.archive = 1;
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
					},"json"
			);
		});
		return pData;
	}
	
	this.affectPlay = function(pData) {
		var that = this;
		pData.find('#btn-play-com')
		.click(function() {
			var lParam = {id_commande:that.mIdCommande,fonction:"play"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {							
							that.mCommande.archive = 0;
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
					},"json"
			);
		});
		return pData;
	}
	
	this.affectExportReservation = function(pData) {		
		var that = this;
		pData.find('#btn-export-resa')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogExportListeReservation;
			
			$(lTemplate.template(that.mCommande)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Exporter': function() {
						// Récupération du formulaire
						var lIdProduits = '';
						$(this).find(':input[name=id_produits]:checked').each(function() {
							lIdProduits += $(this).val() + ',';
						});
						lIdProduits = lIdProduits.substr(0,lIdProduits.length-1);
						
						var lFormat = $(this).find(':input[name=format]:checked').val();
						var lParam = new ExportListeReservationVO();
						//lParam = {pParam:1,export_type:1,id_commande:that.mIdCommande,id_produits:lIdProduits,format:lFormat};
						lParam = {fonction:"exportReservation",id_commande:that.mIdCommande,id_produits:lIdProduits,format:lFormat};
						
						// Test des erreurs
						var lValid = new ExportListeReservationValid();
						var lVr = lValid.validAjout(lParam);
						
						Infobulle.init(); // Supprime les erreurs
						if(lVr.valid) {
							// Affichage
							$.download("./index.php?m=GestionCommande&v=EditerCommande", lParam);
						} else {
							Infobulle.generer(lVr,'');
						}
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
			
		});
		return pData;
	}
	
	this.affectListeAchatEtReservation = function(pData) {
		var that = this;
		pData.find("#btn-liste-achat-resa").click(function() {
			that.afficherAchatEtReservation();
		});
		
		return pData;
	}
	
	
	this.affectAchatEtReservation = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectAchat(pData);
		pData = this.affectExportDataEtReservation(pData);
		return pData;
	}
	
	this.affectAchat = function(pData) {
		var that = this;
		pData.find('.edt-com-achat-ligne').click(function() {
			AchatAdherentVue({"id_commande":that.mIdCommande,"id_adherent":$(this).find('.id-adherent').text()});
		});
		return pData;
	}
	
	this.afficherAchatEtReservation = function() {
		var that = this;
		var lParam = {id_commande:this.mIdCommande,fonction:"listeAchatReservation"};
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						
						// Met le bouton en actif
						$("#btn-liste-resa").removeClass("ui-state-active");
						$("#btn-liste-achat-resa").addClass("ui-state-active");
						
						$(lResponse.listeAchatEtReservation).each(function() {
							if(this.reservation == null) { this.reservation = '';}
							if(this.achat == null) { this.achat = '';}
						});

						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						if(lResponse.listeAchatEtReservation.length > 0 && lResponse.listeAchatEtReservation[0].adhId != null) {
							var lTemplate = lGestionCommandeTemplate.listeAchatEtReservation;
							$('#edt-com-liste').replaceWith(that.affectAchatEtReservation($(lTemplate.template(lResponse))));
						} else {
							$('#edt-com-liste').replaceWith(lGestionCommandeTemplate.listeAchatEtReservationVide);
						}
						
						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.affectExportDataEtReservation = function(pData) {		
		var that = this;
		pData.find('#btn-export-achat')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogExportListeAchatEtReservation;
			
			$(lTemplate.template(that.mCommande)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Exporter': function() {
						// Récupération du formulaire
						/*var lIdProduits = '';
						$(this).find(':input[name=id_produits]:checked').each(function() {
							lIdProduits += $(this).val() + ',';
						});
						lIdProduits = lIdProduits.substr(0,lIdProduits.length-1);
						
						var lFormat = $(this).find(':input[name=format]:checked').val();
						var lParam = new ExportListeReservationVO();
						//lParam = {pParam:1,export_type:1,id_commande:that.mIdCommande,id_produits:lIdProduits,format:lFormat};*/
						lParam = {fonction:"exportAchatEtReservation",id_commande:that.mIdCommande};
						
						// Test des erreurs
						/*var lValid = new ExportListeReservationValid();
						var lVr = lValid.validAjout(lParam);
						
						Infobulle.init(); // Supprime les erreurs
						if(lVr.valid) {*/
							// Affichage
							$.download("./index.php?m=GestionCommande&v=EditerCommande", lParam);
						/*} else {
							Infobulle.generer(lVr,'');
						}*/
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
			
		});
		return pData;
	}
	
	this.affectListeReservation = function(pData) {
		var that = this;
		pData.find("#btn-liste-resa").click(function() {
			that.afficherListeReservation();
		});
		
		return pData;
	}
	
	this.affectReservationAction = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectExportReservation(pData);
		pData = this.affectReservation(pData);
		return pData;
	}

	this.afficherListeReservation = function() {
		var that = this;
		var lParam = {id_commande:this.mIdCommande,fonction:"listeReservation"};
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						
						// Met le bouton en actif
						$("#btn-liste-achat-resa").removeClass("ui-state-active");
						$("#btn-liste-resa").addClass("ui-state-active");
						

						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.listeReservation;
						
						var lHtml = that.affectReservationAction($(lTemplate.template(lResponse)));
						
						// Si il n'y a pas de résa on affiche pas le tableau
						if(!(lResponse.listeAdherentCommande.length > 0 && lResponse.listeAdherentCommande[0].adhId != null)) {			
							lHtml.find('#edt-com-recherche').hide();
							lHtml.find('#edt-com-liste-resa').replaceWith(lGestionCommandeTemplate.listeReservationVide);
						}
						
						$('#edt-com-liste').replaceWith(lHtml);
						
						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}

	this.construct(pParam);
}