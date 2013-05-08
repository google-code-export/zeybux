;function StockProduitVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {StockProduitVue(pParam);}} );
		var that = this;
		pParam.fonction ="detailFerme";
		$.post(	"./index.php?m=GestionCommande&v=StockProduit", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}	
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lHtml = '';
		if(lResponse.listeProduit.length > 0 && lResponse.listeProduit[0].cproNom != null) {
			var lIdCategorie = lResponse.listeProduit[0].cproId;
			var lIdCategorieInit = lIdCategorie;
			var lNomCategorie = lResponse.listeProduit[0].cproNom;
			var lStockTrie = [];
			var lProduits = [];
			lResponse.ferNom = lResponse.listeProduit[0].ferNom;
			$(lResponse.listeProduit).each(function() {
				if(this.stoQteQuantite != null)  {
					this.stoQteQuantiteTotal = (parseFloat(this.stoQteQuantite) + parseFloat(this.stoQteQuantiteSolidaire)).toFixed(2).nombreFormate(2,',',' ');
					
					this.stoQteQuantiteAffiche = this.stoQteQuantite.nombreFormate(2,',',' ');
					this.stoQteQuantite = this.stoQteQuantite.nombreFormate(2,',','');
					
					this.stoQteQuantiteSolidaireAffiche = this.stoQteQuantiteSolidaire.nombreFormate(2,',',' ');
					this.stoQteQuantiteSolidaire = this.stoQteQuantiteSolidaire.nombreFormate(2,',','');
					this.btnEdition = lGestionCommandeTemplate.listeStockProduitFermeDetailBtnEdition.template({stoQteId:this.stoQteId});
				} else {
					this.stoQteQuantiteTotal = '0'.nombreFormate(2,',',' ');
					this.stoQteQuantiteSolidaire = '0'.nombreFormate(2,',',' ');
					this.stoQteQuantiteSolidaireAffiche = this.stoQteQuantiteSolidaire;
					this.stoQteQuantite = '0'.nombreFormate(2,',',' ');
					this.stoQteQuantiteAffiche = this.stoQteQuantite;
					this.stoQteUnite = '';
					this.btnEdition =  '';
				}
				
				lProduits.push(this);
				
				if(lIdCategorie != this.cproId) {
					lStockTrie.push({
							cproNom:lNomCategorie,
							produits:lProduits
						});			
					lIdCategorie = this.cproId;
					lNomCategorie = this.cproNom;
					lProduits = [];
				} 
			});
			// Si il n'y a qu'une catégorie il faut l'ajouter
			if(lIdCategorieInit == lIdCategorie) {
				lStockTrie.push({
					cproNom:lResponse.listeProduit[0].cproNom,
					produits:lProduits
				});
			}
			lResponse.listeProduit = lStockTrie;
			lHtml = lGestionCommandeTemplate.listeStockProduitFermeDetail.template(lResponse);
			//$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			lHtml = lGestionCommandeTemplate.listeStockProduitFermeDetailVide;
		//	$('#contenu').replaceWith(that.affect($(lGestionCommandeTemplate.listeFermeVide)));
		}
		$('#contenu').replaceWith(that.affect($(lGestionCommandeTemplate.listeStockProduitFermeEntete.template({detail:lHtml}))));
		
	};
	
	this.affect = function(pData) {
		/*pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectDetailFerme(pData);	*/	
		pData = this.affectEdition(pData);
		pData = this.affectRetour(pData);
		pData = this.affectCalculTotal(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData,{allowNegatives:true});
		return pData;
	};
	
	this.affectRetour = function(pData) {
		pData.find('#btn-retour').click(StockProduitListeFermeVue);
		return pData;
	};
	
	this.affectEdition = function(pData) {
		var that = this;
		pData.find('.btn-modif, .btn-annuler').click(function() {
			var lId = $(this).data("id");
			$('.produit-' + lId +', #btn-modif-'  + lId + ', #btn-annuler-'  + lId + ', #btn-check-' + lId).toggle();
		});
		pData.find('.btn-check').click(function() {
			that.enregistrer($(this).data("id"));
		});
		return pData;
	};

	this.enregistrer = function(pId) {
		var lVo = new StockQuantiteVO();
		lVo.id = pId;
		lVo.quantite = $('#' + pId + '-quantite').val().numberFrToDb();
		lVo.quantiteSolidaire = $('#' + pId + '-quantiteSolidaire').val().numberFrToDb();
		
		var lValid = new StockQuantiteValid();
		var lVr = lValid.validUpdate(lVo);
				
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "modifierStock";
			$.post(	"./index.php?m=GestionCommande&v=StockProduit", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse && lResponse.valid) {
							// Maj des champs
							var lQte = parseFloat(lVo.quantite);
							if(isNaN(lQte) || lQte == '') {
								lQte = 0;
							}
							var lQteSolidaire = parseFloat(lVo.quantiteSolidaire);
							if(isNaN(lQteSolidaire) || lQteSolidaire == '') {
								lQteSolidaire = 0;
							}
							
							$('#label-quantite-total-' + pId).text(( lQte + lQteSolidaire ).toFixed(2).nombreFormate(2,',',' '));
							$('#label-quantite-' + pId ).text(lVo.quantite.nombreFormate(2,',',' '));
							$('#label-quantite-solidaire-' + pId).text(lVo.quantiteSolidaire.nombreFormate(2,',',' '));
							$('.produit-' + pId +', #btn-modif-'  + pId + ', #btn-annuler-'  + pId + ', #btn-check-' + pId).toggle();
							
							// Message de confirmation
							var lMsg = new TemplateVR();
							lMsg.valid = false;
							lMsg.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_361_CODE;
							erreur.message = ERR_361_MSG;
							lMsg.log.erreurs.push(erreur);
							Infobulle.generer(lMsg, '');
						} else {
							Infobulle.generer(lResponse, pId + '-');
						}
					}
			},"json");
		} else {
			Infobulle.generer(lVr, pId + '-');
		}
	};
	
	this.affectCalculTotal = function(pData) {
		pData.find('.com-ligne-hover :input').keyup(function() {
			var lId = $(this).data("id");
			
			var lQte = parseFloat($('#' + lId + '-quantite').val().numberFrToDb());
			if(isNaN(lQte) || lQte == '') {
				lQte = 0;
			}
			var lQteSolidaire = parseFloat($('#' + lId + '-quantiteSolidaire').val().numberFrToDb() );
			if(isNaN(lQteSolidaire) || lQteSolidaire == '') {
				lQteSolidaire = 0;
			}
			
			$('#label-quantite-total-edit-' + lId).text( ( lQte + lQteSolidaire ).toFixed(2).nombreFormate(2,',',' '));
		});
		return pData;
	};
		
	this.construct(pParam);
};