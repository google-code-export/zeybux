<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/06/2014
// Fichier : OperationRemiseChequeValid.php
//
// Description : Classe OperationRemiseChequeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ZEYBU . "/OperationRemiseChequeVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "RemiseChequeService.php" );

/**
 * @name OperationRemiseChequeValid
 * @author Julien PIERRE
 * @since 19/06/2014
 * @desc Classe représentant une OperationRemiseChequeValid
 */
class OperationRemiseChequeValid
{	
	/**
	 * @name validDelete($pData)
	 * @return OperationRemiseChequeVR
	 * @desc Test la validite de l'élément
	 */
	public static function validDelete($pData) {
		$lVr = new OperationRemiseChequeVR();
		//Tests inputs
		if(!isset($pData['idRemiseCheque'])) {
			$lVr->setValid(false);
			$lVr->getIdRemiseCheque()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdRemiseCheque()->addErreur($lErreur);
		}
		if(!isset($pData['idOperation'])) {
			$lVr->setValid(false);
			$lVr->getIdOperation()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdOperation()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['idRemiseCheque'])) {
				$lVr->setValid(false);
				$lVr->getIdRemiseCheque()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdRemiseCheque()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idRemiseCheque'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdRemiseCheque()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdRemiseCheque()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idOperation'])) {
				$lVr->setValid(false);
				$lVr->getIdOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdOperation()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idOperation'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdOperation()->addErreur($lErreur);	
			}
				
			//Tests Fonctionnels
			//L'id ne doit pas être vide
			if(empty($pData['idRemiseCheque']) ) {
				$lVr->setValid(false);
				$lVr->getIdRemiseCheque()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdRemiseCheque()->addErreur($lErreur);
			}
			if(empty($pData['idOperation']) ) {
				$lVr->setValid(false);
				$lVr->getIdOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdOperation()->addErreur($lErreur);
			}
			
			// Test si la remise existe
			$lRemiseChequeService = new RemiseChequeService();
			if(!$lRemiseChequeService->lienOperationRemiseExiste($pData['idRemiseCheque'],$pData['idOperation'])) {
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