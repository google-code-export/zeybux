<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2014
// Fichier : ParametreManager.php
//
// Description : Classe de gestion des Parametre
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ParametreVO.php");

define("TABLE_PARAMETRE", MYSQL_DB_PREFIXE ."par_parametre");
/**
 * @name ParametreManager
 * @author Julien PIERRE
 * @since 15/02/2014
 * 
 * @desc Classe permettant l'accès aux données des Parametre
 */
class ParametreManager
{
	const TABLE_PARAMETRE = TABLE_PARAMETRE;
	const CHAMP_PARAMETRE_ID = "par_id";
	const CHAMP_PARAMETRE_LABEL = "par_label";
	const CHAMP_PARAMETRE_INT_LABEL = "par_int_label";
	const CHAMP_PARAMETRE_INT_VALEUR = "par_int_valeur";
	const CHAMP_PARAMETRE_DECIMAL_LABEL = "par_decimal_label";
	const CHAMP_PARAMETRE_DECIMAL_VALEUR = "par_decimal_valeur";
	const CHAMP_PARAMETRE_VARCHAR_LABEL = "par_varchar_label";
	const CHAMP_PARAMETRE_VARCHAR_VALEUR = "par_varchar_valeur";
	const CHAMP_PARAMETRE_DATE_LABEL = "par_date_label";
	const CHAMP_PARAMETRE_DATE_VALEUR = "par_date_valeur";
	const CHAMP_PARAMETRE_TEXT_LABEL = "par_text_label";
	const CHAMP_PARAMETRE_TEXT_VALEUR = "par_text_valeur";
	const CHAMP_PARAMETRE_DATE_CREATION = "par_date_creation";
	const CHAMP_PARAMETRE_DATE_MODIFICATION = "par_date_modification";
	const CHAMP_PARAMETRE_ETAT = "par_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return ParametreVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ParametreVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ParametreManager::CHAMP_PARAMETRE_ID . 
			"," . ParametreManager::CHAMP_PARAMETRE_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_INT_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_INT_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_TEXT_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_TEXT_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_CREATION . 
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_MODIFICATION . 
			"," . ParametreManager::CHAMP_PARAMETRE_ETAT . "
			FROM " . ParametreManager::TABLE_PARAMETRE . " 
			WHERE " . ParametreManager::CHAMP_PARAMETRE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ParametreManager::remplirParametre(
				$pId,
				$lLigne[ParametreManager::CHAMP_PARAMETRE_LABEL],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_INT_LABEL],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_INT_VALEUR],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_DECIMAL_LABEL],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_DECIMAL_VALEUR],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_VARCHAR_LABEL],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_VARCHAR_VALEUR],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_LABEL],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_VALEUR],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_TEXT_LABEL],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_TEXT_VALEUR],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_CREATION],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_MODIFICATION],
				$lLigne[ParametreManager::CHAMP_PARAMETRE_ETAT]);
		} else {
			return new ParametreVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ParametreVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ParametreVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ParametreManager::CHAMP_PARAMETRE_ID . 
			"," . ParametreManager::CHAMP_PARAMETRE_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_INT_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_INT_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_TEXT_LABEL . 
			"," . ParametreManager::CHAMP_PARAMETRE_TEXT_VALEUR . 
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_CREATION . 
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_MODIFICATION . 
			"," . ParametreManager::CHAMP_PARAMETRE_ETAT . "
			FROM " . ParametreManager::TABLE_PARAMETRE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeParametre = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeParametre,
					ParametreManager::remplirParametre(
					$lLigne[ParametreManager::CHAMP_PARAMETRE_ID],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_LABEL],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_INT_LABEL],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_INT_VALEUR],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_DECIMAL_LABEL],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_DECIMAL_VALEUR],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_VARCHAR_LABEL],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_VARCHAR_VALEUR],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_LABEL],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_VALEUR],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_TEXT_LABEL],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_TEXT_VALEUR],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_CREATION],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_MODIFICATION],
					$lLigne[ParametreManager::CHAMP_PARAMETRE_ETAT]));
			}
		} else {
			$lListeParametre[0] = new ParametreVO();
		}
		return $lListeParametre;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ParametreVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ParametreVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ParametreManager::CHAMP_PARAMETRE_ID .
			"," . ParametreManager::CHAMP_PARAMETRE_LABEL .
			"," . ParametreManager::CHAMP_PARAMETRE_INT_LABEL .
			"," . ParametreManager::CHAMP_PARAMETRE_INT_VALEUR .
			"," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_LABEL .
			"," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_VALEUR .
			"," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_LABEL .
			"," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_VALEUR .
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_LABEL .
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_VALEUR .
			"," . ParametreManager::CHAMP_PARAMETRE_TEXT_LABEL .
			"," . ParametreManager::CHAMP_PARAMETRE_TEXT_VALEUR .
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_CREATION .
			"," . ParametreManager::CHAMP_PARAMETRE_DATE_MODIFICATION .
			"," . ParametreManager::CHAMP_PARAMETRE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ParametreManager::TABLE_PARAMETRE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeParametre = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeParametre,
						ParametreManager::remplirParametre(
						$lLigne[ParametreManager::CHAMP_PARAMETRE_ID],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_LABEL],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_INT_LABEL],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_INT_VALEUR],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_DECIMAL_LABEL],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_DECIMAL_VALEUR],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_VARCHAR_LABEL],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_VARCHAR_VALEUR],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_LABEL],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_VALEUR],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_TEXT_LABEL],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_TEXT_VALEUR],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_CREATION],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_DATE_MODIFICATION],
						$lLigne[ParametreManager::CHAMP_PARAMETRE_ETAT]));
				}
			} else {
				$lListeParametre[0] = new ParametreVO();
			}

			return $lListeParametre;
		}

		$lListeParametre[0] = new ParametreVO();
		return $lListeParametre;
	}

	/**
	* @name remplirParametre($pId, $pLabel, $pIntLabel, $pIntValeur, $pDecimalLabel, $pDecimalValeur, $pVarcharLabel, $pVarcharValeur, $pDateLabel, $pDateValeur, $pTextLabel, $pTextValeur, $pDateCreation, $pDateModification, $pEtat)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param int(11)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(50)
	* @param datetime
	* @param varchar(50)
	* @param text
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return ParametreVO
	* @desc Retourne une ParametreVO remplie
	*/
	private static function remplirParametre($pId, $pLabel, $pIntLabel, $pIntValeur, $pDecimalLabel, $pDecimalValeur, $pVarcharLabel, $pVarcharValeur, $pDateLabel, $pDateValeur, $pTextLabel, $pTextValeur, $pDateCreation, $pDateModification, $pEtat) {
		$lParametre = new ParametreVO();
		$lParametre->setId($pId);
		$lParametre->setLabel($pLabel);
		$lParametre->setIntLabel($pIntLabel);
		$lParametre->setIntValeur($pIntValeur);
		$lParametre->setDecimalLabel($pDecimalLabel);
		$lParametre->setDecimalValeur($pDecimalValeur);
		$lParametre->setVarcharLabel($pVarcharLabel);
		$lParametre->setVarcharValeur($pVarcharValeur);
		$lParametre->setDateLabel($pDateLabel);
		$lParametre->setDateValeur($pDateValeur);
		$lParametre->setTextLabel($pTextLabel);
		$lParametre->setTextValeur($pTextValeur);
		$lParametre->setDateCreation($pDateCreation);
		$lParametre->setDateModification($pDateModification);
		$lParametre->setEtat($pEtat);
		return $lParametre;
	}

	/**
	* @name insert($pVo)
	* @param ParametreVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ParametreVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . ParametreManager::TABLE_PARAMETRE . "
				(" . ParametreManager::CHAMP_PARAMETRE_ID . "
				," . ParametreManager::CHAMP_PARAMETRE_LABEL . "
				," . ParametreManager::CHAMP_PARAMETRE_INT_LABEL . "
				," . ParametreManager::CHAMP_PARAMETRE_INT_VALEUR . "
				," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_LABEL . "
				," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_VALEUR . "
				," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_LABEL . "
				," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_VALEUR . "
				," . ParametreManager::CHAMP_PARAMETRE_DATE_LABEL . "
				," . ParametreManager::CHAMP_PARAMETRE_DATE_VALEUR . "
				," . ParametreManager::CHAMP_PARAMETRE_TEXT_LABEL . "
				," . ParametreManager::CHAMP_PARAMETRE_TEXT_VALEUR . "
				," . ParametreManager::CHAMP_PARAMETRE_DATE_CREATION . "
				," . ParametreManager::CHAMP_PARAMETRE_DATE_MODIFICATION . "
				," . ParametreManager::CHAMP_PARAMETRE_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $lVo->getIntLabel() ) . "'
				,'" . StringUtils::securiser( $lVo->getIntValeur() ) . "'
				,'" . StringUtils::securiser( $lVo->getDecimalLabel() ) . "'
				,'" . StringUtils::securiser( $lVo->getDecimalValeur() ) . "'
				,'" . StringUtils::securiser( $lVo->getVarcharLabel() ) . "'
				,'" . StringUtils::securiser( $lVo->getVarcharValeur() ) . "'
				,'" . StringUtils::securiser( $lVo->getDateLabel() ) . "'
				,'" . StringUtils::securiser( $lVo->getDateValeur() ) . "'
				,'" . StringUtils::securiser( $lVo->getTextLabel() ) . "'
				,'" . StringUtils::securiser( $lVo->getTextValeur() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getIntLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getIntValeur() ) . "'
				,'" . StringUtils::securiser( $pVo->getDecimalLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getDecimalValeur() ) . "'
				,'" . StringUtils::securiser( $pVo->getVarcharLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getVarcharValeur() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateValeur() ) . "'
				,'" . StringUtils::securiser( $pVo->getTextLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getTextValeur() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param ParametreVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du ParametreVO, avec les informations du ParametreVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . ParametreManager::TABLE_PARAMETRE . "
			 SET
				 " . ParametreManager::CHAMP_PARAMETRE_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_INT_LABEL . " = '" . StringUtils::securiser( $pVo->getIntLabel() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_INT_VALEUR . " = '" . StringUtils::securiser( $pVo->getIntValeur() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_LABEL . " = '" . StringUtils::securiser( $pVo->getDecimalLabel() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_DECIMAL_VALEUR . " = '" . StringUtils::securiser( $pVo->getDecimalValeur() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_LABEL . " = '" . StringUtils::securiser( $pVo->getVarcharLabel() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_VARCHAR_VALEUR . " = '" . StringUtils::securiser( $pVo->getVarcharValeur() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_DATE_LABEL . " = '" . StringUtils::securiser( $pVo->getDateLabel() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_DATE_VALEUR . " = '" . StringUtils::securiser( $pVo->getDateValeur() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_TEXT_LABEL . " = '" . StringUtils::securiser( $pVo->getTextLabel() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_TEXT_VALEUR . " = '" . StringUtils::securiser( $pVo->getTextValeur() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_DATE_CREATION . " = '" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_DATE_MODIFICATION . " = '" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				," . ParametreManager::CHAMP_PARAMETRE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . ParametreManager::CHAMP_PARAMETRE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . ParametreManager::TABLE_PARAMETRE . "
			WHERE " . ParametreManager::CHAMP_PARAMETRE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>