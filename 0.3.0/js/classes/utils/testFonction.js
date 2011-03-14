;String.prototype.checkLength = function(min,max) {
	return !(this.toString().length > max || this.toString().length < min);
}

;Number.prototype.checkLength = function(min,max) {
	return !(this.toString().length > max || this.toString().length < min);
}

;String.prototype.isEmpty = function() {
	return !(this.toString().length > 0);
}

;Number.prototype.isEmpty = function() {
	return !(this.toString().length > 0);
}

;String.prototype.isInt = function() {
	return !isNaN(parseInt(this.toString()));
}

;Number.prototype.isInt = function() {
	return !isNaN(parseInt(this.toString()));
}

;String.prototype.isFloat = function() {
	return !isNaN(parseFloat(this.toString()));
}

;Number.prototype.isFloat = function() {
	return !isNaN(parseFloat(this.toString()));
}

;function isArray(pObj) {
	if(pObj) {
		return pObj.constructor == Array;
	}
	return false;
}

;String.prototype.checkRegexp = function(regexp) {
	var r = new RegExp(regexp);
	return r.test(this.toString());
}

;String.prototype.checkCourriel = function() {
	var regexp =  /^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/g;
	return this.toString().checkRegexp(regexp);
}

;String.prototype.checkTime = function() {
	var regexp =  /^[0-9]{2}[:]{1}[0-9]{2}[:]{1}[0-9]{2}$/g;
	return this.toString().checkRegexp(regexp);
}

;String.prototype.checkTimeExist = function() {
	var lTime = this.toString().split(':');
	if(lTime.length == 3) {
		return parseInt(lTime[0]) >= 0 && parseInt(lTime[0]) < 24 && parseInt(lTime[1]) >= 0 && parseInt(lTime[1]) < 60 && parseInt(lTime[2]) >= 0 && parseInt(lTime[2]) < 60;
	}
	return false;
}

;String.prototype.checkDate = function(type) {
	if(type === "")	type = 'db';
	if(type == 'db') {
		var regexp =  /^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$/g;
	} else if(type == 'fr') {
		var regexp =  /^[0-9]{2}[/]{1}[0-9]{2}[/]{1}[0-9]{4}$/g;
	} else return false;	
	return this.toString().checkRegexp(regexp);
}

;String.prototype.checkDateExist = function(type) {
	if(type === "")	type = 'db';
	if(type == 'db') {
		var lSplit = '-'; var lIndexAnnee = 0; var lIndexDate = 2;
	} else if(type == 'fr') {
		var lSplit = '/'; var lIndexAnnee = 2; var lIndexDate = 0;
	} else return false;	
	var ladate = this.toString().split(lSplit);
	if ((ladate.length != 3) || isNaN(parseInt(ladate[0])) || isNaN(parseInt(ladate[1])) || isNaN(parseInt(ladate[2]))) return false;
	var unedate = new Date(eval(ladate[lIndexAnnee]),eval(ladate[1])-1,eval(ladate[lIndexDate]));
	var annee = unedate.getYear();
	if ((Math.abs(annee)+"").length < 4) annee = annee + 1900;
	return ((unedate.getDate() == eval(ladate[lIndexDate])) && (unedate.getMonth() == eval(ladate[1])-1) && (annee == eval(ladate[lIndexAnnee])));
}

;String.prototype.checkDateTime = function() {
	var lDateTime = this.toString().split(' ');
	if(lDateTime.length == 2) {
		return (lDateTime[0].checkDate('db') && lDateTime[1].checkTime() );
	}
	return false;
}

;String.prototype.checkDateTimeExist = function() {
	var lDateTime = this.toString().split(' ');
	if(lDateTime.length == 2) {
		return (lDateTime[0].checkDateExist('db') && lDateTime[1].checkTimeExist() );
	}
	return false;	
}

;function dateTimeEstPLusGrandeEgale(pDateGrande,pDatePetite,pType) {
	if(pType === "")	pType = 'db';
	if(pType == 'db') {
		var lSplit = '-'; var lIndexAnnee = 0; var lIndexDate = 2;
	} else if(pType == 'fr') {
		var lSplit = '/'; var lIndexAnnee = 2; var lIndexDate = 0;
	} else return false;	
	if(pDateGrande.checkDateTime(pType) && pDatePetite.checkDateTime(pType) && pDateGrande.checkDateTimeExist(pType) && pDatePetite.checkDateTimeExist(pType)) {
		var lDateTimeGrande = pDateGrande.split(' ');
		var lDateGrande = lDateTimeGrande[0].split(lSplit);
		var lTimeGrande = lDateTimeGrande[1].replace(':','');		
		lDateGrande = lDateGrande[lIndexAnnee] + lDateGrande[1] + lDateGrande[lIndexDate] + lTimeGrande;
		
		var lDateTimePetite = pDatePetite.split(' ');
		var lDatePetite = lDateTimePetite[0].split(lSplit);
		var lTimeGrande = lDateTimePetite[1].replace(':','');
		lDatePetite = lDatePetite[lIndexAnnee] + lDatePetite[1] + lDatePetite[lIndexDate] + lTimeGrande;
	
		return lDateGrande >= lDatePetite;
	}
	return false;
}

;function dateEstPLusGrandeEgale(pDateGrande,pDatePetite,pType) {
	if(pType === "") pType = 'db';
	if(pType == 'db') {
		var lSplit = '-'; var lIndexAnnee = 0; var lIndexDate = 2;
	} else if(pType == 'fr') {
		var lSplit = '/'; var lIndexAnnee = 2; var lIndexDate = 0;
	} else return false;	
	if(pDateGrande.checkDate(pType) && pDatePetite.checkDate(pType) && pDateGrande.checkDateExist(pType) && pDatePetite.checkDateExist(pType)) {
		var lDateGrande = pDateGrande.split(lSplit);
		lDateGrande = lDateGrande[lIndexAnnee] + lDateGrande[1] + lDateGrande[lIndexDate];
		var lDatePetite = pDatePetite.split(lSplit);
		lDatePetite = lDatePetite[lIndexAnnee] + lDatePetite[1] + lDatePetite[lIndexDate];
		return lDateGrande >= lDatePetite;
	}
	return false;
}

;function timeEstPLusGrandeEgale(pTimeGrande,pTimePetite) {
	if(pTimeGrande.checkTime() && pTimePetite.checkTime() && pTimeGrande.checkTimeExist() && pTimePetite.checkTimeExist()) {
		var lTimeGrande = pTimeGrande.replace(':','');
		var lTimePetite = pTimePetite.replace(':','');
		return lTimeGrande >= lTimePetite;	
	}
	return false;
}