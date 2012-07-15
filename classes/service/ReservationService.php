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
include_once(CHEMIN_CLASSES_VO . "ReservationVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ReservationValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationDetailViewManager.php");

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
			$lOperations = $this->selectOperationReservation($pReservation->getId());
			$lOperation = $lOperations[0];
			$lIdOperation = $lOperation->getId();
			if(is_null($lIdOperation) || $lOperation->getTypePaiement() != 0) {
				return $this->insert($pReservation);			
			} else if($lReservationValid->update($pReservation)) {
				return $this->update($pReservation);
			}
		}
		return false;
	}
	
	/**
	* @name insert($pReservation)
	* @param ReservationVO
	* @return integer
	* @desc Ajoute une réservation
	*/
	private function insert($pReservation) {
		// Calcul du total
		$lTotal = 0;
		foreach($pReservation->getDetailReservation() as $lProduit) {			
			$lTotal += $lProduit->getMontant();
		}
		
		// L'operation
		$lOperation = new OperationVO();
		$lOperation->setIdCompte($pReservation->getId()->getIdCompte());
		$lOperation->setMontant($lTotal);
		$lOperation->setLibelle("Marché N°" . $pReservation->getId()->getIdCommande());
		$lOperation->setTypePaiement(0);
//		$lOperation->setType(0);
		$lOperation->setIdCommande($pReservation->getId()->getIdCommande());
		
		$lOperationService = new OperationService();
		$lIdOperation = $lOperationService->set($lOperation);

		// Ajout detail operation		
		$lStockService = new StockService;		
		$lDetailOperationService = new DetailOperationService;
		foreach($pReservation->getDetailReservation() as $lProduit) {
			// Ajout du stock
			$lStock = new StockVO();
			$lStock->setQuantite($lProduit->getQuantite());
			$lStock->setType(0);
			$lStock->setIdCompte($pReservation->getId()->getIdCompte());
			$lStock->setIdDetailCommande($lProduit->getIdDetailCommande());
			$lStock->setIdOperation($lIdOperation);
			$lStockService->set($lStock);
				
			// Ajout du détail de l'operation
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
		$lTestDetailReservation = $pReservation->getDetailReservation();
		if(!empty($lTestDetailReservation)) { // Si il y a encore des produits dans la réservation
			$lReservationsActuelle = $this->get($pReservation->getId());
			$lOperations = $this->selectOperationReservation($pReservation->getId());
			$lOperation = $lOperations[0];
			$lIdOperation = $lOperation->getId();
			$lTotal = 0;
	
			$lStockService = new StockService();
			$lDetailOperationService = new DetailOperationService();
	//var_dump($lReservationsActuelle);
	//var_dump($lOperations);
			foreach($lReservationsActuelle->getDetailReservation() as $lReservationActuelle) {
				$lTestUpdate = false;
				foreach($pReservation->getDetailReservation() as $lReservationNouvelle) {
					if($lReservationActuelle->getIdDetailCommande() == $lReservationNouvelle->getIdDetailCommande()) {
						$lTotal += $lReservationNouvelle->getMontant();
			//			echo "update";
			//			var_dump($lReservationNouvelle);
						// Maj du stock
						$lStock = new StockVO();
						$lStock->setId($lReservationActuelle->getId()->getIdStock());
						$lStock->setQuantite($lReservationNouvelle->getQuantite());
						$lStock->setType(0);
						$lStock->setIdCompte($pReservation->getId()->getIdCompte());
						$lStock->setIdDetailCommande($lReservationActuelle->getIdDetailCommande());
						$lStock->setIdOperation($lIdOperation);
						$lStockService->set($lStock);
						
						// Maj du détail Opération
						$lDetailOperation = new DetailOperationVO();
						$lDetailOperation->setId($lReservationActuelle->getId()->getIdDetailOperation());
						$lDetailOperation->setIdOperation($lIdOperation);
						$lDetailOperation->setIdCompte($pReservation->getId()->getIdCompte());
						$lDetailOperation->setMontant($lReservationNouvelle->getMontant());
						$lDetailOperation->setLibelle("Marché N°" . $pReservation->getId()->getIdCommande());
						$lDetailOperation->setTypePaiement(0);
						$lDetailOperation->setIdDetailCommande($lReservationActuelle->getIdDetailCommande());
						$lDetailOperationService->set($lDetailOperation);					
						
						$lTestUpdate = true;
					}
				}
				if(!$lTestUpdate) {
		//			echo "delete";
		//			var_dump($lReservationActuelle);
					// Suppression du stock et du detail operation
					$lStockService->delete($lReservationActuelle->getId()->getIdStock());
					$lDetailOperationService->delete($lReservationActuelle->getId()->getIdDetailOperation());
				}
			}
			
			foreach($pReservation->getDetailReservation() as $lReservationNouvelle) {
				$lTestInsert = true;
				foreach($lReservationsActuelle->getDetailReservation() as $lReservationActuelle) {
					if($lReservationActuelle->getIdDetailCommande() == $lReservationNouvelle->getIdDetailCommande()) {
						$lTestInsert = false;
					}
				}
				if($lTestInsert) {
		//			echo "insert";
		//			var_dump($lReservationNouvelle);
					$lTotal += $lReservationNouvelle->getMontant();
						
					// Ajout du stock
					$lStock = new StockVO();
					$lStock->setQuantite($lReservationNouvelle->getQuantite());
					$lStock->setType(0);
					$lStock->setIdCompte($pReservation->getId()->getIdCompte());
					$lStock->setIdDetailCommande($lReservationNouvelle->getIdDetailCommande());
					$lStock->setIdOperation($lIdOperation);
					$lStockService->set($lStock);
					
					// Ajout du détail Opération
					$lDetailOperation = new DetailOperationVO();
					$lDetailOperation->setIdOperation($lIdOperation);
					$lDetailOperation->setIdCompte($pReservation->getId()->getIdCompte());
					$lDetailOperation->setMontant($lReservationNouvelle->getMontant());
					$lDetailOperation->setLibelle("Marché N°" . $pReservation->getId()->getIdCommande());
					$lDetailOperation->setTypePaiement(0);
					$lDetailOperation->setIdDetailCommande($lReservationNouvelle->getIdDetailCommande());
					$lDetailOperationService->set($lDetailOperation);	
				}
			}
	
			// Maj de l'opération
			$lOperationService = new OperationService();
			$lOperation->setMontant($lTotal);
			$lOperationService->set($lOperation);
		} else { // La réservation est vide on la supprime
			$this->delete($pReservation->getId());
		}
	}
	
	/**
	* @name delete($pId)
	* @param IdReservationVO
	* @desc Met à jour une réservation
	*/
	public function delete($pIdReservation) {
		$lReservationsActuelle = $this->get($pIdReservation);
		$lOperations = $this->selectOperationReservation($pIdReservation);
		$lOperation = $lOperations[0];
		$lIdOperation = $lOperation->getId();
		
		// Suppression de l'opération
		$lOperationService = new OperationService();
		$lOperationService->delete($lIdOperation);
		
		$lStockService = new StockService();
		$lDetailOperationService = new DetailOperationService();
		foreach($lReservationsActuelle->getDetailReservation() as $lReservationActuelle) {
			// Suppression du stock et du detail operation
			$lStockService->delete($lReservationActuelle->getId()->getIdStock());
			$lDetailOperationService->delete($lReservationActuelle->getId()->getIdDetailOperation());
		}
	}
			
	/**
	* @name get($pId)
	* @param integer
	* @return array(ReservationVO) ou ReservationVO
	* @desc Retourne une liste de reservation
	*/
	public function get($pId = null) {
		$lReservationValid = new ReservationValid();
		if(!is_null($pId) && $lReservationValid->select($pId)) {
			return $this->select($pId);
		} else {
			return false;
		}
	}
	
	/**
	* @name selectOperationReservation($pId)
	* @param IdReservation
	* @return array(OperationVO)
	* @desc Retourne une liste d'operation
	*/
	public function selectOperationReservation($pId) {
		// ORDER BY date -> récupère la dernière operation en lien avec la commande
		return OperationManager::recherche(
			array(OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT,OperationManager::CHAMP_OPERATION_ID_COMPTE,OperationManager::CHAMP_OPERATION_ID_COMMANDE),
			array('in','=','='),
			array(array(0,7,15,16), $pId->getIdCompte(),$pId->getIdCommande()),
			array(OperationManager::CHAMP_OPERATION_DATE,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
			array('DESC','ASC'));
	}

	/**
	* @name existe($pId)
	* @param IdReservation
	* @return bool
	* @desc Retourne si une réservation existe
	*/
	public function existe($pId) {		
		$lOperations = $this->selectOperationReservation($pId);
		$lIdOperation = $lOperations[0]->getId();
		return !is_null($lIdOperation);
	}
	
	/**
	* @name enCours($pId)
	* @param IdReservation
	* @return bool
	* @desc Retourne si une réservation est en cours
	*/
	public function enCours($pId) {		
		$lOperations = $this->selectOperationReservation($pId);
		$lOperation = $lOperations[0];
		return $lOperation->getTypePaiement() == 0 && !is_null($lOperation->getTypePaiement());
	}
	
	/**
	* @name select($pId)
	* @param IdReservationVO
	* @return ReservationVO
	* @desc Retourne une Reservation
	*/
	public function select($pId) {			
		$lOperations = $this->selectOperationReservation($pId);

		$lReservation = new ReservationVO();
		$lReservation->setId($pId);
		
		// Recherche du détail de la reservation
		$lDetailOperationService = new DetailOperationService();
		$lStockService = new StockService();
		if(!is_null($lOperations[0]->getTypePaiement())) {
			
			$lReservation->setEtat($lOperations[0]->getTypePaiement());
			
			switch($lOperations[0]->getTypePaiement()) {
				case 7: // Un achat
					foreach($lOperations as $lOperation) {
						if($lOperation->getTypePaiement() == 7) {
							$lDetailsReservation = ReservationDetailViewManager::selectDetail($lOperation->getId(),0,0);
							if(!is_null($lDetailsReservation[0]->getStoIdOperation())) {
								foreach($lDetailsReservation as $lDetail) {
									$lDetailReservation = new DetailReservationVO();
									$lDetailReservation->getId()->setIdStock($lDetail->getStoId());
									$lDetailReservation->getId()->setIdDetailOperation($lDetail->getDopeId());
									$lDetailReservation->setIdDetailCommande($lDetail->getStoIdDetailCommande());
									$lDetailReservation->setMontant($lDetail->getDopeMontant());
									$lDetailReservation->setQuantite($lDetail->getStoQuantite());
									$lDetailReservation->setIdProduit($lDetail->getDcomIdProduit());
									
									$lReservation->addDetailReservation($lDetailReservation);
								}
								$lReservation->setTotal($lOperation->getMontant());
							}			
						}		
					}	
					break;
					
				case 0: // Reservation en cours
					$lOperation = $lOperations[0];
					$lDetailsReservation = ReservationDetailViewManager::selectDetail($lOperation->getId(),0,0);
					foreach($lDetailsReservation as $lDetail) {
						if($lDetail->getDopeTypePaiement() == 0) {
							$lDetailReservation = new DetailReservationVO();
							$lDetailReservation->getId()->setIdStock($lDetail->getStoId());
							$lDetailReservation->getId()->setIdDetailOperation($lDetail->getDopeId());
							$lDetailReservation->setIdDetailCommande($lDetail->getStoIdDetailCommande());
							$lDetailReservation->setMontant($lDetail->getDopeMontant());
							$lDetailReservation->setQuantite($lDetail->getStoQuantite());
							$lDetailReservation->setIdProduit($lDetail->getDcomIdProduit());
							
							$lReservation->addDetailReservation($lDetailReservation);
						}
					}
					$lReservation->setTotal($lOperation->getMontant());
					break;
					
				case 15: // Reservation non récupérée
					$lOperation = $lOperations[0];
					$lDetailsReservation = ReservationDetailViewManager::selectDetail($lOperation->getId(),15,5);
					foreach($lDetailsReservation as $lDetail) {
						if($lDetail->getDopeTypePaiement() == 15) {
							$lDetailReservation = new DetailReservationVO();
							$lDetailReservation->getId()->setIdStock($lDetail->getStoId());
							$lDetailReservation->getId()->setIdDetailOperation($lDetail->getDopeId());
							$lDetailReservation->setIdDetailCommande($lDetail->getStoIdDetailCommande());
							$lDetailReservation->setMontant($lDetail->getDopeMontant());
							$lDetailReservation->setQuantite($lDetail->getStoQuantite());
							$lDetailReservation->setIdProduit($lDetail->getDcomIdProduit());
							
							$lReservation->addDetailReservation($lDetailReservation);
						}
					}
					$lReservation->setTotal($lOperation->getMontant());
					break;
					
				case 16: // Reservation annulée
					$lOperation = $lOperations[0];
					$lDetailsReservation = ReservationDetailViewManager::selectDetail($lOperation->getId(),16,6);
					foreach($lDetailsReservation as $lDetail) {
						if($lDetail->getDopeTypePaiement() == 16) {					
							$lDetailReservation = new DetailReservationVO();
							$lDetailReservation->getId()->setIdStock($lDetail->getStoId());
							$lDetailReservation->getId()->setIdDetailOperation($lDetail->getDopeId());
							$lDetailReservation->setIdDetailCommande($lDetail->getStoIdDetailCommande());
							$lDetailReservation->setMontant($lDetail->getDopeMontant());
							$lDetailReservation->setQuantite($lDetail->getStoQuantite());
							$lDetailReservation->setIdProduit($lDetail->getDcomIdProduit());
							
							$lReservation->addDetailReservation($lDetailReservation);
						}
					}
					$lReservation->setTotal($lOperation->getMontant());
					break;
					
					/*$lOperation = $lOperations[0];
					$lDetailsOperation = $lDetailOperationService->getDetailReservation($lOperation->getId());
					$lDetailOperation = $lDetailsOperation[0];
					$lStocks = $lStockService->getDetailReservation($lOperation->getId());
					$lStock = $lStocks[0];
					
					$lDetailReservation = new DetailReservationVO();
					$lDetailReservation->getId()->setIdStock($lStock->getId());
					$lDetailReservation->getId()->setIdDetailOperation($lDetailOperation->getId());
					$lDetailReservation->setIdDetailCommande($lDetailOperation->getIdDetailCommande());
					$lDetailReservation->setMontant($lDetailOperation->getMontant());
					$lDetailReservation->setQuantite($lStock->getQuantite());
	
					$lReservation->addDetailReservation($lDetailReservation);*/
					//break;
			}
		}
		return $lReservation;
	}
	
	/**
	* @name selectAll()
	* @return array(ReservationVO)
	* @desc Retourne une liste d'Reservation
	*/
	public function selectAll() {
	//	return ReservationManager::selectAll();
	}

	/**
	* @name reservationSurLot($pId)
	* @param integer
	* @return bool
	* @desc Si des réservations sont positionnées sur le lot
	*/
	public function reservationSurLot($pId) {
		$lDetail = ReservationDetailViewManager::selectReservationEnCoursByLot($pId,0,0);
		return !is_null($lDetail[0]->getStoId());
	}
	
	/**
	* @name getReservationSurLot($pId)
	* @param integer
	* @return array(ReservationDetailViewVO)
	* @desc Retourne les réservations positionnées sur le lot
	*/
	public function getReservationSurLot($pId) {
		return ReservationDetailViewManager::selectReservationEnCoursByLot($pId,0,0);
	}
}
?>