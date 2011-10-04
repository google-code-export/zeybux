;function ListeProducteurVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeProducteurVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", 
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
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		
		if(lResponse.listeProducteur.length > 0 && lResponse.listeProducteur[0].prdtId != null) {
			var lTemplate = lGestionProducteurTemplate.listeProducteur;
						
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(lGestionProducteurTemplate.listeProducteurVide);
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]]});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}
			
	this.affectLienCompte = function(pData) {
		var that = this;
		pData.find(".compte-ligne").click(function() {
			CompteProducteurVue({id_producteur: $(this).find(".id-producteur").text()});
		});
		return pData;
	}
	
	this.construct(pParam);
}