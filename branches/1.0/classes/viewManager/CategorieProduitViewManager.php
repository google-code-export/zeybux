<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CategorieProduitViewManager.php
//
// Description : Classe de gestion des CategorieProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CategorieProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");

define("VUE_CATEGORIEPRODUIT", MYSQL_DB_PREFIXE . "view_categorie_produit");
/**
 * @name CategorieProduitViewManager
 * @author Julien PIERRE
 * @since 01/11/2011
 * 
 * @desc Classe permettant l'accès aux données des CategorieProduit
 */
class CategorieProduitViewManager
{
	const VUE_CATEGORIEPRODUIT = VUE_CATEGORIEPRODUIT;

	/**
	* @name select($pId)
	* @param integer
	* @return CategorieProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CategorieProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION . "
			FROM " . CategorieProduitViewManager::VUE_CATEGORIEPRODUIT . " 
			WHERE " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCategorieProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCategorieProduit,
					CategorieProduitViewManager::remplir(
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]));
			}
		} else {
			$lListeCategorieProduit[0] = new CategorieProduitViewVO();
		}
		return $lListeCategorieProduit;
	}

	/**
	* @name selectAll()
	* @return array(CategorieProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CategorieProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION . "
			FROM " . CategorieProduitViewManager::VUE_CATEGORIEPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCategorieProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCategorieProduit,
					CategorieProduitViewManager::remplir(
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]));
			}
		} else {
			$lListeCategorieProduit[0] = new CategorieProduitViewVO();
		}
		return $lListeCategorieProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CategorieProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CategorieProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CategorieProduitViewManager::VUE_CATEGORIEPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCategorieProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCategorieProduit,
						CategorieProduitViewManager::remplir(
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]));
				}
			} else {
				$lListeCategorieProduit[0] = new CategorieProduitViewVO();
			}

			return $lListeCategorieProduit;
		}

		$lListeCategorieProduit[0] = new CategorieProduitViewVO();
		return $lListeCategorieProduit;
	}

	/**
	* @name remplir($pCproId, $pCproNom, $pCproDescription)
	* @param int(11)
	* @param varchar(50)
	* @param text
	* @return CategorieProduitViewVO
	* @desc Retourne une CategorieProduitViewVO remplie
	*/
	private static function remplir($pCproId, $pCproNom, $pCproDescription) {
		$lCategorieProduit = new CategorieProduitViewVO();
		$lCategorieProduit->setCproId($pCproId);
		$lCategorieProduit->setCproNom($pCproNom);
		$lCategorieProduit->setCproDescription($pCproDescription);
		return $lCategorieProduit;
	}
}
?>