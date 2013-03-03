<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitProducteurViewManager.php
//
// Description : Classe de gestion des NomProduitProducteur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "NomProduitProducteurViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitProducteurManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");

/**
 * @name NomProduitProducteurViewManager
 * @author Julien PIERRE
 * @since 03/11/2011
 * 
 * @desc Classe permettant l'accès aux données des NomProduitProducteur
 */
class NomProduitProducteurViewManager
{
	const VUE_NOMPRODUITPRODUCTEUR = "view_nom_produit_producteur";

	/**
	* @name select($pId)
	* @param integer
	* @return NomProduitProducteurViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une NomProduitProducteurViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE . "
			FROM " . NomProduitProducteurViewManager::VUE_NOMPRODUITPRODUCTEUR . " 
			WHERE " . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeNomProduitProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeNomProduitProducteur,
					NomProduitProducteurViewManager::remplir(
					$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE]));
			}
		} else {
			$lListeNomProduitProducteur[0] = new NomProduitProducteurViewVO();
		}
		return $lListeNomProduitProducteur;
	}

	/**
	* @name selectAll()
	* @return array(NomProduitProducteurViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de NomProduitProducteurViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE . "
			FROM " . NomProduitProducteurViewManager::VUE_NOMPRODUITPRODUCTEUR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeNomProduitProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeNomProduitProducteur,
					NomProduitProducteurViewManager::remplir(
					$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE]));
			}
		} else {
			$lListeNomProduitProducteur[0] = new NomProduitProducteurViewVO();
		}
		return $lListeNomProduitProducteur;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(NomProduitProducteurViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de NomProduitProducteurViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(NomProduitProducteurViewManager::VUE_NOMPRODUITPRODUCTEUR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeNomProduitProducteur = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeNomProduitProducteur,
						NomProduitProducteurViewManager::remplir(
						$lLigne[NomProduitProducteurManager::CHAMP_NOMPRODUITPRODUCTEUR_ID_NOM_PRODUIT],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE]));
				}
			} else {
				$lListeNomProduitProducteur[0] = new NomProduitProducteurViewVO();
			}

			return $lListeNomProduitProducteur;
		}

		$lListeNomProduitProducteur[0] = new NomProduitProducteurViewVO();
		return $lListeNomProduitProducteur;
	}

	/**
	* @name remplir($pNPrdtIdNomProduit, $pPrdtId, $pPrdtNom, $pPrdtPrenom, $pPrdtCommentaire)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param text
	* @return NomProduitProducteurViewVO
	* @desc Retourne une NomProduitProducteurViewVO remplie
	*/
	private static function remplir($pNPrdtIdNomProduit, $pPrdtId, $pPrdtNom, $pPrdtPrenom, $pPrdtCommentaire) {
		$lNomProduitProducteur = new NomProduitProducteurViewVO();
		$lNomProduitProducteur->setNPrdtIdNomProduit($pNPrdtIdNomProduit);
		$lNomProduitProducteur->setPrdtId($pPrdtId);
		$lNomProduitProducteur->setPrdtNom($pPrdtNom);
		$lNomProduitProducteur->setPrdtPrenom($pPrdtPrenom);
		$lNomProduitProducteur->setPrdtCommentaire($pPrdtCommentaire);
		return $lNomProduitProducteur;
	}
}
?>