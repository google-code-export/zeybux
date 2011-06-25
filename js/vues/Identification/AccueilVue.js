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
			IdentificationVue();
		}		
	}
	
	this.construct(pParam);
}