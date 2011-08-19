function TemplateData() {
	this.infobulle = "<!-- BEGIN membres -->" + //ui-helper-hidden 
			"<div class=\"com-infobulle com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ifb-{membres.nom}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Erreur : {membres.nom}</div>" +
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
const ERR_215_MSG = 'Ce champ doit être positif.';/*
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
			if(pType === "montant") {lVal = parseFloat(lVal.numberFrToDb()).nombreFormate(2,',',' ');}
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

function lienDatepicker(pDatePetite,pDateGrande) {
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	var dates = $('#' + pDatePetite + ',#' + pDateGrande).datepicker({
		changeMonth: true,
		changeYear: true,
		onSelect: function(selectedDate) {
			var option = this.id == pDatePetite ? "minDate" : "maxDate";
			var instance = $(this).data("datepicker");
			var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});
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
						
			infobulle.css('position', 'absolute').css('z-index', '1000');
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
		return pNumber.replace(',','.');
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
};function CommandeCompleteVO() {
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
}function RechargementCompteVR() {
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
		return lTestId;
	}

}
function ProduitCommandeValid() { 
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

}function GestionCommandeTemplate() {
	this.ajoutProduitAjoutCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom\">{nom}</span>" +				
				"<button type=\"button\" class=\"com-delete\">X</button>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +				
				"<span class=\"produit-id ui-helper-hidden\">{idNom}</span>" +
				"Quantité en stock <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"stock\" value=\"{qteRestante}\" id=\"produit-{idNom}-qteRestante\" maxlength=\"11\"/><span class=\"produit-stock\">{qteRestante}</span><span class=\"produit-unite\">{unite}</span>" +
				"<button type=\"button\" class=\"edit-nom-pdt-creation-commande\">Editer</button><br/>" +
				"Quantité max par adhérent <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"qmax\" value=\"{qteMaxCommande}\" id=\"produit-{idNom}-qteMaxCommande\" maxlength=\"11\"/><span class=\"produit-qmax\">{qteMaxCommande}</span> <input class=\"ui-helper-hidden\" type=\"text\" name=\"unite\" value=\"{unite}\" id=\"produit-{idNom}-unite\" maxlength=\"20\"/><span class=\"produit-unite\">{unite}</span>" +
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
								"<td><input class=\"com-numeric\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{idNom}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{unite}</span></td>" +
								"<td><input class=\"com-numeric\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{idNom}-prix\" maxlength=\"12\"/> {siglemonetaire}</td>" +
								"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande\">Ajouter</button></td>" +
							"</tr>" +
						"</table>" +
					"</form>" +
				"</div>" +
				"<div class=\"produit-lots\">" +
				"<!-- BEGIN lots -->" +
					"<div class=\"produit-lot\">" +
							"<span class=\"lot-id ui-helper-hidden\">0</span>" +
							"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{idNom}-lot-0-taille\" maxlength=\"12\"/><span class=\"produit-taille\">{lots.taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{idNom}-lot-0-prix\" maxlength=\"12\" /><span class=\"produit-prix\">{lots.prix}</span>{siglemonetaire}" +
							"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
							"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
					"</div>" +
				"<!-- END lots -->" +
				"</div>" +
			"</div>" +
		"</div>";	
	
	this.ajoutLot = 
		"<div class=\"produit-lot\">" +
			"<span class=\"lot-id ui-helper-hidden\">{id}</span>" +
			"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{taille}\" id=\"produit-{idNom}-lot-{id}-taille\" maxlength=\"12\"><span class=\"produit-taille\">{taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{prix}\" id=\"produit-{idNom}-lot-{id}-prix\" maxlength=\"12\"><span class=\"produit-prix\">{prix}</span>{siglemonetaire}" +
			"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
			"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
		"</div>";

	this.ajoutCommandeSucces = 
		"<div id=\"ajout_commande_succes\" class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-div-ext-top\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Création de commande" +				
			"</div>" +
			"<div class=\"com-widget-content\">" +
				"<p>La commande n° : {numero} a été ajoutée avec succès.</p>" +
			"</div>" +
		"</div>";	
	
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Commandes en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Numéro</th>" +
								"<th class=\"com-table-th\">Date limite de Réservation</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr >" +
								"<td class=\"com-table-td\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<a class=\"ui-state-default ui-corner-all com-button com-center\" href={commande.lienEdit}>Editer</a>" +
								"</td>" +"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<span class=\"liste-commande-lien-marche ui-state-default ui-corner-all com-button com-center\" id={commande.lienMarche}>Marché</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
					"<div class=\"recherche com-center com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">Recherche Rapide : <input  class=\"com-input-text ui-widget-content ui-corner-all\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" /></form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</span></th>	" +
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
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
				"<div class=\"com-widget-content\">" +
					"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
				"<div class=\"com-widget-content\">" +
				"<table>" +
					"<thead>" +
						"<tr>" +
							"<th>Produit</th>" +
							"<th>Quantité</th>" +
							"<th></th>" +
							"<th>Prix</th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
					"<!-- BEGIN produits -->" +
						"<tr class=\"ligne-produit\">" +
							"<td><span class=\"produit-id ui-helper-hidden\">{produits.proId}</span>{produits.nproNom}</td>" +
							"<td><input type=\"text\" value=\"{produits.stoQuantite}\" class=\"com-numeric produit-quantite\" id=\"produits{produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td>{produits.proUniteMesure}</td>" +
							"<td><input type=\"text\" value=\"{produits.proPrix}\" class=\"com-numeric produit-prix\" id=\"produits{produits.proId}prix\" maxlength=\"12\" size=\"3\"/> <span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"<!-- END produits -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"2\"></td>" +
							"<td>Total :</td>" +
							"<td><span id=\"total-achat\">{total}</span> <span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
								"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric\" id=\"rechargementmontant\" maxlength=\"12\" size=\"3\"/> <span>{sigleMonetaire}</span></td>" +
								"<td>" +
									"<select name=\"typepaiement\">" +
										"<!-- BEGIN typePaiement -->" +
										"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
										"<!-- END typePaiement -->" +
									"</select>" +
								"</td>" +
								"<td id=\"td-champ-complementaire\"><input type=\"text\" name=\"champ-complementaire\" value=\"\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
}
function CommandeTemplate() {
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
		"<div>" +
			"<div class=\"ui-widget ui-widget-content ui-corner-all\">" +
			"<span class=\"com-float-left ui-icon ui-icon-check\"></span>" +
			"<span>Commande effectuée avec succés</span>" +
		"</div>" +
		"</div>";		
		
	this.reservationKo = 
		"<div>" +
			"<div class=\"ui-widget\">" +
				"<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
					"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
					"<strong>Erreur : </strong> Votre commande n'a pas été prise en compte.<br/>" +
					"<!-- BEGIN erreurs -->" +
					"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
					"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
					"<!-- END erreurs -->" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
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
	
	$("#lien_gestion_adherent_operation").click(
			function () { 
				$('#widget_formulaire_ajout_operation_adherent').slideToggle();
			}
	);
	
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	$(".com-date").datepicker({
			changeMonth: true,
			changeYear: true
	});		

});//var menu_obj = null;

$(document).ready(function() {
	$('#menu_liste > li').hover(function() {
		$('#menu_liste > li > ul').hide();
		if($(this).find('ul').css('display') == 'none') {
			$(this).find('ul').fadeIn('fast');
		}
	}, function() {
		$(this).find('ul').stop().fadeTo(0,1).fadeOut('fast');
	});
	
	$('.sous_menu > li').hover( function() {$(this).addClass("ui-state-focus")} , function() {$(this).removeClass("ui-state-focus")});
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
}function AjoutAdherentVue() {
	this.mCommunVue = new CommunVue();
	
	this.affect = function() {
		this.boutonLienCompte();
		this.mCommunVue.comNumeric();
	}
	
	this.boutonLienCompte = function() {		
		$(":input[name=lien_numero_compte]").click(function() {
			if($(":input[name=numero_compte]").attr("disabled")) {
				$(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				$(":input[name=numero_compte]").attr("disabled","disabled").val("");				
			}			
		});
	}	
}


$(document).ready(function() {
	var lAjoutAdherentVue = new AjoutAdherentVue()
	lAjoutAdherentVue.affect();
});/********** Début Création Commande ************/
function AjoutCommandeVue() {
	
	this.etapeCreationCommande = 0;
	this.mCommunVue = new CommunVue();
	this.mControleur = new AjoutCommandeControleur();
		
	this.affect = function() {
		this.ajoutProduit("formulaire-ajout-produit-creation-commande");
		this.creerCommande("btn-creer-commande");
		this.modifierCommande();
		this.dialogCreerProduit();
		this.controleDatepicker();
		this.mCommunVue.comNumeric();
	}
		
	this.affectAjoutProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.affectAjoutLot(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		return pData;
	}
	
	this.ajoutProduit = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).submit(
			function () {
				
				var lValid = true;
				$(".produit-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);
								
					var lVr = that.mControleur.validAjoutProduit(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.siglemonetaire = gSigleMonetaire;
							
						$("#liste_produit").append(that.affectAjoutProduit($(lTemplate.template(lVo)))); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						
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
	}
	
	this.creerCommande = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).click(
			function () {
				var lValidCommande = true;
				$("#liste_produit").find(":button").each(function() {
					if($(this).text() == gTextValider) {
						lValidCommande = false;
					}
				});
				
				if(lValidCommande) {
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
						
						var lVR = that.mControleur.valid(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide(); //"blind",gTempsTransitionUnique
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande").each(
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
										$('#ajoutcommande').replaceWith(lTemplate.template(lVoRetour));
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
	}
		
	this.modifierCommande = function() {
		var that = this;
		$('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande').hide();
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
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
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
		pData.find('.edit-nom-pdt-creation-commande').click(
    		function () {
    			if($(this).text() == gTextEdition) {
    				$(this).text(gTextValider);
    				$(this).parent().children(':input:not(:button,:submit)').each(
    						function () { $(this).textToInput(); });
    			} else {    				
    				var lVo = new ProduitCommandeVO();
    				var lId = $(this).parentsUntil(".produit-div");    				
    				lVo.idNom = $(lId).find(".produit-id").text();
    				lVo.nom = $(lId).find(".produit-nom").text();
    				lVo.unite = $(lId).find(":input[name=unite]").val();
    				lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
    				lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
    				
    				var lVr = that.mControleur.validAjoutProduitSimple(lVo);
    				
    				if(lVr.valid) {
    					Infobulle.init();
	    				$(this).text(gTextEdition);
	    				$(this).parent().children(':input:not(:button,:submit)').each(
	    						function () { $(this).inputToText(); });
	    				var lDivParent = $(this).parentsUntil('#liste_produit');
	        			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    				} else {
    					Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
    				}
    			}
    		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
		pData.find(".edit-lot-creation-commande").click( function () {
			if($(this).text() == gTextEdition) {
				$(this).text(gTextValider);
				$(this).parent().children(':input:not(:button,:submit)').each(
						function () { $(this).textToInput(); });
			} else {
				
				
				var lVo = new DetailCommandeVO();
				var lId = $(this).parent(".produit-lot");
				
				lVo.id = $(lId).find(".lot-id").text();
				lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
				lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
				lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {	
					Infobulle.init();
					$(this).text(gTextEdition);
					$(this).parent().find(":input[name='taille']").inputToText();
					$(this).parent().find(":input[name='prix']").inputToText("montant");
				} else {
					Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
				}
			}});
		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().remove();
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
	
	this.dialogCreerProduit = function() {
		$("#dialog-form-creer-nv-pdt").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Créer le produit': function() {			
					var lForm = $(this).children('form').first();
					var lNom = lForm.find(':input[name=nom]');
					var lValid = true;
					
					$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
					lForm.find(':input').removeClass('ui-state-error');			
	
					lValid = lNom.checkLength(1,50); // Longueur du nom
					
					if(lValid) {						
						// Ajout
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								lForm.serialize() + "&form=1",
							function (retour) {		
							
								/* Traitement du retour */
							// TODO Vérifier en fonctionnel si il n'existe pas déjà un produit de ce type
							if(retour.succes == true) {
								// Ajout dans la liste du select avec son ID									
								$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(retour.produit, true).sortOptions();
								$("#dialog-form-creer-nv-pdt").dialog('close');
								
							} else {								
								
								var lTemplate = "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
													"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
													"<strong>Erreur : </strong> L'ajout n'a pas été effectué.<br/>" +
													"<!-- BEGIN erreurs -->" +
													"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
													"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
													"<!-- END erreurs -->" +
													"</p>" +
												"</div>";
								
								$("#dialog-form-creer-nv-pdt").children().first().html(lTemplate.template(retour)).fadeIn(gTempsTransitionUnique);
							}
														
							},
							"json"
						);
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				$(this).children('form').first().find(':input').val('').removeClass('ui-state-error');
				$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
			}
		});

		$('#btn-creer-nv-pdt')
		//.button()
		.click(function() {
			$('#dialog-form-creer-nv-pdt').dialog('open');
		});	
	}
	
	this.controleDatepicker = function() {
		lienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut');
	}
	
}


$(document).ready(function() {
	var lAjoutCommandeVue = new AjoutCommandeVue()
	lAjoutCommandeVue.affect();
});
		/********** Fin Création Commande ************/function AchatCommandeVue() {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.listeLot = new Array();
	this.typePaiement = null;
	this.solde = null;
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pIdCommande, pIdAdherent) {
		var that = this;		
		this.idCommande = pIdCommande;
		this.idAdherent = pIdAdherent;
		
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pIdCommande + "&id_adherent=" + pIdAdherent,
				function(lResponse) {
			//alert(lResponse);			
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
					var lTpp = new Array();
					for(lIndice in lResponse.typePaiement) {
						lTpp[lResponse.typePaiement[lIndice].id] = lResponse.typePaiement[lIndice];
					}
					that.typePaiement = lTpp;	
					that.solde = parseFloat(lResponse.adherent.opeMontant);
					that.afficher(lResponse);					
				},"json"
		);
		var lResponse;
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
			
			lData.typePaiement = pResponse.typePaiement;
			
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
	
	this.majPrixProduit = function(Obj) {
		// TODO sur la quantite restante juste un message d'avertissement pour dire que le stock est négatif

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
		var lVo =lValid.validAjout(this.getAchatCommandeVO());
		Infobulle.generer(lVo,'');
		return lVo;
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
			$(":input[name=champ-complementaire]").val();
			$("#td-champ-complementaire").hide();
		}
	}
		
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.typePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].champComplementaire == 1) {
				return lTpp[pId].labelChampComplementaire;
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
		//	lVoProduit.quantite = parseFloat($(this).find(".produit-quantite").val().numberFrToDb());
		//	lVoProduit.prix = parseFloat($(this).find(".produit-prix").val().numberFrToDb());	
			
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
}function MarcheCommandeVue() {
	this.idCommande = null;
	
	this.construct = function(pId) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pId,
				function(lResponse) {
			//alert(lResponse);
					that.afficher(lResponse);
				},"json"
		);
		this.idCommande = pId;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.listeAdherentCommandePage;
				pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
				$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
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
		return pData;
	}
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lVue = new AchatCommandeVue();
			lVue.construct(that.idCommande,$(this).find(".id-adherent").text());
		});
		return pData;
	}	
}function ListeCommandeVue() {
	this.construct = function() {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", 
				function(lResponse) {
					that.afficher(lResponse);
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lListeCommande = new Object;
		lListeCommande.commande = new Array();
		
			$(lResponse.listeCommande).each(function() {
				var lCommande = new Object();
				lCommande.numero = this.comNumero;
				lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
				lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
				lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
				
				lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
				lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
				lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
				
				lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
				lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
				
				lCommande.lienEdit = '"' + this.comId + '"';
				lCommande.lienMarche = '"' + this.comId + '"';

				lListeCommande.commande.push(lCommande);
			});
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeCommandePage;
		$('#contenu').replaceWith(that.affectLienMarche($(lTemplate.template(lListeCommande))));		
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.liste-commande-lien-marche').click(function() {
			var lPage = new MarcheCommandeVue();
			lPage.construct($(this).attr('id'));
		});
		return pData;
	}
}


$(document).ready(function() {	
	$('#menu-gcom-liste-commande').click(function() {
		var lListeCommandeVue = new ListeCommandeVue();
		lListeCommandeVue.construct();
	});
	
});	/********** Début Réservation Commande ************/
function ReservationCommandeVue() {
	
	this.totalCommande = function() {
		var total = 0;
		$(":radio:checked").each(
				function() {
					var idproduit = "checkbox_" + $(this).attr("name").substr(6);			
					
					if($("input[name=" + idproduit + "]").attr("checked")) {
						var prixProduit = parseFloat($(this).attr("value")) * parseInt($(this).parent().next().next().next().children().first().html());
						$(this).parent().next().next().next().next().next().children().first().html(prixProduit.nombreFormate(2,',',' '));
						total += prixProduit;
					}
				});
		
		if(total == 0)
			$("#button-submit-reservation-commande").attr("disabled","disabled");
		else
			$("#button-submit-reservation-commande").removeAttr("disabled");
		
		$("#total_commande").html(total.nombreFormate(2,',',' '));		
	}
	
	this.radioCommandeClick = function(obj, idproduit) {
		$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
		$(obj).parent().next().next().next().children(":input").each(
			function () { $(this).removeAttr("disabled") });
	}
	
	this.changerQte = function(obj,qte) {
		var qteActuelle = parseInt($(obj).html());
		var qteMax = parseFloat($("#qte_max_" + $(obj).attr("class").substr(27)).html());
		var lot = parseFloat($(obj).parent().prev().prev().children().first().html())
		
		qteMax = qteMax / lot;
		qteActuelle += qte;
		
		if(qteActuelle < 1)
			qteActuelle = 1;
		
		if(qteActuelle > qteMax)
			qteActuelle = Math.floor(qteMax);
		
		$(obj).html(qteActuelle);
		$(obj).parent().next().children().first().html(qteActuelle * lot);
		this.totalCommande();
	}
	
	this.construct = function() {
		var that = this;
		$(".input-total-commande").click(
			function () {
				that.totalCommande();
			});
	
		$(".checkbox-commande").click(
			function () {
				var idproduit = $(this).attr("name").substr(9);
				if($(this).attr("checked")) {					
					that.radioCommandeClick($("input[name=radio_" + idproduit + "]:checked"),idproduit);					
					that.changerQte($("input[name=radio_" + idproduit + "]:checked").parent().next().next().next().children().first(),0);					
					$("input[name=radio_" + idproduit + "]").removeAttr("disabled");					
				} else {
					$("input[name=radio_" + idproduit + "]").attr("disabled","disabled");
					$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
					$(".qte_tot_" + idproduit).html('-');
					$(".prix_tot_" + idproduit).html('-');					
				}
			});
	
		$(".radio-commande").click(
			function () {
				var idproduit =  $(this).attr("name").substr(6);
				that.radioCommandeClick($(this),idproduit);				
				
				$(".qte_tot_" + idproduit).html('-');
				$(".prix_tot_" + idproduit).html('-');
				that.changerQte($(this).parent().next().next().next().children().first(),0);
				
				that.totalCommande();				
			});
		

	
		$(".plus-qte-commande").click( function () { that.changerQte($(this).prev().prev(),1); });
		$(".moins-qte-commande").click( function () { that.changerQte($(this).prev(),-1); });
	
		$("#button-submit-reservation-commande").click(
				function () {
					/* Récupération des données */
					var lData = new Array();
					lData['produit'] = new Array();
					lData['info_produit'] = new Array();
					
					var lSigle = "";
					
					$(":radio:checked").each(
							function() {
								var idproduit = $(this).attr("name").substr(6);
								var idcheckbox = "checkbox_" + idproduit;			
								var checkbox = $("input[name=" + idcheckbox + "]");
								if(checkbox.attr("checked")) {

									lSigle = $(this).parent().next().next().next().next().next().children().last().html();
									
									 var lDataTemp = new Array();
									 lDataTemp['NOM'] = checkbox.next().html();
									 lDataTemp['QUANTITE'] = $(this).parent().next().next().next().next().children().first().html() + $(this).parent().next().next().next().next().children().last().html();
									 lDataTemp['PRIX'] = $(this).parent().next().next().next().next().next().children().first().html() + lSigle;
									 lData['produit'].push(lDataTemp);
									 
									 var lDataTemp2 = new Array();
									 lDataTemp2['IDLOT'] = $(this).next().html();
									 lDataTemp2['IDPDT'] = idproduit;
									 lDataTemp2['QTE'] = $(this).parent().next().next().next().children().first().html();
									 lData['info_produit'].push(lDataTemp2);
									 

								}
							});
					
					lData['TOTAL_COMMANDE'] = $("#total_commande").html() + lSigle;
					lData['ID_COMMANDE'] = $("#id-commande-formulaire-reservation-commande").html();
					
					/* Récupération du template */	 
					var lCommandeTemplate = new CommandeTemplate();
					var lTemplate = lCommandeTemplate.confirmationReservationCommande;
					
					/* Ecriture des donnés */
					$("#confirmation-reservation-commande-text").html(lTemplate.template(lData));
					
					/* Affichage */
					$("#window-formulaire-reservation-commande").fadeOut(gTempsTransition,							
						function() { $("#confirmation-reservation-commande").fadeIn(gTempsTransition); }					
					);
				});
		
		$("#annuler-confirmation-reservation-commande").click(
				function () {
					$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
							function () {
					$("#window-formulaire-reservation-commande").fadeIn(gTempsTransition);
					});
					
				}
		
		);
	
		$("#commander-confirmation-reservation-commande").click(
			function () {				
				/* Passage de la commande */
				
				// TODO lancer la requete en json
				
				$.post(	"./index.php?m=Commande&v=ReservationCommande",
						$("#form-confirmation-reservation-commande").serialize(),
						function (retour) {
					//alert(retour);
							var lCommandeTemplate = new CommandeTemplate();
							/* Traitement du retour */
							var html;
							if(retour.succes == true) {
								html = lCommandeTemplate.reservationOk.template(retour);
							} else {
								html = lCommandeTemplate.reservationKo.template(retour);
							}
							$('#description_commande_int').hide();
							$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
									function () { $("#confirmation-reservation-commande").after(html);});
						},"json"
					);
			});
	}
}
		/********** Fin Réservation Commande ************/
$(document).ready(function() {
	var lReservationCommandeVue = new ReservationCommandeVue();
	lReservationCommandeVue.construct();	
});function TemplateData() {
	this.infobulle = "<!-- BEGIN membres -->" + //ui-helper-hidden 
			"<div class=\"com-infobulle com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ifb-{membres.nom}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Erreur : {membres.nom}</div>" +
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
const ERR_114_MSG = 'Plusieurs lignes dans la base au lieu d\'une attendue.';

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
const ERR_216_MSG = 'Aucune donnée pour l\'id donné.';/*
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

function lienDatepicker(pDatePetite,pDateGrande) {
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	var dates = $('#' + pDatePetite + ',#' + pDateGrande).datepicker({
		changeMonth: true,
		changeYear: true,
		onSelect: function(selectedDate) {
			var option = this.id == pDatePetite ? "minDate" : "maxDate";
			var instance = $(this).data("datepicker");
			var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});
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
						
			infobulle.css('position', 'absolute').css('z-index', '1000');
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
		return pNumber.replace(',','.');
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
};function CommandeCompleteVO() {
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
}function RechargementCompteVR() {
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
		return lTestId;
	}

}
function ProduitCommandeValid() { 
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

}function GestionCommandeTemplate() {
	this.ajoutProduitAjoutCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom\">{nom}</span>" +				
				"<button type=\"button\" class=\"com-delete\">X</button>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +				
				"<span class=\"produit-id ui-helper-hidden\">{idNom}</span>" +
				"Quantité en stock <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"stock\" value=\"{qteRestante}\" id=\"produit-{idNom}-qteRestante\" maxlength=\"11\"/><span class=\"produit-stock\">{qteRestante}</span><span class=\"produit-unite\">{unite}</span>" +
				"<button type=\"button\" class=\"edit-nom-pdt-creation-commande\">Editer</button><br/>" +
				"Quantité max par adhérent <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"qmax\" value=\"{qteMaxCommande}\" id=\"produit-{idNom}-qteMaxCommande\" maxlength=\"11\"/><span class=\"produit-qmax\">{qteMaxCommande}</span> <input class=\"ui-helper-hidden\" type=\"text\" name=\"unite\" value=\"{unite}\" id=\"produit-{idNom}-unite\" maxlength=\"20\"/><span class=\"produit-unite\">{unite}</span>" +
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
								"<td><input class=\"com-numeric\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{idNom}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{unite}</span></td>" +
								"<td><input class=\"com-numeric\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{idNom}-prix\" maxlength=\"12\"/> {siglemonetaire}</td>" +
								"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande\">Ajouter</button></td>" +
							"</tr>" +
						"</table>" +
					"</form>" +
				"</div>" +
				"<div class=\"produit-lots\">" +
				"<!-- BEGIN lots -->" +
					"<div class=\"produit-lot\">" +
							"<span class=\"lot-id ui-helper-hidden\">0</span>" +
							"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{idNom}-lot-0-taille\" maxlength=\"12\"/><span class=\"produit-taille\">{lots.taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{idNom}-lot-0-prix\" maxlength=\"12\" /><span class=\"produit-prix\">{lots.prix}</span>{siglemonetaire}" +
							"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
							"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
					"</div>" +
				"<!-- END lots -->" +
				"</div>" +
			"</div>" +
		"</div>";	
	
	this.ajoutLot = 
		"<div class=\"produit-lot\">" +
			"<span class=\"lot-id ui-helper-hidden\">{id}</span>" +
			"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{taille}\" id=\"produit-{idNom}-lot-{id}-taille\" maxlength=\"12\"><span class=\"produit-taille\">{taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{prix}\" id=\"produit-{idNom}-lot-{id}-prix\" maxlength=\"12\"><span class=\"produit-prix\">{prix}</span>{siglemonetaire}" +
			"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
			"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
		"</div>";

	this.ajoutCommandeSucces = 
		"<div id=\"ajout_commande_succes\" class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-div-ext-top\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Création de commande" +				
			"</div>" +
			"<div class=\"com-widget-content\">" +
				"<p>La commande n° : {numero} a été ajoutée avec succès.</p>" +
			"</div>" +
		"</div>";		
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Commandes en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Numéro</th>" +
								"<th class=\"com-table-th\">Date limite de Réservation</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr >" +
								"<td class=\"com-table-td\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<a class=\"ui-state-default ui-corner-all com-button com-center\" href={commande.lienEdit}>Editer</a>" +
								"</td>" +"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<span class=\"liste-commande-lien-marche ui-state-default ui-corner-all com-button com-center\" id={commande.lienMarche}>Marché</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
					"<div class=\"recherche com-center com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">Recherche Rapide : <input  class=\"com-input-text ui-widget-content ui-corner-all\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" /></form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</span></th>	" +
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
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
				"<div class=\"com-widget-content\">" +
					"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
				"<div class=\"com-widget-content\">" +
				"<table>" +
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
							"<td class=\"com-text-align-right\"><input type=\"text\" value=\"{produits.stoQuantite}\" class=\"com-numeric produit-quantite\" id=\"produits{produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td>{produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right\" ><input type=\"text\" value=\"{produits.proPrix}\" class=\"com-numeric produit-prix\" id=\"produits{produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"<!-- END produits -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"2\"></td>" +
							"<td>Total :</td>" +
							"<td><span id=\"total-achat\">{total}</span></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
								"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric\" id=\"rechargementmontant\" maxlength=\"12\" size=\"3\"/> <span>{sigleMonetaire}</span></td>" +
								"<td>" +
									"<select name=\"typepaiement\" id=\"typepaiement\">" +
										"<!-- BEGIN typePaiement -->" +
										"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
										"<!-- END typePaiement -->" +
									"</select>" +
								"</td>" +
								"<td id=\"td-champ-complementaire\"><input type=\"text\" name=\"champ-complementaire\" value=\"\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<button type=\"button\" id=\"btn-annuler\">Annuler</button>" +
				"<button type=\"button\" class=\"ui-helper-hidden\" id=\"btn-modifier\">Modifier</button>" +
				"<button type=\"button\" id=\"btn-valider\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.achatCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<div><span class=\"com-float-left ui-icon ui-icon-check\"></span>Achat effectué avec succès.</div>" +
					"<div>" +
						"<button id=\"btn-annuler\">Retourner à la liste des commandes</button>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
}
function CommandeTemplate() {
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
		"<div>" +
			"<div class=\"ui-widget ui-widget-content ui-corner-all\">" +
			"<span class=\"com-float-left ui-icon ui-icon-check\"></span>" +
			"<span>Commande effectuée avec succés</span>" +
		"</div>" +
		"</div>";		
		
	this.reservationKo = 
		"<div>" +
			"<div class=\"ui-widget\">" +
				"<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
					"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
					"<strong>Erreur : </strong> Votre commande n'a pas été prise en compte.<br/>" +
					"<!-- BEGIN erreurs -->" +
					"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
					"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
					"<!-- END erreurs -->" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
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
	
	$("#lien_gestion_adherent_operation").click(
			function () { 
				$('#widget_formulaire_ajout_operation_adherent').slideToggle();
			}
	);
	
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	$(".com-date").datepicker({
			changeMonth: true,
			changeYear: true
	});		

});//var menu_obj = null;

$(document).ready(function() {
	$('#menu_liste > li').hover(function() {
		$('#menu_liste > li > ul').hide();
		if($(this).find('ul').css('display') == 'none') {
			$(this).find('ul').fadeIn('fast');
		}
	}, function() {
		$(this).find('ul').stop().fadeTo(0,1).fadeOut('fast');
	});
	
	$('.sous_menu > li').hover( function() {$(this).addClass("ui-state-focus")} , function() {$(this).removeClass("ui-state-focus")});
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
}function AjoutAdherentVue() {
	this.mCommunVue = new CommunVue();
	
	this.affect = function() {
		this.boutonLienCompte();
		this.mCommunVue.comNumeric();
	}
	
	this.boutonLienCompte = function() {		
		$(":input[name=lien_numero_compte]").click(function() {
			if($(":input[name=numero_compte]").attr("disabled")) {
				$(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				$(":input[name=numero_compte]").attr("disabled","disabled").val("");				
			}			
		});
	}	
}


$(document).ready(function() {
	var lAjoutAdherentVue = new AjoutAdherentVue()
	lAjoutAdherentVue.affect();
});/********** Début Création Commande ************/
function AjoutCommandeVue() {
	
	this.etapeCreationCommande = 0;
	this.mCommunVue = new CommunVue();
	this.mControleur = new AjoutCommandeControleur();
		
	this.affect = function() {
		this.ajoutProduit("formulaire-ajout-produit-creation-commande");
		this.creerCommande("btn-creer-commande");
		this.modifierCommande();
		this.dialogCreerProduit();
		this.controleDatepicker();
		this.mCommunVue.comNumeric();
	}
		
	this.affectAjoutProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.affectAjoutLot(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		return pData;
	}
	
	this.ajoutProduit = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).submit(
			function () {
				
				var lValid = true;
				$(".produit-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);
								
					var lVr = that.mControleur.validAjoutProduit(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.siglemonetaire = gSigleMonetaire;
							
						$("#liste_produit").append(that.affectAjoutProduit($(lTemplate.template(lVo)))); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						
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
	}
	
	this.creerCommande = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).click(
			function () {
				var lValidCommande = true;
				$("#liste_produit").find(":button").each(function() {
					if($(this).text() == gTextValider) {
						lValidCommande = false;
					}
				});
				
				if(lValidCommande) {
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
						
						var lVR = that.mControleur.valid(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide(); //"blind",gTempsTransitionUnique
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande").each(
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
										$('#ajoutcommande').replaceWith(lTemplate.template(lVoRetour));
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
	}
		
	this.modifierCommande = function() {
		var that = this;
		$('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande').hide();
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
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
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
		pData.find('.edit-nom-pdt-creation-commande').click(
    		function () {
    			if($(this).text() == gTextEdition) {
    				$(this).text(gTextValider);
    				$(this).parent().children(':input:not(:button,:submit)').each(
    						function () { $(this).textToInput(); });
    			} else {    				
    				var lVo = new ProduitCommandeVO();
    				var lId = $(this).parentsUntil(".produit-div");    				
    				lVo.idNom = $(lId).find(".produit-id").text();
    				lVo.nom = $(lId).find(".produit-nom").text();
    				lVo.unite = $(lId).find(":input[name=unite]").val();
    				lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
    				lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
    				
    				var lVr = that.mControleur.validAjoutProduitSimple(lVo);
    				
    				if(lVr.valid) {
    					Infobulle.init();
	    				$(this).text(gTextEdition);
	    				$(this).parent().children(':input:not(:button,:submit)').each(
	    						function () { $(this).inputToText(); });
	    				var lDivParent = $(this).parentsUntil('#liste_produit');
	        			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    				} else {
    					Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
    				}
    			}
    		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
		pData.find(".edit-lot-creation-commande").click( function () {
			if($(this).text() == gTextEdition) {
				$(this).text(gTextValider);
				$(this).parent().children(':input:not(:button,:submit)').each(
						function () { $(this).textToInput(); });
			} else {
				
				
				var lVo = new DetailCommandeVO();
				var lId = $(this).parent(".produit-lot");
				
				lVo.id = $(lId).find(".lot-id").text();
				lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
				lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
				lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {	
					Infobulle.init();
					$(this).text(gTextEdition);
					$(this).parent().find(":input[name='taille']").inputToText();
					$(this).parent().find(":input[name='prix']").inputToText("montant");
				} else {
					Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
				}
			}});
		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().remove();
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
	
	this.dialogCreerProduit = function() {
		$("#dialog-form-creer-nv-pdt").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Créer le produit': function() {			
					var lForm = $(this).children('form').first();
					var lNom = lForm.find(':input[name=nom]');
					var lValid = true;
					
					$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
					lForm.find(':input').removeClass('ui-state-error');			
	
					lValid = lNom.checkLength(1,50); // Longueur du nom
					
					if(lValid) {						
						// Ajout
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								lForm.serialize() + "&form=1",
							function (retour) {		
							
								/* Traitement du retour */
							// TODO Vérifier en fonctionnel si il n'existe pas déjà un produit de ce type
							if(retour.succes == true) {
								// Ajout dans la liste du select avec son ID									
								$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(retour.produit, true).sortOptions();
								$("#dialog-form-creer-nv-pdt").dialog('close');
								
							} else {								
								
								var lTemplate = "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
													"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
													"<strong>Erreur : </strong> L'ajout n'a pas été effectué.<br/>" +
													"<!-- BEGIN erreurs -->" +
													"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
													"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
													"<!-- END erreurs -->" +
													"</p>" +
												"</div>";
								
								$("#dialog-form-creer-nv-pdt").children().first().html(lTemplate.template(retour)).fadeIn(gTempsTransitionUnique);
							}
														
							},
							"json"
						);
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				$(this).children('form').first().find(':input').val('').removeClass('ui-state-error');
				$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
			}
		});

		$('#btn-creer-nv-pdt')
		//.button()
		.click(function() {
			$('#dialog-form-creer-nv-pdt').dialog('open');
		});	
	}
	
	this.controleDatepicker = function() {
		lienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut');
	}
	
}


$(document).ready(function() {
	var lAjoutCommandeVue = new AjoutCommandeVue()
	lAjoutCommandeVue.affect();
});
		/********** Fin Création Commande ************/function AchatCommandeVue() {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.listeLot = new Array();
	this.typePaiement = null;
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	
	this.construct = function(pIdCommande, pIdAdherent) {
		var that = this;		
		this.idCommande = pIdCommande;
		this.idAdherent = pIdAdherent;
		
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pIdCommande + "&id_adherent=" + pIdAdherent,
				function(lResponse) {
					if(lResponse.valid) {
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
						var lTpp = new Array();
						for(lIndice in lResponse.typePaiement) {
							lTpp[lResponse.typePaiement[lIndice].id] = lResponse.typePaiement[lIndice];
						}
						that.typePaiement = lTpp;	
						that.solde = parseFloat(lResponse.adherent.opeMontant);
					}
					that.afficher(lResponse);
				},"json"
		);
		var lResponse;
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
			
			lData.typePaiement = pResponse.typePaiement;
			
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
			$(":input[name=champ-complementaire]").val();
			$("#td-champ-complementaire").hide();
		}
	}
		
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.typePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].champComplementaire == 1) {
				return lTpp[pId].labelChampComplementaire;
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
		var lMarcheCommandeVue = new MarcheCommandeVue();
		lMarcheCommandeVue.construct(this.idCommande);
	}
}function MarcheCommandeVue() {
	this.idCommande = null;
	
	this.construct = function(pId) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pId,
				function(lResponse) {
			//alert(lResponse);
					that.afficher(lResponse);
				},"json"
		);
		this.idCommande = pId;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.listeAdherentCommandePage;
				pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
				$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
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
		return pData;
	}
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lVue = new AchatCommandeVue();
			lVue.construct(that.idCommande,$(this).find(".id-adherent").text());
		});
		return pData;
	}	
}function ListeCommandeVue() {
	this.construct = function() {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", 
				function(lResponse) {
					that.afficher(lResponse);
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lListeCommande = new Object;
		lListeCommande.commande = new Array();
		
			$(lResponse.listeCommande).each(function() {
				var lCommande = new Object();
				lCommande.numero = this.comNumero;
				lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
				lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
				lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
				
				lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
				lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
				lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
				
				lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
				lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
				
				lCommande.lienEdit = '"' + this.comId + '"';
				lCommande.lienMarche = '"' + this.comId + '"';

				lListeCommande.commande.push(lCommande);
			});
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeCommandePage;
		$('#contenu').replaceWith(that.affectLienMarche($(lTemplate.template(lListeCommande))));		
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.liste-commande-lien-marche').click(function() {
			var lPage = new MarcheCommandeVue();
			lPage.construct($(this).attr('id'));
		});
		return pData;
	}
}


$(document).ready(function() {	
	$('#menu-gcom-liste-commande').click(function() {
		var lListeCommandeVue = new ListeCommandeVue();
		lListeCommandeVue.construct();
	});
	
});	/********** Début Réservation Commande ************/
function ReservationCommandeVue() {
	
	this.totalCommande = function() {
		var total = 0;
		$(":radio:checked").each(
				function() {
					var idproduit = "checkbox_" + $(this).attr("name").substr(6);			
					
					if($("input[name=" + idproduit + "]").attr("checked")) {
						var prixProduit = parseFloat($(this).attr("value")) * parseInt($(this).parent().next().next().next().children().first().html());
						$(this).parent().next().next().next().next().next().children().first().html(prixProduit.nombreFormate(2,',',' '));
						total += prixProduit;
					}
				});
		
		if(total == 0)
			$("#button-submit-reservation-commande").attr("disabled","disabled");
		else
			$("#button-submit-reservation-commande").removeAttr("disabled");
		
		$("#total_commande").html(total.nombreFormate(2,',',' '));		
	}
	
	this.radioCommandeClick = function(obj, idproduit) {
		$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
		$(obj).parent().next().next().next().children(":input").each(
			function () { $(this).removeAttr("disabled") });
	}
	
	this.changerQte = function(obj,qte) {
		var qteActuelle = parseInt($(obj).html());
		var qteMax = parseFloat($("#qte_max_" + $(obj).attr("class").substr(27)).html());
		var lot = parseFloat($(obj).parent().prev().prev().children().first().html())
		
		qteMax = qteMax / lot;
		qteActuelle += qte;
		
		if(qteActuelle < 1)
			qteActuelle = 1;
		
		if(qteActuelle > qteMax)
			qteActuelle = Math.floor(qteMax);
		
		$(obj).html(qteActuelle);
		$(obj).parent().next().children().first().html(qteActuelle * lot);
		this.totalCommande();
	}
	
	this.construct = function() {
		var that = this;
		$(".input-total-commande").click(
			function () {
				that.totalCommande();
			});
	
		$(".checkbox-commande").click(
			function () {
				var idproduit = $(this).attr("name").substr(9);
				if($(this).attr("checked")) {					
					that.radioCommandeClick($("input[name=radio_" + idproduit + "]:checked"),idproduit);					
					that.changerQte($("input[name=radio_" + idproduit + "]:checked").parent().next().next().next().children().first(),0);					
					$("input[name=radio_" + idproduit + "]").removeAttr("disabled");					
				} else {
					$("input[name=radio_" + idproduit + "]").attr("disabled","disabled");
					$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
					$(".qte_tot_" + idproduit).html('-');
					$(".prix_tot_" + idproduit).html('-');					
				}
			});
	
		$(".radio-commande").click(
			function () {
				var idproduit =  $(this).attr("name").substr(6);
				that.radioCommandeClick($(this),idproduit);				
				
				$(".qte_tot_" + idproduit).html('-');
				$(".prix_tot_" + idproduit).html('-');
				that.changerQte($(this).parent().next().next().next().children().first(),0);
				
				that.totalCommande();				
			});
		

	
		$(".plus-qte-commande").click( function () { that.changerQte($(this).prev().prev(),1); });
		$(".moins-qte-commande").click( function () { that.changerQte($(this).prev(),-1); });
	
		$("#button-submit-reservation-commande").click(
				function () {
					/* Récupération des données */
					var lData = new Array();
					lData['produit'] = new Array();
					lData['info_produit'] = new Array();
					
					var lSigle = "";
					
					$(":radio:checked").each(
							function() {
								var idproduit = $(this).attr("name").substr(6);
								var idcheckbox = "checkbox_" + idproduit;			
								var checkbox = $("input[name=" + idcheckbox + "]");
								if(checkbox.attr("checked")) {

									lSigle = $(this).parent().next().next().next().next().next().children().last().html();
									
									 var lDataTemp = new Array();
									 lDataTemp['NOM'] = checkbox.next().html();
									 lDataTemp['QUANTITE'] = $(this).parent().next().next().next().next().children().first().html() + $(this).parent().next().next().next().next().children().last().html();
									 lDataTemp['PRIX'] = $(this).parent().next().next().next().next().next().children().first().html() + lSigle;
									 lData['produit'].push(lDataTemp);
									 
									 var lDataTemp2 = new Array();
									 lDataTemp2['IDLOT'] = $(this).next().html();
									 lDataTemp2['IDPDT'] = idproduit;
									 lDataTemp2['QTE'] = $(this).parent().next().next().next().children().first().html();
									 lData['info_produit'].push(lDataTemp2);
									 

								}
							});
					
					lData['TOTAL_COMMANDE'] = $("#total_commande").html() + lSigle;
					lData['ID_COMMANDE'] = $("#id-commande-formulaire-reservation-commande").html();
					
					/* Récupération du template */	 
					var lCommandeTemplate = new CommandeTemplate();
					var lTemplate = lCommandeTemplate.confirmationReservationCommande;
					
					/* Ecriture des donnés */
					$("#confirmation-reservation-commande-text").html(lTemplate.template(lData));
					
					/* Affichage */
					$("#window-formulaire-reservation-commande").fadeOut(gTempsTransition,							
						function() { $("#confirmation-reservation-commande").fadeIn(gTempsTransition); }					
					);
				});
		
		$("#annuler-confirmation-reservation-commande").click(
				function () {
					$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
							function () {
					$("#window-formulaire-reservation-commande").fadeIn(gTempsTransition);
					});
					
				}
		
		);
	
		$("#commander-confirmation-reservation-commande").click(
			function () {				
				/* Passage de la commande */
				
				// TODO lancer la requete en json
				
				$.post(	"./index.php?m=Commande&v=ReservationCommande",
						$("#form-confirmation-reservation-commande").serialize(),
						function (retour) {
					//alert(retour);
							var lCommandeTemplate = new CommandeTemplate();
							/* Traitement du retour */
							var html;
							if(retour.succes == true) {
								html = lCommandeTemplate.reservationOk.template(retour);
							} else {
								html = lCommandeTemplate.reservationKo.template(retour);
							}
							$('#description_commande_int').hide();
							$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
									function () { $("#confirmation-reservation-commande").after(html);});
						},"json"
					);
			});
	}
}
		/********** Fin Réservation Commande ************/
$(document).ready(function() {
	var lReservationCommandeVue = new ReservationCommandeVue();
	lReservationCommandeVue.construct();	
});function TemplateData() {
	this.infobulle = "<!-- BEGIN membres -->" + //ui-helper-hidden 
			"<div class=\"com-infobulle com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ifb-{membres.nom}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Erreur : {membres.nom}</div>" +
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
const ERR_114_MSG = 'Plusieurs lignes dans la base au lieu d\'une attendue.';

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
const ERR_216_MSG = 'Aucune donnée pour l\'id donné.';/*
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

function lienDatepicker(pDatePetite,pDateGrande) {
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	var dates = $('#' + pDatePetite + ',#' + pDateGrande).datepicker({
		changeMonth: true,
		changeYear: true,
		onSelect: function(selectedDate) {
			var option = this.id == pDatePetite ? "minDate" : "maxDate";
			var instance = $(this).data("datepicker");
			var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});
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
						
			infobulle.css('position', 'absolute').css('z-index', '1000');
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
		return pNumber.replace(',','.');
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
};function CommandeCompleteVO() {
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
}function RechargementCompteVR() {
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
		return lTestId;
	}

}
function ProduitCommandeValid() { 
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

}function GestionCommandeTemplate() {
	this.ajoutProduitAjoutCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom\">{nom}</span>" +				
				"<button type=\"button\" class=\"com-delete\">X</button>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +				
				"<span class=\"produit-id ui-helper-hidden\">{idNom}</span>" +
				"Quantité en stock <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"stock\" value=\"{qteRestante}\" id=\"produit-{idNom}-qteRestante\" maxlength=\"11\"/><span class=\"produit-stock\">{qteRestante}</span><span class=\"produit-unite\">{unite}</span>" +
				"<button type=\"button\" class=\"edit-nom-pdt-creation-commande\">Editer</button><br/>" +
				"Quantité max par adhérent <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"qmax\" value=\"{qteMaxCommande}\" id=\"produit-{idNom}-qteMaxCommande\" maxlength=\"11\"/><span class=\"produit-qmax\">{qteMaxCommande}</span> <input class=\"ui-helper-hidden\" type=\"text\" name=\"unite\" value=\"{unite}\" id=\"produit-{idNom}-unite\" maxlength=\"20\"/><span class=\"produit-unite\">{unite}</span>" +
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
								"<td><input class=\"com-numeric\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{idNom}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{unite}</span></td>" +
								"<td><input class=\"com-numeric\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{idNom}-prix\" maxlength=\"12\"/> {siglemonetaire}</td>" +
								"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande\">Ajouter</button></td>" +
							"</tr>" +
						"</table>" +
					"</form>" +
				"</div>" +
				"<div class=\"produit-lots\">" +
				"<!-- BEGIN lots -->" +
					"<div class=\"produit-lot\">" +
							"<span class=\"lot-id ui-helper-hidden\">0</span>" +
							"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{idNom}-lot-0-taille\" maxlength=\"12\"/><span class=\"produit-taille\">{lots.taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{idNom}-lot-0-prix\" maxlength=\"12\" /><span class=\"produit-prix\">{lots.prix}</span>{siglemonetaire}" +
							"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
							"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
					"</div>" +
				"<!-- END lots -->" +
				"</div>" +
			"</div>" +
		"</div>";	
	
	this.ajoutLot = 
		"<div class=\"produit-lot\">" +
			"<span class=\"lot-id ui-helper-hidden\">{id}</span>" +
			"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{taille}\" id=\"produit-{idNom}-lot-{id}-taille\" maxlength=\"12\"><span class=\"produit-taille\">{taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{prix}\" id=\"produit-{idNom}-lot-{id}-prix\" maxlength=\"12\"><span class=\"produit-prix\">{prix}</span>{siglemonetaire}" +
			"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
			"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
		"</div>";

	this.ajoutCommandeSucces = 
		"<div id=\"ajout_commande_succes\" class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-div-ext-top\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Création de commande" +				
			"</div>" +
			"<div class=\"com-widget-content\">" +
				"<p>La commande n° : {numero} a été ajoutée avec succès.</p>" +
			"</div>" +
		"</div>";		
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Commandes en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Numéro</th>" +
								"<th class=\"com-table-th\">Date limite de Réservation</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr >" +
								"<td class=\"com-table-td\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<a class=\"ui-state-default ui-corner-all com-button com-center\" href={commande.lienEdit}>Editer</a>" +
								"</td>" +"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<span class=\"liste-commande-lien-marche ui-state-default ui-corner-all com-button com-center\" id={commande.lienMarche}>Marché</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
					"<div class=\"recherche com-center com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">Recherche Rapide : <input  class=\"com-input-text ui-widget-content ui-corner-all\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" /></form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</span></th>	" +
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
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
				"<div class=\"com-widget-content\">" +
					"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
				"<div class=\"com-widget-content\">" +
				"<table>" +
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
							"<td class=\"com-text-align-right\"><input type=\"text\" value=\"{produits.stoQuantite}\" class=\"com-numeric produit-quantite\" id=\"produits{produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td>{produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right\" ><input type=\"text\" value=\"{produits.proPrix}\" class=\"com-numeric produit-prix\" id=\"produits{produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"<!-- END produits -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"2\"></td>" +
							"<td>Total :</td>" +
							"<td><span id=\"total-achat\">{total}</span></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
								"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric\" id=\"rechargementmontant\" maxlength=\"12\" size=\"3\"/> <span>{sigleMonetaire}</span></td>" +
								"<td>" +
									"<select name=\"typepaiement\" id=\"typepaiement\">" +
										"<!-- BEGIN typePaiement -->" +
										"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
										"<!-- END typePaiement -->" +
									"</select>" +
								"</td>" +
								"<td id=\"td-champ-complementaire\"><input type=\"text\" name=\"champ-complementaire\" value=\"\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<button type=\"button\" id=\"btn-annuler\">Annuler</button>" +
				"<button type=\"button\" class=\"ui-helper-hidden\" id=\"btn-modifier\">Modifier</button>" +
				"<button type=\"button\" id=\"btn-valider\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.achatCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<div><span class=\"com-float-left ui-icon ui-icon-check\"></span>Achat effectué avec succès.</div>" +
					"<div>" +
						"<button id=\"btn-annuler\">Retourner à la liste des commandes</button>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
}
function CommandeTemplate() {
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
		"<div>" +
			"<div class=\"ui-widget ui-widget-content ui-corner-all\">" +
			"<span class=\"com-float-left ui-icon ui-icon-check\"></span>" +
			"<span>Commande effectuée avec succés</span>" +
		"</div>" +
		"</div>";		
		
	this.reservationKo = 
		"<div>" +
			"<div class=\"ui-widget\">" +
				"<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
					"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
					"<strong>Erreur : </strong> Votre commande n'a pas été prise en compte.<br/>" +
					"<!-- BEGIN erreurs -->" +
					"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
					"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
					"<!-- END erreurs -->" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
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
	
	$("#lien_gestion_adherent_operation").click(
			function () { 
				$('#widget_formulaire_ajout_operation_adherent').slideToggle();
			}
	);
	
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	$(".com-date").datepicker({
			changeMonth: true,
			changeYear: true
	});		

});//var menu_obj = null;

$(document).ready(function() {
	$('#menu_liste > li').hover(function() {
		$('#menu_liste > li > ul').hide();
		if($(this).find('ul').css('display') == 'none') {
			$(this).find('ul').fadeIn('fast');
		}
	}, function() {
		$(this).find('ul').stop().fadeTo(0,1).fadeOut('fast');
	});
	
	$('.sous_menu > li').hover( function() {$(this).addClass("ui-state-focus")} , function() {$(this).removeClass("ui-state-focus")});
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
}function AjoutAdherentVue() {
	this.mCommunVue = new CommunVue();
	
	this.affect = function() {
		this.boutonLienCompte();
		this.mCommunVue.comNumeric();
	}
	
	this.boutonLienCompte = function() {		
		$(":input[name=lien_numero_compte]").click(function() {
			if($(":input[name=numero_compte]").attr("disabled")) {
				$(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				$(":input[name=numero_compte]").attr("disabled","disabled").val("");				
			}			
		});
	}	
}


$(document).ready(function() {
	var lAjoutAdherentVue = new AjoutAdherentVue()
	lAjoutAdherentVue.affect();
});/********** Début Création Commande ************/
function AjoutCommandeVue() {
	
	this.etapeCreationCommande = 0;
	this.mCommunVue = new CommunVue();
	this.mControleur = new AjoutCommandeControleur();
		
	this.affect = function() {
		this.ajoutProduit("formulaire-ajout-produit-creation-commande");
		this.creerCommande("btn-creer-commande");
		this.modifierCommande();
		this.dialogCreerProduit();
		this.controleDatepicker();
		this.mCommunVue.comNumeric();
	}
		
	this.affectAjoutProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.affectAjoutLot(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		return pData;
	}
	
	this.ajoutProduit = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).submit(
			function () {
				
				var lValid = true;
				$(".produit-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);
								
					var lVr = that.mControleur.validAjoutProduit(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.siglemonetaire = gSigleMonetaire;
							
						$("#liste_produit").append(that.affectAjoutProduit($(lTemplate.template(lVo)))); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						
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
	}
	
	this.creerCommande = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).click(
			function () {
				var lValidCommande = true;
				$("#liste_produit").find(":button").each(function() {
					if($(this).text() == gTextValider) {
						lValidCommande = false;
					}
				});
				
				if(lValidCommande) {
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
						
						var lVR = that.mControleur.valid(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide(); //"blind",gTempsTransitionUnique
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande").each(
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
										$('#ajoutcommande').replaceWith(lTemplate.template(lVoRetour));
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
	}
		
	this.modifierCommande = function() {
		var that = this;
		$('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande').hide();
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
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
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
		pData.find('.edit-nom-pdt-creation-commande').click(
    		function () {
    			if($(this).text() == gTextEdition) {
    				$(this).text(gTextValider);
    				$(this).parent().children(':input:not(:button,:submit)').each(
    						function () { $(this).textToInput(); });
    			} else {    				
    				var lVo = new ProduitCommandeVO();
    				var lId = $(this).parentsUntil(".produit-div");    				
    				lVo.idNom = $(lId).find(".produit-id").text();
    				lVo.nom = $(lId).find(".produit-nom").text();
    				lVo.unite = $(lId).find(":input[name=unite]").val();
    				lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
    				lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
    				
    				var lVr = that.mControleur.validAjoutProduitSimple(lVo);
    				
    				if(lVr.valid) {
    					Infobulle.init();
	    				$(this).text(gTextEdition);
	    				$(this).parent().children(':input:not(:button,:submit)').each(
	    						function () { $(this).inputToText(); });
	    				var lDivParent = $(this).parentsUntil('#liste_produit');
	        			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    				} else {
    					Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
    				}
    			}
    		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
		pData.find(".edit-lot-creation-commande").click( function () {
			if($(this).text() == gTextEdition) {
				$(this).text(gTextValider);
				$(this).parent().children(':input:not(:button,:submit)').each(
						function () { $(this).textToInput(); });
			} else {
				
				
				var lVo = new DetailCommandeVO();
				var lId = $(this).parent(".produit-lot");
				
				lVo.id = $(lId).find(".lot-id").text();
				lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
				lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
				lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {	
					Infobulle.init();
					$(this).text(gTextEdition);
					$(this).parent().find(":input[name='taille']").inputToText();
					$(this).parent().find(":input[name='prix']").inputToText("montant");
				} else {
					Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
				}
			}});
		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().remove();
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
	
	this.dialogCreerProduit = function() {
		$("#dialog-form-creer-nv-pdt").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Créer le produit': function() {			
					var lForm = $(this).children('form').first();
					var lNom = lForm.find(':input[name=nom]');
					var lValid = true;
					
					$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
					lForm.find(':input').removeClass('ui-state-error');			
	
					lValid = lNom.checkLength(1,50); // Longueur du nom
					
					if(lValid) {						
						// Ajout
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								lForm.serialize() + "&form=1",
							function (retour) {		
							
								/* Traitement du retour */
							// TODO Vérifier en fonctionnel si il n'existe pas déjà un produit de ce type
							if(retour.succes == true) {
								// Ajout dans la liste du select avec son ID									
								$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(retour.produit, true).sortOptions();
								$("#dialog-form-creer-nv-pdt").dialog('close');
								
							} else {								
								
								var lTemplate = "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
													"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
													"<strong>Erreur : </strong> L'ajout n'a pas été effectué.<br/>" +
													"<!-- BEGIN erreurs -->" +
													"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
													"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
													"<!-- END erreurs -->" +
													"</p>" +
												"</div>";
								
								$("#dialog-form-creer-nv-pdt").children().first().html(lTemplate.template(retour)).fadeIn(gTempsTransitionUnique);
							}
														
							},
							"json"
						);
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				$(this).children('form').first().find(':input').val('').removeClass('ui-state-error');
				$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
			}
		});

		$('#btn-creer-nv-pdt')
		//.button()
		.click(function() {
			$('#dialog-form-creer-nv-pdt').dialog('open');
		});	
	}
	
	this.controleDatepicker = function() {
		lienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut');
	}
	
}


$(document).ready(function() {
	var lAjoutCommandeVue = new AjoutCommandeVue()
	lAjoutCommandeVue.affect();
});
		/********** Fin Création Commande ************/function AchatCommandeVue() {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.listeLot = new Array();
	this.typePaiement = null;
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	
	this.construct = function(pIdCommande, pIdAdherent) {
		var that = this;		
		this.idCommande = pIdCommande;
		this.idAdherent = pIdAdherent;
		
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pIdCommande + "&id_adherent=" + pIdAdherent,
				function(lResponse) {
					if(lResponse.valid) {
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
						var lTpp = new Array();
						for(lIndice in lResponse.typePaiement) {
							lTpp[lResponse.typePaiement[lIndice].id] = lResponse.typePaiement[lIndice];
						}
						that.typePaiement = lTpp;	
						that.solde = parseFloat(lResponse.adherent.opeMontant);
					}
					that.afficher(lResponse);
				},"json"
		);
		var lResponse;
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
			
			lData.typePaiement = pResponse.typePaiement;
			
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
			$(":input[name=champ-complementaire]").val();
			$("#td-champ-complementaire").hide();
		}
	}
		
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.typePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].champComplementaire == 1) {
				return lTpp[pId].labelChampComplementaire;
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
		var lMarcheCommandeVue = new MarcheCommandeVue();
		lMarcheCommandeVue.construct(this.idCommande);
	}
}function MarcheCommandeVue() {
	this.idCommande = null;
	
	this.construct = function(pId) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pId,
				function(lResponse) {
			//alert(lResponse);
					that.afficher(lResponse);
				},"json"
		);
		this.idCommande = pId;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.listeAdherentCommandePage;
				pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
				$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
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
		return pData;
	}
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lVue = new AchatCommandeVue();
			lVue.construct(that.idCommande,$(this).find(".id-adherent").text());
		});
		return pData;
	}	
}function ListeCommandeVue() {
	this.construct = function() {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", 
				function(lResponse) {
					that.afficher(lResponse);
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lListeCommande = new Object;
		lListeCommande.commande = new Array();
		
			$(lResponse.listeCommande).each(function() {
				var lCommande = new Object();
				lCommande.numero = this.comNumero;
				lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
				lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
				lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
				
				lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
				lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
				lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
				
				lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
				lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
				
				lCommande.lienEdit = '"' + this.comId + '"';
				lCommande.lienMarche = '"' + this.comId + '"';

				lListeCommande.commande.push(lCommande);
			});
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeCommandePage;
		$('#contenu').replaceWith(that.affectLienMarche($(lTemplate.template(lListeCommande))));		
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.liste-commande-lien-marche').click(function() {
			var lPage = new MarcheCommandeVue();
			lPage.construct($(this).attr('id'));
		});
		return pData;
	}
}


$(document).ready(function() {	
	$('#menu-gcom-liste-commande').click(function() {
		var lListeCommandeVue = new ListeCommandeVue();
		lListeCommandeVue.construct();
	});
	
});	/********** Début Réservation Commande ************/
function ReservationCommandeVue() {
	
	this.totalCommande = function() {
		var total = 0;
		$(":radio:checked").each(
				function() {
					var idproduit = "checkbox_" + $(this).attr("name").substr(6);			
					
					if($("input[name=" + idproduit + "]").attr("checked")) {
						var prixProduit = parseFloat($(this).attr("value")) * parseInt($(this).parent().next().next().next().children().first().html());
						$(this).parent().next().next().next().next().next().children().first().html(prixProduit.nombreFormate(2,',',' '));
						total += prixProduit;
					}
				});
		
		if(total == 0)
			$("#button-submit-reservation-commande").attr("disabled","disabled");
		else
			$("#button-submit-reservation-commande").removeAttr("disabled");
		
		$("#total_commande").html(total.nombreFormate(2,',',' '));		
	}
	
	this.radioCommandeClick = function(obj, idproduit) {
		$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
		$(obj).parent().next().next().next().children(":input").each(
			function () { $(this).removeAttr("disabled") });
	}
	
	this.changerQte = function(obj,qte) {
		var qteActuelle = parseInt($(obj).html());
		var qteMax = parseFloat($("#qte_max_" + $(obj).attr("class").substr(27)).html());
		var lot = parseFloat($(obj).parent().prev().prev().children().first().html())
		
		qteMax = qteMax / lot;
		qteActuelle += qte;
		
		if(qteActuelle < 1)
			qteActuelle = 1;
		
		if(qteActuelle > qteMax)
			qteActuelle = Math.floor(qteMax);
		
		$(obj).html(qteActuelle);
		$(obj).parent().next().children().first().html(qteActuelle * lot);
		this.totalCommande();
	}
	
	this.construct = function() {
		var that = this;
		$(".input-total-commande").click(
			function () {
				that.totalCommande();
			});
	
		$(".checkbox-commande").click(
			function () {
				var idproduit = $(this).attr("name").substr(9);
				if($(this).attr("checked")) {					
					that.radioCommandeClick($("input[name=radio_" + idproduit + "]:checked"),idproduit);					
					that.changerQte($("input[name=radio_" + idproduit + "]:checked").parent().next().next().next().children().first(),0);					
					$("input[name=radio_" + idproduit + "]").removeAttr("disabled");					
				} else {
					$("input[name=radio_" + idproduit + "]").attr("disabled","disabled");
					$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
					$(".qte_tot_" + idproduit).html('-');
					$(".prix_tot_" + idproduit).html('-');					
				}
			});
	
		$(".radio-commande").click(
			function () {
				var idproduit =  $(this).attr("name").substr(6);
				that.radioCommandeClick($(this),idproduit);				
				
				$(".qte_tot_" + idproduit).html('-');
				$(".prix_tot_" + idproduit).html('-');
				that.changerQte($(this).parent().next().next().next().children().first(),0);
				
				that.totalCommande();				
			});
		

	
		$(".plus-qte-commande").click( function () { that.changerQte($(this).prev().prev(),1); });
		$(".moins-qte-commande").click( function () { that.changerQte($(this).prev(),-1); });
	
		$("#button-submit-reservation-commande").click(
				function () {
					/* Récupération des données */
					var lData = new Array();
					lData['produit'] = new Array();
					lData['info_produit'] = new Array();
					
					var lSigle = "";
					
					$(":radio:checked").each(
							function() {
								var idproduit = $(this).attr("name").substr(6);
								var idcheckbox = "checkbox_" + idproduit;			
								var checkbox = $("input[name=" + idcheckbox + "]");
								if(checkbox.attr("checked")) {

									lSigle = $(this).parent().next().next().next().next().next().children().last().html();
									
									 var lDataTemp = new Array();
									 lDataTemp['NOM'] = checkbox.next().html();
									 lDataTemp['QUANTITE'] = $(this).parent().next().next().next().next().children().first().html() + $(this).parent().next().next().next().next().children().last().html();
									 lDataTemp['PRIX'] = $(this).parent().next().next().next().next().next().children().first().html() + lSigle;
									 lData['produit'].push(lDataTemp);
									 
									 var lDataTemp2 = new Array();
									 lDataTemp2['IDLOT'] = $(this).next().html();
									 lDataTemp2['IDPDT'] = idproduit;
									 lDataTemp2['QTE'] = $(this).parent().next().next().next().children().first().html();
									 lData['info_produit'].push(lDataTemp2);
									 

								}
							});
					
					lData['TOTAL_COMMANDE'] = $("#total_commande").html() + lSigle;
					lData['ID_COMMANDE'] = $("#id-commande-formulaire-reservation-commande").html();
					
					/* Récupération du template */	 
					var lCommandeTemplate = new CommandeTemplate();
					var lTemplate = lCommandeTemplate.confirmationReservationCommande;
					
					/* Ecriture des donnés */
					$("#confirmation-reservation-commande-text").html(lTemplate.template(lData));
					
					/* Affichage */
					$("#window-formulaire-reservation-commande").fadeOut(gTempsTransition,							
						function() { $("#confirmation-reservation-commande").fadeIn(gTempsTransition); }					
					);
				});
		
		$("#annuler-confirmation-reservation-commande").click(
				function () {
					$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
							function () {
					$("#window-formulaire-reservation-commande").fadeIn(gTempsTransition);
					});
					
				}
		
		);
	
		$("#commander-confirmation-reservation-commande").click(
			function () {				
				/* Passage de la commande */
				
				// TODO lancer la requete en json
				
				$.post(	"./index.php?m=Commande&v=ReservationCommande",
						$("#form-confirmation-reservation-commande").serialize(),
						function (retour) {
					//alert(retour);
							var lCommandeTemplate = new CommandeTemplate();
							/* Traitement du retour */
							var html;
							if(retour.succes == true) {
								html = lCommandeTemplate.reservationOk.template(retour);
							} else {
								html = lCommandeTemplate.reservationKo.template(retour);
							}
							$('#description_commande_int').hide();
							$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
									function () { $("#confirmation-reservation-commande").after(html);});
						},"json"
					);
			});
	}
}
		/********** Fin Réservation Commande ************/
$(document).ready(function() {
	var lReservationCommandeVue = new ReservationCommandeVue();
	lReservationCommandeVue.construct();	
});function TemplateData() {
	this.infobulle = "<!-- BEGIN membres -->" + //ui-helper-hidden 
			"<div class=\"com-infobulle com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ifb-{membres.nom}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Erreur : {membres.nom}</div>" +
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
const ERR_114_MSG = 'Plusieurs lignes dans la base au lieu d\'une attendue.';

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
const ERR_216_MSG = 'Aucune donnée pour l\'id donné.';/*
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

function lienDatepicker(pDatePetite,pDateGrande) {
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	var dates = $('#' + pDatePetite + ',#' + pDateGrande).datepicker({
		changeMonth: true,
		changeYear: true,
		onSelect: function(selectedDate) {
			var option = this.id == pDatePetite ? "minDate" : "maxDate";
			var instance = $(this).data("datepicker");
			var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});
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
						
			infobulle.css('position', 'absolute').css('z-index', '1000');
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
		return pNumber.replace(',','.');
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
};function CommandeCompleteVO() {
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
}function RechargementCompteVR() {
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
		return lTestId;
	}

}
function ProduitCommandeValid() { 
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

}function GestionCommandeTemplate() {
	this.ajoutProduitAjoutCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom\">{nom}</span>" +				
				"<button type=\"button\" class=\"com-delete\">X</button>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +				
				"<span class=\"produit-id ui-helper-hidden\">{idNom}</span>" +
				"Quantité en stock <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"stock\" value=\"{qteRestante}\" id=\"produit-{idNom}-qteRestante\" maxlength=\"11\"/><span class=\"produit-stock\">{qteRestante}</span><span class=\"produit-unite\">{unite}</span>" +
				"<button type=\"button\" class=\"edit-nom-pdt-creation-commande\">Editer</button><br/>" +
				"Quantité max par adhérent <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"qmax\" value=\"{qteMaxCommande}\" id=\"produit-{idNom}-qteMaxCommande\" maxlength=\"11\"/><span class=\"produit-qmax\">{qteMaxCommande}</span> <input class=\"ui-helper-hidden\" type=\"text\" name=\"unite\" value=\"{unite}\" id=\"produit-{idNom}-unite\" maxlength=\"20\"/><span class=\"produit-unite\">{unite}</span>" +
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
								"<td><input class=\"com-numeric\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{idNom}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{unite}</span></td>" +
								"<td><input class=\"com-numeric\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{idNom}-prix\" maxlength=\"12\"/> {siglemonetaire}</td>" +
								"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande\">Ajouter</button></td>" +
							"</tr>" +
						"</table>" +
					"</form>" +
				"</div>" +
				"<div class=\"produit-lots\">" +
				"<!-- BEGIN lots -->" +
					"<div class=\"produit-lot\">" +
							"<span class=\"lot-id ui-helper-hidden\">0</span>" +
							"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{idNom}-lot-0-taille\" maxlength=\"12\"/><span class=\"produit-taille\">{lots.taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{idNom}-lot-0-prix\" maxlength=\"12\" /><span class=\"produit-prix\">{lots.prix}</span>{siglemonetaire}" +
							"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
							"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
					"</div>" +
				"<!-- END lots -->" +
				"</div>" +
			"</div>" +
		"</div>";	
	
	this.ajoutLot = 
		"<div class=\"produit-lot\">" +
			"<span class=\"lot-id ui-helper-hidden\">{id}</span>" +
			"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{taille}\" id=\"produit-{idNom}-lot-{id}-taille\" maxlength=\"12\"><span class=\"produit-taille\">{taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{prix}\" id=\"produit-{idNom}-lot-{id}-prix\" maxlength=\"12\"><span class=\"produit-prix\">{prix}</span>{siglemonetaire}" +
			"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
			"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
		"</div>";

	this.ajoutCommandeSucces = 
		"<div id=\"ajout_commande_succes\" class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-div-ext-top\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Création de commande" +				
			"</div>" +
			"<div class=\"com-widget-content\">" +
				"<p>La commande n° : {numero} a été ajoutée avec succès.</p>" +
			"</div>" +
		"</div>";		
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Commandes en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Numéro</th>" +
								"<th class=\"com-table-th\">Date limite de Réservation</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr >" +
								"<td class=\"com-table-td\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<a class=\"ui-state-default ui-corner-all com-button com-center\" href={commande.lienEdit}>Editer</a>" +
								"</td>" +"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<span class=\"liste-commande-lien-marche ui-state-default ui-corner-all com-button com-center\" id={commande.lienMarche}>Marché</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
					"<div class=\"recherche com-center com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">Recherche Rapide : <input  class=\"com-input-text ui-widget-content ui-corner-all\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" /></form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</span></th>	" +
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
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
				"<div class=\"com-widget-content\">" +
					"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
				"<div class=\"com-widget-content\">" +
				"<table>" +
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
							"<td class=\"com-text-align-right\"><input type=\"text\" value=\"{produits.stoQuantite}\" class=\"com-numeric produit-quantite\" id=\"produits{produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td>{produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right\" ><input type=\"text\" value=\"{produits.proPrix}\" class=\"com-numeric produit-prix\" id=\"produits{produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"<!-- END produits -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"2\"></td>" +
							"<td>Total :</td>" +
							"<td><span id=\"total-achat\">{total}</span></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
								"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric\" id=\"rechargementmontant\" maxlength=\"12\" size=\"3\"/> <span>{sigleMonetaire}</span></td>" +
								"<td>" +
									"<select name=\"typepaiement\" id=\"typepaiement\">" +
										"<!-- BEGIN typePaiement -->" +
										"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
										"<!-- END typePaiement -->" +
									"</select>" +
								"</td>" +
								"<td id=\"td-champ-complementaire\"><input type=\"text\" name=\"champ-complementaire\" value=\"\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<button type=\"button\" id=\"btn-annuler\">Annuler</button>" +
				"<button type=\"button\" class=\"ui-helper-hidden\" id=\"btn-modifier\">Modifier</button>" +
				"<button type=\"button\" id=\"btn-valider\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.achatCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<div><span class=\"com-float-left ui-icon ui-icon-check\"></span>Achat effectué avec succès.</div>" +
					"<div>" +
						"<button id=\"btn-annuler\">Retourner à la liste des commandes</button>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
}
function CommandeTemplate() {
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
		"<div>" +
			"<div class=\"ui-widget ui-widget-content ui-corner-all\">" +
			"<span class=\"com-float-left ui-icon ui-icon-check\"></span>" +
			"<span>Commande effectuée avec succés</span>" +
		"</div>" +
		"</div>";		
		
	this.reservationKo = 
		"<div>" +
			"<div class=\"ui-widget\">" +
				"<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
					"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
					"<strong>Erreur : </strong> Votre commande n'a pas été prise en compte.<br/>" +
					"<!-- BEGIN erreurs -->" +
					"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
					"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
					"<!-- END erreurs -->" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
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
	
	$("#lien_gestion_adherent_operation").click(
			function () { 
				$('#widget_formulaire_ajout_operation_adherent').slideToggle();
			}
	);
	
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	$(".com-date").datepicker({
			changeMonth: true,
			changeYear: true
	});		

});//var menu_obj = null;

$(document).ready(function() {
	$('#menu_liste > li').hover(function() {
		$('#menu_liste > li > ul').hide();
		if($(this).find('ul').css('display') == 'none') {
			$(this).find('ul').fadeIn('fast');
		}
	}, function() {
		$(this).find('ul').stop().fadeTo(0,1).fadeOut('fast');
	});
	
	$('.sous_menu > li').hover( function() {$(this).addClass("ui-state-focus")} , function() {$(this).removeClass("ui-state-focus")});
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
}function AjoutAdherentVue() {
	this.mCommunVue = new CommunVue();
	
	this.affect = function() {
		this.boutonLienCompte();
		this.mCommunVue.comNumeric();
	}
	
	this.boutonLienCompte = function() {		
		$(":input[name=lien_numero_compte]").click(function() {
			if($(":input[name=numero_compte]").attr("disabled")) {
				$(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				$(":input[name=numero_compte]").attr("disabled","disabled").val("");				
			}			
		});
	}	
}


$(document).ready(function() {
	var lAjoutAdherentVue = new AjoutAdherentVue()
	lAjoutAdherentVue.affect();
});/********** Début Création Commande ************/
function AjoutCommandeVue() {
	
	this.etapeCreationCommande = 0;
	this.mCommunVue = new CommunVue();
	this.mControleur = new AjoutCommandeControleur();
		
	this.affect = function() {
		this.ajoutProduit("formulaire-ajout-produit-creation-commande");
		this.creerCommande("btn-creer-commande");
		this.modifierCommande();
		this.dialogCreerProduit();
		this.controleDatepicker();
		this.mCommunVue.comNumeric();
	}
		
	this.affectAjoutProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.affectAjoutLot(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		return pData;
	}
	
	this.ajoutProduit = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).submit(
			function () {
				
				var lValid = true;
				$(".produit-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);
								
					var lVr = that.mControleur.validAjoutProduit(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.siglemonetaire = gSigleMonetaire;
							
						$("#liste_produit").append(that.affectAjoutProduit($(lTemplate.template(lVo)))); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						
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
	}
	
	this.creerCommande = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).click(
			function () {
				var lValidCommande = true;
				$("#liste_produit").find(":button").each(function() {
					if($(this).text() == gTextValider) {
						lValidCommande = false;
					}
				});
				
				if(lValidCommande) {
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
						
						var lVR = that.mControleur.valid(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide(); //"blind",gTempsTransitionUnique
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande").each(
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
										$('#ajoutcommande').replaceWith(lTemplate.template(lVoRetour));
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
	}
		
	this.modifierCommande = function() {
		var that = this;
		$('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande').hide();
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
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
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
		pData.find('.edit-nom-pdt-creation-commande').click(
    		function () {
    			if($(this).text() == gTextEdition) {
    				$(this).text(gTextValider);
    				$(this).parent().children(':input:not(:button,:submit)').each(
    						function () { $(this).textToInput(); });
    			} else {    				
    				var lVo = new ProduitCommandeVO();
    				var lId = $(this).parentsUntil(".produit-div");    				
    				lVo.idNom = $(lId).find(".produit-id").text();
    				lVo.nom = $(lId).find(".produit-nom").text();
    				lVo.unite = $(lId).find(":input[name=unite]").val();
    				lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
    				lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
    				
    				var lVr = that.mControleur.validAjoutProduitSimple(lVo);
    				
    				if(lVr.valid) {
    					Infobulle.init();
	    				$(this).text(gTextEdition);
	    				$(this).parent().children(':input:not(:button,:submit)').each(
	    						function () { $(this).inputToText(); });
	    				var lDivParent = $(this).parentsUntil('#liste_produit');
	        			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    				} else {
    					Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
    				}
    			}
    		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
		pData.find(".edit-lot-creation-commande").click( function () {
			if($(this).text() == gTextEdition) {
				$(this).text(gTextValider);
				$(this).parent().children(':input:not(:button,:submit)').each(
						function () { $(this).textToInput(); });
			} else {
				
				
				var lVo = new DetailCommandeVO();
				var lId = $(this).parent(".produit-lot");
				
				lVo.id = $(lId).find(".lot-id").text();
				lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
				lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
				lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {	
					Infobulle.init();
					$(this).text(gTextEdition);
					$(this).parent().find(":input[name='taille']").inputToText();
					$(this).parent().find(":input[name='prix']").inputToText("montant");
				} else {
					Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
				}
			}});
		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().remove();
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
	
	this.dialogCreerProduit = function() {
		$("#dialog-form-creer-nv-pdt").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Créer le produit': function() {			
					var lForm = $(this).children('form').first();
					var lNom = lForm.find(':input[name=nom]');
					var lValid = true;
					
					$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
					lForm.find(':input').removeClass('ui-state-error');			
	
					lValid = lNom.checkLength(1,50); // Longueur du nom
					
					if(lValid) {						
						// Ajout
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								lForm.serialize() + "&form=1",
							function (retour) {		
							
								/* Traitement du retour */
							// TODO Vérifier en fonctionnel si il n'existe pas déjà un produit de ce type
							if(retour.succes == true) {
								// Ajout dans la liste du select avec son ID									
								$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(retour.produit, true).sortOptions();
								$("#dialog-form-creer-nv-pdt").dialog('close');
								
							} else {								
								
								var lTemplate = "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
													"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
													"<strong>Erreur : </strong> L'ajout n'a pas été effectué.<br/>" +
													"<!-- BEGIN erreurs -->" +
													"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
													"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
													"<!-- END erreurs -->" +
													"</p>" +
												"</div>";
								
								$("#dialog-form-creer-nv-pdt").children().first().html(lTemplate.template(retour)).fadeIn(gTempsTransitionUnique);
							}
														
							},
							"json"
						);
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				$(this).children('form').first().find(':input').val('').removeClass('ui-state-error');
				$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
			}
		});

		$('#btn-creer-nv-pdt')
		//.button()
		.click(function() {
			$('#dialog-form-creer-nv-pdt').dialog('open');
		});	
	}
	
	this.controleDatepicker = function() {
		lienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut');
	}
	
}


$(document).ready(function() {
	var lAjoutCommandeVue = new AjoutCommandeVue()
	lAjoutCommandeVue.affect();
});
		/********** Fin Création Commande ************/function AchatCommandeVue() {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.listeLot = new Array();
	this.typePaiement = null;
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	
	this.construct = function(pIdCommande, pIdAdherent) {
		var that = this;		
		this.idCommande = pIdCommande;
		this.idAdherent = pIdAdherent;
		
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pIdCommande + "&id_adherent=" + pIdAdherent,
				function(lResponse) {
					if(lResponse.valid) {
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
						var lTpp = new Array();
						for(lIndice in lResponse.typePaiement) {
							lTpp[lResponse.typePaiement[lIndice].id] = lResponse.typePaiement[lIndice];
						}
						that.typePaiement = lTpp;	
						that.solde = parseFloat(lResponse.adherent.opeMontant);
					}
					that.afficher(lResponse);
				},"json"
		);
		var lResponse;
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
			
			lData.typePaiement = pResponse.typePaiement;
			
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
			$(":input[name=champ-complementaire]").val();
			$("#td-champ-complementaire").hide();
		}
	}
		
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.typePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].champComplementaire == 1) {
				return lTpp[pId].labelChampComplementaire;
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
		var lMarcheCommandeVue = new MarcheCommandeVue();
		lMarcheCommandeVue.construct(this.idCommande);
	}
}function MarcheCommandeVue() {
	this.idCommande = null;
	
	this.construct = function(pId) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pId,
				function(lResponse) {
			//alert(lResponse);
					that.afficher(lResponse);
				},"json"
		);
		this.idCommande = pId;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.listeAdherentCommandePage;
				pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
				$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
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
		return pData;
	}
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lVue = new AchatCommandeVue();
			lVue.construct(that.idCommande,$(this).find(".id-adherent").text());
		});
		return pData;
	}	
}function ListeCommandeVue() {
	this.construct = function() {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", 
				function(lResponse) {
					that.afficher(lResponse);
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lListeCommande = new Object;
		lListeCommande.commande = new Array();
		
			$(lResponse.listeCommande).each(function() {
				var lCommande = new Object();
				lCommande.numero = this.comNumero;
				lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
				lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
				lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
				
				lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
				lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
				lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
				
				lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
				lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
				
				lCommande.lienEdit = '"' + this.comId + '"';
				lCommande.lienMarche = '"' + this.comId + '"';

				lListeCommande.commande.push(lCommande);
			});
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeCommandePage;
		$('#contenu').replaceWith(that.affectLienMarche($(lTemplate.template(lListeCommande))));		
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.liste-commande-lien-marche').click(function() {
			var lPage = new MarcheCommandeVue();
			lPage.construct($(this).attr('id'));
		});
		return pData;
	}
}


$(document).ready(function() {	
	$('#menu-gcom-liste-commande').click(function() {
		var lListeCommandeVue = new ListeCommandeVue();
		lListeCommandeVue.construct();
	});
	
});	/********** Début Réservation Commande ************/
function ReservationCommandeVue() {
	
	this.totalCommande = function() {
		var total = 0;
		$(":radio:checked").each(
				function() {
					var idproduit = "checkbox_" + $(this).attr("name").substr(6);			
					
					if($("input[name=" + idproduit + "]").attr("checked")) {
						var prixProduit = parseFloat($(this).attr("value")) * parseInt($(this).parent().next().next().next().children().first().html());
						$(this).parent().next().next().next().next().next().children().first().html(prixProduit.nombreFormate(2,',',' '));
						total += prixProduit;
					}
				});
		
		if(total == 0)
			$("#button-submit-reservation-commande").attr("disabled","disabled");
		else
			$("#button-submit-reservation-commande").removeAttr("disabled");
		
		$("#total_commande").html(total.nombreFormate(2,',',' '));		
	}
	
	this.radioCommandeClick = function(obj, idproduit) {
		$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
		$(obj).parent().next().next().next().children(":input").each(
			function () { $(this).removeAttr("disabled") });
	}
	
	this.changerQte = function(obj,qte) {
		var qteActuelle = parseInt($(obj).html());
		var qteMax = parseFloat($("#qte_max_" + $(obj).attr("class").substr(27)).html());
		var lot = parseFloat($(obj).parent().prev().prev().children().first().html())
		
		qteMax = qteMax / lot;
		qteActuelle += qte;
		
		if(qteActuelle < 1)
			qteActuelle = 1;
		
		if(qteActuelle > qteMax)
			qteActuelle = Math.floor(qteMax);
		
		$(obj).html(qteActuelle);
		$(obj).parent().next().children().first().html(qteActuelle * lot);
		this.totalCommande();
	}
	
	this.construct = function() {
		var that = this;
		$(".input-total-commande").click(
			function () {
				that.totalCommande();
			});
	
		$(".checkbox-commande").click(
			function () {
				var idproduit = $(this).attr("name").substr(9);
				if($(this).attr("checked")) {					
					that.radioCommandeClick($("input[name=radio_" + idproduit + "]:checked"),idproduit);					
					that.changerQte($("input[name=radio_" + idproduit + "]:checked").parent().next().next().next().children().first(),0);					
					$("input[name=radio_" + idproduit + "]").removeAttr("disabled");					
				} else {
					$("input[name=radio_" + idproduit + "]").attr("disabled","disabled");
					$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
					$(".qte_tot_" + idproduit).html('-');
					$(".prix_tot_" + idproduit).html('-');					
				}
			});
	
		$(".radio-commande").click(
			function () {
				var idproduit =  $(this).attr("name").substr(6);
				that.radioCommandeClick($(this),idproduit);				
				
				$(".qte_tot_" + idproduit).html('-');
				$(".prix_tot_" + idproduit).html('-');
				that.changerQte($(this).parent().next().next().next().children().first(),0);
				
				that.totalCommande();				
			});
		

	
		$(".plus-qte-commande").click( function () { that.changerQte($(this).prev().prev(),1); });
		$(".moins-qte-commande").click( function () { that.changerQte($(this).prev(),-1); });
	
		$("#button-submit-reservation-commande").click(
				function () {
					/* Récupération des données */
					var lData = new Array();
					lData['produit'] = new Array();
					lData['info_produit'] = new Array();
					
					var lSigle = "";
					
					$(":radio:checked").each(
							function() {
								var idproduit = $(this).attr("name").substr(6);
								var idcheckbox = "checkbox_" + idproduit;			
								var checkbox = $("input[name=" + idcheckbox + "]");
								if(checkbox.attr("checked")) {

									lSigle = $(this).parent().next().next().next().next().next().children().last().html();
									
									 var lDataTemp = new Array();
									 lDataTemp['NOM'] = checkbox.next().html();
									 lDataTemp['QUANTITE'] = $(this).parent().next().next().next().next().children().first().html() + $(this).parent().next().next().next().next().children().last().html();
									 lDataTemp['PRIX'] = $(this).parent().next().next().next().next().next().children().first().html() + lSigle;
									 lData['produit'].push(lDataTemp);
									 
									 var lDataTemp2 = new Array();
									 lDataTemp2['IDLOT'] = $(this).next().html();
									 lDataTemp2['IDPDT'] = idproduit;
									 lDataTemp2['QTE'] = $(this).parent().next().next().next().children().first().html();
									 lData['info_produit'].push(lDataTemp2);
									 

								}
							});
					
					lData['TOTAL_COMMANDE'] = $("#total_commande").html() + lSigle;
					lData['ID_COMMANDE'] = $("#id-commande-formulaire-reservation-commande").html();
					
					/* Récupération du template */	 
					var lCommandeTemplate = new CommandeTemplate();
					var lTemplate = lCommandeTemplate.confirmationReservationCommande;
					
					/* Ecriture des donnés */
					$("#confirmation-reservation-commande-text").html(lTemplate.template(lData));
					
					/* Affichage */
					$("#window-formulaire-reservation-commande").fadeOut(gTempsTransition,							
						function() { $("#confirmation-reservation-commande").fadeIn(gTempsTransition); }					
					);
				});
		
		$("#annuler-confirmation-reservation-commande").click(
				function () {
					$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
							function () {
					$("#window-formulaire-reservation-commande").fadeIn(gTempsTransition);
					});
					
				}
		
		);
	
		$("#commander-confirmation-reservation-commande").click(
			function () {				
				/* Passage de la commande */
				
				// TODO lancer la requete en json
				
				$.post(	"./index.php?m=Commande&v=ReservationCommande",
						$("#form-confirmation-reservation-commande").serialize(),
						function (retour) {
					//alert(retour);
							var lCommandeTemplate = new CommandeTemplate();
							/* Traitement du retour */
							var html;
							if(retour.succes == true) {
								html = lCommandeTemplate.reservationOk.template(retour);
							} else {
								html = lCommandeTemplate.reservationKo.template(retour);
							}
							$('#description_commande_int').hide();
							$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
									function () { $("#confirmation-reservation-commande").after(html);});
						},"json"
					);
			});
	}
}
		/********** Fin Réservation Commande ************/
$(document).ready(function() {
	var lReservationCommandeVue = new ReservationCommandeVue();
	lReservationCommandeVue.construct();	
});function TemplateData() {
	this.infobulle = "<!-- BEGIN membres -->" + //ui-helper-hidden 
			"<div class=\"com-infobulle com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ifb-{membres.nom}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Erreur : {membres.nom}</div>" +
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
const ERR_114_MSG = 'Plusieurs lignes dans la base au lieu d\'une attendue.';

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
const ERR_216_MSG = 'Aucune donnée pour l\'id donné.';/*
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

function lienDatepicker(pDatePetite,pDateGrande) {
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	var dates = $('#' + pDatePetite + ',#' + pDateGrande).datepicker({
		changeMonth: true,
		changeYear: true,
		onSelect: function(selectedDate) {
			var option = this.id == pDatePetite ? "minDate" : "maxDate";
			var instance = $(this).data("datepicker");
			var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});
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
						
			infobulle.css('position', 'absolute').css('z-index', '1000');
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
		return pNumber.replace(',','.');
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
};function CommandeCompleteVO() {
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
}function RechargementCompteVR() {
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
		return lTestId;
	}

}
function ProduitCommandeValid() { 
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

}function GestionCommandeTemplate() {
	this.ajoutProduitAjoutCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom\">{nom}</span>" +				
				"<button type=\"button\" class=\"com-delete\">X</button>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +				
				"<span class=\"produit-id ui-helper-hidden\">{idNom}</span>" +
				"Quantité en stock <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"stock\" value=\"{qteRestante}\" id=\"produit-{idNom}-qteRestante\" maxlength=\"11\"/><span class=\"produit-stock\">{qteRestante}</span><span class=\"produit-unite\">{unite}</span>" +
				"<button type=\"button\" class=\"edit-nom-pdt-creation-commande\">Editer</button><br/>" +
				"Quantité max par adhérent <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"qmax\" value=\"{qteMaxCommande}\" id=\"produit-{idNom}-qteMaxCommande\" maxlength=\"11\"/><span class=\"produit-qmax\">{qteMaxCommande}</span> <input class=\"ui-helper-hidden\" type=\"text\" name=\"unite\" value=\"{unite}\" id=\"produit-{idNom}-unite\" maxlength=\"20\"/><span class=\"produit-unite\">{unite}</span>" +
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
								"<td><input class=\"com-numeric\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{idNom}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{unite}</span></td>" +
								"<td><input class=\"com-numeric\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{idNom}-prix\" maxlength=\"12\"/> {siglemonetaire}</td>" +
								"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande\">Ajouter</button></td>" +
							"</tr>" +
						"</table>" +
					"</form>" +
				"</div>" +
				"<div class=\"produit-lots\">" +
				"<!-- BEGIN lots -->" +
					"<div class=\"produit-lot\">" +
							"<span class=\"lot-id ui-helper-hidden\">0</span>" +
							"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{idNom}-lot-0-taille\" maxlength=\"12\"/><span class=\"produit-taille\">{lots.taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{idNom}-lot-0-prix\" maxlength=\"12\" /><span class=\"produit-prix\">{lots.prix}</span>{siglemonetaire}" +
							"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
							"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
					"</div>" +
				"<!-- END lots -->" +
				"</div>" +
			"</div>" +
		"</div>";	
	
	this.ajoutLot = 
		"<div class=\"produit-lot\">" +
			"<span class=\"lot-id ui-helper-hidden\">{id}</span>" +
			"Taille : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"taille\" value=\"{taille}\" id=\"produit-{idNom}-lot-{id}-taille\" maxlength=\"12\"><span class=\"produit-taille\">{taille}</span> <span class=\"produit-unite\">{unite}</span>   Prix : <input class=\"ui-helper-hidden com-numeric\" type=\"text\" name=\"prix\" value=\"{prix}\" id=\"produit-{idNom}-lot-{id}-prix\" maxlength=\"12\"><span class=\"produit-prix\">{prix}</span>{siglemonetaire}" +
			"<button type=\"button\" class=\"edit-lot-creation-commande\">Editer</button>" +
			"<button type=\"button\" class=\"ui-helper-hidden delete-lot\">X</button>" +
		"</div>";

	this.ajoutCommandeSucces = 
		"<div id=\"ajout_commande_succes\" class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-div-ext-top\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Création de commande" +				
			"</div>" +
			"<div class=\"com-widget-content\">" +
				"<p>La commande n° : {numero} a été ajoutée avec succès.</p>" +
			"</div>" +
		"</div>";		
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Commandes en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Numéro</th>" +
								"<th class=\"com-table-th\">Date limite de Réservation</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr >" +
								"<td class=\"com-table-td\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<a class=\"ui-state-default ui-corner-all com-button com-center\" href={commande.lienEdit}>Editer</a>" +
								"</td>" +"<td class=\"com-table-td com-td-lien-bouton\">" +
									"<span class=\"liste-commande-lien-marche ui-state-default ui-corner-all com-button com-center\" id={commande.lienMarche}>Marché</span>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
					"<div class=\"recherche com-center com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\">Recherche Rapide : <input  class=\"com-input-text ui-widget-content ui-corner-all\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" /></form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</span></th>	" +
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
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Marché de la Commande N° {comNumero}</div>" +
				"<div class=\"com-widget-content\">" +
					"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
				"<div class=\"com-widget-content\">" +
				"<table>" +
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
							"<td class=\"com-text-align-right\"><input type=\"text\" value=\"{produits.stoQuantite}\" class=\"com-numeric produit-quantite\" id=\"produits{produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td>{produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right\" ><input type=\"text\" value=\"{produits.proPrix}\" class=\"com-numeric produit-prix\" id=\"produits{produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"<!-- END produits -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"2\"></td>" +
							"<td>Total :</td>" +
							"<td><span id=\"total-achat\">{total}</span></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
								"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric\" id=\"rechargementmontant\" maxlength=\"12\" size=\"3\"/> <span>{sigleMonetaire}</span></td>" +
								"<td>" +
									"<select name=\"typepaiement\" id=\"typepaiement\">" +
										"<!-- BEGIN typePaiement -->" +
										"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
										"<!-- END typePaiement -->" +
									"</select>" +
								"</td>" +
								"<td id=\"td-champ-complementaire\"><input type=\"text\" name=\"champ-complementaire\" value=\"\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<button type=\"button\" id=\"btn-annuler\">Annuler</button>" +
				"<button type=\"button\" class=\"ui-helper-hidden\" id=\"btn-modifier\">Modifier</button>" +
				"<button type=\"button\" id=\"btn-valider\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.achatCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<div><span class=\"com-float-left ui-icon ui-icon-check\"></span>Achat effectué avec succès.</div>" +
					"<div>" +
						"<button id=\"btn-annuler\">Retourner à la liste des commandes</button>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
}
function CommandeTemplate() {
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
		"<div>" +
			"<div class=\"ui-widget ui-widget-content ui-corner-all\">" +
			"<span class=\"com-float-left ui-icon ui-icon-check\"></span>" +
			"<span>Commande effectuée avec succés</span>" +
		"</div>" +
		"</div>";		
		
	this.reservationKo = 
		"<div>" +
			"<div class=\"ui-widget\">" +
				"<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
					"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
					"<strong>Erreur : </strong> Votre commande n'a pas été prise en compte.<br/>" +
					"<!-- BEGIN erreurs -->" +
					"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
					"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
					"<!-- END erreurs -->" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
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
	
	$("#lien_gestion_adherent_operation").click(
			function () { 
				$('#widget_formulaire_ajout_operation_adherent').slideToggle();
			}
	);
	
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	$(".com-date").datepicker({
			changeMonth: true,
			changeYear: true
	});		

});//var menu_obj = null;

$(document).ready(function() {
	$('#menu_liste > li').hover(function() {
		$('#menu_liste > li > ul').hide();
		if($(this).find('ul').css('display') == 'none') {
			$(this).find('ul').fadeIn('fast');
		}
	}, function() {
		$(this).find('ul').stop().fadeTo(0,1).fadeOut('fast');
	});
	
	$('.sous_menu > li').hover( function() {$(this).addClass("ui-state-focus")} , function() {$(this).removeClass("ui-state-focus")});
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
}function AjoutAdherentVue() {
	this.mCommunVue = new CommunVue();
	
	this.affect = function() {
		this.boutonLienCompte();
		this.mCommunVue.comNumeric();
	}
	
	this.boutonLienCompte = function() {		
		$(":input[name=lien_numero_compte]").click(function() {
			if($(":input[name=numero_compte]").attr("disabled")) {
				$(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				$(":input[name=numero_compte]").attr("disabled","disabled").val("");				
			}			
		});
	}	
}


$(document).ready(function() {
	var lAjoutAdherentVue = new AjoutAdherentVue()
	lAjoutAdherentVue.affect();
});/********** Début Création Commande ************/
function AjoutCommandeVue() {
	
	this.etapeCreationCommande = 0;
	this.mCommunVue = new CommunVue();
	this.mControleur = new AjoutCommandeControleur();
		
	this.affect = function() {
		this.ajoutProduit("formulaire-ajout-produit-creation-commande");
		this.creerCommande("btn-creer-commande");
		this.modifierCommande();
		this.dialogCreerProduit();
		this.controleDatepicker();
		this.mCommunVue.comNumeric();
	}
		
	this.affectAjoutProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.affectAjoutLot(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		return pData;
	}
	
	this.ajoutProduit = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).submit(
			function () {
				
				var lValid = true;
				$(".produit-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);
								
					var lVr = that.mControleur.validAjoutProduit(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.siglemonetaire = gSigleMonetaire;
							
						$("#liste_produit").append(that.affectAjoutProduit($(lTemplate.template(lVo)))); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						
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
	}
	
	this.creerCommande = function(pId) {
		var lId = "#" + pId;
		var that = this;
		$(lId).click(
			function () {
				var lValidCommande = true;
				$("#liste_produit").find(":button").each(function() {
					if($(this).text() == gTextValider) {
						lValidCommande = false;
					}
				});
				
				if(lValidCommande) {
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
						
						var lVR = that.mControleur.valid(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide(); //"blind",gTempsTransitionUnique
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande").each(
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
										$('#ajoutcommande').replaceWith(lTemplate.template(lVoRetour));
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
	}
		
	this.modifierCommande = function() {
		var that = this;
		$('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande').hide();
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
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
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
		pData.find('.edit-nom-pdt-creation-commande').click(
    		function () {
    			if($(this).text() == gTextEdition) {
    				$(this).text(gTextValider);
    				$(this).parent().children(':input:not(:button,:submit)').each(
    						function () { $(this).textToInput(); });
    			} else {    				
    				var lVo = new ProduitCommandeVO();
    				var lId = $(this).parentsUntil(".produit-div");    				
    				lVo.idNom = $(lId).find(".produit-id").text();
    				lVo.nom = $(lId).find(".produit-nom").text();
    				lVo.unite = $(lId).find(":input[name=unite]").val();
    				lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
    				lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
    				
    				var lVr = that.mControleur.validAjoutProduitSimple(lVo);
    				
    				if(lVr.valid) {
    					Infobulle.init();
	    				$(this).text(gTextEdition);
	    				$(this).parent().children(':input:not(:button,:submit)').each(
	    						function () { $(this).inputToText(); });
	    				var lDivParent = $(this).parentsUntil('#liste_produit');
	        			lDivParent.find('.produit-unite').text(lDivParent.children(':input[name=unite]').val());
    				} else {
    					Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
    				}
    			}
    		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
		pData.find(".edit-lot-creation-commande").click( function () {
			if($(this).text() == gTextEdition) {
				$(this).text(gTextValider);
				$(this).parent().children(':input:not(:button,:submit)').each(
						function () { $(this).textToInput(); });
			} else {
				
				
				var lVo = new DetailCommandeVO();
				var lId = $(this).parent(".produit-lot");
				
				lVo.id = $(lId).find(".lot-id").text();
				lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
				lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
				lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
				
				var lVr = that.mControleur.validAjoutLot(lVo);
				
				if(lVr.valid) {	
					Infobulle.init();
					$(this).text(gTextEdition);
					$(this).parent().find(":input[name='taille']").inputToText();
					$(this).parent().find(":input[name='prix']").inputToText("montant");
				} else {
					Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
				}
			}});
		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().remove();
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
	
	this.dialogCreerProduit = function() {
		$("#dialog-form-creer-nv-pdt").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width:400,
			buttons: {
				'Créer le produit': function() {			
					var lForm = $(this).children('form').first();
					var lNom = lForm.find(':input[name=nom]');
					var lValid = true;
					
					$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
					lForm.find(':input').removeClass('ui-state-error');			
	
					lValid = lNom.checkLength(1,50); // Longueur du nom
					
					if(lValid) {						
						// Ajout
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								lForm.serialize() + "&form=1",
							function (retour) {		
							
								/* Traitement du retour */
							// TODO Vérifier en fonctionnel si il n'existe pas déjà un produit de ce type
							if(retour.succes == true) {
								// Ajout dans la liste du select avec son ID									
								$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(retour.produit, true).sortOptions();
								$("#dialog-form-creer-nv-pdt").dialog('close');
								
							} else {								
								
								var lTemplate = "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">" +
													"<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>" +
													"<strong>Erreur : </strong> L'ajout n'a pas été effectué.<br/>" +
													"<!-- BEGIN erreurs -->" +
													"<strong>Code Erreur : </strong>{erreurs.CODE_ERREUR}<br/>" +
													"<strong>Message Erreur : </strong>{erreurs.MESSAGE_ERREUR}<br/>" +
													"<!-- END erreurs -->" +
													"</p>" +
												"</div>";
								
								$("#dialog-form-creer-nv-pdt").children().first().html(lTemplate.template(retour)).fadeIn(gTempsTransitionUnique);
							}
														
							},
							"json"
						);
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				$(this).children('form').first().find(':input').val('').removeClass('ui-state-error');
				$("#dialog-form-creer-nv-pdt").children().first().html('').hide();
			}
		});

		$('#btn-creer-nv-pdt')
		//.button()
		.click(function() {
			$('#dialog-form-creer-nv-pdt').dialog('open');
		});	
	}
	
	this.controleDatepicker = function() {
		lienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut');
	}
	
}


$(document).ready(function() {
	var lAjoutCommandeVue = new AjoutCommandeVue()
	lAjoutCommandeVue.affect();
});
		/********** Fin Création Commande ************/function AchatCommandeVue() {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.listeLot = new Array();
	this.typePaiement = null;
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	
	this.construct = function(pIdCommande, pIdAdherent) {
		var that = this;		
		this.idCommande = pIdCommande;
		this.idAdherent = pIdAdherent;
		
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pIdCommande + "&id_adherent=" + pIdAdherent,
				function(lResponse) {
					if(lResponse.valid) {
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
						var lTpp = new Array();
						for(lIndice in lResponse.typePaiement) {
							lTpp[lResponse.typePaiement[lIndice].id] = lResponse.typePaiement[lIndice];
						}
						that.typePaiement = lTpp;	
						that.solde = parseFloat(lResponse.adherent.opeMontant);
					}
					that.afficher(lResponse);
				},"json"
		);
		var lResponse;
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
			
			lData.typePaiement = pResponse.typePaiement;
			
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
			$(":input[name=champ-complementaire]").val();
			$("#td-champ-complementaire").hide();
		}
	}
		
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.typePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].champComplementaire == 1) {
				return lTpp[pId].labelChampComplementaire;
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
		var lMarcheCommandeVue = new MarcheCommandeVue();
		lMarcheCommandeVue.construct(this.idCommande);
	}
}function MarcheCommandeVue() {
	this.idCommande = null;
	
	this.construct = function(pId) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","id_commande=" + pId,
				function(lResponse) {
			//alert(lResponse);
					that.afficher(lResponse);
				},"json"
		);
		this.idCommande = pId;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.listeAdherentCommandePage;
				pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
				$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
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
		return pData;
	}
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lVue = new AchatCommandeVue();
			lVue.construct(that.idCommande,$(this).find(".id-adherent").text());
		});
		return pData;
	}	
}function ListeCommandeVue() {
	this.construct = function() {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", 
				function(lResponse) {
					that.afficher(lResponse);
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lListeCommande = new Object;
		lListeCommande.commande = new Array();
		
			$(lResponse.listeCommande).each(function() {
				var lCommande = new Object();
				lCommande.numero = this.comNumero;
				lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
				lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
				lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
				
				lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
				lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
				lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
				
				lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
				lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
				
				lCommande.lienEdit = '"' + this.comId + '"';
				lCommande.lienMarche = '"' + this.comId + '"';

				lListeCommande.commande.push(lCommande);
			});
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.listeCommandePage;
		$('#contenu').replaceWith(that.affectLienMarche($(lTemplate.template(lListeCommande))));		
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.liste-commande-lien-marche').click(function() {
			var lPage = new MarcheCommandeVue();
			lPage.construct($(this).attr('id'));
		});
		return pData;
	}
}


$(document).ready(function() {	
	$('#menu-gcom-liste-commande').click(function() {
		var lListeCommandeVue = new ListeCommandeVue();
		lListeCommandeVue.construct();
	});
	
});	/********** Début Réservation Commande ************/
function ReservationCommandeVue() {
	
	this.totalCommande = function() {
		var total = 0;
		$(":radio:checked").each(
				function() {
					var idproduit = "checkbox_" + $(this).attr("name").substr(6);			
					
					if($("input[name=" + idproduit + "]").attr("checked")) {
						var prixProduit = parseFloat($(this).attr("value")) * parseInt($(this).parent().next().next().next().children().first().html());
						$(this).parent().next().next().next().next().next().children().first().html(prixProduit.nombreFormate(2,',',' '));
						total += prixProduit;
					}
				});
		
		if(total == 0)
			$("#button-submit-reservation-commande").attr("disabled","disabled");
		else
			$("#button-submit-reservation-commande").removeAttr("disabled");
		
		$("#total_commande").html(total.nombreFormate(2,',',' '));		
	}
	
	this.radioCommandeClick = function(obj, idproduit) {
		$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
		$(obj).parent().next().next().next().children(":input").each(
			function () { $(this).removeAttr("disabled") });
	}
	
	this.changerQte = function(obj,qte) {
		var qteActuelle = parseInt($(obj).html());
		var qteMax = parseFloat($("#qte_max_" + $(obj).attr("class").substr(27)).html());
		var lot = parseFloat($(obj).parent().prev().prev().children().first().html())
		
		qteMax = qteMax / lot;
		qteActuelle += qte;
		
		if(qteActuelle < 1)
			qteActuelle = 1;
		
		if(qteActuelle > qteMax)
			qteActuelle = Math.floor(qteMax);
		
		$(obj).html(qteActuelle);
		$(obj).parent().next().children().first().html(qteActuelle * lot);
		this.totalCommande();
	}
	
	this.construct = function() {
		var that = this;
		$(".input-total-commande").click(
			function () {
				that.totalCommande();
			});
	
		$(".checkbox-commande").click(
			function () {
				var idproduit = $(this).attr("name").substr(9);
				if($(this).attr("checked")) {					
					that.radioCommandeClick($("input[name=radio_" + idproduit + "]:checked"),idproduit);					
					that.changerQte($("input[name=radio_" + idproduit + "]:checked").parent().next().next().next().children().first(),0);					
					$("input[name=radio_" + idproduit + "]").removeAttr("disabled");					
				} else {
					$("input[name=radio_" + idproduit + "]").attr("disabled","disabled");
					$(".button_commande_plus_moins_" + idproduit ).attr("disabled","disabled");
					$(".qte_tot_" + idproduit).html('-');
					$(".prix_tot_" + idproduit).html('-');					
				}
			});
	
		$(".radio-commande").click(
			function () {
				var idproduit =  $(this).attr("name").substr(6);
				that.radioCommandeClick($(this),idproduit);				
				
				$(".qte_tot_" + idproduit).html('-');
				$(".prix_tot_" + idproduit).html('-');
				that.changerQte($(this).parent().next().next().next().children().first(),0);
				
				that.totalCommande();				
			});
		

	
		$(".plus-qte-commande").click( function () { that.changerQte($(this).prev().prev(),1); });
		$(".moins-qte-commande").click( function () { that.changerQte($(this).prev(),-1); });
	
		$("#button-submit-reservation-commande").click(
				function () {
					/* Récupération des données */
					var lData = new Array();
					lData['produit'] = new Array();
					lData['info_produit'] = new Array();
					
					var lSigle = "";
					
					$(":radio:checked").each(
							function() {
								var idproduit = $(this).attr("name").substr(6);
								var idcheckbox = "checkbox_" + idproduit;			
								var checkbox = $("input[name=" + idcheckbox + "]");
								if(checkbox.attr("checked")) {

									lSigle = $(this).parent().next().next().next().next().next().children().last().html();
									
									 var lDataTemp = new Array();
									 lDataTemp['NOM'] = checkbox.next().html();
									 lDataTemp['QUANTITE'] = $(this).parent().next().next().next().next().children().first().html() + $(this).parent().next().next().next().next().children().last().html();
									 lDataTemp['PRIX'] = $(this).parent().next().next().next().next().next().children().first().html() + lSigle;
									 lData['produit'].push(lDataTemp);
									 
									 var lDataTemp2 = new Array();
									 lDataTemp2['IDLOT'] = $(this).next().html();
									 lDataTemp2['IDPDT'] = idproduit;
									 lDataTemp2['QTE'] = $(this).parent().next().next().next().children().first().html();
									 lData['info_produit'].push(lDataTemp2);
									 

								}
							});
					
					lData['TOTAL_COMMANDE'] = $("#total_commande").html() + lSigle;
					lData['ID_COMMANDE'] = $("#id-commande-formulaire-reservation-commande").html();
					
					/* Récupération du template */	 
					var lCommandeTemplate = new CommandeTemplate();
					var lTemplate = lCommandeTemplate.confirmationReservationCommande;
					
					/* Ecriture des donnés */
					$("#confirmation-reservation-commande-text").html(lTemplate.template(lData));
					
					/* Affichage */
					$("#window-formulaire-reservation-commande").fadeOut(gTempsTransition,							
						function() { $("#confirmation-reservation-commande").fadeIn(gTempsTransition); }					
					);
				});
		
		$("#annuler-confirmation-reservation-commande").click(
				function () {
					$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
							function () {
					$("#window-formulaire-reservation-commande").fadeIn(gTempsTransition);
					});
					
				}
		
		);
	
		$("#commander-confirmation-reservation-commande").click(
			function () {				
				/* Passage de la commande */
				
				// TODO lancer la requete en json
				
				$.post(	"./index.php?m=Commande&v=ReservationCommande",
						$("#form-confirmation-reservation-commande").serialize(),
						function (retour) {
					//alert(retour);
							var lCommandeTemplate = new CommandeTemplate();
							/* Traitement du retour */
							var html;
							if(retour.succes == true) {
								html = lCommandeTemplate.reservationOk.template(retour);
							} else {
								html = lCommandeTemplate.reservationKo.template(retour);
							}
							$('#description_commande_int').hide();
							$("#confirmation-reservation-commande").fadeOut(gTempsTransition,
									function () { $("#confirmation-reservation-commande").after(html);});
						},"json"
					);
			});
	}
}
		/********** Fin Réservation Commande ************/
$(document).ready(function() {
	var lReservationCommandeVue = new ReservationCommandeVue();
	lReservationCommandeVue.construct();	
});