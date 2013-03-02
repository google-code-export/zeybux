<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/07/2011
// Fichier : DetailCommandeManager.php
//
// Description : Classe de gestion des DetailCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "DetailCommandeVO.php");

/**
 * @name DetailCommandeManager
 * @author Julien PIERRE
 * @since 26/07/2011
 * 
 * @desc Classe permettant l'accès aux données des DetailCommande
 */
class DetailCommandeManager
{
	const TABLE_DETAILCOMMANDE = "dcom_detail_commande";
	const CHAMP_DETAILCOMMANDE_ID = "dcom_id";
	const CHAMP_DETAILCOMMANDE_ID_PRODUIT = "dcom_id_produit";
	const CHAMP_DETAILCOMMANDE_TAILLE = "dcom_taille";
	const CHAMP_DETAILCOMMANDE_PRIX = "dcom_prix";
	const CHAMP_DETAILCOMMANDE_ETAT = "dcom_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return DetailCommandeVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une DetailCommandeVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . "
			FROM " . DetailCommandeManager::TABLE_DETAILCOMMANDE . " 
			WHERE " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return DetailCommandeManager::remplirDetailCommande(
				$pId,
				$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
				$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE],
				$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX],
				$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT]);
		} else {
			return new DetailCommandeVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(DetailCommandeVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de DetailCommandeVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . "
			FROM " . DetailCommandeManager::TABLE_DETAILCOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailCommande,
					DetailCommandeManager::remplirDetailCommande(
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT]));
			}
		} else {
			$lListeDetailCommande[0] = new DetailCommandeVO();
		}
		return $lListeDetailCommande;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(DetailCommandeVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de DetailCommandeVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(DetailCommandeManager::TABLE_DETAILCOMMANDE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeDetailCommande = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeDetailCommande,
						DetailCommandeManager::remplirDetailCommande(
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT]));
				}
			} else {
				$lListeDetailCommande[0] = new DetailCommandeVO();
			}

			return $lListeDetailCommande;
		}

		$lListeDetailCommande[0] = new DetailCommandeVO();
		return $lListeDetailCommande;
	}

	/**
	* @name remplirDetailCommande($pId, $pIdProduit, $pTaille, $pPrix, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param int(11)
	* @return DetailCommandeVO
	* @desc Retourne une DetailCommandeVO remplie
	*/
	private static function remplirDetailCommande($pId, $pIdProduit, $pTaille, $pPrix, $pEtat) {
		$lDetailCommande = new DetailCommandeVO();
		$lDetailCommande->setId($pId);
		$lDetailCommande->setIdProduit($pIdProduit);
		$lDetailCommande->setTaille($pTaille);
		$lDetailCommande->setPrix($pPrix);
		$lDetailCommande->setEtat($pEtat);
		return $lDetailCommande;
	}

	/**
	* @name insert($pVo)
	* @param DetailCommandeVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la DetailCommandeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . DetailCommandeManager::TABLE_DETAILCOMMANDE . "
				(" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . "
				," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . "
				," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . "
				," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . "
				," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getTaille() ) . "'
				,'" . StringUtils::securiser( $pVo->getPrix() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param DetailCommandeVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du DetailCommandeVO, avec les informations du DetailCommandeVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . DetailCommandeManager::TABLE_DETAILCOMMANDE . "
			 SET
				 " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdProduit() ) . "'
				," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . " = '" . StringUtils::securiser( $pVo->getTaille() ) . "'
				," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . " = '" . StringUtils::securiser( $pVo->getPrix() ) . "'
				," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . DetailCommandeManager::TABLE_DETAILCOMMANDE . "
			WHERE " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>