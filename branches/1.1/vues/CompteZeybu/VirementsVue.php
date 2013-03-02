<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/08/2011
// Fichier : VirementsVue.php
//
// Description : À REMPLIR
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_ZEYBU]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ZEYBU . "/VirementsControleur.php");						
			$lControleur = new VirementsControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getListeAdherent()->exportToJson();
						$lLogger->log("Affichage de la vue Virements par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "listeVirement":
						echo $lControleur->getListeVirement()->exportToJson();
						$lLogger->log("Affichage de la vue Liste Virement par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				case "ajout":
						echo $lControleur->ajoutVirement($lParam)->exportToJson();
						$lLogger->log("Ajout de Virement par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				case "modifier":
						echo $lControleur->modifierVirement($lParam)->exportToJson();
						$lLogger->log("Modification de Virement par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				case "supprimer":
						echo $lControleur->supprimerVirement($lParam)->exportToJson();
						$lLogger->log("Suppression de Virement par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à Virements sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Virements sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à Virements",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
