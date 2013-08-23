<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/04/2013
// Fichier : StockProduitControleur.php
//
// Description : Classe StockProduitControleur
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ListeProduitValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitAjoutAchatValid.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AchatAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/UniteResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");  
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ProduitService.php");
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_TOVO . "ProduitAjoutAchatToVO.php");*/


include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_SERVICE . "FermeService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/StockQuantiteValid.php");
include_once(CHEMIN_CLASSES_TOVO . "StockQuantiteToVO.php" );
/**
 * @name StockProduitControleur
 * @author Julien PIERRE
 * @since 28/04/2013
 * @desc Classe controleur d'une AchatAdherent
 */
class StockProduitControleur
{	
	/**
	 * @name getListeFerme()
	 * @return ListeFermeResponse
	 * @desc Recherche la liste des Fermes
	 */
	public function getListeFerme() {
		// Lancement de la recherche
		$lResponse = new ListeFermeResponse();
		$lFermeService = new FermeService();
		$lResponse->setListeFerme($lFermeService->get());
		return $lResponse;
	}
	
	/**
	 * @name getDetailStockProduitFerme($pParam)
	 * @return ListeProduitResponse
	 * @desc Retourne la liste des stocks de produit de la Ferme
	 */
	public function getDetailStockProduitFerme($pParam) {
		$lVr = FermeValid::validGetByIdCompte($pParam);
		if($lVr->getValid()) {
			$lStockService = new StockService();
			$lResponse = new ListeProduitResponse();
			$lResponse->setListeProduit($lStockService->getStockProduitFerme($pParam['idCompte']));
			
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name modifierStock($pParam)
	 * @return StockQuantiteVR
	 * @desc Modifie une ligne de stock
	 */
	public function modifierStock($pParam) {
		$lVr = StockQuantiteValid::validUpdate($pParam);
		if($lVr->getValid()) {
			$lStockService = new StockService();
			$lStockService->setStockQuantite(StockQuantiteToVO::convertFromArray($pParam));
		}
		return $lVr;
	}
	
	/**
	 * @name getListeProduit($pParam)
	 * @return ListeProduitResponse
	 * @desc Retourne la liste des produits
	 */
	/*public function getListeProduit($pParam) {
		$lVr = FermeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeProduitResponse();
			$lResponse->setListeProduit( ListeNomProduitViewManager::select( $pParam['id'] ) );
			return $lResponse;
		}
		return $lVr;
	}*/
	
	/**
	 * @name getUnite($pParam)
	 * @return UniteResponse
	 * @desc Retourne les Unités du produit
	 */
	/*public function getUnite($pParam) {
		$lVr = ListeProduitValid::validIdNomProduit($pParam);
		if($lVr->getValid()) {
			$lId = $pParam['id'];
			$lUnite = ModeleLotViewManager::selectByIdNomProduit($lId);
			$lResponse = new UniteResponse();
			$lResponse->setUnite( $lUnite );
			return $lResponse;
		}
		return $lVr;
	}*/
}
?>