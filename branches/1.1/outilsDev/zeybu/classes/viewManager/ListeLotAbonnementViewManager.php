<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/04/2012
// Fichier : ListeLotAbonnementViewManager.php
//
// Description : Classe de gestion des ListeLotAbonnement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeLotAbonnementViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "LotAbonnementManager.php");

define("VUE_LISTELOTABONNEMENT", MYSQL_DB_PREFIXE . "view_liste_lot_abonnement");
/**
 * @name ListeLotAbonnementViewManager
 * @author Julien PIERRE
 * @since 12/04/2012
 * 
 * @desc Classe permettant l'accès aux données des ListeLotAbonnement
 */
class ListeLotAbonnementViewManager
{
	const VUE_LISTELOTABONNEMENT = VUE_LISTELOTABONNEMENT;

	/**
	* @name select($pId)
	* @param integer
	* @return ListeLotAbonnementViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeLotAbonnementViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX . "
			FROM " . ListeLotAbonnementViewManager::VUE_LISTELOTABONNEMENT . " 
			WHERE " . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeLotAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeLotAbonnement,
					ListeLotAbonnementViewManager::remplir(
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX]));
			}
		} else {
			$lListeListeLotAbonnement[0] = new ListeLotAbonnementViewVO();
		}
		return $lListeListeLotAbonnement;
	}

	/**
	* @name selectAll()
	* @return array(ListeLotAbonnementViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeLotAbonnementViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX . "
			FROM " . ListeLotAbonnementViewManager::VUE_LISTELOTABONNEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeLotAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeLotAbonnement,
					ListeLotAbonnementViewManager::remplir(
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX]));
			}
		} else {
			$lListeListeLotAbonnement[0] = new ListeLotAbonnementViewVO();
		}
		return $lListeListeLotAbonnement;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeLotAbonnementViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeLotAbonnementViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    LotAbonnementManager::CHAMP_LOTABONNEMENT_ID .
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT .
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE .
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeLotAbonnementViewManager::VUE_LISTELOTABONNEMENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeLotAbonnement = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeLotAbonnement,
						ListeLotAbonnementViewManager::remplir(
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID],
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT],
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE],
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX]));
				}
			} else {
				$lListeListeLotAbonnement[0] = new ListeLotAbonnementViewVO();
			}

			return $lListeListeLotAbonnement;
		}

		$lListeListeLotAbonnement[0] = new ListeLotAbonnementViewVO();
		return $lListeListeLotAbonnement;
	}

	/**
	* @name remplir($pLotAboId, $pLotAboIdProduitAbonnement, $pLotAboTaille, $pLotAboPrix)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2) 	
	* @param decimal(10,2) 	
	* @return ListeLotAbonnementViewVO
	* @desc Retourne une ListeLotAbonnementViewVO remplie
	*/
	private static function remplir($pLotAboId, $pLotAboIdProduitAbonnement, $pLotAboTaille, $pLotAboPrix) {
		$lListeLotAbonnement = new ListeLotAbonnementViewVO();
		$lListeLotAbonnement->setLotAboId($pLotAboId);
		$lListeLotAbonnement->setLotAboIdProduitAbonnement($pLotAboIdProduitAbonnement);
		$lListeLotAbonnement->setLotAboTaille($pLotAboTaille);
		$lListeLotAbonnement->setLotAboPrix($pLotAboPrix);
		return $lListeLotAbonnement;
	}
}
?>