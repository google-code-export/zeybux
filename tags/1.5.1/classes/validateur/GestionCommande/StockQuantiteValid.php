<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/04/2013
// Fichier : StockQuantiteValid.php
//
// Description : Classe StockQuantiteValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/StockQuantiteVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "StockQuantiteManager.php");

/**
 * @name StockQuantiteVR
 * @author Julien PIERRE
 * @since 30/04/2013
 * @desc Classe représentant une StockQuantiteValid
 */
class StockQuantiteValid
{
	/**
	* @name validAjout($pData)
	* @return StockQuantiteVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new StockQuantiteVR();
		//Tests inputs
		if(!isset($pData['quantite'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}
		if(!isset($pData['quantiteSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getQuantiteSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
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
			if(!TestFonction::checkLength($pData['quantiteSolidaire'],0,12) || $pData['quantiteSolidaire'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getQuantiteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['quantiteSolidaire'])) {
				$lVr->setValid(false);
				$lVr->getQuantiteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if($pData['quantite'] != 0 && empty($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['quantiteSolidaire'] != 0 && empty($pData['quantiteSolidaire'])) {
				$lVr->setValid(false);
				$lVr->getQuantiteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return StockQuantiteVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new StockQuantiteVR();
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
			
			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			
			$lStockQuantite = StockQuantiteManager::select($pData['id']);
			if($lStockQuantite->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return StockQuantiteVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = StockQuantiteValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new StockQuantiteVR();
			//Tests inputs
			if(!isset($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(!isset($pData['quantiteSolidaire'])) {
				$lVr->setValid(false);
				$lVr->getQuantiteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
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
				if(!TestFonction::checkLength($pData['quantiteSolidaire'],0,12) || $pData['quantiteSolidaire'] > 999999999.99) {
					$lVr->setValid(false);
					$lVr->getQuantiteSolidaire()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['quantiteSolidaire'])) {
					$lVr->setValid(false);
					$lVr->getQuantiteSolidaire()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
				}

				//Tests Fonctionnels
				if($pData['quantite'] != 0 && empty($pData['quantite'])) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
				}
				if($pData['quantiteSolidaire'] != 0 && empty($pData['quantiteSolidaire'])) {
					$lVr->setValid(false);
					$lVr->getQuantiteSolidaire()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
				}
			}
			return $lVr;
		}
		return $lTestId;
	}

}?>