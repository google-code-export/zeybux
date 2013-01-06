<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : AccesManager.php
//
// Description : Classe de gestion des Acces
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "AccesVO.php");

define("TABLE_ACCES", MYSQL_DB_PREFIXE . "acc_acces");
/**
 * @name AccesManager
 * @author Julien PIERRE
 * @since 26/06/2011
 * 
 * @desc Classe permettant l'accès aux données des Acces
 */
class AccesManager
{
	const TABLE_ACCES = TABLE_ACCES;
	const CHAMP_ACCES_ID = "acc_id";
	const CHAMP_ACCES_ID_LOGIN = "acc_id_login";
	const CHAMP_ACCES_TYPE_LOGIN = "acc_type_login";
	const CHAMP_ACCES_IP = "acc_ip";
	const CHAMP_ACCES_DATE_CREATION = "acc_date_creation";
	const CHAMP_ACCES_DATE_MODIFICATION = "acc_date_modification";
	const CHAMP_ACCES_AUTORISE = "acc_autorise";

	/**
	* @name select($pId)
	* @param integer
	* @return AccesVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AccesVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AccesManager::CHAMP_ACCES_ID . 
			"," . AccesManager::CHAMP_ACCES_ID_LOGIN . 
			"," . AccesManager::CHAMP_ACCES_TYPE_LOGIN . 
			"," . AccesManager::CHAMP_ACCES_IP . 
			"," . AccesManager::CHAMP_ACCES_DATE_CREATION . 
			"," . AccesManager::CHAMP_ACCES_DATE_MODIFICATION . 
			"," . AccesManager::CHAMP_ACCES_AUTORISE . "
			FROM " . AccesManager::TABLE_ACCES . " 
			WHERE " . AccesManager::CHAMP_ACCES_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return AccesManager::remplirAcces(
				$pId,
				$lLigne[AccesManager::CHAMP_ACCES_ID_LOGIN],
				$lLigne[AccesManager::CHAMP_ACCES_TYPE_LOGIN],
				$lLigne[AccesManager::CHAMP_ACCES_IP],
				$lLigne[AccesManager::CHAMP_ACCES_DATE_CREATION],
				$lLigne[AccesManager::CHAMP_ACCES_DATE_MODIFICATION],
				$lLigne[AccesManager::CHAMP_ACCES_AUTORISE]);
		} else {
			return new AccesVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(AccesVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AccesVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AccesManager::CHAMP_ACCES_ID . 
			"," . AccesManager::CHAMP_ACCES_ID_LOGIN . 
			"," . AccesManager::CHAMP_ACCES_TYPE_LOGIN . 
			"," . AccesManager::CHAMP_ACCES_IP . 
			"," . AccesManager::CHAMP_ACCES_DATE_CREATION . 
			"," . AccesManager::CHAMP_ACCES_DATE_MODIFICATION . 
			"," . AccesManager::CHAMP_ACCES_AUTORISE . "
			FROM " . AccesManager::TABLE_ACCES;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAcces = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAcces,
					AccesManager::remplirAcces(
					$lLigne[AccesManager::CHAMP_ACCES_ID],
					$lLigne[AccesManager::CHAMP_ACCES_ID_LOGIN],
					$lLigne[AccesManager::CHAMP_ACCES_TYPE_LOGIN],
					$lLigne[AccesManager::CHAMP_ACCES_IP],
					$lLigne[AccesManager::CHAMP_ACCES_DATE_CREATION],
					$lLigne[AccesManager::CHAMP_ACCES_DATE_MODIFICATION],
					$lLigne[AccesManager::CHAMP_ACCES_AUTORISE]));
			}
		} else {
			$lListeAcces[0] = new AccesVO();
		}
		return $lListeAcces;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AccesVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AccesVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AccesManager::CHAMP_ACCES_ID .
			"," . AccesManager::CHAMP_ACCES_ID_LOGIN .
			"," . AccesManager::CHAMP_ACCES_TYPE_LOGIN .
			"," . AccesManager::CHAMP_ACCES_IP .
			"," . AccesManager::CHAMP_ACCES_DATE_CREATION .
			"," . AccesManager::CHAMP_ACCES_DATE_MODIFICATION .
			"," . AccesManager::CHAMP_ACCES_AUTORISE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AccesManager::TABLE_ACCES, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAcces = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeAcces,
						AccesManager::remplirAcces(
						$lLigne[AccesManager::CHAMP_ACCES_ID],
						$lLigne[AccesManager::CHAMP_ACCES_ID_LOGIN],
						$lLigne[AccesManager::CHAMP_ACCES_TYPE_LOGIN],
						$lLigne[AccesManager::CHAMP_ACCES_IP],
						$lLigne[AccesManager::CHAMP_ACCES_DATE_CREATION],
						$lLigne[AccesManager::CHAMP_ACCES_DATE_MODIFICATION],
						$lLigne[AccesManager::CHAMP_ACCES_AUTORISE]));
				}
			} else {
				$lListeAcces[0] = new AccesVO();
			}

			return $lListeAcces;
		}

		$lListeAcces[0] = new AccesVO();
		return $lListeAcces;
	}

	/**
	* @name remplirAcces($pId, $pIdLogin, $pTypeLogin, $pIp, $pDateCreation, $pDateModification, $pAutorise)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(40)
	* @param datetime
	* @param timestamp
	* @param int(11)
	* @return AccesVO
	* @desc Retourne une AccesVO remplie
	*/
	private static function remplirAcces($pId, $pIdLogin, $pTypeLogin, $pIp, $pDateCreation, $pDateModification, $pAutorise) {
		$lAcces = new AccesVO();
		$lAcces->setId($pId);
		$lAcces->setIdLogin($pIdLogin);
		$lAcces->setTypeLogin($pTypeLogin);
		$lAcces->setIp($pIp);
		$lAcces->setDateCreation($pDateCreation);
		$lAcces->setDateModification($pDateModification);
		$lAcces->setAutorise($pAutorise);
		return $lAcces;
	}

	/**
	* @name insert($pVo)
	* @param AccesVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la AccesVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . AccesManager::TABLE_ACCES . "
				(" . AccesManager::CHAMP_ACCES_ID . "
				," . AccesManager::CHAMP_ACCES_ID_LOGIN . "
				," . AccesManager::CHAMP_ACCES_TYPE_LOGIN . "
				," . AccesManager::CHAMP_ACCES_IP . "
				," . AccesManager::CHAMP_ACCES_DATE_CREATION . "
				," . AccesManager::CHAMP_ACCES_DATE_MODIFICATION . "
				," . AccesManager::CHAMP_ACCES_AUTORISE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdLogin() ) . "'
				,'" . StringUtils::securiser( $pVo->getTypeLogin() ) . "'
				,'" . StringUtils::securiser( $pVo->getIp() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getAutorise() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}
	
	/**
	* @name update($pVo)
	* @param AccesVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du AccesVO, avec les informations du AccesVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$pVo->setDateModification(StringUtils::dateTimeAujourdhuiDb());
		
		$lRequete = 
			"UPDATE " . AccesManager::TABLE_ACCES . "
			 SET
				 " . AccesManager::CHAMP_ACCES_ID_LOGIN . " = '" . StringUtils::securiser( $pVo->getIdLogin() ) . "'
				," . AccesManager::CHAMP_ACCES_TYPE_LOGIN . " = '" . StringUtils::securiser( $pVo->getTypeLogin() ) . "'
				," . AccesManager::CHAMP_ACCES_IP . " = '" . StringUtils::securiser( $pVo->getIp() ) . "'
				," . AccesManager::CHAMP_ACCES_DATE_CREATION . " = '" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				," . AccesManager::CHAMP_ACCES_DATE_MODIFICATION . " = '" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				," . AccesManager::CHAMP_ACCES_AUTORISE . " = '" . StringUtils::securiser( $pVo->getAutorise() ) . "'
			 WHERE " . AccesManager::CHAMP_ACCES_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . AccesManager::TABLE_ACCES . "
			WHERE " . AccesManager::CHAMP_ACCES_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>