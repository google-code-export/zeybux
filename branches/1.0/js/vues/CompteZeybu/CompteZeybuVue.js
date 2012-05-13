;function CompteZeybuVue(pParam) {
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CompteZeybuVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=CompteZeybu&v=CompteZeybu", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;
		
		if(lResponse.soldeTotal != null) {
			lResponse.soldeTotal = lResponse.soldeTotal.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeTotal = '0'.nombreFormate(2,',',' ');
		}
		if(lResponse.soldeCaisse != null) {
			lResponse.soldeCaisse = lResponse.soldeCaisse.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeCaisse = '0'.nombreFormate(2,',',' ');
		}
		if(lResponse.soldeBanque != null) {
			lResponse.soldeBanque = lResponse.soldeBanque.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeBanque = '0'.nombreFormate(2,',',' ');
		}
		if(lResponse.soldeSolidaire != null) {
			lResponse.soldeSolidaire = lResponse.soldeSolidaire.nombreFormate(2,',',' ');
		} else {
			lResponse.soldeSolidaire = '0'.nombreFormate(2,',',' ');
		}
		
		lResponse.sigleMonetaire = gSigleMonetaire;
		
		$(lResponse.operation).each(function() {
			if(this.opeDate != null) {
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
				if(this.opeMontant < 0) {
					this.debit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
					this.credit = '';
				} else {
					this.debit = '';
					this.credit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				}
			}
		});

		var lCompteZeybuTemplate = new CompteZeybuTemplate();
		if(lResponse.operation.length > 0 && lResponse.operation[0].opeId != null) {
			var lTemplate = lCompteZeybuTemplate.InfoCompte;
			
			var lHtml = $(lTemplate.template(lResponse));

			// Ne pas afficher la pagination si il y a moins de 30 éléments
			if(lResponse.operation.length < 31) {
				lHtml = this.masquerPagination(lHtml);
			} else {
				lHtml = this.paginnation(lHtml);
			}
			
			$('#contenu').replaceWith(that.affect(lHtml));
		} else {
			var lTemplate = lCompteZeybuTemplate.listeOperationVide;
			$('#contenu').replaceWith(lTemplate.template(lResponse));
		}
	};
	
	this.affect = function(pData) {
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	};
	
	this.paginnation = function(pData) {
		pData.find("#table-operation")
			.tablesorter({headers: { 
				0: {sorter: false},
	            1: {sorter: false},
	            2: {sorter: false},
	            3: {sorter: false},
	            4: {sorter: false} 
	        } })
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false,size:30}); 
		return pData;
	};
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	};
	
	this.construct(pParam);
}