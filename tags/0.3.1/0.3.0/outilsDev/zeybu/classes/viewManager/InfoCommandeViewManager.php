<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/02/2011
// Fichier : InfoCommandeViewManager.php
//
// Description : Classe de gestion des InfoCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "InfoCommandeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");

/**
 * @name InfoCommandeViewManager
 * @author Julien PIERRE
 * @since 27/02/2011
 * 
 * @desc Classe permettant l'accès aux données des InfoCommande
 */
class InfoCommandeViewManager
{
	const VUE_INFOCOMMANDE = "view_info_commande";

	/**
	* @name select($pId)
	* @param integer
	* @return InfoCommandeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une InfoCommandeViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . "
			FROM " . InfoCommandeViewManager::VUE_INFOCOMMANDE . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoCommande,
					InfoCommandeViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT]));
			}
		} else {
			$lListeInfoCommande[0] = new InfoCommandeViewVO();
		}
		return $lListeInfoCommande;
	}

	/**
	* @name selectAll()
	* @return array(InfoCommandeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de InfoCommandeViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . "
			FROM " . InfoCommandeViewManager::VUE_INFOCOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoCommande,
					InfoCommandeViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT]));
			}
		} else {
			$lListeInfoCommande[0] = new InfoCommandeViewVO();
		}
		return $lListeInfoCommande;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(InfoCommandeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de InfoCommandeViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . OperationManager::CHAMP_OPERATION_MONTANT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(InfoCommandeViewManager::VUE_INFOCOMMANDE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeInfoCommande = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeInfoCommande,
						InfoCommandeViewManager::remplir(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT]));
				}
			} else {
				$lListeInfoCommande[0] = new InfoCommandeViewVO();
			}

			return $lListeInfoCommande;
		}

		$lListeInfoCommande[0] = new InfoCommandeViewVO();
		return $lListeInfoCommande;
	}

	/**
	* @name remplir($pComId, $pProIdProducteur, $pProId, $pProUniteMesure, $pNproNom, $pOpeMontant, $pStoQuantite, $pOpeMontantLivraison, $pStoQuantiteLivraison, $pStoQuantiteSolidaire, $pStoQuantiteVente, $pStoQuantiteVenteSolidaire, $pOpeMontantVente, $pOpeMontantVenteSolidaire)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @return InfoCommandeViewVO
	* @desc Retourne une InfoCommandeViewVO remplie
	*/
	private static function remplir($pComId, $pProIdProducteur, $pProId, $pProUniteMesure, $pNproNom, $pOpeMontant, $pStoQuantite, $pOpeMontantLivraison, $pStoQuantiteLivraison, $pStoQuantiteSolidaire, $pStoQuantiteVente, $pStoQuantiteVenteSolidaire, $pOpeMontantVente, $pOpeMontantVenteSolidaire) {
		$lInfoCommande = new InfoCommandeViewVO();
		$lInfoCommande->setComId($pComId);
		$lInfoCommande->setProIdProducteur($pProIdProducteur);
		$lInfoCommande->setProId($pProId);
		$lInfoCommande->setProUniteMesure($pProUniteMesure);
		$lInfoCommande->setNproNom($pNproNom);
		$lInfoCommande->setOpeMontant($pOpeMontant);
		$lInfoCommande->setStoQuantite($pStoQuantite);
		$lInfoCommande->setOpeMontantLivraison($pOpeMontantLivraison);
		$lInfoCommande->setStoQuantiteLivraison($pStoQuantiteLivraison);
		$lInfoCommande->setStoQuantiteSolidaire($pStoQuantiteSolidaire);
		$lInfoCommande->setStoQuantiteVente($pStoQuantiteVente);
		$lInfoCommande->setStoQuantiteVenteSolidaire($pStoQuantiteVenteSolidaire);
		$lInfoCommande->setOpeMontantVente($pOpeMontantVente);
		$lInfoCommande->setOpeMontantVenteSolidaire($pOpeMontantVenteSolidaire);
		return $lInfoCommande;
	}
}
?>