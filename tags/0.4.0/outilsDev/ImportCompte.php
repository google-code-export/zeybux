<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - Import des Comptes</title>
</head>
<body>
<div>
	<a href="./index.php">Retour</a><br/>
</div>
<?php 

// Inclusion de la config
define("CHEMIN_RACINE", "../");
include_once("../configuration/Localisation.php");

// Définition des constantes de chemin
define("CHEMIN_CLASSES", CHEMIN_RACINE . "/classes/");
define("CHEMIN_CLASSES_UTILS", CHEMIN_RACINE . "/classes/utils/");
define("CHEMIN_CLASSES_PO", CHEMIN_RACINE . "/classes/po/");
define("CHEMIN_CLASSES_VO", CHEMIN_RACINE . "/classes/vo/");
define("CHEMIN_CLASSES_VIEW_VO", CHEMIN_RACINE . "/classes/viewVO/");
define("CHEMIN_CLASSES_MANAGERS", CHEMIN_RACINE . "/classes/managers/");
define("CHEMIN_CLASSES_VIEW_MANAGER", CHEMIN_RACINE . "/classes/viewManager/");
define("CHEMIN_CLASSES_CONTROLEURS", CHEMIN_RACINE . "/classes/controleurs/");
define("CHEMIN_CLASSES_VR", CHEMIN_RACINE . "/classes/vr/");
define("CHEMIN_CLASSES_VALIDATEUR", CHEMIN_RACINE . "/classes/validateur/");
define("CHEMIN_CLASSES_TOVO", CHEMIN_RACINE . "/classes/toVO/");
define("CHEMIN_CLASSES_RESPONSE", CHEMIN_RACINE . "/classes/response/");

define("CHEMIN_VUES", CHEMIN_RACINE . "/vues/");
define("CHEMIN_TEMPLATE", CHEMIN_RACINE . "/html/");
define("COMMUN_TEMPLATE", "Commun/");
define("CHEMIN_CSS", "./css/");
define("COMMUN_CSS", "Commun/");
define("CHEMIN_CONFIGURATION", "./configuration/");

define("CHEMIN_FICHIER_LOGS", CHEMIN_RACINE . "/logs/" . date('Ymd') . ".log");

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS."/Logging/Log.php");

// Définition du level de log
define("LOG_LEVEL",PEAR_LOG_DEBUG);

include_once("../classes/managers/AdherentManager.php");
include_once("../classes/managers/CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once("../classes/utils/StringUtils.php" );

// Téléchargement du fichier sql
if( isset($_FILES["compte"]) ) {
	if($_FILES["compte"]["error"] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["compte"]["tmp_name"];
        $name = $_FILES["compte"]["name"];
        move_uploaded_file($tmp_name, './compte');		
	}
	if(file_exists('./compte') ) {
		$row = 1;
		if (($handle = fopen("compte", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle)) !== FALSE) {
		       /* $num = count($data);
		        echo "<p> $num champs à la ligne $row: <br /></p>\n";
		        $row++;
		        for ($c=0; $c < $num; $c++) {
		            echo $data[$c] . "<br />\n";
		        }*/
		    	
		    	// Création d'un nouveau compte
				$lCompte = new CompteVO();
				$lCompte->setLabel($data[11]);
				//$lIdCompte=0;
				$lIdCompte = CompteManager::insert($lCompte);
		    	
		    	$lAdherent = new AdherentVO();
				$lAdherent->setPass('01f01083386dc09d99826461b2b6c6f1'); //mot de passe = zeybu
				
				$lAdherent->setIdCompte($lIdCompte);
				
				$lAdherent->setNom($data[2]);
				$lAdherent->setPrenom($data[3]);
				$lAdherent->setCourrielPrincipal($data[4]);
				$lAdherent->setCourrielSecondaire($data[5]);
				$lAdherent->setTelephonePrincipal($data[6]);
				$lAdherent->setTelephoneSecondaire($data[7]);
				$lAdherent->setAdresse($data[8]);
				$lVille = explode(" ", $data[9]);
				$lAdherent->setCodePostal($lVille[0]);
				$lAdherent->setVille($lVille[1]);
				$lAdherent->setDateNaissance(StringUtils::FORMAT_DATE_NULLE);
				$lDateAdhesion = '20' . $data[10][0] . $data[10][1] . '-' . $data[10][2] . $data[10][3] . '-' . $data[10][4] . $data[10][5];
				$lAdherent->setDateAdhesion($lDateAdhesion); 
				$lAdherent->setDateMaj(StringUtils::dateTimeAujourdhuiDb());
				$lAdherent->setCommentaire($data[12]);
				$lAdherent->setEtat(1);
				$lAdherent->setSuperZeybu(0);
		    	
			    // Enregistre l'adherent dans la BDD
		//	    $lId=0; 
				$lId = AdherentManager::insert( $lAdherent );
				
				// Ajout des autorisations du compte
				$lAutorisation = new AutorisationVO();
				$lAutorisation->setIdAdherent($lId);
				$lAutorisation->setIdModule(1);	
				AutorisationManager::insert($lAutorisation);
				$lAutorisation = new AutorisationVO();
				$lAutorisation->setIdAdherent($lId);
				$lAutorisation->setIdModule(3);	
				AutorisationManager::insert($lAutorisation);
				
				// Initialisation du compte
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($lIdCompte);
				//$lOperation->setIdCompte($row); $row++;
				$lOperation->setMontant(0);
				$lOperation->setLibelle("Création du compte");
				$lOperation->setDate(StringUtils::dateAujourdhuiDb());
				$lOperation->setType(1);
				$lOperation->setIdCommande(0);
				$lOperation->setTypePaiement(-1);				
				OperationManager::insert($lOperation);
				
		    }
		    fclose($handle);
		}		
	}
	// Suppression du fichier
	unlink('./compte');

	?>
	<h2>Import des comptes terminé.</h2>
	<?php 
} else {
	?>
	<form method="post" action="./ImportCompte.php" enctype="multipart/form-data">
		<span>Les comptes à insérer en BDD : </span>
		<input type="file" name="compte"/><br/>
		<input type=submit value="Importer">
	</form>	
	<?php
}
?>
</body>
</html>