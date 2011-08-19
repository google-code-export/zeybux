;function ProduitCommandeValid() { 
	this.validAjout = function(pData,pMode) { 
		var lVR = new ProduitCommandeVR();
		//Tests Techniques
		if(!pData.idNom.checkLength(0,11)) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNom.erreurs.push(erreur);}
		if(!pData.idNom.isInt()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNom.erreurs.push(erreur);}
		if(!pData.idProducteur.checkLength(0,11)) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idProducteur.erreurs.push(erreur);}
		if(!pData.idProducteur.isInt()) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idProducteur.erreurs.push(erreur);}
		
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.idCategorie.checkLength(0,11)) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCategorie.erreurs.push(erreur);}
		if(pData.idCategorie != '' && !pData.idCategorie.isInt()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCategorie.erreurs.push(erreur);}
		
		if(!pData.categorie.checkLength(0,50)) {lVR.valid = false;lVR.categorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.categorie.erreurs.push(erreur);}
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(!pData.qteMaxCommande.checkLength(0,12)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(!pData.qteMaxCommande.isFloat()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		
		if(!pData.qteRestante.checkLength(0,12)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		if(!pData.qteRestante.isFloat()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idNom.isEmpty()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNom.erreurs.push(erreur);}
		if(pData.idProducteur.isEmpty()) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idProducteur.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.qteMaxCommande.isEmpty()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteRestante.isEmpty()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.qteRestante.erreurs.push(erreur);}

		if(pData.idNom < 1) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_233_CODE;erreur.message = ERR_233_MSG;lVR.idNom.erreurs.push(erreur);}
		if(pData.idProducteur < 1) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_232_CODE;erreur.message = ERR_232_MSG;lVR.idProducteur.erreurs.push(erreur);}
		
		if(parseFloat(pData.qteMaxCommande) <= 0) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) <= 0) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteRestante.erreurs.push(erreur);}

		if(parseFloat(pData.qteMaxCommande) > parseFloat(pData.qteRestante)){lVR.valid = false;lVR.qteRestante.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.qteRestante.erreurs.push(erreur);lVR.qteMaxCommande.erreurs.push(erreur);}

		if(pMode != 'simple') {
			//Tests des Lots
			if(isArray(pData.lots)) {
				var lValidLot = new DetailCommandeValid();
				var i = 0;
				while(pData.lots[i]) {
					var lVrLot = lValidLot.validAjout(pData.lots[i]);				
					if(!lVrLot.valid){lVR.valid = false;}
					if(parseFloat(pData.lots[i].taille) > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVrLot.valid = false;lVrLot.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_206_CODE;erreur.message = ERR_206_MSG;lVrLot.taille.erreurs.push(erreur);}
					lVR.lots.push(lVrLot);
					i++;}	
				
			} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		}
		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ProduitCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {	
			var lVR = new ProduitCommandeVR();
			//Tests Techniques
			if(!pData.idNom.checkLength(0,11)) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNom.erreurs.push(erreur);}
			if(!pData.idNom.isInt()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNom.erreurs.push(erreur);}
			if(!pData.idProducteur.checkLength(0,11)) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idProducteur.erreurs.push(erreur);}
			if(!pData.idProducteur.isInt()) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idProducteur.erreurs.push(erreur);}
			
			if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
			if(!pData.idCategorie.checkLength(0,11)) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCategorie.erreurs.push(erreur);}
			if(pData.idCategorie != '' && !pData.idCategorie.isInt()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCategorie.erreurs.push(erreur);}
			
			if(!pData.categorie.checkLength(0,50)) {lVR.valid = false;lVR.categorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.categorie.erreurs.push(erreur);}
			if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
			if(!pData.qteMaxCommande.checkLength(0,12)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
			if(!pData.qteMaxCommande.isFloat()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
			
			if(!pData.qteRestante.checkLength(0,12)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
			if(!pData.qteRestante.isFloat()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteRestante.erreurs.push(erreur);}
			
			//Tests Fonctionnels
			if(pData.idNom.isEmpty()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNom.erreurs.push(erreur);}
			if(pData.idProducteur.isEmpty()) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idProducteur.erreurs.push(erreur);}
			if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
			if(pData.qteMaxCommande.isEmpty()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
			if(pData.qteRestante.isEmpty()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.qteRestante.erreurs.push(erreur);}
			
			if(pData.idNom < 1) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_233_CODE;erreur.message = ERR_233_MSG;lVR.idNom.erreurs.push(erreur);}
			if(pData.idProducteur < 1) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_232_CODE;erreur.message = ERR_232_MSG;lVR.idProducteur.erreurs.push(erreur);}
			
			if(parseFloat(pData.qteMaxCommande) <= 0) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
			if(parseFloat(pData.qteRestante) <= 0) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteRestante.erreurs.push(erreur);}

			if(parseFloat(pData.qteMaxCommande) > parseFloat(pData.qteRestante)){lVR.valid = false;lVR.qteRestante.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.qteRestante.erreurs.push(erreur);lVR.qteMaxCommande.erreurs.push(erreur);}
			
			//Tests des Lots
			if(isArray(pData.lots)) {
				var lValidLot = new DetailCommandeValid();
				var i = 0;
				while(pData.lots[i]) {
					var lVrLot = lValidLot.validAjout(pData.lots[i]);				
					if(!lVrLot.valid){lVR.valid = false;}
					if(parseFloat(pData.lots[i].taille) > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVrLot.valid = false;lVrLot.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_206_CODE;erreur.message = ERR_206_MSG;lVrLot.taille.erreurs.push(erreur);}
					lVR.lots.push(lVrLot);
					i++;}	
			} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
			
			return lVR;
		}
		return lTestId;
	}

}