<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/04/2013
// Fichier : StockQuantiteManager.php
//
// Description : Classe de gestion des StockQuantite
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "StockQuantiteVO.php");

define("TABLE_STOCKQUANTITE", MYSQL_DB_PREFIXE ."stoqte_stock_quantite");
/**
 * @name StockQuantiteManager
 * @author Julien PIERRE
 * @since 28/04/2013
 * 
 * @desc Classe permettant l'accès aux données des StockQuantite
 */
class StockQuantiteManager
{
	const TABLE_STOCKQUANTITE = TABLE_STOCKQUANTITE;
	const CHAMP_STOCKQUANTITE_ID = "stoqte_id";
	const CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT = "stoqte_id_nom_produit";
	const CHAMP_STOCKQUANTITE_QUANTITE = "stoqte_quantite";
	const CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE = "stoqte_quantite_solidaire";
	const CHAMP_STOCKQUANTITE_UNITE = "stoqte_unite";
	const CHAMP_STOCKQUANTITE_DATE_CREATION = "stoqte_date_creation";
	const CHAMP_STOCKQUANTITE_DATE_MODIFICATION = "stoqte_date_modification";
	const CHAMP_STOCKQUANTITE_ID_LOGIN = "stoqte_id_login";
	const CHAMP_STOCKQUANTITE_ETAT = "stoqte_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return StockQuantiteVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockQuantiteVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_CREATION . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_MODIFICATION . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_LOGIN . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT . "
			FROM " . StockQuantiteManager::TABLE_STOCKQUANTITE . " 
			WHERE " . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return StockQuantiteManager::remplirStockQuantite(
				$pId,
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_CREATION],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_MODIFICATION],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_LOGIN],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT]);
		} else {
			return new StockQuantiteVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(StockQuantiteVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockQuantiteVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_CREATION . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_MODIFICATION . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_LOGIN . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT . "
			FROM " . StockQuantiteManager::TABLE_STOCKQUANTITE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockQuantite = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockQuantite,
					StockQuantiteManager::remplirStockQuantite(
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_CREATION],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_MODIFICATION],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_LOGIN],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT]));
			}
		} else {
			$lListeStockQuantite[0] = new StockQuantiteVO();
		}
		return $lListeStockQuantite;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockQuantiteVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockQuantiteVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    StockQuantiteManager::CHAMP_STOCKQUANTITE_ID .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_CREATION .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_MODIFICATION .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_LOGIN .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(StockQuantiteManager::TABLE_STOCKQUANTITE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeStockQuantite = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeStockQuantite,
						StockQuantiteManager::remplirStockQuantite(
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_CREATION],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_MODIFICATION],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_LOGIN],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT]));
				}
			} else {
				$lListeStockQuantite[0] = new StockQuantiteVO();
			}

			return $lListeStockQuantite;
		}

		$lListeStockQuantite[0] = new StockQuantiteVO();
		return $lListeStockQuantite;
	}

	/**
	* @name remplirStockQuantite($pId, $pIdNomProduit, $pQuantite, $pQuantiteSolidaire, $pUnite, $pDateCreation, $pDateModification, $pIdLogin, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param varchar(20)
	* @param datetime
	* @param datetime
	* @param int(11)
	* @param tinyint(1)
	* @return StockQuantiteVO
	* @desc Retourne une StockQuantiteVO remplie
	*/
	private static function remplirStockQuantite($pId, $pIdNomProduit, $pQuantite, $pQuantiteSolidaire, $pUnite, $pDateCreation, $pDateModification, $pIdLogin, $pEtat) {
		$lStockQuantite = new StockQuantiteVO();
		$lStockQuantite->setId($pId);
		$lStockQuantite->setIdNomProduit($pIdNomProduit);
		$lStockQuantite->setQuantite($pQuantite);
		$lStockQuantite->setQuantiteSolidaire($pQuantiteSolidaire);
		$lStockQuantite->setUnite($pUnite);
		$lStockQuantite->setDateCreation($pDateCreation);
		$lStockQuantite->setDateModification($pDateModification);
		$lStockQuantite->setIdLogin($pIdLogin);
		$lStockQuantite->setEtat($pEtat);
		return $lStockQuantite;
	}

	/**
	* @name insert($pVo)
	* @param StockQuantiteVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la StockQuantiteVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . StockQuantiteManager::TABLE_STOCKQUANTITE . "
				(" . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID . "
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT . "
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE . "
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE . "
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE . "
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_CREATION . "
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_MODIFICATION . "
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_LOGIN . "
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $lVo->getQuantite() ) . "'
				,'" . StringUtils::securiser( $lVo->getQuantiteSolidaire() ) . "'
				,'" . StringUtils::securiser( $lVo->getUnite() ) . "'
				,'" . StringUtils::securiser( $lVo->getDateCreation() ) . "'
				,'" . StringUtils::securiser( $lVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdLogin() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				,'" . StringUtils::securiser( $pVo->getQuantiteSolidaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getUnite() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdLogin() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param StockQuantiteVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du StockQuantiteVO, avec les informations du StockQuantiteVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . StockQuantiteManager::TABLE_STOCKQUANTITE . "
			 SET
				 " . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE . " = '" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE . " = '" . StringUtils::securiser( $pVo->getQuantiteSolidaire() ) . "'
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE . " = '" . StringUtils::securiser( $pVo->getUnite() ) . "'
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_CREATION . " = '" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_DATE_MODIFICATION . " = '" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_LOGIN . " = '" . StringUtils::securiser( $pVo->getIdLogin() ) . "'
				," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . StockQuantiteManager::TABLE_STOCKQUANTITE . "
			WHERE " . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>