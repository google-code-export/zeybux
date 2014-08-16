<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : ListeFermeVue.php
//
// Description : Script de listing des Producteurs
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUCTEUR]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);	
		
		if(isset($lParam["fonction"])) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/ListeFermeControleur.php");
			// Récupère les données à afficher
			$lControleur = new ListeFermeControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":	// Lancement de la recherche
						echo $lControleur->getListeFerme()->exportToJson();	
						$lLogger->log("Affichage de la liste des fermes par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "ajouter":	// Lancement de la recherche
						echo $lControleur->ajouterFerme($lParam)->exportToJson();	
						$lLogger->log("Affichage de la liste des fermes par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
						$lLogger->log("Demande d'accés à liste des fermes sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à liste des fermes sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à liste des fermes sans fonction par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à liste des fermes",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>