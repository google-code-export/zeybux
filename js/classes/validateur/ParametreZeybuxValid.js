;function ParametreZeybuxValid() { 
	
	this.validUpdate = function(pData) {
		var lVR = new ParametreZeybuxVR();
		//Tests Techniques
		//Tests Fonctionnels
		if(pData.mailSupport.isEmpty()) {lVR.valid = false;lVR.mailSupport.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.mailSupport.erreurs.push(erreur);}
		if(pData.mailMailingListe.isEmpty()) {lVR.valid = false;lVR.mailMailingListe.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.mailMailingListe.erreurs.push(erreur);}
		if(pData.mailMailingListeDomaine.isEmpty()) {lVR.valid = false;lVR.mailMailingListeDomaine.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.mailMailingListeDomaine.erreurs.push(erreur);}
		if(pData.adresseWSDL.isEmpty()) {lVR.valid = false;lVR.adresseWSDL.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.adresseWSDL.erreurs.push(erreur);}
		if(pData.sOAPLogin.isEmpty()) {lVR.valid = false;lVR.sOAPLogin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.sOAPLogin.erreurs.push(erreur);}
		if(pData.sOAPPass.isEmpty()) {lVR.valid = false;lVR.sOAPPass.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.sOAPPass.erreurs.push(erreur);}
		if(pData.zeybuxTitre.isEmpty()) {lVR.valid = false;lVR.zeybuxTitre.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.zeybuxTitre.erreurs.push(erreur);}
		if(pData.zeybuxAdresse.isEmpty()) {lVR.valid = false;lVR.zeybuxAdresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.zeybuxAdresse.erreurs.push(erreur);}
		if(pData.propNom.isEmpty()) {lVR.valid = false;lVR.propNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propNom.erreurs.push(erreur);}
		if(pData.propAdresse.isEmpty()) {lVR.valid = false;lVR.propAdresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propAdresse.erreurs.push(erreur);}
		if(pData.propCP.isEmpty()) {lVR.valid = false;lVR.propCP.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propCP.erreurs.push(erreur);}
		if(pData.propVille.isEmpty()) {lVR.valid = false;lVR.propVille.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propVille.erreurs.push(erreur);}
		if(pData.propTel.isEmpty()) {lVR.valid = false;lVR.propTel.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propTel.erreurs.push(erreur);}
		if(pData.propMail.isEmpty()) {lVR.valid = false;lVR.propMail.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propMail.erreurs.push(erreur);}
		if(pData.propRespMarcheNom.isEmpty()) {lVR.valid = false;lVR.propRespMarcheNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propRespMarcheNom.erreurs.push(erreur);}
		if(pData.propRespMarchePrenom.isEmpty()) {lVR.valid = false;lVR.propRespMarchePrenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propRespMarchePrenom.erreurs.push(erreur);}
		if(pData.propRespMarchePoste.isEmpty()) {lVR.valid = false;lVR.propRespMarchePoste.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propRespMarchePoste.erreurs.push(erreur);}
		if(pData.propRespMarcheTel.isEmpty()) {lVR.valid = false;lVR.propRespMarcheTel.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.propRespMarcheTel.erreurs.push(erreur);}
		
		return lVR;
	};
}