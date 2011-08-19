<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2010
// Fichier : DbUtils.php
//
// Description : Classe statique permettant d'executer des requetes dans la base de données
//
//****************************************************************

include_once("./DB.php"); // Intégration des informations de configuration pour la connexion à la base de données
include_once("./MessagesErreurs.php"); // Intégration des constantes d'erreurs

/**
 * @name DbUtils
 * @author Julien PIERRE
 * @since 25/01/2010
 * 
 * @desc Classe fournissant des méthodes de connexion à la base
 */
class DbUtils
{
	/**
	* @name creerConnexion
	* @return nothing
	* @desc Créé une connexion à la BDD
	*/
	public static function creerConnexion() {
		$mMysqlHost = MYSQL_HOST; // le serveur
		$mMysqlLogin = MYSQL_LOGIN; // le login
		$mMysqlPass = MYSQL_PASS; // mot de passe
		$mMysqlDbnom = MYSQL_DBNOM; // nom de la base de donnee
		
		$lDb = mysql_connect($mMysqlHost,$mMysqlLogin,$mMysqlPass)
			or die(MessagesErreurs::ERR_BDD_CONNEXION . " : <br>".mysql_error());
		
		mysql_select_db($mMysqlDbnom,$lDb)
			or die(MessagesErreurs::ERR_BDD_SELECTION . " : <br>".mysql_error());

		mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
	}
	
	/**
	* @name fermerConnexion
	* @return nothing
	* @desc Ferme la connexion à la BDD
	*/	
	public static function fermerConnexion() {
		mysql_close()
			or die(MessagesErreurs::ERR_BDD_FERMETURE . " : <br>".mysql_error());
	}
		
	/**
	* @name executerRequete ($requete)
	* @param string 
	* @return mysql_result
	* @desc Exécute la requête passée en paramètre
	*/	
	public static function executerRequete($pRequete) {
		DbUtils::creerConnexion();
		$lResultat = mysql_query($pRequete) 
			or die(MessagesErreurs::ERR_BDD_EXECUTION . " : <br>$pRequete<br>".mysql_error());
		DbUtils::fermerConnexion();
		return $lResultat;
	}

	/**
	* @name executerRequeteInsertRetourId ($requete)
	* @param string 
	* @return integer
	* @desc Exécute la requête d'insertion passée en paramètre et retourne l'identifiant généré par la BDD
	*/	
	public static function executerRequeteInsertRetourId($pRequete) {
		DbUtils::creerConnexion();
		mysql_query($pRequete) 
			or die(MessagesErreurs::ERR_BDD_EXECUTION . " : <br>$pRequete<br>".mysql_error());
		$lId = mysql_insert_id(); 
		DbUtils::fermerConnexion();
		return $lId;
	}
	
	/**
	 * @name prepareRequeteSelect($pTable, $pChamps, $pFiltres, $pTris)
	 * @todo methode à tester!!!
	 * 
	 * @param string nom de la table
	 * @param array(string) champs à récupérer dans la table
	 * @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	 * @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	 * @return string requête SQL
	 */
	public static function prepareRequeteSelect($pTable, $pChamps, $pFiltres, $pTris) {
		$lResultat = "SELECT ";
		
		$lResultat .= implode(',', $pChamps);
		
		$lResultat .= " FROM " . $pTable;
		
		$lFiltreNonVide = false;
		
		// si il y a des filtres
		if(sizeof($pFiltres) > 0) {
			$lResultat .= " WHERE(";
			
			foreach ($pFiltres as $lFiltre) {
				if(!empty($lFiltre['champ']) && !empty($lFiltre['valeur'])) {
					$lResultat .= $lFiltre['champ'] . "='" . $lFiltre['valeur'] . "'";
					$lResultat .= " AND ";
					$lFiltreNonVide = true;
				}
			}
			
			// suppression du dernier AND
			$lResultat = substr($lResultat, 0, sizeof($lResultat) - 6);
			
			$lResultat .= ")";
		}
		
		// Permet de vérifier qu'il y a au moins un filtre non vide
		if($lFiltreNonVide) {
			$lResultat .= $lFiltresString;
		}
		
		// si il y a un tri
		if(sizeof($pTris) > 0) {
			if(!empty($pTris[0]['champ']) && !empty($pTris[0]['sens'])) {
				$lResultat .= " ORDER BY ";
				$lResultat .= $pTris[0]['champ'] . " " . $pTris[0]['sens'] . ",";
			}
			
			// suppression de la dernière virgule
			$lResultat = substr($lResultat, 0, sizeof($lResultat) - 2);
		}
		
		$lResultat .= ";";
		return $lResultat;
	}
	
/**
	 * @name prepareRequeteRecherche($pTable, $pChamps, $pFiltres, $pTris)
	 * @todo methode à tester!!!
	 * 
	 * @param string nom de la table
	 * @param array(string) champs à récupérer dans la table
	 * @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	 * @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	 * @return string requête SQL
	 */
	public static function prepareRequeteRecherche($pTable, $pChamps, $pFiltres, $pTris) {
		$lResultat = "SELECT ";
		
		$lResultat .= implode(',', $pChamps);
		
		$lResultat .= " FROM " . $pTable;
		
		$lFiltreNonVide = false;
		
		// si il y a des filtres
		if(sizeof($pFiltres) > 0) {
			$lFiltresString .= " WHERE(";
						
			foreach ($pFiltres as $lFiltre) {
				if(!empty($lFiltre['champ']) && !empty($lFiltre['valeur'])) {
					$lFiltresString .= $lFiltre['champ'] . " LIKE '%" . $lFiltre['valeur'] . "%'";
					$lFiltresString .= " AND ";
					$lFiltreNonVide = true;
				}
			}
			
			// suppression du dernier AND
			$lFiltresString = substr($lResultat, 0, sizeof($lResultat) - 6);
			$lFiltresString .= ")";
		}
		
		// Permet de vérifier qu'il y a au moins un filtre non vide
		if($lFiltreNonVide) {
			$lResultat .= $lFiltresString;
		}
				
		// si il y a un tri
		if(sizeof($pTris) == 1) {
			if(!empty($pTris[0]['champ']) && !empty($pTris[0]['sens'])) {
				$lResultat .= " ORDER BY ";
				$lResultat .= $pTris[0]['champ'] . " " . $pTris[0]['sens'] . ",";
			}			
			// suppression de la dernière virgule
			$lResultat = substr($lResultat, 0, sizeof($lResultat) - 2);
		}
		
		$lResultat .= ";";
		return $lResultat;
	}
}
?>
