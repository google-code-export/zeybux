<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/07/2011
// Fichier : ListeAdherentVue.php
//
// Description : Script de listing des Adherents
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_SOLIDAIRE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_SOLIDAIRE . "/CompteSolidaireControleur.php");							
			$lControleur = new CompteSolidaireControleur();
			
			switch($pParam["fonction"]) {					
				case "adherent":
						echo $lControleur->getAdherent()->exportToJson();
						$lLogger->log("Affichage de la liste des adhérents : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "ajoutVirement":
						echo $lControleur->ajoutVirement($pParam)->exportToJson();
						$lLogger->log("Affichage de la liste des adhérents : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à ListeAdherentVue sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à ListeAdherentVue sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à ListeAdherentVue sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeAdherentVue",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
