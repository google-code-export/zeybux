;function MonCompteTemplate() {
	this.infoCompteAdherent = 
	"<div id=\"info_compte_solde_adherent_ext\">" +
		"<div id=\"info_compte_solde_adherent_int\">" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">" +
					"Informations" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all edt-info-compte\" id=\"btn-edt-compte\" title=\"Modifier les informations\">" +
						"<span class=\"ui-icon ui-icon-pencil\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all edt-info-compte\" id=\"btn-edt-pass\" title=\"Changer le mot de passe\">" +
						"<span class=\"ui-icon ui-icon-key\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden edt-info-compte\" id=\"btn-edt-annuler\" title=\"Annuler\">" +
						"<span class=\"ui-icon ui-icon-closethick\"></span>" +
					"</span>" +
					"<span class=\"com-cursor-pointer com-btn-header-multiples ui-widget-content ui-corner-all ui-helper-hidden edt-info-compte\" id=\"btn-edt-valider\" title=\"Valider\">" +
						"<span class=\"ui-icon ui-icon-check\"></span>" +
					"</span>" +
				"</div>" +
				"<div class=\"com-widget-content edt-info-compte\">" +
					"<div>{adhNumero} : <span id=\"adh-prenom\">{adhPrenom}</span> <span id=\"adh-nom\">{adhNom}</span></div>" +
					"<div>Compte : {cptLabel}</div>" +
					"<div>Date de naissance : <span id=\"adh-date-naissance\">{adhDateNaissance}</span></div>" +
					"<div>Date d'adhésion : {adhDateAdhesion}</div>" +
					"<div>Commentaire : <span id=\"adh-commentaire\">{adhCommentaire}</span></div>" +
				"</div>" +
				"<div class=\"ui-helper-hidden edt-info-compte\">" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Nom *</th>" +
							"<td class=\"com-table-form-td\">" +
								"<input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"nom\" value=\"\" maxlength=\"50\" id=\"nom\"/>" +
							"</td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Prénom *</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"prenom\" value=\"\" maxlength=\"50\" id=\"prenom\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Date de Naissance<br/>(jj/mm/aaaa)</th>" +
							"<td class=\"com-table-form-td\"><input type=\"hidden\" name=\"date_adhesion\" value=\"{adhDateAdhesion}\" /><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"date_naissance\" value=\"\" maxlength=\"10\" id=\"dateNaissance\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Commentaire</th>" +
							"<td class=\"com-table-form-td\"><textarea class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" name=\"commentaire\" id=\"commentaire\"></textarea></td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
			"</div>" +
			"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
				"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Coordonnées</div>" +
				"<div class=\"com-widget-content edt-info-compte\">" +
					"<div>Courriel 1 : <span id=\"adh-courriel-principal\">{adhCourrielPrincipal}</span></div>" +
					"<div>Courriel 2 : <span id=\"adh-courriel-secondaire\">{adhCourrielSecondaire}</span></div>" +
					"<div>Téléphone 1 : <span id=\"adh-telephone-principal\">{adhTelephonePrincipal}</span></div>" +
					"<div>Téléphone 2 : <span id=\"adh-telephone-secondaire\">{adhTelephoneSecondaire}</span></div>" +
					"<div>Adresse : " +
						"<div><span id=\"adh-adresse\">{adhAdresse}</span> <br/>" +
						"<span id=\"adh-code-postal\">{adhCodePostal}</span> <span id=\"adh-ville\">{adhVille}</span></div>" +
					"</div>" +
				"</div>" +
				
				"<div class=\"ui-helper-hidden com-widget-content edt-info-compte\">" +
					"<table class=\"com-table-form\">" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Courriel 1</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"courriel_principal\" value=\"\" maxlength=\"100\" id=\"courrielPrincipal\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Courriel 2</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" ype=\"text\" name=\"courriel_secondaire\" value=\"\" maxlength=\"100\" id=\"courrielSecondaire\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Téléphone 1</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_principal\" value=\"\" maxlength=\"20\" id=\"telephonePrincipal\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Téléphone 2</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"telephone_secondaire\" value=\"\" maxlength=\"20\" id=\"telephoneSecondaire\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Adresse</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"adresse\" value=\"\" maxlength=\"300\" id=\"adresse\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Code Postal</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"code_postal\" value=\"\" maxlength=\"10\" id=\"codePostal\"/></td>" +
						"</tr>" +
						"<tr>" +
							"<th class=\"com-table-form-th\">Ville</th>" +
							"<td class=\"com-table-form-td\"><input class=\"com-input-text input-edt-compte ui-widget-content ui-corner-all\" type=\"text\" name=\"ville\" value=\"\" maxlength=\"100\" id=\"ville\"/></td>" +
						"</tr>" +
					"</table>" +
				"</div>" +
				
			"</div>" +
		"</div>" +
	"</div>";
	
	this.dialogEditionPass =
		"<div id=\"dialog-edt-info-cpt\" title=\"Modifier mon mot de passe\" class=\"formulaire_identification\">" +
			"<form>" +
				"<table>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Ancien mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass\" maxlength=\"100\" id=\"motPasse\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Nouveau mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_nouveau\" maxlength=\"100\" id=\"motPasseNouveau\"/></td>" +
					"</tr>" +
					"<tr>" +
						"<th class=\"com-table-form-th ui-widget-content ui-corner-all\">Resaisir le mot de Passe *</th>" +
						"<td class=\"com-table-form-td\"><input class=\"com-input-text ui-widget-content ui-corner-all\" type=\"password\" name=\"pass_confirm\" maxlength=\"100\" id=\"motPasseConfirm\"/></td>" +
					"</tr>" +
				"</table>" +
			"</form>" +
		"</div>";
	this.listeOperationPassee = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Solde : <span id=\"solde\">{cptSolde} {sigleMonetaire}</span></div>	" +	
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
	
	this.listeOperationAdherentDebut = 
	"<div id=\"liste_operation_adherent_ext\">" +
		"<div id=\"liste_operation_adherent_int\">";
			
	this.listeOperationAdherentFin = 		
		"</div>" +
	"</div>";	
	
	this.listeOperationAvenir = 
		"<div class=\"com-widget-window ui-widget ui-widget-content ui-corner-all\">" +
			"<div class=\"com-widget-header ui-widget ui-widget-header ui-corner-all\">Achat(s) Futur(s)</div>" +
			"<div>" +
				"<table class=\"com-table\">" +
					"<tr class=\"ui-widget ui-widget-header\" >" +
						"<th class=\"com-table-th\">Réservation</th>" +
						"<th class=\"com-table-th\">Libellé</th>" +
						"<th class=\"com-table-th\">Marché</th>" +
						"<th class=\"com-table-th\">Prix</th>" +
						"<th class=\"com-table-th\">Solde</th>" +
						"<th class=\"com-table-th\">Recharger</th>" +
					"</tr>" +
				"<!-- BEGIN operationAvenir -->" +
					"<tr>" +
						"<td class=\"com-table-td td-date\">{operationAvenir.opeDate}</td>" +
						"<td class=\"com-table-td td-libelle \">{operationAvenir.opeLibelle}</td>" +
						"<td class=\"com-table-td td-date\">{operationAvenir.comDateMarche}</td>" +
						"<td class=\"com-table-td td-montant\">{operationAvenir.opeMontant}  {sigleMonetaire}</td>" +
						"<td class=\"com-table-td td-montant\"><span class=\"nouveau-solde\"><span class=\"nouveau-solde-val\">{operationAvenir.nouveauSolde}</span>  {sigleMonetaire}</span></td>" +
						"<td class=\"com-table-td td-montant\">{operationAvenir.rechargement}  {sigleMonetaire}</td>" +
					"</tr>" +
				"<!-- END operationAvenir -->" +
				"</table>" +
			"</div>" +
		"</div>";	
};function MonCompteVue(pParam) {
	this.mInformationAdherent = {};
	this.construct = function(pParam) {
		$.history( {'vue':function() {MonCompteVue(pParam);}} );
		var that = this;
		$.post(	"./index.php?m=MonCompte&v=MonCompte", 
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
							
							// Maj du Menu
							//var lCommunVue = new CommunVue();
							gCommunVue.majMenu('MonCompte','MonCompte');
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
		);
	};
	
	this.afficher = function(lResponse) {
		var that = this;
		
		if(lResponse.adherent.adhId == null) { //SuperZeybu
			lResponse.adherent.opeMontant = 0;
			lResponse.adherent.adhDateNaissance = '0000-00-00';
			lResponse.adherent.adhDateAdhesion = '0000-00-00';
		}
		lResponse.cptSolde = lResponse.adherent.cptSolde.nombreFormate(2,',',' ');
		
		lResponse.sigleMonetaire = gSigleMonetaire;

		lResponse.adherent.adhDateNaissance = lResponse.adherent.adhDateNaissance.extractDbDate().dateDbToFr();
		lResponse.adherent.adhDateAdhesion = lResponse.adherent.adhDateAdhesion.extractDbDate().dateDbToFr();
		
		this.mInformationAdherent.nom = lResponse.adherent.adhNom;
		this.mInformationAdherent.prenom = lResponse.adherent.adhPrenom;
		this.mInformationAdherent.courrielPrincipal = lResponse.adherent.adhCourrielPrincipal;
		this.mInformationAdherent.courrielSecondaire = lResponse.adherent.adhCourrielSecondaire;
		this.mInformationAdherent.telephonePrincipal = lResponse.adherent.adhTelephonePrincipal;
		this.mInformationAdherent.telephoneSecondaire = lResponse.adherent.adhTelephoneSecondaire;
		this.mInformationAdherent.adresse = lResponse.adherent.adhAdresse;
		this.mInformationAdherent.codePostal = lResponse.adherent.adhCodePostal;
		this.mInformationAdherent.ville = lResponse.adherent.adhVille;
		this.mInformationAdherent.dateNaissance = lResponse.adherent.adhDateNaissance;
		this.mInformationAdherent.dateAdhesion = lResponse.adherent.adhDateAdhesion;
		this.mInformationAdherent.commentaire = lResponse.adherent.adhCommentaire;

		$(lResponse.operationPassee).each(function() {
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
		
		var lNvSolde = parseFloat(lResponse.adherent.cptSolde);
		var lRechargementPrecedent = 0;
		$(lResponse.operationAvenir).each(function() {
			if(this.opeDate != null) {
				lNvSolde += parseFloat(this.opeMontant);
				this.nouveauSolde = lNvSolde.nombreFormate(2,',',' ');
				this.rechargement = (0).nombreFormate(2,',',' ');				
				var lSoldeCible = 5;
				if(lNvSolde < lSoldeCible) {
					this.rechargement = (Math.ceil((lSoldeCible-lNvSolde)/lSoldeCible) * lSoldeCible) - lRechargementPrecedent;
				}
				lRechargementPrecedent += this.rechargement;
				this.rechargement = this.rechargement.nombreFormate(2,',',' ');
				
				this.opeDate = this.opeDate.extractDbDate().dateDbToFr();
				this.comDateMarche = this.comDateMarche.extractDbDate().dateDbToFr();
				this.opeMontant = (this.opeMontant * -1).nombreFormate(2,',',' ');
			}
		});
				
		var lMonCompteTemplate = new MonCompteTemplate();
		var lCommunTemplate = new CommunTemplate();
		//var lTemplate = lMonCompteTemplate.monCompte;
		
		var lHtml = lCommunTemplate.debutContenu;		
		lHtml += lMonCompteTemplate.infoCompteAdherent.template(lResponse.adherent);
		lHtml += lMonCompteTemplate.listeOperationAdherentDebut.template(lResponse);
		lHtml += lMonCompteTemplate.listeOperationPassee.template(lResponse);
		// Affiche des opérations avenir uniquement si elles existent
		if(isArray(lResponse.operationAvenir) && lResponse.operationAvenir[0].opeLibelle != null) {
			lHtml += lMonCompteTemplate.listeOperationAvenir.template(lResponse);
		}
		lHtml += lMonCompteTemplate.listeOperationAdherentFin.template(lResponse);
		lHtml += lCommunTemplate.finContenu;
		
		lHtml = $(lHtml);
		if(lResponse.adherent.cptSolde < 0) {
			lHtml = this.soldeNegatif(lHtml);
		}
		
		// Ne pas afficher la pagination si il y a moins de 10 éléments
		if(lResponse.operationPassee.length < 11) {
			lHtml = this.masquerPagination(lHtml);
		} else {
			lHtml = this.paginnation(lHtml);
		}		

		$('#contenu').replaceWith(that.affect(lHtml));	
	};
	
	this.affect = function(pData) {
		pData = this.nouveauSoldeNegatif(pData);
		pData = this.affectHover(pData);
		pData = this.affectEditionPass(pData);
		pData = this.affectEditionCompte(pData);
		pData = this.affectDate(pData);
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
			.tablesorterPager({container: pData.find("#content-nav-liste-operation"),positionFixed:false}); 
		return pData;
	};
	this.nouveauSoldeNegatif = function(pData) {
		pData.find('.nouveau-solde-val').each(function() {
			if(parseFloat($(this).text().numberFrToDb()) < 0 ) {
				$(this).closest('.nouveau-solde').addClass("com-nombre-negatif");
			}
		});
		return pData;
	};
	
	this.soldeNegatif = function(pData) {
		pData.find('#solde').addClass("com-nombre-negatif");
		return pData;
	};
	
	this.affectHover = function(pData) {
		pData.find('#icone-nav-liste-operation-w,#icone-nav-liste-operation-e').hover(function() {$(this).addClass("ui-state-hover");},function() {$(this).removeClass("ui-state-hover");});
		return pData;
	};
	
	this.masquerPagination = function(pData) {
		pData.find('#content-nav-liste-operation').hide();
		return pData;
	};
	
	this.affectDate = function(pData) {
		var that = this;
		pData.find('#dateNaissance').datepicker({
			changeMonth: true,
			changeYear: true,
			maxDate:that.mInformationAdherent.dateAdhesion,
			yearRange:'1900:c'});
		return pData;
	};
	
	this.affectEditionCompte = function(pData) {		
		var that = this;
		pData.find('#btn-edt-compte').click(function() {
			Infobulle.init(); // Supprime les erreurs
			$(':input[name=nom]').val(htmlDecode(that.mInformationAdherent.nom));
			$(':input[name=prenom]').val(htmlDecode(that.mInformationAdherent.prenom));
			$(':input[name=courriel_principal]').val(htmlDecode(that.mInformationAdherent.courrielPrincipal));
			$(':input[name=courriel_secondaire]').val(htmlDecode(that.mInformationAdherent.courrielSecondaire));
			$(':input[name=telephone_principal]').val(htmlDecode(that.mInformationAdherent.telephonePrincipal));
			$(':input[name=telephone_secondaire]').val(htmlDecode(that.mInformationAdherent.telephoneSecondaire));
			$(':input[name=adresse]').val(htmlDecode(that.mInformationAdherent.adresse));
			$(':input[name=code_postal]').val(htmlDecode(that.mInformationAdherent.codePostal));
			$(':input[name=ville]').val(htmlDecode(that.mInformationAdherent.ville));
			$(':input[name=date_naissance]').val(htmlDecode(that.mInformationAdherent.dateNaissance));
			$(':input[name=commentaire]').html(that.mInformationAdherent.commentaire);
			
			$('.edt-info-compte').toggle();
		});
		
		pData.find('#btn-edt-annuler').click(function() {
			$('.edt-info-compte').toggle();
		});
				
		pData.find('#btn-edt-valider').click(function() {
			that.modifInformation();
		});
		
		return pData;
	};
	
	this.affectEditionPass = function(pData) {		
		var that = this;
		pData.find('#btn-edt-pass').click(function() {
			var lMonCompteTemplate = new MonCompteTemplate();
			var lTemplate = lMonCompteTemplate.dialogEditionPass;
			
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
	};
	
	this.modifInformation = function() {
		var that = this;
		
		var lVo = new AdherentVO();
		lVo.nom = $(':input[name=nom]').val();
		lVo.prenom = $(':input[name=prenom]').val();
		lVo.courrielPrincipal = $(':input[name=courriel_principal]').val();
		lVo.courrielSecondaire = $(':input[name=courriel_secondaire]').val();
		lVo.telephonePrincipal = $(':input[name=telephone_principal]').val();
		lVo.telephoneSecondaire = $(':input[name=telephone_secondaire]').val();
		lVo.adresse = $(':input[name=adresse]').val();
		lVo.codePostal = $(':input[name=code_postal]').val();
		lVo.ville = $(':input[name=ville]').val();
		lVo.dateNaissance = $(':input[name=date_naissance]').val().dateFrToDb();
		lVo.dateAdhesion = $(':input[name=date_adhesion]').val().dateFrToDb();
		lVo.commentaire = $(':input[name=commentaire]').val();

		if(lVo.dateAdhesion == "") {
			lVo.dateAdhesion = getDateAujourdhuiDb();
		}
		
		var lValid = new AdherentValid();
		var lVr = lValid.validUpdateInformation(lVo);
		
		if(lVr.valid) {

			lVo.fonction = "information";
			Infobulle.init(); // Supprime les erreurs
			// Ajout de l'adherent
			$.post(	"./index.php?m=MonCompte&v=ModifierMonCompte", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {
							
							that.mInformationAdherent.nom = lVo.nom;
							that.mInformationAdherent.prenom = lVo.prenom;
							that.mInformationAdherent.courrielPrincipal = lVo.courrielPrincipal;
							that.mInformationAdherent.courrielSecondaire = lVo.courrielSecondaire;
							that.mInformationAdherent.telephonePrincipal = lVo.telephonePrincipal;
							that.mInformationAdherent.telephoneSecondaire = lVo.telephoneSecondaire;
							that.mInformationAdherent.adresse = lVo.adresse;
							that.mInformationAdherent.codePostal = lVo.codePostal;
							that.mInformationAdherent.ville = lVo.ville;
							that.mInformationAdherent.dateNaissance = lVo.dateNaissance.extractDbDate().dateDbToFr();
							that.mInformationAdherent.commentaire = lVo.commentaire;

							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_316_CODE;
							erreur.message = ERR_316_MSG;
							lVr.log.erreurs.push(erreur);							
							
							Infobulle.generer(lVr,'');
	
							$('#adh-nom').text(that.mInformationAdherent.nom);
							$('#adh-prenom').text(that.mInformationAdherent.prenom);
							$('#adh-courriel-principal').text(that.mInformationAdherent.courrielPrincipal);
							$('#adh-courriel-secondaire').text(that.mInformationAdherent.courrielSecondaire);
							$('#adh-telephone-principal').text(that.mInformationAdherent.telephonePrincipal);
							$('#adh-telephone-secondaire').text(that.mInformationAdherent.telephoneSecondaire);
							$('#adh-adresse').text(that.mInformationAdherent.adresse);
							$('#adh-code-postal').text(that.mInformationAdherent.codePostal);
							$('#adh-ville').text(that.mInformationAdherent.ville);
							$('#adh-date-naissance').text(that.mInformationAdherent.dateNaissance);
							$('#adh-commentaire').text(that.mInformationAdherent.commentaire);
							
							$('.edt-info-compte').toggle();
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.changerMotPasse = function(pDialog) {
		var lVo = new InfoAdherentVO();
		var lForm = $('#dialog-edt-info-cpt form');
		
		lVo.motPasse = lForm.find(':input[name=pass]').val();
		lVo.motPasseNouveau = lForm.find(':input[name=pass_nouveau]').val();
		lVo.motPasseConfirm = lForm.find(':input[name=pass_confirm]').val();

		var lValid = new InfoAdherentValid();
		var lVr = lValid.validAjout(lVo);
		
		if(lVr.valid) {
			lVo.fonction = "pass";
			$.post(	"./index.php?m=MonCompte&v=ModifierMonCompte", "pParam=" + $.toJSON(lVo),
				function(lResponse) {
					Infobulle.init(); // Supprime les erreurs
					if(lResponse) {
						if(lResponse.valid) {										
							var lVr = new TemplateVR();
							lVr.valid = false;
							lVr.log.valid = false;
							var erreur = new VRerreur();
							erreur.code = ERR_302_CODE;
							erreur.message = ERR_302_MSG;
							lVr.log.erreurs.push(erreur);							
							
							Infobulle.generer(lVr,'');
							$(pDialog).dialog('close');
						} else {
							Infobulle.generer(lResponse,'');
						}
					}
				},"json"
			);			
		} else {
			Infobulle.generer(lVr,'');
		}
	};
	
	this.construct(pParam);
}