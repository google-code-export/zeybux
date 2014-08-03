function ProduitAjoutAchatValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitAjoutAchatVR();
		//Tests Techniques
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.idMarche.checkLength(0,11)) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idMarche.erreurs.push(erreur);}
		if(pData.idMarche != '' && !pData.idMarche.isInt()) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idMarche.erreurs.push(erreur);}
		if(!pData.idOperation.checkLength(0,11)) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idOperation.erreurs.push(erreur);}
		if(pData.idOperation != '' && !pData.idOperation.isInt()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idOperation.erreurs.push(erreur);}
		if(!pData.idNomProduit.checkLength(0,11)) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.idNomProduit.isInt()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12) || pData.quantite > 999999999.99) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12) || pData.prix > 999999999.99) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.solidaire.checkLength(0,1)) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.solidaire.erreurs.push(erreur);}
		if(!pData.solidaire.isInt()) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.solidaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		//if(pData.idMarche.isEmpty() && pData.idOperation.isEmpty()) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idMarche.erreurs.push(erreur);}
		//if(pData.idOperation.isEmpty()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idOperation.erreurs.push(erreur);}
		if(pData.idNomProduit.isEmpty()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_214_CODE;erreur.message = ERR_214_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_213_CODE;erreur.message = ERR_213_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.solidaire.isEmpty()) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.solidaire.erreurs.push(erreur);}

		if(pData.quantite >= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix >= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

		return lVR;
	};

	/*this.validDelete = function(pData) {
		var lVR = new ProduitAjoutAchatVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitAjoutAchatVR();
			//Tests Techniques
			if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
			if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCompte.erreurs.push(erreur);}
			if(!pData.idMarche.checkLength(0,11)) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idMarche.erreurs.push(erreur);}
			if(!pData.idMarche.isInt()) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idMarche.erreurs.push(erreur);}
			if(!pData.idOperation.checkLength(0,11)) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idOperation.erreurs.push(erreur);}
			if(!pData.idOperation.isInt()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idOperation.erreurs.push(erreur);}
			if(!pData.idNomProduit.checkLength(0,11)) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(!pData.idNomProduit.isInt()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
			if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}
			if(!pData.solidaire.checkLength(0,1)) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.solidaire.erreurs.push(erreur);}
			if(!pData.solidaire.isInt()) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.solidaire.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
			if(pData.idMarche.isEmpty()) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idMarche.erreurs.push(erreur);}
			if(pData.idOperation.isEmpty()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idOperation.erreurs.push(erreur);}
			if(pData.idNomProduit.isEmpty()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
			if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}
			if(pData.solidaire.isEmpty()) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.solidaire.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};*/
}