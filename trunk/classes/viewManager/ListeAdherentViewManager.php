<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/09/2010
// Fichier : ListeAdherentViewManager.php
//
// Description : Classe d'accès à la vue view_liste_adherent
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeAdherentViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

define("VUE_LISTE_ADHERENT", MYSQL_DB_PREFIXE . "view_liste_adherent");
/**
 * @name ListeAdherentViewManager
 * @author Julien PIERRE
 * @since 05/09/2010
 * 
 * @desc Classe permettant l'accès à la vue view_liste_adherent
 */
class ListeAdherentViewManager
{
	const VUE_LISTE_ADHERENT = VUE_LISTE_ADHERENT;
	
	/**
	* @name select($pId)
	* @param int(11)
	* @return ListeAdherentViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeAdherentViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . 
			"," . CompteManager::CHAMP_COMPTE_SOLDE . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . "
			FROM " . ListeAdherentViewManager::VUE_LISTE_ADHERENT. " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ListeAdherentViewManager::remplir(
				$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
				$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
				$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
				$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
				$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
				$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
				$lLigne[CompteManager::CHAMP_COMPTE_LABEL]);
		} else {
			return new ListeAdherentViewVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ListeAdherentViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeAdherentViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . 
			"," . CompteManager::CHAMP_COMPTE_SOLDE . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . "
			FROM " . ListeAdherentViewManager::VUE_LISTE_ADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAdherent,
					ListeAdherentViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
						$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
			}
		} else {
			$lListeAdherent[0] = new ListeAdherentViewVO();
		}
		return $lListeAdherent;
	}
	
	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CompteVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CompteVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL .
			"," . CompteManager::CHAMP_COMPTE_SOLDE .
			"," . CompteManager::CHAMP_COMPTE_LABEL	);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeAdherentViewManager::VUE_LISTE_ADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAdherent = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
					array_push($lListeAdherent,
						ListeAdherentViewManager::remplir(
							$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
							$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
							$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
							$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
							$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
							$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
							$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
				}
			} else {
				$lListeAdherent[0] = new ListeAdherentViewVO();
			}
			
			return $lListeAdherent;
		}

		$lListeAdherent[0] = new ListeAdherentViewVO();
		return $lListeAdherent;
	}
	
	/**
	* @name remplir($pAdhId, $pAdhNumero, $pAdhNom, $pAdhPrenom, $pAdhCourrielPrincipal, $pCptSolde, $pCptLabel)
	* @param int(11)
	* @param varchar(5)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(100)
	* @param decimal(32,2)
	* @param varchar(30)
	* @return ListeAdherentViewVO
	* @desc Retourne une ListeAdherentiewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhNumero, $pAdhNom, $pAdhPrenom, $pAdhCourrielPrincipal, $pCptSolde, $pCptLabel) {
		$lListeAdherent = new ListeAdherentViewVO();
		$lListeAdherent->setAdhId($pAdhId);
		$lListeAdherent->setAdhNumero($pAdhNumero);
		$lListeAdherent->setAdhNom($pAdhNom);
		$lListeAdherent->setAdhPrenom($pAdhPrenom);
		$lListeAdherent->setAdhCourrielPrincipal($pAdhCourrielPrincipal);
		$lListeAdherent->setCptSolde($pCptSolde);
		$lListeAdherent->setCptLabel($pCptLabel);
		return $lListeAdherent;
	}
}
?>