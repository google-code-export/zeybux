<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/02/2012
// Fichier : ListeAbonnesProduitViewManager.php
//
// Description : Classe de gestion des ListeAbonnesProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeAbonnesProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

define("VUE_LISTEABONNESPRODUIT", MYSQL_DB_PREFIXE . "view_liste_abonnes_produit");
/**
 * @name ListeAbonnesProduitViewManager
 * @author Julien PIERRE
 * @since 14/02/2012
 * 
 * @desc Classe permettant l'accès aux données des ListeAbonnesProduit
 */
class ListeAbonnesProduitViewManager
{
	const VUE_LISTEABONNESPRODUIT = VUE_LISTEABONNESPRODUIT;

	/**
	* @name select($pId)
	* @param integer
	* @return ListeAbonnesProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeAbonnesProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . "
			FROM " . ListeAbonnesProduitViewManager::VUE_LISTEABONNESPRODUIT . " 
			WHERE " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeAbonnesProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeAbonnesProduit,
					ListeAbonnesProduitViewManager::remplir(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
			}
		} else {
			$lListeListeAbonnesProduit[0] = new ListeAbonnesProduitViewVO();
		}
		return $lListeListeAbonnesProduit;
	}
	
	/**
	* @name selectByIdNomProduit($pId)
	* @param integer
	* @return ListeAbonnesProduitViewVO
	* @desc Récupère la ligne correspondant à l'id Nom Produit en paramètre, créé une ListeAbonnesProduitViewVO contenant les informations et la renvoie
	*/
	public static function selectByIdNomProduit($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . "
			FROM " . ListeAbonnesProduitViewManager::VUE_LISTEABONNESPRODUIT . " 
			WHERE " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeAbonnesProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeAbonnesProduit,
					ListeAbonnesProduitViewManager::remplir(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
			}
		} else {
			$lListeListeAbonnesProduit[0] = new ListeAbonnesProduitViewVO();
		}
		return $lListeListeAbonnesProduit;
	}

	/**
	* @name selectAll()
	* @return array(ListeAbonnesProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeAbonnesProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . AdherentManager::CHAMP_ADHERENT_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION ."
			FROM " . ListeAbonnesProduitViewManager::VUE_LISTEABONNESPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeAbonnesProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeAbonnesProduit,
					ListeAbonnesProduitViewManager::remplir(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
					$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
			}
		} else {
			$lListeListeAbonnesProduit[0] = new ListeAbonnesProduitViewVO();
		}
		return $lListeListeAbonnesProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeAbonnesProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeAbonnesProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE .
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . AdherentManager::CHAMP_ADHERENT_NOM .
			"," . AdherentManager::CHAMP_ADHERENT_PRENOM .	
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeAbonnesProduitViewManager::VUE_LISTEABONNESPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeAbonnesProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeAbonnesProduit,
						ListeAbonnesProduitViewManager::remplir(
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_PRENOM],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
				}
			} else {
				$lListeListeAbonnesProduit[0] = new ListeAbonnesProduitViewVO();
			}

			return $lListeListeAbonnesProduit;
		}

		$lListeListeAbonnesProduit[0] = new ListeAbonnesProduitViewVO();
		return $lListeListeAbonnesProduit;
	}

	/**
	* @name remplir($pCptAboIdProduitAbonnement, $pCptAboIdCompte, $pAdhNumero, $pCptLabel, $pAdhNom, $pAdhPrenom, $pCptAboQuantite, $pProAboIdNomProduit, $pCptAboDateDebutSuspension, $pCptAboDateFinSuspension)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(30)
	* @param varchar(50)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param int(11)
	* @param dateTime
	* @param dateTime
	* @return ListeAbonnesProduitViewVO
	* @desc Retourne une ListeAbonnesProduitViewVO remplie
	*/
	private static function remplir($pCptAboIdProduitAbonnement, $pCptAboIdCompte, $pAdhNumero, $pCptLabel, $pAdhNom, $pAdhPrenom, $pCptAboQuantite, $pProAboIdNomProduit, $pCptAboDateDebutSuspension, $pCptAboDateFinSuspension) {
		$lListeAbonnesProduit = new ListeAbonnesProduitViewVO();
		$lListeAbonnesProduit->setCptAboIdProduitAbonnement($pCptAboIdProduitAbonnement);
		$lListeAbonnesProduit->setCptAboIdCompte($pCptAboIdCompte);
		$lListeAbonnesProduit->setAdhNumero($pAdhNumero);
		$lListeAbonnesProduit->setCptLabel($pCptLabel);
		$lListeAbonnesProduit->setAdhNom($pAdhNom);
		$lListeAbonnesProduit->setAdhPrenom($pAdhPrenom);
		$lListeAbonnesProduit->setCptAboQuantite($pCptAboQuantite);
		$lListeAbonnesProduit->setProAboIdNomProduit($pProAboIdNomProduit);
		$lListeAbonnesProduit->setCptAboDateDebutSuspension($pCptAboDateDebutSuspension);
		$lListeAbonnesProduit->setCptAboDateFinSuspension($pCptAboDateFinSuspension);
		return $lListeAbonnesProduit;
	}
}
?>