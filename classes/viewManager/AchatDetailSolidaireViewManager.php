<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/07/2011
// Fichier : AchatDetailSolidaireViewManager.php
//
// Description : Classe de gestion des AchatDetailSolidaire
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "AchatDetailSolidaireViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

define("VUE_ACHATDETAILSOLIDAIRE", MYSQL_DB_PREFIXE . "view_achat_detail_solidaire");
/**
 * @name AchatDetailSolidaireViewManager
 * @author Julien PIERRE
 * @since 23/07/2011
 * 
 * @desc Classe permettant l'accès aux données des AchatDetailSolidaire
 */
class AchatDetailSolidaireViewManager
{
	const VUE_ACHATDETAILSOLIDAIRE = VUE_ACHATDETAILSOLIDAIRE;

	/**
	* @name select($pId)
	* @param integer
	* @return AchatDetailSolidaireViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AchatDetailSolidaireViewVO contenant les informations et la renvoie
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
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . "
			FROM " . AchatDetailSolidaireViewManager::VUE_ACHATDETAILSOLIDAIRE . " 
			WHERE " . StockManager::CHAMP_STOCK_ID_OPERATION . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAchatDetailSolidaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAchatDetailSolidaire,
					AchatDetailSolidaireViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT]));
			}
		} else {
			$lListeAchatDetailSolidaire[0] = new AchatDetailSolidaireViewVO();
		}
		return $lListeAchatDetailSolidaire;
	}

	/**
	* @name selectAll()
	* @return array(AchatDetailSolidaireViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AchatDetailSolidaireViewVO
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
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . "
			FROM " . AchatDetailSolidaireViewManager::VUE_ACHATDETAILSOLIDAIRE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAchatDetailSolidaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAchatDetailSolidaire,
					AchatDetailSolidaireViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT]));
			}
		} else {
			$lListeAchatDetailSolidaire[0] = new AchatDetailSolidaireViewVO();
		}
		return $lListeAchatDetailSolidaire;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AchatDetailSolidaireViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AchatDetailSolidaireViewVO
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
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AchatDetailSolidaireViewManager::VUE_ACHATDETAILSOLIDAIRE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAchatDetailSolidaire = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeAchatDetailSolidaire,
						AchatDetailSolidaireViewManager::remplir(
						$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
						$lLigne[StockManager::CHAMP_STOCK_ID],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT]));
				}
			} else {
				$lListeAchatDetailSolidaire[0] = new AchatDetailSolidaireViewVO();
			}

			return $lListeAchatDetailSolidaire;
		}

		$lListeAchatDetailSolidaire[0] = new AchatDetailSolidaireViewVO();
		return $lListeAchatDetailSolidaire;
	}

	/**
	* @name remplir($pStoIdOperation, $pStoId, $pDopeId, $pStoIdDetailCommande, $pDopeMontant, $pStoQuantite, $pDcomIdProduit)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param int(11)
	* @return AchatDetailSolidaireViewVO
	* @desc Retourne une AchatDetailSolidaireViewVO remplie
	*/
	private static function remplir($pStoIdOperation, $pStoId, $pDopeId, $pStoIdDetailCommande, $pDopeMontant, $pStoQuantite, $pDcomIdProduit) {
		$lAchatDetailSolidaire = new AchatDetailSolidaireViewVO();
		$lAchatDetailSolidaire->setStoIdOperation($pStoIdOperation);
		$lAchatDetailSolidaire->setStoId($pStoId);
		$lAchatDetailSolidaire->setDopeId($pDopeId);
		$lAchatDetailSolidaire->setStoIdDetailCommande($pStoIdDetailCommande);
		$lAchatDetailSolidaire->setDopeMontant($pDopeMontant);
		$lAchatDetailSolidaire->setStoQuantite($pStoQuantite);
		$lAchatDetailSolidaire->setDcomIdProduit($pDcomIdProduit);
		return $lAchatDetailSolidaire;
	}
}
?>