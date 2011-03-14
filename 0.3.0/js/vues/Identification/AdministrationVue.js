;function AdministrationVue(pParam) {
	
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
}	