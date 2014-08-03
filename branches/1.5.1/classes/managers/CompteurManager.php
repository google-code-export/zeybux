<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/08/2013
// Fichier : CompteurManager.php
//
// Description : Classe de gestion des Compteur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CompteurVO.php");

define("TABLE_COMPTEUR", MYSQL_DB_PREFIXE ."cop_compteur");
/**
 * @name CompteurManager
 * @author Julien PIERRE
 * @since 09/08/2013
 * 
 * @desc Classe permettant l'accès aux données des Compteur
 */
class CompteurManager
{
	const TABLE_COMPTEUR = TABLE_COMPTEUR;
	const CHAMP_COMPTEUR_ID = "cop_id";
	const CHAMP_COMPTEUR_LABEL = "cop_label";
	const CHAMP_COMPTEUR_VALEUR = "cop_valeur";
	const CHAMP_COMPTEUR_DATE_CREATION = "cop_date_creation";
	const CHAMP_COMPTEUR_DATE_MODIFICATION = "cop_date_modification";
	const CHAMP_COMPTEUR_ETAT = "cop_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return CompteurVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CompteurVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteurManager::CHAMP_COMPTEUR_ID . 
			"," . CompteurManager::CHAMP_COMPTEUR_LABEL . 
			"," . CompteurManager::CHAMP_COMPTEUR_VALEUR . 
			"," . CompteurManager::CHAMP_COMPTEUR_DATE_CREATION . 
			"," . CompteurManager::CHAMP_COMPTEUR_DATE_MODIFICATION . 
			"," . CompteurManager::CHAMP_COMPTEUR_ETAT . "
			FROM " . CompteurManager::TABLE_COMPTEUR . " 
			WHERE " . CompteurManager::CHAMP_COMPTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CompteurManager::remplirCompteur(
				$pId,
				$lLigne[CompteurManager::CHAMP_COMPTEUR_LABEL],
				$lLigne[CompteurManager::CHAMP_COMPTEUR_VALEUR],
				$lLigne[CompteurManager::CHAMP_COMPTEUR_DATE_CREATION],
				$lLigne[CompteurManager::CHAMP_COMPTEUR_DATE_MODIFICATION],
				$lLigne[CompteurManager::CHAMP_COMPTEUR_ETAT]);
		} else {
			return new CompteurVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(CompteurVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CompteurVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteurManager::CHAMP_COMPTEUR_ID . 
			"," . CompteurManager::CHAMP_COMPTEUR_LABEL . 
			"," . CompteurManager::CHAMP_COMPTEUR_VALEUR . 
			"," . CompteurManager::CHAMP_COMPTEUR_DATE_CREATION . 
			"," . CompteurManager::CHAMP_COMPTEUR_DATE_MODIFICATION . 
			"," . CompteurManager::CHAMP_COMPTEUR_ETAT . "
			FROM " . CompteurManager::TABLE_COMPTEUR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteur,
					CompteurManager::remplirCompteur(
					$lLigne[CompteurManager::CHAMP_COMPTEUR_ID],
					$lLigne[CompteurManager::CHAMP_COMPTEUR_LABEL],
					$lLigne[CompteurManager::CHAMP_COMPTEUR_VALEUR],
					$lLigne[CompteurManager::CHAMP_COMPTEUR_DATE_CREATION],
					$lLigne[CompteurManager::CHAMP_COMPTEUR_DATE_MODIFICATION],
					$lLigne[CompteurManager::CHAMP_COMPTEUR_ETAT]));
			}
		} else {
			$lListeCompteur[0] = new CompteurVO();
		}
		return $lListeCompteur;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CompteurVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CompteurVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CompteurManager::CHAMP_COMPTEUR_ID .
			"," . CompteurManager::CHAMP_COMPTEUR_LABEL .
			"," . CompteurManager::CHAMP_COMPTEUR_VALEUR .
			"," . CompteurManager::CHAMP_COMPTEUR_DATE_CREATION .
			"," . CompteurManager::CHAMP_COMPTEUR_DATE_MODIFICATION .
			"," . CompteurManager::CHAMP_COMPTEUR_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CompteurManager::TABLE_COMPTEUR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCompteur = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCompteur,
						CompteurManager::remplirCompteur(
						$lLigne[CompteurManager::CHAMP_COMPTEUR_ID],
						$lLigne[CompteurManager::CHAMP_COMPTEUR_LABEL],
						$lLigne[CompteurManager::CHAMP_COMPTEUR_VALEUR],
						$lLigne[CompteurManager::CHAMP_COMPTEUR_DATE_CREATION],
						$lLigne[CompteurManager::CHAMP_COMPTEUR_DATE_MODIFICATION],
						$lLigne[CompteurManager::CHAMP_COMPTEUR_ETAT]));
				}
			} else {
				$lListeCompteur[0] = new CompteurVO();
			}

			return $lListeCompteur;
		}

		$lListeCompteur[0] = new CompteurVO();
		return $lListeCompteur;
	}

	/**
	* @name remplirCompteur($pId, $pLabel, $pValeur, $pDateCreation, $pDateModification, $pEtat)
	* @param int(11)
	* @param varchar(20)
	* @param int(11)
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return CompteurVO
	* @desc Retourne une CompteurVO remplie
	*/
	private static function remplirCompteur($pId, $pLabel, $pValeur, $pDateCreation, $pDateModification, $pEtat) {
		$lCompteur = new CompteurVO();
		$lCompteur->setId($pId);
		$lCompteur->setLabel($pLabel);
		$lCompteur->setValeur($pValeur);
		$lCompteur->setDateCreation($pDateCreation);
		$lCompteur->setDateModification($pDateModification);
		$lCompteur->setEtat($pEtat);
		return $lCompteur;
	}

	/**
	* @name insert($pVo)
	* @param CompteurVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CompteurVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CompteurManager::TABLE_COMPTEUR . "
				(" . CompteurManager::CHAMP_COMPTEUR_ID . "
				," . CompteurManager::CHAMP_COMPTEUR_LABEL . "
				," . CompteurManager::CHAMP_COMPTEUR_VALEUR . "
				," . CompteurManager::CHAMP_COMPTEUR_DATE_CREATION . "
				," . CompteurManager::CHAMP_COMPTEUR_DATE_MODIFICATION . "
				," . CompteurManager::CHAMP_COMPTEUR_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $lVo->getValeur() ) . "'
				,'" . StringUtils::securiser( $lVo->getDateCreation() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getValeur() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param CompteurVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CompteurVO, avec les informations du CompteurVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CompteurManager::TABLE_COMPTEUR . "
			 SET
				 " . CompteurManager::CHAMP_COMPTEUR_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . CompteurManager::CHAMP_COMPTEUR_VALEUR . " = '" . StringUtils::securiser( $pVo->getValeur() ) . "'
				," . CompteurManager::CHAMP_COMPTEUR_DATE_CREATION . " = '" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				," . CompteurManager::CHAMP_COMPTEUR_DATE_MODIFICATION . " = '" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				," . CompteurManager::CHAMP_COMPTEUR_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . CompteurManager::CHAMP_COMPTEUR_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . CompteurManager::TABLE_COMPTEUR . "
			WHERE " . CompteurManager::CHAMP_COMPTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>