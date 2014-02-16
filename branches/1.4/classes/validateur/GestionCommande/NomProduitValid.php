<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/11/2010
// Fichier : NomProduitValid.php
//
// Description : Classe NomProduitValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "NomProduitVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php" );

/**
 * @name NomProduitVR
 * @author Julien PIERRE
 * @since 07/11/2010
 * @desc Classe représentant une NomProduitValid
 */
class NomProduitValid
{
	/**
	* @name validAjout($pData)
	* @return NomProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new NomProduitVR();
		//Tests inputs
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
		if(!isset($pData['idCategorie'])) {
			$lVr->setValid(false);
			$lVr->getIdCategorie()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCategorie()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['nom'],0,50)) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['description'],0,500)) {
				$lVr->setValid(false);
				$lVr->getDescription()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getDescription()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idCategorie'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdCategorie()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdCategorie()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idCategorie'])) {
				$lVr->setValid(false);
				$lVr->getIdCategorie()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdCategorie()->addErreur($lErreur);	
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
			if(empty($pData['idCategorie'])) {
				$lVr->setValid(false);
				$lVr->getIdCategorie()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCategorie()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return NomProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new NomProduitVR();
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
			
			$lNomProduit = NomProduitManager::select($pData['id']);
			if($lNomProduit->getId() != $pData['id']) {
				$lVr = new TemplateVR();
				$lVr->getId(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return NomProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = NomProduitValid::validDelete($pData);
		if($lVr->getValid()) {
			return NomProduitValid::validAjout($pData);
		}
		return $lTestId;
	}
}
?>