function CompteZeybuVirementValid() { 
	this.validAjout = function(pData) { 
		var lVR = new CompteZeybuAjoutVirementVR();
		//Tests Techniques
		if(!pData.idCptDebit.checkLength(0,11)) {lVR.valid = false;lVR.idCptDebit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCptDebit.erreurs.push(erreur);}
		if(!pData.idCptDebit.isInt()) {lVR.valid = false;lVR.idCptDebit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCptDebit.erreurs.push(erreur);}
		if(!pData.idCptCredit.checkLength(0,11)) {lVR.valid = false;lVR.idCptCredit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCptCredit.erreurs.push(erreur);}
		if(!pData.idCptCredit.isInt()) {lVR.valid = false;lVR.idCptCredit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCptCredit.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.type.checkLength(0,1)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.type.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCptDebit.isEmpty()) {lVR.valid = false;lVR.idCptDebit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCptDebit.erreurs.push(erreur);}
		if(pData.idCptCredit.isEmpty()) {lVR.valid = false;lVR.idCptCredit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCptCredit.erreurs.push(erreur);}
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montant <= 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.type.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.type != 1 && pData.type != 2) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_240_CODE;erreur.message = ERR_240_MSG;lVR.log.erreurs.push(erreur);}
		

		return lVR;
	}
	
	this.validUpdate = function(pData) { 
		var lVR = new CompteZeybuModifierVirementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		
		if(pData.montant <= 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		return lVR;
	}
	
	this.validDelete = function(pData) { 
		var lVR = new CompteZeybuSupprimerVirementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		return lVR;
	}
}
