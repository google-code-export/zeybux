<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/08/2013
// Fichier : FactureControleur.php
//
// Description : Classe FactureControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_SERVICE . "FactureService.php");
include_once(CHEMIN_CLASSES_SERVICE . "FermeService.php");
include_once(CHEMIN_CLASSES_SERVICE . "NomProduitService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php");
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFactureResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/UniteNomProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/EnregistrerFactureResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/FactureResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeMarcheResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/NomProduitValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FactureValid.php");
include_once(CHEMIN_CLASSES_TOVO . "FactureToVO.php");
require_once(CHEMIN_CLASSES_PDF . 'html2pdf.class.php');
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");

/**
 * @name FactureControleur
 * @author Julien PIERRE
 * @since 10/08/2013
 * @desc Classe controleur d'une FactureControleur
 */
class FactureControleur
{
	/**
	 * @name getListeMarche()
	 * @return ListeMarcheResponse
	 * @desc Retourne la liste des marchés.
	 */
	public function getListeMarche() {
		$lMarcheService = new MarcheService();		
		return new ListeMarcheResponse($lMarcheService->get());
	}
	
	/**
	 * @name getListeFacture($pParam)
	 * @return ListeFactureResponse
	 * @desc Retourne la liste des factures.
	 */
	public function getListeFacture($pParam) {
		$lVr = FactureValid::validRechercheListeFacture($pParam);
		if($lVr->getValid()) {

			$lDateDebut = NULL;
			if(!empty($pParam['dateDebut'])) {
				$lDateDebut = $pParam['dateDebut'];
			}
			$lDateFin = NULL;
			if(!empty($pParam['dateFin'])) {
				$lDateFin = $pParam['dateFin'];
			}
			$lIdMarche = NULL;
			if(!empty($pParam['idMarche'])) {
				$lIdMarche = $pParam['idMarche'];
			}
			
			$lListeFactureResponse = new ListeFactureResponse();
			$lFactureService = new FactureService();
			$lListeFactureResponse->setListeFacture($lFactureService->rechercheListeFacture($lDateDebut, $lDateFin, $lIdMarche));
			
			return $lListeFactureResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name getListeFerme()
	 * @return ListeFermeResponse
	 * @desc Retourne la liste des Fermes.
	 */
	public function getListeFerme() {
		$lFermeService = new FermeService();
		$lFactureService = new FactureService();
		$lBanqueService = new BanqueService();		
		$lTypePaiementService = new TypePaiementService();
		
		return new ListeFermeResponse($lFermeService->get(),
				$lFactureService->getNouveauNumeroFacture(),
				$lBanqueService->getAllActif(),
				$lTypePaiementService->selectVisible());
	}
	
	/**
	 * @name getListeProduitFerme($pParam)
	 * @return ListeProduitResponse
	 * @desc Retourne la liste des produits d'une ferme
	 */
	public function getListeProduitFerme($pParam) {
		$lVr = FactureValid::validListeProduitFerme($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeProduitResponse();
			
			if(!empty($pParam['idMarche'])) {
				$lFactureService = new FactureService();
				$lResponse->setListeProduitCommande($lFactureService->getProduitCommandeNonFacture($pParam['idMarche'], $lVr->getData()['ferme']->getIdCompte() ) );
			}			
			
			$lResponse->setListeProduit( ListeNomProduitViewManager::select( $pParam['id'] ) );
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name getUniteProduit($pParam)
	 * @return UniteNomProduitResponse
	 * @desc Retourne la liste des produits d'une ferme
	 */
	public function getUniteProduit($pParam) {
		$lVr = NomProduitValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lNomProduitService = new NomProduitService();
			return new UniteNomProduitResponse($lNomProduitService->selectUniteNomProduit( $pParam['id'] ));
		}
		return $lVr;
	}
	
	/**
	 * @name enregistrerFacture($pParam)
	 * @return FacctureVR
	 * @desc Retourne la liste des produits d'une ferme
	 */
	public function enregistrerFacture($pParam) {
		$lVr = FactureValid::validEnregistrer($pParam);
		if($lVr->getValid()) {
			$lFacture = FactureToVO::convertFromArray($pParam);
			$lFactureService = new FactureService();
			return new EnregistrerFactureResponse($lFactureService->set($lFacture));
		}
		return $lVr;
	}
	
	/**
	 * @name getFacture($pParam)
	 * @return FactureResponse
	 * @desc Retourne la facture
	 */
	public function getFacture($pParam) {
		$lVr = FactureValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lBanqueService = new BanqueService();		
			$lTypePaiementService = new TypePaiementService();
			$lFermeService = new FermeService();
			$lFerme = $lFermeService->getByIdCompte($lVr->getData()['facture']->getId()->getIdCompte())[0];
			
			return new FactureResponse($lVr->getData()['facture'],
					$lBanqueService->getAllActif(),
					$lTypePaiementService->selectVisible(),
					$lFerme,
					ListeNomProduitViewManager::select( $lFerme->getId() ));
			
		}
		return $lVr;
	}
	
	/**
	 * @name deleteFacture($pParam)
	 * @return FactureVR
	 * @desc Supprime la facture
	 */
	public function deleteFacture($pParam) {
		$lVr = FactureValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lFactureService = new FactureService();
			$lFactureService->delete($pParam['id']);
		}
		return $lVr;
	}
	
	/**
	 * @name getFacturePdf($pParam)
	 * @return Un Fichier Pdf
	 * @desc Retourne la facture en pdf
	 */
	public function getFacturePdf($pParam) {
		$lVr = FactureValid::validDelete($pParam);	
		if($lVr->getValid()) {
			// Récupération des informations
			
			$lFacture = $lVr->getData()['facture'];
			$lFermeService = new FermeService();
			$lFerme = $lFermeService->getByIdCompte($lFacture->getId()->getIdCompte())[0];
							
			// get the HTML
			ob_start();
			include(CHEMIN_TEMPLATE . MOD_GESTION_COMMANDE .'/PDF/Facture.php');
			$content = ob_get_clean();
				
			// convert to PDF
			try {
				$html2pdf = new HTML2PDF('P', 'A4', 'fr');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->writeHTML($content, 0);
				$html2pdf->Output('Facture.pdf','D');
			}
			catch(HTML2PDF_exception $e) {
				// Initialisation du Logger
				$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
				$lLogger->setMask(Log::MAX(LOG_LEVEL));
				$lLogger->log("Erreur de génération du PDF de Facture : " . $e,PEAR_LOG_DEBUG); // Maj des logs
			}
		}
		return $lVr->exportToJson();
	}
	
	/**
	 * @name getFactureCSV($pParam)
	 * @return Un Fichier CSV
	 * @desc Retournela facture en format CSV
	 */
	public function getFactureCSV($pParam) {
		$lVr = FactureValid::validDelete($pParam);	
		if($lVr->getValid()) {
			$lCSV = new CSV();
			$lCSV->setNom('Facture.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Ferme","Ref.", "Produit","Quantite","","Prix","","Solidaire","");
			$lCSV->setEntete($lEntete);
				
			// Les données
			$lFacture = $lVr->getData()['facture'];
			$lFermeService = new FermeService();
			$lFerme = $lFermeService->getByIdCompte($lFacture->getId()->getIdCompte())[0];
			
			$lContenuTableau = array();
			$lId = 0;
			foreach($lFacture->getProduits() as $lProduit) {
				$lQuantite = '';
				$lUnite = '';
				$lMontant = 0;
				$lSigleMontant = SIGLE_MONETAIRE;
				
				$lQteTest = $lProduit->getQuantite();
				if(!is_null($lProduit->getQuantite()) && !empty($lQteTest)) {
					$lQuantite = $lQteTest;
					$lUnite = $lProduit->getUnite();
					$lMontant = $lProduit->getMontant();
				}
				
				$lQuantiteSolidaire = '';
				$lUniteSolidaire = '';
				$lQteSolTest = $lProduit->getQuantiteSolidaire();
				if(!is_null($lProduit->getQuantiteSolidaire()) && !empty($lQteSolTest)) {
					$lQuantiteSolidaire = $lQteSolTest;
					$lUniteSolidaire = $lProduit->getUniteSolidaire();
				}
				
				$lNomFerme = '';
				if($lId == 0) {
					$lNomFerme = $lFerme->getNom();
					$lId++;
				}
				
				$lLignecontenu = array(	$lNomFerme,
						$lProduit->getNproNumero(),
						$lProduit->getNproNom(),
						$lQuantite,
						$lUnite,
						$lMontant,
						$lSigleMontant,
						$lQuantiteSolidaire,
						$lUniteSolidaire
				);
				
				array_push($lContenuTableau,$lLignecontenu);
			}
			
			$lLignecontenu = array("","","","","Total : ", $lFacture->getId()->getMontant(), SIGLE_MONETAIRE,"","");
			array_push($lContenuTableau,$lLignecontenu);
			
			$lCSV->setData($lContenuTableau);
			
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}
			
			
			/*$lIdCommande = $pParam["id_commande"];
			$lOperationService = new OperationService();
			$lLignesBonLivraison = InfoBonLivraisonViewManager::selectByIdCommande($lIdCommande);
			$lLignesSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($lIdCommande);
			$lLignesBonCommande = InfoBonCommandeViewManager::selectByIdCommande($lIdCommande);*/
				
	/*		$lContenuTableau = array();
			$lIdPrdt = 0;
			foreach($lLignesBonLivraison as $lLigne) {
				if($lLigne->getProIdCompteFerme() != NULL) { // évite les lignes vides
					if($lLigne->getProIdCompteFerme() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						if($lIdPrdt != 0) {
							/*$lIdCompteFerme = $lLigne->getProIdCompteFerme();
								$lOperations = $lOperationService->getBonLivraison($lIdCommande,$lIdCompteFerme);
							$lOperation = $lOperations[0];
							$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
							if(!is_null($lOperation->getId())) {
							$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
							} else {
							$lOperation->setMontant("");
							}*/
			/*				$lOperations = $lOperationService->getBonLivraison($lIdCommande,$lIdPrdt);
							$lOperation = $lOperations[0];
							$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
								
							if(!is_null($lOperation->getId())) {
							/*	$lIds = explode(";",$lOperation->getTypePaiementChampComplementaire());
								$lOperation = $lOperationService->get($lIds[0]);*/
	
			/*					$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
							} else {
							$lOperation->setMontant("");
							}
								
								
							$lLignecontenu = array("","","","","","","","","Total : ",$lOperation->getMontant(),SIGLE_MONETAIRE,"","");
							array_push($lContenuTableau,$lLignecontenu);
							$lLignecontenu = array("","","","","","","","","","","","","");
							array_push($lContenuTableau,$lLignecontenu);
						}
						$lNomPrdt = $lLigne->getFerNom();
						}
	
						$lQuantite = '';
						$lUniteQuantite = '';
						$lMontant = '';
						$lSigleMontant = '';
							
						foreach($lLignesBonCommande as $lLigneBonCommande) {
						if($lLigneBonCommande->getProId() == $lLigne->getProId())	{
						if( $lLigneBonCommande->getStoQuantite() == '' || $lLigneBonCommande->getStoQuantite() == NULL) {
						$lQuantite = '';
						$lUniteQuantite = '';
						} else {
						$lQuantite = $lLigneBonCommande->getStoQuantite();
							$lUniteQuantite = $lLigne->getProUniteMesure();
						}
							
						if( $lLigneBonCommande->getDopeMontant() == '' || $lLigneBonCommande->getDopeMontant() == NULL) {
						$lMontant = '';
						$lSigleMontant = '';
						} else {
						$lMontant = $lLigneBonCommande->getDopeMontant();
						$lSigleMontant = SIGLE_MONETAIRE;
						}
						}
						}
							
						if( $lLigne->getStoQuantite() == '' || $lLigne->getStoQuantite() == NULL) {
						$lQuantiteLivraison = '';
						$lUniteQuantiteLivraison = '';
			} else {
			$lQuantiteLivraison = $lLigne->getStoQuantite();
			$lUniteQuantiteLivraison = $lLigne->getProUniteMesure();
			}
				
			if( $lLigne->getDopeMontant() == '' || $lLigne->getDopeMontant() == NULL) {
			$lMontantLivraison = '';
			$lSigleMontantLivraison = '';
			} else {
			$lMontantLivraison = $lLigne->getDopeMontant();
			$lSigleMontantLivraison = SIGLE_MONETAIRE;
			}
	
			$lQuantiteSolidaire = '';
			$lUniteQuantiteSolidaire = '';
				
			foreach($lLignesSolidaire as $lLigneSolidaire) {
			if($lLigneSolidaire->getProId() == $lLigne->getProId())	{
			if( $lLigneSolidaire->getStoQuantite() == '' || $lLigneSolidaire->getStoQuantite() == NULL) {
			$lQuantiteSolidaire = '';
			$lUniteQuantiteSolidaire = '';
			} else {
			$lQuantiteSolidaire = $lLigneSolidaire->getStoQuantite();
			$lUniteQuantiteSolidaire = $lLigne->getProUniteMesure();
			}
			}
			}
	
			$lLignecontenu = array(	$lNomPrdt,
			$lLigne->getNproNumero(),
			$lLigne->getNproNom(),
			$lQuantite,
			$lUniteQuantite,
			$lMontant,
			$lSigleMontant,
			$lQuantiteLivraison,
			$lUniteQuantiteLivraison,
			$lMontantLivraison,
			$lSigleMontantLivraison,
			$lQuantiteSolidaire,
			$lUniteQuantiteSolidaire
			);
				
			array_push($lContenuTableau,$lLignecontenu);
			$lIdPrdt = $lLigne->getProIdCompteFerme();
			}
			}
	
			$lIdCompteFerme = $lLigne->getProIdCompteFerme();
			$lOperations = $lOperationService->getBonLivraison($lIdCommande,$lIdCompteFerme);
			$lOperation = $lOperations[0];
			$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
			if(!is_null($lOperation->getId())) {
			$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
	} else {
	$lOperation->setMontant("");
	}
				
				
			$lLignecontenu = array("","","","","","","","","Total : ",$lOperation->getMontant(),SIGLE_MONETAIRE,"","");
			array_push($lContenuTableau,$lLignecontenu);
				
			$lCSV->setData($lContenuTableau);
				
			// Export en CSV
			$lCSV->output();
			} else {
			return $lVr;
			}*/
			}
}
?>