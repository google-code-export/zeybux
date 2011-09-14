;function ListeReservationVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeReservationVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=Commande&v=ListeReservation", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
						// Maj du Menu
						var lCommunVue = new CommunVue();
						lCommunVue.majMenu('Commande','MesCommandes');
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lListeReservation = new Object;
		lListeReservation.reservation = new Array();
		
		// Transforme les dates pour l'affichage
			$(lResponse.reservations).each(function() {
				if(this.comNumero != null) {
					var lReservation = new Object();
					lReservation.numero = this.comNumero;
										
					lReservation.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lReservation.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lReservation.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lReservation.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lReservation.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lReservation.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lReservation.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lReservation.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
					
					lReservation.idCommande = '"' + this.comId + '"';
	
					lListeReservation.reservation.push(lReservation);
				}
			});
			
		var lCommandeTemplate = new CommandeTemplate();
		// Affiche la liste ou un message si celle-ci est vide
		if(lListeReservation.reservation.length > 0) {			
			var lTemplate = lCommandeTemplate.listeReservation;			
		} else {
			var lTemplate = lCommandeTemplate.listeReservationVide;
		}
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeReservation))));		
	}
	
	this.affect = function(pData) {
		pData = this.affectVisualiser(pData);
		return pData;
	}
	
	this.affectVisualiser = function(pData) {
		pData.find('.visualiser-reservation').click(function() {
				AfficherReservationVue({id_commande:$(this).attr('id')});
			});		
		return pData;
	}
	
	this.construct(pParam);
}