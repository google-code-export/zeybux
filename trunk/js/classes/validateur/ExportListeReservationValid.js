;function ExportListeReservationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ExportListeReservationVR();
		//Tests Techniques
		/*if(!pData.pParam.checkLength(0,1)) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pParam.erreurs.push(erreur);}
		if(!pData.pParam.isInt()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.pParam.erreurs.push(erreur);}
		if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
		*/
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.fonction.isEmpty()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pParam.erreurs.push(erreur);}
		//if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.id_produits.isEmpty()) {lVR.valid = false;lVR.id_produits.valid = false;var erreur = new VRerreur();erreur.code = ERR_233_CODE;erreur.message = ERR_233_MSG;lVR.id_produits.erreurs.push(erreur);}
		if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}

		return lVR;
	};

	/*this.validDelete = function(pData) {
		var lVR = new ExportListeReservationVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ExportListeReservationVR();
			//Tests Techniques
			if(!pData.pParam.checkLength(0,1)) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pParam.erreurs.push(erreur);}
			if(!pData.pParam.isInt()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.pParam.erreurs.push(erreur);}
			if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
			if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.pParam.isEmpty()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pParam.erreurs.push(erreur);}
			if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
			if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(pData.id_produits.isEmpty()) {lVR.valid = false;lVR.id_produits.valid = false;var erreur = new VRerreur();erreur.code = ERR_233_CODE;erreur.message = ERR_233_MSG;lVR.id_produits.erreurs.push(erreur);}
			if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}*/

}