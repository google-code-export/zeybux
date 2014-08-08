function ParametrageTemplate() {
	this.listeBanque = 
		"<div id=\"contenu\">" +			
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Banques" +
					"<span class=\"com-btn-header-text ui-widget-content ui-corner-all\" id=\"btn-nv-banque\" title=\"Ajouter une banque\">" +
						"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
						"</span>Ajouter" +
					"</span>" +
				"</div>" +
				"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"<form id=\"filter-form\">" +
						"<div>" +
							"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
									"<span class=\"ui-icon ui-icon-search\">" +
								"</span>" +
							"</span>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
						"</div>" +
					"</form>" +
				"</div>" +
				"<table class=\"com-table\">" +
					"<thead>" +
						"<tr class=\"ui-widget ui-widget-header\">" +
							"<th class=\"com-table-th-debut com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom Court</th>" +
							"<th class=\"com-table-th-med com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
							"<th class=\"com-table-th-med com-underline-hover\"></th>" +
							"<th class=\"com-table-th-fin com-underline-hover\"></th>" +
						"</tr>" +
					"</thead>" +
					"<tbody>" +
				"<!-- BEGIN liste -->" +
						"<tr class=\"com-cursor-pointer\" id=\"{liste.id}\">" +
							"<td class=\"compte-ligne com-table-td-debut com-underline-hover\">{liste.nomCourt}</td>" +
							"<td class=\"compte-ligne com-table-td-med com-underline-hover\">{liste.nom}</td>" +
							"<td class=\"com-table-td-med com-underline-hover td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier\" title=\"Modifier\">" +
									"<span class=\"ui-icon ui-icon-pencil\"></span>" +
								"</span>" +
							"</td>" +
							"<td class=\"com-table-td-fin com-underline-hover td-edt\">" +
								"<span class=\"com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer\" title=\"Supprimer\">" +
									"<span class=\"ui-icon ui-icon-trash\"></span>" +
								"</span>" +
							"</td>" +
						"</tr>" +
				"<!-- END liste -->" +
					"</tbody>" +
				"</table>" +
			"</div>" +
		"</div>";
	
	this.listeBanqueVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Banques" +
					"<span class=\"com-btn-header-text ui-widget-content ui-corner-all\" id=\"btn-nv-banque\" title=\"Ajouter une banque\">" +
						"<span class=\"com-float-left ui-icon ui-icon-plusthick\">" +
						"</span>Ajouter" +
					"</span>" +
				"</div>" +
				"<p id=\"texte-liste-vide\">Aucune Banque dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogAjoutBanque =
		"<div id=\"dialog-form-banque\" title=\"Banque\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td>" +
							"<input type=\"hidden\" name=\"id\" id=\"banque-id\" value=\"{id}\"/>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" id=\"banque-nom\" value=\"{nom}\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
					"<td>Nom Court</td>" +
						"<td>" +
							"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nomCourt\" id=\"banque-nomCourt\" value=\"{nomCourt}\"/>" +
						"</td>" +
					"</tr>" +
					"<tr>" +
						"<td>Description</td>" +
						"<td><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"description\" id=\"banque-description\">{description}</textarea></td>" +
					"</tr>" +
				"</table>" +	
			"</form>" +
		"</div>";
	
	this.dialogSupprimerBanque =
		"<div id=\"dialog-banque\" title=\"Banque\">" +
			"<p>" +
				"Voulez-vous supprimer la banque : {nom}" +		
			"</p>" +
		"</div>";
	
	this.dialogDetailBanque = 
		"<div id=\"dialog-detail-banque\" title=\"Détail de la banque\">" +
			"<div>Nom : {nom}</div>" +
			"<div>Nom Court : {nomCourt}</div>" +
			"<div>Description : {description}</div>" +
		"</div>";
	
	this.formParametreZeybux =
	"<div id=\"contenu\">" +
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
		"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les comptes</div>" +
			"<form>" +
				"<table class=\"com-table-100\">" +
					"<tr>" +
						"<td colspan=\"2\" class=\"ui-widget-header\">Mail</td>	" +	
					"</tr>" +
					"<tr>" +
						"<td>Adresse mail du support</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"mailSupport\" id=\"mailSupport\" value=\"{mailSupport}\"/></td>		" +				
					"</tr>" +
					"<tr>" +
						"<td>Mailing liste</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"mailMailingListe\" id=\"mailMailingListe\" value=\"{mailMailingListe}\" /></td>		" +				
					"</tr>" +
					"<tr>" +
						"<td>Domaine des mailing liste</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"mailMailingListeDomaine\" id=\"mailMailingListeDomaine\" value=\"{mailMailingListeDomaine}\" /></td>		" +				
					"</tr>" +
					"<tr>" +
						"<td colspan=\"2\" class=\"ui-widget-header\">Compte OVH : Accès WebServices</td>		" +
					"</tr>" +
					"<tr>" +
						"<td>Adresse du WebService</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"adresseWSDL\" id=\"adresseWSDL\" value=\"{adresseWSDL}\" /></td>			" +			
					"</tr>" +
					"<tr>" +
						"<td>Login</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"sOAPLogin\" id=\"sOAPLogin\" value=\"{sOAPLogin}\" /></td>	" +					
					"</tr>" +
					"<tr>" +
						"<td>Mot de passe</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"sOAPPass\" id=\"sOAPPass\" value=\"{sOAPPass}\" /></td>			" +			
					"</tr>" +			
					"<tr>" +
						"<td colspan=\"2\" class=\"ui-widget-header\">Site Zeybux</td>	" +	
					"</tr>" +
					"<tr>" +
						"<td>Nom du site</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"zeybuxTitre\" id=\"zeybuxTitre\" value=\"{zeybuxTitre}\" /></td>		" +				
					"</tr>" +
					"<tr>" +
						"<td>Adresse du site</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"zeybuxAdresse\" id=\"zeybuxAdresse\" value=\"{zeybuxAdresse}\" /></td>			" +			
					"</tr>" +
					"<tr>" +
						"<td colspan=\"2\" class=\"ui-widget-header\">Proprietaire Zeybux</td>	" +	
					"</tr>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propNom\" id=\"propNom\" value=\"{propNom}\" /></td>	" +					
					"</tr>" +
					"<tr>" +
						"<td>Adresse</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propAdresse\" id=\"propAdresse\" value=\"{propAdresse}\" /></td>	" +					
					"</tr>" +
					"<tr>" +
						"<td>Code Postal</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propCP\" id=\"propCP\" value=\"{propCP}\" /></td>			" +			
					"</tr>" +
					"<tr>" +
						"<td>Ville</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propVille\" id=\"propVille\" value=\"{propVille}\" /></td>	" +					
					"</tr>" +
					"<tr>" +
						"<td>Téléphone</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propTel\" id=\"propTel\" value=\"{propTel}\" /></td>		" +				
					"</tr>" +
					"<tr>" +
						"<td>Courriel</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propMail\" id=\"propMail\" value=\"{propMail}\" /></td>	" +					
					"</tr>" +
					"<tr>" +
						"<td colspan=\"2\" class=\"ui-widget-header\">Responsable Marché</td>" +		
					"</tr>" +
					"<tr>" +
						"<td>Titre du poste de responsable marché</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propRespMarchePoste\" id=\"propRespMarchePoste\" value=\"{propRespMarchePoste}\" /></td>	" +					
					"</tr>" +
					"<tr>" +
						"<td>Prénom</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propRespMarchePrenom\" id=\"propRespMarchePrenom\" value=\"{propRespMarchePrenom}\" /></td>		" +				
					"</tr>" +
					"<tr>" +
						"<td>Nom</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propRespMarcheNom\" id=\"propRespMarcheNom\" value=\"{propRespMarcheNom}\" /></td>		" +				
					"</tr>" +
					"<tr>" +
						"<td>Téléphone</td>" +
						"<td><input type=\"text\" class=\"com-input-text ui-widget-content ui-corner-all\" name=\"propRespMarcheTel\" id=\"propRespMarcheTel\" value=\"{propRespMarcheTel}\" /></td>	" +					
					"</tr>		" +
					"<tr>" +
						"<td colspan=\"2\" class=\"com-center\">" +
							"<input type=\"submit\" value=\"Modifier\" class=\"ui-state-default ui-corner-all com-button com-center\" />" +
						"</td>	" +			
					"</tr>" +	
				"</table>" +
			"</form>" +
		"</div>" +
	"</div>";
}