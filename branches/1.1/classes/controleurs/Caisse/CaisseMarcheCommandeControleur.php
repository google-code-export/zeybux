<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/06/2011
// Fichier : CaisseMarcheCommandeControleur.php
//
// Description : Classe CaisseMarcheCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/ListeAdherentCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/MarcheValid.php");

include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/InfoAchatCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");

//include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );

/**
 * @name CaisseMarcheCommandeControleur
 * @author Julien PIERRE
 * @since 20/06/2011
 * @desc Classe controleur d'une CaisseMarcheCommande
 */
class CaisseMarcheCommandeControleur
{
	/**
	* @name modifierAchat($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour un achat
	*/
	public function modifierAchat($pParam) {
		$lVr = MarcheValid::validUpdateMarche($pParam);
		if($lVr->getValid()) {
			$lAchatService = new AchatService();
		//	$lReservationService = new ReservationService();
			$lIdMarche = $pParam['id'];
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->get($lIdMarche);
			$lProduitsMarche = $lMarche->getProduits();
						
			$lAchat = NULL;
			$lAchatSolidaire = NULL;
			foreach($pParam["idAchat"] as $lId) {
				$lIdAchat = new IdAchatVO();				
				$lIdAchat->setIdCompte($pParam['idCompte']);
				$lIdAchat->setIdCommande($lIdMarche);
				$lIdAchat->setIdAchat($lId);
				$lAchatTemp = $lAchatService->get($lIdAchat);
				
				$lTotal = $lAchatTemp->getTotal();
				$lTotalSolidaire = $lAchatTemp->getTotalSolidaire();
				if(!is_null($lTotal)) {
					$lAchat = $lAchatTemp;
				} else if(!is_null($lTotalSolidaire)) {
					$lAchatSolidaire = $lAchatTemp;
				}
			}
		
			$lPdtNvAchat = NULL;
			$lPdtNvAchatSolidaire = NULL;
			if(!empty($pParam["produits"])) {
				$lPdtNvAchat = $pParam["produits"];
			}
			if(!empty($pParam["produitsSolidaire"])) {
				$lPdtNvAchatSolidaire = $pParam["produitsSolidaire"];
			}
			
			if(!is_null($lAchat) && !is_null($lPdtNvAchat)) { // Maj de l'achat
				$lNvAchat = new AchatVO();
				$lNvAchat->getId()->setIdCompte($lAchat->getId()->getIdCompte());
				$lNvAchat->getId()->setIdCommande($lAchat->getId()->getIdCommande());
				$lNvAchat->getId()->setIdAchat($lAchat->getId()->getIdAchat());
				
				$lTotal = 0;
				foreach($lPdtNvAchat as $lDetail) {
					$lDetailCommande = DetailCommandeManager::selectByIdProduit($lDetail["id"]);
					
					$lDetailAchat = new DetailReservationVO();
					$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
					$lDetailAchat->setQuantite($lDetail["quantite"]);
					$lDetailAchat->setMontant($lDetail["prix"]);
					
					$lNvAchat->addDetailAchat($lDetailAchat);
					
					$lTotal += $lDetail["prix"];
				}
				
				$lNvAchat->setTotal($lTotal);
				$lAchatService->set($lNvAchat);
			
			} else if(is_null($lAchat) && !is_null($lPdtNvAchat)){ // Ajout
				$lNvAchat = new AchatVO();
				$lNvAchat->getId()->setIdCompte($pParam["idCompte"]);
				$lNvAchat->getId()->setIdCommande($pParam["id"]);
				
				$lTotal = 0;
				
				foreach($lPdtNvAchat as $lDetail){
					$lDetailAchat = new DetailReservationVO();	
					$lDcom = DetailCommandeManager::selectByIdProduit($lDetail["id"]);		
					$lDetailAchat->setIdDetailCommande($lDcom[0]->getId());
					$lDetailAchat->setQuantite($lDetail["quantite"]);
					$lDetailAchat->setMontant($lDetail["prix"]);
					$lTotal += $lDetail["prix"];
					$lNvAchat->addDetailAchat($lDetailAchat);
				}
				$lAchatService->set($lNvAchat); // Achat des produits
			} else if(!is_null($lAchat) && is_null($lPdtNvAchat)){ // Supression
				$lAchatService->delete($lAchat->getId());
			}
			
			if(!is_null($lAchatSolidaire) && !is_null($lPdtNvAchatSolidaire)) { // Maj de l'achat
		//		echo "maj";
				$lNvAchatSolidaire = new AchatVO();
				$lNvAchatSolidaire->getId()->setIdCompte($lAchatSolidaire->getId()->getIdCompte());
				$lNvAchatSolidaire->getId()->setIdCommande($lAchatSolidaire->getId()->getIdCommande());
				$lNvAchatSolidaire->getId()->setIdAchat($lAchatSolidaire->getId()->getIdAchat());
				
				$lTotal = 0;
				foreach($lPdtNvAchatSolidaire as $lDetail) {
					$lDetailCommande = DetailCommandeManager::selectByIdProduit($lDetail["id"]);
					
					$lDetailAchat = new DetailReservationVO();
					$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
					$lDetailAchat->setQuantite($lDetail["quantite"]);
					$lDetailAchat->setMontant($lDetail["prix"]);
					
					$lDetailAchat->setIdNomProduit($lProduitsMarche[$lDetail["id"]]->getIdNom());
					$lDetailAchat->setUnite($lProduitsMarche[$lDetail["id"]]->getUnite());
					
					$lNvAchatSolidaire->addDetailAchatSolidaire($lDetailAchat);
					
					$lTotal += $lDetail["prix"];
				}
				
				$lNvAchatSolidaire->setTotalSolidaire($lTotal);
			
				$lAchatService->set($lNvAchatSolidaire);
			} else if(is_null($lAchatSolidaire) && !is_null($lPdtNvAchatSolidaire)){ // Ajout
				
				$lNvAchatSolidaire = new AchatVO();
				$lNvAchatSolidaire->getId()->setIdCompte($pParam["idCompte"]);
				$lNvAchatSolidaire->getId()->setIdCommande($pParam["id"]);
				
				$lTotal = 0;
				
				foreach($lPdtNvAchatSolidaire as $lDetail) {
					$lDetailAchat = new DetailReservationVO();
					$lDcom = DetailCommandeManager::selectByIdProduit($lDetail["id"]);		
					$lDetailAchat->setIdDetailCommande($lDcom[0]->getId());
					$lDetailAchat->setQuantite($lDetail["quantite"]);
					$lDetailAchat->setMontant($lDetail["prix"]);
					$lTotal += $lDetail["prix"];
					
					$lDetailAchat->setIdNomProduit($lProduitsMarche[$lDetail["id"]]->getIdNom());
					$lDetailAchat->setUnite($lProduitsMarche[$lDetail["id"]]->getUnite());
					
					$lNvAchatSolidaire->addDetailAchatSolidaire($lDetailAchat);
				}
				$lAchatService->set($lNvAchatSolidaire); // Achat des produits
				
			} else if(!is_null($lAchatSolidaire) && is_null($lPdtNvAchatSolidaire)){ // Supression
				//echo "supp";
				$lAchatService->delete($lAchatSolidaire->getId());
			}

			// Si il y a aussi un rechargement du compte
			$lRechargement = $pParam['rechargement'];
			if(!empty($lRechargement['montant']) && $lRechargement['montant'] != 0) {
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($pParam['idCompte']);
				$lOperation->setMontant($lRechargement['montant']);
				$lOperation->setLibelle("Rechargement");
				$lOperation->setTypePaiement($lRechargement['typePaiement']);		
				$lOperation->setTypePaiementChampComplementaire($lRechargement['champComplementaire']);
				$lOperation->setIdBanque($lRechargement['idBanque']);
				$lOperation->setIdCommande(0);
				
				$lOperationService = new OperationService();
				$lOperationService->set($lOperation);
			}
		}				
		return $lVr;
	}
	
	/**
	* @name getListeAdherentMarche($pIdCommande)
	* @return ListeAdherentCommandeResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur ce Marche.
	*/
	public function getMarcheListeReservation($pParam) {		
		$lVr = MarcheValid::validGetMarcheListeReservation($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeAdherentCommandeResponse();
			$lListe = ListeAdherentViewManager::selectAll();
			$lResponse->setListeAdherentCommande($lListe);
			
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->getInfoMarche($pParam['id_commande']);
			$lResponse->setNumeroMarche($lMarche->getNumero());
			
			return $lResponse;		
		}				
		return $lVr;
	}
	
	/**
	* @name getInfoAchatMarche($pParam)
	* @return InfoAchatCommandeResponse
	* @desc Retourne les infos de réservation d'un adhérent
	*/
	public function getInfoAchatMarche($pParam) {
		$lVr = MarcheValid::validGetInfoAchatMarche($pParam);
		if($lVr->getValid()) {		
			$lAdherent = AdherentViewManager::select($pParam["id_adherent"]);
			
			$lResponse = new InfoAchatCommandeResponse();
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));
			
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			
			/*$lReservation = $lReservationService->get($lIdReservation);
			// Retourne la réservation uniquement si elle n'est pas déjà récupérée
			if($lReservation->getEtat() == 0 || is_null($lReservation->getEtat())) {
				$lResponse->setReservation($lReservation->getDetailReservation());
			}*/
			
		
			//if($lReservationService->enCours($lIdReservation)) {
		
				$lResponse->setReservation($lReservationService->get($lIdReservation)->getDetailReservation());			
			//} else {
				$lAchatService = new AchatService();
				$lIdAchat = new IdAchatVO();
				$lIdAchat->setIdCompte($lAdherent->getAdhIdCompte());
				$lIdAchat->setIdCommande($pParam["id_commande"]);
				$lResponse->setAchats($lAchatService->getAll($lIdAchat));	
			//}
			
		//	$lStockSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($pParam["id_commande"]);
			$lStockService = new StockService();
			$lStockSolidaire = $lStockService->selectSolidaireAllActif();
			
			$lResponse->setStockSolidaire($lStockSolidaire);	
			$lResponse->setTypePaiement(TypePaiementVisibleViewManager::selectAll());
			
			$lResponse->setAdherent($lAdherent);				
			
			$lBanqueService = new BanqueService();
			$lResponse->setBanques($lBanqueService->getAllActif());
			
			return $lResponse;
		}				
		return $lVr;
	}
	
	/**
	* @name getInfoMarche($pParam)
	* @return InfoAchatCommandeResponse
	* @desc Retourne les infos de réservation d'un adhérent
	*/
	public function getInfoMarche($pParam) {
		$lVr = MarcheValid::validGetInfoMarche($pParam);
		if($lVr->getValid()) {
			$lResponse = new InfoAchatCommandeResponse();
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));
						
			//$lStockSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($pParam["id_commande"]);
			
			$lStockService = new StockService();
			$lStockSolidaire = $lStockService->selectSolidaireAllActif();
			
			$lResponse->setStockSolidaire($lStockSolidaire);	
			$lResponse->setTypePaiement(TypePaiementVisibleViewManager::selectAll());	
			
			$lBanqueService = new BanqueService();
			$lResponse->setBanques($lBanqueService->getAllActif());
					
			return $lResponse;
		}				
		return $lVr;
	}
	
	/**
	* @name enregistrerAchat($pParam)
	* @return VR
	* @desc Enregistre la commande d'un adhérent
	*/
	public function enregistrerAchat($pParam) {	

		$lVr = MarcheValid::validAjout($pParam);
		if($lVr->getValid()) {		
			$lIdMarche = $pParam['id'];	
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pParam['idCompte']);
			$lIdReservation->setIdCommande($lIdMarche);
			
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->get($lIdMarche);
			$lProduitsMarche = $lMarche->getProduits();
			
			$lReservationService = new ReservationService();
			$lOperations = $lReservationService->selectOperationReservation($lIdReservation);

			$lAchat = new AchatVO();
			$lAchat->getId()->setIdCompte($pParam["idCompte"]);
			$lAchat->getId()->setIdCommande($lIdMarche);
			if($lOperations[0]->getTypePaiement() == 0) {
				$lAchat->getId()->setIdReservation($lOperations[0]->getId());
			}
			
			$lTotal = 0;
			
			foreach($pParam["produits"] as $lDetail){
				$lDetailAchat = new DetailReservationVO();	
				$lDcom = DetailCommandeManager::selectByIdProduit($lDetail["id"]);		
				$lDetailAchat->setIdDetailCommande($lDcom[0]->getId());
				$lDetailAchat->setQuantite($lDetail["quantite"]);
				$lDetailAchat->setMontant($lDetail["prix"]);
				$lTotal += $lDetail["prix"];
				$lAchat->addDetailAchat($lDetailAchat);
			}
			
			foreach($pParam["produitsSolidaire"] as $lDetail){
				$lDetailAchat = new DetailReservationVO();
				$lDcom = DetailCommandeManager::selectByIdProduit($lDetail["id"]);		
				$lDetailAchat->setIdDetailCommande($lDcom[0]->getId());
				$lDetailAchat->setQuantite($lDetail["quantite"]);
				$lDetailAchat->setMontant($lDetail["prix"]);
				
					$lDetailAchat->setIdNomProduit($lProduitsMarche[$lDetail["id"]]->getIdNom());
					$lDetailAchat->setUnite($lProduitsMarche[$lDetail["id"]]->getUnite());
					
				$lTotal += $lDetail["prix"];
				$lAchat->addDetailAchatSolidaire($lDetailAchat);
			}

			// Si il y a aussi un rechargement du compte
			$lRechargement = $pParam['rechargement'];
			if(!empty($lRechargement['montant']) && $lRechargement['montant'] != 0) {
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($pParam['idCompte']);
				$lOperation->setMontant($lRechargement['montant']);
				$lOperation->setLibelle("Rechargement");
				$lOperation->setTypePaiement($lRechargement['typePaiement']);		
				$lOperation->setTypePaiementChampComplementaire($lRechargement['champComplementaire']);
				$lOperation->setIdBanque($lRechargement['idBanque']);
				$lOperation->setIdCommande(0);
				
				$lTotal += $lRechargement['montant'];
			}
			
			if($pParam['idCompte'] == -3 && $lTotal != 0 ) { // Compte invite reste à 0				
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_244_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_244_MSG);
				$lVr->getLog()->addErreur($lErreur);	
				return $lVr;
			} else {			
				$lAchatService = new AchatService();
				$lIdOperation = $lAchatService->set($lAchat); // Achat des produits
				
				if(!empty($lRechargement['montant']) && $lRechargement['montant'] != 0) {
					$lOperationService = new OperationService();
					$lOperationService->set($lOperation);
				}
			}
		}				
		return $lVr;
	}
}
?>