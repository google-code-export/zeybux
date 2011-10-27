<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/10/2011
// Fichier : GestionCategorieVue.php
//
// Description : Gestion des catégories de produit
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUIT]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);		

		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUIT . "/GestionCategorieControleur.php");						
			$lControleur = new GestionCategorieControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getCategorie($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue GestionCategorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "ajouter":
					echo $lControleur->ajouterCategorie($lParam)->exportToJson();
					$lLogger->log("Ajoout d'une categorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				break;
					
				case "modifier":
						echo $lControleur->modifierCategorie($lParam)->exportToJson();
						$lLogger->log("Modification d'une categorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "autorisationSupprimer":
						echo $lControleur->autorisationSupprimerCategorie($lParam)->exportToJson();
						$lLogger->log("Demande autorisation suppression de catégorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "supprimer":
						echo $lControleur->supprimerCategorie($lParam)->exportToJson();
						$lLogger->log("Suppression de catégorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à GestionCategorie sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à GestionCategorie sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	 
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUIT . "/GestionCategorieControleur.php");						
		$lControleur = new GestionCategorieControleur();
			
		$lTraitement = false;
		switch($_POST['fonction']) {
			case "exportProduitCategorie":
					if(isset($_POST['id'])) {	
						$lParam = array("id" => $_POST['id']);
						$lControleur->exportProduitCategorie($lParam);
						$lLogger->log("Export de la liste des produits liés à une catégorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						$lTraitement = true;
					}
				break;
			default:
				$lLogger->log("Demande d'accés à GestionCategorie sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
				break;
		}
		if(!$lTraitement) {
			$lLogger->log("Demande d'accés à GestionCategorie sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}			
	} else {
		$lLogger->log("Demande d'accés à GestionCategorie sans fonction par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à GestionCategorie",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>