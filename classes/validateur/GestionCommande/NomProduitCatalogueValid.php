<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitCatalogueValid.php
//
// Description : Classe NomProduitCatalogueValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/NomProduitCatalogueVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

/**
 * @name NomProduitCatalogueVR
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une NomProduitCatalogueValid
 */
class NomProduitCatalogueValid
{
	/**
	* @name validDelete($pData)
	* @return NomProduitCatalogueVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new NomProduitCatalogueVR();
		//Tests Techniques
		if(!isset($pData['idNomProduit'])) {
			$lVr->setValid(false);
			$lVr->getIdNomProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getIdNomProduit()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			if(!TestFonction::checkLength($pData['idNomProduit'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdNomProduit()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idNomProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			if(empty($pData['idNomProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			
			// La NomProduit doit exister
			$lNomProduit = NomProduitManager::select($pData['idNomProduit']);
			if($lNomProduit->getId() != $pData['idNomProduit']) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
}