;function FactureVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {FactureVue(pParam);}} );
		var that = this;
		pParam = $.extend(true,{},pParam);
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=Facture", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							var lVo = new RechercheListeFactureVO();
							lVo.dateDebut = getPremierJourDuMois();
							lResponse.dateDebut = lVo.dateDebut.dateDbToFr();
							lVo.dateFin = getDernierJourDuMois();
							lResponse.dateFin = lVo.dateFin.dateDbToFr();
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
		pData = this.affectAjoutFacture(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectRechercheListeFacture(pData);
		pData = gCommunVue.comHoverBtn(pData);
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
			lResponse.sigleMonetaire = gSigleMonetaire;
			$.each(lResponse.listeFacture, function() {
				this.montant = this.montant.nombreFormate(2,',',' ');
				this.dateTri = this.date.extractDbDate().dateDbToTri();
				this.date = this.date.extractDbDate().dateDbToFr();
				
				if( this.numero == null) {
					this.numero = '';
				} else {
					this.numero = lGestionCommandeTemplate.listeFactureNumeroMarche.template(this);
				}
			});			
			$('#liste-facture').html(that.affect($(lGestionCommandeTemplate.listeFacture.template(lResponse))));
		} else {
			$('#liste-facture').html(that.affect($(lGestionCommandeTemplate.listeFactureVide)));
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectAfficherFacture(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.tablesorter({sortList: [[0,1]], headers: { 4: {sorter: false}, 5: {sorter: false} }});
		return pData;
	};

	this.affectAjoutFacture = function(pData) {
		pData.find('#btn-nv-facture').click(function() {
			EditionFactureVue();
		});
		return pData;
	};
	
	this.affectAfficherFacture = function(pData) {
		pData.find('.btn-afficher-facture').click(function() {
			EditionFactureVue({id:$(this).data("id-facture")});
		});
		return pData;
	};
	
	this.construct(pParam);
};