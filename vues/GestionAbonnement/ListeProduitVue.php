<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : ProduitsVue.php
//
// Description : Retourne les détails des produits d'abonnement
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_ABONNEMENT]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_ABONNEMENT . "/ListeProduitControleur.php");						
			$lControleur = new ListeProduitControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getListeProduitAbonnement($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue Produits par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailProduit":
						echo $lControleur->getDetailProduit($lParam)->exportToJson();
						$lLogger->log("Affichage du détail du produit d'abonnement dans Produits par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "ajouter":
						echo $lControleur->ajoutProduit($lParam)->exportToJson();
						$lLogger->log("Ajout d'un produit d'abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailProduitModifier":
						echo $lControleur->getDetailProduitModifier($lParam)->exportToJson();
						$lLogger->log("Affichage du détail du produit pour modification d'abonnement dans Produits par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifier":
						echo $lControleur->updateProduit($lParam)->exportToJson();
						$lLogger->log("Modification d'un produit d' abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "supprimer":
						echo $lControleur->supprimerProduit($lParam)->exportToJson();
						$lLogger->log("Suppression d'un produit d' abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "listeFerme":
						echo $lControleur->getListeFerme()->exportToJson();
						$lLogger->log("Affichage de la liste des fermes dans la vue Ajout d'un produit d'abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				case "listeProduit":
						echo $lControleur->getListeProduit($lParam)->exportToJson();
						$lLogger->log("Affichage de la liste des produits dans la vue Ajout d'un produit d'abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				case "listeUnite":
						echo $lControleur->getUnite($lParam)->exportToJson();
						$lLogger->log("Affichage de la liste des unites dans la vue Ajout d'un produit d'abonnement par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à Produits sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Produits sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à Produits",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>