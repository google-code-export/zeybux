<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : AchatAdherentControleur.php
//
// Description : Classe AchatAdherentControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ListeProduitValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitAjoutAchatValid.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AchatAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/UniteResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeFermeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");  
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ProduitService.php");
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_TOVO . "ProduitAjoutAchatToVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");

/**
 * @name AchatAdherentControleur
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe controleur d'une AchatAdherent
 */
class AchatAdherentControleur
{
	/**
	* @name getAchatEtReservation($pParam)
	* @return AchatAdherentResponse
	* @desc Retourne les détails d'une réservation et des achats du marché
	*/
	public function getAchatEtReservation($pParam) {
		$lVr = AfficheAchatAdherentValid::validGetAchatEtReservation($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam["id_adherent"];
			$lIdMarche = $pParam["id_marche"];
			$lIdOperation = $pParam["idOperation"];
			
			$lResponse = new AchatAdherentResponse();
			
			$lAdherent = AdherentViewManager::select($lIdAdherent);
			$lResponse->setAdherent($lAdherent);
			
	//		$lMarcheService = new MarcheService();
	//		$lResponse->setMarche($lMarcheService->get($lIdMarche));

			// Tableau pour rechercher le détail des produits achetés
			$lIdProduits = array();
			
			// Si achat sur marché recherche si il y a une réservation et le détail des achats
			if(!empty($lIdMarche) && empty($lIdOperation)) {
				$lReservationService = new ReservationService();
				$lIdReservation = new IdReservationVO();
				$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
				$lIdReservation->setIdCommande($lIdMarche);
				$lReservation = $lReservationService->get($lIdReservation);
				$lResponse->setReservation($lReservation);	
	
				//$lDetailResa = $lReservation->getDetailReservation();
				if(!empty($lReservation)) {
					// Récupère les informations sur les produits achetés				
					foreach( $lReservation->getDetailReservation() as $lDetailReservation) {
						array_push($lIdProduits, $lDetailReservation->getIdProduit());
					}
				}
				
				$lAchatService = new AchatService();
				$lIdAchat = new IdAchatVO();
				$lIdAchat->setIdCompte($lAdherent->getAdhIdCompte());
				$lIdAchat->setIdCommande($lIdMarche);
				$lAchats = $lAchatService->getAll($lIdAchat);
				$lResponse->setAchats($lAchats);
					
				if(is_array($lAchats)) {
					foreach( $lAchats as $lAchat) {
						foreach($lAchat->getDetailAchat() as $lDetailAchat) {
							array_push($lIdProduits, $lDetailAchat->getIdProduit());
						}
						foreach($lAchat->getDetailAchatSolidaire() as $lDetailAchat) {
							array_push($lIdProduits, $lDetailAchat->getIdProduit());
						}
					}
				}
			}
			/*$lAchatService = new AchatService();
			$lIdAchat = new IdAchatVO();
			$lIdAchat->setIdCompte($lAdherent->getAdhIdCompte());
			$lIdAchat->setIdCommande($lIdMarche);
			$lResponse->setAchats($lAchatService->getAll($lIdAchat));	
			
			$lStockSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($lIdMarche);
			$lResponse->setStockSolidaire($lStockSolidaire);	*/
			
			// Récupère l'achat si il il y une operation
			if(!empty($lIdOperation)) {
				$lAchatService = new AchatService();
				$lIdAchat = new IdAchatVO();
				$lIdAchat->setIdAchat($lIdOperation);
				$lAchat = $lAchatService->get($lIdAchat);
				$lResponse->setAchats($lAchat);
					
				//foreach( $lAchats as $lAchat) {
					foreach($lAchat->getDetailAchat() as $lDetailAchat) {
						array_push($lIdProduits, $lDetailAchat->getIdProduit());
					}
					foreach($lAchat->getDetailAchatSolidaire() as $lDetailAchat) {
						array_push($lIdProduits, $lDetailAchat->getIdProduit());
					}
				//}
			}
				
			$lProduitService = new ProduitService();
			$lResponse->setDetailProduit($lProduitService->selectDetailProduits($lIdProduits));
			
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name ajoutProduitAchat($pParam)
	* @return ProduitAjoutAchatVR
	* @desc Ajoute un produit à un achat
	*/
	public function ajoutProduitAchat($pParam) {
		$lVr = ProduitAjoutAchatValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lAchatService = new AchatService();
			$lAchatService->ajoutProduitAchat(ProduitAjoutAchatToVO::convertFromArray($pParam));
		}
		return $lVr;
	}
	
	/**
	* @name modifierAchat($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function modifierAchat($pParam) {
		$lVr = AfficheAchatAdherentValid::validModifierAchat($pParam);
		if($lVr->getValid()) {
			$lAchatData = $pParam["achat"];
			$lAchat = new AchatVO();
			
			if($lAchatData['idAchat'] < 0) { // Si c'est un ajout
				$lVr = AfficheAchatAdherentValid::validAjoutAchat($lAchatData);
				if($lVr->getValid()) {
					// Recherche si il y a une réservation
					$lIdReservation = new IdReservationVO();
					$lIdReservation->setIdCompte($lAchatData["idCompte"]);
					$lIdReservation->setIdCommande($lAchatData["idMarche"]);
					
					$lReservationService = new ReservationService();
					$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
					
					if($lOperations[0]->getTypePaiement() == 0) {
						$lAchat->getId()->setIdReservation($lOperations[0]->getId());
					}
					$lAchat->getId()->setIdCompte($lAchatData["idCompte"]);
					$lAchat->getId()->setIdCommande($lAchatData["idMarche"]);
					
			//		$lAchat->setTotal($lAchatData["total"]);
					foreach($lAchatData["produits"] as $lDetail) {
						$lDetailCommande = DetailCommandeManager::selectByIdProduit($lDetail["id"]);
						
						$lDetailAchat = new DetailReservationVO();
						$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
						$lDetailAchat->setQuantite($lDetail["quantite"]);
						$lDetailAchat->setMontant($lDetail["prix"]);
						
						$lProduit = ProduitManager::select($lDetail["id"]);
						$lDetailAchat->setIdNomProduit($lProduit->getIdNomProduit());
						$lDetailAchat->setUnite($lProduit->getUniteMesure());
						
						if($lAchatData["idAchat"] == -1) {
							$lAchat->addDetailAchat($lDetailAchat);
						} else if($lAchatData["idAchat"] == -2) {
							$lAchat->addDetailAchatSolidaire($lDetailAchat);				
						}
					}
				} else { return $lVr;}
			} else {
				$lOperationService = new OperationService();
				$lOperation = $lOperationService->get($lAchatData["idAchat"]);
			
				$lAchat = new AchatVO();
				$lAchat->getId()->setIdCompte($lOperation->getIdCompte());
				$lAchat->getId()->setIdCommande($lOperation->getIdCommande());
				$lAchat->getId()->setIdAchat($lOperation->getId());
				
			//	$lAchat->setTotal($lAchatData["total"]);
				foreach($lAchatData["produits"] as $lDetail) {
					$lDetailCommande = DetailCommandeManager::selectByIdProduit($lDetail["id"]);
					
					$lDetailAchat = new DetailReservationVO();
					$lDetailAchat->setIdDetailCommande($lDetailCommande[0]->getId());
					$lDetailAchat->setQuantite($lDetail["quantite"]);
					$lDetailAchat->setMontant($lDetail["prix"]);

					$lProduit = ProduitManager::select($lDetail["id"]);
					$lDetailAchat->setIdNomProduit($lProduit->getIdNomProduit());
					$lDetailAchat->setUnite($lProduit->getUniteMesure());
					
					if($lOperation->getTypePaiement() == 7) {
						$lAchat->addDetailAchat($lDetailAchat);
					} else if($lOperation->getTypePaiement() == 8) {
						$lAchat->addDetailAchatSolidaire($lDetailAchat);				
					}
				}
			}			
			$lAchatService = new AchatService();
			$lIdOperation = $lAchatService->set($lAchat);
		}				
		return $lVr;
	}
	
	/**
	* @name supprimerAchat($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function supprimerAchat($pParam) {		
		$lVr = AfficheAchatAdherentValid::validSupprimerAchat($pParam);
		if($lVr->getValid()) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pParam["idAchat"]);
		
			$lIdAchatVO = new IdAchatVO();
			$lIdAchatVO->setIdCompte($lOperation->getIdCompte());
			$lIdAchatVO->setIdCommande($lOperation->getIdCommande());
			$lIdAchatVO->setIdAchat($lOperation->getId());
			
			$lAchatService = new AchatService();
			$lSupressionAchat = $lAchatService->delete($lIdAchatVO);
		}
		return $lVr;
	}
	
	/**
	 * @name getListeFerme()
	 * @return ListeFermeResponse
	 * @desc Recherche la liste des Fermes
	 */
	public function getListeFerme() {
		// Lancement de la recherche
		$lResponse = new ListeFermeResponse();
		$lResponse->setListeFerme(ListeFermeViewManager::selectAll());
		return $lResponse;
	}
	
	/**
	 * @name getListeProduit($pParam)
	 * @return ListeProduitResponse
	 * @desc Retourne la liste des produits
	 */
	public function getListeProduit($pParam) {
		$lVr = FermeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeProduitResponse();
			$lResponse->setListeProduit( ListeNomProduitViewManager::select( $pParam['id'] ) );
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name getUnite($pParam)
	 * @return UniteResponse
	 * @desc Retourne les Unités du produit
	 */
	public function getUnite($pParam) {
		$lVr = ListeProduitValid::validIdNomProduit($pParam);
		if($lVr->getValid()) {
			$lId = $pParam['id'];
			$lUnite = ModeleLotViewManager::selectByIdNomProduit($lId);
			$lResponse = new UniteResponse();
			$lResponse->setUnite( $lUnite );
			return $lResponse;
		}
		return $lVr;
	}
}
?>