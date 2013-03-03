<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : ReservationCommandeValid.php
//
// Description : Classe ReservationCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "ReservationCommandeVR.php" );

/**
 * @name ReservationCommandeVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une ReservationCommandeValid
 */
class ReservationCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return ReservationCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ReservationCommandeVR();
		//Tests Techniques
		if(!TestFonction::checkLength($pData['stoQuantite'],0,12)) {
			$lVr->setValid(false);
			$lVr->getStoQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getStoQuantite()->addErreur($lErreur);	
		}
		if(!is_int((int)$pData['stoQuantite'])) {
			$lVr->setValid(false);
			$lVr->getStoQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getStoQuantite()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['stoIdProduit'],0,11)) {
			$lVr->setValid(false);
			$lVr->getStoIdProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getStoIdProduit()->addErreur($lErreur);	
		}
		if(!is_int((int)$pData['stoIdProduit'])) {
			$lVr->setValid(false);
			$lVr->getStoIdProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getStoIdProduit()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['stoQuantite'])) {
			$lVr->setValid(false);
			$lVr->getStoQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getStoQuantite()->addErreur($lErreur);	
		}
		if(empty($pData['stoIdProduit'])) {
			$lVr->setValid(false);
			$lVr->getStoIdProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getStoIdProduit()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ReservationCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ReservationCommandeVR();
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
	* @return ReservationCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ReservationCommandeVR();
			//Tests Techniques
			if(!TestFonction::checkLength($pData['stoQuantite'],0,12)) {
				$lVr->setValid(false);
				$lVr->getStoQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getStoQuantite()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['stoQuantite'])) {
				$lVr->setValid(false);
				$lVr->getStoQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getStoQuantite()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['stoIdProduit'],0,11)) {
				$lVr->setValid(false);
				$lVr->getStoIdProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getStoIdProduit()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['stoIdProduit'])) {
				$lVr->setValid(false);
				$lVr->getStoIdProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getStoIdProduit()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['stoQuantite'])) {
				$lVr->setValid(false);
				$lVr->getStoQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStoQuantite()->addErreur($lErreur);	
			}
			if(empty($pData['stoIdProduit'])) {
				$lVr->setValid(false);
				$lVr->getStoIdProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStoIdProduit()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}

}