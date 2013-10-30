<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/09/2013
// Fichier : DetailAchatManager.php
//
// Description : Classe de gestion des DetailAchat
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "DetailAchatVO.php");
include_once(CHEMIN_CLASSES_VO . "ProduitDetailAchatAfficheVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeAchatVO.php");
include_once(CHEMIN_CLASSES_VO . "MesAchatsVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationChampComplementaireManager.php");

define("TABLE_DETAILACHAT", MYSQL_DB_PREFIXE ."dach_detail_achat");
/**
 * @name DetailAchatManager
 * @author Julien PIERRE
 * @since 07/09/2013
 * 
 * @desc Classe permettant l'accès aux données des DetailAchat
 */
class DetailAchatManager
{
	const TABLE_DETAILACHAT = TABLE_DETAILACHAT;
	const CHAMP_DETAILACHAT_ID_OPERATION = "dach_id_operation";
	const CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE = "dach_id_operation_solidaire";
	const CHAMP_DETAILACHAT_ID_NOM_PRODUIT = "dach_id_nom_produit";
	const CHAMP_DETAILACHAT_ID_STOCK = "dach_id_stock";
	const CHAMP_DETAILACHAT_ID_DETAIL_OPERATION = "dach_id_detail_operation";
	const CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE = "dach_id_stock_solidaire";
	const CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE = "dach_id_detail_operation_solidaire";

	/**
	* @name select($pId)
	* @param integer
	* @return DetailAchatVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une DetailAchatVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE . "
			FROM " . DetailAchatManager::TABLE_DETAILACHAT . " 
			WHERE " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return DetailAchatManager::remplirDetailAchat(
				$pId,
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE]);
		} else {
			return new DetailAchatVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(DetailAchatVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de DetailAchatVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE . 
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE . "
			FROM " . DetailAchatManager::TABLE_DETAILACHAT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailAchat = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailAchat,
					DetailAchatManager::remplirDetailAchat(
					$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION],
					$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE],
					$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT],
					$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK],
					$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION],
					$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE],
					$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE]));
			}
		} else {
			$lListeDetailAchat[0] = new DetailAchatVO();
		}
		return $lListeDetailAchat;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(DetailAchatVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de DetailAchatVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION .
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE .
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT .
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK .
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION .
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE .
			"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(DetailAchatManager::TABLE_DETAILACHAT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeDetailAchat = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeDetailAchat,
						DetailAchatManager::remplirDetailAchat(
						$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION],
						$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE],
						$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT],
						$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK],
						$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION],
						$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE],
						$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE]));
				}
			} else {
				$lListeDetailAchat[0] = new DetailAchatVO();
			}

			return $lListeDetailAchat;
		}

		$lListeDetailAchat[0] = new DetailAchatVO();
		return $lListeDetailAchat;
	}

	/**
	* @name remplirDetailAchat($pIdOperation, $pIdOperationSolidaire, $pIdNomProduit, $pIdStock, $pIdDetailOperation, $pIdStockSolidaire, $pIdDetailOperationSolidaire)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return DetailAchatVO
	* @desc Retourne une DetailAchatVO remplie
	*/
	private static function remplirDetailAchat($pIdOperation, $pIdOperationSolidaire, $pIdNomProduit, $pIdStock, $pIdDetailOperation, $pIdStockSolidaire, $pIdDetailOperationSolidaire) {
		$lDetailAchat = new DetailAchatVO();
		$lDetailAchat->setIdOperation($pIdOperation);
		$lDetailAchat->setIdOperationSolidaire($pIdOperationSolidaire);
		$lDetailAchat->setIdNomProduit($pIdNomProduit);
		$lDetailAchat->setIdStock($pIdStock);
		$lDetailAchat->setIdDetailOperation($pIdDetailOperation);
		$lDetailAchat->setIdStockSolidaire($pIdStockSolidaire);
		$lDetailAchat->setIdDetailOperationSolidaire($pIdDetailOperationSolidaire);
		return $lDetailAchat;
	}

	/**
	 * @name selectProduitsDetailAchat($pIdOperationAchat, $pIdOperationAchatSolidaire)
	 * @param integer
	 * @return array(ProduitDetailAchatAfficheVO)
	 * @desc Récupère le detail de la ligne d'achat correspondant aux id en paramètre, créé une ProduitDetailAchatAfficheVO contenant les informations et la renvoie
	 */
	public static function selectProduitsDetailAchat($pIdOperationAchat, $pIdOperationAchatSolidaire) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
	
		$lRequete =
		"SELECT "
				. DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT .
				"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK .
				"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION .
				"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE .
				"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE .
				", stock." . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE . " AS stock_" . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE .
				", stock." . StockManager::CHAMP_STOCK_ID_MODELE_LOT . " AS stock_" . StockManager::CHAMP_STOCK_ID_MODELE_LOT .
				", stock_solidaire." . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE . " AS stock_solidaire_" . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE .
				", stock_solidaire." . StockManager::CHAMP_STOCK_ID_MODELE_LOT . " AS stock_solidaire_" . StockManager::CHAMP_STOCK_ID_MODELE_LOT .
				", stock." . StockManager::CHAMP_STOCK_QUANTITE . " AS stock_" . StockManager::CHAMP_STOCK_QUANTITE .
				", stock." . StockManager::CHAMP_STOCK_UNITE . " AS stock_" . StockManager::CHAMP_STOCK_UNITE .
				", stock_solidaire." . StockManager::CHAMP_STOCK_QUANTITE . " AS stock_solidaire_" . StockManager::CHAMP_STOCK_QUANTITE .
				", stock_solidaire." . StockManager::CHAMP_STOCK_UNITE . " AS stock_solidaire_" . StockManager::CHAMP_STOCK_UNITE .
				", dope." . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . " AS dope_" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
				", dope_solidaire." . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . " AS dope_solidaire_" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
				"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
				"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . "
			FROM " . DetailAchatManager::TABLE_DETAILACHAT . "
			JOIN " . NomProduitManager::TABLE_NOMPRODUIT . "
				ON " . DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT . " = " . NomProduitManager::CHAMP_NOMPRODUIT_ID . "
			JOIN " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . "
				ON " . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . " = " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "
			LEFT JOIN " . StockManager::TABLE_STOCK . " AS stock
				ON " . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK . " = stock." . StockManager::CHAMP_STOCK_ID . "
			LEFT JOIN " . DetailOperationManager::TABLE_DETAILOPERATION . " AS dope
				ON " . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION . " = dope." . DetailOperationManager::CHAMP_DETAILOPERATION_ID . "
			LEFT JOIN " . StockManager::TABLE_STOCK . " AS stock_solidaire
				ON " . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE . " = stock_solidaire." . StockManager::CHAMP_STOCK_ID . "
			LEFT JOIN " . DetailOperationManager::TABLE_DETAILOPERATION . " AS dope_solidaire
				ON " . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE . " = dope_solidaire." . DetailOperationManager::CHAMP_DETAILOPERATION_ID . "			
			WHERE " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " = '" . StringUtils::securiser($pIdOperationAchat) . "'
				AND " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " = '" . StringUtils::securiser($pIdOperationAchatSolidaire) . "'
			GROUP BY " . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK . " , " . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE . "
			ORDER BY " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . " ASC, " . NomProduitManager::CHAMP_NOMPRODUIT_NOM . " ASC;";
	
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		$lListeDetailAchat = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailAchat,
				new ProduitDetailAchatAfficheVO(
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE],
				$lLigne[DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE],
				$lLigne["stock_" . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
				$lLigne["stock_" . StockManager::CHAMP_STOCK_ID_MODELE_LOT],
				$lLigne["stock_solidaire_" . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE],
				$lLigne["stock_solidaire_" . StockManager::CHAMP_STOCK_ID_MODELE_LOT],				
				$lLigne["stock_" . StockManager::CHAMP_STOCK_QUANTITE],
				$lLigne["stock_" . StockManager::CHAMP_STOCK_UNITE],
				$lLigne["stock_solidaire_" . StockManager::CHAMP_STOCK_QUANTITE],
				$lLigne["stock_solidaire_" . StockManager::CHAMP_STOCK_UNITE],
				$lLigne["dope_" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
				$lLigne["dope_solidaire_" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
				$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
				$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]));
			}
		} else {
			$lListeDetailAchat[0] = new ProduitDetailAchatAfficheVO();
		}
		return $lListeDetailAchat;
	
	}
	
	/**
	 * @name mesAchats($pIdCompte)
	 * @param integer
	 * @return array(MesAchatsVO)
	 * @desc Retourne la liste des achats pour un compte
	 */
	public static function mesAchats($pIdCompte) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete =
		"SELECT 
			operation_achat.". OperationManager::CHAMP_OPERATION_ID .
			"," . CommandeManager::CHAMP_COMMANDE_ID .
			"," . CommandeManager::CHAMP_COMMANDE_NOM .
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO .
			", operation_achat.". OperationManager::CHAMP_OPERATION_DATE .
			", operation_achat.".OperationManager::CHAMP_OPERATION_MONTANT .
		" FROM (
			(SELECT
				ope." . OperationManager::CHAMP_OPERATION_ID .
				", ope." . OperationManager::CHAMP_OPERATION_DATE .
				", ope." . OperationManager::CHAMP_OPERATION_MONTANT . " + ope_solidaire." . OperationManager::CHAMP_OPERATION_MONTANT . " AS " . OperationManager::CHAMP_OPERATION_MONTANT .
				" FROM ( " .
					" SELECT DISTINCT "
						.  DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION .
						"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE .
					" FROM " . DetailAchatManager::TABLE_DETAILACHAT .
				") AS ligne_achat
				JOIN " . OperationManager::TABLE_OPERATION . " AS ope
					ON ope." . OperationManager::CHAMP_OPERATION_ID . " = ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . "
					AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " <> 0
				JOIN " . OperationManager::TABLE_OPERATION . " AS ope_solidaire
					ON ope_solidaire." . OperationManager::CHAMP_OPERATION_ID . " = ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . "
					AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " <> 0
				WHERE ope." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser($pIdCompte) . "'
					AND ope_solidaire." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser($pIdCompte) . "'
			) UNION (
				SELECT
					ope." . OperationManager::CHAMP_OPERATION_ID .
					", ope." . OperationManager::CHAMP_OPERATION_DATE .
					", ope." . OperationManager::CHAMP_OPERATION_MONTANT .
				" FROM ( " .
					" SELECT DISTINCT "
						. DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION .
						"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE .
						" FROM " . DetailAchatManager::TABLE_DETAILACHAT .
					") AS ligne_achat
				JOIN " . OperationManager::TABLE_OPERATION . " AS ope
					ON ope." . OperationManager::CHAMP_OPERATION_ID . " = ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . "
					AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " <> 0
					AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " = 0
				WHERE ope." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser($pIdCompte) . "'
			) UNION (
				SELECT
					ope_solidaire." . OperationManager::CHAMP_OPERATION_ID .
					", ope_solidaire." . OperationManager::CHAMP_OPERATION_DATE .
					", ope_solidaire." . OperationManager::CHAMP_OPERATION_MONTANT .
				" FROM ( " .
					" SELECT DISTINCT "
						.  DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION .
						"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE .
						" FROM " . DetailAchatManager::TABLE_DETAILACHAT .
					") AS ligne_achat
				JOIN " . OperationManager::TABLE_OPERATION . " AS ope_solidaire
					ON ope_solidaire." . OperationManager::CHAMP_OPERATION_ID . " = ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . "
					AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " <> 0
					AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " = 0
				WHERE ope_solidaire." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser($pIdCompte) . "'
			)
			) AS operation_achat
			LEFT JOIN " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . "
				ON " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = operation_achat." . OperationManager::CHAMP_OPERATION_ID . "
				AND " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = 1
			LEFT JOIN " . CommandeManager::TABLE_COMMANDE . "
				ON " . CommandeManager::CHAMP_COMMANDE_ID . " = " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . "
			ORDER BY OPE_date desc
			LIMIT 0 , 20;";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAchat = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAchat,
				new MesAchatsVO(
				$lLigne[OperationManager::CHAMP_OPERATION_ID],
				$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
				$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
				$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
				$lLigne[OperationManager::CHAMP_OPERATION_DATE],
				$lLigne[OperationManager::CHAMP_OPERATION_MONTANT]));
			}
		} else {
			$lListeAchat[0] = new MesAchatsVO();
		}
		return $lListeAchat;		
	}
	
	/**
	 * @name rechercheListeAchat( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	 * @param string nom de la table
	 * @param string Le type de critère de recherche
	 * @param array(string) champs à récupérer dans la table
	 * @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	 * @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	 * @return array(ListeAchatVO)
	 * @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeAchatVO
	 */
	public static function rechercheListeAchat( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
	
		// Préparation de la requète
		$lChamps = array(
				"operation_achat." . OperationManager::CHAMP_OPERATION_ID .
				", operation_achat." . OperationManager::CHAMP_OPERATION_DATE .
				"," . CommandeManager::CHAMP_COMMANDE_NUMERO .
				"," . AdherentManager::CHAMP_ADHERENT_ID .
				"," . AdherentManager::CHAMP_ADHERENT_NOM .
				"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
				"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
				"," . CompteManager::CHAMP_COMPTE_LABEL .
				", operation_achat." . OperationManager::CHAMP_OPERATION_MONTANT);
		
			
		
		/*
		 select 
operation_achat.ope_id,
operation_achat.ope_date,
com_numero,
adh_id,
adh_nom,
adh_prenom,
adh_numero,
cpt_label,
operation_achat.ope_montant

 from
(
(select
ope.ope_id, ope.ope_date, ope.ope_id_compte,
ope.ope_montant + ope_solidaire.ope_montant as ope_montant
from (
select distinct dach_id_operation, dach_id_operation_solidaire from dach_detail_achat) as ligne_achat
join ope_operation as ope on ope.ope_id = ligne_achat.dach_id_operation AND ligne_achat.dach_id_operation <> 0
join ope_operation as ope_solidaire on ope_solidaire.ope_id = ligne_achat.dach_id_operation_solidaire AND ligne_achat.dach_id_operation_solidaire <> 0
) union (
select
ope.ope_id, ope.ope_date, ope.ope_id_compte,
ope.ope_montant as ope_montant
from (
select distinct dach_id_operation, dach_id_operation_solidaire from dach_detail_achat) as ligne_achat
join ope_operation as ope on ope.ope_id = ligne_achat.dach_id_operation AND ligne_achat.dach_id_operation <> 0 
AND ligne_achat.dach_id_operation_solidaire = 0
) union (
select
ope_solidaire.ope_id, ope_solidaire.ope_date, ope_solidaire.ope_id_compte,
ope_solidaire.ope_montant as ope_montant
from (
select distinct dach_id_operation, dach_id_operation_solidaire from dach_detail_achat) as ligne_achat
join ope_operation as ope_solidaire on ope_solidaire.ope_id = ligne_achat.dach_id_operation_solidaire AND ligne_achat.dach_id_operation_solidaire <> 0
 AND ligne_achat.dach_id_operation = 0
)
) as operation_achat

 JOIN cpt_compte
	ON cpt_id = operation_achat.ope_id_compte 
LEFT JOIN adh_adherent
	ON adh_id_compte =  cpt_id
LEFT JOIN opecp_operation_champ_complementaire
	ON opecp_ope_id = operation_achat.ope_id
	AND opecp_chcp_id = 1
LEFT JOIN com_commande
	ON com_id = opecp_valeur 

WHERE
operation_achat.ope_date >= '2013-09-01' AND  operation_achat.ope_date <= '2013-09-30'
AND com_numero = 41
AND adh_id IS NULL 
		  
		 
		 
		 
		 
		 	DetailAchatManager::TABLE_DETAILACHAT . "
				JOIN " . OperationManager::TABLE_OPERATION . "
					ON (" . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " = " . OperationManager::CHAMP_OPERATION_ID . "
						AND " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " <> 0 )
					OR (" . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " = " . OperationManager::CHAMP_OPERATION_ID . "
						AND " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " <> 0 )
		 */
	
		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(
				"(
					(SELECT 
						ope." . OperationManager::CHAMP_OPERATION_ID .
						", ope." . OperationManager::CHAMP_OPERATION_DATE .
						", ope." . OperationManager::CHAMP_OPERATION_ID_COMPTE .
						", ope." . OperationManager::CHAMP_OPERATION_MONTANT . " + ope_solidaire." . OperationManager::CHAMP_OPERATION_MONTANT . " AS " . OperationManager::CHAMP_OPERATION_MONTANT .
					" FROM ( " .
						" SELECT DISTINCT " 
								.  DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION .
							"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE .
						" FROM " . DetailAchatManager::TABLE_DETAILACHAT .
					") AS ligne_achat
					JOIN " . OperationManager::TABLE_OPERATION . " AS ope 
						ON ope." . OperationManager::CHAMP_OPERATION_ID . " = ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . "
						AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " <> 0
					JOIN " . OperationManager::TABLE_OPERATION . " AS ope_solidaire 
						ON ope_solidaire." . OperationManager::CHAMP_OPERATION_ID . " = ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . "
						AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " <> 0
					) UNION (
						SELECT 
						ope." . OperationManager::CHAMP_OPERATION_ID .
						", ope." . OperationManager::CHAMP_OPERATION_DATE .
						", ope." . OperationManager::CHAMP_OPERATION_ID_COMPTE .
						", ope." . OperationManager::CHAMP_OPERATION_MONTANT .
					" FROM ( " .
						" SELECT DISTINCT " 
								.  DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION .
							"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE .
						" FROM " . DetailAchatManager::TABLE_DETAILACHAT .
					") AS ligne_achat
					JOIN " . OperationManager::TABLE_OPERATION . " AS ope 
						ON ope." . OperationManager::CHAMP_OPERATION_ID . " = ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . "
						AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " <> 0
						AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " = 0
					) UNION (
					SELECT 
						ope_solidaire." . OperationManager::CHAMP_OPERATION_ID .
						", ope_solidaire." . OperationManager::CHAMP_OPERATION_DATE .
						", ope_solidaire." . OperationManager::CHAMP_OPERATION_ID_COMPTE .
						", ope_solidaire." . OperationManager::CHAMP_OPERATION_MONTANT .
					" FROM ( " .
						" SELECT DISTINCT " 
								.  DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION .
							"," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE .
						" FROM " . DetailAchatManager::TABLE_DETAILACHAT .
					") AS ligne_achat
					JOIN " . OperationManager::TABLE_OPERATION . " AS ope_solidaire 
						ON ope_solidaire." . OperationManager::CHAMP_OPERATION_ID . " = ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . "
						AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " <> 0
						AND ligne_achat." . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " = 0
					)
				) AS operation_achat 				
				JOIN " . CompteManager::TABLE_COMPTE . "
					ON " . CompteManager::CHAMP_COMPTE_ID . " = operation_achat." . OperationManager::CHAMP_OPERATION_ID_COMPTE . "
				LEFT JOIN " . AdherentManager::TABLE_ADHERENT . "
					ON " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . " = " . CompteManager::CHAMP_COMPTE_ID . "
				LEFT JOIN " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . "
					ON " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = operation_achat." . OperationManager::CHAMP_OPERATION_ID . "
					AND " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = 1
				LEFT JOIN " . CommandeManager::TABLE_COMMANDE . "
					ON " . CommandeManager::CHAMP_COMMANDE_ID . " = " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR
						, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);
	
	/*	$lRequete = substr($lRequete, 0, sizeof($lRequete) - 2); // Suppression du ;
		$lRequete .= " GROUP BY " . AdherentManager::CHAMP_ADHERENT_ID . ", " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . ", " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE;
		*/
				
		$lListeAchat = array();
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
			if( mysql_num_rows($lSql) > 0 ) {
				while ($lLigne = mysql_fetch_assoc($lSql)) {
					array_push($lListeAchat,
					new ListeAchatVO(
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT]));
				}
			} else {
				$lListeAchat[0] = new ListeAchatVO();
			}
			return $lListeAchat;
		}
	
		$lListeAchat[0] = new ListeAchatVO();
		return $lListeAchat;
	}
	
	/**
	* @name insert($pVo)
	* @param DetailAchatVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la DetailAchatVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . DetailAchatManager::TABLE_DETAILACHAT . "
				(" . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . "
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . "
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT . "
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK . "
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION . "
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE . "
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "('" . StringUtils::securiser( $lVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdOperationSolidaire() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdStock() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdDetailOperation() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdStockSolidaire() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdDetailOperationSolidaire() ) . "')";

				if($lNbVO == $lI) {
					$lRequete .= ";";
				} else {
					$lRequete .= ",";
				}
				$lI++;
			}
		} else{
			$lRequete .= "('" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdOperationSolidaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdStock() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdDetailOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdStockSolidaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdDetailOperationSolidaire() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param DetailAchatVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du DetailAchatVO, avec les informations du DetailAchatVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . DetailAchatManager::TABLE_DETAILACHAT . "
			 SET
				 " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " = '" . StringUtils::securiser( $pVo->getIdOperationSolidaire() ) . "'
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK . " = '" . StringUtils::securiser( $pVo->getIdStock() ) . "'
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdDetailOperation() ) . "'
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_STOCK_SOLIDAIRE . " = '" . StringUtils::securiser( $pVo->getIdStockSolidaire() ) . "'
				," . DetailAchatManager::CHAMP_DETAILACHAT_ID_DETAIL_OPERATION_SOLIDAIRE . " = '" . StringUtils::securiser( $pVo->getIdDetailOperationSolidaire() ) . "'
			 WHERE " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}

	/**
	* @name delete($pIdOperation, $pIdOperationSolidaire)
	* @param integer
	* @param integer
	* @desc Supprime la ligne de la table correspondant à l'id en paramètre
	*/
	public static function delete($pIdOperation, $pIdOperationSolidaire) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = "DELETE FROM " . DetailAchatManager::TABLE_DETAILACHAT . "
			WHERE " . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION . " = '" . StringUtils::securiser($pIdOperation) . "'
				AND "  . DetailAchatManager::CHAMP_DETAILACHAT_ID_OPERATION_SOLIDAIRE . " = '" . StringUtils::securiser($pIdOperationSolidaire) . "';";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>