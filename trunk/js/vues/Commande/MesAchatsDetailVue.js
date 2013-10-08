;function MesAchatsDetailVue(pParam) {
	this.pParam = {};

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
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.detailAchat;
		
		var lData = {};
		lData.categories = [];
		lData.sigleMonetaire = gSigleMonetaire;
		$.each(pResponse.achats.produits, function() {
			if(!lData.categories[this.cproNom]) {
				lData.categories[this.cproNom] = {nom:this.cproNom,achat:[]};
			}
			
			if(this.montant != null) {
				this.stoQuantite = (this.quantite * -1).nombreFormate(2,',',' ');
				this.prix = (this.montant * -1).nombreFormate(2,',',' ');
				this.proUniteMesure = this.unite;
				this.sigleMonetaire = gSigleMonetaire;
			} else {
				this.stoQuantite = '';
				this.prix = '';
				this.proUniteMesure = '';
				this.sigleMonetaire = '';
			}
			
			if(this.montantSolidaire != null) {
				this.stoQuantiteSolidaire = (this.quantiteSolidaire * -1).nombreFormate(2,',',' ');
				this.prixSolidaire = (this.montantSolidaire * -1).nombreFormate(2,',',' ');
				this.proUniteMesureSolidaire = this.uniteSolidaire;
				this.sigleMonetaireSolidaire = gSigleMonetaire;
			} else {
				this.stoQuantiteSolidaire = '';
				this.prixSolidaire = '';
				this.proUniteMesureSolidaire = '';
				this.sigleMonetaireSolidaire = '';
			}
			
			lData.categories[this.cproNom].achat.push(this);
		});
		
		lData.dateAchat = '';
		
		lData.total = 0;
		if(pResponse.achats.operationAchat != null) {
			lData.total = parseFloat(pResponse.achats.operationAchat.montant) * -1;
			lData.dateAchat = pResponse.achats.operationAchat.date.extractDbDate().dateDbToFr();
		}

		lData.totalSolidaire = 0;
		if(pResponse.achats.operationAchatSolidaire != null) {
			lData.totalSolidaire = parseFloat(pResponse.achats.operationAchatSolidaire.montant) * -1;
			lData.dateAchat = pResponse.achats.operationAchatSolidaire.date.extractDbDate().dateDbToFr();
		}
		
		lData.totalMarche = parseFloat(lData.total) + parseFloat(lData.totalSolidaire);
		
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