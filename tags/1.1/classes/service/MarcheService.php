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
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php");

//include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
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
		$lMarche->setDateDebutReservation($pMarche->getDateDebutReservation());
		$lMarche->setDateFinReservation($pMarche->getDateFinReservation());
		$lMarche->setArchive($pMarche->getArchive());
		
		$lIdMarche = CommandeManager::insert($lMarche);
		// Le Numéro du marche
		$lMarche->setId($lIdMarche);
		$lMarche->setNumero($lIdMarche);
		CommandeManager::update($lMarche);

		// Le détail du marché
		if($lIdMarche != null) {
			$lReservationAbonnement = array();
			$lAbonnementService = new AbonnementService();
			
			$lStockService = new StockService();
			foreach($pMarche->getProduits() as $lNouveauProduit) {
				
				$lComptes = CompteNomProduitViewManager::select($lNouveauProduit->getIdNom());
				$lComptes = $lComptes[0];
				$lIdCompteFerme = $lComptes->getFerIdCompte();				
				
				// Insertion du produit
				$lProduit = new ProduitVO();
				$lProduit->setIdCommande($lIdMarche);
				$lIdNomProduit = $lNouveauProduit->getIdNom();
				$lProduit->setIdNomProduit($lIdNomProduit);
				$lProduit->setUniteMesure($lNouveauProduit->getUnite());
				
				// Gestion des limites de stock et max adhérent pour les abonnements
				if($lProduit->getType() == 2) {
					$lAbonnement = $lAbonnementService->getProduitByIdNom($lIdNomProduit);
					$lNouveauProduit->getQteMaxCommande($lAbonnement->$lDetailAbonnement->getMax());
					$lNouveauProduit->getQteRestante($lAbonnement->$lDetailAbonnement->getStockInitial());
				}
				
				if($lNouveauProduit->getQteMaxCommande() == "" || $lNouveauProduit->getQteMaxCommande() == -1) {
					$lProduit->setMaxProduitCommande(-1);
				} else {
					$lProduit->setMaxProduitCommande($lNouveauProduit->getQteMaxCommande());
				}
				$lProduit->setIdCompteFerme($lIdCompteFerme);
				
				if($lNouveauProduit->getQteRestante() == "" || $lNouveauProduit->getQteRestante() == -1) {
					$lProduit->setStockReservation(0);
					$lProduit->setStockInitial(-1);					
				} else {
					$lProduit->setStockReservation($lNouveauProduit->getQteRestante());
					$lProduit->setStockInitial($lNouveauProduit->getQteRestante());
				}
				$lProduit->setType($lNouveauProduit->getType());
				
				$lIdProduit = ProduitManager::insert($lProduit);

				//Insertion des lots
				$lCorrespondanceLotAbonnement = array();
				foreach($lNouveauProduit->getLots() as $lNouveauLot) {
					$lDetailCommande = new DetailCommandeVO();
					$lDetailCommande->setIdProduit($lIdProduit);
					$lDetailCommande->setTaille($lNouveauLot->getTaille());
					$lDetailCommande->setPrix($lNouveauLot->getPrix());
					$lDcomId = DetailCommandeManager::insert($lDetailCommande);
					
					$lCorrespondanceLotAbonnement[$lNouveauLot->getId()] = $lDcomId;					
				}
				
				//Insertion du stock -> Met à jour le stock reservation dans le produit
				$lStock = new StockVO();
				if($lNouveauProduit->getQteRestante() == "" || $lNouveauProduit->getQteRestante() == -1) {
					$lStock->setQuantite(0);			
				} else {
					$lStock->setQuantite($lNouveauProduit->getQteRestante());
				}
				$lStock->setType(0);
				$lStock->setIdCompte($lIdCompteFerme);
				$lStock->setIdDetailCommande($lDcomId);
				//$lStock->setIdOperation(0);
				$lStockService->set($lStock);
								
				// Ajout des réservations pour abonnement
				if($lProduit->getType() == 2) {
					$lAbonnes = $lAbonnementService->getAbonnesByIdNomProduit($lIdNomProduit);
					if(!is_null($lAbonnes[0]->getCptAboIdProduitAbonnement())) { // Si il y a des abonnés
						foreach($lAbonnes as $lAbonne) {
							// Pas de suspension de l'abonnement
							if(	(!	(TestFonction::dateTimeEstPLusGrandeEgale($pMarche->getDateMarcheDebut(),$lAbonne->getCptAboDateDebutSuspension(),'db')
									 && TestFonction::dateTimeEstPLusGrandeEgale($lAbonne->getCptAboDateFinSuspension(),$pMarche->getDateMarcheDebut(),'db') )
								) && (
								 !	(TestFonction::dateTimeEstPLusGrandeEgale($pMarche->getDateMarcheFin(),$lAbonne->getCptAboDateDebutSuspension(),'db')
									 && TestFonction::dateTimeEstPLusGrandeEgale($lAbonne->getCptAboDateFinSuspension(),$pMarche->getDateMarcheFin(),'db') )
								)
							 ) {
								$lIdCompte = $lAbonne->getCptAboIdCompte();
								if(!isset($lReservationAbonnement[$lIdCompte])) {
									$lReservationAbonnement[$lIdCompte] = array("idCompte" => $lIdCompte, "produits" => array());
								}
								$lReservationAbonnement[$lIdCompte]["produits"][$lIdNomProduit] = array("id" => $lIdNomProduit, "idLot" => $lCorrespondanceLotAbonnement[$lAbonne->getCptAboIdLotAbonnement()], "quantite" => $lAbonne->getCptAboQuantite());
							}
						}
					}
				}
			}
			
			// Positionnement des réservations			
			$lReservationService = new ReservationService();
			foreach($lReservationAbonnement as $lReservation) {
				$lReservationVO = new ReservationVO();
				$lReservationVO->getId()->setIdCompte( $lReservation["idCompte"] );
				$lReservationVO->getId()->setIdCommande( $lIdMarche );
				
				foreach($lReservation["produits"] as $lDetail){
					$lDetailCommande = DetailCommandeManager::select($lDetail["idLot"]);				
					$lPrix = $lDetail["quantite"] / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();
	
					$lDetailReservation = new DetailReservationVO();					
					$lDetailReservation->setIdDetailCommande($lDetail["idLot"]);
					$lDetailReservation->setQuantite($lDetail["quantite"] * -1);
					$lDetailReservation->setMontant($lPrix * -1);
					
					$lReservationVO->addDetailReservation($lDetailReservation);
				}
						
				$lReservationService->set($lReservationVO);
			}			
		}
		return $lIdMarche;
	}
	
	/**
	* @name ajoutProduit($pProduit)
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
		if($pProduit->getQteMaxCommande() == "" || $pProduit->getQteMaxCommande() == -1) {
			$lProduit->setMaxProduitCommande(-1);
		} else {
			$lProduit->setMaxProduitCommande($pProduit->getQteMaxCommande());
		}
		$lProduit->setIdCompteFerme($lIdCompteFerme);
		
		if($pProduit->getQteRestante() == "" || $pProduit->getQteRestante() == -1) {
			$lProduit->setStockReservation(0);
			$lProduit->setStockInitial(-1);					
		} else {
			$lProduit->setStockReservation($pProduit->getQteRestante());
			$lProduit->setStockInitial($pProduit->getQteRestante());
		}
		$lProduit->setType($pProduit->getType());
//		var_dump($lProduit);
		$lIdProduit = ProduitManager::insert($lProduit);

		//Insertion des lots
		$lCorrespondanceLotAbonnement = array();
		foreach($pProduit->getLots() as $lNouveauLot) {
			$lDetailCommande = new DetailCommandeVO();
			$lDetailCommande->setIdProduit($lIdProduit);
			$lDetailCommande->setTaille($lNouveauLot->getTaille());
			$lDetailCommande->setPrix($lNouveauLot->getPrix());
			$lDcomId = DetailCommandeManager::insert($lDetailCommande);
			$lCorrespondanceLotAbonnement[$lNouveauLot->getId()] = $lDcomId;	
		}
		
		$lStockService = new StockService();
		//Insertion du stock -> Met à jour le stock reservation dans le produit
		$lStock = new StockVO();
		if($pProduit->getQteRestante() == "" || $pProduit->getQteRestante() == -1) {
			$lStock->setQuantite(0);			
		} else {
			$lStock->setQuantite($pProduit->getQteRestante());
		}
		$lStock->setType(0);
		$lStock->setIdCompte($lIdCompteFerme);
		$lStock->setIdDetailCommande($lDcomId);
		//$lStock->setIdOperation(0);
		$lStockService->set($lStock);
		
		// Ajout des réservations pour abonnement
		if($lProduit->getType() == 2) {
			$lIdMarche =  $lProduit->getIdCommande();
			$lMarche = $this->getInfoMarche($lIdMarche);
		
			$lAbonnementService = new AbonnementService();
			$lReservationService = new ReservationService();
			$lIdNomProduit = $lProduit->getIdNomProduit();
			
			$lAbonnes = $lAbonnementService->getAbonnesByIdNomProduit($lIdNomProduit);
			if(!is_null($lAbonnes[0]->getCptAboIdProduitAbonnement())) { // Si il y a des abonnés
				foreach($lAbonnes as $lAbonne) {
					// Pas de suspension de l'abonnement
					if(	(!	(TestFonction::dateTimeEstPLusGrandeEgale($lMarche->getDateMarcheDebut(),$lAbonne->getCptAboDateDebutSuspension(),'db')
							 && TestFonction::dateTimeEstPLusGrandeEgale($lAbonne->getCptAboDateFinSuspension(),$lMarche->getDateMarcheDebut(),'db') )
						) && (
						 !	(TestFonction::dateTimeEstPLusGrandeEgale($lMarche->getDateMarcheFin(),$lAbonne->getCptAboDateDebutSuspension(),'db')
							 && TestFonction::dateTimeEstPLusGrandeEgale($lAbonne->getCptAboDateFinSuspension(),$lMarche->getDateMarcheFin(),'db') )
						)
					 ) {
						$lIdCompte = $lAbonne->getCptAboIdCompte();
												
						$lIdReservationVO = new IdReservationVO();
						$lIdReservationVO->setIdCompte( $lIdCompte );
						$lIdReservationVO->setIdCommande( $lIdMarche );
						
						$lReservationVO = new ReservationVO();
						$lReservationVO->setId($lIdReservationVO);
						if($lReservationService->enCours($lIdReservationVO)) {
							$lReservationVO = $lReservationService->get($lIdReservationVO);
						}
						
						$lDetailCommande = DetailCommandeManager::select($lCorrespondanceLotAbonnement[$lAbonne->getCptAboIdLotAbonnement()]);				
						$lPrix = $lAbonne->getCptAboQuantite() / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();
		
						$lDetailReservation = new DetailReservationVO();					
						$lDetailReservation->setIdDetailCommande($lCorrespondanceLotAbonnement[$lAbonne->getCptAboIdLotAbonnement()]);
						$lDetailReservation->setQuantite($lAbonne->getCptAboQuantite() * -1);
						$lDetailReservation->setMontant($lPrix * -1);
						
						$lReservationVO->addDetailReservation($lDetailReservation);
						
						
						
						$lReservationService->set($lReservationVO);
						
					}
				}	
			}
		}
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
		$lMarche->setDateDebutReservation($pMarche->getDateDebutReservation());
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
						$lProduit->setType($lProduitNv->getType());
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
					$lProduit->setType($lProduitActuel->getType());
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
					$lProduit->setType($lProduitNv->getType());
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
		$lMarche->setDateDebutReservation($pMarche->getDateDebutReservation());
		$lMarche->setDateFinReservation($pMarche->getDateFinReservation());
		
		CommandeManager::update($lMarche); // Maj des infos de la commande
		return $lIdMarche;
	}	
	
	/**
	* @name updateProduit($pProduit)
	* @param ProduitVO
	* @desc Met à jour le produit du marché
	*/
	public function updateProduit($pProduit, $pLotRemplacement = array()) {	
		$lProduitActuel = $this->selectProduit($pProduit->getId());
		
		//Les lots
		$lLotModif = array();
		$lLotSupp = array();
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
					
					array_push($lLotModif,$lDetailCommande);
				}																
			}
			// Supprimer Lot
			if($lMajLot) {
				$lDeleteLot = DetailCommandeManager::select($lLotActuel->getId());
				$lDeleteLot->setEtat(1);
				DetailCommandeManager::update($lDeleteLot);
				
				array_push($lLotSupp,$lLotActuel->getId());
			}
		}
		
		// Nouveau Lot
		$lLotAdd = array();
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
				
				$lLotAdd[$lLotNv->getId()] = $lDcomId; // Si supression d'un lot et positionnement de ce nouveau lot permet de récupérer l'ID
			}
		}
	
		$lStockService = new StockService();
		$lResaActuel = GestionCommandeReservationProducteurViewManager::getStockReservationProducteur($lProduitActuel->getIdCompteFerme(),$lProduitActuel->getId());
		$lStockActuel = $lStockService->get($lResaActuel[0]->getStoId());
	
		// Maj du stock
		$lStockActuel->setQuantite($pProduit->getQteRestante());
		$lStockActuel->setIdDetailCommande($lDcomId);
		$lStockService->updateStockProduit($lStockActuel);
		
		$lProduit = ProduitManager::select($lProduitActuel->getId());
		$lProduit->setUniteMesure($pProduit->getUnite());
		
		if($pProduit->getQteMaxCommande() == "" || $pProduit->getQteMaxCommande() == -1) {
			$lProduit->setMaxProduitCommande(-1);
		} else {
			$lProduit->setMaxProduitCommande($pProduit->getQteMaxCommande());
		}		
		$lProduit->setType($pProduit->getType());
		ProduitManager::update($lProduit);
		
		
		
		// Modif des réservations
		$lReservationService = new ReservationService();
		$lIdMarche = $lProduitActuel->getIdMarche();
		//var_dump($lLotModif);
		/*foreach($lLotModif as $lLot) { // Chaque lot modifié
			$lListeDetailReservation = $lReservationService->getReservationSurLot($lLot->getId());
			if(!is_null($lListeDetailReservation[0]->getDopeIdCompte())) { // Si il y a des réservations			
				foreach($lListeDetailReservation as $lDetailReservation) { // Chaque réservation de lot modifié
					$lIdReservationVO = new IdReservationVO();
					$lIdReservationVO->setIdCompte( $lDetailReservation->getDopeIdCompte() );
					$lIdReservationVO->setIdCommande( $lIdMarche );
					
					$lReservationVO = $lReservationService->get($lIdReservationVO);
					
					$lNvDetailReservation = array();
					foreach($lReservationVO->getDetailReservation() as $lDetailReservationActuelle) {						
						if($lDetailReservationActuelle->getIdDetailCommande() == $lLot->getId()) { // Maj de la reservation pour ce produit
							$lPrix = $lDetailReservation->getStoQuantite() / $lLot->getTaille() * $lLot->getPrix();
	
							$lDetailReservationVO = new DetailReservationVO();					
							$lDetailReservationVO->setIdDetailCommande($lLot->getId());
							$lDetailReservationVO->setQuantite($lDetailReservation->getStoQuantite());
							$lDetailReservationVO->setMontant($lPrix);
							
							array_push($lNvDetailReservation,$lDetailReservationVO);						
						} else { // Ajout des autres produits
							array_push($lNvDetailReservation,$lDetailReservationActuelle);
						}
					}
					$lReservationVO->setDetailReservation($lNvDetailReservation);
					$lReservationService->set($lReservationVO); // Maj de la reservation
				}	
			}		
		}*/
		
		foreach($lLotSupp as $lIdLot) { // Chaque lot supprimé => La réservation est positionnée sur un autre lot				
			if(isset($pLotRemplacement[$lIdLot]) ) {
				$lIdLotRemplacement = $pLotRemplacement[$lIdLot];
				if($lIdLotRemplacement < 0) {
					$lIdLotRemplacement = $lLotAdd[$lIdLotRemplacement]; 
				}
				$lListeDetailReservation = $lReservationService->getReservationSurLot($lIdLot);
				if(!is_null($lListeDetailReservation[0]->getDopeIdCompte())) { // Si il y a des réservations	
					foreach($lListeDetailReservation as $lDetailReservation) { // Chaque réservation de lot modifié
						$lIdReservationVO = new IdReservationVO();
						$lIdReservationVO->setIdCompte( $lDetailReservation->getDopeIdCompte() );
						$lIdReservationVO->setIdCommande( $lIdMarche );
						
						$lReservationVO = $lReservationService->get($lIdReservationVO);
						
						$lNvDetailReservation = array();
						foreach($lReservationVO->getDetailReservation() as $lDetailReservationActuelle) {						
							if($lDetailReservationActuelle->getIdDetailCommande() == $lIdLot) { // Maj de la reservation pour ce produit
	
								$lDetailCommande = DetailCommandeManager::select($lIdLotRemplacement);	
								$lPrix = $lDetailReservation->getStoQuantite() / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();
							
								$lDetailReservationVO = new DetailReservationVO();					
								$lDetailReservationVO->setIdDetailCommande($lIdLotRemplacement);
								$lDetailReservationVO->setQuantite($lDetailReservation->getStoQuantite());
								$lDetailReservationVO->setMontant($lPrix);
								
								array_push($lNvDetailReservation,$lDetailReservationVO);						
							} else { // Ajout des autres produits
								array_push($lNvDetailReservation,$lDetailReservationActuelle);
							}
						}
						$lReservationVO->setDetailReservation($lNvDetailReservation);
						
						$lReservationService->set($lReservationVO); // Maj de la reservation
					}	
				}		
			}
		}
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
		
		// Modif des réservations
		$lReservationService = new ReservationService();
		$lIdMarche = $lProduit->getIdCommande();
		//var_dump($lLotModif);
		foreach($lLots as $lLot) { // Chaque lot modifié
			$lListeDetailReservation = $lReservationService->getReservationSurLot($lLot->getId());
			if(!is_null($lListeDetailReservation[0]->getDopeIdCompte())) { // Si il y a des réservations			
				foreach($lListeDetailReservation as $lDetailReservation) { // Chaque réservation de lot modifié
					$lIdReservationVO = new IdReservationVO();
					$lIdReservationVO->setIdCompte( $lDetailReservation->getDopeIdCompte() );
					$lIdReservationVO->setIdCommande( $lIdMarche );
					
					$lReservationVO = $lReservationService->get($lIdReservationVO);
					
					$lNvDetailReservation = array();
					foreach($lReservationVO->getDetailReservation() as $lDetailReservationActuelle) {						
						if($lDetailReservationActuelle->getIdDetailCommande() != $lLot->getId()) { // Ne positionne que les autres produits
							array_push($lNvDetailReservation,$lDetailReservationActuelle);
						}
					}
					$lReservationVO->setDetailReservation($lNvDetailReservation);

					$lReservationService->set($lReservationVO); // Maj de la reservation
				}	
			}		
		}
	}	
		
	/**
	* @name getNonReserveeParCompte($pIdCompte)
	* @param integer
	* @return array(CommandeVO)
	* @desc Récupères les commandes en cours non réservées par l'adhérent
	*/
	public function getNonReserveeParCompte($pIdCompte) {		// TODO les tests	
		return CommandeManager::selectNonReserveeParCompte($pIdCompte);
	}
	
	/**
	* @name getNonAchatParCompte($pIdCompte)
	* @param integer
	* @return array(CommandeVO)
	* @desc Récupères les commandes en cours sans achat par l'adhérent
	*/
	public function getNonAchatParCompte($pIdCompte) {		// TODO les tests	
		return CommandeManager::selectNonAchatParCompte($pIdCompte);
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
		// Information du marche
		/*$lMarche->setId($lDetailMarche[0]->getComId());
		$lMarche->setNumero($lDetailMarche[0]->getComNumero());
		$lMarche->setNom($lDetailMarche[0]->getComNom());
		$lMarche->setDescription($lDetailMarche[0]->getComDescription());
		$lMarche->setDateMarcheDebut($lDetailMarche[0]->getComDateMarcheDebut());
		$lMarche->setDateMarcheFin($lDetailMarche[0]->getComDateMarcheFin());
		$lMarche->setDateDebutReservation($lDetailMarche[0]->getComDateDebutReservation());
		$lMarche->setDateFinReservation($lDetailMarche[0]->getComDateFinReservation());
		$lMarche->setArchive($lDetailMarche[0]->getComArchive());*/
		
		$lInfoMarche = $this->getInfoMarche($pId);
		
		$lMarche = new MarcheVO();				
		// Information du marche
		$lMarche->setId($lInfoMarche->getId());
		$lMarche->setNumero($lInfoMarche->getNumero());
		$lMarche->setNom($lInfoMarche->getNom());
		$lMarche->setDescription($lInfoMarche->getDescription());
		$lMarche->setDateMarcheDebut($lInfoMarche->getDateMarcheDebut());
		$lMarche->setDateMarcheFin($lInfoMarche->getDateMarcheFin());
		$lMarche->setDateDebutReservation($lInfoMarche->getDateDebutReservation());
		$lMarche->setDateFinReservation($lInfoMarche->getDateFinReservation());
		$lMarche->setArchive($lInfoMarche->getArchive());

		$lDetailMarche = DetailMarcheViewManager::select($pId);
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
					$lProduit->setType($lDetail->getProType());
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
		$lProduit->setIdMarche($lDetailMarche[0]->getComId());
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
		$lProduit->setType($lDetailMarche[0]->getProType());
		$lProduit->setFerId($lDetailMarche[0]->getFerId());
		$lProduit->setFerNom($lDetailMarche[0]->getFerNom());
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
	public function selectCaisseListeMarche() {		
		return CommandeManager::recherche(
			array(CommandeManager::CHAMP_COMMANDE_ARCHIVE),
			array('='),
			array(0),
			array(CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT),
			array('ASC'));
	}
}
?>