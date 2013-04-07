;function MesAchatsDetailVue(pParam) {
//	this.infoCommande = {};
//	this.achats = [];
//	this.achatsSolidaire = [];
//	this.stockSolidaire = [];
	this.pParam = {};
	this.produit = [];
	this.mAchat = {detailAchat:[], detailAchatSolidaire:[]};

	this.construct = function(pParam) {
		$.history( {'vue':function() {MesAchatsDetailVue(pParam);}} );
		var that = this;
		this.pParam = pParam;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=Commande&v=MesAchatsDetail", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.produit = lResponse.detailProduit;
						//	that.infoCommande.comNumero = lResponse.marche.numero;
						//	that.stockSolidaire = lResponse.stockSolidaire;
							$(lResponse.achats).each(function() {
								if(this.detailAchat.length > 0) {
									that.mAchat.detailAchat = this.detailAchat;
								}
								if(this.detailAchatSolidaire.length > 0) {
									that.mAchat.detailAchatSolidaire = this.detailAchatSolidaire;
								}
								that.mAchat.dateAchat = this.dateAchat;
							});
					
							that.afficher();
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.detailAchat;
		
		var lData = {};
		lData.categories = [];
	//	lData.comNumero = this.infoCommande.comNumero;
		lData.sigleMonetaire = gSigleMonetaire;
		lData.total = 0;
		lData.totalSolidaire = 0;
		$.each(that.produit, function() {
			var lProduit = this ;
			$(that.mAchat).each(function() {
				var lAchat = {
				nproNom : lProduit.nproNom ,
				stoQuantite : "", prix : "", proUniteMesure : "", sigleMonetaire : "",
				stoQuantiteSolidaire : "", prixSolidaire : "", proUniteMesureSolidaire : "", sigleMonetaireSolidaire : ""};
				
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
				
			});
		});
		
		lData.dateAchat = that.mAchat.dateAchat.extractDbDate().dateDbToFr();
		
		lData.totalMarche = lData.total + lData.totalSolidaire;
		
		lData.total = lData.total.nombreFormate(2,',',' ');
		lData.totalSolidaire = lData.totalSolidaire.nombreFormate(2,',',' ');
		lData.totalMarche = lData.totalMarche.nombreFormate(2,',',' ');
		
		//lData.achats = [];
		//lData.categories = [];
		
		//lData.achatsSolidaire = [];
		//lData.totalMarche = 0;

		/*$(pResponse.achats).each(function() {
			var lAchat = this;
			var lDataPdtAchat = [];
			var lAchatClassique = false;
			var lAchatSolidaire = false;
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lPdtAchete = false;
					var lAchatPdtSolidaire = false;
					//var lIdProduit = this.id;
					
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					
					lPdt.prix = 0;
					lPdt.stoQuantite = 0;
					
					$.each(this.lots, function() {
						if(this.id) {
							var lIdLot = this.id;
							$(lAchat.detailAchat).each(function() {
								if(this.idDetailCommande == lIdLot) {
									lPdt.stoQuantite = this.quantite * -1;
									lPdt.prix = this.montant * -1;
									lAchatClassique = true;
									lPdtAchete = true;
								}
							});
														
							$(lAchat.detailAchatSolidaire).each(function() {
								if(this.idDetailCommande == lIdLot) {
									lPdt.stoQuantiteSolidaire = this.quantite * -1;
									lPdt.prixSolidaire = this.montant * -1;
									lAchatSolidaire = true;
									lAchatPdtSolidaire = true;
								}
							});
							
						}
					});

					lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
					lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
					

					if(lPdtAchete) {
						if(!lDataPdtAchat[this.idCategorie]) {
							lDataPdtAchat[this.idCategorie] = {nom:this.cproNom,achat:[]};
						}
						lDataPdtAchat[this.idCategorie].achat.push(lPdt);
					
					}
					
					if(lAchatPdtSolidaire) {
						lPdt.stoQuantite = lPdt.stoQuantiteSolidaire.nombreFormate(2,',',' ');		
						lPdt.prix = lPdt.prixSolidaire.nombreFormate(2,',',' ');		
						
						if(!lDataPdtAchat[this.idCategorie]) {
							lDataPdtAchat[this.idCategorie] = {nom:this.cproNom,achat:[]};
						}
						lDataPdtAchat[this.idCategorie].achat.push(lPdt);
						
						//lDataPdtAchat.push(lPdt);
					}
					
					//lDataPdtAchat.push(lPdt);
				}
			});
			
			if(lAchatClassique) {
				var lDataAchat = {	categories:lDataPdtAchat,
									idAchat:this.id.idAchat,
									total:(this.total * -1).nombreFormate(2,',',' ')};				
				
				lData.achats.push(lDataAchat);
				lData.totalMarche += this.total * -1;
			}
			if(lAchatSolidaire) {
				var lDataAchat = {	categories:lDataPdtAchat,
									idAchat:this.id.idAchat,
									totalSolidaire:(this.totalSolidaire * -1).nombreFormate(2,',',' ')};
				lData.achatsSolidaire.push(lDataAchat);
				lData.totalMarche += this.totalSolidaire * -1;
			}
		});

	/*	$(pResponse.achats).each(function() {
			var lAchat = this;
			var lDataPdtAchat = [];
			var lAchatSolidaire = false;
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lAchatPdtSolidaire = false;
					var lProduit = this;
					//var lIdProduit = this.id;
					
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					
					lPdt.prix = 0;
					lPdt.stoQuantite = 0;

					$(pResponse.stockSolidaire).each(function() {
						if(lPdt.id == this.proId){
							$.each(lProduit.lots, function() {
								if(this.id) {
									var lIdLot = this.id;
									$(lAchat.detailAchatSolidaire).each(function() {
										if(this.idDetailCommande == lIdLot) {
											lPdt.stoQuantite = this.quantite * -1;
											lPdt.prix = this.montant * -1;
											lAchatSolidaire = true;
											lAchatPdtSolidaire = true;
										}
									});
								}
							});
						}
					});

					if(lAchatPdtSolidaire) {
						lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
						lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');		
						
						if(!lDataPdtAchat[this.idCategorie]) {
							lDataPdtAchat[this.idCategorie] = {nom:this.cproNom,achat:[]};
						}
						lDataPdtAchat[this.idCategorie].achat.push(lPdt);
						
						//lDataPdtAchat.push(lPdt);
					}
				}
			});
			if(lAchatSolidaire) {
				var lDataAchat = {	categories:lDataPdtAchat,
									idAchat:this.id.idAchat,
									totalSolidaire:(this.totalSolidaire * -1).nombreFormate(2,',',' ')};
				lData.achatsSolidaire.push(lDataAchat);
				lData.totalMarche += this.totalSolidaire * -1;
			}
		});*/
		
	//	lData.totalMarche = lData.totalMarche.nombreFormate(2,',',' ');
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	};
	
	this.affect = function(pData) {
		return pData;
	};
		
	this.construct(pParam);
}