<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : AbonnesVue.php
//
// Description : Retourne les détails des abonnes
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_ABONNEMENT]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_ABONNEMENT . "/ListeAbonneControleur.php");						
			$lControleur = new ListeAbonneControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getListeAbonne($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue Abonnes par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailAbonne":
						echo $lControleur->getDetailAbonne($lParam)->exportToJson();
						$lLogger->log("Affichage du détail de l'abonne dans Abonnes par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "listeFerme":
						echo $lControleur->getListeFerme()->exportToJson();
						$lLogger->log("Affichage de la liste des fermes dans la vue abonnement adhérent par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				case "listeProduit":
						echo $lControleur->getListeProduit($lParam)->exportToJson();
						$lLogger->log("Affichage de la liste des produits dans la vue abonnement adhérent par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailProduit":
						echo $lControleur->getDetailProduit($lParam)->exportToJson();
						$lLogger->log("Affichage du détail du produit d'abonnement dans la vue abonnement adhérent par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailAbonnement":
						echo $lControleur->getDetailAbonnement($lParam)->exportToJson();
						$lLogger->log("Affichage du détail de l'abonnement dans Abonnes par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "ajouter":
						echo $lControleur->ajoutAbonnement($lParam)->exportToJson();
						$lLogger->log("Ajout d'un abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifier":
						echo $lControleur->updateAbonnement($lParam)->exportToJson();
						$lLogger->log("Modification d'un abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "supprimer":
						echo $lControleur->supprimerAbonnement($lParam)->exportToJson();
						$lLogger->log("Suppression d'un abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "suspendre":
						echo $lControleur->suspendreAbonnement($lParam)->exportToJson();
						$lLogger->log("Suspension des abonnements par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "arretSuspension":
						echo $lControleur->supprimerSuspensionAbonnement($lParam)->exportToJson();
						$lLogger->log("Arrêt de la suspension d'abonnements par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à Abonnes sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Abonnes sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à Abonnes",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>