<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/10/2011
// Fichier : CategorieProduitValid.php
//
// Description : Classe CategorieProduitValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_PRODUIT ."/CategorieProduitVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php" );

/**
 * @name CategorieProduitVR
 * @author Julien PIERRE
 * @since 09/10/2011
 * @desc Classe représentant une CategorieProduitValid
 */
class CategorieProduitValid
{
	/**
	* @name validAjout($pData)
	* @return CategorieProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new CategorieProduitVR();		
		//Tests Techniques
		if(!isset($pData['categorieProduit'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}		
		if($lVr->getValid()) {
			if(!isset($pData['categorieProduit']['nom'])) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(!isset($pData['categorieProduit']['description'])) {
				$lVr->setValid(false);
				$lVr->getDescription()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDescription()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {			
				if(!TestFonction::checkLength($pData['categorieProduit']['nom'],0,50)) {
					$lVr->setValid(false);
					$lVr->getNom()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getNom()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['categorieProduit']['description'],0,500)) {
					$lVr->setValid(false);
					$lVr->getDescription()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getDescription()->addErreur($lErreur);	
				}
		
				//Tests Fonctionnels
				if(empty($pData['categorieProduit']['nom'])) {
					$lVr->setValid(false);
					$lVr->getNom()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getNom()->addErreur($lErreur);	
				}
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return NomProduitVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validDelete($pData) {
		$lVr = new NomProduitVR();
		if(!is_int((int)$pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return CategorieProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = new CategorieProduitVR();
		//Tests Techniques
		if(!isset($pData['categorieProduit'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			if(!isset($pData['categorieProduit']['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!isset($pData['categorieProduit']['nom'])) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(!isset($pData['categorieProduit']['description'])) {
				$lVr->setValid(false);
				$lVr->getDescription()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDescription()->addErreur($lErreur);	
			}

			if($lVr->getValid()) {
				if(!TestFonction::checkLength($pData['categorieProduit']['id'],0,11)) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getId()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['categorieProduit']['id'])) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getId()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['categorieProduit']['nom'],0,50)) {
					$lVr->setValid(false);
					$lVr->getNom()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getNom()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['categorieProduit']['description'],0,500)) {
					$lVr->setValid(false);
					$lVr->getDescription()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getDescription()->addErreur($lErreur);	
				}
			
				//Tests Fonctionnels
				if(empty($pData['categorieProduit']['id'])) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId()->addErreur($lErreur);	
				}
				if(empty($pData['categorieProduit']['nom'])) {
					$lVr->setValid(false);
					$lVr->getNom()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getNom()->addErreur($lErreur);	
				}
				
				// La catégorie doit exister
				$lCategorie = CategorieProduitManager::select($pData['categorieProduit']['id']);
				if($lCategorie->getId() != $pData['categorieProduit']['id']) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId()->addErreur($lErreur);
				}
			}
		}
		return $lVr;
	}
	
	/**
	* @name validDelete($pData)
	* @return CategorieProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new CategorieProduitVR();
		//Tests Techniques
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);	
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
			
			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			// La catégorie doit exister
			$lCategorie = CategorieProduitManager::select($pData['id']);
			if($lCategorie->getId() != $pData['id']) {
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