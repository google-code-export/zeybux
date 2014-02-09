<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2010
// Fichier : AdherentManager.php
//
// Description : Classe de gestion des Adherents
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");

include_once(CHEMIN_CLASSES_VO . "TypePaiementVO.php");
include_once(CHEMIN_CLASSES_VO . "OperationVO.php");
include_once(CHEMIN_CLASSES_VO . "AdherentVO.php");
include_once(CHEMIN_CLASSES_VO . "AutorisationVO.php");
include_once(CHEMIN_CLASSES_VO . "ModuleVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeAchatReservationVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeAdherentAdhesionVO.php");

include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationChampComplementaireManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdhesionAdherentManager.php");


define("TABLE_ADHERENT", MYSQL_DB_PREFIXE . "adh_adherent");
/**
 * @name AdherentManager
 * @author Julien PIERRE
 * @since 25/01/2010
 * 
 * @desc Classe permettant l'accès aux données de l'adhérent
 */
class AdherentManager
{
	const TABLE_ADHERENT = TABLE_ADHERENT;
	const CHAMP_ADHERENT_ID = "adh_id";
	const CHAMP_ADHERENT_NUMERO = "adh_numero";
	const CHAMP_ADHERENT_ID_COMPTE = "adh_id_compte";
	const CHAMP_ADHERENT_NOM = "adh_nom";
	const CHAMP_ADHERENT_PRENOM = "adh_prenom";
	const CHAMP_ADHERENT_COURRIEL_PRINCIPAL = "adh_courriel_principal";
	const CHAMP_ADHERENT_COURRIEL_SECONDAIRE = "adh_courriel_secondaire";
	const CHAMP_ADHERENT_TELEPHONE_PRINCIPAL = "adh_telephone_principal";
	const CHAMP_ADHERENT_TELEPHONE_SECONDAIRE = "adh_telephone_secondaire";
	const CHAMP_ADHERENT_ADRESSE = "adh_adresse";
	const CHAMP_ADHERENT_CODE_POSTAL = "adh_code_postal";
	const CHAMP_ADHERENT_VILLE = "adh_ville";
	const CHAMP_ADHERENT_DATE_NAISSANCE = "adh_date_naissance";
	const CHAMP_ADHERENT_DATE_ADHESION = "adh_date_adhesion";
	const CHAMP_ADHERENT_DATE_MAJ = "adh_date_maj";
	const CHAMP_ADHERENT_COMMENTAIRE = "adh_commentaire";
	const CHAMP_ADHERENT_ETAT = "adh_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return AdherentVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AdherentVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . 
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE . 
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL . 
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE . 
			"," . AdherentManager::CHAMP_ADHERENT_ADRESSE . 
			"," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL . 
			"," . AdherentManager::CHAMP_ADHERENT_VILLE . 
			"," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE . 
			"," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION . 
			"," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ . 
			"," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE .  
			"," . AdherentManager::CHAMP_ADHERENT_ETAT . "
			FROM " . AdherentManager::TABLE_ADHERENT . " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			$lAdherent = AdherentManager::remplirAdherent(
				$pId,
				$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
				$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
				$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
				$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
				$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
				$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE],
				$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
				$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE],
				$lLigne[AdherentManager::CHAMP_ADHERENT_ADRESSE],
				$lLigne[AdherentManager::CHAMP_ADHERENT_CODE_POSTAL],
				$lLigne[AdherentManager::CHAMP_ADHERENT_VILLE],
				$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE],
				$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_ADHESION],
				$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_MAJ],
				$lLigne[AdherentManager::CHAMP_ADHERENT_COMMENTAIRE],
				$lLigne[AdherentManager::CHAMP_ADHERENT_ETAT]);
	
			return $lAdherent;
		} else {
			return new AdherentVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(AdherentVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AdherentVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . 
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE . 
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL . 
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE . 
			"," . AdherentManager::CHAMP_ADHERENT_ADRESSE . 
			"," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL . 
			"," . AdherentManager::CHAMP_ADHERENT_VILLE . 
			"," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE . 
			"," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION . 
			"," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ . 
			"," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE .   
			"," . AdherentManager::CHAMP_ADHERENT_ETAT . "
			FROM " . AdherentManager::TABLE_ADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {	
			while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
				$lAdherent = AdherentManager::remplirAdherent(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ADRESSE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_CODE_POSTAL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_VILLE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_ADHESION],
					$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_MAJ],
					$lLigne[AdherentManager::CHAMP_ADHERENT_COMMENTAIRE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ETAT]);	
			}
		} else {
			$lListeAdherent[0] = new AdherentVO();
		}
		return $lListeAdherent;
	}
	
	/**
	 * @name selectListeAdherentAchatMarche($pIdMarche)
	 * @param integer
	 * @desc Récupère la liste des adhérents actifs avec l'opération d'achat et les adhérents inactif si ils ont un achat
	 */
	public static function selectListeAdherentAchatMarche($pIdMarche) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete = "SELECT "
				. AdherentManager::CHAMP_ADHERENT_ID .
				"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
				"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE .
				"," . CompteManager::CHAMP_COMPTE_LABEL . 
				"," . AdherentManager::CHAMP_ADHERENT_NOM .
				"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
				"," . OperationManager::CHAMP_OPERATION_ID . "
			 FROM " . AdherentManager::TABLE_ADHERENT . "
			 JOIN " . CompteManager::TABLE_COMPTE . " ON " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . " = " . CompteManager::CHAMP_COMPTE_ID . "
			 LEFT JOIN (
			 	SELECT " 
			 		. OperationManager::CHAMP_OPERATION_ID .
			 		"," . OperationManager::CHAMP_OPERATION_ID_COMPTE . "
			 	FROM " . OperationManager::TABLE_OPERATION . " 
			 	JOIN " . OperationChampComplementaireManager::TABLE_OPERATIONCHAMPCOMPLEMENTAIRE . "
			 		ON " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID . " = 1
			 		AND " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR . " = '" . StringUtils::securiser( $pIdMarche ) . "'
					AND " . OperationManager::CHAMP_OPERATION_ID . " = " . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_OPE_ID . "
				WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " in (7,8) 
			) AS ope
			 	ON ope." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . "
			 GROUP BY " . AdherentManager::CHAMP_ADHERENT_ID . ";";
			
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeAchat = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {				
				array_push($lListeAchat, new ListeAchatReservationVO(
				$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
				$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
				$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
				$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
				$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
				$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
				null, null,
				$lLigne[OperationManager::CHAMP_OPERATION_ID]));
			}
		} else {
			$lListeAchat[0] = new ListeAchatReservationVO();
		}
		return $lListeAchat;
	}
	
	/**
	* @name selectByIdCompte($pId)
	* @param integer
	* @return array(AdherentVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId et les renvoie sous forme d'une collection de AdherentVO
	*/
	public static function selectByIdCompte($pId) {		
		return AdherentManager::rechercheAdherent(
			array(AdherentManager::CHAMP_ADHERENT_ID_COMPTE),
			array('='),
			array($pId),
			array(''),
			array(''));
	}
	
	/**
	 * @name selectActifByIdCompte($pId)
	 * @param integer
	 * @return array(AdherentVO)
	 * @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId et étant des adhérents actifs et les renvoie sous forme d'une collection de AdherentVO
	 */
	public static function selectActifByIdCompte($pId) {
		return AdherentManager::rechercheAdherent(
				array(AdherentManager::CHAMP_ADHERENT_ID_COMPTE, AdherentManager::CHAMP_ADHERENT_ETAT),
				array('=','='),
				array($pId,1),
				array(AdherentManager::CHAMP_ADHERENT_NUMERO),
				array('ASC'));
	}
	
	/**
	* @name selectByNumero($pId)
	* @param integer
	* @return array(AdherentVO)
	* @desc Récupères toutes les lignes de la table ayant pour Numero $pId et les renvoie sous forme d'une collection de AdherentVO
	*/
	public static function selectByNumero($pId) {		
		return AdherentManager::rechercheAdherent(
			array(AdherentManager::CHAMP_ADHERENT_NUMERO),
			array('='),
			array($pId),
			array(''),
			array(''));
	}
	
	/**
	 * @name selectListeAdherentAdhesion($pIdAdhesion)
	 * @param integer
	 * @desc Récupère la liste des adhérents actifs et leur statut sur l'adhesion $pIdAdhesion
	 */
	public static function selectListeAdherentAdhesion($pIdAdhesion) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		// L'ensebme des adhérents actifs + les adhérents supprimés mais adhérent à cette adhésion.
		$lRequete = "(
				SELECT "
					. AdherentManager::CHAMP_ADHERENT_ID .
					"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
					"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE .
					"," . CompteManager::CHAMP_COMPTE_LABEL . 
					"," . AdherentManager::CHAMP_ADHERENT_NOM .
					"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
					", ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . 
					", ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . "
				 FROM " . AdherentManager::TABLE_ADHERENT . "
				 JOIN " . CompteManager::TABLE_COMPTE . " ON " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . " = " . CompteManager::CHAMP_COMPTE_ID . "
				 LEFT JOIN (
				 	SELECT "
				 			. AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
				 		, " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . "
				 		, " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . "
				 	FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
				 	JOIN " . TypeAdhesionManager::TABLE_TYPEADHESION . "
					ON " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . "
				  	AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . " = 0
				  	AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . " = '" . StringUtils::securiser( $pIdAdhesion ) . "'
				  	WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0
				  ) ads
				 	ON " . AdherentManager::CHAMP_ADHERENT_ID . " = ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
				 WHERE " . AdherentManager::CHAMP_ADHERENT_ETAT . " = 1 
			 ) UNION ( 
			 	SELECT "
					. AdherentManager::CHAMP_ADHERENT_ID .
					"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
					"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE .
					"," . CompteManager::CHAMP_COMPTE_LABEL . 
					"," . AdherentManager::CHAMP_ADHERENT_NOM .
					"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
					", ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . 
					", ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . "
				 FROM " . AdherentManager::TABLE_ADHERENT . "
				 JOIN " . CompteManager::TABLE_COMPTE . " ON " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . " = " . CompteManager::CHAMP_COMPTE_ID . "
				 JOIN (
				 	SELECT "
				 			. AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
				 		, " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . "
				 		, " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . "
				 	FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
				 	JOIN " . TypeAdhesionManager::TABLE_TYPEADHESION . "
					ON " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . "
				  	AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . " = 0
				  	AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . " = '" . StringUtils::securiser( $pIdAdhesion ) . "'
				  	WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0
				  ) ads
				 	ON " . AdherentManager::CHAMP_ADHERENT_ID . " = ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
				 WHERE " . AdherentManager::CHAMP_ADHERENT_ETAT . " = 2			 
			 )
			 ORDER BY " . AdherentManager::CHAMP_ADHERENT_NOM . " ASC, " . AdherentManager::CHAMP_ADHERENT_PRENOM . " ASC;";
			
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {				
				array_push($lListeAdherent, new ListeAdherentAdhesionVO(
				$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
				$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
				$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
				$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
				$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
				$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE]));
			}
		} else {
			$lListeAdherent[0] = new ListeAdherentAdhesionVO();
		}
		return $lListeAdherent;
	}
	
	/**
	 * @name selectNbAdherentSurAdhesion($pIdAdhesion)
	 * @param integer
	 * @desc Récupère le nombre des adhérents actifs sur l'adhesion $pIdAdhesion
	 */
	public static function selectNbAdherentSurAdhesion($pIdAdhesion) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		// L'ensemble des adhérents (actifs ou supprimés) sur l'adhésion
		$lRequete = "SELECT count(1) AS NB_ADHESION
			 FROM " . AdherentManager::TABLE_ADHERENT . "
			 JOIN " . CompteManager::TABLE_COMPTE . " ON " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . " = " . CompteManager::CHAMP_COMPTE_ID . "
			 JOIN (
			 	SELECT "
			 		. AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
			 	FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			 	JOIN " . TypeAdhesionManager::TABLE_TYPEADHESION . "
				ON " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . "
			  	AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . " = 0
			  	AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . " = '" . StringUtils::securiser( $pIdAdhesion ) . "'
			  	WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0
			  ) ads
			 	ON " . AdherentManager::CHAMP_ADHERENT_ID . " = ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
			 	AND ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . " IS NOT NULL;";
			
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		$lNbAdherent = 0;
		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			$lNbAdherent = $lLigne['NB_ADHESION'];
		}
		return $lNbAdherent;
	}
	
	/**
	 * @name selectNbAdherentHorsAdhesion($pIdAdhesion)
	 * @param integer
	 * @desc Récupère le nombre des adhérents actifs qui ne sont pas sur l'adhesion $pIdAdhesion
	 */
	public static function selectNbAdherentHorsAdhesion($pIdAdhesion) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete = "SELECT count(1) AS NB_ADHESION
			 FROM " . AdherentManager::TABLE_ADHERENT . "
			 JOIN " . CompteManager::TABLE_COMPTE . " ON " . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . " = " . CompteManager::CHAMP_COMPTE_ID . "
			 LEFT JOIN (
			 	SELECT "
			 		. AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
			 	FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			 	JOIN " . TypeAdhesionManager::TABLE_TYPEADHESION . "
				ON " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . "
			  	AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . " = 0
			  	AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . " = '" . StringUtils::securiser( $pIdAdhesion ) . "'
			  	WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0
			  ) ads
			 	ON " . AdherentManager::CHAMP_ADHERENT_ID . " = ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
			 WHERE " . AdherentManager::CHAMP_ADHERENT_ETAT . " = 1 
			 	AND ads." . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . " IS NULL;";
			
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		$lNbAdherent = 0;
		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			$lNbAdherent = $lLigne['NB_ADHESION'];
		}
		return $lNbAdherent;
	}
	
	/**
	* @name rechercheAdherent( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AdherentVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AdherentVO
	*/
	public static function rechercheAdherent( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL .
			"," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE .
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL .
			"," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE .
			"," . AdherentManager::CHAMP_ADHERENT_ADRESSE .
			"," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL .
			"," . AdherentManager::CHAMP_ADHERENT_VILLE .
			"," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE .
			"," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION .
			"," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ .
			"," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE .  
			"," . AdherentManager::CHAMP_ADHERENT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AdherentManager::TABLE_ADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAdherent = array();

		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
		
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
		
					array_push($lListeAdherent,AdherentManager::remplirAdherent(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL],
						$lLigne[AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL],
						$lLigne[AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ADRESSE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_CODE_POSTAL],
						$lLigne[AdherentManager::CHAMP_ADHERENT_VILLE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_ADHESION],
						$lLigne[AdherentManager::CHAMP_ADHERENT_DATE_MAJ],
						$lLigne[AdherentManager::CHAMP_ADHERENT_COMMENTAIRE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ETAT]));
		
				}
			} else {
				$lListeAdherent[0] = new AdherentVO();
			}
			return $lListeAdherent;
		}
		
		$lListeAdherent[0] = new AdherentVO();
		return $lListeAdherent;
	}

	/**
	* @name remplirAdherent($pId, $pNumero, $pIdCompte, $pNom, $pPrenom, $pCourrielPrincipal, $pCourrielSecondaire, $pTelephonePrincipal, $pTelephoneSecondaire, $pAdresse, $pCodePostal, $pVille, $pDateNaissance, $pDateAdhesion, $pDateMaj, $pCommentaire, $pEtat)
	* @param int(11)
	* @param varchar(5)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(100)
	* @param varchar(100)
	* @param varchar(20)
	* @param varchar(20)
	* @param varchar(300)
	* @param varchar(10)
	* @param varchar(100)
	* @param date
	* @param date
	* @param datetime
	* @param text
	* @param tinyint(1)
	* @return AdherentVO
	* @desc Retourne une AdherentVO remplie
	*/
	private static function remplirAdherent($pId, $pNumero, $pIdCompte, $pNom, $pPrenom, $pCourrielPrincipal, $pCourrielSecondaire, $pTelephonePrincipal, $pTelephoneSecondaire, $pAdresse, $pCodePostal, $pVille, $pDateNaissance, $pDateAdhesion, $pDateMaj, $pCommentaire, $pEtat) {
		$lAdherent = new AdherentVO();
		$lAdherent->setId($pId);
		$lAdherent->setNumero($pNumero);
		$lAdherent->setIdCompte($pIdCompte);
		$lAdherent->setNom($pNom);
		$lAdherent->setPrenom($pPrenom);
		$lAdherent->setCourrielPrincipal($pCourrielPrincipal);
		$lAdherent->setCourrielSecondaire($pCourrielSecondaire);
		$lAdherent->setTelephonePrincipal($pTelephonePrincipal);
		$lAdherent->setTelephoneSecondaire($pTelephoneSecondaire);
		$lAdherent->setAdresse($pAdresse);
		$lAdherent->setCodePostal($pCodePostal);
		$lAdherent->setVille($pVille);
		$lAdherent->setDateNaissance($pDateNaissance);
		$lAdherent->setDateAdhesion($pDateAdhesion);
		$lAdherent->setDateMaj($pDateMaj);
		$lAdherent->setCommentaire($pCommentaire);
		$lAdherent->setEtat($pEtat);
				
		return $lAdherent;
	}

	/**
	* @name insert($pVo)
	* @param AdherentVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la AdherentVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete =
			"INSERT INTO " . AdherentManager::TABLE_ADHERENT . "
				(" . AdherentManager::CHAMP_ADHERENT_ID . "
				," . AdherentManager::CHAMP_ADHERENT_NUMERO . "
				," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . "
				," . AdherentManager::CHAMP_ADHERENT_NOM . "
				," . AdherentManager::CHAMP_ADHERENT_PRENOM . "
				," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . "
				," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE . "
				," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL . "
				," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE . "
				," . AdherentManager::CHAMP_ADHERENT_ADRESSE . "
				," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL . "
				," . AdherentManager::CHAMP_ADHERENT_VILLE . "
				," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE . "
				," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION . "
				," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ . "
				," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE . "				
				," . AdherentManager::CHAMP_ADHERENT_ETAT . ")
				VALUES (NULL
					,''
					,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
					,'" . StringUtils::securiser( $pVo->getNom() ) . "'
					,'" . StringUtils::securiser( $pVo->getPrenom() ) . "'
					,'" . StringUtils::securiser( $pVo->getCourrielPrincipal() ) . "'
					,'" . StringUtils::securiser( $pVo->getCourrielSecondaire() ) . "'
					,'" . StringUtils::securiser( $pVo->getTelephonePrincipal() ) . "'
					,'" . StringUtils::securiser( $pVo->getTelephoneSecondaire() ) . "'
					,'" . StringUtils::securiser( $pVo->getAdresse() ) . "'
					,'" . StringUtils::securiser( $pVo->getCodePostal() ) . "'
					,'" . StringUtils::securiser( $pVo->getVille() ) . "'
					,'" . StringUtils::securiser( $pVo->getDateNaissance() ) . "'
					,'" . StringUtils::securiser( $pVo->getDateAdhesion() ) . "'
					,'" . StringUtils::securiser( $pVo->getDateMaj() ) . "'
					,'" . StringUtils::securiser( $pVo->getCommentaire() ) . "'
					,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete); // Execution de la requete et récupération de l'Id généré par la BDD
	}

	/**
	* @name update($pVo)
	* @param AdherentVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du AdherentVO, avec les informations du AdherentVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = 
			"UPDATE " . AdherentManager::TABLE_ADHERENT . " 
			SET
				" . AdherentManager::CHAMP_ADHERENT_NUMERO . " = '" . StringUtils::securiser( $pVo->getNumero() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_PRENOM . " = '" . StringUtils::securiser( $pVo->getPrenom() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . " = '" . StringUtils::securiser( $pVo->getCourrielPrincipal() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE . " = '" . StringUtils::securiser( $pVo->getCourrielSecondaire() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL . " = '" . StringUtils::securiser( $pVo->getTelephonePrincipal() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE . " = '" . StringUtils::securiser( $pVo->getTelephoneSecondaire() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_ADRESSE . " = '" . StringUtils::securiser( $pVo->getAdresse() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL . " = '" . StringUtils::securiser( $pVo->getCodePostal() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_VILLE . " = '" . StringUtils::securiser( $pVo->getVille() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE . " = '" . StringUtils::securiser( $pVo->getDateNaissance() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION . " = '" . StringUtils::securiser( $pVo->getDateAdhesion() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ . " = '" . StringUtils::securiser( $pVo->getDateMaj() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE . " = '" . StringUtils::securiser( $pVo->getCommentaire() ) . "'
				," . AdherentManager::CHAMP_ADHERENT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . AdherentManager::TABLE_ADHERENT . "
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>
