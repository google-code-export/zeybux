;function ModificationProducteurVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdProducteur = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ModificationProducteurVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=ModificationProducteur", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mIdProducteur = pParam.id_producteur;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function(lResponse) {
		var that = this;
		lResponse.dateNaissance = lResponse.dateNaissance.extractDbDate().dateDbToFr();	
		
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lTemplate = lGestionProducteurTemplate.formulaireAjoutProducteur;
		var lHtml = lTemplate.template(lResponse);
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
	}
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.boutonLienCompte = function(pData) {		
		pData.find(":input[name=lien_numero_compte]").click(function() {
			if(pData.find(":input[name=numero_compte]").attr("disabled")) {
				pData.find(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				pData.find(":input[name=numero_compte]").attr("disabled","disabled");				
			}			
		});
		return pData;
	}	
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comDatepicker('dateNaissance',pData);
		return pData;
	}
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.modifProducteur();
			return false;
		});
		return pData;
	}
	
	this.modifProducteur = function() {
		var lVo = new ProducteurVO();
		lVo.id = this.mIdProducteur;
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.compte = $(':input[name=numero_compte]').val();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'Producteur
			$.post(	"./index.php?m=GestionProducteur&v=ModificationProducteur", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionProducteurTemplate = new GestionProducteurTemplate();
						var lTemplate = lGestionProducteurTemplate.modifierProducteurSucces;
						$('#contenu').replaceWith(lTemplate.template(lResponse));						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
}