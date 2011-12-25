;function ProduitMarcheValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitMarcheVR();
		//Tests Techniques
		if(!pData.idNom.checkLength(0,11)) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNom.erreurs.push(erreur);}
		if(!pData.idNom.isInt()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNom.erreurs.push(erreur);}
		
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.qteMaxCommande != "" && !pData.qteMaxCommande.checkLength(0,12)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteMaxCommande != "" && !pData.qteMaxCommande.isFloat()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteRestante != "" && !pData.qteRestante.checkLength(0,12)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		if(pData.qteRestante != "" && !pData.qteRestante.isFloat()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idNom.isEmpty()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNom.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}

		if(parseFloat(pData.qteMaxCommande) > 9999999999.99) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) > 9999999999.99) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		if(parseFloat(pData.qteMaxCommande) <= 0) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) <= 0) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteRestante.erreurs.push(erreur);}

		if(pData.qteRestante != "" && pData.qteMaxCommande != "" && parseFloat(pData.qteMaxCommande) > parseFloat(pData.qteRestante)){lVR.valid = false;lVR.qteRestante.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.qteRestante.erreurs.push(erreur);lVR.qteMaxCommande.erreurs.push(erreur);}

		//Tests des Lots
		if(isArray(pData.lots)) {
			if(pData.lots.length > 0) {
				var lValidLot = new DetailCommandeValid();
				var i = 0, lPetitLotTaille = pData.lots[0].taille;
				while(pData.lots[i]) {
					var lVrLot = lValidLot.validAjout(pData.lots[i]);				
					if(!lVrLot.valid){lVR.valid = false;}
					//if(parseFloat(pData.lots[i].taille) > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVrLot.valid = false;lVrLot.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_206_CODE;erreur.message = ERR_206_MSG;lVrLot.taille.erreurs.push(erreur);}
					if(parseFloat(pData.lots[i].taille) < lPetitLotTaille) { lPetitLotTaille = parseFloat(pData.lots[i].taille); }
					lVR.lots.push(lVrLot);
					i++;
				}
				if(pData.qteMaxCommande != "" && lPetitLotTaille > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
				if(pData.qteRestante != "" && lPetitLotTaille > parseFloat(pData.qteRestante)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteRestante.erreurs.push(erreur);}
				
			} else  {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_243_CODE;erreur.message = ERR_243_MSG;lVR.log.erreurs.push(erreur);}
			
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		
		return lVR;
	}
	
	this.validUpdate = function(pData) { 
		var lVR = new ProduitMarcheVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.qteMaxCommande != "" && !pData.qteMaxCommande.checkLength(0,12)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteMaxCommande != "" && !pData.qteMaxCommande.isFloat()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteRestante != "" && !pData.qteRestante.checkLength(0,12)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		if(pData.qteRestante != "" && !pData.qteRestante.isFloat()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}

		if(parseFloat(pData.qteMaxCommande) > 9999999999.99) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) > 9999999999.99) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		if(parseFloat(pData.qteMaxCommande) <= 0) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) <= 0) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteRestante.erreurs.push(erreur);}

		if(pData.qteRestante != "" && pData.qteMaxCommande != "" && parseFloat(pData.qteMaxCommande) > parseFloat(pData.qteRestante)){lVR.valid = false;lVR.qteRestante.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.qteRestante.erreurs.push(erreur);lVR.qteMaxCommande.erreurs.push(erreur);}

		//Tests des Lots
		if(isArray(pData.lots)) {
			if(pData.lots.length > 0) {
				var lValidLot = new DetailCommandeValid();
				var i = 0, lPetitLotTaille = pData.lots[0].taille;
				while(pData.lots[i]) {
					var lVrLot = lValidLot.validAjout(pData.lots[i]);				
					if(!lVrLot.valid){lVR.valid = false;}
					//if(parseFloat(pData.lots[i].taille) > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVrLot.valid = false;lVrLot.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_206_CODE;erreur.message = ERR_206_MSG;lVrLot.taille.erreurs.push(erreur);}
					if(parseFloat(pData.lots[i].taille) < lPetitLotTaille) { lPetitLotTaille = parseFloat(pData.lots[i].taille); }
					lVR.lots.push(lVrLot);
					i++;
				}				
				if(pData.qteMaxCommande != "" && lPetitLotTaille > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
				if(pData.qteRestante != "" && lPetitLotTaille > parseFloat(pData.qteRestante)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteRestante.erreurs.push(erreur);}
				
			} else  {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_243_CODE;erreur.message = ERR_243_MSG;lVR.log.erreurs.push(erreur);}
			
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		
		return lVR;
	}
}