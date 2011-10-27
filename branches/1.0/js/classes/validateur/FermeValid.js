;function FermeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new FermeVR();
		//Tests Techniques
		if(!pData.nom.checkLength(0,300)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.siren.checkLength(0,9)) {lVR.valid = false;lVR.siren.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.siren.erreurs.push(erreur);}
		if(!pData.adresse.checkLength(0,300)) {lVR.valid = false;lVR.adresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.adresse.erreurs.push(erreur);}
		if(!pData.codePostal.checkLength(0,10)) {lVR.valid = false;lVR.codePostal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.codePostal.erreurs.push(erreur);}
		if(!pData.ville.checkLength(0,100)) {lVR.valid = false;lVR.ville.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.ville.erreurs.push(erreur);}
		if(!pData.dateAdhesion.checkDate('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(!pData.dateAdhesion.checkDateExist('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.dateAdhesion.isEmpty()) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateAdhesion.erreurs.push(erreur);}

		// Test SIREN
		if(pData.siren != '') {
			var lImpair = true;
			var lSomme = 0;
			var lPosition = pData.siren.length -1;
			while( lPosition >= 0) {
				var lIncrement = 0;
				if(lImpair) {
					lIncrement = pData.siren[lPosition] * 1;
				} else {
					lIncrement = pData.siren[lPosition] * 2;
				}
				if(lIncrement > 9) {
					lIncrement -= 9;
				}
				lSomme += lIncrement;
				lImpair = !lImpair;
				lPosition--;
			}
			if(lSomme % 10 != 0 || !pData.siren.checkLength(0,9)) {lVR.valid = false;lVR.siren.valid = false;var erreur = new VRerreur();erreur.code = ERR_242_CODE;erreur.message = ERR_242_MSG;lVR.siren.erreurs.push(erreur);}
		}
		
		// Date Adhésion <= Date Actuelle
		var lAujourdhui = getDateAujourdhuiDb();		
		if(!dateEstPLusGrandeEgale(lAujourdhui,pData.dateAdhesion,'db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		
		return lVR;
	}
	
	this.validUpdate = function(pData) { 
		var lVR = new FermeVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(lVR.valid) {
			return this.validAjout(pData);
		}
		return lVR;
	}
}