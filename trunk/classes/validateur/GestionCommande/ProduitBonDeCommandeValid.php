<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/01/2011
// Fichier : ProduitBonDeCommandeValid.php
//
// Description : Classe ProduitBonDeCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ProduitBonDeCommandeVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

/**
 * @name ProduitBonDeCommandeVR
 * @author Julien PIERRE
 * @since 18/01/2011
 * @desc Classe représentant une ProduitBonDeCommandeValid
 */
class ProduitBonDeCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return ProduitBonDeCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ProduitBonDeCommandeVR();
		//Tests inputs		
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}	
		if(!isset($pData['dcomId'])) {
			$lVr->setValid(false);
			$lVr->getDcomId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDcomId()->addErreur($lErreur);	
		}
		if(!isset($pData['quantite'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}
		if(!isset($pData['prix'])) {
			$lVr->setValid(false);
			$lVr->getPrix()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPrix()->addErreur($lErreur);	
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
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['dcomId'],0,11)) {
				$lVr->setValid(false);
				$lVr->getDcomId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getDcomId()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['dcomId'])) {
				$lVr->setValid(false);
				$lVr->getDcomId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getDcomId()->addErreur($lErreur);	
			}
			if($pData['quantite'] != '' && (!TestFonction::checkLength($pData['quantite'],0,12) || $pData['quantite'] > 999999999.99)) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['quantite'] != '' && !is_float((float)$pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['prix'] != '' && (!TestFonction::checkLength($pData['prix'],0,12) || $pData['prix'] > 999999999.99)) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			if($pData['prix'] != '' && !is_float((float)$pData['prix'])) {
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
			if(empty($pData['dcomId'])) {
				$lVr->setValid(false);
				$lVr->getDcomId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDcomId()->addErreur($lErreur);	
			}
			if($pData['prix'] != '' && empty($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['quantite'] != '' && empty($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			
			if($pData['quantite'] != '' && $pData['quantite'] < 0) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['prix'] != '' && $pData['prix'] < 0) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			
			$lDcom = DetailCommandeManager::selectByIdProduit($pData["id"]);
			if($lDcom[0]->getIdProduit() != $pData["id"]) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
			
			$lDcom = DetailCommandeManager::select($pData["dcomId"]);
			if($lDcom->getId() != $pData["dcomId"]) {
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

	/**
	* @name validDelete($pData)
	* @return ProduitBonDeCommandeVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validDelete($pData) {
		$lVr = new ProduitBonDeCommandeVR();
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
	* @return ProduitBonDeCommandeVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validUpdate($pData) {
		$lTestId = ProduitBonDeCommandeValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ProduitBonDeCommandeVR();
			//Tests Techniques
			if(!TestFonction::checkLength($pData['quantite'],0,12)) {
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
			if(!TestFonction::checkLength($pData['prix'],0,12)) {
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
			if(empty($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}*/

}
?>