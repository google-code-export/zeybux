;function CompteProducteurVue(pParam) {
	this.mIdProducteur = null;
	this.mPrdtNumero = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CompteProducteurVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=CompteProducteur", "pParam=" + $.toJSON(pParam),
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
	}	
	
	this.afficher = function(lResponse) {
		var that = this;
		
		this.mIdProducteur = lResponse.producteur.prdtId;
		this.mPrdtNumero = lResponse.producteur.prdtNumero;
		lResponse.producteur.prdtDateNaissance = lResponse.producteur.prdtDateNaissance.extractDbDate().dateDbToFr();
		
		$(lResponse.operationPassee).each(function() {
			this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
			if(this.tppType == null) {this.tppType ='';} // Si ce n'est pas un paiement il n'y a pas de type
			if(this.opeMontant < 0) {
				this.credit = (this.opeMontant * -1).nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
				this.debit = '';
			} else {
				this.credit = '';
				this.debit = this.opeMontant.nombreFormate(2,',',' ') + ' ' + gSigleMonetaire;
			}
		});
						
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lCommunTemplate = new CommunTemplate();
		
		var lHtml = lCommunTemplate.debutContenu;		
		lHtml += lGestionProducteurTemplate.infoCompteProducteur.template(lResponse.producteur);
		lHtml += lGestionProducteurTemplate.listeOperationProducteur.template(lResponse);
		lHtml += lCommunTemplate.finContenu;		
		lHtml = $(lHtml);
				
		// Ne pas afficher la pagination si il y a moins de 10 éléments
		if(lResponse.operationPassee.length < 11) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}		

		$('#contenu').replaceWith(that.affect(lHtml));	
	}
	
	this.affect = function(pData) {
		pData = this.affectHover(pData);
		pData = this.affectLienModifier(pData);
		pData = this.affectDialogSuppProducteur(pData);
		pData = gCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.paginnation = function(pData) {
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
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	}
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	}
		
	this.affectLienModifier = function(pData) {
		var that = this;
		pData.find('#btn-edt').click(function() {			
			ModificationProducteurVue({id_producteur:that.mIdProducteur});
		});
		return pData;
	}
	
	this.affectDialogSuppProducteur = function(pData) {		
		var that = this;
		pData.find('#btn-supp')
		.click(function() {
			var lGestionProducteurTemplate = new GestionProducteurTemplate();
			var lTemplate = lGestionProducteurTemplate.dialogSuppressionProducteur;
			
			$(lTemplate.template({prdtNumero:that.mPrdtNumero})).dialog({
				autoOpen: true,
				modal: true,
				draggable: false,
				resizable: false,
				width:600,
				buttons: {
					'Supprimer': function() {
						var lParam = {id_producteur:that.mIdProducteur};
						var lDialog = this;
						$.post(	"./index.php?m=GestionProducteur&v=SuppressionProducteur", "pParam=" + $.toJSON(lParam),
								function(lResponse) {
									Infobulle.init(); // Supprime les erreurs
									if(lResponse) {
										if(lResponse.valid) {
											var lGestionProducteurTemplate = new GestionProducteurTemplate();
											var lTemplate = lGestionProducteurTemplate.supprimerProducteurSucces;
											$('#contenu').replaceWith(lTemplate.template(lResponse));
											$(lDialog).dialog('close');
										} else {
											Infobulle.generer(lResponse,'');
										}
									}
								},"json"
						);
					},
					'Annuler': function() {
						$(this).dialog('close');
					}
				},
				close: function(ev, ui) { $(this).remove(); }
			});
		});
		return pData;
	}
		
	this.construct(pParam);
}