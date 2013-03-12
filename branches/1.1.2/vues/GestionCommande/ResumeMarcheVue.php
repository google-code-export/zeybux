<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/04/2012
// Fichier : ResumeMarcheVue.php
//
// Description : Retourne les infos sur les marches
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/ResumeMarcheControleur.php");							
			$lControleur = new ResumeMarcheControleur();
			
			switch($pParam["fonction"]) {
				case "afficher":
					echo $lControleur->getInfoMarche($pParam)->exportToJson();					
					$lLogger->log("Affichage de la vue ResumeMarche par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à ResumeMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à ResumeMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à ResumeMarche",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>