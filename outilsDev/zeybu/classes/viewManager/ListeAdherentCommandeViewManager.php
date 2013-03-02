<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : ListeAdherentCommandeViewManager.php
//
// Description : Classe de gestion des ListeAdherentCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeAdherentCommandeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

/**
 * @name ListeAdherentCommandeViewManager
 * @author Julien PIERRE
 * @since 12/09/2010
 * 
 * @desc Classe permettant l'accès aux données des ListeAdherentCommande
 */
class ListeAdherentCommandeViewManager
{
	const VUE_LISTEADHERENTCOMMANDE = "view_liste_adherent_commande";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeAdherentCommandeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeAdherentCommandeViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . "
			FROM " . ListeAdherentCommandeViewManager::VUE_LISTEADHERENTCOMMANDE . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeAdherentCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeAdherentCommande,
					ListeAdherentCommandeViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
			}
		} else {
			$lListeListeAdherentCommande[0] = new ListeAdherentCommandeViewVO();
		}
		return $lListeListeAdherentCommande;
	}

	/**
	* @name selectAll()
	* @return array(ListeAdherentCommandeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeAdherentCommandeViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . "
			FROM " . ListeAdherentCommandeViewManager::VUE_LISTEADHERENTCOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeAdherentCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeAdherentCommande,
					ListeAdherentCommandeViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
			}
		} else {
			$lListeListeAdherentCommande[0] = new ListeAdherentCommandeViewVO();
		}
		return $lListeListeAdherentCommande;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeAdherentCommandeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeAdherentCommandeViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID .
			"," . AdherentManager::CHAMP_ADHERENT_ID .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = CommandeManager::CHAMP_COMMANDE_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeAdherentCommandeViewManager::VUE_LISTEADHERENTCOMMANDE, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeAdherentCommande = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeListeAdherentCommande,
					ListeAdherentCommandeViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM]));
			}
		} else {
			$lListeListeAdherentCommande[0] = new ListeAdherentCommandeViewVO();
		}

		return $lListeListeAdherentCommande;
	}

	/**
	* @name remplirListeAdherentCommande($pComId, $pAdhId, $pAdhNumero, $pAdhLabelCompte, $pAdhNom, $pAdhPrenom)
	* @param int(11)
	* @param int(11)
	* @param varchar(5)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @return ListeAdherentCommandeViewVO
	* @desc Retourne une ListeAdherentCommandeViewVO remplie
	*/
	private static function remplir($pComId, $pAdhId, $pAdhNumero, $pAdhLabelCompte, $pAdhNom, $pAdhPrenom) {
		$lListeAdherentCommande = new ListeAdherentCommandeViewVO();
		$lListeAdherentCommande->setComId($pComId);
		$lListeAdherentCommande->setAdhId($pAdhId);
		$lListeAdherentCommande->setAdhNumero($pAdhNumero);
		$lListeAdherentCommande->setAdhLabelCompte($pAdhLabelCompte);
		$lListeAdherentCommande->setAdhNom($pAdhNom);
		$lListeAdherentCommande->setAdhPrenom($pAdhPrenom);
		return $lListeAdherentCommande;
	}
}
?>