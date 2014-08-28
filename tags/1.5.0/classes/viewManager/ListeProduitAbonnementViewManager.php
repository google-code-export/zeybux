<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : ListeProduitAbonnementViewManager.php
//
// Description : Classe de gestion des ListeProduitAbonnement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeProduitAbonnementViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

define("VUE_LISTEPRODUITABONNEMENT", MYSQL_DB_PREFIXE . "view_liste_produit_abonnement");
/**
 * @name ListeProduitAbonnementViewManager
 * @author Julien PIERRE
 * @since 11/02/2012
 * 
 * @desc Classe permettant l'accès aux données des ListeProduitAbonnement
 */
class ListeProduitAbonnementViewManager
{
	const VUE_LISTEPRODUITABONNEMENT = VUE_LISTEPRODUITABONNEMENT;

	/**
	* @name select($pId)
	* @param integer
	* @return ListeProduitAbonnementViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeProduitAbonnementViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . "
			FROM " . ListeProduitAbonnementViewManager::VUE_LISTEPRODUITABONNEMENT . " 
			WHERE " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProduitAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProduitAbonnement,
					ListeProduitAbonnementViewManager::remplir(
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]));
			}
		} else {
			$lListeListeProduitAbonnement[0] = new ListeProduitAbonnementViewVO();
		}
		return $lListeListeProduitAbonnement;
	}

	/**
	* @name selectAll()
	* @return array(ListeProduitAbonnementViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeProduitAbonnementViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . "
			FROM " . ListeProduitAbonnementViewManager::VUE_LISTEPRODUITABONNEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProduitAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProduitAbonnement,
					ListeProduitAbonnementViewManager::remplir(
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]));
			}
		} else {
			$lListeListeProduitAbonnement[0] = new ListeProduitAbonnementViewVO();
		}
		return $lListeListeProduitAbonnement;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeProduitAbonnementViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeProduitAbonnementViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID .
			"," . FermeManager::CHAMP_FERME_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeProduitAbonnementViewManager::VUE_LISTEPRODUITABONNEMENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeProduitAbonnement = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeProduitAbonnement,
						ListeProduitAbonnementViewManager::remplir(
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
						$lLigne[FermeManager::CHAMP_FERME_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]));
				}
			} else {
				$lListeListeProduitAbonnement[0] = new ListeProduitAbonnementViewVO();
			}

			return $lListeListeProduitAbonnement;
		}

		$lListeListeProduitAbonnement[0] = new ListeProduitAbonnementViewVO();
		return $lListeListeProduitAbonnement;
	}

	/**
	* @name remplir($pProAboId, $pFerNom, $pCproNom, $pNproNom)
	* @param int(11)
	* @param text
	* @param varchar(50)
	* @param varchar(50)
	* @return ListeProduitAbonnementViewVO
	* @desc Retourne une ListeProduitAbonnementViewVO remplie
	*/
	private static function remplir($pProAboId, $pFerNom, $pCproNom, $pNproNom) {
		$lListeProduitAbonnement = new ListeProduitAbonnementViewVO();
		$lListeProduitAbonnement->setProAboId($pProAboId);
		$lListeProduitAbonnement->setFerNom($pFerNom);
		$lListeProduitAbonnement->setCproNom($pCproNom);
		$lListeProduitAbonnement->setNproNom($pNproNom);
		return $lListeProduitAbonnement;
	}
}
?>