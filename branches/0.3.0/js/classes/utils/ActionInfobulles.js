;function ActionInfobulles() {
	this.affect = function(pHtml,pCode) {
		switch(pCode) {
			case 116:
				var that = this;
				pHtml.find('#action-ifb-116').click(function(){

					var lCommandeTemplate = new IdentificationTemplate();
					var lTemplate = lCommandeTemplate.connexion;
					var lDialog = $(lTemplate).dialog({
						autoOpen: true,
						modal: true,
						draggable: false,
						resizable: false,
						width:370,
						buttons: {
							'Connexion': function() {
								that.identifier($(this));
							}
						},
						close: function(ev, ui) { $(this).remove(); }
					});
					lDialog.find('input').keyup(function(event) {
						if (event.keyCode == '13') {
							that.identifier(lDialog);
						}
					});
				});
			break;
		}
		return pHtml;
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
							// Message d'information de la bonne suppression
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_305_CODE;
							erreur.message = ERR_305_MSG;
							lVr.log.erreurs.push(erreur);
							Infobulle.generer(lVr,'');
							
							$(pObj).dialog("close");
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			Infobulle.generer(lVr);
		}
	}
}