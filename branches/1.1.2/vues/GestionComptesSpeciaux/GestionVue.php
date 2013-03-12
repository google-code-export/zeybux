<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier : GestionVue.php
//
// Description : Script de Gestion des comptes spéciaux
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMPTES_SPECIAUX]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMPTES_SPECIAUX . "/GestionControleur.php");
		
			$lControleur = new GestionControleur();
			switch($lParam["fonction"]) {					
				case "ajouter":
						echo $lControleur->ajouter($lParam)->exportToJson();						
						$lLogger->log("Ajout d'un compte spécial de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifier":
						echo $lControleur->update($lParam)->exportToJson();						
						$lLogger->log("Mise à jour d'un compte spécial de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifierPass":
						echo $lControleur->updatePass($lParam)->exportToJson();						
						$lLogger->log("Mise à jour du mot de passe d'un compte spécial de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "supprimer":
						echo $lControleur->delete($lParam)->exportToJson();						
						$lLogger->log("Suppression d'un compte spécial de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à Gestion des comptes spéciaux sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		
		} else {
			$lLogger->log("Demande d'accés à Gestion des comptes spéciaux sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}	
	} else {
		$lLogger->log("Demande d'accés à Gestion des comptes spéciaux sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');		
	}
} else {
	$lLogger->log("Demande d'affichage sans autorisation de la Gestion des comptes spéciaux",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
