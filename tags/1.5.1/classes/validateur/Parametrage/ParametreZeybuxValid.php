<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/05/2014
// Fichier : ParametreZeybuxValid.php
//
// Description : Classe ParametreZeybuxValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_PARAMETRAGE . "/ParametreZeybuxVR.php" );

/**
 * @name ParametreZeybuxValid
 * @author Julien PIERRE
 * @since 30/05/2014
 * @desc Classe représentant une ParametreZeybuxValid
 */
class ParametreZeybuxValid
{
	/**
	* @name validUpdate($pData)
	* @return ParametreZeybuxVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = new ParametreZeybuxVR();
		//Tests inputs
		if(!isset($pData['mailSupport'])) {
			$lVr->setValid(false);
			$lVr->getMailSupport()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMailSupport()->addErreur($lErreur);	
		}
		if(!isset($pData['mailMailingListe'])) {
			$lVr->setValid(false);
			$lVr->getMailMailingListe()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMailMailingListe()->addErreur($lErreur);	
		}
		if(!isset($pData['mailMailingListeDomaine'])) {
			$lVr->setValid(false);
			$lVr->getMailMailingListeDomaine()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMailMailingListeDomaine()->addErreur($lErreur);	
		}
		if(!isset($pData['adresseWSDL'])) {
			$lVr->setValid(false);
			$lVr->getAdresseWSDL()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getAdresseWSDL()->addErreur($lErreur);	
		}
		if(!isset($pData['sOAPLogin'])) {
			$lVr->setValid(false);
			$lVr->getSOAPLogin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getSOAPLogin()->addErreur($lErreur);	
		}
		if(!isset($pData['sOAPPass'])) {
			$lVr->setValid(false);
			$lVr->getSOAPPass()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getSOAPPass()->addErreur($lErreur);	
		}
		if(!isset($pData['zeybuxTitre'])) {
			$lVr->setValid(false);
			$lVr->getZeybuxTitre()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getZeybuxTitre()->addErreur($lErreur);	
		}
		if(!isset($pData['zeybuxAdresse'])) {
			$lVr->setValid(false);
			$lVr->getZeybuxAdresse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getZeybuxAdresse()->addErreur($lErreur);	
		}
		if(!isset($pData['propNom'])) {
			$lVr->setValid(false);
			$lVr->getPropNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropNom()->addErreur($lErreur);	
		}
		if(!isset($pData['propAdresse'])) {
			$lVr->setValid(false);
			$lVr->getPropAdresse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropAdresse()->addErreur($lErreur);	
		}
		if(!isset($pData['propCP'])) {
			$lVr->setValid(false);
			$lVr->getPropCP()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropCP()->addErreur($lErreur);	
		}
		if(!isset($pData['propVille'])) {
			$lVr->setValid(false);
			$lVr->getPropVille()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropVille()->addErreur($lErreur);	
		}
		if(!isset($pData['propTel'])) {
			$lVr->setValid(false);
			$lVr->getPropTel()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropTel()->addErreur($lErreur);	
		}
		if(!isset($pData['propMail'])) {
			$lVr->setValid(false);
			$lVr->getPropMail()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropMail()->addErreur($lErreur);	
		}
		if(!isset($pData['propRespMarcheNom'])) {
			$lVr->setValid(false);
			$lVr->getPropRespMarcheNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropRespMarcheNom()->addErreur($lErreur);	
		}
		if(!isset($pData['propRespMarchePrenom'])) {
			$lVr->setValid(false);
			$lVr->getPropRespMarchePrenom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropRespMarchePrenom()->addErreur($lErreur);	
		}
		if(!isset($pData['propRespMarchePoste'])) {
			$lVr->setValid(false);
			$lVr->getPropRespMarchePoste()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropRespMarchePoste()->addErreur($lErreur);	
		}
		if(!isset($pData['propRespMarcheTel'])) {
			$lVr->setValid(false);
			$lVr->getPropRespMarcheTel()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPropRespMarcheTel()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Fonctionnels
			if(empty($pData['mailSupport'])) {
				$lVr->setValid(false);
				$lVr->getMailSupport()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMailSupport()->addErreur($lErreur);	
			}
			if(empty($pData['mailMailingListe'])) {
				$lVr->setValid(false);
				$lVr->getMailMailingListe()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMailMailingListe()->addErreur($lErreur);	
			}
			if(empty($pData['mailMailingListeDomaine'])) {
				$lVr->setValid(false);
				$lVr->getMailMailingListeDomaine()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMailMailingListeDomaine()->addErreur($lErreur);	
			}
			if(empty($pData['adresseWSDL'])) {
				$lVr->setValid(false);
				$lVr->getAdresseWSDL()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getAdresseWSDL()->addErreur($lErreur);	
			}
			if(empty($pData['sOAPLogin'])) {
				$lVr->setValid(false);
				$lVr->getSOAPLogin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getSOAPLogin()->addErreur($lErreur);	
			}
			if(empty($pData['sOAPPass'])) {
				$lVr->setValid(false);
				$lVr->getSOAPPass()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getSOAPPass()->addErreur($lErreur);	
			}
			if(empty($pData['zeybuxTitre'])) {
				$lVr->setValid(false);
				$lVr->getZeybuxTitre()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getZeybuxTitre()->addErreur($lErreur);	
			}
			if(empty($pData['zeybuxAdresse'])) {
				$lVr->setValid(false);
				$lVr->getZeybuxAdresse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getZeybuxAdresse()->addErreur($lErreur);	
			}
			if(empty($pData['propNom'])) {
				$lVr->setValid(false);
				$lVr->getPropNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropNom()->addErreur($lErreur);	
			}
			if(empty($pData['propAdresse'])) {
				$lVr->setValid(false);
				$lVr->getPropAdresse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropAdresse()->addErreur($lErreur);	
			}
			if(empty($pData['propCP'])) {
				$lVr->setValid(false);
				$lVr->getPropCP()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropCP()->addErreur($lErreur);	
			}
			if(empty($pData['propVille'])) {
				$lVr->setValid(false);
				$lVr->getPropVille()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropVille()->addErreur($lErreur);	
			}
			if(empty($pData['propTel'])) {
				$lVr->setValid(false);
				$lVr->getPropTel()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropTel()->addErreur($lErreur);	
			}
			if(empty($pData['propMail'])) {
				$lVr->setValid(false);
				$lVr->getPropMail()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropMail()->addErreur($lErreur);	
			}
			if(empty($pData['propRespMarcheNom'])) {
				$lVr->setValid(false);
				$lVr->getPropRespMarcheNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropRespMarcheNom()->addErreur($lErreur);	
			}
			if(empty($pData['propRespMarchePrenom'])) {
				$lVr->setValid(false);
				$lVr->getPropRespMarchePrenom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropRespMarchePrenom()->addErreur($lErreur);	
			}
			if(empty($pData['propRespMarchePoste'])) {
				$lVr->setValid(false);
				$lVr->getPropRespMarchePoste()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropRespMarchePoste()->addErreur($lErreur);	
			}
			if(empty($pData['propRespMarcheTel'])) {
				$lVr->setValid(false);
				$lVr->getPropRespMarcheTel()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPropRespMarcheTel()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}

}?>