<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/02/2012
// Fichier : ListeProduitsAbonneViewManager.php
//
// Description : Classe de gestion des ListeProduitsAbonne
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeProduitsAbonneViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");

define("VUE_LISTEPRODUITSABONNE", MYSQL_DB_PREFIXE . "view_liste_produits_abonne");
/**
 * @name ListeProduitsAbonneViewManager
 * @author Julien PIERRE
 * @since 14/02/2012
 * 
 * @desc Classe permettant l'accès aux données des ListeProduitsAbonne
 */
class ListeProduitsAbonneViewManager
{
	const VUE_LISTEPRODUITSABONNE = VUE_LISTEPRODUITSABONNE;

	/**
	* @name select($pId)
	* @param integer
	* @return ListeProduitsAbonneViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeProduitsAbonneViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . "
			FROM " . ListeProduitsAbonneViewManager::VUE_LISTEPRODUITSABONNE . " 
			WHERE " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProduitsAbonne = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProduitsAbonne,
					ListeProduitsAbonneViewManager::remplir(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
			}
		} else {
			$lListeListeProduitsAbonne[0] = new ListeProduitsAbonneViewVO();
		}
		return $lListeListeProduitsAbonne;
	}

	/**
	* @name selectAll()
	* @return array(ListeProduitsAbonneViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeProduitsAbonneViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . "
			FROM " . ListeProduitsAbonneViewManager::VUE_LISTEPRODUITSABONNE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProduitsAbonne = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProduitsAbonne,
					ListeProduitsAbonneViewManager::remplir(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
			}
		} else {
			$lListeListeProduitsAbonne[0] = new ListeProduitsAbonneViewVO();
		}
		return $lListeListeProduitsAbonne;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeProduitsAbonneViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeProduitsAbonneViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM	.
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION  	);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeProduitsAbonneViewManager::VUE_LISTEPRODUITSABONNE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeProduitsAbonne = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeProduitsAbonne,
						ListeProduitsAbonneViewManager::remplir(
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID],
						$lLigne[FermeManager::CHAMP_FERME_NOM],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
				}
			} else {
				$lListeListeProduitsAbonne[0] = new ListeProduitsAbonneViewVO();
			}

			return $lListeListeProduitsAbonne;
		}

		$lListeListeProduitsAbonne[0] = new ListeProduitsAbonneViewVO();
		return $lListeListeProduitsAbonne;
	}

	/**
	* @name remplir($pCptAboIdCompte, $pCptAboIdProduitAbonnement, $pCptAboId, $pFerNom, $pNproNom, $pCproNom, $pCptAboQuantite, $pProAboUnite, $pCptAboDateDebutSuspension, $pCptAboDateFinSuspension)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param text
	* @param varchar(50)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param varchar(20)
	* @param dateTime
	* @param dateTime
	* @return ListeProduitsAbonneViewVO
	* @desc Retourne une ListeProduitsAbonneViewVO remplie
	*/
	private static function remplir($pCptAboIdCompte, $pCptAboIdProduitAbonnement, $pCptAboId, $pFerNom, $pNproNom, $pCproNom, $pCptAboQuantite, $pProAboUnite, $pCptAboDateDebutSuspension, $pCptAboDateFinSuspension) {
		$lListeProduitsAbonne = new ListeProduitsAbonneViewVO();
		$lListeProduitsAbonne->setCptAboIdCompte($pCptAboIdCompte);
		$lListeProduitsAbonne->setCptAboIdProduitAbonnement($pCptAboIdProduitAbonnement);
		$lListeProduitsAbonne->setCptAboId($pCptAboId);
		$lListeProduitsAbonne->setFerNom($pFerNom);
		$lListeProduitsAbonne->setNproNom($pNproNom);
		$lListeProduitsAbonne->setCproNom($pCproNom);
		$lListeProduitsAbonne->setCptAboQuantite($pCptAboQuantite);
		$lListeProduitsAbonne->setProAboUnite($pProAboUnite);
		$lListeProduitsAbonne->setCptAboDateDebutSuspension($pCptAboDateDebutSuspension);
		$lListeProduitsAbonne->setCptAboDateFinSuspension($pCptAboDateFinSuspension);
		return $lListeProduitsAbonne;
	}
}
?>