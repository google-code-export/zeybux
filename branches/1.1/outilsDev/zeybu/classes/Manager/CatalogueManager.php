<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/10/2011
// Fichier : CatalogueManager.php
//
// Description : Classe de gestion des Catalogue
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CatalogueVO.php");

/**
 * @name CatalogueManager
 * @author Julien PIERRE
 * @since 22/10/2011
 * 
 * @desc Classe permettant l'accès aux données des Catalogue
 */
class CatalogueManager
{
	const TABLE_CATALOGUE = "cat_catalogue";
	const CHAMP_CATALOGUE_ID = "cat_id";
	const CHAMP_CATALOGUE_ID_NOM_PRODUIT = "cat_id_nom_produit";
	const CHAMP_CATALOGUE_ID_FERME = "cat_id_ferme";
	const CHAMP_CATALOGUE_ETAT = "cat_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return CatalogueVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CatalogueVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CatalogueManager::CHAMP_CATALOGUE_ID . 
			"," . CatalogueManager::CHAMP_CATALOGUE_ID_NOM_PRODUIT . 
			"," . CatalogueManager::CHAMP_CATALOGUE_ID_FERME . 
			"," . CatalogueManager::CHAMP_CATALOGUE_ETAT . "
			FROM " . CatalogueManager::TABLE_CATALOGUE . " 
			WHERE " . CatalogueManager::CHAMP_CATALOGUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CatalogueManager::remplirCatalogue(
				$pId,
				$lLigne[CatalogueManager::CHAMP_CATALOGUE_ID_NOM_PRODUIT],
				$lLigne[CatalogueManager::CHAMP_CATALOGUE_ID_FERME],
				$lLigne[CatalogueManager::CHAMP_CATALOGUE_ETAT]);
		} else {
			return new CatalogueVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(CatalogueVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CatalogueVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CatalogueManager::CHAMP_CATALOGUE_ID . 
			"," . CatalogueManager::CHAMP_CATALOGUE_ID_NOM_PRODUIT . 
			"," . CatalogueManager::CHAMP_CATALOGUE_ID_FERME . 
			"," . CatalogueManager::CHAMP_CATALOGUE_ETAT . "
			FROM " . CatalogueManager::TABLE_CATALOGUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCatalogue = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCatalogue,
					CatalogueManager::remplirCatalogue(
					$lLigne[CatalogueManager::CHAMP_CATALOGUE_ID],
					$lLigne[CatalogueManager::CHAMP_CATALOGUE_ID_NOM_PRODUIT],
					$lLigne[CatalogueManager::CHAMP_CATALOGUE_ID_FERME],
					$lLigne[CatalogueManager::CHAMP_CATALOGUE_ETAT]));
			}
		} else {
			$lListeCatalogue[0] = new CatalogueVO();
		}
		return $lListeCatalogue;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CatalogueVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CatalogueVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CatalogueManager::CHAMP_CATALOGUE_ID .
			"," . CatalogueManager::CHAMP_CATALOGUE_ID_NOM_PRODUIT .
			"," . CatalogueManager::CHAMP_CATALOGUE_ID_FERME .
			"," . CatalogueManager::CHAMP_CATALOGUE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CatalogueManager::TABLE_CATALOGUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCatalogue = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCatalogue,
						CatalogueManager::remplirCatalogue(
						$lLigne[CatalogueManager::CHAMP_CATALOGUE_ID],
						$lLigne[CatalogueManager::CHAMP_CATALOGUE_ID_NOM_PRODUIT],
						$lLigne[CatalogueManager::CHAMP_CATALOGUE_ID_FERME],
						$lLigne[CatalogueManager::CHAMP_CATALOGUE_ETAT]));
				}
			} else {
				$lListeCatalogue[0] = new CatalogueVO();
			}

			return $lListeCatalogue;
		}

		$lListeCatalogue[0] = new CatalogueVO();
		return $lListeCatalogue;
	}

	/**
	* @name remplirCatalogue($pId, $pIdNomProduit, $pIdFerme, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param tinyint(1)
	* @return CatalogueVO
	* @desc Retourne une CatalogueVO remplie
	*/
	private static function remplirCatalogue($pId, $pIdNomProduit, $pIdFerme, $pEtat) {
		$lCatalogue = new CatalogueVO();
		$lCatalogue->setId($pId);
		$lCatalogue->setIdNomProduit($pIdNomProduit);
		$lCatalogue->setIdFerme($pIdFerme);
		$lCatalogue->setEtat($pEtat);
		return $lCatalogue;
	}

	/**
	* @name insert($pVo)
	* @param CatalogueVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CatalogueVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CatalogueManager::TABLE_CATALOGUE . "
				(" . CatalogueManager::CHAMP_CATALOGUE_ID . "
				," . CatalogueManager::CHAMP_CATALOGUE_ID_NOM_PRODUIT . "
				," . CatalogueManager::CHAMP_CATALOGUE_ID_FERME . "
				," . CatalogueManager::CHAMP_CATALOGUE_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdFerme() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param CatalogueVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CatalogueVO, avec les informations du CatalogueVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CatalogueManager::TABLE_CATALOGUE . "
			 SET
				 " . CatalogueManager::CHAMP_CATALOGUE_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . CatalogueManager::CHAMP_CATALOGUE_ID_FERME . " = '" . StringUtils::securiser( $pVo->getIdFerme() ) . "'
				," . CatalogueManager::CHAMP_CATALOGUE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . CatalogueManager::CHAMP_CATALOGUE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

	/**
	* @name delete($pId)
	* @param integer
	* @desc Supprime la ligne de la table correspondant à l'id en paramètre
	*/
	public static function delete($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = "DELETE FROM " . CatalogueManager::TABLE_CATALOGUE . "
			WHERE " . CatalogueManager::CHAMP_CATALOGUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>