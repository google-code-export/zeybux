;function ExportBonReservationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ExportBonReservationVR();
		//Tests Techniques
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.idCompteFerme.checkLength(0,11)) {lVR.valid = false;lVR.idCompteFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompteFerme.erreurs.push(erreur);}
		if(!pData.idCompteFerme.isInt()) {lVR.valid = false;lVR.idCompteFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCompteFerme.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}
		if(pData.idCompteFerme.isEmpty()) {lVR.valid = false;lVR.idCompteFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompteFerme.erreurs.push(erreur);}

		return lVR;
	};
}