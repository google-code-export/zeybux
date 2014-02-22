;function CompteAbonnementValid() { 
	this.validAjout = function(pData,pDetailProduit) { 
		var lVR = new CompteAbonnementVR();

		//Tests Techniques
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.idProduitAbonnement.checkLength(0,11)) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idProduitAbonnement))) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(!pData.idLotAbonnement.checkLength(0,11)) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idLotAbonnement))) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12) || pData.quantite > 999999999.99) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(pData.idProduitAbonnement.isEmpty()) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(pData.idLotAbonnement.isEmpty()) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}

		if(pData.quantite <= 0 ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		
		var lQteRestante = parseFloat(pDetailProduit.proAboStockInitial) - parseFloat(pDetailProduit.proAboReservation);
		if(parseFloat(pDetailProduit.proAboMax) < lQteRestante && parseFloat(pDetailProduit.proAboMax) != -1) { 
			lQteRestante = pDetailProduit.proAboMax;
		}
		
		if(parseFloat(pData.quantite) > parseFloat(lQteRestante) ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.quantite.erreurs.push(erreur);}
		
		return lVR;
	};

	this.validUpdate = function(pData,pDetailProduit,pAbonnement) { 
		var lVR = new CompteAbonnementVR();

		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.idProduitAbonnement.checkLength(0,11)) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idProduitAbonnement))) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(!pData.idLotAbonnement.checkLength(0,11)) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idLotAbonnement))) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12) || pData.quantite > 999999999.99) {llVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(pData.idProduitAbonnement.isEmpty()) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(pData.idLotAbonnement.isEmpty()) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}

		if(pData.quantite <= 0 ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		
		var lQteRestante = parseFloat(pDetailProduit.proAboStockInitial) - parseFloat(pDetailProduit.proAboReservation) + parseFloat(pAbonnement.cptAboQuantite);
		if(parseFloat(pDetailProduit.proAboMax) < lQteRestante && parseFloat(pDetailProduit.proAboMax) != -1) { 
			lQteRestante = pDetailProduit.proAboMax;
		}
		
		if(parseFloat(pData.quantite) > parseFloat(lQteRestante) ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.quantite.erreurs.push(erreur);}
		
		return lVR;
	};
	
	this.validAjoutSuspension = function(pData) { 
		var lVR = new CompteAbonnementVR();

		//Tests Techniques
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.dateDebutSuspension.checkDate('db')) {lVR.valid = false;lVR.dateDebutSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateDebutSuspension.erreurs.push(erreur);}
		if(!pData.dateDebutSuspension.checkDateExist('db')) {lVR.valid = false;lVR.dateDebutSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateDebutSuspension.erreurs.push(erreur);}
		if(!pData.dateFinSuspension.checkDate('db')) {lVR.valid = false;lVR.dateFinSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateFinSuspension.erreurs.push(erreur);}
		if(!pData.dateFinSuspension.checkDateExist('db')) {lVR.valid = false;lVR.dateFinSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateFinSuspension.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(pData.dateDebutSuspension.isEmpty()) {lVR.valid = false;lVR.dateDebutSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateDebutSuspension.erreurs.push(erreur);}
		if(pData.dateFinSuspension.isEmpty()) {lVR.valid = false;lVR.dateFinSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateFinSuspension.erreurs.push(erreur);}

		if(!dateEstPLusGrandeEgale(pData.dateFinSuspension,pData.dateDebutSuspension,'db')) {lVR.valid = false;lVR.dateFinSuspension.valid = false;lVR.dateDebutSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_252_CODE;erreur.message = ERR_252_MSG;lVR.dateFinSuspension.erreurs.push(erreur);lVR.dateDebutSuspension.erreurs.push(erreur);}

		var lAujourdhui = getDateAujourdhuiDb();
		if(!dateEstPLusGrandeEgale(pData.dateFinSuspension,lAujourdhui,'db')) {lVR.valid = false;lVR.dateFinSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateFinSuspension.erreurs.push(erreur);}
		
		return lVR;
	};
	
	this.validDeleteSuspension = function(pData) { 
		var lVR = new CompteAbonnementVR();

		//Tests Techniques
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idCompte.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		return lVR;
	};
}