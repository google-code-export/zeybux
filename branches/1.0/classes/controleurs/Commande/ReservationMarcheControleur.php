<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/03/2012
// Fichier : ReservationMarcheControleur.php
//
// Description : Classe ReservationMarcheControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/ReservationMarcheResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/ReservationMarcheValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitViewManager.php");  
include_once(CHEMIN_CLASSES_VO . "NomProduitCatalogueVO.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE ."/DetailProduitResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitProducteurViewManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CaracteristiqueProduitViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailMarcheViewManager.php");  
/**
 * @name ReservationMarcheControleur
 * @author Julien PIERRE
 * @since 20/03/2012
 * @desc Classe controleur du détail d'une reservation
 */
class ReservationMarcheControleur
{
	/**
	* @name getDetailProduit($pParam)
	* @return DetailProduitResponse
	* @desc Retourne le détail d'un produit
	*/
	public function getDetailProduit($pParam) {
		$lVr = AfficheAchatAdherentValid::validGetDetailProduit($pParam);
		if($lVr->getValid()) {
			$lId = $pParam['id'];
			
			$lProduit = ProduitManager::select($lId);
			$lIdNomProduit = $lProduit->getIdNomProduit();
			
			$lNomProduit = NomProduitViewManager::select($lProduit->getIdNomProduit($lIdNomProduit));
			$lNomProduit = $lNomProduit[0];
			$lNomProduitCatalagueVO = new NomProduitCatalogueVO();
			$lNomProduitCatalagueVO->setId($lNomProduit->getNProIdFerme());
			$lNomProduitCatalagueVO->setCproNom($lNomProduit->getCproNom());
			$lNomProduitCatalagueVO->setNom($lNomProduit->getNProNom());
			$lNomProduitCatalagueVO->setDescription($lNomProduit->getNProDescription());
			
			$lProducteurs = NomProduitProducteurViewManager::select($lIdNomProduit);
			$lNomProduitCatalagueVO->setProducteurs($lProducteurs);
			
			$lCaracteristiques = CaracteristiqueProduitViewManager::select($lIdNomProduit);
			$lNomProduitCatalagueVO->setCaracteristiques($lCaracteristiques);
						
			$lResponse = new DetailProduitResponse();
			$lResponse->setProduit( $lNomProduitCatalagueVO );
			return $lResponse;
		}		
		return $lVr;
	}
	
	/**
	* @name getReservation($pParam)
	* @return ReservationMarcheResponse
	* @desc Retourne les détails d'une réservation et de la commande
	*/
	public function getReservation($pParam) {
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];

		$lVr = ReservationMarcheValid::validGetReservation($pParam);
		if($lVr->getValid()) {
		
			$lResponse = new ReservationMarcheResponse();
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));
			$lResponse->setAdherent(AdherentViewManager::select($_SESSION[DROIT_ID]));
			
			// Ajoute la réservation si elle existe
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($_SESSION[ID_COMPTE]);
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			if($lReservationService->enCours($lIdReservation)) {
				$lResponse->setReservation($lReservationService->get($lIdReservation)->getDetailReservation());			
			}
			
			return $lResponse;
		}				
		return $lVr;
	}
		
	/**
	* @name modifierReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function modifierReservation($pParam) {
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];

		//$lVr = ReservationMarcheValid::validUpdate($pParam);
		$lVr = ReservationMarcheValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lReservationService = new ReservationService();
			
			$lIdLot = $pParam["detailReservation"][0]["stoIdDetailCommande"];
			$lDetailMarche = DetailMarcheViewManager::selectByLot($lIdLot);
	
			$lReservation = new ReservationVO();
			$lReservation->getId()->setIdCompte($_SESSION[ID_COMPTE]);
			$lReservation->getId()->setIdCommande($lDetailMarche[0]->getComId());
			
			$lReservationAbonnement = array();
			
			$lReservationsActuelle = $lReservationService->get($lReservation->getId());
			$lProduitsAbonnementMarche = ProduitManager::selectbyIdMarcheProduitAbonnement($lDetailMarche[0]->getComId());
			//var_dump($lReservationsActuelle->getDetailReservation());
			foreach($lReservationsActuelle->getDetailReservation() as $lReservationActuelle) {
		 		foreach($lProduitsAbonnementMarche as $lProduitAboMarche) {
					if($lReservationActuelle->getIdProduit() == $lProduitAboMarche->getId()) {
						$lReservationAbonnement[$lProduitAboMarche->getId()] = $lReservationActuelle;
						//var_dump($lReservationActuelle);
					}
		 		}
			}
			
			
			foreach($pParam["detailReservation"] as $lDetail) {
					$lDetailCommande = DetailCommandeManager::select($lDetail["stoIdDetailCommande"]);				
					$lPrix = $lDetail["stoQuantite"] / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();
	
					$lDetailReservation = new DetailReservationVO();
					
					$lDetailReservation->setIdDetailCommande($lDetail["stoIdDetailCommande"]);
					$lDetailReservation->setQuantite($lDetail["stoQuantite"]);
					$lDetailReservation->setMontant($lPrix);
					
					$lAjout = true;
					foreach($lProduitsAbonnementMarche as $lProduitAboMarche) {
						if($lDetailCommande->getIdProduit() == $lProduitAboMarche->getId()) {
							if(!isset($lReservationAbonnement[$lProduitAboMarche->getId()])) {
								$lReservationAbonnement[$lProduitAboMarche->getId()] = $lDetailReservation;		
							}
							$lAjout = false;
						}
			 		}
					
			 		if($lAjout) {
						$lReservation->addDetailReservation($lDetailReservation);
			 		}
			}
			foreach($lReservationAbonnement as $lReservationAbo) {
				$lReservation->addDetailReservation($lReservationAbo);
			}
			
			//var_dump($lReservation);
			
			
			$lIdOperation = $lReservationService->set($lReservation);
		}				
		return $lVr;
	}
	
	/**
	* @name controleModifierReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Vérifie si il est possible de modifier la réservation
	*/
	public function controleModifierReservation($pParam) {
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];
		$lVr = ReservationMarcheValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lIdLot = $pParam["detailReservation"][0]["stoIdDetailCommande"];
			$lDetailMarche = DetailMarcheViewManager::selectByLot($lIdLot);
			$lResponse = new ReservationMarcheResponse();
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($lDetailMarche[0]->getComId()));			
			$lResponse->setAdherent(AdherentViewManager::select($_SESSION[DROIT_ID]));
			
			return $lResponse;
		}				
		return $lVr;
	}
		
	/**
	* @name supprimerReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Supprime une réservation
	*/
	public function supprimerReservation($pParam) {
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];
		$lVr = ReservationMarcheValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pParam['idCompte']);
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			$lReservationService->delete($lIdReservation);
			
			// Repositionne une réservations sur les abonnements
			$lAbonnementService = new AbonnementService();
			$lAbonnementService->ajoutReservation($pParam['idCompte'],$pParam["id_commande"]);
		}
		return $lVr;
	}
}
?>