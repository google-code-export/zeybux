<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/06/2013
// Fichier : ChampComplementaireManager.php
//
// Description : Classe de gestion des ChampComplementaire
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ChampComplementaireVO.php");

define("TABLE_CHAMPCOMPLEMENTAIRE", MYSQL_DB_PREFIXE ."chcp_champ_complementaire");
/**
 * @name ChampComplementaireManager
 * @author Julien PIERRE
 * @since 15/06/2013
 * 
 * @desc Classe permettant l'accès aux données des ChampComplementaire
 */
class ChampComplementaireManager
{
	const TABLE_CHAMPCOMPLEMENTAIRE = TABLE_CHAMPCOMPLEMENTAIRE;
	const CHAMP_CHAMPCOMPLEMENTAIRE_ID = "chcp_id";
	const CHAMP_CHAMPCOMPLEMENTAIRE_LABEL = "chcp_label";
	const CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE = "chcp_obligatoire";
	const CHAMP_CHAMPCOMPLEMENTAIRE_ETAT = "chcp_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return ChampComplementaireVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ChampComplementaireVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID . 
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_LABEL . 
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE . 
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ETAT . "
			FROM " . ChampComplementaireManager::TABLE_CHAMPCOMPLEMENTAIRE . " 
			WHERE " . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ChampComplementaireManager::remplirChampComplementaire(
				$pId,
				$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_LABEL],
				$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE],
				$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ETAT]);
		} else {
			return new ChampComplementaireVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ChampComplementaireVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ChampComplementaireVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID . 
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_LABEL . 
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE . 
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ETAT . "
			FROM " . ChampComplementaireManager::TABLE_CHAMPCOMPLEMENTAIRE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeChampComplementaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeChampComplementaire,
					ChampComplementaireManager::remplirChampComplementaire(
					$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID],
					$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_LABEL],
					$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE],
					$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ETAT]));
			}
		} else {
			$lListeChampComplementaire[0] = new ChampComplementaireVO();
		}
		return $lListeChampComplementaire;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ChampComplementaireVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ChampComplementaireVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID .
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_LABEL .
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE .
			"," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ChampComplementaireManager::TABLE_CHAMPCOMPLEMENTAIRE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeChampComplementaire = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeChampComplementaire,
						ChampComplementaireManager::remplirChampComplementaire(
						$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID],
						$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_LABEL],
						$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE],
						$lLigne[ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ETAT]));
				}
			} else {
				$lListeChampComplementaire[0] = new ChampComplementaireVO();
			}

			return $lListeChampComplementaire;
		}

		$lListeChampComplementaire[0] = new ChampComplementaireVO();
		return $lListeChampComplementaire;
	}

	/**
	* @name remplirChampComplementaire($pId, $pLabel, $pObligatoire, $pEtat)
	* @param int(11)
	* @param varchar(30)
	* @param tinyint(1)
	* @param tinyint(1)
	* @return ChampComplementaireVO
	* @desc Retourne une ChampComplementaireVO remplie
	*/
	public static function remplirChampComplementaire($pId, $pLabel, $pObligatoire, $pEtat) {
		$lChampComplementaire = new ChampComplementaireVO();
		$lChampComplementaire->setId($pId);
		$lChampComplementaire->setLabel($pLabel);
		$lChampComplementaire->setObligatoire($pObligatoire);
		$lChampComplementaire->setEtat($pEtat);
		return $lChampComplementaire;
	}

	/**
	* @name insert($pVo)
	* @param ChampComplementaireVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ChampComplementaireVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . ChampComplementaireManager::TABLE_CHAMPCOMPLEMENTAIRE . "
				(" . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID . "
				," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_LABEL . "
				," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE . "
				," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $lVo->getObligatoire() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getObligatoire() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param ChampComplementaireVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du ChampComplementaireVO, avec les informations du ChampComplementaireVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . ChampComplementaireManager::TABLE_CHAMPCOMPLEMENTAIRE . "
			 SET
				 " . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_OBLIGATOIRE . " = '" . StringUtils::securiser( $pVo->getObligatoire() ) . "'
				," . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . ChampComplementaireManager::TABLE_CHAMPCOMPLEMENTAIRE . "
			WHERE " . ChampComplementaireManager::CHAMP_CHAMPCOMPLEMENTAIRE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>