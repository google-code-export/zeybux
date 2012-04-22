<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2010
// Fichier : IdentificationValid.php
//
// Description : Classe IdentificationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_IDENTIFICATION . "/IdentificationVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_IDENTIFICATION . "/ReInitMdpVR.php" );

/**
 * @name IdentificationVR
 * @author Julien PIERRE
 * @since 01/11/2010
 * @desc Classe représentant une IdentificationValid
 */
class IdentificationValid
{
	/**
	* @name validAjout($pData)
	* @return IdentificationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new IdentificationVR();
		if(!isset($pData['login'])) {
			$lVr->setValid(false);
			$lVr->getLogin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLogin()->addErreur($lErreur);	
		}
		if(!isset($pData['pass'])) {
			$lVr->setValid(false);
			$lVr->getPass()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPass()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['login'],0,20)) {
				$lVr->setValid(false);
				$lVr->getLogin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getLogin()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['pass'],0,100)) {
				$lVr->setValid(false);
				$lVr->getPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getPass()->addErreur($lErreur);	
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
			if(empty($pData['pass'])) {
				$lVr->setValid(false);
				$lVr->getPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPass()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}

	/**
	* @name validReconnection($pData)
	* @return IdentificationVR
	* @desc Test la validite de l'élément
	*/
	public static function validReconnection($pData) {
		$lVr = new IdentificationVR();
		if(!isset($pData['login'])) {
			$lVr->setValid(false);
			$lVr->getLogin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLogin()->addErreur($lErreur);	
		}
		if(!isset($pData['pass'])) {
			$lVr->setValid(false);
			$lVr->getPass()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPass()->addErreur($lErreur);	
		}
		if(!isset($pData['idConnexion'])) {
			$lVr->setValid(false);
			$lVr->getIdConnexion()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdConnexion()->addErreur($lErreur);	
		}
		
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['login'],0,20)) {
				$lVr->setValid(false);
				$lVr->getLogin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getLogin()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['pass'],0,100)) {
				$lVr->setValid(false);
				$lVr->getPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getPass()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idConnexion'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdConnexion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdConnexion()->addErreur($lErreur);	
			}		
			if(!is_int((int)$pData['idConnexion'])) {
				$lVr->setValid(false);
				$lVr->getIdConnexion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdConnexion()->addErreur($lErreur);	
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
			if(empty($pData['pass'])) {
				$lVr->setValid(false);
				$lVr->getPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPass()->addErreur($lErreur);	
			}
			if(empty($pData['idConnexion'])) {
				$lVr->setValid(false);
				$lVr->getIdConnexion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdConnexion()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}
	
	/**
	* @name validAjout($pData)
	* @return InfoAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validReInitMdp($pData) {
		$lVr = new ReInitMdpVR();
		//Tests Techniques	
		if(!isset($pData['numero'])) {
			$lVr->setValid(false);
			$lVr->getNumero()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getNumero()->addErreur($lErreur);	
		}	
		if(!isset($pData['mail'])) {
			$lVr->setValid(false);
			$lVr->getMail()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMail()->addErreur($lErreur);	
		}
			
		if($lVr->getValid()) {
			if(!TestFonction::checkLength($pData['numero'],0,100)) {
				$lVr->setValid(false);
				$lVr->getNumero()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getNumero()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['mail'],0,100)) {
				$lVr->setValid(false);
				$lVr->getMail()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMail()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['numero'])) {
				$lVr->setValid(false);
				$lVr->getNumero()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getNumero()->addErreur($lErreur);	
			}
			if(empty($pData['mail'])) {
				$lVr->setValid(false);
				$lVr->getMail()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMail()->addErreur($lErreur);	
			}
			
			// L'adhérent existe	
			$lAdherent = AdherentManager::selectByNumero($pData['numero']);
			$lAdherent = $lAdherent[0];
			if($lAdherent->getNumero() != $pData['numero']) {
				$lVr->setValid(false);
				$lVr->getNumero()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getNumero()->addErreur($lErreur);
			}
			if($lAdherent->getCourrielPrincipal() != $pData['mail'] && $lAdherent->getCourrielSecondaire() != $pData['mail']) {
				$lVr->setValid(false);
				$lVr->getMail()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_258_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_258_MSG);
				$lVr->getMail()->addErreur($lErreur);
			}
			
			if($lVr->getValid()) {
				$lIdentification = IdentificationManager::selectByIdType($lAdherent->getId(),1);
				$lIdentification = $lIdentification[0];
				// L'adhérent existe	
				if($lIdentification->getIdLogin() != $lAdherent->getId()) {
					$lVr->setValid(false);
					$lVr->getNumero()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getNumero()->addErreur($lErreur);
				
				}
			}
		}
		return $lVr;
	}
}
?>