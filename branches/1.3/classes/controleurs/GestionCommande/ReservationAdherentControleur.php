<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : ReservationAdherentControleur.php
//
// Description : Classe ReservationAdherentControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheReservationAdherentValid.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ReservationAdherentResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/CommandeReservationValid.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitViewManager.php");  
include_once(CHEMIN_CLASSES_VO . "NomProduitCatalogueVO.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitProducteurViewManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CaracteristiqueProduitViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/DetailProduitResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheReservationAdherentValid.php");

/**
 * @name ReservationAdherentControleur
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe controleur d'une ReservationAdherent
 */
class ReservationAdherentControleur
{
	/**
	* @name getReservation($pParam)
	* @return ReservationAdherentResponse
	* @desc Retourne les détails d'une réservation et de la commande
	*/
	public function getReservation($pParam) {
		$lVr = AfficheReservationAdherentValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam["id_adherent"];
			$lIdCommande = $pParam["id_commande"];
			
			$lResponse = new ReservationAdherentResponse();
			
			$lAdherent = AdherentViewManager::select($lIdAdherent);
			$lResponse->setAdherent($lAdherent);
			
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));

			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
			$lIdReservation->setIdCommande($pParam["id_commande"]);			
			if($lReservationService->enCoursOuAchete($lIdReservation)) {
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
		$lVr = CommandeReservationValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lIdLot = $pParam["detailReservation"][0]["stoIdDetailCommande"];
			$lDetailMarche = DetailMarcheViewManager::selectByLot($lIdLot);
	
			$lReservationService = new ReservationService();
			$lReservation = new ReservationVO();
			$lReservation->getId()->setIdCompte($pParam["id_compte"]);
			$lReservation->getId()->setIdCommande($lDetailMarche[0]->getComId());
			
			foreach($pParam["detailReservation"] as $lDetail) {
					$lDetailCommande = DetailCommandeManager::select($lDetail["stoIdDetailCommande"]);				
					$lPrix = $lDetail["stoQuantite"] / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();
	
					$lDetailReservation = new DetailReservationVO();
					
					$lDetailReservation->setIdDetailCommande($lDetail["stoIdDetailCommande"]);
					$lDetailReservation->setQuantite($lDetail["stoQuantite"]);
					$lDetailReservation->setMontant($lPrix);

					/*$lDetailProduit = DetailMarcheViewManager::selectByLot($lDetail["stoIdDetailCommande"]);
					$lDetailReservation->setIdNomProduit($lDetailProduit[0]->getNproId());*/
					
					$lReservation->addDetailReservation($lDetailReservation);
			}		
			$lReservationService = new ReservationService();
			$lIdOperation = $lReservationService->set($lReservation);
		}				
		return $lVr;
	}
	
	/**
	* @name supprimerReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function supprimerReservation($pParam) {		
		$lVr = CommandeReservationValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pParam["id_compte"]);
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			$lReservationService->delete($lIdReservation);
		}
		return $lVr;
	}
	
	/**
	* @name getDetailProduit($pParam)
	* @return DetailProduitResponse
	* @desc Retourne le détail d'un produit
	*/
	public function getDetailProduit($pParam) {
		$lVr = AfficheReservationAdherentValid::validGetDetailProduit($pParam);
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
}
?>