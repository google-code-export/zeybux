;function IdentificationVue(pParam) {

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
});