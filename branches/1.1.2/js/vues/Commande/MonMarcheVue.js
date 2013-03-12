;function MonMarcheVue(pParam) {
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {MonMarcheVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=Commande&v=MonMarche", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
							// Maj du Menu
							gCommunVue.majMenu('Commande','MonMarche');
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;
		
		var lCommandeTemplate = new CommandeTemplate();
		var lHtml = lCommandeTemplate.MonMarcheDebut;
				
		// Test si la liste est vide
		if(lResponse.marches[0] && lResponse.marches[0].dateFinReservation != null) {
			var lMarches = new Object;
			lMarches.marche = new Array();
			
				$(lResponse.marches).each(function() {
					var lmarche = new Object();
					lmarche.id = this.id;
					lmarche.nom = this.nom;
					lmarche.numero = this.numero;
					
					lmarche.jourFinReservation = jourSem(this.dateFinReservation.extractDbDate());
					
					lmarche.dateFinReservation = this.dateFinReservation.extractDbDate().dateDbToFr();
					lmarche.heureFinReservation = this.dateFinReservation.extractDbHeure();
					lmarche.minuteFinReservation = this.dateFinReservation.extractDbMinute();
					

					lmarche.jourMarcheDebut = jourSem(this.dateMarcheDebut.extractDbDate());
					
					lmarche.dateMarcheDebut = this.dateMarcheDebut.extractDbDate().dateDbToFr();
					lmarche.heureMarcheDebut = this.dateMarcheDebut.extractDbHeure();
					lmarche.minuteMarcheDebut = this.dateMarcheDebut.extractDbMinute();
					
					lmarche.heureMarcheFin = this.dateMarcheFin.extractDbHeure();
					lmarche.minuteMarcheFin = this.dateMarcheFin.extractDbMinute();
						
					lMarches.marche.push(lmarche);
				});
			lHtml += lCommandeTemplate.listeMarche.template(lMarches);	
		} else {
			lHtml += lCommandeTemplate.listeMarcheVide;
		}
		lHtml += lCommandeTemplate.MonMarcheFin;
		$('#contenu').replaceWith(that.affect($(lHtml)));
	};
	
	this.affect = function(pData) {
		pData = this.affectBtnCommander(pData);
		pData = this.affectVisualiser(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectBtnCommander = function(pData) {
		pData.find('.btn-commander').click(function() {
			var lParam = {id_commande:$(this).attr('id')};
			ReservationMarcheVue(lParam);
		});
		return pData;
	};
	
	this.affectVisualiser = function(pData) {
		pData.find('.visualiser-reservation').click(function() {
				AfficherReservationVue({id_commande:$(this).attr('id')});
			});		
		return pData;
	};
		
	this.construct(pParam);
}