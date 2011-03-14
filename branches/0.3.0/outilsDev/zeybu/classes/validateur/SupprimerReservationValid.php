<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/01/2011
// Fichier : SupprimerReservationValid.php
//
// Description : Classe SupprimerReservationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "SupprimerReservationVR.php" );

/**
 * @name SupprimerReservationVR
 * @author Julien PIERRE
 * @since 26/01/2011
 * @desc Classe représentant une SupprimerReservationValid
 */
class SupprimerReservationValid
{
	/**
	* @name validAjout($pData)
	* @return SupprimerReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new SupprimerReservationVR();
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getId_commande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getId_commande()->addErreur($lErreur);	
		}
		if(!isset($pData['id_adherent'])) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id_commande'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['id_adherent'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId_adherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_adherent()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_adherent'])) {
				$lVr->setValid(false);
				$lVr->getId_adherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId_adherent()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(empty($pData['id_adherent'])) {
				$lVr->setValid(false);
				$lVr->getId_adherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_adherent()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return SupprimerReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new SupprimerReservationVR();
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
	* @return SupprimerReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = SupprimerReservationValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new SupprimerReservationVR();
			//Tests inputs
			if(!isset($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(!isset($pData['id_adherent'])) {
				$lVr->setValid(false);
				$lVr->getId_adherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_adherent()->addErreur($lErreur);	
			}

			if($lVr->getValid()) {
			//Tests Techniques
				if(!TestFonction::checkLength($pData['id_commande'],0,11)) {
					$lVr->setValid(false);
					$lVr->getId_commande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getId_commande()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['id_commande'])) {
					$lVr->setValid(false);
					$lVr->getId_commande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getId_commande()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['id_adherent'],0,11)) {
					$lVr->setValid(false);
					$lVr->getId_adherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getId_adherent()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['id_adherent'])) {
					$lVr->setValid(false);
					$lVr->getId_adherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getId_adherent()->addErreur($lErreur);	
				}

				//Tests Fonctionnels
				if(empty($pData['id_commande'])) {
					$lVr->setValid(false);
					$lVr->getId_commande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId_commande()->addErreur($lErreur);	
				}
				if(empty($pData['id_adherent'])) {
					$lVr->setValid(false);
					$lVr->getId_adherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId_adherent()->addErreur($lErreur);	
				}
			}
			return $lVr;
		}
		return $lTestId;
	}

}