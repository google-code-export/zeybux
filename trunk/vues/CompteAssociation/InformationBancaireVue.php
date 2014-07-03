<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/06/2014
// Fichier : InformationBancaireVue.php
//
// Description : Script d'affichage des Information Bancaire
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_ASSOCIATION]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);

		if(isset($lParam["fonction"])) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ASSOCIATION . "/InformationBancaireControleur.php");
			$lControleur = new InformationBancaireControleur();

			switch($lParam["fonction"]) {
				case "afficher":
					echo $lControleur->getInformationBancaire()->exportToJson();	
					$lLogger->log("Affiche les informations bancaire du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "enregistrer":
					echo $lControleur->enregistrerInformationBancaire($lParam)->exportToJson();
					$lLogger->log("Mise à jour des informations bancaire du Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à Information Bancaire du Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Information Bancaire du Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à Information Bancaire du Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à Information Bancaire du Compte Association",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>