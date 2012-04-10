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
		$("#edt-com-nav-resa-achat span").removeClass("ui-state-active");
		$("#btn-liste-achat-resa").addClass("ui-state-active");
		
		$(pResponse.listeAchatEtReservation).each(function() {
			if(this.reservation == null) { this.reservation = '';}
			if(this.achat == null) { this.achat = '';}
		});

		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		if(pResponse.listeAchatEtReservation.length > 0 && pResponse.listeAchatEtReservation[0].adhId != null) {
			var lTemplate = lGestionCommandeTemplate.listeAchatEtReservation;
			$('#edt-com-liste').replaceWith(that.affectAchatEtReservation($(lTemplate.template(pResponse))));
		} else {
			$('#edt-com-liste').replaceWith(lGestionCommandeTemplate.listeAchatEtReservationVide);
		}							
	};	

	this.affectAchatEtReservation = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectAchat(pData);
		pData = this.affectExportDataEtReservation(pData);
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
			AchatAdherentVue({"id_marche":that.mIdMarche,"id_adherent":$(this).find('.id-adherent').text()});
		});
		return pData;
	};
	
	this.construct(pParam);
}
	