<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : MarcheCommandeVue.php
//
// Description : À REMPLIR
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/MarcheCommandeControleur.php");
	$lControleur = new MarcheCommandeControleur();
	
	if(isset($_POST['id_commande'])) {		
		if(isset($_POST['id_adherent'])) {	
			echo $lControleur->getInfoAchatCommande($_POST['id_commande'],$_POST['id_adherent'])->exportToJson();
			$lLogger->log("Affichage de la vue AchatCommande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		} else {
			echo $lControleur->getListeAdherentCommande($_POST['id_commande'])->exportToJson();
			$lLogger->log("Affichage de la vue MarcheCommande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		}	
	} else if(isset($_POST['achat'])) {	
		$lResponse = $lControleur->enregistrerAchat(json_decode($_POST['achat'],true));
		echo $lResponse->exportToJson();
		
		if($lResponse->getValid()) {
			$lLogger->log("Enregistrement d'un achat par l'adherent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		} else {
			$lLogger->log("Echec de l'enregistrement d'un achat par l'adherent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		}
	} else {
		$lLogger->log("Demande d'affichage de la vue MarcheCommande sans id de commande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à MarcheCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
