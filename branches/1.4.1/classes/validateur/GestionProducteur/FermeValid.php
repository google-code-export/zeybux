<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : FermeValid.php
//
// Description : Classe FermeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_PRODUCTEUR . "/FermeVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");

/**
 * @name FermeVR
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une FermeValid
 */
class FermeValid
{
	/**
	* @name validAjout($pData)
	* @return FermeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new FermeVR();
		//Tests inputs
		if(!isset($pData['nom'])) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(!isset($pData['siren'])) {
			$lVr->setValid(false);
			$lVr->getSiren()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getSiren()->addErreur($lErreur);	
		}
		if(!isset($pData['adresse'])) {
			$lVr->setValid(false);
			$lVr->getAdresse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getAdresse()->addErreur($lErreur);	
		}
		if(!isset($pData['codePostal'])) {
			$lVr->setValid(false);
			$lVr->getCodePostal()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCodePostal()->addErreur($lErreur);	
		}
		if(!isset($pData['ville'])) {
			$lVr->setValid(false);
			$lVr->getVille()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getVille()->addErreur($lErreur);	
		}
		if(!isset($pData['dateAdhesion'])) {
			$lVr->setValid(false);
			$lVr->getDateAdhesion()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
			$lVr->getDateAdhesion()->addErreur($lErreur);	
		}
		if(!isset($pData['description'])) {
			$lVr->setValid(false);
			$lVr->getDescription()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
			$lVr->getDescription()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['nom'],0,300)) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['siren'],0,9)) {
				$lVr->setValid(false);
				$lVr->getSiren()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getSiren()->addErreur($lErreur);	
			}	
			if(!TestFonction::checkLength($pData['adresse'],0,300)) {
				$lVr->setValid(false);
				$lVr->getAdresse()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getAdresse()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['codePostal'],0,10)) {
				$lVr->setValid(false);
				$lVr->getCodePostal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getCodePostal()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['ville'],0,100)) {
				$lVr->setValid(false);
				$lVr->getVille()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getVille()->addErreur($lErreur);	
			}		
			if(!TestFonction::checkDate($pData['dateAdhesion'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
				$lVr->getDateAdhesion()->addErreur($lErreur);	
			}
			if(!TestFonction::checkDateExist($pData['dateAdhesion'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
				$lVr->getDateAdhesion()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['description'],0,500)) {
				$lVr->setValid(false);
				$lVr->getDescription()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getDescription()->addErreur($lErreur);	
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
			if(empty($pData['dateAdhesion'])) {
				$lVr->setValid(false);
				$lVr->getDateAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDateAdhesion()->addErreur($lErreur);	
			}
		
			// SIREN
			if(!empty($pData['siren'])) {
				$lImpair = true;
				$lSomme = 0;
				$lPosition = strlen($pData['siren']) - 1;
				while( $lPosition >= 0) {
					$lIncrement = 0;
					if($lImpair) {
						$lIncrement = $pData['siren'][$lPosition] * 1;
					} else {
						$lIncrement = $pData['siren'][$lPosition] * 2;
					}
					if($lIncrement > 9) {
						$lIncrement -= 9;
					}
					$lSomme += $lIncrement;
					$lImpair = !$lImpair;
					$lPosition--;
				}
				if(fmod($lSomme, 10) != 0 || !TestFonction::checkLength($pData['siren'],9,9)) {
					$lVr->setValid(false);
					$lVr->getSiren()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_242_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_242_MSG);
					$lVr->getSiren()->addErreur($lErreur);
				}
			}
		
			// Date Adhésion <= Date Actuelle
			if(!TestFonction::dateEstPLusGrandeEgale(StringUtils::dateAujourdhuiDb(),$pData['dateAdhesion'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_230_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_230_MSG);
				$lVr->getDateAdhesion()->addErreur($lErreur);
			}		
		}
		return $lVr;
	}
	
	/**
	* @name validUpdate($pData)
	* @return FermeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = FermeValid::validDelete($pData);		
		if($lVr->getvalid()) {
			return FermeValid::validAjout($pData);
		}
		return $lVr;
	}	
	
	/**
	* @name validDelete($pData)
	* @return FermeVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new FermeVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getId()->addErreur($lErreur);	
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
			
			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			// La ferme doit exister
			$lFerme = FermeManager::select($pData['id']);
			if($lFerme->getId() != $pData['id']) {
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
}
?>