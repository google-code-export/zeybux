;function ReservationAdherentValid() { 
	this.validUpdate = function(pData) { 
		var lVR = new AchatAdherentVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.etat))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.total != '' && (!pData.total.checkLength(0,12) || pData.total > 999999999.99)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.total.erreurs.push(erreur);}
		if(pData.total != '' && !pData.total.isFloat()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.total.erreurs.push(erreur);}

		if(isArray(pData.produits)) {		
			if(pData.produits.length > 0 && pData.produits[0] != '') {
				lNbPdt = true;
				var lValidProduit = new ProduitAchatAdherentValid();
				var i = 0;
				while(pData.produits[i]) {
					var lVrProduit = lValidProduit.validUpdate(pData.produits[i]);	
					if(!lVrProduit.valid){lVR.valid = false;}
					if(!pData.produits[i].id.isEmpty()) {
						lVR.produits[pData.produits[i].id] = lVrProduit;
					} else {
						lVR.produits.push(lVrProduit);
					}			
					i++;
				}				
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}

		return lVR;
	};
}