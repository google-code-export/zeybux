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
		var lTemplate = '';
		if(pResponse.listeAdherent[0].adhId && pResponse.listeAdherent[0].adhId != null) {
			lTemplate = lGestionCommandeTemplate.listeReservation;
			$.each(pResponse.listeAdherent,function() {
				this.adhIdTri = this.adhNumero.replace("Z","");
			});
		} else {
			lTemplate = lGestionCommandeTemplate.listeReservationVide;
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
		pData.find('.com-table').tablesorter({sortList: [[2,0]],headers: { 4: {sorter: false} } });
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
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		
		var that = this;
		pData.find('#btn-export-resa')
		.click(function() {			
			var lParam = {fonction:'afficher',id_marche:that.mIdMarche};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								if(pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								
								// N'affiche pas les produits solidaire		
								var lProduits = [];
								$.each(lResponse.marche.produits, function() {
									if(this.type != 1) {
										lProduits.push(this);
									}
								});
								lResponse.marche.produits = lProduits;
								
								// La fenêtre de dialog
								var lDialog = $(that.affectFormExport($(lGestionCommandeTemplate.dialogExportListeReservation.template(lResponse.marche)))).dialog({
									autoOpen: true,
									modal: true,
									draggable: false,
									resizable: false,
									width:800,
									buttons: {
										'Exporter': function() {
											// Récupération du formulaire
											var lIdProduits = '';
											$('input:checked',lTable.fnGetNodes()).each(function() {
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
												// Déselectionne les produits
												$(":input[name=id_produits]",lTable.fnGetNodes()).prop("checked", false);
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
								
								// Le dataTable avec groupement par catégorie
								var lTable = 
									lDialog.find('#liste-produit')
									.dataTable({								
											"bJQueryUI": true,
									        "sPaginationType": "full_numbers",
									        "oLanguage": gDataTablesFr,
							//		        "iDisplayLength": 10,	
									        "bLengthChange": false,
											"aoColumnDefs": [
											                  { "aTargets": [ 2 ] ,
											                	"bSortable": false, 
											                	"bSearchable":false
											                  }, {
											                	  "aTargets": [ 4 ],
											                	  "bSortable": false,
											                	  "mRender": function ( data, type, full ) {
											                		  if(data == 2) {
											                			  return lGestionCommandeTemplate.flagAbonnement;
											                		  }
											                		  return '';
										                	      }
											                  }, {
											                	  "aTargets": [ 3 ],
											                	 "bSortable": false
											                  }]
									})
									.rowGrouping({	
										iGroupingColumnIndex2: 1,
										sGroupingClass:"ui-widget-header",
										sGroupingClass2:"ui-widget-header",
										sGroupLabelPrefix2:"&emsp;"
									});
								
								// Bouton selection de tous les produits
								lDialog.find("#button-tp").click(function() {
									$(":input[name=id_produits]",lTable.fnGetNodes()).prop("checked", true);
								});
								// Déselectionne les produits
								lDialog.find("#button-ap").click(function() {
									$(":input[name=id_produits]",lTable.fnGetNodes()).prop("checked", false);
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
	
	this.affectFormExport = function(pData) {
		pData = gCommunVue.comHoverBtn(pData); 
		return pData;
	};

	this.construct(pParam);
}