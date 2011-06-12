<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/06/2011
// Fichier : RechargerCompteValid.php
//
// Description : Classe RechargerCompteValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "RechargerCompteVR.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");

/**
 * @name RechargerCompteValid
 * @author Julien PIERRE
 * @since 12/06/2011
 * @desc Classe représentant une RechargerCompteValid
 */
class RechargerCompteValid
{
	/**
	* @name validInfo($pData)
	* @return RechargerCompteVR
	* @desc Test la validite de l'élément
	*/
	public static function validInfo($pData) {
		$lVr = new RechargerCompteVR();
		//Tests Techniques
		if(!is_int((int)$pData['id-adherent'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		
		//Tests Fonctionnels
		if(empty($pData['id-adherent'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}		
		
		$lAdherent = ListeAdherentViewManager::select($pData['id-adherent']);
		if($lAdherent->getAdhId() != $pData['id-adherent']) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}		
		return $lVr;
	}
}