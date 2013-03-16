<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : OperationAttenteAdherentViewManager.php
//
// Description : Classe de gestion des OperationAttente
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "OperationAttenteAdherentViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");

define("VUE_OPERATIONATTENTE_ADHERENT", MYSQL_DB_PREFIXE . "view_operation_attente_adherent");
/**
 * @name OperationAttenteAdherentViewManager
 * @author Julien PIERRE
 * @since 12/05/2012
 * 
 * @desc Classe permettant l'accès aux données des OperationAttente
 */
class OperationAttenteAdherentViewManager
{
	const VUE_OPERATIONATTENTE_ADHERENT = VUE_OPERATIONATTENTE_ADHERENT;

	/**
	* @name select($pId)
	* @param integer
	* @return OperationAttenteViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationAttenteViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . CompteManager::CHAMP_COMPTE_SOLDE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . OperationManager::CHAMP_OPERATION_ID_BANQUE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_ID . "
			FROM " . OperationAttenteAdherentViewManager::VUE_OPERATIONATTENTE_ADHERENT . " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationAttente = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationAttente,
					OperationAttenteAdherentViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[OperationManager::CHAMP_OPERATION_ID_BANQUE],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_ID]));
			}
		} else {
			$lListeOperationAttente[0] = new OperationAttenteAdherentViewVO();
		}
		return $lListeOperationAttente;
	}

	/**
	* @name selectAll()
	* @return array(OperationAttenteAdherentViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationAttenteAdherentViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . CompteManager::CHAMP_COMPTE_SOLDE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE .  
			"," . OperationManager::CHAMP_OPERATION_ID_BANQUE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_ID . "
			FROM " . OperationAttenteAdherentViewManager::VUE_OPERATIONATTENTE_ADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationAttente = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationAttente,
					OperationAttenteAdherentViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[OperationManager::CHAMP_OPERATION_ID_BANQUE],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_ID]));
			}
		} else {
			$lListeOperationAttente[0] = new OperationAttenteAdherentViewVO();
		}
		return $lListeOperationAttente;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(OperationAttenteAdherentViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationAttenteAdherentViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . CompteManager::CHAMP_COMPTE_SOLDE .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT .
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . OperationManager::CHAMP_OPERATION_ID_BANQUE . 
			"," . OperationManager::CHAMP_OPERATION_DATE .
			"," . OperationManager::CHAMP_OPERATION_LIBELLE .
			"," . OperationManager::CHAMP_OPERATION_ID		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(OperationAttenteAdherentViewManager::VUE_OPERATIONATTENTE_ADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeOperationAttente = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeOperationAttente,
						OperationAttenteAdherentViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[CompteManager::CHAMP_COMPTE_SOLDE],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT],
						$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
						$lLigne[OperationManager::CHAMP_OPERATION_ID_BANQUE],
						$lLigne[OperationManager::CHAMP_OPERATION_DATE],
						$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
						$lLigne[OperationManager::CHAMP_OPERATION_ID]));
				}
			} else {
				$lListeOperationAttente[0] = new OperationAttenteAdherentViewVO();
			}

			return $lListeOperationAttente;
		}

		$lListeOperationAttente[0] = new OperationAttenteAdherentViewVO();
		return $lListeOperationAttente;
	}

	/**
	* @name remplir($pAdhId, $pAdhNumero, $pAdhNom, $pAdhPrenom, $pCptLabel, $pCptSolde, $pOpeMontant, $pOpeTypePaiement, $pOpeTypePaiementChampComplementaire, $pOpeIdBanque, $pOpeDate, $pOpeLibelle, $pOpeId)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(30)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param int(11)
	* @param varchar(50)
	* @param int(11)
	* @param datetime
	* @param varchar(100)
	* @param int(11)
	* @return OperationAttenteAdherentViewVO
	* @desc Retourne une OperationAttenteAdherentViewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhNumero, $pAdhNom, $pAdhPrenom, $pCptLabel, $pCptSolde, $pOpeMontant, $pOpeTypePaiement, $pOpeTypePaiementChampComplementaire, $pOpeIdBanque, $pOpeDate, $pOpeLibelle, $pOpeId) {
		$lOperationAttente = new OperationAttenteAdherentViewVO();
		$lOperationAttente->setAdhId($pAdhId);
		$lOperationAttente->setAdhNumero($pAdhNumero);
		$lOperationAttente->setAdhNom($pAdhNom);
		$lOperationAttente->setAdhPrenom($pAdhPrenom);
		$lOperationAttente->setCptLabel($pCptLabel);
		$lOperationAttente->setCptSolde($pCptSolde);
		$lOperationAttente->setOpeMontant($pOpeMontant);
		$lOperationAttente->setOpeTypePaiement($pOpeTypePaiement);
		$lOperationAttente->setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire);
		$lOperationAttente->setOpeIdBanque($pOpeIdBanque);
		$lOperationAttente->setOpeDate($pOpeDate);
		$lOperationAttente->setOpeLibelle($pOpeLibelle);
		$lOperationAttente->setOpeId($pOpeId);
		return $lOperationAttente;
	}
}
?>