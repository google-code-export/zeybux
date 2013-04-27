;function BonDeCommandeVue(pParam) {
	this.mIdCommande = null;
	this.mComNumero = null;
	this.mEtatEdition = false;
	this.mListeProduit = [];
	this.mSuiteEdition = 0;
	this.mIdCompteProducteur = 0;
	this.mArchive = -1;
	this.mAfficheLot = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {BonDeCommandeVue(pParam);}} );
		var that = this;
		//pParam.export_type = 0;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mEtatEdition = false;
							that.mArchive = lResponse.archive;
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
		var lTemplate = lGestionCommandeTemplate.bonDeCommande;
		
		this.mIdCommande = pResponse.producteurs[0].proIdCommande;
		this.mComNumero = pResponse.comNumero;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));	
	};
	
	this.affectDroitArchive = function(pData) {
		pData.find("#btn-annuler").remove();
		pData.find("#btn-enregistrer").remove();
		pData.find("#btn-modifier").remove();
		return pData;
	};
	
	this.affect = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectBtnRetourMarche(pData);
		pData = this.affectChangementProducteur(pData);
		pData = this.affectExportBonCommande(pData);
		return pData;
	};
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_marche":that.mIdCommande});
		});
		return pData;
	};
	
	this.affectChangementProducteur = function(pData) {
		var that = this;
		pData.find('#select-prdt').change(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 1;
				that.dialogEnregistrer();
			} else {
				that.changementProducteur();
			}
		});
		return pData;
	};
	
	this.changementProducteur = function(pParam) {
		var that = this;
		var lIdCompteProducteur = $('#select-prdt').val();
		if(lIdCompteProducteur > 0) {
			var lParam = {	"id_commande":that.mIdCommande,
						 	"id_compte_ferme":lIdCompteProducteur,
						 	fonction:"afficherProducteur"};
			$.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								// Permet l'export du bon de commande
								$('#btn-export-bcom').show();
								
								that.mIdCompteProducteur = lIdCompteProducteur;
								that.mEtatEdition = false;
								
								if(lResponse.produitsCommande[0] && lResponse.produitsCommande[0].proIdCommande != null) {
									that.afficherDetail(lResponse);
								} else {
									that.afficherFormulaire(lResponse);
								}
								
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		} else {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.listeProduitVide;
			$('#liste-pdt').replaceWith(lTemplate);
			// Cache l'export du bon de commande
			$('#btn-export-bcom').hide();
		}
	};
	
	this.afficherDetail = function(pResponse) {
		var that = this;
		//Initialisation du tableau
		this.mAfficheLot = [];
		$(pResponse.produits).each(function() {
			//Permet de détecter si on affiche le lot
			if(that.mAfficheLot[this.proId] ) {
				that.mAfficheLot[this.proId] = 2;
			} else {
				that.mAfficheLot[this.proId] = 1;
			}
			
			that.mListeProduit[this.dcomId] = this.stoQuantite;
			
			this.stoQuantiteCommande = "0";
			this.dopeMontant = "0";
			
			var lDcomId = this.dcomId;
			var these = this;			
			$(pResponse.produitsCommande).each(function() {
				if(this.dcomId == lDcomId) {
					these.stoQuantiteCommande = this.stoQuantite;
					these.dopeMontant = this.dopeMontant;
				}
			});
			
			if(this.stoQuantiteCommande - this.stoQuantite < 0) {
				this.classEtat = 'qte-reservation-ko';
			} else {
				this.classEtat = 'qte-reservation-ok';
			}
			
			if(this.stoQuantiteCommande != '') {
				this.stoQuantiteCommande = this.stoQuantiteCommande.nombreFormate(2,',',' ');
			}
			if(this.stoQuantite == null) {
				this.stoQuantite = "0";
			}
			this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
			this.dopeMontant = this.dopeMontant.nombreFormate(2,',',' ');
		});
		// Affiche les lots
		$(pResponse.produits).each(function() {
			if(that.mAfficheLot[this.proId] && that.mAfficheLot[this.proId] == 2) {
				this.nproNom += " (" + this.dcomTaille.nombreFormate(2,',',' ') + " " + this.proUniteMesure + ")";
			}
		});
		pResponse.sigleMonetaire = gSigleMonetaire;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeProduitBonDeCommande;
		
		$('#liste-pdt').replaceWith(that.affectListeProduit($(lTemplate.template(pResponse))));
	};	
	
	this.afficherFormulaire = function(pResponse) {
		var that = this;
		//Initialisation du tableau
		this.mAfficheLot = [];
		$(pResponse.produits).each(function() {//Permet de détecter si on affiche le lot
			if(that.mAfficheLot[this.proId] ) {
				that.mAfficheLot[this.proId] = 2;
			} else {
				that.mAfficheLot[this.proId] = 1;
			}
			
			that.mListeProduit[this.dcomId] = this.stoQuantite;

			if(this.stoQuantite == null) {
				this.stoQuantite = 0;
			}
			
			this.stoQuantiteCommande = this.stoQuantite;
			this.dopeMontant = (this.dopeMontant * -1).nombreFormate(2,',',' ');
			
			if(this.stoQuantiteCommande - this.stoQuantite < 0) {
				this.classEtat = 'qte-reservation-ko';
			} else {
				this.classEtat = 'qte-reservation-ok';
			}
			if(this.stoQuantiteCommande != '') {
				this.stoQuantiteCommande = this.stoQuantiteCommande.nombreFormate(2,',',' ');
			}
			this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
		});		
		// Affiche les lots
		$(pResponse.produits).each(function() {
			if(that.mAfficheLot[this.proId] && that.mAfficheLot[this.proId] == 2) {
				this.nproNom += " (" + this.dcomTaille.nombreFormate(2,',',' ') + " " + this.proUniteMesure + ")";
			}
		});
		pResponse.sigleMonetaire = gSigleMonetaire;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeProduitBonDeCommande;
		
		$('#liste-pdt').replaceWith(that.affectListeProduitFormulaire($(lTemplate.template(pResponse))));
	};	
	
	this.affectListeProduit = function(pData) {
		pData = this.affectEtatCommande(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectModifier(pData);
		pData = this.affectMasquerFormulaire(pData);
		pData = this.affectCalculPrix(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		if(this.mArchive == 2) { // Si le marché est archivé on ne peut plus faide de modification
			pData = this.affectDroitArchive(pData);
		}
		return pData;
	};
	
	this.affectListeProduitFormulaire = function(pData) {
		pData = this.affectEtatCommande(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectModifier(pData);
		pData = this.affectMasquerDetail(pData);
		pData = this.affectCalculPrix(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		if(this.mArchive == 2) { // Si le marché est archivé on ne peut plus faide de modification
			pData = this.affectDroitArchive(pData);
		}
		return pData;
	};
	
	this.affectMasquerDetail = function(pData) {
		pData.find(".detail").hide();
		return pData;
	};
	this.affectMasquerFormulaire = function(pData) {
		pData.find(".formulaire").hide();
		return pData;
	};
	
	this.affectEtatCommande = function(pData) {
		var that = this;
		pData.find(".qte-commande").keyup(function() {
			that.mEtatEdition = true;
			var lDcomId = $(this).data('id-detail-commande');
			if(that.mListeProduit[lDcomId]) {
				if($(this).val().numberFrToDb()- that.mListeProduit[lDcomId] < 0) {
					$("#etat-commande-" + lDcomId)
						.removeClass('qte-reservation-ok')
						.addClass('qte-reservation-ko');
				} else {
					$("#etat-commande-" + lDcomId)
						.removeClass('qte-reservation-ko')
						.addClass('qte-reservation-ok');
				}
			}
		});
		return pData;
	};
	
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find("#btn-enregistrer").click(function() {
			that.mSuiteEdition = 0;
			that.enregistrer();
		});
		pData.find(".qte-commande ,.prix-commande ").keyup(function(event) {
			if (event.keyCode == '13') {
				that.mSuiteEdition = 0;
				that.enregistrer();
			}			
		});
		return pData;
	};
	this.affectModifier = function(pData) {
		var that = this;
		pData.find("#btn-modifier").click(function() {
			$(".detail").hide();
			$(".formulaire, #btn-annuler").show();
		});
		pData.find("#btn-annuler").click(function() {
			that.changementProducteur();
		});	
		return pData;
	};
	
	this.affectCalculPrix = function(pData) {
		pData.find(".qte-commande").keyup(function() {
			var lPrix = ($(this).val().numberFrToDb() * $(this).data('prix') / $(this).data('taille') ).toFixed(2);
			if(isNaN(lPrix) || lPrix <= 0) { 
				lPrix = '';
			} else { 
				lPrix = lPrix.nombreFormate(2,',','');
			}
			$(':input[name=prix-commande-' +  $(this).data('id-produit') + '-' + $(this).data('id-detail-commande') + ']').val(lPrix);
		});
		return pData;
	};
	
	this.enregistrer = function() {
		var that = this;
		
		var lParam = new ProduitsBonDeCommandeVO();
		
		lParam.id_commande = this.mIdCommande;
		lParam.id_compte_ferme = this.mIdCompteProducteur;
		lParam.export_type = 0;

		$('.qte-commande').each(function() {
			var lId = $(this).data('id-produit');	
			var lDcomId = $(this).data('id-detail-commande');
			var lProduit = new ProduitBonDeCommandeVO();
			lProduit = {id:lId,
						dcomId:lDcomId,
						quantite:$(':input[name=qte-commande-' + lId + '-' + lDcomId + ']').val().numberFrToDb(),
						prix:$(':input[name=prix-commande-' + lId + '-' + lDcomId + ']').val().numberFrToDb()
						};				
			lParam.produits.push(lProduit);
		});		
		
		var lValid = new ProduitsBonDeCommandeValid();
		var lVr = lValid.validAjout(lParam);
		
		if(lVr.valid) {
			lParam.fonction = "enregistrer";
			return $.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								that.mEtatEdition = false;
								
								if(that.mSuiteEdition == 1) {
									that.changementProducteur();
								} else if (that.mSuiteEdition == 2) {
									that.dialogExportBonDeCommande();
								} else {
									var lVr = new TemplateVR();
									lVr.valid = false;
									lVr.log.valid = false;
									var erreur = new VRerreur();
									erreur.code = ERR_301_CODE;
									erreur.message = ERR_301_MSG;
									lVr.log.erreurs.push(erreur);							
									
									//Infobulle.generer(lVr,'');
									that.changementProducteur({vr:lVr});
								}
							} else {
								Infobulle.generer(lResponse,'');
								//$('#select-prdt').selectOptions(that.mIdCompteProducteur);
							}
						}
					},"json"
			);
			
		} else {
			Infobulle.generer(lVr,'');
			//$('#select-prdt').selectOptions(that.mIdCompteProducteur);
		}
	};
	
	this.affectExportBonCommande = function(pData) {
		var that = this;	
		pData.find('#btn-export-bcom')
		.click(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 2;
				that.dialogEnregistrer();
			} else {
				that.dialogExportBonDeCommande();				
			}			
		});
		return pData;
	};
	
	this.dialogExportBonDeCommande = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogExportBonDeCommande;
		$(lTemplate.template({comNumero:that.mComNumero})).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter': function() {
					// Récupération du formulaire
					var lFormat = $(this).find(':input[name=format]:checked').val();
					
					var lParam = new ExportBonReservationVO();
					lParam.id_commande = that.mIdCommande;
					lParam.format = lFormat;
					lParam.fonction = "export";
					lParam.idCompteFerme = $('#select-prdt').val();
					
					// Test des erreurs
					var lValid = new ExportBonReservationValid();
					var lVr = lValid.validAjout(lParam);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Affichage
						$.download("./index.php?m=GestionCommande&v=BonDeCommande", lParam);
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
	};
	
	this.dialogEnregistrer = function() {	
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogEnregistrement;
		
		$(lTemplate).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Enregistrer': function() {
					that.enregistrer();
					$(this).dialog('close');
				},
				'Annuler': function() {
					if(that.mSuiteEdition == 1) {
						$('#select-prdt').selectOptions(that.mIdCompteProducteur);
					}
					$(this).dialog('close');
				},
				'Ne pas Enregistrer': function() {
					that.mEtatEdition = false;
					if(that.mSuiteEdition == 1) {
						that.changementProducteur();
					} else if (that.mSuiteEdition == 2) {
						that.changementProducteur();
						that.dialogExportBonDeCommande();
					}
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	};
	
	this.construct(pParam);
}