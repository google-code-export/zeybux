<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/01/2011
// Fichier : ListeProducteurCommandeViewManager.php
//
// Description : Classe de gestion des ListeProducteurCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeProducteurCommandeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");

/**
 * @name ListeProducteurCommandeViewManager
 * @author Julien PIERRE
 * @since 03/01/2011
 * 
 * @desc Classe permettant l'accès aux données des ListeProducteurCommande
 */
class ListeProducteurCommandeViewManager
{
	const VUE_LISTEPRODUCTEURCOMMANDE = "view_liste_producteur_commande";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeProducteurCommandeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeProducteurCommandeViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . "
			FROM " . ListeProducteurCommandeViewManager::VUE_LISTEPRODUCTEURCOMMANDE . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProducteurCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProducteurCommande,
					ListeProducteurCommandeViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM]));
			}
		} else {
			$lListeListeProducteurCommande[0] = new ListeProducteurCommandeViewVO();
		}
		return $lListeListeProducteurCommande;
	}

	/**
	* @name selectAll()
	* @return array(ListeProducteurCommandeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeProducteurCommandeViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . "
			FROM " . ListeProducteurCommandeViewManager::VUE_LISTEPRODUCTEURCOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProducteurCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProducteurCommande,
					ListeProducteurCommandeViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM]));
			}
		} else {
			$lListeListeProducteurCommande[0] = new ListeProducteurCommandeViewVO();
		}
		return $lListeListeProducteurCommande;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeProducteurCommandeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeProducteurCommandeViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeProducteurCommandeViewManager::VUE_LISTEPRODUCTEURCOMMANDE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeProducteurCommande = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeProducteurCommande,
						ListeProducteurCommandeViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM]));
				}
			} else {
				$lListeListeProducteurCommande[0] = new ListeProducteurCommandeViewVO();
			}

			return $lListeListeProducteurCommande;
		}

		$lListeListeProducteurCommande[0] = new ListeProducteurCommandeViewVO();
		return $lListeListeProducteurCommande;
	}

	/**
	* @name remplir($pComId, $pPrdtId, $pPrdtNom, $pPrdtPrenom)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @return ListeProducteurCommandeViewVO
	* @desc Retourne une ListeProducteurCommandeViewVO remplie
	*/
	private static function remplir($pComId, $pPrdtId, $pPrdtNom, $pPrdtPrenom) {
		$lListeProducteurCommande = new ListeProducteurCommandeViewVO();
		$lListeProducteurCommande->setComId($pComId);
		$lListeProducteurCommande->setPrdtId($pPrdtId);
		$lListeProducteurCommande->setPrdtNom($pPrdtNom);
		$lListeProducteurCommande->setPrdtPrenom($pPrdtPrenom);
		return $lListeProducteurCommande;
	}
}
?>