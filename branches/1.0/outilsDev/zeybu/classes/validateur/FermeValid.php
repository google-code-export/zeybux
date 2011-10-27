<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : FermeValid.php
//
// Description : Classe FermeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "FermeVR.php" );

/**
 * @name FermeVR
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une FermeValid
 */
class FermeValid
{
	/**
	* @name validAjout($pData)
	* @return FermeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new FermeVR();
		//Tests inputs

		if($lVr->getValid()) {
			//Tests Techniques

			//Tests Fonctionnels
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return FermeVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new FermeVR();
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
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return FermeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = FermeValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new FermeVR();
			//Tests inputs

			if($lVr->getValid()) {
			//Tests Techniques

				//Tests Fonctionnels
			}
			return $lVr;
		}
		return $lTestId;
	}

}