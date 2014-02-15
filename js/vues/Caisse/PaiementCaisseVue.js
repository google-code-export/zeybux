;function PaiementCaisseVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {PaiementCaisseVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=Caisse&v=PaiementCaisse", "pParam=" + $.toJSON({fonction:'listeMarche'}),
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
		var lCaisseTemplate = new CaisseTemplate();
		if(lResponse.listeCommande.length > 0 && lResponse.listeCommande[0].id != null) {
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = {};
					lCommande.id = this.id;
					lCommande.numero = this.numero;
					lCommande.nom = this.nom;

					lCommande.jourFinReservation = jourSem(this.dateFinReservation.extractDbDate());
					lCommande.dateFinReservation = this.dateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.dateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.dateFinReservation.extractDbMinute();
					

					lCommande.jourMarcheDebut = jourSem(this.dateMarcheDebut.extractDbDate());
					lCommande.dateMarcheDebut = this.dateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.dateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.dateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.dateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.dateMarcheFin.extractDbMinute();
	
					lListeCommande.commande.push(lCommande);
				});
			$('#contenu').replaceWith(that.affect($(lCaisseTemplate.listeCommandePage.template(lListeCommande))));
		} else {
			$('#contenu').replaceWith(that.affect($(lCaisseTemplate.listeCommandeVide)));
		}

	};
	
	this.affect = function(pData) {
		pData = this.affectLienMarche(pData);
		pData = this.gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectLienMarche = function(pData) {
		pData.find(".btn-marche").click(function() {
			PaiementCaisseDetailVue({"id":$(this).attr('id')});
		});
		return pData;
	};
	this.construct(pParam);
};