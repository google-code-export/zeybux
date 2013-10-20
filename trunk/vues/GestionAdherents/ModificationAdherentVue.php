<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/02/2010
// Fichier : ModificationAdherentVue.php
//
// Description : Script de Modification d'un Adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_ADHERENTS]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {	
	if(isset( $_POST['pParam'] )) {

		$lParam = json_decode($_POST['pParam'],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_ADHERENTS . "/ModificationAdherentControleur.php");
			// Création du controleur
			$lControleur = new ModificationAdherentControleur();
			
			switch($lParam["fonction"]) {
				case "afficher":
					echo $lControleur->getAdherent($lParam)->exportToJson();
					$lLogger->log("Affichage de la vue modification de l'adhérent par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "adherentCompte":
					echo $lControleur->getDetailCompte($lParam)->exportToJson();
					$lLogger->log("Retourne la liste des adhérents sur un compte par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "modifier":
					$lResponse = $lControleur->modifierAdherent($lParam);
					echo $lResponse->exportToJson();
					
					if($lResponse->getValid()) {
						$lLogger->log("Modification de l'adhérent par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					} else {
						$lLogger->log("Echec de la modification de l'adhérent par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					}
					break;
						
				default:
					$lLogger->log("Demande d'accés à la modification sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}			
		} else {
			$lLogger->log("Demande d'accés sans fonction à la modification d'adhérent",PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php?cx=1');
		}
	} else {
		$lLogger->log("Demande d'accés sans paramètre à la modification des adhérents par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à la modification des adhérents",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
