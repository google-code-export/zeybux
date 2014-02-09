<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : TypeAdhesionValid.php
//
// Description : Classe TypeAdhesionValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_ADHESION . "/TypeAdhesionVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "TypeAdhesionManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "PerimetreAdhesionManager.php");


/**
 * @name TypeAdhesionValid
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une TypeAdhesionValid
 */
class TypeAdhesionValid
{
	/**
	* @name validAjout($pData)
	* @return TypeAdhesionVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new TypeAdhesionVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
		if(!isset($pData['idAdhesion'])) {
			$lVr->setValid(false);
			$lVr->getIdAdhesion()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdAdhesion()->addErreur($lErreur);
		}
		if(!isset($pData['label'])) {
			$lVr->setValid(false);
			$lVr->getLabel()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLabel()->addErreur($lErreur);
		}
		if(!isset($pData['idPerimetre'])) {
			$lVr->setValid(false);
			$lVr->getIdPerimetre()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdPerimetre()->addErreur($lErreur);
		}
		if(!isset($pData['montant'])) {
			$lVr->setValid(false);
			$lVr->getMontant()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontant()->addErreur($lErreur);
		}	
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['label'],0,45)) {
				$lVr->setValid(false);
				$lVr->getLabel()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getLabel()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idPerimetre'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdPerimetre()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdPerimetre()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['idPerimetre'])) {
				$lVr->setValid(false);
				$lVr->getIdPerimetre()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdPerimetre()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['montant'],0,12)) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			if(!is_float((float)$pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
	
			//Tests Fonctionnels
			if(empty($pData['label'])) {
				$lVr->setValid(false);
				$lVr->getLabel()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLabel()->addErreur($lErreur);	
			}
			if(empty($pData['idPerimetre'])) {
				$lVr->setValid(false);
				$lVr->getIdPerimetre()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdPerimetre()->addErreur($lErreur);	
			}
			if(empty($pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			
			$lPerimetreAdhesion = PerimetreAdhesionManager::select( $pData['idPerimetre'] );
			if($lPerimetreAdhesion->getId() != $pData['idPerimetre']) {
				$lVr->setValid(false);
				$lVr->getIdPerimetre()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdPerimetre()->addErreur($lErreur);
			}
			if($pData['montant'] < 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}		
		}
		return $lVr;
	}

	/**
	 * @name validUpdate($pData)
	 * @return TypeAdhesionVR
	 * @desc Test la validite de l'élément
	 */
	public static function validUpdate($pData) {
		$lVr = TypeAdhesionValid::validDelete($pData);
		if($lVr->getValid()) {
			$lVr = TypeAdhesionValid::validAjout($pData);
		}
		return $lVr;
	}
	
	/**
	* @name validDelete($pData)
	* @return TypeAdhesionVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new TypeAdhesionVR();
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
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			// Vérifie si l'adhérent existe
			$lTypeAdhesion = TypeAdhesionManager::select( $pData['id'] );
			if($lTypeAdhesion->getId() != $pData['id']) {
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