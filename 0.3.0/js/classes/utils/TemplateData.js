;function TemplateData() {
	this.infobulle = "<!-- BEGIN membres -->" + //ui-helper-hidden 
			"<div class=\"ui-helper-hidden com-infobulle com-widget-window ui-widget ui-widget-content ui-corner-all\" id=\"ifb-{membres.nom}\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Erreurs : </div>" + //{membres.nom}
				"<!-- BEGIN erreurs -->" +
				"<div class=\"com-widget-content\">" +
					"<ul>" +
						"<li>" +
							"N°{membres.erreurs.code} : {membres.erreurs.message}" +
						"</li>" +
					"</ul>" +
				"</div>" +
				"<!-- END erreurs -->" +
			"</div>" +
			"<!-- END membres -->";
	
	this.infobulleLog =
		"<!-- BEGIN erreurs -->" +
			"<ul>" +
				"<li>" +
					"N°{erreurs.code} : {erreurs.message}" +
				"</li>" +
			"</ul>" +
		"<!-- END erreurs -->";
}