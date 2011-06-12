<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/01/2010
// Fichier : IdentificationControleur.php
//
// Description : Classe IdentificationControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "IdentificationViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdentificationValid.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );

/**
 * @name IdentificationControleur
 * @author Julien PIERRE
 * @since 29/01/2010
 * @desc Classe controleur d'une identification
 */
class IdentificationControleur
{	
	/**
	* @name identifier($pParam)
	* @return VR
	* @desc Vérifie le login et mot de passe dans la BDD et renvoie un IdentificationPO avec l'authorisation et place les autorisations dans les variables de session
	*/
	public function identifier($pParam) {
		// En cas de nouvelle connexion sans déconnexion on supprime les droits
		session_unset();
				
		$lValid = new IdentificationValid();
		$lVr = $lValid->validAjout($pParam);
		
		if($lVr->getValid()) {		
			$lLogin = $pParam["login"];
			// Version cryptée du mot de pass pour le comparer avec celui de la BDD
			$lPass = md5($pParam["pass"]);
				
			// Sélection des adhérents ayant le login de l'identification
			$lListeIdentification = IdentificationViewManager::select($lLogin);
	
			// Recherche de correspondance de login et mot de passe dans la base 
			$lAutorisation = false;
			
			if(is_array($lListeIdentification)) {
				$lIdentification = $lListeIdentification[0];
				
				if($lIdentification->getAdhNumero() === $lLogin && $lIdentification->getAdhMotPasse() === $lPass ) {
					// Création d'une variable de session avec l'id de l'adherent lui permettant de lui donner les droits de connexion
					$_SESSION[DROIT_ID] = $lIdentification->getAdhId();
					$_SESSION[ID_COMPTE] = $lIdentification->getAdhIdCompte();
					// Ajout des droits de super zeybu
					if($lIdentification->getAdhSuperZeybu() == 1) {
						$_SESSION['superzeybu'] = $lIdentification->getAdhId();
					}
					$_SESSION[$lIdentification->getModNom()] = true;
					$lAutorisation = true;
				}
				
				// Création d'un varible de session pour tout les modules auquels l'adherent possède les autorisations. 
				$i = 1;
				while(isset($lListeIdentification[$i])) {
					$lIdentification = $lListeIdentification[$i];
					$_SESSION[$lIdentification->getModNom()] = true;
					$i++;
				}
			}
			
			if(!$lAutorisation) {
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_222_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_222_MSG);
				$lVr->getLog()->addErreur($lErreur);				
			}		
		}		
		return $lVr;
	}
}
?>