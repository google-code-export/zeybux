<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/07/2011
// Fichier : AchatDetailViewManager.php
//
// Description : Classe de gestion des AchatDetail
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "AchatDetailViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");

define("VUE_ACHATDETAIL", MYSQL_DB_PREFIXE . "view_achat_detail");
/**
 * @name AchatDetailViewManager
 * @author Julien PIERRE
 * @since 23/07/2011
 * 
 * @desc Classe permettant l'accès aux données des AchatDetail
 */
class AchatDetailViewManager
{
	const VUE_ACHATDETAIL = VUE_ACHATDETAIL;

	/**
	* @name select($pId)
	* @param integer
	* @return AchatDetailViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AchatDetailViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . StockManager::CHAMP_STOCK_ID_OPERATION . 
			"," . StockManager::CHAMP_STOCK_ID . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID . 
			"," . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT ."
			FROM " . AchatDetailViewManager::VUE_ACHATDETAIL . " 
			WHERE " . StockManager::CHAMP_STOCK_ID_OPERATION . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAchatDetail = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAchatDetail,
					AchatDetailViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT]));
			}
		} else {
			$lListeAchatDetail[0] = new AchatDetailViewVO();
		}
		return $lListeAchatDetail;
	}

	/**
	* @name selectAll()
	* @return array(AchatDetailViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AchatDetailViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . StockManager::CHAMP_STOCK_ID_OPERATION . 
			"," . StockManager::CHAMP_STOCK_ID . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID . 
			"," . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT. 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT ."
			FROM " . AchatDetailViewManager::VUE_ACHATDETAIL;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAchatDetail = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAchatDetail,
					AchatDetailViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT]));
			}
		} else {
			$lListeAchatDetail[0] = new AchatDetailViewVO();
		}
		return $lListeAchatDetail;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AchatDetailViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AchatDetailViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    StockManager::CHAMP_STOCK_ID_OPERATION .
			"," . StockManager::CHAMP_STOCK_ID .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID .
			"," . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT.
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AchatDetailViewManager::VUE_ACHATDETAIL, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAchatDetail = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeAchatDetail,
						AchatDetailViewManager::remplir(
						$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
						$lLigne[StockManager::CHAMP_STOCK_ID],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_MODELE_LOT],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID_NOM_PRODUIT]));
				}
			} else {
				$lListeAchatDetail[0] = new AchatDetailViewVO();
			}

			return $lListeAchatDetail;
		}

		$lListeAchatDetail[0] = new AchatDetailViewVO();
		return $lListeAchatDetail;
	}

	/**
	* @name remplir($pStoIdOperation, $pStoId, $pDopeId, $pStoIdDetailCommande, $pDopeIdModeleLot, $pDopeMontant, $pStoQuantite, $pDcomIdProduit, $pDcomIdNomProduit)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param int(11)
	* @param int(11)
	* @return AchatDetailViewVO
	* @desc Retourne une AchatDetailViewVO remplie
	*/
	private static function remplir($pStoIdOperation, $pStoId, $pDopeId, $pStoIdDetailCommande, $pDopeIdModeleLot, $pDopeMontant, $pStoQuantite, $pDcomIdProduit, $pDcomIdNomProduit) {
		$lAchatDetail = new AchatDetailViewVO();
		$lAchatDetail->setStoIdOperation($pStoIdOperation);
		$lAchatDetail->setStoId($pStoId);
		$lAchatDetail->setDopeId($pDopeId);
		$lAchatDetail->setStoIdDetailCommande($pStoIdDetailCommande);
		$lAchatDetail->setDopeIdModeleLot($pDopeIdModeleLot);
		$lAchatDetail->setDopeMontant($pDopeMontant);
		$lAchatDetail->setStoQuantite($pStoQuantite);
		$lAchatDetail->setDcomIdProduit($pDcomIdProduit);
		$lAchatDetail->setDcomIdNomProduit($pDcomIdNomProduit);
		return $lAchatDetail;
	}
}
?>