<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/01/2013
// Fichier : BanqueVue.php
//
// Description : Vue du paramétrage des Banques
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_PARAMETRAGE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset( $_POST['pParam'] )) {
		$lParam = json_decode($_POST['pParam'],true);
		
		if(isset($lParam["fonction"])) {
			
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_PARAMETRAGE . "/BanqueControleur.php");
			// Création du controleur
			$lControleur = new BanqueControleur();
			switch($lParam["fonction"]) {
				case "liste":
					echo $lControleur->getListeBanque()->exportToJson();	
					$lLogger->log("Affichage de la liste des banques par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				case "detail":
					echo $lControleur->getDetailBanque($lParam)->exportToJson();
					$lLogger->log("Affichage du détail de banque par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "ajouter":
					$lResponse = $lControleur->ajoutBanque($lParam);
					echo $lResponse->exportToJson();
					
					if($lResponse->getValid()) {
						$lLogger->log("Ajout de la Banque " . $lResponse->getId() . " par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					} else {
						$lLogger->log("Echec de l'Ajout de Banque par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					}
					break;
					
				case "modifier":
					$lResponse = $lControleur->modifierBanque($lParam);
					echo $lResponse->exportToJson();
						
					if($lResponse->getValid()) {
						$lLogger->log("Modification de la Banque " . $lResponse->getId() . " par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					} else {
						$lLogger->log("Echec de la modification de la Banque " . $lResponse->getId() . " par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					}
					break;
					
				case "supprimer":
					$lResponse = $lControleur->supprimerBanque($lParam);
					echo $lResponse->exportToJson();
						
					if($lResponse->getValid()) {
						$lLogger->log("Suppression de la Banque par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					} else {
						$lLogger->log("Echec de la suppression de la Banque par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					}
					break;
					
				default:
					$lLogger->log("Demande d'accés au paramétrage Banque sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés sans fonction au paramétrage Banque",PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php?cx=1');
		}
	} else {
		$lLogger->log("Demande d'accés sans parametre au paramétrage Banque",PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php?cx=1');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation au paramétrage Banque",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
