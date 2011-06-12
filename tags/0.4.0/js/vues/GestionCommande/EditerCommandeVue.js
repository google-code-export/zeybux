;function EditerCommandeVue(pParam) {
	this.mNiveau = [];
	this.mIdCommande = null;
	this.mCommande = null;
	
	this.construct = function(pParam) {
		var that = this;
		pParam.export_type = 0;
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
		
		lData.comId = pResponse.commande[0].comId;
		this.mIdCommande = lData.comId;
		lData.comNumero = pResponse.commande[0].comNumero;
		lData.comDescription = pResponse.commande[0].comDescription;
		lData.dateTimeFinReservation = pResponse.commande[0].comDateFinReservation;
		lData.dateFinReservation = pResponse.commande[0].comDateFinReservation.extractDbDate().dateDbToFr();
		lData.heureFinReservation = pResponse.commande[0].comDateFinReservation.extractDbHeure();
		lData.minuteFinReservation = pResponse.commande[0].comDateFinReservation.extractDbMinute();
		lData.dateMarcheDebut = pResponse.commande[0].comDateMarcheDebut.extractDbDate().dateDbToFr();
		lData.heureMarcheDebut = pResponse.commande[0].comDateMarcheDebut.extractDbHeure();
		lData.minuteMarcheDebut = pResponse.commande[0].comDateMarcheDebut.extractDbMinute();
		lData.heureMarcheFin = pResponse.commande[0].comDateMarcheFin.extractDbHeure();
		lData.minuteMarcheFin = pResponse.commande[0].comDateMarcheFin.extractDbMinute();
		
		lData.pdtCommande = [];
		
		$(pResponse.commande).each(function() {
			var lLot = {"dcomTaille":this.dcomTaille.nombreFormate(2,',',' '),"dcomPrix":this.dcomPrix.nombreFormate(2,',',' ')};
			
			if(lData.pdtCommande[this.proId]) {
				lData.pdtCommande[this.proId].lot[this.dcomId] = lLot;
			} else {			
				var lProduit = {
						"proId":this.proId,
						"proUniteMesure":this.proUniteMesure,
						"proMaxProduitCommande":this.proMaxProduitCommande.nombreFormate(2,',',' '),
						"nproNom":this.nproNom,
						"lot":[]};
				lProduit.lot[this.dcomId] = lLot;
				
				$(pResponse.stockInitiaux).each(function() {
					if(this.idProduit == lProduit.proId) {
						lProduit.quantiteInit = this.quantite;
					}					
				});
				
				$(pResponse.stock).each(function() {
					if(this.proId == lProduit.proId) {
						lProduit.quantite = this.stoQuantite;
					}					
				});
				
				
				lProduit.quantiteCommande = lProduit.quantiteInit - lProduit.quantite;
				that.mNiveau.push({'id':lProduit.proId,'quantite':parseInt(lProduit.quantiteCommande*100/lProduit.quantiteInit)});
				
				lProduit.quantiteCommande = lProduit.quantiteCommande.nombreFormate(2,',',' ');
				lProduit.quantiteInit = lProduit.quantiteInit.nombreFormate(2,',',' ');
				lProduit.quantite = lProduit.quantite.nombreFormate(2,',',' ');
				
				lData.pdtCommande[this.proId] = lProduit;
			}
		});
		
		lData.listeAdherentCommande = pResponse.listeAdherentCommande;
		lData.sigleMonetaire = gSigleMonetaire;
		
		this.mCommande = lData;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
	/*	var lTemplate = lGestionCommandeTemplate.editerCommandePageEntete;
		var lHtml = lTemplate.template(lData);*/
		
		var lTemplate = lGestionCommandeTemplate.editerCommandePage;
		//lHtml += lTemplate.template(lData);
		
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
		pData = this.affectCloturer(pData);
		pData = this.affectExportReservation(pData);
		pData = this.affectBonDeCommande(pData);
		pData = this.affectBonDeLivraison(pData);
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
			pData.find('#pdt-' + lId).progressbar({
				value:lQuantite
			});
			
			pData.find('.pdt-' + lId + '-afficher-detail').click(function() {
				pData.find('#pdt-' + lId + '-detail').slideToggle();
				pData.find('.pdt-' + lId + '-afficher-detail').toggle();
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
						var lParam = {id_commande:that.mIdCommande};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=CloturerCommande", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.cloturerCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lResponse));
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
						lParam = {pParam:1,export_type:1,id_commande:that.mIdCommande,id_produits:lIdProduits,format:lFormat};
						
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
	
	this.construct(pParam);
}