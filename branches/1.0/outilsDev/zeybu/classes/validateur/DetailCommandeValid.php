<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : DetailCommandeValid.php
//
// Description : Classe DetailCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "DetailCommandeVR.php" );

/**
 * @name DetailCommandeVR
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une DetailCommandeValid
 */
class DetailCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return DetailCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVR = new DetailCommandeVR();
		//Tests Techniques

		//Tests Fonctionnels
		if(empty($pData['idProduit'])) {
			$lVr->setValid(false);
			$lVr->getIdProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getIdProduit()->addErreur($lErreur);	
		}
		if(empty($pData['taille'])) {
			$lVr->setValid(false);
			$lVr->getTaille()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getTaille()->addErreur($lErreur);	
		}
		if(empty($pData['prix'])) {
			$lVr->setValid(false);
			$lVr->getPrix()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(ERR_201_CODE);
			$lErreur->setMessage(ERR_201_MSG);
			$lVr->getPrix()->addErreur($lErreur);	
		}
		return $lVR;
	}

	/**
	* @name validDelete($pData)
	* @return DetailCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVR = new DetailCommandeVR();
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
	* @return DetailCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVR = new DetailCommandeVR();
			//Tests Techniques

			//Tests Fonctionnels
			if(empty($pData['idProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getIdProduit()->addErreur($lErreur);	
			}
			if(empty($pData['taille'])) {
				$lVr->setValid(false);
				$lVr->getTaille()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getTaille()->addErreur($lErreur);	
			}
			if(empty($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(ERR_201_CODE);
				$lErreur->setMessage(ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			return $lVR;
		}
		return $lTestId;
	}

}