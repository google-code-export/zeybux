<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : AbonnementListeAdherentViewManager.php
//
// Description : Classe de gestion des AbonnementListeAdherent
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "AbonnementListeAdherentViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

define("VUE_ABONNEMENTLISTEADHERENT", MYSQL_DB_PREFIXE . "view_abonnement_liste_adherent");
/**
 * @name AbonnementListeAdherentViewManager
 * @author Julien PIERRE
 * @since 15/02/2012
 * 
 * @desc Classe permettant l'accès aux données des AbonnementListeAdherent
 */
class AbonnementListeAdherentViewManager
{
	const VUE_ABONNEMENTLISTEADHERENT = VUE_ABONNEMENTLISTEADHERENT;

	/**
	* @name select($pId)
	* @param integer
	* @return AbonnementListeAdherentViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AbonnementListeAdherentViewVO contenant les informations et la renvoie
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
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . CompteManager::CHAMP_COMPTE_ID . "
			FROM " . AbonnementListeAdherentViewManager::VUE_ABONNEMENTLISTEADHERENT . " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAbonnementListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAbonnementListeAdherent,
					AbonnementListeAdherentViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[CompteManager::CHAMP_COMPTE_ID]));
			}
		} else {
			$lListeAbonnementListeAdherent[0] = new AbonnementListeAdherentViewVO();
		}
		return $lListeAbonnementListeAdherent;
	}

	/**
	* @name selectAll()
	* @return array(AbonnementListeAdherentViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AbonnementListeAdherentViewVO
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
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . CompteManager::CHAMP_COMPTE_ID . "
			FROM " . AbonnementListeAdherentViewManager::VUE_ABONNEMENTLISTEADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAbonnementListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAbonnementListeAdherent,
					AbonnementListeAdherentViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[CompteManager::CHAMP_COMPTE_ID]));
			}
		} else {
			$lListeAbonnementListeAdherent[0] = new AbonnementListeAdherentViewVO();
		}
		return $lListeAbonnementListeAdherent;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AbonnementListeAdherentViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AbonnementListeAdherentViewVO
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
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . CompteManager::CHAMP_COMPTE_ID		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AbonnementListeAdherentViewManager::VUE_ABONNEMENTLISTEADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAbonnementListeAdherent = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeAbonnementListeAdherent,
						AbonnementListeAdherentViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[CompteManager::CHAMP_COMPTE_ID]));
				}
			} else {
				$lListeAbonnementListeAdherent[0] = new AbonnementListeAdherentViewVO();
			}

			return $lListeAbonnementListeAdherent;
		}

		$lListeAbonnementListeAdherent[0] = new AbonnementListeAdherentViewVO();
		return $lListeAbonnementListeAdherent;
	}

	/**
	* @name remplir($pAdhId, $pAdhNumero, $pAdhNom, $pAdhPrenom, $pCptLabel, $pCptId)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(30)
	* @param int(11)
	* @return AbonnementListeAdherentViewVO
	* @desc Retourne une AbonnementListeAdherentViewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhNumero, $pAdhNom, $pAdhPrenom, $pCptLabel, $pCptId) {
		$lAbonnementListeAdherent = new AbonnementListeAdherentViewVO();
		$lAbonnementListeAdherent->setAdhId($pAdhId);
		$lAbonnementListeAdherent->setAdhNumero($pAdhNumero);
		$lAbonnementListeAdherent->setAdhNom($pAdhNom);
		$lAbonnementListeAdherent->setAdhPrenom($pAdhPrenom);
		$lAbonnementListeAdherent->setCptLabel($pCptLabel);
		$lAbonnementListeAdherent->setCptId($pCptId);
		return $lAbonnementListeAdherent;
	}
}
?>