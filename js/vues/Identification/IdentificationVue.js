;function IdentificationVue(pParam) {

	this.construct = function(pParam) {	
		if(pParam && pParam.vr) {
			Infobulle.generer(pParam.vr,'');
		}	
		//this.affect();
		this.afficher();
	}
	
	this.afficher = function() {
		var that = this;
		var lIdentificationTemplate = new IdentificationTemplate();
		$('#contenu').replaceWith(that.affect($(lIdentificationTemplate.formulaireIdentification)));
	}
	
	this.affect = function(pData) {		
		pData = this.affectIdentifier(pData);
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
			$.post(	"./index.php?m=Identification&v=Identification", "pParam=" + $.toJSON(lVo),
					function(lResponse) {
					  	Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							// TODO charger les modules
							switch(lResponse.type) {
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
	
	this.construct(pParam);
}