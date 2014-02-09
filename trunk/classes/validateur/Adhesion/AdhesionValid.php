<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : AdhesionValid.php
//
// Description : Classe AdhesionValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
//include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_ADHESION . "/AdhesionVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "AdhesionManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/TypeAdhesionValid.php");


/**
 * @name AdhesionValid
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une AdhesionValid
 */
class AdhesionValid
{
	/**
	* @name validAjout($pData)
	* @return AdhesionVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new AdhesionVR();
		//Tests inputs
		if(!isset($pData['label'])) {
			$lVr->setValid(false);
			$lVr->getLabel()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLabel()->addErreur($lErreur);
		}
		if(!isset($pData['dateDebut'])) {
			$lVr->setValid(false);
			$lVr->getDateDebut()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDateDebut()->addErreur($lErreur);
		}
		if(!isset($pData['dateFin'])) {
			$lVr->setValid(false);
			$lVr->getDateFin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDateFin()->addErreur($lErreur);
		}
		if(!isset($pData['types'])) {
			$lVr->setValid(false);
			$lVr->getTypes()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getTypes()->addErreur($lErreur);
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
			if(!TestFonction::checkDate($pData['dateDebut'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateDebut()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
				$lVr->getDateDebut()->addErreur($lErreur);	
			}
			if(!TestFonction::checkDateExist($pData['dateDebut'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateDebut()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
				$lVr->getDateDebut()->addErreur($lErreur);	
			}
			if(!TestFonction::checkDate($pData['dateFin'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
				$lVr->getDateFin()->addErreur($lErreur);	
			}
			if(!TestFonction::checkDateExist($pData['dateFin'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
				$lVr->getDateFin()->addErreur($lErreur);	
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
			if(empty($pData['dateDebut'])) {
				$lVr->setValid(false);
				$lVr->getDateDebut()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDateDebut()->addErreur($lErreur);	
			}
			if(empty($pData['dateFin'])) {
				$lVr->setValid(false);
				$lVr->getDateFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDateFin()->addErreur($lErreur);	
			}
			if(empty($pData['types'])) {
				$lVr->setValid(false);
				$lVr->getTypes()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTypes()->addErreur($lErreur);
			}
			
			if(!TestFonction::dateEstPLusGrandeEgale($pData['dateFin'], $pData['dateDebut'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateDebut()->setValid(false);
				$lVr->getDateFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_252_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_252_MSG);
				$lVr->getDateDebut()->addErreur($lErreur);
				$lVr->getDateFin()->addErreur($lErreur);
			}
			
			if(!is_array($pData['types'])) {
				$lVr->setValid(false);
				$lVr->getTypes()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getTypes()->addErreur($lErreur);
			} else {
				foreach($pData['types'] as $lType) {
					if(!is_null($lType)) {
						if(isset($lType['id'])) {
							if(empty($lType['id'])) {
								$lVrType = TypeAdhesionValid::validAjout($lType);
							} else {
								$lVrType = TypeAdhesionValid::validUpdate($lType);
							}
							if(!$lVrType->getValid()){
								$lVr->setValid(false);
							}
							$lVr->addTypes($lVrType);
						} else {
							$lVr->setValid(false);
						}
					}
				}
			}			
		}
		return $lVr;
	}
	/**
	 * @name validUpdate($pData)
	 * @return AdhesionVR
	 * @desc Test la validite de l'élément
	 */
	public static function validUpdate($pData) {
		$lVr = AdhesionValid::validDelete($pData);
		if($lVr->getValid()) {
			$lVr = AdhesionValid::validAjout($pData);
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return AdhesionVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new AdhesionVR();
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
			$lAdhesion = AdhesionManager::select( $pData['id'] );
			if($lAdhesion->getId() != $pData['id']) {
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