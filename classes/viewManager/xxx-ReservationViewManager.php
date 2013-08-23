<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/09/2010
// Fichier : ReservationViewManager.php
//
// Description : Classe de gestion des Reservation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ReservationViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

define("VUE_RESERVATION", MYSQL_DB_PREFIXE . "view_reservation");
/**
 * @name ReservationViewManager
 * @author Julien PIERRE
 * @since 19/09/2010
 * 
 * @desc Classe permettant l'accès aux données des Reservation
 */
class ReservationViewManager
{
	const VUE_RESERVATION = VUE_RESERVATION;

	/**
	* @name select($pId)
	* @param integer
	* @return ReservationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ReservationViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . StockManager::CHAMP_STOCK_ID . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . StockManager::CHAMP_STOCK_TYPE . 
			"," . StockManager::CHAMP_STOCK_ID_COMPTE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
			"," . AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL .
			"," . CompteManager::CHAMP_COMPTE_LABEL . "
			FROM " . ReservationViewManager::VUE_RESERVATION . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeReservation,
					ReservationViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[StockManager::CHAMP_STOCK_TYPE],
					$lLigne[StockManager::CHAMP_STOCK_ID_COMPTE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
			}
		} else {
			$lListeReservation[0] = new ReservationViewVO();
		}
		return $lListeReservation;
	}

	/**
	* @name selectAll()
	* @return array(ReservationViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ReservationViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . StockManager::CHAMP_STOCK_ID . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .  
			"," . StockManager::CHAMP_STOCK_TYPE . 
			"," . StockManager::CHAMP_STOCK_ID_COMPTE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
			"," . AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL .
			"," . CompteManager::CHAMP_COMPTE_LABEL . "
			FROM " . ReservationViewManager::VUE_RESERVATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeReservation,
					ReservationViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[StockManager::CHAMP_STOCK_TYPE],
					$lLigne[StockManager::CHAMP_STOCK_ID_COMPTE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
			}
		} else {
			$lListeReservation[0] = new ReservationViewVO();
		}
		return $lListeReservation;
	}
	
	/**
	* @name selectReservationProduit($pIdCommande, $pIdProduits)
	* @param integer
	* @param array(integer)
	* @return array(ReservationViewVO)
	* @desc Récupères toutes les lignes de la table de la commande $pIdCommande pour les produits du tableau $pIdProduits et les renvoie sous forme d'une collection de OperationVO
	*/
	public static function selectReservationProduit($pIdCommande, $pIdProduits) {		
		return ReservationViewManager::recherche(
			array(CommandeManager::CHAMP_COMMANDE_ID,ProduitManager::CHAMP_PRODUIT_ID),
			array('=','in'),
			array($pIdCommande,$pIdProduits),
			array(AdherentManager::CHAMP_ADHERENT_NOM,AdherentManager::CHAMP_ADHERENT_PRENOM), 
			array('ASC','ASC'));
	}
	
	/**
	* @name selectByIdCompte($pIdCompte)
	* @param integer
	* @return array(ReservationViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId et les renvoie sous forme d'une collection de OperationVO
	*/
	public static function selectByIdCompte($pIdCompte) {
		return ReservationViewManager::recherche(
			array(StockManager::CHAMP_STOCK_ID_COMPTE),
			array('='),
			array($pIdCompte),
			array(CommandeManager::CHAMP_COMMANDE_ID),
			array('ASC'));
	}
	
	/**
	* @name selectAchat($pIdCommande, $pIdCompte)
	* @param integer
	* @param integer
	* @return array(ReservationViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId pour la commande $pIdCommande et les renvoie sous forme d'une collection de OperationVO
	*/
	public static function selectAchat($pIdCommande, $pIdCompte) {
		return ReservationViewManager::recherche(
			array(CommandeManager::CHAMP_COMMANDE_ID,StockManager::CHAMP_STOCK_ID_COMPTE),
			array('=','='),
			array($pIdCommande, $pIdCompte),
			array(CommandeManager::CHAMP_COMMANDE_ID),
			array('ASC'));
	}
	
	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ReservationViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ReservationViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . StockManager::CHAMP_STOCK_ID .
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . StockManager::CHAMP_STOCK_TYPE .
			"," . StockManager::CHAMP_STOCK_ID_COMPTE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
			"," . AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL .
			"," . CompteManager::CHAMP_COMPTE_LABEL);
				
		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ReservationViewManager::VUE_RESERVATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeReservation = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
			
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeReservation,
						ReservationViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[StockManager::CHAMP_STOCK_TYPE],
						$lLigne[StockManager::CHAMP_STOCK_ID_COMPTE],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
				}
			} else {
				$lListeReservation[0] = new ReservationViewVO();
			}
			return $lListeReservation;
		}
		
		$lListeReservation[0] = new ReservationViewVO();
		return $lListeReservation;
	}

	/**
	* @name remplir($pComId, $pProId, $pStoId, $pStoQuantite, $pProUniteMesure, $pStoType, $pStoIdCompte, $pDcomId, $pAdhId, $pAdhNom, $pAdhPrenom, $pAdhTelephonePrincipal, $pCptLabel)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(20)
	* @param tinyint(1)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(20)
	* @param varchar(30)
	* @return ReservationViewVO
	* @desc Retourne une ReservationViewVO remplie
	*/
	private static function remplir($pComId, $pProId, $pStoId, $pStoQuantite, $pProUniteMesure, $pStoType, $pStoIdCompte, $pDcomId, $pAdhId, $pAdhNom, $pAdhPrenom, $pAdhTelephonePrincipal, $pCptLabel) {
		$lReservation = new ReservationViewVO();
		$lReservation->setComId($pComId);
		$lReservation->setProId($pProId);
		$lReservation->setStoId($pStoId);
		$lReservation->setStoQuantite($pStoQuantite);
		$lReservation->setProUniteMesure($pProUniteMesure);
		$lReservation->setStoType($pStoType);
		$lReservation->setStoIdCompte($pStoIdCompte);
		$lReservation->setDcomId($pDcomId);
		$lReservation->setAdhId($pAdhId);
		$lReservation->setAdhNom($pAdhNom);
		$lReservation->setAdhPrenom($pAdhPrenom);
		$lReservation->setAdhTelephonePrincipal($pAdhTelephonePrincipal);
		$lReservation->setCptLabel($pCptLabel);
		return $lReservation;
	}
}
?>