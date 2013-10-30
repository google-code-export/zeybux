function TemplateData() {
	this.infobulle = "<!-- BEGIN membres -->" + //ui-helper-hidden 
			"<div class=\"ui-helper-hidden com-infobulle com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ifb-{membres.nom}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Erreurs : </div>" + //{membres.nom}
				"<!-- BEGIN erreurs -->" +
				"<div class=\"com-widget-content\">" +
					"<ul>" +
						"<li>" +
							"N°{membres.erreurs.code} : {membres.erreurs.message}" +
						"</li>" +
					"</ul>" +
				"</div>" +
				"<!-- END erreurs -->" +
			"</div>" +
			"<!-- END membres -->";
	
	this.infobulleLog =
		"<!-- BEGIN erreurs -->" +
			"<ul>" +
				"<li>" +
					"N°{erreurs.code} : {erreurs.message}" +
				"</li>" +
			"</ul>" +
		"<!-- END erreurs -->";
};function ActionInfobulles() {
	this.affect = function(pHtml,pCode) {
		switch(pCode) {
			case 116:
				var that = this;
				pHtml.find('#action-ifb-116').click(function(){

					var lCommandeTemplate = new IdentificationTemplate();
					var lTemplate = lCommandeTemplate.connexion;
					var lDialog = $(lTemplate).dialog({
						autoOpen: true,
						modal: true,
						draggable: false,
						resizable: false,
						width:370,
						buttons: {
							'Connexion': function() {
								that.identifier($(this));
							}
						},
						close: function(ev, ui) { $(this).remove(); }
					});
					lDialog.find('input').keyup(function(event) {
						if (event.keyCode == '13') {
							that.identifier(lDialog);
						}
					});
				});
			break;
		}
		return pHtml;
	};
	
	this.identifier = function(pObj) {
		var lVo = new IdentificationVO();
		lVo = {fonction:"reconnecter",idConnexion:gIdConnexion,"login":pObj.find(':input[name=login]').val(),"pass":pObj.find(':input[name=pass]').val()};
		
		var lValid = new IdentificationValid();
		var lVr = lValid.validAjout(lVo);

		Infobulle.init(); // Supprime les erreurs
		if (lVr.valid) {
			$.post(	"./index.php?m=Identification&v=Identification", "pParam=" + $.toJSON(lVo),
					function(lResponse) {
					  	Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {												
							// Message d'information de la bonne suppression
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_305_CODE;
							erreur.message = ERR_305_MSG;
							lVr.log.erreurs.push(erreur);
							Infobulle.generer(lVr,'');
							
							$(pObj).dialog("close");
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			Infobulle.generer(lVr);
		}
	};
};String.prototype.checkLength = function(min,max) {
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
	var regexp = '';
	if(type == 'db') {
		/*regexp =  /^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$/g;*/
		regexp = /^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])$/;
	} else if(type == 'fr') {
		/*regexp =  /^[0-9]{2}['/']{1}[0-9]{2}['/']{1}[0-9]{4}$/g;*/
		regexp = /^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/;
	} else return false;	
	return this.toString().checkRegexp(regexp);
}

;String.prototype.checkDateExist = function(type) {
	if(type === "")	type = 'db';
	var lSplit = '', lIndexAnnee = 0, lIndexDate = 0;
	if(type == 'db') {
		lSplit = '-'; 
		lIndexAnnee = 0; 
		lIndexDate = 2;
	} else if(type == 'fr') {
		lSplit = '/'; 
		lIndexAnnee = 2; 
		lIndexDate = 0;
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
	var lSplit = '', lIndexAnnee = 0, lIndexDate = 0;
	if(pType == 'db') {
		lSplit = '-'; lIndexAnnee = 0; lIndexDate = 2;
	} else if(pType == 'fr') {
		lSplit = '/'; lIndexAnnee = 2; lIndexDate = 0;
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
	var lSplit = '', lIndexAnnee = 0, lIndexDate = 0;
	if(pType == 'db') {
		lSplit = '-'; lIndexAnnee = 0; lIndexDate = 2;
	} else if(pType == 'fr') {
		lSplit = '/'; lIndexAnnee = 2; lIndexDate = 0;
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
}/*
 * Plugin jquery permettant de tester la longueur d'un champ input
 * Change son statut si il n'est pas valide
 */
;(function($) {
	
    $.fn.checkLength = function(min,max) {
    	this.removeClass('ui-state-error');
		if ( this.val().length > max || this.val().length < min ) {
			this.addClass('ui-state-error');
			return false;
		} else {
			return true;
		}
    };   

/*
 * Plugin jquery permettant de tester une expression régulière sur un champ input
 * Change son statut si il n'est pas valide
 */
    $.fn.checkRegexp = function(regexp) {
    	this.removeClass('ui-state-error');
		if ( !( regexp.test( this.val() ) ) ) {
			this.addClass('ui-state-error');
			return false;
		} else {
			return true;
		}
    };
    
/*
 * Plugin jquery d'édition de formulaire
 * Cache le formulaire pour afficher sa valeur dans une span
 */
   /* $.fn.inputToText = function(pType) {
    	this.hide();
		if(this.context.nodeName == 'SELECT') {
			this.after("<span name=\"" + this.attr('name') + "\">" + this.children('option:selected').text() + "</span>");
		} else {
			var lVal = this.val();
			if(pType === "montant") {
				lVal = lVal.numberFrToDb();
				if(isNaN(lVal) || lVal.isEmpty()) {lVal = 0;}
				lVal = parseFloat(lVal).nombreFormate(2,',',' ');
			}
			this.after("<span name=\"" + this.attr('name') + "\">" + lVal + "</span>");
		}
		return this;
    };*/
    
/*
 * Plugin jquery d'édition de formulaire
 * Cache la span suivante de l'input pour afficher l'input
 */    
   /* $.fn.textToInput = function() {
    	this.show();
    	this.next().hide();
		return this;
    };    */
})(jQuery);

function clone(srcInstance)
{
	/*Si l'instance source n'est pas un objet ou qu'elle ne vaut rien c'est une feuille donc on la retourne*/
	if(typeof(srcInstance) != 'object' || srcInstance == null) { return srcInstance; }
	/*On appel le constructeur de l'instance source pour crée une nouvelle instance de la même classe*/
	var newInstance = {};
	if(srcInstance.constructor() != undefined) {
		newInstance = srcInstance.constructor();
	}
	/*On parcourt les propriétés de l'objet et on les recopies dans la nouvelle instance*/
	for(var i in srcInstance) {
		newInstance[i] = clone(srcInstance[i]);
	}
	/*On retourne la nouvelle instance*/
	return newInstance;
}

//Function to get the Max value in Array
Array.max = function( array ){
return Math.max.apply( Math, array );
};

// Function to get the Min value in Array
Array.min = function( array ){
return Math.min.apply( Math, array );
};

function getDateAujourdhuiDb() {
	lDate = new Date();
	lAnnee = lDate.getFullYear();
	lMois = lDate.getMonth() + 1;
	if (lMois < 10) {lMois = '0' + lMois;}
	lJour = lDate.getDate();
	if (lJour < 10) {lJour = '0' + lJour;}
	return lAnnee + '-' + lMois + '-' + lJour;	
};

function getTimeAujourdhuiDb() {
	lDate = new Date();	
	lHeure = lDate.getHours();
	if (lHeure < 10) {lHeure = '0' + lHeure;}
	lMinute = lDate.getMinutes();
	if (lMinute < 10) {lMinute = '0' + lMinute;}
	lSeconde = lDate.getSeconds();
	if (lSeconde < 10) {lSeconde = '0' + lSeconde;}	
	return lHeure + ':' + lMinute + ':' + lSeconde;
};

function getDateTimeAujourdhuiDb() {
	return getDateAujourdhuiDb() + ' ' + getTimeAujourdhuiDb();
};

String.prototype.nombreFormate = function(decimales, signe, separateurMilliers) {
	return parseFloat(this).nombreFormate(decimales, signe, separateurMilliers);
};

function getPremierJourDuMois() {
	var lDate = new Date();
	lMois = lDate.getMonth() + 1;
	if (lMois < 10) {lMois = '0' + lMois;}
	return lDate.getFullYear() + '-' + lMois + '-01';
};

function getDernierJourDuMois() {
	var lDate = new Date();
	var lFinMois = new Date(lDate.getFullYear(),lDate.getMonth() + 1 , 0);
	lMois = lDate.getMonth() + 1;
	if (lMois < 10) {lMois = '0' + lMois;}
	lJour = lFinMois.getDate();
	if (lJour < 10) {lJour = '0' + lJour;}
	return lDate.getFullYear() + '-' + lMois + '-' + lJour;
};

function differenceDateTime(pDate1,pDate2) {
	var lDateTime1 = pDate1.split(' ');
	var lDate1 = lDateTime1[0].split('-');
	var lTime1 = lDateTime1[1].split(':');
	
	var lDateTime2 = pDate2.split(' ');
	var lDate2 = lDateTime2[0].split('-');
	var lTime2 = lDateTime2[1].split(':');
	
	var lNegatif = false;
	var lAnnee = lDate1[0] - lDate2[0];
	if(lAnnee < 0) { lNegatif = true; lAnnee = lAnnee * -1; }
	if(lAnnee < 10 && lAnnee > -10) {		
		lAnnee = '0' + lAnnee.toString();
	} else {
		lAnnee = lAnnee.toString();
	}
	var lMois = lDate1[1] - lDate2[1];
	if(lMois < 0) { lNegatif = true; lMois = lMois * -1; }	
	if(lMois < 10 && lMois > -10) {		
		lMois = '0' + lMois.toString();
	} else {
		lMois = lMois.toString();
	}
	var lJour = lDate1[2] - lDate2[2];
	if(lJour < 0) { lNegatif = true; lJour = lJour * -1; }	
	if(lJour < 10 && lJour > -10) {
		lJour = '0' + lJour.toString();
	} else {
		lJour = lJour.toString();
	}
	var lHeure = lTime1[0] - lTime2[0];
	if(lHeure < 0) { lNegatif = true; lHeure = lHeure * -1; }	
	if(lHeure < 10 && lHeure > -10) {		
		lHeure = '0' + lHeure.toString();
	} else {
		lHeure = lHeure.toString();
	}
	var lMinute = lTime1[1] - lTime2[1];		
	if(lMinute < 0) { lNegatif = true; lMinute = lMinute * -1; }	
	if(lMinute < 10 && lMinute > -10) {
		lMinute = '0' + lMinute.toString();
	} else {
		lMinute = lMinute.toString();
	}
	var lSeconde = lTime1[2] - lTime2[2];		
	if(lSeconde < 0) { lNegatif = true; lSeconde = lSeconde * -1; }
	if(lSeconde < 10 && lSeconde > -10) {
		lSeconde = '0' + lSeconde.toString();
	} else {
		lSeconde = lSeconde.toString();
	}
	
	var lRetour = lAnnee + lMois + lJour + lHeure + lMinute + lSeconde;
	if(lNegatif) {lRetour = '-' + lRetour;}
	
	return parseFloat(lRetour);
};

function htmlEncode(value){
  return $('<div/>').text(value).html();
};

function htmlDecode(value){
  return $('<div/>').html(value).text();
};


function jourSem(pDate) {
	var lDate = new Date(pDate);
	return gJourSemaine[ lDate.getDay() ];
};

	
/*
 * +-------------------------------------+
 * Number.prototype.nombreFormate
 * +-------------------------------------+
 * Params (facultatifs):
 * - Int decimales: nombre de decimales (exemple: 2)
 * - String signe: le signe precedent les decimales (exemple: "," ou ".")
 * - String separateurMilliers: comme son nom l'indique
 * Returns:
 * - String chaine formatee
 */
 Number.prototype.nombreFormate = function (decimales, signe, separateurMilliers) {
	 var _sNombre = String(this), i, _sRetour = "", _sDecimales = "";
	 if (decimales == undefined) decimales = 2;
	 if (signe == undefined) signe = '.';
	 if (separateurMilliers == undefined) separateurMilliers = ' ';
	 
	 function separeMilliers (sNombre) {
		 var sRetour = "";
		 while (sNombre.length % 3 != 0) {
			 sNombre = "0" + sNombre;
		 }
		
		 for (i = 0; i < sNombre.length; i += 3) {
			 if (i == sNombre.length-1) separateurMilliers = '';
			 sRetour += sNombre.substr(i, 3)+separateurMilliers;
		 }
		 
		 while (sRetour.substr(0, 1) == "0") {
			 sRetour = sRetour.substr(1);
		 }
		 // Pour le cas où l'on affiche 0
		 if(sRetour == separateurMilliers) {
			 sRetour = "0" + separateurMilliers;
		 }
		 return sRetour.substr(0, sRetour.lastIndexOf(separateurMilliers));
	 }
	 
	 if (_sNombre.indexOf('.') == -1) {
		 for (i = 0; i < decimales; i++) {
			 _sDecimales += "0";
		 }
		 _sRetour = separeMilliers(_sNombre)+ String(signe) +_sDecimales;
	 } else {
		 var sDecimalesTmp = (_sNombre.substr(_sNombre.indexOf('.')+1));
		 
		 if (sDecimalesTmp.length > decimales) {
			 var nDecimalesManquantes = sDecimalesTmp.length - decimales;
			 var nDiv = 1;
			 for (i = 0; i < nDecimalesManquantes; i++) {
				 nDiv *= 10;
			 }
			 var j = '';
			 for (i = 0; i < sDecimalesTmp.length; i++) {
				 if(sDecimalesTmp[i] == '0') {
					 j+= '0';
				 } else {
					 i = sDecimalesTmp.length;
				 }
			 }
			 _sDecimales = j + Math.round(Number(sDecimalesTmp) / nDiv);
		} else if (sDecimalesTmp.length < decimales) {
			 var nDecimalesManquantes = decimales - sDecimalesTmp.length;
			 var sNvDecimale = '';
			 for (i = 0; i < nDecimalesManquantes; i++) {
				 sNvDecimale += '0';
			 }
			 _sDecimales = sDecimalesTmp + sNvDecimale;
		} else {
			_sDecimales = sDecimalesTmp;
		}
		
		 var lParEnt = "";
		if(parseFloat(_sNombre) < 1 && parseFloat(_sNombre) > 0) {
			lParEnt = "0";
		} else {
			lParEnt = separeMilliers(_sNombre.substr(0, _sNombre.indexOf('.')));
		}
		 _sRetour = lParEnt + String(signe) + _sDecimales;
	 }
	 return _sRetour;
};
    
    
/** 
 * Moteur de template en Javascript
 */ 
String.prototype.template = function(values,bname) { 
   // récupération de la chaine 
    var string = this.toString();
	
	var lListeBlocks = [];
	function chercherBlocks(data) {
		regexp = new RegExp("<!-- BEGIN (.*?) -->(.*)", "g"); 
		splits = regexp.exec(data);
		if(splits != null) {
			lListeBlocks.push(splits[1]);
			chercherBlocks(splits[2]);
		}
	}
	
	// Transformation du template de base pour le traitement js
	chercherBlocks(string);
	for (var i in lListeBlocks) {
		string = string.replace("<!-- BEGIN " + lListeBlocks[i] + " -->", "{" + lListeBlocks[i].split('.')[lListeBlocks[i].split('.').length - 1] + "{");
		string = string.replace("<!-- END " + lListeBlocks[i] + " -->", "}" + lListeBlocks[i].split('.')[lListeBlocks[i].split('.').length - 1] + "}"); 
	}
 
    // détection des blocs {blockName{ ... }blockName}  
    regexp = new RegExp("{(\\w*){(.*)}\\1}", "g"); 
    splits = regexp.exec(string); 

    // si un bloc est trouvé 
    if (splits) { 
        // on met de côté tous les éléments dont on dispose 
        var block     = splits[0]; // {blockName{ ... }blockName}  
        var blockName = splits[1]; // blockName  
        var content   = splits[2]; // ... 
        var partial   = ''; 
 
        for (tag in values) {  
            if (typeof(tag) == 'string') { 
            	if(bname != null)
            		lTag = bname + '.' + tag;
            	else
            		lTag = tag;	
                regexp = new RegExp('{'+ lTag +'}', 'g'); 
                content = content.replace(regexp, values[tag]); 
            } 
        }
        
        // on traite le contenu avec les données adéquates 
        // en le repassant par la fonction récursivement 
        // ainsi les éventuels blocs inclus seront traités aussi 
        for (tag in values[blockName]) { 
        	if(bname != null)
        		lBnameOut = bname + '.' + blockName;
        	else
        		lBnameOut = blockName;
            partial += content.template(values[blockName][tag],lBnameOut);      
        } 
        
        // le bloc {blockName{ ... }blockName} trouvé est replacé par le contenu traité 
        string = string.replace(block, partial); 
        
        // si des blocs suivent ils seront traités également 
        string = string.template(values); 
    } 
 
 
    // remplacement des tags {tag} 
    for (tag in values) {  
        if (typeof(tag) == 'string') { 
        	if(bname != null)
        		lTag = bname + '.' + tag;
        	else
        		lTag = tag;	
        	
            regexp = new RegExp('{'+ lTag +'}', 'g'); 
            string = string.replace(regexp, values[tag]); 
        } 
    } 
 
    // suppression des tags vides 
    return string.replace(/{\w+}/g, ''); 
}; 

sortABC = function(a, b){			
	return a[0] > b[0] ? 1 : -1;
};

;function Infobulles() {
	this.init = function() {
		$(".com-infobulle").remove();
		$(".ui-state-error").removeClass("ui-state-error");
		$("#contenu_message_information").text("");
		$("#widget_message_information").hide();
	};
	
	this.generation = function(pData,pNomObj) {	
		var lMessageInformation = false;
		var lData = new Array();
		lData['membres'] = new Array();		
		if(!pData.valid) {
			for( i in pData) {
				if(i != 'valid') {
					if(pData[i] && pData[i].valid === false && pData[i].erreurs) {						
						var membre = new Array();
						membre['nom'] = pNomObj + i;
						
						membre['erreurs'] = new Array();
						for(err in pData[i].erreurs) {							
							var e = new Array();
							e['code'] =  pData[i].erreurs[err].code;
							if(String(e['code'])[0] == 3){lMessageInformation = true;} // Test si c'est un message d'information
							//e['code'] =  pNomObj + i;
							e['message'] = pData[i].erreurs[err].message;
							membre['erreurs'].push(e);
						}
						
						if(i == 'log' || $("#" + pNomObj + i ).length == 0) {
							/*var lDataTemp = new Array();
							lDataTemp['membres'] = new Array();	
							lDataTemp['membres'].push(membre);
							*/
							var lHtml = $("#contenu_message_information").html() + TemplateData.infobulleLog.template(membre);
							lHtml = $(lHtml);
							
							// Ajout des actions sur les infobulles
							if(lHtml.find('.action-ifb').size() > 0) {								
								var lAction = new ActionInfobulles();
								$(membre['erreurs']).each(function() {
									lHtml = lAction.affect(lHtml,this.code);									
								});								
							}							
							
							$("#contenu_message_information").html(lHtml);
							
							// Si il s'agit d'un message (code commence par 3) d'information il y a un autohide
							if(lMessageInformation) {
								$("#widget_message_information").delay(gTempsTransition).fadeIn(gTempsTransitionUnique).delay(gTempsTransitionMsgInfo).fadeOut(gTempsTransitionUnique);
							}
							// Message d'erreur classique
							else {
								$("#widget_message_information").delay(gTempsTransition).fadeIn(gTempsTransitionUnique);
							}							
						} else {						
							lData['membres'].push(membre);
							$("#" + pNomObj + i ).addClass('ui-state-error');
							Infobulle.afficher($("#" + pNomObj + i ));	
						}
					} else if (pData[i] && ( !(pData[i].valid === true) || (pData[i].valid === false && !pData[i].erreurs) )) {
						this.generation(pData[i],pNomObj+i);
					}
				}
			}
		}	
		$('body').append(TemplateData.infobulle.template(lData));
	};
		
	this.generer = function(pData,pNomObj) {
		this.init();
		if(!pNomObj) {lNomObj = '';} else {lNomObj = pNomObj;}
		this.generation(pData,lNomObj);
	};
	
	this.afficher = function(pInput) {
		var infobulle = {};				
		function apparition() {
			var div = '#ifb-'+pInput.attr('id');
			infobulle = $(div);
			infobulle.hide();			
			var yOffset = pInput.height() + 8;
			var xOffset = pInput.width()/2;
			var pos = pInput.offset();
			var nPos = pos;
			nPos.top = pos.top + yOffset;
			nPos.left = pos.left + xOffset;
			
			// Change la position si l'infobulle dépasse du site
			var posSite = $("#site").offset();
			var nPosSite = posSite;
			
			if( (nPos.left + infobulle.width()) > (nPosSite.left + $("#site").width()) ) {nPos.left -= infobulle.width();}
			if( (nPos.top + infobulle.height()) > (nPosSite.top + $("#site").height()) ) {nPos.top -= (infobulle.height() + 2*pInput.height() + 8);}
						
			infobulle.css('position', 'absolute').css('z-index', '11000');
			infobulle.css(nPos).fadeIn(gTempsTransitionUnique);	
		}
		function disparition() { //infobulle.fadeOut(gTempsTransitionUnique);
			infobulle.stop().fadeTo(0,1).fadeOut(gTempsTransitionUnique);
		}
		
		pInput.hover( function() {apparition();}, function() {disparition();});
	};
}String.prototype.dateFrToDb = function() {
	var pDate = this.toString();
	if(pDate !== '') {
		if(pDate.checkDateExist('fr') && pDate.checkDate('fr'))
			return pDate[6]+pDate[7]+pDate[8]+pDate[9]+'-'+pDate[3]+pDate[4]+'-'+pDate[0]+pDate[1];
	}
	return '';
};

String.prototype.dateDbToFr = function() {
	var pDate = this.toString();
	if(pDate !== '') {
		if(pDate.checkDateExist('db') && pDate.checkDate('db'))
			return pDate[8]+pDate[9]+'/'+pDate[5]+pDate[6]+'/'+pDate[0]+pDate[1]+pDate[2]+pDate[3];
	}
	return '';
};

String.prototype.dateDbToTri = function() {
	var pDate = this.toString();
	if(pDate !== '') {
		if(pDate.checkDateExist('db') && pDate.checkDate('db'))
			return pDate[0]+pDate[1]+pDate[2]+pDate[3]+pDate[5]+pDate[6]+pDate[8]+pDate[9];
	}
	return '';
};

String.prototype.numberFrToDb = function() {
	var pNumber = this.toString();
	if(pNumber !== '') {
		return pNumber.replace(',','.').replace(' ','');
	}
	return '';
};

String.prototype.extractDbDate = function() {
	var pDate = this.toString();
	if(pDate !== '') {
		return pDate[0] + pDate[1] + pDate[2] + pDate[3] + pDate[4] + pDate[5] + pDate[6] + pDate[7] + pDate[8] + pDate[9];
	}
	return '';
};

String.prototype.extractDbHeure = function() {
	var pDate = this.toString();
	if(pDate !== '') {
		return pDate[11] + pDate[12];
	}
	return '';
};

String.prototype.extractDbMinute = function() {
	var pDate = this.toString();
	if(pDate !== '') {
		return pDate[14] + pDate[15];
	}
	return '';
};;function MarcheVO() {
	this.id = '';
	this.numero = '';
	this.nom = '';
	this.description = '';
	this.dateMarcheDebut = '';
	this.timeMarcheDebut = '';
	this.dateMarcheFin = '';
	this.timeMarcheFin = '';
	this.dateDebutReservation = '';
	this.timeDebutReservation = '';
	this.dateFinReservation = '';
	this.timeFinReservation = '';
	this.archive = '';
	this.produits = new Array();
	this.produitsAbonnement = new Array();
};function RechercheListeOperationVO() {
	this.idMarche = '';
	this.dateDebut = '';
	this.dateFin = '';
};;function ProduitBonDeCommandeVO() {
	this.id = '';
	this.dcomId = '';
	this.quantite = '';
	this.prix = '';
}
;function IdentificationVO() {
	this.id = '';
	this.login = '';
	this.pass = '';
}
;function ExportFactureVO() {
	this.id = '';
	this.format = '';
};function RechercheListeFactureVO() {
	this.idMarche = '';
	this.dateDebut = '';
	this.dateFin = '';
};;function ProduitAbonnementVO() {
	this.id = '';
	this.idNomProduit = '';
	this.unite = '';
	this.stockInitial = '';
	this.max = '';
	this.frequence = '';
	this.lots = [];
	this.lotRemplacement = [];
	this.quantiteReservation = -1;
	this.tailleLotResaMax = -1;
};;function CaracteristiqueVO() {
	this.id = '';
	this.nom = '';
	this.description = '';
};function NomProduitVO() {
	this.id = '';
	this.nom = '';
	this.description = '';
	this.idCategorie = '';
}
;function FermeVO() {
	this.id = '';
	this.numero = '';
	this.compte = '';
	this.nom = '';
	this.siren = '';
	this.adresse = '';
	this.codePostal = '';
	this.ville = '';
	this.dateAdhesion = '';
	this.description = '';
};function NomProduitCatalogueVO() {
	this.id = '';
	this.numero = '';
	this.idNomProduit = '';
	this.idCategorie = '';
	this.nom = '';
	this.description = '';
	this.producteurs = [];
	this.caracteristiques = [];
	this.modelesLot = [];
};function RechercheListeAchatVO() {
	this.idMarche = '';
	this.dateDebut = '';
	this.dateFin = '';
};function CompteSolidaireModifierVirementVO() {
	this.id = '';
	this.montantActuel = '';
	this.montant = '';
	this.solde = '';
};function CommandeCompleteVO() {
	this.id = '';
	this.numero = '';
	this.nom = '';
	this.description = '';
	this.dateMarcheDebut = '';
	this.timeMarcheDebut = '';
	this.dateMarcheFin = '';
	this.timeMarcheFin = '';
	this.dateDebutReservation = '';
	this.timeDebutReservation = '';
	this.dateFinReservation = '';
	this.timeFinReservation = '';
	this.archive = '';
	this.produits = new Array();
}
;function xxxRechargementCompteVO() {
	this.id = '';
	this.montant = '';
	this.typePaiement = '';
	this.champComplementaire = [];
};;function ProduitDetailFactureVO() {
	this.idNomProduit = '';
	this.idStock = '';
	this.idDetailOperation = '';
	this.idStockSolidaire = '';
	this.quantite = '';
	this.unite = '';
	this.quantiteSolidaire = '';
	this.uniteSolidaire = '';
	this.montant = '';
};;function AchatVO() {
	this.operationAchat = '';
	this.operationAchatSolidaire = '';
	this.produits = [];
	this.rechargement = '';
};;function ProduitCommandeVO() {
	this.id = '';
	this.idNom = '';
	this.nom = '';
	this.description = '';
	this.idCategorie = '';
	this.categorie = '';
	this.descriptionCategorie = '';
	this.unite = '';
	this.qteMaxCommande = '';
	this.qteRestante = '';
	this.stockInitial = '';
	this.idProducteur = '';
	this.lots = new Array();
}
;function ModeleLotVO() {
	this.id = '';
	this.idNomProduit = '';
	this.quantite = '';
	this.unite = '';	
	this.prix = '';
};function ProduitAjoutAchatVO() {
	this.id = '';
	this.idCompte = '';
	this.idMarche = '';
	this.idOperation = '';
	this.idNomProduit = '';
	this.quantite = '';
	this.prix = '';
	this.solidaire = '';
};function ProduitsBonDeCommandeVO() {
	this.id = '';
	this.id_commande = '';
	this.id_producteur = '';
	this.export_type = '';
	this.produits = new Array();
}
;function ProduitBonDeLivraisonVO() {
	this.id = '';
	this.quantite = '';
	this.quantiteSolidaire = '';
	this.prix = '';
}
;function ProduitsBonDeLivraisonVO() {
	this.id = '';
	this.id_commande = '';
	this.id_compte_producteur = '';
	//this.export_type = '';
	this.produits = new Array();
	this.typePaiement = '';
	this.total = '';
	this.typePaiementChampComplementaireObligatoire = '';
	this.typePaiementChampComplementaire = '';
}
function CompteZeybuSupprimerVirementVO() {
	this.id = '';
}function CompteSolidaireAjoutVirementVO() {
	this.id = '';
	this.montant = '';
	this.solde = '';
};function ExportListeReservationVO() {
	this.id = '';
	this.pParam = '';
	this.export_type = '';
	this.id_commande = '';
	this.id_produits = '';
	this.format = '';
}
;function CategorieProduitVO() {
	this.id = '';
	this.nom = '';
	this.description = '';
};function ChampComplementaireVO() {
	this.id = '';
	this.opeId = '';
	this.obligatoire = '';
	this.valeur = '';
};;function ListeReservationCommandeVO() {
	this.detailReservation = new Array();
}
;function BanqueVO() {
	this.id = '';
	this.nomCourt = '';
	this.nom = '';
	this.description = '';
	this.etat = '';
}function CompteZeybuAjoutVirementVO() {
	this.idCptDebit = '';
	this.idCptCredit = '';
	this.montant = '';
	this.type = '';
};function CompteSpecialVO() {
	this.id = '';
	this.login = '';
	this.motPasse = '';
	this.motPasseConfirm = '';
	this.type = '';
};function ReservationCommandeVO() {
	this.id = '';
	this.stoQuantite = '';
	this.stoIdDetailCommande = '';
}
;function ProduitDetailAchatVO() {
	this.idNomProduit = '';
	this.idStock = '';
	this.idDetailOperation = '';
	this.idStockSolidaire = '';
	this.idDetailOperationSolidaire = '';
	
	this.idDetailCommande = '';
	this.idModeleLot = '';

	this.idDetailCommandeSolidaire = '';
	this.idModeleLotSolidaire = '';
	
	this.quantite = '';
	this.unite = '';
	this.montant = '';
	this.quantiteSolidaire = '';
	this.uniteSolidaire = '';
	this.montantSolidaire = '';
};;function InfoAdherentVO() {
	this.id = '';
	this.motPasse = '';
	this.motPasseNouveau = '';
	this.motPasseConfirm = '';
}
function CompteZeybuModifierVirementVO() {
	this.id = '';
	this.montant = '';
	this.solde = '';
}function StockQuantiteVO() {
	this.id = '';
	this.quantite = '';
	this.quantiteSolidaire = '';
}
;function DetailCommandeVO() {
	this.id = '';
	this.idProduit = '';
	this.taille = '';
	this.prix = '';
}
;function AchatCommandeVO() {
	this.id = '';
	this.idCompte = '';
	this.produits = new Array();
	this.produitsSolidaire = new Array();
	this.rechargement = '';
}
;function ProducteurVO() {
	this.id = '';
	this.idFerme = '';
	this.nom = '';
	this.prenom = '';
	this.dateNaissance = '';
	this.commentaire = '';
	this.courrielPrincipal = '';
	this.courrielSecondaire = '';
	this.telephonePrincipal = '';
	this.telephoneSecondaire = '';
	this.adresse = '';
	this.codePostal = '';
	this.ville = '';
}
;function ProduitMarcheVO() {
	this.id = '';
	this.idNom = '';
	this.nom = '';
	this.description = '';
	this.idCategorie = '';
	this.categorie = '';
	this.descriptionCategorie = '';
	this.unite = '';
	this.qteMaxCommande = '';
	this.qteRestante = '';
	this.stockInitial = '';
	this.type = '';
	this.lots = [];
	this.lotRemplacement = [];
	this.tailleLotResaMax = -1;
	this.quantiteReservation = -1;
};function FactureVO() {
	this.id = '';
	this.operationProducteur = '';
	this.operationZeybu = '';
	this.produits = [];
};function CompteSolidaireSupprimerVirementVO() {
	this.id = '';
};function AdherentVO() {
	this.id = '';
	this.idAdherentPrincipal = '';
	this.idAncienAdherentPrincipal = '';
	this.numero = '';
	this.compte = '';
	this.idCompte = '';
	this.nom = '';
	this.prenom = '';
	this.courrielPrincipal = '';
	this.courrielSecondaire = '';
	this.telephonePrincipal = '';
	this.telephoneSecondaire = '';
	this.adresse = '';
	this.codePostal = '';
	this.ville = '';
	this.dateNaissance = '';
	this.dateAdhesion = '';
	this.commentaire = '';
	this.modules = new Array();
}
;function CompteAbonnementVO() {
	this.id = '';
	this.idCompte = '';
	this.idProduitAbonnement = '';
	this.idLotAbonnement = '';
	this.quantite = '';	
	this.dateDebutSuspension = '';	
	this.dateFinSuspension = '';	
};function ExportBonReservationVO() {
	this.id = '';
	this.id_commande = '';
	this.format = '';
	this.idCompteFerme = '';
};function OperationDetailVO() {
	this.id = '';
	this.idCompte = '';
	this.montant = '';
	this.libelle = '';
	this.date = '';
	this.typePaiement = '';
	this.type = '';
	this.tppId = '';
	this.tppType = '';
	this.tppChampComplementaire = '';
	this.tppVisible = '';
	this.champComplementaire = [];
};;function ProduitAchatVO() {
	this.id = '';
	this.nproId = '';
	this.dcomId = '';
	this.lotId = '';
	this.quantite = '';
	this.prix = '';
}
;function OperationDetailVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idCompte = new VRelement();
	this.montant = new VRelement();
	this.libelle = new VRelement();
	this.date = new VRelement();
	this.typePaiement = new VRelement();
	this.type = new VRelement();
	this.tppId = new VRelement();
	this.tppType = new VRelement();
	this.tppChampComplementaire = new VRelement();
	this.tppVisible = new VRelement();
	this.champComplementaire = [];
};;function FactureVR() {
	this.valid = true;
	this.log = new VRelement();
	this.operation = new VRelement();
	this.operationProducteur = new VRelement();
	this.operationZeybu = new VRelement();
	this.montant = new VRelement();
	this.typePaiement = new VRelement();
	this.champComplementaire = [];
	this.produits = [];
};;function ProduitsBonDeCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.id_commande = new VRelement();
	this.id_compte_ferme = new VRelement();
	this.export_type = new VRelement();
	this.produits = new Array();
}
;function NomProduitCatalogueVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.numero = new VRelement();
	this.idNomProduit = new VRelement();
	this.idCategorie = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
	this.producteurs = new VRelement();
	this.caracteristiques = new VRelement();
	this.modelesLot = [];	
};function DetailCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idProduit = new VRelement();
	this.taille = new VRelement();
	this.prix = new VRelement();
}
;function CompteAbonnementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idCompte = new VRelement();
	this.idProduitAbonnement = new VRelement();
	this.idLotAbonnement = new VRelement();
	this.quantite = new VRelement();
	this.dateDebutSuspension = new VRelement();
	this.dateFinSuspension = new VRelement();
};function ChampComplementaireVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.obligatoire = new VRelement();
	this.valeur = new VRelement();
};;function IdentificationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.login = new VRelement();
	this.pass = new VRelement();
}
;function ListeReservationCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.detailReservation = new Array();
}
;function InfoAdherentVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.motPasse = new VRelement();
	this.motPasseNouveau = new VRelement();
	this.motPasseConfirm = new VRelement();
}
;function MarcheVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.numero = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
	this.dateMarcheDebut = new VRelement();
	this.timeMarcheDebut = new VRelement();
	this.dateMarcheFin = new VRelement();
	this.timeMarcheFin = new VRelement();
	this.dateDebutReservation = new VRelement();
	this.timeDebutReservation = new VRelement();
	this.dateFinReservation = new VRelement();
	this.timeFinReservation = new VRelement();
	this.archive = new VRelement();
	this.produits = new Array();
	this.produitsAbonnement = new Array();
}function CompteZeybuSupprimerVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
}function CompteSolidaireSupprimerVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
};function RechercheListeOperationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.idMarche = new VRelement();
	this.dateDebut = new VRelement();
	this.dateFin = new VRelement();
};;function ExportBonReservationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.id_commande = new VRelement();
	this.format = new VRelement();
	this.idCompteFerme = new VRelement();
}
;function NomProduitVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
	this.idCategorie = new VRelement();
}
;function ProduitBonDeLivraisonVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.quantite = new VRelement();
	this.quantiteSolidaire = new VRelement();
	this.prix = new VRelement();
}
;function ProduitCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idNom = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
	this.idCategorie = new VRelement();
	this.categorie = new VRelement();
	this.descriptionCategorie = new VRelement();
	this.unite = new VRelement();
	this.qteMaxCommande = new VRelement();
	this.qteRestante = new VRelement();
	this.stockInitial = new VRelement();
	this.idProducteur = new VRelement();
	this.lots = new Array();
};function ReservationCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.stoQuantite = new VRelement();
	this.stoIdDetailCommande = new VRelement();
}
;function CompteSpecialVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.login = new VRelement();
	this.motPasse = new VRelement();
	this.motPasseConfirm = new VRelement();
	this.type = new VRelement();
};function AdherentVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idAdherentPrincipal = new VRelement();
	this.idAncienAdherentPrincipal = new VRelement();
	this.numero = new VRelement();
	this.idCompte = new VRelement();
	this.compte = new VRelement();
	this.nom = new VRelement();
	this.prenom = new VRelement();
	this.courrielPrincipal = new VRelement();
	this.courrielSecondaire = new VRelement();
	this.telephonePrincipal = new VRelement();
	this.telephoneSecondaire = new VRelement();
	this.adresse = new VRelement();
	this.codePostal = new VRelement();
	this.ville = new VRelement();
	this.dateNaissance = new VRelement();
	this.dateAdhesion = new VRelement();
	this.commentaire = new VRelement();
	this.modules = new Array();
}
function CompteZeybuAjoutVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.idCptDebit = new VRelement();
	this.idCptCredit = new VRelement();
	this.montant = new VRelement();
	this.type = new VRelement();
};function xxxRechargementCompteVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.montant = new VRelement();
	this.typePaiement = new VRelement();
	this.champComplementaire = [];
};function CompteSolidaireAjoutVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.montant = new VRelement();
}
;function ExportFactureVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.format = new VRelement();
};;function ExportListeReservationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.pParam = new VRelement();
	this.export_type = new VRelement();
	this.id_commande = new VRelement();
	this.id_produits = new VRelement();
	this.format = new VRelement();
}
;function CategorieProduitVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
};function ProduitDetailAchatVR() {
	this.valid = true;
	this.log = new VRelement();
	this.idNomProduit = new VRelement();
	this.idStock = new VRelement();
	this.idDetailOperation = new VRelement();
	this.idStockSolidaire = new VRelement();
	this.idDetailOperationSolidaire = new VRelement();
	
	this.idDetailCommande = new VRelement();
	this.idModeleLot = new VRelement();
	this.idDetailCommandeSolidaire = new VRelement();
	this.idModeleLotSolidaire = new VRelement();
	
	this.quantite = new VRelement();
	this.unite = new VRelement();
	this.montant = new VRelement();
	this.quantiteSolidaire = new VRelement();
	this.uniteSolidaire = new VRelement();
	this.montantSolidaire = new VRelement();
};;function VRelement(pValid, pErreurs) {
	if(pValid != undefined) {this.valid = pValid;} else {this.valid = true;}
	if(pErreurs != undefined) {this.erreurs = pErreurs;} else {this.erreurs = [];}
};function CompteZeybuModifierVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.montant = new VRelement();
};function ProduitDetailFactureVR() {
	this.valid = true;
	this.log = new VRelement();
	this.idNomProduit = new VRelement();
	this.idStock = new VRelement();
	this.idDetailOperation = new VRelement();
	this.idStockSolidaire = new VRelement();
	this.quantite = new VRelement();
	this.unite = new VRelement();
	this.quantiteSolidaire = new VRelement();
	this.uniteSolidaire = new VRelement();
	this.montant = new VRelement();
};;function FermeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.numero = new VRelement();
	this.compte = new VRelement();
	this.siren = new VRelement();
	this.nom = new VRelement();
	this.adresse = new VRelement();
	this.codePostal = new VRelement();
	this.ville = new VRelement();
	this.dateAdhesion = new VRelement();
	this.description = new VRelement();
};function VRerreur(pCode, pMessage) {
	if(pCode != undefined) {this.code = pCode;} else {this.code = '';}
	if(pMessage != undefined) {this.message = pMessage;} else {this.message = '';}
};function ProduitMarcheVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idNom = new VRelement();
	this.description = new VRelement();
	this.unite = new VRelement();
	this.qteMaxCommande = new VRelement();
	this.qteRestante = new VRelement();
	this.stockInitial = new VRelement();
	this.type = new VRelement();
	this.lots = new Array();
}function CompteSolidaireModifierVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.montant = new VRelement();
};function RechercheListeAchatVR() {
	this.valid = true;
	this.log = new VRelement();
	this.idMarche = new VRelement();
	this.dateDebut = new VRelement();
	this.dateFin = new VRelement();
};;function ProduitAbonnementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idNomProduit = new VRelement();
	this.unite = new VRelement();
	this.stockInitial = new VRelement();
	this.max = new VRelement();
	this.frequence = new VRelement();
	this.lots = [];
	this.lotRemplacement = [];
};;function TemplateVR(pValid, pLog) {
	if(pValid != undefined) {this.valid = pValid;} else {this.valid = true;}
	if(pLog != undefined) {this.log = pLog;} else {this.log = new VRelement();}
};;function ProduitAchatAdherentVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.quantite = new VRelement();
	this.prix = new VRelement();
};function CommandeCompleteVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.numero = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
	this.dateMarcheDebut = new VRelement();
	this.timeMarcheDebut = new VRelement();
	this.dateMarcheFin = new VRelement();
	this.timeMarcheFin = new VRelement();
	this.dateDebutReservation = new VRelement();
	this.timeDebutReservation = new VRelement();
	this.dateFinReservation = new VRelement();
	this.timeFinReservation = new VRelement();
	this.archive = new VRelement();
	this.produits = new Array();
}
;function BanqueVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.nomCourt = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
	this.etat = new VRelement();
};function ModeleLotVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idNomProduit = new VRelement();
	this.quantite = new VRelement();
	this.unite = new VRelement();	
	this.prix = new VRelement();
};function ProduitsBonDeLivraisonVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.id_commande = new VRelement();
	this.id_compte_ferme = new VRelement();
	//this.export_type = new VRelement();
	this.produits = new Array();
	this.typePaiement = new VRelement();
	this.total = new VRelement();
	this.typePaiementChampComplementaireObligatoire = new VRelement();
	this.typePaiementChampComplementaire = new VRelement();
}
;function ProduitAchatVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.dcomId = new VRelement();
	this.lotId = new VRelement();
	this.nproId = new VRelement();
	this.quantite = new VRelement();
	this.prix = new VRelement();
}
;function ProduitAjoutAchatVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idCompte = new VRelement();
	this.idMarche = new VRelement();
	this.idOperation = new VRelement();
	this.idNomProduit = new VRelement();
	this.quantite = new VRelement();
	this.prix = new VRelement();
	this.solidaire = new VRelement();
}
;function ProduitBonDeCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.dcomId = new VRelement();
	this.quantite = new VRelement();
	this.prix = new VRelement();
}
;function CaracteristiqueVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
};function RechercheListeFactureVR() {
	this.valid = true;
	this.log = new VRelement();
	this.idMarche = new VRelement();
	this.dateDebut = new VRelement();
	this.dateFin = new VRelement();
};;function AchatCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idCompte = new VRelement();
	this.produits = new Array();
	this.produitsSolidaire = new Array();
	this.rechargement = new VRelement();
}
;function ProducteurVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idFerme = new VRelement();
	this.nom = new VRelement();
	this.prenom = new VRelement();
	this.dateNaissance = new VRelement();
	this.compte = new VRelement();
	this.commentaire = new VRelement();
	this.courrielPrincipal = new VRelement();
	this.courrielSecondaire = new VRelement();
	this.telephonePrincipal = new VRelement();
	this.telephoneSecondaire = new VRelement();
	this.adresse = new VRelement();
	this.codePostal = new VRelement();
	this.ville = new VRelement();
}function StockQuantiteVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.quantite = new VRelement();
	this.quantiteSolidaire = new VRelement();
}
;function AchatVR() {
	this.valid = true;
	this.log = new VRelement();
	this.operationAchat = new VRelement();
	this.operationAchatSolidaire = new VRelement();
	this.produits = [];
	this.rechargement = new VRelement();
};;function AchatAdherentVR() {
	this.valid = true;
	this.log = new VRelement();
	this.idAchat = new VRelement();
	this.total = new VRelement();
	this.produits = new Array();
}
;function CategorieProduitValid() { 
	this.validAjout = function(pData) { 
		var lVR = new NomProduitVR();
		//Tests Techniques
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}

		return lVR;
	};
	
	this.validUpdate = function(pData) {
		var lVR = new NomProduitVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		return lVR;
	};
};function CaracteristiqueValid() { 
	this.validAjout = function(pData) { 
		var lVR = new CaracteristiqueVR();
		//Tests Techniques
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}

		return lVR;
	};
	
	this.validUpdate = function(pData) {
		var lVR = new CaracteristiqueVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		if(lVR.valid) {
			return this.validAjout(pData);
		}
		return lVR;
	};
};function ListeReservationCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ListeReservationCommandeVR();
		//Tests Techniques

		//Tests Fonctionnels
		if(isArray(pData.detailReservation)) {
			if(pData.detailReservation.length > 0) {
				$(pData.detailReservation).each(function() {
					var lValid = new ReservationCommandeValid();
					var lVrReservation = lValid.validAjout(this);
					if(!lVrReservation.valid){lVR.valid = false;}
					lVR.detailReservation.push(lVrReservation);
				});		
			} else {
				// Erreur il faut au moins un produit
				lVR.valid = false;
				lVR.log.valid = false;
				var erreur = new VRerreur();
				erreur.code = ERR_207_CODE;
				erreur.message = ERR_207_MSG;
				lVR.log.erreurs.push(erreur);}			
		} else {
			lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);
		}
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new ListeReservationCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ListeReservationCommandeVR();
			//Tests Techniques

			//Tests Fonctionnels
			if(isArray(pData.detailReservation)) {			
				if(pData.detailReservation.length > 0) {
					$(pData.detailReservation).each(function() {
						var lValid = new ReservationCommandeValid();
						var lVrReservation = lValid.validAjout(this);
						if(!lVrReservation.valid){lVR.valid = false;}
						lVR.detailReservation.push(lVrReservation);
					});				
				} else {
					// Erreur il faut au moins un produit
					lVR.valid = false;
					lVR.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_207_CODE;
					erreur.message = ERR_207_MSG;
					lVR.log.erreurs.push(erreur);}			
			} else {
				lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);
			}
			return lVR;
		}
		return lTestId;
	};

};function ProduitAchatValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitAchatVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.nproId))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix != '' && !pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.dcomId != '' && !pData.dcomId.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.dcomId != '' && !pData.dcomId.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.lotId != '' && !pData.lotId.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.lotId != '' && !pData.lotId.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}

		//Tests Fonctionnels
		if((isNaN(pData.quantite) || pData.quantite == 0 || pData.prix == '') && (!isNaN(pData.prix) && pData.prix != 0)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_214_CODE;erreur.message = ERR_214_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite >= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		
		if((isNaN(pData.prix) || pData.prix == 0 || pData.prix == '') && (!isNaN(pData.quantite) && pData.quantite != 0)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_213_CODE;erreur.message = ERR_213_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix >= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}
		
		if(pData.dcomId.isEmpty() && pData.lotId.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new ProduitAchatVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitAchatVR();
			//Tests Techniques
			if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(isNaN(parseInt(pData.nproId))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
			if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
			if(pData.prix != '' && !pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}
			if(pData.dcomId != '' && !pData.dcomId.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.dcomId != '' && !pData.dcomId.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.lotId != '' && !pData.lotId.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.lotId != '' && !pData.lotId.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}

			//Tests Fonctionnels
			if((isNaN(pData.quantite) || pData.quantite == 0) && (!isNaN(pData.prix) && pData.prix != 0)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_214_CODE;erreur.message = ERR_214_MSG;lVR.quantite.erreurs.push(erreur);}
			if(pData.quantite < 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
			
			if((isNaN(pData.prix) || pData.prix == 0) && (!isNaN(pData.quantite) && pData.quantite != 0)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_213_CODE;erreur.message = ERR_213_MSG;lVR.prix.erreurs.push(erreur);}
			if(pData.prix < 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

			if(pData.dcomId.isEmpty() && pData.lotId.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
			
			return lVR;
		}
		return lTestId;
	};

};function ProduitMarcheValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitMarcheVR();
		//Tests Techniques
		if(!pData.idNom.checkLength(0,11)) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNom.erreurs.push(erreur);}
		if(!pData.idNom.isInt()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNom.erreurs.push(erreur);}
		if(!pData.type.checkLength(0,11)) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.type.erreurs.push(erreur);}
		if(!pData.type.isInt()) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.type.erreurs.push(erreur);}
		
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.qteMaxCommande != "" && !pData.qteMaxCommande.checkLength(0,12)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteMaxCommande != "" && !pData.qteMaxCommande.isFloat()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteRestante != "" && !pData.qteRestante.checkLength(0,12)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		if(pData.qteRestante != "" && !pData.qteRestante.isFloat()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idNom.isEmpty()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNom.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.type.isEmpty()) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.type.erreurs.push(erreur);}

		if(parseFloat(pData.qteMaxCommande) > 9999999999.99) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) > 9999999999.99) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		if(parseFloat(pData.qteMaxCommande) <= 0 && parseFloat(pData.qteMaxCommande) != -1) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) <= 0 && parseFloat(pData.qteRestante) != -1) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteRestante.erreurs.push(erreur);}

		if(pData.qteRestante != -1 && pData.qteMaxCommande != -1 && parseFloat(pData.qteMaxCommande) > parseFloat(pData.qteRestante) ) {lVR.valid = false;lVR.qteRestante.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.qteRestante.erreurs.push(erreur);lVR.qteMaxCommande.erreurs.push(erreur);}

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
				if(pData.qteMaxCommande != -1 && lPetitLotTaille > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
				if(pData.qteRestante != -1 && lPetitLotTaille > parseFloat(pData.qteRestante)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteRestante.erreurs.push(erreur);}
				
			} else  {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_243_CODE;erreur.message = ERR_243_MSG;lVR.log.erreurs.push(erreur);}
			
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		
		return lVR;
	};
	
	this.validUpdate = function(pData) { 
		var lVR = new ProduitMarcheVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.type.checkLength(0,11)) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.type.erreurs.push(erreur);}
		if(!pData.type.isInt()) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.type.erreurs.push(erreur);}
		
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.qteMaxCommande != "" && !pData.qteMaxCommande.checkLength(0,12)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteMaxCommande != "" && !pData.qteMaxCommande.isFloat()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteRestante != "" && !pData.qteRestante.checkLength(0,12)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		if(pData.qteRestante != "" && !pData.qteRestante.isFloat()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.type.isEmpty()) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.type.erreurs.push(erreur);}

		if(parseFloat(pData.qteMaxCommande) > 9999999999.99) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) > 9999999999.99) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}
		
		if(parseFloat(pData.qteMaxCommande) <= 0 && parseFloat(pData.qteMaxCommande) != -1) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) <= 0 && parseFloat(pData.qteRestante) != -1) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteRestante.erreurs.push(erreur);}

		if(pData.qteRestante != -1 && pData.qteMaxCommande != -1 && parseFloat(pData.qteMaxCommande) > parseFloat(pData.qteRestante)){lVR.valid = false;lVR.qteRestante.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.qteRestante.erreurs.push(erreur);lVR.qteMaxCommande.erreurs.push(erreur);}
		
		if(pData.qteRestante != -1 && pData.quantiteReservation != -1 && parseFloat(pData.qteRestante) < pData.quantiteReservation) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_259_CODE;erreur.message = ERR_259_MSG;lVR.qteRestante.erreurs.push(erreur);}
		if(pData.qteMaxCommande != -1 && pData.tailleLotResaMax != -1 && parseFloat(pData.qteMaxCommande) < pData.tailleLotResaMax) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_260_CODE;erreur.message = ERR_260_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		
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
				if(pData.qteMaxCommande != -1 && lPetitLotTaille > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
				if(pData.qteRestante != -1 && lPetitLotTaille > parseFloat(pData.qteRestante)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteRestante.erreurs.push(erreur);}
				
			} else  {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_243_CODE;erreur.message = ERR_243_MSG;lVR.log.erreurs.push(erreur);}
			
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		
		if(!isArray(pData.lotRemplacement)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		
		
		return lVR;
	};
};function AchatCommandeValid() { 
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

};function DetailCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new DetailCommandeVR();
		//Tests Techniques
		if(!pData.idProduit.checkLength(0,11)) {lVR.valid = false;lVR.idProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idProduit.erreurs.push(erreur);}
		if(pData.idProduit != '' && !pData.idProduit.isInt()) {lVR.valid = false;lVR.idProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idProduit.erreurs.push(erreur);}
		if(!pData.taille.checkLength(0,12)) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.taille.erreurs.push(erreur);}
		if(!pData.taille.isInt()) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.taille.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.taille.isEmpty()) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.taille.erreurs.push(erreur);}
		if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}
		if(parseFloat(pData.taille) > 9999999999.99) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.taille.erreurs.push(erreur);}
		if(parseFloat(pData.prix) > 9999999999.99) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}

		// Taille et prix sont positifs
		if(parseFloat(pData.taille) <= 0) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.taille.erreurs.push(erreur);}
		if(parseFloat(pData.prix) <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new DetailCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new DetailCommandeVR();
			//Tests Techniques
			if(!pData.idProduit.checkLength(0,11)) {lVR.valid = false;lVR.idProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idProduit.erreurs.push(erreur);}
			if(!pData.idProduit.isInt()) {lVR.valid = false;lVR.idProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idProduit.erreurs.push(erreur);}
			if(!pData.taille.checkLength(0,12)) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.taille.erreurs.push(erreur);}
			if(!pData.taille.isInt()) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.taille.erreurs.push(erreur);}
			if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
			if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.idProduit.isEmpty()) {lVR.valid = false;lVR.idProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idProduit.erreurs.push(erreur);}
			if(pData.taille.isEmpty()) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.taille.erreurs.push(erreur);}
			if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}

			// Taille et prix sont positifs
			if(parseFloat(pData.taille) <= 0) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.taille.erreurs.push(erreur);}
			if(parseFloat(pData.prix) <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};

};function ProduitDetailFactureValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitDetailFactureVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.idNomProduit))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idStock != '' && isNaN(parseInt(pData.idStock))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idDetailOperation != '' && isNaN(parseInt(pData.idDetailOperation))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idStockSolidaire != '' && isNaN(parseInt(pData.idStockSolidaire))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}

		if(pData.quantite != '' && !pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.unite != '' && !pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.checkLength(0,12)) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.isFloat()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.uniteSolidaire != '' && !pData.uniteSolidaire.checkLength(0,20)) {lVR.valid = false;lVR.uniteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.uniteSolidaire.erreurs.push(erreur);}
		if(pData.montant != '' && !pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montant != '' && !pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idNomProduit == '') {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}

		if(pData.montant != '' && pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}

		if(pData.quantite != '' && pData.quantite < 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.quantiteSolidaire < 0) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.montant != '' && pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		
		return lVR;
	};
};;function ProduitBonDeCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitBonDeCommandeVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.dcomId.checkLength(0,11)) {lVR.valid = false;lVR.dcomId.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.dcomId.erreurs.push(erreur);}
		if(!pData.dcomId.isInt()) {lVR.valid = false;lVR.dcomId.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.dcomId.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix != '' && !pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix != '' && !pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.dcomId.isEmpty()) {lVR.valid = false;lVR.dcomId.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dcomId.erreurs.push(erreur);}
		
		if(pData.prix != '' && pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}

		if(pData.quantite != '' && pData.quantite < 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix != '' && pData.prix < 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}
		
		return lVR;
	};

	/*this.validDelete = function(pData) {
		var lVR = new ProduitBonDeCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitBonDeCommandeVR();
			//Tests Techniques
			if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
			if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
			if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}*/

};function ProduitAbonnementValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitAbonnementVR();
		//Tests Techniques
		if(!pData.idNomProduit.checkLength(0,11)) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idNomProduit))) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(!pData.stockInitial.checkLength(0,12)) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(!pData.stockInitial.isFloat()) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(!pData.max.checkLength(0,12)) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.max.erreurs.push(erreur);}
		if(!pData.max.isFloat()) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.max.erreurs.push(erreur);}
		if(!pData.frequence.checkLength(0,200)) {lVR.valid = false;lVR.frequence.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.frequence.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idNomProduit.isEmpty()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.stockInitial.isEmpty()) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(pData.max.isEmpty()) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.max.erreurs.push(erreur);}
		if(pData.frequence.isEmpty()) {lVR.valid = false;lVR.frequence.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.frequence.erreurs.push(erreur);}

		if(pData.stockInitial <= 0 ) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(pData.max <= 0 && pData.max != -1) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.max.erreurs.push(erreur);}
		if(pData.max != -1 && parseFloat(pData.max) > parseFloat(pData.stockInitial)) {lVR.valid = false;lVR.stockInitial.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.stockInitial.erreurs.push(erreur);lVR.max.erreurs.push(erreur);}
		
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
				if(pData.qteMaxCommande != -1 && lPetitLotTaille > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
				if(pData.qteRestante != -1 && lPetitLotTaille > parseFloat(pData.qteRestante)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteRestante.erreurs.push(erreur);}
				
			} else  {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_243_CODE;erreur.message = ERR_243_MSG;lVR.log.erreurs.push(erreur);}
			
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		
		return lVR;
	};
	
	this.validDelete = function(pData) { 
		var lVR = new ProduitAbonnementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};
	
	this.validUpdate = function(pData) { 
		var lVR = new ProduitAbonnementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(!pData.stockInitial.checkLength(0,12)) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(!pData.stockInitial.isFloat()) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(!pData.max.checkLength(0,12)) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.max.erreurs.push(erreur);}
		if(!pData.max.isFloat()) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.max.erreurs.push(erreur);}
		if(!pData.frequence.checkLength(0,200)) {lVR.valid = false;lVR.frequence.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.frequence.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.stockInitial.isEmpty()) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(pData.max.isEmpty()) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.max.erreurs.push(erreur);}
		if(pData.frequence.isEmpty()) {lVR.valid = false;lVR.frequence.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.frequence.erreurs.push(erreur);}

		if(pData.stockInitial <= 0 ) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(pData.max <= 0 && pData.max != -1) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.max.erreurs.push(erreur);}
		if(pData.max != -1 && parseFloat(pData.max) > parseFloat(pData.stockInitial)) {lVR.valid = false;lVR.stockInitial.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.stockInitial.erreurs.push(erreur);lVR.max.erreurs.push(erreur);}
		
		if(pData.quantiteReservation != -1 && parseFloat(pData.stockInitial) < pData.quantiteReservation) {lVR.valid = false;lVR.stockInitial.valid = false;var erreur = new VRerreur();erreur.code = ERR_259_CODE;erreur.message = ERR_259_MSG;lVR.stockInitial.erreurs.push(erreur);}
		if(pData.max != -1 && pData.tailleLotResaMax != -1 && parseFloat(pData.max) < pData.tailleLotResaMax) {lVR.valid = false;lVR.max.valid = false;var erreur = new VRerreur();erreur.code = ERR_260_CODE;erreur.message = ERR_260_MSG;lVR.max.erreurs.push(erreur);}
		
		
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
				if(pData.qteMaxCommande != -1 && lPetitLotTaille > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
				if(pData.qteRestante != -1 && lPetitLotTaille > parseFloat(pData.qteRestante)) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteRestante.erreurs.push(erreur);}
				
			} else  {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_243_CODE;erreur.message = ERR_243_MSG;lVR.log.erreurs.push(erreur);}
			
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		
		if(!isArray(pData.lotRemplacement)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		
		return lVR;
	};

};function CompteAbonnementValid() { 
	this.validAjout = function(pData,pDetailProduit) { 
		var lVR = new CompteAbonnementVR();

		//Tests Techniques
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.idProduitAbonnement.checkLength(0,11)) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idProduitAbonnement))) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(!pData.idLotAbonnement.checkLength(0,11)) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idLotAbonnement))) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(pData.idProduitAbonnement.isEmpty()) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(pData.idLotAbonnement.isEmpty()) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}

		if(pData.quantite <= 0 ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		
		var lQteRestante = parseFloat(pDetailProduit.proAboStockInitial) - parseFloat(pDetailProduit.proAboReservation);
		if(parseFloat(pDetailProduit.proAboMax) < lQteRestante && parseFloat(pDetailProduit.proAboMax) != -1) { 
			lQteRestante = pDetailProduit.proAboMax;
		}
		
		if(parseFloat(pData.quantite) > parseFloat(lQteRestante) ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.quantite.erreurs.push(erreur);}
		
		return lVR;
	};

	this.validUpdate = function(pData,pDetailProduit,pAbonnement) { 
		var lVR = new CompteAbonnementVR();

		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.idProduitAbonnement.checkLength(0,11)) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idProduitAbonnement))) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(!pData.idLotAbonnement.checkLength(0,11)) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idLotAbonnement))) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(pData.idProduitAbonnement.isEmpty()) {lVR.valid = false;lVR.idProduitAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idProduitAbonnement.erreurs.push(erreur);}
		if(pData.idLotAbonnement.isEmpty()) {lVR.valid = false;lVR.idLotAbonnement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idLotAbonnement.erreurs.push(erreur);}
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}

		if(pData.quantite <= 0 ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		
		var lQteRestante = parseFloat(pDetailProduit.proAboStockInitial) - parseFloat(pDetailProduit.proAboReservation) + parseFloat(pAbonnement.cptAboQuantite);
		if(parseFloat(pDetailProduit.proAboMax) < lQteRestante && parseFloat(pDetailProduit.proAboMax) != -1) { 
			lQteRestante = pDetailProduit.proAboMax;
		}
		
		if(parseFloat(pData.quantite) > parseFloat(lQteRestante) ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.quantite.erreurs.push(erreur);}
		
		return lVR;
	};
	
	this.validAjoutSuspension = function(pData) { 
		var lVR = new CompteAbonnementVR();

		//Tests Techniques
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.dateDebutSuspension.checkDate('db')) {lVR.valid = false;lVR.dateDebutSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateDebutSuspension.erreurs.push(erreur);}
		if(!pData.dateDebutSuspension.checkDateExist('db')) {lVR.valid = false;lVR.dateDebutSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateDebutSuspension.erreurs.push(erreur);}
		if(!pData.dateFinSuspension.checkDate('db')) {lVR.valid = false;lVR.dateFinSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateFinSuspension.erreurs.push(erreur);}
		if(!pData.dateFinSuspension.checkDateExist('db')) {lVR.valid = false;lVR.dateFinSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateFinSuspension.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(pData.dateDebutSuspension.isEmpty()) {lVR.valid = false;lVR.dateDebutSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateDebutSuspension.erreurs.push(erreur);}
		if(pData.dateFinSuspension.isEmpty()) {lVR.valid = false;lVR.dateFinSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateFinSuspension.erreurs.push(erreur);}

		if(!dateEstPLusGrandeEgale(pData.dateFinSuspension,pData.dateDebutSuspension,'db')) {lVR.valid = false;lVR.dateFinSuspension.valid = false;lVR.dateDebutSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_252_CODE;erreur.message = ERR_252_MSG;lVR.dateFinSuspension.erreurs.push(erreur);lVR.dateDebutSuspension.erreurs.push(erreur);}

		var lAujourdhui = getDateAujourdhuiDb();
		if(!dateEstPLusGrandeEgale(pData.dateFinSuspension,lAujourdhui,'db')) {lVR.valid = false;lVR.dateFinSuspension.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateFinSuspension.erreurs.push(erreur);}
		
		return lVR;
	};
	
	this.validDeleteSuspension = function(pData) { 
		var lVR = new CompteAbonnementVR();

		//Tests Techniques
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idCompte.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		return lVR;
	};
};function xxxRechargementCompteValid() { 
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
				
				
				
				
				/*var i = 0;
				while(pData.champComplementaire[i]) {
					var lVrChampComplementaire = lValidChampComplementaire.validUpdate(pData.champComplementaire[i]);
					
					if(!lVrChampComplementaire.valid){lVR.valid = false;}
					if(!pData.champComplementaire[i].id.isEmpty()) {
						lVR.champComplementaire[pData.champComplementaire[i].id] = lVrChampComplementaire;
					} else {
						lVR.champComplementaire.push(lVrChampComplementaire);
					}
					
					i++;
				}*/
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

};function NomProduitCatalogueValid() { 
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
			} else {
				lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_264_CODE;erreur.message = ERR_264_MSG;lVR.log.erreurs.push(erreur);
			}
		}
		return lVR;
	};
	
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
			} else {
				lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_264_CODE;erreur.message = ERR_264_MSG;lVR.log.erreurs.push(erreur);
			}
		}
		return lVR;
	};
};function ExportFactureValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ExportFactureVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}

		return lVR;
	};

	/*this.validDelete = function(pData) {
		var lVR = new ExportBonLivraisonVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ExportBonLivraisonVR();
			//Tests Techniques
			if(!pData.pParam.checkLength(0,1)) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pParam.erreurs.push(erreur);}
			if(!pData.pParam.isInt()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.pParam.erreurs.push(erreur);}
			if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
			if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.pParam.isEmpty()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pParam.erreurs.push(erreur);}
			if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
			if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}
*/
};function FermeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new FermeVR();
		//Tests Techniques
		if(!pData.nom.checkLength(0,300)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.siren.checkLength(0,9)) {lVR.valid = false;lVR.siren.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.siren.erreurs.push(erreur);}
		if(!pData.adresse.checkLength(0,300)) {lVR.valid = false;lVR.adresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.adresse.erreurs.push(erreur);}
		if(!pData.codePostal.checkLength(0,10)) {lVR.valid = false;lVR.codePostal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.codePostal.erreurs.push(erreur);}
		if(!pData.ville.checkLength(0,100)) {lVR.valid = false;lVR.ville.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.ville.erreurs.push(erreur);}
		if(!pData.dateAdhesion.checkDate('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(!pData.dateAdhesion.checkDateExist('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.dateAdhesion.isEmpty()) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateAdhesion.erreurs.push(erreur);}

		// Test SIREN
		if(pData.siren != '') {
			var lImpair = true;
			var lSomme = 0;
			var lPosition = pData.siren.length -1;
			while( lPosition >= 0) {
				var lIncrement = 0;
				if(lImpair) {
					lIncrement = pData.siren[lPosition] * 1;
				} else {
					lIncrement = pData.siren[lPosition] * 2;
				}
				if(lIncrement > 9) {
					lIncrement -= 9;
				}
				lSomme += lIncrement;
				lImpair = !lImpair;
				lPosition--;
			}
			if(lSomme % 10 != 0 || !pData.siren.checkLength(0,9)) {lVR.valid = false;lVR.siren.valid = false;var erreur = new VRerreur();erreur.code = ERR_242_CODE;erreur.message = ERR_242_MSG;lVR.siren.erreurs.push(erreur);}
		}
		
		// Date Adhésion <= Date Actuelle
		var lAujourdhui = getDateAujourdhuiDb();		
		if(!dateEstPLusGrandeEgale(lAujourdhui,pData.dateAdhesion,'db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		
		return lVR;
	};
	
	this.validUpdate = function(pData) { 
		var lVR = new FermeVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		
		if(lVR.valid) {
			return this.validAjout(pData);
		}
		return lVR;
	};
};function ProduitsBonDeCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitsBonDeCommandeVR();
		//Tests Techniques
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_compte_ferme.checkLength(0,11)) {lVR.valid = false;lVR.id_compte_ferme.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_compte_ferme.erreurs.push(erreur);}
		if(!pData.id_compte_ferme.isInt()) {lVR.valid = false;lVR.id_compte_ferme.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_compte_ferme.erreurs.push(erreur);}
		if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!isArray(pData.produits)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.id_compte_ferme.isEmpty()) {lVR.valid = false;lVR.id_compte_ferme.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_compte_ferme.erreurs.push(erreur);}
		if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}

		if(pData.produits.length > 0) {	
			var lValidProduit = new ProduitBonDeCommandeValid();
			var i = 0;
			while(pData.produits[i]) {
				var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
				if(!lVrProduit.valid){lVR.valid = false;}
				if(pData.produits[i].dcomId) {
					lVR.produits[pData.produits[i].dcomId] = lVrProduit;
				}
				i++;
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);};
		
		return lVR;
	};
};function ReservationAdherentValid() { 
	this.validUpdate = function(pData) { 
		var lVR = new AchatAdherentVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.etat))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.total != '' && !pData.total.checkLength(0,12)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.total.erreurs.push(erreur);}
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
};function FactureValid() { 
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
		if(!pData.operationProducteur.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
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
};;function AchatValid() { 
	this.validAjout = function(pData) { 
		var lVR = new AchatVR();
		//Tests Techniques

		//Tests Fonctionnels
		var lIdCompte = null;
		var lValidOperation = new OperationDetailValid();
		if(pData.operationAchat != '') {
			lVR.operationAchat = lValidOperation.validAjout(pData.operationAchat, {negatif:true});
			if(!lVR.operationAchat.valid){
				lVR.valid = false;
				lVR.operationAchat.valid = false;
			} else {
				lIdCompte = pData.operationAchat.idCompte;
			}
		}
		
		if(pData.operationAchatSolidaire != '') {
			lVR.operationAchatSolidaire = lValidOperation.validAjout(pData.operationAchatSolidaire, {negatif:true});
			if(!lVR.operationAchatSolidaire.valid){
				lVR.valid = false;
				lVR.operationAchatSolidaire.valid = false;
			} else {
				lIdCompte = pData.operationAchatSolidaire.idCompte;
			}
		}
		
		var lProduitAchete = false;
		var lTotal = 0;
		if(isArray(pData.produits)) {		
			if(pData.produits.length > 0) {
				lProduitAchete = true;
				var lValidProduit = new ProduitDetailAchatValid();
				var i = 0;
				while(pData.produits[i]) {
					var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
					if(!lVrProduit.valid){
						lVR.valid = false;
					} else {
						var lMontant = parseFloat(pData.produits[i].montant);
						if(isNaN(lMontant)) {lMontant = 0;}
						var lMontantSolidaire = parseFloat(pData.produits[i].montantSolidaire);
						if(isNaN(lMontantSolidaire)) {lMontantSolidaire = 0;}
						lTotal = (parseFloat(lTotal) + lMontant + lMontantSolidaire).toFixed(2);	
					}
					if(!pData.produits[i].id.isEmpty()) {
						lVR.produits[pData.produits[i].id] = lVrProduit;
					} else {
						lVR.produits.push(lVrProduit);
					}
					i++;
				}				
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}		

		if(lIdCompte == -3) { // Pour le comtpe invité
			// Il faut au moins 1 produit sur la commande
			if(!lProduitAchete) {
				lVR.valid = false;
				lVR.log.valid = false;
				var erreur = new VRerreur();
				erreur.code = ERR_207_CODE;
				erreur.message = ERR_207_MSG;
				lVR.log.erreurs.push(erreur);					
			}

			// Si il y a rechargement du compte on le test
			if(  pData.rechargement != '' && 
					(
						(!pData.rechargement.montant.isEmpty() && pData.rechargement.montant != 0) ||
						(!pData.rechargement.typePaiement.isEmpty() && pData.rechargement.typePaiement != 0)
					)
			) {
				lVR.rechargement = lValidOperation.validAjout(pData.rechargement);
				if(!lVR.rechargement.valid){
					lVR.valid = false;
					lVR.rechargement.montant.valid = false;
				}
				lTotal = (parseFloat(lTotal) + parseFloat(pData.rechargement.montant)).toFixed(2);	
			}

			if(lTotal != 0 ) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_244_CODE;erreur.message = ERR_244_MSG;lVR.log.erreurs.push(erreur);}
			
		} else { // Pour les adhérents
		
			// Si il y a rechargement du compte on le test
			if(pData.rechargement != '' && 
				(
					(!pData.rechargement.montant.isEmpty() && pData.rechargement.montant != 0) ||
					(!pData.rechargement.typePaiement.isEmpty() && pData.rechargement.typePaiement != 0)
				)
			) {
				lVR.rechargement = lValidOperation.validAjout(pData.rechargement, {zeroAutorise:true});
				if(!lVR.rechargement.valid){
					lVR.valid = false;
					lVR.rechargement.montant.valid = false;
				}
			} else if(!lProduitAchete) { // Si pas de rechargement il faut au moins 1 produit sur la commande
				lVR.valid = false;
				lVR.log.valid = false;
				var erreur = new VRerreur();
				erreur.code = ERR_207_CODE;
				erreur.message = ERR_207_MSG;
				lVR.log.erreurs.push(erreur);					
			}
		}
		
		return lVR;
	};
	
	this.validRechercheListeAchat = function(pData) { 
		var lVR = new RechercheListeAchatVR();
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
	
	/*this.validAjoutInvite = function(pData) { 
		var lVR = new AchatCommandeVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
	/*	if(!pData.solde.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.solde.isFloat()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
*/	
		//Tests Fonctionnels
	/*	if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		
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
	};*/

	/*this.validDelete = function(pData) {
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
	};*/

};function ProduitAjoutAchatValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitAjoutAchatVR();
		//Tests Techniques
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCompte.erreurs.push(erreur);}
		if(!pData.idMarche.checkLength(0,11)) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idMarche.erreurs.push(erreur);}
		if(pData.idMarche != '' && !pData.idMarche.isInt()) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idMarche.erreurs.push(erreur);}
		if(!pData.idOperation.checkLength(0,11)) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idOperation.erreurs.push(erreur);}
		if(pData.idOperation != '' && !pData.idOperation.isInt()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idOperation.erreurs.push(erreur);}
		if(!pData.idNomProduit.checkLength(0,11)) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.idNomProduit.isInt()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.solidaire.checkLength(0,1)) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.solidaire.erreurs.push(erreur);}
		if(!pData.solidaire.isInt()) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.solidaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
		//if(pData.idMarche.isEmpty() && pData.idOperation.isEmpty()) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idMarche.erreurs.push(erreur);}
		//if(pData.idOperation.isEmpty()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idOperation.erreurs.push(erreur);}
		if(pData.idNomProduit.isEmpty()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNomProduit.erreurs.push(erreur);}
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_214_CODE;erreur.message = ERR_214_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_213_CODE;erreur.message = ERR_213_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.solidaire.isEmpty()) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.solidaire.erreurs.push(erreur);}

		if(pData.quantite >= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix >= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

		return lVR;
	};

	/*this.validDelete = function(pData) {
		var lVR = new ProduitAjoutAchatVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitAjoutAchatVR();
			//Tests Techniques
			if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompte.erreurs.push(erreur);}
			if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCompte.erreurs.push(erreur);}
			if(!pData.idMarche.checkLength(0,11)) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idMarche.erreurs.push(erreur);}
			if(!pData.idMarche.isInt()) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idMarche.erreurs.push(erreur);}
			if(!pData.idOperation.checkLength(0,11)) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idOperation.erreurs.push(erreur);}
			if(!pData.idOperation.isInt()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idOperation.erreurs.push(erreur);}
			if(!pData.idNomProduit.checkLength(0,11)) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(!pData.idNomProduit.isInt()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
			if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}
			if(!pData.solidaire.checkLength(0,1)) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.solidaire.erreurs.push(erreur);}
			if(!pData.solidaire.isInt()) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.solidaire.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.idCompte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompte.erreurs.push(erreur);}
			if(pData.idMarche.isEmpty()) {lVR.valid = false;lVR.idMarche.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idMarche.erreurs.push(erreur);}
			if(pData.idOperation.isEmpty()) {lVR.valid = false;lVR.idOperation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idOperation.erreurs.push(erreur);}
			if(pData.idNomProduit.isEmpty()) {lVR.valid = false;lVR.idNomProduit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idNomProduit.erreurs.push(erreur);}
			if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
			if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}
			if(pData.solidaire.isEmpty()) {lVR.valid = false;lVR.solidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.solidaire.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};*/
}function CompteSolidaireVirementValid() { 
	this.validAjout = function(pData) { 
		var lVR = new CompteSolidaireAjoutVirementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.solde.checkLength(0,12)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.solde.isFloat()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.log.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montant <= 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.solde.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		
		if(parseFloat(pData.montant) > parseFloat(pData.solde) ) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_237_CODE;erreur.message = ERR_237_MSG;lVR.montant.erreurs.push(erreur);}

		return lVR;
	};
	
	this.validUpdate = function(pData) { 
		var lVR = new CompteSolidaireModifierVirementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.montantActuel.checkLength(0,12)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.montantActuel.isFloat()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.solde.checkLength(0,12)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.solde.isFloat()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.log.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.montantActuel.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.solde.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		
		if(pData.montant <= 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(parseFloat(pData.montant) > (parseFloat(pData.solde) + parseFloat(pData.montantActuel)) ) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_237_CODE;erreur.message = ERR_237_MSG;lVR.montant.erreurs.push(erreur);}

		return lVR;
	};
	
	this.validDelete = function(pData) { 
		var lVR = new CompteSolidaireSupprimerVirementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		return lVR;
	};
}
;function BanqueValid() { 
	this.validAjout = function(pData) { 
		var lVR = new BanqueVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.id != '' && !pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.nomCourt.checkLength(0,50)) {lVR.valid = false;lVR.nomCourt.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nomCourt.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,200)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.etat.checkLength(0,4)) {lVR.valid = false;lVR.etat.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.etat.erreurs.push(erreur);}
		if(pData.etat != '' && !pData.etat.isInt()) {lVR.valid = false;lVR.etat.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.etat.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new BanqueVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new BanqueVR();
			//Tests Techniques
			if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
			if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
			if(!pData.nomCourt.checkLength(0,50)) {lVR.valid = false;lVR.nomCourt.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nomCourt.erreurs.push(erreur);}
			if(!pData.nom.checkLength(0,200)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
			if(!pData.etat.checkLength(0,4)) {lVR.valid = false;lVR.etat.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.etat.erreurs.push(erreur);}
			if(pData.etat != '' && !pData.etat.isInt()) {lVR.valid = false;lVR.etat.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.etat.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
			if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};

};;function ProducteurValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProducteurVR();
		//Tests Techniques
		if(!pData.idFerme.checkLength(0,11)) {lVR.valid = false;lVR.idFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idFerme.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idFerme))) {lVR.valid = false;lVR.idFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idFerme.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.prenom.checkLength(0,50)) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prenom.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDate('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDateExist('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(!pData.commentaire.checkLength(0,500)) {lVR.valid = false;lVR.commentaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.commentaire.erreurs.push(erreur);}
		if(!pData.courrielPrincipal.checkLength(0,100)) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(pData.courrielPrincipal != '' && !pData.courrielPrincipal.checkCourriel()) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_102_CODE;erreur.message = ERR_102_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(!pData.courrielSecondaire.checkLength(0,100)) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		if(pData.courrielSecondaire != '' && !pData.courrielSecondaire.checkCourriel()) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_102_CODE;erreur.message = ERR_102_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		if(!pData.telephonePrincipal.checkLength(0,20)) {lVR.valid = false;lVR.telephonePrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephonePrincipal.erreurs.push(erreur);}
		if(!pData.telephoneSecondaire.checkLength(0,20)) {lVR.valid = false;lVR.telephoneSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephoneSecondaire.erreurs.push(erreur);}
		if(!pData.adresse.checkLength(0,300)) {lVR.valid = false;lVR.adresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.adresse.erreurs.push(erreur);}
		if(!pData.codePostal.checkLength(0,10)) {lVR.valid = false;lVR.codePostal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.codePostal.erreurs.push(erreur);}
		if(!pData.ville.checkLength(0,100)) {lVR.valid = false;lVR.ville.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.ville.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idFerme.isEmpty()) {lVR.valid = false;lVR.idFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idFerme.erreurs.push(erreur);}
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}

		var lAujourdhui = getDateAujourdhuiDb();		
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lVR = new ProducteurVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		if(lVR.valid) {
			return this.validAjout(pData);
		}
		return lVR;
	};

};function ProduitsBonDeLivraisonValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitsBonDeLivraisonVR();
		//Tests Techniques
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_compte_ferme.checkLength(0,11)) {lVR.valid = false;lVR.id_compte_ferme.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_compte_ferme.erreurs.push(erreur);}
		if(!pData.id_compte_ferme.isInt()) {lVR.valid = false;lVR.id_compte_ferme.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_compte_ferme.erreurs.push(erreur);}
		//if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		//if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!isArray(pData.produits)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.total.checkLength(0,12)) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.total.erreurs.push(erreur);}
		if(!pData.total.isFloat()) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.total.erreurs.push(erreur);}
		if(!pData.typePaiementChampComplementaireObligatoire.checkLength(0,1)) {lVR.valid = false;lVR.typePaiementChampComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiementChampComplementaireObligatoire.erreurs.push(erreur);}
		if(!pData.typePaiementChampComplementaireObligatoire.isInt()) {lVR.valid = false;lVR.typePaiementChampComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiementChampComplementaireObligatoire.erreurs.push(erreur);}
		if(pData.typePaiementChampComplementaire != '' && !pData.typePaiementChampComplementaire.checkLength(0,50)) {lVR.valid = false;lVR.typePaiementChampComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiementChampComplementaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.id_compte_ferme.isEmpty()) {lVR.valid = false;lVR.id_compte_ferme.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_compte_ferme.erreurs.push(erreur);}
		//if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
		if(pData.typePaiement.isEmpty()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(pData.total.isEmpty()) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.total.erreurs.push(erreur);}

		if(pData.typePaiement == 0) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_236_CODE;erreur.message = ERR_236_MSG;lVR.typePaiement.erreurs.push(erreur);}

		if(pData.total < 0) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.total.erreurs.push(erreur);}
		
		if(pData.typePaiementChampComplementaireObligatoire.isEmpty()) {lVR.valid = false;lVR.typePaiementChampComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiementChampComplementaireObligatoire.erreurs.push(erreur);}
		if(pData.typePaiementChampComplementaireObligatoire == 1 && pData.typePaiementChampComplementaire.isEmpty()) {lVR.valid = false;lVR.typePaiementChampComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiementChampComplementaire.erreurs.push(erreur);}

		if(pData.produits.length > 0) {	
			var lValidProduit = new ProduitBonDeLivraisonValid();
			var i = 0;
			while(pData.produits[i]) {
				var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
				if(!lVrProduit.valid){lVR.valid = false;}
				lVR.produits[pData.produits[i].id] = lVrProduit;
				i++;
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);};

		return lVR;
	};

	/*this.validDelete = function(pData) {
		var lVR = new ProduitsBonDeLivraisonVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitsBonDeLivraisonVR();
			//Tests Techniques
			if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_producteur.checkLength(0,11)) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(!pData.id_producteur.isInt()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!isArray(pData.produits)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(pData.id_producteur.isEmpty()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_producteur.erreurs.push(erreur);}
			if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}*/

};function InfoAdherentValid() { 
	this.validAjout = function(pData) { 
		
		var lVR = new InfoAdherentVR();
		//Tests Techniques
		if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(!pData.motPasseNouveau.checkLength(0,100)) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
		if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.motPasse.isEmpty()) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(pData.motPasseNouveau.isEmpty()) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
		if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

		// Les mots de passe ne sont pas identique
		if(pData.motPasseNouveau !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
		if(pData.motPasseNouveau.indexOf('&') != -1) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_255_CODE;erreur.message = ERR_255_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
		
		
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new InfoAdherentVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new InfoAdherentVR();
			//Tests Techniques
			if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
			if(!pData.motPasseNouveau.checkLength(0,100)) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
			if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.motPasse.isEmpty()) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasse.erreurs.push(erreur);}
			if(pData.motPasseNouveau.isEmpty()) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
			if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
			
			// Les mots de passe ne sont pas identique
			if(pData.motPasseNouveau !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasseNouveau.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasseNouveau.erreurs.push(erreur);}
			
			return lVR;
		}
		return lTestId;
	};

};function AchatAdherentValid() { 
	this.validUpdate = function(pData) { 
		var lVR = new AchatAdherentVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.idAchat))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
	/*	if(pData.total != '' && !pData.total.checkLength(0,12)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.total != '' && !pData.total.isFloat()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.log.erreurs.push(erreur);}
*/
		if(pData.idAchat < 0) {
			if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
			if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
			
			if(!pData.idMarche.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
			if(!pData.idMarche.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.idMarche.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		}
		
//		if(pData.total != '' && pData.total >= 0) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.log.erreurs.push(erreur);}

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
};function ProduitBonDeLivraisonValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitBonDeLivraisonVR();
		//Tests Techniques
		if(pData.quantite != '' && !pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix != '' && !pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix != '' && !pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.checkLength(0,12)) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.isFloat()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.prix != '' && pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}

		if(pData.quantite != '' && pData.quantite < 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.quantiteSolidaire < 0) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.prix != '' && pData.prix < 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}
		
		return lVR;
	};
};function OperationDetailValid() { 
	this.validAjout = function(pData, pParam) { 
		var lParam = {negatif:false, zeroAutorise: false};
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
		if(!lParam.zeroAutorise && pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(lParam.negatif && pData.montant > 0){lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_267_CODE;erreur.message = ERR_267_MSG;lVR.montant.erreurs.push(erreur);}
		if(!lParam.negatif && pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
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
};;function AdherentValid() { 
	this.validAjout = function(pData) { 
		var lVR = new AdherentVR();
		//Tests Techniques
		/*if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
		*/
		if(!pData.numero.checkLength(0,5)) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.numero.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.compte.valid = false;var erreur = new VRerreur();erreur.code = ERR_354_CODE;erreur.message = ERR_354_MSG;lVR.compte.erreurs.push(erreur);}
		if(!pData.compte.checkLength(0,30)) {lVR.valid = false;lVR.compte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.compte.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.prenom.checkLength(0,50)) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prenom.erreurs.push(erreur);}
		if(!pData.courrielPrincipal.checkLength(0,100)) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(!pData.courrielSecondaire.checkLength(0,100)) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		if(!pData.telephonePrincipal.checkLength(0,20)) {lVR.valid = false;lVR.telephonePrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephonePrincipal.erreurs.push(erreur);}
		if(!pData.telephoneSecondaire.checkLength(0,20)) {lVR.valid = false;lVR.telephoneSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephoneSecondaire.erreurs.push(erreur);}
		if(!pData.adresse.checkLength(0,300)) {lVR.valid = false;lVR.adresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.adresse.erreurs.push(erreur);}
		if(!pData.codePostal.checkLength(0,10)) {lVR.valid = false;lVR.codePostal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.codePostal.erreurs.push(erreur);}
		if(!pData.ville.checkLength(0,100)) {lVR.valid = false;lVR.ville.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.ville.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDate('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDateExist('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(!pData.dateAdhesion.checkDate('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(!pData.dateAdhesion.checkDateExist('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(!pData.commentaire.checkLength(0,500)) {lVR.valid = false;lVR.commentaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.commentaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		/*if(pData.motPasse.isEmpty()) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
		*/
		
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}
		if(pData.dateAdhesion.isEmpty()) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateAdhesion.erreurs.push(erreur);}

		// Les mots de passe ne sont pas identique
		//if(pData.motPasse !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasse.erreurs.push(erreur);}
		
		// Les mails sont au bon format
		if(pData.courrielPrincipal != '' && !pData.courrielPrincipal.checkCourriel()) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(pData.courrielSecondaire != '' && !pData.courrielSecondaire.checkCourriel()) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		
		// Date Naissance <= Date Adhésion <= Date Actuelle
		var lAujourdhui = getDateAujourdhuiDb();		
		if(!dateEstPLusGrandeEgale(lAujourdhui,pData.dateAdhesion,'db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(pData.dateAdhesion,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_225_CODE;erreur.message = ERR_225_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}
	
		if(!isArray(pData.modules)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new AdherentVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new AdherentVR();
			//Tests Techniques
			if(!pData.numero.checkLength(0,5)) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.numero.erreurs.push(erreur);}
			if(isNaN(parseInt(pData.idCompte))) {lVR.valid = false;lVR.compte.valid = false;var erreur = new VRerreur();erreur.code = ERR_354_CODE;erreur.message = ERR_354_MSG;lVR.compte.erreurs.push(erreur);}
			if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
			if(!pData.prenom.checkLength(0,50)) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prenom.erreurs.push(erreur);}
			if(!pData.courrielPrincipal.checkLength(0,100)) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
			if(!pData.courrielSecondaire.checkLength(0,100)) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
			if(!pData.telephonePrincipal.checkLength(0,20)) {lVR.valid = false;lVR.telephonePrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephonePrincipal.erreurs.push(erreur);}
			if(!pData.telephoneSecondaire.checkLength(0,20)) {lVR.valid = false;lVR.telephoneSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephoneSecondaire.erreurs.push(erreur);}
			if(!pData.adresse.checkLength(0,300)) {lVR.valid = false;lVR.adresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.adresse.erreurs.push(erreur);}
			if(!pData.codePostal.checkLength(0,10)) {lVR.valid = false;lVR.codePostal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.codePostal.erreurs.push(erreur);}
			if(!pData.ville.checkLength(0,100)) {lVR.valid = false;lVR.ville.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.ville.erreurs.push(erreur);}
			if(pData.dateNaissance != '' && !pData.dateNaissance.checkDate('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			if(pData.dateNaissance != '' && !pData.dateNaissance.checkDateExist('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			if(!pData.dateAdhesion.checkDate('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
			if(!pData.dateAdhesion.checkDateExist('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
			if(!pData.commentaire.checkLength(0,500)) {lVR.valid = false;lVR.commentaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.commentaire.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
			if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}
			if(pData.dateAdhesion.isEmpty()) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
			if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.compte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.compte.erreurs.push(erreur);}
			
			// Les mails sont au bon format
			if(pData.courrielPrincipal != '' && !pData.courrielPrincipal.checkCourriel()) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
			if(pData.courrielSecondaire != '' && !pData.courrielSecondaire.checkCourriel()) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
			
			// Date Naissance <= Date Adhésion <= Date Actuelle
			var lAujourdhui = getDateAujourdhuiDb();		
			if(!dateEstPLusGrandeEgale(lAujourdhui,pData.dateAdhesion,'db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
			if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(pData.dateAdhesion,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_225_CODE;erreur.message = ERR_225_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			
			if(!isArray(pData.modules)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};
	
	this.validUpdateInformation = function(pData) {
		var lVR = new AdherentVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.idAdherentPrincipal))) {lVR.valid = false;lVR.idAdherentPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.idAdherentPrincipal.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.prenom.checkLength(0,50)) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prenom.erreurs.push(erreur);}
		if(!pData.courrielPrincipal.checkLength(0,100)) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(!pData.courrielSecondaire.checkLength(0,100)) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		if(!pData.telephonePrincipal.checkLength(0,20)) {lVR.valid = false;lVR.telephonePrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephonePrincipal.erreurs.push(erreur);}
		if(!pData.telephoneSecondaire.checkLength(0,20)) {lVR.valid = false;lVR.telephoneSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.telephoneSecondaire.erreurs.push(erreur);}
		if(!pData.adresse.checkLength(0,300)) {lVR.valid = false;lVR.adresse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.adresse.erreurs.push(erreur);}
		if(!pData.codePostal.checkLength(0,10)) {lVR.valid = false;lVR.codePostal.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.codePostal.erreurs.push(erreur);}
		if(!pData.ville.checkLength(0,100)) {lVR.valid = false;lVR.ville.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.ville.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDate('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDateExist('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(!pData.dateAdhesion.checkDate('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(!pData.dateAdhesion.checkDateExist('db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(!pData.commentaire.checkLength(0,500)) {lVR.valid = false;lVR.commentaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.commentaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idAdherentPrincipal.isEmpty()) {lVR.valid = false;lVR.idAdherentPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idAdherentPrincipal.erreurs.push(erreur);}
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}
		if(pData.dateAdhesion.isEmpty()) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		
		// Les mails sont au bon format
		if(pData.courrielPrincipal != '' && !pData.courrielPrincipal.checkCourriel()) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(pData.courrielSecondaire != '' && !pData.courrielSecondaire.checkCourriel()) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		
		// Date Naissance <= Date Adhésion <= Date Actuelle
		var lAujourdhui = getDateAujourdhuiDb();		
		if(!dateEstPLusGrandeEgale(lAujourdhui,pData.dateAdhesion,'db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(pData.dateAdhesion,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_225_CODE;erreur.message = ERR_225_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}

		return lVR;
	};

};function MarcheValid() { 
	this.validAjout = function(pData) { 
		var lVR = new MarcheVR();

		//Tests Techniques
		if(!pData.nom.checkLength(0,100)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.dateMarcheDebut.checkDate('db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(!pData.dateMarcheDebut.checkDateExist('db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(!pData.timeMarcheDebut.checkTime()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		if(!pData.timeMarcheDebut.checkTimeExist()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		//if(!pData.dateMarcheFin.checkDate('db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		//if(!pData.dateMarcheFin.checkDateExist('db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		if(!pData.timeMarcheFin.checkTime()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}		
		if(!pData.timeMarcheFin.checkTimeExist()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}
		if(!pData.dateDebutReservation.checkDate('db')) {lVR.valid = false;lVR.dateDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateDebutReservation.erreurs.push(erreur);}
		if(!pData.dateDebutReservation.checkDateExist('db')) {lVR.valid = false;lVR.dateDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateDebutReservation.erreurs.push(erreur);}
		if(!pData.timeDebutReservation.checkTime()) {lVR.valid = false;lVR.timeDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeDebutReservation.erreurs.push(erreur);}
		if(!pData.timeDebutReservation.checkTimeExist()) {lVR.valid = false;lVR.timeDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeDebutReservation.erreurs.push(erreur);}
		if(!pData.dateFinReservation.checkDate('db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(!pData.dateFinReservation.checkDateExist('db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(!pData.timeFinReservation.checkTime()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
		if(!pData.timeFinReservation.checkTimeExist()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
		if(!pData.archive.checkLength(0,1)) {lVR.valid = false;lVR.archive.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.archive.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.dateMarcheDebut.isEmpty()) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(pData.timeMarcheDebut.isEmpty()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		//if(pData.dateMarcheFin.isEmpty()) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		if(pData.timeMarcheFin.isEmpty()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}
		if(pData.dateDebutReservation.isEmpty()) {lVR.valid = false;lVR.dateDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateDebutReservation.erreurs.push(erreur);}
		if(pData.timeDebutReservation.isEmpty()) {lVR.valid = false;lVR.timeDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeDebutReservation.erreurs.push(erreur);}
		if(pData.dateFinReservation.isEmpty()) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(pData.timeFinReservation.isEmpty()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
		if(pData.archive.isEmpty()) {lVR.valid = false;lVR.archive.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.archive.erreurs.push(erreur);}

		if(!dateTimeEstPLusGrandeEgale(pData.dateFinReservation + ' ' + pData.timeFinReservation,pData.dateDebutReservation + ' ' + pData.timeDebutReservation,'db')) {
			if(!dateEstPLusGrandeEgale(pData.dateFinReservation,pData.dateDebutReservation,'db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;lVR.dateDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_247_CODE;erreur.message = ERR_247_MSG;lVR.dateFinReservation.erreurs.push(erreur);lVR.dateDebutReservation.erreurs.push(erreur);}
			else if(timeEstPLusGrandeEgale(pData.timeDebutReservation,pData.timeFinReservation)) {lVR.valid = false;lVR.timeFinReservation.valid = false;lVR.timeDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_248_CODE;erreur.message = ERR_248_MSG;lVR.timeFinReservation.erreurs.push(erreur);lVR.timeDebutReservation.erreurs.push(erreur);}
		}
				
		if(!dateTimeEstPLusGrandeEgale(pData.dateMarcheDebut + ' ' + pData.timeMarcheDebut,pData.dateFinReservation + ' ' + pData.timeFinReservation,'db')) {
			if(!dateEstPLusGrandeEgale(pData.dateMarcheDebut,pData.dateFinReservation,'db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_202_CODE;erreur.message = ERR_202_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);lVR.dateFinReservation.erreurs.push(erreur);}
			else if(timeEstPLusGrandeEgale(pData.timeFinReservation,pData.timeMarcheDebut)) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_203_CODE;erreur.message = ERR_203_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);lVR.timeFinReservation.erreurs.push(erreur);}
		}		
		if(timeEstPLusGrandeEgale(pData.timeMarcheDebut,pData.timeMarcheFin)) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_204_CODE;erreur.message = ERR_204_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);lVR.timeMarcheFin.erreurs.push(erreur);}

		// Les dates ne sont pas avant ajourd'hui
		if(!dateEstPLusGrandeEgale(pData.dateMarcheDebut,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		//if(!dateEstPLusGrandeEgale(pData.dateMarcheFin,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		if(!dateEstPLusGrandeEgale(pData.dateFinReservation,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
	
		if(!isArray(pData.produits)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}
		if(!isArray(pData.produitsAbonnement)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_111_CODE;erreur.message = ERR_111_MSG;lVR.log.erreurs.push(erreur);}
		if(lVR.valid) {
			if(pData.produits.length + pData.produitsAbonnement.length > 0) {
				var lValidProduit = new ProduitMarcheValid();
				var i = 0;
				while(pData.produits[i]) {
					var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
					if(!lVrProduit.valid){lVR.valid = false;}
					lVR.produits[pData.produits[i].idNom] = lVrProduit;
					i++;
				}
				
				var i = 0;
				while(pData.produitsAbonnement[i]) {
					var lVrProduit = lValidProduit.validAjout(pData.produitsAbonnement[i]);	
					if(!lVrProduit.valid){lVR.valid = false;}
					lVR.produitsAbonnement[pData.produitsAbonnement[i].idNom] = lVrProduit;
					i++;
				}
			} else {
				// Erreur il faut au moins un produit
				lVR.valid = false;
				lVR.log.valid = false;
				var erreur = new VRerreur();
				erreur.code = ERR_207_CODE;
				erreur.message = ERR_207_MSG;
				lVR.log.erreurs.push(erreur);
			}	
		}
		return lVR;
	};
	
	this.validUpdateInformation = function(pData) { 
		var lVR = new MarcheVR();

		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,100)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.dateMarcheDebut.checkDate('db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(!pData.dateMarcheDebut.checkDateExist('db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(!pData.timeMarcheDebut.checkTime()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		if(!pData.timeMarcheDebut.checkTimeExist()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		if(!pData.timeMarcheFin.checkTime()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}		
		if(!pData.timeMarcheFin.checkTimeExist()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}
		if(!pData.dateDebutReservation.checkDate('db')) {lVR.valid = false;lVR.dateDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateDebutReservation.erreurs.push(erreur);}
		if(!pData.dateDebutReservation.checkDateExist('db')) {lVR.valid = false;lVR.dateDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateDebutReservation.erreurs.push(erreur);}
		if(!pData.timeDebutReservation.checkTime()) {lVR.valid = false;lVR.timeDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeDebutReservation.erreurs.push(erreur);}
		if(!pData.timeDebutReservation.checkTimeExist()) {lVR.valid = false;lVR.timeDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeDebutReservation.erreurs.push(erreur);}
		if(!pData.dateFinReservation.checkDate('db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(!pData.dateFinReservation.checkDateExist('db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(!pData.timeFinReservation.checkTime()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
		if(!pData.timeFinReservation.checkTimeExist()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeFinReservation.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.dateMarcheDebut.isEmpty()) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(pData.timeMarcheDebut.isEmpty()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		if(pData.timeMarcheFin.isEmpty()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}
		if(pData.dateDebutReservation.isEmpty()) {lVR.valid = false;lVR.dateDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateDebutReservation.erreurs.push(erreur);}
		if(pData.timeDebutReservation.isEmpty()) {lVR.valid = false;lVR.timeDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeDebutReservation.erreurs.push(erreur);}
		if(pData.dateFinReservation.isEmpty()) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(pData.timeFinReservation.isEmpty()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
	
		if(!dateTimeEstPLusGrandeEgale(pData.dateFinReservation + ' ' + pData.timeFinReservation,pData.dateDebutReservation + ' ' + pData.timeDebutReservation,'db')) {
			if(!dateEstPLusGrandeEgale(pData.dateFinReservation,pData.dateDebutReservation,'db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;lVR.dateDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_247_CODE;erreur.message = ERR_247_MSG;lVR.dateFinReservation.erreurs.push(erreur);lVR.dateDebutReservation.erreurs.push(erreur);}
			else if(timeEstPLusGrandeEgale(pData.timeDebutReservation,pData.timeFinReservation)) {lVR.valid = false;lVR.timeFinReservation.valid = false;lVR.timeDebutReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_248_CODE;erreur.message = ERR_248_MSG;lVR.timeFinReservation.erreurs.push(erreur);lVR.timeDebutReservation.erreurs.push(erreur);}
		}
			
		if(!dateTimeEstPLusGrandeEgale(pData.dateMarcheDebut + ' ' + pData.timeMarcheDebut,pData.dateFinReservation + ' ' + pData.timeFinReservation,'db')) {
			if(!dateEstPLusGrandeEgale(pData.dateMarcheDebut,pData.dateFinReservation,'db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_202_CODE;erreur.message = ERR_202_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);lVR.dateFinReservation.erreurs.push(erreur);}
			else if(timeEstPLusGrandeEgale(pData.timeFinReservation,pData.timeMarcheDebut)) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_203_CODE;erreur.message = ERR_203_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);lVR.timeFinReservation.erreurs.push(erreur);}
		}		
		if(timeEstPLusGrandeEgale(pData.timeMarcheDebut,pData.timeMarcheFin)) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_204_CODE;erreur.message = ERR_204_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);lVR.timeMarcheFin.erreurs.push(erreur);}

		// Les dates ne sont pas avant ajourd'hui
		if(!dateEstPLusGrandeEgale(pData.dateMarcheDebut,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(!dateEstPLusGrandeEgale(pData.dateFinReservation,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateFinReservation.erreurs.push(erreur);}

		return lVR;
	};
};function ReservationCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ReservationCommandeVR();
		//Tests Techniques
		if(!pData.stoQuantite.checkLength(0,12)) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stoQuantite.erreurs.push(erreur);}
		if(!pData.stoQuantite.isFloat()) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.stoQuantite.erreurs.push(erreur);}
		if(!pData.stoIdDetailCommande.checkLength(0,11)) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}
		if(!pData.stoIdDetailCommande.isFloat()) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.stoQuantite.isEmpty()) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stoQuantite.erreurs.push(erreur);}
		if(pData.stoIdDetailCommande.isEmpty()) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}
		
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new ReservationCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ReservationCommandeVR();
			//Tests Techniques
			if(!pData.stoQuantite.checkLength(0,12)) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stoQuantite.erreurs.push(erreur);}
			if(!pData.stoQuantite.isFloat()) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.stoQuantite.erreurs.push(erreur);}
			if(!pData.stoIdDetailCommande.checkLength(0,11)) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}
			if(!pData.stoIdDetailCommande.isFloat()) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.stoQuantite.isEmpty()) {lVR.valid = false;lVR.stoQuantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stoQuantite.erreurs.push(erreur);}
			if(pData.stoIdDetailCommande.isEmpty()) {lVR.valid = false;lVR.stoIdDetailCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.stoIdDetailCommande.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};
}function CompteZeybuVirementValid() { 
	this.validAjout = function(pData) { 
		var lVR = new CompteZeybuAjoutVirementVR();
		//Tests Techniques
		if(!pData.idCptDebit.checkLength(0,11)) {lVR.valid = false;lVR.idCptDebit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCptDebit.erreurs.push(erreur);}
		if(!pData.idCptDebit.isInt()) {lVR.valid = false;lVR.idCptDebit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCptDebit.erreurs.push(erreur);}
		if(!pData.idCptCredit.checkLength(0,11)) {lVR.valid = false;lVR.idCptCredit.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCptCredit.erreurs.push(erreur);}
		if(!pData.idCptCredit.isInt()) {lVR.valid = false;lVR.idCptCredit.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCptCredit.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.type.checkLength(0,1)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.type.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCptDebit.isEmpty()) {lVR.valid = false;lVR.idCptDebit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCptDebit.erreurs.push(erreur);}
		if(pData.idCptCredit.isEmpty()) {lVR.valid = false;lVR.idCptCredit.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCptCredit.erreurs.push(erreur);}
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montant <= 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.type.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.type != 1 && pData.type != 2) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_240_CODE;erreur.message = ERR_240_MSG;lVR.log.erreurs.push(erreur);}
		

		return lVR;
	};
	
	this.validUpdate = function(pData) { 
		var lVR = new CompteZeybuModifierVirementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		
		if(pData.montant <= 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		return lVR;
	};
	
	this.validDelete = function(pData) { 
		var lVR = new CompteZeybuSupprimerVirementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		return lVR;
	};
}
;function ExportBonReservationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ExportBonReservationVR();
		//Tests Techniques
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.idCompteFerme.checkLength(0,11)) {lVR.valid = false;lVR.idCompteFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCompteFerme.erreurs.push(erreur);}
		if(!pData.idCompteFerme.isInt()) {lVR.valid = false;lVR.idCompteFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCompteFerme.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}
		if(pData.idCompteFerme.isEmpty()) {lVR.valid = false;lVR.idCompteFerme.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCompteFerme.erreurs.push(erreur);}

		return lVR;
	};
};function ProduitAchatAdherentValid() { 
	this.validUpdate = function(pData) { 
		var lVR = new ProduitAchatAdherentVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix != '' && !pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

		//Tests Fonctionnels
		if((isNaN(pData.quantite) || pData.quantite == 0 || pData.prix == '') && (!isNaN(pData.prix) && pData.prix != 0)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_214_CODE;erreur.message = ERR_214_MSG;lVR.quantite.erreurs.push(erreur);}	
		if(pData.quantite >= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		
		if((isNaN(pData.prix) || pData.prix == 0 || pData.prix == '') && (!isNaN(pData.quantite) && pData.quantite != 0)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_213_CODE;erreur.message = ERR_213_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix >= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

		return lVR;
	};
};function CompteZeybuValid() { 
	this.validRechercheListeOperation = function(pData) { 
		var lVR = new RechercheListeOperationVR();
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
};;function CommandeCompleteValid() { 
	this.validAjout = function(pData) { 
		var lVR = new CommandeCompleteVR();

		//Tests Techniques
		if(!pData.numero.checkLength(0,11)) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.numero.erreurs.push(erreur);}
		if(!pData.nom.checkLength(0,100)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.dateMarcheDebut.checkDate('db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(!pData.dateMarcheDebut.checkDateExist('db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(!pData.timeMarcheDebut.checkTime()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		if(!pData.timeMarcheDebut.checkTimeExist()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		if(!pData.dateMarcheFin.checkDate('db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		if(!pData.dateMarcheFin.checkDateExist('db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		if(!pData.timeMarcheFin.checkTime()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}		
		if(!pData.timeMarcheFin.checkTimeExist()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}
		if(!pData.dateFinReservation.checkDate('db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(!pData.dateFinReservation.checkDateExist('db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(!pData.timeFinReservation.checkTime()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
		if(!pData.timeFinReservation.checkTimeExist()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
		if(!pData.archive.checkLength(0,1)) {lVR.valid = false;lVR.archive.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.archive.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.dateMarcheDebut.isEmpty()) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(pData.timeMarcheDebut.isEmpty()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
		if(pData.dateMarcheFin.isEmpty()) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		if(pData.timeMarcheFin.isEmpty()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}
		if(pData.dateFinReservation.isEmpty()) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		if(pData.timeFinReservation.isEmpty()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
		if(pData.archive.isEmpty()) {lVR.valid = false;lVR.archive.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.archive.erreurs.push(erreur);}

		if(!dateTimeEstPLusGrandeEgale(pData.dateMarcheDebut + ' ' + pData.timeMarcheDebut,pData.dateFinReservation + ' ' + pData.timeFinReservation,'db')) {
			if(!dateEstPLusGrandeEgale(pData.dateMarcheDebut,pData.dateFinReservation,'db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_202_CODE;erreur.message = ERR_202_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);lVR.dateFinReservation.erreurs.push(erreur);}
			else if(timeEstPLusGrandeEgale(pData.timeFinReservation,pData.timeMarcheDebut)) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_203_CODE;erreur.message = ERR_203_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);lVR.timeFinReservation.erreurs.push(erreur);}
		}		
		if(timeEstPLusGrandeEgale(pData.timeMarcheDebut,pData.timeMarcheFin)) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_204_CODE;erreur.message = ERR_204_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);lVR.timeMarcheFin.erreurs.push(erreur);}

		// Les dates ne sont pas avant ajourd'hui
		if(!dateEstPLusGrandeEgale(pData.dateMarcheDebut,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		if(!dateEstPLusGrandeEgale(pData.dateMarcheFin,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		if(!dateEstPLusGrandeEgale(pData.dateFinReservation,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
	
		if(isArray(pData.produits)) {		
			if(pData.produits.length > 0) {
				var lValidProduit = new ProduitCommandeValid();
				var i = 0;
				while(pData.produits[i]) {
					var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
					if(!lVrProduit.valid){lVR.valid = false;}
					lVR.produits[pData.produits[i].idNom] = lVrProduit;
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

		return lVR;
	};

	this.validAjoutProduit = function(pData) {
		var lVR = this.validDelete(pData);
		if(lVR.valid) {
			var lProduitMarcheValid = new ProduitMarcheValid();
			return lProduitMarcheValid.validAjout(pData);
		}
		return lVR;
	};
	
	this.validDelete = function(pData) {
		var lVR = new CommandeCompleteVR();
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new CommandeCompleteVR();

			//Tests Techniques
			if(!pData.numero.checkLength(0,11)) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.numero.erreurs.push(erreur);}
			if(!pData.nom.checkLength(0,100)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
			if(!pData.dateMarcheDebut.checkDate('db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
			if(!pData.dateMarcheDebut.checkDateExist('db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
			if(!pData.timeMarcheDebut.checkTime()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
			if(!pData.timeMarcheDebut.checkTimeExist()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
			if(!pData.dateMarcheFin.checkDate('db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
			if(!pData.dateMarcheFin.checkDateExist('db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
			if(!pData.timeMarcheFin.checkTime()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}		
			if(!pData.timeMarcheFin.checkTimeExist()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}
			if(!pData.dateFinReservation.checkDate('db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
			if(!pData.dateFinReservation.checkDateExist('db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
			if(!pData.timeFinReservation.checkTime()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_106_CODE;erreur.message = ERR_106_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
			if(!pData.timeFinReservation.checkTimeExist()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_107_CODE;erreur.message = ERR_107_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
			if(!pData.archive.checkLength(0,1)) {lVR.valid = false;lVR.archive.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.archive.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.dateMarcheDebut.isEmpty()) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
			if(pData.timeMarcheDebut.isEmpty()) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);}
			if(pData.dateMarcheFin.isEmpty()) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
			if(pData.timeMarcheFin.isEmpty()) {lVR.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeMarcheFin.erreurs.push(erreur);}
			if(pData.dateFinReservation.isEmpty()) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
			if(pData.timeFinReservation.isEmpty()) {lVR.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.timeFinReservation.erreurs.push(erreur);}
			if(pData.archive.isEmpty()) {lVR.valid = false;lVR.archive.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.archive.erreurs.push(erreur);}

			if(!dateTimeEstPLusGrandeEgale(pData.dateMarcheDebut + ' ' + pData.timeMarcheDebut,pData.dateFinReservation + ' ' + pData.timeFinReservation,'db')) {
				if(!dateEstPLusGrandeEgale(pData.dateMarcheDebut,pData.dateFinReservation,'db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_202_CODE;erreur.message = ERR_202_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);lVR.dateFinReservation.erreurs.push(erreur);}
				else if(timeEstPLusGrandeEgale(pData.timeFinReservation,pData.timeMarcheDebut)) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;lVR.timeFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_203_CODE;erreur.message = ERR_203_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);lVR.timeFinReservation.erreurs.push(erreur);}
			}		
			if(timeEstPLusGrandeEgale(pData.timeMarcheDebut,pData.timeMarcheFin)) {lVR.valid = false;lVR.timeMarcheDebut.valid = false;lVR.timeMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_204_CODE;erreur.message = ERR_204_MSG;lVR.timeMarcheDebut.erreurs.push(erreur);lVR.timeMarcheFin.erreurs.push(erreur);}

			// Les dates ne sont pas avant ajourd'hui
		//	if(!dateEstPLusGrandeEgale(pData.dateMarcheDebut,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateMarcheDebut.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateMarcheDebut.erreurs.push(erreur);}
		//	if(!dateEstPLusGrandeEgale(pData.dateMarcheFin,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateMarcheFin.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateMarcheFin.erreurs.push(erreur);}
		//	if(!dateEstPLusGrandeEgale(pData.dateFinReservation,getDateAujourdhuiDb(),'db')) {lVR.valid = false;lVR.dateFinReservation.valid = false;var erreur = new VRerreur();erreur.code = ERR_209_CODE;erreur.message = ERR_209_MSG;lVR.dateFinReservation.erreurs.push(erreur);}
		
			if(isArray(pData.produits)) {		
				if(pData.produits.length > 0) {
					var lValidProduit = new ProduitCommandeValid();
					var i = 0;
					while(pData.produits[i]) {
						var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
						if(!lVrProduit.valid){lVR.valid = false;}
						lVR.produits[pData.produits[i].idNom] = lVrProduit;
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

			return lVR;
		}
		return lTestId;
	};

}
function StockQuantiteValid() { 
	/*this.validAjout = function(pData) { 
		var lVR = new StockQuantiteVR();
		//Tests Techniques
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantiteSolidaire.checkLength(0,12)) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(!pData.quantiteSolidaire.isFloat()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire.isEmpty()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}

		return lVR;
	};*/

	this.validDelete = function(pData) {
		var lVR = new StockQuantiteVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new StockQuantiteVR();
			//Tests Techniques
			if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.quantiteSolidaire.checkLength(0,12)) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
			if(!pData.quantiteSolidaire.isFloat()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
			if(pData.quantiteSolidaire.isEmpty()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};
};function ModeleLotValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ModeleLotVR();
		//Tests Techniques
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.unite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}
		if(parseFloat(pData.quantite) > 9999999999.99) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(parseFloat(pData.prix) > 9999999999.99) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}

		// Quantite et prix sont positifs
		if(parseFloat(pData.quantite) <= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(parseFloat(pData.prix) <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

		return lVR;
	};
	
	this.validUpdate = function(pData) { 
		var lVR = new ModeleLotVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.unite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}
		if(parseFloat(pData.quantite) > 9999999999.99) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(parseFloat(pData.prix) > 9999999999.99) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}

		// Quantite et prix sont positifs
		if(parseInt(pData.id) <= 0) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.id.erreurs.push(erreur);}
		if(parseFloat(pData.quantite) <= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(parseFloat(pData.prix) <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

		return lVR;
	};
	
	this.validUpdateAvecReservation = function(pData,pAncienneQuantite) { 
		var lVR = new ModeleLotVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.unite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}
		if(parseFloat(pData.quantite) > 9999999999.99) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(parseFloat(pData.prix) > 9999999999.99) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}

		// Quantite et prix sont positifs
		if(parseInt(pData.id) <= 0) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.id.erreurs.push(erreur);}
		if(parseFloat(pData.quantite) <= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(parseFloat(pData.prix) <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

		// La quantite doit être multiple de l'ancienne et inférieure car des réservations sont positionnées
		if(parseFloat(pData.quantite) > parseFloat(pAncienneQuantite)) {
			lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_257_CODE;erreur.message = ERR_257_MSG;lVR.quantite.erreurs.push(erreur);
		} else {
			if(parseFloat(pAncienneQuantite) % parseFloat(pData.quantite) != 0 ) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_256_CODE;erreur.message = ERR_256_MSG;lVR.quantite.erreurs.push(erreur);}
		}

		return lVR;
	};
};function ExportListeReservationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ExportListeReservationVR();
		//Tests Techniques
		/*if(!pData.pParam.checkLength(0,1)) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pParam.erreurs.push(erreur);}
		if(!pData.pParam.isInt()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.pParam.erreurs.push(erreur);}
		if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
		*/
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.fonction.isEmpty()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pParam.erreurs.push(erreur);}
		//if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.id_produits.isEmpty()) {lVR.valid = false;lVR.id_produits.valid = false;var erreur = new VRerreur();erreur.code = ERR_233_CODE;erreur.message = ERR_233_MSG;lVR.id_produits.erreurs.push(erreur);}
		if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}

		return lVR;
	};

	/*this.validDelete = function(pData) {
		var lVR = new ExportListeReservationVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ExportListeReservationVR();
			//Tests Techniques
			if(!pData.pParam.checkLength(0,1)) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pParam.erreurs.push(erreur);}
			if(!pData.pParam.isInt()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.pParam.erreurs.push(erreur);}
			if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
			if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
			if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.pParam.isEmpty()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pParam.erreurs.push(erreur);}
			if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
			if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
			if(pData.id_produits.isEmpty()) {lVR.valid = false;lVR.id_produits.valid = false;var erreur = new VRerreur();erreur.code = ERR_233_CODE;erreur.message = ERR_233_MSG;lVR.id_produits.erreurs.push(erreur);}
			if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}*/

};function ProduitDetailAchatValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitDetailAchatVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.idNomProduit))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idStock != '' && isNaN(parseInt(pData.idStock))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idDetailOperation != '' && isNaN(parseInt(pData.idDetailOperation))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idStockSolidaire != '' && isNaN(parseInt(pData.idStockSolidaire))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.idDetailOperationSolidaire != '' && isNaN(parseInt(pData.idDetailOperationSolidaire))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}

		if(pData.quantite != '' && !pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.unite != '' && !pData.unite.checkLength(0,20)) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.checkLength(0,12)) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.isFloat()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.uniteSolidaire != '' && !pData.uniteSolidaire.checkLength(0,20)) {lVR.valid = false;lVR.uniteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.uniteSolidaire.erreurs.push(erreur);}
		if(pData.montant != '' && !pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montant != '' && !pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montantSolidaire != '' && !pData.montantSolidaire.checkLength(0,12)) {lVR.valid = false;lVR.montantSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montantSolidaire.erreurs.push(erreur);}
		if(pData.montantSolidaire != '' && !pData.montantSolidaire.isFloat()) {lVR.valid = false;lVR.montantSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montantSolidaire.erreurs.push(erreur);}
		
		if(pData.quantite != '' && pData.idDetailCommande != '' && !pData.idDetailCommande.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.quantite != '' && pData.idDetailCommande != '' && !pData.idDetailCommande.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.quantite != '' && pData.idModeleLot != '' && !pData.idModeleLot.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.quantite != '' && pData.idModeleLot != '' && !pData.idModeleLot.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.idDetailCommandeSolidaire != '' && !pData.idDetailCommandeSolidaire.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.idDetailCommandeSolidaire != '' && !pData.idDetailCommandeSolidaire.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.idModeleLotSolidaire != '' && !pData.idModeleLotSolidaire.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.idModeleLotSolidaire != '' && !pData.idModeleLotSolidaire.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.idNomProduit == '') {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}

		if(pData.montant != '' && pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}

		if(pData.montantSolidaire != '' && pData.quantiteSolidaire.isEmpty()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.montantSolidaire.isEmpty()) {lVR.valid = false;lVR.montantSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montantSolidaire.erreurs.push(erreur);}

		
		if(pData.quantite != '' && pData.quantite >= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.quantiteSolidaire >= 0) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.montant != '' && pData.montant >= 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montantSolidaire != '' && pData.montantSolidaire >= 0) {lVR.valid = false;lVR.montantSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montantSolidaire.erreurs.push(erreur);}
		
		if(pData.quantite != '' && pData.idDetailCommande.isEmpty() && pData.idModeleLot.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.idDetailCommandeSolidaire.isEmpty() && pData.idModeleLotSolidaire.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		
		return lVR;
	};
};;function NomProduitValid() { 
	this.validAjout = function(pData) { 
		var lVR = new NomProduitVR();
		//Tests Techniques
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}
		if(!pData.idCategorie.checkLength(0,11)) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCategorie.erreurs.push(erreur);}
		if(!pData.idCategorie.isInt()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCategorie.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.idCategorie.isEmpty()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCategorie.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new NomProduitVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new NomProduitVR();
			//Tests Techniques
			if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
			if(!pData.description.checkLength(0,500)) {lVR.valid = false;lVR.description.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.description.erreurs.push(erreur);}
			if(!pData.idCategorie.checkLength(0,11)) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idCategorie.erreurs.push(erreur);}
			if(!pData.idCategorie.isInt()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idCategorie.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
			if(pData.idCategorie.isEmpty()) {lVR.valid = false;lVR.idCategorie.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.idCategorie.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};

};function ChampComplementaireValid() { 
	this.validUpdate = function(pData) { 
		var lVR = new ChampComplementaireVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.obligatoire.checkLength(0,1)) {lVR.valid = false;lVR.obligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.obligatoire.erreurs.push(erreur);}
		if(!pData.obligatoire.isInt()) {lVR.valid = false;lVR.obligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.obligatoire.erreurs.push(erreur);}
		if(!pData.valeur.checkLength(0,50)) {lVR.valid = false;lVR.valeur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.valeur.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.obligatoire.isEmpty()) {lVR.valid = false;lVR.obligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.obligatoire.erreurs.push(erreur);}
		if(pData.obligatoire == 1 && pData.valeur.isEmpty()) {lVR.valid = false;lVR.valeur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.valeur.erreurs.push(erreur);}
		
		return lVR;
	};
};;function IdentificationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new IdentificationVR();
		//Tests Techniques
		if(!pData.login.checkLength(0,20)) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.login.erreurs.push(erreur);}
		if(!pData.pass.checkLength(0,100)) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pass.erreurs.push(erreur);}
				
		//Tests Fonctionnels
		if(pData.login.isEmpty()) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.login.erreurs.push(erreur);}
		if(pData.pass.isEmpty()) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pass.erreurs.push(erreur);}

		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new IdentificationVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new IdentificationVR();
			//Tests Techniques
			if(!pData.login.checkLength(0,20)) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.login.erreurs.push(erreur);}
			if(!pData.pass.checkLength(0,100)) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pass.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.login.isEmpty()) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.login.erreurs.push(erreur);}
			if(pData.pass.isEmpty()) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pass.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	};

};function ProduitCommandeValid() { 
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

		if(parseFloat(pData.qteMaxCommande) > 9999999999.99) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) > 9999999999.99) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.qteRestante.erreurs.push(erreur);}

		if(pData.idNom < 1) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_233_CODE;erreur.message = ERR_233_MSG;lVR.idNom.erreurs.push(erreur);}
		if(pData.idProducteur < 1) {lVR.valid = false;lVR.idProducteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_232_CODE;erreur.message = ERR_232_MSG;lVR.idProducteur.erreurs.push(erreur);}
		
		if(parseFloat(pData.qteMaxCommande) <= 0) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(parseFloat(pData.qteRestante) <= 0) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.qteRestante.erreurs.push(erreur);}

		if(parseFloat(pData.qteMaxCommande) > parseFloat(pData.qteRestante)){lVR.valid = false;lVR.qteRestante.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_205_CODE;erreur.message = ERR_205_MSG;lVR.qteRestante.erreurs.push(erreur);lVR.qteMaxCommande.erreurs.push(erreur);}

		if(pMode != 'simple') {
			//Tests des Lots
			if(isArray(pData.lots)) {
				var lValidLot = new DetailCommandeValid();
				var i = 0, lPetitLotTaille = 0;
				while(pData.lots[i]) {
					var lVrLot = lValidLot.validAjout(pData.lots[i]);				
					if(!lVrLot.valid){lVR.valid = false;}
					if(parseFloat(pData.lots[i].taille) > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVrLot.valid = false;lVrLot.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_206_CODE;erreur.message = ERR_206_MSG;lVrLot.taille.erreurs.push(erreur);}
					if(parseFloat(pData.lots[i].taille) < lPetitLotTaille) { lPetitLotTaille = parseFloat(pData.lots[i].taille); }
					lVR.lots.push(lVrLot);
					i++;}
				if(lPetitLotTaille > parseFloat(pData.qteMaxCommande)) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_241_CODE;erreur.message = ERR_241_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
				
				
			} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_110_CODE;erreur.message = ERR_110_MSG;lVR.log.erreurs.push(erreur);}
		}
		return lVR;
	};

	this.validDelete = function(pData) {
		var lVR = new ProduitCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	};

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
	};

};function CompteSpecialValid() { 
	this.validAjout = function(pData) { 
		var lVR = new CompteSpecialVR();
		//Tests Techniques
		if(!pData.login.checkLength(0,20)) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.login.erreurs.push(erreur);}
		if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
		if(!pData.type.checkLength(0,1)) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.type.erreurs.push(erreur);}
		if(!pData.type.isInt()) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.type.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.login.isEmpty()) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.login.erreurs.push(erreur);}
		if(pData.motPasse.isEmpty()) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
		if(pData.type.isEmpty()) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.type.erreurs.push(erreur);}

		// Les mots de passe ne sont pas identique
		if(pData.motPasse !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(pData.type < 2 || pData.type > 4) {lVR.valid = false;lVR.type.valid = false;var erreur = new VRerreur();erreur.code = ERR_246_CODE;erreur.message = ERR_246_MSG;lVR.type.erreurs.push(erreur);}
		
		return lVR;
	};
	
	this.validDelete = function(pData) { 
		var lVR = new CompteSpecialVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		return lVR;
	};
	
	this.validUpdate = function(pData) { 
		var lVR = this.validDelete(pData);
		if(lVR.valid) {
			//Tests Techniques
			if(!pData.login.checkLength(0,20)) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.login.erreurs.push(erreur);}
	
			//Tests Fonctionnels
			if(pData.login.isEmpty()) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.login.erreurs.push(erreur);}
	
		}
		return lVR;
	};
	
	this.validUpdatePass = function(pData) { 
		var lVR = this.validDelete(pData);
		if(lVR.valid) {
			//Tests Techniques
			if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
			if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
	
			//Tests Fonctionnels
			if(pData.motPasse.isEmpty()) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasse.erreurs.push(erreur);}
			if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
	
			// Les mots de passe ne sont pas identique
			if(pData.motPasse !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasse.erreurs.push(erreur);}			
		}
		return lVR;
	};
};function TypePaiementServiceTemplate() {
	this.champComplementaire =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.chCpLabel}</td>" +
				"<td>" +
					"<input {champComplementaire.attr} type=\"text\" value=\"{champComplementaire.valeur}\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"{prefixe}champComplementaire{champComplementaire.id}valeur\" data-id-champ-complementaire=\"{champComplementaire.id}\" maxlength=\"50\" size=\"15\"/>" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
	
	this.champComplementaireAffiche =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.chCpLabel}</td>" +
				"<td>" +
					"{champComplementaire.valeur}" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
};function IdentificationTemplate() {
	this.connexion =
		"<div id=\"formulaire_identification_ifb\" title=\"Connexion à Zeybux\" >" +
			"<form id=\"identification-form\" action=\"./index.php\" method=\"post\">" +
				"<table>" +
					"<tr>" +
						"<td>N° d'adhérent</td>" +
						"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"login\" id=\"login\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<td>Mot de Passe</td>" +
						"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" id=\"pass\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";

	this.debutMenu = "<div id=\"menu_int\"><ul id=\"menu_liste\" class=\"ui-corner-tl ui-corner-br\">";
	this.finMenu = "</ul></div>";
		
	this.deconnexion =	
		"<span id=\"lien-deconnexion\" class=\"ui-widget-header ui-corner-bl\">" +
			"<a href=\"./index.php?m=Identification&amp;v=Deconnexion\" >" +
				"<span class=\"com-float-left ui-icon ui-icon-power\"></span>" +
				"Déconnexion" +
			"</a>" +
		"</span>";
	
	this.administration =	
		"<span id=\"lien-administration\" class=\"btn-menu com-cursor-pointer ui-widget-header ui-corner-tl\">" +
				"<span class=\"com-float-left ui-icon ui-icon-gear\"></span>" +
				"Administration" +
		"</span>";
		
	this.module =	
		"<!-- BEGIN modules -->" +
		"<li>" +
			"<span class=\"com-cursor-pointer ui-widget-header menu-lien btn-menu\" id=\"menu-{modules.moduleNom}-{modules.nom}\">{modules.label}</span>" +
		"</li>" +
		"<!-- END modules -->";
	
	this.admin = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Administration" +
				"</div>" +
				"<div>" +
					"<ul>" +
						"<!-- BEGIN modules -->" +
						"<li>" +
							"<span id=\"menu-{modules.moduleNom}-{modules.nom}\" >{modules.label}</span>" +			
							"<ul>" +
							"<!-- BEGIN vues -->" +
								"<li>" +
									"<a id=\"menu-{modules.moduleNom}-{modules.vues.nom}\" href=\"./index.php?m={modules.moduleNom}&amp;v={modules.vues.nom}\">{modules.vues.label}</a>" +
								"</li>" +
								"<br/>" +
							"<!-- END vues -->" +
							"</ul>" +
						"</li>" +
						"<!-- END modules -->" +
					"</ul>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	/*this.naviguateurIncompatible =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header com-center ui-corner-all\">" +
					"Naviguateur Incompatible" +
				"</div>" +
				"<div>" +
					"Votre naviguateur n'est pas compatible avec zeybux.<br/>" +
					"Vous pouvez utiliser l'un des naviguateur suivants pour profiter du site : <br/>" +
					"<div id=\"liste-naviguateur\" class=\"com-center\">" +
						
						"<div id=\"naviguateur-1\" class=\"com-float-left\">" +
							"<a href=\"http://www.mozilla.com/fr/firefox/\">" +
								"<img alt=\"Mozilla Firefox\" src=\"./images/firefox-logo.png\"/><br/>" +
								"Mozilla Firefox" +
							"</a>" +
						"</div>" +
						"<div>" +	
							"<a href=\"http://www.google.com/chrome/\">" +
								"<img alt=\"Google Chrome\" src=\"./images/chrome-logo.png\"/><br/>" +
								"Google Chrome" +
							"</a>" +
						"</div>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";*/
	
	this.infoNavIncompatible = 
		"<div id=\"liste-naviguateur\" class=\"info-identification-nav-incompatible ui-widget ui-widget-content ui-state-highlight com-center ui-corner-all\" >" +
			"<div id=\"msg-nav-incompatible\" class=\"com-float-left\">" +
			"Votre naviguateur n'est pas compatible avec la version complète du zeybux.<br/>" +
			"Ceci est la version minimale du zeybux.<br/>" +
			"Vous pouvez utiliser l'un des naviguateur suivants pour profiter de l'ensemble du site :</div>" +
			//"<div id=\"liste-naviguateur\" class=\"com-center\">" +
				
				"<div id=\"naviguateur-1\" class=\"com-float-left\">" +
					"<a href=\"http://www.mozilla.com/fr/firefox/\">" +
						"<img alt=\"Mozilla Firefox\" src=\"./images/firefox-logo.png\"/><br/>" +
						"Mozilla Firefox" +
					"</a>" +
				"</div>" +
				"<div class=\"com-float-left\">" +	
					"<a href=\"http://www.google.com/chrome/\">" +
						"<img alt=\"Google Chrome\" src=\"./images/chrome-logo.png\"/><br/>" +
						"Google Chrome" +
					"</a>" +
				"</div>" +
			//"</div>" +
		"</div>";
		/*"<div id=\"contenu\">" +			
			"<div id=\"formulaire_identification_int\" class=\"ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Connexion à Zeybux</div>" +
				"<form id=\"identification-form\" action=\"./index.php?m=IdentificationHTML&v=Identification\" method=\"post\">" +
					"<table>" +
						"<tr>" +
							"<td>N° d'adhérent</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"login\" id=\"login\" /></td>" +
						"</tr>" +
						"<tr>" +
							"<td>Mot de Passe</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"password\" name=\"pass\" id=\"pass\"  /></td>" +
						"</tr>" +
						"<tr>" +
							"<td colspan=\"2\" class=\"com-center com-ligne-submit\" ><input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Connexion\"/></td>" +
						"</tr>" +
						"<tr>" +						
							"<td></td>" +
							"<td class=\"com-text-align-right\" ><a class=\"lien_mot_passe\" href=\"./index.php?m=IdentificationHTML&amp;v=MotDePasse\">Mot de passe oublié</a></td>" +
						"</tr>" +
					"</table>" +
				"</form>" +
			"</div>" +
		"</div>";*/
	
	/*this.formulaireIdentification = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_identification_int\" class=\"ui-widget ui-widget-content ui-widget-content-transparent  ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Connexion à Zeybux</div>" +
				"<form id=\"identification-form\" action=\"./index.php?m=IdentificationHTML&v=Identification\" method=\"post\">" +
					"<table>" +
						"<tr>" +
							"<td>N° d'adhérent</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"login\" id=\"login\" /></td>" +
						"</tr>" +
						"<tr>" +
							"<td>Mot de Passe</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"password\" name=\"pass\" id=\"pass\"  /></td>" +
						"</tr>" +
						"<tr>" +
							"<td colspan=\"2\" class=\"com-center com-ligne-submit\" ><input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Connexion\"/></td>" +
						"</tr>" +
						"<tr>" +						
							"<td></td>" +
							"<td class=\"com-text-align-right\" ><a class=\"lien_mot_passe\" href=\"./index.php?m=IdentificationHTML&amp;v=MotDePasse\">Mot de passe oublié</a></td>" +
						"</tr>" +
					"</table>" +
				"</form>" +
			"</div>" +
		"</div>";*/
	
	this.chargementModule = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_identification_int\" class=\"ui-widget formulaire_identification ui-widget-content ui-widget-content-transparent ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Chargement du Zeybux</div>" +
				"<div id=\"chargement-module-progressbar\"></div>" +
			"</div>" +
		"</div>";
	
	/*this.chargementIdentification = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_identification_int\" class=\"ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Connexion à Zeybux</div>" +
				"<div class=\"com-center\">Identification ...</div>" +
			"</div>" +
		"</div>";*/
};function CoreTemplate() {
	this.debutContenu = "<div id=\"contenu\">";
	this.finContenu = "</div>";
};;function MenuVue(pParam) {
	//this.mMenuTemplate = new IdentificationTemplate();

	this.construct = function(pParam) {		
		var that = this;	
		$.post(	"./index.php?m=Identification&v=Menu", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
				  	if(lResponse) {
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse, pParam);
						} else {
							Infobulle.generer(lResponse,'');
						}
				  	}
				},"json"
		);
	};
	
	this.afficher = function(pMenu, pParam) {
		var that = this;
		var lIdentificationTemplate = new IdentificationTemplate();
				
		$('#menu_int').replaceWith($(that.genererMenu(pMenu.menu)));
		$('#site').append(that.affectButton($(lIdentificationTemplate.deconnexion)));
		if(pMenu.admin){
			$('#site').append(that.affectAdministration($(lIdentificationTemplate.administration)));
		}
		
		pParam.homePage();
	};
	
	this.affectButton = function(pData) {

		/*pData = gCommunVue.comHoverBtn(pData);
		return pData;*/
		return $(pData).hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
	};
		
	this.genererMenu = function(pMenu) {
		var lIdentificationTemplate = new IdentificationTemplate();
		
		var lMenu = lIdentificationTemplate.debutMenu;
		lMenu += lIdentificationTemplate.module.template(pMenu); //this.genererModule(pMenu);
		lMenu += lIdentificationTemplate.finMenu;
		
		lMenu = $(lMenu);
		
		lMenu.find('.menu-lien').first().addClass("ui-corner-tl");
		lMenu.find('.menu-lien').last().addClass("ui-corner-br");
		lMenu.find('.menu-lien').hover(function() {
			lMenu.find('.menu-lien').removeClass("ui-state-hover");
			$(this).addClass("ui-state-hover");
		},function() {lMenu.find('.menu-lien').removeClass("ui-state-hover");});
		
		lMenu = this.affectVues(lMenu);
		return lMenu;
	};
		
	this.affectAdministration = function(pData) {
		pData.click(function() {
			AdministrationVue();
		});
		pData = this.affectButton(pData);
		return pData;
	};
		
	this.affectVues = function(pData) {
		if(pData) {
			
			pData.find('#menu-MonCompte-MonCompte').click(function() {
				MonCompteVue();
				return false;
			});			
			
			pData.find('#menu-Commande-MesAchats').click(function() {
				MesAchatsVue();
				return false;
			});
			
			pData.find('#menu-Commande-MonMarche').click(function() {
				MonMarcheVue();
				return false;
			});
			
			pData.find('#menu-Caisse-CaisseListeMarche').click(function() {
				CaisseListeCommandeVue();
				return false;
			});
			
			pData.find('#menu-CompteSolidaire-CompteSolidaire').click(function() {
				CompteSolidaireVue();
				return false;
			});
			
			pData.find('#menu-CompteSolidaire-ListeAdherent').click(function() {
				CompteSolidaireListeAdherentVue();
				return false;
			});
			
			return pData;
		}
		return null;
	};
	
	this.construct(pParam);
};function AdministrationVue(pParam) {
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {AdministrationVue();}} );
		var that = this;	
		$.post(	"./index.php?m=Identification&v=Administration", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
				  	if(lResponse) {
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
							// Maj du Menu
							gCommunVue.majMenu('administration');
						} else {
							Infobulle.generer(lResponse,'');
						}
				  	}
				},"json"
		);
	};
	
	this.afficher = function(pResponse) {
		var that = this;
		var lIdentificationTemplate = new IdentificationTemplate();	
		var lTemplate = lIdentificationTemplate.admin;		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse.menu))));
	};
	
	this.affect = function(pData) {
		pData = this.affectVues(pData);		
		return pData;
	};
	
	this.affectVues = function(pData) {
		if(pData) {
			
			pData.find('#menu-GestionAdherents-ListeAdherent').click(function() {
				ListeAdherentVue();
				return false;
			});	
						
			pData.find('#menu-GestionCommande-ListeCommande').click(function() {
				GestionListeCommandeVue();
				return false;
			});
			
			pData.find('#menu-GestionCommande-StockProduitListeFerme').click(function() {
				StockProduitListeFermeVue();
				return false;
			});
			
			pData.find('#menu-GestionCommande-Facture').click(function() {
				FactureVue();
				return false;
			});
			
			pData.find('#menu-GestionCommande-Achat').click(function() {
				AchatVue();
				return false;
			});
			
			pData.find('#menu-GestionProducteur-ListeFerme').click(function() {
				ListeFermeVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-CompteZeybu').click(function() {
				CompteZeybuVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-Virements').click(function() {
				VirementZeybuVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-ListeVirement').click(function() {
				ListeVirementZeybuVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-SuiviPaiement').click(function() {
				SuiviPaiementVue();
				return false;
			});
			
			pData.find('#menu-RechargementCompte-RechargerCompte').click(function() {
				RechargerCompteVue();
				return false;
			});
			
			pData.find('#menu-GestionCaisse-GestionCaisse').click(function() {
				GestionCaisseVue();
				return false;
			});
			
			pData.find('#menu-GestionProduit-GestionCategorie').click(function() {
				GestionCategorieVue();
				return false;
			});
			
			pData.find('#menu-GestionProduit-GestionCaracteristique').click(function() {
				GestionCaracteristiqueVue();
				return false;
			});
			
			pData.find('#menu-GestionComptesSpeciaux-ListeCompte').click(function() {
				ListeComptesSpeciauxVue();
				return false;
			});
			
			pData.find('#menu-GestionAbonnement-ListeProduit').click(function() {
				ListeProduitVue();
				return false;
			});
			
			pData.find('#menu-GestionAbonnement-ListeAbonne').click(function() {
				ListeAbonneVue();
				return false;
			});
			
			pData.find('#menu-Caisse-ListeMarche').click(function() {
				CaisseListeCommandeVue();
				return false;
			});
			
			pData.find('#menu-Caisse-CaissePermanente').click(function() {
				CaisseMarcheCommandeVue({id_commande:-1});
				return false;
			});
			
			pData.find('#menu-Parametrage-Banque').click(function() {
				ListeBanqueVue();
				return false;
			});
				
			return pData;
		}
		return null;
	};
	
	this.construct(pParam);
}	;function IdentificationVue(pParam) {
	this.mType = 0;
	this.mModules = [];
	this.construct = function(pParam) {	
		if(pParam && pParam.vr) {
			Infobulle.generer(pParam.vr,'');
		}
		this.afficher();
	};
	
	this.afficher = function() {
		this.affect();
	};
	
	this.affect = function() {		
		this.affectIdentifier();
		gCommunVue.comHoverBtn();
		$('#login').focus();
	};
	
	this.affectIdentifier = function() {
		var that = this;
		$('#identification-form').submit(function() {
			that.identifier($(this));
			return false;
		});
	};
	
	this.identifier = function(pObj) {
		var lVo = new IdentificationVO();
		lVo = {fonction:"identifier","login":pObj.find(':input[name=login]').val(),"pass":pObj.find(':input[name=pass]').val()};
		
		var lValid = new IdentificationValid();
		var lVr = lValid.validAjout(lVo);

		Infobulle.init(); // Supprime les erreurs
		if (lVr.valid) {
			var that = this;
			var lIdentificationTemplate = new IdentificationTemplate();
			//$('#formulaire_identification_int').hide().after(lIdentificationTemplate.chargementIdentification);
			//$('#contenu').replaceWith(lIdentificationTemplate.chargementIdentification);
			$('.formulaire_identification').toggle();
			$.post(	"./index.php?m=Identification&v=Identification", "pParam=" + $.toJSON(lVo),
					function(lResponse) {
					  	Infobulle.init(); // Supprime les erreurs
					  	if(lResponse) {
							if(lResponse.valid) {
								that.mType = parseInt(lResponse.type);
								that.mModules = lResponse.modules;
								gIdConnexion = lResponse.idConnexion;
								$('#contenu').replaceWith(that.affectChargement($(lIdentificationTemplate.chargementModule)));
								that.chargerModule(0);
							} else {
								//alert(lContenu);
								//$('#contenu').replaceWith(that.affect($(lIdentificationTemplate.formulaireIdentification)));
								$('.formulaire_identification').toggle();
								Infobulle.generer(lResponse,'');
							}
					  	}
					},"json"
			);
		} else {
			Infobulle.generer(lVr);
		}		
	};
	
	this.affectChargement = function(pData) {
		pData.find('#chargement-module-progressbar').progressbar({value:1});
		return pData;
	};
	
	// Charge les modules les uns après les autres puis lance la page d'acceuil après le dernier chargement
	this.chargerModule = function(pPosition) {
		if(this.mModules[pPosition]) {
			var that = this;
			var lNvPosition = pPosition + 1;
			if(this.mModules.length == lNvPosition) { // Si c'est le dernier module on lance la première page
				var lNiveau = parseFloat(lNvPosition) / parseFloat(this.mModules.length) * 100;
				$("#chargement-module-progressbar").progressbar({value:lNiveau});
				$.getScript("./js/package/zeybux-" + that.mModules[pPosition] + "-min-20131029133154.js",function() {that.initAction();});
			} else {
				var lNiveau = parseFloat(lNvPosition) / parseFloat(this.mModules.length) * 100;
				$("#chargement-module-progressbar").progressbar({value:lNiveau});
				$.getScript("./js/package/zeybux-" + that.mModules[pPosition] + "-min-20131029133154.js",function() {that.chargerModule(lNvPosition);});
			}			
		}		
	};
	
	this.initAction = function() {
		// Affichage des infobulles pour les erreurs	
		//if (!$.browser.webkit) { // Uniquement si ce n'est pas chrome
			$(document).ajaxStart( function() {$("#loading").fadeIn(gTempsTransition);} );
			$(document).ajaxStop( function() {$("#loading").fadeOut(gTempsTransition);} );
		//}
		
		// Gestion du F5
		// Bloque le fonctionnement du F5
		$(document).bind('keypress keydown keyup', function(e) {
		    if(e.charCode === 0 && (e.keyCode === 116 || (e.which === 82 && e.ctrlKey))) {
		       return false;
		    }
		});
		// Recharge la page
		$(document).keyup(function(e) {
		    if(e.charCode === 0 && (e.which === 116 || (e.which === 82 && e.ctrlKey))) {
		    	var cursor = $(".__historyFrame").contents().attr( $.browser.msie ? 'URL' : 'location' ).toString().split('#')[1];
				// set the history cursor to the current cursor
				$.history.cursor = parseFloat(cursor) || 0;
				// reinstate the current cursor data through the callback
				if ( typeof($.history.callback) == 'function' ) {
					// prevent the callback from re-inserting same history element
					$.history._locked = true;
					$.history.callback( $.history.stack[ cursor ], cursor );
					$.history._locked = false;
				}
			}
		});

		// Confirmation de sortie du zeybux
	/*	$(window).bind('beforeunload', function() {
		    return "";
		});*/

		this.lancement();
	};
		
	this.lancement = function() {
		switch(this.mType) {
			// Adherent
			case 1:
				MenuVue({homePage:function() {MonCompteVue();}});				
			break;
			// Administrateur
			case 2:
				MenuVue({homePage:function() {AdministrationVue();}});
			break;
			// Caisse
			case 3:
				MenuVue({homePage:function() {CaisseListeCommandeVue();}});
			break;
			// Compte Solidaire
			case 4:
				MenuVue({homePage:function() {CompteSolidaireVue();}});
			break;
			
			default :
				var lVr = new TemplateVR();
				lVr.valid = false;
				lVr.log.valid = false;
				var erreur = new VRerreur();
				erreur.code = ERR_222_CODE;
				erreur.message = ERR_222_MSG;
				lVr.log.erreurs.push(erreur);
				Infobulle.generer(lVr,'');
			break;
		}
	};
	
	this.construct(pParam);
};function AccueilVue(pParam) {
	this.construct = function(pParam) {
		if(pParam && pParam.vr) {
			Infobulle.generer(pParam.vr,'');
		}
		this.afficher();
	};	
	
	this.afficher = function() {
		if($.browser.msie) {
			var lIdentificationTemplate = new IdentificationTemplate();
			$('noscript').replaceWith(lIdentificationTemplate.infoNavIncompatible);
		} else {	
			var that = this;

			$.getScript("./js/zeybux-configuration-min-20131029133154.js",function() {
				that.init();
				IdentificationVue();
			});
		}		
	};
	
	this.init = function() {
		this.initObj();
		this.initAction();
	};
	
	this.initObj = function() {
		// Initialisation des objets globaux
		TemplateData = new TemplateData();
		Infobulle = new Infobulles();
		gCommunVue = new CommunVue();
		gIdConnexion = null;
	};
	
	this.initAction = function() {
		// Affichage des infobulles pour les erreurs	
		$("#widget_message_information").click(function() {$(this).delay(gTempsTransition).fadeOut(gTempsTransitionUnique);});		
		/*$("#loading").ajaxStart( function() {$(this).fadeIn(gTempsTransition);} );
		$("#loading").ajaxStop( function() {$(this).fadeOut(gTempsTransition);} );	*/	

		$.history.callback = function ( pReinstate, pCursor ) {
			var lDefault = {
				vue: function() { return false; }
			};
			lDefault = $.extend(lDefault,pReinstate);
			// check to see if were back to the beginning without any stored data
			if (typeof(pReinstate) == 'undefined') { return false; }
			else { $(".ui-dialog").remove(); lDefault.vue(); }
		};
		
		
		
	};
	
	this.construct(pParam);
};function TypePaiementService() {
	this.affect = function(pData, pBanques, pPrefixe) {
		if(pPrefixe == undefined) { pPrefixe = ''; }
		pData = this.affectListeBanque(pData, pBanques, pPrefixe);
		pData = this.affectNumeric(pData, pPrefixe);
		return pData;
	};
	
	this.affectNumeric = function(pData, pPrefixe) {
		pData.find('#' + pPrefixe + 'champComplementaire3valeur').numeric({nbDecimal: 0});
		return pData;
	};
	
	this.affectListeBanque = function(pData, pBanques, pPrefixe) {
		if(pData.find('#' + pPrefixe + 'champComplementaire2valeur').length == 1) {
			function removeIfInvalid(element) {
				// Vide le champ si la banque n'existe pas
				var value = $( element ).val(),
				matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
				valid = false;
				$( pBanques ).each(function() {
					if (  this.nom.match( matcher ) ) {
						this.selected = valid = true;
						return false;
					}
				});
				
				if ( !valid ) {
					$( element ).attr( 'id-banque','' ); 
					
					// Message d'information
					var lVr = new OperationDetailVR();
					lVr.valid = false;
					
					var lVrChampComplementaire = new ChampComplementaireVR();
					
					lVrChampComplementaire.valid = false;
					lVrChampComplementaire.valeur.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_261_CODE;
					erreur.message = ERR_261_MSG;
					lVrChampComplementaire.valeur.erreurs.push(erreur);
					
					lVr.champComplementaire[2] = lVrChampComplementaire;
									
					Infobulle.generer(lVr,'');
					return false;
				}
			};
					
			pData.find('#' + pPrefixe + 'champComplementaire2valeur').autocomplete({
				minLength: 0,			 
				source: function( request, response ) {
					var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
						response( $.grep( pBanques, 
							function( item ){
								return matcher.test( item.nom ) || matcher.test( item.nomCourt );
							}
						));
				},	 
				focus: function( event, ui ) {
					Infobulle.init(); // Supprime les erreurs
					$( '#' + pPrefixe + 'champComplementaire2valeur' ).val( htmlDecode(ui.item.nom) );
					$( '#' + pPrefixe + 'champComplementaire2valeur' ).attr('id-banque', ui.item.id );
					return false;
				},
				select: function( event, ui ) {
					Infobulle.init(); // Supprime les erreurs
					$( '#' + pPrefixe + 'champComplementaire2valeur' ).val( htmlDecode(ui.item.nom) );
					$( '#' + pPrefixe + 'champComplementaire2valeur' ).attr('id-banque', ui.item.id );
					return false;
				},
				change: function( event, ui ) {
					Infobulle.init(); // Supprime les erreurs
					if ( !ui.item )
						return removeIfInvalid( this );
				}
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
				return $( "<li>" )
				.data( "item.autocomplete", item )
				.append( "<a>" + item.nomCourt + " : " + item.nom + "<br>" + item.description + "</a>" )
				.appendTo( ul );
			};
		}
		return pData;
	};
	
	this.getChampComplementaire = function(pChamp, pPrefixe) {
		if(pPrefixe == undefined) { pPrefixe = ''; }
		var lListeChampComplementaire = [];
		$(pChamp).each(function() {
			var lChampComplementaire = new ChampComplementaireVO();
			lChampComplementaire.id = this.id;
			lChampComplementaire.obligatoire = this.obligatoire;

			switch(parseInt(this.id)) {
				case 2: // idBanque
					var lValeur = $('#' + pPrefixe + 'champComplementaire' + this.id + 'valeur').attr('id-banque');
					lChampComplementaire.valeur = (lValeur != undefined) ? lValeur : '';
					break;
				default:
					lChampComplementaire.valeur = $('#' + pPrefixe + 'champComplementaire' + this.id + 'valeur').val();
					break;
			};
			lListeChampComplementaire[this.id] = lChampComplementaire;
		});
		return lListeChampComplementaire;
	};
	
	this.getFormChampcomplementaire = function(pChamp, pBanques, pAffiche, pPrefixe) {
		//var lChamp = clone(pChamp);
		if(pPrefixe == undefined) { pPrefixe = ''; }
		var lChamp = $.extend(true,{},pChamp);

		var lBanques = [];
		$(pBanques).each(function() {
			lBanques[this.id] = this;
		});

		$.each(lChamp, function() {	
			if(this.id != undefined) {
				switch(parseInt(this.id)) {
					case 2: // idBanque
						if(lBanques[this.valeur]) {
							this.attr = 'id-banque="' + this.valeur + '"';
							this.valeur = lBanques[this.valeur].nom;
						} else {
							this.attr = '';
							this.valeur = '';
						}
						break;
					default:
						this.attr = '';
						break;
				}
				if(this.tppCpVisible != 1) {
					this.valeur = '';
				}
			}
		});
		
		lTypePaiementServiceTemplate = new TypePaiementServiceTemplate();
		var lTemplate = '';
		if(pAffiche == undefined) {
			lTemplate = lTypePaiementServiceTemplate.champComplementaire;
		} else {
			lTemplate = lTypePaiementServiceTemplate.champComplementaireAffiche;
		}
		
		return lTemplate.template({champComplementaire:lChamp, prefixe:pPrefixe});
	};
};;function CommunVue() {
	
	this.comDelete = function(pData) {	
		pData.find(".com-delete").click( function () { $(this).parent().parent().remove(); });
		return pData;	
	};
	
	this.comNumeric = function(pData, pOption) {
		if($(pData).length != 0)
			pData.find('.com-numeric').numeric(pOption);
		else
			$("body").find('.com-numeric').numeric(pOption);
		return pData;
	};
	
	this.comLienDatepicker = function(pDatePetite,pDateGrande,pData) {
		$.datepicker.setDefaults($.datepicker.regional['fr']);
		var dates = pData.find('#' + pDatePetite + ',#' + pDateGrande).datepicker({
			changeMonth: true,
			changeYear: true,
			onSelect: function(selectedDate) {
				var option = this.id == pDatePetite ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
		return pData;
	};
	
	this.lienDatepickerMarche = function(pDebutReservation, pFinReservation, pDebutMarche, pData) {
		pData.find('#' + pDebutReservation).datepicker({
			changeMonth: true,
			changeYear: true,
			onSelect: function(selectedDate) {
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				$('#' + pFinReservation).datepicker("option", "minDate", date);		
			}
		});
		pData.find('#' + pFinReservation).datepicker({
			changeMonth: true,
			changeYear: true,
			onSelect: function(selectedDate) {
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				$('#' + pDebutReservation).datepicker("option", "maxDate", date);		
				$('#' + pDebutMarche).datepicker("option", "minDate", date);		
			}
		});
		pData.find('#' + pDebutMarche).datepicker({
			changeMonth: true,
			changeYear: true,
			onSelect: function(selectedDate) {
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				$('#' + pFinReservation).datepicker("option", "maxDate", date);		
			}
		});
		return pData;
	};
	
	this.comDatepicker = function(pIdDate,pData) {
		$.datepicker.setDefaults($.datepicker.regional['fr']);
		pData.find('#' + pIdDate).datepicker({
			changeMonth: true,
			changeYear: true});
		return pData;		
	};
	
	this.majMenu = function(pModule,pVue) {
		var lId = '#menu-' + pModule + '-' + pVue;
		if(pModule == 'administration') {
			lId = '#lien-administration';
		}
		$('.btn-menu').removeClass("ui-state-active");
		$(lId).addClass("ui-state-active");		
	};
	
	this.comHoverBtn = function(pData) {
		if(pData) {
			pData.find(	".com-button:not(.ui-state-disabled)," +
						".com-btn-header:not(.ui-state-disabled)," +
						".com-btn-hover:not(.ui-state-disabled)," +
						".com-btn-header-multiples:not(.ui-state-disabled)")
			.hover(
				function(){ 
					$(this).addClass("ui-state-hover"); 
				},
				function(){ 
					$(this).removeClass("ui-state-hover"); 
				}
			)
			.mousedown(function(){
					$(this).addClass("ui-state-active");	
			})
			.mouseup(function(){
					$(this).removeClass("ui-state-active");
			});
			
			return pData;
		} else {
			$(".com-button:not(.ui-state-disabled)," +
					".com-btn-header:not(.ui-state-disabled)," +
					".com-btn-hover:not(.ui-state-disabled)," +
					".com-btn-header-multiples:not(.ui-state-disabled)")
			.hover(
				function(){ 
					$(this).addClass("ui-state-hover"); 
				},
				function(){ 
					$(this).removeClass("ui-state-hover"); 
				}
			)
			.mousedown(function(){
					$(this).addClass("ui-state-active");	
			})
			.mouseup(function(){
					$(this).removeClass("ui-state-active");
			});
		}
	};
}/********** Début Variables Globales ************/
var TemplateData;
var Infobulle = {};
var gCommunVue = {};
/********** Fin Variables Globales ************/
$(document).ready(function() {
	AccueilVue(); // Lancement de l'accueil
});;function CaisseVue(pParam) {
	this.mParam = {};
	this.mSolde = 0;
	this.mIdCompte = 0;
	
	this.mTypePaiement = [];
	this.mBanques = [];
	this.mAdherent = {};
		
	this.mLots = [];
	//this.mPrixProduit = [];
	this.mLotAchat = [];
	this.mFocusRechargement = 0;
	this.mCategorie = [];
	this.mNomCategorie = [];
	
	this.mAchat = {};
	//this.mIdAchat = [];
	this.mTotalAchatInit = 0;
	this.mAchatInitial = null;
	
	this.mTypePaiementSelect = 0;
	this.afficheChCpAutorise = true;
	
	this.mModule = 'Caisse';
	this.mIdRequete = '';
	this.mCompteurIdProduit = 0;
	this.mModeEdition = 0;
	
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CaisseVue(pParam);}} );
		this.mParam = pParam;
		
		var that = this;
		
		pParam.fonction = "infoAchat"; // Par défaut Adhérent sur Marché
		
		if(pParam.id_adherent && pParam.id_adherent == 0) { // compte invité
			this.mIdCompte = -3;
		}
		
		this.mModule = pParam.module;
				
		$.post(	"./index.php?m=" + this.mModule + "&v=CaisseMarcheCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							
						/*	if(pParam.module == 'GestionCommande') {
								//pParam.id_commande = -1;
								
								if(lResponse.achats.operationAchat != null && lResponse.achats.operationAchat.champComplementaire[1] && lResponse.achats.operationAchat.champComplementaire[1].valeur != null) {
									pParam.id_commande = lResponse.achats.operationAchat.champComplementaire[1].valeur;
								}
								if(lResponse.achats.operationAchatSolidaire != null && lResponse.achats.operationAchatSolidaire.champComplementaire[1] && lResponse.achats.operationAchatSolidaire.champComplementaire[1].valeur != null) {
									pParam.id_commande = lResponse.achats.operationAchatSolidaire.champComplementaire[1].valeur;
								}
								if(lResponse.achats.rechargement != null && lResponse.achats.rechargement.champComplementaire[1] && lResponse.achats.rechargement.champComplementaire[1].valeur != null) {
									pParam.id_commande = lResponse.achats.rechargement.champComplementaire[1].valeur;
								}
							}*/
							
							that.mIdRequete = lResponse.idRequete;
								
							// Les informations pour le paiement
							that.mTypePaiement = lResponse.typePaiement;	
							that.mBanques = lResponse.banques;

							if(pParam.id_adherent != 0) { // Si pas invité les informations de l'adhérent
								that.mIdCompte = lResponse.adherent.adhIdCompte;
								that.mAdherent = lResponse.adherent;
								that.mSolde = parseFloat(lResponse.adherent.cptSolde);
							} else {
								lResponse.adherent = {};
							}
							lResponse.adherent.rechargementMontant = '';
							lResponse.adherent.rechargementChampComplementaire = '';
							if(lResponse.achats.rechargement != null && lResponse.achats.rechargement.id && lResponse.achats.rechargement.id != null) {
								that.mSolde = (parseFloat(that.mSolde) - parseFloat(lResponse.achats.rechargement.montant)).toFixed(2);
								lResponse.adherent.rechargementMontant = lResponse.achats.rechargement.montant.nombreFormate(2,',','');
								that.mTypePaiementSelect = lResponse.achats.rechargement.typePaiement;
																	
								var lTypePaiementService = new TypePaiementService();
								var lChampComplementaire = [];

								if(that.mTypePaiement[lResponse.achats.rechargement.typePaiement]) {
									$(that.mTypePaiement[lResponse.achats.rechargement.typePaiement].champComplementaire).each(function() {				
										var lChamp = lResponse.achats.rechargement.champComplementaire[this.id];
										lChamp.id = this.id;
										lChamp.tppCpVisible = 1;
										lChamp.chCpLabel = this.label;
										lChampComplementaire.push(lChamp);
									});
								}
								
								lResponse.adherent.champComplementaire = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, that.mBanques, undefined, 'rechargement');
							}

							lResponse.adherent.total = 0;
							lResponse.adherent.totalAchat = 0;
							lResponse.adherent.totalAchatSolidaire = 0;

							$.each(lResponse.lots,function() {
								$.each(this.lots,function() {
									this.tailleAffiche = this.taille.nombreFormate(2,',',' ');
									this.selected = '';	
									this.mLotPrixUnitaire = (parseFloat(this.prix) / parseFloat(this.taille)).toFixed(2).nombreFormate(2,',',' ');
								});
							});
							that.mLots = lResponse.lots;
							
							$.each(lResponse.stock, function() {
								var lAfficherCategorie = false;
								that.mNomCategorie[this.cproId] = {cproNom:this.cproNom};
								
								this.visible = 'ui-helper-hidden';
																
								$.each(this.produits, function() {
									
									that.mCompteurIdProduit--;
									this.id = that.mCompteurIdProduit;
																		
									if(this.montant != null) {
										that.mTotalAchatInit = (parseFloat(that.mTotalAchatInit) + parseFloat(this.montant * -1)).toFixed(2);
										this.quantiteAchat = (this.quantite * -1).nombreFormate(2,',','') ;
										this.montantAchat = (this.montant * -1).nombreFormate(2,',','') ;
										lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(this.montant * -1)).toFixed(2);
										lAfficherCategorie = true;
										var lIdLot = ( this.idDetailCommande != 0 ) ? this.idDetailCommande : this.idModeleLot;
										if(that.mLotAchat[this.id]) {
											that.mLotAchat[this.id].normal = lIdLot;	
										} else {
											that.mLotAchat[this.id] = {normal:lIdLot,solidaire:0};
										}
									} else {
										this.quantiteAchat = '';
										this.montantAchat = '';
										this.idStock = 0;
										this.idDetailOperation = 0;
									}
									
									if(this.montantSolidaire != null) {
										that.mTotalAchatInit = (parseFloat(that.mTotalAchatInit) + parseFloat(this.montantSolidaire * -1)).toFixed(2);
										this.quantiteAchatSolidaire = (this.quantiteSolidaire * -1).nombreFormate(2,',','') ;
										this.montantAchatSolidaire = (this.montantSolidaire * -1).nombreFormate(2,',','') ;
										lResponse.adherent.totalAchatSolidaire = (parseFloat(lResponse.adherent.totalAchatSolidaire) + parseFloat(this.montantSolidaire * -1)).toFixed(2);
										lAfficherCategorie = true;
										
										var lIdLot = ( this.idDetailCommandeSolidaire != 0 ) ? this.idDetailCommandeSolidaire : this.idModeleLotSolidaire;
										if(that.mLotAchat[this.id]) {
											that.mLotAchat[this.id].solidaire = lIdLot;	
										} else {
											that.mLotAchat[this.id] = {normal:0,solidaire:lIdLot};
										}
									} else {
										this.quantiteAchatSolidaire = '' ;
										this.montantAchatSolidaire = '' ;
										this.idStockSolidaire = 0;
										this.idDetailOperationSolidaire = 0;
									}									
									
								});
								
								// Affiche la catégorie si il y a un achat ou reservation
								if(lAfficherCategorie) {
									this.visible = '';
								}								
							});				
							
							lResponse.adherent.total = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(lResponse.adherent.totalAchatSolidaire)).toFixed(2);
							
							// Si il y a eu un achat ou un rechargement affiche le résumé
							if((lResponse.achats.produits && lResponse.achats.produits[0] && lResponse.achats.produits[0].cproId != null) || (lResponse.achats.rechargement !=null && lResponse.achats.rechargement.id != null)) { 
								

								if(lResponse.achats != null) {
									if(lResponse.achats.operationAchat != null) {										
										var lTempChampComplementaire = [];
										for( i in lResponse.achats.operationAchat.champComplementaire) {
											if(lResponse.achats.operationAchat.champComplementaire[i].opeId != null) {
												lResponse.achats.operationAchat.champComplementaire[i].obligatoire = 0;
												lResponse.achats.operationAchat.champComplementaire[i].id = i;
												lTempChampComplementaire[i] = lResponse.achats.operationAchat.champComplementaire[i];
											}
										}
										lResponse.achats.operationAchat.champComplementaire = lTempChampComplementaire;
									}
									if(lResponse.achats.operationAchatSolidaire != null) {										
										var lTempChampComplementaire = [];
										for( i in lResponse.achats.operationAchatSolidaire.champComplementaire) {
											if(lResponse.achats.operationAchatSolidaire.champComplementaire[i].opeId != null) {
												lResponse.achats.operationAchatSolidaire.champComplementaire[i].obligatoire = 0;
												lResponse.achats.operationAchatSolidaire.champComplementaire[i].id = i;
												lTempChampComplementaire[i] = lResponse.achats.operationAchatSolidaire.champComplementaire[i];
											}
										}
										lResponse.achats.operationAchatSolidaire.champComplementaire = lTempChampComplementaire;
									}
									if(lResponse.achats.rechargement != null && lResponse.achats.rechargement.id != null) {										
										var lTempChampComplementaire = [];
										for( i in lResponse.achats.rechargement.champComplementaire) {
											if(lResponse.achats.rechargement.champComplementaire[i].opeId != null) {
												lResponse.achats.rechargement.champComplementaire[i].obligatoire = 0;
												lResponse.achats.rechargement.champComplementaire[i].id = i;
												lTempChampComplementaire[i] = lResponse.achats.rechargement.champComplementaire[i];
											}
										}
										lResponse.achats.rechargement.champComplementaire = lTempChampComplementaire;
									} else {
										lResponse.achats.rechargement = null;
									}
								}
								
								that.mAchatInitial = lResponse.achats;
								that.mModeEdition = 1;		
								that.afficher(lResponse, that.recapitulatifAchat);
							} else {
								that.afficher(lResponse);
							}
							
						/*	if(pParam.id_commande != -1) { // Si marché test si achat
								if(lResponse.achats.length > 0 || (lResponse.achats.rechargement !=null && lResponse.achats.rechargement.id != null)) { // Si il y a eu un achat ou un rechargement affiche le résumé
									that.afficher(lResponse, that.recapitulatifAchat);
								} else { // Sinon affiche le formulaire
									that.afficher(lResponse);
								}
							} else { // Hors marché affiche le formulaire
								that.afficher(lResponse);
							}
							
							that.afficher(lResponse);*/
							
							/*if(pParam.id_commande != -1) { // Traitement des produits du marché
								$.each(lResponse.marche.produits, function() {
									if(this.id) {	
										var lIdProduit = this.id;
										var lUnite = this.unite;
										var lProduit = {
												id:this.id,
												nproId:this.idNom,
												nom:this.nom,
												unite:this.unite,
												quantiteReservation:'',
												quantiteAchat:'', prixAchat:'', quantiteAchatAffiche:'', prixAchatAffiche:'',
												quantiteAchatSolidaire:'', prixAchatSolidaire:'', quantiteAchatAfficheSolidaire:'', prixAchatAfficheSolidaire:''};
										
										var lLots = [];
										$.each(this.lots, function() {
											this.mLotPrixUnitaire = (parseFloat(this.prix) / parseFloat(this.taille)).toFixed(2).nombreFormate(2,',',' ');											
											this.tailleAffiche = this.taille.nombreFormate(2,',',' ');
											this.selected = '';	
											
											that.mLots[this.id] = this;
											lLots.sort(function(a,b) {return a.taille.localeCompare(b.taille);});
											lLots.push(this);
										});
										
										var lAfficherCategorie = false;
										if(pParam.id_adherent != 0) { // Si adhérent vérifie la réservation et l'achat
											
										/*	var lAchatReservation = 0;
											var lAchat = 0;*/
																						
						/*					$.each(lResponse.reservation, function() {
												if(this.idProduit == lIdProduit) {
													lProduit.quantiteReservation = (this.quantite * -1).nombreFormate(2,',',' ') + ' ' + lUnite;
													if(lResponse.achats.length == 0) { // Si pas d'achat
														lProduit.quantiteAchat = (this.quantite * -1).nombreFormate(2,',','') ;
														lProduit.prixAchat = (this.montant * -1).nombreFormate(2,',','') ;
														//lAchatReservation = (parseFloat(lAchatReservation) + parseFloat(this.montant) * -1).toFixed(2);
														lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) - parseFloat(this.montant)).toFixed(2);
														that.mLotAchat[lIdProduit] = {normal:this.idDetailCommande,solidaire:0};
													}
													lAfficherCategorie = true;
												}
											});
											
											/*if(lAchat == 0) {// Si pas d'achat affiche le total réservation
												lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(lAchatReservation)).toFixed(2);
											} else {
												lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(lAchat)).toFixed(2);
											}*/
											
						/*					lResponse.adherent.total = (parseFloat(lResponse.adherent.totalAchat) + parseFloat(lResponse.adherent.totalAchatSolidaire)).toFixed(2);
										}
										
										if(!that.mCategorie[this.idCategorie]) {											
											var lInfoCategorie = {
													cproId:this.idCategorie,
													cproNom:this.cproNom,
													visible:'ui-helper-hidden',
													produits:[]};
											
											that.mCategorie[this.idCategorie] = lInfoCategorie;
											that.mNomCategorie[this.idCategorie] = lInfoCategorie;
										}
										
										// Affiche la catégorie si il y a un achat ou reservation
										if(lAfficherCategorie) {
											that.mCategorie[this.idCategorie].visible = '';
										}
										
										that.mCategorie[this.idCategorie].produits[this.idNom] = lProduit;
										lProduit.lots = lLots;
										that.mPrixProduit[this.idNom] = lProduit;	
									}
								});
							}
							
							
							$.each(lResponse.achats.produits, function() {
								
								var lNproId = this.idNom;
								var lProduitMarche = false;
								var lproduitAchat = this;
																	
								if(pParam.id_commande != -1) { // Si c'est un marché priorité aux produits du marché
									$.each(lResponse.marche.produits, function() {
										if(this.id && this.idNom == lNproId) {
											lProduitMarche = true;
											if(this.quantite != null) {
												this.quantiteAchat = (lproduitAchat.quantite * -1).nombreFormate(2,',','') ;
												this.prixAchat = (lproduitAchat.montant * -1).nombreFormate(2,',','') ;
												this.quantiteAchatAffiche = (lproduitAchat.quantite * -1).nombreFormate(2,',',' ') ;
												this.prixAchatAffiche = (lproduitAchat.montant * -1).nombreFormate(2,',',' ') ;
												
												lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) - parseFloat(lproduitAchat.montant)).toFixed(2);
												
												that.mSolde = (parseFloat(that.mSolde) - parseFloat(lproduitAchat.montant)).toFixed(2);
												
												if(that.mLotAchat[this.id]) {
													that.mLotAchat[this.id].normal = lproduitAchat.idDetailCommande;
												} else {
													that.mLotAchat[this.id] = {normal:lproduitAchat.idDetailCommande,solidaire:''};
												}
											}
											
										}
									});
								}
								
								
								
								
								/*if(this.id && this.id.idAchat) {
									that.mIdAchat.push(this.id.idAchat); // Récupération des IdAchat
								}*/
							/*	$(this.detailAchat).each(function() {
									if(this.idProduit == lIdProduit) {
										lProduit.quantiteAchat = (this.quantite * -1).nombreFormate(2,',','') ;
										lProduit.prixAchat = (this.montant * -1).nombreFormate(2,',','') ;
										lProduit.quantiteAchatAffiche = (this.quantite * -1).nombreFormate(2,',',' ') ;
										lProduit.prixAchatAffiche = (this.montant * -1).nombreFormate(2,',',' ') ;
										//lAchat = (parseFloat(lAchat) + parseFloat(this.montant) * -1).toFixed(2);
										lResponse.adherent.totalAchat = (parseFloat(lResponse.adherent.totalAchat) - parseFloat(this.montant)).toFixed(2);
										lAfficherCategorie = true;
										that.mSolde = (parseFloat(that.mSolde) - parseFloat(this.montant)).toFixed(2);
										
										if(that.mLotAchat[lIdProduit]) {
											that.mLotAchat[lIdProduit].normal = this.idDetailCommande;
										} else {
											that.mLotAchat[lIdProduit] = {normal:this.idDetailCommande,solidaire:''};
										}
									}
								});
								
								$(this.detailAchatSolidaire).each(function() {
									if(this.idProduit == lIdProduit) {
										lProduit.quantiteAchatSolidaire = (this.quantite * -1).nombreFormate(2,',','') ;
										lProduit.prixAchatSolidaire = (this.montant * -1).nombreFormate(2,',','') ;
										lProduit.quantiteAchatAfficheSolidaire = (this.quantite * -1).nombreFormate(2,',',' ') ;
										lProduit.prixAchatAfficheSolidaire = (this.montant * -1).nombreFormate(2,',',' ') ;
										lResponse.adherent.totalAchatSolidaire = (parseFloat(lResponse.adherent.totalAchatSolidaire) - parseFloat(this.montant)).toFixed(2);
										lAfficherCategorie = true;
										that.mSolde = (parseFloat(that.mSolde) - parseFloat(this.montant)).toFixed(2);
										
										if(that.mLotAchat[lIdProduit]) {
											that.mLotAchat[lIdProduit].solidaire = this.idDetailCommande;
										} else {
											that.mLotAchat[lIdProduit] = {normal:'',solidaire:this.idDetailCommande};
										}
									}
								});*/
						//	});
							
							// Ajout des produits en stock
							
						/*	var lIdProduitEnStock = -1;
							$.each(lResponse.stock, function() {
								if(this.idNom) {
									var lNproId = this.idNom;
									var lProduitMarche = false;
																		
									if(pParam.id_commande != -1) { // Si c'est un marché priorité aux produits du marché
										$.each(lResponse.marche.produits, function() {
											if(this.id && this.idNom == lNproId) {
												lProduitMarche = true;
											}
										});
									}
									
									if(!lProduitMarche) {
										var lLots = [];
										$.each(this.lots, function() {
											this.mLotPrixUnitaire = (parseFloat(this.prix) / parseFloat(this.taille)).toFixed(2).nombreFormate(2,',',' ');											
											this.tailleAffiche = this.taille.nombreFormate(2,',',' ');
											this.selected = '';	
											
											that.mLots[this.id] = this;
											lLots.push(this);
										});
									
										if(!that.mCategorie[this.idCategorie]) {
											var lInfoCategorie = {
													cproId:this.idCategorie,
													cproNom:this.cproNom,
													visible:'ui-helper-hidden',
													produits:[]};
											
											that.mCategorie[this.idCategorie] = lInfoCategorie;
											that.mNomCategorie[this.idCategorie] = lInfoCategorie;
										}
										
										var lProduit = {
												id:lIdProduitEnStock,
												nproId:this.idNom,
												nom:this.nom,
												unite:this.unite,
												quantiteReservation:'',
												quantiteAchat:'', prixAchat:'', quantiteAchatAffiche:'', prixAchatAffiche:'',
												quantiteAchatSolidaire:'', prixAchatSolidaire:'', quantiteAchatAfficheSolidaire:'', prixAchatAfficheSolidaire:''};	
										
										that.mCategorie[this.idCategorie].produits[this.idNom] = lProduit;	
										
										lLots.sort(function(a,b) {return a.taille.localeCompare(b.taille);});
										lProduit.lots = lLots;
										that.mPrixProduit[this.idNom] = lProduit;	
										lIdProduitEnStock--;
									}
								}
							});*/
							
							// Tri des catégories
				/*			that.mCategorie.sort(function(a,b) {return a.cproNom.localeCompare(b.cproNom);});
							// Tri des produits
							$.each(that.mCategorie,function() {
								if(this.cproNom) {
									this.produits.sort(function(a,b) {return a.nom.localeCompare(b.nom);});
								}
							});
							
							if(pParam.id_commande != -1) { // Si marché test si achat
								if(lResponse.achats.length > 0 || (lResponse.achats.rechargement !=null && lResponse.achats.rechargement.id != null)) { // Si il y a eu un achat ou un rechargement affiche le résumé
									that.afficher(lResponse, that.recapitulatifAchat);
								} else { // Sinon affiche le formulaire
									that.afficher(lResponse);
								}
							} else { // Hors marché affiche le formulaire
								that.afficher(lResponse);
							}*/
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(pResponse, pCallBack) {
		var lCaisseTemplate = new CaisseTemplate();
		
		var lData = {categories:pResponse.stock, sigleMonetaire: gSigleMonetaire};
		pResponse.adherent.sigleMonetaire = gSigleMonetaire;
		pResponse.adherent.typePaiement = pResponse.typePaiement;

		pResponse.adherent.total = pResponse.adherent.total.nombreFormate(2,',',' ');
		pResponse.adherent.totalAchat = pResponse.adherent.totalAchat.nombreFormate(2,',',' ');
		pResponse.adherent.totalAchatSolidaire = pResponse.adherent.totalAchatSolidaire.nombreFormate(2,',',' ');
		if(this.mParam.id_adherent != 0) { // Les informations de l'adhérent si ce n'est pas un compte invité		
			
			pResponse.adherent.adhSoldeEtatClass = '';
			if(parseFloat(pResponse.adherent.cptSolde) <= 0) {
				pResponse.adherent.adhSoldeEtatClass = 'com-nombre-negatif';		
			} 
			
			pResponse.adherent.adhSolde = pResponse.adherent.cptSolde.nombreFormate(2,',',' ');
			
			pResponse.adherent.identite = lCaisseTemplate.achatMarcheIdentiteAdherent.template(pResponse.adherent);
			pResponse.adherent.etatCompte = lCaisseTemplate.achatMarcheEtatCompte.template(pResponse.adherent);
			pResponse.adherent.labelRecharger = lCaisseTemplate.achatMarcheLabelRechargement;			
		} else {			
			pResponse.adherent.identite = lCaisseTemplate.achatMarcheIdentiteInvite;
			pResponse.adherent.etatCompte = lCaisseTemplate.achatMarcheEtatCompteInvite;
			pResponse.adherent.labelRecharger = lCaisseTemplate.achatMarcheLabelPaiement;
		}
		lData.infoAdherent = lCaisseTemplate.achatInfoAdherent.template(pResponse.adherent);
		
		var lHtml = '';
		/*if(pParam.id_commande != -1) { // Formulaire Marché
			lHtml = lCaisseTemplate.achatMarcheFormulaire.template(lData);
		} else { // Formulaire Caisse permanente*/
			lHtml = lCaisseTemplate.achatHorsMarcheFormulaire.template(lData);
		//}
		
		$('#contenu').replaceWith( this.affect($(lHtml)) );
		if(pCallBack) {
			pCallBack();
		}
	};
	
	this.affect = function(pData) {
		pData = this.affectAfficheLot(pData);
		pData = this.affectCalculPrix(pData);
		pData = this.affectPositionInfoAdherent(pData);
		pData = this.affectMajSolde(pData);
		pData = this.affectAfficheFormulaireRechargement(pData);
		pData = this.affectSelectTypePaiement(pData);
		//pData = this.affectListeBanque(pData);
		var lTypePaiementService = new TypePaiementService();
		pData = lTypePaiementService.affect(pData, this.mBanques);
		
		pData = this.affectValider(pData);
		pData = this.affectModifier(pData);
		pData = this.affectToggleTableauCategorie(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectRetour(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectSupprimer(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		var that = this;
		pData.find("#input-rechercher").keyup(function() {
			that.recherche(this.value);
		  });	
		
		pData.find('#icon-annuler-recherche').click(function() {
			$('#input-rechercher').val('');
			that.recherche('');
		});
		return pData;
	};
	
	this.recherche = function(pVal) {
		var that = this;
		if(pVal == '') {
			that.afficheCategorieNonVide();
		} else {
			$('.tableau-produit').show();
		}
		$.uiTableFilter( $('.tableau-produit'), pVal );
	};
	
	this.afficheCategorieNonVide = function() {
		var that = this;
		$('.ligne-categorie-btn-toggle span').addClass('ui-icon-triangle-1-s').removeClass('ui-icon-triangle-1-n');
		$('.tableau-produit').hide();
				
		$('.ligne-produit').each(function() {
			//var lNproId = $(this).data('id-nom-produit');

			var lIdProduit = $(this).data('id-produit');
			var lIdCategorie = $(this).data('id-categorie');
			
			var lVoProduit = new ProduitAchatVO();
			var lVoProduitSolidaire = new ProduitAchatVO();
			
			lVoProduit = that.qteEtPrixAchat(lIdProduit, '', lVoProduit);
			lVoProduitSolidaire = that.qteEtPrixAchat(lIdProduit, 'Solidaire', lVoProduitSolidaire);
			
			if(lVoProduit.quantite != '' || lVoProduit.prix != '' || lVoProduitSolidaire.quantite != '' || lVoProduitSolidaire.prix != '') {
				$('#btn-toggle-categorie-' + lIdCategorie + ' span').removeClass('ui-icon-triangle-1-s').addClass('ui-icon-triangle-1-n');
				$('#tableau-produit-' + lIdCategorie).show();
			}
		});
	};
	
	this.affectToggleTableauCategorie = function(pData) {
		pData.find('.ligne-categorie').click(function() {
			var lIdCategorie = $(this).data('id-categorie');
			$('#btn-toggle-categorie-' + lIdCategorie + ' span').toggleClass('ui-icon-triangle-1-s').toggleClass('ui-icon-triangle-1-n');
			$('#tableau-produit-' + lIdCategorie).toggle();
		});
		return pData;
	};
	
	this.affectAfficheLot = function(pData) {
		var that = this;
		var lCaisseTemplate = new CaisseTemplate();
		
		// Affiche le lot dès que le curseur est dans un champ
		pData.find(".produit-quantite, .produit-quantite-solidaire, .produit-prix, .produit-prix-solidaire").focus(function() {
			var lIdProduit = $(this).data('id-produit');
			var lNproId = $(this).data('id-nom-produit');
			var lUnite = $(this).data('unite');
			var lType = $(this).data('type');
			
			if($('#select-' + lNproId + lType).length == 0) {// Si le select est déjà affiché il ne faut pas le réinitialiser			
				//var lProduit = that.mPrixProduit[lNproId];
				
				var lLotsProduit = that.mLots[lNproId + lUnite].lots;
				var lIdPremierLot = 0;
				var lNbLots = 0;
				var lPremierLot = {};
				var lLotsAffiche = [];
				for(i in lLotsProduit) {
					if(lLotsProduit[i].id) {
						if(lIdPremierLot == 0) {
							lIdPremierLot = i;
							lPremierLot = lLotsProduit[i];
						}
						lLotsAffiche.push(lLotsProduit[i]);
						lNbLots++;
					}
				}
				
				lLotsAffiche.sort(function(a,b) {return a.taille.localeCompare(b.taille);});
				
				
				var lProduit = {nproId:lNproId,lots:lLotsAffiche,unite:lUnite};
				lProduit.prixUnitaire = lPremierLot.mLotPrixUnitaire;	
				
				if(lNbLots == 1) {
					lProduit.lotAffiche = lCaisseTemplate.achatMarcheAfficheLot.template({	id:lPremierLot.id,
																						tailleAffiche:lPremierLot.tailleAffiche,
																						unite:lUnite,
																						});
				} else {
					if(that.mLotAchat[lIdProduit]) {
						var lIdLot = 0;
						if(lType == '') {
							lIdLot = that.mLotAchat[lIdProduit].normal;
						} else {
							lIdLot = that.mLotAchat[lIdProduit].solidaire;
						}
						
						$(lProduit.lots).each(function() {
							if(this.id == lIdLot) {
								lProduit.prixUnitaire = this.mLotPrixUnitaire;
								this.selected = "selected=\"selected\"";
							} else {
								this.selected = '';
							}
						});
					}
					
					lProduit.lotAffiche = lCaisseTemplate.achatMarcheSelectLot.template($.extend({type:lType}, lProduit));
				}
				
				
				
				$('#cellule-lot-produit').html(that.affectChangeLot($(lProduit.lotAffiche)));
				
				lProduit.sigleMonetaire = gSigleMonetaire;
				$('#cellule-lot-produit-prix-unitaire').html(lCaisseTemplate.achatMarchePrixUnitaire.template(lProduit));
				$('.ligne-lot-produit').show();
			}
		}).blur(function() { // Masque automatiquement en sortie si il n'y a qu'un lot
			var lNproId = $(this).data('id-nom-produit');
			var lUnite = $(this).data('unite');
			
			var lNbLots = 0;
			for(i in that.mLots[lNproId + lUnite].lots) {
				lNbLots++;
			}
			if(lNbLots == 1) {
				$('.ligne-lot-produit').hide();
			}
		}).keyup(function() {
			var lIdProduit = $(this).data('id-produit');
			var lNproId = $(this).data('id-nom-produit');
			var lUnite = $(this).data('unite');
			var lType = $(this).data('type');
			var lIdLot = 0;
			
			var lNbLots = 0;
			var lIdPremierLot = 0;
			for(i in that.mLots[lNproId + lUnite].lots) {
				if(lIdPremierLot == 0) {
					lIdPremierLot = i;
				}
				lNbLots++;
			}
			
			if(lNbLots == 1) {
				lIdLot = lIdPremierLot;
			} else {
				lIdLot = $('#select-' + lNproId + lType).val();
			}
			
			if(that.mLotAchat[lIdProduit]) {
				if(lType == '') {
					that.mLotAchat[lIdProduit].normal = lIdLot;	
				} else {
					that.mLotAchat[lIdProduit].solidaire = lIdLot;	
				}				
			} else {
				if(lType == '') {
					that.mLotAchat[lIdProduit] = {normal:lIdLot,solidaire:0};
				} else {
					that.mLotAchat[lIdProduit] = {normal:0,solidaire:lIdLot};
				}
			}
		});
				
		return pData;
	};
		
	this.affectCalculPrix = function(pData) {
		var that = this;
		pData.find('.produit-quantite, .produit-quantite-solidaire').keyup(function() {
			that.calculPrix($(this).data('id-produit'), $(this).data('id-nom-produit'), $(this).data('type') ,  $(this).val(), $(this).data('unite'));
		});
		return pData;
	};
	
	this.calculPrix = function(pIdProduit, pIdNomProduit, pType, pQuantite, pUnite) {
		var lLot = {};
		var lPremierLot = {};
		var lIdPremierLot = 0;
		var lNbLots = 0;
		for(i in this.mLots[pIdNomProduit + pUnite].lots) {
			if(lIdPremierLot == 0) {
				lPremierLot = this.mLots[pIdNomProduit + pUnite].lots[i];
			}
			lNbLots++;
		}
		if(lNbLots == 1) {			
			lLot = lPremierLot;
		} else {
			lLot = this.mLots[pIdNomProduit + pUnite].lots[$('#select-' + pIdNomProduit + pType).val()];
		}
		
		pQuantite = parseFloat(pQuantite.numberFrToDb());
		var lPrix = '';
		if(!isNaN(pQuantite)) {
			lPrix =  (parseFloat(pQuantite) * parseFloat( lLot.prix) /  parseFloat(lLot.taille)  ).toFixed(2).nombreFormate(2,',','');
		}
		$('#produits' + pIdProduit + 'montant' + pType  ).val(lPrix);
	};
		
	this.affectChangeLot = function(pData) {
		var that = this;
		pData.find('.select-lot').change(function() {
			var lIdNomProduit = $(this).data('id-nom-produit');
			var lUnite = $(this).data('unite'); 
			var lType = $(this).data('type'); 
			var lIdLot = $(this).val();
			
			// Raz quantité et prix 
			$('#produits' + lType + lIdNomProduit + 'quantite' + ', #produits' + lIdNomProduit + 'montant' + lType ).val('');
			// Maj Prix unitaire
			$('#prix-unitaire-' + lIdNomProduit).text(that.mLots[lIdNomProduit+lUnite].lots[lIdLot].mLotPrixUnitaire);
			
		});
		return pData;
	};
		
	this.affectPositionInfoAdherent = function(pData) {
		var timeout = null;
		var entryShare = pData.find('#info-adherent-widget').first();
		var entryContent = pData.find('.tableau-liste-produit');
				
		$(window).scroll(function () {
			//console.log(entryShare.outerHeight());
			
		  var scrollTop = $(this).scrollTop();
		  if(!timeout) {
			timeout = setTimeout(function() {
			  timeout = null;
			  if (entryShare.css('position') !== 'fixed' && entryShare.offset().top < $(document).scrollTop()) {
				//entryContent.css('margin-top', entryShare.outerHeight() + 10 );
				entryContent.css('margin-top', '200' );
				entryShare.css({'z-index': 999, 'position': 'fixed', 'top': 0, 'width': entryContent.width(), 'box-shadow': '0 0 20px #555'})
							.removeClass('ui-corner-all').addClass('ui-corner-bottom');
			  } else if ($(document).scrollTop() <= entryContent.offset().top) {
				  
				entryContent.css('margin-top', '');
				entryShare.css({ 'position': '', 'z-index': '', 'width': '', 'box-shadow':''})
							.removeClass('ui-corner-bottom').addClass('ui-corner-all');
				
			  }
			}, 100);
		  }
		});
		
		return pData;
	};
	
	this.affectMajSolde = function(pData) {
		var that = this;
		pData.find('.produit-quantite, .produit-quantite-solidaire, .produit-prix, .produit-prix-solidaire, #rechargementmontant').keyup(function() {
			// Maj totaux achats
			var lTotal = (parseFloat(that.majTotal('')) + parseFloat(that.majTotal('-solidaire')) ).toFixed(2);
			$('#total').text(lTotal.nombreFormate(2,',',' '));
			
			var lRechargement = parseFloat($('#rechargementmontant').val().numberFrToDb());
			if(isNaN(lRechargement)) {
				lRechargement = 0;
			}
			
			var lSolde = (parseFloat(that.mSolde) - lTotal + parseFloat(that.mTotalAchatInit) + lRechargement).toFixed(2);
			$('#solde').text(lSolde.nombreFormate(2,',',' '));
			
			if(lSolde <= 0) {
				$("#solde, #solde-sigle").addClass("com-nombre-negatif");		
			} else {
				$("#solde, #solde-sigle").removeClass("com-nombre-negatif");
			}
		});
		return pData;
	};
	
	this.majTotal = function(pType) {
		var lTotal = 0;
		$('.produit-prix' + pType).each(function() {
			var lPrix = parseFloat($(this).val().numberFrToDb());
			if(!isNaN(lPrix)) {
				lTotal = (parseFloat(lTotal) +  lPrix).toFixed(2);
			}
		});
		$('#total-achat' + pType).text(lTotal.nombreFormate(2,',',' '));
		
		return parseFloat(lTotal);
	};
	
	this.affectAfficheFormulaireRechargement = function(pData) {
		var that = this;
		var lCelluleRecharger = pData.find("#cellule-recharger");
		
		pData.find('#rechargementmontant, #rechargementtypePaiement').focus(function() {
			that.mFocusRechargement++;
			if(that.afficheChCpAutorise) {
				$('#select-typePaiement').show();
				lCelluleRecharger.removeClass('ui-corner-all').addClass('ui-corner-top');
			}
		}).blur(function() {
			that.mFocusRechargement--;
			if(that.mFocusRechargement == 0) {
				$('#select-typePaiement').hide();
				lCelluleRecharger.removeClass('ui-corner-top').addClass('ui-corner-all');
			}
		});
		
		pData.find('#ligne-rechargement').hover(function() {
			that.mFocusRechargement++;
			if(that.afficheChCpAutorise) {
				$('#select-typePaiement').show();
				lCelluleRecharger.removeClass('ui-corner-all').addClass('ui-corner-top');
			}
		},function() {
			that.mFocusRechargement--;
			if(that.mFocusRechargement == 0) {
				$('#select-typePaiement').hide();
				lCelluleRecharger.removeClass('ui-corner-top').addClass('ui-corner-all');
			}
		});
		return pData;
	};
	
	this.affectAfficheFormulaireRechargementChampComplementaire = function(pData) {
		var that = this;
		var lCelluleRecharger = $("#cellule-recharger");
		
		pData.find(':input').focus(function() {
			that.mFocusRechargement++;
			if(that.afficheChCpAutorise) {
				$('#select-typePaiement').show();
				lCelluleRecharger.removeClass('ui-corner-all').addClass('ui-corner-top');
			}
		}).blur(function() {
			that.mFocusRechargement--;
			if(that.mFocusRechargement == 0) {
				$('#select-typePaiement').hide();
				lCelluleRecharger.removeClass('ui-corner-top').addClass('ui-corner-all');
			}
		});
		return pData;
	};
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
		});
		
		pData.find(":input[name=typepaiement] option[value='" + that.mTypePaiementSelect + "']").prop("selected", true);
		return pData;
	};
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		if(!this.mTypePaiement[lId] || (this.mTypePaiement[lId] && this.mTypePaiement[lId].champComplementaire.length == 0)) {
			$('.champ-complementaire').remove();
		} else {
			var lCaisseTemplate = new CaisseTemplate();
			var lTypePaiementService = new TypePaiementService();
			$('#ligne-operation').after(this.affectChampComplementaire(lTypePaiementService.affect($(lCaisseTemplate.champComplementaire.template(this.mTypePaiement[lId])), this.mBanques, 'rechargement')));
		}
	};
	
	this.affectChampComplementaire = function(pData) {
		pData = this.affectAfficheFormulaireRechargementChampComplementaire(pData);
		return pData;
	};
		
	this.affectValider = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.recapitulatifAchat();
		});
		return pData;
	};
	
	this.recapitulatifAchat = function() {
		var that = this;		
		var lVo = new AchatVO();
		
		var lProduitDetail = [];
		var lProduitAchete = false;
		var lTotal = 0;
		var lTotalSolidaire = 0;

		// Les Produits
		$('.ligne-produit').each(function() {
			var lIdProduit = $(this).data('id-produit');
			var lNproId = $(this).data('id-nom-produit');
			var lUnite = $(this).data('unite');
			var lIdCategorie = $(this).data('id-categorie');

			var lVoProduit = new ProduitDetailAchatVO();
			lVoProduit.id = lIdProduit;
			lVoProduit.idNomProduit = lNproId;

			lVoProduit.idStock = $(this).data('id-stock');
			lVoProduit.idStockSolidaire = $(this).data('id-stock-solidaire');
			lVoProduit.idDetailOperation = $(this).data('id-detail-operation');
			lVoProduit.idDetailOperationSolidaire = $(this).data('id-detail-operation-solidaire');
		
			if(that.mLotAchat[lIdProduit]) {
				if(that.mLots[lNproId + lUnite].type == 'modele') { // Produit en Stock
					lVoProduit.idModeleLot = that.mLotAchat[lIdProduit].normal;		
					lVoProduit.idModeleLotSolidaire = that.mLotAchat[lIdProduit].solidaire;						
				} else { // Produit du marche
					lVoProduit.idDetailCommande = that.mLotAchat[lIdProduit].normal;
					lVoProduit.idDetailCommandeSolidaire = that.mLotAchat[lIdProduit].solidaire;					
				}
			}

			var lQuantite = parseFloat($('#produits' + lIdProduit + 'quantite' ).val().numberFrToDb());
			if(!isNaN(lQuantite)) {
				lVoProduit.quantite = lQuantite * -1;
			}
					
			var lMontant = parseFloat($('#produits' + lIdProduit + 'montant' ).val().numberFrToDb());
			if(!isNaN(lMontant)) {
				lVoProduit.montant = lMontant * -1;
				lTotal += lMontant * -1;
			}	
			
			lQuantite = parseFloat($('#produits' + lIdProduit + 'quantiteSolidaire' ).val().numberFrToDb());
			if(!isNaN(lQuantite)) {
				lVoProduit.quantiteSolidaire = lQuantite * -1;
			}
					
			lMontant = parseFloat($('#produits' + lIdProduit + 'montantSolidaire' ).val().numberFrToDb());
			if(!isNaN(lMontant)) {
				lVoProduit.montantSolidaire = lMontant * -1;
				lTotalSolidaire += lMontant * -1;
			}
			
			if(lVoProduit.quantite != '' || lVoProduit.montant != '' || lVoProduit.quantiteSolidaire != '' || lVoProduit.montantSolidaire != '') {				
				lVo.produits.push(lVoProduit);
				lProduitAchete = true;
				
				if(!lProduitDetail[lIdCategorie]) {
					lProduitDetail[lIdCategorie] = {cproNom:that.mNomCategorie[lIdCategorie].cproNom,produits:[]};
				}
				
				lProduitDetail[lIdCategorie].produits[lNproId] = {
						nom:that.mLots[lNproId + lUnite].nom,
						quantite:'',montant:'',quantiteSolidaire:'',montantSolidaire:'',
						unite:'',uniteSolidaire:'',sigleMonetaire:'',sigleMonetaireSolidaire:''};
				if(lVoProduit.quantite != '') {
					lProduitDetail[lIdCategorie].produits[lNproId].quantite = (lVoProduit.quantite * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].unite = lUnite;
					lProduitDetail[lIdCategorie].produits[lNproId].montant = (lVoProduit.montant * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].sigleMonetaire = gSigleMonetaire;
				}
				if(lVoProduit.quantiteSolidaire != '') {
					lProduitDetail[lIdCategorie].produits[lNproId].quantiteSolidaire = (lVoProduit.quantiteSolidaire * -1).nombreFormate(2,',',' ');
					lProduitDetail[lIdCategorie].produits[lNproId].uniteSolidaire = lUnite;
					lProduitDetail[lIdCategorie].produits[lNproId].montantSolidaire = (lVoProduit.montantSolidaire * -1).nombreFormate(2,',',' ');	
					lProduitDetail[lIdCategorie].produits[lNproId].sigleMonetaireSolidaire = gSigleMonetaire;
				}
			}
			
		});
		
		if(this.mAchatInitial != null) {
			if(this.mAchatInitial.operationAchat != null) {
				lVo.operationAchat = this.mAchatInitial.operationAchat;
			}
			if(this.mAchatInitial.operationAchatSolidaire != null) {
				lVo.operationAchatSolidaire = this.mAchatInitial.operationAchatSolidaire;
			}
			if(this.mAchatInitial.rechargement != null) {
				lVo.rechargement  = this.mAchatInitial.rechargement;
			}
		}
		
		if(lTotal < 0) {
			if(lVo.operationAchat == '') {
				var lOperationAchat = new OperationDetailVO();
				lOperationAchat.montant = lTotal;
				lOperationAchat.typePaiement = 7;
				lOperationAchat.idCompte = this.mIdCompte;
				
				// Mode Marché
				if(this.mParam.id_commande > 0) {
					var lChampComplementaire = new ChampComplementaireVO();
					lChampComplementaire.id = 1;
					lChampComplementaire.obligatoire = 0;
					lChampComplementaire.valeur = this.mParam.id_commande;
					lOperationAchat.champComplementaire[1] = lChampComplementaire;
				}
				
				var lChampComplementaire = new ChampComplementaireVO();
				lChampComplementaire.id = 15;
				lChampComplementaire.obligatoire = 1;
				lChampComplementaire.valeur = this.mIdRequete;
				lOperationAchat.champComplementaire[15] = lChampComplementaire;
				
				lVo.operationAchat = lOperationAchat;
			} else {
				lVo.operationAchat.montant = lTotal;
			}
		}
		
		if(lTotalSolidaire < 0) {
			if(lVo.operationAchatSolidaire == '') {
				var lOperationAchat = new OperationDetailVO();
				lOperationAchat.montant = lTotalSolidaire;
				lOperationAchat.typePaiement = 8;
				lOperationAchat.idCompte = this.mIdCompte;
				
				// Mode Marché
				if(this.mParam.id_commande > 0) {
					var lChampComplementaire = new ChampComplementaireVO();
					lChampComplementaire.id = 1;
					lChampComplementaire.obligatoire = 0;
					lChampComplementaire.valeur = this.mParam.id_commande;
					lOperationAchat.champComplementaire[1] = lChampComplementaire;
				}
				
				var lChampComplementaire = new ChampComplementaireVO();
				lChampComplementaire.id = 15;
				lChampComplementaire.obligatoire = 1;
				lChampComplementaire.valeur = this.mIdRequete;
				lOperationAchat.champComplementaire[15] = lChampComplementaire;
				
				lVo.operationAchatSolidaire = lOperationAchat;
			} else {
				lVo.operationAchatSolidaire.montant = lTotalSolidaire;
			}
		}
		
			
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		var lMontantAffiche = 0; 
		var lTypePaiementAffiche = '';

		if(lMontant == '') {
			lMontant = 0;
		}		
		if(!isNaN(lMontant) ){
			lMontant = parseFloat(lMontant);
			lMontantAffiche = lMontant;
		}
		lMontantAffiche = lMontantAffiche.nombreFormate(2,',',' ');
		
		if(lMontant > 0) {
			var lTypePaiement = $(":input[name=typepaiement]").val();
			if(lTypePaiement != 0) {
				lTypePaiementAffiche = $(":input[name=typepaiement]").selectedTexts();
			}
	
			var lTabChampComplementaire = [];
			if(this.mTypePaiement[lTypePaiement]) {
				var lTypePaiementService = new TypePaiementService();
				lTabChampComplementaire = lTypePaiementService.getChampComplementaire(this.mTypePaiement[lTypePaiement].champComplementaire, 'rechargement');
	
				// Mode Marché
				if(this.mParam.id_commande > 0) {
					var lChampComplementaire = new ChampComplementaireVO();
					lChampComplementaire.id = 1;
					lChampComplementaire.obligatoire = 0;
					lChampComplementaire.valeur = this.mParam.id_commande;
					lTabChampComplementaire[1] = lChampComplementaire;
				}
				
				var lChampComplementaire = new ChampComplementaireVO();
				lChampComplementaire.id = 15;
				lChampComplementaire.obligatoire = 1;
				lChampComplementaire.valeur = this.mIdRequete;
				lTabChampComplementaire[15] = lChampComplementaire;
			}
			
			if(lVo.rechargement == '') {
				lVo.rechargement = new OperationDetailVO();	
				lVo.rechargement.idCompte = this.mIdCompte;
			}
			lVo.rechargement.typePaiement = lTypePaiement;
			lVo.rechargement.champComplementaire = lTabChampComplementaire;
			lVo.rechargement.montant = lMontant;
		} else if(lMontant == 0 && lVo.rechargement != '') { // Suppression du rechargement
			lVo.rechargement.montant = 0;
		}
				
		var lValid = new AchatValid();
		var lVr = lValid.validAjout(lVo);
		
		// Arrêt de la recherche
		$('#input-rechercher').val('');
		that.recherche('');
		
		if(this.mParam.vr && this.mParam.vr != null) {
			this.mParam.vr = null;
		} else {
			Infobulle.init(); // Supprime les erreurs
		}
		if(lVr.valid) {
			// Génération de l'affichage
			// Tri des catégories
			lProduitDetail.sort(function(a,b) {return a.cproNom.localeCompare(b.cproNom);});
			// Tri des produits
			$.each(lProduitDetail,function() {
				if(this.cproNom) {
					this.produits.sort(function(a,b) {return a.nom.localeCompare(b.nom);});
				}
			});
			
			// Les Produits
			var lCaisseTemplate = new CaisseTemplate();
			if(lProduitAchete) { // Affiche le detail uniquement si il y a des produits
				$('#formulaire-produit').hide().before(lCaisseTemplate.achatHorsMarcheDetailAchat.template({categories:lProduitDetail}));
			} else {
				$('#formulaire-produit').hide();
			}
			$('.ligne-lot-produit').hide();
			
			// Le rechargement
			//$('#select-typePaiement').hide(); // Masque le formulaire
			
			$('#rechargement-affiche').text(lMontantAffiche); // Le Montant
			
			//$('#rechargement-select-affiche').text(lTypePaiementAffiche);
			if(lVo.rechargement == '' || (lVo.rechargement != '' && lVo.rechargement.montant <= 0)) {
				this.afficheChCpAutorise = false;
			}
			
			var lData = {typePaiementAffiche:lTypePaiementAffiche};
			
			var lTypePaiementService = new TypePaiementService();
			var lChampComplementaire = [];
			if(this.mTypePaiement[lVo.rechargement.typePaiement]) {
				$(this.mTypePaiement[lVo.rechargement.typePaiement].champComplementaire).each(function() {				
					var lChamp = $.extend(true,{},lVo.rechargement.champComplementaire[this.id]);
					lChamp.id = this.id;
					lChamp.tppCpVisible = 1;
					lChamp.chCpLabel = this.label;
					lChampComplementaire.push(lChamp);
				});
			}

			lData.champComplementaireAffiche = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, this.mBanques, true);

			$('#form-select-typePaiement').hide().after(lCaisseTemplate.champComplementaireAffiche.template(lData));
			
			// Masque les input pour passer en affichage et change les boutons
			$('.form-produit, #btn-valider, #btn-modifier, #recherche-produit').toggle(); 

			if(this.mModeEdition == 1) {
				this.mModeEdition = 0;
				if(this.mModule == 'GestionCommande') {
					$('#btn-supprimer').show();
				}
			} else {
				$('#btn-enregistrer').show();
			}
			
			this.mAchat = lVo;
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.qteEtPrixAchat = function(pIdNomProduit, pType, pVoProduit) {		
		var lQuantite = parseFloat($('#produits' + pIdNomProduit + 'quantite' + pType ).val().numberFrToDb());
		if(!isNaN(lQuantite)) {
			pVoProduit.quantite = lQuantite * -1;
		}
				
		var lPrix = parseFloat($('#produits' + pIdNomProduit + 'montant'  + pType ).val().numberFrToDb());
		if(!isNaN(lPrix)) {
			pVoProduit.prix = lPrix * -1;
		}		
		return pVoProduit;
	};
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.modifier();
		});
		return pData;
	};
	
	this.modifier = function() {
		$('#btn-enregistrer, #btn-supprimer').hide();
		$('.form-produit, #btn-valider, #btn-modifier, #recherche-produit').toggle(); 
		$('#formulaire-produit, #form-select-typePaiement').show();
		$('#formulaire-produit-detail, #affiche-select-typePaiement').remove();
		
		this.afficheChCpAutorise = true;
	};
	
	this.affectRetour = function(pData) {
		var that = this;
		pData.find('#lien-retour').click(function() {
			if(that.mModule == 'Caisse') {
				CaisseMarcheCommandeVue({"id_commande":that.mParam.id_commande});
			} else if(that.mParam.retour) {
				if(that.mParam.retour == 'Achat') {
					AchatVue({idMarche:that.mParam.id_commande});
				} else if(that.mParam.retour == 'AchatMarche') {
					ListeAchatMarcheVue({id_marche:that.mParam.id_commande});
				}
			}
		});
		return pData;
	};
	
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find('#btn-enregistrer').click(function() {
			that.enregistrerAchat();
		});
		return pData;
	};
	
	this.enregistrerAchat = function() {
		var that = this;
		var lVo = this.mAchat;
		lVo.fonction = "acheter";
		//lVo.idAchat = this.mIdAchat;
		
		$.post(	"./index.php?m=" + this.mModule + "&v=CaisseMarcheCommande","pParam=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour) {
						if(lVoRetour.valid) {
							var lCaisseTemplate = new CaisseTemplate();
							if(that.mModule == 'Caisse') {
								$('#contenu').replaceWith(that.affectRetour($(lCaisseTemplate.achatCommandeSucces)));
							} else if(that.mParam.retour) {
								that.mParam.id = lVoRetour.idAchat;
								that.mParam.vr = new TemplateVR(false, new VRelement(false, [new VRerreur(ERR_314_CODE, ERR_314_MSG)]));
								CaisseVue(that.mParam);
							}
						} else {
							that.modifier();
							Infobulle.generer(lVoRetour,"");
						}
					}
				},"json"
			);
	};	
	
	this.affectSupprimer = function(pData) {
		var that = this;
		pData.find('#btn-supprimer').click(function() {
			var lCaisseTemplate = new CaisseTemplate();
			$(lCaisseTemplate.dialogSuppressionAchat).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lDialog = $(this);
						var lVo = {id:that.mParam.id , fonction:"supprimer"};	
						$.post(	"./index.php?m=GestionCommande&v=CaisseMarcheCommande","pParam=" + $.toJSON(lVo),
							function(lVoRetour) {
								if(lVoRetour) {
									if(lVoRetour.valid) {
										var lVr = new TemplateVR(false, new VRelement(false, [new VRerreur(ERR_315_CODE, ERR_315_MSG)]));
										if(that.mParam.retour == 'Achat') {
											AchatVue({idMarche:that.mParam.id_commande, vr:lVr});
										} else if(that.mParam.retour == 'AchatMarche') {
											ListeAchatMarcheVue({id_marche:that.mParam.id_commande, vr:lVr});
										}
										lDialog.dialog('close');
									} else {
										Infobulle.generer(lVoRetour,"");
									}
								}
							},"json"
						);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
						
			});
		});
		return pData;		
	};
	
	this.construct(pParam);
}