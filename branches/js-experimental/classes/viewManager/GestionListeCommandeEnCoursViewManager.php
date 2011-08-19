<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/10/2010
// Fichier : GestionListeCommandeEnCoursViewManager.php
//
// Description : Classe de gestion des GestionListeCommandeEnCours
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "GestionListeCommandeEnCoursViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name GestionListeCommandeEnCoursViewManager
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe permettant l'accès aux données des GestionListeCommandeEnCours
 */
class GestionListeCommandeEnCoursViewManager
{
	const VUE_LISTECOMMANDEENCOURS = "view_gestion_liste_commande_en_cours";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeCommandeEnCoursViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeCommandeEnCoursViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
			FROM " . GestionListeCommandeEnCoursViewManager::VUE_LISTECOMMANDEENCOURS . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return GestionListeCommandeEnCoursViewManager::remplir(
				$pId,
				$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]);
		} else {
			return new GestionListeCommandeEnCoursViewVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(GestionListeCommandeEnCoursViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de GestionListeCommandeEnCoursViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
			FROM " . GestionListeCommandeEnCoursViewManager::VUE_LISTECOMMANDEENCOURS;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeGestionListeCommandeEnCours = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeGestionListeCommandeEnCours,
					GestionListeCommandeEnCoursViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
			}
		} else {
			$lListeGestionListeCommandeEnCours[0] = new GestionListeCommandeEnCoursViewVO();
		}
		return $lListeGestionListeCommandeEnCours;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(GestionListeCommandeEnCoursViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de GestionListeCommandeEnCoursViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID .
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(GestionListeCommandeEnCoursViewManager::VUE_LISTECOMMANDEENCOURS, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeGestionListeCommandeEnCours = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeGestionListeCommandeEnCours,
						GestionListeCommandeEnCoursViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
				}
			} else {
				$lListeGestionListeCommandeEnCours[0] = new GestionListeCommandeEnCoursViewVO();
			}
	
			return $lListeGestionListeCommandeEnCours;
		}

		$lListeGestionListeCommandeEnCours[0] = new GestionListeCommandeEnCoursViewVO();
		return $lListeGestionListeCommandeEnCours;
	}

	/**
	* @name remplir($pComId, $pComNumero, $pComDateFinReservation, $pComDateMarcheDebut, $pComDateMarcheFin)
	* @param int(11)
	* @param int(11)
	* @param datetime
	* @param datetime
	* @param datetime
	* @return GestionListeCommandeEnCoursViewVO
	* @desc Retourne une GestionListeCommandeEnCoursViewVO remplie
	*/
	private static function remplir($pComId, $pComNumero, $pComDateFinReservation, $pComDateMarcheDebut, $pComDateMarcheFin) {
		$lGestionListeCommandeEnCours = new GestionListeCommandeEnCoursViewVO();
		$lGestionListeCommandeEnCours->setComId($pComId);
		$lGestionListeCommandeEnCours->setComNumero($pComNumero);
		$lGestionListeCommandeEnCours->setComDateFinReservation($pComDateFinReservation);
		$lGestionListeCommandeEnCours->setComDateMarcheDebut($pComDateMarcheDebut);
		$lGestionListeCommandeEnCours->setComDateMarcheFin($pComDateMarcheFin);
		return $lGestionListeCommandeEnCours;
	}
}
?>