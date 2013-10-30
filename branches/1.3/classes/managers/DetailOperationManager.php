<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/07/2013
// Fichier : DetailOperationManager.php
//
// Description : Classe de gestion des DetailOperation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "DetailOperationVO.php");

define("TABLE_DETAILOPERATION", MYSQL_DB_PREFIXE ."dope_detail_operation");
/**
 * @name DetailOperationManager
 * @author Julien PIERRE
 * @since 25/07/2013
 * 
 * @desc Classe permettant l'accès aux données des DetailOperation
 */
class DetailOperationManager
{
	const TABLE_DETAILOPERATION = TABLE_DETAILOPERATION;
	const CHAMP_DETAILOPERATION_ID = "dope_id";
	const CHAMP_DETAILOPERATION_ID_OPERATION = "dope_id_operation";
	const CHAMP_DETAILOPERATION_ID_COMPTE = "dope_id_compte";
	const CHAMP_DETAILOPERATION_MONTANT = "dope_montant";
	const CHAMP_DETAILOPERATION_LIBELLE = "dope_libelle";
	const CHAMP_DETAILOPERATION_DATE = "dope_date";
	const CHAMP_DETAILOPERATION_TYPE_PAIEMENT = "dope_type_paiement";
	const CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE = "dope_id_detail_commande";
	const CHAMP_DETAILOPERATION_ID_MODELE_LOT = "dope_id_modele_lot";
	const CHAMP_DETAILOPERATION_ID_NOM_PRODUIT = "dope_id_nom_produit";
	const CHAMP_DETAILOPERATION_ID_CONNEXION = "dope_id_connexion";

	/**
	* @name select($pId)
	* @param integer
	* @return DetailOperationVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une DetailOperationVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . DetailOperationManager::CHAMP_DETAILOPERATION_ID . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_OPERATION . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_COMPTE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_LIBELLE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_DATE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_CONNEXION . "
			FROM " . DetailOperationManager::TABLE_DETAILOPERATION . " 
			WHERE " . DetailOperationManager::CHAMP_DETAILOPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return DetailOperationManager::remplirDetailOperation(
				$pId,
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_OPERATION],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_COMPTE],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_LIBELLE],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_DATE],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_CONNEXION]);
		} else {
			return new DetailOperationVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(DetailOperationVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de DetailOperationVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . DetailOperationManager::CHAMP_DETAILOPERATION_ID . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_OPERATION . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_COMPTE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_LIBELLE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_DATE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_CONNEXION . "
			FROM " . DetailOperationManager::TABLE_DETAILOPERATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailOperation,
					DetailOperationManager::remplirDetailOperation(
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_OPERATION],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_COMPTE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_LIBELLE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_DATE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_CONNEXION]));
			}
		} else {
			$lListeDetailOperation[0] = new DetailOperationVO();
		}
		return $lListeDetailOperation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(DetailOperationVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de DetailOperationVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    DetailOperationManager::CHAMP_DETAILOPERATION_ID .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_OPERATION .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_COMPTE .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_LIBELLE .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_DATE .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_CONNEXION		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(DetailOperationManager::TABLE_DETAILOPERATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeDetailOperation = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeDetailOperation,
						DetailOperationManager::remplirDetailOperation(
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_OPERATION],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_COMPTE],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_LIBELLE],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_DATE],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_CONNEXION]));
				}
			} else {
				$lListeDetailOperation[0] = new DetailOperationVO();
			}

			return $lListeDetailOperation;
		}

		$lListeDetailOperation[0] = new DetailOperationVO();
		return $lListeDetailOperation;
	}

	/**
	* @name remplirDetailOperation($pId, $pIdOperation, $pIdCompte, $pMontant, $pLibelle, $pDate, $pTypePaiement, $pIdDetailCommande, $pIdModeleLot, $pIdNomProduit, $pIdConnexion)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(100)
	* @param datetime
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return DetailOperationVO
	* @desc Retourne une DetailOperationVO remplie
	*/
	private static function remplirDetailOperation($pId, $pIdOperation, $pIdCompte, $pMontant, $pLibelle, $pDate, $pTypePaiement, $pIdDetailCommande, $pIdModeleLot, $pIdNomProduit, $pIdConnexion) {
		$lDetailOperation = new DetailOperationVO();
		$lDetailOperation->setId($pId);
		$lDetailOperation->setIdOperation($pIdOperation);
		$lDetailOperation->setIdCompte($pIdCompte);
		$lDetailOperation->setMontant($pMontant);
		$lDetailOperation->setLibelle($pLibelle);
		$lDetailOperation->setDate($pDate);
		$lDetailOperation->setTypePaiement($pTypePaiement);
		$lDetailOperation->setIdDetailCommande($pIdDetailCommande);
		$lDetailOperation->setIdModeleLot($pIdModeleLot);
		$lDetailOperation->setIdNomProduit($pIdNomProduit);
		$lDetailOperation->setIdConnexion($pIdConnexion);
		return $lDetailOperation;
	}

	/**
	* @name insert($pVo)
	* @param DetailOperationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la DetailOperationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . DetailOperationManager::TABLE_DETAILOPERATION . "
				(" . DetailOperationManager::CHAMP_DETAILOPERATION_ID . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_OPERATION . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_COMPTE . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_LIBELLE . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_DATE . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT . "
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_CONNEXION . ")
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
				,'" . StringUtils::securiser( $lVo->getIdDetailCommande() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdModeleLot() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdNomProduit() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getIdDetailCommande() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdModeleLot() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdConnexion() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param DetailOperationVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du DetailOperationVO, avec les informations du DetailOperationVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . DetailOperationManager::TABLE_DETAILOPERATION . "
			 SET
				 " . DetailOperationManager::CHAMP_DETAILOPERATION_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . " = '" . StringUtils::securiser( $pVo->getMontant() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_LIBELLE . " = '" . StringUtils::securiser( $pVo->getLibelle() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_DATE . " = '" . StringUtils::securiser( $pVo->getDate() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = '" . StringUtils::securiser( $pVo->getTypePaiement() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE . " = '" . StringUtils::securiser( $pVo->getIdDetailCommande() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT . " = '" . StringUtils::securiser( $pVo->getIdModeleLot() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_CONNEXION . " = '" . StringUtils::securiser( $pVo->getIdConnexion() ) . "'
			 WHERE " . DetailOperationManager::CHAMP_DETAILOPERATION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . DetailOperationManager::TABLE_DETAILOPERATION . "
			WHERE " . DetailOperationManager::CHAMP_DETAILOPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>