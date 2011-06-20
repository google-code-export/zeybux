<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoAdherentValid.php
//
// Description : Classe InfoAdherentValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "InfoAdherentVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");

/**
 * @name InfoAdherentVR
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une InfoAdherentValid
 */
class InfoAdherentValid
{
	/**
	* @name validAjout($pData)
	* @return InfoAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new InfoAdherentVR();
		//Tests Techniques
		if(!is_int((int)$pData['id_adherent'])) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['id_adherent'],0,11)) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['motPasse'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPasse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPasse()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['motPasseNouveau'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPasseNouveau()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPasseNouveau()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['motPasseConfirm'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPasseConfirm()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPasseConfirm()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['id_adherent'])) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}
		if(empty($pData['motPasse'])) {
			$lVr->setValid(false);
			$lVr->getMotPasse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasse()->addErreur($lErreur);	
		}
		if(empty($pData['motPasseNouveau'])) {
			$lVr->setValid(false);
			$lVr->getMotPasseNouveau()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasseNouveau()->addErreur($lErreur);	
		}
		if(empty($pData['motPasseConfirm'])) {
			$lVr->setValid(false);
			$lVr->getMotPasseConfirm()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasseConfirm()->addErreur($lErreur);	
		}
		
		// L'adhérent existe	
		$lAdherent = AdherentManager::select($pData['id_adherent']);
		if($lAdherent->getId() != $pData['id_adherent']) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);
		
		}
		
		$lIdentification = IdentificationManager::selectByIdType($pData['id_adherent'],1);
		$lIdentification = $lIdentification[0];
		// L'adhérent existe	
		if($lIdentification->getIdLogin() != $pData['id_adherent']) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);
		
		}
		
		// L'ancien mot de passe n'est pas conforme
		if($lIdentification->getPass() != md5( $pData['motPasse'] )) {
			$lVr->setValid(false);
			$lVr->getMotPasse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_235_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_235_MSG);
			$lVr->getMotPasse()->addErreur($lErreur);		
		}
		
		// Les mots de passe ne sont pas identique
		if($pData['motPasseNouveau'] !== $pData['motPasseConfirm']) {
			$lVr->setValid(false);
			$lVr->getMotPasseNouveau()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_223_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_223_MSG);
			$lVr->getMotPasseNouveau()->addErreur($lErreur);
		}		
		
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return InfoAdherentVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validDelete($pData) {
		$lVr = new InfoAdherentVR();
		if(!is_int((int)$pData['id_adherent'])) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return InfoAdherentVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validUpdate($pData) {
		$lTestId = InfoAdherentValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new InfoAdherentVR();
			//Tests Techniques
			if(!TestFonction::checkLength($pData['motPasse'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['motPasseNouveau'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMotPasseNouveau()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMotPasseNouveau()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['motPasseConfirm'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMotPasseConfirm()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMotPasseConfirm()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['motPasse'])) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);	
			}
			if(empty($pData['motPasseNouveau'])) {
				$lVr->setValid(false);
				$lVr->getMotPasseNouveau()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPasseNouveau()->addErreur($lErreur);	
			}
			if(empty($pData['motPasseConfirm'])) {
				$lVr->setValid(false);
				$lVr->getMotPasseConfirm()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPasseConfirm()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}*/

}