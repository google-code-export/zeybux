<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/02/2014
// Fichier : SuiviPaiementVue.php
//
// Description : À REMPLIR
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_ASSOCIATION]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ASSOCIATION . "/SuiviPaiementControleur.php");						
			$lControleur = new SuiviPaiementControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getListePaiement()->exportToJson();
						$lLogger->log("Affichage de la vue SuiviPaiement Association par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
							
				case "valider":
						echo $lControleur->validerPaiement($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue validerPaiement Association par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
							
				case "modifier":
						echo $lControleur->modifierPaiement($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue modifierPaiement Association par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
							
				case "supprimer":
						echo $lControleur->supprimerPaiement($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue supprimerPaiement Association par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à SuiviPaiement Association sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à SuiviPaiement Association sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à SuiviPaiement Association",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>