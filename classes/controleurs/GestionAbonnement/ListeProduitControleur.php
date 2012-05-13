<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : ListeProduitControleur.php
//
// Description : Classe ListeProduitControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/ListeProduitAbonnementResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/DetailProduitResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ABONNEMENT . "/ListeProduitValid.php" );

include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT ."/ListeProduitFermeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeFermeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AbonnementNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ABONNEMENT . "/FermeValid.php");


include_once(CHEMIN_CLASSES_VO . "ListeProduitVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeProduitFermeVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeProduitFermeCategorieVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeProduitFermeCategorieProduitVO.php");
include_once(CHEMIN_CLASSES_VO . "LotAbonnementMarcheVO.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");  
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/UniteResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/DetailProduitModifierResponse.php" );

/**
 * @name ListeProduitControleur
 * @author Julien PIERRE
 * @since 26/02/2012
 * @desc Classe controleur du liste Produit
 */
class ListeProduitControleur
{
	/**
	* @name getListeProduitAbonnement()
	* @desc Donne la liste des Produits 
	*/
	public function getListeProduitAbonnement() {		
		$lResponse = new ListeProduitAbonnementResponse();
		$lAbonnementService = new AbonnementService();
		
		$lProduits = $lAbonnementService->getProduit();
		
		$lDerniereFerme = $lProduits[0]->getFerNom();
		$lDerniereCategorie = $lProduits[0]->getCproNom();
		$lListeProduit = new ListeProduitVO();
		
		$lFerme = new ListeProduitFermeVO();
		$lFerme->setNom($lProduits[0]->getFerNom());
		
		$lCategorie = new ListeProduitFermeCategorieVO();
		$lCategorie->setNom($lProduits[0]->getCproNom());
		
		foreach($lProduits as $lProduit) {
			if($lDerniereFerme != $lProduit->getFerNom()) {
				$lFerme->addCategories($lCategorie);
				$lListeProduit->addFermes($lFerme);
				
				$lFerme = new ListeProduitFermeVO();
				$lFerme->setNom($lProduit->getFerNom());
				
				$lCategorie = new ListeProduitFermeCategorieVO();
				$lCategorie->setNom($lProduit->getCproNom());
			} else if($lDerniereCategorie != $lProduit->getCproNom()) {
				$lFerme->addCategories($lCategorie);
				$lCategorie = new ListeProduitFermeCategorieVO();
				$lCategorie->setNom($lProduit->getCproNom());
			}
			$lPdt = new ListeProduitFermeCategorieProduitVO();
			$lPdt->setId($lProduit->getProAboId());
			$lPdt->setNom($lProduit->getNproNom());			
			$lCategorie->addProduits($lPdt);
			
			
			$lDerniereCategorie = $lProduit->getCproNom();
			$lDerniereFerme = $lProduit->getFerNom();	
		}		
		$lFerme->addCategories($lCategorie);
		$lListeProduit->addFermes($lFerme);

		$lResponse->setProduits($lListeProduit);
		return $lResponse;		
	}
	
	/**
	* @name getDetailProduit($pParam)
	* @desc Donne le détail d'un produit
	*/
	public function getDetailProduit($pParam) {
		$lVr = ListeProduitValid::validGetDetailProduit($pParam);
		if($lVr->getValid()) {
			$lAbonnementService = new AbonnementService();
			$lResponse = new DetailProduitResponse();
			
			$lProduit = $lAbonnementService->getDetailProduit($pParam["id"]);
			$lResponse->setProduit($lProduit);
			
			
			$lResponse->setAbonnes($lAbonnementService->getAbonnesProduit($pParam["id"]));
			return $lResponse;		
		}
		return $lVr;
	}

	/**
	* @name getDetailProduitModifier($pParam)
	* @desc Donne le détail d'un produit
	*/
	public function getDetailProduitModifier($pParam) {
		$lVr = ListeProduitValid::validGetDetailProduit($pParam);
		if($lVr->getValid()) {
			$lAbonnementService = new AbonnementService();
			$lResponse = new DetailProduitModifierResponse();
			$lProduit = $lAbonnementService->getDetailProduit($pParam["id"]);

			$lNvLots = array();
			foreach($lProduit[0]->getLots() as $lLot) {
				$lAbon = $lAbonnementService->getAbonnementSurLot($lLot->getId());
				
				$lNvLot = new LotAbonnementMarcheVO();
				$lNvLot->setId($lLot->getId());
				$lNvLot->setIdProduitAbonnement($lLot->getIdProduitAbonnement());
				$lNvLot->setTaille($lLot->getTaille());
				$lNvLot->setPrix($lLot->getPrix());
				if(!is_null($lAbon[0]->getCptAboIdProduitAbonnement())) {
					$lNvLot->setReservation(true);
				}
				array_push($lNvLots,$lNvLot);
			}
			$lProduit[0]->setLots($lNvLots);
			
			$lResponse->setProduit($lProduit);
			
		//	$lProduit = $lAbonnementService->getProduit($pParam["id"]);
			$lResponse->setUnite( ModeleLotViewManager::selectByIdNomProduit($lProduit[0]->getProAboIdNomProduit()) );
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name ajoutProduit($pParam)
	* @desc Ajoute un Produit
	*/
	public function ajoutProduit($pParam) {
		$lVr = ListeProduitValid::validAjout($pParam);
		if($lVr->getValid()) {			
			$lProduitAbonnement = new ProduitAbonnementVO();
			$lProduitAbonnement->setIdNomProduit($pParam['idNomProduit']);
			$lProduitAbonnement->setUnite($pParam['unite']);
			$lProduitAbonnement->setStockInitial($pParam['stockInitial']);
			$lProduitAbonnement->setMax($pParam['max']);
			$lProduitAbonnement->setFrequence($pParam['frequence']);
			$lProduitAbonnement->setEtat(0);
			$lProduitAbonnement->setLots($pParam['lots']);
			
			$lAbonnementService = new AbonnementService();
			$lAbonnementService->setProduit($lProduitAbonnement);
		}
		return $lVr;
	}
	
	/**
	* @name updateProduit($pParam)
	* @desc Met à jour un produit
	*/
	public function updateProduit($pParam) {
		$lVr = ListeProduitValid::validUpdate($pParam);
		if($lVr->getValid()) {			
			$lAbonnementService = new AbonnementService();			
			$lProduitAbonnement = $lAbonnementService->getProduit($pParam["id"]);
			
			$lProduitAbonnement->setUnite($pParam['unite']);
			$lProduitAbonnement->setStockInitial($pParam['stockInitial']);
			$lProduitAbonnement->setMax($pParam['max']);
			$lProduitAbonnement->setFrequence($pParam['frequence']);
			
			$lProduitAbonnement->setLots(array());
			foreach($pParam['lots'] as $lLot) {
				$lLotAbonnement = new LotAbonnementVO();
				$lLotAbonnement->setId($lLot["id"]);
				$lLotAbonnement->setIdProduitAbonnement($pParam["id"]);
				$lLotAbonnement->setTaille($lLot["taille"]);
				$lLotAbonnement->setPrix($lLot["prix"]);
				$lLotAbonnement->setEtat(0);
				$lProduitAbonnement->addLots($lLotAbonnement);
			 }		 
			
			
			//$lProduitAbonnement->setLots($pParam['lots']);
			$lAbonnementService->setProduit($lProduitAbonnement,$pParam["lotRemplacement"]);
		}
		return $lVr;
	}
	
	/**
	* @name supprimerProduit($pParam)
	* @desc Supprime un produit
	*/
	public function supprimerProduit($pParam) {
		$lVr = ListeProduitValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAbonnementService = new AbonnementService();
			$lAbonnementService->deleteProduit($pParam['id']);
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
			$lResponse->setListeProduit( AbonnementNomProduitViewManager::select( $pParam['id'] ) );
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