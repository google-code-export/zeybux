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
}String.prototype.checkLength = function(min,max) {
	return !(this.toString().length > max || this.toString().length < min);
}

Number.prototype.checkLength = function(min,max) {
	return !(this.toString().length > max || this.toString().length < min);
}

String.prototype.isEmpty = function() {
	return !(this.toString().length > 0);
}

Number.prototype.isEmpty = function() {
	return !(this.toString().length > 0);
}

String.prototype.isInt = function() {
	return !isNaN(parseInt(this.toString()));
}

Number.prototype.isInt = function() {
	return !isNaN(parseInt(this.toString()));
}

String.prototype.isFloat = function() {
	return !isNaN(parseFloat(this.toString()));
}

Number.prototype.isFloat = function() {
	return !isNaN(parseFloat(this.toString()));
}

function isArray(pObj) {
	if(pObj) {
		return pObj.constructor == Array;
	}
	return false;
}

String.prototype.checkRegexp = function(regexp) {
	var r = new RegExp(regexp);
	return r.test(this.toString());
}

String.prototype.checkCourriel = function() {
	var regexp =  /^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/g;
	return this.toString().checkRegexp(regexp);
}

String.prototype.checkTime = function() {
	var regexp =  /^[0-9]{2}[:]{1}[0-9]{2}[:]{1}[0-9]{2}$/g;
	return this.toString().checkRegexp(regexp);
}

String.prototype.checkTimeExist = function() {
	var lTime = this.toString().split(':');
	if(lTime.length == 3) {
		return parseInt(lTime[0]) >= 0 && parseInt(lTime[0]) < 24 && parseInt(lTime[1]) >= 0 && parseInt(lTime[1]) < 60 && parseInt(lTime[2]) >= 0 && parseInt(lTime[2]) < 60;
	}
	return false;
}

String.prototype.checkDate = function(type) {
	if(type === "")	type = 'db';
	if(type == 'db') {
		var regexp =  /^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$/g;
	} else if(type == 'fr') {
		var regexp =  /^[0-9]{2}[/]{1}[0-9]{2}[/]{1}[0-9]{4}$/g;
	} else return false;	
	return this.toString().checkRegexp(regexp);
}

String.prototype.checkDateExist = function(type) {
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

String.prototype.checkDateTime = function() {
	var lDateTime = this.toString().split(' ');
	if(lDateTime.length == 2) {
		return (lDateTime[0].checkDate('db') && lDateTime[1].checkTime() );
	}
	return false;
}

String.prototype.checkDateTimeExist = function() {
	var lDateTime = this.toString().split(' ');
	if(lDateTime.length == 2) {
		return (lDateTime[0].checkDateExist('db') && lDateTime[1].checkTimeExist() );
	}
	return false;	
}

function dateTimeEstPLusGrandeEgale(pDateGrande,pDatePetite,pType) {
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

function dateEstPLusGrandeEgale(pDateGrande,pDatePetite,pType) {
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

function timeEstPLusGrandeEgale(pTimeGrande,pTimePetite) {
	if(pTimeGrande.checkTime() && pTimePetite.checkTime() && pTimeGrande.checkTimeExist() && pTimePetite.checkTimeExist()) {
		var lTimeGrande = pTimeGrande.replace(':','');
		var lTimePetite = pTimePetite.replace(':','');
		return lTimeGrande >= lTimePetite;	
	}
	return false;
}//Erreurs techniques
const ERR_101_CODE = 101;
const ERR_101_MSG = 'La valeur entrée est trop longue.';
const ERR_102_CODE = 102;
const ERR_102_MSG = 'Le format du courriel n\'est pas valide.';
const ERR_103_CODE = 103;
const ERR_103_MSG = 'Le format de la date n\'est pas valide.';
const ERR_104_CODE = 104;
const ERR_104_MSG = 'L\identifiant de l\'objet n\'est pas valide.';
const ERR_105_CODE = 105;
const ERR_105_MSG = 'La date saisie n\'existe pas.';
const ERR_106_CODE = 106;
const ERR_106_MSG = 'Le format de l\'heure n\'est pas valide.';
const ERR_107_CODE = 107;
const ERR_107_MSG = 'L\'heure saisie n\'existe pas.';
const ERR_108_CODE = 108;
const ERR_108_MSG = 'Ce champ doit être de type entier.';
const ERR_109_CODE = 109;
const ERR_109_MSG = 'Ce champ doit être de type float.';
const ERR_110_CODE = 110;
const ERR_110_MSG = 'Le champ "Lots" doit être de type tableau.';
const ERR_111_CODE = 111;
const ERR_111_MSG = 'Le champ "Produits" doit être de type tableau.';
const ERR_112_CODE = 112;
const ERR_112_MSG = 'Des éléments de la commande sont encore en édition.';
const ERR_113_CODE = 113;
const ERR_113_MSG = 'Problème technique lors de l\'enregistrement.';
const ERR_114_CODE = 114;
const ERR_114_MSG = 'Plusieures lignes dans la base au lieu d\'une attendue.';
const ERR_115_CODE = 115;
const ERR_115_MSG = 'Le champ doit être de type tableau.';
const ERR_116_CODE = 116;
const ERR_116_MSG = 'Session expirée. Veuillez vous reconnecter.';

//Erreurs fonctionelles
const ERR_201_CODE = 201;
const ERR_201_MSG = 'Ce champ est obligatoire.';
const ERR_202_CODE = 202;
const ERR_202_MSG = 'La date de fin des commandes doit être avant celle du marché.';
const ERR_203_CODE = 203;
const ERR_203_MSG = 'L\'heure de fin des commandes doit être avant celle du marché.';
const ERR_204_CODE = 204;
const ERR_204_MSG = 'L\'heure de fin du marché doit être après celle du début.';
const ERR_205_CODE = 205;
const ERR_205_MSG = 'La quantité max par adhérent doit être plus petite que le stock.';
const ERR_206_CODE = 206;
const ERR_206_MSG = 'La taille du lot doit être plus petite que quantité max par adhérent.';
const ERR_207_CODE = 207;
const ERR_207_MSG = 'La commande doit comporter au moins un produit.';
const ERR_208_CODE = 208;
const ERR_208_MSG = 'La date de fin du marché doit être après celle du début.';
const ERR_209_CODE = 209;
const ERR_209_MSG = 'La date ne doit pas être passée.';
const ERR_210_CODE = 210;
const ERR_210_MSG = 'Un produit demandé n\'existe pas dans le système.';
const ERR_211_CODE = 211;
const ERR_211_MSG = 'Ce produit est déjà présent dans la commande.';
const ERR_212_CODE = 212;
const ERR_212_MSG = 'Aucune réservation pour cette commande.';
const ERR_213_CODE = 213;
const ERR_213_MSG = 'Il faut entrer un prix pour ce produit.';
const ERR_214_CODE = 214;
const ERR_214_MSG = 'Il faut entrer une quantité pour ce produit.';
const ERR_215_CODE = 215;
const ERR_215_MSG = 'Ce champ doit être positif.';
const ERR_216_CODE = 216;
const ERR_216_MSG = 'Aucune donnée pour l\'id donné.';
const ERR_217_CODE = 217;
const ERR_217_MSG = 'Quantité commandée supérieure à la quantité maximale autorisée.';
const ERR_218_CODE = 218;
const ERR_218_MSG = 'Quantité commandée supérieure à la quantité restant en stock.';
const ERR_219_CODE = 219;
const ERR_219_MSG = 'Pas de nouvelle commande.';
const ERR_220_CODE = 220;
const ERR_220_MSG = 'Vous avez déjà une réservation pour cette commande.';
const ERR_221_CODE = 221;
const ERR_221_MSG = 'Les réservations sont cloturées pour cette commande.';
const ERR_222_CODE = 222;
const ERR_222_MSG = 'Erreur d\'identification.';
const ERR_223_CODE = 223;
const ERR_223_MSG = 'Les mots de passe doivent être identique.';
const ERR_224_CODE = 224;
const ERR_224_MSG = 'Ce champ doit être au format courriel.';
const ERR_225_CODE = 225;
const ERR_225_MSG = 'La date d\'anniversaire ne peut pas être après celle d\'adhésion.';
const ERR_226_CODE = 226;
const ERR_226_MSG = 'L\'adhérent doit pouvoir accéder à un module au minimum.';
const ERR_227_CODE = 227;
const ERR_227_MSG = 'Aucun numéro de compte ne correspond à celui saisit.';
const ERR_228_CODE = 228;
const ERR_228_MSG = 'Erreur dans la base sur le numéro de compte.';
const ERR_229_CODE = 229;
const ERR_229_MSG = 'Un des modules n\'existe pas.';
const ERR_230_CODE = 230;
const ERR_230_MSG = 'La date ne peut pas être future.';
const ERR_231_CODE = 231;
const ERR_231_MSG = 'Impossible de supprimer cet adhérent.';/*
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
    }
    
/*
 * Plugin jquery d'édition de formulaire
 * Cache le formulaire pour afficher sa valeur dans une span
 */
    $.fn.inputToText = function(pType) {
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
    }
    
/*
 * Plugin jquery d'édition de formulaire
 * Cache la span suivante de l'input pour afficher l'input
 */    
    $.fn.textToInput = function() {
    	this.show();
    	this.next().hide();
		return this;
    }    
})(jQuery);

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
}

function getTimeAujourdhuiDb() {
	lDate = new Date();	
	lHeure = lDate.getHours();
	if (lHeure < 10) {lHeure = '0' + lHeure;}
	lMinute = lDate.getMinutes();
	if (lMinute < 10) {lMinute = '0' + lMinute;}
	lSeconde = lDate.getSeconds();
	if (lSeconde < 10) {lSeconde = '0' + lSeconde;}	
	return lHeure + ':' + lMinute + ':' + lSeconde;
}

function getDateTimeAujourdhuiDb() {
	return getDateAujourdhuiDb() + ' ' + getTimeAujourdhuiDb();
}

String.prototype.nombreFormate = function(decimales, signe, separateurMilliers) {
	return parseFloat(this).nombreFormate(decimales, signe, separateurMilliers);
}

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
			 sNombre = "0"+sNombre;
		 }
		
		 for (i = 0; i < sNombre.length; i += 3) {
			 if (i == sNombre.length-1) separateurMilliers = '';
			 sRetour += sNombre.substr(i, 3)+separateurMilliers;
		 }
		 
		 while (sRetour.substr(0, 1) == "0") {
			 sRetour = sRetour.substr(1);
		 }
		 // Pour le cas où l'on affiche 0
		 if(sRetour == " ") {
			 sRetour = "0 ";
		 }
		 return sRetour.substr(0, sRetour.lastIndexOf(separateurMilliers));
	 }
	 
	 if (_sNombre.indexOf('.') == -1) {
		 for (i = 0; i < decimales; i++) {
			 _sDecimales += "0";
		 }
		 _sRetour = separeMilliers(_sNombre)+signe+_sDecimales;
	 } else {
		 var sDecimalesTmp = (_sNombre.substr(_sNombre.indexOf('.')+1));
		 
		 if (sDecimalesTmp.length > decimales) {
			 var nDecimalesManquantes = sDecimalesTmp.length - decimales;
			 var nDiv = 1;
			 for (i = 0; i < nDecimalesManquantes; i++) {
				 nDiv *= 10;
			 }
			 _sDecimales = Math.round(Number(sDecimalesTmp) / nDiv);
		} else if (sDecimalesTmp.length < decimales) {
			 var nDecimalesManquantes = decimales - sDecimalesTmp.length;
			 var sNvDecimale = '';
			 for (i = 0; i < nDecimalesManquantes; i++) {
				 sNvDecimale += '0';
			 }
			 _sDecimales = sDecimalesTmp + sNvDecimale;
		}	 
		else {
			_sDecimales = sDecimalesTmp;
		}
		 
		 _sRetour = separeMilliers(_sNombre.substr(0, _sNombre.indexOf('.')))+String(signe)+_sDecimales;
	 }
	 return _sRetour;
}
    
    
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
} 




function Infobulles() {
	this.init = function() {
		$(".com-infobulle").remove();
		$(".ui-state-error").removeClass("ui-state-error");
		$("#contenu_message_information").text("")
		$("#widget_message_information").hide();
	}
	
	this.generation = function(pData,pNomObj) {		
		var lData = new Array();
		lData['membres'] = new Array();		
		if(!pData.valid) {
			for( i in pData) {
				if(i != 'valid') {
					
					if(pData[i].valid === false && pData[i].erreurs) {						
						var membre = new Array();
						membre['nom'] = pNomObj + i;
						
						membre['erreurs'] = new Array();
						for(err in pData[i].erreurs) {							
							var e = new Array();
							e['code'] =  pData[i].erreurs[err].code;
							//e['code'] =  pNomObj + i;
							e['message'] = pData[i].erreurs[err].message;							
							membre['erreurs'].push(e);
						}
						
						if(i == 'log' || $("#" + pNomObj + i ).length == 0) {
							var lDataTemp = new Array();
							lDataTemp['membres'] = new Array();	
							lDataTemp['membres'].push(membre);
							$("#contenu_message_information").html($("#contenu_message_information").html() + TemplateData.infobulleLog.template(membre));
							$("#widget_message_information").delay(gTempsTransition).fadeIn(gTempsTransitionUnique);
						} else {						
							lData['membres'].push(membre);
							$("#" + pNomObj + i ).addClass('ui-state-error');
							Infobulle.afficher($("#" + pNomObj + i ));	
						}
					} else if (!(pData[i].valid === true) || (pData[i].valid === false && !pData[i].erreurs)) {
						this.generation(pData[i],pNomObj+i);
					}
				}
			}
		}	
		$('body').append(TemplateData.infobulle.template(lData));
	}
	
	this.generer = function(pData,pNomObj) {
		this.init();
		if(!pNomObj) {lNomObj = '';} else {lNomObj = pNomObj;}
		this.generation(pData,lNomObj);
	}
	
	this.afficher = function(pInput) {
		var infobulle;				
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
						
			infobulle.css('position', 'absolute').css('z-index', '2000');
			infobulle.css(nPos).fadeIn(gTempsTransitionUnique);	
		}
		function disparition() { //infobulle.fadeOut(gTempsTransitionUnique);
			infobulle.stop().fadeTo(0,1).fadeOut(gTempsTransitionUnique);
		}
		
		pInput.hover( function() {apparition();}, function() {disparition();});
	}	
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
};function IdentificationVO() {
	this.id = '';
	this.login = '';
	this.pass = '';
}
function NomProduitVO() {
	this.id = '';
	this.nom = '';
	this.description = '';
	this.idCategorie = '';
}
function CommandeCompleteVO() {
	this.id = '';
	this.numero = '';
	this.nom = '';
	this.description = '';
	this.dateMarcheDebut = '';
	this.timeMarcheDebut = '';
	this.dateMarcheFin = '';
	this.timeMarcheFin = '';
	this.dateFinReservation = '';
	this.timeFinReservation = '';
	this.archive = '';
	this.produits = new Array();
}
function RechargementCompteVO() {
	this.id = '';
	this.montant = '';
	this.typePaiement = '';
	this.champComplementaireObligatoire = '';
	this.champComplementaire = '';
}
function ProduitCommandeVO() {
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
	this.lots = new Array();
}
function ListeReservationCommandeVO() {
	this.id = '';
	this.commandes = new Array();
}
function ReservationCommandeVO() {
	this.id = '';
	this.stoQuantite = '';
	this.stoIdDetailCommande = '';
}
function DetailCommandeVO() {
	this.id = '';
	this.idProduit = '';
	this.taille = '';
	this.prix = '';
}
function AchatCommandeVO() {
	this.id = '';
	this.idCompte = '';
	this.produits = new Array();
	this.rechargement = '';
}
function AdherentVO() {
	this.id = '';
	this.motPasse = '';
	this.motPasseConfirm = '';
	this.numero = '';
	this.compte = '';
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
function ProduitAchatVO() {
	this.id = '';
	this.quantite = '';
	this.prix = '';
}
function DetailCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idProduit = new VRelement();
	this.taille = new VRelement();
	this.prix = new VRelement();
}
function IdentificationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.login = new VRelement();
	this.pass = new VRelement();
}
function ListeReservationCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.commandes = new Array();
}
function NomProduitVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.nom = new VRelement();
	this.description = new VRelement();
	this.idCategorie = new VRelement();
}
function ProduitCommandeVR() {
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
	this.lots = new Array();
}function ReservationCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.stoQuantite = new VRelement();
	this.stoIdDetailCommande = new VRelement();
}
function AdherentVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.motPasse = new VRelement();
	this.motPasseConfirm = new VRelement();
	this.numero = new VRelement();
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
function RechargementCompteVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.montant = new VRelement();
	this.typePaiement = new VRelement();
	this.champComplementaireObligatoire = new VRelement();
	this.champComplementaire = new VRelement();
}
function VRelement() {
	this.valid = true;
	this.erreurs = new Array();
}
function VRerreur() {
	this.code = '';
	this.message = '';
}function TemplateVR() {
	this.valid = true;
	this.log = new VRelement();
}function CommandeCompleteVR() {
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
	this.dateFinReservation = new VRelement();
	this.timeFinReservation = new VRelement();
	this.archive = new VRelement();
	this.produits = new Array();
}
function ProduitAchatVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.quantite = new VRelement();
	this.prix = new VRelement();
}
function AchatCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idCompte = new VRelement();
	this.produits = new Array();
	this.rechargement = new VRelement();
}
function AjoutCommandeControleur() {
	this.valid = function(pVo) {
		var lValid = new CommandeCompleteValid();
		return lValid.validAjout(pVo);
	}
	
	this.validAjoutProduit = function(pVo) {
		var lValid = new ProduitCommandeValid();
		return lValid.validAjout(pVo);
	}
	
	this.validAjoutProduitSimple = function(pVo) {
		var lValid = new ProduitCommandeValid();
		return lValid.validAjout(pVo,'simple');
	}
	
	this.validAjoutLot = function(pVo) {
		var lValid = new DetailCommandeValid();
		return lValid.validAjout(pVo);
	}	
}function ListeReservationCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ListeReservationCommandeVR();
		//Tests Techniques

		//Tests Fonctionnels
		if(isArray(pData.commandes)) {			
			if(pData.commandes.length > 0) {
				$(pData.commandes).each(function() {
					var lValid = new ReservationCommandeValid();
					var lVrReservation = lValid.validAjout(this);
					if(!lVrReservation.valid){lVR.valid = false;}
					lVR.commandes.push(lVrReservation);
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

	this.validDelete = function(pData) {
		var lVR = new ListeReservationCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ListeReservationCommandeVR();
			//Tests Techniques

			//Tests Fonctionnels
			if(isArray(pData.commandes)) {			
				if(pData.commandes.length > 0) {
					$(pData.commandes).each(function() {
						var lValid = new ReservationCommandeValid();
						var lVrReservation = lValid.validAjout(this);
						if(!lVrReservation.valid){lVR.valid = false;}
						lVR.commandes.push(lVrReservation);
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
	}

}function ProduitAchatValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitAchatVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix != '' && !pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

		//Tests Fonctionnels
		if((isNaN(pData.quantite) || pData.quantite == 0) && (!isNaN(pData.prix) && pData.prix != 0)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_214_CODE;erreur.message = ERR_214_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite < 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		
		if((isNaN(pData.prix) || pData.prix == 0) && (!isNaN(pData.quantite) && pData.quantite != 0)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_213_CODE;erreur.message = ERR_213_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix < 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ProduitAchatVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitAchatVR();
			//Tests Techniques
			if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
			if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
			if(pData.quantite != '' && !pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
			if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
			if(pData.prix != '' && !pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

			//Tests Fonctionnels
			if((isNaN(pData.quantite) || pData.quantite == 0) && (!isNaN(pData.prix) && pData.prix != 0)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_214_CODE;erreur.message = ERR_214_MSG;lVR.quantite.erreurs.push(erreur);}
			if(pData.quantite < 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
			
			if((isNaN(pData.prix) || pData.prix == 0) && (!isNaN(pData.quantite) && pData.quantite != 0)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_213_CODE;erreur.message = ERR_213_MSG;lVR.prix.erreurs.push(erreur);}
			if(pData.prix < 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

}function AchatCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new AchatCommandeVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.idCompte.checkLength(0,11)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.idCompte.isInt()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.log.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.idCompte.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		
		if(isArray(pData.produits)) {		
			if(pData.produits.length > 0) {
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
				if(lNbProduit == 0) {
					lVR.valid = false;
					lVR.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_207_CODE;
					erreur.message = ERR_207_MSG;
					lVR.log.erreurs.push(erreur);					
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
		//alert(pData.rechargement.montant);
		if(!pData.rechargement.montant.isEmpty() && pData.rechargement.montant != 0) {
			var lValidRechargement = new RechargementCompteValid();
			lVR.rechargement = lValidRechargement.validAjout(pData.rechargement);
			if(!lVR.rechargement.valid){lVR.valid = false;}
		}		
		
		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new AchatCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

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
				var lValidRechargement = new RechargementCompteValid();
				lVR.rechargement = lValidRechargement.validAjout(pData.rechargement);
				if(!lVR.rechargement.valid){lVR.valid = false;}
			}
			return lVR;
		}
		return lTestId;
	}

}function DetailCommandeValid() { 
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

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new DetailCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

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

			return lVR;
		}
		return lTestId;
	}

}function AdherentValid() { 
	this.validAjout = function(pData) { 
		var lVR = new AdherentVR();
		//Tests Techniques
		if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
		if(!pData.numero.checkLength(0,5)) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.numero.erreurs.push(erreur);}
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
		if(pData.motPasse.isEmpty()) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasse.erreurs.push(erreur);}
		if(pData.motPasseConfirm.isEmpty()) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}
		if(pData.dateAdhesion.isEmpty()) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateAdhesion.erreurs.push(erreur);}

		// Les mots de passe ne sont pas identique
		if(pData.motPasse !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasse.erreurs.push(erreur);}
		
		// Les mails sont au bon format
		if(pData.courrielPrincipal != '' && !pData.courrielPrincipal.checkCourriel()) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
		if(pData.courrielSecondaire != '' && !pData.courrielSecondaire.checkCourriel()) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
		
		// Date Naissance <= Date Adhésion <= Date Actuelle
		var lAujourdhui = getDateAujourdhuiDb();		
		if(!dateEstPLusGrandeEgale(lAujourdhui,pData.dateAdhesion,'db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(pData.dateAdhesion,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_225_CODE;erreur.message = ERR_225_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}
	
		if(isArray(pData.modules)) {
			if(pData.modules.length <= 0) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_226_CODE;erreur.message = ERR_226_MSG;lVR.log.erreurs.push(erreur);}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new AdherentVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new AdherentVR();
			//Tests Techniques
			if(!pData.motPasse.checkLength(0,100)) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasse.erreurs.push(erreur);}
			if(!pData.motPasseConfirm.checkLength(0,100)) {lVR.valid = false;lVR.motPasseConfirm.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.motPasseConfirm.erreurs.push(erreur);}
			if(!pData.numero.checkLength(0,5)) {lVR.valid = false;lVR.numero.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.numero.erreurs.push(erreur);}
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
			if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
			if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}
			if(pData.dateAdhesion.isEmpty()) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
			if(pData.compte.isEmpty()) {lVR.valid = false;lVR.compte.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.compte.erreurs.push(erreur);}
			
			// Les mots de passe ne sont pas identique si ils sont transmit
			if((pData.motPasse != '' || pData.motPasseConfirm != '') && pData.motPasse !== pData.motPasseConfirm) {lVR.valid = false;lVR.motPasse.valid = false;var erreur = new VRerreur();erreur.code = ERR_223_CODE;erreur.message = ERR_223_MSG;lVR.motPasse.erreurs.push(erreur);}
			
			// Les mails sont au bon format
			if(pData.courrielPrincipal != '' && !pData.courrielPrincipal.checkCourriel()) {lVR.valid = false;lVR.courrielPrincipal.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielPrincipal.erreurs.push(erreur);}
			if(pData.courrielSecondaire != '' && !pData.courrielSecondaire.checkCourriel()) {lVR.valid = false;lVR.courrielSecondaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_224_CODE;erreur.message = ERR_224_MSG;lVR.courrielSecondaire.erreurs.push(erreur);}
			
			// Date Naissance <= Date Adhésion <= Date Actuelle
			var lAujourdhui = getDateAujourdhuiDb();		
			if(!dateEstPLusGrandeEgale(lAujourdhui,pData.dateAdhesion,'db')) {lVR.valid = false;lVR.dateAdhesion.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateAdhesion.erreurs.push(erreur);}
			if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(pData.dateAdhesion,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_225_CODE;erreur.message = ERR_225_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			
			if(isArray(pData.modules)) {
				if(pData.modules.length <= 0) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_226_CODE;erreur.message = ERR_226_MSG;lVR.log.erreurs.push(erreur);}
			} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

}function RechargementCompteValid() { 
	this.validAjout = function(pData) { 
		var lVR = new RechargementCompteVR();
		//Tests Techniques
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.log.erreurs.push(erreur);}
		if(!pData.montant.checkLength(0,12)) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.montant.isFloat()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.montant.erreurs.push(erreur);}
		if(!pData.typePaiement.checkLength(0,11)) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.typePaiement.isInt()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(!pData.champComplementaireObligatoire.checkLength(0,1)) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
		if(!pData.champComplementaireObligatoire.isInt()) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
		if(pData.champComplementaire != '' && !pData.champComplementaire.checkLength(0,50)) {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.champComplementaire.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
		if(pData.typePaiement.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
		if(pData.champComplementaireObligatoire.isEmpty()) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
		if(pData.champComplementaireObligatoire == 1 && pData.champComplementaire.isEmpty()) {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.champComplementaire.erreurs.push(erreur);}

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new RechargementCompteVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

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
			if(!pData.champComplementaireObligatoire.checkLength(0,1)) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
			if(!pData.champComplementaireObligatoire.isInt()) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
			if(pData.champComplementaire != '' && !pData.champComplementaire.checkLength(0,50)) {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.champComplementaire.erreurs.push(erreur);}

			//Tests Fonctionnels
			if(pData.montant.isEmpty()) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.montant.erreurs.push(erreur);}
			if(pData.montant < 0) {lVR.valid = false;lVR.montant.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.montant.erreurs.push(erreur);}
			if(pData.typePaiement.isEmpty()) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);}
			if(pData.champComplementaireObligatoire.isEmpty()) {lVR.valid = false;lVR.champComplementaireObligatoire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.champComplementaireObligatoire.erreurs.push(erreur);}
			if(pData.champComplementaireObligatoire == 1 && pData.champComplementaire.isEmpty()) {lVR.valid = false;lVR.champComplementaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.champComplementaire.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

}function ReservationCommandeValid() { 
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
	}

	this.validDelete = function(pData) {
		var lVR = new ReservationCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

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
	}

}function CommandeCompleteValid() { 
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
					lVR.produits.push(lVrProduit);
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

	this.validDelete = function(pData) {
		var lVR = new CommandeCompleteVR();
		//var lData = $.parseJSON(pData);
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

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
						lVR.produits.push(lVrProduit);
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
	}

}
function NomProduitValid() { 
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
	}

	this.validDelete = function(pData) {
		var lVR = new NomProduitVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

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
	}

}function IdentificationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new IdentificationVR();
		//Tests Techniques
		if(!pData.login.checkLength(0,20)) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.login.erreurs.push(erreur);}
		if(!pData.pass.checkLength(0,100)) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pass.erreurs.push(erreur);}
				
		//Tests Fonctionnels
		if(pData.login.isEmpty()) {lVR.valid = false;lVR.login.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.login.erreurs.push(erreur);}
		if(pData.pass.isEmpty()) {lVR.valid = false;lVR.pass.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pass.erreurs.push(erreur);}

		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new IdentificationVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

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
	}

}function ProduitCommandeValid() { 
	this.validAjout = function(pData,pMode) { 
		var lVR = new ProduitCommandeVR();
		//Tests Techniques
		if(!pData.idNom.checkLength(0,11)) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.idNom.erreurs.push(erreur);}
		if(!pData.idNom.isInt()) {lVR.valid = false;lVR.idNom.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.idNom.erreurs.push(erreur);}
		
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
		if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
		if(pData.qteMaxCommande.isEmpty()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
		if(pData.qteRestante.isEmpty()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.qteRestante.erreurs.push(erreur);}

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
			if(pData.unite.isEmpty()) {lVR.valid = false;lVR.unite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.unite.erreurs.push(erreur);}
			if(pData.qteMaxCommande.isEmpty()) {lVR.valid = false;lVR.qteMaxCommande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.qteMaxCommande.erreurs.push(erreur);}
			if(pData.qteRestante.isEmpty()) {lVR.valid = false;lVR.qteRestante.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.qteRestante.erreurs.push(erreur);}
	
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

}$(function() {
		$.datepicker.setDefaults($.datepicker.regional['fr']);
	//	$("#date_naissance, #date_adhesion").datepicker($.datepicker.regional['fr']);
		var dates = $('#date_naissance, #date_adhesion').datepicker({
			changeMonth: true,
			changeYear: true,
			onSelect: function(selectedDate) {
				var option = this.id == "date_naissance" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});

	});/********** Début Variables Globales ************/
const gTempsTransition = 150;
const gTempsTransitionUnique = gTempsTransition * 2;
// TODO mettre le sigle en lien avec le fichier de configuration
const gSigleMonetaire = "€";

const gTextEdition = "Editer";
const gTextValider = "Valider";

var TemplateData = new TemplateData();
var Infobulle = new Infobulles();

/********** Fin Variables Globales ************/

$(document).ready(function() {	
	
	// Affichage des infobulles pour les erreurs
	//$('form .ui-state-error').each(function() {		
			//$(this).tinyTips('com-infobulle', 'title');
		//Infobulle.generer(toto,'');
		//Infobulle.afficher($(this));
		//}
	//});
	
	
	
	$("#widget_message_information").click(function() {$(this).delay(gTempsTransition).fadeOut(gTempsTransitionUnique);});
	
	$("#loading").ajaxStart( function() {$(this).fadeIn(gTempsTransition)} );
	$("#loading").ajaxStop( function() {$(this).fadeOut(gTempsTransition);} );
	
	//Affiche une erreur si le message est rempli
	if($("#contenu_message_information").html() != '') {
		//$("#widget_message_information").delay(500).show('slide',{ direction: "up" },500);
		$("#widget_message_information").delay(gTempsTransition).fadeIn(gTempsTransitionUnique);
	}
	
	$(".com-button:not(.ui-state-disabled)")
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
	
	/*$("#lien_gestion_adherent_operation").click(
			function () { 
				$('#widget_formulaire_ajout_operation_adherent').slideToggle();
			}
	);
	
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	$(".com-date").datepicker({
			changeMonth: true,
			changeYear: true
	});		*/

});function MenuVue() {
	this.mMenuTemplate = new IdentificationTemplate();

	this.construct = function() {
		
		var that = this;	
		$.post(	"./index.php?m=Identification&v=Menu", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficherNouveau(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	
	/******* Nouveau Module *********/
	this.afficherNouveau = function(pMenu) {
		var that = this;
		$('#menu_int').replaceWith(that.genererNouveauMenu(pMenu.menu));
		$('#site').append(that.genererLienDeconnexion());
		if(pMenu.admin){
			$('#site').append(that.affectAdministration(that.genererLienAdmin()));
		}
	}
	
	this.genererLienDeconnexion = function() {
		return $(this.mMenuTemplate.deconnexion).hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
	}
	
	this.genererLienAdmin = function() {
		return $(this.mMenuTemplate.administration).hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
	}
	
	this.genererNouveauMenu = function(pMenu) {
		var lMenu = this.mMenuTemplate.debutMenu;
		lMenu += this.genererNouveauModule(pMenu);
		lMenu += this.mMenuTemplate.finMenu;
		
		lMenu = $(lMenu);
		
		lMenu.find('.menu-lien').first().addClass("ui-corner-tl");
		lMenu.find('.menu-lien').last().addClass("ui-corner-br");
		lMenu.find('.menu-lien').hover(function() {
			lMenu.find('.menu-lien').removeClass("ui-state-hover");
			$(this).addClass("ui-state-hover");
		},function() {lMenu.find('.menu-lien').removeClass("ui-state-hover");});
		
		lMenu = this.affectVues(lMenu);
		return lMenu;
	}
	
	this.affectHover = function(pData) {
		pData.hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	}
	
	this.genererNouveauModule = function(pModule) {
		var lTemplate = this.mMenuTemplate.nouveauModule;
		return lTemplate.template(pModule);		
	}
	
	this.affectAdministration = function(pData) {
		pData.click(function() {
			AdministrationVue();
		});
		pData = this.affectHover(pData);
		return pData;
	}
	/******* Fin Nouveau Module *********/
	this.afficher = function(pMenu) {
		var that = this;	
		$('#menu_int').replaceWith(that.genererMenu(pMenu));	
		$('#site').append(that.mMenuTemplate.deconnexion);
	}
	
	this.genererMenu = function(pMenu) {
		var lMenu = this.mMenuTemplate.debutMenu;
		lMenu += this.genererModule(pMenu);
		lMenu += this.mMenuTemplate.finMenu;
		
		lMenu = $(lMenu);
		
		lMenu = this.affectVues(lMenu);
		lMenu = this.affectAnimation(lMenu);
		return lMenu;
	}
	
	this.genererModule = function(pModule) {
		var lTemplate = this.mMenuTemplate.module;
		return lTemplate.template(pModule);		
	}
	
	/*this.affectAnimation = function(pData) {
		var that = this;
		pData.find('#menu_liste > li').hover(function() {that.deroulerMenu(this)},function() {that.cacherMenu(this)});
		pData.find('.sous_menu > li').hover( function() {$(this).addClass("ui-state-focus")} , function() {$(this).removeClass("ui-state-focus")});
		return pData;
	}*/
	
/*	this.deroulerMenu = function(obj) {
		$('#menu_liste > li > ul').hide();
		if($(obj).find('ul').css('display') == 'none') {
			$(obj).find('ul').fadeIn('fast');
		}
	}
	
	this.cacherMenu = function(obj) {
		$(obj).find('ul').stop().fadeTo(0,1).fadeOut('fast');
	}*/
	
	this.affectVues = function(pData) {
		if(pData) {
			
			pData.find('#menu-MonCompte-MonCompte').click(function() {
				MonCompteVue();
				return false;
			});			
			
			pData.find('#menu-MonCompte-MesCommandes').click(function() {
				ListeReservationVue();
				return false;
			});
			
			pData.find('#menu-Commande-ListeCommande').click(function() {
				ListeCommandeVue();
				return false;
			});
			
			return pData;
		}
		return null;
	}
	
	this.construct();
}function AdministrationVue() {
	
	this.construct = function() {
		
		var that = this;	
		$.post(	"./index.php?m=Identification&v=Administration", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficher(lResponse);
						// Maj du Menu
						var lCommunVue = new CommunVue();
						lCommunVue.majMenu('administration');
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function(pResponse) {
		var that = this;
		var lIdentificationTemplate = new IdentificationTemplate();	
		var lTemplate = lIdentificationTemplate.admin;		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse.menu))));
	}
	
	this.affect = function(pData) {
		pData = this.affectVues(pData);		
		return pData;
	};
	
	this.affectVues = function(pData) {
		if(pData) {		
			pData.find('#menu-GestionAdherents-AjoutAdherent').click(function() {
				AjoutAdherentVue();
				return false;
			});	
			
			pData.find('#menu-GestionAdherents-ListeAdherent').click(function() {
				ListeAdherentVue();
				return false;
			});	
			
			pData.find('#menu-GestionCommande-ListeCommande').click(function() {
					GestionListeCommandeVue();
					return false;
				});	
			
			pData.find('#menu-GestionCommande-AjoutCommande').click(function() {
				AjoutCommandeVue();
				return false;
			});	
			return pData;
		}
		return null;
	}
	
	
	this.construct();
}	function IdentificationVue() {

	this.construct = function() {
		// TODO va chercher le menu dans le server	
		
	/*	var that = this;	
		$.post(	"./index.php?m=Identification&v=Menu", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficherNouveau(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);*/
		
		this.affect();
	}
	
	this.affect = function() {		
		var that = this;
		$('#identification-form').submit(function() {
			that.identifier($(this));
			return false;
		});
	}
	
	this.identifier = function(pObj) {
		var lVo = new IdentificationVO();
		lVo = {"login":pObj.find(':input[name=login]').val(),"pass":pObj.find(':input[name=pass]').val()};
		
		var lValid = new IdentificationValid();
		var lVr = lValid.validAjout(lVo);

		Infobulle.init(); // Supprime les erreurs
		if (lVr.valid) {			
			$.post(	"./index.php?m=Identification&v=Identification", "pParam=" + $.toJSON(lVo),
					function(lResponse) {
					  	Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							// TODO Lancement de l'identification
							MenuVue();
							
							MonCompteVue();
							
							
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			Infobulle.generer(lVr);
		}		
	}
	
	this.construct();
}
	
$(document).ready(function() {	
	IdentificationVue();
});function CommunVue() {
	
	this.comDelete = function(pData) {	
		pData.find(".com-delete").click( function () { $(this).parent().parent().remove(); });
		return pData;	
	}
	
	this.comNumeric = function(pData) {
		if($(pData).length != 0)
			pData.find('.com-numeric').numeric(',');
		else
			$("body").find('.com-numeric').numeric(',');
		return pData;
	}
	
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
	}
	
	this.majMenu = function(pModule,pVue) {
		var lId = '#menu-' + pModule + '-' + pVue;
		if(pModule == 'administration') {
			lId = '#lien-administration';
		}
		$('.btn-menu').removeClass("ui-state-active");
		$(lId).addClass("ui-state-active");		
	}
}function IdentificationTemplate() {
	this.debutMenu = "<div id=\"menu_int\" ><ul id=\"menu_liste\" >";
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
			//"<span class=\"ui-widget-header ui-corner-top\">{modules.MODULE_LABEL}</span>" +
			"<a class=\"ui-widget-header {modules.CLASS}\" id=\"menu-{modules.MODULE_NOM}-{modules.NOM}\" href=\"./index.php?m={modules.MODULE_NOM}&amp;v={modules.NOM}\">{modules.MODULE_LABEL}</a>" +
			
			"<ul class=\"sous_menu ui-widget-content ui-corner-bottom\">" +
			"<!-- BEGIN vues -->" +
				"<li class=\"ui-corner-all\">" +
					"<a id=\"menu-{modules.MODULE_NOM}-{modules.vues.NOM}\" href=\"./index.php?m={modules.MODULE_NOM}&amp;v={modules.vues.NOM}\">{modules.vues.LABEL}</a>" +
				"</li>" +
				"<br/>" +
			"<!-- END vues -->" +
			"</ul>" +
		"</li>" +
		"<!-- END modules -->";
	
	this.nouveauModule =	
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
}