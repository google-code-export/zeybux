;function TypePaiementServiceTemplate() {
	this.champComplementaire =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.chCpLabel}</td>" +
				"<td>" +
					"<input {champComplementaire.attr} type=\"text\" value=\"{champComplementaire.valeur}\" class=\"com-input-text ui-widget-content ui-corner-all\" id=\"{prefixe}champComplementaire{champComplementaire.id}valeur\" data-id-champ-complementaire=\"{champComplementaire.id}\" maxlength=\"50\" size=\"15\"/>" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
	
	this.champComplementaireAffiche =
		"<!-- BEGIN champComplementaire -->" +
			"<tr class=\"champ-complementaire\">" +
				"<td>{champComplementaire.chCpLabel}</td>" +
				"<td>" +
					"{champComplementaire.valeur}" +
				"</td>" +
			"</tr>" +
		"<!-- END champComplementaire -->";
}