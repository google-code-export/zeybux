<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/08/2013
// Fichier : DetailFactureManager.php
//
// Description : Classe de gestion des DetailFacture
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "DetailFactureVO.php");
include_once(CHEMIN_CLASSES_VO . "ProduitDetailFactureAfficheVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

define("TABLE_DETAILFACTURE", MYSQL_DB_PREFIXE ."dfac_detail_facture");
/**
 * @name DetailFactureManager
 * @author Julien PIERRE
 * @since 18/08/2013
 * 
 * @desc Classe permettant l'accès aux données des DetailFacture
 */
class DetailFactureManager
{
	const TABLE_DETAILFACTURE = TABLE_DETAILFACTURE;
	const CHAMP_DETAILFACTURE_ID_OPERATION = "dfac_id_operation";
	const CHAMP_DETAILFACTURE_ID_NOM_PRODUIT = "dfac_id_nom_produit";
	const CHAMP_DETAILFACTURE_ID_STOCK = "dfac_id_stock";
	const CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION = "dfac_id_detail_operation";
	const CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE = "dfac_id_stock_solidaire";

	/**
	* @name select($pId)
	* @param integer
	* @return DetailFactureVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une DetailFactureVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION . 
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT . 
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK . 
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION . 
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE . "
			FROM " . DetailFactureManager::TABLE_DETAILFACTURE . " 
			WHERE " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return DetailFactureManager::remplirDetailFacture(
				$pId,
				$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT],
				$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK],
				$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION],
				$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE]);
		} else {
			return new DetailFactureVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(DetailFactureVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de DetailFactureVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION . 
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT . 
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK . 
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION . 
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE . "
			FROM " . DetailFactureManager::TABLE_DETAILFACTURE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailFacture = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailFacture,
					DetailFactureManager::remplirDetailFacture(
					$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION],
					$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT],
					$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK],
					$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION],
					$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE]));
			}
		} else {
			$lListeDetailFacture[0] = new DetailFactureVO();
		}
		return $lListeDetailFacture;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(DetailFactureVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de DetailFactureVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION .
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT .
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK .
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION .
			"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(DetailFactureManager::TABLE_DETAILFACTURE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeDetailFacture = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeDetailFacture,
						DetailFactureManager::remplirDetailFacture(
						$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION],
						$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT],
						$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK],
						$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION],
						$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE]));
				}
			} else {
				$lListeDetailFacture[0] = new DetailFactureVO();
			}

			return $lListeDetailFacture;
		}

		$lListeDetailFacture[0] = new DetailFactureVO();
		return $lListeDetailFacture;
	}

	/**
	* @name remplirDetailFacture($pIdOperation, $pIdNomProduit, $pIdStock, $pIdDetailOperation, $pIdStockSolidaire)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return DetailFactureVO
	* @desc Retourne une DetailFactureVO remplie
	*/
	private static function remplirDetailFacture($pIdOperation, $pIdNomProduit, $pIdStock, $pIdDetailOperation, $pIdStockSolidaire) {
		$lDetailFacture = new DetailFactureVO();
		$lDetailFacture->setIdOperation($pIdOperation);
		$lDetailFacture->setIdNomProduit($pIdNomProduit);
		$lDetailFacture->setIdStock($pIdStock);
		$lDetailFacture->setIdDetailOperation($pIdDetailOperation);
		$lDetailFacture->setIdStockSolidaire($pIdStockSolidaire);
		return $lDetailFacture;
	}
	
	/**
	 * @name selectProduitsDetailFacture($pId)
	 * @param integer
	 * @return array(ProduitDetailFactureAfficheVO)
	 * @desc Récupère le detail de la ligne de facture correspondant à l'id en paramètre, créé une ProduitDetailFactureAfficheVO contenant les informations et la renvoie
	 */
	public static function selectProduitsDetailFacture($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
	
		$lRequete =
		"SELECT "
				. DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT .
				"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK .
				"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION .
				"," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE .
				", stock." . StockManager::CHAMP_STOCK_QUANTITE . " AS stock_" . StockManager::CHAMP_STOCK_QUANTITE .
				", stock." . StockManager::CHAMP_STOCK_UNITE . " AS stock_" . StockManager::CHAMP_STOCK_UNITE .
				", stock_solidaire." . StockManager::CHAMP_STOCK_QUANTITE . " AS stock_solidaire_" . StockManager::CHAMP_STOCK_QUANTITE .
				", stock_solidaire." . StockManager::CHAMP_STOCK_UNITE . " AS stock_solidaire_" . StockManager::CHAMP_STOCK_UNITE .
				"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
				"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
				"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . "
			FROM " . DetailFactureManager::TABLE_DETAILFACTURE . "
			JOIN " . NomProduitManager::TABLE_NOMPRODUIT . "
				ON " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT . " = " . NomProduitManager::CHAMP_NOMPRODUIT_ID . "
			JOIN " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . "
				ON " . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . " = " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "
			LEFT JOIN " . StockManager::TABLE_STOCK . " As stock
				ON " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK . " = stock." . StockManager::CHAMP_STOCK_ID . "
			LEFT JOIN " . DetailOperationManager::TABLE_DETAILOPERATION . "
				ON " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION . " = " . DetailOperationManager::CHAMP_DETAILOPERATION_ID . "
			LEFT JOIN " . StockManager::TABLE_STOCK . " As stock_solidaire
				ON " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE . " = stock_solidaire." . StockManager::CHAMP_STOCK_ID . "
			WHERE " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION . " = '" . StringUtils::securiser($pId) . "'
			GROUP BY " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK . " , " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE . "
			ORDER BY " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . " ASC, " . NomProduitManager::CHAMP_NOMPRODUIT_NOM . " ASC;";
	
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeDetailFacture = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailFacture,
				new ProduitDetailFactureAfficheVO(
				$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT],
				$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK],
				$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION],
				$lLigne[DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE],
				$lLigne["stock_" . StockManager::CHAMP_STOCK_QUANTITE],
				$lLigne["stock_" . StockManager::CHAMP_STOCK_UNITE],
				$lLigne["stock_solidaire_" . StockManager::CHAMP_STOCK_QUANTITE],
				$lLigne["stock_solidaire_" . StockManager::CHAMP_STOCK_UNITE],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
				$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
				$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]));
			}
		} else {
			$lListeDetailFacture[0] = new ProduitDetailFactureAfficheVO();
		}
		return $lListeDetailFacture;
	
	}
	
	/**
	* @name insert($pVo)
	* @param DetailFactureVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la DetailFactureVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . DetailFactureManager::TABLE_DETAILFACTURE . "
				(" . DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION . "
				," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT . "
				," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK . "
				," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION . "
				," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "('" . StringUtils::securiser( $lVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdStock() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdDetailOperation() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdStockSolidaire() ) . "')";

				if($lNbVO == $lI) {
					$lRequete .= ";";
				} else {
					$lRequete .= ",";
				}
				$lI++;
			}
		} else{
			$lRequete .= "('" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdStock() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdDetailOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdStockSolidaire() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param DetailFactureVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du DetailFactureVO, avec les informations du DetailFactureVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . DetailFactureManager::TABLE_DETAILFACTURE . "
			 SET
				 " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK . " = '" . StringUtils::securiser( $pVo->getIdStock() ) . "'
				," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_DETAIL_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdDetailOperation() ) . "'
				," . DetailFactureManager::CHAMP_DETAILFACTURE_ID_STOCK_SOLIDAIRE . " = '" . StringUtils::securiser( $pVo->getIdStockSolidaire() ) . "'
			 WHERE " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'";

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

		$lRequete = "DELETE FROM " . DetailFactureManager::TABLE_DETAILFACTURE . "
			WHERE " . DetailFactureManager::CHAMP_DETAILFACTURE_ID_OPERATION . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>