;function TypePaiementService() {
	this.affect = function(pData, pBanques) {
		pData = this.affectListeBanque(pData, pBanques);
		return pData;
	};
	
	this.affectListeBanque = function(pData, pBanques) {
		if(pData.find('#champComplementaire2valeur').length == 1) {
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
					var lVr = new RechargementCompteVR();
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
					
			pData.find('#champComplementaire2valeur').autocomplete({
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
					$( '#champComplementaire2valeur' ).val( htmlDecode(ui.item.nom) );
					$( '#champComplementaire2valeur' ).attr('id-banque', ui.item.id );
					return false;
				},
				select: function( event, ui ) {
					Infobulle.init(); // Supprime les erreurs
					$( '#champComplementaire2valeur' ).val( htmlDecode(ui.item.nom) );
					$( '#champComplementaire2valeur' ).attr('id-banque', ui.item.id );
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
	
	this.getChampComplementaire = function(pChamp) {
		var lChampcomplementaire = [];
		$(pChamp).each(function() {
			var lChampComplementaire = new ChampComplementaireVO();
			lChampComplementaire.id = this.id;
			lChampComplementaire.obligatoire = this.obligatoire;

			switch(parseInt(this.id)) {
				case 2: // idBanque
					var lValeur = $('#champComplementaire' + this.id + 'valeur').attr('id-banque');
					lChampComplementaire.valeur = (lValeur != undefined) ? lValeur : '';
					break;
				default:
					lChampComplementaire.valeur = $('#champComplementaire' + this.id + 'valeur').val();
					break;
			};
			lChampcomplementaire[this.id] = lChampComplementaire;
		});
		return lChampcomplementaire;
	};
	
	this.getFormChampcomplementaire = function(pChamp, pBanques, pAffiche) {
		var lChamp = clone(pChamp);
		$(lChamp).each(function() {
			switch(parseInt(this.id)) {
				case 2: // idBanque
					if(pBanques[this.valeur]) {
						this.attr = 'id-banque="' + this.valeur + '"';
						this.valeur = pBanques[this.valeur].nom;
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
		});
		
		lTypePaiementServiceTemplate = new TypePaiementServiceTemplate();
		var lTemplate = '';
		if(pAffiche == undefined) {
			lTemplate = lTypePaiementServiceTemplate.champComplementaire;
		} else {
			lTemplate = lTypePaiementServiceTemplate.champComplementaireAffiche;
		}
		
		return lTemplate.template({champComplementaire:lChamp});
	};
};