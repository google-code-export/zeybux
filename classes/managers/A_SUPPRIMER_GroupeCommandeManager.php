<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : GroupeCommandeManager.php
//
// Description : Classe de gestion des GroupeCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "GroupeCommandeVO.php");

/**
 * @name GroupeCommande
 * @author Julien PIERRE
 * @since 02/09/2010
 * 
 * @desc Classe permettant l'accès aux données des GroupeCommande
 */
class GroupeCommandeManager
{
	const TABLE_GROUPECOMMANDE = "gpc_groupe_commande";
	const CHAMP_GROUPECOMMANDE_ID = "gpc_id";
	const CHAMP_GROUPECOMMANDE_ID_COMPTE = "gpc_id_compte";
	const CHAMP_GROUPECOMMANDE_ID_COMMANDE = "gpc_id_commande";
	const CHAMP_GROUPECOMMANDE_ETAT = "gpc_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return GroupeCommandeVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une GroupeCommandeVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID . 
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE . 
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE . 
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT . "
			FROM " . GroupeCommandeManager::TABLE_GROUPECOMMANDE . " 
			WHERE " . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return GroupeCommandeManager::remplirGroupeCommande(
				$pId,
				$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE],
				$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE],
				$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT]);
		} else {
			return new GroupeCommandeVO();
		}
	}

	/**
	* @name selectAll
	* @return array(GroupeCommandeVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de GroupeCommandeVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID . 
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE . 
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE . 
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT . "
			FROM " . GroupeCommandeManager::TABLE_GROUPECOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeGroupeCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeGroupeCommande,
					GroupeCommandeManager::remplirGroupeCommande(
					$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID],
					$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE],
					$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE],
					$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT]));
			}
		} else {
			$lListeGroupeCommande[0] = new GroupeCommandeVO();
		}
		return $lListeGroupeCommande;
	}
	
	/**
	* @name selectByIdCompte($pId)
	* @param integer
	* @return array(GroupeCommandeVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId et les renvoie sous forme d'une collection de GroupeCommandeVO
	*/
	public static function selectByIdCompte($pId) {		
		return GroupeCommandeManager::recherche(
			array(GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE),
			array('='),
			array($pId),
			array(GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID),
			array('ASC'));
	}
	
	/**
	* @name selectAchat($pIdCommande, $pIdCompte)
	* @param integer
	* @param integer
	* @return array(GroupeCommandeVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId, IdCommande $pIdCommande. Puis les renvoie sous forme d'une collection de GroupeCommandeVO
	*/
	public static function selectAchat($pIdCommande, $pIdCompte) {
		return GroupeCommandeManager::recherche(
			array(GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE,GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE),
			array('=','='),
			array($pIdCommande, $pIdCompte),
			array(GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID),
			array('ASC'));
	}
	
	/**
	* @name selectReservationCommande($pIdCommande)
	* @param integer
	* @return array(GroupeCommandeVO)
	* @desc Récupères toutes les réservations de la commande $pIdCommande. Puis les renvoie sous forme d'une collection de GroupeCommandeVO
	*/
	public static function selectReservationCommande($pIdCommande) {
		return GroupeCommandeManager::recherche(
			array(GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE,GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT),
			array('=','='),
			array($pIdCommande, 0),
			array(GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID),
			array('ASC'));
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(GroupeCommandeVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de GroupeCommandeVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID .
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE .
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE .
			"," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(GroupeCommandeManager::TABLE_GROUPECOMMANDE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeGroupeCommande = array();

		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeGroupeCommande,
						GroupeCommandeManager::remplirGroupeCommande(
						$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID],
						$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE],
						$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE],
						$lLigne[GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT]));
				}
			} else {
				$lListeGroupeCommande[0] = new GroupeCommandeVO();
			}
	
			return $lListeGroupeCommande;
		}
		
		$lListeGroupeCommande[0] = new GroupeCommandeVO();
		return $lListeGroupeCommande;
	}

	/**
	* @name remplirGroupeCommande($pId, $pIdCompte, $pIdCommande, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param tinyint(1)
	* @return GroupeCommandeVO
	* @desc Retourne une GroupeCommandeVO remplie
	*/
	private static function remplirGroupeCommande($pId, $pIdCompte, $pIdCommande, $pEtat) {
		$lGroupeCommande = new GroupeCommandeVO();
		$lGroupeCommande->setId($pId);
		$lGroupeCommande->setIdCompte($pIdCompte);
		$lGroupeCommande->setIdCommande($pIdCommande);
		$lGroupeCommande->setEtat($pEtat);
		return $lGroupeCommande;
	}

	/**
	* @name insert($pVo)
	* @param GroupeCommandeVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la GroupeCommandeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . GroupeCommandeManager::TABLE_GROUPECOMMANDE . "
				(" . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID . "
				," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE . "
				," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE . " 
				," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param GroupeCommandeVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du GroupeCommandeVO, avec les informations du GroupeCommandeVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . GroupeCommandeManager::TABLE_GROUPECOMMANDE . "
			 SET
				 " . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID_COMMANDE . " = '" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
				," . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . GroupeCommandeManager::TABLE_GROUPECOMMANDE . "
			WHERE " . GroupeCommandeManager::CHAMP_GROUPECOMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>