;function CompteZeybuValid() { 
	this.validRechercheListeOperation = function(pData) { 
		var lVR = new RechercheListeOperationVR();
		//Tests Techniques
		if(pData.dateDebut != '' && !pData.dateDebut.checkDate('db')) {lVR.valid = false;lVR.dateDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateDebut.erreurs.push(erreur);}
		if(pData.dateDebut != '' && !pData.dateDebut.checkDateExist('db')) {lVR.valid = false;lVR.dateDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateDebut.erreurs.push(erreur);}
		if(pData.dateFin != '' && !pData.dateFin.checkDate('db')) {lVR.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateFin.erreurs.push(erreur);}
		if(pData.dateFin != '' && !pData.dateFin.checkDateExist('db')) {lVR.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateFin.erreurs.push(erreur);}
		if(pData.idMarche != '' && isNaN(parseInt(pData.idMarche))) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idMarche.erreurs.push(erreur);}
		if(pData.idMarche != '' && !pData.idMarche.checkLength(0,11)) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idMarche.erreurs.push(erreur);}
	
		//Tests Fonctionnels
		if(pData.dateDebut != '' && pData.dateFin != '' && !dateEstPLusGrandeEgale(pData.dateFin,pData.dateDebut,'db')) {lVR.valid = false;lVR.dateDebut.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateDebut.erreurs.push(erreur);lVR.dateFin.erreurs.push(erreur);}
		if(pData.dateDebut != '' && pData.dateFin == '') {lVR.valid = false;lVR.dateFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateFin.erreurs.push(erreur);}
		if(pData.dateDebut == '' && pData.dateFin != '') {lVR.valid = false;lVR.dateDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateDebut.erreurs.push(erreur);}

		return lVR;
	};
};