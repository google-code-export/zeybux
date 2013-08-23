;function RechargementCompteValid() { 
	this.validAjout = function(pData) { 
		var lVR = new RechargementCompteVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}
		//if(!pData.champComplementaireObligatoire.checkLength(0,1)) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
		//if(!pData.champComplementaireObligatoire.isInt()) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
		//if(pData.idBanque != '' && isNaN(parseInt(pData.idBanque))) {lVR.valid = false;lVR.idBanque.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idBanque.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.typePaiement.isEmpty() || pData.typePaiement == 0) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiement.erreurs.push(erreur);}
	/*	if(pData.champComplementaireObligatoire.isEmpty()) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
		if(pData.champComplementaireObligatoire == 1 && pData.champComplementaire.isEmpty()) {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.champComplementaire.erreurs.push(erreur);}
		if(pData.champComplementaireObligatoire == 1 && pData.idBanque.isEmpty()) {lVR.valid = false;lVR.idBanque.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idBanque.erreurs.push(erreur);}
*/
		if(isArray(pData.champComplementaire) ) {
			if(pData.champComplementaire.length > 0 && pData.champComplementaire[0] != '') {
				var lValidChampComplementaire = new ChampComplementaireValid();
				var i = 0;
				while(pData.champComplementaire[i]) {
					var lVrChampComplementaire = lValidChampComplementaire.validUpdate(pData.champComplementaire[i]);
					
					if(!lVrChampComplementaire.valid){lVR.valid = false;}
					if(!pData.champComplementaire[i].id.isEmpty()) {
						lVR.champComplementaire[pData.champComplementaire[i].id] = lVrChampComplementaire;
					} else {
						lVR.champComplementaire.push(lVrChampComplementaire);
					}
					
					i++;
				}
			}
		} else {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.champComplementaire.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new RechargementCompteVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new RechargementCompteVR();
			//Tests Techniques
			if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
			if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
			if(!pData.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
			if(!pData.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}
			/*if(!pData.champComplementaireObligatoire.checkLength(0,1)) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
			if(!pData.champComplementaireObligatoire.isInt()) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
			if(pData.champComplementaire != '' && !pData.champComplementaire.checkLength(0,50)) {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.champComplementaire.erreurs.push(erreur);}
			if(pData.idBanque != '' && isNaN(parseInt(pData.idBanque))) {lVR.valid = false;lVR.idBanque.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idBanque.erreurs.push(erreur);}
			*/
			
			//Tests Fonctionnels
			if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
			if(pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
			if(pData.typePaiement.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
			/*if(pData.champComplementaireObligatoire.isEmpty()) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
			if(pData.champComplementaireObligatoire == 1 && pData.champComplementaire.isEmpty()) {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.champComplementaire.erreurs.push(erreur);}
			if(pData.champComplementaireObligatoire == 1 && pData.idBanque.isEmpty()) {lVR.valid = false;lVR.idBanque.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idBanque.erreurs.push(erreur);}
*/
			if(isArray(pData.champComplementaire) ) {
				if(pData.champComplementaire.length > 0 && pData.champComplementaire[0] != '') {
					var lValidChampComplementaire = new ChampComplementaireValid();
					var i = 0;
					while(pData.champComplementaire[i]) {
						var lVrChampComplementaire = lValidChampComplementaire.validUpdate(pData.champComplementaire[i]);
						
						if(!lVrChampComplementaire.valid){lVR.valid = false;}
						if(!pData.champComplementaire[i].id.isEmpty()) {
							lVR.champComplementaire[pData.champComplementaire[i].id] = lVrChampComplementaire;
						} else {
							lVR.champComplementaire.push(lVrChampComplementaire);
						}
						
						i++;
					}
				}
			} else {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.champComplementaire.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};

}