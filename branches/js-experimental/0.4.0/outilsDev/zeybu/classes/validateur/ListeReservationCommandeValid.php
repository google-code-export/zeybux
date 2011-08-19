<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : ListeReservationCommandeValid.php
//
// Description : Classe ListeReservationCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "ListeReservationCommandeVR.php" );

/**
 * @name ListeReservationCommandeVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une ListeReservationCommandeValid
 */
class ListeReservationCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return ListeReservationCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ListeReservationCommandeVR();
		//Tests Techniques
		if(!is_array($pData['commandes'])) {
			$lVr->setValid(false);
			$lVr->getCommandes()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
			$lVr->getCommandes()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['commandes'])) {
			$lVr->setValid(false);
			$lVr->getCommandes()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getCommandes()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ListeReservationCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ListeReservationCommandeVR();
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
	* @return ListeReservationCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ListeReservationCommandeVR();
			//Tests Techniques
			if(!is_array($pData['commandes'])) {
				$lVr->setValid(false);
				$lVr->getCommandes()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getCommandes()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['commandes'])) {
				$lVr->setValid(false);
				$lVr->getCommandes()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getCommandes()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}

}