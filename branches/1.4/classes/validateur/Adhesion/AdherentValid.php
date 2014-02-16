<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/11/2010
// Fichier : AdherentValid.php
//
// Description : Classe AdherentValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_ADHERENTS . "/AdherentVR.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");

/**
 * @name AdherentVR
 * @author Julien PIERRE
 * @since 09/11/2010
 * @desc Classe représentant une AdherentValid
 */
class AdherentValid
{	
	/**
	 * @name validAffiche($pData)
	 * @return AdherentVR
	 * @desc Test la validite de l'élément
	 */
	public static function validAffiche($pData) {
		$lVr = new AdherentVR();
		//Tests inputs
		if(!isset($pData['idAdherent'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
	
		if($lVr->getValid()) {
			if(!is_int((int)$pData['idAdherent'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			// Vérifie si l'adhérent existe
			$lAdherent = AdherentViewManager::select( $pData['idAdherent'] );
			if($lAdherent->getAdhId() != $pData['idAdherent']) {
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
}
?>