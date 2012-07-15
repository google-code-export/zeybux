function ProduitsBonDeCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitsBonDeCommandeVR();
		//Tests Techniques
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_producteur.checkLength(0,11)) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_producteur.erreurs.push(erreur);}
		if(!pData.id_producteur.isInt()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_producteur.erreurs.push(erreur);}
		if(!pData.export.checkLength(0,1)) {lVR.valid = false;lVR.export.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export.erreurs.push(erreur);}
		if(!pData.export.isInt()) {lVR.valid = false;lVR.export.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.id_producteur.isEmpty()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_producteur.erreurs.push(erreur);}
		if(pData.export.isEmpty()) {lVR.valid = false;lVR.export.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export.erreurs.push(erreur);}
		if(pData.produits.isEmpty()) {lVR.valid = false;lVR.produits.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.produits.erreurs.push(erreur);}

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ProduitsBonDeCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitsBonDeCommandeVR();
			//Tests Techniques
			if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_producteur.checkLength(0,11)) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(!pData.id_producteur.isInt()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(!pData.export.checkLength(0,1)) {lVR.valid = false;lVR.export.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export.erreurs.push(erreur);}
			if(!pData.export.isInt()) {lVR.valid = false;lVR.export.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(pData.id_producteur.isEmpty()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(pData.export.isEmpty()) {lVR.valid = false;lVR.export.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export.erreurs.push(erreur);}
			if(pData.produits.isEmpty()) {lVR.valid = false;lVR.produits.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.produits.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

}