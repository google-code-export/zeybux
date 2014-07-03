<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/06/2014
// Fichier : RemiseChequeValid.php
//
// Description : Classe RemiseChequeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ZEYBU . "/RemiseChequeVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "RemiseChequeService.php" );

/**
 * @name RemiseChequeValid
 * @author Julien PIERRE
 * @since 19/06/2014
 * @desc Classe représentant une RemiseChequeValid
 */
class RemiseChequeValid
{
	/**
	 * @name validAjout($pData)
	 * @return RemiseChequeVR
	 * @desc Test la validite de l'élément
	 */
	public static function validAjout($pData) {
		$lVr = new RemiseChequeVR();
		//Tests inputs
		if(!isset($pData['operations'])) {
			$lVr->setValid(false);
			$lVr->getOperations()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperations()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques	
			if(!is_array($pData['operations']) ) {
				$lVr->setValid(false);
				$lVr->getOperations()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getOperations()->addErreur($lErreur);
			}
			
			//Tests Fonctionnels
			//La liste d'opération ne doit pas être vide
			if(empty($pData['operations']) ) {
				$lVr->setValid(false);
				$lVr->getOperations()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getOperations()->addErreur($lErreur);
			}
			
			if($lVr->getValid()) {
				// Creation de lla liste des id
				$lIdOperation = array();
				foreach($pData['operations'] as $lOperation) {
					array_push($lIdOperation, $lOperation['id']);
				}
				
				// Récupération des operations
				$lOperationService = new OperationService();
				$lOperations = $lOperationService->getByArray($lIdOperation);
				
				// Vérifie pour chaque ID que l'operation Existe
				foreach($lIdOperation as $lId) {
					$lExiste = false;
					foreach($lOperations as $lOperation) {
						if($lOperation->getId() == $lId) {
							$lExiste = true;
						}
					}
					// Si une des opération n'existe pas afficher l'erreur
					if(!$lExiste) {
						$lVr->setValid(false);
						$lOperationErreur = new VRelement();
						$lOperationErreur->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
						$lOperationErreur->addErreur($lErreur);
						
						$lVrOperations = $lVr->getOperations();
						$lVrOperations[$lId] = $lOperationErreur;
						
						$lVr->setOperation($lVrOperations);
					}					
				}
				
				$lRemiseChequeService = new RemiseChequeService();
				if($lRemiseChequeService->operationDejaSurRemise($lIdOperation) ) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_273_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_273_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
				
			}			
		}
		return $lVr;
	}
	
	/**
	 * @name validDelete($pData)
	 * @return RemiseChequeVR
	 * @desc Test la validite de l'élément
	 */
	public static function validDelete($pData) {
		$lVr = new RemiseChequeVR();
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
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
				
			//Tests Fonctionnels
			//L'id ne doit pas être vide
			if(empty($pData['id']) ) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			
			// Test si la remise existe
			$lRemiseChequeService = new RemiseChequeService();
			if(!$lRemiseChequeService->existe($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
	
	/**
	 * @name validAjoutOperation($pData)
	 * @return RemiseChequeVR
	 * @desc Test la validite de l'élément
	 */
	public static function validAjoutOperation($pData) {
		// Test si la remise existe
		$lVr = new RemiseChequeVR();
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
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
		
			//Tests Fonctionnels
			//L'id ne doit pas être vide
			if(empty($pData['id']) ) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
				
			// Test si la remise existe
			$lRemiseChequeService = new RemiseChequeService();
			$lRemiseCheque = $lRemiseChequeService->get($pData['id']);
			if($lRemiseCheque->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			
			// La remise doit appartenir au compte
			if($lRemiseCheque->getIdCompte() != -1) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			
			if($lVr->getValid()) {
				// Test les operations
				$lVr = RemiseChequeValid::validAjout($pData);
			}
		}
		return $lVr;
	}
}
?>