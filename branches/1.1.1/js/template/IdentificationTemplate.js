;function IdentificationTemplate() {
	this.connexion =
		"<div id=\"formulaire_identification_ifb\" title=\"Connexion à Zeybux\" >" +
			"<form id=\"identification-form\" action=\"./index.php\" method=\"post\">" +
				"<table>" +
					"<tr>" +
						"<td>N° d'adhérent</td>" +
						"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"login\" id=\"login\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<td>Mot de Passe</td>" +
						"<td><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" id=\"pass\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";

	this.debutMenu = "<div id=\"menu_int\"><ul id=\"menu_liste\" class=\"ui-corner-tl ui-corner-br\">";
	this.finMenu = "</ul></div>";
		
	this.deconnexion =	
		"<span id=\"lien-deconnexion\" class=\"ui-widget-header ui-corner-bl\">" +
			"<a href=\"./index.php?m=Identification&amp;v=Deconnexion\" >" +
				"<span class=\"com-float-left ui-icon ui-icon-power\"></span>" +
				"Déconnexion" +
			"</a>" +
		"</span>";
	
	this.administration =	
		"<span id=\"lien-administration\" class=\"btn-menu com-cursor-pointer ui-widget-header ui-corner-tl\">" +
				"<span class=\"com-float-left ui-icon ui-icon-gear\"></span>" +
				"Administration" +
		"</span>";
		
	this.module =	
		"<!-- BEGIN modules -->" +
		"<li>" +
			"<span class=\"com-cursor-pointer ui-widget-header menu-lien btn-menu\" id=\"menu-{modules.moduleNom}-{modules.nom}\">{modules.label}</span>" +
		"</li>" +
		"<!-- END modules -->";
	
	this.admin = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Administration" +
				"</div>" +
				"<div>" +
					"<ul>" +
						"<!-- BEGIN modules -->" +
						"<li>" +
							"<span id=\"menu-{modules.moduleNom}-{modules.nom}\" >{modules.label}</span>" +			
							"<ul>" +
							"<!-- BEGIN vues -->" +
								"<li>" +
									"<a id=\"menu-{modules.moduleNom}-{modules.vues.nom}\" href=\"./index.php?m={modules.moduleNom}&amp;v={modules.vues.nom}\">{modules.vues.label}</a>" +
								"</li>" +
								"<br/>" +
							"<!-- END vues -->" +
							"</ul>" +
						"</li>" +
						"<!-- END modules -->" +
					"</ul>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.naviguateurIncompatible =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header com-center ui-corner-all\">" +
					"Naviguateur Incompatible" +
				"</div>" +
				"<div>" +
					"Votre naviguateur n'est pas compatible avec zeybux.<br/>" +
					"Vous pouvez utiliser l'un des naviguateur suivants pour profiter du site : <br/>" +
					"<div id=\"liste-naviguateur\" class=\"com-center\">" +
						
						"<div id=\"naviguateur-1\" class=\"com-float-left\">" +
							"<a href=\"http://www.mozilla.com/fr/firefox/\">" +
								"<img alt=\"Mozilla Firefox\" src=\"./images/firefox-logo.png\"/><br/>" +
								"Mozilla Firefox" +
							"</a>" +
						"</div>" +
						"<div>" +	
							"<a href=\"http://www.google.com/chrome/\">" +
								"<img alt=\"Google Chrome\" src=\"./images/chrome-logo.png\"/><br/>" +
								"Google Chrome" +
							"</a>" +
						"</div>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.formulaireIdentificationHTML = 
		"<div id=\"contenu\">" +
			"<div class=\"ui-widget ui-widget-content ui-state-highlight com-center\" >" +
				"Votre naviguateur n'est pas compatible avec la version complète du zeybux.<br/>" +
				"Ceci est la version minimale du zeybux.<br/>" +
				"Vous pouvez utiliser l'un des naviguateur suivants pour profiter de l'ensemble du site : <br/>" +
				"<div id=\"liste-naviguateur\" class=\"com-center\">" +
					
					"<div id=\"naviguateur-1\" class=\"com-float-left\">" +
						"<a href=\"http://www.mozilla.com/fr/firefox/\">" +
							"<img alt=\"Mozilla Firefox\" src=\"./images/firefox-logo.png\"/><br/>" +
							"Mozilla Firefox" +
						"</a>" +
					"</div>" +
					"<div>" +	
						"<a href=\"http://www.google.com/chrome/\">" +
							"<img alt=\"Google Chrome\" src=\"./images/chrome-logo.png\"/><br/>" +
							"Google Chrome" +
						"</a>" +
					"</div>" +
				"</div>" +
			"</div>" +
			"<div id=\"formulaire_identification_html\" class=\"ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Connexion à Zeybux</div>" +
				"<form id=\"identification-form\" action=\"./index.php?m=IdentificationHTML&v=Identification\" method=\"post\">" +
					"<table>" +
						"<tr>" +
							"<td>N° d'adhérent</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"login\" id=\"login\" value=\"Z\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<td>Mot de Passe</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"password\" name=\"pass\" id=\"pass\" value=\"zeybu\" /></td>" +
						"</tr>" +
						"<tr>" +
							"<td colspan=\"2\" class=\"com-center com-ligne-submit\" ><input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Connexion\"/></td>" +
						"</tr>" +
						"<tr>" +						
							"<td></td>" +
							"<td class=\"com-text-align-right\" ><a class=\"lien_mot_passe\" href=\"./index.php?m=IdentificationHTML&amp;v=MotDePasse\">Mot de passe oublié</a></td>" +
						"</tr>" +
					"</table>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.formulaireIdentification = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_identification_int\" class=\"ui-widget ui-widget-content ui-widget-content-transparent  ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Connexion à Zeybux</div>" +
				"<form id=\"identification-form\" action=\"./index.php\" method=\"post\">" +
					"<table>" +
						"<tr>" +
							"<td>N° d'adhérent</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"text\" name=\"login\" id=\"login\" value=\"Z\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<td>Mot de Passe</td>" +
							"<td><input class=\"com-input-text ui-widget-content ui-widget-content-transparent ui-corner-all\" type=\"password\" name=\"pass\" id=\"pass\" value=\"zeybu\" /></td>" +
						"</tr>" +
						"<tr>" +
							"<td colspan=\"2\" class=\"com-center com-ligne-submit\" ><input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Connexion\"/></td>" +
						"</tr>" +
						"<tr>" +						
							"<td></td>" +
							"<td class=\"com-text-align-right\" ><a class=\"lien_mot_passe\" href=\"./index.php?m=IdentificationHTML&amp;v=MotDePasse\">Mot de passe oublié</a></td>" +
						"</tr>" +
					"</table>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.chargementModule = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_identification_int\" class=\"ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Chargement du Zeybux</div>" +
				"<div id=\"chargement-module-progressbar\"></div>" +
			"</div>" +
		"</div>";
	
	this.chargementIdentification = 
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_identification_int\" class=\"ui-widget ui-widget-content ui-widget-content-transparent ui-corner-all\" >" +
				"<div id=\"titre_fenetre\" class=\"ui-widget ui-widget-header ui-corner-all\">Connexion à Zeybux</div>" +
				"<div class=\"com-center\">Identification ...</div>" +
			"</div>" +
		"</div>";
}