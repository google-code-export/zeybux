<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CaracteristiqueViewManager.php
//
// Description : Classe de gestion des Caracteristique
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CaracteristiqueViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueManager.php");

/**
 * @name CaracteristiqueViewManager
 * @author Julien PIERRE
 * @since 01/11/2011
 * 
 * @desc Classe permettant l'accès aux données des Caracteristique
 */
class CaracteristiqueViewManager
{
	const VUE_CARACTERISTIQUE = "view_caracteristique";

	/**
	* @name select($pId)
	* @param integer
	* @return CaracteristiqueViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CaracteristiqueViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION . "
			FROM " . CaracteristiqueViewManager::VUE_CARACTERISTIQUE . " 
			WHERE " . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCaracteristique = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCaracteristique,
					CaracteristiqueViewManager::remplir(
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION]));
			}
		} else {
			$lListeCaracteristique[0] = new CaracteristiqueViewVO();
		}
		return $lListeCaracteristique;
	}

	/**
	* @name selectAll()
	* @return array(CaracteristiqueViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CaracteristiqueViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION . "
			FROM " . CaracteristiqueViewManager::VUE_CARACTERISTIQUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCaracteristique = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCaracteristique,
					CaracteristiqueViewManager::remplir(
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION]));
			}
		} else {
			$lListeCaracteristique[0] = new CaracteristiqueViewVO();
		}
		return $lListeCaracteristique;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CaracteristiqueViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CaracteristiqueViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CaracteristiqueViewManager::VUE_CARACTERISTIQUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCaracteristique = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCaracteristique,
						CaracteristiqueViewManager::remplir(
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION]));
				}
			} else {
				$lListeCaracteristique[0] = new CaracteristiqueViewVO();
			}

			return $lListeCaracteristique;
		}

		$lListeCaracteristique[0] = new CaracteristiqueViewVO();
		return $lListeCaracteristique;
	}

	/**
	* @name remplir($pCarId, $pCarNom, $pCarDescription)
	* @param int(11)
	* @param varchar(50)
	* @param text
	* @return CaracteristiqueViewVO
	* @desc Retourne une CaracteristiqueViewVO remplie
	*/
	private static function remplir($pCarId, $pCarNom, $pCarDescription) {
		$lCaracteristique = new CaracteristiqueViewVO();
		$lCaracteristique->setCarId($pCarId);
		$lCaracteristique->setCarNom($pCarNom);
		$lCaracteristique->setCarDescription($pCarDescription);
		return $lCaracteristique;
	}
}
?>