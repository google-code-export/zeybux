;function TemplateData() {
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
const ERR_112_MSG = 'Des éléments du marché sont encore en édition.';
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
const ERR_202_MSG = 'La date de fin des réservations doit être avant celle du marché.';
const ERR_203_CODE = 203;
const ERR_203_MSG = 'L\'heure de fin des réservations doit être avant celle du marché.';
const ERR_204_CODE = 204;
const ERR_204_MSG = 'L\'heure de fin du marché doit être après celle du début.';
const ERR_205_CODE = 205;
const ERR_205_MSG = 'La quantité max par adhérent doit être plus petite que le stock.';
const ERR_206_CODE = 206;
const ERR_206_MSG = 'La taille du lot doit être plus petite que quantité max par adhérent.';
const ERR_207_CODE = 207;
const ERR_207_MSG = 'Le marché doit comporter au moins un produit.';
const ERR_208_CODE = 208;
const ERR_208_MSG = 'La date de fin du marché doit être après celle du début.';
const ERR_209_CODE = 209;
const ERR_209_MSG = 'La date ne doit pas être passée.';
const ERR_210_CODE = 210;
const ERR_210_MSG = 'Un produit demandé n\'existe pas dans le système.';
const ERR_211_CODE = 211;
const ERR_211_MSG = 'Ce produit est déjà présent dans le marché.';
const ERR_212_CODE = 212;
const ERR_212_MSG = 'Aucune réservation pour ce marché.';
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
const ERR_219_MSG = 'Pas de nouveau marché.';
const ERR_220_CODE = 220;
const ERR_220_MSG = 'Vous avez déjà une réservation pour ce marché.';
const ERR_221_CODE = 221;
const ERR_221_MSG = 'Les réservations sont cloturées pour ce marché.';
const ERR_222_CODE = 222;
const ERR_222_MSG = 'Erreur d\'identification.';
const ERR_223_CODE = 223;
const ERR_223_MSG = 'Les mots de passe doivent être identiques.';
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
const ERR_231_MSG = 'Impossible de supprimer cet adhérent.';
const ERR_232_CODE = 232;
const ERR_232_MSG = 'Sélectionner un producteur.';
const ERR_233_CODE = 233;
const ERR_233_MSG = 'Sélectionner un produit.';
const ERR_234_CODE = 234;
const ERR_234_MSG = 'Un producteur demandé n\'existe pas dans le système.';
const ERR_235_CODE = 235;
const ERR_235_MSG = 'Le mot de passe actuel n\'est pas valide.';
const ERR_236_CODE = 236;
const ERR_236_MSG = 'Choisir une option.';

//Message d'Information
const ERR_301_CODE = 301;
const ERR_301_MSG = 'Enregistrement Terminé.';
const ERR_302_CODE = 302;
const ERR_302_MSG = 'Mot de passe mis à jour.';
const ERR_303_CODE = 303;
const ERR_303_MSG = 'Réservation supprimée.';
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




;function Infobulles() {
	this.init = function() {
		$(".com-infobulle").remove();
		$(".ui-state-error").removeClass("ui-state-error");
		$("#contenu_message_information").text("")
		$("#widget_message_information").hide();
	}
	
	this.generation = function(pData,pNomObj) {	
		var lMessageInformation = false;
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
							if(String(e['code'])[0] == 3){lMessageInformation = true;} // Test si c'est un message d'information
							//e['code'] =  pNomObj + i;
							e['message'] = pData[i].erreurs[err].message;							
							membre['erreurs'].push(e);
						}
						
						if(i == 'log' || $("#" + pNomObj + i ).length == 0) {
							var lDataTemp = new Array();
							lDataTemp['membres'] = new Array();	
							lDataTemp['membres'].push(membre);
							$("#contenu_message_information").html($("#contenu_message_information").html() + TemplateData.infobulleLog.template(membre));
							
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
};;function ProduitBonDeCommandeVO() {
	this.id = '';
	this.quantite = '';
	this.prix = '';
}
;function IdentificationVO() {
	this.id = '';
	this.login = '';
	this.pass = '';
}
;function ExportBonLivraisonVO() {
	this.id = '';
	this.pParam = '';
	this.export_type = '';
	this.id_commande = '';
	this.format = '';
};function NomProduitVO() {
	this.id = '';
	this.nom = '';
	this.description = '';
	this.idCategorie = '';
}
;function CommandeCompleteVO() {
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
;function RechargementCompteVO() {
	this.id = '';
	this.montant = '';
	this.typePaiement = '';
	this.champComplementaireObligatoire = '';
	this.champComplementaire = '';
}
;function ProduitCommandeVO() {
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
	this.idProducteur = '';
	this.lots = new Array();
}
;function ProduitsBonDeCommandeVO() {
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
	this.id_producteur = '';
	this.export_type = '';
	this.produits = new Array();
	this.typePaiement = '';
	this.total = '';
	this.typePaiementChampComplementaireObligatoire = '';
	this.typePaiementChampComplementaire = '';
}
;function ExportListeReservationVO() {
	this.id = '';
	this.pParam = '';
	this.export_type = '';
	this.id_commande = '';
	this.id_produits = '';
	this.format = '';
}
;function ListeReservationCommandeVO() {
	this.id = '';
	this.commandes = new Array();
}
;function ReservationCommandeVO() {
	this.id = '';
	this.stoQuantite = '';
	this.stoIdDetailCommande = '';
}
;function InfoAdherentVO() {
	this.id = '';
	this.motPasse = '';
	this.motPasseNouveau = '';
	this.motPasseConfirm = '';
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
	this.rechargement = '';
}
;function ProducteurVO() {
	this.id = '';
	this.nom = '';
	this.prenom = '';
	this.dateNaissance = '';
	this.compte = '';
	this.commentaire = '';
	this.courrielPrincipal = '';
	this.courrielSecondaire = '';
	this.telephonePrincipal = '';
	this.telephoneSecondaire = '';
	this.adresse = '';
	this.codePostal = '';
	this.ville = '';
}
;function AdherentVO() {
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
;function ExportBonReservationVO() {
	this.id = '';
	this.pParam = '';
	this.export_type = '';
	this.id_commande = '';
	this.format = '';
};function ProduitAchatVO() {
	this.id = '';
	this.quantite = '';
	this.prix = '';
}
;function ProduitsBonDeCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.id_commande = new VRelement();
	this.id_producteur = new VRelement();
	this.export_type = new VRelement();
	this.produits = new Array();
}
;function DetailCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idProduit = new VRelement();
	this.taille = new VRelement();
	this.prix = new VRelement();
}
;function IdentificationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.login = new VRelement();
	this.pass = new VRelement();
}
;function ListeReservationCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.commandes = new Array();
}
;function InfoAdherentVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.motPasse = new VRelement();
	this.motPasseNouveau = new VRelement();
	this.motPasseConfirm = new VRelement();
}
;function ExportBonReservationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.pParam = new VRelement();
	this.export_type = new VRelement();
	this.id_commande = new VRelement();
	this.format = new VRelement();
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
	this.idProducteur = new VRelement();
	this.lots = new Array();
};function ReservationCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.stoQuantite = new VRelement();
	this.stoIdDetailCommande = new VRelement();
}
;function AdherentVR() {
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
;function ExportListeReservationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.pParam = new VRelement();
	this.export_type = new VRelement();
	this.id_commande = new VRelement();
	this.id_produits = new VRelement();
	this.format = new VRelement();
}
;function RechargementCompteVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.montant = new VRelement();
	this.typePaiement = new VRelement();
	this.champComplementaireObligatoire = new VRelement();
	this.champComplementaire = new VRelement();
}
;function ExportBonLivraisonVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.pParam = new VRelement();
	this.export_type = new VRelement();
	this.id_commande = new VRelement();
	this.format = new VRelement();
}
;function VRelement() {
	this.valid = true;
	this.erreurs = new Array();
}
;function VRerreur() {
	this.code = '';
	this.message = '';
};function TemplateVR() {
	this.valid = true;
	this.log = new VRelement();
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
	this.dateFinReservation = new VRelement();
	this.timeFinReservation = new VRelement();
	this.archive = new VRelement();
	this.produits = new Array();
}
;function ProduitsBonDeLivraisonVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.id_commande = new VRelement();
	this.id_producteur = new VRelement();
	this.export_type = new VRelement();
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
	this.quantite = new VRelement();
	this.prix = new VRelement();
}
;function ProduitBonDeCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.quantite = new VRelement();
	this.prix = new VRelement();
}
;function AchatCommandeVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.idCompte = new VRelement();
	this.produits = new Array();
	this.rechargement = new VRelement();
}
;function ProducteurVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
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
}
;function ListeReservationCommandeValid() { 
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

};function ProduitAchatValid() { 
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

};function AchatCommandeValid() { 
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

		// Taille et prix sont positifs
		if(parseFloat(pData.taille) <= 0) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.taille.erreurs.push(erreur);}
		if(parseFloat(pData.prix) <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

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

			// Taille et prix sont positifs
			if(parseFloat(pData.taille) <= 0) {lVR.valid = false;lVR.taille.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.taille.erreurs.push(erreur);}
			if(parseFloat(pData.prix) <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

			return lVR;
		}
		return lTestId;
	}

};function ProduitBonDeCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitBonDeCommandeVR();
		//Tests Techniques
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}

		if(pData.quantite <= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}
		
		return lVR;
	}

	this.validDelete = function(pData) {
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
	}

};function ProduitsBonDeCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitsBonDeCommandeVR();
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

		if(pData.produits.length > 0) {	
			var lValidProduit = new ProduitBonDeCommandeValid();
			var i = 0;
			while(pData.produits[i]) {
				var lVrProduit = lValidProduit.validAjout(pData.produits[i]);	
				if(!lVrProduit.valid){lVR.valid = false;}
				lVR.produits[pData.produits[i].id] = lVrProduit;
				i++;
			}
		} else {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.log.erreurs.push(erreur);};
		
		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ProduitsBonDeCommandeVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitsBonDeCommandeVR();
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
	}

};function ProducteurValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProducteurVR();
		//Tests Techniques
		if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
		if(!pData.prenom.checkLength(0,50)) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prenom.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDate('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(pData.dateNaissance != '' && !pData.dateNaissance.checkDateExist('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		if(!pData.compte.checkLength(0,30)) {lVR.valid = false;lVR.compte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.compte.erreurs.push(erreur);}
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
		if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
		if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}

		var lAujourdhui = getDateAujourdhuiDb();		
		if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}
		
		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ProducteurVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProducteurVR();
			//Tests Techniques
			if(!pData.nom.checkLength(0,50)) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.nom.erreurs.push(erreur);}
			if(!pData.prenom.checkLength(0,50)) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prenom.erreurs.push(erreur);}
			if(pData.dateNaissance != '' && !pData.dateNaissance.checkDate('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_103_CODE;erreur.message = ERR_103_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			if(pData.dateNaissance != '' && !pData.dateNaissance.checkDateExist('db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_105_CODE;erreur.message = ERR_105_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			if(!pData.compte.checkLength(0,30)) {lVR.valid = false;lVR.compte.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.compte.erreurs.push(erreur);}
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
			if(pData.nom.isEmpty()) {lVR.valid = false;lVR.nom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.nom.erreurs.push(erreur);}
			if(pData.prenom.isEmpty()) {lVR.valid = false;lVR.prenom.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prenom.erreurs.push(erreur);}
			
			var lAujourdhui = getDateAujourdhuiDb();		
			if(pData.dateNaissance != '' && !dateEstPLusGrandeEgale(lAujourdhui,pData.dateNaissance,'db')) {lVR.valid = false;lVR.dateNaissance.valid = false;var erreur = new VRerreur();erreur.code = ERR_230_CODE;erreur.message = ERR_230_MSG;lVR.dateNaissance.erreurs.push(erreur);}
			
			return lVR;
		}
		return lTestId;
	}

};function ProduitsBonDeLivraisonValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitsBonDeLivraisonVR();
		//Tests Techniques
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_producteur.checkLength(0,11)) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_producteur.erreurs.push(erreur);}
		if(!pData.id_producteur.isInt()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_producteur.erreurs.push(erreur);}
		if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
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
		if(pData.id_producteur.isEmpty()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_producteur.erreurs.push(erreur);}
		if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
		if(pData.typePaiement.isEmpty()) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiement.erreurs.push(erreur);}
		if(pData.total.isEmpty()) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.total.erreurs.push(erreur);}

		if(pData.typePaiement == 0) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_236_CODE;erreur.message = ERR_236_MSG;lVR.typePaiement.erreurs.push(erreur);}

		if(pData.total <= 0) {lVR.valid = false;lVR.total.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.total.erreurs.push(erreur);}
		
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
	}

	this.validDelete = function(pData) {
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
	}

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
		
		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new InfoAdherentVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

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
	}

};function ProduitBonDeLivraisonValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitBonDeLivraisonVR();
		//Tests Techniques
		if(!pData.quantite.checkLength(0,12)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.quantite.isFloat()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantite.erreurs.push(erreur);}
		if(!pData.prix.checkLength(0,12)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.prix.erreurs.push(erreur);}
		if(!pData.prix.isFloat()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.checkLength(0,12)) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && !pData.quantiteSolidaire.isFloat()) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_109_CODE;erreur.message = ERR_109_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		
		//Tests Fonctionnels
		if(pData.quantite.isEmpty()) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.prix.isEmpty()) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.prix.erreurs.push(erreur);}

		if(pData.quantite <= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantiteSolidaire != '' && pData.quantiteSolidaire <= 0) {lVR.valid = false;lVR.quantiteSolidaire.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantiteSolidaire.erreurs.push(erreur);}
		if(pData.prix <= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}
		
		return lVR;
	}

	this.validDelete = function(pData) {
		var lVR = new ProduitBonDeLivraisonVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ProduitBonDeLivraisonVR();
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
	}

};function AdherentValid() { 
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

};function RechargementCompteValid() { 
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

};function ExportBonReservationValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ExportBonReservationVR();
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

	this.validDelete = function(pData) {
		var lVR = new ExportBonReservationVR();
		if(isNaN(parseInt(pData.id))) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_104_CODE;erreur.message = ERR_104_MSG;lVR.id.erreurs.push(erreur);}
		return lVR;
	}

	this.validUpdate = function(pData) {
		var lTestId = this.validDelete(pData);
		if(lTestId.valid) {
			var lVR = new ExportBonReservationVR();
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

};function ExportBonLivraisonValid() { 
	this.validAjout = function(pData) { 
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

	this.validDelete = function(pData) {
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

};function CommandeCompleteValid() { 
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
	}

}
;function ExportListeReservationValid() { 
	this.validAjout = function(pData) { 
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

	this.validDelete = function(pData) {
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
	}

};function NomProduitValid() { 
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

};function IdentificationValid() { 
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

};function GestionProducteurTemplate() {
	this.formulaireAjoutProducteur =
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_ajout_producteur\">" +
				"<form>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Information du producteur</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nom *</th>" +
									"<td class=\"com-table-form-td\">" +
										"<input type=\"hidden\" name=\"{NAME_ID}\" value=\"{VALUE_ID}\" />" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" value=\"{nom}\" maxlength=\"50\" id=\"nom\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Prénom *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prenom\" value=\"{prenom}\" maxlength=\"50\" id=\"prenom\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Date de Naissance (jj/mm/aaaa)</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_naissance\" value=\"{dateNaissance}\" maxlength=\"10\" id=\"dateNaissance\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Lier un compte<input type=\"checkbox\" name=\"lien_numero_compte\" /></th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"numero_compte\" value=\"{compte}\" maxlength=\"5\" disabled=\"disabled\" id=\"compte\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Commentaire</th>" +
									"<td class=\"com-table-form-td\"><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"commentaire\" id=\"commentaire\">{commentaire}</textarea></td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
					
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées du producteur</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Courriel Principal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"courriel_principal\" value=\"{courrielPrincipal}\" maxlength=\"100\" id=\"courrielPrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Courriel Secondaire</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" ype=\"text\" name=\"courriel_secondaire\" value=\"{courrielSecondaire}\" maxlength=\"100\" id=\"courrielSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Téléphone Principal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_principal\" value=\"{telephonePrincipal}\" maxlength=\"20\" id=\"telephonePrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Téléphone Secondaire</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_secondaire\" value=\"{telephoneSecondaire}\" maxlength=\"20\" id=\"telephoneSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Adresse</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"adresse\" value=\"{adresse}\" maxlength=\"300\" id=\"adresse\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Code Postal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"code_postal\" value=\"{codePostal}\" maxlength=\"10\" id=\"codePostal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Ville</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"ville\" value=\"{ville}\" maxlength=\"100\" id=\"ville\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<td colspan=\"2\" class=\"com-center com-ligne-submit\">" +
										"<input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Valider\" />" +
									"</td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.ajoutProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Nouveau Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.modifierProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification d'un Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été mis à jour avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.supprimerProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Suppression d'un Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été supprimé avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeProducteur = 
		"<div id=\"contenu\">" +
			"<div>" +			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Producteurs</div>" +
						"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
							"<form id=\"filter-form\">" +
								"<div>" +
									"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
											"<span class=\"ui-icon ui-icon-search\">" +
										"</span>" +
									"</span>" +
									"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
								"</div>" +
							"</form>" +
						"</div>" +
						"<table class=\"com-table\">" +
							"<thead>" +
								"<tr class=\"ui-widget ui-widget-header\">" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
									"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Courriel</th>" +
									"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Téléphone</th>" +
								"</tr>" +
							"</thead>" +
							"<tbody>" +
						"<!-- BEGIN listeProducteur -->" +
								"<tr class=\"com-cursor-pointer compte-ligne\" >" +
									"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-producteur\">{listeProducteur.prdtId}</span>{listeProducteur.prdtNumero}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtNom}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtPrenom}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtCourrielPrincipal}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtTelephonePrincipal}</td>" +
								"</tr>" +
						"<!-- END listeProducteur -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeProducteurVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Producteurs</div>" +
				"<p id=\"texte-liste-vide\">Aucun producteur dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogSuppressionProducteur = 
		"<div id=\"dialog-supp-prdt\" title=\"Supprimer le producteur {prdtNumero}\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer le producteur : {prdtNumero}</p>" +
		"</div>";
	
	this.infoCompteProducteur = 
		"<div id=\"info_compte_solde_adherent_ext\">" +
			"<div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer\" id=\"btn-supp\" title=\"Supprimer\">" +
							"<span class=\"ui-icon ui-icon-trash\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer\" id=\"btn-edt\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Numéro du producteur : {prdtNumero}</div>" +
						"<div>Numéro de Compte : {cptLabel}</div>" +
						"<div>Nom : {prdtNom}</div>" +
						"<div>Prénom : {prdtPrenom}</div>" +
						"<div>Date de naissance : {prdtDateNaissance}</div>" +
						"<div>Commentaire : {prdtCommentaire}</div>" +
					"</div>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Courriel Principal : {prdtCourrielPrincipal}</div>" +
						"<div>Courriel Secondaire : {prdtCourrielSecondaire}</div>" +
						"<div>Téléphone Principal : {prdtTelephonePrincipal}</div>" +
						"<div>Téléphone Secondaire : {prdtTelephoneSecondaire}</div>" +
						"<div>Adresse : {prdtAdresse}</div>" +				
						"<div>Ville : {prdtVille}</div>" +
						"<div>Code Postal : {prdtCodePostal}</div>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeOperationProducteur = 
		"<div id=\"liste_operation_adherent_ext\">" +
			"<div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Liste des Opérations</span></div>	" +	
					"<div>" +				
						"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
							"<form>" +	
							"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
							"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
							"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
							"	<input type=\"hidden\" class=\"pagesize\" value=\"10\">" +
							"</form>" +	
						"</div>" +	
			
						"<table id=\"table-operation\" class=\"com-table\">" +
							"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\" >" +
								"<th class=\"com-table-th\">Date</th>" +
								"<th class=\"com-table-th\">Libellé</th>" +
								"<th class=\"com-table-th\">Type de paiement</th>" +
								"<th class=\"com-table-th\">Débit</th>" +
								"<th class=\"com-table-th\">Crédit</th>" +
							"</tr>" +
							"</thead>" +
							"<tbody>" +
						"<!-- BEGIN operationPassee -->" +
							"<tr>" +
								"<td class=\"com-table-td td-date \">{operationPassee.opeDate}</td>" +
								"<td class=\"com-table-td td-libelle\">{operationPassee.opeLibelle}</td>" +
								"<td class=\"com-table-td td-type-paiement\">{operationPassee.tppType}</td>" +
								"<td class=\"com-table-td td-montant\">{operationPassee.debit}</td>" +
								"<td class=\"com-table-td td-montant\">{operationPassee.credit}</td>" +
							"</tr>" +
						"<!-- END operationPassee -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +
				"</div>";
			"</div>" +
		"</div>";
};function GestionCommandeTemplate() {
	this.formulaireModifierCommande = 
		'<div id="contenu">' +
		"<div class=\"com-barre-menu-2\">" +
			"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-editer-com\">" +
				"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
			"</button>" +
		"</div>" +
		'<div id="formulaire_ajout_commande_ext">' +			
			'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all">' +
				'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Modifier le Marché n°{comNumero}</div>' +
				'<div class="com-widget-content">' +		
					'<form id="formulaire-information-creation-commande">' +
						'<table class="com-table-form">' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Nom du Marché</th>' +
								'<td class="com-table-form-td"><input value=\"{comNom}\" class="com-input-text ui-widget-content ui-corner-all" type="text" name="nom_commande" id="commande-nom" maxlength="100" /></td>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Fin des Réservations *</th>' +
								'<td class="com-table-form-td">' +
									'<input value=\"{dateTimeFinReservation}\" class="com-input-text ui-widget-content ui-corner-all" type="text" name="date_fin_commande" id="commande-dateFinReservation" />' +
								'</td>' +
								'<td class="com-table-form-td">' +
									'&nbsp;&nbsp;à <select name="heure_fin_commande" id="commande-timeFinReservation" >' +
										'<option value="00">00</option>' +
									    '<option value="01">01</option>' +
									    '<option value="02">02</option>' +
									    '<option value="03">03</option>' +
									    '<option value="04">04</option>' +
									    '<option value="05">05</option>' +
									    '<option value="06">06</option>' +
									    '<option value="07">07</option>' +
									    '<option value="08">08</option>' +
									    '<option value="09">09</option>' +
									    '<option value="10">10</option>' +
									    '<option value="11">11</option>' +
									    '<option value="12">12</option>' +
									    '<option value="13">13</option>' +
									    '<option value="14">14</option>' +
									    '<option value="15">15</option>' +
									    '<option value="16">16</option>' +
									    '<option value="17">17</option>' +
									    '<option value="18">18</option>' +
									    '<option value="19">19</option>' +
									    '<option value="20">20</option>' +
									    '<option value="21">21</option>' +
									    '<option value="22">22</option>' +
									    '<option value="23">23</option>' +
									  '</select>' +
				   					'H <select name="minute_fin_commande">' +
										'<option value="00">00</option>' +
									    '<option value="05">05</option>' +
									    '<option value="10">10</option>' +
									    '<option value="15">15</option>' +
									    '<option value="20">20</option>' +
									    '<option value="25">25</option>' +
									    '<option value="30">30</option>' +
									    '<option value="35">35</option>' +
									    '<option value="40">40</option>' +
									    '<option value="45">45</option>' +
									    '<option value="50">50</option>' +
									    '<option value="55">55</option>' +
									  '</select>' +
								'</td>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Jour du marché *</th>' +
								'<td class="com-table-form-td">' +
									'<input value=\"{dateMarcheDebut}\" class="com-input-text ui-widget-content ui-corner-all" type="text" name="date_debut_marche" id="commande-dateMarcheDebut"/>' +
								'</td>' +
								'<td class="com-table-form-td">' +
									'de <select name="heure_debut_marche" id="commande-timeMarcheDebut">' +
										'<option value="00">00</option>' +
									    '<option value="01">01</option>' +
									    '<option value="02">02</option>' +
									    '<option value="03">03</option>' +
									    '<option value="04">04</option>' +
									    '<option value="05">05</option>' +
									    '<option value="06">06</option>' +
									    '<option value="07">07</option>' +
									    '<option value="08">08</option>' +
									    '<option value="09">09</option>' +
									    '<option value="10">10</option>' +
									    '<option value="11">11</option>' +
									    '<option value="12">12</option>' +
									    '<option value="13">13</option>' +
									    '<option value="14">14</option>' +
									    '<option value="15">15</option>' +
									    '<option value="16">16</option>' +
									    '<option value="17">17</option>' +
									    '<option value="18">18</option>' +
									    '<option value="19">19</option>' +
									    '<option value="20">20</option>' +
									    '<option value="21">21</option>' +
									    '<option value="22">22</option>' +
									    '<option value="23">23</option>' +
									  '</select>' +
				   					'H <select name="minute_debut_marche">' +
										'<option value="00">00</option>' +
									    '<option value="05">05</option>' +
									    '<option value="10">10</option>' +
									    '<option value="15">15</option>' +
									    '<option value="20">20</option>' +
									    '<option value="25">25</option>' +
									    '<option value="30">30</option>' +
									    '<option value="35">35</option>' +
									    '<option value="40">40</option>' +
									    '<option value="45">45</option>' +
									    '<option value="50">50</option>' +
									    '<option value="55">55</option>' +
									  '</select>' +
									'</td>' +
									'<td class="com-table-form-td">' +
									'à  <select name="heure_fin_marche" id="commande-timeMarcheFin">' +
										'<option value="00">00</option>' +
									    '<option value="01">01</option>' +
									    '<option value="02">02</option>' +
									    '<option value="03">03</option>' +
									    '<option value="04">04</option>' +
									    '<option value="05">05</option>' +
									    '<option value="06">06</option>' +
									    '<option value="07">07</option>' +
									    '<option value="08">08</option>' +
									    '<option value="09">09</option>' +
									    '<option value="10">10</option>' +
									    '<option value="11">11</option>' +
									    '<option value="12">12</option>' +
									    '<option value="13">13</option>' +
									    '<option value="14">14</option>' +
									    '<option value="15">15</option>' +
									    '<option value="16">16</option>' +
									    '<option value="17">17</option>' +
									    '<option value="18">18</option>' +
									    '<option value="19">19</option>' +
									    '<option value="20">20</option>' +
									    '<option value="21">21</option>' +
									    '<option value="22">22</option>' +
									    '<option value="23">23</option>' +
									  '</select>' +
				   					'H <select name="minute_fin_marche">' +
										'<option value="00">00</option>' +
									    '<option value="05">05</option>' +
									    '<option value="10">10</option>' +
									    '<option value="15">15</option>' +
									    '<option value="20">20</option>' +
									    '<option value="25">25</option>' +
									    '<option value="30">30</option>' +
									    '<option value="35">35</option>' +
									    '<option value="40">40</option>' +
									    '<option value="45">45</option>' +
									    '<option value="50">50</option>' +
									    '<option value="55">55</option>' +
									  '</select>' +
								'</td>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Description :</th>' +
								'<td class="com-table-form-td"><textarea class="com-input-text ui-widget-content ui-corner-all" name="description_commande" id="commande-description" >{comDescription}</textarea></td>' +
							'</tr>' +
						'</table>' +
					'</form>' +
				'</div>' +
			'</div>' +
			'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all" id="window-ajout-produit-creation-commande">' +
				'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Ajouter un produit</div>' +
				'<div class="com-widget-content">' +
					'<form id="formulaire-ajout-produit-creation-commande">' +
						'<table class="com-table-form">' +
							'<tr>' +
								/*'<th class="com-table-form-th ui-widget-content ui-corner-all" id="ajout-produit-idNom">Produit</th>' +
								'<td class="com-table-form-td" id="ajout-produit-nom">' +*/
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Produit</th>' +
								'<td class="com-table-form-td" id="ajout-produit-nom">' +
									'<select name="produit" id="ajout-produit-idNom">' +
										'<option value="0" >== Choisir un produit ==</option>' +
										'<!-- BEGIN produits -->' +
										'<option value={produits.id} >{produits.nom}</option>' +
										'<!-- END produits -->' +
									'</select>' +
								'</td>' +
								'<td class="com-center"><button type="button" id="btn-creer-nv-pdt" class="ui-state-default ui-corner-all com-button com-center">Créer un nouveau produit</button></td>' +
							'</tr>' +
							
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Producteur</th>' +
								'<td class="com-table-form-td" colspan="2">' +
									'<select name="producteur" id="ajout-produit-idProducteur">' +
										'<option value="0" >== Choisir un producteur ==</option>' +
										'<!-- BEGIN producteurs -->' +
										'<option value="{producteurs.prdtId}" >{producteurs.prdtPrenom} {producteurs.prdtNom}</option>' +
										'<!-- END producteurs -->' +
									'</select>' +
								'</td>' +
							'</tr>' +
							
							'<tr>' +
								'<td class="com-table-form-td"><br/></td>' +
							'</tr>' +
							'<tr>' +							
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Stock</th>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Unité</th>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Quantité max par adhérent</th>' +
							'</tr>' +
							'<tr>' +
								'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" type="text" name="stock" maxlength="11" id="ajout-produit-qteRestante"/></td>' +
								'<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" name="unite" type="text" maxlength="20" id="ajout-produit-unite"/></td>' +
								'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="qmax" type="text" maxlength="11" id="ajout-produit-qteMaxCommande" /></td>' +
							'</tr>' +
							'<tr>' +
								'<td class="com-table-form-td"><br/></td>' +					
							'</tr>' +
							'<tr>' +
								'<td></td>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Taille</th>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Prix</th>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Lot</th>' +
								'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="taille" type="text" maxlength="12" id="ajout-produit-lots0taille"/></td>' +						
								'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="prix" type="text" maxlength="12" id="ajout-produit-lots0prix"/> {SIGLE_MONETAIRE}</td>' +
							'</tr>' +
							'<tr>' +
								'<td class="com-table-form-td"><br/></td>' +						
							'</tr>' +
							'<tr>' +
								'<td colspan="3" class="com-center"><input class="ui-state-default ui-corner-all com-button com-center" type="submit" value="Ajouter au Marché"/></td>' +
							'</tr>' +
						'</table>' +
					'</form>' +
				'</div>' +
			'</div>' +
			'<div id="liste_produit">' +
			'</div>' +
			'<div class="com-widget-window ui-widget ui-widget-header ui-corner-all com-center">' +
				'<button type="button" id="btn-modifier-creation-commande" class="com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center">Modifier</button>' +
				'<button type="button" id="btn-creer-commande" class="ui-state-default ui-corner-all com-button com-center">Valider</button>' +
			'</div>' +
		'</div>' +	
		'</div>';
	
	this.dialogAjoutProduit =
		"<div id=\"dialog-form-creer-nv-pdt\" title=\"Créer un nouveau produit\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" id=\"nom-pdt-nom\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"nom-pdt-description\"></textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";
	
	this.ajoutProduitModifierCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom-id ui-helper-hidden\">{proIdNomProduit}</span><span class=\"produit-nom\">{nproNom}</span>" +				
				"<span class=\"com-delete com-btn-header ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
					"<span class=\"ui-icon ui-icon-circle-close\">" +
					"</span>" +
				"</span>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +				
				"<span class=\"produit-id ui-helper-hidden\">{proId}</span>" +
				
				"Producteur : <span class=\"info-produit\" id=\"nom-producteur\">{nomProducteur}</span>" +
				"<select name=\"producteur\" id=\"commande-produits{idNom}idProducteur\" class=\"info-produit ui-helper-hidden\">" +
					"<option value=\"0\" >== Choisir un producteur ==</option>" +
					"<!-- BEGIN producteurs -->" +
					"<option value=\"{producteurs.prdtId}\" >{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
					"<!-- END producteurs -->" +
				"</select>" +
				
				"<span class=\"edit-nom-pdt-creation-commande edit-nom-pdt-creation-commande-edit com-btn-header ui-widget-content ui-corner-all\" title=\"Editer\">" +
					"<span class=\"ui-icon ui-icon-pencil\">" +
					"</span>" +
				"</span>" +
				"<span class=\"ui-helper-hidden btn-valider com-btn-header edit-nom-pdt-creation-commande edit-nom-pdt-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check com-float-left\">" +
					"</span>Valider" +
				"</span><br/>" +	
			
				"Quantité en stock : " +
				"<span class=\"info-produit produit-stock\">{quantiteInit}</span>" +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"stock\" value=\"{quantiteInit}\" id=\"produit-{proIdNomProduit}-qteRestante\" maxlength=\"11\"/>" +
				" <span class=\"info-produit produit-unite\">{proUniteMesure}</span>" +	
				" <input class=\"info-produit ui-helper-hidden com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"unite\" value=\"{proUniteMesure}\" id=\"produit-{proIdNomProduit}-unite\" maxlength=\"20\"/>" +						
				"<br/>" +
				
				"Quantité max par adhérent : " +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qmax\" value=\"{proMaxProduitCommande}\" id=\"produit-{proIdNomProduit}-qteMaxCommande\" maxlength=\"11\"/>" +
				"<span class=\"info-produit produit-qmax\">{proMaxProduitCommande}</span>" +
				" <span class=\"produit-unite\">{proUniteMesure}</span>" +
				
				"<div class=\"lots-section\" >" +
					"<div class=\"form-ajout-lot-creation-commande\">" +
						"<form>" +
							"<table>" +
								"<tr>" +
									"<td></td>" +
									"<td>Taille</td>" +
									"<td>Prix</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Nouveau Lot : </td>" +
									"<td><input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{proId}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{proUniteMesure}</span></td>" +
									"<td><input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{proId}-prix\" maxlength=\"12\"/> {sigleMonetaire}</td>" +
									"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande ui-state-default ui-corner-all com-button com-center\">Ajouter</button></td>" +
								"</tr>" +
							"</table>" +
						"</form>" +
					"</div>" +
					"<div class=\"produit-lots\">" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";	
	
	this.modifCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification de la commande n°{numero}" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Marché n°{numero} modifié avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.formulaireAjoutCommande = 
		'<div id="contenu">' +
		'<div id="formulaire_ajout_commande_ext">' +		
			'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all">' +
				'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Nouveau Marché</div>' +
				'<div class="com-widget-content">' +		
					'<form id="formulaire-information-creation-commande">' +
						'<table class="com-table-form">' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Nom du Marché</th>' +
								'<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="text" name="nom_commande" id="commande-nom" maxlength="100" /></td>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Fin des Réservations *</th>' +
								'<td class="com-table-form-td">' +
									'<input class="com-input-text ui-widget-content ui-corner-all" type="text" name="date_fin_commande" id="commande-dateFinReservation" />' +
								'</td>' +
								'<td class="com-table-form-td">' +
									'&nbsp;&nbsp;à <select name="heure_fin_commande" id="commande-timeFinReservation" >' +
										'<option value="00">00</option>' +
									    '<option value="01">01</option>' +
									    '<option value="02">02</option>' +
									    '<option value="03">03</option>' +
									    '<option value="04">04</option>' +
									    '<option value="05">05</option>' +
									    '<option value="06">06</option>' +
									    '<option value="07">07</option>' +
									    '<option value="08">08</option>' +
									    '<option value="09">09</option>' +
									    '<option value="10">10</option>' +
									    '<option value="11">11</option>' +
									    '<option value="12">12</option>' +
									    '<option value="13">13</option>' +
									    '<option value="14">14</option>' +
									    '<option value="15">15</option>' +
									    '<option value="16">16</option>' +
									    '<option value="17">17</option>' +
									    '<option value="18">18</option>' +
									    '<option value="19">19</option>' +
									    '<option value="20">20</option>' +
									    '<option value="21">21</option>' +
									    '<option value="22">22</option>' +
									    '<option value="23">23</option>' +
									  '</select>' +
				   					'H <select name="minute_fin_commande">' +
										'<option value="00">00</option>' +
									    '<option value="05">05</option>' +
									    '<option value="10">10</option>' +
									    '<option value="15">15</option>' +
									    '<option value="20">20</option>' +
									    '<option value="25">25</option>' +
									    '<option value="30">30</option>' +
									    '<option value="35">35</option>' +
									    '<option value="40">40</option>' +
									    '<option value="45">45</option>' +
									    '<option value="50">50</option>' +
									    '<option value="55">55</option>' +
									  '</select>' +
								'</td>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Jour du marché *</th>' +
								'<td class="com-table-form-td">' +
									'<input class="com-input-text ui-widget-content ui-corner-all" type="text" name="date_debut_marche" id="commande-dateMarcheDebut"/>' +
								'</td>' +
								'<td class="com-table-form-td">' +
									'de <select name="heure_debut_marche" id="commande-timeMarcheDebut">' +
										'<option value="00">00</option>' +
									    '<option value="01">01</option>' +
									    '<option value="02">02</option>' +
									    '<option value="03">03</option>' +
									    '<option value="04">04</option>' +
									    '<option value="05">05</option>' +
									    '<option value="06">06</option>' +
									    '<option value="07">07</option>' +
									    '<option value="08">08</option>' +
									    '<option value="09">09</option>' +
									    '<option value="10">10</option>' +
									    '<option value="11">11</option>' +
									    '<option value="12">12</option>' +
									    '<option value="13">13</option>' +
									    '<option value="14">14</option>' +
									    '<option value="15">15</option>' +
									    '<option value="16">16</option>' +
									    '<option value="17">17</option>' +
									    '<option value="18">18</option>' +
									    '<option value="19">19</option>' +
									    '<option value="20">20</option>' +
									    '<option value="21">21</option>' +
									    '<option value="22">22</option>' +
									    '<option value="23">23</option>' +
									  '</select>' +
				   					'H <select name="minute_debut_marche">' +
										'<option value="00">00</option>' +
									    '<option value="05">05</option>' +
									    '<option value="10">10</option>' +
									    '<option value="15">15</option>' +
									    '<option value="20">20</option>' +
									    '<option value="25">25</option>' +
									    '<option value="30">30</option>' +
									    '<option value="35">35</option>' +
									    '<option value="40">40</option>' +
									    '<option value="45">45</option>' +
									    '<option value="50">50</option>' +
									    '<option value="55">55</option>' +
									  '</select>' +
									'</td>' +
									'<td class="com-table-form-td">' +
									'à  <select name="heure_fin_marche" id="commande-timeMarcheFin">' +
										'<option value="00">00</option>' +
									    '<option value="01">01</option>' +
									    '<option value="02">02</option>' +
									    '<option value="03">03</option>' +
									    '<option value="04">04</option>' +
									    '<option value="05">05</option>' +
									    '<option value="06">06</option>' +
									    '<option value="07">07</option>' +
									    '<option value="08">08</option>' +
									    '<option value="09">09</option>' +
									    '<option value="10">10</option>' +
									    '<option value="11">11</option>' +
									    '<option value="12">12</option>' +
									    '<option value="13">13</option>' +
									    '<option value="14">14</option>' +
									    '<option value="15">15</option>' +
									    '<option value="16">16</option>' +
									    '<option value="17">17</option>' +
									    '<option value="18">18</option>' +
									    '<option value="19">19</option>' +
									    '<option value="20">20</option>' +
									    '<option value="21">21</option>' +
									    '<option value="22">22</option>' +
									    '<option value="23">23</option>' +
									  '</select>' +
				   					'H <select name="minute_fin_marche">' +
										'<option value="00">00</option>' +
									    '<option value="05">05</option>' +
									    '<option value="10">10</option>' +
									    '<option value="15">15</option>' +
									    '<option value="20">20</option>' +
									    '<option value="25">25</option>' +
									    '<option value="30">30</option>' +
									    '<option value="35">35</option>' +
									    '<option value="40">40</option>' +
									    '<option value="45">45</option>' +
									    '<option value="50">50</option>' +
									    '<option value="55">55</option>' +
									  '</select>' +
								'</td>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Description :</th>' +
								'<td class="com-table-form-td"><textarea class="com-input-text ui-widget-content ui-corner-all" name="description_commande" id="commande-description" ></textarea></td>' +
							'</tr>' +
						'</table>' +
					'</form>' +
				'</div>' +
			'</div>' +
			'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all" id="window-ajout-produit-creation-commande">' +
				'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Ajouter un produit</div>' +
				'<div class="com-widget-content">' +
					'<form id="formulaire-ajout-produit-creation-commande">' +
						'<table class="com-table-form">' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Produit</th>' +
								'<td class="com-table-form-td" id="ajout-produit-nom">' +
									'<select name="produit" id="ajout-produit-idNom">' +
										'<option value="0" >== Choisir un produit ==</option>' +
										'<!-- BEGIN produits -->' +
										'<option value="{produits.id}" >{produits.nom}</option>' +
										'<!-- END produits -->' +
									'</select>' +
								'</td>' +
								'<td class="com-center"><button type="button" id="btn-creer-nv-pdt" class="ui-state-default ui-corner-all com-button com-center">Créer un nouveau produit</button></td>' +
							'</tr>' +	
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Producteur</th>' +
								'<td class="com-table-form-td" colspan="2">' +
									'<select name="producteur" id="ajout-produit-idProducteur">' +
										'<option value="0" >== Choisir un producteur ==</option>' +
										'<!-- BEGIN producteurs -->' +
										'<option value="{producteurs.prdtId}" >{producteurs.prdtPrenom} {producteurs.prdtNom}</option>' +
										'<!-- END producteurs -->' +
									'</select>' +
								'</td>' +
							'</tr>' +
							'<tr>' +
								'<td class="com-table-form-td"><br/></td>' +
							'</tr>' +
							'<tr>' +							
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Stock</th>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Unité</th>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Quantité max par adhérent</th>' +
							'</tr>' +
							'<tr>' +
								'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" type="text" name="stock" maxlength="11" id="ajout-produit-qteRestante"/></td>' +
								'<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" name="unite" type="text" maxlength="20" id="ajout-produit-unite"/></td>' +
								'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="qmax" type="text" maxlength="11" id="ajout-produit-qteMaxCommande" /></td>' +
							'</tr>' +
							'<tr>' +
								'<td class="com-table-form-td"><br/></td>' +					
							'</tr>' +
							'<tr>' +
								'<td></td>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Taille</th>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Prix</th>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Lot</th>' +
								'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="taille" type="text" maxlength="12" id="ajout-produit-lots0taille"/></td>' +						
								'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="prix" type="text" maxlength="12" id="ajout-produit-lots0prix"/> {SIGLE_MONETAIRE}</td>' +
							'</tr>' +
							'<tr>' +
								'<td class="com-table-form-td"><br/></td>' +						
							'</tr>' +
							'<tr>' +
								'<td colspan="3" class="com-center"><input type="submit" value="Ajouter au Marché" class="ui-state-default ui-corner-all com-button com-center"/></td>' +
							'</tr>' +
						'</table>' +
					'</form>' +
				'</div>' +
			'</div>' +
			'<div id="liste_produit"></div>' +
			'<div class="com-widget-window ui-widget ui-widget-header ui-corner-all com-center">' +
				'<button type="button" id="btn-modifier-creation-commande" class="com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center">Modifier le Marché</button>' +
				'<button type="button" id="btn-creer-commande" class="ui-state-default ui-corner-all com-button com-center">Créer le Marché</button>' +
			'</div>' +
		'</div>' +	
		'</div>';
	
	this.ajoutProduitAjoutCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom\">{nom}</span>" +
				"<span class=\"com-delete com-btn-header ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
					"<span class=\"ui-icon ui-icon-circle-close\">" +
					"</span>" +
				"</span>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +		
				"<span class=\"produit-id ui-helper-hidden\">{idNom}</span>" +
			
				"Producteur : <span class=\"info-produit\" id=\"nom-producteur\">{nomProducteur}</span>" +
				"<select name=\"producteur\" id=\"commande-produits{idNom}idProducteur\" class=\"info-produit ui-helper-hidden\">" +
					"<option value=\"0\" >== Choisir un producteur ==</option>" +
					"<!-- BEGIN producteurs -->" +
					"<option value=\"{producteurs.prdtId}\" >{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
					"<!-- END producteurs -->" +
				"</select>" +
				
				"<span class=\"edit-nom-pdt-creation-commande edit-nom-pdt-creation-commande-edit com-btn-header ui-widget-content ui-corner-all\" title=\"Editer\">" +
					"<span class=\"ui-icon ui-icon-pencil\">" +
					"</span>" +
				"</span>" +
				"<span class=\"ui-helper-hidden btn-valider com-btn-header edit-nom-pdt-creation-commande edit-nom-pdt-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check com-float-left\">" +
					"</span>Valider" +
				"</span>" +								
				"<br/>" +				
				
				"Quantité en stock : " +
				"<span class=\"produit-stock info-produit\">{qteRestante}</span>" +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"stock\" value=\"{qteRestante}\" id=\"produit-{idNom}-qteRestante\" maxlength=\"11\"/>" +
				" <span class=\"info-produit produit-unite\">{unite}</span>" +
				" <input class=\"info-produit ui-helper-hidden com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"unite\" value=\"{unite}\" id=\"produit-{idNom}-unite\" maxlength=\"20\"/>" +
							
				"<br/>" +				
				"Quantité max par adhérent : " +
				"<span class=\"info-produit produit-qmax\">{qteMaxCommande}</span>" +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qmax\" value=\"{qteMaxCommande}\" id=\"produit-{idNom}-qteMaxCommande\" maxlength=\"11\"/>" +
				" <span class=\"produit-unite\">{unite}</span>" +
				
				"<div class=\"lots-section\" >" +
					"<div class=\"form-ajout-lot-creation-commande\">" +
						"<form>" +
							"<table>" +
								"<tr>" +
									"<td></td>" +
									"<td>Taille</td>" +
									"<td>Prix</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Nouveau Lot : </td>" +
									"<td><input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{idNom}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{unite}</span></td>" +
									"<td><input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{idNom}-prix\" maxlength=\"12\"/> {siglemonetaire}</td>" +
									"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande ui-state-default ui-corner-all com-button com-center\">Ajouter</button></td>" +
								"</tr>" +
							"</table>" +
						"</form>" +
					"</div>" +
					"<div class=\"produit-lots\">" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.ajoutLotModifPdt = 
		"<!-- BEGIN lots -->" +
		"<div class=\"produit-lot\">" +
				"<span class=\"lot-id ui-helper-hidden\">{lots.id}</span>" +
				"Taille : " +
				"<input class=\"pdt-{lots.idPdt}-lot-{lots.id} ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{lots.idPdt}-lot-{lots.id}-taille\" maxlength=\"12\"/>" +
				"<span class=\"pdt-{lots.idPdt}-lot-{lots.id} produit-taille\">{lots.taille}</span>" +
				" <span class=\"produit-unite\">{lots.unite}</span>" +
				"   Prix : " +
				"<input class=\"pdt-{lots.idPdt}-lot-{lots.id} ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{lots.idPdt}-lot-{lots.id}-prix\" maxlength=\"12\" />" +
				"<span class=\"pdt-{lots.idPdt}-lot-{lots.id} produit-prix\">{lots.prix}</span>" +
				" {siglemonetaire}" +
				
				"<span class=\"conteneur-btn-edt-lot\">" +
					"<span class=\"ui-helper-hidden delete-lot com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-closethick\">" +
						"</span>" +
					"</span>" +
					"<span class=\"edit-lot-creation-commande edit-lot-creation-commande-edit com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Editer\">" +
						"<span class=\"ui-icon ui-icon-pencil\">" +
						"</span>" +
					"</span>" +
					"<span class=\"ui-helper-hidden btn-valider com-btn-header-multiples edit-lot-creation-commande edit-lot-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check com-float-left\">" +
						"</span>Valider" +
					"</span>" +
				"</span>" +
		"</div>" +
		"<!-- END lots -->";
	
	this.ajoutLotAjoutPdt = 
		"<!-- BEGIN lots -->" +
		"<div class=\"produit-lot\">" +
				"<span class=\"lot-id ui-helper-hidden\">0</span>" +
				"Taille : " +
				"<span class=\"pdt-{idNom}-lot-0 produit-taille\">{lots.taille}</span>" +
				"<input class=\"pdt-{idNom}-lot-0 ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{idNom}-lot-0-taille\" maxlength=\"12\"/>" +
				" <span class=\"produit-unite\">{unite}</span>" +
				
				"   Prix : " +
				"<span class=\"pdt-{idNom}-lot-0 produit-prix\">{lots.prix}</span>" +
				"<input class=\"pdt-{idNom}-lot-0 ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{idNom}-lot-0-prix\" maxlength=\"12\" />" +
				" {siglemonetaire}" +
				
				"<span class=\"conteneur-btn-edt-lot\">" +
					"<span class=\"ui-helper-hidden delete-lot com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-closethick\">" +
						"</span>" +
					"</span>" +
					"<span class=\"edit-lot-creation-commande edit-lot-creation-commande-edit com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Editer\">" +
						"<span class=\"ui-icon ui-icon-pencil\">" +
						"</span>" +
					"</span>" +
					"<span class=\"ui-helper-hidden btn-valider com-btn-header-multiples edit-lot-creation-commande edit-lot-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check com-float-left\">" +
						"</span>Valider" +
					"</span>" +
				"</span>" +
		"</div>" +
		"<!-- END lots -->";
	
	this.ajoutLot = 
		"<div class=\"produit-lot\">" +
			"<span class=\"lot-id ui-helper-hidden\">{id}</span>" +
			"Taille : " +
			"<span class=\"pdt-{idNom}-lot-{id} produit-taille\">{taille}</span>" +
			"<input class=\"pdt-{idNom}-lot-{id} ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" value=\"{taille}\" id=\"produit-{idNom}-lot-{id}-taille\" maxlength=\"12\">" +
			" <span class=\"produit-unite\">{unite}</span>" +
			"   Prix : " +
			"<span class=\"pdt-{idNom}-lot-{id} produit-prix\">{prix}</span>" +
			"<input class=\"pdt-{idNom}-lot-{id} ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" value=\"{prix}\" id=\"produit-{idNom}-lot-{id}-prix\" maxlength=\"12\">" +
			" {siglemonetaire}" +
			
			"<span class=\"conteneur-btn-edt-lot\">" +
				"<span class=\"ui-helper-hidden delete-lot com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
					"<span class=\"ui-icon ui-icon-closethick\">" +
					"</span>" +
				"</span>" +				
				"<span class=\"edit-lot-creation-commande edit-lot-creation-commande-edit com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Editer\">" +
					"<span class=\"ui-icon ui-icon-pencil\">" +
					"</span>" +
				"</span>" +
				"<span class=\"ui-helper-hidden btn-valider com-btn-header-multiples edit-lot-creation-commande edit-lot-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check com-float-left\">" +
					"</span>Valider" +
				"</span>" +
			"</span>" +
		"</div>";

	this.ajoutCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Création du Marché" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le marché n°{numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";		
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-barre-menu-2\">" +
					"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-archive\">" +
						"<span class=\"com-float-left\">Les Marchés cloturés</span>" +
						"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-e\"></span>" +
					"</button>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
								"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr>" +
								"<td class=\"com-table-td com-text-align-right\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td lst-resa-btn-commander\">" +
									"<button class=\"btn-editer ui-state-default ui-corner-all com-button com-center\" id=\"{commande.id}\" >Editer</button>" +
								"</td>" +
								"<td class=\"com-table-td lst-resa-btn-commander\">" +
									"<button class=\"btn-marche ui-state-default ui-corner-all com-button com-center\" id=\"{commande.id}\" >Vente</button>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +	
				"</div>" +				
			"</div>" +
		"</div>";
	
	this.listeCommandeArchivePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-barre-menu-2\">" +
					"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-encours\">" +
						"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Les Marchés en cours" +
					"</button>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés cloturés</div>" +
					
						"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
							"<form>" +	
							"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
							"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
							"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
							"	<input type=\"hidden\" class=\"pagesize\" value=\"30\">" +
							"</form>" +	
						"</div>" +
						
						"<table class=\"com-table\" id=\"table-marche-archive\">" +
							"<thead>" +
								"<tr class=\"ui-widget ui-widget-header\">" +
									"<th class=\"com-table-th lst-resa-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
									"<th class=\"com-table-th com-cursor-pointer\" ><span class=\"ui-icon span-icon\"></span>Date de cloture des Réservations</th>" +
									"<th class=\"com-table-th com-cursor-pointer\" ><span class=\"ui-icon span-icon\"></span>Marché</th>	" +
								"</tr>" +
							"</thead>" +
							"<tbody>" +
								"<!-- BEGIN commande -->" +
								"<tr class=\"com-cursor-pointer detail-commande-ligne\" >" +
									"<td class=\"com-table-td com-underline-hover com-text-align-right\"><span class=\"ui-helper-hidden id-commande\">{commande.id}</span>{commande.numero}</td>" +
									"<td class=\"com-table-td com-underline-hover\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
									"<td class=\"com-table-td com-underline-hover\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"</tr>" +
								"<!-- END commande -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente du Marché n°{comNumero}</div>" +
					"<div class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\"> " +
							"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
									"<span class=\"ui-icon ui-icon-search\">" +
								"</span>" +
							"</span>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th com-underline-hover marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th com-underline-hover marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th com-underline-hover marche-com-th-nom\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
						"<!-- BEGIN listeAdherentCommande -->" +
						"<tr class=\"com-cursor-pointer achat-commande-ligne\" >" +							
							"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherentCommande.adhId}</span>{listeAdherentCommande.adhNumero}</td>" +
							"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhLabelCompte}</td>" +
							"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhNom}</td>" +
							"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhPrenom}</td>" +
						"</tr>" +
						"<!-- END listeAdherentCommande -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.achatCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente du Marché n°{comNumero}</div>" +
				"<div class=\"com-widget-content\">" +
					"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-float-left\" id=\"achat-pdt-widget\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
				"<div class=\"com-widget-content\">" +
				"<table id=\"achat-commande-table-pdt\">" +
					"<thead>" +
						"<tr>" +
							"<th>Produit</th>" +
							"<th>Quantité</th>" +
							"<th></th>" +
							"<th>Prix</th>" +
							"<th></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
					"<!-- BEGIN produits -->" +
						"<tr class=\"ligne-produit\">" +
							"<td><span class=\"produit-id ui-helper-hidden\">{produits.proId}</span>{produits.nproNom}</td>" +
							"<td class=\"com-text-align-right td-qte\"><input type=\"text\" value=\"{produits.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"produits{produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td class=\"td-unite\">{produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right td-qte\" ><input type=\"text\" value=\"{produits.proPrix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"produits{produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"<!-- END produits -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"2\"></td>" +
							"<td class=\"com-text-align-right\" >Total :</td>" +
							"<td class=\"com-text-align-right\" ><span id=\"total-achat\">{total}</span></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-float-left\" id=\"achat-rechgt-widget\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Rechargement du compte</div>" +
				"<div class=\"com-widget-content\">" +
					"<table>" +
						"<thead>" +
							"<tr>" +
								"<th>Montant</th>" +
								"<th>Type de Paiement</th>" +
								"<th id=\"label-champ-complementaire\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<tr>" +
								"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"rechargementmontant\" maxlength=\"12\" size=\"3\"/> <span>{sigleMonetaire}</span></td>" +
								"<td class=\"com-center\">" +
									"<select name=\"typepaiement\" id=\"typePaiement\">" +
										"<option value=\"0\">== Choisir ==</option>" +
										"<!-- BEGIN typePaiement -->" +
										"<option value=\"{typePaiement.tppId}\">{typePaiement.tppType}</option>" +
										"<!-- END typePaiement -->" +
									"</select>" +
								"</td>" +
								"<td id=\"td-champ-complementaire\"><input type=\"text\" name=\"champ-complementaire\" value=\"\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button type=\"button\" id=\"btn-annuler\" class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\">Annuler</button>" +
				"<button type=\"button\" class=\"ui-helper-hidden com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-modifier\">Modifier</button>" +
				"<button type=\"button\" id=\"btn-valider\" class=\"ui-state-default ui-corner-all com-button com-center\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.achatCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Achat effectué avec succès.<br/><br/>" +
						"<button id=\"btn-annuler\" class=\"ui-state-default ui-corner-all com-button com-center\">Retourner à la liste des réservations</button>" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.cloturerCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Cloture du Marché n°{numero}" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Cloture du Marché n°{numero} effectuée avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.dialogClotureCommande = 				
			"<div id=\"dialog-cloturer-com\" title=\"Cloture du Marché n°{comNumero}\">" +
				"<p>Vous allez cloturer le Marché n°{comNumero}</p>" +
			"</div>";
	
	this.dialogExportListeReservation = 
			"<div id=\"dialog-export-liste-reservation\" title=\"Export des réservations du Marché n°{comNumero}\">" +
				"<form>" +
					"<table>" +
						"<tr>" +
							"<td>Format de sortie : </td>" +
							"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
							"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
						"</tr>" +
						"<tr>" +
						"</tr>" +
						"<tr>" +
							"<td colspan=\"3\">Sélectionner les produits : </td>" +
						"</tr>" +
					"<!-- BEGIN pdtCommande -->" +
						"<tr>" +
							"<td></td>" +
							"<td><input type=\"checkbox\" value=\"{pdtCommande.proId}\" name=\"id_produits\"/></td>" +
							"<td>{pdtCommande.nproNom}</td>" +						
						"</tr>" +
					"<!-- END pdtCommande -->" +
					"</table>" +
				"</form>" +
			"</div>";
	
	this.editerCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-float-left\" id=\"edt-com-info\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Marché n°{comNumero}" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-cloture-com\" title=\"Cloturer\">" +
							"<span class=\"ui-icon ui-icon-disk\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-modif-com\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-livraison-com\" title=\"Bon de livraison\">" +
							"<span class=\"ui-icon ui-icon-cart\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-bon-com\" title=\"Bon de commande\">" +
							"<span class=\"ui-icon ui-icon-document\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div>" +
					"Fin des réservations : <br/>Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : <br/>Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
					"</div>" +
				"</div>" +
				"<!-- BEGIN pdtCommande -->" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +					
						"{pdtCommande.nproNom}" +
						"<span class=\"com-btn-header ui-widget-content ui-corner-all com-cursor-pointer pdt-{pdtCommande.proId}-afficher-detail\">" +
							"<span class=\"ui-icon ui-icon-plusthick\">" +
							"</span>" +
						"</span>" +
						"<span class=\"ui-helper-hidden com-btn-header ui-widget-content ui-corner-all com-cursor-pointer pdt-{pdtCommande.proId}-afficher-detail\">" +
							"<span class=\"ui-icon ui-icon-minusthick\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div>" +
						"<div class=\"edt-com-progressbar-pdt\" id=\"pdt-{pdtCommande.proId}\"></div>" +
						"<div class=\"ui-helper-hidden\" id=\"pdt-{pdtCommande.proId}-detail\">" +
							"Stock Initial : {pdtCommande.quantiteInit} {pdtCommande.proUniteMesure}<br/>" +
							"Stock Actuel : {pdtCommande.quantite} {pdtCommande.proUniteMesure}<br/>" +
							"Stock Commandé : {pdtCommande.quantiteCommande} {pdtCommande.proUniteMesure}<br/>" +
							"Max par adhérent {pdtCommande.proMaxProduitCommande} {pdtCommande.proUniteMesure}" +
							"<div>" +
								"<div>Lots : </div>" +
								"<!-- BEGIN pdtCommande.lot -->" +
									"{pdtCommande.lot.dcomTaille} {pdtCommande.proUniteMesure} à " +
									"{pdtCommande.lot.dcomPrix} {sigleMonetaire}<br/>" +
								"<!-- END pdtCommande.lot -->" +
							"</div>" +
						"</div>" +
					"</div>" +
				"</div>" +
				"<!-- END pdtCommande -->" +
			"</div>" +
			"<div class=\"com-float-left\" id=\"edt-com-liste\" >" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Liste des Réservation" +
						"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-resa\" title=\"Exporter les réservations\">" +
							"<span class=\"ui-icon ui-icon-print\">" +
							"</span>" +
						"</span>" +
					"</div>" +
						"<div id=\"edt-com-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
							"<form id=\"filter-form\">" +

								"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\">" +
									"</span>" +
								"</span>" +
								"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
								
							"</form>" +
						"</div>" +
						"<table class=\"com-table\" id=\"edt-com-liste-resa\">" +
							"<thead>" +
							"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
								"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
								"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
								"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
								"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
							"</tr>" +
							"</thead>" +
							"<tbody>" +
							"<!-- BEGIN listeAdherentCommande -->" +
							"<tr class=\"com-cursor-pointer edt-com-reservation-ligne\" >" +							
								"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherentCommande.adhId}</span>{listeAdherentCommande.adhNumero}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhLabelCompte}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhNom}</td>" +
								"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhPrenom}</td>" +
							"</tr>" +
							"<!-- END listeAdherentCommande -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.supprimerReservationDialog =
		"<div id=\"dialog-supprimer-reservation\" title=\"Supprimer la réservation\">" +
			"<p>Voulez-vous supprimer la réservation ?</p>" +
		"</div>";	
	
	this.detailReservation = 
		"<div id=\"contenu\">" +		
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-annuler\">" +
				"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
				"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
				"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Adhérent</div>" +
				"<div class=\"com-widget-content\">" +
					"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"La réservation" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN reservation -->" +
					"<tr >" +
						"<td class=\"detail-resa-npro\">{reservation.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{reservation.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{reservation.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{reservation.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END reservation -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
						"<td class=\"com-text-align-right\">{total}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<div class=\"boutons-edition com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-modifier\">Modifier</button>" +	
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-supprimer\">Supprimer</button>" +
			"</div>" +
		"</div>";
	
	this.modifierReservation =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Adhérent</div>" +
				"<div class=\"com-widget-content\">" +
					"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"La réservation" +
				"</div>" +
				"<div>" +
					"<table>" +
						"<!-- BEGIN produit -->" +
						"<tr class=\"pdt\" id=\"pdt-{produit.proId}\">" +
							"<td class=\"passer-com-radio\" ><input type=\"checkbox\" {produit.checked}/></td>" +
							"<td class=\"passer-com-radio\" ><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span></span></td>" +
							"<td colspan=\"5\" class=\"passer-com-npro\">{produit.nproNom}</td>" +
							"<td>" +
								"<span>{produit.proMaxProduitCommande}</span>" +
								" <span>{produit.proUniteMesure}</span> Max" +
							"</td>" +
							"<td colspan=\"3\"></td>" +
						"</tr>" +
						"<!-- BEGIN produit.lot -->" +
						"<tr class=\"lot lot-pdt-{produit.proId}\">" +
							"<td class=\"passer-com-radio\"><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span><span class=\"lot-id\">{produit.lot.dcomId}</span></span></td>" +
							"<td class=\"passer-com-radio\"><input type=\"radio\" name=\"lot-produit-{produit.proId}\" {produit.lot.checked}/></td>" +
							"<td class=\"com-text-align-right detail-resa-qte\">{produit.lot.dcomTaille}</td>" +
							"<td class=\"detail-resa-unite\">{produit.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right detail-resa-prix\">{produit.lot.dcomPrix}</td>" +
							"<td class=\"passer-com-sigle\" >{sigleMonetaire}</td>" +
							"<td class=\"passer-com-btn-qte\"><button class=\"btn-moins btn-pdt-{produit.proId}\" id=\"btn-moins-lot-{produit.lot.dcomId}\">-</button></td>" +
							"<td class=\"passer-com-qte\"><span id=\"colonne-qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\"><span id=\"qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"qte\">{produit.lot.stoQuantiteReservation}</span>" +
								" <span>{produit.proUniteMesure}</span></span></td>" +
							"<td class=\"passer-com-btn-qte\"><button class=\"btn-plus btn-pdt-{produit.proId}\" id=\"btn-plus-lot-{produit.lot.dcomId}\">+</button></td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"colonne-prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\"><span id=\"prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}\">{produit.lot.prixReservation}</span></span></td>" +
							"<td><span id=\"colonne-sigle-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\">{sigleMonetaire}</span></td>" +
						"</tr>" +
						"<!-- END produit.lot -->" +
						"<!-- END produit -->" +
						"<tr>" +
							"<td colspan=\"9\" class=\"com-text-align-right\">Total : </td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"total\">{total}</span></td>" +
							"<td>{sigleMonetaire}</td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-annuler\">Annuler</button>" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-valider\">Valider</button>" +		
			"</div>" +
		"</div>";
	
	this.listeCommandeVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-archive\">" +
					"<span class=\"com-float-left\">Les Marchés cloturés</span>" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-e\"></span>" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeCommandeArchiveVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-encours\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Les Marchés en cours" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cloturés</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché cloturé.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeMarcheVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente</div>" +
				"<p id=\"texte-liste-vide\">Aucune réservation en cours.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeReservationVide =
		"<p id=\"texte-liste-vide\">Aucune reservation.</p>";
	
	this.dialogEnregistrement =
		"<div title=\"Enregistrer les modifications\">" +
			"<p>Vous n'avez pas enregistré vos modifications.</p>" +
		"</div>";
	
	this.dialogExportBonDeCommande = 
		"<div id=\"dialog-export-bon-commande\" title=\"Export du Bon de Commande du Marché n°{comNumero}\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Format de sortie : </td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.bonDeCommande =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-editer-com\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Bon de commande du Marché n°{comNumero}" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-bcom\" title=\"Exporter le bon de commande\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
					"</span>" +
				"</span>" +
				"</div>" +
				"<div>" +
					"<form>" +
						"<span>Producteur : " +
							"<select id=\"select-prdt\">" +
								"<option value=\"0\" >== Choisir un producteur ==</option>" +
								"<!-- BEGIN producteurs -->" +
								"<option value=\"{producteurs.prdtId}\">{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
								"<!-- END producteurs -->" +
							"</select>" +
						"</span>" +
					"</form>" +
				"</div>" +
				"<div id=\"liste-pdt\"></div>" +	
			"</div>" +
		"</div>";
	
	this.listeProduitVide =
		"<div id=\"liste-pdt\"></div>";
	
	this.listeProduitBonDeCommande = 
		"<div id=\"liste-pdt\">" +
			"<table class=\"com-table\">" +
				"<thead>" +
					"<tr>" +
						"<th>Produit</th>" +
						"<th>Réservation</th>" +
						"<th>Commande</th>" +
						"<th>Prix</th>" +
						"<th>État</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
					"<!-- BEGIN produits -->" +
					"<tr>" +
						"<td>{produits.nproNom}</td>" +
						"<td>{produits.stoQuantite} {produits.proUniteMesure}</td>" +
						"<td><span class=\"pro-id ui-helper-hidden\">{produits.proId}</span><input class=\"qte-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qte-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.stoQuantiteCommande}\" id=\"produits{produits.proId}quantite\"/> {produits.proUniteMesure}</td>" +
						"<td><input class=\"prix-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.opeMontant}\" id=\"produits{produits.proId}prix\" /> {sigleMonetaire}</td>" +
						"<td><div id=\"etat-commande-{produits.proId}\" class=\"{produits.classEtat} ui-corner-all\"></div></td>" +
					"</tr>" +
					"<!-- END produits -->" +
				"</tbody>" +
			"</table>" +
			"<div class=\"com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button\" id=\"btn-enregistrer\">Enregistrer</button>" +
			"</div>" +
		"</div>";
	
	this.dialogExportBonDeLivraison =
		"<div id=\"dialog-export-livraison\" title=\"Export du bon de livraison du Marché n°{comNumero}\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Format de sortie : </td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.bonDeLivraison =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-editer-com\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Bon de Livraison du Marché n°{comNumero}" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-bcom\" title=\"Exporter le bon de livraison\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
					"</span>" +
				"</span>" +
				"</div>" +
				"<div>" +
					"<form>" +
						"<span>Producteur : " +
							"<select id=\"select-prdt\">" +
								"<option value=\"0\" >== Choisir un producteur ==</option>" +
								"<!-- BEGIN producteurs -->" +
								"<option value=\"{producteurs.prdtId}\">{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
								"<!-- END producteurs -->" +
							"</select>" +
						"</span>" +
					"</form>" +
				"</div>" +
				"<div id=\"liste-pdt\"></div>" +	
			"</div>" +
		"</div>";
	
	this.listeProduitLivraison = 
		"<div id=\"liste-pdt\">" +
			"<table class=\"com-table\">" +
				"<thead>" +
					"<tr>" +
						"<th>Produit</th>" +
						"<th>Réservation</th>" +
						"<th>Commande</th>" +
						"<th>Prix</th>" +
						"<th>Livraison</th>" +
						"<th>Prix</th>" +
						"<th>Solidaire</th>" +
						"<th>État</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
					"<!-- BEGIN produits -->" +
					"<tr>" +
						"<td>{produits.nproNom}</td>" +
						"<td>{produits.stoQuantite} {produits.proUniteMesure}</td>" +
						"<td>{produits.stoQuantiteCommande} {produits.proUniteMesure}</td>" +
						"<td>{produits.opeMontantCommande} {sigleMonetaire}</td>" +
						"<td><span class=\"pro-id pro-id-etat ui-helper-hidden\">{produits.proId}</span><input class=\"input-bon-livraison qte-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qte-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.stoQuantiteLivraison}\" id=\"produits{produits.proId}quantite\"/> {produits.proUniteMesure}</td>" +
						"<td><input class=\"input-bon-livraison prix-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.opeMontantLivraison}\" id=\"produits{produits.proId}prix\" /> {sigleMonetaire}</td>" +
						"<td><span class=\"pro-id-etat ui-helper-hidden\">{produits.proId}</span><input " +
							"class=\"qte-solidaire-commande input-bon-livraison com-numeric com-input-text ui-widget-content ui-corner-all\" " +
							"type=\"text\" " +
							"name=\"qte-solidaire-commande-{produits.proId}\" " +
							"maxlength=\"11\" " +
							"value=\"{produits.stoQuantiteSolidaire}\" " +
							"id=\"produits{produits.proId}quantiteSolidaire\" /> {produits.proUniteMesure}" +
						"</td>" +
						"<td><div id=\"etat-commande-{produits.proId}\" class=\"{produits.classEtat} ui-corner-all\"></div></td>" +
					"</tr>" +
					"<!-- END produits -->" +
				"</tbody>" +
				"<tfoot>" +
					"<tr>" +
						"<td colspan=\"2\"></td>" +
						"<td>Total :</td>" +
						"<td>{totalCommande} {sigleMonetaire}</td>" +
						"<td></td>" +
						"<td><input class=\"input-bon-livraison com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"total\" maxlength=\"11\" value=\"{total}\" id=\"total\" /> {sigleMonetaire}</td>" +
						"<td>" +
							"<select name=\"typepaiement\" id=\"typePaiement\">" +
								"<option value=\"0\">== Choisir le paiement ==</option>" +
								"<!-- BEGIN typePaiement -->" +
								"<option value=\"{typePaiement.tppId}\">{typePaiement.tppType}</option>" +
								"<!-- END typePaiement -->" +
							"</select>" +
						"</td>" +
					"</tr>" +
					"<tr id=\"tr-champ-complementaire\">" +
						"<td colspan=\"5\"></td>" +
						"<td><span id=\"label-champ-complementaire\" ></span></td>" +
						"<td><input type=\"text\" name=\"champ-complementaire\" value=\"{champComplementaire}\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"typePaiementChampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
					"</tr>" +
				"</tfoot>" +
			"</table>" +
			"<div class=\"com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button\" id=\"btn-enregistrer\">Enregistrer</button>" +
			"</div>" +
		"</div>";
	
	this.infoCommandeArchive =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Détail du Marché n°{numero}" +
				"</div>" +
				"<div>" +
					"<div class=\"com-center\" id=\"resultat-marche-archive\">" +
						"<span class=\"ui-widget ui-widget-header com-table-th\">Résultat Zeybu Marché : {total} {sigleMonetaire}</span>    " +
						"<span class=\"ui-widget ui-widget-header com-table-th\">Résultat Zeybu Solidaire : {totalSolidaire} {sigleMonetaire}</span>" +
					"</div>" +
					"<table class=\"com-table\" id=\"info-marche-archive\">" +
						"<thead>" +
							"<tr>" +
								"<th></th>" +
								"<th class=\"com-table-th ui-widget ui-widget-header\" colspan=\"5\">Achat</th>" +
								"<th class=\"com-table-th ui-widget ui-widget-header\" colspan=\"4\">Vente</th>" +
							"</tr>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Produit</th>" +
								"<th class=\"com-table-th\">Qté Commande</th>" +
								"<th class=\"com-table-th\">Prix Commande</th>" +
								"<th class=\"com-table-th\">Qté Livraison</th>" +
								"<th class=\"com-table-th\">Prix Livraison</th>" +
								"<th class=\"com-table-th\">Qté Solidaire</th>" +
								"<th class=\"com-table-th\">Qté Vente</th>" +
								"<th class=\"com-table-th\">Prix Vente</th>" +
								"<th class=\"com-table-th\">Qté Solidaire</th>" +
								"<th class=\"com-table-th\">Prix Solidaire</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN infoCommande -->" +
							"<tr>" +
								"<td class=\"com-table-td\">{infoCommande.nproNom}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantite} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontant} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteLivraison} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantLivraison} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteSolidaire} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteVente} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantVente} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteVenteSolidaire} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantVenteSolidaire} {sigleMonetaire}</td>" +
							"</tr>" +
							"<!-- END infoCommande -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
}
;function CommunTemplate() {
	this.debutContenu = "<div id=\"contenu\">";
	this.finContenu = "</div>";
};function GestionAdherentsTemplate() {
	this.formulaireAjoutAdherent =
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_modifier_adherent_int\">" +
				"<form>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Information de l'adhérent</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nom *</th>" +
									"<td class=\"com-table-form-td\">" +
										"<input type=\"hidden\" name=\"{NAME_ID}\" value=\"{VALUE_ID}\" />" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" value=\"{nom}\" maxlength=\"50\" id=\"nom\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Prénom *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prenom\" value=\"{prenom}\" maxlength=\"50\" id=\"prenom\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Mot de Passe *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Resaisir le mot de Passe *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Date de Naissance (jj/mm/aaaa)</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_naissance\" value=\"{dateNaissance}\" maxlength=\"10\" id=\"dateNaissance\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Date d'adhésion (jj/mm/aaaa) *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_adhesion\" value=\"{dateAdhesion}\" maxlength=\"10\" id=\"dateAdhesion\" /></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Lier un compte<input type=\"checkbox\" name=\"lien_numero_compte\" /></th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"numero_compte\" value=\"{compte}\" maxlength=\"5\" disabled=\"disabled\" id=\"compte\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Commentaire</th>" +
									"<td class=\"com-table-form-td\"><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"commentaire\" id=\"commentaire\">{commentaire}</textarea></td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
					
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées de l'adhérent</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Courriel Principal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"courriel_principal\" value=\"{courrielPrincipal}\" maxlength=\"100\" id=\"courrielPrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Courriel Secondaire</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" ype=\"text\" name=\"courriel_secondaire\" value=\"{courrielSecondaire}\" maxlength=\"100\" id=\"courrielSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Téléphone Principal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_principal\" value=\"{telephonePrincipal}\" maxlength=\"20\" id=\"telephonePrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Téléphone Secondaire</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_secondaire\" value=\"{telephoneSecondaire}\" maxlength=\"20\" id=\"telephoneSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Adresse</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"adresse\" value=\"{adresse}\" maxlength=\"300\" id=\"adresse\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Code Postal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"code_postal\" value=\"{codePostal}\" maxlength=\"10\" id=\"codePostal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Ville</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"ville\" value=\"{ville}\" maxlength=\"100\" id=\"ville\"/></td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\"> Autorisations</div>" +
						"<div class=\"com-widget-content\">" +
							"<table id=\"formulaire-modifier-adherent-table-autorisation\" class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Modules autorisés</th>" +
								"</tr>" +
							"<!-- BEGIN modules -->" +
								"<tr class=\"ui-widget-content\" >" +
									"<td class=\"com-table-form-td\" ><input type=\"checkbox\" name=\"modules[]\" value=\"{modules.id}\" {modules.checked} />{modules.label}</td>" +
								"</tr>" +
							"<!-- END modules -->" +
								"<tr>" +
									"<td class=\"com-center com-ligne-submit\">" +
										"<input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Valider\" />" +
									"</td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.ajoutAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Nouvel Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.modifierAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification d'Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été mis à jour avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.supprimerAdherentSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Suppression d'Adhérent" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>L'adhérent {numero} a été supprimé avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
		
	this.listeAdherent = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +
			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Adhérents</div>" +
						"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
							"<form id=\"filter-form\">" +
								"<div>" +
									"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
											"<span class=\"ui-icon ui-icon-search\">" +
										"</span>" +
									"</span>" +
									"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
								
									/*"<input class=\"com-input-text ui-widget-content ui-corner-left\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
									"<span class=\"ui-widget-content ui-corner-right liste-adh-span-rech-right\">" +
										"<span class=\"ui-icon ui-icon-search\"></span>" +
									"</span>" +*/
								"</div>" +
							"</form>" +
						"</div>" +
						//"<div id=\"widget-liste-adherent\" class=\"com-widget-content ui-widget ui-corner-all\">" +
							"<table class=\"com-table\">" +
								"<thead>" +
									"<tr class=\"ui-widget ui-widget-header\">" +
										"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
										"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
										"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
										"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Courriel</th>" +
										"<th class=\"com-table-th liste-adh-th-solde\">Solde</th>" +
									"</tr>" +
								"</thead>" +
								"<tbody>" +
							"<!-- BEGIN listeAdherent -->" +
									"<tr class=\"com-cursor-pointer compte-ligne\" >" +
										"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherent.adhId}</span>{listeAdherent.adhNumero}</td>" +
										"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhNom}</td>" +
										"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhPrenom}</td>" +
										"<td class=\"com-table-td com-underline-hover\">{listeAdherent.adhCourrielPrincipal}</td>" +
										"<td class=\"com-table-td com-underline-hover liste-adh-td-solde\"><span class=\"{listeAdherent.classSolde}\">{listeAdherent.opeMontant} {sigleMonetaire}</span></td>" +
									"</tr>" +
							"<!-- END listeAdherent -->" +
								"</tbody>" +
							"</table>" +
						//"</div>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Adhérents</div>" +
				"<p id=\"texte-liste-vide\">Aucun adhérent dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogSuppressionAdherent =
	"<div id=\"dialog-supp-adh\" title=\"Supprimer l'adhérent {adhNumero}\">" +
		"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer l'adherent : {adhNumero}</p>" +
	"</div>";
	
	this.infoCompteAdherentDebut =		
		"<div id=\"info_compte_solde_adherent_ext\">" +
			"<div id=\"info_compte_solde_adherent_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer\" id=\"btn-supp\" title=\"Supprimer\">" +
							"<span class=\"ui-icon ui-icon-trash\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer\" id=\"btn-edt\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Numéro d'adhérent : {adhNumero}</div>" +
						"<div>Numéro de Compte : {cptLabel}</div>" +
						"<div>Nom : {adhNom}</div>" +
						"<div>Prénom : {adhPrenom}</div>" +
						"<div>Date de naissance : {adhDateNaissance}</div>" +
						"<div>Date d'adhésion : {adhDateAdhesion}</div>" +
						"<div>Commentaire : {adhCommentaire}</div>" +
					"</div>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Courriel Principal : {adhCourrielPrincipal}</div>" +
						"<div>Courriel Secondaire : {adhCourrielSecondaire}</div>" +
						"<div>Téléphone Principal : {adhTelephonePrincipal}</div>" +
						"<div>Téléphone Secondaire : {adhTelephoneSecondaire}</div>" +
						"<div>Adresse : {adhAdresse}</div>" +				
						"<div>Ville : {adhVille}</div>" +
						"<div>Code Postal : {adhCodePostal}</div>" +
					"</div>" +
				"</div>";
				
	this.infoCompteAdherentAutorisation = 
				"<div id=\"info_compte_autorisations_int\">" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Autorisations</div>" +
						"<div class=\"com-widget-content\">" +
							"<!-- BEGIN modules -->" +
								"<div><span class=\"com-float-left ui-icon {modules.classAutorisation}\"></span>{modules.label}</div>" +
							"<!-- END modules -->" +
						"</div>" +
					"</div>" +
				"</div>";
	
	
	this.infoCompteAdherentFin = 		
			"</div>" +
		"</div>";
		
	this.listeOperationPassee = 
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Solde : <span id=\"solde\">{opeMontant} {sigleMonetaire}</span></div>	" +	
				"<div>" +				
					"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
						"<form>" +	
						"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
						"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
						"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
						"	<input type=\"hidden\" class=\"pagesize\" value=\"10\">" +
						"</form>" +	
					"</div>" +	
		
					"<table id=\"table-operation\" class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\" >" +
							"<th class=\"com-table-th\">Date</th>" +
							"<th class=\"com-table-th\">Libellé</th>" +
							"<th class=\"com-table-th\">Type de paiement</th>" +
							"<th class=\"com-table-th\">Débit</th>" +
							"<th class=\"com-table-th\">Crédit</th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN operationPassee -->" +
						"<tr>" +
							"<td class=\"com-table-td td-date \">{operationPassee.opeDate}</td>" +
							"<td class=\"com-table-td td-libelle\">{operationPassee.opeLibelle}</td>" +
							"<td class=\"com-table-td td-type-paiement\">{operationPassee.tppType}</td>" +
							"<td class=\"com-table-td td-montant\">{operationPassee.debit}</td>" +
							"<td class=\"com-table-td td-montant\">{operationPassee.credit}</td>" +
						"</tr>" +
					"<!-- END operationPassee -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>";
		
	this.listeOperationAdherentDebut = 
		"<div id=\"liste_operation_adherent_ext\">" +
			"<div id=\"liste_operation_adherent_int\">";
				
	this.listeOperationAdherentFin = 		
			"</div>" +
		"</div>";	
		
	this.listeOperationAvenir = 
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat(s) Futur(s)</div>" +
				"<div>" +
					"<table class=\"com-table\">" +
						"<tr class=\"ui-widget ui-widget-header\" >" +
							"<th class=\"com-table-th\">Réservation</th>" +
							"<th class=\"com-table-th\">Libellé</th>" +
							"<th class=\"com-table-th\">Marché</th>" +
							"<th class=\"com-table-th\">Prix</th>" +
							"<th class=\"com-table-th\">Solde</th>" +
							"<th class=\"com-table-th\">Recharger</th>" +
						"</tr>" +
					"<!-- BEGIN operationAvenir -->" +
						"<tr>" +
							"<td class=\"com-table-td td-date\">{operationAvenir.opeDate}</td>" +
							"<td class=\"com-table-td td-libelle \">{operationAvenir.opeLibelle}</td>" +
							"<td class=\"com-table-td td-date\">{operationAvenir.comDateMarche}</td>" +
							"<td class=\"com-table-td td-montant\">{operationAvenir.opeMontant}  {sigleMonetaire}</td>" +
							"<td class=\"com-table-td td-montant\"><span class=\"nouveau-solde\"><span class=\"nouveau-solde-val\">{operationAvenir.nouveauSolde}</span>  {sigleMonetaire}</span></td>" +
							"<td class=\"com-table-td td-montant\">{operationAvenir.rechargement}  {sigleMonetaire}</td>" +
						"</tr>" +
					"<!-- END operationAvenir -->" +
					"</table>" +
				"</div>" +
			"</div>";
};function IdentificationTemplate() {
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
};function MonCompteTemplate() {
	this.infoCompteAdherent = 
	"<div id=\"info_compte_solde_adherent_ext\">" +
		"<div id=\"info_compte_solde_adherent_int\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Informations" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-edt-info\" title=\"Changer le mot de passe\">" +
						"<span class=\"ui-icon ui-icon-pencil\">" +
					"</span>" +
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<div>Numéro d'adhérent : {adhNumero}</div>" +
					"<div>Numéro de Compte : {cptLabel}</div>" +
					"<div>Nom : {adhNom}</div>" +
					"<div>Prénom : {adhPrenom}</div>" +
					"<div>Date de naissance : {adhDateNaissance}</div>" +
					"<div>Date d'adhésion : {adhDateAdhesion}</div>" +
					"<div>Commentaire : {adhCommentaire}</div>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
				"<div class=\"com-widget-content\">" +
					"<div>Courriel Principal : {adhCourrielPrincipal}</div>" +
					"<div>Courriel Secondaire : {adhCourrielSecondaire}</div>" +
					"<div>Téléphone Principal : {adhTelephonePrincipal}</div>" +
					"<div>Téléphone Secondaire : {adhTelephoneSecondaire}</div>" +
					"<div>Adresse : {adhAdresse}</div>" +				
					"<div>Ville : {adhVille}</div>" +
					"<div>Code Postal : {adhCodePostal}</div>" +
				"</div>" +
			"</div>" +
		"</div>" +
	"</div>";
	
	this.dialogEditionCompte =
		"<div id=\"dialog-edt-info-cpt\" title=\"Modifier mon mot de passe\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Ancien mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nouveau mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_nouveau\" maxlength=\"100\" id=\"motPasseNouveau\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Resaisir le mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	this.listeOperationPassee = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Solde : <span id=\"solde\">{opeMontant} {sigleMonetaire}</span></div>	" +	
			"<div>" +				
				"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
					"<form>" +	
					"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
					"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
					"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
					"	<input type=\"hidden\" class=\"pagesize\" value=\"10\">" +
					"</form>" +	
				"</div>" +	
	
				"<table id=\"table-operation\" class=\"com-table\">" +
					"<thead>" +
					"<tr class=\"ui-widget ui-widget-header\" >" +
						"<th class=\"com-table-th\">Date</th>" +
						"<th class=\"com-table-th\">Libellé</th>" +
						"<th class=\"com-table-th\">Type de paiement</th>" +
						"<th class=\"com-table-th\">Débit</th>" +
						"<th class=\"com-table-th\">Crédit</th>" +
					"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN operationPassee -->" +
					"<tr>" +
						"<td class=\"com-table-td td-date \">{operationPassee.opeDate}</td>" +
						"<td class=\"com-table-td td-libelle\">{operationPassee.opeLibelle}</td>" +
						"<td class=\"com-table-td td-type-paiement\">{operationPassee.tppType}</td>" +
						"<td class=\"com-table-td td-montant\">{operationPassee.debit}</td>" +
						"<td class=\"com-table-td td-montant\">{operationPassee.credit}</td>" +
					"</tr>" +
				"<!-- END operationPassee -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeOperationAdherentDebut = 
	"<div id=\"liste_operation_adherent_ext\">" +
		"<div id=\"liste_operation_adherent_int\">";
			
	this.listeOperationAdherentFin = 		
		"</div>" +
	"</div>";	
	
	this.listeOperationAvenir = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat(s) Futur(s)</div>" +
			"<div>" +
				"<table class=\"com-table\">" +
					"<tr class=\"ui-widget ui-widget-header\" >" +
						"<th class=\"com-table-th\">Réservation</th>" +
						"<th class=\"com-table-th\">Libellé</th>" +
						"<th class=\"com-table-th\">Marché</th>" +
						"<th class=\"com-table-th\">Prix</th>" +
						"<th class=\"com-table-th\">Solde</th>" +
						"<th class=\"com-table-th\">Recharger</th>" +
					"</tr>" +
				"<!-- BEGIN operationAvenir -->" +
					"<tr>" +
						"<td class=\"com-table-td td-date\">{operationAvenir.opeDate}</td>" +
						"<td class=\"com-table-td td-libelle \">{operationAvenir.opeLibelle}</td>" +
						"<td class=\"com-table-td td-date\">{operationAvenir.comDateMarche}</td>" +
						"<td class=\"com-table-td td-montant\">{operationAvenir.opeMontant}  {sigleMonetaire}</td>" +
						"<td class=\"com-table-td td-montant\"><span class=\"nouveau-solde\"><span class=\"nouveau-solde-val\">{operationAvenir.nouveauSolde}</span>  {sigleMonetaire}</span></td>" +
						"<td class=\"com-table-td td-montant\">{operationAvenir.rechargement}  {sigleMonetaire}</td>" +
					"</tr>" +
				"<!-- END operationAvenir -->" +
				"</table>" +
			"</div>" +
		"</div>";	
};function CompteZeybuTemplate() {
	this.InfoCompte =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Le Compte du Zeybu</div>" +
				"<table id=\"table-info-solde-zeybu\">" +
					"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th id=\"td-solde-zeybu-total\" class=\"com-table-th\">Solde Total : {soldeTotal} {sigleMonetaire}</th>" +
							"<th id=\"td-solde-zeybu-caisse\" class=\"com-table-th\">Montant en Caisse : {soldeCaisse} {sigleMonetaire}</th>" +
							"<th id=\"td-solde-zeybu-banque\" class=\"com-table-th\">Montant en Banque : {soldeBanque} {sigleMonetaire}</th>" +
						"</tr>" +
					"</thead>" +
				"</table>" +				
				"<div>" +				
					"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
						"<form>" +	
						"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
						"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
						"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
						"	<input type=\"hidden\" class=\"pagesize\" value=\"30\">" +
						"</form>" +	
					"</div>" +	
		
					"<table id=\"table-operation\" class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\" >" +
							"<th class=\"com-table-th\">Date</th>" +
							"<th class=\"com-table-th\">Compte</th>" +
							"<th class=\"com-table-th\">Libellé</th>" +
							"<th class=\"com-table-th\">Type de paiement</th>" +
							"<th class=\"com-table-th\">Débit</th>" +
							"<th class=\"com-table-th\">Crédit</th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
					"<!-- BEGIN operation -->" +
						"<tr>" +
							"<td class=\"com-table-td td-date \">{operation.opeDate}</td>" +
							"<td class=\"com-table-td td-date \">{operation.cptLabel}</td>" +
							"<td class=\"com-table-td td-libelle\">{operation.opeLibelle}</td>" +
							"<td class=\"com-table-td td-type-paiement\">{operation.tppType}</td>" +
							"<td class=\"com-table-td td-montant\">{operation.debit}</td>" +
							"<td class=\"com-table-td td-montant\">{operation.credit}</td>" +
						"</tr>" +
					"<!-- END operation -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +				
			"</div>" +
		"</div>";
};function CommandeTemplate() {
	this.detailReservation = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
				"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
				"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin} <br/>" +
				"<span>Solde Actuel : </span><span>{solde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{soldeNv}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma Commande" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN reservation -->" +
					"<tr >" +
						"<td class=\"detail-resa-npro\">{reservation.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{reservation.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{reservation.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{reservation.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END reservation -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
						"<td class=\"com-text-align-right\">{total}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<div class=\"boutons-edition com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center \" id=\"btn-modifier\">Modifier</button>" +	
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-valider\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.mesCommandesDetailReservation = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
				"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
				"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma réservation" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN reservation -->" +
					"<tr >" +
						"<td class=\"detail-resa-npro\">{reservation.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{reservation.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{reservation.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{reservation.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END reservation -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
						"<td class=\"com-text-align-right\">{total}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<div class=\"boutons-edition com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-modifier\">Modifier</button>" +	
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-supprimer\">Supprimer</button>" +
			"</div>" +
		"</div>";
	
	this.supprimerReservationDialog =
		"<div id=\"dialog-supprimer-reservation\" title=\"Supprimer la réservation\">" +
			"<p>Voulez-vous supprimer la réservation ?</p>" +
		"</div>";
	
	this.reservation =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin} <br/>" +
					"<span>Solde Actuel : </span><span>{solde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{soldeNv}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma Commande" +
				"</div>" +
				"<div>" +
					"<table>" +
						"<!-- BEGIN produit -->" +
						"<tr class=\"pdt\" id=\"pdt-{produit.proId}\">" +
							"<td class=\"passer-com-radio\" ><input type=\"checkbox\" {produit.checked}/></td>" +
							"<td class=\"passer-com-radio\" ><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span></span></td>" +
							"<td colspan=\"5\" class=\"passer-com-npro\">{produit.nproNom}</td>" +
							"<td>" +
								"<span>{produit.proMaxProduitCommande}</span>" +
								" <span>{produit.proUniteMesure}</span> Max" +
							"</td>" +
							"<td colspan=\"3\"></td>" +
						"</tr>" +
						"<!-- BEGIN produit.lot -->" +
						"<tr class=\"lot lot-pdt-{produit.proId}\">" +
							"<td class=\"passer-com-radio\"><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span><span class=\"lot-id\">{produit.lot.dcomId}</span></span></td>" +
							"<td class=\"passer-com-radio\"><input type=\"radio\" name=\"lot-produit-{produit.proId}\" {produit.lot.checked}/></td>" +
							"<td class=\"com-text-align-right detail-resa-qte\">{produit.lot.dcomTaille}</td>" +
							"<td class=\"detail-resa-unite\">{produit.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right detail-resa-prix\">{produit.lot.dcomPrix}</td>" +
							"<td class=\"passer-com-sigle\" >{sigleMonetaire}</td>" +
							"<td class=\"passer-com-btn-qte\"><button class=\"btn-moins btn-pdt-{produit.proId}\" id=\"btn-moins-lot-{produit.lot.dcomId}\">-</button></td>" +
							"<td class=\"passer-com-qte\"><span id=\"colonne-qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\"><span id=\"qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"qte\">{produit.lot.stoQuantiteReservation}</span>" +
								" <span>{produit.proUniteMesure}</span></span></td>" +
							"<td class=\"passer-com-btn-qte\"><button class=\"btn-plus btn-pdt-{produit.proId}\" id=\"btn-plus-lot-{produit.lot.dcomId}\">+</button></td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"colonne-prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\"><span id=\"prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}\">{produit.lot.prixReservation}</span></span></td>" +
							"<td><span id=\"colonne-sigle-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\">{sigleMonetaire}</span></td>" +
						"</tr>" +
						"<!-- END produit.lot -->" +
						"<!-- END produit -->" +
						"<tr>" +
							"<td colspan=\"9\" class=\"com-text-align-right\">Total : </td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"total\">{total}</span></td>" +
							"<td>{sigleMonetaire}</td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-valider\">Valider</button>" +		
			"</div>" +
		"</div>";
	
	this.modifierReservation =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma réservation" +
				"</div>" +
				"<div>" +
					"<table>" +
						"<!-- BEGIN produit -->" +
						"<tr class=\"pdt\" id=\"pdt-{produit.proId}\">" +
							"<td class=\"passer-com-radio\" ><input type=\"checkbox\" {produit.checked}/></td>" +
							"<td class=\"passer-com-radio\" ><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span></span></td>" +
							"<td colspan=\"5\" class=\"passer-com-npro\">{produit.nproNom}</td>" +
							"<td>" +
								"<span>{produit.proMaxProduitCommande}</span>" +
								" <span>{produit.proUniteMesure}</span> Max" +
							"</td>" +
							"<td colspan=\"3\"></td>" +
						"</tr>" +
						"<!-- BEGIN produit.lot -->" +
						"<tr class=\"lot lot-pdt-{produit.proId}\">" +
							"<td class=\"passer-com-radio\"><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span><span class=\"lot-id\">{produit.lot.dcomId}</span></span></td>" +
							"<td class=\"passer-com-radio\"><input type=\"radio\" name=\"lot-produit-{produit.proId}\" {produit.lot.checked}/></td>" +
							"<td class=\"com-text-align-right detail-resa-qte\">{produit.lot.dcomTaille}</td>" +
							"<td class=\"detail-resa-unite\">{produit.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right detail-resa-prix\">{produit.lot.dcomPrix}</td>" +
							"<td class=\"passer-com-sigle\" >{sigleMonetaire}</td>" +
							"<td class=\"passer-com-btn-qte\"><button class=\"btn-moins btn-pdt-{produit.proId}\" id=\"btn-moins-lot-{produit.lot.dcomId}\">-</button></td>" +
							"<td class=\"passer-com-qte\"><span id=\"colonne-qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\"><span id=\"qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"qte\">{produit.lot.stoQuantiteReservation}</span>" +
								" <span>{produit.proUniteMesure}</span></span></td>" +
							"<td class=\"passer-com-btn-qte\"><button class=\"btn-plus btn-pdt-{produit.proId}\" id=\"btn-plus-lot-{produit.lot.dcomId}\">+</button></td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"colonne-prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\"><span id=\"prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}\">{produit.lot.prixReservation}</span></span></td>" +
							"<td><span id=\"colonne-sigle-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\">{sigleMonetaire}</span></td>" +
						"</tr>" +
						"<!-- END produit.lot -->" +
						"<!-- END produit -->" +
						"<tr>" +
							"<td colspan=\"9\" class=\"com-text-align-right\">Total : </td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"total\">{total}</span></td>" +
							"<td>{sigleMonetaire}</td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-annuler\">Annuler</button>" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-valider\">Valider</button>" +		
			"</div>" +
		"</div>";
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
								"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr >" +
								"<td class=\"com-table-td com-text-align-right\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td lst-resa-btn-commander\">" +
									"<button class=\"btn-commander ui-state-default ui-corner-all com-button com-center\" id=\"{commande.id}\">Commander</button>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";
	
	this.confirmationReservationCommande =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<table>" +
				"<!-- BEGIN produit -->" +
				"<tr>" +
					"<td>{produit.NOM}</td>" +
					"<td>{produit.QUANTITE}</td>" +
					"<td>{produit.PRIX}</td>" +
				"</tr>" +
				"<!-- END produit -->" +
					"<tr>" +
					"<td></td><td>Total : </td>" +
					"<td>" +
					"{TOTAL_COMMANDE}" +
					"</td>" +
				"</tr>" +
			"</table>" +
			"<div class=\"ui-helper-hidden\">" +
				"<form id=\"form-confirmation-reservation-commande\">" +
					"<table>" +
						"<tr>" +
							"<td>" +
							"<input type=\"text\" name=\"id_commande\" value=\"{ID_COMMANDE}\" />" +
							"</td>" +
							"</tr>" +
						"<!-- BEGIN info_produit -->" +
						"<tr>" +
							"<td><input type=\"text\" name=\"id_pdt[]\" value=\"{info_produit.IDPDT}\" /></td>" +
							"<td><input type=\"text\" name=\"id_lot[]\" value=\"{info_produit.IDLOT}\" /></td>" +
							"<td><input type=\"text\" name=\"qte[]\" value=\"{info_produit.QTE}\" /></td>" +
						"</tr>" +
						"<!-- END info_produit -->" +								
					"</table>" +
				"</form>" +
			"</div>"+
		"</div>";
	
	this.reservationOk = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Réservation</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Réservation effectuée avec succés.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeCommandeVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
			"</div>" +
		"</div>";

	this.listeReservation =
	"<div id=\"contenu\">" +
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Mes Réservations" +
			"</div>" +
			"<table class=\"com-table\">" +
				"<tr class=\"ui-widget ui-widget-header\">" +
					"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
					"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
					"<th class=\"com-table-th\">Marché</th>	" +
				"</tr>" +
				"<!-- BEGIN reservation -->" +
				"<tr class=\"com-cursor-pointer visualiser-reservation\" id={reservation.idCommande} >" +
					"<td class=\"com-table-td com-underline-hover com-text-align-right\">{reservation.numero}</td>" +
					"<td class=\"com-table-td com-underline-hover\">Le {reservation.dateFinReservation} à {reservation.heureFinReservation}H{reservation.minuteFinReservation}</td>" +
					"<td class=\"com-table-td com-underline-hover\">Le {reservation.dateMarcheDebut} de {reservation.heureMarcheDebut}H{reservation.minuteMarcheDebut} à {reservation.heureMarcheFin}H{reservation.minuteMarcheFin}</td>" +
				"</tr>" +
				"<!-- END reservation -->" +
			"</table>" +	
		"</div>" +
		"<div class=\"ui-helper-hidden com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
			"<button class=\"ui-state-default ui-corner-all com-button com-center\">Anciennes commandes</button>" +		
		"</div>" +
	"</div>";	
	
	this.listeReservationVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Mes Réservations</div>" +
				"<p id=\"texte-liste-vide\">Aucune réservation en cours.</p>" +	
			"</div>" +
			"<div class=\"ui-helper-hidden com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\">Anciennes commandes</button>" +		
			"</div>" +
		"</div>";
}/********** Début Variables Globales ************/
const gTempsTransition = 150;
const gTempsTransitionUnique = gTempsTransition * 2;
const gTempsTransitionMsgInfo = gTempsTransition * 10;
// TODO mettre le sigle en lien avec le fichier de configuration
const gSigleMonetaire = "€";

const gTextEdition = "Editer";
const gTextValider = "Valider";

var TemplateData = new TemplateData();
var Infobulle = new Infobulles();
var gCommunVue = new CommunVue(); // TODO Renommer en CommunVue et utiliser cette classe dans toutes les vues

/********** Fin Variables Globales ************/

$(document).ready(function() {
	
	// Affichage des infobulles pour les erreurs	
	$("#widget_message_information").click(function() {$(this).delay(gTempsTransition).fadeOut(gTempsTransitionUnique);});
	
	$("#loading").ajaxStart( function() {$(this).fadeIn(gTempsTransition)} );
	$("#loading").ajaxStop( function() {$(this).fadeOut(gTempsTransition);} );

});;function CommunVue() {
	
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
	
	this.comDatepicker = function(pIdDate,pData) {
		$.datepicker.setDefaults($.datepicker.regional['fr']);
		pData.find('#' + pIdDate).datepicker({
			changeMonth: true,
			changeYear: true});
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
	
	this.comHoverBtn = function(pData) {
		pData.find(	".com-button:not(.ui-state-disabled)," +
					".com-btn-header:not(.ui-state-disabled)," +
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
	}
};function ListeProducteurVue(pParam) {
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}	
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		
		if(lResponse.listeProducteur.length > 0 && lResponse.listeProducteur[0].prdtId != null) {
			var lTemplate = lGestionProducteurTemplate.listeProducteur;
						
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(lGestionProducteurTemplate.listeProducteurVide);
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]]});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}
			
	this.affectLienCompte = function(pData) {
		var that = this;
		pData.find(".compte-ligne").click(function() {
			CompteProducteurVue({id_producteur: $(this).find(".id-producteur").text()});
		});
		return pData;
	}
	
	this.construct(pParam);
};function CompteProducteurVue(pParam) {
	this.mIdProducteur = null;
	this.mPrdtNumero = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=CompteProducteur", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		this.mIdProducteur = lResponse.producteur.prdtId;
		this.mPrdtNumero = lResponse.producteur.prdtNumero;
		lResponse.producteur.prdtDateNaissance = lResponse.producteur.prdtDateNaissance.extractDbDate().dateDbToFr();
		
		$(lResponse.operationPassee).each(function() {
			this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
			if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
			if(this.opeMontant < 0) {
				this.credit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				this.debit = '';
			} else {
				this.credit = '';
				this.debit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
			}
		});
						
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lCommunTemplate = new CommunTemplate();
		
		var lHtml = lCommunTemplate.debutContenu;		
		lHtml += lGestionProducteurTemplate.infoCompteProducteur.template(lResponse.producteur);
		lHtml += lGestionProducteurTemplate.listeOperationProducteur.template(lResponse);
		lHtml += lCommunTemplate.finContenu;		
		lHtml = $(lHtml);
				
		// Ne pas afficher la pagination si il y a moins de 10 éléments
		if(lResponse.operationPassee.length < 11) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}		

		$('#contenu').replaceWith(that.affect(lHtml));	
	}
	
	this.affect = function(pData) {
		pData = this.affectHover(pData);
		pData = this.affectLienModifier(pData);
		pData = this.affectDialogSuppProducteur(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false}); 
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	}
		
	this.affectLienModifier = function(pData) {
		var that = this;
		pData.find('#btn-edt').click(function() {			
			ModificationProducteurVue({id_producteur:that.mIdProducteur});
		});
		return pData;
	}
	
	this.affectDialogSuppProducteur = function(pData) {		
		var that = this;
		pData.find('#btn-supp')
		.click(function() {
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogSuppressionProducteur;
			
			$(lTemplate.template({prdtNumero:that.mPrdtNumero})).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {id_producteur:that.mIdProducteur};
						var lDialog = this;
						$.post(	"./index.php?m=GestionProducteur&v=SuppressionProducteur", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										var lGestionProducteurTemplate = new GestionProducteurTemplate();
										var lTemplate = lGestionProducteurTemplate.supprimerProducteurSucces;
										$('#contenu').replaceWith(lTemplate.template(lResponse));
										$(lDialog).dialog('close');
									} else {
										Infobulle.generer(lResponse,'');
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
	}
		
	this.construct(pParam);
};function ModificationProducteurVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdProducteur = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=ModificationProducteur", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mIdProducteur = pParam.id_producteur;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function(lResponse) {
		var that = this;
		lResponse.dateNaissance = lResponse.dateNaissance.extractDbDate().dateDbToFr();	
		
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lTemplate = lGestionProducteurTemplate.formulaireAjoutProducteur;
		var lHtml = lTemplate.template(lResponse);
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
	}
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.boutonLienCompte = function(pData) {		
		pData.find(":input[name=lien_numero_compte]").click(function() {
			if(pData.find(":input[name=numero_compte]").attr("disabled")) {
				pData.find(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				pData.find(":input[name=numero_compte]").attr("disabled","disabled");				
			}			
		});
		return pData;
	}	
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comDatepicker('dateNaissance',pData);
		return pData;
	}
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.modifProducteur();
			return false;
		});
		return pData;
	}
	
	this.modifProducteur = function() {
		var lVo = new ProducteurVO();
		lVo.id = this.mIdProducteur;
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.compte = $(':input[name=numero_compte]').val();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'Producteur
			$.post(	"./index.php?m=GestionProducteur&v=ModificationProducteur", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionProducteurTemplate = new GestionProducteurTemplate();
						var lTemplate = lGestionProducteurTemplate.modifierProducteurSucces;
						$('#contenu').replaceWith(lTemplate.template(lResponse));						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
};function AjoutProducteurVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {	
		if(pParam && pParam.vr) {
			Infobulle.generer(pParam.vr,'');
		}
		this.afficher();
	}
	
	this.afficher = function() {
		var that = this;			
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lTemplate = lGestionProducteurTemplate.formulaireAjoutProducteur;
		$('#contenu').replaceWith(that.affect($(lTemplate.template())));
	}
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.boutonLienCompte = function(pData) {		
		pData.find(":input[name=lien_numero_compte]").click(function() {
			if(pData.find(":input[name=numero_compte]").attr("disabled")) {
				pData.find(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				pData.find(":input[name=numero_compte]").attr("disabled","disabled").val("");				
			}			
		});
		return pData;
	}	
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comDatepicker('dateNaissance',pData);
		return pData;
	}
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.ajoutProducteur();
			return false;
		});
		return pData;
	}
	
	this.ajoutProducteur = function() {
		var lVo = new ProducteurVO();
		
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.compte = $(':input[name=numero_compte]').val();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout du Producteur
			$.post(	"./index.php?m=GestionProducteur&v=AjoutProducteur", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionProducteurTemplate = new GestionProducteurTemplate();
						var lTemplate = lGestionProducteurTemplate.ajoutProducteurSucces;
						$('#contenu').replaceWith(lTemplate.template(lResponse));						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
};function MenuVue(pParam) {
	this.mMenuTemplate = new IdentificationTemplate();

	this.construct = function(pParam) {
		
		var that = this;	
		$.post(	"./index.php?m=Identification&v=Menu", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
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
			
			pData.find('#menu-Commande-MesCommandes').click(function() {
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
	
	this.construct(pParam);
};function AdministrationVue(pParam) {
	
	this.construct = function(pParam) {
		var that = this;	
		$.post(	"./index.php?m=Identification&v=Administration", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
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
			
			pData.find('#menu-GestionCommande-AjoutCommande').click(function() {
				AjoutCommandeVue();
				return false;
			});
			
			pData.find('#menu-GestionCommande-ListeCommande').click(function() {
				GestionListeCommandeVue();
				return false;
			});	
			
			pData.find('#menu-GestionProducteur-AjoutProducteur').click(function() {
				AjoutProducteurVue();
				return false;
			});
			
			pData.find('#menu-GestionProducteur-ListeProducteur').click(function() {
				ListeProducteurVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-CompteZeybu').click(function() {
				CompteZeybuVue();
				return false;
			});
				
			return pData;
		}
		return null;
	}
	
	
	this.construct(pParam);
}	;function IdentificationVue(pParam) {

	this.construct = function(pParam) {	
		if(pParam && pParam.vr) {
			Infobulle.generer(pParam.vr,'');
		}	
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
	
	this.construct(pParam);
}
	
$(document).ready(function() {	
	IdentificationVue();
});;function AjoutAdherentVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionAdherents&v=AjoutAdherent", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function(lResponse) {
		var that = this;
		
		$(lResponse.modules).each(function() {
			if(this.defaut == 1) {
				this.checked = "checked=\"checked\"";
			}
		});		
		
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		var lTemplate = lGestionAdherentsTemplate.formulaireAjoutAdherent;
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
	}
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.boutonLienCompte = function(pData) {		
		pData.find(":input[name=lien_numero_compte]").click(function() {
			if(pData.find(":input[name=numero_compte]").attr("disabled")) {
				pData.find(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				pData.find(":input[name=numero_compte]").attr("disabled","disabled").val("");				
			}			
		});
		return pData;
	}	
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('dateNaissance','dateAdhesion',pData);
		return pData;
	}
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.ajoutAdherent();
			return false;
		});
		return pData;
	}
	
	this.ajoutAdherent = function() {
		var lVo = new AdherentVO();
		lVo.motPasse = $(':input[name=pass]').val();
		lVo.motPasseConfirm = $(':input[name=pass_confirm]').val();
		lVo.compte = $(':input[name=numero_compte]').val();
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		$(':input[name=modules[]]:checked').each(function() {lVo.modules.push($(this).val())});

		var lValid = new AdherentValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionAdherents&v=AjoutAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
						var lTemplate = lGestionAdherentsTemplate.ajoutAdherentSucces;
						$('#contenu').replaceWith(lTemplate.template(lResponse));						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
};function CompteAdherentVue(pParam) {
	this.mIdAdherent = null;
	this.mAdhNumero = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionAdherents&v=CompteAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		this.mIdAdherent = lResponse.adherent.adhId;
		this.mAdhNumero = lResponse.adherent.adhNumero;
		
		lResponse.opeMontant = lResponse.adherent.opeMontant.nombreFormate(2,',',' ');
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		lResponse.adherent.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lResponse.adherent.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		
		$(lResponse.operationPassee).each(function() {
			this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
			if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
			if(this.opeMontant < 0) {
				this.debit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				this.credit = '';
			} else {
				this.debit = '';
				this.credit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
			}
		});
		
		var lNvSolde = parseFloat(lResponse.adherent.opeMontant);
		var lRechargementPrecedent = 0;
		$(lResponse.operationAvenir).each(function() {
			if(this.opeDate != null) {
				lNvSolde += parseFloat(this.opeMontant);
				this.nouveauSolde = lNvSolde.nombreFormate(2,',',' ');
				this.rechargement = (0).nombreFormate(2,',',' ');				
				var lSoldeCible = 5;
				if(lNvSolde < lSoldeCible) {
					this.rechargement = (Math.ceil((lSoldeCible-lNvSolde)/lSoldeCible) * lSoldeCible) - lRechargementPrecedent;
				}
				lRechargementPrecedent += this.rechargement;
				this.rechargement = this.rechargement.nombreFormate(2,',',' ');
				
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.comDateMarche = this.comDateMarche.extractDbDate().dateDbToFr();
				this.opeMontant = (this.opeMontant * -1).nombreFormate(2,',',' ');
			}
		});	
		
		$(lResponse.modules).each(function() {
			//alert(this.nom);
			var that = this;
			this.classAutorisation = "ui-icon-closethick";
			$(lResponse.autorisations).each(function() {
				if(this.idModule == that.id) {
					that.classAutorisation = "ui-icon-check";
				}
			});
		});		
				
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		var lCommunTemplate = new CommunTemplate();
		//var lTemplate = lMonCompteTemplate.monCompte;
		
		var lHtml = lCommunTemplate.debutContenu;		
		lHtml += lGestionAdherentsTemplate.infoCompteAdherentDebut.template(lResponse.adherent);
		lHtml += lGestionAdherentsTemplate.infoCompteAdherentAutorisation.template(lResponse);
		lHtml += lGestionAdherentsTemplate.infoCompteAdherentFin.template(lResponse);
		lHtml += lGestionAdherentsTemplate.listeOperationAdherentDebut.template(lResponse);
		lHtml += lGestionAdherentsTemplate.listeOperationPassee.template(lResponse);
		// Affiche des opérations avenir uniquement si elles existent
		if(isArray(lResponse.operationAvenir) && lResponse.operationAvenir[0].opeLibelle != null) {
			lHtml += lGestionAdherentsTemplate.listeOperationAvenir.template(lResponse);
		}
		lHtml += lGestionAdherentsTemplate.listeOperationAdherentFin.template(lResponse);
		lHtml += lCommunTemplate.finContenu;
		
		lHtml = $(lHtml);
		if(lResponse.adherent.opeMontant < 0) {
			lHtml = this.soldeNegatif(lHtml);
		}
		
		// Ne pas afficher la pagination si il y a moins de 10 éléments
		if(lResponse.operationPassee.length < 11) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}		

		$('#contenu').replaceWith(that.affect(lHtml));	
	}
	
	this.affect = function(pData) {
		pData = this.nouveauSoldeNegatif(pData);
		pData = this.affectHover(pData);
		pData = this.affectLienModifier(pData);
		pData = this.affectDialogSuppAdherent(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false}); 
		return pData;
	}
	
	this.nouveauSoldeNegatif = function(pData) {
		pData.find('.nouveau-solde-val').each(function() {
			if(parseFloat($(this).text().numberFrToDb()) < 0 ) {
				$(this).closest('.nouveau-solde').addClass("com-nombre-negatif");
			}
		});
		return pData;
	}
	
	this.soldeNegatif = function(pData) {
		pData.find('#solde').addClass("com-nombre-negatif");
		return pData;
	}
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.affectLienModifier = function(pData) {
		var that = this;
		pData.find('#btn-edt').click(function() {			
			ModificationAdherentVue({id_adherent:that.mIdAdherent});
		});
		return pData;
	}
	
	this.affectDialogSuppAdherent = function(pData) {
		var that = this;
		pData.find("#btn-supp").click(function() {
			var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
			var lTemplate = lGestionAdherentsTemplate.dialogSuppressionAdherent;
			
			$(lTemplate.template({adhNumero:that.mAdhNumero})).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {id_adherent:that.mIdAdherent};
						var lDialog = this;
						$.post(	"./index.php?m=GestionAdherents&v=SuppressionAdherent", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
										var lTemplate = lGestionAdherentsTemplate.supprimerAdherentSucces;
										$('#contenu').replaceWith(lTemplate.template(lResponse));
										$(lDialog).dialog('close');
									} else {
										Infobulle.generer(lResponse,'');
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
	}
		
	this.construct(pParam);
};function ListeAdherentVue(pParam) {
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionAdherents&v=ListeAdherent", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		
		if(lResponse.listeAdherent.length > 0 && lResponse.listeAdherent[0].adhId != null) {
			var lTemplate = lGestionAdherentsTemplate.listeAdherent;
			
			lResponse.sigleMonetaire = gSigleMonetaire;
			$(lResponse.listeAdherent).each(function() {
				this.classSolde = '';
				if(this.opeMontant < 0){this.classSolde = "com-nombre-negatif";}
				this.opeMontant = this.opeMontant.nombreFormate(2,',',' ');
			});
			
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(lGestionAdherentsTemplate.listeAdherentVide);
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}
			
	this.affectLienCompte = function(pData) {
		var that = this;
		pData.find(".compte-ligne").click(function() {
			CompteAdherentVue({id_adherent: $(this).find(".id-adherent").text()});
		});
		return pData;
	}
	
	this.construct(pParam);
};function ModificationAdherentVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdAdherent = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mIdAdherent = pParam.id_adherent;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function(lResponse) {
		var that = this;
		
		lResponse.dateAdhesion = lResponse.dateAdhesion.extractDbDate().dateDbToFr();
		lResponse.dateNaissance = lResponse.dateNaissance.extractDbDate().dateDbToFr();
		
		$(lResponse.autorisations).each(function() {
			var lIdModule = this.idModule;
			$(lResponse.modules).each(function() {
				if(this.id == lIdModule) {
					this.checked = "checked=\"checked\"";
				}
			});
		});		
		
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		var lTemplate = lGestionAdherentsTemplate.formulaireAjoutAdherent;
		var lHtml = lTemplate.template(lResponse);
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
	}
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.boutonLienCompte = function(pData) {		
		pData.find(":input[name=lien_numero_compte]").click(function() {
			if(pData.find(":input[name=numero_compte]").attr("disabled")) {
				pData.find(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				pData.find(":input[name=numero_compte]").attr("disabled","disabled");				
			}			
		});
		return pData;
	}	
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('dateNaissance','dateAdhesion',pData);
		return pData;
	}
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.modifAdherent();
			return false;
		});
		return pData;
	}
	
	this.modifAdherent = function() {
		var lVo = new AdherentVO();
		lVo.id = this.mIdAdherent;
		lVo.motPasse = $(':input[name=pass]').val();
		lVo.motPasseConfirm = $(':input[name=pass_confirm]').val();
		lVo.compte = $(':input[name=numero_compte]').val();
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		$(':input[name=modules[]]:checked').each(function() {lVo.modules.push($(this).val())});

		var lValid = new AdherentValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
						var lTemplate = lGestionAdherentsTemplate.modifierAdherentSucces;
						$('#contenu').replaceWith(lTemplate.template(lResponse));						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
};function CompteZeybuVue(pParam) {	
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=CompteZeybu&v=CompteZeybu", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		if(lResponse.soldeTotal != null) {
			lResponse.soldeTotal = lResponse.soldeTotal.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeTotal = '0'.nombreFormate(2,',',' ');
		}
		if(lResponse.soldeCaisse != null) {
			lResponse.soldeCaisse = lResponse.soldeCaisse.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeCaisse = '0'.nombreFormate(2,',',' ');
		}
		if(lResponse.soldeBanque != null) {
			lResponse.soldeBanque = lResponse.soldeBanque.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeBanque = '0'.nombreFormate(2,',',' ');
		}
		
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		$(lResponse.operation).each(function() {
			if(this.opeDate != null) {
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
				if(this.opeMontant < 0) {
					this.debit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
					this.credit = '';
				} else {
					this.debit = '';
					this.credit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				}
			}
		});
				
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.InfoCompte;
		
		var lHtml = $(lTemplate.template(lResponse));

		// Ne pas afficher la pagination si il y a moins de 30 éléments
		if(lResponse.operation.length < 31) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}
		
		$('#contenu').replaceWith(that.affect(lHtml));
	}
	
	this.affect = function(pData) {
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false,size:30}); 
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.construct(pParam);
};function GestionListeCommandeVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		if(lResponse.listeCommande.length > 0 && lResponse.listeCommande[0].comId != null) {
		
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = new Object();
					lCommande.id = this.comId;
					lCommande.numero = this.comNumero;
					lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
	
					lListeCommande.commande.push(lCommande);
				});
			
			var lTemplate = lGestionCommandeTemplate.listeCommandePage;
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeCommande))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionCommandeTemplate.listeCommandeVide)));
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectLienEditer(pData);
		pData = this.affectLienMarche(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectLienListeCommandeArchive(pData);
		return pData;
	}
	
	this.affectLienEditer = function(pData) {
		pData.find('.btn-editer').click(function() {
			var lparam = {"id_commande":$(this).attr('id')};
			EditerCommandeVue(lparam);
		});
		return pData;
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.btn-marche').click(function() {
			var lparam = {"id_commande":$(this).attr('id')};
			MarcheCommandeVue(lparam);
		});
		return pData;
	}
	
	this.affectLienListeCommandeArchive = function(pData) {
		pData.find('#lien-marche-archive').click(function() {
			ListeCommandeArchiveVue();
		});
		return pData;
	}
	
	this.construct(pParam);
};function ModifierCommandeVue(pParam) {
	
	this.etapeCreationCommande = 0;
	this.mEditionEnCours = 0;
	this.mListeProducteurs = null;
	this.mCommunVue = new CommunVue();
	this.commande = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ModifierCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}						
							// Pas d'affichage si il n' a pas de producteur en base
							if(lResponse.producteurs[0].prdtId == null) {
								lResponse.producteurs = [];
							}
							that.mListeProducteurs = lResponse.producteurs;
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
				);		
	}
	
	this.afficher = function(pResponse) {
		var that = this;

		var lInfoCommande = pResponse.commande[0];
		pResponse.sigleMonetaire = gSigleMonetaire;
		pResponse.comId = lInfoCommande.comId;
		pResponse.comNom = lInfoCommande.comNom;
		pResponse.comNumero = lInfoCommande.comNumero;
		pResponse.comDescription = lInfoCommande.comDescription;
		pResponse.dateTimeFinReservation = lInfoCommande.comDateFinReservation.extractDbDate().dateDbToFr();
		pResponse.heureFinReservation = lInfoCommande.comDateFinReservation.extractDbHeure();
		pResponse.minuteFinReservation = lInfoCommande.comDateFinReservation.extractDbMinute();
		pResponse.dateMarcheDebut = lInfoCommande.comDateMarcheDebut.extractDbDate().dateDbToFr();
		pResponse.heureMarcheDebut = lInfoCommande.comDateMarcheDebut.extractDbHeure();
		pResponse.minuteMarcheDebut = lInfoCommande.comDateMarcheDebut.extractDbMinute();
		pResponse.heureMarcheFin = lInfoCommande.comDateMarcheFin.extractDbHeure();
		pResponse.minuteMarcheFin = lInfoCommande.comDateMarcheFin.extractDbMinute();
		
		// Pas d'affichage si il n' a pas de produit en base
		if(pResponse.produits[0].id == null) {
			pResponse.produits = [];
		}
		
		this.commande = pResponse;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.formulaireModifierCommande;
		
		
		var lData = that.affect($(lTemplate.template(pResponse)));
				
		pResponse.pdtCommande = [];		
		$(pResponse.commande).each(function() {
			var lLot = {
					dcomId:this.dcomId,
					dcomTaille:this.dcomTaille.nombreFormate(2,',',' '),
					dcomPrix:this.dcomPrix.nombreFormate(2,',',' ')};
			
			if(pResponse.pdtCommande[this.proId]) {
				pResponse.pdtCommande[this.proId].lots[this.dcomId] = lLot;
			} else {			
				var lProduit = {
						proId:this.proId,
						proUniteMesure:this.proUniteMesure,
						proMaxProduitCommande:this.proMaxProduitCommande.nombreFormate(2,',',' '),
						proIdNomProduit:this.proIdNomProduit,
						proIdProducteur:this.proIdProducteur,
						nproNom:this.nproNom,
						lots:[]};
				lProduit.lots[this.dcomId] = lLot;
				
				$(pResponse.stockInitiaux).each(function() {
					if(this.idProduit == lProduit.proId) {
						lProduit.quantiteInit = this.quantite.nombreFormate(2,',',' ');
					}					
				});
				
				pResponse.pdtCommande[this.proId] = lProduit;
			}
		});
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.ajoutProduitModifierCommande;
		$(pResponse.pdtCommande).each(function() {
			if(this.proId != undefined) {
				this.sigleMonetaire = gSigleMonetaire;

				this.producteurs = that.mListeProducteurs;
				var lIdProducteur = this.proIdProducteur;
				var lNomProducteur = '';
				$(that.mListeProducteurs).each(function() {
					if(this.prdtId == lIdProducteur) {
						lNomProducteur = this.prdtPrenom + ' ' + this.prdtNom;
					}
				});
				this.nomProducteur = lNomProducteur;
				
				var lHtml = that.affectNouveauProduit($(lTemplate.template(this)));
								
				// Séléction du producteur
				lHtml.find(':input[name=producteur]').selectOptions(lIdProducteur);
								
				var pdt = this;
				$(this.lots).each(function() {
					if(this.dcomId != undefined) {
						var lLot = {lots:[{
							id:this.dcomId,
							taille:this.dcomTaille,
							prix:this.dcomPrix,
							unite:pdt.proUniteMesure,
							idPdt:pdt.proId}],
							siglemonetaire:gSigleMonetaire};
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lGestionCommandeTemplate.ajoutLotModifPdt.template(lLot)) ));
					}
				});
				
				lData.find("#liste_produit").append(that.afficherDeleteLot($(lHtml)));
			}
		});
		
		$('#contenu').replaceWith(lData);
	}
	
	this.affectSelectHeure = function(pData) {
		var that = this;
		pData.find(':input[name=heure_fin_commande]').selectOptions(that.commande.heureFinReservation);
		pData.find(':input[name=minute_fin_commande]').selectOptions(that.commande.minuteFinReservation);
		pData.find(':input[name=heure_debut_marche]').selectOptions(that.commande.heureMarcheDebut);
		pData.find(':input[name=minute_debut_marche]').selectOptions(that.commande.minuteMarcheDebut);
		pData.find(':input[name=heure_fin_marche]').selectOptions(that.commande.heureMarcheFin);
		pData.find(':input[name=minute_fin_marche]').selectOptions(that.commande.minuteMarcheFin);
		return pData;
	}
	
	
	this.affect = function(pData) {
		pData = this.affectAjoutProduit(pData);
		pData = this.affectCreerCommande(pData);
		pData = this.affectModifierCommande(pData);
		pData = this.affectDialogCreerProduit(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectSelectHeure(pData);
		pData = this.affectBtnRetourMarche(pData);		
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectNouveauProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectAjoutProduit = function(pData) {
		var lId = "#formulaire-ajout-produit-creation-commande";
		var that = this;
		pData.find(lId).submit(
			function () {				
				var lValid = true;
				$(".produit-nom-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.idProducteur = $(lId + " :input[name=producteur]").val();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);

					var lValid = new ProduitCommandeValid();
					var lVr = lValid.validAjout(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitModifierCommande;						
						
						lVo.proIdNomProduit = lVo.idNom;						
						lVo.nproNom = lVo.nom;
						lVo.proUniteMesure = lVo.unite;
						lVo.proMaxProduitCommande = lVo.qteMaxCommande.nombreFormate(2,',',' ');
						lVo.quantiteInit = lVo.qteRestante.nombreFormate(2,',',' ');
						lVo.proId = lVo.idNom * -1;
						
						lVo.lots = new Array();
						lVo.lots.push({	id:0,
										idPdt:lVo.proId,
										unite:lVo.unite,
										taille:lVoLot.taille.nombreFormate(2,',',' '),
										prix:lVoLot.prix.nombreFormate(2,',',' ')});

						lVo.siglemonetaire = gSigleMonetaire;
						
						lVo.producteurs = that.mListeProducteurs;
						lVo.nomProducteur = $(lId + " :input[name=producteur]").selectedOptions().text();
						
						var lHtml = that.affectNouveauProduit($(lTemplate.template(lVo)));

						// Séléction du producteur
						lHtml.find(':input[name=producteur]').selectOptions(lVo.idProducteur);
						
						lTemplate = lGestionCommandeTemplate.ajoutLotModifPdt;
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lTemplate.template(lVo)) ));
						
						$("#liste_produit").append(lHtml); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						$(lId + " :input[name=produit]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=produit]").selectOptions(0);
						$(lId + " :input[name=producteur]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=producteur]").selectOptions(0);
						
					} else {
						Infobulle.generer(lVr,'ajout-produit-');	
					}
				} else {
					var lVr = new TemplateVR();
					lVr.valid = false;
					lVr.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_211_CODE;
					erreur.message = ERR_211_MSG;
					lVr.log.erreurs.push(erreur);
					Infobulle.generer(lVr,'');
				}
				return false;								
			});
		return pData;
	}
	
	this.affectCreerCommande = function(pData) {
		var lId = "#btn-creer-commande";
		var that = this;
		pData.find(lId).click(
			function () {
				if(that.mEditionEnCours == 0) {
					// Récupération des données
					var lVo = new CommandeCompleteVO();
					lVo.id = that.commande.comId;
					lVo.numero = that.commande.comNumero;
					lVo.nom = $("#formulaire-information-creation-commande").find(':input[name=nom_commande]').val();
					lVo.description = $("#formulaire-information-creation-commande").find(':input[name=description_commande]').val();
					lVo.dateMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=heure_debut_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_debut_marche]').val() + ':00';
					lVo.dateMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_marche]').val() + ':00';
					lVo.dateFinReservation = $("#formulaire-information-creation-commande").find(':input[name=date_fin_commande]').val().dateFrToDb();
					lVo.timeFinReservation = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_commande]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_commande]').val() + ':00';
					lVo.archive = "0";
					
					$('.produit-div').each(
							function () {
								var lVoProduit = new ProduitCommandeVO();		
								lVoProduit.idProducteur = $(this).find(':input[name=producteur]').val();
								lVoProduit.id = $(this).find('.produit-id').text();	
								lVoProduit.idNom = $(this).find('.produit-nom-id').text();
								lVoProduit.unite = $(this).find(':input[name=unite]').val();
								lVoProduit.qteMaxCommande = $(this).find(':input[name=qmax]').val().numberFrToDb();
								lVoProduit.qteRestante = $(this).find(':input[name=stock]').val().numberFrToDb();
								
								$(this).find('.produit-lot').each(
										function () {
											// Récupération des lots
											var lVoLot = new DetailCommandeVO();
											lVoLot.id = $(this).find('.lot-id').text();
											lVoLot.taille = $(this).find(':input[name=taille]').val().numberFrToDb();
											lVoLot.prix = $(this).find(':input[name=prix]').val().numberFrToDb();
											lVoProduit.lots.push(lVoLot);										
										});													
								
								lVo.produits.push(lVoProduit);								
							});	
					
					if(that.etapeCreationCommande == 0) {
						var lValid = new CommandeCompleteValid();
						var lVR = lValid.validUpdate(lVo);
							
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide();
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot").each(
										function () {
											$(this).hide();
										});
								
								$("#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select").each(
										function () {
											$(this).inputToText();
										});					
						} else {
							// Affiche les erreurs
							Infobulle.generer(lVR,"commande-");							
						}
					
					} else if(that.etapeCreationCommande == 1) {
						// Envoi des infos en json
						var lParam = {form:2,commande:lVo};
						$.post(	"./index.php?m=GestionCommande&v=ModifierCommande", "pParam=" + $.toJSON(lParam),
								function (lVoRetour) {	
									if(lVoRetour.valid) {
										lVoRetour.numero = that.commande.comNumero;
										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.modifCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lVoRetour));
									} else {
										that.modifierCommandeFunction();
										Infobulle.generer(lVoRetour,"commande-");
									}
									that.etapeCreationCommande = 0; 
								},"json"
						);
					}
				} else {
					var lVR = new Object();
					var erreur = new VRerreur();
					erreur.code = ERR_112_CODE;
					erreur.message = ERR_112_MSG;
					lVR.valid = false;
					lVR.log = new VRelement();
					lVR.log.valid = false;
					lVR.log.erreurs.push(erreur);
					Infobulle.generer(lVR,"");
				}				
			});
		return pData;
	}
		
	this.affectModifierCommande = function(pData) {
		var that = this;
		pData.find('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
		return pData;
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande, .edit-nom-pdt-creation-commande-valid').hide();
		$('.produit-lots').each(function () {that.afficherDeleteLot($(this))});
		$('#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select').textToInput();
	}
	
	this.ajoutLotProduit = function(pData) {
		var that = this;
		pData.find('.btn-ajout-lot-creation-commande').click(
			function () {
				
				var inpTaille = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=taille]");
				var inpPrix = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=prix]");
				
				// Récupération des données
				var lVo = new DetailCommandeVO();
				lVo.idProduit = $(this).parents(".produit-div").find(".produit-id").text();
				lVo.taille = inpTaille.val().numberFrToDb();
				lVo.prix = inpPrix.val().numberFrToDb();

				var lValid = new DetailCommandeValid();
				var lVr = lValid.validAjout(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
					lVo.taille = parseFloat(lVo.taille).nombreFormate(2,',',' ');
					
					lVo.siglemonetaire = gSigleMonetaire;
					lVo.unite = $(this).parentsUntil(".produit-div").find(":input[name=unite]").val();
				
					lVo.idNom = lVo.idProduit;
					var lListeId = new Array();
					$(this).parentsUntil(".produit-div").find(".produit-lot").each(function(){
						lListeId.push(parseInt($(this).find(".lot-id").text()));
					});
					
					var lMinId = Array.min(lListeId);
					if(lMinId < 0) {
						lVo.id = lMinId-1;
					} else {
						lVo.id = -1;
					}
					
					var lGestionCommandeTemplate = new GestionCommandeTemplate();
					var lTemplate = lGestionCommandeTemplate.ajoutLot; 
					
					that.afficherDeleteLot(
							$(this).parents(".produit-div").find(".produit-lots").append(
									that.affectAjoutLot( $(lTemplate.template(lVo)) ))
					);
					
					// Remise à zéro du formulaire
					inpTaille.val('');
					inpPrix.val('');
				} else {
					Infobulle.generer(lVr,"ajout-lot-produit-" + lVo.idProduit + "-");
				}
			});
		return pData;
	}
	
	this.editProduit = function(pData) {
		var that = this;
		
		pData.find('.edit-nom-pdt-creation-commande-valid').click(function() {
			var lVo = new ProduitCommandeVO();
			var lId = $(this).closest(".produit-div"); 			
			lVo.idProducteur = $(lId).find(':input[name=producteur]').val();   				
			lVo.idNom = $(lId).find(".produit-nom-id").text();
			lVo.nom = $(lId).find(".produit-nom").text();
			lVo.unite = $(lId).find(":input[name=unite]").val();
			lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
			lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
			
			var lValid = new ProduitCommandeValid();
			var lVr = lValid.validAjout(lVo,'simple');
			
			if(lVr.valid) {
				Infobulle.init();
				
				var lNomProducteur = $(lId).find(':input[name=producteur]').selectedOptions().text();
				$(lId).find('#nom-producteur').text(lNomProducteur);
				
				var lStock = parseFloat(lVo.qteRestante).nombreFormate(2,',',' ');
				$(lId).find('.produit-stock').text(lStock);
				$(lId).find(":input[name=stock]").val(lStock)
				
				var lQteMax = parseFloat(lVo.qteMaxCommande).nombreFormate(2,',',' ');
				$(lId).find('.produit-qmax').text(lQteMax);
				$(lId).find(":input[name=qmax]").val(lQteMax)
				
				$(lId).find('.produit-unite').text(lVo.unite);
				var lDivParent = $(this).parentsUntil('#liste_produit');
    			lDivParent.find('.produit-unite').text(lVo.unite);
    			
    			pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
    			that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
			}			
		});
		
		pData.find('.edit-nom-pdt-creation-commande-edit').click(function() {			
			that.mEditionEnCours++;
			pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;		
		pData.find(".edit-lot-creation-commande-valid").click( function () {
			var lVo = new DetailCommandeVO();
			var lId = $(this).closest(".produit-lot");
			
			lVo.id = $(lId).find(".lot-id").text();
			lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
			lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
			lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();

			var lValid = new DetailCommandeValid();
			var lVr = lValid.validAjout(lVo);
			
			if(lVr.valid) {	
				Infobulle.init();
				/*$(this).parent().parent().find(":input[name='taille']").inputToText();
				$(this).parent().parent().find(":input[name='prix']").inputToText("montant");
				pData.find(".edit-lot-creation-commande").toggle();*/
				
				var lTaille = lVo.taille.nombreFormate(2,',',' ');
				$(lId).find(".produit-taille").text(lTaille);
				$(lId).find(":input[name=taille]").val(lTaille);
				
				var lPrix = lVo.prix.nombreFormate(2,',',' ');
				$(lId).find(".produit-prix").text(lPrix);
				$(lId).find(":input[name=prix]").val(lPrix);
				
				pData.find('.edit-lot-creation-commande, .pdt-' + lVo.idProduit + '-lot-' + lVo.id).toggle();
				that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
			}
		});
		
		pData.find(".edit-lot-creation-commande-edit").click( function () {
			/*$(this).parent().parent().children(':input:not(:button,:submit)').each(
					function () { $(this).textToInput(); });
			pData.find(".edit-lot-creation-commande").toggle();*/
			
			var lIdPdt = $(this).closest('.produit-div').find('.produit-id').text();
			var lIdLot = $(this).closest('.produit-lot').find('.lot-id').text();			
			pData.find('.edit-lot-creation-commande, .pdt-' + lIdPdt + '-lot-' + lIdLot).toggle();
			that.mEditionEnCours++;
		});

		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().parent().remove();
				that.afficherDeleteLot(lListeProduit);
			});
		return pData;
	}
	
	this.afficherDeleteLot = function(pData) {	
		if( pData.find('.produit-lot').size() < 2 ) {
			pData.find('.delete-lot').hide();
		} else {
			pData.find('.delete-lot').show();
		}		
		return pData;
	}
	
	this.affectDialogCreerProduit = function(pData) {
		var that = this;
		pData.find('#btn-creer-nv-pdt')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogAjoutProduit;
			
			$(lTemplate).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer le produit': function() {
						var lForm = $(this).children('form').first();
						that.CreerProduit(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProduit($(this));
				return false;
			});			
		});
		return pData;
	}
	
	this.CreerProduit = function(pForm) {
		var lVo = new NomProduitVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		lVo.idCategorie = 1; // TODO faire une gestion avec categorie
		
		var lValid = new NomProduitValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {form:1,nomProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {							
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						// Ajout dans la liste du select avec son ID
						var lNomPdt = [];
						lNomPdt[lResponse.id] = lResponse.nom;
						$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(lNomPdt).sortOptions();
						$("#dialog-form-creer-nv-pdt").dialog('close');
					} else {
						Infobulle.generer(lResponse,'nom-pdt-');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'nom-pdt-');
		}
	}
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut',pData);
		return pData;
	}
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.construct(pParam);
	
};function AjoutCommandeVue(pParam) {
	
	this.etapeCreationCommande = 0;
	this.mEditionEnCours = 0;
	this.mListeProducteurs = null;
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
				function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}						
							// Pas d'affichage si il n' a pas de producteur en base
							if(lResponse.producteurs[0].prdtId == null) {
								lResponse.producteurs = [];
							}							
							that.mListeProducteurs = lResponse.producteurs;
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}					
					},"json"
				);		
	}
	
	this.afficher = function(pResponse) {
		var that = this;
		
		// Pas d'affichage si il n' a pas de produit en base
		if(pResponse.produits[0].id == null) {
			pResponse.produits = [];
		}
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.formulaireAjoutCommande;
		$('#contenu').replaceWith( that.affect($(lTemplate.template(pResponse))));
	}
	
	this.affect = function(pData) {
		pData = this.affectAjoutProduit(pData);
		pData = this.affectCreerCommande(pData);
		pData = this.affectModifierCommande(pData);
		pData = this.affectDialogCreerProduit(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectNouveauProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectAjoutProduit = function(pData) {
		var lId = "#formulaire-ajout-produit-creation-commande";
		var that = this;
		pData.find(lId).submit(
			function () {
				
				var lValid = true;
				$(".produit-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.idProducteur = $(lId + " :input[name=producteur]").val();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);

					var lValid = new ProduitCommandeValid();
					var lVr = lValid.validAjout(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.qteMaxCommande = lVo.qteMaxCommande.nombreFormate(2,',',' ');
						lVo.qteRestante = lVo.qteRestante.nombreFormate(2,',',' ');
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.lots[0].taille = parseFloat(lVo.lots[0].taille).nombreFormate(2,',',' ');
						lVo.lots[0].id = 0;
						lVo.siglemonetaire = gSigleMonetaire;
						
						lVo.producteurs = that.mListeProducteurs;
						lVo.nomProducteur = $(lId + " :input[name=producteur]").selectedOptions().text();
						
						var lHtml = that.affectNouveauProduit($(lTemplate.template(lVo)));
						
						// Séléction du producteur
						lHtml.find(':input[name=producteur]').selectOptions(lVo.idProducteur);
						
						lTemplate = lGestionCommandeTemplate.ajoutLotAjoutPdt; 
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lTemplate.template(lVo)) ));
							
						$("#liste_produit").append(lHtml); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						$(lId + " :input[name=produit]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=produit]").selectOptions(0);
						$(lId + " :input[name=producteur]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=producteur]").selectOptions(0);
						
					} else {
						Infobulle.generer(lVr,'ajout-produit-');	
					}
				} else {
					var lVr = new TemplateVR();
					lVr.valid = false;
					lVr.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_211_CODE;
					erreur.message = ERR_211_MSG;
					lVr.log.erreurs.push(erreur);
					Infobulle.generer(lVr,'');
				}
				return false;								
			});
		return pData;
	}
	
	this.affectCreerCommande = function(pData) {
		var lId = "#btn-creer-commande";
		var that = this;
		pData.find(lId).click(
			function () {				
				if(that.mEditionEnCours == 0) {
					// Récupération des données
					var lVo = new CommandeCompleteVO();
					lVo.nom = $("#formulaire-information-creation-commande").find(':input[name=nom_commande]').val();
					lVo.description = $("#formulaire-information-creation-commande").find(':input[name=description_commande]').val();
					lVo.dateMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=heure_debut_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_debut_marche]').val() + ':00';
					lVo.dateMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_marche]').val() + ':00';
					lVo.dateFinReservation = $("#formulaire-information-creation-commande").find(':input[name=date_fin_commande]').val().dateFrToDb();
					lVo.timeFinReservation = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_commande]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_commande]').val() + ':00';
					lVo.archive = "0";
					
					$('.produit-div').each(
							function () {
								var lVoProduit = new ProduitCommandeVO();		
								lVoProduit.idProducteur = $(this).find(':input[name=producteur]').val();
								lVoProduit.idNom = $(this).find('.produit-id').text();							
								lVoProduit.unite = $(this).find(':input[name=unite]').val();
								lVoProduit.qteMaxCommande = $(this).find(':input[name=qmax]').val().numberFrToDb();
								lVoProduit.qteRestante = $(this).find(':input[name=stock]').val().numberFrToDb();
								
								$(this).find('.produit-lot').each(
										function () {
											// Récupération des lots
											var lVoLot = new DetailCommandeVO();
											lVoLot.taille = $(this).find(':input[name=taille]').val().numberFrToDb();
											lVoLot.prix = $(this).find(':input[name=prix]').val().numberFrToDb();
											lVoProduit.lots.push(lVoLot);										
										});													
								
								lVo.produits.push(lVoProduit);								
							});	
					
					if(that.etapeCreationCommande == 0) {		
						
						var lValid = new CommandeCompleteValid();
						var lVR = lValid.validAjout(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide();
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot").each(
										function () {
											$(this).hide();
										});
								
								$("#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select").each(
										function () {
											$(this).inputToText();
										});					
						} else {
							// Affiche les erreurs
							Infobulle.generer(lVR,"commande-");							
						}
					
					} else if(that.etapeCreationCommande == 1) {
						// Envoi des infos en json
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								"commande=" + $.toJSON(lVo) + "&form=2",
								function (lVoRetour) {		
									if(lVoRetour.valid) {
										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.ajoutCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lVoRetour));
									} else {
										that.modifierCommandeFunction();
										Infobulle.generer(lVoRetour,"commande-");
									}
									that.etapeCreationCommande = 0;
								},"json"
						);
					}
				} else {
					var lVR = new Object();
					var erreur = new VRerreur();
					erreur.code = ERR_112_CODE;
					erreur.message = ERR_112_MSG;
					lVR.valid = false;
					lVR.log = new VRelement();
					lVR.log.valid = false;
					lVR.log.erreurs.push(erreur);
					Infobulle.generer(lVR,"");
				}				
			});
		return pData;
	}
		
	this.affectModifierCommande = function(pData) {
		var that = this;
		pData.find('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
		return pData;
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande, .edit-nom-pdt-creation-commande-valid').hide();
		$('.produit-lots').each(function () {that.afficherDeleteLot($(this))});
		$('#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select').textToInput();
	}
	
	this.ajoutLotProduit = function(pData) {
		var that = this;
		pData.find('.btn-ajout-lot-creation-commande').click(
			function () {
				
				var inpTaille = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=taille]");
				var inpPrix = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=prix]");
				
				// Récupération des données
				var lVo = new DetailCommandeVO();
				lVo.idProduit = $(this).parents(".produit-div").find(".produit-id").text();
				lVo.taille = inpTaille.val().numberFrToDb();
				lVo.prix = inpPrix.val().numberFrToDb();
				
				var lValid = new DetailCommandeValid();
				var lVr = lValid.validAjout(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
					lVo.taille = parseFloat(lVo.taille).nombreFormate(2,',',' ');
					
					lVo.siglemonetaire = gSigleMonetaire;
					lVo.unite = $(this).parentsUntil(".produit-div").find(":input[name=unite]").val();
				
					lVo.idNom = lVo.idProduit;
					var lListeId = new Array();
					$(this).parentsUntil(".produit-div").find(".produit-lot").each(function(){
						lListeId.push(parseInt($(this).find(".lot-id").text()));
					});
					lVo.id = Array.max(lListeId) + 1;
					
					var lGestionCommandeTemplate = new GestionCommandeTemplate();
					var lTemplate = lGestionCommandeTemplate.ajoutLot; 
					
					that.afficherDeleteLot(
							$(this).parents(".produit-div").find(".produit-lots").append(
									that.affectAjoutLot( $(lTemplate.template(lVo)) ))
					);
					
					// Remise à zéro du formulaire
					inpTaille.val('');
					inpPrix.val('');
				} else {
					Infobulle.generer(lVr,"ajout-lot-produit-" + lVo.idProduit + "-");
				}
			});
		return pData;
	}
	
	this.editProduit = function(pData) {
		var that = this;
		
		pData.find('.edit-nom-pdt-creation-commande-valid').click(function() {
			var lVo = new ProduitCommandeVO();
			var lId = $(this).closest(".produit-div");			
			lVo.idProducteur = $(lId).find(':input[name=producteur]').val();
			lVo.idNom = $(lId).find(".produit-id").text();
			lVo.nom = $(lId).find(".produit-nom").text();
			lVo.unite = $(lId).find(":input[name=unite]").val();
			lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
			lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
			
			var lValid = new ProduitCommandeValid();
			var lVr = lValid.validAjout(lVo,'simple');
			
			if(lVr.valid) {
				Infobulle.init();
				
				var lNomProducteur = $(lId).find(':input[name=producteur]').selectedOptions().text();
				$(lId).find('#nom-producteur').text(lNomProducteur);
				
				var lStock = parseFloat(lVo.qteRestante).nombreFormate(2,',',' ');
				$(lId).find('.produit-stock').text(lStock);
				$(lId).find(":input[name=stock]").val(lStock)
				
				var lQteMax = parseFloat(lVo.qteMaxCommande).nombreFormate(2,',',' ');
				$(lId).find('.produit-qmax').text(lQteMax);
				$(lId).find(":input[name=qmax]").val(lQteMax)
				
				$(lId).find('.produit-unite').text(lVo.unite);
				var lDivParent = $(this).parentsUntil('#liste_produit');
    			lDivParent.find('.produit-unite').text(lVo.unite);
				
				pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
				that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
			}
			
		});
		
		pData.find('.edit-nom-pdt-creation-commande-edit').click(function() {
			that.mEditionEnCours++;
			pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
			
		pData.find(".edit-lot-creation-commande-valid").click( function () {
			var lVo = new DetailCommandeVO();
			var lId = $(this).closest(".produit-lot");
			
			lVo.id = $(lId).find(".lot-id").text();
			lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
			lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
			lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
			
			var lValid = new DetailCommandeValid();
			var lVr = lValid.validAjout(lVo);
			
			if(lVr.valid) {	
				Infobulle.init();
				
				var lTaille = lVo.taille.nombreFormate(2,',',' ');
				$(lId).find(".produit-taille").text(lTaille);
				$(lId).find(":input[name=taille]").val(lTaille);
				
				var lPrix = lVo.prix.nombreFormate(2,',',' ');
				$(lId).find(".produit-prix").text(lPrix);
				$(lId).find(":input[name=prix]").val(lPrix);
				
				pData.find('.edit-lot-creation-commande, .pdt-' + lVo.idProduit + '-lot-' + lVo.id).toggle();
				that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
			}
		});		

		pData.find(".edit-lot-creation-commande-edit").click( function () {			
			var lIdPdt = $(this).closest('.produit-div').find('.produit-id').text();
			var lIdLot = $(this).closest('.produit-lot').find('.lot-id').text();			
			pData.find('.edit-lot-creation-commande, .pdt-' + lIdPdt + '-lot-' + lIdLot).toggle();
			that.mEditionEnCours++;
		});		
		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().parent().remove();
				that.afficherDeleteLot(lListeProduit);
			});
		return pData;
	}
	
	this.afficherDeleteLot = function(pData) {	
		if( pData.children('.produit-lot').size() < 2 ) {
			pData.find('.delete-lot').hide();
		} else {
			pData.find('.delete-lot').show();
		}		
		return pData;
	}
	
	this.affectDialogCreerProduit = function(pData) {
		var that = this;
		pData.find('#btn-creer-nv-pdt')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogAjoutProduit;
			
			$(lTemplate).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer le produit': function() {
						var lForm = $(this).children('form').first();
						that.CreerProduit(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProduit($(this));
				return false;
			});			
		});		
		return pData;
	}
	
	this.CreerProduit = function(pForm) {
		var lVo = new NomProduitVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		lVo.idCategorie = 1; // TODO faire une gestion avec categorie
		
		var lValid = new NomProduitValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {form:1,nomProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {							
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						// Ajout dans la liste du select avec son ID
						var lNomPdt = [];
						lNomPdt[lResponse.id] = lResponse.nom;
						$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(lNomPdt).sortOptions();
						$("#dialog-form-creer-nv-pdt").dialog('close');
					} else {
						Infobulle.generer(lResponse,'nom-pdt-');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'nom-pdt-');
		}
	}
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut',pData);
		return pData;
	}
	
	this.construct(pParam);
	
};function AchatCommandeVue(pParam) {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.listeLot = new Array();
	this.mTypePaiement = [];
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	
	this.construct = function(pParam) {
		var that = this;		 // TODO gestion avec param pour le server aussi
		this.idCommande = pParam.id_commande;
		this.idAdherent = pParam.id_adherent;
		
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pParam.id_commande + "&id_adherent=" + pParam.id_adherent,
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {						
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.idCompte = lResponse.adherent.adhIdCompte;					
						for(lLigne in lResponse.commande) {
							var lLot = new Object();
							lLot.quantite = lResponse.commande[lLigne].dcomTaille;
							lLot.prix = lResponse.commande[lLigne].dcomPrix						
							if(!that.listeLot[lResponse.commande[lLigne].proId]) {
								if(!isArray(that.listeLot[lResponse.commande[lLigne].proId])) {
									that.listeLot[lResponse.commande[lLigne].proId] = new Array();
								}
							}
							that.listeLot[lResponse.commande[lLigne].proId].push(lLot);
						}						
						
						$(lResponse.typePaiement).each(function() {
							that.mTypePaiement[this.tppId] = this;
						});
						
						
						that.solde = parseFloat(lResponse.adherent.opeMontant);
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}					
				},"json"
		);
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			var that = this;
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.achatCommandePage;
			
			var lData = new Object();
			lData.comNumero = pResponse.commande[0].comNumero;
			
			lData.adhNumero = pResponse.adherent.adhNumero;
			lData.adhCompte = pResponse.adherent.cptLabel;
			lData.adhNom = pResponse.adherent.adhNom;
			lData.adhPrenom = pResponse.adherent.adhPrenom;
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			
			lData.produits = new Array();
			lListeIdProduit = new Array();
			for(lLigne in pResponse.commande) {
				lPush = true;
				for(lId in lListeIdProduit) {
					if(lListeIdProduit[lId] == pResponse.commande[lLigne].proId) {
						lPush = false;
					}
				}
				if(lPush) {
					lListeIdProduit.push(pResponse.commande[lLigne].proId);
					var lProduit = new Object();
					lProduit.proId = pResponse.commande[lLigne].proId;
					lProduit.nproNom = pResponse.commande[lLigne].nproNom;
					lProduit.proUniteMesure = pResponse.commande[lLigne].proUniteMesure;
					lProduit.stoQuantite = 0;
					lProduit.proPrix = 0;
					var lPrix = 0;
					for(lReservation in pResponse.reservation) {
						if(pResponse.reservation[lReservation].proId == lProduit.proId) {
							lProduit.stoQuantite = pResponse.reservation[lReservation].stoQuantite * -1;
							lPrix = this.calculPrixProduit(lProduit.proId,lProduit.stoQuantite);
							lProduit.proPrix = lPrix.nombreFormate(2,',',' ');
						}						
					}
					lData.total += lPrix;
					lData.produits.push(lProduit);
				}
			}
			lData.adhSolde = parseFloat(pResponse.adherent.opeMontant);
			lData.adhNouveauSolde =  lData.adhSolde-lData.total;
			
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');
			lData.adhNouveauSolde = lData.adhNouveauSolde.nombreFormate(2,',',' ');
			lData.total = lData.total.nombreFormate(2,',',' ');
			
			lData.typePaiement = that.mTypePaiement;
			
			$('#contenu').replaceWith( that.affect($(lTemplate.template(lData))) );
			that.changerTypePaiement($(":input[name=typepaiement]"));
			that.majNouveauSolde();
		} else {
			Infobulle.generer(pResponse,'');
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectNouveauPrixProduit(pData);
		pData = this.affectChampComplementaire(pData);
		pData = this.affectValider(pData);
		pData = this.affectAnnuler(pData);
		pData = this.affectModifier(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {that.changerTypePaiement($(this))});
		return pData;
	}
	
	this.affectNouveauSolde = function(pData) {
		var that = this;
		pData.find(":input[name=montant-rechargement], .produit-prix").keyup(function() {
			that.majNouveauSolde();	
			that.controlerAchat();
		});
		return pData;
	}
		
	this.affectNouveauPrixProduit = function(pData) {
		var that = this;
		pData.find(".produit-quantite").keyup(function() {
				that.majPrixProduit($(this));
				that.controlerAchat();
		});
		return pData;
	}
	
	this.affectChampComplementaire = function(pData) {
		var that = this;
		pData.find(":input[name=champ-complementaire]").keyup(function() {that.controlerAchat();});		
		return pData;
	}
	
	this.affectValider = function(pData) {
		var that = this;
		pData.find("#btn-valider").click(function() {that.creerRecapitulatif();});		
		return pData;
	}
	
	this.affectAnnuler = function(pData) {
		var that = this;
		pData.find("#btn-annuler").click(function() {that.retourListe();});		
		return pData;
	}
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find("#btn-modifier").click(function() {that.boutonModifier();});		
		return pData;
	}
	
	this.majPrixProduit = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		var lIdProduit = ligne.find(".produit-id").text();
		var lNvPrix = this.calculPrixProduit(lIdProduit,lQuantite);		
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		ligne.find(".produit-prix").val(lNvPrix.nombreFormate(2,',',' '));	
		this.majNouveauSolde();	
	}
	
	this.controlerAchat = function() {
		Infobulle.init(); // Supprime les erreurs
		var lValid = new AchatCommandeValid();
		var lVr = lValid.validAjout(this.getAchatCommandeVO());
		Infobulle.generer(lVr,'');
		return lVr;
	}
	
	this.calculPrixProduit = function(pIdProduit,pQuantite) {
		if(this.listeLot[pIdProduit]) {
			var lLots = this.listeLot[pIdProduit];
			var lPrix = 0;
			for(lLot in lLots) {
				if(pQuantite % lLots[lLot].quantite == 0) {
					lPrix = (pQuantite / lLots[lLot].quantite) * lLots[lLot].prix;
				}
			}			
			return lPrix;
		}
		return 0;
	}
	
	this.majTotal = function() {
		var that = this;
		$("#total-achat").text(that.calculerTotal().nombreFormate(2,',',' '));
	}
	
	this.calculerTotal = function() {
		var lTotal = 0;
		$(".produit-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	}
	
	this.majNouveauSolde = function() {
		this.majTotal();		
		var lTotal = this.calculNouveauSolde();
		if(lTotal <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lTotal.nombreFormate(2,',',' '));
	}
	
	this.calculNouveauSolde = function() {
		var lAchats = parseFloat($("#total-achat").text().numberFrToDb());
		if(isNaN(lAchats)) {lAchats = 0;}
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}
		return this.solde - lAchats + lRechargement;
	}
		
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel).show();
			$("#td-champ-complementaire").show();
		} else {
			$("#label-champ-complementaire").text('').hide();
			$(":input[name=champ-complementaire]").val('');
			$("#td-champ-complementaire").hide();
		}
	}
		
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.mTypePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].tppChampComplementaire == 1) {
				return lTpp[pId].tppLabelChampComplementaire;
			}
		}	
		return null;
	}
	
	this.getAchatCommandeVO = function() {
		var lVo = new AchatCommandeVO();
		lVo.id = this.idCommande;
		lVo.idCompte = this.idCompte;
		lVo.produits = this.getProduitsVO();
		lVo.rechargement = this.getRechargementVO();
		return lVo;
	}	
	
	this.getProduitsVO = function() {
		var lVo = new Array();		
		$(".ligne-produit").each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).find(".produit-id").text();			
			var lQuantite = $(this).find(".produit-quantite").val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty()){
				lQuantite = parseFloat(lQuantite);
			}
			lVoProduit.quantite = lQuantite;
			
			var lprix = $(this).find(".produit-prix").val().numberFrToDb();
			if(!isNaN(lprix) && !lprix.isEmpty()){
				lprix = parseFloat(lprix);
			}
			lVoProduit.prix = lprix;
			
			lVo.push(lVoProduit);			
		});		
		return lVo;
	}
	
	this.getRechargementVO = function() {
		var lVo = new RechargementCompteVO();
		lVo.id = this.idCompte;
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		if(!isNaN(lMontant) && !lMontant.isEmpty()){
			lMontant = parseFloat(lMontant);
		}
		lVo.montant = lMontant;
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		if(this.getLabelChamComplementaire(lVo.typePaiement) != null) {
			lVo.champComplementaireObligatoire = 1;
			lVo.champComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lVo.champComplementaireObligatoire = 0;
		}
		return lVo;
	}
	
	this.creerRecapitulatif = function() {
		var lVr = this.controlerAchat();
		if(lVr.valid) {
			if(this.etapeValider == 0) {
				$(".produit-quantite,#rechargementchampComplementaire,#typepaiement").each(function() {$(this).inputToText();});
				$(".produit-prix,#rechargementmontant").each(function() {$(this).inputToText("montant");});
				$("#btn-modifier").show();
				$("#btn-annuler").hide();
				this.etapeValider = 1;
			} else if(this.etapeValider == 1) {
				this.enregistrerAchat();
			}
		}
	}
	
	this.enregistrerAchat = function() {
		var that = this;
		var lVo = this.getAchatCommandeVO();
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","achat=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour.valid) {
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.achatCommandeSucces;
						$('#contenu').replaceWith(that.affectAnnuler($(lTemplate)));
					} else {
						that.boutonModifier();
						Infobulle.generer(lVoRetour,"");
					}
					that.etapeValider = 0;
				},"json"
			);
	}
	
	this.boutonModifier = function() {
		if(this.etapeValider == 1) {
			$(".produit-prix,#rechargementmontant,.produit-quantite,#rechargementchampComplementaire,#typepaiement").each(function() {$(this).textToInput();});
			$("#btn-modifier").hide();
			$("#btn-annuler").show();
			this.etapeValider = 0;
		}
	}
	
	this.retourListe = function() {
		MarcheCommandeVue({id_commande:this.idCommande});
	}
	
	this.construct(pParam);
};function ListeCommandeArchiveVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		var lParam = {archive:1};
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {		
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		if(lResponse.listeCommande.length > 0 && lResponse.listeCommande[0].comId != null) {
		
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = new Object();
					lCommande.id = this.comId;
					lCommande.numero = this.comNumero;
					lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();

					lCommande.dateTimeFinResa = this.comDateFinReservation.replace('-','').replace(' ','').replace(':','');
					lCommande.dateTimeMarche = this.comDateMarcheDebut.replace('-','').replace(' ','').replace(':','');
					
					lListeCommande.commande.push(lCommande);
				});
			
			var lTemplate = lGestionCommandeTemplate.listeCommandeArchivePage;			
			var lHtml = $(lTemplate.template(lListeCommande));
			
			// Ne pas afficher la pagination si il y a moins de 30 éléments
			if(lResponse.listeCommande.length < 31) {
				lHtml = this.masquerPagination(lHtml);
			} else {
				lHtml = this.paginnation(lHtml);
			}
			
			$('#contenu').replaceWith(that.affect(lHtml));
			
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionCommandeTemplate.listeCommandeArchiveVide)));
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectLienListeCommandeArchive(pData);
		pData = this.affectLienDetail(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectLienListeCommandeArchive = function(pData) {
		pData.find('#lien-marche-encours').click(function() {
			GestionListeCommandeVue();
		});
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-marche-archive")
			.tablesorter({sortList: [[2,1]]})
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false,size:30}); 
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		pData.find("#table-marche-archive").tablesorter({sortList: [[2,1]]});
		return pData;
	}
	
	this.affectLienDetail = function(pData) {
		pData.find('.detail-commande-ligne').click(function() {
			var lparam = {"id_commande":$(this).find('.id-commande').text()};
			InfoCommandeArchiveVue(lparam);
		});
		return pData;
	}
	
	this.construct(pParam);
};function MarcheCommandeVue(pParam) {
	this.idCommande = null;
	
	this.construct = function(pParam) {
		var that = this; // TODO gestion avec param pour le server aussi
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pParam.id_commande,
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
		this.idCommande = pParam.id_commande;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				
				if(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null) {
					var lTemplate = lGestionCommandeTemplate.listeAdherentCommandePage;
					pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
					$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
				} else {
					$('#contenu').replaceWith(lGestionCommandeTemplate.listeMarcheVide);
				}
			} else {
				var lVr = new TemplateVR();
				lVr.valid = false;
				lVr.log.valid = false;				
				var erreur = new VRerreur();
				erreur.code = ERR_211_CODE;
				erreur.message = ERR_211_MSG;
				lVr.log.push(erreur);
				Infobulle.generer(lVr,'');
			}
		} else {
			Infobulle.generer(pResponse,'');
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienAchat(pData);
		return pData;
	}
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[2,0]] });
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	}
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lParam = {	id_commande:that.idCommande,
							id_adherent:$(this).find(".id-adherent").text()};
			AchatCommandeVue(lParam);
		});
		return pData;
	}
	
	this.construct(pParam);
};function BonDeLivraisonVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdCommande = null;
	this.mComNumero = null;
	this.mEtatEdition = false;
	this.mListeProduit = [];
	this.mSuiteEdition = 0;
	this.mIdProducteur = 0;
	this.mTypePaiement = [];
	
	this.construct = function(pParam) {
		var that = this;
		pParam.export_type = 0;
		$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mEtatEdition = false;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.bonDeLivraison;
		
		this.mIdCommande = pResponse.producteurs[0].comId;
		this.mComNumero = pResponse.comNumero;
		
		$(pResponse.typePaiement).each(function() {
			that.mTypePaiement[this.tppId] = this;
		});
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));	
	}
	
	this.affect = function(pData) {
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectBtnRetourMarche(pData);
		pData = this.affectChangementProducteur(pData);
		pData = this.affectExportBonDeLivraison(pData);
		return pData;
	}
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectChangementProducteur = function(pData) {
		var that = this;
		pData.find('#select-prdt').change(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 1;
				that.dialogEnregistrer();
			} else {
				that.changementProducteur();
			}
		});
		return pData;
	}
	
	this.changementProducteur = function() {
		var that = this;
		var lIdProducteur = $('#select-prdt').val();
		if(lIdProducteur > 0) {
			var lParam = {	"id_commande":that.mIdCommande,
						 	"id_producteur":lIdProducteur,
						 	export_type:0}
			$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mIdProducteur = lIdProducteur;
							that.mEtatEdition = false;
							var lTotal = 0;
							$(lResponse.produits).each(function() {
								that.mListeProduit[this.proId] = parseFloat(this.stoQuantite);
								
								this.stoQuantiteCommande = '';
								this.opeMontant = '';
								var lQuantite = 0;
								
								var lProId = this.proId;
								var these = this;
								$(lResponse.produitsCommande).each(function() {
									if(this.proId == lProId) {
										var lMontant = 0;
										these.stoQuantiteCommande = '';
										these.opeMontantCommande = '';
										these.stoQuantiteLivraison = '';
										these.opeMontantLivraison = '';
										these.stoQuantiteSolidaire = '';
										
										if(this.stoQuantite != null) {
											these.stoQuantiteCommande = this.stoQuantite.nombreFormate(2,',',' ');
										}
										if(this.opeMontant != null) {
											these.opeMontantCommande = this.opeMontant.nombreFormate(2,',',' ');
											lMontant = parseFloat(this.opeMontant);
										}
										if(this.stoQuantiteLivraison != null) {
											these.stoQuantiteLivraison = this.stoQuantiteLivraison.nombreFormate(2,',',' ');
											lQuantite += parseFloat(this.stoQuantiteLivraison);
										}
										if(this.opeMontantLivraison != null) {
											these.opeMontantLivraison = this.opeMontantLivraison.nombreFormate(2,',',' ');
										}
										if(this.stoQuantiteSolidaire != null) {
											these.stoQuantiteSolidaire = this.stoQuantiteSolidaire.nombreFormate(2,',',' ');
											lQuantite += parseFloat(this.stoQuantiteSolidaire);
										}
										
										lTotal += lMontant;
									} else if(this.proId == null) {
										these.stoQuantiteCommande = '0'.nombreFormate(2,',',' ');
										these.opeMontantCommande = '0'.nombreFormate(2,',',' ');
										these.stoQuantiteLivraison = '';
										these.opeMontantLivraison = '';
										these.stoQuantiteSolidaire = '';
									}
								});
								
								if(lQuantite - parseFloat(this.stoQuantite) < 0) {
									this.classEtat = 'qte-reservation-ko';
								} else {
									this.classEtat = 'qte-reservation-ok';
								}
									
								this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
							});	
							
							lResponse.total = '';
							if(lResponse.operationProducteur[0]) {
								if(lResponse.operationProducteur[0].montant != null) {
									lResponse.total = (lResponse.operationProducteur[0].montant * -1).nombreFormate(2,',',' ');
								}
								if(lResponse.operationProducteur[0].typePaiementChampComplementaire != null) {
									lResponse.champComplementaire = lResponse.operationProducteur[0].typePaiementChampComplementaire;
								}
							}
							
							lResponse.sigleMonetaire = gSigleMonetaire;
							lResponse.totalCommande = lTotal.nombreFormate(2,',',' ');
							lResponse.typePaiement = that.mTypePaiement;
							
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.listeProduitLivraison;
							
							var lHtml = that.affectListeProduit($(lTemplate.template(lResponse)));
							
							if(lResponse.operationProducteur[0] && lResponse.operationProducteur[0].typePaiement != null) {
								var lId = lResponse.operationProducteur[0].typePaiement;
								
								lHtml.find(':input[name=typepaiement]').selectOptions(lId);
								
								var lLabel = that.getLabelChamComplementaire(lId);
								if(lLabel != null) {
									lHtml.find("#label-champ-complementaire").text(lLabel);
									lHtml.find("#tr-champ-complementaire").show();
								} else {
									lHtml.find("#label-champ-complementaire").text('');
									lHtml.find("#tr-champ-complementaire").hide();
								}
							} else {
								lHtml.find("#label-champ-complementaire").text('');
								lHtml.find("#tr-champ-complementaire").hide();
							}
							
							$('#liste-pdt').replaceWith(lHtml);
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.listeProduitVide;
			$('#liste-pdt').replaceWith(lTemplate);
		}
	}
	
	this.affectListeProduit = function(pData) {
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectEtatCommande(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectTypePaiement(pData);
		pData = this.affectChangementEtatEdition (pData);
		return pData;
	}
	
	this.affectTypePaiement = function(pData) {
		var that = this;
		pData.find(':input[name=typepaiement]').change(function() {
			that.changerTypePaiement($(this));
		});
		return pData;
	}
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel);
			$("#tr-champ-complementaire").show();
		} else {
			$("#label-champ-complementaire").text('');
			$(":input[name=champ-complementaire]").val('');
			$("#tr-champ-complementaire").hide();
		}
	}
	
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.mTypePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].tppChampComplementaire == 1) {
				return lTpp[pId].tppLabelChampComplementaire;
			}
		}	
		return null;
	}
	
	this.affectEtatCommande = function(pData) {
		var that = this;
		pData.find(".qte-commande ,.qte-solidaire-commande ").keyup(function() {
			that.mEtatEdition = true;
			var lIdProduit = $(this).prev(".pro-id-etat").text();
			if(that.mListeProduit[lIdProduit]) {
				var lQuantite = 0;
				var lQuantiteLivraison = $(':input[name=qte-commande-' + lIdProduit + ']').val().numberFrToDb();
				var lQuantiteSolidaire = $(':input[name=qte-solidaire-commande-' + lIdProduit + ']').val().numberFrToDb();
				
				if(!isNaN(lQuantiteLivraison) && !lQuantiteLivraison.isEmpty()){
					lQuantite += parseFloat(lQuantiteLivraison);
				}
				if(!isNaN(lQuantiteSolidaire) && !lQuantiteSolidaire.isEmpty()){
					lQuantite += parseFloat(lQuantiteSolidaire);
				}
				
				if(lQuantite - that.mListeProduit[lIdProduit] < 0) {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ok')
						.addClass('qte-reservation-ko');
				} else {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ko')
						.addClass('qte-reservation-ok');
				}
			}
		});
		return pData;
	}
	
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find("#btn-enregistrer").click(function() {
			that.mSuiteEdition = 0;
			that.enregistrer();
		});
		pData.find(".qte-commande ,.prix-commande ").keyup(function(event) {
			if (event.keyCode == '13') {
				that.mSuiteEdition = 0;
				that.enregistrer();
			}			
		});
		return pData;
	}
	
	this.enregistrer = function() {
		var that = this;
		
		var lParam = new ProduitsBonDeLivraisonVO();
		
		lParam.id_commande = this.mIdCommande;
		lParam.id_producteur = this.mIdProducteur;
		lParam.export_type = 0;

		$('.pro-id').each(function() {
			var lId = $(this).text();				
			var lProduit = new ProduitBonDeLivraisonVO();
			lProduit.id  = lId;
			lProduit.quantite = $(':input[name=qte-commande-' + lId + ']').val().numberFrToDb();
			lProduit.quantiteSolidaire = $(':input[name=qte-solidaire-commande-' + lId + ']').val().numberFrToDb();
			lProduit.prix = $(':input[name=prix-commande-' + lId + ']').val().numberFrToDb();
			lParam.produits.push(lProduit);
		});		
		
		lParam.typePaiement = $(':input[name=typepaiement]').val();
		lParam.total = $(':input[name=total]').val().numberFrToDb();
		
		if(this.getLabelChamComplementaire(lParam.typePaiement) != null) {
			lParam.typePaiementChampComplementaireObligatoire = 1;
			lParam.typePaiementChampComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lParam.typePaiementChampComplementaireObligatoire = 0;
		}
		
		var lValid = new ProduitsBonDeLivraisonValid();
		var lVr = lValid.validAjout(lParam);
				
		if(lVr.valid) {
			$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mEtatEdition = false;
							if(that.mSuiteEdition == 1) {
								that.changementProducteur();
							} else if (that.mSuiteEdition == 2) {
								that.dialogExportBonDeLivraison();
							} else {
								var lVr = new TemplateVR();
								lVr.valid = false;
								lVr.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_301_CODE;
								erreur.message = ERR_301_MSG;
								lVr.log.erreurs.push(erreur);							
								
								Infobulle.generer(lVr,'');
							}
						} else {
							Infobulle.generer(lResponse,'');
							$('#select-prdt').selectOptions(that.mIdProducteur);
						}
					},"json"
			);
			
		} else {
			Infobulle.generer(lVr,'');
			$('#select-prdt').selectOptions(that.mIdProducteur);
		}
	}
	
	this.affectExportBonDeLivraison = function(pData) {		
		var that = this;		
		pData.find('#btn-export-bcom')
		.click(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 2;
				that.dialogEnregistrer();
			} else {
				that.dialogExportBonDeLivraison();
			}			
		});
		return pData;
	}
	
	this.affectChangementEtatEdition = function(pData) {
		var that = this;
		pData.find('.com-input-text').keyup(function() {that.mEtatEdition = true;});
		pData.find(':input[name=typepaiement]').change(function() {that.mEtatEdition = true;});
		return pData;
	}
	
	this.dialogExportBonDeLivraison = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogExportBonDeLivraison;
		$(lTemplate.template({comNumero:that.mComNumero})).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter': function() {
					// Récupération du formulaire
					var lFormat = $(this).find(':input[name=format]:checked').val();
					
					var lParam = new ExportBonLivraisonVO();
					lParam.pParam = 1;
					lParam.export_type = 1;
					lParam.id_commande = that.mIdCommande;
					lParam.format = lFormat;
					
					// Test des erreurs
					var lValid = new ExportBonLivraisonValid();
					var lVr = lValid.validAjout(lParam);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Affichage
						$.download("./index.php?m=GestionCommande&v=BonDeLivraison", lParam);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }
		});
	}
		
	this.dialogEnregistrer = function() {	
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogEnregistrement;
		
		$(lTemplate).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Enregistrer': function() {
					that.enregistrer();
					$(this).dialog('close');
				},
				'Annuler': function() {
					if(that.mSuiteEdition == 1) {
						$('#select-prdt').selectOptions(that.mIdProducteur);
					}
					$(this).dialog('close');
				},
				'Ne pas Enregistrer': function() {
					that.mEtatEdition = false;
					if(that.mSuiteEdition == 1) {
						that.changementProducteur();
					} else if (that.mSuiteEdition == 2) {
						that.changementProducteur();
						that.dialogExportBonDeLivraison();
					}
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	}
	
	this.construct(pParam);
};function InfoCommandeArchiveVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = 'afficherCommande';
		$.post(	"./index.php?m=GestionCommande&v=InfoCommandeArchive", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {		
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.infoCommandeArchive;
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		var lTotal = 0;
		var lTotalSolidaire = 0;
		
		$(lResponse.infoCommande).each(function() {
			
			if(this.stoQuantite == null) { this.stoQuantite = 0}
			if(this.opeMontant == null) { this.opeMontant = 0 }
			if(this.stoQuantiteLivraison == null) { this.stoQuantiteLivraison = 0 }
			if(this.opeMontantLivraison == null) { this.opeMontantLivraison = 0 }
			if(this.stoQuantiteSolidaire == null) { this.stoQuantiteSolidaire = 0 }
			if(this.stoQuantiteVente == null) { this.stoQuantiteVente = 0 }
			if(this.opeMontantVente == null) { this.opeMontantVente = 0 }
			if(this.stoQuantiteVenteSolidaire == null) { this.stoQuantiteVenteSolidaire = 0 }
			if(this.opeMontantVenteSolidaire == null) { this.opeMontantVenteSolidaire = 0 }
			
			lTotal -= parseFloat(this.opeMontantLivraison);
			lTotal += parseFloat(this.opeMontantVente);
			lTotalSolidaire += parseFloat(this.opeMontantVenteSolidaire);
			
			this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
			this.opeMontant = this.opeMontant.nombreFormate(2,',',' ');
			this.stoQuantiteLivraison = this.stoQuantiteLivraison.nombreFormate(2,',',' ');
			this.opeMontantLivraison = this.opeMontantLivraison.nombreFormate(2,',',' ');
			this.stoQuantiteSolidaire = this.stoQuantiteSolidaire.nombreFormate(2,',',' ');
			this.stoQuantiteVente = this.stoQuantiteVente.nombreFormate(2,',',' ');
			this.opeMontantVente = this.opeMontantVente.nombreFormate(2,',',' ');
			this.stoQuantiteVenteSolidaire = this.stoQuantiteVenteSolidaire.nombreFormate(2,',',' ');
			this.opeMontantVenteSolidaire = this.opeMontantVenteSolidaire.nombreFormate(2,',',' ');
		});
		
		lResponse.total = lTotal.nombreFormate(2,',',' ');
		lResponse.totalSolidaire = lTotalSolidaire.nombreFormate(2,',',' ');
		lResponse.numero = lResponse.detailMarche.numero;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
	}
	
	this.affect = function(pData) {
	//	pData = this.affectLienListeCommandeArchive(pData);
	//	pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	/*this.affectLienListeCommandeArchive = function(pData) {
		pData.find('#lien-marche-encours').click(function() {
			GestionListeCommandeVue();
		});
		return pData;
	}*/
	
	this.construct(pParam);
};function BonDeCommandeVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdCommande = null;
	this.mComNumero = null;
	this.mEtatEdition = false;
	this.mListeProduit = [];
	this.mSuiteEdition = 0;
	this.mIdProducteur = 0;
	
	this.construct = function(pParam) {
		var that = this;
		pParam.export_type = 0;
		$.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mEtatEdition = false;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.bonDeCommande;
		
		this.mIdCommande = pResponse.producteurs[0].comId;
		this.mComNumero = pResponse.comNumero;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));	
	}
	
	this.affect = function(pData) {
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectBtnRetourMarche(pData);
		pData = this.affectChangementProducteur(pData);
		pData = this.affectExportBonCommande(pData);
		return pData;
	}
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectChangementProducteur = function(pData) {
		var that = this;
		pData.find('#select-prdt').change(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 1;
				that.dialogEnregistrer();
			} else {
				that.changementProducteur();
			}
		});
		return pData;
	}
	
	this.changementProducteur = function() {
		var that = this;
		var lIdProducteur = $('#select-prdt').val();
		if(lIdProducteur > 0) {
			var lParam = {	"id_commande":that.mIdCommande,
						 	"id_producteur":lIdProducteur,
						 	export_type:0}
			$.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mIdProducteur = lIdProducteur;
							that.mEtatEdition = false;
							
							$(lResponse.produits).each(function() {
								that.mListeProduit[this.proId] = this.stoQuantite;
								
								this.stoQuantiteCommande = '';
								this.opeMontant = '';
								
								var lProId = this.proId;
								var these = this;
								
								$(lResponse.produitsCommande).each(function() {
									if(this.proId == lProId) {
										these.stoQuantiteCommande = this.stoQuantite;
										these.opeMontant = this.opeMontant.nombreFormate(2,',',' ');
									}
								});
								
								if(this.stoQuantiteCommande - this.stoQuantite < 0) {
									this.classEtat = 'qte-reservation-ko';
								} else {
									this.classEtat = 'qte-reservation-ok';
								}
								if(this.stoQuantiteCommande != '') {
									this.stoQuantiteCommande = this.stoQuantiteCommande.nombreFormate(2,',',' ');
								}
								this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
							});	
							
							lResponse.sigleMonetaire = gSigleMonetaire;
							
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.listeProduitBonDeCommande;
							
							$('#liste-pdt').replaceWith(that.affectListeProduit($(lTemplate.template(lResponse))));
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.listeProduitVide;
			$('#liste-pdt').replaceWith(lTemplate);
		}
	}
	
	this.affectListeProduit = function(pData) {
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectEtatCommande(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectEnregistrer(pData);
		return pData;
	}
	
	this.affectEtatCommande = function(pData) {
		var that = this;
		pData.find(":input").keyup(function() {
			that.mEtatEdition = true;
			var lIdProduit = $(this).prev(".pro-id").text();
			if(that.mListeProduit[lIdProduit]) {
				if($(this).val().numberFrToDb()- that.mListeProduit[lIdProduit] < 0) {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ok')
						.addClass('qte-reservation-ko');
				} else {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ko')
						.addClass('qte-reservation-ok');
				}
			}
		});
		return pData;
	}
	
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find("#btn-enregistrer").click(function() {
			that.mSuiteEdition = 0;
			that.enregistrer();
		});
		pData.find(".qte-commande ,.prix-commande ").keyup(function(event) {
			if (event.keyCode == '13') {
				that.mSuiteEdition = 0;
				that.enregistrer();
			}			
		});
		return pData;
	}
	
	this.enregistrer = function() {
		var that = this;
		
		var lParam = new ProduitsBonDeCommandeVO();
		
		lParam.id_commande = this.mIdCommande;
		lParam.id_producteur = this.mIdProducteur;
		lParam.export_type = 0;

		$('.pro-id').each(function() {
			var lId = $(this).text();				
			var lProduit = new ProduitBonDeCommandeVO();
			lProduit = {id:lId,
						quantite:$(':input[name=qte-commande-' + lId + ']').val().numberFrToDb(),
						prix:$(':input[name=prix-commande-' + lId + ']').val().numberFrToDb()
						};				
			lParam.produits.push(lProduit);
		});		
		
		var lValid = new ProduitsBonDeCommandeValid();
		var lVr = lValid.validAjout(lParam);
		
		if(lVr.valid) {
			return $.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mEtatEdition = false;
							
							if(that.mSuiteEdition == 1) {
								that.changementProducteur();
							} else if (that.mSuiteEdition == 2) {
								that.dialogExportBonDeCommande();
							} else {
								var lVr = new TemplateVR();
								lVr.valid = false;
								lVr.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_301_CODE;
								erreur.message = ERR_301_MSG;
								lVr.log.erreurs.push(erreur);							
								
								Infobulle.generer(lVr,'');
							}
						} else {
							Infobulle.generer(lResponse,'');
							$('#select-prdt').selectOptions(that.mIdProducteur);
						}
					},"json"
			);
			
		} else {
			Infobulle.generer(lVr,'');
			$('#select-prdt').selectOptions(that.mIdProducteur);
		}
	}
	
	this.affectExportBonCommande = function(pData) {
		var that = this;	
		pData.find('#btn-export-bcom')
		.click(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 2;
				that.dialogEnregistrer();
			} else {
				that.dialogExportBonDeCommande();				
			}			
		});
		return pData;
	}
	
	this.dialogExportBonDeCommande = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogExportBonDeCommande;
		$(lTemplate.template({comNumero:that.mComNumero})).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter': function() {
					// Récupération du formulaire
					var lFormat = $(this).find(':input[name=format]:checked').val();
					
					var lParam = new ExportBonReservationVO();
					lParam.pParam = 1;
					lParam.export_type = 1;
					lParam.id_commande = that.mIdCommande;
					lParam.format = lFormat;
					
					// Test des erreurs
					var lValid = new ExportBonReservationValid();
					var lVr = lValid.validAjout(lParam);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Affichage
						$.download("./index.php?m=GestionCommande&v=BonDeCommande", lParam);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }
		});
	}
	
	this.dialogEnregistrer = function() {	
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogEnregistrement;
		
		$(lTemplate).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Enregistrer': function() {
					that.enregistrer();
					$(this).dialog('close');
				},
				'Annuler': function() {
					if(that.mSuiteEdition == 1) {
						$('#select-prdt').selectOptions(that.mIdProducteur);
					}
					$(this).dialog('close');
				},
				'Ne pas Enregistrer': function() {
					that.mEtatEdition = false;
					if(that.mSuiteEdition == 1) {
						that.changementProducteur();
					} else if (that.mSuiteEdition == 2) {
						that.changementProducteur();
						that.dialogExportBonDeCommande();
					}
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	}
	
	this.construct(pParam);
};function ReservationAdherentVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mAdherent = null;
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = new Array();
	this.reservationModif = new Array();
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = "afficherReservation";
		$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mAdherent = lResponse.adherent;						

						that.infoCommande.comId = lResponse.commande[0].comId;
						that.infoCommande.comNumero = lResponse.commande[0].comNumero;
						that.infoCommande.comNom = lResponse.commande[0].comNom;
						that.infoCommande.comDescription = lResponse.commande[0].comDescription;
						that.infoCommande.dateTimeFinReservation = lResponse.commande[0].comDateFinReservation;
						that.infoCommande.dateFinReservation = lResponse.commande[0].comDateFinReservation.extractDbDate().dateDbToFr();
						that.infoCommande.heureFinReservation = lResponse.commande[0].comDateFinReservation.extractDbHeure();
						that.infoCommande.minuteFinReservation = lResponse.commande[0].comDateFinReservation.extractDbMinute();
						that.infoCommande.dateMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbDate().dateDbToFr();
						that.infoCommande.heureMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbHeure();
						that.infoCommande.minuteMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbMinute();
						that.infoCommande.heureMarcheFin = lResponse.commande[0].comDateMarcheFin.extractDbHeure();
						that.infoCommande.minuteMarcheFin = lResponse.commande[0].comDateMarcheFin.extractDbMinute();
						that.infoCommande.comArchive = lResponse.commande[0].comArchive;
							
						$(lResponse.commande).each(function() {
							var lLot = new Object();
							
							lLot.dcomId = this.dcomId;
							lLot.dcomIdProduit = this.dcomIdProduit;
							lLot.dcomTaille = this.dcomTaille;
							lLot.dcomPrix = this.dcomPrix;
							
							if(that.pdtCommande[this.proId]) {
								that.pdtCommande[this.proId].lot[lLot.dcomId] = lLot;
							} else {			
								var lproduit = new Object();
								lproduit.proId = this.proId;
								lproduit.proUniteMesure = this.proUniteMesure;
								lproduit.proMaxProduitCommande = this.proMaxProduitCommande;
								
								$(lResponse.stock).each(function() { 
									if(this.proId == lproduit.proId) {
										if(parseFloat(this.stoQuantite) < parseFloat(lproduit.proMaxProduitCommande)) {
											 lproduit.proMaxProduitCommande = this.stoQuantite;
										}
									}
								});

								lproduit.nproNom = this.nproNom;
								lproduit.nproDescription = this.nproDescription;
								lproduit.nproIdCategorie = this.nproIdCategorie;
								
								lproduit.lot = new Array();
								lproduit.lot[lLot.dcomId] = lLot;								
								that.pdtCommande[lproduit.proId] = lproduit;
							}
						});
						
						$(lResponse.reservation).each(function() {
							this.stoQuantite = this.stoQuantite * -1;
							that.reservation[this.proId] = this;
						});						
						that.afficher();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function() {		
		this.afficherDetailReservation();		
	}
	
	this.afficherDetailReservation = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.detailReservation;
		
		var lData = {};		
		lData.adhId = this.mAdherent.adhId;
		lData.adhNumero = this.mAdherent.adhNumero;
		lData.adhCompte = this.mAdherent.cptLabel;
		lData.adhNom = this.mAdherent.adhNom;
		lData.adhPrenom = this.mAdherent.adhPrenom;
		lData.adhSolde = this.mAdherent.opeMontant.nombreFormate(2,',',' ');
		
		lData.sigleMonetaire = gSigleMonetaire;
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		lData.reservation = new Array();
		var lTotal = 0;
		$(this.pdtCommande).each(function() {
			if(that.reservation[this.proId]) {
				var lPdt = new Object;
				lPdt.nproNom = this.nproNom;
				lPdt.stoQuantite = parseFloat(that.reservation[this.proId].stoQuantite);
				lPdt.proUniteMesure = this.proUniteMesure;
				lPdt.prix = 0;
				var lDcomId = that.reservation[this.proId].dcomId;
				
				$(this.lot).each(function() {
					if(this.dcomId == lDcomId) {
						lPdt.prix = (lPdt.stoQuantite / this.dcomTaille) * this.dcomPrix;
					}
				});
				lTotal += lPdt.prix;
				
				lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
				lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
				
				lData.reservation.push(lPdt);
			}			
		});
		lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	}
	
	this.afficherModifier = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.modifierReservation;
		var lData = {};
		lData.adhId = this.mAdherent.adhId;
		lData.adhNumero = this.mAdherent.adhNumero;
		lData.adhCompte = this.mAdherent.cptLabel;
		lData.adhNom = this.mAdherent.adhNom;
		lData.adhPrenom = this.mAdherent.adhPrenom;
		lData.adhSolde = this.mAdherent.opeMontant.nombreFormate(2,',',' ');
		lData.adhNouveauSolde = 0;
		lData.sigleMonetaire = gSigleMonetaire;
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		lData.produit = new Array();
				
		var lTotal = 0;		
		$(this.pdtCommande).each(function() {
			// Test si la ligne n'est pas vide
			if(this.proId) {
				var lPdt = {};
				lPdt.proId = this.proId;
				lPdt.nproNom = this.nproNom;
				lPdt.proMaxProduitCommande = parseFloat(this.proMaxProduitCommande).nombreFormate(2,',',' ');
				lPdt.proUniteMesure = this.proUniteMesure;
				
				lPdt.lot = new Array();
				
				var i = 0;
				var lLotReservation = -1;
				var lLotInit = -1;
				
				
				$(this.lot).each(function() {
					if(this.dcomId) {
						var lLot = {};
						lLot.dcomId = this.dcomId;
						lLot.dcomTaille = parseFloat(this.dcomTaille).nombreFormate(2,',',' ');
						lLot.dcomPrix = parseFloat(this.dcomPrix).nombreFormate(2,',',' ');
						lLot.prixReservation = parseFloat(this.dcomPrix);
						lLot.stoQuantiteReservation = parseFloat(this.dcomTaille);
						
						if(that.reservation[lPdt.proId] && (that.reservation[lPdt.proId].dcomId == this.dcomId)) {
								lLot.stoQuantiteReservation = parseFloat(that.reservation[lPdt.proId].stoQuantite);
								lLot.prixReservation = (lLot.stoQuantiteReservation / this.dcomTaille) * this.dcomPrix;
								lTotal += lLot.prixReservation;
								
								// Permet de cocher le lot correspondant à la résa
								lLotReservation = this.dcomId;
								lLot.checked = 'checked="checked"';
						}
												
						lLot.stoQuantiteReservation = lLot.stoQuantiteReservation.nombreFormate(2,',',' ');
						lLot.prixReservation = lLot.prixReservation.nombreFormate(2,',',' ');
						
						lPdt.lot.push(lLot);			
					}
				});
				
				lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
				
				// Si il y a une réservation pour ce produit on le coche
				if(lLotReservation != -1) {
					lPdt.checked = 'checked="checked"';
				} else {
					// Sinon on coche par défaut le premier lot
					if(lPdt.lot[0]) {
						lPdt.lot[0].checked = 'checked="checked"';
					}
				}
				
				lData.produit.push(lPdt);			
			}
		});
		
		// Maj des reservations temp pour modif
		this.reservationModif = new Array();
		$(this.reservation).each(function() {
			if(this.proId) {
				//var lR = {comId:this.comId,proId:this.proId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};				
				that.reservationModif[this.proId] = {comId:this.comId,proId:this.proId,dcomId:this.dcomId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};
			}
		});
		
		$('#contenu').replaceWith(that.affectModifier($(lTemplate.template(lData))));
	}
	
	this.affect = function(pData) {
		pData = this.affectModifierReservation(pData);
		pData = this.affectAnnulerDetailReservation(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectSupprimerReservation(pData);		
		return pData;
	}
		
	this.affectModifier = function(pData) {
		pData = this.affectBtnQte(pData);
		pData = this.affectChangementLot(pData);
		pData = this.affectChangementProduit(pData);
		pData = this.preparerAffichageModifier(pData);
		pData = this.affectValiderReservation(pData);
		pData = this.affectAnnulerReservation(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectBtnQte = function(pData) {
		var that = this;
		pData.find('.btn-plus').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),1);
		});	
		pData.find('.btn-moins').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),-1);
		});
		return pData;		
	}
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.lot').click(function() {
			$(this).find(':radio').attr("checked","checked");
			that.changerLot($(this).find(".pdt-id").text(),$(this).find(".lot-id").text());
		});
		return pData;
	}
	
	this.affectChangementProduit = function(pData) {
		var that = this;
		pData.find('.pdt :checkbox').click(function() {
			that.changerProduit($(this).parent().parent().find(".pdt-id").text());			
		});
		return pData;
	}
	
	this.affectValiderReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.validerReservation();			
		});
		return pData;	
	}
	
	this.affectAnnulerReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {			
			that.afficherDetailReservation();		
		});
		return pData;
	}
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.afficherModifier();		
		});
		return pData;
	}
	
	this.affectAnnulerDetailReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {
			EditerCommandeVue({"id_commande":that.infoCommande.comId});		
		});
		return pData;
	}
		
	this.nouvelleQuantite = function(pIdPdt,pIdLot,pIncrement) {
		var lMax = this.pdtCommande[pIdPdt].proMaxProduitCommande;
		var lTaille = this.pdtCommande[pIdPdt].lot[pIdLot].dcomTaille;
		var lPrix = this.pdtCommande[pIdPdt].lot[pIdLot].dcomPrix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservationModif[pIdPdt] && (this.reservationModif[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = this.reservationModif[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;
		
		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNvQteReservation > 0 && lNvQteReservation <= lMax) {
			var lNvPrix = 0;
			lNvPrix = lQteReservation * lPrix;
			
			// Mise à jour de la quantite reservée
			this.reservationModif[pIdPdt].stoQuantite = lNvQteReservation;			
			
			$('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

			this.majTotal();
		}		
	}	
	
	this.changerLot = function(pIdPdt,pIdLot) {		
		// Masque tout les lots
		$('.btn-pdt-' + pIdPdt).attr("disabled","disabled").addClass("ui-helper-hidden");
		$('.colonne-pdt-' + pIdPdt).addClass("ui-helper-hidden");
				
		// Affiche uniquement le lot sélectionné
		$('#btn-moins-lot-' + pIdLot + ',#btn-plus-lot-' + pIdLot).removeAttr("disabled").removeClass("ui-helper-hidden");
		$('#colonne-qte-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-prix-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-sigle-pdt-' + pIdPdt + '-lot-' + pIdLot).removeClass("ui-helper-hidden");
	
		// Mise à jour de la quantite reservée
		this.reservationModif[pIdPdt].stoQuantite = $('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text().numberFrToDb();
		this.reservationModif[pIdPdt].dcomId = pIdLot;
		
		this.majTotal();
	}
	
	this.changerProduit = function(pIdPdt) {
		var that = this;
		if($('#pdt-' + pIdPdt).find(':checkbox').attr("checked")) {
			$('.lot-pdt-' + pIdPdt).show();
			
			// Mise à jour de la quantite reservée
			$('[name=lot-produit-' + pIdPdt + ']').each(function() {
				//alert(this.attr('checked'));
				if($(this).attr('checked')) {
					var lQte = $('#qte-pdt-' + pIdPdt + '-lot-' + $(this).parent().parent().find(".lot-id").text()).text().numberFrToDb();
					if(that.reservationModif[pIdPdt]) {
						that.reservationModif[pIdPdt].stoQuantite = lQte;
					} else {
						var lResa = {};
						lResa.comId = that.infoCommande.comId;
						//lResa.proId = pIdPdt;
						lResa.dcomId = lIdLot;
						lResa.stoQuantite = lQte;						
						that.reservationModif[pIdPdt] = lResa;
					}
				}
			});
		} else {			
			$('.lot-pdt-' + pIdPdt).hide();
			
			// Mise à jour de la quantite reservée
			if(this.reservationModif[pIdPdt]) {
				this.reservationModif[pIdPdt] = null;
			}
		}
		
		this.majTotal();
	}
	
	this.majTotal = function() {
		$('#total').text(this.calculTotal().nombreFormate(2,',',' '));
		this.majNouveauSolde();
	}
	
	this.majNouveauSolde = function() {
		var lNvSolde = this.mAdherent.opeMontant - this.calculTotal();
		if(lNvSolde <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lNvSolde.nombreFormate(2,',',' '));
	}
	
	this.affectNouveauSolde = function(pData) {
		var lNvSolde = this.mAdherent.opeMontant - this.calculTotal();
		if(lNvSolde <= 0) {
			pData.find("#nouveau-solde").addClass("com-nombre-negatif");
			pData.find("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			pData.find("#nouveau-solde").removeClass("com-nombre-negatif");
			pData.find("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		pData.find("#nouveau-solde").text(lNvSolde.nombreFormate(2,',',' '));
		return pData;		
	}
	
	this.calculTotal = function() {
		var that = this;
		var lTotal = 0;
		$(this.reservationModif).each(function() {
			var lResa = this;
			if(lResa.stoQuantite) {
				if(that.pdtCommande[lResa.proId]) {
					$(that.pdtCommande[lResa.proId].lot).each(function() {
						if(lResa.dcomId == this.dcomId) {
							lTotal += (lResa.stoQuantite / this.dcomTaille) * this.dcomPrix;
						}
					});					
				}				
			}
		});
		return lTotal;
	}
	
	this.preparerAffichageModifier = function(pData) {
		var that = this;
		// Cache les lots
		pData.find(':checkbox:not(:checked)').each(function() {			
			pData.find('.lot-pdt-' + $(this).parent().parent().find('.pdt-id').text()).hide();
		});
		//Cache les autres lots
		pData.find(':radio:not(:checked)').each(function() {
			var lIdLot = $(this).parent().parent().find('.lot-id').text();
			var lIdPdt = $(this).parent().parent().find('.pdt-id').text();
			
			pData.find('#btn-moins-lot-' + lIdLot + ',#btn-plus-lot-' + lIdLot).attr("disabled","disabled").addClass("ui-helper-hidden");
			pData.find('#colonne-qte-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-prix-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-sigle-pdt-' + lIdPdt + '-lot-' + lIdLot).addClass("ui-helper-hidden");
		});
		return pData;
	}
	
	this.validerReservation = function() {
		var that = this;
		Infobulle.init(); // Supprime les erreurs
		
		var lVo = new ListeReservationCommandeVO();
		var lNbPdt = 0;
		$(this.reservationModif).each(function() {
			if(this.stoQuantite) {
				var lVoResa = new ReservationCommandeVO();
				lVoResa.id = '';
				lVoResa.stoQuantite = this.stoQuantite * -1;
				lVoResa.stoIdDetailCommande = this.dcomId;
				lVo.commandes.push(lVoResa);
				lNbPdt++;
			}
		});
		
		if(lNbPdt > 0){
			var lValid = new ListeReservationCommandeValid();
			var lVR = lValid.validAjout(lVo);
			if(!lVR.valid){
				Infobulle.generer(lVR,'');
			} else {
				// Maj de la reservation
				lParam = {"reservation":lVo,"id_compte":this.mAdherent.adhIdCompte,fonction:"modifierReservation"};
				$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {							
							// Maj des reservations pour le recap
							that.reservation = new Array();
							$(that.reservationModif).each(function() {
								if(this.proId) {									
									that.reservation[this.proId] = {comId:this.comId,proId:this.proId,dcomId:this.dcomId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};
								}
							});
							that.afficher();
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
				);	
			}			
		} else {
			var lVR = new TemplateVR();
			lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_207_CODE;erreur.message = ERR_207_MSG;lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,'');
		}		
	}
	
	this.affectSupprimerReservation = function(pData) {
		var that = this;
		pData.find('#btn-supprimer').click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.supprimerReservationDialog;
			$(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {	id_commande:that.infoCommande.comId,
										id_adherent:that.mAdherent.adhId,
										fonction:"supprimerReservation"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										
										var lVr = new TemplateVR();
										lVr.valid = false;
										lVr.log.valid = false;
										var erreur = new VRerreur();
										erreur.code = ERR_303_CODE;
										erreur.message = ERR_303_MSG;
										lVr.log.erreurs.push(erreur);							

										// Redirection vers la vue edition
										EditerCommandeVue({id_commande:that.infoCommande.comId,
															vr:lVr});
										
										$(lDialog).dialog("close");
										
									} else {
										Infobulle.generer(lResponse,'');
									}
								},"json"
						);
					},
					'Annuler': function() { $(this).dialog("close"); }
					},
				close: function(ev, ui) { $(this).remove(); }
			})
		});
		return pData;
	}
	
	this.construct(pParam);
};function EditerCommandeVue(pParam) {
	this.mNiveau = [];
	this.mIdCommande = null;
	this.mCommande = null;
	
	this.construct = function(pParam) {
		var that = this;
		pParam.export_type = 0;
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficher(lResponse);
						if(pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
				
		var lData = {};
		
		lData.comId = pResponse.commande[0].comId;
		this.mIdCommande = lData.comId;
		lData.comNumero = pResponse.commande[0].comNumero;
		lData.comDescription = pResponse.commande[0].comDescription;
		lData.dateTimeFinReservation = pResponse.commande[0].comDateFinReservation;
		lData.dateFinReservation = pResponse.commande[0].comDateFinReservation.extractDbDate().dateDbToFr();
		lData.heureFinReservation = pResponse.commande[0].comDateFinReservation.extractDbHeure();
		lData.minuteFinReservation = pResponse.commande[0].comDateFinReservation.extractDbMinute();
		lData.dateMarcheDebut = pResponse.commande[0].comDateMarcheDebut.extractDbDate().dateDbToFr();
		lData.heureMarcheDebut = pResponse.commande[0].comDateMarcheDebut.extractDbHeure();
		lData.minuteMarcheDebut = pResponse.commande[0].comDateMarcheDebut.extractDbMinute();
		lData.heureMarcheFin = pResponse.commande[0].comDateMarcheFin.extractDbHeure();
		lData.minuteMarcheFin = pResponse.commande[0].comDateMarcheFin.extractDbMinute();
		
		lData.pdtCommande = [];
		
		$(pResponse.commande).each(function() {
			var lLot = {"dcomTaille":this.dcomTaille.nombreFormate(2,',',' '),"dcomPrix":this.dcomPrix.nombreFormate(2,',',' ')};
			
			if(lData.pdtCommande[this.proId]) {
				lData.pdtCommande[this.proId].lot[this.dcomId] = lLot;
			} else {			
				var lProduit = {
						"proId":this.proId,
						"proUniteMesure":this.proUniteMesure,
						"proMaxProduitCommande":this.proMaxProduitCommande.nombreFormate(2,',',' '),
						"nproNom":this.nproNom,
						"lot":[]};
				lProduit.lot[this.dcomId] = lLot;
				
				$(pResponse.stockInitiaux).each(function() {
					if(this.idProduit == lProduit.proId) {
						lProduit.quantiteInit = this.quantite;
					}					
				});
				
				$(pResponse.stock).each(function() {
					if(this.proId == lProduit.proId) {
						lProduit.quantite = this.stoQuantite;
					}					
				});
				
				
				lProduit.quantiteCommande = lProduit.quantiteInit - lProduit.quantite;
				that.mNiveau.push({'id':lProduit.proId,'quantite':parseInt(lProduit.quantiteCommande*100/lProduit.quantiteInit)});
				
				lProduit.quantiteCommande = lProduit.quantiteCommande.nombreFormate(2,',',' ');
				lProduit.quantiteInit = lProduit.quantiteInit.nombreFormate(2,',',' ');
				lProduit.quantite = lProduit.quantite.nombreFormate(2,',',' ');
				
				lData.pdtCommande[this.proId] = lProduit;
			}
		});
		
		lData.listeAdherentCommande = pResponse.listeAdherentCommande;
		lData.sigleMonetaire = gSigleMonetaire;
		
		this.mCommande = lData;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
	/*	var lTemplate = lGestionCommandeTemplate.editerCommandePageEntete;
		var lHtml = lTemplate.template(lData);*/
		
		var lTemplate = lGestionCommandeTemplate.editerCommandePage;
		//lHtml += lTemplate.template(lData);
		
		var lHtml = that.affect($(lTemplate.template(lData)));
		
		// Si il n'y a pas de résa on affiche pas le tableau
		if(!(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null)) {			
			lHtml.find('#edt-com-recherche').hide();
			lHtml.find('#edt-com-liste-resa').replaceWith(lGestionCommandeTemplate.listeReservationVide);
		}
		
		$('#contenu').replaceWith(lHtml);	
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectNiveau(pData);
		pData = this.affectReservation(pData);
		pData = this.affectModifier(pData);
		pData = this.affectCloturer(pData);
		pData = this.affectExportReservation(pData);
		pData = this.affectBonDeCommande(pData);
		pData = this.affectBonDeLivraison(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[2,0]] });
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	}
	
	this.affectNiveau = function(pData) {		
		$(this.mNiveau).each(function() {
			var lId = this.id;
			var lQuantite = this.quantite;
			pData.find('#pdt-' + lId).progressbar({
				value:lQuantite
			});
			
			pData.find('.pdt-' + lId + '-afficher-detail').click(function() {
				pData.find('#pdt-' + lId + '-detail').slideToggle();
				pData.find('.pdt-' + lId + '-afficher-detail').toggle();
			});	
		});
		return pData;
	}
	
	this.affectReservation = function(pData) {
		var that = this;
		pData.find('.edt-com-reservation-ligne').click(function() {
			ReservationAdherentVue({"id_commande":that.mIdCommande,"id_adherent":$(this).find('.id-adherent').text()});
		});
		return pData;
	}
	
	this.affectModifier = function(pData) {	
		var that = this;
		pData.find('#btn-modif-com').click(function() {
			ModifierCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectBonDeCommande = function(pData) {
		var that = this;
		pData.find('#btn-bon-com').click(function() {
			BonDeCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectBonDeLivraison = function(pData) {
		var that = this;
		pData.find('#btn-livraison-com').click(function() {
			BonDeLivraisonVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectCloturer = function(pData) {
		var that = this;
		pData.find('#btn-cloture-com')
		.click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogClotureCommande;
			
			$(lTemplate.template(that.mCommande)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Cloturer': function() {
						var lParam = {id_commande:that.mIdCommande};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=CloturerCommande", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.cloturerCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lResponse));
										$(lDialog).dialog('close');
									} else {
										Infobulle.generer(lResponse,'');
									}
								},"json"
						);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
		});
		return pData;
	}
	
	this.affectExportReservation = function(pData) {		
		var that = this;
		pData.find('#btn-export-resa')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogExportListeReservation;
			
			$(lTemplate.template(that.mCommande)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Exporter': function() {
						// Récupération du formulaire
						var lIdProduits = '';
						$(this).find(':input[name=id_produits]:checked').each(function() {
							lIdProduits += $(this).val() + ',';
						});
						lIdProduits = lIdProduits.substr(0,lIdProduits.length-1);
						
						var lFormat = $(this).find(':input[name=format]:checked').val();
						var lParam = new ExportListeReservationVO();
						lParam = {pParam:1,export_type:1,id_commande:that.mIdCommande,id_produits:lIdProduits,format:lFormat};
						
						// Test des erreurs
						var lValid = new ExportListeReservationValid();
						var lVr = lValid.validAjout(lParam);
						
						Infobulle.init(); // Supprime les erreurs
						if(lVr.valid) {
							// Affichage
							$.download("./index.php?m=GestionCommande&v=EditerCommande", lParam);
						} else {
							Infobulle.generer(lVr,'');
						}
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
			
		});
		return pData;
	}
	
	this.construct(pParam);
};function MonCompteVue(pParam) {	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=MonCompte&v=MonCompte", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
						
						// Maj du Menu
						var lCommunVue = new CommunVue();
						lCommunVue.majMenu('MonCompte','MonCompte');
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		if(lResponse.adherent.adhId == null) { //SuperZeybu
			lResponse.adherent.opeMontant = 0;
			lResponse.adherent.adhDateNaissance = '0000-00-00';
			lResponse.adherent.adhDateAdhesion = '0000-00-00';
		}
		lResponse.opeMontant = lResponse.adherent.opeMontant.nombreFormate(2,',',' ');
		
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		lResponse.adherent.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lResponse.adherent.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		
		$(lResponse.operationPassee).each(function() {
			if(this.opeDate != null) {
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
				if(this.opeMontant < 0) {
					this.debit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
					this.credit = '';
				} else {
					this.debit = '';
					this.credit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				}
			}
		});
		
		var lNvSolde = parseFloat(lResponse.adherent.opeMontant);
		var lRechargementPrecedent = 0;
		$(lResponse.operationAvenir).each(function() {
			if(this.opeDate != null) {
				lNvSolde += parseFloat(this.opeMontant);
				this.nouveauSolde = lNvSolde.nombreFormate(2,',',' ');
				this.rechargement = (0).nombreFormate(2,',',' ');				
				var lSoldeCible = 5;
				if(lNvSolde < lSoldeCible) {
					this.rechargement = (Math.ceil((lSoldeCible-lNvSolde)/lSoldeCible) * lSoldeCible) - lRechargementPrecedent;
				}
				lRechargementPrecedent += this.rechargement;
				this.rechargement = this.rechargement.nombreFormate(2,',',' ');
				
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.comDateMarche = this.comDateMarche.extractDbDate().dateDbToFr();
				this.opeMontant = (this.opeMontant * -1).nombreFormate(2,',',' ');
			}
		});
				
		var lMonCompteTemplate = new MonCompteTemplate();
		var lCommunTemplate = new CommunTemplate();
		//var lTemplate = lMonCompteTemplate.monCompte;
		
		var lHtml = lCommunTemplate.debutContenu;		
		lHtml += lMonCompteTemplate.infoCompteAdherent.template(lResponse.adherent);
		lHtml += lMonCompteTemplate.listeOperationAdherentDebut.template(lResponse);
		lHtml += lMonCompteTemplate.listeOperationPassee.template(lResponse);
		// Affiche des opérations avenir uniquement si elles existent
		if(isArray(lResponse.operationAvenir) && lResponse.operationAvenir[0].opeLibelle != null) {
			lHtml += lMonCompteTemplate.listeOperationAvenir.template(lResponse);
		}
		lHtml += lMonCompteTemplate.listeOperationAdherentFin.template(lResponse);
		lHtml += lCommunTemplate.finContenu;
		
		lHtml = $(lHtml);
		if(lResponse.adherent.opeMontant < 0) {
			lHtml = this.soldeNegatif(lHtml);
		}
		
		// Ne pas afficher la pagination si il y a moins de 10 éléments
		if(lResponse.operationPassee.length < 11) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}		

		$('#contenu').replaceWith(that.affect(lHtml));	
	}
	
	this.affect = function(pData) {
		pData = this.nouveauSoldeNegatif(pData);
		pData = this.affectHover(pData);
		pData = this.affectEditionInfo(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false}); 
		return pData;
	}
	
	this.nouveauSoldeNegatif = function(pData) {
		pData.find('.nouveau-solde-val').each(function() {
			if(parseFloat($(this).text().numberFrToDb()) < 0 ) {
				$(this).closest('.nouveau-solde').addClass("com-nombre-negatif");
			}
		});
		return pData;
	}
	
	this.soldeNegatif = function(pData) {
		pData.find('#solde').addClass("com-nombre-negatif");
		return pData;
	}
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.affectEditionInfo = function(pData) {		
		var that = this;
		pData.find('#btn-edt-info').click(function() {
			var lMonCompteTemplate = new MonCompteTemplate();
			var lTemplate = lMonCompteTemplate.dialogEditionCompte;
			
			var lDialog = $(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Valider': function() {
						that.changerMotPasse(this);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
			});
			lDialog.find(':input').keyup(function(event) {
				if (event.keyCode == '13') {
					that.changerMotPasse(lDialog);
				}
			});
		});
		
		return pData;
	}
	
	this.changerMotPasse = function(pDialog) {
		var lVo = new InfoAdherentVO();
		var lForm = $('#dialog-edt-info-cpt form');
		
		lVo.motPasse = lForm.find(':input[name=pass]').val();
		lVo.motPasseNouveau = lForm.find(':input[name=pass_nouveau]').val();
		lVo.motPasseConfirm = lForm.find(':input[name=pass_confirm]').val();

		var lValid = new InfoAdherentValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {
			$.post(	"./index.php?m=MonCompte&v=ModifierMonCompte", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {										
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_302_CODE;
						erreur.message = ERR_302_MSG;
						lVr.log.erreurs.push(erreur);							
						
						Infobulle.generer(lVr,'');
						$(pDialog).dialog('close');
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);			
		} else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
};function AfficherReservationVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = new Array();
	this.reservationModif = new Array();
	
	this.construct = function(pParam) {
		var that = this; // TODO pParam coté server
		$.post(	"./index.php?m=Commande&v=AfficherReservation", "id_commande=" + pParam.id_commande,
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.infoCommande.comId = lResponse.commande[0].comId;
						that.infoCommande.comNumero = lResponse.commande[0].comNumero;
						that.infoCommande.comNom = lResponse.commande[0].comNom;
						that.infoCommande.comDescription = lResponse.commande[0].comDescription;
						that.infoCommande.dateTimeFinReservation = lResponse.commande[0].comDateFinReservation;
						that.infoCommande.dateFinReservation = lResponse.commande[0].comDateFinReservation.extractDbDate().dateDbToFr();
						that.infoCommande.heureFinReservation = lResponse.commande[0].comDateFinReservation.extractDbHeure();
						that.infoCommande.minuteFinReservation = lResponse.commande[0].comDateFinReservation.extractDbMinute();
						that.infoCommande.dateMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbDate().dateDbToFr();
						that.infoCommande.heureMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbHeure();
						that.infoCommande.minuteMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbMinute();
						that.infoCommande.heureMarcheFin = lResponse.commande[0].comDateMarcheFin.extractDbHeure();
						that.infoCommande.minuteMarcheFin = lResponse.commande[0].comDateMarcheFin.extractDbMinute();
						that.infoCommande.comArchive = lResponse.commande[0].comArchive;
							
						$(lResponse.commande).each(function() {
							var lLot = new Object();
							
							lLot.dcomId = this.dcomId;
							lLot.dcomIdProduit = this.dcomIdProduit;
							lLot.dcomTaille = this.dcomTaille;
							lLot.dcomPrix = this.dcomPrix;
							
							if(that.pdtCommande[this.proId]) {
								that.pdtCommande[this.proId].lot[lLot.dcomId] = lLot;
							} else {			
								var lproduit = new Object();
								lproduit.proId = this.proId;
								lproduit.proUniteMesure = this.proUniteMesure;
								lproduit.proMaxProduitCommande = this.proMaxProduitCommande;
																
								$(lResponse.stock).each(function() { 
									if(this.proId == lproduit.proId) {
										if(parseFloat(this.stoQuantite) < parseFloat(lproduit.proMaxProduitCommande)) {
											 lproduit.proMaxProduitCommande = this.stoQuantite;
										}
									}
								});

								lproduit.nproNom = this.nproNom;
								lproduit.nproDescription = this.nproDescription;
								lproduit.nproIdCategorie = this.nproIdCategorie;
								
								lproduit.lot = new Array();
								lproduit.lot[lLot.dcomId] = lLot;								
								that.pdtCommande[lproduit.proId] = lproduit;
							}
						});
						
						$(lResponse.reservation).each(function() {
							this.stoQuantite = this.stoQuantite * -1;
							that.reservation[this.proId] = this;
						});	
						
						that.afficher();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
		
	}
	
	this.afficher = function() {		
		this.afficherDetailReservation();		
	}
	
	this.afficherDetailReservation = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.mesCommandesDetailReservation;
		
		var lData = new Object();
		lData.sigleMonetaire = gSigleMonetaire;
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		lData.reservation = new Array();
		var lTotal = 0;
		$(this.pdtCommande).each(function() {
			if(that.reservation[this.proId]) {
				var lPdt = new Object;
				lPdt.nproNom = this.nproNom;
				lPdt.stoQuantite = parseFloat(that.reservation[this.proId].stoQuantite);
				lPdt.proUniteMesure = this.proUniteMesure;
				lPdt.prix = 0;
				var lDcomId = that.reservation[this.proId].dcomId;	
				
				$(this.lot).each(function() {
					if(this.dcomId == lDcomId) {
						lPdt.prix = (lPdt.stoQuantite / this.dcomTaille) * this.dcomPrix;
					}
				});
				lTotal += lPdt.prix;
				
				lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
				lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
				
				lData.reservation.push(lPdt);
			}			
		});
		lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	}
	
	this.afficherModifier = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.modifierReservation;
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		lData.produit = new Array();
				
		var lTotal = 0;		
		$(this.pdtCommande).each(function() {
			// Test si la ligne n'est pas vide
			if(this.proId) {
				var lPdt = {};
				lPdt.proId = this.proId;
				lPdt.nproNom = this.nproNom;
				lPdt.proMaxProduitCommande = parseFloat(this.proMaxProduitCommande).nombreFormate(2,',',' ');
				lPdt.proUniteMesure = this.proUniteMesure;
				
				lPdt.lot = new Array();
				
				var i = 0;
				var lLotReservation = -1;
				var lLotInit = -1;
				
				
				$(this.lot).each(function() {
					if(this.dcomId) {
						var lLot = {};
						lLot.dcomId = this.dcomId;
						lLot.dcomTaille = parseFloat(this.dcomTaille).nombreFormate(2,',',' ');
						lLot.dcomPrix = parseFloat(this.dcomPrix).nombreFormate(2,',',' ');
						lLot.prixReservation = parseFloat(this.dcomPrix);
						lLot.stoQuantiteReservation = parseFloat(this.dcomTaille);
						
						if(that.reservation[lPdt.proId] && (that.reservation[lPdt.proId].dcomId == this.dcomId)) {
								lLot.stoQuantiteReservation = parseFloat(that.reservation[lPdt.proId].stoQuantite);
								lLot.prixReservation = (lLot.stoQuantiteReservation / this.dcomTaille) * this.dcomPrix;
								lTotal += lLot.prixReservation;
								
								// Permet de cocher le lot correspondant à la résa
								lLotReservation = this.dcomId;
								lLot.checked = 'checked="checked"';
						}
												
						lLot.stoQuantiteReservation = lLot.stoQuantiteReservation.nombreFormate(2,',',' ');
						lLot.prixReservation = lLot.prixReservation.nombreFormate(2,',',' ');
						
						lPdt.lot.push(lLot);			
					}
				});
				
				lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
				
				// Si il y a une réservation pour ce produit on le coche
				if(lLotReservation != -1) {
					lPdt.checked = 'checked="checked"';
				} else {
					// Sinon on coche par défaut le premier lot
					if(lPdt.lot[0]) {
						lPdt.lot[0].checked = 'checked="checked"';
					}
				}
				
				lData.produit.push(lPdt);			
			}
		});
		
		// Maj des reservations temp pour modif
		this.reservationModif = new Array();
		$(this.reservation).each(function() {
			if(this.proId) {
				//var lR = {comId:this.comId,proId:this.proId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};				
				that.reservationModif[this.proId] = {comId:this.comId,proId:this.proId,dcomId:this.dcomId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};
			}
		});
		
		$('#contenu').replaceWith(that.affectModifier($(lTemplate.template(lData))));
	}
	
	this.affect = function(pData) {
		pData = this.affectDroitEdition(pData);
		pData = this.affectModifierReservation(pData);
		pData = this.affectSupprimerReservation(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectDroitEdition = function(pData) {
		// Si la date de fin des réservations est passée on bloque la possibilitée de modifier
		if(!dateTimeEstPLusGrandeEgale(this.infoCommande.dateTimeFinReservation,getDateTimeAujourdhuiDb(),'db')) {
			pData.find('.boutons-edition').hide();
		}
		return pData;
	}
	
	this.affectModifier = function(pData) {
		pData = this.affectBtnQte(pData);
		pData = this.affectChangementLot(pData);
		pData = this.affectChangementProduit(pData);
		pData = this.preparerAffichageModifier(pData);
		pData = this.affectValiderReservation(pData);
		pData = this.affectAnnulerReservation(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectBtnQte = function(pData) {
		var that = this;
		pData.find('.btn-plus').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),1);
		});	
		pData.find('.btn-moins').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),-1);
		});
		return pData;		
	}
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.lot').click(function() {
			$(this).find(':radio').attr("checked","checked");
			that.changerLot($(this).find(".pdt-id").text(),$(this).find(".lot-id").text());
		});
		return pData;
	}
	
	this.affectChangementProduit = function(pData) {
		var that = this;
		pData.find('.pdt :checkbox').click(function() {
			that.changerProduit($(this).parent().parent().find(".pdt-id").text());			
		});
		return pData;
	}
	
	this.affectValiderReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.validerReservation();			
		});
		return pData;	
	}
	
	this.affectAnnulerReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {			
			that.afficherDetailReservation();		
		});
		return pData;
	}
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.afficherModifier();		
		});
		return pData;
	}
		
	this.nouvelleQuantite = function(pIdPdt,pIdLot,pIncrement) {
		var lMax = this.pdtCommande[pIdPdt].proMaxProduitCommande;
		var lTaille = this.pdtCommande[pIdPdt].lot[pIdLot].dcomTaille;
		var lPrix = this.pdtCommande[pIdPdt].lot[pIdLot].dcomPrix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservationModif[pIdPdt] && (this.reservationModif[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = this.reservationModif[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;
		
		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNvQteReservation > 0 && lNvQteReservation <= lMax) {
			var lNvPrix = 0;
			lNvPrix = lQteReservation * lPrix;
			
			// Mise à jour de la quantite reservée
			this.reservationModif[pIdPdt].stoQuantite = lNvQteReservation;			
			
			$('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

			this.majTotal();
		}		
	}	
	
	this.changerLot = function(pIdPdt,pIdLot) {		
		// Masque tout les lots
		$('.btn-pdt-' + pIdPdt).attr("disabled","disabled").addClass("ui-helper-hidden");
		$('.colonne-pdt-' + pIdPdt).addClass("ui-helper-hidden");
				
		// Affiche uniquement le lot sélectionné
		$('#btn-moins-lot-' + pIdLot + ',#btn-plus-lot-' + pIdLot).removeAttr("disabled").removeClass("ui-helper-hidden");
		$('#colonne-qte-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-prix-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-sigle-pdt-' + pIdPdt + '-lot-' + pIdLot).removeClass("ui-helper-hidden");
	
		// Mise à jour de la quantite reservée
		this.reservationModif[pIdPdt].stoQuantite = $('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text().numberFrToDb();
		this.reservationModif[pIdPdt].dcomId = pIdLot;
		
		this.majTotal();
	}
	
	this.changerProduit = function(pIdPdt) {
		var that = this;
		if($('#pdt-' + pIdPdt).find(':checkbox').attr("checked")) {
			$('.lot-pdt-' + pIdPdt).show();
			
			// Mise à jour de la quantite reservée
			$('[name=lot-produit-' + pIdPdt + ']').each(function() {
				//alert(this.attr('checked'));
				if($(this).attr('checked')) {
					var lIdLot = $(this).parent().parent().find(".lot-id").text();
					var lQte = $('#qte-pdt-' + pIdPdt + '-lot-' + lIdLot).text().numberFrToDb();
					if(that.reservationModif[pIdPdt]) {
						that.reservationModif[pIdPdt].stoQuantite = lQte;
					} else {
						var lResa = {};
						lResa.comId = that.infoCommande.comId;
						lResa.dcomId = lIdLot;
						lResa.stoQuantite = lQte;						
						that.reservationModif[pIdPdt] = lResa;
					}
				}
			});
		} else {			
			$('.lot-pdt-' + pIdPdt).hide();
			
			// Mise à jour de la quantite reservée
			if(this.reservationModif[pIdPdt]) {
				this.reservationModif[pIdPdt] = null;
			}
		}
		
		this.majTotal();
	}
	
	this.majTotal = function() {		
		$('#total').text(this.calculTotal().nombreFormate(2,',',' '));
	}
	
	this.calculTotal = function() {
		var that = this;
		var lTotal = 0;
		$(this.reservationModif).each(function() {
			var lResa = this;
			if(lResa.stoQuantite) {
				if(that.pdtCommande[lResa.proId]) {
					$(that.pdtCommande[lResa.proId].lot).each(function() {
						if(lResa.dcomId == this.dcomId) {
							lTotal += (lResa.stoQuantite / this.dcomTaille) * this.dcomPrix;
						}
					});					
				}				
			}
		});
		return lTotal;
	}
	
	this.preparerAffichageModifier = function(pData) {
		var that = this;
		// Cache les lots
		pData.find(':checkbox:not(:checked)').each(function() {			
			pData.find('.lot-pdt-' + $(this).parent().parent().find('.pdt-id').text()).hide();
		});
		//Cache les autres lots
		pData.find(':radio:not(:checked)').each(function() {	
			var lIdLot = $(this).parent().parent().find('.lot-id').text();
			var lIdPdt = $(this).parent().parent().find('.pdt-id').text();
			
			pData.find('#btn-moins-lot-' + lIdLot + ',#btn-plus-lot-' + lIdLot).attr("disabled","disabled").addClass("ui-helper-hidden");
			pData.find('#colonne-qte-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-prix-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-sigle-pdt-' + lIdPdt + '-lot-' + lIdLot).addClass("ui-helper-hidden");
		});
		return pData;
	}
	
	this.validerReservation = function() {
		var that = this;
		Infobulle.init(); // Supprime les erreurs
		
		var lVo = new ListeReservationCommandeVO();
		var lNbPdt = 0;
		$(this.reservationModif).each(function() {
			if(this.stoQuantite) {
				var lVoResa = new ReservationCommandeVO();
				lVoResa.id = '';
				lVoResa.stoQuantite = this.stoQuantite * -1;
				lVoResa.stoIdDetailCommande = this.dcomId;		
				lVo.commandes.push(lVoResa);
				lNbPdt++;
			}
		});
		
		if(lNbPdt > 0){
			var lValid = new ListeReservationCommandeValid();
			var lVR = lValid.validAjout(lVo);
			if(!lVR.valid){
				Infobulle.generer(lVR,'');
			} else {
				// Maj de la reservation
				$.post(	"./index.php?m=Commande&v=AfficherReservation", "reservation=" + $.toJSON(lVo),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {							
							// Maj des reservations pour le recap
							that.reservation = new Array();
							$(that.reservationModif).each(function() {
								if(this.proId) {									
									that.reservation[this.proId] = {comId:this.comId,proId:this.proId,dcomId:this.dcomId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};
								}
							});
							that.afficher();
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
				);				
			}			
		} else {
			var lVR = new TemplateVR();
			lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_207_CODE;erreur.message = ERR_207_MSG;lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,'');
		}		
	}
	
	this.affectSupprimerReservation = function(pData) {
		var that = this;
		pData.find('#btn-supprimer').click(function() {
			var lCommandeTemplate = new CommandeTemplate();
			var lTemplate = lCommandeTemplate.supprimerReservationDialog;
			$(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {	id_commande:that.infoCommande.comId,
										fonction:"supprimerReservation"};
						var lDialog = this;
						$.post(	"./index.php?m=Commande&v=SupprimerReservation", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										
										// Message d'information de la bonne suppression
										var lVr = new TemplateVR();
										lVr.valid = false;
										lVr.log.valid = false;
										var erreur = new VRerreur();
										erreur.code = ERR_303_CODE;
										erreur.message = ERR_303_MSG;
										lVr.log.erreurs.push(erreur);							

										// Redirection vers la liste des réservations
										ListeReservationVue({vr:lVr});
										
										$(lDialog).dialog("close");										
									} else {
										Infobulle.generer(lResponse,'');
									}
								},"json"
						);
					},
					'Annuler': function() { $(this).dialog("close"); }
					},
				close: function(ev, ui) { $(this).remove(); }
			})
		});
		return pData;
	}
		
	this.construct(pParam);
};function ListeReservationVue(pParam) {
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=Commande&v=ListeReservation", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
						// Maj du Menu
						var lCommunVue = new CommunVue();
						lCommunVue.majMenu('Commande','MesCommandes');
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lListeReservation = new Object;
		lListeReservation.reservation = new Array();
		
		// Transforme les dates pour l'affichage
			$(lResponse.reservations).each(function() {
				if(this.comNumero != null) {
					var lReservation = new Object();
					lReservation.numero = this.comNumero;
										
					lReservation.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lReservation.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lReservation.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lReservation.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lReservation.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lReservation.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lReservation.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lReservation.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
					
					lReservation.idCommande = '"' + this.comId + '"';
	
					lListeReservation.reservation.push(lReservation);
				}
			});
			
		var lCommandeTemplate = new CommandeTemplate();
		// Affiche la liste ou un message si celle-ci est vide
		if(lListeReservation.reservation.length > 0) {			
			var lTemplate = lCommandeTemplate.listeReservation;			
		} else {
			var lTemplate = lCommandeTemplate.listeReservationVide;
		}
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeReservation))));		
	}
	
	this.affect = function(pData) {
		pData = this.affectVisualiser(pData);
		return pData;
	}
	
	this.affectVisualiser = function(pData) {
		pData.find('.visualiser-reservation').click(function() {
				AfficherReservationVue({id_commande:$(this).attr('id')});
			});		
		return pData;
	}
	
	this.construct(pParam);
};function ListeCommandeVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=Commande&v=ListeCommande", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
						// Maj du Menu
						var lCommunVue = new CommunVue();
						lCommunVue.majMenu('Commande','ListeCommande');
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		Infobulle.init(); // Supprime les erreurs
		// Test si la liste est vide
		if(lResponse.listeCommande[0] && lResponse.listeCommande[0].comDateFinReservation != null) {
			var that = this;
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = new Object();
					lCommande.id = this.comId;
					lCommande.numero = this.comNumero;
					lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
						
					lListeCommande.commande.push(lCommande);
				});
			
			var lCommandeTemplate = new CommandeTemplate();
			var lTemplate = lCommandeTemplate.listeCommandePage;
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeCommande))));	
		} else {
			var lCommandeTemplate = new CommandeTemplate();
			$('#contenu').replaceWith(lCommandeTemplate.listeCommandeVide);
		}
	}
	this.affect = function(pData) {
		pData = this.affectBtnCommander(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	this.affectBtnCommander = function(pData) {
		pData.find('.btn-commander').click(function() {
			var lParam = {id_commande:$(this).attr('id')};
			ReservationCommandeVue(lParam);
		});
		return pData;
	}
		
	this.construct(pParam);
};function ReservationCommandeVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = new Array();
	this.solde = 0;
	this.soldeNv = 0;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=Commande&v=ReservationCommande","pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.solde = lResponse.adherent.opeMontant;	
						that.soldeNv = lResponse.adherent.opeMontant;
						
						that.infoCommande.comId = lResponse.commande[0].comId;
						that.infoCommande.comNumero = lResponse.commande[0].comNumero;
						that.infoCommande.comNom = lResponse.commande[0].comNom;
						that.infoCommande.comDescription = lResponse.commande[0].comDescription;
						that.infoCommande.dateTimeFinReservation = lResponse.commande[0].comDateFinReservation;
						that.infoCommande.dateFinReservation = lResponse.commande[0].comDateFinReservation.extractDbDate().dateDbToFr();
						that.infoCommande.heureFinReservation = lResponse.commande[0].comDateFinReservation.extractDbHeure();
						that.infoCommande.minuteFinReservation = lResponse.commande[0].comDateFinReservation.extractDbMinute();
						that.infoCommande.dateMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbDate().dateDbToFr();
						that.infoCommande.heureMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbHeure();
						that.infoCommande.minuteMarcheDebut = lResponse.commande[0].comDateMarcheDebut.extractDbMinute();
						that.infoCommande.heureMarcheFin = lResponse.commande[0].comDateMarcheFin.extractDbHeure();
						that.infoCommande.minuteMarcheFin = lResponse.commande[0].comDateMarcheFin.extractDbMinute();
						that.infoCommande.comArchive = lResponse.commande[0].comArchive;
							
						$(lResponse.commande).each(function() {
							var lLot = new Object();
							
							lLot.dcomId = this.dcomId;
							lLot.dcomIdProduit = this.dcomIdProduit;
							lLot.dcomTaille = this.dcomTaille;
							lLot.dcomPrix = this.dcomPrix;
							
							if(that.pdtCommande[this.proId]) {
								that.pdtCommande[this.proId].lot[lLot.dcomId] = lLot;
							} else {			
								var lproduit = new Object();
								lproduit.proId = this.proId;
								lproduit.proUniteMesure = this.proUniteMesure;
								lproduit.proMaxProduitCommande = this.proMaxProduitCommande;
								
								$(lResponse.stock).each(function() { 
									if(this.proId == lproduit.proId) {
										if(parseFloat(this.stoQuantite) < parseFloat(lproduit.proMaxProduitCommande)) {
											 lproduit.proMaxProduitCommande = this.stoQuantite;
										}
									}
								});

								lproduit.nproNom = this.nproNom;
								lproduit.nproDescription = this.nproDescription;
								lproduit.nproIdCategorie = this.nproIdCategorie;
								
								lproduit.lot = new Array();
								lproduit.lot[lLot.dcomId] = lLot;								
								that.pdtCommande[lproduit.proId] = lproduit;
							}
						});
												
						that.afficher();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function() {		
		this.afficherReservation();		
	}
	
	this.afficherDetailCommande = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.detailReservation;
		
		var lData = new Object();
		lData.sigleMonetaire = gSigleMonetaire;
		lData.solde = this.solde.nombreFormate(2,',',' ');
		lData.soldeNv = this.soldeNv.nombreFormate(2,',',' ');
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		lData.reservation = new Array();
		var lTotal = 0;
		$(this.pdtCommande).each(function() {
			if(that.reservation[this.proId]) {
				var lPdt = new Object;
				lPdt.nproNom = this.nproNom;
				lPdt.stoQuantite = parseFloat(that.reservation[this.proId].stoQuantite);
				lPdt.proUniteMesure = this.proUniteMesure;
				lPdt.prix = 0;
				var lDcomId = that.reservation[this.proId].dcomId;
				$(this.lot).each(function() {
					if(this.dcomId == lDcomId) {
						lPdt.prix = (lPdt.stoQuantite / this.dcomTaille) * this.dcomPrix;
					}
				});
				lTotal += lPdt.prix;
				
				lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
				lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
				
				lData.reservation.push(lPdt);
			}			
		});
		lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));
		this.majNouveauSolde();
	}
	
	this.afficherReservation = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.reservation;
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;
		lData.solde = this.solde.nombreFormate(2,',',' ');
		lData.soldeNv = this.soldeNv.nombreFormate(2,',',' ');
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		lData.produit = new Array();
				
		var lTotal = 0;		
		$(this.pdtCommande).each(function() {
			// Test si la ligne n'est pas vide
			if(this.proId) {
				var lPdt = {};
				lPdt.proId = this.proId;
				lPdt.nproNom = this.nproNom;
				lPdt.proMaxProduitCommande = parseFloat(this.proMaxProduitCommande).nombreFormate(2,',',' ');
				lPdt.proUniteMesure = this.proUniteMesure;
				
				lPdt.lot = new Array();
				
				var i = 0;
				var lLotReservation = -1;
				var lLotInit = -1;
				
				
				$(this.lot).each(function() {
					if(this.dcomId) {
						var lLot = {};
						lLot.dcomId = this.dcomId;
						lLot.dcomTaille = parseFloat(this.dcomTaille).nombreFormate(2,',',' ');
						lLot.dcomPrix = parseFloat(this.dcomPrix).nombreFormate(2,',',' ');
						lLot.prixReservation = parseFloat(this.dcomPrix);
						lLot.stoQuantiteReservation = parseFloat(this.dcomTaille);
						
						if(that.reservation[lPdt.proId] && (that.reservation[lPdt.proId].dcomId == this.dcomId)) {
								lLot.stoQuantiteReservation = parseFloat(that.reservation[lPdt.proId].stoQuantite);
								lLot.prixReservation = (lLot.stoQuantiteReservation / this.dcomTaille) * this.dcomPrix;
								lTotal += lLot.prixReservation;
								
								// Permet de cocher le lot correspondant à la résa
								lLotReservation = this.dcomId;
								lLot.checked = 'checked="checked"';
						}
												
						lLot.stoQuantiteReservation = lLot.stoQuantiteReservation.nombreFormate(2,',',' ');
						lLot.prixReservation = lLot.prixReservation.nombreFormate(2,',',' ');
						
						lPdt.lot.push(lLot);			
					}
				});
				
				lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
				
				// Si il y a une réservation pour ce produit on le coche
				if(lLotReservation != -1) {
					lPdt.checked = 'checked="checked"';
				} else {
					// Sinon on coche par défaut le premier lot
					if(lPdt.lot[0]) {
						lPdt.lot[0].checked = 'checked="checked"';
					}
				}
				
				lData.produit.push(lPdt);			
			}
		});
				
		$('#contenu').replaceWith(that.affectModifier($(lTemplate.template(lData))));
		this.majNouveauSolde();
	}
	
	this.affect = function(pData) {
		pData = this.affectDroitEdition(pData);
		pData = this.affectModifierReservation(pData);
		pData = this.affectValiderReservation(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectDroitEdition = function(pData) {
		// Si la date de fin des réservations est passée on bloque la possibilitée de modifier
		if(!dateTimeEstPLusGrandeEgale(this.infoCommande.dateTimeFinReservation,getDateTimeAujourdhuiDb(),'db')) {
			pData.find('.boutons-edition').hide();
		}
		return pData;
	}
	
	this.affectModifier = function(pData) {
		pData = this.affectBtnQte(pData);
		pData = this.affectChangementLot(pData);
		pData = this.affectChangementProduit(pData);
		pData = this.preparerAffichageModifier(pData);
		pData = this.affectDetailReservation(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectBtnQte = function(pData) {
		var that = this;
		pData.find('.btn-plus').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),1);
		});	
		pData.find('.btn-moins').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),-1);
		});
		return pData;		
	}
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.lot').click(function() {
			$(this).find(':radio').attr("checked","checked");
			that.changerLot($(this).find(".pdt-id").text(),$(this).find(".lot-id").text());
		});
		return pData;
	}
	
	this.affectChangementProduit = function(pData) {
		var that = this;
		pData.find('.pdt :checkbox').click(function() {
			that.changerProduit($(this).parent().parent().find(".pdt-id").text());			
		});
		return pData;
	}
		
	/*this.affectAnnulerReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {			
			that.afficherDetailReservation();		
		});
		return pData;
	}*/
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.afficherReservation();		
		});
		return pData;
	}
	
	this.affectDetailReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.validerReservation();		
		});
		return pData;
	}

	this.affectValiderReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.enregistrerReservation();				
		});
		return pData;	
	}
		
	this.nouvelleQuantite = function(pIdPdt,pIdLot,pIncrement) {
		var lMax = this.pdtCommande[pIdPdt].proMaxProduitCommande;
		var lTaille = this.pdtCommande[pIdPdt].lot[pIdLot].dcomTaille;
		var lPrix = this.pdtCommande[pIdPdt].lot[pIdLot].dcomPrix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservation[pIdPdt] && (this.reservation[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = this.reservation[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;
		
		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNvQteReservation > 0 && lNvQteReservation <= lMax) {
			var lNvPrix = 0;
			lNvPrix = lQteReservation * lPrix;
			
			// Mise à jour de la quantite reservée
			this.reservation[pIdPdt].stoQuantite = lNvQteReservation;			
			
			$('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

			this.majTotal();
		}		
	}	
	
	this.changerLot = function(pIdPdt,pIdLot) {		
		// Masque tout les lots
		$('.btn-pdt-' + pIdPdt).attr("disabled","disabled").addClass("ui-helper-hidden");
		$('.colonne-pdt-' + pIdPdt).addClass("ui-helper-hidden");
				
		// Affiche uniquement le lot sélectionné
		$('#btn-moins-lot-' + pIdLot + ',#btn-plus-lot-' + pIdLot).removeAttr("disabled").removeClass("ui-helper-hidden");
		$('#colonne-qte-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-prix-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-sigle-pdt-' + pIdPdt + '-lot-' + pIdLot).removeClass("ui-helper-hidden");
	
		// Mise à jour de la quantite reservée
		this.reservation[pIdPdt].stoQuantite = $('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text().numberFrToDb();
		this.reservation[pIdPdt].dcomId = pIdLot;
		
		this.majTotal();
	}
	
	this.changerProduit = function(pIdPdt) {
		var that = this;
		if($('#pdt-' + pIdPdt).find(':checkbox').attr("checked")) {
			$('.lot-pdt-' + pIdPdt).show();
			
			// Mise à jour de la quantite reservée
			$('[name=lot-produit-' + pIdPdt + ']').each(function() {
				//alert(this.attr('checked'));
				if($(this).attr('checked')) {
					var lIdLot = $(this).parent().parent().find(".lot-id").text();
					var lQte = $('#qte-pdt-' + pIdPdt + '-lot-' + lIdLot).text().numberFrToDb();
					if(that.reservation[pIdPdt]) {
						that.reservation[pIdPdt].stoQuantite = lQte;
					} else {
						var lResa = {};
						lResa.comId = that.infoCommande.comId;
						lResa.proId = pIdPdt;
						lResa.dcomId = lIdLot;
						lResa.stoQuantite = lQte;						
						that.reservation[pIdPdt] = lResa;
					}
				}
			});
		} else {			
			$('.lot-pdt-' + pIdPdt).hide();
			
			// Mise à jour de la quantite reservée
			if(this.reservation[pIdPdt]) {
				this.reservation[pIdPdt] = null;
			}
		}
		
		this.majTotal();
	}
	
	this.majTotal = function() {
		var lTotal = this.calculTotal();		
		$('#total').text(lTotal.nombreFormate(2,',',' '));
		
		// Maj du nouveau solde
		this.soldeNv = this.solde - lTotal;
		this.majNouveauSolde();
		$("#nouveau-solde").text(this.soldeNv.nombreFormate(2,',',' '));
	}
	
	this.majNouveauSolde = function() {
		if(this.soldeNv <= 0) {
			$("#nouveau-solde, #nouveau-solde-sigle").addClass("com-nombre-negatif");	
		} else {
			$("#nouveau-solde, #nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
	}
	
	this.calculTotal = function() {
		var that = this;
		var lTotal = 0;
		$(this.reservation).each(function() {
			var lResa = this;
			if(lResa.stoQuantite) {
				if(that.pdtCommande[lResa.proId]) {
					$(that.pdtCommande[lResa.proId].lot).each(function() {
						if(lResa.dcomId == this.dcomId) {
							lTotal += (lResa.stoQuantite / this.dcomTaille) * this.dcomPrix;
						}
					});					
				}				
			}
		});
		return lTotal;
	}
	
	this.preparerAffichageModifier = function(pData) {
		var that = this;
		// Cache les lots
		pData.find(':checkbox:not(:checked)').each(function() {			
			pData.find('.lot-pdt-' + $(this).parent().parent().find('.pdt-id').text()).hide();
		});
		//Cache les autres lots
		pData.find(':radio:not(:checked)').each(function() {	
			var lIdLot = $(this).parent().parent().find('.lot-id').text();
			var lIdPdt = $(this).parent().parent().find('.pdt-id').text();
			
			pData.find('#btn-moins-lot-' + lIdLot + ',#btn-plus-lot-' + lIdLot).attr("disabled","disabled").addClass("ui-helper-hidden");
			pData.find('#colonne-qte-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-prix-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-sigle-pdt-' + lIdPdt + '-lot-' + lIdLot).addClass("ui-helper-hidden");
		});
		return pData;
	}
	
	this.validerReservation = function() {
		Infobulle.init(); // Supprime les erreurs
		var lVo = this.genererListeReservation();	
		var lVr = this.verifierReservation(lVo);
		if(lVr.valid) {
			this.afficherDetailCommande();
		} else {
			Infobulle.generer(lVr,'');			
		}
	}
	
	this.enregistrerReservation = function() {
		Infobulle.init(); // Supprime les erreurs
		var that = this;
		var lVo = this.genererListeReservation();	
		var lVr = this.verifierReservation(lVo);
		if(lVr.valid) {
			// Réalisation de l'enregistrement
			$.post(	"./index.php?m=Commande&v=ReservationCommande", "reservation=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {					
						that.afficherRetour();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');			
		}		
	}	
	
	this.genererListeReservation = function() {
		var lVo = new ListeReservationCommandeVO();
		$(this.reservation).each(function() {
			if(this.stoQuantite) {
				var lVoResa = new ReservationCommandeVO();
				lVoResa.id = '';
				lVoResa.stoQuantite = this.stoQuantite * -1;
				lVoResa.stoIdDetailCommande = this.dcomId;
				lVo.commandes.push(lVoResa);
			}
		});	
		return lVo;
	}
		
	this.verifierReservation = function(pVo) {
		if($(pVo.commandes).length > 0) {
			var lValid = new ListeReservationCommandeValid();
			var lVR = lValid.validAjout(pVo);
		} else {
			var lVR = new TemplateVR();
			lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_207_CODE;erreur.message = ERR_207_MSG;lVR.log.erreurs.push(erreur);
		}
		return lVR;
	}
	
	this.afficherRetour = function() {		
		var lCommandeTemplate = new CommandeTemplate();
		$('#contenu').replaceWith(lCommandeTemplate.reservationOk);	
	}	
	
	this.construct(pParam);
}