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
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
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



include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_SERVICE . "/AchatValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ModeleLotManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailAchatManager.php");


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
		$lAchatValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AchatValid();
		if($lAchatValid->input($pAchat)) {
			
			if($lAchatValid->insert($pAchat)) {
				$lIdRequete = 0;
				
				$lOperationAchat = $pAchat->getOperationAchat()->getMontant();
				$lOperationAchatSolidaire = $pAchat->getOperationAchatSolidaire()->getMontant();
				$lOperationRechargement = $pAchat->getRechargement()->getMontant();
				
				if(!is_null($lOperationAchat) && !empty($lOperationAchat)) {
					$lIdRequete = $pAchat->getOperationAchat()->getChampComplementaire()[15]->getValeur();
				}
				if(!is_null($lOperationAchatSolidaire) && !empty($lOperationAchatSolidaire)) {
					$lIdRequete = $pAchat->getOperationAchatSolidaire()->getChampComplementaire()[15]->getValeur();
				}
				if(!is_null($lOperationRechargement) && !empty($lOperationRechargement)) {
					$lIdRequete = $pAchat->getRechargement()->getChampComplementaire()[15]->getValeur();
				}

				$lOperationService = new OperationService();
				$lOperations = $lOperationService->getByIdrequete($lIdRequete);
				$lIdOperation = $lOperations[0]->getId();
				if(is_null($lIdOperation) && empty($lIdOperation)) {
					return $this->insert($pAchat);
				} else { // C'est un doublon il faut passer en maj
					
					$lAchatActuel = $this->select($lIdOperation); // Récupération des Id
					if(!is_null($lAchatActuel->getOperationAchat())) {
						$pAchat->getOperationAchat()->setId($lAchatActuel->getOperationAchat()->getId());
					}
					if(!is_null($lAchatActuel->getOperationAchatSolidaire())) {
						$pAchat->getOperationAchatSolidaire()->setId($lAchatActuel->getOperationAchatSolidaire()->getId());
					}
					if(!is_null($lAchatActuel->getRechargement())) {
						$pAchat->getRechargement()->setId($lAchatActuel->getRechargement()->getId());
					}
					return $this->update($pAchat);
				}
			} else if($lAchatValid->update($pAchat)) {
				return $this->update($pAchat);
			}
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
		$lOperationService = new OperationService();

		// Rechargement
		$lIdRechargement = 0;
		$lCompteRechargement = $pAchat->getRechargement()->getIdCompte();
		if(!empty($lCompteRechargement) && !is_null($lCompteRechargement)) {
			$pAchat->getRechargement()->setLibelle('Rechargement');
			$lIdRechargement = $lOperationService->set($pAchat->getRechargement());
		}

		$lIdOperationAchat = 0;
		$lIdOperationAchatSolidaire = 0;
		$lIdCompte = 0;
		$lIdMarche = 0;
		$lLibelleOperation = '';
		$lLibelleOperationSolidaire = '';
		
		// Achat
		$lTestCompteAchat = $pAchat->getOperationAchat()->getIdCompte();
		if(!empty($lTestCompteAchat) && !is_null($lTestCompteAchat)) {
			$lIdCompte = $pAchat->getOperationAchat()->getIdCompte();
			$ltestChampComplementaire = $pAchat->getOperationAchat()->getChampComplementaire();
			if(isset($ltestChampComplementaire[1])) {
				$lIdMarche = $pAchat->getOperationAchat()->getChampComplementaire()[1]->getValeur();
				
				$lMarcheService = new MarcheService();
				$lMarche = $lMarcheService->getInfoMarche($lIdMarche);
				
				$lLibelleOperation = "Marché N°" . $lMarche->getNumero();
			} else {
				$lLibelleOperation = "Achat du " . StringUtils::dateAujourdhuiFr();
			}			
			$pAchat->getOperationAchat()->setLibelle($lLibelleOperation);
			$lIdOperationAchat = $lOperationService->set($pAchat->getOperationAchat()); // Operation d'achat
			
			$lOperationZeybu = new OperationDetailVO();
			$lOperationZeybu->setIdCompte(-1);
			$lOperationZeybu->setMontant($pAchat->getOperationAchat()->getMontant() * -1);
			$lOperationZeybu->setLibelle($lLibelleOperation);
			$lOperationZeybu->setTypePaiement($pAchat->getOperationAchat()->getTypePaiement());
			$lOperationZeybuChampComplementaire = $pAchat->getOperationAchat()->getChampComplementaire();
			$lOperationZeybuChampComplementaire[8] = new OperationChampComplementaireVO(null, 8, $lIdOperationAchat);
			$lOperationZeybu->setChampComplementaire($lOperationZeybuChampComplementaire);
			$lIdOperationZeybu = $lOperationService->set($lOperationZeybu); // Operation Zeybu
			
		}	

		// Achat Solidaire
		$lTestCompteAchatSolidaire = $pAchat->getOperationAchatSolidaire()->getIdCompte();
		if(!empty($lTestCompteAchatSolidaire) && !is_null($lTestCompteAchatSolidaire)) {
			$lIdCompte = $pAchat->getOperationAchatSolidaire()->getIdCompte();
			
			$ltestChampComplementaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
			if(isset($ltestChampComplementaire[1])) {
				if($lIdMarche == 0) { // Pour éviter de lancer 2 fois la requête
					$lIdMarche = $pAchat->getOperationAchatSolidaire()->getChampComplementaire()[1]->getValeur();
					$lMarcheService = new MarcheService();
					$lMarche = $lMarcheService->getInfoMarche($lIdMarche);
				}
				$lLibelleOperationSolidaire = "Marché Solidaire N°" . $lMarche->getNumero();
			} else {
				$lLibelleOperationSolidaire = "Achat Solidaire du " . StringUtils::dateAujourdhuiFr();
			}
			
			$pAchat->getOperationAchatSolidaire()->setLibelle($lLibelleOperationSolidaire);
			$lIdOperationAchatSolidaire = $lOperationService->set($pAchat->getOperationAchatSolidaire()); // Operation d'achat Solidaire
			
			$lOperationZeybuSolidaire =new OperationDetailVO();
			$lOperationZeybuSolidaire->setIdCompte(-1);
			$lOperationZeybuSolidaire->setMontant($pAchat->getOperationAchatSolidaire()->getMontant() * -1);
			$lOperationZeybuSolidaire->setLibelle($lLibelleOperationSolidaire);
			$lOperationZeybuSolidaire->setTypePaiement($pAchat->getOperationAchatSolidaire()->getTypePaiement());
			$lOperationZeybuSolidaireChampComplementaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
			$lOperationZeybuSolidaireChampComplementaire[8] = new OperationChampComplementaireVO(null, 8, $lIdOperationAchatSolidaire);
			$lOperationZeybuSolidaire->setChampComplementaire($lOperationZeybuSolidaireChampComplementaire);
			$lIdOperationZeybuSolidaire = $lOperationService->set($lOperationZeybuSolidaire); // Operation Zeybu solidaire 
		}
		
		// Liaison Rechargement
		if(!empty($lCompteRechargement) && !is_null($lCompteRechargement)) {
			$lMaj = false;
			$lRechargementChampComplementaire = $pAchat->getRechargement()->getChampComplementaire();
			if(!empty($lTestCompteAchat) && !is_null($lTestCompteAchat)) {
				$lMaj = true;
				$lRechargementChampComplementaire[12] = new OperationChampComplementaireVO(null, 12, $lIdOperationAchat);
			}
			if(!empty($lTestCompteAchatSolidaire) && !is_null($lTestCompteAchatSolidaire)) {
				$lMaj = true;
				$lRechargementChampComplementaire[13] = new OperationChampComplementaireVO(null, 13, $lIdOperationAchatSolidaire);
			}
			if($lMaj) {
				$pAchat->getRechargement()->setChampComplementaire($lRechargementChampComplementaire);
				$lOperationService->set($pAchat->getRechargement());
			}
		}
				
		// Liaison achat
		if(!empty($lTestCompteAchat) && !is_null($lTestCompteAchat)) {
			$lChampComplementaire = $pAchat->getOperationAchat()->getChampComplementaire();
			$lChampComplementaire[8] = new OperationChampComplementaireVO(null, 8, $lIdOperationZeybu);
			if(!empty($lCompteRechargement) && !is_null($lCompteRechargement)) {
				$lChampComplementaire[14] = new OperationChampComplementaireVO(null, 14, $lIdRechargement);
			}
			if(!empty($lTestCompteAchatSolidaire) && !is_null($lTestCompteAchatSolidaire)) {
				$lChampComplementaire[13] = new OperationChampComplementaireVO(null, 13, $lIdOperationAchatSolidaire);
			}			
			$pAchat->getOperationAchat()->setChampComplementaire($lChampComplementaire);
			$lOperationService->set($pAchat->getOperationAchat()); // Operation d'achat avec lien operation zeybu
		}

		// Liaison Achat Solidaire
		if(!empty($lTestCompteAchatSolidaire) && !is_null($lTestCompteAchatSolidaire)) {
			$lChampComplementaireSolidaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
			$lChampComplementaireSolidaire[8] = new OperationChampComplementaireVO(null, 8, $lIdOperationZeybuSolidaire);
			if(!empty($lCompteRechargement) && !is_null($lCompteRechargement)) {
				$lChampComplementaireSolidaire[14] = new OperationChampComplementaireVO(null, 14, $lIdRechargement);
			}
			if(!empty($lTestCompteAchat) && !is_null($lTestCompteAchat)) {
				$lChampComplementaireSolidaire[12] = new OperationChampComplementaireVO(null, 12, $lIdOperationAchat);
			}
			$pAchat->getOperationAchatSolidaire()->setChampComplementaire($lChampComplementaireSolidaire);
			$lOperationService->set($pAchat->getOperationAchatSolidaire()); // Operation d'achat solidaire avec lien operation zeybu
		}
		
		// Ajout des produits
		$lIdModeleLot = array();
		$lIdDetailCommande = array();
		foreach($pAchat->getProduits() as $lProduit) {
			$lTestModeleLot = $lProduit->getIdModeleLot();
			$lTestDetailCommande = $lProduit->getIdDetailCommande();
			if(!empty($lTestModeleLot) && !is_null($lTestModeleLot)) {
				array_push($lIdModeleLot, $lTestModeleLot);
			} else if(!empty($lTestDetailCommande) && !is_null($lTestDetailCommande)) {
				array_push($lIdDetailCommande, $lTestDetailCommande);
			}
			$lTestModeleLotSolidaire = $lProduit->getIdModeleLotSolidaire();
			$lTestDetailCommandeSolidaire = $lProduit->getIdDetailCommandeSolidaire();
			if(!empty($lTestModeleLotSolidaire) && !is_null($lTestModeleLotSolidaire)) {
				array_push($lIdModeleLot, $lTestModeleLotSolidaire);
			} else if(!empty($lTestDetailCommandeSolidaire) && !is_null($lTestDetailCommandeSolidaire)) {
				array_push($lIdDetailCommande, $lTestDetailCommandeSolidaire);
			}
		}
		if(!empty($lIdModeleLot)) {
			$lListeModeleLot = ModeleLotManager::selectByArray($lIdModeleLot);
		}
		if(!empty($lIdDetailCommande)) {
			$lListeDetailCommande = DetailCommandeManager::selectByArrayClassByDcomId($lIdDetailCommande);
		}
		
		$lDetailOperationService = new DetailOperationService();
		$lStockService = new StockService();
		foreach($pAchat->getProduits() as $lProduit) {
			// Stock
			$lIdStock = 0;
			$lIdDetailOperation = 0;
			if($lProduit->getQuantite() < 0) {
				$lUnite = '';
				$lTestModeleLot = $lProduit->getIdModeleLot();
				$lTestDetailCommande = $lProduit->getIdDetailCommande();
				if(!empty($lTestModeleLot) && !is_null($lTestModeleLot)) {
					$lUnite = $lListeModeleLot[$lTestModeleLot]->getUnite();
				} else if(!empty($lTestDetailCommande) && !is_null($lTestDetailCommande)) {
					$lUnite = $lListeDetailCommande[$lTestDetailCommande]->getUnite();
				}
				$lIdStock = $lStockService->set( new StockVO(
						null,
						null,
						$lProduit->getQuantite(),
						1,
						$lIdCompte,
						$lProduit->getIdDetailCommande(), /* detail commande */
						$lProduit->getIdModeleLot(), /* modele Lot */
						$lIdOperationAchat,
						$lProduit->getIdNomProduit(),
						$lUnite) );
				
				// Prix
				$lIdDetailOperation = $lDetailOperationService->set(new DetailOperationVO(
						null,
						$lIdOperationAchat,
						$lIdCompte,
						$lProduit->getMontant(),
						$lLibelleOperation,
						null,
						7,
						$lProduit->getIdDetailCommande(), /* detail commande */
						$lProduit->getIdModeleLot(), /* modele Lot */
						$lProduit->getIdNomProduit(),
						null) );
			}

			// Stock Solidaire
			$lIdStockSolidaire = 0;
			$lIdDetailOperationSolidaire = 0;
			if($lProduit->getQuantiteSolidaire() < 0) {
				$lUniteSolidaire = '';
				$lTestModeleLotSolidaire = $lProduit->getIdModeleLotSolidaire();
				$lTestDetailCommandeSolidaire = $lProduit->getIdDetailCommandeSolidaire();
				if(!empty($lTestModeleLotSolidaire) && !is_null($lTestModeleLotSolidaire)) {
					$lUniteSolidaire = $lListeModeleLot[$lTestModeleLotSolidaire]->getUnite();
				} else if(!empty($lTestDetailCommandeSolidaire) && !is_null($lTestDetailCommandeSolidaire)) {
					$lUniteSolidaire = $lListeDetailCommande[$lTestDetailCommandeSolidaire]->getUnite();
				}
				$lIdStockSolidaire = $lStockService->set( new StockVO(
						null,
						null,
						$lProduit->getQuantiteSolidaire(),
						2,
						$lIdCompte,
						$lProduit->getIdDetailCommandeSolidaire(),
						$lProduit->getIdModeleLotSolidaire(),
						$lIdOperationAchatSolidaire,
						$lProduit->getIdNomProduit(),
						$lUniteSolidaire));
				
				// Prix
				$lIdDetailOperationSolidaire = $lDetailOperationService->set(new DetailOperationVO(
						null,
						$lIdOperationAchatSolidaire,
						$lIdCompte,
						$lProduit->getMontantSolidaire(),
						$lLibelleOperationSolidaire,
						null,
						8,
						$lProduit->getIdDetailCommandeSolidaire(), /* detail commande */
						$lProduit->getIdModeleLotSolidaire(), /* modele Lot */
						$lProduit->getIdNomProduit(),
						null) );
			}
			
			if($lProduit->getQuantiteSolidaire() < 0 || $lProduit->getQuantite() < 0) { // Pas d'ajout de ligne vide
				DetailAchatManager::insert(new DetailAchatVO($lIdOperationAchat, $lIdOperationAchatSolidaire, $lProduit->getIdNomProduit(), $lIdStock, $lIdDetailOperation, $lIdStockSolidaire, $lIdDetailOperationSolidaire));
			}
		}
		
		// Maj de la réservation
		if($lIdMarche != 0) {
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lIdCompte);
			$lIdReservation->setIdCommande($lIdMarche);
			$lReservationService = new ReservationService();
			$lReservationService->updateEnAchat($lIdReservation);			
		}
		
		// Retourne l'Id de l'achat ou à defaut celui de l'achat solidaire
		$lIdRetour = $lIdOperationAchat;
		if($lIdRetour == 0 && $lIdOperationAchatSolidaire != 0) {
			$lIdRetour = $lIdOperationAchatSolidaire;
		} else {
			$lIdRetour = $lIdRechargement;
		}
		
		return $lIdRetour;
		
		/*
		
		
		
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
				$lStock->setIdModeleLot($lProduit->getIdLot());
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
				$lDetailOperation->setIdModeleLot($lProduit->getIdLot());
				$lDetailOperation->setIdNomProduit($lProduit->getIdNomProduit());
				$lDetailOperationService->set($lDetailOperation);
			}
		}	
		// Ajout des produits solidaire
		$lIdOperation = $this->insertProduitAchatSolidaire($pAchat);
		
		return $lIdOperation;*/
	}
	
	/**
	 * @name update($pAchat)
	 * @param AchatVO
	 * @return integer
	 * @desc Met à jour un achat
	 */
	private function update($pAchat) {
		$lOperationService = new OperationService();
		
		// Rechargement
		$lIdRechargement = $pAchat->getRechargement()->getId();
		$lCompteRechargement = $pAchat->getRechargement()->getIdCompte();
		$lMajRechargement = false;
		if(!empty($lIdRechargement) && !is_null($lIdRechargement)) {
			$lMontantRechargement = $pAchat->getRechargement()->getMontant();
			if(!empty($lMontantRechargement) && !is_null($lMontantRechargement)) { // Maj du rechargement
				$lMajRechargement = true;
				$lIdRechargement = $lOperationService->set($pAchat->getRechargement());
			} else if($lMontantRechargement == 0) { // Suppression du rechargement
				$lOperationService->delete($lIdRechargement);
				$lIdRechargement = NULL;
			}
		} else if(!empty($lCompteRechargement) && !is_null($lCompteRechargement)) { // Ajout du rechargement
			$pAchat->getRechargement()->setLibelle('Rechargement');
			$lIdRechargement = $lOperationService->set($pAchat->getRechargement());
		}
		
		//$lIdOperationAchat = 0;
		//$lIdOperationAchatSolidaire = 0;
		$lIdCompte = 0;
		$lIdMarche = 0;
		$lLibelleOperation = '';
		$lLibelleOperationSolidaire = '';
		$lAchatActuel = NULL;
		$lIdOperationAchatActuel = 0;
		$lIdOperationAchatSolidaireActuel = 0;
		
		// Achat
		$lIdOperationAchat = $pAchat->getOperationAchat()->getId();
		$lTestCompteAchat = $pAchat->getOperationAchat()->getIdCompte();
		$lMajAchat = false;
		if(!empty($lIdOperationAchat) && !is_null($lIdOperationAchat)) {
			$lAchatActuel = $this->select($lIdOperationAchat);
			$lIdOperationAchatActuel = $lIdOperationAchat;
			
			$lMontantAchat = $pAchat->getOperationAchat()->getMontant();
			$lIdOperationZeybu = $pAchat->getOperationAchat()->getChampComplementaire()[8]->getValeur();
			$lLibelleOperation = $pAchat->getOperationAchat()->getLibelle();
			$lIdCompte = $pAchat->getOperationAchat()->getIdCompte();
			$ltestChampComplementaire = $pAchat->getOperationAchat()->getChampComplementaire();
			if(isset($ltestChampComplementaire[1])) {
				$lIdMarche = $pAchat->getOperationAchat()->getChampComplementaire()[1]->getValeur();
			}
			if(!empty($lMontantAchat) && !is_null($lMontantAchat)) { // Maj de l'achat
				$lMajAchat = true;
				$lIdOperationAchat = $lOperationService->set($pAchat->getOperationAchat());
				
				$lOperationZeybu = $lOperationService->getDetail($lIdOperationZeybu);
				$lOperationZeybu->setMontant($pAchat->getOperationAchat()->getMontant() * -1);
				$lOperationService->set($lOperationZeybu);
				
			} else if($lMontantAchat == 0) { // Suppression de l'achat
				$lOperationService->delete($lIdOperationAchat);
				$lOperationService->delete($lIdOperationZeybu);
				$lIdOperationAchat = NULL;
			}
		} else if(!empty($lTestCompteAchat) && !is_null($lTestCompteAchat)) { // Ajout Achat
			$lIdCompte = $pAchat->getOperationAchat()->getIdCompte();
			$ltestChampComplementaire = $pAchat->getOperationAchat()->getChampComplementaire();
			if(isset($ltestChampComplementaire[1])) {
				$lIdMarche = $pAchat->getOperationAchat()->getChampComplementaire()[1]->getValeur();
		
				$lMarcheService = new MarcheService();
				$lMarche = $lMarcheService->getInfoMarche($lIdMarche);
		
				$lLibelleOperation = "Marché N°" . $lMarche->getNumero();
			} else {
				$lLibelleOperation = "Achat du " . StringUtils::dateAujourdhuiFr();
			}
			$pAchat->getOperationAchat()->setLibelle($lLibelleOperation);
			$lIdOperationAchat = $lOperationService->set($pAchat->getOperationAchat()); // Operation d'achat
				
			$lOperationZeybu = new OperationDetailVO();
			$lOperationZeybu->setIdCompte(-1);
			$lOperationZeybu->setMontant($pAchat->getOperationAchat()->getMontant() * -1);
			$lOperationZeybu->setLibelle($lLibelleOperation);
			$lOperationZeybu->setTypePaiement($pAchat->getOperationAchat()->getTypePaiement());
			$lOperationZeybuChampComplementaire = $pAchat->getOperationAchat()->getChampComplementaire();
			$lOperationZeybuChampComplementaire[8] = new OperationChampComplementaireVO(null, 8, $lIdOperationAchat);
			$lOperationZeybu->setChampComplementaire($lOperationZeybuChampComplementaire);
			$lIdOperationZeybu = $lOperationService->set($lOperationZeybu); // Operation Zeybu
				
		}
		
		// Achat Solidaire
		$lIdOperationAchatSolidaire = $pAchat->getOperationAchatSolidaire()->getId();
		$lTestCompteAchatSolidaire = $pAchat->getOperationAchatSolidaire()->getIdCompte();
		$lMajAchatSolidaire = false;
		if(!empty($lIdOperationAchatSolidaire) && !is_null($lIdOperationAchatSolidaire)) {
			if(is_null($lAchatActuel)) {
				$lAchatActuel = $this->select($lIdOperationAchatSolidaire);
			}
			$lIdOperationAchatSolidaireActuel = $lIdOperationAchatSolidaire;
			
			$lMontantAchatSolidaire = $pAchat->getOperationAchatSolidaire()->getMontant();
			$lIdOperationZeybuSolidaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire()[8]->getValeur();
			$lLibelleOperationSolidaire = $pAchat->getOperationAchatSolidaire()->getLibelle();
			$lIdCompte = $pAchat->getOperationAchatSolidaire()->getIdCompte();
			$ltestChampComplementaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
			if(isset($ltestChampComplementaire[1])) {
				$lIdMarche = $pAchat->getOperationAchatSolidaire()->getChampComplementaire()[1]->getValeur();
			}
			if(!empty($lMontantAchatSolidaire) && !is_null($lMontantAchatSolidaire)) { // Maj de l'achat
				$lMajAchatSolidaire = true;
				$lIdOperationAchatSolidaire = $lOperationService->set($pAchat->getOperationAchatSolidaire());
				
				$lOperationZeybuSolidaire = $lOperationService->getDetail($lIdOperationZeybuSolidaire);
				$lOperationZeybuSolidaire->setMontant($pAchat->getOperationAchatSolidaire()->getMontant() * -1);
				$lOperationService->set($lOperationZeybuSolidaire);
				
			} else if($lMontantAchatSolidaire == 0) { // Suppression de l'achat
				$lOperationService->delete($lIdOperationAchatSolidaire);
				$lOperationService->delete($lIdOperationZeybuSolidaire);
				$lIdOperationAchatSolidaire = NULL;
			}
		} else if(!empty($lTestCompteAchatSolidaire) && !is_null($lTestCompteAchatSolidaire)) {
			$lIdCompte = $pAchat->getOperationAchatSolidaire()->getIdCompte();
				
			$ltestChampComplementaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
			if(isset($ltestChampComplementaire[1])) {
				if($lIdMarche == 0) { // Pour éviter de lancer 2 fois la requête
					$lIdMarche = $pAchat->getOperationAchatSolidaire()->getChampComplementaire()[1]->getValeur();
					$lMarcheService = new MarcheService();
					$lMarche = $lMarcheService->getInfoMarche($lIdMarche);
				}
				$lLibelleOperationSolidaire = "Marché Solidaire N°" . $lMarche->getNumero();
			} else {
				$lLibelleOperationSolidaire = "Achat Solidaire du " . StringUtils::dateAujourdhuiFr();
			}
				
			$pAchat->getOperationAchatSolidaire()->setLibelle($lLibelleOperationSolidaire);
			$lIdOperationAchatSolidaire = $lOperationService->set($pAchat->getOperationAchatSolidaire()); // Operation d'achat Solidaire
				
			$lOperationZeybuSolidaire =new OperationDetailVO();
			$lOperationZeybuSolidaire->setIdCompte(-1);
			$lOperationZeybuSolidaire->setMontant($pAchat->getOperationAchatSolidaire()->getMontant() * -1);
			$lOperationZeybuSolidaire->setLibelle($lLibelleOperationSolidaire);
			$lOperationZeybuSolidaire->setTypePaiement($pAchat->getOperationAchatSolidaire()->getTypePaiement());
			$lOperationZeybuSolidaireChampComplementaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
			$lOperationZeybuSolidaireChampComplementaire[8] = new OperationChampComplementaireVO(null, 8, $lIdOperationAchatSolidaire);
			$lOperationZeybuSolidaire->setChampComplementaire($lOperationZeybuSolidaireChampComplementaire);
			$lIdOperationZeybuSolidaire = $lOperationService->set($lOperationZeybuSolidaire); // Operation Zeybu solidaire
		}
		
		// Liaison Rechargement
		if(!is_null($lIdRechargement)) {
			$lMaj = false;
			$lRechargementChampComplementaire = $pAchat->getRechargement()->getChampComplementaire();
			if(!$lMajAchat && !is_null($lIdOperationAchat)) {
				$lMaj = true;
				$lRechargementChampComplementaire[12] = new OperationChampComplementaireVO(null, 12, $lIdOperationAchat);
			} else if(is_null($lIdOperationAchat)) {
				unset($lRechargementChampComplementaire[12]);
			}
			if(!$lMajAchatSolidaire && !is_null($lIdOperationAchatSolidaire)) {
				$lMaj = true;
				$lRechargementChampComplementaire[13] = new OperationChampComplementaireVO(null, 13, $lIdOperationAchatSolidaire);
			} else if(is_null($lIdOperationAchatSolidaire)) {
				unset($lRechargementChampComplementaire[13]);
			}
			if($lMaj) {
				$pAchat->getRechargement()->setChampComplementaire($lRechargementChampComplementaire);
				$lOperationService->set($pAchat->getRechargement());
			}
		}
		
		// Liaison achat
		if(!is_null($lIdOperationAchat)) {
			$lChampComplementaire = $pAchat->getOperationAchat()->getChampComplementaire();
			$lChampComplementaire[8] = new OperationChampComplementaireVO(null, 8, $lIdOperationZeybu);
			if(!$lMajRechargement && !is_null($lIdRechargement)) {
				$lChampComplementaire[14] = new OperationChampComplementaireVO(null, 14, $lIdRechargement);
			} else if(is_null($lIdRechargement)) {
				unset($lChampComplementaire[14]);
			}
			if(!$lMajAchatSolidaire && !is_null($lIdOperationAchatSolidaire)) {
				$lChampComplementaire[13] = new OperationChampComplementaireVO(null, 13, $lIdOperationAchatSolidaire);
			} else if(is_null($lIdOperationAchatSolidaire)) {
				unset($lChampComplementaire[13]);
			}
			$pAchat->getOperationAchat()->setChampComplementaire($lChampComplementaire);
			$lOperationService->set($pAchat->getOperationAchat()); // Operation d'achat avec lien operation zeybu
		}
		
		// Liaison Achat Solidaire
		if(!is_null($lIdOperationAchatSolidaire)) {
			$lChampComplementaireSolidaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
			$lChampComplementaireSolidaire[8] = new OperationChampComplementaireVO(null, 8, $lIdOperationZeybuSolidaire);
			if(!$lMajRechargement && !is_null($lIdRechargement)) {
				$lChampComplementaireSolidaire[14] = new OperationChampComplementaireVO(null, 14, $lIdRechargement);
			} else if(is_null($lIdRechargement)) {
				unset($lChampComplementaireSolidaire[14]);
			}
			if(!$lMajAchatSolidaire && !is_null($lIdOperationAchatSolidaire)) {
				$lChampComplementaireSolidaire[12] = new OperationChampComplementaireVO(null, 12, $lIdOperationAchat);
			} else if(is_null($lIdOperationAchat)) {
				unset($lChampComplementaireSolidaire[12]);
			}
			$pAchat->getOperationAchatSolidaire()->setChampComplementaire($lChampComplementaireSolidaire);
			$lOperationService->set($pAchat->getOperationAchatSolidaire()); // Operation d'achat solidaire avec lien operation zeybu
		}
		
		// Ajout des produits
		$lIdModeleLot = array();
		$lIdDetailCommande = array();
		foreach($pAchat->getProduits() as $lProduit) {
			$lTestModeleLot = $lProduit->getIdModeleLot();
			$lTestDetailCommande = $lProduit->getIdDetailCommande();
			if(!empty($lTestModeleLot) && !is_null($lTestModeleLot)) {
				array_push($lIdModeleLot, $lTestModeleLot);
			} else if(!empty($lTestDetailCommande) && !is_null($lTestDetailCommande)) {
				array_push($lIdDetailCommande, $lTestDetailCommande);
			}
			$lTestModeleLotSolidaire = $lProduit->getIdModeleLotSolidaire();
			$lTestDetailCommandeSolidaire = $lProduit->getIdDetailCommandeSolidaire();
			if(!empty($lTestModeleLotSolidaire) && !is_null($lTestModeleLotSolidaire)) {
				array_push($lIdModeleLot, $lTestModeleLotSolidaire);
			} else if(!empty($lTestDetailCommandeSolidaire) && !is_null($lTestDetailCommandeSolidaire)) {
				array_push($lIdDetailCommande, $lTestDetailCommandeSolidaire);
			}
		}
		if(!empty($lIdModeleLot)) {
			$lListeModeleLot = ModeleLotManager::selectByArray($lIdModeleLot);
		}
		if(!empty($lIdDetailCommande)) {
			$lListeDetailCommande = DetailCommandeManager::selectByArrayClassByDcomId($lIdDetailCommande);
		}
		
		// Suppression de l'ensemble des lignes de produit qui seront à nouveau insérées
		DetailAchatManager::delete($lIdOperationAchatActuel, $lIdOperationAchatSolidaireActuel);
		
		$lDetailOperationService = new DetailOperationService();
		$lStockService = new StockService();
		foreach($lAchatActuel->getProduits() as $lProduitInital ) {
			$lMaj = false;
			
			foreach($pAchat->getProduits() as $lProduitMaj) {
				if($lProduitInital->getIdStock() == $lProduitMaj->getIdStock()
						&& $lProduitInital->getIdDetailOperation() == $lProduitMaj->getIdDetailOperation()
						&& $lProduitInital->getIdStockSolidaire() == $lProduitMaj->getIdStockSolidaire()
						&& $lProduitInital->getIdDetailOperationSolidaire() == $lProduitMaj->getIdDetailOperationSolidaire()	) { // Modification
					$lMaj = true;
					
					// Stock
					$lIdStock = 0;
					$lIdDetailOperation = 0;
					
					if($lProduitInital->getIdStock() == 0 && $lProduitMaj->getQuantite() < 0) { // Ajout
						$lUnite = '';
						$lTestModeleLot = $lProduitMaj->getIdModeleLot();
						$lTestDetailCommande = $lProduitMaj->getIdDetailCommande();
						if(!empty($lTestModeleLot) && !is_null($lTestModeleLot)) {
							$lUnite = $lListeModeleLot[$lTestModeleLot]->getUnite();
						} else if(!empty($lTestDetailCommande) && !is_null($lTestDetailCommande)) {
							$lUnite = $lListeDetailCommande[$lTestDetailCommande]->getUnite();
						}
						$lIdStock = $lStockService->set( new StockVO(
								null,
								null,
								$lProduitMaj->getQuantite(),
								1,
								$lIdCompte,
								$lProduitMaj->getIdDetailCommande(), /* detail commande */
								$lProduitMaj->getIdModeleLot(), /* modele Lot */
								$lIdOperationAchat,
								$lProduitMaj->getIdNomProduit(),
								$lUnite) );
					
						// Prix
						$lIdDetailOperation = $lDetailOperationService->set(new DetailOperationVO(
								null,
								$lIdOperationAchat,
								$lIdCompte,
								$lProduitMaj->getMontant(),
								$lLibelleOperation,
								null,
								7,
								$lProduitMaj->getIdDetailCommande(), /* detail commande */
								$lProduitMaj->getIdModeleLot(), /* modele Lot */
								$lProduitMaj->getIdNomProduit(),
								null) );
					} else if($lProduitInital->getIdStock() != 0 && $lProduitMaj->getQuantite() < 0) { // Modification
						$lStockInitial = $lStockService->get($lProduitInital->getIdStock());
						$lIdStock = $lStockInitial->getId();
						$lStockInitial->setQuantite($lProduitMaj->getQuantite());						
						$lStockService->set( $lStockInitial );
							
						// Prix
						$lDetailOperationInitial = $lDetailOperationService->get($lProduitInital->getIdDetailOperation());
						$lIdDetailOperation = $lDetailOperationInitial->getId();
						$lDetailOperationInitial->setMontant($lProduitMaj->getMontant());
						$lDetailOperationService->set($lDetailOperationInitial);
					} else { // Suppression
						$lStockService->delete( $lProduitInital->getIdStock() );
						$lDetailOperationService->delete($lProduitInital->getIdDetailOperation());
					}
					
					// Stock Solidaire
					$lIdStockSolidaire = 0;
					$lIdDetailOperationSolidaire = 0;
					if($lProduitInital->getIdStockSolidaire() == 0 && $lProduitMaj->getQuantiteSolidaire() < 0) {
						$lUniteSolidaire = '';
						$lTestModeleLotSolidaire = $lProduitMaj->getIdModeleLotSolidaire();
						$lTestDetailCommandeSolidaire = $lProduitMaj->getIdDetailCommandeSolidaire();
						if(!empty($lTestModeleLotSolidaire) && !is_null($lTestModeleLotSolidaire)) {
							$lUniteSolidaire = $lListeModeleLot[$lTestModeleLotSolidaire]->getUnite();
						} else if(!empty($lTestDetailCommandeSolidaire) && !is_null($lTestDetailCommandeSolidaire)) {
							$lUniteSolidaire = $lListeDetailCommande[$lTestDetailCommandeSolidaire]->getUnite();
						}
						$lIdStockSolidaire = $lStockService->set( new StockVO(
								null,
								null,
								$lProduitMaj->getQuantiteSolidaire(),
								2,
								$lIdCompte,
								$lProduitMaj->getIdDetailCommandeSolidaire(),
								$lProduitMaj->getIdModeleLotSolidaire(),
								$lIdOperationAchatSolidaire,
								$lProduitMaj->getIdNomProduit(),
								$lUniteSolidaire));
					
						// Prix
						$lIdDetailOperationSolidaire = $lDetailOperationService->set(new DetailOperationVO(
								null,
								$lIdOperationAchatSolidaire,
								$lIdCompte,
								$lProduitMaj->getMontantSolidaire(),
								$lLibelleOperationSolidaire,
								null,
								8,
								$lProduitMaj->getIdDetailCommandeSolidaire(), /* detail commande */
								$lProduitMaj->getIdModeleLotSolidaire(), /* modele Lot */
								$lProduitMaj->getIdNomProduit(),
								null) );
					} else if($lProduitInital->getIdStockSolidaire() != 0 && $lProduitMaj->getQuantiteSolidaire() < 0) { // Modification
						$lStockInitialSolidaire = $lStockService->get($lProduitInital->getIdStockSolidaire());
						$lIdStockSolidaire = $lStockInitialSolidaire->getId();
						$lStockInitialSolidaire->setQuantite($lProduitMaj->getQuantiteSolidaire());		

						
						
						$lStockService->set( $lStockInitialSolidaire );
							
						// Prix
						$lDetailOperationInitialSolidaire = $lDetailOperationService->get($lProduitInital->getIdDetailOperationSolidaire());
						$lIdDetailOperationSolidaire = $lDetailOperationInitialSolidaire->getId();
						$lDetailOperationInitialSolidaire->setMontant($lProduitMaj->getMontantSolidaire());
						$lDetailOperationService->set($lDetailOperationInitialSolidaire);
					} else { // Suppression
						$lStockService->delete( $lProduitInital->getIdStockSolidaire() );
						$lDetailOperationService->delete($lProduitInital->getIdDetailOperationSolidaire());
					}
					
					if($lProduitMaj->getQuantiteSolidaire() < 0 || $lProduitMaj->getQuantite() < 0) { // Pas d'ajout de ligne vide
						DetailAchatManager::insert(new DetailAchatVO($lIdOperationAchat, $lIdOperationAchatSolidaire, $lProduitMaj->getIdNomProduit(), $lIdStock, $lIdDetailOperation, $lIdStockSolidaire, $lIdDetailOperationSolidaire));
					}
				}
			}
			/*	var_dump($lMaj);
				var_dump($lProduitInital);
				var_dump($lProduitMaj);*/
				
			if(!$lMaj) { // Suppression
				$lStockService->delete( $lProduitInital->getIdStock() );
				$lDetailOperationService->delete($lProduitInital->getIdDetailOperation());
				$lStockService->delete( $lProduitInital->getIdStockSolidaire() );
				$lDetailOperationService->delete($lProduitInital->getIdDetailOperationSolidaire());
			}
		}
		
		foreach($pAchat->getProduits() as $lProduitMaj) {
			$lMaj = false;
			foreach($lAchatActuel->getProduits() as $lProduitInital ) {
				if($lProduitInital->getIdStock() == $lProduitMaj->getIdStock()
						&& $lProduitInital->getIdDetailOperation() == $lProduitMaj->getIdDetailOperation()
						&& $lProduitInital->getIdStockSolidaire() == $lProduitMaj->getIdStockSolidaire()
						&& $lProduitInital->getIdDetailOperationSolidaire() == $lProduitMaj->getIdDetailOperationSolidaire()) { // Modification
					$lMaj = true;
				}
			}

			if(!$lMaj) { // Ajout
				// Stock
				$lIdStock = 0;
				$lIdDetailOperation = 0;
				if($lProduitMaj->getQuantite() < 0) {
					$lUnite = '';
					$lTestModeleLot = $lProduitMaj->getIdModeleLot();
					$lTestDetailCommande = $lProduitMaj->getIdDetailCommande();
					if(!empty($lTestModeleLot) && !is_null($lTestModeleLot)) {
						$lUnite = $lListeModeleLot[$lTestModeleLot]->getUnite();
					} else if(!empty($lTestDetailCommande) && !is_null($lTestDetailCommande)) {
						$lUnite = $lListeDetailCommande[$lTestDetailCommande]->getUnite();
					}
					$lIdStock = $lStockService->set( new StockVO(
							null,
							null,
							$lProduitMaj->getQuantite(),
							1,
							$lIdCompte,
							$lProduitMaj->getIdDetailCommande(), /* detail commande */
							$lProduitMaj->getIdModeleLot(), /* modele Lot */
							$lIdOperationAchat,
							$lProduitMaj->getIdNomProduit(),
							$lUnite) );
				
					// Prix
					$lIdDetailOperation = $lDetailOperationService->set(new DetailOperationVO(
							null,
							$lIdOperationAchat,
							$lIdCompte,
							$lProduitMaj->getMontant(),
							$lLibelleOperation,
							null,
							7,
							$lProduitMaj->getIdDetailCommande(), /* detail commande */
							$lProduitMaj->getIdModeleLot(), /* modele Lot */
							$lProduitMaj->getIdNomProduit(),
							null) );
				}
				
				// Stock Solidaire
				$lIdStockSolidaire = 0;
				$lIdDetailOperationSolidaire = 0;
				if($lProduitMaj->getQuantiteSolidaire() < 0) {
					$lUniteSolidaire = '';
					$lTestModeleLotSolidaire = $lProduitMaj->getIdModeleLotSolidaire();
					$lTestDetailCommandeSolidaire = $lProduitMaj->getIdDetailCommandeSolidaire();
					if(!empty($lTestModeleLotSolidaire) && !is_null($lTestModeleLotSolidaire)) {
						$lUniteSolidaire = $lListeModeleLot[$lTestModeleLotSolidaire]->getUnite();
					} else if(!empty($lTestDetailCommandeSolidaire) && !is_null($lTestDetailCommandeSolidaire)) {
						$lUniteSolidaire = $lListeDetailCommande[$lTestDetailCommandeSolidaire]->getUnite();
					}
					$lIdStockSolidaire = $lStockService->set( new StockVO(
							null,
							null,
							$lProduitMaj->getQuantiteSolidaire(),
							2,
							$lIdCompte,
							$lProduitMaj->getIdDetailCommandeSolidaire(),
							$lProduitMaj->getIdModeleLotSolidaire(),
							$lIdOperationAchatSolidaire,
							$lProduitMaj->getIdNomProduit(),
							$lUniteSolidaire));
				
					// Prix
					$lIdDetailOperationSolidaire = $lDetailOperationService->set(new DetailOperationVO(
							null,
							$lIdOperationAchatSolidaire,
							$lIdCompte,
							$lProduitMaj->getMontantSolidaire(),
							$lLibelleOperationSolidaire,
							null,
							8,
							$lProduitMaj->getIdDetailCommandeSolidaire(), /* detail commande */
							$lProduitMaj->getIdModeleLotSolidaire(), /* modele Lot */
							$lProduitMaj->getIdNomProduit(),
							null) );
				}
				
				
				if($lProduitMaj->getQuantiteSolidaire() < 0 || $lProduitMaj->getQuantite() < 0) { // Pas d'ajout de ligne vide
					DetailAchatManager::insert(new DetailAchatVO($lIdOperationAchat, $lIdOperationAchatSolidaire, $lProduitMaj->getIdNomProduit(), $lIdStock, $lIdDetailOperation, $lIdStockSolidaire, $lIdDetailOperationSolidaire));
				}				
			}
		}
				
		// Retourne l'Id de l'achat ou à defaut celui de l'achat solidaire
		$lIdRetour = $lIdOperationAchat;
		if($lIdRetour == 0) {
			if($lIdOperationAchatSolidaire != 0) {
				$lIdRetour = $lIdOperationAchatSolidaire;
			} else {
				$lIdRetour = $lIdRechargement;
			}
		}
		
		return $lIdRetour;
	}
	
	/**
	* @name updateReservation($pAchat)
	* @param AchatVO
	* @return integer
	* @desc Met à jour une réservation pour la passer en achat
	*/
/*	private function updateReservation($pAchat) {
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
/*	private function updateAchat($pAchat) {
		$lAchat = $this->get($pAchat->getId());
		return $this->update($lAchat,$pAchat,$pAchat->getId()->getIdAchat());
	}
	
	/**
	* @name update($pAchat)
	* @param AchatVO
	* @return integer
	* @desc Met à jour une réservation
	*/
/*	private function update($pAchatActuel,$pNouvelAchat,$pIdOperation) {		
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
/*	private function updateProduitAchat($pAchatActuel,$pNouvelAchat,$pIdOperation) {
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
					$lStock->setIdModeleLot($lAchatActuelle->getIdLot());
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
					$lDetailOperation->setIdModeleLot($lAchatActuelle->getIdLot());
					$lDetailOperation->setIdNomProduit($lAchatActuelle->getIdNomProduit());
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
/*				$lStock = $lStockService->get($lAchatActuelle->getId()->getIdStock());
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
				$lStock->setIdModeleLot($lAchatNouvelle->getIdLot());
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
				$lDetailOperation->setIdModeleLot($lAchatNouvelle->getIdLot());
				$lDetailOperation->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
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
/*	private function updateProduitReservationAchat($pAchatActuel,$pNouvelAchat,$pIdOperation) {
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
					$lStock->setIdModeleLot($lAchatActuelle->getIdLot());
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
					$lDetailOperation->setIdModeleLot($lAchatActuelle->getIdLot());
					$lDetailOperation->setIdNomProduit($lAchatActuelle->getIdNomProduit());
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
/*			}
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
				$lStock->setIdModeleLot($lAchatNouvelle->getIdLot());
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
				$lDetailOperation->setIdModeleLot($lAchatNouvelle->getIdLot());
				$lDetailOperation->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
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
/*	private function updateProduitAchatSolidaire($pAchatActuel,$pNouvelAchat,$pIdOperation) {
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
					$lStock->setIdModeleLot($lAchatActuelle->getIdLot());
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
					$lDetailOperation->setIdModeleLot($lAchatActuelle->getIdLot());
					$lDetailOperation->setIdNomProduit($lAchatActuelle->getIdNomProduit());
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
				
/*				$lStock = $lStockService->get($lAchatActuelle->getId()->getIdStock());
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
				$lStock->setIdModeleLot($lAchatNouvelle->getIdLot());
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
/*				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lAchatNouvelle->getIdNomProduit(),$lAchatNouvelle->getUnite());
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
				$lDetailOperation->setIdModeleLot($lAchatNouvelle->getIdLot());
				$lDetailOperation->setIdNomProduit($lAchatNouvelle->getIdNomProduit());
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
/*	private function insertProduitAchatSolidaire($pAchat) {
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
				$lStock->setIdModeleLot($lProduit->getIdLot());
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
/*				$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduit->getIdNomProduit(),$lProduit->getUnite());
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
				$lDetailOperation->setIdModeleLot($lProduit->getIdLot());
				$lDetailOperation->setIdNomProduit($lProduit->getIdNomProduit());
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
		$lAchatValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AchatValid();
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
		$lAchatValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AchatValid();
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
		$lAchatValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AchatValid();
		if(!is_null($pId) && $lAchatValid->selectAll($pId)) {
			return $this->selectAll($pId);
		}
		return false;
	}
	
	/**
	* @name selectOperationAchat($pIdCompte, $pIdMarche)
	* @param int(11) IdCompte
	* @param int(11) IdMarche
	* @return array(OperationVO)
	* @desc Retourne une liste d'operation
	*/
	public function selectOperationAchat($pIdCompte, $pIdMarche) {
		return OperationManager::selectOperationAchat($pIdCompte, $pIdMarche);
	}

	/**
	* @name selectAll($pId)
	* @param IdReservation
	* @return array(AchatVO)
	* @desc Retourne les achats du compte pour un marché
	*/
	private function selectAll($pId) {		
		$lOperations = $this->selectOperationAchat($pId->getIdCompte(), $pId->getIdCommande());
		$lAchats = array();
		if(!is_null($lOperations[0]->getId())) {
			foreach($lOperations as $lOperation) {
				//$pId->setIdAchat($lOperation->getId());
				array_push($lAchats,$this->select($lOperation->getId()));
			}
		}
		return $lAchats;
	}
	
	/**
	 * @name select($pId)
	 * @param integer(11)
	 * @return AchatVO
	 * @desc Retourne un achat
	 */
	private function select($pId) {
		$lOperationService = new OperationService();
		$lOperationInitiale = $lOperationService->getDetail($pId);
		
		$lChampComplementaire = $lOperationInitiale->getChampComplementaire();
		
		$lOperationAchat = NULL;
		$lOperationAchatSolidaire = NULL;
		$lRechargement = NULL;

		$lIdOperationAchat = 0;
		$lIdOperationAchatSolidaire = 0;
			
		switch($lOperationInitiale->getTypePaiement()) {
			case 7:
				$lOperationAchat = $lOperationInitiale;
				$lIdOperationAchat = $lOperationAchat->getId();
				if(isset($lChampComplementaire[13]) && !is_null($lChampComplementaire[13])) {
					$lIdOperationAchatSolidaire = $lChampComplementaire[13]->getValeur();
					if(!is_null($lIdOperationAchatSolidaire)) {
						$lOperationAchatSolidaire = $lOperationService->getDetail($lIdOperationAchatSolidaire);
					}
				}
				
				if(isset($lChampComplementaire[14]) && !is_null($lChampComplementaire[14])) {
					$lIdRechargement = $lChampComplementaire[14]->getValeur();
					if(!is_null($lIdRechargement)) {
						$lRechargement = $lOperationService->getDetail($lIdRechargement);
					}
				}
				break;
				
			case 8:
				$lOperationAchatSolidaire = $lOperationInitiale;
				$lIdOperationAchatSolidaire = $lOperationAchatSolidaire->getId();
				if(isset($lChampComplementaire[12]) && !is_null($lChampComplementaire[12])) {
					$lIdOperationAchat = $lChampComplementaire[12]->getValeur();
					if(!is_null($lIdOperationAchat)) {
						$lOperationAchat = $lOperationService->getDetail($lIdOperationAchat);
					}
				}
				if(isset($lChampComplementaire[14]) && !is_null($lChampComplementaire[14])) {
					$lIdRechargement = $lChampComplementaire[14]->getValeur();
					if(!is_null($lIdRechargement)) {
						$lRechargement = $lOperationService->getDetail($lIdRechargement);
					}
				}
				break;
				
			default:
				$lRechargement = $lOperationInitiale;
				if(isset($lChampComplementaire[12]) && !is_null($lChampComplementaire[12])) {
					$lIdOperationAchat = $lChampComplementaire[12]->getValeur();
					if(!is_null($lIdOperationAchat)) {
						$lOperationAchat = $lOperationService->getDetail($lIdOperationAchat);
					}
				}
				
				if(isset($lChampComplementaire[13]) && !is_null($lChampComplementaire[13])) {
					$lIdOperationAchatSolidaire = $lChampComplementaire[13]->getValeur();
					if(!is_null($lIdOperationAchatSolidaire)) {
						$lOperationAchatSolidaire = $lOperationService->getDetail($lIdOperationAchatSolidaire);
					}
				}
				break;
		}
		
		$lProduits = DetailAchatManager::selectProduitsDetailAchat($lIdOperationAchat, $lIdOperationAchatSolidaire);
		
		return new AchatVO($lOperationAchat, $lOperationAchatSolidaire, $lProduits, $lRechargement);
	}
	
	/**
	 * @name rechercheListeAchat()
	 * @return array(AchatVO)
	 * @desc Retourne une liste d'Achat
	 */
	public function rechercheListeAchat($pDateDebut = null, $pDateFin = null, $pIdMarche = null) {
		$lTypeRecherche = array();
		$lTypeCritere = array();
		$lCritereRecherche = array();
	
		if(!is_null($pDateDebut)) {
			array_push($lTypeRecherche, OperationManager::CHAMP_OPERATION_DATE);
			array_push($lTypeCritere, '>=');
			array_push($lCritereRecherche, $pDateDebut);
		}
		if(!is_null($pDateFin)) {
			array_push($lTypeRecherche, OperationManager::CHAMP_OPERATION_DATE);
			array_push($lTypeCritere, '<=');
			array_push($lCritereRecherche, $pDateFin);
		}
		if(!is_null($pIdMarche)) {
			array_push($lTypeRecherche, OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR);
			array_push($lTypeCritere, '=');
			if($pIdMarche == -1) { // Pour les Achats hors marché
				array_push($lCritereRecherche, NULL);
			} else {
				array_push($lCritereRecherche, $pIdMarche);
			}
		}
			
		return DetailAchatManager::rechercheListeAchat(
				$lTypeRecherche,
				$lTypeCritere,
				$lCritereRecherche,
				array(''),
				array(''));
	}
	
	/**
	* @name select($pId)
	* @param IdAchatVO
	* @return AchatVO
	* @desc Retourne une Reservation
	*/
	/*private function select($pId) {			
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
						$lDetailAchat->setIdLot($lDetail->getDopeIdModeleLot());
						$lDetailAchat->setMontant($lDetail->getDopeMontant());
						$lDetailAchat->setQuantite($lDetail->getStoQuantite());
						$lDetailAchat->setIdProduit($lDetail->getDcomIdProduit());
						$lDetailAchat->setIdNomProduit($lDetail->getDcomIdNomProduit());
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
						$lDetailAchat->setIdLot($lDetail->getDopeIdModeleLot());
						$lDetailAchat->setMontant($lDetail->getDopeMontant());
						$lDetailAchat->setQuantite($lDetail->getStoQuantite());
						$lDetailAchat->setIdProduit($lDetail->getDcomIdProduit());
						$lDetailAchat->setIdNomProduit($lDetail->getDcomIdNomProduit());
						
						$lAchat->addDetailAchatSolidaire($lDetailAchat);
					}
				}		
				$lAchat->setTotalSolidaire($lOperation->getMontant());
				break;
		}
		return $lAchat;
	}*/
	
	
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
	
	/*public function ajoutProduitAchat($pProduitAchat) {
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
			if(empty($lIdProduit)) {							
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
					$lLotAchat = array();
					foreach($lModelesLot as $lLot) {
						$lDetailCommande = new DetailCommandeVO();
						$lDetailCommande->setId($lLot->getMLotId());
						$lDetailCommande->setTaille($lLot->getMLotQuantite());
						$lDetailCommande->setPrix($lLot->getMLotPrix());
						$lProduit->addLots($lDetailCommande);
						
						if($lDetail['lotId'] == $lLot->getMLotId()) {
							$lUnite = $lModelesLot[$lLot->getMLotId()]->getMLotUnite();
							$lProduit->setUnite($lUnite);
							$lDetailAchat->setUnite($lUnite);
							array_push($lLotAchat,$lDetailCommande);
						} else {
							$lProduit->addLots($lDetailCommande);
						}
					}
					
					// Ajout du produit dans le marché sauf le lot d'achat
					$lMarcheService = new MarcheService();
					$lIdProduit = $lMarcheService->ajoutProduit($lProduit);
					
					//Ajout du lot d'achat
					$lProduit->setId($lIdProduit);
					$lProduit->setLots($lLotAchat);
					$lIdLotProduitMarche = $lMarcheService->ajoutLotUnitaireProduit($lProduit);
					
					$lDetailAchat->setIdDetailCommande($lDcomId);
				}
			} else {
				$lIdLotProduitMarche = $lDetail['lotId'];
			}
			
			// Id du produit existe (soit présent soit bien ajouté)
		/*	if(!empty($lIdProduit)) {
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
			}*/
/*		} 
				
		// On vérifie pour un compte != d'invité si il n'y a pas un achat ou une réservation à mettre à jour
		if($pProduitAchat->getIdMarche() != '' && $pProduitAchat->getIdOperation() == '' && $pProduitAchat->getIdCompte() != -3) {
			$lOperations = $this->selectOperationAchat($lIdAchat->getIdCompte(),$lIdAchat->getIdCommande());
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
	}	*/
}
?>