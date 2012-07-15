<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : ProducteurValid.php
//
// Description : Classe ProducteurValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_PRODUCTEUR . "/ProducteurVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");

/**
 * @name ProducteurVR
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe représentant une ProducteurValid
 */
class ProducteurValid
{
	/**
	* @name validAjout($pData)
	* @return ProducteurVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ProducteurVR();
		//Tests Techniques
		if(!isset($pData['idFerme'])) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(!isset($pData['nom'])) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(!isset($pData['prenom'])) {
			$lVr->setValid(false);
			$lVr->getPrenom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getPrenom()->addErreur($lErreur);	
		}
		if(!isset($pData['dateNaissance'])) {
			$lVr->setValid(false);
			$lVr->getDateNaissance()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_CODE);
			$lVr->getDateNaissance()->addErreur($lErreur);	
		}
		if(!isset($pData['commentaire'])) {
			$lVr->setValid(false);
			$lVr->getCommentaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCommentaire()->addErreur($lErreur);	
		}		
		if(!isset($pData['courrielPrincipal'])) {
			$lVr->setValid(false);
			$lVr->getCourrielPrincipal()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCourrielPrincipal()->addErreur($lErreur);	
		}
		if(!isset($pData['courrielSecondaire'])) {
			$lVr->setValid(false);
			$lVr->getCourrielSecondaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCourrielSecondaire()->addErreur($lErreur);	
		}
		if(!isset($pData['telephonePrincipal'])) {
			$lVr->setValid(false);
			$lVr->getTelephonePrincipal()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getTelephonePrincipal()->addErreur($lErreur);	
		}
		if(!isset($pData['telephoneSecondaire'])) {
			$lVr->setValid(false);
			$lVr->getTelephoneSecondaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getTelephoneSecondaire()->addErreur($lErreur);	
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
		
		if($lVr->getValid()) {
			if(!TestFonction::checkLength($pData['nom'],0,50)) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['prenom'],0,50)) {
				$lVr->setValid(false);
				$lVr->getPrenom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getPrenom()->addErreur($lErreur);	
			}
			if($pData['dateNaissance']	!= '' && !TestFonction::checkDate($pData['dateNaissance'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateNaissance()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
				$lVr->getDateNaissance()->addErreur($lErreur);	
			}
			if($pData['dateNaissance']	!= '' && !TestFonction::checkDateExist($pData['dateNaissance'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateNaissance()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
				$lVr->getDateNaissance()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['commentaire'],0,500)) {
				$lVr->setValid(false);
				$lVr->getCommentaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getCommentaire()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['courrielPrincipal'],0,100)) {
				$lVr->setValid(false);
				$lVr->getCourrielPrincipal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getCourrielPrincipal()->addErreur($lErreur);	
			}
			if($pData['courrielPrincipal']	!= '' && !TestFonction::checkCourriel($pData['courrielPrincipal'])) {
				$lVr->setValid(false);
				$lVr->getCourrielPrincipal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_102_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_102_MSG);
				$lVr->getCourrielPrincipal()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['courrielSecondaire'],0,100)) {
				$lVr->setValid(false);
				$lVr->getCourrielSecondaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getCourrielSecondaire()->addErreur($lErreur);	
			}
			if($pData['courrielSecondaire']	!= '' && !TestFonction::checkCourriel($pData['courrielSecondaire'])) {
				$lVr->setValid(false);
				$lVr->getCourrielSecondaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_102_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_102_MSG);
				$lVr->getCourrielSecondaire()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['telephonePrincipal'],0,20)) {
				$lVr->setValid(false);
				$lVr->getTelephonePrincipal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getTelephonePrincipal()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['telephoneSecondaire'],0,20)) {
				$lVr->setValid(false);
				$lVr->getTelephoneSecondaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getTelephoneSecondaire()->addErreur($lErreur);	
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
	
			//Tests Fonctionnels
			if(empty($pData['nom'])) {
				$lVr->setValid(false);
				$lVr->getNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getNom()->addErreur($lErreur);	
			}
			if(empty($pData['prenom'])) {
				$lVr->setValid(false);
				$lVr->getPrenom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrenom()->addErreur($lErreur);	
			}
			
			// Date Naissance <= Date Actuelle
			if($pData['dateNaissance']	!= '' && !TestFonction::dateEstPLusGrandeEgale(StringUtils::dateAujourdhuiDb(),$pData['dateNaissance'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateNaissance()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_230_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_230_MSG);
				$lVr->getDateNaissance()->addErreur($lErreur);
			}
			
			// La ferme doit exister
			$lFerme = FermeManager::select($pData['idFerme']);
			if($lFerme->getId() != $pData['idFerme']) {
				$lVr->setValid(false);
				$lVr->getIdFerme()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdFerme()->addErreur($lErreur);
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ProducteurVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ProducteurVR();
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
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
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			// Le producteur doit exister
			$lProducteur = ProducteurManager::select($pData['id']);
			if($lProducteur->getId() != $pData['id']) {
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
	* @return ProducteurVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {		
		$lVr = ProducteurValid::validDelete($pData);
		if($lVr->getValid()) {
			return ProducteurValid::validAjout($pData);
		}
		return $lVr;
	}

}
?>