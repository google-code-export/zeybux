<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/06/2014
// Fichier : RemiseChequeVue.php
//
// Description : Script d'affichage de Remise de cheque
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_ASSOCIATION]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);

		if(isset($lParam["fonction"])) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ASSOCIATION . "/RemiseChequeControleur.php");
			$lControleur = new RemiseChequeControleur();

			switch($lParam["fonction"]) {
				case "ajout":
					echo $lControleur->ajoutRemiseCheque($lParam)->exportToJson();	
					$lLogger->log("Ajout de remise de cheque au Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "listeActive":
					echo $lControleur->getListeRemiseChequeActive($lParam)->exportToJson();
					$lLogger->log("Affichage de la liste des remises de cheques actives du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "listeEncaissee":
					echo $lControleur->getListeRemiseChequeEncaissee($lParam)->exportToJson();
					$lLogger->log("Affichage de la liste des remises de cheques encaissées du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "ajoutOperation":
					echo $lControleur->ajoutOperationsRemiseCheque($lParam)->exportToJson();
					$lLogger->log("Ajout d'opérations à une remise de cheques du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "supprimerOperation":
					echo $lControleur->supprimerOperation($lParam)->exportToJson();
					$lLogger->log("Suppression d'une opération d'une remise de cheques du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "detailRemise":
					echo $lControleur->getDetailRemiseCheque($lParam)->exportToJson();
					$lLogger->log("Ajout le détail d'une remise de cheques du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "encaisser":
					echo $lControleur->encaisser($lParam)->exportToJson();
					$lLogger->log("Encaissement d'une remise de cheques du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "supprimer":
					echo $lControleur->supprimerRemise($lParam)->exportToJson();
					$lLogger->log("Suppression d'une remise de cheques du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à Remise de cheque du Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Remise de cheque du Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	
		if(isset($_POST['id'])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ASSOCIATION . "/RemiseChequeControleur.php");						
			$lControleur = new RemiseChequeControleur();
			
			switch($_POST['fonction']) {					
				case "export":
						$lParam = array();
						$lParam['id'] = $_POST['id'];
									
						echo $lControleur->exportPDF($lParam);
						$lLogger->log("Export des operations de Remise de cheque du Compte Association par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
	
				default:
					$lLogger->log("Demande d'accés à Remise de cheque du Compte Association sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Remise de cheque du Compte Association pour export sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à Remise de cheque du Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à Remise de cheque du Compte Association",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>