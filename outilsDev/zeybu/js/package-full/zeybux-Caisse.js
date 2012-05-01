;function CaisseTemplate() {
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th-debut lst-resa-th-num\">N°</th>" +
								"<th class=\"com-table-th-med\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th-med\">Marché</th>	" +
								"<th class=\"com-table-th-fin\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr class=\"com-cursor-pointer btn-marche\" id=\"{commande.id}\">" +
								"<td class=\"com-table-td-debut com-text-align-right\">{commande.numero} : </td>" +
								"<td class=\"com-table-td-med\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td-med\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								/*"<td class=\"com-table-td lst-resa-btn-commander\">" +
									"<button class=\"btn-marche ui-state-default ui-corner-all com-button com-center\" id=\"{commande.id}\" >Vente</button>" +
								"</td>" +*/
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
							"<th class=\"com-table-th-debut com-underline-hover marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
							"<th class=\"com-table-th-med com-underline-hover marche-com-th-num-adh\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
							"<th class=\"com-table-th-med com-underline-hover marche-com-th-nom\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
							"<th class=\"com-table-th-med com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
							"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
						"</tr>" +
						"</thead>" +
						"<tbody>" +
						"<!-- BEGIN listeAdherentCommande -->" +
						"<tr class=\"com-cursor-pointer achat-commande-ligne\" >" +							
							"<td class=\"com-table-td-debut com-underline-hover\">" +
								"<span class=\"ui-helper-hidden\">{listeAdherentCommande.adhIdTri}</span>" +
								"<span class=\"ui-helper-hidden id-adherent\">{listeAdherentCommande.adhId}</span>" +
								"{listeAdherentCommande.adhNumero}" +
							"</td>" +
							"<td class=\"com-table-td-med com-underline-hover\">{listeAdherentCommande.cptLabel}</td>" +
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
						"<td><div class=\"ui-widget-header ui-corner-all com-center\">{categoriesAchat.nom}</div></td>" +
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
						"<td><div class=\"ui-widget-header ui-corner-all com-center\">{categoriesSolidaireAchat.nom}</div></td>" +
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
};function CaisseListeCommandeVue(pParam) {
	//this.mCommunVue = new CommunVue();
	
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
	};
	
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
	};
	
	this.affect = function(pData) {
		pData = this.affectLienMarche(pData);
		pData = this.gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectLienMarche = function(pData) {
		/*pData.find('.btn-marche').click(function() {
			var lparam = ;
			CaisseMarcheCommandeVue(lparam);
		});*/
		pData.find(".btn-marche").click(function() {
			CaisseMarcheCommandeVue({"id_commande":$(this).attr('id')});
		});
		return pData;
	};
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
	};	
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			if(pResponse.listeAdherentCommande) {
				var that = this;
				var lCaisseTemplate = new CaisseTemplate();
				
				if(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null) {
					var lTemplate = lCaisseTemplate.listeAdherentCommandePage;
					pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
					
					$.each(pResponse.listeAdherentCommande,function() {
						this.adhIdTri = this.adhNumero.replace("Z","");
					});
					
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
	};
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienAchat(pData);
		return pData;
	};
	
	this.affectTri = function(pData) {
		pData.find('#liste-adherent').tablesorter({sortList: [[2,0]],headers: { 4: {sorter: false} } });
		return pData;
	};
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('#liste-adherent'), this.value );
		  });
		pData.find("#filter-form").submit(function () {return false;});
		return pData;
	};
	
	this.affectLienAchat = function(pData) {
		var that = this;
		pData.find(".achat-commande-ligne").click(function() {
			var lParam = {	id_commande:that.idCommande,
							id_adherent:$(this).find(".id-adherent").text()};
			CaisseAchatCommandeVue(lParam);
		});
		return pData;
	};
	
	this.construct(pParam);
};function CaisseAchatCommandeVue(pParam) {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
	this.mListeLot = [];
	this.mListeLotSolidaire = [];
	this.mTypePaiement = [];
	this.solde = null;
	this.etapeValider = 0;
	this.total = 0;
	this.totalSolidaire = 0;
	this.mAdherent = null;
	
	this.mAchatOuReservation = [];
	this.mReservation = [];
	
	this.pdtCommande = [];
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CaisseAchatCommandeVue(pParam);}} );
		var that = this;
		this.idCommande = pParam.id_commande;
		this.idAdherent = pParam.id_adherent;

		if(this.idAdherent == 0) { // compte invité
			that.idCompte = -3;			
			pParam.fonction = "infoMarche";
			$.post(	"./index.php?m=Caisse&v=CaisseMarcheCommande","pParam=" + $.toJSON(pParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {						
								if(pParam && pParam.vr) {
									Infobulle.generer(pParam.vr,'');
								}
								
								that.pdtCommande = lResponse.marche.produits;			
								
								$(lResponse.typePaiement).each(function() {
									that.mTypePaiement[this.tppId] = this;
								});
								
								that.solde = 0;
								that.afficher(lResponse);
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		} else {	
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
								that.mAdherent = lResponse.adherent;
								that.solde = parseFloat(lResponse.adherent.cptSolde);

								that.mReservation = lResponse.reservation;
								if(lResponse.achats.length > 0) {
									that.mAchatOuReservation = lResponse.achats;
									that.afficherDetailAchat(lResponse);
								} else {
									if(lResponse.reservation.length > 0) {
										that.mAchatOuReservation = lResponse.reservation;		
									}
									that.afficher(lResponse);
								}
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
		}
	};
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			var that = this;
			var lCaisseTemplate = new CaisseTemplate();
			
			var lData = new Object();
			lData.comNumero = pResponse.marche.numero;
			
			if(this.idAdherent != 0) {
				lData.adhNumero = pResponse.adherent.adhNumero;
				lData.adhCompte = pResponse.adherent.cptLabel;
				lData.adhNom = pResponse.adherent.adhNom;
				lData.adhPrenom = pResponse.adherent.adhPrenom;
			} else {
				lData.adhNumero = "ZZ";
				lData.adhCompte = "CC";
				lData.adhNom = "Invité";
			}
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
					lProduit.stoQuantite = "";
					lProduit.proPrix = "";
					lProduit.lot = [];
	

					lProduit.stoQuantiteReservation = '';
					lProduit.proUniteMesureReservation = '';
					
					var lPrix = 0;
					$.each(this.lots, function() {
						if(this.id) {
							var lLot = {};
							lLot.dcomId = this.id;
							lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
							lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
							lPrix = parseFloat(this.prix);
							lStoQuantite = parseFloat(this.taille);

							$(that.mAchatOuReservation).each(function() {
								if(this.idDetailCommande == lLot.dcomId) {
									lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',','');
									
									lPrix = this.montant * -1;									
									lProduit.proPrix = lPrix.nombreFormate(2,',','');
									lLot.prixReservation = lPrix;
									
									that.mListeLot.push({idPdt:lProduit.proId,idLot:lLot.dcomId});
								}											
							});
							$(that.mReservation).each(function() {
								if(this.idDetailCommande == lLot.dcomId) {
									lProduit.stoQuantiteReservation = (this.quantite * -1).nombreFormate(2,',','');
									lProduit.proUniteMesureReservation = lProduit.proUniteMesure;
								}											
							});
							
							lProduit.prixUnitaire = (lPrix / lStoQuantite).nombreFormate(2,',',' '); 						
																	
							lProduit.lot.push(lLot);
						}
					});
					lData.total += lPrix;
					
					lProduit.flagType = "";
					if(this.type == 2) {
						lProduit.flagType = lCaisseTemplate.flagAbonnement;
					}
					
					if(this.type == 0 || this.type == 2) {
						if(!lData.categories[this.idCategorie]) {
							lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
						}
						lData.categories[this.idCategorie].produits.push(lProduit);
					}

					var lProduitSolidaire = {};
					lProduitSolidaire.proId = this.id;
					lProduitSolidaire.nproNom = this.nom;
					lProduitSolidaire.proUniteMesure = this.unite;
					lProduitSolidaire.stoQuantite = "";
					lProduitSolidaire.proPrix = "";
					lProduitSolidaire.lot = lProduit.lot;
					lProduitSolidaire.flagType = lProduit.flagType;
					lProduitSolidaire.prixUnitaire = lProduit.prixUnitaire;
					
					$(pResponse.stockSolidaire).each(function() {
						if(lProduit.proId == this.proId){
							if(!lData.categoriesSolidaire[lProduitCommande.idCategorie]) {
								lData.categoriesSolidaire[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
							}
							lData.categoriesSolidaire[lProduitCommande.idCategorie].produits.push(lProduitSolidaire);
						}
					});
				}
			});
						
			lData.typePaiement = that.mTypePaiement;
			
			lData.adhSolde = this.solde;
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');

			if(this.idAdherent != 0) {
				lData.total = lData.total.nombreFormate(2,',',' ');
				that.total = lData.total;
			} else {
				lData.total = "0".nombreFormate(2,',',' ');	
			}
			
			lData.detailMarcheVisible = "ui-helper-hidden";

			lData.totalSolidaire = "0".nombreFormate(2,',',' ');
			var lData = { formulaire : lCaisseTemplate.achatMarcheFormulaire.template(lData),
							detail : lCaisseTemplate.achatMarcheDetail.template(lData) };

			
			
			$('#contenu').replaceWith( that.affect($(lCaisseTemplate.achatMarchePage.template(lData))) );
			
			that.changerTypePaiement($(":input[name=typepaiement]"));
			that.majNouveauSolde();
		} else {
			Infobulle.generer(pResponse,'');
		}
	};
	
	this.afficherDetailAchat = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			this.etapeValider = 1;
			
			var that = this;
			var lCaisseTemplate = new CaisseTemplate();
			
			var lData = new Object();
			lData.comNumero = pResponse.marche.numero;
			
			if(this.idAdherent != 0) {
				lData.adhNumero = pResponse.adherent.adhNumero;
				lData.adhCompte = pResponse.adherent.cptLabel;
				lData.adhNom = pResponse.adherent.adhNom;
				lData.adhPrenom = pResponse.adherent.adhPrenom;
			} else {
				lData.adhNumero = "ZZ";
				lData.adhCompte = "CC";
				lData.adhNom = "Invité";
			}
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			lData.totalSolidaire = 0;
			
		//	lData.produits = [];
			lData.categories = [];
		//	lData.produitsSolidaire = new Array();
			lData.categoriesSolidaire = [];
			lData.categoriesAchat = [];
			lData.categoriesSolidaireAchat = [];
			
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lProduitCommande = this;
					var lProduit = {};
					lProduit.proId = this.id;
					lProduit.nproNom = this.nom;
					lProduit.proUniteMesure = this.unite;
					lProduit.stoQuantite = "";
					lProduit.proPrix = "";
					lProduit.lot = [];

					lProduit.stoQuantiteReservation = '';
					lProduit.proUniteMesureReservation = '';
					
					var lPrix = 0;
					$.each(this.lots, function() {
						if(this.id) {
							var lLot = {};
							lLot.dcomId = this.id;
							lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
							lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
							lPrix = parseFloat(this.prix);
							lStoQuantite = parseFloat(this.taille);

							$(that.mAchatOuReservation).each(function() {
								$(this.detailAchat).each(function() {
									if(this.idDetailCommande == lLot.dcomId) {
										lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',','');
										
										lPrix = this.montant * -1;									
										lProduit.proPrix = lPrix.nombreFormate(2,',','');
										lLot.prixReservation = lPrix;
										
										that.mListeLot.push({idPdt:lProduit.proId,idLot:lLot.dcomId});
										
										if(!lData.categoriesAchat[lProduitCommande.idCategorie]) {
											lData.categoriesAchat[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
										}
										lData.categoriesAchat[lProduitCommande.idCategorie].produits.push(lProduit);

										lData.total += lPrix;
									}
								});										
							});
							$(that.mReservation).each(function() {
								if(this.idDetailCommande == lLot.dcomId) {
									lProduit.stoQuantiteReservation = (this.quantite * -1).nombreFormate(2,',','');
									lProduit.proUniteMesureReservation = lProduit.proUniteMesure;
								}											
							});
							
							lProduit.prixUnitaire = (lPrix / lStoQuantite).nombreFormate(2,',',' '); 						
																	
							lProduit.lot.push(lLot);
						}
					});
					
					lProduit.flagType = "";
					if(this.type == 2) {
						lProduit.flagType = lCaisseTemplate.flagAbonnement;
					}
					
					if(this.type == 0 || this.type == 2) {
						if(!lData.categories[this.idCategorie]) {
							lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
						}
						lData.categories[this.idCategorie].produits.push(lProduit);
					}

					
					var lProduit = {};
					lProduit.proId = this.id;
					lProduit.nproNom = this.nom;
					lProduit.proUniteMesure = this.unite;
					lProduit.stoQuantite = "";
					lProduit.proPrix = "";
					lProduit.lot = [];

					
					lProduit.flagType = "";
					if(this.type == 2) {
						lProduit.flagType = lCaisseTemplate.flagAbonnement;
					}
					
					$(pResponse.stockSolidaire).each(function() {
						if(lProduit.proId == this.proId){
							var lPrix = 0;
							$.each(lProduitCommande.lots, function() {
								if(this.id) {
									var lLot = {};
									lLot.dcomId = this.id;
									lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
									lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
									lPrix = parseFloat(this.prix);
									lStoQuantite = parseFloat(this.taille);

									$(that.mAchatOuReservation).each(function() {
										$(this.detailAchatSolidaire).each(function() {
											if(this.idDetailCommande == lLot.dcomId) {
												lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',','');
												
												lPrix = this.montant * -1;									
												lProduit.proPrix = lPrix.nombreFormate(2,',','');
												lLot.prixReservation = lPrix;
												
												that.mListeLotSolidaire.push({idPdt:lProduit.proId,idLot:lLot.dcomId});
												
												if(!lData.categoriesSolidaireAchat[lProduitCommande.idCategorie]) {
													lData.categoriesSolidaireAchat[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
												}
												lData.categoriesSolidaireAchat[lProduitCommande.idCategorie].produits.push(lProduit);

												lData.totalSolidaire += lPrix;
											}
										});										
									});
									
									lProduit.prixUnitaire = (lPrix / lStoQuantite).nombreFormate(2,',',' '); 						
																			
									lProduit.lot.push(lLot);
								}
							});
							
							if(!lData.categoriesSolidaire[lProduitCommande.idCategorie]) {
								lData.categoriesSolidaire[lProduitCommande.idCategorie] = {nom:lProduitCommande.cproNom,produits:[]};
							}
							lData.categoriesSolidaire[lProduitCommande.idCategorie].produits.push(lProduit);
						}
					});
				}
			});
						
			lData.typePaiement = that.mTypePaiement;
			
			
			lData.adhNouveauSolde = this.solde.nombreFormate(2,',',' ');
			
			this.solde = (this.solde + lData.total + lData.totalSolidaire).toFixed(2);;

			lData.adhSolde = this.solde;
			lData.adhSolde = lData.adhSolde.nombreFormate(2,',',' ');

			lData.totalMarche = (lData.total + lData.totalSolidaire).nombreFormate(2,',',' ');
						
			if(lData.total > 0) {
				lData.total = lData.total.nombreFormate(2,',',' ');
				lData.produit = lCaisseTemplate.achatMarcheDetailProduit.template(lData);
			} else {
				lData.produit = lCaisseTemplate.achatMarcheDetailProduitVide;					
			}
			if(lData.totalSolidaire > 0 ) {
				lData.totalSolidaire = lData.totalSolidaire.nombreFormate(2,',',' ');
				lData.produitSolidaire = lCaisseTemplate.achatMarcheDetailProduitSolidaire.template(lData);
			} else {
				lData.produitSolidaire = lCaisseTemplate.achatMarcheDetailProduitSolidaireVide;
			}
						
			lData.formMarcheVisible = "ui-helper-hidden";
			lData.rechargementVisible = "ui-helper-hidden";
			
			var lData = { 	formulaire : lCaisseTemplate.achatMarcheFormulaire.template(lData),
							detail : lCaisseTemplate.achatMarcheDetail.template(lData)	};
			
			
			$('#contenu').replaceWith( that.affectDetailAchat($(lCaisseTemplate.achatMarchePage.template(lData))) );
			
			that.changerTypePaiement($(":input[name=typepaiement]"));
			that.majNouveauSolde();
			$("#btn-modifier,#btn-confirmer").toggle();
		} else {
			Infobulle.generer(pResponse,'');
		}
	};
	
	this.affect = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectNouveauSolde(pData);
		pData = gCommunVue.comNumeric(pData);
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
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.affectDetailAchat = function(pData) {
		pData = this.affectSelectTypePaiement(pData);
		pData = this.affectNouveauSolde(pData);
		pData = gCommunVue.comNumeric(pData);
		pData = this.affectNouveauPrixProduit(pData);
		pData = this.affectChampComplementaire(pData);
		pData = this.affectValiderModifAchat(pData);
		pData = this.affectAnnuler(pData);
		pData = this.affectModifier(pData);
		pData = this.affectSupprimerPdt(pData);
		pData = this.supprimerSelect(pData);
		pData = this.affectChangementLot(pData);
		pData = this.selectLot(pData);
		pData = this.affectInitLot(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.selectLot = function(pData) {
		$(this.mListeLot).each(function() {
			pData.find('#lot-' + this.idPdt).selectOptions( this.idLot);
		});
		$(this.mListeLotSolidaire).each(function() {
			pData.find('#lot-solidaire-' + this.idPdt).selectOptions( this.idLot);
		});
		return pData;
	};
	
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
	};
	
	this.affectInitLot = function(pData) {
		var that = this;
		pData.find('.ligne-produit select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".produit-id").text();
			var lIdLot = $(this).val();

			if(that.pdtCommande[lIdPdt] && that.pdtCommande[lIdPdt].lots[lIdLot]) {
				var lPrix = that.pdtCommande[lIdPdt].lots[lIdLot].prix;
				var lQte = that.pdtCommande[lIdPdt].lots[lIdLot].taille;
				var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
				
				$(pData).find('#prix-unitaire-' + lIdPdt).text(lprixUnitaire);
			}
		});
		pData.find('.ligne-produit-solidaire select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".produit-id").text();
			var lIdLot = $(this).val();

			if(that.pdtCommande[lIdPdt] && that.pdtCommande[lIdPdt].lots[lIdLot]) {
				var lPrix = that.pdtCommande[lIdPdt].lots[lIdLot].prix;
				var lQte = that.pdtCommande[lIdPdt].lots[lIdLot].taille;
				var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
				
				$(pData).find('#prix-unitaire-solidaire-' + lIdPdt).text(lprixUnitaire);
			}
		});
		return pData;
	};
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.ligne-produit select').change(function() {
			that.changerLot($(this).parent().parent().find(".produit-id").text(),$(this).val());
		});
		pData.find('.ligne-produit-solidaire select').change(function() {
			that.changerLotSolidaire($(this).parent().parent().find(".produit-id").text(),$(this).val());
		});
		return pData;
	};
	
	this.changerLot = function(pIdPdt,pIdLot) {
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		var lQte = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-' + pIdPdt).text(lprixUnitaire);
		$('#produits' + pIdPdt +'quantite,#produits' + pIdPdt + 'prix').val("");		
		
		this.majNouveauSolde();
	};
	
	this.changerLotSolidaire = function(pIdPdt,pIdLot) {
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		var lQte = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-solidaire-' + pIdPdt).text(lprixUnitaire);
		$('#produitsSolidaire' + pIdPdt +'quantite,#produitsSolidaire' + pIdPdt + 'prix').val("");	
		
		this.majNouveauSoldeSolidaire();
	};
		
	this.affectSelectTypePaiement = function(pData) {
		var that = this;
		pData.find(":input[name=typepaiement]").change(function () {
			that.changerTypePaiement($(this));
			that.controlerAchat();
		});
		return pData;
	};
	
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
	};
		
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
	};
	
	this.affectChampComplementaire = function(pData) {
		var that = this;
		pData.find(":input[name=champ-complementaire]").keyup(function() {that.controlerAchat();});		
		return pData;
	};
	
	this.affectValider = function(pData) {
		var that = this;
		pData.find(".btn-valider").click(function() {that.creerRecapitulatif(1);});		
		return pData;
	};
	
	this.affectValiderModifAchat = function(pData) {
		var that = this;
		pData.find(".btn-valider").click(function() {that.creerRecapitulatif(2);});		
		return pData;
	};
	
	this.affectAnnuler = function(pData) {
		var that = this;
		pData.find("#btn-annuler").click(function() {that.retourListe();});		
		return pData;
	};
	
	this.affectModifier = function(pData) {
		var that = this;
		pData.find("#btn-modifier").click(function() {that.boutonModifier();});		
		return pData;
	};
	
	this.affectSupprimerPdt = function(pData) {
		if(pData.find(".ligne-produit").size() == 0) {
			pData.find("#achat-pdt-widget").remove();
		}
		if(pData.find(".ligne-produit-solidaire").size() == 0) {
			pData.find("#achat-pdt-solidaire-widget").remove();
		}
		return pData;
	};
	
	this.majPrixProduit = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		var lIdProduit = ligne.find(".produit-id").text();
		var lIdLot = ligne.find('#lot-'+lIdProduit).val();

		var lPrix = this.pdtCommande[lIdProduit].lots[lIdLot].prix;
		var lQte = this.pdtCommande[lIdProduit].lots[lIdLot].taille;
		//var lprixUnitaire = lPrix / lQte; 
		
		var lNvPrix = (lPrix / lQte * lQuantite).toFixed(2);
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		if(lNvPrix != 0) {
			ligne.find(".produit-prix").val(lNvPrix.nombreFormate(2,',',''));
		} else {
			ligne.find(".produit-prix").val("");
		}
		
		this.majNouveauSolde();		
	};
	
	this.majPrixProduitSolidaire = function(Obj) {
		var lQuantite = parseFloat(Obj.val().numberFrToDb());
		if(isNaN(lQuantite)) {lQuantite = 0;}
		var ligne = Obj.parent().parent();
		
		var lIdProduit = ligne.find(".produit-id").text();
		var lIdLot = ligne.find('#lot-solidaire-'+lIdProduit).val();

		var lPrix = this.pdtCommande[lIdProduit].lots[lIdLot].prix;
		var lQte = this.pdtCommande[lIdProduit].lots[lIdLot].taille;
		//var lprixUnitaire = lPrix / lQte; 
		
		var lNvPrix = (lPrix / lQte * lQuantite).toFixed(2);
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		if(lNvPrix != 0) {
			ligne.find(".produit-solidaire-prix").val(lNvPrix.nombreFormate(2,',',''));
		} else {
			ligne.find(".produit-solidaire-prix").val("");
		}
		
		this.majNouveauSoldeSolidaire();		
	};
		
	this.controlerAchat = function() {
		Infobulle.init(); // Supprime les erreurs
		var lValid = new AchatCommandeValid();
		if(this.idCompte == -3) {
			var lVr = lValid.validAjoutInvite(this.getAchatCommandeVO());
		} else {
			var lVr = lValid.validAjout(this.getAchatCommandeVO());
		}
		Infobulle.generer(lVr,'');
		return lVr;
	};
			
	this.majTotal = function() {
		var lTotal = this.calculerTotal();
		$("#total-achat").text(lTotal.nombreFormate(2,',',' '));
		this.total = lTotal;
		this.majTotalGlobal();		
	};
	
	this.majTotalSolidaire = function() {
		var lTotalSolidaire = this.calculerTotalSolidaire();
		$("#total-achat-solidaire").text(lTotalSolidaire.nombreFormate(2,',',' '));
		this.totalSolidaire = lTotalSolidaire;
		this.majTotalGlobal();		
	};
	
	this.majTotalGlobal = function() {
		var lTotal = this.totalSolidaire + this.total;
		$("#total-global").text(lTotal.nombreFormate(2,',',' '));
	};
	
	this.calculerTotal = function() {
		var lTotal = 0;
		$(".produit-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	};
	
	this.calculerTotalSolidaire = function() {
		var lTotal = 0;
		$(".produit-solidaire-prix").each(function() {
			var lMontant = parseFloat($(this).val().numberFrToDb());
			if(isNaN(lMontant)) {lMontant = 0;}
			lTotal += lMontant;
		});
		return lTotal;		
	};
	
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
	};
	
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
	};
	
	this.calculNouveauSolde = function() {
		var lAchats = this.total;// parseFloat($("#total-achat").val().numberFrToDb());
		if(isNaN(lAchats)) {lAchats = 0;}
		var lAchatsSolidaire = this.totalSolidaire; //parseFloat($("#total-achat-solidaire").val().numberFrToDb());
		if(isNaN(lAchatsSolidaire)) {lAchatsSolidaire = 0;}
		var lRechargement = parseFloat($(":input[name=montant-rechargement]").val().numberFrToDb());
		if(isNaN(lRechargement)) {lRechargement = 0;}		
		return this.solde - lAchats - lAchatsSolidaire + lRechargement;
	};
		
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
	
	this.getAchatCommandeVO = function() {
		var lVo = new AchatCommandeVO();
		lVo.id = this.idCommande;
		lVo.idCompte = this.idCompte;
		lVo.produits = this.getProduitsVO();
		lVo.produitsSolidaire = this.getProduitsSolidaireVO();
		lVo.rechargement = this.getRechargementVO();	
		if(this.idCompte == -3) {
			lVo.solde =	this.calculNouveauSolde(); 
		}	
		//lVo.NbProduits = $('.ligne-produit').size();
		//lVo.NbProduitsSolidaire = $('.ligne-produit-solidaire').size();		
		return lVo;
	};
	
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
	};
	
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
	};
	
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
	};
	
	this.creerRecapitulatif = function(pType) {

		var that = this;
		var lVr = this.controlerAchat();
		if(lVr.valid) {
			if(this.etapeValider == 0) {				
				/*$(".lot-vente-produit, #btn-annuler, #btn-modifier, .recap").toggle();	
				
				$(".lot-vente-produit-select").each(function() {
					var lval = $(this).find('option:selected').text();
					$(this).next().text(lval);
				});
				$(".produit-quantite,.produit-solidaire-quantite").each(function() {
					var lVal = parseFloat($(this).val().numberFrToDb());
					if(isNaN(lVal) || lVal == '' || lVal == 0) {
						lVal = '-';
					} else {
						lVal = lVal.nombreFormate(2,',',' ');
					}
					$(this).next(".recap-produit-quantite").text(lVal);
				});
				$(".produit-prix,.produit-solidaire-prix").each(function() {
					var lVal = parseFloat($(this).val().numberFrToDb());
					if(isNaN(lVal) || lVal == '' || lVal == 0) {
						lVal = '-';
					} else {
						lVal = lVal.nombreFormate(2,',',' ');
					}
					$(this).next(".recap-produit-prix").text(lVal);
				});
				
				var lVal = parseFloat($("#rechargementmontant").val().numberFrToDb());
				if(isNaN(lVal) || lVal == '' || lVal == 0) {
					lVal = '-';
				} else {
					lVal = lVal.nombreFormate(2,',',' ');
				}
				$("#recharger-montant-label").text(lVal);
				
				var lval = $("#rechargementtypePaiement").find('option:selected').val();
				if(lval == 0) {
					$("#rechargementtypePaiement-label").text("-");
				} else {
					$("#rechargementtypePaiement-label").text($("#rechargementtypePaiement").find('option:selected').text());
				}
				
				$("#rechargementchampComplementaire-label").text($("#rechargementchampComplementaire").val());*/
				

				var lVo = this.getAchatCommandeVO();
				
				
				var lCaisseTemplate = new CaisseTemplate();
				var lTemplate = lCaisseTemplate.achatMarcheDetail;
				
				var lData = new Object();
				/*lData.comNumero = pResponse.marche.numero;*/
				
				if(this.idAdherent != 0) {
					lData.adhNumero = this.mAdherent.adhNumero;
					lData.adhCompte = this.mAdherent.cptLabel;
					lData.adhNom = this.mAdherent.adhNom;
					lData.adhPrenom = this.mAdherent.adhPrenom;
				} else {
					lData.adhNumero = "ZZ";
					lData.adhCompte = "CC";
					lData.adhNom = "Invité";
				}
				lData.sigleMonetaire = gSigleMonetaire;
				lData.total = 0;
				lData.totalSolidaire = 0;
				
				lData.categories = [];
				lData.categoriesSolidaire = [];
				lData.categoriesAchat = [];
				lData.categoriesSolidaireAchat = [];
				
				$.each(this.pdtCommande,function() {
					if(this.id) {
						var lProduitCommande = this;
												
						var lProduit = {};
						lProduit.proId = this.id;
						lProduit.nproNom = this.nom;
						lProduit.proUniteMesure = this.unite;
						lProduit.stoQuantite = "";
						lProduit.proPrix = "";
						lProduit.dcomTaille = "";
						
						lProduit.flagType = "";
						if(this.type == 2) {
							lProduit.flagType = lCaisseTemplate.flagAbonnement;
						}
						
						var lIdCategorie = this.idCategorie;
						var lCategorie = this.cproNom;
						
						var lPrix = 0;
						$(lVo.produits).each(function() {
							if(this.id == lProduit.proId) {
								lProduit.stoQuantite = (this.quantite * -1).nombreFormate(2,',',' ');
								lProduit.proPrix = (this.prix * -1).nombreFormate(2,',',' ');
								lPrix = this.prix * -1;
								if(!lData.categoriesAchat[lIdCategorie]) {
									lData.categoriesAchat[lIdCategorie] = {nom:lCategorie,produits:[]};
								}
								lData.categoriesAchat[lIdCategorie].produits.push(lProduit);
							}
						});
						lData.total += lPrix;
						
						var lProduitSolidaire = {};
						lProduitSolidaire.proId = this.id;
						lProduitSolidaire.nproNom = this.nom;
						lProduitSolidaire.proUniteMesure = this.unite;
						lProduitSolidaire.stoQuantite = "";
						lProduitSolidaire.proPrix = "";
						lProduitSolidaire.dcomTaille = "";
						
						lProduitSolidaire.flagType = "";
						if(this.type == 2) {
							lProduitSolidaire.flagType = lCaisseTemplate.flagAbonnement;
						}
						var lPrix = 0;
						$(lVo.produitsSolidaire).each(function() {
							if(this.id == lProduitSolidaire.proId) {
								lProduitSolidaire.stoQuantite = (this.quantite * -1).nombreFormate(2,',',' ');
								lProduitSolidaire.proPrix = (this.prix * -1).nombreFormate(2,',',' ');
								lPrix = this.prix * -1;
								if(!lData.categoriesSolidaireAchat[lIdCategorie]) {
									lData.categoriesSolidaireAchat[lIdCategorie] = {nom:lCategorie,produits:[]};
								}
								lData.categoriesSolidaireAchat[lIdCategorie].produits.push(lProduitSolidaire);
							}
						});
						lData.totalSolidaire += lPrix;
					}
				});

				var lTotal = lData.total;
				var lTotalSolidaire = lData.totalSolidaire;
				var lTotalMarche = lData.total + lData.totalSolidaire;
				lData.totalMarche = lTotalMarche.nombreFormate(2,',',' ');
				lData.total = lData.total.nombreFormate(2,',',' ');
				lData.totalSolidaire = lData.totalSolidaire.nombreFormate(2,',',' ');
				

				lData.adhSolde = this.solde.nombreFormate(2,',',' ');
				var lNvSolde = this.solde - lTotalMarche + lVo.rechargement.montant;
				lData.adhNouveauSolde = lNvSolde.nombreFormate(2,',',' ');
				lData.classSolde = "";
				if(lNvSolde < 0) {
					lData.classSolde = "com-nombre-negatif";
				}
				
				var lVal = parseFloat($("#rechargementmontant").val().numberFrToDb());
				if(isNaN(lVal) || lVal == '' || lVal == 0) {
					lVal = '-';
				} else {
					lVal = lVal.nombreFormate(2,',',' ');
				}
				lData.rechargementMontant = lVal;
				
				var lval = $("#rechargementtypePaiement").find('option:selected').val();
				if(lval == 0) {
					lData.rechargementTypePaiement = "-";
				} else {
					lData.rechargementTypePaiement = $("#rechargementtypePaiement").find('option:selected').text();
				}
				
				lData.rechargementChampComplementaire = $("#rechargementchampComplementaire").val();

				if(lTotal > 0) {
					lData.produit = lCaisseTemplate.achatMarcheDetailProduit.template(lData);
				} else {
					lData.produit = lCaisseTemplate.achatMarcheDetailProduitVide;					
				}
				if(lTotalSolidaire > 0 ) {
					lData.produitSolidaire = lCaisseTemplate.achatMarcheDetailProduitSolidaire.template(lData);
				} else {
					lData.produitSolidaire = lCaisseTemplate.achatMarcheDetailProduitSolidaireVide;
				}
				
				//$("#btn-annuler, #btn-modifier, #achat-marche-formulaire, .btn-valider").toggle();
				
				$("#btn-annuler,#achat-marche-formulaire,#btn-confirmer").hide();
				$("#btn-modifier,#btn-enregistrer").show();
				
				$('#achat-marche-detail').replaceWith( $(lTemplate.template(lData)) ).show();

				this.etapeValider = 1;
			} else if(this.etapeValider == 1) {
				if(pType == 1) {
					this.enregistrerAchat();
				} else if(pType == 2) {
					this.modifierAchat();
				}
			}
		}
	};
	
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
	};
	
	this.modifierAchat = function() {
		var that = this;
		var lVo = this.getAchatCommandeVO();
		
		lVo.idAchat = [];
		$.each(this.mAchatOuReservation,function() {
			lVo.idAchat.push(this.id.idAchat);
		});
		
		lVo.fonction = "modifier";
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
	};
	
	
	this.boutonModifier = function() {
		if(this.etapeValider == 1) {
			/*$(".produit-prix,.produit-solidaire-prix,#rechargementmontant,.produit-quantite,.produit-solidaire-quantite,#rechargementchampComplementaire,#rechargementtypePaiement").each(function() {$(this).textToInput();});
			$(".lot-vente-produit, #btn-annuler, #btn-modifier").toggle();*/
			
			//$(".lot-vente-produit, #btn-annuler, #btn-modifier, .recap").toggle();
			
			//$("#btn-annuler, #btn-modifier, #achat-marche-formulaire, #achat-marche-detail, .btn-valider").toggle();
			
			$("#btn-annuler, #achat-marche-formulaire, #btn-confirmer").show();
			$("#btn-modifier, #achat-marche-detail, #btn-enregistrer").hide();
			
			
			this.etapeValider = 0;
		}
	};
	
	this.retourListe = function() {
		CaisseMarcheCommandeVue({id_commande:this.idCommande});
	};
	
	this.construct(pParam);
}