<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2010
// Fichier : IdentificationValid.php
//
// Description : Classe IdentificationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "IdentificationVR.php" );

/**
 * @name IdentificationVR
 * @author Julien PIERRE
 * @since 01/11/2010
 * @desc Classe représentant une IdentificationValid
 */
class IdentificationValid
{
	/**
	* @name validAjout($pData)
	* @return IdentificationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new IdentificationVR();
		//Tests Techniques
		if(!TestFonction::checkLength($pData['login'],0,5)) {
			$lVr->setValid(false);
			$lVr->getLogin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getLogin()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['pass'],0,100)) {
			$lVr->setValid(false);
			$lVr->getPass()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getPass()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['login'])) {
			$lVr->setValid(false);
			$lVr->getLogin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLogin()->addErreur($lErreur);	
		}
		if(empty($pData['pass'])) {
			$lVr->setValid(false);
			$lVr->getPass()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPass()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return IdentificationVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new IdentificationVR();
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
	* @return IdentificationVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new IdentificationVR();
			//Tests Techniques
			if(!TestFonction::checkLength($pData['login'],0,5)) {
				$lVr->setValid(false);
				$lVr->getLogin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getLogin()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['pass'],0,100)) {
				$lVr->setValid(false);
				$lVr->getPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getPass()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['login'])) {
				$lVr->setValid(false);
				$lVr->getLogin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLogin()->addErreur($lErreur);	
			}
			if(empty($pData['pass'])) {
				$lVr->setValid(false);
				$lVr->getPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPass()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}

}