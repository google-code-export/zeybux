<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/10/2011
// Fichier : CategorieProduitActiveViewManager.php
//
// Description : Classe de gestion des CategorieProduitActive
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CategorieProduitActiveViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");

/**
 * @name CategorieProduitActiveViewManager
 * @author Julien PIERRE
 * @since 09/10/2011
 * 
 * @desc Classe permettant l'accès aux données des CategorieProduitActive
 */
class CategorieProduitActiveViewManager
{
	const VUE_CATEGORIEPRODUITACTIVE = "view_categorie_produit_active";

	/**
	* @name select($pId)
	* @param integer
	* @return CategorieProduitActiveViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CategorieProduitActiveViewVO contenant les informations et la renvoie
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
			FROM " . CategorieProduitActiveViewManager::VUE_CATEGORIEPRODUITACTIVE . " 
			WHERE " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCategorieProduitActive = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCategorieProduitActive,
					CategorieProduitActiveViewManager::remplir(
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]));
			}
		} else {
			$lListeCategorieProduitActive[0] = new CategorieProduitActiveViewVO();
		}
		return $lListeCategorieProduitActive;
	}

	/**
	* @name selectAll()
	* @return array(CategorieProduitActiveViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CategorieProduitActiveViewVO
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
			FROM " . CategorieProduitActiveViewManager::VUE_CATEGORIEPRODUITACTIVE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCategorieProduitActive = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCategorieProduitActive,
					CategorieProduitActiveViewManager::remplir(
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]));
			}
		} else {
			$lListeCategorieProduitActive[0] = new CategorieProduitActiveViewVO();
		}
		return $lListeCategorieProduitActive;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CategorieProduitActiveViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CategorieProduitActiveViewVO
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
		$lRequete = DbUtils::prepareRequeteRecherche(CategorieProduitActiveViewManager::VUE_CATEGORIEPRODUITACTIVE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCategorieProduitActive = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCategorieProduitActive,
						CategorieProduitActiveViewManager::remplir(
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]));
				}
			} else {
				$lListeCategorieProduitActive[0] = new CategorieProduitActiveViewVO();
			}

			return $lListeCategorieProduitActive;
		}

		$lListeCategorieProduitActive[0] = new CategorieProduitActiveViewVO();
		return $lListeCategorieProduitActive;
	}

	/**
	* @name remplir($pCproId, $pCproNom, $pCproDescription)
	* @param int(11)
	* @param varchar(50)
	* @param text
	* @return CategorieProduitActiveViewVO
	* @desc Retourne une CategorieProduitActiveViewVO remplie
	*/
	private static function remplir($pCproId, $pCproNom, $pCproDescription) {
		$lCategorieProduitActive = new CategorieProduitActiveViewVO();
		$lCategorieProduitActive->setCproId($pCproId);
		$lCategorieProduitActive->setCproNom($pCproNom);
		$lCategorieProduitActive->setCproDescription($pCproDescription);
		return $lCategorieProduitActive;
	}
}
?>