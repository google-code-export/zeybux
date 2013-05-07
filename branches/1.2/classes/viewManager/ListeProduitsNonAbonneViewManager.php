<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : ListeProduitsNonAbonneViewManager.php
//
// Description : Classe de gestion des ListeProduitsNonAbonne
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeProduitsNonAbonneViewVO.php");

include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteAbonnementManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailProduitAbonnementViewManager.php");

/**
 * @name ListeProduitsNonAbonneViewManager
 * @author Julien PIERRE
 * @since 15/02/2012
 * 
 * @desc Classe permettant l'accès aux données des ListeProduitsNonAbonne
 */
class ListeProduitsNonAbonneViewManager
{
	/**
	* @name select($pId,$pIdFerme)
	* @param integer
	* @param integer
	* @return ListeProduitsNonAbonneViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeProduitsNonAbonneViewVO contenant les informations et la renvoie
	*/
	public static function select($pId,$pIdFerme) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT 
			PRODUIT." . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . FermeManager::CHAMP_FERME_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			", NOM." . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . FermeManager::CHAMP_FERME_NOM . "
			FROM " . ProduitAbonnementManager::TABLE_PRODUITABONNEMENT . " PRODUIT
			JOIN " . NomProduitManager::TABLE_NOMPRODUIT . " NOM ON " . NomProduitManager::CHAMP_NOMPRODUIT_ID . "=" . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . "
			JOIN " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . " ON " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "=" . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . "
			JOIN " . FermeManager::TABLE_FERME . " ON " . FermeManager::CHAMP_FERME_ID . "=" . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . "
			JOIN  " . DetailProduitAbonnementViewManager::VUE_DETAILPRODUITABONNEMENT . " DETAIL ON DETAIL." . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . " = PRODUIT." . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . "
			WHERE PRODUIT." . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . " NOT IN (
				SELECT " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . "
				FROM " . CompteAbonnementManager::TABLE_COMPTEABONNEMENT . "
				WHERE " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . " = '" . StringUtils::securiser($pId) . "'
				AND " . FermeManager::CHAMP_FERME_ID . " = '" . StringUtils::securiser($pIdFerme) . "'
				AND " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT . " = 0
			)
			AND " . FermeManager::CHAMP_FERME_ID . " = '" . StringUtils::securiser($pIdFerme) . "'
			AND " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT . " = 0 
			AND " . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . " = 0
			AND (
					(DETAIL." . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . " - DETAIL." . DetailProduitAbonnementViewManager::CHAMP_PRODUITABONNEMENT_RESERVATION . ") > 0
				OR	
					(DETAIL." . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . " - DETAIL." . DetailProduitAbonnementViewManager::CHAMP_PRODUITABONNEMENT_RESERVATION . ") IS NULL					
				)";			    

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProduitsNonAbonne = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProduitsNonAbonne,
					ListeProduitsNonAbonneViewManager::remplir(
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[FermeManager::CHAMP_FERME_NOM]));
			}
		} else {
			$lListeListeProduitsNonAbonne[0] = new ListeProduitsNonAbonneViewVO();
		}
		return $lListeListeProduitsNonAbonne;
	}

	/**
	* @name selectAll()
	* @return array(ListeProduitsNonAbonneViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeProduitsNonAbonneViewVO
	*/
	/*public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . "
			FROM " . ListeProduitsNonAbonneViewManager::VUE_LISTEPRODUITSNONABONNE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProduitsNonAbonne = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProduitsNonAbonne,
					ListeProduitsNonAbonneViewManager::remplir(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM]));
			}
		} else {
			$lListeListeProduitsNonAbonne[0] = new ListeProduitsNonAbonneViewVO();
		}
		return $lListeListeProduitsNonAbonne;
	}*/

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeProduitsNonAbonneViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeProduitsNonAbonneViewVO
	*/
	/*public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeProduitsNonAbonneViewManager::VUE_LISTEPRODUITSNONABONNE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeProduitsNonAbonne = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeProduitsNonAbonne,
						ListeProduitsNonAbonneViewManager::remplir(
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM]));
				}
			} else {
				$lListeListeProduitsNonAbonne[0] = new ListeProduitsNonAbonneViewVO();
			}

			return $lListeListeProduitsNonAbonne;
		}

		$lListeListeProduitsNonAbonne[0] = new ListeProduitsNonAbonneViewVO();
		return $lListeListeProduitsNonAbonne;
	}*/

	/**
	* @name remplir($pProAboId, $pFerId, $pCproId, $pNproId,  $pNproNom, $pCproNom, $pFerNom)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param text
	* @return ListeProduitsNonAbonneViewVO
	* @desc Retourne une ListeProduitsNonAbonneViewVO remplie
	*/
	private static function remplir($pProAboId, $pFerId, $pCproId, $pNproId, $pNproNom, $pCproNom, $pFerNom) {
		$lListeProduitsNonAbonne = new ListeProduitsNonAbonneViewVO();
		$lListeProduitsNonAbonne->setProAboId($pProAboId);
		$lListeProduitsNonAbonne->setFerId($pFerId);
		$lListeProduitsNonAbonne->setCproId($pCproId);
		$lListeProduitsNonAbonne->setNproId($pNproId);
		$lListeProduitsNonAbonne->setNproNom($pNproNom);
		$lListeProduitsNonAbonne->setCproNom($pCproNom);
		$lListeProduitsNonAbonne->setFerNom($pFerNom);
		return $lListeProduitsNonAbonne;
	}
}
?>