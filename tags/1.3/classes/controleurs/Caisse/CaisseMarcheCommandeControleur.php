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
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/InfoAchatCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");
include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");

//include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_TOVO . "AchatToVO.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/AchatConfirmResponse.php" );


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

			$lStockService = new StockService();
			$lStockProduitsDisponible = $lStockService->getProduitsDisponible();	// Stock de produit disponible
			
			$lStock = array();
			$lProduitsMarche = array();
			$lProduitsReservation = array();
			$lProduitsAchat = array();
			if($pParam["id_commande"] != -1) { // Si ce n'est pas la caisse permanente
				$lMarcheService = new MarcheService();
				$lMarche = $lMarcheService->get($pParam["id_commande"]);
				$lProduitsMarche = $lMarche->getProduits();
				$lResponse->setMarche($lMarche); // Les informations du marché 
				
							
				if($pParam["id_adherent"] != 0) { // Si ce n'est pas le compte invité
					
					$lReservationService = new ReservationService();
					$lIdReservation = new IdReservationVO();
					$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
					$lIdReservation->setIdCommande($pParam["id_commande"]);		
					$lProduitsReservation = $lReservationService->get($lIdReservation)->getDetailReservation();
					$lResponse->setReservation($lProduitsReservation);	// La réservation	
					
					$lAchatService = new AchatService();
					$lOperationsAchat = $lAchatService->selectOperationAchat($lAdherent->getAdhIdCompte(), $pParam["id_commande"]);
					$lAchat = new AchatVO();
					if(!is_null($lOperationsAchat[0]->getId())) {
						$lAchat = $lAchatService->get($lOperationsAchat[0]->getId());
						$lProduitsAchat = $lAchat->getProduits();
					} else {
						$lOperationService = new OperationService();
						$lOperationsRechargement = $lOperationService->getOperationRechargementSurMarche($lAdherent->getAdhIdCompte(), $pParam["id_commande"]);
						if(!is_null($lOperationsRechargement[0]->getId())) {
							$lAchat = $lAchatService->get($lOperationsRechargement[0]->getId());
						}
					}
					$lResponse->setAchats($lAchat); // L'achat									
				}
			}
			
			// Fusion des stocks
			$lLotsProduits = array();
			foreach($lStockProduitsDisponible as $lProduitStock) {
				$lAjout = true;
				foreach($lProduitsMarche as $lProduitMarche) {
					if($lProduitStock->getIdNom() == $lProduitMarche->getIdNom() && $lProduitStock->getUnite() == $lProduitMarche->getUnite()) {
						$lAjout = false;
					}
				}
				if($lAjout) {
					if(!isset($lStock[$lProduitStock->getCproNom()])) {
						$lStock[$lProduitStock->getCproNom()] = array("cproId" => $lProduitStock->getIdCategorie(), "cproNom" => $lProduitStock->getCproNom(), "produits" => array());
					}
					$lUnite = !is_null($lProduitStock->getUnite()) ? $lProduitStock->getUnite() : $lProduitStock->getUniteSolidaire();
					$lStock[$lProduitStock->getCproNom()]["produits"][$lProduitStock->getNom().$lProduitStock->getUnite()] = new ProduitDetailAchatAfficheVO(
							$lProduitStock->getIdNom(),
							null, null, null, null, null, null, null, null, null,
							$lUnite,
							null,
							$lUnite,
							null, null,
							$lProduitStock->getIdCategorie(),
							$lProduitStock->getCproNom(),
							null,
							$lProduitStock->getNom());
						
					$lLotsProduits[$lProduitStock->getIdNom().$lProduitStock->getUnite()] = array("nom" => $lProduitStock->getNom(), "type" => "modele", "lots" => $lProduitStock->getLots());
				}
			}
			foreach($lProduitsMarche as $lProduitMarche) {
				if(!isset($lStock[$lProduitMarche->getCproNom()])) {
					$lStock[$lProduitMarche->getCproNom()] = array("cproId" => $lProduitMarche->getCproId(), "cproNom" => $lProduitMarche->getCproNom(), "produits" => array());
				}
				$lUnite = !is_null($lProduitMarche->getUnite()) ? $lProduitMarche->getUnite() : $lProduitMarche->getUniteSolidaire();
				
				$lMontant = NULL;
				$lQuantite = NULL;
				$lIdDetailCommande = NULL;
				// Ajout des réservations
				if(empty($lProduitsAchat)) {
					foreach($lProduitsReservation as $lProduitReservation) {
						if($lProduitReservation->getIdNomProduit() == $lProduitMarche->getIdNom() && $lProduitReservation->getUnite() == $lProduitMarche->getUnite()) {
							$lQuantite = $lProduitReservation->getQuantite();
							$lMontant = $lProduitReservation->getMontant();
							$lIdDetailCommande = $lProduitReservation->getIdDetailCommande();
						}
					}
				}
				
				$lStock[$lProduitMarche->getCproNom()]["produits"][$lProduitMarche->getNom().$lProduitMarche->getUnite()] = new ProduitDetailAchatAfficheVO(
						$lProduitMarche->getIdNom(),
						null, null, null, null, 
						$lIdDetailCommande, 
						null, null, null, 
						$lQuantite,
						$lUnite,
						null,
						$lUnite,
						$lMontant, 
						null,
						$lProduitMarche->getIdCategorie(),
						$lProduitMarche->getCproNom(),
						null,
						$lProduitMarche->getNom());
			
				$lLotsProduits[$lProduitMarche->getIdNom().$lProduitMarche->getUnite()] = array("nom" => $lProduitMarche->getNom(), "type" => "marche", "lots" => $lProduitMarche->getLots());
			}
			foreach($lProduitsAchat as $lProduitAchat) {
				$lUnite = !is_null($lProduitAchat->getUnite()) ? $lProduitAchat->getUnite() : $lProduitAchat->getUniteSolidaire();
				if(!is_null($lUnite)) {
					if(isset($lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite])) {
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdStock($lProduitAchat->getIdStock());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdStockSolidaire($lProduitAchat->getIdStockSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdDetailCommande($lProduitAchat->getIdDetailCommande());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdModeleLot($lProduitAchat->getIdModeleLot());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdDetailCommandeSolidaire($lProduitAchat->getIdDetailCommandeSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdModeleLotSolidaire($lProduitAchat->getIdModeleLotSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setQuantite($lProduitAchat->getQuantite());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setQuantiteSolidaire($lProduitAchat->getQuantiteSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setMontant($lProduitAchat->getMontant());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setMontantSolidaire($lProduitAchat->getMontantSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdDetailOperation($lProduitAchat->getIdDetailOperation());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdDetailOperationSolidaire($lProduitAchat->getIdDetailOperationSolidaire());
					} else {
						if(!isset($lStock[$lProduitAchat->getCproNom()])) {
							$lStock[$lProduitAchat->getCproNom()] = array("cproId" => $lProduitAchat->getCproId(), "cproNom" => $lProduitAchat->getCproNom(), "produits" => array());
						}
						$lProduitAchat->setUnite($lUnite);
						$lProduitAchat->setUniteSolidaire($lUnite);
						$lStock[$lProduitAchat->getCproNom()]["produits"][$lProduitAchat->getNproNom().$lUnite] = $lProduitAchat;
			
						// Ajout des lots
						$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lProduitAchat->getIdNomProduit());
						$lLots = array();
						foreach($lModelesLot as $lModeleLot) {
							$lLot = new DetailMarcheVO();
							$lLot->setId($lModeleLot->getMLotId());
							$lLot->setTaille($lModeleLot->getMLotQuantite());
							$lLot->setPrix($lModeleLot->getMLotPrix());
							$lLots[$lModeleLot->getMLotId()] = $lLot;
						}
						$lLotsProduits[$lProduitAchat->getIdNomProduit().$lUnite] = array("nom" => $lProduitAchat->getNproNom(), "type" => "modele", "lots" => $lLots);
					}
				}
			}
			
			$lResponse->setStock($lStock);	// Stock de produit disponible
			$lResponse->setLots($lLotsProduits);	// Lots des produits
			
			
			$lBanqueService = new BanqueService();
			$lTypePaiementService = new TypePaiementService();	
					
			
			
			
			
			
			
			$lResponse->setTypePaiement($lTypePaiementService->selectVisible()); // Type de paiment
			$lResponse->setBanques($lBanqueService->getAllActif()); // Liste des banques
			$lResponse->setIdRequete(uniqid());
			return $lResponse;
		}				
		return $lVr;
	}
	
	/**
	* @name enregistrerAchat($pParam)
	* @return AchatVR
	* @desc Enregistre la commande d'un adhérent
	*/
	public function enregistrerAchat($pParam) {
		$lVr = MarcheValid::validEnregistrer($pParam);
		if($lVr->getValid()) {
			$lAchatService = new AchatService();
			$lIdAchat = $lAchatService->set(AchatToVO::convertFromArray($pParam));
			return new AchatConfirmResponse($lIdAchat);
			/*
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
			}*/
		}				
		return $lVr;
	}
	
	/*private function enregistrerAchatMarche($pParam) {
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
			$lOperation = new OperationDetailVO();
			$lOperation->setIdCompte($pParam['idCompte']);
			$lOperation->setMontant($lRechargement['montant']);
			$lOperation->setLibelle("Rechargement");
			$lOperation->setTypePaiement($lRechargement['typePaiement']);
							
			foreach($lRechargement['champComplementaire'] as $lChamp) {
				if(!is_null($lChamp)) {
					$lOperationChampComplementaire = new OperationChampComplementaireVO();
					$lOperationChampComplementaire->setChcpId($lChamp['id']);
					$lOperationChampComplementaire->setValeur($lChamp['valeur']);
					$lOperation->addChampComplementaire($lOperationChampComplementaire);
				}
			}
			
			$lOperationService = new OperationService();
			$lOperationService->set($lOperation);
		}
	}
	
	/**
	 * @name modifierAchat($pParam)
	 * @return ListeReservationCommandeVR
	 * @desc Met à jour un achat
	 */
	/*private function modifierAchat($pParam) {
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
			/*		$lProduit = new ProduitCommandeVO();
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
	/*				$lProduit = new ProduitCommandeVO();
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
		/*$lOperationRechargement = $lOperationService->getRechargementMarche($pParam['idCompte'], $lIdMarche);
		
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
	}*/
}
?>