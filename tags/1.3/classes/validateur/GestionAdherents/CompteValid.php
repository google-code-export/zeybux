<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/10/2013
// Fichier : CompteValid.php
//
// Description : Classe CompteValid
//
//****************************************************************
namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_GESTION_ADHERENTS;

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_ADHERENTS . "/CompteVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");

/**
 * @name CompteVR
 * @author Julien PIERRE
 * @since 17/10/2013
 * @desc Classe représentant une CompteValid
 */
class CompteValid
{
	/**
	* @name validExiste($pData)
	* @return CompteVR
	* @desc Test la validite de l'élément
	*/
	public static function validExiste($pData) {
		$lVr = new \CompteVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
				
		if($lVr->getValid()) {
			//Tests Techniques
			if(!\TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			
			//Tests Fonctionnels
			
			// Le compte existe
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
				
			$lCompte = \CompteManager::select($pData['id']);					
			if($lCompte->getId() == $pData['id']) {
				// Le Compte est un compte adhérent
				$lAdherent = \AdherentViewManager::selectByIdCompte($lCompte->getId());	
				if(is_null($lAdherent[0]->getAdhId())) {					
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_227_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_227_MSG);
					$lVr->getId()->addErreur($lErreur);	
				}
			} else {				
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_228_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_228_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}
}
?>