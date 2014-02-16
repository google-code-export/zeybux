;function DetailAdhesionAdherentVue(pParam) {
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {DetailAdhesionAdherentVue(pParam);}} );
		var that = this;
		pParam.fonction = "adhesionSurAdherent";
		$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(pParam),
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
		if(lResponse.listeAdhesion.length == 0 || lResponse.listeAdhesion[0].adadId == null) {
			lResponse.listeAdhesion = [];
		}
		lResponse.numero = lResponse.adherent.adhNumero;
		lResponse.prenom = lResponse.adherent.adhPrenom;
		lResponse.nom = lResponse.adherent.adhNom;
		
		$('#contenu').replaceWith(that.affect($(lAdhesionTemplate.listeAdhesionAdherent.template(lResponse))));
	};
	
	this.affect = function(pData) {
		pData = this.affectLienRetour(pData);
		pData = this.affectDetailAdhesion(pData);
		pData = gCommunVue.comHoverBtn(pData); 
		pData = this.affectDataTable(pData);
		return pData;
	};
	
	this.affectLienRetour = function(pData) {
		pData.find("#lien-retour").click(function() { ListeAdherentAdhesionVue(); });
		return pData;
	};
	
	this.affectDataTable = function(pData) {
		pData.find('#liste-adhesion').dataTable({
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
	        "oLanguage": gDataTablesFr,
	        "bLengthChange":false,
	        "aaSorting": [[1,'desc']],
	        "aoColumnDefs": [
                  { "bSortable": false, 
                	"bSearchable":false,
                	"aTargets": [ 3 ] 
                  },
                  {	 "sType": "date",
                	 "mRender": function ( data, type, full ) {
                		 return data.extractDbDate().dateDbToFr();
                	 },
                	"aTargets": [ 1,2 ]
                  }]
	    });
		return pData;		
	};
	
	this.affectDetailAdhesion = function(pData) {
		pData.find('.detail-adhesion-adherent').click(function() {
			var lParam = {'id':$(this).data('id-adhesion-adherent'),
							fonction:"infoModificationAdhesionAdherent"};
			
			$.post(	"./index.php?m=Adhesion&v=GestionAdhesion", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							var lAdhesionTemplate = new AdhesionTemplate();
							
							lResponse.sigleMonetaire = gSigleMonetaire;
							
							var lType = {};
							$.each(lResponse.adhesion.types, function() {
								if(this.id == lResponse.adhesionAdherent.adhesionAdherent.idTypeAdhesion) {
									lType = this;
								}
							});
							// Pas de modification du type d'adhésion possible
							lResponse.type = lAdhesionTemplate.typeAdhesionUnique.template(lType);
							lResponse.perimetre = lType.perLabel;
							lResponse.montant = lAdhesionTemplate.typeAdhesionMontant.template({montant:lType.montant.nombreFormate(2,',',' '),sigleMonetaire:gSigleMonetaire});
							
							lResponse.statutFormulaireChecked = 'ui-icon-closethick';
							if(lResponse.adhesionAdherent.adhesionAdherent.statutFormulaire == 1) {
								lResponse.statutFormulaireChecked = 'ui-icon-check';
							}

							var lTypePaiementService = new TypePaiementService();
							var lChampComplementaire = [];
							if(lResponse.typePaiement[lResponse.adhesionAdherent.operation.typePaiement]) {
								$(lResponse.typePaiement[lResponse.adhesionAdherent.operation.typePaiement].champComplementaire).each(function() {				
									var lChamp = lResponse.adhesionAdherent.operation.champComplementaire[this.id];
									lChamp.id = this.id;
									lChamp.tppCpVisible = 1;
									lChamp.chCpLabel = this.label;
									lChampComplementaire.push(lChamp);
								});
							}
							lResponse.champComplementaire = lTypePaiementService.getFormChampcomplementaire(lChampComplementaire, lResponse.banques, true);
							
							lResponse.label = lResponse.adhesion.label;
							lResponse.dateDebut = lResponse.adhesion.dateDebut.extractDbDate().dateDbToFr();
							lResponse.dateFin = lResponse.adhesion.dateFin.extractDbDate().dateDbToFr();
							lResponse.typePaiement = lResponse.adhesionAdherent.operation.tppType;

							
							$(lAdhesionTemplate.dialogAficheAdhesionAdherent.template(lResponse)).dialog({
								autoOpen: true,
								modal: true,
								draggable: false,
								resizable: false,
								width:370,
								close: function(ev, ui) { $(this).remove(); }
							});
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);	
		});
		return pData;		
	};

	this.construct(pParam);
};