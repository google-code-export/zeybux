<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/11/2010
// Fichier : StockProduitInitiauxViewManager.php
//
// Description : Classe de gestion des StockProduitInitiaux
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "StockProduitInitiauxViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

/**
 * @name StockProduitInitiauxViewManager
 * @author Julien PIERRE
 * @since 26/11/2010
 * 
 * @desc Classe permettant l'accès aux données des StockProduitInitiaux
 */
class StockProduitInitiauxViewManager
{
	const VUE_STOCKPRODUITINITIAUX = "view_stock_produit_initiaux";

	/**
	* @name select($pId)
	* @param integer
	* @return StockProduitInitiauxViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockProduitInitiauxViewVO contenant les informations et la renvoie
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
			"," . StockManager::CHAMP_STOCK_ID_COMMANDE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . "
			FROM " . StockProduitInitiauxViewManager::VUE_STOCKPRODUITINITIAUX . " 
			WHERE " . StockManager::CHAMP_STOCK_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduitInitiaux = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduitInitiaux,
					StockProduitInitiauxViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[StockManager::CHAMP_STOCK_DATE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_TYPE],
					$lLigne[StockManager::CHAMP_STOCK_ID_COMMANDE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT]));
			}
		} else {
			$lListeStockProduitInitiaux[0] = new StockProduitInitiauxViewVO();
		}
		return $lListeStockProduitInitiaux;
	}

	/**
	* @name selectAll()
	* @return array(StockProduitInitiauxViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockProduitInitiauxViewVO
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
			"," . StockManager::CHAMP_STOCK_ID_COMMANDE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . "
			FROM " . StockProduitInitiauxViewManager::VUE_STOCKPRODUITINITIAUX;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduitInitiaux = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduitInitiaux,
					StockProduitInitiauxViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[StockManager::CHAMP_STOCK_DATE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_TYPE],
					$lLigne[StockManager::CHAMP_STOCK_ID_COMMANDE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT]));
			}
		} else {
			$lListeStockProduitInitiaux[0] = new StockProduitInitiauxViewVO();
		}
		return $lListeStockProduitInitiaux;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockProduitInitiauxViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockProduitInitiauxViewVO
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
			"," . StockManager::CHAMP_STOCK_ID_COMMANDE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT		);

		if(is_array($pTypeRecherche) && is_array($pCritereRecherche)) {
			$lFiltres = array();
			$i = 0;
			foreach($pTypeRecherche as $lTypeRecherche) {
				$lLigne = array();
				$lLigne['champ'] = StringUtils::securiser($lTypeRecherche);
				$lLigne['valeur'] = StringUtils::securiser($pCritereRecherche[6]);
				array_push($lFiltres,$lLigne);
				$i++;
			}
		} else {
			$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));
		}

		if(is_array($pTypeCritere)) {
			$lTypeFiltre = $pTypeCritere;
		} else {
			$lTypeFiltre = array($pTypeCritere);
		}

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
		$lRequete = DbUtils::prepareRequeteRecherche(StockProduitInitiauxViewManager::VUE_STOCKPRODUITINITIAUX, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduitInitiaux = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeStockProduitInitiaux,
					StockProduitInitiauxViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[StockManager::CHAMP_STOCK_DATE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_TYPE],
					$lLigne[StockManager::CHAMP_STOCK_ID_COMMANDE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT]));
			}
		} else {
			$lListeStockProduitInitiaux[0] = new StockProduitInitiauxViewVO();
		}

		return $lListeStockProduitInitiaux;
	}

	/**
	* @name remplirStockProduitInitiaux($pId, $pDate, $pQuantite, $pType, $pIdCommande, $pIdProduit)
	* @param int(11)
	* @param datetime
	* @param decimal(10,2)
	* @param tinyint(1)
	* @param int(11)
	* @param int(11)
	* @return StockProduitInitiauxViewVO
	* @desc Retourne une StockProduitInitiauxViewVO remplie
	*/
	private static function remplir($pId, $pDate, $pQuantite, $pType, $pIdCommande, $pIdProduit) {
		$lStockProduitInitiaux = new StockProduitInitiauxViewVO();
		$lStockProduitInitiaux->setId($pId);
		$lStockProduitInitiaux->setDate($pDate);
		$lStockProduitInitiaux->setQuantite($pQuantite);
		$lStockProduitInitiaux->setType($pType);
		$lStockProduitInitiaux->setIdCommande($pIdCommande);
		$lStockProduitInitiaux->setIdProduit($pIdProduit);
		return $lStockProduitInitiaux;
	}
}
?>