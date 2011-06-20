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
		"<div class=\"com-barre-menu-2\">" +
			"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-archive\">" +
				"<span class=\"com-float-left\">Les Marchés cloturés</span>" +
				"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-e\"></span>" +
			"</button>" +
		"</div>" +
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
			"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
		"</div>" +
	"</div>";
	
	this.listeMarcheVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente</div>" +
				"<p id=\"texte-liste-vide\">Aucune réservation en cours.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeAdherentCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente du Marché n°{comNumero}</div>" +
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
							"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhLabelCompte}</td>" +
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
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente du Marché n°{comNumero}</div>" +
				"<div class=\"com-widget-content\">" +
					"<div id=\"resa-info-commande\">" +
						"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
						"N° de Compte : {adhCompte}" +
					"</div>" +
					"<div>" +
						"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span><br/>" +
						"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
					"</div>" +
					//"<span>N° d'Adhérent : {adhNumero} N° de Compte : {adhCompte} Nom : {adhNom} Prénom : {adhPrenom}</span><br/>" +
					//"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span> <span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-float-left\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-widget\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat</div>" +
					"<div class=\"com-widget-content\">" +
					"<table class=\"achat-commande-table-pdt\">" +
						"<thead>" +
							"<tr>" +
								"<th>Produit</th>" +
								"<th>Quantité</th>" +
								"<th></th>" +
								"<th>Prix</th>" +
								"<th></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
						"<!-- BEGIN produits -->" +
							"<tr class=\"ligne-produit\">" +
								"<td><span class=\"produit-id ui-helper-hidden\">{produits.proId}</span>{produits.nproNom}</td>" +
								"<td class=\"com-text-align-right td-qte\"><input type=\"text\" value=\"{produits.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"produits{produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
								"<td class=\"td-unite\">{produits.proUniteMesure}</td>" +
								"<td class=\"com-text-align-right td-qte\" ><input type=\"text\" value=\"{produits.proPrix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"produits{produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
								"<td><span>{sigleMonetaire}</span></td>" +
							"</tr>" +
						"<!-- END produits -->" +
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
				"</div>" +
			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-pdt-solidaire-widget\" >" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat Solidaire</div>" +
					"<div class=\"com-widget-content\">" +
					"<table class=\"achat-commande-table-pdt\">" +
						"<thead>" +
							"<tr>" +
								"<th>Produit</th>" +
								"<th>Quantité</th>" +
								"<th></th>" +
								"<th>Prix</th>" +
								"<th></th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
						"<!-- BEGIN produitsSolidaire -->" +
							"<tr class=\"ligne-produit-solidaire\">" +
								"<td><span class=\"produit-id ui-helper-hidden\">{produitsSolidaire.proId}</span>{produitsSolidaire.nproNom}</td>" +
								"<td class=\"com-text-align-right td-qte\"><input type=\"text\" value=\"0\" class=\"com-numeric produit-solidaire-quantite com-input-text ui-widget-content ui-corner-all\" id=\"produitsSolidaire{produitsSolidaire.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
								"<td class=\"td-unite\">{produitsSolidaire.proUniteMesure}</td>" +
								"<td class=\"com-text-align-right td-qte\" ><input type=\"text\" value=\"0\" class=\"com-numeric produit-solidaire-prix com-input-text ui-widget-content ui-corner-all\" id=\"produitsSolidaire{produitsSolidaire.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
								"<td><span>{sigleMonetaire}</span></td>" +
							"</tr>" +
						"<!-- END produitsSolidaire -->" +
						"</tbody>" +
						"<tfoot>" +
							"<tr>" +
								"<td colspan=\"2\"></td>" +
								"<td class=\"com-text-align-right\" >Total :</td>" +
								"<td class=\"com-text-align-right\" ><span id=\"total-achat-solidaire\">0,00</span></td>" +
								"<td><span>{sigleMonetaire}</span></td>" +
							"</tr>" +
						"</tfoot>" +
					"</table>" +
					"</div>" +
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
						"<button id=\"btn-annuler\" class=\"ui-state-default ui-corner-all com-button com-center\">Retourner à la liste des réservations</button>" +
					"</p>" +
				"</div>" +
			"</div>" +
		"</div>";
}