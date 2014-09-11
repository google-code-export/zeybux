;function FactureValid() { 
	this.validEnregistrer = function(pData) { 
		var lVR = new FactureVR();
		//Tests Techniques
		if(!pData.id) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		else {
			// Contrôle uniquement pour la modification
			if(pData.id.id != '' && isNaN(parseInt(pData.id.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.id.id != '' && !pData.id.id.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		}
		if(!pData.operationProducteur || isNaN(parseInt(pData.operationProducteur.idCompte))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.operationProducteur.montant.checkLength(0,12) || pData.operationProducteur.montant > 999999999.99) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.operationProducteur.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.operationProducteur.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.operationProducteur.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}		
		if(!isArray(pData.produits)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.operationProducteur.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.operationProducteur.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.operationProducteur.typePaiement.isEmpty() || pData.operationProducteur.typePaiement < 0) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiement.erreurs.push(erreur);}
		
		if(isArray(pData.operationProducteur.champComplementaire) ) {
			if(pData.operationProducteur.champComplementaire.length > 0 ) {
				var lValidChampComplementaire = new ChampComplementaireValid();
				for(i in pData.operationProducteur.champComplementaire) {
					var lVrChampComplementaire = lValidChampComplementaire.validUpdate(pData.operationProducteur.champComplementaire[i]);
					if(!lVrChampComplementaire.valid){lVR.valid = false;}
					if(!pData.operationProducteur.champComplementaire[i].id.isEmpty()) {
						lVR.champComplementaire[pData.operationProducteur.champComplementaire[i].id] = lVrChampComplementaire;
					} else {
						lVR.champComplementaire.push(lVrChampComplementaire);
					}
				}
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

		if(pData.produits.length > 0) {	
			var lValidProduit = new ProduitDetailFactureValid();
			var i = 0;
			while(pData.produits[i]) {
				var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
				if(!lVrProduit.valid){lVR.valid = false;}
				lVR.produits[i] = lVrProduit;
				i++;
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);};

		return lVR;
	};
	
	this.validRechercheListeFacture = function(pData) { 
		var lVR = new RechercheListeFactureVR();
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