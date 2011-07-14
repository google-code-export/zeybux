<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : ReservationService.php
//
// Description : Classe ReservationService
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_MANAGERS . "ReservationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueReservationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "ReservationValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );*/
include_once(CHEMIN_CLASSES_VO . "ReservationVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ReservationValid.php");

/**
 * @name ReservationService
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe Service d'une Reservation
 */
class ReservationService
{		
	/**
	* @name set($pReservation)
	* @param ReservationVO
	* @return integer
	* @desc Ajoute ou modifie une réservation
	*/
	public function set($pReservation) {
		$lReservationValid = new ReservationValid();
		if($lReservationValid->insert($pReservation)) {
			return $this->insert($pReservation);			
		} else if($lReservationValid->update($pReservation)) {
			return $this->update($pReservation);
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pReservation)
	* @param ReservationVO
	* @return integer
	* @desc Ajoute une réservation
	*/
	private function insert($pReservation) {		
		$lStockService = new StockService;		
		$lTotal = 0;
		foreach($pReservation->getDetailReservation() as $lProduit) {
			
			// Ajout du stock
			$lStock = new StockVO();
			$lStock->setQuantite($lProduit->getQuantite());
			$lStock->setType(0);
			$lStock->setIdCompte($pReservation->getId()->getIdCompte());
			$lStock->setIdDetailCommande($lProduit->getIdDetailCommande());
			$lStockService->set($lStock);
			
			$lTotal += $lProduit->getMontant();
		}
		
		// L'operation
		$lOperation = new OperationVO();
		$lOperation->setIdCompte($pReservation->getId()->getIdCompte());
		$lOperation->setMontant($lTotal);
		$lOperation->setLibelle("Marché N°" . $pReservation->getId()->getIdCommande());
		$lOperation->setTypePaiement(0);
		$lOperation->setType(0);
		$lOperation->setIdCommande($pReservation->getId()->getIdCommande());
		
		$lOperationService = new OperationService();
		$lIdOperation = $lOperationService->set($lOperation);

		// Ajout detail operation
		$lDetailOperationService = new DetailOperationService;
		foreach($pReservation->getDetailReservation() as $lProduit) {			
			// Ajout du stock
			$lDetailOperation = new DetailOperationVO();
			$lDetailOperation->setIdOperation($lIdOperation);
			$lDetailOperation->setIdCompte($pReservation->getId()->getIdCompte());
			$lDetailOperation->setMontant($lProduit->getMontant());
			$lDetailOperation->setLibelle("Marché N°" . $pReservation->getId()->getIdCommande());
			$lDetailOperation->setTypePaiement(0);
			$lDetailOperation->setIdDetailCommande($lProduit->getIdDetailCommande());
			$lDetailOperationService->set($lDetailOperation);
		}

		return $lIdOperation;
	}
	
	/**
	* @name update($pReservation)
	* @param ReservationVO
	* @return integer
	* @desc Met à jour une réservation
	*/
	private function update($pReservation) {
		/*$this->insertHistorique($pReservation); // Ajout historique
		
		$lReservationActuelle = $this->get($pReservation->getId());
		
		$lCompteService = new CompteService(); // Mise à jour du solde
		$lCompte = $lCompteService->get($pReservation->getIdCompte());
		$lCompte->setSolde($lCompte->getSolde() - $lReservationActuelle->getMontant() + $pReservation->getMontant());
		$lCompteService->set($lCompte);
		
		return ReservationManager::update($pReservation); // update de l'opération*/
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Met à jour une réservation
	*/
	public function delete($pId) {
		/*$lReservationValid = new ReservationValid();
		if($lReservationValid->delete($pId)){
			$lReservation = $this->get($pId);
			$lReservation->setlibelle("Supression");
			$this->insertHistorique($lReservation); // Ajout historique
				
			$lCompteService = new CompteService(); // Mise à jour du solde
			$lCompte = $lCompteService->get($lReservation->getIdCompte());
			$lCompte->setSolde($lCompte->getSolde() - $lReservation->getMontant());
			$lCompteService->set($lCompte);
			
			return ReservationManager::delete($pId); // delete de l'opération		
		} else {
			return false;
		}*/
	}
			
	/**
	* @name get($pId)
	* @param integer
	* @return array(ReservationVO) ou ReservationVO
	* @desc Retourne une liste de reservation
	*/
	public function get($pId = null) {
		if($pId != null) {
		//	return $this->select($pId);
		} else {
		//	return $this->selectAll();
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return ReservationVO
	* @desc Retourne une Reservation
	*/
	public function select($pId) {
	//	return ReservationManager::select($pId);
	}
	
	/**
	* @name selectAll()
	* @return array(ReservationVO)
	* @desc Retourne une liste d'Reservation
	*/
	public function selectAll() {
	//	return ReservationManager::selectAll();
	}
}
?>