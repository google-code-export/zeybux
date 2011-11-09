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
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");

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
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID .
			"," . StockManager::CHAMP_STOCK_ID . "
			FROM " . InfoBonCommandeViewManager::VUE_INFOBONCOMMANDE . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoBonCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoBonCommande,
					InfoBonCommandeViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID]));
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
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID .
			"," . StockManager::CHAMP_STOCK_ID . "
			FROM " . InfoBonCommandeViewManager::VUE_INFOBONCOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoBonCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoBonCommande,
					InfoBonCommandeViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID]));
			}
		} else {
			$lListeInfoBonCommande[0] = new InfoBonCommandeViewVO();
		}
		return $lListeInfoBonCommande;
	}
	
	/**
	* @name selectByIdCommande($pIdCommande)
	* @param integer
	* @return array(InfoBonCommandeViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCommande $pIdCommande. Puis les renvoies sous forme d'une collection de InfoBonCommandeViewVO
	*/
	public static function selectByIdCommande($pIdCommande) {
		return InfoBonCommandeViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE),
			array('='),
			array($pIdCommande),
			array(FermeManager::CHAMP_FERME_NOM),
			array('ASC'));
	}
	
	/**
	* @name selectInfoBonCommande($pIdCommande, $pIdCompteProducteur)
	* @param integer
	* @param integer
	* @return array(InfoBonCommandeViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCommande $pIdCommande et IdProducteur $pIdProducteur . Puis les renvoie sous forme d'une collection de InfoBonCommandeViewVO
	*/
	public static function selectInfoBonCommande($pIdCommande, $pIdCompteProducteur) {
		return InfoBonCommandeViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE,ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME),
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
	* @return array(InfoBonCommandeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de InfoBonCommandeViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . FermeManager::CHAMP_FERME_NOM .
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_ID .
			"," . StockManager::CHAMP_STOCK_ID);

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
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[FermeManager::CHAMP_FERME_NOM],
						$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID]));
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
	* @name remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pProUniteMesure, $pNproNom, $pDopeMontant, $pStoQuantite, $pFerNom, $pDopeId, $pStoId)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param decimal(33,2)
	* @param varchar(50)
	* @param int(11)
	* @param int(11)
	* @return InfoBonCommandeViewVO
	* @desc Retourne une InfoBonCommandeViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pProUniteMesure, $pNproNom, $pDopeMontant, $pStoQuantite, $pFerNom, $pDopeId, $pStoId) {
		$lInfoBonCommande = new InfoBonCommandeViewVO();
		$lInfoBonCommande->setProIdCommande($pProIdCommande);
		$lInfoBonCommande->setProIdCompteFerme($pProIdCompteFerme);
		$lInfoBonCommande->setProId($pProId);
		$lInfoBonCommande->setProUniteMesure($pProUniteMesure);
		$lInfoBonCommande->setNproNom($pNproNom);
		$lInfoBonCommande->setDopeMontant($pDopeMontant);
		$lInfoBonCommande->setStoQuantite($pStoQuantite);
		$lInfoBonCommande->setFerNom($pFerNom);
		$lInfoBonCommande->setDopeId($pDopeId);
		$lInfoBonCommande->setStoId($pStoId);
		return $lInfoBonCommande;
	}
}
?>