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
include_once(CHEMIN_CLASSES_VALIDATEUR . "ReservationCommandeValid.php" );

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
		//Tests inputs
		if(!isset($pData['commandes'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {		
			//Tests Techniques
			if(!is_array($pData['commandes'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['commandes'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {
				foreach($pData['commandes'] as $lReservation) {
					$lVrReservation = ReservationCommandeValid::validAjout($lReservation);
					if(!$lVrReservation->getValid()){$lVr->setValid(false);}
					$lVr->addCommandes($lVrReservation);
				}	
			}
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
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
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
			//Tests inputs
			if(!isset($pData['commandes'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
	
			if($lVr->getValid()) {		
				$lVr = new ListeReservationCommandeVR();
				//Tests Techniques
				if(!is_array($pData['commandes'])) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
	
				//Tests Fonctionnels
				if(empty($pData['commandes'])) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
				
				if($lVr->getValid()) {
					foreach($pData['commandes'] as $lReservation) {
						$lVrReservation = ReservationCommandeValid::validAjout($lReservation);
						if(!$lVrReservation->getValid()){$lVr->setValid(false);}
						$lVr->addCommandes($lVrReservation);
					}	
				}
			}
			return $lVr;
		}
		return $lTestId;
	}

}