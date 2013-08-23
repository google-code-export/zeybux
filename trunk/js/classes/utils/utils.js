/*
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
	var newInstance = srcInstance.constructor();
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

