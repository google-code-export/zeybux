;function AchatVue(pParam) {
	this.mIdMarche = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {AchatVue(pParam);}} );
		var that = this;
		pParam = $.extend(true,{},pParam);
		
		if(pParam.idMarche) {
			this.mIdMarche = pParam.idMarche;
		}
		
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=Achat", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							var lVo = new RechercheListeAchatVO();
							
						/*	if(that.mIdMarche > 0) {
								lVo.idMarche = that.mIdMarche;
							} 				*/	
							
							lVo.dateDebut = getPremierJourDuMois();
							lResponse.dateDebut = lVo.dateDebut.dateDbToFr();
							lVo.dateFin = getDernierJourDuMois();
							lResponse.dateFin = lVo.dateFin.dateDbToFr();
							
							if(pParam && pParam.vr) {
								lVo.vr = pParam.vr;
							}
							
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							$('#contenu').replaceWith(that.affectEntete($(lGestionCommandeTemplate.rechercheListeAchat.template(lResponse))));
							that.recherche(lVo);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};

	this.affectEntete = function(pData) {
		//pData = this.affectModeMarche(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectRechercheListeAchat(pData);		
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	/*this.affectModeMarche = function(pData) {
		if(this.mIdMarche > 0) {
			var that = this;
			pData.find('#form-recherche-liste-achat').remove();
			pData.find('.com-barre-menu-2').show();
			pData.find('#btn-retour').click(function() {
				EditerCommandeVue({"id_marche":that.mIdMarche});
			});
		}
		return pData;
	};*/
	
	this.affectControleDatepicker = function(pData) {
		pData = gCommunVue.comLienDatepicker('dateDebut','dateFin',pData);
		pData.find('#dateDebut, #dateFin').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	};
	
	this.affectRechercheListeAchat = function(pData) {
		var that = this;
		pData.find('#btn-rechercher-liste-achat').click(function() {
			var lVo = new RechercheListeAchatVO();
			lVo.dateDebut = $('#dateDebut').val().dateFrToDb();
			lVo.dateFin = $('#dateFin').val().dateFrToDb();
			lVo.idMarche = $('#idMarche').val();

			var lValid = new AchatValid();
			var lVr = lValid.validRechercheListeAchat(lVo);

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
		$.post(	"./index.php?m=GestionCommande&v=Achat", "pParam=" + $.toJSON(pVo),
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

		if(lResponse.listeAchat.length > 0 && lResponse.listeAchat[0].opeId != null) {			
			lResponse.sigleMonetaire = gSigleMonetaire;
			$.each(lResponse.listeAchat, function() {
				this.montant = (this.opeMontant * -1).nombreFormate(2,',',' ');
				this.dateTri = this.opeDate.extractDbDate().dateDbToTri();
				this.date = this.opeDate.extractDbDate().dateDbToFr();
				
				if( this.comNumero == null) {
					this.comNumero = '';
				} else {
					this.comNumero = lGestionCommandeTemplate.listeAchatNumeroMarche.template(this);
				}
				if( this.adhId == null) {
					this.adhId = 0;
				}
				if( this.adhNumero == null) {
					this.adhNumero = '';
				}
				if( this.adhNom == null) {
					this.adhNom = '';
				}
				if( this.adhPrenom == null) {
					this.adhPrenom = '';
				}
			});			
			$('#liste-achat').html(that.affect($(lGestionCommandeTemplate.listeAchat.template(lResponse))));
		} else {
			$('#liste-achat').html(that.affect($(lGestionCommandeTemplate.listeAchatVide)));
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectAfficherAchat(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.tablesorter({sortList: [[0,1]], headers: { 6: {sorter: false}, 7: {sorter: false} }});
		return pData;
	};
	
	this.affectAfficherAchat = function(pData) {
		//var that = this;
		pData.find('.btn-afficher-achat').click(function() {
			/*var lParam = {id:$(this).data("id-achat")};
			if(that.mIdMarche > 0) {
				lParam.idMarche = that.mIdMarche;
			}*/
			
			var lParam = {	
					id:$(this).data("id-achat"),
					id_adherent:$(this).data("id-adherent"),
					id_commande:'',
					module:'GestionCommande',
					retour:'Achat'};
			
			
			CaisseVue(lParam);
		});
		return pData;
	};
	
	this.construct(pParam);
};