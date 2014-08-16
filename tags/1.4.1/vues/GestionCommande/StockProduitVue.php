<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/04/2011
// Fichier : StockProduitVue.php
//
// Description : Retourne les infos sur les stocks de produit
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/StockProduitControleur.php");							
			$lControleur = new StockProduitControleur();
			
			switch($pParam["fonction"]) {
				case "ListeFerme":
						echo $lControleur->getListeFerme()->exportToJson();					
						$lLogger->log("Affichage de la vue StockProduit Liste des Fermes par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailFerme":
						echo $lControleur->getDetailStockProduitFerme($pParam)->exportToJson();					
						$lLogger->log("Affichage de la vue DetailStockProduit par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifierStock":
						echo $lControleur->modifierStock($pParam)->exportToJson();					
						$lLogger->log("Modification du StockProduit par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à StockProduit sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à StockProduit sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à StockProduit sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à StockProduit",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>