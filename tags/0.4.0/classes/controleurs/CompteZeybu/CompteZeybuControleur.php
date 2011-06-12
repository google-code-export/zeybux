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
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CompteZeybuViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CompteZeybuCaisseViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationPasseeViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "InfoCompteZeybuResponse.php" );

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
		$lSoldeTotal = CompteZeybuViewManager::selectAll();
		$lSoldeCaisse = CompteZeybuCaisseViewManager::selectAll();
		
		$lSoldeTotal = $lSoldeTotal[0]->getOpeMontant();
		$lSoldeCaisse = $lSoldeCaisse[0]->getOpeMontant();
		$lSoldeBanque = $lSoldeTotal - $lSoldeCaisse;
		
		$lResponse = new InfoCompteZeybuResponse();
		$lResponse->setSoldeTotal($lSoldeTotal);
		$lResponse->setSoldeCaisse($lSoldeCaisse);
		$lResponse->setSoldeBanque($lSoldeBanque);
		$lResponse->setOperation( OperationPasseeViewManager::selectAll());
		
		return $lResponse;		
	}
}
?>