<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : ListeFermeViewManager.php
//
// Description : Classe de gestion des Ferme
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeFermeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

define("VUE_FERME", MYSQL_DB_PREFIXE . "view_liste_ferme");
/**
 * @name ListeFermeViewManager
 * @author Julien PIERRE
 * @since 23/10/2011
 * 
 * @desc Classe permettant l'accès aux données des Ferme
 */
class ListeFermeViewManager
{
	const VUE_FERME = VUE_FERME;

	/**
	* @name select($pId)
	* @param integer
	* @return ListeFermeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeFermeViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . "
			FROM " . ListeFermeViewManager::VUE_FERME . " 
			WHERE " . FermeManager::CHAMP_FERME_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeFerme = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeFerme,
					ListeFermeViewManager::remplir(
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
			}
		} else {
			$lListeFerme[0] = new ListeFermeViewVO();
		}
		return $lListeFerme;
	}

	/**
	* @name selectAll()
	* @return array(ListeFermeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeFermeViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . "
			FROM " . ListeFermeViewManager::VUE_FERME;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeFerme = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeFerme,
					ListeFermeViewManager::remplir(
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
			}
		} else {
			$lListeFerme[0] = new ListeFermeViewVO();
		}
		return $lListeFerme;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeFermeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeFermeViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    FermeManager::CHAMP_FERME_ID .
			"," . FermeManager::CHAMP_FERME_NUMERO .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . FermeManager::CHAMP_FERME_NOM	. 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE 	);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeFermeViewManager::VUE_FERME, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeFerme = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeFerme,
						ListeFermeViewManager::remplir(
						$lLigne[FermeManager::CHAMP_FERME_ID],
						$lLigne[FermeManager::CHAMP_FERME_NUMERO],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[FermeManager::CHAMP_FERME_NOM],
						$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
				}
			} else {
				$lListeFerme[0] = new ListeFermeViewVO();
			}

			return $lListeFerme;
		}

		$lListeFerme[0] = new ListeFermeViewVO();
		return $lListeFerme;
	}

	/**
	* @name remplir($pFerId, $pFerNumero, $pCptLabel, $pFerNom, $pFerIdCompte)
	* @param int(11)
	* @param int(11)
	* @param varchar(30)
	* @param text
	* @param int(11)
	* @return ListeFermeViewVO
	* @desc Retourne une ListeFermeViewVO remplie
	*/
	private static function remplir($pFerId, $pFerNumero, $pCptLabel, $pFerNom, $pFerIdCompte) {
		$lFerme = new ListeFermeViewVO();
		$lFerme->setFerId($pFerId);
		$lFerme->setFerNumero($pFerNumero);
		$lFerme->setCptLabel($pCptLabel);
		$lFerme->setFerNom($pFerNom);
		$lFerme->setFerIdCompte($pFerIdCompte);
		return $lFerme;
	}
}
?>