<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : CommandeCompleteValid.php
//
// Description : Classe CommandeCompleteValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "CommandeCompleteVR.php" );

/**
 * @name CommandeCompleteVR
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une CommandeCompleteValid
 */
class CommandeCompleteValid
{
	/**
	* @name validAjout($pData)
	* @return CommandeCompleteVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVR = new CommandeCompleteVR();
		//Tests Techniques
		if(!is_array($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getProduits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_110_CODE);
			$lErreur->setMessage(ERR_110_MSG);
			$lVr->getProduits()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['numero'])) {
			$lVr->setValid(false);
			$lVr->getNumero()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getNumero()->addErreur($lErreur);	
		}
		if(empty($pData['nom'])) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(empty($pData['description'])) {
			$lVr->setValid(false);
			$lVr->getDescription()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getDescription()->addErreur($lErreur);	
		}
		if(empty($pData['dateMarcheDebut'])) {
			$lVr->setValid(false);
			$lVr->getDateMarcheDebut()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getDateMarcheDebut()->addErreur($lErreur);	
		}
		if(empty($pData['timeMarcheDebut'])) {
			$lVr->setValid(false);
			$lVr->getTimeMarcheDebut()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTimeMarcheDebut()->addErreur($lErreur);	
		}
		if(empty($pData['dateMarcheFin'])) {
			$lVr->setValid(false);
			$lVr->getDateMarcheFin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getDateMarcheFin()->addErreur($lErreur);	
		}
		if(empty($pData['timeMarcheFin'])) {
			$lVr->setValid(false);
			$lVr->getTimeMarcheFin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTimeMarcheFin()->addErreur($lErreur);	
		}
		if(empty($pData['dateFinReservation'])) {
			$lVr->setValid(false);
			$lVr->getDateFinReservation()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getDateFinReservation()->addErreur($lErreur);	
		}
		if(empty($pData['timeFinReservation'])) {
			$lVr->setValid(false);
			$lVr->getTimeFinReservation()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTimeFinReservation()->addErreur($lErreur);	
		}
		if(empty($pData['archive'])) {
			$lVr->setValid(false);
			$lVr->getArchive()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getArchive()->addErreur($lErreur);	
		}
		if(empty($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getProduits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getProduits()->addErreur($lErreur);	
		}
		return $lVR;
	}

	/**
	* @name validDelete($pData)
	* @return CommandeCompleteVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVR = new CommandeCompleteVR();
		if(!is_int(intval($pData['id']))) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_104_CODE);
			$lErreur->setMessage(ERR_104_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		return lVR;
	}

	/**
	* @name validUpdate($pData)
	* @return CommandeCompleteVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVR = new CommandeCompleteVR();
			//Tests Techniques
			if(!is_array($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_110_CODE);
				$lErreur->setMessage(ERR_110_MSG);
				$lVr->getProduits()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['numero'])) {
				$lVr->setValid(false);
				$lVr->getNumero()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getNumero()->addErreur($lErreur);	
			}
			if(empty($pData['nom'])) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(empty($pData['description'])) {
				$lVr->setValid(false);
				$lVr->getDescription()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getDescription()->addErreur($lErreur);	
			}
			if(empty($pData['dateMarcheDebut'])) {
				$lVr->setValid(false);
				$lVr->getDateMarcheDebut()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getDateMarcheDebut()->addErreur($lErreur);	
			}
			if(empty($pData['timeMarcheDebut'])) {
				$lVr->setValid(false);
				$lVr->getTimeMarcheDebut()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getTimeMarcheDebut()->addErreur($lErreur);	
			}
			if(empty($pData['dateMarcheFin'])) {
				$lVr->setValid(false);
				$lVr->getDateMarcheFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getDateMarcheFin()->addErreur($lErreur);	
			}
			if(empty($pData['timeMarcheFin'])) {
				$lVr->setValid(false);
				$lVr->getTimeMarcheFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getTimeMarcheFin()->addErreur($lErreur);	
			}
			if(empty($pData['dateFinReservation'])) {
				$lVr->setValid(false);
				$lVr->getDateFinReservation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getDateFinReservation()->addErreur($lErreur);	
			}
			if(empty($pData['timeFinReservation'])) {
				$lVr->setValid(false);
				$lVr->getTimeFinReservation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getTimeFinReservation()->addErreur($lErreur);	
			}
			if(empty($pData['archive'])) {
				$lVr->setValid(false);
				$lVr->getArchive()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getArchive()->addErreur($lErreur);	
			}
			if(empty($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getProduits()->addErreur($lErreur);	
			}
			return $lVR;
		}
		return $lTestId;
	}

}