<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/01/2012
// Fichier : MailingListeValid.php
//
// Description : Classe MailingListeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "/MailingListeVR.php" );

/**
 * @name MailingListeValid
 * @author Julien PIERRE
 * @since 23/01/2012
 * @desc Classe représentant une MailingListeValid
 */
class MailingListeValid
{
	/**
	* @name validAjout($pMail)
	* @return MailingListeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pMail) {
		$lVr = new MailingListeVR();
		//Tests Techniques	
		if(!isset($pMail)) {
			$lVr->setValid(false);
			$lVr->getMail()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMail()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {		
			if(!TestFonction::checkLength($pMail,0,100)) {
				$lVr->setValid(false);
				$lVr->getMail()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMail()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pMail)) {
				$lVr->setValid(false);
				$lVr->getMail()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMail()->addErreur($lErreur);	
			}
			
			if(!TestFonction::checkCourriel($pMail)) {
				$lVr->setValid(false);
				$lVr->getMail()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_224_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_224_MSG);
				$lVr->getMail()->addErreur($lErreur);
			}	
		}
		return $lVr;
	}
}
?>