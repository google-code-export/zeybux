;function ProduitDetailFactureValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitDetailFactureVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.idNomProduit))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idStock != '' && isNaN(parseInt(pData.idStock))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idDetailOperation != '' && isNaN(parseInt(pData.idDetailOperation))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idStockSolidaire != '' && isNaN(parseInt(pData.idStockSolidaire))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}

		if(pData.quantite != '' && !pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.unite != '' && !pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.checkLength(0,12)) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.isFloat()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.uniteSolidaire != '' && !pData.uniteSolidaire.checkLength(0,20)) {lVR.valid = false;lVR.uniteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.uniteSolidaire.erreurs.push(erreur);}
		if(pData.montant != '' && !pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montant != '' && !pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idNomProduit == '') {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}

		if(pData.montant != '' && pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}

		if(pData.quantite != '' && pData.quantite < 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.quantiteSolidaire < 0) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.montant != '' && pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		
		return lVR;
	};
};