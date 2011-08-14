<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2010
// Fichier : AdherentViewManager.php
//
// Description : Classe de gestion des Adherent
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "AdherentViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

/**
 * @name AdherentViewManager
 * @author Julien PIERRE
 * @since 08/09/2010
 * 
 * @desc Classe permettant l'accès aux données des Adherent
 */
class AdherentViewManager
{
	const VUE_ADHERENT = "view_adherent";

	/**
	* @name select($pId)
	* @param integer
	* @return AdherentViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AdherentViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
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
			"," . CompteManager::CHAMP_COMPTE_SOLDE .  
			"," . AdherentManager::CHAMP_ADHERENT_ETAT . "
			FROM " . AdherentViewManager::VUE_ADHERENT . " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return AdherentViewManager::remplir(
				$pId,
				$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
				$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
				$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
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
				$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
				$lLigne[AdherentManager::CHAMP_ADHERENT_ETAT]);
		} else {
			return new AdherentViewVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(AdherentViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AdherentViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE .   
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
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
			"," . CompteManager::CHAMP_COMPTE_SOLDE .  
			"," . AdherentManager::CHAMP_ADHERENT_ETAT . "
			FROM " . AdherentViewManager::VUE_ADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAdherent,
					AdherentViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
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
					$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ETAT]));
			}
		} else {
			$lListeAdherent[0] = new AdherentViewVO();
		}
		return $lListeAdherent;
	}
	
	/**
	* @name selectByIdCompte($pIdCompte)
	* @param integer
	* @return array(AdherentViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId et les renvoie sous forme d'une collection de AdherentViewVO
	*/
	public static function selectByIdCompte($pIdCompte) {
		return AdherentViewManager::recherche(
			array(AdherentManager::CHAMP_ADHERENT_ID_COMPTE),
			array('='),
			array($pIdCompte),
			array(AdherentManager::CHAMP_ADHERENT_ID),
			array('ASC'));
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AdherentViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AdherentViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
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
			"," . CompteManager::CHAMP_COMPTE_SOLDE	.  
			"," . AdherentManager::CHAMP_ADHERENT_ETAT);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AdherentViewManager::VUE_ADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAdherent = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeAdherent,
						AdherentViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
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
						$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ETAT]));
				}
			} else {
				$lListeAdherent[0] = new AdherentViewVO();
			}
	
			return $lListeAdherent;
		}
	
		$lListeAdherent[0] = new AdherentViewVO();
		return $lListeAdherent;
	}

	/**
	* @name remplir($pAdhId, $pAdhNumero, $pAdhIdCompte, $pCptLabel, $pAdhNom, $pAdhPrenom, $pAdhCourrielPrincipal, $pAdhCourrielSecondaire, $pAdhTelephonePrincipal, $pAdhTelephoneSecondaire, $pAdhAdresse, $pAdhCodePostal, $pAdhVille, $pAdhDateNaissance, $pAdhDateAdhesion, $pAdhDateMaj, $pAdhCommentaire, $pCptSolde, $pAdhEtat)
	* @param int(11)
	* @param varchar(5)
	* @param int(11)
	* @param varchar(30)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(100)
	* @param varchar(100)
	* @param varchar(20)
	* @param varchar(20)
	* @param varchar(300)
	* @param varchar(10)
	* @param varchar(100)
	* @param date
	* @param date
	* @param datetime
	* @param text
	* @param decimal(32,2)
	* @param tinyint(1)
	* @return AdherentViewVO
	* @desc Retourne une AdherentViewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhNumero, $pAdhIdCompte, $pCptLabel, $pAdhNom, $pAdhPrenom, $pAdhCourrielPrincipal, $pAdhCourrielSecondaire, $pAdhTelephonePrincipal, $pAdhTelephoneSecondaire, $pAdhAdresse, $pAdhCodePostal, $pAdhVille, $pAdhDateNaissance, $pAdhDateAdhesion, $pAdhDateMaj, $pAdhCommentaire, $pCptSolde, $pAdhEtat) {
		$lAdherent = new AdherentViewVO();
		$lAdherent->setAdhId($pAdhId);
		$lAdherent->setAdhNumero($pAdhNumero);
		$lAdherent->setAdhIdCompte($pAdhIdCompte);
		$lAdherent->setCptLabel($pCptLabel);
		$lAdherent->setAdhNom($pAdhNom);
		$lAdherent->setAdhPrenom($pAdhPrenom);
		$lAdherent->setAdhCourrielPrincipal($pAdhCourrielPrincipal);
		$lAdherent->setAdhCourrielSecondaire($pAdhCourrielSecondaire);
		$lAdherent->setAdhTelephonePrincipal($pAdhTelephonePrincipal);
		$lAdherent->setAdhTelephoneSecondaire($pAdhTelephoneSecondaire);
		$lAdherent->setAdhAdresse($pAdhAdresse);
		$lAdherent->setAdhCodePostal($pAdhCodePostal);
		$lAdherent->setAdhVille($pAdhVille);
		$lAdherent->setAdhDateNaissance($pAdhDateNaissance);
		$lAdherent->setAdhDateAdhesion($pAdhDateAdhesion);
		$lAdherent->setAdhDateMaj($pAdhDateMaj);
		$lAdherent->setAdhCommentaire($pAdhCommentaire);
		$lAdherent->setCptSolde($pCptSolde);
		$lAdherent->setAdhEtat($pAdhEtat);
		return $lAdherent;
	}
}
?>