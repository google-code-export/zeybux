<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/10/2013
// Fichier : AdhesionAdherentManager.php
//
// Description : Classe de gestion des AdhesionAdherent
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "AdhesionAdherentVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeAdhesionVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");

define("TABLE_ADHESIONADHERENT", MYSQL_DB_PREFIXE ."adad_adhesion_adherent");
/**
 * @name AdhesionAdherentManager
 * @author Julien PIERRE
 * @since 30/10/2013
 * 
 * @desc Classe permettant l'accès aux données des AdhesionAdherent
 */
class AdhesionAdherentManager
{
	const TABLE_ADHESIONADHERENT = TABLE_ADHESIONADHERENT;
	const CHAMP_ADHESIONADHERENT_ID = "adad_id";
	const CHAMP_ADHESIONADHERENT_ID_ADHERENT = "adad_id_adherent";
	const CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION = "adad_id_type_adhesion";
	const CHAMP_ADHESIONADHERENT_ID_OPERATION = "adad_id_operation";
	const CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE = "adad_statut_formulaire";
	const CHAMP_ADHESIONADHERENT_DATE_CREATION = "adad_date_creation";
	const CHAMP_ADHESIONADHERENT_DATE_MODIFICATION = "adad_date_modification";
	const CHAMP_ADHESIONADHERENT_ETAT = "adad_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return AdhesionAdherentVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AdhesionAdherentVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_CREATION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . "
			FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . " 
			WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return AdhesionAdherentManager::remplirAdhesionAdherent(
				$pId,
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_CREATION],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT]);
		} else {
			return new AdhesionAdherentVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(AdhesionAdherentVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AdhesionAdherentVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_CREATION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . "
			FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdhesionAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAdhesionAdherent,
					AdhesionAdherentManager::remplirAdhesionAdherent(
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_CREATION],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT]));
			}
		} else {
			$lListeAdhesionAdherent[0] = new AdhesionAdherentVO();
		}
		return $lListeAdhesionAdherent;
	}
	
	/**
	 * @name selectAdherentSurTypeAdhesion($pId)
	 * @param integer
	 * @return array(AdherentVO)
	 * @desc Récupère la liste des adhérents sur un type d'adhésion
	 */
	public static function selectAdherentSurTypeAdhesion($pId) {
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
			FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			JOIN " . AdherentManager::TABLE_ADHERENT . "
				ON " . AdherentManager::CHAMP_ADHERENT_ID . " = " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
				AND " . AdherentManager::CHAMP_ADHERENT_ETAT . " = 1  	
			WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . " = '" . StringUtils::securiser($pId) . "'
				AND " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0;";
	
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAdherent,
				new AdherentVO(
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
	
	/**
	 * @name existeAdherentSurTypeAdhesion($pId)
	 * @param integer
	 * @return bool
	 * @desc Récupère la liste des adhérents sur un type d'adhésion
	 */
	public static function existeAdherentSurTypeAdhesion($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
	
		$lRequete =
		"SELECT "
				. AdherentManager::CHAMP_ADHERENT_ID . "
			FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			JOIN " . AdherentManager::TABLE_ADHERENT . "
				ON " . AdherentManager::CHAMP_ADHERENT_ID . " = " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
				AND " . AdherentManager::CHAMP_ADHERENT_ETAT . " = 1
			WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . " = '" . StringUtils::securiser($pId) . "'
				AND " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0;";
	
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		return mysql_num_rows($lSql) > 0;
	}

	/**
	 * @name adhesionSurAdherent($pIdAdherent)
	 * @param integer
	 * @return 
	 * @desc Récupère la liste des adhésion sur un adhérent
	 */
	public static function adhesionSurAdherent($pIdAdherent) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
	
		$lRequete =
		"SELECT "
				. AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . 
			"," . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT . 
			"," . AdhesionManager::CHAMP_ADHESION_LABEL . 
			"," . AdhesionManager::CHAMP_ADHESION_DATE_DEBUT . 
			"," . AdhesionManager::CHAMP_ADHESION_DATE_FIN . "
		FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
		JOIN " . TypeAdhesionManager::TABLE_TYPEADHESION . "
			ON " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . "
			AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . " = 0
		JOIN " . PerimetreAdhesionManager::TABLE_PERIMETREADHESION . "
			ON " . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ID . " = " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_PERIMETRE . "
			AND " . PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT . " = 0
		JOIN " . AdhesionManager::TABLE_ADHESION . "
			ON " . AdhesionManager::CHAMP_ADHESION_ID . " = " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . "
			AND " . AdhesionManager::CHAMP_ADHESION_ETAT . " = 0
		WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . " = '" . StringUtils::securiser($pIdAdherent) . "'
			AND " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0;";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeAdhesion = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAdhesion,
				new ListeAdhesionVO(
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID],
				$lLigne[PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL],
				$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION],
				$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL],
				$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT],
				$lLigne[AdhesionManager::CHAMP_ADHESION_LABEL],
				$lLigne[AdhesionManager::CHAMP_ADHESION_DATE_DEBUT],
				$lLigne[AdhesionManager::CHAMP_ADHESION_DATE_FIN]));
			}
		} else {
			$lListeAdhesion[0] = new ListeAdhesionVO();
		}
		return $lListeAdhesion;		
	}
	
	/**
	 * @name nbAdhesionEnCoursSurAdherent($pIdAdherent)
	 * @param integer
	 * @return
	 * @desc Récupère le nombre d'adhésion en cours sur un adhérent
	 */
	public static function nbAdhesionEnCoursSurAdherent($pIdAdherent) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
	
		$lRequete =
		"SELECT count(1) as Nb
		FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
		JOIN " . TypeAdhesionManager::TABLE_TYPEADHESION . " 
			ON " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . " 
			AND " . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . " = 0
		JOIN " . AdhesionManager::TABLE_ADHESION . "
			ON " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . " = " . AdhesionManager::CHAMP_ADHESION_ID . "
			AND " . AdhesionManager::CHAMP_ADHESION_ETAT . " = 0
			AND " . AdhesionManager::CHAMP_ADHESION_DATE_DEBUT . " <= now()
			AND " . AdhesionManager::CHAMP_ADHESION_DATE_FIN . " >= now()
		WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . " = '" . StringUtils::securiser($pIdAdherent) . "'
			AND " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0;";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lLigne = mysql_fetch_assoc($lSql);
		return $lLigne['Nb'];
	}
	
	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AdhesionAdherentVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AdhesionAdherentVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_CREATION .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AdhesionAdherentManager::TABLE_ADHESIONADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAdhesionAdherent = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeAdhesionAdherent,
						AdhesionAdherentManager::remplirAdhesionAdherent(
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_CREATION],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT]));
				}
			} else {
				$lListeAdhesionAdherent[0] = new AdhesionAdherentVO();
			}

			return $lListeAdhesionAdherent;
		}

		$lListeAdhesionAdherent[0] = new AdhesionAdherentVO();
		return $lListeAdhesionAdherent;
	}

	/**
	* @name remplirAdhesionAdherent($pId, $pIdAdherent, $pIdTypeAdhesion, $pIdOperation, $pStatutFormulaire, $pDateCreation, $pDateModification, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param tinyint(1)
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return AdhesionAdherentVO
	* @desc Retourne une AdhesionAdherentVO remplie
	*/
	private static function remplirAdhesionAdherent($pId, $pIdAdherent, $pIdTypeAdhesion, $pIdOperation, $pStatutFormulaire, $pDateCreation, $pDateModification, $pEtat) {
		$lAdhesionAdherent = new AdhesionAdherentVO();
		$lAdhesionAdherent->setId($pId);
		$lAdhesionAdherent->setIdAdherent($pIdAdherent);
		$lAdhesionAdherent->setIdTypeAdhesion($pIdTypeAdhesion);
		$lAdhesionAdherent->setIdOperation($pIdOperation);
		$lAdhesionAdherent->setStatutFormulaire($pStatutFormulaire);
		$lAdhesionAdherent->setDateCreation($pDateCreation);
		$lAdhesionAdherent->setDateModification($pDateModification);
		$lAdhesionAdherent->setEtat($pEtat);
		return $lAdhesionAdherent;
	}

	/**
	* @name insert($pVo)
	* @param AdhesionAdherentVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la AdhesionAdherentVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
				(" . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_CREATION . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getIdAdherent() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdTypeAdhesion() ) . "'
				,'" . StringUtils::securiser( $lVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $lVo->getStatutFormulaire() ) . "'
				, now()
				,'" . StringUtils::securiser( $lVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $lVo->getEtat() ) . "')";

				if($lNbVO == $lI) {
					$lRequete .= ";";
				} else {
					$lRequete .= ",";
				}
				$lI++;
			}
		} else{
			$lRequete .= "(NULL
				,'" . StringUtils::securiser( $pVo->getIdAdherent() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdTypeAdhesion() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getStatutFormulaire() ) . "'
				, now()
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param AdhesionAdherentVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du AdhesionAdherentVO, avec les informations du AdhesionAdherentVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			 SET
				 " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . " = '" . StringUtils::securiser( $pVo->getIdAdherent() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . " = '" . StringUtils::securiser( $pVo->getIdTypeAdhesion() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . " = '" . StringUtils::securiser( $pVo->getStatutFormulaire() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_CREATION . " = '" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION . " = now()
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
	
	/**
	 * @name updateByIdOperation($pVo)
	 * @param AdhesionAdherentVO
	 * @desc Met à jour la ligne de la table, correspondant à l'idOperation du AdhesionAdherentVO, avec les informations du AdhesionAdherentVO
	 */
	public static function updateByIdOperation($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
	
		$lRequete =
		"UPDATE " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			 SET
				 " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . " = '" . StringUtils::securiser( $pVo->getIdTypeAdhesion() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_STATUT_FORMULAIRE . " = '" . StringUtils::securiser( $pVo->getStatutFormulaire() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION . " = now()
			 WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
			 	AND " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = 0;";
	
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
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

		$lRequete = "DELETE FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
	
	/**
	 * @name deleteByIdTypeAdhesion($pId)
	 * @param integer
	 * @desc Met au statut supprimé en fonction de l'id type adhésion
	 */
	public static function deleteByIdTypeAdhesion($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			 SET
				" . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION . " = now()
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = '1'
			 WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . " = '" . StringUtils::securiser( $pId ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
	
	/**
	 * @name deleteByIdOperation($pIdOperation)
	 * @param integer
	 * @desc Met au statut supprimé en fonction de l'id operation
	 */
	public static function deleteByIdOperation($pIdOperation) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			 SET
				" . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION . " = now()
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = '1'
			 WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . " = '" . StringUtils::securiser( $pIdOperation ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
	
	/**
	 * @name deleteByIdAdherent($pIdAdherent)
	 * @param integer
	 * @desc Met au statut supprimé en fonction de l'id Adherent
	 */
	public static function deleteByIdAdherent($pIdAdherent) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			 SET
				" . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_DATE_MODIFICATION . " = now()
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = '1'
			 WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT. " = '" . StringUtils::securiser( $pIdAdherent ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>