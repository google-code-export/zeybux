<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeProduitCaracteristiqueViewManager.php
//
// Description : Classe de gestion des ListeProduitCaracteristique
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeProduitCaracteristiqueViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

/**
 * @name ListeProduitCaracteristiqueViewManager
 * @author Julien PIERRE
 * @since 01/11/2011
 * 
 * @desc Classe permettant l'accès aux données des ListeProduitCaracteristique
 */
class ListeProduitCaracteristiqueViewManager
{
	const VUE_LISTEPRODUITCARACTERISTIQUE = "view_liste_produit_caracteristique";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeProduitCaracteristiqueViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeProduitCaracteristiqueViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . "
			FROM " . ListeProduitCaracteristiqueViewManager::VUE_LISTEPRODUITCARACTERISTIQUE . " 
			WHERE " . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProduitCaracteristique = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProduitCaracteristique,
					ListeProduitCaracteristiqueViewManager::remplir(
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]));
			}
		} else {
			$lListeListeProduitCaracteristique[0] = new ListeProduitCaracteristiqueViewVO();
		}
		return $lListeListeProduitCaracteristique;
	}

	/**
	* @name selectAll()
	* @return array(ListeProduitCaracteristiqueViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeProduitCaracteristiqueViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE . 
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . "
			FROM " . ListeProduitCaracteristiqueViewManager::VUE_LISTEPRODUITCARACTERISTIQUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProduitCaracteristique = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProduitCaracteristique,
					ListeProduitCaracteristiqueViewManager::remplir(
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE],
					$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]));
			}
		} else {
			$lListeListeProduitCaracteristique[0] = new ListeProduitCaracteristiqueViewVO();
		}
		return $lListeListeProduitCaracteristique;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeProduitCaracteristiqueViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeProduitCaracteristiqueViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE .
			"," . CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeProduitCaracteristiqueViewManager::VUE_LISTEPRODUITCARACTERISTIQUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeProduitCaracteristique = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeProduitCaracteristique,
						ListeProduitCaracteristiqueViewManager::remplir(
						$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID_CARACTERISTIQUE],
						$lLigne[CaracteristiqueProduitManager::CHAMP_CARACTERISTIQUEPRODUIT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]));
				}
			} else {
				$lListeListeProduitCaracteristique[0] = new ListeProduitCaracteristiqueViewVO();
			}

			return $lListeListeProduitCaracteristique;
		}

		$lListeListeProduitCaracteristique[0] = new ListeProduitCaracteristiqueViewVO();
		return $lListeListeProduitCaracteristique;
	}

	/**
	* @name remplir($pCarProIdCaracteristique, $pCarProId, $pNproId, $pNproNom)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @return ListeProduitCaracteristiqueViewVO
	* @desc Retourne une ListeProduitCaracteristiqueViewVO remplie
	*/
	private static function remplir($pCarProIdCaracteristique, $pCarProId, $pNproId, $pNproNom) {
		$lListeProduitCaracteristique = new ListeProduitCaracteristiqueViewVO();
		$lListeProduitCaracteristique->setCarProIdCaracteristique($pCarProIdCaracteristique);
		$lListeProduitCaracteristique->setCarProId($pCarProId);
		$lListeProduitCaracteristique->setNproId($pNproId);
		$lListeProduitCaracteristique->setNproNom($pNproNom);
		return $lListeProduitCaracteristique;
	}
}
?>