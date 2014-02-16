;function PaiementCaisseDetailVue(pParam) {	
	this.mSelectedTabs = 0;
	this.mIdMarche = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {PaiementCaisseDetailVue(pParam);}} );
		var that = this;	
		this.mIdMarche = pParam.id;
		pParam.fonction = "listePaiement";
		$.post(	"./index.php?m=Caisse&v=PaiementCaisse", "pParam=" + $.toJSON(pParam),
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
		var lTotalEspece = 0;
		$.each(lResponse.listeEspece,function() {
			if(this.opeId) {
				lTotalEspece = (parseFloat(lTotalEspece) + parseFloat(this.opeMontant)).toFixed(2);
			}
		});
		
		var lTotalCheque = 0;
		$.each(lResponse.listeCheque,function() {
			if(this.opeId) {
				lTotalCheque = (parseFloat(lTotalCheque) + parseFloat(this.opeMontant)).toFixed(2);
				this.numeroCheque ='';
				if(this.opeTypePaiementChampComplementaire[3]) {
					this.numeroCheque = this.opeTypePaiementChampComplementaire[3].valeur; 
				}
			}
		});
		
		if(lResponse.listeEspece.length == 0 || (lResponse.listeEspece[0] && lResponse.listeEspece[0].adhId == null)) {
			lResponse.listeEspece = [];
		}
		if(lResponse.listeCheque.length == 0 || (lResponse.listeCheque[0] && lResponse.listeCheque[0].adhId == null)) {
			lResponse.listeCheque = [];
		}

		lResponse.sigleMonetaire = gSigleMonetaire;
		lResponse.totalEspece = lTotalEspece.nombreFormate(2,',',' ');
		lResponse.totalCheque = lTotalCheque.nombreFormate(2,',',' ');
		
		var lCaisseTemplate = new CaisseTemplate();		
		$('#contenu').replaceWith(that.affect($(lCaisseTemplate.listePaiement.template(lResponse))));
	};
	
	this.affect = function(pData) {
		pData = this.affectLienRetour(pData);
		pData = this.affectExport(pData);
		pData = this.affectTabs(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectDataTable(pData);
		return pData;
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#lien-retour").click(function() { PaiementCaisseVue(); });
		return pData;
	};
	
	this.affectExport = function(pData) {
		var that = this;
		pData.find('#btn-export-liste-operation').click(function() {
			// Export selon l'onglet sélectionné
			var lType = 0;
			if(that.mSelectedTabs == 0) {
				lType = 2;
			} else {
				lType = 1;
			}
			$.download("./index.php?m=Caisse&v=PaiementCaisse", {fonction:'export',id:that.mIdMarche,type:lType});
		});
		return pData;
	};
	
	this.affectTabs = function(pData) {
		var that = this;
		pData.find( "#listePaiement" ).tabs();
		pData.find("#li-cheque,#li-espece").click(
				function() {that.mSelectedTabs = $("#listePaiement").tabs("option","active");});
		return pData;
	};
	
	this.affectDataTable = function(pData) {
		pData.find('#table-cheque').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 25,
	        "aaSorting": [[0,'asc']],
	        "aoColumnDefs": [
	             {"sType": "date",
                  "mRender": function ( data, type, full ) {
                	  return data.extractDbDate().dateDbToFr();
                  	},
                  "aTargets": [ 0 ]
                 },
                 {"sType": "numeric",
   	              "mRender": function ( data, type, full ) {
   	            	  if(data != 'null') {
   	            		  if (type === 'sort') {
   	            			  return data.replace("Z","");
   	            		  }
   	            		  return data;
   	            	  } else {
   	            		  return '';
   	            	  }
   	               },
   	               "aTargets": [ 1 ]
   		         },
                 {"sType": "numeric",
	              "mRender": function ( data, type, full ) {
	            	  if(data != 'null') {
	            		  if (type === 'sort') {
	            			  return data.replace("C","");
	            		  }
	            		  return data;
	            	  } else {
	            		  return '';
	            	  }
	               },
	               "aTargets": [ 2 ]
		          },
		          {	 "sType": "string",
	                  	 "mRender": function ( data, type, full ) {
	                  		if(data != 'null') {
		             	        return data;
	                  		} else {
	                  			return '';
	                  		}
	             	      },
	             	      "aTargets": [ 3, 4 ]
		          },
                  {"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
                	"aTargets": [ 5 ] 
                  }]
	    });
		
		pData.find('#table-espece').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "iDisplayLength": 25,
	        "aaSorting": [[0,'asc']],
	        "aoColumnDefs": [
	             {"sType": "date",
                  "mRender": function ( data, type, full ) {
                	  return data.extractDbDate().dateDbToFr();
                  	},
                  "aTargets": [ 0 ]
                 },
                 {"sType": "numeric",
   	              "mRender": function ( data, type, full ) {
   	            	  if(data != 'null') {
   	            		  if (type === 'sort') {
   	            			  return data.replace("Z","");
   	            		  }
   	            		  return data;
   	            	  } else {
   	            		  return '';
   	            	  }
   	               },
   	               "aTargets": [ 1 ]
   		         },
                 {"sType": "numeric",
	              "mRender": function ( data, type, full ) {
	            	  if(data != 'null') {
	            		  if (type === 'sort') {
	            			  return data.replace("C","");
	            		  }
	            		  return data;
	            	  } else {
	            		  return '';
	            	  }
	               },
	               "aTargets": [ 2 ]
		          },
		          {	 "sType": "string",
	                  	 "mRender": function ( data, type, full ) {
	                  		if(data != 'null') {
		             	        return data;
	                  		} else {
	                  			return '';
	                  		}
	             	      },
	             	      "aTargets": [ 3, 4 ]
		          },
                  {"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
                	"aTargets": [ 5 ] 
                  }]
	    });
		return pData;		
	};
	this.construct(pParam);
}	