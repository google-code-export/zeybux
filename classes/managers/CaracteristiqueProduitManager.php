<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CaracteristiqueProduitManager.php
//
// Description : Classe de gestion des CaracteristiqueProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CaracteristiqueProduitVO.php");

define("TABLE_CARACTERISTIQUEPRODUIT", MYSQL_DB_PREFIXE . "carpro_caracteristique_produit");
/**
 * @name CaracteristiqueProduitManager
 * @author Julien PIERRE
 * @since 01/11/2011
 * 
 * @desc Classe permettant l'accès aux données des CaracteristiqueProduit
 */
class CaracteristiqueProduitManager
{
	const TABLE_CARACTERISTIQUEPRODUIT = TABLE_CARACTERISTIQUEPRODUIT;
	const CHAMP_CARACTERISTIQUEPRODUIT_ID = "carpro_id";
	const CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT = "carpro_id_nom_produit";
	const CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE = "carpro_id_caracteristique";
	const CHAMP_CARACTERISTIQUEPRODUIT_ETAT = "carpro_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return CaracteristiqueProduitVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CaracteristiqueProduitVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT . "
			FROM " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT . " 
			WHERE " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CaracteristiqueProduitManager::remplirCaracteristiqueProduit(
				$pId,
				$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT],
				$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE],
				$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT]);
		} else {
			return new CaracteristiqueProduitVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(CaracteristiqueProduitVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CaracteristiqueProduitVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT . "
			FROM " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCaracteristiqueProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCaracteristiqueProduit,
					CaracteristiqueProduitManager::remplirCaracteristiqueProduit(
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT]));
			}
		} else {
			$lListeCaracteristiqueProduit[0] = new CaracteristiqueProduitVO();
		}
		return $lListeCaracteristiqueProduit;
	}
	
	/**
	* @name selectByIdCaracteristique($pId)
	* @param integer
	* @return array(CaracteristiqueProduitVO)
	* @desc Récupères toutes les lignes à l'idCaracteristique en paramètre et les renvoie sous forme d'une collection de CaracteristiqueProduitVO
	*/
	public static function selectByIdCaracteristique($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT . "
			FROM " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT . " 
			WHERE " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCaracteristiqueProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCaracteristiqueProduit,
					CaracteristiqueProduitManager::remplirCaracteristiqueProduit(
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT]));
			}
		} else {
			$lListeCaracteristiqueProduit[0] = new CaracteristiqueProduitVO();
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
	* @return array(CaracteristiqueProduitVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CaracteristiqueProduitVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID .
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT .
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE .
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCaracteristiqueProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCaracteristiqueProduit,
						CaracteristiqueProduitManager::remplirCaracteristiqueProduit(
						$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID],
						$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT],
						$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE],
						$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT]));
				}
			} else {
				$lListeCaracteristiqueProduit[0] = new CaracteristiqueProduitVO();
			}

			return $lListeCaracteristiqueProduit;
		}

		$lListeCaracteristiqueProduit[0] = new CaracteristiqueProduitVO();
		return $lListeCaracteristiqueProduit;
	}

	/**
	* @name remplirCaracteristiqueProduit($pId, $pIdNomProduit, $pIdCaracteristique, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param tinyint(1)
	* @return CaracteristiqueProduitVO
	* @desc Retourne une CaracteristiqueProduitVO remplie
	*/
	private static function remplirCaracteristiqueProduit($pId, $pIdNomProduit, $pIdCaracteristique, $pEtat) {
		$lCaracteristiqueProduit = new CaracteristiqueProduitVO();
		$lCaracteristiqueProduit->setId($pId);
		$lCaracteristiqueProduit->setIdNomProduit($pIdNomProduit);
		$lCaracteristiqueProduit->setIdCaracteristique($pIdCaracteristique);
		$lCaracteristiqueProduit->setEtat($pEtat);
		return $lCaracteristiqueProduit;
	}

	/**
	* @name insert($pVo)
	* @param CaracteristiqueProduitVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CaracteristiqueProduitVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT . "
				(" . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . "
				," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . "
				," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . "
				," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCaracteristique() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}
	
	/**
	* @name insertByArray($pVo)
	* @param array(CaracteristiqueProduitVO)
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la NomProduitProducteurVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insertByArray($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		if(is_array($pVo)) {
			$lRequete =
			"INSERT INTO " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT . "
				(" . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . "
				," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . "
				," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . "
				," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT . ")
			VALUES ";
			$lTaille = count($pVo);
			foreach($pVo as $CaracteristiqueProduit) {
				$lTaille--;
				if($lTaille > 0) {
					$lRequete .= "(NULL
					,'" . StringUtils::securiser( $CaracteristiqueProduit->getIdNomProduit() ) . "'
					,'" . StringUtils::securiser( $CaracteristiqueProduit->getIdCaracteristique() ) . "'
					,'" . StringUtils::securiser( $CaracteristiqueProduit->getEtat() ) . "'),";
				} else {
					$lRequete .= "(NULL
					,'" . StringUtils::securiser( $CaracteristiqueProduit->getIdNomProduit() ) . "'
					,'" . StringUtils::securiser( $CaracteristiqueProduit->getIdCaracteristique() ) . "'
					,'" . StringUtils::securiser( $CaracteristiqueProduit->getEtat() ) . "');";
				}
			}

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			return Dbutils::executerRequete($lRequete);
		}
	}

	/**
	* @name update($pVo)
	* @param CaracteristiqueProduitVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CaracteristiqueProduitVO, avec les informations du CaracteristiqueProduitVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT . "
			 SET
				 " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . " = '" . StringUtils::securiser( $pVo->getIdCaracteristique() ) . "'
				," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
	
	/**
	* @name deleteByIdNomProduit($pId)
	* @param integer
	* @desc Met à jour les lignes de la table, correspondant à l'idNomProduit pour passage à état 1 : supprimé
	*/
	public static function deleteByIdNomProduit($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT . "
			 SET " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT . " = '1'
			 WHERE " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pId ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

	/**
	* @name deleteByArray($pIds)
	* @param array(integer)
	* @desc Met à jour la ligne de la table correspondant à l'id à l'état 1
	*/
	public static function deleteByArray($pIds) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		if(is_array($pIds)) {
			$lRequete = 
				"UPDATE " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT . "
				 SET " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ETAT . " = '1'
				 WHERE " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . " in (";
			
			$lTaille = count($pIds);
			foreach($pIds as $lId) {
				$lTaille--;
				if($lTaille > 0) {
				 	$lRequete .= "'" . StringUtils::securiser( $lId ) . "',";
				} else {			
				 	$lRequete .= "'" . StringUtils::securiser( $lId ) . "'";
				}
			}
			$lRequete .= ");";
	
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			Dbutils::executerRequete($lRequete);
		}
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

		$lRequete = "DELETE FROM " . CaracteristiqueProduitManager::TABLE_CARACTERISTIQUEPRODUIT . "
			WHERE " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>