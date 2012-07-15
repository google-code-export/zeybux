function FermeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new FermeVR();
		//Tests Techniques

		//Tests Fonctionnels

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new FermeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new FermeVR();
			//Tests Techniques

			//Tests Fonctionnels

			return lVR;
		}
		return lTestId;
	}

}