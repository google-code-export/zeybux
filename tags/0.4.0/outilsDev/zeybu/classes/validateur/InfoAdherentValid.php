<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoAdherentValid.php
//
// Description : Classe InfoAdherentValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "InfoAdherentVR.php" );

/**
 * @name InfoAdherentVR
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une InfoAdherentValid
 */
class InfoAdherentValid
{
	/**
	* @name validAjout($pData)
	* @return InfoAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new InfoAdherentVR();
		//Tests Techniques
		if(!TestFonction::checkLength($pData['motPass'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPass()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPass()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['motPassNouveau'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPassNouveau()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPassNouveau()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['motPasseConfirm'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPasseConfirm()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPasseConfirm()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['motPass'])) {
			$lVr->setValid(false);
			$lVr->getMotPass()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPass()->addErreur($lErreur);	
		}
		if(empty($pData['motPassNouveau'])) {
			$lVr->setValid(false);
			$lVr->getMotPassNouveau()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPassNouveau()->addErreur($lErreur);	
		}
		if(empty($pData['motPasseConfirm'])) {
			$lVr->setValid(false);
			$lVr->getMotPasseConfirm()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasseConfirm()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return InfoAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new InfoAdherentVR();
		if(!is_int((int)$pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return InfoAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = InfoAdherentValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new InfoAdherentVR();
			//Tests Techniques
			if(!TestFonction::checkLength($pData['motPass'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMotPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMotPass()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['motPassNouveau'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMotPassNouveau()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMotPassNouveau()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['motPasseConfirm'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMotPasseConfirm()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMotPasseConfirm()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['motPass'])) {
				$lVr->setValid(false);
				$lVr->getMotPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPass()->addErreur($lErreur);	
			}
			if(empty($pData['motPassNouveau'])) {
				$lVr->setValid(false);
				$lVr->getMotPassNouveau()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPassNouveau()->addErreur($lErreur);	
			}
			if(empty($pData['motPasseConfirm'])) {
				$lVr->setValid(false);
				$lVr->getMotPasseConfirm()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPasseConfirm()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}

}