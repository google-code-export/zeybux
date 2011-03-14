<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/01/2011
// Fichier : InfoBonCommandeViewManager.php
//
// Description : Classe de gestion des InfoBonCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "InfoBonCommandeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");

/**
 * @name InfoBonCommandeViewManager
 * @author Julien PIERRE
 * @since 15/01/2011
 * 
 * @desc Classe permettant l'accès aux données des InfoBonCommande
 */
class InfoBonCommandeViewManager
{
	const VUE_INFOBONCOMMANDE = "view_info_bon_commande";

	/**
	* @name select($pId)
	* @param integer
	* @return InfoBonCommandeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une InfoBonCommandeViewVO contenant les informations et la renvoie
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
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
			FROM " . InfoBonCommandeViewManager::VUE_INFOBONCOMMANDE . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoBonCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoBonCommande,
					InfoBonCommandeViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeInfoBonCommande[0] = new InfoBonCommandeViewVO();
		}
		return $lListeInfoBonCommande;
	}

	/**
	* @name selectAll()
	* @return array(InfoBonCommandeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de InfoBonCommandeViewVO
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
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
			FROM " . InfoBonCommandeViewManager::VUE_INFOBONCOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoBonCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoBonCommande,
					InfoBonCommandeViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeInfoBonCommande[0] = new InfoBonCommandeViewVO();
		}
		return $lListeInfoBonCommande;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(InfoBonCommandeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de InfoBonCommandeViewVO
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
			"," . StockManager::CHAMP_STOCK_QUANTITE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(InfoBonCommandeViewManager::VUE_INFOBONCOMMANDE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeInfoBonCommande = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeInfoBonCommande,
						InfoBonCommandeViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
				}
			} else {
				$lListeInfoBonCommande[0] = new InfoBonCommandeViewVO();
			}

			return $lListeInfoBonCommande;
		}

		$lListeInfoBonCommande[0] = new InfoBonCommandeViewVO();
		return $lListeInfoBonCommande;
	}

	/**
	* @name remplirInfoBonCommande($pComId, $pProIdProducteur, $pProId, $pProUniteMesure, $pNproNom, $pOpeMontant, $pStoQuantite)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param decimal(33,2)
	* @return InfoBonCommandeViewVO
	* @desc Retourne une InfoBonCommandeViewVO remplie
	*/
	private static function remplir($pComId, $pProIdProducteur, $pProId, $pProUniteMesure, $pNproNom, $pOpeMontant, $pStoQuantite) {
		$lInfoBonCommande = new InfoBonCommandeViewVO();
		$lInfoBonCommande->setComId($pComId);
		$lInfoBonCommande->setProIdProducteur($pProIdProducteur);
		$lInfoBonCommande->setProId($pProId);
		$lInfoBonCommande->setProUniteMesure($pProUniteMesure);
		$lInfoBonCommande->setNproNom($pNproNom);
		$lInfoBonCommande->setOpeMontant($pOpeMontant);
		$lInfoBonCommande->setStoQuantite($pStoQuantite);
		return $lInfoBonCommande;
	}
}
?>