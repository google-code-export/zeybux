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
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");
include_once(CHEMIN_CLASSES_VO . "ProduitCommandeVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeAchatReservationVO.php");
include_once(CHEMIN_CLASSES_VO . "DetailReservationVO.php");
include_once(CHEMIN_CLASSES_VO . "DetailCommandeVO.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "AchatValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AchatDetailSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AchatDetailViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailMarcheViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );

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
		
		$lOperationService = new OperationService();
		if($lTotal < 0) {
			// L'operation
			$lOperation = new OperationVO();
			$lOperation->setIdCompte($pAchat->getId()->getIdCompte());
			$lOperation->setMontant($lTotal);
			// Si achat hors marché n'affiche que la date
			if($pAchat->getId()->getIdCommande() != '') {
				$lOperation->setLibelle("Marché N°" . $pAchat->getId()->getIdCommande());
			} else {
				$lOperation->setLibelle("Achat du " . StringUtils::dateAujourdhuiFr());
			}
			$lOperation->setTypePaiement(7);
			$lOperation->setIdCommande($pAchat->getId()->getIdCommande());
			$lIdOperation = $lOperationService->set($lOperation);
			
			// Operation sur le compte Zeybu
			$lOperationZeybu = new OperationVO();
			$lOperationZeybu->setIdCompte(-1);
			$lOperationZeybu->setMontant($lTotal * -1);
			// Si achat hors marché n'affiche que la date
			if($pAchat->getId()->getIdCommande() != '') {
				$lOperationZeybu->setLibelle("Marché N°" . $pAchat->getId()->getIdCommande());
			} else {
				$lOperationZeybu->setLibelle("Achat du " . StringUtils::dateAujourdhuiFr());
			}
			$lOperationZeybu->setTypePaiement(7);
			$lOperationZeybu->setTypePaiementChampComplementaire($lIdOperation);
			$lOperationZeybu->setIdCommande($pAchat->getId()->getIdCommande());
			$lIdOperationZeybu = $lOperationService->set($lOperationZeybu);

			$lOperation->setTypePaiementChampComplementaire($lIdOperationZeybu);
			$lOperationService->set($lOperation);
	
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
				
				// Ajout ou Maj de la qté produit dans le stock
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduit->getIdNomProduit(),$lProduit->getUnite());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
					//$lStockQuantiteActuel->setQuantite(0);
				}
				$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() + $lProduit->getQuantite());
				$lStockQuantite->setIdNomProduit($lProduit->getIdNomProduit());
				$lStockQuantite->setUnite($lProduit->getUnite());
				$lStockService->setStockQuantite($lStockQuantite);
					
				// Ajout du détail de l'operation
				$lDetailOperation = new DetailOperationVO();
				$lDetailOperation->setIdOperation($lIdOperation);
				$lDetailOperation->setIdCompte($pAchat->getId()->getIdCompte());
				$lDetailOperation->setMontant($lProduit->getMontant());
				// Si achat hors marché n'affiche que la date
				if($pAchat->getId()->getIdCommande() != '') {
					$lDetailOperation->setLibelle("Marché N°" . $pAchat->getId()->getIdCommande());
				} else {
					$lDetailOperation->setLibelle("Achat du " . StringUtils::dateAujourdhuiFr());
				}
				$lDetailOperation->setTypePaiement(7);
				$lDetailOperation->setIdDetailCommande($lProduit->getIdDetailCommande());
				$lDetailOperationService->set($lDetailOperation);
			}
		}	
		// Ajout des produits solidaire
		$lIdOperation = $this->insertProduitAchatSolidaire($pAchat);
		
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
				$lIdOperationSolidaire = $this->insertProduitAchatSolidaire($pNouvelAchat);
				if($lTotal < 0) {
					// Mise à jour de l'opération de réservation en achat
					$lOperation->setMontant($lTotal);
					$lOperation->setTypePaiement(7);
					$lIdOperation = $lOperationService->set($lOperation);
	
					// Operation sur le compte Zeybu
					$lOperationZeybu = new OperationVO();
					$lOperationZeybu->setIdCompte(-1);
					$lOperationZeybu->setMontant($lTotal * -1);
					$lOperationZeybu->setLibelle("Marché N°" . $pNouvelAchat->getId()->getIdCommande());
					$lOperationZeybu->setTypePaiement(7);
					$lOperationZeybu->setTypePaiementChampComplementaire($lIdOperation);
					$lOperationZeybu->setIdCommande($pNouvelAchat->getId()->getIdCommande());
					$lIdOperationZeybu = $lOperationService->set($lOperationZeybu);	
					
					$lOperation->setTypePaiementChampComplementaire($lIdOperationZeybu);
					$lOperationService->set($lOperation);
				} else {
					// Mise à jour de l'opération de réservation en annulation
					$lOperationService->delete($lOperation->getId());				
				}		
				break;
				
			case 7: // Achat
				$lTotal = $this->updateProduitAchat($pAchatActuel,$pNouvelAchat,$pIdOperation);
				if($lTotal < 0) {
					// Mise à jour de l'opération d'achat
					$lOperation->setMontant($lTotal);
					$lOperationService->set($lOperation);
					
					
					$lOperationZeybu = $lOperationService->get($lOperation->getTypePaiementChampComplementaire());
					$lOperationZeybu->setMontant($lTotal * -1);
					$lOperationService->set($lOperationZeybu);
				} else {
					// Mise à jour de l'opération en annulation
					//$lOperation->setTypePaiement(18);
					$lOperationService->delete($lOperation->getId());		

					$lOperationZeybu = $lOperationService->get($lOperation->getTypePaiementChampComplementaire());
					//$lOperationZeybu->setTypePaiement(18);
					$lOperationService->delete($lOperationZeybu->getId());	
				}
				break;
				
			case 8: // Achat Solidaire
				$lTotalSolidaire = $this->updateProduitAchatSolidaire($pAchatActuel,$pNouvelAchat,$pIdOperation);
				if($lTotalSolidaire < 0) {
					// Mise à jour de l'opération d'achat
					$lOperation->setMontant($lTotalSolidaire);
					$lOperationService->set($lOperation);
										
					$lOperationZeybu = $lOperationService->get($lOperation->getTypePaiementChampComplementaire());
					$lOperationZeybu->setMontant($lTotalSolidaire * -1);
					$lOperationService->set($lOperationZeybu);
				} else {
					// Mise à jour de l'opération en annulation
					//$lOperation->setTypePaiement(20);
					$lOperationService->delete($lOperation->getId());		

					$lOperationZeybu = $lOperationService->get($lOperation->getTypePaiementChampComplementaire());
					//$lOperationZeybu->setTypePaiement(20);
					$lOperationService->delete($lOperationZeybu->getId());	
				}
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
					
					// Ajout ou Maj de la qté produit dans le stock
					$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatNouvelle->getIdNomProduit(),$lAchatNouvelle->getUnite());
					$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
					$lStockQuantite = new StockQuantiteVO();
					if(!is_null($lStockQuantiteActuel->getId())) {
						$lStockQuantite->setId($lStockQuantiteActuel->getId());
						$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
					}
					$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() + $lAchatNouvelle->getQuantite() - $lAchatActuelle->getQuantite());
					$lStockQuantite->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
					$lStockQuantite->setUnite($lAchatNouvelle->getUnite());
					
					$lStockService->setStockQuantite($lStockQuantite);
					
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
				
				
				
			/*	$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatActuelle->getIdNomProduit(),$lAchatActuelle->getUnite());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
				}
				$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() - $lAchatActuelle->getQuantite());
				$lStockQuantite->setIdNomProduit($lAchatActuelle->getIdNomProduit());
				$lStockQuantite->setUnite($lAchatActuelle->getUnite());
				$lStockService->setStockQuantite($lStockQuantite);*/
				
				// Ajout ou Maj de la qté produit dans le stock
				$lStock = $lStockService->get($lAchatActuelle->getId()->getIdStock());
				$lDetailMarche = DetailMarcheViewManager::selectByLot($lStock->getIdDetailCommande());
				$lDetailMarche = $lDetailMarche[0];
				
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lDetailMarche->getProIdNomProduit(),$lDetailMarche->getProUniteMesure());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
				}
				$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() - $lAchatActuelle->getQuantite());
				$lStockQuantite->setIdNomProduit($lDetailMarche->getProIdNomProduit());
				$lStockQuantite->setUnite($lDetailMarche->getProUniteMesure());
				$lStockService->setStockQuantite($lStockQuantite);
				
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
				
				// Ajout ou Maj de la qté produit dans le stock
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatNouvelle->getIdNomProduit(),$lAchatNouvelle->getUnite());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
				}
				$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() + $lAchatNouvelle->getQuantite());
				$lStockQuantite->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
				$lStockQuantite->setUnite($lAchatNouvelle->getUnite());
				$lStockService->setStockQuantite($lStockQuantite);
				
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
					//$lStock->setId($lAchatActuelle->getId()->getIdStock());
					$lStock->setQuantite($lAchatNouvelle->getQuantite());
					$lStock->setType(1);
					$lStock->setIdCompte($pNouvelAchat->getId()->getIdCompte());
					$lStock->setIdDetailCommande($lAchatActuelle->getIdDetailCommande());
					$lStock->setIdOperation($pIdOperation);
					$lStockService->set($lStock);
					
					// Ajout ou Maj de la qté produit dans le stock
					$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatNouvelle->getIdNomProduit(),$lAchatNouvelle->getUnite());
					$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
					$lStockQuantite = new StockQuantiteVO();
					if(!is_null($lStockQuantiteActuel->getId())) {
						$lStockQuantite->setId($lStockQuantiteActuel->getId());
						$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
					}
					$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() + $lAchatNouvelle->getQuantite() );
					$lStockQuantite->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
					$lStockQuantite->setUnite($lAchatNouvelle->getUnite());
					$lStockService->setStockQuantite($lStockQuantite);
					
					// Maj du détail Opération
					$lDetailOperation = new DetailOperationVO();
					//$lDetailOperation->setId($lAchatActuelle->getId()->getIdDetailOperation());
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
				
				// Ajout ou Maj de la qté produit dans le stock
			/*	$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatActuelle->getIdNomProduit(),$lAchatActuelle->getUnite());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
				}
				$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() - $lAchatActuelle->getQuantite());
				$lStockQuantite->setIdNomProduit($lAchatActuelle->getIdNomProduit());
				$lStockQuantite->setUnite($lAchatActuelle->getUnite());
				$lStockService->setStockQuantite($lStockQuantite);*/
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
				
				// Ajout ou Maj de la qté produit dans le stock
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatNouvelle->getIdNomProduit(),$lAchatNouvelle->getUnite());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
				}
				$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() + $lAchatNouvelle->getQuantite());
				$lStockQuantite->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
				$lStockQuantite->setUnite($lAchatNouvelle->getUnite());
				$lStockService->setStockQuantite($lStockQuantite);
				
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
					
					// Ajout ou Maj de la qté produit dans le stock
					$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatNouvelle->getIdNomProduit(),$lAchatNouvelle->getUnite());
					$lStockQuantiteActuel = $lStockQuantiteActuel[0];		
			
					$lStockQuantite = new StockQuantiteVO();
					if(!is_null($lStockQuantiteActuel->getId())) {
						$lStockQuantite->setId($lStockQuantiteActuel->getId());
						$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
					}
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() + $lAchatNouvelle->getQuantite() - $lAchatActuelle->getQuantite());
					$lStockQuantite->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
					$lStockQuantite->setUnite($lAchatNouvelle->getUnite());
					$lStockService->setStockQuantite($lStockQuantite);
										
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
			
				
				// Maj de la qté produit dans le stock solidaire
			/*	$lStockSolidaireActuel = $lStockService->selectSolidaireByIdNomProduitUnite($lAchatActuelle->getIdNomProduit(),$lAchatActuelle->getUnite());
				$lStockSolidaireActuel = $lStockSolidaireActuel[0];*/

			//	$lDetail = DetailMarcheViewManager::selectByLot($lAchatActuelle->getId()->getIdDetailOperation());
				
				// Maj de la qté produit dans le stock solidaire				
			/*	$lStock = $lStockService->get($lDetail->getId()->getIdStock());
				$lDetailMarche = DetailMarcheViewManager::selectByLot($lStock->getIdDetailCommande());
				$lDetailMarche = $lDetailMarche[0];	*/
		
			/*	$lStockSolidaire = new StockSolidaireVO();
				if(!is_null($lStockSolidaireActuel->getId())) {
					$lStockSolidaire->setId($lStockSolidaireActuel->getId());
					$lStockSolidaire->setQuantite($lStockSolidaireActuel->getQuantite() - $lAchatActuelle->getQuantite());
					$lStockSolidaire->setIdNomProduit($lStockSolidaireActuel->getProIdNomProduit());
					$lStockSolidaire->setUnite($lStockSolidaireActuel->getProUniteMesure());
					$lStockService->setSolidaire($lStockSolidaire);
				}*/
				
				// Ajout ou Maj de la qté produit dans le stock
			/*	$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatActuelle->getIdNomProduit(),$lAchatActuelle->getUnite());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
				}
				$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() - $lAchatActuelle->getQuantite());
				$lStockQuantite->setIdNomProduit($lAchatActuelle->getIdNomProduit());
				$lStockQuantite->setUnite($lAchatActuelle->getUnite());
				$lStockService->setStockQuantite($lStockQuantite);*/
				
				$lStock = $lStockService->get($lAchatActuelle->getId()->getIdStock());
				$lDetailMarche = DetailMarcheViewManager::selectByLot($lStock->getIdDetailCommande());
				$lDetailMarche = $lDetailMarche[0];
								
				// Ajout ou Maj de la qté produit dans le stock
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lDetailMarche->getProIdNomProduit(),$lDetailMarche->getProUniteMesure());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
				$lStockQuantite->setId($lStockQuantiteActuel->getId());
				$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
				}
				$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() - $lAchatActuelle->getQuantite());
				$lStockQuantite->setIdNomProduit($lDetailMarche->getProIdNomProduit());
				$lStockQuantite->setUnite($lDetailMarche->getProUniteMesure());
				$lStockService->setStockQuantite($lStockQuantite);
				
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
				
				// Suppression de la qté produit dans le stock solidaire
			/*	$lStockSolidaireActuel = $lStockService->selectSolidaireByIdNomProduitUnite($lAchatNouvelle->getIdNomProduit(),$lAchatNouvelle->getUnite());
				$lStockSolidaireActuel = $lStockSolidaireActuel[0];		
		
				$lStockSolidaire = new StockSolidaireVO();
				if(!is_null($lStockSolidaireActuel->getId())) {
					$lStockSolidaire->setId($lStockSolidaireActuel->getId());
					$lStockSolidaire->setQuantite($lStockSolidaireActuel->getQuantite() + $lAchatNouvelle->getQuantite());
					$lStockSolidaire->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
					$lStockSolidaire->setUnite($lAchatNouvelle->getUnite());
					$lStockService->setSolidaire($lStockSolidaire);
				}*/
				
				// Ajout ou Maj de la qté produit dans le stock
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatNouvelle->getIdNomProduit(),$lAchatNouvelle->getUnite());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
				}
				$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() + $lAchatNouvelle->getQuantite());
				$lStockQuantite->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
				$lStockQuantite->setUnite($lAchatNouvelle->getUnite());
				$lStockService->setStockQuantite($lStockQuantite);
				
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
				
				// Suppression de la qté produit dans le stock solidaire
			/*	$lStockSolidaireActuel = $lStockService->selectSolidaireByIdNomProduitUnite($lProduit->getIdNomProduit(),$lProduit->getUnite());
				$lStockSolidaireActuel = $lStockSolidaireActuel[0];		
		
				$lStockSolidaire = new StockSolidaireVO();
				if(!is_null($lStockSolidaireActuel->getId())) {
					$lStockSolidaire->setId($lStockSolidaireActuel->getId());
					$lStockSolidaire->setQuantite($lStockSolidaireActuel->getQuantite() + $lProduit->getQuantite());
					$lStockSolidaire->setIdNomProduit($lProduit->getIdNomProduit());
					$lStockSolidaire->setUnite($lProduit->getUnite());
					$lStockService->setSolidaire($lStockSolidaire);
				}	*/		

				// Ajout ou Maj de la qté produit dans le stock
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduit->getIdNomProduit(),$lProduit->getUnite());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
				}
				$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() + $lProduit->getQuantite());
				$lStockQuantite->setIdNomProduit($lProduit->getIdNomProduit());
				$lStockQuantite->setUnite($lProduit->getUnite());
				$lStockService->setStockQuantite($lStockQuantite);
					
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
			$lOperationZeybu->setTypePaiementChampComplementaire($lIdOperationSolidaire);
			$lOperationZeybu->setIdCommande($pAchat->getId()->getIdCommande());
			$lIdOperationZeybu = $lOperationService->set($lOperationZeybu);
			
			
			$lOperationSolidaire->setTypePaiementChampComplementaire($lIdOperationZeybu);
			$lOperationService->set($lOperationSolidaire);
			
			return $lIdOperationSolidaire;
		}
		return null;
	}
		
	/**
	* @name delete($pId)
	* @param IdAchatVO
	* @desc Supprime un achat
	*/
	public function delete($pId) {
		$lAchatValid = new AchatValid();
		if(!is_null($pId) && $lAchatValid->select($pId)) {
			$lAchatActuel = $this->get($pId);
			
			// Suppression de l'opération
			$lOperationService = new OperationService();
			$lIdOperationZeybu = $lOperationService->get($pId->getIdAchat())->getTypePaiementChampComplementaire();
			$lOperationService->delete($pId->getIdAchat());
			$lOperationService->delete($lIdOperationZeybu);
			
			$lStockService = new StockService();
			$lDetailOperationService = new DetailOperationService();
			foreach($lAchatActuel->getDetailAchat() as $lDetail) {
				// Suppression du stock et du detail operation
				$lStockService->delete($lDetail->getId()->getIdStock());
				$lDetailOperationService->delete($lDetail->getId()->getIdDetailOperation());
				
				// Ajout ou Maj de la qté produit dans le stock
				$lStock = $lStockService->get($lDetail->getId()->getIdStock());
				$lDetailMarche = DetailMarcheViewManager::selectByLot($lStock->getIdDetailCommande());
				$lDetailMarche = $lDetailMarche[0];
				
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lDetailMarche->getProIdNomProduit(),$lDetailMarche->getProUniteMesure());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
				}
				$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() - $lDetail->getQuantite());
				$lStockQuantite->setIdNomProduit($lDetailMarche->getProIdNomProduit());
				$lStockQuantite->setUnite($lDetailMarche->getProUniteMesure());
				$lStockService->setStockQuantite($lStockQuantite);
			}
			foreach($lAchatActuel->getDetailAchatSolidaire() as $lDetail) {
				// Suppression du stock et du detail operation
				$lStockService->delete($lDetail->getId()->getIdStock());
				$lDetailOperationService->delete($lDetail->getId()->getIdDetailOperation());
				
				$lStock = $lStockService->get($lDetail->getId()->getIdStock());
				$lDetailMarche = DetailMarcheViewManager::selectByLot($lStock->getIdDetailCommande());
				$lDetailMarche = $lDetailMarche[0];

				// Maj de la qté produit dans le stock solidaire
				/*$lStockSolidaireActuel = $lStockService->selectSolidaireByIdNomProduitUnite($lDetailMarche->getProIdNomProduit(),$lDetailMarche->getProUniteMesure());
				$lStockSolidaireActuel = $lStockSolidaireActuel[0];		
		
				$lStockSolidaire = new StockSolidaireVO();
				if(!is_null($lStockSolidaireActuel->getId())) {
					$lStockSolidaire->setId($lStockSolidaireActuel->getId());
					$lStockSolidaire->setQuantite($lStockSolidaireActuel->getQuantite() - $lDetail->getQuantite());
					$lStockSolidaire->setIdNomProduit($lDetailMarche->getProIdNomProduit());
					$lStockSolidaire->setUnite($lDetailMarche->getProUniteMesure());
					$lStockService->setSolidaire($lStockSolidaire);
				}*/
				
				// Ajout ou Maj de la qté produit dans le stock
				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lDetailMarche->getProIdNomProduit(),$lDetailMarche->getProUniteMesure());
				$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
				$lStockQuantite = new StockQuantiteVO();
				if(!is_null($lStockQuantiteActuel->getId())) {
					$lStockQuantite->setId($lStockQuantiteActuel->getId());
					$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
				}
				$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() - $lDetail->getQuantite());
				$lStockQuantite->setIdNomProduit($lDetailMarche->getProIdNomProduit());
				$lStockQuantite->setUnite($lDetailMarche->getProUniteMesure());
				$lStockService->setStockQuantite($lStockQuantite);
			}
			return true;
		}
		return false;
	}
			
	/**
	* @name get($pId)
	* @param integer
	* @return AchatVO
	* @desc Retourne une liste d'achat
	*/
	public function get($pId = null) {
		$lAchatValid = new AchatValid();
		if(!is_null($pId) && $lAchatValid->select($pId)) {
			return $this->select($pId);
		}
		return false;
	}
	
	/**
	* @name getAll($pId)
	* @param integer
	* @return array(AchatVO)
	* @desc Retourne une liste d'achat
	*/
	public function getAll($pId = null) {
		$lAchatValid = new AchatValid();
		if(!is_null($pId) && $lAchatValid->selectAll($pId)) {
			return $this->selectAll($pId);
		}
		return false;
	}
	
	/**
	* @name selectOperationAchat($pId)
	* @param IdReservation
	* @return array(OperationVO)
	* @desc Retourne une liste d'operation
	*/
	public function selectOperationAchat($pId) {
		// ORDER BY date -> récupère la dernière operation en lien avec la commande
		return OperationManager::recherche(
			array(OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT,OperationManager::CHAMP_OPERATION_ID_COMPTE,OperationManager::CHAMP_OPERATION_ID_COMMANDE),
			array('in','=','='),
			array(array(7,8), $pId->getIdCompte(),$pId->getIdCommande()),
			array(OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT,OperationManager::CHAMP_OPERATION_DATE),
			array('ASC','DESC'));
	}

	/**
	* @name selectAll($pId)
	* @param IdReservation
	* @return array(AchatVO)
	* @desc Retourne les achats du compte pour un marché
	*/
	private function selectAll($pId) {		
		$lOperations = $this->selectOperationAchat($pId);
		$lAchats = array();
		if(!is_null($lOperations[0]->getId())) {
			foreach($lOperations as $lOperation) {
				$pId->setIdAchat($lOperation->getId());
				array_push($lAchats,$this->select($pId));
			}
		}
		return $lAchats;
	}
	
	/**
	* @name select($pId)
	* @param IdAchatVO
	* @return AchatVO
	* @desc Retourne une Reservation
	*/
	private function select($pId) {			
		$lOperation = OperationManager::select($pId->getIdAchat());

		$lAchat = new AchatVO();
		$lAchat->getId()->setIdCompte($pId->getIdCompte());
		$lAchat->getId()->setIdCommande($pId->getIdCommande());
		$lAchat->getId()->setIdAchat($pId->getIdAchat());
		$lAchat->setDateAchat($lOperation->getDate());
		
		// Recherche du détail de la reservation
		switch($lOperation->getTypePaiement()) {
			case 7: // Un achat				
				$lDetailsAchat = AchatDetailViewManager::select($lOperation->getId());
				foreach($lDetailsAchat as $lDetail) {					
					if(!is_null($lDetail->getStoId())) {
						$lDetailAchat = new DetailReservationVO();
						$lDetailAchat->getId()->setIdStock($lDetail->getStoId());
						$lDetailAchat->getId()->setIdDetailOperation($lDetail->getDopeId());
						$lDetailAchat->setIdDetailCommande($lDetail->getStoIdDetailCommande());
						$lDetailAchat->setMontant($lDetail->getDopeMontant());
						$lDetailAchat->setQuantite($lDetail->getStoQuantite());
						$lDetailAchat->setIdProduit($lDetail->getDcomIdProduit());
						
						$lAchat->addDetailAchat($lDetailAchat);
					}
				}		
				$lAchat->setTotal($lOperation->getMontant());
				break;
				
			case 8: // Achat Solidaire
				$lDetailsAchat = AchatDetailSolidaireViewManager::select($lOperation->getId());
				foreach($lDetailsAchat as $lDetail) {					
					if(!is_null($lDetail->getStoId())) {
						$lDetailAchat = new DetailReservationVO();
						$lDetailAchat->getId()->setIdStock($lDetail->getStoId());
						$lDetailAchat->getId()->setIdDetailOperation($lDetail->getDopeId());
						$lDetailAchat->setIdDetailCommande($lDetail->getStoIdDetailCommande());
						$lDetailAchat->setMontant($lDetail->getDopeMontant());
						$lDetailAchat->setQuantite($lDetail->getStoQuantite());
						$lDetailAchat->setIdProduit($lDetail->getDcomIdProduit());
						
						$lAchat->addDetailAchatSolidaire($lDetailAchat);
					}
				}		
				$lAchat->setTotalSolidaire($lOperation->getMontant());
				break;
		}
		return $lAchat;
	}
	
	
	/**
	* @name selectMarcheAll($pIdMarche)
	* @param IdMarche
	* @return 
	* @desc Retourne une Reservation
	*/
	/*public function selectMarcheAll($pIdMarche) {	
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT 
			   ADHERENT."    . AdherentManager::CHAMP_ADHERENT_ID . 
			", ADHERENT." . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			", ADHERENT." . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . 
			", ADHERENT." . CompteManager::CHAMP_COMPTE_LABEL . 
			", ADHERENT." . AdherentManager::CHAMP_ADHERENT_NOM . 
			", ADHERENT." . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			", OPERATION." . OperationManager::CHAMP_OPERATION_MONTANT . "_reservation" .
			", OPERATION." . OperationManager::CHAMP_OPERATION_MONTANT . "_achat
			FROM " . AdherentViewManager::VUE_ADHERENT . " AS ADHERENT
			LEFT JOIN ( 
				SELECT "
					 	. AdherentManager::CHAMP_ADHERENT_ID . 
					", RESERVATION." . OperationManager::CHAMP_OPERATION_MONTANT . " AS " . OperationManager::CHAMP_OPERATION_MONTANT . "_reservation" . 
					", ACHAT." . OperationManager::CHAMP_OPERATION_MONTANT . " AS " . OperationManager::CHAMP_OPERATION_MONTANT . "_achat
				FROM " . AdherentViewManager::VUE_ADHERENT . "
				LEFT JOIN (
					SELECT " 
				 		. OperationManager::CHAMP_OPERATION_ID_COMMANDE .
					"," . OperationManager::CHAMP_OPERATION_MONTANT .
					"," . OperationManager::CHAMP_OPERATION_ID_COMPTE . "
					FROM " . OperationManager::TABLE_OPERATION . "
					WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . "  = 0) AS RESERVATION 
					ON RESERVATION." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . AdherentViewManager::VUE_ADHERENT . "." . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . "
				
				LEFT JOIN (
					SELECT " 
				 		. OperationManager::CHAMP_OPERATION_ID_COMMANDE .
					", sum(" . OperationManager::CHAMP_OPERATION_MONTANT . ") AS " . OperationManager::CHAMP_OPERATION_MONTANT .
					"," . OperationManager::CHAMP_OPERATION_ID_COMPTE . "
					FROM " . OperationManager::TABLE_OPERATION . "
					WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " in (7,8)
					GROUP BY " .  OperationManager::CHAMP_OPERATION_ID_COMMANDE . "," . OperationManager::CHAMP_OPERATION_ID_COMPTE . ") AS ACHAT 
					ON ACHAT." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . AdherentViewManager::VUE_ADHERENT . "." . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . "
				WHERE RESERVATION." . OperationManager::CHAMP_OPERATION_ID_COMMANDE . " = " . StringUtils::securiser($pIdMarche) . "
				OR ACHAT." . OperationManager::CHAMP_OPERATION_ID_COMMANDE . " = " . StringUtils::securiser($pIdMarche) . "
				GROUP BY " . AdherentViewManager::VUE_ADHERENT . "." . AdherentManager::CHAMP_ADHERENT_ID . ") AS OPERATION
			ON ADHERENT." . AdherentManager::CHAMP_ADHERENT_ID . " = OPERATION." . AdherentManager::CHAMP_ADHERENT_ID;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAchatEtReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAchatEtReservation,
					$this->remplirAchatEtReservation(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT . "_reservation"],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT . "_achat"]));
			}
		} else {
			$lListeAchatEtReservation[0] = new ListeAchatReservationVO();
		}
		return $lListeAchatEtReservation;
	}	
	*/
	/**
	* @name remplirAchatEtReservation($pAdhId, $pAdhNumero, $pAdhIdCompte, $pCptLabel, $pAdhNom, $pAdhPrenom, $pOpeMontantReservation, $pOpeMontantAchat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(30)
	* @param varchar(50)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @return ListeAchatReservationVO
	* @desc Retourne une ListeAchatReservationVO remplie
	*/
	/*private function remplirAchatEtReservation($pAdhId, $pAdhNumero, $pAdhIdCompte, $pCptLabel, $pAdhNom, $pAdhPrenom, $pOpeMontantReservation, $pOpeMontantAchat) {
		$lListeAchatReservation = new ListeAchatReservationVO();
		$lListeAchatReservation->setAdhId($pAdhId);
		$lListeAchatReservation->setAdhNumero($pAdhNumero);
		$lListeAchatReservation->setAdhIdCompte($pAdhIdCompte);
		$lListeAchatReservation->setCptLabel($pCptLabel);
		$lListeAchatReservation->setAdhNom($pAdhNom);
		$lListeAchatReservation->setAdhPrenom($pAdhPrenom);
		$lListeAchatReservation->setOpeMontantReservation($pOpeMontantReservation);
		$lListeAchatReservation->setOpeMontantAchat($pOpeMontantAchat);
		return $lListeAchatReservation;
	}*/
	
	public function ajoutProduitAchat($pProduitAchat) {
		$lIdAchat = new IdAchatVO();
		$lIdAchat->setIdCompte($pProduitAchat->getIdCompte());	

		$lIdLotProduitMarche = 0;
		
		// Récupère les modèles de lot pour le produit (permet de récupérer l'unité )
		$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($pProduitAchat->getIdNomProduit());
		
		
		// Si il y a un marché vérifier si le produit est dans le marché et l'ajouter au besoin
		if($pProduitAchat->getIdMarche() != '') {
			$lIdAchat->setIdCommande($pProduitAchat->getIdMarche());

			// Test si produit déjà dans le marché
			$lProduits = ProduitManager::selectbyIdNomProduitIdMarche($pProduitAchat->getIdNomProduit(), $pProduitAchat->getIdMarche());
			$lIdProduit = $lProduits[0]->getId();
			// Si il n'est pas dans le marche l'ajouter
			if(empty($lId)) {							
				$lProduit = new ProduitCommandeVO();
				$lProduit->setId($pProduitAchat->getIdMarche());
				$lProduit->setIdNom($pProduitAchat->getIdNomProduit());
				
				// On ajout un produit classique uniquement
				$lProduit->setQteMaxCommande(-1);
				$lProduit->setQteRestante(-1);
				$lProduit->setType(0);
				
				// Récupère les modèles de lot
				$lIdLotPremier = $lModelesLot[0]->getMLotId();
				if(!empty($lIdLotPremier)) {
					$lProduit->setUnite($lModelesLot[0]->getMLotUnite());
					foreach($lModelesLot as $lLot) {
						$lDetailCommande = new DetailCommandeVO();
						$lDetailCommande->setId($lLot->getMLotId());
						$lDetailCommande->setTaille($lLot->getMLotQuantite());
						$lDetailCommande->setPrix($lLot->getMLotPrix());
						$lProduit->addLots($lDetailCommande);
					}
					
					// Ajout du produit dans le marché
					$lMarcheService = new MarcheService();
					$lIdProduit = $lMarcheService->ajoutProduit($lProduit);
				}
			}
			
			// Id du produit existe (soit présent soit bien ajouté)
			if(!empty($lIdProduit)) {
				$lDetailCommande = DetailCommandeManager::selectByIdProduit($lIdProduit);
				$lIdLotProduitMarche = $lDetailCommande[0]->getId();			
			} else { // Sinon on arrête avec une erreur
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_210_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_210_MSG);
				$lVr->getLog()->addErreur($lErreur);
				return $lVr;
			}
		} 
				
		// On vérifie pour un compte != d'invité si il n'y a pas un achat ou une réservation à mettre à jour
		if($pProduitAchat->getIdMarche() != '' && $pProduitAchat->getIdOperation() == '' && $pProduitAchat->getIdCompte() != -3) {
			$lOperations = $this->selectOperationAchat($lIdAchat);
			// Si il y a un achat il ne faut pas en ajouter et faire maj
			if(!is_null($lOperations[0]->getId())) {
				foreach($lOperations as $lOperation) {
					// Recherche de la bonne opération normal ou solidaire
					if($lOperation->getTypePaiement() - $pProduitAchat->getSolidaire() == 7) {
						$pProduitAchat->setIdOperation($lOperation->getId());
					}
				}
			}
			
			// Recherche si il y a une réservation
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pProduitAchat->getIdCompte());
			$lIdReservation->setIdCommande($pProduitAchat->getIdMarche());
			
			$lReservationService = new ReservationService();
			$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
			
			if($lOperations[0]->getTypePaiement() == 0) {
				$lIdAchat->setIdReservation($lOperations[0]->getId());				
			}
		} 
		
		$lAchat = new AchatVO();
		$lAchat->setId($lIdAchat);
		
		// Récupération de l'achat pour mise à jour
		if($pProduitAchat->getIdOperation() != '') { 
			$lIdAchat->setIdAchat($pProduitAchat->getIdOperation());
			$lAchat->setId($lIdAchat);			
			$lAchat = $this->select($lIdAchat);
		} 
		
		// Ajout du nouvel achat sur le produit
		$lDetailAchat = new DetailReservationVO();
		$lDetailAchat->setQuantite($pProduitAchat->getQuantite());
		$lDetailAchat->setMontant($pProduitAchat->getPrix());
		$lDetailAchat->setIdDetailCommande($lIdLotProduitMarche);
		
		$lDetailAchat->setIdNomProduit($pProduitAchat->getIdNomProduit());
		$lDetailAchat->setUnite($lModelesLot[0]->getMLotUnite());
		
		if($pProduitAchat->getSolidaire() == 0) {
			$lAchat->addDetailAchat($lDetailAchat);
		} else if($pProduitAchat->getSolidaire() == 1) {
			$lAchat->addDetailAchatSolidaire($lDetailAchat);
		}
		
		// Ajout ou mise à jour de l'achat
		return $this->set($lAchat);		
	}	
}
?>