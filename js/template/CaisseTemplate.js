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
							"<tr class=\"ui-widget ui-widget-header com-cursor-pointer achat-commande-ligne\">" +
								"<th class=\"com-table-th com-underline-hover com-center\"><span class=\"ui-helper-hidden id-adherent\">0</span>Compte invité</th>" +
							"</tr>" +
						"</thead>" +
					"</table>" +
					"<table class=\"com-table\" id=\"liste-adherent\">" +
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
	
	this.achatMarcheFormulaire = 
		"<div id=\"achat-marche-formulaire\" class=\"{formMarcheVisible}\">" +			
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
						"<td class=\"ui-widget-header ui-corner-all com-center\">{categoriesAchat.nom}</td>" +
						"<td colspan=\"4\"></td>" +
					"</tr>" +
					"<!-- BEGIN categoriesAchat.produits -->" +
					"<tr>" +
						"<td class=\"table-vente-produit\">{categoriesAchat.produits.nproNom} {categoriesAchat.produits.flagType}</td>" +
						"<td class=\"com-text-align-right\">" +
							"{categoriesAchat.produits.stoQuantite}" +
						"</td>" +
						"<td>{categoriesAchat.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right\" >" +
							"{categoriesAchat.produits.proPrix}" +
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
						"<td class=\"ui-widget-header ui-corner-all com-center\">{categoriesSolidaireAchat.nom}</td>" +
						"<td colspan=\"4\"></td>" +
					"</tr>" +
					"<!-- BEGIN categoriesSolidaireAchat.produits -->" +
					"<tr>" +
						"<td class=\"table-vente-produit\">" +
							"{categoriesSolidaireAchat.produits.nproNom} {categoriesSolidaireAchat.produits.flagType}" +
						"</td>" +							
						"<td class=\"com-text-align-right\">" +
							"{categoriesSolidaireAchat.produits.stoQuantite}" +
						"</td>" +
						"<td>{categoriesSolidaireAchat.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right\" >" +
							"{categoriesSolidaireAchat.produits.proPrix}" +
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
	
	this.flagAbonnement = 
		"<span class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Abo</span>";
}