<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitViewManager.php
//
// Description : Classe de gestion des NomProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "NomProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");

define("VUE_NOMPRODUIT", MYSQL_DB_PREFIXE . "view_nom_produit");
/**
 * @name NomProduitViewManager
 * @author Julien PIERRE
 * @since 03/11/2011
 * 
 * @desc Classe permettant l'accès aux données des NomProduit
 */
class NomProduitViewManager
{
	const VUE_NOMPRODUIT = VUE_NOMPRODUIT;

	/**
	* @name select($pId)
	* @param integer
	* @return NomProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une NomProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "
			FROM " . NomProduitViewManager::VUE_NOMPRODUIT . " 
			WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeNomProduit,
					NomProduitViewManager::remplir(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID]));
			}
		} else {
			$lListeNomProduit[0] = new NomProduitViewVO();
		}
		return $lListeNomProduit;
	}

	/**
	* @name selectAll()
	* @return array(NomProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de NomProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "
			FROM " . NomProduitViewManager::VUE_NOMPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeNomProduit,
					NomProduitViewManager::remplir(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID]));
			}
		} else {
			$lListeNomProduit[0] = new NomProduitViewVO();
		}
		return $lListeNomProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(NomProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de NomProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    NomProduitManager::CHAMP_NOMPRODUIT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(NomProduitViewManager::VUE_NOMPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeNomProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeNomProduit,
						NomProduitViewManager::remplir(
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID]));
				}
			} else {
				$lListeNomProduit[0] = new NomProduitViewVO();
			}

			return $lListeNomProduit;
		}

		$lListeNomProduit[0] = new NomProduitViewVO();
		return $lListeNomProduit;
	}

	/**
	* @name remplir($pNProId, $pNProIdFerme, $pCproNom, $pNproNom, $pNProDescription, $pCproId)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param text
	* @param int(11)
	* @return NomProduitViewVO
	* @desc Retourne une NomProduitViewVO remplie
	*/
	private static function remplir($pNProId, $pNProIdFerme, $pCproNom, $pNproNom, $pNProDescription, $pCproId) {
		$lNomProduit = new NomProduitViewVO();
		$lNomProduit->setNProId($pNProId);
		$lNomProduit->setNProIdFerme($pNProIdFerme);
		$lNomProduit->setCproNom($pCproNom);
		$lNomProduit->setNproNom($pNproNom);
		$lNomProduit->setNProDescription($pNProDescription);
		$lNomProduit->setCproId($pCproId);
		return $lNomProduit;
	}
}
?>