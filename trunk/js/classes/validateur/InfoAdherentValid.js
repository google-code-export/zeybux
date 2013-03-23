;function InfoAdherentValid() { 
	this.validAjout = function(pData) { 
		
		var lVR = new InfoAdherentVR();
		//Tests Techniques
		if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(!pData.motPasseNouveau.checkLength(0,100)) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
		if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.motPasse.isEmpty()) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(pData.motPasseNouveau.isEmpty()) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
		if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

		// Les mots de passe ne sont pas identique
		if(pData.motPasseNouveau !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
		if(pData.motPasseNouveau.indexOf('&') != -1) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_255_CODE;erreur.message = ERR_255_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
		
		
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new InfoAdherentVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new InfoAdherentVR();
			//Tests Techniques
			if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
			if(!pData.motPasseNouveau.checkLength(0,100)) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
			if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.motPasse.isEmpty()) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasse.erreurs.push(erreur);}
			if(pData.motPasseNouveau.isEmpty()) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
			if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
			
			// Les mots de passe ne sont pas identique
			if(pData.motPasseNouveau !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
			
			return lVR;
		}
		return lTestId;
	};

}