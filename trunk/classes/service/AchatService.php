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
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");

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
					$lOperationAchatChampComp = $pAchat->getOperationAchat()->getChampComplementaire();
					$lIdRequete = $lOperationAchatChampComp[15]->getValeur();
				}
				if(!is_null($lOperationAchatSolidaire) && !empty($lOperationAchatSolidaire)) {
					$lOperationAchatSolidaireChampComp = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
					$lIdRequete = $lOperationAchatSolidaireChampComp[15]->getValeur();
				}
				if(!is_null($lOperationRechargement) && !empty($lOperationRechargement)) {
					$lOperationRechargementChampComp = $pAchat->getRechargement()->getChampComplementaire();
					$lIdRequete = $lOperationRechargementChampComp[15]->getValeur();
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
				$lIdMarche = $ltestChampComplementaire[1]->getValeur();
				
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
				if(!isset($lMarche)) { // Pour éviter de lancer 2 fois la requête
					$lIdMarche = $ltestChampComplementaire[1]->getValeur();
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
			$ltestChampComplementaire = $pAchat->getOperationAchat()->getChampComplementaire();
			$lIdOperationZeybu = $ltestChampComplementaire[8]->getValeur();
			$lLibelleOperation = $pAchat->getOperationAchat()->getLibelle();
			$lIdCompte = $pAchat->getOperationAchat()->getIdCompte();
			if(isset($ltestChampComplementaire[1])) {
				$lIdMarche = $ltestChampComplementaire[1]->getValeur();
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
				$lIdMarche = $ltestChampComplementaire[1]->getValeur();
		
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
			$ltestChampComplementaire = $pAchat->getOperationAchatSolidaire()->getChampComplementaire();
			$lIdOperationZeybuSolidaire = $ltestChampComplementaire[8]->getValeur();
			$lLibelleOperationSolidaire = $pAchat->getOperationAchatSolidaire()->getLibelle();
			$lIdCompte = $pAchat->getOperationAchatSolidaire()->getIdCompte();
			if(isset($ltestChampComplementaire[1])) {
				$lIdMarche = $ltestChampComplementaire[1]->getValeur();
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
				if(!isset($lMarche)) { // Pour éviter de lancer 2 fois la requête
					$lIdMarche = $ltestChampComplementaire[1]->getValeur();
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
			if(!is_null($lIdOperationAchat)) {
				$lMaj = true;
				$lRechargementChampComplementaire[12] = new OperationChampComplementaireVO(null, 12, $lIdOperationAchat);
			} else if(is_null($lIdOperationAchat)) {
				unset($lRechargementChampComplementaire[12]);
			}
			if(!is_null($lIdOperationAchatSolidaire)) {
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
			if(!is_null($lIdRechargement)) {
				$lChampComplementaire[14] = new OperationChampComplementaireVO(null, 14, $lIdRechargement);
			} else if(is_null($lIdRechargement)) {
				unset($lChampComplementaire[14]);
			}
			if(!is_null($lIdOperationAchatSolidaire)) {
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
			if(!is_null($lIdRechargement)) {
				$lChampComplementaireSolidaire[14] = new OperationChampComplementaireVO(null, 14, $lIdRechargement);
			} else if(is_null($lIdRechargement)) {
				unset($lChampComplementaireSolidaire[14]);
			}
			if(!is_null($lIdOperationAchat)) {
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
	* @name delete($pId)
	* @param IdAchatVO
	* @desc Supprime un achat
	*/
	public function delete($pId) {
		$lAchatValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AchatValid();
		if(!is_null($pId) && $lAchatValid->select($pId)) {
			$lAchatActuel = $this->select($pId);
			
			$lOperationService = new OperationService();
			
			// Suppression des opérations 
			if(!is_null($lAchatActuel->getRechargement())) { // Rechargement
				$lOperationService->delete($lAchatActuel->getRechargement()->getId());
			}
			
			$lIdCompte = 0;
			$lIdMarche = 0;
			
			$lIdOperationAchat = 0;
			if(!is_null($lAchatActuel->getOperationAchat())) { // Achat avec Ope Zeybu
				$lIdOperationAchat = $lAchatActuel->getOperationAchat()->getId();
				$lOperationService->delete($lAchatActuel->getOperationAchat()->getId());
				$lOperationAchatChampComp = $lAchatActuel->getOperationAchat()->getChampComplementaire();
				$lOperationService->delete($lOperationAchatChampComp[8]->getValeur());
				
				$lIdCompte = $lAchatActuel->getOperationAchat()->getIdCompte();
				$lIdMarche = $lOperationAchatChampComp[1]->getValeur();
			}
			
			$lIdOperationAchatSolidaire = 0;
			if(!is_null($lAchatActuel->getOperationAchatSolidaire())) { // Achat solidaire avec ope zeybu
				$lIdOperationAchatSolidaire = $lAchatActuel->getOperationAchatSolidaire()->getId();
				$lOperationService->delete($lAchatActuel->getOperationAchatSolidaire()->getId());
				$lOperationAchatSolidaireChampComp = $lAchatActuel->getOperationAchatSolidaire()->getChampComplementaire();
				$lOperationService->delete($lOperationAchatSolidaireChampComp[8]->getValeur());
				
				$lIdCompte = $lAchatActuel->getOperationAchatSolidaire()->getIdCompte();
				$lIdMarche = $lOperationAchatSolidaireChampComp[1]->getValeur();
			}
			
			// Suppression de l'ensemble des lignes de produit
			DetailAchatManager::delete($lIdOperationAchat, $lIdOperationAchatSolidaire);
			
			$lDetailOperationService = new DetailOperationService();
			$lStockService = new StockService();
			foreach($lAchatActuel->getProduits() as $lProduitInital ) {
				$lStockService->delete( $lProduitInital->getIdStock() );
				$lDetailOperationService->delete($lProduitInital->getIdDetailOperation());
				$lStockService->delete( $lProduitInital->getIdStockSolidaire() );
				$lDetailOperationService->delete($lProduitInital->getIdDetailOperationSolidaire());
			}
			
			// Suppression de la réservation
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lIdCompte);
			$lIdReservation->setIdCommande($lIdMarche);
			$lReservationService->delete($lIdReservation);
			
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
	 * @name getAchatEtReservationProduit( $pIdProduits)
	 * @param array(integer)
	 * @return array(ListeAchatEtReservationExportVO)
	 * @desc Retourne les achats et réservations positionnées sur les produits
	 */
	public function getAchatEtReservationProduit($pIdProduits) {
		return AdherentManager::rechercheAchatEtReservation($pIdProduits);
	}
}
?>