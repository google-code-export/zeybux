;function CommandeTemplate() {
	this.detailReservation = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div id=\"resa-info-commande\">" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin} <br/>" +
				"</div>" +
				"<div>" +
					"<span>Solde Actuel : </span><span>{solde} {sigleMonetaire}</span><br/>" +
					"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{soldeNv}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma Commande" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN categories -->" +
					"<td class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
					"<td colspan=\"5\"></td>" +
					
					"<!-- BEGIN categories.produits -->" +
					"<tr >" +
						"<td class=\"detail-resa-npro\">{categories.produits.nproNom}</td>" +
						"<td class=\"td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-info-produit\" title=\"Information sur le produit\" id-produit=\"{categories.produits.proId}\">" +
								"<span class=\"ui-icon ui-icon-info\">" +
								"</span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{categories.produits.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{categories.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{categories.produits.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END categories.produits -->" +
					"<!-- END categories -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"4\">Total : </td>" +
						"<td class=\"com-text-align-right\">{total}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<div class=\"boutons-edition com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center \" id=\"btn-modifier\">Modifier</button>" +	
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-valider\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.mesCommandesDetailReservation = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div id=\"resa-info-commande\">" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
				"<div>" +
					"<span>Solde Actuel : </span><span>{solde} {sigleMonetaire}</span><br/>" +
					"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{soldeNv}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma réservation" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN categories -->" +
					"<td class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
					"<td colspan=\"5\"></td>" +
					
					"<!-- BEGIN categories.produits -->" +
					"<tr >" +
						"<td class=\"detail-resa-npro\">{categories.produits.nproNom}</td>" +
						"<td class=\"td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-info-produit\" title=\"Information sur le produit\" id-produit=\"{categories.produits.proId}\">" +
								"<span class=\"ui-icon ui-icon-info\">" +
								"</span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{categories.produits.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{categories.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{categories.produits.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END categories.produits -->" +
					"<!-- END categories -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"4\">Total : </td>" +
						"<td class=\"com-text-align-right\">{total}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<div class=\"boutons-edition com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-modifier\">Modifier</button>" +	
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-supprimer\">Supprimer</button>" +
			"</div>" +
		"</div>";
	
	this.supprimerReservationDialog =
		"<div id=\"dialog-supprimer-reservation\" title=\"Supprimer la réservation\">" +
			"<p>Voulez-vous supprimer la réservation ?</p>" +
		"</div>";
	
	this.reservation =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div id=\"resa-info-commande\">" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin} <br/>" +
				"</div>" +
				"<div>" +
					"<span>Solde Actuel : </span><span>{solde} {sigleMonetaire}</span><br/>" +
					"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{soldeNv}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma Commande" +
				"</div>" +
				"<div>" +
					"<table>" +
					"<!-- BEGIN categories -->" +
						"<tr>" +
							"<td colspan=\"4\" class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
							"<td colspan=\"6\"></td>" +
						"</tr>" +						
						"<!-- BEGIN categories.produits -->" +
						"<tr class=\"pdt\">" +
							"<td><input type=\"checkbox\" {categories.produits.checked}/></td>" +
							"<td><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{categories.produits.proId}</span></span></td>" +
							"<td><span class=\"nom-pro\">{categories.produits.nproNom}<span></td>" +
							"<td class=\"td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-info-produit\" title=\"Information sur le produit\" id-produit=\"{categories.produits.proId}\">" +
									"<span class=\"ui-icon ui-icon-info\">" +
									"</span>" +
								"</span>" +
							"</td>" +
							"<td>" +
								"<select id=\"lot-{categories.produits.proId}\">" +
									"<!-- BEGIN categories.produits.lot -->" +
									"<option value=\"{categories.produits.lot.dcomId}\">par {categories.produits.lot.dcomTaille} {categories.produits.proUniteMesure}</option>" +
									"<!-- END categories.produits.lot -->" +
								"</select>" +
							"</td>" +
							"<td>à <span id=\"prix-unitaire-{categories.produits.proId}\">{categories.produits.prixUnitaire}</span> {sigleMonetaire}/{categories.produits.proUniteMesure}</td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{categories.produits.proId}\"><button class=\"btn-moins\">-</button></td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{categories.produits.proId}\"><span id=\"qte-pdt-{categories.produits.proId}\"></span> {categories.produits.proUniteMesure}</td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{categories.produits.proId}\"><button class=\"btn-plus\">+</button></td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{categories.produits.proId} com-text-align-right\"><span id=\"prix-pdt-{categories.produits.proId}\"></span> {sigleMonetaire}</td>" +
						"</tr>" +
						"<!-- END categories.produits -->" +
						"<!-- END categories -->" +
						"<tr>" +
							"<td colspan=\"9\" class=\"com-text-align-right\">Total : </td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"total\">{total}</span></td>" +
							"<td>{sigleMonetaire}</td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-valider\">Valider</button>" +		
			"</div>" +
		"</div>";
	this.produitIndisponible = 
		"<tr><td colspan=\"11\">Le produit {nom} n'est plus disponible.</td></tr>";
	
	
	this.lotUnique = 
		"<input type=\"hidden\" id=\"lot-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.modifierReservation =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div id=\"resa-info-commande\">" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin} <br/>" +
				"</div>" +
				"<div>" +
					"<span>Solde Actuel : </span><span>{solde} {sigleMonetaire}</span><br/>" +
					"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{soldeNv}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma réservation" +
				"</div>" +
				"<div>" +
					"<table>" +
						"<!-- BEGIN categories -->" +
						"<tr>" +
							"<td colspan=\"4\" class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
							"<td colspan=\"6\"></td>" +
						"</tr>" +						
						"<!-- BEGIN categories.produits -->" +
						"<tr class=\"pdt\">" +
							"<td><input type=\"checkbox\" {categories.produits.checked}/></td>" +
							"<td><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{categories.produits.proId}</span></span></td>" +
							"<td>{categories.produits.nproNom}</td>" +
							"<td class=\"td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-info-produit\" title=\"Information sur le produit\" id-produit=\"{categories.produits.proId}\">" +
									"<span class=\"ui-icon ui-icon-info\">" +
									"</span>" +
								"</span>" +
							"</td>" +
							"<td>" +
								"<select id=\"lot-{categories.produits.proId}\">" +
									"<!-- BEGIN categories.produits.lot -->" +
									"<option value=\"{categories.produits.lot.dcomId}\">par {categories.produits.lot.dcomTaille} {categories.produits.proUniteMesure}</option>" +
									"<!-- END categories.produits.lot -->" +
								"</select>" +
							"</td>" +
							"<td>à <span id=\"prix-unitaire-{categories.produits.proId}\">{categories.produits.prixUnitaire}</span> {sigleMonetaire}/{categories.produits.proUniteMesure}</td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{categories.produits.proId}\"><button class=\"btn-moins\">-</button></td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{categories.produits.proId}\"><span id=\"qte-pdt-{categories.produits.proId}\"></span> {categories.produits.proUniteMesure}</td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{categories.produits.proId}\"><button class=\"btn-plus\">+</button></td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{categories.produits.proId} com-text-align-right\"><span id=\"prix-pdt-{categories.produits.proId}\"></span> {sigleMonetaire}</td>" +
						"</tr>" +
						"<!-- END categories.produits -->" +
						"<!-- END categories -->" +
						"<tr>" +
							"<td colspan=\"9\" class=\"com-text-align-right\">Total : </td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"total\">{total}</span></td>" +
							"<td>{sigleMonetaire}</td>" +
						"</tr>" +
					"</table>" +
					/*"<table>" +
						"<!-- BEGIN produit -->" +
						"<tr class=\"pdt\" id=\"pdt-{produit.proId}\">" +
							"<td class=\"passer-com-radio\" ><input type=\"checkbox\" {produit.checked}/></td>" +
							"<td class=\"passer-com-radio\" ><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span></span></td>" +
							"<td colspan=\"5\" class=\"passer-com-npro\">{produit.nproNom}</td>" +
							"<td>" +
								"<span>{produit.proMaxProduitCommande}</span>" +
								" <span>{produit.proUniteMesure}</span> Max" +
							"</td>" +
							"<td colspan=\"3\"></td>" +
						"</tr>" +
						"<!-- BEGIN produit.lot -->" +
						"<tr class=\"lot lot-pdt-{produit.proId}\">" +
							"<td class=\"passer-com-radio\"><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span><span class=\"lot-id\">{produit.lot.dcomId}</span></span></td>" +
							"<td class=\"passer-com-radio\"><input type=\"radio\" name=\"lot-produit-{produit.proId}\" {produit.lot.checked}/></td>" +
							"<td class=\"com-text-align-right detail-resa-qte\">{produit.lot.dcomTaille}</td>" +
							"<td class=\"detail-resa-unite\">{produit.proUniteMesure}</td>" +
							"<td class=\"com-text-align-right detail-resa-prix\">{produit.lot.dcomPrix}</td>" +
							"<td class=\"passer-com-sigle\" >{sigleMonetaire}</td>" +
							"<td class=\"passer-com-btn-qte\"><button class=\"btn-moins btn-pdt-{produit.proId}\" id=\"btn-moins-lot-{produit.lot.dcomId}\">-</button></td>" +
							"<td class=\"passer-com-qte\"><span id=\"colonne-qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\"><span id=\"qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"qte\">{produit.lot.stoQuantiteReservation}</span>" +
								" <span>{produit.proUniteMesure}</span></span></td>" +
							"<td class=\"passer-com-btn-qte\"><button class=\"btn-plus btn-pdt-{produit.proId}\" id=\"btn-plus-lot-{produit.lot.dcomId}\">+</button></td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"colonne-prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\"><span id=\"prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}\">{produit.lot.prixReservation}</span></span></td>" +
							"<td><span id=\"colonne-sigle-pdt-{produit.proId}-lot-{produit.lot.dcomId}\" class=\"colonne-pdt-{produit.proId}\">{sigleMonetaire}</span></td>" +
						"</tr>" +
						"<!-- END produit.lot -->" +
						"<!-- END produit -->" +
						"<tr>" +
							"<td colspan=\"9\" class=\"com-text-align-right\">Total : </td>" +
							"<td class=\"com-text-align-right detail-resa-prix\"><span id=\"total\">{total}</span></td>" +
							"<td>{sigleMonetaire}</td>" +
						"</tr>" +
					"</table>" +*/
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-annuler\">Annuler</button>" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\" id=\"btn-valider\">Valider</button>" +		
			"</div>" +
		"</div>";
	
	/*this.listeCommandePage = 
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
							"<tr >" +
								"<td class=\"com-table-td com-text-align-right\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td lst-resa-btn-commander\">" +
									"<button class=\"btn-commander ui-state-default ui-corner-all com-button com-center\" id=\"{commande.id}\">Commander</button>" +
								"</td>" +
							"</tr>" +
							"<!-- END commande -->" +
						"</table>" +
					"</div>" +			
				"</div>" +
			"</div>" +
		"</div>";*/
	
	this.confirmationReservationCommande =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<table>" +
				"<!-- BEGIN produit -->" +
				"<tr>" +
					"<td>{produit.NOM}</td>" +
					"<td>{produit.QUANTITE}</td>" +
					"<td>{produit.PRIX}</td>" +
				"</tr>" +
				"<!-- END produit -->" +
					"<tr>" +
					"<td></td><td>Total : </td>" +
					"<td>" +
					"{TOTAL_COMMANDE}" +
					"</td>" +
				"</tr>" +
			"</table>" +
			"<div class=\"ui-helper-hidden\">" +
				"<form id=\"form-confirmation-reservation-commande\">" +
					"<table>" +
						"<tr>" +
							"<td>" +
							"<input type=\"text\" name=\"id_commande\" value=\"{ID_COMMANDE}\" />" +
							"</td>" +
							"</tr>" +
						"<!-- BEGIN info_produit -->" +
						"<tr>" +
							"<td><input type=\"text\" name=\"id_pdt[]\" value=\"{info_produit.IDPDT}\" /></td>" +
							"<td><input type=\"text\" name=\"id_lot[]\" value=\"{info_produit.IDLOT}\" /></td>" +
							"<td><input type=\"text\" name=\"qte[]\" value=\"{info_produit.QTE}\" /></td>" +
						"</tr>" +
						"<!-- END info_produit -->" +								
					"</table>" +
				"</form>" +
			"</div>"+
		"</div>";
	
	this.reservationOk = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Réservation</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Réservation effectuée avec succés.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	/*this.listeCommandeVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
			"</div>" +
		"</div>";*/

	/*this.listeReservation =
	"<div id=\"contenu\">" +
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"Mes Réservations" +
			"</div>" +
			"<table class=\"com-table\">" +
				"<tr class=\"ui-widget ui-widget-header\">" +
					"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
					"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
					"<th class=\"com-table-th\">Marché</th>	" +
				"</tr>" +
				"<!-- BEGIN reservation -->" +
				"<tr class=\"com-cursor-pointer visualiser-reservation\" id={reservation.idCommande} >" +
					"<td class=\"com-table-td com-underline-hover com-text-align-right\">{reservation.numero}</td>" +
					"<td class=\"com-table-td com-underline-hover\">Le {reservation.dateFinReservation} à {reservation.heureFinReservation}H{reservation.minuteFinReservation}</td>" +
					"<td class=\"com-table-td com-underline-hover\">Le {reservation.dateMarcheDebut} de {reservation.heureMarcheDebut}H{reservation.minuteMarcheDebut} à {reservation.heureMarcheFin}H{reservation.minuteMarcheFin}</td>" +
				"</tr>" +
				"<!-- END reservation -->" +
			"</table>" +	
		"</div>" +
		"<div class=\"ui-helper-hidden com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
			"<button class=\"ui-state-default ui-corner-all com-button com-center\">Anciennes commandes</button>" +		
		"</div>" +
	"</div>";	
	*/
	/*this.listeReservationVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Mes Réservations</div>" +
				"<p id=\"texte-liste-vide\">Aucune réservation en cours.</p>" +	
			"</div>" +
			"<div class=\"ui-helper-hidden com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\">Anciennes commandes</button>" +		
			"</div>" +
		"</div>";*/
	
	
	
	this.MonMarcheDebut =
		"<div id=\"contenu\">";
	
	this.listeReservation =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Mes Réservations</div>" +
			"<table class=\"com-table\">" +
				"<tr class=\"ui-widget ui-widget-header\">" +
					"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
					"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
					"<th class=\"com-table-th\">Marché</th>	" +
				"</tr>" +
				"<!-- BEGIN reservation -->" +
				"<tr class=\"com-cursor-pointer visualiser-reservation\" id={reservation.idCommande} >" +
					"<td class=\"com-table-td com-underline-hover com-text-align-right\">{reservation.numero}</td>" +
					"<td class=\"com-table-td com-underline-hover\">Le {reservation.dateFinReservation} à {reservation.heureFinReservation}H{reservation.minuteFinReservation}</td>" +
					"<td class=\"com-table-td com-underline-hover\">Le {reservation.dateMarcheDebut} de {reservation.heureMarcheDebut}H{reservation.minuteMarcheDebut} à {reservation.heureMarcheFin}H{reservation.minuteMarcheFin}</td>" +
				"</tr>" +
				"<!-- END reservation -->" +
			"</table>" +
		"</div>";
	
	this.listeReservationVide =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Mes Réservations</div>" +
			"<p id=\"texte-liste-vide\">Aucune réservation en cours.</p>" +	
		"</div>";
	
	this.listeMarche = 
		"<div id=\"liste_commande_int\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés</div>" +
					"<table class=\"com-table\">" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
							"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
							"<th class=\"com-table-th\">Marché</th>	" +
							"<th class=\"com-table-th\"></th>" +
						"</tr>" +
						"<!-- BEGIN marche -->" +
						"<tr >" +
							"<td class=\"com-table-td com-text-align-right\">{marche.numero}</td>" +
							"<td class=\"com-table-td\">Le {marche.dateFinReservation} à {marche.heureFinReservation}H{marche.minuteFinReservation}</td>" +
							"<td class=\"com-table-td\">Le {marche.dateMarcheDebut} de {marche.heureMarcheDebut}H{marche.minuteMarcheDebut} à {marche.heureMarcheFin}H{marche.minuteMarcheFin}</td>" +
							"<td class=\"com-table-td lst-resa-btn-commander\">" +
								"<button class=\"btn-commander ui-state-default ui-corner-all com-button com-center\" id=\"{marche.id}\">Commander</button>" +
							"</td>" +
						"</tr>" +
						"<!-- END marche -->" +
					"</table>" +
				"</div>" +			
			"</div>" +
		"</div>";
	
	this.listeMarcheVide =
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés</div>" +
			"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
		"</div>";
	
	this.MonMarcheFin =
		"</div>";
	
	this.listeAchats = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Mes Achats" +
				"</div>" +
				"<table class=\"com-table\">" +
					"<tr class=\"ui-widget ui-widget-header\">" +
						"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
						"<th class=\"com-table-th\">Marché</th>	" +
					"</tr>" +
					"<!-- BEGIN achat -->" +
					"<tr class=\"com-cursor-pointer ligne-achat\" id={achat.idCommande} >" +
						"<td class=\"com-table-td com-underline-hover com-text-align-right\">{achat.numero}</td>" +
						"<td class=\"com-table-td com-underline-hover\">Le {achat.dateMarcheDebut}</td>" +
					"</tr>" +
					"<!-- END achat -->" +
				"</table>" +	
			"</div>" +
		"</div>";
	
	this.listeAchatVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Mes Achats</div>" +
				"<p id=\"texte-liste-vide\">Aucun achat effectué.</p>" +		
			"</div>" +
		"</div>";
	
	this.detailAchat = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
			"</div>" +

			"<!-- BEGIN achats -->" +
			"<div class=\"achat com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-{achats.idAchat}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat <span class=\"achat-id ui-helper-hidden\">{achats.idAchat}</span>" +
				"</div>" +
				"<table>" +
				"<!-- BEGIN achats.categories -->" +
					"<tr>" +
						"<td class=\"ui-widget-header ui-corner-all com-center\">{achats.categories.nom}</td>" +
					"</tr>" +
					"<!-- BEGIN achats.categories.achat -->" +
					"<tr>" +
						"<td class=\"detail-achat-npro\">{achats.categories.achat.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-achat-qte\">{achats.categories.achat.stoQuantite}</td>" +						
						"<td class=\"detail-achat-unite\">{achats.categories.achat.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-achat-prix\">{achats.categories.achat.prix} {sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END achats.categories.achat -->" +
				"<!-- END achats.categories -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
						"<td class=\"com-text-align-right detail-achat-prix\">{achats.total} {sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<!-- END achats -->" +
			
			"<!-- BEGIN achatsSolidaire -->" +
			"<div class=\"achatSolidaire com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-{achatsSolidaire.idAchat}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat Solidaire <span class=\"achat-id ui-helper-hidden\">{achatsSolidaire.idAchat}</span>" +
				"</div>" +
				"<table>" +
				"<!-- BEGIN achatsSolidaire.categories -->" +
					"<tr>" +
						"<td class=\"ui-widget-header ui-corner-all com-center\">{achatsSolidaire.categories.nom}</td>" +
					"</tr>" +
					"<!-- BEGIN achatsSolidaire.categories.achat -->" +
					"<tr>" +
						"<td class=\"detail-achat-npro\">{achatsSolidaire.categories.achat.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-achat-qte\">{achatsSolidaire.categories.achat.stoQuantite}</td>" +						
						"<td class=\"detail-achat-unite\">{achatsSolidaire.categories.achat.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-achat-prix\">{achatsSolidaire.categories.achat.prix} {sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END achatsSolidaire.categories.achat -->" +
				"<!-- END achatsSolidaire.categories -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
						"<td class=\"com-text-align-right detail-achat-prix\">{achatsSolidaire.totalSolidaire} {sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<!-- END achatsSolidaire -->" +
		"</div>";
	
	this.dialogInfoProduit = 
		"<div id=\"dialog-info-pro\" title=\"Produit\">" +
			"<div id=\"information-detail-producteur\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations</div>" +
				"<div class=\"com-widget-content\">" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Nom : </th>" +
							"<td class=\"com-table-form-td\">{nom}</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Catégorie : </th>" +
							"<td class=\"com-table-form-td\">{cproNom}</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Description : </th>" +
							"<td class=\"com-table-form-td\">{description}</td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			
			"<div id=\"pro-prdt\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Producteurs</div>" +
				"<table class=\"com-table-form\">" +
					"<!-- BEGIN producteurs -->" +
					"<tr>" +
						"<td class=\"com-table-form-td\">" +
							"{producteurs.prdtPrenom} {producteurs.prdtNom}" +
						"</td>" +
					"</tr>" +
					"<!-- END producteurs -->" +
				"</table>" +
			"</div>" +
			
			"<div id=\"pro-car\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Caractéristiques</div>" +
				"<table class=\"com-table-form\">" +
					"<!-- BEGIN caracteristiques -->" +
					"<tr>" +
						"<td class=\"com-table-form-td\">" +
							"{caracteristiques.carNom}" +
						"</td>" +
					"</tr>" +
					"<!-- END caracteristiques -->" +
				"</table>" +
			"</div>" +
		"</div>";
};function AfficherReservationVue(pParam) {
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = new Array();
	this.reservationModif = new Array();
	this.solde = 0;
	this.soldeNv = 0;
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = "afficher";
		$.history( {'vue':function() {AfficherReservationVue(pParam);}} );
		$.post(	"./index.php?m=Commande&v=AfficherReservation","pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.solde = lResponse.adherent.cptSolde;	
							that.soldeNv = lResponse.adherent.cptSolde;
							
							that.infoCommande.comId = lResponse.marche.id;
							that.infoCommande.comNumero = lResponse.marche.numero;
							that.infoCommande.comNom = lResponse.marche.nom;
							that.infoCommande.comDescription = lResponse.marche.description;
							that.infoCommande.dateTimeFinReservation = lResponse.marche.dateFinReservation;
							that.infoCommande.dateFinReservation = lResponse.marche.dateFinReservation.extractDbDate().dateDbToFr();
							that.infoCommande.heureFinReservation = lResponse.marche.dateFinReservation.extractDbHeure();
							that.infoCommande.minuteFinReservation = lResponse.marche.dateFinReservation.extractDbMinute();
							that.infoCommande.dateMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbDate().dateDbToFr();
							that.infoCommande.heureMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbHeure();
							that.infoCommande.minuteMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbMinute();
							that.infoCommande.heureMarcheFin = lResponse.marche.dateMarcheFin.extractDbHeure();
							that.infoCommande.minuteMarcheFin = lResponse.marche.dateMarcheFin.extractDbMinute();
							that.infoCommande.comArchive = lResponse.marche.archive;
							
							that.pdtCommande = lResponse.marche.produits;						
							$.each(that.pdtCommande,function() {
								if(this.id) {
									var lIdProduit = this.id;
									$.each(this.lots, function() {
										if(this.id) {
											var lIdLot = this.id;
											$(lResponse.reservation).each(function() {
												if(this.idDetailCommande == lIdLot) {
													this.stoQuantite = this.quantite * -1;
													this.dcomId = this.idDetailCommande;
													this.proId = lIdProduit;
													that.reservation[lIdProduit] = this;
												}											
											});
										}
									});
								}
							});
							
							that.afficher();
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
		
	}
	
	this.afficher = function() {		
		this.afficherDetailReservation();		
	}
	
	this.afficherDetailReservation = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.mesCommandesDetailReservation;
		
		var lData = new Object();
		lData.sigleMonetaire = gSigleMonetaire;
		lData.solde = this.solde.nombreFormate(2,',',' ');
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		//lData.reservation = new Array();
		lData.categories = [];
		
		var lTotal = 0;
		$.each(this.pdtCommande, function() {
			var lIdProduit = this.id;
			if(that.reservation[this.id]) {
				var lPdt = new Object;
				lPdt.proId = lIdProduit;
				lPdt.nproNom = this.nom;
				lPdt.stoQuantite = parseFloat(that.reservation[this.id].stoQuantite);
				lPdt.proUniteMesure = this.unite;
				lPdt.prix = 0;
				var lDcomId = that.reservation[this.id].dcomId;
				$.each(this.lots, function() {
					if(this.id == lDcomId) {
						lPdt.prix = (lPdt.stoQuantite / this.taille) * this.prix;
					}
				});
				lTotal += lPdt.prix;
				
				lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
				lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
				
				//lData.reservation.push(lPdt);

				if(!lData.categories[this.idCategorie]) {
					lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
				}
				lData.categories[this.idCategorie].produits.push(lPdt);
			}			
		});
		lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
		
		
		// Maj du nouveau solde
		this.soldeNv = this.solde - lTotal;
		lData.soldeNv = this.soldeNv.nombreFormate(2,',',' ');
		
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
		//this.majNouveauSolde();
	}
	
	this.afficherModifier = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.modifierReservation;
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;
		lData.solde = this.solde.nombreFormate(2,',',' ');
		lData.soldeNv = this.soldeNv.nombreFormate(2,',',' ');
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		//lData.produit = new Array();
		lData.categories = [];
				
		var lTotal = 0;		
		$.each(this.pdtCommande, function() {
			// Test si la ligne n'est pas vide
			if(this.id) {
				var lPdt = {};
				lPdt.proId = this.id;
				lPdt.nproNom = this.nom;
				lPdt.proUniteMesure = this.unite;
				
				lPdt.proMaxProduitCommande = parseFloat(this.qteMaxCommande);
								
				// Recherche de la quantité reservée pour la déduire de la quantité max
				if(that.reservation[this.id]) {
					lPdt.stock = parseFloat(this.stockReservation) + parseFloat(that.reservation[this.id].stoQuantite);						
				} else {
					lPdt.stock = parseFloat(this.stockReservation);
				}
				
				/*if(parseFloat(lPdt.proMaxProduitCommande) < parseFloat(lPdt.stock)) {
					lPdt.max = lPdt.proMaxProduitCommande;
				} else {
					lPdt.max = lPdt.stock;
				}*/
				
				lPdt.lot = new Array();

				var lNoStock = false;
				if(parseFloat(this.qteMaxCommande) == -1 && parseFloat(this.stockInitial) == -1) { // Si ni stock ni qmax
					lNoStock = true;
				} else if(parseFloat(this.stockInitial) == -1) { // Si qmax mais pas stock
					lPdt.max = lPdt.proMaxProduitCommande;
				} else if(parseFloat(this.qteMaxCommande) == -1) { // Si stock mais pas qmax
					lPdt.max = lPdt.stock;
				} else { // Si stock et qmax
					if(parseFloat(lPdt.proMaxProduitCommande) < parseFloat(lPdt.stock)) {
						lPdt.max = lPdt.proMaxProduitCommande;
					} else {
						lPdt.max = lPdt.stock;
					}					
				}
				
				var i = 0;
				var lLotReservation = -1;
				var lLotInit = -1;
				
				$.each(this.lots, function() {
					if(this.id) {
						if(lNoStock || (!lNoStock && parseFloat(this.taille) <= lPdt.max) ) {
							var lLot = {};
							lLot.dcomId = this.id;
							lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
							lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
							lLot.prixReservation = parseFloat(this.prix);
							lLot.stoQuantiteReservation = parseFloat(this.taille);
							
							if(that.reservation[lPdt.proId] && (that.reservation[lPdt.proId].dcomId == this.id)) {
									lLot.stoQuantiteReservation = parseFloat(that.reservation[lPdt.proId].stoQuantite);
									lLot.prixReservation = (lLot.stoQuantiteReservation / this.taille) * this.prix;
									lTotal += lLot.prixReservation;
									
									// Permet de cocher le lot correspondant à la résa
									lLotReservation = this.id;
									lLot.checked = 'checked="checked"';
							}
							
							lPdt.prixUnitaire = (lLot.prixReservation / lLot.stoQuantiteReservation).nombreFormate(2,',',' '); 						
							lPdt.stoQuantiteReservation = lLot.stoQuantiteReservation.nombreFormate(2,',',' ');
							lPdt.prixReservation = lLot.prixReservation.nombreFormate(2,',',' ');
							
							lPdt.lot.push(lLot);
						}
					}
				});
				
				lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
				
				// Si il y a une réservation pour ce produit on le coche
				if(lLotReservation != -1) {
					lPdt.checked = 'checked="checked"';
				} else {
					lPdt.checked = '';
				}
				
				if(lPdt.lot.length == 0) {		
					lPdt.checked = 'rel="indisponible"';
				}
				//lData.produit.push(lPdt);
				if(!lData.categories[this.idCategorie]) {
					lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
				}
				lData.categories[this.idCategorie].produits.push(lPdt);
			}
		});
		
		// Maj des reservations temp pour modif
		this.reservationModif = [];
		$(this.reservation).each(function() {
			if(this.proId) {
					that.reservationModif[this.proId] = {
						proId:this.proId,
						dcomId:this.dcomId,
						stoQuantite:this.stoQuantite
						};
			}
		});
		
		$('#contenu').replaceWith(that.affectModifier($(lTemplate.template(lData))));
		this.majNouveauSolde();
	}
	
	this.affect = function(pData) {
		pData = this.affectDroitEdition(pData);
		pData = this.affectModifierReservation(pData);
		pData = this.affectSupprimerReservation(pData);
		pData = this.affectNvSolde(pData);
		pData = this.affectInfoProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectInfoProduit = function(pData) {
		var that = this;
		pData.find('.btn-info-produit')
		.click(function() {		
			var lId = $(this).attr('id-produit');
			var lParam = {id:lId,fonction:"detailProduit"};
			$.post(	"./index.php?m=Commande&v=AfficherReservation", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lCommandeTemplate = new CommandeTemplate();
								var lTemplate = lCommandeTemplate.dialogInfoProduit;
								
								lResponse.produit.sigleMonetaire = gSigleMonetaire;
								
								var lHtml = $(lTemplate.template(lResponse.produit));
								
								if(lResponse.produit.producteurs.length > 0 && lResponse.produit.producteurs[0].nPrdtIdNomProduit == null) {
									lHtml.find('#pro-prdt').remove();
								}
								if(lResponse.produit.caracteristiques.length > 0 && lResponse.produit.caracteristiques[0].carProIdNomProduit == null) {
									lHtml.find('#pro-car').remove();
								}
								
								$(lHtml).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:600,
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								});								
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
			
		});
		return pData;
	}
	
	this.affectDroitEdition = function(pData) {
		// Si la date de fin des réservations est passée on bloque la possibilitée de modifier
		if(!dateTimeEstPLusGrandeEgale(this.infoCommande.dateTimeFinReservation,getDateTimeAujourdhuiDb(),'db')) {
			pData.find('.boutons-edition').hide();
		}
		return pData;
	}
	
	this.affectModifier = function(pData) {
		pData = this.affectBtnQte(pData);
		pData = this.affectChangementLot(pData);
		pData = this.affectChangementProduit(pData);
		pData = this.preparerAffichageModifier(pData);
		pData = this.affectValiderReservation(pData);
		pData = this.affectAnnulerReservation(pData);
		pData = this.supprimerSelect(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectInitLot(pData);
		pData = this.affectInfoProduit(pData);
		pData = this.masquerIndisponible(pData);
		return pData;
	}
	
	this.affectNvSolde = function(pData) {
		if(this.soldeNv <= 0) {
			pData.find("#nouveau-solde, #nouveau-solde-sigle").addClass("com-nombre-negatif");	
		}
		return pData;
	}
	
	this.affectBtnQte = function(pData) {
		var that = this;
		pData.find('.btn-plus').click(function() {
			var lIdPdt = $(this).parent().parent().find(".pdt-id").text();
			that.nouvelleQuantite(	lIdPdt,
									$(this).parent().parent().find('#lot-' + lIdPdt).val(),
									1);
		});	
		pData.find('.btn-moins').click(function() {
			var lIdPdt = $(this).parent().parent().find(".pdt-id").text();
			that.nouvelleQuantite(lIdPdt,$(this).parent().parent().find('#lot-' + lIdPdt).val(),-1);
		});
		return pData;		
	}
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.pdt select').change(function() {
			that.changerLot($(this).parent().parent().find(".pdt-id").text(),$(this).val());
		});
		return pData;
	}
	
	this.affectChangementProduit = function(pData) {
		var that = this;
		pData.find('.pdt :checkbox').click(function() {
			that.changerProduit($(this).parent().parent().find(".pdt-id").text());			
		});
		return pData;
	}
	
	this.affectValiderReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.validerReservation();			
		});
		return pData;	
	}
	
	this.affectAnnulerReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {			
			that.afficherDetailReservation();		
		});
		return pData;
	}
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.afficherModifier();		
		});
		return pData;
	}
	
	this.masquerIndisponible = function(pData) {
		pData.find("[rel='indisponible']").each(function() {
			var lCommandeTemplate = new CommandeTemplate();
			var lTemplate = lCommandeTemplate.produitIndisponible;
			var lData = {nom:$(this).parents(".pdt").find(".nom-pro").text()};			
			$(this).parents(".pdt").before(lTemplate.template(lData));
			$(this).parents(".pdt").remove();
		});		
		return pData;
	}
	
	this.affectInitLot = function(pData) {
		var that = this;
		pData.find('.pdt select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".pdt-id").text();
			var lIdLot = $(this).val();
			
			if(that.pdtCommande[lIdPdt].lots[lIdLot]) {
				var lPrix = that.pdtCommande[lIdPdt].lots[lIdLot].prix;
				var lQte = that.pdtCommande[lIdPdt].lots[lIdLot].taille;
				var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
				
				$(pData).find('#prix-unitaire-' + lIdPdt).text(lprixUnitaire);
			}
		});
		return pData;
	}
	
	this.nouvelleQuantite = function(pIdPdt,pIdLot,pIncrement) {
		// La quantité max soit qte max soit stock
		var lMax = parseFloat(this.pdtCommande[pIdPdt].qteMaxCommande);
		
		// Recherche de la quantité reservée pour la déduire de la quantité max
		if(this.reservationModif[pIdPdt]) {
			var lStock = parseFloat(this.pdtCommande[pIdPdt].stockReservation) + parseFloat(this.reservationModif[pIdPdt].stoQuantite);						
		} else {
			var lStock = parseFloat(this.pdtCommande[pIdPdt].stockReservation);
		}
		//if(parseFloat(lStock) < parseFloat(lMax)) { lMax = lStock; }
		
		
		
		var lNoStock = false;
		if(parseFloat(this.pdtCommande[pIdPdt].qteMaxCommande) == -1 && parseFloat(this.pdtCommande[pIdPdt].stockInitial) == -1) { // Si ni stock ni qmax
			lNoStock = true;
		} else if(parseFloat(this.pdtCommande[pIdPdt].stockInitial) == -1) { // Si qmax mais pas stock
			lMax = this.pdtCommande[pIdPdt].qteMaxCommande;
		} else if(parseFloat(this.pdtCommande[pIdPdt].qteMaxCommande) == -1) { // Si stock mais pas qmax
			lMax = lStock;
		} else { // Si stock et qmax
			if(parseFloat(lStock) < parseFloat(lMax)) { lMax = lStock; }				
		}
		
		var lTaille = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservationModif[pIdPdt] && (this.reservationModif[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = parseFloat(this.reservationModif[pIdPdt].stoQuantite)/parseFloat(lTaille);
		}
		lQteReservation += pIncrement;

		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNoStock || (!lNoStock && lNvQteReservation > 0 && lNvQteReservation <= lMax)) {
			var lNvPrix = 0;
			lNvPrix = (lQteReservation * lPrix).toFixed(2);
			
			// Mise à jour de la quantite reservée
			this.reservationModif[pIdPdt].stoQuantite = lNvQteReservation;			
			
			$('#qte-pdt-' + pIdPdt).text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt).text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

			this.majTotal();
		} else if(lNvQteReservation > lMax) {
			var lVr = new TemplateVR();
			lVr.valid = false;
			lVr.log.valid = false;
			var erreur = new VRerreur();
			erreur.code = ERR_304_CODE;
			erreur.message = ERR_304_MSG;
			lVr.log.erreurs.push(erreur);							
			
			Infobulle.generer(lVr,'');
		}		
	}
	
	this.changerLot = function(pIdPdt,pIdLot) {
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		var lQte = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-' + pIdPdt).text(lprixUnitaire);
		
		if(this.reservationModif[pIdPdt]) {
			this.reservationModif[pIdPdt].dcomId = pIdLot;
			this.reservationModif[pIdPdt].stoQuantite = lQte;
			$('#qte-pdt-' + pIdPdt).text(lQte.nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt).text(lPrix.nombreFormate(2,',',' '));
		}
		
		this.majTotal();
	}
	
	this.changerProduit = function(pIdPdt) {
		if(this.reservationModif[pIdPdt] != null) {
			$('.resa-pdt-' + pIdPdt).hide();
			$('#qte-pdt-' + pIdPdt).text('');
			$('#prix-pdt-' + pIdPdt).text('');
			this.reservationModif[pIdPdt] = null;
		} else {
			var lIdLot = $('#lot-' + pIdPdt).val();
			var lQte = this.pdtCommande[pIdPdt].lots[lIdLot].taille;			
			
			var lResa = {};
			lResa.comId = this.infoCommande.comId;
			lResa.proId = pIdPdt;
			lResa.dcomId = lIdLot;
			lResa.stoQuantite = lQte;						
			this.reservationModif[pIdPdt] = lResa;
			
			$('#qte-pdt-' + pIdPdt).text(lQte.nombreFormate(2,',',' '));
			var lPrix = this.pdtCommande[pIdPdt].lots[lIdLot].prix.nombreFormate(2,',',' ');
			$('#prix-pdt-' + pIdPdt).text(lPrix);
			
			$('.resa-pdt-' + pIdPdt).show();
		}
		this.majTotal();
	}
	
	this.majTotal = function() {		
		//$('#total').text(this.calculTotal().nombreFormate(2,',',' '));
		var lTotal = this.calculTotal();		
		$('#total').text(lTotal.nombreFormate(2,',',' '));
		
		// Maj du nouveau solde
		this.soldeNv = this.solde - lTotal;
		this.majNouveauSolde();
		$("#nouveau-solde").text(this.soldeNv.nombreFormate(2,',',' '));
	}

	this.majNouveauSolde = function() {
		if(this.soldeNv <= 0) {
			$("#nouveau-solde, #nouveau-solde-sigle").addClass("com-nombre-negatif");	
		} else {
			$("#nouveau-solde, #nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
	}
	
	this.calculTotal = function() {
		var that = this;
		var lTotal = 0;
		$(this.reservationModif).each(function() {
			var lResa = this;
			if(lResa.stoQuantite) {
				if(that.pdtCommande[lResa.proId]) {
					$.each(that.pdtCommande[lResa.proId].lots, function() {
						if(lResa.dcomId == this.id) {
							lTotal += (lResa.stoQuantite / this.taille) * this.prix;
						}
					});					
				}				
			}
		});
		return lTotal;
	}
	
	this.preparerAffichageModifier = function(pData) {
		var that = this;
		
		$(pData).find('.pdt').each(function() {
			var lIdPdt = $(this).find('.pdt-id').text();
			if(that.reservation[lIdPdt] != null) {
				var lResa = that.reservation[lIdPdt];
				var lIdLot = lResa.dcomId;
				var lQte = lResa.stoQuantite;			
				$(pData).find('#qte-pdt-' + lIdPdt).text(lQte.nombreFormate(2,',',' '));
				
				var lPrix = ((that.pdtCommande[lIdPdt].lots[lIdLot].prix * lResa.stoQuantite)/that.pdtCommande[lIdPdt].lots[lIdLot].taille).nombreFormate(2,',',' ');
				$(pData).find('#prix-pdt-' + lIdPdt).text(lPrix);
				$(pData).find('#lot-' + lIdPdt).selectOptions(lIdLot);
				
				//$(pData).find('.resa-pdt-' + lIdPdt).show();
				$(pData).find('.resa-pdt-' + lIdPdt).css("display","table-cell"); //Show ne fonctionne pas sur chrome
			}
		});
		return pData;
	}
	
	this.validerReservation = function() {
		var that = this;
		Infobulle.init(); // Supprime les erreurs
		
		var lVo = new ListeReservationCommandeVO();
		var lNbPdt = 0;
		$(this.reservationModif).each(function() {
			if(this.stoQuantite) {
				var lVoResa = new ReservationCommandeVO();
				lVoResa.stoQuantite = this.stoQuantite * -1;
				lVoResa.stoIdDetailCommande = this.dcomId;		
				lVo.detailReservation.push(lVoResa);
				lNbPdt++;
			}
		});
		
		if(lNbPdt > 0){
			var lValid = new ListeReservationCommandeValid();
			var lVR = lValid.validAjout(lVo);
			if(!lVR.valid){
				Infobulle.generer(lVR,'');
			} else {
				// Maj de la reservation
				lVo.fonction = "modifier";
				$.post(	"./index.php?m=Commande&v=AfficherReservation", "pParam=" + $.toJSON(lVo),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {							
								// Maj des reservations pour le recap
								that.reservation = [];
								$(that.reservationModif).each(function() {
									if(this.proId) {
										that.reservation[this.proId] = {
												proId:this.proId,
												dcomId:this.dcomId,
												stoQuantite:this.stoQuantite
												};
									}
								});
								that.afficher();
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
				);				
			}			
		} else {
			var lVR = new TemplateVR();
			lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_207_CODE;erreur.message = ERR_207_MSG;lVR.log.erreurs.push(erreur);
			Infobulle.generer(lVR,'');
		}		
	}
	
	this.affectSupprimerReservation = function(pData) {
		var that = this;
		pData.find('#btn-supprimer').click(function() {
			var lCommandeTemplate = new CommandeTemplate();
			var lTemplate = lCommandeTemplate.supprimerReservationDialog;
			$(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {	id_commande:that.infoCommande.comId,
										fonction:"supprimer"};
						var lDialog = this;
						$.post(	"./index.php?m=Commande&v=AfficherReservation", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											
											// Message d'information de la bonne suppression
											var lVr = new TemplateVR();
											lVr.valid = false;
											lVr.log.valid = false;
											var erreur = new VRerreur();
											erreur.code = ERR_303_CODE;
											erreur.message = ERR_303_MSG;
											lVr.log.erreurs.push(erreur);							
	
											// Redirection vers la liste des réservations
											MonMarcheVue({vr:lVr});
											
											$(lDialog).dialog("close");										
										} else {
											Infobulle.generer(lResponse,'');
										}
									}
								},"json"
						);
					},
					'Annuler': function() { $(this).dialog("close"); }
					},
				close: function(ev, ui) { $(this).remove(); }
			})
		});
		return pData;
	}
	
	this.supprimerSelect = function(pData) {
		pData.find('.pdt select').each(function() {
			if($(this).find('option').size() == 1) {				
				var lCommandeTemplate = new CommandeTemplate();
				var lTemplate = lCommandeTemplate.lotUnique;
				var lData = {};
				lData.IdPdt = $(this).parent().parent().find(".pdt-id").text();
				lData.valeur = $(this).val();
				lData.text = $(this).text();
				
				$(this).replaceWith(lTemplate.template(lData));
			}
		});
		
		return pData;
	}
		
	this.construct(pParam);
};function MesAchatsVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {MesAchatsVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=Commande&v=MesAchats", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
							// Maj du Menu
							var lCommunVue = new CommunVue();
							lCommunVue.majMenu('Commande','MesAchats');
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		Infobulle.init(); // Supprime les erreurs
		var that = this;
		
		var lCommandeTemplate = new CommandeTemplate();
		
		var lListeAchats = {achat:[]};		
		// Transforme les dates pour l'affichage
			$(lResponse.achats).each(function() {
				if(this.comNumero != null) {
					var lachat = {};
					lachat.numero = this.comNumero;
					lachat.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();					
					lachat.idCommande = '"' + this.comId + '"';
	
					lListeAchats.achat.push(lachat);
				}
			});
			
		// Affiche la liste ou un message si celle-ci est vide
		if(lListeAchats.achat.length > 0) {
			$('#contenu').replaceWith(that.affect($(lCommandeTemplate.listeAchats.template(lListeAchats))));		
		} else {
			$('#contenu').replaceWith(that.affect($(lCommandeTemplate.listeAchatVide)));
		}
	}
	
	this.affect = function(pData) {
		//pData = this.affectBtnCommander(pData);
		pData = this.affectVisualiser(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	/*this.affectBtnCommander = function(pData) {
		pData.find('.btn-commander').click(function() {
			var lParam = {id_commande:$(this).attr('id')};
			ReservationMarcheVue(lParam);
		});
		return pData;
	}*/	
	this.affectVisualiser = function(pData) {
		pData.find('.ligne-achat').click(function() {
				MesAchatsDetailVue({id_commande:$(this).attr('id')});
			});		
		return pData;
	}
		
	this.construct(pParam);
};function MesAchatsDetailVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.achats = [];
	this.achatsSolidaire = [];
	this.stockSolidaire = [];
	this.pParam = {};

	this.construct = function(pParam) {
		$.history( {'vue':function() {MesAchatsDetailVue(pParam);}} );
		var that = this;
		this.pParam = pParam;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=Commande&v=MesAchatsDetail", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.pdtCommande = lResponse.marche.produits;
							that.infoCommande.comNumero = lResponse.marche.numero;
							that.stockSolidaire = lResponse.stockSolidaire;
					
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.detailAchat;
		
		var lData = {};
		lData.comNumero = this.infoCommande.comNumero;
		lData.sigleMonetaire = gSigleMonetaire;

		lData.achats = [];
		//lData.categories = [];
		
		lData.achatsSolidaire = [];

		$(pResponse.achats).each(function() {
			var lAchat = this;
			var lDataPdtAchat = [];
			var lAchatClassique = false;
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lIdProduit = this.id;
					
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					
					lPdt.prix = 0;
					lPdt.stoQuantite = 0;
					
					$.each(this.lots, function() {
						if(this.id) {
							var lIdLot = this.id;
							$(lAchat.detailAchat).each(function() {
								if(this.idDetailCommande == lIdLot) {
									lPdt.stoQuantite = this.quantite * -1;
									lPdt.prix = this.montant * -1;
									lAchatClassique = true;
								}
							});
						}
					});

					lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
					lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
					

					
					if(!lDataPdtAchat[this.idCategorie]) {
						lDataPdtAchat[this.idCategorie] = {nom:this.cproNom,achat:[]};
					}
					lDataPdtAchat[this.idCategorie].achat.push(lPdt);
					
					
					
					//lDataPdtAchat.push(lPdt);
				}
			});
			
			if(lAchatClassique) {
				var lDataAchat = {	categories:lDataPdtAchat,
									idAchat:this.id.idAchat,
									total:(this.total * -1).nombreFormate(2,',',' ')};				
				
				lData.achats.push(lDataAchat);
			}
		});

		$(pResponse.achats).each(function() {
			var lAchat = this;
			var lDataPdtAchat = [];
			var lAchatSolidaire = false;
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lAchatPdtSolidaire = false;
					var lProduit = this;
					var lIdProduit = this.id;
					
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					
					lPdt.prix = 0;
					lPdt.stoQuantite = 0;

					$(pResponse.stockSolidaire).each(function() {
						if(lPdt.id == this.proId){
							$.each(lProduit.lots, function() {
								if(this.id) {
									var lIdLot = this.id;
									$(lAchat.detailAchatSolidaire).each(function() {
										if(this.idDetailCommande == lIdLot) {
											lPdt.stoQuantite = this.quantite * -1;
											lPdt.prix = this.montant * -1;
											lAchatSolidaire = true;
											lAchatPdtSolidaire = true;
										}
									});
								}
							});
						}
					});

					if(lAchatPdtSolidaire) {
						lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
						lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');		
						
						if(!lDataPdtAchat[this.idCategorie]) {
							lDataPdtAchat[this.idCategorie] = {nom:this.cproNom,achat:[]};
						}
						lDataPdtAchat[this.idCategorie].achat.push(lPdt);
						
						//lDataPdtAchat.push(lPdt);
					}
				}
			});
			if(lAchatSolidaire) {
				var lDataAchat = {	categories:lDataPdtAchat,
									idAchat:this.id.idAchat,
									totalSolidaire:(this.totalSolidaire * -1).nombreFormate(2,',',' ')};
				lData.achatsSolidaire.push(lDataAchat);
			}
		});
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	}
	
	this.affect = function(pData) {
		return pData;
	}
		
	this.construct(pParam);
};function MonMarcheVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {MonMarcheVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=Commande&v=MonMarche", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
							// Maj du Menu
							var lCommunVue = new CommunVue();
							lCommunVue.majMenu('Commande','MonMarche');
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		var lCommandeTemplate = new CommandeTemplate();
		var lHtml = lCommandeTemplate.MonMarcheDebut;
		
		var lListeReservation = new Object;
		lListeReservation.reservation = new Array();
		
		// Transforme les dates pour l'affichage
			$(lResponse.reservations).each(function() {
				if(this.comNumero != null) {
					var lReservation = new Object();
					lReservation.numero = this.comNumero;
										
					lReservation.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lReservation.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lReservation.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lReservation.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lReservation.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lReservation.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lReservation.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lReservation.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
					
					lReservation.idCommande = '"' + this.comId + '"';
	
					lListeReservation.reservation.push(lReservation);
				}
			});
			
		// Affiche la liste ou un message si celle-ci est vide
		if(lListeReservation.reservation.length > 0) {			
			lHtml += lCommandeTemplate.listeReservation.template(lListeReservation);			
		} else {
			lHtml += lCommandeTemplate.listeReservationVide;
		}
		
		// Test si la liste est vide
		if(lResponse.marches[0] && lResponse.marches[0].dateFinReservation != null) {
			var lMarches = new Object;
			lMarches.marche = new Array();
			
				$(lResponse.marches).each(function() {
					var lmarche = new Object();
					lmarche.id = this.id;
					lmarche.numero = this.numero;
					lmarche.dateFinReservation = this.dateFinReservation.extractDbDate().dateDbToFr();
					lmarche.heureFinReservation = this.dateFinReservation.extractDbHeure();
					lmarche.minuteFinReservation = this.dateFinReservation.extractDbMinute();
					
					lmarche.dateMarcheDebut = this.dateMarcheDebut.extractDbDate().dateDbToFr();
					lmarche.heureMarcheDebut = this.dateMarcheDebut.extractDbHeure();
					lmarche.minuteMarcheDebut = this.dateMarcheDebut.extractDbMinute();
					
					lmarche.heureMarcheFin = this.dateMarcheFin.extractDbHeure();
					lmarche.minuteMarcheFin = this.dateMarcheFin.extractDbMinute();
						
					lMarches.marche.push(lmarche);
				});
			lHtml += lCommandeTemplate.listeMarche.template(lMarches);	
		} else {
			lHtml += lCommandeTemplate.listeMarcheVide;
		}
		lHtml += lCommandeTemplate.MonMarcheFin;
		$('#contenu').replaceWith(that.affect($(lHtml)));
	}
	this.affect = function(pData) {
		pData = this.affectBtnCommander(pData);
		pData = this.affectVisualiser(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	this.affectBtnCommander = function(pData) {
		pData.find('.btn-commander').click(function() {
			var lParam = {id_commande:$(this).attr('id')};
			ReservationMarcheVue(lParam);
		});
		return pData;
	}	
	this.affectVisualiser = function(pData) {
		pData.find('.visualiser-reservation').click(function() {
				AfficherReservationVue({id_commande:$(this).attr('id')});
			});		
		return pData;
	}
		
	this.construct(pParam);
};function ReservationMarcheVue(pParam) {
	this.infoCommande = new Object();
	this.pdtCommande = [];
	this.reservation = new Array();
	this.solde = 0;
	this.soldeNv = 0;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ReservationMarcheVue(pParam);}} );
		var that = this;
		pParam.fonction = "detailMarche";
		$.post(	"./index.php?m=Commande&v=ReservationCommande","pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.solde = lResponse.adherent.cptSolde;	
							that.soldeNv = lResponse.adherent.cptSolde;
							
							that.infoCommande.comId = lResponse.marche.id;
							that.infoCommande.comNumero = lResponse.marche.numero;
							that.infoCommande.comNom = lResponse.marche.nom;
							that.infoCommande.comDescription = lResponse.marche.description;
							that.infoCommande.dateTimeFinReservation = lResponse.marche.dateFinReservation;
							that.infoCommande.dateFinReservation = lResponse.marche.dateFinReservation.extractDbDate().dateDbToFr();
							that.infoCommande.heureFinReservation = lResponse.marche.dateFinReservation.extractDbHeure();
							that.infoCommande.minuteFinReservation = lResponse.marche.dateFinReservation.extractDbMinute();
							that.infoCommande.dateMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbDate().dateDbToFr();
							that.infoCommande.heureMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbHeure();
							that.infoCommande.minuteMarcheDebut = lResponse.marche.dateMarcheDebut.extractDbMinute();
							that.infoCommande.heureMarcheFin = lResponse.marche.dateMarcheFin.extractDbHeure();
							that.infoCommande.minuteMarcheFin = lResponse.marche.dateMarcheFin.extractDbMinute();
							that.infoCommande.comArchive = lResponse.marche.archive;
							
							that.pdtCommande = lResponse.marche.produits;
													
							that.afficher();
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	}
	
	this.afficher = function() {		
		this.afficherReservation();		
	}
	
	this.afficherDetailCommande = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.detailReservation;
		
		var lData = new Object();
		lData.sigleMonetaire = gSigleMonetaire;
		lData.solde = this.solde.nombreFormate(2,',',' ');
		lData.soldeNv = this.soldeNv.nombreFormate(2,',',' ');
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		//lData.reservation = new Array();
		lData.categories = [];
		
		var lTotal = 0;
		$.each(this.pdtCommande, function() {
			var lIdProduit = this.id;
			if(that.reservation[this.id]) {
				var lPdt = new Object;
				lPdt.proId = lIdProduit;
				lPdt.nproNom = this.nom;
				lPdt.stoQuantite = parseFloat(that.reservation[this.id].stoQuantite);
				lPdt.proUniteMesure = this.unite;
				lPdt.prix = 0;
				var lDcomId = that.reservation[this.id].dcomId;
				$.each(this.lots, function() {
					if(this.id == lDcomId) {
						lPdt.prix = (lPdt.stoQuantite / this.taille) * this.prix;
					}
				});
				lTotal += lPdt.prix;
				
				lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
				lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
				
				//lData.reservation.push(lPdt);

				if(!lData.categories[this.idCategorie]) {
					lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
				}
				lData.categories[this.idCategorie].produits.push(lPdt);
			}			
		});
		lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));
		this.majNouveauSolde();
	}
	
	this.afficherReservation = function() {
		var that = this;
		var lCommandeTemplate = new CommandeTemplate();
		var lTemplate = lCommandeTemplate.reservation;
		var lData = {};
		lData.sigleMonetaire = gSigleMonetaire;
		lData.solde = this.solde.nombreFormate(2,',',' ');
		lData.soldeNv = this.soldeNv.nombreFormate(2,',',' ');
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		
		//lData.produit = new Array();
		lData.categories = [];
				
		var lTotal = 0;		
		$.each(this.pdtCommande, function() {
			// Test si la ligne n'est pas vide
			if(this.id) {
				var lPdt = {};
				lPdt.proId = this.id;
				lPdt.nproNom = this.nom;
				lPdt.proUniteMesure = this.unite;
				
				lPdt.proMaxProduitCommande = parseFloat(this.qteMaxCommande);
				lPdt.stock = parseFloat(this.stockReservation);
				lPdt.lot = new Array();
				
				var lNoStock = false;
				if(parseFloat(this.qteMaxCommande) == -1 && parseFloat(this.stockInitial) == -1) { // Si ni stock ni qmax
					lNoStock = true;
				} else if(parseFloat(this.stockInitial) == -1) { // Si qmax mais pas stock
					lPdt.max = lPdt.proMaxProduitCommande;
				} else if(parseFloat(this.qteMaxCommande) == -1) { // Si stock mais pas qmax
					lPdt.max = lPdt.stock;
				} else { // Si stock et qmax
					if(parseFloat(lPdt.proMaxProduitCommande) < parseFloat(lPdt.stock)) {
						lPdt.max = lPdt.proMaxProduitCommande;
					} else {
						lPdt.max = lPdt.stock;
					}					
				}

				var i = 0;
				var lLotReservation = -1;
				var lLotInit = -1;
				
				$.each(this.lots, function() {
					if(this.id) {
						if(lNoStock || (!lNoStock && parseFloat(this.taille) <= lPdt.max) ) {
							var lLot = {};
							lLot.dcomId = this.id;
							lLot.dcomTaille = parseFloat(this.taille).nombreFormate(2,',',' ');
							lLot.dcomPrix = parseFloat(this.prix).nombreFormate(2,',',' ');
							lLot.prixReservation = parseFloat(this.prix);
							lLot.stoQuantiteReservation = parseFloat(this.taille);
							
							if(that.reservation[lPdt.proId] && (that.reservation[lPdt.proId].dcomId == this.id)) {
									lLot.stoQuantiteReservation = parseFloat(that.reservation[lPdt.proId].stoQuantite);
									lLot.prixReservation = (lLot.stoQuantiteReservation / this.taille) * this.prix;
									lTotal += lLot.prixReservation;
									
									// Permet de cocher le lot correspondant à la résa
									lLotReservation = this.id;
									lLot.checked = 'checked="checked"';
							}
							
							lPdt.prixUnitaire = (lLot.prixReservation / lLot.stoQuantiteReservation).nombreFormate(2,',',' '); 						
							lPdt.stoQuantiteReservation = lLot.stoQuantiteReservation.nombreFormate(2,',',' ');
							lPdt.prixReservation = lLot.prixReservation.nombreFormate(2,',',' ');
							
							lPdt.lot.push(lLot);
						}
					}
				});
				
				lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
				
				// Si il y a une réservation pour ce produit on le coche
				if(lLotReservation != -1) {
					lPdt.checked = 'checked="checked"';
				} else {
					lPdt.checked = '';
				}
				
				if(lPdt.lot.length == 0) {		
					lPdt.checked = 'rel="indisponible"';
				}
				
				if(!lData.categories[this.idCategorie]) {
					lData.categories[this.idCategorie] = {nom:this.cproNom,produits:[]};
				}
				lData.categories[this.idCategorie].produits.push(lPdt);
				//lData.produit.push(lPdt);
			}
		});
		$('#contenu').replaceWith(that.affectModifier($(lTemplate.template(lData))));
		this.majNouveauSolde();
	}
	
	this.affect = function(pData) {
		pData = this.affectModifierReservation(pData);
		pData = this.affectValiderReservation(pData);
		pData = this.affectInfoProduit(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectModifier = function(pData) {
		pData = this.affectBtnQte(pData);
		pData = this.preparerAffichageModifier(pData);
		pData = this.affectChangementLot(pData);
		pData = this.affectChangementProduit(pData);
		pData = this.affectDetailReservation(pData);
		pData = this.supprimerSelect(pData);
		pData = gCommunVue.comHoverBtn(pData);
		pData = this.affectInitLot(pData);
		pData = this.affectInfoProduit(pData);
		pData = this.masquerIndisponible(pData);

		return pData;
	}
	
	this.affectInfoProduit = function(pData) {
		var that = this;
		pData.find('.btn-info-produit')
		.click(function() {		
			var lId = $(this).attr('id-produit');
			var lParam = {id:lId,fonction:"detailProduit"};
			$.post(	"./index.php?m=Commande&v=ReservationCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse) {
							if(lResponse.valid) {
								var lCommandeTemplate = new CommandeTemplate();
								var lTemplate = lCommandeTemplate.dialogInfoProduit;
								
								lResponse.produit.sigleMonetaire = gSigleMonetaire;
								
								var lHtml = $(lTemplate.template(lResponse.produit));
								
								if(lResponse.produit.producteurs.length > 0 && lResponse.produit.producteurs[0].nPrdtIdNomProduit == null) {
									lHtml.find('#pro-prdt').remove();
								}
								if(lResponse.produit.caracteristiques.length > 0 && lResponse.produit.caracteristiques[0].carProIdNomProduit == null) {
									lHtml.find('#pro-car').remove();
								}
								
								$(lHtml).dialog({			
									autoOpen: true,
									modal: true,
									draggable: true,
									resizable: false,
									width:600,
									close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
								});								
							} else {
								Infobulle.generer(lResponse,'');
							}
						}
					},"json"
			);
			
		});
		return pData;
	}
	
	this.affectBtnQte = function(pData) {
		var that = this;
		pData.find('.btn-plus').click(function() {
			var lIdPdt = $(this).parent().parent().find(".pdt-id").text();
			that.nouvelleQuantite(	lIdPdt,
									$(this).parent().parent().find('#lot-' + lIdPdt).val(),
									1);
		});	
		pData.find('.btn-moins').click(function() {
			var lIdPdt = $(this).parent().parent().find(".pdt-id").text();
			that.nouvelleQuantite(lIdPdt,$(this).parent().parent().find('#lot-' + lIdPdt).val(),-1);
		});
		return pData;		
	}
	
	this.masquerIndisponible = function(pData) {
		pData.find("[rel='indisponible']").each(function() {
			var lCommandeTemplate = new CommandeTemplate();
			var lTemplate = lCommandeTemplate.produitIndisponible;
			var lData = {nom:$(this).parents(".pdt").find(".nom-pro").text()};			
			$(this).parents(".pdt").before(lTemplate.template(lData));
			$(this).parents(".pdt").remove();
		});		
		return pData;
	}
	
	this.affectInitLot = function(pData) {
		var that = this;
		pData.find('.pdt select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".pdt-id").text();
			var lIdLot = $(this).val();

			if(that.pdtCommande[lIdPdt].lots[lIdLot]) {
				var lPrix = that.pdtCommande[lIdPdt].lots[lIdLot].prix;
				var lQte = that.pdtCommande[lIdPdt].lots[lIdLot].taille;
				var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
				
				$(pData).find('#prix-unitaire-' + lIdPdt).text(lprixUnitaire);
			}
		});
		return pData;
	}
	
	this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.pdt select').change(function() {
			that.changerLot($(this).parent().parent().find(".pdt-id").text(),$(this).val());
		});
		return pData;
	}
	
	this.affectChangementProduit = function(pData) {
		var that = this;
		pData.find('.pdt :checkbox').click(function() {
			that.changerProduit($(this).parent().parent().find(".pdt-id").text());			
		});
		return pData;
	}
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modifier').click(function() {
			that.afficherReservation();		
		});
		return pData;
	}
	
	this.affectDetailReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.validerReservation();		
		});
		return pData;
	}

	this.affectValiderReservation = function(pData) {
		var that = this;
		pData.find('#btn-valider').click(function() {
			that.enregistrerReservation();				
		});
		return pData;	
	}
		
	this.nouvelleQuantite = function(pIdPdt,pIdLot,pIncrement) {
		// La quantité max soit qte max soit stock
		var lMax = this.pdtCommande[pIdPdt].qteMaxCommande;
		var lStock = this.pdtCommande[pIdPdt].stockReservation;
		//if(parseFloat(lStock) < parseFloat(lMax)) { lMax = lStock; }
		
		var lNoStock = false;
		if(parseFloat(this.pdtCommande[pIdPdt].qteMaxCommande) == -1 && parseFloat(this.pdtCommande[pIdPdt].stockInitial) == -1) { // Si ni stock ni qmax
			lNoStock = true;
		} else if(parseFloat(this.pdtCommande[pIdPdt].stockInitial) == -1) { // Si qmax mais pas stock
			lMax = this.pdtCommande[pIdPdt].qteMaxCommande;
		} else if(parseFloat(this.pdtCommande[pIdPdt].qteMaxCommande) == -1) { // Si stock mais pas qmax
			lMax = lStock;
		} else { // Si stock et qmax
			if(parseFloat(lStock) < parseFloat(lMax)) { lMax = lStock; }				
		}

		var lTaille = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservation[pIdPdt] && (this.reservation[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = this.reservation[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;
		
		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNoStock || (!lNoStock && lNvQteReservation > 0 && lNvQteReservation <= lMax) ) {
			var lNvPrix = 0;
			lNvPrix = (lQteReservation * lPrix).toFixed(2);
			
			// Mise à jour de la quantite reservée
			this.reservation[pIdPdt].stoQuantite = lNvQteReservation;			
			
			$('#qte-pdt-' + pIdPdt).text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt).text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

			this.majTotal();
		} else if(lNvQteReservation > lMax) {
			var lVr = new TemplateVR();
			lVr.valid = false;
			lVr.log.valid = false;
			var erreur = new VRerreur();
			erreur.code = ERR_304_CODE;
			erreur.message = ERR_304_MSG;
			lVr.log.erreurs.push(erreur);							
			
			Infobulle.generer(lVr,'');
		}		
	}	
	
	this.changerLot = function(pIdPdt,pIdLot) {
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;
		var lQte = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-' + pIdPdt).text(lprixUnitaire);
		
		if(this.reservation[pIdPdt]) {
			this.reservation[pIdPdt].dcomId = pIdLot;
			this.reservation[pIdPdt].stoQuantite = lQte;
			$('#qte-pdt-' + pIdPdt).text(lQte.nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt).text(lPrix.nombreFormate(2,',',' '));
		}
		
		this.majTotal();
	}
	
	this.changerProduit = function(pIdPdt) {
		if(this.reservation[pIdPdt] != null) {
			$('.resa-pdt-' + pIdPdt).hide();
			$('#qte-pdt-' + pIdPdt).text('');
			$('#prix-pdt-' + pIdPdt).text('');
			this.reservation[pIdPdt] = null;
		} else {
			var lIdLot = $('#lot-' + pIdPdt).val();
			var lQte = this.pdtCommande[pIdPdt].lots[lIdLot].taille;			
			
			var lResa = {};
			lResa.comId = this.infoCommande.comId;
			lResa.proId = pIdPdt;
			lResa.dcomId = lIdLot;
			lResa.stoQuantite = lQte;						
			this.reservation[pIdPdt] = lResa;
			
			$('#qte-pdt-' + pIdPdt).text(lQte.nombreFormate(2,',',' '));
			var lPrix = this.pdtCommande[pIdPdt].lots[lIdLot].prix.nombreFormate(2,',',' ');
			$('#prix-pdt-' + pIdPdt).text(lPrix);
			
			$('.resa-pdt-' + pIdPdt).show();
		}
		this.majTotal();
	}
	
	this.majTotal = function() {
		var lTotal = this.calculTotal();		
		$('#total').text(lTotal.nombreFormate(2,',',' '));
		
		// Maj du nouveau solde
		this.soldeNv = this.solde - lTotal;
		this.majNouveauSolde();
		$("#nouveau-solde").text(this.soldeNv.nombreFormate(2,',',' '));
	}
	
	this.majNouveauSolde = function() {
		if(this.soldeNv <= 0) {
			$("#nouveau-solde, #nouveau-solde-sigle").addClass("com-nombre-negatif");	
		} else {
			$("#nouveau-solde, #nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
	}
	
	this.calculTotal = function() {
		var that = this;
		var lTotal = 0;
		$(this.reservation).each(function() {
			var lResa = this;
			if(lResa.stoQuantite) {
				if(that.pdtCommande[lResa.proId]) {
					$.each(that.pdtCommande[lResa.proId].lots, function() {
						if(lResa.dcomId == this.id) {
							lTotal += (lResa.stoQuantite / this.taille) * this.prix;
						}
					});					
				}				
			}
		});
		return lTotal;
	}
	
	this.preparerAffichageModifier = function(pData) {
		var that = this;
		$(pData).find('.pdt').each(function() {
			var lIdPdt = $(this).find('.pdt-id').text();
			if(that.reservation[lIdPdt] != null) {
				var lResa = that.reservation[lIdPdt];
				var lIdLot = lResa.dcomId;
				var lQte = lResa.stoQuantite;
				$(pData).find('#qte-pdt-' + lIdPdt).text(lQte.nombreFormate(2,',',' '));
				var lPrix = ((that.pdtCommande[lIdPdt].lots[lIdLot].prix * lResa.stoQuantite)/that.pdtCommande[lIdPdt].lots[lIdLot].taille).nombreFormate(2,',',' ');
				$(pData).find('#prix-pdt-' + lIdPdt).text(lPrix);
				$(pData).find('#lot-' + lIdPdt).selectOptions(lIdLot);				
				//$(pData).find('.resa-pdt-' + lIdPdt).show();
				$(pData).find('.resa-pdt-' + lIdPdt).css("display","table-cell"); //Show ne fonctionne pas sur chrome
			}
		});
		return pData;
	}
	
	this.validerReservation = function() {
		Infobulle.init(); // Supprime les erreurs
		var lVo = this.genererListeReservation();	
		var lVr = this.verifierReservation(lVo);
		if(lVr.valid) {
			this.afficherDetailCommande();
		} else {
			Infobulle.generer(lVr,'');			
		}
	}
	
	this.enregistrerReservation = function() {
		Infobulle.init(); // Supprime les erreurs
		var that = this;
		var lVo = this.genererListeReservation();	
		var lVr = this.verifierReservation(lVo);
		if(lVr.valid) {
			// Réalisation de l'enregistrement
			lVo.fonction = "reservationMarche";
			$.post(	"./index.php?m=Commande&v=ReservationCommande", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {					
							that.afficherRetour();
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');			
		}		
	}	
	
	this.genererListeReservation = function() {
		var lVo = new ListeReservationCommandeVO();
		$(this.reservation).each(function() {
			if(this.stoQuantite) {
				var lVoResa = new ReservationCommandeVO();
				lVoResa.stoQuantite = this.stoQuantite * -1;
				lVoResa.stoIdDetailCommande = this.dcomId;
				lVo.detailReservation.push(lVoResa);
			}
		});	
		return lVo;
	}
		
	this.verifierReservation = function(pVo) {
		if(pVo.detailReservation.length > 0) {
			var lValid = new ListeReservationCommandeValid();
			var lVR = lValid.validAjout(pVo);
		} else {
			var lVR = new TemplateVR();
			lVR.valid = false;lVR.log.valid = false;var erreur = new VRerreur();erreur.code = ERR_207_CODE;erreur.message = ERR_207_MSG;lVR.log.erreurs.push(erreur);
		}
		return lVR;
	}
	
	this.afficherRetour = function() {		
		var lCommandeTemplate = new CommandeTemplate();
		$('#contenu').replaceWith(lCommandeTemplate.reservationOk);	
	}
	
	this.supprimerSelect = function(pData) {
		pData.find('.pdt select').each(function() {
			if($(this).find('option').size() == 1) {				
				var lCommandeTemplate = new CommandeTemplate();
				var lTemplate = lCommandeTemplate.lotUnique;
				var lData = {};
				lData.IdPdt = $(this).parent().parent().find(".pdt-id").text();
				lData.valeur = $(this).val();
				lData.text = $(this).text();
				
				$(this).replaceWith(lTemplate.template(lData));
			}
		});
		
		return pData;
	}
	
	this.construct(pParam);
}