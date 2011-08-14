;function MenuVue(pParam) {
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
}