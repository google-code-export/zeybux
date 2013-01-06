<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitProducteurManager.php
//
// Description : Classe de gestion des NomProduitProducteur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "NomProduitProducteurVO.php");

/**
 * @name NomProduitProducteurManager
 * @author Julien PIERRE
 * @since 03/11/2011
 * 
 * @desc Classe permettant l'accès aux données des NomProduitProducteur
 */
class NomProduitProducteurManager
{
	const TABLE_NOMPRODUITPRODUCTEUR = "nprdt_nom_produit_producteur";
	const CHAMP_NOMPRODUITPRODUCTEUR_ID = "nprdt_id";
	const CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT = "nprdt_id_nom_produit";
	const CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR = "nprdt_id_producteur";
	const CHAMP_NOMPRODUITPRODUCTEUR_ETAT = "nprdt_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return NomProduitProducteurVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une NomProduitProducteurVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID . 
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT . 
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR . 
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ETAT . "
			FROM " . NomProduitProducteurManager::TABLE_NOMPRODUITPRODUCTEUR . " 
			WHERE " . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return NomProduitProducteurManager::remplirNomProduitProducteur(
				$pId,
				$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT],
				$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR],
				$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ETAT]);
		} else {
			return new NomProduitProducteurVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(NomProduitProducteurVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de NomProduitProducteurVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID . 
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT . 
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR . 
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ETAT . "
			FROM " . NomProduitProducteurManager::TABLE_NOMPRODUITPRODUCTEUR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeNomProduitProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeNomProduitProducteur,
					NomProduitProducteurManager::remplirNomProduitProducteur(
					$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID],
					$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT],
					$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR],
					$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ETAT]));
			}
		} else {
			$lListeNomProduitProducteur[0] = new NomProduitProducteurVO();
		}
		return $lListeNomProduitProducteur;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(NomProduitProducteurVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de NomProduitProducteurVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID .
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT .
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR .
			"," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(NomProduitProducteurManager::TABLE_NOMPRODUITPRODUCTEUR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeNomProduitProducteur = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeNomProduitProducteur,
						NomProduitProducteurManager::remplirNomProduitProducteur(
						$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID],
						$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT],
						$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR],
						$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ETAT]));
				}
			} else {
				$lListeNomProduitProducteur[0] = new NomProduitProducteurVO();
			}

			return $lListeNomProduitProducteur;
		}

		$lListeNomProduitProducteur[0] = new NomProduitProducteurVO();
		return $lListeNomProduitProducteur;
	}

	/**
	* @name remplirNomProduitProducteur($pId, $pIdNomProduit, $pIdProducteur, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param tinyint(4)
	* @return NomProduitProducteurVO
	* @desc Retourne une NomProduitProducteurVO remplie
	*/
	private static function remplirNomProduitProducteur($pId, $pIdNomProduit, $pIdProducteur, $pEtat) {
		$lNomProduitProducteur = new NomProduitProducteurVO();
		$lNomProduitProducteur->setId($pId);
		$lNomProduitProducteur->setIdNomProduit($pIdNomProduit);
		$lNomProduitProducteur->setIdProducteur($pIdProducteur);
		$lNomProduitProducteur->setEtat($pEtat);
		return $lNomProduitProducteur;
	}

	/**
	* @name insert($pVo)
	* @param NomProduitProducteurVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la NomProduitProducteurVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . NomProduitProducteurManager::TABLE_NOMPRODUITPRODUCTEUR . "
				(" . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID . "
				," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT . "
				," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR . "
				," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdProducteur() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param NomProduitProducteurVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du NomProduitProducteurVO, avec les informations du NomProduitProducteurVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . NomProduitProducteurManager::TABLE_NOMPRODUITPRODUCTEUR . "
			 SET
				 " . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_PRODUCTEUR . " = '" . StringUtils::securiser( $pVo->getIdProducteur() ) . "'
				," . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . NomProduitProducteurManager::TABLE_NOMPRODUITPRODUCTEUR . "
			WHERE " . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>