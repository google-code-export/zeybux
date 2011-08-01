<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : ReservationAdherentControleur.php
//
// Description : Classe ReservationAdherentControleur
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitViewManager.php");

include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
//include_once(CHEMIN_CLASSES_MANAGERS . "GroupeCommandeManager.php");
//include_once(CHEMIN_CLASSES_VALIDATEUR . "ListeReservationCommandeValid.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "SupprimerReservationAdherentValid.php");*/
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "AfficheReservationAdherentValid.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ReservationAdherentResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/CommandeReservationValid.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

/**
 * @name ReservationAdherentControleur
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe controleur d'une ReservationAdherent
 */
class ReservationAdherentControleur
{
	/**
	* @name getReservation($pParam)
	* @return ReservationAdherentResponse
	* @desc Retourne les détails d'une réservation et de la commande
	*/
	public function getReservation($pParam) {
		$lVr = AfficheReservationAdherentValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam["id_adherent"];
			$lIdCommande = $pParam["id_commande"];
			
			$lResponse = new ReservationAdherentResponse();
			
			$lAdherent = AdherentViewManager::select($lIdAdherent);
			$lResponse->setAdherent($lAdherent);
			
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));

			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			$lResponse->setReservation($lReservationService->get($lIdReservation)->getDetailReservation());			
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name modifierReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function modifierReservation($pParam) {
		// TODO faire les tests correctements
		$lVr = CommandeReservationValid::validUpdate($pParam);
		if($lVr->getValid()) {
			$lIdLot = $pParam["detailReservation"][0]["stoIdDetailCommande"];
			$lDetailMarche = DetailMarcheViewManager::selectByLot($lIdLot);
	
			$lReservationService = new ReservationService();
			$lReservation = new ReservationVO();
			$lReservation->getId()->setIdCompte($pParam["id_compte"]);
			$lReservation->getId()->setIdCommande($lDetailMarche[0]->getComId());
			
			foreach($pParam["detailReservation"] as $lDetail) {
					$lDetailCommande = DetailCommandeManager::select($lDetail["stoIdDetailCommande"]);				
					$lPrix = $lDetail["stoQuantite"] / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();
	
					$lDetailReservation = new DetailReservationVO();
					
					$lDetailReservation->setIdDetailCommande($lDetail["stoIdDetailCommande"]);
					$lDetailReservation->setQuantite($lDetail["stoQuantite"]);
					$lDetailReservation->setMontant($lPrix);
					
					$lReservation->addDetailReservation($lDetailReservation);
			}		
			$lReservationService = new ReservationService();
			$lIdOperation = $lReservationService->set($lReservation);
		}				
		return $lVr;
	}
	
	/**
	* @name supprimerReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function supprimerReservation($pParam) {		
		$lVr = CommandeReservationValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pParam["id_compte"]);
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			$lReservationService->delete($lIdReservation);
		}
		return $lVr;
	}
}
?>