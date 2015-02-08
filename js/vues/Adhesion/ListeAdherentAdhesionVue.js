;function ListeAdherentAdhesionVue(pParam) {
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeAdherentAdhesionVue(pParam);}} );
		var that = this;
		var lVo = {fonction:"listeAdherent"};
		$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lVo),
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
		var lAdhesionTemplate = new AdhesionTemplate();		
		if(lResponse.listeAdherent.length == 0 || lResponse.listeAdherent[0].adhId == null) {
			lResponse.titreAdherent = lAdhesionTemplate.titreAdherentVide;
			lResponse.listeAdherent = [];
		} else if(lResponse.listeAdherent.length == 1) {
			lResponse.titreAdherent = lAdhesionTemplate.titreAdherentSingulier;
		} else {
			lResponse.titreAdherent = lAdhesionTemplate.titreAdherentPluriel;
		}
		$('#contenu').replaceWith(that.affect($(lAdhesionTemplate.listeAdherent.template(lResponse))));
	};
	
	this.affect = function(pData) {
		pData = this.affectDetailAdhesion(pData);
		pData = gCommunVue.comHoverBtn(pData); 
		pData = this.affectDataTable(pData);
		return pData;
	};
	
	this.affectDataTable = function(pData) {
		pData.find('#liste-adherent').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	//        "iDisplayLength": 25,
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
	
	this.affectDetailAdhesion = function(pData) {
		pData.find('.detail-adhesion-adherent').click(function() {
			DetailAdhesionAdherentVue({'idAdherent': $(this).data('id-adherent')});
		});
		return pData;		
	};
	
	this.construct(pParam);
};