;function AdhesionValid() { 
	this.validAjout = function(pData) { 
		var lVR = new AdhesionDetailVR();
		//Tests Techniques
		if(!pData.label.checkLength(0,45)) {lVR.valid = false;lVR.label.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.label.erreurs.push(erreur);}
		if(!pData.dateDebut.checkDate('db')) {lVR.valid = false;lVR.dateDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateDebut.erreurs.push(erreur);}
		if(!pData.dateDebut.checkDateExist('db')) {lVR.valid = false;lVR.dateDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateDebut.erreurs.push(erreur);}
		if(!pData.dateFin.checkDate('db')) {lVR.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateFin.erreurs.push(erreur);}
		if(!pData.dateFin.checkDateExist('db')) {lVR.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateFin.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.label.isEmpty()) {lVR.valid = false;lVR.label.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.label.erreurs.push(erreur);}
		if(pData.dateDebut.isEmpty()) {lVR.valid = false;lVR.dateDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateDebut.erreurs.push(erreur);}
		if(pData.dateFin.isEmpty()) {lVR.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateFin.erreurs.push(erreur);}
		
		if(!dateEstPLusGrandeEgale(pData.dateFin,pData.dateDebut,'db')) {lVR.valid = false;lVR.dateDebut.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_252_CODE;erreur.message = ERR_252_MSG;lVR.dateDebut.erreurs.push(erreur);lVR.dateFin.erreurs.push(erreur);}
		
		if(isArray(pData.types)) {		
			if(pData.types.length > 0) {
				var lValidType = new TypeAdhesionValid();
				var i = 0;
				while(pData.types[i]) {
					var lVrType = lValidType.validAjout(pData.types[i]);	
					if(!lVrType.valid){lVR.valid = false;}
					lVR.types.push(lVrType);
					i++;
				}
			} else {
				// Erreur il faut au moins un type
				lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_269_CODE;erreur.message = ERR_269_MSG;lVR.log.erreurs.push(erreur);
			}	
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}
		
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new AdhesionDetailVR();
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			return this.validAjout(pData);
		}
		return lTestId;
	};
};