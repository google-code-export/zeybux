;function CommunTemplate() {
	this.debutContenu = "<div id=\"contenu\">";
	this.finContenu = "</div>";
};function CommunVue() {
	
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
};function IdentificationTemplate() {
	this.connexion =
		"<div id=\"formulaire_identification_ifb\" title=\"Connexion à Zeybux\" >" +
			"<form id=\"identification-form\" action=\"./index.php\" method=\"post\">" +
				"<table>" +
					"<tr>" +
						"<td>Login</td>" +
						"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"login\" id=\"login\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<td>Mot de Passe</td>" +
						"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" id=\"pass\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";

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
	
	this.naviguateurIncompatible =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
		"</div>";
	
	this.formulaireIdentification = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_identification_int\" class=\"ui-widget ui-widget-content ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Connexion à Zeybux</div>" +
				"<form id=\"identification-form\" action=\"./index.php\" method=\"post\">" +
					"<table>" +
						"<tr>" +
							"<td>Login</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"login\" id=\"login\" value=\"Z\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<td>Mot de Passe</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" id=\"pass\" value=\"zeybu\" /></td>" +
						"</tr>" +
						"<tr>" +
							"<td colspan=\"2\" class=\"com-center com-ligne-submit\" ><input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Connexion\"/></td>" +
						"</tr>" +
					"</table>" +
				"</form>" +
			"</div>" +
		"</div>";
}function TemplateData() {
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
	}
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
	//this.pParam = '';
	//this.export_type = '';
	this.id_commande = '';
	this.format = '';
};function NomProduitVO() {
	this.id = '';
	this.nom = '';
	this.description = '';
	this.idCategorie = '';
}
function CompteSolidaireModifierVirementVO() {
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
	this.id_compte_producteur = '';
	//this.export_type = '';
	this.produits = new Array();
	this.typePaiement = '';
	this.total = '';
	this.typePaiementChampComplementaireObligatoire = '';
	this.typePaiementChampComplementaire = '';
}
function CompteSolidaireAjoutVirementVO() {
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
;function ListeReservationCommandeVO() {
	this.detailReservation = new Array();
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
	this.produitsSolidaire = new Array();
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
function CompteSolidaireSupprimerVirementVO() {
	this.id = '';
};function AdherentVO() {
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
function CompteSolidaireSupprimerVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
};function ExportBonReservationVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
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
function CompteSolidaireAjoutVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.montant = new VRelement();
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
	//this.pParam = new VRelement();
	//this.export_type = new VRelement();
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
}function CompteSolidaireModifierVirementVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.montant = new VRelement();
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
	this.id_compte_producteur = new VRelement();
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
	this.produitsSolidaire = new Array();
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
		if((isNaN(pData.quantite) || pData.quantite == 0 || pData.prix == '') && (!isNaN(pData.prix) && pData.prix != 0)) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_214_CODE;erreur.message = ERR_214_MSG;lVR.quantite.erreurs.push(erreur);}
		if(pData.quantite >= 0) {lVR.valid = false;lVR.quantite.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.quantite.erreurs.push(erreur);}
		
		if((isNaN(pData.prix) || pData.prix == 0 || pData.prix == '') && (!isNaN(pData.quantite) && pData.quantite != 0)) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_213_CODE;erreur.message = ERR_213_MSG;lVR.prix.erreurs.push(erreur);}
		if(pData.prix >= 0) {lVR.valid = false;lVR.prix.valid = false;var erreur = new VRerreur();erreur.code = ERR_215_CODE;erreur.message = ERR_215_MSG;lVR.prix.erreurs.push(erreur);}

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

};function ProduitsBonDeCommandeValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ProduitsBonDeCommandeVR();
		//Tests Techniques
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_compte_producteur.checkLength(0,11)) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_producteur.erreurs.push(erreur);}
		if(!pData.id_compte_producteur.isInt()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_producteur.erreurs.push(erreur);}
		if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!isArray(pData.produits)) {lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_115_CODE;erreur.message = ERR_115_MSG;lVR.log.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.id_compte_producteur.isEmpty()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_producteur.erreurs.push(erreur);}
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

	/*this.validDelete = function(pData) {
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
	}*/

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
	}
	
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
	}
	
	this.validDelete = function(pData) { 
		var lVR = new CompteSolidaireSupprimerVirementVR();
		//Tests Techniques
		if(!pData.id.checkLength(0,11)) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id.erreurs.push(erreur);}
		if(!pData.id.isInt()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id.erreurs.push(erreur);}

		//Tests Fonctionnels
		if(pData.id.isEmpty()) {lVR.valid = false;lVR.id.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id.erreurs.push(erreur);}

		return lVR;
	}
}
;function ProducteurValid() { 
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
		if(!pData.id_compte_producteur.checkLength(0,11)) {lVR.valid = false;lVR.id_compte_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_compte_producteur.erreurs.push(erreur);}
		if(!pData.id_compte_producteur.isInt()) {lVR.valid = false;lVR.id_compte_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_compte_producteur.erreurs.push(erreur);}
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
		if(pData.id_compte_producteur.isEmpty()) {lVR.valid = false;lVR.id_producteur.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_producteur.erreurs.push(erreur);}
		//if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
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
		if(pData.typePaiement.isEmpty() || pData.typePaiement == 0) {lVR.valid = false;lVR.typePaiement.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.typePaiement.erreurs.push(erreur);}
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
		//if(!pData.pParam.checkLength(0,1)) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pParam.erreurs.push(erreur);}
		//if(!pData.pParam.isInt()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.pParam.erreurs.push(erreur);}
		//if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		//if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}

		//Tests Fonctionnels
		//if(pData.pParam.isEmpty()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pParam.erreurs.push(erreur);}
		//if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}

		return lVR;
	}

	/*this.validDelete = function(pData) {
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
	}*/

};function ExportBonLivraisonValid() { 
	this.validAjout = function(pData) { 
		var lVR = new ExportBonLivraisonVR();
		//Tests Techniques
		//if(!pData.pParam.checkLength(0,1)) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.pParam.erreurs.push(erreur);}
		//if(!pData.pParam.isInt()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.pParam.erreurs.push(erreur);}
		//if(!pData.export_type.checkLength(0,1)) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.export_type.erreurs.push(erreur);}
		//if(!pData.export_type.isInt()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.export_type.erreurs.push(erreur);}
		if(!pData.id_commande.checkLength(0,11)) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.id_commande.isInt()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(!pData.format.checkLength(0,1)) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_101_CODE;erreur.message = ERR_101_MSG;lVR.format.erreurs.push(erreur);}
		if(!pData.format.isInt()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_108_CODE;erreur.message = ERR_108_MSG;lVR.format.erreurs.push(erreur);}

		//Tests Fonctionnels
		//if(pData.pParam.isEmpty()) {lVR.valid = false;lVR.pParam.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.pParam.erreurs.push(erreur);}
		//if(pData.export_type.isEmpty()) {lVR.valid = false;lVR.export_type.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.export_type.erreurs.push(erreur);}
		if(pData.id_commande.isEmpty()) {lVR.valid = false;lVR.id_commande.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.id_commande.erreurs.push(erreur);}
		if(pData.format.isEmpty()) {lVR.valid = false;lVR.format.valid = false;var erreur = new VRerreur();erreur.code = ERR_201_CODE;erreur.message = ERR_201_MSG;lVR.format.erreurs.push(erreur);}

		return lVR;
	}

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
	}

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

}/********** Début Variables Globales ************/
var TemplateData;
var Infobulle = {};
var gCommunVue = {};
/********** Fin Variables Globales ************/
$(document).ready(function() {	
	AccueilVue(); // Lancement de l'accueil
});;function MenuVue(pParam) {
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
			
			pData.find('#menu-RechargementCompte-RechargerCompte').click(function() {
				RechargerCompteVue();
				return false;
			});
			
			pData.find('#menu-GestionCaisse-GestionCaisse').click(function() {
				GestionCaisseVue();
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
		this.afficher();
	}
	
	this.afficher = function() {
		var that = this;
		var lIdentificationTemplate = new IdentificationTemplate();
		$('#contenu').replaceWith(that.affect($(lIdentificationTemplate.formulaireIdentification)));
	}
	
	this.affect = function(pData) {		
		pData = this.affectIdentifier(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectIdentifier = function(pData) {
		var that = this;
		pData.find('#identification-form').submit(function() {
			that.identifier($(this));
			return false;
		});
		return pData;
	}
	
	this.identifier = function(pObj) {
		var lVo = new IdentificationVO();
		lVo = {"login":pObj.find(':input[name=login]').val(),"pass":pObj.find(':input[name=pass]').val()};
		
		var lValid = new IdentificationValid();
		var lVr = lValid.validAjout(lVo);

		Infobulle.init(); // Supprime les erreurs
		if (lVr.valid) {	
			var that = this;
			$.post(	"./index.php?m=Identification&v=Identification", "pParam=" + $.toJSON(lVo),
					function(lResponse) {
					  	Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							var lNbModule = lResponse.modules.length;
							var lI = 0;
							for( i in lResponse.modules) {
								lI++;
								if(lI == lNbModule) {
									$.getScript("./js/package/zeybux-" + lResponse.modules[i] + "-min.js",
											function() {that.lancement(lResponse.type);});
								} else {
									$.getScript("./js/package/zeybux-" + lResponse.modules[i] + "-min.js");
								}
							}
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			Infobulle.generer(lVr);
		}		
	}
	
	this.lancement = function(pType) {
		switch(pType) {
			case '1':
				MenuVue();
				MonCompteVue();
			break;
			
			case '2':
				MenuVue();
				AdministrationVue();
			break;
			
			case '3':
				MenuVue();
				CaisseListeCommandeVue();
			break;
			
			case '4':
				MenuVue();
				CompteSolidaireVue();
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
	}
	
	this.construct(pParam);
};function AccueilVue(pParam) {
	this.construct = function(pParam) {
		if(pParam && pParam.vr) {
			Infobulle.generer(pParam.vr,'');
		}
		this.afficher();
	}	
	
	this.afficher = function() {
		if($.browser.msie) {
			var lIdentificationTemplate = new IdentificationTemplate();
			$('#contenu').replaceWith(lIdentificationTemplate.naviguateurIncompatible);
		} else {
			var that = this;
			$.getScript("./js/zeybux-configuration-min.js",function() {
				that.init();
				IdentificationVue();
			});
		}		
	}
	
	this.init = function() {
		this.initObj();
		this.initAction();
	}
	
	this.initObj = function() {
		// Initialisation des objets globaux
		TemplateData = new TemplateData();
		Infobulle = new Infobulles();
		gCommunVue = new CommunVue(); // TODO Renommer en CommunVue et utiliser cette classe dans toutes les vues
	}
	
	this.initAction = function() {
		// Affichage des infobulles pour les erreurs	
		$("#widget_message_information").click(function() {$(this).delay(gTempsTransition).fadeOut(gTempsTransitionUnique);});		
		$("#loading").ajaxStart( function() {$(this).fadeIn(gTempsTransition)} );
		$("#loading").ajaxStop( function() {$(this).fadeOut(gTempsTransition);} );		
	}
	
	this.construct(pParam);
}