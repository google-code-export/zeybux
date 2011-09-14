;function AjoutCommandeVue(pParam) {
	
	this.etapeCreationCommande = 0;
	this.mEditionEnCours = 0;
	this.mListeProducteurs = null;
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {AjoutCommandeVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
				function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}						
							// Pas d'affichage si il n' a pas de producteur en base
							if(lResponse.producteurs[0].prdtId == null) {
								lResponse.producteurs = [];
							}							
							that.mListeProducteurs = lResponse.producteurs;
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}					
					},"json"
				);		
	}
	
	this.afficher = function(pResponse) {
		var that = this;
		
		// Pas d'affichage si il n' a pas de produit en base
		if(pResponse.produits[0].id == null) {
			pResponse.produits = [];
		}
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.formulaireAjoutCommande;
		$('#contenu').replaceWith( that.affect($(lTemplate.template(pResponse))));
	}
	
	this.affect = function(pData) {
		pData = this.affectAjoutProduit(pData);
		pData = this.affectCreerCommande(pData);
		pData = this.affectModifierCommande(pData);
		pData = this.affectDialogCreerProduit(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectNouveauProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectAjoutProduit = function(pData) {
		var lId = "#formulaire-ajout-produit-creation-commande";
		var that = this;
		pData.find(lId).submit(
			function () {
				
				var lValid = true;
				$(".produit-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.idProducteur = $(lId + " :input[name=producteur]").val();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();

					if(isNaN(parseFloat(lVo.qteMaxCommande)) || (parseFloat(lVo.qteMaxCommande) > parseFloat(lVo.qteRestante))){
						lVo.qteMaxCommande = lVo.qteRestante;
					}
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);

					var lValid = new ProduitCommandeValid();
					var lVr = lValid.validAjout(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.qteMaxCommande = lVo.qteMaxCommande.nombreFormate(2,',',' ');
						lVo.qteRestante = lVo.qteRestante.nombreFormate(2,',',' ');
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.lots[0].taille = parseFloat(lVo.lots[0].taille).nombreFormate(2,',',' ');
						lVo.lots[0].id = 0;
						lVo.siglemonetaire = gSigleMonetaire;
						
						lVo.producteurs = that.mListeProducteurs;
						lVo.nomProducteur = $(lId + " :input[name=producteur]").selectedOptions().text();
						
						var lHtml = that.affectNouveauProduit($(lTemplate.template(lVo)));
						
						// Séléction du producteur
						lHtml.find(':input[name=producteur]').selectOptions(lVo.idProducteur);
						
						lTemplate = lGestionCommandeTemplate.ajoutLotAjoutPdt; 
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lTemplate.template(lVo)) ));
							
						$("#liste_produit").append(lHtml); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						$(lId + " :input[name=produit]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=produit]").selectOptions(0);
						$(lId + " :input[name=producteur]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=producteur]").selectOptions(0);
						
					} else {
						Infobulle.generer(lVr,'ajout-produit-');	
					}
				} else {
					var lVr = new TemplateVR();
					lVr.valid = false;
					lVr.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_211_CODE;
					erreur.message = ERR_211_MSG;
					lVr.log.erreurs.push(erreur);
					Infobulle.generer(lVr,'');
				}
				return false;								
			});
		return pData;
	}
	
	this.affectCreerCommande = function(pData) {
		var lId = "#btn-creer-commande";
		var that = this;
		pData.find(lId).click(
			function () {				
				if(that.mEditionEnCours == 0) {
					// Récupération des données
					var lVo = new CommandeCompleteVO();
					lVo.nom = $("#formulaire-information-creation-commande").find(':input[name=nom_commande]').val();
					lVo.description = $("#formulaire-information-creation-commande").find(':input[name=description_commande]').val();
					lVo.dateMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=heure_debut_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_debut_marche]').val() + ':00';
					lVo.dateMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_marche]').val() + ':00';
					lVo.dateFinReservation = $("#formulaire-information-creation-commande").find(':input[name=date_fin_commande]').val().dateFrToDb();
					lVo.timeFinReservation = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_commande]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_commande]').val() + ':00';
					lVo.archive = "0";
					
					$('.produit-div').each(
							function () {
								var lVoProduit = new ProduitCommandeVO();		
								lVoProduit.idProducteur = $(this).find(':input[name=producteur]').val();
								lVoProduit.idNom = $(this).find('.produit-id').text();							
								lVoProduit.unite = $(this).find(':input[name=unite]').val();
								lVoProduit.qteMaxCommande = $(this).find(':input[name=qmax]').val().numberFrToDb();
								lVoProduit.qteRestante = $(this).find(':input[name=stock]').val().numberFrToDb();
								
								$(this).find('.produit-lot').each(
										function () {
											// Récupération des lots
											var lVoLot = new DetailCommandeVO();
											lVoLot.taille = $(this).find(':input[name=taille]').val().numberFrToDb();
											lVoLot.prix = $(this).find(':input[name=prix]').val().numberFrToDb();
											lVoProduit.lots.push(lVoLot);										
										});													
								
								lVo.produits.push(lVoProduit);								
							});	
					
					if(that.etapeCreationCommande == 0) {		
						
						var lValid = new CommandeCompleteValid();
						var lVR = lValid.validAjout(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide();
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot").each(
										function () {
											$(this).hide();
										});
								
								$("#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select").each(
										function () {
											$(this).inputToText();
										});					
						} else {
							// Affiche les erreurs
							Infobulle.generer(lVR,"commande-");							
						}
					
					} else if(that.etapeCreationCommande == 1) {
						// Envoi des infos en json
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								"commande=" + $.toJSON(lVo) + "&form=2",
								function (lVoRetour) {		
									if(lVoRetour.valid) {
										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.ajoutCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lVoRetour));
									} else {
										that.modifierCommandeFunction();
										Infobulle.generer(lVoRetour,"commande-");
									}
									that.etapeCreationCommande = 0;
								},"json"
						);
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
			});
		return pData;
	}
		
	this.affectModifierCommande = function(pData) {
		var that = this;
		pData.find('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
		return pData;
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande, .edit-nom-pdt-creation-commande-valid').hide();
		$('.produit-lots').each(function () {that.afficherDeleteLot($(this))});
		$('#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select').textToInput();
	}
	
	this.ajoutLotProduit = function(pData) {
		var that = this;
		pData.find('.btn-ajout-lot-creation-commande').click(
			function () {
				
				var inpTaille = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=taille]");
				var inpPrix = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=prix]");
				
				// Récupération des données
				var lVo = new DetailCommandeVO();
				lVo.idProduit = $(this).parents(".produit-div").find(".produit-id").text();
				lVo.taille = inpTaille.val().numberFrToDb();
				lVo.prix = inpPrix.val().numberFrToDb();
				
				var lValid = new DetailCommandeValid();
				var lVr = lValid.validAjout(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
					lVo.taille = parseFloat(lVo.taille).nombreFormate(2,',',' ');
					
					lVo.siglemonetaire = gSigleMonetaire;
					lVo.unite = $(this).parentsUntil(".produit-div").find(":input[name=unite]").val();
				
					lVo.idNom = lVo.idProduit;
					var lListeId = new Array();
					$(this).parentsUntil(".produit-div").find(".produit-lot").each(function(){
						lListeId.push(parseInt($(this).find(".lot-id").text()));
					});
					lVo.id = Array.max(lListeId) + 1;
					
					var lGestionCommandeTemplate = new GestionCommandeTemplate();
					var lTemplate = lGestionCommandeTemplate.ajoutLot; 
					
					that.afficherDeleteLot(
							$(this).parents(".produit-div").find(".produit-lots").append(
									that.affectAjoutLot( $(lTemplate.template(lVo)) ))
					);
					
					// Remise à zéro du formulaire
					inpTaille.val('');
					inpPrix.val('');
				} else {
					Infobulle.generer(lVr,"ajout-lot-produit-" + lVo.idProduit + "-");
				}
			});
		return pData;
	}
	
	this.editProduit = function(pData) {
		var that = this;
		
		pData.find('.edit-nom-pdt-creation-commande-valid').click(function() {
			var lVo = new ProduitCommandeVO();
			var lId = $(this).closest(".produit-div");			
			lVo.idProducteur = $(lId).find(':input[name=producteur]').val();
			lVo.idNom = $(lId).find(".produit-id").text();
			lVo.nom = $(lId).find(".produit-nom").text();
			lVo.unite = $(lId).find(":input[name=unite]").val();
			lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
			lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
			
			var lValid = new ProduitCommandeValid();
			var lVr = lValid.validAjout(lVo,'simple');
			
			if(lVr.valid) {
				Infobulle.init();
				
				var lNomProducteur = $(lId).find(':input[name=producteur]').selectedOptions().text();
				$(lId).find('#nom-producteur').text(lNomProducteur);
				
				var lStock = parseFloat(lVo.qteRestante).nombreFormate(2,',',' ');
				$(lId).find('.produit-stock').text(lStock);
				$(lId).find(":input[name=stock]").val(lStock)
				
				var lQteMax = parseFloat(lVo.qteMaxCommande).nombreFormate(2,',',' ');
				$(lId).find('.produit-qmax').text(lQteMax);
				$(lId).find(":input[name=qmax]").val(lQteMax)
				
				$(lId).find('.produit-unite').text(lVo.unite);
				var lDivParent = $(this).parentsUntil('#liste_produit');
    			lDivParent.find('.produit-unite').text(lVo.unite);
				
				pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
				that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
			}
			
		});
		
		pData.find('.edit-nom-pdt-creation-commande-edit').click(function() {
			that.mEditionEnCours++;
			pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
			
		pData.find(".edit-lot-creation-commande-valid").click( function () {
			var lVo = new DetailCommandeVO();
			var lId = $(this).closest(".produit-lot");
			
			lVo.id = $(lId).find(".lot-id").text();
			lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
			lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
			lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
			
			var lValid = new DetailCommandeValid();
			var lVr = lValid.validAjout(lVo);
			
			if(lVr.valid) {	
				Infobulle.init();
				
				var lTaille = lVo.taille.nombreFormate(2,',',' ');
				$(lId).find(".produit-taille").text(lTaille);
				$(lId).find(":input[name=taille]").val(lTaille);
				
				var lPrix = lVo.prix.nombreFormate(2,',',' ');
				$(lId).find(".produit-prix").text(lPrix);
				$(lId).find(":input[name=prix]").val(lPrix);
				
				pData.find('.edit-lot-creation-commande, .pdt-' + lVo.idProduit + '-lot-' + lVo.id).toggle();
				that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
			}
		});		

		pData.find(".edit-lot-creation-commande-edit").click( function () {			
			var lIdPdt = $(this).closest('.produit-div').find('.produit-id').text();
			var lIdLot = $(this).closest('.produit-lot').find('.lot-id').text();			
			pData.find('.edit-lot-creation-commande, .pdt-' + lIdPdt + '-lot-' + lIdLot).toggle();
			that.mEditionEnCours++;
		});		
		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().parent().remove();
				that.afficherDeleteLot(lListeProduit);
			});
		return pData;
	}
	
	this.afficherDeleteLot = function(pData) {	
		if( pData.children('.produit-lot').size() < 2 ) {
			pData.find('.delete-lot').hide();
		} else {
			pData.find('.delete-lot').show();
		}		
		return pData;
	}
	
	this.affectDialogCreerProduit = function(pData) {
		var that = this;
		pData.find('#btn-creer-nv-pdt')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogAjoutProduit;
			
			$(lTemplate).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer le produit': function() {
						var lForm = $(this).children('form').first();
						that.CreerProduit(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProduit($(this));
				return false;
			});			
		});		
		return pData;
	}
	
	this.CreerProduit = function(pForm) {
		var lVo = new NomProduitVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		lVo.idCategorie = 1; // TODO faire une gestion avec categorie
		
		var lValid = new NomProduitValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {form:1,nomProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {							
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						// Ajout dans la liste du select avec son ID
						var lNomPdt = [];
						lNomPdt[lResponse.id] = lResponse.nom;
						$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(lNomPdt).sortOptions();
						$("#dialog-form-creer-nv-pdt").dialog('close');
					} else {
						Infobulle.generer(lResponse,'nom-pdt-');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'nom-pdt-');
		}
	}
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut',pData);
		return pData;
	}
	
	this.construct(pParam);
	
}