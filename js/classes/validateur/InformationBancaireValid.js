;function InformationBancaireValid() {	
	this.validDelete = function(pData) {
		var lVR = new InformationBancaireVR();
		// Les champs ne doivent pas être vide
		if(isNaN(parseInt(pData.numeroCompte))) {lVR.valid = false;lVR.numeroCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.numeroCompte.erreurs.push(erreur);}
		if(pData.numeroCompte.isEmpty()) {lVR.valid = false;lVR.numeroCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.numeroCompte.erreurs.push(erreur);}	
		if(!pData.raisonSociale.checkLength(0,100)) {lVR.valid = false;lVR.raisonSociale.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.raisonSociale.erreurs.push(erreur);}
		if(pData.raisonSociale.isEmpty()) {lVR.valid = false;lVR.raisonSociale.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.raisonSociale.erreurs.push(erreur);}	
		return lVR;
	};
}