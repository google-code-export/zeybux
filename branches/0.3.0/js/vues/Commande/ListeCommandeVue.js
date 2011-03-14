;function ListeCommandeVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=Commande&v=ListeCommande", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
						// Maj du Menu
						var lCommunVue = new CommunVue();
						lCommunVue.majMenu('Commande','ListeCommande');
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		Infobulle.init(); // Supprime les erreurs
		// Test si la liste est vide
		if(lResponse.listeCommande[0] && lResponse.listeCommande[0].comDateFinReservation != null) {
			var that = this;
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = new Object();
					lCommande.id = this.comId;
					lCommande.numero = this.comNumero;
					lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
						
					lListeCommande.commande.push(lCommande);
				});
			
			var lCommandeTemplate = new CommandeTemplate();
			var lTemplate = lCommandeTemplate.listeCommandePage;
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeCommande))));	
		} else {
			var lCommandeTemplate = new CommandeTemplate();
			$('#contenu').replaceWith(lCommandeTemplate.listeCommandeVide);
		}
	}
	this.affect = function(pData) {
		pData = this.affectBtnCommander(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	this.affectBtnCommander = function(pData) {
		pData.find('.btn-commander').click(function() {
			var lParam = {id_commande:$(this).attr('id')};
			ReservationCommandeVue(lParam);
		});
		return pData;
	}
		
	this.construct(pParam);
}