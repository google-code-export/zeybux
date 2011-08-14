<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/05/2010
// Fichier : CategorieProduitManager.php
//
// Description : Classe de gestion des CategorieProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CategorieProduitVO.php");

/**
 * @name CategorieProduit
 * @author Julien PIERRE
 * @since 06/05/2010
 * 
 * @desc Classe permettant l'accès aux données des CategorieProduit
 */
class CategorieProduitManager
{
	const TABLE_CATEGORIEPRODUIT = "cpro_categorie_produit";
	const CHAMP_CATEGORIEPRODUIT_ID = "cpro_id";
	const CHAMP_CATEGORIEPRODUIT_NOM = "cpro_nom";
	const CHAMP_CATEGORIEPRODUIT_DESCRIPTION = "cpro_description";

	/**
	* @name select($pId)
	* @param integer
	* @return CategorieProduitVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CategorieProduitVO contenant les informations et la renvoie
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
			FROM " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . " 
			WHERE " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CategorieProduitManager::remplirCategorieProduit(
				$pId,
				$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
				$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]);
		} else {
			return new CategorieProduitVO();
		}
	}

	/**
	* @name selectAll
	* @return array(CategorieProduitVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CategorieProduitVO
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
			FROM " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCategorieProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCategorieProduit,
					CategorieProduitManager::remplirCategorieProduit(
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]));
			}
		} else {
			$lListeCategorieProduit[0] = new CategorieProduitVO();
		}
		return $lListeCategorieProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CategorieProduitVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CategorieProduitVO
	*/
	public static function recherche( $pTypeRecherche, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION		);
		
		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CategorieProduitManager::TABLE_CATEGORIEPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCategorieProduit = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
			
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeCategorieProduit,
						CategorieProduitManager::remplirCategorieProduit(
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]));
				}
			} else {
				$lListeCategorieProduit[0] = new CategorieProduitVO();
			}
	
			return $lListeCategorieProduit;
		}
		
		$lListeCategorieProduit[0] = new CategorieProduitVO();
		return $lListeCategorieProduit;
	}

	/**
	* @name remplirCategorieProduit($pId, $pNom, $pDescription)
	* @param int(11)
	* @param varchar(50)
	* @param text
	* @return CategorieProduitVO
	* @desc Retourne une CategorieProduitVO remplie
	*/
	private static function remplirCategorieProduit($pId, $pNom, $pDescription) {
		$lCategorieProduit = new CategorieProduitVO();
		$lCategorieProduit->setId($pId);
		$lCategorieProduit->setNom($pNom);
		$lCategorieProduit->setDescription($pDescription);
		return $lCategorieProduit;
	}

	/**
	* @name insert($pVo)
	* @param CategorieProduitVO
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CategorieProduitVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . "
				(" . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "
				," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . "
				," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getId() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getDescription() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

	/**
	* @name update($pVo)
	* @param CategorieProduitVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CategorieProduitVO, avec les informations du CategorieProduitVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . "
			 SET
				 " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION . " = '" . StringUtils::securiser( $pVo->getDescription() ) . "')
			 WHERE " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . "
			WHERE " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>