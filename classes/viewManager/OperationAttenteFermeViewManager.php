<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : OperationAttenteFermeViewManager.php
//
// Description : Classe de gestion des OperationAttente
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "OperationAttenteFermeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");

define("VUE_OPERATIONATTENTE_FERME", MYSQL_DB_PREFIXE . "view_operation_attente_ferme");
/**
 * @name OperationAttenteFermeViewManager
 * @author Julien PIERRE
 * @since 12/05/2012
 * 
 * @desc Classe permettant l'accès aux données des OperationAttente
 */
class OperationAttenteFermeViewManager
{
	const VUE_OPERATIONATTENTE_FERME = VUE_OPERATIONATTENTE_FERME;

	/**
	* @name select($pId)
	* @param integer
	* @return OperationAttenteFermeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationAttenteFermeViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_NUMERO . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . CompteManager::CHAMP_COMPTE_SOLDE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE .  
			"," . OperationManager::CHAMP_OPERATION_ID_BANQUE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_ID . "
			FROM " . OperationAttenteFermeViewManager::VUE_OPERATIONATTENTE_FERME . " 
			WHERE " . FermeManager::CHAMP_FERME_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationAttente = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationAttente,
					OperationAttenteFermeViewManager::remplir(
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
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
			$lListeOperationAttente[0] = new OperationAttenteFermeViewVO();
		}
		return $lListeOperationAttente;
	}

	/**
	* @name selectAll()
	* @return array(OperationAttenteFermeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationAttenteFermeViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_NUMERO . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . CompteManager::CHAMP_COMPTE_SOLDE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE .  
			"," . OperationManager::CHAMP_OPERATION_ID_BANQUE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_ID . "
			FROM " . OperationAttenteFermeViewManager::VUE_OPERATIONATTENTE_FERME;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationAttente = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationAttente,
					OperationAttenteFermeViewManager::remplir(
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
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
			$lListeOperationAttente[0] = new OperationAttenteFermeViewVO();
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
	* @return array(OperationAttenteFermeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationAttenteFermeViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    FermeManager::CHAMP_FERME_ID .
			"," . FermeManager::CHAMP_FERME_NUMERO .
			"," . FermeManager::CHAMP_FERME_NOM .
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
		$lRequete = DbUtils::prepareRequeteRecherche(OperationAttenteFermeViewManager::VUE_OPERATIONATTENTE_FERME, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeOperationAttente = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeOperationAttente,
						OperationAttenteFermeViewManager::remplir(
						$lLigne[FermeManager::CHAMP_FERME_ID],
						$lLigne[FermeManager::CHAMP_FERME_NUMERO],
						$lLigne[FermeManager::CHAMP_FERME_NOM],
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
				$lListeOperationAttente[0] = new OperationAttenteFermeViewVO();
			}

			return $lListeOperationAttente;
		}

		$lListeOperationAttente[0] = new OperationAttenteFermeViewVO();
		return $lListeOperationAttente;
	}

	/**
	* @name remplir($pFerId, $pFerNumero, $pFerNom, $pCptLabel, $pCptSolde, $pOpeMontant, $pOpeTypePaiement, $pOpeTypePaiementChampComplementaire, $pOpeIdBanque, $pOpeDate, $pOpeLibelle, $pOpeId)
	* @param int(11)
	* @param varchar(20)
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
	* @return OperationAttenteFermeViewVO
	* @desc Retourne une OperationAttenteFermeViewVO remplie
	*/
	private static function remplir($pFerId, $pFerNumero, $pFerNom, $pCptLabel, $pCptSolde, $pOpeMontant, $pOpeTypePaiement, $pOpeTypePaiementChampComplementaire, $pOpeIdBanque, $pOpeDate, $pOpeLibelle, $pOpeId) {
		$lOperationAttente = new OperationAttenteFermeViewVO();
		$lOperationAttente->setFerId($pFerId);
		$lOperationAttente->setFerNumero($pFerNumero);
		$lOperationAttente->setFerNom($pFerNom);
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