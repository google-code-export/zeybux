;function FactureVue(pParam) {
	this.mIdMarche = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {FactureVue(pParam);}} );
		var that = this;
		pParam = $.extend(true,{},pParam);
		
		if(pParam.idMarche) {
			this.mIdMarche = pParam.idMarche;
		}
		
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=Facture", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							var lVo = new RechercheListeFactureVO();
							
							if(that.mIdMarche > 0) {
								lVo.idMarche = that.mIdMarche;
							} else {							
								lVo.dateDebut = getPremierJourDuMois();
								lResponse.dateDebut = lVo.dateDebut.dateDbToFr();
								lVo.dateFin = getDernierJourDuMois();
								lResponse.dateFin = lVo.dateFin.dateDbToFr();
							}
							if(pParam && pParam.vr) {
								lVo.vr = pParam.vr;
							}
							
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							$('#contenu').replaceWith(that.affectEntete($(lGestionCommandeTemplate.rechercheListeFacture.template(lResponse))));
							that.recherche(lVo);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};

	this.affectEntete = function(pData) {
		pData = this.affectModeMarche(pData);
		pData = this.affectAjoutFacture(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectRechercheListeFacture(pData);		
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectModeMarche = function(pData) {
		if(this.mIdMarche > 0) {
			var that = this;
			pData.find('#form-recherche-liste-facture').remove();
			pData.find('.com-barre-menu-2').show();
			pData.find('#btn-retour').click(function() {
				EditerCommandeVue({"id_marche":that.mIdMarche});
			});
		}
		return pData;
	};
	
	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateDebut','dateFin',pData);
		pData.find('#dateDebut, #dateFin').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	};
	
	this.affectRechercheListeFacture = function(pData) {
		var that = this;
		pData.find('#btn-rechercher-liste-facture').click(function() {
			var lVo = new RechercheListeFactureVO();
			lVo.dateDebut = $('#dateDebut').val().dateFrToDb();
			lVo.dateFin = $('#dateFin').val().dateFrToDb();
			lVo.idMarche = $('#idMarche').val();

			var lValid = new FactureValid();
			var lVr = lValid.validRechercheListeFacture(lVo);

			Infobulle.init(); // Supprime les erreurs
			if(lVr.valid) {
				that.recherche(lVo);
			} else {
				Infobulle.generer(lVr,'');
			}
		});
		return pData;
	};
	
	this.recherche = function(pVo) {
		var that = this;
		pVo.fonction = "rechercher";
		$.post(	"./index.php?m=GestionCommande&v=Facture", "pParam=" + $.toJSON(pVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pVo && pVo.vr) {
								Infobulle.generer(pVo.vr,'');
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

		if(lResponse.listeFacture.length > 0 && lResponse.listeFacture[0].id != null) {			
			//lResponse.sigleMonetaire = gSigleMonetaire;
			var lTotal = 0;
			$.each(lResponse.listeFacture, function() {
				lTotal += parseFloat(this.montant);
				/*this.montant = this.montant.nombreFormate(2,',',' ');
				this.dateTri = this.date.extractDbDate().dateDbToTri();
				this.date = this.date.extractDbDate().dateDbToFr();
				
				if( this.numero == null) {
					this.numero = '';
				} else {
					this.numero = lGestionCommandeTemplate.listeFactureNumeroMarche.template(this);
				}*/
			});			
			
			if(this.mIdMarche > 0) {
				$('#total-bdl-marche').html(lGestionCommandeTemplate.totalBdlMarche.template({total:lTotal.nombreFormate(2,',',' '),sigleMonetaire:gSigleMonetaire}));
			}
		} else {
			lResponse.listeFacture = [];
		}	
		$('#liste-facture').html(that.affect($(lGestionCommandeTemplate.listeFacture.template(lResponse))));
		
			//$('#liste-facture').html(that.affect($(lGestionCommandeTemplate.listeFactureVide)));		
	};
	
	this.affect = function(pData) {
		pData = this.affectAfficherFacture(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectDataTable(pData);
		return pData;
	};
	
	this.affectDataTable = function(pData) {
		pData.find('#liste-bdl').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	  //      "iDisplayLength": 25,
	        "aaSorting": [[0,'desc']],
	        "aoColumnDefs": [
	             {"sType": "date",
                  "mRender": function ( data, type, full ) {
                  	if (type === 'sort') {
                		return data.replace(' ','T');
                	}
                	  return data.extractDbDate().dateDbToFr();
                  	},
                  "aTargets": [ 1 ]
                 },
		          {	 "sType": "numeric",
	                  	 "mRender": function ( data, type, full ) {
	                  		if(data != 'null') {
		             	        return data;
	                  		} else {
	                  			return '';
	                  		}
	             	      },
	             	      "aTargets": [ 0,2,5 ]
		          },
                  {"sType": "numeric",
	                "mRender": function ( data, type, full ) {
         	        	if(type !== 'sort' && data.length > 0) {
         	        		return data.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
         	        	}
         	        	return data;
	             	},
                	"aTargets": [ 4 ] 
                  },
                  { "bSortable": false,
                  	"aTargets": [ 6 ] 
                    }]
	    });
		return pData;		
	};
	this.affectAjoutFacture = function(pData) {
		var that = this;
		pData.find('#btn-nv-facture').click(function() {
			var lParam = {};
			if(that.mIdMarche > 0) {
				lParam.idMarche = that.mIdMarche;
			}
			EditionFactureVue(lParam);
		});
		return pData;
	};
	
	this.affectAfficherFacture = function(pData) {
		var that = this;
		pData.find('.btn-afficher-facture').click(function() {
			var lParam = {id:$(this).data("id-facture")};
			if(that.mIdMarche > 0) {
				lParam.idMarche = that.mIdMarche;
			}
			EditionFactureVue(lParam);
		});
		return pData;
	};
	
	this.construct(pParam);
};