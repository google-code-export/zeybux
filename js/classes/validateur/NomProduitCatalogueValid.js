;function NomProduitCatalogueValid() { 
	this.validAjout = function(pData) { 
		var lVR = new NomProduitCatalogueVR();
		//Tests Techniques
		if(!pData.numero.checkLength(0,50)) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.numero.erreurs.push(erreur);}
		if(!pData.idCategorie.checkLength(0,11)) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCategorie.erreurs.push(erreur);}
		if(!pData.idCategorie.isInt()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCategorie.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}
		
		if(!isArray(pData.producteurs)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}	
		if(!isArray(pData.caracteristiques)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}	
		if(!isArray(pData.modelesLot)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}		
		
		if(lVR.valid) {
			//Tests Fonctionnels
			if(pData.idCategorie.isEmpty()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCategorie.erreurs.push(erreur);}
			if(pData.idCategorie == 0) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCategorie.erreurs.push(erreur);}
			if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
			
			// Les producteurs
			if(pData.producteurs.length > 0 && pData.producteurs[0] != '') {
				var i = 0;
				while(pData.producteurs[i]) {
					if(!pData.producteurs[i].checkLength(0,11)) {lVR.valid = false;lVR.producteurs.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.producteurs.erreurs.push(erreur);}
					if(!pData.producteurs[i].isInt()) {lVR.valid = false;lVR.producteurs.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.producteurs.erreurs.push(erreur);}			
					i++;
				}				
			}
			
			// Les caractéristiques
			if(pData.caracteristiques.length > 0 && pData.caracteristiques[0] != '') {
				var i = 0;
				while(pData.caracteristiques[i]) {
					if(!pData.caracteristiques[i].checkLength(0,11)) {lVR.valid = false;lVR.caracteristiques.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.caracteristiques.erreurs.push(erreur);}
					if(!pData.caracteristiques[i].isInt()) {lVR.valid = false;lVR.caracteristiques.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.caracteristiques.erreurs.push(erreur);}			
					i++;
				}				
			}
			
			// Les modèles de lot
			if(pData.modelesLot.length > 0 && pData.modelesLot[0] != '') {
				var lModeleLotValid = new ModeleLotValid();
				var i = 0;
				while(pData.modelesLot[i]) {
					var lVrlModeleLot = lModeleLotValid.validAjout(pData.modelesLot[i]);	
					if(!lVrlModeleLot.valid){lVrlModeleLot.valid = false;}
					lVR.modelesLot.push(lVrlModeleLot);	
					i++;
				}				
			}
		}
		return lVR;
	}
	
	this.validUpdate = function(pData) { 
		var lVR = new NomProduitCatalogueVR();
		//Tests Techniques
		if(!pData.numero.checkLength(0,50)) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.numero.erreurs.push(erreur);}
		if(!pData.idNomProduit.checkLength(0,11)) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.idNomProduit.isInt()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.idCategorie.checkLength(0,11)) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCategorie.erreurs.push(erreur);}
		if(!pData.idCategorie.isInt()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCategorie.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}
		
		if(!isArray(pData.producteurs)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}	
		if(!isArray(pData.caracteristiques)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}	
		if(!isArray(pData.modelesLot)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}		
		
		if(lVR.valid) {
			//Tests Fonctionnels
			if(pData.numero.isEmpty()) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.numero.erreurs.push(erreur);}
			if(pData.idNomProduit.isEmpty()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(pData.idCategorie.isEmpty()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCategorie.erreurs.push(erreur);}
			if(pData.idCategorie == 0) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCategorie.erreurs.push(erreur);}
			if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
			
			// Les producteurs
			if(pData.producteurs.length > 0 && pData.producteurs[0] != '') {
				var i = 0;
				while(pData.producteurs[i]) {
					if(!pData.producteurs[i].checkLength(0,11)) {lVR.valid = false;lVR.producteurs.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.producteurs.erreurs.push(erreur);}
					if(!pData.producteurs[i].isInt()) {lVR.valid = false;lVR.producteurs.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.producteurs.erreurs.push(erreur);}			
					i++;
				}				
			}
			
			// Les caractéristiques
			if(pData.caracteristiques.length > 0 && pData.caracteristiques[0] != '') {
				var i = 0;
				while(pData.caracteristiques[i]) {
					if(!pData.caracteristiques[i].checkLength(0,11)) {lVR.valid = false;lVR.caracteristiques.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.caracteristiques.erreurs.push(erreur);}
					if(!pData.caracteristiques[i].isInt()) {lVR.valid = false;lVR.caracteristiques.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.caracteristiques.erreurs.push(erreur);}			
					i++;
				}
			}
			
			// Les modèles de lot
			if(pData.modelesLot.length > 0 && pData.modelesLot[0] != '') {
				var lModeleLotValid = new ModeleLotValid();
				var i = 0;
				while(pData.modelesLot[i]) {
					var lVrlModeleLot;
					if(pData.modelesLot[i].id.isEmpty()) {
						lVrlModeleLot = lModeleLotValid.validAjout(pData.modelesLot[i]);
					} else {
						lVrlModeleLot = lModeleLotValid.validUpdate(pData.modelesLot[i]);
					}
					if(!lVrlModeleLot.valid){lVrlModeleLot.valid = false;}
					lVR.modelesLot.push(lVrlModeleLot);	
					i++;
				}				
			}
		}
		return lVR;
	}
}