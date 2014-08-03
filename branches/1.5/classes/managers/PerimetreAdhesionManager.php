<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/10/2013
// Fichier : PerimetreAdhesionManager.php
//
// Description : Classe de gestion des PerimetreAdhesion
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "PerimetreAdhesionVO.php");

define("TABLE_PERIMETREADHESION", MYSQL_DB_PREFIXE ."pad_perimetre_adhesion");
/**
 * @name PerimetreAdhesionManager
 * @author Julien PIERRE
 * @since 30/10/2013
 * 
 * @desc Classe permettant l'accès aux données des PerimetreAdhesion
 */
class PerimetreAdhesionManager
{
	const TABLE_PERIMETREADHESION = TABLE_PERIMETREADHESION;
	const CHAMP_PERIMETREADHESION_ID = "pad_id";
	const CHAMP_PERIMETREADHESION_LABEL = "pad_label";
	const CHAMP_PERIMETREADHESION_DATE_CREATION = "pad_date_creation";
	const CHAMP_PERIMETREADHESION_DATE_MODIFICATION = "pad_date_modification";
	const CHAMP_PERIMETREADHESION_ETAT = "pad_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return PerimetreAdhesionVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une PerimetreAdhesionVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_CREATION . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_MODIFICATION . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT . "
			FROM " . PerimetreAdhesionManager::TABLE_PERIMETREADHESION . " 
			WHERE " . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return PerimetreAdhesionManager::remplirPerimetreAdhesion(
				$pId,
				$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL],
				$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_CREATION],
				$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_MODIFICATION],
				$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT]);
		} else {
			return new PerimetreAdhesionVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(PerimetreAdhesionVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de PerimetreAdhesionVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_CREATION . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_MODIFICATION . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT . "
			FROM " . PerimetreAdhesionManager::TABLE_PERIMETREADHESION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListePerimetreAdhesion = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListePerimetreAdhesion,
					PerimetreAdhesionManager::remplirPerimetreAdhesion(
					$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID],
					$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL],
					$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_CREATION],
					$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_MODIFICATION],
					$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT]));
			}
		} else {
			$lListePerimetreAdhesion[0] = new PerimetreAdhesionVO();
		}
		return $lListePerimetreAdhesion;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(PerimetreAdhesionVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de PerimetreAdhesionVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID .
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL .
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_CREATION .
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_MODIFICATION .
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(PerimetreAdhesionManager::TABLE_PERIMETREADHESION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListePerimetreAdhesion = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListePerimetreAdhesion,
						PerimetreAdhesionManager::remplirPerimetreAdhesion(
						$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID],
						$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL],
						$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_CREATION],
						$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_MODIFICATION],
						$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT]));
				}
			} else {
				$lListePerimetreAdhesion[0] = new PerimetreAdhesionVO();
			}

			return $lListePerimetreAdhesion;
		}

		$lListePerimetreAdhesion[0] = new PerimetreAdhesionVO();
		return $lListePerimetreAdhesion;
	}

	/**
	* @name remplirPerimetreAdhesion($pId, $pLabel, $pDateCreation, $pDateModification, $pEtat)
	* @param int(11)
	* @param varchar(20)
	* @param datetime
	* @param datetime
	* @param tinyint(4)
	* @return PerimetreAdhesionVO
	* @desc Retourne une PerimetreAdhesionVO remplie
	*/
	private static function remplirPerimetreAdhesion($pId, $pLabel, $pDateCreation, $pDateModification, $pEtat) {
		$lPerimetreAdhesion = new PerimetreAdhesionVO();
		$lPerimetreAdhesion->setId($pId);
		$lPerimetreAdhesion->setLabel($pLabel);
		$lPerimetreAdhesion->setDateCreation($pDateCreation);
		$lPerimetreAdhesion->setDateModification($pDateModification);
		$lPerimetreAdhesion->setEtat($pEtat);
		return $lPerimetreAdhesion;
	}

	/**
	* @name insert($pVo)
	* @param PerimetreAdhesionVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la PerimetreAdhesionVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . PerimetreAdhesionManager::TABLE_PERIMETREADHESION . "
				(" . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID . "
				," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL . "
				," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_CREATION . "
				," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_MODIFICATION . "
				," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getLabel() ) . "'
				, now()
				,'" . StringUtils::securiser( $lVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $lVo->getEtat() ) . "')";

				if($lNbVO == $lI) {
					$lRequete .= ";";
				} else {
					$lRequete .= ",";
				}
				$lI++;
			}
		} else{
			$lRequete .= "(NULL
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "'
				, now()
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param PerimetreAdhesionVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du PerimetreAdhesionVO, avec les informations du PerimetreAdhesionVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . PerimetreAdhesionManager::TABLE_PERIMETREADHESION . "
			 SET
				 " . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_CREATION . " = '" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_DATE_MODIFICATION . " = now()
				," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
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

		$lRequete = "DELETE FROM " . PerimetreAdhesionManager::TABLE_PERIMETREADHESION . "
			WHERE " . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>