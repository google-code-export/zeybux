;function RechargerCompteVue(pParam) {
	this.mTypePaiement = [];
	this.solde = 0;
	this.mBanques = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {RechargerCompteVue(pParam);}} );
		var that = this;
		var lParam = {fonction:"listeAdherent"};
		$.post(	"./index.php?m=RechargementCompte&v=RechargerCompte", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							$(lResponse.typePaiement).each(function() {
								that.mTypePaiement[this.tppId] = this;
							});
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
		var lRechargementCompteTemplate = new RechargementCompteTemplate();
		
		if(lResponse.listeAdherent.length > 0 && lResponse.listeAdherent[0].adhId != null) {
			var lTemplate = lRechargementCompteTemplate.listeAdherent;
			
			lResponse.sigleMonetaire = gSigleMonetaire;
			$(lResponse.listeAdherent).each(function() {
				this.classSolde = '';
				if(this.cptSolde < 0){this.classSolde = "com-nombre-negatif";}
				this.cptSolde = this.cptSolde.nombreFormate(2,',',' ');
				this.adhIdTri = this.adhNumero.replace("Z","");
			});
			
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(lRechargementCompteTemplate.listeAdherentVide);
		}
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		return pData;
	};
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]],headers: { 4: {sorter: false} }});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectLienCompte = function(pData) {
		var that = this;
		pData.find('.compte-ligne').click(function() {
			
			
			var lParam = {'id':$(this).attr("id-adherent"),
							fonction:"infoRechargement"};
			
			$.post(	"./index.php?m=RechargementCompte&v=RechargerCompte", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							
							/*$(lResponse.banques).each(function() {
								that.mBanques.push({});
							});*/
							
							that.mBanques = lResponse.banques;
							
							that.solde = parseFloat(lResponse.solde);
							
							lResponse.sigleMonetaire = gSigleMonetaire;
							lResponse.solde = lResponse.solde.nombreFormate(2,',',' ');
							lResponse.typePaiement = that.mTypePaiement;
							
							var lCompte = lResponse.idCompte;
							
							var lRechargementCompteTemplate = new RechargementCompteTemplate();
							var lTemplate = lRechargementCompteTemplate.dialogRecharger;						
							var lHtml = $(lTemplate.template(lResponse));
							
							lHtml = that.affectDialog(lHtml);
							
							lHtml.dialog({
								autoOpen: true,
								modal: true,
								draggable: false,
								resizable: false,
								width:800,
								buttons: {
									'Valider': function() {
								
										var lVo = that.getRechargementVO();									
										lVo.id = lCompte;
										
										var lValid = new RechargementCompteValid();
										var lVr = lValid.validAjout(lVo);
										
										Infobulle.init(); // Supprime les erreurs
										if(lVr.valid) {
											lVo.fonction = "rechargerCompte";
											var lDialog = this;
											$.post(	"./index.php?m=RechargementCompte&v=RechargerCompte", "pParam=" + $.toJSON(lVo),
												function(lResponse) {
													Infobulle.init(); // Supprime les erreurs
													if(lResponse.valid) {
														
														// Message d'information
														var lVr = new TemplateVR();
														lVr.valid = false;
														lVr.log.valid = false;
														var erreur = new VRerreur();
														erreur.code = ERR_306_CODE;
														erreur.message = ERR_306_MSG;
														lVr.log.erreurs.push(erreur);
														var lParam = {vr:lVr};
														that.construct(lParam);
														
														$(lDialog).dialog("close");										
													} else {
														Infobulle.generer(lResponse,'');
													}
												},"json"
											);
										}else {
											Infobulle.generer(lVr,'');
										}
									},
									'Annuler': function() { $(this).dialog("close"); }
									},
								close: function(ev, ui) { $(this).remove(); }
							});
							that.changerTypePaiement($(":input[name=typepaiement]"));
							that.majNouveauSolde();
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);		
		});
		return pData;
	};
	
	this.affectDialog = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.affectListeBanque(pData);
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.affectListeBanque = function(pData) {
		var that = this;
		
		function removeIfInvalid(element) {
			// Vide le champ si la banque n'existe pas
			var value = $( element ).val(),
			matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
			valid = false;
			$( that.mBanques ).each(function() {
				if ( $( this ).text().match( matcher ) ) {
					this.selected = valid = true;
					return false;
				}
			});
			if ( !valid ) {
				$( element ).attr( 'id-banque','' ); 
				
				// Message d'information
				var lVr = new RechargementCompteVR();
				lVr.valid = false;
				lVr.idBanque.valid = false;
				var erreur = new VRerreur();
				erreur.code = ERR_261_CODE;
				erreur.message = ERR_261_MSG;
				lVr.idBanque.erreurs.push(erreur);
				
				Infobulle.generer(lVr,'');
				return false;
			}
		};
		
		pData.find('#idBanque').autocomplete({
			minLength: 0,			 
			source: function( request, response ) {
				var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
					response( $.grep( that.mBanques, 
						function( item ){
							return matcher.test( item.nom ) || matcher.test( item.nomCourt );
						}
					));
			},	 
			focus: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				$( "#idBanque" ).val( htmlDecode(ui.item.nom) );
				return false;
			},
			select: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				$( "#idBanque" ).val( htmlDecode(ui.item.nom) );
				$( "#idBanque" ).attr('id-banque', ui.item.id );
				return false;
			},
			change: function( event, ui ) {
				Infobulle.init(); // Supprime les erreurs
				if ( !ui.item )
					return removeIfInvalid( this );
			}
		}).data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li>" )
			.data( "item.autocomplete", item )
			.append( "<a>" + item.nomCourt + " : " + item.nom + "<br>" + item.description + "</a>" )
			.appendTo( ul );
		};
		
		return pData;
	};
	
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
		});
		return pData;
	};
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel).show();
			//$("#label-champ-complementaire-banque").show();
			$("#td-champ-complementaire, #td-champ-complementaire-banque, #label-champ-complementaire-banque").show();
		} else {
			$("#label-champ-complementaire").text('').hide();
			//$("#label-champ-complementaire-banque").hide();
			$(':input[name="champ-complementaire"], :input[name="champ-complementaire-banque"]').val('');
			$("#td-champ-complementaire, #td-champ-complementaire-banque, #label-champ-complementaire-banque").hide();
			$('#idBanque').attr('id-banque','');
		}
	};
	
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.mTypePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].tppChampComplementaire == 1) {
				return lTpp[pId].tppLabelChampComplementaire;
			}
		}	
		return null;
	};
	
	this.affectNouveauSolde = function(pData) {
		var that = this;
		pData.find(":input[name=montant-rechargement]").keyup(function() {
			that.majNouveauSolde();
		});
		return pData;
	};
	
	this.majNouveauSolde = function() {
		var lTotal = this.calculNouveauSolde();
		if(lTotal <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lTotal.nombreFormate(2,',',' '));
	};
	
	this.calculNouveauSolde = function() {
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}		
		return this.solde + lRechargement;
	};
	
	this.getRechargementVO = function() {
		var lVo = new RechargementCompteVO();
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		if(!isNaN(lMontant) && !lMontant.isEmpty()){
			lMontant = parseFloat(lMontant);
		}
		lVo.montant = lMontant;
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		if(this.getLabelChamComplementaire(lVo.typePaiement) != null) {
			lVo.champComplementaireObligatoire = 1;
			lVo.champComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lVo.champComplementaireObligatoire = 0;
		}
		
		lVo.idBanque = $('#idBanque').attr('id-banque');
		return lVo;
	};
	
	this.construct(pParam);
}