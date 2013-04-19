;function MesAchatsDetailVue(pParam) {
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
				
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	};
	
	this.affect = function(pData) {
		return pData;
	};
		
	this.construct(pParam);
}