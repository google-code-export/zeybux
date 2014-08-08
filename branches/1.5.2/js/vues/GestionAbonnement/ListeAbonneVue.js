;function ListeAbonneVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeAbonneVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"afficher"};
		lParam = $.extend(lParam,pParam);
		$.post(	"./index.php?m=GestionAbonnement&v=ListeAbonne", "pParam=" + $.toJSON(lParam),
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
		var lGestionAbonnementTemplate = new GestionAbonnementTemplate();		
		if(!(lResponse.listeAdherent.length > 0 && lResponse.listeAdherent[0].adhId != null)) {
			lResponse.listeAdherent = [];
		}		
		$('#contenu').replaceWith(that.affect($(lGestionAbonnementTemplate.listeAdherent.template(lResponse))));
	};
	
	this.affect = function(pData) {
		pData = this.affectLienCompte(pData);
		pData = gCommunVue.comHoverBtn(pData); 
		pData = this.affectDataTable(pData);
		return pData;
	};
	
	
	this.affectDataTable = function(pData) {
		pData.find('#liste-adherent').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 25,
	        "aaSorting": [[2,'asc'], [3,'asc']],
	        "aoColumnDefs": [
                  { "bSortable": false, 
                	"bSearchable":false,
                	"aTargets": [ 4 ] 
                  },
                  {	 "sType": "numeric",
                	 "mRender": function ( data, type, full ) {
                		  	if (type === 'sort') {
                	          return data.replace("Z","");
                	        }
                	        return data;
                	      },
                	"aTargets": [ 0 ]
                  },
                  {	 "sType": "numeric",
                    	 "mRender": function ( data, type, full ) {
                    		  	if (type === 'sort') {
                    	          return data.replace("C","");
                    	        }
                    	        return data;
                    	      },
                    "aTargets": [ 1 ]
                  }]
	    });
		return pData;		
	};
			
	this.affectLienCompte = function(pData) {
		pData.find(".compte-ligne").click(function() {
			DetailAbonneAbonnementVue({id: $(this).attr("id-adherent")});
		});
		return pData;
	};
	
	this.construct(pParam);
}