<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/06/2014
// Fichier : InformationBancaireValid.php
//
// Description : Classe InformationBancaireValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ASSOCIATION . "/InformationBancaireVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );

/**
 * @name InformationBancaireValid
 * @author Julien PIERRE
 * @since 19/06/2014
 * @desc Classe représentant une InformationBancaireValid
 */
class InformationBancaireValid
{	
	/**
	 * @name validAjout($pData)
	 * @return InformationBancaireVR
	 * @desc Test la validite de l'élément
	 */
	public static function validDelete($pData) {
		$lVr = new InformationBancaireVR();
		//Tests inputs
		if(!isset($pData['numeroCompte'])) {
			$lVr->setValid(false);
			$lVr->getNumeroCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getNumeroCompte()->addErreur($lErreur);
		}
		if(!isset($pData['raisonSociale'])) {
			$lVr->setValid(false);
			$lVr->getRaisonSociale()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getRaisonSociale()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['numeroCompte'])) {
				$lVr->setValid(false);
				$lVr->getNumeroCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getNumeroCompte()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['numeroCompte'],0,11)) {
				$lVr->setValid(false);
				$lVr->getNumeroCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getNumeroCompte()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['raisonSociale'],0,100)) {
				$lVr->setValid(false);
				$lVr->getRaisonSociale()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getRaisonSociale()->addErreur($lErreur);	
			}
				
			//Tests Fonctionnels
			if(empty($pData['numeroCompte']) ) {
				$lVr->setValid(false);
				$lVr->getNumeroCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getNumeroCompte()->addErreur($lErreur);
			}
			if(empty($pData['raisonSociale']) ) {
				$lVr->setValid(false);
				$lVr->getRaisonSociale()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getRaisonSociale()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
}
?>