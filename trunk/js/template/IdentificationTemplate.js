;function IdentificationTemplate() {
	this.debutMenu = "<div id=\"menu_int\" ><ul id=\"menu_liste\" >";
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
			//"<span class=\"ui-widget-header ui-corner-top\">{modules.MODULE_LABEL}</span>" +
			"<a class=\"ui-widget-header {modules.CLASS}\" id=\"menu-{modules.MODULE_NOM}-{modules.NOM}\" href=\"./index.php?m={modules.MODULE_NOM}&amp;v={modules.NOM}\">{modules.MODULE_LABEL}</a>" +
			
			"<ul class=\"sous_menu ui-widget-content ui-corner-bottom\">" +
			"<!-- BEGIN vues -->" +
				"<li class=\"ui-corner-all\">" +
					"<a id=\"menu-{modules.MODULE_NOM}-{modules.vues.NOM}\" href=\"./index.php?m={modules.MODULE_NOM}&amp;v={modules.vues.NOM}\">{modules.vues.LABEL}</a>" +
				"</li>" +
				"<br/>" +
			"<!-- END vues -->" +
			"</ul>" +
		"</li>" +
		"<!-- END modules -->";
	
	this.nouveauModule =	
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
}