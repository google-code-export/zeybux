<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : CaracteristiqueProduitViewManager.php
//
// Description : Classe de gestion des CaracteristiqueProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CaracteristiqueProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueManager.php");

define("VUE_CARACTERISTIQUEPRODUIT", MYSQL_DB_PREFIXE . "view_caracteristique_produit");
/**
 * @name CaracteristiqueProduitViewManager
 * @author Julien PIERRE
 * @since 03/11/2011
 * 
 * @desc Classe permettant l'accès aux données des CaracteristiqueProduit
 */
class CaracteristiqueProduitViewManager
{
	const VUE_CARACTERISTIQUEPRODUIT = VUE_CARACTERISTIQUEPRODUIT;

	/**
	* @name select($pId)
	* @param integer
	* @return CaracteristiqueProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CaracteristiqueProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . "
			FROM " . CaracteristiqueProduitViewManager::VUE_CARACTERISTIQUEPRODUIT . " 
			WHERE " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCaracteristiqueProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCaracteristiqueProduit,
					CaracteristiqueProduitViewManager::remplir(
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID]));
			}
		} else {
			$lListeCaracteristiqueProduit[0] = new CaracteristiqueProduitViewVO();
		}
		return $lListeCaracteristiqueProduit;
	}

	/**
	* @name selectAll()
	* @return array(CaracteristiqueProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CaracteristiqueProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . "
			FROM " . CaracteristiqueProduitViewManager::VUE_CARACTERISTIQUEPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCaracteristiqueProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCaracteristiqueProduit,
					CaracteristiqueProduitViewManager::remplir(
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID]));
			}
		} else {
			$lListeCaracteristiqueProduit[0] = new CaracteristiqueProduitViewVO();
		}
		return $lListeCaracteristiqueProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CaracteristiqueProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CaracteristiqueProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION	. 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID 	);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CaracteristiqueProduitViewManager::VUE_CARACTERISTIQUEPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCaracteristiqueProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCaracteristiqueProduit,
						CaracteristiqueProduitViewManager::remplir(
						$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION],
						$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID]));
				}
			} else {
				$lListeCaracteristiqueProduit[0] = new CaracteristiqueProduitViewVO();
			}

			return $lListeCaracteristiqueProduit;
		}

		$lListeCaracteristiqueProduit[0] = new CaracteristiqueProduitViewVO();
		return $lListeCaracteristiqueProduit;
	}

	/**
	* @name remplir($pCarProIdNomProduit, $pCarId, $pCarNom, $pCarDescription, $pCarProId)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param text
	* @param int(11)
	* @return CaracteristiqueProduitViewVO
	* @desc Retourne une CaracteristiqueProduitViewVO remplie
	*/
	private static function remplir($pCarProIdNomProduit, $pCarId, $pCarNom, $pCarDescription, $pCarProId) {
		$lCaracteristiqueProduit = new CaracteristiqueProduitViewVO();
		$lCaracteristiqueProduit->setCarProIdNomProduit($pCarProIdNomProduit);
		$lCaracteristiqueProduit->setCarId($pCarId);
		$lCaracteristiqueProduit->setCarNom($pCarNom);
		$lCaracteristiqueProduit->setCarDescription($pCarDescription);
		$lCaracteristiqueProduit->setCarProId($pCarProId);
		return $lCaracteristiqueProduit;
	}
}
?>