;function ChampComplementaireValid() { 
	this.validUpdate = function(pData) { 
		var lVR = new ChampComplementaireVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.obligatoire.checkLength(0,1)) {lVR.valid = false;lVR.obligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.obligatoire.erreurs.push(erreur);}
		if(!pData.obligatoire.isInt()) {lVR.valid = false;lVR.obligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.obligatoire.erreurs.push(erreur);}
		if(!pData.valeur.checkLength(0,50)) {lVR.valid = false;lVR.valeur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.valeur.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.obligatoire.isEmpty()) {lVR.valid = false;lVR.obligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.obligatoire.erreurs.push(erreur);}
		if(pData.obligatoire == 1 && pData.valeur.isEmpty()) {lVR.valid = false;lVR.valeur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.valeur.erreurs.push(erreur);}
		
		return lVR;
	};
};