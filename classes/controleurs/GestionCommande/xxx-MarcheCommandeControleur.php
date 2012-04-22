<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : MarcheCommandeControleur.php
//
// Description : Classe MarcheCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeAdherentCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/MarcheValid.php");

include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/InfoAchatCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );

/**
 * @name MarcheCommandeControleur
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe controleur d'une MarcheCommande
 */
class MarcheCommandeControleur
{
	/**
	* @name getListeAdherentMarche($pIdCommande)
	* @return ListeAdherentCommandeResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur ce Marche.
	*/
	/*public function getMarcheListeReservation($pParam) {		
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
	}*/
	
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
			$lReservation = $lReservationService->get($lIdReservation);
			// Retourne la réservation uniquement si elle n'est pas déjà récupérée
			if($lReservation->getEtat() == 0 || is_null($lReservation->getEtat())) {
				$lResponse->setReservation($lReservation->getDetailReservation());
			}
			
			$lStockSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($pParam["id_commande"]);
			$lResponse->setStockSolidaire($lStockSolidaire);	
			$lResponse->setTypePaiement(TypePaiementVisibleViewManager::selectAll());
			
			$lResponse->setAdherent($lAdherent);				
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
						
			$lStockSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($pParam["id_commande"]);
			$lResponse->setStockSolidaire($lStockSolidaire);	
			$lResponse->setTypePaiement(TypePaiementVisibleViewManager::selectAll());			
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
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pParam['idCompte']);
			$lIdReservation->setIdCommande($pParam['id']);
			
			$lReservationService = new ReservationService();
			$lOperations = $lReservationService->selectOperationReservation($lIdReservation);

			$lAchat = new AchatVO();
			$lAchat->getId()->setIdCompte($pParam["idCompte"]);
			$lAchat->getId()->setIdCommande($pParam["id"]);
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