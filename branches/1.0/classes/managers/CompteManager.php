<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : CompteManager.php
//
// Description : Classe de gestion des Compte
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CompteVO.php");

/**
 * @name CompteManager
 * @author Julien PIERRE
 * @since 02/09/2010
 * 
 * @desc Classe permettant l'accès aux données des Compte
 */
class CompteManager
{
	const TABLE_COMPTE = "cpt_compte";
	const CHAMP_COMPTE_ID = "cpt_id";
	const CHAMP_COMPTE_LABEL = "cpt_label";

	/**
	* @name select($pId)
	* @param integer
	* @return CompteVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CompteVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteManager::CHAMP_COMPTE_ID . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . "
			FROM " . CompteManager::TABLE_COMPTE . " 
			WHERE " . CompteManager::CHAMP_COMPTE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CompteManager::remplirCompte(
				$pId,
				$lLigne[CompteManager::CHAMP_COMPTE_LABEL]);
		} else {
			return new CompteVO();
		}
	}

	/**
	* @name selectAll
	* @return array(CompteVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CompteVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteManager::CHAMP_COMPTE_ID . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . "
			FROM " . CompteManager::TABLE_COMPTE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompte = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompte,
					CompteManager::remplirCompte(
					$lLigne[CompteManager::CHAMP_COMPTE_ID],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
			}
		} else {
			$lListeCompte[0] = new CompteVO();
		}
		return $lListeCompte;
	}
	
	/**
	* @name selectByLabel($pLabel)
	* @param string
	* @return array(CompteVO)
	* @desc Récupères toutes les lignes de la table ayant pour Label $pLabel et les renvoie sous forme d'une collection de CompteVO
	*/
	public static function selectByLabel($pLabel) {		
		return CompteManager::recherche(
			array(CompteManager::CHAMP_COMPTE_LABEL),
			array('='),
			array($pLabel),
			array(CompteManager::CHAMP_COMPTE_ID),
			array('DESC'));
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
			    CompteManager::CHAMP_COMPTE_ID .
			"," . CompteManager::CHAMP_COMPTE_LABEL );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CompteManager::TABLE_COMPTE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);
	
		$lListeCompte = array();

		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeCompte,
						CompteManager::remplirCompte(
						$lLigne[CompteManager::CHAMP_COMPTE_ID],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
				}
			} else {
				$lListeCompte[0] = new CompteVO();
			}
	
			return $lListeCompte;
		}
			
		$lListeCompte[0] = new CompteVO();
		return $lListeCompte;
	}

	/**
	* @name remplirCompte($pId, $pLabel)
	* @param int(11)
	* @param varchar(30)
	* @return CompteVO
	* @desc Retourne une CompteVO remplie
	*/
	private static function remplirCompte($pId, $pLabel) {
		$lCompte = new CompteVO();
		$lCompte->setId($pId);
		$lCompte->setLabel($pLabel);
		return $lCompte;
	}

	/**
	* @name insert($pVo)
	* @param CompteVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CompteVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CompteManager::TABLE_COMPTE . "
				(" . CompteManager::CHAMP_COMPTE_ID . "
				," . CompteManager::CHAMP_COMPTE_LABEL . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param CompteVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CompteVO, avec les informations du CompteVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CompteManager::TABLE_COMPTE . "
			 SET
				 " . CompteManager::CHAMP_COMPTE_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
			 WHERE " . CompteManager::CHAMP_COMPTE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

	/**
	* @name delete($pId)
	* @param integer
	* @desc Supprime la ligne de la table correspondant à l'id en paramètre
	*/
	public static function delete($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = "DELETE FROM " . CompteManager::TABLE_COMPTE . "
			WHERE " . CompteManager::CHAMP_COMPTE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>