;function ReservationCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ReservationCommandeVR();
		//Tests Techniques
		if(!pData.stoQuantite.checkLength(0,12)) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stoQuantite.erreurs.push(erreur);}
		if(!pData.stoQuantite.isFloat()) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.stoQuantite.erreurs.push(erreur);}
		if(!pData.stoIdDetailCommande.checkLength(0,11)) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}
		if(!pData.stoIdDetailCommande.isFloat()) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.stoQuantite.isEmpty()) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stoQuantite.erreurs.push(erreur);}
		if(pData.stoIdDetailCommande.isEmpty()) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}
		
		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ReservationCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ReservationCommandeVR();
			//Tests Techniques
			if(!pData.stoQuantite.checkLength(0,12)) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stoQuantite.erreurs.push(erreur);}
			if(!pData.stoQuantite.isFloat()) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.stoQuantite.erreurs.push(erreur);}
			if(!pData.stoIdDetailCommande.checkLength(0,11)) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}
			if(!pData.stoIdDetailCommande.isFloat()) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.stoQuantite.isEmpty()) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stoQuantite.erreurs.push(erreur);}
			if(pData.stoIdDetailCommande.isEmpty()) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

}