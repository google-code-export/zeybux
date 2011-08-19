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
					"<!-- BEGIN reservation -->" +
					"<tr >" +
						"<td class=\"detail-resa-npro\">{reservation.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{reservation.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{reservation.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{reservation.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END reservation -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
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
				"<div>" +
				"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
				"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma réservation" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN reservation -->" +
					"<tr >" +
						"<td class=\"detail-resa-npro\">{reservation.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{reservation.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{reservation.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{reservation.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END reservation -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
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
						"<!-- BEGIN produit -->" +
						"<tr class=\"pdt\">" +
							"<td><input type=\"checkbox\" {produit.checked}/></td>" +
							"<td><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span></span></td>" +
							"<td><span class=\"nom-pro\">{produit.nproNom}<span></td>" +
							"<td>" +
								"<select id=\"lot-{produit.proId}\">" +
									"<!-- BEGIN produit.lot -->" +
									"<option value=\"{produit.lot.dcomId}\">par {produit.lot.dcomTaille} {produit.proUniteMesure}</option>" +
									"<!-- END produit.lot -->" +
								"</select>" +
							"</td>" +
							"<td>à <span id=\"prix-unitaire-{produit.proId}\">{produit.prixUnitaire}</span> {sigleMonetaire}/{produit.proUniteMesure}</td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{produit.proId}\"><button class=\"btn-moins\">-</button></td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{produit.proId}\"><span id=\"qte-pdt-{produit.proId}\"></span> {produit.proUniteMesure}</td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{produit.proId}\"><button class=\"btn-plus\">+</button></td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{produit.proId} com-text-align-right\"><span id=\"prix-pdt-{produit.proId}\"></span> {sigleMonetaire}</td>" +
						"</tr>" +
						"<!-- END produit -->" +
						"<tr>" +
							"<td colspan=\"8\" class=\"com-text-align-right\">Total : </td>" +
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
		"<tr>Le produit {nom} n'est plus disponible.</tr>";
	
	
	this.lotUnique = 
		"<input type=\"hidden\" id=\"lot-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.modifierReservation =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Marché n°{comNumero}" +
				"</div>" +
				"<div>" +
					"Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Ma réservation" +
				"</div>" +
				"<div>" +
					"<table>" +
						"<!-- BEGIN produit -->" +
						"<tr class=\"pdt\">" +
							"<td><input type=\"checkbox\" {produit.checked}/></td>" +
							"<td><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{produit.proId}</span></span></td>" +
							"<td>{produit.nproNom}</td>" +
							"<td>" +
								"<select id=\"lot-{produit.proId}\">" +
									"<!-- BEGIN produit.lot -->" +
									"<option value=\"{produit.lot.dcomId}\">par {produit.lot.dcomTaille} {produit.proUniteMesure}</option>" +
									"<!-- END produit.lot -->" +
								"</select>" +
							"</td>" +
							"<td>à <span id=\"prix-unitaire-{produit.proId}\">{produit.prixUnitaire}</span> {sigleMonetaire}/{produit.proUniteMesure}</td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{produit.proId}\"><button class=\"btn-moins\">-</button></td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{produit.proId}\"><span id=\"qte-pdt-{produit.proId}\"></span> {produit.proUniteMesure}</td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{produit.proId}\"><button class=\"btn-plus\">+</button></td>" +
							"<td class=\"ui-helper-hidden resa-pdt-{produit.proId} com-text-align-right\"><span id=\"prix-pdt-{produit.proId}\"></span> {sigleMonetaire}</td>" +
						"</tr>" +
						"<!-- END produit -->" +
						"<tr>" +
							"<td colspan=\"8\" class=\"com-text-align-right\">Total : </td>" +
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
		"</div>";
	
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
	
	this.listeCommandeVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
			"</div>" +
		"</div>";

	this.listeReservation =
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
	
	this.listeReservationVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Mes Réservations</div>" +
				"<p id=\"texte-liste-vide\">Aucune réservation en cours.</p>" +	
			"</div>" +
			"<div class=\"ui-helper-hidden com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button com-center\">Anciennes commandes</button>" +		
			"</div>" +
		"</div>";
}