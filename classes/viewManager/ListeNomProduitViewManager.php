<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeNomProduitViewManager.php
//
// Description : Classe de gestion des ListeNomProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeNomProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");

define("VUE_LISTENOMPRODUIT", MYSQL_DB_PREFIXE . "view_liste_nom_produit");
/**
 * @name ListeNomProduitViewManager
 * @author Julien PIERRE
 * @since 01/11/2011
 * 
 * @desc Classe permettant l'accès aux données des ListeNomProduit
 */
class ListeNomProduitViewManager
{
	const VUE_LISTENOMPRODUIT = VUE_LISTENOMPRODUIT;

	/**
	* @name select($pId)
	* @param integer
	* @return ListeNomProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeNomProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "
			FROM " . ListeNomProduitViewManager::VUE_LISTENOMPRODUIT . " 
			WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeNomProduit,
					ListeNomProduitViewManager::remplir(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID]));
			}
		} else {
			$lListeListeNomProduit[0] = new ListeNomProduitViewVO();
		}
		return $lListeListeNomProduit;
	}

	/**
	* @name selectAll()
	* @return array(ListeNomProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeNomProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "
			FROM " . ListeNomProduitViewManager::VUE_LISTENOMPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeNomProduit,
					ListeNomProduitViewManager::remplir(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID]));
			}
		} else {
			$lListeListeNomProduit[0] = new ListeNomProduitViewVO();
		}
		return $lListeListeNomProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeNomProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeNomProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeNomProduitViewManager::VUE_LISTENOMPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeNomProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeNomProduit,
						ListeNomProduitViewManager::remplir(
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID]));
				}
			} else {
				$lListeListeNomProduit[0] = new ListeNomProduitViewVO();
			}

			return $lListeListeNomProduit;
		}

		$lListeListeNomProduit[0] = new ListeNomProduitViewVO();
		return $lListeListeNomProduit;
	}

	/**
	* @name remplir($pNproIdFerme, $pNproId, $pNproNom, $pCproNom, $pCproId)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param int(11)
	* @return ListeNomProduitViewVO
	* @desc Retourne une ListeNomProduitViewVO remplie
	*/
	private static function remplir($pNproIdFerme, $pNproId, $pNproNom, $pCproNom, $pCproId) {
		$lListeNomProduit = new ListeNomProduitViewVO();
		$lListeNomProduit->setNproIdFerme($pNproIdFerme);
		$lListeNomProduit->setNproId($pNproId);
		$lListeNomProduit->setNproNom($pNproNom);
		$lListeNomProduit->setCproNom($pCproNom);
		$lListeNomProduit->setCproId($pCproId);
		return $lListeNomProduit;
	}
}
?>