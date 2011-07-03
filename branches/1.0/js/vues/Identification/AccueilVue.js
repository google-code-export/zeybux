;function AccueilVue(pParam) {
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
			$.getScript("./js/zeybux-configuration.php",function() {
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