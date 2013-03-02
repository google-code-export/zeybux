<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : ProduitCommandeValid.php
//
// Description : Classe ProduitCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "ProduitCommandeVR.php" );

/**
 * @name ProduitCommandeVR
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une ProduitCommandeValid
 */
class ProduitCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return ProduitCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVR = new ProduitCommandeVR();
		//Tests Techniques
		if(!is_array($pData['lots'])) {
			$lVr->setValid(false);
			$lVr->getLots()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_110_CODE);
			$lErreur->setMessage(ERR_110_MSG);
			$lVr->getLots()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['idNom'])) {
			$lVr->setValid(false);
			$lVr->getIdNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getIdNom()->addErreur($lErreur);	
		}
		if(empty($pData['nom'])) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(empty($pData['idCategorie'])) {
			$lVr->setValid(false);
			$lVr->getIdCategorie()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getIdCategorie()->addErreur($lErreur);	
		}
		if(empty($pData['categorie'])) {
			$lVr->setValid(false);
			$lVr->getCategorie()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getCategorie()->addErreur($lErreur);	
		}
		if(empty($pData['descriptionCategorie'])) {
			$lVr->setValid(false);
			$lVr->getDescriptionCategorie()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getDescriptionCategorie()->addErreur($lErreur);	
		}
		if(empty($pData['unite'])) {
			$lVr->setValid(false);
			$lVr->getUnite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getUnite()->addErreur($lErreur);	
		}
		if(empty($pData['qteMaxCommande'])) {
			$lVr->setValid(false);
			$lVr->getQteMaxCommande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getQteMaxCommande()->addErreur($lErreur);	
		}
		if(empty($pData['qteRestante'])) {
			$lVr->setValid(false);
			$lVr->getQteRestante()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getQteRestante()->addErreur($lErreur);	
		}
		if(empty($pData['lots'])) {
			$lVr->setValid(false);
			$lVr->getLots()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getLots()->addErreur($lErreur);	
		}
		return $lVR;
	}

	/**
	* @name validDelete($pData)
	* @return ProduitCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVR = new ProduitCommandeVR();
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
	* @return ProduitCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVR = new ProduitCommandeVR();
			//Tests Techniques
			if(!is_array($pData['lots'])) {
				$lVr->setValid(false);
				$lVr->getLots()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_110_CODE);
				$lErreur->setMessage(ERR_110_MSG);
				$lVr->getLots()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['idNom'])) {
				$lVr->setValid(false);
				$lVr->getIdNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getIdNom()->addErreur($lErreur);	
			}
			if(empty($pData['nom'])) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(empty($pData['idCategorie'])) {
				$lVr->setValid(false);
				$lVr->getIdCategorie()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getIdCategorie()->addErreur($lErreur);	
			}
			if(empty($pData['categorie'])) {
				$lVr->setValid(false);
				$lVr->getCategorie()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getCategorie()->addErreur($lErreur);	
			}
			if(empty($pData['descriptionCategorie'])) {
				$lVr->setValid(false);
				$lVr->getDescriptionCategorie()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getDescriptionCategorie()->addErreur($lErreur);	
			}
			if(empty($pData['unite'])) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
			}
			if(empty($pData['qteMaxCommande'])) {
				$lVr->setValid(false);
				$lVr->getQteMaxCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getQteMaxCommande()->addErreur($lErreur);	
			}
			if(empty($pData['qteRestante'])) {
				$lVr->setValid(false);
				$lVr->getQteRestante()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getQteRestante()->addErreur($lErreur);	
			}
			if(empty($pData['lots'])) {
				$lVr->setValid(false);
				$lVr->getLots()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getLots()->addErreur($lErreur);	
			}
			return $lVR;
		}
		return $lTestId;
	}

}