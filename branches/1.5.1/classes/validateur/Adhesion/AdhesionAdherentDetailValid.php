<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/02/2014
// Fichier : AdhesionAdherentDetailValid.php
//
// Description : Classe AdhesionAdherentDetailValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_ADHESION . "/AdhesionAdherentDetailVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/AdhesionAdherentValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/OperationDetailValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/AdhesionValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/AdherentValid.php");


/**
 * @name AdhesionAdherentDetailValid
 * @author Julien PIERRE
 * @since 06/02/2014
 * @desc Classe représentant une AdhesionAdherentDetailValid
 */
class AdhesionAdherentDetailValid
{
	/**
	 * @name validInfoAjoutAdhesionAdherent($pData)
	 * @return VR
	 * @desc Test la validite de l'élément
	 */
	public static function validInfoAjoutAdhesionAdherent($pData) {
		$lVr = AdhesionValid::validDelete($pData);
		if($lVr->getValid()) {
			return AdherentValid::validAffiche($pData);
		}
		return $lVr;
	}
	
	/**
	* @name validAjout($pData)
	* @return AdhesionAdherentDetailVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new AdhesionAdherentDetailVR();
		//Tests inputs
		if(!isset($pData['adhesionAdherent'])) {
			$lVr->setValid(false);
			$lVr->getAdhesionAdherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getAdhesionAdherent()->addErreur($lErreur);
		}
		if(!isset($pData['operation'])) {
			$lVr->setValid(false);
			$lVr->getOperation()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperation()->addErreur($lErreur);
		}	
		if($lVr->getValid()) {	
			//Tests Fonctionnels
			if(empty($pData['adhesionAdherent'])) {
				$lVr->setValid(false);
				$lVr->getAdhesionAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getAdhesionAdherent()->addErreur($lErreur);	
			} else {
				$lAdhesionAdherent = AdhesionAdherentValid::validAjout($pData['adhesionAdherent']);
				$lVr->setAdhesionAdherent( $lAdhesionAdherent );
				$lVr->setValid($lAdhesionAdherent->getValid());
			}	
			
			if(empty($pData['operation'])) {
				$lVr->setValid(false);
				$lVr->getOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getOperation()->addErreur($lErreur);
			} else {
				$lOperation = OperationDetailValid::validAjout($pData['operation']);
				$lVr->setOperation( $lOperation );
				$lVr->setValid($lAdhesionAdherent->getValid());
			}				
		}
		return $lVr;
	}
	
	/**
	 * @name validUpdate($pData)
	 * @return AdhesionAdherentDetailVR
	 * @desc Test la validite de l'élément
	 */
	public static function validUpdate($pData) {
		$lVr = new AdhesionAdherentDetailVR();
		//Tests inputs
		if(!isset($pData['adhesionAdherent'])) {
			$lVr->setValid(false);
			$lVr->getAdhesionAdherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getAdhesionAdherent()->addErreur($lErreur);
		}
		if(!isset($pData['operation'])) {
			$lVr->setValid(false);
			$lVr->getOperation()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperation()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Fonctionnels
			if(empty($pData['adhesionAdherent'])) {
				$lVr->setValid(false);
				$lVr->getAdhesionAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getAdhesionAdherent()->addErreur($lErreur);
			} else {
				$lAdhesionAdherent = AdhesionAdherentValid::validUpdate($pData['adhesionAdherent']);
				$lVr->setAdhesionAdherent( $lAdhesionAdherent );
				$lVr->setValid($lAdhesionAdherent->getValid());
			}
			
			if(empty($pData['operation'])) {
				$lVr->setValid(false);
				$lVr->getOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getOperation()->addErreur($lErreur);
			} else {				
				$lOperation = OperationDetailValid::validUpdate($pData['operation']);
				$lVr->setOperation( $lOperation );
				$lVr->setValid($lAdhesionAdherent->getValid());
			}
			
		}
		return $lVr;
	}
	
	/**
	 * @name validDelete($pData)
	 * @return AdhesionAdherentDetailVR
	 * @desc Test la validite de l'élément
	 */
	public static function validDelete($pData) {
		$lVr = new AdhesionAdherentDetailVR();
		//Tests inputs
		if(!isset($pData['adhesionAdherent'])) {
			$lVr->setValid(false);
			$lVr->getAdhesionAdherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getAdhesionAdherent()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Fonctionnels
			if(empty($pData['adhesionAdherent'])) {
				$lVr->setValid(false);
				$lVr->getAdhesionAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getAdhesionAdherent()->addErreur($lErreur);
			} else {
				$lAdhesionAdherent = AdhesionAdherentValid::validDelete($pData['adhesionAdherent']);
				$lVr->setAdhesionAdherent( $lAdhesionAdherent );
				$lVr->setValid($lAdhesionAdherent->getValid());
			}
		}
		return $lVr;
	}
}
?>