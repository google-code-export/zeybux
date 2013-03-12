<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeCaracteristiqueViewManager.php
//
// Description : Classe de gestion des ListeCaracteristique
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeCaracteristiqueViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueManager.php");

/**
 * @name ListeCaracteristiqueViewManager
 * @author Julien PIERRE
 * @since 01/11/2011
 * 
 * @desc Classe permettant l'accès aux données des ListeCaracteristique
 */
class ListeCaracteristiqueViewManager
{
	const VUE_LISTECARACTERISTIQUE = "view_liste_caracteristique";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeCaracteristiqueViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeCaracteristiqueViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . "
			FROM " . ListeCaracteristiqueViewManager::VUE_LISTECARACTERISTIQUE . " 
			WHERE " . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeCaracteristique = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeCaracteristique,
					ListeCaracteristiqueViewManager::remplir(
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM]));
			}
		} else {
			$lListeListeCaracteristique[0] = new ListeCaracteristiqueViewVO();
		}
		return $lListeListeCaracteristique;
	}

	/**
	* @name selectAll()
	* @return array(ListeCaracteristiqueViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeCaracteristiqueViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . "
			FROM " . ListeCaracteristiqueViewManager::VUE_LISTECARACTERISTIQUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeCaracteristique = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeCaracteristique,
					ListeCaracteristiqueViewManager::remplir(
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM]));
			}
		} else {
			$lListeListeCaracteristique[0] = new ListeCaracteristiqueViewVO();
		}
		return $lListeListeCaracteristique;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeCaracteristiqueViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeCaracteristiqueViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeCaracteristiqueViewManager::VUE_LISTECARACTERISTIQUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeCaracteristique = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeCaracteristique,
						ListeCaracteristiqueViewManager::remplir(
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM]));
				}
			} else {
				$lListeListeCaracteristique[0] = new ListeCaracteristiqueViewVO();
			}

			return $lListeListeCaracteristique;
		}

		$lListeListeCaracteristique[0] = new ListeCaracteristiqueViewVO();
		return $lListeListeCaracteristique;
	}

	/**
	* @name remplir($pCarId, $pCarNom)
	* @param int(11)
	* @param varchar(50)
	* @return ListeCaracteristiqueViewVO
	* @desc Retourne une ListeCaracteristiqueViewVO remplie
	*/
	private static function remplir($pCarId, $pCarNom) {
		$lListeCaracteristique = new ListeCaracteristiqueViewVO();
		$lListeCaracteristique->setCarId($pCarId);
		$lListeCaracteristique->setCarNom($pCarNom);
		return $lListeCaracteristique;
	}
}
?>