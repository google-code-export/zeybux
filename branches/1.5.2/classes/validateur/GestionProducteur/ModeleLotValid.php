<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : ModeleLotValid.php
//
// Description : Classe ModeleLotValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_PRODUCTEUR . "/ModeleLotVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModeleLotManager.php");

/**
 * @name ModeleLotValid
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une ModeleLotValid
 */
class ModeleLotValid
{
	/**
	* @name validAjout($pData)
	* @return ModeleLotVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ModeleLotVR();
		//Tests inputs
		if(!isset($pData['quantite'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}
		if(!isset($pData['unite'])) {
			$lVr->setValid(false);
			$lVr->getUnite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getUnite()->addErreur($lErreur);	
		}
		if(!isset($pData['prix'])) {
			$lVr->setValid(false);
			$lVr->getPrix()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getPrix()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['quantite'],0,12) || $pData['quantite'] > 999999999.99) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['unite'],0,20)) {
					$lVr->setValid(false);
					$lVr->getUnite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getUnite()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['prix'],0,12) || $pData['prix'] > 999999999.99) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			if(empty($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(empty($pData['unite'])) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
			}
			if(empty($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			
			if($pData['quantite'] > 9999999999.99) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['prix']  > 9999999999.99) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
			}
			
			if($pData['quantite'] <= 0) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['prix']  <= 0) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
			}
		}		
		return $lVr;
	}
	
	/**
	* @name validSet($pData)
	* @return ModeleLotVR
	* @desc Test la validite de l'élément
	*/
	public static function validSet($pData) {
		$lVr = new ModeleLotVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			//Tests Techniques
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
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			if(!empty($pData['id'])) { // Si c'est un update l'id doit exister
				$lModeleLot = ModeleLotManager::select($pData['id']);
				if($lModeleLot->getId() != $pData['id']) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId()->addErreur($lErreur);
				}
			}
			
			return ModeleLotValid::validAjout($pData);
		}
		return $lVr;
	}
}
?>