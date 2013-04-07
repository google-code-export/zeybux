<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/03/2013
// Fichier : DetailProduitViewManager.php
//
// Description : Classe de gestion des DetailProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "DetailProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");

define("VUE_DETAILPRODUIT", MYSQL_DB_PREFIXE . "view_detail_produit");
/**
 * @name DetailProduitViewManager
 * @author Julien PIERRE
 * @since 24/03/2013
 * 
 * @desc Classe permettant l'accès aux données des DetailProduit
 */
class DetailProduitViewManager
{
	const VUE_DETAILPRODUIT = VUE_DETAILPRODUIT;

	/**
	* @name select($pId)
	* @param integer
	* @return DetailProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une DetailProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . 
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . 
			"," . ProduitManager::CHAMP_PRODUIT_TYPE . 
			"," . ProduitManager::CHAMP_PRODUIT_ETAT . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ETAT . "
			FROM " . DetailProduitViewManager::VUE_DETAILPRODUIT . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailProduit,
					DetailProduitViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION],
					$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL],
					$lLigne[ProduitManager::CHAMP_PRODUIT_TYPE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ETAT],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ETAT],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ETAT]));
			}
		} else {
			$lListeDetailProduit[0] = new DetailProduitViewVO();
		}
		return $lListeDetailProduit;
	}

	/**
	* @name selectAll()
	* @return array(DetailProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de DetailProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . 
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . 
			"," . ProduitManager::CHAMP_PRODUIT_TYPE . 
			"," . ProduitManager::CHAMP_PRODUIT_ETAT . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ETAT . "
			FROM " . DetailProduitViewManager::VUE_DETAILPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailProduit,
					DetailProduitViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION],
					$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL],
					$lLigne[ProduitManager::CHAMP_PRODUIT_TYPE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ETAT],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ETAT],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ETAT]));
			}
		} else {
			$lListeDetailProduit[0] = new DetailProduitViewVO();
		}
		return $lListeDetailProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(DetailProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de DetailProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION .
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL .
			"," . ProduitManager::CHAMP_PRODUIT_TYPE .
			"," . ProduitManager::CHAMP_PRODUIT_ETAT .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(DetailProduitViewManager::VUE_DETAILPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeDetailProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeDetailProduit,
						DetailProduitViewManager::remplir(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
						$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION],
						$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL],
						$lLigne[ProduitManager::CHAMP_PRODUIT_TYPE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ETAT],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ETAT],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ETAT]));
				}
			} else {
				$lListeDetailProduit[0] = new DetailProduitViewVO();
			}

			return $lListeDetailProduit;
		}

		$lListeDetailProduit[0] = new DetailProduitViewVO();
		return $lListeDetailProduit;
	}

	/**
	* @name remplir($pProId, $pProIdCommande, $pProIdNomProduit, $pProUniteMesure, $pProMaxProduitCommande, $pProIdCompteFerme, $pProStockReservation, $pProStocktInitial, $pProType, $pProEtat, $pNproId, $pNproNumero, $pNproNom, $pNproDescription, $pNproIdCategorie, $pNproIdFerme, $pNproEtat, $pCproId, $pCproNom, $pCproDescription, $pCproEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param decimal(10,2) 	
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2) 	
	* @param tinyint(4)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param text
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param text
	* @param tinyint(4)
	* @return DetailProduitViewVO
	* @desc Retourne une DetailProduitViewVO remplie
	*/
	private static function remplir($pProId, $pProIdCommande, $pProIdNomProduit, $pProUniteMesure, $pProMaxProduitCommande, $pProIdCompteFerme, $pProStockReservation, $pProStocktInitial, $pProType, $pProEtat, $pNproId, $pNproNumero, $pNproNom, $pNproDescription, $pNproIdCategorie, $pNproIdFerme, $pNproEtat, $pCproId, $pCproNom, $pCproDescription, $pCproEtat) {
		$lDetailProduit = new DetailProduitViewVO();
		$lDetailProduit->setProId($pProId);
		$lDetailProduit->setProIdCommande($pProIdCommande);
		$lDetailProduit->setProIdNomProduit($pProIdNomProduit);
		$lDetailProduit->setProUniteMesure($pProUniteMesure);
		$lDetailProduit->setProMaxProduitCommande($pProMaxProduitCommande);
		$lDetailProduit->setProIdCompteFerme($pProIdCompteFerme);
		$lDetailProduit->setProStockReservation($pProStockReservation);
		$lDetailProduit->setProStocktInitial($pProStocktInitial);
		$lDetailProduit->setProType($pProType);
		$lDetailProduit->setProEtat($pProEtat);
		$lDetailProduit->setNproId($pNproId);
		$lDetailProduit->setNproNumero($pNproNumero);
		$lDetailProduit->setNproNom($pNproNom);
		$lDetailProduit->setNproDescription($pNproDescription);
		$lDetailProduit->setNproIdCategorie($pNproIdCategorie);
		$lDetailProduit->setNproIdFerme($pNproIdFerme);
		$lDetailProduit->setNproEtat($pNproEtat);
		$lDetailProduit->setCproId($pCproId);
		$lDetailProduit->setCproNom($pCproNom);
		$lDetailProduit->setCproDescription($pCproDescription);
		$lDetailProduit->setCproEtat($pCproEtat);
		return $lDetailProduit;
	}
}
?>