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
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_PRODUCTEUR . "/NomProduitCatalogueVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/ModeleLotValid.php" );

/**
 * @name NomProduitCatalogueVR
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une NomProduitCatalogueValid
 */
class NomProduitCatalogueValid
{
	/**
	* @name validAjout($pData)
	* @return NomProduitCatalogueVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new NomProduitCatalogueVR();
		//Tests Techniques
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		if(!isset($pData['numero'])) {
			$lVr->setValid(false);
			$lVr->getNumero()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getNumero()->addErreur($lErreur);	
		}
		if(!isset($pData['idCategorie'])) {
			$lVr->setValid(false);
			$lVr->getIdCategorie()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getIdCategorie()->addErreur($lErreur);	
		}
		if(!isset($pData['nom'])) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(!isset($pData['description'])) {
			$lVr->setValid(false);
			$lVr->getDescription()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getDescription()->addErreur($lErreur);	
		}
		if(!isset($pData['producteurs'])) {
			$lVr->setValid(false);
			$lVr->getProducteurs()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getProducteurs()->addErreur($lErreur);	
		}
		if(!isset($pData['caracteristiques'])) {
			$lVr->setValid(false);
			$lVr->getCaracteristiques()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCaracteristiques()->addErreur($lErreur);	
		}
		if(!isset($pData['modelesLot'])) {
			$lVr->setValid(false);
			$lVr->getModelesLot()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getModelesLot()->addErreur($lErreur);	
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
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['numero'],0,50)) {
				$lVr->setValid(false);
				$lVr->getNumero()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getNumero()->addErreur($lErreur);	
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
			if(!is_array($pData['producteurs'])) {
				$lVr->setValid(false);
				$lVr->getProducteurs()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getProducteurs()->addErreur($lErreur);	
			}
			if(!is_array($pData['caracteristiques'])) {
				$lVr->setValid(false);
				$lVr->getCaracteristiques()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getCaracteristiques()->addErreur($lErreur);	
			}
			if(!is_array($pData['modelesLot'])) {
				$lVr->setValid(false);
				$lVr->getModelesLot()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getModelesLot()->addErreur($lErreur);	
			}

			if($lVr->getValid()) {
				//Tests Fonctionnels
				if(empty($pData['id'])) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId()->addErreur($lErreur);	
				}
				if(empty($pData['idCategorie'])) {
					$lVr->setValid(false);
					$lVr->getIdCategorie()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdCategorie()->addErreur($lErreur);	
				}
				if($pData['idCategorie'] == 0) {
					$lVr->setValid(false);
					$lVr->getIdCategorie()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdCategorie()->addErreur($lErreur);	
				}
				if(empty($pData['nom'])) {
					$lVr->setValid(false);
					$lVr->getNom()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getNom()->addErreur($lErreur);	
				}

				// La Ferme doit exister
				$lFerme = FermeManager::select($pData['id']);
				if($lFerme->getId() != $pData['id']) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId()->addErreur($lErreur);
				}
				
				// La Catégorie doit exister
				$lCategorieProduit = CategorieProduitManager::select($pData['idCategorie']);
				if($lCategorieProduit->getId() != $pData['idCategorie']) {
					$lVr->setValid(false);
					$lVr->getIdCategorie()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdCategorie()->addErreur($lErreur);
				}
				
				foreach($pData['producteurs'] as $lProducteur) {
					$lProducteurVO = ProducteurManager::select($lProducteur);
					if($lProducteurVO->getIdFerme() != $pData['id']) {
						$lVr->setValid(false);
						$lVr->getProducteurs()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
						$lVr->getProducteurs()->addErreur($lErreur);
					}
				}
				
				foreach($pData['caracteristiques'] as $lCaracteristique) {
					$lCaracteristiqueVO = CaracteristiqueManager::select($lCaracteristique);
					if($lCaracteristiqueVO->getId() != $lCaracteristique) {
						$lVr->setValid(false);
						$lVr->getCaracteristiques()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
						$lVr->getCaracteristiques()->addErreur($lErreur);
					}
				}
				
				foreach($pData['modelesLot'] as $lModeleLot) {
					$lModeleLotVR = ModeleLotValid::ValidSet($lModeleLot);
					if(!$lModeleLotVR->getValid()) {
						$lVr->setValid(false);
					}
					$lVr->addModelesLot($lModeleLotVR);
				}
					
			}	
		}
		return $lVr;
	}
	
	/**
	* @name validUpdate($pData)
	* @return NomProduitCatalogueVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = NomProduitCatalogueValid::validDelete($pData);		
		if($lVr->getvalid()) {
			return NomProduitCatalogueValid::validAjout($pData);
		}
		return $lVr;
	}
	
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
?>