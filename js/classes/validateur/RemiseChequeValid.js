;function RemiseChequeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new RemiseChequeVR();
		//Tests Fonctionnels
		// Le tableau des operations ne doit pas être vide
		if(isArray(pData.operations) ) {
			if(pData.operations.length > 0) {
				for(i in pData.operations) {
					var lVrOperationDetail = new OperationDetailVR();
					
					if(isNaN(parseInt(pData.operations[i].id))) {lVR.valid = false;lVrOperationDetail.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVrOperationDetail.id.erreurs.push(erreur);}
					if(pData.operations[i].id.isEmpty()) {lVR.valid = false;lVrOperationDetail.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVrOperationDetail.id.erreurs.push(erreur);}	
					lVR.operations.push(lVrOperationDetail);
				}
			} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

		return lVR;
	};

	this.validAjoutOperation = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			return this.validAjout(pData);
		}
		return lTestId;
	};
	
	this.validDelete = function(pData) {
		var lVR = new RemiseChequeVR();
		// L'Id de la remise de chèque ne doit pas être vide
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}		
		return lVR;
	};


}