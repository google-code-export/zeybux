;function ExportListeAchatEtReservationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ExportListeAchatEtReservationVR();
		//Tests Techniques

		//Tests Fonctionnels
		if(pData.fonction.isEmpty()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pParam.erreurs.push(erreur);}
		if(pData.id_produits.isEmpty()) {lVR.valid = false;lVR.id_produits.valid = false;var erreur = new VRerreur();erreur.code = ERR_233_CODE;erreur.message = ERR_233_MSG;lVR.id_produits.erreurs.push(erreur);}

		return lVR;
	};
}