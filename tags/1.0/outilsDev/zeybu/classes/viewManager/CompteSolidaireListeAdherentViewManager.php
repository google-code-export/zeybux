<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/07/2011
// Fichier : CompteSolidaireListeAdherentViewManager.php
//
// Description : Classe de gestion des CompteSolidaireListeAdherent
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CompteSolidaireListeAdherentViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

/**
 * @name CompteSolidaireListeAdherentViewManager
 * @author Julien PIERRE
 * @since 02/07/2011
 * 
 * @desc Classe permettant l'accès aux données des CompteSolidaireListeAdherent
 */
class CompteSolidaireListeAdherentViewManager
{
	const VUE_COMPTESOLIDAIRELISTEADHERENT = "view_compte_solidaire_liste_adherent";

	/**
	* @name select($pId)
	* @param integer
	* @return CompteSolidaireListeAdherentViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CompteSolidaireListeAdherentViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . "
			FROM " . CompteSolidaireListeAdherentViewManager::VUE_COMPTESOLIDAIRELISTEADHERENT . " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteSolidaireListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteSolidaireListeAdherent,
					CompteSolidaireListeAdherentViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
			}
		} else {
			$lListeCompteSolidaireListeAdherent[0] = new CompteSolidaireListeAdherentViewVO();
		}
		return $lListeCompteSolidaireListeAdherent;
	}

	/**
	* @name selectAll()
	* @return array(CompteSolidaireListeAdherentViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CompteSolidaireListeAdherentViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . "
			FROM " . CompteSolidaireListeAdherentViewManager::VUE_COMPTESOLIDAIRELISTEADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteSolidaireListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteSolidaireListeAdherent,
					CompteSolidaireListeAdherentViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
			}
		} else {
			$lListeCompteSolidaireListeAdherent[0] = new CompteSolidaireListeAdherentViewVO();
		}
		return $lListeCompteSolidaireListeAdherent;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CompteSolidaireListeAdherentViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CompteSolidaireListeAdherentViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CompteSolidaireListeAdherentViewManager::VUE_COMPTESOLIDAIRELISTEADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCompteSolidaireListeAdherent = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCompteSolidaireListeAdherent,
						CompteSolidaireListeAdherentViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
				}
			} else {
				$lListeCompteSolidaireListeAdherent[0] = new CompteSolidaireListeAdherentViewVO();
			}

			return $lListeCompteSolidaireListeAdherent;
		}

		$lListeCompteSolidaireListeAdherent[0] = new CompteSolidaireListeAdherentViewVO();
		return $lListeCompteSolidaireListeAdherent;
	}

	/**
	* @name remplir($pAdhId, $pAdhNumero, $pCptLabel, $pAdhNom, $pAdhPrenom)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(30)
	* @param varchar(50)
	* @param varchar(50)
	* @return CompteSolidaireListeAdherentViewVO
	* @desc Retourne une CompteSolidaireListeAdherentViewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhNumero, $pCptLabel, $pAdhNom, $pAdhPrenom) {
		$lCompteSolidaireListeAdherent = new CompteSolidaireListeAdherentViewVO();
		$lCompteSolidaireListeAdherent->setAdhId($pAdhId);
		$lCompteSolidaireListeAdherent->setAdhNumero($pAdhNumero);
		$lCompteSolidaireListeAdherent->setCptLabel($pCptLabel);
		$lCompteSolidaireListeAdherent->setAdhNom($pAdhNom);
		$lCompteSolidaireListeAdherent->setAdhPrenom($pAdhPrenom);
		return $lCompteSolidaireListeAdherent;
	}
}
?>