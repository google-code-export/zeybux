<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/06/2011
// Fichier : IdentificationManager.php
//
// Description : Classe de gestion des Identification
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "IdentificationVO.php");

/**
 * @name IdentificationManager
 * @author Julien PIERRE
 * @since 19/06/2011
 * 
 * @desc Classe permettant l'accès aux données des Identification
 */
class IdentificationManager
{
	const TABLE_IDENTIFICATION = "ide_identification";
	const CHAMP_IDENTIFICATION_ID = "ide_id";
	const CHAMP_IDENTIFICATION_ID_LOGIN = "ide_id_login";
	const CHAMP_IDENTIFICATION_LOGIN = "ide_login";
	const CHAMP_IDENTIFICATION_PASS = "ide_pass";
	const CHAMP_IDENTIFICATION_TYPE = "ide_type";
	const CHAMP_IDENTIFICATION_AUTORISE = "ide_autorise";

	/**
	* @name select($pId)
	* @param integer
	* @return IdentificationVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une IdentificationVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . IdentificationManager::CHAMP_IDENTIFICATION_ID . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_LOGIN . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_PASS . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_TYPE . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_AUTORISE . "
			FROM " . IdentificationManager::TABLE_IDENTIFICATION . " 
			WHERE " . IdentificationManager::CHAMP_IDENTIFICATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return IdentificationManager::remplirIdentification(
				$pId,
				$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN],
				$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_LOGIN],
				$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_PASS],
				$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_TYPE],
				$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_AUTORISE]);
		} else {
			return new IdentificationVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(IdentificationVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de IdentificationVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . IdentificationManager::CHAMP_IDENTIFICATION_ID . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_LOGIN . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_PASS . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_TYPE . 
			"," . IdentificationManager::CHAMP_IDENTIFICATION_AUTORISE . "
			FROM " . IdentificationManager::TABLE_IDENTIFICATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeIdentification = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeIdentification,
					IdentificationManager::remplirIdentification(
					$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_ID],
					$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN],
					$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_LOGIN],
					$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_PASS],
					$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_TYPE],
					$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_AUTORISE]));
			}
		} else {
			$lListeIdentification[0] = new IdentificationVO();
		}
		return $lListeIdentification;
	}
	
	/**
	* @name selectByIdType($pId,$pType)
	* @param integer
	* @param integer
	* @return array(IdentificationVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdLogin $pId, de type $pType et les renvoie sous forme d'une collection de IdentificationVO
	*/
	public static function selectByIdType($pId,$pType) {		
		return IdentificationManager::recherche(
			array(IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN,IdentificationManager::CHAMP_IDENTIFICATION_TYPE),
			array('=','='),
			array($pId,$pType),
			array(''),
			array(''));
	}
	
	/**
	* @name selectByLogin($pId)
	* @param string
	* @return array(IdentificationVO)
	* @desc Récupères toutes les lignes de la table ayant pour Login $pId et les renvoie sous forme d'une collection de IdentificationVO
	*/
	public static function selectByLogin($pId) {		
		return IdentificationManager::recherche(
			array(IdentificationManager::CHAMP_IDENTIFICATION_LOGIN),
			array('='),
			array($pId),
			array(''),
			array(''));
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(IdentificationVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de IdentificationVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    IdentificationManager::CHAMP_IDENTIFICATION_ID .
			"," . IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN .
			"," . IdentificationManager::CHAMP_IDENTIFICATION_LOGIN .
			"," . IdentificationManager::CHAMP_IDENTIFICATION_PASS .
			"," . IdentificationManager::CHAMP_IDENTIFICATION_TYPE .
			"," . IdentificationManager::CHAMP_IDENTIFICATION_AUTORISE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(IdentificationManager::TABLE_IDENTIFICATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeIdentification = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeIdentification,
						IdentificationManager::remplirIdentification(
						$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_ID],
						$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN],
						$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_LOGIN],
						$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_PASS],
						$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_TYPE],
						$lLigne[IdentificationManager::CHAMP_IDENTIFICATION_AUTORISE]));
				}
			} else {
				$lListeIdentification[0] = new IdentificationVO();
			}

			return $lListeIdentification;
		}

		$lListeIdentification[0] = new IdentificationVO();
		return $lListeIdentification;
	}

	/**
	* @name remplirIdentification($pId, $pIdLogin, $pLogin, $pPass, $pType, $pAutorise)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(100)
	* @param int(11)
	* @param tinyint(1)
	* @return IdentificationVO
	* @desc Retourne une IdentificationVO remplie
	*/
	private static function remplirIdentification($pId, $pIdLogin, $pLogin, $pPass, $pType, $pAutorise) {
		$lIdentification = new IdentificationVO();
		$lIdentification->setId($pId);
		$lIdentification->setIdLogin($pIdLogin);
		$lIdentification->setLogin($pLogin);
		$lIdentification->setPass($pPass);
		$lIdentification->setType($pType);
		$lIdentification->setAutorise($pAutorise);
		return $lIdentification;
	}

	/**
	* @name insert($pVo)
	* @param IdentificationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la IdentificationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . IdentificationManager::TABLE_IDENTIFICATION . "
				(" . IdentificationManager::CHAMP_IDENTIFICATION_ID . "
				," . IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN . "
				," . IdentificationManager::CHAMP_IDENTIFICATION_LOGIN . "
				," . IdentificationManager::CHAMP_IDENTIFICATION_PASS . "
				," . IdentificationManager::CHAMP_IDENTIFICATION_TYPE . "
				," . IdentificationManager::CHAMP_IDENTIFICATION_AUTORISE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdLogin() ) . "'
				,'" . StringUtils::securiser( $pVo->getLogin() ) . "'
				,'" . StringUtils::securiser( $pVo->getPass() ) . "'
				,'" . StringUtils::securiser( $pVo->getType() ) . "'
				,'" . StringUtils::securiser( $pVo->getAutorise() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param IdentificationVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du IdentificationVO, avec les informations du IdentificationVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . IdentificationManager::TABLE_IDENTIFICATION . "
			 SET
				 " . IdentificationManager::CHAMP_IDENTIFICATION_ID_LOGIN . " = '" . StringUtils::securiser( $pVo->getIdLogin() ) . "'
				," . IdentificationManager::CHAMP_IDENTIFICATION_LOGIN . " = '" . StringUtils::securiser( $pVo->getLogin() ) . "'
				," . IdentificationManager::CHAMP_IDENTIFICATION_PASS . " = '" . StringUtils::securiser( $pVo->getPass() ) . "'
				," . IdentificationManager::CHAMP_IDENTIFICATION_TYPE . " = '" . StringUtils::securiser( $pVo->getType() ) . "'
				," . IdentificationManager::CHAMP_IDENTIFICATION_AUTORISE . " = '" . StringUtils::securiser( $pVo->getAutorise() ) . "'
			 WHERE " . IdentificationManager::CHAMP_IDENTIFICATION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . IdentificationManager::TABLE_IDENTIFICATION . "
			WHERE " . IdentificationManager::CHAMP_IDENTIFICATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>