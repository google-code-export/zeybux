;function CaisseTemplate() {
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut com-center\" colspan=\"2\">N°</th>" +
								"<th class=\"com-table-th-med\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th-med\">Marché</th>	" +
								"<th class=\"com-table-th-fin\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr class=\"com-cursor-pointer btn-marche\" id=\"{commande.id}\">" +
								"<td class=\"com-table-td-debut lst-resa-th-num com-text-align-right\">{commande.numero} : </td>" +
								"<td class=\"com-table-td-med lst-resa-td-nom\">{commande.nom}</td>" +
								"<td class=\"com-table-td-med\">Le {commande.jourFinReservation} {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td-med\">Le {commande.jourMarcheDebut} {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
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
		"<div>" +
			"<select id=\"select-{nproId}{type}\" class=\"select-lot\" data-id-nom-produit=\"{nproId}\" data-type=\"{type}\" >" +
				"<!-- BEGIN lots -->" +
				"<option {lots.selected} value=\"{lots.id}\">par {lots.tailleAffiche} {unite}</option>" +
				"<!-- END lots -->" +
			"</select>" +
		"</div>";
	
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
								"<input type=\"text\" name=\"montant-rechargement\" value=\"{rechargementMontant}\" class=\"form-produit com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"rechargementmontant\" maxlength=\"12\" size=\"12\"/> {sigleMonetaire}" +
							"</div>" +
							"<div id=\"select-typePaiement\" class=\"info-adherent-cellule-achat ui-widget ui-widget-content ui-helper-hidden ui-corner-bottom\">" +
								"<span id=\"label-type-paiement\">Type de Paiement<br/><span>" +
								"<select name=\"typepaiement\" id=\"rechargementtypePaiement\" class=\"form-produit\">" +
									"<option value=\"0\">== Choisir ==</option>" +
									"<!-- BEGIN typePaiement -->" +
									"<option {typePaiement.selected} value=\"{typePaiement.tppId}\">{typePaiement.tppType}</option>" +
									"<!-- END typePaiement -->" +
								"</select>" +
								"<span class=\"form-produit ui-helper-hidden\" id=\"rechargement-select-affiche\"></span>" +
								"<div id=\"form-champ-complementaire\" class=\"{rechargementAfficheChampComplementaire}\">" +
									"<div id=\"label-champ-complementaire\"></div>" +
									"<span class=\"form-produit ui-helper-hidden\" id=\"rechargement-champ-complementaire-affiche\"></span>" +
									"<input type=\"text\" name=\"champ-complementaire\" value=\"{rechargementChampComplementaire}\" class=\"form-produit com-input-text ui-widget-content ui-corner-all\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/><br/>" +
									
									"<div id=\"label-champ-complementaire-banque\">Banque</div>" +
									"<span class=\"form-produit ui-helper-hidden\" id=\"rechargement-banque-affiche\"></span>" +
									"<input id-banque=\"{rechargementIdBanque}\" type=\"text\" name=\"champ-complementaire-banque\" value=\"{rechargementNomBanque}\" class=\"form-produit com-input-text ui-widget-content ui-corner-all\" id=\"rechargementidBanque\" maxlength=\"50\" size=\"15\"/>" +
									
								"</div>" +
							"</div>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td colspan=\"2\" class=\"info-adherent-cellule-achat\">" +
							"<div class=\"info-adherent-cellule ui-widget-header ui-corner-all\">Total : <span id=\"total\">{total}</span> {sigleMonetaire}</div>" +
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
		"</div>";
	
	this.achatHorsMarcheFormulaire = 
		"<div id=\"contenu\">" +
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
						"<tr class=\"ligne-produit\" data-id-produit=\"{categories.produits.id}\" data-id-nom-produit=\"{categories.produits.nproId}\" data-id-categorie=\"{categories.cproId}\" >" +
							"<td class=\"info-adherent-cellule-nom-adherent\">" +
								"{categories.produits.nom}" +
							"</td>" +
							
							// Achat			
							"<td class=\"input-formulaire-achat-produit\" >" +
								"<input type=\"text\" id=\"produits{categories.produits.nproId}quantite\" class=\"produit-quantite com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-nom-produit=\"{categories.produits.nproId}\" data-type=\"\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-unite\">" +
								"{categories.produits.unite}" +
							"</td>" +
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" id=\"produits{categories.produits.nproId}prix\" class=\"produit-prix com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-nom-produit=\"{categories.produits.nproId}\" data-type=\"\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-sigle-monetaire\">" +
								"{sigleMonetaire}" +
							"</td>" +
							
							// Achat Solidaire		
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" id=\"produitsSolidaire{categories.produits.nproId}quantite\" class=\"produit-quantite-solidaire com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-nom-produit=\"{categories.produits.nproId}\" data-type=\"Solidaire\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-unite\">" +
								"{categories.produits.unite}" +
							"</td>" +
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" id=\"produitsSolidaire{categories.produits.nproId}prix\" class=\"produit-prix-solidaire com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-nom-produit=\"{categories.produits.nproId}\" data-type=\"Solidaire\" />" +
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
							"{categories.produits.prix}" +
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
							"{categories.produits.prixSolidaire}" +
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
	
	this.achatMarcheFormulaire = 
		"<div id=\"contenu\">" +
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
							"<th class=\"formulaire-achat-produit-nom-produit-reservation\"></th>" +
							"<th class=\"formulaire-achat-produit-reservation\">Réservation</th>" +
							"<th colspan=\"4\" class=\"info-adherent-cellule-achat\">Achat</th>" +
							"<th colspan=\"4\" class=\"info-adherent-cellule-achat\">Achat Solidaire</th>" +
						"</tr>" +
						"<tr>" +
							"<th colspan=\"2\" ></th>" +
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
						"<tr class=\"ligne-produit\" data-id-produit=\"{categories.produits.id}\" data-id-nom-produit=\"{categories.produits.nproId}\" data-id-categorie=\"{categories.cproId}\" >" +
							"<td class=\"formulaire-achat-produit-nom-produit-reservation\">" +
								"{categories.produits.nom}" +
							"</td>" +
							
							"<td class=\"formulaire-achat-produit-reservation\">" +
								"{categories.produits.quantiteReservation}" +
							"</td>" +
							
							// Achat			
							"<td class=\"input-formulaire-achat-produit\" >" +
								"<input type=\"text\" value=\"{categories.produits.quantiteAchat}\" id=\"produits{categories.produits.nproId}quantite\" class=\"produit-quantite com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-nom-produit=\"{categories.produits.nproId}\" data-type=\"\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-unite\">" +
								"{categories.produits.unite}" +
							"</td>" +
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" value=\"{categories.produits.prixAchat}\" id=\"produits{categories.produits.nproId}prix\" class=\"produit-prix com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-nom-produit=\"{categories.produits.nproId}\" data-type=\"\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-sigle-monetaire\">" +
								"{sigleMonetaire}" +
							"</td>" +
							
							// Achat Solidaire		
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" value=\"{categories.produits.quantiteAchatSolidaire}\" id=\"produitsSolidaire{categories.produits.nproId}quantite\" class=\"produit-quantite-solidaire com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-nom-produit=\"{categories.produits.nproId}\" data-type=\"Solidaire\" />" +
							"</td>" +
							"<td class=\"formulaire-achat-produit-unite\">" +
								"{categories.produits.unite}" +
							"</td>" +
							"<td class=\"input-formulaire-achat-produit\">" +
								"<input type=\"text\" value=\"{categories.produits.prixAchatSolidaire}\" id=\"produitsSolidaire{categories.produits.nproId}prix\" class=\"produit-prix-solidaire com-numeric com-input-text ui-widget-content ui-corner-all\" maxlength=\"12\" size=\"3\" data-id-nom-produit=\"{categories.produits.nproId}\" data-type=\"Solidaire\" />" +
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
	
	
	/*this.achatMarcheFormulaire = 
		"<div id=\"achat-marche-formulaire\" class=\"{formMarcheVisible}\">" +			
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-widget\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
				"<div class=\"com-widget-content\">" +
				"<table class=\"achat-commande-table-pdt\">" +
					"<thead>" +
						"<tr>" +
							"<th colspan=\"3\"></th>" +
							"<th colspan=\"2\">Réservation</th>" +
							"<th colspan=\"2\" class=\"table-vente-quantite\">Quantité</th>" +
							"<th colspan=\"2\" class=\"table-vente-prix\">Prix</th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
					"<!-- BEGIN categories -->" +
						"<tr>" +
							"<td><div class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</div></td>" +
							"<td colspan=\"8\"></td>" +
						"</tr>" +
						"<!-- BEGIN categories.produits -->" +
						"<tr class=\"ligne-produit\">" +
							"<td class=\"table-vente-produit\"><span class=\"produit-id ui-helper-hidden\">{categories.produits.proId}</span>{categories.produits.nproNom} {categories.produits.flagType}</td>" +
							"<td class=\"table-vente-lot\">" +
								"<select id=\"lot-{categories.produits.proId}\" class=\"lot-vente-produit lot-vente-produit-select\">" +
									"<!-- BEGIN categories.produits.lot -->" +
									"<option value=\"{categories.produits.lot.dcomId}\">par {categories.produits.lot.dcomTaille} {categories.produits.proUniteMesure}</option>" +
									"<!-- END categories.produits.lot -->" +
								"</select>" +
							"</td>" +
							"<td class=\"table-vente-prix-unitaire\" >à <span id=\"prix-unitaire-{categories.produits.proId}\">{categories.produits.prixUnitaire}</span> {sigleMonetaire}/{categories.produits.proUniteMesure}</td>" +
							
							"<td class=\"com-text-align-right\">" +
								"{categories.produits.stoQuantiteReservation}" +
							"</td>" +
							"<td>{categories.produits.proUniteMesureReservation}</td>" +
							
							"<td class=\"com-text-align-right\">" +
								"<input type=\"text\" value=\"{categories.produits.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"produits{categories.produits.proId}quantite\" maxlength=\"12\" size=\"3\"/>" +
							"</td>" +
							"<td>{categories.produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right\" >" +
								"<input type=\"text\" value=\"{categories.produits.proPrix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"produits{categories.produits.proId}prix\" maxlength=\"12\" size=\"3\"/>" +
							"</td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
						"<!-- END categories.produits -->" +
					"<!-- END categories -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"4\"></td>" +
							"<td class=\"com-text-align-right\" colspan=\"3\" >Total :</td>" +
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
							"<td><div class=\"ui-widget-header ui-corner-all com-center\">{categoriesSolidaire.nom}</div></td>" +
							"<td colspan=\"6\"></td>" +
						"</tr>" +
						"<!-- BEGIN categoriesSolidaire.produits -->" +
						"<tr class=\"ligne-produit-solidaire\">" +
							"<td class=\"table-vente-produit\"><span class=\"produit-id ui-helper-hidden\">{categoriesSolidaire.produits.proId}</span>{categoriesSolidaire.produits.nproNom} {categoriesSolidaire.produits.flagType}</td>" +
							
							
							
							"<td class=\"table-vente-lot\">" +
								"<select id=\"lot-solidaire-{categoriesSolidaire.produits.proId}\" class=\"lot-vente-produit lot-vente-produit-select\">" +
									"<!-- BEGIN categoriesSolidaire.produits.lot -->" +
									"<option value=\"{categoriesSolidaire.produits.lot.dcomId}\">par {categoriesSolidaire.produits.lot.dcomTaille} {categoriesSolidaire.produits.proUniteMesure}</option>" +
									"<!-- END categoriesSolidaire.produits.lot -->" +
								"</select>" +
							"</td>" +
							"<td class=\"table-vente-prix-unitaire\" >à <span id=\"prix-unitaire-solidaire-{categoriesSolidaire.produits.proId}\">{categoriesSolidaire.produits.prixUnitaire}</span> {sigleMonetaire}/{categoriesSolidaire.produits.proUniteMesure}</td>" +
							

							
							"<td class=\"com-text-align-right\">" +
								"<input type=\"text\" value=\"{categoriesSolidaire.produits.stoQuantite}\" class=\"com-numeric produit-solidaire-quantite com-input-text ui-widget-content ui-corner-all\" id=\"produitsSolidaire{categoriesSolidaire.produits.proId}quantite\" maxlength=\"12\" size=\"3\"/>" +
							"</td>" +
							"<td>{categoriesSolidaire.produits.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right\" >" +
								"<input type=\"text\" value=\"{categoriesSolidaire.produits.proPrix}\" class=\"com-numeric produit-solidaire-prix com-input-text ui-widget-content ui-corner-all\" id=\"produitsSolidaire{categoriesSolidaire.produits.proId}prix\" maxlength=\"12\" size=\"3\"/>" +
							"</td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
						"<!-- END categoriesSolidaire.produits -->" +
					"<!-- END categoriesSolidaire -->" +
					"</tbody>" +
					"<tfoot>" +
						"<tr>" +
							"<td colspan=\"4\"></td>" +
							"<td class=\"com-text-align-right\" >Total :</td>" +
							"<td class=\"com-text-align-right\" ><span id=\"total-achat-solidaire\">{totalSolidaire}</span></td>" +
							"<td><span>{sigleMonetaire}</span></td>" +
						"</tr>" +
					"</tfoot>" +
				"</table>" +
				"</div>" +
			"</div>" +
			
			"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<span>Total Marché : <span id=\"total-global\">0,00</span> {sigleMonetaire}</span>" +
			"</div>" +
			
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
								"<td>" +
									"<input type=\"text\" name=\"montant-rechargement\" value=\"\" class=\"recap com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"rechargementmontant\" maxlength=\"12\" size=\"3\"/>" +
									"<span class=\"recap ui-helper-hidden\" id=\"recharger-montant-label\"></span>" +
									"<span>{sigleMonetaire}</span>" +
								"</td>" +
								"<td class=\"com-center\">" +
									"<select name=\"typepaiement\" id=\"rechargementtypePaiement\" class=\"recap\">" +
										"<option value=\"0\">== Choisir ==</option>" +
										"<!-- BEGIN typePaiement -->" +
										"<option value=\"{typePaiement.tppId}\">{typePaiement.tppType}</option>" +
										"<!-- END typePaiement -->" +
									"</select>" +
									"<span class=\"recap ui-helper-hidden\" id=\"rechargementtypePaiement-label\"></span>" +
								"</td>" +
								"<td id=\"td-champ-complementaire\">" +
									"<input type=\"text\" name=\"champ-complementaire\" value=\"\" class=\"recap com-input-text ui-widget-content ui-corner-all\" id=\"rechargementchampComplementaire\" maxlength=\"50\" size=\"15\"/>" +
									"<span class=\"recap ui-helper-hidden\" id=\"rechargementchampComplementaire-label\"></span>" +
								"</td>" +
							"</tr>" +	
							"<tr>" +
								"<td></td>" +
								"<td id=\"label-champ-complementaire-banque\">Banque </td>" +
								"<td id=\"td-champ-complementaire-banque\"><input type=\"text\" name=\"champ-complementaire-banque\" value=\"\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"rechargementidBanque\" maxlength=\"50\" size=\"15\"/></td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.achatMarcheDetail = 
		"<div id=\"achat-marche-detail\" class=\"{detailMarcheVisible}\">" +			
			"{produit} {produitSolidaire}" +
			"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<span>Total Marché : <span id=\"total-global\">{totalMarche}</span> {sigleMonetaire}</span>" +
			"</div>" +
			
			"<div id=\"vente-info-adherent\" class=\"com-float-left com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente du Marché n°{comNumero}</div>" +
				"<div id=\"vente-achat-info-marche\">" +
				"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
				"N° de Compte : {adhCompte}" +
				"</div>" +
				"<div>" +
					"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span><br/>" +
					"<span>Nouveau Solde : </span><span class=\"{classSolde}\">{adhNouveauSolde} {sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"{rechargementVisible} com-widget-window ui-widget ui-widget-content ui-corner-all com-float-left\" id=\"achat-rechgt-widget\">" +
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
								"<td>" +
									"{rechargementMontant} {sigleMonetaire}" +
								"</td>" +
								"<td class=\"com-center\">" +
									"{rechargementTypePaiement}" +
								"</td>" +
								"<td>" +
									"{rechargementChampComplementaire}" +
								"</td>" +
							"</tr>" +
							"<tr class=\"{classHideBanque}\">" +
								"<td></td>" +
								"<td class=\"com-center\">Banque </td>" +
								"<td>{rechargementNomBanque}</td>" +
							"</tr>" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.achatMarcheDetailProduit = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-widget\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
			"<div class=\"com-widget-content\">" +
			"<table class=\"achat-commande-table-pdt\">" +
				"<thead>" +
					"<tr>" +
						"<th ></th>" +
						"<th colspan=\"2\" class=\"table-vente-quantite\">Quantité</th>" +
						"<th colspan=\"2\" class=\"table-vente-prix\">Prix</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
				"<!-- BEGIN categoriesAchat -->" +
					"<tr>" +
						"<td><div class=\"ui-widget-header ui-corner-all com-center\">{categoriesAchat.nom}</div></td>" +
						"<td colspan=\"4\"></td>" +
					"</tr>" +
					"<!-- BEGIN categoriesAchat.produits -->" +
					"<tr>" +
						"<td class=\"table-vente-produit\">{categoriesAchat.produits.nproNom} {categoriesAchat.produits.flagType}</td>" +
						"<td class=\"com-text-align-right\">" +
							"{categoriesAchat.produits.stoQuantiteAffiche}" +
						"</td>" +
						"<td>{categoriesAchat.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right\" >" +
							"{categoriesAchat.produits.proPrixAffiche}" +
						"</td>" +
						"<td><span>{sigleMonetaire}</span></td>" +
					"</tr>" +
					"<!-- END categoriesAchat.produits -->" +
				"<!-- END categoriesAchat -->" +
				"</tbody>" +
				"<tfoot>" +
					"<tr>" +
						"<td colspan=\"2\"></td>" +
						"<td class=\"com-text-align-right\" >Total :</td>" +
						"<td class=\"com-text-align-right\" ><span id=\"total-achat\">{total}</span></td>" +
						"<td><span>{sigleMonetaire}</span></td>" +
					"</tr>" +
				"</tfoot>" +
			"</table>" +
			"</div>" +
		"</div>";
	
	this.achatMarcheDetailProduitVide = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-widget\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
			"<div class=\"com-widget-content com-center\">" +
				"Pas d'achat" +
			"</div>" +
		"</div>";
	
	this.achatMarcheDetailProduitSolidaire = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-solidaire-widget\" >" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat Solidaire</div>" +
			"<div class=\"com-widget-content\">" +
			"<table class=\"achat-commande-table-pdt\">" +
				"<thead>" +
					"<tr>" +
						"<th ></th>" +
						"<th colspan=\"2\" class=\"table-vente-quantite\">Quantité</th>" +
						"<th colspan=\"2\" class=\"table-vente-prix\">Prix</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
				"<!-- BEGIN categoriesSolidaireAchat -->" +
					"<tr>" +
						"<td><div class=\"ui-widget-header ui-corner-all com-center\">{categoriesSolidaireAchat.nom}</div></td>" +
						"<td colspan=\"4\"></td>" +
					"</tr>" +
					"<!-- BEGIN categoriesSolidaireAchat.produits -->" +
					"<tr>" +
						"<td class=\"table-vente-produit\">" +
							"{categoriesSolidaireAchat.produits.nproNom} {categoriesSolidaireAchat.produits.flagType}" +
						"</td>" +							
						"<td class=\"com-text-align-right\">" +
							"{categoriesSolidaireAchat.produits.stoQuantiteAffiche}" +
						"</td>" +
						"<td>{categoriesSolidaireAchat.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right\" >" +
							"{categoriesSolidaireAchat.produits.proPrixAffiche}" +
						"</td>" +
						"<td><span>{sigleMonetaire}</span></td>" +
					"</tr>" +
					"<!-- END categoriesSolidaireAchat.produits -->" +
				"<!-- END categoriesSolidaireAchat -->" +
				"</tbody>" +
				"<tfoot>" +
					"<tr>" +
						"<td colspan=\"2\"></td>" +
						"<td class=\"com-text-align-right\" >Total :</td>" +
						"<td class=\"com-text-align-right\" ><span id=\"total-achat-solidaire\">{totalSolidaire}</span></td>" +
						"<td><span>{sigleMonetaire}</span></td>" +
					"</tr>" +
				"</tfoot>" +
			"</table>" +
			"</div>" +
		"</div>";
	
	this.achatMarcheDetailProduitSolidaireVide = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-solidaire-widget\" >" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat Solidaire</div>" +
			"<div class=\"com-widget-content com-center\">" +
				"Pas d'achat Solidaire" +
			"</div>" +
		"</div>";*/
	
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
}