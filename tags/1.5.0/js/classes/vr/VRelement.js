;function VRelement(pValid, pErreurs) {
	if(pValid != undefined) {this.valid = pValid;} else {this.valid = true;}
	if(pErreurs != undefined) {this.erreurs = pErreurs;} else {this.erreurs = [];}
};