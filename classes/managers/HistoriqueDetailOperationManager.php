<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/07/2011
// Fichier : HistoriqueDetailOperationManager.php
//
// Description : Classe de gestion des HistoriqueDetailOperation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "HistoriqueDetailOperationVO.php");

define("TABLE_HISTORIQUEDETAILOPERATION", MYSQL_DB_PREFIXE . "hdope_historique_detail_operation");
/**
 * @name HistoriqueDetailOperationManager
 * @author Julien PIERRE
 * @since 12/07/2011
 * 
 * @desc Classe permettant l'accès aux données des HistoriqueDetailOperation
 */
class HistoriqueDetailOperationManager
{
	const TABLE_HISTORIQUEDETAILOPERATION = TABLE_HISTORIQUEDETAILOPERATION;
	const CHAMP_HISTORIQUEDETAILOPERATION_ID = "hdope_id";
	const CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION = "hdope_id_detail_operation";
	const CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION = "hdope_id_operation";
	const CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE = "hdope_id_compte";
	const CHAMP_HISTORIQUEDETAILOPERATION_MONTANT = "hdope_montant";
	const CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE = "hdope_libelle";
	const CHAMP_HISTORIQUEDETAILOPERATION_DATE = "hdope_date";
	const CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT = "hdope_type_paiement";
	const CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE = "hdope_type_paiement_champ_complementaire";
	const CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE = "hdope_id_detail_commande";
	const CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION = "hdope_id_connexion";

	/**
	* @name select($pId)
	* @param integer
	* @return HistoriqueDetailOperationVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une HistoriqueDetailOperationVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_MONTANT . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_DATE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION . "
			FROM " . HistoriqueDetailOperationManager::TABLE_HISTORIQUEDETAILOPERATION . " 
			WHERE " . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return HistoriqueDetailOperationManager::remplirHistoriqueDetailOperation(
				$pId,
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_MONTANT],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_DATE],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE],
				$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION]);
		} else {
			return new HistoriqueDetailOperationVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(HistoriqueDetailOperationVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de HistoriqueDetailOperationVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_MONTANT . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_DATE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE . 
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION . "
			FROM " . HistoriqueDetailOperationManager::TABLE_HISTORIQUEDETAILOPERATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeHistoriqueDetailOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeHistoriqueDetailOperation,
					HistoriqueDetailOperationManager::remplirHistoriqueDetailOperation(
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_MONTANT],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_DATE],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE],
					$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION]));
			}
		} else {
			$lListeHistoriqueDetailOperation[0] = new HistoriqueDetailOperationVO();
		}
		return $lListeHistoriqueDetailOperation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(HistoriqueDetailOperationVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de HistoriqueDetailOperationVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_MONTANT .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_DATE .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE .
			"," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(HistoriqueDetailOperationManager::TABLE_HISTORIQUEDETAILOPERATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeHistoriqueDetailOperation = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeHistoriqueDetailOperation,
						HistoriqueDetailOperationManager::remplirHistoriqueDetailOperation(
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_MONTANT],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_DATE],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE],
						$lLigne[HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION]));
				}
			} else {
				$lListeHistoriqueDetailOperation[0] = new HistoriqueDetailOperationVO();
			}

			return $lListeHistoriqueDetailOperation;
		}

		$lListeHistoriqueDetailOperation[0] = new HistoriqueDetailOperationVO();
		return $lListeHistoriqueDetailOperation;
	}

	/**
	* @name remplirHistoriqueDetailOperation($pId, $pIdDetailOperation, $pIdOperation, $pIdCompte, $pMontant, $pLibelle, $pDate, $pTypePaiement, $pTypePaiementChampComplementaire, $pIdDetailCommande, $pIdConnexion)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(100)
	* @param datetime
	* @param int(11)
	* @param varchar(50)
	* @param int(11)
	* @param int(11)
	* @return HistoriqueDetailOperationVO
	* @desc Retourne une HistoriqueDetailOperationVO remplie
	*/
	private static function remplirHistoriqueDetailOperation($pId, $pIdDetailOperation, $pIdOperation, $pIdCompte, $pMontant, $pLibelle, $pDate, $pTypePaiement, $pTypePaiementChampComplementaire, $pIdDetailCommande, $pIdConnexion) {
		$lHistoriqueDetailOperation = new HistoriqueDetailOperationVO();
		$lHistoriqueDetailOperation->setId($pId);
		$lHistoriqueDetailOperation->setIdDetailOperation($pIdDetailOperation);
		$lHistoriqueDetailOperation->setIdOperation($pIdOperation);
		$lHistoriqueDetailOperation->setIdCompte($pIdCompte);
		$lHistoriqueDetailOperation->setMontant($pMontant);
		$lHistoriqueDetailOperation->setLibelle($pLibelle);
		$lHistoriqueDetailOperation->setDate($pDate);
		$lHistoriqueDetailOperation->setTypePaiement($pTypePaiement);
		$lHistoriqueDetailOperation->setTypePaiementChampComplementaire($pTypePaiementChampComplementaire);
		$lHistoriqueDetailOperation->setIdDetailCommande($pIdDetailCommande);
		$lHistoriqueDetailOperation->setIdConnexion($pIdConnexion);
		return $lHistoriqueDetailOperation;
	}

	/**
	* @name insert($pVo)
	* @param HistoriqueDetailOperationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la HistoriqueDetailOperationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . HistoriqueDetailOperationManager::TABLE_HISTORIQUEDETAILOPERATION . "
				(" . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_MONTANT . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_DATE . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE . "
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdDetailOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getMontant() ) . "'
				,'" . StringUtils::securiser( $pVo->getLibelle() ) . "'
				,'" . StringUtils::securiser( $pVo->getDate() ) . "'
				,'" . StringUtils::securiser( $pVo->getTypePaiement() ) . "'
				,'" . StringUtils::securiser( $pVo->getTypePaiementChampComplementaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdDetailCommande() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdConnexion() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param HistoriqueDetailOperationVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du HistoriqueDetailOperationVO, avec les informations du HistoriqueDetailOperationVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . HistoriqueDetailOperationManager::TABLE_HISTORIQUEDETAILOPERATION . "
			 SET
				 " . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdDetailOperation() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_MONTANT . " = '" . StringUtils::securiser( $pVo->getMontant() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_LIBELLE . " = '" . StringUtils::securiser( $pVo->getLibelle() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_DATE . " = '" . StringUtils::securiser( $pVo->getDate() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT . " = '" . StringUtils::securiser( $pVo->getTypePaiement() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . " = '" . StringUtils::securiser( $pVo->getTypePaiementChampComplementaire() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_DETAIL_COMMANDE . " = '" . StringUtils::securiser( $pVo->getIdDetailCommande() ) . "'
				," . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID_CONNEXION . " = '" . StringUtils::securiser( $pVo->getIdConnexion() ) . "'
			 WHERE " . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . HistoriqueDetailOperationManager::TABLE_HISTORIQUEDETAILOPERATION . "
			WHERE " . HistoriqueDetailOperationManager::CHAMP_HISTORIQUEDETAILOPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>