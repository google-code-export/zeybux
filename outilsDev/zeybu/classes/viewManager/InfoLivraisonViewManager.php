<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoLivraisonViewManager.php
//
// Description : Classe de gestion des InfoLivraison
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "InfoLivraisonViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "View_info_livraison.php");

/**
 * @name InfoLivraisonViewManager
 * @author Julien PIERRE
 * @since 24/01/2011
 * 
 * @desc Classe permettant l'accès aux données des InfoLivraison
 */
class InfoLivraisonViewManager
{
	const VUE_INFOLIVRAISON = "view_info_livraison";

	/**
	* @name select($pId)
	* @param integer
	* @return InfoLivraisonViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une InfoLivraisonViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . View_info_livraison::CHAMP_INFO_LIVRAISON_OPERATION_MONTANT . 
			"," . View_info_livraison::CHAMP_INFO_LIVRAISON_STOCK_QUANTITE . "
			FROM " . InfoLivraisonViewManager::VUE_INFOLIVRAISON . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoLivraison,
					InfoLivraisonViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[View_info_livraison::CHAMP_INFO_LIVRAISON_OPERATION_MONTANT],
					$lLigne[View_info_livraison::CHAMP_INFO_LIVRAISON_STOCK_QUANTITE]));
			}
		} else {
			$lListeInfoLivraison[0] = new InfoLivraisonViewVO();
		}
		return $lListeInfoLivraison;
	}

	/**
	* @name selectAll()
	* @return array(InfoLivraisonViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de InfoLivraisonViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . View_info_livraison::CHAMP_INFO_LIVRAISON_OPERATION_MONTANT . 
			"," . View_info_livraison::CHAMP_INFO_LIVRAISON_STOCK_QUANTITE . "
			FROM " . InfoLivraisonViewManager::VUE_INFOLIVRAISON;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoLivraison,
					InfoLivraisonViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[View_info_livraison::CHAMP_INFO_LIVRAISON_OPERATION_MONTANT],
					$lLigne[View_info_livraison::CHAMP_INFO_LIVRAISON_STOCK_QUANTITE]));
			}
		} else {
			$lListeInfoLivraison[0] = new InfoLivraisonViewVO();
		}
		return $lListeInfoLivraison;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(InfoLivraisonViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de InfoLivraisonViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID .
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . StockManager::CHAMP_STOCK_QUANTITE .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM .
			"," . View_info_livraison::CHAMP_INFO_LIVRAISON_OPERATION_MONTANT .
			"," . View_info_livraison::CHAMP_INFO_LIVRAISON_STOCK_QUANTITE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(InfoLivraisonViewManager::VUE_INFOLIVRAISON, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeInfoLivraison = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeInfoLivraison,
						InfoLivraisonViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
						$lLigne[View_info_livraison::CHAMP_INFO_LIVRAISON_OPERATION_MONTANT],
						$lLigne[View_info_livraison::CHAMP_INFO_LIVRAISON_STOCK_QUANTITE]));
				}
			} else {
				$lListeInfoLivraison[0] = new InfoLivraisonViewVO();
			}

			return $lListeInfoLivraison;
		}

		$lListeInfoLivraison[0] = new InfoLivraisonViewVO();
		return $lListeInfoLivraison;
	}

	/**
	* @name remplir($pcomId, $pProIdProducteur, $pProId, $pProUniteMesure, $pNproNom, $pOpeMontant, $pStoQuantite, $pPrdtNom, $pPrdtPrenom, $pOpeMontantLivraison, $pStoQuantiteLivraison)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param varchar(50)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @return InfoLivraisonViewVO
	* @desc Retourne une InfoLivraisonViewVO remplie
	*/
	private static function remplir($pcomId, $pProIdProducteur, $pProId, $pProUniteMesure, $pNproNom, $pOpeMontant, $pStoQuantite, $pPrdtNom, $pPrdtPrenom, $pOpeMontantLivraison, $pStoQuantiteLivraison) {
		$lInfoLivraison = new InfoLivraisonViewVO();
		$lInfoLivraison->setcomId($pcomId);
		$lInfoLivraison->setProIdProducteur($pProIdProducteur);
		$lInfoLivraison->setProId($pProId);
		$lInfoLivraison->setProUniteMesure($pProUniteMesure);
		$lInfoLivraison->setNproNom($pNproNom);
		$lInfoLivraison->setOpeMontant($pOpeMontant);
		$lInfoLivraison->setStoQuantite($pStoQuantite);
		$lInfoLivraison->setPrdtNom($pPrdtNom);
		$lInfoLivraison->setPrdtPrenom($pPrdtPrenom);
		$lInfoLivraison->setOpeMontantLivraison($pOpeMontantLivraison);
		$lInfoLivraison->setStoQuantiteLivraison($pStoQuantiteLivraison);
		return $lInfoLivraison;
	}
}
?>