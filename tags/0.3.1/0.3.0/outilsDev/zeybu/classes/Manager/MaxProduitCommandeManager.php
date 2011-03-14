<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/05/2010
// Fichier : MaxProduitCommandeManager.php
//
// Description : Classe de gestion des MaxProduitCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "MaxProduitCommandeVO.php");

/**
 * @name MaxProduitCommande
 * @author Julien PIERRE
 * @since 06/05/2010
 * 
 * @desc Classe permettant l'accès aux données des MaxProduitCommande
 */
class MaxProduitCommandeManager
{
	const TABLE_MAXPRODUITCOMMANDE = "mpc_max_produit_commande";
	const CHAMP_MAXPRODUITCOMMANDE_ID = "mpc_id";
	const CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE = "mpc_id_commande";
	const CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT = "mpc_id_produit";
	const CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE = "mpc_max_produit_commande";

	/**
	* @name select($pId)
	* @param integer
	* @return MaxProduitCommandeVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une MaxProduitCommandeVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID . 
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE . 
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT . 
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE . "
			FROM " . MaxProduitCommandeManager::TABLE_MAXPRODUITCOMMANDE . " 
			WHERE " . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return MaxProduitCommandeManager::remplirMaxProduitCommande(
				$pId,
				$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE],
				$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT],
				$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE]);
		} else {
			return new MaxProduitCommandeVO();
		}
	}

	/**
	* @name selectAll
	* @return array(MaxProduitCommandeVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de MaxProduitCommandeVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID . 
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE . 
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT . 
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE . "
			FROM " . MaxProduitCommandeManager::TABLE_MAXPRODUITCOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeMaxProduitCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeMaxProduitCommande,
					MaxProduitCommandeManager::remplirMaxProduitCommande(
					$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID],
					$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE],
					$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT],
					$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE]));
			}
		} else {
			$lListeMaxProduitCommande = new MaxProduitCommandeVO();
		}
		return $lListeMaxProduitCommande;
	}

	/**
	* @name recherche( $pTypeRecherche, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(MaxProduitCommandeVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de MaxProduitCommandeVO
	*/
	public static function recherche( $pTypeRecherche, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID .
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE .
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT .
			"," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(MaxProduitCommandeManager::TABLE_MAXPRODUITCOMMANDE, $lChamps, $lFiltres, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeMaxProduitCommande = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeMaxProduitCommande,
					MaxProduitCommandeManager::remplirMaxProduitCommande(
					$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID],
					$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE],
					$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT],
					$lLigne[MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE]));
			}
		} else {
			$lListeMaxProduitCommande[0] = new MaxProduitCommandeVO();
		}

		return $lListeMaxProduitCommande;
	}

	/**
	* @name remplirMaxProduitCommande($pId, $pIdCommande, $pIdProduit, $pMaxProduitCommande)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return MaxProduitCommandeVO
	* @desc Retourne une MaxProduitCommandeVO remplie
	*/
	private static function remplirMaxProduitCommande($pId, $pIdCommande, $pIdProduit, $pMaxProduitCommande) {
		$lMaxProduitCommande = new MaxProduitCommandeVO();
		$lMaxProduitCommande->setId($pId);
		$lMaxProduitCommande->setIdCommande($pIdCommande);
		$lMaxProduitCommande->setIdProduit($pIdProduit);
		$lMaxProduitCommande->setMaxProduitCommande($pMaxProduitCommande);
		return $lMaxProduitCommande;
	}

	/**
	* @name insert($pVo)
	* @param MaxProduitCommandeVO
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la MaxProduitCommandeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . MaxProduitCommandeManager::TABLE_MAXPRODUITCOMMANDE . "
				(" . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID . "
				," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE . "
				," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT . "
				," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getId() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getMaxProduitCommande() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

	/**
	* @name update($pVo)
	* @param MaxProduitCommandeVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du MaxProduitCommandeVO, avec les informations du MaxProduitCommandeVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . MaxProduitCommandeManager::TABLE_MAXPRODUITCOMMANDE . "
			 SET
				 " . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'
				," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_COMMANDE . " = '" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
				," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdProduit() ) . "'
				," . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_MAX_PRODUIT_COMMANDE . " = '" . StringUtils::securiser( $pVo->getMaxProduitCommande() ) . "')
			 WHERE " . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . MaxProduitCommandeManager::TABLE_MAXPRODUITCOMMANDE . "
			WHERE " . MaxProduitCommandeManager::CHAMP_MAXPRODUITCOMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>