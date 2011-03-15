<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : OperationManager.php
//
// Description : Classe de gestion des Operation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "OperationVO.php");

/**
 * @name OperationManager
 * @author Julien PIERRE
 * @since 02/09/2010
 * 
 * @desc Classe permettant l'accès aux données des Operation
 */
class OperationManager
{
	const TABLE_OPERATION = "ope_operation";
	const CHAMP_OPERATION_ID = "ope_id";
	const CHAMP_OPERATION_ID_COMPTE = "ope_id_compte";
	const CHAMP_OPERATION_MONTANT = "ope_montant";
	const CHAMP_OPERATION_LIBELLE = "ope_libelle";
	const CHAMP_OPERATION_DATE = "ope_date";
	const CHAMP_OPERATION_TYPE_PAIEMENT = "ope_type_paiement";
	const CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE = "ope_type_paiement_champ_complementaire";
	const CHAMP_OPERATION_TYPE = "ope_type";
	const CHAMP_OPERATION_ID_COMMANDE = "ope_id_commande";

	/**
	* @name select($pId)
	* @param integer
	* @return OperationVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID . 
			"," . OperationManager::CHAMP_OPERATION_ID_COMPTE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . OperationManager::CHAMP_OPERATION_TYPE . 
			"," . OperationManager::CHAMP_OPERATION_ID_COMMANDE . "
			FROM " . OperationManager::TABLE_OPERATION . " 
			WHERE " . OperationManager::CHAMP_OPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return OperationManager::remplirOperation(
				$pId,
				$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
				$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
				$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
				$lLigne[OperationManager::CHAMP_OPERATION_DATE],
				$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT],
				$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
				$lLigne[OperationManager::CHAMP_OPERATION_TYPE],
				$lLigne[OperationManager::CHAMP_OPERATION_ID_COMMANDE]);
		} else {
			return new OperationVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(OperationVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID . 
			"," . OperationManager::CHAMP_OPERATION_ID_COMPTE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . OperationManager::CHAMP_OPERATION_TYPE . 
			"," . OperationManager::CHAMP_OPERATION_ID_COMMANDE . "
			FROM " . OperationManager::TABLE_OPERATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperation,
					OperationManager::remplirOperation(
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE],
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMMANDE]));
			}
		} else {
			$lListeOperation[0] = new OperationVO();
		}
		return $lListeOperation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(OperationVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    OperationManager::CHAMP_OPERATION_ID .
			"," . OperationManager::CHAMP_OPERATION_ID_COMPTE .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . OperationManager::CHAMP_OPERATION_LIBELLE .
			"," . OperationManager::CHAMP_OPERATION_DATE .
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT .
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE .
			"," . OperationManager::CHAMP_OPERATION_TYPE .
			"," . OperationManager::CHAMP_OPERATION_ID_COMMANDE		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = OperationManager::CHAMP_OPERATION_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(OperationManager::TABLE_OPERATION, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperation = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeOperation,
					OperationManager::remplirOperation(
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE],
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMMANDE]));
			}
		} else {
			$lListeOperation[0] = new OperationVO();
		}

		return $lListeOperation;
	}

	/**
	* @name remplirOperation($pId, $pIdCompte, $pMontant, $pLibelle, $pDate, $pTypePaiement, $pTypePaiementChampComplementaire, $pType, $pIdCommande)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(100)
	* @param datetime
	* @param int(11)
	* @param varchar(50)
	* @param int(11)
	* @param int(11)
	* @return OperationVO
	* @desc Retourne une OperationVO remplie
	*/
	private static function remplirOperation($pId, $pIdCompte, $pMontant, $pLibelle, $pDate, $pTypePaiement, $pTypePaiementChampComplementaire, $pType, $pIdCommande) {
		$lOperation = new OperationVO();
		$lOperation->setId($pId);
		$lOperation->setIdCompte($pIdCompte);
		$lOperation->setMontant($pMontant);
		$lOperation->setLibelle($pLibelle);
		$lOperation->setDate($pDate);
		$lOperation->setTypePaiement($pTypePaiement);
		$lOperation->setTypePaiementChampComplementaire($pTypePaiementChampComplementaire);
		$lOperation->setType($pType);
		$lOperation->setIdCommande($pIdCommande);
		return $lOperation;
	}

	/**
	* @name insert($pVo)
	* @param OperationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la OperationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . OperationManager::TABLE_OPERATION . "
				(" . OperationManager::CHAMP_OPERATION_ID . "
				," . OperationManager::CHAMP_OPERATION_ID_COMPTE . "
				," . OperationManager::CHAMP_OPERATION_MONTANT . "
				," . OperationManager::CHAMP_OPERATION_LIBELLE . "
				," . OperationManager::CHAMP_OPERATION_DATE . "
				," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . "
				," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . "
				," . OperationManager::CHAMP_OPERATION_TYPE . "
				," . OperationManager::CHAMP_OPERATION_ID_COMMANDE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getMontant() ) . "'
				,'" . StringUtils::securiser( $pVo->getLibelle() ) . "'
				,'" . StringUtils::securiser( $pVo->getDate() ) . "'
				,'" . StringUtils::securiser( $pVo->getTypePaiement() ) . "'
				,'" . StringUtils::securiser( $pVo->getTypePaiementChampComplementaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getType() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCommande() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param OperationVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du OperationVO, avec les informations du OperationVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . OperationManager::TABLE_OPERATION . "
			 SET
				 " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . OperationManager::CHAMP_OPERATION_MONTANT . " = '" . StringUtils::securiser( $pVo->getMontant() ) . "'
				," . OperationManager::CHAMP_OPERATION_LIBELLE . " = '" . StringUtils::securiser( $pVo->getLibelle() ) . "'
				," . OperationManager::CHAMP_OPERATION_DATE . " = '" . StringUtils::securiser( $pVo->getDate() ) . "'
				," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = '" . StringUtils::securiser( $pVo->getTypePaiement() ) . "'
				," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . " = '" . StringUtils::securiser( $pVo->getTypePaiementChampComplementaire() ) . "'
				," . OperationManager::CHAMP_OPERATION_TYPE . " = '" . StringUtils::securiser( $pVo->getType() ) . "'
				," . OperationManager::CHAMP_OPERATION_ID_COMMANDE . " = '" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
			 WHERE " . OperationManager::CHAMP_OPERATION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . OperationManager::TABLE_OPERATION . "
			WHERE " . OperationManager::CHAMP_OPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>