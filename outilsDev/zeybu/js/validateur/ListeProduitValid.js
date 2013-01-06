function ListeProduitValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ListeProduitVR();
		//Tests Techniques
		if(!pData.idNomProduit.checkLength(0,11)) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.idNomProduit.isInt()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(!pData.stockInitial.checkLength(0,12)) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(!pData.stockInitial.isFloat()) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(!pData.max.checkLength(0,12)) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.max.erreurs.push(erreur);}
		if(!pData.max.isFloat()) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.max.erreurs.push(erreur);}
		if(!pData.frequence.checkLength(0,200)) {lVR.valid = false;lVR.frequence.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.frequence.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idNomProduit.isEmpty()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.stockInitial.isEmpty()) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(pData.max.isEmpty()) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.max.erreurs.push(erreur);}
		if(pData.frequence.isEmpty()) {lVR.valid = false;lVR.frequence.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.frequence.erreurs.push(erreur);}

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ListeProduitVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ListeProduitVR();
			//Tests Techniques
			if(!pData.idNomProduit.checkLength(0,11)) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(!pData.idNomProduit.isInt()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
			if(!pData.stockInitial.checkLength(0,12)) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stockInitial.erreurs.push(erreur);}
			if(!pData.stockInitial.isFloat()) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.stockInitial.erreurs.push(erreur);}
			if(!pData.max.checkLength(0,12)) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.max.erreurs.push(erreur);}
			if(!pData.max.isFloat()) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.max.erreurs.push(erreur);}
			if(!pData.frequence.checkLength(0,200)) {lVR.valid = false;lVR.frequence.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.frequence.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.idNomProduit.isEmpty()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
			if(pData.stockInitial.isEmpty()) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stockInitial.erreurs.push(erreur);}
			if(pData.max.isEmpty()) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.max.erreurs.push(erreur);}
			if(pData.frequence.isEmpty()) {lVR.valid = false;lVR.frequence.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.frequence.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

}