;function EditerCommandeVue(pParam) {
	//this.mNiveau = [];
	this.mIdMarche = null;
	this.mMarche = null;
	//this.mAffichageMarche = [];
	this.mListeFerme = null;
	this.mEditionLot = false;
	this.mIdLot = 0;
	this.mNbProduit = 0;
	this.mProduits = [];
	this.mParam = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {EditerCommandeVue(pParam);}} );
		this.mParam = pParam;
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							that.afficher(lResponse);
							if(pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
				
		var lData = {};
		
		lData.comId = pResponse.marche.id;
		this.mIdMarche = lData.comId;
		lData.comNumero = pResponse.marche.numero;
		lData.nom = pResponse.marche.nom;
		lData.comDescription = pResponse.marche.description;
		lData.dateTimeDebutReservation = pResponse.marche.dateDebutReservation;
		lData.dateDebutReservation = pResponse.marche.dateDebutReservation.extractDbDate().dateDbToFr();
		lData.heureDebutReservation = pResponse.marche.dateDebutReservation.extractDbHeure();
		lData.minuteDebutReservation = pResponse.marche.dateDebutReservation.extractDbMinute();		
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
		
		//lData.pdtCommande = [];
		
		/*$.each(pResponse.marche.produits,function() {
			
			var lProduit = {};
			lProduit.proId = this.id;
			lProduit.nproNom = this.nom;
			lProduit.quantiteCommande = parseFloat(this.stockInitial) - parseFloat(this.stockReservation);
			lProduit.quantiteInit = parseFloat(this.stockInitial);
			lProduit.unite = this.unite;
			
			that.mNiveau.push({'id':this.id,
								'quantite':parseInt(lProduit.quantiteCommande*100/lProduit.quantiteInit)});
			
			lData.pdtCommande.push(lProduit);
		});*/
		
		var lAffichageMarche = [];
		$.each(pResponse.marche.produits,function() {
			var lIdFerme = this.ferId;
			var lIdCategorie = this.idCategorie;
			var lIdNomProduit = this.idNom;
			
			var lQteReservation = parseFloat(this.stockInitial) - parseFloat(this.stockReservation);
			if(this.stockInitial == -1) {
				lQteReservation++;
			}
			
			var lProduit = {id:this.id,
							nproId:lIdNomProduit,
							nproNom:this.nom,
							nproStock:this.stockInitial,
							nproQteMax:this.qteMaxCommande,
							nproUnite:this.unite,
							qteReservation:lQteReservation};	
			
			if(!lAffichageMarche[lIdFerme]) {
				lAffichageMarche[lIdFerme] = {	ferId:lIdFerme,
													ferNom:this.ferNom,
													categories:[]};
			}
			
			if(!lAffichageMarche[lIdFerme].categories[lIdCategorie]){
				lAffichageMarche[lIdFerme].categories[lIdCategorie] = {
						cproId:lIdCategorie,
						cproNom:this.cproNom,
						produits:[]};
			}

			lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdNomProduit] = lProduit;		
			that.mNbProduit++;
		});
		
		
		var lFermes = [];		
		$(lAffichageMarche).each(function() {
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
		
		this.mListeFerme = {fermes:[]};
		$(lFermes).each(function(i,val) {
			var lIdFerme = val[1];
			var lCategories = val[2];
			if(lAffichageMarche[lIdFerme]) {
				var lAjoutFerme = false;
				var lFerme = {	ferId:lAffichageMarche[lIdFerme].ferId,
								ferNom:lAffichageMarche[lIdFerme].ferNom,
								categories:[]};
				$(lCategories).each(function(i,val) {
					var lIdCategorie = val[1];
					var lProduits = val[2];
					if(lAffichageMarche[lIdFerme].categories[lIdCategorie]) {
						var lAjoutCategorie = false;
						var lCategorie = {
								cproId:lAffichageMarche[lIdFerme].categories[lIdCategorie].cproId,
								cproNom:lAffichageMarche[lIdFerme].categories[lIdCategorie].cproNom,
								produits:[]};
						$(lProduits).each(function(i,val) {
							var lIdProduit = val[1];
							if(lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit]) {
								lCategorie.produits.push({
									id:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].id,
									nproId:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproId,
									nproNom:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproNom,
									nproUnite:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].nproUnite,
									qteReservation:lAffichageMarche[lIdFerme].categories[lIdCategorie].produits[lIdProduit].qteReservation});
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
					that.mListeFerme.fermes.push(lFerme);
				}
			}
		});
		

		lData.listeAdherentCommande = pResponse.listeAdherentCommande;
		lData.sigleMonetaire = gSigleMonetaire;
		
		this.mMarche = lData;
		this.mMarche.produits = [];
		$.each(pResponse.marche.produits,function() {			
			that.mMarche.produits[this.idNom] = 1;
		});
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();		
		var lTemplate = lGestionCommandeTemplate.editerCommandePage;
		
		var lHtml = that.affect($(lTemplate.template(lData)));
		
		// Si il n'y a pas de résa on affiche pas le tableau
	/*	if(!(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null)) {			
			lHtml.find('#edt-com-recherche').hide();
			lHtml.find('#edt-com-liste-resa').replaceWith(lGestionCommandeTemplate.listeReservationVide);
		}*/
		
		$('#contenu').replaceWith(lHtml);	
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		//pData = this.affectNiveau(pData);
		//pData = this.affectReservation(pData);
		pData = this.affectModifier(pData);
		//pData = this.affectCloturer(pData);
		pData = this.affectDupliquerMarche(pData);
		pData = this.affectExportReservation(pData);
		pData = this.affectBonDeCommande(pData);
		pData = this.affectBonDeLivraison(pData);
		pData = this.affectArchive(pData);
		pData = this.affectListeAchatEtReservation(pData);
		pData = this.affectListeReservation(pData);
		pData = this.affectMajListeFerme(pData);
		pData = this.affectDialogAjoutProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectInformation(pData);
		return pData;
	}
	
	this.affectInformation = function(pData) {
		var that = this;
		pData.find('#btn-information-marche').click(function() {
			that.construct(that.mParam);
		});		
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
	
	/*this.affectNiveau = function(pData) {		
		$(this.mNiveau).each(function() {
			var lId = this.id;
			var lQuantite = this.quantite;
			if(lQuantite < 1) { lQuantite = 1; }
			pData.find('#pdt-' + lId).progressbar({
				value:lQuantite
			});
		});
		return pData;
	}*/
	
	this.affectReservation = function(pData) {
		var that = this;
		pData.find('.edt-com-reservation-ligne').click(function() {
			ReservationAdherentVue({"id_commande":that.mIdMarche,"id_adherent":$(this).find('.id-adherent').text()});
		});
		return pData;
	}
	
	this.affectModifier = function(pData) {	
		var that = this;
		pData.find('#btn-modif-com').click(function() {
			//ModifierCommandeVue({"id_commande":that.mIdMarche});
			that.dialogModifierInformationMarche();
		});
		return pData;
	}
	
	this.affectBonDeCommande = function(pData) {
		var that = this;
		pData.find('#btn-bon-com').click(function() {
			BonDeCommandeVue({"id_commande":that.mIdMarche});
		});
		return pData;
	}
	
	this.affectBonDeLivraison = function(pData) {
		var that = this;
		pData.find('#btn-livraison-com').click(function() {
			BonDeLivraisonVue({"id_commande":that.mIdMarche});
		});
		return pData;
	}
	
	this.affectDupliquerMarche = function(pData) {
		var that = this;
		pData.find('#btn-dupliquer-com').click(function() {
			DupliquerMarcheVue({"id_commande":that.mIdMarche});
		});
		return pData;
	}
	
	this.affectArchive = function(pData) {
		if(this.mMarche.archive == 0) {
			pData.find('.marche-archive-0').show();
		} else if(this.mMarche.archive == 1) {
			pData.find('.marche-archive-1').show();
		}
		pData = this.affectPause(pData);
		pData = this.affectPlay(pData);
		pData = this.affectCloturer(pData);
		return pData;
	}
	
	this.modifierArchive = function() {
		if(this.mMarche.archive == 0) {
			$('.marche-archive-0').show();
			$('.marche-archive-1').hide();
		} else if(this.mMarche.archive == 1) {
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
			
			$(lTemplate.template(that.mMarche)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Cloturer': function() {
						var lParam = {id_commande:that.mIdMarche,fonction:"cloturer"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
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
	
											var lparam = {"id_commande":that.mIdMarche,
													vr:lVr};
											InfoCommandeArchiveVue(lparam);
											
											
											$(lDialog).dialog('close');
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
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
		});
		return pData;
	}
	
	this.affectPause = function(pData) {
		var that = this;
		pData.find('#btn-pause-com')
		.click(function() {
			var lParam = {id_commande:that.mIdMarche,fonction:"pause"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {							
								that.mMarche.archive = 1;
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
			var lParam = {id_commande:that.mIdMarche,fonction:"play"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {							
								that.mMarche.archive = 0;
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
			
			$(lTemplate.template(that.mListeFerme)).dialog({
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
						//lParam = {pParam:1,export_type:1,id_commande:that.mIdMarche,id_produits:lIdProduits,format:lFormat};
						lParam = {fonction:"exportReservation",id_commande:that.mIdMarche,id_produits:lIdProduits,format:lFormat};
						
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
			AchatAdherentVue({"id_commande":that.mIdMarche,"id_adherent":$(this).find('.id-adherent').text()});
		});
		return pData;
	}
	
	this.afficherAchatEtReservation = function() {
		var that = this;
		var lParam = {id_commande:this.mIdMarche,fonction:"listeAchatReservation"};
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Met le bouton en actif
							$("#edt-com-nav-resa-achat span").removeClass("ui-state-active");
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
			
			$(lTemplate.template(that.mMarche)).dialog({
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
						//lParam = {pParam:1,export_type:1,id_commande:that.mIdMarche,id_produits:lIdProduits,format:lFormat};*/
						lParam = {fonction:"exportAchatEtReservation",id_commande:that.mIdMarche};
						
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
		var lParam = {id_commande:this.mIdMarche,fonction:"listeReservation"};
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							
							// Met le bouton en actif
							$("#edt-com-nav-resa-achat span").removeClass("ui-state-active");
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
					}
				},"json"
		);
	}
	
	this.affectMajListeFerme = function(pData) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.editerMarcheListeProduit;
		pData.find("#liste-ferme").replaceWith(that.affectGestionProduit($(lTemplate.template(that.mListeFerme))));
		return pData;
	}
	
	this.affectGestionProduit = function(pData) {
		pData = this.affectModifierProduit(pData);
		pData = this.affectSupprimerProduit(pData);
		return pData;		
	}
	
	this.affectModifierProduit = function(pData) {
		var that = this;
		pData.find(".btn-modifier-produit").click(function() {
			that.dialogModifierProduit($(this).attr("id-produit"));
		});
		return pData;	
	}
	
	this.dialogModifierProduit = function(pId) {
		var that = this;
		var lParam = {fonction:"detailProduitMarche",id:pId}
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							
							var lIdFerme = lResponse.produit.ferId;
							var lIdCategorie = lResponse.produit.idCategorie;

							var lStockAffichage = "";
							if(parseFloat(lResponse.produit.stockInitial) != -1) {
								lStockAffichage = lResponse.produit.stockInitial.nombreFormate(2,',',' ');
							}
							var lQteMaxAffichage = "";
							if(parseFloat(lResponse.produit.qteMaxCommande) != -1) {
								lQteMaxAffichage = lResponse.produit.qteMaxCommande.nombreFormate(2,',',' ');
							}
							
							var lData = {	ferId:lIdFerme,
											ferNom:lResponse.produit.ferNom,
											cproId:lIdCategorie,
											cproNom:lResponse.produit.cproNom,
											nproId:pId,
											nproNom:lResponse.produit.nom,
											unite:lResponse.produit.unite,
											nproStock:lStockAffichage,
											nproQteMax:lQteMaxAffichage,
											modelesLot:[]};
							
							$(lResponse.modelesLot).each(function() {
								if(this.mLotId != null) {
									var lVoLot = {	
											id:this.mLotId,
											quantite:this.mLotQuantite.nombreFormate(2,',',' '),
											prix:this.mLotPrix.nombreFormate(2,',',' '),
											unite:this.mLotUnite,
											sigleMonetaire:gSigleMonetaire,
											modele: "modele-lot",
											checked:""};
									lData.modelesLot.push(lVoLot);
								}
							});
							$(lResponse.produit.lots).each(function() {
								var lVoLot = {	
										id:this.id,
										quantite:this.taille.nombreFormate(2,',',' '),
										prix:this.prix.nombreFormate(2,',',' '),
										unite:lResponse.produit.unite,
										sigleMonetaire:gSigleMonetaire,
										modele: "",
										checked:"checked=\"checked\""};
								lData.modelesLot.push(lVoLot);
							});

							if(lResponse.produit.qteRestante == "" || lResponse.produit.stockInitial == -1) {
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
																
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.dialogModifProduitAjoutMarche;
							
							//$(lTemplate.template(lData)).dialog({	
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
						} else {
							Infobulle.generer(lResponse,"marche-");
						}
					}
				},"json"
		);		
	}
	
	this.affectPrixEtStock = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectAjoutLotGestion(pData);
		pData = this.affectAjoutLot(pData);
		pData = this.affectLimiteStock(pData);
		return pData;		
	}
	
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
	}
	
	this.affectAjoutLot = function(pData) {
		var that = this;
		pData.find('#btn-ajout-lot').click(function() {that.ajoutLot();});
		pData.find('#table-pro-prix input').keyup(function(event) {
			if (event.keyCode == '13') {
				that.ajoutLot();
			}
		});		
		return pData;		
	}
	
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
	}

	this.affectLot = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectAjoutLotGestion(pData);
		return pData;
	}
	
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
	}
	
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
	}
	
	this.ajoutLotModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();

		$("#pro-lot-" + pId + "-quantite").val($("#lot-" + pId + "-quantite").text());
		$("#pro-lot-" + pId + "-unite").val($("#lot-" + pId + "-unite").text());
		$("#pro-lot-" + pId + "-prix").val($("#lot-" + pId + "-prix").text());

		this.mEditionLot = true;
	}
	
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
	}
	
	this.ajoutLotAnnulerModification = function(pId) {
		$(".btn-lot, #btn-annuler-lot-" + pId + ", #btn-valider-lot-" + pId + ", .champ-lot-" + pId).toggle();
		this.mEditionLot = false;
	}
	
	this.ajoutLotSupprimer = function(pId) {
		$("#ligne-lot-" + pId).remove();
	}
	
	this.modifierProduit = function(pDialog) {
		var that = this;
		if(!this.mEditionLot) {
			// Préparation du MarcheVO							
			/*var lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();
			var lQteMax = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();*/
			
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
					
					var lVoProduit = new ProduitMarcheVO();
					lVoProduit.id = pDialog.find("#pro-idProduit").attr("id-produit");
					lVoProduit.unite = lUnite;
					lVoProduit.qteMaxCommande = lQteMax;
					lVoProduit.qteRestante = lStock;
							
					pDialog.find('.ligne-lot :checkbox:checked').each( function () {
						// Récupération des lots
						var lVoLot = new DetailCommandeVO();
						lVoLot.id = $(this).closest(".ligne-lot").find(".lot-id").text();
						lVoLot.taille = $(this).closest(".ligne-lot").find(".lot-quantite").text().numberFrToDb();
						lVoLot.prix = $(this).closest(".ligne-lot").find(".lot-prix").text().numberFrToDb();
						
						lVoProduit.lots.push(lVoLot);										
					});						
					
					var lValid = new ProduitMarcheValid();
					var lVr = lValid.validUpdate(lVoProduit);
					
					if(lVr.valid) {	
						Infobulle.init();
						lVoProduit.fonction = "modifierProduitMarche";
						$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lVoProduit),
								function (lResponse) {		
									if(lResponse) {
										if(lResponse.valid) {
											
											// Message de confirmation
											var lVR = new Object();
											var erreur = new VRerreur();
											erreur.code = ERR_330_CODE;
											erreur.message = ERR_330_MSG;
											lVR.valid = false;
											lVR.log = new VRelement();
											lVR.log.valid = false;
											lVR.log.erreurs.push(erreur);								
											Infobulle.generer(lVR,"");
											
		
											
											pDialog.dialog('close');
											
		
											that.construct({id_commande:that.mIdMarche,vr:lVR});
											
										} else {
											Infobulle.generer(lResponse,"pro-");
										}
									}
								},"json"
						);
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
	}
	
	this.affectSupprimerProduit = function(pData) {
		var that = this;
		pData.find(".btn-supprimer-produit").click(function() {
			var lId = $(this).attr("id-produit");
			if($(this).attr("qte-reservation") > 0) {
				that.dialogConfirmationSupprimerProduit(lId);
			} else {
				that.supprimerProduit(lId);
			}			
		});
		return pData;	
	}
	
	this.dialogConfirmationSupprimerProduit = function(pId) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		$(lGestionCommandeTemplate.dialogSupprimerProduit).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Supprimer': function() {
					that.supprimerProduit(pId);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
		});	
	}
	
	this.supprimerProduit = function(pId) {
		var that = this;
		var lParam = {fonction:"supprimerProduitMarche",id:pId}
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							that.mNbProduit--;
							
							// Message de confirmation
							var lVR = new Object();
							var erreur = new VRerreur();
							erreur.code = ERR_331_CODE;
							erreur.message = ERR_331_MSG;
							lVR.valid = false;
							lVR.log = new VRelement();
							lVR.log.valid = false;
							lVR.log.erreurs.push(erreur);								
							Infobulle.generer(lVR,"");
							
							
							$("#dialog-supprimer-produit").dialog('close');
							

							that.construct({id_commande:that.mIdMarche,vr:lVR});	
							
						} else {
							Infobulle.generer(lResponse,"marche-");
						}
					}
				},"json"
		);
	}
	
	this.dialogModifierInformationMarche = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();		
		var lHtml = $(lGestionCommandeTemplate.dialogModifierInfoMarche.template(that.mMarche));		

		lHtml.find(":input[name=heure-debut]").selectOptions(that.mMarche.heureMarcheDebut);
		lHtml.find(":input[name=minute-debut]").selectOptions(that.mMarche.minuteMarcheDebut);
		lHtml.find(":input[name=heure-fin]").selectOptions(that.mMarche.heureMarcheFin);
		lHtml.find(":input[name=minute-fin]").selectOptions(that.mMarche.minuteMarcheFin);
		lHtml.find(":input[name=heure-debut-reservation]").selectOptions(that.mMarche.heureDebutReservation);
		lHtml.find(":input[name=minute-debut-reservation]").selectOptions(that.mMarche.minuteDebutReservation);
		lHtml.find(":input[name=heure-fin-reservation]").selectOptions(that.mMarche.heureFinReservation);
		lHtml.find(":input[name=minute-fin-reservation]").selectOptions(that.mMarche.minuteFinReservation);
		
		lHtml = gCommunVue.comLienDatepicker('marche-dateDebutReservation','marche-dateFinReservation',lHtml);
		lHtml = gCommunVue.comLienDatepicker('marche-dateFinReservation','marche-dateMarcheDebut',lHtml);
		
		$(lHtml).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:800,
			buttons: {
				'Modifier': function() {
					that.modifierInformationMarche($(this));
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
		});	
	}
	
	this.modifierInformationMarche = function(pDialog) {
		var that = this;
		var lVo = new MarcheVO();

		lVo.id = this.mMarche.comId;
		lVo.nom = pDialog.find(':input[name=nom]').val();
		lVo.description = pDialog.find(':input[name=description]').val();
		lVo.dateMarcheDebut = pDialog.find(':input[name=date-debut]').val().dateFrToDb();
		lVo.timeMarcheDebut = pDialog.find(':input[name=heure-debut]').val() + ':' + pDialog.find(':input[name=minute-debut]').val() + ':00';
		lVo.dateMarcheFin = pDialog.find(':input[name=date-debut]').val().dateFrToDb();
		lVo.timeMarcheFin = pDialog.find(':input[name=heure-fin]').val() + ':' + pDialog.find(':input[name=minute-fin]').val() + ':00';
		lVo.dateDebutReservation = pDialog.find(':input[name=date-debut-reservation]').val().dateFrToDb();
		lVo.timeDebutReservation = pDialog.find(':input[name=heure-debut-reservation]').val() + ':' + pDialog.find(':input[name=minute-debut-reservation]').val() + ':00'
		lVo.dateFinReservation = pDialog.find(':input[name=date-fin-reservation]').val().dateFrToDb();
		lVo.timeFinReservation = pDialog.find(':input[name=heure-fin-reservation]').val() + ':' + pDialog.find(':input[name=minute-fin-reservation]').val() + ':00'
				
		var lValid = new MarcheValid();
		var lVR = lValid.validUpdateInformation(lVo);
		
		if(lVR.valid) {
			lVo.fonction = "modifierInformationMarche";
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lVo),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								// Maj des infos								
								that.mMarche.nom = lVo.nom;
								that.mMarche.comDescription = lVo.description;
								var lDateTime = lVo.dateDebutReservation + " " + lVo.timeDebutReservation;
								that.mMarche.dateDebutReservation = lDateTime.extractDbDate().dateDbToFr();
								that.mMarche.heureDebutReservation = lDateTime.extractDbHeure();
								that.mMarche.minuteDebutReservation = lDateTime.extractDbMinute();
								lDateTime = lVo.dateFinReservation + " " + lVo.timeFinReservation;
								that.mMarche.dateFinReservation = lDateTime.extractDbDate().dateDbToFr();
								that.mMarche.heureFinReservation = lDateTime.extractDbHeure();
								that.mMarche.minuteFinReservation = lDateTime.extractDbMinute();
								lDateTime = lVo.dateMarcheDebut + " " + lVo.timeMarcheDebut;
								that.mMarche.dateMarcheDebut = lDateTime.extractDbDate().dateDbToFr();
								that.mMarche.heureMarcheDebut = lDateTime.extractDbHeure();
								that.mMarche.minuteMarcheDebut = lDateTime.extractDbMinute();
								lDateTime = lVo.dateMarcheDebut + " " + lVo.timeMarcheFin;								
								that.mMarche.heureMarcheFin = lDateTime.extractDbHeure();
								that.mMarche.minuteMarcheFin = lDateTime.extractDbMinute();
								
								// Maj de l'affichage
								$("#edt-marche-dateDebutReservation").text(that.mMarche.dateDebutReservation);
								$("#edt-marche-heureDebutReservation").text(that.mMarche.heureDebutReservation);
								$("#edt-marche-minuteDebutReservation").text(that.mMarche.minuteDebutReservation);
								
								$("#edt-marche-dateFinReservation").text(that.mMarche.dateFinReservation);
								$("#edt-marche-heureFinReservation").text(that.mMarche.heureFinReservation);
								$("#edt-marche-minuteFinReservation").text(that.mMarche.minuteFinReservation);

								$("#edt-marche-dateMarcheDebut").text(that.mMarche.dateMarcheDebut);
								$("#edt-marche-heureMarcheDebut").text(that.mMarche.heureMarcheDebut);
								$("#edt-marche-minuteMarcheDebut").text(that.mMarche.minuteMarcheDebut);
								$("#edt-marche-heureMarcheFin").text(that.mMarche.heureMarcheFin);
								$("#edt-marche-minuteMarcheFin").text(that.mMarche.minuteMarcheFin);


								pDialog.dialog('close');
								
								// Message de confirmation
								var lVR = new Object();
								var erreur = new VRerreur();
								erreur.code = ERR_335_CODE;
								erreur.message = ERR_335_MSG;
								lVR.valid = false;
								lVR.log = new VRelement();
								lVR.log.valid = false;
								lVR.log.erreurs.push(erreur);								
								Infobulle.generer(lVR,"");
								
								
								
							} else {
								Infobulle.generer(lResponse,"marche-");
							}
						}
					},"json"
			);
		} else {
			// Affiche les erreurs
			Infobulle.generer(lVR,"marche-");						
		}
	}
	
	this.affectDialogAjoutProduit = function(pData) {
		var that = this;
		pData.find("#btn-ajout-produit").click(function() {
			var lParam = {fonction:"listeFerme"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {		
					if(lResponse) {
						if(lResponse.valid) {
							Infobulle.init(); // Supprime les erreurs
		
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.dialogAjoutProduitAjoutMarche;
							
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
		});
		return pData;
	}
	
	this.affectAjoutProduitSelectFerme = function(pData) {
		var that = this;
		pData.find("#pro-idFerme select").change(function() {
			var lId = $(this).val();
			$("#pro-idCategorie select, #pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#prix-stock-produit").replaceWith("<div id=\"prix-stock-produit\"></div>");	
			if(lId > 0) {
				var lParam = {fonction:"listeProduit",id:lId};
				$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
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
	}
	
	this.affectAjoutProduitSelectCategorie = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			$("#pro-idProduit select").attr("disabled","disabled").selectOptions("0");
			$("#prix-stock-produit").replaceWith("<div id=\"prix-stock-produit\"></div>");
			
			var lId = $(this).val();
			if(lId > 0) {
				
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.ajoutProduitSelectProduit;
				
				$("#pro-idProduit").replaceWith(that.affectAjoutProduitSelectProduit($(lTemplate.template(that.mProduits[lId]))));
				
			} 
				
		});
		return pData;
	}
	
	this.affectAjoutProduitSelectProduit = function(pData) {
		var that = this;
		pData.find("select").change(function() {
			var lId = $(this).val();
			if(lId > 0) {
				if(!that.mMarche.produits[lId]) {
					var lParam = {fonction:"listeModeleLot",idNomProduit:lId};
					$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
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
	}
	
	this.ajouterProduit = function(pDialog) {
		var that = this;
		if(!this.mEditionLot) {
			// Préparation du AffichageMarche
			var lIdFerme = pDialog.find(':input[name=ferme]').val();
			var lIdCategorie = pDialog.find(':input[name=categorie]').val();
			var lIdNomProduit = pDialog.find(':input[name=produit]').val();
			
			if(lIdNomProduit != 0) {
				/*var lStock = pDialog.find(':input[name=pro-stock]').val().numberFrToDb();
				var lQteMax = pDialog.find(':input[name=pro-qte-max]').val().numberFrToDb();*/
				
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
							
						// Préparation du MarcheVO		
						var lVoProduit = new ProduitMarcheVO();
						lVoProduit.id = that.mIdMarche;
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
							
						var lValid = new CommandeCompleteValid();
						var lVr = lValid.validAjoutProduit(lVoProduit);
						
						if(lVr.valid) {	
							Infobulle.init();
							lVoProduit.fonction = "ajouterProduitMarche";
							$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lVoProduit),
									function (lResponse) {		
										if(lResponse) {
											if(lResponse.valid) {
												
												// Message de confirmation
												var lVR = new Object();
												var erreur = new VRerreur();
												erreur.code = ERR_329_CODE;
												erreur.message = ERR_329_MSG;
												lVR.valid = false;
												lVR.log = new VRelement();
												lVR.log.valid = false;
												lVR.log.erreurs.push(erreur);								
												Infobulle.generer(lVR,"");
												
		
												
												pDialog.dialog('close');
												
		
												that.construct({id_commande:that.mIdMarche,vr:lVR});
												
											} else {
												Infobulle.generer(lResponse,"pro-");
											}
										}
									},"json"
							);
						} else {
							Infobulle.generer(lVr,'pro-');
						}
						
						
						
						/*ar lValid = new ProduitMarcheValid();
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
						}*/
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
	}

	this.construct(pParam);
}