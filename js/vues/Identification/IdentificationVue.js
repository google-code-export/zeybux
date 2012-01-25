;function IdentificationVue(pParam) {
	this.mType = 0;
	this.mModules = [];
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
		lVo = {fonction:"identifier","login":pObj.find(':input[name=login]').val(),"pass":pObj.find(':input[name=pass]').val()};
		
		var lValid = new IdentificationValid();
		var lVr = lValid.validAjout(lVo);

		Infobulle.init(); // Supprime les erreurs
		if (lVr.valid) {	
			var that = this;
			$.post(	"./index.php?m=Identification&v=Identification", "pParam=" + $.toJSON(lVo),
					function(lResponse) {
					  	Infobulle.init(); // Supprime les erreurs
					  	if(lResponse) {
							if(lResponse.valid) {
								that.mType = lResponse.type;
								that.mModules = lResponse.modules;
								gIdConnexion = lResponse.idConnexion;
								var lIdentificationTemplate = new IdentificationTemplate();
								$('#contenu').replaceWith(that.affectChargement($(lIdentificationTemplate.chargementModule)));
								that.chargerModule(0);
							} else {
								Infobulle.generer(lResponse,'');
							}
					  	}
					},"json"
			);
		} else {
			Infobulle.generer(lVr);
		}		
	}
	
	this.affectChargement = function(pData) {
		pData.find('#chargement-module-progressbar').progressbar({value:1});
		return pData;
	}
	
	// Charge les modules les uns après les autres puis lance la page d'acceuil après le dernier chargement
	this.chargerModule = function(pPosition) {
		if(this.mModules[pPosition]) {
			var that = this;
			var lNvPosition = pPosition + 1;
			if(this.mModules.length == lNvPosition) { // Si c'est le dernier module on lance la première page
				var lNiveau = parseFloat(lNvPosition) / parseFloat(this.mModules.length) * 100;
				$("#chargement-module-progressbar").progressbar({value:lNiveau});
				$.getScript("./js/package/zeybux-" + that.mModules[pPosition] + ".php",function() {that.initAction();});
			} else {
				var lNiveau = parseFloat(lNvPosition) / parseFloat(this.mModules.length) * 100;
				$("#chargement-module-progressbar").progressbar({value:lNiveau});
				$.getScript("./js/package/zeybux-" + that.mModules[pPosition] + ".php",function() {that.chargerModule(lNvPosition);});
			}			
		}		
	}
	
	this.initAction = function() {
		// Affichage des infobulles pour les erreurs	
		if (!$.browser.webkit) { // Uniquement si ce n'est pas chrome
			$("#loading").ajaxStart( function() {$(this).fadeIn(gTempsTransition);} );
			$("#loading").ajaxStop( function() {$(this).fadeOut(gTempsTransition);} );
		}
		
		var that = this;
		// Gestion du F5
		// Bloque le fonctionnement du F5
		$(document).bind('keypress keydown keyup', function(e) {
		    if(e.charCode === 0 && (e.keyCode === 116 || (e.which === 82 && e.ctrlKey))) {
		       return false;
		    }
		});
		// Recharge la page
		$(document).keyup(function(e) {
		    if(e.charCode === 0 && (e.which === 116 || (e.which === 82 && e.ctrlKey))) {
		    	var cursor = $(".__historyFrame").contents().attr( $.browser.msie ? 'URL' : 'location' ).toString().split('#')[1];
				// set the history cursor to the current cursor
				$.history.cursor = parseFloat(cursor) || 0;
				// reinstate the current cursor data through the callback
				if ( typeof($.history.callback) == 'function' ) {
					// prevent the callback from re-inserting same history element
					$.history._locked = true;
					$.history.callback( $.history.stack[ cursor ], cursor );
					$.history._locked = false;
				}
			}
		});

		// Confirmation de sortie du zeybux
		$(window).bind('beforeunload', function() {
		    return "";
		});

		this.lancement();
	}
		
	this.lancement = function() {
		switch(this.mType) {
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
}