;function RechargementCompteTemplate() {
	this.listeAdherent = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_adherent_solde_int\">" +			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Adhérents</div>" +
						"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
							"<form id=\"filter-form\">" +
								"<div>" +
									"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
											"<span class=\"ui-icon ui-icon-search\">" +
										"</span>" +
									"</span>" +
									"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
								"</div>" +
							"</form>" +
						"</div>" +
							"<table class=\"com-table\">" +
								"<thead>" +
									"<tr class=\"ui-widget ui-widget-header\">" +
										"<th class=\"com-table-th-debut com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
										"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
										"<th class=\"com-table-th-med com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
										"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Courriel</th>" +
										"<th class=\"com-table-th-fin liste-adh-th-solde\">Solde</th>" +
									"</tr>" +
								"</thead>" +
								"<tbody>" +
							"<!-- BEGIN listeAdherent -->" +
									"<tr class=\"com-cursor-pointer compte-ligne\" id-adherent=\"{listeAdherent.adhId}\">" +
										"<td class=\"com-table-td-debut com-underline-hover\">" +
											"<span class=\"ui-helper-hidden\">{listeAdherent.adhIdTri}</span>" +
											"{listeAdherent.adhNumero}" +
										"</td>" +
										"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhNom}</td>" +
										"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhPrenom}</td>" +
										"<td class=\"com-table-td-med com-underline-hover\">{listeAdherent.adhCourrielPrincipal}</td>" +
										"<td class=\"com-table-td-fin com-underline-hover liste-adh-td-solde\"><span class=\"{listeAdherent.classSolde}\">{listeAdherent.cptSolde} {sigleMonetaire}</span></td>" +
									"</tr>" +
							"<!-- END listeAdherent -->" +
								"</tbody>" +
							"</table>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Adhérents</div>" +
				"<p id=\"texte-liste-vide\">Aucun adhérent dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogRecharger = 
		"<div title=\"Rechargement du compte {compte}\">" +
			"<div>" +
				"{numero} : {prenom} {nom}" +
			"</div>" +
			"<div>" +
				"<span>Solde : </span><span class=\"{classSolde}\" id=\"nouveau-solde\">{solde}</span> <span class=\"{classSolde}\" id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
			"</div><br/>" +
			"<div class=\"com-widget-content\">" +
				"<table>" +
					"<thead>" +
						"<tr>" +
							"<td>Montant</td>" +
							"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"montant\" maxlength=\"12\" size=\"5\"/> <span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
						"<tr id=\"ligne-operation\">" +
							"<td>Type de Paiement</td>" +
							"<td>" +
								"<select name=\"typepaiement\" id=\"typePaiement\">" +
									"<option value=\"0\">== Choisir ==</option>" +
									"<!-- BEGIN typePaiement -->" +
									"<option value=\"{typePaiement.id}\">{typePaiement.type}</option>" +
									"<!-- END typePaiement -->" +
								"</select>" +
							"</td>" +
						"</tr>" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.champComplementaire =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.label}</td>" +
				"<td>" +
					"<input type=\"text\" value=\"\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"champComplementaire{champComplementaire.id}valeur\" data-id-champ-complementaire=\"{champComplementaire.id}\" maxlength=\"50\" size=\"15\"/>" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
};function RechargerCompteVue(pParam) {
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
							that.mTypePaiement  = lResponse.typePaiement;
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
							that.mBanques = lResponse.banques;
							
							that.solde = parseFloat(lResponse.solde);
							
							lResponse.sigleMonetaire = gSigleMonetaire;
							lResponse.solde = lResponse.solde.nombreFormate(2,',',' ');
							lResponse.typePaiement = that.mTypePaiement;
							
							var lCompte = lResponse.idCompte;
							
							var lRechargementCompteTemplate = new RechargementCompteTemplate();
							that.affectDialog($(lRechargementCompteTemplate.dialogRecharger.template(lResponse))).dialog({
								autoOpen: true,
								modal: true,
								draggable: false,
								resizable: false,
								width:350,
								buttons: {
									'Valider': function() {
								
										var lVo = that.getRechargementVO();									
										lVo.idCompte = lCompte;
										
										var lValid = new OperationDetailValid();
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
		pData = gCommunVue.comNumeric(pData);
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
		if(!this.mTypePaiement[lId] || (this.mTypePaiement[lId] && this.mTypePaiement[lId].champComplementaire.length == 0)) {
			$('.champ-complementaire').remove();
		} else {
			var lRechargementCompteTemplate = new RechargementCompteTemplate();
			var lTypePaiementService = new TypePaiementService();
			$('#ligne-operation').after(lTypePaiementService.affect($(lRechargementCompteTemplate.champComplementaire.template(this.mTypePaiement[lId])),this.mBanques));
		}
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
		var lVo = new OperationDetailVO();
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		if(!isNaN(lMontant) && !lMontant.isEmpty()){
			lMontant = parseFloat(lMontant);
		}
		lVo.montant = lMontant;
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		
		if(this.mTypePaiement[lVo.typePaiement]) {
			var lTypePaiementService = new TypePaiementService();
			lVo.champComplementaire = lTypePaiementService.getChampComplementaire(this.mTypePaiement[lVo.typePaiement].champComplementaire);
		}
		return lVo;
	};
	
	this.construct(pParam);
}