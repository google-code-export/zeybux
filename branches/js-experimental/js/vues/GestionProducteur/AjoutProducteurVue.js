;function AjoutProducteurVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {	
		$.history( {'vue':function() {AjoutProducteurVue(pParam);}} );
		if(pParam && pParam.vr) {
			Infobulle.generer(pParam.vr,'');
		}
		this.afficher();
	}
	
	this.afficher = function() {
		var that = this;			
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lTemplate = lGestionProducteurTemplate.formulaireAjoutProducteur;
		$('#contenu').replaceWith(that.affect($(lTemplate.template())));
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
				pData.find(":input[name=numero_compte]").attr("disabled","disabled").val("");				
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
			that.ajoutProducteur();
			return false;
		});
		return pData;
	}
	
	this.ajoutProducteur = function() {
		var lVo = new ProducteurVO();
		
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
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout du Producteur
			$.post(	"./index.php?m=GestionProducteur&v=AjoutProducteur", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionProducteurTemplate = new GestionProducteurTemplate();
						var lTemplate = lGestionProducteurTemplate.ajoutProducteurSucces;
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