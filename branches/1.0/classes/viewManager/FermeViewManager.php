<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/10/2011
// Fichier : FermeViewManager.php
//
// Description : Classe de gestion des Ferme
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "FermeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

define("VUE_FERME", MYSQL_DB_PREFIXE . "view_ferme");
/**
 * @name FermeViewManager
 * @author Julien PIERRE
 * @since 26/10/2011
 * 
 * @desc Classe permettant l'accès aux données des Ferme
 */
class FermeViewManager
{
	const VUE_FERME = VUE_FERME;

	/**
	* @name select($pId)
	* @param integer
	* @return FermeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une FermeViewVO contenant les informations et la renvoie
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
			"," . FermeManager::CHAMP_FERME_SIREN . 
			"," . FermeManager::CHAMP_FERME_ADRESSE . 
			"," . FermeManager::CHAMP_FERME_CODE_POSTAL . 
			"," . FermeManager::CHAMP_FERME_VILLE . 
			"," . FermeManager::CHAMP_FERME_DATE_ADHESION . 
			"," . FermeManager::CHAMP_FERME_DESCRIPTION . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . "
			FROM " . FermeViewManager::VUE_FERME . " 
			WHERE " . FermeManager::CHAMP_FERME_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeFerme = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeFerme,
					FermeViewManager::remplir(
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[FermeManager::CHAMP_FERME_SIREN],
					$lLigne[FermeManager::CHAMP_FERME_ADRESSE],
					$lLigne[FermeManager::CHAMP_FERME_CODE_POSTAL],
					$lLigne[FermeManager::CHAMP_FERME_VILLE],
					$lLigne[FermeManager::CHAMP_FERME_DATE_ADHESION],
					$lLigne[FermeManager::CHAMP_FERME_DESCRIPTION],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
			}
		} else {
			$lListeFerme[0] = new FermeViewVO();
		}
		return $lListeFerme;
	}

	/**
	* @name selectAll()
	* @return array(FermeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de FermeViewVO
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
			"," . FermeManager::CHAMP_FERME_SIREN . 
			"," . FermeManager::CHAMP_FERME_ADRESSE . 
			"," . FermeManager::CHAMP_FERME_CODE_POSTAL . 
			"," . FermeManager::CHAMP_FERME_VILLE . 
			"," . FermeManager::CHAMP_FERME_DATE_ADHESION . 
			"," . FermeManager::CHAMP_FERME_DESCRIPTION . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . "
			FROM " . FermeViewManager::VUE_FERME;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeFerme = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeFerme,
					FermeViewManager::remplir(
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[FermeManager::CHAMP_FERME_SIREN],
					$lLigne[FermeManager::CHAMP_FERME_ADRESSE],
					$lLigne[FermeManager::CHAMP_FERME_CODE_POSTAL],
					$lLigne[FermeManager::CHAMP_FERME_VILLE],
					$lLigne[FermeManager::CHAMP_FERME_DATE_ADHESION],
					$lLigne[FermeManager::CHAMP_FERME_DESCRIPTION],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
			}
		} else {
			$lListeFerme[0] = new FermeViewVO();
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
	* @return array(FermeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de FermeViewVO
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
			"," . FermeManager::CHAMP_FERME_NOM .
			"," . FermeManager::CHAMP_FERME_SIREN .
			"," . FermeManager::CHAMP_FERME_ADRESSE .
			"," . FermeManager::CHAMP_FERME_CODE_POSTAL .
			"," . FermeManager::CHAMP_FERME_VILLE .
			"," . FermeManager::CHAMP_FERME_DATE_ADHESION .
			"," . FermeManager::CHAMP_FERME_DESCRIPTION .
			"," . FermeManager::CHAMP_FERME_ID_COMPTE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(FermeViewManager::VUE_FERME, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeFerme = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeFerme,
						FermeViewManager::remplir(
						$lLigne[FermeManager::CHAMP_FERME_ID],
						$lLigne[FermeManager::CHAMP_FERME_NUMERO],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[FermeManager::CHAMP_FERME_NOM],
						$lLigne[FermeManager::CHAMP_FERME_SIREN],
						$lLigne[FermeManager::CHAMP_FERME_ADRESSE],
						$lLigne[FermeManager::CHAMP_FERME_CODE_POSTAL],
						$lLigne[FermeManager::CHAMP_FERME_VILLE],
						$lLigne[FermeManager::CHAMP_FERME_DATE_ADHESION],
						$lLigne[FermeManager::CHAMP_FERME_DESCRIPTION],
						$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
				}
			} else {
				$lListeFerme[0] = new FermeViewVO();
			}

			return $lListeFerme;
		}

		$lListeFerme[0] = new FermeViewVO();
		return $lListeFerme;
	}

	/**
	* @name remplir($pFerId, $pFerNumero, $pCptLabel, $pFerNom, $pFerSiren, $pFerAdresse, $pFerCodePostal, $pFerVille, $pFerDateAdhesion, $pFerDescription, $pFerIdCompte)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(30)
	* @param text
	* @param int(9)
	* @param varchar(300)
	* @param varchar(10)
	* @param varchar(100)
	* @param date
	* @param text
	* @param int(11)
	* @return FermeViewVO
	* @desc Retourne une FermeViewVO remplie
	*/
	private static function remplir($pFerId, $pFerNumero, $pCptLabel, $pFerNom, $pFerSiren, $pFerAdresse, $pFerCodePostal, $pFerVille, $pFerDateAdhesion, $pFerDescription, $pFerIdCompte) {
		$lFerme = new FermeViewVO();
		$lFerme->setFerId($pFerId);
		$lFerme->setFerNumero($pFerNumero);
		$lFerme->setCptLabel($pCptLabel);
		$lFerme->setFerNom($pFerNom);
		$lFerme->setFerSiren($pFerSiren);
		$lFerme->setFerAdresse($pFerAdresse);
		$lFerme->setFerCodePostal($pFerCodePostal);
		$lFerme->setFerVille($pFerVille);
		$lFerme->setFerDateAdhesion($pFerDateAdhesion);
		$lFerme->setFerDescription($pFerDescription);
		$lFerme->setFerIdCompte($pFerIdCompte);
		return $lFerme;
	}
}
?>