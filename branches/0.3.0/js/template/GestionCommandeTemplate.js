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
				"<span class=\"produit-nom-id ui-helper-hidden\">{proIdNomProduit}</span><span class=\"produit-nom\">{nproNom}</span>" +				
				"<span class=\"com-delete com-btn-header ui-widget-content ui-corner-all\" title=\"Supprimer\">" +
					"<span class=\"ui-icon ui-icon-circle-close\">" +
					"</span>" +
				"</span>" +
			"</div>" +
			"<div class=\"com-widget-content\">" +				
				"<span class=\"produit-id ui-helper-hidden\">{proId}</span>" +
				
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
				"</span><br/>" +	
			
				"Quantité en stock : " +
				"<span class=\"info-produit produit-stock\">{quantiteInit}</span>" +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"stock\" value=\"{quantiteInit}\" id=\"produit-{proIdNomProduit}-qteRestante\" maxlength=\"11\"/>" +
				" <span class=\"info-produit produit-unite\">{proUniteMesure}</span>" +	
				" <input class=\"info-produit ui-helper-hidden com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"unite\" value=\"{proUniteMesure}\" id=\"produit-{proIdNomProduit}-unite\" maxlength=\"20\"/>" +						
				"<br/>" +
				
				"Quantité max par adhérent : " +
				"<input class=\"info-produit ui-helper-hidden com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"qmax\" value=\"{proMaxProduitCommande}\" id=\"produit-{proIdNomProduit}-qteMaxCommande\" maxlength=\"11\"/>" +
				"<span class=\"info-produit produit-qmax\">{proMaxProduitCommande}</span>" +
				" <span class=\"produit-unite\">{proUniteMesure}</span>" +
				
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
	
	this.modifCommandeSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification de la commande n°{numero}" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\"><span class=\"com-float-left ui-icon ui-icon-check\"></span>Marché n°{numero} modifié avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
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
	
	this.cloturerCommandeSucces = 
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
	
	this.dialogClotureCommande = 				
			"<div id=\"dialog-cloturer-com\" title=\"Cloture du Marché n°{comNumero}\">" +
				"<p>Vous allez cloturer le Marché n°{comNumero}</p>" +
			"</div>";
	
	this.dialogExportListeReservation = 
			"<div id=\"dialog-export-liste-reservation\" title=\"Export des réservations du Marché n°{comNumero}\">" +
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
						"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all\" id=\"btn-cloture-com\" title=\"Cloturer\">" +
							"<span class=\"ui-icon ui-icon-disk\">" +
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
						"<span class=\"com-btn-header ui-widget-content ui-corner-all com-cursor-pointer pdt-{pdtCommande.proId}-afficher-detail\">" +
							"<span class=\"ui-icon ui-icon-plusthick\">" +
							"</span>" +
						"</span>" +
						"<span class=\"ui-helper-hidden com-btn-header ui-widget-content ui-corner-all com-cursor-pointer pdt-{pdtCommande.proId}-afficher-detail\">" +
							"<span class=\"ui-icon ui-icon-minusthick\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div>" +
						"<div class=\"edt-com-progressbar-pdt\" id=\"pdt-{pdtCommande.proId}\"></div>" +
						"<div class=\"ui-helper-hidden\" id=\"pdt-{pdtCommande.proId}-detail\">" +
							"Stock Initial : {pdtCommande.quantiteInit} {pdtCommande.proUniteMesure}<br/>" +
							"Stock Actuel : {pdtCommande.quantite} {pdtCommande.proUniteMesure}<br/>" +
							"Stock Commandé : {pdtCommande.quantiteCommande} {pdtCommande.proUniteMesure}<br/>" +
							"Max par adhérent {pdtCommande.proMaxProduitCommande} {pdtCommande.proUniteMesure}" +
							"<div>" +
								"<div>Lots : </div>" +
								"<!-- BEGIN pdtCommande.lot -->" +
									"{pdtCommande.lot.dcomTaille} {pdtCommande.proUniteMesure} à " +
									"{pdtCommande.lot.dcomPrix} {sigleMonetaire}<br/>" +
								"<!-- END pdtCommande.lot -->" +
							"</div>" +
						"</div>" +
					"</div>" +
				"</div>" +
				"<!-- END pdtCommande -->" +
			"</div>" +
			"<div class=\"com-float-left\" id=\"edt-com-liste\" >" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
						"Liste des Réservation" +
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
		"</div>";
	
	this.supprimerReservationDialog =
		"<div id=\"dialog-supprimer-reservation\" title=\"Supprimer la réservation\">" +
			"<p>Voulez-vous supprimer la réservation ?</p>" +
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
				"<p id=\"texte-liste-vide\">Aucune réservation en cours.</p>" +	
			"</div>" +
		"</div>";
	
	this.listeReservationVide =
		"<p id=\"texte-liste-vide\">Aucune reservation.</p>";
	
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
								"<option value=\"{producteurs.prdtId}\">{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
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
						"<td><input class=\"prix-commande com-numeric com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prix-commande-{produits.proId}\" maxlength=\"11\" value=\"{produits.opeMontant}\" id=\"produits{produits.proId}prix\" /> {sigleMonetaire}</td>" +
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
								"<option value=\"{producteurs.prdtId}\">{producteurs.prdtPrenom} {producteurs.prdtNom}</option>" +
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
}
