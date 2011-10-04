;function GestionProducteurTemplate() {
	this.formulaireAjoutProducteur =
		"<div id=\"contenu\">" +
			"<div id=\"formulaire_ajout_producteur\">" +
				"<form>" +
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Information du producteur</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nom *</th>" +
									"<td class=\"com-table-form-td\">" +
										"<input type=\"hidden\" name=\"{NAME_ID}\" value=\"{VALUE_ID}\" />" +
										"<input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" value=\"{nom}\" maxlength=\"50\" id=\"nom\"/>" +
									"</td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Prénom *</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"prenom\" value=\"{prenom}\" maxlength=\"50\" id=\"prenom\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Date de Naissance (jj/mm/aaaa)</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"date_naissance\" value=\"{dateNaissance}\" maxlength=\"10\" id=\"dateNaissance\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Lier un compte<input type=\"checkbox\" name=\"lien_numero_compte\" /></th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"numero_compte\" value=\"{compte}\" maxlength=\"5\" disabled=\"disabled\" id=\"compte\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Commentaire</th>" +
									"<td class=\"com-table-form-td\"><textarea class=\"com-input-text ui-widget-content ui-corner-all\" name=\"commentaire\" id=\"commentaire\">{commentaire}</textarea></td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
					
					"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
						"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées du producteur</div>" +
						"<div class=\"com-widget-content\">" +
							"<table class=\"com-table-form\">" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Courriel Principal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"courriel_principal\" value=\"{courrielPrincipal}\" maxlength=\"100\" id=\"courrielPrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Courriel Secondaire</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" ype=\"text\" name=\"courriel_secondaire\" value=\"{courrielSecondaire}\" maxlength=\"100\" id=\"courrielSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Téléphone Principal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_principal\" value=\"{telephonePrincipal}\" maxlength=\"20\" id=\"telephonePrincipal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Téléphone Secondaire</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_secondaire\" value=\"{telephoneSecondaire}\" maxlength=\"20\" id=\"telephoneSecondaire\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Adresse</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"adresse\" value=\"{adresse}\" maxlength=\"300\" id=\"adresse\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Code Postal</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"code_postal\" value=\"{codePostal}\" maxlength=\"10\" id=\"codePostal\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Ville</th>" +
									"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"text\" name=\"ville\" value=\"{ville}\" maxlength=\"100\" id=\"ville\"/></td>" +
								"</tr>" +
								"<tr>" +
									"<td colspan=\"2\" class=\"com-center com-ligne-submit\">" +
										"<input class=\"ui-state-default ui-corner-all com-button com-center\" type=\"submit\" value=\"Valider\" />" +
									"</td>" +
								"</tr>" +
							"</table>" +
						"</div>" +
					"</div>" +
				"</form>" +
			"</div>" +
		"</div>";
	
	this.ajoutProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Nouveau Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été ajouté avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.modifierProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Modification d'un Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été mis à jour avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.supprimerProducteurSucces = 
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Suppression d'un Producteur" +				
				"</div>" +
				"<div class=\"com-widget-content\">" +
					"<p class=\"com-msg-confirm-icon\" ><span class=\"com-float-left ui-icon ui-icon-check\"></span>Le producteur {numero} a été supprimé avec succès.</p>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeProducteur = 
		"<div id=\"contenu\">" +
			"<div>" +			
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Producteurs</div>" +
						"<div id=\"liste-adh-recherche\" class=\"recherche com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
							"<form id=\"filter-form\">" +
								"<div>" +
									"<span class=\"conteneur-icon com-float-left ui-widget-content ui-corner-left\" title=\"Chercher\">" +
											"<span class=\"ui-icon ui-icon-search\">" +
										"</span>" +
									"</span>" +
									"<input class=\"com-input-text ui-widget-content ui-corner-right\" name=\"filter\" id=\"filter\" value=\"\" maxlength=\"30\" size=\"15\" type=\"text\" />" +
								"</div>" +
							"</form>" +
						"</div>" +
						"<table class=\"com-table\">" +
							"<thead>" +
								"<tr class=\"ui-widget ui-widget-header\">" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-num com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>N°</th>" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Nom</th>" +
									"<th class=\"com-table-th com-underline-hover liste-adh-th-nom com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Prénom</th>" +
									"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Courriel</th>" +
									"<th class=\"com-table-th com-underline-hover com-cursor-pointer\"><span class=\"ui-icon span-icon\"></span>Téléphone</th>" +
								"</tr>" +
							"</thead>" +
							"<tbody>" +
						"<!-- BEGIN listeProducteur -->" +
								"<tr class=\"com-cursor-pointer compte-ligne\" >" +
									"<td class=\"com-table-td com-underline-hover\"><span class=\"ui-helper-hidden id-producteur\">{listeProducteur.prdtId}</span>{listeProducteur.prdtNumero}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtNom}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtPrenom}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtCourrielPrincipal}</td>" +
									"<td class=\"com-table-td com-underline-hover\">{listeProducteur.prdtTelephonePrincipal}</td>" +
								"</tr>" +
						"<!-- END listeProducteur -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeProducteurVide =
		"<div id=\"contenu\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Les Producteurs</div>" +
				"<p id=\"texte-liste-vide\">Aucun producteur dans la base.</p>" +	
			"</div>" +
		"</div>";
	
	this.dialogSuppressionProducteur = 
		"<div id=\"dialog-supp-prdt\" title=\"Supprimer le producteur {prdtNumero}\">" +
			"<p class=\"ui-state-error ui-corner-all\"><span class=\"ui-icon ui-icon-alert com-float-left\"></span>ATTENTION : Voulez-vous réellement supprimer le producteur : {prdtNumero}</p>" +
		"</div>";
	
	this.infoCompteProducteur = 
		"<div id=\"info_compte_solde_adherent_ext\">" +
			"<div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Informations" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer\" id=\"btn-supp\" title=\"Supprimer\">" +
							"<span class=\"ui-icon ui-icon-trash\">" +
							"</span>" +
						"</span>" +
						"<span class=\"com-btn-header-multiples ui-widget-content ui-corner-all com-cursor-pointer\" id=\"btn-edt\" title=\"Modifier\">" +
							"<span class=\"ui-icon ui-icon-pencil\">" +
							"</span>" +
						"</span>" +
					"</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Numéro du producteur : {prdtNumero}</div>" +
						"<div>Numéro de Compte : {cptLabel}</div>" +
						"<div>Nom : {prdtNom}</div>" +
						"<div>Prénom : {prdtPrenom}</div>" +
						"<div>Date de naissance : {prdtDateNaissance}</div>" +
						"<div>Commentaire : {prdtCommentaire}</div>" +
					"</div>" +
				"</div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
					"<div class=\"com-widget-content\">" +
						"<div>Courriel Principal : {prdtCourrielPrincipal}</div>" +
						"<div>Courriel Secondaire : {prdtCourrielSecondaire}</div>" +
						"<div>Téléphone Principal : {prdtTelephonePrincipal}</div>" +
						"<div>Téléphone Secondaire : {prdtTelephoneSecondaire}</div>" +
						"<div>Adresse : {prdtAdresse}</div>" +				
						"<div>Ville : {prdtVille}</div>" +
						"<div>Code Postal : {prdtCodePostal}</div>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	
	this.listeOperationProducteur = 
		"<div id=\"liste_operation_adherent_ext\">" +
			"<div>" +
				"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
					"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Liste des Opérations</span></div>	" +	
					"<div>" +				
						"<div id=\"content-nav-liste-operation\" class=\"ui-helper-clearfix ui-state-default ui-corner-all\">" +	
							"<form>" +	
							"	<span id=\"icone-nav-liste-operation-w\" class=\"prev ui-helper-hidden ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-w\"></span></span>" +
							"	<span id=\"page-compteur\">Page : <span type=\"text\" class=\"pagedisplay\"></span></span>" +
							"	<span id=\"icone-nav-liste-operation-e\" class=\"next ui-state-default ui-corner-all com-button\" ><span class=\"ui-icon ui-icon-circle-arrow-e\"></span></span>" +
							"	<input type=\"hidden\" class=\"pagesize\" value=\"10\">" +
							"</form>" +	
						"</div>" +	
			
						"<table id=\"table-operation\" class=\"com-table\">" +
							"<thead>" +
							"<tr class=\"ui-widget ui-widget-header\" >" +
								"<th class=\"com-table-th\">Date</th>" +
								"<th class=\"com-table-th\">Libellé</th>" +
								"<th class=\"com-table-th\">Type de paiement</th>" +
								"<th class=\"com-table-th\">Débit</th>" +
								"<th class=\"com-table-th\">Crédit</th>" +
							"</tr>" +
							"</thead>" +
							"<tbody>" +
						"<!-- BEGIN operationPassee -->" +
							"<tr>" +
								"<td class=\"com-table-td td-date \">{operationPassee.opeDate}</td>" +
								"<td class=\"com-table-td td-libelle\">{operationPassee.opeLibelle}</td>" +
								"<td class=\"com-table-td td-type-paiement\">{operationPassee.tppType}</td>" +
								"<td class=\"com-table-td td-montant\">{operationPassee.debit}</td>" +
								"<td class=\"com-table-td td-montant\">{operationPassee.credit}</td>" +
							"</tr>" +
						"<!-- END operationPassee -->" +
							"</tbody>" +
						"</table>" +
					"</div>" +
				"</div>";
			"</div>" +
		"</div>";
};function ListeProducteurVue(pParam) {
	this.construct = function(pParam) {
		$.history( {'vue':function() {ListeProducteurVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=ListeProducteur", 
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
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		
		if(lResponse.listeProducteur.length > 0 && lResponse.listeProducteur[0].prdtId != null) {
			var lTemplate = lGestionProducteurTemplate.listeProducteur;
						
			$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
		} else {
			$('#contenu').replaceWith(lGestionProducteurTemplate.listeProducteurVide);
		}
		
	}
	
	this.affect = function(pData) {
		pData = this.affectTri(pData);
		pData = this.affectRecherche(pData);
		pData = this.affectLienCompte(pData);
		return pData;
	}
		
	this.affectTri = function(pData) {
		pData.find('.com-table').tablesorter({sortList: [[0,0]]});
		return pData;
	}
	
	this.affectRecherche = function(pData) {
		pData.find("#filter").keyup(function() {
		    $.uiTableFilter( $('.com-table'), this.value );
		  });
		
		pData.find("#filter-form").submit(function () {return false;});
		
		return pData;
	}
			
	this.affectLienCompte = function(pData) {
		var that = this;
		pData.find(".compte-ligne").click(function() {
			CompteProducteurVue({id_producteur: $(this).find(".id-producteur").text()});
		});
		return pData;
	}
	
	this.construct(pParam);
};function CompteProducteurVue(pParam) {
	this.mIdProducteur = null;
	this.mPrdtNumero = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {CompteProducteurVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=CompteProducteur", "pParam=" + $.toJSON(pParam),
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
									if(lResponse.valid) {
										var lGestionProducteurTemplate = new GestionProducteurTemplate();
										var lTemplate = lGestionProducteurTemplate.supprimerProducteurSucces;
										$('#contenu').replaceWith(lTemplate.template(lResponse));
										$(lDialog).dialog('close');
									} else {
										Infobulle.generer(lResponse,'');
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
};function ModificationProducteurVue(pParam) {
	this.mCommunVue = new CommunVue();
	this.mIdProducteur = null;
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {ModificationProducteurVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=GestionProducteur&v=ModificationProducteur", "pParam=" + $.toJSON(pParam),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						if(pParam && pParam.vr) {
							Infobulle.generer(pParam.vr,'');
						}
						that.mIdProducteur = pParam.id_producteur;
						that.afficher(lResponse);
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
		);
	}
	
	this.afficher = function(lResponse) {
		var that = this;
		lResponse.dateNaissance = lResponse.dateNaissance.extractDbDate().dateDbToFr();	
		
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lTemplate = lGestionProducteurTemplate.formulaireAjoutProducteur;
		var lHtml = lTemplate.template(lResponse);
		$('#contenu').replaceWith(that.affect($(lTemplate.template(lResponse))));
	}
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.boutonLienCompte = function(pData) {		
		pData.find(":input[name=lien_numero_compte]").click(function() {
			if(pData.find(":input[name=numero_compte]").attr("disabled")) {
				pData.find(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				pData.find(":input[name=numero_compte]").attr("disabled","disabled");				
			}			
		});
		return pData;
	}	
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comDatepicker('dateNaissance',pData);
		pData.find('#dateNaissance').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	}
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.modifProducteur();
			return false;
		});
		return pData;
	}
	
	this.modifProducteur = function() {
		var lVo = new ProducteurVO();
		lVo.id = this.mIdProducteur;
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.compte = $(':input[name=numero_compte]').val();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validUpdate(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'Producteur
			$.post(	"./index.php?m=GestionProducteur&v=ModificationProducteur", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionProducteurTemplate = new GestionProducteurTemplate();
						var lTemplate = lGestionProducteurTemplate.modifierProducteurSucces;
						$('#contenu').replaceWith(lTemplate.template(lResponse));						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
};function AjoutProducteurVue(pParam) {
	this.mCommunVue = new CommunVue();
	
	this.construct = function(pParam) {	
		$.history( {'vue':function() {AjoutProducteurVue(pParam);}} );
		if(pParam && pParam.vr) {
			Infobulle.generer(pParam.vr,'');
		}
		this.afficher();
	}
	
	this.afficher = function() {
		var that = this;			
		var lGestionProducteurTemplate = new GestionProducteurTemplate();
		var lTemplate = lGestionProducteurTemplate.formulaireAjoutProducteur;
		$('#contenu').replaceWith(that.affect($(lTemplate.template())));
	}
	
	this.affect = function(pData) {
		pData = this.boutonLienCompte(pData);
		pData = this.mCommunVue.comNumeric(pData);
		pData = this.affectControleDatepicker(pData);
		pData = this.affectSubmit(pData);
		pData = this.mCommunVue.comHoverBtn(pData);
		return pData;
	}
	
	this.boutonLienCompte = function(pData) {		
		pData.find(":input[name=lien_numero_compte]").click(function() {
			if(pData.find(":input[name=numero_compte]").attr("disabled")) {
				pData.find(":input[name=numero_compte]").removeAttr("disabled");
			} else {
				pData.find(":input[name=numero_compte]").attr("disabled","disabled").val("");				
			}			
		});
		return pData;
	}	
	
	this.affectControleDatepicker = function(pData) {
		pData = this.mCommunVue.comDatepicker('dateNaissance',pData);
		pData.find('#dateNaissance').datepicker( "option", "yearRange", '1900:c' );
		return pData;
	}
	
	this.affectSubmit = function(pData) {	
		var that = this;
		pData.find('form').submit(function() {
			that.ajoutProducteur();
			return false;
		});
		return pData;
	}
	
	this.ajoutProducteur = function() {
		var lVo = new ProducteurVO();
		
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.compte = $(':input[name=numero_compte]').val();
		lVo.commentaire = $(':input[name=commentaire]').val();
		
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		
		var lValid = new ProducteurValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {
			Infobulle.init(); // Supprime les erreurs
			// Ajout du Producteur
			$.post(	"./index.php?m=GestionProducteur&v=AjoutProducteur", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse.valid) {	
						var lGestionProducteurTemplate = new GestionProducteurTemplate();
						var lTemplate = lGestionProducteurTemplate.ajoutProducteurSucces;
						$('#contenu').replaceWith(lTemplate.template(lResponse));						
					} else {
						Infobulle.generer(lResponse,'');
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	}
	
	this.construct(pParam);
}