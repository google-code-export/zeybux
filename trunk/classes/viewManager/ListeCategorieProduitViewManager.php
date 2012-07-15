<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeCategorieProduitViewManager.php
//
// Description : Classe de gestion des ListeCategorieProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeCategorieProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");

define("VUE_LISTECATEGORIEPRODUIT", MYSQL_DB_PREFIXE . "view_liste_categorie_produit");
/**
 * @name ListeCategorieProduitViewManager
 * @author Julien PIERRE
 * @since 01/11/2011
 * 
 * @desc Classe permettant l'accès aux données des ListeCategorieProduit
 */
class ListeCategorieProduitViewManager
{
	const VUE_LISTECATEGORIEPRODUIT = VUE_LISTECATEGORIEPRODUIT;

	/**
	* @name select($pId)
	* @param integer
	* @return ListeCategorieProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeCategorieProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . "
			FROM " . ListeCategorieProduitViewManager::VUE_LISTECATEGORIEPRODUIT . " 
			WHERE " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeCategorieProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeCategorieProduit,
					ListeCategorieProduitViewManager::remplir(
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM]));
			}
		} else {
			$lListeListeCategorieProduit[0] = new ListeCategorieProduitViewVO();
		}
		return $lListeListeCategorieProduit;
	}

	/**
	* @name selectAll()
	* @return array(ListeCategorieProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeCategorieProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . "
			FROM " . ListeCategorieProduitViewManager::VUE_LISTECATEGORIEPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeCategorieProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeCategorieProduit,
					ListeCategorieProduitViewManager::remplir(
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM]));
			}
		} else {
			$lListeListeCategorieProduit[0] = new ListeCategorieProduitViewVO();
		}
		return $lListeListeCategorieProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeCategorieProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeCategorieProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeCategorieProduitViewManager::VUE_LISTECATEGORIEPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeCategorieProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeCategorieProduit,
						ListeCategorieProduitViewManager::remplir(
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM]));
				}
			} else {
				$lListeListeCategorieProduit[0] = new ListeCategorieProduitViewVO();
			}

			return $lListeListeCategorieProduit;
		}

		$lListeListeCategorieProduit[0] = new ListeCategorieProduitViewVO();
		return $lListeListeCategorieProduit;
	}

	/**
	* @name remplir($pCproId, $pCproNom)
	* @param int(11)
	* @param varchar(50)
	* @return ListeCategorieProduitViewVO
	* @desc Retourne une ListeCategorieProduitViewVO remplie
	*/
	private static function remplir($pCproId, $pCproNom) {
		$lListeCategorieProduit = new ListeCategorieProduitViewVO();
		$lListeCategorieProduit->setCproId($pCproId);
		$lListeCategorieProduit->setCproNom($pCproNom);
		return $lListeCategorieProduit;
	}
}
?>