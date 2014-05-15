<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/05/2014
// Fichier : OperationRemiseChequeManager.php
//
// Description : Classe de gestion des OperationRemiseCheque
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "OperationRemiseChequeVO.php");

define("TABLE_OPERATIONREMISECHEQUE", MYSQL_DB_PREFIXE ."orc_operation_remise_cheque");
/**
 * @name OperationRemiseChequeManager
 * @author Julien PIERRE
 * @since 04/05/2014
 * 
 * @desc Classe permettant l'accès aux données des OperationRemiseCheque
 */
class OperationRemiseChequeManager
{
	const TABLE_OPERATIONREMISECHEQUE = TABLE_OPERATIONREMISECHEQUE;
	const CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE = "orc_id_remise_cheque";
	const CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION = "orc_id_operation";
	const CHAMP_OPERATIONREMISECHEQUE_DATE_CREATION = "orc_date_creation";
	const CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION = "orc_date_modification";
	const CHAMP_OPERATIONREMISECHEQUE_ETAT = "orc_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return OperationRemiseChequeVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationRemiseChequeVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE . 
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION . 
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_CREATION . 
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION . 
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT . "
			FROM " . OperationRemiseChequeManager::TABLE_OPERATIONREMISECHEQUE . " 
			WHERE " . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return OperationRemiseChequeManager::remplirOperationRemiseCheque(
				$pId,
				$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION],
				$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_CREATION],
				$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION],
				$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT]);
		} else {
			return new OperationRemiseChequeVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(OperationRemiseChequeVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationRemiseChequeVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE . 
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION . 
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_CREATION . 
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION . 
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT . "
			FROM " . OperationRemiseChequeManager::TABLE_OPERATIONREMISECHEQUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationRemiseCheque = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationRemiseCheque,
					OperationRemiseChequeManager::remplirOperationRemiseCheque(
					$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE],
					$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION],
					$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_CREATION],
					$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION],
					$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT]));
			}
		} else {
			$lListeOperationRemiseCheque[0] = new OperationRemiseChequeVO();
		}
		return $lListeOperationRemiseCheque;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(OperationRemiseChequeVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationRemiseChequeVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE .
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION .
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_CREATION .
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION .
			"," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(OperationRemiseChequeManager::TABLE_OPERATIONREMISECHEQUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeOperationRemiseCheque = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeOperationRemiseCheque,
						OperationRemiseChequeManager::remplirOperationRemiseCheque(
						$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE],
						$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION],
						$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_CREATION],
						$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION],
						$lLigne[OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT]));
				}
			} else {
				$lListeOperationRemiseCheque[0] = new OperationRemiseChequeVO();
			}

			return $lListeOperationRemiseCheque;
		}

		$lListeOperationRemiseCheque[0] = new OperationRemiseChequeVO();
		return $lListeOperationRemiseCheque;
	}

	/**
	* @name remplirOperationRemiseCheque($pIdRemiseCheque, $pIdOperation, $pDateCreation, $pDateModification, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return OperationRemiseChequeVO
	* @desc Retourne une OperationRemiseChequeVO remplie
	*/
	private static function remplirOperationRemiseCheque($pIdRemiseCheque, $pIdOperation, $pDateCreation, $pDateModification, $pEtat) {
		$lOperationRemiseCheque = new OperationRemiseChequeVO();
		$lOperationRemiseCheque->setIdRemiseCheque($pIdRemiseCheque);
		$lOperationRemiseCheque->setIdOperation($pIdOperation);
		$lOperationRemiseCheque->setDateCreation($pDateCreation);
		$lOperationRemiseCheque->setDateModification($pDateModification);
		$lOperationRemiseCheque->setEtat($pEtat);
		return $lOperationRemiseCheque;
	}

	/**
	* @name insert($pVo)
	* @param OperationRemiseChequeVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la OperationRemiseChequeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . OperationRemiseChequeManager::TABLE_OPERATIONREMISECHEQUE . "
				(" . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE . "
				," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION . "
				," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_CREATION . "
				," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION . "
				," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getIdOperation() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param OperationRemiseChequeVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du OperationRemiseChequeVO, avec les informations du OperationRemiseChequeVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . OperationRemiseChequeManager::TABLE_OPERATIONREMISECHEQUE . "
			 SET
				 " . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_DATE_MODIFICATION . " = now()
				," . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE . " = '" . StringUtils::securiser( $pVo->getIdRemiseCheque() ) . "'";

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

		$lRequete = "DELETE FROM " . OperationRemiseChequeManager::TABLE_OPERATIONREMISECHEQUE . "
			WHERE " . OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>