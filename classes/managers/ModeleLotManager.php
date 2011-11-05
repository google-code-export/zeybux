<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/11/2011
// Fichier : ModeleLotManager.php
//
// Description : Classe de gestion des ModeleLot
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ModeleLotVO.php");

/**
 * @name ModeleLotManager
 * @author Julien PIERRE
 * @since 02/11/2011
 * 
 * @desc Classe permettant l'accès aux données des ModeleLot
 */
class ModeleLotManager
{
	const TABLE_MODELELOT = "mlot_modele_lot";
	const CHAMP_MODELELOT_ID = "mlot_id";
	const CHAMP_MODELELOT_ID_NOM_PRODUIT = "mlot_id_nom_produit";
	const CHAMP_MODELELOT_QUANTITE = "mlot_quantite";
	const CHAMP_MODELELOT_UNITE = "mlot_unite";
	const CHAMP_MODELELOT_PRIX = "mlot_prix";
	const CHAMP_MODELELOT_ETAT = "mlot_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return ModeleLotVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ModeleLotVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ModeleLotManager::CHAMP_MODELELOT_ID . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . 
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ETAT . "
			FROM " . ModeleLotManager::TABLE_MODELELOT . " 
			WHERE " . ModeleLotManager::CHAMP_MODELELOT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ModeleLotManager::remplirModeleLot(
				$pId,
				$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT],
				$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
				$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
				$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX],
				$lLigne[ModeleLotManager::CHAMP_MODELELOT_ETAT]);
		} else {
			return new ModeleLotVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ModeleLotVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ModeleLotVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ModeleLotManager::CHAMP_MODELELOT_ID . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . 
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ETAT . "
			FROM " . ModeleLotManager::TABLE_MODELELOT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeModeleLot = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeModeleLot,
					ModeleLotManager::remplirModeleLot(
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ETAT]));
			}
		} else {
			$lListeModeleLot[0] = new ModeleLotVO();
		}
		return $lListeModeleLot;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ModeleLotVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ModeleLotVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ModeleLotManager::CHAMP_MODELELOT_ID .
			"," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT .
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE .
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE .
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX .
			"," . ModeleLotManager::CHAMP_MODELELOT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ModeleLotManager::TABLE_MODELELOT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeModeleLot = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeModeleLot,
						ModeleLotManager::remplirModeleLot(
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_ETAT]));
				}
			} else {
				$lListeModeleLot[0] = new ModeleLotVO();
			}

			return $lListeModeleLot;
		}

		$lListeModeleLot[0] = new ModeleLotVO();
		return $lListeModeleLot;
	}

	/**
	* @name remplirModeleLot($pId, $pIdNomProduit, $pQuantite, $pUnite, $pPrix, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(20)
	* @param decimal(10,2)
	* @param tinyint(1)
	* @return ModeleLotVO
	* @desc Retourne une ModeleLotVO remplie
	*/
	private static function remplirModeleLot($pId, $pIdNomProduit, $pQuantite, $pUnite, $pPrix, $pEtat) {
		$lModeleLot = new ModeleLotVO();
		$lModeleLot->setId($pId);
		$lModeleLot->setIdNomProduit($pIdNomProduit);
		$lModeleLot->setQuantite($pQuantite);
		$lModeleLot->setUnite($pUnite);
		$lModeleLot->setPrix($pPrix);
		$lModeleLot->setEtat($pEtat);
		return $lModeleLot;
	}

	/**
	* @name insert($pVo)
	* @param ModeleLotVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ModeleLotVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . ModeleLotManager::TABLE_MODELELOT . "
				(" . ModeleLotManager::CHAMP_MODELELOT_ID . "
				," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . "
				," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . "
				," . ModeleLotManager::CHAMP_MODELELOT_UNITE . "
				," . ModeleLotManager::CHAMP_MODELELOT_PRIX . "
				," . ModeleLotManager::CHAMP_MODELELOT_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				,'" . StringUtils::securiser( $pVo->getUnite() ) . "'
				,'" . StringUtils::securiser( $pVo->getPrix() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}
	
	/**
	* @name insertByArray($pVo)
	* @param array(ModeleLotVO)
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ModeleLotVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insertByArray($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		if(is_array($pVo)) {
			$lRequete =
			"INSERT INTO " . ModeleLotManager::TABLE_MODELELOT . "
				(" . ModeleLotManager::CHAMP_MODELELOT_ID . "
				," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . "
				," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . "
				," . ModeleLotManager::CHAMP_MODELELOT_UNITE . "
				," . ModeleLotManager::CHAMP_MODELELOT_PRIX . "
				," . ModeleLotManager::CHAMP_MODELELOT_ETAT . ")
			VALUES ";
			$lTaille = count($pVo);
			foreach($pVo as $ModeleLot) {
				$lTaille--;
				if($lTaille > 0) {
					$lRequete .= "(NULL
					,'" . StringUtils::securiser( $ModeleLot->getIdNomProduit() ) . "'
					,'" . StringUtils::securiser( $ModeleLot->getQuantite() ) . "'
					,'" . StringUtils::securiser( $ModeleLot->getUnite() ) . "'
					,'" . StringUtils::securiser( $ModeleLot->getPrix() ) . "'
					,'" . StringUtils::securiser( $ModeleLot->getEtat() ) . "'),";
				} else {
					$lRequete .= "(NULL
					,'" . StringUtils::securiser( $ModeleLot->getIdNomProduit() ) . "'
					,'" . StringUtils::securiser( $ModeleLot->getQuantite() ) . "'
					,'" . StringUtils::securiser( $ModeleLot->getUnite() ) . "'
					,'" . StringUtils::securiser( $ModeleLot->getPrix() ) . "'
					,'" . StringUtils::securiser( $ModeleLot->getEtat() ) . "');";
				}
			}

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			return Dbutils::executerRequete($lRequete);
		}
	}

	/**
	* @name update($pVo)
	* @param ModeleLotVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du ModeleLotVO, avec les informations du ModeleLotVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . ModeleLotManager::TABLE_MODELELOT . "
			 SET
				 " . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . " = '" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				," . ModeleLotManager::CHAMP_MODELELOT_UNITE . " = '" . StringUtils::securiser( $pVo->getUnite() ) . "'
				," . ModeleLotManager::CHAMP_MODELELOT_PRIX . " = '" . StringUtils::securiser( $pVo->getPrix() ) . "'
				," . ModeleLotManager::CHAMP_MODELELOT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . ModeleLotManager::CHAMP_MODELELOT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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
			"UPDATE " . ModeleLotManager::TABLE_MODELELOT . "
			 SET " . ModeleLotManager::CHAMP_MODELELOT_ETAT . " = '1'
			 WHERE " . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pId ) . "'";

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
				"UPDATE " . ModeleLotManager::TABLE_MODELELOT . "
				 SET " . ModeleLotManager::CHAMP_MODELELOT_ETAT . " = '1'
				 WHERE " . ModeleLotManager::CHAMP_MODELELOT_ID . " in (";
			
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

		$lRequete = "DELETE FROM " . ModeleLotManager::TABLE_MODELELOT . "
			WHERE " . ModeleLotManager::CHAMP_MODELELOT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>