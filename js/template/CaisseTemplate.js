;function CaisseTemplate() {
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-center\" colspan=\"2\">N°</th>" +
								"<th class=\"com-table-th-med\">Marché</th>	" +
								"<th class=\"com-table-th-med\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th-fin\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr class=\"com-cursor-pointer btn-marche\" id=\"{commande.id}\">" +
								"<td class=\"com-table-td-debut lst-resa-th-num com-text-align-right\">{commande.numero} : </td>" +
								"<td class=\"com-table-td-med lst-resa-td-nom\">{commande.nom}</td>" +
								"<td class=\"com-table-td-med\">Le {commande.jourMarcheDebut} {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td-med\">Le {commande.jourFinReservation} {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td-fin\">" +
									"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
										"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
									"</span>" +
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
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">{venteTitre}</div>" +
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
							"<tr class=\"ui-widget ui-widget-header com-cursor-pointer achat-commande-ligne\" id-adherent=\"0\" >" +
								"<th class=\"com-table-th com-underline-hover com-center\">Compte invité</th>" +
							"</tr>" +
						"</thead>" +
					"</table>" +
					"<table class=\"com-table\" id=\"liste-adherent\">" +
						"<thead>" +
						"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
							"<th class=\"com-table-th-debut com-underline-hover marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th-med com-underline-hover marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th-med com-underline-hover marche-com-th-nom\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
							"<th class=\"com-table-th-med com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
							"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
						"<!-- BEGIN listeAdherentCommande -->" +
						"<tr class=\"com-cursor-pointer achat-commande-ligne\" id-adherent=\"{listeAdherentCommande.adhId}\">" +							
							"<td class=\"com-table-td-debut com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeAdherentCommande.adhIdTri}</span>" +
								"{listeAdherentCommande.adhNumero}" +
							"</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeAdherentCommande.cptIdTri}</span>" +
								"{listeAdherentCommande.cptLabel}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherentCommande.adhNom}</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherentCommande.adhPrenom}</td>" +
							"<td class=\"com-table-td-fin\">" +
								"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\">" +
									"<span class=\"ui-icon ui-icon-triangle-1-e\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
						"<!-- END listeAdherentCommande -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeAdherentVenteMarcheTitre = "Vente du Marché n°{numeroMarche}";
	this.listeAdherentVenteTitre = "Vente";
	
	this.achatMarchePage = 
	"<div id=\"contenu\">" +
		"{formulaire}" +
		"{detail}" +
		"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
			"<button type=\"button\" id=\"btn-annuler\" class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\">Annuler</button>" +
			"<button type=\"button\" id=\"btn-modifier\" class=\"ui-helper-hidden com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\">Modifier</button>" +
			"<button type=\"button\" id=\"btn-confirmer\" class=\"btn-valider ui-state-default ui-corner-all com-button com-center\">Confirmer</button>" +
			"<button type=\"button\" id=\"btn-enregistrer\" class=\"btn-valider ui-helper-hidden ui-state-default ui-corner-all com-button com-center\">Enregistrer</button>" +
		"</div>" +
	"</div>";
	
	
	this.achatMarcheSelectLot =
		"<span>" +
			"<select id=\"select-{nproId}{type}\" class=\"select-lot\" data-unite=\"{unite}\" data-id-nom-produit=\"{nproId}\" data-type=\"{type}\" >" +
				"<!-- BEGIN lots -->" +
				"<option {lots.selected} value=\"{lots.id}\">par {lots.tailleAffiche} {unite}</option>" +
				"<!-- END lots -->" +
			"</select>" +
		"</span>";
	
	this.achatMarcheAfficheLot = "<span data-id-lot=\"{id}\">par {tailleAffiche} {unite}</span>";
	
	this.achatMarchePrixUnitaire = 
		"à <span id=\"prix-unitaire-{nproId}\">{prixUnitaire}</span>" +
		" {sigleMonetaire}/{unite}";
	
	this.achatMarcheIdentiteAdherent = "{adhNumero} : {adhPrenom} {adhNom}";
	this.achatMarcheIdentiteInvite = "Invité";	
	this.achatMarcheEtatCompte = "{cptLabel} : <span id=\"solde\" class=\"{adhSoldeEtatClass}\">{adhSolde}</span> <span id=\"solde-sigle\" class=\"{adhSoldeEtatClass}\">{sigleMonetaire}</span>";
	this.achatMarcheEtatCompteInvite = "Compte Invité";
	this.achatMarcheLabelRechargement = "Recharger";
	this.achatMarcheLabelPaiement = "Paiement";
	this.achatMarcheLabelTotal = "Total";
	this.achatMarcheLabelMarche = "Marché N° {numero}";
	
	this.achatInfoAdherent = 	
			"<div id=\"info-adherent-widget\" class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +	
				"<table>" +
					"<tbody>" +
						"<tr>" +
							"<td colspan=\"2\" class=\"info-adherent-cellule-nom-adherent\">" +
								"<div class=\"info-adherent-cellule ui-widget-header ui-corner-all\">{identite}</div>" +
							"</td>" +
							"<td class=\"info-adherent-cellule-achat\">" +
								"<div class=\"info-adherent-cellule ui-widget-header ui-corner-all\" >{etatCompte}</div>" +
							"</td>" +
							"<td id=\"ligne-rechargement\" class=\"info-adherent-cellule-achat\">" +
								"<div id=\"cellule-recharger\" class=\"info-adherent-cellule ui-widget-header ui-corner-all\">" +
									"{labelRecharger} : " +
									"<span class=\"form-produit ui-helper-hidden\" id=\"rechargement-affiche\"></span>" +
									"<input type=\"text\" name=\"montant-rechargement\" value=\"{rechargementMontant}\" class=\"form-produit com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"rechargementmontant\" maxlength=\"12\" size=\"9\"/> {sigleMonetaire}" +
								"</div>" +
								"<div id=\"select-typePaiement\" class=\"info-adherent-cellule-achat ui-widget ui-widget-content ui-helper-hidden ui-corner-bottom\">" +
									"<table id=\"form-select-typePaiement\">" +
										"<tr id=\"ligne-operation\" >" +
											"<td>Paiement</td>" +
											"<td>" +
												"<select name=\"typepaiement\" id=\"rechargementtypePaiement\" class=\"form-produit\">" +
													"<option value=\"0\">== Choisir ==</option>" +
													"<!-- BEGIN typePaiement -->" +
													"<option value=\"{typePaiement.id}\" {typePaiement.selected} >{typePaiement.type}</option>" +
													"<!-- END typePaiement -->" +
												"</select>" +
											"</td>" +
										"</tr>" +
										"{champComplementaire}" +
									"</table>" + 
								"</div>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"{adhesion}" +
							"<td class=\"info-adherent-cellule-achat\" {colspan}>" +
								"<div class=\"info-adherent-cellule ui-widget-header ui-corner-all\">{labelTotal} : <span id=\"total\">{total}</span> {sigleMonetaire}</div>" +
							"</td>" +
							"<td>" +
								"<div class=\"info-adherent-cellule ui-widget-header ui-corner-all\">Achat : <span id=\"total-achat\">{totalAchat}</span> {sigleMonetaire}</div>" +
							"</td>" +
							"<td>" +
								"<div class=\"info-adherent-cellule ui-widget-header ui-corner-all\">Solidaire : <span id=\"total-achat-solidaire\">{totalAchatSolidaire}</span> {sigleMonetaire}</div>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<td>" +
								"<div id=\"recherche-produit\" class=\"recherche-produit-achat-marche ui-widget ui-widget-header ui-corner-all\" >" +
									"<span id=\"icon-recherche\" class=\"conteneur-icon com-float-left ui-widget-content ui-widget-content-transparent ui-corner-left\" title=\"Chercher\">" +
										"<span class=\"ui-icon ui-icon-search\"></span>" +
									"</span>" +
									"<input id=\"input-rechercher\" class=\"com-input-text ui-widget-content ui-widget-content-transparent\" name=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
									"<span id=\"icon-annuler-recherche\" class=\"com-cursor-pointer conteneur-icon com-float-right ui-widget-content ui-widget-content-transparent ui-corner-right\" title=\"Annuler\">" +
										"<span class=\"ui-icon ui-icon-close\"></span>" +
									"</span>" +
								"</div>" +
							"</td>" +
							"<td>" +
								"<div class=\"info-adherent-cellule com-center\">" +
									"<button type=\"button\" id=\"btn-valider\" class=\"ui-state-default ui-corner-all com-button com-center\">Valider</button>" +
									"<button type=\"button\" id=\"btn-modifier\" class=\"ui-helper-hidden ui-state-default ui-corner-all com-button com-center\">Modifier</button>" +
								"</div>" +						
							"</td>" +
							"<td>" +
								"<div class=\"ligne-lot-produit ui-helper-hidden info-adherent-cellule ui-widget-header ui-corner-all\">" +
									"Prix : <span id=\"cellule-lot-produit\"></span>" +
								"</div>" +
								"<div class=\"info-adherent-cellule com-center\">" +
									"<button type=\"button\" id=\"btn-enregistrer\" class=\"ui-helper-hidden ui-state-default ui-corner-all com-button com-center\">Enregistrer</button>" +
									"<button type=\"button\" id=\"btn-supprimer\" class=\"ui-helper-hidden ui-state-default ui-corner-all com-button com-center\">Supprimer</button>" +
									
									
								"</div>" +	
							"</td>" +
							"<td>" +
								"<div class=\"ligne-lot-produit ui-helper-hidden info-adherent-cellule ui-widget-header ui-corner-all\">" +
									"<span id=\"cellule-lot-produit-prix-unitaire\"></span>" +
								"</div>" +
							"</td>" +
						"</tr>" +
					"</tbody>" +
				"</table>" +
		//	"</div>" +
		"</div>";
	
	this.adhesionOK =
		"<td class=\"info-adherent-cellule-adhesion\">" +
			"<div class=\"info-adherent-cellule ui-widget-header ui-corner-all\">Adhésion à jour</div>" +
		"</td>";
	
	this.adhesionKO =
		"<td class=\"info-adherent-cellule-adhesion\">" +
		"<div class=\"info-adherent-cellule ui-widget-header ui-corner-all\"><span class=\"com-nombre-negatif\">Adhésion à renouveler</span></div>" +
	"</td>";
	
	
	this.champComplementaire =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.label}</td>" +
				"<td>" +
					"<input type=\"text\" value=\"\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"rechargementchampComplementaire{champComplementaire.id}valeur\" data-id-champ-complementaire=\"{champComplementaire.id}\" maxlength=\"50\" size=\"15\"/>" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
	
	this.champComplementaireAffiche =
		"<table id=\"affiche-select-typePaiement\">" +
			"<tr id=\"ligne-operation\" >" +
				"<td>Paiement</td>" +
				"<td>{typePaiementAffiche}</td>" +
			"</tr>" +
			"{champComplementaireAffiche}" +
		"</table>";
	
	this.achatHorsMarcheFormulaire = 
		"<div id=\"contenu\">" +
			"<table class=\"div-relative\"></table>" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-retour\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour" +
				"</button>" +
			"</div>" +		
		
			"{infoAdherent}" +
		
		
			"<div id=\"formulaire-produit\" class=\"tableau-liste-produit com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				
				"<table class=\"achat-commande-table-pdt\">" +
					"<thead>" +
						"<tr>" +
							"<th class=\"info-adherent-cellule-nom-adherent\"></th>" +
							"<th colspan=\"4\" class=\"info-adherent-cellule-achat\">Achat</th>" +
							"<th colspan=\"4\" class=\"info-adherent-cellule-achat\">Achat Solidaire</th>" +
						"</tr>" +
						"<tr>" +
							"<th></th>" +
							"<th colspan=\"2\" class=\"formulaire-achat-produit-quantite\">Quantite</th>" +
							"<th colspan=\"2\" class=\"formulaire-achat-produit-prix\">Prix</th>" +
							"<th colspan=\"2\" class=\"formulaire-achat-produit-quantite\">Quantite</th>" +
							"<th colspan=\"2\" class=\"formulaire-achat-produit-prix\">Prix</th>" +
						"</tr>" +
					"</thead>" +
				"</table>" +
				"<!-- BEGIN categories -->" +
				"<div id=\"ligne-categorie-{categories.cproId}\" class=\"ligne-categorie ui-widget-header ui-corner-all com-cursor-pointer\" data-id-categorie=\"{categories.cproId}\">" +
					"{categories.cproNom}" +
					"<span class=\"ligne-categorie-btn-toggle com-btn-header-multiples-gauche ui-widget-content ui-widget-content-transparent ui-corner-all\" id=\"btn-toggle-categorie-{categories.cproId}\">" +
						"<span class=\"ui-icon ui-icon-triangle-1-s\">" +
					"</span>" +
				"</div>" +
				"<table id=\"tableau-produit-{categories.cproId}\" class=\"com-table-100 tableau-produit {categories.visible}\">" +
					"<tbody>" +
						"<!-- BEGIN categories.produits -->" +
						"<tr class=\"ligne-produit\" data-id-produit=\"{categories.produits.id}\" data-id-nom-produit=\"{categories.produits.idNomProduit}\" data-id-categorie=\"{categories.cproId}\" data-unite=\"{categories.produits.unite}\"  data-id-stock=\"{categories.produits.idStock}\" data-id-stock-solidaire=\"{categories.produits.idStockSolidaire}\" data-id-detail-operation=\"{categories.produits.idDetailOperation}\" data-id-detail-operation-solidaire=\"{categories.produits.idDetailOperationSolidaire}\">" +
							"<td class=\"info-adherent-cellule-nom-adherent\">" +
								"{categories.produits.nproNom}" +
							"</td>" +
							
							// Achat			
							"<td class=\"input-formulaire-achat-produit\" >" +
								"<input type=\"text\" value=\"{categories.produits.quantiteAchat}\" id=\"produits{categories.produits.id}quantite\" class=\"produit-quantite com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-produit=\"{categories.produits.id}\" data-id-nom-produit=\"{categories.produits.idNomProduit}\" data-unite=\"{categories.produits.unite}\" data-type=\"\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-unite\">" +
								"{categories.produits.unite}" +
							"</td>" +
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" value=\"{categories.produits.montantAchat}\" id=\"produits{categories.produits.id}montant\" class=\"produit-prix com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-produit=\"{categories.produits.id}\" data-id-nom-produit=\"{categories.produits.idNomProduit}\" data-unite=\"{categories.produits.unite}\" data-type=\"\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-sigle-monetaire\">" +
								"{sigleMonetaire}" +
							"</td>" +
							
							// Achat Solidaire		
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" value=\"{categories.produits.quantiteAchatSolidaire}\" id=\"produits{categories.produits.id}quantiteSolidaire\" class=\"produit-quantite-solidaire com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-produit=\"{categories.produits.id}\" data-id-nom-produit=\"{categories.produits.idNomProduit}\" data-unite=\"{categories.produits.unite}\" data-type=\"Solidaire\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-unite\">" +
								"{categories.produits.unite}" +
							"</td>" +
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" value=\"{categories.produits.montantAchatSolidaire}\" id=\"produits{categories.produits.id}montantSolidaire\" class=\"produit-prix-solidaire com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-produit=\"{categories.produits.id}\" data-id-nom-produit=\"{categories.produits.idNomProduit}\" data-unite=\"{categories.produits.unite}\" data-type=\"Solidaire\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-sigle-monetaire\">" +
								"{sigleMonetaire}" +
							"</td>" +
							
						"</tr>" +
						"<!-- END categories.produits -->" +
					"</tbody>" +
				"</table>" +
				"<!-- END categories -->" +
			"</div>" +
		"</div>";
	
	this.achatHorsMarcheDetailAchat =
		"<div id=\"formulaire-produit-detail\" class=\"tableau-liste-produit com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
		
			"<table class=\"achat-commande-table-pdt\">" +
				"<thead>" +
					"<tr>" +
						"<th class=\"info-adherent-cellule-nom-adherent\"></th>" +
						"<th colspan=\"4\" class=\"info-adherent-cellule-achat\">Achat</th>" +
						"<th colspan=\"4\" class=\"info-adherent-cellule-achat\">Achat Solidaire</th>" +
					"</tr>" +
					"<tr>" +
						"<th></th>" +
						"<th colspan=\"2\" class=\"formulaire-achat-produit-quantite\">Quantite</th>" +
						"<th colspan=\"2\" class=\"formulaire-achat-produit-prix\">Prix</th>" +
						"<th colspan=\"2\" class=\"formulaire-achat-produit-quantite\">Quantite</th>" +
						"<th colspan=\"2\" class=\"formulaire-achat-produit-prix\">Prix</th>" +
					"</tr>" +
				"</thead>" +
			"</table>" +
			"<!-- BEGIN categories -->" +
			"<div class=\"ui-widget-header ui-corner-all\">" +
				"{categories.cproNom}" +
			"</div>" +
			"<table class=\"com-table-100\">" +
				"<tbody>" +
				
					"<!-- BEGIN categories.produits -->" +
					"<tr class=\"ligne-detail-produit\" >" +
						"<td class=\"info-adherent-cellule-nom-adherent\">" +
							"{categories.produits.nom}" +
						"</td>" +
						
						// Achat			
						"<td class=\"input-formulaire-achat-produit\">" +
							"{categories.produits.quantite}" +
						"</td>" +
						"<td class=\"formulaire-achat-produit-unite\">" +
							"{categories.produits.unite}" +
						"</td>" +
						"<td class=\"input-formulaire-achat-produit\">" +
							"{categories.produits.montant}" +
						"</td>" +
						"<td class=\"formulaire-achat-produit-sigle-monetaire\">" +
							"{categories.produits.sigleMonetaire}" +
						"</td>" +
						
						// Achat Solidaire		
						"<td class=\"input-formulaire-achat-produit\">" +
							"{categories.produits.quantiteSolidaire}" +
						"</td>" +
						"<td class=\"formulaire-achat-produit-unite\">" +
							"{categories.produits.uniteSolidaire}" +
						"</td>" +
						"<td class=\"input-formulaire-achat-produit\">" +
							"{categories.produits.montantSolidaire}" +
						"</td>" +
						"<td class=\"formulaire-achat-produit-sigle-monetaire\">" +
							"{categories.produits.sigleMonetaireSolidaire}" +
						"</td>" +
						
					"</tr>" +
					"<!-- END categories.produits -->" +
				"</tbody>" +
			"</table>" +
			"<!-- END categories -->" +
		"</div>";
		
	this.achatCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Achat effectué avec succès.<br/><br/>" +
						"<button id=\"lien-retour\" class=\"ui-state-default ui-corner-all com-button com-center\">Retourner à la liste des adhérents</button>" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.lotUnique = 
		"<input type=\"hidden\" id=\"lot-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.lotUniqueSolidaire = 
		"<input type=\"hidden\" id=\"lot-solidaire-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.flagAbonnement = 
		"<span class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Abo</span>";
	
	this.dialogSuppressionAchat =
		"<div title=\"Supprimer l'achat\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer cet achat ?</p>" +
		"</div>";
}