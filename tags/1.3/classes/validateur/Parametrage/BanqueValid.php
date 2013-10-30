<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : BanqueValid.php
//
// Description : Classe BanqueValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_PARAMETRAGE . "/BanqueVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );

/**
 * @name BanqueVR
 * @author Julien PIERRE
 * @since 12/01/2013
 * @desc Classe représentant une BanqueValid
 */
class BanqueValid
{
	/**
	* @name validAjout($pData)
	* @return BanqueVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new BanqueVR();
		//Tests inputs
		if(!isset($pData['nomCourt'])) {
			$lVr->setValid(false);
			$lVr->getNomCourt()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getNomCourt()->addErreur($lErreur);	
		}
		if(!isset($pData['nom'])) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(!isset($pData['description'])) {
			$lVr->setValid(false);
			$lVr->getDescription()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDescription()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['nomCourt'],0,50)) {
				$lVr->setValid(false);
				$lVr->getNomCourt()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getNomCourt()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['nom'],0,200)) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['nom'])) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return BanqueVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new BanqueVR();
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
			
			// La banque doit exister
			$lBanqueService = new BanqueService();			
			if(!$lBanqueService->existe($pData['id'])) {
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
	* @return BanqueVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = BanqueValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new BanqueVR();
			//Tests inputs
			if(!isset($pData['nomCourt'])) {
				$lVr->setValid(false);
				$lVr->getNomCourt()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getNomCourt()->addErreur($lErreur);	
			}
			if(!isset($pData['nom'])) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(!isset($pData['description'])) {
				$lVr->setValid(false);
				$lVr->getDescription()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDescription()->addErreur($lErreur);	
			}

			if($lVr->getValid()) {
				//Tests Techniques
				if(!TestFonction::checkLength($pData['nomCourt'],0,50)) {
					$lVr->setValid(false);
					$lVr->getNomCourt()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getNomCourt()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['nom'],0,200)) {
					$lVr->setValid(false);
					$lVr->getNom()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getNom()->addErreur($lErreur);	
				}

				//Tests Fonctionnels
				if(empty($pData['nom'])) {
					$lVr->setValid(false);
					$lVr->getNom()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getNom()->addErreur($lErreur);	
				}
			}
			return $lVr;
		}
		return $lTestId;
	}

}?>