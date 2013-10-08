;function CaisseMarcheCommandeVue(pParam) {
	this.idCommande = null;
	
	this.construct = function(pParam) {
		var that = this;
		if(pParam && pParam.id_commande) {
			if(pParam.id_commande == -1) { // Pour la caisse permanente
				pParam.fonction = "listeAdherent";
			} else {
				pParam.fonction = "listeReservation";
			}
		
			$.history( {'vue':function() {CaisseMarcheCommandeVue(pParam);}} );
			$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(pParam),
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
			this.idCommande = pParam.id_commande;
		}
	};	
	
	this.afficher = function(pResponse) {
		if(pResponse.listeAdherentCommande) {
			var that = this;
			var lCaisseTemplate = new CaisseTemplate();
			
			if(this.idCommande == -1) { // Pour la caisse permanente
				pResponse.venteTitre = lCaisseTemplate.listeAdherentVenteTitre;
			} else {
				pResponse.venteTitre = lCaisseTemplate.listeAdherentVenteMarcheTitre.template(pResponse);
			}
			
			if(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null) {
				pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
				
				$.each(pResponse.listeAdherentCommande,function() {
					this.adhIdTri = this.adhNumero.replace("Z","");
					this.cptIdTri = this.cptLabel.replace("C","");
				});
				
				$('#contenu').replaceWith(that.affect($(lCaisseTemplate.listeAdherentCommandePage.template(pResponse))));
			} else {
				$('#contenu').replaceWith(lCaisseTemplate.listeMarcheVide);
			}
		} else {
			var lVr = new TemplateVR();
			lVr.valid = false;
			lVr.log.valid = false;				
			var erreur = new VRerreur();
			erreur.code = ERR_211_CODE;
			erreur.message = ERR_211_MSG;
			lVr.log.push(erreur);
			Infobulle.generer(lVr,'');
		}
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienAchat(pData);
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.find('#liste-adherent').tablesorter({sortList: [[2,0]],headers: { 4: {sorter: false} } });
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('#liste-adherent'), this.value );
		  });
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	};
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lParam = {	id_commande:that.idCommande,
							id_adherent:$(this).attr("id-adherent"),
							module:'Caisse'};
			CaisseVue(lParam);
		});
		return pData;
	};
	
	this.construct(pParam);
}