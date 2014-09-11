<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/08/2010
// Fichier : DetailCommandeValid.php
//
// Description : Classe DetailCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/DetailCommandeVR.php" );

/**
 * @name DetailCommandeVR
 * @author Julien PIERRE
 * @since 28/08/2010
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
		$lVr = new DetailCommandeVR();
		//Tests inputs
		if(!isset($pData['idProduit'])) {
			$lVr->setValid(false);
			$lVr->getIdProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdProduit()->addErreur($lErreur);	
		}
		if(!isset($pData['taille'])) {
			$lVr->setValid(false);
			$lVr->getTaille()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getTaille()->addErreur($lErreur);	
		}
		if(!isset($pData['prix'])) {
			$lVr->setValid(false);
			$lVr->getPrix()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPrix()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['idProduit'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdProduit()->addErreur($lErreur);	
			}
			if($pData['idProduit'] != "" && !is_int((int)$pData['idProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdProduit()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['taille'],0,12) || $pData['taille'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getTaille()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getTaille()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['taille'])) {
				$lVr->setValid(false);
				$lVr->getTaille()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getTaille()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['prix'],0,12) || $pData['prix'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['taille'])) {
				$lVr->setValid(false);
				$lVr->getTaille()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTaille()->addErreur($lErreur);	
			}
			if(empty($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			
			// Taille et prix sont positifs
			if($pData['taille'] <= 0) {
				$lVr->setValid(false);
				$lVr->getTaille()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getTaille()->addErreur($lErreur);	
			}
			if($pData['prix'] <= 0) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return DetailCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new DetailCommandeVR();	
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
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
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
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return DetailCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new DetailCommandeVR();
			//Tests inputs
			if(!isset($pData['idProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdProduit()->addErreur($lErreur);	
			}
			if(!isset($pData['taille'])) {
				$lVr->setValid(false);
				$lVr->getTaille()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTaille()->addErreur($lErreur);	
			}
			if(!isset($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			if($lVr->getValid()) {
				//Tests Techniques
				if(!TestFonction::checkLength($pData['idProduit'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdProduit()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdProduit()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['idProduit'])) {
					$lVr->setValid(false);
					$lVr->getIdProduit()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getIdProduit()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['taille'],0,12) || $pData['taille'] > 999999999.99) {
					$lVr->setValid(false);
					$lVr->getTaille()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getTaille()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['taille'])) {
					$lVr->setValid(false);
					$lVr->getTaille()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getTaille()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['prix'],0,12) || $pData['prix'] > 999999999.99) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['prix'])) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
				}
	
				//Tests Fonctionnels
				if(empty($pData['idProduit'])) {
					$lVr->setValid(false);
					$lVr->getIdProduit()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdProduit()->addErreur($lErreur);	
				}
				if(empty($pData['taille'])) {
					$lVr->setValid(false);
					$lVr->getTaille()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getTaille()->addErreur($lErreur);	
				}
				if(empty($pData['prix'])) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
				}
				
				// Taille et prix sont positifs
				if($pData['taille'] <= 0) {
					$lVr->setValid(false);
					$lVr->getTaille()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
					$lVr->getTaille()->addErreur($lErreur);	
				}
				if($pData['prix'] <= 0) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
				}
			}
			return $lVr;
		}
		return $lTestId;
	}

}
?>