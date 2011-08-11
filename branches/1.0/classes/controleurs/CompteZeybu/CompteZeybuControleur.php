<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : CompteZeybuControleur.php
//
// Description : Classe CompteZeybuControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CompteZeybuOperationViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ZEYBU . "/InfoCompteZeybuResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );

/**
 * @name CompteZeybuControleur
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe controleur du compte zeybu
 */
class CompteZeybuControleur
{
	/**
	* @name getInfoCompte()
	* @desc Donne les infos sur le compte du zeybu
	*/
	public function getInfoCompte() {	
		$lCompteService = new CompteService();
		$lOperationService = new OperationService();
		$lSoldeTotal = $lCompteService->get(-1)->getSolde();
		$lSoldeCaisse = $lOperationService->getSoldeCaisse();
		$lSoldeBanque = $lOperationService->getSoldeBanque();
		
		$lResponse = new InfoCompteZeybuResponse();
		$lResponse->setSoldeTotal($lSoldeTotal);
		$lResponse->setSoldeCaisse($lSoldeCaisse);
		$lResponse->setSoldeBanque($lSoldeBanque);
		$lResponse->setOperation( CompteZeybuOperationViewManager::selectAll());
		
		return $lResponse;		
	}
}
?>