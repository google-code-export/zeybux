<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/11/2011
// Fichier : ListeProducteurMarcheViewManager.php
//
// Description : Classe de gestion des ListeProducteurMarche
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeProducteurMarcheViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");

/**
 * @name ListeProducteurMarcheViewManager
 * @author Julien PIERRE
 * @since 09/11/2011
 * 
 * @desc Classe permettant l'accès aux données des ListeProducteurMarche
 */
class ListeProducteurMarcheViewManager
{
	const VUE_LISTEPRODUCTEURMARCHE = "view_liste_producteur_marche";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeProducteurMarcheViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeProducteurMarcheViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . FermeManager::CHAMP_FERME_NOM . "
			FROM " . ListeProducteurMarcheViewManager::VUE_LISTEPRODUCTEURMARCHE . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProducteurMarche = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProducteurMarche,
					ListeProducteurMarcheViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[FermeManager::CHAMP_FERME_NOM]));
			}
		} else {
			$lListeListeProducteurMarche[0] = new ListeProducteurMarcheViewVO();
		}
		return $lListeListeProducteurMarche;
	}

	/**
	* @name selectAll()
	* @return array(ListeProducteurMarcheViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeProducteurMarcheViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . FermeManager::CHAMP_FERME_NOM . "
			FROM " . ListeProducteurMarcheViewManager::VUE_LISTEPRODUCTEURMARCHE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProducteurMarche = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProducteurMarche,
					ListeProducteurMarcheViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[FermeManager::CHAMP_FERME_NOM]));
			}
		} else {
			$lListeListeProducteurMarche[0] = new ListeProducteurMarcheViewVO();
		}
		return $lListeListeProducteurMarche;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeProducteurMarcheViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeProducteurMarcheViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
			"," . FermeManager::CHAMP_FERME_NOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeProducteurMarcheViewManager::VUE_LISTEPRODUCTEURMARCHE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeProducteurMarche = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeProducteurMarche,
						ListeProducteurMarcheViewManager::remplir(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
						$lLigne[FermeManager::CHAMP_FERME_NOM]));
				}
			} else {
				$lListeListeProducteurMarche[0] = new ListeProducteurMarcheViewVO();
			}

			return $lListeListeProducteurMarche;
		}

		$lListeListeProducteurMarche[0] = new ListeProducteurMarcheViewVO();
		return $lListeListeProducteurMarche;
	}

	/**
	* @name remplir($pProIdCommande, $pProIdCompteFerme, $pFerNom)
	* @param int(11)
	* @param int(11)
	* @param text
	* @return ListeProducteurMarcheViewVO
	* @desc Retourne une ListeProducteurMarcheViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdCompteFerme, $pFerNom) {
		$lListeProducteurMarche = new ListeProducteurMarcheViewVO();
		$lListeProducteurMarche->setProIdCommande($pProIdCommande);
		$lListeProducteurMarche->setProIdCompteFerme($pProIdCompteFerme);
		$lListeProducteurMarche->setFerNom($pFerNom);
		return $lListeProducteurMarche;
	}
}
?>