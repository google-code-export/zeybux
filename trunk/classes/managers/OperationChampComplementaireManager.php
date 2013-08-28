<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/06/2013
// Fichier : OperationChampComplementaireManager.php
//
// Description : Classe de gestion des OperationChampComplementaire
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "OperationChampComplementaireVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementChampComplementaireManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");


define("TABLE_OPERATIONCHAMPCOMPLEMENTAIRE", MYSQL_DB_PREFIXE ."opecp_operation_champ_complementaire");
/**
 * @name OperationChampComplementaireManager
 * @author Julien PIERRE
 * @since 15/06/2013
 * 
 * @desc Classe permettant l'accès aux données des OperationChampComplementaire
 */
class OperationChampComplementaireManager
{
	const TABLE_OPERATIONCHAMPCOMPLEMENTAIRE = TABLE_OPERATIONCHAMPCOMPLEMENTAIRE;
	const CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID = "opecp_ope_id";
	const CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID = "opecp_chcp_id";
	const CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR = "opecp_valeur";

	/**
	* @name select($pId)
	* @param integer
	* @return OperationChampComplementaireVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationChampComplementaireVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . 
			"," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . 
			"," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . "
			FROM " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . " 
			WHERE " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return OperationChampComplementaireManager::remplirOperationChampComplementaire(
				$pId,
				$lLigne[OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID],
				$lLigne[OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR]);
		} else {
			return new OperationChampComplementaireVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(OperationChampComplementaireVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationChampComplementaireVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . 
			"," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . 
			"," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . "
			FROM " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationChampComplementaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationChampComplementaire,
					OperationChampComplementaireManager::remplirOperationChampComplementaire(
					$lLigne[OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID],
					$lLigne[OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID],
					$lLigne[OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR]));
			}
		} else {
			$lListeOperationChampComplementaire[0] = new OperationChampComplementaireVO();
		}
		return $lListeOperationChampComplementaire;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(OperationChampComplementaireVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationChampComplementaireVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID .
			"," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID .
			"," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeOperationChampComplementaire = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeOperationChampComplementaire,
						OperationChampComplementaireManager::remplirOperationChampComplementaire(
						$lLigne[OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID],
						$lLigne[OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID],
						$lLigne[OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR]));
				}
			} else {
				$lListeOperationChampComplementaire[0] = new OperationChampComplementaireVO();
			}

			return $lListeOperationChampComplementaire;
		}

		$lListeOperationChampComplementaire[0] = new OperationChampComplementaireVO();
		return $lListeOperationChampComplementaire;
	}

	/**
	* @name remplirOperationChampComplementaire($pOpeId, $pCpchcpId, $pValeur)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @return OperationChampComplementaireVO
	* @desc Retourne une OperationChampComplementaireVO remplie
	*/
	private static function remplirOperationChampComplementaire($pOpeId, $pChcpId, $pValeur) {
		$lOperationChampComplementaire = new OperationChampComplementaireVO();
		$lOperationChampComplementaire->setOpeId($pOpeId);
		$lOperationChampComplementaire->setChcpId($pChcpId);
		$lOperationChampComplementaire->setValeur($pValeur);
		return $lOperationChampComplementaire;
	}

	/**
	* @name insert($pVo)
	* @param OperationChampComplementaireVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la OperationChampComplementaireVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . "
				(" . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . "
				," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . "
				," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "( '" . StringUtils::securiser( $lVo->getOpeId() ) . "'
				,'" . StringUtils::securiser( $lVo->getChcpId() ) . "'
				,'" . StringUtils::securiser( $lVo->getValeur() ) . "')";

				if($lNbVO == $lI) {
					$lRequete .= ";";
				} else {
					$lRequete .= ",";
				}
				$lI++;
			}
		} else{
			$lRequete .= "( '" . StringUtils::securiser( $pVo->getOpeId() ) . "'
				,'" . StringUtils::securiser( $pVo->getChcpId() ) . "'
				,'" . StringUtils::securiser( $pVo->getValeur() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param OperationChampComplementaireVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du OperationChampComplementaireVO, avec les informations du OperationChampComplementaireVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . "
			 SET
				 " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = '" . StringUtils::securiser( $pVo->getChcpId() ) . "'
				," . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . " = '" . StringUtils::securiser( $pVo->getValeur() ) . "'
			 WHERE " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = '" . StringUtils::securiser( $pVo->getOpeId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}

	/**
	* @name deleteByIdOpe($pId)
	* @param integer
	* @desc Supprime la ligne de la table correspondant à l'id en paramètre si la mise à jour de ce type de champ est autorisée
	*/
	public static function deleteByIdOpe($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = "DELETE FROM " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . "
			WHERE " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = '" . StringUtils::securiser($pId) . "'
			AND EXISTS (
					SELECT 1 
					FROM " . TypePaiementChampComplementaireManager::TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE . "
					JOIN " . OperationManager::TABLE_OPERATION . "
						ON " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID . "
						AND " . OperationManager::CHAMP_OPERATION_ID . " = '" . StringUtils::securiser($pId) . "'
					WHERE " .OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID . "
						AND " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE . " = 1);";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>