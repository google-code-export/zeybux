;function AdministrationVue(pParam) {
	
	this.construct = function(pParam) {
		$.history( {'vue':function() {AdministrationVue();}} );
		var that = this;	
		$.post(	"./index.php?m=Identification&v=Administration", 
				function(lResponse) {
				  	Infobulle.init(); // Supprime les erreurs
				  	if(lResponse) {
						if(lResponse.valid) {	
							if(pParam && pParam.vr) {
								Infobulle.generer(pParam.vr,'');
							}
							that.afficher(lResponse);
							// Maj du Menu
							gCommunVue.majMenu('administration');
						} else {
							Infobulle.generer(lResponse,'');
						}
				  	}
				},"json"
		);
	};
	
	this.afficher = function(pResponse) {
		var that = this;
		var lIdentificationTemplate = new IdentificationTemplate();	
		var lTemplate = lIdentificationTemplate.admin;		
		$('#contenu').replaceWith(that.affect($(lTemplate.template(pResponse.menu))));
	};
	
	this.affect = function(pData) {
		pData = this.affectVues(pData);		
		return pData;
	};
	
	this.affectVues = function(pData) {
		if(pData) {
			
			pData.find('#menu-GestionAdherents-ListeAdherent').click(function() {
				ListeAdherentVue();
				return false;
			});	
						
			pData.find('#menu-GestionCommande-ListeCommande').click(function() {
				GestionListeCommandeVue();
				return false;
			});
			
			pData.find('#menu-GestionCommande-StockProduitListeFerme').click(function() {
				StockProduitListeFermeVue();
				return false;
			});
			
			pData.find('#menu-GestionCommande-Facture').click(function() {
				FactureVue();
				return false;
			});
			
			pData.find('#menu-GestionCommande-Achat').click(function() {
				AchatVue();
				return false;
			});
			
			pData.find('#menu-GestionProducteur-ListeFerme').click(function() {
				ListeFermeVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-CompteZeybu').click(function() {
				CompteZeybuVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-Virements').click(function() {
				VirementZeybuVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-ListeVirement').click(function() {
				ListeVirementZeybuVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-SuiviPaiement').click(function() {
				SuiviPaiementVue();
				return false;
			});
			
			pData.find('#menu-CompteZeybu-RemiseCheque').click(function() {
				ListeRemiseChequeVue();
				return false;
			});
			
			pData.find('#menu-RechargementCompte-RechargerCompte').click(function() {
				RechargerCompteVue();
				return false;
			});
			
			pData.find('#menu-GestionCaisse-GestionCaisse').click(function() {
				GestionCaisseVue();
				return false;
			});
			
			pData.find('#menu-GestionProduit-GestionCategorie').click(function() {
				GestionCategorieVue();
				return false;
			});
			
			pData.find('#menu-GestionProduit-GestionCaracteristique').click(function() {
				GestionCaracteristiqueVue();
				return false;
			});
			
			pData.find('#menu-GestionComptesSpeciaux-ListeCompte').click(function() {
				ListeComptesSpeciauxVue();
				return false;
			});
			
			pData.find('#menu-GestionAbonnement-ListeProduit').click(function() {
				ListeProduitVue();
				return false;
			});
			
			pData.find('#menu-GestionAbonnement-ListeAbonne').click(function() {
				ListeAbonneVue();
				return false;
			});
			
			pData.find('#menu-Caisse-ListeMarche').click(function() {
				CaisseListeCommandeVue();
				return false;
			});
			
			pData.find('#menu-Caisse-CaissePermanente').click(function() {
				CaisseMarcheCommandeVue({id_commande:-1});
				return false;
			});
			
			pData.find('#menu-Caisse-PaiementCaisse').click(function() {
				PaiementCaisseVue();
				return false;
			});
			
			pData.find('#menu-Parametrage-Banque').click(function() {
				ListeBanqueVue();
				return false;
			});
			
			pData.find('#menu-Parametrage-ParametreZeybux').click(function() {
				ParametreZeybuxVue();
				return false;
			});
			
			pData.find('#menu-Adhesion-GestionAdhesion').click(function() {
				ListeAdhesionVue();
				return false;
			});
			
			pData.find('#menu-Adhesion-ListeAdherent').click(function() {
				ListeAdherentAdhesionVue();
				return false;
			});
			
			pData.find('#menu-CompteAssociation-CompteAssociation').click(function() {
				CompteAssociationVue();
				return false;
			});
			
			pData.find('#menu-CompteAssociation-SuiviPaiement').click(function() {
				SuiviPaiementAssociationVue();
				return false;
			});
						
			pData.find('#menu-CompteAssociation-RemiseCheque').click(function() {
				ListeRemiseChequeAssociationVue();
				return false;
			});
				
			return pData;
		}
		return null;
	};
	
	this.construct(pParam);
}	