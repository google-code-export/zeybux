;function ProducteurValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProducteurVR();
		//Tests Techniques
		if(!pData.idFerme.checkLength(0,11)) {lVR.valid = false;lVR.idFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idFerme.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idFerme))) {lVR.valid = false;lVR.idFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idFerme.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.prenom.checkLength(0,50)) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prenom.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDate('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDateExist('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(!pData.commentaire.checkLength(0,500)) {lVR.valid = false;lVR.commentaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.commentaire.erreurs.push(erreur);}
		if(!pData.courrielPrincipal.checkLength(0,100)) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(pData.courrielPrincipal != '' && !pData.courrielPrincipal.checkCourriel()) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_102_CODE;erreur.message = ERR_102_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(!pData.courrielSecondaire.checkLength(0,100)) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		if(pData.courrielSecondaire != '' && !pData.courrielSecondaire.checkCourriel()) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_102_CODE;erreur.message = ERR_102_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		if(!pData.telephonePrincipal.checkLength(0,20)) {lVR.valid = false;lVR.telephonePrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephonePrincipal.erreurs.push(erreur);}
		if(!pData.telephoneSecondaire.checkLength(0,20)) {lVR.valid = false;lVR.telephoneSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephoneSecondaire.erreurs.push(erreur);}
		if(!pData.adresse.checkLength(0,300)) {lVR.valid = false;lVR.adresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.adresse.erreurs.push(erreur);}
		if(!pData.codePostal.checkLength(0,10)) {lVR.valid = false;lVR.codePostal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.codePostal.erreurs.push(erreur);}
		if(!pData.ville.checkLength(0,100)) {lVR.valid = false;lVR.ville.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.ville.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idFerme.isEmpty()) {lVR.valid = false;lVR.idFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idFerme.erreurs.push(erreur);}
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}

		var lAujourdhui = getDateAujourdhuiDb();		
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lVR = new ProducteurVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		if(lVR.valid) {
			return this.validAjout(pData);
		}
		return lVR;
	};

}