<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : GestionAdhesionVue.php
//
// Description : Script de gestion des adhésions
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_ADHESION]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset( $_POST['pParam'] )) {
		$lParam = json_decode($_POST['pParam'],true);
		
		if(isset($lParam["fonction"])) {
			
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_ADHESION . "/GestionAdhesionControleur.php");
			// Création du controleur
			$lControleur = new GestionAdhesionControleur();
			switch($lParam["fonction"]) {
				case "listeAdhesion":
					echo $lControleur->getListeAdhesion()->exportToJson();
					break;
					
				case "listePerimetre":
					echo $lControleur->getListePerimetreAdhesion()->exportToJson();
					break;
					
				case "detailAdhesion":
					echo $lControleur->getAdhesion($lParam)->exportToJson();
					break;
					
				case "ajoutAdhesion":
					echo $lControleur->ajoutAdhesion($lParam)->exportToJson();
					break;
					
				case "updateAdhesion":
					echo $lControleur->updateAdhesion($lParam)->exportToJson();
					break; 
					
				case "autorisationSupprimerTypeAdhesion":
					echo $lControleur->autorisationSupprimerTypeAdhesion($lParam)->exportToJson();
					break; 
					
				case "autorisationSupprimerAdhesion":
					echo $lControleur->autorisationSupprimerAdhesion($lParam)->exportToJson();
					break;
					
				case "supprimerAdhesion":
					echo $lControleur->supprimerAdhesion($lParam)->exportToJson();
					break;
					
				case "listeAdherentAdhesion":
					echo $lControleur->getListeAdherentAdhesion($lParam)->exportToJson();
					break;
					
				case "infoAjoutAdhesionAdherent":
					echo $lControleur->getInfoAjoutAdhesionAdherent($lParam)->exportToJson();
					break;
					
				case "ajoutAdhesionAdherent":
					echo $lControleur->ajoutAdhesionAdherent($lParam)->exportToJson();
					break;
					
				case "infoModificationAdhesionAdherent":
					echo $lControleur->getInfoModificationAdhesionAdherent($lParam)->exportToJson();
					break;
					
				case "updateAdhesionAdherent":
					echo $lControleur->updateAdhesionAdherent($lParam)->exportToJson();
					break;
					
				case "deleteAdhesionAdherent":
					echo $lControleur->deleteAdhesionAdherent($lParam)->exportToJson();
					break;
					
				case "listeAdherent":
					echo $lControleur->getListeAdherent()->exportToJson();
					break;
				
				case "adhesionSurAdherent":
					echo $lControleur->getAdhesionSurAdherent($lParam)->exportToJson();
					break;

				default:
					$lLogger->log("Demande d'accés à gestion des adhésions sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
			
		} else {
			$lLogger->log("Demande d'accés à gestion des adhésions sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	
		if(isset($_POST['id'])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_ADHESION . "/GestionAdhesionControleur.php");					
			$lControleur = new GestionAdhesionControleur();
			$lParam = array();
			$lParam['id'] = $_POST['id'];
			
			switch($_POST['fonction']) {					
				case "listeAdherentSurTypeAdhesion":
					echo $lControleur->listeAdherentSurTypeAdhesion($lParam);
					break;

				case "listeAdherentSurAdhesion":
					echo $lControleur->listeAdherentSurAdhesion($lParam);
					break;
					
				case "exportListeAdherentSurAdhesion":
					echo $lControleur->exportListeAdherentAdhesion($lParam);
					break;
	
				default:
					$lLogger->log("Demande d'accés à gestion des adhésions sans fonction par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à gestion des adhésions pour export sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés sans parametre à gestion des adhésions",PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php?cx=1');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à gestion des adhésions",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>