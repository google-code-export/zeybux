<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : StockManager.php
//
// Description : Classe de gestion des Stock
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "StockVO.php");

/**
 * @name Stock
 * @author Julien PIERRE
 * @since 02/09/2010
 * 
 * @desc Classe permettant l'accès aux données des Stock
 */
class StockManager
{
	const TABLE_STOCK = "sto_stock";
	const CHAMP_STOCK_ID = "sto_id";
	const CHAMP_STOCK_DATE = "sto_date";
	const CHAMP_STOCK_QUANTITE = "sto_quantite";
	const CHAMP_STOCK_TYPE = "sto_type";
	const CHAMP_STOCK_ID_COMPTE = "sto_id_compte";
	const CHAMP_STOCK_ID_PRODUIT = "sto_id_produit";

	/**
	* @name select($pId)
	* @param integer
	* @return StockVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . StockManager::CHAMP_STOCK_ID . 
			"," . StockManager::CHAMP_STOCK_DATE . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . StockManager::CHAMP_STOCK_TYPE . 
			"," . StockManager::CHAMP_STOCK_ID_COMPTE . 
			"," . StockManager::CHAMP_STOCK_ID_PRODUIT . "
			FROM " . StockManager::TABLE_STOCK . " 
			WHERE " . StockManager::CHAMP_STOCK_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return StockManager::remplirStock(
				$pId,
				$lLigne[StockManager::CHAMP_STOCK_DATE],
				$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
				$lLigne[StockManager::CHAMP_STOCK_TYPE],
				$lLigne[StockManager::CHAMP_STOCK_ID_COMPTE],
				$lLigne[StockManager::CHAMP_STOCK_ID_PRODUIT]);
		} else {
			return new StockVO();
		}
	}

	/**
	* @name selectAll
	* @return array(StockVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . StockManager::CHAMP_STOCK_ID . 
			"," . StockManager::CHAMP_STOCK_DATE . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . StockManager::CHAMP_STOCK_TYPE . 
			"," . StockManager::CHAMP_STOCK_ID_COMPTE . 
			"," . StockManager::CHAMP_STOCK_ID_PRODUIT . "
			FROM " . StockManager::TABLE_STOCK;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStock = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStock,
					StockManager::remplirStock(
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[StockManager::CHAMP_STOCK_DATE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_TYPE],
					$lLigne[StockManager::CHAMP_STOCK_ID_COMPTE],
					$lLigne[StockManager::CHAMP_STOCK_ID_PRODUIT]));
			}
		} else {
			$lListeStock[0] = new StockVO();
		}
		return $lListeStock;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    StockManager::CHAMP_STOCK_ID .
			"," . StockManager::CHAMP_STOCK_DATE .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . StockManager::CHAMP_STOCK_TYPE .
			"," . StockManager::CHAMP_STOCK_ID_COMPTE .
			"," . StockManager::CHAMP_STOCK_ID_PRODUIT		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = StockManager::CHAMP_STOCK_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(StockManager::TABLE_STOCK, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStock = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeStock,
					StockManager::remplirStock(
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[StockManager::CHAMP_STOCK_DATE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_TYPE],
					$lLigne[StockManager::CHAMP_STOCK_ID_COMPTE],
					$lLigne[StockManager::CHAMP_STOCK_ID_PRODUIT]));
			}
		} else {
			$lListeStock[0] = new StockVO();
		}

		return $lListeStock;
	}

	/**
	* @name remplirStock($pId, $pDate, $pQuantite, $pType, $pIdCompte, $pIdProduit)
	* @param int(11)
	* @param datetime
	* @param decimal(10,2)
	* @param tinyint(1)
	* @param int(11)
	* @param int(11)
	* @return StockVO
	* @desc Retourne une StockVO remplie
	*/
	private static function remplirStock($pId, $pDate, $pQuantite, $pType, $pIdCompte, $pIdProduit) {
		$lStock = new StockVO();
		$lStock->setId($pId);
		$lStock->setDate($pDate);
		$lStock->setQuantite($pQuantite);
		$lStock->setType($pType);
		$lStock->setIdCompte($pIdCompte);
		$lStock->setIdProduit($pIdProduit);
		return $lStock;
	}

	/**
	* @name insert($pVo)
	* @param StockVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la StockVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . StockManager::TABLE_STOCK . "
				(" . StockManager::CHAMP_STOCK_ID . "
				," . StockManager::CHAMP_STOCK_DATE . "
				," . StockManager::CHAMP_STOCK_QUANTITE . "
				," . StockManager::CHAMP_STOCK_TYPE . "
				," . StockManager::CHAMP_STOCK_ID_COMPTE . "
				," . StockManager::CHAMP_STOCK_ID_PRODUIT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getDate() ) . "'
				,'" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				,'" . StringUtils::securiser( $pVo->getType() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdProduit() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param StockVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du StockVO, avec les informations du StockVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . StockManager::TABLE_STOCK . "
			 SET
				 " . StockManager::CHAMP_STOCK_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'
				," . StockManager::CHAMP_STOCK_DATE . " = '" . StringUtils::securiser( $pVo->getDate() ) . "'
				," . StockManager::CHAMP_STOCK_QUANTITE . " = '" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				," . StockManager::CHAMP_STOCK_TYPE . " = '" . StringUtils::securiser( $pVo->getType() ) . "'
				," . StockManager::CHAMP_STOCK_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . StockManager::CHAMP_STOCK_ID_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdProduit() ) . "'
			 WHERE " . StockManager::CHAMP_STOCK_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . StockManager::TABLE_STOCK . "
			WHERE " . StockManager::CHAMP_STOCK_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>