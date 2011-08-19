<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : OperationBonLivraisonViewManager.php
//
// Description : Classe de gestion des OperationBonLivraison
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "OperationBonLivraisonViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

/**
 * @name OperationBonLivraisonViewManager
 * @author Julien PIERRE
 * @since 25/01/2011
 * 
 * @desc Classe permettant l'accès aux données des OperationBonLivraison
 */
class OperationBonLivraisonViewManager
{
	const VUE_OPERATIONBONLIVRAISON = "view_operation_bon_livraison";

	/**
	* @name select($pId)
	* @param integer
	* @return OperationBonLivraisonViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationBonLivraisonViewVO contenant les informations et la renvoie
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
			"," . OperationManager::CHAMP_OPERATION_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . "
			FROM " . OperationBonLivraisonViewManager::VUE_OPERATIONBONLIVRAISON . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationBonLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationBonLivraison,
					OperationBonLivraisonViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT]));
			}
		} else {
			$lListeOperationBonLivraison[0] = new OperationBonLivraisonViewVO();
		}
		return $lListeOperationBonLivraison;
	}

	/**
	* @name selectAll()
	* @return array(OperationBonLivraisonViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationBonLivraisonViewVO
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
			"," . OperationManager::CHAMP_OPERATION_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . "
			FROM " . OperationBonLivraisonViewManager::VUE_OPERATIONBONLIVRAISON;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationBonLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationBonLivraison,
					OperationBonLivraisonViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT]));
			}
		} else {
			$lListeOperationBonLivraison[0] = new OperationBonLivraisonViewVO();
		}
		return $lListeOperationBonLivraison;
	}
	
	/**
	* @name selectInfoBonLivraisonProduit($pIdCommande,$pIdProducteur,$pIdProduit))
	* @param integer
	* @return array(OperationBonLivraisonViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCommande $pIdCommande, IdProducteur $pIdProducteur et IdProduit $pIdProduit. Puis les renvoie sous forme d'une collection de OperationBonLivraisonViewVO
	*/
	public static function selectInfoBonLivraisonProduit($pIdCommande,$pIdProducteur,$pIdProduit) {
		return OperationBonLivraisonViewManager::recherche(
			array(CommandeManager::CHAMP_COMMANDE_ID,ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR,ProduitManager::CHAMP_PRODUIT_ID),
			array('=','=','='),
			array($pIdCommande,$pIdProducteur,$pIdProduit),
			array(CommandeManager::CHAMP_COMMANDE_ID),
			array('ASC'));
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(OperationBonLivraisonViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationBonLivraisonViewVO
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
			"," . OperationManager::CHAMP_OPERATION_ID .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . OperationManager::CHAMP_OPERATION_MONTANT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(OperationBonLivraisonViewManager::VUE_OPERATIONBONLIVRAISON, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeOperationBonLivraison = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeOperationBonLivraison,
						OperationBonLivraisonViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[OperationManager::CHAMP_OPERATION_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT]));
				}
			} else {
				$lListeOperationBonLivraison[0] = new OperationBonLivraisonViewVO();
			}

			return $lListeOperationBonLivraison;
		}

		$lListeOperationBonLivraison[0] = new OperationBonLivraisonViewVO();
		return $lListeOperationBonLivraison;
	}

	/**
	* @name remplir($pComId, $pProIdProducteur, $pProId, $pOpeId, $pProUniteMesure, $pNproNom, $pOpeMontant)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param decimal(10,2)
	* @return OperationBonLivraisonViewVO
	* @desc Retourne une OperationBonLivraisonViewVO remplie
	*/
	private static function remplir($pComId, $pProIdProducteur, $pProId, $pOpeId, $pProUniteMesure, $pNproNom, $pOpeMontant) {
		$lOperationBonLivraison = new OperationBonLivraisonViewVO();
		$lOperationBonLivraison->setComId($pComId);
		$lOperationBonLivraison->setProIdProducteur($pProIdProducteur);
		$lOperationBonLivraison->setProId($pProId);
		$lOperationBonLivraison->setOpeId($pOpeId);
		$lOperationBonLivraison->setProUniteMesure($pProUniteMesure);
		$lOperationBonLivraison->setNproNom($pNproNom);
		$lOperationBonLivraison->setOpeMontant($pOpeMontant);
		return $lOperationBonLivraison;
	}
}
?>