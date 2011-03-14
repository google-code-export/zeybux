<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/09/2010
// Fichier : CommandeCompleteEnCoursViewManager.php
//
// Description : Classe de gestion des CommandeCompleteEnCours
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CommandeCompleteEnCoursViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

/**
 * @name CommandeCompleteEnCoursViewManager
 * @author Julien PIERRE
 * @since 18/09/2010
 * 
 * @desc Classe permettant l'accès aux données des CommandeCompleteEnCours
 */
class CommandeCompleteEnCoursViewManager
{
	const VUE_COMMANDECOMPLETEENCOURS = "view_commande_complete_en_cours";

	/**
	* @name select($pId)
	* @param integer
	* @return CommandeCompleteEnCoursViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CommandeCompleteEnCoursViewVO contenant les informations et la renvoie
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
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . "
			FROM " . CommandeCompleteEnCoursViewManager::VUE_COMMANDECOMPLETEENCOURS . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCommandeCompleteEnCours = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCommandeCompleteEnCours,
					CommandeCompleteEnCoursViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DESCRIPTION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX]));
			}
		} else {
			$lListeCommandeCompleteEnCours[0] = new CommandeCompleteEnCoursViewVO();
		}
		return $lListeCommandeCompleteEnCours;
	}

	/**
	* @name selectAll()
	* @return array(CommandeCompleteEnCoursViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CommandeCompleteEnCoursViewVO
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
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR .  
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . "
			FROM " . CommandeCompleteEnCoursViewManager::VUE_COMMANDECOMPLETEENCOURS;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCommandeCompleteEnCours = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCommandeCompleteEnCours,
					CommandeCompleteEnCoursViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DESCRIPTION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX]));
			}
		} else {
			$lListeCommandeCompleteEnCours[0] = new CommandeCompleteEnCoursViewVO();
		}
		return $lListeCommandeCompleteEnCours;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CommandeCompleteEnCoursViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CommandeCompleteEnCoursViewVO
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
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CommandeCompleteEnCoursViewManager::VUE_COMMANDECOMPLETEENCOURS, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCommandeCompleteEnCours = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeCommandeCompleteEnCours,
						CommandeCompleteEnCoursViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DESCRIPTION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX]));
				}
			} else {
				$lListeCommandeCompleteEnCours[0] = new CommandeCompleteEnCoursViewVO();
			}
	
			return $lListeCommandeCompleteEnCours;
		}
	
		$lListeCommandeCompleteEnCours[0] = new CommandeCompleteEnCoursViewVO();
		return $lListeCommandeCompleteEnCours;
	}

	/**
	* @name remplir($pComId, $pComNumero, $pComNom, $pComDescription, $pComDateMarcheDebut, $pComDateMarcheFin, $pComDateFinReservation, $pComArchive, $pProId, $pProIdCommande, $pProIdNomProduit, $pProUniteMesure, $pProMaxProduitCommande, $pProIdProducteur, $pNproId, $pNproNom, $pNproDescription, $pNproIdCategorie, $pDcomId, $pDcomIdProduit, $pDcomTaille, $pDcomPrix)
	* @param int(11)
	* @param int(11)
	* @param varchar(100)
	* @param text
	* @param datetime
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param decimal(10,2)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param text
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @return CommandeCompleteEnCoursViewVO
	* @desc Retourne une CommandeCompleteEnCoursViewVO remplie
	*/
	private static function remplir($pComId, $pComNumero, $pComNom, $pComDescription, $pComDateMarcheDebut, $pComDateMarcheFin, $pComDateFinReservation, $pComArchive, $pProId, $pProIdCommande, $pProIdNomProduit, $pProUniteMesure, $pProMaxProduitCommande, $pProIdProducteur, $pNproId, $pNproNom, $pNproDescription, $pNproIdCategorie, $pDcomId, $pDcomIdProduit, $pDcomTaille, $pDcomPrix) {
		$lCommandeCompleteEnCours = new CommandeCompleteEnCoursViewVO();
		$lCommandeCompleteEnCours->setComId($pComId);
		$lCommandeCompleteEnCours->setComNumero($pComNumero);
		$lCommandeCompleteEnCours->setComNom($pComNom);
		$lCommandeCompleteEnCours->setComDescription($pComDescription);
		$lCommandeCompleteEnCours->setComDateMarcheDebut($pComDateMarcheDebut);
		$lCommandeCompleteEnCours->setComDateMarcheFin($pComDateMarcheFin);
		$lCommandeCompleteEnCours->setComDateFinReservation($pComDateFinReservation);
		$lCommandeCompleteEnCours->setComArchive($pComArchive);
		$lCommandeCompleteEnCours->setProId($pProId);
		$lCommandeCompleteEnCours->setProIdCommande($pProIdCommande);
		$lCommandeCompleteEnCours->setProIdNomProduit($pProIdNomProduit);
		$lCommandeCompleteEnCours->setProUniteMesure($pProUniteMesure);
		$lCommandeCompleteEnCours->setProMaxProduitCommande($pProMaxProduitCommande);
		$lCommandeCompleteEnCours->setProIdProducteur($pProIdProducteur);
		$lCommandeCompleteEnCours->setNproId($pNproId);
		$lCommandeCompleteEnCours->setNproNom($pNproNom);
		$lCommandeCompleteEnCours->setNproDescription($pNproDescription);
		$lCommandeCompleteEnCours->setNproIdCategorie($pNproIdCategorie);
		$lCommandeCompleteEnCours->setDcomId($pDcomId);
		$lCommandeCompleteEnCours->setDcomIdProduit($pDcomIdProduit);
		$lCommandeCompleteEnCours->setDcomTaille($pDcomTaille);
		$lCommandeCompleteEnCours->setDcomPrix($pDcomPrix);
		return $lCommandeCompleteEnCours;
	}
}
?>