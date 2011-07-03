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
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AccesManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdentificationValid.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "IdentificationResponse.php" );

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
			$lListeIdentification = IdentificationManager::selectByLogin($lLogin);
	
			// Recherche de correspondance de login et mot de passe dans la base 
			$lAutorisation = false;
			$lModules = array();
			if(is_array($lListeIdentification)) {
				foreach($lListeIdentification as $lIdentification) {
					if($lIdentification->getLogin() === $lLogin && $lIdentification->getPass() === $lPass && $lIdentification->getAutorise() == 1) {
						switch($lIdentification->getType()) {
							case 1 : // Adhérent
								$lModules = $this->identifierAdherent($lIdentification);
								break;
							
							case 2 : // SuperZeybu
								$lModules = $this->identifierSuperZeybu($lIdentification);
								break;
								
							case 3 : // Caisse
								$lModules = $this->identifierCaisse($lIdentification);
								break;
								
							case 4 : // Compte Solidaire
								$lModules = $this->identifierCompteSolidaire($lIdentification);
								break;
						}
						$_SESSION[TYPE_ID] = $lIdentification->getType();
						$lAutorisation = true;
						
						$lAcces = new AccesVO();
						$lAcces->setIdLogin($lIdentification->getIdLogin());
						$lAcces->setTypeLogin($lIdentification->getType());
						$lAcces->setIp($_SERVER["REMOTE_ADDR"]);
						$lAcces->setDateCreation(StringUtils::dateTimeAujourdhuiDb());
						$lAcces->setAutorise(1);
						$_SESSION[ID_CONNEXION] = AccesManager::insert($lAcces);
					}
				}
			}
			
			if($lAutorisation) {
				$lResponse = new IdentificationResponse();
				$lResponse->setType($_SESSION[TYPE_ID]);
				$lResponse->setModules($lModules);
				return $lResponse;				
			} else {
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
	
	/**
	* @name identifierAdherent($pIdentification)
	* @return 
	* @desc Effectue les actions de connexion d'un adhérent
	*/
	public function identifierAdherent($pIdentification) {
		$lListeIdentification = IdentificationViewManager::select($pIdentification->getIdLogin());		
		$lModules = array();
		if(is_array($lListeIdentification)) { 
			// Création d'une variable de session avec l'id de l'adherent lui permettant de lui donner les droits de connexion
			$_SESSION[DROIT_ID] = $pIdentification->getIdLogin();
			$_SESSION[ID_COMPTE] = $lListeIdentification[0]->getAdhIdCompte(); // TODO Vérifier l'utilisation de cette variable
			foreach($lListeIdentification as $lLigne) {
				$_SESSION[$lLigne->getModNom()] = true;
				array_push($lModules,$lLigne->getModNom());
			}	
		}
		return $lModules;
	}
	
	/**
	* @name identifierSuperZeybu($pIdentification)
	* @return 
	* @desc Effectue les actions de connexion d'un SuperZeybu
	*/
	public function identifierSuperZeybu($pIdentification) {	
		$_SESSION[DROIT_ID] = $pIdentification->getIdLogin();
		$_SESSION[DROIT_SUPER_ZEYBU] = $pIdentification->getIdLogin();
		return array();
	}
	
	/**
	* @name identifierCaisse($pIdentification)
	* @return 
	* @desc Effectue les actions de connexion d'une Caisse
	*/
	public function identifierCaisse($pIdentification) {
		$lModules = array();
		$_SESSION[DROIT_ID] = $pIdentification->getIdLogin();
		$_SESSION[MOD_CAISSE] = true;
		array_push($lModules,MOD_CAISSE);
		return $lModules;
	}
	
	/**
	* @name identifierCompteSolidaire($pIdentification)
	* @return 
	* @desc Effectue les actions de connexion du compte Solidaire
	*/
	public function identifierCompteSolidaire($pIdentification) {
		$lModules = array();
		$_SESSION[DROIT_ID] = $pIdentification->getIdLogin();
		$_SESSION[MOD_COMPTE_SOLIDAIRE] = true;
		array_push($lModules,MOD_COMPTE_SOLIDAIRE);
		return $lModules;
	}
}
?>