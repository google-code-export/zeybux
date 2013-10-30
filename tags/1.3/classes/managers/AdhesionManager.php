<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2012
// Fichier : AdhesionManager.php
//
// Description : Classe de gestion des Adhesion
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "AdhesionVO.php");

define("TABLE_ADHESION", MYSQL_DB_PREFIXE ."ads_adhesion");
/**
 * @name AdhesionManager
 * @author Julien PIERRE
 * @since 22/07/2012
 * 
 * @desc Classe permettant l'accès aux données des Adhesion
 */
class AdhesionManager
{
	const TABLE_ADHESION = TABLE_ADHESION;
	const CHAMP_ADHESION_ID = "ads_id";
	const CHAMP_ADHESION_LABEL = "ads_label";
	const CHAMP_ADHESION_DATE_DEBUT = "ads_date_debut";
	const CHAMP_ADHESION_DATE_FIN = "ads_date_fin";
	const CHAMP_ADHESION_ETAT = "ads_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return AdhesionVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AdhesionVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdhesionManager::CHAMP_ADHESION_ID . 
			"," . AdhesionManager::CHAMP_ADHESION_LABEL . 
			"," . AdhesionManager::CHAMP_ADHESION_DATE_DEBUT . 
			"," . AdhesionManager::CHAMP_ADHESION_DATE_FIN . 
			"," . AdhesionManager::CHAMP_ADHESION_ETAT . "
			FROM " . AdhesionManager::TABLE_ADHESION . " 
			WHERE " . AdhesionManager::CHAMP_ADHESION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return AdhesionManager::remplirAdhesion(
				$pId,
				$lLigne[AdhesionManager::CHAMP_ADHESION_LABEL],
				$lLigne[AdhesionManager::CHAMP_ADHESION_DATE_DEBUT],
				$lLigne[AdhesionManager::CHAMP_ADHESION_DATE_FIN],
				$lLigne[AdhesionManager::CHAMP_ADHESION_ETAT]);
		} else {
			return new AdhesionVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(AdhesionVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AdhesionVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdhesionManager::CHAMP_ADHESION_ID . 
			"," . AdhesionManager::CHAMP_ADHESION_LABEL . 
			"," . AdhesionManager::CHAMP_ADHESION_DATE_DEBUT . 
			"," . AdhesionManager::CHAMP_ADHESION_DATE_FIN . 
			"," . AdhesionManager::CHAMP_ADHESION_ETAT . "
			FROM " . AdhesionManager::TABLE_ADHESION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdhesion = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAdhesion,
					AdhesionManager::remplirAdhesion(
					$lLigne[AdhesionManager::CHAMP_ADHESION_ID],
					$lLigne[AdhesionManager::CHAMP_ADHESION_LABEL],
					$lLigne[AdhesionManager::CHAMP_ADHESION_DATE_DEBUT],
					$lLigne[AdhesionManager::CHAMP_ADHESION_DATE_FIN],
					$lLigne[AdhesionManager::CHAMP_ADHESION_ETAT]));
			}
		} else {
			$lListeAdhesion[0] = new AdhesionVO();
		}
		return $lListeAdhesion;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AdhesionVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AdhesionVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdhesionManager::CHAMP_ADHESION_ID .
			"," . AdhesionManager::CHAMP_ADHESION_LABEL .
			"," . AdhesionManager::CHAMP_ADHESION_DATE_DEBUT .
			"," . AdhesionManager::CHAMP_ADHESION_DATE_FIN .
			"," . AdhesionManager::CHAMP_ADHESION_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AdhesionManager::TABLE_ADHESION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAdhesion = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeAdhesion,
						AdhesionManager::remplirAdhesion(
						$lLigne[AdhesionManager::CHAMP_ADHESION_ID],
						$lLigne[AdhesionManager::CHAMP_ADHESION_LABEL],
						$lLigne[AdhesionManager::CHAMP_ADHESION_DATE_DEBUT],
						$lLigne[AdhesionManager::CHAMP_ADHESION_DATE_FIN],
						$lLigne[AdhesionManager::CHAMP_ADHESION_ETAT]));
				}
			} else {
				$lListeAdhesion[0] = new AdhesionVO();
			}

			return $lListeAdhesion;
		}

		$lListeAdhesion[0] = new AdhesionVO();
		return $lListeAdhesion;
	}

	/**
	* @name remplirAdhesion($pId, $pLabel, $pDateDebut, $pDateFin, $pEtat)
	* @param int(11)
	* @param varchar(45)
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return AdhesionVO
	* @desc Retourne une AdhesionVO remplie
	*/
	private static function remplirAdhesion($pId, $pLabel, $pDateDebut, $pDateFin, $pEtat) {
		$lAdhesion = new AdhesionVO();
		$lAdhesion->setId($pId);
		$lAdhesion->setLabel($pLabel);
		$lAdhesion->setDateDebut($pDateDebut);
		$lAdhesion->setDateFin($pDateFin);
		$lAdhesion->setEtat($pEtat);
		return $lAdhesion;
	}

	/**
	* @name insert($pVo)
	* @param AdhesionVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la AdhesionVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . AdhesionManager::TABLE_ADHESION . "
				(" . AdhesionManager::CHAMP_ADHESION_ID . "
				," . AdhesionManager::CHAMP_ADHESION_LABEL . "
				," . AdhesionManager::CHAMP_ADHESION_DATE_DEBUT . "
				," . AdhesionManager::CHAMP_ADHESION_DATE_FIN . "
				," . AdhesionManager::CHAMP_ADHESION_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateDebut() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateFin() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param AdhesionVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du AdhesionVO, avec les informations du AdhesionVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . AdhesionManager::TABLE_ADHESION . "
			 SET
				 " . AdhesionManager::CHAMP_ADHESION_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . AdhesionManager::CHAMP_ADHESION_DATE_DEBUT . " = '" . StringUtils::securiser( $pVo->getDateDebut() ) . "'
				," . AdhesionManager::CHAMP_ADHESION_DATE_FIN . " = '" . StringUtils::securiser( $pVo->getDateFin() ) . "'
				," . AdhesionManager::CHAMP_ADHESION_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . AdhesionManager::CHAMP_ADHESION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . AdhesionManager::TABLE_ADHESION . "
			WHERE " . AdhesionManager::CHAMP_ADHESION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>