;function TypePaiementService() {
	this.affect = function(pData, pBanques, pPrefixe) {
		if(pPrefixe == undefined) { pPrefixe = ''; }
		pData = this.affectListeBanque(pData, pBanques, pPrefixe);
		pData = this.affectNumeric(pData, pPrefixe);
		return pData;
	};
	
	this.affectNumeric = function(pData, pPrefixe) {
		pData.find('#' + pPrefixe + 'champComplementaire3valeur').numeric({nbDecimal: 0});
		return pData;
	};
	
	this.affectListeBanque = function(pData, pBanques, pPrefixe) {
		if(pData.find('#' + pPrefixe + 'champComplementaire2valeur').length == 1) {
			function removeIfInvalid(element) {
				// Vide le champ si la banque n'existe pas
				var value = $( element ).val(),
				matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
				valid = false;
				$( pBanques ).each(function() {
					if (  this.nom.match( matcher ) ) {
						this.selected = valid = true;
						return false;
					}
				});
				
				if ( !valid ) {
					$( element ).attr( 'id-banque','' ); 
					
					// Message d'information
					var lVr = new OperationDetailVR();
					lVr.valid = false;
					
					var lVrChampComplementaire = new ChampComplementaireVR();
					
					lVrChampComplementaire.valid = false;
					lVrChampComplementaire.valeur.valid = false;
					var erreur = new VRerreur();
					erreur.code = ERR_261_CODE;
					erreur.message = ERR_261_MSG;
					lVrChampComplementaire.valeur.erreurs.push(erreur);
					
					lVr.champComplementaire[2] = lVrChampComplementaire;
									
					Infobulle.generer(lVr,'');
					return false;
				}
			};
					
			pData.find('#' + pPrefixe + 'champComplementaire2valeur').autocomplete({
				minLength: 0,			 
				source: function( request, response ) {
					var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
						response( $.grep( pBanques, 
							function( item ){
								return matcher.test( item.nom ) || matcher.test( item.nomCourt );
							}
						));
				},	 
				focus: function( event, ui ) {
					Infobulle.init(); // Supprime les erreurs
					$( '#' + pPrefixe + 'champComplementaire2valeur' ).val( htmlDecode(ui.item.nom) );
					$( '#' + pPrefixe + 'champComplementaire2valeur' ).attr('id-banque', ui.item.id );
					return false;
				},
				select: function( event, ui ) {
					Infobulle.init(); // Supprime les erreurs
					$( '#' + pPrefixe + 'champComplementaire2valeur' ).val( htmlDecode(ui.item.nom) );
					$( '#' + pPrefixe + 'champComplementaire2valeur' ).attr('id-banque', ui.item.id );
					return false;
				},
				change: function( event, ui ) {
					Infobulle.init(); // Supprime les erreurs
					if ( !ui.item )
						return removeIfInvalid( this );
				}
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
				return $( "<li>" )
				.data( "item.autocomplete", item )
				.append( "<a>" + item.nomCourt + " : " + item.nom + "<br>" + item.description + "</a>" )
				.appendTo( ul );
			};
		}
		return pData;
	};
	
	this.getChampComplementaire = function(pChamp, pPrefixe) {
		if(pPrefixe == undefined) { pPrefixe = ''; }
		var lListeChampComplementaire = [];
		$(pChamp).each(function() {
			var lChampComplementaire = new ChampComplementaireVO();
			lChampComplementaire.id = this.id;
			lChampComplementaire.obligatoire = this.obligatoire;

			switch(parseInt(this.id)) {
				case 2: // idBanque
					var lValeur = $('#' + pPrefixe + 'champComplementaire' + this.id + 'valeur').attr('id-banque');
					lChampComplementaire.valeur = (lValeur != undefined) ? lValeur : '';
					break;
				default:
					lChampComplementaire.valeur = $('#' + pPrefixe + 'champComplementaire' + this.id + 'valeur').val();
					break;
			};
			lListeChampComplementaire[this.id] = lChampComplementaire;
		});
		return lListeChampComplementaire;
	};
	
	this.getFormChampcomplementaire = function(pChamp, pBanques, pAffiche, pPrefixe) {
		//var lChamp = clone(pChamp);
		if(pPrefixe == undefined) { pPrefixe = ''; }
		var lChamp = $.extend(true,{},pChamp);

		var lBanques = [];
		$(pBanques).each(function() {
			lBanques[this.id] = this;
		});

		$.each(lChamp, function() {	
			if(this.id != undefined) {
				switch(parseInt(this.id)) {
					case 2: // idBanque
						if(lBanques[this.valeur]) {
							this.attr = 'id-banque="' + this.valeur + '"';
							this.valeur = lBanques[this.valeur].nom;
						} else {
							this.attr = '';
							this.valeur = '';
						}
						break;
					default:
						this.attr = '';
						break;
				}
				if(this.tppCpVisible != 1) {
					this.valeur = '';
				}
			}
		});
		
		lTypePaiementServiceTemplate = new TypePaiementServiceTemplate();
		var lTemplate = '';
		if(pAffiche == undefined || pAffiche == false) {
			lTemplate = lTypePaiementServiceTemplate.champComplementaire;
		} else {
			lTemplate = lTypePaiementServiceTemplate.champComplementaireAffiche;
		}
		
		return lTemplate.template({champComplementaire:lChamp, prefixe:pPrefixe});
	};
};