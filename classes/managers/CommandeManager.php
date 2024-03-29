<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/06/2010
// Fichier : CommandeManager.php
//
// Description : Classe de gestion des Commande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CommandeVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeReservationVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationChampComplementaireManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

define("TABLE_COMMANDE", MYSQL_DB_PREFIXE . "com_commande");
/**
 * @name CommandeManager
 * @author Julien PIERRE
 * @since 10/06/2010
 * 
 * @desc Classe permettant l'accès aux données des Commande
 */
class CommandeManager
{
	const TABLE_COMMANDE = TABLE_COMMANDE;
	const CHAMP_COMMANDE_ID = "com_id";
	const CHAMP_COMMANDE_NUMERO = "com_numero";
	const CHAMP_COMMANDE_NOM = "com_nom";
	const CHAMP_COMMANDE_DESCRIPTION = "com_description";
	const CHAMP_COMMANDE_DATE_MARCHE_DEBUT = "com_date_marche_debut";
	const CHAMP_COMMANDE_DATE_MARCHE_FIN = "com_date_marche_fin";
	const CHAMP_COMMANDE_DATE_DEBUT_RESERVATION = "com_date_debut_reservation";
	const CHAMP_COMMANDE_DATE_FIN_RESERVATION = "com_date_fin_reservation";
	const CHAMP_COMMANDE_ARCHIVE = "com_archive";

	/**
	* @name select($pId)
	* @param integer
	* @return CommandeVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CommandeVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_DESCRIPTION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE . "
			FROM " . CommandeManager::TABLE_COMMANDE . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CommandeManager::remplirCommande(
				$pId,
				$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
				$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DESCRIPTION],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
				$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE]);
		} else {
			return new CommandeVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(CommandeVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CommandeVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_DESCRIPTION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE . "
			FROM " . CommandeManager::TABLE_COMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCommande,
					CommandeManager::remplirCommande(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DESCRIPTION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE]));
			}
		} else {
			$lListeCommande[0] = new CommandeVO();
		}
		return $lListeCommande;
	}

	/**
	 * @name selectAll()
	 * @return array(CommandeVO)
	 * @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CommandeVO
	 */
	/*public static function selectAll() {
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
		FROM " . CommandeManager::TABLE_COMMANDE . "
		JOIN " . ProduitManager::TABLE_PRODUIT . "
			ON " . CommandeManager::CHAMP_COMMANDE_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . "
		JOIN " . DetailCommandeManager::TABLE_DETAILCOMMANDE . "
			ON " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID . "
		JOIN " . StockManager::TABLE_STOCK . "
			ON " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = " . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE ."
			AND " . StockManager::CHAMP_STOCK_TYPE . " = 0
			AND " . StockManager::CHAMP_STOCK_ID_COMPTE . " <> 0
		JOIN " . AdherentManager::TABLE_ADHERENT . " 
			ON " . StockManager::CHAMP_STOCK_ID_COMPTE . " = " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE ."
			AND " . AdherentManager::CHAMP_ADHERENT_ETAT . " = 1
		JOIN " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . " 
			ON " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = 1
			AND " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . " = " . CommandeManager::CHAMP_COMMANDE_ID . "
		JOIN " . OperationManager::TABLE_OPERATION . "
			ON " . OperationManager::CHAMP_OPERATION_ID . " = " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " 
			AND " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = 0
		JOIN " . CompteManager::TABLE_COMPTE . "	
			ON " . CompteManager::CHAMP_COMPTE_ID . " = " . StockManager::CHAMP_STOCK_ID_COMPTE . "		
					
		WHERE   
			
					
			" . CommandeManager::CHAMP_COMMANDE_ARCHIVE . " in (0,1)
			AND " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "';";
	}*/
	
	/**
	 * @name rechercheReservation( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	 * @param string nom de la table
	 * @param string Le type de critère de recherche
	 * @param array(string) champs à récupérer dans la table
	 * @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	 * @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	 * @return array(ListeReservationVO)
	 * @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeReservationVO
	 */
	public static function rechercheReservation( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
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
			"," . CompteManager::CHAMP_COMPTE_LABEL );
	
		$lTable = 
		CommandeManager::TABLE_COMMANDE . "
		JOIN " . ProduitManager::TABLE_PRODUIT . "
			ON " . CommandeManager::CHAMP_COMMANDE_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . "
			AND " . ProduitManager::CHAMP_PRODUIT_ETAT . " = 0
		JOIN " . DetailCommandeManager::TABLE_DETAILCOMMANDE . "
			ON " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . " = " . ProduitManager::CHAMP_PRODUIT_ID . "
			AND " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . " = 0
		JOIN " . StockManager::TABLE_STOCK . "
			ON " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = " . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE ."
			AND " . StockManager::CHAMP_STOCK_TYPE . " = 0
			AND " . StockManager::CHAMP_STOCK_ID_COMPTE . " <> 0
		JOIN " . CompteManager::TABLE_COMPTE . "	
			ON " . CompteManager::CHAMP_COMPTE_ID . " = " . StockManager::CHAMP_STOCK_ID_COMPTE . "
		JOIN " . AdherentManager::TABLE_ADHERENT . " 
			ON " . StockManager::CHAMP_STOCK_ID_COMPTE . " = " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . "
			AND " . CompteManager::CHAMP_COMPTE_ID_ADHERENT_PRINCIPAL . " = " . AdherentManager::CHAMP_ADHERENT_ID . "
			AND " . AdherentManager::CHAMP_ADHERENT_ETAT . " = 1";
		
		// Uniquement les commandes actives
		array_push($pTypeRecherche, CommandeManager::CHAMP_COMMANDE_ARCHIVE);
		array_push($pTypeCritere, 'in');
		array_push($pCritereRecherche, array(0,1));
				
		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche($lTable, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);
	
		$lListeReservation = array();
	
		if($lRequete !== false) {
	
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeReservation,
					CommandeManager::remplirReservation(
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
				$lListeReservation[0] = new ListeReservationVO();
			}
	
			return $lListeReservation;
		}
	
		$lListeReservation[0] = new ListeReservationVO();
		return $lListeReservation;
	}
	
	/**
	 * @name remplirReservation($pComId, $pProId, $pStoId, $pStoQuantite, $pProUniteMesure, $pStoType, $pStoIdCompte, $pDcomId, $pAdhId, $pAdhNom, $pAdhPrenom, $pAdhTelephonePrincipal, $pCptLabel)
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
	 * @return ListeReservationVO
	 * @desc Retourne une ListeReservationVO remplie
	 */
	private static function remplirReservation($pComId, $pProId, $pStoId, $pStoQuantite, $pProUniteMesure, $pStoType, $pStoIdCompte, $pDcomId, $pAdhId, $pAdhNom, $pAdhPrenom, $pAdhTelephonePrincipal, $pCptLabel) {
		$lReservation = new ListeReservationVO();
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
	
	/**
	* @name selectNonReserveeParCompte($pIdCompte)
	* @param integer
	* @return array(CommandeVO)
	* @desc Récupères les commandes en cours non réservées par l'adhérent
	*/
	public static function selectNonReserveeParCompte($pIdCompte) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . "
			FROM " . CommandeManager::TABLE_COMMANDE . "
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " NOT IN (
   					SELECT " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . "
   					FROM " . OperationManager::TABLE_OPERATION . "
   					JOIN " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . " 
   						ON " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = " . OperationManager::CHAMP_OPERATION_ID . " 
   						AND " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = 1
   					WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " in (0,7,8,15)
   					AND " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . $pIdCompte . ")
   			AND " . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION . " <= now()
   			AND " . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . " >= now()
			AND " . CommandeManager::CHAMP_COMMANDE_ARCHIVE . " = 0
   			ORDER BY " . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . " ASC";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCommande,
					CommandeManager::remplirCommande(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
					'',
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					''));
			}
		} else {
			$lListeCommande[0] = new CommandeVO();
		}
		return $lListeCommande;	
	}
	
	/**
	* @name selectNonAchatParCompte($pIdCompte)
	* @param integer
	* @return array(CommandeVO)
	* @desc Récupères les marchés en cours sans achat par l'adhérent
	*/
	public static function selectNonAchatParCompte($pIdCompte) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"(SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . "
			FROM " . CommandeManager::TABLE_COMMANDE . "
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " NOT IN (
   					SELECT " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . "
   					FROM " . OperationManager::TABLE_OPERATION . "
   					JOIN " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . " 
   						ON " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = " . OperationManager::CHAMP_OPERATION_ID . " 
   						AND " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = 1
   					WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " in (7,8)
   					AND " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . $pIdCompte . ")
   			AND " . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION . " <= now()
   			AND " . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . " >= now()
			AND " . CommandeManager::CHAMP_COMMANDE_ARCHIVE . " = 0)
			
			UNION
			
			(SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . "
			FROM " . CommandeManager::TABLE_COMMANDE . "
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " IN (
   					SELECT " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . "
   					FROM " . OperationManager::TABLE_OPERATION . "
   					JOIN " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . " 
   						ON " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = " . OperationManager::CHAMP_OPERATION_ID . " 
   						AND " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = 1
   					WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = 0
   					AND " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . $pIdCompte . ")
   					
   			AND " . CommandeManager::CHAMP_COMMANDE_ID . " NOT IN (
   					SELECT " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . "
   					FROM " . OperationManager::TABLE_OPERATION . "
   					JOIN " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . " 
   						ON " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . " = " . OperationManager::CHAMP_OPERATION_ID . " 
   						AND " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = 1
   					
   					WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " in (7,8)
   					AND " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . $pIdCompte . ")
   					
   			AND " . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION . " <= now()
   			AND " . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . " < now()
			AND " . CommandeManager::CHAMP_COMMANDE_ARCHIVE . " = 0)
			
   			ORDER BY " . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . " ASC";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCommande,
					CommandeManager::remplirCommande(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
					'',
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					''));
			}
		} else {
			$lListeCommande[0] = new CommandeVO();
		}
		return $lListeCommande;	
	}
	
	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CommandeVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CommandeVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID .
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO .
			"," . CommandeManager::CHAMP_COMMANDE_NOM .
			"," . CommandeManager::CHAMP_COMMANDE_DESCRIPTION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CommandeManager::TABLE_COMMANDE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCommande = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCommande,
						CommandeManager::remplirCommande(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DESCRIPTION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE]));
				}
			} else {
				$lListeCommande[0] = new CommandeVO();
			}

			return $lListeCommande;
		}

		$lListeCommande[0] = new CommandeVO();
		return $lListeCommande;
	}

	/**
	* @name remplirCommande($pId, $pNumero, $pNom, $pDescription, $pDateMarcheDebut, $pDateMarcheFin, $pDateDebutReservation, $pDateFinReservation, $pArchive)
	* @param int(11)
	* @param int(11)
	* @param varchar(100)
	* @param text
	* @param datetime
	* @param datetime
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return CommandeVO
	* @desc Retourne une CommandeVO remplie
	*/
	private static function remplirCommande($pId, $pNumero, $pNom, $pDescription, $pDateMarcheDebut, $pDateMarcheFin, $pDateDebutReservation, $pDateFinReservation, $pArchive) {
		$lCommande = new CommandeVO();
		$lCommande->setId($pId);
		$lCommande->setNumero($pNumero);
		$lCommande->setNom($pNom);
		$lCommande->setDescription($pDescription);
		$lCommande->setDateMarcheDebut($pDateMarcheDebut);
		$lCommande->setDateMarcheFin($pDateMarcheFin);
		$lCommande->setDateDebutReservation($pDateDebutReservation);
		$lCommande->setDateFinReservation($pDateFinReservation);
		$lCommande->setArchive($pArchive);
		return $lCommande;
	}

	/**
	* @name insert($pVo)
	* @param CommandeVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CommandeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CommandeManager::TABLE_COMMANDE . "
				(" . CommandeManager::CHAMP_COMMANDE_ID . "
				," . CommandeManager::CHAMP_COMMANDE_NUMERO . "
				," . CommandeManager::CHAMP_COMMANDE_NOM . "
				," . CommandeManager::CHAMP_COMMANDE_DESCRIPTION . "
				," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . "
				," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
				," . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION . "
				," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . "
				," . CommandeManager::CHAMP_COMMANDE_ARCHIVE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getNumero() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getDescription() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateMarcheDebut() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateMarcheFin() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateDebutReservation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateFinReservation() ) . "'
				,'" . StringUtils::securiser( $pVo->getArchive() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param CommandeVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CommandeVO, avec les informations du CommandeVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CommandeManager::TABLE_COMMANDE . "
			 SET
				 " . CommandeManager::CHAMP_COMMANDE_NUMERO . " = '" . StringUtils::securiser( $pVo->getNumero() ) . "'
				," . CommandeManager::CHAMP_COMMANDE_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . CommandeManager::CHAMP_COMMANDE_DESCRIPTION . " = '" . StringUtils::securiser( $pVo->getDescription() ) . "'
				," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . " = '" . StringUtils::securiser( $pVo->getDateMarcheDebut() ) . "'
				," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . " = '" . StringUtils::securiser( $pVo->getDateMarcheFin() ) . "'
				," . CommandeManager::CHAMP_COMMANDE_DATE_DEBUT_RESERVATION . " = '" . StringUtils::securiser( $pVo->getDateDebutReservation() ) . "'
				," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . " = '" . StringUtils::securiser( $pVo->getDateFinReservation() ) . "'
				," . CommandeManager::CHAMP_COMMANDE_ARCHIVE . " = '" . StringUtils::securiser( $pVo->getArchive() ) . "'
			 WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
		return $pVo->getId();
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

		$lRequete = "DELETE FROM " . CommandeManager::TABLE_COMMANDE . "
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>