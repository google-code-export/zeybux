<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2011
// Fichier : AchatService.php
//
// Description : Classe AchatService
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_MANAGERS . "ReservationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueReservationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "ReservationValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );*/
include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "AchatValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AchatDetailSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AchatDetailViewManager.php");

/**
 * @name AchatService
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe Service d'une Achat
 */
class AchatService
{		
	/**
	* @name set($pAchat)
	* @param AchatVO
	* @return integer
	* @desc Ajoute ou modifie une réservation
	*/
	public function set($pAchat) {
		$lAchatValid = new AchatValid();
		if($lAchatValid->insert($pAchat)) {
			return $this->insert($pAchat);
		} else if($lAchatValid->updateReservation($pAchat)) {
			return $this->updateReservation($pAchat);
		} else if($lAchatValid->updateAchat($pAchat)) {
			return $this->updateAchat($pAchat);
		}
		return false;
	}
	
	/**
	* @name insert($pAchat)
	* @param AchatVO
	* @return integer
	* @desc Ajoute une réservation
	*/
	private function insert($pAchat) {
		// Calcul du total
		$lTotal = 0;
		foreach($pAchat->getDetailAchat() as $lProduit) {			
			$lTotal += $lProduit->getMontant();
		}
		$lTotalSolidaire = 0;
		foreach($pAchat->getDetailAchatSolidaire() as $lProduit) {			
			$lTotalSolidaire += $lProduit->getMontant();
		}
		
		// L'operation
		$lOperation = new OperationVO();
		$lOperation->setIdCompte($pAchat->getId()->getIdCompte());
		$lOperation->setMontant($lTotal);
		$lOperation->setLibelle("Marché N°" . $pAchat->getId()->getIdCommande());
		$lOperation->setTypePaiement(7);
		$lOperation->setIdCommande($pAchat->getId()->getIdCommande());
		
		// L'operation Solidaire
		$lOperationSolidaire = new OperationVO();
		$lOperationSolidaire->setIdCompte($pAchat->getId()->getIdCompte());
		$lOperationSolidaire->setMontant($lTotalSolidaire);
		$lOperationSolidaire->setLibelle("Marché Solidaire N°" . $pAchat->getId()->getIdCommande());
		$lOperationSolidaire->setTypePaiement(8);
		$lOperationSolidaire->setIdCommande($pAchat->getId()->getIdCommande());
		
		$lOperationService = new OperationService();
		if($lTotal < 0) {
			$lIdOperation = $lOperationService->set($lOperation);
	
			// Ajout detail operation		
			$lStockService = new StockService;		
			$lDetailOperationService = new DetailOperationService;
			foreach($pAchat->getDetailAchat() as $lProduit) {
				// Ajout du stock
				$lStock = new StockVO();
				$lStock->setQuantite($lProduit->getQuantite());
				$lStock->setType(1);
				$lStock->setIdCompte($pAchat->getId()->getIdCompte());
				$lStock->setIdDetailCommande($lProduit->getIdDetailCommande());
				$lStock->setIdOperation($lIdOperation);
				$lStockService->set($lStock);
					
				// Ajout du détail de l'operation
				$lDetailOperation = new DetailOperationVO();
				$lDetailOperation->setIdOperation($lIdOperation);
				$lDetailOperation->setIdCompte($pAchat->getId()->getIdCompte());
				$lDetailOperation->setMontant($lProduit->getMontant());
				$lDetailOperation->setLibelle("Marché N°" . $pAchat->getId()->getIdCommande());
				$lDetailOperation->setTypePaiement(7);
				$lDetailOperation->setIdDetailCommande($lProduit->getIdDetailCommande());
				$lDetailOperationService->set($lDetailOperation);
			}
		}
		
		if($lTotalSolidaire < 0) {
			$lIdOperationSolidaire = $lOperationService->set($lOperationSolidaire);
			// Ajout Détail Operation Solidaire
			foreach($pAchat->getDetailAchatSolidaire() as $lProduit) {
				// Ajout du stock
				$lStock = new StockVO();
				$lStock->setQuantite($lProduit->getQuantite());
				$lStock->setType(2);
				$lStock->setIdCompte($pAchat->getId()->getIdCompte());
				$lStock->setIdDetailCommande($lProduit->getIdDetailCommande());
				$lStock->setIdOperation($lIdOperationSolidaire);
				$lStockService->set($lStock);
					
				// Ajout du détail de l'operation
				$lDetailOperation = new DetailOperationVO();
				$lDetailOperation->setIdOperation($lIdOperationSolidaire);
				$lDetailOperation->setIdCompte($pAchat->getId()->getIdCompte());
				$lDetailOperation->setMontant($lProduit->getMontant());
				$lDetailOperation->setLibelle("Marché Solidaire N°" . $pAchat->getId()->getIdCommande());
				$lDetailOperation->setTypePaiement(8);
				$lDetailOperation->setIdDetailCommande($lProduit->getIdDetailCommande());
				$lDetailOperationService->set($lDetailOperation);
			}
		}
		return $lIdOperation;
	}
	
	/**
	* @name updateReservation($pAchat)
	* @param AchatVO
	* @return integer
	* @desc Met à jour une réservation pour la passer en achat
	*/
	private function updateReservation($pAchat) {
		$lIdReservation = new IdReservationVO();
		$lIdReservation->setIdCompte($pAchat->getId()->getIdCompte());
		$lIdReservation->setIdCommande($pAchat->getId()->getIdCommande());
		
		$lReservationService = new ReservationService();
		$lReservationActuelle = $lReservationService->get($lIdReservation);
		return $this->update($lReservationActuelle,$pAchat,$pAchat->getId()->getIdReservation());	
	}
	
	/**
	* @name updateAchat($pAchat)
	* @param AchatVO
	* @return integer
	* @desc Met à jour un achat
	*/
	private function updateAchat($pAchat) {
		$lAchat = $this->get($pAchat->getId());
		return $this->update($lAchat,$pAchat,$pAchat->getId()->getIdAchat());
	}
	
	/**
	* @name update($pAchat)
	* @param AchatVO
	* @return integer
	* @desc Met à jour une réservation
	*/
	private function update($pAchatActuel,$pNouvelAchat,$pIdOperation) {		
		// Récupération de l'opération
		$lOperationService = new OperationService();
		$lOperation = $lOperationService->get($pIdOperation);
		
		switch($lOperation->getTypePaiement()) {
			case 0: // Une réservation
				// Mise à jour du détail			
				$lTotal = $this->updateProduitReservationAchat($pAchatActuel,$pNouvelAchat,$pIdOperation);
				$lTotalSolidaire = $this->insertProduitAchatSolidaire($pNouvelAchat);
				if($lTotal < 0) {
					// Mise à jour de l'opération de réservation en achat
					$lOperation->setMontant($lTotal);
					$lOperation->setTypePaiement(7);
					$lOperationService->set($lOperation);
	
					// Operation sur le compte Zeybu
					$lOperationZeybu = new OperationVO();
					$lOperationZeybu->setIdCompte(-1);
					$lOperationZeybu->setMontant($lTotal * -1);
					$lOperationZeybu->setLibelle("Marché N°" . $pNouvelAchat->getId()->getIdCommande());
					$lOperationZeybu->setTypePaiement(7);
					$lOperationZeybu->setIdCommande($pNouvelAchat->getId()->getIdCommande());
					$lOperationService->set($lOperationZeybu);	
				} else {
					// Mise à jour de l'opération de réservation en annulation
					$lOperation->setTypePaiement(16);
					$lOperationService->set($lOperation);					
				}			
				break;
				
			case 7: // Achat
			/*	$lTotal = $this->updateProduitAchat($pAchatActuel,$pNouvelAchat,$pIdOperation);
				// Mise à jour de l'opération d'achat
				$lOperation->setMontant($lTotal);
				$lOperationService->set($lOperation);*/
				break;
				
			case 8: // Achat Solidaire
			/*	$lTotalSolidaire = $this->updateProduitAchatSolidaire($pAchatActuel,$pNouvelAchat,$pIdOperation);
				// Mise à jour de l'opération d'achat Solidaire
				$lOperation->setMontant($lTotalSolidaire);
				$lOperationService->set($lOperation);*/
				break;			
		}

		return true;
	}
	
	/**
	* @name updateProduitAchat($pAchatActuel,$pNouvelAchat,$pIdOperation)
	* @param AchatVO
	* @param AchatVO
	* @param integer
	* @return decimal(10,2)
	* @desc Met à jour les produits
	*/
	private function updateProduitAchat($pAchatActuel,$pNouvelAchat,$pIdOperation) {
		$lTotal = 0;

		$lStockService = new StockService();
		$lDetailOperationService = new DetailOperationService();

		foreach($pAchatActuel->getDetailAchat() as $lAchatActuelle) {
			$lTestUpdate = false;
			foreach($pNouvelAchat->getDetailAchat() as $lAchatNouvelle) {
				if($lAchatActuelle->getIdDetailCommande() == $lAchatNouvelle->getIdDetailCommande()) {
					$lTotal += $lAchatNouvelle->getMontant();
					
					// Maj du stock
					$lStock = new StockVO();
					$lStock->setId($lAchatActuelle->getId()->getIdStock());
					$lStock->setQuantite($lAchatNouvelle->getQuantite());
					$lStock->setType(1);
					$lStock->setIdCompte($pNouvelAchat->getId()->getIdCompte());
					$lStock->setIdDetailCommande($lAchatActuelle->getIdDetailCommande());
					$lStock->setIdOperation($pIdOperation);
					$lStockService->set($lStock);
					
					// Maj du détail Opération
					$lDetailOperation = new DetailOperationVO();
					$lDetailOperation->setId($lAchatActuelle->getId()->getIdDetailOperation());
					$lDetailOperation->setIdOperation($pIdOperation);
					$lDetailOperation->setIdCompte($pNouvelAchat->getId()->getIdCompte());
					$lDetailOperation->setMontant($lAchatNouvelle->getMontant());
					$lDetailOperation->setLibelle("Marché N°" . $pNouvelAchat->getId()->getIdCommande());
					$lDetailOperation->setTypePaiement(7);
					$lDetailOperation->setIdDetailCommande($lAchatActuelle->getIdDetailCommande());
					$lDetailOperationService->set($lDetailOperation);					
					
					$lTestUpdate = true;
				}
			}
			if(!$lTestUpdate) {
				// Suppression du stock et du detail operation
				$lStockService->delete($lAchatActuelle->getId()->getIdStock());
				$lDetailOperationService->delete($lAchatActuelle->getId()->getIdDetailOperation());
			}
		}
		
		foreach($pNouvelAchat->getDetailAchat() as $lAchatNouvelle) {
			$lTestInsert = true;
			foreach($pAchatActuel->getDetailAchat() as $lAchatActuelle) {
				if($lAchatActuelle->getIdDetailCommande() == $lAchatNouvelle->getIdDetailCommande()) {
					$lTestInsert = false;
				}
			}
			if($lTestInsert) {
				$lTotal += $lAchatNouvelle->getMontant();
					
				// Ajout du stock
				$lStock = new StockVO();
				$lStock->setQuantite($lAchatNouvelle->getQuantite());
				$lStock->setType(1);
				$lStock->setIdCompte($pNouvelAchat->getId()->getIdCompte());
				$lStock->setIdDetailCommande($lAchatNouvelle->getIdDetailCommande());
				$lStock->setIdOperation($pIdOperation);
				$lStockService->set($lStock);
				
				// Ajout du détail Opération
				$lDetailOperation = new DetailOperationVO();
				$lDetailOperation->setIdOperation($pIdOperation);
				$lDetailOperation->setIdCompte($pNouvelAchat->getId()->getIdCompte());
				$lDetailOperation->setMontant($lAchatNouvelle->getMontant());
				$lDetailOperation->setLibelle("Marché N°" . $pNouvelAchat->getId()->getIdCommande());
				$lDetailOperation->setTypePaiement(7);
				$lDetailOperation->setIdDetailCommande($lAchatNouvelle->getIdDetailCommande());
				$lDetailOperationService->set($lDetailOperation);	
			}
		}
		
		return $lTotal;		
	}
	
	/**
	* @name updateProduitReservationAchat($pAchatActuel,$pNouvelAchat,$pIdOperation)
	* @param AchatVO
	* @param AchatVO
	* @param integer
	* @return decimal(10,2)
	* @desc Met à jour les produits
	*/
	private function updateProduitReservationAchat($pAchatActuel,$pNouvelAchat,$pIdOperation) {
		$lTotal = 0;

		$lStockService = new StockService();
		$lDetailOperationService = new DetailOperationService();

		foreach($pAchatActuel->getDetailReservation() as $lAchatActuelle) {
			$lTestUpdate = false;
			foreach($pNouvelAchat->getDetailAchat() as $lAchatNouvelle) {
				if($lAchatActuelle->getIdDetailCommande() == $lAchatNouvelle->getIdDetailCommande()) {
					$lTotal += $lAchatNouvelle->getMontant();
					
					// Maj du stock
					$lStock = new StockVO();
					$lStock->setId($lAchatActuelle->getId()->getIdStock());
					$lStock->setQuantite($lAchatNouvelle->getQuantite());
					$lStock->setType(1);
					$lStock->setIdCompte($pNouvelAchat->getId()->getIdCompte());
					$lStock->setIdDetailCommande($lAchatActuelle->getIdDetailCommande());
					$lStock->setIdOperation($pIdOperation);
					$lStockService->set($lStock);
					
					// Maj du détail Opération
					$lDetailOperation = new DetailOperationVO();
					$lDetailOperation->setId($lAchatActuelle->getId()->getIdDetailOperation());
					$lDetailOperation->setIdOperation($pIdOperation);
					$lDetailOperation->setIdCompte($pNouvelAchat->getId()->getIdCompte());
					$lDetailOperation->setMontant($lAchatNouvelle->getMontant());
					$lDetailOperation->setLibelle("Marché N°" . $pNouvelAchat->getId()->getIdCommande());
					$lDetailOperation->setTypePaiement(7);
					$lDetailOperation->setIdDetailCommande($lAchatActuelle->getIdDetailCommande());
					$lDetailOperationService->set($lDetailOperation);					
					
					$lTestUpdate = true;
				}
			}
			if(!$lTestUpdate) {
				// Suppression du stock et du detail operation
				$lStockService->delete($lAchatActuelle->getId()->getIdStock());
				$lDetailOperationService->delete($lAchatActuelle->getId()->getIdDetailOperation());
			}
		}
		
		foreach($pNouvelAchat->getDetailAchat() as $lAchatNouvelle) {
			$lTestInsert = true;
			foreach($pAchatActuel->getDetailReservation() as $lAchatActuelle) {
				if($lAchatActuelle->getIdDetailCommande() == $lAchatNouvelle->getIdDetailCommande()) {
					$lTestInsert = false;
				}
			}
			if($lTestInsert) {
				$lTotal += $lAchatNouvelle->getMontant();
					
				// Ajout du stock
				$lStock = new StockVO();
				$lStock->setQuantite($lAchatNouvelle->getQuantite());
				$lStock->setType(1);
				$lStock->setIdCompte($pNouvelAchat->getId()->getIdCompte());
				$lStock->setIdDetailCommande($lAchatNouvelle->getIdDetailCommande());
				$lStock->setIdOperation($pIdOperation);
				$lStockService->set($lStock);
				
				// Ajout du détail Opération
				$lDetailOperation = new DetailOperationVO();
				$lDetailOperation->setIdOperation($pIdOperation);
				$lDetailOperation->setIdCompte($pNouvelAchat->getId()->getIdCompte());
				$lDetailOperation->setMontant($lAchatNouvelle->getMontant());
				$lDetailOperation->setLibelle("Marché N°" . $pNouvelAchat->getId()->getIdCommande());
				$lDetailOperation->setTypePaiement(7);
				$lDetailOperation->setIdDetailCommande($lAchatNouvelle->getIdDetailCommande());
				$lDetailOperationService->set($lDetailOperation);	
			}
		}
		
		return $lTotal;		
	}
	
	
	/**
	* @name updateProduitAchatSolidaire($pAchatActuel,$pNouvelAchat,$pIdOperation)
	* @param AchatVO
	* @param AchatVO
	* @param integer
	* @return decimal(10,2)
	* @desc Met à jour les produits solidaire
	*/
	private function updateProduitAchatSolidaire($pAchatActuel,$pNouvelAchat,$pIdOperation) {
		$lTotalSolidaire = 0;
		
		$lStockService = new StockService();
		$lDetailOperationService = new DetailOperationService();
		
		foreach($pAchatActuel->getDetailAchatSolidaire() as $lAchatActuelle) {
			$lTestUpdate = false;
			foreach($pNouvelAchat->getDetailAchatSolidaire() as $lAchatNouvelle) {
				if($lAchatActuelle->getIdDetailCommande() == $lAchatNouvelle->getIdDetailCommande()) {
					$lTotalSolidaire += $lAchatNouvelle->getMontant();
					
					// Maj du stock
					$lStock = new StockVO();
					$lStock->setId($lAchatActuelle->getId()->getIdStock());
					$lStock->setQuantite($lAchatNouvelle->getQuantite());
					$lStock->setType(2);
					$lStock->setIdCompte($pNouvelAchat->getId()->getIdCompte());
					$lStock->setIdDetailCommande($lAchatActuelle->getIdDetailCommande());
					$lStock->setIdOperation($pIdOperation);
					$lStockService->set($lStock);
					
					// Maj du détail Opération
					$lDetailOperation = new DetailOperationVO();
					$lDetailOperation->setId($lAchatActuelle->getId()->getIdDetailOperation());
					$lDetailOperation->setIdOperation($pIdOperation);
					$lDetailOperation->setIdCompte($pNouvelAchat->getId()->getIdCompte());
					$lDetailOperation->setMontant($lAchatNouvelle->getMontant());
					$lDetailOperation->setLibelle("Marché Solidaire N°" . $pNouvelAchat->getId()->getIdCommande());
					$lDetailOperation->setTypePaiement(8);
					$lDetailOperation->setIdDetailCommande($lAchatActuelle->getIdDetailCommande());
					$lDetailOperationService->set($lDetailOperation);					
					
					$lTestUpdate = true;
				}
			}
			if(!$lTestUpdate) {
				// Suppression du stock et du detail operation
				$lStockService->delete($lAchatActuelle->getId()->getIdStock());
				$lDetailOperationService->delete($lAchatActuelle->getId()->getIdDetailOperation());
			}
		}
		
		foreach($pNouvelAchat->getDetailAchatSolidaire() as $lAchatNouvelle) {
			$lTestInsert = true;
			foreach($pAchatActuel->getDetailAchatSolidaire() as $lAchatActuelle) {
				if($lAchatActuelle->getIdDetailCommande() == $lAchatNouvelle->getIdDetailCommande()) {
					$lTestInsert = false;
				}
			}
			if($lTestInsert) {
				$lTotalSolidaire += $lAchatNouvelle->getMontant();
					
				// Ajout du stock
				$lStock = new StockVO();
				$lStock->setQuantite($lAchatNouvelle->getQuantite());
				$lStock->setType(2);
				$lStock->setIdCompte($pNouvelAchat->getId()->getIdCompte());
				$lStock->setIdDetailCommande($lAchatNouvelle->getIdDetailCommande());
				$lStock->setIdOperation($pIdOperation);
				$lStockService->set($lStock);
				
				// Ajout du détail Opération
				$lDetailOperation = new DetailOperationVO();
				$lDetailOperation->setIdOperation($pIdOperation);
				$lDetailOperation->setIdCompte($pNouvelAchat->getId()->getIdCompte());
				$lDetailOperation->setMontant($lAchatNouvelle->getMontant());
				$lDetailOperation->setLibelle("Marché Solidaire N°" . $pNouvelAchat->getId()->getIdCommande());
				$lDetailOperation->setTypePaiement(8);
				$lDetailOperation->setIdDetailCommande($lAchatNouvelle->getIdDetailCommande());
				$lDetailOperationService->set($lDetailOperation);	
			}
		}
		return $lTotalSolidaire;
	}
	
	/**
	* @name insertProduitAchatSolidaire($pAchat)
	* @param AchatVO
	* @return decimal(10,2)
	* @desc Ajoute les produits solidaire
	*/
	private function insertProduitAchatSolidaire($pAchat) {
		$lTotalSolidaire = 0;
		foreach($pAchat->getDetailAchatSolidaire() as $lProduit) {			
			$lTotalSolidaire += $lProduit->getMontant();
		}
		
		// L'operation Solidaire
		$lOperationSolidaire = new OperationVO();
		$lOperationSolidaire->setIdCompte($pAchat->getId()->getIdCompte());
		$lOperationSolidaire->setMontant($lTotalSolidaire);
		$lOperationSolidaire->setLibelle("Marché Solidaire N°" . $pAchat->getId()->getIdCommande());
		$lOperationSolidaire->setTypePaiement(8);
		$lOperationSolidaire->setIdCommande($pAchat->getId()->getIdCommande());
		
		$lOperationService = new OperationService();
				
		if($lTotalSolidaire < 0) {
			$lIdOperationSolidaire = $lOperationService->set($lOperationSolidaire);
			// Ajout Détail Operation Solidaire
			$lStockService = new StockService();
			$lDetailOperationService = new DetailOperationService();
			foreach($pAchat->getDetailAchatSolidaire() as $lProduit) {
				// Ajout du stock
				$lStock = new StockVO();
				$lStock->setQuantite($lProduit->getQuantite());
				$lStock->setType(2);
				$lStock->setIdCompte($pAchat->getId()->getIdCompte());
				$lStock->setIdDetailCommande($lProduit->getIdDetailCommande());
				$lStock->setIdOperation($lIdOperationSolidaire);
				$lStockService->set($lStock);
					
				// Ajout du détail de l'operation
				$lDetailOperation = new DetailOperationVO();
				$lDetailOperation->setIdOperation($lIdOperationSolidaire);
				$lDetailOperation->setIdCompte($pAchat->getId()->getIdCompte());
				$lDetailOperation->setMontant($lProduit->getMontant());
				$lDetailOperation->setLibelle("Marché Solidaire N°" . $pAchat->getId()->getIdCommande());
				$lDetailOperation->setTypePaiement(8);
				$lDetailOperation->setIdDetailCommande($lProduit->getIdDetailCommande());
				$lDetailOperationService->set($lDetailOperation);
			}
			
			// Operation sur le compte Zeybu
			$lOperationZeybu = new OperationVO();
			$lOperationZeybu->setIdCompte(-1);
			$lOperationZeybu->setMontant($lTotalSolidaire * -1);
			$lOperationZeybu->setLibelle("Marché Solidaire N°" . $pAchat->getId()->getIdCommande());
			$lOperationZeybu->setTypePaiement(8);
			$lOperationZeybu->setIdCommande($pAchat->getId()->getIdCommande());
			$lOperationService->set($lOperationZeybu);	
		}
		return $lTotalSolidaire;
	}
		
	/**
	* @name delete($pId)
	* @param IdAchatVO
	* @desc Met à jour une réservation
	*/
	/*public function delete($pIdAchat) {
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
	}*/
			
	/**
	* @name get($pId)
	* @param integer
	* @return array(AchatVO) ou AchatVO
	* @desc Retourne une liste d'achat
	*/
	public function get($pId = null) {
		$lAchatValid = new AchatValid();
		if(!is_null($pId) && $lAchatValid->select($pId)) {
			return $this->select($pId);
		} else {
			return false;
		}
	}
	
	/**
	* @name selectOperationAchat($pId)
	* @param IdReservation
	* @return array(OperationVO)
	* @desc Retourne une liste d'operation
	*/
	/*public function selectOperationAchat($pId) {
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
	/*public function existe($pId) {		
		$lOperations = $this->selectOperationReservation($pId);
		$lIdOperation = $lOperations[0]->getId();
		return !is_null($lIdOperation);
	}
	
	/**
	* @name select($pId)
	* @param IdAchatVO
	* @return AchatVO
	* @desc Retourne une Reservation
	*/
	public function select($pId) {			
		$lOperation = OperationManager::select($pId->getIdAchat());
	
		$lAchat = new AchatVO();
		$lAchat->setId($pId);
		
		// Recherche du détail de la reservation
		switch($lOperation->getTypePaiement()) {
			case 7: // Un achat				
				$lDetailsAchat = AchatDetailViewManager::select($lOperation->getId());
				foreach($lDetailsAchat as $lDetail) {					
					if(!is_null($lStock->getId())) {
						$lDetailAchat = new DetailReservationVO();
						$lDetailAchat->getId()->setIdStock($lDetail->getStoId());
						$lDetailAchat->getId()->setIdDetailOperation($lDetail->getDopeId());
						$lDetailAchat->setIdDetailCommande($lDetail->getStoIdDetailCommande());
						$lDetailAchat->setMontant($lDetail->getDopeMontant());
						$lDetailAchat->setQuantite($lDetail->getStoQuantite());
						
						$lAchat->addDetailAchat($lDetailAchat);
					}
				}					
				break;
				
			case 8: // Achat Solidaire
				$lDetailsAchat = AchatDetailSolidaireViewManager::select($lOperation->getId());
				foreach($lDetailsAchat as $lDetail) {					
					if(!is_null($lStock->getId())) {
						$lDetailAchat = new DetailReservationVO();
						$lDetailAchat->getId()->setIdStock($lDetail->getStoId());
						$lDetailAchat->getId()->setIdDetailOperation($lDetail->getDopeId());
						$lDetailAchat->setIdDetailCommande($lDetail->getStoIdDetailCommande());
						$lDetailAchat->setMontant($lDetail->getDopeMontant());
						$lDetailAchat->setQuantite($lDetail->getStoQuantite());
						
						$lAchat->addDetailAchatSolidaire($lDetailAchat);
					}
				}
				break;
		}		
		return $lAchat;
	}
}
?>