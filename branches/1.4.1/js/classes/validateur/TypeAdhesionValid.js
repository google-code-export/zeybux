;function TypeAdhesionValid() { 
	this.validAjout = function(pData) { 
		var lVR = new TypeAdhesionDetailVR();
		//Tests Techniques
		if(!pData.label.checkLength(0,45)) {lVR.valid = false;lVR.label.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.label.erreurs.push(erreur);}
		if(!pData.idPerimetre.checkLength(0,11)) {lVR.valid = false;lVR.idPerimetre.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idPerimetre.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idPerimetre))) {lVR.valid = false;lVR.idPerimetre.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idPerimetre.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.label.isEmpty()) {lVR.valid = false;lVR.label.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.label.erreurs.push(erreur);}
		if(pData.idPerimetre.isEmpty()) {lVR.valid = false;lVR.idPerimetre.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idPerimetre.erreurs.push(erreur);}
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new TypeAdhesionDetailVR();
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			return this.validAjout(pData);
		}
		return lTestId;
	};
};