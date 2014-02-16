;function OperationDetailValid() { 
	this.validAjout = function(pData, pParam) { 
		var lParam = {negatif:false, zeroAutorise: false, reel:false};
		lParam = $.extend(true,lParam,pParam);
		
		var lVR = new OperationDetailVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		if(!lParam.reel && !lParam.zeroAutorise && pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(!lParam.reel && lParam.negatif && pData.montant > 0){lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_267_CODE;erreur.message = ERR_267_MSG;lVR.montant.erreurs.push(erreur);}
		if(!lParam.reel && !lParam.negatif && pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.typePaiement.isEmpty() || pData.typePaiement == 0) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiement.erreurs.push(erreur);}

		if(isArray(pData.champComplementaire) ) {
			if(pData.champComplementaire.length > 0) {
				var lValidChampComplementaire = new ChampComplementaireValid();
				
				for(i in pData.champComplementaire) {
					var lVrChampComplementaire = lValidChampComplementaire.validUpdate(pData.champComplementaire[i]);
					if(!lVrChampComplementaire.valid){lVR.valid = false;}
					if(!pData.champComplementaire[i].id.isEmpty()) {
						lVR.champComplementaire[pData.champComplementaire[i].id] = lVrChampComplementaire;
					} else {
						lVR.champComplementaire.push(lVrChampComplementaire);
					}
				}
			}
		} else {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.champComplementaire.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new OperationDetailVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new OperationDetailVR();
			//Tests Techniques
			if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
			if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
			if(!pData.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
			if(!pData.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}
			
			//Tests Fonctionnels
			if(pData.id.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
			if(pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
			if(pData.typePaiement.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}

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
	
	this.validUpdateMontant = function(pData, pParam) { 
		var lParam = {negatif:false, zeroAutorise: false, reel:false};
		lParam = $.extend(true,lParam,pParam);
				
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new OperationDetailVR();
			//Tests Techniques
			if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
			if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
			if(!pData.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
			if(!pData.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}
			
			//Tests Fonctionnels
			if(pData.id.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
			if(!lParam.reel && !lParam.zeroAutorise && pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
			if(!lParam.reel && lParam.negatif && pData.montant > 0){lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_267_CODE;erreur.message = ERR_267_MSG;lVR.montant.erreurs.push(erreur);}
			if(!lParam.reel && !lParam.negatif && pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
			if(pData.typePaiement.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}

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
};