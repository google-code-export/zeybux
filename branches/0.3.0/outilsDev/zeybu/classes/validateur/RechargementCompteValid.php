<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : RechargementCompteValid.php
//
// Description : Classe RechargementCompteValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "RechargementCompteVR.php" );

/**
 * @name RechargementCompteVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une RechargementCompteValid
 */
class RechargementCompteValid
{
	/**
	* @name validAjout($pData)
	* @return RechargementCompteVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new RechargementCompteVR();
		//Tests Techniques
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
		if(!TestFonction::checkLength($pData['typePaiement'],0,11)) {
			$lVr->setValid(false);
			$lVr->getTypePaiement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getTypePaiement()->addErreur($lErreur);	
		}
		if(!is_int((int)$pData['typePaiement'])) {
			$lVr->setValid(false);
			$lVr->getTypePaiement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getTypePaiement()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['champComplementaireObligatoire'],0,1)) {
			$lVr->setValid(false);
			$lVr->getChampComplementaireObligatoire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getChampComplementaireObligatoire()->addErreur($lErreur);	
		}
		if(!is_int((int)$pData['champComplementaireObligatoire'])) {
			$lVr->setValid(false);
			$lVr->getChampComplementaireObligatoire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getChampComplementaireObligatoire()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['champComplementaire'],0,50)) {
			$lVr->setValid(false);
			$lVr->getChampComplementaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getChampComplementaire()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['montant'])) {
			$lVr->setValid(false);
			$lVr->getMontant()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontant()->addErreur($lErreur);	
		}
		if(empty($pData['typePaiement'])) {
			$lVr->setValid(false);
			$lVr->getTypePaiement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getTypePaiement()->addErreur($lErreur);	
		}
		if(empty($pData['champComplementaireObligatoire'])) {
			$lVr->setValid(false);
			$lVr->getChampComplementaireObligatoire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getChampComplementaireObligatoire()->addErreur($lErreur);	
		}
		if(empty($pData['champComplementaire'])) {
			$lVr->setValid(false);
			$lVr->getChampComplementaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getChampComplementaire()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return RechargementCompteVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new RechargementCompteVR();
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
	* @return RechargementCompteVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new RechargementCompteVR();
			//Tests Techniques
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
			if(!TestFonction::checkLength($pData['typePaiement'],0,11)) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['typePaiement'])) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['champComplementaireObligatoire'],0,1)) {
				$lVr->setValid(false);
				$lVr->getChampComplementaireObligatoire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getChampComplementaireObligatoire()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['champComplementaireObligatoire'])) {
				$lVr->setValid(false);
				$lVr->getChampComplementaireObligatoire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getChampComplementaireObligatoire()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['champComplementaire'],0,50)) {
				$lVr->setValid(false);
				$lVr->getChampComplementaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getChampComplementaire()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if(empty($pData['typePaiement'])) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);	
			}
			if(empty($pData['champComplementaireObligatoire'])) {
				$lVr->setValid(false);
				$lVr->getChampComplementaireObligatoire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getChampComplementaireObligatoire()->addErreur($lErreur);	
			}
			if(empty($pData['champComplementaire'])) {
				$lVr->setValid(false);
				$lVr->getChampComplementaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getChampComplementaire()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}

}