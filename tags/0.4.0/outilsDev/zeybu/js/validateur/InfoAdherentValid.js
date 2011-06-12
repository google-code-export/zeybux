function InfoAdherentValid() { 
	this.validAjout = function(pData) { 
		var lVR = new InfoAdherentVR();
		//Tests Techniques
		if(!pData.motPass.checkLength(0,100)) {lVR.valid = false;lVR.motPass.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPass.erreurs.push(erreur);}
		if(!pData.motPassNouveau.checkLength(0,100)) {lVR.valid = false;lVR.motPassNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPassNouveau.erreurs.push(erreur);}
		if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.motPass.isEmpty()) {lVR.valid = false;lVR.motPass.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPass.erreurs.push(erreur);}
		if(pData.motPassNouveau.isEmpty()) {lVR.valid = false;lVR.motPassNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPassNouveau.erreurs.push(erreur);}
		if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new InfoAdherentVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new InfoAdherentVR();
			//Tests Techniques
			if(!pData.motPass.checkLength(0,100)) {lVR.valid = false;lVR.motPass.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPass.erreurs.push(erreur);}
			if(!pData.motPassNouveau.checkLength(0,100)) {lVR.valid = false;lVR.motPassNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPassNouveau.erreurs.push(erreur);}
			if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.motPass.isEmpty()) {lVR.valid = false;lVR.motPass.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPass.erreurs.push(erreur);}
			if(pData.motPassNouveau.isEmpty()) {lVR.valid = false;lVR.motPassNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPassNouveau.erreurs.push(erreur);}
			if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

}