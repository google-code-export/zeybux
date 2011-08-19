<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/09/2010
// Fichier : StockProduitViewManager.php
//
// Description : Classe de gestion des StockProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "StockProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");

/**
 * @name StockProduitViewManager
 * @author Julien PIERRE
 * @since 18/09/2010
 * 
 * @desc Classe permettant l'accès aux données des StockProduit
 */
class StockProduitViewManager
{
	const VUE_STOCKPRODUIT = "view_stock_produit";

	/**
	* @name select($pId)
	* @param integer
	* @return StockProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
			FROM " . StockProduitViewManager::VUE_STOCKPRODUIT . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduit,
					StockProduitViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockProduit[0] = new StockProduitViewVO();
		}
		return $lListeStockProduit;
	}

	/**
	* @name selectAll()
	* @return array(StockProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
			FROM " . StockProduitViewManager::VUE_STOCKPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduit,
					StockProduitViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockProduit[0] = new StockProduitViewVO();
		}
		return $lListeStockProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .
			"," . StockManager::CHAMP_STOCK_QUANTITE		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = ProduitManager::CHAMP_PRODUIT_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(StockProduitViewManager::VUE_STOCKPRODUIT, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduit = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeStockProduit,
					StockProduitViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockProduit[0] = new StockProduitViewVO();
		}

		return $lListeStockProduit;
	}

	/**
	* @name remplirStockProduit($pProId, $pProIdCommande, $pProIdNomProduit, $pStoQuantite)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(32,2)
	* @return StockProduitViewVO
	* @desc Retourne une StockProduitViewVO remplie
	*/
	private static function remplir($pProId, $pProIdCommande, $pProIdNomProduit, $pStoQuantite) {
		$lStockProduit = new StockProduitViewVO();
		$lStockProduit->setProId($pProId);
		$lStockProduit->setProIdCommande($pProIdCommande);
		$lStockProduit->setProIdNomProduit($pProIdNomProduit);
		$lStockProduit->setStoQuantite($pStoQuantite);
		return $lStockProduit;
	}
}
?>