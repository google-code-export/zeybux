;function IdentificationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new IdentificationVR();
		//Tests Techniques
		if(!pData.login.checkLength(0,20)) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.login.erreurs.push(erreur);}
		if(!pData.pass.checkLength(0,100)) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pass.erreurs.push(erreur);}
				
		//Tests Fonctionnels
		if(pData.login.isEmpty()) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.login.erreurs.push(erreur);}
		if(pData.pass.isEmpty()) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pass.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new IdentificationVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new IdentificationVR();
			//Tests Techniques
			if(!pData.login.checkLength(0,20)) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.login.erreurs.push(erreur);}
			if(!pData.pass.checkLength(0,100)) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pass.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.login.isEmpty()) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.login.erreurs.push(erreur);}
			if(pData.pass.isEmpty()) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pass.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};

}