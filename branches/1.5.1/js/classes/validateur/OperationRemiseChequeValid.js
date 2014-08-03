;function OperationRemiseChequeValid() {	
	this.validDelete = function(pData) {
		var lVR = new OperationRemiseChequeVR();
		// Vérifie si la ligne IdRemiseCheque, IdOperation ne sont pas vide
		if(isNaN(parseInt(pData.idRemiseCheque))) {lVR.valid = false;lVR.idRemiseCheque.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idRemiseCheque.erreurs.push(erreur);}
		if(pData.idRemiseCheque.isEmpty()) {lVR.valid = false;lVR.idRemiseCheque.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idRemiseCheque.erreurs.push(erreur);}	
		if(isNaN(parseInt(pData.idOperation))) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idOperation.erreurs.push(erreur);}
		if(pData.idOperation.isEmpty()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idOperation.erreurs.push(erreur);}	
		return lVR;
	};
}