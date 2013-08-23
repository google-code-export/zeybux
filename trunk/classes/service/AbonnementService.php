<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/02/2012
// Fichier :AbonnementService.php
//
// Description : Classe AbonnementService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueSuspensionAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "LotAbonnementManager.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "AbonnementValid.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProduitAbonnementViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailCompteAbonnementViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailProduitAbonnementViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProduitsNonAbonneViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProduitsAbonneViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAbonnesProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeLotAbonnementViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailMarcheViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");

/**
 * @name AbonnementService
 * @author Julien PIERRE
 * @since 12/02/2012
 * @desc Classe Service d'Abonnement
 */
class AbonnementService
{	
	/**
	* @name setProduit($pProduitAbonnement)
	* @param ProduitAbonnementVO
	* @return integer
	* @desc Ajoute ou modifie un ProduitAbonnement
	*/
	public function setProduit($pProduitAbonnement,$pLotsRemplacement = array()) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->inputProduit($pProduitAbonnement)) {
			if($lAbonnementValid->insertProduit($pProduitAbonnement)) {
				return $this->insertProduit($pProduitAbonnement);			
			} else if($lAbonnementValid->updateProduit($pProduitAbonnement)) {
				return $this->updateProduit($pProduitAbonnement,$pLotsRemplacement);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name insertProduit($pProduitAbonnement)
	* @param ProduitAbonnementVO
	* @return integer
	* @desc Ajoute un ProduitAbonnementVO
	*/
	private function insertProduit($pProduitAbonnement) {		
		 $lId = ProduitAbonnementManager::insert($pProduitAbonnement);
		 foreach($pProduitAbonnement->getLots() as $lLot) {
			$lLotAbonnement = new LotAbonnementVO();
			$lLotAbonnement->setIdProduitAbonnement($lId);
			$lLotAbonnement->setTaille($lLot["taille"]);
			$lLotAbonnement->setPrix($lLot["prix"]);
			$lLotAbonnement->setEtat(0);
		 	LotAbonnementManager::insert($lLotAbonnement);
		 }		 
		 return $lId;
	}
	
	/**
	* @name updateProduit($pProduitAbonnement)
	* @param ProduitAbonnementVO
	* @return integer
	* @desc Met à jour un ProduitAbonnementVO
	*/
	private function updateProduit($pProduitAbonnement, $pLotRemplacement = array()) {		
		$lProduitActuel = $this->selectProduit($pProduitAbonnement->getId());
		
		//Les lots
		$lLotSupp = array();
		foreach($lProduitActuel->getLots() as $lLotActuel) {
			$lSuppLot = true;
			foreach($pProduitAbonnement->getLots() as $lLotNv) {					
				// Maj Lot
				if($lLotActuel->getId() == $lLotNv->getId()) {

					$lDcomId = $lLotActuel->getId();
					$lSuppLot = false;
					$lLotAbonnement = new LotAbonnementVO();
					$lLotAbonnement->setId($lLotActuel->getId());
					$lLotAbonnement->setIdProduitAbonnement($lProduitActuel->getId());
					$lLotAbonnement->setTaille($lLotNv->getTaille());
					$lLotAbonnement->setPrix($lLotNv->getPrix());
					LotAbonnementManager::update($lLotAbonnement);
					
		//			array_push($lLotModif,$lLotAbonnement);
				}																
			}
			
			// Supprimer Lot
			if($lSuppLot) {				
				// Suppression du lot
				$lDeleteLot = LotAbonnementManager::select($lLotActuel->getId());
				$lDeleteLot->setEtat(1);
				LotAbonnementManager::update($lDeleteLot);
												
				array_push($lLotSupp,$lLotActuel->getId());
			}
		}
		
		// Nouveau Lot
		$lLotAdd = array();
		foreach($pProduitAbonnement->getLots() as $lLotNv) {
			$lAjout = true;
			foreach($lProduitActuel->getLots() as $lLotActuel) {
				if($lLotActuel->getId() == $lLotNv->getId()) {
					$lAjout = false;
				}
			}
			if($lAjout) {
				$lLotAbonnement = new LotAbonnementVO();
				$lLotAbonnement->setIdProduitAbonnement($lProduitActuel->getId());
				$lLotAbonnement->setTaille($lLotNv->getTaille());
				$lLotAbonnement->setPrix($lLotNv->getPrix());
				$lDcomId = LotAbonnementManager::insert($lLotAbonnement);
				
				$lLotAdd[$lLotNv->getId()] = $lDcomId; // Si supression d'un lot et positionnement de ce nouveau lot permet de récupérer l'ID
			}
		}
		
		// Chaque lot supprimé => La réservation est positionnée sur un autre lot
		foreach($lLotSupp as $lIdLot) { 				
			if(isset($pLotRemplacement[$lIdLot]) ) {
				$lIdLotRemplacement = $pLotRemplacement[$lIdLot];
				
				// Si le lot de remplacement est un nouveau lot on récupère le vrai id de base et non celui donné par le JS
				if($lIdLotRemplacement < 0) {
					$lIdLotRemplacement = $lLotAdd[$lIdLotRemplacement]; 
				}
				
				// Récupération des abonnements
				$lListeAbonnement = $this->getAbonnementSurLot($lIdLot);
				// Modification si il y a des abonnements
				if(!is_null($lListeAbonnement[0]->getCptAboId())) {
					foreach($lListeAbonnement as $lAbonnement) {
						$lAncienAbonnement = CompteAbonnementManager::select($lAbonnement->getCptAboId());
						$lAncienAbonnement->setIdLotAbonnement($lIdLotRemplacement);
						$this->updateAbonnement($lAncienAbonnement);
					}
				}
			} else { // Si pas de lot de remplacement suppression des abonnements du lot
				// Suppression des abonnements du lot
				$lListeAbonnement = $this->getAbonnementSurLot($lLotActuel->getId());
				foreach($lListeAbonnement as $lAbonnement) {
					$this->deleteAbonnement($lAbonnement->getCptAboId());
				}
			}
		}
		
		return ProduitAbonnementManager::update($pProduitAbonnement);
	}
	
	/**
	* @name deleteProduit($pId)
	* @param integer
	* @desc Supprime un ProduitAbonnementVO
	*/
	public function deleteProduit($pId) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->deleteProduit($pId)){	
			// Suppression des lots
			$lLots = LotAbonnementManager::selectByIdProduitAbonnement($pId);
			foreach($lLots as $lLot) {
				$lLot->setEtat(1);
				LotAbonnementManager::update($lLot);
			}
			
			$lListeAbonnement = $this->getAbonnesProduit($pId); // Supression des abonnements
			foreach($lListeAbonnement as $lAbonnement) {
				$this->deleteAbonnement($lAbonnement->getCptAboId());
			}
			
			$lProduitAbonnementVO = $this->getProduit($pId);
			$lProduitAbonnementVO->setEtat(1);
			return ProduitAbonnementManager::update($lProduitAbonnementVO);
		} else {
			return false;
		}
	}
				
	/**
	* @name getProduit($pId)
	* @param integer
	* @return array(ProduitAbonnementVO) ou ProduitAbonnementVO
	* @desc Retourne une liste de ProduitAbonnementVO
	*/
	public function getProduit($pId = null) {
		if($pId != null) {
			return $this->selectProduit($pId);
		} else {
			return $this->selectAllProduit();
		}
	}
	
	/**
	* @name selectProduit($pId)
	* @param integer
	* @return ProduitAbonnementVO
	* @desc Retourne un ProduitAbonnementVO
	*/
	public function selectProduit($pId) {
		$lProduit = ProduitAbonnementManager::select($pId);
		$lProduit->setLots( ListeLotAbonnementViewManager::selectByIdProduitAbonnement($pId));
		return $lProduit;
	}
	
	/**
	* @name getDetailProduit($pId)
	* @param integer
	* @return ProduitAbonnementVO
	* @desc Retourne un ProduitAbonnementVO
	*/
	public function getDetailProduit($pId) {
		$lProduit = DetailProduitAbonnementViewManager::select($pId);
		$lProduit[0]->setLots( ListeLotAbonnementViewManager::selectByIdProduitAbonnement($pId));
		return $lProduit;
	}
		
	/**
	* @name selectAllProduit()
	* @return array(ProduitAbonnementVO)
	* @desc Retourne une liste de ProduitAbonnementVO
	*/
	public function selectAllProduit() {		
		return ListeProduitAbonnementViewManager::selectAll();
	}
	
	/**
	* @name getProduitByIdNom($pId)
	* @param integer
	* @return ProduitAbonnementVO
	* @desc Retourne un ProduitAbonnementVO
	*/
	public function getProduitByIdNom($pId) {
		$lProduit = ProduitAbonnementManager::selectByIdNom($pId);
		$lProduit->setLots( ListeLotAbonnementViewManager::selectByIdProduitAbonnement($lProduit->getId()));
		return $lProduit;
	}
	
	/**
	* @name setAbonnement($pCompteAbonnement)
	* @param CompteAbonnementVO
	* @return integer
	* @desc Ajoute ou modifie un CompteAbonnement
	*/
	public function setAbonnement($pCompteAbonnement) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->inputAbonnement($pCompteAbonnement)) {
			if($lAbonnementValid->insertAbonnement($pCompteAbonnement)) {
				return $this->insertAbonnement($pCompteAbonnement);			
			} else if($lAbonnementValid->updateAbonnement($pCompteAbonnement)) {
				return $this->updateAbonnement($pCompteAbonnement);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name insertAbonnement($pCompteAbonnement)
	* @param CompteAbonnementVO
	* @return integer
	* @desc Ajoute un Abonnement
	*/
	private function insertAbonnement($pCompteAbonnement) {
		// Si il y a une suspension en cours on ajoute l'abonnement en suspension
		$lProduits = $this->getProduitsAbonne($pCompteAbonnement->getIdCompte());		
		$pCompteAbonnement->setDateDebutSuspension($lProduits[0]->getCptAboDateDebutSuspension() );
		$pCompteAbonnement->setDateFinSuspension($lProduits[0]->getCptAboDateFinSuspension() );
		
		// On essaye de positionner des réservations sur les marché en cours : en fonction de la quantité encore disponbile.
		
		// Récupère le produitAbonnement
		$lProduitAbonnement = $this->getProduit($pCompteAbonnement->getIdProduitAbonnement());
		// La liste des Produit identique en abonnement sur des marche en cours
		$lProduitsMarche = DetailMarcheViewManager::selectProduitAbonnementMarcheActifByIdNomProduit($lProduitAbonnement->getIdNomProduit());
		
		$lListeProduitsMarche = array();
		foreach($lProduitsMarche as $lProduit) {
			if(isset($lListeProduitsMarche[$lProduit->getProId()])) {					
				array_push($lListeProduitsMarche[$lProduit->getProId()]["lots"],$lProduit);
			} else {
				$lListeProduitsMarche[$lProduit->getProId()]["produit"] = $lProduit;
				$lListeProduitsMarche[$lProduit->getProId()]["lots"] = array();
				array_push($lListeProduitsMarche[$lProduit->getProId()]["lots"],$lProduit);
			}
		}
		
		$lReservationService = new ReservationService();
		$lStockService = new StockService();
		foreach($lListeProduitsMarche as $lProduitMarche) {
			$lPoursuivre = true;
			// Si il n'y a pas de suspension à la date du marché
			if(TestFonction::dateTimeEstPLusGrandeEgale($lProduitMarche["produit"]->getComDateMarcheDebut(),$lProduits[0]->getCptAboDateDebutSuspension(),'db') 
			&& TestFonction::dateTimeEstPLusGrandeEgale($lProduits[0]->getCptAboDateFinSuspension(),$lProduitMarche["produit"]->getComDateMarcheFin(),'db')) {
				$lPoursuivre = false;
			}
			
			// Si le marché n'est pas encore passé
			if(!TestFonction::dateTimeEstPLusGrandeEgale($lProduitMarche["produit"]->getComDateMarcheDebut(),StringUtils::dateTimeAujourdhuiDb(),'db')) {
				$lPoursuivre = false;
			}
			
			if($lPoursuivre) {				
				$lIdLot = 0;
				foreach($lProduitMarche["lots"] as $lLot) {
					if(	fmod($pCompteAbonnement->getQuantite(), $lLot->getDcomTaille()) == 0) {
						$lIdLot = $lLot->getDcomId();
						$lTailleLot = $lLot->getDcomTaille();
						$lPrixLot = $lLot->getDcomPrix();
					}
				}

				$lPoursuivre = $lIdLot != 0;
				if($lPoursuivre) {
					$lReservation = new ReservationVO();
					$lReservation->getId()->setIdCompte($pCompteAbonnement->getIdCompte());
					$lReservation->getId()->setIdCommande($lProduitMarche["produit"]->getComId());				
					$lReservationsActuelle = $lReservationService->get($lReservation->getId());
					
					
					$lTestDetailReservation = $lReservationsActuelle->getDetailReservation();
					if(!empty($lTestDetailReservation)) { // Si il y a une réservation déjà sur ce produit
						foreach($lReservationsActuelle->getDetailReservation() as $lReservationActuelle) {
							if($lReservationActuelle->getIdDetailCommande() == $lIdLot) {
								$lPoursuivre = false;
							}
						}
					}

					
					if($lPoursuivre) {
						$lQuantite = $pCompteAbonnement->getQuantite();
						if($lProduitMarche["produit"]->getProStockInitial() != -1) {
							$lStockProduit = $lStockService->selectByIdProduitStockProduitReservation($lProduitMarche["produit"]->getProId());
							$lStockDispo = $lProduitMarche["produit"]->getProStockInitial() - $lStockProduit[0]->getStoQuantite();
							if($lStockDispo > 0) {
								if($lStockDispo < $lQuantite) {
									$lQuantite = $lStockDispo;
								}
							} else { // Plus de stock
								$lPoursuivre = false;
							}
						}
						
						if($lPoursuivre) {
							if($lProduitMarche["produit"]->getProMaxProduitCommande() != -1 && $lProduitMarche["produit"]->getProMaxProduitCommande()  < $lQuantite) {
								$lQuantite = $lProduitMarche["produit"]->getProMaxProduitCommande();
							}						
										
							$lDetailReservation = new DetailReservationVO();							
							$lDetailReservation->setIdDetailCommande($lIdLot);
							$lDetailReservation->setQuantite(-1 * $lQuantite);
							$lDetailReservation->setMontant(-1 * $lQuantite/$lTailleLot * $lPrixLot);
							
							$lReservationsActuelle->addDetailReservation($lDetailReservation);
							$lReservationsActuelle->setId($lReservation->getId());
							$lReservationService->set($lReservationsActuelle);
							
						}
					}
				}
			}
			
		}
		
		
		return CompteAbonnementManager::insert($pCompteAbonnement);
	}
	
	/**
	* @name updateAbonnement($pCompteAbonnement)
	* @param CompteAbonnementVO
	* @return integer
	* @desc Met à jour un Abonnement
	*/
	private function updateAbonnement($pCompteAbonnement) {		
		
		// Récupère le produitAbonnement
		$lProduitAbonnement = $this->getProduit($pCompteAbonnement->getIdProduitAbonnement());
		// La liste des Produit identique en abonnement sur des marche en cours
		$lProduitsMarche = DetailMarcheViewManager::selectProduitAbonnementMarcheActifByIdNomProduit($lProduitAbonnement->getIdNomProduit());
		
		$lListeProduitsMarche = array();
		foreach($lProduitsMarche as $lProduit) {
			if(isset($lListeProduitsMarche[$lProduit->getProId()])) {					
				array_push($lListeProduitsMarche[$lProduit->getProId()]["lots"],$lProduit);
			} else {
				$lListeProduitsMarche[$lProduit->getProId()]["produit"] = $lProduit;
				$lListeProduitsMarche[$lProduit->getProId()]["lots"] = array();
				array_push($lListeProduitsMarche[$lProduit->getProId()]["lots"],$lProduit);
			}
		}
		
		$lReservationService = new ReservationService();
		$lStockService = new StockService();
		foreach($lListeProduitsMarche as $lProduitMarche) {
			$lSuspendu = false;
			// Si il n'y a pas de suspension à la date du marché
			if(TestFonction::dateTimeEstPLusGrandeEgale($lProduitMarche["produit"]->getComDateMarcheDebut(),$pCompteAbonnement->getDateDebutSuspension(),'db') 
			&& TestFonction::dateTimeEstPLusGrandeEgale($pCompteAbonnement->getDateFinSuspension(),$lProduitMarche["produit"]->getComDateMarcheFin(),'db')) {
				$lSuspendu = true;
			}
			
			$lPoursuivre = true;
			// Si le marché n'est pas encore passé
			if(!TestFonction::dateTimeEstPLusGrandeEgale($lProduitMarche["produit"]->getComDateMarcheDebut(),StringUtils::dateTimeAujourdhuiDb(),'db')) {
				$lPoursuivre = false;
			}
			
			if($lPoursuivre) {
				// Recherche de l'Id du lot dans le marché pour le produit correspondant.				
				$lIdLot = 0;
				foreach($lProduitMarche["lots"] as $lLot) {
					if(	fmod($pCompteAbonnement->getQuantite(), $lLot->getDcomTaille()) == 0) {
						$lIdLot = $lLot->getDcomId();
						$lTailleLot = $lLot->getDcomTaille();
						$lPrixLot = $lLot->getDcomPrix();
					}
				}

				// Si un lot correspond
				$lPoursuivre = $lIdLot != 0;
				if($lPoursuivre) {
					$lReservation = new ReservationVO();
					$lReservation->getId()->setIdCompte($pCompteAbonnement->getIdCompte());
					$lReservation->getId()->setIdCommande($lProduitMarche["produit"]->getComId());				
					$lReservationsActuelle = $lReservationService->get($lReservation->getId());
					
					
					$lTestDetailReservation = $lReservationsActuelle->getDetailReservation();
					if(empty($lTestDetailReservation) && !$lSuspendu && $pCompteAbonnement->getEtat() == 0) { // Ajoute une réservation
						$lQuantite = $pCompteAbonnement->getQuantite();
						if($lProduitMarche["produit"]->getProStockInitial() != -1) {
							$lStockProduit = $lStockService->selectByIdProduitStockProduitReservation($lProduitMarche["produit"]->getProId());
							$lStockDispo = $lProduitMarche["produit"]->getProStockInitial() - $lStockProduit[0]->getStoQuantite();
							if($lStockDispo > 0) {
								if($lStockDispo < $lQuantite) {
									$lQuantite = $lStockDispo;
								}
							} else { // Plus de stock
								$lPoursuivre = false;
							}
						}
						
						if($lPoursuivre) {
							if($lProduitMarche["produit"]->getProMaxProduitCommande() != -1 && $lProduitMarche["produit"]->getProMaxProduitCommande()  < $lQuantite) {
								$lQuantite = $lProduitMarche["produit"]->getProMaxProduitCommande();
							}						
										
							$lDetailReservation = new DetailReservationVO();							
							$lDetailReservation->setIdDetailCommande($lIdLot);
							$lDetailReservation->setQuantite(-1 * $lQuantite);
							$lDetailReservation->setMontant(-1 * $lQuantite/$lTailleLot * $lPrixLot);
							
							$lReservationsActuelle->addDetailReservation($lDetailReservation);
							$lReservationsActuelle->setId($lReservation->getId());
							$lReservationService->set($lReservationsActuelle);
							
						}
						
					} else { // Si il y a une réservation déjà sur ce produit on la met à jour
						$lMaj = false;
						$lQuantiteActuelle = 0;
						foreach($lReservationsActuelle->getDetailReservation() as $lDetailReservationActuelle) {
							if($lDetailReservationActuelle->getIdProduit() == $lProduitMarche["produit"]->getProId()) {		
								$lQuantiteActuelle = $lDetailReservationActuelle->getQuantite();
								$lMaj = true;
							} else {
								$lReservation->addDetailReservation($lDetailReservationActuelle);
							}
						}
						
						if($lMaj || (!$lMaj && !$lSuspendu && $pCompteAbonnement->getEtat() == 0) ) {
							$lQuantite = $pCompteAbonnement->getQuantite();
							if($lProduitMarche["produit"]->getProStockInitial() != -1) {
								$lStockProduit = $lStockService->selectByIdProduitStockProduitReservation($lProduitMarche["produit"]->getProId());
								$lStockDispo = $lProduitMarche["produit"]->getProStockInitial() - $lStockProduit[0]->getStoQuantite() - $lQuantiteActuelle;
								
								if($lStockDispo > 0) {
									if($lStockDispo < $lQuantite) {
										$lQuantite = $lStockDispo;
									}
								} else { // Plus de stock
									$lPoursuivre = false;
								}
							}
							
							if($lPoursuivre) {
								if($lProduitMarche["produit"]->getProMaxProduitCommande() != -1 && $lProduitMarche["produit"]->getProMaxProduitCommande()  < $lQuantite) {
									$lQuantite = $lProduitMarche["produit"]->getProMaxProduitCommande();
								}						
											
								$lDetailReservation = new DetailReservationVO();							
								$lDetailReservation->setIdDetailCommande($lIdLot);
								$lDetailReservation->setQuantite(-1 * $lQuantite);
								$lDetailReservation->setMontant(-1 * $lQuantite/$lTailleLot * $lPrixLot);
								
								if($pCompteAbonnement->getEtat() == 0 && !$lSuspendu) { // Si l'abonnement est toujours actif et qu'il n'y a pas de suspension
									$lReservation->addDetailReservation($lDetailReservation);
								}
							}
							$lReservationService->set($lReservation);
						}
					}
				}
			}
			
		}
		return CompteAbonnementManager::update($pCompteAbonnement);
	}
	
	/**
	* @name deleteAbonnement($pId)
	* @param integer
	* @desc Supprime un Abonnement
	*/
	public function deleteAbonnement($pId) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->deleteAbonnement($pId)){			
			$lCompteAbonnementVO = CompteAbonnementManager::select($pId);
			$lCompteAbonnementVO->setEtat(1);			
			$this->updateAbonnement($lCompteAbonnementVO);
		} else {
			return false;
		}
	}
				
	/**
	* @name getAbonnement($pId)
	* @param integer
	* @return array(CompteAbonnementVO) ou CompteAbonnementVO
	* @desc Retourne une liste de CompteAbonnementVO
	*/
	public function getAbonnement($pId = null) {
		if($pId != null) {
			return $this->selectAbonnement($pId);
		} else {
			return $this->selectAllAbonnement();
		}
	}
	
	/**
	* @name selectAbonnement($pId)
	* @param integer
	* @return CompteAbonnementVO
	* @desc Retourne un CompteAbonnementVO
	*/
	public function selectAbonnement($pId) {
		$lDetail = DetailCompteAbonnementViewManager::select($pId);
		return $lDetail[0];
	}
		
	/**
	* @name selectAll()
	* @return array(CompteAbonnementVO)
	* @desc Retourne une liste de CompteAbonnementVO
	*/
	public function selectAllAbonnement() {		
		return CompteAbonnementManager::selectAll();
	}
	
	/**
	* @name getAbonnesProduit($pIdProduitAbonnement)
	* @return array(ListeAbonnesProduitViewVO)
	* @desc Retourne une liste de ListeAbonnesProduitViewVO
	*/
	public function getAbonnesProduit($pIdProduitAbonnement) {
		return ListeAbonnesProduitViewManager::select($pIdProduitAbonnement);
	}
	
	/**
	* @name getAbonnementSurLot($pIdLotAbonnement)
	* @return array(ListeAbonnesProduitViewVO)
	* @desc Retourne une liste de ListeAbonnesProduitViewVO
	*/
	public function getAbonnementSurLot($pIdLotAbonnement) {
		return ListeAbonnesProduitViewManager::selectByIdLot($pIdLotAbonnement);
	}
	
	/**
	* @name getAbonnesByIdNomProduit($pIdNomProduit)
	* @return array(ListeAbonnesProduitViewVO)
	* @desc Retourne une liste de ListeAbonnesProduitViewVO
	*/
	public function getAbonnesByIdNomProduit($pIdNomProduit) {
		return ListeAbonnesProduitViewManager::selectByIdNomProduit($pIdNomProduit);
	}

	/**
	* @name getProduitsAbonne($pIdCompte)
	* @return array(ListeProduitsAbonneViewVO)
	* @desc Retourne une liste de ListeProduitsAbonneViewVO
	*/
	public function getProduitsAbonne($pIdCompte) {
		return ListeProduitsAbonneViewManager::select($pIdCompte);
	}

	/**
	* @name getProduitsNonAbonne($pIdCompte,$pIdFerme)
	* @return array(ListeProduitsNonAbonneViewVO)
	* @desc Retourne une liste de ListeProduitsNonAbonneViewVO
	*/
	public function getProduitsNonAbonne($pIdCompte,$pIdFerme) {
		return ListeProduitsNonAbonneViewManager::select($pIdCompte,$pIdFerme);
	}
	
	/**
	* @name produitExiste($pIdProduitAbonnement)
	* @param integer
	* @return bool
	* @desc Vérifie si le produit Abonnement existe
	*/
	public function produitExiste($pIdProduitAbonnement) {
		$lProduitAbonnement = $this->getProduit($pIdProduitAbonnement);
		if($lProduitAbonnement->getId() == $pIdProduitAbonnement) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	* @name lotExiste($pIdlotAbonnement)
	* @param integer
	* @return bool
	* @desc Vérifie si le produit Abonnement existe
	*/
	public function lotExiste($pIdlotAbonnement) {
		$lLotAbonnement = ListeLotAbonnementViewManager::select($pIdlotAbonnement);
		if($lLotAbonnement[0]->getId() == $pIdlotAbonnement) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	* @name lotAppartientProduit($pIdProduitAbonnement,$pIdlotAbonnement)
	* @param integer
	* @param integer
	* @return bool
	* @desc Vérifie si le produit Abonnement existe
	*/
	public function lotAppartientProduit($pIdProduitAbonnement,$pIdlotAbonnement) {
		$lProduitAbonnement = $this->getProduit($pIdProduitAbonnement);
		if($lProduitAbonnement->getId() == $pIdProduitAbonnement) {
			$lRetour = false;
			foreach($lProduitAbonnement->getLots() as $lLot) {
				$lRetour |= $lLot->getId() == $pIdlotAbonnement;
			}
			return $lRetour;
		} else {
			return false;
		}
	}
	
	/**
	* @name abonnementExiste($pIdCompteAbonnement)
	* @param integer
	* @return bool
	* @desc Vérifie si l'abonnement existe
	*/
	public function abonnementExiste($pIdCompteAbonnement) {
		$lAbonnement = $this->getAbonnement($pIdCompteAbonnement);
		if($lAbonnement->getCptAboId() == $pIdCompteAbonnement) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	* @name suspendreAbonnement($pCompteAbonnement)
	* @param CompteAbonnementVO
	* @return bool
	* @desc Suspen les abonnements d'un compte
	*/
	public function suspendreAbonnement($pCompteAbonnement) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->inputAbonnement($pCompteAbonnement)) {
			CompteAbonnementManager::suspendreCompte($pCompteAbonnement);			
			$lHistoriqueSuspensionAbonnement = new HistoriqueSuspensionAbonnementVO();
			$lHistoriqueSuspensionAbonnement->setDateDebutSuspension($pCompteAbonnement->getDateDebutSuspension());
			$lHistoriqueSuspensionAbonnement->setDateFinSuspension($pCompteAbonnement->getDateFinSuspension());
			$lHistoriqueSuspensionAbonnement->setIdProduitAbonnement(0);
			$lHistoriqueSuspensionAbonnement->setIdCompte($pCompteAbonnement->getIdCompte());
			$lHistoriqueSuspensionAbonnement->setDate(StringUtils::dateTimeAujourdhuiDb());
			$lHistoriqueSuspensionAbonnement->setIdConnexion($_SESSION[ID_CONNEXION]);
			HistoriqueSuspensionAbonnementManager::insert($lHistoriqueSuspensionAbonnement); 
			
			// Récupère l'ensemble des abonnements et met à jour les réservations en conséquence
			$lListeCompteAbonnement = CompteAbonnementManager::selectActifByIdCompte($pCompteAbonnement->getIdCompte());
			foreach($lListeCompteAbonnement as $lCompteAbonnement) {
				$this->updateAbonnement($lCompteAbonnement);
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name ajoutReservation($pIdCompte,$pIdMarche)
	* @param integer
	* @param integer
	* @return bool
	* @desc Positionne les réservations pour les abonnements du compte sur le maché
	*/
	public function ajoutReservation($pIdCompte,$pIdMarche) {
		$lProduits = $this->getProduitsAbonne($pIdCompte);
		$lMarcheService = new MarcheService();
		$lMarche = $lMarcheService->get($pIdMarche);
		
		$lReservationAbonnement = array("idCompte" => $pIdCompte, "produits" => array());
		foreach($lMarche->getProduits() as $lNouveauProduit) {
			// Ajout des réservations pour abonnement
			if($lNouveauProduit->getType() == 2) {
				
				$lIdNomProduit = $lNouveauProduit->getIdNom();
				foreach($lProduits as $lProduit) {
					if($lIdNomProduit == $lProduit->getNproId() ) {
						// Pas de suspension de l'abonnement et stock dispo pour positionner cette réservation (ou pas de limite de stock)
						if(	(!	(TestFonction::dateTimeEstPLusGrandeEgale($lMarche->getDateMarcheDebut(),$lProduit->getCptAboDateDebutSuspension(),'db')
								 && TestFonction::dateTimeEstPLusGrandeEgale($lProduit->getCptAboDateFinSuspension(),$lMarche->getDateMarcheDebut(),'db') )
							) && (
							 !	(TestFonction::dateTimeEstPLusGrandeEgale($lMarche->getDateMarcheFin(),$lProduit->getCptAboDateDebutSuspension(),'db')
								 && TestFonction::dateTimeEstPLusGrandeEgale($lProduit->getCptAboDateFinSuspension(),$lMarche->getDateMarcheFin(),'db') )
							) && (
									$lNouveauProduit->getStockReservation() >= $lProduit->getCptAboQuantite()
								||
									$lNouveauProduit->getStockInitial() == -1
							)
						 ) {
						 	foreach($lNouveauProduit->getLots() as $lLot) {
						 		$lDcomId = $lLot->getId();
						 	}
							$lReservationAbonnement["produits"][$lIdNomProduit] = array("id" => $lIdNomProduit, "idLot" => $lDcomId, "quantite" => $lProduit->getCptAboQuantite());
						}
					}
				}
			}
		}
		
		// Positionnement des réservations			
		$lReservationService = new ReservationService();
		$lReservationVO = new ReservationVO();
		$lReservationVO->getId()->setIdCompte( $pIdCompte );
		$lReservationVO->getId()->setIdCommande( $pIdMarche );
		
		$lEnregistrer = false;
		foreach($lReservationAbonnement["produits"] as $lDetail){
			$lDetailCommande = DetailCommandeManager::select($lDetail["idLot"]);				
			$lPrix = $lDetail["quantite"] / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();

			$lDetailReservation = new DetailReservationVO();					
			$lDetailReservation->setIdDetailCommande($lDetail["idLot"]);
			$lDetailReservation->setQuantite($lDetail["quantite"] * -1);
			$lDetailReservation->setMontant($lPrix * -1);
			
			$lReservationVO->addDetailReservation($lDetailReservation);
			$lEnregistrer = true;
		}
		if($lEnregistrer) {	
			$lReservationService->set($lReservationVO);
		}
	}
}
?>