;function StockProduitListeFermeVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {StockProduitListeFermeVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"ListeFerme"};
		$.post(	"./index.php?m=GestionCommande&v=StockProduit", "pParam=" + $.toJSON(lParam),
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
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		
		if(lResponse.listeFerme.length > 0 && lResponse.listeFerme[0].ferId != null) {
			var lTemplate = lGestionCommandeTemplate.listeFerme;
			$.each(lResponse.listeFerme,function() {
				this.ferIdTri = this.ferNumero.replace("F","");
			});
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionCommandeTemplate.listeFermeVide)));
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectDetailFerme(pData);		
		pData = gCommunVue.comHoverBtn(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]]});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	};
			
	this.affectDetailFerme = function(pData) {
		pData.find(".compte-ligne").click(function() {
			StockProduitVue({idCompte:$(this).data('id-compte-ferme')});
		});
		return pData;
	};
		
	this.construct(pParam);
};