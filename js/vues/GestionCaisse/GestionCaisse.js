;function GestionCaisseVue(pParam) {	
	this.construct = function(pParam) {
		var that = this;
		var lParam = {'fonction':'etatCaisse'};
		$.post(	"./index.php?m=GestionCaisse&v=GestionCaisse", "pParam=" + $.toJSON(lParam),
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
				
		var lGestionCaisseTemplate = new GestionCaisseTemplate();
		
		var lHtml = lGestionCaisseTemplate.etatCaisseDebut;		
		if(lResponse.etat == 1) {
			lHtml += lGestionCaisseTemplate.caisseOuverte;
		} else {
			lHtml += lGestionCaisseTemplate.caisseFermee;			
		}
		
		lHtml += lGestionCaisseTemplate.etatCaisseMilieu;
		
		if(lResponse.etat == 1) {
			lHtml += lGestionCaisseTemplate.boutonFermeture;
		} else {
			lHtml += lGestionCaisseTemplate.boutonOuverture;			
		}
		
		lHtml += lGestionCaisseTemplate.etatCaisseFin;
		
		
		lHtml = $(lHtml);
		
		$('#contenu').replaceWith(that.affect(lHtml));	
	}
	
	this.affect = function(pData) {
		/*pData = this.nouveauSoldeNegatif(pData);
		pData = this.affectHover(pData);
		pData = this.affectEditionInfo(pData);*/
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	/*this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false}); 
		return pData;
	}
	
	this.nouveauSoldeNegatif = function(pData) {
		pData.find('.nouveau-solde-val').each(function() {
			if(parseFloat($(this).text().numberFrToDb()) < 0 ) {
				$(this).closest('.nouveau-solde').addClass("com-nombre-negatif");
			}
		});
		return pData;
	}
	
	this.soldeNegatif = function(pData) {
		pData.find('#solde').addClass("com-nombre-negatif");
		return pData;
	}
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	}
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.affectEditionInfo = function(pData) {		
		var that = this;
		pData.find('#btn-edt-info').click(function() {
			var lMonCompteTemplate = new MonCompteTemplate();
			var lTemplate = lMonCompteTemplate.dialogEditionCompte;
			
			var lDialog = $(lTemplate).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Valider': function() {
						that.changerMotPasse(this);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
			});
			lDialog.find(':input').keyup(function(event) {
				if (event.keyCode == '13') {
					that.changerMotPasse(lDialog);
				}
			});
		});
		
		return pData;
	}*/
	
	this.construct(pParam);
}