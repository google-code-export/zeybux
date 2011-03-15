<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/08/2010
// Fichier : testValid.php
//
// Description : Classe testValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "testVR.php" );

/**
 * @name testVR
 * @author Julien PIERRE
 * @since 27/08/2010
 * @desc Classe représentant une testValid
 */
class testValid
{
	/**
	* @name validAjout($pData)
	* @return testVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVR = new testVR();
		//Tests Techniques
		if(!TestFonction::checkLength($pData['toto'],0,12)) {
			$lVr->setValid(false);
			$lVr->getToto()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getToto()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['tata'],0,11)) {
			$lVr->setValid(false);
			$lVr->getTata()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getTata()->addErreur($lErreur);	
		}
		if(!is_int(intval($pData['tata']))) {
			$lVr->setValid(false);
			$lVr->getTata()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_108_CODE);
			$lErreur->setMessage(ERR_108_MSG);
			$lVr->getTata()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['titi'],0,33)) {
			$lVr->setValid(false);
			$lVr->getTiti()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getTiti()->addErreur($lErreur);	
		}
		if(!TestFonction::checkCourriel($pData['titi'])) {
			$lVr->setValid(false);
			$lVr->getTiti()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_102_CODE);
			$lErreur->setMessage(ERR_102_MSG);
			$lVr->getTiti()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['float'],0,5)) {
			$lVr->setValid(false);
			$lVr->getFloat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getFloat()->addErreur($lErreur);	
		}
		if(!is_float(floatval($pData['float']))) {
			$lVr->setValid(false);
			$lVr->getFloat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_109_CODE);
			$lErreur->setMessage(ERR_109_MSG);
			$lVr->getFloat()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['mail'],0,20)) {
			$lVr->setValid(false);
			$lVr->getMail()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getMail()->addErreur($lErreur);	
		}
		if(!TestFonction::checkDate($pData['date'],'db')) {
			$lVr->setValid(false);
			$lVr->getDate()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_103_CODE);
			$lErreur->setMessage(ERR_103_MSG);
			$lVr->getDate()->addErreur($lErreur);	
		}
		if(!TestFonction::checkDateExist($pData['date'],'db')) {
			$lVr->setValid(false);
			$lVr->getDate()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_105_CODE);
			$lErreur->setMessage(ERR_105_MSG);
			$lVr->getDate()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['toto'])) {
			$lVr->setValid(false);
			$lVr->getToto()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getToto()->addErreur($lErreur);	
		}
		if(empty($pData['tata'])) {
			$lVr->setValid(false);
			$lVr->getTata()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTata()->addErreur($lErreur);	
		}
		if(empty($pData['titi'])) {
			$lVr->setValid(false);
			$lVr->getTiti()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTiti()->addErreur($lErreur);	
		}
		if(empty($pData['float'])) {
			$lVr->setValid(false);
			$lVr->getFloat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getFloat()->addErreur($lErreur);	
		}
		if(empty($pData['mail'])) {
			$lVr->setValid(false);
			$lVr->getMail()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getMail()->addErreur($lErreur);	
		}
		if(empty($pData['date'])) {
			$lVr->setValid(false);
			$lVr->getDate()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getDate()->addErreur($lErreur);	
		}
		if(empty($pData['tab'])) {
			$lVr->setValid(false);
			$lVr->getTab()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTab()->addErreur($lErreur);	
		}
		return $lVR;
	}

	/**
	* @name validDelete($pData)
	* @return testVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVR = new testVR();
		if(!is_int(intval($pData['id']))) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_104_CODE);
			$lErreur->setMessage(ERR_104_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		return lVR;
	}

	/**
	* @name validUpdate($pData)
	* @return testVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVR = new testVR();
			//Tests Techniques
		if(!TestFonction::checkLength($pData['toto'],0,12)) {
			$lVr->setValid(false);
			$lVr->getToto()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getToto()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['tata'],0,11)) {
			$lVr->setValid(false);
			$lVr->getTata()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getTata()->addErreur($lErreur);	
		}
		if(!is_int(intval($pData['tata']))) {
			$lVr->setValid(false);
			$lVr->getTata()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_108_CODE);
			$lErreur->setMessage(ERR_108_MSG);
			$lVr->getTata()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['titi'],0,33)) {
			$lVr->setValid(false);
			$lVr->getTiti()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getTiti()->addErreur($lErreur);	
		}
		if(!TestFonction::checkCourriel($pData['titi'])) {
			$lVr->setValid(false);
			$lVr->getTiti()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_102_CODE);
			$lErreur->setMessage(ERR_102_MSG);
			$lVr->getTiti()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['float'],0,5)) {
			$lVr->setValid(false);
			$lVr->getFloat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getFloat()->addErreur($lErreur);	
		}
		if(!is_float(floatval($pData['float']))) {
			$lVr->setValid(false);
			$lVr->getFloat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_109_CODE);
			$lErreur->setMessage(ERR_109_MSG);
			$lVr->getFloat()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['mail'],0,20)) {
			$lVr->setValid(false);
			$lVr->getMail()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_101_CODE);
			$lErreur->setMessage(ERR_101_MSG);
			$lVr->getMail()->addErreur($lErreur);	
		}
		if(!TestFonction::checkDate($pData['date'],'db')) {
			$lVr->setValid(false);
			$lVr->getDate()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_103_CODE);
			$lErreur->setMessage(ERR_103_MSG);
			$lVr->getDate()->addErreur($lErreur);	
		}
		if(!TestFonction::checkDateExist($pData['date'],'db')) {
			$lVr->setValid(false);
			$lVr->getDate()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_105_CODE);
			$lErreur->setMessage(ERR_105_MSG);
			$lVr->getDate()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['toto'])) {
			$lVr->setValid(false);
			$lVr->getToto()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getToto()->addErreur($lErreur);	
		}
		if(empty($pData['tata'])) {
			$lVr->setValid(false);
			$lVr->getTata()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTata()->addErreur($lErreur);	
		}
		if(empty($pData['titi'])) {
			$lVr->setValid(false);
			$lVr->getTiti()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTiti()->addErreur($lErreur);	
		}
		if(empty($pData['float'])) {
			$lVr->setValid(false);
			$lVr->getFloat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getFloat()->addErreur($lErreur);	
		}
		if(empty($pData['mail'])) {
			$lVr->setValid(false);
			$lVr->getMail()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getMail()->addErreur($lErreur);	
		}
		if(empty($pData['date'])) {
			$lVr->setValid(false);
			$lVr->getDate()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getDate()->addErreur($lErreur);	
		}
		if(empty($pData['tab'])) {
			$lVr->setValid(false);
			$lVr->getTab()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTab()->addErreur($lErreur);	
		}
		return $lVR;
		}
		return $lTestId;
	}

}