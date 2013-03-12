;function ListeReservationMarcheVue(pParam) {
	this.mIdMarche = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeReservationMarcheVue(pParam);}} );
		//this.mParam = pParam;
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionCommande&v=ListeReservationMarche", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.mIdMarche = pParam.id_marche;
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};

	this.afficher = function(pResponse) {
		var that = this;

		// Met le bouton en actif
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		
		if(pResponse.listeAdherent[0].adhId && pResponse.listeAdherent[0].adhId != null) {
			var lTemplate = lGestionCommandeTemplate.listeReservation;
			$.each(pResponse.listeAdherent,function() {
				this.adhIdTri = this.adhNumero.replace("Z","");
			});
		} else {
			var lTemplate = lGestionCommandeTemplate.listeReservationVide;
		}
		
		pResponse.infoMarcheSelected = '';
		pResponse.listeReservationSelected = 'ui-state-active';
		pResponse.listeAchatSelected = '';
		pResponse.resumeMarcheSelected = '';

		pResponse.editerMenu = lGestionCommandeTemplate.editerMarcheMenu.template(pResponse);
		
		var lHtml = that.affectReservationAction($(lTemplate.template(pResponse)));	
		$('#contenu').replaceWith(lHtml);		
	};
	
	this.affectReservationAction = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectExportReservation(pData);
		pData = this.affectReservation(pData);
		pData = this.affectMenu(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectMenu = function(pData) {
		var that = this;
		pData.find('#btn-information-marche').click(function() {
			EditerCommandeVue({id_marche:that.mIdMarche});
		});		
		pData.find("#btn-liste-achat-resa").click(function() {
			ListeAchatMarcheVue({id_marche:that.mIdMarche});
		});
		pData.find("#btn-liste-resa").click(function() {
			ListeReservationMarcheVue({id_marche:that.mIdMarche});
		});
		pData.find("#btn-resume-marche").click(function() {
			ResumeMarcheVue({id_marche:that.mIdMarche});
		});
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[2,0]] });
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	};
		
	this.affectReservation = function(pData) {
		var that = this;
		pData.find('.edt-com-reservation-ligne').click(function() {
			ReservationAdherentVue({"id_commande":that.mIdMarche,"id_adherent":$(this).attr('id-adherent')});
		});
		return pData;
	};
	
	this.affectExportReservation = function(pData) {		
		var that = this;
		pData.find('#btn-export-resa')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogExportListeReservation;

			// N'affiche pas les produits solidaire		
			var lListe = {fermes:[]};
			$(that.mListeFerme.fermes).each(function(i,val) {
				var lAjoutFerme = false;
				var lFerme = {ferId:this.ferId,
						ferNom:this.ferNom,
						categories:[]};
				$(this.categories).each(function(i,val) {
					var lAjoutCategorie = false;
					var lCategorie = {
							cproId:this.cproId,
							cproNom:this.cproNom,
							produits:[]};
					$(this.produits).each(function(i,val) {									
						if(this.type == 2 || this.type == 0) {						
							lCategorie.produits.push(this);
							lAjoutFerme = true;
							lAjoutCategorie = true;
						}
					});
					if(lAjoutCategorie) {
						lFerme.categories.push(lCategorie);
					}
		
				});
				if(lAjoutFerme) {
					lListe.fermes.push(lFerme);
				}
			});
			
			$(lTemplate.template(lListe)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Exporter': function() {
						// Récupération du formulaire
						var lIdProduits = '';
						$(this).find(':input[name=id_produits]:checked').each(function() {
							lIdProduits += $(this).val() + ',';
						});
						lIdProduits = lIdProduits.substr(0,lIdProduits.length-1);
						
						var lFormat = $(this).find(':input[name=format]:checked').val();
						var lParam = new ExportListeReservationVO();
						lParam = {fonction:"exportReservation",id_commande:that.mIdMarche,id_produits:lIdProduits,format:lFormat};
						
						// Test des erreurs
						var lValid = new ExportListeReservationValid();
						var lVr = lValid.validAjout(lParam);
						
						Infobulle.init(); // Supprime les erreurs
						if(lVr.valid) {
							// Affichage
							$.download("./index.php?m=GestionCommande&v=ListeReservationMarche", lParam);
						} else {
							Infobulle.generer(lVr,'');
						}
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
			
		});
		return pData;
	};	
	this.construct(pParam);
}