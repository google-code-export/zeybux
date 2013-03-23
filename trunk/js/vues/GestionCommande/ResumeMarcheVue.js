;function ResumeMarcheVue(pParam) {	
	this.mIdMarche = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ResumeMarcheVue(pParam);}} );
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionCommande&v=ResumeMarche", "pParam=" + $.toJSON(pParam),
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
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.resumeMarche;

		pResponse.infoMarcheSelected = '';
		pResponse.listeReservationSelected = '';
		pResponse.listeAchatSelected = '';
		pResponse.resumeMarcheSelected = 'ui-state-active';
		
		pResponse.editerMenu = lGestionCommandeTemplate.editerMarcheMenu.template(pResponse);
		
		pResponse.sigleMonetaire = gSigleMonetaire;
		
		var lTotal = 0;
		var lTotalSolidaire = 0;
		
		$(pResponse.infoCommande).each(function() {
			that.mIdMarche = this.comId;
			
			if(this.proType == 1) {
				this.nproNom += " (Solidaire)";
			} else if(this.proType == 2) {
				this.nproNom += " (Abonnement)" ;
			}
			
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
		
		pResponse.total = lTotal.nombreFormate(2,',',' ');
		pResponse.totalSolidaire = lTotalSolidaire.nombreFormate(2,',',' ');
		pResponse.numero = pResponse.detailMarche.numero;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
	};
	
	this.affect = function(pData) {
		pData = this.affectMenu(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectMenu = function(pData) {
		var that = this;
		pData.find('#btn-information-marche').click(function() {
			EditerCommandeVue(that.mParam);
		});		
		pData.find("#btn-liste-achat-resa").click(function() {
			ListeAchatMarcheVue({id_marche:that.mIdMarche});
		});
		pData.find("#btn-liste-resa").click(function() {
			ListeReservationMarcheVue({id_marche:that.mIdMarche});
		});
		pData.find("#btn-resume-marche").click(function() {
			ResumeMarcheVue({id_marche:that.mIdMarche});
		});
		return pData;
	};
		
	this.construct(pParam);
}