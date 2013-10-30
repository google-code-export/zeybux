;function GestionCaisseTemplate() {
	this.etatCaisseDebut = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">État de la caisse</div>" +
					"<div class=\"com-center\">La caisse est " ;
	
	this.etatCaisseMilieu = 			
					" : <button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-caisse\">" ;
					
	this.etatCaisseFin = "</button></div>" +
				"</div>" +	
			"</div>" +	
		"</div>";
	
	this.caisseOuverte = "ouverte";
	this.caisseFermee = "fermée";
	this.boutonOuverture = "Ouvrir";
	this.boutonFermeture = "Fermer";
}