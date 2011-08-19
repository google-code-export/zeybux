function ListeReservationCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ListeReservationCommandeVR();
		//Tests Techniques

		//Tests Fonctionnels
		if(pData.commandes.isEmpty()) {lVR.valid = false;lVR.commandes.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.commandes.erreurs.push(erreur);}

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ListeReservationCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ListeReservationCommandeVR();
			//Tests Techniques

			//Tests Fonctionnels
			if(pData.commandes.isEmpty()) {lVR.valid = false;lVR.commandes.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.commandes.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

}