;function CaisseTemplate() {
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
								"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr>" +
								"<td class=\"com-table-td com-text-align-right\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td lst-resa-btn-commander\">" +
									"<button class=\"btn-marche ui-state-default ui-corner-all com-button com-center\" id=\"{commande.id}\" >Vente</button>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +	
				"</div>" +				
			"</div>" +
		"</div>";

	this.listeCommandeVide =
	"<div id=\"contenu\">" +
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
			"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
		"</div>" +
	"</div>";
	
	this.listeMarcheVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente</div>" +
				"<p id=\"texte-liste-vide\">Aucun adhérent.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeAdherentCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente du Marché n°{numeroMarche}</div>" +
					"<div class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"<form id=\"filter-form\"> " +
							"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
									"<span class=\"ui-icon ui-icon-search\">" +
								"</span>" +
							"</span>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
						"</form>" +
					"</div>" +
					"<table class=\"com-table\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th com-underline-hover marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th com-underline-hover marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th com-underline-hover marche-com-th-nom\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
							"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
						"<!-- BEGIN listeAdherentCommande -->" +
						"<tr class=\"com-cursor-pointer achat-commande-ligne\" >" +							
							"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherentCommande.adhId}</span>{listeAdherentCommande.adhNumero}</td>" +
							"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.cptLabel}</td>" +
							"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhNom}</td>" +
							"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhPrenom}</td>" +
						"</tr>" +
						"<!-- END listeAdherentCommande -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.achatCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"vente-info-adherent\" class=\"com-float-left com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente du Marché n°{comNumero}</div>" +
				"<div id=\"vente-achat-info-marche\">" +
				"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
				"N° de Compte : {adhCompte}" +
				"</div>" +
				"<div>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span><br/>" +
					"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-float-left\" id=\"achat-rechgt-widget\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Rechargement du compte</div>" +
				"<div class=\"com-widget-content\">" +
					"<table>" +
						"<thead>" +
							"<tr>" +
								"<th>Montant</th>" +
								"<th>Type de Paiement</th>" +
								"<th id=\"label-champ-complementaire\"></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<tr>" +
								"<td><input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"rechargementmontant\" maxlength=\"12\" size=\"3\"/> <span>{sigleMonetaire}</span></td>" +
								"<td class=\"com-center\">" +
									"<select name=\"typepaiement\" id=\"rechargementtypePaiement\">" +
										"<option value=\"0\">== Choisir ==</option>" +
										"<!-- BEGIN typePaiement -->" +
										"<option value=\"{typePaiement.tppId}\">{typePaiement.tppType}</option>" +
										"<!-- END typePaiement -->" +
									"</select>" +
								"</td>" +
								"<td id=\"td-champ-complementaire\"><input type=\"text\" name=\"champ-complementaire\" value=\"\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +			
			"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<span>Total Marché : <span id=\"total-global\"></span> {sigleMonetaire}</span>" +
			"</div>" +
			
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-widget\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
				"<div class=\"com-widget-content\">" +
				"<table class=\"achat-commande-table-pdt\">" +
					"<thead>" +
						"<tr>" +
							"<th colspan=\"3\"></th>" +
							"<th colspan=\"2\" class=\"table-vente-quantite\">Quantité</th>" +
							"<th colspan=\"2\" class=\"table-vente-prix\">Prix</th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
					"<!-- BEGIN categories -->" +
						"<tr>" +
							"<td class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
							"<td colspan=\"6\"></td>" +
						"</tr>" +
						"<!-- BEGIN categories.produits -->" +
						"<tr class=\"ligne-produit\">" +
							"<td class=\"table-vente-produit\"><span class=\"produit-id ui-helper-hidden\">{categories.produits.proId}</span>{categories.produits.nproNom}</td>" +
							
							"<td class=\"table-vente-lot\">" +
								"<select id=\"lot-{categories.produits.proId}\">" +
									"<!-- BEGIN categories.produits.lot -->" +
									"<option value=\"{categories.produits.lot.dcomId}\">par {categories.produits.lot.dcomTaille} {categories.produits.proUniteMesure}</option>" +
									"<!-- END categories.produits.lot -->" +
								"</select>" +
							"</td>" +
							"<td class=\"table-vente-prix-unitaire\" >à <span id=\"prix-unitaire-{categories.produits.proId}\">{categories.produits.prixUnitaire}</span> {sigleMonetaire}/{categories.produits.proUniteMesure}</td>" +
							
							
							"<td class=\"com-text-align-right\"><input type=\"text\" value=\"{categories.produits.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"produits{categories.produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td class=\"\">{categories.produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right \" ><input type=\"text\" value=\"{categories.produits.proPrix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"produits{categories.produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
						"<!-- END categories.produits -->" +
					"<!-- END categories -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"4\"></td>" +
							"<td class=\"com-text-align-right\" >Total :</td>" +
							"<td class=\"com-text-align-right\" ><span id=\"total-achat\">{total}</span></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
		
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-solidaire-widget\" >" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat Solidaire</div>" +
				"<div class=\"com-widget-content\">" +
				"<table class=\"achat-commande-table-pdt\">" +
					"<thead>" +
						"<tr>" +
							"<th colspan=\"3\"></th>" +
							"<th colspan=\"2\" class=\"table-vente-quantite\">Quantité</th>" +
							"<th colspan=\"2\" class=\"table-vente-prix\">Prix</th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
					"<!-- BEGIN categoriesSolidaire -->" +
						"<tr>" +
							"<td class=\"ui-widget-header ui-corner-all com-center\">{categoriesSolidaire.nom}</td>" +
							"<td colspan=\"6\"></td>" +
						"</tr>" +
						"<!-- BEGIN categoriesSolidaire.produits -->" +
						"<tr class=\"ligne-produit-solidaire\">" +
							"<td class=\"table-vente-produit\"><span class=\"produit-id ui-helper-hidden\">{categoriesSolidaire.produits.proId}</span>{categoriesSolidaire.produits.nproNom}</td>" +
							
							
							
							"<td class=\"table-vente-lot\">" +
								"<select id=\"lot-solidaire-{categoriesSolidaire.produits.proId}\">" +
									"<!-- BEGIN categoriesSolidaire.produits.lot -->" +
									"<option value=\"{categoriesSolidaire.produits.lot.dcomId}\">par {categoriesSolidaire.produits.lot.dcomTaille} {categoriesSolidaire.produits.proUniteMesure}</option>" +
									"<!-- END categoriesSolidaire.produits.lot -->" +
								"</select>" +
							"</td>" +
							"<td class=\"table-vente-prix-unitaire\" >à <span id=\"prix-unitaire-solidaire-{categoriesSolidaire.produits.proId}\">{categoriesSolidaire.produits.prixUnitaire}</span> {sigleMonetaire}/{categoriesSolidaire.produits.proUniteMesure}</td>" +
							

							
							"<td class=\"com-text-align-right\"><input type=\"text\" value=\"0\" class=\"com-numeric produit-solidaire-quantite com-input-text ui-widget-content ui-corner-all\" id=\"produitsSolidaire{categoriesSolidaire.produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td>{categoriesSolidaire.produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right\" ><input type=\"text\" value=\"0\" class=\"com-numeric produit-solidaire-prix com-input-text ui-widget-content ui-corner-all\" id=\"produitsSolidaire{categoriesSolidaire.produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
						"<!-- END categoriesSolidaire.produits -->" +
					"<!-- END categoriesSolidaire -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"4\"></td>" +
							"<td class=\"com-text-align-right\" >Total :</td>" +
							"<td class=\"com-text-align-right\" ><span id=\"total-achat-solidaire\">0,00</span></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button type=\"button\" id=\"btn-annuler\" class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\">Annuler</button>" +
				"<button type=\"button\" class=\"ui-helper-hidden com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-modifier\">Modifier</button>" +
				"<button type=\"button\" id=\"btn-valider\" class=\"ui-state-default ui-corner-all com-button com-center\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.achatCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Achat effectué avec succès.<br/><br/>" +
						"<button id=\"btn-annuler\" class=\"ui-state-default ui-corner-all com-button com-center\">Retourner à la liste des adhérents</button>" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.lotUnique = 
		"<input type=\"hidden\" id=\"lot-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.lotUniqueSolidaire = 
		"<input type=\"hidden\" id=\"lot-solidaire-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
};function CaisseListeCommandeVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CaisseListeCommandeVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=Caisse&v=CaisseListeCommande", 
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
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lCaisseTemplate = new CaisseTemplate();
		if(lResponse.listeCommande.length > 0 && lResponse.listeCommande[0].id != null) {
		
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = {};
					lCommande.id = this.id;
					lCommande.numero = this.numero;
					lCommande.dateFinReservation = this.dateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.dateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.dateFinReservation.extractDbMinute();
					
					lCommande.dateMarcheDebut = this.dateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.dateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.dateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.dateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.dateMarcheFin.extractDbMinute();
	
					lListeCommande.commande.push(lCommande);
				});
			
			var lTemplate = lCaisseTemplate.listeCommandePage;
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeCommande))));
		} else {
			$('#contenu').replaceWith(that.affect($(lCaisseTemplate.listeCommandeVide)));
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectLienMarche(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.btn-marche').click(function() {
			var lparam = {"id_commande":$(this).attr('id')};
			CaisseMarcheCommandeVue(lparam);
		});
		return pData;
	}	
	this.construct(pParam);
};function CaisseMarcheCommandeVue(pParam) {
	this.idCommande = null;
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = "listeReservation";
		$.history( {'vue':function() {CaisseMarcheCommandeVue(pParam);}} );
		$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(pParam),
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
		this.idCommande = pParam.id_commande;
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lCaisseTemplate = new CaisseTemplate();
				
				if(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null) {
					var lTemplate = lCaisseTemplate.listeAdherentCommandePage;
					pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
					$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
				} else {
					$('#contenu').replaceWith(lCaisseTemplate.listeMarcheVide);
				}
			} else {
				var lVr = new TemplateVR();
				lVr.valid = false;
				lVr.log.valid = false;				
				var erreur = new VRerreur();
				erreur.code = ERR_211_CODE;
				erreur.message = ERR_211_MSG;
				lVr.log.push(erreur);
				Infobulle.generer(lVr,'');
			}
		} else {
			Infobulle.generer(pResponse,'');
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienAchat(pData);
		return pData;
	}
	
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[2,0]] });
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	}
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lParam = {	id_commande:that.idCommande,
							id_adherent:$(this).find(".id-adherent").text()};
			CaisseAchatCommandeVue(lParam);
		});
		return pData;
	}
	
	this.construct(pParam);
};function CaisseAchatCommandeVue(pParam) {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.mListeLot = [];
	this.mTypePaiement = [];
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	this.total = 0;
	this.totalSolidaire = 0;
	
	this.pdtCommande = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CaisseAchatCommandeVue(pParam);}} );
		var that = this;		 // TODO gestion avec param pour le server aussi
		this.idCommande = pParam.id_commande;
		this.idAdherent = pParam.id_adherent;

		pParam.fonction = "infoAchat";
		$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {						
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.idCompte = lResponse.adherent.adhIdCompte;
							that.pdtCommande = lResponse.marche.produits;			
							
							$(lResponse.typePaiement).each(function() {
								that.mTypePaiement[this.tppId] = this;
							});
	
							that.solde = parseFloat(lResponse.adherent.cptSolde);
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			var that = this;
			var lCaisseTemplate = new CaisseTemplate();
			var lTemplate = lCaisseTemplate.achatCommandePage;
			
			var lData = new Object();
			lData.comNumero = pResponse.marche.numero;
			
			lData.adhNumero = pResponse.adherent.adhNumero;
			lData.adhCompte = pResponse.adherent.cptLabel;
			lData.adhNom = pResponse.adherent.adhNom;
			lData.adhPrenom = pResponse.adherent.adhPrenom;
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			
		//	lData.produits = [];
			lData.categories = [];
		//	lData.produitsSolidaire = new Array();
			lData.categoriesSolidaire = [];
			
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lProduitCommande = this;
					var lProduit = {};
					lProduit.proId = this.id;
					lProduit.nproNom = this.nom;
					lProduit.proUniteMesure = this.unite;
					lProduit.stoQuantite = 0;
					lProduit.proPrix = 0;
					lProduit.lot = [];
	
					var lPrix = 0;
					$.each(this.lots, function() {
						if(this.id) {
							var lLot = {};
							lLot.dcomId = this.id;
							lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
							lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
							lPrix = parseFloat(this.prix);
							lStoQuantite = parseFloat(this.taille);
							
							//var lIdLot = this.id;
							$(pResponse.reservation).each(function() {
								if(this.idDetailCommande == lLot.dcomId) {
									lProduit.stoQuantite = this.quantite * -1;
									//lStoQuantite = lProduit.stoQuantite;
									lPrix = this.montant * -1;
									lProduit.proPrix = lPrix.nombreFormate(2,',',' ');
									
									//lLot.stoQuantiteReservation = lProduit.stoQuantite;
									lLot.prixReservation = lPrix;
									
									// Permet de cocher le lot correspondant à la résa
									//lLotReservation = this.id;
									//lLot.checked = 'checked="checked"';
									that.mListeLot.push({idPdt:lProduit.proId,idLot:lLot.dcomId})
								}											
							});
							
							lProduit.prixUnitaire = (lPrix / lStoQuantite).nombreFormate(2,',',' '); 						
							
							//lProduit.stoQuantiteReservation = lProduit.stoQuantite.nombreFormate(2,',',' ');
							//lProduit.prixReservation = lLot.prixReservation.nombreFormate(2,',',' ');
										
							lProduit.lot.push(lLot);
						}
					});
					lData.total += lPrix;
					
					if(!lData.categories[this.idCategorie]) {
						lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
					}
					lData.categories[this.idCategorie].produits.push(lProduit);
					//lData.produits.push(lProduit);

					$(pResponse.stockSolidaire).each(function() {
						if(lProduit.proId == this.proId){
							if(!lData.categoriesSolidaire[lProduitCommande.idCategorie]) {
								lData.categoriesSolidaire[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
							}
							lData.categoriesSolidaire[lProduitCommande.idCategorie].produits.push(lProduit);
							
							//lData.produitsSolidaire.push(lProduit);
						}
					});
				}
			});
						
			lData.adhSolde = this.solde;
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');
			lData.total = lData.total.nombreFormate(2,',',' ');
			that.total = lData.total; 
			
			lData.typePaiement = that.mTypePaiement;

			$('#contenu').replaceWith( that.affect($(lTemplate.template(lData))) );
			that.changerTypePaiement($(":input[name=typepaiement]"));
			that.majNouveauSolde();
		} else {
			Infobulle.generer(pResponse,'');
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectNouveauPrixProduit(pData);
		pData = this.affectChampComplementaire(pData);
		pData = this.affectValider(pData);
		pData = this.affectAnnuler(pData);
		pData = this.affectModifier(pData);
		pData = this.affectSupprimerPdt(pData);
		pData = this.supprimerSelect(pData);
		pData = this.affectChangementLot(pData);
		pData = this.selectLot(pData);
		pData = this.affectInitLot(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.selectLot = function(pData) {
		$(this.mListeLot).each(function() {
			pData.find('#lot-' + this.idPdt).selectOptions( this.idLot);
		});
		return pData;
	}
	
	this.supprimerSelect = function(pData) {
		pData.find('.ligne-produit select').each(function() {
			if($(this).find('option').size() == 1) {				
				var lCaisseTemplate = new CaisseTemplate();
				var lTemplate = lCaisseTemplate.lotUnique;
				var lData = {};
				lData.IdPdt = $(this).parent().parent().find(".produit-id").text();
				lData.valeur = $(this).val();
				lData.text = $(this).text();
				
				$(this).replaceWith(lTemplate.template(lData));
			}
		});
		
		pData.find('.ligne-produit-solidaire select').each(function() {
			if($(this).find('option').size() == 1) {				
				var lCaisseTemplate = new CaisseTemplate();
				var lTemplate = lCaisseTemplate.lotUniqueSolidaire;
				var lData = {};
				lData.IdPdt = $(this).parent().parent().find(".produit-id").text();
				lData.valeur = $(this).val();
				lData.text = $(this).text();
				
				$(this).replaceWith(lTemplate.template(lData));
			}
		});
		return pData;
	}
	
	this.affectInitLot = function(pData) {
		var that = this;
		pData.find('.ligne-produit select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".produit-id").text();
			var lIdLot = $(this).val();

			if(that.pdtCommande[lIdPdt].lots[lIdLot]) {
				var lPrix = that.pdtCommande[lIdPdt].lots[lIdLot].prix;
				var lQte = that.pdtCommande[lIdPdt].lots[lIdLot].taille;
				var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
				
				$(pData).find('#prix-unitaire-' + lIdPdt).text(lprixUnitaire);
			}
		});
		pData.find('.ligne-produit-solidaire select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".produit-id").text();
			var lIdLot = $(this).val();

			if(that.pdtCommande[lIdPdt].lots[lIdLot]) {
				var lPrix = that.pdtCommande[lIdPdt].lots[lIdLot].prix;
				var lQte = that.pdtCommande[lIdPdt].lots[lIdLot].taille;
				var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
				
				$(pData).find('#prix-unitaire-solidaire-' + lIdPdt).text(lprixUnitaire);
			}
		});
		return pData;
	}
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.ligne-produit select').change(function() {
			that.changerLot($(this).parent().parent().find(".produit-id").text(),$(this).val());
		});
		pData.find('.ligne-produit-solidaire select').change(function() {
			that.changerLotSolidaire($(this).parent().parent().find(".produit-id").text(),$(this).val());
		});
		return pData;
	}
	
	this.changerLot = function(pIdPdt,pIdLot) {
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		var lQte = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-' + pIdPdt).text(lprixUnitaire);
		$('#produits' + pIdPdt +'quantite,#produits' + pIdPdt + 'prix').val(0);		
	}
	
	this.changerLotSolidaire = function(pIdPdt,pIdLot) {
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		var lQte = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-solidaire-' + pIdPdt).text(lprixUnitaire);
		$('#produitsSolidaire' + pIdPdt +'quantite,#produitsSolidaire' + pIdPdt + 'prix').val(0);		
	}
		
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
			that.controlerAchat();
		});
		return pData;
	}
	
	this.affectNouveauSolde = function(pData) {
		var that = this;
		pData.find(":input[name=montant-rechargement], .produit-prix").keyup(function() {
			that.majNouveauSolde();	
			that.controlerAchat();
		});
		pData.find(".produit-solidaire-prix").keyup(function() {
			that.majNouveauSoldeSolidaire();	
			that.controlerAchat();
		});
		return pData;
	}
		
	this.affectNouveauPrixProduit = function(pData) {
		var that = this;
		pData.find(".produit-quantite").keyup(function() {
				that.majPrixProduit($(this));
				that.controlerAchat();
		});
		pData.find(".produit-solidaire-quantite").keyup(function() {
			that.majPrixProduitSolidaire($(this));
			that.controlerAchat();
		});
		return pData;
	}
	
	this.affectChampComplementaire = function(pData) {
		var that = this;
		pData.find(":input[name=champ-complementaire]").keyup(function() {that.controlerAchat();});		
		return pData;
	}
	
	this.affectValider = function(pData) {
		var that = this;
		pData.find("#btn-valider").click(function() {that.creerRecapitulatif();});		
		return pData;
	}
	
	this.affectAnnuler = function(pData) {
		var that = this;
		pData.find("#btn-annuler").click(function() {that.retourListe();});		
		return pData;
	}
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find("#btn-modifier").click(function() {that.boutonModifier();});		
		return pData;
	}
	
	this.affectSupprimerPdt = function(pData) {
		if(pData.find(".ligne-produit").size() == 0) {
			pData.find("#achat-pdt-widget").remove();
		}
		if(pData.find(".ligne-produit-solidaire").size() == 0) {
			pData.find("#achat-pdt-solidaire-widget").remove();
		}
		return pData;
	}
	
	this.majPrixProduit = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		var lIdProduit = ligne.find(".produit-id").text();
		var lIdLot = ligne.find('#lot-'+lIdProduit).val();

		var lPrix = this.pdtCommande[lIdProduit].lots[lIdLot].prix;
		var lQte = this.pdtCommande[lIdProduit].lots[lIdLot].taille;
		var lprixUnitaire = lPrix / lQte; 
		
		var lNvPrix = (lprixUnitaire * lQuantite).toFixed(2);
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		if(lNvPrix != 0) {
			ligne.find(".produit-prix").val(lNvPrix.nombreFormate(2,',',' '));
		} else {
			ligne.find(".produit-prix").val(0);
		}
		
		this.majNouveauSolde();		
	}
	
	this.majPrixProduitSolidaire = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		
		var lIdProduit = ligne.find(".produit-id").text();
		var lIdLot = ligne.find('#lot-solidaire-'+lIdProduit).val();

		var lPrix = this.pdtCommande[lIdProduit].lots[lIdLot].prix;
		var lQte = this.pdtCommande[lIdProduit].lots[lIdLot].taille;
		var lprixUnitaire = lPrix / lQte; 
		
		var lNvPrix = (lprixUnitaire * lQuantite).toFixed(2);
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		if(lNvPrix != 0) {
			ligne.find(".produit-solidaire-prix").val(lNvPrix.nombreFormate(2,',',' '));
		} else {
			ligne.find(".produit-solidaire-prix").val(0);
		}
		
		this.majNouveauSoldeSolidaire();		
	}
	
	/*this.nouvelleQuantite = function(pIdPdt,pIdLot,pQte) {
		// La quantité max soit qte max soit stock
		//var lMax = this.pdtCommande[pIdPdt].qteMaxCommande;
		//var lStock = this.pdtCommande[pIdPdt].stockReservation;
		//if(parseFloat(lStock) < parseFloat(lMax)) { lMax = lStock; }
		
		var lTaille = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		
		// Récupère le nombre de lot réservé
		/*var lQteReservation = 0;
		if(this.reservation[pIdPdt] && (this.reservation[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = this.reservation[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;*/
		
		/*var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		//if(lNvQteReservation > 0 && lNvQteReservation <= lMax) {
			var lNvPrix = 0;
			lNvPrix = (lQteReservation * lPrix).toFixed(2);
			
			// Mise à jour de la quantite reservée
			this.reservation[pIdPdt].stoQuantite = lNvQteReservation;			
			
			//$('#qte-pdt-' + pIdPdt).text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt).text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

			this.majTotal();
	}*/
	
	this.controlerAchat = function() {
		Infobulle.init(); // Supprime les erreurs
		var lValid = new AchatCommandeValid();
		var lVr = lValid.validAjout(this.getAchatCommandeVO());
		Infobulle.generer(lVr,'');
		return lVr;
	}
			
	this.majTotal = function() {
		var lTotal = this.calculerTotal();
		$("#total-achat").text(lTotal.nombreFormate(2,',',' '));
		this.total = lTotal;
		this.majTotalGlobal();		
	}
	
	this.majTotalSolidaire = function() {
		var lTotalSolidaire = this.calculerTotalSolidaire();
		$("#total-achat-solidaire").text(lTotalSolidaire.nombreFormate(2,',',' '));
		this.totalSolidaire = lTotalSolidaire;
		this.majTotalGlobal();		
	}
	
	this.majTotalGlobal = function() {
		var lTotal = this.totalSolidaire + this.total;
		$("#total-global").text(lTotal.nombreFormate(2,',',' '));
	}
	
	this.calculerTotal = function() {
		var lTotal = 0;
		$(".produit-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	}
	
	this.calculerTotalSolidaire = function() {
		var lTotal = 0;
		$(".produit-solidaire-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	}
	
	this.majNouveauSolde = function() {
		this.majTotal();
		var lTotal = this.calculNouveauSolde();
		if(lTotal <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lTotal.nombreFormate(2,',',' '));
	}
	
	this.majNouveauSoldeSolidaire = function() {
		this.majTotalSolidaire();
		var lTotal = this.calculNouveauSolde();
		if(lTotal <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lTotal.nombreFormate(2,',',' '));
	}
	
	this.calculNouveauSolde = function() {
		var lAchats = this.total;// parseFloat($("#total-achat").val().numberFrToDb());
		if(isNaN(lAchats)) {lAchats = 0;}
		var lAchatsSolidaire = this.totalSolidaire; //parseFloat($("#total-achat-solidaire").val().numberFrToDb());
		if(isNaN(lAchatsSolidaire)) {lAchatsSolidaire = 0;}
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}		
		return this.solde - lAchats - lAchatsSolidaire + lRechargement;
	}
		
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel).show();
			$("#td-champ-complementaire").show();
		} else {
			$("#label-champ-complementaire").text('').hide();
			$(":input[name=champ-complementaire]").val('');
			$("#td-champ-complementaire").hide();
		}
	}
		
	this.getLabelChamComplementaire = function(pId) {
		var lTpp = this.mTypePaiement;
		if(lTpp[pId]) {
			if(lTpp[pId].tppChampComplementaire == 1) {
				return lTpp[pId].tppLabelChampComplementaire;
			}
		}	
		return null;
	}
	
	this.getAchatCommandeVO = function() {
		var lVo = new AchatCommandeVO();
		lVo.id = this.idCommande;
		lVo.idCompte = this.idCompte;
		lVo.produits = this.getProduitsVO();
		lVo.produitsSolidaire = this.getProduitsSolidaireVO();
		lVo.rechargement = this.getRechargementVO();		
		//lVo.NbProduits = $('.ligne-produit').size();
		//lVo.NbProduitsSolidaire = $('.ligne-produit-solidaire').size();		
		return lVo;
	}	
	
	this.getProduitsVO = function() {
		var lVo = new Array();		
		$(".ligne-produit").each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).find(".produit-id").text();			
			var lQuantite = $(this).find(".produit-quantite").val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty() && lQuantite != 0){
				lQuantite = parseFloat(lQuantite);
				lVoProduit.quantite = lQuantite * -1;			
			
				var lprix = $(this).find(".produit-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0){
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
				}
				lVo.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0) {
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lVo.push(lVoProduit);
				}
			}		
		});		
		return lVo;
	}
	
	this.getProduitsSolidaireVO = function() {
		var lVo = new Array();		
		$(".ligne-produit-solidaire").each(function() {
			var lVoProduit = new ProduitAchatVO();
			lVoProduit.id = $(this).find(".produit-id").text();			
			var lQuantite = $(this).find(".produit-solidaire-quantite").val().numberFrToDb();
			if(!isNaN(lQuantite) && !lQuantite.isEmpty() && lQuantite != 0){
				lQuantite = parseFloat(lQuantite);
				lVoProduit.quantite = lQuantite * -1;
			
				var lprix = $(this).find(".produit-solidaire-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0){
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
				}
				lVo.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-solidaire-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0){
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lVo.push(lVoProduit);
				}
			}	
		});		
		return lVo;
	}
	
	this.getRechargementVO = function() {
		var lVo = new RechargementCompteVO();		
		var lMontant = $(":input[name=montant-rechargement]").val().numberFrToDb();
		lVo.id = this.idCompte;

		if(!isNaN(lMontant) && !lMontant.isEmpty() && lMontant != 0){
			lMontant = parseFloat(lMontant);
			lVo.montant = lMontant;
		}
		lVo.typePaiement = $(":input[name=typepaiement]").val();
		if(this.getLabelChamComplementaire(lVo.typePaiement) != null) {
			lVo.champComplementaireObligatoire = 1;
			lVo.champComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lVo.champComplementaireObligatoire = 0;
		}
		return lVo;
	}
	
	this.creerRecapitulatif = function() {
		var lVr = this.controlerAchat();
		if(lVr.valid) {
			if(this.etapeValider == 0) {
				$(".produit-quantite,.produit-solidaire-quantite,#rechargementchampComplementaire,#rechargementtypePaiement").each(function() {$(this).inputToText();});
				$(".produit-prix,.produit-solidaire-prix,#rechargementmontant").each(function() {$(this).inputToText("montant");});
				$("#btn-modifier").show();
				$("#btn-annuler").hide();
				this.etapeValider = 1;
			} else if(this.etapeValider == 1) {
				this.enregistrerAchat();
			}
		}
	}
	
	this.enregistrerAchat = function() {
		var that = this;
		var lVo = this.getAchatCommandeVO();
		lVo.fonction = "acheter";
		$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour) {
						if(lVoRetour.valid) {
							var lCaisseTemplate = new CaisseTemplate();
							var lTemplate = lCaisseTemplate.achatCommandeSucces;
							$('#contenu').replaceWith(that.affectAnnuler($(lTemplate)));
						} else {
							that.boutonModifier();
							Infobulle.generer(lVoRetour,"");
						}
						that.etapeValider = 0;
					}
				},"json"
			);
	}
	
	this.boutonModifier = function() {
		if(this.etapeValider == 1) {
			$(".produit-prix,.produit-solidaire-prix,#rechargementmontant,.produit-quantite,.produit-solidaire-quantite,#rechargementchampComplementaire,#rechargementtypePaiement").each(function() {$(this).textToInput();});
			$("#btn-modifier").hide();
			$("#btn-annuler").show();
			this.etapeValider = 0;
		}
	}
	
	this.retourListe = function() {
		CaisseMarcheCommandeVue({id_commande:this.idCommande});
	}
	
	this.construct(pParam);
}