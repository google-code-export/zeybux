<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : ListeProducteurVue.php
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
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/ListeProducteurControleur.php");
			// Récupère les données à afficher
			$lControleur = new ListeProducteurControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getListeProducteur($lParam)->exportToJson();	
						$lLogger->log("Affichage de la liste des producteurs par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailProducteur":
						echo $lControleur->detailProducteur($lParam)->exportToJson();	
						$lLogger->log("Detail du producteur par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;					
					
				case "ajouter":
						echo $lControleur->ajouterProducteur($lParam)->exportToJson();	
						$lLogger->log("Ajout de producteur par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifier":
						echo $lControleur->modifierProducteur($lParam)->exportToJson();	
						$lLogger->log("Modification de producteur par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;	
					
				case "supprimer":
						echo $lControleur->supprimerProducteur($lParam)->exportToJson();	
						$lLogger->log("Suppression du producteur par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
						$lLogger->log("Demande d'accés à Producteurs Ferme sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Producteurs Ferme sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à Producteurs Ferme sans fonction par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
	
	// Inclusion des classes
	/*include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/ListeProducteurControleur.php");	
	
	// Récupère les données à afficher
	$lListeProducteurControleur = new ListeProducteurControleur();
	// Lancement de la recherche
	echo $lListeProducteurControleur->getListeProducteur()->exportToJson();	

	$lLogger->log("Affichage de la liste des producteurs par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs*/
} else {
	$lLogger->log("Demande d'accés sans autorisation à liste des producteurs",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>