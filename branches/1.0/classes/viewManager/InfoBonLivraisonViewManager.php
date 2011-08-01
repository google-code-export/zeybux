<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoBonLivraisonViewManager.php
//
// Description : Classe de gestion des InfoBonLivraison
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "InfoBonLivraisonViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");

/**
 * @name InfoBonLivraisonViewManager
 * @author Julien PIERRE
 * @since 24/01/2011
 * 
 * @desc Classe permettant l'accès aux données des InfoBonLivraison
 */
class InfoBonLivraisonViewManager
{
	const VUE_INFOBONLIVRAISON = "view_info_bon_livraison";
	const CHAMP_INFO_LIVRAISON_OPERATION_MONTANT = "ope_montant_livraison";
	const CHAMP_INFO_LIVRAISON_STOCK_QUANTITE = "sto_quantite_livraison";
	const CHAMP_INFO_LIVRAISON_STOCK_QUANTITE_SOLIDAIRE = "sto_quantite_solidaire";

	/**
	* @name select($pId)
	* @param integer
	* @return InfoBonLivraisonViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une InfoBonLivraisonViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_PRODUCTEUR . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID .
			"," . StockManager::CHAMP_STOCK_ID . "
			FROM " . InfoBonLivraisonViewManager::VUE_INFOBONLIVRAISON . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoBonLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoBonLivraison,
					InfoBonLivraisonViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID]));
			}
		} else {
			$lListeInfoBonLivraison[0] = new InfoBonLivraisonViewVO();
		}
		return $lListeInfoBonLivraison;
	}

	/**
	* @name selectAll()
	* @return array(InfoBonLivraisonViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de InfoBonLivraisonViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_PRODUCTEUR . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID .
			"," . StockManager::CHAMP_STOCK_ID . "
			FROM " . InfoBonLivraisonViewManager::VUE_INFOBONLIVRAISON;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoBonLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoBonLivraison,
					InfoBonLivraisonViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID]));
			}
		} else {
			$lListeInfoBonLivraison[0] = new InfoBonLivraisonViewVO();
		}
		return $lListeInfoBonLivraison;
	}
	
	/**
	* @name selectByIdCommande($pIdCommande)
	* @param integer
	* @return array(InfoBonLivraisonViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCommande $pIdCommande . Puis les renvoie sous forme d'une collection de InfoBonLivraisonViewVO
	*/
	public static function selectByIdCommande($pIdCommande) {
		return InfoBonLivraisonViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE),
			array('='),
			array($pIdCommande),
			array(''),
			array(''));
	}
	
	/**
	* @name selectInfoBonLivraison($pIdCommande, $pIdCompteProducteur)
	* @param integer
	* @param integer
	* @return array(InfoBonLivraisonViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCommande $pIdCommande et IdProducteur $pIdProducteur . Puis les renvoie sous forme d'une collection de InfoBonLivraisonViewVO
	*/
	public static function selectInfoBonLivraison($pIdCommande, $pIdCompteProducteur) {
		return InfoBonLivraisonViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE,ProduitManager::CHAMP_PRODUIT_ID_COMPTE_PRODUCTEUR),
			array('=','='),
			array($pIdCommande, $pIdCompteProducteur),
			array(''),
			array(''));
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(InfoBonLivraisonViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de InfoBonLivraisonViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_PRODUCTEUR .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID .
			"," . StockManager::CHAMP_STOCK_ID);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(InfoBonLivraisonViewManager::VUE_INFOBONLIVRAISON, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeInfoBonLivraison = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeInfoBonLivraison,
						InfoBonLivraisonViewManager::remplir(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_PRODUCTEUR],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID]));
				}
			} else {
				$lListeInfoBonLivraison[0] = new InfoBonLivraisonViewVO();
			}

			return $lListeInfoBonLivraison;
		}

		$lListeInfoBonLivraison[0] = new InfoBonLivraisonViewVO();
		return $lListeInfoBonLivraison;
	}

	/**
	* @name remplir($pProIdCommande, $pProIdCompteProducteur, $pProId, $pProUniteMesure, $pNproNom, $pDopeMontant, $pStoQuantite, $pPrdtNom, $pPrdtPrenom, $pDopeId, $pStoId)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param decimal(33,2)
	* @param varchar(50)
	* @param varchar(50)
	* @param int(11)
	* @param int(11)
	* @return InfoLivraisonViewVO
	* @desc Retourne une InfoBonLivraisonViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdCompteProducteur, $pProId, $pProUniteMesure, $pNproNom, $pDopeMontant, $pStoQuantite, $pPrdtNom, $pPrdtPrenom, $pDopeId, $pStoId) {
		$lInfoBonLivraison = new InfoBonLivraisonViewVO();
		$lInfoBonLivraison->setProIdCommande($pProIdCommande);
		$lInfoBonLivraison->setProIdCompteProducteur($pProIdCompteProducteur);
		$lInfoBonLivraison->setProId($pProId);
		$lInfoBonLivraison->setProUniteMesure($pProUniteMesure);
		$lInfoBonLivraison->setNproNom($pNproNom);
		$lInfoBonLivraison->setDopeMontant($pDopeMontant);
		$lInfoBonLivraison->setStoQuantite($pStoQuantite);
		$lInfoBonLivraison->setPrdtNom($pPrdtNom);
		$lInfoBonLivraison->setPrdtPrenom($pPrdtPrenom);
		$lInfoBonLivraison->setDopeId($pDopeId);
		$lInfoBonLivraison->setStoId($pStoId);
		return $lInfoBonLivraison;
	}
}
?>