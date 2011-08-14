<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : AchatAdherentControleur.php
//
// Description : Classe AchatAdherentControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AchatAdherentResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");

/**
 * @name AchatAdherentControleur
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe controleur d'une AchatAdherent
 */
class AchatAdherentControleur
{
	/**
	* @name getAchatEtReservation($pParam)
	* @return AchatAdherentResponse
	* @desc Retourne les détails d'une réservation et des achats du marché
	*/
	public function getAchatEtReservation($pParam) {
		$lVr = AfficheAchatAdherentValid::validGetAchatEtReservation($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam["id_adherent"];
			$lIdCommande = $pParam["id_commande"];
			
			$lResponse = new AchatAdherentResponse();
			
			$lAdherent = AdherentViewManager::select($lIdAdherent);
			$lResponse->setAdherent($lAdherent);
			
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));

			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			$lResponse->setReservation($lReservationService->get($lIdReservation));	

			$lAchatService = new AchatService();
			$lIdAchat = new IdAchatVO();
			$lIdAchat->setIdCompte($lAdherent->getAdhIdCompte());
			$lIdAchat->setIdCommande($pParam["id_commande"]);
			$lResponse->setAchats($lAchatService->getAll($lIdAchat));	
			
			$lStockSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($pParam["id_commande"]);
			$lResponse->setStockSolidaire($lStockSolidaire);	
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name modifierAchat($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function modifierAchat($pParam) {
		$lVr = AfficheAchatAdherentValid::validModifierAchat($pParam);
		if($lVr->getValid()) {
			$lAchatData = $pParam["achat"];
			$lAchat = new AchatVO();
			if($lAchatData['idAchat'] < 0) { // Si c'est un ajout
				$lVr = AfficheAchatAdherentValid::validAjoutAchat($lAchatData);
				if($lVr->getValid()) {
					$lAchat->getId()->setIdCompte($lAchatData["idCompte"]);
					$lAchat->getId()->setIdCommande($lAchatData["idMarche"]);
					
					$lAchat->setTotal($lAchatData["total"]);
					foreach($lAchatData["produits"] as $lDetail) {
						$lDetailCommande = DetailCommandeManager::selectByIdProduit($lDetail["id"]);
						
						$lDetailAchat = new DetailReservationVO();
						$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
						$lDetailAchat->setQuantite($lDetail["quantite"]);
						$lDetailAchat->setMontant($lDetail["prix"]);
						
						if($lAchatData["idAchat"] == -1) {
							$lAchat->addDetailAchat($lDetailAchat);
						} else if($lAchatData["idAchat"] == -2) {
							$lAchat->addDetailAchatSolidaire($lDetailAchat);				
						}
					}
				} else { return $lVr;}
			} else {
				$lOperationService = new OperationService();
				$lOperation = $lOperationService->get($lAchatData["idAchat"]);
			
				$lAchat = new AchatVO();
				$lAchat->getId()->setIdCompte($lOperation->getIdCompte());
				$lAchat->getId()->setIdCommande($lOperation->getIdCommande());
				$lAchat->getId()->setIdAchat($lOperation->getId());
				
				$lAchat->setTotal($lAchatData["total"]);
				foreach($lAchatData["produits"] as $lDetail) {
					$lDetailCommande = DetailCommandeManager::selectByIdProduit($lDetail["id"]);
					
					$lDetailAchat = new DetailReservationVO();
					$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
					$lDetailAchat->setQuantite($lDetail["quantite"]);
					$lDetailAchat->setMontant($lDetail["prix"]);
					
					if($lOperation->getTypePaiement() == 7) {
						$lAchat->addDetailAchat($lDetailAchat);
					} else if($lOperation->getTypePaiement() == 8) {
						$lAchat->addDetailAchatSolidaire($lDetailAchat);				
					}
				}
			}			
			$lAchatService = new AchatService();
			$lIdOperation = $lAchatService->set($lAchat);
		}				
		return $lVr;
	}
	
	/**
	* @name supprimerAchat($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function supprimerAchat($pParam) {		
		$lVr = AfficheAchatAdherentValid::validSupprimerAchat($pParam);
		if($lVr->getValid()) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pParam["idAchat"]);
		
			$lIdAchatVO = new IdAchatVO();
			$lIdAchatVO->setIdCompte($lOperation->getIdCompte());
			$lIdAchatVO->setIdCommande($lOperation->getIdCommande());
			$lIdAchatVO->setIdAchat($lOperation->getId());
			
			$lAchatService = new AchatService();
			$lAchatService->delete($lIdAchatVO);
		}
		return $lVr;
	}
}
?>