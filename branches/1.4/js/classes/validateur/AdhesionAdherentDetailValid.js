;function AdhesionAdherentDetailValid() {	
	this.validAjout = function(pData) { 
		var lVR = new AdhesionAdherentDetailVR();
		
		if(pData.adhesionAdherent == '') {lVR.valid = false;lVR.adhesionAdherent.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.adhesionAdherent.erreurs.push(erreur);
		} else {
			var lValidAdhesionAdherent = new AdhesionAdherentValid();
			lVR.adhesionAdherent = lValidAdhesionAdherent.validAjout(pData.adhesionAdherent);
			lVR.valid = lVR.adhesionAdherent.valid;
		}
		
		if(pData.operation == '') {lVR.valid = false;lVR.operation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.operation.erreurs.push(erreur);
		} else {
			var lValidOperation = new OperationDetailValid();
			lVR.operation = lValidOperation.validAjout(pData.operation);
			lVR.valid = lVR.operation.valid;
		}
		return lVR;
	};
	
	this.validUpdate = function(pData) { 
		var lVR = new AdhesionAdherentDetailVR();
		
		if(pData.adhesionAdherent == '') {lVR.valid = false;lVR.adhesionAdherent.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.adhesionAdherent.erreurs.push(erreur);
		} else {
			var lValidAdhesionAdherent = new AdhesionAdherentValid();
			lVR.adhesionAdherent = lValidAdhesionAdherent.validUpdate(pData.adhesionAdherent);
			lVR.valid = lVR.adhesionAdherent.valid;
		}
		
		if(pData.operation == '') {lVR.valid = false;lVR.operation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.operation.erreurs.push(erreur);
		} else {
			var lValidOperation = new OperationDetailValid();
			lVR.operation = lValidOperation.validUpdate(pData.operation);
			lVR.valid = lVR.operation.valid;
		}
		return lVR;
	};
	
	this.validDelete = function(pData) { 
		var lVR = new AdhesionAdherentDetailVR();
		
		if(pData.adhesionAdherent == '') {lVR.valid = false;lVR.adhesionAdherent.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.adhesionAdherent.erreurs.push(erreur);
		} else {
			var lValidAdhesionAdherent = new AdhesionAdherentValid();
			lVR.adhesionAdherent = lValidAdhesionAdherent.validDelete(pData.adhesionAdherent);
			lVR.valid = lVR.adhesionAdherent.valid;
		}
		return lVR;
	};
};