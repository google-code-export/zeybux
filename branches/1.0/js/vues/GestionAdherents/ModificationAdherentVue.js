;function ModificationAdherentVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdAdherent = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mIdAdherent = pParam.id_adherent;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function(lResponse) {
		var that = this;
		var lData = lResponse;
		var lModules_default= [], lModules = [];
		$(lResponse.modules).each(function() {
			if(this.defaut == 1) {
				lModules_default.push(this);
			} else {
				lModules.push(this);
			}
		});
		lData.modules_default = lModules_default;
		lData.modules = lModules;
		
		lData.dateAdhesion = lResponse.dateAdhesion.extractDbDate().dateDbToFr();
		lData.dateNaissance = lResponse.dateNaissance.extractDbDate().dateDbToFr();
		
		$(lResponse.autorisations).each(function() {
			var lIdModule = this.idModule;
			$(lData.modules).each(function() {
				if(this.id == lIdModule) {
					this.checked = "checked=\"checked\"";
				}
			});
		});		
		
		var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
		var lTemplate = lGestionAdherentsTemplate.formulaireAjoutAdherent;
		//var lHtml = lTemplate.template(lResponse);
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));
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
		pData = this.mCommunVue.comLienDatepicker('dateNaissance','dateAdhesion',pData);
		return pData;
	}
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.modifAdherent();
			return false;
		});
		return pData;
	}
	
	this.modifAdherent = function() {
		var lVo = new AdherentVO();
		lVo.id = this.mIdAdherent;
		lVo.motPasse = $(':input[name=pass]').val();
		lVo.motPasseConfirm = $(':input[name=pass_confirm]').val();
		lVo.compte = $(':input[name=numero_compte]').val();
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();
		$(':input[name=modules[]]:checked').each(function() {lVo.modules.push($(this).val())});
		$(':input[name=modules_default[]]').each(function() {lVo.modules.push($(this).val())});

		var lValid = new AdherentValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'adherent
			$.post(	"./index.php?m=GestionAdherents&v=ModificationAdherent", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionAdherentsTemplate = new GestionAdherentsTemplate();
						var lTemplate = lGestionAdherentsTemplate.modifierAdherentSucces;
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