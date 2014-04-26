;function MenuVue(pParam) {
	//this.mMenuTemplate = new IdentificationTemplate();

	this.construct = function(pParam) {		
		var that = this;	
		$.post(	"./index.php?m=Identification&v=Menu", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
				  	if(lResponse) {
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse, pParam);
						} else {
							Infobulle.generer(lResponse,'');
						}
				  	}
				},"json"
		);
	};
	
	this.afficher = function(pMenu, pParam) {
		var that = this;
		var lIdentificationTemplate = new IdentificationTemplate();
				
		$('#menu_int').replaceWith($(that.genererMenu(pMenu.menu)));
		$('#site').append(that.affectButton($(lIdentificationTemplate.deconnexion)));
		if(pMenu.admin){
			$('#site').append(that.affectAdministration($(lIdentificationTemplate.administration)));
		}
		
		pParam.homePage();
	};
	
	this.affectButton = function(pData) {

		/*pData = gCommunVue.comHoverBtn(pData);
		return pData;*/
		return $(pData).hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
	};
		
	this.genererMenu = function(pMenu) {
		var lIdentificationTemplate = new IdentificationTemplate();
		
		var lMenu = lIdentificationTemplate.debutMenu;
		lMenu += lIdentificationTemplate.module.template(pMenu); //this.genererModule(pMenu);
		lMenu += lIdentificationTemplate.finMenu;
		
		lMenu = $(lMenu);
		
		lMenu.find('.menu-lien').first().addClass("ui-corner-tl");
		lMenu.find('.menu-lien').last().addClass("ui-corner-br");
		lMenu.find('.menu-lien').hover(function() {
			lMenu.find('.menu-lien').removeClass("ui-state-hover");
			$(this).addClass("ui-state-hover");
		},function() {lMenu.find('.menu-lien').removeClass("ui-state-hover");});
		
		lMenu = this.affectVues(lMenu);
		return lMenu;
	};
		
	this.affectAdministration = function(pData) {
		pData.click(function() {
			AdministrationVue();
		});
		pData = this.affectButton(pData);
		return pData;
	};
		
	this.affectVues = function(pData) {
		if(pData) {
			
			pData.find('#menu-MonCompte-MonCompte').click(function() {
				MonCompteVue();
				return false;
			});			
			
			pData.find('#menu-Commande-MesAchats').click(function() {
				MesAchatsVue();
				return false;
			});
			
			pData.find('#menu-Commande-MonMarche').click(function() {
				MonMarcheVue();
				return false;
			});
			
			pData.find('#menu-Caisse-CaisseListeMarche').click(function() {
				CaisseListeCommandeVue();
				return false;
			});
			
			pData.find('#menu-Caisse-PaiementCaisse').click(function() {
				PaiementCaisseVue();
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
	};
	
	this.construct(pParam);
}