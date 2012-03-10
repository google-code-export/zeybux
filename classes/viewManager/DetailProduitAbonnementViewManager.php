<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : DetailProduitAbonnementViewManager.php
//
// Description : Classe de gestion des DetailProduitAbonnement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "DetailProduitAbonnementViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

define("VUE_DETAILPRODUITABONNEMENT", MYSQL_DB_PREFIXE . "view_detail_produit_abonnement");
/**
 * @name DetailProduitAbonnementViewManager
 * @author Julien PIERRE
 * @since 11/02/2012
 * 
 * @desc Classe permettant l'accès aux données des DetailProduitAbonnement
 */
class DetailProduitAbonnementViewManager
{
	const VUE_DETAILPRODUITABONNEMENT = VUE_DETAILPRODUITABONNEMENT;
	const CHAMP_PRODUITABONNEMENT_RESERVATION = "proabo_reservation";

	/**
	* @name select($pId)
	* @param integer
	* @return DetailProduitAbonnementViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une DetailProduitAbonnementViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE . 
			"," . DetailProduitAbonnementViewManager::CHAMP_PRODUITABONNEMENT_RESERVATION ."
			FROM " . DetailProduitAbonnementViewManager::VUE_DETAILPRODUITABONNEMENT . " 
			WHERE " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailProduitAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailProduitAbonnement,
					DetailProduitAbonnementViewManager::remplir(
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE],
					$lLigne[DetailProduitAbonnementViewManager::CHAMP_PRODUITABONNEMENT_RESERVATION]));
			}
		} else {
			$lListeDetailProduitAbonnement[0] = new DetailProduitAbonnementViewVO();
		}
		return $lListeDetailProduitAbonnement;
	}

	/**
	* @name selectAll()
	* @return array(DetailProduitAbonnementViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de DetailProduitAbonnementViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE . 
			"," . DetailProduitAbonnementViewManager::CHAMP_PRODUITABONNEMENT_RESERVATION ."
			FROM " . DetailProduitAbonnementViewManager::VUE_DETAILPRODUITABONNEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailProduitAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailProduitAbonnement,
					DetailProduitAbonnementViewManager::remplir(
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE],
					$lLigne[DetailProduitAbonnementViewManager::CHAMP_PRODUITABONNEMENT_RESERVATION]));
			}
		} else {
			$lListeDetailProduitAbonnement[0] = new DetailProduitAbonnementViewVO();
		}
		return $lListeDetailProduitAbonnement;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(DetailProduitAbonnementViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de DetailProduitAbonnementViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE .	
			"," . DetailProduitAbonnementViewManager::CHAMP_PRODUITABONNEMENT_RESERVATION 	);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(DetailProduitAbonnementViewManager::VUE_DETAILPRODUITABONNEMENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeDetailProduitAbonnement = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeDetailProduitAbonnement,
						DetailProduitAbonnementViewManager::remplir(
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE],
						$lLigne[DetailProduitAbonnementViewManager::CHAMP_PRODUITABONNEMENT_RESERVATION]));
				}
			} else {
				$lListeDetailProduitAbonnement[0] = new DetailProduitAbonnementViewVO();
			}

			return $lListeDetailProduitAbonnement;
		}

		$lListeDetailProduitAbonnement[0] = new DetailProduitAbonnementViewVO();
		return $lListeDetailProduitAbonnement;
	}

	/**
	* @name remplir($pProAboId, $pNproNom, $pProAboUnite, $pProAboStockInitial, $pProAboMax, $pProAboFrequence, $pProAboReservation)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(20)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param varchar(200)
	* @param decimal(10,2)
	* @return DetailProduitAbonnementViewVO
	* @desc Retourne une DetailProduitAbonnementViewVO remplie
	*/
	private static function remplir($pProAboId, $pNproNom, $pProAboUnite, $pProAboStockInitial, $pProAboMax, $pProAboFrequence, $pProAboReservation) {
		$lDetailProduitAbonnement = new DetailProduitAbonnementViewVO();
		$lDetailProduitAbonnement->setProAboId($pProAboId);
		$lDetailProduitAbonnement->setNproNom($pNproNom);
		$lDetailProduitAbonnement->setProAboUnite($pProAboUnite);
		$lDetailProduitAbonnement->setProAboStockInitial($pProAboStockInitial);
		$lDetailProduitAbonnement->setProAboMax($pProAboMax);
		$lDetailProduitAbonnement->setProAboFrequence($pProAboFrequence);
		if(is_null($pProAboReservation)) {$pProAboReservation = 0;}
		$lDetailProduitAbonnement->setProAboReservation($pProAboReservation);
		return $lDetailProduitAbonnement;
	}
}
?>