<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/07/2011
// Fichier : ReservationDetailViewManager.php
//
// Description : Classe de gestion des ReservationDetail
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ReservationDetailViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

define("VUE_RESERVATIONDETAIL", MYSQL_DB_PREFIXE . "view_reservation_detail");
/**
 * @name ReservationDetailViewManager
 * @author Julien PIERRE
 * @since 23/07/2011
 * 
 * @desc Classe permettant l'accès aux données des ReservationDetail
 */
class ReservationDetailViewManager
{
	const VUE_RESERVATIONDETAIL = VUE_RESERVATIONDETAIL;

	/**
	* @name select($pId)
	* @param integer
	* @return ReservationDetailViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ReservationDetailViewVO contenant les informations et la renvoie
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
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT .
			"," . StockManager::CHAMP_STOCK_TYPE ."
			FROM " . ReservationDetailViewManager::VUE_RESERVATIONDETAIL . " 
			WHERE " . StockManager::CHAMP_STOCK_ID_OPERATION . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeReservationDetail = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeReservationDetail,
					ReservationDetailViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT],
					$lLigne[StockManager::CHAMP_STOCK_TYPE]));
			}
		} else {
			$lListeReservationDetail[0] = new ReservationDetailViewVO();
		}
		return $lListeReservationDetail;
	}

	/**
	* @name selectAll()
	* @return array(ReservationDetailViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ReservationDetailViewVO
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
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT .
			"," . StockManager::CHAMP_STOCK_TYPE ."
			FROM " . ReservationDetailViewManager::VUE_RESERVATIONDETAIL;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeReservationDetail = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeReservationDetail,
					ReservationDetailViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT],
					$lLigne[StockManager::CHAMP_STOCK_TYPE]));
			}
		} else {
			$lListeReservationDetail[0] = new ReservationDetailViewVO();
		}
		return $lListeReservationDetail;
	}
	
	/**
	* @name selectDetail($pId,$pTypePaiement,$pTypeStock) {
	* @param integer
	* @param integer
	* @param integer
	* @return ReservationDetailViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ReservationDetailViewVO contenant les informations et la renvoie
	*/
	public static function selectDetail($pId,$pTypePaiement,$pTypeStock) {
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
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT .
			"," . StockManager::CHAMP_STOCK_TYPE ."
			FROM " . ReservationDetailViewManager::VUE_RESERVATIONDETAIL . " 
			WHERE " . StockManager::CHAMP_STOCK_ID_OPERATION . " = '" . StringUtils::securiser($pId) . "'
			AND " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = '" . StringUtils::securiser($pTypePaiement) . "'
			AND " . StockManager::CHAMP_STOCK_TYPE . " = '" . StringUtils::securiser($pTypeStock) . "';";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		$lListeReservationDetail = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeReservationDetail,
					ReservationDetailViewManager::remplir(
					$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT],
					$lLigne[StockManager::CHAMP_STOCK_TYPE]));
			}
		} else {
			$lListeReservationDetail[0] = new ReservationDetailViewVO();
		}
		return $lListeReservationDetail;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ReservationDetailViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ReservationDetailViewVO
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
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT.
			"," . StockManager::CHAMP_STOCK_TYPE   );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ReservationDetailViewManager::VUE_RESERVATIONDETAIL, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeReservationDetail = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeReservationDetail,
						ReservationDetailViewManager::remplir(
						$lLigne[StockManager::CHAMP_STOCK_ID_OPERATION],
						$lLigne[StockManager::CHAMP_STOCK_ID],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT],
						$lLigne[StockManager::CHAMP_STOCK_TYPE]));
				}
			} else {
				$lListeReservationDetail[0] = new ReservationDetailViewVO();
			}

			return $lListeReservationDetail;
		}

		$lListeReservationDetail[0] = new ReservationDetailViewVO();
		return $lListeReservationDetail;
	}

	/**
	* @name remplir($pStoIdOperation, $pStoId, $pDopeId, $pStoIdDetailCommande, $pDopeMontant, $pStoQuantite, $pDcomIdProduit, $pDopeTypePaiement, $pStoType)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return ReservationDetailViewVO
	* @desc Retourne une ReservationDetailViewVO remplie
	*/
	private static function remplir($pStoIdOperation, $pStoId, $pDopeId, $pStoIdDetailCommande, $pDopeMontant, $pStoQuantite, $pDcomIdProduit, $pDopeTypePaiement, $pStoType) {
		$lReservationDetail = new ReservationDetailViewVO();
		$lReservationDetail->setStoIdOperation($pStoIdOperation);
		$lReservationDetail->setStoId($pStoId);
		$lReservationDetail->setDopeId($pDopeId);
		$lReservationDetail->setStoIdDetailCommande($pStoIdDetailCommande);
		$lReservationDetail->setDopeMontant($pDopeMontant);
		$lReservationDetail->setStoQuantite($pStoQuantite);
		$lReservationDetail->setDcomIdProduit($pDcomIdProduit);
		$lReservationDetail->setDopeTypePaiement($pDopeTypePaiement);
		$lReservationDetail->setStoType($pStoType);
		return $lReservationDetail;
	}
}
?>