<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/07/2011
// Fichier : MarcheService.php
//
// Description : Classe MarcheService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_VO . "MarcheVO.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailMarcheViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "GestionCommandeReservationProducteurViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CompteNomProduitViewManager.php");

//include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
/**
 * @name MarcheService
 * @author Julien PIERRE
 * @since 13/07/2011
 * @desc Classe Service d'un Marche
 */
class MarcheService
{		
	
	/**
	* @name insert($pMarche)
	* @param MarcheVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CommandeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public function insert($pMarche) {
		// Entête du marché
		$lMarche = new CommandeVO();			
		$lMarche->setNom($pMarche->getNom());
		$lMarche->setDescription($pMarche->getDescription());
		$lMarche->setDateMarcheDebut($pMarche->getDateMarcheDebut());
		$lMarche->setDateMarcheFin($pMarche->getDateMarcheFin());
		$lMarche->setDateFinReservation($pMarche->getDateFinReservation());
		$lMarche->setArchive($pMarche->getArchive());
		
		$lIdMarche = CommandeManager::insert($lMarche);
		// Le Numéro du marche
		$lMarche->setId($lIdMarche);
		$lMarche->setNumero($lIdMarche);
		CommandeManager::update($lMarche);

		// Le détail du marché
		if($lIdMarche != null) {
			$lStockService = new StockService();
			foreach($pMarche->getProduits() as $lNouveauProduit) {
				//$lProducteur = ProducteurManager::select($lNouveauProduit->getIdProducteur());
				$lComptes = CompteNomProduitViewManager::select($lNouveauProduit->getIdNom());
				$lComptes = $lComptes[0];
				$lIdCompteFerme = $lComptes->getFerIdCompte();				
				
				// Insertion du produit
				$lProduit = new ProduitVO();
				$lProduit->setIdCommande($lIdMarche);
				$lProduit->setIdNomProduit($lNouveauProduit->getIdNom());
				$lProduit->setUniteMesure($lNouveauProduit->getUnite());
				if($lNouveauProduit->getQteMaxCommande() == "") {
					$lProduit->setMaxProduitCommande(-1);
				} else {
					$lProduit->setMaxProduitCommande($lNouveauProduit->getQteMaxCommande());
				}
				$lProduit->setIdCompteFerme($lIdCompteFerme);
				
				if($lNouveauProduit->getQteRestante() == "") {
					$lProduit->setStockReservation(0);
					$lProduit->setStockInitial(-1);					
				} else {
					$lProduit->setStockReservation($lNouveauProduit->getQteRestante());
					$lProduit->setStockInitial($lNouveauProduit->getQteRestante());
				}
				$lIdProduit = ProduitManager::insert($lProduit);

				//Insertion des lots
				foreach($lNouveauProduit->getLots() as $lNouveauLot) {
					$lDetailCommande = new DetailCommandeVO();
					$lDetailCommande->setIdProduit($lIdProduit);
					$lDetailCommande->setTaille($lNouveauLot->getTaille());
					$lDetailCommande->setPrix($lNouveauLot->getPrix());
					$lDcomId = DetailCommandeManager::insert($lDetailCommande);
				}
				
				//Insertion du stock -> Met à jour le stock reservation dans le produit
				$lStock = new StockVO();
				$lStock->setQuantite($lNouveauProduit->getQteRestante());
				$lStock->setType(0);
				$lStock->setIdCompte($lIdCompteFerme);
				$lStock->setIdDetailCommande($lDcomId);
				//$lStock->setIdOperation(0);
				$lStockService->set($lStock);
			}	
		}
		return $lIdMarche;
	}
	
	/**
	* @name update($pProduit)
	* @param ProduitMarcheVO
	* @desc Ajoute une produit au marche
	*/
	public function ajoutProduit($pProduit) {
	
		$lComptes = CompteNomProduitViewManager::select($pProduit->getIdNom());
		$lComptes = $lComptes[0];
		$lIdCompteFerme = $lComptes->getFerIdCompte();				
		
		// Insertion du produit
		$lProduit = new ProduitVO();
		$lProduit->setIdCommande($pProduit->getId());
		$lProduit->setIdNomProduit($pProduit->getIdNom());
		$lProduit->setUniteMesure($pProduit->getUnite());
		if($pProduit->getQteMaxCommande() == "") {
			$lProduit->setMaxProduitCommande(-1);
		} else {
			$lProduit->setMaxProduitCommande($pProduit->getQteMaxCommande());
		}
		$lProduit->setIdCompteFerme($lIdCompteFerme);
		
		if($pProduit->getQteRestante() == "") {
			$lProduit->setStockReservation(0);
			$lProduit->setStockInitial(-1);					
		} else {
			$lProduit->setStockReservation($pProduit->getQteRestante());
			$lProduit->setStockInitial($pProduit->getQteRestante());
		}
		$lIdProduit = ProduitManager::insert($lProduit);

		//Insertion des lots
		foreach($pProduit->getLots() as $lNouveauLot) {
			$lDetailCommande = new DetailCommandeVO();
			$lDetailCommande->setIdProduit($lIdProduit);
			$lDetailCommande->setTaille($lNouveauLot->getTaille());
			$lDetailCommande->setPrix($lNouveauLot->getPrix());
			$lDcomId = DetailCommandeManager::insert($lDetailCommande);
		}
		$lStockService = new StockService();
		
		//Insertion du stock -> Met à jour le stock reservation dans le produit
		$lStock = new StockVO();
		$lStock->setQuantite($pProduit->getQteRestante());
		$lStock->setType(0);
		$lStock->setIdCompte($lIdCompteFerme);
		$lStock->setIdDetailCommande($lDcomId);
		//$lStock->setIdOperation(0);
		$lStockService->set($lStock);
	}

	/**
	* @name update($pMarche)
	* @param MarcheVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CommandeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public function update($pMarche) {
		
		$lIdMarche = $pMarche->getId();
		
		$lMarche = new CommandeVO();
		$lMarche->setId($lIdMarche);
		$lMarche->setNumero($pMarche->getNumero());
		$lMarche->setNom($pMarche->getNom());
		$lMarche->setDescription($pMarche->getDescription());
		$lMarche->setDateMarcheDebut($pMarche->getDateMarcheDebut());
		$lMarche->setDateMarcheFin($pMarche->getDateMarcheFin());
		$lMarche->setDateFinReservation($pMarche->getDateFinReservation());
		$lMarche->setArchive($pMarche->getArchive());
		
		CommandeManager::update($lMarche); // Maj des infos de la commande

		$lMarcheActuel = $this->get($lIdMarche);
		if($lIdMarche != null && $lMarcheActuel->getId() != null) {
			$lStockService = new StockService();
			foreach($lMarcheActuel->getProduits() as $lProduitActuel) {	
				$lMaj = true;							
				// Produits Modifiés
				foreach($pMarche->getProduits() as $lProduitNv) {
					if($lProduitActuel->getId() == $lProduitNv->getId()) {
						$lMaj = false;												
						//Les lots
						foreach($lProduitActuel->getLots() as $lLotActuel) {
							$lMajLot = true;
							foreach($lProduitNv->getLots() as $lLotNv) {								
								// Maj Lot
								if($lLotActuel->getId() == $lLotNv->getId()) {
									$lDcomId = $lLotActuel->getId();
									
									$lMajLot = false;
									$lDetailCommande = new DetailCommandeVO();
									$lDetailCommande->setId($lLotActuel->getId());
									$lDetailCommande->setIdProduit($lProduitActuel->getId());
									$lDetailCommande->setTaille($lLotNv->getTaille());
									$lDetailCommande->setPrix($lLotNv->getPrix());
									DetailCommandeManager::update($lDetailCommande);
								}																
							}
							// Supprimer Lot
							if($lMajLot) {
								$lDeleteLot = DetailCommandeManager::select($lLotActuel->getId());
								$lDeleteLot->setEtat(1);
								DetailCommandeManager::update($lDeleteLot);
							}
						}
						
						// Nouveau Lot
						foreach($lProduitNv->getLots() as $lLotNv) {
							$lAjout = true;
							foreach($lProduitActuel->getLots() as $lLotActuel) {
								if($lLotActuel->getId() == $lLotNv->getId()) {
									$lAjout = false;
								}
							}
							if($lAjout) {
								$lDetailCommande = new DetailCommandeVO();
								$lDetailCommande->setIdProduit($lProduitActuel->getId());
								$lDetailCommande->setTaille($lLotNv->getTaille());
								$lDetailCommande->setPrix($lLotNv->getPrix());
								$lDcomId = DetailCommandeManager::insert($lDetailCommande);
							}
						}

						$lResaActuel = GestionCommandeReservationProducteurViewManager::getStockReservationProducteur($lProduitActuel->getIdCompteProducteur(),$lProduitActuel->getId());
						$lStockActuel = $lStockService->get($lResaActuel[0]->getStoId());

						// Maj du stock
						$lStockActuel->setQuantite($lProduitNv->getQteRestante());
						$lStockActuel->setIdCompte($lProduitNv->getIdProducteur());
						$lStockActuel->setIdDetailCommande($lDcomId);
						$lStockService->set($lStockActuel);
						
						$lProduit = ProduitManager::select($lProduitActuel->getId());
						$lProduit->setIdCommande($lIdMarche);
						$lProduit->setIdNomProduit($lProduitNv->getIdNom());
						$lProduit->setUniteMesure($lProduitNv->getUnite());
						$lProduit->setMaxProduitCommande($lProduitNv->getQteMaxCommande());
						$lProduit->setIdCompteProducteur($lProduitNv->getIdProducteur()); // C'est bien le compte il faut changer le nom du champ
						ProduitManager::update($lProduit);
					}
				}	
				// Produits supprimés
				if($lMaj) {						
					// Suppression des lots
					$lLots = DetailCommandeManager::selectByIdProduit($lProduitActuel->getId());
					foreach($lLots as $lLot) {
						$lLot->setEtat(1);
						DetailCommandeManager::update($lLot);
					}
					
					$lProduit = new ProduitVO();
					$lProduit->setId($lProduitActuel->getId());
					$lProduit->setIdCommande($lIdMarche);
					$lProduit->setIdNomProduit($lProduitActuel->getIdNom());
					$lProduit->setUniteMesure($lProduitActuel->getUnite());
					$lProduit->setMaxProduitCommande($lProduitActuel->getQteMaxCommande());
					$lProduit->setIdCompteProducteur($lProduitActuel->getIdCompteProducteur());
					$lProduit->setEtat(1);
					ProduitManager::update($lProduit);						
				}			
			}
			
			// Les nouveaux produits
			foreach($pMarche->getProduits() as $lProduitNv) {
				$lAjout = true;
				foreach($lMarcheActuel->getProduits() as $lProduitActuel) {
					if($lProduitActuel->getId() == $lProduitNv->getId()) { 
						$lAjout = false;
					}
				}
				if($lAjout) {
					// Insertion du produit
					$lProduit = new ProduitVO();
					$lProduit->setIdCommande($lIdMarche);
					$lProduit->setIdNomProduit($lProduitNv->getIdNom());
					$lProduit->setUniteMesure($lProduitNv->getUnite());
					$lProduit->setMaxProduitCommande($lProduitNv->getQteMaxCommande());
					$lProduit->setIdCompteProducteur($lProduitNv->getIdProducteur()); // C'est bien le compte il faut changer le nom du champ
					$lProduit->setStockReservation($lProduitNv->getQteRestante());
					$lProduit->setStockInitial($lProduitNv->getQteRestante());
					$lIdProduit = ProduitManager::insert($lProduit);
	
					//Insertion des lots
					foreach($lProduitNv->getLots() as $lNouveauLot) {
						$lDetailCommande = new DetailCommandeVO();
						$lDetailCommande->setIdProduit($lIdProduit);
						$lDetailCommande->setTaille($lNouveauLot->getTaille());
						$lDetailCommande->setPrix($lNouveauLot->getPrix());
						$lDcomId = DetailCommandeManager::insert($lDetailCommande);
					}
					
					//Insertion du stock -> Met à jour le stock reservation dans le produit
					$lStock = new StockVO();
					$lStock->setQuantite($lProduitNv->getQteRestante());
					$lStock->setType(0);
					$lStock->setIdCompte($lProduitNv->getIdProducteur());// C'est bien le compte il faut changer le nom du champ
					$lStock->setIdDetailCommande($lDcomId);
					$lStockService = new StockService();
					$lStockService->set($lStock);								
				}
			}
		}
		return $lIdMarche;
	}	
	
	/**
	* @name updateInformation($pMarche)
	* @param MarcheVO
	* @return integer
	* @desc Met à jour l'entête du marché
	*/
	public function updateInformation($pMarche) {	
		$lIdMarche = $pMarche->getId();
		
		$lMarche = $this->getInfoMarche($lIdMarche);
		$lMarche->setNom($pMarche->getNom());
		$lMarche->setDescription($pMarche->getDescription());
		$lMarche->setDateMarcheDebut($pMarche->getDateMarcheDebut());
		$lMarche->setDateMarcheFin($pMarche->getDateMarcheFin());
		$lMarche->setDateFinReservation($pMarche->getDateFinReservation());
		
		CommandeManager::update($lMarche); // Maj des infos de la commande
		return $lIdMarche;
	}	
	
	/**
	* @name updateProduit($pProduit)
	* @param ProduitVO
	* @desc Met à jour le produit du marché
	*/
	public function updateProduit($pProduit) {	
		$lProduitActuel = $this->selectProduit($pProduit->getId());
		
		//Les lots
		foreach($lProduitActuel->getLots() as $lLotActuel) {
			$lMajLot = true;
			foreach($pProduit->getLots() as $lLotNv) {								
				// Maj Lot
				if($lLotActuel->getId() == $lLotNv->getId()) {
					$lDcomId = $lLotActuel->getId();
					
					$lMajLot = false;
					$lDetailCommande = new DetailCommandeVO();
					$lDetailCommande->setId($lLotActuel->getId());
					$lDetailCommande->setIdProduit($lProduitActuel->getId());
					$lDetailCommande->setTaille($lLotNv->getTaille());
					$lDetailCommande->setPrix($lLotNv->getPrix());
					DetailCommandeManager::update($lDetailCommande);
				}																
			}
			// Supprimer Lot
			if($lMajLot) {
				$lDeleteLot = DetailCommandeManager::select($lLotActuel->getId());
				$lDeleteLot->setEtat(1);
				DetailCommandeManager::update($lDeleteLot);
			}
		}
		
		// Nouveau Lot
		foreach($pProduit->getLots() as $lLotNv) {
			$lAjout = true;
			foreach($lProduitActuel->getLots() as $lLotActuel) {
				if($lLotActuel->getId() == $lLotNv->getId()) {
					$lAjout = false;
				}
			}
			if($lAjout) {
				$lDetailCommande = new DetailCommandeVO();
				$lDetailCommande->setIdProduit($lProduitActuel->getId());
				$lDetailCommande->setTaille($lLotNv->getTaille());
				$lDetailCommande->setPrix($lLotNv->getPrix());
				$lDcomId = DetailCommandeManager::insert($lDetailCommande);
			}
		}
	
		$lStockService = new StockService();
		$lResaActuel = GestionCommandeReservationProducteurViewManager::getStockReservationProducteur($lProduitActuel->getIdCompteFerme(),$lProduitActuel->getId());
		$lStockActuel = $lStockService->get($lResaActuel[0]->getStoId());
	
		// Maj du stock
		$lStockActuel->setQuantite($pProduit->getQteRestante());
		$lStockActuel->setIdDetailCommande($lDcomId);
		$lStockService->set($lStockActuel);
		
		$lProduit = ProduitManager::select($lProduitActuel->getId());
		//$lProduit->setIdCommande($lIdMarche);
		//$lProduitActuel->setIdNomProduit($pProduit->getIdNom());
		$lProduit->setUniteMesure($pProduit->getUnite());
		$lProduit->setMaxProduitCommande($pProduit->getQteMaxCommande());
		//$lProduitActuel->setStockInitial($pProduit->getQteRestante());
		//$lProduit->setIdCompteFerme($pProduit->getIdCompteFerme()); // C'est bien le compte il faut changer le nom du champ
		ProduitManager::update($lProduit);
	}
	
	/**
	* @name supprimerProduit($pId)
	* @param integer
	* @desc Supprime un produit du marché
	*/
	public function supprimerProduit($pId) {	
		$lProduit = ProduitManager::select($pId);
		// Suppression des lots
		$lLots = DetailCommandeManager::selectByIdProduit($pId);
		foreach($lLots as $lLot) {
			$lLot->setEtat(1);
			DetailCommandeManager::update($lLot);
		}
		
		$lProduit->setEtat(1);
		ProduitManager::update($lProduit);
	}	
		
	/**
	* @name getNonReserveeParCompte($pIdCompte)
	* @param integer
	* @return array(CommandeVO)
	* @desc Récupères les commandes en cours non réservées par l'adhérent
	*/
	public static function getNonReserveeParCompte($pIdCompte) {		// TODO les tests	
		return CommandeManager::selectNonReserveeParCompte($pIdCompte);
	}
	
	/**
	* @name get($pId)
	* @param integer
	* @return array(CommandeVO) ou CommandeVO
	* @desc Retourne une liste de Commande
	*/
	public function get($pId = null) {
		if($pId != null) {
			if(is_int((int)$pId)) {
				return $this->select($pId);
			} else {
				return false;
			}
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return MarcheVO
	* @desc Retourne une Commande
	*/
	public function select($pId) {		
		$lDetailMarche = DetailMarcheViewManager::select($pId);
		
		$lMarche = new MarcheVO();
		
		// Information du marche
		$lMarche->setId($lDetailMarche[0]->getComId());
		$lMarche->setNumero($lDetailMarche[0]->getComNumero());
		$lMarche->setNom($lDetailMarche[0]->getComNom());
		$lMarche->setDescription($lDetailMarche[0]->getComDescription());
		$lMarche->setDateMarcheDebut($lDetailMarche[0]->getComDateMarcheDebut());
		$lMarche->setDateMarcheFin($lDetailMarche[0]->getComDateMarcheFin());
		$lMarche->setDateFinReservation($lDetailMarche[0]->getComDateFinReservation());
		$lMarche->setArchive($lDetailMarche[0]->getComArchive());

		foreach($lDetailMarche as $lDetail) {
			if($lDetail->getProId() != '') {
				// Le Produit
				$lProduits = $lMarche->getProduits();
				if(!isset($lProduits[$lDetail->getProId()])) {				
					$lProduit = new ProduitMarcheVO();
					$lProduit->setId($lDetail->getProId());
					$lProduit->setIdCompteFerme($lDetail->getProIdCompteFerme());
					$lProduit->setIdNom($lDetail->getNproId());
					$lProduit->setNom($lDetail->getNproNom());
					$lProduit->setDescription($lDetail->getNproDescription());
					$lProduit->setIdCategorie($lDetail->getNproIdCategorie());
					$lProduit->setCproNom($lDetail->getCproNom());
					$lProduit->setUnite($lDetail->getProUniteMesure());
					$lProduit->setQteMaxCommande($lDetail->getProMaxProduitCommande());
					$lProduit->setStockReservation($lDetail->getProStockReservation());
					$lProduit->setStockInitial($lDetail->getProStockInitial());
					$lProduit->setFerId($lDetail->getFerId());
					$lProduit->setFerNom($lDetail->getFerNom());
					$lProduits[$lDetail->getProId()] = $lProduit;
				}
				
				// Le Lot
				$lLot = new DetailMarcheVO();
				$lLot->setId($lDetail->getDcomId());
				$lLot->setTaille($lDetail->getDcomTaille());
				$lLot->setPrix($lDetail->getDcomPrix());
				$lLots = $lProduits[$lDetail->getProId()]->getLots();
				$lLots[$lDetail->getDcomId()] = $lLot;
				$lProduits[$lDetail->getProId()]->setLots($lLots);
				
				$lMarche->setProduits($lProduits);
			}
		}
				
		return $lMarche;
	}
	

	/**
	* @name selectProduit($pId)
	* @param integer
	* @return ProduitMarcheVO
	* @desc Retourne un Produit
	*/
	public function selectProduit($pId) {		
		$lDetailMarche = DetailMarcheViewManager::selectByIdProduit($pId);				
		
		$lProduit = new ProduitMarcheVO();
		// Le Produit
		$lProduit->setId($lDetailMarche[0]->getProId());
		$lProduit->setIdCompteFerme($lDetailMarche[0]->getProIdCompteFerme());
		$lProduit->setIdNom($lDetailMarche[0]->getNproId());
		$lProduit->setNom($lDetailMarche[0]->getNproNom());
		$lProduit->setDescription($lDetailMarche[0]->getNproDescription());
		$lProduit->setIdCategorie($lDetailMarche[0]->getNproIdCategorie());
		$lProduit->setCproNom($lDetailMarche[0]->getCproNom());
		$lProduit->setUnite($lDetailMarche[0]->getProUniteMesure());
		$lProduit->setQteMaxCommande($lDetailMarche[0]->getProMaxProduitCommande());
		$lProduit->setStockReservation($lDetailMarche[0]->getProStockReservation());
		$lProduit->setStockInitial($lDetailMarche[0]->getProStockInitial());
		$lProduit->setFerId($lDetailMarche[0]->getFerId());
		$lProduit->setFerNom($lDetailMarche[0]->getFerNom());
			
		foreach($lDetailMarche as $lDetail) {	
			// Le Lot
			$lLot = new DetailMarcheVO();
			$lLot->setId($lDetail->getDcomId());
			$lLot->setTaille($lDetail->getDcomTaille());
			$lLot->setPrix($lDetail->getDcomPrix());
			$lProduit->addLots($lLot);
		}		
		return $lProduit;
	}
		
	/**
	* @name selectAll()
	* @return array(CommandeVO)
	* @desc Retourne une liste de Commande
	*/
	public function selectAll() {
		return CommandeManager::selectAll();
	}
	
	/**
	* @name setPause($IdMarche)
	* @param integer
	* @desc Met en pause un marche
	*/
	public function setPause($IdMarche) {
		$lMarche = CommandeManager::select($IdMarche);
		$lMarche->setArchive(1);
		return CommandeManager::update($lMarche);
	}
	
	/**
	* @name setPlay($IdMarche)
	* @param integer
	* @desc Met en play un marche
	*/
	public function setPlay($IdMarche) {
		$lMarche = CommandeManager::select($IdMarche);
		$lMarche->setArchive(0);
		return CommandeManager::update($lMarche);
	}
	
	/**
	* @name setCloturer($IdMarche)
	* @param integer
	* @desc Cloture le marche
	*/
	public function setCloturer($IdMarche) {
		$lMarche = CommandeManager::select($IdMarche);
		$lMarche->setArchive(2);

		$lOperationService = new OperationService();
		// On Passe les opérations réservées non récupérées en statut cloturé
		$lListeOperation = $lOperationService->getReservationCommande($IdMarche);
		foreach ( $lListeOperation as $lOperation ) {
			if($lOperation->getId() != null) {
				$lOperation->setTypePaiement(15);
				$lOperationService->set( $lOperation );
			}
		}

		return CommandeManager::update($lMarche);
	}
	
	/**
	* @name getInfoMarche($IdMarche)
	* @param integer
	* @desc Retourne les infos d'entête du marche
	*/
	public function getInfoMarche($IdMarche) {
		return CommandeManager::select($IdMarche);
	}
	
	/**
	* @name selectCaisseListeMarche()
	* @return array(OperationVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId et les renvoie sous forme d'une collection de OperationVO
	*/
	public static function selectCaisseListeMarche() {		
		return CommandeManager::recherche(
			array(CommandeManager::CHAMP_COMMANDE_ARCHIVE),
			array('='),
			array(0),
			array(CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT),
			array('ASC'));
	}
}
?>