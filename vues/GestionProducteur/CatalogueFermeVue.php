<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/10/2011
// Fichier : CatalogueFermeVue.php
//
// Description : Gestion des catégories de produit
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUCTEUR]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);		

		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/CatalogueFermeControleur.php");						
			$lControleur = new CatalogueFermeControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->afficher($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue CatalogueFerme par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailCategorie":
						echo $lControleur->getDetailCategorie($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue Detail Categorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "listeCategorie":
						echo $lControleur->getListeCategorie()->exportToJson();
						$lLogger->log("Affichage de la vue  Liste Categorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "listeProduit":
						echo $lControleur->getListeProduit($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue  Liste Produit par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "ajouterCategorie":
						echo $lControleur->ajouterCategorie($lParam)->exportToJson();
						$lLogger->log("Ajout d'une categorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifierCategorie":
						echo $lControleur->modifierCategorie($lParam)->exportToJson();
						$lLogger->log("Modification d'une categorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "autorisationSupprimerCategorie":
						echo $lControleur->autorisationSupprimerCategorie($lParam)->exportToJson();
						$lLogger->log("Demande autorisation suppression de catégorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "supprimerCategorie":
						echo $lControleur->supprimerCategorie($lParam)->exportToJson();
						$lLogger->log("Suppression de catégorie par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "infoFomulaireProduit":
						echo $lControleur->infoFomulaireProduit($lParam)->exportToJson();
						$lLogger->log("Demande des infos pour le formulaire d'ajout de produit par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "infoFomulaireModifierProduit":
						echo $lControleur->infoFomulaireModifierProduit($lParam)->exportToJson();
						$lLogger->log("Demande des infos pour le formulaire de modification de produit par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "ajouterProduit":
						echo $lControleur->ajouterProduit($lParam)->exportToJson();
						$lLogger->log("Ajout d'un produit par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifierProduit":
						echo $lControleur->modifierProduit($lParam)->exportToJson();
						$lLogger->log("Modification de produit par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "supprimerProduit":
						echo $lControleur->supprimerProduit($lParam)->exportToJson();
						$lLogger->log("Suppression de produit par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				case "detailProduit":
						echo $lControleur->getDetailProduit($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue Detail Produit par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à CatalogueFerme sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à CatalogueFerme sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	 
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/CatalogueFermeControleur.php");						
		$lControleur = new CatalogueFermeControleur();
			
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
				$lLogger->log("Demande d'accés à CatalogueFerme sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
				break;
		}
		if(!$lTraitement) {
			$lLogger->log("Demande d'accés à CatalogueFerme sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}			
	} else {
		$lLogger->log("Demande d'accés à CatalogueFerme sans fonction par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à CatalogueFerme",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>