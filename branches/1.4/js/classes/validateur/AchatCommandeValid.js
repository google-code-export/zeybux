;function AchatCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new AchatCommandeVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		
		var lNbPdt = false;
		//if(pData.NbProduits > 0) {
			if(isArray(pData.produits)) {		
				if(pData.produits.length > 0 && pData.produits[0] != '') {
					lNbPdt = true;
					var lValidProduit = new ProduitAchatValid();
					var i = 0;
					var lNbProduit = 0;
					while(pData.produits[i]) {
						var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
						if(!lVrProduit.valid){lVR.valid = false;}
						if(!pData.produits[i].id.isEmpty()) {
							lVR.produits[pData.produits[i].id] = lVrProduit;
						} else {
							lVR.produits.push(lVrProduit);
						}
						
						if(!isNaN(pData.produits[i].quantite) && pData.produits[i].quantite != 0) {lNbProduit++;}					
						i++;
					}				
				}
			} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}		
		//}
		
		//if(pData.NbProduitsSolidaire > 0) {
			if(isArray(pData.produitsSolidaire)) {		
				if(pData.produitsSolidaire.length > 0 && pData.produitsSolidaire[0] != '') {
					lNbPdt = true;
					var lValidProduit = new ProduitAchatValid();
					var i = 0;
					var lNbProduitSolidaire = 0;
					while(pData.produitsSolidaire[i]) {
						var lVrProduit = lValidProduit.validAjout(pData.produitsSolidaire[i]);	
						if(!lVrProduit.valid){lVR.valid = false;}
						if(!pData.produitsSolidaire[i].id.isEmpty()) {
							lVR.produitsSolidaire[pData.produitsSolidaire[i].id] = lVrProduit;
						} else {
							lVR.produitsSolidaire.push(lVrProduit);
						}
						if(!isNaN(pData.produitsSolidaire[i].quantite) && pData.produitsSolidaire[i].quantite != 0) {lNbProduitSolidaire++;}
						i++;
					}
				}
			} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}		
		//}
		
		// Si il y a rechargement du compte on le test
		if((!pData.rechargement.montant.isEmpty() && pData.rechargement.montant != 0) ||
				(!pData.rechargement.typePaiement.isEmpty() && pData.rechargement.typePaiement != 0)) {
			var lValidRechargement = new OperationDetailValid();
			lVR.rechargement = lValidRechargement.validAjout(pData.rechargement);
			if(!lVR.rechargement.valid){
				lVR.valid = false;
				lVR.rechargement.montant.valid = false;
			}
		} else if(!lNbPdt) { // Si pas de rechargement il faut au moins 1 produit sur la commande
			lVR.valid = false;
			lVR.log.valid = false;
			var erreur = new VRerreur();
			erreur.code = ERR_207_CODE;
			erreur.message = ERR_207_MSG;
			lVR.log.erreurs.push(erreur);					
		}
		
		return lVR;
	};
	
	this.validAjoutInvite = function(pData) { 
		var lVR = new AchatCommandeVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
	/*	if(!pData.solde.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.solde.isFloat()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
*/	
		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		
		var lNbPdt = false;		
		var lTotal = 0;
		if(isArray(pData.produits)) {		
			if(pData.produits.length > 0 && pData.produits[0] != '') {
				lNbPdt = true;
				var lValidProduit = new ProduitAchatValid();
				var i = 0;
				var lNbProduit = 0;
				while(pData.produits[i]) {
					var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
					if(!lVrProduit.valid){lVR.valid = false;}
					if(!pData.produits[i].id.isEmpty()) {
						lVR.produits[pData.produits[i].id] = lVrProduit;
					} else {
						lVR.produits.push(lVrProduit);
					}
					
					if(!isNaN(pData.produits[i].quantite) && pData.produits[i].quantite != 0) {lNbProduit++;}	
					lTotal = (parseFloat(lTotal) + parseFloat(pData.produits[i].prix)).toFixed(2);	
					i++;
				}				
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}		
		
		if(isArray(pData.produitsSolidaire)) {		
			if(pData.produitsSolidaire.length > 0 && pData.produitsSolidaire[0] != '') {
				lNbPdt = true;
				var lValidProduit = new ProduitAchatValid();
				var i = 0;
				var lNbProduitSolidaire = 0;
				while(pData.produitsSolidaire[i]) {
					var lVrProduit = lValidProduit.validAjout(pData.produitsSolidaire[i]);	
					if(!lVrProduit.valid){lVR.valid = false;}
					if(!pData.produitsSolidaire[i].id.isEmpty()) {
						lVR.produitsSolidaire[pData.produitsSolidaire[i].id] = lVrProduit;
					} else {
						lVR.produitsSolidaire.push(lVrProduit);
					}
					if(!isNaN(pData.produitsSolidaire[i].quantite) && pData.produitsSolidaire[i].quantite != 0) {lNbProduitSolidaire++;}
					lTotal = (parseFloat(lTotal) + parseFloat(pData.produitsSolidaire[i].prix)).toFixed(2);	
					i++;
				}
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}		
		
		
		// Il faut au moins 1 produit sur la commande
		if(!lNbPdt) {
			lVR.valid = false;
			lVR.log.valid = false;
			var erreur = new VRerreur();
			erreur.code = ERR_207_CODE;
			erreur.message = ERR_207_MSG;
			lVR.log.erreurs.push(erreur);					
		}	
		
		// Si il y a rechargement du compte on le test
		if((!pData.rechargement.montant.isEmpty() && pData.rechargement.montant != 0) ||
				(!pData.rechargement.typePaiement.isEmpty() && pData.rechargement.typePaiement != 0)) {
			var lValidRechargement = new OperationDetailValid();
			lVR.rechargement = lValidRechargement.validAjout(pData.rechargement);
			if(!lVR.rechargement.valid){
				lVR.valid = false;
				lVR.rechargement.montant.valid = false;
			}
			lTotal = (parseFloat(lTotal) +  parseFloat(pData.rechargement.montant)).toFixed(2);	
		}

		if(lTotal != 0 ) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_244_CODE;erreur.message = ERR_244_MSG;lVR.log.erreurs.push(erreur);}
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new AchatCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new AchatCommandeVR();
			//Tests Techniques
			if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
			if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCompte.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
			
			if(isArray(pData.produits)) {		
				if(pData.produits.length > 0) {
					var lValidProduit = new ProduitAchatValid();
					var i = 0;
					while(pData.produits[i]) {
						var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
						if(!lVrProduit.valid){lVR.valid = false;}
						if(!pData.produits[i].id.isEmpty()) {
							lVR.produits[pData.produits[i].id] = lVrProduit;
						} else {
							lVR.produits.push(lVrProduit);
						}
						i++;
					}
				} else {
					// Erreur il faut au moins un produit
					lVR.valid = false;
					lVR.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_207_CODE;
					erreur.message = ERR_207_MSG;
					lVR.log.erreurs.push(erreur);}	
			} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}		
			
			// Si il y a rechargement du compte on le test
			if(!isNaN(pData.rechargement.montant) && pData.rechargement.montant != 0) {
				var lValidRechargement = new OperationDetailValid();
				lVR.rechargement = lValidRechargement.validAjout(pData.rechargement);
				if(!lVR.rechargement.valid){lVR.valid = false;}
			}
			return lVR;
		}
		return lTestId;
	};

}