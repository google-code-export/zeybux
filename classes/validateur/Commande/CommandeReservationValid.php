<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : CommandeReservationValid.php
//
// Description : Classe CommandeReservationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMMANDE . "/CommandeReservationVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/CommandeDetailReservationValid.php" );

/**
 * @name CommandeReservationVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une CommandeReservationValid
 */
class CommandeReservationValid
{
	/**
	* @name validAjout($pData)
	* @return CommandeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new CommandeReservationVR();
		//Tests inputs
		if(!isset($pData['detailReservation'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {		
			//Tests Techniques
			if(!is_array($pData['detailReservation'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['detailReservation'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {
				foreach($pData['detailReservation'] as $lReservation) {
					$lVrReservation = CommandeDetailReservationValid::validAjout($lReservation);
					if(!$lVrReservation->getValid()){$lVr->setValid(false);}
					$lVr->addCommandes($lVrReservation);
				}	
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return CommandeReservationVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validDelete($pData) {
		$lVr = new CommandeReservationVR();
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
	* @return CommandeReservationVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validUpdate($pData) {
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
				$lVr = new CommandeReservationVR();
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
	}*/

}