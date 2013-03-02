;function Infobulles() {
	this.init = function() {
		$(".com-infobulle").remove();
		$(".ui-state-error").removeClass("ui-state-error");
		$("#contenu_message_information").text("");
		$("#widget_message_information").hide();
	};
	
	this.generation = function(pData,pNomObj) {	
		var lMessageInformation = false;
		var lData = new Array();
		lData['membres'] = new Array();		
		if(!pData.valid) {
			for( i in pData) {
				if(i != 'valid') {
					if(pData[i].valid === false && pData[i].erreurs) {						
						var membre = new Array();
						membre['nom'] = pNomObj + i;
						
						membre['erreurs'] = new Array();
						for(err in pData[i].erreurs) {							
							var e = new Array();
							e['code'] =  pData[i].erreurs[err].code;
							if(String(e['code'])[0] == 3){lMessageInformation = true;} // Test si c'est un message d'information
							//e['code'] =  pNomObj + i;
							e['message'] = pData[i].erreurs[err].message;
							membre['erreurs'].push(e);
						}
						
						if(i == 'log' || $("#" + pNomObj + i ).length == 0) {
							/*var lDataTemp = new Array();
							lDataTemp['membres'] = new Array();	
							lDataTemp['membres'].push(membre);
							*/
							var lHtml = $("#contenu_message_information").html() + TemplateData.infobulleLog.template(membre);
							lHtml = $(lHtml);
							
							// Ajout des actions sur les infobulles
							if(lHtml.find('.action-ifb').size() > 0) {								
								var lAction = new ActionInfobulles();
								$(membre['erreurs']).each(function() {
									lHtml = lAction.affect(lHtml,this.code);									
								});								
							}							
							
							$("#contenu_message_information").html(lHtml);
							
							// Si il s'agit d'un message (code commence par 3) d'information il y a un autohide
							if(lMessageInformation) {
								$("#widget_message_information").delay(gTempsTransition).fadeIn(gTempsTransitionUnique).delay(gTempsTransitionMsgInfo).fadeOut(gTempsTransitionUnique);
							}
							// Message d'erreur classique
							else {
								$("#widget_message_information").delay(gTempsTransition).fadeIn(gTempsTransitionUnique);
							}							
						} else {						
							lData['membres'].push(membre);
							$("#" + pNomObj + i ).addClass('ui-state-error');
							Infobulle.afficher($("#" + pNomObj + i ));	
						}
					} else if (!(pData[i].valid === true) || (pData[i].valid === false && !pData[i].erreurs)) {
						this.generation(pData[i],pNomObj+i);
					}
				}
			}
		}	
		$('body').append(TemplateData.infobulle.template(lData));
	};
		
	this.generer = function(pData,pNomObj) {
		this.init();
		if(!pNomObj) {lNomObj = '';} else {lNomObj = pNomObj;}
		this.generation(pData,lNomObj);
	};
	
	this.afficher = function(pInput) {
		var infobulle = {};				
		function apparition() {
			var div = '#ifb-'+pInput.attr('id');
			infobulle = $(div);
			infobulle.hide();			
			var yOffset = pInput.height() + 8;
			var xOffset = pInput.width()/2;
			var pos = pInput.offset();
			var nPos = pos;
			nPos.top = pos.top + yOffset;
			nPos.left = pos.left + xOffset;
			
			// Change la position si l'infobulle dépasse du site
			var posSite = $("#site").offset();
			var nPosSite = posSite;
			
			if( (nPos.left + infobulle.width()) > (nPosSite.left + $("#site").width()) ) {nPos.left -= infobulle.width();}
			if( (nPos.top + infobulle.height()) > (nPosSite.top + $("#site").height()) ) {nPos.top -= (infobulle.height() + 2*pInput.height() + 8);}
						
			infobulle.css('position', 'absolute').css('z-index', '2000');
			infobulle.css(nPos).fadeIn(gTempsTransitionUnique);	
		}
		function disparition() { //infobulle.fadeOut(gTempsTransitionUnique);
			infobulle.stop().fadeTo(0,1).fadeOut(gTempsTransitionUnique);
		}
		
		pInput.hover( function() {apparition();}, function() {disparition();});
	};
}