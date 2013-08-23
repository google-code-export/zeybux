<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/07/2013
// Fichier : HistoriqueOperationManager.php
//
// Description : Classe de gestion des HistoriqueOperation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "HistoriqueOperationVO.php");

define("TABLE_HISTORIQUEOPERATION", MYSQL_DB_PREFIXE ."hope_historique_operation");
/**
 * @name HistoriqueOperationManager
 * @author Julien PIERRE
 * @since 19/07/2013
 * 
 * @desc Classe permettant l'accès aux données des HistoriqueOperation
 */
class HistoriqueOperationManager
{
	const TABLE_HISTORIQUEOPERATION = TABLE_HISTORIQUEOPERATION;
	const CHAMP_HISTORIQUEOPERATION_ID = "hope_id";
	const CHAMP_HISTORIQUEOPERATION_ID_OPERATION = "hope_id_operation";
	const CHAMP_HISTORIQUEOPERATION_ID_COMPTE = "hope_id_compte";
	const CHAMP_HISTORIQUEOPERATION_MONTANT = "hope_montant";
	const CHAMP_HISTORIQUEOPERATION_LIBELLE = "hope_libelle";
	const CHAMP_HISTORIQUEOPERATION_DATE = "hope_date";
	const CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT = "hope_type_paiement";
	const CHAMP_HISTORIQUEOPERATION_TYPE = "hope_type";
	const CHAMP_HISTORIQUEOPERATION_ID_CONNEXION = "hope_id_connexion";

	/**
	* @name select($pId)
	* @param integer
	* @return HistoriqueOperationVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une HistoriqueOperationVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_OPERATION . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_COMPTE . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_MONTANT . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_LIBELLE . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_DATE . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_CONNEXION . "
			FROM " . HistoriqueOperationManager::TABLE_HISTORIQUEOPERATION . " 
			WHERE " . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return HistoriqueOperationManager::remplirHistoriqueOperation(
				$pId,
				$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_OPERATION],
				$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_COMPTE],
				$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_MONTANT],
				$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_LIBELLE],
				$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_DATE],
				$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT],
				$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE],
				$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_CONNEXION]);
		} else {
			return new HistoriqueOperationVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(HistoriqueOperationVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de HistoriqueOperationVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_OPERATION . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_COMPTE . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_MONTANT . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_LIBELLE . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_DATE . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE . 
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_CONNEXION . "
			FROM " . HistoriqueOperationManager::TABLE_HISTORIQUEOPERATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeHistoriqueOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeHistoriqueOperation,
					HistoriqueOperationManager::remplirHistoriqueOperation(
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID],
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_OPERATION],
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_COMPTE],
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_MONTANT],
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_LIBELLE],
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_DATE],
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT],
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE],
					$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_CONNEXION]));
			}
		} else {
			$lListeHistoriqueOperation[0] = new HistoriqueOperationVO();
		}
		return $lListeHistoriqueOperation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(HistoriqueOperationVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de HistoriqueOperationVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID .
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_OPERATION .
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_COMPTE .
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_MONTANT .
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_LIBELLE .
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_DATE .
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT .
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE .
			"," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_CONNEXION		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(HistoriqueOperationManager::TABLE_HISTORIQUEOPERATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeHistoriqueOperation = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeHistoriqueOperation,
						HistoriqueOperationManager::remplirHistoriqueOperation(
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID],
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_OPERATION],
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_COMPTE],
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_MONTANT],
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_LIBELLE],
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_DATE],
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT],
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE],
						$lLigne[HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_CONNEXION]));
				}
			} else {
				$lListeHistoriqueOperation[0] = new HistoriqueOperationVO();
			}

			return $lListeHistoriqueOperation;
		}

		$lListeHistoriqueOperation[0] = new HistoriqueOperationVO();
		return $lListeHistoriqueOperation;
	}

	/**
	* @name remplirHistoriqueOperation($pId, $pIdOperation, $pIdCompte, $pMontant, $pLibelle, $pDate, $pTypePaiement, $pType, $pIdConnexion)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(100)
	* @param datetime
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return HistoriqueOperationVO
	* @desc Retourne une HistoriqueOperationVO remplie
	*/
	private static function remplirHistoriqueOperation($pId, $pIdOperation, $pIdCompte, $pMontant, $pLibelle, $pDate, $pTypePaiement, $pType, $pIdConnexion) {
		$lHistoriqueOperation = new HistoriqueOperationVO();
		$lHistoriqueOperation->setId($pId);
		$lHistoriqueOperation->setIdOperation($pIdOperation);
		$lHistoriqueOperation->setIdCompte($pIdCompte);
		$lHistoriqueOperation->setMontant($pMontant);
		$lHistoriqueOperation->setLibelle($pLibelle);
		$lHistoriqueOperation->setDate($pDate);
		$lHistoriqueOperation->setTypePaiement($pTypePaiement);
		$lHistoriqueOperation->setType($pType);
		$lHistoriqueOperation->setIdConnexion($pIdConnexion);
		return $lHistoriqueOperation;
	}

	/**
	* @name insert($pVo)
	* @param HistoriqueOperationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la HistoriqueOperationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . HistoriqueOperationManager::TABLE_HISTORIQUEOPERATION . "
				(" . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID . "
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_OPERATION . "
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_COMPTE . "
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_MONTANT . "
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_LIBELLE . "
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_DATE . "
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT . "
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE . "
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_CONNEXION . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $lVo->getMontant() ) . "'
				,'" . StringUtils::securiser( $lVo->getLibelle() ) . "'
				,'" . StringUtils::securiser( $lVo->getDate() ) . "'
				,'" . StringUtils::securiser( $lVo->getTypePaiement() ) . "'
				,'" . StringUtils::securiser( $lVo->getType() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdConnexion() ) . "')";

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
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getMontant() ) . "'
				,'" . StringUtils::securiser( $pVo->getLibelle() ) . "'
				,'" . StringUtils::securiser( $pVo->getDate() ) . "'
				,'" . StringUtils::securiser( $pVo->getTypePaiement() ) . "'
				,'" . StringUtils::securiser( $pVo->getType() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdConnexion() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param HistoriqueOperationVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du HistoriqueOperationVO, avec les informations du HistoriqueOperationVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . HistoriqueOperationManager::TABLE_HISTORIQUEOPERATION . "
			 SET
				 " . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_MONTANT . " = '" . StringUtils::securiser( $pVo->getMontant() ) . "'
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_LIBELLE . " = '" . StringUtils::securiser( $pVo->getLibelle() ) . "'
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_DATE . " = '" . StringUtils::securiser( $pVo->getDate() ) . "'
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE_PAIEMENT . " = '" . StringUtils::securiser( $pVo->getTypePaiement() ) . "'
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_TYPE . " = '" . StringUtils::securiser( $pVo->getType() ) . "'
				," . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID_CONNEXION . " = '" . StringUtils::securiser( $pVo->getIdConnexion() ) . "'
			 WHERE " . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . HistoriqueOperationManager::TABLE_HISTORIQUEOPERATION . "
			WHERE " . HistoriqueOperationManager::CHAMP_HISTORIQUEOPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>