;function GestionCommandeTemplate() {
	/*this.formulaireModifierCommande = 
		'<div id="contenu">' +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-editer-com\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			'<div id="formulaire_ajout_commande_ext">' +			
				'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all">' +
					'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Modifier le Marché n°{comNumero}</div>' +
					'<div class="com-widget-content">' +		
						'<form id="formulaire-information-creation-commande">' +
							'<table class="com-table-form">' +
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Nom du Marché</th>' +
									'<td class="com-table-form-td"><input value=\"{comNom}\" class="com-input-text ui-widget-content ui-corner-all" type="text" name="nom_commande" id="commande-nom" maxlength="100" /></td>' +
								'</tr>' +
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Fin des Réservations *</th>' +
									'<td class="com-table-form-td">' +
										'<input value=\"{dateTimeFinReservation}\" class="com-input-text ui-widget-content ui-corner-all" type="text" name="date_fin_commande" id="commande-dateFinReservation" />' +
									'</td>' +
									'<td class="com-table-form-td">' +
										'&nbsp;&nbsp;à <select name="heure_fin_commande" id="commande-timeFinReservation" >' +
											'<option value="00">00</option>' +
										    '<option value="01">01</option>' +
										    '<option value="02">02</option>' +
										    '<option value="03">03</option>' +
										    '<option value="04">04</option>' +
										    '<option value="05">05</option>' +
										    '<option value="06">06</option>' +
										    '<option value="07">07</option>' +
										    '<option value="08">08</option>' +
										    '<option value="09">09</option>' +
										    '<option value="10">10</option>' +
										    '<option value="11">11</option>' +
										    '<option value="12">12</option>' +
										    '<option value="13">13</option>' +
										    '<option value="14">14</option>' +
										    '<option value="15">15</option>' +
										    '<option value="16">16</option>' +
										    '<option value="17">17</option>' +
										    '<option value="18">18</option>' +
										    '<option value="19">19</option>' +
										    '<option value="20">20</option>' +
										    '<option value="21">21</option>' +
										    '<option value="22">22</option>' +
										    '<option value="23">23</option>' +
										  '</select>' +
					   					'H <select name="minute_fin_commande">' +
											'<option value="00">00</option>' +
										    '<option value="05">05</option>' +
										    '<option value="10">10</option>' +
										    '<option value="15">15</option>' +
										    '<option value="20">20</option>' +
										    '<option value="25">25</option>' +
										    '<option value="30">30</option>' +
										    '<option value="35">35</option>' +
										    '<option value="40">40</option>' +
										    '<option value="45">45</option>' +
										    '<option value="50">50</option>' +
										    '<option value="55">55</option>' +
										  '</select>' +
									'</td>' +
								'</tr>' +
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Jour du marché *</th>' +
									'<td class="com-table-form-td">' +
										'<input value=\"{dateMarcheDebut}\" class="com-input-text ui-widget-content ui-corner-all" type="text" name="date_debut_marche" id="commande-dateMarcheDebut"/>' +
									'</td>' +
									'<td class="com-table-form-td">' +
										'de <select name="heure_debut_marche" id="commande-timeMarcheDebut">' +
											'<option value="00">00</option>' +
										    '<option value="01">01</option>' +
										    '<option value="02">02</option>' +
										    '<option value="03">03</option>' +
										    '<option value="04">04</option>' +
										    '<option value="05">05</option>' +
										    '<option value="06">06</option>' +
										    '<option value="07">07</option>' +
										    '<option value="08">08</option>' +
										    '<option value="09">09</option>' +
										    '<option value="10">10</option>' +
										    '<option value="11">11</option>' +
										    '<option value="12">12</option>' +
										    '<option value="13">13</option>' +
										    '<option value="14">14</option>' +
										    '<option value="15">15</option>' +
										    '<option value="16">16</option>' +
										    '<option value="17">17</option>' +
										    '<option value="18">18</option>' +
										    '<option value="19">19</option>' +
										    '<option value="20">20</option>' +
										    '<option value="21">21</option>' +
										    '<option value="22">22</option>' +
										    '<option value="23">23</option>' +
										  '</select>' +
					   					'H <select name="minute_debut_marche">' +
											'<option value="00">00</option>' +
										    '<option value="05">05</option>' +
										    '<option value="10">10</option>' +
										    '<option value="15">15</option>' +
										    '<option value="20">20</option>' +
										    '<option value="25">25</option>' +
										    '<option value="30">30</option>' +
										    '<option value="35">35</option>' +
										    '<option value="40">40</option>' +
										    '<option value="45">45</option>' +
										    '<option value="50">50</option>' +
										    '<option value="55">55</option>' +
										  '</select>' +
										'</td>' +
										'<td class="com-table-form-td">' +
										'à  <select name="heure_fin_marche" id="commande-timeMarcheFin">' +
											'<option value="00">00</option>' +
										    '<option value="01">01</option>' +
										    '<option value="02">02</option>' +
										    '<option value="03">03</option>' +
										    '<option value="04">04</option>' +
										    '<option value="05">05</option>' +
										    '<option value="06">06</option>' +
										    '<option value="07">07</option>' +
										    '<option value="08">08</option>' +
										    '<option value="09">09</option>' +
										    '<option value="10">10</option>' +
										    '<option value="11">11</option>' +
										    '<option value="12">12</option>' +
										    '<option value="13">13</option>' +
										    '<option value="14">14</option>' +
										    '<option value="15">15</option>' +
										    '<option value="16">16</option>' +
										    '<option value="17">17</option>' +
										    '<option value="18">18</option>' +
										    '<option value="19">19</option>' +
										    '<option value="20">20</option>' +
										    '<option value="21">21</option>' +
										    '<option value="22">22</option>' +
										    '<option value="23">23</option>' +
										  '</select>' +
					   					'H <select name="minute_fin_marche">' +
											'<option value="00">00</option>' +
										    '<option value="05">05</option>' +
										    '<option value="10">10</option>' +
										    '<option value="15">15</option>' +
										    '<option value="20">20</option>' +
										    '<option value="25">25</option>' +
										    '<option value="30">30</option>' +
										    '<option value="35">35</option>' +
										    '<option value="40">40</option>' +
										    '<option value="45">45</option>' +
										    '<option value="50">50</option>' +
										    '<option value="55">55</option>' +
										  '</select>' +
									'</td>' +
								'</tr>' +
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Description :</th>' +
									'<td class="com-table-form-td"><textarea class="com-input-text ui-widget-content ui-corner-all" name="description_commande" id="commande-description" >{comDescription}</textarea></td>' +
								'</tr>' +
							'</table>' +
						'</form>' +
					'</div>' +
				'</div>' +
				/*'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all" id="window-ajout-produit-creation-commande">' +
					'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Ajouter un produit</div>' +
					'<div class="com-widget-content">' +
						'<form id="formulaire-ajout-produit-creation-commande">' +
							'<table class="com-table-form">' +
								'<tr>' +
									/*'<th class="com-table-form-th ui-widget-content ui-corner-all" id="ajout-produit-idNom">Produit</th>' +
									'<td class="com-table-form-td" id="ajout-produit-nom">' +*/
								/*	'<th class="com-table-form-th ui-widget-content ui-corner-all">Produit</th>' +
									'<td class="com-table-form-td" id="ajout-produit-nom">' +
										'<select name="produit" id="ajout-produit-idNom">' +
											'<option value="0" >== Choisir un produit ==</option>' +
											'<!-- BEGIN produits -->' +
											'<option value={produits.id} >{produits.nom}</option>' +
											'<!-- END produits -->' +
										'</select>' +
									'</td>' +
									'<td class="com-center"><button type="button" id="btn-creer-nv-pdt" class="ui-state-default ui-corner-all com-button com-center">Créer un nouveau produit</button></td>' +
								'</tr>' +
								
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Producteur</th>' +
									'<td class="com-table-form-td" colspan="2">' +
										'<select name="producteur" id="ajout-produit-idProducteur">' +
											'<option value="0" >== Choisir un producteur ==</option>' +
											'<!-- BEGIN producteurs -->' +
											'<option value="{producteurs.prdtIdCompte}" >{producteurs.prdtPrenom} {producteurs.prdtNom}</option>' +
											'<!-- END producteurs -->' +
										'</select>' +
									'</td>' +
								'</tr>' +
								
								'<tr>' +
									'<td class="com-table-form-td"><br/></td>' +
								'</tr>' +
								'<tr>' +							
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Stock</th>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Unité</th>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Quantité max par adhérent</th>' +
								'</tr>' +
								'<tr>' +
									'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" type="text" name="stock" maxlength="11" id="ajout-produit-qteRestante"/></td>' +
									'<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" name="unite" type="text" maxlength="20" id="ajout-produit-unite"/></td>' +
									'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="qmax" type="text" maxlength="11" id="ajout-produit-qteMaxCommande" /></td>' +
								'</tr>' +
								'<tr>' +
									'<td class="com-table-form-td"><br/></td>' +					
								'</tr>' +
								'<tr>' +
									'<td></td>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Taille</th>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Prix</th>' +
								'</tr>' +
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Lot</th>' +
									'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="taille" type="text" maxlength="12" id="ajout-produit-lots0taille"/></td>' +						
									'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="prix" type="text" maxlength="12" id="ajout-produit-lots0prix"/> {SIGLE_MONETAIRE}</td>' +
								'</tr>' +
								'<tr>' +
									'<td class="com-table-form-td"><br/></td>' +						
								'</tr>' +
								'<tr>' +
									'<td colspan="3" class="com-center"><input class="ui-state-default ui-corner-all com-button com-center" type="submit" value="Ajouter au Marché"/></td>' +
								'</tr>' +
							'</table>' +
						'</form>' +
					'</div>' +
				'</div>' +*/
				/*"<div id=\"liste_produit\">" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
					"<button type=\"button\" id=\"btn-ajout-produit\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un produit</button>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
					"<button type=\"button\" id=\"btn-modifier-creation-commande\" class=\"com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center\">Modifier</button>" +
					"<button type=\"button\" id=\"btn-creer-commande\" class=\"ui-state-default ui-corner-all com-button com-center\">Valider</button>" +
				"</div>" +
			"</div>" +	
		"</div>";*/
	
	this.dialogAjoutProduitAjoutMarche =
		"<div id=\"dialog-ajout-pro\" title=\"Produit\">" +
			"<div id=\"information-detail-producteur\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Le Produit</div>" +

				"<div id=\"pro-idFerme\" class=\"com-float-left\">" +
					"<select name=\"ferme\">" +
						"<option value=\"0\" >== Choisir une ferme ==</option>" +
						"<!-- BEGIN listeFerme -->" +
						"<option value=\"{listeFerme.ferId}\" >{listeFerme.ferNom}</option>" +
						"<!-- END listeFerme -->" +
					"</select>" +
				"</div>" +
				"<div id=\"pro-idCategorie\" class=\"com-float-left\">" +
					"<select name=\"categorie\" disabled=\"disabled\">" +
						"<option value=\"0\" >== Choisir une catégorie ==</option>" +
					"</select>" +
				"</div>" +
				"<div id=\"pro-idProduit\" class=\"com-float-left\">" +
					"<select name=\"produit\" disabled=\"disabled\">" +
						"<option value=\"0\" >== Choisir un produit ==</option>" +
					"</select>" +
				"</div>" +
			"</div>" +
			"<div id=\"prix-stock-produit\">" +
			"</div>" +
		"</div>";
	
	this.ajoutProduitSelectCategorie =
		"<div id=\"pro-idCategorie\" class=\"com-float-left\">" +
			"<select name=\"categorie\">" +
				"<option value=\"0\" >== Choisir une catégorie ==</option>" +
				"<!-- BEGIN listeCategorie -->" +
				"<option value=\"{listeCategorie.cproId}\" >{listeCategorie.cproNom}</option>" +
				"<!-- END listeCategorie -->" +
			"</select>" +
		"</div>";
	
	this.ajoutProduitSelectProduit =
		"<div id=\"pro-idProduit\" class=\"com-float-left\">" +
			"<select name=\"produit\">" +
				"<option value=\"0\" >== Choisir un produit ==</option>" +
				"<!-- BEGIN listeProduit -->" +
				"<option value=\"{listeProduit.nproId}\" >{listeProduit.nproNom}</option>" +
				"<!-- END listeProduit -->" +
			"</select>" +
		"</div>";
	
	this.prixEtStockAjoutProduit =
		"<div id=\"prix-stock-produit\">" +
			"<div>" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Prix de vente</div>" +
				"<table class=\"com-table-form\" id=\"table-pro-prix\">" +
					"<tr>" +
						"<td class=\"catalogue-entete-lot\">Quantité</td>" +
						"<td class=\"catalogue-entete-lot\">Unité</td>" +
						"<td>Prix</td>" +
						"<td></td>" +
						"<td></td>" +
					"</tr>" +
					"<tr class=\"btn-lot\">" +
						"<td>" +
							"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-quantite\" maxlength=\"13\" id=\"pro-lot-quantite\"/>" +
						"</td>" +
						"<td>" +
							"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"lot-unite\" maxlength=\"20\" id=\"pro-lot-unite\"/>" +
						"</td>" +
						"<td>" +
							"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-prix\" maxlength=\"13\" id=\"pro-lot-prix\"/> {sigleMonetaire}" +
						"</td>" +
						"<td colspan=\"2\">" +
							"<button type=\"button\" id=\"btn-ajout-lot\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter</button>" +
						"</td>" +
					"</tr>" +
				"</table>" +
				"<table class=\"com-table\" id=\"lot-liste\">" +

					"<!-- BEGIN modelesLot -->" +
					"<tr class=\"ligne-lot\" id=\"ligne-lot-{modelesLot.id}\">" +
						"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLot.id}</span></td>" +
						"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
							"<input type=\"checkbox\" value=\"{modelesLot.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLot.id}-id\" class=\"modele-lot\"/>" +
						"</td>" +
						"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
							"<span class=\"champ-lot-{modelesLot.id} lot-quantite\" id=\"lot-{modelesLot.id}-quantite\">{modelesLot.quantite}</span>"+
							"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-quantite\" maxlength=\"13\" id=\"pro-lot-{modelesLot.id}-quantite\"/>" +
						"</td>" +
						"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
							"<span class=\"champ-lot-{modelesLot.id} lot-unite\" id=\"lot-{modelesLot.id}-unite\">{modelesLot.unite}</span>" +
							"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-unite\" maxlength=\"20\" id=\"pro-lot-{modelesLot.id}-unite\"/>" +
						"</td>" +
						"<td class=\"com-table-td-med\">" +
							"à " +
							"<span class=\"champ-lot-{modelesLot.id} lot-prix\" id=\"lot-{modelesLot.id}-prix\">{modelesLot.prix}</span>" +
							"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-prix\" maxlength=\"13\" id=\"pro-lot-{modelesLot.id}-prix\"/>" +
							" {modelesLot.sigleMonetaire}" +
						"</td>" +
						"<td class=\"com-table-td-med td-edt\">" +
							"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot\" title=\"Modifier\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot\" id=\"btn-valider-lot-{modelesLot.id}\" title=\"Valider\">" +
								"<span class=\"ui-icon ui-icon-check\"></span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot\" id=\"btn-annuler-lot-{modelesLot.id}\" title=\"Annuler\">" +
								"<span class=\"ui-icon ui-icon-closethick\"></span>" +
							"</span>" +
							"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot\" title=\"Supprimer\">" +				
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"<!-- END modelesLot -->" +
				
				"</table>" +
			"</div>" +
			
	
			"<div>" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Stock</div>" +
				"<table class=\"com-table-form\">" +
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
							"Limite de stock : " +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-stock-choix\" value=\"0\" checked=\"checked\"/>Pas de limite" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-stock-choix\" value=\"1\"/>" +
							"<input disabled=\"disabled\" class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"pro-stock\" maxlength=\"13\" id=\"pro-qteRestante\"/> <span class=\"unite-stock\">{unite}</span>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
							"Quantité max par adhérent : " +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"0\" checked=\"checked\"/>Pas de limite" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th\">" +
						"</th>" +
						"<td class=\"com-table-form-td\">" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"1\" />" +
							"<input disabled=\"disabled\" class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"pro-qte-max\" maxlength=\"13\" id=\"pro-qteMaxCommande\"/> <span class=\"unite-stock\">{unite}</span>" +
						"</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
		"</div>" ;
	
	this.modeleLot =
		"<tr class=\"ligne-lot\" id=\"ligne-lot-{id}\">" +
			"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{id}</span></td>" +
			"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
				"<input type=\"checkbox\" value=\"{id}\" name=\"pro-lot\" id=\"pro-lot-{id}-id\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
				"<span class=\"champ-lot-{id} lot-quantite\" id=\"lot-{id}-quantite\">{quantite}</span>"+
				"<input class=\"champ-lot-{id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{id}-quantite\" maxlength=\"13\" id=\"pro-lot-{id}-quantite\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
				"<span class=\"champ-lot-{id} lot-unite\" id=\"lot-{id}-unite\">{unite}</span>" +
				"<input class=\"champ-lot-{id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{id}-unite\" maxlength=\"20\" id=\"pro-lot-{id}-unite\"/>" +
			"</td>" +
			"<td class=\"com-table-td-med\">" +
				"à " +
				"<span class=\"champ-lot-{id} lot-prix\" id=\"lot-{id}-prix\">{prix}</span>" +
				"<input class=\"champ-lot-{id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{id}-prix\" maxlength=\"13\" id=\"pro-lot-{id}-prix\"/>" +
				" {sigleMonetaire}" +
			"</td>" +
			"<td class=\"com-table-td-med td-edt\">" +
				"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot\" title=\"Modifier\">" +
					"<span class=\"ui-icon ui-icon-pencil\"></span>" +
				"</span>" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot\" id=\"btn-valider-lot-{id}\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check\"></span>" +
				"</span>" +
			"</td>" +
			"<td class=\"com-table-td-fin td-edt\">" +
				"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot\" id=\"btn-annuler-lot-{id}\" title=\"Annuler\">" +
					"<span class=\"ui-icon ui-icon-closethick\"></span>" +
				"</span>" +
				"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot\" title=\"Supprimer\">" +				
					"<span class=\"ui-icon ui-icon-trash\"></span>" +
				"</span>" +
			"</td>" +
		"</tr>" ;
	
	this.btnValiderAjoutMarche = 
		"<div id=\"btn-gestion-marche\" class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
			"<button type=\"button\" id=\"btn-modifier-creation-commande\" class=\"com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center\">Modifier</button>" +
			"<button type=\"button\" id=\"btn-creer-marche\" class=\"ui-state-default ui-corner-all com-button com-center\">Valider</button>" +
		"</div>";
	
	this.ajoutMarcheListeProduit = 
		"<div id=\"liste-ferme\">" +
			"<!-- BEGIN fermes -->" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ferme-{fermes.ferId}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">{fermes.ferNom}</div>" +
				"<!-- BEGIN fermes.categories -->" +
				"<table class=\"com-table\">" +
					"<tr class=\"ui-widget-header\" >" +
						"<td class=\"com-table-td-debut\">{fermes.categories.cproNom}</td>" +
						"<td class=\"com-table-td-med\"></td>" +
						"<td class=\"com-table-td-fin\"></td>" +
					"</tr>" +
					"<!-- BEGIN fermes.categories.produits -->" +
					"<tr>" +
						"<td class=\"com-table-td-debut\">{fermes.categories.produits.nproNom}</td>" +
						"<td class=\"com-table-td-med td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-produit\" title=\"Modifier\" id-produit=\"{fermes.categories.produits.nproId}\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-produit\" title=\"Supprimer\" id-produit=\"{fermes.categories.produits.nproId}\">" +				
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"<!-- END fermes.categories.produits -->" +
				"</table>" +
				"<!-- END fermes.categories -->" +
			"</div>"+
			"<!-- END fermes -->" +
		"</div>";
	
	this.dialogModifProduitAjoutMarche =
		"<div id=\"dialog-modif-pro\" title=\"Produit\">" +
			"<div id=\"information-detail-producteur\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Le Produit</div>" +

				"<div id=\"pro-idFerme\" class=\"com-float-left\" id-ferme=\"{ferId}\">" +
					"{ferNom}" +
				"</div>" +
				"<div id=\"pro-idCategorie\" class=\"com-float-left\" id-categorie=\"{cproId}\">" +
					"{cproNom}" +
				"</div>" +
				"<div id=\"pro-idProduit\" class=\"com-float-left\" id-produit=\"{nproId}\">" +
					"{nproNom}" +
				"</div>" +
			"</div>" +
			"<div id=\"prix-stock-produit\">" +
				"<div>" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Prix de vente</div>" +
					"<table class=\"com-table-form\" id=\"table-pro-prix\">" +
						"<tr>" +
							"<td class=\"catalogue-entete-lot\">Quantité</td>" +
							"<td class=\"catalogue-entete-lot\">Unité</td>" +
							"<td>Prix</td>" +
							"<td></td>" +
							"<td></td>" +
						"</tr>" +
						"<tr class=\"btn-lot\">" +
							"<td>" +
								"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-quantite\" maxlength=\"13\" id=\"pro-lot-quantite\"/>" +
							"</td>" +
							"<td>" +
								"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"lot-unite\" maxlength=\"20\" id=\"pro-lot-unite\"/>" +
							"</td>" +
							"<td>" +
								"<input class=\"pro-form-input-lot com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" name=\"lot-prix\" maxlength=\"13\" id=\"pro-lot-prix\"/> {sigleMonetaire}" +
							"</td>" +
							"<td colspan=\"2\">" +
								"<button type=\"button\" id=\"btn-ajout-lot\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter</button>" +
							"</td>" +
						"</tr>" +
					"</table>" +
					"<table class=\"com-table\" id=\"lot-liste\">" +
	
						"<!-- BEGIN modelesLot -->" +
						"<tr class=\"ligne-lot\" id=\"ligne-lot-{modelesLot.id}\">" +
							"<td class=\"ui-helper-hidden\"><span class=\"ui-helper-hidden lot-id\" id=\"id-lot\">{modelesLot.id}</span></td>" +
							"<td class=\"com-table-td-debut catalogue-ligne-lot-quantite td-edt\">" +
								"<input type=\"checkbox\" value=\"{modelesLot.id}\" name=\"pro-lot\" id=\"pro-lot-{modelesLot.id}-id\" {modelesLot.checked} class=\"{modelesLot.modele}\"/>" +
							"</td>" +
							"<td class=\"com-table-td-med catalogue-ligne-lot-quantite\">" +
								"<span class=\"champ-lot-{modelesLot.id} lot-quantite\" id=\"lot-{modelesLot.id}-quantite\">{modelesLot.quantite}</span>"+
								"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-quantite\" maxlength=\"13\" id=\"pro-lot-{modelesLot.id}-quantite\"/>" +
							"</td>" +
							"<td class=\"com-table-td-med catalogue-ligne-lot-unite\">" +
								"<span class=\"champ-lot-{modelesLot.id} lot-unite\" id=\"lot-{modelesLot.id}-unite\">{modelesLot.unite}</span>" +
								"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-unite\" maxlength=\"20\" id=\"pro-lot-{modelesLot.id}-unite\"/>" +
							"</td>" +
							"<td class=\"com-table-td-med\">" +
								"à " +
								"<span class=\"champ-lot-{modelesLot.id} lot-prix\" id=\"lot-{modelesLot.id}-prix\">{modelesLot.prix}</span>" +
								"<input class=\"champ-lot-{modelesLot.id} catalogue-input-lot com-input-text ui-widget-content ui-corner-all com-numeric ui-helper-hidden\" type=\"text\" name=\"lot-{modelesLot.id}-prix\" maxlength=\"13\" id=\"pro-lot-{modelesLot.id}-prix\"/>" +
								" {modelesLot.sigleMonetaire}" +
							"</td>" +
							"<td class=\"com-table-td-med td-edt\">" +
								"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-lot\" title=\"Modifier\">" +
									"<span class=\"ui-icon ui-icon-pencil\"></span>" +
								"</span>" +
								"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-valider-lot\" id=\"btn-valider-lot-{modelesLot.id}\" title=\"Valider\">" +
									"<span class=\"ui-icon ui-icon-check\"></span>" +
								"</span>" +
							"</td>" +
							"<td class=\"com-table-td-fin td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all ui-helper-hidden btn-annuler-lot\" id=\"btn-annuler-lot-{modelesLot.id}\" title=\"Annuler\">" +
									"<span class=\"ui-icon ui-icon-closethick\"></span>" +
								"</span>" +
								"<span class=\"btn-lot com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-lot\" title=\"Supprimer\">" +				
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
						"<!-- END modelesLot -->" +
					
					"</table>" +
				"</div>" +
				
		
				"<div>" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Stock</div>" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">" +
								"Limite de stock : " +
							"</th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-stock-choix\" value=\"0\" {nproStockCheckedNoLimit} />Pas de limite" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">" +
							"</th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-stock-choix\" value=\"1\" {nproStockCheckedLimit} />" +
								"<input {nproStockDisabled} class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" value=\"{nproStock}\" name=\"pro-stock\" maxlength=\"13\" id=\"pro-qteRestante\"/> <span class=\"unite-stock\">{unite}</span>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">" +
								"Quantité max par adhérent : " +
							"</th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"0\" {nproQteMaxCheckedNoLimit} />Pas de limite" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">" +
							"</th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"radio\" name=\"pro-qte-max-choix\" value=\"1\" {nproQteMaxCheckedLimit} />" +
								"<input {nproQteMaxDisabled} class=\"com-input-text ui-widget-content ui-corner-all com-numeric\" type=\"text\" value=\"{nproQteMax}\" name=\"pro-qte-max\" maxlength=\"13\" id=\"pro-qteMaxCommande\"/> <span class=\"unite-stock\">{unite}</span>" +
							"</td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	/*this.dialogAjoutProduit =
		"<div id=\"dialog-form-creer-nv-pdt\" title=\"Créer un nouveau produit\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" id=\"nom-pdt-nom\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"nom-pdt-description\"></textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";*/
	
	/*this.ajoutProduitModifierCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom-id ui-helper-hidden\">{idNom}</span><span class=\"produit-nom\">{nom}</span>" +				
				"<span class=\"com-delete com-btn-header ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
					"<span class=\"ui-icon ui-icon-circle-close\">" +
					"</span>" +
				"</span>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +				
				"<span class=\"produit-id ui-helper-hidden\">{id}</span>" +
				
				"Producteur : <span class=\"info-produit\" id=\"nom-producteur\">{nomProducteur}</span>" +
				"<select name=\"producteur\" id=\"commande-produits{idNom}idProducteur\" class=\"info-produit ui-helper-hidden\">" +
					"<option value=\"0\" >== Choisir un producteur ==</option>" +
					"<!-- BEGIN producteurs -->" +
					"<option value=\"{producteurs.prdtIdCompte}\" >{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
					"<!-- END producteurs -->" +
				"</select>" +
				
				"<span class=\"edit-nom-pdt-creation-commande edit-nom-pdt-creation-commande-edit com-btn-header ui-widget-content ui-corner-all\" title=\"Editer\">" +
					"<span class=\"ui-icon ui-icon-pencil\">" +
					"</span>" +
				"</span>" +
				"<span class=\"ui-helper-hidden btn-valider com-btn-header edit-nom-pdt-creation-commande edit-nom-pdt-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check com-float-left\">" +
					"</span>Valider" +
				"</span><br/>" +	
			
				"Quantité en stock : " +
				"<span class=\"info-produit produit-stock\">{stockInitial}</span>" +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"stock\" value=\"{stockInitial}\" id=\"produit-{idNom}-qteRestante\" maxlength=\"11\"/>" +
				" <span class=\"info-produit produit-unite\">{unite}</span>" +	
				" <input class=\"info-produit ui-helper-hidden com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"unite\" value=\"{unite}\" id=\"produit-{idNom}-unite\" maxlength=\"20\"/>" +						
				"<br/>" +
				
				"Quantité max par adhérent : " +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qmax\" value=\"{qteMaxCommande}\" id=\"produit-{idNom}-qteMaxCommande\" maxlength=\"11\"/>" +
				"<span class=\"info-produit produit-qmax\">{qteMaxCommande}</span>" +
				" <span class=\"produit-unite\">{unite}</span>" +
				
				"<div class=\"lots-section\" >" +
					"<div class=\"form-ajout-lot-creation-commande\">" +
						"<form>" +
							"<table>" +
								"<tr>" +
									"<td></td>" +
									"<td>Taille</td>" +
									"<td>Prix</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Nouveau Lot : </td>" +
									"<td><input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{proId}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{proUniteMesure}</span></td>" +
									"<td><input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{proId}-prix\" maxlength=\"12\"/> {sigleMonetaire}</td>" +
									"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande ui-state-default ui-corner-all com-button com-center\">Ajouter</button></td>" +
								"</tr>" +
							"</table>" +
						"</form>" +
					"</div>" +
					"<div class=\"produit-lots\">" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";	*/
	
	/*this.modifCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification de la commande n°{numero}" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Marché n°{numero} modifié avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";*/
	
	this.formulaireAjoutMarche = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_ajout_commande_ext\">" +		
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Nouveau Marché</div>" +
					"<div class=\"com-widget-content\">" +		
						"<form id=\"formulaire-information-creation-commande\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th\">Nom du Marché : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"nom-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"nom\" id=\"marche-nom\" maxlength=\"100\" />" +
									"</td>" +
								"</tr>" +								
								"<tr>" +
									"<th class=\"com-table-form-th\">Début des Réservations * : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"date-debut-reservation-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-debut-reservation\" id=\"marche-dateDebutReservation\" />" +
									"</td>" +
									"<td class=\"com-table-form-td\">" +
										"à " +
										"<span id=\"time-debut-reservation-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<select name=\"heure-debut-reservation\" id=\"marche-timeDebutReservation\" class=\"informations-marche\" >" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"01\">01</option>" +
										    "<option value=\"02\">02</option>" +
										    "<option value=\"03\">03</option>" +
										    "<option value=\"04\">04</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"06\">06</option>" +
										    "<option value=\"07\">07</option>" +
										    "<option value=\"08\">08</option>" +
										    "<option value=\"09\">09</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"11\">11</option>" +
										    "<option value=\"12\">12</option>" +
										    "<option value=\"13\">13</option>" +
										    "<option value=\"14\">14</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"16\">16</option>" +
										    "<option value=\"17\">17</option>" +
										    "<option value=\"18\">18</option>" +
										    "<option value=\"19\">19</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"21\">21</option>" +
										    "<option value=\"22\">22</option>" +
										    "<option value=\"23\">23</option>" +
										  "</select>" +
					   					"<span class=\"informations-marche\">H</span> <select name=\"minute-debut-reservation\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"25\">25</option>" +
										    "<option value=\"30\">30</option>" +
										    "<option value=\"35\">35</option>" +
										    "<option value=\"40\">40</option>" +
										    "<option value=\"45\">45</option>" +
										    "<option value=\"50\">50</option>" +
										    "<option value=\"55\">55</option>" +
										  "</select>" +
									"</td>" +
								"</tr>" +								
								"<tr>" +
									"<th class=\"com-table-form-th\">Fin des Réservations * : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"date-fin-reservation-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-fin-reservation\" id=\"marche-dateFinReservation\" />" +
									"</td>" +
									"<td class=\"com-table-form-td\">" +
										"à " +
										"<span id=\"time-fin-reservation-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<select name=\"heure-fin-reservation\" id=\"marche-timeFinReservation\" class=\"informations-marche\" >" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"01\">01</option>" +
										    "<option value=\"02\">02</option>" +
										    "<option value=\"03\">03</option>" +
										    "<option value=\"04\">04</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"06\">06</option>" +
										    "<option value=\"07\">07</option>" +
										    "<option value=\"08\">08</option>" +
										    "<option value=\"09\">09</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"11\">11</option>" +
										    "<option value=\"12\">12</option>" +
										    "<option value=\"13\">13</option>" +
										    "<option value=\"14\">14</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"16\">16</option>" +
										    "<option value=\"17\">17</option>" +
										    "<option value=\"18\">18</option>" +
										    "<option value=\"19\">19</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"21\">21</option>" +
										    "<option value=\"22\">22</option>" +
										    "<option value=\"23\">23</option>" +
										  "</select>" +
					   					"<span class=\"informations-marche\">H</span> <select name=\"minute-fin-reservation\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"25\">25</option>" +
										    "<option value=\"30\">30</option>" +
										    "<option value=\"35\">35</option>" +
										    "<option value=\"40\">40</option>" +
										    "<option value=\"45\">45</option>" +
										    "<option value=\"50\">50</option>" +
										    "<option value=\"55\">55</option>" +
										  "</select>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th\">Jour du marché * : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"date-debut-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-debut\" id=\"marche-dateMarcheDebut\"/>" +
									"</td>" +
									"<td class=\"com-table-form-td\">" +
										"de " +
										"<span id=\"time-debut-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<select name=\"heure-debut\" id=\"marche-timeMarcheDebut\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"01\">01</option>" +
										    "<option value=\"02\">02</option>" +
										    "<option value=\"03\">03</option>" +
										    "<option value=\"04\">04</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"06\">06</option>" +
										    "<option value=\"07\">07</option>" +
										    "<option value=\"08\">08</option>" +
										    "<option value=\"09\">09</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"11\">11</option>" +
										    "<option value=\"12\">12</option>" +
										    "<option value=\"13\">13</option>" +
										    "<option value=\"14\">14</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"16\">16</option>" +
										    "<option value=\"17\">17</option>" +
										    "<option value=\"18\">18</option>" +
										    "<option value=\"19\">19</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"21\">21</option>" +
										    "<option value=\"22\">22</option>" +
										    "<option value=\"23\">23</option>" +
										  "</select>" +
					   					"<span class=\"informations-marche\">H</span> <select name=\"minute-debut\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"25\">25</option>" +
										    "<option value=\"30\">30</option>" +
										    "<option value=\"35\">35</option>" +
										    "<option value=\"40\">40</option>" +
										    "<option value=\"45\">45</option>" +
										    "<option value=\"50\">50</option>" +
										    "<option value=\"55\">55</option>" +
										  "</select>" +
										"</td>" +
										"<td class=\"com-table-form-td\">" +
											"à " +
											"<span id=\"time-fin-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
											"<select name=\"heure-fin\" id=\"marche-timeMarcheFin\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"01\">01</option>" +
										    "<option value=\"02\">02</option>" +
										    "<option value=\"03\">03</option>" +
										    "<option value=\"04\">04</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"06\">06</option>" +
										    "<option value=\"07\">07</option>" +
										    "<option value=\"08\">08</option>" +
										    "<option value=\"09\">09</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"11\">11</option>" +
										    "<option value=\"12\">12</option>" +
										    "<option value=\"13\">13</option>" +
										    "<option value=\"14\">14</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"16\">16</option>" +
										    "<option value=\"17\">17</option>" +
										    "<option value=\"18\">18</option>" +
										    "<option value=\"19\">19</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"21\">21</option>" +
										    "<option value=\"22\">22</option>" +
										    "<option value=\"23\">23</option>" +
										  "</select>" +
					   					"<span class=\"informations-marche\">H</span> <select name=\"minute-fin\" class=\"informations-marche\">" +
											"<option value=\"00\">00</option>" +
										    "<option value=\"05\">05</option>" +
										    "<option value=\"10\">10</option>" +
										    "<option value=\"15\">15</option>" +
										    "<option value=\"20\">20</option>" +
										    "<option value=\"25\">25</option>" +
										    "<option value=\"30\">30</option>" +
										    "<option value=\"35\">35</option>" +
										    "<option value=\"40\">40</option>" +
										    "<option value=\"45\">45</option>" +
										    "<option value=\"50\">50</option>" +
										    "<option value=\"55\">55</option>" +
										  "</select>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th\">Description : </th>" +
									"<td class=\"com-table-form-td\">" +
										"<span id=\"description-marche-span\" class=\"ui-helper-hidden informations-marche\"></span>" +
										"<textarea class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" name=\"description\" id=\"marche-description\" ></textarea>" +
									"</td>" +
								"</tr>" +
							"</table>" +
						"</form>" +
					"</div>" +
				"</div>" +
				/*'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all" id="window-ajout-produit-creation-commande">' +
					'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Ajouter un produit</div>' +
					'<div class="com-widget-content">' +
						'<form id="formulaire-ajout-produit-creation-commande">' +
							'<table class="com-table-form">' +
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Produit</th>' +
									'<td class="com-table-form-td" id="ajout-produit-nom">' +
										'<select name="produit" id="ajout-produit-idNom">' +
											'<option value="0" >== Choisir un produit ==</option>' +
											'<!-- BEGIN produits -->' +
											'<option value="{produits.id}" >{produits.nom}</option>' +
											'<!-- END produits -->' +
										'</select>' +
									'</td>' +
									'<td class="com-center"><button type="button" id="btn-creer-nv-pdt" class="ui-state-default ui-corner-all com-button com-center">Créer un nouveau produit</button></td>' +
								'</tr>' +	
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Producteur</th>' +
									'<td class="com-table-form-td" colspan="2">' +
										'<select name="producteur" id="ajout-produit-idProducteur">' +
											'<option value="0" >== Choisir un producteur ==</option>' +
											'<!-- BEGIN producteurs -->' +
											'<option value="{producteurs.prdtId}" >{producteurs.prdtPrenom} {producteurs.prdtNom}</option>' +
											'<!-- END producteurs -->' +
										'</select>' +
									'</td>' +
								'</tr>' +
								'<tr>' +
									'<td class="com-table-form-td"><br/></td>' +
								'</tr>' +
								'<tr>' +							
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Stock</th>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Unité</th>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Quantité max par adhérent</th>' +
								'</tr>' +
								'<tr>' +
									'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" type="text" name="stock" maxlength="11" id="ajout-produit-qteRestante"/></td>' +
									'<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" name="unite" type="text" maxlength="20" id="ajout-produit-unite"/></td>' +
									'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="qmax" type="text" maxlength="11" id="ajout-produit-qteMaxCommande" /></td>' +
								'</tr>' +
								'<tr>' +
									'<td class="com-table-form-td"><br/></td>' +					
								'</tr>' +
								'<tr>' +
									'<td></td>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Taille</th>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Prix</th>' +
								'</tr>' +
								'<tr>' +
									'<th class="com-table-form-th ui-widget-content ui-corner-all">Lot</th>' +
									'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="taille" type="text" maxlength="12" id="ajout-produit-lots0taille"/></td>' +						
									'<td class="com-table-form-td"><input class="com-numeric com-input-text ui-widget-content ui-corner-all" name="prix" type="text" maxlength="12" id="ajout-produit-lots0prix"/> {SIGLE_MONETAIRE}</td>' +
								'</tr>' +
								'<tr>' +
									'<td class="com-table-form-td"><br/></td>' +						
								'</tr>' +
								'<tr>' +
									'<td colspan="3" class="com-center"><input type="submit" value="Ajouter au Marché" class="ui-state-default ui-corner-all com-button com-center"/></td>' +
								'</tr>' +
							'</table>' +
						'</form>' +
					'</div>' +
				'</div>' +*/
				"<div id=\"btn-ajout-produit-div\" class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
					"<button type=\"button\" id=\"btn-ajout-produit\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un produit</button>" +
				"</div>" +
				"<div id=\"liste-ferme\">" +
				"</div>" +
				/*"<div class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
					"<button type=\"button\" id=\"btn-modifier-creation-commande\" class=\"com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center\">Modifier</button>" +
					"<button type=\"button\" id=\"btn-creer-commande\" class=\"ui-state-default ui-corner-all com-button com-center\">Valider</button>" +
				"</div>" +*/
				/*
				'<div id="liste_produit"></div>' +
				'<div class="com-widget-window ui-widget ui-widget-header ui-corner-all com-center">' +
					'<button type="button" id="btn-modifier-creation-commande" class="com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center">Modifier le Marché</button>' +
					'<button type="button" id="btn-creer-commande" class="ui-state-default ui-corner-all com-button com-center">Créer le Marché</button>' +
				'</div>' +*/
			"</div>" +	
		"</div>";
	
	/*this.ajoutProduitAjoutCommande = 
		"<div class=\"produit-div com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
				"<span class=\"produit-nom\">{nom}</span>" +
				"<span class=\"com-delete com-btn-header ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
					"<span class=\"ui-icon ui-icon-circle-close\">" +
					"</span>" +
				"</span>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +		
				"<span class=\"produit-id ui-helper-hidden\">{idNom}</span>" +
			
				"Producteur : <span class=\"info-produit\" id=\"nom-producteur\">{nomProducteur}</span>" +
				"<select name=\"producteur\" id=\"commande-produits{idNom}idProducteur\" class=\"info-produit ui-helper-hidden\">" +
					"<option value=\"0\" >== Choisir un producteur ==</option>" +
					"<!-- BEGIN producteurs -->" +
					"<option value=\"{producteurs.prdtId}\" >{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
					"<!-- END producteurs -->" +
				"</select>" +
				
				"<span class=\"edit-nom-pdt-creation-commande edit-nom-pdt-creation-commande-edit com-btn-header ui-widget-content ui-corner-all\" title=\"Editer\">" +
					"<span class=\"ui-icon ui-icon-pencil\">" +
					"</span>" +
				"</span>" +
				"<span class=\"ui-helper-hidden btn-valider com-btn-header edit-nom-pdt-creation-commande edit-nom-pdt-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check com-float-left\">" +
					"</span>Valider" +
				"</span>" +								
				"<br/>" +				
				
				"Quantité en stock : " +
				"<span class=\"produit-stock info-produit\">{qteRestante}</span>" +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"stock\" value=\"{qteRestante}\" id=\"produit-{idNom}-qteRestante\" maxlength=\"11\"/>" +
				" <span class=\"info-produit produit-unite\">{unite}</span>" +
				" <input class=\"info-produit ui-helper-hidden com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"unite\" value=\"{unite}\" id=\"produit-{idNom}-unite\" maxlength=\"20\"/>" +
							
				"<br/>" +				
				"Quantité max par adhérent : " +
				"<span class=\"info-produit produit-qmax\">{qteMaxCommande}</span>" +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qmax\" value=\"{qteMaxCommande}\" id=\"produit-{idNom}-qteMaxCommande\" maxlength=\"11\"/>" +
				" <span class=\"produit-unite\">{unite}</span>" +
				
				"<div class=\"lots-section\" >" +
					"<div class=\"form-ajout-lot-creation-commande\">" +
						"<form>" +
							"<table>" +
								"<tr>" +
									"<td></td>" +
									"<td>Taille</td>" +
									"<td>Prix</td>" +
								"</tr>" +
								"<tr>" +
									"<td>Nouveau Lot : </td>" +
									"<td><input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" id=\"ajout-lot-produit-{idNom}-taille\" maxlength=\"12\"/> <span class=\"produit-unite\">{unite}</span></td>" +
									"<td><input class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" id=\"ajout-lot-produit-{idNom}-prix\" maxlength=\"12\"/> {siglemonetaire}</td>" +
									"<td><button type=\"button\" class=\"btn-ajout-lot-creation-commande ui-state-default ui-corner-all com-button com-center\">Ajouter</button></td>" +
								"</tr>" +
							"</table>" +
						"</form>" +
					"</div>" +
					"<div class=\"produit-lots\">" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";*/
	
	/*this.ajoutLotModifPdt = 
		"<!-- BEGIN lots -->" +
		"<div class=\"produit-lot\">" +
				"<span class=\"lot-id ui-helper-hidden\">{lots.id}</span>" +
				"Taille : " +
				"<input class=\"pdt-{lots.idPdt}-lot-{lots.id} ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{lots.idPdt}-lot-{lots.id}-taille\" maxlength=\"12\"/>" +
				"<span class=\"pdt-{lots.idPdt}-lot-{lots.id} produit-taille\">{lots.taille}</span>" +
				" <span class=\"produit-unite\">{lots.unite}</span>" +
				"   Prix : " +
				"<input class=\"pdt-{lots.idPdt}-lot-{lots.id} ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{lots.idPdt}-lot-{lots.id}-prix\" maxlength=\"12\" />" +
				"<span class=\"pdt-{lots.idPdt}-lot-{lots.id} produit-prix\">{lots.prix}</span>" +
				" {siglemonetaire}" +
				
				"<span class=\"conteneur-btn-edt-lot\">" +
					"<span class=\"ui-helper-hidden delete-lot com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-closethick\">" +
						"</span>" +
					"</span>" +
					"<span class=\"edit-lot-creation-commande edit-lot-creation-commande-edit com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Editer\">" +
						"<span class=\"ui-icon ui-icon-pencil\">" +
						"</span>" +
					"</span>" +
					"<span class=\"ui-helper-hidden btn-valider com-btn-header-multiples edit-lot-creation-commande edit-lot-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check com-float-left\">" +
						"</span>Valider" +
					"</span>" +
				"</span>" +
		"</div>" +
		"<!-- END lots -->";*/
	
	/*this.ajoutLotAjoutPdt = 
		"<!-- BEGIN lots -->" +
		"<div class=\"produit-lot\">" +
				"<span class=\"lot-id ui-helper-hidden\">0</span>" +
				"Taille : " +
				"<span class=\"pdt-{idNom}-lot-0 produit-taille\">{lots.taille}</span>" +
				"<input class=\"pdt-{idNom}-lot-0 ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" value=\"{lots.taille}\" id=\"produit-{idNom}-lot-0-taille\" maxlength=\"12\"/>" +
				" <span class=\"produit-unite\">{unite}</span>" +
				
				"   Prix : " +
				"<span class=\"pdt-{idNom}-lot-0 produit-prix\">{lots.prix}</span>" +
				"<input class=\"pdt-{idNom}-lot-0 ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" value=\"{lots.prix}\" id=\"produit-{idNom}-lot-0-prix\" maxlength=\"12\" />" +
				" {siglemonetaire}" +
				
				"<span class=\"conteneur-btn-edt-lot\">" +
					"<span class=\"ui-helper-hidden delete-lot com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-closethick\">" +
						"</span>" +
					"</span>" +
					"<span class=\"edit-lot-creation-commande edit-lot-creation-commande-edit com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Editer\">" +
						"<span class=\"ui-icon ui-icon-pencil\">" +
						"</span>" +
					"</span>" +
					"<span class=\"ui-helper-hidden btn-valider com-btn-header-multiples edit-lot-creation-commande edit-lot-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check com-float-left\">" +
						"</span>Valider" +
					"</span>" +
				"</span>" +
		"</div>" +
		"<!-- END lots -->";*/
	
	/*this.ajoutLot = 
		"<div class=\"produit-lot\">" +
			"<span class=\"lot-id ui-helper-hidden\">{id}</span>" +
			"Taille : " +
			"<span class=\"pdt-{idNom}-lot-{id} produit-taille\">{taille}</span>" +
			"<input class=\"pdt-{idNom}-lot-{id} ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"taille\" value=\"{taille}\" id=\"produit-{idNom}-lot-{id}-taille\" maxlength=\"12\">" +
			" <span class=\"produit-unite\">{unite}</span>" +
			"   Prix : " +
			"<span class=\"pdt-{idNom}-lot-{id} produit-prix\">{prix}</span>" +
			"<input class=\"pdt-{idNom}-lot-{id} ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix\" value=\"{prix}\" id=\"produit-{idNom}-lot-{id}-prix\" maxlength=\"12\">" +
			" {siglemonetaire}" +
			
			"<span class=\"conteneur-btn-edt-lot\">" +
				"<span class=\"ui-helper-hidden delete-lot com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
					"<span class=\"ui-icon ui-icon-closethick\">" +
					"</span>" +
				"</span>" +				
				"<span class=\"edit-lot-creation-commande edit-lot-creation-commande-edit com-btn-header-multiples ui-widget-content ui-corner-all\" title=\"Editer\">" +
					"<span class=\"ui-icon ui-icon-pencil\">" +
					"</span>" +
				"</span>" +
				"<span class=\"ui-helper-hidden btn-valider com-btn-header-multiples edit-lot-creation-commande edit-lot-creation-commande-valid ui-widget-content ui-corner-all\" title=\"Valider\">" +
					"<span class=\"ui-icon ui-icon-check com-float-left\">" +
					"</span>Valider" +
				"</span>" +
			"</span>" +
		"</div>";*/

	/*this.ajoutCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Création du Marché" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le marché n°{numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";		*/
	
	this.listeCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-barre-menu-2\">" +
					"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-archive\">" +
						"<span class=\"com-float-left\">Les Marchés cloturés</span>" +
						"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-e\"></span>" +
					"</button>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Les Marchés en cours" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-nv-marche\" title=\"Ajouter un marché\">" +
							"<span class=\"ui-icon ui-icon-plusthick\">" +
							"</span>" +
						"</span>" +
					"</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th\"></th>" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr>" +
								"<td class=\"com-table-td com-text-align-right\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td lst-resa-btn-commander\">" +
									"<button class=\"btn-editer ui-state-default ui-corner-all com-button com-center\" id=\"{commande.id}\" >Editer</button>" +
								"</td>" +
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
	
	this.listeCommandeArchivePage = 
		"<div id=\"contenu\">" +
			"<div id=\"liste_commande_int\">" +
				"<div class=\"com-barre-menu-2\">" +
					"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-encours\">" +
						"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Les Marchés en cours" +
					"</button>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés cloturés</div>" +
					
						"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
							"<form>" +	
							"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
							"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
							"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
							"	<input type=\"hidden\" class=\"pagesize\" value=\"30\">" +
							"</form>" +	
						"</div>" +
						
						"<table class=\"com-table\" id=\"table-marche-archive\">" +
							"<thead>" +
								"<tr class=\"ui-widget ui-widget-header\">" +
									"<th class=\"com-table-th lst-resa-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
									"<th class=\"com-table-th com-cursor-pointer\" ><span class=\"ui-icon span-icon\"></span>Date de cloture des Réservations</th>" +
									"<th class=\"com-table-th com-cursor-pointer\" ><span class=\"ui-icon span-icon\"></span>Marché</th>	" +
								"</tr>" +
							"</thead>" +
							"<tbody>" +
								"<!-- BEGIN commande -->" +
								"<tr class=\"com-cursor-pointer detail-commande-ligne\" >" +
									"<td class=\"com-table-td com-underline-hover com-text-align-right\"><span class=\"ui-helper-hidden id-commande\">{commande.id}</span>{commande.numero}</td>" +
									"<td class=\"com-table-td com-underline-hover\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
									"<td class=\"com-table-td com-underline-hover\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
								"</tr>" +
								"<!-- END commande -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +			
				"</div>" +
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
			/*"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente du Marché n°{comNumero}</div>" +
				"<div class=\"com-widget-content\">" +
					"<div id=\"achat-info-marche\">" +
						"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
						"N° de Compte : {adhCompte}" +
					"</div>" +
					"<div>" +
						"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span><br/>" +
						"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
					"</div>" +
				"</div>" +
			"</div>" +*/
			
			"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<span>Total Marché : <span id=\"total-global\">0,00</span> {sigleMonetaire}</span>" +
			"</div>" +
			
		//	"<div class=\"com-float-left\">" +
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
								"<select id=\"lot-{categories.produits.proId}\" class=\"lot-vente-produit lot-vente-produit-select\">" +
									"<!-- BEGIN categories.produits.lot -->" +
									"<option value=\"{categories.produits.lot.dcomId}\">par {categories.produits.lot.dcomTaille} {categories.produits.proUniteMesure}</option>" +
									"<!-- END categories.produits.lot -->" +
								"</select>" +
								"<span class=\"lot-vente-produit ui-helper-hidden\"></span>" +
							"</td>" +
							"<td class=\"table-vente-prix-unitaire\" >à <span id=\"prix-unitaire-{categories.produits.proId}\">{categories.produits.prixUnitaire}</span> {sigleMonetaire}/{categories.produits.proUniteMesure}</td>" +
							
							
							"<td class=\"com-text-align-right\"><input type=\"text\" value=\"{categories.produits.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"produits{categories.produits.proId}quantite\" maxlength=\"12\" size=\"3\"/> </td>" +
							"<td class=\"\">{categories.produits.proUniteMesure}</td>" + //td-unite
							"<td class=\"com-text-align-right \" ><input type=\"text\" value=\"{categories.produits.proPrix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"produits{categories.produits.proId}prix\" maxlength=\"12\" size=\"3\"/></td>" +
							//td-qte
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
			
			
			//"</div>" +
			/*"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all com-float-left\" id=\"achat-rechgt-widget\">" +
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
			"</div>" +*/
			"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<button type=\"button\" id=\"btn-annuler\" class=\"com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\">Annuler</button>" +
				"<button type=\"button\" class=\"ui-helper-hidden com-btn-edt-multiples ui-state-default ui-corner-all com-button com-center\" id=\"btn-modifier\">Modifier</button>" +
				"<button type=\"button\" id=\"btn-valider\" class=\"ui-state-default ui-corner-all com-button com-center\">Valider</button>" +
			"</div>" +
		"</div>";
	
	this.lotUnique = 
		"<input type=\"hidden\" id=\"lot-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.lotUniqueSolidaire = 
		"<input type=\"hidden\" id=\"lot-solidaire-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
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
	
	/*this.cloturerCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Cloture du Marché n°{numero}" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Cloture du Marché n°{numero} effectuée avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	*/
	this.dialogClotureCommande = 				
			"<div id=\"dialog-cloturer-com\" title=\"Cloture du Marché n°{comNumero}\">" +
				"<p>Vous allez cloturer le Marché n°{comNumero}</p>" +
			"</div>";
	
	this.dialogExportListeAchatEtReservation =
		"<div id=\"dialog-cloturer-com\" title=\"Export des Achats et Réservations du marché n°{comNumero}\">" +
			"<p>Vous allez exporter les Achats et Réservations du Marché n°{comNumero}.<br/>" +
			"Cette action peut être longue.</p>" +
		"</div>";
	
	this.dialogExportListeReservation = 
			"<div id=\"dialog-export-liste-reservation\" title=\"Export des réservations en cours.\">" +
				"<form>" +
					"<table>" +
						"<tr>" +
							"<td>Format de sortie : </td>" +
							"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
							"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
						"</tr>" +
					"</table>" +
					"<div>Sélectionner les produits : </div>" +
					"<table class=\"com-table-100\">" +
						"<!-- BEGIN fermes -->" +
						"<tr class=\"ui-widget-header\" >" +
							"<td colspan=\"2\" class=\"com-table-td\">{fermes.ferNom}</td>" +
						"</tr>" +
						"<!-- BEGIN fermes.categories -->" +
						"<tr>" +
							"<td colspan=\"2\" class=\"com-table-td\">{fermes.categories.cproNom}</td>" +
						"</tr>" +
						"<!-- BEGIN fermes.categories.produits -->" +
						"<tr>" +
							"<td class=\"com-table-td-debut td-edt\"><input type=\"checkbox\" value=\"{fermes.categories.produits.id}\" name=\"id_produits\"/></td>" +
							"<td class=\"com-table-td-fin\">{fermes.categories.produits.nproNom}</td>" +		
						"</tr>" +
						"<!-- END fermes.categories.produits -->" +
						"<!-- END fermes.categories -->" +
						"<!-- END fermes -->" +
					"</table>" +
				"</form>" +
			"</div>";
	
	this.editerCommandePage = 
		"<div id=\"contenu\">" +
			"<div id=\"edt-com-nav-resa-achat\">" +
				"<span class=\"com-cursor-pointer ui-widget-header ui-corner-tl com-btn-hover ui-state-active\" id=\"btn-information-marche\">Information</span>" +
				"<span class=\"com-cursor-pointer ui-widget-header com-btn-hover\" id=\"btn-liste-resa\">Reservation</span>" +
				"<span class=\"com-cursor-pointer ui-widget-header ui-corner-tr com-btn-hover\" id=\"btn-liste-achat-resa\">Achat</span>" +
			"</div>" +
			"<div id=\"edt-com-liste\">" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Marché n°{comNumero}" +
						"<span class=\"ui-helper-hidden marche-archive-1 com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-cloture-com\" title=\"Cloturer\">" +
							"<span class=\"ui-icon ui-icon-locked\">" +
							"</span>" +
						"</span>" +
						"<span class=\"ui-helper-hidden marche-archive-1 com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-play-com\" title=\"Ouvrir les ventes et réservations\">" +
							"<span class=\"ui-icon ui-icon-play\">" +
							"</span>" +
						"</span>" +
						"<span class=\"ui-helper-hidden marche-archive-0  com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-pause-com\" title=\"Arrêter les ventes et réservations\">" +
							"<span class=\"ui-icon ui-icon-pause\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-modif-com\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-dupliquer-com\" title=\"Dupliquer le marché\">" +
							"<span class=\"ui-icon ui-icon-copy\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-livraison-com\" title=\"Bon de livraison\">" +
							"<span class=\"ui-icon ui-icon-cart\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-bon-com\" title=\"Bon de commande\">" +
							"<span class=\"ui-icon ui-icon-document\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div>" +
						"Réservations : Du <span id=\"edt-marche-dateDebutReservation\">{dateDebutReservation}</span> à <span id=\"edt-marche-heureDebutReservation\">{heureDebutReservation}</span>H<span id=\"edt-marche-minuteDebutReservation\">{minuteDebutReservation}</span> au <span id=\"edt-marche-dateFinReservation\">{dateFinReservation}</span> à <span id=\"edt-marche-heureFinReservation\">{heureFinReservation}</span>H<span id=\"edt-marche-minuteFinReservation\">{minuteFinReservation}</span> <br/>" +
						"Marché : Le <span id=\"edt-marche-dateMarcheDebut\">{dateMarcheDebut}</span> de <span id=\"edt-marche-heureMarcheDebut\">{heureMarcheDebut}</span>H<span id=\"edt-marche-minuteMarcheDebut\">{minuteMarcheDebut}</span> à <span id=\"edt-marche-heureMarcheFin\">{heureMarcheFin}</span>H<span id=\"edt-marche-minuteMarcheFin\">{minuteMarcheFin}</span>" +
					"</div>" +
				"</div>" +
				"<div id=\"btn-ajout-produit-div\" class=\"com-widget-window ui-widget ui-widget-header ui-corner-all com-center\">" +
					"<button type=\"button\" id=\"btn-ajout-produit\" class=\"ui-state-default ui-corner-all com-button com-center\">Ajouter un produit</button>" +
				"</div>" +
				"<div id=\"liste-ferme\">" +
				"</div>" +
			"</div>" +
		"</div>";
	

	/*	"<!-- BEGIN pdtCommande -->" +
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +					
				"{pdtCommande.nproNom}" +
			"</div>" +
			"<div>" +
				"<div class=\"edt-com-progressbar-pdt\" id=\"pdt-{pdtCommande.proId}\">" +
					"<div class=\"edt-com-info-progressbar-pdt\">{pdtCommande.quantiteCommande} {pdtCommande.unite} / {pdtCommande.quantiteInit} {pdtCommande.unite}</div>" +
				"</div>" +
			"</div>" +
		"</div>" +
		"<!-- END pdtCommande -->" +*/
			/*"<div>" +
				
				"<div class=\"com-float-left\" id=\"edt-com-liste\" >" +
					/*"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
							"Liste des Réservations en cours" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-resa\" title=\"Exporter les réservations\">" +
								"<span class=\"ui-icon ui-icon-print\">" +
								"</span>" +
							"</span>" +
						"</div>" +
							"<div id=\"edt-com-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
								"<form id=\"filter-form\">" +
	
									"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
											"<span class=\"ui-icon ui-icon-search\">" +
										"</span>" +
									"</span>" +
									"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
									
								"</form>" +
							"</div>" +
							"<table class=\"com-table\" id=\"edt-com-liste-resa\">" +
								"<thead>" +
								"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
									"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
									"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
									"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
									"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
								"</tr>" +
								"</thead>" +
								"<tbody>" +
								"<!-- BEGIN listeAdherentCommande -->" +
								"<tr class=\"com-cursor-pointer edt-com-reservation-ligne\" >" +							
									"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherentCommande.adhId}</span>{listeAdherentCommande.adhNumero}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhLabelCompte}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhNom}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhPrenom}</td>" +
								"</tr>" +
								"<!-- END listeAdherentCommande -->" +
								"</tbody>" +
							"</table>" +
						"</div>" +
					"</div>" +*/
			//	"</div>" +
	
	this.listeReservation = 
		"<div id=\"edt-com-liste\" >" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Liste des Réservations en cours" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-resa\" title=\"Exporter les réservations\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
						"</span>" +
					"</span>" +
				"</div>" +
				"<div id=\"edt-com-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"<form id=\"filter-form\">" +
	
						"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
								"<span class=\"ui-icon ui-icon-search\">" +
							"</span>" +
						"</span>" +
						"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
						
					"</form>" +
				"</div>" +
				"<table class=\"com-table\" id=\"edt-com-liste-resa\">" +
					"<thead>" +
					"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
					"</tr>" +
					"</thead>" +
					"<tbody>" +
					"<!-- BEGIN listeAdherentCommande -->" +
					"<tr class=\"com-cursor-pointer edt-com-reservation-ligne\" >" +							
						"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAdherentCommande.adhId}</span>{listeAdherentCommande.adhNumero}</td>" +
						"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhLabelCompte}</td>" +
						"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhNom}</td>" +
						"<td class=\"com-table-td com-underline-hover\">{listeAdherentCommande.adhPrenom}</td>" +
					"</tr>" +
					"<!-- END listeAdherentCommande -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeAchatEtReservation = 
		"<div id=\"edt-com-liste\" >" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Liste des Achats et Réservations" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-achat\" title=\"Exporter les Achats et les réservations\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
						"</span>" +
					"</span>" +
				"</div>" +
				"<div id=\"edt-com-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"<form id=\"filter-form\">" +
	
						"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
								"<span class=\"ui-icon ui-icon-search\">" +
							"</span>" +
						"</span>" +
						"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
						
					"</form>" +
				"</div>" +
				"<table class=\"com-table\" id=\"edt-com-liste-resa\">" +
					"<thead>" +
					"<tr class=\"ui-widget ui-widget-header com-cursor-pointer\">" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Compte</th>" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Nom</th>	" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Réservation</th>" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Achat</th>" +
					"</tr>" +
					"</thead>" +
					"<tbody>" +
					"<!-- BEGIN listeAchatEtReservation -->" +
					"<tr class=\"com-cursor-pointer edt-com-achat-ligne\" >" +							
						"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-adherent\">{listeAchatEtReservation.adhId}</span>{listeAchatEtReservation.adhNumero}</td>" +
						"<td class=\"com-table-td com-underline-hover\">{listeAchatEtReservation.cptLabel}</td>" +
						"<td class=\"com-table-td com-underline-hover\">{listeAchatEtReservation.adhNom}</td>" +
						"<td class=\"com-table-td com-underline-hover\">{listeAchatEtReservation.adhPrenom}</td>" +
						"<td class=\"com-table-td com-underline-hover\">{listeAchatEtReservation.reservation}</td>" +
						"<td class=\"com-table-td com-underline-hover\">{listeAchatEtReservation.achat}</td>" +
					"</tr>" +
					"<!-- END listeAchatEtReservation -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeAchatEtReservationVide = 
		"<div class=\"com-float-left\" id=\"edt-com-liste\" >" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Liste des Achats et Réservations" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucun adhérent sur ce marché.</p>" +
			"</div>" +
		"</div>";
	
	this.detailAchatEtReservation = 
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-annuler\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
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
					"Adhérent" +
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<div id=\"resa-info-commande\">" +
						"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
						"N° de Compte : {adhCompte}" +
					"</div>" +
					"<div>" +
						"<span>Solde : </span><span>{adhSolde} {sigleMonetaire}</span>" +
					"</div>" +
					"<div class=\"com-clear-float-left\"></div>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"La réservation : " +
					
					"<span class=\"resa-etat\" id=\"reservation-etat-label\">{etatReservation}</span>" +
					"<span class=\"resa-etat ui-helper-hidden\">" +
						"<select id=\"reservation-etat\">" +
							"<!-- BEGIN typeEtatReservation -->" +
							"<option value=\"{typeEtatReservation.value}\" {typeEtatReservation.selected}>{typeEtatReservation.label}</option>" +
							"<!-- END typeEtatReservation -->" +
						"</select>" +							
					"</span>" +
					
					
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all modif-resa ui-helper-hidden\" id=\"btn-modif-resa\" title=\"Modifier\">" +
						"<span class=\"ui-icon ui-icon-pencil\"></span>" +
					"</span>" +	
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden modif-resa\" id=\"btn-check-resa\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check\"></span>" +
					"</span>" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN reservation -->" +
					"<tr class=\"ligne-produit-reservation\">" +
						"<td class=\"detail-resa-npro\"><span class=\"ui-helper-hidden produit-id\">{reservation.id}</span>{reservation.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\" id=\"reservation-{reservation.id}-quantite\">{reservation.stoQuantite}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte ui-helper-hidden\"><input type=\"text\" value=\"{reservation.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"reservation-produits{reservation.id}quantite\" maxlength=\"12\" size=\"3\"/></td>" +
						"<td class=\"detail-resa-unite\">{reservation.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\" id=\"reservation-{reservation.id}-prix\">{reservation.prix}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix ui-helper-hidden\"><input type=\"text\" value=\"{reservation.prix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"reservation-produits{reservation.id}prix\" maxlength=\"12\" size=\"3\"/></td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END reservation -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
						"<td class=\"com-text-align-right resa-total\" id=\"reservation-total-label\">{totalReservation}</td>" +
						"<td class=\"com-text-align-right resa-total ui-helper-hidden\"><input type=\"text\" value=\"{totalReservation}\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"reservation-total\" maxlength=\"12\" size=\"3\"/></td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +


			"<!-- BEGIN achats -->" +
			"<div class=\"achat com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-{achats.idAchat}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat <span class=\"achat-id ui-helper-hidden\">{achats.idAchat}</span>" +
					
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all modif-achat-{achats.idAchat}\" id=\"btn-supp-achat-{achats.idAchat}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-trash\"></span>" +
					"</span>" +	
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all modif-achat-{achats.idAchat}\" id=\"btn-modif-achat-{achats.idAchat}\" title=\"Modifier\">" +
						"<span class=\"ui-icon ui-icon-pencil\"></span>" +
					"</span>" +	
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden modif-achat-{achats.idAchat}\" id=\"btn-annuler-achat-{achats.idAchat}\" title=\"Annuler\">" +
						"<span class=\"ui-icon ui-icon-closethick\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden modif-achat-{achats.idAchat}\" id=\"btn-check-achat-{achats.idAchat}\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check\"></span>" +
					"</span>" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN achats.achat -->" +
					"<tr class=\"ligne-produit-achat-{achats.idAchat}\">" +
						"<td class=\"detail-resa-npro\"><span class=\"ui-helper-hidden produit-id\">{achats.achat.id}</span>{achats.achat.nproNom}</td>" +
						//"<td class=\"com-text-align-right detail-resa-qte\">{achats.achat.stoQuantite}</td>" +
						"<td class=\"com-text-align-right detail-achat-{achats.idAchat}-qte\" id=\"achat-{achats.idAchat}-{achats.achat.id}-quantite\">{achats.achat.stoQuantite}</td>" +
						"<td class=\"com-text-align-right detail-achat-{achats.idAchat}-qte ui-helper-hidden\"><input type=\"text\" value=\"{achats.achat.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"achat-{achats.idAchat}-produits{achats.achat.id}quantite\" maxlength=\"12\" size=\"3\"/></td>" +
						
						"<td class=\"detail-resa-unite\">{achats.achat.proUniteMesure}</td>" +
						//"<td class=\"com-text-align-right detail-resa-prix\">{achats.achat.prix}</td>" +
						"<td class=\"com-text-align-right detail-achat-{achats.idAchat}-prix\" id=\"achat-{achats.idAchat}-{achats.achat.id}-prix\">{achats.achat.prix}</td>" +
						"<td class=\"com-text-align-right detail-achat-{achats.idAchat}-prix ui-helper-hidden\"><input type=\"text\" value=\"{achats.achat.prix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"achat-{achats.idAchat}-produits{achats.achat.id}prix\" maxlength=\"12\" size=\"3\"/></td>" +
						
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END achats.achat -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
						//"<td class=\"com-text-align-right\">{total}</td>" +
						"<td class=\"com-text-align-right achat-{achats.idAchat}-total\" id=\"achat-{achats.idAchat}-total-label\">{achats.total}</td>" +
						"<td class=\"com-text-align-right achat-{achats.idAchat}-total ui-helper-hidden\"><input type=\"text\" value=\"{achats.total}\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"achat-{achats.idAchat}-total\" maxlength=\"12\" size=\"3\"/></td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<!-- END achats -->" +
			
			"<!-- BEGIN achatsSolidaire -->" +
			"<div class=\"achatSolidaire com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"achat-{achatsSolidaire.idAchat}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Achat Solidaire <span class=\"achat-id ui-helper-hidden\">{achatsSolidaire.idAchat}</span>" +
					
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all modif-achat-{achatsSolidaire.idAchat}\" id=\"btn-supp-achat-{achatsSolidaire.idAchat}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-trash\"></span>" +
					"</span>" +	
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all modif-achat-{achatsSolidaire.idAchat}\" id=\"btn-modif-achat-{achatsSolidaire.idAchat}\" title=\"Modifier\">" +
						"<span class=\"ui-icon ui-icon-pencil\"></span>" +
					"</span>" +	
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden modif-achat-{achatsSolidaire.idAchat}\" id=\"btn-annuler-achat-{achatsSolidaire.idAchat}\" title=\"Annuler\">" +
						"<span class=\"ui-icon ui-icon-closethick\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden modif-achat-{achatsSolidaire.idAchat}\" id=\"btn-check-achat-{achatsSolidaire.idAchat}\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check\"></span>" +
					"</span>" +
				"</div>" +
				"<table>" +
					"<!-- BEGIN achatsSolidaire.achat -->" +
					"<tr class=\"ligne-produit-achat-{achatsSolidaire.idAchat}\">" +
						"<td class=\"detail-resa-npro\"><span class=\"ui-helper-hidden produit-id\">{achatsSolidaire.achat.id}</span>{achatsSolidaire.achat.nproNom}</td>" +
						//"<td class=\"com-text-align-right detail-resa-qte\">{achatsSolidaire.achat.stoQuantite}</td>" +
						"<td class=\"com-text-align-right detail-achat-{achatsSolidaire.idAchat}-qte\" id=\"achat-{achatsSolidaire.idAchat}-{achatsSolidaire.achat.id}-quantite\">{achatsSolidaire.achat.stoQuantite}</td>" +
						"<td class=\"com-text-align-right detail-achat-{achatsSolidaire.idAchat}-qte ui-helper-hidden\"><input type=\"text\" value=\"{achatsSolidaire.achat.stoQuantite}\" class=\"com-numeric produit-quantite com-input-text ui-widget-content ui-corner-all\" id=\"achat-{achatsSolidaire.idAchat}-produits{achatsSolidaire.achat.id}quantite\" maxlength=\"12\" size=\"3\"/></td>" +
						
						"<td class=\"detail-resa-unite\">{achatsSolidaire.achat.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-achat-{achatsSolidaire.idAchat}-prix\" id=\"achat-{achatsSolidaire.idAchat}-{achatsSolidaire.achat.id}-prix\">{achatsSolidaire.achat.prix}</td>" +
						"<td class=\"com-text-align-right detail-achat-{achatsSolidaire.idAchat}-prix ui-helper-hidden\"><input type=\"text\" value=\"{achatsSolidaire.achat.prix}\" class=\"com-numeric produit-prix com-input-text ui-widget-content ui-corner-all\" id=\"achat-{achatsSolidaire.idAchat}-produits{achatsSolidaire.achat.id}prix\" maxlength=\"12\" size=\"3\"/></td>" +
						
						//"<td class=\"com-text-align-right detail-resa-prix\">{achatsSolidaire.achat.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END achatsSolidaire.achat -->" +
					"<tr>" +
						"<td class=\"com-text-align-right\" colspan=\"3\">Total : </td>" +
						//"<td class=\"com-text-align-right\">{total}</td>" +
						"<td class=\"com-text-align-right achat-{achatsSolidaire.idAchat}-total\" id=\"achat-{achatsSolidaire.idAchat}-total-label\">{achatsSolidaire.totalSolidaire}</td>" +
						"<td class=\"com-text-align-right achat-{achatsSolidaire.idAchat}-total ui-helper-hidden\"><input type=\"text\" value=\"{achatsSolidaire.totalSolidaire}\" class=\"com-numeric com-input-text ui-widget-content ui-corner-all\" id=\"achat-{achatsSolidaire.idAchat}-total\" maxlength=\"12\" size=\"3\"/></td>" +
						
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
				"</table>" +
			"</div>" +
			"<!-- END achatsSolidaire -->" +
		"</div>";
	
	this.supprimerReservationDialog =
		"<div id=\"dialog-supprimer-reservation\" title=\"Supprimer la réservation\">" +
			"<p>Voulez-vous supprimer la réservation ?</p>" +
		"</div>";	
	
	this.dialogSupprimerAchat =
		"<div title=\"Supprimer la réservation\">" +
			"<p>Voulez-vous supprimer cet achat ?</p>" +
		"</div>";
	
	this.detailReservation = 
		"<div id=\"contenu\">" +		
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-annuler\">" +
				"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
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
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Adhérent</div>" +
				"<div class=\"com-widget-content\">" +
					"<div id=\"resa-info-commande\">" +
						"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
						"N° de Compte : {adhCompte}" +
					"</div>" +
					"<div>" +
						"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span>" +
					"</div>" +
					"<div class=\"com-clear-float-left\"></div>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"La réservation" +
				"</div>" +
				"<table>" +
				
					"<!-- BEGIN categories -->" +
					"<td class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
					"<td colspan=\"4\"></td>" +
					
					"<!-- BEGIN categories.produits -->" +
					"<tr >" +
						"<td class=\"detail-resa-npro\">{categories.produits.nproNom}</td>" +
						"<td class=\"com-text-align-right detail-resa-qte\">{categories.produits.stoQuantite}</td>" +
						"<td class=\"detail-resa-unite\">{categories.produits.proUniteMesure}</td>" +
						"<td class=\"com-text-align-right detail-resa-prix\">{categories.produits.prix}</td>" +
						"<td>{sigleMonetaire}</td>" +
					"</tr>" +
					"<!-- END categories.produits -->" +
					"<!-- END categories -->" +
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
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Adhérent</div>" +
				"<div class=\"com-widget-content\">" +
					"<div id=\"resa-info-commande\">" +
						"{adhNumero} :  {adhPrenom} {adhNom}<br/>" +
						"N° de Compte : {adhCompte}" +
					"</div>" +
					"<div>" +
						"<span>Solde Actuel : </span><span>{adhSolde} {sigleMonetaire}</span><br/>" +
						"<span>Nouveau Solde : </span><span id=\"nouveau-solde\">{adhNouveauSolde}</span> <span id=\"nouveau-solde-sigle\">{sigleMonetaire}</span>" +
					"</div>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"La réservation" +
				"</div>" +
				"<div>" +
					"<table>" +
						"<!-- BEGIN categories -->" +
						"<tr>" +
							"<td colspan=\"3\" class=\"ui-widget-header ui-corner-all com-center\">{categories.nom}</td>" +
							"<td colspan=\"6\"></td>" +
						"</tr>" +						
						"<!-- BEGIN categories.produits -->" +
						"<tr class=\"pdt\">" +
							"<td><input type=\"checkbox\" {categories.produits.checked}/></td>" +
							"<td><span class=\"ui-helper-hidden\"><span class=\"pdt-id\">{categories.produits.proId}</span></span></td>" +
							"<td>{categories.produits.nproNom}</td>" +
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
	
	this.listeCommandeVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-archive\">" +
					"<span class=\"com-float-left\">Les Marchés cloturés</span>" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-e\"></span>" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours" +
				"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-nv-marche\" title=\"Ajouter un marché\">" +
					"<span class=\"ui-icon ui-icon-plusthick\">" +
					"</span>" +
				"</span>" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché en cours.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeCommandeArchiveVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"lien-marche-encours\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Les Marchés en cours" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cloturés</div>" +
				"<p id=\"texte-liste-vide\">Aucun Marché cloturé.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeMarcheVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Vente</div>" +
				"<p id=\"texte-liste-vide\">Aucune adhérent.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeReservationVide =
		"<p id=\"texte-liste-vide\">Aucune réservation.</p>";
	
	this.dialogEnregistrement =
		"<div title=\"Enregistrer les modifications\">" +
			"<p>Vous n'avez pas enregistré vos modifications.</p>" +
		"</div>";
	
	this.dialogExportBonDeCommande = 
		"<div id=\"dialog-export-bon-commande\" title=\"Export du Bon de Commande du Marché n°{comNumero}\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Format de sortie : </td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.bonDeCommande =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-editer-com\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Bon de commande du Marché n°{comNumero}" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-bcom\" title=\"Exporter le bon de commande\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
					"</span>" +
				"</span>" +
				"</div>" +
				"<div>" +
					"<form>" +
						"<span>Producteur : " +
							"<select id=\"select-prdt\">" +
								"<option value=\"0\" >== Choisir un producteur ==</option>" +
								"<!-- BEGIN producteurs -->" +
								"<option value=\"{producteurs.proIdCompteFerme}\">{producteurs.ferNom}</option>" +
								"<!-- END producteurs -->" +
							"</select>" +
						"</span>" +
					"</form>" +
				"</div>" +
				"<div id=\"liste-pdt\"></div>" +	
			"</div>" +
		"</div>";
	
	this.listeProduitVide =
		"<div id=\"liste-pdt\"></div>";
	
	this.listeProduitBonDeCommande = 
		"<div id=\"liste-pdt\">" +
			"<table class=\"com-table\">" +
				"<thead>" +
					"<tr>" +
						"<th>Ref</th>" +
						"<th>Produit</th>" +
						"<th>Réservation</th>" +
						"<th>Commande</th>" +
						"<th>Prix</th>" +
						"<th>État</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
					"<!-- BEGIN produits -->" +
					"<tr>" +
						"<td>{produits.nproNumero}</td>" +
						"<td>{produits.nproNom}</td>" +
						"<td>{produits.stoQuantite} {produits.proUniteMesure}</td>" +
						"<td><span class=\"pro-id ui-helper-hidden\">{produits.proId}</span><input class=\"qte-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qte-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.stoQuantiteCommande}\" id=\"produits{produits.proId}quantite\"/> {produits.proUniteMesure}</td>" +
						"<td><input class=\"prix-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.dopeMontant}\" id=\"produits{produits.proId}prix\" /> {sigleMonetaire}</td>" +
						"<td><div id=\"etat-commande-{produits.proId}\" class=\"{produits.classEtat} ui-corner-all\"></div></td>" +
					"</tr>" +
					"<!-- END produits -->" +
				"</tbody>" +
			"</table>" +
			"<div class=\"com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button\" id=\"btn-enregistrer\">Enregistrer</button>" +
			"</div>" +
		"</div>";
	
	this.dialogExportBonDeLivraison =
		"<div id=\"dialog-export-livraison\" title=\"Export du bon de livraison du Marché n°{comNumero}\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Format de sortie : </td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
						"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	
	this.bonDeLivraison =
		"<div id=\"contenu\">" +
			"<div class=\"com-barre-menu-2\">" +
				"<button class=\"ui-state-default ui-corner-top com-button\" id=\"btn-editer-com\">" +
					"<span class=\"com-float-left ui-icon ui-icon-arrowthick-1-w\"></span>Retour au Marché" +
				"</button>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Bon de Livraison du Marché n°{comNumero}" +
					"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all\" id=\"btn-export-bcom\" title=\"Exporter le bon de livraison\">" +
						"<span class=\"ui-icon ui-icon-print\">" +
					"</span>" +
				"</span>" +
				"</div>" +
				"<div>" +
					"<form>" +
						"<span>Producteur : " +
							"<select id=\"select-prdt\">" +
								"<option value=\"0\" >== Choisir un producteur ==</option>" +
								"<!-- BEGIN producteurs -->" +
								"<option value=\"{producteurs.proIdCompteFerme}\">{producteurs.ferNom}</option>" +
								"<!-- END producteurs -->" +
							"</select>" +
						"</span>" +
					"</form>" +
				"</div>" +
				"<div id=\"liste-pdt\"></div>" +	
			"</div>" +
		"</div>";
	
	this.listeProduitLivraison = 
		"<div id=\"liste-pdt\">" +
			"<table class=\"com-table\">" +
				"<thead>" +
					"<tr>" +
						"<th>Ref</th>" +
						"<th>Produit</th>" +
						"<th>Réservation</th>" +
						"<th>Commande</th>" +
						"<th>Prix</th>" +
						"<th>Livraison</th>" +
						"<th>Prix</th>" +
						"<th>Solidaire</th>" +
						"<th>État</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>" +
					"<!-- BEGIN produits -->" +
					"<tr>" +
						"<td>{produits.nproNumero}</td>" +
						"<td>{produits.nproNom}</td>" +
						"<td>{produits.stoQuantite} {produits.proUniteMesure}</td>" +
						"<td>{produits.stoQuantiteCommande} {produits.proUniteMesure}</td>" +
						"<td>{produits.opeMontantCommande} {sigleMonetaire}</td>" +
						"<td><span class=\"pro-id pro-id-etat ui-helper-hidden\">{produits.proId}</span><input class=\"input-bon-livraison qte-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qte-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.stoQuantiteLivraison}\" id=\"produits{produits.proId}quantite\"/> {produits.proUniteMesure}</td>" +
						"<td><input class=\"input-bon-livraison prix-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.opeMontantLivraison}\" id=\"produits{produits.proId}prix\" /> {sigleMonetaire}</td>" +
						"<td><span class=\"pro-id-etat ui-helper-hidden\">{produits.proId}</span><input " +
							"class=\"qte-solidaire-commande input-bon-livraison com-numeric com-input-text ui-widget-content ui-corner-all\" " +
							"type=\"text\" " +
							"name=\"qte-solidaire-commande-{produits.proId}\" " +
							"maxlength=\"11\" " +
							"value=\"{produits.stoQuantiteSolidaire}\" " +
							"id=\"produits{produits.proId}quantiteSolidaire\" /> {produits.proUniteMesure}" +
						"</td>" +
						"<td><div id=\"etat-commande-{produits.proId}\" class=\"{produits.classEtat} ui-corner-all\"></div></td>" +
					"</tr>" +
					"<!-- END produits -->" +
				"</tbody>" +
				"<tfoot>" +
					"<tr>" +
						"<td colspan=\"3\"></td>" +
						"<td>Total :</td>" +
						"<td>{totalCommande} {sigleMonetaire}</td>" +
						"<td></td>" +
						"<td><input class=\"input-bon-livraison com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"total\" maxlength=\"11\" value=\"{total}\" id=\"total\" /> {sigleMonetaire}</td>" +
						"<td>" +
							"<select name=\"typepaiement\" id=\"typePaiement\">" +
								"<option value=\"0\">== Choisir le paiement ==</option>" +
								"<!-- BEGIN typePaiement -->" +
								"<option value=\"{typePaiement.tppId}\">{typePaiement.tppType}</option>" +
								"<!-- END typePaiement -->" +
							"</select>" +
						"</td>" +
						"<td></td>" +
					"</tr>" +
					"<tr id=\"tr-champ-complementaire\">" +
						"<td colspan=\"6\"></td>" +
						"<td><span id=\"label-champ-complementaire\" ></span></td>" +
						"<td><input type=\"text\" name=\"champ-complementaire\" value=\"{champComplementaire}\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"typePaiementChampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
						"<td></td>" +
					"</tr>" +
				"</tfoot>" +
			"</table>" +
			"<div class=\"com-center\">" +
				"<button class=\"ui-state-default ui-corner-all com-button\" id=\"btn-enregistrer\">Enregistrer</button>" +
			"</div>" +
		"</div>";
	
	this.infoCommandeArchive =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Détail du Marché n°{numero}" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-dupliquer-com\" title=\"Dupliquer le marché\">" +
						"<span class=\"ui-icon ui-icon-copy\">" +
						"</span>" +
					"</span>" +
				"</div>" +
				"<div>" +
					"<div class=\"com-center\" id=\"resultat-marche-archive\">" +
						"<span class=\"ui-widget ui-widget-header com-table-th\">Résultat Zeybu Marché : {total} {sigleMonetaire}</span>    " +
						"<span class=\"ui-widget ui-widget-header com-table-th\">Résultat Zeybu Solidaire : {totalSolidaire} {sigleMonetaire}</span>" +
					"</div>" +
					"<table class=\"com-table\" id=\"info-marche-archive\">" +
						"<thead>" +
							"<tr>" +
								"<th></th>" +
								"<th class=\"com-table-th ui-widget ui-widget-header\" colspan=\"5\">Achat</th>" +
								"<th class=\"com-table-th ui-widget ui-widget-header\" colspan=\"4\">Vente</th>" +
							"</tr>" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th\">Produit</th>" +
								"<th class=\"com-table-th\">Qté Commande</th>" +
								"<th class=\"com-table-th\">Prix Commande</th>" +
								"<th class=\"com-table-th\">Qté Livraison</th>" +
								"<th class=\"com-table-th\">Prix Livraison</th>" +
								"<th class=\"com-table-th\">Qté Solidaire</th>" +
								"<th class=\"com-table-th\">Qté Vente</th>" +
								"<th class=\"com-table-th\">Prix Vente</th>" +
								"<th class=\"com-table-th\">Qté Solidaire</th>" +
								"<th class=\"com-table-th\">Prix Solidaire</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>" +
							"<!-- BEGIN infoCommande -->" +
							"<tr>" +
								"<td class=\"com-table-td\">{infoCommande.nproNom}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantite} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontant} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteLivraison} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantLivraison} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteSolidaire} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteVente} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantVente} {sigleMonetaire}</td>" +
								"<td class=\"com-table-td\">{infoCommande.stoQuantiteVenteSolidaire} {infoCommande.proUniteMesure}</td>" +
								"<td class=\"com-table-td\">{infoCommande.opeMontantVenteSolidaire} {sigleMonetaire}</td>" +
							"</tr>" +
							"<!-- END infoCommande -->" +
						"</tbody>" +
					"</table>" +
				"</div>" +
			"</div>" +
		"</div>";
	this.produitIndisponible = 
		"<tr>Le produit {nom} n'est plus disponible.</tr>";

	this.lotUnique = 
		"<input type=\"hidden\" id=\"lot-{IdPdt}\" value=\"{valeur}\" /><span>{text}</span>";
	
	this.editerMarcheListeProduit = 
		"<div id=\"liste-ferme\">" +
			"<!-- BEGIN fermes -->" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ferme-{fermes.ferId}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">{fermes.ferNom}</div>" +
				"<!-- BEGIN fermes.categories -->" +
				"<table class=\"com-table\">" +
					"<tr class=\"ui-widget-header\" >" +
						"<td class=\"com-table-td-debut\">{fermes.categories.cproNom}</td>" +
						"<td class=\"com-table-td-med\"></td>" +
						"<td class=\"com-table-td-med\"></td>" +
						"<td class=\"com-table-td-fin\"></td>" +
					"</tr>" +
					"<!-- BEGIN fermes.categories.produits -->" +
					"<tr>" +
						"<td class=\"com-table-td-debut\">{fermes.categories.produits.nproNom}</td>" +
						"<td class=\"com-table-td-med edt-marche-pro-unite\">{fermes.categories.produits.qteReservation} {fermes.categories.produits.nproUnite}</td>" +
						"<td class=\"com-table-td-med td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-modifier-produit\" title=\"Modifier\" id-produit=\"{fermes.categories.produits.id}\">" +
								"<span class=\"ui-icon ui-icon-pencil\"></span>" +
							"</span>" +
						"</td>" +
						"<td class=\"com-table-td-fin td-edt\">" +
							"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-supprimer-produit\" title=\"Supprimer\" id-produit=\"{fermes.categories.produits.id}\" qte-reservation=\"{fermes.categories.produits.qteReservation}\">" +				
								"<span class=\"ui-icon ui-icon-trash\"></span>" +
							"</span>" +
						"</td>" +
					"</tr>" +
					"<!-- END fermes.categories.produits -->" +
				"</table>" +
				"<!-- END fermes.categories -->" +
			"</div>"+
			"<!-- END fermes -->" +
		"</div>";
	
	this.dialogModifierInfoMarche = 
		"<div id=\"dialog-modif-pro\" title=\"Produit\">" +
			"<div class=\"com-widget-content\">" +		
				"<form id=\"formulaire-information-creation-commande\">" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Nom du Marché : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"nom\" id=\"marche-nom\" maxlength=\"100\" value=\"{nom}\"/>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Début des Réservations * : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-debut-reservation\" id=\"marche-dateDebutReservation\" value=\"{dateDebutReservation}\"/>" +
							"</td>" +
							"<td class=\"com-table-form-td\">" +
								"à " +
								"<select name=\"heure-debut-reservation\" id=\"marche-timeDebutReservation\" class=\"informations-marche\" >" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"01\">01</option>" +
								    "<option value=\"02\">02</option>" +
								    "<option value=\"03\">03</option>" +
								    "<option value=\"04\">04</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"06\">06</option>" +
								    "<option value=\"07\">07</option>" +
								    "<option value=\"08\">08</option>" +
								    "<option value=\"09\">09</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"11\">11</option>" +
								    "<option value=\"12\">12</option>" +
								    "<option value=\"13\">13</option>" +
								    "<option value=\"14\">14</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"16\">16</option>" +
								    "<option value=\"17\">17</option>" +
								    "<option value=\"18\">18</option>" +
								    "<option value=\"19\">19</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"21\">21</option>" +
								    "<option value=\"22\">22</option>" +
								    "<option value=\"23\">23</option>" +
								"</select>" +
			   					"<select name=\"minute-debut-reservation\" class=\"informations-marche\">" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"25\">25</option>" +
								    "<option value=\"30\">30</option>" +
								    "<option value=\"35\">35</option>" +
								    "<option value=\"40\">40</option>" +
								    "<option value=\"45\">45</option>" +
								    "<option value=\"50\">50</option>" +
								    "<option value=\"55\">55</option>" +
								"</select>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Fin des Réservations * : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-fin-reservation\" id=\"marche-dateFinReservation\" value=\"{dateFinReservation}\"/>" +
							"</td>" +
							"<td class=\"com-table-form-td\">" +
								"à " +
								"<select name=\"heure-fin-reservation\" id=\"marche-timeFinReservation\" class=\"informations-marche\" >" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"01\">01</option>" +
								    "<option value=\"02\">02</option>" +
								    "<option value=\"03\">03</option>" +
								    "<option value=\"04\">04</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"06\">06</option>" +
								    "<option value=\"07\">07</option>" +
								    "<option value=\"08\">08</option>" +
								    "<option value=\"09\">09</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"11\">11</option>" +
								    "<option value=\"12\">12</option>" +
								    "<option value=\"13\">13</option>" +
								    "<option value=\"14\">14</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"16\">16</option>" +
								    "<option value=\"17\">17</option>" +
								    "<option value=\"18\">18</option>" +
								    "<option value=\"19\">19</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"21\">21</option>" +
								    "<option value=\"22\">22</option>" +
								    "<option value=\"23\">23</option>" +
								"</select>" +
			   					"<select name=\"minute-fin-reservation\" class=\"informations-marche\">" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"25\">25</option>" +
								    "<option value=\"30\">30</option>" +
								    "<option value=\"35\">35</option>" +
								    "<option value=\"40\">40</option>" +
								    "<option value=\"45\">45</option>" +
								    "<option value=\"50\">50</option>" +
								    "<option value=\"55\">55</option>" +
								"</select>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Jour du marché * : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" type=\"text\" name=\"date-debut\" id=\"marche-dateMarcheDebut\" value=\"{dateMarcheDebut}\"/>" +
							"</td>" +
							"<td class=\"com-table-form-td\">" +
								"de " +
								"<select name=\"heure-debut\" id=\"marche-timeMarcheDebut\" class=\"informations-marche\">" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"01\">01</option>" +
								    "<option value=\"02\">02</option>" +
								    "<option value=\"03\">03</option>" +
								    "<option value=\"04\">04</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"06\">06</option>" +
								    "<option value=\"07\">07</option>" +
								    "<option value=\"08\">08</option>" +
								    "<option value=\"09\">09</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"11\">11</option>" +
								    "<option value=\"12\">12</option>" +
								    "<option value=\"13\">13</option>" +
								    "<option value=\"14\">14</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"16\">16</option>" +
								    "<option value=\"17\">17</option>" +
								    "<option value=\"18\">18</option>" +
								    "<option value=\"19\">19</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"21\">21</option>" +
								    "<option value=\"22\">22</option>" +
								    "<option value=\"23\">23</option>" +
								"</select>" +
			   					"<select name=\"minute-debut\" class=\"informations-marche\">" +
									"<option value=\"00\">00</option>" +
								    "<option value=\"05\">05</option>" +
								    "<option value=\"10\">10</option>" +
								    "<option value=\"15\">15</option>" +
								    "<option value=\"20\">20</option>" +
								    "<option value=\"25\">25</option>" +
								    "<option value=\"30\">30</option>" +
								    "<option value=\"35\">35</option>" +
								    "<option value=\"40\">40</option>" +
								    "<option value=\"45\">45</option>" +
								    "<option value=\"50\">50</option>" +
								    "<option value=\"55\">55</option>" +
								  "</select>" +
								"</td>" +
								"<td class=\"com-table-form-td\">" +
									"à " +
									"<select name=\"heure-fin\" id=\"marche-timeMarcheFin\" class=\"informations-marche\">" +
										"<option value=\"00\">00</option>" +
									    "<option value=\"01\">01</option>" +
									    "<option value=\"02\">02</option>" +
									    "<option value=\"03\">03</option>" +
									    "<option value=\"04\">04</option>" +
									    "<option value=\"05\">05</option>" +
									    "<option value=\"06\">06</option>" +
									    "<option value=\"07\">07</option>" +
									    "<option value=\"08\">08</option>" +
									    "<option value=\"09\">09</option>" +
									    "<option value=\"10\">10</option>" +
									    "<option value=\"11\">11</option>" +
									    "<option value=\"12\">12</option>" +
									    "<option value=\"13\">13</option>" +
									    "<option value=\"14\">14</option>" +
									    "<option value=\"15\">15</option>" +
									    "<option value=\"16\">16</option>" +
									    "<option value=\"17\">17</option>" +
									    "<option value=\"18\">18</option>" +
									    "<option value=\"19\">19</option>" +
									    "<option value=\"20\">20</option>" +
									    "<option value=\"21\">21</option>" +
									    "<option value=\"22\">22</option>" +
									    "<option value=\"23\">23</option>" +
								    "</select>" +
			   						"<select name=\"minute-fin\" class=\"informations-marche\">" +
										"<option value=\"00\">00</option>" +
									    "<option value=\"05\">05</option>" +
									    "<option value=\"10\">10</option>" +
									    "<option value=\"15\">15</option>" +
									    "<option value=\"20\">20</option>" +
									    "<option value=\"25\">25</option>" +
									    "<option value=\"30\">30</option>" +
									    "<option value=\"35\">35</option>" +
									    "<option value=\"40\">40</option>" +
									    "<option value=\"45\">45</option>" +
									    "<option value=\"50\">50</option>" +
									    "<option value=\"55\">55</option>" +
								  "</select>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Description : </th>" +
							"<td class=\"com-table-form-td\">" +
								"<textarea class=\"com-input-text ui-widget-content ui-corner-all informations-marche\" name=\"description\" id=\"marche-description\" >{comDescription}</textarea>" +
							"</td>" +
						"</tr>" +
					"</table>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.dialogSupprimerProduit =
		"<div id=\"dialog-supprimer-produit\" title=\"Supprimer le produit du marché\">" +
			"<p>Des réservations sont présentes sur ce produit.<br/>Voulez-vous toujours le supprimer ?</p>" +
		"</div>";	
}
