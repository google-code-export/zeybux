<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2011
// Fichier : AchatAdherentVue.php
//
// Description : Retourne les infos sur la reservation et les achats d'un adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/AchatAdherentControleur.php");							
			$lControleur = new AchatAdherentControleur();
			
			switch($pParam["fonction"]) {
				case "afficher":
						echo $lControleur->getAchatEtReservation($pParam)->exportToJson();					
						$lLogger->log("Affichage de la vue AchatAdherent par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifierAchat":
						echo $lControleur->modifierAchat($pParam)->exportToJson();					
						$lLogger->log("Modification d'un achat par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs		
					break;
					
				case "supprimerAchat":
						echo $lControleur->supprimerAchat($pParam)->exportToJson();
						$lLogger->log("Suppression de l'Achat par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "listeFerme":
						echo $lControleur->getListeFerme()->exportToJson();
						$lLogger->log("Affichage de la liste des fermes dans la vue AchatAdherent par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						break;

				case "listeProduit":
						echo $lControleur->getListeProduit($pParam)->exportToJson();
						$lLogger->log("Affichage de la liste des produits dans la vue AchatAdherent par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "listeUnite":
						echo $lControleur->getUnite($pParam)->exportToJson();
						$lLogger->log("Affichage de la liste des unites dans la vue AchatAdherent par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "ajoutProduitAchat":
						echo $lControleur->ajoutProduitAchat($pParam)->exportToJson();
						$lLogger->log("Ajout d'un produit dans un achat dans la vue AchatAdherent par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à AchatAdherent sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à AchatAdherent sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à AchatAdherent sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à AchatAdherent",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>