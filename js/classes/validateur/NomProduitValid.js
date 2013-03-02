;function NomProduitValid() { 
	this.validAjout = function(pData) { 
		var lVR = new NomProduitVR();
		//Tests Techniques
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}
		if(!pData.idCategorie.checkLength(0,11)) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCategorie.erreurs.push(erreur);}
		if(!pData.idCategorie.isInt()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCategorie.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.idCategorie.isEmpty()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCategorie.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new NomProduitVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new NomProduitVR();
			//Tests Techniques
			if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
			if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}
			if(!pData.idCategorie.checkLength(0,11)) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCategorie.erreurs.push(erreur);}
			if(!pData.idCategorie.isInt()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCategorie.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
			if(pData.idCategorie.isEmpty()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCategorie.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};

}