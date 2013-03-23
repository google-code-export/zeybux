;function SuiviPaiementVue(pParam) {
	this.mListeOperation = [];
	this.mSelectedTabs = 0;
	this.mBanques = [];
	this.mBanquesTriId = [];
	
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {SuiviPaiementVue(pParam);}} );
		var that = this;	
		var lParam = {fonction:"afficher"};
		if(pParam && pParam.selectedTabs) {
			this.mSelectedTabs = pParam.selectedTabs;
		}
		$.post(	"./index.php?m=CompteZeybu&v=SuiviPaiement", "pParam=" + $.toJSON(lParam),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						$(lResponse.banques).each(function() {
							that.mBanquesTriId[this.id] = this;
						});
						that.mBanques = lResponse.banques;
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
		var lTotalEspeceAdherent = 0;
		$.each(lResponse.listeEspeceAdherent,function() {
			if(this.opeId) {
				this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.adhIdTri = this.adhNumero.replace("Z","");
				this.cptIdTri = this.cptLabel.replace("C","");
				lTotalEspeceAdherent += parseFloat(this.opeMontant);			
				that.mListeOperation[this.opeId] = this;
			}
		});
		var lTotalChequeAdherent = 0;
		$.each(lResponse.listeChequeAdherent,function() {
			if(this.opeId) {
				this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.adhIdTri = this.adhNumero.replace("Z","");
				this.cptIdTri = this.cptLabel.replace("C","");
				lTotalChequeAdherent += parseFloat(this.opeMontant);		
				that.mListeOperation[this.opeId] = this;
			}
		});
		var lTotalEspeceFerme = 0;
		$.each(lResponse.listeEspeceFerme,function() {
			if(this.opeId) {
				this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.ferIdTri = this.ferNumero.replace("F","");
				this.cptIdTri = this.cptLabel.replace("C","");
				lTotalEspeceFerme += parseFloat(this.opeMontant);		
				that.mListeOperation[this.opeId] = this;
			}
		});
		var lTotalChequeFerme = 0;
		$.each(lResponse.listeChequeFerme,function() {
			if(this.opeId) {
				this.opeDateTri = this.opeDate.extractDbDate().replace("-","");
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.opeMontantAffichage = this.opeMontant.nombreFormate(2,',',' ');
				this.ferIdTri = this.ferNumero.replace("F","");
				this.cptIdTri = this.cptLabel.replace("C","");
				lTotalChequeFerme += parseFloat(this.opeMontant);		
				that.mListeOperation[this.opeId] = this;
			}
		});

		lResponse.sigleMonetaire = gSigleMonetaire;
		lResponse.totalEspeceAdherent = lTotalEspeceAdherent.nombreFormate(2,',',' ');
		lResponse.totalChequeAdherent = lTotalChequeAdherent.nombreFormate(2,',',' ');
		lResponse.totalEspeceFerme = lTotalEspeceFerme.nombreFormate(2,',',' ');
		lResponse.totalChequeFerme = lTotalChequeFerme.nombreFormate(2,',',' ');
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.listePaiement;	
		var lHtml = $(lTemplate.template(lResponse));
				
		if(lResponse.listeChequeAdherent.length <= 0 || lResponse.listeChequeAdherent[0].adhId == null) {
			lHtml.find("#cheque-adherent").replaceWith(lCompteZeybuTemplate.listePaiementVide.template({id:"cheque-adherent"}));
		}
		if(lResponse.listeEspeceAdherent.length <= 0 || lResponse.listeEspeceAdherent[0].adhId == null) {
			lHtml.find("#espece-adherent").replaceWith(lCompteZeybuTemplate.listePaiementVide.template({id:"espece-adherent"}));
		}
		if(lResponse.listeChequeFerme.length <= 0 || lResponse.listeChequeFerme[0].ferId == null) {
			lHtml.find("#cheque-ferme").replaceWith(lCompteZeybuTemplate.listePaiementVide.template({id:"cheque-ferme"}));
		}
		if(lResponse.listeEspeceFerme.length <= 0 || lResponse.listeEspeceFerme[0].ferId == null) {
			lHtml.find("#espece-ferme").replaceWith(lCompteZeybuTemplate.listePaiementVide.template({id:"espece-ferme"}));
		}
		
		$('#contenu').replaceWith(that.affect(lHtml));
		
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectTabs(pData);
		pData = this.affectValiderPaiement(pData);
		pData = this.affectModifierPaiement(pData);
		pData = this.affectSupprimerPaiement(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectTabs = function(pData) {
		var that = this;
		pData.find( "#listePaiement" ).tabs({selected:that.mSelectedTabs});
		pData.find("#li-cheque-adherent,#li-espece-adherent,#li-cheque-ferme,#li-espece-ferme").click(
				function() {that.mSelectedTabs = $("#listePaiement").tabs("option","selected");});
		return pData;
	};

	this.affectTri = function(pData) {
		pData.find('.table-cheque-adherent').tablesorter({sortList: [[0,0]],headers: { 7: {sorter: false} }});
		pData.find('.table-espece-adherent').tablesorter({sortList: [[0,0]],headers: { 6: {sorter: false} }});
		pData.find('.table-cheque-ferme').tablesorter({sortList: [[0,0]],headers: { 7: {sorter: false} }});
		pData.find('.table-espece-ferme').tablesorter({sortList: [[0,0]],headers: { 6: {sorter: false} }});
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter-cheque-adherent").keyup(function() {
			$.uiTableFilter( $('.table-cheque-adherent'), this.value );
		});
		pData.find("#filter-espece-adherent").keyup(function() {
			$.uiTableFilter( $('.table-espece-adherent'), this.value );
		});
		pData.find("#filter-cheque-ferme").keyup(function() {
			$.uiTableFilter( $('.table-cheque-ferme'), this.value );
		});
		pData.find("#filter-espece-ferme").keyup(function() {
			$.uiTableFilter( $('.table-espece-ferme'), this.value );
		});
		
		pData.find("#filter-form-cheque-adherent, #filter-form-espece-adherent, #filter-form-cheque-ferme, #filter-form-espece-ferme").submit(function () {return false;});
		
		return pData;
	};
	
	this.affectValiderPaiement= function(pData) {
		var that = this;
		pData.find(".btn-valid").click(function() {that.dialogValiderPaiement($(this).attr("id-operation"));});		
		return pData;
	};

	this.dialogValiderPaiement = function(pIdOperation) {
		var that = this;
		var lOperation = this.mListeOperation[pIdOperation];
		lOperation.sigleMonetaire = gSigleMonetaire;
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		//var lDialog =
		$(lCompteZeybuTemplate.dialogValiderPaiement.template(lOperation)).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:450,
			buttons: {
				'Valider': function() {
					that.validerPaiement(pIdOperation,this);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.validerPaiement = function(pIdOperation,pDialog) {
		var that = this;
		var lVo = { id:pIdOperation,
					fonction:"valider"};
		$.post(	"./index.php?m=CompteZeybu&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_351_CODE;
						erreur.message = ERR_351_MSG;
						lVr.log.erreurs.push(erreur);						
						$(pDialog).dialog("close");	
						that.construct({vr:lVr,selectedTabs:that.mSelectedTabs});									
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};

	this.affectModifierPaiement= function(pData) {
		var that = this;
		pData.find(".btn-modifier").click(function() {that.dialogModifierPaiement($(this).attr("id-operation"),$(this).attr("type"));});		
		return pData;
	};
	
	this.dialogModifierPaiement = function(pIdOperation,pType) {
		var that = this;
		var lOperation = this.mListeOperation[pIdOperation];
		lOperation.sigleMonetaire = gSigleMonetaire;
		var lBanque = {nom:""};
		if(this.mBanquesTriId[lOperation.opeIdBanque]) {
			lBanque = this.mBanquesTriId[lOperation.opeIdBanque];
			
		}
		lOperation.opeBanque = lBanque.nom;
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = "";
		if(pType == 1) {
			lTemplate = lCompteZeybuTemplate.dialogModifierPaiementCheque;
		} else {
			lTemplate = lCompteZeybuTemplate.dialogModifierPaiementEspece;
		}
		var lDialog = $(that.affectDialog($(lTemplate.template(lOperation)))).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:700,
			buttons: {
				'Valider': function() {
					that.modifierPaiement(pIdOperation,pType,this);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});		
		lDialog.find('form').submit(function() {
			that.modifierPaiement(pIdOperation,pType,lDialog);
			return false;
		});
	};
		
	this.modifierPaiement = function(pIdOperation,pType,pDialog) {
		var that = this;

		var lVo = new RechargementCompteVO();
		lVo.id = pIdOperation;
		lVo.fonction="modifier";
		lVo.montant=$(pDialog).find("#montant").val().numberFrToDb();
		if(pType == 1) { // Cheque
			lVo.champComplementaireObligatoire = 1;
			lVo.champComplementaire = $(pDialog).find("#champComplementaire").val();
			// Si id-banque est alimenté mais qu'on efface le nom de la banque par la suite
			// il ne faut pas prendre en compte le id-banque
			if($('#idBanque').val() != "") {
				lVo.idBanque = $('#idBanque').attr('id-banque');
			}
			lVo.typePaiement = 2;
		} else { // Espece
			lVo.typePaiement = 1;
			lVo.champComplementaireObligatoire = 0;
		}
		
		var lValid = new RechargementCompteValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			$.post(	"./index.php?m=CompteZeybu&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_352_CODE;
							erreur.message = ERR_352_MSG;
							lVr.log.erreurs.push(erreur);						
							$(pDialog).dialog("close");	
							that.construct({vr:lVr,selectedTabs:that.mSelectedTabs});									
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	

	this.affectDialog = function(pData) {
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectListeBanque(pData);
		return pData;
	};
	
	this.affectListeBanque = function(pData) {
		var that = this;

		if(pData.find('#idBanque').length == 1) {
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
		}
		return pData;
	};
	
	this.affectSupprimerPaiement= function(pData) {
		var that = this;
		pData.find(".btn-supprimer").click(function() {that.dialogSupprimerPaiement($(this).attr("id-operation"));});		
		return pData;
	};

	this.dialogSupprimerPaiement = function(pIdOperation) {
		var that = this;
		var lOperation = this.mListeOperation[pIdOperation];
		lOperation.sigleMonetaire = gSigleMonetaire;
		
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		$(lCompteZeybuTemplate.dialogSupprimerPaiement.template(lOperation)).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:450,
			buttons: {
				'Supprimer': function() {
					that.supprimerPaiement(pIdOperation,this);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
	};
	
	this.supprimerPaiement = function(pIdOperation,pDialog) {
		var that = this;
		var lVo = { id:pIdOperation,
					fonction:"supprimer"};
		$.post(	"./index.php?m=CompteZeybu&v=SuiviPaiement", "pParam=" + $.toJSON(lVo),
			function(lResponse) {
				Infobulle.init(); // Supprime les erreurs
				if(lResponse) {
					if(lResponse.valid) {
						// Message d'information
						var lVr = new TemplateVR();
						lVr.valid = false;
						lVr.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_353_CODE;
						erreur.message = ERR_353_MSG;
						lVr.log.erreurs.push(erreur);						
						$(pDialog).dialog("close");	
						that.construct({vr:lVr,selectedTabs:that.mSelectedTabs});									
					} else {
						Infobulle.generer(lResponse,'');
					}
				}
			},"json"
		);
	};
	
	
	
	
/*	this.affectVirementSolidaire = function(pData) {
		var that = this;
		pData.find("#btn-virement-solidaire").click(function() {that.virementSolidaire(1);});
		pData.find("#btn-virement-solidaire-inverse").click(function() {that.virementSolidaire(2);});
		return pData;
	};
	
	this.virementSolidaire = function(pType) {
		var that = this;			
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.dialogVirementSolidaire;
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;
		lData.type = 2;
		if(pType == 1) {
			lData.cptDebit = "Zeybu";
			lData.cptCredit = "Solidaire";
			lData.idCptDebit = -1;
			lData.idCptCredit = -2;
		} else {
			lData.cptDebit = "Solidaire";
			lData.cptCredit ="Zeybu";
			lData.idCptDebit = -2;
			lData.idCptCredit = -1;
		}
									
		var lDialog = $(this.affectDialog($(lTemplate.template(lData)))).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:450,
			buttons: {
				'Valider': function() {
					that.envoyerVirement(this,lData);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
		lDialog.find('form').submit(function() {
			that.envoyerVirement(lDialog,lData);
			return false;
		});
	};
	
	this.affectVirement = function(pData) {
		var that = this;
		pData.find(".compte-ligne-adherent").each(function() {
			var lId = $(this).attr("id-adherent");
			$(this).find(".btn-virement").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit ="Zeybu";
				lData.cptCredit = that.listeAdherent[lId].cptLabel;
				lData.idCptDebit = -1;
				lData.idCptCredit = that.listeAdherent[lId].adhIdCompte;
				that.virement(lData);
			});
			$(this).find(".btn-virement-inverse").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit = that.listeAdherent[lId].cptLabel;
				lData.cptCredit ="Zeybu";
				lData.idCptDebit = that.listeAdherent[lId].adhIdCompte;
				lData.idCptCredit = -1;
				that.virement(lData);
			});
		});
		pData.find(".compte-ligne-producteur").each(function() {
			var lId = $(this).attr("id-producteur");	
			$(this).find(".btn-virement").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit ="Zeybu";
				lData.cptCredit = that.listeProducteur[lId].cptLabel;
				lData.idCptDebit = -1;
				lData.idCptCredit = that.listeProducteur[lId].ferIdCompte;
				that.virement(lData);
			});
			$(this).find(".btn-virement-inverse").click(function() {
				var lData = {};
				lData.type = 1;
				lData.cptDebit = that.listeProducteur[lId].cptLabel;
				lData.cptCredit ="Zeybu";
				lData.idCptDebit = that.listeProducteur[lId].ferIdCompte;
				lData.idCptCredit = -1;
				that.virement(lData);
			});
		});
		return pData;
	};
	
	this.virement = function(pData) {
		var that = this;
		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		var lTemplate = lCompteZeybuTemplate.dialogAjoutVirement;
		pData.sigleMonetaire = gSigleMonetaire;
								
		var lDialog = $(this.affectDialog($(lTemplate.template(pData)))).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:450,
			buttons: {
				'Valider': function() {
					that.envoyerVirement(this,pData);
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); }
		});
		lDialog.find('form').submit(function() {
			that.envoyerVirement(lDialog,pData);
			return false;
		});
	};
	
	this.affectDialog = function(pData) {
		pData = gCommunVue.comNumeric(pData);
		return pData;
	};
	
	this.envoyerVirement = function(pDialog,pData) {
		var lVo = new CompteZeybuAjoutVirementVO();								
		lVo.idCptDebit = pData.idCptDebit;								
		lVo.idCptCredit = pData.idCptCredit;								
		lVo.type = pData.type;
		lVo.montant = $(pDialog).find(":input[name=montant]").val().numberFrToDb();
		
		var lValid = new CompteZeybuVirementValid();
		var lVr = lValid.validAjout(lVo);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			lVo.fonction = "ajout";
			var lDialog = this;
			$.post(	"./index.php?m=CompteZeybu&v=Virements", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							// Message d'information
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_307_CODE;
							erreur.message = ERR_307_MSG;
							lVr.log.erreurs.push(erreur);
							Infobulle.generer(lVr,'');
							
							$(pDialog).dialog("close");										
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		}else {
			Infobulle.generer(lVr,'');
		}
	};*/
	
	this.construct(pParam);
}	