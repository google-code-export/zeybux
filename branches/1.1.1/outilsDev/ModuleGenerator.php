<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - Css File Generator</title>
</head>
<body>
<div><a href="./index.php">Retour</a></div>
<?php
include("./DbUtils.php");

define("DROIT_DOSSIER",0755);
//define("UTILISATEUR", "julien");

if( isset($_POST['nom']) && isset($_POST['label']) && $_POST['nom'] != "") {
	
	// Création des dossiers
	if( !file_exists("../css/" . $_POST['nom']) ) {
		mkdir("../css/" . $_POST['nom'], DROIT_DOSSIER);
		echo "Création du dossier : ../css/" . $_POST['nom'] . "<br/>";
	}
	
	if( !file_exists("../html/" . $_POST['nom']) ) {
		mkdir("../html/" . $_POST['nom'], DROIT_DOSSIER);
		echo "Création du dossier : ../html/" . $_POST['nom'] . "<br/>";
	}
	
	if( !file_exists("../vues/" . $_POST['nom']) ) {
		mkdir("../vues/" . $_POST['nom'], DROIT_DOSSIER);	
		echo "Création du dossier : ../vues/" . $_POST['nom'] . "<br/>";
	}
	
	if( !file_exists("../classes/controleurs/" . $_POST['nom']) ) {
		mkdir("../classes/controleurs/" . $_POST['nom'], DROIT_DOSSIER);	
		echo "Création du dossier : ../classes/controleurs/" . $_POST['nom'] . "<br/>";
	}
	
	if( !file_exists("../classes/po/" . $_POST['nom']) ) {
		mkdir("../classes/po/" . $_POST['nom'], DROIT_DOSSIER);
		echo "Création du dossier : ../classes/po/" . $_POST['nom'] . "<br/>";
	}

	// Traitement de la position du module
	$lRequete = "SELECT * FROM `mod_module` ORDER BY `mod_ordre` DESC";
	$lSql = Dbutils::executerRequete($lRequete);
	$lLigne = mysql_fetch_assoc($lSql);
	$lOrdre = $lLigne['mod_ordre'];
	$lOrdre++;

	// Traitement du par défaut
	if( isset($_POST['defaut']) ) {
		$lDefaut = 1;
	} else {
		$lDefaut = 0;
	}
	
	// Insertion dans la base
	$lRequete = 	"INSERT INTO `mod_module` 
					(mod_id,mod_nom,mod_label,mod_defaut,mod_ordre) 
					VALUES (NULL, '" . $_POST['nom'] . "', '" . $_POST['label'] . "', '" . $lDefaut . "', '" . $lOrdre . "')";
	Dbutils::executerRequete($lRequete);
	?>
		<h3>Traitements Terminés !!</h3>
	<?php 
} else {	
?>
<form action="./ModuleGenerator.php" method="post">
	<span>Nom du Module : </span>
	<input type="text" name="nom" /><br/>
	<span>Label du Module : </span>
	<input type="text" name="label" /><br/>
	<span>Module par défaut ? : </span>
	<input type="checkbox" name="defaut" /><br/>
	<input type="submit" />
</form>
<?php 	
}
?>
</body>
</html>