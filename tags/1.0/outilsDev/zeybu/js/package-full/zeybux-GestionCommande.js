;function GestionCommandeTemplate() {
	this.formulaireModifierCommande = 
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
			'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all" id="window-ajout-produit-creation-commande">' +
				'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Ajouter un produit</div>' +
				'<div class="com-widget-content">' +
					'<form id="formulaire-ajout-produit-creation-commande">' +
						'<table class="com-table-form">' +
							'<tr>' +
								/*'<th class="com-table-form-th ui-widget-content ui-corner-all" id="ajout-produit-idNom">Produit</th>' +
								'<td class="com-table-form-td" id="ajout-produit-nom">' +*/
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Produit</th>' +
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
			'</div>' +
			'<div id="liste_produit">' +
			'</div>' +
			'<div class="com-widget-window ui-widget ui-widget-header ui-corner-all com-center">' +
				'<button type="button" id="btn-modifier-creation-commande" class="com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center">Modifier</button>' +
				'<button type="button" id="btn-creer-commande" class="ui-state-default ui-corner-all com-button com-center">Valider</button>' +
			'</div>' +
		'</div>' +	
		'</div>';
	
	this.dialogAjoutProduit =
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
		"</div>";
	
	this.ajoutProduitModifierCommande = 
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
		"</div>";	
	
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
	
	this.formulaireAjoutCommande = 
		'<div id="contenu">' +
		'<div id="formulaire_ajout_commande_ext">' +		
			'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all">' +
				'<div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Nouveau Marché</div>' +
				'<div class="com-widget-content">' +		
					'<form id="formulaire-information-creation-commande">' +
						'<table class="com-table-form">' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Nom du Marché</th>' +
								'<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="text" name="nom_commande" id="commande-nom" maxlength="100" /></td>' +
							'</tr>' +
							'<tr>' +
								'<th class="com-table-form-th ui-widget-content ui-corner-all">Fin des Réservations *</th>' +
								'<td class="com-table-form-td">' +
									'<input class="com-input-text ui-widget-content ui-corner-all" type="text" name="date_fin_commande" id="commande-dateFinReservation" />' +
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
									'<input class="com-input-text ui-widget-content ui-corner-all" type="text" name="date_debut_marche" id="commande-dateMarcheDebut"/>' +
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
								'<td class="com-table-form-td"><textarea class="com-input-text ui-widget-content ui-corner-all" name="description_commande" id="commande-description" ></textarea></td>' +
							'</tr>' +
						'</table>' +
					'</form>' +
				'</div>' +
			'</div>' +
			'<div class="com-widget-window ui-widget ui-widget-content ui-corner-all" id="window-ajout-produit-creation-commande">' +
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
			'</div>' +
			'<div id="liste_produit"></div>' +
			'<div class="com-widget-window ui-widget ui-widget-header ui-corner-all com-center">' +
				'<button type="button" id="btn-modifier-creation-commande" class="com-btn-edt-multiples ui-helper-hidden ui-state-default ui-corner-all com-button com-center">Modifier le Marché</button>' +
				'<button type="button" id="btn-creer-commande" class="ui-state-default ui-corner-all com-button com-center">Créer le Marché</button>' +
			'</div>' +
		'</div>' +	
		'</div>';
	
	this.ajoutProduitAjoutCommande = 
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
		"</div>";
	
	this.ajoutLotModifPdt = 
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
		"<!-- END lots -->";
	
	this.ajoutLotAjoutPdt = 
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
		"<!-- END lots -->";
	
	this.ajoutLot = 
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
		"</div>";

	this.ajoutCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Création du Marché" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le marché n°{numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";		
	
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
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Marchés en cours</div>" +
						"<table class=\"com-table\">" +
							"<tr class=\"ui-widget ui-widget-header\">" +
								"<th class=\"com-table-th lst-resa-th-num\">N°</th>" +
								"<th class=\"com-table-th\">Date de cloture des Réservations</th>" +
								"<th class=\"com-table-th\">Marché</th>	" +
								"<th class=\"com-table-th\"></th>" +
								"<th class=\"com-table-th\"></th>" +
							"</tr>" +
							"<!-- BEGIN commande -->" +
							"<tr>" +
								"<td class=\"com-table-td com-text-align-right\">{commande.numero}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateFinReservation} à {commande.heureFinReservation}H{commande.minuteFinReservation}</td>" +
								"<td class=\"com-table-td\">Le {commande.dateMarcheDebut} de {commande.heureMarcheDebut}H{commande.minuteMarcheDebut} à {commande.heureMarcheFin}H{commande.minuteMarcheFin}</td>" +
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
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
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
			"</div>" +
			
			"<div class=\"com-clear-float-left com-widget-header ui-widget ui-widget-header ui-corner-all com-center\">" +
				"<span>Total Marché : <span id=\"total-global\"></span> {sigleMonetaire}</span>" +
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
			"<div id=\"dialog-export-liste-reservation\" title=\"Export des réservations en cours du Marché n°{comNumero}\">" +
				"<form>" +
					"<table>" +
						"<tr>" +
							"<td>Format de sortie : </td>" +
							"<td><input type=\"radio\" name=\"format\" value=\"0\" checked=\"checked\" />Pdf</td>" +
							"<td><input type=\"radio\" name=\"format\" value=\"1\" />CSV</td>" +
						"</tr>" +
						"<tr>" +
						"</tr>" +
						"<tr>" +
							"<td colspan=\"3\">Sélectionner les produits : </td>" +
						"</tr>" +
					"<!-- BEGIN pdtCommande -->" +
						"<tr>" +
							"<td></td>" +
							"<td><input type=\"checkbox\" value=\"{pdtCommande.proId}\" name=\"id_produits\"/></td>" +
							"<td>{pdtCommande.nproNom}</td>" +						
						"</tr>" +
					"<!-- END pdtCommande -->" +
					"</table>" +
				"</form>" +
			"</div>";
	
	this.editerCommandePage = 
		"<div id=\"contenu\">" +
			"<div class=\"com-float-left\" id=\"edt-com-info\">" +
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
					"Fin des réservations : <br/>Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>" +
					"Marché : <br/>Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}" +
					"</div>" +
				"</div>" +
				"<!-- BEGIN pdtCommande -->" +
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
				"<!-- END pdtCommande -->" +
			"</div>" +
			"<div>" +
				"<div class=\"com-float-left\" id=\"edt-com-nav-resa-achat\">" +
					"<span class=\"com-cursor-pointer ui-widget-header ui-corner-tl com-btn-hover ui-state-active\" id=\"btn-liste-resa\">Reservation</span>" +
					"<span class=\"com-cursor-pointer ui-widget-header ui-corner-tr com-btn-hover\" id=\"btn-liste-achat-resa\" >Achat</span>" +
				"</div>" +
				"<div class=\"com-float-left\" id=\"edt-com-liste\" >" +
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
									"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
									"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
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
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeReservation = 
		"<div class=\"com-float-left\" id=\"edt-com-liste\" >" +
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
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
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
		"<div class=\"com-float-left\" id=\"edt-com-liste\" >" +
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
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Adhérent</th>" +
						"<th class=\"com-table-th com-underline-hover\"><span class=\"ui-icon span-icon\"></span>Numéro Compte</th>" +
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
					
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-supp-achat-{achats.idAchat}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-circle-close\"></span>" +
					"</span>" +	
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all modif-achat-{achats.idAchat}\" id=\"btn-modif-achat-{achats.idAchat}\" title=\"Modifier\">" +
						"<span class=\"ui-icon ui-icon-pencil\"></span>" +
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
					
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-supp-achat-{achatsSolidaire.idAchat}\" title=\"Supprimer\">" +
						"<span class=\"ui-icon ui-icon-circle-close\"></span>" +
					"</span>" +	
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all modif-achat-{achatsSolidaire.idAchat}\" id=\"btn-modif-achat-{achatsSolidaire.idAchat}\" title=\"Modifier\">" +
						"<span class=\"ui-icon ui-icon-pencil\"></span>" +
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
								"<option value=\"{producteurs.prdtIdCompte}\">{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
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
								"<option value=\"{producteurs.prdtIdCompte}\">{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
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
						"<td colspan=\"2\"></td>" +
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
					"</tr>" +
					"<tr id=\"tr-champ-complementaire\">" +
						"<td colspan=\"5\"></td>" +
						"<td><span id=\"label-champ-complementaire\" ></span></td>" +
						"<td><input type=\"text\" name=\"champ-complementaire\" value=\"{champComplementaire}\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"typePaiementChampComplementaire\" maxlength=\"50\" size=\"15\"/></td>" +
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
}
;function GestionListeCommandeVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		if(lResponse.listeCommande.length > 0 && lResponse.listeCommande[0].comId != null) {
		
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = new Object();
					lCommande.id = this.comId;
					lCommande.numero = this.comNumero;
					lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();
	
					lListeCommande.commande.push(lCommande);
				});
			
			var lTemplate = lGestionCommandeTemplate.listeCommandePage;
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lListeCommande))));
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionCommandeTemplate.listeCommandeVide)));
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectLienEditer(pData);
		pData = this.affectLienMarche(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectLienListeCommandeArchive(pData);
		return pData;
	}
	
	this.affectLienEditer = function(pData) {
		pData.find('.btn-editer').click(function() {
			var lparam = {"id_commande":$(this).attr('id')};
			EditerCommandeVue(lparam);
		});
		return pData;
	}
	
	this.affectLienMarche = function(pData) {
		pData.find('.btn-marche').click(function() {
			var lparam = {"id_commande":$(this).attr('id')};
			MarcheCommandeVue(lparam);
		});
		return pData;
	}
	
	this.affectLienListeCommandeArchive = function(pData) {
		pData.find('#lien-marche-archive').click(function() {
			ListeCommandeArchiveVue();
		});
		return pData;
	}
	
	this.construct(pParam);
};function ModifierCommandeVue(pParam) {
	
	this.etapeCreationCommande = 0;
	this.mEditionEnCours = 0;
	this.mListeProducteurs = [];
	this.mCommunVue = new CommunVue();
	this.commande = null;
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=ModifierCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}						
							// Pas d'affichage si il n' a pas de producteur en base
							if(lResponse.producteurs[0].prdtId == null) {
								lResponse.producteurs = [];
							}
							that.mListeProducteurs = lResponse.producteurs;
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
				);		
	}
	
	this.afficher = function(pResponse) {
		var that = this;

		var lMarche = pResponse.marche;
		pResponse.sigleMonetaire = gSigleMonetaire;
		pResponse.comId = lMarche.id;
		pResponse.comNom = lMarche.nom;
		pResponse.comNumero = lMarche.numero;
		pResponse.comDescription = lMarche.description;
		pResponse.dateTimeFinReservation = lMarche.dateFinReservation.extractDbDate().dateDbToFr();
		pResponse.heureFinReservation = lMarche.dateFinReservation.extractDbHeure();
		pResponse.minuteFinReservation = lMarche.dateFinReservation.extractDbMinute();
		pResponse.dateMarcheDebut = lMarche.dateMarcheDebut.extractDbDate().dateDbToFr();
		pResponse.heureMarcheDebut = lMarche.dateMarcheDebut.extractDbHeure();
		pResponse.minuteMarcheDebut = lMarche.dateMarcheDebut.extractDbMinute();
		pResponse.heureMarcheFin = lMarche.dateMarcheFin.extractDbHeure();
		pResponse.minuteMarcheFin = lMarche.dateMarcheFin.extractDbMinute();
		
		// Pas d'affichage si il n' a pas de produit en base
		if(pResponse.produits[0].id == null) {
			pResponse.produits = [];
		}
		
		this.commande = pResponse;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.formulaireModifierCommande;
		
		
		var lData = that.affect($(lTemplate.template(pResponse)));
		pResponse.pdtCommande = pResponse.marche.produits;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.ajoutProduitModifierCommande;
		$.each(pResponse.pdtCommande,function() {
			if(this.id != undefined) {
				this.sigleMonetaire = gSigleMonetaire;

				this.producteurs = that.mListeProducteurs;
				var lIdCompteProducteur = this.idCompteProducteur;
				var lNomProducteur = '';
				$(that.mListeProducteurs).each(function() {
					if(this.prdtIdCompte == lIdCompteProducteur) {
						lNomProducteur = this.prdtPrenom + ' ' + this.prdtNom;
					}
				});
				this.nomProducteur = lNomProducteur;

				this.stockInitial = this.stockInitial.nombreFormate(2,',',' ');
				this.qteMaxCommande = this.qteMaxCommande.nombreFormate(2,',',' ');

				var lHtml = that.affectNouveauProduit($(lTemplate.template(this)));
								
				// Séléction du producteur
				lHtml.find(':input[name=producteur]').selectOptions(lIdCompteProducteur);
								
				var pdt = this;
				$.each(this.lots,function() {
					if(this.id != undefined) {						
						var lLot = {lots:[{
							id:this.id,
							taille:this.taille.nombreFormate(2,',',' '),
							prix:this.prix.nombreFormate(2,',',' '),
							unite:pdt.unite,
							idPdt:pdt.id}],
							siglemonetaire:gSigleMonetaire};
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lGestionCommandeTemplate.ajoutLotModifPdt.template(lLot)) ));
					}
				});
				
				lData.find("#liste_produit").append(that.afficherDeleteLot($(lHtml)));
			}
		});
		
		$('#contenu').replaceWith(lData);
	}
	
	this.affectSelectHeure = function(pData) {
		var that = this;
		pData.find(':input[name=heure_fin_commande]').selectOptions(that.commande.heureFinReservation);
		pData.find(':input[name=minute_fin_commande]').selectOptions(that.commande.minuteFinReservation);
		pData.find(':input[name=heure_debut_marche]').selectOptions(that.commande.heureMarcheDebut);
		pData.find(':input[name=minute_debut_marche]').selectOptions(that.commande.minuteMarcheDebut);
		pData.find(':input[name=heure_fin_marche]').selectOptions(that.commande.heureMarcheFin);
		pData.find(':input[name=minute_fin_marche]').selectOptions(that.commande.minuteMarcheFin);
		return pData;
	}
	
	
	this.affect = function(pData) {
		pData = this.affectAjoutProduit(pData);
		pData = this.affectCreerCommande(pData);
		pData = this.affectModifierCommande(pData);
		pData = this.affectDialogCreerProduit(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectSelectHeure(pData);
		pData = this.affectBtnRetourMarche(pData);		
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectNouveauProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectAjoutProduit = function(pData) {
		var lId = "#formulaire-ajout-produit-creation-commande";
		var that = this;
		pData.find(lId).submit(
			function () {				
				var lValid = true;
				$(".produit-nom-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.idProducteur = $(lId + " :input[name=producteur]").val();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();
					
					if(isNaN(parseFloat(lVo.qteMaxCommande)) || (parseFloat(lVo.qteMaxCommande) > parseFloat(lVo.qteRestante))){
						lVo.qteMaxCommande = lVo.qteRestante;
					}
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);

					var lValid = new ProduitCommandeValid();
					var lVr = lValid.validAjout(lVo);
					
					if(lVr.valid) {						
						//lVo.stockInitial = lVo.qteRestante;						
						
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitModifierCommande;						
						
						lVo.proMaxProduitCommande = lVo.qteMaxCommande.nombreFormate(2,',',' ');
						lVo.stockInitial = lVo.qteRestante.nombreFormate(2,',',' ');
						lVo.id = lVo.idNom * -1;
						
						lVo.lots = new Array();					
						lVo.lots.push({	id:0,
							idPdt:lVo.id,
							unite:lVo.unite,
							taille:lVoLot.taille.nombreFormate(2,',',' '),
							prix:lVoLot.prix.nombreFormate(2,',',' ')});

						lVo.siglemonetaire = gSigleMonetaire;
						
						lVo.producteurs = that.mListeProducteurs;
						lVo.nomProducteur = $(lId + " :input[name=producteur]").selectedOptions().text();
						
						var lHtml = that.affectNouveauProduit($(lTemplate.template(lVo)));

						// Séléction du producteur
						lHtml.find(':input[name=producteur]').selectOptions(lVo.idProducteur);
						
						lTemplate = lGestionCommandeTemplate.ajoutLotModifPdt;
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lTemplate.template(lVo)) ));
						
						$("#liste_produit").append(lHtml); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						$(lId + " :input[name=produit]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=produit]").selectOptions(0);
						$(lId + " :input[name=producteur]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=producteur]").selectOptions(0);
						
					} else {
						Infobulle.generer(lVr,'ajout-produit-');	
					}
				} else {
					var lVr = new TemplateVR();
					lVr.valid = false;
					lVr.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_211_CODE;
					erreur.message = ERR_211_MSG;
					lVr.log.erreurs.push(erreur);
					Infobulle.generer(lVr,'');
				}
				return false;								
			});
		return pData;
	}
	
	this.affectCreerCommande = function(pData) {
		var lId = "#btn-creer-commande";
		var that = this;
		pData.find(lId).click(
			function () {
				if(that.mEditionEnCours == 0) {
					// Récupération des données
					var lVo = new CommandeCompleteVO();
					lVo.id = that.commande.comId;
					lVo.numero = that.commande.comNumero;
					lVo.nom = $("#formulaire-information-creation-commande").find(':input[name=nom_commande]').val();
					lVo.description = $("#formulaire-information-creation-commande").find(':input[name=description_commande]').val();
					lVo.dateMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=heure_debut_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_debut_marche]').val() + ':00';
					lVo.dateMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_marche]').val() + ':00';
					lVo.dateFinReservation = $("#formulaire-information-creation-commande").find(':input[name=date_fin_commande]').val().dateFrToDb();
					lVo.timeFinReservation = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_commande]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_commande]').val() + ':00';
					lVo.archive = "0";
					
					$('.produit-div').each(
							function () {
								var lVoProduit = new ProduitCommandeVO();		
								lVoProduit.idProducteur = $(this).find(':input[name=producteur]').val();
								lVoProduit.id = $(this).find('.produit-id').text();	
								lVoProduit.idNom = $(this).find('.produit-nom-id').text();
								lVoProduit.unite = $(this).find(':input[name=unite]').val();
								lVoProduit.qteMaxCommande = $(this).find(':input[name=qmax]').val().numberFrToDb();
								lVoProduit.qteRestante = $(this).find(':input[name=stock]').val().numberFrToDb();
								
								$(this).find('.produit-lot').each(
										function () {
											// Récupération des lots
											var lVoLot = new DetailCommandeVO();
											lVoLot.id = $(this).find('.lot-id').text();
											lVoLot.taille = $(this).find(':input[name=taille]').val().numberFrToDb();
											lVoLot.prix = $(this).find(':input[name=prix]').val().numberFrToDb();
											lVoProduit.lots.push(lVoLot);										
										});													
								
								lVo.produits.push(lVoProduit);								
							});	
					
					if(that.etapeCreationCommande == 0) {
						var lValid = new CommandeCompleteValid();
						var lVR = lValid.validUpdate(lVo);
							
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide();
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot").each(
										function () {
											$(this).hide();
										});
								
								$("#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select").each(
										function () {
											$(this).inputToText();
										});					
						} else {
							// Affiche les erreurs
							Infobulle.generer(lVR,"commande-");							
						}
					
					} else if(that.etapeCreationCommande == 1) {
						// Envoi des infos en json
						var lParam = {form:2,commande:lVo};
						$.post(	"./index.php?m=GestionCommande&v=ModifierCommande", "pParam=" + $.toJSON(lParam),
								function (lVoRetour) {	
									if(lVoRetour.valid) {										
										// Message d'information
										var lVr = new TemplateVR();
										lVr.valid = false;
										lVr.log.valid = false;
										var erreur = new VRerreur();
										erreur.code = ERR_310_CODE;
										erreur.message = ERR_310_MSG;
										lVr.log.erreurs.push(erreur);
										
										EditerCommandeVue({
											"id_commande":that.mIdCommande,
											vr:lVr
										});
									} else {
										that.modifierCommandeFunction();
										Infobulle.generer(lVoRetour,"commande-");
									}
									that.etapeCreationCommande = 0; 
								},"json"
						);
					}
				} else {
					var lVR = new Object();
					var erreur = new VRerreur();
					erreur.code = ERR_112_CODE;
					erreur.message = ERR_112_MSG;
					lVR.valid = false;
					lVR.log = new VRelement();
					lVR.log.valid = false;
					lVR.log.erreurs.push(erreur);
					Infobulle.generer(lVR,"");
				}				
			});
		return pData;
	}
		
	this.affectModifierCommande = function(pData) {
		var that = this;
		pData.find('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
		return pData;
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande, .edit-nom-pdt-creation-commande-valid').hide();
		$('.produit-lots').each(function () {that.afficherDeleteLot($(this))});
		$('#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select').textToInput();
	}
	
	this.ajoutLotProduit = function(pData) {
		var that = this;
		pData.find('.btn-ajout-lot-creation-commande').click(
			function () {
				
				var inpTaille = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=taille]");
				var inpPrix = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=prix]");
				
				// Récupération des données
				var lVo = new DetailCommandeVO();
				lVo.idProduit = $(this).parents(".produit-div").find(".produit-id").text();
				lVo.taille = inpTaille.val().numberFrToDb();
				lVo.prix = inpPrix.val().numberFrToDb();

				var lValid = new DetailCommandeValid();
				var lVr = lValid.validAjout(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
					lVo.taille = parseFloat(lVo.taille).nombreFormate(2,',',' ');
					
					lVo.siglemonetaire = gSigleMonetaire;
					lVo.unite = $(this).parentsUntil(".produit-div").find(":input[name=unite]").val();
				
					lVo.idNom = lVo.idProduit;
					var lListeId = new Array();
					$(this).parentsUntil(".produit-div").find(".produit-lot").each(function(){
						lListeId.push(parseInt($(this).find(".lot-id").text()));
					});
					
					var lMinId = Array.min(lListeId);
					if(lMinId < 0) {
						lVo.id = lMinId-1;
					} else {
						lVo.id = -1;
					}
					
					var lGestionCommandeTemplate = new GestionCommandeTemplate();
					var lTemplate = lGestionCommandeTemplate.ajoutLot; 
					
					that.afficherDeleteLot(
							$(this).parents(".produit-div").find(".produit-lots").append(
									that.affectAjoutLot( $(lTemplate.template(lVo)) ))
					);
					
					// Remise à zéro du formulaire
					inpTaille.val('');
					inpPrix.val('');
				} else {
					Infobulle.generer(lVr,"ajout-lot-produit-" + lVo.idProduit + "-");
				}
			});
		return pData;
	}
	
	this.editProduit = function(pData) {
		var that = this;
		
		pData.find('.edit-nom-pdt-creation-commande-valid').click(function() {
			var lVo = new ProduitCommandeVO();
			var lId = $(this).closest(".produit-div"); 			
			lVo.idProducteur = $(lId).find(':input[name=producteur]').val();   				
			lVo.idNom = $(lId).find(".produit-nom-id").text();
			lVo.nom = $(lId).find(".produit-nom").text();
			lVo.unite = $(lId).find(":input[name=unite]").val();
			lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
			lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
			
			var lValid = new ProduitCommandeValid();
			var lVr = lValid.validAjout(lVo,'simple');
			
			if(lVr.valid) {
				Infobulle.init();
				
				var lNomProducteur = $(lId).find(':input[name=producteur]').selectedOptions().text();
				$(lId).find('#nom-producteur').text(lNomProducteur);
				
				var lStock = parseFloat(lVo.qteRestante).nombreFormate(2,',',' ');
				$(lId).find('.produit-stock').text(lStock);
				$(lId).find(":input[name=stock]").val(lStock)
				
				var lQteMax = parseFloat(lVo.qteMaxCommande).nombreFormate(2,',',' ');
				$(lId).find('.produit-qmax').text(lQteMax);
				$(lId).find(":input[name=qmax]").val(lQteMax)
				
				$(lId).find('.produit-unite').text(lVo.unite);
				var lDivParent = $(this).parentsUntil('#liste_produit');
    			lDivParent.find('.produit-unite').text(lVo.unite);
    			
    			pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
    			that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
			}			
		});
		
		pData.find('.edit-nom-pdt-creation-commande-edit').click(function() {			
			that.mEditionEnCours++;
			pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;		
		pData.find(".edit-lot-creation-commande-valid").click( function () {
			var lVo = new DetailCommandeVO();
			var lId = $(this).closest(".produit-lot");
			
			lVo.id = $(lId).find(".lot-id").text();
			lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
			lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
			lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();

			var lValid = new DetailCommandeValid();
			var lVr = lValid.validAjout(lVo);
			
			if(lVr.valid) {	
				Infobulle.init();
				/*$(this).parent().parent().find(":input[name='taille']").inputToText();
				$(this).parent().parent().find(":input[name='prix']").inputToText("montant");
				pData.find(".edit-lot-creation-commande").toggle();*/
				
				var lTaille = lVo.taille.nombreFormate(2,',',' ');
				$(lId).find(".produit-taille").text(lTaille);
				$(lId).find(":input[name=taille]").val(lTaille);
				
				var lPrix = lVo.prix.nombreFormate(2,',',' ');
				$(lId).find(".produit-prix").text(lPrix);
				$(lId).find(":input[name=prix]").val(lPrix);
				
				pData.find('.edit-lot-creation-commande, .pdt-' + lVo.idProduit + '-lot-' + lVo.id).toggle();
				that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
			}
		});
		
		pData.find(".edit-lot-creation-commande-edit").click( function () {
			/*$(this).parent().parent().children(':input:not(:button,:submit)').each(
					function () { $(this).textToInput(); });
			pData.find(".edit-lot-creation-commande").toggle();*/
			
			var lIdPdt = $(this).closest('.produit-div').find('.produit-id').text();
			var lIdLot = $(this).closest('.produit-lot').find('.lot-id').text();			
			pData.find('.edit-lot-creation-commande, .pdt-' + lIdPdt + '-lot-' + lIdLot).toggle();
			that.mEditionEnCours++;
		});

		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().parent().remove();
				that.afficherDeleteLot(lListeProduit);
			});
		return pData;
	}
	
	this.afficherDeleteLot = function(pData) {	
		if( pData.find('.produit-lot').size() < 2 ) {
			pData.find('.delete-lot').hide();
		} else {
			pData.find('.delete-lot').show();
		}		
		return pData;
	}
	
	this.affectDialogCreerProduit = function(pData) {
		var that = this;
		pData.find('#btn-creer-nv-pdt')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogAjoutProduit;
			
			$(lTemplate).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer le produit': function() {
						var lForm = $(this).children('form').first();
						that.CreerProduit(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProduit($(this));
				return false;
			});			
		});
		return pData;
	}
	
	this.CreerProduit = function(pForm) {
		var lVo = new NomProduitVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		lVo.idCategorie = 1; // TODO faire une gestion avec categorie
		
		var lValid = new NomProduitValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {form:1,nomProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {							
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						// Ajout dans la liste du select avec son ID
						var lNomPdt = [];
						lNomPdt[lResponse.id] = lResponse.nom;
						$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(lNomPdt).sortOptions();
						$("#dialog-form-creer-nv-pdt").dialog('close');
					} else {
						Infobulle.generer(lResponse,'nom-pdt-');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'nom-pdt-');
		}
	}
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut',pData);
		return pData;
	}
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.construct(pParam);
	
};function AjoutCommandeVue(pParam) {
	
	this.etapeCreationCommande = 0;
	this.mEditionEnCours = 0;
	this.mListeProducteurs = null;
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
				function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}						
							// Pas d'affichage si il n' a pas de producteur en base
							if(lResponse.producteurs[0].prdtId == null) {
								lResponse.producteurs = [];
							}							
							that.mListeProducteurs = lResponse.producteurs;
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}					
					},"json"
				);		
	}
	
	this.afficher = function(pResponse) {
		var that = this;
		
		// Pas d'affichage si il n' a pas de produit en base
		if(pResponse.produits[0].id == null) {
			pResponse.produits = [];
		}
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.formulaireAjoutCommande;
		$('#contenu').replaceWith( that.affect($(lTemplate.template(pResponse))));
	}
	
	this.affect = function(pData) {
		pData = this.affectAjoutProduit(pData);
		pData = this.affectCreerCommande(pData);
		pData = this.affectModifierCommande(pData);
		pData = this.affectDialogCreerProduit(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
		
	this.affectNouveauProduit = function(pData) {
		pData = this.mCommunVue.comDelete(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.editProduit(pData);
		pData = this.ajoutLotProduit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectAjoutLot = function(pData) {
		pData = this.editLot(pData);
		pData = this.deleteLot(pData);
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectAjoutProduit = function(pData) {
		var lId = "#formulaire-ajout-produit-creation-commande";
		var that = this;
		pData.find(lId).submit(
			function () {
				
				var lValid = true;
				$(".produit-id").each(function() {
					if(parseInt($(this).text()) ==  $(lId + " :input[name=produit]").val()) {lValid = false;}
				});
				
				if(lValid) {
					var lVo = new ProduitCommandeVO();
					
					lVo.idNom = $(lId + " :input[name=produit]").val();
					lVo.nom = $(lId + " :input[name=produit] option:selected").text();
					lVo.idProducteur = $(lId + " :input[name=producteur]").val();
					lVo.unite = $(lId + " :input[name=unite]").val();
					lVo.qteMaxCommande = $(lId + " :input[name=qmax]").val().numberFrToDb();
					lVo.qteRestante = $(lId + " :input[name=stock]").val().numberFrToDb();

					if(isNaN(parseFloat(lVo.qteMaxCommande)) || (parseFloat(lVo.qteMaxCommande) > parseFloat(lVo.qteRestante))){
						lVo.qteMaxCommande = lVo.qteRestante;
					}
					
					var lVoLot = new DetailCommandeVO();
					lVoLot.taille = $(lId + " :input[name=taille]").val().numberFrToDb();
					lVoLot.prix = $(lId + " :input[name=prix]").val().numberFrToDb();
					lVo.lots.push(lVoLot);

					var lValid = new ProduitCommandeValid();
					var lVr = lValid.validAjout(lVo);
					
					if(lVr.valid) { 
						Infobulle.init(); // Supprime les erreurs
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.ajoutProduitAjoutCommande;
						
						lVo.qteMaxCommande = lVo.qteMaxCommande.nombreFormate(2,',',' ');
						lVo.qteRestante = lVo.qteRestante.nombreFormate(2,',',' ');
						
						lVo.lots[0].prix = parseFloat(lVo.lots[0].prix).nombreFormate(2,',',' ');
						lVo.lots[0].taille = parseFloat(lVo.lots[0].taille).nombreFormate(2,',',' ');
						lVo.lots[0].id = 0;
						lVo.siglemonetaire = gSigleMonetaire;
						
						lVo.producteurs = that.mListeProducteurs;
						lVo.nomProducteur = $(lId + " :input[name=producteur]").selectedOptions().text();
						
						var lHtml = that.affectNouveauProduit($(lTemplate.template(lVo)));
						
						// Séléction du producteur
						lHtml.find(':input[name=producteur]').selectOptions(lVo.idProducteur);
						
						lTemplate = lGestionCommandeTemplate.ajoutLotAjoutPdt; 
						lHtml.find(".produit-lots").append( that.affectAjoutLot( $(lTemplate.template(lVo)) ));
							
						$("#liste_produit").append(lHtml); // Insertion dans la page	
						
						// RAZ du formulaire
						$(lId + " :input[name=unite]").val('');
						$(lId + " :input[name=qmax]").val('');
						$(lId + " :input[name=stock]").val('');
						$(lId + " :input[name=taille]").val('');
						$(lId + " :input[name=prix]").val('');
						$(lId + " :input[name=produit]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=produit]").selectOptions(0);
						$(lId + " :input[name=producteur]").selectedOptions().attr("selected",'');
						$(lId + " :input[name=producteur]").selectOptions(0);
						
					} else {
						Infobulle.generer(lVr,'ajout-produit-');	
					}
				} else {
					var lVr = new TemplateVR();
					lVr.valid = false;
					lVr.log.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_211_CODE;
					erreur.message = ERR_211_MSG;
					lVr.log.erreurs.push(erreur);
					Infobulle.generer(lVr,'');
				}
				return false;								
			});
		return pData;
	}
	
	this.affectCreerCommande = function(pData) {
		var lId = "#btn-creer-commande";
		var that = this;
		pData.find(lId).click(
			function () {				
				if(that.mEditionEnCours == 0) {
					// Récupération des données
					var lVo = new CommandeCompleteVO();
					lVo.nom = $("#formulaire-information-creation-commande").find(':input[name=nom_commande]').val();
					lVo.description = $("#formulaire-information-creation-commande").find(':input[name=description_commande]').val();
					lVo.dateMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheDebut = $("#formulaire-information-creation-commande").find(':input[name=heure_debut_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_debut_marche]').val() + ':00';
					lVo.dateMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=date_debut_marche]').val().dateFrToDb();
					lVo.timeMarcheFin = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_marche]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_marche]').val() + ':00';
					lVo.dateFinReservation = $("#formulaire-information-creation-commande").find(':input[name=date_fin_commande]').val().dateFrToDb();
					lVo.timeFinReservation = $("#formulaire-information-creation-commande").find(':input[name=heure_fin_commande]').val() + ':' + $("#formulaire-information-creation-commande").find(':input[name=minute_fin_commande]').val() + ':00';
					lVo.archive = "0";
					
					$('.produit-div').each(
							function () {
								var lVoProduit = new ProduitCommandeVO();		
								lVoProduit.idProducteur = $(this).find(':input[name=producteur]').val();
								lVoProduit.idNom = $(this).find('.produit-id').text();							
								lVoProduit.unite = $(this).find(':input[name=unite]').val();
								lVoProduit.qteMaxCommande = $(this).find(':input[name=qmax]').val().numberFrToDb();
								lVoProduit.qteRestante = $(this).find(':input[name=stock]').val().numberFrToDb();
								
								$(this).find('.produit-lot').each(
										function () {
											// Récupération des lots
											var lVoLot = new DetailCommandeVO();
											lVoLot.taille = $(this).find(':input[name=taille]').val().numberFrToDb();
											lVoLot.prix = $(this).find(':input[name=prix]').val().numberFrToDb();
											lVoProduit.lots.push(lVoLot);										
										});													
								
								lVo.produits.push(lVoProduit);								
							});	
					
					if(that.etapeCreationCommande == 0) {		
						
						var lValid = new CommandeCompleteValid();
						var lVR = lValid.validAjout(lVo);
											
						if(lVR.valid) {
								that.etapeCreationCommande = 1;
								Infobulle.init(); // Supprime les erreurs
								
								$("#window-ajout-produit-creation-commande").hide();
								$("#btn-modifier-creation-commande").show();
								$("#liste_produit .produit-div :button , .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot").each(
										function () {
											$(this).hide();
										});
								
								$("#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select").each(
										function () {
											$(this).inputToText();
										});					
						} else {
							// Affiche les erreurs
							Infobulle.generer(lVR,"commande-");							
						}
					
					} else if(that.etapeCreationCommande == 1) {
						// Envoi des infos en json
						$.post(	"./index.php?m=GestionCommande&v=AjoutCommande",
								"commande=" + $.toJSON(lVo) + "&form=2",
								function (lVoRetour) {		
									if(lVoRetour.valid) {
										var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.ajoutCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lVoRetour));
									} else {
										that.modifierCommandeFunction();
										Infobulle.generer(lVoRetour,"commande-");
									}
									that.etapeCreationCommande = 0;
								},"json"
						);
					}
				} else {
					var lVR = new Object();
					var erreur = new VRerreur();
					erreur.code = ERR_112_CODE;
					erreur.message = ERR_112_MSG;
					lVR.valid = false;
					lVR.log = new VRelement();
					lVR.log.valid = false;
					lVR.log.erreurs.push(erreur);
					Infobulle.generer(lVR,"");
				}				
			});
		return pData;
	}
		
	this.affectModifierCommande = function(pData) {
		var that = this;
		pData.find('#btn-modifier-creation-commande').click(
			function () {
				that.modifierCommandeFunction();
		});
		return pData;
	}
	
	this.modifierCommandeFunction = function() {
		this.etapeCreationCommande = 0;
		var that = this;
		$('#window-ajout-produit-creation-commande, #liste_produit .produit-div :button, .form-ajout-lot-creation-commande, .com-btn-header, .conteneur-btn-edt-lot').show(); //'blind',gTempsTransitionUnique
		$('#btn-modifier-creation-commande, .edit-nom-pdt-creation-commande-valid').hide();
		$('.produit-lots').each(function () {that.afficherDeleteLot($(this))});
		$('#formulaire-information-creation-commande :input[type=text], #formulaire-information-creation-commande :input[type=textarea], #formulaire-information-creation-commande select').textToInput();
	}
	
	this.ajoutLotProduit = function(pData) {
		var that = this;
		pData.find('.btn-ajout-lot-creation-commande').click(
			function () {
				
				var inpTaille = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=taille]");
				var inpPrix = $(this).parents(".form-ajout-lot-creation-commande").find(":input[name=prix]");
				
				// Récupération des données
				var lVo = new DetailCommandeVO();
				lVo.idProduit = $(this).parents(".produit-div").find(".produit-id").text();
				lVo.taille = inpTaille.val().numberFrToDb();
				lVo.prix = inpPrix.val().numberFrToDb();
				
				var lValid = new DetailCommandeValid();
				var lVr = lValid.validAjout(lVo);
				
				if(lVr.valid) {
					Infobulle.init();
					lVo.prix = parseFloat(lVo.prix).nombreFormate(2,',',' ');
					lVo.taille = parseFloat(lVo.taille).nombreFormate(2,',',' ');
					
					lVo.siglemonetaire = gSigleMonetaire;
					lVo.unite = $(this).parentsUntil(".produit-div").find(":input[name=unite]").val();
				
					lVo.idNom = lVo.idProduit;
					var lListeId = new Array();
					$(this).parentsUntil(".produit-div").find(".produit-lot").each(function(){
						lListeId.push(parseInt($(this).find(".lot-id").text()));
					});
					lVo.id = Array.max(lListeId) + 1;
					
					var lGestionCommandeTemplate = new GestionCommandeTemplate();
					var lTemplate = lGestionCommandeTemplate.ajoutLot; 
					
					that.afficherDeleteLot(
							$(this).parents(".produit-div").find(".produit-lots").append(
									that.affectAjoutLot( $(lTemplate.template(lVo)) ))
					);
					
					// Remise à zéro du formulaire
					inpTaille.val('');
					inpPrix.val('');
				} else {
					Infobulle.generer(lVr,"ajout-lot-produit-" + lVo.idProduit + "-");
				}
			});
		return pData;
	}
	
	this.editProduit = function(pData) {
		var that = this;
		
		pData.find('.edit-nom-pdt-creation-commande-valid').click(function() {
			var lVo = new ProduitCommandeVO();
			var lId = $(this).closest(".produit-div");			
			lVo.idProducteur = $(lId).find(':input[name=producteur]').val();
			lVo.idNom = $(lId).find(".produit-id").text();
			lVo.nom = $(lId).find(".produit-nom").text();
			lVo.unite = $(lId).find(":input[name=unite]").val();
			lVo.qteMaxCommande = $(lId).find(":input[name=qmax]").val().numberFrToDb();
			lVo.qteRestante = $(lId).find(":input[name=stock]").val().numberFrToDb();	
			
			var lValid = new ProduitCommandeValid();
			var lVr = lValid.validAjout(lVo,'simple');
			
			if(lVr.valid) {
				Infobulle.init();
				
				var lNomProducteur = $(lId).find(':input[name=producteur]').selectedOptions().text();
				$(lId).find('#nom-producteur').text(lNomProducteur);
				
				var lStock = parseFloat(lVo.qteRestante).nombreFormate(2,',',' ');
				$(lId).find('.produit-stock').text(lStock);
				$(lId).find(":input[name=stock]").val(lStock)
				
				var lQteMax = parseFloat(lVo.qteMaxCommande).nombreFormate(2,',',' ');
				$(lId).find('.produit-qmax').text(lQteMax);
				$(lId).find(":input[name=qmax]").val(lQteMax)
				
				$(lId).find('.produit-unite').text(lVo.unite);
				var lDivParent = $(this).parentsUntil('#liste_produit');
    			lDivParent.find('.produit-unite').text(lVo.unite);
				
				pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
				that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idNom + '-');
			}
			
		});
		
		pData.find('.edit-nom-pdt-creation-commande-edit').click(function() {
			that.mEditionEnCours++;
			pData.find('.edit-nom-pdt-creation-commande, .info-produit').toggle();
		});
		return pData;
	}

	
	this.editLot = function(pData) {
		var that = this;
			
		pData.find(".edit-lot-creation-commande-valid").click( function () {
			var lVo = new DetailCommandeVO();
			var lId = $(this).closest(".produit-lot");
			
			lVo.id = $(lId).find(".lot-id").text();
			lVo.idProduit = $(this).parentsUntil(".produit-div").find(".produit-id").text();
			lVo.taille = $(lId).find(":input[name=taille]").val().numberFrToDb();
			lVo.prix = $(lId).find(":input[name=prix]").val().numberFrToDb();
			
			var lValid = new DetailCommandeValid();
			var lVr = lValid.validAjout(lVo);
			
			if(lVr.valid) {	
				Infobulle.init();
				
				var lTaille = lVo.taille.nombreFormate(2,',',' ');
				$(lId).find(".produit-taille").text(lTaille);
				$(lId).find(":input[name=taille]").val(lTaille);
				
				var lPrix = lVo.prix.nombreFormate(2,',',' ');
				$(lId).find(".produit-prix").text(lPrix);
				$(lId).find(":input[name=prix]").val(lPrix);
				
				pData.find('.edit-lot-creation-commande, .pdt-' + lVo.idProduit + '-lot-' + lVo.id).toggle();
				that.mEditionEnCours--;
			} else {
				Infobulle.generer(lVr,'produit-' + lVo.idProduit + '-lot-' + lVo.id + '-');
			}
		});		

		pData.find(".edit-lot-creation-commande-edit").click( function () {			
			var lIdPdt = $(this).closest('.produit-div').find('.produit-id').text();
			var lIdLot = $(this).closest('.produit-lot').find('.lot-id').text();			
			pData.find('.edit-lot-creation-commande, .pdt-' + lIdPdt + '-lot-' + lIdLot).toggle();
			that.mEditionEnCours++;
		});		
		return pData;
	}
	
	this.deleteLot = function(pData) {
		var that = this;
		pData.find('.delete-lot').click(
			function () {
				var lListeProduit = $(this).parents(".produit-lots");
				$(this).parent().parent().remove();
				that.afficherDeleteLot(lListeProduit);
			});
		return pData;
	}
	
	this.afficherDeleteLot = function(pData) {	
		if( pData.children('.produit-lot').size() < 2 ) {
			pData.find('.delete-lot').hide();
		} else {
			pData.find('.delete-lot').show();
		}		
		return pData;
	}
	
	this.affectDialogCreerProduit = function(pData) {
		var that = this;
		pData.find('#btn-creer-nv-pdt')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogAjoutProduit;
			
			$(lTemplate).dialog({			
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:400,
				buttons: {
					'Créer le produit': function() {
						var lForm = $(this).children('form').first();
						that.CreerProduit(lForm);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
			}).submit(function () {
				that.CreerProduit($(this));
				return false;
			});			
		});		
		return pData;
	}
	
	this.CreerProduit = function(pForm) {
		var lVo = new NomProduitVO();
		
		lVo.nom = pForm.find(':input[name=nom]').val();
		lVo.description = pForm.find(':input[name=description]').val();
		lVo.idCategorie = 1; // TODO faire une gestion avec categorie
		
		var lValid = new NomProduitValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {	
			Infobulle.init();
			var lParam = {form:1,nomProduit:lVo};
			// Ajout
			$.post(	"./index.php?m=GestionCommande&v=AjoutCommande", "pParam=" + $.toJSON(lParam),
				function (lResponse) {							
					if(lResponse.valid) {
						Infobulle.init(); // Supprime les erreurs
						// Ajout dans la liste du select avec son ID
						var lNomPdt = [];
						lNomPdt[lResponse.id] = lResponse.nom;
						$('#formulaire-ajout-produit-creation-commande select[name=produit]').addOption(lNomPdt).sortOptions();
						$("#dialog-form-creer-nv-pdt").dialog('close');
					} else {
						Infobulle.generer(lResponse,'nom-pdt-');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'nom-pdt-');
		}
	}
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comLienDatepicker('commande-dateFinReservation','commande-dateMarcheDebut',pData);
		return pData;
	}
	
	this.construct(pParam);
	
};function AchatCommandeVue(pParam) {
	this.idCommande = null;
	this.idAdherent = null;
	this.idCompte = null;
//	this.listeLot = new Array();
	this.mTypePaiement = [];
	this.solde = null;
	this.mCommunVue = new CommunVue();
	this.etapeValider = 0;
	this.total = 0;
	this.totalSolidaire = 0;
	
	this.pdtCommande = [];
	
	this.construct = function(pParam) {
		var that = this;
		this.idCommande = pParam.id_commande;
		this.idAdherent = pParam.id_adherent;

		pParam.fonction = "infoAchat";
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
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
				},"json"
		);
	}		
	
	this.afficher = function(pResponse) {
		Infobulle.init(); // Supprime les erreurs
		if(pResponse.valid) {
			var that = this;
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.achatCommandePage;
			
			var lData = new Object();
			lData.comNumero = pResponse.marche.numero;
			
			lData.adhNumero = pResponse.adherent.adhNumero;
			lData.adhCompte = pResponse.adherent.cptLabel;
			lData.adhNom = pResponse.adherent.adhNom;
			lData.adhPrenom = pResponse.adherent.adhPrenom;
			lData.sigleMonetaire = gSigleMonetaire;
			lData.total = 0;
			
			lData.produits = new Array();
			lData.produitsSolidaire = new Array();
			
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lProduitCommande = this;
					var lProduit = {};
					lProduit.proId = this.id;
					lProduit.nproNom = this.nom;
					lProduit.proUniteMesure = this.unite;
					lProduit.stoQuantite = 0;
					lProduit.proPrix = 0;
					var lPrix = 0;
					$.each(this.lots, function() {
						if(this.id) {
							var lIdLot = this.id;
							$(pResponse.reservation).each(function() {
								if(this.idDetailCommande == lIdLot) {
									lProduit.stoQuantite = this.quantite * -1;
									//lPrix = (parseFloat(lProduitCommande.lots[this.idDetailCommande].prix) / parseFloat(lProduitCommande.lots[this.idDetailCommande].taille)) * parseFloat(lProduit.stoQuantite);
									lPrix = this.montant * -1;
									lProduit.proPrix = lPrix.nombreFormate(2,',',' ');
								}											
							});
						}
					});
					lData.total += lPrix;
					lData.produits.push(lProduit);

					$(pResponse.stockSolidaire).each(function() {
						if(lProduit.proId == this.proId){
							lData.produitsSolidaire.push(lProduit);
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
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
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
		var lNvPrix = 0;
		
		if(this.pdtCommande[lIdProduit].prixUnitaire != null) {
			lNvPrix = this.pdtCommande[lIdProduit].prixUnitaire * lQuantite;
		}			
		if(isNaN(lNvPrix)) {lNvPrix = 0;}

		if(lNvPrix != 0) {
			ligne.find(".produit-prix").val(lNvPrix.nombreFormate(2,',',' '));
		} /*else {
			ligne.find(".produit-prix").val('');
		}*/
		
		this.majNouveauSolde();		
	}
	
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
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","pParam=" + $.toJSON(lVo),
				function(lVoRetour) {
					if(lVoRetour.valid) {
						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.achatCommandeSucces;
						$('#contenu').replaceWith(that.affectAnnuler($(lTemplate)));
					} else {
						that.boutonModifier();
						Infobulle.generer(lVoRetour,"");
					}
					that.etapeValider = 0;
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
		MarcheCommandeVue({id_commande:this.idCommande});
	}
	
	this.construct(pParam);
};function ListeCommandeArchiveVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		var lParam = {archive:1};
		$.post(	"./index.php?m=GestionCommande&v=ListeCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {		
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		if(lResponse.listeCommande.length > 0 && lResponse.listeCommande[0].comId != null) {
		
			var lListeCommande = new Object;
			lListeCommande.commande = new Array();
			
				$(lResponse.listeCommande).each(function() {
					var lCommande = new Object();
					lCommande.id = this.comId;
					lCommande.numero = this.comNumero;
					lCommande.dateFinReservation = this.comDateFinReservation.extractDbDate().dateDbToFr();
					lCommande.heureFinReservation = this.comDateFinReservation.extractDbHeure();
					lCommande.minuteFinReservation = this.comDateFinReservation.extractDbMinute();
					
					lCommande.dateMarcheDebut = this.comDateMarcheDebut.extractDbDate().dateDbToFr();
					lCommande.heureMarcheDebut = this.comDateMarcheDebut.extractDbHeure();
					lCommande.minuteMarcheDebut = this.comDateMarcheDebut.extractDbMinute();
					
					lCommande.heureMarcheFin = this.comDateMarcheFin.extractDbHeure();
					lCommande.minuteMarcheFin = this.comDateMarcheFin.extractDbMinute();

					lCommande.dateTimeFinResa = this.comDateFinReservation.replace('-','').replace(' ','').replace(':','');
					lCommande.dateTimeMarche = this.comDateMarcheDebut.replace('-','').replace(' ','').replace(':','');
					
					lListeCommande.commande.push(lCommande);
				});
			
			var lTemplate = lGestionCommandeTemplate.listeCommandeArchivePage;			
			var lHtml = $(lTemplate.template(lListeCommande));
			
			// Ne pas afficher la pagination si il y a moins de 30 éléments
			if(lResponse.listeCommande.length < 31) {
				lHtml = this.masquerPagination(lHtml);
			} else {
				lHtml = this.paginnation(lHtml);
			}
			
			$('#contenu').replaceWith(that.affect(lHtml));
			
		} else {
			$('#contenu').replaceWith(that.affect($(lGestionCommandeTemplate.listeCommandeArchiveVide)));
		}
	}
	
	this.affect = function(pData) {
		pData = this.affectLienListeCommandeArchive(pData);
		pData = this.affectLienDetail(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.affectLienListeCommandeArchive = function(pData) {
		pData.find('#lien-marche-encours').click(function() {
			GestionListeCommandeVue();
		});
		return pData;
	}
	
	this.paginnation = function(pData) {
		pData.find("#table-marche-archive")
			.tablesorter({sortList: [[2,1]]})
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false,size:30}); 
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		pData.find("#table-marche-archive").tablesorter({sortList: [[2,1]]});
		return pData;
	}
	
	this.affectLienDetail = function(pData) {
		pData.find('.detail-commande-ligne').click(function() {
			var lparam = {"id_commande":$(this).find('.id-commande').text()};
			InfoCommandeArchiveVue(lparam);
		});
		return pData;
	}
	
	this.construct(pParam);
};function MarcheCommandeVue(pParam) {
	this.idCommande = null;
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = "listeReservation";
		$.post(	"./index.php?m=GestionCommande&v=MarcheCommande","pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
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
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				
				if(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null) {
					var lTemplate = lGestionCommandeTemplate.listeAdherentCommandePage;
					pResponse.comNumero = pResponse.listeAdherentCommande[0].comNumero;
					$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));
				} else {
					$('#contenu').replaceWith(lGestionCommandeTemplate.listeMarcheVide);
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
			AchatCommandeVue(lParam);
		});
		return pData;
	}
	
	this.construct(pParam);
};function BonDeLivraisonVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdCommande = null;
	this.mComNumero = null;
	this.mEtatEdition = false;
	this.mListeProduit = [];
	this.mSuiteEdition = 0;
	this.mIdCompteProducteur = 0;
	this.mTypePaiement = [];
	
	this.construct = function(pParam) {
		var that = this;
		//pParam.export_type = 0;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mEtatEdition = false;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.bonDeLivraison;
		
		this.mIdCommande = pResponse.producteurs[0].proIdCommande;
		this.mComNumero = pResponse.comNumero;
		
		$(pResponse.typePaiement).each(function() {
			that.mTypePaiement[this.tppId] = this;
		});
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));	
	}
	
	this.affect = function(pData) {
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectBtnRetourMarche(pData);
		pData = this.affectChangementProducteur(pData);
		pData = this.affectExportBonDeLivraison(pData);
		return pData;
	}
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectChangementProducteur = function(pData) {
		var that = this;
		pData.find('#select-prdt').change(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 1;
				that.dialogEnregistrer();
			} else {
				that.changementProducteur();
			}
		});
		return pData;
	}
	
	this.changementProducteur = function() {
		var that = this;
		var lIdCompteProducteur = $('#select-prdt').val();
		if(lIdCompteProducteur > 0) {
			var lParam = {	"id_commande":that.mIdCommande,
						 	"id_compte_producteur":lIdCompteProducteur,
						 	fonction:"afficherProducteur"}
			$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mIdCompteProducteur = lIdCompteProducteur;
							that.mEtatEdition = false;
							var lTotal = 0;
							$(lResponse.produits).each(function() {
								that.mListeProduit[this.proId] = parseFloat(this.stoQuantite);
								
								this.stoQuantiteCommande = '';
								this.opeMontant = '';
								var lQuantite = 0;
								
								var lProId = this.proId;
								var these = this;

								these.stoQuantiteCommande = '0'.nombreFormate(2,',',' ');
								these.opeMontantCommande = '0'.nombreFormate(2,',',' ');
								these.stoQuantiteLivraison = '';
								these.opeMontantLivraison = '';
								these.stoQuantiteSolidaire = '';
								
								$(lResponse.produitsCommande).each(function() {
									if(this.proId == lProId) {
										var lMontant = 0;										
										if(this.stoQuantite != null) {
											these.stoQuantiteCommande = this.stoQuantite.nombreFormate(2,',',' ');
										}
										if(this.dopeMontant != null) {
											these.opeMontantCommande = this.dopeMontant.nombreFormate(2,',',' ');
											lMontant = parseFloat(this.dopeMontant);
										}
										lTotal += lMontant;
									}
								});
								
								$(lResponse.produitsLivraison).each(function() {
									if(this.proId == lProId) {
										if(this.stoQuantite != null) {
											these.stoQuantiteLivraison = this.stoQuantite.nombreFormate(2,',',' ');
											lQuantite += parseFloat(this.stoQuantite);
										}
										if(this.dopeMontant != null) {
											these.opeMontantLivraison = this.dopeMontant.nombreFormate(2,',',' ');
										}
									}
								});
								
								$(lResponse.produitsSolidaire).each(function() {
									if(this.proId == lProId) {										
										if(this.stoQuantite != null) {
											these.stoQuantiteSolidaire = this.stoQuantite.nombreFormate(2,',',' ');
											lQuantite += parseFloat(this.stoQuantite);
										}
									}
								});
								
								if(lQuantite - parseFloat(this.stoQuantite) < 0) {
									this.classEtat = 'qte-reservation-ko';
								} else {
									this.classEtat = 'qte-reservation-ok';
								}
									
								this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
							});	
							
							lResponse.total = '';
							if(lResponse.operationProducteur) {
								if(lResponse.operationProducteur.montant != null) {
									lResponse.total = (lResponse.operationProducteur.montant).nombreFormate(2,',',' ');
								}
								if(lResponse.operationProducteur.typePaiementChampComplementaire != null) {
									lResponse.champComplementaire = lResponse.operationProducteur.typePaiementChampComplementaire;
								}
							}
							
							lResponse.sigleMonetaire = gSigleMonetaire;
							lResponse.totalCommande = lTotal.nombreFormate(2,',',' ');
							lResponse.typePaiement = that.mTypePaiement;
							
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.listeProduitLivraison;
							
							var lHtml = that.affectListeProduit($(lTemplate.template(lResponse)));
							
							if(lResponse.operationProducteur && lResponse.operationProducteur.typePaiement != null) {
								var lId = lResponse.operationProducteur.typePaiement;
								
								lHtml.find(':input[name=typepaiement]').selectOptions(lId);
								
								var lLabel = that.getLabelChamComplementaire(lId);
								if(lLabel != null) {
									lHtml.find("#label-champ-complementaire").text(lLabel);
									lHtml.find("#tr-champ-complementaire").show();
								} else {
									lHtml.find("#label-champ-complementaire").text('');
									lHtml.find("#tr-champ-complementaire").hide();
								}
							} else {
								lHtml.find("#label-champ-complementaire").text('');
								lHtml.find("#tr-champ-complementaire").hide();
							}
							
							$('#liste-pdt').replaceWith(lHtml);
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.listeProduitVide;
			$('#liste-pdt').replaceWith(lTemplate);
		}
	}
	
	this.affectListeProduit = function(pData) {
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectEtatCommande(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectEnregistrer(pData);
		pData = this.affectTypePaiement(pData);
		pData = this.affectChangementEtatEdition (pData);
		return pData;
	}
	
	this.affectTypePaiement = function(pData) {
		var that = this;
		pData.find(':input[name=typepaiement]').change(function() {
			that.changerTypePaiement($(this));
		});
		return pData;
	}
	
	this.changerTypePaiement = function(pObj) {
		var lId = pObj.val();
		var lLabel = this.getLabelChamComplementaire(lId);
		if(lLabel != null) {
			$("#label-champ-complementaire").text(lLabel);
			$("#tr-champ-complementaire").show();
		} else {
			$("#label-champ-complementaire").text('');
			$(":input[name=champ-complementaire]").val('');
			$("#tr-champ-complementaire").hide();
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
	
	this.affectEtatCommande = function(pData) {
		var that = this;
		pData.find(".qte-commande ,.qte-solidaire-commande ").keyup(function() {
			that.mEtatEdition = true;
			var lIdProduit = $(this).prev(".pro-id-etat").text();
			if(that.mListeProduit[lIdProduit]) {
				var lQuantite = 0;
				var lQuantiteLivraison = $(':input[name=qte-commande-' + lIdProduit + ']').val().numberFrToDb();
				var lQuantiteSolidaire = $(':input[name=qte-solidaire-commande-' + lIdProduit + ']').val().numberFrToDb();
				
				if(!isNaN(lQuantiteLivraison) && !lQuantiteLivraison.isEmpty()){
					lQuantite += parseFloat(lQuantiteLivraison);
				}
				if(!isNaN(lQuantiteSolidaire) && !lQuantiteSolidaire.isEmpty()){
					lQuantite += parseFloat(lQuantiteSolidaire);
				}
				
				if(lQuantite - that.mListeProduit[lIdProduit] < 0) {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ok')
						.addClass('qte-reservation-ko');
				} else {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ko')
						.addClass('qte-reservation-ok');
				}
			}
		});
		return pData;
	}
	
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find("#btn-enregistrer").click(function() {
			that.mSuiteEdition = 0;
			that.enregistrer();
		});
		pData.find(".qte-commande ,.prix-commande ").keyup(function(event) {
			if (event.keyCode == '13') {
				that.mSuiteEdition = 0;
				that.enregistrer();
			}			
		});
		return pData;
	}
	
	this.enregistrer = function() {
		var that = this;
		
		var lParam = new ProduitsBonDeLivraisonVO();
		
		lParam.id_commande = this.mIdCommande;
		lParam.id_compte_producteur = this.mIdCompteProducteur;
		//lParam.export_type = 0;

		$('.pro-id').each(function() {
			var lId = $(this).text();				
			var lProduit = new ProduitBonDeLivraisonVO();
			lProduit.id  = lId;
			lProduit.quantite = $(':input[name=qte-commande-' + lId + ']').val().numberFrToDb();
			lProduit.quantiteSolidaire = $(':input[name=qte-solidaire-commande-' + lId + ']').val().numberFrToDb();
			lProduit.prix = $(':input[name=prix-commande-' + lId + ']').val().numberFrToDb();
			lParam.produits.push(lProduit);
		});		
		
		lParam.typePaiement = $(':input[name=typepaiement]').val();
		lParam.total = $(':input[name=total]').val().numberFrToDb();
		
		if(this.getLabelChamComplementaire(lParam.typePaiement) != null) {
			lParam.typePaiementChampComplementaireObligatoire = 1;
			lParam.typePaiementChampComplementaire = $(":input[name=champ-complementaire]").val();
		} else {
			lParam.typePaiementChampComplementaireObligatoire = 0;
		}
		
		var lValid = new ProduitsBonDeLivraisonValid();
		var lVr = lValid.validAjout(lParam);
				
		if(lVr.valid) {
			lParam.fonction = "enregistrer";
			$.post(	"./index.php?m=GestionCommande&v=BonDeLivraison", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mEtatEdition = false;
							if(that.mSuiteEdition == 1) {
								that.changementProducteur();
							} else if (that.mSuiteEdition == 2) {
								that.dialogExportBonDeLivraison();
							} else {
								var lVr = new TemplateVR();
								lVr.valid = false;
								lVr.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_301_CODE;
								erreur.message = ERR_301_MSG;
								lVr.log.erreurs.push(erreur);							
								
								Infobulle.generer(lVr,'');
							}
						} else {
							Infobulle.generer(lResponse,'');
							$('#select-prdt').selectOptions(that.mIdCompteProducteur);
						}
					},"json"
			);
			
		} else {
			Infobulle.generer(lVr,'');
			$('#select-prdt').selectOptions(that.mIdCompteProducteur);
		}
	}
	
	this.affectExportBonDeLivraison = function(pData) {		
		var that = this;		
		pData.find('#btn-export-bcom')
		.click(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 2;
				that.dialogEnregistrer();
			} else {
				that.dialogExportBonDeLivraison();
			}			
		});
		return pData;
	}
	
	this.affectChangementEtatEdition = function(pData) {
		var that = this;
		pData.find('.com-input-text').keyup(function() {that.mEtatEdition = true;});
		pData.find(':input[name=typepaiement]').change(function() {that.mEtatEdition = true;});
		return pData;
	}
	
	this.dialogExportBonDeLivraison = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogExportBonDeLivraison;
		$(lTemplate.template({comNumero:that.mComNumero})).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter': function() {
					// Récupération du formulaire
					var lFormat = $(this).find(':input[name=format]:checked').val();
					
					var lParam = new ExportBonLivraisonVO();
					//lParam.pParam = 1;
					//lParam.export_type = 1;
					lParam.id_commande = that.mIdCommande;
					lParam.format = lFormat;
					lParam.fonction = "export";
					
					// Test des erreurs
					var lValid = new ExportBonLivraisonValid();
					var lVr = lValid.validAjout(lParam);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Affichage
						$.download("./index.php?m=GestionCommande&v=BonDeLivraison", lParam);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }
		});
	}
		
	this.dialogEnregistrer = function() {	
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogEnregistrement;
		
		$(lTemplate).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Enregistrer': function() {
					that.enregistrer();
					$(this).dialog('close');
				},
				'Annuler': function() {
					if(that.mSuiteEdition == 1) {
						$('#select-prdt').selectOptions(that.mIdCompteProducteur);
					}
					$(this).dialog('close');
				},
				'Ne pas Enregistrer': function() {
					that.mEtatEdition = false;
					if(that.mSuiteEdition == 1) {
						that.changementProducteur();
					} else if (that.mSuiteEdition == 2) {
						that.changementProducteur();
						that.dialogExportBonDeLivraison();
					}
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	}
	
	this.construct(pParam);
};function InfoCommandeArchiveVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = 'afficherCommande';
		$.post(	"./index.php?m=GestionCommande&v=InfoCommandeArchive", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(lResponse) {		
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.infoCommandeArchive;
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		var lTotal = 0;
		var lTotalSolidaire = 0;
		
		$(lResponse.infoCommande).each(function() {
			
			if(this.stoQuantite == null) { this.stoQuantite = 0}
			if(this.opeMontant == null) { this.opeMontant = 0 }
			if(this.stoQuantiteLivraison == null) { this.stoQuantiteLivraison = 0 }
			if(this.opeMontantLivraison == null) { this.opeMontantLivraison = 0 }
			if(this.stoQuantiteSolidaire == null) { this.stoQuantiteSolidaire = 0 }
			if(this.stoQuantiteVente == null) { this.stoQuantiteVente = 0 }
			if(this.opeMontantVente == null) { this.opeMontantVente = 0 }
			if(this.stoQuantiteVenteSolidaire == null) { this.stoQuantiteVenteSolidaire = 0 }
			if(this.opeMontantVenteSolidaire == null) { this.opeMontantVenteSolidaire = 0 }
			
			lTotal -= parseFloat(this.opeMontantLivraison);
			lTotal += parseFloat(this.opeMontantVente);
			lTotalSolidaire += parseFloat(this.opeMontantVenteSolidaire);
			
			this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
			this.opeMontant = this.opeMontant.nombreFormate(2,',',' ');
			this.stoQuantiteLivraison = this.stoQuantiteLivraison.nombreFormate(2,',',' ');
			this.opeMontantLivraison = this.opeMontantLivraison.nombreFormate(2,',',' ');
			this.stoQuantiteSolidaire = this.stoQuantiteSolidaire.nombreFormate(2,',',' ');
			this.stoQuantiteVente = this.stoQuantiteVente.nombreFormate(2,',',' ');
			this.opeMontantVente = this.opeMontantVente.nombreFormate(2,',',' ');
			this.stoQuantiteVenteSolidaire = this.stoQuantiteVenteSolidaire.nombreFormate(2,',',' ');
			this.opeMontantVenteSolidaire = this.opeMontantVenteSolidaire.nombreFormate(2,',',' ');
		});
		
		lResponse.total = lTotal.nombreFormate(2,',',' ');
		lResponse.totalSolidaire = lTotalSolidaire.nombreFormate(2,',',' ');
		lResponse.numero = lResponse.detailMarche.numero;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
	}
	
	this.affect = function(pData) {
	//	pData = this.affectLienListeCommandeArchive(pData);
	//	pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	/*this.affectLienListeCommandeArchive = function(pData) {
		pData.find('#lien-marche-encours').click(function() {
			GestionListeCommandeVue();
		});
		return pData;
	}*/
	
	this.construct(pParam);
};function AchatAdherentVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mAdherent = null;
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = [];
	this.achats = [];
	this.achatsSolidaire = [];
	this.infoReservation = {};
	this.stockSolidaire = [];
	this.pParam = {};

	this.construct = function(pParam) {
		var that = this;
		this.pParam = pParam;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mAdherent = lResponse.adherent;						

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
						
						that.infoReservation = lResponse.reservation;
						that.stockSolidaire = lResponse.stockSolidaire;
						$.each(that.pdtCommande,function() {
							if(this.id) {
								var lIdProduit = this.id;
								$.each(this.lots, function() {
									if(this.id) {
										var lIdLot = this.id;
										$(lResponse.reservation.detailReservation).each(function() {
											if(this.idDetailCommande == lIdLot) {
												this.stoQuantite = this.quantite * -1;
												this.dcomId = this.idDetailCommande;
												this.proId = lIdProduit;
												this.montant = this.montant * -1;
												that.reservation[lIdProduit] = this;
											}											
										});
									}
								});
							}
						});
				
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.detailAchatEtReservation;
		
		var lData = {};		
		lData.adhId = this.mAdherent.adhId;
		lData.adhNumero = this.mAdherent.adhNumero;
		lData.adhCompte = this.mAdherent.cptLabel;
		lData.adhNom = this.mAdherent.adhNom;
		lData.adhPrenom = this.mAdherent.adhPrenom;
		lData.adhSolde = this.mAdherent.cptSolde.nombreFormate(2,',',' ');
		
		lData.sigleMonetaire = gSigleMonetaire;
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		
		lData.totalReservation = (this.infoReservation.total * -1).nombreFormate(2,',',' ');
		lData.reservation = [];

		var lPdtAchat = false; // Pour n'afficher le formulaire achat uniquement si il y a des produits
		$.each(this.pdtCommande,function() {
			lPdtAchat = true;
			
			var lIdProduit = this.id;
			var lPdt = {};
			lPdt.id = this.id;
			lPdt.nproNom = this.nom;
			lPdt.proUniteMesure = this.unite;
			
			lPdt.prix = 0;
			lPdt.stoQuantite = 0;
						
			if(that.reservation[lIdProduit]) {
				lPdt.stoQuantite = parseFloat(that.reservation[lIdProduit].stoQuantite);
				lPdt.prix = parseFloat(that.reservation[lIdProduit].montant);
			}

			lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
			lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
			
			lData.reservation.push(lPdt);
		});	


		lData.achats = [];
		lData.achatsSolidaire = [];

		var lNbAchat = 0;
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
									lNbAchat++;
									lAchatClassique = true;
								}
							});
						}
					});

					lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
					lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
					lDataPdtAchat.push(lPdt);
				}
			});
			
			if(lAchatClassique) {
				var lDataAchat = {	achat:lDataPdtAchat,
									idAchat:this.id.idAchat,
									total:(this.total * -1).nombreFormate(2,',',' ')};
				lData.achats.push(lDataAchat);
			}
		});

		if(lNbAchat == 0 && lPdtAchat ) {
			var lDataPdtAchat = [];
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lIdProduit = this.id;
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					lPdt.stoQuantite = "0".nombreFormate(2,',',' ');		
					lPdt.prix = "0".nombreFormate(2,',',' ');
					lDataPdtAchat.push(lPdt);
				}
			});
			var lDataAchat = {	achat:lDataPdtAchat,idAchat:"-1",total:"0".nombreFormate(2,',',' ')};
			lData.achats.push(lDataAchat);
		}

		var lNbAchatSolidaire = 0;
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
											lNbAchatSolidaire++;
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
						lDataPdtAchat.push(lPdt);
					}
				}
			});
			if(lAchatSolidaire) {
				var lDataAchat = {	achat:lDataPdtAchat,
									idAchat:this.id.idAchat,
									totalSolidaire:(this.totalSolidaire * -1).nombreFormate(2,',',' ')};
				lData.achatsSolidaire.push(lDataAchat);
			}
		});
		
		if(lNbAchatSolidaire == 0 && pResponse.stockSolidaire.length > 0 && pResponse.stockSolidaire[0].proId != null) {
			var lDataPdtAchat = [];
			$.each(that.pdtCommande,function() {
				if(this.id) {
					var lIdProduit = this.id;
					var lPdt = {};
					lPdt.id = this.id;
					lPdt.nproNom = this.nom;
					lPdt.proUniteMesure = this.unite;
					lPdt.stoQuantite = "0".nombreFormate(2,',',' ');		
					lPdt.prix = "0".nombreFormate(2,',',' ');
					
					$(pResponse.stockSolidaire).each(function() {
						if(lPdt.id == this.proId){							
							lDataPdtAchat.push(lPdt);
						}
					});
				}
			});
			var lDataAchat = {	achat:lDataPdtAchat,idAchat:"-2",totalSolidaire:"0".nombreFormate(2,',',' ')};
			lData.achatsSolidaire.push(lDataAchat);
		}

		lData.typeEtatReservation = [];

		var lEtatReservation = {};
		lEtatReservation.value = "-1";
		lEtatReservation.label = "Aucune Réservation";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[-1] = lEtatReservation;
		
		var lEtatReservation = {};
		lEtatReservation.value = "0";
		lEtatReservation.label = "En réservation";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[0] = lEtatReservation;
		
		var lEtatReservation = {};
		lEtatReservation.value = "7";
		lEtatReservation.label = "Achetée";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[7] = lEtatReservation;
		
		var lEtatReservation = {};
		lEtatReservation.value = "15";
		lEtatReservation.label = "Non Récupérée";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[15] = lEtatReservation;
		
		var lEtatReservation = {};
		lEtatReservation.value = "16";
		lEtatReservation.label = "Supprimée";
		lEtatReservation.selected = "";
		lData.typeEtatReservation[16] = lEtatReservation;
		
		switch(this.infoReservation.etat) {
			case "0":
				lData.etatReservation = "En réservation";
				lData.typeEtatReservation[0].selected = "selected=\"selected\"";
				break;
			case "7":
				lData.etatReservation = "Achetée";
				lData.typeEtatReservation[7].selected = "selected=\"selected\"";
				break;
			case "15":
				lData.etatReservation = "Non Récupérée";
				lData.typeEtatReservation[15].selected = "selected=\"selected\"";
				break;
			case "16":
				lData.etatReservation = "Supprimée";
				lData.typeEtatReservation[16].selected = "selected=\"selected\"";
				break;
			default:
				lData.etatReservation = "Aucune Réservation";
				lData.typeEtatReservation[-1].selected = "selected=\"selected\"";
				break;
		}

		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	}
	
	this.affect = function(pData) {
		pData = this.affectAnnulerDetailReservation(pData);
		pData = this.affectModifierReservation(pData);
		pData = this.affectValiderModifierReservation(pData);
		pData = this.affectModifierAchat(pData);
		pData = this.affectSupprimerAchat(pData);
		pData = this.mCommunVue.comHoverBtn(pData);		
		pData = this.mCommunVue.comNumeric(pData);
		return pData;
	}
	
	this.affectAnnulerDetailReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {
			EditerCommandeVue({"id_commande":that.infoCommande.comId});		
		});
		return pData;
	}
	
	this.affectModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-modif-resa').click(function() {
			that.modifierReservation();
		});
		return pData;
	}
	
	this.affectValiderModifierReservation = function(pData) {
		var that = this;
		pData.find('#btn-check-resa').click(function() {
			that.validerModifierReservation();
		});
		return pData;
	}
	
	this.affectSupprimerAchat = function(pData) {
		var that = this;
		pData.find('.achat, .achatSolidaire').each(function() {
			var lIdAchat = $(this).find(".achat-id").text();
			pData.find("#btn-supp-achat-" + lIdAchat).click(function() {
				that.supprimerAchat(lIdAchat);
			});
		});
		return pData;
	}
	
	this.affectModifierAchat = function(pData) {
		var that = this;
		pData.find('.achat, .achatSolidaire').each(function() {
			var lIdAchat = $(this).find(".achat-id").text();
			pData.find("#btn-modif-achat-" + lIdAchat).click(function() {
				that.modifierAchat(lIdAchat);
			});
			pData.find("#btn-check-achat-" + lIdAchat).click(function() {
				that.validerModifierAchat(lIdAchat);
			});
		});
		return pData;
	}
	
	this.modifierReservation = function() {
		$('.modif-resa, .resa-etat, .detail-resa-prix, .detail-resa-qte, .resa-total').toggle();	
	}
	
	this.validerModifierReservation = function() {
		var lReservation = {};
		lReservation.total = $("#reservation-total").val().numberFrToDb();
		lReservation.etat = $("#reservation-etat").val();
		lReservation.produits = [];
		var lProduit = [];
		$('.ligne-produit-reservation').each(function() {
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
				lReservation.produits.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0) {
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lReservation.produits.push(lVoProduit);
				}
			}
			lProduit.push(lVoProduit);
		});
		
		lReservation.id = this.infoReservation.id;
		
		var lValid = new ReservationAdherentValid();
		var lVr = lValid.validUpdate(lReservation);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			// TODO envoi vers le server
			
			
			$(lProduit).each(function() {
				if(isNaN(this.quantite) || this.quantite.isEmpty()) {this.quantite = 0;}
				$("#reservation-" + this.id + "-quantite").text((this.quantite * -1).nombreFormate(2,',',' '));
				if(isNaN(this.prix) || this.quantite.isEmpty()) {this.prix = 0;}
				$("#reservation-" + this.id + "-prix").text((this.prix * -1).nombreFormate(2,',',' '));
			});
			
			switch(lReservation.etat) {
				case "0":
					$("#reservation-etat-label").text("En réservation");
					break;
				case "7":
					$("#reservation-etat-label").text("Achetée");
					break;
				case "15":
					$("#reservation-etat-label").text("Non Récupérée");
					break;
				case "16":
					$("#reservation-etat-label").text("Supprimée");
					break;
				default:
					$("#reservation-etat-label").text("Aucune Réservation");
					break;
			}
	
			if(isNaN(lReservation.total) || lReservation.total.isEmpty()) {lReservation.total = 0;}
			$("#reservation-total-label").text(lReservation.total.nombreFormate(2,',',' '));
			
			
			$('.modif-resa, .resa-etat, .detail-resa-prix, .detail-resa-qte, .resa-total').toggle();
		} else {
			Infobulle.generer(lVr,'reservation-');
		}
	}
	
	this.modifierAchat = function(pIdAchat) {
		$('.modif-achat-' + pIdAchat + ', .detail-achat-' + pIdAchat + '-prix, .detail-achat-' + pIdAchat + '-qte, .achat-' + pIdAchat + '-total').toggle();	
	}
	
	this.validerModifierAchat = function(pIdAchat) {
		var that = this;
		var lAchat = {};
		lAchat.idAchat = pIdAchat;
		lAchat.total = $("#achat-" + pIdAchat + "-total").val().numberFrToDb() * -1;
		lAchat.produits = [];
		var lProduit = [];
		$('.ligne-produit-achat-' + pIdAchat).each(function() {
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
				lAchat.produits.push(lVoProduit);
			} else {
				var lprix = $(this).find(".produit-prix").val().numberFrToDb();
				if(!isNaN(lprix) && !lprix.isEmpty() && lprix != 0) {
					lprix = parseFloat(lprix);
					lVoProduit.prix = lprix * -1;
					lAchat.produits.push(lVoProduit);
				}
			}
			lProduit.push(lVoProduit);
		});
		
		if(parseInt(pIdAchat) < 0) { // Si c'est un achat
			lAchat.idCompte = that.mAdherent.adhIdCompte;
			lAchat.idMarche = that.pParam.id_commande;
		}
		
		var lValid = new AchatAdherentValid();
		var lVr = lValid.validUpdate(lAchat);
		
		Infobulle.init(); // Supprime les erreurs
		if(lVr.valid) {
			var lParam ={fonction:"modifierAchat",achat:lAchat};
			$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse && lResponse.valid) {
						var lMsg = new TemplateVR();
						lMsg.valid = false;
						lMsg.log.valid = false;
						var erreur = new VRerreur();
						erreur.code = ERR_314_CODE;
						erreur.message = ERR_314_MSG;
						lMsg.log.erreurs.push(erreur);
						
						if(lAchat.idAchat < 0) {
							that.pParam.vr = lMsg;
							that.construct(that.pParam);
						} else {
							$(lProduit).each(function() {
								if(isNaN(this.quantite) || this.quantite.isEmpty()) {this.quantite = 0;}
								$("#achat-" + pIdAchat + "-" + this.id + "-quantite").text((this.quantite * -1).nombreFormate(2,',',' '));
								if(isNaN(this.prix) || this.prix.isEmpty()) {this.prix = 0;}
								$("#achat-" + pIdAchat + "-" + this.id + "-prix").text((this.prix * -1).nombreFormate(2,',',' '));
							});
							if(isNaN(lAchat.total) || lAchat.total.isEmpty()) {lAchat.total = 0;}
							$("#achat-" + pIdAchat + "-total-label").text((lAchat.total * -1).nombreFormate(2,',',' '));
							
							$('.modif-achat-' + pIdAchat + ', .detail-achat-' + pIdAchat + '-prix, .detail-achat-' + pIdAchat + '-qte, .achat-' + pIdAchat + '-total').toggle();						
							
							Infobulle.generer(lMsg,'');
						}
					} else {
						Infobulle.generer(lResponse,'');
					}
			},"json");
		} else {
			Infobulle.generer(lVr,'achat-' + pIdAchat + '-');
		}
	}
	
	this.supprimerAchat = function(pIdAchat) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogSupprimerAchat;
		
		$(lTemplate).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Supprimer': function() {
					var lDialog = this;
					var lParam ={fonction:"supprimerAchat",idAchat:pIdAchat};
					$.post(	"./index.php?m=GestionCommande&v=AchatAdherent", "pParam=" + $.toJSON(lParam),
						function(lResponse) {
							Infobulle.init(); // Supprime les erreurs
							if(lResponse && lResponse.valid) {								
								var lMsg = new TemplateVR();
								lMsg.valid = false;
								lMsg.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_315_CODE;
								erreur.message = ERR_315_MSG;
								lMsg.log.erreurs.push(erreur);
								
								that.pParam.vr = lMsg;
								
								that.construct(that.pParam);
								$(lDialog).dialog('close');
							} else {
								Infobulle.generer(lResponse,'');
							}
					},"json");
			
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
		});
		
	}
	
	this.construct(pParam);
};function BonDeCommandeVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdCommande = null;
	this.mComNumero = null;
	this.mEtatEdition = false;
	this.mListeProduit = [];
	this.mSuiteEdition = 0;
	this.mIdCompteProducteur = 0;
	
	this.construct = function(pParam) {
		var that = this;
		//pParam.export_type = 0;
		pParam.fonction = "afficher";
		$.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mEtatEdition = false;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.bonDeCommande;
		
		this.mIdCommande = pResponse.producteurs[0].proIdCommande;
		this.mComNumero = pResponse.comNumero;
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse))));	
	}
	
	this.affect = function(pData) {
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectBtnRetourMarche(pData);
		pData = this.affectChangementProducteur(pData);
		pData = this.affectExportBonCommande(pData);
		return pData;
	}
	
	this.affectBtnRetourMarche = function(pData) {
		var that = this;
		pData.find('#btn-editer-com').click(function() {
			EditerCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectChangementProducteur = function(pData) {
		var that = this;
		pData.find('#select-prdt').change(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 1;
				that.dialogEnregistrer();
			} else {
				that.changementProducteur();
			}
		});
		return pData;
	}
	
	this.changementProducteur = function() {
		var that = this;
		var lIdCompteProducteur = $('#select-prdt').val();
		if(lIdCompteProducteur > 0) {
			var lParam = {	"id_commande":that.mIdCommande,
						 	"id_compte_producteur":lIdCompteProducteur,
						 	fonction:"afficherProducteur"}
			$.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mIdCompteProducteur = lIdCompteProducteur;
							that.mEtatEdition = false;
							
							$(lResponse.produits).each(function() {
								that.mListeProduit[this.proId] = this.stoQuantite;
								
								this.stoQuantiteCommande = '';
								this.dopeMontant = '';
								
								var lProId = this.proId;
								var these = this;
								
								$(lResponse.produitsCommande).each(function() {
									if(this.proId == lProId) {
										these.stoQuantiteCommande = this.stoQuantite;
										these.dopeMontant = this.dopeMontant.nombreFormate(2,',',' ');
									}
								});
								
								if(this.stoQuantiteCommande - this.stoQuantite < 0) {
									this.classEtat = 'qte-reservation-ko';
								} else {
									this.classEtat = 'qte-reservation-ok';
								}
								if(this.stoQuantiteCommande != '') {
									this.stoQuantiteCommande = this.stoQuantiteCommande.nombreFormate(2,',',' ');
								}
								this.stoQuantite = this.stoQuantite.nombreFormate(2,',',' ');
							});	
							
							lResponse.sigleMonetaire = gSigleMonetaire;
							
							var lGestionCommandeTemplate = new GestionCommandeTemplate();
							var lTemplate = lGestionCommandeTemplate.listeProduitBonDeCommande;
							
							$('#liste-pdt').replaceWith(that.affectListeProduit($(lTemplate.template(lResponse))));
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		} else {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.listeProduitVide;
			$('#liste-pdt').replaceWith(lTemplate);
		}
	}
	
	this.affectListeProduit = function(pData) {
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectEtatCommande(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectEnregistrer(pData);
		return pData;
	}
	
	this.affectEtatCommande = function(pData) {
		var that = this;
		pData.find(":input").keyup(function() {
			that.mEtatEdition = true;
			var lIdProduit = $(this).prev(".pro-id").text();
			if(that.mListeProduit[lIdProduit]) {
				if($(this).val().numberFrToDb()- that.mListeProduit[lIdProduit] < 0) {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ok')
						.addClass('qte-reservation-ko');
				} else {
					$("#etat-commande-" + lIdProduit)
						.removeClass('qte-reservation-ko')
						.addClass('qte-reservation-ok');
				}
			}
		});
		return pData;
	}
	
	this.affectEnregistrer = function(pData) {
		var that = this;
		pData.find("#btn-enregistrer").click(function() {
			that.mSuiteEdition = 0;
			that.enregistrer();
		});
		pData.find(".qte-commande ,.prix-commande ").keyup(function(event) {
			if (event.keyCode == '13') {
				that.mSuiteEdition = 0;
				that.enregistrer();
			}			
		});
		return pData;
	}
	
	this.enregistrer = function() {
		var that = this;
		
		var lParam = new ProduitsBonDeCommandeVO();
		
		lParam.id_commande = this.mIdCommande;
		lParam.id_compte_producteur = this.mIdCompteProducteur;
		lParam.export_type = 0;

		$('.pro-id').each(function() {
			var lId = $(this).text();				
			var lProduit = new ProduitBonDeCommandeVO();
			lProduit = {id:lId,
						quantite:$(':input[name=qte-commande-' + lId + ']').val().numberFrToDb(),
						prix:$(':input[name=prix-commande-' + lId + ']').val().numberFrToDb()
						};				
			lParam.produits.push(lProduit);
		});		
		
		var lValid = new ProduitsBonDeCommandeValid();
		var lVr = lValid.validAjout(lParam);
		
		if(lVr.valid) {
			lParam.fonction = "enregistrer";
			return $.post(	"./index.php?m=GestionCommande&v=BonDeCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {
							that.mEtatEdition = false;
							
							if(that.mSuiteEdition == 1) {
								that.changementProducteur();
							} else if (that.mSuiteEdition == 2) {
								that.dialogExportBonDeCommande();
							} else {
								var lVr = new TemplateVR();
								lVr.valid = false;
								lVr.log.valid = false;
								var erreur = new VRerreur();
								erreur.code = ERR_301_CODE;
								erreur.message = ERR_301_MSG;
								lVr.log.erreurs.push(erreur);							
								
								Infobulle.generer(lVr,'');
							}
						} else {
							Infobulle.generer(lResponse,'');
							$('#select-prdt').selectOptions(that.mIdCompteProducteur);
						}
					},"json"
			);
			
		} else {
			Infobulle.generer(lVr,'');
			$('#select-prdt').selectOptions(that.mIdCompteProducteur);
		}
	}
	
	this.affectExportBonCommande = function(pData) {
		var that = this;	
		pData.find('#btn-export-bcom')
		.click(function() {
			if(that.mEtatEdition) {
				that.mSuiteEdition = 2;
				that.dialogEnregistrer();
			} else {
				that.dialogExportBonDeCommande();				
			}			
		});
		return pData;
	}
	
	this.dialogExportBonDeCommande = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogExportBonDeCommande;
		$(lTemplate.template({comNumero:that.mComNumero})).dialog({
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Exporter': function() {
					// Récupération du formulaire
					var lFormat = $(this).find(':input[name=format]:checked').val();
					
					var lParam = new ExportBonReservationVO();
					lParam.id_commande = that.mIdCommande;
					lParam.format = lFormat;
					lParam.fonction = "export";
					
					// Test des erreurs
					var lValid = new ExportBonReservationValid();
					var lVr = lValid.validAjout(lParam);
					
					Infobulle.init(); // Supprime les erreurs
					if(lVr.valid) {
						// Affichage
						$.download("./index.php?m=GestionCommande&v=BonDeCommande", lParam);
					} else {
						Infobulle.generer(lVr,'');
					}
				},
				'Annuler': function() {
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }
		});
	}
	
	this.dialogEnregistrer = function() {	
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.dialogEnregistrement;
		
		$(lTemplate).dialog({			
			autoOpen: true,
			modal: true,
			draggable: false,
			resizable: false,
			width:600,
			buttons: {
				'Enregistrer': function() {
					that.enregistrer();
					$(this).dialog('close');
				},
				'Annuler': function() {
					if(that.mSuiteEdition == 1) {
						$('#select-prdt').selectOptions(that.mIdCompteProducteur);
					}
					$(this).dialog('close');
				},
				'Ne pas Enregistrer': function() {
					that.mEtatEdition = false;
					if(that.mSuiteEdition == 1) {
						that.changementProducteur();
					} else if (that.mSuiteEdition == 2) {
						that.changementProducteur();
						that.dialogExportBonDeCommande();
					}
					$(this).dialog('close');
				}
			},
			close: function(ev, ui) { $(this).remove(); Infobulle.init(); }				
		});
	}
	
	this.construct(pParam);
};function ReservationAdherentVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mAdherent = null;
	this.infoCommande = new Object();
	this.pdtCommande = new Array();
	this.reservation = new Array();
	this.reservationModif = new Array();
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = "afficherReservation";
		$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mAdherent = lResponse.adherent;						

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
						/*$(lResponse.commande).each(function() {
							var lLot = new Object();
							
							lLot.dcomId = this.dcomId;
							lLot.dcomIdProduit = this.dcomIdProduit;
							lLot.dcomTaille = this.dcomTaille;
							lLot.dcomPrix = this.dcomPrix;
							
							if(that.pdtCommande[this.proId]) {
								that.pdtCommande[this.proId].lot[lLot.dcomId] = lLot;
							} else {			
								var lproduit = new Object();
								lproduit.proId = this.proId;
								lproduit.proUniteMesure = this.proUniteMesure;
								lproduit.proMaxProduitCommande = this.proMaxProduitCommande;
								
								$(lResponse.stock).each(function() { 
									if(this.proId == lproduit.proId) {
										if(parseFloat(this.stoQuantite) < parseFloat(lproduit.proMaxProduitCommande)) {
											 lproduit.proMaxProduitCommande = this.stoQuantite;
										}
									}
								});

								lproduit.nproNom = this.nproNom;
								lproduit.nproDescription = this.nproDescription;
								lproduit.nproIdCategorie = this.nproIdCategorie;
								
								lproduit.lot = new Array();
								lproduit.lot[lLot.dcomId] = lLot;								
								that.pdtCommande[lproduit.proId] = lproduit;
							}
						});
						
						$(lResponse.reservation).each(function() {
							this.stoQuantite = this.stoQuantite * -1;
							that.reservation[this.proId] = this;
						});	*/					
						that.afficher();
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function() {		
		this.afficherDetailReservation();		
	}
	
	this.afficherDetailReservation = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.detailReservation;
		
		var lData = {};		
		lData.adhId = this.mAdherent.adhId;
		lData.adhNumero = this.mAdherent.adhNumero;
		lData.adhCompte = this.mAdherent.cptLabel;
		lData.adhNom = this.mAdherent.adhNom;
		lData.adhPrenom = this.mAdherent.adhPrenom;
		lData.adhSolde = this.mAdherent.cptSolde.nombreFormate(2,',',' ');
		
		lData.sigleMonetaire = gSigleMonetaire;
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		lData.reservation = new Array();
		/*var lTotal = 0;
		$(this.pdtCommande).each(function() {
			if(that.reservation[this.proId]) {
				var lPdt = new Object;
				lPdt.nproNom = this.nproNom;
				lPdt.stoQuantite = parseFloat(that.reservation[this.proId].stoQuantite);
				lPdt.proUniteMesure = this.proUniteMesure;
				lPdt.prix = 0;
				var lDcomId = that.reservation[this.proId].dcomId;
				
				$(this.lot).each(function() {
					if(this.dcomId == lDcomId) {
						lPdt.prix = (lPdt.stoQuantite / this.dcomTaille) * this.dcomPrix;
					}
				});
				lTotal += lPdt.prix;
				
				lPdt.stoQuantite = lPdt.stoQuantite.nombreFormate(2,',',' ');		
				lPdt.prix = lPdt.prix.nombreFormate(2,',',' ');
				
				lData.reservation.push(lPdt);
			}			
		});
		lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
		*/
		
		var lTotal = 0;
		$.each(this.pdtCommande, function() {
			if(that.reservation[this.id]) {
				var lPdt = new Object;
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
				
				lData.reservation.push(lPdt);
			}			
		});
		lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
		
		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lData))));		
	}
	
	this.afficherModifier = function() {
		var that = this;
		var lGestionCommandeTemplate = new GestionCommandeTemplate();
		var lTemplate = lGestionCommandeTemplate.modifierReservation;
		var lData = {};
		lData.adhId = this.mAdherent.adhId;
		lData.adhNumero = this.mAdherent.adhNumero;
		lData.adhCompte = this.mAdherent.cptLabel;
		lData.adhNom = this.mAdherent.adhNom;
		lData.adhPrenom = this.mAdherent.adhPrenom;
		lData.adhSolde = this.mAdherent.cptSolde.nombreFormate(2,',',' ');
		lData.adhNouveauSolde = 0;
		lData.sigleMonetaire = gSigleMonetaire;
		lData.comNumero = this.infoCommande.comNumero;
		lData.dateFinReservation = this.infoCommande.dateFinReservation;
		lData.heureFinReservation = this.infoCommande.heureFinReservation;
		lData.minuteFinReservation = this.infoCommande.minuteFinReservation;
		lData.dateMarcheDebut = this.infoCommande.dateMarcheDebut;
		lData.heureMarcheDebut = this.infoCommande.heureMarcheDebut;
		lData.minuteMarcheDebut = this.infoCommande.minuteMarcheDebut;
		lData.heureMarcheFin = this.infoCommande.heureMarcheFin;
		lData.minuteMarcheFin = this.infoCommande.minuteMarcheFin;
		lData.produit = new Array();
				
		/*var lTotal = 0;		
		$(this.pdtCommande).each(function() {
			// Test si la ligne n'est pas vide
			if(this.proId) {
				var lPdt = {};
				lPdt.proId = this.proId;
				lPdt.nproNom = this.nproNom;
				lPdt.proMaxProduitCommande = parseFloat(this.proMaxProduitCommande).nombreFormate(2,',',' ');
				lPdt.proUniteMesure = this.proUniteMesure;
				
				lPdt.lot = new Array();
				
				var i = 0;
				var lLotReservation = -1;
				var lLotInit = -1;
				
				
				$(this.lot).each(function() {
					if(this.dcomId) {
						var lLot = {};
						lLot.dcomId = this.dcomId;
						lLot.dcomTaille = parseFloat(this.dcomTaille).nombreFormate(2,',',' ');
						lLot.dcomPrix = parseFloat(this.dcomPrix).nombreFormate(2,',',' ');
						lLot.prixReservation = parseFloat(this.dcomPrix);
						lLot.stoQuantiteReservation = parseFloat(this.dcomTaille);
						
						if(that.reservation[lPdt.proId] && (that.reservation[lPdt.proId].dcomId == this.dcomId)) {
								lLot.stoQuantiteReservation = parseFloat(that.reservation[lPdt.proId].stoQuantite);
								lLot.prixReservation = (lLot.stoQuantiteReservation / this.dcomTaille) * this.dcomPrix;
								lTotal += lLot.prixReservation;
								
								// Permet de cocher le lot correspondant à la résa
								lLotReservation = this.dcomId;
								lLot.checked = 'checked="checked"';
						}
						lPdt.prixUnitaire = (lLot.prixReservation / lLot.stoQuantiteReservation).nombreFormate(2,',',' '); 						
						lLot.stoQuantiteReservation = lLot.stoQuantiteReservation.nombreFormate(2,',',' ');
						lLot.prixReservation = lLot.prixReservation.nombreFormate(2,',',' ');
						
						lPdt.lot.push(lLot);			
					}
				});
				
				lData.total = parseFloat(lTotal).nombreFormate(2,',',' ');
				
				// Si il y a une réservation pour ce produit on le coche
				if(lLotReservation != -1) {
					lPdt.checked = 'checked="checked"';
				} else {
					// Sinon on coche par défaut le premier lot
					if(lPdt.lot[0]) {
						lPdt.lot[0].checked = 'checked="checked"';
					}
				}
				
				lData.produit.push(lPdt);			
			}
		});
		
		// Maj des reservations temp pour modif
		this.reservationModif = new Array();
		$(this.reservation).each(function() {
			if(this.proId) {
				//var lR = {comId:this.comId,proId:this.proId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};				
				that.reservationModif[this.proId] = {comId:this.comId,proId:this.proId,dcomId:this.dcomId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};
			}
		});*/
		
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
				
				if(parseFloat(lPdt.proMaxProduitCommande) < parseFloat(lPdt.stock)) {
					lPdt.max = lPdt.proMaxProduitCommande;
				} else {
					lPdt.max = lPdt.stock;
				}
				
				lPdt.lot = new Array();
				
				var i = 0;
				var lLotReservation = -1;
				var lLotInit = -1;
				
				$.each(this.lots, function() {
					if(this.id) {
						if(parseFloat(this.taille) <= lPdt.max) {
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
				lData.produit.push(lPdt);
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
	}
	
	this.affect = function(pData) {
		pData = this.affectModifierReservation(pData);
		pData = this.affectAnnulerDetailReservation(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectSupprimerReservation(pData);		
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
		pData = this.mCommunVue.comHoverBtn(pData);
		pData = this.affectNouveauSolde(pData);
		pData = this.affectInitLot(pData);
		pData = this.masquerIndisponible(pData);
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
	/*this.affectBtnQte = function(pData) {
		var that = this;
		pData.find('.btn-plus').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),1);
		});	
		pData.find('.btn-moins').click(function() {
			that.nouvelleQuantite($(this).parent().parent().find(".pdt-id").text(),$(this).parent().parent().find(".lot-id").text(),-1);
		});
		return pData;		
	}*/
	
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
	/*this.affectChangementLot = function(pData) {
		var that = this;
		pData.find('.lot').click(function() {
			$(this).find(':radio').attr("checked","checked");
			that.changerLot($(this).find(".pdt-id").text(),$(this).find(".lot-id").text());
		});
		return pData;
	}
	
	this.affectChangementProduit = function(pData) {
		var that = this;
		pData.find('.pdt :checkbox').click(function() {
			that.changerProduit($(this).parent().parent().find(".pdt-id").text());			
		});
		return pData;
	}*/
	
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
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.produitIndisponible;
			var lData = {nom:$(this).parents(".pdt").find(".nom-pro").text()};			
			$(this).parents(".pdt").before(lTemplate.template(lData));
			$(this).parents(".pdt").remove();
		});
		return pData;
	}
	
	this.affectAnnulerDetailReservation = function(pData) {
		var that = this;
		pData.find('#btn-annuler').click(function() {
			EditerCommandeVue({"id_commande":that.infoCommande.comId});		
		});
		return pData;
	}
	
	this.affectInitLot = function(pData) {
		var that = this;
		pData.find('.pdt select').each(function() {
			var lIdPdt = $(this).parent().parent().find(".pdt-id").text();
			var lIdLot = $(this).val();
			/*var lPrix = that.pdtCommande[lIdPdt].lot[lIdLot].dcomPrix;
			var lQte = that.pdtCommande[lIdPdt].lot[lIdLot].dcomTaille;
			var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
			
			$(pData).find('#prix-unitaire-' + lIdPdt).text(lprixUnitaire);*/
			
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
		/*var lMax = this.pdtCommande[pIdPdt].proMaxProduitCommande;
		var lTaille = this.pdtCommande[pIdPdt].lot[pIdLot].dcomTaille;
		var lPrix = this.pdtCommande[pIdPdt].lot[pIdLot].dcomPrix;*/
		
		// La quantité max soit qte max soit stock
		var lMax = parseFloat(this.pdtCommande[pIdPdt].qteMaxCommande);
		
		// Recherche de la quantité reservée pour la déduire de la quantité max
		if(this.reservationModif[pIdPdt]) {
			var lStock = parseFloat(this.pdtCommande[pIdPdt].stockReservation) + parseFloat(this.reservationModif[pIdPdt].stoQuantite);						
		} else {
			var lStock = parseFloat(this.pdtCommande[pIdPdt].stockReservation);
		}
		if(parseFloat(lStock) < parseFloat(lMax)) { lMax = lStock; }
		
		var lTaille = this.pdtCommande[pIdPdt].lots[pIdLot].taille;
		var lPrix = this.pdtCommande[pIdPdt].lots[pIdLot].prix;

		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservationModif[pIdPdt] && (this.reservationModif[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = parseFloat(this.reservationModif[pIdPdt].stoQuantite)/parseFloat(lTaille);
			//lQteReservation = this.reservationModif[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;
		
		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNvQteReservation > 0 && lNvQteReservation <= lMax) {
			var lNvPrix = 0;
			lNvPrix = lQteReservation * lPrix;
			
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
	/*this.nouvelleQuantite = function(pIdPdt,pIdLot,pIncrement) {
		var lMax = this.pdtCommande[pIdPdt].proMaxProduitCommande;
		var lTaille = this.pdtCommande[pIdPdt].lot[pIdLot].dcomTaille;
		var lPrix = this.pdtCommande[pIdPdt].lot[pIdLot].dcomPrix;
		
		// Récupère le nombre de lot réservé
		var lQteReservation = 0;
		if(this.reservationModif[pIdPdt] && (this.reservationModif[pIdPdt].dcomId == pIdLot)) {
			lQteReservation = this.reservationModif[pIdPdt].stoQuantite/lTaille;
		}		
		lQteReservation += pIncrement;
		
		var lNvQteReservation = 0;		
		lNvQteReservation = lQteReservation * lTaille;
		
		// Test si la quantité est dans les limites
		if(lNvQteReservation > 0 && lNvQteReservation <= lMax) {
			var lNvPrix = 0;
			lNvPrix = lQteReservation * lPrix;
			
			// Mise à jour de la quantite reservée
			this.reservationModif[pIdPdt].stoQuantite = lNvQteReservation;			
			
			$('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvQteReservation).nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt + '-lot-' + pIdLot).text(parseFloat(lNvPrix).nombreFormate(2,',',' '));		

			this.majTotal();
		}		
	}*/	
	
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
		
		/*var lPrix = this.pdtCommande[pIdPdt].lot[pIdLot].dcomPrix;
		var lQte = this.pdtCommande[pIdPdt].lot[pIdLot].dcomTaille;
		var lprixUnitaire = (lPrix / lQte).nombreFormate(2,',',' '); 						
		
		$('#prix-unitaire-' + pIdPdt).text(lprixUnitaire);
		
		if(this.reservationModif[pIdPdt]) {
			this.reservationModif[pIdPdt].dcomId = pIdLot;
			this.reservationModif[pIdPdt].stoQuantite = lQte;
			$('#qte-pdt-' + pIdPdt).text(lQte.nombreFormate(2,',',' '));
			$('#prix-pdt-' + pIdPdt).text(lPrix.nombreFormate(2,',',' '));
		}
		
		this.majTotal();*/
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
		/*if(this.reservationModif[pIdPdt] != null) {
			$('.resa-pdt-' + pIdPdt).hide();
			$('#qte-pdt-' + pIdPdt).text('');
			$('#prix-pdt-' + pIdPdt).text('');
			this.reservationModif[pIdPdt] = null;
		} else {
			var lIdLot = $('#lot-' + pIdPdt).val();
			var lQte = this.pdtCommande[pIdPdt].lot[lIdLot].dcomTaille;			
			
			var lResa = {};
			lResa.comId = this.infoCommande.comId;
			lResa.proId = pIdPdt;
			lResa.dcomId = lIdLot;
			lResa.stoQuantite = lQte;						
			this.reservationModif[pIdPdt] = lResa;
			
			$('#qte-pdt-' + pIdPdt).text(lQte.nombreFormate(2,',',' '));
			var lPrix = this.pdtCommande[pIdPdt].lot[lIdLot].dcomPrix.nombreFormate(2,',',' ');
			$('#prix-pdt-' + pIdPdt).text(lPrix);
			
			$('.resa-pdt-' + pIdPdt).show();
		}*/
		this.majTotal();
	}
	/*this.changerLot = function(pIdPdt,pIdLot) {		
		// Masque tout les lots
		$('.btn-pdt-' + pIdPdt).attr("disabled","disabled").addClass("ui-helper-hidden");
		$('.colonne-pdt-' + pIdPdt).addClass("ui-helper-hidden");
				
		// Affiche uniquement le lot sélectionné
		$('#btn-moins-lot-' + pIdLot + ',#btn-plus-lot-' + pIdLot).removeAttr("disabled").removeClass("ui-helper-hidden");
		$('#colonne-qte-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-prix-pdt-' + pIdPdt + '-lot-' + pIdLot + ',#colonne-sigle-pdt-' + pIdPdt + '-lot-' + pIdLot).removeClass("ui-helper-hidden");
	
		// Mise à jour de la quantite reservée
		this.reservationModif[pIdPdt].stoQuantite = $('#qte-pdt-' + pIdPdt + '-lot-' + pIdLot).text().numberFrToDb();
		this.reservationModif[pIdPdt].dcomId = pIdLot;
		
		this.majTotal();
	}
	
	this.changerProduit = function(pIdPdt) {
		var that = this;
		if($('#pdt-' + pIdPdt).find(':checkbox').attr("checked")) {
			$('.lot-pdt-' + pIdPdt).show();
			
			// Mise à jour de la quantite reservée
			$('[name=lot-produit-' + pIdPdt + ']').each(function() {
				//alert(this.attr('checked'));
				if($(this).attr('checked')) {
					var lQte = $('#qte-pdt-' + pIdPdt + '-lot-' + $(this).parent().parent().find(".lot-id").text()).text().numberFrToDb();
					if(that.reservationModif[pIdPdt]) {
						that.reservationModif[pIdPdt].stoQuantite = lQte;
					} else {
						var lResa = {};
						lResa.comId = that.infoCommande.comId;
						//lResa.proId = pIdPdt;
						lResa.dcomId = lIdLot;
						lResa.stoQuantite = lQte;						
						that.reservationModif[pIdPdt] = lResa;
					}
				}
			});
		} else {			
			$('.lot-pdt-' + pIdPdt).hide();
			
			// Mise à jour de la quantite reservée
			if(this.reservationModif[pIdPdt]) {
				this.reservationModif[pIdPdt] = null;
			}
		}
		
		this.majTotal();
	}*/
	
	this.majTotal = function() {
		$('#total').text(this.calculTotal().nombreFormate(2,',',' '));
		this.majNouveauSolde();
	}
	
	this.majNouveauSolde = function() {
		var lNvSolde = this.mAdherent.cptSolde - this.calculTotal();
		if(lNvSolde <= 0) {
			$("#nouveau-solde").addClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			$("#nouveau-solde").removeClass("com-nombre-negatif");
			$("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		$("#nouveau-solde").text(lNvSolde.nombreFormate(2,',',' '));
	}
	
	this.affectNouveauSolde = function(pData) {
		var lNvSolde = this.mAdherent.cptSolde - this.calculTotal();
		if(lNvSolde <= 0) {
			pData.find("#nouveau-solde").addClass("com-nombre-negatif");
			pData.find("#nouveau-solde-sigle").addClass("com-nombre-negatif");			
		} else {
			pData.find("#nouveau-solde").removeClass("com-nombre-negatif");
			pData.find("#nouveau-solde-sigle").removeClass("com-nombre-negatif");
		}
		pData.find("#nouveau-solde").text(lNvSolde.nombreFormate(2,',',' '));
		return pData;		
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
		
		/*var that = this;
		var lTotal = 0;
		$(this.reservationModif).each(function() {
			var lResa = this;
			if(lResa.stoQuantite) {
				if(that.pdtCommande[lResa.proId]) {
					$(that.pdtCommande[lResa.proId].lot).each(function() {
						if(lResa.dcomId == this.dcomId) {
							lTotal += (lResa.stoQuantite / this.dcomTaille) * this.dcomPrix;
						}
					});					
				}				
			}
		});
		return lTotal;*/
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
				
				$(pData).find('.resa-pdt-' + lIdPdt).show();
			}
		});
		return pData;
		
		/*var that = this;
		
		$(pData).find('.pdt').each(function() {
			var lIdPdt = $(this).find('.pdt-id').text();
			if(that.reservation[lIdPdt] != null) {
				var lResa = that.reservation[lIdPdt];
				var lIdLot = lResa.dcomId;
				var lQte = lResa.stoQuantite;			
				$(pData).find('#qte-pdt-' + lIdPdt).text(lQte.nombreFormate(2,',',' '));
				
				var lPrix = ((that.pdtCommande[lIdPdt].lot[lIdLot].dcomPrix * lResa.stoQuantite)/that.pdtCommande[lIdPdt].lot[lIdLot].dcomTaille).nombreFormate(2,',',' ');
				$(pData).find('#prix-pdt-' + lIdPdt).text(lPrix);
				$(pData).find('#lot-' + lIdPdt).selectOptions(lIdLot);
				
				$(pData).find('.resa-pdt-' + lIdPdt).show();
			}
		});
		return pData;*/
	}
	/*this.preparerAffichageModifier = function(pData) {
		var that = this;
		// Cache les lots
		pData.find(':checkbox:not(:checked)').each(function() {			
			pData.find('.lot-pdt-' + $(this).parent().parent().find('.pdt-id').text()).hide();
		});
		//Cache les autres lots
		pData.find(':radio:not(:checked)').each(function() {
			var lIdLot = $(this).parent().parent().find('.lot-id').text();
			var lIdPdt = $(this).parent().parent().find('.pdt-id').text();
			
			pData.find('#btn-moins-lot-' + lIdLot + ',#btn-plus-lot-' + lIdLot).attr("disabled","disabled").addClass("ui-helper-hidden");
			pData.find('#colonne-qte-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-prix-pdt-' + lIdPdt + '-lot-' + lIdLot + ',#colonne-sigle-pdt-' + lIdPdt + '-lot-' + lIdLot).addClass("ui-helper-hidden");
		});
		return pData;
	}*/
	
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
				lVo.fonction = "modifierReservation";
				lVo.id_compte = this.mAdherent.adhIdCompte;
				//lParam = {"reservation":lVo,"id_compte":this.mAdherent.adhIdCompte,fonction:"modifierReservation"};
				$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(lVo),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {							
							// Maj des reservations pour le recap
							/*that.reservation = new Array();
							$(that.reservationModif).each(function() {
								if(this.proId) {									
									that.reservation[this.proId] = {comId:this.comId,proId:this.proId,dcomId:this.dcomId,stoId:this.stoId,stoQuantite:this.stoQuantite,stoType:this.stoType,stoIdCompte:this.stoIdCompte};
								}
							});
							that.afficher();*/
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
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.supprimerReservationDialog;
			$(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {	id_commande:that.infoCommande.comId,
										id_compte:that.mAdherent.adhIdCompte,
										fonction:"supprimerReservation"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=ReservationAdherent", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										
										var lVr = new TemplateVR();
										lVr.valid = false;
										lVr.log.valid = false;
										var erreur = new VRerreur();
										erreur.code = ERR_303_CODE;
										erreur.message = ERR_303_MSG;
										lVr.log.erreurs.push(erreur);							

										// Redirection vers la vue edition
										EditerCommandeVue({id_commande:that.infoCommande.comId,
															vr:lVr});
										
										$(lDialog).dialog("close");
										
									} else {
										Infobulle.generer(lResponse,'');
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
				var lGestionCommandeTemplate = new GestionCommandeTemplate();
				var lTemplate = lGestionCommandeTemplate.lotUnique;
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
};function EditerCommandeVue(pParam) {
	this.mNiveau = [];
	this.mIdCommande = null;
	this.mCommande = null;
	
	this.construct = function(pParam) {
		var that = this;
		pParam.fonction = 'afficher';
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						that.afficher(lResponse);
						if(pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}	
	
	this.afficher = function(pResponse) {
		var that = this;
				
		var lData = {};
		
		lData.comId = pResponse.marche.id;
		this.mIdCommande = lData.comId;
		lData.comNumero = pResponse.marche.numero;
		lData.comDescription = pResponse.marche.description;
		lData.dateTimeFinReservation = pResponse.marche.dateFinReservation;
		lData.dateFinReservation = pResponse.marche.dateFinReservation.extractDbDate().dateDbToFr();
		lData.heureFinReservation = pResponse.marche.dateFinReservation.extractDbHeure();
		lData.minuteFinReservation = pResponse.marche.dateFinReservation.extractDbMinute();
		lData.dateMarcheDebut = pResponse.marche.dateMarcheDebut.extractDbDate().dateDbToFr();
		lData.heureMarcheDebut = pResponse.marche.dateMarcheDebut.extractDbHeure();
		lData.minuteMarcheDebut = pResponse.marche.dateMarcheDebut.extractDbMinute();
		lData.heureMarcheFin = pResponse.marche.dateMarcheFin.extractDbHeure();
		lData.minuteMarcheFin = pResponse.marche.dateMarcheFin.extractDbMinute();
		lData.archive = pResponse.marche.archive;
		
		lData.pdtCommande = [];
		
		$.each(pResponse.marche.produits,function() {
			
			var lProduit = {};
			lProduit.proId = this.id;
			lProduit.nproNom = this.nom;
			lProduit.quantiteCommande = parseFloat(this.stockInitial) - parseFloat(this.stockReservation);
			lProduit.quantiteInit = parseFloat(this.stockInitial);
			lProduit.unite = this.unite;
			
			that.mNiveau.push({'id':this.id,
								'quantite':parseInt(lProduit.quantiteCommande*100/lProduit.quantiteInit)});
			
			lData.pdtCommande.push(lProduit);
		});

		lData.listeAdherentCommande = pResponse.listeAdherentCommande;
		lData.sigleMonetaire = gSigleMonetaire;
		
		this.mCommande = lData;
		
		var lGestionCommandeTemplate = new GestionCommandeTemplate();		
		var lTemplate = lGestionCommandeTemplate.editerCommandePage;
		
		var lHtml = that.affect($(lTemplate.template(lData)));
		
		// Si il n'y a pas de résa on affiche pas le tableau
		if(!(pResponse.listeAdherentCommande.length > 0 && pResponse.listeAdherentCommande[0].adhId != null)) {			
			lHtml.find('#edt-com-recherche').hide();
			lHtml.find('#edt-com-liste-resa').replaceWith(lGestionCommandeTemplate.listeReservationVide);
		}
		
		$('#contenu').replaceWith(lHtml);	
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectNiveau(pData);
		pData = this.affectReservation(pData);
		pData = this.affectModifier(pData);
		//pData = this.affectCloturer(pData);
		pData = this.affectExportReservation(pData);
		pData = this.affectBonDeCommande(pData);
		pData = this.affectBonDeLivraison(pData);
		pData = this.affectArchive(pData);
		pData = this.affectListeAchatEtReservation(pData);
		pData = this.affectListeReservation(pData);
		pData = gCommunVue.comHoverBtn(pData);
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
	
	this.affectNiveau = function(pData) {		
		$(this.mNiveau).each(function() {
			var lId = this.id;
			var lQuantite = this.quantite;
			if(lQuantite < 1) { lQuantite = 1; }
			pData.find('#pdt-' + lId).progressbar({
				value:lQuantite
			});
		});
		return pData;
	}
	
	this.affectReservation = function(pData) {
		var that = this;
		pData.find('.edt-com-reservation-ligne').click(function() {
			ReservationAdherentVue({"id_commande":that.mIdCommande,"id_adherent":$(this).find('.id-adherent').text()});
		});
		return pData;
	}
	
	this.affectModifier = function(pData) {	
		var that = this;
		pData.find('#btn-modif-com').click(function() {
			ModifierCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectBonDeCommande = function(pData) {
		var that = this;
		pData.find('#btn-bon-com').click(function() {
			BonDeCommandeVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectBonDeLivraison = function(pData) {
		var that = this;
		pData.find('#btn-livraison-com').click(function() {
			BonDeLivraisonVue({"id_commande":that.mIdCommande});
		});
		return pData;
	}
	
	this.affectArchive = function(pData) {
		if(this.mCommande.archive == 0) {
			pData.find('.marche-archive-0').show();
		} else if(this.mCommande.archive == 1) {
			pData.find('.marche-archive-1').show();
		}
		pData = this.affectPause(pData);
		pData = this.affectPlay(pData);
		pData = this.affectCloturer(pData);
		return pData;
	}
	
	this.modifierArchive = function() {
		if(this.mCommande.archive == 0) {
			$('.marche-archive-0').show();
			$('.marche-archive-1').hide();
		} else if(this.mCommande.archive == 1) {
			$('.marche-archive-0').hide();
			$('.marche-archive-1').show();
		}
	}
	
	this.affectCloturer = function(pData) {
		var that = this;
		pData.find('#btn-cloture-com')
		.click(function() {
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogClotureCommande;
			
			$(lTemplate.template(that.mCommande)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Cloturer': function() {
						var lParam = {id_commande:that.mIdCommande,fonction:"cloturer"};
						var lDialog = this;
						$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse.valid) {
										/*var lGestionCommandeTemplate = new GestionCommandeTemplate();
										var lTemplate = lGestionCommandeTemplate.cloturerCommandeSucces;
										$('#contenu').replaceWith(lTemplate.template(lResponse));*/
										
										// Message de confirmation
										var lVr = new TemplateVR();
										lVr.valid = false;
										lVr.log.valid = false;
										var erreur = new VRerreur();
										erreur.code = ERR_313_CODE;
										erreur.message = ERR_313_MSG;
										lVr.log.erreurs.push(erreur);										

										var lparam = {"id_commande":that.mIdCommande,
												vr:lVr};
										InfoCommandeArchiveVue(lparam);
										
										
										$(lDialog).dialog('close');
									} else {
										Infobulle.generer(lResponse,'');
									}
								},"json"
						);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
		});
		return pData;
	}
	
	this.affectPause = function(pData) {
		var that = this;
		pData.find('#btn-pause-com')
		.click(function() {
			var lParam = {id_commande:that.mIdCommande,fonction:"pause"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {							
							that.mCommande.archive = 1;
							that.modifierArchive();
							
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_311_CODE;
							erreur.message = ERR_311_MSG;
							lVr.log.erreurs.push(erreur);							

							// Message de confirmation
							Infobulle.generer(lVr,'');
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		});
		return pData;
	}
	
	this.affectPlay = function(pData) {
		var that = this;
		pData.find('#btn-play-com')
		.click(function() {
			var lParam = {id_commande:that.mIdCommande,fonction:"play"};
			$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
					function(lResponse) {
						Infobulle.init(); // Supprime les erreurs
						if(lResponse.valid) {							
							that.mCommande.archive = 0;
							that.modifierArchive();

							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_312_CODE;
							erreur.message = ERR_312_MSG;
							lVr.log.erreurs.push(erreur);							

							// Message de confirmation
							Infobulle.generer(lVr,'');
						} else {
							Infobulle.generer(lResponse,'');
						}
					},"json"
			);
		});
		return pData;
	}
	
	this.affectExportReservation = function(pData) {		
		var that = this;
		pData.find('#btn-export-resa')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogExportListeReservation;
			
			$(lTemplate.template(that.mCommande)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Exporter': function() {
						// Récupération du formulaire
						var lIdProduits = '';
						$(this).find(':input[name=id_produits]:checked').each(function() {
							lIdProduits += $(this).val() + ',';
						});
						lIdProduits = lIdProduits.substr(0,lIdProduits.length-1);
						
						var lFormat = $(this).find(':input[name=format]:checked').val();
						var lParam = new ExportListeReservationVO();
						//lParam = {pParam:1,export_type:1,id_commande:that.mIdCommande,id_produits:lIdProduits,format:lFormat};
						lParam = {fonction:"exportReservation",id_commande:that.mIdCommande,id_produits:lIdProduits,format:lFormat};
						
						// Test des erreurs
						var lValid = new ExportListeReservationValid();
						var lVr = lValid.validAjout(lParam);
						
						Infobulle.init(); // Supprime les erreurs
						if(lVr.valid) {
							// Affichage
							$.download("./index.php?m=GestionCommande&v=EditerCommande", lParam);
						} else {
							Infobulle.generer(lVr,'');
						}
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
			
		});
		return pData;
	}
	
	this.affectListeAchatEtReservation = function(pData) {
		var that = this;
		pData.find("#btn-liste-achat-resa").click(function() {
			that.afficherAchatEtReservation();
		});
		
		return pData;
	}
	
	
	this.affectAchatEtReservation = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectAchat(pData);
		pData = this.affectExportDataEtReservation(pData);
		return pData;
	}
	
	this.affectAchat = function(pData) {
		var that = this;
		pData.find('.edt-com-achat-ligne').click(function() {
			AchatAdherentVue({"id_commande":that.mIdCommande,"id_adherent":$(this).find('.id-adherent').text()});
		});
		return pData;
	}
	
	this.afficherAchatEtReservation = function() {
		var that = this;
		var lParam = {id_commande:this.mIdCommande,fonction:"listeAchatReservation"};
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						
						// Met le bouton en actif
						$("#btn-liste-resa").removeClass("ui-state-active");
						$("#btn-liste-achat-resa").addClass("ui-state-active");
						
						$(lResponse.listeAchatEtReservation).each(function() {
							if(this.reservation == null) { this.reservation = '';}
							if(this.achat == null) { this.achat = '';}
						});

						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						if(lResponse.listeAchatEtReservation.length > 0 && lResponse.listeAchatEtReservation[0].adhId != null) {
							var lTemplate = lGestionCommandeTemplate.listeAchatEtReservation;
							$('#edt-com-liste').replaceWith(that.affectAchatEtReservation($(lTemplate.template(lResponse))));
						} else {
							$('#edt-com-liste').replaceWith(lGestionCommandeTemplate.listeAchatEtReservationVide);
						}
						
						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.affectExportDataEtReservation = function(pData) {		
		var that = this;
		pData.find('#btn-export-achat')
		.click(function() {			
			var lGestionCommandeTemplate = new GestionCommandeTemplate();
			var lTemplate = lGestionCommandeTemplate.dialogExportListeAchatEtReservation;
			
			$(lTemplate.template(that.mCommande)).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Exporter': function() {
						// Récupération du formulaire
						/*var lIdProduits = '';
						$(this).find(':input[name=id_produits]:checked').each(function() {
							lIdProduits += $(this).val() + ',';
						});
						lIdProduits = lIdProduits.substr(0,lIdProduits.length-1);
						
						var lFormat = $(this).find(':input[name=format]:checked').val();
						var lParam = new ExportListeReservationVO();
						//lParam = {pParam:1,export_type:1,id_commande:that.mIdCommande,id_produits:lIdProduits,format:lFormat};*/
						lParam = {fonction:"exportAchatEtReservation",id_commande:that.mIdCommande};
						
						// Test des erreurs
						/*var lValid = new ExportListeReservationValid();
						var lVr = lValid.validAjout(lParam);
						
						Infobulle.init(); // Supprime les erreurs
						if(lVr.valid) {*/
							// Affichage
							$.download("./index.php?m=GestionCommande&v=EditerCommande", lParam);
						/*} else {
							Infobulle.generer(lVr,'');
						}*/
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); Infobulle.init(); }	
			});
			
		});
		return pData;
	}
	
	this.affectListeReservation = function(pData) {
		var that = this;
		pData.find("#btn-liste-resa").click(function() {
			that.afficherListeReservation();
		});
		
		return pData;
	}
	
	this.affectReservationAction = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectExportReservation(pData);
		pData = this.affectReservation(pData);
		return pData;
	}

	this.afficherListeReservation = function() {
		var that = this;
		var lParam = {id_commande:this.mIdCommande,fonction:"listeReservation"};
		$.post(	"./index.php?m=GestionCommande&v=EditerCommande", "pParam=" + $.toJSON(lParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {
						
						// Met le bouton en actif
						$("#btn-liste-achat-resa").removeClass("ui-state-active");
						$("#btn-liste-resa").addClass("ui-state-active");
						

						var lGestionCommandeTemplate = new GestionCommandeTemplate();
						var lTemplate = lGestionCommandeTemplate.listeReservation;
						
						var lHtml = that.affectReservationAction($(lTemplate.template(lResponse)));
						
						// Si il n'y a pas de résa on affiche pas le tableau
						if(!(lResponse.listeAdherentCommande.length > 0 && lResponse.listeAdherentCommande[0].adhId != null)) {			
							lHtml.find('#edt-com-recherche').hide();
							lHtml.find('#edt-com-liste-resa').replaceWith(lGestionCommandeTemplate.listeReservationVide);
						}
						
						$('#edt-com-liste').replaceWith(lHtml);
						
						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}

	this.construct(pParam);
}