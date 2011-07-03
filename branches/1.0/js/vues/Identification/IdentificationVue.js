;function IdentificationVue(pParam) {

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