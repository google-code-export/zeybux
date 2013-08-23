<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/03/2010
// Fichier : ReservationCommandeControleur.php
//
// Description : Classe ReservationCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/DetailMarcheResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/CommandeReservationValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VO . "ReservationVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitViewManager.php");  
include_once(CHEMIN_CLASSES_VO . "NomProduitCatalogueVO.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitProducteurViewManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CaracteristiqueProduitViewManager.php");  
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE ."/DetailProduitResponse.php" );


/**
 * @name ReservationCommandeControleur
 * @author Julien PIERRE
 * @since 31/03/2010
 * @desc Classe controleur d'une ReservationCommande
 */
class ReservationCommandeControleur
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
	* @return AfficherReservationResponse
	* @desc Retourne les détails d'une réservation et de la commande
	*/
	public function getReservation($pParam) {		
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];
		$lVr = CommandeReservationValid::validGetMarche($pParam);
		if($lVr->getValid()) {
			$lResponse = new DetailMarcheResponse();
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));
			$lResponse->setAdherent(AdherentViewManager::select($_SESSION[DROIT_ID]));
			return $lResponse;
		}				
		return $lVr;
	}
	
	/**
	* @name enregistrerReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function enregistrerReservation($pParam) {
		$pParam['idCompte'] = $_SESSION[ID_COMPTE];
		$lVr = CommandeReservationValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lIdLot = $pParam["detailReservation"][0]["stoIdDetailCommande"];
			$lDetailMarche = DetailMarcheViewManager::selectByLot($lIdLot);
			
			$lReservation = new ReservationVO();
			$lReservation->getId()->setIdCompte($_SESSION[ID_COMPTE]);
			$lReservation->getId()->setIdCommande($lDetailMarche[0]->getComId());
			
			foreach($pParam["detailReservation"] as $lDetail){
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
			
			// TODO si $lIdOperation est null -> afficher l'erreur.
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
		$lVr = CommandeReservationValid::validAjout($pParam);
		if($lVr->getValid()) {
			return ReservationCommandeControleur::getReservation($pParam);
		}				
		return $lVr;
	}
}
?>