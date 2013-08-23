<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/06/2011
// Fichier : CaisseMarcheCommandeControleur.php
//
// Description : Classe CaisseMarcheCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/ListeAdherentCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/MarcheValid.php");

include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/InfoAchatCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");
include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");

//include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );

/**
 * @name CaisseMarcheCommandeControleur
 * @author Julien PIERRE
 * @since 20/06/2011
 * @desc Classe controleur d'une CaisseMarcheCommande
 */
class CaisseMarcheCommandeControleur
{
	
	
	/**
	* @name getMarcheListeReservation($pIdCommande)
	* @return ListeAdherentCommandeResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur ce Marche.
	*/
	public function getMarcheListeReservation($pParam) {		
		$lVr = MarcheValid::validGetMarcheListeReservation($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeAdherentCommandeResponse();
			$lListe = ListeAdherentViewManager::selectAll();
			$lResponse->setListeAdherentCommande($lListe);
			
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->getInfoMarche($pParam['id_commande']);
			$lResponse->setNumeroMarche($lMarche->getNumero());
			
			return $lResponse;		
		}				
		return $lVr;
	}
	
	/**
	 * @name getListeAdherent()
	 * @return ListeAdherentCommandeResponse
	 * @desc Retourne la liste des adhérents.
	 */
	public function getListeAdherent() {
		$lResponse = new ListeAdherentCommandeResponse();
		$lResponse->setListeAdherentCommande(ListeAdherentViewManager::selectAll());			
		return $lResponse;
	}
	
	/**
	* @name getInfoAchatMarche($pParam)
	* @return InfoAchatCommandeResponse
	* @desc Retourne les infos de réservation d'un adhérent
	*/
	public function getInfoAchatMarche($pParam) {
		$lVr = MarcheValid::validGetInfoAchatMarche($pParam);
		if($lVr->getValid()) {		
			$lResponse = new InfoAchatCommandeResponse();
			if($pParam["id_adherent"] != 0) { // Si ce n'est pas le compte invité
				$lAdherent = AdherentViewManager::select($pParam["id_adherent"]);
				$lResponse->setAdherent($lAdherent);
			}
						
			if($pParam["id_commande"] != -1) { // Si ce n'est pas la caisse permanente
				$lMarcheService = new MarcheService();
				$lResponse->setMarche($lMarcheService->get($pParam["id_commande"])); // Les informations du marché 
			
				if($pParam["id_adherent"] != 0) { // Si ce n'est pas le compte invité
					
					$lReservationService = new ReservationService();
					$lIdReservation = new IdReservationVO();
					$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
					$lIdReservation->setIdCommande($pParam["id_commande"]);		
					$lResponse->setReservation($lReservationService->get($lIdReservation)->getDetailReservation());	// La réservation	
					
					$lAchatService = new AchatService();
					$lIdAchat = new IdAchatVO();
					$lIdAchat->setIdCompte($lAdherent->getAdhIdCompte());
					$lIdAchat->setIdCommande($pParam["id_commande"]);
					$lResponse->setAchats($lAchatService->getAll($lIdAchat)); // L'achat	
					
					// Le rechargement
					$lOperationService = new OperationService();
					$lResponse->setRechargement($lOperationService->getRechargementMarche($lAdherent->getAdhIdCompte(), $pParam["id_commande"]));					
				}
			}
			
			$lStockService = new StockService();	
			$lBanqueService = new BanqueService();
					
			$lResponse->setStock($lStockService->getProduitsDisponible());	// Stock de produit disponible			
			$lResponse->setTypePaiement(TypePaiementVisibleViewManager::selectAll()); // Type de paiment
			$lResponse->setBanques($lBanqueService->getAllActif()); // Liste des banques
			
			return $lResponse;
		}				
		return $lVr;
	}
	
	/**
	* @name enregistrerAchat($pParam)
	* @return VR
	* @desc Enregistre la commande d'un adhérent
	*/
	public function enregistrerAchat($pParam) {
		$lVr = MarcheValid::validAchat($pParam);
		if($lVr->getValid()) {
			$lVr = MarcheValid::validAjout($pParam);
			if($lVr->getValid()) {
				if($pParam['id'] != -1) { // Achat dans le marche
					CaisseMarcheCommandeControleur::enregistrerAchatMarche($pParam);
				} else {
					CaisseMarcheCommandeControleur::enregistrerAchatHorsMarche($pParam);
				}
			} else {
				$lVr = MarcheValid::validUpdateMarche($pParam);
				if($lVr->getValid()) {
					CaisseMarcheCommandeControleur::modifierAchat($pParam);
				} else if($pParam["idCompte"] != -3 && $pParam['id'] != -1) {// Sauf pour le compte invité et pas sur un achat hors marché
					// Permet de traiter le bug du double appel en ajout d'achat
					// Si l'achat a déjà été effectué on le met à jour même si c'est une requête d'ajout
					$lAchatService = new AchatService();
					$lIdAchat = new IdAchatVO();
					$lIdAchat->setIdCompte($pParam["idCompte"]);
					$lIdAchat->setIdCommande($pParam["id"]);
					$lAchats = $lAchatService->getAll($lIdAchat); // L'achat
					if(!empty($lAchats)) {  // Si il y a des achats
						$pParam["idAchat"] = array();
						foreach($lAchats as $lAchat) {
							array_push($pParam["idAchat"],$lAchat->getId()->getIdAchat());
						}
						$lVr2 = MarcheValid::validUpdateMarche($pParam);
						if($lVr2->getValid()) {
							CaisseMarcheCommandeControleur::modifierAchat($pParam);
						} 
						return $lVr2;
					}
				}
			}
		}				
		return $lVr;
	}
	
	private function enregistrerAchatMarche($pParam) {
		$lIdMarche = $pParam['id'];
		$lIdReservation = new IdReservationVO();
		$lIdReservation->setIdCompte($pParam['idCompte']);
		$lIdReservation->setIdCommande($lIdMarche);
			
		$lMarcheService = new MarcheService();
		$lMarche = $lMarcheService->get($lIdMarche);
		$lProduitsMarche = $lMarche->getProduits();
			
		$lReservationService = new ReservationService();
		$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
		
		$lAchat = new AchatVO();
		$lAchat->getId()->setIdCompte($pParam["idCompte"]);
		$lAchat->getId()->setIdCommande($lIdMarche);
		if($lOperations[0]->getTypePaiement() == 0) {
			$lAchat->getId()->setIdReservation($lOperations[0]->getId());
		}
		
		$lTableauIdDetailCommande = array();
		foreach($pParam["produits"] as $lDetail) {
			array_push($lTableauIdDetailCommande,$lDetail["dcomId"]);
		}
		
		$lLotProduits = DetailCommandeManager::selectByArray($lTableauIdDetailCommande);
		
		// TODO Si lot n'existe pas vérifier quand même si il n'y a pas déjà le produit
		// Le bug se présente si il n'y a pas de réponse du server que la caisse fait un doublon sur enregistrer.
		 
		foreach($pParam["produits"] as $lDetail){
			$lDetailAchat = new DetailReservationVO();
			$lDetailAchat->setQuantite($lDetail["quantite"]);
			$lDetailAchat->setMontant($lDetail["prix"]);

			$lDetailAchat->setIdNomProduit($lDetail['nproId']);
			
			if(isset($lLotProduits[$lDetail["nproId"]])) { 
				$lDetailAchat->setIdDetailCommande($lDetail["dcomId"]);
				$lDetailAchat->setUnite($lLotProduits[$lDetail["nproId"]]->getUnite());
			} else { // Le produit n'est pas dans le marche il faut l'ajouter
				$lProduit = new ProduitCommandeVO();
				$lProduit->setId($lIdMarche);
				$lProduit->setIdNom($lDetail['nproId']);
				
				// On ajout un produit classique uniquement
				$lProduit->setQteMaxCommande(-1);
				$lProduit->setQteRestante(-1);
				$lProduit->setType(0);
				
				// Récupère les modèles de lot
				$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lDetail['nproId']);
				//$lIdLotPremier = $lModelesLot[0]->getMLotId();
				$lLotUnique = count($lModelesLot) == 1;
				$lLotAchat = array();
				foreach($lModelesLot as $lLot) {
					$lDetailCommande = new DetailCommandeVO();
					$lDetailCommande->setTaille($lLot->getMLotQuantite());
					$lDetailCommande->setPrix($lLot->getMLotPrix());
										
					if($lDetail['lotId'] == $lLot->getMLotId()) {
						$lUnite = $lModelesLot[$lLot->getMLotId()]->getMLotUnite();
						$lProduit->setUnite($lUnite);
						$lDetailAchat->setUnite($lUnite);
						array_push($lLotAchat,$lDetailCommande);
						if($lLotUnique) { // Si un seul lot ajout dans le produit
							$lProduit->addLots($lDetailCommande);
						}
					} else {
						$lProduit->addLots($lDetailCommande);
					}					
				}
					
				// Ajout du produit dans le marché sauf le lot d'achat
				$lIdProduit = $lMarcheService->ajoutProduit($lProduit);
				
				if($lLotUnique) {// Si un seul lot déjà ajouté avec le produit donc c'est le premier lot
					$lDetailCommande = DetailCommandeManager::selectByIdProduit($lIdProduit);
					$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
				} else {
					//Ajout du lot d'achat
					$lProduit->setId($lIdProduit);
					$lProduit->setLots($lLotAchat);				
					$lDcomId = $lMarcheService->ajoutLotUnitaireProduit($lProduit);
					
					$lDetailAchat->setIdDetailCommande($lDcomId);
				}
			}
			
			$lAchat->addDetailAchat($lDetailAchat);
		}
		
		$lIdProduits = array();
		foreach($pParam["produitsSolidaire"] as $lDetail) {
			array_push($lIdProduits,$lDetail["nproId"]);
		}
		
		$lLotProduits = DetailCommandeManager::selectByArrayIdProduit($lIdProduits, $lIdMarche);
	
		foreach($pParam["produitsSolidaire"] as $lDetail){
			$lDetailAchat = new DetailReservationVO();
			$lDetailAchat->setQuantite($lDetail["quantite"]);
			$lDetailAchat->setMontant($lDetail["prix"]);
			
			$lDetailAchat->setIdNomProduit($lDetail['nproId']);
			
			if(isset($lLotProduits[$lDetail["nproId"]])) { 				
				$lDetailAchat->setIdDetailCommande($lDetail["dcomId"]);
				$lDetailAchat->setUnite($lLotProduits[$lDetail["nproId"]]->getUnite());				
			} else { // Le produit n'est pas dans le marche il faut l'ajouter
				$lProduit = new ProduitCommandeVO();
				$lProduit->setId($lIdMarche);
				$lProduit->setIdNom($lDetail['nproId']);
				
				// On ajout un produit classique uniquement
				$lProduit->setQteMaxCommande(-1);
				$lProduit->setQteRestante(-1);
				$lProduit->setType(0);
				
				// Récupère les modèles de lot
				$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lDetail['nproId']);
				$lLotUnique = count($lModelesLot) == 1;
				$lLotAchat = array();
				foreach($lModelesLot as $lLot) {
					$lDetailCommande = new DetailCommandeVO();
					$lDetailCommande->setTaille($lLot->getMLotQuantite());
					$lDetailCommande->setPrix($lLot->getMLotPrix());
					
					if($lDetail['lotId'] == $lLot->getMLotId()) {
						$lUnite = $lModelesLot[$lLot->getMLotId()]->getMLotUnite();
						$lProduit->setUnite($lUnite);
						$lDetailAchat->setUnite($lUnite);
						array_push($lLotAchat,$lDetailCommande);
						if($lLotUnique) { // Si un seul lot ajout dans le produit
							$lProduit->addLots($lDetailCommande);
						}
					} else {
						$lProduit->addLots($lDetailCommande);
					}
				}
					
				// Ajout du produit dans le marché sauf le lot d'achat
				$lIdProduit = $lMarcheService->ajoutProduit($lProduit);

				if($lLotUnique) {// Si un seul lot déjà ajouté avec le produit donc c'est le premier lot
					$lDetailCommande = DetailCommandeManager::selectByIdProduit($lIdProduit);
					$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
				} else {
					//Ajout du lot d'achat
					$lProduit->setId($lIdProduit);
					$lProduit->setLots($lLotAchat);
					$lDcomId = $lMarcheService->ajoutLotUnitaireProduit($lProduit);
					
					$lDetailAchat->setIdDetailCommande($lDcomId);
				}
			}
			$lAchat->addDetailAchatSolidaire($lDetailAchat);
		}
		$lAchatService = new AchatService();
		$lIdOperation = $lAchatService->set($lAchat); // Achat des produits
		
		// Si il y a aussi un rechargement du compte
		$lRechargement = $pParam['rechargement'];
		if(!empty($lRechargement['montant']) && $lRechargement['montant'] != 0) {
			
			$lOperation = new OperationVO();
			$lOperation->setIdCompte($pParam['idCompte']);
			$lOperation->setMontant($lRechargement['montant']);
			$lOperation->setLibelle("Rechargement");
			$lOperation->setTypePaiement($lRechargement['typePaiement']);		
			$lOperation->setTypePaiementChampComplementaire($lRechargement['champComplementaire']);
			$lOperation->setIdBanque($lRechargement['idBanque']);
			$lOperation->setIdCommande($lIdMarche);
			
			$lOperationService = new OperationService();
			$lOperationService->set($lOperation);
		}
	}
	
	private function enregistrerAchatHorsMarche($pParam) {	
		$lAchat = new AchatVO();
		$lAchat->getId()->setIdCompte($pParam["idCompte"]);
		$lAchat->getId()->setIdCommande(-1);
		
		$lIdLots = array();
		foreach($pParam["produits"] as $lDetail) {
			array_push($lIdLots,$lDetail["lotId"]);
		}
		foreach($pParam["produitsSolidaire"] as $lDetail) {
			array_push($lIdLots,$lDetail["lotId"]);
		}
		$lModelesLot = ModeleLotViewManager::selectbyArray($lIdLots);
		
		foreach($pParam["produits"] as $lDetail) {
			$lDetailAchat = new DetailReservationVO();
			$lDetailAchat->setQuantite($lDetail["quantite"]);
			$lDetailAchat->setMontant($lDetail["prix"]);
			$lDetailAchat->setIdNomProduit($lDetail['nproId']);
			$lDetailAchat->setUnite($lModelesLot[$lDetail["lotId"]]->getUnite());	
			$lDetailAchat->setIdLot($lDetail["lotId"]);
			$lAchat->addDetailAchat($lDetailAchat);
		}
			
		foreach($pParam["produitsSolidaire"] as $lDetail) {
			$lDetailAchat = new DetailReservationVO();
			$lDetailAchat->setQuantite($lDetail["quantite"]);
			$lDetailAchat->setMontant($lDetail["prix"]);
			$lDetailAchat->setIdNomProduit($lDetail['nproId']);
			$lDetailAchat->setUnite($lModelesLot[$lDetail["lotId"]]->getUnite());		
			$lDetailAchat->setIdLot($lDetail["lotId"]);
			$lAchat->addDetailAchatSolidaire($lDetailAchat);
		}
		
		$lAchatService = new AchatService();
		$lIdOperation = $lAchatService->set($lAchat); // Achat des produits
	
		// Si il y a aussi un rechargement du compte
		$lRechargement = $pParam['rechargement'];
		if(!empty($lRechargement['montant']) && $lRechargement['montant'] != 0) {
			$lOperation = new OperationVO();
			$lOperation->setIdCompte($pParam['idCompte']);
			$lOperation->setMontant($lRechargement['montant']);
			$lOperation->setLibelle("Rechargement");
			$lOperation->setTypePaiement($lRechargement['typePaiement']);
			$lOperation->setTypePaiementChampComplementaire($lRechargement['champComplementaire']);
			$lOperation->setIdBanque($lRechargement['idBanque']);
			$lOperation->setIdCommande(0);
			
			$lOperationService = new OperationService();
			$lOperationService->set($lOperation);
		}
	}
	
	/**
	 * @name modifierAchat($pParam)
	 * @return ListeReservationCommandeVR
	 * @desc Met à jour un achat
	 */
	private function modifierAchat($pParam) {
		$lAchatService = new AchatService();
		//	$lReservationService = new ReservationService();
		$lIdMarche = $pParam['id'];
		$lMarcheService = new MarcheService();
		$lMarche = $lMarcheService->get($lIdMarche);
		$lProduitsMarche = $lMarche->getProduits();
			
		$lAchat = NULL;
		$lAchatSolidaire = NULL;
		foreach($pParam["idAchat"] as $lId) {
			$lIdAchat = new IdAchatVO();
			$lIdAchat->setIdCompte($pParam['idCompte']);
			$lIdAchat->setIdCommande($lIdMarche);
			$lIdAchat->setIdAchat($lId);
			$lAchatTemp = $lAchatService->get($lIdAchat);
				
			$lTotal = $lAchatTemp->getTotal();
			$lTotalSolidaire = $lAchatTemp->getTotalSolidaire();
			if(!is_null($lTotal)) {
				$lAchat = $lAchatTemp;
			} else if(!is_null($lTotalSolidaire)) {
				$lAchatSolidaire = $lAchatTemp;
			}
		}
	
		$lPdtNvAchat = NULL;
		$lPdtNvAchatSolidaire = NULL;
		$lTableauIdDetailCommande = array();
		if(!empty($pParam["produits"])) {
			$lPdtNvAchat = $pParam["produits"];
			foreach($pParam["produits"] as $lDetail) {
				array_push($lTableauIdDetailCommande,$lDetail["dcomId"]);
			}
		}
		if(!empty($pParam["produitsSolidaire"])) {
			$lPdtNvAchatSolidaire = $pParam["produitsSolidaire"];
			foreach($pParam["produitsSolidaire"] as $lDetail) {
				array_push($lTableauIdDetailCommande,$lDetail["dcomId"]);
			}
		}
		
		$lLotProduits = DetailCommandeManager::selectByArray($lTableauIdDetailCommande);
	
		if((is_null($lAchat) && !is_null($lPdtNvAchat)) || (!is_null($lAchat) && !is_null($lPdtNvAchat))) { // Ajout ou Maj de l'achat
			$lNvAchat = new AchatVO();
			$lNvAchat->getId()->setIdCompte($pParam["idCompte"]);
			$lNvAchat->getId()->setIdCommande($pParam["id"]);
			
			if(!is_null($lAchat) && !is_null($lPdtNvAchat)) { // Maj de l'achat
				$lNvAchat->getId()->setIdAchat($lAchat->getId()->getIdAchat());
			}
			
			$lTotal = 0;
			foreach($lPdtNvAchat as $lDetail) {
				//$lDetailCommande = DetailCommandeManager::selectByIdProduit($lDetail["id"]);
	
				$lDetailAchat = new DetailReservationVO();

				$lDetailAchat->setQuantite($lDetail["quantite"]);
				$lDetailAchat->setMontant($lDetail["prix"]);
					
				$lDetailAchat->setIdNomProduit($lDetail['nproId']);
				
				
				if(isset($lLotProduits[$lDetail["nproId"]])) {
					$lDetailAchat->setIdDetailCommande($lDetail["dcomId"]);
					$lDetailAchat->setUnite($lLotProduits[$lDetail["nproId"]]->getUnite());
				} else { // Le produit n'est pas dans le marche il faut l'ajouter
					
				/*if(!is_null($lDetailCommande[0]->getId())) {
					$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
					$lDetailAchat->setUnite($lProduitsMarche[$lDetail["id"]]->getUnite());
				} else { // Le produit n'est pas dans le marche il faut l'ajouter*/
					$lProduit = new ProduitCommandeVO();
					$lProduit->setId($lIdMarche);
					$lProduit->setIdNom($lDetail['nproId']);
				
					// On ajout un produit classique uniquement
					$lProduit->setQteMaxCommande(-1);
					$lProduit->setQteRestante(-1);
					$lProduit->setType(0);
				
					// Récupère les modèles de lot
					$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lDetail['nproId']);
					$lLotUnique = count($lModelesLot) == 1;
					$lLotAchat = array();
					foreach($lModelesLot as $lLot) {
						$lDetailCommande = new DetailCommandeVO();
						$lDetailCommande->setTaille($lLot->getMLotQuantite());
						$lDetailCommande->setPrix($lLot->getMLotPrix());
							
						if($lDetail['lotId'] == $lLot->getMLotId()) {
							$lUnite = $lModelesLot[$lLot->getMLotId()]->getMLotUnite();
							$lProduit->setUnite($lUnite);
							$lDetailAchat->setUnite($lUnite);
							array_push($lLotAchat,$lDetailCommande);
							if($lLotUnique) { // Si un seul lot ajout dans le produit
								$lProduit->addLots($lDetailCommande);
							}							
						} else {
							$lProduit->addLots($lDetailCommande);
						}
					}
				
					// Ajout du produit dans le marché sauf le lot d'achat
					$lIdProduit = $lMarcheService->ajoutProduit($lProduit);

					if($lLotUnique) {// Si un seul lot déjà ajouté avec le produit donc c'est le premier lot
						$lDetailCommande = DetailCommandeManager::selectByIdProduit($lIdProduit);
						$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
					} else {
						//Ajout du lot d'achat
						$lProduit->setId($lIdProduit);
						$lProduit->setLots($lLotAchat);
						$lDcomId = $lMarcheService->ajoutLotUnitaireProduit($lProduit);
						
						$lDetailAchat->setIdDetailCommande($lDcomId);
					}
				}
				
	
				$lNvAchat->addDetailAchat($lDetailAchat);
	
				$lTotal += $lDetail["prix"];
			}
				
			$lNvAchat->setTotal($lTotal);
			$lAchatService->set($lNvAchat);
		} else if(!is_null($lAchat) && is_null($lPdtNvAchat)){ // Supression
			$lAchatService->delete($lAchat->getId());
		}
	
		if((is_null($lAchatSolidaire) && !is_null($lPdtNvAchatSolidaire)) || (!is_null($lAchatSolidaire) && !is_null($lPdtNvAchatSolidaire))) { // Ajout ouMaj de l'achat
			$lNvAchatSolidaire = new AchatVO();
			$lNvAchatSolidaire->getId()->setIdCompte($pParam["idCompte"]);
			$lNvAchatSolidaire->getId()->setIdCommande($pParam["id"]);
			if(!is_null($lAchatSolidaire) && !is_null($lPdtNvAchatSolidaire)) { // Maj de l'achat
				$lNvAchatSolidaire->getId()->setIdAchat($lAchatSolidaire->getId()->getIdAchat());
			}
				
			$lTotal = 0;
			foreach($lPdtNvAchatSolidaire as $lDetail) {
				//$lDetailCommande = DetailCommandeManager::selectByIdProduit($lDetail["id"]);
	
				$lDetailAchat = new DetailReservationVO();
				$lDetailAchat->setQuantite($lDetail["quantite"]);
				$lDetailAchat->setMontant($lDetail["prix"]);
				$lDetailAchat->setIdNomProduit($lDetail['nproId']);
				
				if(isset($lLotProduits[$lDetail["nproId"]])) {
					$lDetailAchat->setIdDetailCommande($lDetail["dcomId"]);
					$lDetailAchat->setUnite($lLotProduits[$lDetail["nproId"]]->getUnite());
				} else { // Le produit n'est pas dans le marche il faut l'ajouter
					
				/*if(!is_null($lDetailCommande[0]->getId())) {
					$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
					$lDetailAchat->setUnite($lProduitsMarche[$lDetail["id"]]->getUnite());
				} else { // Le produit n'est pas dans le marche il faut l'ajouter*/
					$lProduit = new ProduitCommandeVO();
					$lProduit->setId($lIdMarche);
					$lProduit->setIdNom($lDetail['nproId']);
				
					// On ajout un produit classique uniquement
					$lProduit->setQteMaxCommande(-1);
					$lProduit->setQteRestante(-1);
					$lProduit->setType(0);
				
					// Récupère les modèles de lot
					$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lDetail['nproId']);
					$lLotUnique = count($lModelesLot) == 1;
					
					$lLotAchat = array();
					foreach($lModelesLot as $lLot) {
						$lDetailCommande = new DetailCommandeVO();
						$lDetailCommande->setTaille($lLot->getMLotQuantite());
						$lDetailCommande->setPrix($lLot->getMLotPrix());
							
						if($lDetail['lotId'] == $lLot->getMLotId()) {
							$lUnite = $lModelesLot[$lLot->getMLotId()]->getMLotUnite();
							$lProduit->setUnite($lUnite);
							$lDetailAchat->setUnite($lUnite);
							array_push($lLotAchat,$lDetailCommande);
							if($lLotUnique) { // Si un seul lot ajout dans le produit
								$lProduit->addLots($lDetailCommande);
							}
						} else {
							$lProduit->addLots($lDetailCommande);
						}
					}

					// Ajout du produit dans le marché sauf le lot d'achat
					$lIdProduit = $lMarcheService->ajoutProduit($lProduit);
					if($lLotUnique) {// Si un seul lot déjà ajouté avec le produit donc c'est le premier lot
						$lDetailCommande = DetailCommandeManager::selectByIdProduit($lIdProduit);
						$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
					} else {
						//Ajout du lot d'achat
						$lProduit->setId($lIdProduit);
						$lProduit->setLots($lLotAchat);
						$lDcomId = $lMarcheService->ajoutLotUnitaireProduit($lProduit);
						
						$lDetailAchat->setIdDetailCommande($lDcomId);
					}
				}
				
				$lNvAchatSolidaire->addDetailAchatSolidaire($lDetailAchat);
	
				$lTotal += $lDetail["prix"];
			}
				
			$lNvAchatSolidaire->setTotalSolidaire($lTotal);
	
			$lAchatService->set($lNvAchatSolidaire);
		} else if(!is_null($lAchatSolidaire) && is_null($lPdtNvAchatSolidaire)){ // Supression
			$lAchatService->delete($lAchatSolidaire->getId());
		}
	
		$lOperationService = new OperationService();
		$lOperationRechargement = $lOperationService->getRechargementMarche($pParam['idCompte'], $lIdMarche);
		
		// Si il y a aussi un rechargement du compte
		$lRechargement = $pParam['rechargement'];
		if(!empty($lRechargement['montant']) && $lRechargement['montant'] != 0) {
				
			
			if(is_null($lOperationRechargement->getId())) { // Pas de rechargement création
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($pParam['idCompte']);
				$lOperation->setLibelle("Rechargement");
				$lOperation->setIdCommande($lIdMarche);
			} else { // Si il y a un rechargement maj
				$lOperation = $lOperationRechargement;
			}
	
			$lOperation->setMontant($lRechargement['montant']);
			$lOperation->setTypePaiement($lRechargement['typePaiement']);
			$lOperation->setTypePaiementChampComplementaire($lRechargement['champComplementaire']);
			$lOperation->setIdBanque($lRechargement['idBanque']);
	
			$lOperationService->set($lOperation);
		} else {
			$lOperationService->delete($lOperationRechargement);
		}
	}
}
?>