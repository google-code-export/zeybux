<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/11/2010
// Fichier : GestionCommandeListeReservationViewManager.php
//
// Description : Classe de gestion des ListeAdherentCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "GestionCommandeListeReservationViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

/**
 * @name GestionCommandeListeReservationViewManager
 * @author Julien PIERRE
 * @since 17/11/2010
 * 
 * @desc Classe permettant l'accès aux données des ListeAdherentCommande
 */
class GestionCommandeListeReservationViewManager
{
	const VUE_GESTIONCOMMANDELISTE_RESERVATION = "view_gestion_commande_liste_reservation";

	/**
	* @name select($pId)
	* @param integer
	* @return GestionCommandeListeReservationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une GestionCommandeListeReservationViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . "
			FROM " . GestionCommandeListeReservationViewManager::VUE_GESTIONCOMMANDELISTE_RESERVATION . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lGestionCommandeListeReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lGestionCommandeListeReservation,
					GestionCommandeListeReservationViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
			}
		} else {
			$lGestionCommandeListeReservation[0] = new GestionCommandeListeReservationViewVO();
		}
		return $lGestionCommandeListeReservation;
	}

	/**
	* @name selectAll()
	* @return array(GestionCommandeListeReservationViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de GestionCommandeListeReservationViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID .  
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . "
			FROM " . GestionCommandeListeReservationViewManager::VUE_GESTIONCOMMANDELISTE_RESERVATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lGestionCommandeListeReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lGestionCommandeListeReservation,
					GestionCommandeListeReservationViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
			}
		} else {
			$lGestionCommandeListeReservation[0] = new GestionCommandeListeReservationViewVO();
		}
		return $lGestionCommandeListeReservation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(GestionCommandeListeReservationViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de GestionCommandeListeReservationViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(GestionCommandeListeReservationViewManager::VUE_GESTIONCOMMANDELISTE_RESERVATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lGestionCommandeListeReservation = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lGestionCommandeListeReservation,
						GestionCommandeListeReservationViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
				}
			} else {
				$lGestionCommandeListeReservation[0] = new GestionCommandeListeReservationViewVO();
			}
	
			return $lGestionCommandeListeReservation;
		}

		$lGestionCommandeListeReservation[0] = new GestionCommandeListeReservationViewVO();
		return $lGestionCommandeListeReservation;
	}

	/**
	* @name remplir($pComId, $pComNumero, $pAdhId, $pAdhNumero, $pAdhLabelCompte, $pAdhNom, $pAdhPrenom)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(5)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @return GestionCommandeListeReservationViewVO
	* @desc Retourne une GestionCommandeListeReservationViewVO remplie
	*/
	private static function remplir($pComId, $pComNumero, $pAdhId, $pAdhNumero, $pAdhLabelCompte, $pAdhNom, $pAdhPrenom) {
		$lGestionCommandeListeReservation = new GestionCommandeListeReservationViewVO();
		$lGestionCommandeListeReservation->setComId($pComId);
		$lGestionCommandeListeReservation->setComNumero($pComNumero);
		$lGestionCommandeListeReservation->setAdhId($pAdhId);
		$lGestionCommandeListeReservation->setAdhNumero($pAdhNumero);
		$lGestionCommandeListeReservation->setAdhLabelCompte($pAdhLabelCompte);
		$lGestionCommandeListeReservation->setAdhNom($pAdhNom);
		$lGestionCommandeListeReservation->setAdhPrenom($pAdhPrenom);
		return $lGestionCommandeListeReservation;
	}
}
?>