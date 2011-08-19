<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/10/2010
// Fichier : AfficherReservationControleur.php
//
// Description : Classe AfficherReservationControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/AfficherReservationResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/CommandeReservationValid.php");

/**
 * @name AfficherReservationControleur
 * @author Julien PIERRE
 * @since 04/10/2010
 * @desc Classe controleur du détail d'une reservation
 */
class AfficherReservationControleur
{
	/**
	* @name getReservation($pParam)
	* @return AfficherReservationResponse
	* @desc Retourne les détails d'une réservation et de la commande
	*/
	public function getReservation($pParam) {
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];

		$lVr = CommandeReservationValid::validGetReservation($pParam);
		if($lVr->getValid()) {
		
			$lResponse = new AfficherReservationResponse();
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));
			
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($_SESSION[ID_COMPTE]);
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
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];

		$lVr = CommandeReservationValid::validUpdate($pParam);
		if($lVr->getValid()) {
			$lIdLot = $pParam["detailReservation"][0]["stoIdDetailCommande"];
			$lDetailMarche = DetailMarcheViewManager::selectByLot($lIdLot);
	
			$lReservationService = new ReservationService();
			$lReservation = new ReservationVO();
			$lReservation->getId()->setIdCompte($_SESSION[ID_COMPTE]);
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
	* @desc Supprime une réservation
	*/
	public function supprimerReservation($pParam) {
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];
		$lVr = CommandeReservationValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($_SESSION[ID_COMPTE]);
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			$lReservationService->delete($lIdReservation);
		}				
		return $lVr;
	}
}
?>