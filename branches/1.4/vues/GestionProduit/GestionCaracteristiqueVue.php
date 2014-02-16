<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : GestionCaracteristiqueVue.php
//
// Description : Gestion des catégories de produit
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUIT]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);		

		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUIT . "/GestionCaracteristiqueControleur.php");						
			$lControleur = new GestionCaracteristiqueControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getCaracteristique($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue GestionCaracteristique par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailCaracteristique":
						echo $lControleur->getDetailCaracteristique($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue DetailCaracteristique par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;	
					
				case "ajouter":
					echo $lControleur->ajouterCaracteristique($lParam)->exportToJson();
					$lLogger->log("Ajoout d'une Caracteristique par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				break;
					
				case "modifier":
						echo $lControleur->modifierCaracteristique($lParam)->exportToJson();
						$lLogger->log("Modification d'une Caracteristique par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "autorisationSupprimer":
						echo $lControleur->autorisationSupprimerCaracteristique($lParam)->exportToJson();
						$lLogger->log("Demande autorisation suppression de Caracteristique par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "supprimer":
						echo $lControleur->supprimerCaracteristique($lParam)->exportToJson();
						$lLogger->log("Suppression de Caracteristique par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à GestionCaracteristique sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à GestionCaracteristique sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	 
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUIT . "/GestionCaracteristiqueControleur.php");						
		$lControleur = new GestionCaracteristiqueControleur();
			
		$lTraitement = false;
		switch($_POST['fonction']) {
			case "exportProduitCaracteristique":
					if(isset($_POST['id'])) {	
						$lParam = array("id" => $_POST['id']);
						$lControleur->exportProduitCaracteristique($lParam);
						$lLogger->log("Export de la liste des produits liés à une Caracteristique par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						$lTraitement = true;
					}
				break;
			default:
				$lLogger->log("Demande d'accés à GestionCaracteristique sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
				break;
		}
		if(!$lTraitement) {
			$lLogger->log("Demande d'accés à GestionCaracteristique sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}			
	} else {
		$lLogger->log("Demande d'accés à GestionCaracteristique sans fonction par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à GestionCaracteristique",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>