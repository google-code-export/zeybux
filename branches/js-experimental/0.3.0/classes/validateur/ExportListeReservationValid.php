<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/01/2011
// Fichier : ExportListeReservationValid.php
//
// Description : Classe ExportListeReservationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "ExportListeReservationVR.php" );

/**
 * @name ExportListeReservationVR
 * @author Julien PIERRE
 * @since 02/01/2011
 * @desc Classe représentant une ExportListeReservationValid
 */
class ExportListeReservationValid
{
	/**
	* @name validAjout($pData)
	* @return ExportListeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ExportListeReservationVR();
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
		if(!is_array($pData['id_produits'])) {
			$lVr->setValid(false);
			$lVr->getId_produits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
			$lVr->getId_produits()->addErreur($lErreur);	
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
		if(empty($pData['id_produits'])) {
			$lVr->setValid(false);
			$lVr->getId_produits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_233_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_233_MSG);
			$lVr->getId_produits()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ExportListeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ExportListeReservationVR();
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
	* @return ExportListeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = ExportListeReservationValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ExportListeReservationVR();
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
			if(!is_array($pData['id_produits'])) {
				$lVr->setValid(false);
				$lVr->getId_produits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getId_produits()->addErreur($lErreur);	
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
			if(empty($pData['id_produits'])) {
				$lVr->setValid(false);
				$lVr->getId_produits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_233_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_233_MSG);
				$lVr->getId_produits()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}

}