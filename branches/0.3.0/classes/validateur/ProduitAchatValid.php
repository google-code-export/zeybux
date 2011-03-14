<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : ProduitAchatValid.php
//
// Description : Classe ProduitAchatValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "ProduitAchatVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");

/**
 * @name ProduitAchatVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une ProduitAchatValid
 */
class ProduitAchatValid
{
	/**
	* @name validAjout($pData)
	* @return ProduitAchatVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ProduitAchatVR();
		//Tests Techniques
		if(!is_int((int)$pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['quantite'],0,12)) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}
		if($pData['quantite']	!= '' && !is_float((float)$pData['quantite'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['prix'],0,12)) {
			$lVr->setValid(false);
			$lVr->getPrix()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getPrix()->addErreur($lErreur);	
		}
		if($pData['prix']	!= '' && !is_float((float)$pData['prix'])) {
			$lVr->setValid(false);
			$lVr->getPrix()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
			$lVr->getPrix()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		$lProduit = ProduitManager::select($pData['id']);
		if($lProduit->getId() != $pData['id']) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		
		if(empty($pData['prix']) && !empty($pData['quantite'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_214_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_214_MSG);
			$lVr->getQuantite()->addErreur($lErreur);		
		}
		if(empty($pData['quantite']) && !empty($pData['prix'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_213_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_213_MSG);
			$lVr->getQuantite()->addErreur($lErreur);			
		}
		if($pData['prix'] < 0) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}
		if($pData['quantite'] < 0) {
			$lVr->setValid(false);
			$lVr->getPrix()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
			$lVr->getPrix()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ProduitAchatVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ProduitAchatVR();
		if(!is_int((int)$pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return ProduitAchatVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ProduitAchatVR();
			//Tests Techniques
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['quantite'],0,12)) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['quantite']	!= '' && !is_float((float)$pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['prix'],0,12)) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			if($pData['prix']	!= '' && !is_float((float)$pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			$lProduit = ProduitManager::select($pData['id']);
			if($lProduit->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(empty($pData['prix']) && !empty($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_214_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_214_MSG);
				$lVr->getQuantite()->addErreur($lErreur);		
			}
			if(empty($pData['quantite']) && !empty($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_213_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_213_MSG);
				$lVr->getQuantite()->addErreur($lErreur);			
			}
			if($pData['prix'] < 0) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['quantite'] < 0) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}

}