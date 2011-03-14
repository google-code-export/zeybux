/********** Début Variables Globales ************/
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

});