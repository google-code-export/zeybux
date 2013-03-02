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
include_once(CHEMIN_CLASSES_VR . "BanqueVR.php" );

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
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
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
		if(!isset($pData['etat'])) {
			$lVr->setValid(false);
			$lVr->getEtat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getEtat()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if($pData['id']	!= '' && !is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
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
			if(!TestFonction::checkLength($pData['etat'],0,4)) {
				$lVr->setValid(false);
				$lVr->getEtat()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getEtat()->addErreur($lErreur);	
			}
			if($pData['etat']	!= '' && !is_int((int)$pData['etat'])) {
				$lVr->setValid(false);
				$lVr->getEtat()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getEtat()->addErreur($lErreur);	
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
	* @return BanqueVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = BanqueValid::validDelete($pData);
		if($lTestId->getValid()) {
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
			if(!isset($pData['etat'])) {
				$lVr->setValid(false);
				$lVr->getEtat()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getEtat()->addErreur($lErreur);	
			}

			if($lVr->getValid()) {
			//Tests Techniques
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
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getId()->addErreur($lErreur);	
				}
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
				if(!TestFonction::checkLength($pData['etat'],0,4)) {
					$lVr->setValid(false);
					$lVr->getEtat()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getEtat()->addErreur($lErreur);	
				}
				if($pData['etat']	!= '' && !is_int((int)$pData['etat'])) {
					$lVr->setValid(false);
					$lVr->getEtat()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getEtat()->addErreur($lErreur);	
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