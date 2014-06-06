;function ParametreZeybuxVue(pParam) {
	this.mParam = {};
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ParametreZeybuxVue(pParam);}} );
		var that = this;
		this.mParam = $.extend(this.mParam, pParam);
		this.mParam.fonction = "detail";
		$.post(	"./index.php?m=Parametrage&v=ParametreZeybux", "pParam=" + $.toJSON(this.mParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;		
		var lParametrageTemplate = new ParametrageTemplate();
		$('#contenu').replaceWith(that.affect($(lParametrageTemplate.formParametreZeybux.template(lResponse.liste))));
	};
	
	this.affect = function(pData) {
		pData = this.affectModifier(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find('form').submit(function() {
			var lVo = new ParametreZeybuxVO();						
			lVo.mailSupport = $(this).find(':input[name="mailSupport"]').val();
			lVo.mailMailingListe = $(this).find(':input[name="mailMailingListe"]').val();
			lVo.mailMailingListeDomaine = $(this).find(':input[name="mailMailingListeDomaine"]').val();
			lVo.adresseWSDL = $(this).find(':input[name="adresseWSDL"]').val();
			lVo.sOAPLogin = $(this).find(':input[name="sOAPLogin"]').val();
			lVo.sOAPPass = $(this).find(':input[name="sOAPPass"]').val();
			lVo.zeybuxTitre = $(this).find(':input[name="zeybuxTitre"]').val();
			lVo.zeybuxAdresse = $(this).find(':input[name="zeybuxAdresse"]').val();
			lVo.propNom = $(this).find(':input[name="propNom"]').val();
			lVo.propAdresse = $(this).find(':input[name="propAdresse"]').val();
			lVo.propCP = $(this).find(':input[name="propCP"]').val();
			lVo.propVille = $(this).find(':input[name="propVille"]').val();
			lVo.propTel = $(this).find(':input[name="propTel"]').val();
			lVo.propMail = $(this).find(':input[name="propMail"]').val();
			lVo.propRespMarcheNom = $(this).find(':input[name="propRespMarcheNom"]').val();
			lVo.propRespMarchePrenom = $(this).find(':input[name="propRespMarchePrenom"]').val();
			lVo.propRespMarchePoste = $(this).find(':input[name="propRespMarchePoste"]').val();
			lVo.propRespMarcheTel = $(this).find(':input[name="propRespMarcheTel"]').val();
						
			var lValid = new ParametreZeybuxValid();
			var lVr = lValid.validUpdate(lVo);
			
			if(lVr.valid) {	
				Infobulle.init();
				lVo.fonction = "modifier";
				// Modification
				$.post(	"./index.php?m=Parametrage&v=ParametreZeybux", "pParam=" + $.toJSON(lVo),
					function (lResponse) {		
						if(lResponse) {
							if(lResponse.valid) {
								Infobulle.init(); // Supprime les erreurs
															
								// Message d'information
								var lVr = new TemplateVR();
								lVr.valid = false;
								lVr.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_301_CODE;
								erreur.message = ERR_301_MSG;
								lVr.log.erreurs.push(erreur);
								Infobulle.generer({vr:lVr},'');
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);
			} else {
				Infobulle.generer(lVr,'');
			}
			return false;
		});
		
		return pData;
	};
			
	this.construct(pParam);
}