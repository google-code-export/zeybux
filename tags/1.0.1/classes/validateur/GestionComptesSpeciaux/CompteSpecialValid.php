<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier : CompteSpecialValid.php
//
// Description : Classe CompteSpecialValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMPTES_SPECIAUX . "/" . "CompteSpecialVR.php" );

/**
 * @name CompteSpecialValid
 * @author Julien PIERRE
 * @since 25/01/2012
 * @desc Classe représentant une CompteSpecialValid
 */
class CompteSpecialValid
{
	/**
	* @name validAjout($pData)
	* @return CompteSpecialVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new CompteSpecialVR();
		//Tests Techniques
		if(!isset($pData['login'])) {
			$lVr->setValid(false);
			$lVr->getLogin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLogin()->addErreur($lErreur);	
		}
		if(!isset($pData['motPasse'])) {
			$lVr->setValid(false);
			$lVr->getMotPasse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasse()->addErreur($lErreur);	
		}
		if(!isset($pData['motPasseConfirm'])) {
			$lVr->setValid(false);
			$lVr->getMotPasse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasse()->addErreur($lErreur);	
		}
		if(!isset($pData['type'])) {
			$lVr->setValid(false);
			$lVr->getType()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getType()->addErreur($lErreur);	
		}
		
		if($lVr->getValid()) {		
			if(!TestFonction::checkLength($pData['login'],0,100)) {
				$lVr->setValid(false);
				$lVr->getLogin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getLogin()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['motPasse'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['motPasseConfirm'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['type'],0,1)) {
				$lVr->setValid(false);
				$lVr->getType()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getType()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			if(empty($pData['login'])) {
				$lVr->setValid(false);
				$lVr->getLogin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLogin()->addErreur($lErreur);	
			}			
			if(empty($pData['motPasse'])) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);	
			}			
			if(empty($pData['motPasseConfirm'])) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);	
			}			
			if(empty($pData['type'])) {
				$lVr->setValid(false);
				$lVr->getType()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getType()->addErreur($lErreur);	
			}
		
			// Les mots de passe ne sont pas identique
			if($pData['motPasse'] !== $pData['motPasseConfirm']) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_223_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_223_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);
			}
			
			// Le type de compte spécial doit exister
			if($pData['type'] < 2 || $pData['type'] > 4) {
				$lVr->setValid(false);
				$lVr->getType()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_246_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_246_MSG);
				$lVr->getType()->addErreur($lErreur);			
			}
		}	
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return CompteSpecialVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new CompteSpecialVR();
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
			if(empty($pData['id'])) {
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
	* @return CompteSpecialVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = CompteSpecialValid::validDelete($pData);
		if($lVr->getValid()) {	
			//Tests Techniques
			if(!isset($pData['login'])) {
				$lVr->setValid(false);
				$lVr->getLogin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLogin()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {		
				if(!TestFonction::checkLength($pData['login'],0,100)) {
					$lVr->setValid(false);
					$lVr->getLogin()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getLogin()->addErreur($lErreur);	
				}
				
				//Tests Fonctionnels
				if(empty($pData['login'])) {
					$lVr->setValid(false);
					$lVr->getLogin()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getLogin()->addErreur($lErreur);	
				}
			}
		}
		return $lVr;
	}
	
	/**
	* @name validUpdatePass($pData)
	* @return CompteSpecialVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdatePass($pData) {
		$lVr = CompteSpecialValid::validDelete($pData);
		if($lVr->getValid()) {	
			//Tests Techniques
			if(!isset($pData['motPasse'])) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);	
			}
			if(!isset($pData['motPasseConfirm'])) {
				$lVr->setValid(false);
				$lVr->getMotPasse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMotPasse()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {
				if(!TestFonction::checkLength($pData['motPasse'],0,100)) {
					$lVr->setValid(false);
					$lVr->getMotPasse()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getMotPasse()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['motPasseConfirm'],0,100)) {
					$lVr->setValid(false);
					$lVr->getMotPasse()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getMotPasse()->addErreur($lErreur);	
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
				if(empty($pData['motPasseConfirm'])) {
					$lVr->setValid(false);
					$lVr->getMotPasse()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getMotPasse()->addErreur($lErreur);	
				}
			
				// Les mots de passe ne sont pas identique
				if($pData['motPasse'] !== $pData['motPasseConfirm']) {
					$lVr->setValid(false);
					$lVr->getMotPasse()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_223_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_223_MSG);
					$lVr->getMotPasse()->addErreur($lErreur);
				}
			}
		}
		return $lVr;
	}
}
?>