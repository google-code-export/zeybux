;function ListeAchatMarcheVue(pParam) {
	this.mIdMarche = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeAchatMarcheVue(pParam);}} );
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionCommande&v=ListeAchatMarche", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							that.mIdMarche = pParam.id_marche;
							that.afficher(lResponse);
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
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
		$(pResponse.listeAchatEtReservation).each(function() {
			if(this.idOperation == null) { 
				this.achat = 'ui-helper-hidden';
			} else {
				this.achat = '';
			}
			//if(this.achat == null) { this.achat = '';}
			this.adhIdTri = this.adhNumero.replace("Z","");
		});

		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		
		// Affiche les achats invite uniquement si il y en a
		pResponse.achatInvite = "";
		if(pResponse.listeAchatInvite && pResponse.listeAchatInvite[0] && pResponse.listeAchatInvite[0].id != null) {
			$(pResponse.listeAchatInvite).each(function() {
				if(this.typePaiement == 7){
					this.achatSolidaire = 'ui-helper-hidden';
					this.achat = '';
				} else {
					this.achatSolidaire = '';
					this.achat = 'ui-helper-hidden';
				}
				this.montant = (this.montant * -1).nombreFormate(2,',',' ');
			});
	
			pResponse.sigleMonetaire = gSigleMonetaire;
			
			pResponse.achatInvite = lGestionCommandeTemplate.listeAchatInvite.template(pResponse);
		}
		
		pResponse.infoMarcheSelected = '';
		pResponse.listeReservationSelected = '';
		pResponse.listeAchatSelected = 'ui-state-active';
		pResponse.resumeMarcheSelected = '';
		
		pResponse.editerMenu = lGestionCommandeTemplate.editerMarcheMenu.template(pResponse);
		if(pResponse.listeAchatEtReservation.length > 0 && pResponse.listeAchatEtReservation[0].adhId != null) {
			var lTemplate = lGestionCommandeTemplate.listeAchatEtReservation;
			$('#contenu').replaceWith(that.affectAchatEtReservation($(lTemplate.template(pResponse))));
		} else {
			$('#contenu').replaceWith(that.affectAchatEtReservation($(lGestionCommandeTemplate.listeAchatEtReservationVide.template(pResponse))));
		}							
	};	

	this.affectAchatEtReservation = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectAchat(pData);
		pData = this.affectExportDataEtReservation(pData);
		pData = this.affectMenu(pData);
		pData = this.affectToggleAchatInvite(pData);
		return pData;
	};
	
	this.affectMenu = function(pData) {
		var that = this;
		pData.find('#btn-information-marche').click(function() {
			EditerCommandeVue(that.mParam);
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
		pData.find('#edt-com-liste-resa').tablesorter({sortList: [[2,0]],headers: { 4: {sorter: false} }});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('#edt-com-liste-resa'), this.value );
		  });
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	};

	this.affectExportDataEtReservation = function(pData) {		
		var that = this;
		pData.find('#btn-export-achat')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogExportListeAchatEtReservation;
			
			$(lTemplate.template(that.mMarche)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Exporter': function() {
						lParam = {fonction:"exportAchatEtReservation",id_marche:that.mIdMarche};
						$.download("./index.php?m=GestionCommande&v=ListeAchatMarche", lParam);
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
	
	this.affectAchat = function(pData) {
		var that = this;
		pData.find('.edt-com-achat-ligne').click(function() {
			AchatAdherentVue({"id_marche":that.mIdMarche,"id_adherent":$(this).attr('id-adherent'), "idOperation" : ''});
		});
		
		pData.find('.edt-com-achat-ligne-invite').click(function() {
			AchatAdherentVue({"id_marche":that.mIdMarche,"id_adherent":-3, "idOperation" : $(this).data("id-operation")});
		});
		return pData;
	};
	
	this.affectToggleAchatInvite = function(pData) {
		pData.find('#entete-achat-invite').click(function() {
			$('#icon-achat-invite').toggleClass('ui-icon-triangle-1-s').toggleClass('ui-icon-triangle-1-n');
			$('.detail-achat-invite').toggle();
		});
		return pData;
	};
	
	this.construct(pParam);
}
	