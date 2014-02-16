;function AdhesionAdherentValid() { 
	this.validAjout = function(pData) { 
		var lVR = new AdhesionAdherentVR();
		//Tests Techniques
		if(!pData.idAdherent.checkLength(0,11)) {lVR.valid = false;lVR.idAdherent.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idAdherent.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idAdherent))) {lVR.valid = false;lVR.idAdherent.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idAdherent.erreurs.push(erreur);}
		if(!pData.idTypeAdhesion.checkLength(0,11)) {lVR.valid = false;lVR.idTypeAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idTypeAdhesion.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idTypeAdhesion))) {lVR.valid = false;lVR.idTypeAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idTypeAdhesion.erreurs.push(erreur);}
		if(!pData.statutFormulaire.checkLength(0,1)) {lVR.valid = false;lVR.statutFormulaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.statutFormulaire.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.statutFormulaire))) {lVR.valid = false;lVR.statutFormulaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.statutFormulaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idAdherent.isEmpty()) {lVR.valid = false;lVR.idAdherent.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idAdherent.erreurs.push(erreur);}
		if(pData.idTypeAdhesion.isEmpty()) {lVR.valid = false;lVR.idTypeAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idTypeAdhesion.erreurs.push(erreur);}
		if(pData.idTypeAdhesion == 0) {lVR.valid = false;lVR.idTypeAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_271_CODE;erreur.message = ERR_271_MSG;lVR.idTypeAdhesion.erreurs.push(erreur);}
		if(pData.statutFormulaire.isEmpty()) {lVR.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.statutFormulaire.erreurs.push(erreur);}
		
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new AdhesionAdherentVR();
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			lVr = this.validAjout(pData);
			
			if(!pData.idOperation.checkLength(0,11)) {lTestId.valid = false;lTestId.statutFormulaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lTestId.statutFormulaire.erreurs.push(erreur);}
			if(isNaN(parseInt(pData.idOperation))) {lTestId.valid = false;lTestId.statutFormulaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lTestId.statutFormulaire.erreurs.push(erreur);}

			return lVr;
		}
		return lTestId;
	};
};