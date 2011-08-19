;function ProduitsBonDeLivraisonValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitsBonDeLivraisonVR();
		//Tests Techniques
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_compte_producteur.checkLength(0,11)) {lVR.valid = false;lVR.id_compte_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_compte_producteur.erreurs.push(erreur);}
		if(!pData.id_compte_producteur.isInt()) {lVR.valid = false;lVR.id_compte_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_compte_producteur.erreurs.push(erreur);}
		//if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		//if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!isArray(pData.produits)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.total.checkLength(0,12)) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.total.erreurs.push(erreur);}
		if(!pData.total.isFloat()) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.total.erreurs.push(erreur);}
		if(!pData.typePaiementChampComplementaireObligatoire.checkLength(0,1)) {lVR.valid = false;lVR.typePaiementChampComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiementChampComplementaireObligatoire.erreurs.push(erreur);}
		if(!pData.typePaiementChampComplementaireObligatoire.isInt()) {lVR.valid = false;lVR.typePaiementChampComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiementChampComplementaireObligatoire.erreurs.push(erreur);}
		if(pData.typePaiementChampComplementaire != '' && !pData.typePaiementChampComplementaire.checkLength(0,50)) {lVR.valid = false;lVR.typePaiementChampComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiementChampComplementaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.id_compte_producteur.isEmpty()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_producteur.erreurs.push(erreur);}
		//if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
		if(pData.typePaiement.isEmpty()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(pData.total.isEmpty()) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.total.erreurs.push(erreur);}

		if(pData.typePaiement == 0) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_236_CODE;erreur.message = ERR_236_MSG;lVR.typePaiement.erreurs.push(erreur);}

		if(pData.total <= 0) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.total.erreurs.push(erreur);}
		
		if(pData.typePaiementChampComplementaireObligatoire.isEmpty()) {lVR.valid = false;lVR.typePaiementChampComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiementChampComplementaireObligatoire.erreurs.push(erreur);}
		if(pData.typePaiementChampComplementaireObligatoire == 1 && pData.typePaiementChampComplementaire.isEmpty()) {lVR.valid = false;lVR.typePaiementChampComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiementChampComplementaire.erreurs.push(erreur);}

		if(pData.produits.length > 0) {	
			var lValidProduit = new ProduitBonDeLivraisonValid();
			var i = 0;
			while(pData.produits[i]) {
				var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
				if(!lVrProduit.valid){lVR.valid = false;}
				lVR.produits[pData.produits[i].id] = lVrProduit;
				i++;
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);};

		return lVR;
	}

	/*this.validDelete = function(pData) {
		var lVR = new ProduitsBonDeLivraisonVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitsBonDeLivraisonVR();
			//Tests Techniques
			if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_producteur.checkLength(0,11)) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(!pData.id_producteur.isInt()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!isArray(pData.produits)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(pData.id_producteur.isEmpty()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}*/

}