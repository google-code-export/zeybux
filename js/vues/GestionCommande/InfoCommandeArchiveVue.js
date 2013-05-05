;function InfoCommandeArchiveVue(pParam) {	
	this.mIdMarche = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {InfoCommandeArchiveVue(pParam);}} );
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionCommande&v=InfoCommandeArchive", "pParam=" + $.toJSON(pParam),
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
		var lTemplate = lGestionCommandeTemplate.infoCommandeArchive;
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		var lTotal = 0;
		var lTotalSolidaire = 0;
		
		$(lResponse.infoCommande).each(function() {
			that.mIdMarche = this.comId;
			if(this.stoQuantite == null) { this.stoQuantite = 0;}
			if(this.opeMontant == null) { this.opeMontant = 0; }
			if(this.stoQuantiteLivraison == null) { this.stoQuantiteLivraison = 0; }
			if(this.opeMontantLivraison == null) { this.opeMontantLivraison = 0; }
			if(this.stoQuantiteSolidaire == null) { this.stoQuantiteSolidaire = 0; }
			if(this.stoQuantiteVente == null) { this.stoQuantiteVente = 0; }
			if(this.opeMontantVente == null) { this.opeMontantVente = 0; }
			if(this.stoQuantiteVenteSolidaire == null) { this.stoQuantiteVenteSolidaire = 0; }
			if(this.opeMontantVenteSolidaire == null) { this.opeMontantVenteSolidaire = 0; }
			
			lTotal -= parseFloat(this.opeMontantLivraison);
			lTotal += parseFloat(this.opeMontantVente);
			lTotalSolidaire += parseFloat(this.opeMontantVenteSolidaire);
			
			this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
			this.opeMontant = this.opeMontant.nombreFormate(2,',',' ');
			this.stoQuantiteLivraison = this.stoQuantiteLivraison.nombreFormate(2,',',' ');
			this.opeMontantLivraison = this.opeMontantLivraison.nombreFormate(2,',',' ');
			this.stoQuantiteSolidaire = this.stoQuantiteSolidaire.nombreFormate(2,',',' ');
			this.stoQuantiteVente = this.stoQuantiteVente.nombreFormate(2,',',' ');
			this.opeMontantVente = this.opeMontantVente.nombreFormate(2,',',' ');
			this.stoQuantiteVenteSolidaire = this.stoQuantiteVenteSolidaire.nombreFormate(2,',',' ');
			this.opeMontantVenteSolidaire = this.opeMontantVenteSolidaire.nombreFormate(2,',',' ');
		});
		
		lResponse.total = lTotal.nombreFormate(2,',',' ');
		lResponse.totalSolidaire = lTotalSolidaire.nombreFormate(2,',',' ');
		lResponse.numero = lResponse.detailMarche.numero;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
	};
	
	this.affect = function(pData) {
	//	pData = this.affectLienListeCommandeArchive(pData);
	//	pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectDupliquerMarche(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectDupliquerMarche = function(pData) {
		var that = this;
		pData.find('#btn-dupliquer-com').click(function() {
			//DupliquerMarcheVue({"id_commande":that.mIdMarche});
			AjoutCommandeVue({"id_marche":that.mIdMarche, fonction:"dupliquer"});
		});
		return pData;
	};
	
	this.construct(pParam);
}