<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : AdherentSoldeManager.php
//
// Description : Classe de gestion d'un Adherent avec son solde
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");

/**
 * @name AdherentSoldeManager
 * @author Julien PIERRE
 * @since 01/02/2010
 * 
 * @desc Classe permettant l'accès aux données de l'adhérent avec son solde
 */
class AdherentSoldeManager extends AdherentManager
{
	/**
	* @name select($pId)
	* @param integer
	* @return AdherentSoldeVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé un AdherentVO contenant les informations et le renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = "SELECT " . AdherentManager::CHAMP_ADHERENT_MOT_PASSE . "," . AdherentManager::CHAMP_ADHERENT_NUMERO . "," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . "," . AdherentManager::CHAMP_ADHERENT_NOM . "," . AdherentManager::CHAMP_ADHERENT_PRENOM . "," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . "," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE . "," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL . "," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE . "," . AdherentManager::CHAMP_ADHERENT_ADRESSE . "," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL . "," . AdherentManager::CHAMP_ADHERENT_VILLE . "," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE . "," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION . "," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ . "," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE . "," . AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU . " 
					FROM " . AdherentManager::TABLE_ADHERENT . " 
					WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '". StringUtils::securiser($pId) . "'";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			$lAdherent = AdherentSoldeManager::remplirAdherent(
								$pId,
								$lLigne[AdherentManager::CHAMP_ADHERENT_MOT_PASSE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
								$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
								$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
								$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
								$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
								$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_ADRESSE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_CODE_POSTAL],
								$lLigne[AdherentManager::CHAMP_ADHERENT_VILLE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_ADHESION],
								$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_MAJ],
								$lLigne[AdherentManager::CHAMP_ADHERENT_COMMENTAIRE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU]);
								
		
			
			// Ajout des modules d'accés
			$lListeAutorisation = AutorisationManager::selectByIdAdherent( $lAdherent->getId() );
			$lListeModuleAll = ModuleManager::selectAll();
			
			$lListeModule = array();
			foreach( $lListeAutorisation as $lAutorisation) {
				if($lListeModuleAll[$lAutorisation->getIdModule()] === NULL) {
					$lListeModuleAll[$lAutorisation->getIdModule()] = new ModuleVO();
				}
				array_push( $lListeModule , $lListeModuleAll[$lAutorisation->getIdModule()] );
			}
			
			$lAdherent->setListeModule($lListeModule);
			
			return $lAdherent;
		} else {
			return new AdherentSoldeVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(AdherentSoldeVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AdherentSoldeVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = "SELECT SELECT " . AdherentManager::CHAMP_ADHERENT_ID . "," . AdherentManager::CHAMP_ADHERENT_MOT_PASSE . "," . AdherentManager::CHAMP_ADHERENT_NUMERO . "," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . "," . AdherentManager::CHAMP_ADHERENT_NOM . "," . AdherentManager::CHAMP_ADHERENT_PRENOM . "," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . "," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE . "," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL . "," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE . "," . AdherentManager::CHAMP_ADHERENT_ADRESSE . "," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL . "," . AdherentManager::CHAMP_ADHERENT_VILLE . "," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE . "," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION . "," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ . "," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE . "," . AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU . " 
					FROM " . AdherentManager::TABLE_ADHERENT;
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdherent = array();

		if( mysql_num_rows($lSql) > 0 ) {
			$lListeModuleAll = ModuleManager::selectAll();
	
			while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
				$lAdherent = AdherentSoldeManager::remplirAdherent(
								$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
								$lLigne[AdherentManager::CHAMP_ADHERENT_MOT_PASSE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
								$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
								$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
								$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
								$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
								$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_ADRESSE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_CODE_POSTAL],
								$lLigne[AdherentManager::CHAMP_ADHERENT_VILLE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_ADHESION],
								$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_MAJ],
								$lLigne[AdherentManager::CHAMP_ADHERENT_COMMENTAIRE],
								$lLigne[AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU]);
	
				// Ajout des modules d'accés
				$lListeAutorisation = AutorisationManager::selectByIdAdherent( $lAdherent->getId() );
				
				$lListeModule = array();
				foreach( $lListeAutorisation as $lAutorisation) {
					if($lListeModuleAll[$lAutorisation->getIdModule()] === NULL) {
						$lListeModuleAll[$lAutorisation->getIdModule()] = new ModuleVO();
					}
					array_push( $lListeModule , $lListeModuleAll[$lAutorisation->getIdModule()] );
				}
				$lAdherent->setListeModule($lListeModule);
			
				array_push($lListeAdherent,$lAdherent);
	
			}
		} else {
			$lListeAdherent[0] = new AdherentSoldeVO();
		}
		
		return $lListeAdherent;
	}

	/**
	* @name recherche( $pTypeRecherche, $pCritereRecherche, $pTypeTri, $pCritereTri )	
	* @param string nom de la table
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AdherentSoldeVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AdherentVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		// Préparation de la requète
		$lChamps = array( 
				AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_MOT_PASSE .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL .
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE .
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL .
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE .
			"," . AdherentManager::CHAMP_ADHERENT_ADRESSE .
			"," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL .
			"," . AdherentManager::CHAMP_ADHERENT_VILLE .
			"," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE .
			"," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION .
			"," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ .
			"," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE .
			"," . AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU );
		
		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AdherentManager::TABLE_ADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAdherent = array();
			
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);	
			
			if( mysql_num_rows($lSql) > 0 ) {
				$lListeModuleAll = ModuleManager::selectAll();
		
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
		
					$lAdherent = AdherentSoldeManager::remplirAdherent(
									$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
									$lLigne[AdherentManager::CHAMP_ADHERENT_MOT_PASSE],
									$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
									$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
									$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
									$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
									$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
									$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE],
									$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
									$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE],
									$lLigne[AdherentManager::CHAMP_ADHERENT_ADRESSE],
									$lLigne[AdherentManager::CHAMP_ADHERENT_CODE_POSTAL],
									$lLigne[AdherentManager::CHAMP_ADHERENT_VILLE],
									$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE],
									$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_ADHESION],
									$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_MAJ],
									$lLigne[AdherentManager::CHAMP_ADHERENT_COMMENTAIRE],
									$lLigne[AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU]);
									
					// Ajout des modules d'accés
					$lListeAutorisation = AutorisationManager::selectByIdAdherent( $lAdherent->getId() );
					
					$lListeModule = array();
					foreach( $lListeAutorisation as $lAutorisation) {
						if($lListeModuleAll[$lAutorisation->getIdModule()] === NULL) {
							$lListeModuleAll[$lAutorisation->getIdModule()] = new ModuleVO();
						}
						array_push( $lListeModule , $lListeModuleAll[$lAutorisation->getIdModule()] );
					}
					$lAdherent->setListeModule($lListeModule);
				
					array_push($lListeAdherent,$lAdherent);
				}		
			} else {
				$lListeAdherent[0] = new AdherentSoldeVO();
			}			
			return $lListeAdherent;
		}
		
		$lListeAdherent[0] = new AdherentSoldeVO();
		return $lListeAdherent;
	}
	
	/**
	* @name remplirAdherent($pId, $pPass, $pNumero, $pIdCompte, $pNom, $pPrenom, $pCourrielPrincipal, $pCourrielSecondaire, $pTelephonePrincipal, $pTelephoneSecondaire, $pAdresse, $pCodePostal, $pVille, $pDateNaissance, $pDateAdhesion, $pDateMaj, $pCommentaire, $pSuperZeybu)
	* @param integer
	* @param string
	* @param string
	* @param integer
	* @param string
	* @param string
	* @param string
	* @param string
	* @param string
	* @param string
	* @param string
	* @param string
	* @param string
	* @param date
	* @param date
	* @param date
	* @param string
	* @param integer
	* @return AdherentSoldeVO
	* @desc Retourne un AdherentSoldeVO remplis
	*/
	private static function remplirAdherent($pId, $pPass, $pNumero, $pIdCompte, $pNom, $pPrenom, $pCourrielPrincipal, $pCourrielSecondaire, $pTelephonePrincipal, $pTelephoneSecondaire, $pAdresse, $pCodePostal, $pVille, $pDateNaissance, $pDateAdhesion, $pDateMaj, $pCommentaire, $pSuperZeybu) {
		$lAdherent = new AdherentSoldeVO();

		$lAdherent->setId($pId);
		$lAdherent->setPass($pPass);
		$lAdherent->setNumero($pNumero);
		$lAdherent->setIdCompte($pIdCompte);
		$lAdherent->setNom($pNom);
		$lAdherent->setPrenom($pPrenom);
		$lAdherent->setCourrielPrincipal($pCourrielPrincipal);
		$lAdherent->setCourrielSecondaire($pCourrielSecondaire);
		$lAdherent->setTelephonePrincipal($pTelephonePrincipal);
		$lAdherent->setTelephoneSecondaire($pTelephoneSecondaire);
		$lAdherent->setAdresse($pAdresse);
		$lAdherent->setCodePostal($pCodePostal);
		$lAdherent->setVille($pVille);
		$lAdherent->setDateNaissance($pDateNaissance);
		$lAdherent->setDateAdhesion($pDateAdhesion);
		$lAdherent->setDateMaj($pDateMaj);
		$lAdherent->setCommentaire($pCommentaire);
		$lAdherent->setSuperZeybu($pSuperZeybu);
		
		// Ajout des Opérations
		$lAdherent->setListeOperation(OperationManager::selectByIdCompte( $lAdherent->getIdCompte() ));
				
		// Ajout du montant du solde
		$lAdherent->setSolde(OperationManager::soldeAdherent($lAdherent->getId()));
		
		return $lAdherent;
	}
}
?>
