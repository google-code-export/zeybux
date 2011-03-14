function GestionListeCommandeVue() {
	this.construct = function() {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		if(lResponse.listeCommande.length > 0 && lResponse.listeCommande[0].comId != null) {
		
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
	
					lListeCommande.commande.push(lCommande);
				});
			
			var lTemplate = lGestionCommandeTemplate.listeCommandePage;
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeCommande))));
		} else {
			$('#contenu').replaceWith(lGestionCommandeTemplate.listeCommandeVide);
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectLienEditer(pData);
		pData = this.affectLienMarche(pData);
		return pData;
	}
	
	this.affectLienEditer = function(pData) {
		pData.find('.btn-editer').click(function() {
			var lparam = {"id_commande":$(this).attr('id')};
			EditerCommandeVue(lparam);
		});
		return pData;
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.btn-marche').click(function() {
			var lPage = new MarcheCommandeVue();
			lPage.construct($(this).attr('id'));
		});
		return pData;
	}
	
	this.construct();
}function ModifierCommandeVue(pParam) {
	
	this.etapeCreationCommande = 0;
	this.mCommunVue = new CommunVue();
	this.commande = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ModifierCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
			//alert(lResponse);/*
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}		// */			
					},"json"
				);		
	}
	
	this.afficher = function(pResponse) {
		var that = this;

		var lInfoCommande = pResponse.commande[0];
		pResponse.sigleMonetaire = gSigleMonetaire;
		pResponse.comId = lInfoCommande.comId;
		pResponse.comNom = lInfoCommande.comNom;
		pResponse.comNumero = lInfoCommande.comNumero;
		pResponse.comDescription = lInfoCommande.comDescription;
		pResponse.dateTimeFinReservation = lInfoCommande.comDateFinReservation.extractDbDate().dateDbToFr();
		pResponse.heureFinReservation = lInfoCommande.comDateFinReservation.extractDbHeure();
		pResponse.minuteFinReservation = lInfoCommande.comDateFinReservation.extractDbMinute();
		pResponse.dateMarcheDebut = lInfoCommande.comDateMarcheDebut.extractDbDate().dateDbToFr();
		pResponse.heureMarcheDebut = lInfoCommande.comDateMarcheDebut.extractDbHeure();
		pResponse.minuteMarcheDebut = lInfoCommande.comDateMarcheDebut.extractDbMinute();
		pResponse.heureMarcheFin = lInfoCommande.comDateMarcheFin.extractDbHeure();
		pResponse.minuteMarcheFin = lInfoCommande.comDateMarcheFin.extractDbMinute();
		/*that.infoCommande.comId = lResponse.commande[0].comId;
		that.infoCommande.comArchive = lResponse.commande[0].comArchive;
		*/
		this.commande = pResponse;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.formulaireModifierCommande;
		
		
		var lData = that.affect($(lTemplate.template(pResponse)));
				
		pResponse.pdtCommande = [];		
		$(pResponse.commande).each(function() {
			var lLot = {
					dcomId:this.dcomId,
					dcomTaille:this.dcomTaille.nombreFormate(2,',',' '),
					dcomPrix:this.dcomPrix.nombreFormate(2,',',' ')};
			
			if(pResponse.pdtCommande[this.proId]) {
				pResponse.pdtCommande[this.proId].lots[this.dcomId] = lLot;
			} else {			
				var lProduit = {
						proId:this.proId,
						proUniteMesure:this.proUniteMesure,
						proMaxProduitCommande:this.proMaxProduitCommande.nombreFormate(2,',',' '),
						proIdNomProduit:this.proIdNomProduit,
						nproNom:this.nproNom,
						lots:[]};
				lProduit.lots[this.dcomId] = lLot;
				
				$(pResponse.stockInitiaux).each(function() {
					if(this.idProduit == lProduit.proId) {
						lProduit.quantiteInit = this.quantite.nombreFormate(2,',',' ');
					}					
				});
				
				pResponse.pdtCommande[this.proId] = lProduit;
			}
		});
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.ajoutProduitModifierCommande;
		$(pResponse.pdtCommande).each(function() {
			//lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
			if(this.proId != undefined) {
				this.sigleMonetaire = gSigleMonetaire;
				
				var lHtml = that.affectNouveauProduit($(lTemplate.template(this)));
				var pdt = this;
				$(this.lots).each(function() {
					if(this.dcomId != undefined) {
						var lLot = {lots:[{
							id:this.dcomId,
							taille:this.dcomTaille,
							prix:this.dcomPrix,
							unite:pdt.proUniteMesure}],
							siglemonetaire:gSigleMonetaire};
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lGestionCommandeTemplate.ajoutLotModifPdt.template(lLot)) ));
					}
				});
				
				//lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lGestionCommandeTemplate.ajoutLotAjoutPdt.template(lVo)) ));
					
				//$("#liste_produit").append(lHtml);
				
				
				//lData.find("#liste_produit").append(that.afficherDeleteLot(that.affectNouveauProduit($(lTemplate.template(this)))));
				lData.find("#liste_produit").append(that.afficherDeleteLot($(lHtml)));
			}
		});
		
		$('#contenu').replaceWith(lData);
	}
	
	this.affectSelectHeure = function(pData) {
		var that = this;
		pData.find(':input[name=heure_fin_commande]').selectOptions(that.commande.heureFinReservation);
		pData.find(':input[name=minute_fin_commande]').selectOptions(that.commande.minuteFinReservation);
		pData.find(':input[name=heure_debut_marche]').selectOptions(that.commande.heureMarcheDebut);
		pData.find(':input[name=minute_debut_marche]').selectOptions(that.commande.minuteMarcheDebut);
		pData.find(':input[name=heure_fin_marche]').selectOptions(that.commande.heureMarcheFin);
		pData.find(':input[name=minute_fin_marche]').selectOptions(that.commande.minuteMarcheFin);
		return pData;
	}
	
	
	this.affect = function(pData) {
		pData = this.affectAjoutProduit(pData);
		pData = this.affectCreerCommande(pData);
		pData = this.affectModifierCommande(pData);
		pData = this.affectDialogCreerProduit(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectSelectHeure(pData);
		return pData;
	}
		
	this.affectNouveauProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
	//	pData = this.affectAjoutLot(pData);
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
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);

					var lValid = new ProduitCommandeValid();
					var lVr = lValid.validAjout(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitModifierCommande;						
						
						lVo.proIdNomProduit = lVo.idNom;						
						lVo.nproNom = lVo.nom;
						lVo.proUniteMesure = lVo.unite;
						lVo.proMaxProduitCommande = lVo.qteMaxCommande;
						lVo.quantiteInit = lVo.qteRestante;
						lVo.proId = lVo.idNom * -1;
						
						lVo.lots = new Array();
						lVo.lots.push({	id:0,
										taille:lVoLot.taille.nombreFormate(2,',',' '),
										prix:lVoLot.prix.nombreFormate(2,',',' ')});

						lVo.siglemonetaire = gSigleMonetaire;
						
						var lHtml = that.affectNouveauProduit($(lTemplate.template(lVo)));
						
						lTemplate = lGestionCommandeTemplate.ajoutLotAjoutPdt; 
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lTemplate.template(lVo)) ));
							
						$("#liste_produit").append(lHtml); // Insertion dans la page	
							
						//$("#liste_produit").append(that.affectNouveauProduit($(lTemplate.template(lVo)))); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						
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
				var lValidCommande = true;
				$("#liste_produit").find(":button").each(function() {
					if($(this).text() == gTextValider) {
						lValidCommande = false;
					}
				});
				
				if(lValidCommande) {
					// Récupération des données
					var lVo = new CommandeCompleteVO();
					lVo.id = that.commande.comId;
					lVo.numero = that.commande.comNumero;
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
								lVoProduit.id = $(this).find('.produit-id').text();	
								lVoProduit.idNom = $(this).find('.produit-nom-id').text();
								lVoProduit.unite = $(this).find(':input[name=unite]').val();
								lVoProduit.qteMaxCommande = $(this).find(':input[name=qmax]').val().numberFrToDb();
								lVoProduit.qteRestante = $(this).find(':input[name=stock]').val().numberFrToDb();
								
								$(this).find('.produit-lot').each(
										function () {
											// Récupération des lots
											var lVoLot = new DetailCommandeVO();
											lVoLot.id = $(this).find('.lot-id').text();
											lVoLot.taille = $(this).find(':input[name=taille]').val().numberFrToDb();
											lVoLot.prix = $(this).find(':input[name=prix]').val().numberFrToDb();
											lVoProduit.lots.push(lVoLot);										
										});													
								
								lVo.produits.push(lVoProduit);								
							});	
					
					if(that.etapeCreationCommande == 0) {
						var lValid = new CommandeCompleteValid();
						var lVR = lValid.validUpdate(lVo);
							
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide(); //"blind",gTempsTransitionUnique
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
						// TODO l'enregistrement
						//var lVo = $.toJSON(lVo);
						var lParam = {form:2,commande:lVo};
						$.post(	"./index.php?m=GestionCommande&v=ModifierCommande", "pParam=" + $.toJSON(lParam),
								//"commande=" + $.toJSON(lVo) + "&form=2",
								function (lVoRetour) {	
							//alert(lVoRetour); /*
									if(lVoRetour.valid) {
										lVoRetour.numero = that.commande.comNumero;
										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.modifCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lVoRetour));
									} else {
										that.modifierCommandeFunction();
										Infobulle.generer(lVoRetour,"commande-");
									}
									that.etapeCreationCommande = 0; //*/
								},"json"
						);//*/
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
					
					var lMinId = Array.min(lListeId);
					if(lMinId < 0) {
						lVo.id = lMinId-1;
					} else {
						lVo.id = -1;
					}
					
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
			lVo.idNom = $(lId).find(".produit-nom-id").text();
			lVo.nom = $(lId).find(".produit-nom").text();
			lVo.unite = $(lId).find(":input[name=unite]").val();
			lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
			lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
			
			var lValid = new ProduitCommandeValid();
			var lVr = lValid.validAjout(lVo,'simple');
			
			if(lVr.valid) {
				Infobulle.init();
				$(this).parent().find(":input[name=qmax]").inputToText("montant");
				$(this).parent().find(":input[name=stock]").inputToText("montant");
				$(this).parent().find(":input[name=unite]").inputToText();
				var lDivParent = $(this).parentsUntil('#liste_produit');
    			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    			pData.find('.edit-nom-pdt-creation-commande').toggle();
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
			}
			
		});		
		pData.find('.edit-nom-pdt-creation-commande-edit').click(function() {
			$(this).parent().children(':input:not(:button,:submit)').each(
					function () { $(this).textToInput(); });
			pData.find('.edit-nom-pdt-creation-commande').toggle();
		});
		
		/*pData.find('.edit-nom-pdt-creation-commande').click(function() {
				pData.find('.edit-nom-pdt-creation-commande').toggle();
		});*/
		/*
		pData.find('.edit-nom-pdt-creation-commande').click(
    		function () {
    			if($(this).text() == gTextEdition) {
    				$(this).text(gTextValider);
    				$(this).parent().children(':input:not(:button,:submit)').each(
    						function () { $(this).textToInput(); });
    			} else {    				
    				var lVo = new ProduitCommandeVO();
    				var lId = $(this).parentsUntil(".produit-div");    				
    				lVo.idNom = $(lId).find(".produit-id").text();
    				lVo.nom = $(lId).find(".produit-nom").text();
    				lVo.unite = $(lId).find(":input[name=unite]").val();
    				lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
    				lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	

    				var lValid = new ProduitCommandeValid();
    				var lVr = lValid.validAjout(lVo,'simple');
    				
    				if(lVr.valid) {
    					Infobulle.init();
	    				$(this).text(gTextEdition);
	    				$(this).parent().children(':input:not(:button,:submit)').each(
	    						function () { $(this).inputToText(); });
	    				var lDivParent = $(this).parentsUntil('#liste_produit');
	        			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    				} else {
    					Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
    				}
    			}
    		});*/
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
		
		/*pData.find(".edit-lot-creation-commande").click( function () {
			pData.find(".edit-lot-creation-commande").toggle();
		});*/
		
		pData.find(".edit-lot-creation-commande-edit").click( function () {
			$(this).parent().parent().children(':input:not(:button,:submit)').each(
					function () { $(this).textToInput(); });
			pData.find(".edit-lot-creation-commande").toggle();
		});
		
		pData.find(".edit-lot-creation-commande-valid").click( function () {
			var lVo = new DetailCommandeVO();
			var lId = $(this).closest(".produit-lot");
			
			lVo.id = $(lId).find(".lot-id").text();
			lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
			lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
			lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();

			//var lVr = that.mControleur.validAjoutLot(lVo);
			var lValid = new DetailCommandeValid();
			var lVr = lValid.validAjout(lVo);
			
			if(lVr.valid) {	
				Infobulle.init();
				$(this).parent().parent().find(":input[name='taille']").inputToText();
				$(this).parent().parent().find(":input[name='prix']").inputToText("montant");
				pData.find(".edit-lot-creation-commande").toggle();
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
			}
		});
		
		/*pData.find(".edit-lot-creation-commande").click( function () {
			if($(this).text() == gTextEdition) {
				$(this).text(gTextValider);
				$(this).parent().children(':input:not(:button,:submit)').each(
						function () { $(this).textToInput(); });
			} else {
				
				
				var lVo = new DetailCommandeVO();
				var lId = $(this).parent(".produit-lot");
				
				lVo.id = $(lId).find(".lot-id").text();
				lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
				lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
				lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();

				var lValid = new DetailCommandeValid();
				var lVr = lValid.validAjout(lVo);
				
				if(lVr.valid) {	
					Infobulle.init();
					$(this).text(gTextEdition);
					$(this).parent().find(":input[name='taille']").inputToText();
					$(this).parent().find(":input[name='prix']").inputToText("montant");
				} else {
					Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
				}
			}});*/
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
		if( pData.find('.produit-lot').size() < 2 ) {
			pData.find('.delete-lot').hide();
		} else {
			pData.find('.delete-lot').show();
		}		
		return pData;
	}
	
	this.affectDialogCreerProduit = function(pData) {
		pData.find("#dialog-form-creer-nv-pdt").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Créer le produit': function() {
					var that = this;
					var lVo = new NomProduitVO();
					var lForm = $(this).children('form').first();
					lVo.nom = lForm.find(':input[name=nom]').val();
					lVo.description = lForm.find(':input[name=description]').val();
					lVo.idCategorie = 1; // TODO faire une gestion avec categorie
					
    				var lValid = new NomProduitValid();
    				var lVr = lValid.validAjout(lVo);
					
					if(lVr.valid) {	
						Infobulle.init();
						//alert('ok');
						var lParam = {form:1,nomProduit:lVo};
						// Ajout
						$.post(	"./index.php?m=GestionCommande&v=ModifierCommande", "pParam=" + $.toJSON(lParam),
							function (lResponse) {	
							//alert(lResponse); /*								
								if(lResponse.valid) {
									Infobulle.init(); // Supprime les erreurs
									// Ajout dans la liste du select avec son ID
									var lNomPdt = [];
									lNomPdt[lResponse.id] = lResponse.nom;
									$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(lNomPdt).sortOptions();
									$(that).dialog('close');
								} else {
									Infobulle.generer(lResponse,'nom-pdt-');
								} //*/
							},"json"
						);
					} else {
						Infobulle.generer(lVr,'nom-pdt-');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				$(this).children('form').first().find(':input').val('');
				Infobulle.init(); // Supprime les erreurs
			}
		});

		pData.find('#btn-creer-nv-pdt')
		//.button()
		.click(function() {
			$('#dialog-form-creer-nv-pdt').dialog('open');
		});
		return pData;
	}
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut',pData);
		return pData;
	}
	
	this.construct(pParam);
	
}function AjoutCommandeVue() {
	
	this.etapeCreationCommande = 0;
	this.mCommunVue = new CommunVue();
	//this.mControleur = new AjoutCommandeControleur();
	
	this.construct = function() {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
				function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}					
					},"json"
				);		
	}
	
	this.afficher = function(pResponse) {
		var that = this;
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
		return pData;
	}
		
	this.affectNouveauProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
	//	pData = this.affectAjoutLot(pData);
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
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);
								
					//var lVr = that.mControleur.validAjoutProduit(lVo);
					var lValid = new ProduitCommandeValid();
					var lVr = lValid.validAjout(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.lots[0].taille = parseFloat(lVo.lots[0].taille).nombreFormate(2,',',' ');
						lVo.lots[0].id = 0;
						lVo.siglemonetaire = gSigleMonetaire;
						
						var lHtml = that.affectNouveauProduit($(lTemplate.template(lVo)));
						
						lTemplate = lGestionCommandeTemplate.ajoutLotAjoutPdt; 
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lTemplate.template(lVo)) ));
							
						$("#liste_produit").append(lHtml); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						
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
				var lValidCommande = true;
				$("#liste_produit").find(":button").each(function() {
					if($(this).text() == gTextValider) {
						lValidCommande = false;
					}
				});
				
				if(lValidCommande) {
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
						
						//var lVR = that.mControleur.valid(lVo);
						var lValid = new CommandeCompleteValid();
						var lVR = lValid.validAjout(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide(); //"blind",gTempsTransitionUnique
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
				
				//var lVr = that.mControleur.validAjoutLot(lVo);
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
			lVo.idNom = $(lId).find(".produit-id").text();
			lVo.nom = $(lId).find(".produit-nom").text();
			lVo.unite = $(lId).find(":input[name=unite]").val();
			lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
			lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
			
			//var lVr = that.mControleur.validAjoutProduitSimple(lVo);
			var lValid = new ProduitCommandeValid();
			var lVr = lValid.validAjout(lVo,'simple');
			
			if(lVr.valid) {
				Infobulle.init();
				$(this).parent().find(":input[name=qmax]").inputToText("montant");
				$(this).parent().find(":input[name=stock]").inputToText("montant");
				$(this).parent().find(":input[name=unite]").inputToText();
				var lDivParent = $(this).parentsUntil('#liste_produit');
    			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    			pData.find('.edit-nom-pdt-creation-commande').toggle();
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
			}
			
		});		
		pData.find('.edit-nom-pdt-creation-commande-edit').click(function() {
			$(this).parent().children(':input:not(:button,:submit)').each(
					function () { $(this).textToInput(); });
			pData.find('.edit-nom-pdt-creation-commande').toggle();
		});
		/*pData.find('.edit-nom-pdt-creation-commande').click(function() {
				pData.find('.edit-nom-pdt-creation-commande').toggle();
		});*/
		
	/*	pData.find('.edit-nom-pdt-creation-commande').click(
    		function () {
    			if($(this).text() == gTextEdition) {
    				$(this).text(gTextValider);
    				$(this).parent().children(':input:not(:button,:submit)').each(
    						function () { $(this).textToInput(); });
    			} else {    				
    				var lVo = new ProduitCommandeVO();
    				var lId = $(this).parentsUntil(".produit-div");    				
    				lVo.idNom = $(lId).find(".produit-id").text();
    				lVo.nom = $(lId).find(".produit-nom").text();
    				lVo.unite = $(lId).find(":input[name=unite]").val();
    				lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
    				lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
    				
    				var lVr = that.mControleur.validAjoutProduitSimple(lVo);
    				
    				if(lVr.valid) {
    					Infobulle.init();
	    				$(this).text(gTextEdition);
	    				$(this).parent().children(':input:not(:button,:submit)').each(
	    						function () { $(this).inputToText(); });
	    				var lDivParent = $(this).parentsUntil('#liste_produit');
	        			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    				} else {
    					Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
    				}
    			}
    		});*/
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
	/*	pData.find(".edit-lot-creation-commande").click( function () {
			pData.find(".edit-lot-creation-commande").toggle();
		});*/
		
		pData.find(".edit-lot-creation-commande-edit").click( function () {
			$(this).parent().parent().children(':input:not(:button,:submit)').each(
					function () { $(this).textToInput(); });
			pData.find(".edit-lot-creation-commande").toggle();
		});
		
		pData.find(".edit-lot-creation-commande-valid").click( function () {
			var lVo = new DetailCommandeVO();
			var lId = $(this).closest(".produit-lot");
			
			lVo.id = $(lId).find(".lot-id").text();
			lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
			lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
			lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
			
			//var lVr = that.mControleur.validAjoutLot(lVo);
			var lValid = new DetailCommandeValid();
			var lVr = lValid.validAjout(lVo);
			
			if(lVr.valid) {	
				Infobulle.init();
				$(this).parent().parent().find(":input[name='taille']").inputToText();
				$(this).parent().parent().find(":input[name='prix']").inputToText("montant");
				pData.find(".edit-lot-creation-commande").toggle();
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
			}
		});
		
		/*pData.find(".edit-lot-creation-commande").click( function () {
			if($(this).text() == gTextEdition) {
				$(this).text(gTextValider);
				$(this).parent().children(':input:not(:button,:submit)').each(
						function () { $(this).textToInput(); });
			} else {
				
				
				var lVo = new DetailCommandeVO();
				var lId = $(this).parent(".produit-lot");
				
				lVo.id = $(lId).find(".lot-id").text();
				lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
				lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
				lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {	
					Infobulle.init();
					$(this).text(gTextEdition);
					$(this).parent().find(":input[name='taille']").inputToText();
					$(this).parent().find(":input[name='prix']").inputToText("montant");
				} else {
					Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
				}
			}});*/
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
		pData.find("#dialog-form-creer-nv-pdt").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Créer le produit': function() {			
					var lForm = $(this).children('form').first();
					var lNom = lForm.find(':input[name=nom]');
					var lValid = true;
					
					$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
					lForm.find(':input').removeClass('ui-state-error');			
	
					lValid = lNom.checkLength(1,50); // Longueur du nom
					
					if(lValid) {						
						// Ajout
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								lForm.serialize() + "&form=1",
							function (retour) {		
							
								/* Traitement du retour */
							// TODO Vérifier en fonctionnel si il n'existe pas déjà un produit de ce type
							if(retour.succes == true) {
								// Ajout dans la liste du select avec son ID									
								$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(retour.produit, true).sortOptions();
								$("#dialog-form-creer-nv-pdt").dialog('close');
								
							} else {								
								
								var lTemplate = "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
													"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
													"<strong>Erreur : </strong> L'ajout n'a pas été effectué.<br/>" +
													"<!-- BEGIN erreurs -->" +
													"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
													"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
													"<!-- END erreurs -->" +
													"</p>" +
												"</div>";
								
								$("#dialog-form-creer-nv-pdt").children().first().html(lTemplate.template(retour)).fadeIn(gTempsTransitionUnique);
							}
														
							},
							"json"
						);
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				$(this).children('form').first().find(':input').val('').removeClass('ui-state-error');
				$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
			}
		});

		pData.find('#btn-creer-nv-pdt')
		//.button()
		.click(function() {
			$('#dialog-form-creer-nv-pdt').dialog('open');
		});
		return pData;
	}
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut',pData);
		return pData;
	}
	
	this.construct();
	
}function AchatCommandeVue() {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.listeLot = new Array();
	this.typePaiement = null;
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	
	this.construct = function(pIdCommande, pIdAdherent) {
		var that = this;		
		this.idCommande = pIdCommande;
		this.idAdherent = pIdAdherent;
		
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pIdCommande + "&id_adherent=" + pIdAdherent,
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.idCompte = lResponse.adherent.adhIdCompte;					
						for(lLigne in lResponse.commande) {
							var lLot = new Object();
							lLot.quantite = lResponse.commande[lLigne].dcomTaille;
							lLot.prix = lResponse.commande[lLigne].dcomPrix						
							if(!that.listeLot[lResponse.commande[lLigne].proId]) {
								if(!isArray(that.listeLot[lResponse.commande[lLigne].proId])) {
									that.listeLot[lResponse.commande[lLigne].proId] = new Array();
								}
							}
							that.listeLot[lResponse.commande[lLigne].proId].push(lLot);
						}
						var lTpp = new Array();
						for(lIndice in lResponse.typePaiement) {
							lTpp[lResponse.typePaiement[lIndice].id] = lResponse.typePaiement[lIndice];
						}
						that.typePaiement = lTpp;	
						that.solde = parseFloat(lResponse.adherent.opeMontant);
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}					
				},"json"
		);
		//var lResponse;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			var that = this;
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.achatCommandePage;
			
			var lData = new Object();
			lData.comNumero = pResponse.commande[0].comNumero;
			
			lData.adhNumero = pResponse.adherent.adhNumero;
			lData.adhCompte = pResponse.adherent.cptLabel;
			lData.adhNom = pResponse.adherent.adhNom;
			lData.adhPrenom = pResponse.adherent.adhPrenom;
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			
			lData.produits = new Array();
			lListeIdProduit = new Array();
			for(lLigne in pResponse.commande) {
				lPush = true;
				for(lId in lListeIdProduit) {
					if(lListeIdProduit[lId] == pResponse.commande[lLigne].proId) {
						lPush = false;
					}
				}
				if(lPush) {
					lListeIdProduit.push(pResponse.commande[lLigne].proId);
					var lProduit = new Object();
					lProduit.proId = pResponse.commande[lLigne].proId;
					lProduit.nproNom = pResponse.commande[lLigne].nproNom;
					lProduit.proUniteMesure = pResponse.commande[lLigne].proUniteMesure;
					lProduit.stoQuantite = 0;
					lProduit.proPrix = 0;
					var lPrix = 0;
					for(lReservation in pResponse.reservation) {
						if(pResponse.reservation[lReservation].proId == lProduit.proId) {
							lProduit.stoQuantite = pResponse.reservation[lReservation].stoQuantite * -1;
							lPrix = this.calculPrixProduit(lProduit.proId,lProduit.stoQuantite);
							lProduit.proPrix = lPrix.nombreFormate(2,',',' ');
						}						
					}
					lData.total += lPrix;
					lData.produits.push(lProduit);
				}
			}
			lData.adhSolde = parseFloat(pResponse.adherent.opeMontant);
			lData.adhNouveauSolde =  lData.adhSolde-lData.total;
			
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');
			lData.adhNouveauSolde = lData.adhNouveauSolde.nombreFormate(2,',',' ');
			lData.total = lData.total.nombreFormate(2,',',' ');
			
			lData.typePaiement = pResponse.typePaiement;
			
			$('#contenu').replaceWith( that.affect($(lTemplate.template(lData))) );
			that.changerTypePaiement($(":input[name=typepaiement]"));
			that.majNouveauSolde();
		} else {
			Infobulle.generer(pResponse,'');
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectNouveauPrixProduit(pData);
		pData = this.affectChampComplementaire(pData);
		pData = this.affectValider(pData);
		pData = this.affectAnnuler(pData);
		pData = this.affectModifier(pData);
		return pData;
	}
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {that.changerTypePaiement($(this))});
		return pData;
	}
	
	this.affectNouveauSolde = function(pData) {
		var that = this;
		pData.find(":input[name=montant-rechargement], .produit-prix").keyup(function() {
			that.majNouveauSolde();	
			that.controlerAchat();
		});
		return pData;
	}
		
	this.affectNouveauPrixProduit = function(pData) {
		var that = this;
		pData.find(".produit-quantite").keyup(function() {
				that.majPrixProduit($(this));
				that.controlerAchat();
		});
		return pData;
	}
	
	this.affectChampComplementaire = function(pData) {
		var that = this;
		pData.find(":input[name=champ-complementaire]").keyup(function() {that.controlerAchat();});		
		return pData;
	}
	
	this.affectValider = function(pData) {
		var that = this;
		pData.find("#btn-valider").click(function() {that.creerRecapitulatif();});		
		return pData;
	}
	
	this.affectAnnuler = function(pData) {
		var that = this;
		pData.find("#btn-annuler").click(function() {that.retourListe();});		
		return pData;
	}
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find("#btn-modifier").click(function() {that.boutonModifier();});		
		return pData;
	}
	
	this.majPrixProduit = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		var lIdProduit = ligne.find(".produit-id").text();
		var lNvPrix = this.calculPrixProduit(lIdProduit,lQuantite);		
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		ligne.find(".produit-prix").val(lNvPrix.nombreFormate(2,',',' '));	
		this.majNouveauSolde();	
	}
	
	this.controlerAchat = function() {
		Infobulle.init(); // Supprime les erreurs
		var lValid = new AchatCommandeValid();
		var lVr = lValid.validAjout(this.getAchatCommandeVO());
		Infobulle.generer(lVr,'');
		return lVr;
	}
	
	this.calculPrixProduit = function(pIdProduit,pQuantite) {
		if(this.listeLot[pIdProduit]) {
			var lLots = this.listeLot[pIdProduit];
			var lPrix = 0;
			for(lLot in lLots) {
				if(pQuantite % lLots[lLot].quantite == 0) {
					lPrix = (pQuantite / lLots[lLot].quantite) * lLots[lLot].prix;
				}
			}			
			return lPrix;
		}
		return 0;
	}
	
	this.majTotal = function() {
		var that = this;
		$("#total-achat").text(that.calculerTotal().nombreFormate(2,',',' '));
	}
	
	this.calculerTotal = function() {
		var lTotal = 0;
		$(".produit-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	}
	
	this.majNouveauSolde = function() {
		this.majTotal();		
		var lTotal = this.calculNouveauSolde();
		if(lTotal <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lTotal.nombreFormate(2,',',' '));
	}
	
	this.calculNouveauSolde = function() {
		var lAchats = parseFloat($("#total-achat").text().numberFrToDb());
		if(isNaN(lAchats)) {lAchats = 0;}
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}
		return this.solde - lAchats + lRechargement;
	}
		
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel).show();
			$("#td-champ-complementaire").show();
		} else {
			$("#label-champ-complementaire").text('').hide();
			$(":input[name=champ-complementaire]").val();
			$("#td-champ-complementaire").hide();
		}
	}
		
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.typePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].champComplementaire == 1) {
				return lTpp[pId].labelChampComplementaire;
			}
		}	
		return null;
	}
	
	this.getAchatCommandeVO = function() {
		var lVo = new AchatCommandeVO();
		lVo.id = this.idCommande;
		lVo.idCompte = this.idCompte;
		lVo.produits = this.getProduitsVO();
		lVo.rechargement = this.getRechargementVO();
		return lVo;
	}	
	
	this.getProduitsVO = function() {
		var lVo = new Array();		
		$(".ligne-produit").each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).find(".produit-id").text();			
			var lQuantite = $(this).find(".produit-quantite").val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty()){
				lQuantite = parseFloat(lQuantite);
			}
			lVoProduit.quantite = lQuantite;
			
			var lprix = $(this).find(".produit-prix").val().numberFrToDb();
			if(!isNaN(lprix) && !lprix.isEmpty()){
				lprix = parseFloat(lprix);
			}
			lVoProduit.prix = lprix;
			
			lVo.push(lVoProduit);			
		});		
		return lVo;
	}
	
	this.getRechargementVO = function() {
		var lVo = new RechargementCompteVO();
		lVo.id = this.idCompte;
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		if(!isNaN(lMontant) && !lMontant.isEmpty()){
			lMontant = parseFloat(lMontant);
		}
		lVo.montant = lMontant;
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		if(this.getLabelChamComplementaire(lVo.typePaiement) != null) {
			lVo.champComplementaireObligatoire = 1;
			lVo.champComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lVo.champComplementaireObligatoire = 0;
		}
		return lVo;
	}
	
	this.creerRecapitulatif = function() {
		var lVr = this.controlerAchat();
		if(lVr.valid) {
			if(this.etapeValider == 0) {
				$(".produit-quantite,#rechargementchampComplementaire,#typepaiement").each(function() {$(this).inputToText();});
				$(".produit-prix,#rechargementmontant").each(function() {$(this).inputToText("montant");});
				$("#btn-modifier").show();
				$("#btn-annuler").hide();
				this.etapeValider = 1;
			} else if(this.etapeValider == 1) {
				this.enregistrerAchat();
			}
		}
	}
	
	this.enregistrerAchat = function() {
		var that = this;
		var lVo = this.getAchatCommandeVO();
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","achat=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour.valid) {
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.achatCommandeSucces;
						$('#contenu').replaceWith(that.affectAnnuler($(lTemplate)));
					} else {
						that.boutonModifier();
						Infobulle.generer(lVoRetour,"");
					}
					that.etapeValider = 0;
				},"json"
			);
	}
	
	this.boutonModifier = function() {
		if(this.etapeValider == 1) {
			$(".produit-prix,#rechargementmontant,.produit-quantite,#rechargementchampComplementaire,#typepaiement").each(function() {$(this).textToInput();});
			$("#btn-modifier").hide();
			$("#btn-annuler").show();
			this.etapeValider = 0;
		}
	}
	
	this.retourListe = function() {
		var lMarcheCommandeVue = new MarcheCommandeVue();
		lMarcheCommandeVue.construct(this.idCommande);
	}
}function MarcheCommandeVue() {
	this.idCommande = null;
	
	this.construct = function(pId) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pId,
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
		this.idCommande = pId;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				
				if(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null) {
					var lTemplate = lGestionCommandeTemplate.listeAdherentCommandePage;
					pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
					$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
				} else {
					$('#contenu').replaceWith(lGestionCommandeTemplate.listeMarcheVide);
				}
			} else {
				var lVr = new TemplateVR();
				lVr.valid = false;
				lVr.log.valid = false;				
				var erreur = new VRerreur();
				erreur.code = ERR_211_CODE;
				erreur.message = ERR_211_MSG;
				lVr.log.push(erreur);
				Infobulle.generer(lVr,'');
			}
		} else {
			Infobulle.generer(pResponse,'');
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienAchat(pData);
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
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lVue = new AchatCommandeVue();
			lVue.construct(that.idCommande,$(this).find(".id-adherent").text());
		});
		return pData;
	}	
}function ReservationAdherentVue(pParam) {
	this.mAdherent = null;
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = new Array();
	this.reservationModif = new Array();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
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
				});/*
				$(this.lot).each(function() {
					if(lPdt.stoQuantite % this.dcomTaille == 0) {
						lPdt.prix = (lPdt.stoQuantite / this.dcomTaille) * this.dcomPrix;
					}
				});*/
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
						
						if(that.reservation[lPdt.proId] && (that.reservation[lPdt.proId].stoQuantite % this.dcomTaille == 0)) {
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
		//pData = this.affectDroitEdition(pData);
		pData = this.affectModifierReservation(pData);
		pData = this.affectAnnulerDetailReservation(pData);
		return pData;
	}
	
	/*this.affectDroitEdition = function(pData) {
		// Si la date de fin des réservations est passée on bloque la possibilitée de modifier
		if(!dateTimeEstPLusGrandeEgale(this.infoCommande.dateTimeFinReservation,getDateTimeAujourdhuiDb(),'db')) {
			pData.find('.boutons-edition').hide();
		}
		return pData;
	}*/
	
	this.affectModifier = function(pData) {
		pData = this.affectBtnQte(pData);
		pData = this.affectChangementLot(pData);
		pData = this.affectChangementProduit(pData);
		pData = this.preparerAffichageModifier(pData);
		pData = this.affectValiderReservation(pData);
		pData = this.affectAnnulerReservation(pData);
		pData = this.affectNouveauSolde(pData);
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
				lVoResa.stoQuantite = this.stoQuantite * -1;;
				//lVoResa.stoIdProduit = this.proId;
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
				lParam = {"reservation":lVo,"id_compte":this.mAdherent.adhIdCompte};
				$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
					//alert(lResponse); /*
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
	
	this.construct(pParam);
}function EditerCommandeVue(pParam) {
	this.mNiveau = [];
	this.mIdCommande = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
			//alert(lResponse);/*
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}  //*/
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.editerCommandePage;
		
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
		
		var lData = that.affect($(lTemplate.template(lData)));
		
		// Si il n'y a pas de résa on affiche pas le tableau
		if(!(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null)) {			
			lData.find('#edt-com-recherche').hide();
			lData.find('#edt-com-liste-resa').replaceWith(lGestionCommandeTemplate.listeReservationVide);
		}		
		
		$('#contenu').replaceWith(lData);	
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectNiveau(pData);
		pData = this.affectReservation(pData);
		pData = this.affectModifier(pData);
		pData = this.affectCloturer(pData);
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
				// TODO Modifier l'icone + en -
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
	
	this.affectCloturer = function(pData) {
		var that = this;
		pData.find('#dialog-cloturer-com').dialog({
			autoOpen: false,
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
			}
		});
		
		pData.find('#btn-cloture-com')
		.click(function() {
			$('#dialog-cloturer-com').dialog('open');
		});
		return pData;
	}
	
	this.construct(pParam);
}