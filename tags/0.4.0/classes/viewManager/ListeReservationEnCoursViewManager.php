<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/10/2010
// Fichier : ListeReservationEnCoursViewManager.php
//
// Description : Classe de gestion des ListeReservationEnCours
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeReservationEnCoursViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name ListeReservationEnCoursViewManager
 * @author Julien PIERRE
 * @since 04/10/2010
 * 
 * @desc Classe permettant l'accès aux données des ListeReservationEnCours
 */
class ListeReservationEnCoursViewManager
{
	const VUE_LISTERESERVATIONENCOURS = "view_liste_reservation_en_cours";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeReservationEnCoursViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeReservationEnCoursViewVO contenant les informations et la renvoie
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
			"," . AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU . 
			"," . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE . "
			FROM " . ListeReservationEnCoursViewManager::VUE_LISTERESERVATIONENCOURS . " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeReservationEnCours = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeReservationEnCours,
					ListeReservationEnCoursViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE]));
			}
		} else {
			$lListeListeReservationEnCours[0] = new ListeReservationEnCoursViewVO();
		}
		return $lListeListeReservationEnCours;
	}

	/**
	* @name selectAll()
	* @return array(ListeReservationEnCoursViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeReservationEnCoursViewVO
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
			"," . AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU . 
			"," . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE . "
			FROM " . ListeReservationEnCoursViewManager::VUE_LISTERESERVATIONENCOURS;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeReservationEnCours = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeReservationEnCours,
					ListeReservationEnCoursViewManager::remplir(
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE]));
			}
		} else {
			$lListeListeReservationEnCours[0] = new ListeReservationEnCoursViewVO();
		}
		return $lListeListeReservationEnCours;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeReservationEnCoursViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeReservationEnCoursViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE .
			"," . AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU .
			"," . CommandeManager::CHAMP_COMMANDE_ID .
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeReservationEnCoursViewManager::VUE_LISTERESERVATIONENCOURS, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeReservationEnCours = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeListeReservationEnCours,
						ListeReservationEnCoursViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU],
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE]));
				}
			} else {
				$lListeListeReservationEnCours[0] = new ListeReservationEnCoursViewVO();
			}
	
			return $lListeListeReservationEnCours;
		}

		$lListeListeReservationEnCours[0] = new ListeReservationEnCoursViewVO();
		return $lListeListeReservationEnCours;
	}

	/**
	* @name remplir($pAdhId, $pAdhNumero, $pAdhIdCompte, $pAdhSuperZeybu, $pComId, $pComNumero, $pComDateMarcheDebut, $pComDateMarcheFin, $pComDateFinReservation, $pComArchive)
	* @param int(11)
	* @param varchar(5)
	* @param int(11)
	* @param tinyint(1)
	* @param int(11)
	* @param int(11)
	* @param datetime
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return ListeReservationEnCoursViewVO
	* @desc Retourne une ListeReservationEnCoursViewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhNumero, $pAdhIdCompte, $pAdhSuperZeybu, $pComId, $pComNumero, $pComDateMarcheDebut, $pComDateMarcheFin, $pComDateFinReservation, $pComArchive) {
		$lListeReservationEnCours = new ListeReservationEnCoursViewVO();
		$lListeReservationEnCours->setAdhId($pAdhId);
		$lListeReservationEnCours->setAdhNumero($pAdhNumero);
		$lListeReservationEnCours->setAdhIdCompte($pAdhIdCompte);
		$lListeReservationEnCours->setAdhSuperZeybu($pAdhSuperZeybu);
		$lListeReservationEnCours->setComId($pComId);
		$lListeReservationEnCours->setComNumero($pComNumero);
		$lListeReservationEnCours->setComDateMarcheDebut($pComDateMarcheDebut);
		$lListeReservationEnCours->setComDateMarcheFin($pComDateMarcheFin);
		$lListeReservationEnCours->setComDateFinReservation($pComDateFinReservation);
		$lListeReservationEnCours->setComArchive($pComArchive);
		return $lListeReservationEnCours;
	}
}
?>